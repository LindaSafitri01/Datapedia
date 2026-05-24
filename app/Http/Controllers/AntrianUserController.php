<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\LayananAntrian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class AntrianUserController extends Controller
{
    public function index()
    {
        $layanans = LayananAntrian::where('is_active', true)
            ->orderBy('kode_layanan')
            ->get();

        return view('user.antrian.index', compact('layanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'layanan_antrian_id' => 'required|exists:layanan_antrians,id',
        ]);

        $userId = session('user_id');
        $today = now()->toDateString();

        // Cegah user mengambil antrean lebih dari 1 kali untuk layanan yang sama pada hari yang sama
        $existing = Antrian::where('user_id', $userId)
            ->whereDate('tanggal_antrian', $today)
            ->where('layanan_antrian_id', $request->layanan_antrian_id)
            ->first();

        if ($existing) {
            return redirect()
                ->route('antrian.show', $existing->kode_booking)
                ->with('info', 'Anda sudah mengambil nomor antrean untuk layanan ini hari ini.');
        }

        $antrian = DB::transaction(function () use ($request, $userId, $today) {
            $layanan = LayananAntrian::lockForUpdate()
                ->findOrFail($request->layanan_antrian_id);

            $lastNumber = Antrian::where('layanan_antrian_id', $layanan->id)
                ->whereDate('tanggal_antrian', $today)
                ->lockForUpdate()
                ->max('nomor_urut');

            $nextNumber = $lastNumber ? $lastNumber + 1 : 1;

            $nomorAntrian = $layanan->kode_layanan . $nextNumber;

            return Antrian::create([
                'layanan_antrian_id' => $layanan->id,
                'user_id' => $userId,
                'tanggal_antrian' => $today,
                'nomor_urut' => $nextNumber,
                'nomor_antrian' => $nomorAntrian,
                'kode_booking' => strtoupper(Str::random(10)),
                'status' => 'pending',
            ]);
        });

        return redirect()
            ->route('antrian.show', $antrian->kode_booking)
            ->with('success', 'Nomor antrean berhasil dibuat.');
    }

    public function show($kode_booking)
    {
        $antrian = Antrian::with('layanan')
            ->where('kode_booking', $kode_booking)
            ->firstOrFail();

        // Jika antrean sudah beda tanggal dan belum selesai, ubah menjadi expired
        if ($antrian->tanggal_antrian < today()->toDateString()
            && in_array($antrian->status, ['pending', 'printed'])) {
            $antrian->update([
                'status' => 'expired',
                'expired_at' => now(),
            ]);
        }

        return view('user.antrian.show', compact('antrian'));
    }

    public function pdf($kode_booking)
    {
        $antrian = Antrian::with('layanan')
            ->where('kode_booking', $kode_booking)
            ->firstOrFail();

        $pdf = Pdf::loadView('user.antrian.pdf', compact('antrian'))
            ->setPaper('a6', 'portrait');

        return $pdf->download('nomor-antrean-' . $antrian->nomor_antrian . '.pdf');
    }
}