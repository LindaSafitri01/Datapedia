<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>BPS User | Login</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    :root {
      --primary-color: #002B6A;
      --primary-light: #003d8a;
      --primary-dark: #001a3d;
    }

    .bg-primary {
      background-color: var(--primary-color);
    }

    .text-primary {
      color: var(--primary-color);
    }

    .border-primary {
      border-color: var(--primary-color);
    }

    .focus\:ring-primary:focus {
      --tw-ring-color: var(--primary-color);
    }

    .hover\:bg-primary\/90:hover {
      background-color: var(--primary-light);
    }

    .gradient-bg {
      background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
    }

    .card-shadow {
      box-shadow: 0 25px 50px -12px rgba(0, 43, 106, 0.25);
    }

    .input-focus:focus {
      transform: translateY(-1px);
      box-shadow: 0 10px 25px rgba(0, 43, 106, 0.1);
    }

    .floating-label {
      transition: all 0.3s ease;
    }

    .input-container:focus-within .floating-label {
      transform: translateY(-20px) scale(0.85);
      color: var(--primary-color);
    }

    .input-container.has-value .floating-label {
      transform: translateY(-20px) scale(0.85);
      color: var(--primary-color);
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .fade-in-up {
      animation: fadeInUp 0.6s ease-out;
    }

    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }

    .glass-effect {
      backdrop-filter: blur(20px);
      background: rgba(255, 255, 255, 0.95);
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 15px 35px rgba(0, 43, 106, 0.3);
    }

    .icon-bounce {
      animation: bounce 2s infinite;
    }

    @keyframes bounce {
      0%, 20%, 53%, 80%, 100% {
        animation-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1.000);
        transform: translate3d(0,0,0);
      }
      40%, 43% {
        animation-timing-function: cubic-bezier(0.755, 0.050, 0.855, 0.060);
        transform: translate3d(0, -8px, 0);
      }
      70% {
        animation-timing-function: cubic-bezier(0.755, 0.050, 0.855, 0.060);
        transform: translate3d(0, -4px, 0);
      }
      90% {
        transform: translate3d(0, -2px, 0);
      }
    }
  </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 flex items-center justify-center p-4">

  <main class="w-full max-w-5xl mx-auto rounded-3xl flex flex-col lg:flex-row card-shadow bg-white overflow-hidden">

    <!-- Right Section - Login Form -->
    <section class="w-full lg:w-1/2 glass-effect p-8 lg:p-12 flex flex-col justify-center">
      <form action="{{ route('prosesregisterUser') }}" method="POST" class="w-full max-w-md mx-auto">
        @csrf

        <!-- Error Messages -->
        @if($errors->has('invalid_no_hp') || $errors->has('invalid_nama'))
          <div class="bg-red-50 border-l-4 border-red-400 text-red-700 px-6 py-4 rounded-lg mb-6 fade-in-up">
            <div class="flex items-center">
              <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
              </svg>
              {{ $errors->first('invalid_no_hp') ?? $errors->first('invalid_nama') }}
            </div>
          </div>
        @endif

        <!-- Success Message -->
        @if (session('success'))
          <div class="bg-green-50 border-l-4 border-green-400 text-green-700 px-6 py-4 rounded-lg mb-6 fade-in-up">
            <div class="flex items-center">
              <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              {{ session('success') }}
            </div>
          </div>
        @endif

        <!-- Form Header -->
        <div class="text-center mb-8 fade-in-up delay-100">
          <h2 class="text-3xl font-bold text-gray-800 mb-2">Silahkan Buat Akun</h2>
          <p class="text-gray-600">Akses akun Anda dengan mudah</p>
        </div>

        <!-- Phone Number Input -->
        <div class="mb-6 fade-in-up delay-200">
          <label for="no_hp" class="block text-primary font-medium text-sm mb-2">Nomor Handphone</label>
          <div class="relative">
            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
              <span>+62</span>
            </div>
            <input type="number" name="no_hp" id="no_hp" placeholder="82178099027"
                   class="w-full py-4 px-12 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary focus:bg-white input-focus transition-all duration-300 text-gray-700"
                   >
          </div>
          @error('no_hp')
            <p class="text-red-500 text-sm mt-2 ml-1">{{ $message }}</p>
          @enderror
        </div>

      <!-- Email Input -->
        <div class="mb-6 fade-in-up delay-200">
          <label for="email" class="block text-primary font-medium text-sm mb-2">Email</label>
          <div class="relative">
            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
              <span>@</span>
            </div>
            <input type="email" name="email" id="email" placeholder="example@gmail.com"
                   class="w-full py-4 px-12 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary focus:bg-white input-focus transition-all duration-300 text-gray-700"
                   >
          </div>
          @error('email')
             <p class="text-red-500 text-sm mt-2 ml-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Username Input -->
        <div class="mb-8 fade-in-up delay-300">
          <label for="nama" class="block text-primary font-medium text-sm mb-2">Username </label>
          <div class="relative">
            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
              <img src="{{ asset('image/user.png') }}" width="20px" height="20px" alt="">
            </div>
            <input type="text" name="nama" id="nama" placeholder="Username"
                   class="w-full py-4 px-12 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary focus:bg-white input-focus transition-all duration-300 text-gray-700"
                   >
          </div>
          @error('nama')
            <p class="text-red-500 text-sm mt-2 ml-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Password Input -->
        <div class="mb-8 fade-in-up delay-300">
          <label for="password" class="block text-primary font-medium text-sm mb-2">Password</label>
          <div class="relative">
              {{-- Icon Kunci --}}
              <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                  </svg>
              </div>

              {{-- Input Password --}}
              <input type="password" name="password" id="password" placeholder="Password"
                    class="w-full py-4 px-12 pr-12 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary focus:bg-white input-focus transition-all duration-300 text-gray-700">

          </div>

          @error('password')
          <p class="text-red-500 text-sm mt-2 ml-1">{{ $message }}</p>
          @enderror
      </div>


        <!-- Login Button -->
        <button type="submit" class="w-full btn-primary py-4 rounded-xl text-white font-semibold text-lg mb-6 fade-in-up delay-400">
          <span class="flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Masuk
          </span>
        </button>

        <!-- Registration Link -->
        <div class="text-center fade-in-up delay-400">
          <p class="text-gray-600">
            Sudah Memiliki Akun?
            <a href="{{ route('loginUser') }}" class="text-primary hover:underline font-semibold ml-1 transition-colors duration-300">
              Kembali ke Halaman Login
            </a>
          </p>
        </div>
      </form>
    </section>

     <!-- Left Section - Welcome -->
    <section class="w-full lg:w-1/2 gradient-bg px-8 py-12 hidden lg:flex flex-col items-center justify-center relative overflow-hidden">
      <!-- Decorative circles -->
      <div class="absolute top-0 left-0 w-72 h-72 bg-white opacity-5 rounded-full -translate-x-36 -translate-y-36"></div>
      <div class="absolute bottom-0 right-0 w-96 h-96 bg-white opacity-5 rounded-full translate-x-48 translate-y-48"></div>

      <div class="relative text-center fade-in-up">
        <h1 class="text-white font-bold text-4xl lg:text-5xl mb-4">
          Selamat Datang
        </h1>
        <div class="w-20 h-1 bg-white mx-auto mb-6 rounded-full"></div>
        <p class="text-white/90 text-lg mb-8 max-w-xs">
          Masukkan Nomor Handphone Username dan Password Anda untuk melanjutkan
        </p>
        <div class="icon-bounce delay-300">
          <img src="{{ asset('image/registerUser.png') }}" alt="Login Illustration"
               class="h-64 lg:h-80 object-contain drop-shadow-2xl">
        </div>
      </div>
    </section>

  </main>

  <!-- Session Timeout Script -->
  @if (session('session_timeout'))
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      Swal.fire({
        icon: 'warning',
        title: 'Sesi Anda telah berakhir',
        text: 'Silakan login kembali untuk melanjutkan.',
        confirmButtonText: 'Login Ulang',
        allowOutsideClick: false,
        allowEscapeKey: false,
        confirmButtonColor: '#002B6A'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "{{ route('loginUser') }}";
        }
      });
    });
  </script>
  @endif

  <!-- Floating Label Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Remove the floating label functionality since we're using standard labels now
      console.log('Login form loaded');
    });
  </script>

  <script>
function togglePassword() {
    const input = document.getElementById("password");
    const icon = document.getElementById("eyeIcon");

    if (input.type === "password") {
        input.type = "text";
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956
                  9.956 0 012.174-3.362M15 12a3 3 0 00-3-3m3 3a3 3 0 11-3-3m0 0a3 3 0 00-3
                  3m0 0a3 3 0 003 3m0 0a3 3 0 003-3m-9.375 4.875L4.21 19.21m0 0l1.414-1.415M4.21
                  19.21L2 17M4.21 19.21L19.79 3.63"/>
        `;
    } else {
        input.type = "password";
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943
                  9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        `;
    }
}
</script>


</body>

</html>
