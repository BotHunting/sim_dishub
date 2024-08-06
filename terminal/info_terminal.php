<?php include_once 'header.php'; ?>
<main class="main">
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Armada Tersedia di Terminal</h1>
                        <p class="mb-0">Temukan armada yang sesuai dengan kebutuhan Anda!</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li class="current">Armada</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->
    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Informasi Armada</h2>
            <p class="">Informasi Ketersediaan Armada<br></p>
        </div><!-- End Section Title -->
        <div class="container" data-aos="fade-up">
            <p>Informasi ketersediaan armada diupdate secara real-time, sehingga Anda dapat yakin bahwa informasi yang Anda dapatkan adalah yang terbaru.</p>
            <!-- Tombol Pilih Terminal -->
            <div class="text-center">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#pilihTerminalModal">
                    Pilih Terminal
                </button>
            </div>
            <!-- Modal Pilih Terminal -->
            <div class="modal fade" id="pilihTerminalModal" tabindex="-1" aria-labelledby="pilihTerminalModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pilihTerminalModalLabel">Pilih Terminal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk memilih terminal -->
                            <form action="info_terminal.php" method="post">
                                <div class="mb-3">
                                    <label for="terminal" class="form-label">Pilih Terminal:</label>
                                    <select class="form-select" id="terminal" name="terminal">
                                        <?php
                                        include_once 'koneksi.php';
                                        $sql = "SELECT DISTINCT asal_terminal FROM kendaraan_masuk";
                                        $result = $koneksi->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['asal_terminal'] . "'>" . $row['asal_terminal'] . "</option>";
                                            }
                                        } else {
                                            echo "<option value=''>Tidak ada terminal.</option>";
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
                            <th>Trayek</th>
                            <th>Waktu Kedatangan</th>
                            <th>Jumlah Penumpang Masuk</th>
                            <th>Asal Terminal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['terminal'])) {
                            $terminal = $_POST['terminal'];
                            $sql = "SELECT * FROM kendaraan_masuk WHERE asal_terminal = ? ORDER BY waktu_kedatangan DESC";
                            $stmt = $koneksi->prepare($sql);
                            $stmt->bind_param("s", $terminal);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['nomor_kendaraan'] . "</td>";
                                    echo "<td>" . $row['trayek'] . "</td>";
                                    echo "<td>" . $row['waktu_kedatangan'] . "</td>";
                                    echo "<td>" . $row['jumlah_penumpang_masuk'] . "</td>";
                                    echo "<td>" . $row['asal_terminal'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>Tidak ada data kendaraan masuk untuk terminal ini.</td></tr>";
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