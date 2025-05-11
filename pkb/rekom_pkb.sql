-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 12 Apr 2025 pada 12.58
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
-- Database: `rekom_pkb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mutasi_keluar`
--

CREATE TABLE `mutasi_keluar` (
  `id` int NOT NULL,
  `nomor_kendaraan` varchar(50) NOT NULL,
  `nomor_uji` varchar(50) NOT NULL,
  `nama_pemilik` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `nomor_surat` varchar(50) NOT NULL,
  `link_file_gdrive` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mutasi_masuk`
--

CREATE TABLE `mutasi_masuk` (
  `id` int NOT NULL,
  `nomor_kendaraan` varchar(255) DEFAULT NULL,
  `nomor_uji` varchar(255) DEFAULT NULL,
  `nama_pemilik` varchar(255) DEFAULT NULL,
  `tujuan` varchar(255) DEFAULT NULL,
  `nomor_surat` varchar(255) DEFAULT NULL,
  `link_file_gdrive` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `mutasi_masuk`
--

INSERT INTO `mutasi_masuk` (`id`, `nomor_kendaraan`, `nomor_uji`, `nama_pemilik`, `tujuan`, `nomor_surat`, `link_file_gdrive`, `created_at`) VALUES
(1, 'W 1234 A', 'SB 12345 G', 'DENNY ES TEH', 'JOGJA', '1552.23/1709/437.55.04/NPU/2024', 'https://drive.google.com/file/d/1cvWZ2gfXFxPXiVcCXS-VixqppRje2a_f/view?usp=drive_link', '2024-12-05 09:22:15'),
(2, 'W 4321 B', 'SB 54321 G', 'KEPIN', 'MOJOKERTO', '1552.23/1267/437.55.04/NPU/2024', 'https://drive.google.com/file/d/10KUdQeAa3XzBDPT59uzjJDriQkMQwsoY/view?usp=drive_link', '2024-12-05 09:22:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `numpanguji_keluar`
--

CREATE TABLE `numpanguji_keluar` (
  `id` int NOT NULL,
  `nomor_kendaraan` varchar(50) NOT NULL,
  `nomor_uji` varchar(50) NOT NULL,
  `nama_pemilik` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `nomor_surat` varchar(50) NOT NULL,
  `link_file_gdrive` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `numpanguji_masuk`
--

CREATE TABLE `numpanguji_masuk` (
  `id` int NOT NULL,
  `nomor_kendaraan` varchar(50) NOT NULL,
  `nomor_uji` varchar(50) NOT NULL,
  `nama_pemilik` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `nomor_surat` varchar(50) NOT NULL,
  `link_file_gdrive` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `twitter` varchar(255) DEFAULT '',
  `facebook` varchar(255) DEFAULT '',
  `instagram` varchar(255) DEFAULT '',
  `linkedin` varchar(255) DEFAULT '',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama`, `jabatan`, `deskripsi`, `foto`, `twitter`, `facebook`, `instagram`, `linkedin`, `username`, `password`) VALUES
