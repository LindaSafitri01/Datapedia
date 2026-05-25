@extends('layout.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-8 px-4">
    
    <main class="w-full max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Kartu Profil --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                    <div class="text-center">
                        <div class="w-24 h-24 rounded-full mx-auto flex items-center justify-center mb-4 bg-primary text-white shadow-sm">
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

                        <p class="text-sm text-gray-500 mt-1 truncate">
                            {{ $user->email ?? '-' }}
                        </p>

                        <div class="mt-4 inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-black">
                            <span class="w-2 h-2 rounded-full bg-green-600"></span>
                            Aktif
                        </div>
                    </div>

                    <div class="mt-6 border-t border-gray-100 pt-5 space-y-3">
                        <div class="bg-blue-50 rounded-2xl p-4">
                            <p class="text-[10px] font-black uppercase tracking-widest text-blue-600">
                                Nomor HP
                            </p>
                            <p class="text-sm font-bold text-gray-800 mt-1">
                                +{{ $user->no_hp ?? '-' }}
                            </p>
                        </div>

                        <a href="{{ route('profile.index') }}"
                           class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-sm font-black transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M15 19l-7-7 7-7" />
                            </svg>
                            Kembali ke Profil
                        </a>
                    </div>
                </div>
            </div>

            {{-- Form Edit Profil --}}
            <form method="POST"
                  action="{{ route('profile.update', $user->id) }}"
                  class="lg:col-span-2">
                @csrf
                @method('PUT')

                <div class="bg-white rounded-3xl p-5 md:p-6 shadow-sm border border-gray-100">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
                        <div>
                            <h3 class="text-xl font-black text-gray-800">
                                Form Edit Profil
                            </h3>
                        </div>
                    </div>

                    @if($errors->any())
                        <div class="mb-5 bg-red-50 border border-red-100 text-red-700 rounded-2xl px-4 py-3 text-sm">
                            <p class="font-black mb-1">Terdapat kesalahan input:</p>
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Username --}}
                        <div>
                            <label for="nama" class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">
                                Username
                            </label>

                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>

                                <input type="text"
                                       name="nama"
                                       id="nama"
                                       value="{{ old('nama', $user->nama) }}"
                                       class="w-full pl-10 pr-4 py-3 rounded-2xl border border-gray-200 bg-gray-50 text-sm font-bold text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Masukkan username">
                            </div>
                        </div>

                        {{-- Nomor HP --}}
                        <div>
                            <label for="no_hp" class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">
                                Nomor Handphone
                            </label>

                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.68l1.2 3.6a1 1 0 01-.27 1.03l-1.7 1.7a16 16 0 006.36 6.36l1.7-1.7a1 1 0 011.03-.27l3.6 1.2a1 1 0 01.68.95V19a2 2 0 01-2 2h-1C10.16 21 3 13.84 3 5z" />
                                    </svg>
                                </span>

                                <input type="text"
                                       name="no_hp"
                                       id="no_hp"
                                       value="{{ old('no_hp', $user->no_hp) }}"
                                       class="w-full pl-10 pr-4 py-3 rounded-2xl border border-gray-200 bg-gray-50 text-sm font-bold text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Contoh: 6281234567890">
                            </div>

                            <p class="text-[11px] text-gray-400 mt-1">
                                Gunakan format 62, contoh: 6281234567890.
                            </p>
                        </div>

                        {{-- Email --}}
                        <div class="md:col-span-2">
                            <label for="email" class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">
                                Email
                            </label>

                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 8h18a2 2 0 002-2V8a2 2 0 00-2-2H3a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                    </svg>
                                </span>

                                <input type="email"
                                       name="email"
                                       id="email"
                                       value="{{ old('email', $user->email) }}"
                                       class="w-full pl-10 pr-4 py-3 rounded-2xl border border-gray-200 bg-gray-50 text-sm font-bold text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Masukkan email aktif">
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="md:col-span-2">
                            <label for="password" class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">
                                Password Baru
                            </label>

                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M12 11c1.104 0 2-.896 2-2V7a2 2 0 10-4 0v2c0 1.104.896 2 2 2zm6 0h-1V9a5 5 0 00-10 0v2H6a2 2 0 00-2 2v7a2 2 0 002 2h12a2 2 0 002-2v-7a2 2 0 00-2-2z" />
                                    </svg>
                                </span>

                                <input type="password"
                                       name="password"
                                       id="password"
                                       class="w-full pl-10 pr-4 py-3 rounded-2xl border border-gray-200 bg-gray-50 text-sm font-bold text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Kosongkan jika tidak ingin mengganti password">
                            </div>
                        </div>

                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="mt-6 flex flex-col sm:flex-row sm:justify-end gap-3">
                        <a href="{{ route('profile.index') }}"
                           class="inline-flex items-center justify-center px-5 py-3 rounded-2xl bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-black transition">
                            Batal
                        </a>

                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-blue-800 hover:bg-blue-900 text-white text-sm font-black transition shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </main>
</div>

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Oke',
                confirmButtonColor: '#1e40af'
            });
        });
    </script>
@endif

@endsection