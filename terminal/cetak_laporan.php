<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pendapatan Terminal</title>
    <link rel="icon" href="images/logo.png" type="image/png">
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

        .button-container button,
        .button-container a {
            padding: 10px 28px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            text-decoration: none;
            margin: 0 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.07);
        }

        .button-container button:hover,
        .button-container a:hover {
            background-color: #0056b3;
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
            <h1>Laporan Pendapatan Terminal</h1>
            <?php
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
            $nama_bulan = [
                '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
            ];
            ?>
            <h3>Petugas: <?php echo isset($petugas_data['nama']) ? $petugas_data['nama'] : 'Belum dipilih'; ?></h3>
            <h3>Bulan: <?php echo $nama_bulan[$bulan] . " " . $tahun; ?></h3>
        </header>
        <?php
        $asal_terminal = isset($_GET['asal_terminal']) ? $_GET['asal_terminal'] : '';
        $sql = "SELECT * FROM kendaraan_keluar WHERE MONTH(waktu_keberangkatan) = $bulan AND YEAR(waktu_keberangkatan) = $tahun";
        if (!empty($asal_terminal)) {
            $sql .= " AND asal_terminal = '$asal_terminal'";
        }
        $sql .= " ORDER BY waktu_keberangkatan";
        $result = $koneksi->query($sql);
        $total_retribusi = 0;
        ?>
        <table>
            <thead>
                <tr>
                    <th>Nomor Kendaraan</th>
                    <th>Trayek</th>
                    <th>Waktu Kedatangan</th>
                    <th>Jumlah Penumpang Masuk</th>
                    <th>Asal Terminal</th>
                    <th>Waktu Keberangkatan</th>
                    <th>Jumlah Penumpang Keluar</th>
                    <th>Tujuan Terminal</th>
                    <th>Retribusi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nomor_kendaraan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['trayek']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['waktu_kedatangan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['jumlah_penumpang_masuk']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['asal_terminal']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['waktu_keberangkatan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['jumlah_penumpang_keluar']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tujuan_terminal']) . "</td>";
                        echo "<td>Rp " . number_format($row['retribusi'], 0, ',', '.') . "</td>";
                        echo "</tr>";
                        $total_retribusi += $row['retribusi'];
                    }
                } else {
                    echo "<tr><td colspan='9'>Tidak ada data pendapatan untuk bulan ini.</td></tr>";
                }
                ?>
                <tr>
                    <td colspan="4"></td>
                    <th>Total Pendapatan</th>
                    <td colspan="4" style="text-align:left;">Rp <?php echo number_format($total_retribusi, 0, ',', '.'); ?></td>
                </tr>
            </tbody>
        </table>
        <div class="signature-container">
            <span class="jabatan"><?php echo isset($petugas_data['jabatan']) ? htmlspecialchars($petugas_data['jabatan']) : ''; ?></span><br>
            <?php echo isset($petugas_data['jadwal_kerja']) ? htmlspecialchars($petugas_data['jadwal_kerja']) : ''; ?><br>
            <br>
            <br>
            <span class="nama"><?php echo isset($petugas_data['nama']) ? htmlspecialchars($petugas_data['nama']) : ''; ?></span><br>
            NIP. <?php echo isset($petugas_data['nip']) ? htmlspecialchars($petugas_data['nip']) : ''; ?>
        </div>
    </div>
    <div class="button-container">
        <button type="button" onclick="window.print()">Cetak Laporan</button>
        <a href="#" onclick="window.close(); return false;">Kembali</a>
    </div>
</body>

</html>