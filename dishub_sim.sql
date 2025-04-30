-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 30 Apr 2025 pada 12.15
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

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `nip`, `nama`, `username`, `password`, `rules`) VALUES
(1, '199507132017011001', 'ACHMAD FARIS ZUBAIDI, A. Ma PKB', '199507132017011001', '$2y$10$rHEy8b4TH6C0aZ.LHf7jlelANIH5c0hMEujL2WyPyRScvvEDxr2Rq', 'Staff'),
(2, '123456779098765432', 'admin', 'admin', '$2y$10$VfyUCGFhMLP6CPIzilX2Pu/jqfeA11rF1tWXsY5ys7NLcst52m49q', 'Kepala'),
(3, '987654321012345678', 'user', 'user', '$2y$10$QSCcOr3viW1y04aNWZHMz.qEdk/QGmyjDQeyqYQIeE3/rnzIumFOu', 'Staff'),
(4, '196709041996101002', 'T. HERU USWANAS, S.Sos. M.Si', '196709041996101002', '$2y$10$V5CgMvfeToaW/YCxwYS0Ee5VbnllSMH0BSOjLjRjDPRQ2/U2Meu4a', 'Kepala'),
(5, '198309062009092003', 'RISMAWATI AKATIAN, SE', '198309062009092003', '$2y$10$4.vANmCSZ/4s.cIidAkkl.vpAdzh7xKadSPHBwhuYYuo.IbRgtmAy', 'Kepala'),
(6, '197505312007012013', 'ENGGAR MASTUTI, SE. M.Si', '197505312007012013', '$2y$10$IsRYR3mdeyWRngjD/F6uT.Yy0fentP43biqFmHzWy4E02i31bDfeK', 'Kepala'),
(7, '197812012009091001', 'MUHAMAD RUMBAY, A.Md', '197812012009091001', '$2y$10$hqWoRduNEQ7K.pdSGCK2u.59LtOwjqpjRJE4xn3O4JHewyRs43WBi', 'Kepala'),
(8, '196705191998031005', 'SENEN SAGAS, SE', '196705191998031005', '$2y$10$lhS.VdPS2dUEF9ThqFhcCeUk1g1DTwDR2Wkq2O8T.Lp1tNk0/YRQ6', 'Kepala'),
(9, '196611201992091001', 'SAMSUDIN LA SITAMBAH,S.H.I.,M.Si', '196611201992091001', '$2y$10$Rp.mkEx1iEWvZpxZMj8k3e0B5T1dU5Q2EeiL4.XL.f72oX9M1lRl.', 'Kepala'),
(10, '196706011992032011', 'SITTI HASANNOESI', '196706011992032011', '$2y$10$Z7njo94OFzhVuuyUDlApk.XIY3ouKcUXtQRHAJAAh65fr0fAmMJgO', 'Kepala'),
(11, '196904211992032010', 'IRMAWATI', '196904211992032010', '$2y$10$Tg07d3bfjDjaO/Rhnb749.VxCJfARN6WnfPAGk2m3J2bmYwI69dC6', 'Kepala'),
(12, '197305092003121007', 'JAPARI BIARPRUGA, SE', '197305092003121007', '$2y$10$1LhBEBousZkmE4Sfh5gwp.L50KapYD1m.2x7DIpN2UufKsP5Y0U3S', 'Kepala'),
(13, '197405202007011029', 'SAIFFUDIN SOEMARDI, S.Sos', '197405202007011029', '$2y$10$kjRrCZgjQPz.dzjVq0Gh2.D9g4OL6RqYiyuWbp/AxakONF2G9hmFC', 'Kepala'),
(14, '197505212006052001', 'NANI MADI, S.Sos', '197505212006052001', '$2y$10$xPI5h9fOdhnqg5kBFcHDL.6thiMaQ496sS/jfAnSE72myVgi/k9fW', 'Kepala'),
(15, '197010122006051003', 'MUHAMMAD MAHDI SARIF', '197010122006051003', '$2y$10$zVBJONsWpi6Zehu/PK2d5e4Lj/X4Rq7ciskwakxP4fTZfQtrlcsMC', 'Staff'),
(16, '197702152007011015', 'AMINUDIN TANGGAHMA', '197702152007011015', '$2y$10$w67Cs2DmGWkxNvA21fe8HOZwTbPNWfuyJECzzLBaGGbRefqXW2RS.', 'Staff'),
(17, '197003062006051002', 'ABDUL MUTI RUMADAN', '197003062006051002', '$2y$10$WKdhkMpRBbE.Mrc2wy8DCu91wd/HRGrNB2JW4Kc8xkgw8CFf8C306', 'Staff'),
(18, '198405152007011006', 'FARIDS FIRMANSYAH SUPARMAN', '198405152007011006', '$2y$10$0Sq6wm6MJtZvV/9GHhVIoenWSHVPxLXXKuR4/X7D2w62wniHRInA6', 'Staff'),
(19, '197711292007011005', 'LA KARIM', '197711292007011005', '$2y$10$AKtkMRdw8.MQTPDjACzif.VdTt1xCwdwFRj8k.OTtIQuTa4rZVbxy', 'Staff');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang`
--

CREATE TABLE `bidang` (
  `id` int NOT NULL,
  `nama_bidang` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bidang`
--

INSERT INTO `bidang` (`id`, `nama_bidang`) VALUES
(1, 'Kepala Dinas'),
(2, 'Sekretariat'),
(3, 'Lalu Lintas dan Angkutan'),
(4, 'Prasarana'),
(5, 'Pengembangan dan Keselamatan'),
(8, 'UPTD Pengujian Kendaraan Bermotor');

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

--
-- Dumping data untuk tabel `disposisi`
--

