<?php
// Sertakan file koneksi.php untuk terhubung ke database
require_once('config.php');

// Inisialisasi variabel
$username = $password = $confirm_password = $nama = $nip = $rules = '';
$username_err = $password_err = $confirm_password_err = $nama_err = $nip_err = $rules_err = '';

// Proses data ketika formulir disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Persiapkan pernyataan SELECT
        $sql = "SELECT id FROM admin WHERE username = ?";

        if ($stmt = $koneksi->prepare($sql)) {
            // Bind variabel parameter ke pernyataan yang telah dipersiapkan
            $stmt->bind_param("s", $param_username);

            // Tetapkan nilai parameter
            $param_username = trim($_POST["username"]);

            // Mencoba mengeksekusi pernyataan yang telah dipersiapkan
            if ($stmt->execute()) {
                // Simpan hasil
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Tutup pernyataan
            $stmt->close();
        }
    }

    // Validasi password
    if (empty(trim($_POST['password']))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST['password']);
    }

    // Validasi konfirmasi password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validasi nama
    if (empty(trim($_POST["nama"]))) {
        $nama_err = "Please enter your name.";
    } else {
        $nama = trim($_POST["nama"]);
    }

    // Validasi NIP
    if (empty(trim($_POST["nip"]))) {
        $nip_err = "Please enter your NIP.";
    } else {
        $nip = trim($_POST["nip"]);
    }

    // Validasi rules
    if (empty(trim($_POST["rules"]))) {
        $rules_err = "Please select a rule.";
    } else {
        $rules = trim($_POST["rules"]);
    }

    // Check input errors before inserting into database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($nama_err) && empty($nip_err) && empty($rules_err)) {
        // Persiapkan pernyataan INSERT
        $sql = "INSERT INTO admin (nip, nama, username, password, rules) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $koneksi->prepare($sql)) {
            // Bind variabel parameter ke pernyataan yang telah dipersiapkan
            $stmt->bind_param("sssss", $param_nip, $param_nama, $param_username, $param_password, $param_rules);

            // Tetapkan nilai parameter
            $param_nip = $nip;
            $param_nama = $nama;
            $param_username = $username;
            $param_password = $password;
            $param_rules = $rules;

            // Mencoba mengeksekusi pernyataan yang telah dipersiapkan
            if ($stmt->execute()) {
                // Redirect to index page
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Tutup pernyataan
            $stmt->close();
        }
    }

    // Tutup koneksi database
    $koneksi->close();
}
