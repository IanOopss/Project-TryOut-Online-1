-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2021 at 06:10 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bangambo_university`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level_admin` int(1) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username`, `password`, `level_admin`, `nama`) VALUES
(1, 'admin', '$argon2i$v=19$m=65536,t=4,p=1$WDRZY2d1czBLTUVPN0xKWQ$4P4jN0WtxfBT1aCFioAaGSQONB0FlnrYA/QtaQThrow', 1, 'Bang Ambo'),
(7, '181402051', '$argon2i$v=19$m=65536,t=4,p=1$U3ouNkpUbnNVVHlOY2ZGRA$ehkBtFSE9pogSe+TWJkXudIdRCdqfORr/KT2BeLxLdA', 2, 'Albert');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_informasi`
--

CREATE TABLE `tbl_informasi` (
  `id_informasi` int(11) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `tgl_pendaftaran` date NOT NULL,
  `tgl_tutup` date NOT NULL,
  `tgl_lulus_adm` date NOT NULL,
  `tgl_ujian_cat` date NOT NULL,
  `waktu_pengerjaan` int(11) NOT NULL,
  `alur_pendaftaran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_informasi`
--

INSERT INTO `tbl_informasi` (`id_informasi`, `nama_kegiatan`, `tgl_pendaftaran`, `tgl_tutup`, `tgl_lulus_adm`, `tgl_ujian_cat`, `waktu_pengerjaan`, `alur_pendaftaran`) VALUES
(1, 'Tryout SBMPTN Online', '2021-09-22', '2021-11-22', '2021-09-28', '2021-09-29', 90, '1632747094_d3d8e2329d733e2a44b3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jawaban`
--

CREATE TABLE `tbl_jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `list_soal` longtext NOT NULL,
  `list_jawaban` longtext NOT NULL,
  `waktu_mulai` datetime NOT NULL,
  `waktu_selesai` datetime NOT NULL,
  `status_jawaban` enum('Belum','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jawaban`
--

INSERT INTO `tbl_jawaban` (`id_jawaban`, `id_peserta`, `list_soal`, `list_jawaban`, `waktu_mulai`, `waktu_selesai`, `status_jawaban`) VALUES
(1, 10, '9,13,11,21,3,17,10,19,1,18,20,6,5,16,2,7,15,14,12,4,45,37,58,33,32,34,48,43,42,40,22,49,50,61,39,41,60,44,35,38,59,36,23,62,31,77,69,57,76,79,65,46,8,66,53,72,80,68,47,75,51,54,63,64,56,55,67,73,74,83,78,71,52,81,70', '9:A:Y:S,13:B:Y:B,11:E:Y:S,21:A:Y:S,3:A:Y:B,17:E:Y:S,10:A:Y:S,19:A:Y:S,1:A:Y:S,18:C:Y:B,20:D:Y:S,6:A:Y:S,5:D:Y:S,16:D:Y:S,2:C:Y:S,7:E:Y:S,15:E:Y:S,14:C:Y:S,12:C:Y:S,4:E:Y:S,45:E:Y:B,37:C:Y:S,58:B:Y:S,33:B:Y:S,32:E:Y:S,34:B:Y:S,48:E:Y:B,43:E:Y:S,42:E:Y:S,40:B:Y:B,22:C:Y:S,49:D:Y:B,50:A:Y:B,61:C:Y:S,39:C:Y:S,41:D:Y:S,60:B:Y:S,44:C:Y:B,35:E:Y:S,38:B:Y:S,59:B:Y:S,36:C:Y:S,23:D:Y:S,62:C:Y:S,31:C:Y:S,77:A:Y:S,69:A:Y:B,57:D:Y:S,76:B:Y:B,79:E:Y:S,65:C:Y:S,46:B:Y:B,8:D:Y:S,66:E:Y:S,53:E:Y:S,72:D:Y:S,80:D:Y:B,68:D:Y:B,47:C:Y:S,75:C:Y:B,51:B:Y:S,54:E:Y:S,63:D:Y:S,64:B:Y:S,56:D:Y:S,55:E:Y:S,67:A:Y:S,73:D:Y:S,74:D:Y:S,83:D:Y:S,78:C:Y:S,71:E:Y:S,52:E:Y:S,81:E:Y:B,70:E:Y:S', '2018-12-01 21:47:41', '2018-12-01 23:17:41', 'Selesai'),
(2, 9, '21,13,4,14,18,9,17,5,12,16,10,6,1,2,19,7,11,15,3,20,49,37,32,38,40,58,23,50,36,34,62,44,43,33,39,35,31,61,42,45,41,60,22,59,48,76,69,46,67,8,81,47,53,54,74,68,65,52,56,72,73,70,55,71,80,78,83,63,75,79,51,66,64,57,77', '21:E:Y:B,13:B:Y:B,4:B:Y:S,14:B:Y:S,18:C:Y:B,9:E:Y:S,17:B:Y:S,5:A:Y:B,12:B:Y:S,16:C:Y:S,10:C:Y:S,6:A:Y:S,1:B:Y:B,2:C:Y:S,19:C:Y:B,7:C:Y:B,11:D:Y:S,15:C:Y:B,3:C:Y:S,20:B:Y:S,49:E:Y:S,37:D:Y:S,32:D:Y:S,38:C:Y:S,40:D:Y:S,58:E:Y:S,23:B:Y:S,50:B:Y:S,36:B:Y:S,34:B:Y:S,62:B:Y:S,44:C:Y:B,43:C:Y:S,33:E:Y:S,39:B:Y:S,35:D:Y:S,31:C:Y:S,61:E:Y:S,42:D:Y:S,45:D:Y:S,41:A:Y:S,60:A:Y:S,22:A:Y:B,59:A:Y:S,48:B:Y:S,76:C:Y:S,69:C:Y:S,46:B:Y:B,67:D:Y:S,8:C:Y:S,81:C:Y:S,47:B:Y:B,53:E:Y:S,54:E:Y:S,74:B:Y:S,68:D:Y:B,65:C:Y:S,52:E:Y:S,56:A:Y:S,72:C:Y:S,73:C:Y:B,70:A:Y:B,55:C:Y:S,71:C:Y:S,80:B:Y:S,78:D:Y:B,83:C:Y:S,63:B:Y:S,75:D:Y:S,79:C:Y:S,51:C:Y:S,66:D:Y:S,64:E:Y:S,57:E:Y:B,77:C:Y:S', '2018-12-01 21:58:35', '2018-12-01 23:28:35', 'Selesai'),
(3, 13, '19,18,16,4,21,1,12,11,5,17,9,10,6,7,15,13,14,2,20,3,41,39,22,38,59,33,45,35,37,31,60,44,61,58,34,62,49,43,23,42,36,40,48,32,50,77,53,81,65,71,70,63,72,67,69,66,75,74,80,78,68,83,8,52,76,54,51,64,57,73,47,79,46,56,55', '19:A:Y:S,18:C:Y:B,16:B:Y:S,4:A:Y:S,21:B:Y:S,1:B:Y:B,12:C:Y:S,11:C:Y:S,5:B:Y:S,17:E:Y:S,9:B:Y:B,10:C:Y:S,6:C:Y:B,7:A:Y:S,15:B:Y:S,13:D:Y:S,14:C:Y:S,2:B:Y:S,20:B:Y:S,3:D:Y:S,41:A:Y:S,39:B:Y:S,22:C:Y:S,38:B:Y:S,59:B:Y:S,33:B:Y:S,45:D:Y:S,35:B:Y:S,37:C:Y:S,31:D:Y:B,60:C:Y:B,44:B:Y:S,61:B:Y:B,58:D:Y:S,34:B:Y:S,62:A:Y:S,49:B:Y:S,43:C:Y:S,23:B:Y:S,42:D:Y:S,36:E:Y:S,40:C:Y:S,48:B:Y:S,32:D:Y:S,50:A:Y:B,77:B:Y:S,53:D:Y:S,81:C:Y:S,65:C:Y:S,71:D:Y:S,70:A:Y:B,63:A:Y:B,72:E:Y:S,67:B:Y:S,69:A:Y:B,66:E:Y:S,75:E:Y:S,74:B:Y:S,80:C:Y:S,78:C:Y:S,68:A:Y:S,83:E:Y:S,8:E:Y:S,52:C:Y:B,76:E:Y:S,54:B:Y:S,51:E:Y:S,64:B:Y:S,57:B:Y:S,73:C:Y:B,47:A:Y:S,79:B:Y:S,46:B:Y:B,56:B:Y:B,55:B:Y:S', '2018-12-01 22:05:18', '2018-12-01 23:35:18', 'Selesai'),
(4, 14, '19,1,7,11,9,5,3,14,12,2,13,20,21,17,10,6,4,18,16,15,34,38,61,37,23,31,60,45,33,42,49,41,36,43,22,44,32,62,58,40,39,50,59,48,35,80,78,65,67,57,75,70,77,47,68,79,63,72,55,83,64,69,52,74,66,46,81,73,54,76,71,53,51,8,56', '19:C:Y:B,1:A:Y:S,7:C:Y:B,11:B:Y:B,9:B:Y:B,5:B:Y:S,3:B:Y:S,14:A:Y:B,12:A:Y:B,2:E:Y:B,13:B:Y:B,20:C:Y:S,21:C:Y:S,17:D:Y:S,10:C:Y:S,6:D:Y:S,4:D:Y:B,18:C:Y:B,16:B:Y:S,15:C:Y:B,34:E:Y:S,38:D:Y:B,61:B:Y:B,37:E:Y:S,23:C:Y:S,31:D:Y:B,60:C:Y:B,45:E:Y:B,33:C:Y:S,42:D:Y:S,49:C:Y:S,41:B:Y:B,36:C:Y:S,43:C:Y:S,22:E:Y:S,44:D:Y:S,32:E:Y:S,62:B:Y:S,58:D:Y:S,40:E:Y:S,39:B:Y:S,50:B:Y:S,59:D:Y:S,48:D:Y:S,35:E:Y:S,80:E:Y:S,78:C:Y:S,65:A:Y:S,67:A:Y:S,57:D:Y:S,75:E:Y:S,70:A:Y:B,77:C:Y:S,47:C:Y:S,68:C:Y:S,79:D:Y:S,63:B:Y:S,72:E:Y:S,55:E:Y:S,83:D:Y:S,64:E:Y:S,69:E:Y:S,52:D:Y:S,74:C:Y:S,66:A:Y:B,46:D:Y:S,81:E:Y:B,73:D:Y:S,54:E:Y:S,76:E:Y:S,71:E:Y:S,53:E:Y:S,51:D:Y:S,8:C:Y:S,56:C:Y:S', '2018-12-01 22:10:34', '2018-12-01 23:40:34', 'Selesai'),
(5, 17, '16,7,1,9,5,17,4,11,21,13,19,2,12,10,3,20,6,18,14,15,44,41,38,43,40,23,58,50,62,32,22,48,35,59,49,33,31,36,34,45,60,37,42,39,61,81,56,75,64,71,76,52,51,57,46,63,47,55,8,53,80,74,73,69,78,54,83,70,68,72,77,67,65,66,79', '16:C:Y:S,7:A:Y:S,1:B:Y:B,9:A:Y:S,5:A:Y:B,17:X:N:S,4:X:N:S,11:X:N:S,21:X:N:S,13:X:N:S,19:X:N:S,2:X:N:S,12:X:N:S,10:X:N:S,3:X:N:S,20:X:N:S,6:X:N:S,18:X:N:S,14:X:N:S,15:X:N:S,44:X:N:S,41:X:N:S,38:X:N:S,43:X:N:S,40:X:N:S,23:X:N:S,58:X:N:S,50:X:N:S,62:X:N:S,32:X:N:S,22:X:N:S,48:X:N:S,35:X:N:S,59:X:N:S,49:X:N:S,33:A:Y:B,31:X:N:S,36:X:N:S,34:X:N:S,45:X:N:S,60:X:N:S,37:X:N:S,42:X:N:S,39:X:N:S,61:X:N:S,81:X:N:S,56:X:N:S,75:X:N:S,64:X:N:S,71:X:N:S,76:X:N:S,52:X:N:S,51:X:N:S,57:X:N:S,46:X:N:S,63:X:N:S,47:X:N:S,55:X:N:S,8:X:N:S,53:X:N:S,80:X:N:S,74:X:N:S,73:X:N:S,69:X:N:S,78:X:N:S,54:X:N:S,83:X:N:S,70:X:N:S,68:X:N:S,72:X:N:S,77:X:N:S,67:X:N:S,65:X:N:S,66:X:N:S,79:X:N:S', '2021-09-15 11:03:07', '2021-09-15 12:33:07', 'Selesai'),
(6, 21, '5,4,3,17,14,2,9,11,7,1,13,10,84,19,16,18,6,12,20,15,60,35,32,22,34,43,38,23,33,44,37,41,49,59,62,31,58,40,50,48,39,42,36,45,61,53,83,68,66,80,8,81,47,71,69,46,63,77,51,76,78,67,70,52,54,72,57,79,55,75,73,56,64,74,65', '5:B:Y:S,4:D:Y:B,3:C:Y:S,17:A:Y:B,14:C:Y:S,2:C:Y:S,9:A:Y:S,11:B:Y:B,7:B:Y:S,1:B:Y:B,13:B:Y:B,10:B:Y:S,84:A:Y:B,19:C:Y:B,16:A:Y:B,18:C:Y:B,6:C:Y:B,12:A:Y:B,20:D:Y:S,15:C:Y:B,60:E:Y:S,35:C:Y:B,32:D:Y:S,22:A:Y:B,34:A:Y:B,43:E:Y:S,38:A:Y:S,23:A:Y:B,33:B:Y:S,44:D:Y:S,37:C:Y:S,41:B:Y:B,49:D:Y:B,59:C:Y:B,62:B:Y:S,31:B:Y:S,58:C:Y:B,40:B:Y:B,50:B:Y:S,48:E:Y:B,39:D:Y:B,42:B:Y:S,36:A:Y:B,45:E:Y:B,61:C:Y:S,53:A:Y:S,83:E:Y:S,68:A:Y:S,66:D:Y:S,80:E:Y:S,8:E:Y:S,81:B:Y:S,47:E:Y:S,71:B:Y:S,69:B:Y:S,46:B:Y:B,63:E:Y:S,77:B:Y:S,51:A:Y:B,76:A:Y:S,78:D:Y:B,67:C:Y:B,70:A:Y:B,52:B:Y:S,54:D:Y:B,72:B:Y:B,57:E:Y:B,79:X:N:S,55:X:N:S,75:X:N:S,73:X:N:S,56:X:N:S,64:X:N:S,74:C:Y:S,65:D:Y:B', '2021-09-29 13:53:57', '2021-09-29 20:57:57', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lab`
--

CREATE TABLE `tbl_lab` (
  `id_lab` int(11) NOT NULL,
  `nama_lab` varchar(255) NOT NULL,
  `jumlah_formasi` int(11) NOT NULL,
  `jumlah_peserta` int(11) NOT NULL,
  `jumlah_lulus_adm` int(11) NOT NULL,
  `lampiran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lab`
--

INSERT INTO `tbl_lab` (`id_lab`, `nama_lab`, `jumlah_formasi`, `jumlah_peserta`, `jumlah_lulus_adm`, `lampiran`) VALUES
(2, 'Laboratorium Embeded System', 3, 2, 3, 'Laboratorium_Interaksi_Manusia_dan_Komputer.pdf'),
(3, 'Laboratorium Simulasi Kebakaran', 3, 3, 2, 'Laboratorium_Simulasi_Kebakaran.pdf'),
(4, 'Laboratorium Algoritma Pemograman', 2, 2, 2, 'Laboratorium_Sistem_Basis_Data.pdf'),
(5, 'Laboratorium Jaringan Komputer', 3, 2, 2, 'Laboratorium_Struktur_Data_dan_Algoritma.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `nilai_peserta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_nilai`
--

INSERT INTO `tbl_nilai` (`id_nilai`, `id_peserta`, `id_soal`, `nilai_peserta`) VALUES
(1, 10, 1, 15),
(2, 10, 2, 30),
(3, 10, 3, 35),
(4, 9, 1, 40),
(5, 9, 2, 10),
(6, 9, 3, 35),
(7, 13, 1, 20),
(8, 13, 2, 20),
(9, 13, 3, 35),
(10, 14, 1, 55),
(11, 14, 2, 30),
(12, 14, 3, 15),
(13, 17, 1, 10),
(14, 17, 2, 5),
(55, 21, 1, 60),
(56, 21, 3, 50),
(57, 21, 2, 70);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pertanyaan`
--

CREATE TABLE `tbl_pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `option_1` varchar(255) NOT NULL,
  `option_2` varchar(255) NOT NULL,
  `option_3` varchar(255) NOT NULL,
  `option_4` varchar(255) NOT NULL,
  `option_5` varchar(255) NOT NULL,
  `jawaban` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pertanyaan`
--

INSERT INTO `tbl_pertanyaan` (`id_pertanyaan`, `id_soal`, `pertanyaan`, `option_1`, `option_2`, `option_3`, `option_4`, `option_5`, `jawaban`) VALUES
(1, 1, '<p>Persamaan kata <strong>Pikun</strong> adalah....</p>\r\n', 'Tua', 'Pelupa', 'Siput', 'Tuli', 'Api', 'B'),
(2, 1, '<p>Persamaan kata <strong>Prodeo</strong> adalah....</p>\r\n', 'Murah', 'Tak berharga', 'Kuat', 'Berpenjaga', 'Cuma-cuma', 'E'),
(3, 1, '<p>Persamaan kata <strong>Asasi</strong> adalah....</p>\r\n', 'Pokok', 'Hak', 'Utama', 'Pertama', 'Pasti', 'A'),
(4, 1, '<p>Lawan kata <strong>Semu</strong> adalah....</p>\r\n', 'Palsu', 'Murni', 'Gadungan', 'Asli', 'Baik', 'D'),
(5, 1, '<p>Lawan kata <strong>Seteru</strong> adalah....</p>\r\n', 'Kawan', 'Lawan', 'Tetap', 'Pasangan', 'Ganda', 'A'),
(6, 1, '<p>Lawan kata <strong>Universal</strong> adalah....</p>\r\n', 'Kausal', 'Mondial', 'Parsial', 'Furtural', 'Futual', 'C'),
(7, 1, '<p>Keris:Jawa....</p>\r\n', 'Badik:Bali', 'Madura:Celurit', 'Kujang:Sunda', 'Pisau:Dapur', 'Aceh:Rencong', 'C'),
(8, 3, '<p>Deskripsi abstrak dari sebuah informasi dan tingkah laku dari sekumpulan data disebut....</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Class', 'Object', 'Method', 'Function', 'Model', 'A'),
(9, 1, '<p>Kemeja : kancing = Rumah : &hellip;.</p>\r\n', 'Atap', 'Pintu', 'Kamar', 'Tirai', 'WC', 'B'),
(10, 1, '<p>RUMAH : genteng = KEPALA : &hellip;.</p>\r\n', 'Ikat Pinggang', 'Topi', 'Pita', 'Rambut', 'Mata', 'D'),
(11, 1, '<p>DINGIN : selimut = HUJAN : &hellip;.</p>\r\n', 'Air', 'Payung', 'Dingin', 'Basah', 'Banjir', 'B'),
(12, 1, '<p>MOBIL : bensin = PELARI : &hellip;.</p>\r\n', 'Makanan ', 'Sepatu', 'Kaos', 'Lintasan', 'Lelah', 'A'),
(13, 1, '<p>Mirna selalu memberi hadiah barang-barang mahal. Andi diberi hadiah dasi oleh mirna. Jadi &hellip;.</p>\r\n', 'Mirna selalu memberi hadiah dasi', 'Dasi pemberian mirna mahal', 'Dasi pemberian mirna murah', 'Andi selalu diberi hadiah barang-barang mahal', 'Dasi adalah barang mahal', 'B'),
(14, 1, '<p>Air merupakan kebutuhan pokok manusia. Masyarakat di padang pasir hanya sedikit memiliki persediaan air. Jadi &hellip;.</p>\r\n', 'Masyarakat di padang pasir harus berhemat menggunakan air', 'Masyarakat di padang pasir tidak membutuhkan air', 'Masyarakat di padang pasir harus berhemat menggunakan pasir', 'Meskipun tanpa air, masyarakat di padang pasir tetap bias hidup', 'Air bukanlah kebutuhan pokok masyarakat di padang pasir', 'A'),
(15, 1, '<p>Semua menu makanan restoran B diolah dari bahan organic. Sebagian menu makanan diolah tanpa menggunakan minyak (tidak digoreng)....</p>\r\n', 'Semua menu yang diolah dengan cara digoreng bukan menu restoran B.', 'Semua menu restoran B diolah tanpa digoreng dengan minyak', 'Sebagian menu restoran B dengan bahan organi diolah dengan cara digoreng', 'Semua menu diolah dengan cara digoreng menggunakan bahan organic', 'Semua menu restoran B diolah tanpa digoreng tampa minyak', 'C'),
(16, 1, '<p>13, 14, 13, 14, 11, 12, 11, 12, 15, 16, 13 &hellip;.</p>\r\n', '14, 13, 14', '14, 15, 13', '12, 16, 14', '13, 13, 13', '14, 14, 14', 'A'),
(17, 1, '<p>1, 9, 2, 2, 9, 3, 3, 9, 4, 4 &hellip;.</p>\r\n', '9', '8', '7', '5', '6', 'A'),
(18, 1, '<p>18, 20, 24, 32 &hellip;.</p>\r\n', '80, 48', '46, 60', '48, 80', '40, 48', '34, 36', 'C'),
(19, 1, '<p>304,09 : 64,7 = &hellip;.</p>\r\n', '0,047', '0,74', '4,7', '7,4', '47', 'C'),
(20, 1, '<p>15% x (12,5 + 33) = &hellip;.</p>\r\n', '68,25', '6,825', '682,5', '0,6825', '6825', 'A'),
(22, 2, '<p>Dua buah komputer terkoneksi dan dihubungkan dengan printer maka komputer seperti ini disebut &hellip;.</p>\r\n', 'LAN', 'MAN', 'WAN', 'Personal Komputer', 'Mikro Komputer', 'A'),
(23, 2, '<p>LAN membentuk pola kerja yang disebut &hellip;.</p>\r\n', 'Workstation', 'Workpersonal', 'Personal komputer', 'Personal Internet', 'Super Komputer', 'A'),
(31, 2, '<p>Belanja melalui internet disebut &hellip;</p>\r\n', 'Browsing	', 'Surving	', 'Hacking	', 'Chatting	', 'Online Shop', 'D'),
(32, 2, '<p>Alamat-alamat dalam halaman web dikenal dengan nama &hellip;</p>\r\n', 'Web', 'UTP', 'URL', 'IP', 'ISO', 'C'),
(33, 2, '<p>Jika anda bekerja dengan komputer yang tidak terhubung dengan komputer lain maka anda dikatakan bekerja secara &hellip;.</p>\r\n', 'Stand Alone', 'LAN', 'Paralel', 'Embeded System', 'Workstation', 'A'),
(34, 2, '<p>Yahoo, MSN dan Google merupakan &hellip;</p>\r\n', 'Search Engine', 'Aplikasi', 'Start Up', 'URL', 'Situs', 'A'),
(35, 2, '<p>Download adalah &hellip;.</p>\r\n', 'Memasukkan data ke internet', 'Memperbarui data di internet', 'Memasukkan data dari internet ke komputer', 'Streaming Film', 'Menghapus Data', 'C'),
(36, 2, '<p>Contoh-contoh software desain grafis adalah &hellip;.</p>\r\n', 'Adobe Ilustrator, Adobe FreeHand dan Corel Draw', 'Adobe Ilustrator, Adobe After Efect dan Corel Draw', 'Adobe Ilustrator, Adobe Flash Player dan Sublime Text', 'Visual Studio, Adobe Flash Player dan Sublime Text', 'Adobe Ilustrator, Adobe Flash Player dan Adobe Photo Shop', 'A'),
(37, 2, '<p>Pembagian ruang dalam hardisk diistilahkan dengan &hellip;.</p>\r\n', 'Partisi', 'Debug', 'Divisi', 'Karnel', 'Router', 'A'),
(38, 2, '<p>Dibawah ini merupakan contoh pemogramman berbasis objek adalah &hellip;.</p>\r\n', 'Ruby, C++, Java', 'Delphi, C#, VB 6', 'VB 6, Ruby, Java', 'VB 6, VB.Net,Java', 'Delphi, C#, Assembler', 'D'),
(39, 2, '<p>Agar bias melakukan penginstalan dengan menggunakan CD, maka settingan First Bootnya adalah &hellip;.</p>\r\n', 'Hardisk', 'Flashdisk', 'CPU', 'CD Rom', 'VGA', 'D'),
(40, 2, '<p>Sebelum ada sistem operasi orang hanya menggunakan komputer dengan &hellip;.</p>\r\n', 'Signal analog dan signal telepon', 'Signal analog dan signal digital', 'Signal radio dan signal digital', 'Signal GPRS dan signal 3G', 'Signal radio dan signal telepon', 'B'),
(41, 2, '<p>Apa kepanjangan dari GUI....</p>\r\n', 'Graphical User International', 'Graphical User Interface', 'Graphical Unit Interface', 'Graphic User Interface', 'Graphical Unit International', 'B'),
(42, 2, '<p>Kegunaan dari tv tunner adalah &hellip;</p>\r\n', 'Tv Tunner digunakan sebagai alat untuk menerima siaran', 'Tv Tunner digunakan sebagai alat untuk mengirim siaran televise pada komputer', 'Tv Tunner digunakan sebagai alat untuk menerima siaran televise pada komputer', 'Tv Tunner digunakan sebagai alat untuk menerima siaran radio', 'Tv Tunner digunakan sebagai alat untuk mengirim siaran radio', 'C'),
(43, 2, '<p>Program aplikasi multimedia berbasis vector selain CorelDraw adalah &hellip;.</p>\r\n', 'Adobe Ilustrator, Macromedia Freehand, Adobe Photoshop', 'Adobe Ilustrator, Macromedia Freehand, Macromedia Dream Weaver', 'Adobe Ilustrator, Macromedia Freehand, Macromedia Flash', 'Macromedia Flash, Auto Cad, Adobe Photoshop', 'Adobe Ilustrator, Macromedia Freehand, Auto Cad', 'B'),
(44, 2, '<p>Sebuah sistem operasi berbasis linux yang dirancang atau dibuat untuk perangkat selular seperti smartphone dan PC tablet merupakan pengertian dari &hellip;</p>\r\n', 'Blackberry', 'I-pad', 'Android', 'Raspberry', 'Arduino', 'C'),
(45, 2, '<p>Yang merupakan jenis-jenis malware adalah ....</p>\r\n', 'Worm', 'Spyware ', 'Virus komputer', 'Salah Semua', 'A, B dan C Benar', 'E'),
(46, 3, '<p>Suatu bagan dengan simbol-simbol tertentu yang menggambarkan urutan proses secara mendetail dan hubungan antara suatu proses (instruksi) dengan proses lainnya dalam suatu program disebut &hellip;</p>\r\n', 'Flowchart', 'Algoritma ', 'Pseudecode', 'Bahasa pemograman', 'Function', 'B'),
(47, 3, '<p>Sebuah kode yang digunakan untuk menulis sebuah algoritma dengan cara yang bebas yang tidak terikat dengan bahasa pemograman tertentu disebut &hellip;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Flowchart', 'Pseodocode', 'Class', 'Method', 'Object', 'B'),
(48, 2, '<p>Untuk menjaga agar sinyal dan proses support tetap baik dalam jaringan diperlukan &hellip;</p>\r\n', 'Hub', 'UTP ', 'Router', 'RJ 45', 'Repeater', 'E'),
(49, 2, '<p>ISP merupakan &hellip;</p>\r\n', 'Jaringan komputer', 'Strart Up', 'Browser', 'Penyedia jasa internet', 'Sistem Operasi', 'D'),
(50, 2, '<p>Sistem yang bertugas mengatur semua perangkat lunak dan perangkat keras dalam sebuah komputer sehingga dapat digunakan oleh user disebut ....</p>\r\n', 'Sistem Operasi', 'Sistem Komputer', 'Ilmu Komputer', 'Sistem aplikasi', 'Kecerdasan Buatan', 'A'),
(51, 3, '<p>Simbol pada flowchart yang menghasilkan keluaran true dan false adalah &hellip;</p>\r\n', 'Decision', 'Processing', 'Preparation', 'Terminator', 'Oval', 'A'),
(52, 3, '<p>Simbol untuk pelaksanaan suatu bagian (sub-program)/ procedure disebut &hellip;</p>\r\n', 'Preparation', 'Enclousur', 'Predefine Proses', 'Manual Proses', 'Terminator', 'C'),
(53, 3, '<p>Variabel integer memiliki rentangan nilai dari &hellip;</p>\r\n', '-2.147.483.648 sampai 2.147.483.647', '-32.768 sampai 32.767', '3,4 E -38 sampai 3,4 E +38', '1,7 E -308 sampai 1,7 E +308', '2,4 E -98 sampai 2,4 E +88', 'B'),
(54, 3, '<p>Variabel yang berisi nilai alamat suatu lokasi memori tertentu disebut ....</p>\r\n', 'Integer', 'Float', 'Bolean', 'Pointer', 'String', 'D'),
(55, 3, '<p>Apakah maksud dari error message &ldquo;Lvalue require&rdquo; &hellip;</p>\r\n', 'Yang terletak di sebelah kiri operator (==) haruslah berupa ungkapan yang memiliki alamat', 'Yang terletak di sebelah kanan operator (==) haruslah berupa ungkapan yang memiliki alamat', 'Yang terletak di sebelah kanan operator (=) haruslah berupa ungkapan yang memiliki alamat', 'Yang terletak di sebelah kiri operator (=) haruslah berupa ungkapan yang memiliki alamat', 'Yang terletak di sebelah kiri operator (==) haruslah berupa angka', 'D'),
(56, 3, '<p>Apakah maksud dari error message &ldquo;Compound statement missing }&rdquo; &hellip;</p>\r\n', 'Kurang tanda kurung kurawal pembuka pada program', 'Kurang tanda kurung kurawal penutup pada program ', 'Kurang tanda titik koma pada program', 'Kurang tanda titik dua pada program', 'Kurang tanda sama dengan pada program', 'B'),
(57, 3, '<p>Yang merupakan konsep dari Object Oriented Program (OOP) adalah&hellip;</p>\r\n', 'Class', 'Inheritance', 'Enkapsulasi', 'Pewarisan Sifat', 'A, B dan C Benar', 'E'),
(58, 2, '<p>Urutan tahapan pengembangan perangkat lunak yang benar dengan menggunakan metode waterfall adalah &hellip;</p>\r\n', 'Desain, analisa, penulisan kode program,pengujian,maintenance', 'Desain, analisa, pengujian, penulisan kode program, maintenance', 'Analisa, desain, penulisan kode program, pengujian, maintenance', 'Analisa, desain,pengujian, penulisan kode program, maintenance', 'Analisa, pengujian, desain, penulisan kode program, maintenance', 'C'),
(59, 2, '<p>Tujuan dari rekayasa perangkat lunak adalah, kecuali ....</p>\r\n', 'Memperoleh biaya produksi perangkat lunak yang rendah', 'Menghasilkan perangkat lunak yang kinerjanya tinggi, andal dan tepat waktu', 'Mendapatkan perangkat lunak yang dapat bekerja pada satu jenis platform', 'Mendapatkan perangkat lunak yang dapat bekerja pada Berbagai jenis platform', 'Menghasilkan perangkat lunak yang biaya perawatannya rendah', 'C'),
(60, 2, '<p>Hubungan dimana perubahan yang terjadi pada suatu elemen mandiri akan mempengaruhi elemen yang bergantung padanya elem yang tidak mandiri disebut dengan &hellip;</p>\r\n', 'Include', 'Ekstend', 'Dependency', 'Inheriten', 'Association', 'C'),
(61, 2, '<p>Satu kumpulan konversi pemodelan yang digunakan untuk menentukan atau menggambarkan sebuah sistem <em>software </em>yang terkait dengan objek disebut &hellip;</p>\r\n', 'Object Oriented Program', 'Unified Modeling Language', 'Use Case Diagram', 'Algoritma Pemrograman', 'Struktur Data', 'B'),
(62, 2, '<p>DOS interrupt yang bertugas untuk memberhentikan proses komputer terhadap suatu program COM adalah....</p>\r\n', 'Int 21', 'Int 21h', 'Int 20', 'Int 20h', 'Int 22', 'D'),
(63, 3, '<p>1. Intruksi</p>\r\n\r\n<p>2. Proses</p>\r\n\r\n<p>3. Aksi</p>\r\n\r\n<p>Urutkan dasar &ndash; dasar algoritma diatas agar prosesnya menjadi benar:</p>\r\n', '1-2-3', '1-3-2', '2-1-3', '3-1-2', '3-2-1', 'A'),
(64, 3, '<p>Header file yang digunakan untuk proses input output didalam bahasa C++ adalah ....</p>\r\n', 'Stdio', 'Conio', 'Iostream', 'Getche', 'Get', 'C'),
(65, 3, '<p>Terdapat potongan program dibawah ini :</p>\r\n\r\n<p>cout&lt;&lt;&quot;bang&quot;;</p>\r\n\r\n<p>cout&lt;&lt;&quot;ambo&quot;;</p>\r\n\r\n<p>cout&lt;&lt;&quot;university&quot;;</p>\r\n\r\n<p>Maka output dari potongan program diatas adalah...</p>\r\n', 'Bang Ambo University', 'BANG Ambo University', 'Bang ambo university', 'bang ambo university', 'BANG AMBO UNIVERSITY', 'D'),
(66, 3, '<p>Diberikan potongan program dibawah ini :</p>\r\n\r\n<p>a = 5;&nbsp; b = 10 ;</p>\r\n\r\n<p>cout &lt;&lt; &ldquo; a = &ldquo; ;</p>\r\n\r\n<p>a = b &ndash; a * a;</p>\r\n\r\n<p>Apa output dari potongan program diatas :</p>\r\n', 'a=', '-15', '25', '5', 'Error', 'A'),
(67, 3, '<p>1.Hitung nilai C = A + B</p>\r\n\r\n<p>2.Masukkan Nilai A dan B</p>\r\n\r\n<p>3.Tampilkan hasil C</p>\r\n\r\n<p>4.Selesai</p>\r\n\r\n<p>Urutan Algoritma yang benar adalah....</p>\r\n', '1-2-3-4', '3-2-1-4', '2-1-3-4', '2-3-1-4', '3-1-2-4', 'C'),
(68, 3, '<p>Kriteria algoritma kecuali,.....</p>\r\n', 'Ada Output', 'Efektifitas dan Efesiensi', 'Jumlah Langkahnya Berhingga, ', 'Tidak Terstruktur', 'Berakhir', 'D'),
(69, 3, '<p>Perhatikan potongan program dibawah ini</p>\r\n\r\n<p>#include</p>\r\n\r\n<p>void main()</p>\r\n\r\n<p>{</p>\r\n\r\n<p>&nbsp;&nbsp; int A[ 5 ] = { 5 };</p>\r\n\r\n<p>&nbsp;&nbsp; int I;</p>\r\n\r\n<p>&nbsp;&nbsp; for (I=0; I &lt;= 4; I++)</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; printf(&ldquo;%2i&rdquo;, A[I] );</p>\r\n\r\n<p>}</p>\r\n\r\n<p>Output Program tersebut adalah....</p>\r\n', '5 0 0 0 0', '4 0 0 0 0', '3 0 0 0 0', '2 0 0 0 0', '1 0 0 0 0', 'A'),
(70, 3, '<p>Perhatikan potongan program dibawah ini</p>\r\n\r\n<p>Public class Contoh {</p>\r\n\r\n<p>&nbsp;&nbsp; public static void main(String[ ] args) }</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp; char[ ] C = {&lsquo;A&rsquo;, &lsquo;B&rsquo;, &lsquo;C&rsquo; };</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; for(int I=0; I &lt; C.length(); I++) {</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; System.out.print( C[ I ] );</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; }</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; System.out.println(&ldquo;Selesai&rdquo;);</p>\r\n\r\n<p>Output program dibawah ini adalah....</p>\r\n', 'ABCSelesai', 'abcselesai', 'AbcSelesai', 'ABCSELESAI', 'abcSelesai', 'A'),
(71, 3, '<p>Merupakan sekumpulan instruksi yang membentuk&nbsp; satu&nbsp; unit&nbsp; serta&nbsp; memiliki nama ....</p>\r\n', 'Fungsi', 'Class', 'Construktor', 'Destruktor', 'Prosedure', 'A'),
(72, 3, '<p>Kemampuan suatu fungsin untuk memanggil dirinya sendiri ....</p>\r\n', 'Fungsi', 'Rekursi', 'Algoritma', 'Class', 'Prosedure', 'B'),
(73, 3, '<p>Fungsi anggota yang mempunyai nama yang sama dengan nama kelas dan dijalakan secara otomatis saat suatu obyek diciptakan</p>\r\n', 'Class', 'Destruktor', 'Konstruktor', 'Function', 'Main', 'C'),
(74, 3, '<p>Fungsi anggota kelas yang dijalankan secara otomatis pada saat obyek akan sirna&nbsp; atau merupakan kebalikan dari constructor, yaitu berguna untuk menghancurkan atau membuang sebuah objek (kelas) dari memori ....</p>\r\n', 'Function', 'String', 'Array', 'Konstruktor', 'Destruktor', 'E'),
(75, 3, '<p>Fungsi memungkinkan&nbsp; sebuah fungsi dapat menerima bermacammacam tipe dan memberikan nilai balik yang bervariasi pula....</p>\r\n', 'Inheriten', 'Function', 'Overloading', 'Object', 'Class', 'C'),
(76, 3, '<p>Array dua dimensi memiliki dua attribut yaitu</p>\r\n', 'Indek dan Data', 'Baris dan Kolom', 'Baris dan data', 'Data dan kolom', 'String dan data ', 'B'),
(77, 3, '<p>Struktur&nbsp; secara&nbsp; logik&nbsp; membuat&nbsp; suatu tipe&nbsp; data&nbsp; baru(<em>user&nbsp; defined&nbsp; type</em>) yang dapat&nbsp;&nbsp;&nbsp;&nbsp; dipergunakan untuk menampung data/informasi yang bersifat ....</p>\r\n', 'Nyata', 'Abstrak', 'Absolut', 'Tunggal', 'Majemuk', 'E'),
(78, 3, '<p>Variabel yang berisi alamat dari varibel yang mempunyai nilai tertentu....</p>\r\n', 'Varchar', 'Float', 'Integer', 'Pointer', 'String', 'D'),
(79, 3, '<p>Sifat dalam bahasa berorientasi obyek yang memungkinkan sifat-sifat dari suatu kelas diturunkan ke kelas lain....</p>\r\n', 'Inheritance', 'Encapsulation', 'Polimorphism', 'Rekursi', 'Algoritma', 'A'),
(80, 3, '<p>Algoritma diperkenalkan oleh....</p>\r\n', 'Brian W', 'Denis M', 'Rick Mascitti ', 'Abu Ja’far Muhammad Ibnu Musa Al Khawarizmi', 'Ibnu Sina', 'D'),
(81, 3, '<p>File-file yang berisi berbagai deklarasi, seperti fungsi, variabel, dan sebagainya....</p>\r\n', 'int main()', 'main() ', 'void main()', 'Fungsi main', 'File Header', 'E'),
(83, 3, '<p>Perintah #include berfungsi untuk ....</p>\r\n', 'Membaca karakter dengan spasi', 'Membaca karakter tanpa spasi', 'Menghapus layar', 'Penjumlahan Bilangan', 'Membaca Bilangan Berkoma', 'A'),
(84, 1, '<p>1,2,3, ...</p>\r\n', '4', '5', '6', '12', '100', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_peserta`
--

CREATE TABLE `tbl_peserta` (
  `id_peserta` int(11) NOT NULL,
  `id_lab` int(11) NOT NULL,
  `nim` int(11) NOT NULL,
  `password_peserta` varchar(255) NOT NULL,
  `nama_peserta` varchar(255) NOT NULL,
  `ipk` varchar(255) NOT NULL,
  `tmp_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `agama` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `berkas_peserta` text NOT NULL,
  `tgl_selesai_pendaftaran` date NOT NULL,
  `status_pendaftaran` varchar(255) NOT NULL,
  `status_verifikasi` enum('Belum','Lulus','Tidak Lulus') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_peserta`
--

INSERT INTO `tbl_peserta` (`id_peserta`, `id_lab`, `nim`, `password_peserta`, `nama_peserta`, `ipk`, `tmp_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `no_hp`, `email`, `foto`, `berkas_peserta`, `tgl_selesai_pendaftaran`, `status_pendaftaran`, `status_verifikasi`) VALUES
(9, 2, 201746010, '82f340833d3d54de5b6256d6c1c207927f891092a9d673521d31567f9352cfc599e2e37de5eda9bcca8bc244439dfc39c0b3133769d7d64d16278322ba7b6731D+ipPeLCeUqKQuUGFGbEBMSVw26dJx6JQA3+b2EiVs8=', 'BANG AMBO', '3.90', 'LUBUK BASUNG', '1998-06-16', 'Laki-laki', 'Islam', '081278654312', 'bangambo@gmail.com', 'Pas_Photo_3_x_4.jpg', 'CV_Randi_Adrika_Putra.pdf', '2018-11-30', 'Selesai', 'Tidak Lulus'),
(10, 3, 201746002, 'a38fee111366a8eafdad57937544c08f110dcb082af464fed0ce91ce4f547441e5cec63463414633cf8cfec0776c43e339b8c3d115605c131cf546d41509eb61oVU4KNDrNynO05zWJumxRlRG4CGit6MLoubUOfAJZcM=', 'YUNESA PUTRI', '3.99', 'PADANG', '1998-05-11', 'Perempuan', 'Islam', '081243657899', 'nel@gmail.com', 'YUNESA_PUTRI.jpg', 'Surat_Permohonan.pdf', '2018-11-30', 'Selesai', 'Lulus'),
(11, 3, 201746046, '143591d9892b74857d871e898445e42e17c972dc55888ab55019a729b65b90a670394f509b87866431a476d3d37ccf8a5196cf7557844a2588fd230b5ac1f24e8zgoGucFikWdcd6EtZ/b/+0Eo63DFvDgx7XU0kZWLls=', 'RIZKI AGUSTIAN', '3.89', 'PADANG', '1998-06-23', 'Laki-laki', 'Islam', '081278654312', 'adrizal@gmail.com', 'qwq.jpg', 'rizki.pdf', '2018-11-30', 'Selesai', 'Tidak Lulus'),
(12, 6, 201746004, '41ab695c7dc2f094bbb350a70df5ab95ddb541f10333d29007905a4334b36c2fcfc3798e8fbfd725bba62c946f14c09461e784387cf1a08338a871e543a573f6IFCO+nppPaT3rirg5+uTVPt53bAe4EiE8J/w8rxhXk8=', 'TAK SEMUDAH ITU FERGUSO', '3.89', 'JAKARTA', '1999-06-15', 'Laki-laki', 'Islam', '081278654312', 'ferguso@gmail.com', 'ferguso.jpg', 'ferguso.pdf', '2018-11-30', 'Selesai', 'Lulus'),
(13, 2, 201746111, '0ef00e05004da7d97c615953f4d0b3ecaf98646a6368b077474341c7f340569a6e5c2f75012fba366a168bd2b869ee2aa1a34523d2036a218b8e557515c9329459iNn4U0ZzcWO/pveVHbrnqkhL+jjnqTWD4ERVty8A0=', 'ALEX MARQUES', '3.93', 'BANDUNG', '1999-10-26', 'Laki-laki', 'Islam', '081243657890', 'adrizal@gmail.com', 'Alex_Marques.jpg', 'Alex_Marques.pdf', '2018-11-30', 'Selesai', 'Lulus'),
(14, 4, 201746080, 'c445524328fd30f767e97bca9ca8804282204ad821f99fdeb37137fb68c3472274d25ddf7a2a67e91fa712325688826a6c65e6dc3a7fa77b054a70d5987f1bf8xxZLhvEvmOQzP/YU2TnDellJbxhB34CGMaHcA/HhuGQ=', 'GRACIA', '3.55', 'JAKARTA', '1999-06-14', 'Perempuan', 'Islam', '081278654312', 'gracia@gmail.com', 'gracia.jpg', 'gracia.pdf', '2018-11-30', 'Selesai', 'Lulus'),
(15, 7, 201746081, '659549a9f968bf3f58dda75e9b56e24694cf5d1ed8d910e1c25f37f3caf537323bea20aa4b67400f201a490e4dbf0ef960d85a0928e283a706401bdfce73a7c6NX6pdU/9X4gFyle2KD7hd3CdohNWz5k6gMT05aOLECQ=', 'INTAN MANJHA', '3.44', 'PADANG', '1998-08-25', 'Perempuan', 'Islam', '081278654312', 'intan@gmail.com', 'intan.jpg', 'intan.pdf', '2018-11-30', 'Selesai', 'Lulus'),
(16, 5, 201746033, '5e1e9c0cfc02f6277a299e9d500c5b9ca7561121b679267554f8dbb3412e599152018a1916a68dafbc4e340269fb9739c55f9d2964877da77983c4481c4a8e4bSj/Mz4gcuWFKSCI72+58sn8didsjUQBzHPdNl9csRMo=', 'PATRICIA ANATASYA', '3.88', 'JAKARTA', '1999-02-16', 'Perempuan', 'Katolik', '081278654312', 'pinjai@gmail.com', 'patricia.jpg', 'patricia.pdf', '2018-11-30', 'Selesai', 'Lulus'),
(17, 5, 201746021, 'e62d777e12bf5a0369c6c76cef317b87d5c8149fc7ef5ce324104a8c1043c783144c769f139d14844d4727d424d779ccaa4ba63fc7820cbda10d753667c916a66cZ7JPLn9j8yf0i+0UK7B18yeTvlxF/ilLlg5GWO38A=', 'PAULA AJA', '3.97', 'SOLO', '1999-08-10', 'Perempuan', 'Islam', '081243657891', 'paula@gmail.com', 'paula.jpg', 'paula.pdf', '2018-11-30', 'Selesai', 'Lulus'),
(18, 3, 201746014, 'a6f06ce1df436ea88a76f3b5d071a641b4d560074ed1a8df0ff17383fabbecf6ac4e280d09c6192fcea74b7684481a8d0217af8f992ab59ec8fbe36fd46425ef/JpmWMBaAJdPzReiR2gE68jR4Xg1TbXT1cKYWcXVr9E=', 'REMIRES', '3.67', 'LUBUK BASUNG', '1998-04-15', 'Laki-laki', 'Konghucu', '081243657899', 'remires', 'remires.jpg', 'remires.pdf', '2018-11-30', 'Selesai', 'Lulus'),
(21, 4, 201746999, '$argon2i$v=19$m=65536,t=4,p=1$WDNwd0pvL1VISVA5eG00Vg$HANO++Uun5bL5FwAe0ZuJru8A8Fvpt4muaj+87HC0O0', 'ABCDEF', '1.00', 'RUMAH SAKIT', '2021-09-15', 'Perempuan', 'Budha', '0895141459052', 'albertaries18@gmail.com', '1632835762_469ddf95bbf0c13b8f3d.jpg', '1632836512_b6b17a5a646e810e165b.pdf', '2021-09-28', 'Selesai', 'Lulus');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_soal`
--

CREATE TABLE `tbl_soal` (
  `id_soal` int(11) NOT NULL,
  `nama_soal` varchar(255) NOT NULL,
  `jumlah_soal` int(11) NOT NULL,
  `minimal_benar` int(11) NOT NULL,
  `total_nilai` int(11) NOT NULL,
  `passing_grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_soal`
--

INSERT INTO `tbl_soal` (`id_soal`, `nama_soal`, `jumlah_soal`, `minimal_benar`, `total_nilai`, `passing_grade`) VALUES
(1, 'TPA', 20, 14, 100, 70),
(2, 'Pengetahuan Umum', 25, 18, 125, 90),
(3, 'Algoritma Pemograman', 30, 20, 150, 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_informasi`
--
ALTER TABLE `tbl_informasi`
  ADD PRIMARY KEY (`id_informasi`);

--
-- Indexes for table `tbl_jawaban`
--
ALTER TABLE `tbl_jawaban`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `tbl_lab`
--
ALTER TABLE `tbl_lab`
  ADD PRIMARY KEY (`id_lab`);

--
-- Indexes for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `tbl_pertanyaan`
--
ALTER TABLE `tbl_pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`);

--
-- Indexes for table `tbl_peserta`
--
ALTER TABLE `tbl_peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Indexes for table `tbl_soal`
--
ALTER TABLE `tbl_soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_informasi`
--
ALTER TABLE `tbl_informasi`
  MODIFY `id_informasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_jawaban`
--
ALTER TABLE `tbl_jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_lab`
--
ALTER TABLE `tbl_lab`
  MODIFY `id_lab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_pertanyaan`
--
ALTER TABLE `tbl_pertanyaan`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tbl_peserta`
--
ALTER TABLE `tbl_peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_soal`
--
ALTER TABLE `tbl_soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
