<?php
include_once 'koneksi.php';
$id = $nomor_surat = $tanggal = $pengirim = $penerima = $subjek = $isi = $status = $file_upload = "";
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
    $query = "SELECT * FROM suratmenyurat WHERE id = ?";
    if ($stmt = $koneksi->prepare($query)) {
        $stmt->bind_param("i", $param_id);
        $param_id = $id;
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $nomor_surat = $row['nomor_surat'];
                $tanggal = $row['tanggal'];
                $pengirim = $row['pengirim'];
                $penerima = $row['penerima'];
                $subjek = $row['subjek'];
                $isi = $row['isi'];
                $status = $row['status'];
                $file_upload = $row['file_upload'];
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
    $id = $_POST["id"];
    $nomor_surat = $_POST["nomor_surat"];
    $tanggal = $_POST["tanggal"];
    $pengirim = $_POST["pengirim"];
    $penerima = $_POST["penerima"];
    $subjek = $_POST["subjek"];
    $isi = $_POST["isi"];
    $status = $_POST["status"];
    if ($_FILES["file_upload"]["name"] != '') {
        $file_name = basename($_FILES["file_upload"]["name"]);
        $file_temp = $_FILES["file_upload"]["tmp_name"];
        $file_type = $_FILES["file_upload"]["type"];
        $target_dir = "lib/surat/";
        $new_file_name = $pengirim . "_" . $id . "_ACC." . pathinfo($file_name, PATHINFO_EXTENSION);
        $target_file = $target_dir . $new_file_name;
        if (!empty($file_upload)) {
            unlink("lib/surat/" . $file_upload);
        }
        if (move_uploaded_file($file_temp, $target_file)) {
            $query = "UPDATE suratmenyurat SET nomor_surat=?, tanggal=?, pengirim=?, penerima=?, subjek=?, isi=?, status=?, file_upload=? WHERE id=?";
            if ($stmt = $koneksi->prepare($query)) {
                $stmt->bind_param("ssssssssi", $nomor_surat, $tanggal, $pengirim, $penerima, $subjek, $isi, $status, $new_file_name, $param_id);
                $param_id = $id;
                if ($stmt->execute()) {
                    header("location: surat_menyurat.php");
                    exit();
                } else {
                    echo "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
                }
            }
        } else {
            $error = "Terjadi kesalahan saat mengupload file.";
        }
    } else {
        $query = "UPDATE suratmenyurat SET nomor_surat=?, tanggal=?, pengirim=?, penerima=?, subjek=?, isi=?, status=? WHERE id=?";
        if ($stmt = $koneksi->prepare($query)) {
            $stmt->bind_param("sssssssi", $nomor_surat, $tanggal, $pengirim, $penerima, $subjek, $isi, $status, $param_id);
            $param_id = $id;
            if ($stmt->execute()) {
                header("location: surat_menyurat.php");
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
    <h2>Edit Surat</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nomor_surat">Nomor Surat</label>
            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="<?php echo $nomor_surat; ?>" required>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>" required>
        </div>
        <div class="form-group">
            <label>Pengirim :</label>
            <select class="form-control" name="pengirim">
                <?php echo $seksi_options; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="penerima">Ditujukan Ke</label>
            <input type="text" class="form-control" id="penerima" name="penerima" value="<?php echo $penerima; ?>" required>
        </div>
        <div class="form-group">
            <label for="subjek">Subjek</label>
            <input type="text" class="form-control" id="subjek" name="subjek" value="<?php echo $subjek; ?>" required>
        </div>
        <div class="form-group">
            <label for="isi">Isi Surat</label>
            <textarea class="form-control" id="isi" name="isi" rows="5" required><?php echo $isi; ?></textarea>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Draft" <?php if ($status == 'Draft') echo 'selected'; ?>>Draft</option>
                <option value="Sent" <?php if ($status == 'Sent') echo 'selected'; ?>>Sent</option>
            </select>
        </div>
        <div class="mb-3">
            <label>File Sebelumnya:</label>
            <?php if (!empty($row['file_upload'])) : ?>
                <a href="lib/surat/<?php echo $row['file_upload']; ?>" class="btn btn-info" target="_blank">Lihat File</a>
            <?php else : ?>
                <span class="text-muted">Tidak ada file sebelumnya</span>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label>Upload File Baru (jika ingin diperbarui):</label>
            <input type="file" class="form-control-file" name="file">
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>