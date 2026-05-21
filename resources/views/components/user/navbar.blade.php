<nav id="navbar" class="site-navbar navbar-sticky glass-nav">
    <div class="site-navbar-container">
        <div class="site-navbar-row">

            {{-- Logo Section --}}
            <div class="site-navbar-brand">
                <div class="site-navbar-logo">
                    <img src="{{ asset('image/logo-pst.png') }}" alt="Datapedia Logo">
                </div>

                <div class="site-navbar-text">
                    <h1 class="site-navbar-title">
                        DATA<span>PEDIA</span>
                    </h1>
                    <p class="site-navbar-tagline">
                        BPS Provinsi Kepulauan Bangka Belitung
                    </p>
                </div>
            </div>

            {{-- Desktop Navigation --}}
            <div class="site-navbar-desktop">
                <nav class="site-navbar-menu">
                    <a href="{{ route('tentang') }}" class="site-navbar-link">
                        Tentang
                    </a>

                    <a href="{{ url('/') }}#layanan" class="site-navbar-link">
                        Layanan
                    </a>

                    <a href="{{ url('/') }}#konsultasi" class="site-navbar-link">
                        Akses
                    </a>

                    @if(session('login_user') && session('user_id'))
                        <a href="{{ route('profile.index') }}" class="site-navbar-link">
                            Profil
                        </a>
                    @else
                        <button type="button" onclick="showLoginAlert()" class="site-navbar-link">
                            Profil
                        </button>
                    @endif
                </nav>

                <div class="site-navbar-auth">
                    @if(session('login_user') && session('user_id'))
                        <form action="{{ route('logoutUser') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="site-navbar-logout" onmouseenter="speakOnHover(this)">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('loginUser') }}" class="site-navbar-login">
                            Login
                        </a>
                    @endif
                </div>
            </div>

            {{-- Mobile Menu Button --}}
            <div class="site-navbar-mobile-toggle-wrap">
                <button id="mobile-menu-btn" class="site-navbar-mobile-btn" type="button" aria-label="Buka menu navigasi">
                    <svg id="menu-icon" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu Container --}}
        <div id="mobile-menu" class="hidden site-navbar-mobile-panel">
            <div class="site-navbar-mobile-card">
                <div class="site-navbar-mobile-list">
                    <a href="{{ route('tentang') }}" class="site-navbar-mobile-link">
                        Tentang
                    </a>

                    <a href="{{ url('/') }}#layanan" class="site-navbar-mobile-link">
                        Layanan
                    </a>

                    <a href="{{ url('/') }}#konsultasi" class="site-navbar-mobile-link">
                        Akses
                    </a>

                    <div class="site-navbar-mobile-divider"></div>

                    @if(session('login_user') && session('user_id'))
                        <a href="{{ route('profile.index') }}" class="site-navbar-mobile-link">
                            Profil
                        </a>

                        <form action="{{ route('logoutUser') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="site-navbar-mobile-logout">
                                Logout
                            </button>
                        </form>
                    @else
                        <button type="button" onclick="showLoginAlert()" class="site-navbar-mobile-link">
                            Profil
                        </button>

                        <a href="{{ route('loginUser') }}" class="site-navbar-mobile-login">
                            Login
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    const menuBtn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const icon = document.getElementById('menu-icon');

    menuBtn.addEventListener('click', () => {
        const isHidden = menu.classList.contains('hidden');

        if (isHidden) {
            menu.classList.remove('hidden');
            icon.style.transform = 'rotate(90deg)';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
        } else {
            menu.classList.add('hidden');
            icon.style.transform = 'rotate(0deg)';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>';
        }
    });

    // Effect saat scroll
    window.addEventListener('scroll', () => {
        const nav = document.getElementById('navbar');

        if (window.scrollY > 20) {
            nav.classList.add('py-1', 'bg-slate-950/80');
            nav.classList.remove('py-0', 'bg-slate-950/40');
        } else {
            nav.classList.add('py-0', 'bg-slate-950/40');
            nav.classList.remove('py-1', 'bg-slate-950/80');
        }
    });
</script>
