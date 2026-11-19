<script setup>

// Mengimpor layout utama aplikasi.
// Layout ini digunakan sebagai pembungkus halaman tambah post.
import Layout from '../../Layouts/App.vue'

// Menerima props bernama errors dari controller Laravel.
// errors berisi pesan kesalahan validasi yang dikirim oleh backend.
defineProps({
    errors: Object
})

// Mengimpor reactive dari Vue.
// reactive digunakan untuk membuat objek yang datanya bersifat reaktif.
import { reactive } from 'vue'

// Mengimpor router dari Inertia.js.
// router digunakan untuk mengirim permintaan ke server Laravel.
import { router } from '@inertiajs/vue3'

// Membuat state bernama post menggunakan reactive.
// State ini digunakan untuk menyimpan data post yang akan ditambahkan.
// title digunakan untuk menyimpan judul post.
// content digunakan untuk menyimpan isi atau konten post.
const post = reactive({
    title: '',
    content: ''
})

// Membuat fungsi storePost untuk menyimpan post baru.
function storePost() {

    // Mengirim data post ke server Laravel menggunakan metode POST.
    // URL /posts akan diproses oleh route Laravel yang sesuai.
    // Data yang dikirim berisi title dan content.
    router.post('/posts', post)
}

</script>

<template>

    <!-- Menggunakan Layout sebagai pembungkus tampilan halaman. -->
    <Layout>

        <!-- Membuat card Bootstrap untuk membungkus formulir tambah post. -->
        <div class="card border-0 rounded shadow">

            <!-- Bagian isi card. -->
            <div class="card-body">

                <!-- Judul halaman tambah post. -->
                <h4>TAMBAH POST</h4>

                <!-- Garis pemisah antara judul dan formulir. -->
                <hr>

                <!-- Formulir untuk menambahkan post baru.
                     @submit.prevent mencegah browser melakukan submit secara default
                     dan menjalankan fungsi storePost. -->
                <form @submit.prevent="storePost">

                    <!-- ================= INPUT TITLE ================= -->

                    <div class="mb-3">

                        <!-- Label untuk input judul post. -->
                        <label class="form-label">TITLE POST</label>

                        <!-- Input untuk memasukkan judul post.
                             v-model menghubungkan input dengan post.title
                             sehingga perubahan input langsung memperbarui state. -->
                        <input
                            type="text"
                            class="form-control"
                            v-model="post.title"
                            placeholder="Masukkan Title Post"
                        >

                        <!-- Menampilkan pesan error jika validasi title gagal.
                             errors.title berasal dari controller Laravel. -->
                        <div v-if="errors.title" class="mt-2 alert alert-danger">
                            {{ errors.title }}
                        </div>

                    </div>

                    <!-- ================= INPUT CONTENT ================= -->

                    <div class="mb-3">

                        <!-- Label untuk textarea isi post. -->
                        <label class="form-label">CONTENT</label>

                        <!-- Textarea untuk memasukkan isi atau konten post.
                             rows="5" menentukan tinggi awal textarea sebanyak 5 baris.
                             v-model menghubungkan textarea dengan post.content. -->
                        <textarea
                            class="form-control"
                            rows="5"
                            v-model="post.content"
                            placeholder="Masukkan Content Post"
                        ></textarea>

                        <!-- Menampilkan pesan error jika validasi content gagal. -->
                        <div v-if="errors.content" class="mt-2 alert alert-danger">
                            {{ errors.content }}
                        </div>

                    </div>

                    <!-- ================= TOMBOL FORM ================= -->

                    <div class="mb-3">

                        <!-- Tombol untuk mengirim formulir dan menyimpan post.
                             type="submit" akan menjalankan event submit pada form. -->
                        <button
                            type="submit"
                            class="btn btn-primary btn-md shadow-sm me-2"
                        >
                            SIMPAN
                        </button>

                        <!-- Tombol untuk mengembalikan input formulir ke nilai awal.
                             type="reset" mengatur ulang nilai input berdasarkan nilai awalnya. -->
                        <button
                            type="reset"
                            class="btn btn-warning btn-md shadow-sm"
                        >
                            RESET
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </Layout>

</template>
