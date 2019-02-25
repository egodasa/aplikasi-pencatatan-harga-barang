<?php
$judulatas = "Edit Jenis Pangan";
$judulhalaman = $judulatas;
include "atas.php"; 
if(isset($_GET['id_jenis'])){
    require_once("database.php");
    $query = $db->prepare("SELECT * FROM tbl_jenis_pangan WHERE id_jenis = ? LIMIT 1"); 
    $query->bindParam(1, $_GET['id_jenis']);
    $query->execute();
    $detail = $query->fetch();
    
    // cek dulu, datanya ketemu atau tidak. Kalau gk ketemu, ya redirect ke halaman awal
    if(empty($detail)){
      header("Location: daftar-jenis_pangan.php");
    }
  }else{
    header("Location: daftar-jenis_pangan.php");
  }

?>
          <a href="daftar-jenis-pangan.php" class="btn btn-success">Kembali</a>
      <br/>
      <br/>

<form method="POST" action="proses-edit-jenis-pangan.php">
<input type="hidden" name="id_jenis" value="<?=$detail['id_jenis']?>" />
<label class="form-label" for="nm_jenis">nama jenis pangan</label>
<input class="form-control" type="text" name="nm_jenis" value="<?=$detail['nm_jenis']?>" required />
<br/>
<button type="submit" class="btn btn-success">SIMPAN</button>
<button type="reset" class="btn btn-danger">RESET</button>
<br/>
</form>
			
<?php

include "bawah.php"; 

?>