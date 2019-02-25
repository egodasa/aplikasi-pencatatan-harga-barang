<?php
$judulatas = "Tambah Kecamatan";
$judulhalaman = $judulatas;
include "atas.php"; 

?>
<a href="daftar-kecamatan.php" class="btn btn-success">Kembali</a>
<br />
<br />

<form method="POST" action="proses-tambah-kecamatan.php">
    <label class="form-label" for="nm_kecamatan">NAMA KECAMATAN</label>
    <input class="form-control" type="text" name="nm_kecamatan" />
    <br />
    <button type="submit" class="btn btn-success">SIMPAN</button>
    <button type="reset" class="btn btn-danger">RESET</button>
    <br />
</form>




<?php

include "bawah.php"; 

?>