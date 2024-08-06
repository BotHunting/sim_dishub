<?php
require_once('koneksi.php');

// Query untuk mengambil data kendaraan dari database
$sql_kendaraan = "SELECT * FROM kendaraan";
$result_kendaraan = $koneksi->query($sql_kendaraan);
$sql_petugas = "SELECT * FROM petugas";
$result_petugas = $koneksi->query($sql_petugas);

?>

<?php include("header.php"); ?>
<header class="text-center">
    <h1>Pembayaran Parkir</h1>
</header>
<div class="container">
    <form method="post" action="proses_pembayaran.php">
        <div class="mb-3"> <!-- Form untuk memilih kendaraan -->
            <label for="kendaraan" class="form-label">Pilih Kendaraan:</label>
            <select class="form-select" id="kendaraan" name="kendaraan" required>
                <option value="">Pilih Kendaraan</option>
                <?php
                while ($row_kendaraan = $result_kendaraan->fetch_assoc()) {
                    echo "<option value='" . $row_kendaraan["id"] . "' data-waktu-masuk='" . $row_kendaraan["waktu_masuk"] . "' data-lokasi='" . $row_kendaraan["lokasi_parkir"] . "'>" . $row_kendaraan["nomor_kendaraan"] . " - " . $row_kendaraan["jenis_kendaraan"] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3"> <!-- Form untuk menampilkan waktu masuk -->
            <label for="waktu_masuk" class="form-label">Waktu Masuk:</label>
            <input type="text" class="form-control" id="waktu_masuk" name="waktu_masuk" readonly>
        </div>
        <div class="mb-3"> <!-- Form untuk menampilkan biaya parkir -->
            <label for="biaya" class="form-label">Biaya yang Harus Dibayar:</label>
            <input type="text" class="form-control" id="biaya" name="biaya" readonly>
        </div>
        <div class="mb-3"> <!-- Form untuk menampilkan waktu_keluar -->
            <label for="waktu_keluar" class="form-label">Waktu Keluar:</label>
            <input type="text" class="form-control" id="waktu_keluar" name="waktu_keluar" readonly>
        </div>
        <div class="mb-3"> <!-- Form untuk menampilkan lokasi parkir -->
            <label for="lokasi_parkir" class="form-label">Lokasi Parkir:</label>
            <input type="text" class="form-control" id="lokasi_parkir" name="lokasi_parkir" readonly>
        </div>
        <div class="mb-3"> <!-- Form untuk memilih petugas -->
            <label for="petugas" class="form-label">Pilih Petugas:</label>
            <select class="form-select" id="petugas" name="petugas" required>
                <option value="">Pilih Petugas</option>
                <?php
                // Output data dari setiap baris petugas
                while ($row_petugas = $result_petugas->fetch_assoc()) {
                    echo "<option value='" . $row_petugas["id"] . "'>" . $row_petugas["nama"] . " - " . $row_petugas["jabatan"] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3"> <!-- Tombol untuk memproses pembayaran -->
            <input type="submit" class="btn btn-primary" value="Proses Pembayaran">
        </div>
    </form>
</div>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nomor Kendaraan</th>
                <th scope="col">Jenis Kendaraan</th>
                <th scope="col">Waktu Masuk</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Query untuk mengambil data kendaraan dari database, diurutkan berdasarkan waktu masuk secara descending
            $sql = "SELECT * FROM kendaraan ORDER BY waktu_masuk DESC";
            $result = $koneksi->query($sql);
            // Periksa apakah ada baris data yang diambil dari database
            if ($result && $result->num_rows > 0) {
                // Output data dari setiap baris
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nomor_kendaraan"] . "</td>"; // Kolom "nomor_plat" sesuai dengan struktur tabel kendaraan
                    echo "<td>" . $row["jenis_kendaraan"] . "</td>";
                    echo "<td>" . $row["waktu_masuk"] . "</td>";
                    echo "<td>" . $row["lokasi_parkir"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Tidak ada data kendaraan</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    const kendaraanSelect = document.getElementById('kendaraan');
    const biayaInput = document.getElementById('biaya');
    const waktu_keluarInput = document.getElementById('waktu_keluar');
    const lokasi_parkirInput = document.getElementById('lokasi_parkir');
    kendaraanSelect.addEventListener('change', function() {
        const waktuMasuk = new Date(kendaraanSelect.options[kendaraanSelect.selectedIndex].getAttribute('data-waktu-masuk'));
        // Mengatur waktu masuk ke dalam input waktu masuk
        document.getElementById('waktu_masuk').value = waktuMasuk.toLocaleString('id-ID');
        // Mengatur lokasi parkir dari data kendaraan yang dipilih
        const lokasiParkir = kendaraanSelect.options[kendaraanSelect.selectedIndex].getAttribute('data-lokasi');
        // Mengatur lokasi parkir ke dalam input lokasi parkir
        lokasi_parkirInput.value = lokasiParkir;
        // Mengatur tarif parkir per waktu_keluar berdasarkan jenis kendaraan
        let tarif;
        const jenisKendaraan = kendaraanSelect.options[kendaraanSelect.selectedIndex].text.split(' - ')[1]; // Mendapatkan jenis kendaraan dari opsi yang dipilih
        const durasiParkir = hitungDurasiParkir(waktuMasuk); // Menghitung durasi parkir dalam menit
        if (jenisKendaraan === 'Motor') {
            tarif = hitungBiayaParkirMotor(durasiParkir); // Hitung biaya parkir untuk motor
        } else if (jenisKendaraan === 'Mobil') {
            tarif = hitungBiayaParkirMobil(durasiParkir); // Hitung biaya parkir untuk mobil
        } else {
            tarif = 0; // Jika jenis kendaraan tidak dikenali
        }
        // Menetapkan nilai biaya awal
        biayaInput.value = tarif;
    });
    // Memuat waktu saat pertama kali halaman dimuat
    updateClock();
    // Mengupdate waktu_keluar setiap detik
    setInterval(updateClock, 1000);
    // Fungsi untuk mengupdate waktu_keluar
    function updateClock() {
        const now = new Date();
        const hour = now.getHours().toString().padStart(2, '0');
        const minute = now.getMinutes().toString().padStart(2, '0');
        const second = now.getSeconds().toString().padStart(2, '0');
        const currentTime = `${hour}:${minute}:${second}`;
        waktu_keluarInput.value = currentTime;
    }
    // Fungsi untuk menghitung durasi parkir dalam menit
    function hitungDurasiParkir(waktuMasuk) {
        const waktuKeluar = new Date();
        const durasi = Math.ceil((waktuKeluar - waktuMasuk) / (1000 * 60)); // Menghitung durasi dalam menit
        return durasi;
    }
    // Fungsi untuk menghitung biaya parkir untuk motor
    function hitungBiayaParkirMotor(durasiParkir) {
        let biaya = 0;
        if (durasiParkir <= 60) {
            biaya = 2000;
        } else {
            biaya = 2000 + Math.ceil((durasiParkir - 60) / 60) * 2000;
        }
        return biaya;
    }
    // Fungsi untuk menghitung biaya parkir untuk mobil
    function hitungBiayaParkirMobil(durasiParkir) {
        let biaya = 0;
        if (durasiParkir <= 60) {
            biaya = 3000;
        } else {
            biaya = 3000 + Math.ceil((durasiParkir - 60) / 60) * 3000;
        }
        return biaya;
    }
</script>
<?php
// Tutup koneksi database
$koneksi->close();
?>
<?php include("footer.php"); ?>