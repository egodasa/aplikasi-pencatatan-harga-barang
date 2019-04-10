<?php
require("database.php");
require("helper.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $query = $db->prepare("UPDATE tbl_pencatatan SET tgl_pencatatan = ?, id_pangan = ? , id_kecamatan = ?, harga_jual = ?, harga_beli = ?, nama_pasar= ? WHERE id_pencatatan = ?");
  $query->bindParam(1, $_POST['tgl_pencatatan']);
  $query->bindParam(2, $_POST['id_pangan'], PDO::PARAM_INT);
  $query->bindParam(3, $_POST['id_kecamatan'], PDO::PARAM_INT);
  $query->bindParam(4, $_POST['harga_jual'], PDO::PARAM_INT);
  $query->bindParam(5, $_POST['harga_beli'], PDO::PARAM_INT);
  $query->bindParam(6, $_POST['nama_pasar']);
  $query->bindParam(7, $_POST['id_pencatatan'], PDO::PARAM_INT);
  
  $query->execute();
}

header("Location: daftar-pencatatan.php?aksi=edit");
?>

