<?php
require "database.php";
require "helper.php";
$judulatas = "Daftar Pencatatan";
$judulhalaman = $judulatas;
include "atas.php"; 
$skripsi = $db->prepare("SELECT a.id_pencatatan, a.nama_pasar, a.tgl_pencatatan, b.nm_pangan, b.satuan, c.nm_jenis, d.nm_kecamatan, a.harga_jual, a.harga_beli FROM tbl_pencatatan a JOIN tbl_pangan b on a.id_pangan = b.id_pangan JOIN tbl_jenis_pangan c on b.id_jenis = c.id_jenis JOIN tbl_kecamatan d on a.id_kecamatan = d.id_kecamatan"); 
$skripsi->execute();
$daftarpencatatan = $skripsi->fetchAll(PDO::FETCH_ASSOC);

?>
<a href="tambah-pencatatan.php" class="btn btn-success">Tambah Pencatatan</a>
<table id="tabel" class="table table-bordered">
	<thead>
		<tr>
			<td>No</td>
			<td>nama pangan</td>
			<td>jenis</td>
			<td>satuan</td>
			<td>harga beli</td>
			<td>harga jual</td>
			<td>kecamatan</td>
			<td>tanggal pencatatan</td>
			<td>nama pasar</td>
			<td>status</td>
			<td>aksi</td>
		</tr>
	</thead>
	<tbody>
		<?php
foreach($daftarpencatatan as $i=>$dp){
	$lihat = "";
	if($dp['status'] == 0)
	{
		$lihat = "Belum Dilihat";
	}
	else
	{
		$lihat = "Sudah Dilihat";
	}
	echo "<tr>
			<td>".($i+1)."</td>
			<td>$dp[nm_pangan]</td>
			<td>$dp[nm_jenis]</td>
			<td>$dp[satuan]</td>
			<td>".rupiah($dp['harga_beli'])."</td>
			<td>".rupiah($dp['harga_jual'])."</td>
			<td>".$dp['nm_kecamatan']."</td>
			<td>".tanggal_indo($dp['tgl_pencatatan'])."</td>
			<td>".$dp['nama_pasar']."</td>
			<td>".$lihat."</td>
			<td>
            	<a href='hapus-pencatatan.php?id_pencatatan=$dp[id_pencatatan]' class='btn btn-danger'>Hapus</a> 
				<a href='edit-pencatatan.php?id_pencatatan=$dp[id_pencatatan]' class='btn btn-primary'>Edit</a>
			</td>
		</tr>";
}
?>
	</tbody>
</table>

<?php

include "bawah.php"; 

?>
