<?php
$judulatas = "Edit User";
$judulhalaman = $judulatas;
include "atas.php"; 
if(isset($_GET['id_user'])){
      require_once("database.php");
      $query = $db->prepare("SELECT * FROM tbl_user WHERE id_user = ? LIMIT 1"); 
      $query->bindParam(1, $_GET['id_user']);
      $query->execute();
      $detail = $query->fetch();
      
      // cek dulu, datanya ketemu atau tidak. Kalau gk ketemu, ya redirect ke halaman awal
      if(empty($detail)){
        header("Location: daftar-user.php");
      }
    }else{
      header("Location: daftar-user.php");
    }
?>

<a href="daftar-user.php" class="btn btn-success">Kembali</a>
<br />
<br />

<form method="POST" action="proses-edit-user.php">
<input type="hidden" name="id_user" value="<?=$detail['id_user']?>" />
  <div class="form-group">
    <label class="form-label" for="username">USERNAME</label>
    <input class="form-control" type="text" name="username" value="<?=$detail['username']?>" readonly />
  </div>

  <div class="form-group">
    <label class="form-label" for="password">PASSWORD</label>
    <input class="form-control" type="password" name="password" />
  </div>

  <div class="form-group">
    <label class="form-label" for="nama_lengkap">NAMA LENGKAP</label>
    <input class="form-control" type="text" name="nama_lengkap" value="<?=$detail['nama_lengkap']?>" />
  </div>

  <div class="form-group">
    <label class="form-label" for="alamat">ALAMAT</label>
    <textarea class="form-control" class="form-control" name="alamat"><?=$detail['alamat']?></textarea>
  </div>

  <div class="form-group">
    <label class="form-label" for="level">LEVEL</label>
    <select class="form-control" id="level" name="level">
      <option value="Kepala Dinas">kepala dinas</option>
      <option value="Sekretaris">sekretaris</option>
    </select>
  </div>

  <button type="submit" class="btn btn-success">SIMPAN</button>
  <button type="reset" class="btn btn-danger">RESET</button>
</form>
<script>
  document.getElementById("level").value = <?=$detail['level']?>;
</script>
<?php

include "bawah.php"; 

?>