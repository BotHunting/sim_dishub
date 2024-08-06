<?php
// Include file konfigurasi database
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $keterangan = $_POST['keterangan'];

    // Handle file upload
    $foto = $_FILES['foto'];
    $foto_name = $nama . '_' . $foto['name']; // Nama file foto akan disesuaikan dengan nama pegawai

    // Lokasi folder untuk menyimpan foto
    $upload_dir = 'assets/img/team/';

    // Simpan foto ke folder
    move_uploaded_file($foto['tmp_name'], $upload_dir . $foto_name);

    // Simpan data ke database
    $sql = "INSERT INTO testimoni_pegawai (nama, jabatan, keterangan, foto) VALUES ('$nama', '$jabatan', '$keterangan', '$foto_name')";

    // Eksekusi query SQL
    if ($koneksi->query($sql) === TRUE) {
        // Jika data berhasil disimpan, redirect ke halaman sebelumnya
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    $koneksi->close();
}
