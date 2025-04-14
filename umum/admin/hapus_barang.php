<?php
// Include file koneksi database
include_once '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Ambil ID barang yang akan dihapus
    $id = $_GET['id'];

    // Query untuk menghapus data barang berdasarkan ID
    $sql = "DELETE FROM pengelolaan WHERE id=$id";

    if ($koneksi->query($sql) === TRUE) {
        // Jika berhasil dihapus, redirect kembali ke halaman pengelolaan.php
        header("location: pengelolaan.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
