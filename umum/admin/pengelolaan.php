<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1 class="mb-4">Pengelolaan Inventaris</h1>
    <div class="text-end mb-4">
        <a href="peminjaman.php" class="btn btn-primary">Peminjaman</a>
        <?php if ($rules !== 'Staff') : ?>
            <a href="tambah_barang.php" class="btn btn-primary">Tambah Barang</a>
            <a href="laporan_inventaris.php" class="btn btn-primary">Buat Laporan Inventaris</a>
        <?php endif; ?>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET" class="form-inline">
                <input type="text" name="search" class="form-control mr-sm-2" placeholder="Cari nama barang">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nomor Inventaris</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Kondisi</th>
                    <th>Tahun</th>
                    <th>Foto</th>
                    <?php if ($rules !== 'Staff') : ?>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once 'koneksi.php';

                // Proses pencarian
                $search_keyword = isset($_GET['search']) ? $_GET['search'] : '';
                $sql = "SELECT * FROM pengelolaan WHERE nama_barang LIKE '%$search_keyword%' ORDER BY tahun DESC"; // Menambahkan ORDER BY tahun DESC
                $result = $koneksi->query($sql);

                if ($result) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['nomor_inventaris']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_barang']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['jumlah']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['kondisi']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tahun']) . "</td>";
                        echo "<td>";
                        if (!empty($row['foto'])) {
                            echo "<img src='../pengelolaan/" . htmlspecialchars($row['foto']) . "' alt='Foto Barang' style='max-width: 100px;'>";
                        } else {
                            echo "Foto tidak tersedia";
                        }
                        echo "</td>";
                        // Tampilkan tombol aksi hanya jika pengguna memiliki rules bukan "Staff"
                        if ($rules !== 'Staff') {
                            echo "<td>";
                            echo "<a href='edit_barang.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-warning btn-sm'>Edit</a> ";
                            echo "<a href='hapus_barang.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger btn-sm'>Hapus</a>";
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Tidak ada data barang.</td></tr>";
                }
                $koneksi->close();
                ?>
            </tbody>
        </table>
    </div>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
