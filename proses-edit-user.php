<?php
require("database.php");
require("helper.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $query = $db->prepare("UPDATE tbl_user SET password = md5(?), nama_lengkap = ?, alamat = ?, level = ? WHERE id_user = ?");
  $query->bindParam(1, $_POST['password']);
  $query->bindParam(2, $_POST['nama_lengkap']);
  $query->bindParam(3, $_POST['alamat']);
  $query->bindParam(4, $_POST['level']);
  $query->bindParam(5, $_POST['id_user']);
  $query->execute();
}

header("Location: daftar-user.php?aksi=tambah");
?>

