<?php
require_once '../../config.php'; // Update to use config.php

// Memeriksa apakah ada data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memeriksa apakah data rentang waktu telah diterima
    if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
        // Mengambil data rentang waktu dari formulir sebelumnya
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        // Mengambil laporan inventaris berdasarkan rentang waktu yang dipilih
        $laporan_inventaris = getLaporanInventaris($start_date, $end_date);
    }

    // Mengambil data pembuat laporan yang dikirimkan sebelumnya
    $jabatan = $_POST['jabatan'];
    $nama = $_POST['nama'];
    $pangkat = $_POST['pangkat'];
    $nip = $_POST['nip'];
}

// Fungsi untuk mengambil laporan inventaris berdasarkan rentang waktu
function getLaporanInventaris($start_date, $end_date)
{
    global $koneksi;
    $query = "SELECT * FROM pengelolaan WHERE tahun BETWEEN ? AND ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $laporan_inventaris = [];
    while ($row = $result->fetch_assoc()) {
        $laporan_inventaris[] = $row;
    }
    return $laporan_inventaris;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Inventaris</title>
    <style>
        @page {
            size: A4;
            margin: 5mm 5mm 5mm 5mm;
        }

        @media print {
            .btn {
                display: none !important;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        p {
            margin-top: 0;
            margin-bottom: 0rem;
        }

        .logo-container {
            position: relative;
            margin-bottom: 20px;
        }

        .logo {
            position: absolute;
            top: 0;
            left: 0;
            width: 80px;
            height: 80px;
            z-index: -1;
        }

        .container {
            text-align: center;
            margin-bottom: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            vertical-align: middle;
            border-bottom: 2px solid #dee2e6;
        }

        img {
            max-width: 100px;
        }

        .ttd {
            text-align: center;
            margin-top: 50px;
        }

        .ttd p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo-container">
            <img src="img/ff.png" alt="Logo" class="logo">
            <div class="header-text">
                <h2>PEMERINTAH KABUPATEN FAKFAK</h2>
                <h3>DINAS PERHUBUNGAN</h3>
                <p>Jl. Imam Bonjol No. 1 Telp. (0956) 22214 Fax. (0956) 222218</p>
                <p>Kotak Pos 171 Kode Pos 98613</p>
                <hr>
            </div>
            <div class="header">
                <h3 class="text-center">Laporan Inventaris</h3>
                <p>Periode: <?php echo htmlspecialchars($_POST['start_date']) . ' - ' . htmlspecialchars($_POST['end_date']); ?>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Inventaris</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                        <th>Tahun</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($laporan_inventaris as $data) : ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($data['nomor_inventaris']); ?></td>
                            <td><?php echo htmlspecialchars($data['nama_barang']); ?></td>
                            <td><?php echo htmlspecialchars($data['jumlah']); ?></td>
                            <td><?php echo htmlspecialchars($data['kondisi']); ?></td>
                            <td><?php echo htmlspecialchars($data['tahun']); ?></td>
                            <td>
                                <?php if (!empty($data['foto'])) : ?>
                                    <img src="../pengelolaan/<?php echo htmlspecialchars($data['foto']); ?>" alt="Foto Barang">
                                <?php else : ?>
                                    Foto tidak tersedia
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="ttd">
                <p><?php echo strtoupper($jabatan); ?></p>
                <p>DINAS PERHUBUNGAN KABUPATEN FAKFAK</p>
                <br>
                <br>
                <br>
                <p><?php echo $nama; ?></p>
                <p><?php echo $pangkat; ?></p>
                <p>NIP. <?php echo $nip; ?></p>
            </div>
        </div>
        <div class="text-center mt-4">
            <button onclick="window.print()" class="btn btn-primary">Cetak</button>
            <a href="laporan_inventaris.php" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</body>

</html>