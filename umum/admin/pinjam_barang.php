<?php
include_once 'header.php';
require_once 'koneksi.php';

// Ambil data barang dari tabel pengelolaan
$sql_barang = "SELECT * FROM pengelolaan";
$result_barang = $koneksi->query($sql_barang);

// Ambil data pegawai dari tabel pegawai
$sql_pegawai = "SELECT * FROM pegawai";
$result_pegawai = $koneksi->query($sql_pegawai);

// Proses form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi data yang dikirim dari form
    $id_barang = $_POST['id_barang'];
    $id_pegawai = $_POST['id_pegawai'];

    // Simpan data peminjaman ke dalam tabel pinjaman
    $sql_insert = "INSERT INTO pinjaman (id_barang, id_pegawai) VALUES ('$id_barang', '$id_pegawai')";
    if ($koneksi->query($sql_insert) === TRUE) {
        echo "<script>alert('Peminjaman berhasil disimpan');</script>";
    } else {
        echo "<script>alert('Error: " . $sql_insert . "<br>" . $koneksi->error . "');</script>";
    }
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pinjam Barang</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <label for="id_barang" class="form-label">Pilih Barang:</label>
                            <select class="form-control" id="id_barang" name="id_barang">
                                <option selected disabled>-- Pilih Barang --</option>
                                <?php
                                if ($result_barang && $result_barang->num_rows > 0) {
                                    while ($row_barang = $result_barang->fetch_assoc()) {
                                        echo "<option value='" . $row_barang['id'] . "'>" . htmlspecialchars($row_barang['nama_barang']) . "</option>";
                                    }
                                } else {
                                    echo "<option disabled>Tidak ada barang tersedia</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_pegawai" class="form-label">Pilih Pegawai:</label>
                            <select class="form-control" id="id_pegawai" name="id_pegawai">
                                <option selected disabled>-- Pilih Pegawai --</option>
                                <?php
                                if ($result_pegawai && $result_pegawai->num_rows > 0) {
                                    while ($row_pegawai = $result_pegawai->fetch_assoc()) {
                                        echo "<option value='" . $row_pegawai['id'] . "'>" . htmlspecialchars($row_pegawai['nama']) . "</option>";
                                    }
                                } else {
                                    echo "<option disabled>Tidak ada pegawai tersedia</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="peminjaman.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