(1, 'ISBIKA PRIHANDONO', 'Pensiun', '-', 'Cuplikan layar 2024-12-05 173619.png', '', '', '', '', 'PRIHANDONO', '$2y$10$Yfu.J0yfwaXgLV4ifkxr/u7gmqc3AwQvm9Xw5VeoALVA9tB/LlLoy'),
(2, 'DWI FERI ARDIANSAH', 'Kepala UPT', '-', 'IMG_9340 (1).jpg', '', '', '', '', 'ARDIANSAH', '$2y$10$vn3jQb6ocOPH.edzf3vwNO2AMbKeHyctk7.wWt2iIl8iOqInVoslC'),
(3, 'PATRIOT TEGUH SANTOSO', 'Penguji', '-', 'IMG-20220124-WA0040.jpg', '', '', '', '', 'SANTOSO', '$2y$10$E8pqP869/ZNoMfDJwZkRXegae23dwYxe93eqhKPHICmXu3WDJF5WW'),
(4, 'YULIANTO', 'PENGADMINISTRASI', '-', 'IMG_9336.JPG', '', '', '', '', 'YULIANTO', '$2y$10$ku5NXrQGsPOopFPAjqwW/uBwCANSXnyOPg99AcxhVS7mxg2t472pe'),
(5, 'R.SUGENG RIYADI', 'KEARSIPAN', '-', 'IMG_9176.JPG', '', '', '', '', 'RIYADI', '$2y$10$oCqD7UiL69ZEB7fSs.ZANeHaMZKuIbIKq1JNLCVsb/7Og.K2zZ9vq'),
(6, 'DENI ESTU PRASETYO', 'Penguji', '-', 'IMG_9448.JPG', '', '', '', '', 'PRASETYO', '$2y$10$YirP/yYbhJY7ZLjOc3MF.OcXt3l165vfLaHpRD/VH7Qt/YLJY1Gfi'),
(7, 'PRIYO ADI NUGROHO', 'Penguji', '-', '199006232024211006.jpg', '', '', '', '', 'NUGROHO', '$2y$10$6AXFY7FmGPTWlrSuKfQ0r.RnylsXIcYaqju2jrfGHIt5AlrDnb9ka'),
(8, 'KEVIN PRAYOGA', 'Penguji', '-', 'IMG_9280.JPG', '', '', '', '', 'PRAYOGA', '$2y$10$6DH1222oCp.BTNPEv54OteGQGQRvt1NIG4ZVVD4XfwvN3.3tjYl2C'),
(9, 'ACHMAD FARIS ZUBAIDI', 'Penguji', '-', 'IMG_9094.JPG', '', '', '', '', 'ZUBAIDI', '$2y$10$zj7J/b7NN.NfexpxTMDWt.4xfWYAxepBc7auAOx86qTKCAyvqNRHi'),
(10, 'Silfi Maulidatur Rohmah', 'REKOM NUMPANG UJI', '-', 'IMG_9324.JPG', '', '', '', '', 'Rohmah', '$2y$10$DK.6saH6LJCofj3z.Vm9KOXaTKjMo7WUAItiIAY8xhK44wtZtzbZW'),
(11, 'SURYA DENI ERDIANTO', 'PENGUJI', '-', 'IMG_9093.jpg', '', '', '', '', 'ERDIANTO', '$2y$10$rFGaNw/WscDjysuUdNqHie6Jn5cLts9NozvZU4CgAXzOjCaZiBYV2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rubah_bentuk`
--

CREATE TABLE `rubah_bentuk` (
  `id` int NOT NULL,
  `nomor_kendaraan` varchar(50) NOT NULL,
  `nomor_uji` varchar(50) NOT NULL,
  `nama_pemilik` varchar(100) NOT NULL,
  `rubah_bentuk_ke` varchar(100) NOT NULL,
  `nomor_surat` varchar(100) NOT NULL,
  `link_file_gdrive` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rubah_sifat`
--

CREATE TABLE `rubah_sifat` (
  `id` int NOT NULL,
  `nomor_kendaraan` varchar(20) NOT NULL,
  `nomor_uji` varchar(20) NOT NULL,
  `nama_pemilik` varchar(255) NOT NULL,
  `rubah_sifat` varchar(255) NOT NULL,
  `nomor_surat` varchar(50) NOT NULL,
  `link_file_gdrive` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tidak_aktif`
--

CREATE TABLE `tidak_aktif` (
  `id` int NOT NULL,
  `nomor_kendaraan` varchar(255) DEFAULT NULL,
  `nomor_uji` varchar(255) DEFAULT NULL,
  `nama_pemilik` varchar(255) DEFAULT NULL,
  `tanggal_mati_uji` date DEFAULT NULL,
  `nomor_surat` varchar(255) DEFAULT NULL,
  `link_file_gdrive` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `video_cctv`
--

CREATE TABLE `video_cctv` (
  `id` int NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `link_embed` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `video_cctv`
--

INSERT INTO `video_cctv` (`id`, `lokasi`, `link_embed`) VALUES
(1, 'Lokasi 1', 'https://www.youtube.com/embed/y_VvvKp1GNc'),
(2, 'Lokasi 2', 'https://www.youtube.com/embed/DNXIi5MJQO8'),
(3, 'Lokasi 3', 'https://www.youtube.com/embed/83WOspaMYpM');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mutasi_keluar`
--
ALTER TABLE `mutasi_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mutasi_masuk`
--
ALTER TABLE `mutasi_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `numpanguji_keluar`
--
ALTER TABLE `numpanguji_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `numpanguji_masuk`
--
ALTER TABLE `numpanguji_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rubah_bentuk`
--
ALTER TABLE `rubah_bentuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rubah_sifat`
--
ALTER TABLE `rubah_sifat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tidak_aktif`
--
ALTER TABLE `tidak_aktif`
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
-- AUTO_INCREMENT untuk tabel `mutasi_keluar`
--
ALTER TABLE `mutasi_keluar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mutasi_masuk`
--
ALTER TABLE `mutasi_masuk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `numpanguji_keluar`
--
ALTER TABLE `numpanguji_keluar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `numpanguji_masuk`
--
ALTER TABLE `numpanguji_masuk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `rubah_bentuk`
--
ALTER TABLE `rubah_bentuk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rubah_sifat`
--
ALTER TABLE `rubah_sifat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tidak_aktif`
--
ALTER TABLE `tidak_aktif`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `video_cctv`
--
ALTER TABLE `video_cctv`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
