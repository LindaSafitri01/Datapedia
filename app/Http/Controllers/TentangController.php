<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManajemenMutu;
use App\Models\Standar;

class TentangController extends Controller
{
    public function index()
    {
        //Ambil data dari database
        $manajemenMutu  = ManajemenMutu::latest()->get();
        $standar  = Standar::latest()->get();

        //Kirim ke view
        return view('user.tentang', compact('manajemenMutu', 'standar'));
    }
}