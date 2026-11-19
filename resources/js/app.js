
 // Mengimpor file CSS utama aplikasi.
import '../css/app.css';

// Mengimpor konfigurasi Bootstrap atau JavaScript tambahan aplikasi.
import './bootstrap';

// Mengimpor file CSS Bootstrap agar komponen Bootstrap dapat digunakan.
import 'bootstrap/dist/css/bootstrap.min.css';

// Mengimpor JavaScript Bootstrap agar fitur interaktifnya dapat berjalan.
import 'bootstrap';

// Mengimpor fungsi untuk menginisialisasi aplikasi Inertia dengan Vue.
import { createInertiaApp } from '@inertiajs/vue3';

// Mengimpor fungsi untuk mencari dan memuat komponen halaman Vue secara dinamis.
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

// Mengimpor createApp untuk membuat aplikasi Vue dan h untuk membuat Virtual DOM.
import { createApp, h } from 'vue';

// Mengimpor ZiggyVue agar route Laravel dapat digunakan di dalam Vue.
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

// Mengambil nama aplikasi dari variabel lingkungan Vite.
// Jika tidak tersedia, nama aplikasi akan menggunakan 'Laravel'.
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// Menginisialisasi aplikasi Inertia menggunakan Vue.
createInertiaApp({

    // Mengatur judul halaman browser.
    // Contoh: Dashboard - Laravel.
    title: (title) => `${title} - ${appName}`,

    // Menentukan cara Inertia menemukan komponen halaman Vue.
    resolve: (name) =>
        resolvePageComponent(
            // Mencari file halaman berdasarkan nama komponen.
            // Contoh: ./Pages/Dashboard.vue.
            `./Pages/${name}.vue`,

            // Mencari seluruh file Vue di dalam folder Pages dan subfoldernya.
            import.meta.glob('./Pages/**/*.vue'),
        ),

    // Menyiapkan dan menjalankan aplikasi Vue.
    setup({ el, App, props, plugin }) {

        // Membuat instance aplikasi Vue.
        return createApp({
            // Menampilkan komponen utama Inertia beserta props yang diterima.
            render: () => h(App, props)
        })

            // Memasang plugin Inertia agar Vue dapat menggunakan fitur Inertia.
            .use(plugin)

            // Memasang ZiggyVue agar fungsi route() Laravel dapat digunakan di Vue.
            .use(ZiggyVue)

            // Menampilkan aplikasi Vue pada elemen HTML yang ditentukan oleh Inertia.
            .mount(el);
    },

    // Mengatur tampilan indikator progres ketika Inertia melakukan navigasi.
    progress: {
        // Menentukan warna indikator progres menjadi abu-abu.
        color: '#4B5563',
    },
});
