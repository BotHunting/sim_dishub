<?php
// Sertakan file koneksi.php
include_once 'koneksi.php';

// Inisialisasi variabel untuk notifikasi
$message = "";

// Periksa apakah data terkirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir tambah parkir
    $lokasi = $_POST['lokasi'];

    // Query untuk menambahkan data parkir ke dalam database
    $sql = "INSERT INTO parkir (lokasi) VALUES ('$lokasi')";

    if ($koneksi->query($sql) === TRUE) {
        // Jika berhasil, set pesan notifikasi
        $message = "Data lokasi berhasil disimpan.";

        // Redirect kembali ke halaman tambah_lokasi.php setelah notifikasi ditampilkan
        header("Location: tambah_lokasi.php?message=" . urlencode($message));
        exit(); // Pastikan untuk keluar dari skrip setelah pengalihan header
    } else {
        // Jika terjadi kesalahan, set pesan notifikasi
        $message = "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// Tutup koneksi database
$koneksi->close();
