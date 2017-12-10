-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2017 at 10:55 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sektknk`
--

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id_departemen` int(11) NOT NULL,
  `nama_departemen` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id_departemen`, `nama_departemen`) VALUES
(1, 'Departemen Informatika'),
(2, 'Departemen Fisika'),
(3, 'Departemen Matematika'),
(4, 'Departemen Biologi'),
(5, 'Departemen Statistika');

-- --------------------------------------------------------

--
-- Table structure for table `detail_dmu`
--

CREATE TABLE `detail_dmu` (
  `id_detail_dmu` int(11) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `id_variabel` int(11) NOT NULL,
  `nilai_variabel` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_dmu`
--

INSERT INTO `detail_dmu` (`id_detail_dmu`, `id_departemen`, `id_variabel`, `nilai_variabel`) VALUES
(4, 2, 1, 18),
(5, 2, 2, 22),
(6, 2, 10, 132),
(8, 2, 11, 4542.5),
(13, 3, 1, 15),
(14, 3, 2, 8),
(15, 3, 10, 62),
(16, 3, 11, 282.5),
(17, 5, 1, 13),
(18, 5, 2, 6),
(19, 5, 10, 55),
(20, 5, 11, 468),
(21, 4, 1, 17),
(22, 4, 2, 32),
(23, 4, 10, 102),
(24, 4, 11, 2485),
(26, 2, 12, 9),
(27, 3, 12, 3),
(28, 4, 12, 6),
(29, 5, 12, 2),
(31, 2, 13, 65),
(32, 3, 13, 95),
(33, 4, 13, 55),
(34, 5, 13, 100.5),
(36, 2, 14, 40),
(37, 3, 14, 20),
(38, 4, 14, 50),
(39, 5, 14, 40),
(41, 2, 15, 77.5),
(42, 3, 15, 57.5),
(43, 4, 15, 462.5),
(44, 5, 15, 302.5),
(45, 1, 1, 21),
(46, 1, 2, 3),
(47, 1, 10, 63),
(48, 1, 11, 450),
(49, 1, 12, 3),
(50, 1, 13, 105),
(51, 1, 14, 50),
(52, 1, 15, 162.5);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `id_departemen`, `username`, `password`, `level`) VALUES
(1, 1, 'Informatika', '270007185d0f4b290ded51f9345a7f29', 'm'),
(2, 2, 'Fisika', '87b9f4e1d6df606bef30a96fc4fdbdef', 'm'),
(3, 3, 'Matematika', '04246ef4da8c2508fbdf25b0efd84521', 'm'),
(4, 5, 'Statistika', '0d64ed0a93535d610e6272327c3f0e6a', 'm'),
(13, 4, 'Biologi', '358dd7dfbb9518bf775f1b3a30013bf5', 'm');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna_khusus`
--

CREATE TABLE `pengguna_khusus` (
  `id_pengguna_khusus` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna_khusus`
--

