@extends('admin.layout')

@section('content')

<div class="min-h-screen bg-gray-100" style="width: 100%; overflow-x: hidden;">
    <main style="
        width: 100%;
        padding: 24px;
        margin-left: 0;
        box-sizing: border-box;
    ">

        <h2 class="text-3xl font-bold mb-6 text-gray-800">Overall Data</h2>

        <!-- Cards Container with Forced Grid -->
        <div id="dashboard-cards" style="
            display: grid !important;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)) !important;
            gap: 20px !important;
            width: 100% !important;
            max-width: none !important;
        ">

            <!-- Card 1: Admin -->
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-green-500" style="
                width: 100% !important;
                box-sizing: border-box !important;
                display: block !important;
                float: none !important;
            ">
            <a href="{{ route('dashboard.index') }}">

                <div class="flex items-center justify-between mb-2">
                    <div class="text-gray-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <div class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded-full">ADMIN</div>
                </div>
                <div class="text-4xl font-bold text-gray-800 counter" data-target="{{ $totalAdmin ?? '0' }}">0</div>
                <div class="text-sm text-gray-500 mt-1">Jumlah Admin</div>
            </a>
            </div>

            <!-- Card 2: User -->
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-blue-500" style="
                width: 100% !important;
                box-sizing: border-box !important;
                display: block !important;
                float: none !important;
            ">
            <a href="{{ route('dataUser') }}">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-gray-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-1 rounded-full">USERS</div>
                </div>
                <div class="text-4xl font-bold text-gray-800 counter" data-target="{{ $totalUser ?? '0' }}">0</div>
                <div class="text-sm text-gray-500 mt-1">Jumlah User</div>
            </a>
            </div>

            <!-- Card 3: Konsultan -->
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-pink-500" style="
                width: 100% !important;
                box-sizing: border-box !important;
                display: block !important;
                float: none !important;
            ">
            <a href="{{ route('konsultan.index') }}">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-gray-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="text-xs font-semibold text-pink-600 bg-pink-100 px-2 py-1 rounded-full">KONSULTAN</div>
                </div>
                <div class="text-4xl font-bold text-gray-800 counter" data-target="{{ $totalKonsultan ?? '0' }}">0</div>
                <div class="text-sm text-gray-500 mt-1">Jumlah Konsultan</div>
            </a>
            </div>

            <!-- Card 4: Petugas -->
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-orange-500" style="
                width: 100% !important;
                box-sizing: border-box !important;
                display: block !important;
                float: none !important;
            ">
            <a href="{{ route('petugas.index') }}">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-gray-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-xs font-semibold text-orange-600 bg-orange-100 px-2 py-1 rounded-full">PETUGAS</div>
                </div>
                <div class="text-4xl font-bold text-gray-800 counter" data-target="{{ $totalPetugas ?? '0' }}">0</div>
                <div class="text-sm text-gray-500 mt-1">Jumlah Petugas Hari Ini</div>
            </a>
            </div>

            <!-- Card 5: Jadwal -->
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-cyan-500" style="
                width: 100% !important;
                box-sizing: border-box !important;
                display: block !important;
                float: none !important;
            ">
            <a href="{{ route('jadwal.index') }}">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-gray-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="text-xs font-semibold text-cyan-600 bg-cyan-100 px-2 py-1 rounded-full">JADWAL</div>
                </div>
                <div class="text-4xl font-bold text-gray-800 counter" data-target="{{ $totalJadwal ?? '0' }}">0</div>
                <div class="text-sm text-gray-500 mt-1">Jumlah Jadwal Janji Temu</div>
            </a>
            </div>

            <!-- Card 6: Maklumat -->
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-purple-500" style="
                width: 100% !important;
                box-sizing: border-box !important;
                display: block !important;
                float: none !important;
            ">
            <a href="{{ route('maklumat.index') }}">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-gray-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                    <div class="text-xs font-semibold text-purple-600 bg-purple-100 px-2 py-1 rounded-full">MAKLUMAT</div>
                </div>
                <div class="text-4xl font-bold text-gray-800 counter" data-target="{{ $totalMaklumat ?? '0' }}">0</div>
                <div class="text-sm text-gray-500 mt-1">Jumlah Maklumat Layanan</div>
            </a>
            </div>


            <!-- Card 7: Standar -->
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-yellow-500" style="
                width: 100% !important;
                box-sizing: border-box !important;
                display: block !important;
                float: none !important;
            ">
            <a href="{{ route('standar.index') }}">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-gray-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-xs font-semibold text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full">STANDAR</div>
                </div>
                <div class="text-4xl font-bold text-gray-800 counter" data-target="{{ $totalStandar ?? '0' }}">0</div>
                <div class="text-sm text-gray-500 mt-1">Jumlah Standar Pelayanan</div>
            </a>
            </div>


            <!-- Card 8: Layanan -->
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-red-500" style="
                width: 100% !important;
                box-sizing: border-box !important;
                display: block !important;
                float: none !important;
            ">
            <a href="{{ route('layanan.index') }}">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-gray-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="text-xs font-semibold text-red-600 bg-red-100 px-2 py-1 rounded-full">24/7</div>
                </div>
                <div class="text-4xl font-bold text-gray-800 counter" data-target="{{ $totalLayanan ?? '0' }}">0</div>
                <div class="text-sm text-gray-500 mt-1">Jumlah Layanan 24 Jam</div>
            </a>
            </div>


            <!-- Card 9: FAQ -->
            <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-indigo-500" style="
                width: 100% !important;
                box-sizing: border-box !important;
                display: block !important;
                float: none !important;
            ">
            <a href="{{ route('faq.index') }}">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-gray-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-xs font-semibold text-indigo-600 bg-indigo-100 px-2 py-1 rounded-full">FAQ</div>
                </div>
                <div class="text-4xl font-bold text-gray-800 counter" data-target="{{ $totalFaq ?? '0' }}">0</div>
                <div class="text-sm text-gray-500 mt-1">Jumlah FAQ</div>
            </a>
            </div>

        </div>
    </main>