INSERT INTO `disposisi` (`id`, `tanggal`, `pengirim`, `penerima`, `judul`, `isi`, `file_google_drive`, `status`) VALUES
(3, '2024-03-11', 'Kepala Dinas', 'Kepala Dinas', 'Tindak lanjut Pinjam truck', 'Cakep!', 'https://drive.google.com/file/d/16Yd_sGeG2e_Snkm-3dd-r5Qe-E2iht4a/view?usp=drive_link', 'Pending'),
(4, '2024-03-11', 'Kasubag Umum', 'Kepala Dinas', 'Pinjam dulu seratus', 'agar silaturrahmi tidak putus', NULL, 'Approved'),
(5, '2024-03-11', 'Sub Bagian Umum', 'Kepala Dinas', 'tindak lanjut pinjam bahu jalan', 'axaxa', 'Kasubag Umum_5_ACC.pdf', 'Rejected'),
(10, '2024-03-12', 'Kepala Dinas', 'Kabag Umum', 'Apel', 'segera', 'Kepala Dinas_10_ACC.pdf', 'Approved'),
(11, '2024-03-17', 'Kepala Dinas', 'Kepala Dinas', 'Tindak lanjut', 'laksanakan  sesuai aturan', 'https://drive.google.com/file/d/16UaJ1AwEveftybC7i7Pa6cnU4zZjjP_r/view?usp=drive_link', 'Approved'),
(12, '2024-03-25', 'Kepala Dinas', 'Kepala Dinas', 'Tindak lanjut  pindah trayek', 'ikuti aturan berlaku', 'https://drive.google.com/file/d/16c2GpK8Lwn4isxxMG9QdcF6Y-j8qevs2/view?usp=drive_link', 'Pending'),
(13, '2024-11-20', 'Kepala Dinas', 'Bidang Prasarana', 'Pinjam Pick Up', 'setujui pinjam', 'https://drive.google.com/file/d/16Unc3bAQkOeIGzBXAH2zY7KMJ1DVK3vc/view?usp=drive_link', 'Pending');

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

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`, `seksi`, `bidang`, `anjab`, `jumlah_pegawai`) VALUES
(1, 'Kepala Dinas', 'Kepala Dinas', 'Kepala Dinas', 'https://drive.google.com/file/d/1rOzCIwMwOL_N7L7fCOmbXiR7uFkStKYu/view?usp=drive_link', 1),
(2, 'Sekertaris', 'Sekertaris', 'Sekretariat', 'https://drive.google.com/file/d/1spbCK1nGvt7pvzTDDUDQl7WRTYN1iXI2/view?usp=drive_link', 1),
(3, 'Kepala Sub Bagian Umum', 'Sub Bagian Umum', 'Sekretariat', 'https://drive.google.com/file/d/1pxBI13GqAE2PRWRrjLyj9JvOtzMpcxwQ/view?usp=drive_link', 1),
(4, 'Pengadministrasi Umum', 'Sub Bagian Umum', 'Sekretariat', 'https://drive.google.com/file/d/1sUE5dvJdecANEDSqA6LmPlwRvEpq9dfE/view?usp=drive_link', 1),
(5, 'Analis Tata Usaha', 'Sub Bagian Umum', 'Sekretariat', 'https://drive.google.com/file/d/1tTraSAo-JzgUBnN_gU2XSxTR-sjtpr0d/view?usp=drive_link', 0),
(6, 'Pengelola Barang Milik Negara', 'Sub Bagian Umum', 'Sekretariat', 'https://drive.google.com/file/d/1rgo_2Dn4Ae5fIHASdLkRPmCyMoXzwRP_/view?usp=drive_link', 1),
(7, 'Pengelola Sarana Prasarana dan Rumah Tangga Dinas', 'Sub Bagian Umum', 'Sekretariat', 'https://drive.google.com/file/d/1rv7AkxjDVrDRgl3TiCKE_1ccLc-yjPdj/view?usp=drive_link', 1),
(8, 'Kepala Sub Bagian Perencanaan dan Pelaporan', 'Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat', 'https://drive.google.com/file/d/1qKoJ0eVA2h0Pkgn_oIziCJrZMbYLteRu/view?usp=drive_link', 1),
(10, 'Bendahara', 'Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat', 'https://drive.google.com/file/d/1qC56dMSHu4_YH2MWPP8TbTYalRbJpKVq/view?usp=drive_link', 1),
(11, 'Penata Laporan Keuangan', 'Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat', 'https://drive.google.com/file/d/1peZGv4I4ar8OUMF-XojFaVeMMD4X4smZ/view?usp=drive_link', 0),
(12, 'Pengelola Pelaksanaan Program dan Anggaran', 'Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat', '', 1),
(13, 'Kepala Seksi Lalu Lintas', 'Seksi Lalu Lintas', 'Lalu Lintas dan Angkutan', 'https://drive.google.com/file/d/1q-1drkBLa0SotPmic5_DjC5rFv9yjXvJ/view?usp=drive_link', 1),
(14, 'Pemeriksa Lalu Lintas Darat', 'Seksi Lalu Lintas', 'Lalu Lintas dan Angkutan', 'https://drive.google.com/file/d/1sJBoYFzDdL5C6Nd2r6qXBk2NDLJO6Q0J/view?usp=drive_link', 2),
(15, 'Kepala Bidang Lalu Lintas dan Angkutan', 'Bidang Lalu Lintas dan Angkutan', 'Lalu Lintas dan Angkutan', 'https://drive.google.com/file/d/1tSrZzuWiN-bedvKTQS9bNW4-3udEL__p/view?usp=drive_link', 1),
(16, 'Pengawas Lalu Lintas Darat', 'Seksi Lalu Lintas', 'Lalu Lintas dan Angkutan', 'https://drive.google.com/file/d/1siKW4_mTvVajMP5WcAgJ4Wr-2KDl-nZf/view?usp=drive_link', 1),
(17, 'Pengadministrasi LLAJ', 'Seksi Lalu Lintas', 'Lalu Lintas dan Angkutan', 'https://drive.google.com/file/d/1qYx31kCKfdvNqaBMY2t0GpchmPiMTE8x/view?usp=drive_link', 2),
(18, 'Kepala Seksi Angkutan', 'Seksi Angkutan', 'Lalu Lintas dan Angkutan', 'https://drive.google.com/file/d/1qDAEzXNf8Oslp6yrwmEndO8k7C1rluT7/view?usp=drive_link', 1),
(19, 'Analis Angkutan Darat', 'Seksi Angkutan', 'Lalu Lintas dan Angkutan', 'https://drive.google.com/file/d/1tXoogvJrQeoEKbiqBZPRPxTdYTx3qajO/view?usp=drive_link', 4),
(20, 'Pengawas dan Pembina Angkutan', 'Seksi Angkutan', 'Lalu Lintas dan Angkutan', 'https://drive.google.com/file/d/1qNKeeaA5dDIanTrVlWFXaXSaqj9-xz2-/view?usp=drive_link', 1),
(21, 'Kepala Seksi Pengujian Sarana', 'Seksi Pengujian Sarana', 'Lalu Lintas dan Angkutan', 'https://drive.google.com/file/d/1psZggXaJ2gYp8NpwEFG1qwGmOU245GFj/view?usp=drive_link', 1),
(22, 'Pengawas Pengujian Kendaraan Bermotor', 'Seksi Pengujian Sarana', 'Lalu Lintas dan Angkutan', 'https://drive.google.com/file/d/1qD3v7HSHcGlRSHfs9p9yw2SiXxAfQ2xZ/view?usp=drive_link', 2),
(23, 'Pengelola Pengujian Kendaraan', 'Seksi Pengujian Sarana', 'Lalu Lintas dan Angkutan', 'https://drive.google.com/file/d/1uIlWZO5QdJwVIe7t4VLtE3krel00PGQH/view?usp=drive_link', 2),
(24, 'Pengelola Perbengkelan dan Pengujian Kendaraan Bermotor', 'Seksi Pengujian Sarana', 'Lalu Lintas dan Angkutan', 'https://drive.google.com/file/d/1uTyJXQmOOHE2QXEC2Iqsqgyrj63dbxuU/view?usp=drive_link', 2),
(25, 'Kepala Bidang Prasarana', 'Bidang Prasarana', 'Prasarana', 'https://drive.google.com/file/d/1r5m1t_uUL-zHgfblNeyjLD5qr4KcMA7T/view?usp=drive_link', 1),
(26, 'Kepala Seksi Perencanaan Prasarana', 'Seksi Perencanaan Prasarana', 'Prasarana', 'https://drive.google.com/file/d/1smj8Y1cLJmjBVYa5CN9jkUV5qBTZL11v/view?usp=drive_link', 1),
(27, 'Analis Rencana Induk Jaringan Transportasi Darat', 'Seksi Perencanaan Prasarana', 'Prasarana', 'https://drive.google.com/file/d/1ro-tA6TyB0XoHJgaSxDQBFnWX3dnWGmz/view?usp=drive_link', 3),
(29, 'Kepala Seksi Pembangunan Prasarana', 'Seksi Pembangunan Prasarana', 'Prasarana', 'https://drive.google.com/file/d/1pY5zg_tKzEK08iaoASNlnPiu-anMaNEJ/view?usp=drive_link', 1),
(30, 'Pengembang Sarana Dan Prasarana', 'Seksi Pembangunan Prasarana', 'Prasarana', '', 0),
(31, 'Teknisi Survey Jaringan Prasarana dan Pelayanan Transportasi Jalan', 'Seksi Pembangunan Prasarana', 'Prasarana', 'https://drive.google.com/file/d/1rqHgqOMXBhL0qzM6nC-JvlrM4vfVQrNM/view?usp=drive_link', 3),
(32, 'Pengelola Sistem Informasi Sarana dan Prasarana Jalan', 'Seksi Pembangunan Prasarana', 'Prasarana', 'https://drive.google.com/file/d/1tTv6lan-xTe3wefcD2vgVfmxRZ4ExbwR/view?usp=drive_link', 1),
(33, 'Kepala Seksi Pengoperasian Prasarana', 'Seksi Pengoperasian Prasarana', 'Prasarana', 'https://drive.google.com/file/d/1uCkgjOdqG87ohFxmS-dW-e0NnJ1Z91_T/view?usp=drive_link', 1),
(34, 'Pengawas Angkutan dan Terminal', 'Seksi Pengoperasian Prasarana', 'Prasarana', 'https://drive.google.com/file/d/1rvlmduZIcShmy6PgRRgwBQorJs1E34GZ/view?usp=drive_link', 5),
(35, 'Pengelola Terminal', 'Seksi Pengoperasian Prasarana', 'Prasarana', 'https://drive.google.com/file/d/1rW88ZcDk1kagKQQaTmczW650Ru_VKlfJ/view?usp=drive_link', 0),
(36, 'Pengelola Sertifikasi Kompetensi Penilai Analisis Dampak Lalulintas', 'Seksi Pengoperasian Prasarana', 'Prasarana', 'https://drive.google.com/file/d/1st8klc0qoXF9ujxphbRtoBNzHx9PfWKv/view?usp=drive_link', 0),
(37, 'Kepala Bidang Pengembangan dan Keselamatan', 'Bidang Pengembangan dan Keselamatan', 'Pengembangan dan Keselamatan', 'https://drive.google.com/file/d/1qn7BhuZDFQdBCguXL6wEf51RY3B5A0TX/view?usp=drive_link', 1),
(38, 'Kepala Seksi Pemanduan Moda dan Teknologi Perhubungan', 'Seksi Pemanduan Moda dan Teknologi Perhubungan', 'Pengembangan dan Keselamatan', 'https://drive.google.com/file/d/1r_VtUWsFjr9pvgMMBbWTnhkubQnJXoNv/view?usp=drive_link', 1),
(39, 'Analis Rencana Umum Pemanduan Moda Transportasi Darat', 'Seksi Pemanduan Moda dan Teknologi Perhubungan', 'Pengembangan dan Keselamatan', 'https://drive.google.com/file/d/1slAVPBOquj-fOHYoPuvg_YJqHTvY4QFQ/view?usp=drive_link', 3),
(40, 'Penyurvei Pemanduan Moda', 'Seksi Pemanduan Moda dan Teknologi Perhubungan', 'Pengembangan dan Keselamatan', '', 1),
(41, 'Kepala Seksi Lingkungan Perhubungan', 'Seksi Lingkungan Perhubungan', 'Pengembangan dan Keselamatan', 'https://drive.google.com/file/d/1syfGcmJhuN-ps0a0dTfZj_p1HdFRDTvg/view?usp=drive_link', 1),
(42, 'Analis Perhubungan dan Telekomunikasi', 'Seksi Lingkungan Perhubungan', 'Pengembangan dan Keselamatan', 'https://drive.google.com/file/d/1pVVW_LE1mI_aqcKQcQDdyqprDa5XznMR/view?usp=drive_link', 1),
(43, 'Kepala Seksi Keselamatan', 'Seksi Keselamatan  ', 'Pengembangan dan Keselamatan', 'https://drive.google.com/file/d/1tprnkN-J3bQAup80UfUoC8CKaqtDARQW/view?usp=drive_link', 1),
(44, 'Pemeriksa Keselamatan Darat', 'Seksi Keselamatan  ', 'Pengembangan dan Keselamatan', 'https://drive.google.com/file/d/1q5HYp3xUzzkfY18BrtfkCJDqP95JbLno/view?usp=drive_link', 1),
(45, 'Penelaah Audit Keselamatan Jalan', 'Seksi Keselamatan  ', 'Pengembangan dan Keselamatan', 'https://drive.google.com/file/d/1rj_PcgJ_gtquCLJi9rQwSr62kgjkt2Ih/view?usp=drive_link', 1),
(46, 'Pengawas Keselamatan Angkutan', 'Seksi Keselamatan  ', 'Pengembangan dan Keselamatan', 'https://drive.google.com/file/d/1sbYryMXtuQt8GkC9sgMm18YHeqSnvBmO/view?usp=drive_link', 1),
(49, 'Pengadministrasi Pengujian Kendaraan Bermotor', 'Seksi Pengujian Sarana', 'Lalu Lintas dan Angkutan', 'https://drive.google.com/file/d/1s_f-HAuvovxqg2memV9XEpKq6FPc_D4a/view?usp=drive_link', 0),
(50, 'Pengelola Kepegawaian', 'Sub Bagian Umum', 'Sekretariat', 'https://drive.google.com/file/d/1sTmh6NE3zxVauIi-sL1w0IhRyyQCDfdX/view?usp=drive_link', 0),
(51, 'Pengelola Surat', 'Sub Bagian Umum', 'Sekretariat', 'https://drive.google.com/file/d/1qM720UZzU13lQ59gz9Hiynf7ZUGOaB7B/view?usp=drive_link', 0),
(52, 'Pengemudi', 'Sub Bagian Umum', 'Sekretariat', 'https://drive.google.com/file/d/1plkXVBZyAQfHiVqMwUl-PaUpz0bGQxoy/view?usp=drive_link', 0),
(53, 'Pramu Bakti', 'Sub Bagian Umum', 'Sekretariat', 'https://drive.google.com/file/d/1tHOFIYDnX4NRQco73WXZrOKS_vpT8uq_/view?usp=drive_link', 0),
(54, 'Analis Perencanaan', 'Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat', 'https://drive.google.com/file/d/1sDIBuPqhKX4ViFiiWUyTMXISfHuNIUVo/view?usp=drive_link', 0),
(55, 'Pengelola Bahan Perencanaan', 'Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat', 'https://drive.google.com/file/d/1qen_sGw_CRB5OxyP5g3RivpxebM-z3Wi/view?usp=drive_link', 0),
(56, 'Verifikator Keuangan', 'Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat', 'https://drive.google.com/file/d/1q_b_1sOQNaHqee5gU40LuX_E5XPHlIpR/view?usp=drive_link', 0),
(57, 'Pengelola Pengawasan LLAJ', 'Seksi Lalu Lintas', 'Lalu Lintas dan Angkutan', 'https://drive.google.com/file/d/1rnwPzcXZAmotRkf67wtjsvq9BWlR3-Q0/view?usp=drive_link', 0),
(58, 'Kepala UPTD Pengujian Kendaraan Bermotor', 'UPTD Pengujian Kendaraan Bermotor', 'UPTD Pengujian Kendaraan Bermotor', 'https://drive.google.com/file/d/1t7ofDr0FesixegyLKmhKBB7SMtxoO18s/view?usp=drive_link', 0),
(59, 'Kepala Subbagian Tata Usaha UPTD Pengujian Kendaraan Bermotor', 'Sub Bagian Tata Usaha UPTD Pengujian Kendaraan Bermotor', 'UPTD Pengujian Kendaraan Bermotor', 'https://drive.google.com/file/d/1q5kDhcjTJYavApd0Ykc92qW10MN8-CZY/view?usp=drive_link', 0),
(60, 'Pengelola Pengujian Kendaraan Bermotor', 'Sub Bagian Tata Usaha UPTD Pengujian Kendaraan Bermotor', 'UPTD Pengujian Kendaraan Bermotor', 'https://drive.google.com/file/d/1uIlWZO5QdJwVIe7t4VLtE3krel00PGQH/view?usp=drive_link', 0),
(61, 'Pengadministrasi Umum Pengujian Kendaraan Bermotor', 'Sub Bagian Tata Usaha UPTD Pengujian Kendaraan Bermotor', 'UPTD Pengujian Kendaraan Bermotor', 'https://drive.google.com/file/d/1uJHnig_3TAO0AoPwArHXpaHobk7mPAM2/view?usp=drive_link', 0),
(62, 'Pengadministrasi Pengujian Kendaraan Bermotor', 'Sub Bagian Tata Usaha UPTD Pengujian Kendaraan Bermotor', 'UPTD Pengujian Kendaraan Bermotor', 'https://drive.google.com/file/d/1s_f-HAuvovxqg2memV9XEpKq6FPc_D4a/view?usp=drive_link', 0),
(63, 'Penguji Kendaraan Bermotor Penyelia', 'Penguji Kendaraan Bermotor', 'UPTD Pengujian Kendaraan Bermotor', 'https://drive.google.com/file/d/1uAwEI9ZJMQRWGhGXL2nhv7XJMIBrlB4d/view?usp=drive_link', 0),
(64, 'Penguji Kendaraan Bermotor Mahir', 'Penguji Kendaraan Bermotor', 'UPTD Pengujian Kendaraan Bermotor', 'https://drive.google.com/file/d/1q9uk7L3pq54rpCNmDpKaN8l71DfndS2F/view?usp=drive_link', 0),
(65, 'Penguji Kendaraan Bermotor Terampil', 'Penguji Kendaraan Bermotor', 'UPTD Pengujian Kendaraan Bermotor', 'https://drive.google.com/file/d/1qEJqyhYBUr4odrrVrD_Gw6yxFTqgWxdm/view?usp=drive_link', 0),
(66, 'Penguji Kendaraan Bermotor Pemula', 'Penguji Kendaraan Bermotor', 'UPTD Pengujian Kendaraan Bermotor', 'https://drive.google.com/file/d/1peK4p3MrA4xCDYnrKoKQ2I2m-QTanT6N/view?usp=drive_link', 0),
(67, 'Kepala Seksi Pengelolan Perparkiran', 'Seksi Pengelolan Perparkiran', 'Prasarana', 'https://drive.google.com/file/d/1ryD2UrqCvwYTyHWDcoNPmjoBs7cfRsYl/view?usp=drive_link', 0),
(68, 'Analis Perizinan Transportasi', 'Seksi Pengelolan Perparkiran', 'Prasarana', 'https://drive.google.com/file/d/1q_LtR9t12BQQeOf7GFROFWrXTasku6sL/view?usp=drive_link', 0),
(69, 'Pengelola Perparkiran', 'Seksi Pengelolan Perparkiran', 'Prasarana', 'https://drive.google.com/file/d/1rTKxGzz6nC7xM2piR531fDh_eI9_TTou/view?usp=drive_link', 0),
(70, 'Juru Pungut Retribusi', 'Seksi Pengelolan Perparkiran', 'Prasarana', 'https://drive.google.com/file/d/1qQkMCkzvPLCY83CyevkRlmb-_m_v8j92/view?usp=drive_link', 1),
(72, 'Operator Terminal', 'Seksi Perencanaan Prasarana', 'Prasarana', 'https://drive.google.com/file/d/1tn289ik5pntOcJQlaN1rJhcqYpOAoMH7/view?usp=drive_link', 1),
(73, 'Operator Speedboat', 'Seksi Angkutan', 'Lalu Lintas dan Angkutan', 'https://drive.google.com/file/d/1qdDJ8oaiovq2FBmMJ47Hg_C-5dIph62u/view?usp=drive_link', 0),
(74, 'Pemeriksa Terminal', 'Seksi Perencanaan Prasarana', 'Prasarana', 'https://drive.google.com/file/d/1rGMfVgqWXJZBx-oy92eDrE4UlOaAXdZf/view?usp=drive_link', 0),
(75, 'Pengelola Sertifikasi Desain Teknis Perlengkapan Jalan', 'Seksi Pembangunan Prasarana', 'Prasarana', 'https://drive.google.com/file/d/1sJ7zaVmNFj0N6Xx6vDwxpGst93IXIOv7/view?usp=drive_link', 0),
(76, 'Analis Teknik Survey Pemanduan Moda Transportasi Darat', 'Seksi Pemanduan Moda dan Teknologi Perhubungan', 'Pengembangan dan Keselamatan', 'https://drive.google.com/file/d/1qPVOG0XS1PkStk8AYFTq8suxjkl8N1tb/view?usp=drive_link', 0),
(77, 'Surveyor Pemanduan Moda Transportasi', 'Seksi Pemanduan Moda dan Teknologi Perhubungan', 'Pengembangan dan Keselamatan', 'https://drive.google.com/file/d/1px8MnXFCP-vAZCe_F1ewuc_aw_21quhv/view?usp=drive_link', 0),
(78, 'Juru Pungut Retribusi', 'Seksi Lingkungan Perhubungan', 'Pengembangan dan Keselamatan', 'https://drive.google.com/file/d/1qQkMCkzvPLCY83CyevkRlmb-_m_v8j92/view?usp=drive_link', 1),
(79, 'Pengelola Program dan Laporan', 'Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat', 'https://drive.google.com/file/d/1qDVa1ILpiPgUcLXFSeLXFgTW7ADW8GRc/view?usp=drive_link', 1),
(80, 'Pembantu Bendahara Pengeluaran', 'Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat', 'https://drive.google.com/file/d/1uZaZBGzOfGaujAIbDwCmkuCCMN27wiUm/view?usp=drive_link', 1);

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

--
-- Dumping data untuk tabel `kendaraan`
--

INSERT INTO `kendaraan` (`id`, `nomor_kendaraan`, `jenis_kendaraan`, `waktu_masuk`, `lokasi_parkir`, `status`) VALUES
(142, 'PB3517F', 'Mobil', '2024-03-29 06:20:36', 'Terminal Torea', 'Masuk');

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

--
-- Dumping data untuk tabel `kendaraan_keluar`
--

INSERT INTO `kendaraan_keluar` (`id`, `nomor_kendaraan`, `trayek`, `waktu_keberangkatan`, `jumlah_penumpang_keluar`, `tujuan_terminal`, `retribusi`, `waktu_kedatangan`, `jumlah_penumpang_masuk`, `asal_terminal`) VALUES
(3, 'PB1234F', 'A', '2024-03-06 20:27:00', 2, 'Terminal Torea', 2000, NULL, NULL, ''),
(4, 'PB1234F', 'B', '2024-03-06 23:06:00', 5, 'Terminal Kokas', 2000, NULL, NULL, ''),
(5, 'PB1234F', 'B', '2024-03-06 15:46:00', 21, 'Terminal Torea', 2000, NULL, NULL, ''),
(6, 'PB1234F', 'A', '2024-03-06 16:24:00', 7, 'Terminal Sebrang', 2000, NULL, NULL, ''),
(7, 'PB1234F', 'A', '2024-03-06 17:11:00', 7, 'Terminal Kokas', 2000, NULL, NULL, ''),
(8, 'PB1234F', 'A', '2024-03-07 03:31:00', 4, 'Terminal Wartutin', 2000, NULL, NULL, ''),
(9, 'PB1234F', 'C', '2024-03-07 03:31:00', 7, 'Terminal Kokas', 2000, NULL, NULL, ''),
(10, 'PB1234F', 'B', '2024-03-07 03:34:00', 3, 'Terminal Kokas', 2000, NULL, NULL, ''),
(11, 'PB7891F', 'A', '2024-03-07 03:35:00', 1, 'Terminal Bomberai', 2000, NULL, NULL, ''),
(12, 'PB1234F', 'A', '2024-03-07 03:57:00', 6, 'Terminal Bomberai', 2000, NULL, NULL, ''),
(13, 'PB3121F', 'A', '2024-03-07 04:01:00', 4, 'Terminal Wartutin', 5000, NULL, NULL, ''),
(14, 'PB4141F', 'A', '2024-02-07 04:08:00', 4, 'Terminal Kokas', 2000, NULL, NULL, ''),
(15, 'PB7891F', 'A', '2024-01-07 04:45:00', 5, 'Terminal Wartutin', 2000, NULL, NULL, ''),
(16, 'PB7891F', 'B', '2024-03-08 15:17:00', 20, 'Terminal Sebrang', 2000, '2024-03-08 14:40:00', 4, ''),
(17, '', '', '2024-03-08 17:08:00', 0, 'Terminal Sebrang', 2000, '0000-00-00 00:00:00', 0, ''),
(18, 'PB4741F', 'A', '2024-03-08 17:09:00', 0, 'Terminal Sebrang', 2000, '2024-03-08 14:54:00', 3, ''),
(19, 'PB7891F', 'A', '2024-03-08 17:10:00', 1, 'Terminal Sebrang', 2000, '2024-03-08 17:07:00', 5, ''),
(20, 'PB3121F', 'B', '2024-03-09 19:28:00', 2, 'Terminal Kokas', 2000, '2024-03-08 17:20:00', 3, ''),
(21, 'PB1234F', 'B', '2024-03-10 00:24:00', 3, 'Terminal Bomberai', 2000, '2024-03-09 19:14:00', 1, ''),
(22, 'PB9999F', 'D', '2024-03-10 16:22:00', 3, 'Terminal Sebrang', 2000, '2024-03-10 16:00:00', 10, 'Terminal Kokas'),
(23, 'PB1234F', 'D', '2024-03-10 20:28:00', 1, 'Terminal Torea', 2000, '2024-03-10 15:57:00', 7, 'Terminal Tambaruni'),
(24, 'PB666F', 'D', '2024-03-10 21:04:00', 2, 'Terminal Sebrang', 2000, '2024-03-10 15:59:00', 5, 'Terminal Werba'),
(25, 'PB9999F', 'C', '2024-03-10 21:04:00', 1, 'Terminal Sebrang', 2000, '2024-03-10 19:43:00', 3, 'Terminal Bomberai'),
(26, 'PB7891F', 'A', '2024-03-10 21:04:00', 3, 'Terminal Sebrang', 2000, '2024-03-10 00:24:00', 2, 'Terminal Kokas'),
(27, 'PB3121F', 'B', '2024-03-10 21:04:00', 4, 'Terminal Sebrang', 2000, '2024-03-10 19:30:00', 1, 'Terminal Wartutin'),
(28, 'PB4141F', 'B', '2024-03-10 21:04:00', 5, 'Terminal Sebrang', 2000, '2024-03-10 19:49:00', 4, 'Terminal Torea'),
(29, 'PB5828F', 'B', '2024-03-10 21:04:00', 1, 'Terminal Sebrang', 2000, '2024-03-10 20:27:00', 6, 'Terminal Wartutin'),
(30, 'PB3212F', 'D', '2024-03-13 23:13:00', 3, 'Terminal Kokas', 2000, '2024-03-10 20:15:00', 5, 'Terminal Torea'),
(31, 'PB7891F', 'B', '2024-03-13 23:14:00', 5, 'Terminal Sebrang', 2000, '2024-03-13 23:14:00', 3, 'Terminal Bomberai'),
(32, 'PB7891F', 'C', '2024-03-17 20:31:00', 0, 'Terminal Torea', 2000, '2024-03-17 18:04:00', 2, 'Terminal Thumburuni'),
(33, 'PB666F', 'A', '2024-03-17 20:32:00', 2, 'Terminal Wartutin', 2000, '2023-11-23 00:00:00', 3, 'Terminal Torea'),
(34, 'PB3254F', 'B', '2024-03-17 21:08:00', 3, 'Terminal Sebrang', 2000, '2024-03-13 22:53:00', 3, 'Terminal Torea'),
(35, 'PB3121F', 'B', '2024-03-17 21:09:00', 6, 'Terminal Sebrang', 2000, '2024-03-17 21:08:00', 3, 'Terminal Thumburuni'),
(36, 'PB1234F', 'A', '2024-03-17 23:47:00', 0, 'Terminal Kokas', 2000, '2024-03-17 20:28:00', 3, 'Terminal Thumburuni'),
(37, 'PB7891F', 'C', '2024-03-19 02:40:00', 0, 'Terminal Torea', 2000, '2024-03-17 23:46:00', 2, 'Terminal Thumburuni'),
(38, 'PB1234F', 'A', '2024-03-29 06:36:00', 2, 'Terminal Sebrang', 2000, '2024-03-19 02:39:00', 3, 'Terminal Thumburuni'),
(39, 'PB4141F', 'B', '2024-03-29 06:47:00', 9, 'Terminal Sebrang', 2000, '2024-03-17 20:30:00', 2, 'Terminal Sebrang'),
(40, 'PB3517F', 'A', '2024-03-29 19:46:00', 1, 'Terminal Torea', 2000, '2024-03-29 06:28:00', 3, 'Terminal Thumburuni'),
(41, 'PB1254F', 'C', '2024-03-30 01:34:00', 0, 'Terminal Sebrang', 2000, '2024-03-29 19:42:00', 3, 'Terminal Thumburuni'),
(42, 'PB6485F', 'D', '2024-03-30 01:35:00', 1, 'Terminal Wartutin', 2000, '2024-03-30 01:00:00', 4, 'Terminal Sebrang'),
(43, 'PB3252F', 'A', '2024-03-30 01:36:00', 3, 'Terminal Puncak', 2000, '2024-03-30 01:01:00', 2, 'Terminal Wartutin'),
(44, 'PB2145F', 'C', '2024-03-30 01:39:00', 6, 'Terminal Bomberai', 2000, '2024-03-30 01:16:00', 3, 'Terminal Thumburuni'),
(45, 'PB 6464 F', 'A', '2025-03-14 13:29:00', 0, 'Terminal Kokas', 2000, '2025-03-14 13:29:00', 3, 'Terminal Bomberai'),
(46, 'PB3517F', 'A', '2025-03-14 13:30:00', 9, 'Terminal Kokas', 2000, '2024-03-30 00:59:00', 3, 'Terminal Thumburuni'),
(47, 'PB4614F', 'E', '2025-04-14 23:54:00', 0, 'Terminal Torea', 2000, '2024-03-30 01:01:00', 5, 'Terminal Bomberai');

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

--
-- Dumping data untuk tabel `kendaraan_masuk`
--

INSERT INTO `kendaraan_masuk` (`id`, `nomor_kendaraan`, `trayek`, `waktu_kedatangan`, `jumlah_penumpang_masuk`, `asal_terminal`) VALUES
(45, 'PB9645F', 'B', '2024-03-30 00:59:00', 3, 'Terminal Torea'),
(46, 'PB3254F', 'C', '2024-03-30 00:59:00', 3, 'Terminal Puncak'),
(48, 'PB8524F', 'E', '2024-03-30 01:00:00', 4, 'Terminal Kokas'),
(52, 'PB8547F', 'C', '2024-03-30 01:18:00', 3, 'Terminal Thumburuni'),
(53, 'PB5252F', 'B', '2024-03-30 01:24:00', 2, 'Terminal Thumburuni'),
(54, 'PB7485F', 'A', '2024-03-30 01:30:00', 6, 'Terminal Thumburuni'),
(55, 'PB 9999 F', 'A', '2024-07-25 04:22:01', 5, 'Terminal Kokas'),
(57, 'PB 6969 F', 'A', '2025-04-14 17:41:00', 3, 'Terminal Bomberai'),
(58, 'PB 5488 F', 'C', '2025-04-14 23:53:00', 6, 'Terminal Puncak'),
(59, 'PB 11111 F', 'A', '2025-04-15 13:21:00', 0, 'Terminal Bomberai');

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

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id`, `nomor_surat`, `tanggal`, `jenis_laporan`, `isi`, `status`, `file_google_drive`) VALUES
(1, '3151/awdaw/1212/2024', '2024-03-09', 'Mingguan', 'pengecekan pasukan', 'Pending', 'FORMAT SURAT IJIN DAN PERYATAAN (4) (5).pdf'),
(2, '51565151/218518/sada/2021', '2024-03-14', 'Tahunan', 'jelas', 'Approved', 'https://drive.google.com/file/d/16jMrI4d_jaA6cXfi2AmFOJHTNZkvMByt/view?usp=drive_link'),
(3, '1651/awda/515661', '2024-03-15', 'Bulanan', 'sip', 'Rejected', 'https://drive.google.com/file/d/16ChPDXej2Feri3MzojkjJmvDN8yc5k9f/view?usp=drive_link'),
(4, '1212/bap/2024', '2024-11-20', 'Bulanan', 'audit kegiatan', 'Pending', 'https://drive.google.com/file/d/16jMrI4d_jaA6cXfi2AmFOJHTNZkvMByt/view?usp=drive_link');

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

