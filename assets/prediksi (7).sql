-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2022 at 12:36 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prediksi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `level` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Rian', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1'),
(2, 'Regi Oka M', 'regi', '21232f297a57a5a743894a0e4a801fc3', '2');

-- --------------------------------------------------------

--
-- Table structure for table `data_bulanan`
--

CREATE TABLE `data_bulanan` (
  `id_bulanan` int(11) NOT NULL,
  `modelbarang` varchar(255) NOT NULL,
  `ukuran` varchar(15) NOT NULL,
  `bulan` date NOT NULL,
  `tahun` year(4) NOT NULL,
  `terjual` int(255) NOT NULL,
  `idmodel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_bulanan`
--

INSERT INTO `data_bulanan` (`id_bulanan`, `modelbarang`, `ukuran`, `bulan`, `tahun`, `terjual`, `idmodel`) VALUES
(116, 'Abinawa', 'L', '2020-01-31', 2020, 32, 0),
(117, 'Abinawa', 'L', '2020-02-29', 2020, 36, 0),
(118, 'Abinawa', 'L', '2020-03-31', 2020, 40, 0),
(119, 'Abinawa', 'L', '2020-04-30', 2020, 36, 0),
(120, 'Abinawa', 'L', '2020-05-31', 2020, 21, 0),
(121, 'Abinawa', 'L', '2020-06-30', 2020, 24, 0),
(122, 'Abinawa', 'L', '2020-07-31', 2020, 30, 0),
(123, 'Abinawa', 'L', '2020-08-31', 2020, 17, 0),
(124, 'Abinawa', 'L', '2020-09-30', 2020, 19, 0),
(125, 'Abinawa', 'L', '2020-10-31', 2020, 8, 0),
(126, 'Abinawa', 'L', '2020-11-30', 2020, 11, 0),
(127, 'Abinawa', 'L', '2020-12-31', 2020, 36, 0),
(140, 'Abinawa', 'L', '2021-01-31', 2021, 48, 0),
(141, 'Abinawa', 'L', '2021-02-28', 2021, 39, 0),
(142, 'Abinawa', 'L', '2021-03-31', 2021, 35, 0),
(143, 'Abinawa', 'L', '2021-04-30', 2021, 39, 0),
(144, 'Abinawa', 'L', '2021-05-31', 2021, 40, 0),
(145, 'Abinawa', 'L', '2021-06-30', 2021, 36, 0),
(146, 'Abinawa', 'L', '2021-07-31', 2021, 33, 0),
(147, 'Abinawa', 'L', '2021-08-31', 2021, 50, 0),
(148, 'Abinawa', 'L', '2021-09-30', 2021, 46, 0),
(149, 'Abinawa', 'L', '2021-10-31', 2021, 37, 0),
(150, 'Abinawa', 'L', '2021-11-30', 2021, 35, 0),
(151, 'Abinawa', 'L', '2021-12-31', 2021, 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_prediksi`
--

CREATE TABLE `hasil_prediksi` (
  `id` int(11) NOT NULL,
  `modelbarang` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ukuran` varchar(255) CHARACTER SET latin1 NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `data_aktual` int(11) DEFAULT NULL,
  `peramalan` int(11) DEFAULT NULL,
  `id_bulanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_prediksi`
--

INSERT INTO `hasil_prediksi` (`id`, `modelbarang`, `ukuran`, `bulan`, `tahun`, `data_aktual`, `peramalan`, `id_bulanan`) VALUES
(112, 'Abinawa', 'M', 2, 2022, 33, 0, 0),
(113, 'Abinawa', 'M', 6, 2022, 30, 31, 0),
(114, 'Abinawa', 'M', 7, 2022, 0, 31, 0),
(115, 'Abinawa', 'M', 3, 2022, 32, 31, 0),
(116, 'Abinawa', 'L', 1, 2020, 32, 0, 0),
(117, 'Abinawa', 'L', 2, 2020, 36, 34, 0),
(118, 'Abinawa', 'L', 3, 2020, 40, 34, 0),
(119, 'Abinawa', 'L', 4, 2020, 36, 36, 0),
(120, 'Abinawa', 'L', 5, 2020, 21, 34, 0),
(121, 'Abinawa', 'L', 6, 2020, 24, 19, 0),
(122, 'Abinawa', 'L', 7, 2020, 30, 33, 0),
(123, 'Abinawa', 'L', 8, 2020, 17, 34, 0),
(124, 'Abinawa', 'L', 9, 2020, 19, 19, 0),
(125, 'Abinawa', 'L', 10, 2020, 8, 19, 0),
(126, 'Abinawa', 'L', 11, 2020, 11, 22, 0),
(127, 'Abinawa', 'L', 12, 2020, 36, 22, 0),
(128, 'Abinawa', 'L', 1, 2021, 48, 34, 0),
(129, 'BTC', 'M', 1, 2022, 61299, 0, 0),
(130, 'BTC', 'M', 2, 2022, 201, 0, 0),
(131, 'BTC', 'M', 3, 2022, 200, 204, 0),
(132, 'BTC', 'M', 4, 2022, 207, 204, 0),
(133, 'BTC', 'M', 5, 2022, 213, 211, 0),
(134, 'BTC', 'M', 6, 2022, 211, 213, 0),
(135, 'BTC', 'M', 7, 2022, 213, 213, 0),
(136, 'BTC', 'M', 8, 2022, 216, 213, 0),
(137, 'BTC', 'M', 9, 2022, 0, 215, 0),
(138, 'Abinawa', 'L', 2, 2021, 39, 43, 0),
(139, 'Abinawa', 'L', 3, 2021, 35, 36, 0),
(140, 'Abinawa', 'L', 4, 2021, 39, 34, 0),
(141, 'Abinawa', 'L', 5, 2021, 40, 36, 0),
(142, 'Abinawa', 'L', 6, 2021, 36, 36, 0),
(143, 'Abinawa', 'L', 7, 2021, 33, 34, 0),
(144, 'Abinawa', 'L', 8, 2021, 50, 34, 0),
(145, 'Abinawa', 'L', 9, 2021, 46, 43, 0),
(146, 'Abinawa', 'L', 10, 2021, 37, 43, 0),
(147, 'Abinawa', 'L', 11, 2021, 35, 36, 0),
(148, 'Abinawa', 'L', 12, 2021, 50, 34, 0),
(149, 'Abinawa', 'L', 1, 2022, 0, 43, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hpredik`
--

CREATE TABLE `hpredik` (
  `id_hpredik` int(11) NOT NULL,
  `modelbarang` varchar(255) NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `hasil` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hpredik`
--

INSERT INTO `hpredik` (`id_hpredik`, `modelbarang`, `ukuran`, `bulan`, `tahun`, `hasil`, `id`) VALUES
(18, 'Abinawa', 'M', 7, 2022, 31, 0),
(19, 'Abinawa', 'L', 2, 2021, 44, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tmodel`
--

CREATE TABLE `tmodel` (
  `idmodel` int(11) NOT NULL,
  `modelbarang` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ukuran` enum('S','M','L','XL','XXL','XXXL') CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tmodel`
--

INSERT INTO `tmodel` (`idmodel`, `modelbarang`, `ukuran`) VALUES
(19, 'Abinawa', 'M'),
(20, 'Abinawa', 'S'),
(21, 'Abinawa', 'L');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_bulanan`
--
ALTER TABLE `data_bulanan`
  ADD PRIMARY KEY (`id_bulanan`),
  ADD KEY `idmodel` (`idmodel`);

--
-- Indexes for table `hasil_prediksi`
--
ALTER TABLE `hasil_prediksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bulanan` (`id_bulanan`);

--
-- Indexes for table `hpredik`
--
ALTER TABLE `hpredik`
  ADD PRIMARY KEY (`id_hpredik`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tmodel`
--
ALTER TABLE `tmodel`
  ADD PRIMARY KEY (`idmodel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_bulanan`
--
ALTER TABLE `data_bulanan`
  MODIFY `id_bulanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `hasil_prediksi`
--
ALTER TABLE `hasil_prediksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `hpredik`
--
ALTER TABLE `hpredik`
  MODIFY `id_hpredik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tmodel`
--
ALTER TABLE `tmodel`
  MODIFY `idmodel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
