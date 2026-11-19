<script setup>
// Mengimpor ref dari Vue untuk membuat data reaktif.
import { ref } from 'vue';

// Mengimpor komponen logo aplikasi.
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

// Mengimpor komponen dropdown untuk menu pengaturan pengguna.
import Dropdown from '@/Components/Dropdown.vue';

// Mengimpor komponen link yang digunakan di dalam dropdown.
import DropdownLink from '@/Components/DropdownLink.vue';

// Mengimpor komponen navigasi untuk tampilan desktop.
import NavLink from '@/Components/NavLink.vue';

// Mengimpor komponen navigasi untuk tampilan perangkat mobile.
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

// Mengimpor Link dari Inertia untuk navigasi halaman tanpa reload penuh.
import { Link } from '@inertiajs/vue3';

// Menyimpan status apakah menu navigasi mobile sedang terbuka atau tertutup.
// Nilai false berarti menu dalam keadaan tertutup.
const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <!-- Pembungkus utama halaman dengan tinggi minimal satu layar dan latar abu-abu. -->
        <div class="min-h-screen bg-gray-100">

            <!-- Bagian navigasi utama aplikasi. -->
            <nav class="border-b border-gray-100 bg-white">

                <!-- Menu navigasi utama untuk tampilan desktop. -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">

                        <div class="flex">
                            <!-- Logo aplikasi yang mengarahkan pengguna ke halaman Dashboard. -->
                            <div class="flex shrink-0 items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800"
                                    />
                                </Link>
                            </div>

                            <!-- Kumpulan link navigasi untuk tampilan desktop. -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                                <!-- Link Dashboard dengan status aktif jika sedang berada di halaman Dashboard. -->
                                <NavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    Dashboard
                                </NavLink>
                            </div>
                        </div>

                        <!-- Menu pengaturan pengguna yang hanya tampil pada layar desktop. -->
                        <div class="hidden sm:ms-6 sm:flex sm:items-center">

                            <!-- Pembungkus dropdown pengaturan pengguna. -->
                            <div class="relative ms-3">
                                <Dropdown align="right" width="48">

                                    <!-- Tombol pemicu untuk membuka dropdown. -->
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                            >
                                                <!-- Menampilkan nama pengguna yang sedang login. -->
                                                {{ $page.props.auth.user.name }}

                                                <!-- Ikon panah bawah sebagai penanda dropdown. -->
                                                <svg
                                                    class="-me-0.5 ms-2 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <!-- Isi menu dropdown pengaturan pengguna. -->
                                    <template #content>

                                        <!-- Link untuk membuka halaman profil pengguna. -->
                                        <DropdownLink :href="route('profile.edit')">
                                            Profile
                                        </DropdownLink>

                                        <!-- Tombol untuk logout menggunakan metode POST. -->
                                        <DropdownLink
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                        >
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Tombol hamburger yang hanya muncul pada tampilan mobile. -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                            >
                                <!-- Ikon hamburger dan ikon silang untuk menu mobile. -->
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <!-- Ikon tiga garis yang tampil ketika menu tertutup. -->
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />

                                    <!-- Ikon silang yang tampil ketika menu terbuka. -->
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Menu navigasi yang digunakan pada tampilan perangkat mobile. -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <!-- Link navigasi Dashboard untuk tampilan mobile. -->
                    <div class="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Bagian pengaturan akun pengguna pada tampilan mobile. -->
                    <div class="border-t border-gray-200 pb-1 pt-4">

                        <!-- Menampilkan informasi nama dan email pengguna. -->
                        <div class="px-4">
                            <div class="text-base font-medium text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>

                            <div class="text-sm font-medium text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <!-- Link pengaturan profil dan logout untuk tampilan mobile. -->
                        <div class="mt-3 space-y-1">

                            <!-- Link menuju halaman edit profil. -->
                            <ResponsiveNavLink :href="route('profile.edit')">
                                Profile
                            </ResponsiveNavLink>

                            <!-- Tombol logout menggunakan metode POST. -->
                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Bagian judul halaman yang hanya ditampilkan jika slot header tersedia. -->
            <header
                class="bg-white shadow"
                v-if="$slots.header"
            >
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

                    <!-- Menampilkan konten header yang dikirim oleh halaman pemanggil layout. -->
                    <slot name="header" />
                </div>
            </header>

            <!-- Bagian utama untuk menampilkan isi halaman. -->
            <main>

                <!-- Menampilkan konten halaman yang menggunakan layout ini. -->
                <slot />
            </main>
        </div>
    </div>
</template>
