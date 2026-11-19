<script setup>
// Mengimpor layout utama untuk pengguna yang sudah berhasil login.
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Mengimpor Head dari Inertia untuk mengatur judul halaman browser.
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <!-- Mengatur judul halaman browser menjadi Dashboard. -->
    <Head title="Dashboard" />

    <!-- Menggunakan layout utama untuk pengguna yang sudah login. -->
    <AuthenticatedLayout>

        <!-- Mengisi bagian header yang disediakan oleh AuthenticatedLayout. -->
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                <!-- Menampilkan judul halaman Dashboard. -->
                Dashboard
            </h2>
        </template>

        <!-- Memberikan jarak vertikal pada konten halaman. -->
        <div class="py-12">

            <!-- Mengatur lebar konten agar berada di tengah halaman. -->
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

                <!-- Membuat kotak konten dengan latar putih, bayangan, dan sudut membulat. -->
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >

                    <!-- Memberikan jarak dalam dan mengatur warna teks. -->
                    <div class="p-6 text-gray-900">

                        <!-- Menampilkan pesan bahwa pengguna sudah berhasil login. -->
                        You're logged in!

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
