-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Des 2019 pada 04.22
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dealeryamaha`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `brg_pk`
--

CREATE TABLE `brg_pk` (
  `id_brg_pk` int(11) NOT NULL,
  `id_pk` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `cc` int(11) NOT NULL,
  `jml_brg` int(11) NOT NULL,
  `jml_input` int(11) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `brg_pk`
--

INSERT INTO `brg_pk` (`id_brg_pk`, `id_pk`, `id_type`, `cc`, `jml_brg`, `jml_input`, `warna`, `id_status`) VALUES
(5, 4, 1, 125, 1, 0, 'Merah', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `brg_pm`
--

CREATE TABLE `brg_pm` (
  `id_brg_pm` int(11) NOT NULL,
  `id_pm` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `cc` int(11) NOT NULL,
  `jml_brg` int(11) NOT NULL,
  `jml_input` int(11) NOT NULL,
  `warna` varchar(114) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `brg_pm`
--

INSERT INTO `brg_pm` (`id_brg_pm`, `id_pm`, `id_type`, `cc`, `jml_brg`, `jml_input`, `warna`, `id_status`) VALUES
(3, 3, 1, 125, 20, 0, 'hitam', 0),
(4, 3, 2, 125, 30, 0, 'Merah', 0),
(5, 3, 2, 250, 11, 0, 'Biru', 0),
(6, 4, 2, 250, 10, 1, 'Kuning', 0),
(7, 4, 1, 125, 10, 0, 'Hitam', 0),
(8, 5, 1, 125, 10, 2, 'Biru', 0),
(9, 6, 2, 125, 25, 1, 'Putih', 0),
(12, 8, 1, 125, 12, 1, 'HItam', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `info_pt`
--

CREATE TABLE `info_pt` (
  `id_info_pt` int(11) NOT NULL,
  `nama_info_pt` varchar(114) NOT NULL,
  `kode_pt` varchar(50) NOT NULL,
  `img_header` varchar(50) NOT NULL,
  `kontak_1` varchar(20) NOT NULL,
  `kontak_2` varchar(20) NOT NULL,
  `kontak_3` varchar(20) NOT NULL,
  `kontak_4` varchar(20) NOT NULL,
  `alamat_pt` varchar(114) NOT NULL,
  `slogan` varchar(114) NOT NULL,
  `logo_pt` varchar(114) NOT NULL,
  `logo_kecil_pt` varchar(114) NOT NULL,
  `header_pt` varchar(114) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `info_pt`
--

INSERT INTO `info_pt` (`id_info_pt`, `nama_info_pt`, `kode_pt`, `img_header`, `kontak_1`, `kontak_2`, `kontak_3`, `kontak_4`, `alamat_pt`, `slogan`, `logo_pt`, `logo_kecil_pt`, `header_pt`, `id_status`) VALUES
(1, 'Dealer Resmi Kendaraan Roda 2 - Merk Yamaha', 'Baubau', 'asd', '(0402)2825960', '(0402)2825961', 'asd', 'asd', 'Jalan Betoambari No 74, Baubau - Sulawesi Tenggara', 'asd', 'logo-dealer-resmi-kendaraan-roda-2-merk-yamaha-20191212-1576118210.png', 'logo.png', 'asd', 1),
(2, 'Raha Dealer Resmi Kendaraan Roda 2 - Merk Yamaha	', 'Raha', '', '0402 2821424', '0402 2821424', '0402 2821424', '0402 2821424', 'Depan Badan Pemberdayaan Perempuan dan KB Jl Jenderal Gatot Subroto No 82 Raha', 'Tempat Nongkrong Berkualitas', 'logo-raha-dealer-resmi-kendaraan-roda-2-merk-yamaha-20191212-1576118793.png', '', '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nm_jenis` varchar(50) NOT NULL,
  `kode_jenis` varchar(50) NOT NULL,
  `ket_jenis` varchar(114) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nm_jenis`, `kode_jenis`, `ket_jenis`) VALUES
(1, 'Sepeda Motor', 'sp', 'sp');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `merk`
--

CREATE TABLE `merk` (
  `id_merk` int(11) NOT NULL,
  `nm_merk` varchar(50) NOT NULL,
  `kode_merk` varchar(20) NOT NULL,
  `ket_merk` varchar(114) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `merk`
--

INSERT INTO `merk` (`id_merk`, `nm_merk`, `kode_merk`, `ket_merk`) VALUES
(1, 'Yamaha', 'Yamaha', 'Yamaha');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota_keluar`
--

