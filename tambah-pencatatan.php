<?php
require "database.php";
$judulatas = "Tambah Pencatatan";
$judulhalaman = $judulatas;
include "atas.php"; 

$query = $db->prepare("SELECT * FROM tbl_pangan");
$query->execute();
$pangan = $query->fetchAll();

$query = $db->prepare("SELECT * FROM tbl_kecamatan");
$query->execute();
$kecamatan = $query->fetchAll();
?>
<a href="daftar-pencatatan.php" class="btn btn-success">Kembali</a>
<br />
<br />
<form method="POST" action="proses-tambah-pencatatan.php">
    <form method="POST" action="tambah-pencatatan.php">
        <label class="form-label" for="id_pangan">NAMA PANGAN</label>
        <select class="form-control custom-select" name="id_pangan">
            <?php foreach($pangan as $p): ?>
            <option value="<?=$p['id_pangan']?>">
                <?=$p['nm_pangan']?>
            </option>
            <?php endforeach; ?>
        </select>
        <br />
        <label class="form-label" for="id_kecamatan">KECAMATAN</label>
        <select class="form-control custom-select" name="id_kecamatan" readonly>
            <?php foreach($kecamatan as $p): ?>
            <option value="<?=$p['id_kecamatan']?>">
                <?=$p['nm_kecamatan']?>
            </option>
            <?php endforeach; ?>
        </select>
        <?php
          if($_SESSION['level'] == "Petugas Lapangan")
          {
        ?>
            <input type="hidden" name="id_kecamatan" value="<?=$_SESSION['id_kecamatan']?>" />
        <?php
          }
        ?>
		<br/>
		<label class="form-label" for="nama_pasar">Nama Pasar</label>
        <input class="form-control" type="text" name="nama_pasar" />
        <br />
        <label class="form-label" for="tgl_pencatatan">TANGGAL</label>
        <input class="form-control" type="input" name="tgl_pencatatan" id="tgl_pencatatan" value="pilih tanggal" />
        <br />
        <label class="form-label" for="harga_jual">HARGA JUAL</label>
        <input class="form-control" type="number" name="harga_jual" />
        <br />
        <label class="form-label" for="harga_beli">HARGA BELI</label>
        <input class="form-control" type="text" name="harga_beli" />
        <br />
        <label class="form-label" for="sumber">SUMBER DATA</label>
        <textarea name="sumber" class="form-control" name="sumber"></textarea>
        <br />
        <label class="form-label" for="keterangan">KETERANGAN</label>
        <textarea name="keterangan" class="form-control" name="keterangan"></textarea>
        <br />
        
        <button type="submit" class="btn btn-success">SIMPAN</button>
        <button type="reset" class="btn btn-danger">RESET</button>
        <br />
    </form>

    <script src="assets/js/moment.js"></script>
    <script src="assets/js/pikaday.js"></script>
    <script>
        var tanggal = new Pikaday({
            field: document.getElementById('tgl_pencatatan'),
            format: 'YYYY-MM-DD',
        });
        <?php
          if($_SESSION['level'] == "Petugas Lapangan")
          {
        ?>
            document.getElementsByName("id_kecamatan")[0].value = "<?=$_SESSION['id_kecamatan']?>";
            document.getElementsByName("id_kecamatan")[0].disabled = true;
        <?php
          }
        ?>
    </script>
    <?php
    include "bawah.php"; 
?>
