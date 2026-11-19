<!DOCTYPE html>
<!--
    Menentukan tipe dokumen HTML5.
    Atribut lang mengatur bahasa halaman berdasarkan konfigurasi lokal Laravel.
    str_replace('-', '_') atau sebaliknya digunakan untuk menyesuaikan format kode bahasa.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <!-- Menentukan karakter yang digunakan agar mendukung berbagai jenis karakter. -->
        <meta charset="utf-8">

        <!-- Mengatur tampilan halaman agar responsif pada berbagai ukuran layar,
             terutama perangkat mobile. -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Menentukan judul halaman browser.
             inertia memungkinkan judul diperbarui oleh Inertia.js dari halaman Vue.
             Jika nama aplikasi tidak tersedia, maka menggunakan Laravel sebagai nilai default. -->
        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Menghubungkan browser lebih awal ke server font Bunny Fonts
             agar proses pemuatan font menjadi lebih cepat. -->
        <link rel="preconnect" href="https://fonts.bunny.net">

        <!-- Mengimpor font Figtree dengan ketebalan 400, 500, dan 600
             serta mengatur agar font dapat ditampilkan dengan benar. -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bagian untuk memuat kebutuhan JavaScript dan konfigurasi Inertia.js. -->

        <!-- Menyediakan helper route Laravel agar dapat digunakan
             dari JavaScript atau Vue melalui fungsi route(). -->
        @routes

        <!-- Memuat file JavaScript utama aplikasi melalui Vite.
             app.js merupakan file utama yang menginisialisasi Vue dan Inertia.
             File Vue untuk halaman yang sedang diminta juga dimuat berdasarkan
             nama komponen yang dikirimkan oleh Inertia. -->
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])

        <!-- Menyediakan tempat untuk menampilkan elemen head tambahan
             yang dikirimkan dari halaman Inertia, seperti judul dan meta tag. -->
        @inertiaHead
    </head>

    <!-- Bagian utama halaman yang menampilkan aplikasi. -->
    <body class="font-sans antialiased">

        <!-- Menjadi tempat Inertia.js menampilkan komponen halaman Vue.
             Konten halaman seperti Login, Register, Dashboard, dan halaman lainnya
             akan dirender di dalam bagian ini. -->
        @inertia

    </body>
</html>
