<?php
include_once 'config.php';

// Periksa apakah parameter id telah diterima
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Ambil nilai id dari parameter GET
    $id = $_GET['id'];

    // Tampilkan pesan konfirmasi untuk pengguna sebelum menghapus data
    echo '<script>';
    echo 'var confirmation = confirm("Apakah Anda yakin ingin menghapus testimoni ini?");';
    echo 'if (confirmation) {';
    echo '  window.location.href = "proses_hapus_testimoni_pegawai.php?id=' . $id . '";';
    echo '}';
    echo '</script>';
} else {
    // Redirect ke halaman error jika tidak ada parameter id yang diberikan
    header("Location: error.php");
    exit();
}