</div>

<script>
// Force grid layout with JavaScript as backup
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('dashboard-cards');
    if (container) {
        // Force grid styles
        container.style.display = 'grid';
        container.style.gridTemplateColumns = 'repeat(auto-fit, minmax(300px, 1fr))';
        container.style.gap = '20px';
        container.style.width = '100%';
        container.style.maxWidth = 'none';

        // Make sure all cards are block elements
        const cards = container.children;
        for (let i = 0; i < cards.length; i++) {
            cards[i].style.width = '100%';
            cards[i].style.display = 'block';
            cards[i].style.float = 'none';
            cards[i].style.boxSizing = 'border-box';
        }
    }

    // Counter Animation
    function animateCounter(element, target, duration = 2000) {
        const start = 0;
        const increment = target / (duration / 16); // 60fps
        let current = start;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = Math.ceil(target);
                clearInterval(timer);
            } else {
                element.textContent = Math.ceil(current);
            }
        }, 16);
    }

    // Enhanced counter animation with easing
    function animateCounterEased(element, target, duration = 2000) {
        const start = 0;
        const startTime = performance.now();

        function easeOutQuart(t) {
            return 1 - (--t) * t * t * t;
        }

        function updateCounter(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easedProgress = easeOutQuart(progress);
            const current = start + (target - start) * easedProgress;

            element.textContent = Math.floor(current);

            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target;
                // Add a small bounce effect when finished
                element.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    element.style.transform = 'scale(1)';
                }, 200);
            }
        }

        requestAnimationFrame(updateCounter);
    }

    // Initialize counters with staggered animation
    const counters = document.querySelectorAll('.counter');
    counters.forEach((counter, index) => {
        const target = parseInt(counter.getAttribute('data-target')) || 0;

        // Add CSS transition for smooth scaling
        counter.style.transition = 'transform 0.2s ease-out';

        // Stagger the start of each animation
        setTimeout(() => {
            // Add a subtle fade-in and scale effect for each card
            const card = counter.closest('.bg-white');
            if (card) {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';

                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            }

            // Start counter animation
            animateCounterEased(counter, target, 1500 + (index * 200));
        }, index * 150); // Stagger by 150ms
    });

    // Add hover effects to cards
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach(card => {
        card.style.transition = 'transform 0.2s ease-out, box-shadow 0.2s ease-out';

        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 10px 25px rgba(0,0,0,0.15)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '';
        });
    });
});
</script>

<style>
/* Additional CSS to ensure grid works */
#dashboard-cards {
    display: grid !important;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)) !important;
    gap: 20px !important;
    width: 100% !important;
    max-width: none !important;
}

#dashboard-cards > div {
    width: 100% !important;
    display: block !important;
    float: none !important;
    box-sizing: border-box !important;
}

/* Animation styles */
.counter {
    transition: transform 0.2s ease-out;
}

/* Card entrance animation */
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

.bg-white {
    animation: fadeInUp 0.6s ease-out;
}

/* Stagger the card animations */
.bg-white:nth-child(1) { animation-delay: 0s; }
.bg-white:nth-child(2) { animation-delay: 0.1s; }
.bg-white:nth-child(3) { animation-delay: 0.2s; }
.bg-white:nth-child(4) { animation-delay: 0.3s; }
.bg-white:nth-child(5) { animation-delay: 0.4s; }
.bg-white:nth-child(6) { animation-delay: 0.5s; }
.bg-white:nth-child(7) { animation-delay: 0.6s; }
.bg-white:nth-child(8) { animation-delay: 0.7s; }
.bg-white:nth-child(9) { animation-delay: 0.8s; }

/* Pulse effect for badges */
.rounded-full {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.8;
    }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    #dashboard-cards {
        grid-template-columns: 1fr !important;
        gap: 15px !important;
    }

    main {
        padding: 16px !important;
    }
}

@media (min-width: 769px) and (max-width: 1200px) {
    #dashboard-cards {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}

@media (min-width: 1201px) and (max-width: 1600px) {
    #dashboard-cards {
        grid-template-columns: repeat(3, 1fr) !important;
    }
}

@media (min-width: 1601px) {
    #dashboard-cards {
        grid-template-columns: repeat(4, 1fr) !important;
    }
}

/* Loading animation for counters */
.counter.loading {
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
    background-size: 200% 100%;
    animation: shimmer 1.5s infinite;
}

@keyframes shimmer {
    0% {
        background-position: -200% 0;
    }
    100% {
        background-position: 200% 0;
    }
}
</style>

@endsection
