# 📋 Product Requirements Document (PRD)

## Pencatatan Keuangan / Money Tracker App

| Field            | Detail                          |
| ---------------- | ------------------------------- |
| **Dokumen**      | PRD – Money Tracker App         |
| **Versi**        | 1.0                             |
| **Tanggal**      | 19 Juli 2026                    |
| **Status**       | Draft                           |

---

## 1. Problem Statement

Proses pencatatan keuangan pribadi saat ini masih sangat **manual**, **tidak konsisten**, dan **tersebar** di berbagai media non-spesifik (seperti aplikasi Notes). Ketidakpraktisan ini menyebabkan data transaksi tidak tercatat secara akurat, sehingga pengguna kehilangan visibilitas terhadap pola pengeluaran mereka dan kesulitan mengevaluasi kondisi keuangan secara objektif.

---

## 2. Goals

| #  | Goal                                                                                                              |
| -- | ----------------------------------------------------------------------------------------------------------------- |
| G1 | Pengguna bisa **menginput, mengedit, dan menghapus** data transaksi keuangan, baik pemasukan maupun pengeluaran.  |
| G2 | Pengguna bisa **mengevaluasi kondisi keuangan** mereka dari data transaksi yang sudah diinput melalui **visualisasi data**. |
| G3 | Pengguna bisa **mengatur periode waktu** untuk evaluasi kondisi keuangan mereka (harian, mingguan, bulanan).      |

---

## 3. Target User

| Persona                | Deskripsi                                                                  |
| ---------------------- | -------------------------------------------------------------------------- |
| **End User**           | Pengguna akhir yang menggunakan hasil akhir aplikasi untuk pencatatan keuangan pribadi. |
| **Admin / Stakeholder**| Pemilik produk yang membutuhkan data agregat anonim untuk insight fitur.    |
| **Developer**          | AI model dan tim developer yang membangun & memelihara aplikasi.           |

---

## 4. User Stories

| ID   | User Story                                                                                                                                                   |
| ---- | ------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| US-1 | Sebagai **end user**, saya ingin mencatat pemasukan dan pengeluaran saya dengan **mudah, cepat, dan tidak rumit**.                                            |
| US-2 | Sebagai **end user**, saya ingin bisa melihat langsung **selisih antara pemasukan dan pengeluaran** saya, agar bisa mengevaluasi kondisi keuangan secara objektif. |
| US-3 | Sebagai **end user**, saya ingin bisa melihat **visualisasi data** berdasarkan periode waktu (harian, mingguan, bulanan).                                    |

---

## 5. Functional Requirements

| ID   | Requirement                                                                                                                    | Prioritas |
| ---- | ------------------------------------------------------------------------------------------------------------------------------ | --------- |
| FR-1 | **CRUD data transaksi** — Pengguna dapat membuat, membaca, mengubah, dan menghapus data transaksi (pemasukan & pengeluaran).   | P0        |
| FR-2 | **Rekap bulanan** — Menampilkan rekap total jumlah pemasukan, pengeluaran, dan selisih secara realtime yang dipisahkan per bulan. | P0        |
| FR-3 | **Rincian harian** — Menampilkan data rincian transaksi per tanggal, termasuk total pemasukan, pengeluaran, dan selisih per tanggal. | P0        |
| FR-4 | **Dashboard visualisasi** — Dashboard menampilkan visualisasi data berdasarkan periode waktu (harian, mingguan, bulanan).       | P1        |
| FR-5 | **Pie chart pemasukan** — Diagram lingkaran untuk memvisualisasikan persentase pemasukan berdasarkan kategori per bulan.        | P1        |
| FR-6 | **Pie chart pengeluaran** — Diagram lingkaran untuk memvisualisasikan persentase pengeluaran berdasarkan kategori per bulan.    | P1        |
| FR-7 | **Login dengan Google OAuth** — Fitur autentikasi menggunakan Google OAuth untuk login.                                         | P0        |

---

## 6. Non-Functional Requirements

| ID    | Kategori        | Requirement                                                                                                  |
| ----- | --------------- | ------------------------------------------------------------------------------------------------------------ |
| NFR-1 | **Performa**    | Aplikasi ringan dan cepat digunakan. Load time **< 3 detik**, write time **< 5 detik**.                      |
| NFR-2 | **Security**    | Data transaksi terjaga keamanannya. Wajib menggunakan **Auth0 atau Google Auth** untuk autentikasi login.     |
| NFR-3 | **Reliability** | Aplikasi dapat diandalkan dan jarang error. Tersedia **log error** yang disimpan di file `error.txt`.         |

---

## 7. Scope

### ✅ Feature In Scope

| #  | Fitur                                                                                              |
| -- | -------------------------------------------------------------------------------------------------- |
| 1  | Fitur login dengan **Google OAuth**                                                                |
| 2  | **CRUD** data transaksi (pemasukan dan pengeluaran)                                                |
| 3  | Rekap total jumlah pemasukan, pengeluaran, dan selisih secara **realtime** per bulan               |
| 4  | Rincian transaksi **per tanggal** termasuk total pemasukan, pengeluaran, dan selisih per tanggal   |
| 5  | **Dashboard** visualisasi data berdasarkan periode waktu (harian, mingguan, bulanan)               |
| 6  | **Pie chart** persentase pemasukan berdasarkan kategori per bulan                                  |
| 7  | **Pie chart** persentase pengeluaran berdasarkan kategori per bulan                                |

### ❌ Feature Out of Scope

| #  | Fitur                             | Alasan                                          |
| -- | --------------------------------- | ----------------------------------------------- |
| 1  | Mode offline                      | Di luar cakupan MVP, pertimbangkan di versi 2+  |
| 2  | Fitur hutang / piutang            | Di luar cakupan MVP, pertimbangkan di versi 2+  |
| 3  | Fitur budgeting                   | Di luar cakupan MVP, pertimbangkan di versi 2+  |
| 4  | Fitur saldo bank / e-wallet       | Di luar cakupan MVP, pertimbangkan di versi 2+  |
| 5  | Fitur push notification           | Di luar cakupan MVP, pertimbangkan di versi 2+  |

---

## 8. Success Metrics

| Metrik                             | Target                                                    |
| ---------------------------------- | --------------------------------------------------------- |
| Load time halaman utama            | < 3 detik                                                 |
| Write time (simpan transaksi)      | < 5 detik                                                 |
| Uptime aplikasi                    | ≥ 99%                                                     |
| Error rate                         | < 1% dari total request                                   |
| User adoption (hari pertama)       | Pengguna dapat menyelesaikan CRUD tanpa panduan tambahan   |

---

> [!NOTE]
> Dokumen ini bersifat *living document* dan akan diperbarui seiring perkembangan produk.
