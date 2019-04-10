<?php
session_start();
?>
<html>
<head>
  <title>
    <?php echo $judulatas; ?>
  </title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
</head>

<body class="skin-blue sidebar-mini" style="height: auto; min-height: 100%;">
  <div class="wrapper" style="height: auto; min-height: 100%;">

    <!-- Bagian Header -->
    <header class="main-header">
      <a href="../../index2.html" class="logo">
        <span class="logo-mini"><b>PP</b></span>
        <span class="logo-lg"><b>Pengolahan Pangan</b></span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
          </ul>
        </div>
      </nav>
    </header>
    <!-- Akhir dari Bagian Header -->

    <!-- Bagian Sidebar/Menu -->
    <aside class="main-sidebar">
      <section class="sidebar" style="height: auto;">
        <div class="user-panel">
          <div class="pull-left image">
            <img src="assets/img/laki.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>
              <?=$_SESSION['username']?><br/><?=$_SESSION['level']?>
            </p>
            <a href='proses-logout.php'>Logout</a>
          </div>
        </div>
        <ul class="sidebar-menu tree" data-widget="tree">
          <li class="header">MENU</li>
          <?php if($_SESSION['level'] == 'Sekretaris'): ?>
          <li>
            <a href="daftar-jenis-pangan.php">
              <i class="fa fa-list-alt"></i> <span>Daftar Jenis Pangan</span>
            </a>
          </li>
          <li>
            <a href="daftar-kecamatan.php">
              <i class="fa fa-list-alt"></i> <span>Daftar Kecamatan</span>
            </a>
          </li>
          <li>
            <a href="daftar-pangan.php">
              <i class="fa fa-list-alt"></i> <span>Daftar Pangan</span>
            </a>
          </li>
          <li>
            <a href="daftar-pencatatan.php">
              <i class="fa fa-list-alt"></i> <span>Daftar Pencatatan</span>
            </a>
          </li>
          <li>
            <a href="daftar-user.php">
              <i class="fa fa-list-alt"></i> <span>Daftar User</span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-paste"></i> <span>Laporan Pencatatan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="laporan-tabel.php"><i class="fa fa-circle-o"></i> Tabel</a></li>
              <li><a href="laporan-grafik.php"><i class="fa fa-circle-o"></i> Grafik</a></li>
            </ul>
          </li>
          <?php elseif($_SESSION['level'] == 'Petugas Lapangan'): ?>
          <li>
            <a href="daftar-pencatatan.php">
              <i class="fa fa-list-alt"></i> <span>Daftar Pencatatan</span>
            </a>
          </li>
          <?php else: ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-paste"></i> <span>Laporan Pencatatan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="laporan-tabel.php"><i class="fa fa-circle-o"></i> Tabel</a></li>
              <li><a href="laporan-grafik.php"><i class="fa fa-circle-o"></i> Grafik</a></li>
            </ul>
          </li>
          <?php endif; ?>
        </ul>
      </section>
    </aside>
    <!-- Akhir dari Bagian Sidebar/Menu -->

    <div class="content-wrapper" style="min-height: 901px;">

      <!-- Bagian Kontent/Isi Halaman -->
      <section class="content">
        <div class="box">

          <!-- Bagian Judul Halaman -->
          <div class="box-header with-border">
            <h3 class="box-title">
              <?php echo $judulhalaman; ?>
            </h3>
          </div>
          <!-- Akhir dari Bagian Judul Halaman -->

          <!-- Bagian Isi Halaman -->
          <div class="box-body">
