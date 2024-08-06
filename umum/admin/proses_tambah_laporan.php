<?php
session_start();
require_once 'koneksi.php';

// Escape input untuk mencegah SQL Injection
$nomor_surat = mysqli_real_escape_string($koneksi, $_POST['nomor_surat']);
$tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
$jenis_laporan = mysqli_real_escape_string($koneksi, $_POST['jenis_laporan']);
$isi = mysqli_real_escape_string($koneksi, $_POST['isi']);
$status = mysqli_real_escape_string($koneksi, $_POST['status']);

// Proses upload file
$targetDir = "lib/laporan/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

// Validasi file
if (empty($fileName)) {
    $error = "Pilih file untuk diunggah.";
} elseif ($_FILES["file"]["size"] > 5000000) { // 5MB
    $error = "File terlalu besar. Maksimum 5MB.";
} elseif (!in_array($fileType, array('pdf'))) {
    $error = "Hanya file PDF yang diizinkan.";
} else {
    // Upload file ke folder "lib/laporan"
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        // Gunakan prepared statement untuk mencegah SQL Injection
        $query = "INSERT INTO laporan (nomor_surat, tanggal, jenis_laporan, isi, status, file_upload) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ssssss", $nomor_surat, $tanggal, $jenis_laporan, $isi, $status, $fileName);

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
    } else {
        $error = "Terjadi kesalahan saat mengupload file.";
    }
}

if (!empty($error)) {
    // Jika terdapat error, kembalikan ke halaman tambah laporan dengan pesan error
    $_SESSION['error'] = $error;
    header("Location: tambah_laporan.php");
    exit;
}

$koneksi->close();
