<?php include_once 'header.php'; ?>
<div class="container">
  <h1 class="mt-5">Pendaftaran</h1>
  <form action="javascript:void(0)" method="post" class="mt-3">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama Lengkap</label>
      <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    <div class="mb-3">
      <label for="nip" class="form-label">NIP</label>
      <input type="text" class="form-control" id="nip" name="nip" required>
    </div>
    <button type="button" onclick="openWhatsAppChat()" class="btn btn-primary">Kirim Pendaftaran</button>
  </form>
</div>
<script>
  function openWhatsAppChat() {
    var nama = document.getElementById("nama").value;
    var nip = document.getElementById("nip").value;
    var message = "Pendaftaran Admin Baru: \nNama: " + nama + "\nNIP: " + nip;
    window.open("https://api.whatsapp.com/send?phone=+6285814246516&text=" + encodeURIComponent(message), "_blank");
  }
</script>
<?php include_once 'footer.php'; ?>