<?php include_once 'header.php'; ?>
<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Petugas</h1>
                        <p class="mb-0">Hubungi Petugas Terminal Dinas Perhubungan Fakfak melalui informasi kontak yang tersedia.</p>
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

    <div class="container mt-5">
        <h1>Tambah Petugas</h1>
        <form action="proses_tambah_petugas.php" method="post" enctype="multipart/form-data" id="petugasForm">
            <div class="mb-3">
                <label for="pegawai" class="form-label">Pilih Pegawai:</label>
                <select class="form-select" id="pegawai" name="pegawai" required>
                    <option value="">Pilih Pegawai</option>
                    <?php
                    include_once 'koneksi.php';
                    // Query untuk mengambil data pegawai dari tabel pegawai
                    $sql = "SELECT * FROM pegawai";
                    $result = $koneksi->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada pegawai.</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="nip" class="form-label">NIP:</label>
                <input type="text" class="form-control" id="nip" name="nip" required readonly>
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan:</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" readonly>
            </div>
            <div class="mb-3">
                <label for="jadwal_kerja" class="form-label">Jadwal Kerja:</label>
                <select class="form-select" id="jadwal_kerja" name="jadwal_kerja">
                    <?php
                    // Query untuk mengambil data terminal dari database
                    $sql = "SELECT * FROM terminal";
                    $result = $koneksi->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['lokasi'] . "'>" . $row['lokasi'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada terminal.</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="telepon" class="form-label">Telepon:</label>
                <input type="text" class="form-control" id="telepon" name="telepon" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto:</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Petugas</button>
        </form>
        <section id="trainers" class="section trainers">
            <div class="container">
                <h1>Data Petugas</h1>
                <div class="row gy-5">
                    <?php
                    // Sertakan file koneksi.php
                    include_once 'koneksi.php';

                    // Query untuk mengambil data petugas dari database
                    $sql = "SELECT * FROM Petugas";
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
                            echo "<p>" . $row['nip'] . "</p>";
                            echo "<span class=''>" . $row['jabatan'] . "</span>";
                            echo "<p>" . $row['jadwal_kerja'] . "</p>";
                            echo "<p>" . $row['telepon'] . "</p>";
                            echo "<td><a href='edit_petugas.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a> | <a href='hapus_petugas.php?id=" . $row['id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus petugas ini?\")' class='btn btn-danger'>Hapus</a></td>";
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
    </div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pegawai').change(function() {
            var idPegawai = $(this).val();
            $.ajax({
                url: 'get_pegawai.php',
                method: 'post',
                data: {
                    id: idPegawai
                },
                dataType: 'json',
                success: function(response) {
                    $('#nip').val(response.nip);
                    $('#jabatan').val(response.jabatan);
                }
            });
        });
    });
</script>
<?php include_once 'footer.php'; ?>