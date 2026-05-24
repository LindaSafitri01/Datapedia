@extends('layout.app')
@section('content')

<div class="user-page">
    <section class="relative min-h-screen py-12 md:py-16 overflow-hidden">

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="text-center max-w-3xl mx-auto mb-10">               
                <h1 class="text-3xl md:text-5xl font-black text-blue-950 leading-tight tracking-tight">
                    Sistem Antrian Online
                    <span class="text-blue-600">PST</span>
                </h1>

                <p class="text-sm md:text-base text-slate-500 mt-4 leading-relaxed">
                    Pilih jenis layanan PST yang anda butuhkan dan dapatkan pelayanan yang lebih cepat dan nyaman.
                </p>
            </div>

            {{-- Alert --}}
            @if(session('success'))
                <div class="max-w-3xl mx-auto mb-4 px-5 py-4 rounded-2xl bg-green-50 border border-green-100 text-green-700 text-sm font-bold shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('info'))
                <div class="max-w-3xl mx-auto mb-4 px-5 py-4 rounded-2xl bg-blue-50 border border-blue-100 text-blue-700 text-sm font-bold shadow-sm">
                    {{ session('info') }}
                </div>
            @endif

            {{-- Card Layanan --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 md:gap-6">
                @forelse($layanans as $layanan)
                    <form action="{{ route('antrian.store') }}" method="POST" class="h-full">
                        @csrf
                        <input type="hidden" name="layanan_antrian_id" value="{{ $layanan->id }}">

                        <button type="submit"
                                class="service-card theme-blue group w-full text-left min-h-[260px]">

                            {{-- Icon Layanan --}}
                            <div class="icon-box">
                                @switch(strtoupper($layanan->kode_layanan))
                                    @case('A')
                                        {{-- Perpustakaan --}}
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                                        </svg>
                                        @break

                                    @case('B')
                                        {{-- Konsultasi --}}
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.8L3 20l1.3-3.4A7.42 7.42 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        @break

                                    @case('C')
                                        {{-- Penjualan / Produk Statistik --}}
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 5h14M9 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z" />
                                        </svg>
                                        @break                                    

                                    @case('D')
                                        {{-- Rekomendasi --}}
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 12l2 2 4-4M7 4h10a2 2 0 012 2v14l-7-3-7 3V6a2 2 0 012-2z" />
                                        </svg>
                                        @break

                                    @default
                                        {{-- Default --}}
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                @endswitch
                            </div>

                            <p class="text-xs font-black uppercase tracking-widest text-blue-600 mb-2">
                                Layanan PST
                            </p>

                            <h3 class="text-xl font-black text-blue-950 mb-3 leading-tight">
                                {{ $layanan->nama_layanan }}
                            </h3>

                            <p class="text-sm text-slate-500 leading-relaxed mb-6">
                                Ambil nomor antrian online untuk layanan {{ $layanan->nama_layanan }}.
                            </p>

                            <span class="action-btn w-full">
                                <span>Ambil Nomor</span>

                                <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </span>
                        </button>
                    </form>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white border border-slate-200 rounded-3xl p-8 text-center shadow-sm">
                            <div class="mx-auto w-14 h-14 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center mb-4">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13 16h-1v-4h-1m1-4h.01M12 18a6 6 0 100-12 6 6 0 000 12z" />
                                </svg>
                            </div>

                            <h3 class="text-lg font-black text-blue-950">
                                Layanan antrian belum tersedia
                            </h3>

                            <p class="text-sm text-slate-500 mt-2">
                                Silakan hubungi admin untuk mengaktifkan layanan antrian.
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Catatan --}}
            <div class="mt-8 bg-white border border-blue-100 rounded-3xl p-5 md:p-6 shadow-sm">
                <div class="flex flex-col md:flex-row gap-4 md:items-start">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-4h.01M12 18a6 6 0 100-12 6 6 0 000 12z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-base font-black text-blue-950">
                            Catatan Pengambilan Antrian
                        </h3>

                        <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                            Nomor antrian online hanya berlaku pada hari pengambilan nomor. Pengunjung wajib mencetak kartu antrian di kantor sebelum nomor dapat dipanggil oleh petugas.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

@endsection