--
-- Dumping data untuk tabel `laporan_parkir`
--

INSERT INTO `laporan_parkir` (`id`, `id_kendaraan`, `nomor_kendaraan`, `jenis_kendaraan`, `waktu_masuk`, `waktu_keluar`, `biaya_parkir`, `status`, `bulan_laporan`, `tahun_laporan`, `nama`, `lokasi_parkir`) VALUES
(109, 123, 'PB3121F', 'Mobil', '2024-03-09 16:00:24', '2024-03-09 16:01:25', 27000, 'Keluar', 3, 2024, 'Michael Gray', ''),
(110, 124, 'PB1234F', 'Mobil', '2024-03-10 00:02:10', '2024-03-09 16:02:17', 3000, 'Keluar', 3, 2024, 'Thomas Shelby', ''),
(111, 125, 'PB3121F', 'Motor', '2024-03-10 00:16:21', '2024-03-09 23:16:30', 2000, 'Keluar', 3, 2024, 'Michael Gray', ''),
(112, 126, 'PB666F', 'Motor', '2024-03-10 00:17:44', '2024-03-10 00:17:57', 2000, 'Keluar', 3, 2024, 'Michael Gray', ''),
(113, 127, 'PB4141F', 'Motor', '2024-03-09 20:18:13', '2024-03-10 00:18:45', 10000, 'Keluar', 3, 2024, 'Luca Changretta', ''),
(114, 128, 'PB1234F', 'Motor', '2024-03-10 13:08:50', '2024-03-10 15:01:21', 4000, 'Keluar', 3, 2024, 'Michael Gray', ''),
(115, 129, 'PB2525F', 'Motor', '2024-03-11 11:26:03', '2024-03-11 11:27:50', 2000, 'Keluar', 3, 2024, 'Michael Gray', ''),
(116, 130, 'PB7891F', 'Motor', '2024-03-13 17:45:45', '2024-03-13 17:46:22', 2000, 'Keluar', 3, 2024, 'Thomas Shelby', ''),
(117, 132, 'PB7891F', 'Mobil', '2024-03-17 20:16:53', '2024-03-17 20:17:15', 3000, 'Keluar', 3, 2024, 'Luca Changretta', ''),
(118, 131, 'PB3121F', 'Motor', '2024-03-17 20:16:08', '2024-03-18 00:09:39', 8000, 'Keluar', 3, 2024, 'Finn Shelby', ''),
(119, 135, 'PB1234F', 'Motor', '2024-03-18 03:41:53', '2024-03-18 03:46:38', 2000, 'Keluar', 3, 2024, 'Luca Changretta', ''),
(120, 136, 'PB3121F', 'Mobil', '2024-03-18 03:49:54', '2024-03-18 03:53:24', 3000, 'Keluar', 3, 2024, 'Luca Changretta', 'Terminal Thumburuni'),
(121, 134, 'PB666F', 'Motor', '2024-03-18 00:08:38', '2024-03-18 04:13:24', 10000, 'Keluar', 3, 2024, 'Luca Changretta', ''),
(122, 137, 'PB3121F', 'Motor', '2024-03-18 04:12:58', '2024-03-18 04:14:35', 2000, 'Keluar', 3, 2024, 'Arthur Shelby', 'Pasar Tanjung Wagom'),
(123, 133, 'PB4741F', 'Mobil', '2024-03-17 20:17:01', '2024-03-18 04:14:45', 24000, 'Keluar', 3, 2024, 'Luca Changretta', ''),
(124, 140, 'PB7891F', 'Mobil', '2024-03-18 04:14:21', '2024-03-18 04:14:51', 3000, 'Keluar', 3, 2024, 'Luca Changretta', 'Parkir Kota'),
(125, 138, 'PB4141F', 'Mobil', '2024-03-18 04:13:48', '2024-03-18 04:14:56', 3000, 'Keluar', 3, 2024, 'Thomas Shelby', 'Pasar Thumburuni'),
(126, 141, 'PB3121F', 'Motor', '2024-03-19 01:12:50', '2024-03-25 04:39:41', 296000, 'Keluar', 3, 2024, 'Arthur Shelby', 'Jalan Reklamasi'),
(127, 139, 'PB7891F', 'Motor', '2024-03-18 04:13:56', '2024-03-30 02:55:03', 574000, 'Keluar', 3, 2024, 'AMINUDIN TANGGAHMA', 'Pasar Tanjung Wagom');

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
(1, 'W 1234 A', 'SB 12345 G', 'DENNY ES TEH', 'JOGJA', '1552.23/1709/437.55.04/NPU/2024', 'https://drive.google.com/file/d/1cvWZ2gfXFxPXiVcCXS-VixqppRje2a_f/view?usp=drive_link', '2024-12-05 02:22:15'),
(2, 'W 4321 B', 'SB 54321 G', 'KEPIN', 'MOJOKERTO', '1552.23/1267/437.55.04/NPU/2024', 'https://drive.google.com/file/d/10KUdQeAa3XzBDPT59uzjJDriQkMQwsoY/view?usp=drive_link', '2024-12-05 02:22:15');

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
-- Struktur dari tabel `parkir`
--

