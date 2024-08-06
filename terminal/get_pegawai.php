<?php
// Sertakan file koneksi.php
include_once 'koneksi.php';

// Periksa apakah ada pengiriman data melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah ID pegawai telah dikirim melalui metode POST
    if (isset($_POST['id'])) {
        // Escape input pengguna untuk menghindari serangan SQL Injection
        $id = mysqli_real_escape_string($koneksi, $_POST['id']);

        // Query SQL untuk mengambil data pegawai berdasarkan ID
        $sql = "SELECT nip, jabatan FROM pegawai WHERE id = '$id'";
        $result = mysqli_query($koneksi, $sql);

        if ($result) {
            // Jika query berhasil dieksekusi, kembalikan data sebagai JSON
            $row = mysqli_fetch_assoc($result);
            echo json_encode($row);
            exit();
        } else {
            // Jika terjadi kesalahan saat menjalankan query, kembalikan pesan error
            echo json_encode(["error" => "Gagal mengambil data pegawai."]);
            exit();
        }
    }
}

// Jika tidak ada data yang dikirimkan atau ID pegawai tidak ditemukan, kembalikan pesan error
echo json_encode(["error" => "Data pegawai tidak ditemukan."]);
exit();
