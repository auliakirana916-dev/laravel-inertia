<script setup>
// Mengimpor komponen logo aplikasi.
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

// Mengimpor komponen Link dari Inertia untuk berpindah halaman tanpa reload penuh.
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <!-- Pembungkus utama halaman autentikasi, seperti login dan register. -->
    <div
        class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0"
    >
        <!-- Bagian logo aplikasi. -->
        <div>
            <!-- Ketika logo diklik, pengguna akan diarahkan ke halaman utama (/). -->
            <Link href="/">

                <!-- Menampilkan logo aplikasi dengan ukuran dan warna yang ditentukan. -->
                <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
            </Link>
        </div>

        <!-- Kotak utama untuk menampilkan formulir atau konten autentikasi. -->
        <div
            class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg"
        >
            <!-- Menampilkan konten dari halaman yang menggunakan layout ini. -->
            <slot />
        </div>
    </div>
</template>
