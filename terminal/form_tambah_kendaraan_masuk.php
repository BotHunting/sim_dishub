<?php include_once 'header.php'; ?>
    <div class="container">
        <h1 class="mt-5">Tambah Kendaraan Masuk</h1>
        <div class="form-container">
            <form action="proses_tambah_kendaraan_masuk.php" method="post" class="mt-3">
                <div class="mb-3">
                    <label for="nomor_kendaraan" class="form-label">Nomor Kendaraan:</label>
                    <input type="text" id="nomor_kendaraan" name="nomor_kendaraan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="trayek" class="form-label">Trayek:</label>
                    <input type="text" id="trayek" name="trayek" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="waktu_kedatangan" class="form-label">Waktu Kedatangan:</label>
                    <input type="datetime-local" id="waktu_kedatangan" name="waktu_kedatangan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah_penumpang_masuk" class="form-label">Jumlah Penumpang Masuk:</label>
                    <input type="number" id="jumlah_penumpang_masuk" name="jumlah_penumpang_masuk" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="asal_terminal" class="form-label">Terminal Sekarang:</label>
                    <select id="asal_terminal" name="asal_terminal" class="form-select" required>
                        <?php
                        // Sertakan file koneksi.php untuk terhubung ke database
                        require_once('koneksi.php');

                        // Query untuk mengambil data terminal dari database
                        $sql = "SELECT * FROM terminal";
                        $result = $koneksi->query($sql);
                        // Periksa apakah ada baris data yang diambil dari database
                        if ($result->num_rows > 0) {
                            // Output data dari setiap baris
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['lokasi'] . "'>" . $row['lokasi'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Kendaraan Masuk</button>
                <a href="tambah_kendaraan.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
    <?php include_once 'footer.php'; ?>
    <script>
        // Fungsi untuk mendapatkan waktu lokal dari komputer pengguna
        function getCurrentLocalTime() {
            const now = new Date();
            const year = now.getFullYear();
            const month = (now.getMonth() + 1).toString().padStart(2, '0');
            const day = now.getDate().toString().padStart(2, '0');
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const localTime = `${year}-${month}-${day}T${hours}:${minutes}`;
            return localTime;
        }
        // Set nilai default waktu kedatangan dengan waktu lokal saat ini
        document.getElementById('waktu_kedatangan').value = getCurrentLocalTime();
    </script>
