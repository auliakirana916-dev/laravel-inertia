<?php

// Menentukan namespace controller autentikasi
namespace App\Http\Controllers\Auth;

// Mengimpor Controller utama Laravel
use App\Http\Controllers\Controller;

// Mengimpor RedirectResponse untuk mengembalikan respons redirect
use Illuminate\Http\RedirectResponse;

// Mengimpor Request untuk menangani permintaan dari pengguna
use Illuminate\Http\Request;

// Mengimpor Hash untuk mengenkripsi password sebelum disimpan ke database
use Illuminate\Support\Facades\Hash;

// Mengimpor Password untuk menerapkan aturan validasi password
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Memperbarui password pengguna.
     */
    public function update(Request $request): RedirectResponse
    {
        // Melakukan validasi terhadap password yang dimasukkan pengguna
        $validated = $request->validate([

            // Password lama wajib diisi dan harus sesuai
            // dengan password akun pengguna yang sedang login
            'current_password' => ['required', 'current_password'],

            // Password baru wajib diisi, harus memenuhi aturan keamanan
            // password bawaan Laravel, dan harus sama dengan
            // password_confirmation
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Memperbarui password pengguna yang sedang login
        $request->user()->update([

            // Mengenkripsi password baru menggunakan Hash::make()
            // sebelum disimpan ke dalam database
            'password' => Hash::make($validated['password']),
        ]);

        // Mengarahkan pengguna kembali ke halaman sebelumnya
        return back();
    }
}
