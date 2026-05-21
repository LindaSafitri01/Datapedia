<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\akunuser;
use App\Models\faq;
use Illuminate\Http\Request;
use App\Models\jadwal;
use App\Models\konsultan;
use App\Models\layanan;
use App\Models\maklumat;
use App\Models\petugas;
use App\Models\standar;
use App\Models\konsultasiKlik;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function index(){
        $totalAdmin = admin::count();
        $totalUser = akunuser::count();
        $totalKonsultan = konsultan::count();
        $totalJadwal = jadwal::count();
        $totalLayanan = layanan::count();
        $totalMaklumat = maklumat::count();
        $totalStandar = standar::count();
        $totalPetugas = petugas::count();
        $totalFaq = faq::count();

        $selectedYear = request('tahun', date('Y'));

        $availableYears = konsultasiKlik::selectRaw('YEAR(clicked_at) as tahun')
            ->whereNotNull('clicked_at')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun')
            ->toArray();

        if (empty($availableYears)) {
            $availableYears = [date('Y')];
        }

        $bulanLabels = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
            'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        ];

        $labelPosisi = [
            'asn' => 'ASN',
            'karyawan_swasta' => 'Karyawan Swasta',
            'wiraswasta' => 'Wiraswasta',
            'peneliti' => 'Peneliti',
            'pelajar_mahasiswa' => 'Pelajar/Mahasiswa',
            'lainnya' => 'Lainnya',
        ];

        $warnaDataset = [
            'rgba(59, 130, 246, 0.8)',
            'rgba(16, 185, 129, 0.8)',
            'rgba(245, 158, 11, 0.8)',
            'rgba(239, 68, 68, 0.8)',
            'rgba(139, 92, 246, 0.8)',
            'rgba(20, 184, 166, 0.8)',
        ];

        // Ambil posisi yang benar-benar ada di database pada tahun terpilih
        $posisiList = konsultasiKlik::whereYear('clicked_at', $selectedYear)
            ->whereNotNull('posisi')
            ->where('posisi', '!=', '')
            ->distinct()
            ->pluck('posisi')
            ->toArray();

        $datasets = [];
        $totalBulanan = array_fill(0, 12, 0);

        foreach ($posisiList as $index => $posisi) {
            $dataPerBulan = array_fill(0, 12, 0);

            $data = konsultasiKlik::selectRaw('MONTH(clicked_at) as bulan, COUNT(*) as jumlah')
                ->whereYear('clicked_at', $selectedYear)
                ->where('posisi', $posisi)
                ->groupBy(DB::raw('MONTH(clicked_at)'))
                ->orderBy(DB::raw('MONTH(clicked_at)'))
                ->get();

            foreach ($data as $row) {
                $bulanIndex = $row->bulan - 1;

                $dataPerBulan[$bulanIndex] = (int) $row->jumlah;
                $totalBulanan[$bulanIndex] += (int) $row->jumlah;
            }

            $datasets[] = [
                'label' => $labelPosisi[$posisi] ?? ucwords(str_replace('_', ' ', $posisi)),
                'data' => $dataPerBulan,
                'backgroundColor' => $warnaDataset[$index % count($warnaDataset)],
                'borderRadius' => 8,
            ];
        }

        $dataKonsultasiBulanan = [
            'labels' => $bulanLabels,
            'datasets' => $datasets,
            'totalBulanan' => $totalBulanan,
        ];
        
        return view('admin.dashboard.index', compact('totalAdmin','totalJadwal','totalUser','totalKonsultan','totalLayanan','totalMaklumat','totalStandar','totalPetugas','totalFaq','selectedYear','availableYears','dataKonsultasiBulanan'));
    }

}
