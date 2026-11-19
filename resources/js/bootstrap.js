
 // Mengimpor library Axios untuk melakukan komunikasi HTTP dengan server.
import axios from 'axios';

// Menyimpan Axios ke dalam objek window agar dapat diakses secara global
// dari berbagai bagian aplikasi JavaScript.
window.axios = axios;

// Mengatur header default untuk setiap permintaan HTTP yang dikirim menggunakan Axios.
// X-Requested-With: XMLHttpRequest digunakan untuk menandai bahwa permintaan
// berasal dari AJAX (Asynchronous JavaScript and XML).
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

