<?php

namespace App\Http\Controllers;

use App\Models\ManajemenMutu;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ManajemenMutuController extends Controller
{
    public function index()
    {
        $manajemenMutu = ManajemenMutu::latest()->get();

        return view('admin.manajemen-mutu.index', compact('manajemenMutu'));
    }

    public function create()
    {
        return view('admin.manajemen-mutu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|min:3|max:255',
            'kategori' => 'required|string|max:100',
            'file' => 'required|mimes:pdf,jpg,jpeg,png,gif|max:5120',
        ], [
            'judul.required' => 'Judul wajib diisi.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'file.required' => 'File wajib diunggah.',
            'file.mimes' => 'File harus berupa PDF, JPG, JPEG, PNG, atau GIF.',
            'file.max' => 'Ukuran file maksimal 5 MB.',
        ]);

        $filePath = $request->file('file')->store('manajemen-mutu', 'public');

        ManajemenMutu::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'file' => $filePath,
        ]);

        return redirect()
            ->route('manajemen-mutu.index')
            ->with('success', 'Manajemen Mutu berhasil ditambah.');
    }

    public function edit($id)
    {
        $manajemenMutu = ManajemenMutu::findOrFail($id);

        return view('admin.manajemen-mutu.edit', compact('manajemenMutu'));
    }

    public function update(Request $request, $id)
    {
        $manajemenMutu = ManajemenMutu::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|min:3|max:255',
            'kategori' => 'required|string|max:100',
            'file' => 'nullable|mimes:pdf,jpg,jpeg,png,gif|max:5120',
        ], [
            'judul.required' => 'Judul wajib diisi.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'file.mimes' => 'File harus berupa PDF, JPG, JPEG, PNG, atau GIF.',
            'file.max' => 'Ukuran file maksimal 5 MB.',
        ]);

        $data = [
            'judul' => $request->judul,
            'kategori' => $request->kategori,
        ];

        if ($request->hasFile('file')) {
            if ($manajemenMutu->file && Storage::disk('public')->exists($manajemenMutu->file)) {
                Storage::disk('public')->delete($manajemenMutu->file);
            }

            $filePath = $request->file('file')->store('manajemen-mutu', 'public');
            $data['file'] = $filePath;
        }

        $manajemenMutu->update($data);

        return redirect()
            ->route('manajemen-mutu.index')
            ->with('success', 'Manajemen Mutu berhasil diupdate.');
    }

    public function destroy($id)
    {
        $manajemenMutu = ManajemenMutu::findOrFail($id);

        if ($manajemenMutu->file && Storage::disk('public')->exists($manajemenMutu->file)) {
            Storage::disk('public')->delete($manajemenMutu->file);
        }

        $manajemenMutu->delete();

        return redirect()
            ->route('manajemen-mutu.index')
            ->with('success', 'Manajemen Mutu berhasil dihapus.');
    }
}