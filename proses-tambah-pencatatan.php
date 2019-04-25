<?php
session_start();
require("database.php");
require("helper.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $query = $db->prepare("INSERT INTO tbl_pencatatan (tgl_pencatatan, id_pangan, id_kecamatan, harga_jual, harga_beli, nama_pasar, sumber, keterangan, id_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $query->bindParam(1, $_POST['tgl_pencatatan']);
  $query->bindParam(2, $_POST['id_pangan'], PDO::PARAM_INT);
  $query->bindParam(3, $_POST['id_kecamatan'], PDO::PARAM_INT);
  $query->bindParam(4, $_POST['harga_jual'], PDO::PARAM_INT);
  $query->bindParam(5, $_POST['harga_beli'], PDO::PARAM_INT);
  $query->bindParam(6, $_POST['nama_pasar']);
  $query->bindParam(7, $_POST['sumber']);
  $query->bindParam(8, $_POST['keterangan']);
  $query->bindParam(9, $_SESSION['id_user']);
  $query->execute();
}

header("Location: daftar-pencatatan.php?aksi=tambah");
?>

