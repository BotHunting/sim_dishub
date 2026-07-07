# Product Requirements Document: SIM Dishub

**Versi:** 1.0
**Tanggal:** 30 Mei 2024
**Penulis:** Nobyta Nobi

---

## 1. Pendahuluan

SIM Dishub adalah sistem informasi manajemen berbasis web yang dirancang untuk menjadi platform terpusat bagi Dinas Perhubungan (Dishub) Kabupaten Fakfak. Sistem ini bertujuan untuk mendigitalkan, mengintegrasikan, dan mengoptimalkan berbagai proses kerja, mulai dari administrasi internal, manajemen kepegawaian, hingga pelayanan publik di bidang transportasi dan perhubungan.

Tujuan utama dari sistem ini adalah untuk meningkatkan efisiensi, transparansi, dan akuntabilitas layanan Dishub kepada masyarakat serta mempermudah pengelolaan data dan pelaporan internal.

## 2. Sasaran dan Tujuan

- **Meningkatkan Efisiensi Operasional:** Mengotomatiskan proses manual seperti surat-menyurat, disposisi, pengelolaan inventaris, dan pelaporan.
- **Meningkatkan Pelayanan Publik:** Menyediakan portal online bagi masyarakat untuk mengakses informasi dan mengajukan layanan (misalnya, izin trayek, peminjaman aset).
- **Sentralisasi Data:** Mengintegrasikan data dari berbagai unit kerja (Umum, Terminal, Parkir, Lalin, PKB) ke dalam satu database terpusat.
- **Meningkatkan Transparansi:** Menampilkan data operasional seperti statistik pegawai, data real-time terminal dan parkir, serta informasi layanan secara publik.
- **Mempermudah Pengawasan dan Pelaporan:** Menyediakan fitur untuk monitoring (CCTV) dan pembuatan laporan (harian, bulanan, dll.) untuk pimpinan.

## 3. Pengguna Sistem (User Personas)

1.  **Publik / Masyarakat Umum:**
    - **Kebutuhan:** Mengakses informasi umum, melihat direktori pegawai, mengetahui jenis layanan, mengajukan permohonan layanan secara online, dan memberikan masukan.
    - **Akses:** Halaman publik (index, about, services, contact, dll).

2.  **Staf / Operator (Rules: `Staff`):**
    - **Kebutuhan:** Mengelola data operasional sesuai bidangnya (misalnya, data masuk/keluar kendaraan di terminal, data parkir, data inventaris), mengelola testimoni, dan tugas administratif lainnya.
    - **Akses:** Memerlukan login, memiliki akses terbatas ke modul-modul tertentu sesuai dengan tugasnya.

3.  **Pimpinan (Rules: `Kepala`):**
    - **Kebutuhan:** Memantau seluruh data operasional, menyetujui/menolak disposisi dan laporan, mengelola akun pengguna (admin), dan mengakses dashboard analitik.
    - **Akses:** Memerlukan login, memiliki hak akses penuh ke semua modul, termasuk menu "Setting" dan "Troubleshoot".

## 4. Fitur dan Fungsionalitas

Sistem ini terbagi menjadi beberapa modul utama:

#### 4.1. Portal Publik & Manajemen Konten
- **Beranda (Home):** Menampilkan visi-misi, statistik ringkas (jumlah pegawai, layanan, inventaris), daftar layanan populer, dan testimoni pimpinan.
- **Tentang Kami (About):** Halaman profil dinas, statistik detail, dan testimoni mengenai sistem.
- **Layanan (Services):** Menampilkan daftar layanan populer yang ditawarkan Dishub beserta detail biaya dan penanggung jawab.
- **Direktori Pegawai:** Menampilkan daftar pegawai Dishub.
- **Info Pelayanan Kantor:** Menampilkan jadwal dan jenis pelayanan operasional kantor.
- **Kontak:** Menampilkan alamat, peta lokasi, nomor telepon, dan email.
- **Manajemen Testimoni:** Admin dapat melakukan operasi CRUD (Create, Read, Update, Delete) untuk testimoni yang ditampilkan di halaman publik (Home, About, Pegawai).

#### 4.2. Manajemen Pengguna dan Akses
- **Registrasi:** Terdapat dua mekanisme:
    1. Formulir pendaftaran yang mengirimkan data ke admin melalui WhatsApp untuk pembuatan akun.
    2. Formulir registrasi internal dengan validasi dan pembuatan akun langsung (memerlukan konsolidasi).
- **Login:** Otentikasi pengguna menggunakan `username` dan `password`. Password disimpan menggunakan `password_hash()`.
- **Logout:** Mengakhiri sesi pengguna.
- **Manajemen Akun Admin (Khusus Pimpinan):** Pimpinan dapat menambah, mengubah, dan menghapus akun admin/staf lain.
- **Kontrol Akses Berbasis Peran:** Sistem membedakan hak akses antara peran `Kepala` dan `Staff`.

