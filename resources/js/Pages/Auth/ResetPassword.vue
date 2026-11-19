<script setup>
// Mengimpor layout khusus halaman tamu, seperti Login, Register, dan Reset Password.
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

// Menerima data email dan token yang dikirimkan dari Laravel.
// email : alamat email pengguna yang melakukan reset password.
// token : token unik yang digunakan untuk memverifikasi permintaan reset password.
const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

// Membuat objek form menggunakan useForm.
// token                 : menyimpan token reset password dari Laravel.
// email                 : menyimpan alamat email pengguna.
// password              : menyimpan password baru.
// password_confirmation : menyimpan konfirmasi password baru.
const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

// Fungsi untuk mengirimkan data reset password ke server Laravel.
const submit = () => {

    // Mengirim data formulir menggunakan metode POST ke route password.store.
    form.post(route('password.store'), {

        // Dijalankan setelah proses pengiriman selesai,
        // baik berhasil maupun gagal.
        // Mengosongkan kembali kolom password dan konfirmasi password.
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <!-- Menggunakan GuestLayout sebagai pembungkus tampilan halaman reset password. -->
    <GuestLayout>

        <!-- Mengatur judul halaman pada browser menjadi Reset Password. -->
        <Head title="Reset Password" />

        <!-- Formulir untuk mengganti password lama dengan password baru.
             .prevent mencegah browser melakukan submit secara default. -->
        <form @submit.prevent="submit">

            <!-- Bagian input email pengguna. -->
            <div>
                <!-- Label untuk kolom email. -->
                <InputLabel for="email" value="Email" />

                <!-- Input untuk menampilkan atau mengubah alamat email pengguna. -->
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <!-- Menampilkan pesan kesalahan validasi email dari Laravel. -->
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Bagian input password baru. -->
            <div class="mt-4">

                <!-- Label untuk kolom password baru. -->
                <InputLabel for="password" value="Password" />

                <!-- Input untuk memasukkan password baru. -->
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

            <!-- Bagian konfirmasi password baru. -->
            <div class="mt-4">

                <!-- Label untuk kolom konfirmasi password. -->
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />

                <!-- Input untuk memasukkan ulang password baru sebagai konfirmasi. -->
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

            <!-- Bagian tombol untuk mengirimkan permintaan reset password. -->
            <div class="mt-4 flex items-center justify-end">

                <!-- Tombol untuk mengirimkan password baru ke Laravel. -->
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Reset Password
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
