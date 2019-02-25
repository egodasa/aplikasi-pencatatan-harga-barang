<?php
$judulatas = "Edit Kecamatan";
$judulhalaman = $judulatas;
include "atas.php"; 

if(isset($_GET['id_kecamatan'])){
    require_once("database.php");
    $query = $db->prepare("SELECT * FROM tbl_kecamatan WHERE id_kecamatan = ? LIMIT 1"); 
    $query->bindParam(1, $_GET['id_kecamatan']);
    $query->execute();
    $detail = $query->fetch();
    
    // cek dulu, datanya ketemu atau tidak. Kalau gk ketemu, ya redirect ke halaman awal
    if(empty($detail)){
      header("Location: daftar-kecamatan.php");
    }
  }else{
    header("Location: daftar-kecamatan.php");
  }

?>
          <a href="daftar-kecamatan.php" class="btn btn-success">Kembali</a>
      <br/>
      <br/>

<form method="POST" action="proses-edit-kecamatan.php">
<input type="hidden" name="id_kecamatan" value="<?=$detail['id_kecamatan']?>" />
<label class="form-label" for="nm_kecamatan">NAMA KECAMATAN</label>
<input class="form-control" type="text" name="nm_kecamatan" value="<?=$detail['nm_kecamatan']?>" required  />
<br/>
<button type="submit" class="btn btn-success">SIMPAN</button>
<button type="reset" class="btn btn-danger">RESET</button>
<br/>
</form>




			
<?php

include "bawah.php"; 

?>