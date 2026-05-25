<?php

namespace App\Http\Controllers;

use App\Models\akunuser;
use App\Models\janjitemu;
use App\Models\Antrian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class profileController extends Controller
{
    public function index()
    {
        $userId = session('user_id');

        $user = akunuser::find($userId);

        if (!$user) {
            return redirect()->route('loginUser')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $jadwalUser = janjitemu::where('users_id', $userId)
            ->latest()
            ->take(3)
            ->get();

        $antrianHariIni = Antrian::with('layanan')
            ->where('user_id', $userId)
            ->whereDate('tanggal_antrian', now()->toDateString())
            ->latest()
            ->get();

        return view('user.profile', compact(
            'user',
            'jadwalUser',
            'antrianHariIni'
        ));
    }

    public function edit(string $id)
    {
        $userId = session('user_id');

        if ($userId != $id) {
            return redirect()->route('profile.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengubah profil ini.');
        }

        $user = akunuser::findOrFail($id);

        return view('user.editProfile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $userId = session('user_id');

        if ($userId != $id) {
            return redirect()->route('profile.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengubah profil ini.');
        }

        $user = akunuser::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'no_hp' => 'required|regex:/^62[0-9]{9,13}$/',
            'email' => [
                'required',
                'email',
                Rule::unique($user->getTable(), 'email')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:5',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.regex' => 'Nomor HP harus diawali 62 dan berisi 11 sampai 15 digit.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
            'password.min' => 'Password minimal 5 karakter.',
        ]);

        $user->nama = $request->nama;
        $user->no_hp = $request->no_hp;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('profile.index')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        //
    }
}