<?php

// Menentukan namespace controller autentikasi
namespace App\Http\Controllers\Auth;

// Mengimpor Controller utama Laravel
use App\Http\Controllers\Controller;

// Mengimpor LoginRequest untuk menangani validasi dan autentikasi login
use App\Http\Requests\Auth\LoginRequest;

// Mengimpor RedirectResponse untuk mengembalikan respons berupa redirect
use Illuminate\Http\RedirectResponse;

// Mengimpor Request untuk menangani permintaan dari pengguna
use Illuminate\Http\Request;

// Mengimpor Auth untuk mengelola proses autentikasi pengguna
use Illuminate\Support\Facades\Auth;

// Mengimpor Route untuk memeriksa keberadaan route
use Illuminate\Support\Facades\Route;

// Mengimpor Inertia untuk menampilkan halaman frontend
use Inertia\Inertia;

// Mengimpor Response sebagai tipe data respons Inertia
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function create(): Response
    {
        // Menampilkan halaman Auth/Login menggunakan Inertia
        return Inertia::render('Auth/Login', [

            // Memeriksa apakah route untuk reset password tersedia
            'canResetPassword' => Route::has('password.request'),

            // Mengambil pesan status dari session, jika tersedia
            'status' => session('status'),
        ]);
    }

    /**
     * Menangani proses autentikasi atau login pengguna.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Memanggil fungsi authenticate() untuk memeriksa
        // apakah email dan password yang dimasukkan benar
        $request->authenticate();

        // Memperbarui ID session untuk mencegah serangan session fixation
        $request->session()->regenerate();

        // Mengarahkan pengguna ke halaman yang sebelumnya dituju.
        // Jika tidak ada halaman tujuan sebelumnya, pengguna diarahkan
        // ke halaman dashboard.
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Menghapus sesi autentikasi atau melakukan logout pengguna.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Melakukan logout menggunakan guard web
        Auth::guard('web')->logout();

        // Menghapus seluruh data session pengguna
        $request->session()->invalidate();

        // Membuat token CSRF baru untuk keamanan aplikasi
        $request->session()->regenerateToken();

        // Mengarahkan pengguna kembali ke halaman utama
        return redirect('/');
    }
}
