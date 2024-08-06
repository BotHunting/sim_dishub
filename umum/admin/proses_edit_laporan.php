<?php
// Include file koneksi database
include_once 'koneksi.php';

// Tangkap data yang dikirimkan dari form
$id = $_POST['id'];
$tanggal = $_POST['tanggal'];
$nomor_surat = $_POST['nomor_surat']; // Tambahkan variabel untuk menangkap nomor_surat
$jenis_laporan = $_POST['jenis_laporan'];
$isi = $_POST['isi'];
$status = $_POST['status'];

// Persiapkan statement SQL untuk mengupdate data laporan
$query = "UPDATE laporan SET tanggal=?, nomor_surat=?, jenis_laporan=?, isi=?, status=?";

// Buat array untuk menyimpan tipe data dari setiap parameter
$types = "sssss";

// Periksa apakah ada file yang diunggah
if ($_FILES['file']['name'] != '') {
    // Jika ada file yang diunggah, proses file tersebut
    $targetDir = "lib/laporan/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Validasi file
    if ($_FILES["file"]["size"] > 5000000) { // 5MB
        $error = "File terlalu besar. Maksimum 5MB.";
        header("Location: edit_laporan.php?id=$id&error=$error");
        exit;
    } elseif (!in_array($fileType, array('pdf'))) {
        $error = "Hanya file PDF yang diizinkan.";
        header("Location: edit_laporan.php?id=$id&error=$error");
        exit;
    }

    // Tambahkan nama file ke query dan perbarui tipe data
    $query .= ", file_upload=?";
    $types .= "s";
}

// Tambahkan kondisi WHERE untuk ID
$query .= " WHERE id=?";
$types .= "i";

// Persiapkan statement
$stmt = $koneksi->prepare($query);

// Bind parameter ke statement
$stmt->bind_param($types, $tanggal, $nomor_surat, $jenis_laporan, $isi, $status);

// Periksa apakah ada file yang diunggah
if ($_FILES['file']['name'] != '') {
    // Tambahkan file ke parameter statement
    $stmt->bind_param('s', $fileName);
}

// Bind parameter ID
$stmt->bind_param('i', $id);

// Eksekusi statement
if ($stmt->execute()) {
    // Jika berhasil, redirect ke halaman laporan.php
    header("Location: laporan.php");
    exit;
} else {
    // Jika gagal, tangkap pesan error
    $error = "Error: " . $stmt->error;
}

// Jika terjadi kesalahan, arahkan kembali ke halaman edit_laporan.php dengan pesan error yang sesuai
header("Location: edit_laporan.php?id=$id&error=$error");

// Tutup statement
$stmt->close();

// Tutup koneksi database
$koneksi->close();
