-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2026 at 09:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_irama_cipta`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku_tamu`
--

CREATE TABLE `buku_tamu` (
  `id_tamu` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pesan` text NOT NULL,
  `tanggal_isi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_event`
--

CREATE TABLE `jadwal_event` (
  `id_event` int(11) NOT NULL,
  `nama_event` varchar(150) NOT NULL,
  `kategori_event` varchar(50) NOT NULL,
  `tanggal_pelaksanaan` date NOT NULL,
  `lokasi` varchar(150) NOT NULL,
  `status_acara` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `klien`
--

CREATE TABLE `klien` (
  `id_klien` int(11) NOT NULL,
  `nama_klien` varchar(100) NOT NULL,
  `instansi` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  ADD PRIMARY KEY (`id_tamu`);

--
-- Indexes for table `jadwal_event`
--
ALTER TABLE `jadwal_event`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `klien`
--
ALTER TABLE `klien`
  ADD PRIMARY KEY (`id_klien`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  MODIFY `id_tamu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_event`
--
ALTER TABLE `jadwal_event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `klien`
--
ALTER TABLE `klien`
  MODIFY `id_klien` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
