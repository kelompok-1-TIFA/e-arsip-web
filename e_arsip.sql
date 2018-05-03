-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2018 at 08:48 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_arsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bagian`
--

CREATE TABLE `tb_bagian` (
  `id_bagian` int(11) NOT NULL,
  `bagian` varchar(40) NOT NULL,
  `kepala_bagian` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bagian`
--

INSERT INTO `tb_bagian` (`id_bagian`, `bagian`, `kepala_bagian`) VALUES
(1, 'Desa', 3),
(2, 'Urusan Tata Usaha dan Umum', 1),
(3, 'Urusan Keuangan', NULL),
(4, 'Urusan Perencanaan', NULL),
(5, 'Seksi Pemerintahan', NULL),
(6, 'Seksi Pelayanan', NULL),
(7, 'Dusun Balung Kopi', NULL),
(8, 'Dusun Sumber Kadut', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_disposisi`
--

CREATE TABLE `tb_disposisi` (
  `id_disposisi` int(10) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `isi_disposisi` mediumtext NOT NULL,
  `sifat` varchar(40) NOT NULL,
  `catatan` text NOT NULL,
  `id_surat_masuk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `jabatan` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`id_jabatan`, `jabatan`) VALUES
(1, 'Kepala Desa'),
(2, 'Sekertaris Desa'),
(3, 'Kaur Tata Usaha dan Umum'),
(4, 'Kaur Keuangan'),
(5, 'Kaur Perencanaan'),
(6, 'Kasi Pemerintahan'),
(7, 'Kasi Kesejahteraan'),
(8, 'Kasi Pelayanan'),
(9, 'Kasun Balung Kopi'),
(10, 'Kasun Sumber Kadut'),
(11, 'Bendahara Desa'),
(12, 'Operator Desa');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_surat`
--

CREATE TABLE `tb_jenis_surat` (
  `id_jenis_surat` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `jenis_surat` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jenis_surat`
--

INSERT INTO `tb_jenis_surat` (`id_jenis_surat`, `kode`, `jenis_surat`) VALUES
(4, '045', 'Kependudukan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `nip` int(20) NOT NULL,
  `id_bagian_pegawai` int(11) NOT NULL,
  `id_jabatan_pegawai` int(11) NOT NULL,
  `niap` varchar(20) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `jenis_kelamin` varchar(40) NOT NULL,
  `tempat_lahir` varchar(40) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `agama` varchar(40) NOT NULL,
  `pangkat` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `pendidikan_terakhir` varchar(10) NOT NULL,
  `sk_pengangkatan` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`nip`, `id_bagian_pegawai`, `id_jabatan_pegawai`, `niap`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `agama`, `pangkat`, `alamat`, `no_hp`, `pendidikan_terakhir`, `sk_pengangkatan`, `foto`) VALUES
(1, 1, 1, '', 'SAMSUL', 'Laki - Laki', 'Jember', '1967-08-03', 'Islam', '', '', '', 'SMA', '188.45/297/KTUN/021/2013\r\n20 Juni 2013', ''),
(2, 1, 2, '', 'CANDRA NUR CAHYONO', 'Laki - Laki', 'Jember', '1987-03-25', 'Islam', '', '', '', 'D. III', '140/24/35.09.10.2006/SK/2017\r\n26 Mei 2017', ''),
(3, 2, 3, '', 'SALLAHUDIN AL AYUBI ARIEF', 'Laki - Laki', 'Jember', '1993-08-10', 'Islam', '', '', '', 'SMA', '140/25/35.09.10.2006/SK/2017\r\n26 Mei 2017', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_keluar`
--

CREATE TABLE `tb_surat_keluar` (
  `id_surat_keluar` int(11) NOT NULL,
  `no_surat` varchar(20) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `tujuan` varchar(40) NOT NULL,
  `isi_singkat` mediumtext NOT NULL,
  `id_jenis_surat` int(11) NOT NULL,
  `perihal` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_arsip` date NOT NULL,
  `keterangan` text NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_masuk`
--

CREATE TABLE `tb_surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL,
  `no_surat` varchar(20) NOT NULL,
  `asal_surat` varchar(40) NOT NULL,
  `isi_singkat` mediumtext NOT NULL,
  `id_jenis_surat` int(11) NOT NULL,
  `perihal` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_arsip` date NOT NULL,
  `keterangan` text NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nip` int(20) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(150) NOT NULL,
  `level_user` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nip`, `username`, `password`, `level_user`) VALUES
(1, 2, 'admin', 'awGxgALpdOP4ZAOdqLE5PQ9N1JgAfn/XZhPeCQcgWsykNxPUs9gqqi8vtEyvD8UwnXsMUvTD6yEzRt2MsHbMHw==', 'Sekertaris Desa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bagian`
--
ALTER TABLE `tb_bagian`
  ADD PRIMARY KEY (`id_bagian`),
  ADD KEY `kepala_bagian` (`kepala_bagian`);

--
-- Indexes for table `tb_disposisi`
--
ALTER TABLE `tb_disposisi`
  ADD PRIMARY KEY (`id_disposisi`),
  ADD KEY `id_bagian` (`id_bagian`),
  ADD KEY `nip` (`nip`),
  ADD KEY `id_surat_masuk` (`id_surat_masuk`);

--
-- Indexes for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `tb_jenis_surat`
--
ALTER TABLE `tb_jenis_surat`
  ADD PRIMARY KEY (`id_jenis_surat`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_bagian` (`id_bagian_pegawai`),
  ADD KEY `id_jabatan` (`id_jabatan_pegawai`);

--
-- Indexes for table `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  ADD PRIMARY KEY (`id_surat_keluar`),
  ADD KEY `id_jenis_surat` (`id_jenis_surat`),
  ADD KEY `id_bagian` (`id_bagian`);

--
-- Indexes for table `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  ADD PRIMARY KEY (`id_surat_masuk`),
  ADD KEY `id_jenis_surat` (`id_jenis_surat`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `nip` (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bagian`
--
ALTER TABLE `tb_bagian`
  MODIFY `id_bagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tb_disposisi`
--
ALTER TABLE `tb_disposisi`
  MODIFY `id_disposisi` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tb_jenis_surat`
--
ALTER TABLE `tb_jenis_surat`
  MODIFY `id_jenis_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  MODIFY `id_surat_keluar` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  MODIFY `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_disposisi`
--
ALTER TABLE `tb_disposisi`
  ADD CONSTRAINT `tb_disposisi_ibfk_1` FOREIGN KEY (`id_bagian`) REFERENCES `tb_bagian` (`id_bagian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_disposisi_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `tb_pegawai` (`nip`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_disposisi_ibfk_3` FOREIGN KEY (`id_surat_masuk`) REFERENCES `tb_surat_masuk` (`id_surat_masuk`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD CONSTRAINT `tb_pegawai_ibfk_1` FOREIGN KEY (`id_jabatan_pegawai`) REFERENCES `tb_jabatan` (`id_jabatan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pegawai_ibfk_2` FOREIGN KEY (`id_bagian_pegawai`) REFERENCES `tb_bagian` (`id_bagian`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  ADD CONSTRAINT `tb_surat_keluar_ibfk_1` FOREIGN KEY (`id_bagian`) REFERENCES `tb_bagian` (`id_bagian`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_surat_keluar_ibfk_2` FOREIGN KEY (`id_jenis_surat`) REFERENCES `tb_jenis_surat` (`id_jenis_surat`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  ADD CONSTRAINT `tb_surat_masuk_ibfk_1` FOREIGN KEY (`id_jenis_surat`) REFERENCES `tb_jenis_surat` (`id_jenis_surat`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `tb_pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
