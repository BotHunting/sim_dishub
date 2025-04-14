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
$file_google_drive = $_POST['file_google_drive']; // Tangkap link Google Drive baru

// Persiapkan query dasar untuk mengupdate data laporan
$query = "UPDATE laporan SET tanggal=?, nomor_surat=?, jenis_laporan=?, isi=?, status=?";

// Buat array untuk menyimpan tipe data dari setiap parameter
$types = "sssss";

// Cek apakah ada link Google Drive yang dimasukkan
if (!empty($file_google_drive)) {
    // Tambahkan link Google Drive ke query
    $query .= ", file_google_drive=?";
    $types .= "s"; // Menambahkan tipe data untuk link Google Drive
}

// Tambahkan kondisi WHERE untuk ID
$query .= " WHERE id=?";
$types .= "i";  // Tipe data untuk ID adalah integer

// Persiapkan statement
$stmt = $koneksi->prepare($query);

// Bind parameter ke statement
if (!empty($file_google_drive)) {
    // Jika ada link Google Drive, ikat semua parameter, termasuk file_google_drive
    $stmt->bind_param($types, $tanggal, $nomor_surat, $jenis_laporan, $isi, $status, $file_google_drive, $id);
} else {
    // Jika tidak ada link Google Drive, ikat tanpa parameter file_google_drive
    $stmt->bind_param($types, $tanggal, $nomor_surat, $jenis_laporan, $isi, $status, $id);
}

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
?>
