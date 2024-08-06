<?php
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $keterangan = $_POST['keterangan'];

    // Cek apakah file foto baru diupload
    if ($_FILES['foto']['name']) {
        // Hapus file foto lama jika ada
        $sql = "SELECT foto FROM testimoni_pegawai WHERE id = $id";
        $result = $koneksi->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (!empty($row['foto'])) {
                unlink("assets/img/team/" . $row['foto']);
            }
        }

        // Ambil nama file foto baru
        $foto = $_FILES['foto']['name'];

        // Pindahkan file foto baru ke folder yang ditentukan
        move_uploaded_file($_FILES['foto']['tmp_name'], "assets/img/team/" . $foto);
    } else {
        // Jika tidak ada foto baru diupload, gunakan foto lama
        $sql = "SELECT foto FROM testimoni_pegawai WHERE id = $id";
        $result = $koneksi->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $foto = $row['foto'];
        }
    }

    // Siapkan query SQL untuk melakukan update data testimoni pegawai
    $sql = "UPDATE testimoni_pegawai SET nama=?, jabatan=?, keterangan=?, foto=? WHERE id=?";
    if ($stmt = $koneksi->prepare($sql)) {
        // Bind parameter ke statement
        $stmt->bind_param("ssssi", $nama, $jabatan, $keterangan, $foto, $id);

        // Eksekusi statement
        if ($stmt->execute()) {
            // Redirect ke halaman testi_pegawai.php jika berhasil
            header("location: testi_pegawai.php");
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
