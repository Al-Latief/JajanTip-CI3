-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 03, 2025 at 01:46 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jajantip`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `pengaturan_id` int NOT NULL,
  `pengaturan_nama_website` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pengaturan_logo_website` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`pengaturan_id`, `pengaturan_nama_website`, `pengaturan_logo_website`) VALUES
(1, 'Jajan Tip', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `pengguna_id` int NOT NULL,
  `pengguna_nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pengguna_username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pengguna_password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_ditambahkan` datetime NOT NULL,
  `pengguna_level` enum('admin','pengunjung') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pengguna_foto` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`pengguna_id`, `pengguna_nama`, `pengguna_username`, `pengguna_password`, `tanggal_ditambahkan`, `pengguna_level`, `pengguna_foto`) VALUES
(1, 'Muhammad Latip', 'latief', '306688fc66898bf11ee91353fef1283b', '2025-09-02 19:01:31', 'pengunjung', 'default.jpg'),
(2, 'Muhammad Latip', 'adminlatip', '230fcaacb8faa0f9b1a97820ebb81384', '2025-08-30 13:57:47', 'admin', 'default.jpg'),
(3, 'Muhammad Latip Admin', 'latip', 'latip', '2025-08-29 15:20:25', 'admin', 'default.jpg'),
(4, 'Muhammad Latip Admin 2', 'latip', '34b3be99d3d423b7a6c394715cfb525c', '2025-08-29 15:21:27', 'admin', 'default.jpg'),
(5, 'Muhammad Latip', 'latipp', '34b3be99d3d423b7a6c394715cfb525c', '2025-08-29 15:31:31', 'admin', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `pesan_id` int NOT NULL,
  `pengguna_id` int NOT NULL,
  `pesan_konten` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `pesan_status` enum('belum terbaca','terbaca') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_ditambahkan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`pesan_id`, `pengguna_id`, `pesan_konten`, `pesan_status`, `tanggal_ditambahkan`) VALUES
(1, 1, 'Apa kabar??', 'terbaca', '2025-08-30 12:35:14'),
(2, 1, 'apa coba?', 'terbaca', '2025-09-02 17:06:38'),
(3, 1, 'hahahahaha', 'belum terbaca', '2025-09-02 17:08:04'),
(4, 1, 'asdads', 'belum terbaca', '2025-09-02 17:08:14'),
(5, 1, 'sadasdasdasd', 'belum terbaca', '2025-09-02 17:08:44'),
(6, 1, 'aku padamu', 'belum terbaca', '2025-09-02 19:19:16');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produk_id` int NOT NULL,
  `produk_sampul` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `produk_nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `produk_deskripsi` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `produk_kategori` enum('Makanan','Minuman') COLLATE utf8mb4_general_ci NOT NULL,
  `produk_harga` int NOT NULL,
  `produk_stok` int NOT NULL,
  `tanggal_ditambahkan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produk_id`, `produk_sampul`, `produk_nama`, `produk_deskripsi`, `produk_kategori`, `produk_harga`, `produk_stok`, `tanggal_ditambahkan`) VALUES
(1, '1756788409_wedangjahe.png', 'Bubur Sumsum', 'Bubur Sumsum ini sudah diedit', 'Minuman', 3000, 150, '2025-01-05 00:00:00'),
(2, '1756788424_6781086c23c1d.png', 'Es Dawet Ayu', 'Ini Es Dawet Ayu', 'Minuman', 1000, 50, '2025-01-01 00:00:00'),
(3, '1756788634_6781da114a89c.png', 'Getuk', 'Makanan dari singkong rebus yang dihaluskan, dicampur gula, dan sering diberi pewarna alami.', 'Makanan', 2000, 500, '2025-01-05 00:00:00'),
(4, '1756788656_67811e53b3c5f.png', 'Grontol', 'Jagung pipil yang direbus hingga empuk, disajikan dengan parutan kelapa dan sedikit garam.', 'Makanan', 4000, 400, '2025-01-04 00:00:00'),
(5, '1756788815_6781d996a137d.png', 'Jenang', 'Ini Jenang', 'Makanan', 2500, 250, '2025-01-02 00:00:00'),
(6, '1756788730_wedangjahe.png', 'Kue Mendut', 'Ini Kue Mendut', 'Makanan', 1000, 20, '2025-01-04 00:00:00'),
(7, '1756788688_67810918b7550.png', 'Lupis', 'Ini Lupis', 'Makanan', 3500, 100, '2025-01-04 00:00:00'),
(8, '1756788721_wedangjahe.png', 'Semar Mendem', 'Ini Semar Mendem', 'Makanan', 5000, 900, '2025-01-05 00:00:00'),
(9, '1756788793_6781da114a89c.png', 'Tiwul', 'Ini Tiwul', 'Makanan', 2500, 10, '2025-01-04 00:00:00'),
(11, '1756788648_67810a31b567e.png', 'Bajigur', 'Minuman santan dengan gula merah, sering ditambah jahe dan garam, cocok diminum hangat.', 'Minuman', 1000, 25, '2025-01-06 00:00:00'),
(12, '1756788741_6781d996a137d.png', 'Arem-Arem', 'Mirip dengan lemper, tetapi menggunakan nasi yang diisi dengan isian seperti sambal goreng daging, ayam, atau sayur, lalu dibungkus daun pisang dan dikukus.', 'Makanan', 4000, 60, '2025-01-02 00:00:00'),
(13, '1756788755_67811e53b3c5f.png', 'Ketan Bakar', 'Olahan ketan yang dibakar, sering disajikan dengan sambal kelapa pedas atau gula merah cair.', 'Makanan', 1500, 45, '2025-01-06 00:00:00'),
(14, '1756788771_6781da114a89c.png', 'Nogosari', 'Dibuat dari adonan tepung beras dan santan, diisi pisang, lalu dibungkus daun pisang dan dikukus.', 'Makanan', 4500, 10, '2025-01-04 00:00:00'),
(20, '1756789140_bajigur.png', 'Es Teh', 'Ini minuman ter enak', 'Minuman', 2500, 500, '2025-09-02 11:59:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`pengaturan_id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`pengguna_id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`pesan_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `pengaturan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `pengguna_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `pesan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
