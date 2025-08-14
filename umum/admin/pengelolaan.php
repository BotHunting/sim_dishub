<?php include_once 'header.php'; ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="mb-4 text-center text-primary">Pengelolaan Inventaris</h2>
                    <div class="d-flex justify-content-end mb-3 gap-2">
                        <a href="peminjaman.php" class="btn btn-gradient me-2">Peminjaman</a>
                        <?php if ($rules !== 'Staff') : ?>
                            <a href="tambah_barang.php" class="btn btn-gradient me-2">Tambah Barang</a>
                            <a href="laporan_inventaris.php" class="btn btn-gradient">Buat Laporan Inventaris</a>
                        <?php endif; ?>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET" class="form-inline">
                                <input type="text" name="search" class="form-control mr-sm-2" placeholder="Cari nama barang">
                                <button type="submit" class="btn btn-gradient">Cari</button>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover bg-white">
                            <thead class="thead-light">
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
                                $search_keyword = isset($_GET['search']) ? $_GET['search'] : '';
                                $sql = "SELECT * FROM pengelolaan WHERE nama_barang LIKE '%$search_keyword%' ORDER BY tahun DESC";
                                $result = $koneksi->query($sql);

                                if ($result && $result->num_rows > 0) {
                                    $no = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . htmlspecialchars($row['nomor_inventaris']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['nama_barang']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['jumlah']) . "</td>";
                                        // Kondisi badge
                                        $kondisiClass = strtolower($row['kondisi']) === 'baik' ? 'badge-success' : 'badge-warning';
                                        echo "<td><span class='badge $kondisiClass'>" . htmlspecialchars($row['kondisi']) . "</span></td>";
                                        echo "<td>" . htmlspecialchars($row['tahun']) . "</td>";
                                        echo "<td>";
                                        if (!empty($row['foto'])) {
                                            echo "<img src='../pengelolaan/" . htmlspecialchars($row['foto']) . "' alt='Foto Barang' style='max-width: 100px; border-radius:8px; box-shadow:0 2px 8px rgba(44,62,80,0.08);'>";
                                        } else {
                                            echo "<span class='text-muted'>Foto tidak tersedia</span>";
                                        }
                                        echo "</td>";
                                        if ($rules !== 'Staff') {
                                            echo "<td>";
                                            echo "<a href='edit_barang.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-sm btn-warning me-1'><i class='fas fa-edit'></i> Edit</a> ";
                                            echo "<a href='hapus_barang.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'><i class='fas fa-trash'></i> Hapus</a>";
                                            echo "</td>";
                                        }
                                        echo "</tr>";
                                    }
                                } else {
                                    $colspan = ($rules !== 'Staff') ? 8 : 7;
                                    echo "<tr><td colspan='$colspan' class='text-center'>Tidak ada data barang.</td></tr>";
                                }
                                $koneksi->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .btn-gradient {
        background: linear-gradient(90deg, #2980b9 0%, #6dd5fa 100%);
        color: #fff;
        border: none;
        font-weight: 500;
        transition: background 0.3s;
    }
    .btn-gradient:hover {
        background: linear-gradient(90deg, #6dd5fa 0%, #2980b9 100%);
        color: #fff;
    }
    .badge-success {
        background: #27ae60;
        color: #fff;
        font-size: 0.95rem;
        padding: 6px 16px;
        border-radius: 12px;
    }
    .badge-warning {
        background: #f39c12;
        color: #fff;
        font-size: 0.95rem;
        padding: 6px 16px;
        border-radius: 12px;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .me-1 { margin-right: 0.25rem; }
    .me-2 { margin-right: 0.5rem; }
    .gap-2 > * { margin-left: 0.5rem; }
    .gap-2 > *:first-child { margin-left: 0; }
</style>
<div style="height: 80px;"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
