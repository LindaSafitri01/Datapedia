@extends('admin.layout')
@section('content')

@php
    $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);

    $namaBulan = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];
@endphp

<div class="w-full p-6 bg-gray-100 min-h-screen">

    <div class="w-full bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100">

        {{-- Header --}}
        <div class="bg-blue-600 p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-xl font-black text-white">
                    Riwayat Antrean
                </h2>
                <p class="text-xs text-blue-100 mt-1">
                    Rekap antrean online per layanan.
                </p>
            </div>

            <form method="GET"
                action="{{ route('admin.antrian.riwayat') }}"
                class="flex flex-wrap items-center gap-2 bg-white/10 rounded-xl p-2">

                <select name="bulan"
                        class="h-10 min-w-[135px] rounded-lg border-2 border-blue-100 bg-white px-3 text-xs font-bold text-gray-700 focus:outline-none focus:border-blue-300">
                    @foreach($namaBulan as $kode => $nama)
                        <option value="{{ $kode }}" {{ $bulan == $kode ? 'selected' : '' }}>
                            {{ $nama }}
                        </option>
                    @endforeach
                </select>

                <select name="tahun"
                        class="h-10 min-w-[95px] rounded-lg border-2 border-blue-100 bg-white px-3 text-xs font-bold text-gray-700 focus:outline-none focus:border-blue-300">
                    @for($y = now()->year; $y >= now()->year - 5; $y--)
                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>

                <button type="submit"
                        class="h-10 px-4 bg-white text-blue-700 border-2 border-blue-100 rounded-lg text-xs font-black hover:bg-blue-50 hover:border-blue-200 transition">
                    Tampilkan
                </button>
            </form>
        </div>

        {{-- Periode --}}
        <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
            <p class="text-sm font-bold text-gray-700">
                Periode: {{ $namaBulan[$bulan] ?? $bulan }} {{ $tahun }}
            </p>
        </div>

        {{-- Table --}}
        <div class="p-4 overflow-x-auto">
            <table class="min-w-[800px] w-full border-collapse text-sm text-left">
                <thead>
                    <tr class="bg-blue-200 text-blue-800">
                        <th class="p-3 border border-blue-300 text-center w-[7%]">
                            No
                        </th>
                        <th class="p-3 border border-blue-300 text-center w-[10%]">
                            Kode
                        </th>
                        <th class="p-3 border border-blue-300 text-left w-[35%]">
                            Jenis Layanan
                        </th>
                        <th class="p-3 border border-blue-300 text-center w-[18%]">
                            Ambil Antrean Online
                        </th>
                        <th class="p-3 border border-blue-300 text-center w-[15%]">
                            Dilayani
                        </th>
                        <th class="p-3 border border-blue-300 text-center w-[15%]">
                            Persentase
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($layanans as $index => $layanan)
                        @php
                            $persentase = $layanan->total_online > 0
                                ? ($layanan->total_dilayani / $layanan->total_online) * 100
                                : 0;
                        @endphp

                        <tr class="bg-white hover:bg-blue-50/50 align-middle transition">
                            <td class="p-3 border text-center text-gray-500 font-bold">
                                {{ $index + 1 }}
                            </td>

                            <td class="p-3 border text-center">
                                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-blue-50 text-blue-700 font-black border border-blue-100">
                                    {{ $layanan->kode_layanan }}
                                </span>
                            </td>

                            <td class="p-3 border">
                                <div class="font-black text-gray-800">
                                    {{ $layanan->nama_layanan }}
                                </div>
                            </td>

                            <td class="p-3 border text-center">
                                <span class="text-base font-black text-gray-800">
                                    {{ number_format($layanan->total_online, 0, ',', '.') }}
                                </span>
                            </td>

                            <td class="p-3 border text-center">
                                <span class="text-base font-black text-green-700">
                                    {{ number_format($layanan->total_dilayani, 0, ',', '.') }}
                                </span>
                            </td>

                            <td class="p-3 border text-center">
                                <span class="inline-flex px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-black border border-blue-100">
                                    {{ number_format($persentase, 1, ',', '.') }}%
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 border text-center text-gray-500">
                                Belum ada data riwayat antrean.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection