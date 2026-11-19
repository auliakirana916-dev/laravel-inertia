<?php

// Menentukan namespace controller autentikasi
namespace App\Http\Controllers\Auth;

// Mengimpor Controller utama Laravel
use App\Http\Controllers\Controller;

// Mengimpor model User untuk mengelola data pengguna di database
use App\Models\User;

// Mengimpor event Registered untuk menandai bahwa pengguna berhasil mendaftar
use Illuminate\Auth\Events\Registered;

// Mengimpor RedirectResponse untuk mengembalikan respons redirect
use Illuminate\Http\RedirectResponse;

// Mengimpor Request untuk menangani permintaan dari pengguna
use Illuminate\Http\Request;

// Mengimpor Auth untuk mengelola proses autentikasi pengguna
use Illuminate\Support\Facades\Auth;

// Mengimpor Hash untuk mengenkripsi password sebelum disimpan ke database
use Illuminate\Support\Facades\Hash;

// Mengimpor Rules untuk menerapkan aturan validasi password
use Illuminate\Validation\Rules;

// Mengimpor ValidationException untuk menangani kesalahan validasi
use Illuminate\Validation\ValidationException;

// Mengimpor Inertia untuk menampilkan halaman frontend
use Inertia\Inertia;

// Mengimpor Response sebagai tipe data respons Inertia
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan halaman pendaftaran akun pengguna.
     */
    public function create(): Response
    {
        // Menampilkan halaman Auth/Register menggunakan Inertia
        return Inertia::render('Auth/Register');
    }

    /**
     * Menangani proses pendaftaran akun pengguna baru.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Melakukan validasi terhadap data yang dimasukkan pengguna
        $request->validate([

            // Nama wajib diisi, harus berupa teks,
            // dan maksimal memiliki panjang 255 karakter
            'name' => 'required|string|max:255',

            // Email wajib diisi, harus berupa teks,
            // diubah menjadi huruf kecil, memiliki format email yang benar,
            // maksimal 255 karakter, dan harus unik di database
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,

            // Password wajib diisi, harus sama dengan konfirmasi password,
            // dan harus memenuhi aturan keamanan password bawaan Laravel
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Membuat akun pengguna baru dan menyimpan datanya ke database
        $user = User::create([

            // Mengambil nama pengguna dari data request
            'name' => $request->name,

            // Mengambil alamat email pengguna dari data request
            'email' => $request->email,

            // Mengenkripsi password sebelum disimpan ke database
            'password' => Hash::make($request->password),
        ]);

        // Mengirimkan event Registered sebagai tanda
        // bahwa pengguna baru berhasil melakukan pendaftaran
        event(new Registered($user));

        // Melakukan login secara otomatis menggunakan akun
        // yang baru saja berhasil dibuat
        Auth::login($user);

        // Mengarahkan pengguna ke halaman dashboard
        // setelah proses pendaftaran dan login berhasil
        return redirect(route('dashboard', absolute: false));
    }
}

