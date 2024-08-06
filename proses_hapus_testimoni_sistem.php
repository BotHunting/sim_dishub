<?php
session_start();

// Sertakan file konfigurasi database
include_once 'config.php';

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header("location: login.php");
    exit;
}

// Periksa apakah ID testimoni dikirim melalui metode GET
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Ambil ID testimoni dari URL
    $testimoni_id = $_GET['id'];

    // Buat query untuk menghapus testimoni berdasarkan ID
    $sql = "DELETE FROM testimoni_sistem WHERE id = ?";

    // Persiapkan pernyataan SQL
    if ($stmt = $koneksi->prepare($sql)) {
        // Bind parameter ke pernyataan persiapan
        $stmt->bind_param("i", $testimoni_id);

        // Mencoba mengeksekusi pernyataan persiapan
        if ($stmt->execute()) {
            // Jika berhasil, redirect ke halaman testimoni sistem dengan pesan sukses
            header("location: testi_sistem.php?pesan=Testimoni berhasil dihapus.");
            exit;
        } else {
            // Jika terjadi kesalahan saat mengeksekusi pernyataan, tampilkan pesan error
            echo "Terjadi kesalahan saat menghapus testimoni.";
        }

        // Tutup pernyataan
        $stmt->close();
    } else {
        // Jika pernyataan persiapan gagal, tampilkan pesan error
        echo "Gagal mempersiapkan pernyataan SQL.";
    }
} else {
    // Jika tidak ada ID testimoni, redirect ke halaman testimoni sistem
    header("location: testi_sistem.php");
    exit;
}
