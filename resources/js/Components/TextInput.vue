<script setup>
// Mengimpor onMounted untuk menjalankan kode setelah komponen dipasang
// Mengimpor ref untuk membuat variabel reaktif
import { onMounted, ref } from 'vue';

// Membuat model dua arah (two-way binding) menggunakan defineModel
// Data model harus berupa String dan wajib diberikan
const model = defineModel({
    type: String,
    required: true,
});

// Membuat referensi untuk mengakses elemen input secara langsung
const input = ref(null);

// Menjalankan fungsi ketika komponen selesai dipasang ke halaman
onMounted(() => {
    // Memeriksa apakah elemen input memiliki atribut autofocus
    if (input.value.hasAttribute('autofocus')) {

        // Jika atribut autofocus tersedia, arahkan fokus ke elemen input
        input.value.focus();
    }
});

// Mengekspos fungsi focus agar dapat dipanggil oleh komponen induk
defineExpose({
    // Membuat fungsi untuk mengarahkan fokus ke elemen input
    focus: () => input.value.focus(),
});
</script>

<template>
    <!-- Membuat elemen input untuk menerima data dari pengguna -->
    <input
        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"

        <!-- Menghubungkan nilai input dengan model menggunakan two-way binding -->
        v-model="model"

        <!-- Menghubungkan elemen input dengan variabel ref bernama input -->
        ref="input"
    />
</template>

