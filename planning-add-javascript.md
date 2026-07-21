# Planning: Add Javascript Interactivity

Dokumen ini berisi panduan dan *planning* untuk implementasi interaktivitas JavaScript (berbasis Alpine.js) pada sisi UI Money Tracker App. Tugas ini difokuskan pada perbaikan dan penambahan interaksi *frontend* tanpa mengubah logika *backend*.

---

## 📋 Task Details

### 1. View: `/resources/views/transactions/index.blade.php`
- **Month/Year Toggle (Previous & Next)**:
  - Saat tombol *PREVIOUS* dan *NEXT* diklik, ubah nilai bulan dan tahun (Format `MM/YYYY`).
  - Simpan data yang diubah dalam state Alpine.js `SelectedMonthAndYear`.
  - Nilai *default* harus mengambil bulan berjalan saat ini (sekarang).
- **Calendar Icon (Monthpicker)**:
  - Saat ikon kalender diklik, munculkan *modal* Monthpicker (pilih bulan dan tahun).
  - Diperbolehkan menggunakan komponen dari [Pines UI](https://devdojo.com/pines/docs/how-to-use) untuk Monthpicker.
  - Saat user memilih bulan dan tahun, *state* `SelectedMonthAndYear` harus diperbarui sesuai pilihan tersebut.

### 2. View: `/resources/views/transactions/create.blade.php`
- **Tabs Pengeluaran & Pemasukan**:
  - Saat salah satu *tab* diklik, ubah warna *background* dan warna font menyesuaikan desain yang sudah ada.
  - Simpan status tab saat ini dalam state Alpine.js `SelectedTransactionType`.
  - **Opsional**: Diperbolehkan menggunakan komponen Tab dari [Pines UI](https://devdojo.com/pines/docs/how-to-use).
- **Kategori Transaksi**:
  - Saat ikon kategori (Makanan & Minuman, Transportasi, dll.) diklik, ubah warna *background* dan teks.
  - Simpan kategori yang dipilih dalam state Alpine.js `SelectedCategory`.
- **Input Jumlah Uang**:
  - Implementasikan formater RegEx agar input otomatis memiliki pemisah ribuan/jutaan dengan titik (contoh: `1.000`, `100.000`, `1.000.000`).
  - Simpan nilai asli (angka murni) ke dalam state Alpine.js `transactionsAmount`.
  - Tampilkan pesan *error* (teks merah) di bawah input jika jumlah kosong atau bernilai minus.
- **Datepicker (Tanggal)**:
  - Secara *default*, tanggal menggunakan `Date.now()`.
  - Saat input tanggal diklik, munculkan *modal* Datepicker.
- **Submit Button (Simpan Transaksi)**:
  - Saat tombol diklik, *disable* tombol tersebut dan ubah teks menjadi "Loading..." selama 5 detik.
  - Setelah 5 detik, tampilkan SweetAlert2 *success alert* dan kembalikan (redirect) *user* ke *route* `/history`.

### 3. View: `/resources/views/transactions/edit.blade.php`
- **Tabs Pengeluaran & Pemasukan**:
  - Fungsinya sama seperti halaman `create`. Simpan pilihan di state `SelectedTransactionType` Alpine.js.
  - Diperbolehkan menggunakan komponen Tab dari [Pines UI].
- **Kategori Transaksi**:
  - Sama seperti `create`. Simpan state dalam `SelectedCategory`.
- **Input Jumlah Uang**:
  - Sama seperti `create`. Gunakan formater pemisah angka ribuan dan simpan di `transactionsAmount`. Tampilkan *error* jika kosong/minus.
- **Datepicker (Tanggal)**:
  - Munculkan Datepicker ketika diklik.
- **Submit Button (Edit Transaksi)**:
  - Saat diklik, *disable* tombol dan ubah teks menjadi "Loading..." selama 5 detik.
  - Setelah itu, munculkan SweetAlert2 *success alert* dan redirect ke `/history`.
- **Delete Button (Hapus Transaksi)**:
  - Saat tombol hapus diklik, munculkan *modal confirmation* menggunakan [SweetAlert2](https://sweetalert2.github.io/).
  - Jika "Yes", munculkan SweetAlert2 *success alert* dan redirect ke `/history`.

### 4. View: `/resources/views/home/index.blade.php`
- **Month/Year Toggle & Monthpicker**:
  - Fungsinya sama persis dengan halaman `transactions/index.blade.php`.
  - Ubah bulan/tahun ketika *PREVIOUS*/*NEXT* diklik.
  - Munculkan Monthpicker dari Pines UI ketika ikon kalender diklik.
  - Simpan data dalam state Alpine.js `SelectedMonthAndYear`.

---

## ✅ DO (Wajib Dilakukan)
- Fokus HANYA pada perbaikan sisi UI dan state *frontend*.
- **JANGAN** memodifikasi atau menambahkan logika Controller, Model, DTOs, Action, atau Service (*backend logic* dibiarkan statis/ter-mock sementara ini jika perlu).
- UI **harus** mengikuti layout desain yang sudah ada (mengacu pada HTML Blade template saat ini).
- Semua fungsi dan logika JavaScript **harus disimpan di dalam file `resources/js/app.js`**. Di dalam file `.blade.php` hanya boleh mendeklarasikan *state* (`x-data`) dan memanggil fungsi (*function calling*).

## ❌ DON'TS (Dilarang Keras)
- 🚫 Dilarang menggunakan `fetch` atau `axios` (tidak ada *API calls* yang sebenarnya).
- 🚫 Dilarang memuat *library* melalui CDN (harus di-*install* lewat `npm` jika diperlukan, misal SweetAlert2, atau diintegrasikan melalui bundle).
- 🚫 Dilarang memakai **jQuery** atau **jQuery UI** (baik JS maupun CSS).
- 🚫 Dilarang memakai komponen Bootstrap JS atau file script Tailwind JS (hanya Tailwind CSS statis yang digunakan untuk *styling*).
- 🚫 Dilarang menambahkan fitur di luar dari *planning* dokumen ini.
