<?php
// Sertakan file koneksi.php
include_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim melalui form
    $id = $_POST['id'];
    $lokasi = $_POST['lokasi'];
    $alamat = $_POST['alamat'];
    $keterangan = $_POST['keterangan'];

    // Cek apakah file foto telah diupload
    if ($_FILES['foto']['error'] == 0) {
        // Ambil informasi file foto
        $foto_name = $_FILES['foto']['name'];
        $foto_size = $_FILES['foto']['size'];
        $foto_tmp = $_FILES['foto']['tmp_name'];

        // Simpan foto ke folder assets/img/terminal dengan nama sesuai lokasi
        $foto_path = 'assets/img/terminal/' . $lokasi . '.jpg';
        move_uploaded_file($foto_tmp, $foto_path);

        // Query untuk memperbarui data terminal beserta foto berdasarkan ID
        $sql = "UPDATE Terminal SET lokasi='$lokasi', alamat='$alamat', keterangan='$keterangan', foto='$foto_path' WHERE id=$id";
    } else {
        // Jika foto tidak diperbarui, hanya memperbarui data terminal
        $sql = "UPDATE Terminal SET lokasi='$lokasi', alamat='$alamat', keterangan='$keterangan' WHERE id=$id";
    }

    if ($koneksi->query($sql) === TRUE) {
        // Jika update berhasil, redirect kembali ke halaman utama dengan pesan sukses
        header("location: tambah_terminal.php?pesan=edit_sukses");
    } else {
        // Jika terjadi kesalahan, redirect kembali ke halaman utama dengan pesan error
        header("location: tambah_terminal.php?pesan=edit_gagal");
    }
} else {
    // Jika form tidak disubmit melalui metode POST, redirect kembali ke halaman utama dengan pesan error
    header("location: tambah_terminal.php?pesan=edit_gagal");
}

// Tutup koneksi database
$koneksi->close();