INSERT INTO `pengguna_khusus` (`id_pengguna_khusus`, `username`, `password`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `perangkingan`
--

CREATE TABLE `perangkingan` (
  `id_perangkingan` int(11) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `nilai_perangkingan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perangkingan`
--

INSERT INTO `perangkingan` (`id_perangkingan`, `id_departemen`, `nilai_perangkingan`) VALUES
(22, 2, 0.345399),
(23, 4, 0.654601);

-- --------------------------------------------------------

--
-- Table structure for table `perhitungan_efisiensi`
--

CREATE TABLE `perhitungan_efisiensi` (
  `id_perhitungan_efisiensi` int(11) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `id_variabel` int(11) NOT NULL,
  `nilai_efisiensi` double NOT NULL,
  `rekomendasi` int(11) NOT NULL,
  `nilai_awal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perhitungan_efisiensi`
--

INSERT INTO `perhitungan_efisiensi` (`id_perhitungan_efisiensi`, `id_departemen`, `id_variabel`, `nilai_efisiensi`, `rekomendasi`, `nilai_awal`) VALUES
(155, 1, 1, 0.47407362606347, 9, 21),
(156, 1, 2, 0.47407362606347, 15, 3),
(157, 1, 12, 0.47407362606347, 4, 3),
(158, 1, 13, 0.47407362606347, 32, 105),
(159, 1, 14, 0.47407362606347, 25, 50),
(160, 2, 1, 1, 18, 18),
(161, 2, 2, 1, 22, 22),
(162, 2, 12, 1, 9, 9),
(163, 2, 13, 1, 65, 65),
(164, 2, 14, 1, 40, 40),
(165, 3, 1, 0.52824034873146, 9, 15),
(166, 3, 2, 0.52824034873146, 11, 8),
(167, 3, 12, 0.52824034873146, 4, 3),
(168, 3, 13, 0.52824034873146, 31, 95),
(169, 3, 14, 0.52824034873146, 20, 20),
(170, 4, 1, 1, 17, 17),
(171, 4, 2, 1, 32, 32),
(172, 4, 12, 1, 6, 6),
(173, 4, 13, 1, 55, 55),
(174, 4, 14, 1, 50, 50),
(175, 5, 1, 0.64797924859844, 11, 13),
(176, 5, 2, 0.64797924859844, 21, 6),
(177, 5, 12, 0.64797924859844, 4, 2),
(178, 5, 13, 0.64797924859844, 36, 101),
(179, 5, 14, 0.64797924859844, 33, 40);

-- --------------------------------------------------------

--
-- Table structure for table `variabel`
--

CREATE TABLE `variabel` (
  `id_variabel` int(11) NOT NULL,
  `nama_variabel` varchar(50) NOT NULL,
  `jenis_variabel` varchar(10) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variabel`
--

INSERT INTO `variabel` (`id_variabel`, `nama_variabel`, `jenis_variabel`, `satuan`, `bobot`) VALUES
(1, 'Jumlah Dosen S2', 'Input', 'orang', 4),
(2, 'Jumlah Dosen S3', 'Input', 'orang', 5),
(10, 'Jumlah Bahan Ajar', 'Output', 'bahan ajar', 5),
(11, 'Jumlah Penelitian di Danai', 'Output', 'juta', 5),
(12, 'Jumlah Tenaga Kependidikan', 'Input', 'orang', 2),
(13, 'Alokasi Dana Penelitian', 'Input', 'juta', 3),
(14, 'Alokasi Dana Pengabdian', 'Input', 'juta', 3),
(15, 'Jumlah Pengabdian di Danai', 'Output', 'juta', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_departemen`);

--
-- Indexes for table `detail_dmu`
--
ALTER TABLE `detail_dmu`
  ADD PRIMARY KEY (`id_detail_dmu`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `pengguna_khusus`
--
ALTER TABLE `pengguna_khusus`
  ADD PRIMARY KEY (`id_pengguna_khusus`);

--
-- Indexes for table `perangkingan`
--
ALTER TABLE `perangkingan`
  ADD PRIMARY KEY (`id_perangkingan`);

--
-- Indexes for table `perhitungan_efisiensi`
--
ALTER TABLE `perhitungan_efisiensi`
  ADD PRIMARY KEY (`id_perhitungan_efisiensi`);

--
-- Indexes for table `variabel`
--
ALTER TABLE `variabel`
  ADD PRIMARY KEY (`id_variabel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_departemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `detail_dmu`
--
ALTER TABLE `detail_dmu`
  MODIFY `id_detail_dmu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pengguna_khusus`
--
ALTER TABLE `pengguna_khusus`
  MODIFY `id_pengguna_khusus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `perangkingan`
--
ALTER TABLE `perangkingan`
  MODIFY `id_perangkingan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `perhitungan_efisiensi`
--
ALTER TABLE `perhitungan_efisiensi`
  MODIFY `id_perhitungan_efisiensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;
--
-- AUTO_INCREMENT for table `variabel`
--
ALTER TABLE `variabel`
  MODIFY `id_variabel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
