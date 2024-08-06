<?php
session_start();

// Sertakan file konfigurasi database
include_once 'config.php';

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header("location: login.php");
    exit;
}

// Periksa apakah ID testimoni dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Ambil ID testimoni dari input form
    $testimoni_id = $_POST['id'];

    // Tampilkan peringatan sebelum menghapus testimoni
    echo "<script>
            var confirmation = confirm('Apakah Anda yakin ingin menghapus testimoni ini?');
            if(confirmation){
                window.location.href = 'proses_hapus_testimoni_sistem.php?id=$testimoni_id';
            } else {
                window.location.href = 'testi_sistem.php';
            }
          </script>";
} else {
    // Jika tidak ada ID testimoni, redirect ke halaman testimoni sistem
    header("location: testi_sistem.php");
    exit;
}
