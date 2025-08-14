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
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - SDM</title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        body {
            background: #f8f9fa;
        }

        .card {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .btn-group .btn {
            min-width: 180px;
        }

        .chart-container {
            position: relative;
            height: 350px;
            margin-bottom: 30px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php include_once 'header.php'; ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title mb-4 text-center">Data SDM</h2>
                        <div class="btn-group d-flex justify-content-center mb-4" role="group">
                            <a href="sdm.php?sort=nama_jabatan" class="btn btn-primary">Jabatan</a>
                            <a href="sdm.php?sort=seksi" class="btn btn-primary">Seksi</a>
                            <a href="sdm.php?sort=bidang" class="btn btn-primary">Bidang</a>
                        </div>
                        <div class="chart-container">
                            <canvas id="pegawaiChart"></canvas>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mt-3 bg-white">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width:5%;">No.</th>
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
                                        echo '<tr><td colspan="3" class="text-center">Tidak ada data</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>