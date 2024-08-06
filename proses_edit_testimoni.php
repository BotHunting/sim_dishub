<?php
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $id = $_POST['id'];
    $sebutan = $_POST['sebutan'];
    $harga = $_POST['harga'];
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];
    $pejabat = $_POST['pejabat'];

    // Cek apakah file foto baru diupload
    if ($_FILES['foto']['name']) {
        // Hapus file foto lama jika ada
        if (!empty($_POST['foto_lama'])) {
            unlink("assets/img/trainers/" . $_POST['foto_lama']);
        }

        // Ambil ekstensi file foto baru
        $foto_extension = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

        // Gabungkan nama foto baru dengan nama testimoni
        $foto = $nama . "." . $foto_extension;

        // Pindahkan file foto baru ke folder yang ditentukan
        move_uploaded_file($_FILES['foto']['tmp_name'], "assets/img/trainers/" . $foto);
    } else {
        // Jika tidak ada foto baru diupload, gunakan foto lama
        $foto = $_POST['foto_lama'];
    }

    // Cek apakah file gambar baru diupload
    if ($_FILES['gambar']['name']) {
        // Hapus file gambar lama jika ada
        if (!empty($_POST['gambar_lama'])) {
            unlink("assets/img/pelayanan/" . $_POST['gambar_lama']);
        }

        // Ambil ekstensi file gambar baru
        $gambar_extension = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));

        // Gabungkan nama gambar baru dengan nama testimoni
        $gambar = $nama . "." . $gambar_extension;

        // Pindahkan file gambar baru ke folder yang ditentukan
        move_uploaded_file($_FILES['gambar']['tmp_name'], "assets/img/pelayanan/" . $gambar);
    } else {
        // Jika tidak ada gambar baru diupload, gunakan gambar lama
        $gambar = $_POST['gambar_lama'];
    }

    // Siapkan query SQL untuk melakukan update data testimoni
    $sql = "UPDATE testimoni_pelayanan SET sebutan=?, harga=?, nama=?, keterangan=?, pejabat=?, foto=?, gambar=? WHERE id=?";
    if ($stmt = $koneksi->prepare($sql)) {
        // Bind parameter ke statement
        $stmt->bind_param("sisssssi", $sebutan, $harga, $nama, $keterangan, $pejabat, $foto, $gambar, $id);

        // Eksekusi statement
        if ($stmt->execute()) {
            // Redirect ke halaman setting_pelayanan.php jika berhasil
            header("location: setting_pelayanan.php");
            exit();
        } else {
            // Tampilkan pesan kesalahan jika terjadi masalah dalam eksekusi statement
            echo "Terjadi kesalahan. Silakan coba lagi.";
        }
    }

    // Tutup statement
    $stmt->close();

    // Tutup koneksi database
    $koneksi->close();
} else {
    // Redirect ke halaman error jika tidak ada data yang dikirimkan melalui form
    header("location: error.php");
    exit();
}
?>
