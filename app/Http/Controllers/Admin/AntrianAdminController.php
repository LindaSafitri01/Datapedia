<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\LayananAntrian;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AntrianAdminController extends Controller
{
    public function index(Request $request)
    {
        $this->expireAntreanLama();
        $tanggal = $request->tanggal ?? now()->toDateString();

        $antrians = Antrian::with(['layanan', 'user'])
            ->whereDate('tanggal_antrian', $tanggal)
            ->orderByRaw("FIELD(status, 'called', 'printed', 'pending', 'served', 'cancelled', 'expired')")
            ->orderBy('nomor_urut', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.antrian.index', compact('antrians', 'tanggal'));
    }

    public function cetak($id)
    {
        $antrian = Antrian::findOrFail($id);

        if ($antrian->status != 'pending') {
            return back()->with('error', 'Antrean ini tidak bisa dicetak.');
        }

        if (Carbon::parse($antrian->tanggal_antrian)->format('Y-m-d') < now()->toDateString()) {
            $expiredAt = Carbon::parse($antrian->tanggal_antrian)->endOfDay();

            $antrian->update([
                'status' => 'expired',
                'expired_at' => $expiredAt,
            ]);

            return back()->with('error', 'Nomor antrean sudah kedaluwarsa dan tidak bisa dicetak.');
        }

        $antrian->update([
            'status' => 'printed',
            'printed_at' => now(),
        ]);

        return back()->with('success', 'Nomor antrean berhasil dicetak. Status berubah menjadi Belum Dipanggil.');
    }

    private function expireAntreanLama()
    {
        $antrians = Antrian::whereDate('tanggal_antrian', '<', now()->toDateString())
            ->whereIn('status', ['pending', 'printed', 'called'])
            ->get();

        foreach ($antrians as $antrian) {
            $expiredAt = Carbon::parse($antrian->tanggal_antrian)->endOfDay();

            $antrian->update([
                'status' => 'expired',
                'expired_at' => $expiredAt,
            ]);
        }
    }

    public function panggil(Request $request, $id)
    {
        $antrian = Antrian::with('layanan')->findOrFail($id);

        if ($antrian->status == 'printed') {
            $request->validate([
                'nomor_meja' => 'required|string|max:20',
            ], [
                'nomor_meja.required' => 'Silakan pilih meja terlebih dahulu.',
            ]);

            $nomorMeja = $request->nomor_meja;
        } elseif ($antrian->status == 'called') {
            $nomorMeja = $antrian->nomor_meja;

            if (!$nomorMeja) {
                return back()->with('error', 'Nomor meja belum tersedia.');
            }
        } else {
            return back()->with('error', 'Antrean ini tidak bisa dipanggil.');
        }

        $antrian->update([
            'status' => 'called',
            'nomor_meja' => $nomorMeja,
            'called_at' => now(),
        ]);

        $nomorSuara = $this->teksNomorAntrean($antrian->nomor_antrian);
        $mejaSuara = $this->teksMeja($nomorMeja);

        $teksPanggilan = 'Perhatian. Nomor antrean ' . $nomorSuara . '. Silakan menuju ' . $mejaSuara . '. Terima kasih.';

        return back()
            ->with('success', 'Nomor antrean ' . $antrian->nomor_antrian . ' berhasil dipanggil.')
            ->with('called_text', $teksPanggilan);
    }

    public function selesai($id)
    {
        $antrian = Antrian::findOrFail($id);

        if ($antrian->status != 'called') {
            return back()->with('error', 'Antrean belum sedang dilayani.');
        }

        $antrian->update([
            'status' => 'served',
            'served_at' => now(),
        ]);

        return back()->with('success', 'Antrean selesai dilayani.');
    }

    public function riwayat(Request $request)
    {
        $this->expireAntreanLama();

        $bulan = $request->bulan ?? now()->format('m');
        $tahun = $request->tahun ?? now()->format('Y');

        $startDate = Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
        $endDate = Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth();

        $layanans = LayananAntrian::withCount([
            'antrian as total_online' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal_antrian', [
                    $startDate->toDateString(),
                    $endDate->toDateString()
                ]);
            },

            'antrian as total_dilayani' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal_antrian', [
                    $startDate->toDateString(),
                    $endDate->toDateString()
                ])->where('status', 'served');
            },
        ])
        ->orderBy('kode_layanan', 'asc')
        ->get();

        $totalOnline = $layanans->sum('total_online');
        $totalDilayani = $layanans->sum('total_dilayani');

        return view('admin.antrian.riwayat', compact(
            'layanans',
            'bulan',
            'tahun',
            'totalOnline',
            'totalDilayani'
        ));
    }

    public function destroy($id)
    {
        $antrian = Antrian::findOrFail($id);
        $antrian->delete();

        return redirect()
            ->route('admin.antrian.index')
            ->with('success', 'Data antrean berhasil dihapus.');
    }

    private function teksNomorAntrean($nomorAntrian)
    {
        preg_match('/([A-Za-z]+)(\d+)/', $nomorAntrian, $matches);

        $kode = isset($matches[1]) ? strtoupper($matches[1]) : '';
        $angka = isset($matches[2]) ? (int) $matches[2] : 0;

        $kodeSuara = $this->hurufAntrean($kode);
        $angkaSuara = $this->angkaIndonesia($angka);

        return $kodeSuara . ' ' . $angkaSuara;
    }

    private function hurufAntrean($kode)
    {
        $huruf = [
            'A' => 'A',
            'B' => 'B',
            'C' => 'C',
            'D' => 'D',
        ];

        return $huruf[$kode] ?? $kode;
    }


    private function teksMeja($nomorMeja)
    {
        preg_match('/\d+/', $nomorMeja, $matches);

        if (isset($matches[0])) {
            return 'meja ' . $this->angkaIndonesia((int) $matches[0]);
        }

        return strtolower($nomorMeja);
    }

    private function angkaIndonesia($angka)
    {
        $angka = (int) $angka;

        $huruf = [
            '',
            'satu',
            'dua',
            'tiga',
            'empat',
            'lima',
            'enam',
            'tujuh',
            'delapan',
            'sembilan',
            'sepuluh',
            'sebelas'
        ];

        if ($angka < 12) {
            return $huruf[$angka];
        } elseif ($angka < 20) {
            return $huruf[$angka - 10] . ' belas';
        } elseif ($angka < 100) {
            $puluh = floor($angka / 10);
            $sisa = $angka % 10;

            return trim($huruf[$puluh] . ' puluh ' . $huruf[$sisa]);
        } elseif ($angka < 200) {
            return trim('seratus ' . $this->angkaIndonesia($angka - 100));
        } elseif ($angka < 1000) {
            $ratus = floor($angka / 100);
            $sisa = $angka % 100;

            return trim($huruf[$ratus] . ' ratus ' . $this->angkaIndonesia($sisa));
        }

        return (string) $angka;
    }
}