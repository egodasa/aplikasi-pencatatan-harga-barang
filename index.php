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
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="skin-blue layout-top-nav" style="height: auto; min-height: 100%;">
  <div class="wrapper" style="height: auto; min-height: 100%;">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="../../index2.html" class="navbar-brand"><b>PEMERINTAH KABUPATEN TANAH DATAR</b></a>
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
            	<li><a data-toggle="modal" data-target="#modal-default" href="#">Petunjuk</a></li>
            	<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Login <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="login.php?user=admin">Login Admin</a></li>
                <li><a href="login.php?user=kepaladinas">Login Kepala Dinas</a></li>
                <li><a href="login.php?user=petugas">Login Petugas</a></li>
              </ul>
            </li>
            </ul>
          </div>
          <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
      </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper" style="min-height: 324px;background-image:url('assets/img/pangan1.jpg');background-repeat: no-repeat;background-position: center;background-size: cover;">
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
  $data_pencatatan = [];
  $id_pangan = 0;
  $id_kecamatan = 0;
  
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
  
  if(isset($_GET['id_pangan']) && isset($_GET['id_kecamatan']) && $_GET['id_pangan'] != 0 && $_GET['id_kecamatan'] != 0)
  {
    $sql_tambahan = "";
    if(empty($_GET['bulan']) == FALSE && empty($_GET['tahun']) == FALSE){
      $sql_tambahan .= " AND MONTH(a.tgl_pencatatan) = ".$_GET['bulan']." AND YEAR(a.tgl_pencatatan) = ".$_GET['tahun'];
    }
    if(empty($_GET['pekan']) == FALSE){
      $sql_tambahan .= " AND a.pekan = '".$_GET['pekan']."'";
    }
    if(isset($_GET['id_pangan']) && !empty($_GET['id_pangan']) && $_GET['id_pangan'] != 0){
      $id_pangan = $_GET['id_pangan'];
      $sql_tambahan .= " AND a.id_pangan = $id_pangan";
    }
    if(isset($_GET['id_kecamatan']) && !empty($_GET['id_kecamatan']) && $_GET['id_kecamatan'] != 0){
      $id_kecamatan = $_GET['id_kecamatan'];
      $sql_tambahan .= " AND a.id_kecamatan = $id_kecamatan";
    }

    $sql = "SELECT a.*, b.pekan as waktu_pekan FROM (SELECT a.*,FLOOR((DAYOFMONTH(a.tgl_pencatatan) - 1) / 7) + 1 AS pekan, b.nm_pangan, b.satuan, c.nm_jenis, d.nm_kecamatan FROM tbl_pencatatan a JOIN tbl_pangan b on a.id_pangan = b.id_pangan JOIN tbl_jenis_pangan c on b.id_jenis = c.id_jenis JOIN tbl_kecamatan d on a.id_kecamatan = d.id_kecamatan WHERE a.status = 4 $sql_tambahan) a RIGHT JOIN tbl_pekan b ON a.pekan = b.pekan WHERE 1";
    
    $sql .=" ORDER BY b.pekan ASC";
    
    $skripsi = $db->prepare($sql); 
    $skripsi->execute();
    $data_pencatatan = $skripsi->fetchAll(PDO::FETCH_ASSOC);
  
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
                        <option value="">-- Pilih Pangan --</option>
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
                        <option value="">-- Pilih Kecamatan --</option>
                        <?php foreach($kecamatan as $p): ?>
                        <option value="<?=$p['id_kecamatan']?>"><?=$p['nm_kecamatan']?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
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
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="input-group input-group-sm">
                      <label for="tahun" class="form-label">Tahun</label>
                      <input type="number" min=2000 max=2100 name="tahun" class="form-control">
                      <span class="input-group-btn">
                        <button style="margin-top: 25px;" type="submit" class="btn btn-info btn-flat">Lihat
                          Hasil</button>
                      </span>
                    </div>
                  </div>
                </form>
                <script>
                  document.getElementsByName("bulan")[0].value = "<?=isset($_GET['bulan']) ? $_GET['bulan'] : ""?>";
                  document.getElementsByName("tahun")[0].value = "<?=isset($_GET['tahun']) ? $_GET['tahun'] : ""?>";
                  document.getElementsByName("id_kecamatan")[0].value =
                    "<?=isset($_GET['id_kecamatan']) ? $_GET['id_kecamatan'] : ""?>";
                  document.getElementsByName("id_pangan")[0].value =
                    "<?=isset($_GET['id_pangan']) ? $_GET['id_pangan'] : ""?>";
                </script>
              </div>
            </div>
          </div>
        <div class="box" style="height: 700px;">
        <div class="box-body">
              <div class="chart" style="height: 700px;">
                <canvas id="grafik_jual" width="100%"></canvas>
              </div>
            </div>
        </div> 
				<div class="modal fade" id="modal-default" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Penggunaan</h4>
              </div>
              <div class="modal-body">
                <p>Puji syukur kehadirat Tuhan Yang Maha Esa karena anugerah dari-Nya kami dapat menyelesaikan program yang dapat membantu masyarakat dalam melihat daftar harga pangan di kabupaten tanah datar
Berikut tata cara melihat daftar harga pangan :</p>
<ol>
	<li>Pilih pangan apa yang ingin saudara lihat harganya</li>
	<li>pilih kecamatan yang ingin saudara lihat</li>
	<li>Kemudian pilih bulan dan tahun</li>
	<li>Klik lihat hasil dan saudara akan melihat daftar dan grafik harga pangan di kabupaten tanah datar</li>
</ol>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
          <script src="assets/js/moment.js"></script>
          <script src="assets/js/chart.js"></script>
          <script src="assets/js/pikaday.js"></script>
          <script>
            var data_pencatatan = <?=json_encode($data_pencatatan)?>;
            var labels = [];
            var harga_beli = [];
            var harga_jual = [];
            var banyak_data = data_pencatatan.length;
            var nama_pangan = document.getElementsByName("id_pangan")[0].options[document.getElementsByName(
              "id_pangan")[0].selectedIndex].text;
            var nama_kecamatan = document.getElementsByName("id_kecamatan")[0].options[document.getElementsByName(
              "id_kecamatan")[0].selectedIndex].text;
            var nama_bulan = document.getElementsByName("bulan")[0].options[document.getElementsByName("bulan")[0]
              .selectedIndex].text;
            var nama_tahun = document.getElementsByName("tahun")[0].value;

            var tanggal = new Pikaday({
              field: document.getElementById('tgl_pencatatan'),
              format: 'YYYY-MM-DD',
            });

            if (document.getElementById("id_pangan").value != "0" && document.getElementById("id_kecamatan").value !=
              "0" && document.getElementById("id_pangan").value != "-- Semua Tanggal --" && data_pencatatan.length != 0
            ) {

              for (var x = 0; x < banyak_data; x++) {
                harga_beli.push(data_pencatatan[x].harga_beli);
                harga_jual.push(data_pencatatan[x].harga_jual);
                labels.push("Pekan " + data_pencatatan[x].waktu_pekan);
              }

              new Chart(document.getElementById("grafik_jual"), {
                type: 'bar',
                data: {
                  labels: labels,
                  datasets: [{
                    label: "Harga Beli",
                    backgroundColor: "#3e95cd",
                    data: harga_beli
                  }, {
                    label: "Harga Jual",
                    backgroundColor: "#8e5ea2",
                    data: harga_jual
                  }]
                },
                options: {
                  title: {
                    display: true,
                    text: ['Grafik Fluktuasi Harga Pangan ' + nama_pangan, 'Bulan ' + nama_bulan + ' Tahun ' +
                      nama_tahun
                    ]
                  },
                  scales: {
                    yAxes: [{
                      ticks: {
                        beginAtZero: true
                      }
                    }]
                  }
                }
              });
            }
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

</body>

</html>