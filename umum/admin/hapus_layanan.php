<?php
// Include file koneksi database
include_once 'koneksi.php';

// Periksa apakah parameter id telah diberikan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data layanan berdasarkan id
    $sql = "DELETE FROM pelayananumum WHERE id = $id";

    // Jalankan query
    if ($koneksi->query($sql) === TRUE) {
        // Redirect ke halaman pelayanan.php setelah berhasil menghapus data
        header("Location: pelayanan.php");
        exit;
    } else {
        echo "Error: " . $koneksi->error;
    }
} else {
    echo "Parameter id tidak diberikan.";
}
