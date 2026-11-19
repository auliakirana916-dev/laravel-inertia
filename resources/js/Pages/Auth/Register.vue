<script setup>
// Mengimpor layout khusus halaman tamu, seperti Login dan Register.
import GuestLayout from '@/Layouts/GuestLayout.vue';

// Mengimpor komponen untuk menampilkan pesan kesalahan validasi.
import InputError from '@/Components/InputError.vue';

// Mengimpor komponen label untuk input.
import InputLabel from '@/Components/InputLabel.vue';

// Mengimpor komponen tombol utama.
import PrimaryButton from '@/Components/PrimaryButton.vue';

// Mengimpor komponen input teks.
import TextInput from '@/Components/TextInput.vue';

// Mengimpor Head untuk mengatur judul halaman,
// Link untuk navigasi, dan useForm untuk mengelola formulir Inertia.
import { Head, Link, useForm } from '@inertiajs/vue3';

// Membuat objek form menggunakan useForm.
// name                  : menyimpan nama pengguna.
// email                 : menyimpan alamat email pengguna.
// password              : menyimpan password yang dibuat pengguna.
// password_confirmation : menyimpan konfirmasi password pengguna.
const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

// Fungsi untuk mengirimkan data pendaftaran akun ke server Laravel.
const submit = () => {

    // Mengirim data formulir menggunakan metode POST ke route register.
    form.post(route('register'), {

        // Dijalankan setelah proses pengiriman selesai,
        // baik berhasil maupun gagal.
        // Mengosongkan kembali kolom password dan konfirmasi password.
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <!-- Menggunakan GuestLayout sebagai pembungkus tampilan halaman register. -->
    <GuestLayout>

        <!-- Mengatur judul halaman pada browser menjadi Register. -->
        <Head title="Register" />

        <!-- Formulir pendaftaran akun.
             .prevent mencegah browser melakukan submit secara default. -->
        <form @submit.prevent="submit">

            <!-- Bagian input nama pengguna. -->
            <div>
                <!-- Label untuk kolom nama. -->
                <InputLabel for="name" value="Name" />

                <!-- Input untuk memasukkan nama pengguna. -->
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <!-- Menampilkan pesan kesalahan validasi nama dari Laravel. -->
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <!-- Bagian input email pengguna. -->
            <div class="mt-4">

                <!-- Label untuk kolom email. -->
                <InputLabel for="email" value="Email" />

                <!-- Input untuk memasukkan alamat email pengguna. -->
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <!-- Menampilkan pesan kesalahan validasi email dari Laravel. -->
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Bagian input password. -->
            <div class="mt-4">

                <!-- Label untuk kolom password. -->
                <InputLabel for="password" value="Password" />

                <!-- Input untuk membuat password akun. -->
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <!-- Menampilkan pesan kesalahan validasi password dari Laravel. -->
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <!-- Bagian konfirmasi password. -->
            <div class="mt-4">

                <!-- Label untuk kolom konfirmasi password. -->
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />

                <!-- Input untuk memasukkan ulang password sebagai konfirmasi. -->
                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <!-- Menampilkan pesan kesalahan jika konfirmasi password tidak sesuai. -->
                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <!-- Bagian link menuju halaman login dan tombol pendaftaran. -->
            <div class="mt-4 flex items-center justify-end">

                <!-- Link untuk pengguna yang sudah memiliki akun.
                     Ketika diklik, pengguna diarahkan ke halaman Login. -->
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Already registered?
                </Link>

                <!-- Tombol untuk mengirimkan formulir pendaftaran. -->
                <PrimaryButton
                    class="ms-4"

                    <!-- Memberikan transparansi pada tombol ketika formulir sedang diproses. -->
                    :class="{ 'opacity-25': form.processing }"

                    <!-- Menonaktifkan tombol selama proses pendaftaran berlangsung. -->
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
