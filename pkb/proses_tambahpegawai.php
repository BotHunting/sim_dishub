<?php
include("config.php"); // Mengimpor koneksi database dari config.php

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST["nama"];
    $jabatan = $_POST["jabatan"];
    $deskripsi = $_POST["deskripsi"];
    $foto = $_FILES["foto"]["name"];
    $twitter = $_POST["twitter"];
    $facebook = $_POST["facebook"];
    $instagram = $_POST["instagram"];
    $linkedin = $_POST["linkedin"];
    $username = $_POST["username"];
    $password = $_POST["password"]; // Password yang dimasukkan

    // Enkripsi password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Proses upload foto
    $target_dir = "assets/img/trainers/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi file gambar
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Cek ukuran file gambar
    if ($_FILES["foto"]["size"] > 500000) {
        echo "Maaf, file terlalu besar.";
        $uploadOk = 0;
    }

    // Hanya izinkan file JPG, JPEG, PNG & GIF
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
        $uploadOk = 0;
    }

    // Jika semua validasi berhasil, lanjutkan penyimpanan data
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            // Insert data ke database
            $sql = "INSERT INTO pegawai (nama, jabatan, deskripsi, foto, twitter, facebook, instagram, linkedin, username, password) 
                    VALUES ('$nama', '$jabatan', '$deskripsi', '$foto', '$twitter', '$facebook', '$instagram', '$linkedin', '$username', '$password_hash')";

            if ($conn->query($sql) === TRUE) {
                echo "Data pegawai berhasil ditambahkan.";
                header("Location: trainers.php"); // Redirect ke halaman pegawai
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengupload file foto.";
        }
    }

    $conn->close();
}
?>
