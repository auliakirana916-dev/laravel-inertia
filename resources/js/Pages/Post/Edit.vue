<script setup>

// Mengimpor layout utama aplikasi.
// Layout ini digunakan sebagai pembungkus halaman edit post.
import Layout from '../../Layouts/App.vue'

// Menerima props bernama post dan errors dari controller Laravel.
// post berisi data postingan yang akan diedit.
// errors berisi pesan kesalahan validasi dari backend.
const props = defineProps({
    post: Object,
    errors: Object
})

// Mengimpor reactive dari Vue.
// reactive digunakan untuk membuat objek yang datanya bersifat reaktif.
import { reactive } from 'vue'

// Mengimpor router dari Inertia.js.
// router digunakan untuk mengirim permintaan ke server Laravel.
import { router } from '@inertiajs/vue3'

// Membuat state bernama post menggunakan reactive.
// Data awal diambil dari props.post yang dikirim oleh controller.
// title diisi dengan judul post yang sudah tersimpan.
// content diisi dengan isi post yang sudah tersimpan.
// Dengan begitu, formulir akan menampilkan data lama sebelum diedit.
const post = reactive({
    title: props.post.title,
    content: props.post.content
})

// Membuat fungsi updatePost untuk memperbarui data post.
function updatePost() {

    // Mengirim data post ke server Laravel menggunakan metode PUT.
    // props.post.id digunakan untuk menentukan post yang akan diperbarui.
    // post berisi data title dan content yang sudah diedit pengguna.
    router.put(`/posts/${props.post.id}`, post)
}

</script>

<template>

    <!-- Menggunakan Layout sebagai pembungkus tampilan halaman edit post. -->
    <Layout>

        <!-- Membuat card Bootstrap untuk membungkus formulir edit post. -->
        <div class="card border-0 rounded shadow">

            <!-- Bagian isi card. -->
            <div class="card-body">

                <!-- Judul halaman edit post. -->
                <h4>EDIT POST</h4>

                <!-- Garis pemisah antara judul dan formulir. -->
                <hr>

                <!-- Formulir untuk mengedit data post.
                     @submit.prevent mencegah browser melakukan submit secara default
                     dan menjalankan fungsi updatePost. -->
                <form @submit.prevent="updatePost">

                    <!-- ================= INPUT TITLE ================= -->

                    <div class="mb-3">

                        <!-- Label untuk input judul post. -->
                        <label class="form-label">TITLE POST</label>

                        <!-- Input untuk mengedit judul post.
                             v-model menghubungkan input dengan post.title.
                             Nilai awalnya berasal dari data post yang sudah tersimpan. -->
                        <input
                            type="text"
                            class="form-control"
                            v-model="post.title"
                            placeholder="Masukkan Title Post"
                        >

                        <!-- Menampilkan pesan error jika validasi title gagal. -->
                        <div v-if="errors.title" class="mt-2 alert alert-danger">
                            {{ errors.title }}
                        </div>

                    </div>

                    <!-- ================= INPUT CONTENT ================= -->

                    <div class="mb-3">

                        <!-- Label untuk textarea isi post. -->
                        <label class="form-label">CONTENT</label>

                        <!-- Textarea untuk mengedit isi atau konten post.
                             rows="5" menentukan tinggi awal textarea.
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

                        <!-- Tombol untuk mengirim perubahan data post.
                             type="submit" menjalankan event submit pada form. -->
                        <button
                            type="submit"
                            class="btn btn-primary btn-md shadow-sm me-2"
                        >
                            UPDATE
                        </button>

                        <!-- Tombol untuk mengembalikan input ke nilai awal formulir.
                             type="reset" mengatur ulang nilai input. -->
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
