<?php
// Sertakan file koneksi.php
include_once 'koneksi.php';

// Periksa apakah parameter nomor kendaraan telah diterima
if (isset($_GET['nomor_kendaraan'])) {
    // Ambil nomor kendaraan dari parameter GET
    $nomor_kendaraan = $_GET['nomor_kendaraan'];

    // Query untuk mendapatkan jumlah penumpang masuk terakhir berdasarkan nomor kendaraan
    $sql = "SELECT jumlah_penumpang_masuk FROM kendaraan_masuk WHERE nomor_kendaraan = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $nomor_kendaraan);
    $stmt->execute();
    $stmt->bind_result($jumlah_penumpang_masuk);
    $stmt->fetch();
    $stmt->close();

    // Mengembalikan jumlah penumpang masuk jika ditemukan, atau pesan error jika tidak ada
    if ($jumlah_penumpang_masuk !== null) {
        echo $jumlah_penumpang_masuk;
    } else {
        echo "Data jumlah penumpang masuk tidak ditemukan";
    }
} else {
    // Jika tidak ada nomor kendaraan yang diterima, kirim pesan error
    echo "Nomor kendaraan tidak ditemukan";
}
