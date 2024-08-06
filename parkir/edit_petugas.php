<?php include_once 'header.php'; ?>

<div class="container">
    <h1>Edit Petugas</h1>
    <?php
    include_once 'koneksi.php';

    $id = $_GET['id'];
    $sql = "SELECT * FROM petugas_parkir WHERE id = ?";
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
    ?>
            <form action="proses_edit_petugas.php" method="post" id="petugasForm" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP:</label>
                    <input type="text" class="form-control" id="nip" name="nip" value="<?php echo $row['nip']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan:</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $row['jabatan']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="jadwal_kerja" class="form-label">Jadwal Kerja:</label>
                    <select class="form-select" id="jadwal_kerja" name="jadwal_kerja">
                        <?php
                        // Query untuk mengambil data parkir dari database
                        $sql = "SELECT * FROM parkir";
                        $result = $koneksi->query($sql);

                        if ($result->num_rows > 0) {
                            while ($terminal = $result->fetch_assoc()) {
                                $selected = ($terminal['lokasi'] == $row['jadwal_kerja']) ? 'selected' : '';
                                echo "<option value='" . $terminal['lokasi'] . "' $selected>" . $terminal['lokasi'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Tidak ada terminal.</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon :</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo $row['telepon']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto:</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="tambah_petugas.php" class="btn btn-secondary">Kembali</a>
            </form>
    <?php
        } else {
            echo "Data petugas tidak ditemukan.";
        }
        $stmt->close();
    }
    ?>
</div>
<?php include_once 'footer.php'; ?>