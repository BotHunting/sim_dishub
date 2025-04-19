-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 19 Apr 2025 pada 19.36
-- Versi server: 8.0.40
-- Versi PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dishub_sim`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `nip` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rules` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang`
--

CREATE TABLE `bidang` (
  `id` int NOT NULL,
  `nama_bidang` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposisi`
--

CREATE TABLE `disposisi` (
  `id` int NOT NULL,
  `tanggal` date DEFAULT NULL,
  `pengirim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penerima` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `file_google_drive` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int NOT NULL,
  `nama_jabatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `seksi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bidang` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `anjab` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlah_pegawai` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id` int NOT NULL,
  `nomor_kendaraan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kendaraan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `waktu_masuk` datetime NOT NULL,
  `lokasi_parkir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Masuk','Keluar') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Masuk'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kendaraan_keluar`
--

CREATE TABLE `kendaraan_keluar` (
  `id` int NOT NULL,
  `nomor_kendaraan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `trayek` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `waktu_keberangkatan` datetime NOT NULL,
  `jumlah_penumpang_keluar` int NOT NULL,
  `tujuan_terminal` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `retribusi` decimal(10,0) NOT NULL,
  `waktu_kedatangan` datetime DEFAULT NULL,
  `jumlah_penumpang_masuk` int DEFAULT NULL,
  `asal_terminal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kendaraan_masuk`
--

CREATE TABLE `kendaraan_masuk` (
  `id` int NOT NULL,
  `nomor_kendaraan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `trayek` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `waktu_kedatangan` datetime NOT NULL,
  `jumlah_penumpang_masuk` int NOT NULL,
  `asal_terminal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id` int NOT NULL,
  `nomor_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis_laporan` enum('Harian','Mingguan','Bulanan','Tahunan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` enum('Pending','Approved','Rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_google_drive` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_parkir`
--

CREATE TABLE `laporan_parkir` (
  `id` int NOT NULL,
  `id_kendaraan` int NOT NULL,
  `nomor_kendaraan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kendaraan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `waktu_masuk` datetime NOT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `biaya_parkir` decimal(10,0) DEFAULT NULL,
  `status` enum('Masuk','Keluar') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Masuk',
  `bulan_laporan` int NOT NULL,
  `tahun_laporan` int NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lokasi_parkir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `parkir`
--

CREATE TABLE `parkir` (
  `id` int NOT NULL,
  `lokasi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pangkat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `seksi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bidang` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger `pegawai`
--
DELIMITER $$
CREATE TRIGGER `update_jumlah_pegawai_delete` AFTER DELETE ON `pegawai` FOR EACH ROW BEGIN
    UPDATE jabatan SET jumlah_pegawai = jumlah_pegawai - 1 WHERE nama_jabatan = OLD.jabatan;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_jumlah_pegawai_insert` AFTER INSERT ON `pegawai` FOR EACH ROW BEGIN
    IF NOT EXISTS (SELECT * FROM jabatan WHERE nama_jabatan = NEW.jabatan) THEN
        INSERT INTO jabatan (nama_jabatan, jumlah_pegawai) VALUES (NEW.jabatan, 1);
    ELSE
        UPDATE jabatan SET jumlah_pegawai = jumlah_pegawai + 1 WHERE nama_jabatan = NEW.jabatan;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelayananumum`
--

CREATE TABLE `pelayananumum` (
  `id` int NOT NULL,
  `tanggal` datetime NOT NULL,
  `nama_layanan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `file_google_drive` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pemohon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Pending','Approved','Rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelayanan_kantor`
--

CREATE TABLE `pelayanan_kantor` (
  `id` int NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jadwal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengawasan`
--

CREATE TABLE `pengawasan` (
  `id` int NOT NULL,
  `nomor_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_pengawasan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Pending','Approved','Rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `file_google_drive` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengelolaan`
--

CREATE TABLE `pengelolaan` (
  `id` int NOT NULL,
  `nomor_inventaris` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `kondisi` enum('Baik','Rusak','Rusak Berat') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun` year NOT NULL,
  `foto` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jadwal_kerja` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas_parkir`
--

CREATE TABLE `petugas_parkir` (
  `id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jadwal_kerja` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id` int NOT NULL,
  `id_barang` int NOT NULL,
  `id_pegawai` int NOT NULL,
  `waktu_pinjam` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `waktu_kembali` datetime DEFAULT NULL,
  `status` enum('Belum Dikembalikan','Sudah Dikembalikan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Belum Dikembalikan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_absensi`
--

CREATE TABLE `riwayat_absensi` (
  `id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pangkat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bidang` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `waktu_pagi` time NOT NULL,
  `waktu_sore` time NOT NULL,
  `keterangan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_absensi` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `seksi`
--

CREATE TABLE `seksi` (
  `id` int NOT NULL,
  `nama_seksi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bidang` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suratmenyurat`
--

CREATE TABLE `suratmenyurat` (
  `id` int NOT NULL,
  `nomor_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `pengirim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penerima` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subjek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` enum('Draft','Sent') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_google_drive` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `terminal`
--

CREATE TABLE `terminal` (
  `id` int NOT NULL,
  `lokasi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni_home`
--

CREATE TABLE `testimoni_home` (
  `id` int NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni_pegawai`
--

CREATE TABLE `testimoni_pegawai` (
  `id` int NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni_pelayanan`
--

CREATE TABLE `testimoni_pelayanan` (
  `id` int NOT NULL,
  `sebutan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga` int NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pejabat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gambar` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni_sistem`
--

CREATE TABLE `testimoni_sistem` (
  `id` int NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `video_cctv`
--

CREATE TABLE `video_cctv` (
  `id` int NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `link_embed` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kendaraan_keluar`
--
ALTER TABLE `kendaraan_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kendaraan_masuk`
--
ALTER TABLE `kendaraan_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan_parkir`
--
ALTER TABLE `laporan_parkir`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `parkir`
--
ALTER TABLE `parkir`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip` (`nip`);

--
-- Indeks untuk tabel `pelayananumum`
--
ALTER TABLE `pelayananumum`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelayanan_kantor`
--
ALTER TABLE `pelayanan_kantor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengawasan`
--
ALTER TABLE `pengawasan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengelolaan`
--
ALTER TABLE `pengelolaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `petugas_parkir`
--
ALTER TABLE `petugas_parkir`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pinjaman_barang` (`id_barang`),
  ADD KEY `fk_pinjaman_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `riwayat_absensi`
--
ALTER TABLE `riwayat_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `seksi`
--
ALTER TABLE `seksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `suratmenyurat`
--
ALTER TABLE `suratmenyurat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `terminal`
--
ALTER TABLE `terminal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testimoni_home`
--
ALTER TABLE `testimoni_home`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testimoni_pegawai`
--
ALTER TABLE `testimoni_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testimoni_pelayanan`
--
ALTER TABLE `testimoni_pelayanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testimoni_sistem`
--
ALTER TABLE `testimoni_sistem`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `video_cctv`
--
ALTER TABLE `video_cctv`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kendaraan_keluar`
--
ALTER TABLE `kendaraan_keluar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kendaraan_masuk`
--
ALTER TABLE `kendaraan_masuk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `laporan_parkir`
--
ALTER TABLE `laporan_parkir`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `parkir`
--
ALTER TABLE `parkir`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pelayananumum`
--
ALTER TABLE `pelayananumum`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pelayanan_kantor`
--
ALTER TABLE `pelayanan_kantor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengawasan`
--
ALTER TABLE `pengawasan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengelolaan`
--
ALTER TABLE `pengelolaan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `petugas_parkir`
--
ALTER TABLE `petugas_parkir`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `riwayat_absensi`
--
ALTER TABLE `riwayat_absensi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `seksi`
--
ALTER TABLE `seksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `suratmenyurat`
--
ALTER TABLE `suratmenyurat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `terminal`
--
ALTER TABLE `terminal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `testimoni_home`
--
ALTER TABLE `testimoni_home`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `testimoni_pegawai`
--
ALTER TABLE `testimoni_pegawai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `testimoni_pelayanan`
--
ALTER TABLE `testimoni_pelayanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `testimoni_sistem`
--
ALTER TABLE `testimoni_sistem`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `video_cctv`
--
ALTER TABLE `video_cctv`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD CONSTRAINT `fk_pinjaman_barang` FOREIGN KEY (`id_barang`) REFERENCES `pengelolaan` (`id`),
  ADD CONSTRAINT `fk_pinjaman_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
