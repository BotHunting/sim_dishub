<?php
include_once '../../config.php';
$id = $tanggal = $pengirim = $penerima = $judul = $isi = $file_google_drive = $status = "";
$error = "";

// Ambil data nama_seksi dari tabel seksi
$query_seksi = "SELECT * FROM seksi";
$result_seksi = mysqli_query($koneksi, $query_seksi);
$seksi_options = "";
if (mysqli_num_rows($result_seksi) > 0) {
    while ($row_seksi = mysqli_fetch_assoc($result_seksi)) {
        $seksi_options .= '<option value="' . $row_seksi["nama_seksi"] . '">' . $row_seksi["nama_seksi"] . '</option>';
    }
}

if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    $id = trim($_GET['id']);
    $query = "SELECT * FROM disposisi WHERE id = ?";
    if ($stmt = $koneksi->prepare($query)) {
        $stmt->bind_param("i", $param_id);
        $param_id = $id;
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $tanggal = $row['tanggal'];
                $pengirim = $row['pengirim'];
                $penerima = $row['penerima'];
                $judul = $row['judul'];
                $isi = $row['isi'];
                $file_google_drive = $row['file_google_drive'];  // Diperbarui
                $status = $row['status'];
            } else {
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
        }
    }
    $stmt->close();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menggunakan mysqli_real_escape_string untuk mencegah SQL Injection
    $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST["tanggal"]);
    $pengirim = mysqli_real_escape_string($koneksi, $_POST["pengirim"]);
    $penerima = mysqli_real_escape_string($koneksi, $_POST["penerima"]);
    $judul = mysqli_real_escape_string($koneksi, $_POST["judul"]);
    $isi = mysqli_real_escape_string($koneksi, $_POST["isi"]);
    $status = mysqli_real_escape_string($koneksi, $_POST["status"]);

    // Cek apakah ada link Google Drive baru
    $file_google_drive = mysqli_real_escape_string($koneksi, $_POST["file_google_drive"]);  // Menyimpan link

    // Update tanpa file upload jika tidak ada file baru
    if (!empty($file_google_drive)) {
        $query = "UPDATE disposisi SET tanggal=?, pengirim=?, penerima=?, judul=?, isi=?, file_google_drive=?, status=? WHERE id=?";
        if ($stmt = $koneksi->prepare($query)) {
            $stmt->bind_param("sssssssi", $tanggal, $pengirim, $penerima, $judul, $isi, $file_google_drive, $status, $id);
            if ($stmt->execute()) {
                header("location: disposisi.php");
                exit();
            } else {
                echo "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
            }
        }
    } else {
        $query = "UPDATE disposisi SET tanggal=?, pengirim=?, penerima=?, judul=?, isi=?, status=? WHERE id=?";
        if ($stmt = $koneksi->prepare($query)) {
            $stmt->bind_param("ssssssi", $tanggal, $pengirim, $penerima, $judul, $isi, $status, $id);
            if ($stmt->execute()) {
                header("location: disposisi.php");
                exit();
            } else {
                echo "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
            }
        }
    }
    $stmt->close();
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h2>Edit Disposisi</h2>
    <form method="post">
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>" required>
        </div>
        <div class="form-group">
            <label>Pengirim :</label>
            <select class="form-control" id="pengirim" name="pengirim">
                <?php echo $seksi_options; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Ditujukan ke :</label>
            <select class="form-control" id="penerima" name="penerima">
                <?php echo $seksi_options; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $judul; ?>" required>
        </div>
        <div class="form-group">
            <label for="isi">Isi Disposisi</label>
            <textarea class="form-control" id="isi" name="isi" rows="5" required><?php echo $isi; ?></textarea>
        </div>
        <div class="mb-3">
            <label>File Sebelumnya:</label>
            <?php if (!empty($file_google_drive)) : ?>
                <a href="<?php echo $file_google_drive; ?>" class="btn btn-info" target="_blank">Lihat File</a>
            <?php else : ?>
                <span class="text-muted">Tidak ada file sebelumnya</span>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label>Link Google Drive Baru (jika ingin diperbarui):</label>
            <input type="text" class="form-control" name="file_google_drive" value="<?php echo $file_google_drive; ?>" placeholder="Masukkan URL Google Drive">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Pending" <?php if ($status == 'Pending') echo 'selected'; ?>>Pending</option>
                <option value="Approved" <?php if ($status == 'Approved') echo 'selected'; ?>>Approved</option>
                <option value="Rejected" <?php if ($status == 'Rejected') echo 'selected'; ?>>Rejected</option>
            </select>
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
        <?php } ?>
    </form>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
