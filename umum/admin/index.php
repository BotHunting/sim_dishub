<?php include_once '../../config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegawai Area</title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            background: #f8f9fa;
        }

        .main-title {
            font-weight: 700;
            color: #2c3e50;
        }

        .lead {
            color: #34495e;
        }

        .card {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(44, 62, 80, 0.08);
            background: #fff;
        }

        .card.show {
            opacity: 1;
            transform: translateY(0);
        }

        .card:hover {
            box-shadow: 0 8px 24px rgba(44, 62, 80, 0.15);
            transform: translateY(-4px) scale(1.02);
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2980b9;
        }

        .btn-primary {
            background: linear-gradient(90deg, #2980b9 0%, #6dd5fa 100%);
            border: none;
            font-weight: 500;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #6dd5fa 0%, #2980b9 100%);
        }

        @media (max-width: 767px) {
            .row.mt-5>div {
                margin-bottom: 24px;
            }
        }
    </style>
</head>

<body>
    <?php include_once 'header.php'; ?>
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <h1 class="display-4 main-title">Halaman Pegawai</h1>
                <p class="lead">Selamat datang di halaman pegawai. Di sini Anda dapat mengelola konten website.</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-2x mb-3 text-primary"></i>
                        <h5 class="card-title">Kelola Pelayanan Masyarakat</h5>
                        <p class="card-text">Anda dapat mengelola pelayanan masyarakat di sini.</p>
                        <a href="pelayanan.php" class="btn btn-primary">Kelola</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-file-signature fa-2x mb-3 text-primary"></i>
                        <h5 class="card-title">Kelola Disposisi</h5>
                        <p class="card-text">Anda dapat mengelola disposisi di sini.</p>
                        <a href="disposisi.php" class="btn btn-primary">Kelola</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-envelope-open-text fa-2x mb-3 text-primary"></i>
                        <h5 class="card-title">Kelola Surat Menyurat</h5>
                        <p class="card-text">Anda dapat mengelola surat menyurat di sini.</p>
                        <a href="surat_menyurat.php" class="btn btn-primary">Kelola</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-boxes fa-2x mb-3 text-primary"></i>
                        <h5 class="card-title">Kelola Inventaris</h5>
                        <p class="card-text">Anda dapat mengelola inventaris di sini.</p>
                        <a href="pengelolaan.php" class="btn btn-primary">Kelola</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-user-check fa-2x mb-3 text-primary"></i>
                        <h5 class="card-title">Surat Perintah Tugas</h5>
                        <p class="card-text">Anda dapat melakukan pengawasan di sini.</p>
                        <a href="pengawasan.php" class="btn btn-primary">SPT</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-line fa-2x mb-3 text-primary"></i>
                        <h5 class="card-title">Laporan</h5>
                        <p class="card-text">Anda dapat melihat laporan di sini.</p>
                        <a href="laporan.php" class="btn btn-primary">Lihat Laporan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'footer.php'; ?>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.classList.add('show');
            });
        });
    </script>
</body>

</html>