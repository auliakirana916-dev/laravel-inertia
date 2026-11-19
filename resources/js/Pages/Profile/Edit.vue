<script setup>
// Mengimpor layout utama untuk halaman pengguna yang sudah login.
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Mengimpor komponen untuk menghapus akun pengguna.
import DeleteUserForm from './Partials/DeleteUserForm.vue';

// Mengimpor komponen untuk memperbarui password pengguna.
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';

// Mengimpor komponen untuk memperbarui informasi profil pengguna.
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

// Mengimpor Head dari Inertia untuk mengatur judul halaman browser.
import { Head } from '@inertiajs/vue3';

// Mendefinisikan properti (props) yang diterima dari Controller Laravel.
defineProps({
    // Menentukan apakah pengguna wajib melakukan verifikasi email.
    mustVerifyEmail: {
        type: Boolean,
    },

    // Menyimpan status atau pesan yang dikirim dari server.
    status: {
        type: String,
    },
});
</script>

<template>
    <!-- Mengatur judul halaman browser menjadi Profile. -->
    <Head title="Profile" />

    <!-- Menggunakan layout utama untuk pengguna yang sudah login. -->
    <AuthenticatedLayout>
        <!-- Mengisi slot header pada AuthenticatedLayout. -->
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                <!-- Menampilkan judul halaman Profile. -->
                Profile
            </h2>
        </template>

        <!-- Memberikan jarak vertikal pada keseluruhan konten halaman. -->
        <div class="py-12">

            <!-- Mengatur lebar konten, posisi tengah, dan jarak antarbagian. -->
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">

                <!-- Bagian untuk memperbarui informasi profil pengguna. -->
                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <!-- Memanggil form untuk memperbarui informasi profil. -->
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <!-- Bagian untuk memperbarui password pengguna. -->
                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <!-- Memanggil form untuk memperbarui password. -->
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <!-- Bagian untuk menghapus akun pengguna. -->
                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <!-- Memanggil form untuk menghapus akun pengguna. -->
                    <DeleteUserForm class="max-w-xl" />
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
