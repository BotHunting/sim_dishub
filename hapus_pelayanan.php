<?php
include_once 'config.php';

// Memeriksa apakah parameter id telah diberikan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Memeriksa apakah pengguna telah mengonfirmasi penghapusan
    if (isset($_POST['hapus'])) {
        // Menghapus data pelayanan kantor dari database
        $sql_delete = "DELETE FROM pelayanan_kantor WHERE id = $id";

        if ($koneksi->query($sql_delete) === TRUE) {
            echo "Data berhasil dihapus.";
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
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "Parameter id tidak ditemukan.";
}
?>

<?php include("header.php"); ?>
<div class="container mt-5">
    <h2>Hapus Pelayanan</h2>
    <p>Apakah Anda yakin ingin menghapus data pelayanan kantor berikut?</p>
    <p>Nama: <?php echo $nama; ?></p>
    <form action="" method="POST">
        <input type="submit" class="btn btn-primary" name="hapus" value="Ya">
        <a href="setting_pelayanan_kantor.php" class="btn btn-secondary">Tidak</a>
    </form>
</div>
<?php include("footer.php"); ?>