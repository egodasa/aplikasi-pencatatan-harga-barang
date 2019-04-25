-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `tbl_jenis_pangan`;
CREATE TABLE `tbl_jenis_pangan` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nm_jenis` varchar(80) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `tbl_jenis_pangan` (`id_jenis`, `nm_jenis`) VALUES
(3,	'Nabati'),
(4,	'Hewani'),
(6,	'pokok'),
(7,	'olahan');

DROP TABLE IF EXISTS `tbl_kecamatan`;
CREATE TABLE `tbl_kecamatan` (
  `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT,
  `nm_kecamatan` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_kecamatan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `tbl_kecamatan` (`id_kecamatan`, `nm_kecamatan`) VALUES
(7,	'Lintau Buo'),
(8,	'padang ganting'),
(9,	'Pagaruyuang'),
(11,	'batipuh selatan'),
(12,	'batipuh '),
(13,	'lima kaum'),
(14,	'lintau buo utara'),
(15,	'pariangan'),
(16,	'rambatan'),
(17,	'salimpaung'),
(18,	'sepuluh kota'),
(19,	'sungayang'),
(20,	'sungai tarab'),
(21,	'tanjung baru'),
(22,	'tanjung emas');

DROP TABLE IF EXISTS `tbl_pangan`;
CREATE TABLE `tbl_pangan` (
  `id_pangan` int(11) NOT NULL AUTO_INCREMENT,
  `nm_pangan` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `satuan` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_pangan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `tbl_pangan` (`id_pangan`, `nm_pangan`, `id_jenis`, `satuan`) VALUES
(8,	'beras kualitas I',	6,	'Kilogram'),
(7,	'padi kualitas I',	6,	'Kilogram'),
(9,	'Gula Pasir',	7,	'Kilogram'),
(10,	'Gula Merah',	3,	'Kilogram'),
(11,	'minyak gorang',	7,	'Kilogram'),
(12,	'beras kualitas II',	6,	'Kilogram'),
(13,	'padi kualitas II',	6,	'Kilogram');

DROP TABLE IF EXISTS `tbl_pekan`;
CREATE TABLE `tbl_pekan` (
  `id_pekan` int(11) NOT NULL AUTO_INCREMENT,
  `pekan` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_pekan`),
  KEY `pekan` (`pekan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_pekan` (`id_pekan`, `pekan`) VALUES
(1,	1),
(2,	2),
(3,	3),
(4,	4),
(5,	5);

DROP TABLE IF EXISTS `tbl_pencatatan`;
CREATE TABLE `tbl_pencatatan` (
  `id_pencatatan` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_pencatatan` date NOT NULL,
  `id_pangan` int(11) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `nama_pasar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=belum dilihat admin, 1=sudah dilihat admin, 2=ditolak admin, 3=belum dilihat dinas, 4=sudah dilihat dinas, 5=ditolak dinas',
  `sumber` text COLLATE latin1_general_ci NOT NULL,
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_pencatatan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `tbl_pencatatan` (`id_pencatatan`, `tgl_pencatatan`, `id_pangan`, `id_kecamatan`, `harga_beli`, `harga_jual`, `nama_pasar`, `status`, `sumber`, `keterangan`, `id_user`) VALUES
(13,	'2018-12-01',	8,	8,	11500,	13000,	'pasar batusangkar',	4,	'',	'',	0),
(14,	'2018-12-01',	12,	8,	10500,	12000,	'',	4,	'',	'',	0),
(15,	'2018-12-08',	8,	7,	12000,	13500,	'',	4,	'',	'',	0),
(16,	'2018-12-08',	12,	7,	11000,	12500,	'',	4,	'',	'',	0),
(17,	'2018-12-15',	8,	7,	12500,	14000,	'',	4,	'',	'',	0),
(18,	'2018-12-15',	12,	7,	11500,	13500,	'',	4,	'',	'',	0),
(19,	'2018-12-22',	8,	7,	10500,	13000,	'',	4,	'',	'',	0),
(20,	'2018-12-22',	12,	7,	10500,	12000,	'',	4,	'',	'',	0),
(21,	'2018-12-29',	8,	7,	11000,	13500,	'',	4,	'',	'',	0),
(22,	'2018-12-29',	12,	7,	12000,	14000,	'',	4,	'',	'',	0),
(24,	'2018-12-01',	13,	7,	5500,	6700,	'',	4,	'',	'',	0),
(25,	'2019-02-03',	8,	8,	12000,	14000,	'',	4,	'',	'',	0),
(26,	'2018-12-03',	8,	7,	12000,	13000,	'',	4,	'',	'',	0),
(27,	'2018-12-05',	8,	8,	9000,	11000,	'',	4,	'',	'',	0),
(28,	'2019-02-11',	8,	8,	7000,	8000,	'',	4,	'',	'',	0),
(29,	'2019-03-26',	7,	8,	13000,	12000,	'pasar simabur',	4,	'',	'',	0),
(30,	'2019-04-14',	8,	7,	11000,	12000,	'Pasar Ganyang',	3,	'Mandan',	'Harga Naik karena lagi naik',	0),
(31,	'2019-04-01',	8,	7,	13000,	12000,	'Pasar Ganyang',	3,	'Sumber',	'keterangan',	0),
(32,	'2019-04-30',	13,	22,	13000,	12000,	'Payakumbuah',	4,	'sumber',	'keterangan',	0),
(33,	'2019-04-30',	8,	7,	13000,	12000,	'Pasar Ganyang',	0,	'dsffsdds',	'fdsfds',	0),
(34,	'2019-04-30',	8,	11,	312,	21312,	'dsasd',	0,	'asddas',	'sadsas',	0),
(35,	'2019-04-23',	8,	11,	12312,	2312,	'saads',	0,	'asasasd',	'assddas',	13);

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` text COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


-- 2019-04-25 14:41:11
