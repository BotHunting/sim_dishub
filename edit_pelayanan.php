<?php
include_once 'config.php';

// Memeriksa apakah parameter id telah diberikan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Memeriksa apakah form telah disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Memeriksa apakah file foto baru diunggah
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $foto = $_FILES['foto']['name'];
            $temp = $_FILES['foto']['tmp_name'];

            // Pindahkan file yang diunggah ke direktori yang diinginkan
            move_uploaded_file($temp, "assets/img/servis/$foto");
        } else {
            // Jika tidak ada file yang diunggah, gunakan foto lama
            $sql = "SELECT foto FROM pelayanan_kantor WHERE id = $id";
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $foto = $row['foto'];
            }
        }

        // Memperbarui data pelayanan kantor di database
        $nama = $_POST['nama'];
        $jadwal = $_POST['jadwal'];
        $keterangan = $_POST['keterangan'];

        $sql_update = "UPDATE pelayanan_kantor SET nama='$nama', jadwal='$jadwal', keterangan='$keterangan', foto='$foto' WHERE id=$id";

        if ($koneksi->query($sql_update) === TRUE) {
            echo "Data berhasil diperbarui.";
        } else {
            echo "Terjadi kesalahan: " . $koneksi->error;
        }
    }

    // Mengambil data pelayanan kantor berdasarkan id
    $sql_select = "SELECT * FROM pelayanan_kantor WHERE id = $id";
    $result_select = $koneksi->query($sql_select);

    if ($result_select->num_rows > 0) {
        $row_select = $result_select->fetch_assoc();
        $nama = $row_select['nama'];
        $jadwal = $row_select['jadwal'];
        $keterangan = $row_select['keterangan'];
        $foto = $row_select['foto'];
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "Parameter id tidak ditemukan.";
}
?>

<?php include("header.php"); ?>
<main class="main">
    <div class="container mt-5">
        <h2>Edit Pelayanan</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="nama">Nama:</label><br>
            <input type="text" id="nama" class="form-control" name="nama" value="<?php echo $nama; ?>" required><br><br>

            <label for="jadwal">Jadwal:</label><br>
            <input type="text" id="jadwal" class="form-control" name="jadwal" value="<?php echo $jadwal; ?>" required><br><br>

            <label for="keterangan">Keterangan:</label><br>
            <textarea id="keterangan" class="form-control" name="keterangan" rows="4" required><?php echo $keterangan; ?></textarea><br><br>

            <label for="foto">Foto:</label><br>
            <input type="file" id="foto" class="form-control" name="foto" accept="image/*"><br><br>

            <img src="assets/img/servis/<?php echo $foto; ?>" alt="Foto Lama" width="200"><br><br>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="setting_pelayanan_kantor.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</main>
<?php include("footer.php"); ?>