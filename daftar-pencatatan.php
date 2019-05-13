<?php
require "database.php";
require "helper.php";
$judulatas = "Daftar Pencatatan";
$judulhalaman = $judulatas;
include "atas.php"; 

$sql_where = "";

if($_SESSION['level'] == 'Kepala Dinas')
{
  // Dinas hanya melihat status pencatatan yang sudah diacc admin
  $sql_where = "AND a.status = 3";
}
else if($_SESSION['level'] == 'Sekretaris')
{
  $sql_where = "AND a.status < 3";
}

if($_SESSION['level'] == 'Petugas Lapangan')
{
  $sql_where .= "AND a.id_user = ".$_SESSION['id_user'];
}

$skripsi = $db->prepare("SELECT a.status, a.id_pencatatan, a.nama_pasar, a.tgl_pencatatan, a.sumber, a.keterangan, b.nm_pangan, b.satuan, c.nm_jenis, d.nm_kecamatan, a.harga_jual, a.harga_beli FROM tbl_pencatatan a JOIN tbl_pangan b on a.id_pangan = b.id_pangan JOIN tbl_jenis_pangan c on b.id_jenis = c.id_jenis JOIN tbl_kecamatan d on a.id_kecamatan = d.id_kecamatan WHERE 1 $sql_where"); 
$skripsi->execute();
$daftarpencatatan = $skripsi->fetchAll(PDO::FETCH_ASSOC);

?>

<?php
  if($_SESSION['level'] == "Petugas Lapangan" || $_SESSION['level'] == 'Sekretaris')
  {
?>
  <a href="tambah-pencatatan.php" class="btn btn-success">Tambah Pencatatan</a>
<?php
  }
?>
<div class="table-responsive">
<table id="tabel" style="overflow-x: visible; overflow-y:visible;" class="table table-bordered">
	<thead>
	<tr style="background-color: #3C8DBC;">
      <td><font color='white'><b>Aksi</b></td>
			<td><font color='white'><b>No</b></td>
			<td><font color='white'><b>Nama Pangan</b></td>
			<td><font color='white'><b>Jenis</td>
			<td><font color='white'><b>Satuan</b></td>
			<td><font color='white'><b>Harga Beli</b></td>
			<td><font color='white'><b>Harga Jual</b></td>
			<td><font color='white'><b>Kecamatan</b></td>
			<td><font color='white'><b>Tanggal Pencatatan</b></td>
			<td><font color='white'><b>Nama Pasar</b></td>
			<td><font color='white'><b>Sumber Data</b></td>
			<td><font color='white'><b>Keterangan</b></td>
			<td><font color='white'><b>Status</b></td>
		</tr>
	</thead>
	<tbody>
		<?php
foreach($daftarpencatatan as $i=>$dp){
	$lihat = "";
  switch($dp['status']){
    case 0 :
      $lihat = "Belum Dilihat Admin";
    break;
    case 1 :
      $lihat = "Diterima Admin";
    break;
    case 2 :
      $lihat = "Ditolak Admin";
    break;
    case 3 :
      $lihat = "Belum Dilihat Kepala Dinas";
    break;
    case 4 :
      $lihat = "Diterima Kepala Dinas";
    break;
    case 5 :
      $lihat = "Ditolak Kepala Dinas";
    break;
  }
	echo "<tr>
      <td>
        <div class='dropdown'>
          <a class='btn btn-default tipsy-kiri-atas dropdown-toggle' type='button' data-toggle='dropdown'>Aksi</a>
          <ul class='dropdown-menu'>";
          
  if($_SESSION['level'] == 'Sekretaris')
  {
    echo "<li><a href='edit-pencatatan.php?id_pencatatan=$dp[id_pencatatan]'><i class='fa fa-pencil'> </i> Edit</a></li>
            <li><a href='hapus-pencatatan.php?id_pencatatan=$dp[id_pencatatan]'><i class='fa fa-trash'> </i> Hapus</a></li>
            <li class='divider'></li>";
    echo "<li><a href='proses-ubah-status.php?id_pencatatan=$dp[id_pencatatan]&status=3'><i class='fa fa-check'> </i> Terima Data</a></li>";
    echo "<li><a href='proses-ubah-status.php?id_pencatatan=$dp[id_pencatatan]&status=2'><i class='fa fa-close'> </i> Tolak Data</a></li>";
  }
  else if($_SESSION['level'] == 'Kepala Dinas')
  {
    echo "<li><a href='proses-ubah-status.php?id_pencatatan=$dp[id_pencatatan]&status=4'><i class='fa fa-check'> </i> Terima Data</a></li>";
    echo "<li><a href='proses-ubah-status.php?id_pencatatan=$dp[id_pencatatan]&status=5'><i class='fa fa-close'> </i> Tolak Data</a></li>";
  }
  echo "</ul>
        </div>
			</td>
			<td>".($i+1)."</td>
			<td>$dp[nm_pangan]</td>
			<td>$dp[nm_jenis]</td>
			<td>$dp[satuan]</td>
			<td>".rupiah($dp['harga_beli'])."</td>
			<td>".rupiah($dp['harga_jual'])."</td>
			<td>".$dp['nm_kecamatan']."</td>
			<td>".tanggal_indo($dp['tgl_pencatatan'])."</td>
			<td>".$dp['nama_pasar']."</td>
      <td>".$dp['sumber']."</td>
      <td>".$dp['keterangan']."</td>
			<td>".$lihat."</td>
      
		</tr>";
}
?>
	</tbody>
</table>
</div>

<?php

include "bawah.php"; 

?>
