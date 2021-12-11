-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2020 at 06:56 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `2372416_mtk`
--

CREATE TABLE `2372416_mtk` (
  `id` int(7) DEFAULT NULL,
  `nim` int(11) NOT NULL,
  `nilai` char(1) DEFAULT NULL,
  `tanggal_nilai` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `5329266_mtk`
--

CREATE TABLE `5329266_mtk` (
  `id` int(7) DEFAULT NULL,
  `nim` int(11) NOT NULL,
  `nilai` char(1) DEFAULT NULL,
  `tanggal_nilai` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `6374411_mtk`
--

CREATE TABLE `6374411_mtk` (
  `id` int(7) DEFAULT NULL,
  `nim` int(11) NOT NULL,
  `nilai` char(1) DEFAULT NULL,
  `tanggal_nilai` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `8452358_mtk_skp`
--

CREATE TABLE `8452358_mtk_skp` (
  `id` int(7) DEFAULT NULL,
  `nim` int(11) NOT NULL,
  `nilai` char(1) DEFAULT NULL,
  `tanggal_nilai` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(44444444, 'asdasd', 'Bidang Kader PC Djazman', 'kader'),
(111112, 'CEKKKKKKK INI KETUMa', 'Ketua Umum PC Djazmana', 'ketum');

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
(2372416, 'Al-Quran A', 'Al-Quran B', 'Al-Quran C', 'Al-Quran D'),
(5329266, 'ASD', 'ASD', 'ASD', 'ASD'),
(6374411, 'asd', 'asd', 'asd', 'asd'),
(8452358, 'SIKAP A', 'SIKAP B', 'SIKAP C', 'SIKAP D');

-- --------------------------------------------------------

--
-- Table structure for table `form_data`
--

CREATE TABLE `form_data` (
  `judul` varchar(100) NOT NULL,
  `deskripsi` varchar(180) NOT NULL,
  `link` varchar(50) NOT NULL,
  `id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `form_data`
--

INSERT INTO `form_data` (`judul`, `deskripsi`, `link`, `id`) VALUES
('FORM PENGISIAN DJAZMAN', 'BAGI YANG MENDAFTAR SILAHKAN MENGISI FORM YANG SUDAH ADA', 'kader_form', 9765);

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
(2372416, 'AL-QURAN', 0, '', '', ''),
(5329266, 'EYY', 0, '', '', ''),
(6374411, 'asdasd', 0, '', '', '');

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
(8452358, 'SIKAP');

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
(34234, 'PO', 'asdasdasd', 'NBA'),
(123123, 'IOT', 'asdsd', 'FTI'),
(1231232, 'MOT', 'asdsd', 'FTI');

-- --------------------------------------------------------

--
-- Table structure for table `kader`
--

CREATE TABLE `kader` (
  `nim` bigint(11) NOT NULL,
  `komsat` varchar(20) NOT NULL,
  `namafull` varchar(50) NOT NULL,
  `namapanggil` varchar(20) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `web` varchar(150) NOT NULL,
  `hobi` varchar(200) NOT NULL,
  `motto` varchar(200) NOT NULL,
  `motivasi` varchar(200) NOT NULL,
  `bacaan` varchar(220) NOT NULL,
  `tanggal` date NOT NULL,
  `jk` varchar(2) NOT NULL,
  `penyakit` varchar(180) NOT NULL,
  `darah` varchar(2) NOT NULL,
  `prodi` varchar(150) NOT NULL,
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
-- Dumping data for table `kader`
--

INSERT INTO `kader` (`nim`, `komsat`, `namafull`, `namapanggil`, `notelp`, `tempat`, `email`, `web`, `hobi`, `motto`, `motivasi`, `bacaan`, `tanggal`, `jk`, `penyakit`, `darah`, `prodi`, `fakultas`, `universitas`, `alamat`, `nama_ayah`, `nama_ibu`, `kerja_ayah`, `kerja_ibu`, `essai`, `periode`) VALUES
(1700018013, 'HOS Cokroaminoto', 'Refaldi Ergianaaaaaaaaa', 'aaaaaassssssss', '085268043434', 'asd', 'asda@gmail.com', 'asds', 'asdsa', 'asdsad', 'asdads', 'Politik', '1999-01-01', 'L', 'asdsad', 'B', 'asda', 'FAI', 'asdad', 'asd', 'asd', 'asd', 'asd', 'asd', '', '2020');

-- --------------------------------------------------------

--
-- Table structure for table `kader_catatan`
--

CREATE TABLE `kader_catatan` (
  `nim` int(11) NOT NULL,
  `deskripsi` varchar(200) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kader_catatan`
--

INSERT INTO `kader_catatan` (`nim`, `deskripsi`) VALUES
(1700018013, '');

-- --------------------------------------------------------

--
-- Table structure for table `kader_presensi`
--

CREATE TABLE `kader_presensi` (
  `nim` int(11) NOT NULL,
  `sakit` int(5) DEFAULT NULL,
  `izin` int(5) DEFAULT NULL,
  `tanpa_ket` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kader_presensi`
--

INSERT INTO `kader_presensi` (`nim`, `sakit`, `izin`, `tanpa_ket`) VALUES
(1700018013, 2, 3, 4),
(1700018016, 1, 2, 3);

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
(1234567890, 'PK IMM Farmasi', 'Jalan Prof. Dr. Soepomo S.H.a', 'Jalan Prof. Dr. Soepomo S.H.a', 'Umbulharjoa', 'Daerah Istimewa Yogyakartaaa', 2111, '2019/2020a', 'Edy Susantoa', 0, 'Djazman Al Kindia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `2372416_mtk`
--
ALTER TABLE `2372416_mtk`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `5329266_mtk`
--
ALTER TABLE `5329266_mtk`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `6374411_mtk`
--
ALTER TABLE `6374411_mtk`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `8452358_mtk_skp`
--
ALTER TABLE `8452358_mtk_skp`
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
-- Indexes for table `form_data`
--
ALTER TABLE `form_data`
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
-- Indexes for table `kader`
--
ALTER TABLE `kader`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `kader_catatan`
--
ALTER TABLE `kader_catatan`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `kader_presensi`
--
ALTER TABLE `kader_presensi`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `komsat`
--
ALTER TABLE `komsat`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
