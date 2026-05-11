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
        return view('admin.dashboard.index', compact('totalAdmin','totalJadwal','totalUser','totalKonsultan','totalLayanan','totalMaklumat','totalStandar','totalPetugas','totalFaq'));
    }

}
