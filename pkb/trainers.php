<?php
include("header.php");
require_once __DIR__ . '/../config.php'; // Pastikan file config.php di-include

// Mengambil data pegawai aktif
$sql_aktif = "SELECT * FROM pegawai_pkb WHERE jabatan != 'Pensiun'";
$result_aktif = $koneksi->query($sql_aktif);

// Mengambil data pegawai pensiun
$sql_pensiun = "SELECT * FROM pegawai_pkb WHERE jabatan = 'Pensiun'";
$result_pensiun = $koneksi->query($sql_pensiun);
?>

<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Pegawai</h1>
                        <p class="mb-0">UPT PKB Gresik memiliki tim pegawai yang berpengalaman, profesional, dan berdedikasi tinggi. Tim kami terdiri dari berbagai bidang keahlian, termasuk penguji kendaraan bermotor, staf administrasi, dan staf pelayanan publik.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li class="current">Pegawai</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Section Pegawai Aktif -->
    <section id="trainers-aktif" class="section trainers-index">
        <?php
        // Tombol Tambah Pegawai hanya tampil jika pengguna sudah login
        if (isset($_SESSION['username'])) {
            echo '<div class="col-lg-12 text-center mb-4">
                    <a href="tambah_pegawai.php" class="btn btn-primary">Tambah Pegawai</a>
                  </div>';
        }
        ?>
        <div class="container">
            <h2 class="text-center mb-4">Pegawai Aktif</h2>
            <div class="row">
                <?php
                if ($result_aktif && $result_aktif->num_rows > 0) {
                    while ($row = $result_aktif->fetch_assoc()) {
                        echo '<div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">';
                        echo '<div class="member">';
                        echo '<img src="assets/img/trainers/' . $row["foto"] . '" class="img-fluid uniform-img" alt="">';
                        echo '<div class="member-content">';
                        echo '<h4>' . $row["nama"] . '</h4>';
                        echo '<span>' . $row["jabatan"] . '</span>';
                        echo '<p>' . $row["deskripsi"] . '</p>';
                        echo '<div class="social">';
                        if (!empty($row["twitter"])) echo '<a href="' . $row["twitter"] . '"><i class="bi bi-twitter"></i></a>';
                        if (!empty($row["facebook"])) echo '<a href="' . $row["facebook"] . '"><i class="bi bi-facebook"></i></a>';
                        if (!empty($row["instagram"])) echo '<a href="' . $row["instagram"] . '"><i class="bi bi-instagram"></i></a>';
                        if (!empty($row["linkedin"])) echo '<a href="' . $row["linkedin"] . '"><i class="bi bi-linkedin"></i></a>';
                        echo '</div>';
                        // Tombol Aksi Edit/Hapus hanya tampil jika pengguna sudah login
                        if (isset($_SESSION['username'])) {
                            echo '<div class="mt-3">';
                            echo '<a href="edit_pegawai.php?id=' . $row["id"] . '" class="btn btn-warning btn-sm mr-2">Edit</a>';
                            echo '<a href="hapus_pegawai.php?id=' . $row["id"] . '" class="btn btn-danger btn-sm">Hapus</a>';
                            echo '</div>';
                        }
                        echo '</div>';
                        echo '</div>';
                        echo '</div><!-- End Team Member -->';
                    }
                } else {
                    echo "<p class='text-center'>Tidak ada data pegawai aktif.</p>";
                }
                ?>
            </div>
        </div>
    </section><!-- End Section Pegawai Aktif -->

    <!-- Section Pegawai Pensiun -->
    <section id="trainers-pensiun" class="section trainers-index">
        <div class="container">
            <h2 class="text-center mb-4">Pegawai Pensiun</h2>
            <div class="row">
                <?php
                if ($result_pensiun && $result_pensiun->num_rows > 0) {
                    while ($row = $result_pensiun->fetch_assoc()) {
                        echo '<div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">';
                        echo '<div class="member">';
                        echo '<img src="assets/img/trainers/' . $row["foto"] . '" class="img-fluid uniform-img" alt="">';
                        echo '<div class="member-content">';
                        echo '<h4>' . $row["nama"] . '</h4>';
                        echo '<span>' . $row["jabatan"] . '</span>';
                        echo '<p>' . $row["deskripsi"] . '</p>';
                        echo '<div class="social">';
                        if (!empty($row["twitter"])) echo '<a href="' . $row["twitter"] . '"><i class="bi bi-twitter"></i></a>';
                        if (!empty($row["facebook"])) echo '<a href="' . $row["facebook"] . '"><i class="bi bi-facebook"></i></a>';
                        if (!empty($row["instagram"])) echo '<a href="' . $row["instagram"] . '"><i class="bi bi-instagram"></i></a>';
                        if (!empty($row["linkedin"])) echo '<a href="' . $row["linkedin"] . '"><i class="bi bi-linkedin"></i></a>';
                        echo '</div>';
                        // Tombol Aksi Edit/Hapus hanya tampil jika pengguna sudah login
                        if (isset($_SESSION['username'])) {
                            echo '<div class="mt-3">';
                            echo '<a href="edit_pegawai.php?id=' . $row["id"] . '" class="btn btn-warning btn-sm mr-2">Edit</a>';
                            echo '<a href="hapus_pegawai.php?id=' . $row["id"] . '" class="btn btn-danger btn-sm">Hapus</a>';
                            echo '</div>';
                        }
                        echo '</div>';
                        echo '</div>';
                        echo '</div><!-- End Team Member -->';
                    }
                } else {
                    echo "<p class='text-center'>Tidak ada data pegawai pensiun.</p>";
                }
                ?>
            </div>
        </div>
    </section><!-- End Section Pegawai Pensiun -->

</main>

<?php include("footer.php"); ?>
