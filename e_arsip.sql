-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2018 at 07:29 PM
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

DROP TABLE IF EXISTS `tb_bagian`;
CREATE TABLE `tb_bagian` (
  `id_bagian` int(11) NOT NULL,
  `bagian` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bagian`
--

INSERT INTO `tb_bagian` (`id_bagian`, `bagian`) VALUES
(1, 'Desa'),
(2, 'Urusan Tata Usaha dan Umum'),
(3, 'Urusan Keuangan'),
(4, 'Urusan Perencanaan'),
(5, 'Seksi Pemerintahan'),
(6, 'Seksi Pelayanan'),
(7, 'Dusun Balung Kopi'),
(8, 'Dusun Sumber Kadut');

-- --------------------------------------------------------

--
-- Table structure for table `tb_disposisi`
--

DROP TABLE IF EXISTS `tb_disposisi`;
CREATE TABLE `tb_disposisi` (
  `id_disposisi` int(10) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `isi_disposisi` mediumtext NOT NULL,
  `sifat` varchar(40) NOT NULL,
  `catatan` text NOT NULL,
  `id_surat_masuk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `tb_disposisi`
--
DROP TRIGGER IF EXISTS `mendisposisikan`;
DELIMITER $$
CREATE TRIGGER `mendisposisikan` AFTER INSERT ON `tb_disposisi` FOR EACH ROW BEGIN
 UPDATE tb_surat_masuk
 SET status_disposisi = 'y'
 WHERE
 id_surat_masuk = NEW.id_surat_masuk;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jabatan`
--

DROP TABLE IF EXISTS `tb_jabatan`;
CREATE TABLE `tb_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `jabatan` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`id_jabatan`, `jabatan`) VALUES
(1, 'Kepala'),
(2, 'Sekertaris'),
(11, 'Bendahara'),
(12, 'Operator'),
(13, 'Staf'),
(14, 'Kaur'),
(15, 'Kasi'),
(16, 'Kasun');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_surat`
--

DROP TABLE IF EXISTS `tb_jenis_surat`;
CREATE TABLE `tb_jenis_surat` (
  `id_jenis_surat` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `jenis_surat` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jenis_surat`
--

INSERT INTO `tb_jenis_surat` (`id_jenis_surat`, `kode`, `jenis_surat`) VALUES
(1, '475', 'Surat Kematian'),
(2, '475', 'Surat Kelahiran'),
(3, '510', 'Surat Keterangan Usaha'),
(4, '470', 'Surat Penduduk');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notifikasi`
--

DROP TABLE IF EXISTS `tb_notifikasi`;
CREATE TABLE `tb_notifikasi` (
  `id_notif` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `jenis_notif` varchar(15) NOT NULL,
  `judul_notif` varchar(40) NOT NULL,
  `isi_notif` text NOT NULL,
  `status_baca` set('y','t') NOT NULL DEFAULT 't',
  `status_notif` set('y','t') NOT NULL DEFAULT 't'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_notifikasi`
--

