<?php
session_start();
require_once 'koneksi.php';

$error = '';
$jabatan_options = [];

$query_jabatan = "SELECT DISTINCT nama_jabatan FROM jabatan";
$result_jabatan = $koneksi->query($query_jabatan);

if ($result_jabatan && $result_jabatan->num_rows > 0) {
    while ($row_jabatan = $result_jabatan->fetch_assoc()) {
        $jabatan_options[] = $row_jabatan['nama_jabatan'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $pangkat = $_POST['pangkat'];
    $nip = $_POST['nip'];
    $jabatan = $_POST['jabatan'];
    $seksi = $_POST['seksi'];
    $bidang = $_POST['bidang'];

    if (empty($nama) || empty($pangkat) || empty($nip) || empty($jabatan) || empty($seksi) || empty($bidang)) {
        $error = "Semua kolom harus diisi";
    } else {
        $nama = $koneksi->real_escape_string($nama);
        $pangkat = $koneksi->real_escape_string($pangkat);
        $nip = $koneksi->real_escape_string($nip);
        $jabatan = $koneksi->real_escape_string($jabatan);
        $seksi = $koneksi->real_escape_string($seksi);
        $bidang = $koneksi->real_escape_string($bidang);

        // Buat query INSERT menggunakan prepared statement
        $query = "INSERT INTO pegawai (nama, pangkat, nip, jabatan, seksi, bidang) 
                  VALUES (?, ?, ?, ?, ?, ?)";

        // Persiapkan statement
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ssssss", $nama, $pangkat, $nip, $jabatan, $seksi, $bidang);

        // Eksekusi query
        if ($stmt->execute()) {
            header("Location: pegawai.php");
            exit;
        } else {
            $error = "Error: " . $koneksi->error;
        }
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1>Tambah Pegawai</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="pangkat">Pangkat:</label>
            <input type="text" class="form-control" id="pangkat" name="pangkat" required>
        </div>
        <div class="form-group">
            <label for="nip">NIP:</label>
            <input type="text" class="form-control" id="nip" name="nip" required oninput="this.value = this.value.replace(/[^0-9]/g, '');">
        </div>
        <div class="form-group">
            <label for="jabatan">Jabatan:</label>
            <select class="form-control" id="jabatan" name="jabatan" required>
                <option value="">Pilih Jabatan</option>
                <?php foreach ($jabatan_options as $jabatan) : ?>
                    <option value="<?php echo $jabatan; ?>"><?php echo $jabatan; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="seksi">Seksi:</label>
            <input type="text" class="form-control" id="seksi" name="seksi" required>
        </div>
        <div class="form-group">
            <label for="bidang">Bidang:</label>
            <input type="text" class="form-control" id="bidang" name="bidang" required>
        </div>
        <?php if ($error) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Tambah Pegawai</button>
        <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<script>
    document.getElementById('jabatan').addEventListener('change', function() {
        var jabatan = this.value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var bidangInput = document.getElementById('bidang');
                    bidangInput.value = xhr.responseText;
                }
            }
        };
        xhr.open('GET', 'get_bidang.php?jabatan=' + jabatan, true);
        xhr.send();
    });
</script>
<script>
    document.getElementById('jabatan').addEventListener('change', function() {
        var jabatan = this.value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var bidangInput = document.getElementById('seksi');
                    bidangInput.value = xhr.responseText;
                }
            }
        };
        xhr.open('GET', 'get_seksi.php?jabatan=' + jabatan, true);
        xhr.send();
    });
</script>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>