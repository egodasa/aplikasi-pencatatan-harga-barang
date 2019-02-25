<?php
require "database.php";

if(isset($_GET['id_jenis'])){
  $query = $db->prepare("DELETE FROM tbl_jenis_pangan WHERE id_jenis = :id_jenis");
  $query->bindParam("id_jenis", $_GET['id_jenis']);
  $query->execute();
}

// Arahkan user ke halaman meja kembali
header("Location: daftar-jenis-pangan.php?aksi=hapus");
?>
