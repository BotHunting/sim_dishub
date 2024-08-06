<?php
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sebutan = $_POST['sebutan'];
    $harga = $_POST['harga'];
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];
    $pejabat = $_POST['pejabat'];

    // Handle file uploads
    $foto = $_FILES['foto'];
    $gambar = $_FILES['gambar'];

    $foto_name = $nama . '_' . $foto['name'];
    $gambar_name = $pejabat . '_' . $gambar['name'];

    // Lokasi folder untuk menyimpan foto
    $upload_dir = 'assets/img/';

    // Simpan foto dan gambar ke folder
    move_uploaded_file($foto['tmp_name'], $upload_dir . 'trainers/' . $foto_name);
    move_uploaded_file($gambar['tmp_name'], $upload_dir . 'pelayanan/' . $gambar_name);

    // Simpan data ke database
    $sql = "INSERT INTO testimoni_pelayanan (sebutan, harga, nama, keterangan, pejabat, foto, gambar) 
            VALUES ('$sebutan', '$harga', '$nama', '$keterangan', '$pejabat', '$foto_name', '$gambar_name')";

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
