<script setup>
// Mendefinisikan properti (props) yang dapat diterima dari komponen induk
defineProps({
    // Properti type digunakan untuk menentukan jenis tombol
    type: {
        // Nilai type harus berupa String
        type: String,

        // Secara default tombol menggunakan tipe button
        default: 'button',
    },
});
</script>

<template>
    <!-- Membuat elemen tombol yang dapat digunakan kembali -->
    <button
        <!-- Mengatur jenis tombol berdasarkan nilai props type -->
        :type="type"

        <!-- Mengatur tampilan tombol menggunakan Tailwind CSS -->
        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25"
    >
        <!-- Menampilkan teks atau konten tombol yang dikirim dari komponen induk -->
        <slot />
    </button>
</template>
