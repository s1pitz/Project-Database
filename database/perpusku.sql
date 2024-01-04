-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 07:57 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpusku`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbuku`
--

CREATE TABLE `tbuku` (
  `IDBuku` char(4) NOT NULL,
  `JudulBuku` varchar(20) DEFAULT NULL,
  `Genre` varchar(20) DEFAULT NULL,
  `TahunTerbit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbuku`
--

INSERT INTO `tbuku` (`IDBuku`, `JudulBuku`, `Genre`, `TahunTerbit`) VALUES
('B001', 'Harry Potter', 'Fantasy', 2010),
('B002', 'Oshi No Ko', 'Drama', 2020),
('B003', 'Goosebumps', 'Horror', 2013),
('B018', 'Soekarno', 'History', 1999),
('B200', 'Sher', 'asdf', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `tmember`
--

CREATE TABLE `tmember` (
  `IDMember` char(4) NOT NULL,
  `NamaMember` varchar(20) DEFAULT NULL,
  `NoTelpon` int(11) DEFAULT NULL,
  `TanggalLahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tmember`
--

INSERT INTO `tmember` (`IDMember`, `NamaMember`, `NoTelpon`, `TanggalLahir`) VALUES
('M001', 'Rico', 8112321300, '1999-11-11'),
('M002', 'Kowalzki', 811023985, '2000-01-01'),
('M003', 'Skipper', 81112312, '1998-02-02'),
('M100', 'Dodi', 2147483647, '2002-10-18');

-- --------------------------------------------------------

--
-- Table structure for table `tmeminjam`
--

CREATE TABLE `tmeminjam` (
  `IDMember` char(4) DEFAULT NULL,
  `IDBuku` char(4) DEFAULT NULL,
  `TanggalPeminjaman` date DEFAULT NULL,
  `TanggalPengembalian` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tmeminjam`
--

INSERT INTO `tmeminjam` (`IDMember`, `IDBuku`, `TanggalPeminjaman`, `TanggalPengembalian`) VALUES
('M002', 'B002', '2023-12-15', '2023-12-22'),
('M001', 'B001', '2023-12-3', '2023-12-10'),
('M002', 'B003', '2023-12-8', '2023-12-15'),
('M002', 'B002', '2023-12-15', '2023-12-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbuku`
--
ALTER TABLE `tbuku`
  ADD PRIMARY KEY (`IDBuku`);

--
-- Indexes for table `tmember`
--
ALTER TABLE `tmember`
  ADD PRIMARY KEY (`IDMember`);

--
-- Indexes for table `tmeminjam`
--
ALTER TABLE `tmeminjam`
  ADD KEY `tmeminjam_ibfk_1` (`IDMember`),
  ADD KEY `tmeminjam_ibfk_2` (`IDBuku`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tmeminjam`
--
ALTER TABLE `tmeminjam`
  ADD CONSTRAINT `tmeminjam_ibfk_1` FOREIGN KEY (`IDMember`) REFERENCES `tmember` (`IDMember`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tmeminjam_ibfk_2` FOREIGN KEY (`IDBuku`) REFERENCES `tbuku` (`IDBuku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
