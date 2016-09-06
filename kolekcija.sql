-- --------------------------------------------------------
-- Poslužitelj:                  127.0.0.1
-- Server version:               10.1.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Verzija:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for kolekcija
CREATE DATABASE IF NOT EXISTS `kolekcija` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `kolekcija`;


-- Dumping structure for table kolekcija.filmovi
CREATE TABLE IF NOT EXISTS `filmovi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(255) DEFAULT NULL,
  `id_zanr` int(11) NOT NULL,
  `godina` date DEFAULT NULL,
  `trajanje` varchar(255) DEFAULT NULL,
  `slika` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_zanr` (`id_zanr`),
  CONSTRAINT `filmovi_ibfk_1` FOREIGN KEY (`id_zanr`) REFERENCES `zanr` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table kolekcija.filmovi: ~10 rows (approximately)
DELETE FROM `filmovi`;
/*!40000 ALTER TABLE `filmovi` DISABLE KEYS */;
INSERT INTO `filmovi` (`id`, `naslov`, `id_zanr`, `godina`, `trajanje`, `slika`) VALUES
	(1, 'Antitrust', 11, '2001-00-00', '117', 'slika_1_1464511757.jpg'),
	(2, 'Firewall', 2, '2006-00-00', '105', 'slika_2_1464511843.jpg'),
	(3, 'Hackers', 2, '1995-00-00', '99', 'slika_3_1464511936.jpg'),
	(4, 'Operation Swordfish', 2, '2001-00-00', '120', 'slika_4_1464511982.jpg'),
	(5, 'Operation Take down', 2, '2000-00-00', '123', 'slika_5_1464512021.jpg'),
	(6, 'Pirates of Silicon valley', 11, '1999-00-00', '136', 'slika_6_1464512109.jpg'),
	(7, 'The Social network', 11, '2010-00-00', '105', 'slika_7_1464512152.jpg'),
	(8, 'Tron', 2, '1982-00-00', '123', 'slika_8_1464512217.jpg'),
	(9, 'Tron', 2, '2010-00-00', '136', 'slika_9_1464512271.jpg'),
	(10, 'War games', 2, '1983-00-00', '117', 'slika_10_1464512322.jpg');
/*!40000 ALTER TABLE `filmovi` ENABLE KEYS */;


-- Dumping structure for table kolekcija.zanr
CREATE TABLE IF NOT EXISTS `zanr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table kolekcija.zanr: ~12 rows (approximately)
DELETE FROM `zanr`;
/*!40000 ALTER TABLE `zanr` DISABLE KEYS */;
INSERT INTO `zanr` (`id`, `naziv`) VALUES
	(1, '3D Film'),
	(2, 'Akcijski film'),
	(3, 'Art film'),
	(4, 'Biografski film'),
	(5, 'Crtani film'),
	(6, 'Dokumentarni film'),
	(7, 'Dramski film'),
	(8, 'Komedija'),
	(9, 'Kriminalistički film'),
	(10, 'Ratni film'),
	(11, 'Triler'),
	(12, 'Vestern');
/*!40000 ALTER TABLE `zanr` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
