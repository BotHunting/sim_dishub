<?php
session_start();
require_once 'koneksi.php';

// Fungsi untuk mengacak waktu pagi
function acak_waktu_pagi()
{
    $jam = 7;
    $menit = rand(0, 30);
    return sprintf("%02d:%02d", $jam, $menit);
}

// Fungsi untuk mengacak waktu sore
function acak_waktu_sore()
{
    $jam = 16;
    $menit = rand(30, 59);
    return sprintf("%02d:%02d", $jam, $menit);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['simpan'])) {
    $tanggal = $_POST['tanggal'];

    // Periksa apakah tanggal valid
    if (empty($tanggal)) {
        echo "<script>alert('Tanggal tidak boleh kosong.')</script>";
    } else {
        // Periksa apakah sudah ada data pada hari yang sama
        $query_check_absensi = "SELECT COUNT(*) AS jumlah FROM riwayat_absensi WHERE tanggal_absensi = ?";
        $stmt_check_absensi = $koneksi->prepare($query_check_absensi);
        $stmt_check_absensi->bind_param("s", $tanggal);
        $stmt_check_absensi->execute();
        $result_check_absensi = $stmt_check_absensi->get_result();
        $row_check_absensi = $result_check_absensi->fetch_assoc();
        $jumlah_absensi = $row_check_absensi['jumlah'];

        // Jika sudah ada data, tampilkan notifikasi
        if ($jumlah_absensi > 0) {
            echo "<script>alert('Data absensi untuk tanggal tersebut sudah ada. Silakan hapus data terlebih dahulu.')</script>";
        } else {
            // Jika belum ada data, lanjutkan dengan menyimpan data absensi
            $pegawai_ids = $_POST['pegawai'];
            foreach ($pegawai_ids as $pegawai_id) {
                $status = $_POST['status_' . $pegawai_id];
                $query_pegawai_info = "SELECT nama, pangkat, nip, jabatan, bidang FROM pegawai WHERE id = ?";
                $stmt_pegawai_info = $koneksi->prepare($query_pegawai_info);
                $stmt_pegawai_info->bind_param("i", $pegawai_id);
                $stmt_pegawai_info->execute();
                $result_pegawai_info = $stmt_pegawai_info->get_result();
                if ($result_pegawai_info->num_rows === 1) {
                    $row_pegawai_info = $result_pegawai_info->fetch_assoc();
                    $nama = $row_pegawai_info['nama'];
                    $pangkat = $row_pegawai_info['pangkat'];
                    $nip = $row_pegawai_info['nip'];
                    $jabatan = $row_pegawai_info['jabatan'];
                    $bidang = $row_pegawai_info['bidang'];
                    $query_simpan_absensi = "INSERT INTO riwayat_absensi (nama, pangkat, nip, jabatan, bidang, waktu_pagi, waktu_sore, keterangan, tanggal_absensi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt_simpan_absensi = $koneksi->prepare($query_simpan_absensi);
                    $stmt_simpan_absensi->bind_param("sssssssss", $nama, $pangkat, $nip, $jabatan, $bidang, $waktu_pagi, $waktu_sore, $status, $tanggal);
                    $waktu_pagi = ($status === 'hadir') ? acak_waktu_pagi() : '00:00';
                    $waktu_sore = ($status === 'hadir') ? acak_waktu_sore() : '00:00';
                    $stmt_simpan_absensi->execute();
                }
            }
            header("Location: absensi.php");
            exit();
        }
    }
}

// Jika tombol "Hapus" ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus'])) {
    if (isset($_POST['tanggal_hapus'])) {
        $tanggal_hapus = $_POST['tanggal_hapus'];
        $query_hapus_absensi = "DELETE FROM riwayat_absensi WHERE tanggal_absensi = ?";
        $stmt_hapus_absensi = $koneksi->prepare($query_hapus_absensi);
        $stmt_hapus_absensi->bind_param("s", $tanggal_hapus);
        $stmt_hapus_absensi->execute();
        header("Location: absensi.php");
        exit();
    } else {
        echo "<script>alert('Pilih tanggal untuk menghapus data absensi.')</script>";
    }
}

$query_pegawai = "SELECT id, nama FROM pegawai";
$stmt = $koneksi->prepare($query_pegawai);
$stmt->execute();
$result_pegawai = $stmt->get_result();
$pegawai_list = [];
if ($result_pegawai && $result_pegawai->num_rows > 0) {
    while ($row_pegawai = $result_pegawai->fetch_assoc()) {
        $pegawai_list[] = $row_pegawai;
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1 class="mb-4">Absensi Pegawai</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <div class="form-group">
            <label>Pilih Pegawai:</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="select-all">
                <label class="form-check-label" for="select-all">Pilih Semua</label>
            </div>
            <div>
                <?php foreach ($pegawai_list as $pegawai) : ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="pegawai[]" value="<?php echo htmlspecialchars($pegawai['id']); ?>" id="pegawai_<?php echo htmlspecialchars($pegawai['id']); ?>">
                        <label class="form-check-label" for="pegawai_<?php echo htmlspecialchars($pegawai['id']); ?>">
                            <?php echo htmlspecialchars($pegawai['nama']); ?>
                        </label>
                        <select class="form-control" name="status_<?php echo htmlspecialchars($pegawai['id']); ?>">
                            <option value="hadir">Hadir</option>
                            <option value="Izin">Izin</option>
                            <option value="Cuti">Cuti</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Dinas Luar">Dinas Luar</option>
                            <option value="Tanpa Keterangan">Keterangan</option>
                        </select>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal">Hapus</button>
        <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusModalLabel">Hapus Data Absen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="modal-body">
                    <label for="tanggal_hapus">Tanggal untuk Menghapus Data:</label>
                    <input type="date" class="form-control" id="tanggal_hapus" name="tanggal_hapus" required>
                    <p>Apakah Anda yakin ingin menghapus semua data absensi untuk tanggal tersebut?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('select-all').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('[name="pegawai[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = this.checked;
        }.bind(this));
    });

    // Set value of 'tanggal_hapus' input field when modal shown
    $('#hapusModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var tanggal = document.getElementById('tanggal').value;
        var modal = $(this);
        modal.find('.modal-body #tanggal_hapus').val(tanggal);
    });
</script>

<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>