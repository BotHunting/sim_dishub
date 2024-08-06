<?php
// Pastikan form telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include koneksi database
    require_once 'koneksi.php';

    // Tangkap data dari form
    $nomor_inventaris = $_POST['nomor_inventaris'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];
    $kondisi = $_POST['kondisi'];
    $tahun = $_POST['tahun'];

    // Tangkap data foto
    $foto_name = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $foto_size = $_FILES['foto']['size'];
    $foto_error = $_FILES['foto']['error'];

    // Cek apakah ada file yang diupload
    if ($foto_error === 0) {
        // File berhasil diupload
        // Tentukan lokasi penyimpanan foto
        $foto_destination = '../templates/pengelolaan/' . $nama_barang . '_' . uniqid() . '_' . $foto_name;

        // Pindahkan file ke lokasi tujuan
        if (move_uploaded_file($foto_tmp, $foto_destination)) {
            // Gunakan prepared statement untuk mencegah SQL Injection
            $sql = "INSERT INTO pengelolaan (nomor_inventaris, nama_barang, jumlah, kondisi, tahun, foto) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $koneksi->prepare($sql);
            $stmt->bind_param("ssisis", $nomor_inventaris, $nama_barang, $jumlah, $kondisi, $tahun, $foto_destination);

            if ($stmt->execute()) {
                // Data berhasil disimpan
                header("Location: pengelolaan.php");
                exit();
            } else {
                // Terjadi kesalahan saat menyimpan data ke database
                echo "Error: " . $sql . "<br>" . $koneksi->error;
            }

            // Tutup statement
            $stmt->close();
        } else {
            // Gagal memindahkan file
            echo "Maaf, terjadi kesalahan saat mengupload file.";
        }
    } else {
        // File gagal diupload
        echo "Maaf, terjadi kesalahan saat mengupload file.";
    }

    // Tutup koneksi database
    $koneksi->close();
} else {
    // Jika form tidak di-submit secara valid, redirect ke halaman tambah_barang.php
    header("Location: tambah_barang.php");
    exit();
}