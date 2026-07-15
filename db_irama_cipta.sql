-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2026 at 12:48 AM
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
  `kategori` varchar(50) NOT NULL,
  `pesan` text NOT NULL,
  `jawaban` text DEFAULT NULL,
  `tanggal_isi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku_tamu`
--

INSERT INTO `buku_tamu` (`id_tamu`, `nama`, `email`, `kategori`, `pesan`, `jawaban`, `tanggal_isi`) VALUES
(5, 'eddy', 'eddyaa@gmail.com', 'Ajukan Pertanyaan', 'Kapan war tiket Twice??', 'Mohon bersabar dan selalu memantau perkembangan di laman PT. Irama Cipta Eventa ya kak, kami akan selalu memastikan semua informasi terupdate secepat mungkin. Terimakasih\r\n', '2026-07-11 10:54:14'),
(6, 'bina', 'sabina@gmail.com', 'Ajukan Pertanyaan', 'apakah akan diadakan festival jazz 2027?\r\n', 'Pasti!! Ferstival Jazz 2027 akan kami adakan. Kira-kira kali ini bintang tamunya siapa yaa???... Buat kamu yang punya masukan bisa banget yaa bisikin kekita siapa yang paling jazz buat tampil di festival kita', '2026-07-11 11:06:03'),
(7, 'Yumina', 'yumi@gmail.com', 'Ajukan Kerjasama', 'saya ingin menggunakan jasa anda untuk wedding saya, bisa kah kita jadwalkan pertemuan untuk membahas ini?', 'halo kak, pihak kami akan segera menghubungi yaa, semoga kami bisa memberikan kesan terbaik untuk acara mu\r\n', '2026-07-11 19:38:43'),
(10, 'Bine', 'nebin@gmail.com', 'Tinggalkan Pesan', 'Konser Seventeen kemarin sukses dan menyenangkan', 'terimakasih atas testimoni nya kak, semoga kami tetap bisa memberika kesan terbaik untuk pengalaman hiburanmu', '2026-07-12 06:43:54');

-- --------------------------------------------------------

--
-- Table structure for table `galeri_event`
--

