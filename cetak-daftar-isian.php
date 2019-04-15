<?php
  session_start();
  require "database.php";
  require "helper.php";

  $data_pencatatan = [];
  $id_pangan = 0;
  $id_kecamatan = 0;
  $data_pencatatan = [];
  
  if(isset($_GET['id_kecamatan']) && $_GET['id_kecamatan'] != 0)
  {
    $sql_tambahan = "";
    if(empty($_GET['bulan']) == FALSE && empty($_GET['tahun']) == FALSE){
      $sql_tambahan .= " AND MONTH(a.tgl_pencatatan) = ".$_GET['bulan']." AND YEAR(a.tgl_pencatatan) = ".$_GET['tahun'];
    }
    if(isset($_GET['id_pangan']) && !empty($_GET['id_pangan']) && $_GET['id_pangan'] != 0){
      $id_pangan = $_GET['id_pangan'];
      $sql_tambahan .= " AND a.id_pangan = $id_pangan";
    }
    if(isset($_GET['id_kecamatan']) && !empty($_GET['id_kecamatan']) && $_GET['id_kecamatan'] != 0){
      $id_kecamatan = $_GET['id_kecamatan'];
      $sql_tambahan .= " AND a.id_kecamatan = $id_kecamatan";
    }

    $sql = "SELECT a.*, b.pekan as waktu_pekan FROM (SELECT a.*,FLOOR((DAYOFMONTH(a.tgl_pencatatan) - 1) / 7) + 1 AS pekan, b.nm_pangan, b.satuan, c.nm_jenis, d.nm_kecamatan FROM tbl_pencatatan a JOIN tbl_pangan b on a.id_pangan = b.id_pangan JOIN tbl_jenis_pangan c on b.id_jenis = c.id_jenis JOIN tbl_kecamatan d on a.id_kecamatan = d.id_kecamatan WHERE a.status = 4 $sql_tambahan) a RIGHT JOIN tbl_pekan b ON a.pekan = b.pekan WHERE 1";
    if(empty($_GET['pekan']) == FALSE){
      $sql .= " AND b.pekan = '".$_GET['pekan']."'";
    }
    $sql .=" ORDER BY b.pekan ASC";
    
    $skripsi = $db->prepare($sql); 
    $skripsi->execute();
    $data_pencatatan = $skripsi->fetchAll(PDO::FETCH_ASSOC);
  
  }
?>

<html>
  <head>
    <title>Daftar Isian</title>
    <style>
      @page {
        size: A4 portrait;
        margin: 20px 30px;
      }
      @media print {
        @page {
          size: A4 portrait;
          margin: 20px 30px;
        }
        body {
          size: A4 portrait;
          font-family: Arial, Helvetica, 'Times New Roman';
          font-size: 12pt;
        }
        h1 {
          text-align: center;
          font-size: 12pt;
        }
        table .tabel{
          border: 3px solid black;
          border-collapse: collapse;
          width: 100%;
        }
        table .tabel, th .th, td .td{
          font-size: 12pt;
        }
        table .th, table .td {
          border: 1px solid black;
          padding: 5px;
        }
      }
      body {
        size: A4 portrait;
        font-family: Arial, Helvetica, 'Times New Roman';
        font-size: 12pt;
      }
      h1 {
        text-align: center;
        font-size: 12pt;
      }
      table .tabel{
        border: 3px solid black;
        border-collapse: collapse;
        width: 100%;
      }
      table .tabel, th .th, td .td{
        font-size: 12pt;
      }
      table .th, table .td {
        border: 1px solid black;
        padding: 5px;
      }
      table .th {
        background-color: #E5E5E5;
      }
    </style>
  </head>
  <body>
    <h1>DAFTAR ISIAN PEMANTAUAN HARGA PANGAN <br> TINGKAT PRODUSEN DAN KONSUMEN</h1>
    <table style="width: 300px;">
      <tr>
        <td>Kecamatan</td>
        <td>:</td>
        <td><?=$_GET['nm_kecamatan']?></td>
      </tr>
      <tr>
        <td>Minggu</td>
        <td>:</td>
        <td><?=$_GET['pekan']?></td>
      </tr>
      <tr>
        <td>Bulan</td>
        <td>:</td>
        <td><?=$_GET['bulan']?></td>
      </tr>
    </table>
    <br/>
    <br/>
    <br/>
    <table class="tabel" style="border-collapse: collapse;width: 100%;">
      <thead>
        <tr>
          <th class="th" rowspan="2">No</th>
          <th class="th" rowspan="2">Satuan</th>
          <th class="th" colspan="2">Harga (Rp)</th>
          <th class="th" rowspan="2">Penyebab Fluktuasi Harga</th>
        </tr>
        <tr>
          <th class="th">Produsen</th>
          <th class="th">Konsumen</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($data_pencatatan as $nomor => $d): ?>
          <tr>
            <td class="td"><?=($nomor+1)?></td>
            <td class="td"><?=$d['nm_pangan']?></td>
            <td class="td" style="text-align: right;"><?=rupiah($d['harga_beli'])?></td>
            <td class="td" style="text-align: right;"><?=rupiah($d['harga_jual'])?></td>
            <td class="td"><?=$d['keterangan']?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div style="text-align: left; margin: 30px 30px 10px 0px; float: right;font-size: 10pt;">Batusangkar, <?=tanggal_indo(date("Y-m-d"))?></div>
    <div style="clear: both;"></div>
    <div style="text-align: center; margin: 30px 30px 10px 30px; float: left;font-size: 10pt;">Diketahui: <br> Kepala Dinas Pangan dan Perikanan <br> Kabupaten Tanah Datar <br> <br> <b>Ir. Daryanto Sabir, M.Si</b><br>NIP. 19610118 198903 1 003</div>
    <div style="text-align: center; margin: 30px 30px 10px 30px; float: right;font-size: 10pt;"><b>Petugas Pemantauan</b> <br> <br> <br> <br> <b> <br><?=$_SESSION['nama_lengkap']?></b></div>
    <div style="clear: both;"></div>
    <script>
      window.print();
    </script>
  </body>
</html>
