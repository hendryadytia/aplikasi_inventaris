-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 20 Bulan Mei 2021 pada 15.05
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akses`
--

CREATE TABLE `akses` (
  `id_akses` int(11) NOT NULL,
  `nama_akses` varchar(25) NOT NULL,
  `deskripsi` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akses`
--

INSERT INTO `akses` (`id_akses`, `nama_akses`, `deskripsi`) VALUES
(1, 'administrator', 'sebagai  pengelola kendali penuh pada sistem inventaris'),
(2, 'staff', 'sebagai staf input inventaris');

-- --------------------------------------------------------

--
-- Struktur dari tabel `baranginv`
--

CREATE TABLE `baranginv` (
  `id_barang` int(5) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `no_invn` varchar(15) DEFAULT NULL,
  `pemilik` varchar(15) NOT NULL,
  `id_kerusakan` int(1) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `baranginv`
--

INSERT INTO `baranginv` (`id_barang`, `nama_barang`, `no_invn`, `pemilik`, `id_kerusakan`, `tgl_masuk`, `tgl_keluar`, `status`) VALUES
(4, 'kolostrus216', 'aa423152bcd', 'erwany', 30, '2021-05-02', '2021-05-15', 1),
(5, 'kamikaze008901', 'afaik45653', 'gondrong', 30, '2021-05-16', '0000-00-00', 0),
(6, 'ewfsdfa', '32rwrq23', 'aaada', 29, '2021-04-26', '2021-05-07', 1),
(7, 'ingco1210', 'ing44542', 'iksan', 31, '2021-05-16', '2021-05-18', 1),
(8, 'hikers221', '123124kkas', 'ghozi', 30, '2021-05-16', '2021-05-31', 1),
(9, 'jinka13123', 'askdfjhuuaac', 'uwada', 30, '2021-05-19', '2021-05-13', 1),
(10, 'kowalski2009', 'af2safaw3fa', 'iknssasf', 29, '2021-05-20', '0000-00-00', 0),
(11, 'kolostrus215weq', 'aa423152bcdqweq', 'gondrongew', 29, '2021-05-26', '0000-00-00', 0),
(12, 'kolostrus2160999', 'ijinfain', 'sfjoia', 29, '2021-05-04', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(35) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(32, 'Fatal'),
(31, 'Berat'),
(30, 'Sedang'),
(29, 'Ringan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `operator`
--

CREATE TABLE `operator` (
  `id_operator` int(11) NOT NULL,
  `nama_operator` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `id_akses` int(3) NOT NULL,
  `last_login` date NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `operator`
--

INSERT INTO `operator` (`id_operator`, `nama_operator`, `username`, `password`, `id_akses`, `last_login`, `foto`) VALUES
(9, 'Adit', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2021-05-20', 'avatar3.png'),
(15, 'kasir', 'kasir', 'c7911af3adbd12a035b289556d96470a', 2, '2021-05-16', 'ebb1798a06597d68f86106e4c76183bb.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indeks untuk tabel `baranginv`
--
ALTER TABLE `baranginv`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id_operator`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akses`
--
ALTER TABLE `akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `baranginv`
--
ALTER TABLE `baranginv`
  MODIFY `id_barang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `operator`
--
ALTER TABLE `operator`
  MODIFY `id_operator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
