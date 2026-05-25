@extends('layout.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BPS User | Profil</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 p-4">

  <!-- <nav class="w-full max-w-6xl mx-auto mb-8">
    <div class="glass-effect rounded-2xl p-4 flex items-center justify-between">
      <div class="flex items-center space-x-4">
        <div class="profile-avatar w-12 h-12 rounded-full flex items-center justify-center bg-primary">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
          </svg>
        </div>
        <div>
          <h1 class="text-xl font-bold text-gray-800">Profil Pengguna</h1>
          <p class="text-sm text-gray-600">Sistem BPS User</p>
        </div>
      </div>
      <img class=" sm:flex hidden" src="{{ asset('image/logo-bpsbiru.png') }}" width="400" height="400" alt="">
    </div>
  </nav> -->

  <main class="w-full max-w-6xl mx-auto mt-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Kartu Profil -->
        <div class="lg:col-span-1">
            <div class="profile-card bg-white rounded-3xl p-6 shadow-sm border border-gray-100 lg:sticky lg:top-6">

                {{-- Avatar dan Identitas --}}
                <div class="text-center">
                    <div class="w-24 h-24 rounded-full mx-auto flex items-center justify-center mb-4 bg-primary text-white shadow-sm ring-4 ring-blue-50">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>

                    <h2 class="text-xl font-black text-gray-800 truncate">
                        {{ $user->nama ?? 'Nama tidak tersedia' }}
                    </h2>

                    <p class="text-sm text-gray-500 truncate mt-1">
                        {{ $user->email ?? '-' }}
                    </p>

                    <div class="mt-4 inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-black">
                        <span class="w-2 h-2 rounded-full bg-green-600"></span>
                        Aktif
                    </div>
                </div>

                {{-- Menu Profil --}}
                <div class="mt-6 pt-5 border-t border-gray-100 grid grid-cols-1 gap-2">

                    <button type="button"
                            id="btnInfoProfil"
                            onclick="showProfileTab('info')"
                            class="w-full bg-primary text-white py-3 px-4 rounded-2xl flex items-center justify-center gap-2 text-sm font-black transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>Informasi Profil</span>
                    </button>

                    <button type="button"
                            id="btnJadwalProfil"
                            onclick="showProfileTab('jadwal')"
                            class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-4 rounded-2xl flex items-center justify-center gap-2 text-sm font-black transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M8 7V3m8 4V3M5 11h14M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Jadwal Janji Temu</span>
                    </button>

                    <button type="button"
                            id="btnAntrianProfil"
                            onclick="showProfileTab('antrian')"
                            class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-4 rounded-2xl flex items-center justify-center gap-2 text-sm font-black transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5h6M9 9h6M9 13h6M5 5h.01M5 9h.01M5 13h.01M4 19h16"/>
                        </svg>
                        <span>Antrean Hari Ini</span>
                    </button>

                </div>
            </div>
        </div>

      <!-- Informasi Profil -->
      <div class="lg:col-span-2">

            {{-- PANEL INFORMASI PROFIL --}}
            <div id="profileInfoPanel" class="profile-card rounded-3xl p-5 md:p-6 bg-white shadow">
                <h3 class="text-xl font-black text-gray-800 mb-4">
                    Informasi Profil
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                    {{-- Username --}}
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">
                                    Username
                                </p>
                                <p class="text-sm md:text-base font-black text-gray-800 truncate">
                                    {{ $user->nama ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Nomor HP --}}
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-green-100 text-green-700 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.68l1.2 3.6a1 1 0 01-.27 1.03l-1.7 1.7a16 16 0 006.36 6.36l1.7-1.7a1 1 0 011.03-.27l3.6 1.2a1 1 0 01.68.95V19a2 2 0 01-2 2h-1C10.16 21 3 13.84 3 5z" />
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">
                                    Nomor HP
                                </p>
                                <p class="text-sm md:text-base font-black text-gray-800 truncate">
                                    +{{ $user->no_hp ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Email Full Width --}}
                    <div class="md:col-span-2 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 8h18a2 2 0 002-2V8a2 2 0 00-2-2H3a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                </svg>
                            </div>

                            <div class="min-w-0 flex-1">
                                <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">
                                    Email
                                </p>
                                <p class="text-sm md:text-base font-black text-gray-800 truncate">
                                    {{ $user->email ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <a href="{{ route('profile.edit', $user->id) }}"
                    class="bg-primary hover:bg-blue-800 text-white py-2.5 px-4 rounded-xl flex items-center justify-center gap-2 text-sm font-bold transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15.232 5.232l3.536 3.536M4 20h4.586a1 1 0 00.707-.293l9.414-9.414a1 1 0 000-1.414l-3.586-3.586a1 1 0 00-1.414 0L4.293 14.707A1 1 0 004 15.414V20z" />
                        </svg>
                        <span>Edit Profil</span>
                    </a>

                    <a href="{{ route('index') }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 py-2.5 px-4 rounded-xl flex items-center justify-center gap-2 text-sm font-bold transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" />
                        </svg>
                        <span>Kembali Beranda</span>
                    </a>
                </div>
            </div>

            {{-- PANEL JADWAL JANJI TEMU --}}
            <div id="profileJadwalPanel" class="hidden profile-card rounded-3xl p-6 bg-white shadow">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
                    <div>
                        <h3 class="text-xl font-black text-gray-800">
                            Jadwal Janji Temu
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Ringkasan jadwal janji temu terbaru Anda.
                        </p>
                    </div>

                    <a href="{{ route('janjitemu.jadwal') }}"
                        class="inline-flex items-center justify-center px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-xl text-sm font-bold transition">
                        Lihat Semua
                    </a>
                </div>

                @if(isset($jadwalUser) && $jadwalUser->count())
                    <div class="rounded-2xl border border-gray-100 overflow-hidden max-h-[340px] overflow-y-auto">
                        <table class="w-full table-fixed text-xs sm:text-sm">
                            <thead class="sticky top-0 z-10">
                                <tr class="bg-blue-50 text-blue-900 border-b border-blue-100">
                                    <th class="w-[8%] px-3 py-3 text-left text-[10px] font-black uppercase tracking-widest">
                                        No
                                    </th>
                                    <th class="w-[28%] px-3 py-3 text-left text-[10px] font-black uppercase tracking-widest">
                                        Jadwal
                                    </th>
                                    <th class="w-[28%] px-3 py-3 text-left text-[10px] font-black uppercase tracking-widest">
                                        Instansi
                                    </th>
                                    <th class="w-[18%] px-3 py-3 text-left text-[10px] font-black uppercase tracking-widest">
                                        Status
                                    </th>
                                    <th class="w-[18%] px-3 py-3 text-center text-[10px] font-black uppercase tracking-widest">
                                        Detail
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 bg-white">
                                @foreach($jadwalUser as $item)
                                    @php
                                        $status = strtolower($item->status ?? 'menunggu');

                                        $statusClass = [
                                            'menunggu' => 'bg-yellow-100 text-yellow-700',
                                            'diterima' => 'bg-green-100 text-green-700',
                                            'batal' => 'bg-red-100 text-red-700',
                                            'ditolak' => 'bg-gray-100 text-gray-700',
                                        ][$status] ?? 'bg-gray-100 text-gray-700';

                                        $jenisClass = ($item->jenis ?? '') === 'online'
                                            ? 'bg-green-50 text-green-700'
                                            : 'bg-blue-50 text-blue-700';

                                        $layananList = $item->layanan_dibutuhkan
                                            ? explode(', ', $item->layanan_dibutuhkan)
                                            : [];

                                        $keperluanList = $item->keperluan_data
                                            ? explode(', ', $item->keperluan_data)
                                            : [];
                                    @endphp

                                    <tr class="hover:bg-blue-50/40 transition">
                                        <td class="px-3 py-3 text-gray-400 font-bold">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-3 py-3">
                                            <p class="font-black text-gray-800 truncate">
                                                {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('D MMM Y') : 'Belum dijadwalkan' }}
                                            </p>

                                            <p class="text-[11px] text-gray-500 truncate mt-0.5">
                                                {{ $item->jam ? \Carbon\Carbon::parse($item->jam)->format('H:i') . ' WIB' : '-' }}
                                            </p>
                                        </td>

                                        <td class="px-3 py-3">
                                            <p class="font-black text-gray-800 truncate">
                                                {{ $item->instansi_lembaga ?? '-' }}
                                            </p>

                                            <p class="text-[11px] text-gray-400 truncate mt-0.5">
                                                {{ ucfirst($item->jenis ?? '-') }} • {{ $item->jumlah_orang ?? 1 }} orang
                                            </p>
                                        </td>

                                        <td class="px-3 py-3">
                                            <span class="inline-flex px-2 py-1 rounded-full text-[10px] font-black uppercase {{ $statusClass }}">
                                                {{ ucfirst($item->status ?? 'menunggu') }}
                                            </span>
                                        </td>

                                        <td class="px-3 py-3 text-center">
                                            <button type="button"
                                                    onclick="document.getElementById('detail-profile-jadwal-{{ $item->id }}').showModal()"
                                                    class="px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-xl text-[11px] font-black transition">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- MODAL DETAIL --}}
                                    <dialog id="detail-profile-jadwal-{{ $item->id }}"
                                            class="w-full max-w-lg p-0 rounded-2xl backdrop:bg-slate-900/50">
                                        <div class="bg-white rounded-2xl overflow-hidden shadow-xl">

                                            {{-- Header --}}
                                            <div class="bg-primary px-5 py-4 text-white flex items-start justify-between gap-4">
                                                <div class="min-w-0">
                                                    <p class="text-[10px] font-black uppercase tracking-[0.18em] text-blue-100">
                                                        Detail Janji Temu
                                                    </p>

                                                    <h2 class="text-lg font-black mt-1 truncate">
                                                        {{ $item->instansi_lembaga ?? '-' }}
                                                    </h2>

                                                    <p class="text-xs text-blue-100 mt-1">
                                                        {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('D MMMM Y') : 'Belum dijadwalkan' }}
                                                        @if($item->jam)
                                                            • {{ \Carbon\Carbon::parse($item->jam)->format('H:i') }} WIB
                                                        @endif
                                                    </p>
                                                </div>

                                                <form method="dialog">
                                                    <button type="submit"
                                                            class="w-8 h-8 rounded-full bg-white/15 hover:bg-white/25 text-white font-black flex items-center justify-center">
                                                        ✕
                                                    </button>
                                                </form>
                                            </div>

                                            {{-- Body --}}
                                            <div class="p-5 space-y-3">

                                                <div class="grid grid-cols-3 gap-2">
                                                    <div class="bg-slate-50 rounded-xl px-3 py-2">
                                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">
                                                            Jenis
                                                        </p>
                                                        <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-black uppercase {{ $jenisClass }}">
                                                            {{ ucfirst($item->jenis ?? '-') }}
                                                        </span>
                                                    </div>

                                                    <div class="bg-slate-50 rounded-xl px-3 py-2">
                                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">
                                                            Status
                                                        </p>
                                                        <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-black uppercase {{ $statusClass }}">
                                                            {{ ucfirst($item->status ?? 'menunggu') }}
                                                        </span>
                                                    </div>

                                                    <div class="bg-slate-50 rounded-xl px-3 py-2">
                                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">
                                                            Orang
                                                        </p>
                                                        <p class="text-xs font-black text-slate-800">
                                                            {{ $item->jumlah_orang ?? 1 }} orang
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                                    <div class="bg-blue-50 rounded-xl px-3 py-2">
                                                        <p class="text-[9px] font-black text-blue-700 uppercase tracking-widest mb-1">
                                                            Layanan
                                                        </p>

                                                        @if(count($layananList))
                                                            <div class="flex flex-wrap gap-1">
                                                                @foreach($layananList as $layanan)
                                                                    <span class="px-2 py-0.5 bg-white text-blue-700 rounded-md text-[10px] font-bold">
                                                                        {{ $layanan }}
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <span class="text-xs text-gray-400">-</span>
                                                        @endif
                                                    </div>

                                                    <div class="bg-green-50 rounded-xl px-3 py-2">
                                                        <p class="text-[9px] font-black text-green-700 uppercase tracking-widest mb-1">
                                                            Keperluan
                                                        </p>

                                                        @if(count($keperluanList))
                                                            <div class="flex flex-wrap gap-1">
                                                                @foreach($keperluanList as $keperluan)
                                                                    <span class="px-2 py-0.5 bg-white text-green-700 rounded-md text-[10px] font-bold">
                                                                        {{ $keperluan }}
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <span class="text-xs text-gray-400">-</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="bg-slate-50 rounded-xl px-3 py-2">
                                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">
                                                        Data yang Diminta
                                                    </p>

                                                    <p class="text-xs text-slate-700 leading-relaxed max-h-20 overflow-y-auto">
                                                        {{ $item->data_diminta ?? '-' }}
                                                    </p>
                                                </div>

                                                @if(($item->jenis ?? '') === 'online')
                                                    <div class="bg-indigo-50 rounded-xl px-3 py-2">
                                                        <p class="text-[9px] font-black text-indigo-700 uppercase tracking-widest mb-1">
                                                            Link Zoom
                                                        </p>

                                                        @if($item->zoom_link)
                                                            <a href="{{ $item->zoom_link }}"
                                                                target="_blank"
                                                                rel="noopener noreferrer"
                                                                class="inline-flex px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-xs font-bold transition">
                                                                Buka Zoom
                                                            </a>

                                                            <p class="text-[11px] text-indigo-700 mt-1 break-all">
                                                                {{ $item->zoom_link }}
                                                            </p>
                                                        @else
                                                            <p class="text-xs text-indigo-700">
                                                                Link Zoom belum tersedia.
                                                            </p>
                                                        @endif
                                                    </div>
                                                @endif

                                                @if($item->status === 'batal' && $item->alasan_batal)
                                                    <div class="bg-red-50 border border-red-100 rounded-xl px-3 py-2">
                                                        <p class="text-[9px] font-black text-red-600 uppercase tracking-widest mb-1">
                                                            Alasan Pembatalan
                                                        </p>

                                                        <p class="text-xs text-red-700 leading-relaxed max-h-20 overflow-y-auto">
                                                            {{ $item->alasan_batal }}
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </dialog>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <p class="text-xs text-gray-400 mt-3">
                        Tabel menampilkan jadwal terbaru. Klik "Lihat Semua" untuk melihat informasi lengkap.
                    </p>
                @else
                    <div class="bg-gray-50 border border-dashed border-gray-200 rounded-2xl p-6 text-center">
                        <h4 class="text-base font-black text-gray-800 mb-2">
                            Belum ada jadwal janji temu
                        </h4>

                        <p class="text-sm text-gray-500 mb-4">
                            Silakan buat janji temu terlebih dahulu.
                        </p>

                        <a href="{{ route('janjitemu.index') }}"
                            class="inline-flex bg-primary hover:bg-blue-800 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition">
                            Buat Janji Temu
                        </a>
                    </div>
                @endif
            </div>

            {{-- PANEL ANTREAN HARI INI --}}
            <div id="profileAntrianPanel" class="hidden profile-card rounded-3xl p-6 bg-white shadow">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
                    <div>
                        <h3 class="text-xl font-black text-gray-800">
                            Antrean Online Hari Ini
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Daftar nomor antrean online yang Anda ambil hari ini.
                        </p>
                    </div>

                    <a href="{{ route('antrian.index') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-xl text-sm font-bold transition">
                        Ambil Antrean
                    </a>
                </div>

                @if(isset($antrianHariIni) && $antrianHariIni->count())
                    <div class="rounded-2xl border border-gray-100 overflow-hidden max-h-[340px] overflow-y-auto">
                        <table class="w-full table-fixed text-xs sm:text-sm">
                            <thead class="sticky top-0 z-10">
                                <tr class="bg-blue-50 text-blue-900 border-b border-blue-100">
                                    <th class="w-[8%] px-3 py-3 text-left text-[10px] font-black uppercase tracking-widest">
                                        No
                                    </th>
                                    <th class="w-[22%] px-3 py-3 text-left text-[10px] font-black uppercase tracking-widest">
                                        Nomor
                                    </th>
                                    <th class="w-[30%] px-3 py-3 text-left text-[10px] font-black uppercase tracking-widest">
                                        Layanan
                                    </th>
                                    <th class="w-[22%] px-3 py-3 text-left text-[10px] font-black uppercase tracking-widest">
                                        Status
                                    </th>
                                    <th class="w-[18%] px-3 py-3 text-center text-[10px] font-black uppercase tracking-widest">
                                        Detail
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 bg-white">
                                @foreach($antrianHariIni as $item)
                                    @php
                                        $status = strtolower($item->status ?? 'pending');

                                        $labelStatus = [
                                            'pending' => 'Belum Datang',
                                            'printed' => 'Belum Dipanggil',
                                            'called' => 'Sedang Dilayani',
                                            'served' => 'Selesai',
                                            'expired' => 'Kedaluwarsa',
                                            'cancelled' => 'Dibatalkan',
                                        ];

                                        $statusClass = [
                                            'pending' => 'bg-yellow-100 text-yellow-700',
                                            'printed' => 'bg-blue-100 text-blue-700',
                                            'called' => 'bg-purple-100 text-purple-700',
                                            'served' => 'bg-green-100 text-green-700',
                                            'expired' => 'bg-gray-100 text-gray-700',
                                            'cancelled' => 'bg-red-100 text-red-700',
                                        ][$status] ?? 'bg-gray-100 text-gray-700';
                                    @endphp

                                    <tr class="hover:bg-blue-50/40 transition">
                                        <td class="px-3 py-3 text-gray-400 font-bold">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-3 py-3">
                                            <div class="inline-flex px-3 py-1.5 bg-blue-50 text-blue-700 rounded-xl border border-blue-100">
                                                <span class="text-base font-black">
                                                    {{ $item->nomor_antrian ?? '-' }}
                                                </span>
                                            </div>

                                            <p class="text-[11px] text-gray-400 mt-1">
                                                {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('H:i') . ' WIB' : '-' }}
                                            </p>
                                        </td>

                                        <td class="px-3 py-3">
                                            <p class="font-black text-gray-800 truncate">
                                                {{ $item->layanan->nama_layanan ?? '-' }}
                                            </p>

                                            <p class="text-[11px] text-gray-400 truncate mt-0.5">
                                                Kode {{ $item->layanan->kode_layanan ?? '-' }}
                                            </p>
                                        </td>

                                        <td class="px-3 py-3">
                                            <span class="inline-flex px-2 py-1 rounded-full text-[10px] font-black uppercase {{ $statusClass }}">
                                                {{ $labelStatus[$status] ?? 'Tidak Diketahui' }}
                                            </span>

                                            @if($status === 'pending')
                                                <p class="text-[10px] text-gray-400 mt-1">
                                                    Belum cetak di kantor
                                                </p>
                                            @elseif($status === 'printed')
                                                <p class="text-[10px] text-blue-500 mt-1">
                                                    Menunggu dipanggil
                                                </p>
                                            @elseif($status === 'called')
                                                <p class="text-[10px] text-purple-500 mt-1">
                                                    Meja: {{ $item->nomor_meja ?? '-' }}
                                                </p>
                                            @endif
                                        </td>

                                        <td class="px-3 py-3 text-center">
                                            <a href="{{ route('antrian.show', $item->kode_booking) }}"
                                            class="px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-xl text-[11px] font-black transition">
                                                Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <p class="text-xs text-gray-400 mt-3">
                        Nomor antrean online hanya berlaku pada hari pengambilan nomor.
                    </p>
                @else
                    <div class="bg-gray-50 border border-dashed border-gray-200 rounded-2xl p-6 text-center">
                        <h4 class="text-base font-black text-gray-800 mb-2">
                            Belum ada antrean hari ini
                        </h4>

                        <p class="text-sm text-gray-500 mb-4">
                            Anda belum mengambil nomor antrean online hari ini.
                        </p>

                        <a href="{{ route('antrian.index') }}"
                        class="inline-flex bg-primary hover:bg-blue-800 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition">
                            Ambil Antrean Online
                        </a>
                    </div>
                @endif
            </div>
      </div>
    </div>
  </main>
