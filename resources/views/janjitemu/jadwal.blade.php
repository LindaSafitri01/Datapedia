@extends('janjitemu.layout')
@section('content')

<!-- Tabel Janji Temu -->
<div class="w-full overflow-x-auto">
    <table class="min-w-[900px] border-collapse text-xs md:text-sm text-left w-full">
        <thead>
            <tr class="bg-blue-300 text-blue-900 text-center">
                <th class="p-3 border border-blue-400">Alamat</th>
                <th class="p-3 border border-blue-400">Keperluan</th>
                <th class="p-3 border border-blue-400">Tanggal</th>
                <th class="p-3 border border-blue-400">Jam</th>
                <th class="p-3 border border-blue-400">Jenis</th>
                <th class="p-3 border border-blue-400">Status</th>
                <th class="p-3 border border-blue-400">Edit Jadwal</th>
                <th class="p-3 border border-blue-400">Batalkan Jadwal</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($janjitemu as $item)
                <tr class="bg-white hover:bg-gray-50 text-center">
                    <td class="p-3 border">{{ $item->alamat }}</td>
                    <td class="p-3 border">{{ $item->keperluan }}</td>
                    <td class="p-3 border">{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('D MMMM Y') }}</td>
                    <td class="p-3 border">{{ $item->jam }}</td>
                    <td class="p-3 border">{{ ucfirst($item->jenis) }}</td>
                    <td class="p-3 border">
                        <span class="px-2 py-1 rounded text-white text-xs
                            {{ $item->status == 'menunggu' ? 'bg-yellow-500' : ($item->status == 'diterima' ? 'bg-green-600' : ($item->status == 'batal' ? 'bg-gray-600' : 'bg-red-500')) }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>

                    <td class="p-3 border">
                        @if ($item->status === 'menunggu')
                            <a href="{{ route('janjitemu.edit', $item->id) }}"
                               class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-1 rounded-lg text-sm">
                                Edit
                            </a>
                        @else
                            <span class="text-gray-400 italic text-sm">Tidak dapat diubah</span>
                        @endif
                    </td>

                    <td class="p-3 border">
                        @if ($item->status === 'menunggu' || $item->status === 'diterima')
                            <form action="{{ route('janjitemu.batal', $item->id) }}" method="POST" class="text-left">
                                @csrf
                                @method('PUT')
                                <textarea name="alasan_batal" required placeholder="Alasan pembatalan..."
                                    class="w-full text-sm p-1 border rounded mb-1 resize-none" rows="2"></textarea>
                                <button type="submit"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1 rounded">
                                    Batalkan
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400 italic text-sm">Sudah dibatalkan</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center p-4 text-xl text-gray-500">Belum ada jadwal tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination controls -->
    <div id="pagination-controls" class="flex justify-center mt-6 space-x-2"></div>
</div>


@endsection
