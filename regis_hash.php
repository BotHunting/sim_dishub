<?php
require_once('config.php');
$username = $password = $confirm_password = $nama = $nip = '';
$username_err = $password_err = $confirm_password_err = $nama_err = $nip_err = $rules_err = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $sql = "SELECT id FROM admin WHERE username = ?";
        if ($stmt = $koneksi->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = trim($_POST["username"]);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
    if (empty(trim($_POST['password']))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST['password']);
    }
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }
    if (empty(trim($_POST["nama"]))) {
        $nama_err = "Please enter your name.";
    } else {
        $nama = trim($_POST["nama"]);
    }
    if (empty(trim($_POST["nip"]))) {
        $nip_err = "Please enter your NIP.";
    } else {
        $nip = trim($_POST["nip"]);
    }
    if (empty(trim($_POST["rules"]))) {
        $rules_err = "Please select a rule.";
    } else {
        $rules = trim($_POST["rules"]);
    }
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($nama_err) && empty($nip_err) && empty($rules_err)) {
        $sql = "INSERT INTO admin (nip, nama, username, password, rules) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $koneksi->prepare($sql)) {
            // Hash password sebelum disimpan
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param("sssss", $param_nip, $param_nama, $param_username, $param_password, $param_rules);
            $param_nip = $nip;
            $param_nama = $nama;
            $param_username = $username;
            // Menggunakan password yang telah di-hash
            $param_password = $hashed_password;
            $param_rules = $rules;
            if ($stmt->execute()) {
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
    $koneksi->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" href="assets/img/favicon.png" type="image/png">
    <style>
        body {
            background-image: url('assets/img/register.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            background-color: #ffffff54;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff54;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        input[type="submit"] {
            padding: 12px;
            background-color: #1877f2;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #166fe5;
        }

        .error-message {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>">
            <span class="error-message"><?php echo $nama_err; ?></span>
            <label for="nip">NIP:</label>
            <input type="text" id="nip" name="nip" value="<?php echo $nip; ?>">
            <span class="error-message"><?php echo $nip_err; ?></span>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $username; ?>">
            <span class="error-message"><?php echo $username_err; ?></span>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo $password; ?>">
            <span class="error-message"><?php echo $password_err; ?></span>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" value="<?php echo $confirm_password; ?>">
            <span class="error-message"><?php echo $confirm_password_err; ?></span>
            <label for="rules">Rule:</label>
            <select name="rules" id="rules">
                <option value="">- Select Rule -</option>
                <option value="Staff">Staff</option>
                <option value="Kepala">Kepala</option>
            </select>
            <span class="error-message"><?php echo $rules_err; ?></span>
            <input type="submit" value="Submit">
            <a href="index.php">Kembali</a>
        </form>
    </div>
</body>

</html>