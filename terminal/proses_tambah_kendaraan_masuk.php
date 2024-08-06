<?php
include_once 'koneksi.php';

// Tangkap data yang dikirimkan melalui form
$nomor_kendaraan = $_POST['nomor_kendaraan'];
$trayek = $_POST['trayek'];
$waktu_kedatangan = $_POST['waktu_kedatangan'];
$jumlah_penumpang_masuk = $_POST['jumlah_penumpang_masuk'];
$asal_terminal = $_POST['asal_terminal'];

// Query untuk menyimpan data ke tabel kendaraan_masuk
$sql = "INSERT INTO kendaraan_masuk (nomor_kendaraan, trayek, waktu_kedatangan, jumlah_penumpang_masuk, asal_terminal) VALUES ('$nomor_kendaraan', '$trayek', '$waktu_kedatangan', '$jumlah_penumpang_masuk', '$asal_terminal')";

if ($koneksi->query($sql) === TRUE) {
    // Jika data berhasil disimpan, redirect ke halaman tambah_kendaraan.php
    header("Location: tambah_kendaraan.php");
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
