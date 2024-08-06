<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1 class="mb-4">Daftar Pegawai</h1>
    <?php if ($rules !== 'Staff') : ?>
        <div class="text-end mb-4">
            <a href="tambah_pegawai.php" class="btn btn-primary">Tambah Pegawai</a>
            <a href="absensi.php" class="btn btn-primary">Absensi</a>
            <a href="absensi_form.php" class="btn btn-success">Form Lembar Absen</a>
        </div>
    <?php endif; ?>
    <div class="table-responsive">
        <?php
        require_once 'koneksi.php';
        $sql = "SELECT DISTINCT seksi, bidang FROM pegawai";
        $result = $koneksi->query($sql);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<h3 class='mt-4'>" . htmlspecialchars($row['seksi']) . " - " . htmlspecialchars($row['bidang']) . "</h3>";
                echo "<table class='table'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>No.</th>";
                echo "<th>Nama</th>";
                echo "<th>Pangkat</th>";
                echo "<th>NIP</th>";
                echo "<th>Jabatan</th>";
                if ($rules !== 'Staff') {
                    echo "<th>Aksi</th>";
                }
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                $sub_sql = "SELECT * FROM pegawai WHERE seksi = ? AND bidang = ?";
                $stmt = $koneksi->prepare($sub_sql);
                $stmt->bind_param("ss", $row['seksi'], $row['bidang']);
                $stmt->execute();
                $sub_result = $stmt->get_result();
                if ($sub_result && $sub_result->num_rows > 0) {
                    $no = 1;
                    while ($sub_row = $sub_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . htmlspecialchars($sub_row['nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($sub_row['pangkat']) . "</td>";
                        echo "<td>" . htmlspecialchars($sub_row['nip']) . "</td>";
                        echo "<td>" . htmlspecialchars($sub_row['jabatan']) . "</td>";
                        if ($rules !== 'Staff') {
                            echo "<td>";
                            echo "<a href='edit_pegawai.php?id=" . htmlspecialchars($sub_row['id']) . "' class='btn btn-warning btn-sm'>Edit</a>";
                            echo "<a href='hapus_pegawai.php?id=" . htmlspecialchars($sub_row['id']) . "' class='btn btn-danger btn-sm'>Hapus</a>";
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data pegawai untuk seksi " . htmlspecialchars($row['seksi']) . " dan bidang " . htmlspecialchars($row['bidang']) . ".</td></tr>";
                }

                echo "</tbody>";
                echo "</table>";
                
                // Tutup prepared statement di dalam perulangan while
                $stmt->close();
            }
        } else {
            echo "<p>Tidak ada data pegawai.</p>";
        }
        $koneksi->close();
        ?>
    </div>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
