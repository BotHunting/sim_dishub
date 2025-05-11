<?php
include("config.php"); // Mengimpor koneksi database dari config.php

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $jabatan = $_POST["jabatan"];
    $deskripsi = $_POST["deskripsi"];
    $foto = $_FILES["foto"]["name"];
    $twitter = $_POST["twitter"];
    $facebook = $_POST["facebook"];
    $instagram = $_POST["instagram"];
    $linkedin = $_POST["linkedin"];
    $username = $_POST["username"];
    $password = $_POST["password"]; // Password yang dimasukkan (opsional untuk diubah)

    // Enkripsi password jika diubah
    if (!empty($password)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $password_query = ", password = '$password_hash'"; // Tambahkan bagian password jika ada perubahan
    } else {
        $password_query = ""; // Jika password tidak diubah
    }

    // Proses upload foto (jika ada foto baru)
    if (!empty($foto)) {
        $target_dir = "assets/img/trainers/";
        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
        $foto_query = ", foto = '$foto'"; // Menyimpan foto baru
    } else {
        $foto_query = ""; // Tidak ada perubahan pada foto
    }

    // Update data pegawai
    $sql = "UPDATE pegawai SET nama = '$nama', jabatan = '$jabatan', deskripsi = '$deskripsi', 
            twitter = '$twitter', facebook = '$facebook', instagram = '$instagram', linkedin = '$linkedin', 
            username = '$username' $password_query $foto_query WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Data pegawai berhasil diperbarui.";
        header("Location: trainers.php"); // Redirect ke halaman pegawai
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
