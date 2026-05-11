@extends('admin.layout')
@section('content')

{{-- 1. Wrapper utama dengan latar abu-abu untuk membingkai konten --}}
<div class="w-full p-6 bg-gray-100">
    {{-- 2. "Kartu" putih sebagai wadah utama konten --}}
    <div class="w-full bg-white rounded-lg shadow-md overflow-hidden">

        <div class="bg-blue-500 p-4">
            <h2 class="text-xl font-bold text-white">Data Janji Temu</h2>
        </div>

        {{-- 4. Wrapper untuk tabel agar ada padding dan bisa scroll di layar kecil --}}
        <div class="p-4 overflow-x-auto">
            <table class="min-w-full border-collapse text-sm text-left table-fixed">
                <thead>
                    <tr class="bg-blue-200 text-blue-800">
                        {{-- 5. Atur lebar setiap kolom agar proporsional --}}
                        <th class="p-3 border border-blue-300 text-center w-[4%]">No</th>
                        <th class="p-3 border border-blue-300 text-center w-[12%]">Nama User</th>
                        <th class="p-3 border border-blue-300 text-center w-[15%]">Keperluan</th>
                        <th class="p-3 border border-blue-300 text-center w-[13%]">Tanggal & Jam</th>
                        <th class="p-3 border border-blue-300 text-center w-[8%]">Jenis</th>
                        <th class="p-3 border border-blue-300 text-center w-[10%]">Status</th>
                        <th class="p-3 border border-blue-300 text-center w-[28%]">Aksi & Penjadwalan</th>
                        <th class="p-3 border border-blue-300 text-center w-[10%]">Link Zoom</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($janjiTemu as $index => $item)
                    <tr class="bg-white hover:bg-gray-50 text-center layanan-item-row">
                        <td class="p-3 border">{{ $loop->iteration }}</td>
                        <td class="p-3 border">{{ $item->user->nama ?? '-' }}</td>
                        <td class="p-3 border text-left">{{ $item->keperluan }}</td>
                        <td class="p-3 border">
                            @if($item->tanggal && $item->jam)
                                {{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMM Y') }}<br>
                                <span class="text-xs">Pukul: {{ $item->jam }}</span>
                            @else
                                <span class="italic text-gray-500">Belum diatur</span>
                            @endif
                        </td>
                        <td class="p-3 border">{{ ucfirst($item->jenis) }}</td>
                        <td class="p-3 border align-middle">
                            <span class="px-2 py-1 rounded text-white text-xs font-semibold
                                {{ $item->status == 'menunggu' ? 'bg-yellow-500' : ($item->status == 'diterima' ? 'bg-green-500' : 'bg-red-500') }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>

                        {{-- KOLOM AKSI & PENJADWALAN --}}
                        <td class="p-3 border align-top">
    @if($item->status === 'menunggu')
        {{-- FORM JIKA STATUS MASIH MENUNGGU --}}
        <form action="{{ route('jadwal.schedule', $item->id) }}" method="POST" class="mb-2">
            @csrf
            <div class="flex flex-col space-y-2">
                <select name="konsultan_id" class="border rounded p-1 text-sm w-full" required>
                    <option value="">Pilih Konsultan</option>
                    @foreach ($konsultans as $konsultan)
                        <option value="{{ $konsultan->id }}">{{ $konsultan->nama }}</option>
                    @endforeach
                </select>
                <input type="date" name="tanggal" class="border rounded p-1 text-sm w-full" value="{{ now()->format('Y-m-d') }}" required>
                <input type="time" name="jam" class="border rounded p-1 text-sm w-full" value="{{ now()->format('H:i') }}" required>
                <button type="submit" class="bg-blue-600 text-white px-3 py-1.5 rounded text-sm w-full hover:bg-blue-700">
                    Jadwalkan & Terima
                </button>
            </div>
        </form>
        {{-- Tombol Tolak --}}
        <form action="{{ route('jadwal.tolak', $item->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menolak janji temu ini?')">
            @csrf
            <button type="submit" class="w-full px-3 py-1.5 bg-gray-500 hover:bg-gray-600 text-white rounded text-sm">
                Tolak
            </button>
        </form>

    @else
        {{-- INFO & AKSI JIKA STATUS SUDAH DITERIMA/DITOLAK/BATAL --}}
        <div class="flex flex-col items-center space-y-2 text-sm">
            <div>
                Konsultan: <br>
                <strong class="font-semibold">{{ $item->jadwal->konsultan->nama ?? 'N/A' }}</strong>
            </div>

            {{-- Tombol Batalkan Jadwal (hanya muncul jika status diterima) --}}
            @if($item->jadwal && $item->status == 'diterima')
                <form action="{{ route('jadwal.batal', $item->jadwal->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin membatalkan jadwal ini? Status akan kembali ke Menunggu.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-yellow-900 rounded text-xs font-semibold">
                        Batalkan Jadwal
                    </button>
                </form>
            @endif

            {{-- Tombol Hapus Janji Temu (selalu muncul jika status bukan menunggu) --}}
            <form action="{{ route('jadwal.destroy', $item->id) }}" method="POST" onsubmit="return confirm('PERHATIAN: Anda akan MENGHAPUS janji temu ini selamanya. Lanjutkan?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded text-xs font-semibold">
                    Hapus Janji Temu
                </button>
            </form>
        </div>
    @endif
</td>

                        <td class="p-3 border align-middle">
                            @if($item->jenis === 'online' && $item->status === 'diterima')
                                <a href="{{ route('jadwal.zoom', $item->id) }}" class="bg-indigo-600 text-white px-3 py-1.5 rounded text-xs block hover:bg-indigo-700">
                                    Kirim Link
                                </a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
