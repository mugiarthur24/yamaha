-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jan 2020 pada 11.22
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
  `waktu_create` varchar(20) DEFAULT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `brg_pk`
--

INSERT INTO `brg_pk` (`id_brg_pk`, `id_pk`, `id_type`, `cc`, `jml_brg`, `jml_input`, `warna`, `waktu_create`, `id_status`) VALUES
(1, 1, 6, 125, 2, 1, 'Biru', '20200114-111425', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `brg_pm`
--

CREATE TABLE `brg_pm` (
  `id_brg_pm` int(11) NOT NULL,
  `id_brg_pk` int(11) NOT NULL,
  `id_pm` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `cc` int(11) NOT NULL,
  `jml_brg` int(11) NOT NULL,
  `jml_input` int(11) NOT NULL,
  `warna` varchar(114) NOT NULL,
  `waktu_create` varchar(20) DEFAULT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `brg_pm`
--

INSERT INTO `brg_pm` (`id_brg_pm`, `id_brg_pk`, `id_pm`, `id_type`, `cc`, `jml_brg`, `jml_input`, `warna`, `waktu_create`, `id_status`) VALUES
(1, 0, 1, 1, 125, 7, 7, 'MERAH', NULL, 0),
(2, 0, 1, 1, 125, 6, 6, 'BIRU', NULL, 0),
(3, 0, 1, 1, 125, 6, 6, 'HITAM', NULL, 0),
(4, 0, 1, 1, 125, 6, 6, 'PERAK', NULL, 0),
(5, 0, 1, 2, 125, 3, 3, 'MERAH', NULL, 0),
(6, 0, 1, 3, 125, 1, 1, 'MERAH', NULL, 0),
(7, 0, 1, 4, 125, 1, 1, 'BIRU', NULL, 0),
(8, 0, 2, 5, 125, 7, 7, 'MERAH', NULL, 0),
(9, 0, 2, 6, 125, 30, 30, 'MERAH', NULL, 0),
(10, 0, 2, 6, 125, 10, 10, 'HITAM', NULL, 0),
(11, 0, 2, 6, 125, 20, 20, 'BIRU', NULL, 0),
(12, 0, 2, 7, 125, 10, 10, 'PERAK', NULL, 0),
(13, 0, 3, 6, 125, 20, 20, 'HITAM', NULL, 0),
(14, 0, 3, 6, 125, 20, 20, 'BIRU', NULL, 0),
(15, 1, 4, 6, 125, 2, 1, 'Biru', '20200114-111425', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` int(11) NOT NULL,
  `id_info_pt` int(11) NOT NULL,
  `nm_bulan` varchar(20) DEFAULT NULL,
  `kode_bulan` varchar(11) DEFAULT NULL,
  `ttl_bulan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bulan`
--

INSERT INTO `bulan` (`id_bulan`, `id_info_pt`, `nm_bulan`, `kode_bulan`, `ttl_bulan`) VALUES
(1, 1, 'January', '2020-01', 10000000);

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
(2, 'members', 'General User'),
(3, 'gudang', 'Gudang'),
(4, 'cs', 'CS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `histori_harga`
--

CREATE TABLE `histori_harga` (
  `id_hh` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `tahun_produk` int(11) NOT NULL,
  `warna` varchar(114) NOT NULL,
  `harga` int(11) NOT NULL,
  `tgl_create` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `histori_harga`
--

INSERT INTO `histori_harga` (`id_hh`, `id_type`, `tahun_produk`, `warna`, `harga`, `tgl_create`) VALUES
(1, 1, 2019, 'MERAH', 18000000, '2020-01-14'),
(2, 1, 2019, 'BIRU', 18000000, '2020-01-14'),
(3, 1, 2019, 'HITAM', 18000000, '2020-01-14'),
(4, 1, 2019, 'PERAK', 18000000, '2020-01-14'),
(5, 2, 2019, 'MERAH', 18000000, '2020-01-14'),
(6, 3, 2019, 'MERAH', 18000000, '2020-01-14'),
(7, 4, 2019, 'BIRU', 18000000, '2020-01-14'),
(8, 5, 2019, 'MERAH', 18000000, '2020-01-14'),
(9, 6, 2019, 'MERAH', 18000000, '2020-01-14'),
(10, 6, 2019, 'HITAM', 18000000, '2020-01-14'),
(11, 6, 2019, 'BIRU', 18000000, '2020-01-14'),
(12, 7, 2019, 'PERAK', 18000000, '2020-01-14');

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
(1, 'Dealer Resmi Kendaraan Roda 2 - Merk Yamaha', 'Baubau', 'asd', '(0402)2825960', '(0402)2825961', 'asd', 'asd', 'Jalan Betoambari No 74, Baubau - Sulawesi Tenggara', 'asd', 'logo-dealer-resmi-kendaraan-roda-2-merk-yamaha-20191212-1576118210.png', 'logo.png', 'Yance Kongres', 1),
(2, 'Raha Dealer Resmi Kendaraan Roda 2 - Merk Yamaha	', 'Raha', '', '0402 2821424', '0402 2821424', '0402 2821424', '0402 2821424', 'Depan Badan Pemberdayaan Perempuan dan KB Jl Jenderal Gatot Subroto No 82 Raha', 'Tempat Nongkrong Berkualitas', 'logo-raha-dealer-resmi-kendaraan-roda-2-merk-yamaha-20191212-1576118793.png', '', 'Yance Kongres', 0);

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
-- Struktur dari tabel `leasing`
--

CREATE TABLE `leasing` (
  `id_leasing` int(11) NOT NULL,
  `nm_leasing` varchar(114) NOT NULL,
  `kode_leasing` varchar(20) NOT NULL,
  `ket_leasing` varchar(114) NOT NULL,
  `area` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `leasing`
--

INSERT INTO `leasing` (`id_leasing`, `nm_leasing`, `kode_leasing`, `ket_leasing`, `area`) VALUES
(1, 'Mandala', 'B0001', 'Area Baubau', 'Baubau'),
(2, 'BAF', 'BAF', 'Kota Baubau', 'Baubau'),
(3, 'BAF', 'BAF', 'Area Raha', 'Raha');

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
  `id_produk` int(11) NOT NULL,
  `id_info_pt` int(11) NOT NULL,
  `no_mesin` varchar(114) DEFAULT NULL,
  `no_rangka` varchar(114) DEFAULT NULL,
  `request_date` varchar(20) DEFAULT NULL,
  `no_pdi` varchar(114) DEFAULT NULL,
  `nm_p_bku_uang` varchar(114) DEFAULT NULL,
  `nm_stnk` varchar(114) DEFAULT NULL,
  `nm_p_ktp` varchar(114) DEFAULT NULL,
  `tgl_jual` date NOT NULL,
  `harga_jual` int(20) DEFAULT NULL,
  `no_ktp_p` varchar(50) DEFAULT NULL,
  `jk_p` varchar(2) DEFAULT NULL,
  `tgl_lahir_p` date DEFAULT NULL,
  `pekerjaan_p` varchar(50) DEFAULT NULL,
  `pendidikan_p` varchar(50) DEFAULT NULL,
  `pengeluaran_p` varchar(50) DEFAULT NULL,
  `tahun_produk` int(11) DEFAULT NULL,
  `propinsi_p` varchar(50) DEFAULT NULL,
  `kecamatan_p` varchar(50) DEFAULT NULL,
  `kelurahan_p` varchar(50) DEFAULT NULL,
  `alamat_1_p` text,
  `alamat_2_p` text,
  `kode_pos_p` varchar(20) DEFAULT NULL,
  `tlp_p` varchar(20) DEFAULT NULL,
  `stnk` varchar(50) DEFAULT NULL,
  `no_polisi` varchar(20) DEFAULT NULL,
  `tgl_reg_stnk` date DEFAULT NULL,
  `harga_stnk` int(20) DEFAULT NULL,
  `id_leasing` int(11) NOT NULL,
  `uang_muka` int(50) NOT NULL,
  `jangka_bayar` varchar(20) DEFAULT NULL,
  `angsuran` int(20) NOT NULL,
  `outlet` varchar(50) DEFAULT NULL,
  `id_surveyor` varchar(114) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `qrcode_nk` varchar(114) DEFAULT NULL,
  `jml_bayar` int(11) NOT NULL,
  `jml_di_bayar` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_status_stnk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nota_keluar`
--

INSERT INTO `nota_keluar` (`id_nota_keluar`, `no_nota_keluar`, `id_produk`, `id_info_pt`, `no_mesin`, `no_rangka`, `request_date`, `no_pdi`, `nm_p_bku_uang`, `nm_stnk`, `nm_p_ktp`, `tgl_jual`, `harga_jual`, `no_ktp_p`, `jk_p`, `tgl_lahir_p`, `pekerjaan_p`, `pendidikan_p`, `pengeluaran_p`, `tahun_produk`, `propinsi_p`, `kecamatan_p`, `kelurahan_p`, `alamat_1_p`, `alamat_2_p`, `kode_pos_p`, `tlp_p`, `stnk`, `no_polisi`, `tgl_reg_stnk`, `harga_stnk`, `id_leasing`, `uang_muka`, `jangka_bayar`, `angsuran`, `outlet`, `id_surveyor`, `id_user`, `qrcode_nk`, `jml_bayar`, `jml_di_bayar`, `id_status`, `id_status_stnk`) VALUES
(1, 'NP1401200001', 30, 1, 'G401E-0081344', 'MH3RG1010JK008693', NULL, NULL, 'Reza Rafiq', NULL, 'Indra Kasandra', '2020-01-14', 18000000, '757486586496595', 'L', '1993-12-24', 'Swasta', 'S1', '1000000', NULL, 'Sulawesi Tenggara', 'Batulo', 'Wolio', 'Jalan Sultan Hasanuddin No 26 Batulo', 'Jalan Sultan Hasanuddin No 28 Baubau', '93717', '082301238124', '', 'DT.1234.XY', '2020-01-14', 0, 1, 5000000, '2 Tahun', 700000, NULL, 'Kemal', 1, NULL, 5000000, 5000000, 1, 0);

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
  `no_faktur` varchar(114) NOT NULL,
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
  `hrg_awal` int(11) NOT NULL,
  `hrg_jual` int(11) NOT NULL,
  `id_validasi` int(11) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_pm`, `id_brg_pm`, `id_info_pt`, `no_rangka`, `no_mesin`, `no_faktur`, `no_pdi`, `id_jenis`, `id_merk`, `id_type`, `thn_produk`, `tgl_masuk`, `tgl_keluar`, `cc`, `bahan_bakar`, `warna`, `hrg_awal`, `hrg_jual`, `id_validasi`, `id_status`) VALUES
(1, 1, 1, 1, 'MH3SEF510KJ046645', 'E31WE-0046661', '00195/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(2, 1, 2, 1, 'MH3SEF510KJ046922', 'E31WE-0046937', '00317/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(3, 1, 1, 1, 'MH3SEF510KJ047407', 'E31WE-0047409', '00200/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(4, 1, 1, 1, 'MH3SEF510KJ047433', 'E31WE-0047444', '00206/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(5, 1, 3, 1, 'MH3SEF510KJ047678', 'E31WE-0047692', '00331/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(6, 1, 3, 1, 'MH3SEF510KJ047680', 'E31WE-0047695', '00332/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(7, 1, 3, 1, 'MH3SEF510KJ047681', 'E31WE-0047696', '00333/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(8, 1, 3, 1, 'MH3SEF510KJ047702', 'E31WE-0047716', '00211/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(9, 1, 3, 1, 'MH3SEF510KJ047747', 'E31WE-0047760', '00225/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(10, 1, 3, 1, 'MH3SEF510KJ047759', 'E31WE-0047767', '00229/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(11, 1, 2, 1, 'MH3SEF510KJ048050', 'E31WE-0048061', '00345/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(12, 1, 2, 1, 'MH3SEF510KJ048449', 'E31WE-0048458', '00358/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(13, 1, 2, 1, 'MH3SEF510KJ048466', 'E31WE-0048474', '00368/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(14, 1, 2, 1, 'MH3SEF510KJ048475', 'E31WE-0048483', '00370/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(15, 1, 1, 1, 'MH3SEF510KJ052467', 'E31WE-0052479', '01543/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(16, 1, 2, 1, 'MH3SEF510KJ053900', 'E31WE-0053915', '01227/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(17, 1, 4, 1, 'MH3SEF510KJ054384', 'E31WE-0054397', '01551/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'PERAK', 17000000, 18000000, 0, 1),
(18, 1, 4, 1, 'MH3SEF510KJ055336', 'E31WE-0055349', '01560/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'PERAK', 17000000, 18000000, 0, 1),
(19, 1, 4, 1, 'MH3SEF510KJ055337', 'E31WE-0055313', '01561/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'PERAK', 17000000, 18000000, 0, 1),
(20, 1, 4, 1, 'MH3SEF510KJ055342', 'E31WE-0055355', '01566/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'PERAK', 17000000, 18000000, 0, 1),
(21, 1, 4, 1, 'MH3SEF510KJ055353', 'E31WE-0055364', '01572/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'PERAK', 17000000, 18000000, 0, 1),
(22, 1, 4, 1, 'MH3SEF510KJ056394', 'E31WE-0056404', '01588/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'PERAK', 17000000, 18000000, 0, 1),
(23, 1, 1, 1, 'MH3SEF510KJ056960', 'E31WE-0056971', '01589/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(24, 1, 1, 1, 'MH3SEF510KJ056975', 'E31WE-0056985', '01595/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(25, 1, 1, 1, 'MH3SEF510KJ056977', 'E31WE-0056987', '01597/B5/ZA2701-1059', '', 1, 1, 1, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(26, 1, 5, 1, 'MH3SEF540KJ004625', 'E31XE-0018346', '01314/B5/ZA2701-1059', '', 1, 1, 2, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(27, 1, 5, 1, 'MH3SEF540KJ004722', 'E31XE-0018685', '01315/B5/ZA2701-1059', '', 1, 1, 2, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(28, 1, 5, 1, 'MH3SEF540KJ004757', 'E31XE-0018718', '01321/B5/ZA2701-1059', '', 1, 1, 2, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(29, 1, 6, 1, 'MH3SEF310JJ062704', 'E31VE-0082266', '01048/B3/ZA2701-1098', '', 1, 1, 3, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(30, 1, 7, 1, 'MH3RG1010JK008693', 'G401E-0081344', '00019/B0/ZA2701-1098', '', 1, 1, 4, 2019, '2020-01-14', '2020-01-14', '125', 'Bensin', 'BIRU', 17000000, 18000000, 1, 2),
(31, 2, 8, 1, 'MH3RG4610KK117401', 'G3E7E-0495111', '00001/B8/ZA2701-1059', '', 1, 1, 5, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(32, 2, 8, 1, 'MH3RG4610KK117412', 'G3E7E-0495185', '00002/B8/ZA2701-1059', '', 1, 1, 5, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(33, 2, 8, 1, 'MH3RG4610KK117413', 'G3E7E-0495186', '00003/B8/ZA2701-1059', '', 1, 1, 5, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(34, 2, 8, 1, 'MH3RG4610KK117424', 'G3E7E-0495092', '00006/B8/ZA2701-1059', '', 1, 1, 5, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(35, 2, 8, 1, 'MH3RG4610KK117443', 'G3E7E-0495120', '00012/B8/ZA2701-1059', '', 1, 1, 5, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(36, 2, 8, 1, 'MH3RG4610KK117449', 'G3E7E-0495125', '00016/B8/ZA2701-1059', '', 1, 1, 5, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(37, 2, 8, 1, 'MH3RG4610KK117554', 'G3E7E-0495249', '00046/B8/ZA2701-1059', '', 1, 1, 5, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(38, 2, 9, 1, 'MH3SE88H0KJ064705', 'E3R2E-2340600', '01147/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(39, 2, 9, 1, 'MH3SE88H0KJ064709', 'E3R2E-2340604', '01148/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(40, 2, 9, 1, 'MH3SE88H0KJ064711', 'E3R2E-2340611', '01150/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(41, 2, 9, 1, 'MH3SE88H0KJ064715', 'E3R2E-2340614', '01151/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(42, 2, 9, 1, 'MH3SE88H0KJ064716', 'E3R2E-2340616', '01152/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(43, 2, 9, 1, 'MH3SE88H0KJ064722', 'E3R2E-2340622', '01153/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(44, 2, 9, 1, 'MH3SE88H0KJ065212', 'E3R2E-2340451', '01156/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(45, 2, 9, 1, 'MH3SE88H0KJ075729', 'E3R2E-2368355', '01158/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(46, 2, 9, 1, 'MH3SE88H0KJ075763', 'E3R2E-2368381', '01159/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(47, 2, 9, 1, 'MH3SE88H0KJ075770', 'E3R2E-2368412', '01160/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(48, 2, 9, 1, 'MH3SE88H0KJ075779', 'E3R2E-2368423', '01161/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(49, 2, 9, 1, 'MH3SE88H0KJ075797', 'E3R2E-2368441', '01162/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(50, 2, 9, 1, 'MH3SE88H0KJ075973', 'E3R2E-2368610', '01163/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(51, 2, 9, 1, 'MH3SE88H0KJ076011', 'E3R2E-2368646', '01164/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(52, 2, 9, 1, 'MH3SE88H0KJ076013', 'E3R2E-2368648', '01165/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(53, 2, 9, 1, 'MH3SE88H0KJ076014', 'E3R2E-2368649', '01166/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(54, 2, 9, 1, 'MH3SE88H0KJ076035', 'E3R2E-2368671', '01168/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(55, 2, 10, 1, 'MH3SE88H0KJ088924', 'E3R2E-2406241', '00849/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(56, 2, 10, 1, 'MH3SE88H0KJ088928', 'E3R2E-2406245', '00850/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(57, 2, 10, 1, 'MH3SE88H0KJ088929', 'E3R2E-2406246', '00851/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(58, 2, 10, 1, 'MH3SE88H0KJ088931', 'E3R2E-2406249', '00852/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(59, 2, 10, 1, 'MH3SE88H0KJ088933', 'E3R2E-2406251', '00853/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(60, 2, 10, 1, 'MH3SE88H0KJ088936', 'E3R2E-2406254', '00854/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(61, 2, 10, 1, 'MH3SE88H0KJ088937', 'E3R2E-2406255', '00855/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(62, 2, 10, 1, 'MH3SE88H0KJ088940', 'E3R2E-2406247', '00856/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(63, 2, 10, 1, 'MH3SE88H0KJ089142', 'E3R2E-2406258', '00857/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(64, 2, 10, 1, 'MH3SE88H0KJ089175', 'E3R2E-2406292', '00872/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(65, 4, 15, 2, 'MH3SE88H0KJ094201', 'E3R2E-2419338', '00730/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 1, 1),
(66, 4, 15, 2, 'MH3SE88H0KJ094214', 'E3R2E-2419352', '00731/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 1, 1),
(67, 2, 11, 1, 'MH3SE88H0KJ094215', 'E3R2E-2419353', '00732/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(68, 2, 11, 1, 'MH3SE88H0KJ094222', 'E3R2E-2419339', '00733/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(69, 2, 11, 1, 'MH3SE88H0KJ094229', 'E3R2E-2419364', '00736/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(70, 2, 11, 1, 'MH3SE88H0KJ094238', 'E3R2E-2421046', '00738/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(71, 2, 11, 1, 'MH3SE88H0KJ094259', 'E3R2E-2421069', '00742/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(72, 2, 11, 1, 'MH3SE88H0KJ094260', 'E3R2E-2421071', '00743/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(73, 2, 11, 1, 'MH3SE88H0KJ094274', 'E3R2E-2421088', '00746/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(74, 2, 11, 1, 'MH3SE88H0KJ094287', 'E3R2E-2419367', '00748/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(75, 2, 11, 1, 'MH3SE88H0KJ094293', 'E3R2E-2421101', '00751/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(76, 2, 9, 1, 'MH3SE88H0KJ103681', 'E3R2E-2448693', '01169/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(77, 2, 9, 1, 'MH3SE88H0KJ103686', 'E3R2E-2448696', '01170/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(78, 2, 9, 1, 'MH3SE88H0KJ103689', 'E3R2E-2448699', '01171/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(79, 2, 9, 1, 'MH3SE88H0KJ103696', 'E3R2E-2448706', '01172/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(80, 2, 9, 1, 'MH3SE88H0KJ103697', 'E3R2E-2448707', '01173/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(81, 2, 9, 1, 'MH3SE88H0KJ103713', 'E3R2E-2448723', '01174/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(82, 2, 9, 1, 'MH3SE88H0KJ103716', 'E3R2E-2448726', '01175/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 0, 1),
(83, 2, 9, 1, 'MH3SE88H0KJ103718', 'E3R2E-2448728', '01176/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 1, 1),
(84, 2, 9, 1, 'MH3SE88H0KJ103719', 'E3R2E-2448729', '01177/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 1, 1),
(85, 2, 9, 1, 'MH3SE88H0KJ103720', 'E3R2E-2448730', '01178/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 1, 1),
(86, 2, 9, 1, 'MH3SE88H0KJ103891', 'E3R2E-2447769', '01179/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 1, 1),
(87, 2, 9, 1, 'MH3SE88H0KJ104915', 'E3R2E-2451252', '01180/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 1, 1),
(88, 2, 9, 1, 'MH3SE88H0KJ104924', 'E3R2E-2451261', '01181/SE/ZA2701-1049', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'MERAH', 17000000, 18000000, 1, 1),
(89, 2, 11, 1, 'MH3SE88H0KJ118447', 'E3R2E-2484522', '00789/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(90, 2, 11, 1, 'MH3SE88H0KJ118458', 'E3R2E-2484534', '00795/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(91, 2, 11, 1, 'MH3SE88H0KJ118463', 'E3R2E-2484539', '00796/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(92, 2, 11, 1, 'MH3SE88H0KJ118468', 'E3R2E-2484543', '00800/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(93, 2, 11, 1, 'MH3SE88H0KJ118476', 'E3R2E-2484551', '00803/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(94, 2, 11, 1, 'MH3SE88H0KJ118483', 'E3R2E-2484558', '00806/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(95, 2, 11, 1, 'MH3SE88H0KJ118492', 'E3R2E-2484567', '00809/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(96, 2, 11, 1, 'MH3SE88H0KJ118493', 'E3R2E-2484568', '00810/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(97, 2, 11, 1, 'MH3SE88H0KJ118500', 'E3R2E-2484575', '00812/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(98, 2, 12, 1, 'MH3SE8850KJ046814', 'E3W6E-0198917', '00054/BN/ZA2701-1059', '', 1, 1, 7, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'PERAK', 17000000, 18000000, 0, 1),
(99, 2, 12, 1, 'MH3SE8850KJ046857', 'E3W6E-0198963', '00060/BN/ZA2701-1059', '', 1, 1, 7, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'PERAK', 17000000, 18000000, 0, 1),
(100, 2, 12, 1, 'MH3SE8850KJ046864', 'E3W6E-0198971', '00061/BN/ZA2701-1059', '', 1, 1, 7, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'PERAK', 17000000, 18000000, 0, 1),
(101, 2, 12, 1, 'MH3SE8850KJ048411', 'E3W6E-0214515', '00067/BN/ZA2701-1059', '', 1, 1, 7, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'PERAK', 17000000, 18000000, 0, 1),
(102, 2, 12, 1, 'MH3SE8850KJ048428', 'E3W6E-0214532', '00070/BN/ZA2701-1059', '', 1, 1, 7, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'PERAK', 17000000, 18000000, 0, 1),
(103, 2, 12, 1, 'MH3SE8850KJ048429', 'E3W6E-0214533', '00071/BN/ZA2701-1059', '', 1, 1, 7, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'PERAK', 17000000, 18000000, 0, 1),
(104, 2, 12, 1, 'MH3SE8850KJ048461', 'E3W6E-0214567', '00081/BN/ZA2701-1059', '', 1, 1, 7, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'PERAK', 17000000, 18000000, 0, 1),
(105, 2, 12, 1, 'MH3SE8850KJ048462', 'E3W6E-0214568', '00082/BN/ZA2701-1059', '', 1, 1, 7, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'PERAK', 17000000, 18000000, 0, 1),
(106, 2, 12, 1, 'MH3SE8850KJ048463', 'E3W6E-0214569', '00083/BN/ZA2701-1059', '', 1, 1, 7, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'PERAK', 17000000, 18000000, 0, 1),
(107, 2, 12, 1, 'MH3SE8850KJ048472', 'E3W6E-0214575', '00089/BN/ZA2701-1059', '', 1, 1, 7, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'PERAK', 17000000, 18000000, 0, 1),
(108, 3, 13, 1, 'MH3SE88H0KJ088212', 'E3R2E-2404157', '00836/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(109, 3, 13, 1, 'MH3SE88H0KJ088921', 'E3R2E-2406238', '00848/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(110, 3, 13, 1, 'MH3SE88H0KJ089143', 'E3R2E-2406259', '00858/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(111, 3, 13, 1, 'MH3SE88H0KJ089145', 'E3R2E-2406261', '00859/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(112, 3, 13, 1, 'MH3SE88H0KJ089147', 'E3R2E-2406263', '00860/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(113, 3, 13, 1, 'MH3SE88H0KJ089149', 'E3R2E-2406265', '00861/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(114, 3, 13, 1, 'MH3SE88H0KJ089150', 'E3R2E-2406266', '00862/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(115, 3, 13, 1, 'MH3SE88H0KJ089152', 'E3R2E-2406268', '00863/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(116, 3, 13, 1, 'MH3SE88H0KJ089154', 'E3R2E-2406270', '00864/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(117, 3, 13, 1, 'MH3SE88H0KJ089155', 'E3R2E-2406271', '00865/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(118, 3, 13, 1, 'MH3SE88H0KJ089156', 'E3R2E-2406273', '00866/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(119, 3, 13, 1, 'MH3SE88H0KJ089157', 'E3R2E-2406274', '00867/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 0, 1),
(120, 3, 13, 1, 'MH3SE88H0KJ089159', 'E3R2E-2406276', '00868/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 1, 1),
(121, 3, 13, 1, 'MH3SE88H0KJ089161', 'E3R2E-2406278', '00869/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 1, 1),
(122, 3, 13, 1, 'MH3SE88H0KJ089163', 'E3R2E-2406281', '00870/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 1, 1),
(123, 3, 13, 1, 'MH3SE88H0KJ089173', 'E3R2E-2406290', '00871/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 1, 1),
(124, 3, 13, 1, 'MH3SE88H0KJ089183', 'E3R2E-2406301', '00875/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 1, 1),
(125, 3, 13, 1, 'MH3SE88H0KJ089191', 'E3R2E-2406308', '00880/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 1, 1),
(126, 3, 13, 1, 'MH3SE88H0KJ089210', 'E3R2E-2406329', '00884/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 1, 1),
(127, 3, 13, 1, 'MH3SE88H0KJ089212', 'E3R2E-2406331', '00885/SE/ZA2701-1039', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'HITAM', 17000000, 18000000, 1, 1),
(128, 3, 14, 1, 'MH3SE88H0KJ094227', 'E3R2E-2419362', '00735/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(129, 3, 14, 1, 'MH3SE88H0KJ094236', 'E3R2E-2419374', '00737/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(130, 3, 14, 1, 'MH3SE88H0KJ094246', 'E3R2E-2421054', '00740/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(131, 3, 14, 1, 'MH3SE88H0KJ094258', 'E3R2E-2421068', '00741/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(132, 3, 14, 1, 'MH3SE88H0KJ094271', 'E3R2E-2421085', '00745/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(133, 3, 14, 1, 'MH3SE88H0KJ094277', 'E3R2E-2421091', '00747/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(134, 3, 14, 1, 'MH3SE88H0KJ094289', 'E3R2E-2421070', '00749/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(135, 3, 14, 1, 'MH3SE88H0KJ118451', 'E3R2E-2484526', '00790/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(136, 3, 14, 1, 'MH3SE88H0KJ118453', 'E3R2E-2484529', '00791/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(137, 3, 14, 1, 'MH3SE88H0KJ118455', 'E3R2E-2484531', '00792/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(138, 3, 14, 1, 'MH3SE88H0KJ118456', 'E3R2E-2484532', '00793/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(139, 3, 14, 1, 'MH3SE88H0KJ118457', 'E3R2E-2484533', '00794/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(140, 3, 14, 1, 'MH3SE88H0KJ118466', 'E3R2E-2484541', '00798/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(141, 3, 14, 1, 'MH3SE88H0KJ118467', 'E3R2E-2484542', '00799/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(142, 3, 14, 1, 'MH3SE88H0KJ118469', 'E3R2E-2484544', '00801/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(143, 3, 14, 1, 'MH3SE88H0KJ118471', 'E3R2E-2484546', '00802/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(144, 3, 14, 1, 'MH3SE88H0KJ118480', 'E3R2E-2484555', '00804/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(145, 3, 14, 1, 'MH3SE88H0KJ118481', 'E3R2E-2484556', '00805/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(146, 3, 14, 1, 'MH3SE88H0KJ118487', 'E3R2E-2484562', '00807/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1),
(147, 3, 14, 1, 'MH3SE88H0KJ118491', 'E3R2E-2484566', '00808/SE/ZA2701-1059', '', 1, 1, 6, 2019, '2020-01-14', '0000-00-00', '125', 'Bensin', 'BIRU', 17000000, 18000000, 0, 1);

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
(1, 'PK1401200001', 1, 2, 1, 'La Ode Agus Salim Nur', '2020-01-14', '11:14:09', 0);

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
(1, 1, '2020-01-14', '11:12:34', '', 'SBY/03/19/06/0062', 53963, 51535, '2020-01-14', '2020-01-14', 0),
(2, 1, '2020-01-14', '11:12:34', '', 'SBY/03/19/06/0064', 53961, 51534, '2020-01-14', '2020-01-14', 0),
(3, 1, '2020-01-14', '11:12:34', '', 'SBY/03/19/06/0065', 54040, 51547, '2020-01-14', '2020-01-14', 0),
(4, 2, '2020-01-14', '11:14:18', 'PK1401200001', 'PK1401200001', 1, 1, '2020-01-14', '2020-01-14', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_brg_pk`
--

CREATE TABLE `r_brg_pk` (
  `id_r_brg_pk` int(11) NOT NULL,
  `id_pm_asal` int(11) NOT NULL,
  `id_brg_pm_asal` int(11) NOT NULL,
  `id_pk` int(11) NOT NULL,
  `id_info_pt_asal` int(11) NOT NULL,
  `id_info_pt_tujuan` int(11) NOT NULL,
  `id_brg_pk` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `r_brg_pk`
--

INSERT INTO `r_brg_pk` (`id_r_brg_pk`, `id_pm_asal`, `id_brg_pm_asal`, `id_pk`, `id_info_pt_asal`, `id_info_pt_tujuan`, `id_brg_pk`, `id_produk`) VALUES
(1, 2, 11, 1, 1, 2, 1, 65),
(2, 2, 11, 1, 1, 2, 1, 66);

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
-- Struktur dari tabel `tahun`
--

CREATE TABLE `tahun` (
  `id_tahun` int(11) NOT NULL,
  `id_info_pt` int(11) NOT NULL,
  `kode_tahun` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tahun`
--

INSERT INTO `tahun` (`id_tahun`, `id_info_pt`, `kode_tahun`) VALUES
(1, 0, 2020),
(2, 1, 2020);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggal`
--

CREATE TABLE `tanggal` (
  `id_tanggal` int(11) NOT NULL,
  `id_info_pt` int(11) NOT NULL,
  `kode` date NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tanggal`
--

INSERT INTO `tanggal` (`id_tanggal`, `id_info_pt`, `kode`, `total`) VALUES
(1, 1, '2020-01-14', 5000000);

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
(1, 1, 1, 'FREEGO', 'FREEGO', 'FREEGO'),
(2, 1, 1, 'FREEGO S ABS', 'FREEGOSABS', 'FREEGOSABS'),
(3, 1, 1, 'LEXI', 'LEXI', 'LEXI'),
(4, 1, 1, 'MT25', 'MT25', 'MT25'),
(5, 1, 1, 'ALL NEW VIXION', 'ALLNEWVIXION', 'ALLNEWVIXION'),
(6, 1, 1, 'MIO M3 CW', 'MIOM3CW', 'MIOM3CW'),
(7, 1, 1, 'MIO M3 CW SSS', 'MIOM3CWSSS', 'MIOM3CWSSS');

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
(1, '127.0.0.1', 'administrator', '$2y$12$QFxx7D9v0OHPtAi3QvMD5eUaGGHstO6tipOQeiO2U6YO09CCQFT8C', '', 'admin@admin.com', NULL, '', NULL, NULL, NULL, '7a534506190a571a814d7900101359fdb9a11b10', '$2y$10$AV3u2q4nFT49UC8O79BJ8uIg89LAN3jCJbcadbsHUt6PNV3lzmKRS', 1268889823, 1578988473, 1, 'La Ode Agus Salim Nur', 'istrator', 'L', 'Dealer Resmi Kendaraan Roda 2 - Merk Yamaha', 1, '082343211234', 'default.png'),
(2, '::1', '201912122', '$2y$10$d1tsA6D4ZUm1w0vgVv9eLOKXTAk/bPodzTGXpzXdYrJolhvm..84.', 'mandatizamrud2412', 'rezarafiqmz@gmail.com', NULL, NULL, NULL, NULL, NULL, '9b0c10fad0a45a1ff1bda8116541c56c8e07ff01', '$2y$10$mkpAuIM1M43IaHed6WcH4uagctbusLkc0o860Qb7PJ/Wuf/m39TVm', 1576150007, 1576301529, 1, 'Reza Rafiq', '', 'L', 'Dealer Resmi Kendaraan Roda 2 - Merk Yamaha', 1, '082312341234', 'default.png'),
(3, '::1', '201912123', '$2y$10$II5PSdysl1jb5VUInlmcCuQrtjznHoJcb5qUfO6q94Vsvdo/a3DyC', 'hardina321', 'peserta@unidayan.ac.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1576150686, NULL, 1, 'Hardina Kaimudin', '', 'P', 'Raha Dealer Resmi Kendaraan Roda 2 - Merk Yamaha', 2, '082245126655', 'default.png'),
(4, '::1', '201912124', '$2y$12$Ml36MPLajwxG5DXbCkhOR.fTf0XI5CFlYk2vd/wQHzp6XOVzi2pZG', 'ali1234', 'raha@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1576171050, 1578405873, 1, 'Ali Akbar', '', 'L', 'Raha Dealer Resmi Kendaraan Roda 2 - Merk Yamaha	', 2, '081222224222', 'default.png');

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
-- Indeks untuk tabel `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indeks untuk tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `histori_harga`
--
ALTER TABLE `histori_harga`
  ADD PRIMARY KEY (`id_hh`);

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
-- Indeks untuk tabel `leasing`
--
ALTER TABLE `leasing`
  ADD PRIMARY KEY (`id_leasing`);

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
-- Indeks untuk tabel `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`id_tahun`);

--
-- Indeks untuk tabel `tanggal`
--
ALTER TABLE `tanggal`
  ADD PRIMARY KEY (`id_tanggal`);

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
  MODIFY `id_brg_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `brg_pm`
--
ALTER TABLE `brg_pm`
  MODIFY `id_brg_pm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id_bulan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `histori_harga`
--
ALTER TABLE `histori_harga`
  MODIFY `id_hh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT untuk tabel `leasing`
--
ALTER TABLE `leasing`
  MODIFY `id_leasing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `merk`
--
ALTER TABLE `merk`
  MODIFY `id_merk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `nota_keluar`
--
ALTER TABLE `nota_keluar`
  MODIFY `id_nota_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id_pembeli` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT untuk tabel `produkkeluar`
--
ALTER TABLE `produkkeluar`
  MODIFY `id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `produkmasuk`
--
ALTER TABLE `produkmasuk`
  MODIFY `id_pm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `r_brg_pk`
--
ALTER TABLE `r_brg_pk`
  MODIFY `id_r_brg_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tahun`
--
ALTER TABLE `tahun`
  MODIFY `id_tahun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tanggal`
--
ALTER TABLE `tanggal`
  MODIFY `id_tanggal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
