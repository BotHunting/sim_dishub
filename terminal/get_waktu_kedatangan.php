<?php
// Sertakan file koneksi.php
include_once 'koneksi.php';

// Periksa apakah parameter nomor kendaraan telah diterima
if (isset($_GET['nomor_kendaraan'])) {
    // Ambil nomor kendaraan dari parameter GET
    $nomor_kendaraan = $_GET['nomor_kendaraan'];

    // Query untuk mendapatkan waktu kedatangan terakhir berdasarkan nomor kendaraan
    $sql = "SELECT waktu_kedatangan FROM kendaraan_masuk WHERE nomor_kendaraan = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $nomor_kendaraan);
    $stmt->execute();
    $stmt->bind_result($waktu_kedatangan);
    $stmt->fetch();
    $stmt->close();

    // Mengembalikan waktu kedatangan jika ditemukan, atau pesan error jika tidak ada
    if ($waktu_kedatangan) {
        echo $waktu_kedatangan;
    } else {
        echo "Data waktu kedatangan tidak ditemukan";
    }
} else {
    // Jika tidak ada nomor kendaraan yang diterima, kirim pesan error
    echo "Nomor kendaraan tidak ditemukan";
}
