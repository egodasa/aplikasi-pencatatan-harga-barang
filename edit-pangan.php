<?php
if(isset($_GET['id_pangan'])){
    require_once("database.php");
    $query = $db->prepare("SELECT * FROM tbl_pangan WHERE id_pangan = ? LIMIT 1"); 
    $query->bindParam(1, $_GET['id_pangan']);
    $query->execute();
    $detail = $query->fetch();

    $query = $db->prepare("SELECT * FROM tbl_jenis_pangan");
    $query->execute();
    $pangan = $query->fetchAll();
    
    // cek dulu, datanya ketemu atau tidak. Kalau gk ketemu, ya redirect ke halaman awal
    if(empty($detail)){
      header("Location: daftar-pangan.php");
    }
  }else{
    header("Location: daftar-pangan.php");
  }
  $judulatas = "Edit Pangan";
  $judulhalaman = $judulatas;
  include "atas.php";  
?>
<a href="daftar-pangan.php" class="btn btn-success">Kembali</a>
<br />
<br />

<form method="POST" action="proses-edit-pangan.php">
<input type="hidden" name="id_pangan" value="<?=$detail['id_pangan']?>" />
  <label class="form-label" for="nm_pangan">NAMA PANGAN</label>
  <input class="form-control" type="text" name="nm_pangan" value="<?=$detail['nm_pangan']?>" required />
  <br />
  <label class="form-label" for="id_jenis">JENIS PANGAN</label>
  <select class="form-control custom-select" id="id_jenis" name="id_jenis">
    <?php foreach($pangan as $p): ?>
        <option value="<?=$p['id_jenis']?>"><?=$p['nm_jenis']?></option>
    <?php endforeach; ?>
  </select>
  <br />
  <label class="form-label" for="satuan">SATUAN</label>
  <input class="form-control" type="satuan" name="satuan" value="<?=$detail['satuan']?>" required />
  <br />
  <button type="submit" class="btn btn-success">SIMPAN</button>
  <button type="reset" class="btn btn-danger">RESET</button>
  <br />
</form>
<script>
  document.getElementById("id_jenis").value = <?=$detail['id_jenis']?>
</script>
<?php

include "bawah.php"; 

?>