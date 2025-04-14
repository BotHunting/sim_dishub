<?php
// Memulai session
session_start();

// Include file koneksi database
require_once 'koneksi.php';

// Inisialisasi variabel
$id = $nama_layanan = $deskripsi = $pemohon = $file_google_drive = '';
$error = '';

// Cek apakah form telah disubmit dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape input untuk mencegah SQL Injection
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nama_layanan = mysqli_real_escape_string($koneksi, $_POST['nama_layanan']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $pemohon = mysqli_real_escape_string($koneksi, $_POST['pemohon']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    $file_google_drive = mysqli_real_escape_string($koneksi, $_POST['file_google_drive']);

    // Validasi data
    if (empty($nama_layanan) || empty($pemohon) || empty($file_google_drive)) {
        $error = "Semua kolom harus diisi termasuk link Google Drive.";
    } else {
        // Query untuk mengupdate data layanan berdasarkan ID
        $query = "UPDATE pelayananumum SET nama_layanan=?, deskripsi=?, pemohon=?, status=?, file_google_drive=? WHERE id=?";

        // Persiapkan statement
        $stmt = $koneksi->prepare($query);

        // Bind parameter ke query
        $stmt->bind_param("sssssi", $nama_layanan, $deskripsi, $pemohon, $status, $file_google_drive, $id);

        // Eksekusi statement
        if ($stmt->execute()) {
            // Redirect ke halaman pelayanan.php setelah berhasil mengedit data
            header("Location: pelayanan.php");
            exit;
        } else {
            $error = "Error: " . $stmt->error;
        }

        // Tutup statement
        $stmt->close();
    }
}

// Tampilkan error jika ada
if (!empty($error)) {
    echo "<div class='alert alert-danger'>$error</div>";
}

// Tutup koneksi database
$koneksi->close();
?>
