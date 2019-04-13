<?php
  require "database.php";
  require "helper.php";
?>
<html style="height: auto; min-height: 100%;">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Data Harga Jual/Beli</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="assets/adminlte/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/adminlte/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/adminlte/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/adminlte/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/adminlte/skins/_all-skins.min.css">
  <link rel="stylesheet" href="assets/adminlte/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/pikaday.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="skin-blue layout-top-nav" style="height: auto; min-height: 100%;">
<div class="wrapper" style="height: auto; min-height: 100%;">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../../index2.html" class="navbar-brand">Dinas Batusangkar</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li><a href="login.php">Login</a></li>
            </ul>
          </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper" style="min-height: 324px;">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Grafik Harga Jual/Beli Pangan
        </h1>
        
      </section>

      <!-- Main content -->
      <section class="content">
<?php
  $query = $db->prepare("SELECT * FROM tbl_pangan");
  $query->execute();
  $pangan = $query->fetchAll();
  
  $query = $db->prepare("SELECT * FROM tbl_kecamatan");
  $query->execute();
  $kecamatan = $query->fetchAll();
  
  $query = $db->prepare("select distinct tgl_pencatatan from tbl_pencatatan WHERE status = 4 order by tgl_pencatatan asc");
  $query->execute();
  $tgl_pencatatan = $query->fetchAll();
  
  $hasil = [];
  if(isset($_GET['id_pangan']) && isset($_GET['id_kecamatan']) && isset($_GET['bulan']) && isset($_GET['tahun']))
  {
     $id_pangan = $_GET['id_pangan'];
    $id_kecamatan = $_GET['id_kecamatan'];
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];
    
    $labels = [];
    $harga_jual = [];
    $harga_beli = [];
  
    $sql = "SELECT a.* FROM (SELECT 
                a.*,
                b.nm_pangan,
                b.satuan,
                c.nm_jenis,
                d.nm_kecamatan,
                FLOOR((DAYOFMONTH(a.tgl_pencatatan) - 1) / 7) + 1 AS pekan FROM tbl_pencatatan a 
                JOIN tbl_pangan b on a.id_pangan = b.id_pangan 
                JOIN tbl_jenis_pangan c on b.id_jenis = c.id_jenis 
                JOIN tbl_kecamatan d on a.id_kecamatan = d.id_kecamatan) a 
                  RIGHT JOIN tbl_pekan b ON a.pekan = b.pekan
                WHERE a.id_kecamatan = $id_kecamatan AND a.id_pangan = $id_pangan AND MONTH(a.tgl_pencatatan) = MONTH($bulan) AND YEAR(a.tgl_pencatatan) = YEAR($tahun) AND a.status = 4 ORDER BY b.pekan ASC";
    echo $sql;
    exit;
    $query = $db->prepare($sql);
    $query->execute();
    $hasil = $query->fetchAll();
    
    if(empty($hasil) == FALSE)
    {
      $waktu_tmp = explode(" ", tanggal_indo($hasil[0]['pekan']));
      $bulan = $waktu_tmp[1];
      $tahun = $waktu_tmp[2];
      
      
      foreach($hasil as $d)
      {
        $labels[] = tanggal_indo($d['pekan']);
        $harga_jual[] = $d['harga_jual'];
        $harga_beli[] = $d['harga_beli'];
      }
      $harga_beli[] = 0;
      $harga_jual[] = 0;
    }
  }



?>
<div class="box">
  <div class="box-body">
<div class="row">
  <form method="GET">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
      <div class="form-group">
        <label for="id_pangan" class="form-label">Pilih Pangan</label>
        <select class="form-control custom-select" name="id_pangan" id="id_pangan" required>
          <option value="" selected disabled>-- Pilih Pangan --</option>
          <?php foreach($pangan as $p): ?>
            <option value="<?=$p['id_pangan']?>"><?=$p['nm_pangan']?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
      <div class="form-group">
        <label for="id_kecamatan" class="form-label">Pilih Kecamatan</label>
        <select class="form-control custom-select" name="id_kecamatan" id="id_kecamatan" required>
          <option value="" selected disabled>-- Pilih Kecamatan --</option>
          <?php foreach($kecamatan as $p): ?>
            <option value="<?=$p['id_kecamatan']?>"><?=$p['nm_kecamatan']?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
      <div class="form-group">
        <label for="bulan" class="form-label">Pilih Bulan</label>
        <select class="form-control custom-select" name="bulan" id="bulan" required>
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
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
      <div class="form-group">
        <label for="tahun" class="form-label">Tahun</label>
        <input type="number" name="tahun" class="form-control" required />
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Lihat</button>
      </div>
    </div>
  </form>
</div>
<div class="chart">
  <canvas id="grafik_jual" width="100%"></canvas>
</div>
</div>
</div>
<script src="assets/js/moment.js"></script>
<script src="assets/js/chart.js"></script>
<script src="assets/js/pikaday.js"></script>
<script>
var tanggal = new Pikaday({
  field: document.getElementById('tgl_pencatatan'),
  format: 'YYYY-MM-DD',
});

<?php if(empty($hasil) == FALSE): ?>
  
  var labels = <?=json_encode($labels)?>;
  var harga_beli = <?=json_encode($harga_beli)?>;
  var harga_jual = <?=json_encode($harga_jual)?>;
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
<?php endif; ?>
</script>
      
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright © 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<script src="assets/js/app_adminlte.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap.min.js"></script>

</body></html>
