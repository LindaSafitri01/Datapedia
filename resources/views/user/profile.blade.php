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

  <nav class="w-full max-w-6xl mx-auto mb-8">
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
  </nav>

  <main class="w-full max-w-6xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

      <!-- Kartu Profil -->
      <div class="lg:col-span-1">
        <div class="profile-card rounded-3xl p-8 card-shadow bg-white">
          <div class="text-center mb-8">
            <div class="profile-avatar w-32 h-32 rounded-full mx-auto flex items-center justify-center mb-4 bg-primary">
              <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $user->nama ?? 'Nama tidak tersedia' }}</h2>
            <div class="status-badge text-white px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center bg-green-600">
              <div class="w-2 h-2 bg-white rounded-full mr-2"></div>
              Aktif
            </div>
          </div>
        </div>
      </div>

      <!-- Informasi Profil -->
      <div class="lg:col-span-2">
        <div class="profile-card rounded-3xl p-8 bg-white shadow">
          <h3 class="text-2xl font-bold text-gray-800 mb-6">Informasi Profil</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Username -->
            <div class="bg-gray-50 p-6 rounded-xl">
              <p class="text-sm font-medium text-gray-600 mb-1">Username</p>
              <p class="text-lg font-semibold text-gray-800">{{ $user->nama ?? '-' }}</p>
            </div>

            <!-- Nomor HP -->
            <div class="bg-gray-50 p-6 rounded-xl">
              <p class="text-sm font-medium text-gray-600 mb-1">Nomor Handphone</p>
              <p class="text-lg font-semibold text-gray-800">+{{ $user->no_hp ?? '-' }}</p>
            </div>

          </div>

          <!-- Tombol Aksi -->
          <div class="mt-8 grid grid-cols-1 gap-4">
            <a href="{{ route('profile.edit', $user->id) }}" class="bg-primary hover:bg-blue-800 text-white py-3 px-6 rounded-xl flex items-center justify-center gap-2">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Edit Profil</span>
            </a>

          </div>

          <div class="mt-8 grid grid-cols-1 gap-4">
            <a href="{{ route('index') }}" class="bg-primary hover:bg-blue-800 text-white py-3 px-6 rounded-xl flex items-center justify-center gap-2">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Kembali Halaman Beranda</span>
            </a>

          </div>
        </div>
      </div>
    </div>
  </main>

</body>
</html>
@endsection