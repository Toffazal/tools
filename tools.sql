-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jan 2023 pada 08.02
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tools`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gps`
--

CREATE TABLE `gps` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `redirect` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gps`
--

INSERT INTO `gps` (`id`, `uid`, `judul`, `deskripsi`, `redirect`, `icon`) VALUES
(1, 1, 'Diamond Mobile Legends Gratis', 'Diamond Mobile Legends Gratis', 'https://google.com', 'default.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `historygps`
--

CREATE TABLE `historygps` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `tanggal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `historygps`
--

INSERT INTO `historygps` (`id`, `uid`, `judul`, `latitude`, `longitude`, `tanggal`) VALUES
(23, 1, 'Diamond Mobile Legends Gratis', '4.0139145', '98.2839382', '16-03-2022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tools`
--

CREATE TABLE `tools` (
  `id` int(11) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tools`
--

INSERT INTO `tools` (`id`, `slug`, `nama`, `icon`) VALUES
(1, 'gps', 'GPS Tracking', 'fas fa-map-marked-alt'),
(2, 'quotes', 'Quotes Maker', 'fas fa-quote-left'),
(5, 'spamsms', 'Spam SMS', 'far fa-comment'),
(6, 'iptracking', 'IP Tracking', 'fas fa-map-marker-alt');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(500) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `status`) VALUES
(1, 'Muhammad Toffazal', 'muhammad.toffazal00@gmail.com', '$2y$10$8j9fcSofUYEK.wvt3N6zRe7ItMuuNmkP0Xmbs6uU0ubzCCKBdeCWe', 'admin'),
(3, 'Muhammad Ikhsan Adwa', 'muhammad.toffazal@gmail.com', '$2y$10$Lo0NpidseUx9OrtyCl1LhuWxiOJ.An6tsYXZRb685p3syXAax6dGm', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gps`
--
ALTER TABLE `gps`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `historygps`
--
ALTER TABLE `historygps`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gps`
--
ALTER TABLE `gps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `historygps`
--
ALTER TABLE `historygps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tools`
--
ALTER TABLE `tools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
