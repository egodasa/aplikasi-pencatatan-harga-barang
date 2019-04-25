<?php
$judulatas = "Tambah User";
$judulhalaman = $judulatas;
include "atas.php"; 
require_once("database.php");

$query = $db->prepare("SELECT * FROM tbl_kecamatan");
$query->execute();
$daftar_kecamatan = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<a href="daftar-user.php" class="btn btn-success">Kembali</a>
<br/>
<br/>
<form method="POST" action="proses-tambah-user.php">
<div class="form-group">			
<label class="form-label" for="username">USERNAME</label>
<input class="form-control" type="text" name="username" />
</div>

<div class="form-group">
<label class="form-label" for="password">PASSWORD</label>
<input class="form-control" type="password" name="password" />
</div>

<div class="form-group">
<label class="form-label" for="nama_lengkap">NAMA LENGKAP</label>
<input class="form-control" type="text" name="nama_lengkap" />
</div>

<div class="form-group">
<label class="form-label" for="alamat">ALAMAT</label>
<textarea class="form-control" name="alamat"> </textarea>
</div>

<div class="form-group">
<label class="form-label" for="id_kecamatan">KECAMATAN</label>
<select class="form-control" id="id_kecamatan" name="id_kecamatan">
  <option value="">-- pilih kecamatan --</option>
  <?php
    foreach($daftar_kecamatan as $d):
  ?>
    <option value="<?=$d['id_kecamatan']?>"><?=$d['nm_kecamatan']?></option>
  <?php
    endforeach;
  ?>
</select>
</div>

<div class="form-group">
<label class="form-label" for="level">LEVEL</label>
  <select class="form-control" name="level">
    <option value="Kepala Dinas">kepala dinas</option>
    <option value="Petugas Lapangan">petugas lapangan</option>
    <option value="Sekretaris">sekretaris</option>
  </select>
</div>

<button type="submit" class="btn btn-success">SIMPAN</button>
<button type="reset" class="btn btn-danger">RESET</button>

</form>

<?php

include "bawah.php"; 

?>


			
			
        

    
