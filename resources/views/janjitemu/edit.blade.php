@extends('janjitemu.layout')
@section('content')

<div class="w-full p-6 bg-gray-100 min-h-screen">
    <div class="w-full  bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-300 p-4">
            <h2 class="text-xl font-bold text-blue-800">Informasi Jadwal Janji Temu</h2>
        </div>

        <form method="POST" action="{{ route('janjitemu.update',$janjitemu->id) }}" class="p-6">
            @method('PUT')
            @csrf
            <div class="mb-4">
                <label for="alamat" class="block text-gray-700 font-medium mb-2">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300" value="{{ $janjitemu->alamat }}">

                    <p class="text-red-500 text-sm mt-1"></p>

            </div>

            <div class="mb-4">
                <label for="keperluan" class="block text-gray-700 font-medium mb-2">Keperluan</label>
                <input type="keperluan" name="keperluan" id="keperluan" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300" value="{{ $janjitemu->keperluan }}">

                    <p class="text-red-500 text-sm mt-1"></p>

            </div>

            <div class="mb-4">
                <label for="tanggal" class="block text-gray-700 font-medium mb-2">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300"  value="{{ \Carbon\Carbon::parse($janjitemu->tanggal)->format('Y-m-d') }}"
                min="{{ date('Y-m-d') }}">

                    <p class="text-red-500 text-sm mt-1"></p>

            </div>

            <div class="mb-4">
            <label for="jam" class="form-label">Jam </label>
            <input type="time" name="jam" id="jam" class="form-control"
                   value="{{ old('jam', \Carbon\Carbon::parse($janjitemu->jam)->format('H:i')) }}">
             </div>

            <div class="mb-4">
                <label for="jenis" class="form-label">Jenis Konsultasi</label>
                <select name="jenis" id="jenis" class="form-control">
                    <option value="online" {{ old('jenis', $janjitemu->jenis) == 'online' ? 'selected' : '' }}>Online</option>
                    <option value="offline" {{ old('jenis', $janjitemu->jenis) == 'offline' ? 'selected' : '' }}>Offline</option>
                </select>
                @error('jenis')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="px-6 py-2 bg-blue-300 hover:bg-blue-400 text-blue-800 font-medium rounded-lg">Ubah</button>

            </div>
        </form>
    </div>
</div>
@endsection
