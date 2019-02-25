<?php
require("database.php");
require("helper.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $query = $db->prepare("INSERT INTO tbl_kecamatan (nm_kecamatan) VALUES (:nm_kecamatan)");
  $query->bindParam("nm_kecamatan", $_POST['nm_kecamatan']);
  $query->execute();
}

header("Location: daftar-kecamatan.php?aksi=tambah");
?>

