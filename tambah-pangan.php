<?php
require "database.php";
$judulatas = "Tambah Pangan";
$judulhalaman = $judulatas;
include "atas.php"; 
$query = $db->prepare("SELECT * FROM tbl_jenis_pangan");
$query->execute();
$pangan = $query->fetchAll();
?>
          <a href="daftar-pangan.php" class="btn btn-success">Kembali</a>
      <br/>
      <br/>
<form method="POST" action="proses-tambah-pangan.php">
<label class="form-label" for="nm_pangan">NAMA PANGAN</label>
<input class="form-control" type="text" name="nm_pangan" />
<br/>
<label class="form-label" for="id_jenis">JENIS PANGAN</label>
<select class="form-control custom-select" name="id_jenis">
    <?php foreach($pangan as $p): ?>
        <option value="<?=$p['id_jenis']?>"><?=$p['nm_jenis']?></option>
    <?php endforeach; ?>
</select>
<br/>
<label class="form-label" for="satuan">SATUAN</label>
<input class="form-control" type="satuan" name="satuan" />
<br/>
<button type="submit" class="btn btn-success">SIMPAN</button>
<button type="reset" class="btn btn-danger">RESET</button>
<br/>
</form>
			
<?php

include "bawah.php"; 

?>
