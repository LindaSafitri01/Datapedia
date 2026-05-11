<?php

namespace App\Http\Controllers;

use App\Models\akunuser;
use App\Models\konsultasiKlik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class konsultasiController extends Controller
{
    public function index(){
        return view('konsultasi.index');
    }

    public function store(Request $request)
{
    // Ambil user dari sesi login
    $user = akunuser::find(Session::get('user_id'));

    if (!$user) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // Validasi form input
    $validated = $request->validate([
        'instansi'       => 'required|string',
        'data_diminta'   => 'required|string',
        'posisi'        => 'required|string',
    ]);

    // Simpan ke database
    konsultasiKlik::create([
        'users_id'       => $user->id,
        'clicked_at'     => now(),
        'instansi'       => $validated['instansi'],
        'data_diminta'   => $validated['data_diminta'],
        'posisi'        => $validated['posisi'],
    ]);

    // Format pesan WA
    $pesan = "*Permintaan Konsultasi Baru*\n\n";
    $pesan .= "👤 Nama Pengaju: {$user->nama}\n";
    $pesan .= "📌 Dari Instansi: {$validated['instansi']}\n";
    $pesan .= "📌 Data yang Diminta: {$validated['data_diminta']}\n";
    $pesan .= "📌 Posisi Sebagai: {$validated['posisi']}\n";

    // Nomor bot WhatsApp
    $botPhoneNumber = '6285355609323'; //ganti dengan nomor bot WA yang digunakan

    // Redirect ke WA Web dengan pesan
    // $url = "https://api.whatsapp.com/send?phone=$botPhoneNumber&text=" . urlencode($pesan);
    $url = "https://web.whatsapp.com/send?phone=$botPhoneNumber&text=" . urlencode($pesan);
    return redirect()->away($url);
}
    public function jumlah()
{
    $userId = Session::get('user_id');
    $user = akunuser::find($userId);

    $today = $user->jumlahKlik()->whereDate('clicked_at', Carbon::today())->count();
    $month = $user->jumlahKlik()->whereMonth('clicked_at', Carbon::now()->month)->count();
    $total = $user->jumlahKlik()->count();

    return view('user.user', compact('today', 'month', 'total'));
}


}
