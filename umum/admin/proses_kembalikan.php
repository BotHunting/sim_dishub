<?php
include_once 'header.php';
require_once 'koneksi.php';

// Ambil id pinjaman dari URL
$id_pinjaman = $_GET['id'];

// Perbarui waktu kembali dan status pinjaman
$sql_update = "UPDATE pinjaman SET waktu_kembali = NOW(), status = 'Sudah Dikembalikan' WHERE id = '$id_pinjaman'";

if ($koneksi->query($sql_update) === TRUE) {
    echo "<script>alert('Barang telah berhasil dikembalikan');</script>";
} else {
    echo "<script>alert('Error: " . $sql_update . "<br>" . $koneksi->error . "');</script>";
}

// Redirect ke halaman peminjaman
echo "<script>window.location.href = 'peminjaman.php';</script>";
?>
