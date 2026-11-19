<?php

// Menentukan namespace controller utama aplikasi
namespace App\Http\Controllers;

// Mengimpor model Post untuk mengelola data postingan di database
use App\Models\Post;

// Mengimpor Inertia untuk menghubungkan backend Laravel dengan frontend
use Inertia\Inertia;

// Mengimpor Request untuk menangani data yang dikirimkan pengguna
use Illuminate\Http\Request;

// Mengimpor Redirect untuk melakukan pengalihan halaman
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    /**
     * Menampilkan seluruh data postingan.
     */
    public function index()
    {
        // Mengambil seluruh data postingan dari database
        // dan mengurutkannya berdasarkan data terbaru
        $posts = Post::latest()->get();

        // Menampilkan halaman Post/Index menggunakan Inertia
        // sekaligus mengirimkan data postingan ke halaman frontend
        return Inertia::render('Post/Index', [
            'posts' => $posts
        ]);
    }

    /**
     * Menampilkan halaman untuk membuat postingan baru.
     */
    public function create()
    {
        // Menampilkan halaman Post/Create
        // sebagai tempat pengguna mengisi data postingan
        return Inertia::render('Post/Create');
    }

    /**
     * Menyimpan data postingan baru ke database.
     *
     * @param Request $request Berisi data yang dikirimkan pengguna
     */
    public function store(Request $request)
    {
        // Melakukan validasi terhadap data yang dimasukkan pengguna
        $request->validate([

            // Judul postingan wajib diisi
            'title'   => 'required',

            // Isi postingan wajib diisi
            'content' => 'required',
        ]);

        // Membuat postingan baru dan menyimpan datanya ke database
        $post = Post::create([

            // Mengambil judul postingan dari request
            'title'   => $request->title,

            // Mengambil isi postingan dari request
            'content' => $request->content
        ]);

        // Memeriksa apakah proses penyimpanan berhasil
        if ($post) {

            // Jika berhasil, arahkan pengguna ke halaman daftar postingan
            // sekaligus menampilkan pesan keberhasilan
            return Redirect::route('posts.index')
                ->with('message', 'Data Berhasil Disimpan!');
        }
    }

    /**
     * Menampilkan halaman edit postingan berdasarkan data yang dipilih.
     *
     * @param Post $post Data postingan yang akan diedit
     */
    public function edit(Post $post)
    {
        // Menampilkan halaman Post/Edit menggunakan Inertia
        // sekaligus mengirimkan data postingan yang akan diedit
        return Inertia::render('Post/Edit', [
            'post' => $post
        ]);
    }

    /**
     * Memperbarui data postingan yang sudah ada.
     *
     * @param Request $request Berisi data perubahan dari pengguna
     * @param Post $post Data postingan yang akan diperbarui
     */
    public function update(Request $request, Post $post)
    {
        // Melakukan validasi terhadap data yang akan diperbarui
        $request->validate([

            // Judul postingan wajib diisi
            'title'   => 'required',

            // Isi postingan wajib diisi
            'content' => 'required',
        ]);

        // Memperbarui data postingan di database
        $post->update([

            // Mengambil judul baru dari request
            'title'   => $request->title,

            // Mengambil isi postingan baru dari request
            'content' => $request->content
        ]);

        // Memeriksa apakah data postingan berhasil diperbarui
        if ($post) {

            // Jika berhasil, arahkan pengguna ke halaman daftar postingan
            // sekaligus menampilkan pesan keberhasilan
            return Redirect::route('posts.index')
                ->with('message', 'Data Berhasil Diupdate!');
        }
    }

    /**
     * Menghapus data postingan berdasarkan ID.
     *
     * @param mixed $id ID postingan yang akan dihapus
     */
    public function destroy($id)
    {
        // Mencari data postingan berdasarkan ID
        // Jika data tidak ditemukan, Laravel akan menghasilkan error 404
        $post = Post::findOrFail($id);

        // Menghapus data postingan dari database
        $post->delete();

        // Memeriksa apakah data postingan berhasil dihapus
        if ($post) {

            // Jika berhasil, arahkan pengguna ke halaman daftar postingan
            // sekaligus menampilkan pesan keberhasilan
            return Redirect::route('posts.index')
                ->with('message', 'Data Berhasil Dihapus!');
        }
    }
}
