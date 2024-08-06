<?php
// Sertakan file koneksi.php untuk terhubung ke database
require_once('koneksi.php');

// Periksa apakah parameter nomor_kendaraan telah diterima melalui metode GET
if (isset($_GET['nomor_kendaraan'])) {
    // Ambil nomor kendaraan dari parameter GET
    $nomor_kendaraan = $_GET['nomor_kendaraan'];

    // Query untuk mengambil asal terminal berdasarkan nomor kendaraan yang dipilih
    $sql = "SELECT asal_terminal FROM kendaraan_masuk WHERE nomor_kendaraan = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $nomor_kendaraan);
    $stmt->execute();
    $stmt->bind_result($asal_terminal);

    // Ambil hasil query
    $stmt->fetch();

    // Cetak hasil sebagai respon AJAX
    echo $asal_terminal;

    // Tutup statement dan koneksi database
    $stmt->close();
    $koneksi->close();
}
