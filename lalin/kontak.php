<?php include "header.php";

function isGoogleEmail($email)
{
	$domain = explode('@', $email);
	return strtolower($domain[1]) === 'gmail.com';
}

// Pesan gagal jika alamat email bukan dari Google
$fail_message = "";
if (isset($_GET['fail']) && $_GET['fail'] === 'true') {
	$fail_message = "Maaf, hanya alamat email dari Google yang diperbolehkan.";
}
?>
<div class="banner">
	<h1>Hubungi Kami</h1>
</div>
<div class="main-content">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="box">
					<h2>Informasi Kontak</h2>
					<ul>
						<li><b>Alamat:</b> Jl. Imam Bonjol No.1, Wagom Utara, Kec. Pariwari, Kabupaten Fakfak, Papua Bar. 98013</li>
						<li><b>Telepon:</b> (0956) 22214</li>
						<li><b>Email:</b> dishubfakfak.lalulintas@gmail.com</li>
						<li><b>Facebook:</b> @dishub.fakfak</li>
					</ul>
				</div>
			</div>
			<div class="col-md-6">
				<div class="box">
					<h2>Formulir Kontak</h2>
					<p>Hubungi kami melalui formulir di bawah ini untuk menyampaikan pertanyaan, laporan, atau saran terkait ATCS.</p>
					<?php if (!empty($fail_message)) : ?>
						<div class="alert alert-danger" role="alert">
							<?php echo $fail_message; ?>
						</div>
					<?php endif; ?>
					<form action="process_contact.php" method="post">
						<div class="mb-3">
							<label for="nama" class="form-label">Nama Lengkap</label>
							<input type="text" class="form-control" id="nama" name="nama" required>
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">Email (Gmail)</label>
							<input type="email" class="form-control" id="email" name="email" required>
						</div>
						<div class="mb-3">
							<label for="subjek" class="form-label">Subjek</label>
							<input type="text" class="form-control" id="subjek" name="subjek" required>
						</div>
						<div class="mb-3">
							<label for="pesan" class="form-label">Pesan</label>
							<textarea class="form-control" id="pesan" name="pesan" rows="5" required></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Kirim Pesan</button>
					</form><br>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include "footer.php";?>