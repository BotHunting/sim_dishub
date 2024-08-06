<?php
// Sertakan file koneksi.php untuk terhubung ke database
require_once('koneksi.php');

// Inisialisasi variabel error
$errors = [];

// Periksa apakah ID lokasi telah diberikan melalui URL
if (isset($_GET['id'])) {
    // Ambil ID lokasi dari URL dan lakukan pembersihan data
    $id = htmlspecialchars($_GET['id']);

    // Query untuk menghapus data lokasi dari database
    $sql = "DELETE FROM parkir WHERE id=?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        // Redirect ke halaman daftar_lokasi.php setelah berhasil menghapus lokasi
        header("Location: daftar_lokasi.php");
        exit();
    } else {
        $errors[] = "Gagal menghapus lokasi";
    }
} else {
    // Redirect ke halaman daftar_lokasi.php jika ID lokasi tidak ditemukan dalam URL
    header("Location: daftar_lokasi.php");
    exit();
}

// Tutup koneksi database
$koneksi->close();
