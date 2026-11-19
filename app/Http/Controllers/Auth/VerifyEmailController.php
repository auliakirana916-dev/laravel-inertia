<?php

// Menentukan namespace controller autentikasi
namespace App\Http\Controllers\Auth;

// Mengimpor Controller utama Laravel
use App\Http\Controllers\Controller;

// Mengimpor event Verified untuk menandai email berhasil diverifikasi
use Illuminate\Auth\Events\Verified;

// Mengimpor EmailVerificationRequest untuk memvalidasi permintaan verifikasi email
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Mengimpor RedirectResponse untuk mengembalikan respons pengalihan halaman
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Memverifikasi alamat email pengguna yang sedang login.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Memeriksa apakah email pengguna sudah terverifikasi
        if ($request->user()->hasVerifiedEmail()) {

            // Jika email sudah terverifikasi,
            // arahkan pengguna ke halaman dashboard
            // dengan menambahkan parameter verified=1 pada URL
            return redirect()->intended(
                route('dashboard', absolute: false).'?verified=1'
            );
        }

        // Memeriksa dan mengubah status email pengguna
        // menjadi terverifikasi
        if ($request->user()->markEmailAsVerified()) {

            // Jika email berhasil diverifikasi,
            // kirimkan event Verified untuk menandai
            // bahwa proses verifikasi telah berhasil
            event(new Verified($request->user()));
        }

        // Mengarahkan pengguna ke halaman dashboard
        // setelah proses verifikasi email selesai
        // dengan parameter verified=1 sebagai penanda keberhasilan
        return redirect()->intended(
            route('dashboard', absolute: false).'?verified=1'
        );
    }
}

