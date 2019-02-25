<?php
$judulatas = "Tambah Jenis Pangan";
$judulhalaman = $judulatas;
include "atas.php"; 

?>
          <a href="daftar-jenis-pangan.php" class="btn btn-success">Kembali</a>
			<br/>
      <br/>
<form method="POST" action="proses-tambah-jenis-pangan.php">
<label class="form-label" for="nm_jenis">NAMA JENIS PANGAN</label>
<input class="form-control" type="text" name="nm_jenis" />
<br/>
<button type="submit" class="btn btn-success">SIMPAN</button>
<button type="reset" class="btn btn-danger">RESET</button>
<br/>
</form>





			
<?php

include "bawah.php"; 

?>