CREATE TABLE `nota_keluar` (
  `id_nota_keluar` int(11) NOT NULL,
  `no_nota_keluar` varchar(50) NOT NULL,
  `no_mesin` varchar(114) NOT NULL,
  `no_rangka` varchar(114) NOT NULL,
  `request_date` varchar(20) NOT NULL,
  `no_pdi` varchar(114) NOT NULL,
  `nm_p_bku_uang` varchar(114) NOT NULL,
  `nm_p_ktp` varchar(114) NOT NULL,
  `tgl_jual` date NOT NULL,
  `harga_jual` int(20) NOT NULL,
  `no_ktp_p` varchar(50) NOT NULL,
  `jk_p` varchar(2) NOT NULL,
  `tgl_lahir_p` date NOT NULL,
  `pekerjaan_p` varchar(50) NOT NULL,
  `pendidikan_p` varchar(50) NOT NULL,
  `pengeluaran_p` varchar(50) NOT NULL,
  `tahun_produk` int(11) NOT NULL,
  `propinsi_p` varchar(50) NOT NULL,
  `kecamatan_p` varchar(50) NOT NULL,
  `kelurahan_p` varchar(50) NOT NULL,
  `alamat_1_p` text NOT NULL,
  `alamat_2_p` text NOT NULL,
  `kode_pos_p` varchar(20) NOT NULL,
  `tlp_p` varchar(20) NOT NULL,
  `stnk` varchar(50) NOT NULL,
  `tgl_reg_stnk` date NOT NULL,
  `harga_stnk` int(20) NOT NULL,
  `id_leasing` int(11) NOT NULL,
  `uang_muka` int(50) NOT NULL,
  `jangka_bayar` varchar(20) NOT NULL,
  `angsuran` int(20) NOT NULL,
  `outlet` varchar(50) NOT NULL,
  `id_surveyor` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `qrcode_nk` varchar(114) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` int(11) NOT NULL,
  `nm_p_bku_uang` varchar(114) NOT NULL,
  `nm_p_ktp` varchar(114) NOT NULL,
  `no_ktp_p` varchar(50) NOT NULL,
  `jk_p` varchar(2) NOT NULL,
  `tgl_lahir_p` date NOT NULL,
  `pekerjaan_p` varchar(30) NOT NULL,
  `pendidikan_p` varchar(30) NOT NULL,
  `pengeluaran_p` varchar(30) NOT NULL,
  `propinsi_p` varchar(20) NOT NULL,
  `kecamatan_p` varchar(30) NOT NULL,
  `kelurahan_p` varchar(30) NOT NULL,
  `alamat_1_p` text NOT NULL,
  `alamat_2_p` text NOT NULL,
  `kode_pos_p` varchar(20) NOT NULL,
  `tlp_p` varchar(114) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_pm` int(11) NOT NULL,
  `id_brg_pm` int(11) NOT NULL,
  `id_info_pt` int(11) NOT NULL,
  `no_rangka` varchar(114) NOT NULL,
  `no_mesin` varchar(114) NOT NULL,
  `no_pdi` varchar(114) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_merk` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `thn_produk` int(5) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `cc` varchar(20) NOT NULL,
  `bahan_bakar` varchar(20) NOT NULL,
  `warna` varchar(20) NOT NULL,
  `id_validasi` int(11) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_pm`, `id_brg_pm`, `id_info_pt`, `no_rangka`, `no_mesin`, `no_pdi`, `id_jenis`, `id_merk`, `id_type`, `thn_produk`, `tgl_masuk`, `tgl_keluar`, `cc`, `bahan_bakar`, `warna`, `id_validasi`, `id_status`) VALUES
