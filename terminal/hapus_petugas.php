<?php
// Periksa apakah ada pengiriman data melalui metode GET dan apakah ID petugas telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Sertakan file koneksi.php
    include_once 'koneksi.php';

    // Escape input pengguna untuk menghindari serangan SQL Injection
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Query SQL untuk menghapus data petugas berdasarkan ID
    $sql = "DELETE FROM petugas WHERE id='$id'";

    if (mysqli_query($koneksi, $sql)) {
        // Jika query berhasil dieksekusi, kembalikan ke halaman tambah_petugas.php dengan pesan sukses
        header("Location: tambah_petugas.php?delete=success");
        exit();
    } else {
        // Jika terjadi kesalahan saat menjalankan query, kembalikan ke halaman tambah_petugas.php dengan pesan kesalahan
        header("Location: tambah_petugas.php?error=sqlerror");
        exit();
    }
}

// Tutup koneksi database
mysqli_close($koneksi);

// Jika pengguna mencoba mengakses halaman ini secara langsung tanpa menggunakan metode GET atau tanpa mengirimkan ID petugas, kembalikan ke halaman tambah_petugas.php
header("Location: tambah_petugas.php");
exit();
