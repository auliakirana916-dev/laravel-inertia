<?php

// Menentukan namespace controller autentikasi
namespace App\Http\Controllers\Auth;

// Mengimpor Controller utama Laravel
use App\Http\Controllers\Controller;

// Mengimpor RedirectResponse untuk mengembalikan respons redirect
use Illuminate\Http\RedirectResponse;

// Mengimpor Request untuk menangani permintaan dari pengguna
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Mengirimkan notifikasi verifikasi email baru kepada pengguna.
     */
    public function store(Request $request): RedirectResponse
    {
        // Memeriksa apakah email pengguna sudah berhasil diverifikasi
        if ($request->user()->hasVerifiedEmail()) {

            // Jika email sudah terverifikasi, arahkan pengguna
            // ke halaman dashboard
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Jika email belum terverifikasi, kirimkan email verifikasi
        // ke alamat email pengguna yang sedang login
        $request->user()->sendEmailVerificationNotification();

        // Mengarahkan pengguna kembali ke halaman sebelumnya
        // sekaligus menyimpan pesan status bahwa link verifikasi
        // berhasil dikirim
        return back()->with('status', 'verification-link-sent');
    }
}

