<?
  session_start();
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once('database.php');
    $query = $db->prepare("SELECT * FROM tbl_user WHERE username = :username AND password = md5(:password) LIMIT 1");
    $query->bindParam('username', $_POST['username']); 
    $query->bindParam('password', $_POST['password']); 
    $query->execute();
    $data = $query->fetch();
    // Cek apakah username betul atau tidak
    if($data){
      $_SESSION['username'] = $data['username'];
      $_SESSION['level'] = $data['level'];
      $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
      $_SESSION['jk'] = $data['jk'];
      // Cek level agar halaman di redirect sesuai aktor
      if($data['level'] == "Sekretaris")
	  {
        header("Location: daftar-pencatatan.php");
      }
	  else if($data['level'] == "Kepala Dinas")
	  {
        header("Location: daftar-pencatatan.php");
      }
	  else if($data['level'] == "Petugas Lapangan")
	  {
        header("Location: daftar-pencatatan.php");
      }
    }else{
      header("Location: login.php?status=gagal");
    }
  }else{
    header("Location: login.php");
  }
?>
