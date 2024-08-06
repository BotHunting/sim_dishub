<?php
// Sertakan file koneksi.php untuk terhubung ke database
require_once('koneksi.php');

// Inisialisasi variabel
$id_kendaraan = $waktu_masuk = $waktu_keluar = $biaya = $status = $bulan_laporan = $tahun_laporan = $nama = '';

// Memeriksa apakah data dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data dari form
    $id_kendaraan = $_POST["kendaraan"];
    $biaya = $_POST["biaya"];
    $petugas_id = $_POST["petugas"];

    // Mendapatkan nomor kendaraan, jenis kendaraan, dan waktu masuk dari tabel kendaraan
    $sql_kendaraan = "SELECT nomor_kendaraan, jenis_kendaraan, waktu_masuk, lokasi_parkir FROM kendaraan WHERE id = ?";
    if ($stmt_kendaraan = $koneksi->prepare($sql_kendaraan)) {
        // Bind parameter ke query
        $stmt_kendaraan->bind_param("i", $id_kendaraan);
        // Eksekusi query
        $stmt_kendaraan->execute();
        // Ambil hasil query
        $result_kendaraan = $stmt_kendaraan->get_result();
        // Ambil baris data
        $row_kendaraan = $result_kendaraan->fetch_assoc();
        // Set nilai variabel
        $nomor_kendaraan = $row_kendaraan["nomor_kendaraan"];
        $jenis_kendaraan = $row_kendaraan["jenis_kendaraan"];
        $waktu_masuk = $row_kendaraan["waktu_masuk"];
        $lokasi_parkir = $row_kendaraan["lokasi_parkir"];
        // Tutup statement
        $stmt_kendaraan->close();
    }

    // Mendapatkan waktu keluar saat ini (WIT)
    date_default_timezone_set('Asia/Jayapura'); // Set zona waktu WIT (Asia/Jayapura)
    $waktu_keluar = date('Y-m-d H:i:s');

    // Mendapatkan nama petugas berdasarkan id
    $sql_petugas = "SELECT nama FROM petugas WHERE id = ?";
    if ($stmt_petugas = $koneksi->prepare($sql_petugas)) {
        // Bind parameter ke query
        $stmt_petugas->bind_param("i", $petugas_id);
        // Eksekusi query
        $stmt_petugas->execute();
        // Ambil hasil query
        $result_petugas = $stmt_petugas->get_result();
        // Ambil baris data
        $row_petugas = $result_petugas->fetch_assoc();
        // Set nilai variabel
        $nama = $row_petugas["nama"];
        // Tutup statement
        $stmt_petugas->close();
    }

    // Mendapatkan bulan dan tahun saat ini
    $bulan_laporan = date('m');
    $tahun_laporan = date('Y');

    // Query untuk menyimpan data pembayaran ke tabel laporan_parkir
    $sql_laporan_parkir = "INSERT INTO laporan_parkir (id_kendaraan, nomor_kendaraan, jenis_kendaraan, waktu_masuk, waktu_keluar, biaya_parkir, status, bulan_laporan, tahun_laporan, nama, lokasi_parkir) VALUES (?, ?, ?, ?, ?, ?, 'Keluar', ?, ?, ?, ?)";
    if ($stmt_laporan_parkir = $koneksi->prepare($sql_laporan_parkir)) {
        // Bind parameter ke query
        $stmt_laporan_parkir->bind_param("isssssdiss", $id_kendaraan, $nomor_kendaraan, $jenis_kendaraan, $waktu_masuk, $waktu_keluar, $biaya, $bulan_laporan, $tahun_laporan, $nama, $lokasi_parkir);
        // Eksekusi query
        $stmt_laporan_parkir->execute();
        // Tutup statement
        $stmt_laporan_parkir->close();
    }

    // Query untuk menghapus data kendaraan dari tabel kendaraan
    $sql_hapus_kendaraan = "DELETE FROM kendaraan WHERE id = ?";
    if ($stmt_hapus_kendaraan = $koneksi->prepare($sql_hapus_kendaraan)) {
        $stmt_hapus_kendaraan->bind_param("i", $id_kendaraan);
        $stmt_hapus_kendaraan->execute();
        $stmt_hapus_kendaraan->close();
    }

    header("location: pembayaran.php");
    exit();
}

// Tutup koneksi database
$koneksi->close();
