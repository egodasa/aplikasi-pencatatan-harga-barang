<?
  session_start();
  if(isset($_SESSION['username'])){
    unset($_SESSION['username']);
    unset($_SESSION['level']);
    unset($_SESSION['jk']);
  }
  header("Location: login.php");
?>
