<?php
// Sertakan file koneksi.php untuk terhubung ke database
require_once('koneksi.php');

// Inisialisasi variabel
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
$lokasi = isset($_GET['lokasi']) ? $_GET['lokasi'] : '';

// Query untuk mengambil data laporan_parkir berdasarkan bulan, tahun, dan lokasi parkir
$sql = "SELECT * FROM laporan_parkir WHERE bulan_laporan = $bulan AND tahun_laporan = $tahun";
if (!empty($lokasi)) {
    $sql .= " AND lokasi_parkir = '$lokasi'";
}
$sql .= " ORDER BY waktu_keluar DESC";
$result = $koneksi->query($sql);

// Query untuk mengambil data petugas
$sql_petugas = "SELECT * FROM petugas_parkir WHERE id = '" . $_GET['petugas'] . "'";
$result_petugas = $koneksi->query($sql_petugas);
$petugas = $result_petugas->fetch_assoc();
$no = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Bulanan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            text-align: center;
        }

        th,
        td {
            padding: 10px;
        }

        th {
            background-color: #ffd73f;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button-container button:hover {
            background-color: #45a049;
        }

        .signature-container {
            margin-top: 50px;
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
        <h1>Laporan Bulanan</h1>
        <h3>Bulan: <?php echo date('F', mktime(0, 0, 0, $bulan, 1)) . " " . $tahun; ?></h3>
    </header>
    <table>
        <tr>
            <th>No.</th>
            <th>Nomor Kendaraan</th>
            <th>Jenis Kendaraan</th>
            <th>Waktu Masuk</th>
            <th>Waktu Keluar</th>
            <th>Biaya Parkir</th>
            <th>Lokasi Parkir</th>
            <th>Status</th>
            <th>Petugas</th>
        </tr>
        <?php
        // Inisialisasi variabel total_pemasukan untuk menghitung jumlah keseluruhan pemasukan bulanan
        $total_pemasukan = 0;

        // Periksa apakah ada baris data yang diambil dari database
        if ($result->num_rows > 0) {
            // Output data dari setiap baris
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row["nomor_kendaraan"] . "</td>";
                echo "<td>" . $row["jenis_kendaraan"] . "</td>";
                echo "<td>" . $row["waktu_masuk"] . "</td>";
                echo "<td>" . $row["waktu_keluar"] . "</td>";
                echo "<td>Rp " . $row["biaya_parkir"] . "</td>";
                echo "<td>" . $row["lokasi_parkir"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td>" . $row["nama"] . "</td>";
                echo "</tr>";

                // Tambahkan biaya parkir ke total pemasukan
                $total_pemasukan += $row["biaya_parkir"];
            }
        } else {
            echo "<tr><td colspan='7'>Tidak ada data laporan</td></tr>";
        }
        ?>
        <tr>
            <td colspan="4"></td>
            <th>Jumlah</th>
            <td>Rp <?php echo number_format($total_pemasukan, 0, ',', '.'); ?></td>
        </tr>
    </table>
    <!-- Petugas dan NIP untuk tanda tangan -->
    <div class="signature-container">
    <?php echo $petugas['jabatan']; ?><br>
    <?php echo $petugas['jadwal_kerja']; ?><br>
    <br>
    <br>
    <?php echo $petugas['nama']; ?><br>
    NIP. <?php echo $petugas['nip']; ?>
</div>

    <!-- Tombol untuk mencetak laporan -->
    <div class="button-container">
        <button onclick="cetakLaporan()">Cetak Laporan</button>
    </div>

    <!-- Script untuk menutup halaman setelah mencetak -->
    <script>
        function cetakLaporan() {
            window.print(); // Mencetak laporan
            setTimeout(function() {
                window.close(); // Menutup halaman setelah mencetak
            }, 1000); // Mengatur waktu penutupan setelah 1 detik
        }
    </script>
</body>

</html>

<?php
// Tutup koneksi database
$koneksi->close();
?>