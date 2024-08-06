<?php include_once 'header.php'; ?>
<div class="container">
    <h1 class="mt-5">Tambah Barang</h1>
    <div class="row mt-4">
        <div class="col-md-6">
            <form action="proses_tambah_barang.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nomor_inventaris">Nomor Inventaris:</label>
                    <input type="text" class="form-control" id="nomor_inventaris" name="nomor_inventaris" required>
                </div>
                <div class="form-group">
                    <label for="nama_barang">Nama Barang:</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah:</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                </div>
                <div class="form-group">
                    <label for="kondisi">Kondisi:</label>
                    <select class="form-control" id="kondisi" name="kondisi" required>
                        <option value="Baik">Baik</option>
                        <option value="Rusak">Rusak</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun:</label>
                    <input type="number" class="form-control" id="tahun" name="tahun" required>
                </div>
                <div class="form-group">
                    <label for="foto">Foto:</label>
                    <input type="file" class="form-control-file" id="foto" name="foto">
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>