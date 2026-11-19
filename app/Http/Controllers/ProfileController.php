<?php

// Menentukan namespace controller utama aplikasi
namespace App\Http\Controllers;

// Mengimpor ProfileUpdateRequest untuk menangani validasi perubahan profil pengguna
use App\Http\Requests\ProfileUpdateRequest;

// Mengimpor MustVerifyEmail untuk memeriksa apakah pengguna wajib
// melakukan verifikasi email
use Illuminate\Contracts\Auth\MustVerifyEmail;

// Mengimpor RedirectResponse untuk mengembalikan respons pengalihan halaman
use Illuminate\Http\RedirectResponse;

// Mengimpor Request untuk menangani permintaan dari pengguna
use Illuminate\Http\Request;

// Mengimpor Auth untuk mengelola proses autentikasi pengguna
use Illuminate\Support\Facades\Auth;

// Mengimpor Redirect untuk melakukan pengalihan halaman
use Illuminate\Support\Facades\Redirect;

// Mengimpor Inertia untuk menghubungkan backend Laravel dengan frontend
use Inertia\Inertia;

// Mengimpor Response sebagai tipe data respons Inertia
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman formulir profil pengguna.
     */
    public function edit(Request $request): Response
    {
        // Menampilkan halaman Profile/Edit menggunakan Inertia
        return Inertia::render('Profile/Edit', [

            // Memeriksa apakah pengguna menggunakan fitur
            // verifikasi email melalui interface MustVerifyEmail
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,

            // Mengambil pesan status dari session,
            // misalnya pemberitahuan bahwa profil berhasil diperbarui
            'status' => session('status'),
        ]);
    }

    /**
     * Memperbarui informasi profil pengguna.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Mengisi data pengguna dengan data yang sudah divalidasi
        // melalui ProfileUpdateRequest
        $request->user()->fill($request->validated());

        // Memeriksa apakah terdapat perubahan pada alamat email pengguna
        if ($request->user()->isDirty('email')) {

            // Jika email berubah, kosongkan waktu verifikasi email
            // agar pengguna harus melakukan verifikasi email kembali
            $request->user()->email_verified_at = null;
        }

        // Menyimpan perubahan data profil pengguna ke database
        $request->user()->save();

        // Mengarahkan pengguna kembali ke halaman edit profil
        return Redirect::route('profile.edit');
    }

    /**
     * Menghapus akun pengguna.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Melakukan validasi password sebelum akun dihapus
        $request->validate([

            // Password wajib diisi dan harus sesuai dengan
            // password akun pengguna yang sedang login
            'password' => ['required', 'current_password'],
        ]);

        // Mengambil data pengguna yang sedang login
        $user = $request->user();

        // Mengeluarkan pengguna dari sistem (logout)
        Auth::logout();

        // Menghapus akun pengguna dari database
        $user->delete();

        // Menghapus seluruh data session pengguna
        $request->session()->invalidate();

        // Membuat token CSRF baru untuk menjaga keamanan aplikasi
        $request->session()->regenerateToken();

        // Mengarahkan pengguna ke halaman utama aplikasi
        return Redirect::to('/');
    }
}
