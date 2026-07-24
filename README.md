# Money Tracker App

Sebuah *project technical home test* yang dirancang untuk melacak keuangan pribadi dengan fitur mencatat pemasukan dan pengeluaran secara mudah, cepat, dan responsif.

## Tech Stack

- **Laravel 11** (PHP Framework)
- **MySQL** (Database)
- **Tailwind CSS** untuk *styling* (Termasuk dukungan penuh tema *Dark Mode* dan *Light Mode*)
- **Alpine.js** untuk reaktivitas *frontend* yang ringan tanpa perlu framework JavaScript berukuran besar

## Arsitektur Aplikasi

Aplikasi ini dibangun menggunakan pendekatan **Clean Architecture / Service-Oriented** di dalam direktori `/app` guna memisahkan tanggung jawab kode agar lebih mudah dirawat (maintainable):
- **Http/Controllers:** Menangani alur *request* dan *response* HTTP dari dan ke pengguna.
- **DTOs (Data Transfer Objects):** Membungkus data yang dioperasikan antar lapisan (layer) agar lebih terstruktur dan aman.
- **Actions / Services:** Tempat di mana *core business logic* diletakkan (misalnya: kalkulasi pemrosesan transaksi).
- **Repositories:** Mengelola akses langsung ke sumber data dan melakukan abstraksi terhadap kueri database (Eloquent).
- **View:** Menyimpan dan mengatur *logic* untuk komponen View pada Blade.

## Skema Database (Database Schema)

Aplikasi ini menggunakan beberapa tabel utama dalam operasinya:
- **`users`:** Tabel autentikasi bawaan Laravel untuk menyimpan kredensial pengguna.
- **`transaction_types`:** Mendefinisikan jenis transaksi (contoh: `pemasukan`, `pengeluaran`).
- **`categories`:** Terhubung ke `user_id` (bernilai *nullable* untuk default/bawaan sistem) dan `transaction_type_id`, berfungsi untuk menyimpan atribut `name` dan `icon` kategori.
- **`transactions`:** Tabel operasional utama yang mencatat entri keuangan dengan kolom `user_id`, `category_id`, `transaction_type_id`, `amount`, `date`, dan `note`. Telah dilengkapi dengan *indexing* yang dioptimalkan untuk memangkas waktu kueri pada saat menampilkan dashboard.

## Fitur Utama

- **Autentikasi:** Alur pendaftaran (Register) dan masuk (Login) akun pengguna.
- **Home/Dashboard:** Tampilan ringkasan/gambaran umum mengenai keuangan dan aktivitas/histori terbaru.
- **Transaksi (CRUD):** 
  - Mencatat pemasukan atau pengeluaran baru.
  - Memperbarui atau mengubah data transaksi.
  - Menghapus transaksi yang salah catat.
  - Pemilihan kategori sesuai tipe transaksi dan pengisian tanggal otomatis.
- **Laporan (Reports):** Berisikan grafik *donut* interaktif dan daftar ringkasan yang mengategorikan pengeluaran atau pemasukan berdasarkan periode (pilihan berdasarkan **Bulanan** atau **Rentang Tanggal** khusus).
- **Profile:** Mengelola pembaruan informasi pengguna (nama/email) dan pengaturan ganti kata sandi (password).

---

## Instalasi & Menjalankan Secara Lokal (Clone to Run)

Berikut adalah panduan lengkap dari *clone* proyek hingga berjalan di komputer/perangkat lokal Anda:

1. **Clone repositori ini:**
   ```bash
   git clone <URL_REPOSITORI_INI>
   cd money-tracker-app
   ```

2. **Instal dependensi PHP & Node.js:**
   ```bash
   composer install
   npm install
   ```

3. **Atur konfigurasi Environment (Lingkungan):**
   ```bash
   cp .env.example .env
   ```
   Buka file `.env` di editor Anda, kemudian pastikan pengaturan database mengarah ke **MySQL** lokal Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database_anda
   DB_USERNAME=root
   DB_PASSWORD=password_anda
   ```
   *(Pastikan Anda telah membuat database kosong di MySQL dengan nama yang sesuai di konfigurasi `DB_DATABASE` sebelum melanjutkan).*

4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

5. **Jalankan Migrasi & Seeder Database:**
   ```bash
   php artisan migrate --seed
   ```
   *Catatan: Proses seeder ini akan membuatkan Kategori default dan satu pengguna uji coba (Test User) yang bisa Anda gunakan langsung untuk masuk/login ke dalam aplikasi:*
   - **Email:** `admin@admin.com`
   - **Password:** `password`

6. **Jalankan *Development Server* Laravel dan Vite (Frontend):**
   Anda membutuhkan dua terminal yang berjalan bersamaan.
   
   Pada **Terminal 1** (untuk *Asset Compilation*):
   ```bash
   npm run dev
   ```
   
   Pada **Terminal 2** (untuk *Backend Server*):
   ```bash
   php artisan serve
   ```

7. **Akses Aplikasi:**
   Buka web browser dan kunjungi: **`http://localhost:8000`**

---
*Dibuat untuk kebutuhan Technical Home Test.*