(1, 4, 6, 1, '1203205402366', '38485934959294', '', 1, 1, 2, 2019, '2019-12-19', '0000-00-00', '250', 'Bensin', 'Kuning', 1, 1),
(3, 5, 8, 2, '91994553452455', '3012303034012', '', 1, 1, 1, 2019, '2019-12-19', '0000-00-00', '125', 'Bensin', 'Biru', 1, 1),
(4, 5, 8, 1, '1203205402366', '9989796979821', '', 1, 1, 1, 2019, '2019-12-19', '0000-00-00', '125', 'Bensin', 'Merah', 1, 1),
(5, 6, 9, 1, '3842834824858', '6849675849681', '', 1, 1, 2, 2019, '2019-12-19', '0000-00-00', '125', 'Bensin', 'Putih', 1, 1),
(7, 8, 12, 1, '1203205402366', '38485934959294', '', 1, 1, 1, 2019, '2019-12-20', '0000-00-00', '125', 'Bensin', 'HItam', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produkkeluar`
--

CREATE TABLE `produkkeluar` (
  `id_pk` int(11) NOT NULL,
  `kode_pk` varchar(12) NOT NULL,
  `id_info_pt_asal` int(11) NOT NULL,
  `id_info_pt_tujuan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nm_user` varchar(114) NOT NULL,
  `tgl_buat` date NOT NULL,
  `waktu_buat` time NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produkkeluar`
--

INSERT INTO `produkkeluar` (`id_pk`, `kode_pk`, `id_info_pt_asal`, `id_info_pt_tujuan`, `id_user`, `nm_user`, `tgl_buat`, `waktu_buat`, `id_status`) VALUES
(4, 'PK2412190001', 1, 2, 1, 'La Ode Agus Salim Nur', '2019-12-24', '03:57:47', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produkmasuk`
--

CREATE TABLE `produkmasuk` (
  `id_pm` int(11) NOT NULL,
  `id_info_pt` int(11) NOT NULL,
  `tgl_create` date NOT NULL,
  `waktu_create` time NOT NULL,
  `departemen` varchar(114) NOT NULL,
  `so_ref` varchar(114) NOT NULL,
  `so_no` int(20) NOT NULL,
  `ipdo_no` int(20) NOT NULL,
  `ipdo_date` date NOT NULL,
  `so_date` date NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produkmasuk`
--

INSERT INTO `produkmasuk` (`id_pm`, `id_info_pt`, `tgl_create`, `waktu_create`, `departemen`, `so_ref`, `so_no`, `ipdo_no`, `ipdo_date`, `so_date`, `id_status`) VALUES
(3, 1, '2019-12-17', '14:16:03', '', 'S-BAU/19/12/DS5', 69555, 67316, '2019-12-11', '2019-12-11', 1),
(4, 1, '2019-12-18', '18:26:28', '', 'S-BAU/20/12/K28', 69123, 98316, '2019-12-19', '2019-12-19', 0),
(5, 2, '2019-12-19', '01:21:48', '', 'S-BAU/07/24/KS5', 42345, 67574, '2019-12-18', '2019-12-18', 0),
(6, 1, '2019-12-19', '13:26:06', '', 'S-BAU/19/12/FGH', 124353, 757897, '2019-12-19', '2019-12-19', 0),
(8, 1, '2019-12-20', '08:36:33', '', 'S-BAU/19/12/DS5', 12345, 12344, '2019-12-20', '2019-12-20', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_brg_pk`
--

CREATE TABLE `r_brg_pk` (
  `id_r_brg_pk` int(11) NOT NULL,
  `id_pk` int(11) NOT NULL,
  `id_info_pt_asal` int(11) NOT NULL,
  `id_info_pt_tujuan` int(11) NOT NULL,
  `id_brg_pk` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `nm_status` varchar(20) NOT NULL,
  `kode_status` varchar(20) NOT NULL,
  `ket_status` varchar(114) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id_status`, `nm_status`, `kode_status`, `ket_status`) VALUES
(1, 'Belum Selesai', 'bs', 'bs'),
(2, 'Selesai', 's', 's');

-- --------------------------------------------------------

--
-- Struktur dari tabel `type`
--

CREATE TABLE `type` (
  `id_type` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_merk` int(11) NOT NULL,
  `nm_type` varchar(50) NOT NULL,
  `kode_type` varchar(20) NOT NULL,
  `ket_type` varchar(114) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `type`
--

INSERT INTO `type` (`id_type`, `id_jenis`, `id_merk`, `nm_type`, `kode_type`, `ket_type`) VALUES
(1, 1, 1, 'New Fino 125 Blue Core', 'ble', 'New Fino 125 Blue Core'),
(2, 1, 1, 'R15 VVA 155', 'vva', 'vva');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `repassword` varchar(114) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `jk` varchar(2) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `id_info_pt` int(11) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `profile` varchar(114) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `repassword`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `jk`, `company`, `id_info_pt`, `phone`, `profile`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$12$QFxx7D9v0OHPtAi3QvMD5eUaGGHstO6tipOQeiO2U6YO09CCQFT8C', '', 'admin@admin.com', NULL, '', NULL, NULL, NULL, '3350d5217d8210cb49efbdaf056b8d16f09c6019', '$2y$10$BOUHGMF/FMylXnt09ideSOKBbGNcEtqIMcyQG/cCBzqJWLHRxXKvW', 1268889823, 1577148747, 1, 'La Ode Agus Salim Nur', 'istrator', 'L', 'Dealer Resmi Kendaraan Roda 2 - Merk Yamaha', 1, '082343211234', 'default.png'),
(2, '::1', '201912122', '$2y$10$d1tsA6D4ZUm1w0vgVv9eLOKXTAk/bPodzTGXpzXdYrJolhvm..84.', 'mandatizamrud2412', 'rezarafiqmz@gmail.com', NULL, NULL, NULL, NULL, NULL, '9b0c10fad0a45a1ff1bda8116541c56c8e07ff01', '$2y$10$mkpAuIM1M43IaHed6WcH4uagctbusLkc0o860Qb7PJ/Wuf/m39TVm', 1576150007, 1576301529, 1, 'Reza Rafiq', '', 'L', 'Dealer Resmi Kendaraan Roda 2 - Merk Yamaha', 1, '082312341234', 'default.png'),
(3, '::1', '201912123', '$2y$10$II5PSdysl1jb5VUInlmcCuQrtjznHoJcb5qUfO6q94Vsvdo/a3DyC', 'hardina321', 'peserta@unidayan.ac.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1576150686, NULL, 1, 'Hardina Kaimudin', '', 'P', 'Raha Dealer Resmi Kendaraan Roda 2 - Merk Yamaha', 2, '082245126655', 'default.png'),
(4, '::1', '201912124', '$2y$12$Ml36MPLajwxG5DXbCkhOR.fTf0XI5CFlYk2vd/wQHzp6XOVzi2pZG', 'ali1234', 'raha@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1576171050, 1576804332, 1, 'Ali Akbar', '', 'L', 'Raha Dealer Resmi Kendaraan Roda 2 - Merk Yamaha	', 2, '081222224222', 'default.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(13, 1, 1),
(3, 2, 2),
(9, 3, 2),
(5, 4, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `brg_pk`
--
ALTER TABLE `brg_pk`
  ADD PRIMARY KEY (`id_brg_pk`);

--
-- Indeks untuk tabel `brg_pm`
--
ALTER TABLE `brg_pm`
  ADD PRIMARY KEY (`id_brg_pm`);

--
-- Indeks untuk tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `info_pt`
--
ALTER TABLE `info_pt`
  ADD PRIMARY KEY (`id_info_pt`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`id_merk`);

--
-- Indeks untuk tabel `nota_keluar`
--
ALTER TABLE `nota_keluar`
  ADD PRIMARY KEY (`id_nota_keluar`);

--
-- Indeks untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `produkkeluar`
--
ALTER TABLE `produkkeluar`
  ADD PRIMARY KEY (`id_pk`);

--
-- Indeks untuk tabel `produkmasuk`
--
ALTER TABLE `produkmasuk`
  ADD PRIMARY KEY (`id_pm`);

--
-- Indeks untuk tabel `r_brg_pk`
--
ALTER TABLE `r_brg_pk`
  ADD PRIMARY KEY (`id_r_brg_pk`);

--
-- Indeks untuk tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indeks untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `brg_pk`
--
ALTER TABLE `brg_pk`
  MODIFY `id_brg_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `brg_pm`
--
ALTER TABLE `brg_pm`
  MODIFY `id_brg_pm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `info_pt`
--
ALTER TABLE `info_pt`
  MODIFY `id_info_pt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `merk`
--
ALTER TABLE `merk`
  MODIFY `id_merk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `nota_keluar`
--
ALTER TABLE `nota_keluar`
  MODIFY `id_nota_keluar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id_pembeli` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `produkkeluar`
--
ALTER TABLE `produkkeluar`
  MODIFY `id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `produkmasuk`
--
ALTER TABLE `produkmasuk`
  MODIFY `id_pm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `r_brg_pk`
--
ALTER TABLE `r_brg_pk`
  MODIFY `id_r_brg_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
