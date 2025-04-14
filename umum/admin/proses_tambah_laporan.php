<?php
session_start();
require_once 'koneksi.php';

// Escape input untuk mencegah SQL Injection
$nomor_surat = mysqli_real_escape_string($koneksi, $_POST['nomor_surat']);
$tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
$jenis_laporan = mysqli_real_escape_string($koneksi, $_POST['jenis_laporan']);
$isi = mysqli_real_escape_string($koneksi, $_POST['isi']);
$status = mysqli_real_escape_string($koneksi, $_POST['status']);
$file_google_drive = mysqli_real_escape_string($koneksi, $_POST['file_google_drive']); // Menangani link Google Drive

// Validasi link Google Drive
if (empty($file_google_drive)) {
    $error = "Masukkan link Google Drive untuk file laporan.";
} else {
    // Gunakan prepared statement untuk mencegah SQL Injection
    $query = "INSERT INTO laporan (nomor_surat, tanggal, jenis_laporan, isi, status, file_google_drive) 
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ssssss", $nomor_surat, $tanggal, $jenis_laporan, $isi, $status, $file_google_drive);

    // Jalankan prepared statement
    if ($stmt->execute()) {
        // Redirect ke halaman laporan.php setelah berhasil menambahkan data
        header("Location: laporan.php");
        exit;
    } else {
        $error = "Error: Terjadi kesalahan saat menambahkan data.";
    }

    // Tutup statement
    $stmt->close();
}

if (!empty($error)) {
    // Jika terdapat error, kembalikan ke halaman tambah laporan dengan pesan error
    $_SESSION['error'] = $error;
    header("Location: tambah_laporan.php");
    exit;
}

$koneksi->close();
