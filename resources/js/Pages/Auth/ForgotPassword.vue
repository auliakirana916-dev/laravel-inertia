<script setup>
// Mengimpor layout khusus halaman tamu, seperti Login, Register, dan Forgot Password.
import GuestLayout from '@/Layouts/GuestLayout.vue';

// Mengimpor komponen untuk menampilkan pesan kesalahan validasi.
import InputError from '@/Components/InputError.vue';

// Mengimpor komponen label untuk input.
import InputLabel from '@/Components/InputLabel.vue';

// Mengimpor komponen tombol utama.
import PrimaryButton from '@/Components/PrimaryButton.vue';

// Mengimpor komponen input teks.
import TextInput from '@/Components/TextInput.vue';

// Mengimpor Head untuk mengatur judul halaman dan useForm untuk mengelola formulir Inertia.
import { Head, useForm } from '@inertiajs/vue3';

// Mendefinisikan props yang diterima dari halaman atau controller Laravel.
// Properti status digunakan untuk menampilkan pesan setelah permintaan reset password diproses.
defineProps({
    status: {
        type: String,
    },
});

// Membuat objek form menggunakan useForm.
// Properti email digunakan untuk menampung alamat email yang dimasukkan pengguna.
const form = useForm({
    email: '',
});

// Fungsi untuk mengirimkan permintaan reset password ke server Laravel.
const submit = () => {

    // Mengirim data email menggunakan metode POST ke route password.email.
    // Laravel akan memproses permintaan dan mengirimkan link reset password jika berhasil.
    form.post(route('password.email'));
};
</script>

<template>
    <!-- Menggunakan GuestLayout sebagai pembungkus tampilan halaman lupa password. -->
    <GuestLayout>

        <!-- Mengatur judul halaman pada browser menjadi Forgot Password. -->
        <Head title="Forgot Password" />

        <!-- Menampilkan informasi kepada pengguna mengenai proses reset password. -->
        <div class="mb-4 text-sm text-gray-600">
            Forgot your password? No problem. Just let us know your email
            address and we will email you a password reset link that will allow
            you to choose a new one.
        </div>

        <!-- Menampilkan pesan status jika properti status memiliki nilai. -->
        <div
            v-if="status"
            class="mb-4 text-sm font-medium text-green-600"
        >
            <!-- Menampilkan isi pesan status yang dikirim dari Laravel. -->
            {{ status }}
        </div>

        <!-- Formulir untuk meminta link reset password.
             .prevent mencegah browser melakukan submit secara default. -->
        <form @submit.prevent="submit">

            <div>
                <!-- Label untuk kolom email. -->
                <InputLabel for="email" value="Email" />

                <!-- Input untuk memasukkan alamat email pengguna. -->
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <!-- Menampilkan pesan kesalahan jika validasi email gagal. -->
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Bagian tombol untuk mengirim permintaan reset password. -->
            <div class="mt-4 flex items-center justify-end">

                <!-- Tombol untuk meminta Laravel mengirimkan link reset password ke email. -->
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Email Password Reset Link
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