INSERT INTO `tb_notifikasi` (`id_notif`, `id_user`, `id`, `jenis_notif`, `judul_notif`, `isi_notif`, `status_baca`, `status_notif`) VALUES
(1, 4, 15, 'surat masuk', 'Surat Masuk Baru ', 'No. Surat 5448957498512121 Perihal bfbfbfbnjdkvkd vdvdvdvbdvbdjkv j dvjdvdvjdvb jk kjdvdjvbdjkvbjkdbvjd vjdkvdnvdjvndvdjv dvjdvjdbjvkdk vdjvjdvjdv vndjkvjdvkdvdv dvndjvbfbfb', 't', 't'),
(2, 3, 15, 'surat masuk', 'Surat Masuk Baru ', 'No. Surat 5448957498512121 Perihal bfbfbfbnjdkvkd vdvdvdvbdvbdjkv j dvjdvdvjdvb jk kjdvdjvbdjkvbjkdbvjd vjdkvdnvdjvndvdjv dvjdvjdbjvkdk vdjvjdvjdv vndjkvjdvkdvdv dvndjvbfbfb', 't', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

DROP TABLE IF EXISTS `tb_pegawai`;
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
  `foto` text NOT NULL,
  `create_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`nip`, `id_bagian_pegawai`, `id_jabatan_pegawai`, `niap`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `agama`, `pangkat`, `alamat`, `no_hp`, `pendidikan_terakhir`, `sk_pengangkatan`, `foto`, `create_on`) VALUES
(535435, 1, 1, '5353535', 'Kepala Desa', 'Laki - Laki', 'dvdvdv', '2018-05-09', 'vdvd', 'vdvdv', 'dvdvdv', 'dvdvdv', 'vdvd', 'vdvdv', 'assets/uploads/foto_user/Picture3.png', '2018-05-09 09:10:54'),
(2353257, 1, 12, '53572', 'admin', 'Laki - Laki', 'Bnayuwangi', '1997-12-25', 'Islam', 'fbfbfbfb', 'vdvdv', '081556780810', 'dvdvdv', 'dvdvd', 'assets/uploads/foto_user/Picture1.png', '2018-05-09 09:09:14'),
(4545435, 1, 2, '235252', 'Sekertaris Des', 'Laki - Laki', 'dvdvdvd', '2018-05-09', 'dvdvd', 'dvdv', 'dvdvdv', 'dvdvdv', 'dvdvd', 'vdv', 'assets/uploads/foto_user/Picture31.png', '2018-05-09 09:13:05'),
(324297939, 6, 13, '343420', 'Staf', 'Perempuan', 'dvvdvdv', '2018-05-09', 'vdvdv', 'dvdv', 'dvdvd', '52525', 'vdvdvd', 'vdvd', 'assets/uploads/foto_user/632075.jpg', '2018-05-09 09:22:46'),
(2147483647, 5, 15, '5435435353', 'Kepala Bagian', 'Laki - Laki', 'fbfdsvvs', '2018-05-09', 'dvdsvsd', 'vdsvsdvs', 'vdvdv', 'dvdvdvd', 'vdvdv', 'dvdv1', 'assets/uploads/foto_user/Picture2.png', '2018-05-16 11:47:52');

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_keluar`
--

DROP TABLE IF EXISTS `tb_surat_keluar`;
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

--
-- Dumping data for table `tb_surat_keluar`
--

INSERT INTO `tb_surat_keluar` (`id_surat_keluar`, `no_surat`, `id_bagian`, `tujuan`, `isi_singkat`, `id_jenis_surat`, `perihal`, `tgl_surat`, `tgl_arsip`, `keterangan`, `file`) VALUES
(1, '0876/0654', 5, 'Dinas Perpajakan', '-', 4, '-', '2018-05-01', '2018-05-14', '-', 'assets/uploads/file/Surat%20Penduduk/bkp.jpg'),
(2, '0987/6543', 2, 'Dinas Koperasi dan Usaha', '-', 3, '-', '2018-04-30', '2018-05-14', '-', 'assets/uploads/file/Surat%20Keterangan%20Usaha/putu.jpg'),
(3, '876/897', 6, 'Semua Warga', '-', 4, '-', '2018-05-03', '2018-05-14', '-', 'assets/uploads/file/Surat%20Penduduk/don.jpg'),
(4, '9087/564', 4, 'Ketua RT/RW', '-', 4, '-', '2018-04-29', '2018-05-14', '-', 'assets/uploads/file/Surat%20Penduduk/bolcok.jpg'),
(5, '0875/9087', 8, 'Pengembangan SDM', '-', 4, '-', '2018-05-02', '2018-05-14', '-', 'assets/uploads/file/Surat%20Penduduk/piscok.jpg'),
(6, '0097/0065', 3, 'Kantor Pajak', '-', 3, '-', '2018-04-29', '2018-05-14', '-', 'assets/uploads/file/Surat%20Keterangan%20Usaha/piscok.jpg'),
(7, '0098/007', 5, 'Kantor Kecamatan Balung', 'Undangan Rapat ', 4, '-', '2018-05-04', '2018-05-14', '-', 'assets/uploads/file/Surat%20Penduduk/3586426677.png'),
(8, '0098/0076', 2, 'Dinas Koperasi', '-', 3, '-', '2018-05-01', '2018-05-14', '-', 'assets/uploads/file/Surat%20Keterangan%20Usaha/piscok1.jpg'),
(9, '0087/0065', 6, 'Ketua RT', '-', 4, '-', '2018-05-03', '2018-05-14', '-', 'assets/uploads/file/Surat%20Penduduk/putu3.jpg'),
(10, '0098/0876', 4, 'Ketua RT/RW', '-', 4, '-', '2018-05-04', '2018-05-14', '-', 'assets/uploads/file/Surat%20Penduduk/bolkel.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_masuk`
--

DROP TABLE IF EXISTS `tb_surat_masuk`;
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
  `status_disposisi` set('y','t') NOT NULL DEFAULT 't',
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_surat_masuk`
--

INSERT INTO `tb_surat_masuk` (`id_surat_masuk`, `no_surat`, `asal_surat`, `isi_singkat`, `id_jenis_surat`, `perihal`, `tgl_surat`, `tgl_arsip`, `keterangan`, `status_disposisi`, `file`) VALUES
(1, '019/9900', 'Dinas Koperasi', 'pembangunan usaha dalam desa', 3, '-', '2018-05-09', '2018-05-12', '-', 't', './assets/uploads/file/Surat%20Keterangan%20Usaha/acar.jpg'),
(2, '0991/098', 'Dinas Kependudukan', 'Peraturan baru pembangunan SDM di desa se Jember', 4, '-', '2018-05-18', '2018-05-14', '-', 't', './assets/uploads/file/Surat%20Penduduk/lv.jpg'),
(3, '0987/1290', 'Dinas Koperasi dan Usaha', 'Pelatihan pengelolah KUD', 3, '-', '2018-03-08', '2018-05-14', '-', 't', './assets/uploads/file/Surat%20Keterangan%20Usaha/kahrtunnn.jpg'),
(4, '098/09876', 'Dinas Sosial', 'undangan rapat rutin', 4, '-', '2018-05-01', '2018-05-14', '-', 't', './assets/uploads/file/Surat%20Penduduk/cmd_java.PNG'),
(5, '0987/6754', 'Dinas Pendidikan', 'Pengembangan SDM', 4, '-', '2018-05-02', '2018-05-14', '-', 't', './assets/uploads/file/Surat%20Penduduk/bolcok1.jpg'),
(6, '00988/0087', 'Dinas Kependudukan', 'rapat rutin', 4, '-', '2018-05-02', '2018-05-14', '-', 't', './assets/uploads/file/Surat%20Penduduk/bkp1.jpg'),
(7, '0089/0067', 'Dinas Sosial', 'Rapat Triwuan ', 4, '-', '2018-05-05', '2018-05-14', '-', 't', './assets/uploads/file/Surat%20Penduduk/putu.jpg'),
(8, '0098/00876', 'Kantor Desa Taman Sari', 'Silaturahmi ', 4, '-', '2018-05-04', '2018-05-14', '-', 't', './assets/uploads/file/Surat%20Penduduk/piscok1.jpg'),
(9, '0087/0087', 'Kantor Kecamatan Balung', 'Permintaan data penduduk', 4, '-', '2018-05-02', '2018-05-14', '-', 't', './assets/uploads/file/Surat%20Penduduk/putu1.jpg'),
(10, '00998/0098', 'Kantor Kecamatan Balung', 'Pendataan keterangan usaha', 3, '-', '2018-05-01', '2018-05-14', '-', 't', './assets/uploads/file/Surat%20Keterangan%20Usaha/bkp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nip_user` int(20) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(150) NOT NULL,
  `level_user` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nip_user`, `username`, `password`, `level_user`) VALUES
(2, 2353257, 'admin', '63weMGrln+7LbwO8Skhb200a3AWC5+YDaO73/mfoSA42xz173PRUD7rzqgK3zRUYBUREjg5fZK+ntVFN8t0YNQ==', 'admin'),
(3, 535435, 'kepaladesa', 'pL4ND4+At8DXwWIBIY97nFXfN0lvlVVjhCa83VyRbpADScH7ivadNJGWw9fdyfbji0J+t8v64FJ7S6qdDS95Uw==', 'kepala desa'),
(4, 2147483647, 'kepalabagian', 'VSfAZ4fJKhl3dQec7vcgiTJc5+h3VFZx/ywGZUp5awSWe1PaJtGVuwbGeSk9XNnENZXYyrgDv4g6EpRhajCigA==', 'kepala bagian'),
(5, 4545435, 'sekertaris', 'OXMRD2cPqaqlSpfqOEwYAxOY00AG2Hlf0s0mk49CjqupNEaN65XmlxkHc39p3suEzLGBF3GFLRqp00snrPap/g==', 'sekertaris'),
(6, 324297939, 'staf', 'GyQ/Yy7dBvOQV1ItRfeC1T0WWF+bOqp2q3yELhjR2oGLu7qNCVXP6+doZuwH2VHqQbJs3c9bA7M5FfCC2QaYvQ==', 'staf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bagian`
--
ALTER TABLE `tb_bagian`
  ADD PRIMARY KEY (`id_bagian`);

--
-- Indexes for table `tb_disposisi`
--
ALTER TABLE `tb_disposisi`
  ADD PRIMARY KEY (`id_disposisi`),
  ADD KEY `id_bagian` (`id_bagian`),
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
-- Indexes for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  ADD PRIMARY KEY (`id_notif`);

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
  ADD KEY `nip` (`nip_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bagian`
--
ALTER TABLE `tb_bagian`
  MODIFY `id_bagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_disposisi`
--
ALTER TABLE `tb_disposisi`
  MODIFY `id_disposisi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tb_jenis_surat`
--
ALTER TABLE `tb_jenis_surat`
  MODIFY `id_jenis_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  MODIFY `id_surat_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  MODIFY `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_disposisi`
--
ALTER TABLE `tb_disposisi`
  ADD CONSTRAINT `tb_disposisi_ibfk_1` FOREIGN KEY (`id_bagian`) REFERENCES `tb_bagian` (`id_bagian`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_disposisi_ibfk_2` FOREIGN KEY (`id_surat_masuk`) REFERENCES `tb_surat_masuk` (`id_surat_masuk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD CONSTRAINT `tb_pegawai_ibfk_1` FOREIGN KEY (`id_jabatan_pegawai`) REFERENCES `tb_jabatan` (`id_jabatan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pegawai_ibfk_2` FOREIGN KEY (`id_bagian_pegawai`) REFERENCES `tb_bagian` (`id_bagian`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  ADD CONSTRAINT `tb_surat_keluar_ibfk_1` FOREIGN KEY (`id_bagian`) REFERENCES `tb_bagian` (`id_bagian`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_surat_keluar_ibfk_2` FOREIGN KEY (`id_jenis_surat`) REFERENCES `tb_jenis_surat` (`id_jenis_surat`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  ADD CONSTRAINT `tb_surat_masuk_ibfk_1` FOREIGN KEY (`id_jenis_surat`) REFERENCES `tb_jenis_surat` (`id_jenis_surat`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`nip_user`) REFERENCES `tb_pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
