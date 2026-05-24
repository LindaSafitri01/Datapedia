@extends('layout.app')
@section('content')
<div class="min-h-screen bg-white py-10">
    <div class="max-w-xl mx-auto px-4">
        @if(session('success'))
            <div class="mb-4 p-4 rounded-xl bg-green-100 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if(session('info'))
            <div class="mb-4 p-4 rounded-xl bg-blue-100 text-blue-700">
                {{ session('info') }}
            </div>
        @endif

        <div class="bg-slate-50 rounded-2xl shadow-sm border border-slate-100 p-8 text-center">
            <h1 class="text-2xl font-bold text-slate-700 mb-4">
                Nomor Antrean :
            </h1>

            <div class="text-7xl font-black text-cyan-700 mb-4">
                {{ $antrian->nomor_antrian }}
            </div>

            <h2 class="text-2xl font-bold text-slate-700 mb-4">
                {{ $antrian->layanan->nama_layanan }}
            </h2>

            <p class="text-slate-600 mb-2">
                Tanggal:
                {{ \Carbon\Carbon::parse($antrian->tanggal_antrian)->format('d-m-Y') }}
                {{ $antrian->created_at->format('H:i') }}
            </p>

            <!-- <div class="my-5">
                @if($antrian->status == 'pending')
                    <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm font-bold">
                        Belum Dicetak
                    </span>
                @elseif($antrian->status == 'printed')
                    <span class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm font-bold">
                        Sudah Dicetak
                    </span>
                @elseif($antrian->status == 'called')
                    <span class="px-4 py-2 rounded-full bg-purple-100 text-purple-700 text-sm font-bold">
                        Sedang Dipanggil
                    </span>
                @elseif($antrian->status == 'served')
                    <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-bold">
                        Selesai
                    </span>
                @elseif($antrian->status == 'expired')
                    <span class="px-4 py-2 rounded-full bg-red-100 text-red-700 text-sm font-bold">
                        Kedaluwarsa
                    </span>
                @else
                    <span class="px-4 py-2 rounded-full bg-slate-200 text-slate-700 text-sm font-bold">
                        Dibatalkan
                    </span>
                @endif
            </div> -->

            <p class="text-lg text-slate-700 mt-6">
                Silakan menuju ruang tunggu PST.
            </p>

            <div class="my-6 text-slate-500">
                -----
            </div>

            <p class="text-sm text-slate-600 leading-relaxed">
                * Nomor antrean ini hanya berlaku tanggal
                {{ \Carbon\Carbon::parse($antrian->tanggal_antrian)->format('d-m-Y') }}.
            </p>

            <p class="text-sm text-slate-600 leading-relaxed mt-4">
                ** Simpan nomor antrean online ini dan tunjukkan kepada petugas saat datang
                ke Kantor BPS Provinsi Kepulauan Bangka Belitung untuk melakukan cetak nomor antrean.
            </p>

            <p class="text-sm text-red-600 font-semibold leading-relaxed mt-4">
                Nomor antrean online belum dapat dipanggil sebelum dicetak di kantor.
            </p>

            <a href="{{ route('antrian.pdf', $antrian->kode_booking) }}"
               class="mt-8 inline-flex items-center justify-center w-full bg-cyan-700 hover:bg-cyan-800 text-white font-bold py-3 rounded-xl transition">
                Simpan PDF
            </a>
        </div>
    </div>
</div>
@endsection