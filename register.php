<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran</title>
    <link rel="icon" href="assets/img/favicon.png" type="image/png">
    <style>
        body {
            background-image: url('assets/img/register.jpg');
            background-size: cover;
            background-position: center;
            overflow-x: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 380px;
            padding: 20px;
            background-color: #ffffff61;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        form {
            background-color: #ffffff94;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-submit {
            width: 100%;
            padding: 10px;
            background-color: #1877f2;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #166fe5;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 150px;
        }

        .help-block {
            color: #f44336;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="assets/img/favicon.png" alt="Logo">
        </div>
        <h1>Pendaftaran</h1>
        <form action="javascript:void(0)" method="post">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" id="nip" name="nip" required>
            </div>
            <div class="form-group">
                <button type="button" onclick="openWhatsAppChat()" class="btn-submit">Kirim Pendaftaran</button>
                <a href="login.php">Kembali</a>
            </div>
        </form>
    </div>
    <script>
        function openWhatsAppChat() {
            var nama = document.getElementById("nama").value;
            var nip = document.getElementById("nip").value;
            var message = "Pendaftaran Admin Baru: \nNama: " + nama + "\nNIP: " + nip;
            window.open("https://api.whatsapp.com/send?phone=+6281290320438&text=" + encodeURIComponent(message), "_blank");
        }
    </script>
</body>

</html>