<?php include_once 'header.php'; ?>

<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Petugas</h1>
                        <p class="mb-0">Hubungi Petugas Parkir Dinas Perhubungan Fakfak melalui informasi kontak yang tersedia.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li class="current">Petugas</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <section id="trainers" class="section trainers">
        <div class="container">
            <h1>Data Petugas</h1>
            <div class="row gy-5">
                <?php
                // Sertakan file koneksi.php
                include_once 'koneksi.php';

                // Query untuk mengambil data petugas dari database
                $sql = "SELECT * FROM Petugas_parkir";
                $result = $koneksi->query($sql);

                if ($result->num_rows > 0) {
                    // Output data dari setiap baris
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='col-lg-4 col-md-6 member' data-aos='fade-up' data-aos-delay='100'>";
                        echo "<div class='member-img'>";
                        echo "<img src='assets/img/petugas/" . $row['nip'] . ".jpg' class='img-fluid' alt=''>";
                        echo "<div class='social'>";
                        echo "<a href='#'><i class='bi bi-twitter'></i></a>";
                        echo "<a href='#'><i class='bi bi-facebook'></i></a>";
                        echo "<a href='#'><i class='bi bi-instagram'></i></a>";
                        echo "<a href='#'><i class='bi bi-linkedin'></i></a>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='member-info text-center'>";
                        echo "<h4>" . $row['nama'] . "</h4>";
                        echo "<span class=''>" . $row['jabatan'] . "</span>";
                        echo "<p>" . $row['jadwal_kerja'] . "</p>";
                        echo "</div>";
                        echo "</div><!-- End Team Member -->";
                    }
                } else {
                    echo "<p>Tidak ada data petugas.</p>";
                }
                $koneksi->close();
                ?>
            </div>
        </div>
    </section><!-- /Trainers Section -->


</main>

<?php include_once 'footer.php'; ?>