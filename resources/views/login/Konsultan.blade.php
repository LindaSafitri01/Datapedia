<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>BPS Konsultan | Login</title>
</head>

<body class="bg-blue-50 flex items-center justify-center py-20 overflow-hidden">

  <main class="w-11/12 max-w-6xl rounded-2xl flex flex-col-reverse lg:flex-row shadow-2xl bg-white overflow-hidden">

  <!-- Form Login -->
  <form action="{{ route('prosesloginKonsultan') }}" method="POST"
    class="w-full lg:w-1/2 px-6 md:px-12 py-10 flex flex-col justify-center">

    @csrf

    @if (session('success'))
      <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <h1 class="text-black font-bold text-2xl mb-6 text-center">Silahkan Login</h1>

    <!-- Email -->
    <div class="relative mb-4">
      <label for="email" class="text-black font-semibold text-sm mb-1 block">Email</label>
      <img src="{{ asset('image/email.png') }}" alt="email icon"
        class="absolute left-3 top-9 w-5 h-5">
      <input type="email" name="email" required placeholder="Masukkan Email"
        class="w-full py-2 px-11 rounded-lg border border-slate-300 focus:ring-2 focus:ring-primary focus:outline-none">
    </div>

    <!-- Password -->
    <div class="relative mb-4">
      <label for="password" class="text-black font-semibold text-sm mb-1 block">Kata Sandi</label>
      <img src="{{ asset('image/password.png') }}" alt="password icon"
        class="absolute left-3 top-9 w-5 h-5">
      <input type="password" name="password" id="passwordInput" required placeholder="Masukkan Kata Sandi"
        class="w-full py-2 px-11 rounded-lg border border-slate-300 focus:ring-2 focus:ring-primary focus:outline-none">
      <button type="button" id="togglePassword"
        class="absolute right-3 top-9 text-gray-400 hover:text-gray-600">
        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
      </button>
    </div>

    <!-- Tombol -->
    <button type="submit"
      class="w-full bg-primary py-2 rounded-xl text-white font-bold mt-5 hover:bg-primary-light duration-150">
      Masuk
    </button>

    <!-- Link Alternatif -->
    <div class="flex justify-center text-sm text-slate-600 font-semibold mt-5">
      <p class="mr-1">Bukan Konsultan?</p>
      <a href="{{ route('loginAdmin') }}" class="hover:underline text-primary">Kembali ke Admin</a>
    </div>

  </form>

    <section class="w-full lg:w-1/2 bg-primary px-6 py-10 flex flex-col items-center justify-center">
    <h1 class="text-white font-bold text-3xl text-center">Selamat Datang Konsultan</h1>
    <div class="text-white font-semibold text-sm mt-4 text-center">
      <p>Masukkan Email dan Password Anda</p>
      <p>Selamat Bekerja Tetap Semangat!!</p>
    </div>
    <img src="{{ asset('image/loginKonsultasi.png') }}" alt="Login Image"
      class="w-72 h-auto mt-10 object-contain">
  </section>
</main>


  <script>
    const passwordInput = document.getElementById('passwordInput');
    const togglePassword = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function() {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);

      if (type === 'text') {
        eyeIcon.setAttribute('stroke', 'blue');
      } else {
        eyeIcon.setAttribute('stroke', 'currentColor');
      }
    });
  </script>

</body>

</html>
