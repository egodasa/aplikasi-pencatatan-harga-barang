<?
  session_start();
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  	$level = "";
  	if($_POST['user'] == "kepaladinas")
	  {
      $level = "Kepala Dinas";
    }
	  else if($_POST['user'] == "petugas")
	  {
      $level = "Petugas Lapangan";
    }
	  else if($_POST['user'] == "sekretaris")
	  {
      $level = "Sekretaris";
    }
    require_once('database.php');
    $query = $db->prepare("SELECT * FROM tbl_user WHERE username = :username AND password = md5(:password) AND level = :level LIMIT 1");
    $query->bindParam('username', $_POST['username']); 
    $query->bindParam('password', $_POST['password']); 
    $query->bindParam('level', $level); 
    $query->execute();
    $data = $query->fetch();
    // Cek apakah username betul atau tidak
    if($data){
      $_SESSION['id_user'] = $data['id_user'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['level'] = $data['level'];
      $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
      $_SESSION['jk'] = $data['jk'];
      $_SESSION['id_kecamatan'] = $data['id_kecamatan'];
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
      header("Location: login.php?status=gagal&user=".$_POST['user']);
    }
  }else{
    header("Location: login.php?user=".$_POST['user']);
  }
?>
