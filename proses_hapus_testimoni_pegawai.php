<?php
include_once 'config.php';

// Periksa apakah parameter id telah diterima
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Ambil nilai id dari parameter GET
    $id = $_GET['id'];

    // Siapkan query SQL untuk menghapus testimoni pegawai berdasarkan id
    $sql = "DELETE FROM testimoni_pegawai WHERE id = ?";

    if ($stmt = $koneksi->prepare($sql)) {
        // Bind parameter ke statement
        $stmt->bind_param("i", $id);

        // Eksekusi statement
        if ($stmt->execute()) {
            // Redirect kembali ke halaman testimoni pegawai jika penghapusan berhasil
            header("Location: testi_pegawai.php");
            exit();
        } else {
            // Tampilkan pesan kesalahan jika terjadi masalah dalam eksekusi statement
            echo "Terjadi kesalahan saat menghapus data testimoni pegawai.";
        }
    }

    // Tutup statement
    $stmt->close();

    // Tutup koneksi database
    $koneksi->close();
} else {
    // Redirect ke halaman error jika tidak ada parameter id yang diberikan
    header("Location: testi_pegawai.php");
    exit();
}
