<?php
// Sertakan file koneksi.php
include_once 'koneksi.php';

if (isset($_GET['id'])) {
    // Ambil ID terminal dari parameter URL
    $id = $_GET['id'];

    // Query untuk menghapus data terminal berdasarkan ID
    $sql = "DELETE FROM Terminal WHERE id=$id";

    if ($koneksi->query($sql) === TRUE) {
        // Jika penghapusan berhasil, redirect kembali ke halaman utama dengan pesan sukses
        header("location: tambah_terminal.php?pesan=hapus_sukses");
    } else {
        // Jika terjadi kesalahan, redirect kembali ke halaman utama dengan pesan error
        header("location: tambah_terminal.php?pesan=hapus_gagal");
    }
} else {
    // Jika tidak ada ID yang diberikan, redirect kembali ke halaman utama dengan pesan error
    header("location: tambah_terminal.php?pesan=hapus_gagal");
}

// Tutup koneksi database
$koneksi->close();
