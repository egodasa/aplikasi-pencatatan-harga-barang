-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 15, 2019 at 03:09 PM
-- Server version: 5.7.25-log
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mandanon_catat`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_pangan`
--

CREATE TABLE `tbl_jenis_pangan` (
  `id_jenis` int(11) NOT NULL,
  `nm_jenis` varchar(80) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_jenis_pangan`
--

INSERT INTO `tbl_jenis_pangan` (`id_jenis`, `nm_jenis`) VALUES
(3, 'Nabati'),
(4, 'Hewani'),
(6, 'pokok'),
(7, 'olahan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kecamatan`
--

CREATE TABLE `tbl_kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `nm_kecamatan` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_kecamatan`
--

INSERT INTO `tbl_kecamatan` (`id_kecamatan`, `nm_kecamatan`) VALUES
(7, 'Lintau Buo'),
(8, 'padang ganting'),
(9, 'Pagaruyuang'),
(11, 'batipuh selatan'),
(12, 'batipuh '),
(13, 'lima kaum'),
(14, 'lintau buo utara'),
(15, 'pariangan'),
(16, 'rambatan'),
(17, 'salimpaung'),
(18, 'sepuluh kota'),
(19, 'sungayang'),
(20, 'sungai tarab'),
(21, 'tanjung baru'),
(22, 'tanjung emas');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pangan`
--

CREATE TABLE `tbl_pangan` (
  `id_pangan` int(11) NOT NULL,
  `nm_pangan` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `satuan` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_pangan`
--

INSERT INTO `tbl_pangan` (`id_pangan`, `nm_pangan`, `id_jenis`, `satuan`) VALUES
(8, 'beras kualitas I', 6, 'Kilogram'),
(7, 'padi kualitas I', 6, 'Kilogram'),
(9, 'Gula Pasir', 7, 'Kilogram'),
(10, 'Gula Merah', 3, 'Kilogram'),
(11, 'minyak gorang', 7, 'Kilogram'),
(12, 'beras kualitas II', 6, 'Kilogram'),
(13, 'padi kualitas II', 6, 'Kilogram');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pencatatan`
--

CREATE TABLE `tbl_pencatatan` (
  `id_pencatatan` int(11) NOT NULL,
  `tgl_pencatatan` date NOT NULL,
  `id_pangan` int(11) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_pencatatan`
--

INSERT INTO `tbl_pencatatan` (`id_pencatatan`, `tgl_pencatatan`, `id_pangan`, `id_kecamatan`, `harga_beli`, `harga_jual`) VALUES
(11, '2019-01-14', 6, 7, 21000, 23000),
(10, '2019-01-08', 6, 8, 19500, 20000),
(9, '2019-01-07', 6, 7, 20000, 22000),
(8, '2019-01-02', 6, 8, 20000, 21000),
(7, '2019-01-01', 6, 7, 20000, 23000),
(12, '2019-01-13', 6, 8, 19000, 20500),
(13, '2018-12-01', 8, 8, 11500, 13000),
(14, '2018-12-01', 12, 8, 10500, 12000),
(15, '2018-12-08', 8, 7, 12000, 13500),
(16, '2018-12-08', 12, 7, 11000, 12500),
(17, '2018-12-15', 8, 7, 12500, 14000),
(18, '2018-12-15', 12, 7, 11500, 13500),
(19, '2018-12-22', 8, 7, 10500, 13000),
(20, '2018-12-22', 12, 7, 10500, 12000),
(21, '2018-12-29', 8, 7, 11000, 13500),
(22, '2018-12-29', 12, 7, 12000, 14000),
(23, '2018-12-01', 7, 7, 5000, 6000),
(24, '2018-12-01', 13, 7, 5500, 6700),
(25, '2019-02-03', 8, 8, 12000, 14000),
(26, '2018-12-03', 8, 7, 12000, 13000),
(27, '2018-12-05', 8, 8, 9000, 11000),
(28, '2019-02-11', 8, 8, 7000, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` text COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama_lengkap`, `alamat`, `level`) VALUES
(8, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', 'Sekretaris'),
(7, 'mandan', 'e070e2dd9634c6c078a59218cdca9e23', 'eqwwq', ' wqeww', 'Sekretaris'),
(4, 'rafi', '139c4e89cdbedaf144d05ca54a12a57b', 'rafi', 'fsfsd', 'Kepala Dinas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_jenis_pangan`
--
ALTER TABLE `tbl_jenis_pangan`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `tbl_kecamatan`
--
ALTER TABLE `tbl_kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `tbl_pangan`
--
ALTER TABLE `tbl_pangan`
  ADD PRIMARY KEY (`id_pangan`);

--
-- Indexes for table `tbl_pencatatan`
--
ALTER TABLE `tbl_pencatatan`
  ADD PRIMARY KEY (`id_pencatatan`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_jenis_pangan`
--
ALTER TABLE `tbl_jenis_pangan`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_kecamatan`
--
ALTER TABLE `tbl_kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_pangan`
--
ALTER TABLE `tbl_pangan`
  MODIFY `id_pangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_pencatatan`
--
ALTER TABLE `tbl_pencatatan`
  MODIFY `id_pencatatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
