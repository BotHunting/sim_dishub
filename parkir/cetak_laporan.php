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
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
            padding: 30px 40px 20px 40px;
            border-radius: 8px;
        }

        header {
            text-align: center;
            margin-bottom: 30px;
        }

        header h1 {
            margin: 0;
            font-size: 2rem;
            color: #333;
        }

        header h3 {
            margin: 10px 0 0 0;
            font-size: 1.1rem;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
            background: #fff;
        }

        th,
        td {
            border: 1px solid #e0e0e0;
            padding: 8px 6px;
            text-align: center;
        }

        th {
            background-color: #ffd73f;
            color: #333;
        }

        tr:nth-child(even) td {
            background: #fafafa;
        }

        .signature-container {
            margin-top: 40px;
            text-align: right;
            font-size: 1rem;
        }

        .signature-container .jabatan {
            font-weight: bold;
        }

        .signature-container .nama {
            margin-top: 40px;
            font-weight: bold;
        }

        .button-container {
            text-align: center;
            margin-top: 30px;
        }

        .button-container button {
            padding: 10px 28px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.07);
        }

        .button-container button:hover {
            background-color: #45a049;
        }

        @media print {
            .button-container,
            button,
            a {
                display: none !important;
            }

            .container {
                box-shadow: none;
                padding: 0;
                margin: 0;
            }

            body {
                background: #fff;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>Laporan Bulanan Parkir</h1>
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
                    echo "<td>" . htmlspecialchars($row["nomor_kendaraan"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["jenis_kendaraan"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["waktu_masuk"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["waktu_keluar"]) . "</td>";
                    echo "<td>Rp " . number_format($row["biaya_parkir"], 0, ',', '.') . "</td>";
                    echo "<td>" . htmlspecialchars($row["lokasi_parkir"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["nama"]) . "</td>";
                    echo "</tr>";

                    // Tambahkan biaya parkir ke total pemasukan
                    $total_pemasukan += $row["biaya_parkir"];
                }
            } else {
                echo "<tr><td colspan='9'>Tidak ada data laporan</td></tr>";
            }
            ?>
            <tr>
                <td colspan="4"></td>
                <th>Jumlah</th>
                <td colspan="4" style="text-align:left;">Rp <?php echo number_format($total_pemasukan, 0, ',', '.'); ?></td>
            </tr>
        </table>
        <div class="signature-container">
            <span class="jabatan"><?php echo htmlspecialchars($petugas['jabatan']); ?></span><br>
            <?php echo htmlspecialchars($petugas['jadwal_kerja']); ?><br>
            <br>
            <br>
            <span class="nama"><?php echo htmlspecialchars($petugas['nama']); ?></span><br>
            NIP. <?php echo htmlspecialchars($petugas['nip']); ?>
        </div>
    </div>
    <div class="button-container">
        <button onclick="cetakLaporan()">Cetak Laporan</button>
    </div>
    <script>
        function cetakLaporan() {
            window.print();
            setTimeout(function() {
                window.close();
            }, 1000);
        }
    </script>
</body>

</html>

<?php
// Tutup koneksi database
$koneksi->close();
?>