<?php
require "database.php";
$judulatas = "Daftar Pangan";
$judulhalaman = $judulatas;
include "atas.php"; 

$skripsi = $db->prepare("SELECT a.*, b.nm_jenis FROM tbl_pangan a JOIN tbl_jenis_pangan b on a.id_jenis = b.id_jenis"); 
$skripsi->execute();
$daftarpangan = $skripsi->fetchAll(PDO::FETCH_ASSOC);

?>
<a href="tambah-pangan.php" class="btn btn-success">Tambah Daftar Pangan</a>
<div class="table-responsive">
<table id="tabel" style="overflow-x: visible; overflow-y:visible;" class="table table-bordered">
	<thead>
		<tr>
			<td>No</td>
			<td>nama pangan</td>
			<td>jenis</td>
			<td>satuan</td>
			<td>aksi</td>

		</tr>
	</thead>
	<tbody>
		<?php
foreach($daftarpangan as $i=>$dp){
	echo "<tr>
			<td>".($i+1)."</td>
			<td>$dp[nm_pangan]</td>
			<td>$dp[nm_jenis]</td>
			<td>$dp[satuan]</td>
			<td>
            	<a href='hapus-pangan.php?id_pangan=$dp[id_pangan]' class='btn btn-danger'>Hapus</a> 
				<a href='edit-pangan.php?id_pangan=$dp[id_pangan]' class='btn btn-primary'>Edit</a>
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