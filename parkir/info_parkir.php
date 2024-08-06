<?php include_once 'header.php'; ?>
<main class="main">
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Kendaraan Parkir</h1>
                        <p class="mb-0">Lihat informasi lengkap tentang kendaraan Anda yang sedang parkir!</p>
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
    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Informasi Kendaraan Parkir</h2>
            <p class="">Pantau status parkir Anda dengan mudah<br></p>
        </div><!-- End Section Title -->
        <div class="container" data-aos="fade-up">
            <p>Lihat informasi lengkap tentang kendaraan yang sedang parkir.</p>
            <!-- Tombol Pilih Parkir -->
            <div class="text-center">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#pilihParkirModal">
                    Pilih Lokasi Parkir
                </button>
            </div>
            <!-- Modal Pilih Parkir -->
            <div class="modal fade" id="pilihParkirModal" tabindex="-1" aria-labelledby="pilihParkirModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pilihParkirModalLabel">Pilih Parkir</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk memilih parkir -->
                            <form action="info_parkir.php" method="post">
                                <div class="mb-3">
                                    <label for="parkir" class="form-label">Pilih Parkir:</label>
                                    <select class="form-select" id="parkir" name="parkir">
                                        <?php
                                        include_once 'koneksi.php';
                                        $sql = "SELECT DISTINCT lokasi FROM parkir";
                                        $result = $koneksi->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['lokasi'] . "'>" . $row['lokasi'] . "</option>";
                                            }
                                        } else {
                                            echo "<option value=''>Tidak ada parkir.</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Tampilkan Informasi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nomor Kendaraan</th>
                <th>Jenis Kendaraan</th>
                <th>Waktu Masuk</th>
                <th>Lokasi Parkir</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['parkir'])) {
                $parkir = $_POST['parkir'];
                $sql = "SELECT * FROM kendaraan WHERE lokasi_parkir = ? ORDER BY waktu_masuk DESC";
                $stmt = $koneksi->prepare($sql);
                $stmt->bind_param("s", $parkir);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nomor_kendaraan'] . "</td>";
                        echo "<td>" . $row['jenis_kendaraan'] . "</td>";
                        echo "<td>" . $row['waktu_masuk'] . "</td>";
                        echo "<td>" . $row['lokasi_parkir'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data kendaraan untuk lokasi parkir ini.</td></tr>";
                }
                $stmt->close();
            }
            ?>
        </tbody>
    </table>
</div>
        </div>
    </section><!-- /Starter Section Section -->
</main>

<?php include_once 'footer.php'; ?>
<script>
    // Function untuk mengambil data kendaraan masuk dari server menggunakan AJAX
    function fetchData() {
        var terminal = document.getElementById('terminal').value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("kendaraanMasukTable").innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "fetch_kendaraan_masuk.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("terminal=" + terminal);
    }

    // Mengirim form memilih terminal menggunakan AJAX saat form disubmit
    document.getElementById('terminalForm').addEventListener('submit', function(event) {
        event.preventDefault();
        fetchData();
    });
</script>