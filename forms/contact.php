<?php
// Tetapkan alamat email penerima
$receiving_email_address = 'dishubfakfak@mailnesia.com';

// Ambil data dari formulir kontak
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Bangun pesan email
$mail_message = "From: $name\n";
$mail_message .= "Email: $email\n";
$mail_message .= "Message:\n$message";

// Kirim email
$mail_sent = mail($receiving_email_address, $subject, $mail_message);

// Cek apakah email berhasil dikirim
if ($mail_sent) {
  echo "Email berhasil dikirim!";
} else {
  echo "Gagal mengirim email. Silakan coba lagi.";
}