CREATE TABLE `parkir` (
  `id` int NOT NULL,
  `lokasi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `parkir`
--

INSERT INTO `parkir` (`id`, `lokasi`, `alamat`, `keterangan`, `foto`) VALUES
(1, 'Terminal Thumburuni', 'Jl. Thumburuni', 'Kapasitas 100 kendaraan', 0x6173736574732f696d672f7061726b69722f5465726d696e616c205468756d627572756e692e6a7067),
(3, 'Terminal Torea', 'Dulan Pokpok', 'kapasitas 50 kendaraan', 0x6173736574732f696d672f7061726b69722f5465726d696e616c20546f7265612e6a7067),
(6, 'Jalan Reklamasi', 'Jl. Reklamasi Fakfak', 'kapasitas 60 Kendaraan', 0x6173736574732f696d672f7061726b69722f4a616c616e2052656b6c616d6173692e6a7067),
(7, 'Jalan Kota', 'Jl. Izzak Telussa', 'Kapasitas 50 Kendaraan', 0x4a616c616e204b6f74612e6a7067),
(8, 'Pasar Thumburuni', 'Jl. Thumburuni', 'Kapasitas 40 Kendaraan', 0x6173736574732f696d672f7061726b69722f5061736172205468756d627572756e692e6a7067);

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
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama`, `pangkat`, `nip`, `jabatan`, `seksi`, `bidang`) VALUES
(91, 'T. HERU USWANAS, S.Sos. M.Si', 'PEMBINA UTAMA MUDA (IV/c)', '196709041996101002', 'Kepala Dinas', 'Kepala Dinas', 'Kepala Dinas'),
(92, 'TEGUH SUGIHARTO, S.T', 'PEMBINA TK I (IV/b)', '197011141997121001', 'Sekertaris', 'Sekertaris', 'Sekretariat'),
(93, 'RISMAWATI AKATIAN, SE', 'PENATA TK. I (III/d )', '198309062009092003', 'Kepala Sub Bagian Umum', 'Sub Bagian Umum', 'Sekretariat'),
(94, 'ENGGAR MASTUTI, SE. M.Si', 'PEMBINA ( IV/a )', '197505312007012013', 'Kepala Sub Bagian Perencanaan dan Pelaporan', 'Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat'),
(95, 'SENEN SAGAS, SE', 'PEMBINA  (IV/a)', '196705191998031005', 'Kepala Bidang Lalu Lintas dan Angkutan', 'Bidang Lalu Lintas dan Angkutan', 'Lalu Lintas dan Angkutan'),
(96, 'SITI FITRIAH USWANAS, ST.M.S.P', 'PENATA TK. I (III/d)', '198307162011042001', 'Kepala Seksi Lalu Lintas', 'Seksi Lalu Lintas', 'Lalu Lintas dan Angkutan'),
(97, 'HUSEIN PATTY, S.Sos', 'PENATA TK. I (III/d )', '197608032006051001', 'Kepala Seksi Angkutan', 'Seksi Angkutan', 'Lalu Lintas dan Angkutan'),
(98, 'ACHMAD HELFAN AMRI, SE', 'PENATA TINGKAT I (III/d )', '197009091992031009', 'Kepala Seksi Pengujian Sarana', 'Seksi Pengujian Sarana', 'Lalu Lintas dan Angkutan'),
(99, 'SAIFFUDIN SOEMARDI, S.Sos', 'PENATA TINGKAT I (III/d)', '197405202007011029', 'Kepala Bidang Prasarana', 'Bidang Prasarana', 'Prasarana'),
(100, 'SITTI HASANNOESI', 'PENATA TINGKAT I (III/d)', '196706011992032011', 'Kepala Seksi Perencanaan Prasarana', 'Seksi Perencanaan Prasarana', 'Prasarana'),
(101, 'CLEMENTINA HOMBA HOMBA, SE', 'PENATA TINGKAT I (III/d)', '196507112000122001', 'Kepala Seksi Pembangunan Prasarana', 'Seksi Pembangunan Prasarana', 'Prasarana'),
(102, 'IRMAWATI', 'PENATA TK. I (III/d)', '196904211992032010', 'Kepala Seksi Pengoperasian Prasarana', 'Seksi Pengoperasian Prasarana', 'Prasarana'),
(103, 'JAPARI BIARPRUGA, SE', 'PEMBINA (IV/a)', '197305092003121007', 'Kepala Bidang Pengembangan dan Keselamatan', 'Bidang Pengembangan dan Keselamatan', 'Pengembangan dan Keselamatan'),
(104, 'DEDY MALIK RUMAGESAN, S.ST(TD)', 'PENATA (III/c)', '198512192005021001', 'Kepala Seksi Pemanduan Moda dan Teknologi Perhubungan', 'Seksi Pemanduan Moda dan Teknologi Perhubungan', 'Pengembangan dan Keselamatan'),
(105, 'YOHAN A.T ARAGAY, SE', 'PENATA (III/c)', '197704262000121004', 'Kepala Seksi Lingkungan Perhubungan', 'Seksi Lingkungan Perhubungan', 'Pengembangan dan Keselamatan'),
(106, 'NANI MADI, S.Sos', 'PENATA TINGKAT I (III/d)', '197505212006052001', 'Kepala Seksi Keselamatan', 'Seksi Keselamatan', 'Pengembangan dan Keselamatan'),
(107, 'HARSINI ELEUWARIN, S.Sos', 'PENATA (III/c)', '198203202009042001', 'Pengadministrasi Umum', 'Sub Bagian Umum', 'Sekretariat'),
(108, 'MUHAMAD RUMBAY, A.Md', 'PENATA MUDA Tk.I (III/b)', '197812012009091001', 'Pengelola Barang Milik Negara', 'Sub Bagian Umum', 'Sekretariat'),
(109, 'MARLON RESBAL', 'PENGATUR (II/c)', '198209202009041001', 'Pengelola Sarana Prasarana dan Rumah Tangga Dinas', 'Sub Bagian Umum', 'Sekretariat'),
(110, 'SUMARDIN, SE', 'PENATA MUDA (III/a)', '198509162010011021', 'Bendahara', 'Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat'),
(111, 'FAHRUL SANI HUDA, A.Md', 'PENATA MUDA Tk.I (III/b)', '198506222009091001', 'Penata Laporan Keuangan', 'Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat'),
(112, 'AMELIA MADU, SE', 'PENATA MUDA (III/a)', '197903082015102001', 'Pengelola Program dan Laporan', 'Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat'),
(113, 'RINI JULIYANI, S.Si', 'PENATA MUDA (III/a)', '199006022020122019', 'Pengelola Pelaksanaan Program dan Anggaran', 'Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat'),
(114, 'MEGITA KRISTANTI TARUMASELE', 'PENGATUR MUDA (II/a)', '199905292020122003', 'Pembantu Bendahara Pengeluaran', 'Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat'),
(115, 'VERY SAHETAPY, SE', 'PENATA MUDA TINGKAT I (III/b)', '197402272007011014', 'Pemeriksa Lalu Lintas Darat', 'Seksi Lalu Lintas', 'Lalu Lintas dan Angkutan'),
(116, 'DAVID JAKMANAM, A.Md', 'PENATA MUDA TK. I (III/b)', '198506162011041001', 'Pemeriksa Lalu Lintas Darat', 'Seksi Lalu Lintas', 'Lalu Lintas dan Angkutan'),
(117, 'ALFI HTALA USWANAS, SE', 'PENATA MUDA TK.I (III/b)', '197802182008011011', 'Pengawas Lalu Lintas Darat', 'Seksi Lalu Lintas', 'Lalu Lintas dan Angkutan'),
(118, 'BENEDIKTA SEPSIA YULIANI, A.Md. Tra', 'PENGATUR (II/c)', '200009172022072001', 'Pengadministrasi LLAJ', 'Seksi Lalu Lintas', 'Lalu Lintas dan Angkutan'),
(119, 'SAFIJAN', 'PENGATUR  (II/c)', '197309012008011010', 'Pengadministrasi LLAJ', 'Seksi Lalu Lintas', 'Lalu Lintas dan Angkutan'),
(120, 'SAMAD HEGEMUR, A.Md', 'PENATA MUDA TK. I (III/b)', '198311202010041001', 'Analis Angkutan Darat', 'Seksi Angkutan', 'Lalu Lintas dan Angkutan'),
(121, 'MANSUR BATIGIN, S.T', 'PENATA MUDA (III/a)', '198712052020121008', 'Analis Angkutan Darat', 'Seksi Angkutan', 'Lalu Lintas dan Angkutan'),
(122, 'ADIB PRIYA MAHENDRA, S.ST (TD)', 'PENATA MUDA (III/a)', '199610062020121001', 'Pengawas dan Pembina Angkutan', 'Seksi Angkutan', 'Lalu Lintas dan Angkutan'),
(123, 'LEIVINA PENTURY, A.Md. LLAJ', 'PENGATUR (II/c)', '199509282020122001', 'Analis Angkutan Darat', 'Seksi Angkutan', 'Lalu Lintas dan Angkutan'),
(124, 'ELVIRA AZIZAH, A.Md. Tra', 'PENGATUR (II/c)', '200007072022072001', 'Analis Angkutan Darat', 'Seksi Angkutan', 'Lalu Lintas dan Angkutan'),
(125, 'JUNUS MARLESSY, S.Sos', 'PENATA TK. I (III/d)', '197206092006051002', 'Pengawas Pengujian Kendaraan Bermotor', 'Seksi Pengujian Sarana', 'Lalu Lintas dan Angkutan'),
(126, 'ACHMAD FARIS ZUBAIDI, A.Ma. PKB', 'PENGATUR (II/c)', '199507132017011001', 'Pengawas Pengujian Kendaraan Bermotor', 'Seksi Pengujian Sarana', 'Lalu Lintas dan Angkutan'),
(127, 'RENALDI DWI SAPUTRO, SE', 'PENATA MUDA (III/a)', '199504152017011001', 'Pengelola Pengujian Kendaraan', 'Seksi Pengujian Sarana', 'Lalu Lintas dan Angkutan'),
(128, 'WILSON GERALD FAIRIO, Amd.Kom', 'PENGATUR (II/c)', '198906032020121010', 'Pengelola Pengujian Kendaraan', 'Seksi Pengujian Sarana', 'Lalu Lintas dan Angkutan'),
(129, 'AGUSTINUS ELTON SESA, S.AP', 'PENATA MUDA (III/a)', '199308262018041001', 'Pengelola Perbengkelan dan Pengujian Kendaraan Bermotor', 'Seksi Pengujian Sarana', 'Lalu Lintas dan Angkutan'),
(130, 'YOHANIS HORIK, A.Md', 'PENGATUR (II/c)', '199101172020121007', 'Pengelola Perbengkelan dan Pengujian Kendaraan Bermotor', 'Seksi Pengujian Sarana', 'Lalu Lintas dan Angkutan'),
(131, 'ARDI CAHYADI RAMLY, A.Md', 'PENATA MUDA TK. I (III/b)', '198201202011041001', 'Analis Rencana Induk Jaringan Transportasi Darat', 'Seksi Perencanaan Prasarana', 'Prasarana'),
(132, 'F. LOYS PIAHAR', 'PENATA MUDA (III/a)', '197803012007011014', 'Analis Rencana Induk Jaringan Transportasi Darat', 'Seksi Perencanaan Prasarana', 'Prasarana'),
(133, 'KRISTIANUS HINDOM, A.Md, IP', 'PENATA (III/c)', '197003281995031003', 'Analis Rencana Induk Jaringan Transportasi Darat', 'Seksi Perencanaan Prasarana', 'Prasarana'),
(134, 'YUSLI ODENTEA', 'PENATA MUDA (III/a)', '198610012006051001', 'Operator Terminal', 'Seksi Perencanaan Prasarana', 'Prasarana'),
(135, 'JOHN ANDERZON ASE, A.Md', 'PENATA MUDA TINGKAT I (III/b)', '198211042008011013', 'Teknisi Survey Jaringan Prasarana dan Pelayanan Transportasi Jalan', 'Seksi Pembangunan Prasarana', 'Prasarana'),
(136, 'SHAFWAN BIN MOHAMMAD RUMAIN', 'PENATA MUDA (III/a)', '197704222007011010', 'Pengelola Sistem Informasi Sarana dan Prasarana Jalan', 'Seksi Pembangunan Prasarana', 'Prasarana'),
(137, 'NUR HUWAIDA ALYSSA PUTRI, A.Md.Tra', 'PENGATUR (II/c)', '200011112023022003', 'Teknisi Survey Jaringan Prasarana dan Pelayanan Transportasi Jalan', 'Seksi Pembangunan Prasarana', 'Prasarana'),
(138, 'VISCA PRICELLA, A.Md.Tra', 'PENGATUR (II/c)', '200004012023022002', 'Teknisi Survey Jaringan Prasarana dan Pelayanan Transportasi Jalan', 'Seksi Pembangunan Prasarana', 'Prasarana'),
(139, 'ABDUL MUTI RUMADAN', 'PENATA MUDA (III/a)', '197003062006051002', 'Pengawas Angkutan dan Terminal', 'Seksi Pengoperasian Prasarana', 'Prasarana'),
(140, 'LA KARIM', 'PENATA MUDA (III/a)', '197711292007011005', 'Pengawas Angkutan dan Terminal', 'Seksi Pengoperasian Prasarana', 'Prasarana'),
(141, 'FARIDS FIRMANSYAH SUPARMAN', 'PENATA MUDA (III/a)', '198405152007011006', 'Pengawas Angkutan dan Terminal', 'Seksi Pengoperasian Prasarana', 'Prasarana'),
(142, 'AMINUDIN TANGGAHMA', 'PENATA MUDA (III/a)', '197702152007011015', 'Pengawas Angkutan dan Terminal', 'Seksi Pengoperasian Prasarana', 'Prasarana'),
(143, 'MUHAMMAD MAHDI SARIF', 'PENATA MUDA (III/a)', '197010122006051003', 'Pengawas Angkutan dan Terminal', 'Seksi Pengoperasian Prasarana', 'Prasarana'),
(144, 'RIAN ERMAN SYAHYADI SARAGIH, S.ST', 'PENATA MUDA (III/a)', '198910302020121011', 'Analis Rencana Umum Pemanduan Moda Transportasi Darat', 'Seksi Pemanduan Moda dan Teknologi Perhubungan', 'Pengembangan dan Keselamatan'),
(145, 'MUH. YUSFA YUSUF, S.Kel', 'PENATA MUDA (III/a)', '198701142021121001', 'Analis Rencana Umum Pemanduan Moda Transportasi Darat', 'Seksi Pemanduan Moda dan Teknologi Perhubungan', 'Pengembangan dan Keselamatan'),
(146, 'AMRIZAL RUMASUKUN, A.Md. Tra', 'PENGATUR (II/c)', '199904032022071001', 'Analis Rencana Umum Pemanduan Moda Transportasi Darat', 'Seksi Pemanduan Moda dan Teknologi Perhubungan', 'Pengembangan dan Keselamatan'),
(147, 'ELIZA DOMINGGUS RISAMBESSY', 'PENGATUR (II/c)', '197603192015101001', 'Penyurvei Pemanduan Moda', 'Seksi Pemanduan Moda dan Teknologi Perhubungan', 'Pengembangan dan Keselamatan'),
(148, 'CHARLES SONNY TALLA', 'PENGATUR TK. I (II/d)', '198404112010011038', 'Juru Pungut Retribusi', 'Seksi Lingkungan Perhubungan', 'Pengembangan dan Keselamatan'),
(149, 'ADE IMAM PRADA S.Tr.Tra', 'PENATA MUDA (III/a)', '200012022023021006', 'Analis Perhubungan dan Telekomunikasi', 'Seksi Lingkungan Perhubungan', 'Pengembangan dan Keselamatan'),
(150, 'SYAIDIN MERAM, SE', 'PENATA (III/c)', '198402062007011006', 'Pemeriksa Keselamatan Darat', 'Seksi Keselamatan', 'Pengembangan dan Keselamatan'),
(151, 'DAME BUNGARIA SIANIPAR, A.Md', 'PENATA (III/c)', '197204242007012018', 'Penelaah Audit Keselamatan Jalan', 'Seksi Keselamatan', 'Pengembangan dan Keselamatan'),
(152, 'DARWAN MERAM, A.Md', 'PENATA MUDA Tk.I (III/b)', '198104292010041003', 'Pengawas Keselamatan Angkutan', 'Seksi Keselamatan', 'Pengembangan dan Keselamatan');

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
-- Struktur dari tabel `pegawai_pkb`
--

CREATE TABLE `pegawai_pkb` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `twitter` varchar(255) DEFAULT '',
  `facebook` varchar(255) DEFAULT '',
  `instagram` varchar(255) DEFAULT '',
  `linkedin` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pegawai_pkb`
--

INSERT INTO `pegawai_pkb` (`id`, `nama`, `jabatan`, `deskripsi`, `foto`, `twitter`, `facebook`, `instagram`, `linkedin`) VALUES
(1, 'ISBIKA PRIHANDONO', 'Pensiun', '-', 'Cuplikan layar 2024-12-05 173619.png', '', '', '', ''),
(2, 'DWI FERI ARDIANSAH', 'Kepala UPT', '-', 'IMG_9340 (1).jpg', '', '', '', ''),
(3, 'PATRIOT TEGUH SANTOSO', 'Penguji', '-', 'IMG-20220124-WA0040.jpg', '', '', '', ''),
(4, 'YULIANTO', 'PENGADMINISTRASI', '-', 'IMG_9336.JPG', '', '', '', ''),
(5, 'R.SUGENG RIYADI', 'KEARSIPAN', '-', 'IMG_9176.JPG', '', '', '', ''),
(6, 'DENI ESTU PRASETYO', 'Penguji', '-', 'IMG_9448.JPG', '', '', '', ''),
(7, 'PRIYO ADI NUGROHO', 'Penguji', '-', '199006232024211006.jpg', '', '', '', ''),
(8, 'KEVIN PRAYOGA', 'Penguji', '-', 'IMG_9280.JPG', '', '', '', ''),
(9, 'ACHMAD FARIS ZUBAIDI', 'Penguji', '-', 'IMG_9094.JPG', '', '', '', ''),
(10, 'Silfi Maulidatur Rohmah', 'REKOM NUMPANG UJI', '-', 'IMG_9324.JPG', '', '', '', ''),
(11, 'SURYA DENI ERDIANTO', 'PENGUJI', '-', 'IMG_9093.jpg', '', '', '', '');

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

--
-- Dumping data untuk tabel `pelayananumum`
--

INSERT INTO `pelayananumum` (`id`, `tanggal`, `nama_layanan`, `deskripsi`, `file_google_drive`, `pemohon`, `status`) VALUES
(2, '2024-03-11 00:00:00', 'ada kah?', 'ada sayang ada', NULL, 'sipaling', 'Approved'),
(9, '2024-03-12 08:17:45', 'Pinjam truck', '1 minggu', 'https://drive.google.com/file/d/0BzBaCdVh0eMDaXpJWVRwNjFlTGo0S0twSVk3SVdadUdlOGd3/view?usp=drive_link&resourcekey=0-F7hbfHPh4ASeOCshbM7FWw', 'adwdad', 'Approved'),
(10, '2024-03-12 08:23:23', 'pinjam bahu jalan', '1 bulan', 'https://drive.google.com/file/d/1vW9Eb2QiUWHsntwjZtei_x2yBbIwBYP8/view?usp=drive_link', 'malika', 'Rejected'),
(11, '2024-03-17 14:53:03', 'Pindah Trayek', 'dari trayek A ke C', 'Samsul_65f6f5bfcc37a.pdf', 'Samsul', 'Pending'),
(12, '2024-03-22 14:42:18', 'Pinjam Pickup', '2 minggu untuk bandara', 'https://drive.google.com/file/d/0BzBaCdVh0eMDaXpJWVRwNjFlTGo0S0twSVk3SVdadUdlOGd3/view?usp=drive_link&resourcekey=0-F7hbfHPh4ASeOCshbM7FWw', 'Yohanes', 'Approved'),
(13, '2024-11-20 06:48:16', 'Pinjam Pick Up', 'Pinjam 1 hari', 'https://drive.google.com/file/d/0BzBaCdVh0eMDaXpJWVRwNjFlTGo0S0twSVk3SVdadUdlOGd3/view?usp=drive_link&resourcekey=0-F7hbfHPh4ASeOCshbM7FWw', 'Marsyanda', 'Pending'),
(14, '2025-03-14 06:11:17', 'Izin Trayek', 'Trayek kokas', 'https://drive.google.com/file/d/0BzBaCdVh0eMDaXpJWVRwNjFlTGo0S0twSVk3SVdadUdlOGd3/view?usp=drive_link&resourcekey=0-F7hbfHPh4ASeOCshbM7FWw', 'Yunica', 'Pending'),
(15, '2025-03-14 06:19:41', 'Izin Angkutan Pariwisata', 'CV. Jasa Karya', 'https://drive.google.com/file/d/1vW9Eb2QiUWHsntwjZtei_x2yBbIwBYP8/view?usp=drive_link', 'Andik', 'Pending');

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

--
-- Dumping data untuk tabel `pelayanan_kantor`
--

INSERT INTO `pelayanan_kantor` (`id`, `nama`, `jadwal`, `keterangan`, `foto`) VALUES
(1, 'Operasional Pelayanan', 'Senin - Jumat, 08.00 - 16.00 WIB', 'Pelayanan di luar jam operasional dapat dilakukan melalui website atau aplikasi Dinas Perhubungan Kabupaten Fakfak. Untuk layanan pengaduan darurat, silakan hubungi nomor telepon (0956) 22214', 'Operasional Pelayanan.jpg'),
(2, 'Pelayanan Keamanan pada Hari Besar', 'Hari Raya Idul Fitri, Natal, Tahun Baru, HUT RI', 'Layanan ini meliputi: Pengaturan lalu lintas, Penjagaan di tempat-tempat wisata, Patroli keamanan', 'Pelayanan Keamanan pada Hari Besar.jpg');

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

--
-- Dumping data untuk tabel `pengawasan`
--

INSERT INTO `pengawasan` (`id`, `nomor_surat`, `jenis_pengawasan`, `tanggal`, `deskripsi`, `status`, `file_google_drive`) VALUES
(1, '99999999', 'Jaga Malam', '2024-03-11', 'Antisipasi Situasi dan Kondisi TPP', 'Approved', 'Jaga Malam_65f05305f3cff.pdf'),
(2, '3151/awdaw/1212/2024', 'Jaga Siang', '2024-03-12', 'jaga jalan', 'Approved', 'Jaga Siang_65f04e483868e.pdf'),
(3, '31222/arfasdaD/31321/2021', 'Jaga Jalan', '2024-03-17', 'Laksanakan', 'Rejected', 'https://drive.google.com/file/d/16HjQJyAqonnC-qX27S9ce68I10JTebGJ/view?usp=drive_link'),
(4, '74747/post/2024', 'Jaga', '2024-11-20', 'Jaga kampanye', 'Pending', 'https://drive.google.com/file/d/16RHCzs7w6OXHlfGo5siJ3k-D1WJAskO-/view?usp=drive_link');

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

--
-- Dumping data untuk tabel `pengelolaan`
--

INSERT INTO `pengelolaan` (`id`, `nomor_inventaris`, `nama_barang`, `jumlah`, `kondisi`, `tahun`, `foto`) VALUES
(3, '665188', 'HT', 11, 'Baik', '2019', 0x2e2e2f74656d706c617465732f70656e67656c6f6c61616e2f48545f363566333233393936336562302e6a7067),
(4, '65231', 'Ipad', 6, 'Baik', '2022', 0x2e2e2f74656d706c617465732f70656e67656c6f6c61616e2f497061645f363566343731316435663136362e6a7067),
(5, '75156', 'PC', 3, 'Baik', '2020', 0x2e2e2f74656d706c617465732f70656e67656c6f6c61616e2f50435f363566333137666532396231335f70632e6a7067),
(6, 'INV1156516516', 'AC', 9, 'Baik', '2021', 0x2e2e2f74656d706c617465732f70656e67656c6f6c61616e2f41435f363630313265613764656333625f61632e6a7067);

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

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id`, `nama`, `nip`, `jabatan`, `jadwal_kerja`, `telepon`, `foto`) VALUES
(3, 'AMINUDIN TANGGAHMA', '197702152007011015', 'Pengawas Angkutan dan Terminal', 'Terminal Kokas', '1231313', 0x3139373730323135323030373031313031352e6a7067),
(4, 'ABDUL MUTI RUMADAN', '197003062006051002', 'Pengawas Angkutan dan Terminal', 'Terminal Thumburuni', '02784132', 0x3139373030333036323030363035313030322e6a7067),
(6, 'LA KARIM', '197711292007011005', 'Pengawas Angkutan dan Terminal', 'Terminal Wartutin', '08234567', 0x3139373731313239323030373031313030352e6a7067),
(7, 'FARIDS FIRMANSYAH SUPARMAN', '198405152007011006', 'Pengawas Angkutan dan Terminal', 'Terminal Sebrang', '0864251', 0x3139383430353135323030373031313030362e6a7067),
(8, 'MUHAMMAD MAHDI SARIF', '197010122006051003', 'Pengawas Angkutan dan Terminal', 'Terminal Puncak', '082461425', 0x3139373031303132323030363035313030332e6a7067),
(10, 'JAPARI BIARPRUGA, SE', '197305092003121007', 'Kepala Bidang Pengembangan dan Keselamatan', 'Terminal Thumburuni', '03125458', 0x706574756761732e6a7067);

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

