<?php
// Pastikan sesi dimulai
session_start();

// Include koneksi ke database
require_once '../../config.php';

// Periksa apakah id barang telah diberikan melalui parameter URL
if (isset($_GET['id'])) {
    // Gunakan fungsi mysqli_real_escape_string untuk menghindari SQL Injection
    $id_barang = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Ambil detail barang dari database berdasarkan id yang diberikan
    $query = "SELECT * FROM pengelolaan WHERE id = '$id_barang'";
    $result = $koneksi->query($query);

    // Periksa apakah query berhasil dijalankan
    if ($result && $result->num_rows > 0) {
        $barang = $result->fetch_assoc();

        // Proses form jika tombol "Update" ditekan
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil data dari form dan gunakan fungsi mysqli_real_escape_string
            $nomor_inventaris = mysqli_real_escape_string($koneksi, $_POST['nomor_inventaris']);
            $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
            $jumlah = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
            $kondisi = mysqli_real_escape_string($koneksi, $_POST['kondisi']);
            $tahun = mysqli_real_escape_string($koneksi, $_POST['tahun']);

            // Upload foto baru jika ada
            if ($_FILES['foto']['name']) {
            } else {
                // Jika tidak ada foto yang diunggah, hanya update informasi barang lainnya
                $query = "UPDATE pengelolaan SET nomor_inventaris='$nomor_inventaris', nama_barang='$nama_barang', jumlah='$jumlah', kondisi='$kondisi', tahun='$tahun' WHERE id='$id_barang'";
                if ($koneksi->query($query) === TRUE) {
                    // Redirect ke halaman pengelolaan barang setelah berhasil
                    header("Location: pengelolaan.php");
                    exit();
                } else {
                    // Jika gagal, tampilkan pesan error
                    echo "Error: " . $query . "<br>" . $koneksi->error;
                }
            }
        }
    } else {
        // Jika id barang tidak ditemukan dalam database, tampilkan pesan error
        echo "Barang tidak ditemukan.";
    }
} else {
    // Jika id barang tidak disediakan dalam parameter URL, tampilkan pesan error
    echo "ID barang tidak diberikan.";
}
?>

<?php include_once 'header.php'; ?>
<div class="container">
    <h1 class="mt-5">Edit Barang</h1>
    <div class="row mt-4">
        <div class="col-md-6">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nomor_inventaris">Nomor Inventaris:</label>
                    <input type="text" class="form-control" id="nomor_inventaris" name="nomor_inventaris" value="<?php echo $barang['nomor_inventaris']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="nama_barang">Nama Barang:</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo $barang['nama_barang']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah:</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $barang['jumlah']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="kondisi">Kondisi:</label>
                    <select class="form-control" id="kondisi" name="kondisi" required>
                        <option value="Baik" <?php if ($barang['kondisi'] == 'Baik') echo 'selected'; ?>>Baik</option>
                        <option value="Rusak" <?php if ($barang['kondisi'] == 'Rusak') echo 'selected'; ?>>Rusak</option>
                        <option value="Rusak Berat" <?php if ($barang['kondisi'] == 'Rusak Berat') echo 'selected'; ?>>Rusak Berat</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun:</label>
                    <input type="year" class="form-control" id="tahun" name="tahun" value="<?php echo $barang['tahun']; ?>" required>
                </div>
                <div class="mb-3">
                    <label>Foto Sebelumnya:</label>
                    <?php if (!empty($barang['foto'])) : ?>
                        <img src="../pengelolaan/<?php echo $barang['foto']; ?>" class="img-fluid" alt="Foto Sebelumnya">
                    <?php else : ?>
                        <span class="text-muted">Tidak ada foto sebelumnya</span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label>Upload File Baru (jika ingin diperbarui):</label>
                    <input type="file" class="form-control-file" id="foto" name="foto">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>