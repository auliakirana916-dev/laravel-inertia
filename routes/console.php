<?php

// Mengimpor class Inspiring yang menyediakan kumpulan kutipan inspiratif
// bawaan Laravel.
use Illuminate\Foundation\Inspiring;

// Mengimpor Facade Artisan untuk membuat perintah (command) khusus Laravel.
use Illuminate\Support\Facades\Artisan;


// Membuat perintah Artisan baru dengan nama "inspire".
// Perintah ini dapat dijalankan melalui terminal menggunakan:
// php artisan inspire
Artisan::command('inspire', function () {

    // Mengambil satu kutipan inspiratif secara acak dari class Inspiring.
    // Kemudian menampilkan kutipan tersebut sebagai komentar di terminal.
    $this->comment(Inspiring::quote());

// Memberikan deskripsi atau tujuan dari perintah "inspire".
// Deskripsi ini akan ditampilkan saat melihat daftar perintah Artisan.
})->purpose('Display an inspiring quote');
