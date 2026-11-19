<script setup>
// Mengimpor layout khusus halaman tamu, seperti halaman login dan konfirmasi password.
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

// Membuat objek form menggunakan useForm.
// Properti password digunakan untuk menampung password yang dimasukkan pengguna.
const form = useForm({
    password: '',
});

// Fungsi untuk mengirimkan password ke server Laravel.
const submit = () => {

    // Mengirim data password ke route password.confirm menggunakan metode POST.
    form.post(route('password.confirm'), {

        // Dijalankan setelah proses pengiriman selesai, baik berhasil maupun gagal.
        // Mengosongkan kembali input password.
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <!-- Menggunakan GuestLayout sebagai pembungkus tampilan halaman konfirmasi password. -->
    <GuestLayout>

        <!-- Mengatur judul halaman pada browser menjadi Confirm Password. -->
        <Head title="Confirm Password" />

        <!-- Menampilkan informasi bahwa pengguna harus mengonfirmasi password sebelum melanjutkan. -->
        <div class="mb-4 text-sm text-gray-600">
            This is a secure area of the application. Please confirm your
            password before continuing.
        </div>

        <!-- Formulir konfirmasi password.
             .prevent mencegah browser melakukan submit secara default. -->
        <form @submit.prevent="submit">

            <div>
                <!-- Label untuk kolom password. -->
                <InputLabel for="password" value="Password" />

                <!-- Input untuk memasukkan password pengguna. -->
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                />

                <!-- Menampilkan pesan kesalahan jika validasi password gagal. -->
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <!-- Bagian tombol konfirmasi yang diletakkan di sebelah kanan. -->
            <div class="mt-4 flex justify-end">

                <!-- Tombol untuk mengirim formulir konfirmasi password. -->
                <PrimaryButton
                    class="ms-4"

                    <!-- Memberikan transparansi pada tombol ketika proses sedang berjalan. -->
                    :class="{ 'opacity-25': form.processing }"

                    <!-- Menonaktifkan tombol selama formulir sedang diproses. -->
                    :disabled="form.processing"
                >
                    Confirm
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
