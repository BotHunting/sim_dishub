<?php include("header.php"); ?>
<header class="text-center">
    <h1>Daftar Kendaraan</h1>
</header>
<div class="container">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nomor Kendaraan</th>
                    <th>Jenis Kendaraan</th>
                    <th>Waktu Masuk</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk mengambil data kendaraan dari database, diurutkan berdasarkan waktu masuk secara descending
                $sql = "SELECT * FROM kendaraan ORDER BY waktu_masuk DESC";
                $result = $koneksi->query($sql);
                // Periksa apakah ada baris data yang diambil dari database
                if ($result && $result->num_rows > 0) {
                    // Output data dari setiap baris
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["nomor_kendaraan"] . "</td>"; // Kolom "nomor_plat" sesuai dengan struktur tabel kendaraan
                        echo "<td>" . $row["jenis_kendaraan"] . "</td>";
                        echo "<td>" . $row["waktu_masuk"] . "</td>";
                        echo "<td>" . $row["lokasi_parkir"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data kendaraan</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php include("footer.php"); ?>
