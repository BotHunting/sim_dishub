<?php
// Memeriksa apakah parameter id disposisi telah diterima
if (isset($_GET['id'])) {
    // Memasukkan file koneksi database
    include_once '../koneksi.php';

    // Mendapatkan id disposisi dari parameter GET
    $id = $_GET['id'];

    // Menyiapkan statement SQL untuk menghapus data disposisi berdasarkan id
    $sql = "DELETE FROM disposisi WHERE id = $id";

    // Menjalankan query untuk menghapus data disposisi
    if ($koneksi->query($sql) === TRUE) {
        // Jika penghapusan berhasil, kembalikan ke halaman disposisi dengan pesan sukses
        header("Location: disposisi.php?status=success&message=Data disposisi berhasil dihapus.");
        exit();
    } else {
        // Jika terjadi kesalahan saat penghapusan, kembalikan ke halaman disposisi dengan pesan kesalahan
        header("Location: disposisi.php?status=error&message=Terjadi kesalahan saat menghapus data disposisi: " . $koneksi->error);
        exit();
    }
} else {
    // Jika parameter id disposisi tidak diterima, kembalikan ke halaman disposisi dengan pesan kesalahan
    header("Location: disposisi.php?status=error&message=ID disposisi tidak diterima.");
    exit();
}
