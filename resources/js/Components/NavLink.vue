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

        // Properti href wajib diberikan
        required: true,
    },

    // Menentukan apakah tautan sedang berada dalam kondisi aktif
    active: {
        // Nilai active harus berupa Boolean (true atau false)
        type: Boolean,
    },
});

// Membuat computed property untuk menentukan class CSS tautan
// Class akan berubah sesuai dengan kondisi active
const classes = computed(() =>
    // Jika active bernilai true, gunakan class untuk tautan aktif
    props.active
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'

        // Jika active bernilai false, gunakan class untuk tautan tidak aktif
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out',
);
</script>

<template>
    <!-- Membuat tautan navigasi menggunakan komponen Link dari Inertia.js -->
    <!-- href menentukan halaman tujuan dan classes menentukan tampilan tautan -->
    <Link :href="href" :class="classes">

        <!-- Menampilkan teks atau konten tautan dari komponen induk -->
        <slot />

    </Link>
</template>
