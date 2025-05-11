<?php
// Jika ada parameter id dari URL
if(isset($_GET['id'])) {
    $pegawai_id = $_GET['id'];

    // Konfigurasi koneksi database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rekom_pkb";

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Mengecek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk menghapus data pegawai berdasarkan id
    $sql = "DELETE FROM pegawai WHERE id = $pegawai_id";

    if ($conn->query($sql) === TRUE) {
        echo "Data pegawai berhasil dihapus.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "ID Pegawai tidak ditemukan.";
}
?>
