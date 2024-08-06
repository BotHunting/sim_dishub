<?php include_once 'header.php'; ?>

<div class="container">
    <h1 class="mt-5">Tambah Kendaraan Keluar</h1>
    <div class="form-container">
        <form action="proses_tambah_kendaraan_keluar.php" method="post" class="mt-3">
            <div class="mb-3">
                <label for="nomor_kendaraan" class="form-label">Nomor Kendaraan:</label>
                <select id="nomor_kendaraan" name="nomor_kendaraan" class="form-select" required>
                    <option value="">Pilih Nomor Kendaraan</option>
                    <?php
                    include_once 'koneksi.php';
                    $sql = "SELECT * FROM kendaraan_masuk";
                    $result = $koneksi->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['nomor_kendaraan'] . "'>" . $row['nomor_kendaraan'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada data kendaraan masuk</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="trayek" class="form-label">Trayek:</label>
                <input type="text" id="trayek" name="trayek" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="waktu_kedatangan" class="form-label">Waktu kedatangan:</label>
                <input type="datetime-local" id="waktu_kedatangan" name="waktu_kedatangan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="jumlah_penumpang_masuk" class="form-label">Jumlah Penumpang Masuk:</label>
                <input type="number" id="jumlah_penumpang_masuk" name="jumlah_penumpang_masuk" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="asal_terminal" class="form-label">Asal Terminal:</label>
                <input type="text" id="asal_terminal" name="asal_terminal" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="waktu_keberangkatan" class="form-label">Waktu Keberangkatan:</label>
                <input type="datetime-local" id="waktu_keberangkatan" name="waktu_keberangkatan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="jumlah_penumpang_keluar" class="form-label">Jumlah Penumpang Keluar:</label>
                <input type="number" id="jumlah_penumpang_keluar" name="jumlah_penumpang_keluar" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tujuan_terminal" class="form-label">Tujuan Terminal:</label>
                <select id="tujuan_terminal" name="tujuan_terminal" class="form-select" required>
                    <?php
                    $sql = "SELECT * FROM terminal";
                    $result = $koneksi->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['lokasi'] . "'>" . $row['lokasi'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada data terminal</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="retribusi" class="form-label">Retribusi:</label>
                <input type="number" id="retribusi" name="retribusi" class="form-control" value="2000" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Kendaraan Keluar</button>
            <a href="tambah_kendaraan.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
<?php include_once 'footer.php'; ?>
<script>
    // Mengatur nilai trayek berdasarkan nomor kendaraan yang dipilih menggunakan AJAX
    document.getElementById('nomor_kendaraan').addEventListener('change', function() {
        var nomor_kendaraan = this.value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_trayek.php?nomor_kendaraan=' + nomor_kendaraan, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('trayek').value = xhr.responseText;
            }
        };
        xhr.send();
    });

    // Mengatur waktu kedatangan nomor kendaraan yang dipilih menggunakan AJAX
    document.getElementById('nomor_kendaraan').addEventListener('change', function() {
        var nomor_kendaraan = this.value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_waktu_kedatangan.php?nomor_kendaraan=' + nomor_kendaraan, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('waktu_kedatangan').value = xhr.responseText;
            }
        };
        xhr.send();
    });

    // Mengatur nilai trayek berdasarkan nomor kendaraan yang dipilih menggunakan AJAX
    document.getElementById('nomor_kendaraan').addEventListener('change', function() {
        var nomor_kendaraan = this.value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_penumpang_masuk.php?nomor_kendaraan=' + nomor_kendaraan, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('jumlah_penumpang_masuk').value = xhr.responseText;
            }
        };
        xhr.send();
    });

    // Mengatur asal terminal berdasarkan nomor kendaraan yang dipilih menggunakan AJAX
    document.getElementById('nomor_kendaraan').addEventListener('change', function() {
        var nomor_kendaraan = this.value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_asal_terminal.php?nomor_kendaraan=' + nomor_kendaraan, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('asal_terminal').value = xhr.responseText;
            }
        };
        xhr.send();
    });

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

    // Set nilai default waktu keberangkatan dengan waktu lokal saat ini
    document.getElementById('waktu_keberangkatan').value = getCurrentLocalTime();
</script>
