<?php
session_start();
require_once 'koneksi.php';
$tanggal = $_POST['tanggal'];
$pegawai_ids = $_POST['pegawai'];
function acak_waktu_pagi($status)
{
    // Jika absen bukan 'hadir', kembalikan '00:00'
    if ($status !== 'hadir') {
        return '00:00';
    }

    $jam = 7; // Tetapkan jam 07
    $menit = rand(0, 30); // Acak menit antara 0 dan 30
    return sprintf("%02d:%02d", $jam, $menit);
}
function acak_waktu_sore($status)
{
    // Jika absen bukan 'hadir', kembalikan '00:00'
    if ($status !== 'hadir') {
        return '00:00';
    }
    $jam = 16; // Tetapkan jam 16
    $menit = rand(30, 59); // Acak menit antara 30 dan 59
    return sprintf("%02d:%02d", $jam, $menit);
}
$query_absensi = "SELECT * FROM pegawai WHERE id IN (" . implode(',', $pegawai_ids) . ") ORDER BY FIELD(bidang, 'Kepala Dinas', 'Sekretariat', 'Prasarana', 'Lalu Lintas dan Angkutan', 'Pengembangan dan Keselamatan'), jabatan ASC";
$query_absensi = "SELECT * FROM pegawai WHERE id IN (" . implode(',', $pegawai_ids) . ") ORDER BY FIELD(seksi, 'Kepala Dinas', 'Sekertaris', 'Sub Bagian Umum', 'Sub Bagian Perencanaan dan Pelaporan', 'Bidang Lalu Lintas dan Angkutan', 'Seksi Lalu Lintas', 'Seksi Angkutan', 'Seksi Pengujian Sarana', 'Bidang Prasarana', 'Seksi Perencanaan Prasarana', 'Seksi Pembangunan Prasarana', 'Seksi Pengoperasian Prasarana', 'Seksi Pengelolan Perparkiran', 'Bidang Pengembangan dan Keselamatan', 'Seksi Pemanduan Moda dan Teknologi Perhubungan', 'Seksi Lingkungan Perhubungan', 'Seksi Keselamatan', 'UPTD Pengujian Kendaraan Bermotor', 'Sub Bagian Tata Usaha UPTD Pengujian Kendaraan Bermotor', 'Penguji Kendaraan Bermotor'), jabatan ASC";
$result_absensi = $koneksi->query($query_absensi);
$no_absen = 1;
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
            <?php while ($row = $result_absensi->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $no_absen++; ?></td>
                    <td>
                        <?php echo $row['nama']; ?><br>
                        <?php echo $row['pangkat']; ?><br>
                        NIP. <?php echo $row['nip']; ?>
                    </td>
                    <td><?php echo $row['jabatan']; ?></td>
                    <td><?php echo $row['bidang']; ?></td>
                    <td>
                        <?php if (isset($_POST['status_' . $row['id']])) : ?>
                            <?php if ($_POST['status_' . $row['id']] === 'hadir') : ?>
                                <input type="checkbox" class="paraf-checkbox" name="hadir[]" checked disabled>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                    <td><?php echo acak_waktu_pagi($_POST['status_' . $row['id']]); ?></td>
                    <td><?php echo acak_waktu_sore($_POST['status_' . $row['id']]); ?></td>
                    <td>
                        <?php if (isset($_POST['status_' . $row['id']]) && $_POST['status_' . $row['id']] !== 'hadir') : ?>
                            <?php echo $_POST['status_' . $row['id']]; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
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
        <a href="absensi_form.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>

</html>