--
-- Dumping data untuk tabel `petugas_parkir`
--

INSERT INTO `petugas_parkir` (`id`, `nama`, `nip`, `jabatan`, `jadwal_kerja`, `telepon`, `foto`) VALUES
(2, 'CHARLES SONNY TALLA', '198404112010011038', 'Juru Pungut Retribusi', 'Terminal Thumburuni', '0321454', 0x31393436363531365f313437333738383333353939373436355f323734393438313637343335363538343334395f6f2e6a7067),
(3, 'ELIZA DOMINGGUS RISAMBESSY', '197603192015101001', 'Penyurvei Pemanduan Moda', 'Pasar Thumburuni', '03125458', 0x6c61706f72616e2e6a7067);

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

--
-- Dumping data untuk tabel `pinjaman`
--

INSERT INTO `pinjaman` (`id`, `id_barang`, `id_pegawai`, `waktu_pinjam`, `waktu_kembali`, `status`) VALUES
(1, 3, 152, '2024-03-28 22:03:38', '2024-03-28 22:13:40', 'Sudah Dikembalikan'),
(2, 5, 102, '2024-03-28 22:11:01', '2024-03-28 22:14:54', 'Sudah Dikembalikan'),
(3, 5, 105, '2024-03-28 22:11:22', '2024-03-28 22:11:22', 'Belum Dikembalikan'),
(4, 3, 103, '2024-03-28 22:24:03', '2024-03-28 22:24:03', 'Belum Dikembalikan'),
(5, 5, 104, '2024-03-28 22:28:18', '2024-03-28 22:28:18', 'Belum Dikembalikan'),
(6, 4, 103, '2024-03-28 22:30:05', '2024-08-20 18:10:46', 'Sudah Dikembalikan'),
(7, 4, 107, '2024-03-28 23:01:11', '2024-03-28 23:01:11', 'Belum Dikembalikan'),
(8, 4, 117, '2024-03-28 23:07:49', '2024-03-28 23:08:10', 'Sudah Dikembalikan'),
(9, 3, 106, '2024-03-28 23:08:24', '2024-03-29 00:09:44', 'Sudah Dikembalikan'),
(10, 3, 134, '2024-08-20 18:09:45', NULL, 'Belum Dikembalikan'),
(11, 6, 97, '2025-03-14 12:51:55', NULL, 'Belum Dikembalikan'),
(12, 4, 105, '2025-03-14 12:52:54', NULL, 'Belum Dikembalikan');

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

--
-- Dumping data untuk tabel `riwayat_absensi`
--

