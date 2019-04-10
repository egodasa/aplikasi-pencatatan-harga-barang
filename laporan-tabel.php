<?php
require "database.php";
require "helper.php";
$judulatas = "Daftar Pencatatan";
$judulhalaman = $judulatas;
include "atas.php";

$tgl = "-- Semua Tanggal --";
$id_pangan = 0;
$id_kecamatan = 0;

$sql = "SELECT a.*, b.nm_pangan, b.satuan, c.nm_jenis, d.nm_kecamatan FROM tbl_pencatatan a JOIN tbl_pangan b on a.id_pangan = b.id_pangan JOIN tbl_jenis_pangan c on b.id_jenis = c.id_jenis JOIN tbl_kecamatan d on a.id_kecamatan = d.id_kecamatan WHERE 1";

if(isset($_GET['tgl_pencatatan']) && !empty($_GET['tgl_pencatatan']) && $_GET['tgl_pencatatan'] != "-- Semua Tanggal --"){
  $tgl = $_GET['tgl_pencatatan'];
  $sql .= " AND MONTH(a.tgl_pencatatan) = MONTH('$tgl')";
}
if(isset($_GET['id_pangan']) && !empty($_GET['id_pangan']) && $_GET['id_pangan'] != 0){
  $id_pangan = $_GET['id_pangan'];
  $sql .= " AND a.id_pangan = $id_pangan";
}
if(isset($_GET['id_kecamatan']) && !empty($_GET['id_kecamatan']) && $_GET['id_kecamatan'] != 0){
  $id_kecamatan = $_GET['id_kecamatan'];
  $sql .= " AND a.id_kecamatan = $id_kecamatan";
}

$sql .=" ORDER BY a.tgl_pencatatan ASC";


$skripsi = $db->prepare($sql); 
$skripsi->execute();
$daftarpencatatan = $skripsi->fetchAll(PDO::FETCH_ASSOC);

$query = $db->prepare("SELECT * FROM tbl_pangan");
$query->execute();
$pangan = $query->fetchAll();

$query = $db->prepare("SELECT * FROM tbl_kecamatan");
$query->execute();
$kecamatan = $query->fetchAll();

?>
<div class="row">
  <form method="GET">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <div class="form-group">
        <label for="id_pangan" class="form-label">Pilih Pangan</label>
        <select class="form-control custom-select" name="id_pangan" id="id_pangan">
          <option value="0">-- Semua Pangan --</option>
          <?php foreach($pangan as $p): ?>
            <option value="<?=$p['id_pangan']?>"><?=$p['nm_pangan']?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <div class="form-group">
        <label for="id_kecamatan" class="form-label">Pilih Kecamatan</label>
        <select class="form-control custom-select" name="id_kecamatan" id="id_kecamatan">
          <option value="0">-- Semua Kecamatan --</option>
          <?php foreach($kecamatan as $p): ?>
            <option value="<?=$p['id_kecamatan']?>"><?=$p['nm_kecamatan']?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <div class="form-group">
        <label class="form-label">
          Pilih Tanggal/Bulan Pencatatan
        </label>
        <div class="input-group input-group-sm">
          <input class="form-control" type="text" id="tgl_pencatatan" name="tgl_pencatatan" value="<?=$tgl?>" readonly />
          <span class="input-group-btn">
            <button type="submit" class="btn btn-info btn-flat">Tampilkan</button>
          </span>
        </div>
      </div>
    </div>
  </form>
</div>
<table id="tabel" class="table table-bordered">
	<thead>
		<tr>
			<td>No</td>
			<td>nama pangan</td>
			<td>jenis</td>
			<td>satuan</td>
			<td>harga beli</td>
			<td>harga jual</td>
			<td>tanggal pencatatan</td>
			<td>nama pasar</td>
			<td>status</td>
			<td>aksi</td>
		</tr>
	</thead>
	<tbody>
		<?php
foreach($daftarpencatatan as $i=>$dp){
	$tombol_status = "";
	if($dp['status'] == 1)
	{
		$tombol_status = "disabled";
	}
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
			<td>".rupiah($dp[harga_beli])."</td>
			<td>".rupiah($dp[harga_jual])."</td>
			<td>".tanggal_indo($dp[tgl_pencatatan])."</td>
			<td>".$dp[nama_pasar]."</td>
			<td>".$lihat."</td>
			<td>
            	<a href='proses-ubah-status.php?id_pencatatan=$dp[id_pencatatan]' class='btn btn-primary' $tombol_status><i class='fa fa-check-square-o'></i> Sudah Dilihat</a> 
			</td>
		</tr>";
}
?>
	</tbody>
</table>
<script src="assets/js/moment.js"></script>
<script src="assets/js/pikaday.js"></script>
<script>
    var tanggal = new Pikaday({
        field: document.getElementById('tgl_pencatatan'),
        format: 'YYYY-MM-DD',
    });
    document.getElementById("id_pangan").value = <?=$id_pangan?>;
    document.getElementById("id_kecamatan").value = <?=$id_kecamatan?>;
</script>
<?php

include "bawah.php"; 

?>
