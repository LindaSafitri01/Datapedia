@extends('jadwal.layout')
@section('content')

<div class="w-full p-6 bg-gray-100">
    <div class="w-full bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Judul -->
        <div class="bg-blue-400 p-4">
            <h2 class="text-xl font-bold text-blue-800">Data Janji Temu</h2>
        </div>

        <!-- Tabel Janji Temu -->
        <div class="mb-6 overflow-x-auto">
            <table class="min-w-full border-collapse text-sm text-left">
                <thead>
                    <tr class="bg-blue-300 text-blue-900">
                        <th class="p-3 border border-blue-400 text-center">Nama User</th>
                        <th class="p-3 border border-blue-400 text-center">No HP</th>
                        <th class="p-3 border border-blue-400 text-center">Alamat</th>
                        <th class="p-3 border border-blue-400 text-center">Keperluan</th>
                        <th class="p-3 border border-blue-400 text-center">Tanggal dan Jam</th>
                        <th class="p-3 border border-blue-400 text-center">Jenis Janji Temu</th>

                    </tr>
                </thead>
                <tbody>
    @forelse ($jadwals as $item)
        <tr class="bg-white hover:bg-gray-50 text-center">
            <td class="p-3 border">{{ $item->janjitemu->user->nama ?? '-' }}</td>
            <td class="p-3 border">{{ $item->janjitemu->user->no_hp ?? '-'}}</td>
            <td class="p-3 border">{{ $item->janjitemu->alamat }}</td>
            <td class="p-3 border">{{ $item->janjitemu->keperluan }}</td>
            <td class="p-3 border">{{ $item->janjitemu->tanggal }} Pada Pukul {{ $item->janjitemu->jam }}</td>
            <td class="p-3 border">{{ $item->janjitemu->jenis }} {{ $item->janjitemu->zoom_link }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center p-4 text-xl text-gray-500">Belum ada jadwal tersedia.</td>
        </tr>
    @endforelse
</tbody>

            </table>

            <!-- Pagination controls -->
            <div id="pagination-controls" class="flex justify-center mt-6 space-x-2"></div>
        </div>

        <!-- Daftar Konsultan & Status -->
        {{-- <div class="p-4">
            <h2 class="text-lg font-bold mb-3">Daftar Konsultan & Status</h2>
            @foreach($konsultans as $k)
                <div class="border p-3 mb-2 rounded bg-gray-100">
                    <p><strong>{{ $k->nama }}</strong> - Status: {{ ucfirst($k->status) }}</p>
                    @if($k->status === 'tidak tersedia' && $k->alasan)
                        <p><strong>Alasan:</strong> {{ $k->alasan }}</p>
                    @endif
                </div>
            @endforeach
        </div> --}}

    </div>
</div>

@endsection

