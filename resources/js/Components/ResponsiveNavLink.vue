<script setup>
// Mengimpor computed dari Vue untuk membuat nilai reaktif berdasarkan kondisi
import { computed } from 'vue';

// Mengimpor komponen Link dari Inertia.js untuk navigasi antarhalaman
import { Link } from '@inertiajs/vue3';

// Mendefinisikan properti (props) yang diterima dari komponen induk
const props = defineProps({
    // Menentukan alamat halaman tujuan ketika tautan diklik
    href: {
        // Nilai href harus berupa String
        type: String,

        // Properti href wajib diberikan oleh komponen induk
        required: true,
    },

    // Menentukan apakah tautan sedang dalam kondisi aktif
    active: {
        // Nilai active berupa Boolean (true atau false)
        type: Boolean,
    },
});

// Membuat computed property untuk menentukan class CSS tautan
// Class akan berubah secara otomatis berdasarkan kondisi active
const classes = computed(() =>
    // Jika active bernilai true, gunakan class untuk tautan aktif
    props.active
        ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 text-start text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out'

        // Jika active bernilai false, gunakan class untuk tautan tidak aktif
        : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out',
);
</script>

<template>
    <!-- Membuat tautan navigasi menggunakan komponen Link dari Inertia.js -->
    <!-- href menentukan alamat tujuan dan classes menentukan tampilan tautan -->
    <Link :href="href" :class="classes">

        <!-- Menampilkan teks atau konten tautan yang dikirim dari komponen induk -->
        <slot />

    </Link>
</template>
