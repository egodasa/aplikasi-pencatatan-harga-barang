<?php
require("database.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $query = $db->prepare("UPDATE tbl_jenis_pangan SET nm_jenis = :nm_jenis WHERE id_jenis = :id_jenis");
  $query->bindParam("id_jenis", $_POST['id_jenis']);
  $query->bindParam("nm_jenis", $_POST['nm_jenis']);
  $query->execute();
}

header("Location: daftar-jenis-pangan.php?aksi=edit");
?>

