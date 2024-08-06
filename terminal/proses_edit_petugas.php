<?php
// Periksa apakah ada pengiriman data melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah ID petugas telah dikirim melalui metode POST
    if (isset($_POST['id'])) {
        // Sertakan file koneksi.php
        include_once 'koneksi.php';

        // Escape input pengguna untuk menghindari serangan SQL Injection
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $nip = $_POST['nip'];
        $jabatan = $_POST['jabatan'];
        $jadwal_kerja = $_POST['jadwal_kerja'];
        $telepon = $_POST['telepon'];

        // Periksa apakah file foto diunggah
        if ($_FILES['foto']['error'] == UPLOAD_ERR_OK) {
            // Jika file foto diunggah, proses penyimpanan foto baru
            $target_dir = "assets/img/petugas/";
            $foto_extension = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
            $foto_name = $nip . "." . $foto_extension;
            $foto_path = $target_dir . $foto_name;

            // Pindahkan file foto yang diunggah ke lokasi penyimpanan baru
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $foto_path)) {
                // Jika berhasil, update data petugas dengan foto baru
                $sql = "UPDATE petugas SET nama=?, nip=?, jabatan=?, jadwal_kerja=?, telepon=?, foto=? WHERE id=?";
                $stmt = $koneksi->prepare($sql);
                $stmt->bind_param("ssssssi", $nama, $nip, $jabatan, $jadwal_kerja, $telepon, $foto_name, $id);
            } else {
                // Jika gagal memindahkan file foto, kembalikan ke halaman edit_petugas.php dengan pesan kesalahan
                header("Location: edit_petugas.php?id=$id&error=fileerror");
                exit();
            }
        } else {
            // Jika file foto tidak diunggah, tetap gunakan foto lama dalam pembaruan data
            $sql = "UPDATE petugas SET nama=?, nip=?, jabatan=?, jadwal_kerja=?, telepon=? WHERE id=?";
            $stmt = $koneksi->prepare($sql);
            $stmt->bind_param("sssssi", $nama, $nip, $jabatan, $jadwal_kerja, $telepon, $id);
        }

        // Eksekusi statement
        if ($stmt->execute()) {
            // Jika query berhasil dieksekusi, kembalikan ke halaman edit_petugas.php dengan pesan sukses
            header("Location: tambah_petugas.php?id=$id&edit=success");
            exit();
        } else {
            // Jika terjadi kesalahan saat menjalankan query, kembalikan ke halaman edit_petugas.php dengan pesan kesalahan
            header("Location: edit_petugas.php?id=$id&error=sqlerror");
            exit();
        }
    }
}

// Jika pengguna mencoba mengakses halaman ini secara langsung tanpa menggunakan metode POST atau tanpa mengirimkan ID petugas, kembalikan ke halaman edit_petugas.php
header("Location: tambah_petugas.php");
exit();
