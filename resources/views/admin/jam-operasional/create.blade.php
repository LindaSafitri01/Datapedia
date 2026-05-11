@extends('admin.layout')
@section('content')

<div class="w-full p-6 bg-gray-100 min-h-screen">
    <div class="w-full  bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-300 p-4">
            <h2 class="text-xl font-bold text-blue-800">Buat Layanan 24 Jam</h2>
        </div>

        <form method="POST" action="{{ route('jam-operasional.store') }}" class="p-6">
            @csrf

            <div class="mb-4">
                <label for="keterangan_hari" class="block text-gray-700 font-medium mb-2">Keterangan Hari</label>
                <input type="text" name="keterangan_hari" placeholder="Masukkan keterangan_hari" id="keterangan_hari" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300" value="{{ old('keterangan_hari') }}" required>
                    @error('keterangan_hari')

                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

            </div>

            <div class="mb-4">
                <label for="jam_mulai" class="block text-gray-700 font-medium mb-2">Jam Mulai</label>
                <input type="time" name="jam_mulai" placeholder="Masukkan jam_mulai" id="jam_mulai" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300" value="{{ old('jam_mulai') }}" required>
                    @error('jam_mulai')

                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

            </div>

            <div class="mb-4">
                <label for="jam_selesai" class="block text-gray-700 font-medium mb-2">Jam Selesai</label>
                <input type="time" name="jam_selesai" placeholder="Masukkan jam_selesai Layanan" id="jam_selesai" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300" value="{{ old('jam_selesai') }}" required>
                    @error('jam_selesai')

                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="px-6 py-2 bg-blue-300 hover:bg-blue-400 text-blue-800 font-medium rounded-lg">Buat</button>

            </div>
        </form>
    </div>
</div>
@endsection
