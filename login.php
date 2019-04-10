<html>
<head>
<title><?=$judul_halaman?></title>
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
<script src="assets/js/autonumeric.js"></script>
</head>
<body class="hold-transition login-page" style="background-color:blue;">
<div class="login-box">
  <div class="login-logo">
    <a href=""></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body table-responsive "style="background-color:black;">
  <?php if(isset($_GET['status'])): ?>
  <?php if($_GET['status'] == 'gagal'): ?>
  <div>
    <p class="alert alert-danger">Username atau password salah!</p> 
  </div>
  <?php endif; ?>
<?php endif; ?>
    <p class="login-box-msg"style="color:white;"><b>SILAHKAN LOGIN</b></p>
    <form action="proses-login.php" method="POST">
      <div class="form-group">
        <label class="form-label"style="color:white;">Username</label>
        <input class="form-control" type="text" name="username" />
      </div>
      <div class="form-group">
        <label class="form-label"style="color:white;">Password</label>
        <input class="form-control" type="password" name="password" />
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-flat"style="background-color:blue;border:2px solid white;">Login</button>
        <button type="reset" class="btn btn-danger btn-flat"style="background-color:blue;border:2px solid white;">Reset</button>
      </div>
    </form>
  </div>
  <script src="assets/js/app_adminlte.js"></script>
</body>
</html>
