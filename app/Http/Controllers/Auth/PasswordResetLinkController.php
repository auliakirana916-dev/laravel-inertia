<?php

// Menentukan namespace controller autentikasi
namespace App\Http\Controllers\Auth;

// Mengimpor Controller utama Laravel
use App\Http\Controllers\Controller;

// Mengimpor RedirectResponse untuk mengembalikan respons redirect
use Illuminate\Http\RedirectResponse;

// Mengimpor Request untuk menangani permintaan dari pengguna
use Illuminate\Http\Request;

// Mengimpor Password untuk mengelola proses pengiriman link reset password
use Illuminate\Support\Facades\Password;

// Mengimpor ValidationException untuk menangani kesalahan validasi
use Illuminate\Validation\ValidationException;

// Mengimpor Inertia untuk menampilkan halaman frontend
use Inertia\Inertia;

// Mengimpor Response sebagai tipe data respons Inertia
use Inertia\Response;

class PasswordResetLinkController extends Controller
{
    /**
     * Menampilkan halaman permintaan link reset password.
     */
    public function create(): Response
    {
        // Menampilkan halaman Auth/ForgotPassword menggunakan Inertia
        return Inertia::render('Auth/ForgotPassword', [

            // Mengambil pesan status dari session,
            // misalnya pemberitahuan bahwa link reset password berhasil dikirim
            'status' => session('status'),
        ]);
    }

    /**
     * Menangani permintaan pengiriman link reset password.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Melakukan validasi terhadap alamat email yang dimasukkan pengguna
        $request->validate([

            // Email wajib diisi dan harus menggunakan format email yang benar
            'email' => 'required|email',
        ]);

        // Meminta Laravel mengirimkan link reset password
        // ke alamat email yang dimasukkan oleh pengguna
        $status = Password::sendResetLink(

            // Mengambil data email dari request untuk proses pengiriman link
            $request->only('email')
        );

        // Memeriksa apakah link reset password berhasil dikirim
        if ($status == Password::RESET_LINK_SENT) {

            // Jika berhasil, arahkan pengguna kembali ke halaman sebelumnya
            // sekaligus mengirimkan pesan status keberhasilan
            return back()->with('status', __($status));
        }

        // Jika pengiriman link gagal, tampilkan pesan kesalahan
        // pada bagian input email
        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
