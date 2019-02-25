<?php
require("database.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $query = $db->prepare("UPDATE tbl_pangan SET nm_pangan = :nm_pangan, id_jenis = :id_jenis , satuan = :satuan WHERE id_pangan = :id_pangan");
  $query->bindParam("nm_pangan", $_POST['nm_pangan']);
  $query->bindParam("id_pangan", $_POST['id_pangan']);
  $query->bindParam("id_jenis", $_POST['id_jenis']);
  $query->bindParam("satuan", $_POST['satuan']);
  $query->execute();
}

header("Location: daftar-pangan.php?aksi=edit");
?>

