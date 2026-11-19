<?php

// Menentukan namespace controller autentikasi
namespace App\Http\Controllers\Auth;

// Mengimpor Controller utama Laravel
use App\Http\Controllers\Controller;

// Mengimpor RedirectResponse untuk mengembalikan respons redirect
use Illuminate\Http\RedirectResponse;

// Mengimpor Request untuk menangani permintaan dari pengguna
use Illuminate\Http\Request;

// Mengimpor Inertia untuk menampilkan halaman frontend
use Inertia\Inertia;

// Mengimpor Response sebagai tipe data respons Inertia
use Inertia\Response;

class EmailVerificationPromptController extends Controller
{
    /**
     * Menampilkan halaman permintaan verifikasi email.
     */
    public function __invoke(Request $request): RedirectResponse|Response
    {
        // Memeriksa apakah email pengguna yang sedang login
        // sudah berhasil diverifikasi
        return $request->user()->hasVerifiedEmail()

                    // Jika email sudah terverifikasi,
                    // arahkan pengguna ke halaman yang sebelumnya dituju
                    // atau ke halaman dashboard jika tidak ada tujuan sebelumnya
                    ? redirect()->intended(route('dashboard', absolute: false))

                    // Jika email belum terverifikasi,
                    // tampilkan halaman Auth/VerifyEmail menggunakan Inertia
                    // sekaligus mengirimkan pesan status dari session
                    : Inertia::render('Auth/VerifyEmail', [
                        'status' => session('status')
                    ]);
    }
}
