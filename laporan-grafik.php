<?php
require "database.php";
require "helper.php";
$judulatas = "Daftar Grafik Pencatatan";
$judulhalaman = $judulatas;
include "atas.php";

$tgl = "-- Semua Tanggal --";
$id_pangan = 0;
$id_kecamatan = 0;

if(isset($_GET['id_pangan']))
{
  $id_pangan = $_GET['id_pangan'];
}
if(isset($_GET['id_kecamatan']))
{
  $id_kecamatan = $_GET['id_kecamatan'];
}
if(isset($_GET['tgl_pencatatan']))
{
  $tgl = $_GET['tgl_pencatatan'];
}

$query = $db->prepare("SELECT * FROM tbl_pangan");
$query->execute();
$pangan = $query->fetchAll();

$query = $db->prepare("SELECT * FROM tbl_kecamatan");
$query->execute();
$kecamatan = $query->fetchAll();

$query = $db->prepare("select distinct tgl_pencatatan from tbl_pencatatan order by tgl_pencatatan asc");
$query->execute();
$tgl_pencatatan = $query->fetchAll();

$labels = [];
$harga_jual = [];
$harga_beli = [];

if($tgl != "-- Semua Tanggal --" && $id_pangan != 0 && $id_kecamatan != 0)
{
  $sql = "SELECT 
              a.*,
              b.nm_pangan,
              b.satuan,
              c.nm_jenis,
              d.nm_kecamatan FROM tbl_pencatatan a 
              JOIN tbl_pangan b on a.id_pangan = b.id_pangan 
              JOIN tbl_jenis_pangan c on b.id_jenis = c.id_jenis 
              JOIN tbl_kecamatan d on a.id_kecamatan = d.id_kecamatan
              WHERE a.id_kecamatan = $id_kecamatan AND b.id_pangan = $id_pangan AND MONTH(a.tgl_pencatatan) = MONTH('$tgl') ORDER BY a.tgl_pencatatan ASC";
  $query = $db->prepare($sql);
  $query->execute();
  $hasil = $query->fetchAll();
  
  $waktu_tmp = explode(" ", tanggal_indo($hasil[0]['tgl_pencatatan']));
  $bulan = $waktu_tmp[1];
  $tahun = $waktu_tmp[2];
  
  
  foreach($hasil as $d)
  {
    $labels[] = tanggal_indo($d['tgl_pencatatan']);
    $harga_jual[] = $d['harga_jual'];
    $harga_beli[] = $d['harga_beli'];
  }
  $harga_beli[] = 0;
  $harga_jual[] = 0;
}


?>
<div class="row">
  <form method="GET">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <div class="form-group">
        <label for="id_pangan" class="form-label">Pilih Pangan</label>
        <select class="form-control custom-select" name="id_pangan" id="id_pangan">
          <option value="0" selected disabled>-- Semua Pangan --</option>
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
          <option value="0" selected disabled>-- Semua Kecamatan --</option>
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
<div class="chart">
  <canvas id="grafik_jual" width="100%"></canvas>
</div>=
<script src="assets/js/moment.js"></script>
<script src="assets/js/chart.js"></script>
<script src="assets/js/pikaday.js"></script>
<script>
var labels = <?=json_encode($labels)?>;
var harga_beli = <?=json_encode($harga_beli)?>;
var harga_jual = <?=json_encode($harga_jual)?>;
var tanggal = new Pikaday({
    field: document.getElementById('tgl_pencatatan'),
    format: 'YYYY-MM-DD',
});
document.getElementById("id_pangan").value = <?=$id_pangan?>;
document.getElementById("id_kecamatan").value = <?=$id_kecamatan?>;
document.getElementById("tgl_pencatatan").value = "<?=$tgl?>";

if(document.getElementById("id_pangan").value != "0" && document.getElementById("id_kecamatan").value != "0" && document.getElementById("id_pangan").value != "-- Semua Tanggal --"){
  new Chart(document.getElementById("grafik_jual"), {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [
          {
            label: "Harga Beli",
            backgroundColor: "#3e95cd",
            data: harga_beli
          }, {
            label: "Harga Jual",
            backgroundColor: "#8e5ea2",
            data: harga_jual
          }
        ]
      },
      options: {
        title: {
          display: true,
          text: ["Grafik Harga Jual/Beli <?=ucwords($hasil[0]['nm_pangan'])?>", "<?='Kecamatan '.$hasil[0]['nm_kecamatan']?>", "<?=' Per '.$bulan.' '.$tahun?>"]
        }
      }
  });
}
</script>
<?php

include "bawah.php"; 

?>
