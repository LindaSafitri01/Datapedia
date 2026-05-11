<section id="home" class="gradient-hero relative overflow-hidden pt-28 sm:pt-32 lg:pt-0">

    <!-- Floating Orbs (diperkecil di mobile, bukan dihapus) -->
    <div class="floating-orb orb-1 opacity-40 sm:opacity-100"></div>
    <div class="floating-orb orb-2 opacity-40 sm:opacity-100"></div>
    <div class="floating-orb orb-3 opacity-40 sm:opacity-100"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-0 relative z-10">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center lg:min-h-screen">

            <!-- ================= LEFT ================= -->
            <div class="animate-fadeInUp space-y-5 text-center lg:text-left">

                <!-- Badge -->            
                <!-- <div class="hero-badge mx-auto lg:mx-0">
                    <span class="hero-badge-dot"></span>
                    <span class="hero-badge-text">
                        Platform Resmi BPS Kep. Bangka Belitung
                    </span>
                </div> -->
                <!-- Title -->
                <div>
                    <h1 class="hero-title text-3xl sm:text-4xl md:text-5xl lg:text-7xl">
                        DATAPEDIA
                    </h1>

                    <h2 class="hero-subtitle mt-3 text-lg sm:text-xl md:text-2xl lg:text-3xl">
                        <span class="block">Pelayanan Statistik Terpadu</span>
                        <span class="hero-subtitle-accent">
                            BPS Provinsi Kepulauan Bangka Belitung
                        </span>
                    </h2>

                    <p class="hero-description mt-3 text-sm sm:text-base md:text-lg lg:text-xl max-w-xl mx-auto lg:mx-0">
                        Selamat datang di Pelayanan Statistik Terpadu BPS Provinsi Kepulauan Bangka Belitung.
                        Temukan berbagai layanan statistik, konsultasi, dan informasi resmi dengan mudah.
                    </p>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center lg:justify-start">

                    @if(session('login_user') && session('user_id'))
                        <a href="{{ route('konsultasi.index') }}"
                           class="btn-modern flex items-center justify-center px-5 sm:px-6 py-3 rounded-xl text-white font-semibold group text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            Hubungi Kami
                        </a>
                    @else
                        <button onclick="showLoginAlert()"
                                class="btn-modern flex items-center justify-center px-5 sm:px-6 py-3 rounded-xl text-white font-semibold group text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            Hubungi Kami
                        </button>
                    @endif

                    <!-- <a href="#konsultasi"
                       class="site-btn-ghost px-5 sm:px-6 py-3 text-sm sm:text-base font-semibold group">
                        <span>Lihat Layanan</span>
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover:translate-x-1 transition"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5l7 7-7 7"/>
                        </svg>
                    </a> -->
                </div>
            </div>

            <!-- ================= RIGHT ================= -->
            <div class="animate-slideInRight flex justify-center">

                <div class="w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-xs space-y-4">

                    <!-- CARD 1 -->                    
                    <div class="hero-info-card p-4 text-center hover:scale-[1.02] transition relative">

                        <!-- <div class="hero-status-badge hero-status-badge-corner">
                            <span class="hero-status-dot"></span>
                            <span>ONLINE 24/7</span>
                        </div> -->

                        <img class="w-20 sm:w-24 md:w-28 mx-auto animate-float"
                            src="{{ asset('image/logo-pst.png') }}" alt="Datapedia Logo">

                        <p class="text-white font-semibold mt-2 text-sm sm:text-base">
                            Siap Membantu Anda
                        </p>
                    </div>

                    <!-- CARD 2 -->
                    <div class="relative group">
                        <div class="absolute inset-0 bg-blue-900/20 blur-xl rounded-2xl"></div>

                        <div class="hero-panel p-4 flex flex-col gap-3 transition hover:scale-[1.01]">

                            <div class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-10 h-10 bg-white/15 border border-white/20 rounded-full">
                                    <svg class="w-5 h-5 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-white">Jam Layanan</h3>
                            </div>

                            <div class="space-y-2 text-xs">
                                @forelse ($jamOperasional as $jam)
                                    <div class="hero-schedule-row">
                                        <span class="hero-schedule-label">{{ $jam->keterangan_hari }}</span>
                                        <span class="hero-schedule-time">
                                            {{ \Carbon\Carbon::parse($jam->jam_mulai)->format('H.i') }} -
                                            {{ \Carbon\Carbon::parse($jam->jam_selesai)->format('H.i') }}
                                        </span>
                                    </div>
                                @empty
                                    <div class="hero-schedule-label">
                                        <p>Informasi belum tersedia</p>
                                    </div>
                                @endforelse

                                <div class="pt-2 border-t border-white/15 text-center">
                                    <p class="hero-schedule-label italic">
                                        ✨ Tanpa Jeda Pelayanan
                                    </p>
                                </div>
                            </div>

                        </div>     
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Bottom Gradient -->
    <div class="absolute bottom-0 left-0 right-0 h-16 sm:h-20 bg-gradient-to-t from-primary to-transparent"></div>
</section>