#### 4.3. Modul Administrasi Umum
- **Manajemen Kepegawaian:** Mengelola data pegawai, jabatan, pangkat, seksi, dan bidang.
- **Surat-Menyurat & Disposisi:**
    - Membuat surat keluar dengan status "Draft" atau "Sent".
    - Mengelola disposisi surat masuk, lengkap dengan status (Pending, Approved, Rejected).
    - Menggunakan link Google Drive untuk lampiran file.
- **Manajemen Inventaris & Peminjaman:**
    - CRUD untuk data inventaris barang (nama, jumlah, kondisi, foto).
    - Mencatat dan melacak peminjaman barang oleh pegawai, beserta status pengembalian.
- **Manajemen Absensi:** Menyimpan dan menampilkan riwayat absensi pegawai.

#### 4.4. Modul Layanan Transportasi
- **Manajemen Terminal:**
    - Mencatat data kendaraan masuk dan keluar terminal.
    - Menghitung retribusi dan jumlah penumpang.
    - Menyediakan data real-time untuk monitoring.
- **Manajemen Perparkiran:**
    - Mencatat data kendaraan masuk dan keluar area parkir.
    - Menghitung durasi dan biaya parkir.
    - Menghasilkan laporan pendapatan parkir bulanan yang dapat dicetak.
- **Manajemen Pengujian Kendaraan (PKB):**
    - Mengelola data Numpang Uji (Masuk & Keluar).
    - Mengelola data Mutasi Kendaraan (Masuk & Keluar).
    - Mengelola data Rubah Bentuk & Rubah Sifat.
    - Integrasi dengan link Google Drive untuk dokumen rekomendasi.

#### 4.5. Modul Monitoring & Pelaporan
- **Monitoring CCTV:** Menampilkan video dari link embed CCTV di berbagai lokasi.
- **Pengawasan Lalu Lintas:** Mengelola surat tugas pengawasan beserta status dan lampiran.
- **Pelaporan:** Mengelola laporan (Harian, Mingguan, dll.) dengan status dan lampiran dari Google Drive.

## 5. Persyaratan Non-Fungsional

- **Keamanan:**
    - Password pengguna harus di-hash menggunakan `password_hash()`.
    - Semua input dari pengguna harus divalidasi dan di-escape untuk mencegah serangan seperti SQL Injection. **(Catatan: Saat ini implementasi belum konsisten, banyak query masih rentan).**
    - Proses upload file harus aman, memvalidasi tipe dan ukuran file, serta menghasilkan nama file yang unik untuk mencegah konflik dan serangan.
    - Sesi pengguna harus dikelola dengan aman.
- **Kinerja:** Halaman web harus dimuat dengan cepat. Query database harus dioptimalkan untuk menangani volume data yang besar.
- **Skalabilitas:** Arsitektur harus memungkinkan penambahan fitur atau modul baru di masa depan.
- **Ketersediaan:** Sistem harus dapat diakses 24/7, dengan mekanisme fallback koneksi database (dari online ke offline) seperti yang diimplementasikan pada `config_combin.php`.

## 6. Spesifikasi Teknis

```
Backend: PHP Native (Versi 8.x direkomendasikan)
Frontend: HTML, CSS, JavaScript, Bootstrap
Database: MySQL / MariaDB
Web Server: Apache / Nginx
Dependensi Eksternal: Google Drive API (untuk penyimpanan file surat dan laporan)
```

## 7. Ruang Lingkup Masa Depan & Potensi Peningkatan

- **Refaktor Kode:** Migrasi dari PHP Native ke sebuah framework modern (seperti Laravel atau CodeIgniter) untuk meningkatkan struktur, keamanan, dan kemudahan pemeliharaan.
- **Keamanan:**
    - Mengganti mekanisme `key.php` yang tidak aman dengan implementasi 2FA (Two-Factor Authentication) yang standar (misalnya, TOTP).
    - Menerapkan Prepared Statements secara konsisten di seluruh aplikasi untuk mencegah SQL Injection.
    - Menstandarisasi dan mengamankan semua proses upload file.
- **Manajemen Pengguna:** Mengkonsolidasikan beberapa file registrasi (`register.php`, `regis.php`, `regis_hash.php`) menjadi satu alur yang jelas dan aman.
- **Manajemen File:** Saat menghapus data dari database (misalnya testimoni), file fisik terkait (gambar) juga harus dihapus dari server untuk menghemat ruang penyimpanan.
- **UX/UI:**
    - Mengimplementasikan notifikasi real-time untuk disposisi atau status laporan baru.
    - Menggunakan AJAX secara lebih luas untuk membuat interaksi pengguna lebih dinamis tanpa perlu me-refresh halaman (misalnya, saat menghapus data).
- **Database:** Memperbaiki inkonsistensi tipe data, seperti kolom `gambar` pada `testimoni_pelayanan` yang seharusnya `VARCHAR` bukan `BLOB` berdasarkan logika kode.

## 8. Struktur Database

Database `dishub_sim` merupakan inti dari sistem yang menampung seluruh data operasional. Berikut adalah rincian struktur tabel berdasarkan modul fungsionalnya:

