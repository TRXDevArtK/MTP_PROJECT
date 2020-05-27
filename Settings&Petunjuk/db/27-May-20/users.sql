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
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(65) NOT NULL,
  `email` varchar(50) NOT NULL,
  `admin` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `admin`) VALUES
(1122, '$username', '$password_hash', '$email', '$admi'),
(112233, 'admin', '$2y$10$HJRFItg6nl7aheVyvcOexeDqGhjZBrKW5Cp6SkN7vSrl7A/hzDeoG', 'androrobot1234567890@gmail.com', 'yes'),
(2147483647, 'sKr%O0Qk', '$2y$10$HJh6Q1Oii38hZci7mAI.l.WNtyfAndB5KNUeA23F.Y7SgcGUl74Tq', 'trxdev@gmx.com', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `users_reset`
--

CREATE TABLE `users_reset` (
  `email` varchar(50) NOT NULL,
  `pin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_reset`
--

INSERT INTO `users_reset` (`email`, `pin`) VALUES
('androrobot1234567890@gmail.com', '69e0424b739c7f6dda10f37a594de090e5df4765');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_reset`
--
ALTER TABLE `users_reset`
  ADD UNIQUE KEY `pin` (`pin`),
  ADD UNIQUE KEY `pin_2` (`pin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
