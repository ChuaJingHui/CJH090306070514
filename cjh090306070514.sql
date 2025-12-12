-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2025 at 01:34 PM
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
CREATE DATABASE CJH090306070514;
USE CJH090306070514;

CREATE TABLE `kelas` (
  `IDKelas` varchar(3) NOT NULL,
  `Kelas` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`IDKelas`, `Kelas`) VALUES
('K01', '4S1'),
('K03', '4S3'),
('K09', '4S9'),
('K11', '4T2'),
('K13', '4C2'),
('K14', '4C3'),
('K15', '4CL'),
('K16', '4SL');

-- --------------------------------------------------------

--
-- Table structure for table `maklumat_pengundian`
--

CREATE TABLE `maklumat_pengundian` (
  `IDPengguna` varchar(12) NOT NULL,
  `IDPermainan` varchar(3) NOT NULL,
  `Tarikh` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maklumat_pengundian`
--

INSERT INTO `maklumat_pengundian` (`IDPengguna`, `IDPermainan`, `Tarikh`) VALUES
('090101070703', 'U01', '2025-08-21 15:45:13'),
('090224070615', 'U01', '2025-08-21 16:29:46'),
('090306071712', 'U02', '2025-08-19 07:36:23'),
('090515070102', 'U01', '2025-08-20 11:21:33'),
('090601071978', 'U02', '2025-08-19 17:46:27'),
('090708074032', 'U01', '2025-08-19 07:38:55'),
('090727072131', 'U01', '2025-08-20 09:44:38'),
('090930070716', 'U01', '2025-08-19 07:35:12'),
('091212070923', 'U02', '2025-08-21 18:55:07'),
('091218076989', 'U01', '2025-08-19 08:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `pengundi`
--

CREATE TABLE `pengundi` (
  `IDPengguna` varchar(12) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `IDKelas` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengundi`
--

INSERT INTO `pengundi` (`IDPengguna`, `Nama`, `IDKelas`) VALUES
('090101070703', 'Ang Wen Fong', 'K14'),
('090224070615', 'Yong Jing Wai', 'K09'),
('090306071712', 'Alicia Tang', 'K03'),
('090515070102', 'Shirley Eng Ting Hang', 'K13'),
('090601071978', 'Hii Yu Wen', 'K16'),
('090708074032', 'Elyne Wong', 'K11'),
('090727072131', 'Aidin', 'K01'),
('090930070716', 'Cheang Yi', 'K01'),
('091212070923', 'Wong Yin Han', 'K11'),
('091218076989', 'Yeoh Yin Yin', 'K15');

-- --------------------------------------------------------

--
-- Table structure for table `senarai_permainan`
--

CREATE TABLE `senarai_permainan` (
  `IDPermainan` varchar(3) NOT NULL,
  `Permainan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `senarai_permainan`
--

INSERT INTO `senarai_permainan` (`IDPermainan`, `Permainan`) VALUES
('U01', 'Permainan Digital'),
('U02', 'Permainan Tradisional');

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
  ADD UNIQUE KEY `uq_IDPengguna` (`IDPengguna`),
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
