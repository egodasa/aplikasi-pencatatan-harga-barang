<?php
require("database.php");
require("helper.php");
  $query = $db->prepare("UPDATE tbl_pencatatan SET status = 1 WHERE id_pencatatan = ?");
  $query->bindParam(1, $_GET['id_pencatatan'], PDO::PARAM_INT);
  
  $query->execute();

header("Location: laporan-tabel.php");
?>

