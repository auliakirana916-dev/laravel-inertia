<script setup>
// Mengimpor computed dari Vue untuk membuat properti
// yang memiliki getter dan setter secara reaktif
import { computed } from 'vue';

// Mendefinisikan event yang dapat dikirimkan
// dari komponen anak ke komponen induk
// Event update:checked digunakan untuk memperbarui nilai checkbox
const emit = defineEmits(['update:checked']);

// Mendefinisikan props atau data yang diterima
// dari komponen induk (parent component)
const props = defineProps({

    // Mendefinisikan properti checked untuk menentukan
    // apakah checkbox dalam keadaan tercentang atau tidak
    // Tipe data yang diperbolehkan adalah Array atau Boolean
    // Properti ini wajib diberikan oleh komponen induk
    checked: {
        type: [Array, Boolean],
        required: true,
    },

    // Mendefinisikan properti value sebagai nilai checkbox
    // Jika tidak diberikan, nilai default-nya adalah null
    value: {
        default: null,
    },
});

// Membuat computed property bernama proxyChecked
// untuk menghubungkan nilai checkbox dengan props checked
const proxyChecked = computed({

    // Getter: mengambil nilai checked dari komponen induk
    // untuk menentukan kondisi checkbox
    get() {
        return props.checked;
    },

    // Setter: dijalankan ketika nilai checkbox berubah
    // Mengirimkan nilai terbaru ke komponen induk
    // melalui event update:checked
    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template>
    <!-- Membuat elemen input berupa checkbox -->
    <input
        <!-- Menentukan jenis input sebagai checkbox -->
        type="checkbox"

        <!-- Mengatur nilai checkbox berdasarkan props value -->
        :value="value"

        <!-- Menghubungkan kondisi checkbox dengan proxyChecked -->
        <!-- Jika checkbox berubah, setter computed akan dijalankan -->
        v-model="proxyChecked"

        <!-- Memberikan styling menggunakan class Tailwind CSS -->
        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
    />
</template>
