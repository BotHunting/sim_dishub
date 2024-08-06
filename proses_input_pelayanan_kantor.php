<?php
// Include file konfigurasi database
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $jadwal = $_POST['jadwal'];
    $keterangan = $_POST['keterangan'];

    // Handle file upload
    $foto = $_FILES['foto'];
    $foto_name = $nama . '.jpg'; // Nama file foto disesuaikan dengan nama layanan

    // Lokasi folder untuk menyimpan foto
    $upload_dir = 'assets/img/servis/';

    // Simpan foto ke folder
    move_uploaded_file($foto['tmp_name'], $upload_dir . $foto_name);

    // Simpan data ke database
    $sql = "INSERT INTO pelayanan_kantor (nama, jadwal, keterangan, foto) VALUES ('$nama', '$jadwal', '$keterangan', '$foto_name')";

    // Eksekusi query SQL
    if ($koneksi->query($sql) === TRUE) {
        // Jika data berhasil disimpan, redirect ke halaman sebelumnya
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    $koneksi->close();
}
?>