<script>
    function showProfileTab(tab) {
        const infoPanel = document.getElementById('profileInfoPanel');
        const jadwalPanel = document.getElementById('profileJadwalPanel');
        const antrianPanel = document.getElementById('profileAntrianPanel');

        const btnInfo = document.getElementById('btnInfoProfil');
        const btnJadwal = document.getElementById('btnJadwalProfil');
        const btnAntrian = document.getElementById('btnAntrianProfil');

        const inactiveClass = 'w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-4 rounded-xl flex items-center justify-center gap-2 text-sm font-bold transition';
        const activeClass = 'w-full bg-primary text-white py-3 px-4 rounded-xl flex items-center justify-center gap-2 text-sm font-bold transition';

        infoPanel.classList.add('hidden');
        jadwalPanel.classList.add('hidden');
        antrianPanel.classList.add('hidden');

        btnInfo.className = inactiveClass;
        btnJadwal.className = inactiveClass;
        btnAntrian.className = inactiveClass;

        if (tab === 'jadwal') {
            jadwalPanel.classList.remove('hidden');
            btnJadwal.className = activeClass;
        } else if (tab === 'antrian') {
            antrianPanel.classList.remove('hidden');
            btnAntrian.className = activeClass;
        } else {
            infoPanel.classList.remove('hidden');
            btnInfo.className = activeClass;
        }
    }
</script>
</body>
</html>
@endsection