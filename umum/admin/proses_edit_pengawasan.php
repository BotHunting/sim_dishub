<?php
session_start();
// Include file koneksi database
require_once 'koneksi.php';

// Inisialisasi variabel
$id = $nomor_surat = $jenis_pengawasan = $tanggal = $deskripsi = $status = '';
$error = '';

// Cek apakah ID pengawasan tersedia dalam parameter GET
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    // Persiapkan statement SELECT
    $sql = "SELECT * FROM pengawasan WHERE id = ?";

    if ($stmt = $koneksi->prepare($sql)) {
        // Bind parameter ke statement
        $stmt->bind_param("i", $param_id);

        // Set parameter
        $param_id = trim($_GET['id']);

        // Mengeksekusi statement
        if ($stmt->execute()) {
            // Menyimpan hasil
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                // Ambil baris hasil sebagai array asosiatif
                $row = $result->fetch_assoc();

                // Mendapatkan nilai dari setiap kolom
                $nomor_surat = htmlspecialchars($row['nomor_surat']);
                $jenis_pengawasan = htmlspecialchars($row['jenis_pengawasan']);
                $tanggal = htmlspecialchars($row['tanggal']);
                $deskripsi = htmlspecialchars($row['deskripsi']);
                $status = htmlspecialchars($row['status']);
            } else {
                // Jika ID tidak valid, redirect kembali ke halaman pengawasan.php
                header("location: pengawasan.php");
                exit();
            }
        } else {
            echo "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
        }

        // Tutup statement
        $stmt->close();
    }
} else {
    // Jika parameter ID tidak ditemukan, redirect kembali ke halaman pengawasan.php
    header("location: pengawasan.php");
    exit();
}

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form dan membersihkan dari potensi serangan SQL Injection
    $nomor_surat = htmlspecialchars($_POST['nomor_surat']);
    $jenis_pengawasan = htmlspecialchars($_POST['jenis_pengawasan']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $status = htmlspecialchars($_POST['status']);
    // Validasi data
    if (empty($nomor_surat) || empty($jenis_pengawasan) || empty($tanggal) || empty($deskripsi) || empty($status)) {
        $error = "Semua kolom harus diisi";
    } else {
        // Query untuk update data pengawasan ke dalam tabel
        $query = "UPDATE pengawasan SET nomor_surat=?, jenis_pengawasan=?, tanggal=?, deskripsi=?, status=? WHERE id=?";

        if ($stmt = $koneksi->prepare($query)) {
            // Bind parameter ke statement
            $stmt->bind_param("sssssi", $nomor_surat, $jenis_pengawasan, $tanggal, $deskripsi, $status, $id);

            // Set parameter
            $id = $_GET['id'];

            // Mengeksekusi statement
            if ($stmt->execute()) {
                // Jika berhasil, redirect ke halaman pengawasan.php
                header("Location: pengawasan.php");
                exit();
            } else {
                $error = "Error: " . $query . "<br>" . $koneksi->error;
            }
        }

        // Tutup statement
        $stmt->close();
    }
}
