<?php
require("database.php");
require("helper.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $query = $db->prepare("INSERT INTO tbl_pangan (nm_pangan, id_jenis, satuan) VALUES (:nm_pangan, :id_jenis, :satuan)");
  $query->bindParam("nm_pangan", $_POST['nm_pangan']);
  $query->bindParam("id_jenis", $_POST['id_jenis']);
  $query->bindParam("satuan", $_POST['satuan']);
  $query->execute();
}

header("Location: daftar-pangan.php?aksi=tambah");
?>

