<?php

// Menentukan namespace controller autentikasi
namespace App\Http\Controllers\Auth;

// Mengimpor Controller utama Laravel
use App\Http\Controllers\Controller;

// Mengimpor RedirectResponse untuk mengembalikan respons redirect
use Illuminate\Http\RedirectResponse;

// Mengimpor Request untuk menangani permintaan dari pengguna
use Illuminate\Http\Request;

// Mengimpor Auth untuk mengelola proses autentikasi
use Illuminate\Support\Facades\Auth;

// Mengimpor ValidationException untuk menangani kesalahan validasi
use Illuminate\Validation\ValidationException;

// Mengimpor Inertia untuk menampilkan halaman frontend
use Inertia\Inertia;

// Mengimpor Response sebagai tipe data respons Inertia
use Inertia\Response;

class ConfirmablePasswordController extends Controller
{
    /**
     * Menampilkan halaman konfirmasi password.
     */
    public function show(): Response
    {
        // Menampilkan halaman Auth/ConfirmPassword
        // melalui Inertia untuk meminta pengguna memasukkan password kembali
        return Inertia::render('Auth/ConfirmPassword');
    }

    /**
     * Memeriksa dan mengonfirmasi password pengguna.
     */
    public function store(Request $request): RedirectResponse
    {
        // Memeriksa apakah password yang dimasukkan pengguna
        // sesuai dengan password akun yang sedang login
        if (! Auth::guard('web')->validate([
            
            // Mengambil email dari pengguna yang sedang login
            'email' => $request->user()->email,

            // Mengambil password yang dimasukkan pengguna
            'password' => $request->password,

        ])) {
            // Jika password tidak sesuai, tampilkan pesan kesalahan
            // pada bagian password
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        // Menyimpan waktu konfirmasi password ke dalam session
        // sebagai tanda bahwa pengguna telah berhasil mengonfirmasi password
        $request->session()->put('auth.password_confirmed_at', time());

        // Mengarahkan pengguna kembali ke halaman yang sebelumnya dituju.
        // Jika tidak ada halaman sebelumnya, pengguna diarahkan
        // ke halaman dashboard.
        return redirect()->intended(route('dashboard', absolute: false));
    }
}

