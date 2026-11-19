<script setup>
// Mengimpor fungsi Vue yang dibutuhkan
import { computed, onMounted, onUnmounted, ref, watch } from 'vue';

// Mendefinisikan properti (props) yang dapat diterima dari komponen induk
const props = defineProps({
    // Mengatur apakah modal ditampilkan atau disembunyikan
    show: {
        type: Boolean,
        default: false,
    },

    // Mengatur batas lebar maksimal modal
    // Secara default menggunakan ukuran 2xl
    maxWidth: {
        type: String,
        default: '2xl',
    },

    // Menentukan apakah modal boleh ditutup oleh pengguna
    // Secara default modal dapat ditutup
    closeable: {
        type: Boolean,
        default: true,
    },
});

// Mendefinisikan event close untuk memberi tahu komponen induk
// bahwa modal ingin ditutup
const emit = defineEmits(['close']);

// Membuat referensi untuk mengakses elemen dialog HTML
const dialog = ref();

// Menyimpan status tampilan konten slot modal
// Nilai awal mengikuti props show
const showSlot = ref(props.show);

// Memantau perubahan nilai props show
watch(
    () => props.show,
    () => {
        // Jika modal ingin ditampilkan
        if (props.show) {
            // Mencegah halaman utama bergulir ketika modal terbuka
            document.body.style.overflow = 'hidden';

            // Menampilkan konten modal
            showSlot.value = true;

            // Membuka dialog menggunakan API bawaan HTML
            dialog.value?.showModal();
        } else {
            // Mengembalikan scroll halaman seperti semula
            document.body.style.overflow = '';

            // Memberikan jeda agar animasi penutupan selesai
            setTimeout(() => {
                // Menutup dialog
                dialog.value?.close();

                // Menyembunyikan konten slot setelah modal ditutup
                showSlot.value = false;
            }, 200);
        }
    },
);

// Fungsi untuk meminta penutupan modal
const close = () => {
    // Modal hanya dapat ditutup jika closeable bernilai true
    if (props.closeable) {
        // Mengirim event close kepada komponen induk
        emit('close');
    }
};

// Fungsi untuk menangani penekanan tombol Escape
const closeOnEscape = (e) => {
    // Memeriksa apakah tombol yang ditekan adalah Escape
    if (e.key === 'Escape') {
        // Mencegah perilaku default tombol Escape pada dialog
        e.preventDefault();

        // Jika modal sedang ditampilkan, jalankan fungsi close
        if (props.show) {
            close();
        }
    }
};

// Menambahkan event listener ketika komponen selesai dipasang
// Event ini digunakan untuk mendeteksi tombol Escape
onMounted(() => document.addEventListener('keydown', closeOnEscape));

// Menjalankan pembersihan ketika komponen dilepas
onUnmounted(() => {
    // Menghapus event listener keyboard agar tidak tertinggal
    document.removeEventListener('keydown', closeOnEscape);

    // Mengembalikan pengaturan scroll halaman seperti semula
    document.body.style.overflow = '';
});

// Menghitung class Tailwind CSS berdasarkan nilai maxWidth
const maxWidthClass = computed(() => {
    // Menyediakan pilihan class untuk ukuran maksimal modal
    return {
        sm: 'sm:max-w-sm',
        md: 'sm:max-w-md',
        lg: 'sm:max-w-lg',
        xl: 'sm:max-w-xl',
        '2xl': 'sm:max-w-2xl',
    }[props.maxWidth];
});
</script>

<template>
    <!-- Elemen dialog HTML sebagai wadah utama modal -->
    <dialog
        class="z-50 m-0 min-h-full min-w-full overflow-y-auto bg-transparent backdrop:bg-transparent"
        ref="dialog"
    >
        <!-- Container modal yang memenuhi area layar -->
        <div
            class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0"
            scroll-region
        >
            <!-- Mengatur animasi ketika latar belakang modal muncul dan menghilang -->
            <Transition
                enter-active-class="ease-out duration-300"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="ease-in duration-200"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <!-- Lapisan latar belakang modal yang tampil sesuai nilai show -->
                <div
                    v-show="show"
                    class="fixed inset-0 transform transition-all"
                    @click="close"
                >
                    <!-- Memberikan warna gelap transparan pada latar belakang -->
                    <div
                        class="absolute inset-0 bg-gray-500 opacity-75"
                    />
                </div>
            </Transition>

            <!-- Mengatur animasi ketika kotak modal muncul dan menghilang -->
            <Transition
                enter-active-class="ease-out duration-300"
                enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                leave-active-class="ease-in duration-200"
                leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
                <!-- Kotak utama modal yang ditampilkan berdasarkan nilai show -->
                <div
                    v-show="show"
                    class="mb-6 transform overflow-hidden rounded-lg bg-white shadow-xl transition-all sm:mx-auto sm:w-full"

                    <!-- Mengatur lebar maksimal modal berdasarkan computed maxWidthClass -->
                    :class="maxWidthClass"
                >
                    <!-- Menampilkan isi modal dari komponen induk jika showSlot bernilai true -->
                    <slot v-if="showSlot" />
                </div>
            </Transition>
        </div>
    </dialog>
</template>
