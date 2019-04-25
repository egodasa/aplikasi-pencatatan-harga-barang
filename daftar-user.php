<?php
require "database.php";
$judulatas = "Daftar User";
$judulhalaman = $judulatas;
include "atas.php"; 
$skripsi = $db->prepare("SELECT a.*, b.nm_kecamatan FROM tbl_user a LEFT JOIN tbl_kecamatan b ON a.id_kecamatan = b.id_kecamatan"); 
$skripsi->execute();
$daftarpangan = $skripsi->fetchAll(PDO::FETCH_ASSOC);

?>

<a href="tambah-user.php" class="btn btn-success">Tambah User</a>
<div class="table-responsive">
	<table id="tabel" style="overflow-x: visible; overflow-y:visible;" class="table table-bordered">
		<thead>
			<tr>
				<td>No</td>
				<td>username</td>
				<td>nama lengkap</td>
				<td>alamat</td>
				<td>kecamatan</td>
				<td>level</td>
				<td>aksi</td>
			</tr>
		</thead>
		<tbody>
			<?php
foreach($daftarpangan as $i=>$dp){
	echo 
      "<tr>
			<td>".($i+1)."</td>
			<td>$dp[username]</td>
			<td>$dp[nama_lengkap]</td>
			<td>$dp[alamat]</td>
			<td>$dp[nm_kecamatan]</td>
			<td>$dp[level]</td>
			<td>
            	<a href='hapus-user.php?id_user=$dp[id_user]' class='btn btn-danger'>Hapus</a> 
				<a href='edit-user.php?id_user=$dp[id_user]' class='btn btn-primary'>Edit</a>
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
