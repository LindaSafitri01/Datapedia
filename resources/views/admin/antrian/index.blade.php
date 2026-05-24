@extends('admin.layout')
@section('content')

@php
    $labelStatus = [
        'pending' => 'Belum Datang',
        'printed' => 'Belum Dipanggil',
        'called' => 'Sedang Dilayani',
        'served' => 'Selesai Dilayani',
        'expired' => 'Kedaluwarsa',
        'cancelled' => 'Dibatalkan',
    ];

    $badgeStatus = [
        'pending' => 'bg-yellow-100 text-yellow-700',
        'printed' => 'bg-blue-100 text-blue-700',
        'called' => 'bg-purple-100 text-purple-700',
        'served' => 'bg-green-100 text-green-700',
        'expired' => 'bg-gray-100 text-gray-600',
        'cancelled' => 'bg-red-100 text-red-700',
    ];
@endphp

<div class="w-full p-6 bg-gray-100 min-h-screen">

    <div class="w-full bg-white rounded-lg shadow-md overflow-hidden">

        {{-- Header --}}
        <div class="bg-blue-600 p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div>
                <h2 class="text-xl font-bold text-white">
                    Kelola Antrean
                </h2>
                <p class="text-xs text-blue-100 mt-1">
                    Kelola antrean online, pilih meja, panggil nomor, dan selesaikan layanan.
                </p>
            </div>

            <form method="GET" action="{{ route('admin.antrian.index') }}" class="flex items-center gap-2">
                <input type="date"
                       name="tanggal"
                       value="{{ $tanggal }}"
                       class="rounded-lg border border-blue-200 px-3 py-2 text-xs font-semibold focus:outline-none">

                <button type="submit"
                        class="bg-white text-blue-700 px-3 py-2 rounded-lg text-xs font-bold hover:bg-blue-50">
                    Tampilkan
                </button>
            </form>
        </div>

        {{-- Alert --}}
        <div class="p-4 pb-0">
            @if(session('success'))
                <div class="mb-3 px-4 py-3 bg-green-50 border border-green-100 text-green-700 rounded-lg text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-3 px-4 py-3 bg-red-50 border border-red-100 text-red-700 rounded-lg text-sm font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-3 px-4 py-3 bg-red-50 border border-red-100 text-red-700 rounded-lg text-sm">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        {{-- Table --}}
        <div class="p-4 overflow-x-auto">
            <table class="min-w-[1100px] w-full border-collapse text-sm text-left">
                <thead>
                    <tr class="bg-blue-200 text-blue-800">
                        <th class="p-3 border border-blue-300 text-center w-[5%]">No</th>
                        <th class="p-3 border border-blue-300 text-center w-[12%]">Tanggal</th>
                        <th class="p-3 border border-blue-300 text-center w-[14%]">Nomor Antrean</th>
                        <th class="p-3 border border-blue-300 text-left w-[18%]">Jenis Layanan</th>
                        <th class="p-3 border border-blue-300 text-center w-[14%]">Status Antrean</th>
                        <th class="p-3 border border-blue-300 text-center w-[18%]">Pilih Meja</th>
                        <th class="p-3 border border-blue-300 text-center w-[9%]">Panggil</th>
                        <th class="p-3 border border-blue-300 text-center w-[10%]">Selesai Dilayani</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($antrians as $index => $antrian)
                        @php
                            $statusKey = $antrian->status ?? 'pending';
                            $statusText = $labelStatus[$statusKey] ?? 'Tidak Diketahui';
                            $statusClass = $badgeStatus[$statusKey] ?? 'bg-gray-100 text-gray-600';

                            $tanggalAntrian = $antrian->tanggal_antrian
                                ? \Carbon\Carbon::parse($antrian->tanggal_antrian)->format('d-m-Y')
                                : '-';

                            $jamAmbil = $antrian->created_at
                                ? \Carbon\Carbon::parse($antrian->created_at)->format('H:i')
                                : '-';
                        @endphp

                        <tr class="bg-white hover:bg-blue-50/40 text-center align-middle">

                            {{-- No --}}
                            <td class="p-3 border text-gray-500 font-semibold">
                                {{ $antrians->firstItem() + $index }}
                            </td>

                            {{-- Tanggal --}}
                            <td class="p-3 border">
                                <div class="font-bold text-gray-800">
                                    {{ $tanggalAntrian }}
                                </div>
                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $jamAmbil }} WIB
                                </div>
                            </td>

                            {{-- Nomor --}}
                            <td class="p-3 border">
                                <div class="inline-flex items-center justify-center px-4 py-2 bg-blue-50 text-blue-700 rounded-xl border border-blue-100">
                                    <span class="text-2xl font-black">
                                        {{ $antrian->nomor_antrian }}
                                    </span>
                                </div>
                            </td>

                            {{-- Layanan --}}
                            <td class="p-3 border text-left">
                                <div class="font-bold text-gray-800">
                                    {{ $antrian->layanan->nama_layanan ?? '-' }}
                                </div>

                                <div class="text-xs text-gray-500 mt-1">
                                    Kode {{ $antrian->layanan->kode_layanan ?? '-' }}
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="p-3 border">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusClass }}">
                                    {{ $statusText }}
                                </span>

                                @if($statusKey === 'pending')
                                    <form action="{{ route('admin.antrian.cetak', $antrian->id) }}"
                                          method="POST"
                                          class="mt-2">
                                        @csrf
                                        <button type="submit"
                                                class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-bold">
                                            Cetak / Hadir
                                        </button>
                                    </form>
                                @endif
                            </td>

                            {{-- Pilih Meja --}}
                            <td class="p-3 border">
                                @if($statusKey === 'printed')
                                    <div class="flex justify-center gap-2">
                                        <button type="button"
                                                onclick="pilihMeja('{{ $antrian->id }}', 'Meja 1', this)"
                                                class="meja-btn-{{ $antrian->id }} px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg text-xs font-bold">
                                            Meja 1
                                        </button>

                                        <button type="button"
                                                onclick="pilihMeja('{{ $antrian->id }}', 'Meja 2', this)"
                                                class="meja-btn-{{ $antrian->id }} px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg text-xs font-bold">
                                            Meja 2
                                        </button>

                                        <button type="button"
                                                onclick="pilihMeja('{{ $antrian->id }}', 'Meja 3', this)"
                                                class="meja-btn-{{ $antrian->id }} px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg text-xs font-bold">
                                            Meja 3
                                        </button>
                                    </div>
                                @elseif($statusKey === 'called' || $statusKey === 'served')
                                    <span class="px-3 py-1 rounded-lg bg-gray-100 text-gray-700 text-xs font-bold">
                                        {{ $antrian->nomor_meja ?? '-' }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-xs">
                                        Cetak dulu
                                    </span>
                                @endif
                            </td>

                            {{-- Panggil --}}
                            <td class="p-3 border">
                                @if($statusKey === 'printed')
                                    <form id="form-panggil-{{ $antrian->id }}"
                                        action="{{ route('admin.antrian.panggil', $antrian->id) }}"
                                        method="POST">
                                        @csrf

                                        <input type="hidden"
                                            name="nomor_meja"
                                            id="nomor_meja_{{ $antrian->id }}">

                                        <button type="submit"
                                                onclick="return cekMeja('{{ $antrian->id }}')"
                                                class="w-9 h-9 inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-bold"
                                                title="Panggil">
                                            🔊
                                        </button>
                                    </form>

                                @elseif($statusKey === 'called')
                                    <form action="{{ route('admin.antrian.panggil', $antrian->id) }}"
                                        method="POST">
                                        @csrf

                                        <button type="submit"
                                                class="px-3 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg text-xs font-bold"
                                                title="Panggil Ulang">
                                            🔊 Panggil Ulang
                                        </button>
                                    </form>

                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>

                            {{-- Selesai Dilayani --}}
                            <td class="p-3 border text-center align-middle">
                                @if($statusKey === 'called')
                                    <form action="{{ route('admin.antrian.selesai', $antrian->id) }}" method="POST">
                                        @csrf

                                        <button type="submit"
                                                onclick="return confirm('Apakah layanan untuk nomor antrean ini sudah selesai?')"
                                                class="inline-flex items-center justify-center gap-2 px-3 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-xs font-bold transition shadow-sm">
                                            <span class="text-sm">✓</span>
                                            <span>Selesai</span>
                                        </button>
                                    </form>

                                @elseif($statusKey === 'served')
                                    <div class="inline-flex items-center justify-center gap-2 px-3 py-1.5 bg-green-100 text-green-700 rounded-full text-xs font-bold border border-green-200">
                                        <span>✓</span>
                                        <span>Selesai Dilayani</span>
                                    </div>

                                @else
                                    <span class="inline-flex items-center justify-center px-3 py-1.5 bg-gray-100 text-gray-400 rounded-full text-xs font-semibold">
                                        -
                                    </span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-6 border text-center text-gray-500">
                                Belum ada data antrean.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="px-5 py-4 border-t border-slate-100">
                {{ $antrians->links() }}
            </div>
        </div>

    </div>
</div>

<script>
    function pilihMeja(id, meja, button) {
        document.getElementById('nomor_meja_' + id).value = meja;

        const buttons = document.querySelectorAll('.meja-btn-' + id);
        buttons.forEach(function(btn) {
            btn.classList.remove('bg-blue-600', 'text-white');
            btn.classList.add('bg-blue-100', 'text-blue-700');
        });

        button.classList.remove('bg-blue-100', 'text-blue-700');
        button.classList.add('bg-blue-600', 'text-white');
    }

    function cekMeja(id) {
        const meja = document.getElementById('nomor_meja_' + id).value;

        if (!meja) {
            alert('Silakan pilih meja terlebih dahulu.');
            return false;
        }

        return true;
    }
</script>

@if(session('called_text'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const text = @json(session('called_text'));

        function playSchoolBell(callback) {
            const AudioContext = window.AudioContext || window.webkitAudioContext;

            if (!AudioContext) {
                callback();
                return;
            }

            const audioCtx = new AudioContext();
            const now = audioCtx.currentTime;

            function ting(startTime) {
                const oscillator = audioCtx.createOscillator();
                const gain = audioCtx.createGain();

                oscillator.type = 'sine';
                oscillator.frequency.setValueAtTime(1500, startTime);

                gain.gain.setValueAtTime(0.001, startTime);
                gain.gain.exponentialRampToValueAtTime(0.35, startTime + 0.02);
                gain.gain.exponentialRampToValueAtTime(0.001, startTime + 0.25);

                oscillator.connect(gain);
                gain.connect(audioCtx.destination);

                oscillator.start(startTime);
                oscillator.stop(startTime + 0.28);
            }

            // Bell sekolah: ting ting ting ting
            ting(now);
            ting(now + 0.30);
            ting(now + 0.60);
            ting(now + 0.90);

            setTimeout(function () {
                callback();
            }, 1350);
        }

        function pilihVoice(callback) {
            let voices = window.speechSynthesis.getVoices();

            function cariVoice() {
                voices = window.speechSynthesis.getVoices();

                // Prioritas 1: suara Bahasa Indonesia
                let voice = voices.find(function (v) {
                    return v.lang && v.lang.toLowerCase().includes('id');
                });

                // Prioritas 2: suara Google / natural jika ada
                if (!voice) {
                    voice = voices.find(function (v) {
                        const name = v.name.toLowerCase();
                        return name.includes('google') || name.includes('natural');
                    });
                }

                // Prioritas 3: suara default browser
                if (!voice && voices.length > 0) {
                    voice = voices[0];
                }

                callback(voice);
            }

            if (voices.length > 0) {
                cariVoice();
            } else {
                window.speechSynthesis.onvoiceschanged = function () {
                    cariVoice();
                };
            }
        }

        function speak(text) {
            if (!('speechSynthesis' in window)) {
                alert(text);
                return;
            }

            window.speechSynthesis.cancel();

            pilihVoice(function (voice) {
                const utterance = new SpeechSynthesisUtterance(text);

                utterance.lang = 'id-ID';

                // Dibuat lebih ramah seperti suara antrean
                utterance.rate = 0.78;
                utterance.pitch = 1.05;
                utterance.volume = 1;

                if (voice) {
                    utterance.voice = voice;
                }

                window.speechSynthesis.speak(utterance);
            });
        }

        setTimeout(function () {
            playSchoolBell(function () {
                speak(text);
            });
        }, 300);
    });
</script>
@endif

@endsection