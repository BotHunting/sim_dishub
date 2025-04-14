<?php
// Include file koneksi database
include_once '../../config.php';

// Pastikan ID laporan telah diterima dari parameter URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Query SQL untuk menghapus laporan berdasarkan ID
    $sql = "DELETE FROM laporan WHERE id=$id";

    if ($koneksi->query($sql) === TRUE) {
        // Jika berhasil dihapus, redirect kembali ke halaman pengelolaan laporan dengan pesan sukses
        header("Location: pengelolaan.php?status=success");
    } else {
        // Jika gagal dihapus, redirect kembali ke halaman pengelolaan laporan dengan pesan error
        header("Location: pengelolaan.php?status=error");
    }
} else {
    // Jika tidak ada ID yang diterima, redirect kembali ke halaman pengelolaan laporan dengan pesan error
    header("Location: pengelolaan.php?status=error");
}

// Tutup koneksi database
$koneksi->close();
