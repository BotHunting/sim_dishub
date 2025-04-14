<?php
// Memuat file header
include "header.php";
?>

<div class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">ATCS Kabupaten Fakfak</h1>
            <p class="lead">Sistem Kendali Lalu Lintas Cerdas untuk Kota yang Lebih Tertib dan Aman</p>
        </div>

        <div class="row">
            <div class="col-md-8 mb-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="card-title">Apa itu ATCS?</h3>
                        <p>
                            ATCS (Area Traffic Control System) adalah sistem pengendalian lalu lintas berbasis teknologi informasi
                            yang mengatur lampu lalu lintas secara otomatis dan real-time berdasarkan kondisi lalu lintas di lapangan.
                        </p>
                        <p>
                            Sistem ini bekerja melalui jaringan sensor dan kamera yang mengumpulkan data kendaraan di berbagai persimpangan.
                            Data tersebut dianalisis untuk mengoptimalkan pengaturan lampu lalu lintas guna memperlancar arus lalu lintas.
                        </p>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="card-title">Manfaat ATCS</h3>
                        <ul>
                            <li>Meningkatkan kelancaran dan keselamatan lalu lintas</li>
                            <li>Mengurangi kemacetan dan waktu tempuh</li>
                            <li>Efisiensi konsumsi bahan bakar</li>
                            <li>Menurunkan emisi gas buang</li>
                            <li>Meningkatkan kualitas hidup masyarakat</li>
                        </ul>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title">Layanan ATCS</h3>
                        <ul>
                            <li>Pengaduan masyarakat terkait lalu lintas</li>
                            <li>Informasi kondisi lalu lintas terkini</li>
                            <li>Laporan dan statistik kinerja sistem</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body text-center">
                        <h4>CCTV Lalu Lintas</h4>
                        <p>Lihat kondisi lalu lintas real-time melalui CCTV yang tersebar di titik strategis.</p>
                        <a href="live.php" class="btn btn-primary mb-2">Lihat CCTV</a><br>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4>Kontak ATCS</h4>
                        <ul class="list-unstyled">
                            <li><strong>Telepon:</strong> (0956) 22214</li>
                            <li><strong>Email:</strong> dishubfakfak.lalulintas@gmail.com</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
