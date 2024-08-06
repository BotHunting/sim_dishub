<?php
// Sertakan file koneksi.php
include_once 'koneksi.php';

// Ambil data dari formulir tambah terminal
$lokasi = $_POST['lokasi'];
$alamat = $_POST['alamat'];
$keterangan = $_POST['keterangan'];

// Proses upload foto
$target_dir = "assets/img/terminal/";
$target_file = $target_dir . basename($_FILES["foto"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$nama_foto = $lokasi . "." . $imageFileType;

// Cek apakah file gambar valid
$uploadOk = 1;
// Cek apakah file sudah ada
if (file_exists($target_file)) {
    echo "Maaf, file sudah ada.";
    $uploadOk = 0;
}
// Cek ukuran file
if ($_FILES["foto"]["size"] > 500000) {
    echo "Maaf, ukuran file terlalu besar.";
    $uploadOk = 0;
}
// Hanya izinkan beberapa format file tertentu
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
    $uploadOk = 0;
}
// Jika ada kesalahan dalam proses upload, tampilkan pesan kesalahan
if ($uploadOk == 0) {
    echo "Maaf, file Anda tidak dapat diupload.";
// Jika tidak ada kesalahan, coba upload file
} else {
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $nama_foto)) {
        echo "File ". htmlspecialchars( basename( $_FILES["foto"]["name"])). " berhasil diupload.";
    } else {
        echo "Maaf, terjadi kesalahan saat mengupload file.";
    }
}

// Query untuk menambahkan data terminal ke dalam database
$sql = "INSERT INTO terminal (lokasi, alamat, keterangan, foto) VALUES ('$lokasi', '$alamat', '$keterangan', '$nama_foto')";

if ($koneksi->query($sql) === TRUE) {
    // Jika berhasil, redirect kembali ke halaman tambah_terminal.php
    header("Location: tambah_terminal.php");
} else {
    // Jika terjadi kesalahan, tampilkan pesan kesalahan
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

// Tutup koneksi database
$koneksi->close();
?>
