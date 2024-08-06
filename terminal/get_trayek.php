<?php
// Koneksi ke database
include_once 'koneksi.php';

// Periksa apakah parameter nomor kendaraan telah diterima dari request GET
if (isset($_GET['nomor_kendaraan'])) {
    // Escape input untuk mencegah serangan SQL Injection
    $nomor_kendaraan = mysqli_real_escape_string($koneksi, $_GET['nomor_kendaraan']);

    // Query untuk mengambil data trayek dari tabel kendaraan_masuk berdasarkan nomor kendaraan yang dipilih
    $sql = "SELECT trayek FROM kendaraan_masuk WHERE nomor_kendaraan = '$nomor_kendaraan'";
    $result = $koneksi->query($sql);

    // Periksa apakah hasil query mengembalikan baris data
    if ($result->num_rows > 0) {
        // Ambil nilai trayek dari baris data pertama
        $row = $result->fetch_assoc();
        $trayek = $row['trayek'];

        // Mengembalikan nilai trayek sebagai respons AJAX
        echo $trayek;
    } else {
        // Jika tidak ada data yang cocok, kembalikan pesan kosong
        echo "";
    }

    // Tutup koneksi ke database
    $koneksi->close();
}
