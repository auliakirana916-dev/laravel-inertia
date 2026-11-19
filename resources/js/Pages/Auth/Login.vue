<script setup>
// Mengimpor komponen Checkbox untuk pilihan Remember me.
import Checkbox from '@/Components/Checkbox.vue';

// Mengimpor layout khusus halaman tamu, seperti halaman Login dan Register.
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
// Link untuk navigasi Inertia, dan useForm untuk mengelola formulir.
import { Head, Link, useForm } from '@inertiajs/vue3';

// Mendefinisikan props yang diterima dari controller Laravel.
// canResetPassword menentukan apakah link lupa password ditampilkan.
// status digunakan untuk menampilkan pesan pemberitahuan.
defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

// Membuat objek form menggunakan useForm.
// email    : menyimpan alamat email pengguna.
// password : menyimpan password pengguna.
// remember : menentukan apakah pengguna ingin mengingat sesi login.
const form = useForm({
    email: '',
    password: '',
    remember: false,
});

// Fungsi untuk mengirimkan data login ke server Laravel.
const submit = () => {

    // Mengirim data formulir menggunakan metode POST ke route login.
    form.post(route('login'), {

        // Dijalankan setelah proses pengiriman selesai,
        // baik berhasil maupun gagal.
        // Mengosongkan input password demi keamanan.
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <!-- Menggunakan GuestLayout sebagai pembungkus tampilan halaman login. -->
    <GuestLayout>

        <!-- Mengatur judul halaman pada browser menjadi Log in. -->
        <Head title="Log in" />

        <!-- Menampilkan pesan status jika properti status memiliki nilai. -->
        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">

            <!-- Menampilkan isi pesan status dari Laravel. -->
            {{ status }}
        </div>

        <!-- Formulir login.
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

                <!-- Menampilkan pesan kesalahan validasi email dari Laravel. -->
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Bagian input password. -->
            <div class="mt-4">

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
                />

                <!-- Menampilkan pesan kesalahan validasi password dari Laravel. -->
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <!-- Bagian pilihan untuk mengingat sesi login pengguna. -->
            <div class="mt-4 block">

                <label class="flex items-center">

                    <!-- Checkbox untuk mengaktifkan atau menonaktifkan Remember me.
                         Nilainya terhubung dengan form.remember. -->
                    <Checkbox name="remember" v-model:checked="form.remember" />

                    <!-- Teks keterangan di samping checkbox. -->
                    <span class="ms-2 text-sm text-gray-600">
                        Remember me
                    </span>
                </label>
            </div>

            <!-- Bagian link lupa password dan tombol login. -->
            <div class="mt-4 flex items-center justify-end">

                <!-- Link menuju halaman Forgot Password.
                     Hanya ditampilkan jika canResetPassword bernilai true. -->
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Forgot your password?
                </Link>

                <!-- Tombol untuk mengirimkan formulir login. -->
                <PrimaryButton
                    class="ms-4"

                    <!-- Mengatur transparansi tombol ketika formulir sedang diproses. -->
                    :class="{ 'opacity-25': form.processing }"

                    <!-- Menonaktifkan tombol selama proses login berlangsung. -->
                    :disabled="form.processing"
                >
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