INSERT INTO `riwayat_absensi` (`id`, `nama`, `pangkat`, `nip`, `jabatan`, `bidang`, `waktu_pagi`, `waktu_sore`, `keterangan`, `tanggal_absensi`, `created_at`) VALUES
(993, 'T. HERU USWANAS, S.Sos. M.Si', 'PEMBINA UTAMA MUDA (IV/c)', '196709041996101002', 'Kepala Dinas', 'Kepala Dinas', '07:06:00', '16:38:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(994, 'YAKOBUS TANDUNG PABIMBIN, S.T., M.Si', 'PEMBINA ( IV/a )', '197209162001111001', 'Sekertaris', 'Sekretariat', '07:27:00', '16:31:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(995, 'RISMAWATI AKATIAN, SE', 'PENATA TK. I (III/d )', '198309062009092003', 'Kepala Sub Bagian Umum', 'Sekretariat', '07:22:00', '16:40:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(996, 'HUSEIN PATTY, S.Sos', 'PENATA TK. I (III/d )', '197608032006051001', 'Pengadministrasi Umum', 'Sekretariat', '07:18:00', '16:31:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(997, 'AMELIA MADU, SE', 'PENATA MUDA (III/a)', '197903082015102001', 'Analis Tata Usaha', 'Sekretariat', '07:19:00', '16:48:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(998, 'MEGITA KRISTANTI TARUMASELE', 'PENGATUR MUDA (II/a)', '199905292020122003', 'Pengadministrasi Umum', 'Sekretariat', '07:10:00', '16:50:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(999, 'MUHAMAD RUMBAY, A.Md', 'PENATA MUDA Tk.I (III/b)', '197812012009091001', 'Pengelola Barang Milik Negara', 'Sekretariat', '07:05:00', '16:39:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1000, 'MARLON RESBAL', 'PENGATUR (II/c)', '198209202009041001', 'Pengelola Sarana Prasarana dan Rumah Tangga Dinas', 'Sekretariat', '07:04:00', '16:57:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1001, 'ENGGAR MASTUTI, SE. M.Si', 'PEMBINA ( IV/a )', '197505312007012013', 'Kepala Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat', '07:03:00', '16:52:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1002, 'SUMARDIN, SE', 'PENATA MUDA (III/a)', '198509162010011021', 'Bendahara', 'Sekretariat', '07:22:00', '16:41:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1003, 'RIZAL MINGGELE, S.T', 'PENATA TINGKAT I (III/d)', '198207012009091001', 'Penata Laporan Keuangan', 'Sekretariat', '07:15:00', '16:58:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1004, 'DAME BUNGARIA SIANIPAR, A.Md', 'PENATA MUDA TINGKAT I (III/b)', '197204242007012018', 'Penata Laporan Keuangan', 'Sekretariat', '07:03:00', '16:35:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1005, 'RINI JULIYANI, S.Si', 'PENATA MUDA (III/a)', '199006022020122019', 'Pengelola Pelaksanaan Program dan Anggaran', 'Sekretariat', '07:08:00', '16:57:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1006, 'SENEN SAGAS, SE', 'PENATA TINGKAT I (III/d)', '196705191998031005', 'Kepala Bidang Lalu Lintas dan Angkutan', 'Lalu Lintas dan Angkutan', '07:00:00', '16:38:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1007, 'AGUNAWAN S. BANDASO, S.T', 'PENATA MUDA TINGKAT 1 (III/b)', '198905012015061001', 'Kepala Seksi Lalu Lintas', 'Lalu Lintas dan Angkutan', '07:22:00', '16:31:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1008, 'VERY SAHETAPY, SE', 'PENATA MUDA TINGKAT I (III/b)', '197402272007011014', 'Pemeriksa Lalu Lintas Darat', 'Lalu Lintas dan Angkutan', '07:29:00', '16:52:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1009, 'DAVID JAKMANAM, A.Md', 'PENATA MUDA (III/a)', '198506162011041001', 'Pemeriksa Lalu Lintas Darat', 'Lalu Lintas dan Angkutan', '07:30:00', '16:41:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1010, 'LA MAJA BIARPRUGA, S.Si', 'PENATA MUDA (III/a)', '198707282020121008', 'Pemeriksa Lalu Lintas Darat', 'Lalu Lintas dan Angkutan', '07:22:00', '16:48:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1011, 'ALFI HTALA USWANAS, SE', 'PENATA MUDA (III/b)', '197802182008011011', 'Pengawas Lalu Lintas Darat', 'Lalu Lintas dan Angkutan', '07:11:00', '16:47:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1012, 'CHARLES SONNY TALLA', 'PENGATUR (II/c)', '198404112010011038', 'Pengawas Lalu Lintas Darat', 'Lalu Lintas dan Angkutan', '07:14:00', '16:39:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1013, 'SAFIJAN', 'PENGATUR MUDA TK. I (II/b)', '197309012008011010', 'Pengadministrasi LLAJ', 'Lalu Lintas dan Angkutan', '07:06:00', '16:42:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1014, 'JOSEP KABES, SH', 'PENATA (III/c)', '196505141985031004', 'Kepala Seksi Angkutan', 'Lalu Lintas dan Angkutan', '07:02:00', '16:35:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1015, 'SAMAD HEGEMUR, A.Md', 'PENATA MUDA (III/a)', '198311202010041001', 'Analis Angkutan Darat', 'Lalu Lintas dan Angkutan', '07:09:00', '16:59:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1016, 'LEIVINA PENTURY, A.Md. LLAJ', 'PENGATUR (II/c)', '199509282020122001', 'Analis Angkutan Darat', 'Lalu Lintas dan Angkutan', '07:07:00', '16:58:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1017, 'MANSUR BATIGIN, S.T', 'PENATA MUDA (III/a)', '198712052020121008', 'Analis Angkutan Darat', 'Lalu Lintas dan Angkutan', '07:00:00', '16:42:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1018, 'ADIB PRIYA MAHENDRA, S.ST (TD)', 'PENATA MUDA (III/a)', '199610062020121001 ', 'Pengawas dan Pembina Angkutan', 'Lalu Lintas dan Angkutan', '07:08:00', '16:34:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1019, 'ACHMAD HELFAN AMRI, SE', 'PENATA TINGKAT I (III/d )', '197009091992031009', 'Kepala Seksi Pengujian Sarana', 'Lalu Lintas dan Angkutan', '07:00:00', '16:41:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1020, 'JUNUS MARLESSY, S.Sos', 'PENATA (III/c)', '19720609 2006051002', 'Pengawas Pengujian Kendaraan Bermotor', 'Lalu Lintas dan Angkutan', '07:09:00', '16:56:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1021, 'RENALDI DWI SAPUTRO, A.Ma. PKB', 'PENGATUR (II/c)', '199504152017011001', 'Pengelola Pengujian Kendaraan', 'Lalu Lintas dan Angkutan', '07:18:00', '16:43:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1022, 'AGUSTINUS ELTON SESA, A.Ma. PKB', 'PENGATUR MUDA TINGKAT I (II/b)', '199308262018041001', 'Pengelola Perbengkelan dan Pengujian Kendaraan Bermotor', 'Lalu Lintas dan Angkutan', '07:25:00', '16:50:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1023, 'ACHMAD FARIS ZUBAIDI, A.Ma. PKB', 'PENGATUR (II/c)', '199507132017011001', 'Pengawas Pengujian Kendaraan Bermotor', 'Lalu Lintas dan Angkutan', '07:02:00', '16:51:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1024, 'WILSON GERALD FAIRIO, Amd.Kom', 'PENGATUR (II/c)', '198906032020121010', 'Pengelola Perbengkelan dan Pengujian Kendaraan Bermotor', 'Lalu Lintas dan Angkutan', '07:18:00', '16:32:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1025, 'YOHANIS HORIK, A.Md', 'PENGATUR (II/c)', '199101172020121007', 'Pengelola Perbengkelan dan Pengujian Kendaraan Bermotor', 'Lalu Lintas dan Angkutan', '07:12:00', '16:42:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1026, 'SAMSUDIN LA SITAMBAH,S.H.I.,M.Si', 'PENATA TINGKAT I (III/d)', '196611201992091001', 'Kepala Bidang Prasarana', 'Prasarana', '07:16:00', '16:53:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1027, 'SITTI HASANNOESI', 'PENATA TINGKAT I (III/d)', '196706011992032011', 'Kepala Seksi Perencanaan Prasarana', 'Prasarana', '07:14:00', '16:57:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1028, 'ARDI CAHYADI RAMLY, A.Md', 'PENATA MUDA (III/a)', '198201202011041001', 'Analis Rencana Induk Jaringan Transportasi Darat', 'Prasarana', '07:29:00', '16:55:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1029, 'F. LOYS PIAHAR', 'PENGATUR TK. I (II/d)', '197803012007011014', 'Analis Rencana Induk Jaringan Transportasi Darat', 'Prasarana', '07:17:00', '16:39:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1030, 'KRISTIANUS HINDOM, A.Md, IP', 'PENATA (III/c)', '197003281995031003', 'Analis Rencana Induk Jaringan Transportasi Darat', 'Prasarana', '07:08:00', '16:51:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1031, 'YUSLI ODENTEA', 'PENGATUR TINGKAT I (II/d)', '198610012006051001', 'Operator Terminal', 'Prasarana', '07:20:00', '16:46:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1032, 'CLEMENTINA HOMBA HOMBA, SE', 'PENATA TINGKAT I (III/d)', '196507112000122001', 'Kepala Seksi Pembangunan Prasarana', 'Prasarana', '07:23:00', '16:35:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1033, 'YOHAN A.T ARAGAY, SE', 'PENATA MUDA TK.I (III/b)', '197704262000121004', 'Pengembang Sarana Dan Prasarana', 'Prasarana', '07:21:00', '16:38:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1034, 'JOHN ANDERZON ASE, A.Md', 'PENATA MUDA TINGKAT I (III/b)', '198211042008011013', 'Teknisi Survey Jaringan Prasarana dan Pelayanan Transportasi Jalan', 'Prasarana', '07:23:00', '16:45:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1035, 'SHAFWAN BIN MOHAMMAD RUMAIN', 'PENGATUR TINGKAT I (II/d)', '197704222007011010', 'Pengelola Sistem Informasi Sarana dan Prasarana Jalan', 'Prasarana', '07:12:00', '16:56:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1036, 'IRMAWATI', 'PENATA TK. I (III/d)', '196904211992032010', 'Kepala Seksi Pengoperasian Prasarana', 'Prasarana', '07:04:00', '16:46:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1037, 'MUHAMMAD MAHDI SARIF', 'PENGATUR TINGKAT I (II/d)', '197010122006051003', 'Pengawas Angkutan dan Terminal', 'Prasarana', '07:19:00', '16:32:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1038, 'AMINUDIN TANGGAHMA', 'PENGATUR TINGKAT I (II/d)', '197702152007011015', 'Pengawas Angkutan dan Terminal', 'Prasarana', '07:26:00', '16:46:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1039, 'LA KARIM', 'PENGATUR TINGKAT I (II/d)', '197711292007011005', 'Pengelola Terminal', 'Prasarana', '07:21:00', '16:36:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1040, 'JAPARI BIARPRUGA, SE', 'PEMBINA (IV/a)', '197305092003121007', 'Kepala Bidang Pengembangan dan Keselamatan', 'Pengembangan dan Keselamatan', '07:15:00', '16:57:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1041, 'SAIFFUDIN SOEMARDI, S.Sos', 'PENATA TINGKAT I (III/d)', '197405202007011029', 'Kepala Seksi Pemanduan Moda dan Teknologi Perhubungan', 'Pengembangan dan Keselamatan', '07:18:00', '16:53:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1042, 'DEDY MALIK RUMAGESAN, S.ST', 'PENATA MUDA TINGKAT I (III/b)', '198512191005021001', 'Analis Rencana Umum Pemanduan Moda Transportasi Darat', 'Pengembangan dan Keselamatan', '07:02:00', '16:53:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1043, 'RIAN ERMAN SYAHYADI SARAGIH, S.T', 'PENATA MUDA (III/a)', '198910302020121011', 'Analis Rencana Umum Pemanduan Moda Transportasi Darat', 'Pengembangan dan Keselamatan', '07:21:00', '16:56:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1044, 'MUH. YUSFA YUSUF, S.Kel', 'PENATA MUDA (III/a)', '198701142021121001', 'Analis Rencana Umum Pemanduan Moda Transportasi Darat', 'Pengembangan dan Keselamatan', '07:06:00', '16:55:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1045, 'ELIZA DOMINGGUS RISAMBESSY', 'PENGATUR MUDA (II/a)', '197603192015101001', 'Penyurvei Pemanduan Moda', 'Pengembangan dan Keselamatan', '07:08:00', '16:49:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1046, 'LAZARUS KRISPUL, A.Md', 'PENATA TINGKAT I (III/d)', '196506241996101001', 'Kepala Seksi Lingkungan Perhubungan', 'Pengembangan dan Keselamatan', '07:12:00', '16:37:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1047, 'EDWIN SALAKAY, SE', 'PENATA MUDA TINGKAT I (III/b)', '197510032000121004', 'Analis Perhubungan dan Telekomunikasi', 'Pengembangan dan Keselamatan', '07:11:00', '16:44:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1048, 'NANI MADI, S.Sos', 'PENATA TINGKAT I (III/d)', '197505212006052001', 'Kepala Seksi Keselamatan', 'Pengembangan dan Keselamatan', '07:07:00', '16:59:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1049, 'SYAIDIN MERAM, SE', 'PENATA MUDA TINGKAT I (III/b)', '198402062007011006', 'Pemeriksa Keselamatan Darat', 'Pengembangan dan Keselamatan', '07:14:00', '16:46:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1050, 'FAHRUL SANI HUDA, A.Md', 'PENATA MUDA Tk.I (III/b)', '198506222009091001', 'Penelaah Audit Keselamatan Jalan', 'Pengembangan dan Keselamatan', '07:02:00', '16:31:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1051, 'DARWAN MERAM, A.Md', 'PENATA MUDA (III/a)', '198104292010041003', 'Pengawas Keselamatan Angkutan', 'Pengembangan dan Keselamatan', '07:06:00', '16:41:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1052, 'ABDUL MUTI RUMADAN', 'PENGATUR TK.I(II/d)', '197003062006051002', 'Pengelola Terminal', 'Prasarana', '07:17:00', '16:34:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1053, 'FARIDS FIRMANSYAH SUPARMAN', 'PENGATUR TINGKAT I (II/d)', '198405152007011006', 'Pengelola Sertifikasi Kompetensi Penilai Analisis Dampak Lalulintas', 'Prasarana', '07:17:00', '16:56:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1054, 'NURFIA SAMAY, S.ik', 'PENATA MUDA (III/a)', '199012302020122019', 'Pengawas Keselamatan Angkutan', 'Pengembangan dan Keselamatan', '07:15:00', '16:50:00', 'hadir', '2024-03-12', '2024-03-23 18:31:16'),
(1117, 'T. HERU USWANAS, S.Sos. M.Si', 'PEMBINA UTAMA MUDA (IV/c)', '196709041996101002', 'Kepala Dinas', 'Kepala Dinas', '07:23:00', '16:58:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1118, 'YAKOBUS TANDUNG PABIMBIN, S.T., M.Si', 'PEMBINA ( IV/a )', '197209162001111001', 'Sekertaris', 'Sekretariat', '07:30:00', '16:41:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1119, 'RISMAWATI AKATIAN, SE', 'PENATA TK. I (III/d )', '198309062009092003', 'Kepala Sub Bagian Umum', 'Sekretariat', '07:22:00', '16:58:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1120, 'HUSEIN PATTY, S.Sos', 'PENATA TK. I (III/d )', '197608032006051001', 'Pengadministrasi Umum', 'Sekretariat', '07:21:00', '16:39:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1121, 'AMELIA MADU, SE', 'PENATA MUDA (III/a)', '197903082015102001', 'Analis Tata Usaha', 'Sekretariat', '07:08:00', '16:38:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1122, 'MEGITA KRISTANTI TARUMASELE', 'PENGATUR MUDA (II/a)', '199905292020122003', 'Pengadministrasi Umum', 'Sekretariat', '07:03:00', '16:56:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1123, 'MUHAMAD RUMBAY, A.Md', 'PENATA MUDA Tk.I (III/b)', '197812012009091001', 'Pengelola Barang Milik Negara', 'Sekretariat', '07:07:00', '16:56:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1124, 'MARLON RESBAL', 'PENGATUR (II/c)', '198209202009041001', 'Pengelola Sarana Prasarana dan Rumah Tangga Dinas', 'Sekretariat', '07:24:00', '16:49:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1125, 'ENGGAR MASTUTI, SE. M.Si', 'PEMBINA ( IV/a )', '197505312007012013', 'Kepala Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat', '07:10:00', '16:34:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1126, 'SUMARDIN, SE', 'PENATA MUDA (III/a)', '198509162010011021', 'Bendahara', 'Sekretariat', '07:09:00', '16:43:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1127, 'RIZAL MINGGELE, S.T', 'PENATA TINGKAT I (III/d)', '198207012009091001', 'Penata Laporan Keuangan', 'Sekretariat', '07:16:00', '16:59:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1128, 'DAME BUNGARIA SIANIPAR, A.Md', 'PENATA MUDA TINGKAT I (III/b)', '197204242007012018', 'Penata Laporan Keuangan', 'Sekretariat', '07:25:00', '16:55:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1129, 'RINI JULIYANI, S.Si', 'PENATA MUDA (III/a)', '199006022020122019', 'Pengelola Pelaksanaan Program dan Anggaran', 'Sekretariat', '07:28:00', '16:33:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1130, 'SENEN SAGAS, SE', 'PENATA TINGKAT I (III/d)', '196705191998031005', 'Kepala Bidang Lalu Lintas dan Angkutan', 'Lalu Lintas dan Angkutan', '07:27:00', '16:39:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1131, 'AGUNAWAN S. BANDASO, S.T', 'PENATA MUDA TINGKAT 1 (III/b)', '198905012015061001', 'Kepala Seksi Lalu Lintas', 'Lalu Lintas dan Angkutan', '07:24:00', '16:37:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1132, 'VERY SAHETAPY, SE', 'PENATA MUDA TINGKAT I (III/b)', '197402272007011014', 'Pemeriksa Lalu Lintas Darat', 'Lalu Lintas dan Angkutan', '07:11:00', '16:39:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1133, 'DAVID JAKMANAM, A.Md', 'PENATA MUDA (III/a)', '198506162011041001', 'Pemeriksa Lalu Lintas Darat', 'Lalu Lintas dan Angkutan', '07:26:00', '16:52:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1134, 'LA MAJA BIARPRUGA, S.Si', 'PENATA MUDA (III/a)', '198707282020121008', 'Pemeriksa Lalu Lintas Darat', 'Lalu Lintas dan Angkutan', '07:04:00', '16:39:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1135, 'ALFI HTALA USWANAS, SE', 'PENATA MUDA (III/b)', '197802182008011011', 'Pengawas Lalu Lintas Darat', 'Lalu Lintas dan Angkutan', '07:13:00', '16:57:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1136, 'CHARLES SONNY TALLA', 'PENGATUR (II/c)', '198404112010011038', 'Pengawas Lalu Lintas Darat', 'Lalu Lintas dan Angkutan', '07:06:00', '16:38:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1137, 'SAFIJAN', 'PENGATUR MUDA TK. I (II/b)', '197309012008011010', 'Pengadministrasi LLAJ', 'Lalu Lintas dan Angkutan', '07:22:00', '16:57:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1138, 'JOSEP KABES, SH', 'PENATA (III/c)', '196505141985031004', 'Kepala Seksi Angkutan', 'Lalu Lintas dan Angkutan', '07:09:00', '16:32:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1139, 'SAMAD HEGEMUR, A.Md', 'PENATA MUDA (III/a)', '198311202010041001', 'Analis Angkutan Darat', 'Lalu Lintas dan Angkutan', '07:24:00', '16:52:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1140, 'LEIVINA PENTURY, A.Md. LLAJ', 'PENGATUR (II/c)', '199509282020122001', 'Analis Angkutan Darat', 'Lalu Lintas dan Angkutan', '07:01:00', '16:55:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1141, 'MANSUR BATIGIN, S.T', 'PENATA MUDA (III/a)', '198712052020121008', 'Analis Angkutan Darat', 'Lalu Lintas dan Angkutan', '07:15:00', '16:32:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1142, 'ADIB PRIYA MAHENDRA, S.ST (TD)', 'PENATA MUDA (III/a)', '199610062020121001 ', 'Pengawas dan Pembina Angkutan', 'Lalu Lintas dan Angkutan', '07:09:00', '16:50:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1143, 'ACHMAD HELFAN AMRI, SE', 'PENATA TINGKAT I (III/d )', '197009091992031009', 'Kepala Seksi Pengujian Sarana', 'Lalu Lintas dan Angkutan', '07:00:00', '16:53:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1144, 'JUNUS MARLESSY, S.Sos', 'PENATA (III/c)', '19720609 2006051002', 'Pengawas Pengujian Kendaraan Bermotor', 'Lalu Lintas dan Angkutan', '07:13:00', '16:38:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1145, 'RENALDI DWI SAPUTRO, A.Ma. PKB', 'PENGATUR (II/c)', '199504152017011001', 'Pengelola Pengujian Kendaraan', 'Lalu Lintas dan Angkutan', '07:18:00', '16:38:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1146, 'AGUSTINUS ELTON SESA, A.Ma. PKB', 'PENGATUR MUDA TINGKAT I (II/b)', '199308262018041001', 'Pengelola Perbengkelan dan Pengujian Kendaraan Bermotor', 'Lalu Lintas dan Angkutan', '07:15:00', '16:35:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1147, 'ACHMAD FARIS ZUBAIDI, A.Ma. PKB', 'PENGATUR (II/c)', '199507132017011001', 'Pengawas Pengujian Kendaraan Bermotor', 'Lalu Lintas dan Angkutan', '07:11:00', '16:47:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1148, 'WILSON GERALD FAIRIO, Amd.Kom', 'PENGATUR (II/c)', '198906032020121010', 'Pengelola Perbengkelan dan Pengujian Kendaraan Bermotor', 'Lalu Lintas dan Angkutan', '07:05:00', '16:38:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1149, 'YOHANIS HORIK, A.Md', 'PENGATUR (II/c)', '199101172020121007', 'Pengelola Perbengkelan dan Pengujian Kendaraan Bermotor', 'Lalu Lintas dan Angkutan', '07:18:00', '16:38:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1150, 'SAMSUDIN LA SITAMBAH,S.H.I.,M.Si', 'PENATA TINGKAT I (III/d)', '196611201992091001', 'Kepala Bidang Prasarana', 'Prasarana', '07:24:00', '16:32:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1151, 'SITTI HASANNOESI', 'PENATA TINGKAT I (III/d)', '196706011992032011', 'Kepala Seksi Perencanaan Prasarana', 'Prasarana', '07:07:00', '16:57:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1152, 'ARDI CAHYADI RAMLY, A.Md', 'PENATA MUDA (III/a)', '198201202011041001', 'Analis Rencana Induk Jaringan Transportasi Darat', 'Prasarana', '07:05:00', '16:58:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1153, 'F. LOYS PIAHAR', 'PENGATUR TK. I (II/d)', '197803012007011014', 'Analis Rencana Induk Jaringan Transportasi Darat', 'Prasarana', '07:13:00', '16:49:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1154, 'KRISTIANUS HINDOM, A.Md, IP', 'PENATA (III/c)', '197003281995031003', 'Analis Rencana Induk Jaringan Transportasi Darat', 'Prasarana', '07:25:00', '16:38:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1155, 'YUSLI ODENTEA', 'PENGATUR TINGKAT I (II/d)', '198610012006051001', 'Operator Terminal', 'Prasarana', '07:21:00', '16:36:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1156, 'CLEMENTINA HOMBA HOMBA, SE', 'PENATA TINGKAT I (III/d)', '196507112000122001', 'Kepala Seksi Pembangunan Prasarana', 'Prasarana', '07:07:00', '16:57:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1157, 'YOHAN A.T ARAGAY, SE', 'PENATA MUDA TK.I (III/b)', '197704262000121004', 'Pengembang Sarana Dan Prasarana', 'Prasarana', '07:04:00', '16:43:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1158, 'JOHN ANDERZON ASE, A.Md', 'PENATA MUDA TINGKAT I (III/b)', '198211042008011013', 'Teknisi Survey Jaringan Prasarana dan Pelayanan Transportasi Jalan', 'Prasarana', '07:29:00', '16:33:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1159, 'SHAFWAN BIN MOHAMMAD RUMAIN', 'PENGATUR TINGKAT I (II/d)', '197704222007011010', 'Pengelola Sistem Informasi Sarana dan Prasarana Jalan', 'Prasarana', '07:24:00', '16:37:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1160, 'IRMAWATI', 'PENATA TK. I (III/d)', '196904211992032010', 'Kepala Seksi Pengoperasian Prasarana', 'Prasarana', '07:16:00', '16:53:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1161, 'MUHAMMAD MAHDI SARIF', 'PENGATUR TINGKAT I (II/d)', '197010122006051003', 'Pengawas Angkutan dan Terminal', 'Prasarana', '07:11:00', '16:51:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1162, 'AMINUDIN TANGGAHMA', 'PENGATUR TINGKAT I (II/d)', '197702152007011015', 'Pengawas Angkutan dan Terminal', 'Prasarana', '07:22:00', '16:50:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1163, 'LA KARIM', 'PENGATUR TINGKAT I (II/d)', '197711292007011005', 'Pengelola Terminal', 'Prasarana', '07:29:00', '16:37:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1164, 'JAPARI BIARPRUGA, SE', 'PEMBINA (IV/a)', '197305092003121007', 'Kepala Bidang Pengembangan dan Keselamatan', 'Pengembangan dan Keselamatan', '07:18:00', '16:54:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1165, 'SAIFFUDIN SOEMARDI, S.Sos', 'PENATA TINGKAT I (III/d)', '197405202007011029', 'Kepala Seksi Pemanduan Moda dan Teknologi Perhubungan', 'Pengembangan dan Keselamatan', '07:13:00', '16:49:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1166, 'DEDY MALIK RUMAGESAN, S.ST', 'PENATA MUDA TINGKAT I (III/b)', '198512191005021001', 'Analis Rencana Umum Pemanduan Moda Transportasi Darat', 'Pengembangan dan Keselamatan', '07:04:00', '16:31:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1167, 'RIAN ERMAN SYAHYADI SARAGIH, S.T', 'PENATA MUDA (III/a)', '198910302020121011', 'Analis Rencana Umum Pemanduan Moda Transportasi Darat', 'Pengembangan dan Keselamatan', '07:00:00', '16:53:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1168, 'MUH. YUSFA YUSUF, S.Kel', 'PENATA MUDA (III/a)', '198701142021121001', 'Analis Rencana Umum Pemanduan Moda Transportasi Darat', 'Pengembangan dan Keselamatan', '07:15:00', '16:43:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1169, 'ELIZA DOMINGGUS RISAMBESSY', 'PENGATUR MUDA (II/a)', '197603192015101001', 'Penyurvei Pemanduan Moda', 'Pengembangan dan Keselamatan', '07:10:00', '16:52:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1170, 'LAZARUS KRISPUL, A.Md', 'PENATA TINGKAT I (III/d)', '196506241996101001', 'Kepala Seksi Lingkungan Perhubungan', 'Pengembangan dan Keselamatan', '07:23:00', '16:55:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1171, 'EDWIN SALAKAY, SE', 'PENATA MUDA TINGKAT I (III/b)', '197510032000121004', 'Analis Perhubungan dan Telekomunikasi', 'Pengembangan dan Keselamatan', '07:04:00', '16:32:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1172, 'NANI MADI, S.Sos', 'PENATA TINGKAT I (III/d)', '197505212006052001', 'Kepala Seksi Keselamatan', 'Pengembangan dan Keselamatan', '07:07:00', '16:35:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1173, 'SYAIDIN MERAM, SE', 'PENATA MUDA TINGKAT I (III/b)', '198402062007011006', 'Pemeriksa Keselamatan Darat', 'Pengembangan dan Keselamatan', '07:17:00', '16:35:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1174, 'FAHRUL SANI HUDA, A.Md', 'PENATA MUDA Tk.I (III/b)', '198506222009091001', 'Penelaah Audit Keselamatan Jalan', 'Pengembangan dan Keselamatan', '07:26:00', '16:39:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1175, 'DARWAN MERAM, A.Md', 'PENATA MUDA (III/a)', '198104292010041003', 'Pengawas Keselamatan Angkutan', 'Pengembangan dan Keselamatan', '07:21:00', '16:58:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1176, 'ABDUL MUTI RUMADAN', 'PENGATUR TK.I(II/d)', '197003062006051002', 'Pengelola Terminal', 'Prasarana', '07:25:00', '16:31:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1177, 'FARIDS FIRMANSYAH SUPARMAN', 'PENGATUR TINGKAT I (II/d)', '198405152007011006', 'Pengelola Sertifikasi Kompetensi Penilai Analisis Dampak Lalulintas', 'Prasarana', '07:02:00', '16:44:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1178, 'NURFIA SAMAY, S.ik', 'PENATA MUDA (III/a)', '199012302020122019', 'Pengawas Keselamatan Angkutan', 'Pengembangan dan Keselamatan', '07:00:00', '16:52:00', 'hadir', '2024-03-25', '2024-03-25 12:39:56'),
(1241, 'T. HERU USWANAS, S.Sos. M.Si', 'PEMBINA UTAMA MUDA (IV/c)', '196709041996101002', 'Kepala Dinas', 'Kepala Dinas', '07:02:00', '16:35:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1242, 'TEGUH SUGIHARTO, S.T', 'PEMBINA TK I (IV/b)', '197011141997121001', 'Sekertaris', 'Sekretariat', '07:07:00', '16:42:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1243, 'RISMAWATI AKATIAN, SE', 'PENATA TK. I (III/d )', '198309062009092003', 'Kepala Sub Bagian Umum', 'Sekretariat', '07:18:00', '16:30:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1244, 'ENGGAR MASTUTI, SE. M.Si', 'PEMBINA ( IV/a )', '197505312007012013', 'Kepala Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat', '07:12:00', '16:49:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1245, 'SENEN SAGAS, SE', 'PEMBINA  (IV/a)', '196705191998031005', 'Kepala Bidang Lalu Lintas dan Angkutan', 'Lalu Lintas dan Angkutan', '07:30:00', '16:39:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1246, 'SITI FITRIAH USWANAS, ST.M.S.P', 'PENATA TK. I (III/d)', '198307162011042001', 'Kepala Seksi Lalu Lintas', 'Lalu Lintas dan Angkutan', '07:07:00', '16:50:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1247, 'HUSEIN PATTY, S.Sos', 'PENATA TK. I (III/d )', '197608032006051001', 'Kepala Seksi Angkutan', 'Lalu Lintas dan Angkutan', '07:11:00', '16:55:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1248, 'ACHMAD HELFAN AMRI, SE', 'PENATA TINGKAT I (III/d )', '197009091992031009', 'Kepala Seksi Pengujian Sarana', 'Lalu Lintas dan Angkutan', '07:22:00', '16:43:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1249, 'SAIFFUDIN SOEMARDI, S.Sos', 'PENATA TINGKAT I (III/d)', '197405202007011029', 'Kepala Bidang Prasarana', 'Prasarana', '07:30:00', '16:44:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1250, 'SITTI HASANNOESI', 'PENATA TINGKAT I (III/d)', '196706011992032011', 'Kepala Seksi Perencanaan Prasarana', 'Prasarana', '07:23:00', '16:51:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1251, 'CLEMENTINA HOMBA HOMBA, SE', 'PENATA TINGKAT I (III/d)', '196507112000122001', 'Kepala Seksi Pembangunan Prasarana', 'Prasarana', '07:06:00', '16:54:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1252, 'IRMAWATI', 'PENATA TK. I (III/d)', '196904211992032010', 'Kepala Seksi Pengoperasian Prasarana', 'Prasarana', '07:00:00', '16:48:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1253, 'JAPARI BIARPRUGA, SE', 'PEMBINA (IV/a)', '197305092003121007', 'Kepala Bidang Pengembangan dan Keselamatan', 'Pengembangan dan Keselamatan', '07:17:00', '16:51:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1254, 'DEDY MALIK RUMAGESAN, S.ST(TD)', 'PENATA (III/c)', '198512192005021001', 'Kepala Seksi Pemanduan Moda dan Teknologi Perhubungan', 'Pengembangan dan Keselamatan', '07:26:00', '16:30:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1255, 'YOHAN A.T ARAGAY, SE', 'PENATA (III/c)', '197704262000121004', 'Kepala Seksi Lingkungan Perhubungan', 'Pengembangan dan Keselamatan', '07:12:00', '16:54:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1256, 'NANI MADI, S.Sos', 'PENATA TINGKAT I (III/d)', '197505212006052001', 'Kepala Seksi Keselamatan', 'Pengembangan dan Keselamatan', '07:08:00', '16:44:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1257, 'HARSINI ELEUWARIN, S.Sos', 'PENATA (III/c)', '198203202009042001', 'Pengadministrasi Umum', 'Sekretariat', '07:13:00', '16:33:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1258, 'MUHAMAD RUMBAY, A.Md', 'PENATA MUDA Tk.I (III/b)', '197812012009091001', 'Pengelola Barang Milik Negara', 'Sekretariat', '07:28:00', '16:34:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1259, 'MARLON RESBAL', 'PENGATUR (II/c)', '198209202009041001', 'Pengelola Sarana Prasarana dan Rumah Tangga Dinas', 'Sekretariat', '07:05:00', '16:36:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1260, 'SUMARDIN, SE', 'PENATA MUDA (III/a)', '198509162010011021', 'Bendahara', 'Sekretariat', '07:10:00', '16:35:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1261, 'FAHRUL SANI HUDA, A.Md', 'PENATA MUDA Tk.I (III/b)', '198506222009091001', 'Penata Laporan Keuangan', 'Sekretariat', '07:05:00', '16:34:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1262, 'AMELIA MADU, SE', 'PENATA MUDA (III/a)', '197903082015102001', 'Pengelola Program dan Laporan', 'Sekretariat', '07:29:00', '16:58:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1263, 'RINI JULIYANI, S.Si', 'PENATA MUDA (III/a)', '199006022020122019', 'Pengelola Pelaksanaan Program dan Anggaran', 'Sekretariat', '07:24:00', '16:55:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1264, 'MEGITA KRISTANTI TARUMASELE', 'PENGATUR MUDA (II/a)', '199905292020122003', 'Pembantu Bendahara Pengeluaran', 'Sekretariat', '07:14:00', '16:52:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1265, 'VERY SAHETAPY, SE', 'PENATA MUDA TINGKAT I (III/b)', '197402272007011014', 'Pemeriksa Lalu Lintas Darat', 'Lalu Lintas dan Angkutan', '07:14:00', '16:58:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1266, 'DAVID JAKMANAM, A.Md', 'PENATA MUDA TK. I (III/b)', '198506162011041001', 'Pemeriksa Lalu Lintas Darat', 'Lalu Lintas dan Angkutan', '07:20:00', '16:38:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1267, 'ALFI HTALA USWANAS, SE', 'PENATA MUDA TK.I (III/b)', '197802182008011011', 'Pengawas Lalu Lintas Darat', 'Lalu Lintas dan Angkutan', '07:03:00', '16:37:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1268, 'BENEDIKTA SEPSIA YULIANI, A.Md. Tra', 'PENGATUR (II/c)', '200009172022072001', 'Pengadministrasi LLAJ', 'Lalu Lintas dan Angkutan', '07:10:00', '16:36:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1269, 'SAFIJAN', 'PENGATUR  (II/c)', '197309012008011010', 'Pengadministrasi LLAJ', 'Lalu Lintas dan Angkutan', '07:26:00', '16:46:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1270, 'SAMAD HEGEMUR, A.Md', 'PENATA MUDA TK. I (III/b)', '198311202010041001', 'Analis Angkutan Darat', 'Lalu Lintas dan Angkutan', '07:16:00', '16:35:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1271, 'MANSUR BATIGIN, S.T', 'PENATA MUDA (III/a)', '198712052020121008', 'Analis Angkutan Darat', 'Lalu Lintas dan Angkutan', '07:07:00', '16:44:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1272, 'ADIB PRIYA MAHENDRA, S.ST (TD)', 'PENATA MUDA (III/a)', '199610062020121001', 'Pengawas dan Pembina Angkutan', 'Lalu Lintas dan Angkutan', '07:16:00', '16:58:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1273, 'LEIVINA PENTURY, A.Md. LLAJ', 'PENGATUR (II/c)', '199509282020122001', 'Analis Angkutan Darat', 'Lalu Lintas dan Angkutan', '07:01:00', '16:46:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1274, 'ELVIRA AZIZAH, A.Md. Tra', 'PENGATUR (II/c)', '200007072022072001', 'Analis Angkutan Darat', 'Lalu Lintas dan Angkutan', '07:05:00', '16:38:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1275, 'JUNUS MARLESSY, S.Sos', 'PENATA TK. I (III/d)', '197206092006051002', 'Pengawas Pengujian Kendaraan Bermotor', 'Lalu Lintas dan Angkutan', '07:08:00', '16:49:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1276, 'ACHMAD FARIS ZUBAIDI, A.Ma. PKB', 'PENGATUR (II/c)', '199507132017011001', 'Pengawas Pengujian Kendaraan Bermotor', 'Lalu Lintas dan Angkutan', '07:21:00', '16:30:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1277, 'RENALDI DWI SAPUTRO, SE', 'PENATA MUDA (III/a)', '199504152017011001', 'Pengelola Pengujian Kendaraan', 'Lalu Lintas dan Angkutan', '07:11:00', '16:44:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1278, 'WILSON GERALD FAIRIO, Amd.Kom', 'PENGATUR (II/c)', '198906032020121010', 'Pengelola Pengujian Kendaraan', 'Lalu Lintas dan Angkutan', '07:08:00', '16:34:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1279, 'AGUSTINUS ELTON SESA, S.AP', 'PENATA MUDA (III/a)', '199308262018041001', 'Pengelola Perbengkelan dan Pengujian Kendaraan Bermotor', 'Lalu Lintas dan Angkutan', '07:27:00', '16:50:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1280, 'YOHANIS HORIK, A.Md', 'PENGATUR (II/c)', '199101172020121007', 'Pengelola Perbengkelan dan Pengujian Kendaraan Bermotor', 'Lalu Lintas dan Angkutan', '07:25:00', '16:49:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1281, 'ARDI CAHYADI RAMLY, A.Md', 'PENATA MUDA TK. I (III/b)', '198201202011041001', 'Analis Rencana Induk Jaringan Transportasi Darat', 'Prasarana', '07:19:00', '16:46:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1282, 'F. LOYS PIAHAR', 'PENATA MUDA (III/a)', '197803012007011014', 'Analis Rencana Induk Jaringan Transportasi Darat', 'Prasarana', '07:18:00', '16:47:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1283, 'KRISTIANUS HINDOM, A.Md, IP', 'PENATA (III/c)', '197003281995031003', 'Analis Rencana Induk Jaringan Transportasi Darat', 'Prasarana', '07:02:00', '16:37:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1284, 'YUSLI ODENTEA', 'PENATA MUDA (III/a)', '198610012006051001', 'Operator Terminal', 'Prasarana', '07:30:00', '16:32:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1285, 'JOHN ANDERZON ASE, A.Md', 'PENATA MUDA TINGKAT I (III/b)', '198211042008011013', 'Teknisi Survey Jaringan Prasarana dan Pelayanan Transportasi Jalan', 'Prasarana', '07:09:00', '16:31:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1286, 'SHAFWAN BIN MOHAMMAD RUMAIN', 'PENATA MUDA (III/a)', '197704222007011010', 'Pengelola Sistem Informasi Sarana dan Prasarana Jalan', 'Prasarana', '07:12:00', '16:53:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1287, 'NUR HUWAIDA ALYSSA PUTRI, A.Md.Tra', 'PENGATUR (II/c)', '200011112023022003', 'Teknisi Survey Jaringan Prasarana dan Pelayanan Transportasi Jalan', 'Prasarana', '07:16:00', '16:43:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1288, 'VISCA PRICELLA, A.Md.Tra', 'PENGATUR (II/c)', '200004012023022002', 'Teknisi Survey Jaringan Prasarana dan Pelayanan Transportasi Jalan', 'Prasarana', '07:08:00', '16:54:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1289, 'ABDUL MUTI RUMADAN', 'PENATA MUDA (III/a)', '197003062006051002', 'Pengawas Angkutan dan Terminal', 'Prasarana', '07:14:00', '16:36:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1290, 'LA KARIM', 'PENATA MUDA (III/a)', '197711292007011005', 'Pengawas Angkutan dan Terminal', 'Prasarana', '07:07:00', '16:52:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1291, 'FARIDS FIRMANSYAH SUPARMAN', 'PENATA MUDA (III/a)', '198405152007011006', 'Pengawas Angkutan dan Terminal', 'Prasarana', '07:29:00', '16:53:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1292, 'AMINUDIN TANGGAHMA', 'PENATA MUDA (III/a)', '197702152007011015', 'Pengawas Angkutan dan Terminal', 'Prasarana', '07:08:00', '16:42:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1293, 'MUHAMMAD MAHDI SARIF', 'PENATA MUDA (III/a)', '197010122006051003', 'Pengawas Angkutan dan Terminal', 'Prasarana', '07:23:00', '16:54:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1294, 'RIAN ERMAN SYAHYADI SARAGIH, S.ST', 'PENATA MUDA (III/a)', '198910302020121011', 'Analis Rencana Umum Pemanduan Moda Transportasi Darat', 'Pengembangan dan Keselamatan', '07:08:00', '16:35:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1295, 'MUH. YUSFA YUSUF, S.Kel', 'PENATA MUDA (III/a)', '198701142021121001', 'Analis Rencana Umum Pemanduan Moda Transportasi Darat', 'Pengembangan dan Keselamatan', '07:14:00', '16:39:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1296, 'AMRIZAL RUMASUKUN, A.Md. Tra', 'PENGATUR (II/c)', '199904032022071001', 'Analis Rencana Umum Pemanduan Moda Transportasi Darat', 'Pengembangan dan Keselamatan', '07:00:00', '16:55:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1297, 'ELIZA DOMINGGUS RISAMBESSY', 'PENGATUR (II/c)', '197603192015101001', 'Penyurvei Pemanduan Moda', 'Pengembangan dan Keselamatan', '07:10:00', '16:45:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1298, 'CHARLES SONNY TALLA', 'PENGATUR TK. I (II/d)', '198404112010011038', 'Juru Pungut Retribusi', 'Pengembangan dan Keselamatan', '07:22:00', '16:43:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1299, 'ADE IMAM PRADA S.Tr.Tra', 'PENATA MUDA (III/a)', '200012022023021006', 'Analis Perhubungan dan Telekomunikasi', 'Pengembangan dan Keselamatan', '07:17:00', '16:44:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1300, 'SYAIDIN MERAM, SE', 'PENATA (III/c)', '198402062007011006', 'Pemeriksa Keselamatan Darat', 'Pengembangan dan Keselamatan', '07:13:00', '16:43:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1301, 'DAME BUNGARIA SIANIPAR, A.Md', 'PENATA (III/c)', '197204242007012018', 'Penelaah Audit Keselamatan Jalan', 'Pengembangan dan Keselamatan', '07:15:00', '16:51:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53'),
(1302, 'DARWAN MERAM, A.Md', 'PENATA MUDA Tk.I (III/b)', '198104292010041003', 'Pengawas Keselamatan Angkutan', 'Pengembangan dan Keselamatan', '07:29:00', '16:37:00', 'hadir', '2025-03-14', '2025-03-14 05:12:53');

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
-- Struktur dari tabel `seksi`
--

CREATE TABLE `seksi` (
  `id` int NOT NULL,
  `nama_seksi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bidang` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `seksi`
--

INSERT INTO `seksi` (`id`, `nama_seksi`, `bidang`) VALUES
(1, 'Kepala Dinas', 'Kepala Dinas'),
(2, 'Sekertaris', 'Sekretariat'),
(3, 'Sub Bagian Umum', 'Sekretariat'),
(4, 'Sub Bagian Perencanaan dan Pelaporan', 'Sekretariat'),
(5, 'Bidang Lalu Lintas dan Angkutan', 'Lalu Lintas dan Angkutan'),
(6, 'Seksi Lalu Lintas', 'Lalu Lintas dan Angkutan'),
(7, 'Seksi Angkutan', 'Lalu Lintas dan Angkutan'),
(8, 'Seksi Pengujian Sarana', 'Lalu Lintas dan Angkutan'),
(10, 'Bidang Prasarana', 'Prasarana'),
(11, 'Seksi Perencanaan Prasarana', 'Prasarana'),
(12, 'Seksi Pembangunan Prasarana', 'Prasarana'),
(13, 'Seksi Pengoperasian Prasarana', 'Prasarana'),
(14, 'Bidang Pengembangan dan Keselamatan', 'Pengembangan dan Keselamatan'),
(15, 'Seksi Pemanduan Moda dan Teknologi Perhubungan', 'Pengembangan dan Keselamatan'),
(16, 'Seksi Lingkungan Perhubungan', 'Pengembangan dan Keselamatan'),
(17, 'Seksi Keselamatan  ', 'Pengembangan dan Keselamatan'),
(18, 'UPTD Pengujian Kendaraan Bermotor', 'UPTD Pengujian Kendaraan Bermotor'),
(19, 'Sub Bagian Tata Usaha UPTD Pengujian Kendaraan Bermotor', 'UPTD Pengujian Kendaraan Bermotor'),
(20, 'Penguji Kendaraan Bermotor', 'UPTD Pengujian Kendaraan Bermotor'),
(21, 'Seksi Pengelolan Perparkiran', 'Prasarana');

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

--
-- Dumping data untuk tabel `suratmenyurat`
--

INSERT INTO `suratmenyurat` (`id`, `nomor_surat`, `tanggal`, `pengirim`, `penerima`, `subjek`, `isi`, `status`, `file_google_drive`) VALUES
(4, 'asawdad', '2024-03-12', 'Kepala Dinas', 'Kabag Umum', 'Mutasi', 'azas', 'Sent', 'https://drive.google.com/file/d/16cKbpO7iwuse2LP73tGvU55m9TjdAEGN/view?usp=drive_link'),
(5, '123/2312/asasa/2024', '2024-03-12', 'Kepala Dinas', 'Kabag Umum', 'Mutasi', 'asad', 'Sent', 'https://drive.google.com/file/d/16RHCzs7w6OXHlfGo5siJ3k-D1WJAskO-/view?usp=drive_link'),
(6, '2515/adafsd/2024', '2024-03-23', 'Kepala Dinas', 'Kepala Bidang Lalu Lintas', 'Pengadaan Bus', '3 Unit', 'Draft', 'https://drive.google.com/file/d/16Unc3bAQkOeIGzBXAH2zY7KMJ1DVK3vc/view?usp=drive_link'),
(7, '5615651/adakah/2024', '2024-11-20', 'Kepala Dinas', 'Wilson', 'Kenaikan Pangkat', 'setujui', 'Draft', 'https://drive.google.com/file/d/16RHeDex6OihlLZeBafcS_USF6zl2Jtct/view?usp=drive_link'),
(8, '621551/watpad/2024', '2024-11-20', 'Kepala Dinas', 'Horik', 'Naik Pangkat', 'ACC bossqueh', 'Draft', 'https://drive.google.com/file/d/16RHCzs7w6OXHlfGo5siJ3k-D1WJAskO-/view?usp=drive_link');

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

--
-- Dumping data untuk tabel `terminal`
--

INSERT INTO `terminal` (`id`, `lokasi`, `alamat`, `keterangan`, `foto`) VALUES
(2, 'Terminal Sebrang', 'Jl. Sebrang', 'Trayek E', 0x6173736574732f696d672f7465726d696e616c2f5465726d696e616c2053656272616e672e6a7067),
(5, 'Terminal Kokas', 'Jl. Kokas', 'Trayek D', 0x6173736574732f696d672f7465726d696e616c2f5465726d696e616c204b6f6b61732e6a7067),
(6, 'Terminal Bomberai', 'Jl. Bomberai Raya', 'Distrik Transmigrasi', 0x6173736574732f696d672f7465726d696e616c2f5465726d696e616c20426f6d62657261692e6a7067),
(7, 'Terminal Wartutin', 'Wartutin', 'Terminal Bandara', 0x6173736574732f696d672f7465726d696e616c2f5465726d696e616c20576172747574696e2e6a7067),
(8, 'Terminal Torea', 'Dulan Pokpok', 'Trayek C', 0x6173736574732f696d672f7465726d696e616c2f5465726d696e616c20546f7265612e6a7067),
(9, 'Terminal Thumburuni', 'Thumburuni', 'Trayek C', 0x6173736574732f696d672f7465726d696e616c2f5465726d696e616c205468756d627572756e692e6a7067),
(23, 'Terminal Puncak', 'Jl. Fakfak - Kokas', 'Trayek D', 0x5465726d696e616c2050756e63616b2e6a7067);

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

--
-- Dumping data untuk tabel `testimoni_home`
--

INSERT INTO `testimoni_home` (`id`, `nama`, `jabatan`, `keterangan`, `foto`) VALUES
(1, 'T. Heru Uswanas, S.Sos. M.Si', 'Kepala Dinas Perhubungan', 'Meningkatkan kualitas pelayanan publik di bidang perhubungan adalah tanggung jawab utama saya. Saya berkomitmen untuk memberikan pelayanan yang mudah, cepat, dan transparan kepada masyarakat', 'T. Heru Uswanas, S.Sos. M.Si_trainer-1.jpg'),
(2, 'Japari Biarpruga, S. E', 'Kepala Bidang Pengembangan dan Keselamatan', 'Saya bertanggung jawab untuk mengembangkan dan merumuskan kebijakan di bidang keselamatan dan keamanan transportasi. Saya akan memastikan bahwa kebijakan tersebut selaras dengan kebutuhan masyarakat dan perkembangan teknologi', 'Japari Biarpruga, S. E_trainer-2.jpg'),
(4, 'Syaidin Meram, S. E', 'Pemeriksa Keselamatan Darat', 'Tugas saya adalah memastikan bahwa semua kendaraan yang beroperasi di Kabupaten Fakfak laik jalan dan memenuhi standar keselamatan', 'Syaidin Meram, S. E_trainer-3.jpg');

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

--
-- Dumping data untuk tabel `testimoni_pegawai`
--

INSERT INTO `testimoni_pegawai` (`id`, `nama`, `jabatan`, `keterangan`, `foto`) VALUES
(1, 'T. Heru Uswanas, S.Sos. M.Si', 'Kepala Dinas Perhubungan', 'Mari terus berinovasi dan tingkatkan pelayanan publik! Buktikan bahwa Dinas Perhubungan Kabupaten Fakfak mampu memberikan pelayanan terbaik bagi masyarakat. Ingat, fokus utama kita adalah keselamatan dan kenyamanan masyarakat dalam bertransportasi', 'T. Heru Uswanas, S.Sos. M.Si_team-1.jpg'),
(2, 'Teguh Sugiharto, S. T', 'Sekertaris', 'Kerja sama dan koordinasi adalah kunci kelancaran tugas kita. Mari saling bahu-membahu dan teruslah bersemangat dalam memberikan pelayanan terbaik bagi masyarakat. Semangat pagi!', 'Teguh Sugiharto, S. T_team-2.jpg'),
(3, 'Rismawati Akatian, SE', 'Kepala Sub Bagian Umum', 'Mari kita jaga dan kelola aset-aset Dinas Perhubungan dengan baik. Ingat, aset-aset ini adalah milik bersama dan harus digunakan untuk kepentingan masyarakat. Semangat!', 'Rismawati Akatian, SE_team-3.jpg'),
(4, 'Senin Sagas, SE', 'Kepala Bidang Lalu Lintas dan Angkutan', 'Mari kita ciptakan lalu lintas yang aman dan nyaman di Kabupaten Fakfak. Tertiblah dalam berkendara dan patuhi peraturan lalu lintas. Keselamatan di jalan raya adalah tanggung jawab kita bersama', 'Senin Sagas, SE_team-4.jpg'),
(5, 'Saiffudin Soemardi, S. Sos', 'Kepala Bidang Prasarana', 'Mari kita bangun infrastruktur transportasi yang berkualitas di Kabupaten Fakfak. Infrastruktur yang baik akan meningkatkan mobilitas masyarakat dan mendorong pertumbuhan ekonomi daerah. Bekerjalah dengan penuh dedikasi dan integritas', 'Saiffudin Soemardi, S. Sos_team-5.jpg'),
(6, 'Japari Biarpruga, S. E', 'Kepala Bidang Pengembangan dan Keselamatan', 'Mari kita tingkatkan keselamatan transportasi di Kabupaten Fakfak. Lakukan edukasi dan sosialisasi kepada masyarakat tentang pentingnya keselamatan berkendara. Bersama-sama, kita ciptakan budaya tertib dan disiplin di jalan raya', 'Japari Biarpruga, S. E_team-6.jpg');

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

--
-- Dumping data untuk tabel `testimoni_pelayanan`
--

INSERT INTO `testimoni_pelayanan` (`id`, `sebutan`, `harga`, `nama`, `keterangan`, `pejabat`, `foto`, `gambar`) VALUES
(3, 'Kir', 150000, 'Pengujian Kendaraan Bermotor', 'Memberikan jaminan keselamatan secara teknis terhadap penggunaan kendaraan bermotor.', 'Achmad Helfan Amry, SE', 'Pengujian Kendaraan Bermotor.jpg', 0x50656e67756a69616e204b656e64617261616e204265726d6f746f722e6a7067),
(4, 'Parkir', 3000, 'Perparikran', 'Fasilitas parkir bertujuan untuk memberikan tempat istirahat kendaraan dan menunjang kelancaran arus lalu lintas.', 'Saiffudin Soemardi, S.Sos', 'Perparikran.jpg', 0x506572706172696b72616e2e6a7067),
(5, 'Terminal', 2000, 'Terminal', 'Terminal Penumpang merupakan pedoman bagi penyelenggara terminal angkutan jalan dalam memberikan pelayanan jasa kepada seluruh pengguna.', 'Japari Biarpuga, SE', 'Terminal_trainer-3-2.jpg', 0x4a61706172692042696172707567612c2053455f636f757273652d332e6a7067);

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

--
-- Dumping data untuk tabel `testimoni_sistem`
--

INSERT INTO `testimoni_sistem` (`id`, `nama`, `jabatan`, `keterangan`, `foto`) VALUES
(1, 'T. Heru Uswanas, S.Sos. M.Si', 'Kepala Dinas Perhubungan', 'Di era digital ini, transformasi layanan publik menjadi sebuah keniscayaan. Sistem informasi yang terintegrasi dan mudah diakses merupakan kunci untuk mewujudkan pelayanan maksimal kepada masyarakat.', 'T. Heru Uswanas, S.Sos. M.Si_testimonials-1.jpg'),
(2, 'Teguh Sugiharto, S. T', 'Sekertaris', 'Sistem informasi yang handal dan terstruktur akan mendukung kelancaran tugas dan fungsi seluruh bidang di Dinas Perhubungan. Integrasi data dan informasi akan mempermudah koordinasi dan kolaborasi antar bidang.', 'Teguh Sugiharto, S. T_testimonials-2.jpg'),
(3, 'Senin Sagas, SE', 'Kepala Bidang Lalu Lintas dan Angkutan', 'Pemanfaatan teknologi informasi akan mendukung upaya penertiban dan penindakan pelanggaran lalu lintas, serta meningkatkan keselamatan dan keamanan di jalan raya.', 'Senin Sagas, SE_testimonials-3.jpg'),
(4, 'Saiffudin Soemardi, S. Sos', 'Kepala Bidang Prasarana', 'Masyarakat dapat memantau perkembangan pembangunan dan kondisi prasarana perhubungan secara real-time melalui sistem informasi yang transparan.', 'Saiffudin Soemardi, S. Sos_testimonials-4.jpg'),
(5, 'Japari Biarpruga, S. E', 'Kepala Bidang Pengembangan dan Keselamatan', 'Sistem informasi yang komprehensif akan membantu dalam merumuskan kebijakan dan program pengembangan di bidang perhubungan yang tepat sasaran.', 'Japari Biarpruga, S. E_testimonials-5.jpg');

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
-- Dumping data untuk tabel `video_cctv`
--

INSERT INTO `video_cctv` (`id`, `lokasi`, `link_embed`) VALUES
(1, 'Lokasi 1', 'https://pafakfak.cctvbadilag2.my.id/402902PAFAKFAK/play.html?name=461300353505477167188420'),
(2, 'Lokasi 2', 'https://www.youtube.com/embed/munLLWuVsLc?si=jLXj7MA0GSqpJAmv'),
(3, 'Lokasi 3', 'https://www.youtube.com/embed/utV8wPiR2GQ'),
(4, 'Lokasi 4', 'https://pafakfak.cctvbadilag2.my.id/402902PAFAKFAK/play.html?name=621067841927225613440010'),
(5, 'Lokasi 5', 'https://server.cctvbadilag.my.id/663712DITJENBADILAG/play.html?name=065100049927742715620154'),
(6, 'Lokasi 6', 'https://www.youtube.com/embed/uo3NOY'),
(9, 'Lokasi 7', 'https://www.youtube.com/embed/munLLWuVsLc?si=jLXj7MA0GSqpJAmv');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT untuk tabel `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT untuk tabel `kendaraan_keluar`
--
ALTER TABLE `kendaraan_keluar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `kendaraan_masuk`
--
ALTER TABLE `kendaraan_masuk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `laporan_parkir`
--
ALTER TABLE `laporan_parkir`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

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
-- AUTO_INCREMENT untuk tabel `parkir`
--
ALTER TABLE `parkir`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT untuk tabel `pelayananumum`
--
ALTER TABLE `pelayananumum`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pelayanan_kantor`
--
ALTER TABLE `pelayanan_kantor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengawasan`
--
ALTER TABLE `pengawasan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pengelolaan`
--
ALTER TABLE `pengelolaan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `petugas_parkir`
--
ALTER TABLE `petugas_parkir`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `riwayat_absensi`
--
ALTER TABLE `riwayat_absensi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1303;

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
-- AUTO_INCREMENT untuk tabel `seksi`
--
ALTER TABLE `seksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `suratmenyurat`
--
ALTER TABLE `suratmenyurat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `terminal`
--
ALTER TABLE `terminal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `testimoni_home`
--
ALTER TABLE `testimoni_home`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `testimoni_pegawai`
--
ALTER TABLE `testimoni_pegawai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `testimoni_pelayanan`
--
ALTER TABLE `testimoni_pelayanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `testimoni_sistem`
--
ALTER TABLE `testimoni_sistem`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `video_cctv`
--
ALTER TABLE `video_cctv`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
