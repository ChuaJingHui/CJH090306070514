-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2025 at 02:52 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cjh090306070514`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `IDKelas` varchar(2) NOT NULL,
  `Kelas` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maklumat_pengundian`
--

CREATE TABLE `maklumat_pengundian` (
  `IDPengguna` int(11) NOT NULL,
  `IDPermainan` varchar(2) DEFAULT NULL,
  `Tarikh` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengundi`
--

CREATE TABLE `pengundi` (
  `IDPengguna` int(11) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `IDKelas` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `senarai_permainan`
--

CREATE TABLE `senarai_permainan` (
  `IDPermainan` varchar(2) NOT NULL,
  `Permainan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`IDKelas`);

--
-- Indexes for table `maklumat_pengundian`
--
ALTER TABLE `maklumat_pengundian`
  ADD PRIMARY KEY (`IDPengguna`),
  ADD KEY `IDPermainan` (`IDPermainan`);

--
-- Indexes for table `pengundi`
--
ALTER TABLE `pengundi`
  ADD PRIMARY KEY (`IDPengguna`),
  ADD KEY `IDKelas` (`IDKelas`);

--
-- Indexes for table `senarai_permainan`
--
ALTER TABLE `senarai_permainan`
  ADD PRIMARY KEY (`IDPermainan`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `maklumat_pengundian`
--
ALTER TABLE `maklumat_pengundian`
  ADD CONSTRAINT `maklumat_pengundian_ibfk_1` FOREIGN KEY (`IDPengguna`) REFERENCES `pengundi` (`IDPengguna`),
  ADD CONSTRAINT `maklumat_pengundian_ibfk_2` FOREIGN KEY (`IDPermainan`) REFERENCES `senarai_permainan` (`IDPermainan`);

--
-- Constraints for table `pengundi`
--
ALTER TABLE `pengundi`
  ADD CONSTRAINT `pengundi_ibfk_1` FOREIGN KEY (`IDKelas`) REFERENCES `kelas` (`IDKelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
