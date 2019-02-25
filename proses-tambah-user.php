<?php
require("database.php");
require("helper.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $query = $db->prepare("INSERT INTO tbl_user (username, password, nama_lengkap, alamat, level) VALUES (?, md5(?), ?, ?, ?)");
  $query->bindParam(1, $_POST['username']);
  $query->bindParam(2, $_POST['password']);
  $query->bindParam(3, $_POST['nama_lengkap']);
  $query->bindParam(4, $_POST['alamat']);
  $query->bindParam(5, $_POST['level']);
  $query->execute();
}

header("Location: daftar-user.php?aksi=tambah");
?>

