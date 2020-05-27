-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2020 at 05:38 AM
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
-- Table structure for table `3217015_mtk`
--

CREATE TABLE `3217015_mtk` (
  `id` int(7) DEFAULT NULL,
  `nim` int(11) NOT NULL,
  `nilai` char(1) DEFAULT NULL,
  `tanggal_nilai` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `3217015_mtk`
--

INSERT INTO `3217015_mtk` (`id`, `nim`, `nilai`, `tanggal_nilai`) VALUES
(3217015, 1700018016, 'B', '11:26 - 19/May/2020');

-- --------------------------------------------------------

--
-- Table structure for table `4127878_mtk`
--

CREATE TABLE `4127878_mtk` (
  `id` int(7) DEFAULT NULL,
  `nim` int(11) NOT NULL,
  `nilai` char(1) DEFAULT NULL,
  `tanggal_nilai` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `4127878_mtk`
--

INSERT INTO `4127878_mtk` (`id`, `nim`, `nilai`, `tanggal_nilai`) VALUES
(4127878, 1700018013, 'B', '20:30 - 25/May/2020'),
(4127878, 1700018016, 'A', '11:26 - 19/May/2020');

-- --------------------------------------------------------

--
-- Table structure for table `6584495_mtk_skp`
--

CREATE TABLE `6584495_mtk_skp` (
  `id` int(7) DEFAULT NULL,
  `nim` int(11) NOT NULL,
  `nilai` char(1) DEFAULT NULL,
  `tanggal_nilai` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `6584495_mtk_skp`
--

INSERT INTO `6584495_mtk_skp` (`id`, `nim`, `nilai`, `tanggal_nilai`) VALUES
(6584495, 1700018013, 'C', '20:42 - 25/May/2020'),
(6584495, 1700018016, 'B', '11:25 - 19/May/2020');

-- --------------------------------------------------------

--
-- Table structure for table `6703484_mtk`
--

CREATE TABLE `6703484_mtk` (
  `id` int(7) DEFAULT NULL,
  `nim` int(11) NOT NULL,
  `nilai` char(1) DEFAULT NULL,
  `tanggal_nilai` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `6703484_mtk`
--

INSERT INTO `6703484_mtk` (`id`, `nim`, `nilai`, `tanggal_nilai`) VALUES
(6703484, 1700018013, 'A', '20:30 - 25/May/2020');

-- --------------------------------------------------------

--
-- Table structure for table `7341568_mtk_skp`
--

CREATE TABLE `7341568_mtk_skp` (
  `id` int(7) DEFAULT NULL,
  `nim` int(11) NOT NULL,
  `nilai` char(1) DEFAULT NULL,
  `tanggal_nilai` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `7341568_mtk_skp`
--

INSERT INTO `7341568_mtk_skp` (`id`, `nim`, `nilai`, `tanggal_nilai`) VALUES
(7341568, 1700018013, 'C', '11:22 - 22/May/2020');

-- --------------------------------------------------------

--
-- Table structure for table `data_pc`
--

CREATE TABLE `data_pc` (
  `nia` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `pc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pc`
--

INSERT INTO `data_pc` (`nia`, `nama`, `jabatan`, `pc`) VALUES
(11219, 'Muhammad Fikriffffffffffff', 'Bidang Kader PC Djazman', 'kader'),
(11212, 'asdaassfffffff', 'Ketua Umum PC Djazmana', 'ketum');

-- --------------------------------------------------------

--
-- Table structure for table `descmtk`
--

CREATE TABLE `descmtk` (
  `id` int(7) NOT NULL,
  `A` varchar(300) NOT NULL,
  `B` varchar(300) NOT NULL,
  `C` varchar(300) NOT NULL,
  `D` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `descmtk`
--

INSERT INTO `descmtk` (`id`, `A`, `B`, `C`, `D`) VALUES
(3217015, 'sdasda', 'asasdsd', '', ''),
(4127878, 'AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCC', 'DDDDDDDDDD'),
(6584495, 'CCCCCCCCCCCC', 'BBBBBBasdfabsdwagdwd\r\nasgdfhasgdjahsgdjahsdjwd\r\nashdgfahgsdfhagsfdhagfsdhgasdyr762tuygasduatsdgajstd7astdaysgdjahgsd\r\nasdd\r\nasd', 'CCCCCCCC>>', 'DDDDDD'),
(6703484, '', '', '', ''),
(7341568, 'AA', 'BB', 'CC', 'DD');

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
(3217015, 'KEKA', 2, '', '', 'asd'),
(4127878, 'AL-Quran', 1, '', '', ''),
(6703484, 'Manajemen Organisasi', 2, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `idmtk_skp`
--

CREATE TABLE `idmtk_skp` (
  `id` int(7) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `idmtk_skp`
--

INSERT INTO `idmtk_skp` (`id`, `nama`) VALUES
(6584495, 'SIKAP'),
(7341568, 'SOSIAL');

-- --------------------------------------------------------

--
-- Table structure for table `instruktur`
--

CREATE TABLE `instruktur` (
  `nia` int(11) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `asal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instruktur`
--

INSERT INTO `instruktur` (`nia`, `jabatan`, `nama`, `asal`) VALUES
(34234, 'OB', 'asdasdasd', ''),
(1231232, 'SOT', 'asdsd', 'FTI');

-- --------------------------------------------------------

--
-- Table structure for table `komsat`
--

CREATE TABLE `komsat` (
  `id` int(11) NOT NULL,
  `pelaksana` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `faks` int(11) NOT NULL,
  `periode` varchar(15) NOT NULL,
  `ketua` varchar(50) NOT NULL,
  `telp` int(11) NOT NULL,
  `cabang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komsat`
--

INSERT INTO `komsat` (`id`, `pelaksana`, `alamat`, `kecamatan`, `kota`, `provinsi`, `faks`, `periode`, `ketua`, `telp`, `cabang`) VALUES
(1234567890, 'PK IMM Farmasiaaaaaaa', 'Jalan Prof. Dr. Soepomo S.H.a', 'Jalan Prof. Dr. Soepomo S.H.a', 'Umbulharjoa', 'Daerah Istimewa Yogyakartaa', 2111, '2019/2020a', 'Edy Susantoa', 0, 'Djazman Al Kindia');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `nim` int(11) NOT NULL,
  `namafull` varchar(50) NOT NULL,
  `namapanggil` varchar(20) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `jk` varchar(2) NOT NULL,
  `fakultas` varchar(20) NOT NULL,
  `universitas` varchar(50) NOT NULL,
  `alamat` varchar(80) NOT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `kerja_ayah` varchar(50) NOT NULL,
  `kerja_ibu` varchar(50) NOT NULL,
  `essai` varchar(100) NOT NULL,
  `periode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`nim`, `namafull`, `namapanggil`, `notelp`, `tempat`, `tanggal`, `jk`, `fakultas`, `universitas`, `alamat`, `nama_ayah`, `nama_ibu`, `kerja_ayah`, `kerja_ibu`, `essai`, `periode`) VALUES
(1700018013, 'Refaldi ErgianA', '', '17239123', '', '', 'P', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `peserta_catatan`
--

CREATE TABLE `peserta_catatan` (
  `nim` int(11) NOT NULL,
  `deskripsi` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peserta_catatan`
--

INSERT INTO `peserta_catatan` (`nim`, `deskripsi`) VALUES
(1700018013, 'ALOOOOO ?');

-- --------------------------------------------------------

--
-- Table structure for table `peserta_presensi`
--

CREATE TABLE `peserta_presensi` (
  `nim` int(11) NOT NULL,
  `sakit` int(5) DEFAULT NULL,
  `izin` int(5) DEFAULT NULL,
  `tanpa_ket` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peserta_presensi`
--

INSERT INTO `peserta_presensi` (`nim`, `sakit`, `izin`, `tanpa_ket`) VALUES
(1700018013, 5, 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `3217015_mtk`
--
ALTER TABLE `3217015_mtk`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `4127878_mtk`
--
ALTER TABLE `4127878_mtk`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `6584495_mtk_skp`
--
ALTER TABLE `6584495_mtk_skp`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `6703484_mtk`
--
ALTER TABLE `6703484_mtk`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `7341568_mtk_skp`
--
ALTER TABLE `7341568_mtk_skp`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `data_pc`
--
ALTER TABLE `data_pc`
  ADD PRIMARY KEY (`pc`);

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
-- Indexes for table `idmtk_skp`
--
ALTER TABLE `idmtk_skp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instruktur`
--
ALTER TABLE `instruktur`
  ADD PRIMARY KEY (`nia`);

--
-- Indexes for table `komsat`
--
ALTER TABLE `komsat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `peserta_catatan`
--
ALTER TABLE `peserta_catatan`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `peserta_presensi`
--
ALTER TABLE `peserta_presensi`
  ADD PRIMARY KEY (`nim`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
