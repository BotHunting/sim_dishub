<?php
// Include file koneksi.php untuk menghubungkan ke database
include_once 'koneksi.php';

// Mendapatkan ID admin dari parameter URL
$id = $_GET['id'];

// Query untuk menghapus data admin berdasarkan ID
$sql_delete = "DELETE FROM admin WHERE id = '$id'";

// Jalankan query untuk menghapus data
if ($koneksi->query($sql_delete) === TRUE) {
    header("Location: tambah_admin.php");
    exit;
} else {
    echo "Error: " . $sql_delete . "<br>" . $koneksi->error;
}

// Tutup koneksi database
$koneksi->close();
