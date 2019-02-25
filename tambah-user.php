<?php
$judulatas = "Tambah User";
$judulhalaman = $judulatas;
include "atas.php"; 

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
<label class="form-label" for="level">LEVEL</label>
<select class="form-control" name="level">
	<option value="Kepala Dinas">kepala dinas</option>
	<option value="Sekretaris">sekretaris</option>
</select>
</div>

<button type="submit" class="btn btn-success">SIMPAN</button>
<button type="reset" class="btn btn-danger">RESET</button>

</form>

<?php

include "bawah.php"; 

?>


			
			
        

    
