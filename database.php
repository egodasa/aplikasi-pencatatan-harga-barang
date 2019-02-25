<?php
$server = "localhost";
$user = "root";
$password = "mysql";
$nama_database = "db_pencatatan";
try {
  $db = new PDO("mysql:host=$server;dbname=$nama_database", $user, $password);
  $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $e) {
    echo "Gagal terhubung. Pesan: ".$e->getMessage();
}
?>
