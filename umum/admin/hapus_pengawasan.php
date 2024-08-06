<?php
include_once 'koneksi.php';

// Pastikan ada data yang dikirimkan melalui metode GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Pastikan ID tersedia
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Query untuk menghapus data pengawasan berdasarkan ID
        $sql = "DELETE FROM pengawasan WHERE id='$id'";

        if (mysqli_query($koneksi, $sql)) {
            // Jika berhasil dihapus, redirect kembali ke halaman pengawasan
            header("Location: pengawasan.php");
            exit;
        } else {
            echo "Terjadi kesalahan saat melakukan proses hapus pengawasan: " . mysqli_error($koneksi);
        }
    } else {
        echo "ID pengawasan tidak ditemukan.";
    }
} else {
    echo "Akses tidak diizinkan.";
}
