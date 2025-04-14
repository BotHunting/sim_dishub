<?php
// Include file koneksi database
include_once 'koneksi.php';

// Ambil data yang dikirimkan melalui method POST
$nomor_surat = $_POST['nomor_surat'];
$tanggal = $_POST['tanggal'];
$pengirim = $_POST['pengirim'];
$penerima = $_POST['penerima'];
$subjek = $_POST['subjek'];
$isi = $_POST['isi'];
$status = 'Draft'; // Set status awal surat menjadi Draft
$file_google_drive = $_POST['file_google_drive']; // Ambil link Google Drive yang diinputkan

// Gunakan prepared statement untuk mencegah SQL Injection
$sql = "INSERT INTO suratmenyurat (nomor_surat, tanggal, pengirim, penerima, subjek, isi, status, file_google_drive) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $koneksi->prepare($sql)) {
    // Bind parameter ke statement
    $stmt->bind_param("ssssssss", $nomor_surat, $tanggal, $pengirim, $penerima, $subjek, $isi, $status, $file_google_drive);

    // Eksekusi statement
    if ($stmt->execute()) {
        // Jika data berhasil dimasukkan, redirect kembali ke halaman tambah_surat.php
        header("Location: tambah_surat.php?status=success");
    } else {
        // Jika terjadi error, redirect kembali ke halaman tambah_surat.php dengan status error
        header("Location: tambah_surat.php?status=error");
    }

    // Tutup statement
    $stmt->close();
} else {
    // Jika terjadi error saat menyiapkan statement
    echo "Error: " . $koneksi->error;
}

// Tutup koneksi database
$koneksi->close();
?>
