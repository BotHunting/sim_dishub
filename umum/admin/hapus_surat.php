<?php
// Include file koneksi database
include_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Ambil id surat dari parameter GET
    $id = $_GET['id'];

    // Query untuk menghapus data surat berdasarkan ID
    $sql = "DELETE FROM suratmenyurat WHERE id=$id";

    if ($koneksi->query($sql) === TRUE) {
        // Jika berhasil hapus, redirect ke halaman surat_menyurat.php
        header("location: surat_menyurat.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// Tutup koneksi database
$koneksi->close();
