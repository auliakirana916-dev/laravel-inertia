<script setup>

// Mengimpor Layout utama aplikasi.
// Layout digunakan sebagai pembungkus tampilan halaman daftar post.
import Layout from '../../Layouts/App.vue'

// Mengimpor Link untuk navigasi halaman menggunakan Inertia.js.
// router digunakan untuk mengirim permintaan ke server Laravel.
import { Link, router } from '@inertiajs/vue3'

// Menerima props bernama posts dari controller Laravel.
// posts berisi kumpulan data postingan yang akan ditampilkan.
// type Array berarti data posts harus berupa array.
// default digunakan untuk memberikan array kosong jika tidak ada data.
defineProps({
    posts: {
        type: Array,
        default: () => []
    }
})

// Membuat fungsi deletePost untuk menghapus postingan berdasarkan ID.
function deletePost(id) {

    // Menampilkan kotak konfirmasi sebelum menghapus data.
    // Jika pengguna menekan OK, proses penghapusan akan dilanjutkan.
    if (confirm('Apakah kamu yakin ingin menghapus data ini?')) {

        // Mengirim permintaan DELETE ke Laravel berdasarkan ID post.
        // Laravel akan memproses permintaan melalui route yang sesuai.
        router.delete(`/posts/${id}`)
    }
}

// Membuat fungsi logout untuk mengeluarkan pengguna dari akun.
function logout() {

    // Mengirim permintaan POST ke route /logout.
    // Laravel akan memproses proses logout dan mengakhiri sesi pengguna.
    router.post('/logout')
}

</script>

<template>

    <!-- Menggunakan Layout utama sebagai pembungkus halaman daftar post. -->
    <Layout>

        <!-- Container Bootstrap untuk membatasi dan mengatur posisi konten halaman. -->
        <div class="container mt-5">

            <!-- ================= TOMBOL LOGOUT ================= -->

            <!-- Membuat wadah tombol Logout.
                 justify-content-end membuat tombol berada di sebelah kanan.
                 mb-3 memberikan jarak bawah. -->
            <div class="d-flex justify-content-end mb-3">

                <!-- Tombol Logout.
                     @click menjalankan fungsi logout ketika tombol diklik. -->
                <button
                    @click="logout"
                    class="btn btn-danger"
                >
                    LOGOUT
                </button>

            </div>


            <!-- ================= TOMBOL TAMBAH DATA ================= -->

            <!-- Membuat wadah untuk tombol menuju halaman tambah post. -->
            <div class="mb-3">

                <!-- Link untuk membuka halaman tambah post.
                     href menentukan alamat halaman yang dituju.
                     class memberikan tampilan tombol Bootstrap. -->
                <Link
                    href="/posts/create"
                    class="btn btn-primary"
                >
                    TAMBAH DATA
                </Link>

            </div>


            <!-- ================= FLASH MESSAGE ================= -->

            <!-- Menampilkan pesan pemberitahuan dari Laravel.
                 v-if memeriksa apakah flash message tersedia.
                 Tanda ?. digunakan untuk mengakses properti secara aman
                 jika objek sebelumnya bernilai null atau undefined. -->
            <div
                v-if="$page.props.flash?.message"
                class="alert alert-success"
            >

                <!-- Menampilkan isi pesan flash dari Laravel. -->
                {{ $page.props.flash.message }}

            </div>


            <!-- ================= TABEL DATA POST ================= -->

            <!-- Card Bootstrap untuk membungkus tabel daftar postingan. -->
            <div class="card border-0 rounded shadow-sm">

                <!-- Bagian isi card. -->
                <div class="card-body">

                    <!-- Membuat tabel untuk menampilkan data postingan. -->
                    <table class="table table-bordered">

                        <!-- Bagian kepala tabel yang berisi nama setiap kolom. -->
                        <thead>
                            <tr>
                                <th>TITLE</th>
                                <th>CONTENT</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>

                        <!-- Bagian isi tabel yang menampilkan data postingan. -->
                        <tbody>

                            <!-- Melakukan perulangan menggunakan v-for
                                 untuk menampilkan setiap data post dari array posts.
                                 post merupakan variabel untuk setiap data yang sedang diproses.
                                 :key menggunakan ID sebagai identitas unik setiap baris. -->
                            <tr
                                v-for="post in posts"
                                :key="post.id"
                            >

                                <!-- Menampilkan judul postingan. -->
                                <td>{{ post.title }}</td>

                                <!-- Menampilkan isi atau konten postingan. -->
                                <td>{{ post.content }}</td>

                                <!-- Kolom yang berisi tombol Edit dan Delete. -->
                                <td>

                                    <!-- Link untuk membuka halaman edit post.
                                         post.id digunakan untuk menentukan data yang akan diedit.
                                         class mengatur ukuran dan tampilan tombol. -->
                                    <Link
                                        :href="`/posts/${post.id}/edit`"
                                        class="btn btn-sm btn-primary me-2"
                                    >
                                        EDIT
                                    </Link>

                                    <!-- Tombol untuk menghapus postingan.
                                         @click menjalankan fungsi deletePost
                                         dengan mengirimkan ID post yang dipilih. -->
                                    <button
                                        @click="deletePost(post.id)"
                                        class="btn btn-sm btn-danger"
                                    >
                                        DELETE
                                    </button>

                                </td>
                            </tr>

                            <!-- Menampilkan baris pemberitahuan jika tidak ada data post.
                                 posts.length === 0 berarti jumlah data dalam array adalah nol. -->
                            <tr v-if="posts.length === 0">

                                <!-- colspan="3" membuat kolom pesan memenuhi tiga kolom tabel.
                                     text-center membuat tulisan berada di tengah. -->
                                <td colspan="3" class="text-center">
                                    Belum ada data
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </Layout>

</template>
