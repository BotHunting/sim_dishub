<?php
require_once 'koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tanggal'])) {
    $tanggal = $_POST['tanggal'];
    function getRiwayatAbsensi($tanggal)
    {
        global $koneksi;
        $query = "SELECT * FROM riwayat_absensi WHERE tanggal_absensi = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("s", $tanggal);
        $stmt->execute();
        $result = $stmt->get_result();
        $riwayat_absensi = [];
        while ($row = $result->fetch_assoc()) {
            $riwayat_absensi[] = $row;
        }
        return $riwayat_absensi;
    }
    $riwayat_absensi = getRiwayatAbsensi($tanggal);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Absensi</title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
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
            margin: 5mm;
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
            width: 100px;
            height: 100px;
            z-index: -1;
        }

        .header-text {
            text-align: center;
            margin-bottom: 30px;
        }

        .ttd {
            text-align: center;
            margin-top: 50px;
        }

        .ttd p {
            margin: 0px 0;
        }

        .table {
            width: calc(100% - 20px);
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
            vertical-align: middle;
        }

        .table thead th {
            vertical-align: middle;
            border-bottom: 2px solid #dee2e6;
        }

        .paraf-checkbox {
            transform: scale(1.5);
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo-container">
            <img src="img/ff.png" alt="Logo" class="logo">
            <div class="header-text">
                <h2>PEMERINTAH KABUPATEN FAKFAK</h2>
                <h3>DINAS PERHUBUNGAN</h3>
                <p>Jl. Imam Bonjol No. 1 Telp. (0956) 22214 Fax. (0956) 222218</p>
                <p>Kotak Pos 171 Kode Pos 98613</p>
                <hr>
            </div>
        </div>
    </div>
    <h3 class="text-center">DAFTAR HADIR</h3>
    <div class="text-center">HARI / TANGGAL : <?php echo $tanggal; ?></div>
    <div class="text-center">BULAN/ TAHUN : <?php echo date('F Y'); ?></div>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA<br>
                    PANGKAT/ GOL<br>
                    NIP<br>
                </th>
                <th>JABATAN</th>
                <th>BIDANG</th>
                <th>PARAF</th>
                <th>WAKTU PAGI</th>
                <th>WAKTU SORE</th>
                <th>KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            <?php $no_absen = 1; ?>
            <?php foreach ($riwayat_absensi as $row) : ?>
                <tr>
                    <td><?php echo $no_absen++; ?></td>
                    <td>
                        <?php echo $row['nama']; ?><br>
                        <?php echo isset($row['pangkat']) ? $row['pangkat'] : ''; ?><br>
                        NIP. <?php echo isset($row['nip']) ? $row['nip'] : ''; ?>
                    </td>
                    <td><?php echo $row['jabatan']; ?></td>
                    <td><?php echo $row['bidang']; ?></td>
                    <td>
                        <?php if ($row['keterangan'] === 'hadir') : ?>
                            <input type="checkbox" class="paraf-checkbox" name="hadir[]" checked disabled>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $row['waktu_pagi']; ?></td>
                    <td><?php echo $row['waktu_sore']; ?></td>
                    <td><?php echo $row['keterangan']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="ttd">
        <p>KEPALA DINAS PERHUBUNGAN</p>
        <p>KABUPATEN FAKFAK</p>
        <br>
        <br>
        <p>T. HERU USWANAS, S.Sos. M.Si</p>
        <p>PEMBINA UTAMA MUDA (IV/c)</p>
        <p>NIP. 19670904 199610 1 002</p>
    </div>
    <div class="text-center mt-4">
        <button onclick="window.print()" class="btn btn-primary">Cetak</button>
        <a href="laporan_absensi.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>

</html>