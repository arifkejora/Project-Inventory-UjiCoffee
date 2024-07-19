-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2024 at 03:02 PM
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
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `brg_keluar`
--

CREATE TABLE `brg_keluar` (
  `id_brklr` int(10) NOT NULL,
  `tgl` date NOT NULL,
  `id_stock` int(10) NOT NULL,
  `jumlah` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brg_keluar`
--

INSERT INTO `brg_keluar` (`id_brklr`, `tgl`, `id_stock`, `jumlah`) VALUES
(1, '2024-06-14', 1, 5),
(2, '2024-06-14', 2, 5),
(3, '2024-06-14', 3, 3),
(4, '2024-06-14', 4, 4),
(5, '2024-06-14', 5, 10),
(6, '2024-06-14', 6, 2),
(7, '2024-06-14', 7, 2),
(8, '2024-06-14', 8, 2),
(9, '2024-06-14', 9, 4),
(10, '2024-06-14', 10, 8),
(11, '2024-06-14', 11, 1),
(12, '2024-06-14', 12, 1),
(14, '2024-06-14', 14, 5),
(15, '2024-06-14', 15, 25),
(16, '2024-06-14', 16, 2),
(17, '2024-06-14', 17, 3),
(18, '2024-06-14', 18, 2),
(19, '2024-06-14', 19, 2),
(20, '2024-06-14', 20, 3),
(21, '2024-06-12', 1, 22);

-- --------------------------------------------------------

--
-- Table structure for table `brg_masuk`
--

CREATE TABLE `brg_masuk` (
  `id_brmsk` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `id_stock` int(10) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brg_masuk`
--

INSERT INTO `brg_masuk` (`id_brmsk`, `tgl`, `id_stock`, `jumlah`, `keterangan`) VALUES
(1, '2024-06-12', 1, 50, 'Pengisian stok awal'),
(2, '2024-06-12', 2, 50, 'Pengisian stok awal'),
(3, '2024-06-12', 3, 30, 'Pengisian stok awal'),
(4, '2024-06-12', 4, 40, 'Pengisian stok awal'),
(5, '2024-06-12', 5, 100, 'Pengisian stok awal'),
(6, '2024-06-12', 6, 15, 'Pengisian stok awal'),
(7, '2024-06-12', 7, 15, 'Pengisian stok awal'),
(8, '2024-06-12', 8, 15, 'Pengisian stok awal'),
(9, '2024-06-12', 9, 20, 'Pengisian stok awal'),
(10, '2024-06-12', 10, 40, 'Pengisian stok awal'),
(11, '2024-06-12', 11, 10, 'Pengisian stok awal'),
(12, '2024-06-12', 12, 5, 'Pengisian stok awal'),
(14, '2024-06-12', 14, 25, 'Pengisian stok awal'),
(15, '2024-06-12', 15, 250, 'Pengisian stok awal'),
(16, '2024-06-12', 16, 10, 'Pengisian stok awal'),
(17, '2024-06-12', 17, 15, 'Pengisian stok awal'),
(18, '2024-06-12', 18, 12, 'Pengisian stok awal'),
(19, '2024-06-12', 19, 12, 'Pengisian stok awal'),
(20, '2024-06-13', 20, 15, 'Penambahan stok'),
(21, '2024-06-13', 1, 10, 'Penambahan stok'),
(22, '2024-06-13', 2, 20, 'Penambahan stok'),
(23, '2024-06-13', 3, 15, 'Penambahan stok'),
(24, '2024-06-13', 4, 20, 'Penambahan stok'),
(25, '2024-06-13', 5, 50, 'Penambahan stok'),
(26, '2024-06-13', 6, 10, 'Penambahan stok'),
(27, '2024-06-13', 7, 10, 'Penambahan stok'),
(28, '2024-06-13', 8, 10, 'Penambahan stok'),
(29, '2024-06-13', 9, 10, 'Penambahan stok'),
(30, '2024-06-13', 10, 20, 'Penambahan stok'),
(32, '2024-06-12', 1, 22, 'fweg');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `nama`, `email`, `password`) VALUES
(2, 'Lestiani', 'lestikejora@gmail.com', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id_stock`, `nama`, `jenis`, `stock`, `harga`) VALUES
(1, 'Bubuk Kopi Arabika Arab Banget', 'Bahan', 100, 50000),
(2, 'Bubuk Kopi Robusta Meksiko', 'Bahan', 100, 40000),
(3, 'Susu Segar', 'Bahan', 50, 30000),
(4, 'Coklat Bubuk', 'Bahan', 70, 25000),
(5, 'Gula Pasir', 'Bahan', 200, 15000),
(6, 'Sirup Vanila', 'Bahan', 30, 35000),
(7, 'Syrup Caramel', 'Bahan', 30, 35000),
(8, 'Syrup Hazelnut', 'Bahan', 30, 35000),
(9, 'Teh Hijau Matcha', 'Bahan', 40, 45000),
(10, 'Espresso Beans', 'Bahan', 80, 55000),
(11, 'Kopi Decaf', 'Bahan', 20, 60000),
(12, 'Kopi Luwak', 'Bahan', 10, 100000),
(14, 'Whipped Cream', 'Bahan', 50, 30000),
(15, 'Es Batu', 'Bahan', 500, 5000),
(16, 'Kayu Manis Bubuk', 'Bahan', 25, 20000),
(17, 'Karamel', 'Bahan', 30, 25000),
(18, 'Sirup Hazelnut', 'Bahan', 25, 30000),
(19, 'Sirup Mocha', 'Bahan', 25, 30000),
(20, 'Choco Chips', 'Bahan', 50, 40000),
(21, 'Susu Sapi Perah', 'Cair', 5, 150000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brg_keluar`
--
ALTER TABLE `brg_keluar`
  ADD PRIMARY KEY (`id_brklr`),
  ADD KEY `stok_ibfk_2` (`id_stock`);

--
-- Indexes for table `brg_masuk`
--
ALTER TABLE `brg_masuk`
  ADD PRIMARY KEY (`id_brmsk`),
  ADD KEY `stok_ibfk_1` (`id_stock`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brg_keluar`
--
ALTER TABLE `brg_keluar`
  MODIFY `id_brklr` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `brg_masuk`
--
ALTER TABLE `brg_masuk`
  MODIFY `id_brmsk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brg_keluar`
--
ALTER TABLE `brg_keluar`
  ADD CONSTRAINT `stok_ibfk_2` FOREIGN KEY (`id_stock`) REFERENCES `stock` (`id_stock`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `brg_masuk`
--
ALTER TABLE `brg_masuk`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`id_stock`) REFERENCES `stock` (`id_stock`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
