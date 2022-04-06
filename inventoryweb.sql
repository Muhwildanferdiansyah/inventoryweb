-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for inventoryweb
CREATE DATABASE IF NOT EXISTS `inventoryweb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `inventoryweb`;

-- Dumping structure for table inventoryweb.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(60) DEFAULT NULL,
  `stok` varchar(4) DEFAULT NULL,
  `id_satuan` int(20) DEFAULT NULL,
  `id_jenis` int(20) DEFAULT NULL,
  `foto` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table inventoryweb.barang: ~2 rows (approximately)
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` (`id_barang`, `nama_barang`, `stok`, `id_satuan`, `id_jenis`, `foto`) VALUES
	('BRG-0001', 'beras MWS', '1', 2, 3, 'box.png'),
	('BRG-0002', 'beras', '900', 1, 2, 'box.png');
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;

-- Dumping structure for table inventoryweb.barang_keluar
CREATE TABLE IF NOT EXISTS `barang_keluar` (
  `id_barang_keluar` varchar(30) NOT NULL,
  `id_barang` varchar(30) DEFAULT NULL,
  `id_user` varchar(30) DEFAULT NULL,
  `jumlah_keluar` varchar(5) DEFAULT NULL,
  `tgl_keluar` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_barang_keluar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table inventoryweb.barang_keluar: ~0 rows (approximately)
/*!40000 ALTER TABLE `barang_keluar` DISABLE KEYS */;
/*!40000 ALTER TABLE `barang_keluar` ENABLE KEYS */;

-- Dumping structure for table inventoryweb.barang_masuk
CREATE TABLE IF NOT EXISTS `barang_masuk` (
  `id_barang_masuk` varchar(40) NOT NULL,
  `id_supplier` varchar(30) DEFAULT NULL,
  `id_barang` varchar(30) DEFAULT NULL,
  `id_user` varchar(30) DEFAULT NULL,
  `jumlah_masuk` int(10) DEFAULT NULL,
  `tgl_masuk` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_barang_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table inventoryweb.barang_masuk: ~1 rows (approximately)
/*!40000 ALTER TABLE `barang_masuk` DISABLE KEYS */;
INSERT INTO `barang_masuk` (`id_barang_masuk`, `id_supplier`, `id_barang`, `id_user`, `jumlah_masuk`, `tgl_masuk`) VALUES
	('BRG-M-0001', 'SPLY-0001', 'BRG-0001', 'USR-002', 2000, '2022-03-01');
/*!40000 ALTER TABLE `barang_masuk` ENABLE KEYS */;

-- Dumping structure for table inventoryweb.jenis
CREATE TABLE IF NOT EXISTS `jenis` (
  `id_jenis` int(20) NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(20) DEFAULT NULL,
  `ket` text,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table inventoryweb.jenis: ~3 rows (approximately)
/*!40000 ALTER TABLE `jenis` DISABLE KEYS */;
INSERT INTO `jenis` (`id_jenis`, `nama_jenis`, `ket`) VALUES
	(1, 'Beras merah', ''),
	(2, 'beras hitam', ''),
	(3, 'Mentik Wangi Susu', '');
/*!40000 ALTER TABLE `jenis` ENABLE KEYS */;

-- Dumping structure for table inventoryweb.pemesanan
CREATE TABLE IF NOT EXISTS `pemesanan` (
  `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_pesan` varchar(50) DEFAULT NULL,
  `id_barang` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `biaya_pemesanan` int(11) DEFAULT NULL,
  `biaya_penyimpanan` int(11) DEFAULT NULL,
  `biaya_pemeliharaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pemesanan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table inventoryweb.pemesanan: ~5 rows (approximately)
/*!40000 ALTER TABLE `pemesanan` DISABLE KEYS */;
INSERT INTO `pemesanan` (`id_pemesanan`, `tgl_pesan`, `id_barang`, `jumlah`, `biaya_pemesanan`, `biaya_penyimpanan`, `biaya_pemeliharaan`) VALUES
	(1, '2022-03-26', 'BRG-0002', 1000, 1000, NULL, 1500),
	(2, '2022-03-25', 'BRG-0001', 50, 100, 200, 250),
	(3, '2022-03-26', 'BRG-0002', 250, 1400, 20000, 25000),
	(4, '2022-03-28', 'BRG-0002', 700, 900, 1000, 1010),
	(5, '2022-03-28', 'BRG-0001', 255, 5000, 1500, 2500);
/*!40000 ALTER TABLE `pemesanan` ENABLE KEYS */;

-- Dumping structure for table inventoryweb.rop
CREATE TABLE IF NOT EXISTS `rop` (
  `id_rop` int(11) NOT NULL AUTO_INCREMENT,
  `id_safety` int(11) DEFAULT NULL,
  `pemakaian_rata` int(11) DEFAULT NULL,
  `lead_time_demand` int(11) DEFAULT NULL,
  `rop` int(11) DEFAULT NULL,
  `tgl_rop` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_rop`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table inventoryweb.rop: ~0 rows (approximately)
/*!40000 ALTER TABLE `rop` DISABLE KEYS */;
/*!40000 ALTER TABLE `rop` ENABLE KEYS */;

-- Dumping structure for table inventoryweb.safety_stok
CREATE TABLE IF NOT EXISTS `safety_stok` (
  `id_safety` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_safety` varchar(50) DEFAULT NULL,
  `id_barang` varchar(50) DEFAULT NULL,
  `pemakaian_maximal` varchar(50) DEFAULT NULL,
  `pemakaian_minimal` varchar(50) DEFAULT NULL,
  `lead_time` varchar(50) DEFAULT NULL,
  `safety_stok` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_safety`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table inventoryweb.safety_stok: ~1 rows (approximately)
/*!40000 ALTER TABLE `safety_stok` DISABLE KEYS */;
INSERT INTO `safety_stok` (`id_safety`, `tgl_safety`, `id_barang`, `pemakaian_maximal`, `pemakaian_minimal`, `lead_time`, `safety_stok`) VALUES
	(13, '2022-04-01', 'BRG-0002', '50000', '30000', '7', '140000');
/*!40000 ALTER TABLE `safety_stok` ENABLE KEYS */;

-- Dumping structure for table inventoryweb.satuan
CREATE TABLE IF NOT EXISTS `satuan` (
  `id_satuan` int(20) NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(60) DEFAULT NULL,
  `ket` text,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table inventoryweb.satuan: ~3 rows (approximately)
/*!40000 ALTER TABLE `satuan` DISABLE KEYS */;
INSERT INTO `satuan` (`id_satuan`, `nama_satuan`, `ket`) VALUES
	(1, 'kg', 'Kilogram'),
	(2, 'Ton', 'ton'),
	(3, 'Zak', 'Zak');
/*!40000 ALTER TABLE `satuan` ENABLE KEYS */;

-- Dumping structure for table inventoryweb.supplier
CREATE TABLE IF NOT EXISTS `supplier` (
  `id_supplier` varchar(10) NOT NULL,
  `nama_supplier` varchar(60) DEFAULT NULL,
  `notelp` varchar(15) DEFAULT NULL,
  `alamat` text,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table inventoryweb.supplier: ~1 rows (approximately)
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `notelp`, `alamat`) VALUES
	('SPLY-0001', 'rizky', '089999999999', 'batu');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;

-- Dumping structure for table inventoryweb.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `level` enum('gudang','admin','manajer') NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table inventoryweb.user: ~3 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `nama`, `username`, `email`, `notelp`, `level`, `password`, `foto`, `status`) VALUES
	('USR-001', 'Administrasi', 'admin', 'admin@admin.com', '087856123445', 'admin', '0192023a7bbd73250516f069df18b500', 'user.png', 'Aktif'),
	('USR-002', 'Gudang', 'gudang', 'gudang@gmail.com', '087817379229', 'gudang', '202446dd1d6028084426867365b0c7a1', 'user.png', 'Aktif'),
	('USR-003', 'Manajer', 'manajer', 'manajer@gmail.com', '089291889228', 'manajer', '69b731ea8f289cf16a192ce78a37b4f0', 'user.png', 'Aktif');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
