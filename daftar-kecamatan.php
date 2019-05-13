<?php
require "database.php";
$judulatas = "Daftar Kecamatan";
$judulhalaman = $judulatas;
include "atas.php"; 

$skripsi = $db->prepare("SELECT * FROM tbl_kecamatan"); 
$skripsi->execute();
$daftarkecamatan = $skripsi->fetchAll(PDO::FETCH_ASSOC);
?>
<a href="tambah-kecamatan.php" class="btn btn-success">Tambah Daftar Kecamatan</a>
<div class="table-responsive">
<table id="tabel" style="overflow-x: visible; overflow-y:visible;" class="table table-bordered">
	<thead>
		<tr style="background-color: #3C8DBC;">
			<td><font color='white'><b>No</b></td>
			<td><font color='white'><b>Nama Kecamatan</b></td>
			<td><font color='white'><b>Aksi</b></td>
		</tr>
	</thead>
	<tbody>


		<?php
foreach($daftarkecamatan as $i=>$kcmtn){
	echo "<tr>
			<td>".($i+1)."</td>
			<td>$kcmtn[nm_kecamatan]</td>
			<td>
            	<a href='hapus-kecamatan.php?id_kecamatan=$kcmtn[id_kecamatan]' class='btn btn-danger'>Hapus</a> 
				<a href='edit-kecamatan.php?id_kecamatan=$kcmtn[id_kecamatan]' class='btn btn-primary'>Edit</a>
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