CREATE TABLE `galeri_event` (
  `id_galeri` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `nama_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galeri_event`
--

INSERT INTO `galeri_event` (`id_galeri`, `id_event`, `nama_foto`) VALUES
(1, 13, 'galeri_13_1783970849_0.jpg'),
(2, 13, 'galeri_13_1783970849_1.jpg'),
(3, 13, 'galeri_13_1783970849_2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_event`
--

CREATE TABLE `jadwal_event` (
  `id_event` int(11) NOT NULL,
  `nama_event` varchar(200) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `tanggal_event` varchar(100) NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `status_event` varchar(50) DEFAULT 'Upcoming'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_event`
--

INSERT INTO `jadwal_event` (`id_event`, `nama_event`, `kategori`, `tanggal_event`, `lokasi`, `status_event`) VALUES
(1, 'Stray Kids: RUN IT World Tour Jakarta', 'Concerts', '1 Agustus 2027', 'Indonesia Arena, Jakarta', 'Upcoming'),
(2, 'CORTIS - Put Your Phone Down World Tour Jakarta', 'Concerts', '20 Maret 2028', 'Ice BSD, Tangerang', 'Upcoming'),
(3, 'Jay Park World Tour Jakarta', 'Concerts', '12 Agustus 2028', 'Jakarta International Stadium, Jakarta', 'Upcoming'),
(4, 'i-dle World Tour [Syncopation]', 'Concerts', '22 September 2028', 'BSD City, Tangerang', 'Upcoming'),
(5, 'TWICE - This Is For World Tour Jakarta', 'Concerts', '30 Juli 2029', 'Jakarta International Stadium, Jakarta', 'Upcoming'),
(6, 'NMIXX: Lab Changes Up World Tour', 'Concerts', '22 November 2029', 'Indonesia Arena, Jakarta', 'Upcoming'),
(7, 'Prambanan Jazz 2027', 'Festival & Bazaar', '01 - 05 Juli 2027', 'Candi Prambanan, Yogyakarta', 'Upcoming'),
(8, 'Waterbomb Festival 2027', 'Festival & Bazaar', '01 - 05 November 2027', 'Beach Club, Bali', 'Upcoming'),
(9, 'Lollapalooza 2027', 'Festival & Bazaar', '01 - 05 Desember 2027', 'Gelora Bung Karno, Jakarta', 'Upcoming'),
(10, 'Exclusive Wedding Package', 'Private Service', 'Sesuai Reservasi Klien', 'Fleksibel (Sesuai Permintaan)', 'Upcoming'),
(11, 'Private Birthday Party', 'Private Service', 'Sesuai Reservasi Klien', 'Fleksibel (Sesuai Permintaan)', 'Upcoming'),
(12, 'Corporate Gala & Gathering', 'Private Service', 'Sesuai Reservasi Klien', 'Ballroom Hotel / Custom', 'Upcoming'),
(13, 'Stray Kids: dominATE in Jakarta', 'Concerts', '21 Desember 2024', 'Indonesia Arena, Jakarta', 'Selesai'),
(14, 'ITZY Checkmate World Tour', 'Concerts', '10 Januari 2025', 'ICE BSD, Tangerang', 'Selesai'),
(15, 'Seventeen Right Here World Tour in Jakarta', 'Concerts', '10 Maret 2025', 'Jakarta International Stadium, Jakarta', 'Selesai'),
(16, 'AESPA Parallelline World Tour', 'Concerts', '15 April 2026', 'Beach City, Pantai Indah Kapuk', 'Selesai'),
(17, 'Enhypen World Tour Fate+', 'Concerts', '17 Agustus 2024', 'Ice BSD, Tangerang', 'Selesai'),
(18, 'ATEEZ In Your Fantasy World Tour in Jakarta', 'Concerts', '31 Januari 2026', 'ICE BSD, Tangerang', 'Selesai'),
(19, 'KOPLING - Koplo Keliling', 'Festival & Bazaar', '15 November 2024', 'Gambir Expo Kemayoran, Jakarta', 'Selesai'),
(20, 'PESTAPORA - Indonesia', 'Festival & Bazaar', '20 Oktober 2025', 'Jiexpo Hall C, Jakarta', 'Selesai'),
(21, 'Jakarta Fair Music Concert', 'Festival & Bazaar', '15 Juni 2026', 'Jiexpo Kemayoran, Jakarta', 'Selesai'),
(22, 'Exclusive Wedding: The Royal Nuptials', 'Private Service', '12 Februari 2026', 'The Ritz-Carlton, Jakarta', 'Selesai'),
(23, 'UNINDRA Kelompok 3 App Launch Gala', 'Private Service', '10 April 2026', 'Auditorium Kampus, Jakarta', 'Selesai'),
(24, 'TechCorp Annual Corporate Dinner', 'Private Service', '18 Mei 2026', 'Hotel Mulia Senayan, Jakarta', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `klien`
--

CREATE TABLE `klien` (
  `id_klien` int(11) NOT NULL,
  `nama_klien` varchar(100) NOT NULL,
  `kontak` varchar(100) NOT NULL,
  `jenis_kerjasama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klien`
--

INSERT INTO `klien` (`id_klien`, `nama_klien`, `kontak`, `jenis_kerjasama`) VALUES
(1, 'Yumina', 'yumi@gmail.com', 'Prospek Kerjasama Baru');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_tiket`
--

CREATE TABLE `transaksi_tiket` (
  `id_transaksi` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `nama_pembeli` varchar(100) NOT NULL,
  `email_pembeli` varchar(100) NOT NULL,
  `kategori_tiket` varchar(50) NOT NULL,
  `jumlah_tiket` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `kode_booking` varchar(20) NOT NULL,
  `tanggal_transaksi` timestamp NOT NULL DEFAULT current_timestamp(),
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status_pembayaran` varchar(50) NOT NULL DEFAULT 'Menunggu Validasi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_tiket`
--

INSERT INTO `transaksi_tiket` (`id_transaksi`, `id_event`, `nama_pembeli`, `email_pembeli`, `kategori_tiket`, `jumlah_tiket`, `total_bayar`, `kode_booking`, `tanggal_transaksi`, `bukti_bayar`, `status_pembayaran`) VALUES
(8, 6, 'subin', 'binnsus@gmail.com', 'VIP Standing', 1, 3500000, 'TIKET-1783965994', '2026-07-13 18:06:34', 'TIKET-1783965994_struk.jpeg', 'Lunas'),
(9, 1, 'kyeno', 'oneyk@gmail.com', 'VIP Standing', 1, 3500000, 'TIKET-1784116871', '2026-07-15 12:01:11', 'TIKET-1784116871_struk.jpeg', 'Menunggu Validasi'),
(10, 4, 'Yusuf', 'suf@gmail.com', 'VIP Standing', 1, 3500000, 'TIKET-1784117014', '2026-07-15 12:03:34', 'TIKET-1784117014_struk.jpeg', 'Menunggu Validasi'),
(11, 2, 'Binera', 'bine@gmail.com', 'VIP Standing', 1, 3500000, 'TIKET-1784146014', '2026-07-15 20:06:54', 'TIKET-1784146014_struk.jpeg', 'Lunas'),
(12, 3, 'Yusuf', 'suf@gmail.com', 'VIP Standing', 1, 3500000, 'TIKET-1784146775', '2026-07-15 20:19:35', 'TIKET-1784146775_struk.jpeg', 'Lunas'),
(13, 4, 'Yusuf', 'abg@gmail.com', 'VIP Standing', 1, 3500000, 'TIKET-1784147623', '2026-07-15 20:33:43', 'TIKET-1784147623_struk.jpeg', 'Lunas'),
(14, 1, 'binera', 'bine@gmail.com', 'VIP Standing', 1, 3500000, 'TIKET-1784153789', '2026-07-15 22:16:29', 'TIKET-1784153789_struk.jpeg', 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL,
  `level` enum('admin','user') DEFAULT 'user'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama`, `email`, `role`, `level`) VALUES
(1, 'admin_irama', 'rahasia123', '', '', 'admin', 'admin'),
(2, 'nerabi', '$2y$10$SRDT6.5HVAs4zJBeOsP5uuIi./BuTuy95URPRvkKvWBwdb2QdbW8O', 'bine', 'nebira@gmail.com', '', 'user'),
(3, 'binnera', '$2y$10$tO5RMknbdztIwcsggRBPMuBDiEhqwUp8JpggB077sZn2RR9uf.m0S', 'Binera', 'bine@gmail.com', '', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  ADD PRIMARY KEY (`id_tamu`);

--
-- Indexes for table `galeri_event`
--
ALTER TABLE `galeri_event`
  ADD PRIMARY KEY (`id_galeri`);

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
-- Indexes for table `transaksi_tiket`
--
ALTER TABLE `transaksi_tiket`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  MODIFY `id_tamu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `galeri_event`
--
ALTER TABLE `galeri_event`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jadwal_event`
--
ALTER TABLE `jadwal_event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `klien`
--
ALTER TABLE `klien`
  MODIFY `id_klien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi_tiket`
--
ALTER TABLE `transaksi_tiket`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
