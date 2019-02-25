<?php


function angkaNolDepan($angka){
   return $angka > 9 ? $angka : "0".$angka;
}

function TanggalIndo($date){
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl   = substr($date, 8, 2);
 
    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;        
    return($result);
}


// $hari_inggris contoh : Mon, Tue, Wed, Thu ...
function hariIndo($hari_inggris){
  $hasil = array(
    "Sun" => "Minggu",
    "Mon" => "Senin",
    "Tue" => "Selasa",
    "Wed" => "Rabu",
    "Thu" => "Kamis",
    "Fri" => "Jumat",
    "Sat" => "Sabtu"
  );
  return $hasil[$hari_inggris];
}
// $angka_bulan contoh : 01, 02, 03, 1, 2, 3 ...
function bulanIndo($angka_bulan){
  $hasil = array(
    "01" => "Januari",
    "02" => "Februari",
    "03" => "Maret",
    "04" => "April",
    "05" => "Mei",
    "06" => "Juni",
    "07" => "Juli",
    "08" => "Agustus",
    "09" => "September",
    "10" => "Oktober",
    "11" => "November",
    "12" => "Desember",
    "1" => "Januari",
    "2" => "Februari",
    "3" => "Maret",
    "4" => "April",
    "5" => "Mei",
    "6" => "Juni",
    "7" => "Juli",
    "8" => "Agustus",
    "9" => "September"
  );
  return $hasil[$angka_bulan];
}

function terbilang($satuan){
   $huruf = array ("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh","Sebelas");
   if ($satuan < 12)
      return " ".$huruf[$satuan];
   elseif ($satuan < 20)
      return terbilang($satuan - 10)." Belas";
   elseif ($satuan < 100)
      return terbilang($satuan / 10)." Puluh".terbilang($satuan % 10);
   elseif ($satuan < 200)
      return " Seratus".terbilang($satuan - 100);
   elseif ($satuan < 1000)
      return terbilang($satuan / 100)." Ratus".terbilang($satuan % 100);
   elseif ($satuan < 2000)
      return " Seribu".terbilang($satuan - 1000);
   elseif ($satuan < 1000000)
      return terbilang($satuan / 1000)." Ribu".terbilang($satuan % 1000);
   elseif ($satuan < 1000000000)
      return terbilang($satuan / 1000000)." Juta".terbilang($satuan % 1000000);
   elseif ($satuan >= 1000000000)
      echo "Angka yang Anda masukkan terlalu besar";
   }
function integerToRoman($integer)
{
 // Convert the integer into an integer (just to make sure)
 $integer = intval($integer);
 $result = '';
 
 // Create a lookup array that contains all of the Roman numerals.
 $lookup = array('M' => 1000,
 'CM' => 900,
 'D' => 500,
 'CD' => 400,
 'C' => 100,
 'XC' => 90,
 'L' => 50,
 'XL' => 40,
 'X' => 10,
 'IX' => 9,
 'V' => 5,
 'IV' => 4,
 'I' => 1);
 
 foreach($lookup as $roman => $value){
  // Determine the number of matches
  $matches = intval($integer/$value);
 
  // Add the same number of characters to the string
  $result .= str_repeat($roman,$matches);
 
  // Set the integer to be the remainder of the integer and the value
  $integer = $integer % $value;
 }
 
 // The Roman numeral should be built, return it
 return $result;
}
function tgl_indo($tgl){

			$tanggal = substr($tgl,8,2);

			$bulan = getBulan(substr($tgl,5,2));

			$tahun = substr($tgl,0,4);

			return $tanggal.' '.$bulan.' '.$tahun;		 

	}	



	function getBulan($bln){

				switch ($bln){

					case 1: 

						return "Januari";

						break;

					case 2:

						return "Februari";

						break;

					case 3:

						return "Maret";

						break;

					case 4:

						return "April";

						break;

					case 5:

						return "Mei";

						break;

					case 6:

						return "Juni";

						break;

					case 7:

						return "Juli";

						break;

					case 8:

						return "Agustus";

						break;

					case 9:

						return "September";

						break;

					case 10:

						return "Oktober";

						break;

					case 11:

						return "November";

						break;

					case 12:

						return "Desember";

						break;

				}

			} 
function tanggal_indo($tanggal, $cetak_hari = false)
{
	$hari = array ( 1 =>    'Senin',
				'Selasa',
				'Rabu',
				'Kamis',
				'Jumat',
				'Sabtu',
				'Minggu'
			);
			
	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split 	  = explode('-', $tanggal);
	$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
	
	if ($cetak_hari) {
		$num = date('N', strtotime($tanggal));
		return $hari[$num] . ', ' . $tgl_indo;
	}
	return $tgl_indo;
}
function rupiah($nilai, $simbol = "Rp", $spasi_rupiah = "", $dibelakang_koma = 0, $penutup = "")
{
   // $penutup = ,-
   // $dibelakang_koma = 2 -> ,00
  return $simbol.$spasi_rupiah.number_format($nilai,$dibelakang_koma,',','.').$penutup;
}
function tanggal_indo_waktu($waktu, $hari = false){
  $bagian = explode(" ", $waktu);
  $tanggal = tanggal_indo($bagian[0], $hari);
  return $tanggal." ".$bagian[1];
}
function tanggal_indo_bulan_tahun($tanggal){
   $waktu = explode(" ", tanggal_indo_waktu($tanggal));
   return $waktu[1]." ".$waktu[2];
}
function alertBootstrap($jenis_alert = "success", $judul = "Pesan!", $isi_pesan = "Isi Pesan."){
   $icon_alert = array(
      "success" => "check",
      "warning" => "warning",
      "info" => "info",
      "danger" => "ban",
   );
   return "<div class='alert alert-".$jenis_alert." alert-dismissible'>
   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
   <h4><i class='icon fa fa-".$icon_alert['$jenis_alert']."'></i> ".$judul."</h4>
   ".$isi_pesan."
   </div>";
}
function namaBulan($angka_bulan){
   $bulan = array(
     '01' => 'Januari',
     '02' => 'Februari',
     '03' => 'Maret',
     '04' => 'April',
     '05' => 'Mei',
     '06' => 'Juni',
     '07' => 'Juli',
     '08' => 'Agustus',
     '09' => 'September',
     '10' => 'Oktober',
     '11' => 'November',
     '12' => 'Desember',
     '1' => 'Januari',
     '2' => 'Februari',
     '3' => 'Maret',
     '4' => 'April',
     '5' => 'Mei',
     '6' => 'Juni',
     '7' => 'Juli',
     '8' => 'Agustus',
     '9' => 'September'
   );
   return $bulan[$angka_bulan];
 }

 // Angka dimulai dari 0
 function angkaHuruf($angka){
    $huruf = [
       "A",
       "B",
       "C",
       "D",
       "E",
       "F",
       "G",
       "H",
       "I",
       "J",
       "K",
       "L",
       "M",
       "N",
       "O",
       "P",
       "Q",
       "R",
       "S",
       "T",
       "U",
       "V",
       "W",
       "X",
       "Y",
       "Z"];
   return $huruf[$angka];
}
function warna_acak() {
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}
?>
