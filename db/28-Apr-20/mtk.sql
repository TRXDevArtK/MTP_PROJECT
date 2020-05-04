-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2020 at 06:41 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtk`
--

-- --------------------------------------------------------

--
-- Table structure for table `descmtk`
--

CREATE TABLE `descmtk` (
  `id` int(7) NOT NULL,
  `A` varchar(100) NOT NULL,
  `B` varchar(100) NOT NULL,
  `C` varchar(100) NOT NULL,
  `D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `descmtk`
--

INSERT INTO `descmtk` (`id`, `A`, `B`, `C`, `D`) VALUES
(5184637, 'fffffffff', 'sasSSSSSSS', 'ddddd', 'eeeeeeeee'),
(8452947, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `idmtk`
--

CREATE TABLE `idmtk` (
  `id` int(7) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `semester` int(2) NOT NULL,
  `thn` varchar(9) NOT NULL,
  `kelas` char(1) NOT NULL,
  `kkm` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `idmtk`
--

INSERT INTO `idmtk` (`id`, `nama`, `semester`, `thn`, `kelas`, `kkm`) VALUES
(5184637, 'ABCDdaaaaaaaa', 3, '2019/2021', 'D', 'FD'),
(8452947, 'asdwdd', 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `nilaimtk`
--

CREATE TABLE `nilaimtk` (
  `nim` int(11) NOT NULL,
  `8452947` char(1) NOT NULL,
  `5184637` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilaimtk`
--

INSERT INTO `nilaimtk` (`nim`, `8452947`, `5184637`) VALUES
(1900023096, '', 'D'),
(1900023183, '', ''),
(1900023246, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `no` int(11) NOT NULL,
  `nim` int(11) NOT NULL,
  `namafull` varchar(50) NOT NULL,
  `namapanggil` varchar(20) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `jk` varchar(2) NOT NULL,
  `fakultas` varchar(20) NOT NULL,
  `universitas` varchar(50) NOT NULL,
  `alamat` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`no`, `nim`, `namafull`, `namapanggil`, `notelp`, `tempat`, `tanggal`, `jk`, `fakultas`, `universitas`, `alamat`) VALUES
(1, 1900023096, 'Awalia Rezky Adnisyar', 'Eky', '89620774352', 'Batam', '05/10/1998', 'P', 'Farmasi', 'Universitas Ahmad Dahlan', 'Jl bimosari nomor 241B Umbulharjo Yogyakarta'),
(2, 1900023183, 'Syamsy Salsabilla Riasty Putri Jumaldi', 'Abil', '85339040642', 'Maumere', '08/09/2001', 'P', 'Farmasi', 'Universitas Ahmad Dahlan', 'Jln. Janturan no 54/52, Rt 16/4,Warungboto ,Umbulh'),
(3, 1900023246, 'Annisa Awalia Rahma Mh Sibadu', 'Nisaa', '82265088341', 'Luwuk', '4/15/2000', 'P', 'Farmasi', 'Universitas Ahmad Dahlan', 'jalan Menukan 273 Asrama Putri MBS Karang Kajen, K');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `descmtk`
--
ALTER TABLE `descmtk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `idmtk`
--
ALTER TABLE `idmtk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilaimtk`
--
ALTER TABLE `nilaimtk`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`nim`),
  ADD UNIQUE KEY `no` (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
