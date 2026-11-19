<!DOCTYPE html>
<!-- Menentukan bahwa dokumen menggunakan standar HTML5. -->
<html lang="id">

<head>
    <!-- Mengatur karakter agar mendukung berbagai jenis teks dan simbol. -->
    <meta charset="UTF-8">

    <!-- Mengatur tampilan agar responsif dan menyesuaikan lebar layar perangkat. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Menentukan judul yang ditampilkan pada tab browser. -->
    <title>My Laravel App</title>

    <!-- Bagian CSS untuk mengatur tampilan halaman website. -->
    <style>

        /* Mengatur seluruh elemen agar memiliki margin dan padding awal nol.
           box-sizing border-box membuat ukuran elemen termasuk padding dan border. */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Mengatur tampilan dasar seluruh halaman website. */
        body {
            font-family: Arial, sans-serif; /* Menggunakan jenis huruf Arial. */
            background: #f8fafc; /* Mengatur warna latar belakang halaman. */
            color: #1e293b; /* Mengatur warna teks utama. */
        }

        /* ================= NAVBAR ================= */

        /* Mengatur navigasi bagian atas halaman. */
        nav {
            width: 100%; /* Navbar memenuhi seluruh lebar halaman. */
            height: 75px; /* Menentukan tinggi navbar. */
            padding: 0 8%; /* Memberikan jarak kiri dan kanan sebesar 8%. */
            display: flex; /* Mengaktifkan layout Flexbox. */
            justify-content: space-between; /* Memberi jarak antara logo dan tombol Login. */
            align-items: center; /* Membuat isi navbar sejajar secara vertikal. */
            background: white; /* Memberikan warna latar putih. */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); /* Memberikan bayangan halus. */
        }

        /* Mengatur tampilan tulisan logo MyApp. */
        .logo {
            font-size: 24px; /* Mengatur ukuran tulisan logo. */
            font-weight: bold; /* Membuat tulisan menjadi tebal. */
            color: #1e293b; /* Mengatur warna tulisan logo. */
        }

        /* Mengatur tampilan tombol Login. */
        .login-btn {
            padding: 10px 24px; /* Mengatur jarak dalam tombol. */
            border: none; /* Menghilangkan garis tepi tombol. */
            border-radius: 8px; /* Membuat sudut tombol melengkung. */
            background: #1e293b; /* Mengatur warna latar tombol. */
            color: white; /* Mengatur warna tulisan tombol. */
            font-size: 15px; /* Mengatur ukuran tulisan tombol. */
            cursor: pointer; /* Mengubah kursor menjadi tangan saat diarahkan ke tombol. */
            transition: 0.3s; /* Memberikan animasi perubahan selama 0,3 detik. */
        }

        /* Memberikan efek ketika tombol Login diarahkan atau disentuh kursor. */
        .login-btn:hover {
            background: #334155; /* Mengubah warna latar tombol. */
            transform: translateY(-2px); /* Menggeser tombol sedikit ke atas. */
        }

        /* ================= HERO ================= */

        /* Mengatur bagian utama halaman yang berisi teks sambutan dan kartu dashboard. */
        .hero {
            min-height: calc(100vh - 75px); /* Tinggi minimal layar dikurangi tinggi navbar. */
            display: flex; /* Menggunakan Flexbox untuk menyusun konten. */
            align-items: center; /* Membuat konten sejajar secara vertikal. */
            justify-content: space-between; /* Memberi jarak antara teks dan kartu dashboard. */
            gap: 50px; /* Memberikan jarak antara kedua bagian konten. */
            padding: 60px 8%; /* Memberikan jarak dalam bagian hero. */
        }

        /* Mengatur area teks pada bagian hero. */
        .hero-text {
            max-width: 600px; /* Membatasi lebar maksimal area teks. */
        }

        /* Mengatur label kecil bertuliskan WELCOME TO MY APP. */
        .badge {
            display: inline-block; /* Membuat badge dapat diatur ukuran dan jaraknya. */
            padding: 8px 14px; /* Memberikan jarak dalam badge. */
            margin-bottom: 20px; /* Memberikan jarak bawah badge. */
            border-radius: 20px; /* Membuat sudut badge membulat. */
            background: #e0e7ff; /* Mengatur warna latar badge. */
            color: #4f46e5; /* Mengatur warna tulisan badge. */
            font-size: 13px; /* Mengatur ukuran tulisan badge. */
            font-weight: bold; /* Membuat tulisan badge menjadi tebal. */
        }

        /* Mengatur judul utama pada bagian hero. */
        .hero-text h1 {
            font-size: 55px; /* Mengatur ukuran tulisan judul. */
            line-height: 1.1; /* Mengatur jarak antarbaris judul. */
            margin-bottom: 20px; /* Memberikan jarak bawah judul. */
        }

        /* Memberikan warna khusus pada teks yang berada di dalam span judul. */
        .hero-text h1 span {
            color: #6366f1; /* Mengubah warna teks menjadi ungu kebiruan. */
        }

        /* Mengatur paragraf deskripsi pada bagian hero. */
        .hero-text p {
            font-size: 18px; /* Mengatur ukuran tulisan paragraf. */
            line-height: 1.7; /* Mengatur jarak antarbaris paragraf. */
            color: #64748b; /* Mengatur warna tulisan paragraf. */
            margin-bottom: 30px; /* Memberikan jarak bawah paragraf. */
        }

        /* Mengatur tampilan tombol Mulai Sekarang. */
        .start-btn {
            padding: 15px 28px; /* Memberikan jarak dalam tombol. */
            border: none; /* Menghilangkan garis tepi tombol. */
            border-radius: 10px; /* Membuat sudut tombol melengkung. */
            background: #6366f1; /* Mengatur warna latar tombol. */
            color: white; /* Mengatur warna tulisan tombol. */
            font-size: 16px; /* Mengatur ukuran tulisan tombol. */
            font-weight: bold; /* Membuat tulisan tombol menjadi tebal. */
            cursor: pointer; /* Mengubah kursor menjadi tangan saat diarahkan. */
            transition: 0.3s; /* Memberikan animasi perubahan selama 0,3 detik. */
        }

        /* Memberikan efek ketika tombol Mulai Sekarang diarahkan kursor. */
        .start-btn:hover {
            background: #4f46e5; /* Mengubah warna latar tombol. */
            transform: translateY(-3px); /* Menggeser tombol sedikit ke atas. */
        }

        /* ================= CARD ================= */

        /* Mengatur tampilan kartu preview dashboard. */
        .dashboard-card {
            width: 400px; /* Menentukan lebar kartu. */
            padding: 30px; /* Memberikan jarak dalam kartu. */
            border-radius: 20px; /* Membuat sudut kartu melengkung. */
            background: white; /* Memberikan warna latar putih. */
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1); /* Memberikan bayangan kartu. */
        }

        /* Mengatur bagian judul dashboard dan status online. */
        .card-title {
            display: flex; /* Menyusun judul dan status menggunakan Flexbox. */
            justify-content: space-between; /* Memisahkan judul dan status ke sisi berlawanan. */
            margin-bottom: 30px; /* Memberikan jarak bawah bagian judul. */
            font-weight: bold; /* Membuat tulisan menjadi tebal. */
            font-size: 18px; /* Mengatur ukuran tulisan. */
        }

        /* Mengatur warna tulisan status Online. */
        .status {
            color: #22c55e; /* Memberikan warna hijau pada status. */
        }

        /* Mengatur susunan tiga kotak statistik. */
        .stats {
            display: flex; /* Menyusun kotak statistik secara horizontal. */
            justify-content: space-between; /* Memberikan jarak antar kotak statistik. */
            gap: 15px; /* Menentukan jarak antar kotak statistik. */
        }

        /* Mengatur tampilan setiap kotak statistik. */
        .stat {
            flex: 1; /* Membuat setiap kotak memiliki ruang yang seimbang. */
            padding: 20px 10px; /* Memberikan jarak dalam kotak. */
            text-align: center; /* Membuat teks berada di tengah. */
            background: #f8fafc; /* Mengatur warna latar kotak. */
            border-radius: 12px; /* Membuat sudut kotak melengkung. */
        }

        /* Mengatur angka statistik seperti 24, 12, dan 8. */
        .stat h2 {
            font-size: 28px; /* Mengatur ukuran angka. */
            margin-bottom: 8px; /* Memberikan jarak bawah angka. */
        }

        /* Mengatur tulisan keterangan statistik seperti Posts, Active, dan Tasks. */
        .stat p {
            font-size: 13px; /* Mengatur ukuran tulisan keterangan. */
            color: #64748b; /* Mengatur warna tulisan keterangan. */
        }

        /* ================= FOOTER ================= */

        /* Mengatur tampilan bagian bawah halaman website. */
        footer {
            text-align: center; /* Membuat teks footer berada di tengah. */
            padding: 20px; /* Memberikan jarak dalam footer. */
            color: #64748b; /* Mengatur warna tulisan footer. */
            background: white; /* Memberikan warna latar putih. */
        }

        /* ================= RESPONSIVE ================= */

        /* Aturan CSS ini aktif ketika lebar layar maksimal 800 piksel,
           misalnya pada tablet atau perangkat dengan layar lebih kecil. */
        @media (max-width: 800px) {

            /* Mengubah susunan konten hero menjadi vertikal. */
            .hero {
                flex-direction: column; /* Menempatkan teks dan kartu secara bertumpuk. */
                text-align: center; /* Membuat teks berada di tengah. */
            }

            /* Mengecilkan ukuran judul agar sesuai dengan layar kecil. */
            .hero-text h1 {
                font-size: 40px;
            }

            /* Membuat kartu dashboard menyesuaikan lebar layar,
               tetapi tidak melebihi 400 piksel. */
            .dashboard-card {
                width: 100%;
                max-width: 400px;
            }
        }
    </style>
