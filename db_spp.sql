-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2021 at 04:59 AM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` varchar(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `kompetensi_keahlian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `kompetensi_keahlian`) VALUES
('10', 'MM1', 'Multimedia 1'),
('11', 'MM2', 'Multimedia 2'),
('12', 'RPL', 'Rekayasa Perangkat Lunak');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` varchar(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `nisn` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bulan_dibayar` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tahun_dibayar` varchar(4) NOT NULL,
  `id_spp` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jumlah_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `id_petugas`, `nisn`, `tgl_bayar`, `bulan_dibayar`, `tahun_dibayar`, `id_spp`, `jumlah_bayar`) VALUES
('BYR001', 46, 7895, '2021-04-07', ' Maret', '2021', 'SPP001', 200000),
('BYR002', 46, 7895, '2021-04-08', ' April', '2021', 'SPP001', 200000),
('BYR003', 46, 7894, '2021-04-08', ' Maret', '2021', 'SPP001', 900000),
('BYR004', 46, 7895, '2021-04-10', ' April', '2021', 'SPP001', 200000),
('BYR005', 46, 7893, '2021-04-09', ' Maret', '2021', 'SPP001', 200000),
('BYR006', 46, 7895, '2021-04-10', ' Maret', '2021', 'SPP001', 200000),
('BYR007', 46, 7895, '2021-04-11', ' Juni', '2021', 'SPP001', 500000),
('BYR008', 46, 7895, '2021-04-13', ' April', '2021', 'SPP001', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `pwd` varchar(225) NOT NULL,
  `nama_petugas` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `level` enum('Admin','Petugas') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_petugas`
--

INSERT INTO `tb_petugas` (`id_petugas`, `username`, `pwd`, `nama_petugas`, `level`) VALUES
(46, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'Super Admin', 'Admin'),
(47, 'petugastu', 'dbfa1ed1616a95e2e99f3dab6de584ea', 'Petugas TU', 'Petugas'),
(54, 'monic', 'd41d8cd98f00b204e9800998ecf8427e', 'monic', 'Petugas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nisn` int(10) NOT NULL,
  `nis` char(8) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `id_kelas` varchar(11) NOT NULL,
  `kom_keahlian` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `id_spp` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`nisn`, `nis`, `nama`, `id_kelas`, `kom_keahlian`, `alamat`, `no_telp`, `id_spp`) VALUES
(7891, '1231', 'Upin', '12', 'Rekayasa Perangkat Lunak', 'Madagaskar', '08988732863', 'SPP001'),
(7893, '1233', 'Mail', '10', 'Multimedia 2', 'Afrika', '08938827383', 'SPP001'),
(7894, '1234', 'Ipin', '10', 'Rekayasa Perangkat Lunak', 'Kenya', '08936725365', 'SPP001'),
(7895, '1235', 'dinda', '12', 'Rekayasa Perangkat Lunak', 'cilangkap', '08965477777', 'SPP001'),
(7896, '1236', 'olip', '12', 'Rekayasa Perangkat Lunak', 'al huda', '0896726222', 'SPP001');

-- --------------------------------------------------------

--
-- Table structure for table `tb_spp`
--

CREATE TABLE `tb_spp` (
  `id_spp` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tahun` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jenis_pembayaran` varchar(225) NOT NULL,
  `nominal` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_spp`
--

INSERT INTO `tb_spp` (`id_spp`, `tahun`, `jenis_pembayaran`, `nominal`) VALUES
('SPP001', '2020-2021', 'SPP Bulanan', 200000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `id_spp` (`id_spp`);

--
-- Indexes for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_spp` (`id_spp`);

--
-- Indexes for table `tb_spp`
--
ALTER TABLE `tb_spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `tb_pembayaran_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `tb_petugas` (`id_petugas`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_pembayaran_ibfk_3` FOREIGN KEY (`nisn`) REFERENCES `tb_siswa` (`nisn`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_pembayaran_ibfk_4` FOREIGN KEY (`id_spp`) REFERENCES `tb_spp` (`id_spp`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_siswa_ibfk_2` FOREIGN KEY (`id_spp`) REFERENCES `tb_spp` (`id_spp`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
