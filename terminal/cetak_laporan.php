<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan</title>
    <link rel="icon" href="images/logo.png" type="image/png">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: auto;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            /* Rata tengah */
        }

        h1,
        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        table th {
            background-color: #f2f2f2;
        }

        .signature {
            margin-top: 20px;
            text-align: center;
        }

        button,
        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover,
        a:hover {
            background-color: #0056b3;
        }
    </style>
    <style>
        @media print {
            button,
            a {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Laporan Pendapatan</h1>
        <?php
        // Mengambil data petugas dari tabel petugas berdasarkan nip
        include_once 'koneksi.php';
        $bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
        $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

        $petugas_data = [];
        if (isset($_GET['petugas'])) {
            $nip = $_GET['petugas'];
            $sql_petugas = "SELECT * FROM petugas WHERE nip = '$nip'";
            $result_petugas = $koneksi->query($sql_petugas);
            if ($result_petugas->num_rows > 0) {
                $petugas_data = $result_petugas->fetch_assoc();
            }
        }
        ?>
        <h2>Petugas: <?php echo isset($petugas_data['nama']) ? $petugas_data['nama'] : 'Belum dipilih'; ?></h2>
        <h3>Bulan: <?php echo date('F', mktime(0, 0, 0, $bulan, 1)) . " " . $tahun; ?></h3>
        <?php
        // Mendefinisikan array untuk nama bulan
        $nama_bulan = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];
        // Mengambil bulan dan tahun dari parameter GET atau default ke bulan dan tahun ini
        $bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
        $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
        $asal_terminal = isset($_GET['asal_terminal']) ? $_GET['asal_terminal'] : '';

        // Membuat query berdasarkan parameter yang dipilih
        $sql = "SELECT * FROM kendaraan_keluar WHERE MONTH(waktu_keberangkatan) = $bulan AND YEAR(waktu_keberangkatan) = $tahun";
        if (!empty($asal_terminal)) {
            $sql .= " AND asal_terminal = '$asal_terminal'";
        }
        $sql .= " ORDER BY waktu_keberangkatan";

        // Menjalankan query
        $result = $koneksi->query($sql);
        $total_retribusi = 0;

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Nomor Kendaraan</th>";
            echo "<th>Trayek</th>";
            echo "<th>Waktu Kedatangan</th>";
            echo "<th>Jumlah Penumpang Masuk</th>";
            echo "<th>Asal Terminal</th>";
            echo "<th>Waktu Keberangkatan</th>";
            echo "<th>Jumlah Penumpang Keluar</th>";
            echo "<th>Tujuan Terminal</th>";
            echo "<th>Retribusi</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['nomor_kendaraan'] . "</td>";
                echo "<td>" . $row['trayek'] . "</td>";
                echo "<td>" . $row['waktu_kedatangan'] . "</td>";
                echo "<td>" . $row['jumlah_penumpang_masuk'] . "</td>";
                echo "<td>" . $row['asal_terminal'] . "</td>";
                echo "<td>" . $row['waktu_keberangkatan'] . "</td>";
                echo "<td>" . $row['jumlah_penumpang_keluar'] . "</td>";
                echo "<td>" . $row['tujuan_terminal'] . "</td>";
                echo "<td>Rp " . number_format($row['retribusi'], 0, ',', '.') . "</td>";
                echo "</tr>";
                $total_retribusi += $row['retribusi'];
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>Tidak ada data pendapatan untuk bulan ini.</p>";
        }
        ?>
        <!-- Total Pendapatan -->
        <h2>Total Pendapatan: Rp <?php echo isset($total_retribusi) ? number_format($total_retribusi, 0, ',', '.') : '0'; ?></h2>
        <div class="signature">
            <p>Dibuat oleh,</p>
            <?php echo isset($petugas_data['jabatan']) ? $petugas_data['jabatan'] : ''; ?><br>
            <?php echo isset($petugas_data['jadwal_kerja']) ? $petugas_data['jadwal_kerja'] : ''; ?><br>
            <br>
            <br>
            <?php echo isset($petugas_data['nama']) ? $petugas_data['nama'] : ''; ?><br>
            NIP. <?php echo isset($petugas_data['nip']) ? $petugas_data['nip'] : ''; ?><br>
        </div>
    </div>
    <button type="button" onclick="window.print()">Cetak Laporan</button>
    <a href="#" onclick="window.close();">Kembali</a>
</body>

</html>