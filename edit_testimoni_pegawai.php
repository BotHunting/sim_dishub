<?php
// Include file konfigurasi database
include_once 'config.php';

// Deklarasi variabel id dan inisialisasi dengan nilai kosong
$id = "";

// Cek apakah parameter id telah diterima dari URL
if (isset($_GET['id'])) {
    // Jika ya, simpan nilai id ke dalam variabel $id
    $id = $_GET['id'];
} else {
    // Jika tidak, redirect pengguna ke halaman lain atau tampilkan pesan kesalahan
    header("Location: index.php");
    exit(); // Hentikan eksekusi skrip
}

// Deklarasi variabel untuk menyimpan data testimoni pegawai
$nama = $jabatan = $keterangan = $foto = "";

// Query untuk mengambil data testimoni pegawai berdasarkan id
$sql = "SELECT * FROM testimoni_pegawai WHERE id = $id";
$result = $koneksi->query($sql);

// Periksa apakah query berhasil dieksekusi dan data ditemukan
if ($result->num_rows > 0) {
    // Ambil data dari hasil query dan simpan ke dalam variabel
    $row = $result->fetch_assoc();
    $nama = $row['nama'];
    $jabatan = $row['jabatan'];
    $keterangan = $row['keterangan'];
    $foto = $row['foto'];
} else {
    // Jika data tidak ditemukan, redirect pengguna atau tampilkan pesan kesalahan
    echo "Data tidak ditemukan.";
    exit(); // Hentikan eksekusi skrip
}
?>

<?php include("header.php"); ?>
<div class="container mt-5">
    <h2 class="mb-4">Edit Testimoni Pegawai</h2>
    <div class="row">
        <form action="proses_edit_testimoni_pegawai.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div>
                <label for="nama">Nama:</label><br>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" required><br><br>
            </div>
            <div>
                <label for="jabatan">Jabatan:</label><br>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $jabatan; ?>" required><br><br>
            </div>
            <div>
                <label for="keterangan">Keterangan:</label><br>
                <textarea id="keterangan" class="form-control" name="keterangan" rows="4" required><?php echo $keterangan; ?></textarea><br><br>
            </div>
            <div>
                <label for="foto">Foto:</label><br><br>
                <img src="assets/img/team/<?php echo $foto; ?>" alt="Foto Lama" style="max-width: 200px;"><br><br>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*"><br><br>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="testi_pegawai.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
<?php include("footer.php"); ?>