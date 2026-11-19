<?php

// Menentukan namespace controller autentikasi
namespace App\Http\Controllers\Auth;

// Mengimpor Controller utama Laravel
use App\Http\Controllers\Controller;

// Mengimpor event PasswordReset untuk menandai bahwa password berhasil diubah
use Illuminate\Auth\Events\PasswordReset;

// Mengimpor RedirectResponse untuk mengembalikan respons redirect
use Illuminate\Http\RedirectResponse;

// Mengimpor Request untuk menangani permintaan dari pengguna
use Illuminate\Http\Request;

// Mengimpor Hash untuk mengenkripsi password sebelum disimpan ke database
use Illuminate\Support\Facades\Hash;

// Mengimpor Password untuk mengelola proses reset password Laravel
use Illuminate\Support\Facades\Password;

// Mengimpor Str untuk membuat string secara acak
use Illuminate\Support\Str;

// Mengimpor Rules untuk menerapkan aturan validasi password
use Illuminate\Validation\Rules;

// Mengimpor ValidationException untuk menangani kesalahan validasi
use Illuminate\Validation\ValidationException;

// Mengimpor Inertia untuk menampilkan halaman frontend
use Inertia\Inertia;

// Mengimpor Response sebagai tipe data respons Inertia
use Inertia\Response;

class NewPasswordController extends Controller
{
    /**
     * Menampilkan halaman untuk membuat password baru.
     */
    public function create(Request $request): Response
    {
        // Menampilkan halaman Auth/ResetPassword menggunakan Inertia
        return Inertia::render('Auth/ResetPassword', [

            // Mengirimkan alamat email pengguna ke halaman reset password
            'email' => $request->email,

            // Mengambil token reset password dari URL
            'token' => $request->route('token'),
        ]);
    }

    /**
     * Menangani proses permintaan perubahan password baru.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Melakukan validasi terhadap data yang dikirimkan pengguna
        $request->validate([

            // Token wajib diisi untuk memastikan permintaan reset password valid
            'token' => 'required',

            // Email wajib diisi dan harus memiliki format email yang benar
            'email' => 'required|email',

            // Password wajib diisi, harus sama dengan password_confirmation,
            // dan harus memenuhi aturan keamanan password bawaan Laravel
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Menjalankan proses reset password menggunakan fitur bawaan Laravel
        // dengan mengambil data email, password, konfirmasi password, dan token
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),

            // Fungsi ini dijalankan apabila token dan data reset password valid
            function ($user) use ($request) {

                // Memperbarui data pengguna dengan password baru
                // serta membuat remember_token baru secara acak
                $user->forceFill([

                    // Mengenkripsi password menggunakan Hash::make()
                    'password' => Hash::make($request->password),

                    // Membuat token pengingat login baru dengan panjang 60 karakter
                    'remember_token' => Str::random(60),

                // Menyimpan perubahan data pengguna ke database
                ])->save();

                // Mengirimkan event PasswordReset sebagai tanda
                // bahwa password pengguna berhasil diubah
                event(new PasswordReset($user));
            }
        );

        // Memeriksa apakah proses reset password berhasil
        if ($status == Password::PASSWORD_RESET) {

            // Jika berhasil, arahkan pengguna ke halaman login
            // sekaligus mengirimkan pesan bahwa password berhasil diubah
            return redirect()->route('login')->with('status', __($status));
        }

        // Jika proses reset password gagal,
        // tampilkan pesan kesalahan pada bagian email
        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
