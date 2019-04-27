<?php
  session_start();
  require "database.php";
  require "helper.php";

  $data_pencatatan = [];
  $id_kecamatan = 0;
  
  if(isset($_GET['id_kecamatan']) && $_GET['id_kecamatan'] != 0)
  {
    $sql_tambahan = "";
    if(empty($_GET['bulan']) == FALSE && empty($_GET['tahun']) == FALSE){
      $sql_tambahan .= " AND MONTH(a.tgl_pencatatan) = ".$_GET['bulan']." AND YEAR(a.tgl_pencatatan) = ".$_GET['tahun'];
    }
    if(isset($_GET['id_kecamatan']) && !empty($_GET['id_kecamatan']) && $_GET['id_kecamatan'] != 0){
      $id_kecamatan = $_GET['id_kecamatan'];
      $sql_tambahan .= " AND a.id_kecamatan = $id_kecamatan";
    }
    
    $sql = "SELECT 
              a.nm_pangan,
              a.satuan,
              SUM(IF(b.pekan = 1, a.harga_beli, 0)) AS pekan_1_beli,
              SUM(IF(b.pekan = 2, a.harga_beli, 0)) AS pekan_2_beli,
              SUM(IF(b.pekan = 3, a.harga_beli, 0)) AS pekan_3_beli,
              SUM(IF(b.pekan = 4, a.harga_beli, 0)) AS pekan_4_beli,
              SUM(IF(b.pekan = 5, a.harga_beli, 0)) AS pekan_5_beli,
              SUM(IF(b.pekan = 1, a.harga_jual, 0)) AS pekan_1_jual,
              SUM(IF(b.pekan = 2, a.harga_jual, 0)) AS pekan_2_jual,
              SUM(IF(b.pekan = 3, a.harga_jual, 0)) AS pekan_3_jual,
              SUM(IF(b.pekan = 4, a.harga_jual, 0)) AS pekan_4_jual,
              SUM(IF(b.pekan = 5, a.harga_jual, 0)) AS pekan_5_jual
            FROM (SELECT
              a.*, floor((dayofmonth(a.tgl_pencatatan) - 1) / 7) + 1 AS pekan, b.nm_pangan, b.satuan, c.nm_jenis, d.nm_kecamatan FROM
              tbl_pencatatan a join tbl_pangan b ON a.id_pangan = b.id_pangan join
              tbl_jenis_pangan c ON b.id_jenis = c.id_jenis join tbl_kecamatan d ON
              a.id_kecamatan = d.id_kecamatan WHERE a.status = 4) a right join tbl_pekan b ON
              a.pekan = b.pekan WHERE 1 $sql_tambahan
              GROUP BY a.id_pangan";
    
    $sql .=" ORDER BY a.nm_pangan ASC";
    
    $skripsi = $db->prepare($sql); 
    $skripsi->execute();
    $data_pencatatan = $skripsi->fetchAll(PDO::FETCH_ASSOC);
  }
?>

<html>
  <head>
    <title>Rekap Harga Pangan</title>
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
    <h1>REKAP HARGA PANGAN <br> TINGKAT PRODUSEN DAN KONSUMEN <br> KECAMATAN <?=$_GET['nm_kecamatan']?> <br> BULAN <?=namaBulan($_GET['bulan'])." Tahun ".$_GET['tahun']?></h1>
    
    <table class="tabel" style="border-collapse: collapse;width: 100%;">
      <thead>
        <tr>
          <th class="th" rowspan="2">No</th>
          <th class="th" rowspan="2">Komoditi</th>
          <th class="th" rowspan="2">Harga/<br>Satuan</th>
          <th class="th" colspan="2">Pekan 1</th>
          <th class="th" colspan="2">Pekan 2</th>
          <th class="th" colspan="2">Pekan 3</th>
          <th class="th" colspan="2">Pekan 4</th>
          <th class="th" colspan="2">Pekan 5</th>
          <th class="th" colspan="2">Rata-rata</th>
        </tr>
        <tr>
          <th class="th">Harga Jual</th>
          <th class="th">Harga Beli</th>
          <th class="th">Harga Jual</th>
          <th class="th">Harga Beli</th>
          <th class="th">Harga Jual</th>
          <th class="th">Harga Beli</th>
          <th class="th">Harga Jual</th>
          <th class="th">Harga Beli</th>
          <th class="th">Harga Jual</th>
          <th class="th">Harga Beli</th>
          <th class="th">Harga Jual</th>
          <th class="th">Harga Beli</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $rata_jual = 0;
          $rata_beli = 0;
          foreach($data_pencatatan as $nomor => $d):
            $rata_jual = ($d['pekan_1_jual']+$d['pekan_2_jual']+$d['pekan_3_jual']+$d['pekan_4_jual']+$d['pekan_5_jual'])/5;
            $rata_beli = ($d['pekan_1_beli']+$d['pekan_2_beli']+$d['pekan_3_beli']+$d['pekan_4_beli']+$d['pekan_5_beli'])/5;
        ?>
          <tr>
            <td class="td"><?=($nomor+1)?></td>
            <td class="td"><?=$d['nm_pangan']?></td>
            <td class="td"><?=$d['satuan']?></td>
            <td class="td"><?=$d['pekan_1_jual']?></td>
            <td class="td"><?=$d['pekan_1_beli']?></td>
            <td class="td"><?=$d['pekan_2_jual']?></td>
            <td class="td"><?=$d['pekan_2_beli']?></td>
            <td class="td"><?=$d['pekan_3_jual']?></td>
            <td class="td"><?=$d['pekan_3_beli']?></td>
            <td class="td"><?=$d['pekan_4_jual']?></td>
            <td class="td"><?=$d['pekan_4_beli']?></td>
            <td class="td"><?=$d['pekan_5_jual']?></td>
            <td class="td"><?=$d['pekan_5_beli']?></td>
            <td class="td"><?=$rata_jual?></td>
            <td class="td"><?=$rata_beli?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div style="text-align: left; margin: 30px 30px 10px 0px; float: right;font-size: 10pt;">Batusangkar, <?=tanggal_indo(date("Y-m-d"))?></div>
    <div style="clear: both;"></div>
    <table style="width: 100%;font-size: 10pt;">
      <tr>
        <td style="width: 33%;text-align: center;">
          <b>KEPALA DINAS PANGAN DAN PERIKANAN <br> KABUPATEN TANAH DATAR</b>
          <br>
          <br>
          <br>
          <br>
          <br>
          <b>Ir. DARYANTO SABIR SABIR, M.Si</b> <br>
          NIP. 19610118 198903 1 003
        </td>
        <td style="width: 33%;text-align: center;">
          <b>KABID KDP</b>
          <br>
          <br>
          <br>
          <br>
          <br>
          <b>AZIZKHAN, S.IP</b> <br>
          NIP. 19630310 198601 1 002
        </td>
        <td style="width: 33%;text-align: center;">
          Pelaksana Kegiatan
          <br>
          <br>
          <br>
          <br>
          <br>
          <b>FEBRI RAHMAINI, A.Md</b> <br>
          NIP. 19810228 200604 2 023
        </td>
      </tr>
    </table>
    <script>
      //~ window.print();
    </script>
  </body>
</html>
