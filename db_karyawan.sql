-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Bulan Mei 2023 pada 13.43
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_karyawan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `jabatan_id` int(10) NOT NULL,
  `jabatan_nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`jabatan_id`, `jabatan_nama`) VALUES
(4, 'Ketua'),
(5, 'Staff'),
(7, 'Manager');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `karyawan_id` int(11) NOT NULL,
  `karyawan_foto` varchar(255) NOT NULL,
  `karyawan_nip` varchar(255) NOT NULL,
  `karyawan_nama` varchar(255) NOT NULL,
  `karyawan_ttl` date NOT NULL,
  `outlet_id` int(10) NOT NULL,
  `jabatan_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`karyawan_id`, `karyawan_foto`, `karyawan_nip`, `karyawan_nama`, `karyawan_ttl`, `outlet_id`, `jabatan_id`) VALUES
(24, 'BluPLdHCUAARu9l.jpg', '123456', 'Andi', '2023-05-02', 3, 4),
(25, 'cowo.png', '123457', 'Budi', '2023-05-05', 3, 5),
(27, 'icon.png', '123459', 'Doggy', '2023-05-09', 4, 7),
(28, 'imgonline-com-ua-CompressToSize-H6kf5gPxvq6ryRSX.jpg', '123460', 'Kocheeng', '2023-05-10', 5, 4),
(29, 'pngtree-cartoon-fish-clipart-red-little-goldfish-png-image_2363580.jpg', '123458', 'Koi', '2023-05-08', 4, 4),
(30, 'WhatsApp Image 2022-04-11 at 7.04.33 PM.jpeg', '123461', 'Joko Tingkir', '2023-05-13', 5, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `outlet`
--

CREATE TABLE `outlet` (
  `outlet_id` int(10) NOT NULL,
  `outlet_nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `outlet`
--

INSERT INTO `outlet` (`outlet_id`, `outlet_nama`) VALUES
(3, 'Depot Isi Ulang Air'),
(4, 'Toko Foto Copy'),
(5, 'Kedai Makanan'),
(7, 'Toko Elektronik');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`jabatan_id`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`karyawan_id`),
  ADD KEY `outlet_id` (`outlet_id`),
  ADD KEY `jabatan_id` (`jabatan_id`);

--
-- Indeks untuk tabel `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`outlet_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `jabatan_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `karyawan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `outlet`
--
ALTER TABLE `outlet`
  MODIFY `outlet_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
