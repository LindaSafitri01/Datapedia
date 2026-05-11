@extends('admin.layout') {{-- atau layout kamu --}}
@section('content')

<div class="max-w-2xl mx-auto mt-8 bg-white rounded-2xl shadow-md p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Kirim Link Zoom Janji Temu</h2>

    <form action="{{ route('jadwal.kirimZoom', $janjiTemu->id) }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Nama</label>
            <div class="mt-1 bg-gray-100 border border-gray-200 rounded px-3 py-2 text-gray-800">
                {{ $janjiTemu->user->nama }}
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal & Jam</label>
            <div class="mt-1 bg-gray-100 border border-gray-200 rounded px-3 py-2 text-gray-800">
                {{ $janjiTemu->tanggal }} pukul {{ $janjiTemu->jam }}
            </div>
        </div>

        <div>
            <label for="link_zoom" class="block text-sm font-medium text-gray-700">Link Zoom <span class="text-red-500">*</span></label>
            <input
                type="url"
                id="link_zoom"
                name="link_zoom"
                required
                placeholder="https://zoom.us/j/xxxxxx"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500"
            >
        </div>

        <div class="pt-4">
            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200"
            >
                Kirim ke WhatsApp
            </button>
        </div>
    </form>
</div>

@endsection
