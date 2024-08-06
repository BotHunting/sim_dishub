<?php
// Include file koneksi database
include_once 'config.php';

// Cek jika form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai form
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $keterangan = $_POST['keterangan'];

    // Handle file upload
    $foto = $_FILES['foto'];
    $foto_name = $nama . '_' . $foto['name']; // Nama file foto akan disesuaikan dengan nama inputan

    // Lokasi folder untuk menyimpan foto
    $upload_dir = 'assets/img/testimonials/';

    // Simpan foto ke folder
    move_uploaded_file($foto['tmp_name'], $upload_dir . $foto_name);

    // Query SQL untuk menyimpan data ke dalam tabel testimoni_sistem
    $sql = "INSERT INTO testimoni_sistem (nama, jabatan, keterangan, foto) VALUES ('$nama', '$jabatan', '$keterangan', '$foto_name')";
    
    // Eksekusi query SQL
    if ($koneksi->query($sql) === TRUE) {
        // Jika data berhasil disimpan, redirect ke halaman sebelumnya
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    // Tutup koneksi database
    $koneksi->close();
}
?>
