-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 24 Okt 2022 pada 04.15
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujikomrpl2022_4`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_perjalanan`
--

CREATE TABLE `data_perjalanan` (
  `id` int(11) NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `tanggal` varchar(225) NOT NULL,
  `waktu` varchar(225) NOT NULL,
  `lokasi` text DEFAULT NULL,
  `suhu_tubuh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_perjalanan`
--

INSERT INTO `data_perjalanan` (`id`, `nik`, `tanggal`, `waktu`, `lokasi`, `suhu_tubuh`) VALUES
(11, '3217090304050006', '2022-10-24', '08:50', 'Sekolah', '34.5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `nik` varchar(16) NOT NULL,
  `nama_lengkap` varchar(225) DEFAULT NULL,
  `photo` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`nik`, `nama_lengkap`, `photo`) VALUES
('3217090304050006', 'Satou Hina', 'satou-hina.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_perjalanan`
--
ALTER TABLE `data_perjalanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`nik`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_perjalanan`
--
ALTER TABLE `data_perjalanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
