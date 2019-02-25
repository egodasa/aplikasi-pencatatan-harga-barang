<?php
require "database.php";

if(isset($_GET['id_pencatatan'])){
  $query = $db->prepare("DELETE FROM tbl_pencatatan WHERE id_pencatatan = ?");
  $query->bindParam(1, $_GET['id_pencatatan']);
  $query->execute();
}

// Arahkan user ke halaman meja kembali
header("Location: daftar-pencatatan.php?aksi=hapus");
?>
