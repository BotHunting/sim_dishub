<?php
require_once 'koneksi.php';

// Inisialisasi variabel untuk menyimpan data pegawai berdasarkan jabatan, seksi, atau bidang
$data = [];

// Periksa apakah parameter sort telah diterima melalui URL
if (isset($_GET['sort'])) {
    $sortBy = $_GET['sort'];

    // Query untuk mengambil data jumlah pegawai berdasarkan jabatan, seksi, atau bidang
    $query = "SELECT $sortBy, SUM(jumlah_pegawai) as total FROM jabatan GROUP BY $sortBy";
    $result = $koneksi->query($query);

    // Periksa apakah query berhasil dijalankan
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[$row[$sortBy]] = $row['total'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - SDM</title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php include_once 'header.php'; ?>
    <div class="container mt-5">
        <h1>Data SDM</h1>
        <div class="mb-3">
            <a href="sdm.php?sort=nama_jabatan" class="btn btn-primary">Sortir berdasarkan Jabatan</a>
            <a href="sdm.php?sort=seksi" class="btn btn-primary">Sortir berdasarkan Seksi</a>
            <a href="sdm.php?sort=bidang" class="btn btn-primary">Sortir berdasarkan Bidang</a>
        </div>
        <canvas id="pegawaiChart"></canvas>
        <div class="table-responsive">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th><?php echo isset($sortBy) ? ucfirst($sortBy) : ''; ?></th>
                        <th>Jumlah Pegawai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($data)) {
                        $i = 1;
                        foreach ($data as $key => $value) :
                    ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $key; ?></td>
                                <td><?php echo $value; ?></td>
                            </tr>
                    <?php endforeach;
                    } else {
                        echo '<tr><td colspan="3">Tidak ada data</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
            <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
        </div>
        <script>
            var ctx = document.getElementById('pegawaiChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo isset($data) ? json_encode(array_keys($data)) : '[]'; ?>,
                    datasets: [{
                        label: 'Jumlah Pegawai',
                        data: <?php echo isset($data) ? json_encode(array_values($data)) : '[]'; ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
    </div>
    <div style="height: 100px;"></div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>