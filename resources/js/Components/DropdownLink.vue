<script setup>
// Mengimpor komponen Link dari Inertia.js
// Link digunakan untuk berpindah halaman tanpa melakukan reload penuh
import { Link } from '@inertiajs/vue3';

// Mendefinisikan properti (props) yang diterima dari komponen induk
defineProps({
    // Menentukan alamat tujuan ketika tautan diklik
    href: {
        // Nilai href harus berupa String
        type: String,

        // Properti href wajib diberikan oleh komponen induk
        required: true,
    },
});
</script>

<template>
    <!-- Membuat tautan menggunakan komponen Link dari Inertia.js -->
    <Link
        <!-- Menghubungkan alamat tujuan dengan nilai props href -->
        :href="href"

        <!-- Mengatur tampilan tautan menggunakan Tailwind CSS -->
        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
    >
        <!-- Menampilkan teks atau konten yang dikirim dari komponen induk -->
        <slot />
    </Link>
</template>
