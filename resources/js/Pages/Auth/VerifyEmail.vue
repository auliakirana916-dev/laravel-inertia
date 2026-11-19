<script setup>
// Mengimpor computed dari Vue untuk membuat nilai turunan yang bersifat reaktif.
import { computed } from 'vue';

// Mengimpor layout khusus halaman tamu.
import GuestLayout from '@/Layouts/GuestLayout.vue';

// Mengimpor komponen tombol utama.
import PrimaryButton from '@/Components/PrimaryButton.vue';

// Mengimpor Head untuk mengatur judul halaman,
// Link untuk navigasi, dan useForm untuk mengelola formulir Inertia.
import { Head, Link, useForm } from '@inertiajs/vue3';

// Menerima properti status yang dikirimkan dari Laravel.
// Properti ini digunakan untuk mengetahui hasil pengiriman email verifikasi.
const props = defineProps({
    status: {
        type: String,
    },
});

// Membuat objek form kosong menggunakan useForm.
// Form ini tidak membutuhkan input karena hanya digunakan
// untuk mengirim permintaan pengiriman ulang email verifikasi.
const form = useForm({});

// Fungsi untuk mengirim permintaan pengiriman ulang email verifikasi.
const submit = () => {

    // Mengirim permintaan menggunakan metode POST
    // ke route verification.send di Laravel.
    form.post(route('verification.send'));
};

// Membuat nilai computed untuk memeriksa status pengiriman email verifikasi.
// Bernilai true jika Laravel mengirim status verification-link-sent.
// Bernilai false jika status yang diterima berbeda.
const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
</script>

<template>
    <!-- Menggunakan GuestLayout sebagai pembungkus tampilan halaman verifikasi email. -->
    <GuestLayout>

        <!-- Mengatur judul halaman pada browser menjadi Email Verification. -->
        <Head title="Email Verification" />

        <!-- Menampilkan informasi kepada pengguna
             bahwa alamat email perlu diverifikasi sebelum melanjutkan. -->
        <div class="mb-4 text-sm text-gray-600">
            Thanks for signing up! Before getting started, could you verify your
            email address by clicking on the link we just emailed to you? If you
            didn't receive the email, we will gladly send you another.
        </div>

        <!-- Menampilkan pesan pemberitahuan jika email verifikasi berhasil dikirim ulang. -->
        <div
            class="mb-4 text-sm font-medium text-green-600"
            v-if="verificationLinkSent"
        >
            A new verification link has been sent to the email address you
            provided during registration.
        </div>

        <!-- Formulir untuk meminta pengiriman ulang email verifikasi.
             .prevent mencegah browser melakukan submit secara default. -->
        <form @submit.prevent="submit">

            <!-- Bagian tombol pengiriman ulang email dan logout. -->
            <div class="mt-4 flex items-center justify-between">

                <!-- Tombol untuk meminta Laravel mengirim ulang email verifikasi. -->
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Resend Verification Email
                </PrimaryButton>

                <!-- Link untuk keluar dari akun menggunakan metode POST. -->
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Log Out
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
