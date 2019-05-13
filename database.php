<?php
$server = "localhost";
$user = "mandanon_catat";
$password = "qwe123*IOP";
$nama_database = "mandanon_catat";
try {
  $db = new PDO("mysql:host=$server;dbname=$nama_database", $user, $password);
  $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $e) {
    echo "Gagal terhubung. Pesan: ".$e->getMessage();
}
?>
