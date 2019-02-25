<?php
require("database.php");
require("helper.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $query = $db->prepare("INSERT INTO tbl_jenis_pangan (nm_jenis) VALUES (:nm_jenis)");
  $query->bindParam("nm_jenis", $_POST['nm_jenis']);
  $query->execute();
}

header("Location: daftar-jenis-pangan.php?aksi=tambah");
?>

