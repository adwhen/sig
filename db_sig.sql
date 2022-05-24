-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Bulan Mei 2022 pada 12.05
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sig`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_configuration`
--

CREATE TABLE `tb_configuration` (
  `IDX` int(11) NOT NULL,
  `CLUSTER_ELBOW` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_earthquake`
--

CREATE TABLE `tb_earthquake` (
  `idx` int(11) NOT NULL,
  `NUMB` varchar(32) NOT NULL,
  `latitude` varchar(32) NOT NULL,
  `longitude` varchar(32) NOT NULL,
  `depth` varchar(32) NOT NULL,
  `strength` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_earthquake`
--

INSERT INTO `tb_earthquake` (`idx`, `NUMB`, `latitude`, `longitude`, `depth`, `strength`, `created_at`, `update_at`) VALUES
(1, 'A', '-4.2', '102.3', '28.4', '3', '2022-04-22 06:26:16', '2022-04-22 06:26:16'),
(2, 'B', '-3.96', '103', '88.4', '3', '2022-04-22 06:26:16', '2022-04-22 06:26:16'),
(3, 'C', '-4.68', '102.1', '12.1', '3.5', '2022-04-22 06:26:16', '2022-04-22 06:26:16'),
(4, 'D', '-5.39', '103.2', '14.7', '3.7', '2022-04-22 06:26:16', '2022-04-22 06:26:16'),
(5, 'E', '-3.99', '103.3', '10', '4', '2022-04-22 06:26:16', '2022-04-22 06:26:16'),
(6, 'F', '-2.42', '102.1', '124.2', '4.3', '2022-04-22 06:26:16', '2022-04-22 06:26:16'),
(7, 'G', '-3.58', '100.5', '29.6', '4.7', '2022-04-22 06:26:16', '2022-04-22 06:26:16'),
(8, 'H', '-4.24', '102.9', '92.4', '5.3', '2022-04-22 06:26:16', '2022-04-22 06:26:16'),
(9, 'I', '-3.11', '102.9', '150.3', '5.8', '2022-04-22 06:26:16', '2022-04-22 06:26:16'),
(10, 'J', '-3.33', '100.4', '29.1', '6.1', '2022-04-22 06:26:16', '2022-04-22 06:26:16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_configuration`
--
ALTER TABLE `tb_configuration`
  ADD PRIMARY KEY (`IDX`);

--
-- Indeks untuk tabel `tb_earthquake`
--
ALTER TABLE `tb_earthquake`
  ADD PRIMARY KEY (`idx`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_configuration`
--
ALTER TABLE `tb_configuration`
  MODIFY `IDX` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_earthquake`
--
ALTER TABLE `tb_earthquake`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
