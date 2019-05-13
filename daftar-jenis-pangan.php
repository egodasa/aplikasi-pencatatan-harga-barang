<?php
require "database.php";
$judulatas = "Daftar Jenis Pangan";
$judulhalaman = $judulatas;
include "atas.php"; 

$skripsi = $db->prepare("SELECT * FROM tbl_jenis_pangan"); 
$skripsi->execute();
$daftarjenispangan = $skripsi->fetchAll(PDO::FETCH_ASSOC);

?>
<a href="tambah-jenis-pangan.php" class="btn btn-success">Tambah Daftar Jenis Pangan</a>
<div class="table-responsive">
<table id="tabel" style="overflow-x: visible; overflow-y:visible;" class="table table-bordered">
	<thead>
	<tr style="background-color: #3C8DBC;">
			<td><font color='white'><b>No</b></td>
			<td><font color='white'><b>Nama Jenis Pangan</b></td>
			<td><font color='white'><b>Aksi</b></td>

		</tr>
	</thead>
	<tbody>
		<?php
foreach($daftarjenispangan as $i=>$jp){
	echo "<tr>
			<td>".($i+1)."</td>
			<td>$jp[nm_jenis]</td>
			<td>
            	<a href='hapus-jenis-pangan.php?id_jenis=$jp[id_jenis]' class='btn btn-danger'>Hapus</a> 
				<a href='edit-jenis-pangan.php?id_jenis=$jp[id_jenis]' class='btn btn-primary'>Edit</a>
			</td>
		</tr>
	";
}
?>


	</tbody>
</table>
</div>

<?php

include "bawah.php"; 

?>