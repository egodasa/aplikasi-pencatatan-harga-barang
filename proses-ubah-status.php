<?php
require("database.php");
require("helper.php");
  $query = $db->prepare("UPDATE tbl_pencatatan SET status = ? WHERE id_pencatatan = ?");
  $query->bindParam(1, $_GET['status'], PDO::PARAM_INT);
  $query->bindParam(2, $_GET['id_pencatatan'], PDO::PARAM_INT);
  
  $query->execute();

header("Location: daftar-pencatatan.php");
?>

