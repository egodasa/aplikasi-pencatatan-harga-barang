<?php
require("database.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $query = $db->prepare("UPDATE tbl_kecamatan SET nm_kecamatan = :nm_kecamatan WHERE id_kecamatan = :id_kecamatan");
  $query->bindParam("id_kecamatan", $_POST['id_kecamatan']);
  $query->bindParam("nm_kecamatan", $_POST['nm_kecamatan']);
  $query->execute();
}

header("Location: daftar-kecamatan.php?aksi=edit");
?>