#### 8.1. Manajemen Pengguna & Kepegawaian
- **`admin`**: Menyimpan data akun pengguna sistem (username, password hash, dan role/peran `Kepala` atau `Staff`).
- **`pegawai`**: Data master seluruh pegawai Dinas Perhubungan (NIP, nama, pangkat, jabatan, bidang, seksi).
- **`jabatan`**: Data master semua jabatan yang ada, termasuk jumlah pegawai per jabatan yang di-update melalui *trigger*.
- **`bidang`**: Data master bidang atau departemen di dalam dinas.
- **`seksi`**: Data master seksi yang berada di bawah sebuah bidang.
- **`riwayat_absensi`**: Log atau catatan absensi harian (pagi dan sore) untuk setiap pegawai.

#### 8.2. Administrasi & Pelaporan
- **`suratmenyurat`**: Arsip digital untuk surat keluar, lengkap dengan nomor surat, tujuan, dan link file Google Drive.
- **`disposisi`**: Arsip digital untuk disposisi surat masuk, termasuk status persetujuan (Pending, Approved, Rejected).
- **`laporan`**: Catatan laporan umum (Harian, Mingguan, dll.) yang memerlukan persetujuan pimpinan.
- **`pengawasan`**: Arsip surat tugas untuk kegiatan pengawasan di lapangan.
- **`pengelolaan`**: Data master inventaris atau aset kantor (nama barang, jumlah, kondisi, foto).
- **`pinjaman`**: Log transaksi peminjaman dan pengembalian aset oleh pegawai, terhubung ke tabel `pengelolaan` dan `pegawai`.

#### 8.3. Layanan Transportasi (Terminal & Parkir)
- **`terminal`**: Data master lokasi terminal yang dikelola.
- **`kendaraan_masuk`**: Log kendaraan angkutan umum yang masuk ke terminal.
- **`kendaraan_keluar`**: Log kendaraan angkutan umum yang keluar dari terminal, mencatat retribusi dan jumlah penumpang.
- **`petugas`**: Data petugas yang berjaga di terminal.
- **`parkir`**: Data master lokasi parkir resmi.
- **`kendaraan`**: Tabel sementara untuk mencatat kendaraan yang sedang parkir saat ini. Data akan dihapus setelah kendaraan keluar.
- **`laporan_parkir`**: Riwayat transaksi parkir yang sudah selesai, digunakan untuk pelaporan pendapatan.
- **`petugas_parkir`**: Data petugas yang berjaga di lokasi parkir.

#### 8.4. Layanan Pengujian Kendaraan (PKB)
*Catatan: Tabel-tabel ini tampaknya berasal dari skema database terpisah (`rekom_pkb.sql`) yang diintegrasikan.*
- **`mutasi_masuk` & `mutasi_keluar`**: Data untuk rekomendasi mutasi kendaraan.
- **`numpanguji_masuk` & `numpanguji_keluar`**: Data untuk rekomendasi numpang uji kendaraan.
- **`rubah_bentuk` & `rubah_sifat`**: Data untuk rekomendasi perubahan bentuk atau sifat kendaraan.
- **`pegawai_pkb`**: Data pegawai khusus untuk modul PKB (terindikasi duplikasi dari tabel `pegawai`).

#### 8.5. Manajemen Konten & Pelayanan Publik
- **`pelayananumum`**: Log permohonan layanan yang diajukan oleh masyarakat umum secara online.
- **`pelayanan_kantor`**: Konten statis untuk halaman info pelayanan di website.
- **`testimoni_home`, `testimoni_pegawai`, `testimoni_pelayanan`, `testimoni_sistem`**: Tabel-tabel yang berisi konten untuk ditampilkan di berbagai bagian halaman web publik.
- **`video_cctv`**: Daftar lokasi dan link embed untuk streaming CCTV.

#### 8.6. Catatan dan Inkonsistensi Database
- **Redundansi Data**: Terdapat tabel yang berpotensi duplikat seperti `pegawai` dan `pegawai_pkb`, serta `petugas` dan `petugas_parkir`. Idealnya, ini digabungkan menjadi satu tabel dengan kolom pembeda jika diperlukan.
- **Penyimpanan File**: Terdapat kolom `foto` (menyimpan nama file lokal) dan `file_google_drive` (menyimpan link) dalam beberapa tabel. Ini menunjukkan strategi penyimpanan file yang tidak konsisten.
- **Inkonsistensi Kolom**: Tabel `testimoni_pelayanan` memiliki kolom `foto` (VARCHAR) dan `gambar` (BLOB) yang tujuannya sama, ini perlu distandarisasi.
- **Relasi Implisit**: Sebagian besar relasi antar tabel (misalnya, `pegawai` ke `jabatan`) diimplementasikan melalui logika aplikasi, bukan melalui *foreign key constraint* di level database. Hanya tabel `pinjaman` yang memiliki *constraint* eksplisit.
- **Fragmentasi Skema**: Adanya file `dishub_sim.sql` dan `rekom_pkb.sql` mengindikasikan kemungkinan adanya dua database terpisah yang seharusnya menjadi satu kesatuan untuk integritas data yang lebih baik.