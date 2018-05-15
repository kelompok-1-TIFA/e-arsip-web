-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Bulan Mei 2018 pada 03.37
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Struktur dari tabel `tb_bagian`
--

DROP TABLE IF EXISTS `tb_bagian`;
CREATE TABLE IF NOT EXISTS `tb_bagian` (
  `id_bagian` int(11) NOT NULL AUTO_INCREMENT,
  `bagian` varchar(40) NOT NULL,
  PRIMARY KEY (`id_bagian`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bagian`
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
-- Struktur dari tabel `tb_disposisi`
--

DROP TABLE IF EXISTS `tb_disposisi`;
CREATE TABLE IF NOT EXISTS `tb_disposisi` (
  `id_disposisi` int(10) NOT NULL AUTO_INCREMENT,
  `id_bagian` int(11) NOT NULL,
  `isi_disposisi` mediumtext NOT NULL,
  `sifat` varchar(40) NOT NULL,
  `catatan` text NOT NULL,
  `id_surat_masuk` int(11) NOT NULL,
  PRIMARY KEY (`id_disposisi`),
  KEY `id_bagian` (`id_bagian`),
  KEY `id_surat_masuk` (`id_surat_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `tb_disposisi`
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
-- Struktur dari tabel `tb_jabatan`
--

DROP TABLE IF EXISTS `tb_jabatan`;
CREATE TABLE IF NOT EXISTS `tb_jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(40) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jabatan`
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
(12, 'Operator Desa'),
(13, 'Staf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis_surat`
--

DROP TABLE IF EXISTS `tb_jenis_surat`;
CREATE TABLE IF NOT EXISTS `tb_jenis_surat` (
  `id_jenis_surat` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `jenis_surat` varchar(40) NOT NULL,
  PRIMARY KEY (`id_jenis_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jenis_surat`
--

INSERT INTO `tb_jenis_surat` (`id_jenis_surat`, `kode`, `jenis_surat`) VALUES
(1, '475', 'Surat Kematian'),
(2, '475', 'Surat Kelahiran'),
(3, '510', 'Surat Keterangan Usaha'),
(4, '470', 'Surat Penduduk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pegawai`
--

DROP TABLE IF EXISTS `tb_pegawai`;
CREATE TABLE IF NOT EXISTS `tb_pegawai` (
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
  `create_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`nip`),
  KEY `id_bagian` (`id_bagian_pegawai`),
  KEY `id_jabatan` (`id_jabatan_pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`nip`, `id_bagian_pegawai`, `id_jabatan_pegawai`, `niap`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `agama`, `pangkat`, `alamat`, `no_hp`, `pendidikan_terakhir`, `sk_pengangkatan`, `foto`, `create_on`) VALUES
(535435, 1, 1, '5353535', 'Kepala Desa', 'Laki - Laki', 'dvdvdv', '2018-05-09', 'vdvd', 'vdvdv', 'dvdvdv', 'dvdvdv', 'vdvd', 'vdvdv', 'assets/uploads/foto_user/Picture3.png', '2018-05-09 09:10:54'),
(2353257, 1, 12, '53572', 'admin', 'Laki - Laki', 'Bnayuwangi', '1997-12-25', 'Islam', 'fbfbfbfb', 'vdvdv', '081556780810', 'dvdvdv', 'dvdvd', 'assets/uploads/foto_user/Picture1.png', '2018-05-09 09:09:14'),
(4545435, 1, 2, '235252', 'Sekertaris Des', 'Laki - Laki', 'dvdvdvd', '2018-05-09', 'dvdvd', 'dvdv', 'dvdvdv', 'dvdvdv', 'dvdvd', 'vdv', 'assets/uploads/foto_user/Picture31.png', '2018-05-09 09:13:05'),
(324297939, 6, 13, '343420', 'Staf', 'Perempuan', 'dvvdvdv', '2018-05-09', 'vdvdv', 'dvdv', 'dvdvd', '52525', 'vdvdvd', 'vdvd', 'assets/uploads/foto_user/632075.jpg', '2018-05-09 09:22:46'),
(2147483647, 5, 6, '5435435353', 'Kepala Bagian', 'Laki - Laki', 'fbfdsvvs', '2018-05-09', 'dvdsvsd', 'vdsvsdvs', 'vdvdv', 'dvdvdvd', 'vdvdv', 'dvdv', 'assets/uploads/foto_user/Picture2.png', '2018-05-09 09:11:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_surat_keluar`
--

DROP TABLE IF EXISTS `tb_surat_keluar`;
CREATE TABLE IF NOT EXISTS `tb_surat_keluar` (
  `id_surat_keluar` int(11) NOT NULL AUTO_INCREMENT,
  `no_surat` varchar(20) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `tujuan` varchar(40) NOT NULL,
  `isi_singkat` mediumtext NOT NULL,
  `id_jenis_surat` int(11) NOT NULL,
  `perihal` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_arsip` date NOT NULL,
  `keterangan` text NOT NULL,
  `file` text NOT NULL,
  PRIMARY KEY (`id_surat_keluar`),
  KEY `id_jenis_surat` (`id_jenis_surat`),
  KEY `id_bagian` (`id_bagian`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_surat_keluar`
--

INSERT INTO `tb_surat_keluar` (`id_surat_keluar`, `no_surat`, `id_bagian`, `tujuan`, `isi_singkat`, `id_jenis_surat`, `perihal`, `tgl_surat`, `tgl_arsip`, `keterangan`, `file`) VALUES
(1, '0876/0654', 5, 'Dinas Perpajakan', '-', 4, '-', '2018-05-01', '2018-05-14', '-', './assets/uploads/file/Surat Penduduk/bkp.jpg'),
(2, '0987/6543', 2, 'Dinas Koperasi dan Usaha', '-', 3, '-', '2018-04-30', '2018-05-14', '-', './assets/uploads/file/Surat Keterangan Usaha/putu.jpg'),
(3, '876/897', 6, 'Semua Warga', '-', 4, '-', '2018-05-03', '2018-05-14', '-', './assets/uploads/file/Surat Penduduk/don.jpg'),
(4, '9087/564', 4, 'Ketua RT/RW', '-', 4, '-', '2018-04-29', '2018-05-14', '-', './assets/uploads/file/Surat Penduduk/bolcok.jpg'),
(5, '0875/9087', 8, 'Pengembangan SDM', '-', 4, '-', '2018-05-02', '2018-05-14', '-', './assets/uploads/file/Surat Penduduk/piscok.jpg'),
(6, '0097/0065', 3, 'Kantor Pajak', '-', 3, '-', '2018-04-29', '2018-05-14', '-', './assets/uploads/file/Surat Keterangan Usaha/piscok.jpg'),
(7, '0098/007', 5, 'Kantor Kecamatan Balung', 'Undangan Rapat ', 4, '-', '2018-05-04', '2018-05-14', '-', './assets/uploads/file/Surat Penduduk/putu2.jpg'),
(8, '0098/0076', 2, 'Dinas Koperasi', '-', 3, '-', '2018-05-01', '2018-05-14', '-', './assets/uploads/file/Surat Keterangan Usaha/piscok1.jpg'),
(9, '0087/0065', 6, 'Ketua RT', '-', 4, '-', '2018-05-03', '2018-05-14', '-', './assets/uploads/file/Surat Penduduk/putu3.jpg'),
(10, '0098/0876', 4, 'Ketua RT/RW', '-', 4, '-', '2018-05-04', '2018-05-14', '-', './assets/uploads/file/Surat Penduduk/bolkel.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_surat_masuk`
--

DROP TABLE IF EXISTS `tb_surat_masuk`;
CREATE TABLE IF NOT EXISTS `tb_surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `no_surat` varchar(20) NOT NULL,
  `asal_surat` varchar(40) NOT NULL,
  `isi_singkat` mediumtext NOT NULL,
  `id_jenis_surat` int(11) NOT NULL,
  `perihal` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_arsip` date NOT NULL,
  `keterangan` text NOT NULL,
  `status_disposisi` set('y','t') NOT NULL DEFAULT 't',
  `file` text NOT NULL,
  PRIMARY KEY (`id_surat_masuk`),
  KEY `id_jenis_surat` (`id_jenis_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_surat_masuk`
--

INSERT INTO `tb_surat_masuk` (`id_surat_masuk`, `no_surat`, `asal_surat`, `isi_singkat`, `id_jenis_surat`, `perihal`, `tgl_surat`, `tgl_arsip`, `keterangan`, `status_disposisi`, `file`) VALUES
(1, '019/9900', 'Dinas Koperasi', 'pembangunan usaha dalam desa', 3, '-', '2018-05-09', '2018-05-12', '-', 't', './assets/uploads/file/Surat Keterangan Usaha/acar.jpg'),
(2, '0991/098', 'Dinas Kependudukan', 'Peraturan baru pembangunan SDM di desa se Jember', 4, '-', '2018-05-18', '2018-05-14', '-', 't', './assets/uploads/file/Surat Penduduk/lv.jpg'),
(3, '0987/1290', 'Dinas Koperasi dan Usaha', 'Pelatihan pengelolah KUD', 3, '-', '2018-03-08', '2018-05-14', '-', 't', './assets/uploads/file/Surat Keterangan Usaha/kahrtunnn.jpg'),
(4, '098/09876', 'Dinas Sosial', 'undangan rapat rutin', 4, '-', '2018-05-01', '2018-05-14', '-', 't', './assets/uploads/file/Surat Penduduk/cmd_java.PNG'),
(5, '0987/6754', 'Dinas Pendidikan', 'Pengembangan SDM', 4, '-', '2018-05-02', '2018-05-14', '-', 't', './assets/uploads/file/Surat Penduduk/bolcok1.jpg'),
(6, '00988/0087', 'Dinas Kependudukan', 'rapat rutin', 4, '-', '2018-05-02', '2018-05-14', '-', 't', './assets/uploads/file/Surat Penduduk/bkp1.jpg'),
(7, '0089/0067', 'Dinas Sosial', 'Rapat Triwuan ', 4, '-', '2018-05-05', '2018-05-14', '-', 't', './assets/uploads/file/Surat Penduduk/putu.jpg'),
(8, '0098/00876', 'Kantor Desa Taman Sari', 'Silaturahmi ', 4, '-', '2018-05-04', '2018-05-14', '-', 't', './assets/uploads/file/Surat Penduduk/piscok1.jpg'),
(9, '0087/0087', 'Kantor Kecamatan Balung', 'Permintaan data penduduk', 4, '-', '2018-05-02', '2018-05-14', '-', 't', './assets/uploads/file/Surat Penduduk/putu1.jpg'),
(10, '00998/0098', 'Kantor Kecamatan Balung', 'Pendataan keterangan usaha', 3, '-', '2018-05-01', '2018-05-14', '-', 't', './assets/uploads/file/Surat Keterangan Usaha/bkp.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nip_user` int(20) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(150) NOT NULL,
  `level_user` varchar(40) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `nip` (`nip_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nip_user`, `username`, `password`, `level_user`) VALUES
(2, 2353257, 'admin', '63weMGrln+7LbwO8Skhb200a3AWC5+YDaO73/mfoSA42xz173PRUD7rzqgK3zRUYBUREjg5fZK+ntVFN8t0YNQ==', 'admin'),
(3, 535435, 'kepaladesa', 'pL4ND4+At8DXwWIBIY97nFXfN0lvlVVjhCa83VyRbpADScH7ivadNJGWw9fdyfbji0J+t8v64FJ7S6qdDS95Uw==', 'kepala desa'),
(4, 2147483647, 'kepalabagian', '41VtU4w7Ac8wpcpak18MLGwdTgvaeLSxdl4M0kgupa4ObFJDc2RaRI8TKKwPFvE84McnaJlDLb2CEa0Meje7DA==', 'kepala bagian'),
(5, 4545435, 'sekertaris', 'OXMRD2cPqaqlSpfqOEwYAxOY00AG2Hlf0s0mk49CjqupNEaN65XmlxkHc39p3suEzLGBF3GFLRqp00snrPap/g==', 'sekertaris'),
(6, 324297939, 'staf', 'GyQ/Yy7dBvOQV1ItRfeC1T0WWF+bOqp2q3yELhjR2oGLu7qNCVXP6+doZuwH2VHqQbJs3c9bA7M5FfCC2QaYvQ==', 'staf');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_disposisi`
--
ALTER TABLE `tb_disposisi`
  ADD CONSTRAINT `tb_disposisi_ibfk_1` FOREIGN KEY (`id_bagian`) REFERENCES `tb_bagian` (`id_bagian`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_disposisi_ibfk_2` FOREIGN KEY (`id_surat_masuk`) REFERENCES `tb_surat_masuk` (`id_surat_masuk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD CONSTRAINT `tb_pegawai_ibfk_1` FOREIGN KEY (`id_jabatan_pegawai`) REFERENCES `tb_jabatan` (`id_jabatan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pegawai_ibfk_2` FOREIGN KEY (`id_bagian_pegawai`) REFERENCES `tb_bagian` (`id_bagian`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  ADD CONSTRAINT `tb_surat_keluar_ibfk_1` FOREIGN KEY (`id_bagian`) REFERENCES `tb_bagian` (`id_bagian`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_surat_keluar_ibfk_2` FOREIGN KEY (`id_jenis_surat`) REFERENCES `tb_jenis_surat` (`id_jenis_surat`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  ADD CONSTRAINT `tb_surat_masuk_ibfk_1` FOREIGN KEY (`id_jenis_surat`) REFERENCES `tb_jenis_surat` (`id_jenis_surat`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`nip_user`) REFERENCES `tb_pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
