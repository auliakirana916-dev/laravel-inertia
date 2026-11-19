<script setup>
// Mendefinisikan properti (props) yang dapat diterima dari komponen induk
defineProps({
    // Properti value digunakan untuk menerima teks label
    value: {
        // Menentukan bahwa nilai value harus berupa String
        type: String,
    },
});
</script>

<template>
    <!-- Membuat elemen label untuk memberikan keterangan pada input formulir -->
    <label class="block text-sm font-medium text-gray-700">

        <!-- Menampilkan teks label dari props value jika memiliki nilai -->
        <span v-if="value">{{ value }}</span>

        <!-- Jika value kosong, tampilkan konten yang dikirim melalui slot -->
        <span v-else>
            <slot />
        </span>
    </label>
</template>
