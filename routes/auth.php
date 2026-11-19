<?php

// Mengimpor controller yang menangani proses autentikasi pengguna.
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

// Mengimpor Route untuk mendefinisikan alamat URL aplikasi.
use Illuminate\Support\Facades\Route;


// ======================================================
// ROUTE UNTUK PENGGUNA YANG BELUM LOGIN (GUEST)
// ======================================================

// Middleware guest membatasi route agar hanya bisa diakses
// oleh pengguna yang belum login.
Route::middleware('guest')->group(function () {

    // Menampilkan halaman formulir pendaftaran pengguna.
    // GET digunakan untuk mengambil atau menampilkan halaman.
    Route::get('register', [RegisteredUserController::class, 'create'])
        // Memberikan nama "register" pada route agar mudah dipanggil.
        ->name('register');

    // Memproses data pendaftaran pengguna yang dikirim dari formulir.
    // POST digunakan untuk mengirim data pendaftaran ke server.
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Menampilkan halaman login.
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        // Memberikan nama "login" pada route.
        ->name('login');

    // Memproses data login seperti email dan password pengguna.
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Menampilkan halaman formulir untuk meminta tautan reset password.
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        // Memberikan nama "password.request" pada route.
        ->name('password.request');

    // Memproses permintaan pengiriman tautan reset password ke email.
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        // Memberikan nama "password.email" pada route.
        ->name('password.email');

    // Menampilkan formulir untuk membuat password baru.
    // {token} merupakan parameter yang berisi token reset password.
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        // Memberikan nama "password.reset" pada route.
        ->name('password.reset');

    // Memproses dan menyimpan password baru milik pengguna.
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        // Memberikan nama "password.store" pada route.
        ->name('password.store');
});


// ======================================================
// ROUTE UNTUK PENGGUNA YANG SUDAH LOGIN (AUTH)
// ======================================================

// Middleware auth membatasi route agar hanya bisa diakses
// oleh pengguna yang sudah berhasil login.
Route::middleware('auth')->group(function () {

    // Menampilkan halaman pemberitahuan verifikasi email.
    // Menggunakan EmailVerificationPromptController secara langsung
    // karena controller ini memiliki method __invoke().
    Route::get('verify-email', EmailVerificationPromptController::class)
        // Memberikan nama "verification.notice" pada route.
        ->name('verification.notice');

    // Memproses verifikasi email berdasarkan ID dan hash pengguna.
    // {id} dan {hash} merupakan parameter pada URL.
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)

        // Middleware signed memastikan URL memiliki tanda tangan yang valid.
        // Middleware throttle:6,1 membatasi maksimal 6 permintaan dalam 1 menit.
        ->middleware(['signed', 'throttle:6,1'])

        // Memberikan nama "verification.verify" pada route.
        ->name('verification.verify');

    // Mengirim ulang email verifikasi kepada pengguna.
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])

        // Membatasi maksimal 6 permintaan dalam 1 menit.
        // Mencegah pengguna mengirim permintaan terlalu sering.
        ->middleware('throttle:6,1')

        // Memberikan nama "verification.send" pada route.
        ->name('verification.send');

    // Menampilkan halaman untuk mengonfirmasi password pengguna.
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        // Memberikan nama "password.confirm" pada route.
        ->name('password.confirm');

    // Memproses konfirmasi password yang dimasukkan pengguna.
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Memproses pembaruan password pengguna yang sedang login.
    // PUT digunakan untuk memperbarui data yang sudah ada.
    Route::put('password', [PasswordController::class, 'update'])
        // Memberikan nama "password.update" pada route.
        ->name('password.update');

    // Memproses logout atau mengakhiri sesi login pengguna.
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        // Memberikan nama "logout" pada route.
        ->name('logout');
});
