<?php
// Gunakan file konfigurasi utama
require_once __DIR__ . '/../config.php';

// Jika perlu fungsi tambahan
function bersihkanInput($data) {
    global $conn;
    return mysqli_real_escape_string($conn, stripslashes(htmlspecialchars(trim($data))));
}
