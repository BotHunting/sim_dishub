<?php
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $keterangan = $_POST['keterangan'];

    // Handle file upload
    $foto = $_FILES['foto'];
    $foto_name = $nama . '_' . $foto['name']; // Nama file foto akan disesuaikan dengan nama inputan

    // Lokasi folder untuk menyimpan foto
    $upload_dir = 'assets/img/testihome/';

    // Simpan foto ke folder
    move_uploaded_file($foto['tmp_name'], $upload_dir . $foto_name);

    // Simpan data ke database
    $sql = "INSERT INTO testimoni_home (nama, jabatan, keterangan, foto) VALUES ('$nama', '$jabatan', '$keterangan', '$foto_name')";

    if ($koneksi->query($sql) === TRUE) {
        // Data berhasil disimpan, arahkan kembali ke halaman sebelumnya
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    $koneksi->close();
}
