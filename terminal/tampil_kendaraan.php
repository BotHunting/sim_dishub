<?php include_once 'header.php'; ?>
<div class="container">
    <h1>Kendaraan Masuk</h1>
    <div class="table-responsive">
        <table id="kendaraan_masuk" class="table table-striped">
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
            </tbody>
        </table>
    </div>
    <h1>Kendaraan Keluar (5 Terakhir)</h1>
    <div class="table-responsive">
        <table id="kendaraan_keluar" class="table table-striped">
            <thead>
                <tr>
                    <th>Nomor Kendaraan</th>
                    <th>Trayek</th>
                    <th>Waktu Kedatangan</th>
                    <th>Jumlah Penumpang Masuk</th>
                    <th>Asal Terminal</th>
                    <th>Waktu Keberangkatan</th>
                    <th>Jumlah Penumpang Keluar</th>
                    <th>Tujuan Terminal</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script>
    function updateData() {
        // Memperbarui data kendaraan masuk
        var xhrKendaraanMasuk = new XMLHttpRequest();
        xhrKendaraanMasuk.open('GET', 'get_kendaraan_masuk.php', true);
        xhrKendaraanMasuk.onload = function() {
            if (xhrKendaraanMasuk.status === 200) {
                document.querySelector('#kendaraan_masuk tbody').innerHTML = xhrKendaraanMasuk.responseText;
            }
        };
        xhrKendaraanMasuk.send();
        // Memperbarui data kendaraan keluar
        var xhrKendaraanKeluar = new XMLHttpRequest();
        xhrKendaraanKeluar.open('GET', 'get_kendaraan_keluar.php', true);
        xhrKendaraanKeluar.onload = function() {
            if (xhrKendaraanKeluar.status === 200) {
                document.querySelector('#kendaraan_keluar tbody').innerHTML = xhrKendaraanKeluar.responseText;
            }
        };
        xhrKendaraanKeluar.send();
    }
    // Memanggil fungsi updateData setiap 5 detik
    setInterval(updateData, 5000);
    // Memanggil fungsi updateData untuk pertama kali
    updateData();
</script>
<?php include_once 'footer.php'; ?>
