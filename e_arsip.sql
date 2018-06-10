-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 06, 2018 at 01:29 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id5583665_e_arsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bagian`
--

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
(8, 'Dusun Sumber Kadut'),
(9, 'Seksi Kesejahteraan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_disposisi`
--

CREATE TABLE `tb_disposisi` (
  `id_disposisi` int(10) NOT NULL,
  `id_bagian` int(11) DEFAULT NULL,
  `isi_disposisi` mediumtext NOT NULL,
  `sifat` varchar(40) NOT NULL,
  `catatan` text NOT NULL,
  `id_surat_masuk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_disposisi`
--

INSERT INTO `tb_disposisi` (`id_disposisi`, `id_bagian`, `isi_disposisi`, `sifat`, `catatan`, `id_surat_masuk`) VALUES
(20, 5, 'TINJAU KEMBALI', 'Segera', '-', 10),
(21, 6, 'TINDAK LANJUTI', 'Penting', 'SECEPATNYA YA', 9),
(22, 9, 'Kedatangan', 'Penting', 'Secepatnya', 7),
(29, 5, 'Simpan saja', 'Rahasia', 'bertemu saya di meja saya jam 2 siang', 4);

--
-- Triggers `tb_disposisi`
--
DELIMITER $$
CREATE TRIGGER `hapus disposisi` AFTER DELETE ON `tb_disposisi` FOR EACH ROW BEGIN
 UPDATE tb_surat_masuk
 SET status_disposisi = 't'
 WHERE
 id_surat_masuk = OLD.id_surat_masuk;
 END
$$
DELIMITER ;
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

CREATE TABLE `tb_jenis_surat` (
  `id_jenis_surat` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `jenis_surat` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jenis_surat`
--

INSERT INTO `tb_jenis_surat` (`id_jenis_surat`, `kode`, `jenis_surat`) VALUES
(1, '476', 'Surat Kematian'),
(2, '475', 'Surat Kelahiran'),
(3, '510', 'Surat Keterangan Usaha'),
(4, '470', 'Surat Penduduk'),
(6, '512', 'Surat Keterangan Nikah'),
(7, '472', 'Surat Keterangan Pindah'),
(27, '315', 'Surat Edaran'),
(29, '513', 'Surat Rekomendasi'),
(30, '667', 'Surat Undangan'),
(31, '746', 'Surat Pemberitahuan'),
(32, '735', 'Surat Pengantar');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notifikasi`
--

CREATE TABLE `tb_notifikasi` (
  `id_notif` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `jenis_notif` varchar(15) NOT NULL,
  `judul_notif` varchar(40) NOT NULL,
  `isi_notif` text NOT NULL,
  `status_notif` set('y','t') NOT NULL DEFAULT 't',
  `create_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `nip` int(20) NOT NULL,
  `id_bagian_pegawai` int(11) DEFAULT NULL,
  `id_jabatan_pegawai` int(11) DEFAULT NULL,
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
  `create_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`nip`, `id_bagian_pegawai`, `id_jabatan_pegawai`, `niap`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `agama`, `pangkat`, `alamat`, `no_hp`, `pendidikan_terakhir`, `sk_pengangkatan`, `foto`, `create_on`) VALUES
(8, 7, 16, '00', 'SUHERI', 'Laki - Laki', 'Jember', '1984-03-26', 'Islam', 'II', 'KK', '07', 'SMK', '140/30/35.09.10.2006/SK/2017', 'assets/uploads/foto_user/img_avatar31.png', '2018-05-29 09:33:58'),
(111, 4, 14, '53572', 'NUR HASAN', 'Laki - Laki', 'Jember', '1983-04-12', 'Islam', '4v', 'BALUNG KIDUL', '09876', 'SMK', '140/27/35.09.10.2006/SK/2017', 'assets/uploads/foto_user/img_avatar34.png', '2018-05-29 09:35:24'),
(366, 9, 15, '09', 'HELMI ZACKY ZAMAIN. AR', 'Laki - Laki', 'Jember', '1996-12-29', 'Islam', 'K', 'N', '08', 'PAKET C', '140/38/35.09.10.2006/SK/2017', 'assets/uploads/foto_user/img_avatar3.png', '2018-05-29 09:42:21'),
(761, 8, 16, '88', 'NURWIN', 'Laki - Laki', 'Jember', '1958-04-12', 'Islam', 'KK', 'BALUNG KIDUL', '098', 'ST', '140/32/35.09.10.2006/SK/2017', 'assets/uploads/foto_user/img_avatar33.png', '2018-05-29 09:42:01'),
(998, 1, 11, '009', 'SALMAN RIDHO BILLAH ARIEF', 'Laki - Laki', 'Jember', '1995-01-09', 'Islam', 'HH', 'BALUNG KIDUL', '098666', 'SMA', '140/17/35.09.10.2006/SK/2018', 'assets/uploads/foto_user/img_avatar35.png', '2018-05-29 09:35:45'),
(1111, 3, 14, '343420', 'HALIMAH', 'Perempuan', 'Jember', '1983-09-09', 'Islam', 'JJ', 'SS', '09876', 'SMK', '140/26/35.09.10.2006/SK/2017', 'assets/uploads/foto_user/img_avatar36.png', '2018-05-29 09:36:14'),
(1299, 2, 14, '2', 'SALLAHUDIN AL AYUBI ARIEF', 'Laki - Laki', 'Jember', '1993-08-10', 'Islam', 'L', 'J', '0', 'SMA', '140/25/35.09.10.2006/SK/2017', 'assets/uploads/foto_user/img_avatar32.png', '2018-05-29 09:34:50'),
(535435, 1, 1, '5353535', 'SAMSUL', 'Laki - Laki', 'Jember', '1967-08-03', 'vdvd', 'vdvdv', 'Balung Kidul', 'dvdvdv', 'SMA', '188.45/297/KTUN/021/2013', 'assets/uploads/foto_user/img_avatar37.png', '2018-05-29 09:36:41'),
(2353257, 1, 12, '53572', 'AYU FAJAR NASTITI', 'Perempuan', 'Bnayuwangi', '1994-07-02', 'Islam', 'fbfbfbfb', 'vdvdv', '081556780810', 'SMA', '140/18/35.09.10.2006/SK/2018', 'assets/uploads/foto_user/img_avatar38.png', '2018-05-29 09:36:52'),
(4545435, 1, 2, '235252', 'CANDRA NUR CAHYONO', 'Laki - Laki', 'Jember', '1983-07-23', 'Islam', 'dvdv', 'dvdvdv', 'dvdvdv', 'D III', '140/24/35.09.10.2006/SK/2017', 'assets/uploads/foto_user/img_avatar39.png', '2018-05-29 09:37:05'),
(324297939, 6, 13, '343420', 'IMAM NURYANTO', 'Laki - Laki', 'Jember', '1961-03-28', 'Islam', 'dvdv', 'dvdvd', '52525', 'STM', '140/29/35.09.10.2006/SK/2017', 'assets/uploads/foto_user/img_avatar310.png', '2018-05-29 09:37:19'),
(2147483647, 5, 15, '5435435353', 'HOLLA', 'Laki - Laki', 'Jember', '1970-06-17', 'Islam', 'vdsvsdvs', 'vdvdv', 'dvdvdvd', 'SMEA', '140/28/35.09.10.2006/SK/2017', 'assets/uploads/foto_user/img_avatar311.png', '2018-05-29 09:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_keluar`
--

CREATE TABLE `tb_surat_keluar` (
  `id_surat_keluar` int(11) NOT NULL,
  `no_surat` varchar(20) NOT NULL,
  `id_bagian` int(11) DEFAULT NULL,
  `tujuan` varchar(40) NOT NULL,
  `isi_singkat` mediumtext NOT NULL,
  `id_jenis_surat` int(11) DEFAULT NULL,
  `perihal` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_arsip` date NOT NULL,
  `keterangan` text NOT NULL,
  `file` text NOT NULL,
  `nama_file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_surat_keluar`
--

INSERT INTO `tb_surat_keluar` (`id_surat_keluar`, `no_surat`, `id_bagian`, `tujuan`, `isi_singkat`, `id_jenis_surat`, `perihal`, `tgl_surat`, `tgl_arsip`, `keterangan`, `file`, `nama_file`) VALUES
(1, '0876/0654', 5, 'Dinas Perpajakan', '-', 4, '-', '2018-05-01', '2018-05-14', '-', 'assets/uploads/file/Surat%20Penduduk/bkp.jpg', 'bkp.jpg'),
(2, '0987/6543', 2, 'Dinas Koperasi dan Usaha', '-', 3, '-', '2018-04-30', '2018-05-14', '-', 'assets/uploads/file/Surat%20Keterangan%20Usaha/putu.jpg', 'putu.jpg'),
(3, '876/897', 6, 'Semua Warga', '-', 4, '-', '2018-05-03', '2018-05-14', '-', 'assets/uploads/file/Surat%20Penduduk/don.jpg', 'don.jpg'),
(4, '9087/564', 4, 'Ketua RT/RW', '-', 4, '-', '2018-04-29', '2018-05-14', '-', 'assets/uploads/file/Surat%20Penduduk/bolcok.jpg', 'bolcok.jpg'),
(5, '0875/9087', 8, 'Pengembangan SDM', '-', 4, '-', '2018-05-02', '2018-05-14', '-', 'assets/uploads/file/Surat%20Penduduk/piscok.jpg', 'piscok.jpg'),
(6, '0097/0065', 3, 'Kantor Pajak', '-', 3, '-', '2018-04-29', '2018-05-14', '-', 'assets/uploads/file/Surat%20Keterangan%20Usaha/piscok.jpg', 'piscok.jpg'),
(7, '0098/007', 5, 'Kantor Kecamatan Balung', 'Undangan Rapat ', 4, '-', '2018-05-04', '2018-05-14', '-', 'assets/uploads/file/Surat%20Penduduk/lampiran_Permendagri_Nomor_78_Tahun_2012.pdf', 'lampiran_Permendagri_Nomor_78_Tahun_2012.pdf'),
(8, '0098/0076', 2, 'Dinas Koperasi', '-', 3, '-', '2018-05-01', '2018-05-14', '-', 'assets/uploads/file/Surat%20Keterangan%20Usaha/piscok1.jpg', 'piscok1.jpg'),
(9, '143/BBJ/2022/SKPOT/2', 3, 'Penduduk', 'Bahwa penduduk tersebut mendapatkan penghasilan sebesar 1.000.000 dengan menghidupi 4 orang keluarganya', 4, 'Surat Keterangan Tidak Mampu', '2013-05-03', '2018-05-14', '-', 'assets/uploads/file/Surat%20Penduduk/ar62.jpeg', 'putu3.jpg'),
(10, '143/BBJ/2022/SKPOT/2', 3, 'Penduduk', 'Bahwa penduduk tersebut mendapatkan penghasilan 1.000.000 dengan menghidupi 4 orang anggota keluarga ', 4, 'SURAT KETERANGAN PENGHASILAN O', '2013-05-02', '2018-05-14', '-', 'assets/uploads/file/Surat%20Penduduk/ar61.jpeg', 'ar61.jpeg'),
(11, '470/SKTM/35.09.04.20', 1, 'Penduduk', 'Surat Keterangan Tidak Mampu', 4, 'SKTM', '2018-04-20', '2018-06-01', 'SKTM', 'assets/uploads/file/Surat%20Penduduk/1527129223.jpg', '1527129223.jpg'),
(12, '121/KBL/VIII/2017', 7, 'Surat Kematian', 'Surat Keterangan Kematian', 1, 'Surat Keterangan Kematian ', '2017-08-13', '2018-06-04', 'Surat Keluar Untuk Surat Keterangan Kematian', 'assets/uploads/file/Surat%20Kematian/Contoh-surat-kematian.jpg', ''),
(13, '0015/SP/010-05/09/20', 4, 'Surat Pengantar', 'Surat Pengantar', 3, 'Surat Pengantar', '2018-09-18', '2018-06-04', 'Surat Pengantar Mengurus Pemerintahan', 'assets/uploads/file/Surat%20Keterangan%20Usaha/surat-pengantar-mengurus-pernikahan-1-638.jpg', ''),
(14, '09/140/III/WDL/2014', 9, 'Penduduk', 'Surat Keterangan Kelahiran', 2, 'Surat Keterangan Kelahiran', '2018-06-15', '2018-06-04', 'Surat Keterangan Kelahiran', 'assets/uploads/file/Surat%20Kelahiran/surat-keterangan-lahir-1-638.jpg', ''),
(15, '140/03/SR/RKT/2013', 9, 'Penduduk', 'Surat Keterangan Menikah', 6, '-', '2013-11-15', '2018-06-04', 'Surat Keterangan Menikah', 'assets/uploads/file/Surat%20Keterangan%20Nikah/suratketeranganmenikah-131117195800-phpapp01-thumbnail-4.jpg', ''),
(16, '575/45/KDS_BTK/2015', 6, 'Penduduk', 'Surat Keterangan Pindah', 7, '-', '2017-09-30', '2018-06-04', 'Surat Keterangan Pindah', 'assets/uploads/file/Surat%20Keterangan%20Pindah/pindah.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_masuk`
--

CREATE TABLE `tb_surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL,
  `no_surat` varchar(20) NOT NULL,
  `asal_surat` varchar(40) NOT NULL,
  `isi_singkat` mediumtext NOT NULL,
  `id_jenis_surat` int(11) DEFAULT NULL,
  `perihal` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_arsip` date NOT NULL,
  `keterangan` text NOT NULL,
  `status_disposisi` set('y','t') NOT NULL DEFAULT 't',
  `file` text NOT NULL,
  `nama_file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_surat_masuk`
--

INSERT INTO `tb_surat_masuk` (`id_surat_masuk`, `no_surat`, `asal_surat`, `isi_singkat`, `id_jenis_surat`, `perihal`, `tgl_surat`, `tgl_arsip`, `keterangan`, `status_disposisi`, `file`, `nama_file`) VALUES
(1, '019/9900', 'Dinas Koperasi', 'pembangunan usaha dalam desa', 3, '-', '2018-05-09', '2018-05-12', '-', 't', 'assets/uploads/file/Surat%20Keterangan%20Usaha/acar.jpg', 'acar.jpg'),
(2, '0991/098', 'Dinas Kependudukan', 'Peraturan baru pembangunan SDM di desa se Jember', 4, '-', '2018-05-18', '2018-05-14', '-', 't', 'assets/uploads/file/Surat%20Penduduk/lv.jpg', 'lv.jpg'),
(3, '0987/1290', 'Dinas Koperasi dan Usaha', 'Pelatihan pengelolah KUD', 3, '-', '2018-03-08', '2018-05-14', '-', 't', 'assets/uploads/file/Surat%20Keterangan%20Usaha/kahrtunnn.jpg', 'kahrtunnn.jpg'),
(4, '098/09876', 'Dinas Sosial', 'undangan rapat rutin', 4, '-', '2018-05-01', '2018-05-14', '-', 'y', 'assets/uploads/file/Surat%20Penduduk/cmd_java.PNG', 'cmd_java.PNG'),
(5, '0987/6754', 'Dinas Pendidikan', 'Pengembangan SDM', 4, '-', '2018-05-02', '2018-05-14', '-', 't', 'assets/uploads/file/Surat%20Penduduk/bolcok1.jpg', 'bolcok1.jpg'),
(6, '00988/0087', 'Dinas Kependudukan', 'rapat rutin', 4, '-', '2018-05-02', '2018-05-14', '-', 't', 'assets/uploads/file/Surat%20Penduduk/bkp1.jpg', 'bkp1.jpg'),
(7, '0089/0067', 'Dinas Sosial', 'Rapat Triwuan ', 4, '-', '2018-05-05', '2018-05-14', '-', 'y', 'assets/uploads/file/Surat%20Penduduk/putu.jpg', 'putu.jpg'),
(8, '0098/00876', 'Kantor Desa Taman Sari', 'Silaturahmi ', 4, '-', '2018-05-04', '2018-05-14', '-', 't', 'assets/uploads/file/Surat%20Penduduk/piscok1.jpg', 'piscok1.jpg'),
(9, '0087/0087', 'Kantor Kecamatan Balung', 'Permintaan data penduduk', 4, '-', '2018-05-02', '2018-05-14', '-', 'y', 'assets/uploads/file/Surat%20Penduduk/putu1.jpg', 'putu1.jpg'),
(10, '00998/0098', 'Kantor Kecamatan Balung', 'Pendataan keterangan usaha', 3, '-', '2018-05-01', '2018-05-14', '-', 'y', 'assets/uploads/file/Surat%20Keterangan%20Usaha/bkp.jpg', 'bkp.jpg'),
(18, '300/1420/313/2016', 'Badan Kepegawaian', 'Surat Undangan Upacara Pengangkatan Sumpah/Janji PNS', 30, 'Undangan Menghadiri Upacara Pe', '2016-06-27', '2018-06-05', 'Kegiatan dilaksanakan pada hari Rabu, 29 Juni 2016, pukul 13.00, tempat Aaula PB.Sudirman Pemkab. Jember, pakaian KOPRI lengkap', 't', 'assets/uploads/file/Surat%20Undangan/001_(1).jpg', ''),
(19, '055/1207.1.12/2016', 'Sekretariat Kabupaten', 'Ketetapan Pakaian Dinas Pegawai', 27, 'Pakaian Dinas Pegawai', '2016-06-27', '2018-06-05', 'Terlampir', 't', 'assets/uploads/file/Surat%20Edaran/001_(2).jpg', ''),
(20, '470/8925/2016', 'Sekretariat Kabupaten', 'Pemberitahuan Masa Berlaku e-KTP', 31, 'KRT Elektronik (KTP-e) Berlaku', '2016-02-01', '2018-06-05', 'Terlampir', 't', 'assets/uploads/file/Surat%20Pemberitahuan/insentif_dan_kualifikasi_s1_0001_(1).jpg', ''),
(21, '800/729/313/2016', 'Badan Kepegawaian', 'Pengangkatan CPNS menjadi PNS', 31, 'Pengangkatan CPNS menjadi PNS', '2016-03-21', '2018-06-05', 'Terlampir', 't', 'assets/uploads/file/Surat%20Pemberitahuan/insentif_dan_kualifikasi_s1_0001.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

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
(2, 2353257, 'ayu', 'dSvhkdHHAtpSQS+ynrMjypB1EiYTstzc+2H9+hWZfTwosJMeG7C8PgdzmeC6G+Jk2Qc7BqrNsC1T6u3rIWODFg==', 'admin'),
(3, 535435, 'samsul', 'befXI6VVLx5ahJ0u3XyaRDdhE8t9TwmvlEz6Br+G2BpjGwjvxSPDkdxCS3CzO2JYZSuugcZt2UjiMSmI+9B8Jw==', 'kepala desa'),
(4, 2147483647, 'holla', 'jXQwODy4WeEfF4LclcaPeFq86lp4EJ+h26tdDqKmc6c8nVsyjxgjAWHYLLUamPM3wIG9/J8smzF5ptAkggVk/w==', 'kepala bagian'),
(5, 4545435, 'candra', 'QplZIhSfWrc/Xsq+ScDpV8R5WQFyI7DBUgrY0DEf2LAnVvf+vfvm42o1z+sTWuUnK6q22Vlb6RxkOenl0lpnUA==', 'sekertaris'),
(6, 324297939, 'imam', 'j3C2w2z9iRCHKXrIBFIS+5hInpXcHK3WSavPdHKcn4jK0PKsHGLGbdTuPj0bZ5do8BS3kSFRaIwvGXG3UE8D3w==', 'staf'),
(7, 1299, 'sallahudin', 'GW1UPGfJFPx+IY79z/DL+GQJ/bxOp7Rkk1XNsZXW1g4d6Sid0i3lY9iT8VMpPm3zwX4CEsMl7D40pb2Rfrm4pw==', 'kepala bagian'),
(8, 1111, 'halimah', 'Hk5QBqh6l7MQzmc+lUVO5JIoAOv0enMe/pARbUGxv1vCBFY27+QaZ94KVQa1m4uCLr8s75sOFxAWCp0bjl1HXA==', 'kepala bagian'),
(9, 111, 'nur', 'inMmAUl4/wWiD5ntm3ViLBmy+uQXv7mRReqOVlspkLD94pckuqkRgMUriHx3TQOmS3nGo+/Vs2NaxcfQPo4YqQ==', 'kepala bagian'),
(10, 366, 'helmi', 'B+GccBrlFURDVxu8xQE2/ij0qx/RkDKu3wDHCowhWh/nCTCbN2ZZ9yHLW8HYu3EJiHJXrWQVeoz2hFk7esvr6A==', 'kepala bagian'),
(11, 8, 'suheri', 'TdARhiWiae36W7E0ekZsLySUrRJk1Wluvsm84FErbsog8ugBzG5H0C9egRojXCQM//nteYKfmeuyRXsX2l6Bwg==', 'kepala bagian'),
(12, 761, 'nurwin', 'sfdJn805/AdXf1kVImqQl5H9Mv0wk+iJEU0YQmSq/gMFYMZ7F7ARoDBxnZhrxs4IjuOhaQKndpVkYT2NWUqJCA==', 'kepala bagian'),
(13, 998, 'salman', '/ay6wuOge/TJvNx+fLW5YFC2Ix+BdBWhHOviZyvRSRBy2CmpvDsu492z2wVI3V1vqtsQcjTcQAsbmh6UUTtMRA==', 'staf');

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
  MODIFY `id_bagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_disposisi`
--
ALTER TABLE `tb_disposisi`
  MODIFY `id_disposisi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_jenis_surat`
--
ALTER TABLE `tb_jenis_surat`
  MODIFY `id_jenis_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  MODIFY `id_surat_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  MODIFY `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_disposisi`
--
ALTER TABLE `tb_disposisi`
  ADD CONSTRAINT `tb_disposisi_ibfk_1` FOREIGN KEY (`id_bagian`) REFERENCES `tb_bagian` (`id_bagian`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_disposisi_ibfk_2` FOREIGN KEY (`id_surat_masuk`) REFERENCES `tb_surat_masuk` (`id_surat_masuk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD CONSTRAINT `tb_pegawai_ibfk_1` FOREIGN KEY (`id_bagian_pegawai`) REFERENCES `tb_bagian` (`id_bagian`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pegawai_ibfk_11111` FOREIGN KEY (`id_jabatan_pegawai`) REFERENCES `tb_jabatan` (`id_jabatan`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  ADD CONSTRAINT `tb_surat_keluar_ibfk_1` FOREIGN KEY (`id_bagian`) REFERENCES `tb_bagian` (`id_bagian`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_surat_keluar_ibfk_2` FOREIGN KEY (`id_jenis_surat`) REFERENCES `tb_jenis_surat` (`id_jenis_surat`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  ADD CONSTRAINT `tb_surat_masuk_ibfk_1` FOREIGN KEY (`id_jenis_surat`) REFERENCES `tb_jenis_surat` (`id_jenis_surat`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`nip_user`) REFERENCES `tb_pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
