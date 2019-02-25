<?php
require "database.php";

if(isset($_GET['id_pangan'])){
  $query = $db->prepare("DELETE FROM tbl_pangan WHERE id_pangan = :id_pangan");
  $query->bindParam("id_pangan", $_GET['id_pangan']);
  $query->execute();
}

// Arahkan user ke halaman meja kembali
header("Location: daftar-pangan.php?aksi=hapus");
?>
