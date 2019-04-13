<?php
require "database.php";
require "helper.php";
$judulatas = "Daftar Pencatatan";
$judulhalaman = $judulatas;
include "atas.php";

$tgl = "-- Semua Tanggal --";
$id_pangan = 0;
$id_kecamatan = 0;

$sql = "SELECT a.* FROM (SELECT a.*,FLOOR((DAYOFMONTH(a.tgl_pencatatan) - 1) / 7) + 1 AS pekan, b.nm_pangan, b.satuan, c.nm_jenis, d.nm_kecamatan FROM tbl_pencatatan a JOIN tbl_pangan b on a.id_pangan = b.id_pangan JOIN tbl_jenis_pangan c on b.id_jenis = c.id_jenis JOIN tbl_kecamatan d on a.id_kecamatan = d.id_kecamatan) a WHERE a.status = 4";

if(empty($_GET['bulan']) == FALSE && empty($_GET['tahun']) == FALSE){
  $sql .= " AND MONTH(a.tgl_pencatatan) = ".$_GET['bulan']." AND YEAR(a.tgl_pencatatan) = ".$_GET['tahun'];
}
if(empty($_GET['pekan']) == FALSE){
  $sql .= " AND a.pekan = '".$_GET['pekan']."'";
}
if(isset($_GET['id_pangan']) && !empty($_GET['id_pangan']) && $_GET['id_pangan'] != 0){
  $id_pangan = $_GET['id_pangan'];
  $sql .= " AND a.id_pangan = $id_pangan";
}
if(isset($_GET['id_kecamatan']) && !empty($_GET['id_kecamatan']) && $_GET['id_kecamatan'] != 0){
  $id_kecamatan = $_GET['id_kecamatan'];
  $sql .= " AND a.id_kecamatan = $id_kecamatan";
}

if($_SESSION['level'] == 'Kepala Dinas')
{
  // Dinas hanya melihat status pencatatan yang sudah diacc admin
  $sql .= " AND a.status >= 3";
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
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
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
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
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
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
      <div class="form-group">
        <label for="bulan" class="form-label">Pilih Bulan</label>
        <select class="form-control custom-select" name="bulan" id="bulan">
          <option value="">-- Pilih Bulan --</option>
          <option value="1">Januari</option>
          <option value="2">Februari</option>
          <option value="3">Maret</option>
          <option value="4">April</option>
          <option value="5">Mei</option>
          <option value="6">Juni</option>
          <option value="7">Juli</option>
          <option value="8">Agustus</option>
          <option value="9">September</option>
          <option value="10">Oktober</option>
          <option value="11">November</option>
          <option value="12">Desember</option>
        </select>
      </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
      <div class="form-group">
        <label for="pekan" class="form-label">Pekan</label>
        <input type="number" name="pekan" class="form-control" min=1 max=5 value="<?=isset($_GET['pekan']) ? $_GET['pekan'] : ""?>"/>
      </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
      <div class="input-group input-group-sm">
        <label for="tahun" class="form-label">Tahun</label>
        <input type="number" min=2000 max=2100 name="tahun" class="form-control">
          <span class="input-group-btn">
            <button style="margin-top: 25px;" type="submit" class="btn btn-info btn-flat">Lihat Hasil</button>
          </span>
      </div>
    </div>
  </form>
  <script>
    document.getElementsByName("bulan")[0].value = "<?=isset($_GET['bulan']) ? $_GET['bulan'] : ""?>";
    document.getElementsByName("tahun")[0].value = "<?=isset($_GET['tahun']) ? $_GET['tahun'] : ""?>";
    document.getElementsByName("id_kecamatan")[0].value = "<?=isset($_GET['id_kecamatan']) ? $_GET['id_kecamatan'] : "0"?>";
    document.getElementsByName("id_pangan")[0].value = "<?=isset($_GET['id_pangan']) ? $_GET['id_pangan'] : "0"?>";
  </script>
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
		</tr>
	</thead>
	<tbody>
		<?php
foreach($daftarpencatatan as $i=>$dp){
  echo "<tr>
			<td>".($i+1)."</td>
			<td>$dp[nm_pangan]</td>
			<td>$dp[nm_jenis]</td>
			<td>$dp[satuan]</td>
			<td>".rupiah($dp['harga_beli'])."</td>
			<td>".rupiah($dp['harga_jual'])."</td>
			<td>Pekan ".$dp['pekan'].", ".tanggal_indo($dp['tgl_pencatatan'])."</td>
			<td>".$dp['nama_pasar']."</td>
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
</script>
<?php

include "bawah.php"; 

?>