</head>

<body>

    <!-- ================= NAVBAR ================= -->

    <!-- Bagian navigasi yang berisi logo aplikasi dan tombol Login. -->
    <nav>

        <!-- Menampilkan nama atau logo aplikasi. -->
        <div class="logo">
            MyApp
        </div>

        <!-- Tombol Login dengan ID untuk dihubungkan ke JavaScript. -->
        <button id="loginButton" class="login-btn">
            Login
        </button>
    </nav>


    <!-- ================= HERO ================= -->

    <!-- Bagian utama halaman yang berisi sambutan dan preview dashboard. -->
    <section class="hero">

        <!-- Bagian kiri yang berisi teks informasi aplikasi. -->
        <div class="hero-text">

            <!-- Label sambutan untuk pengunjung website. -->
            <span class="badge">
                WELCOME TO MY APP
            </span>

            <!-- Judul utama halaman.
                 Bagian span digunakan untuk memberikan warna berbeda pada teks. -->
            <h1>
                Kelola pekerjaan
                <span>lebih mudah.</span>
            </h1>

            <!-- Penjelasan singkat mengenai fungsi aplikasi. -->
            <p>
                Kelola postingan dan aktivitas kamu dengan
                mudah menggunakan aplikasi Laravel ini.
                Login untuk mulai menggunakan semua fitur.
            </p>

            <!-- Tombol untuk mengarahkan pengguna ke halaman Login. -->
            <button id="startButton" class="start-btn">
                Mulai Sekarang →
            </button>

        </div>


        <!-- ================= DASHBOARD PREVIEW ================= -->

        <!-- Bagian kartu yang menampilkan contoh statistik dashboard. -->
        <div class="dashboard-card">

            <!-- Judul kartu dan informasi status aplikasi. -->
            <div class="card-title">

                <!-- Nama bagian kartu. -->
                <span>Dashboard</span>

                <!-- Menampilkan status aplikasi dengan warna hijau. -->
                <span class="status">● Online</span>
            </div>

            <!-- Wadah yang menampung seluruh kotak statistik. -->
            <div class="stats">

                <!-- Kotak statistik pertama untuk jumlah postingan. -->
                <div class="stat">
                    <h2>24</h2>
                    <p>Posts</p>
                </div>

                <!-- Kotak statistik kedua untuk jumlah aktivitas aktif. -->
                <div class="stat">
                    <h2>12</h2>
                    <p>Active</p>
                </div>

                <!-- Kotak statistik ketiga untuk jumlah tugas. -->
                <div class="stat">
                    <h2>8</h2>
                    <p>Tasks</p>
                </div>

            </div>

        </div>

    </section>


    <!-- ================= FOOTER ================= -->

    <!-- Bagian footer yang menampilkan informasi hak cipta aplikasi. -->
    <footer>
        <p>
            © 2026 MyApp. All rights reserved.
        </p>
    </footer>


    <!-- ================= JAVASCRIPT ================= -->

    <!-- JavaScript digunakan untuk memberikan fungsi pada tombol. -->
    <script>

        // Mengambil elemen tombol Login berdasarkan ID loginButton.
        const loginButton = document.getElementById('loginButton');

        // Menambahkan event listener untuk mendeteksi klik pada tombol Login.
        loginButton.addEventListener('click', function () {

            // Mengarahkan browser ke halaman Login ketika tombol diklik.
            window.location.href = '/login';
        });


        // Mengambil elemen tombol Mulai Sekarang berdasarkan ID startButton.
        const startButton = document.getElementById('startButton');

        // Menambahkan event listener untuk mendeteksi klik pada tombol Mulai Sekarang.
        startButton.addEventListener('click', function () {

            // Mengarahkan browser ke halaman Login ketika tombol diklik.
            window.location.href = '/login';
        });

    </script>

</body>
</html>
