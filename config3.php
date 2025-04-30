<?php
// Konfigurasi database online
$online_config = [
    'host' => 'sql12.freesqldatabase.com',
    'user' => 'sql12772394',
    'pass' => 'rjALslf1bV',
    'name' => 'sql12772394',
    'port' => 3306
];

// Konfigurasi database offline
$offline_config = [
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'name' => 'dishub_sim',
    'port' => 3306
];

// Coba koneksi ke database online terlebih dahulu
$koneksi = @new mysqli(
    $online_config['host'],
    $online_config['user'],
    $online_config['pass'],
    $online_config['name'],
    $online_config['port']
);

// Jika gagal, coba koneksi ke database lokal
if ($koneksi->connect_error) {
    $koneksi = new mysqli(
        $offline_config['host'],
        $offline_config['user'],
        $offline_config['pass'],
        $offline_config['name'],
        $offline_config['port']
    );

    if ($koneksi->connect_error) {
        die("Koneksi ke database gagal: " . $koneksi->connect_error);
    }
}
?>
