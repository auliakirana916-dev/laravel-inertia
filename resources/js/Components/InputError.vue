<script setup>
// Mendefinisikan properti (props) yang dapat diterima dari komponen induk
defineProps({
    // Properti message digunakan untuk menerima pesan berupa teks
    message: {
        // Menentukan bahwa nilai message harus berupa String
        type: String,
    },
});
</script>

<template>
    <!-- Menampilkan elemen hanya jika message memiliki nilai -->
    <div v-show="message">

        <!-- Menampilkan pesan dengan ukuran teks kecil dan warna merah -->
        <p class="text-sm text-red-600">
            <!-- Menampilkan isi pesan yang diterima melalui props message -->
            {{ message }}
        </p>
    </div>
</template>
