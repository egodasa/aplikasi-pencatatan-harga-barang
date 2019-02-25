<?php
require "database.php";

if(isset($_GET['id_user'])){
  $query = $db->prepare("DELETE FROM tbl_user WHERE id_user = :id_user");
  $query->bindParam("id_user", $_GET['id_user']);
  $query->execute();
}

// Arahkan user ke halaman meja kembali
header("Location: daftar-user.php?aksi=hapus");
?>
