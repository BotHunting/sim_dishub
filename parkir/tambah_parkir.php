<?php include_once 'header.php'; ?>
<!-- Page Title -->
<div class="page-title" data-aos="fade">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>Informasi Parkir</h1>
                    <p class="mb-0">Temukan Tempat Parkir Terdekat dengan Mudah. Parkir Mudah dan Aman di Fakfak!</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="index.php">Home</a></li>
                <li class="current">Parkir</li>
            </ol>
        </div>
    </nav>
</div><!-- End Page Title -->
<div class="container mt-5">
    <h1>Tambah Parkir</h1>
    <form action="proses_tambah_parkir.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi Parkir:</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Parkir:</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan:</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto:</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Parkir</button>
    </form>


    <h2 class="mt-5">Data Parkir</h2>
    <!-- Courses List Section -->
    <section id="courses-list" class="section courses-list">
        <div class="container">
            <div class="row">
            <?php
include_once 'koneksi.php';

$sql = "SELECT * FROM parkir";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='col-lg-4 col-md-6 d-flex align-items-stretch' data-aos='zoom-in' data-aos-delay='100'>";
        echo "<div class='course-item'>";
        echo "<img src='assets/img/parkir/" . $row['lokasi'] . ".jpg' class='img-fluid' alt=''>";
        echo "<div class='course-content'>";
        echo "<h3><a href='info_parkir.php'>" . $row['lokasi'] . "</a></h3>";
        echo "<p class='description'>" . $row['alamat'] . "</p>";
        echo "<p class='description'>" . $row['keterangan'] . "</p>";
        echo "<a href='edit_parkir.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a> | ";
        echo "<a href='hapus_parkir.php?id=" . $row['id'] . "' class='btn btn-danger'>Hapus</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>Tidak ada data parkir.</p>";
}
$koneksi->close();
?>

            </div>
        </div>
    </section><!-- /Courses List Section -->
</div>
</div>

<?php include_once 'footer.php'; ?>