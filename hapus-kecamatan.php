<?php
require "database.php";

if(isset($_GET['id_kecamatan'])){
  $query = $db->prepare("DELETE FROM tbl_kecamatan WHERE id_kecamatan = :id_kecamatan");
  $query->bindParam("id_kecamatan", $_GET['id_kecamatan']);
  $query->execute();
}

// Arahkan user ke halaman meja kembali
header("Location: daftar-kecamatan.php?aksi=hapus");
?>

