<template>
    <!-- Membuat elemen tombol yang dapat digunakan kembali di berbagai halaman -->
    <button
        <!-- Mengatur tampilan tombol menggunakan Tailwind CSS -->
        class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900"
    >
        <!-- Menampilkan teks atau konten tombol yang dikirim dari komponen induk -->
        <slot />
    </button>
</template>
