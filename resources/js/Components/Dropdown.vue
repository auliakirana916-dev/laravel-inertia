<script setup>
// Mengimpor fungsi Vue yang digunakan dalam komponen
import { computed, onMounted, onUnmounted, ref } from 'vue';

// Mendefinisikan properti (props) yang dapat diterima dari komponen induk
const props = defineProps({
    // Mengatur posisi dropdown, secara default berada di sebelah kanan
    align: {
        type: String,
        default: 'right',
    },

    // Mengatur lebar dropdown, secara default menggunakan ukuran 48
    width: {
        type: String,
        default: '48',
    },

    // Mengatur class CSS untuk bagian konten dropdown
    contentClasses: {
        type: String,
        default: 'py-1 bg-white',
    },
});

// Fungsi untuk menutup dropdown ketika tombol Escape ditekan
const closeOnEscape = (e) => {
    // Memeriksa apakah dropdown sedang terbuka dan tombol yang ditekan adalah Escape
    if (open.value && e.key === 'Escape') {
        // Mengubah status dropdown menjadi tertutup
        open.value = false;
    }
};

// Menambahkan event listener ketika komponen selesai dipasang
// Event ini akan mendeteksi penekanan tombol pada keyboard
onMounted(() => document.addEventListener('keydown', closeOnEscape));

// Menghapus event listener ketika komponen dilepas
// Tujuannya agar tidak terjadi event listener yang tertinggal
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));

// Menghitung class lebar dropdown berdasarkan props width
const widthClass = computed(() => {
    // Mengambil class CSS yang sesuai dengan nilai width
    return {
        48: 'w-48',
    }[props.width.toString()];
});

// Menghitung class posisi dan titik awal animasi dropdown
const alignmentClasses = computed(() => {
    // Jika align bernilai left, dropdown berada di sebelah kiri
    if (props.align === 'left') {
        return 'ltr:origin-top-left rtl:origin-top-right start-0';

    // Jika align bernilai right, dropdown berada di sebelah kanan
    } else if (props.align === 'right') {
        return 'ltr:origin-top-right rtl:origin-top-left end-0';

    // Jika bukan left atau right, dropdown berada di tengah
    } else {
        return 'origin-top';
    }
});

// Membuat variabel reaktif untuk mengatur status dropdown
// false berarti tertutup, sedangkan true berarti terbuka
const open = ref(false);
</script>

<template>
    <!-- Container utama dropdown dengan posisi relatif -->
    <div class="relative">

        <!-- Bagian pemicu dropdown -->
        <!-- Ketika diklik, status dropdown berubah menjadi kebalikannya -->
        <div @click="open = !open">
            <!-- Menampilkan konten yang dikirim melalui slot bernama trigger -->
            <slot name="trigger" />
        </div>

        <!-- Lapisan transparan yang menutupi layar ketika dropdown terbuka -->
        <div
            v-show="open"
            class="fixed inset-0 z-40"
            <!-- Menutup dropdown ketika area overlay diklik -->
            @click="open = false"
        ></div>

        <!-- Mengatur animasi ketika dropdown dibuka dan ditutup -->
        <Transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
        >
            <!-- Bagian utama dropdown yang hanya ditampilkan ketika open bernilai true -->
            <div
                v-show="open"
                class="absolute z-50 mt-2 rounded-md shadow-lg"

                <!-- Menggabungkan class lebar dan posisi dropdown -->
                :class="[widthClass, alignmentClasses]"

                style="display: none"

                <!-- Menutup dropdown ketika bagian dropdown diklik -->
                @click="open = false"
            >
                <!-- Container untuk isi dropdown dengan garis tepi dan class tambahan -->
                <div
                    class="rounded-md ring-1 ring-black ring-opacity-5"
                    :class="contentClasses"
                >
                    <!-- Menampilkan isi dropdown dari slot bernama content -->
                    <slot name="content" />
                </div>
            </div>
        </Transition>
    </div>
</template>
