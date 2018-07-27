-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.6.40-log - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Export de la structure de la base pour sgtools
CREATE DATABASE IF NOT EXISTS `sgtools` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sgtools`;

-- Export de la structure de la table sgtools. avatars
DROP TABLE IF EXISTS `avatars`;
CREATE TABLE IF NOT EXISTS `avatars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `pack` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Export de données de la table sgtools.avatars : ~6 rows (environ)
DELETE FROM `avatars`;
/*!40000 ALTER TABLE `avatars` DISABLE KEYS */;
INSERT INTO `avatars` (`id`, `name`, `pack`) VALUES
	(1, 'Nathalie', 1),
	(2, 'Jean', 1),
	(3, 'Emmanuel', 1),
	(4, 'Marie', 1),
	(5, 'Frederic', 1),
	(6, 'Romain', 2);
/*!40000 ALTER TABLE `avatars` ENABLE KEYS */;

-- Export de la structure de la table sgtools. customer
DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mail` varchar(256) NOT NULL,
  `apikey` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `lastLogin` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Export de données de la table sgtools.customer : ~1 rows (environ)
DELETE FROM `customer`;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` (`id`, `mail`, `apikey`, `password`, `admin`, `lastLogin`) VALUES
	(1, 'zarnes@live.com', '', '$2y$10$mG1lcUhpscD4d2Rk/EjMFOhH/yNLN5ssL2y8dhsSPivsYAWB9oyeK', 1, '2018-07-24 15:41:12');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- Export de la structure de la table sgtools. customerpacks
DROP TABLE IF EXISTS `customerpacks`;
CREATE TABLE IF NOT EXISTS `customerpacks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idCustomer` int(10) unsigned NOT NULL,
  `idPack` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Export de données de la table sgtools.customerpacks : ~0 rows (environ)
DELETE FROM `customerpacks`;
/*!40000 ALTER TABLE `customerpacks` DISABLE KEYS */;
/*!40000 ALTER TABLE `customerpacks` ENABLE KEYS */;

-- Export de la structure de la table sgtools. material
DROP TABLE IF EXISTS `material`;
CREATE TABLE IF NOT EXISTS `material` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idCustomer` int(11) NOT NULL,
  `name` varchar(160) NOT NULL,
  `category` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Export de données de la table sgtools.material : ~0 rows (environ)
DELETE FROM `material`;
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
/*!40000 ALTER TABLE `material` ENABLE KEYS */;

-- Export de la structure de la table sgtools. material_liaison
DROP TABLE IF EXISTS `material_liaison`;
CREATE TABLE IF NOT EXISTS `material_liaison` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idCustomer` int(10) unsigned NOT NULL,
  `idMaterial` int(10) unsigned NOT NULL,
  `spawnedBy` tinyint(3) unsigned NOT NULL COMMENT '0=>surgery, 1=>patient',
  `idSpawner` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Export de données de la table sgtools.material_liaison : ~0 rows (environ)
DELETE FROM `material_liaison`;
/*!40000 ALTER TABLE `material_liaison` DISABLE KEYS */;
/*!40000 ALTER TABLE `material_liaison` ENABLE KEYS */;

-- Export de la structure de la table sgtools. patient
DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idCustomer` int(10) unsigned NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `sex` tinyint(3) unsigned NOT NULL COMMENT '0 = homme 1 = femme',
  `age` tinyint(3) unsigned NOT NULL,
  `height` smallint(4) unsigned NOT NULL,
  `weight` smallint(4) unsigned NOT NULL,
  `avatar` int(10) unsigned NOT NULL,
  `story` text NOT NULL,
  `treatments` text NOT NULL,
  `allergies` text NOT NULL COMMENT 'json format',
  `ta` text NOT NULL COMMENT 'int/int',
  `fc` tinyint(3) unsigned NOT NULL,
  `dentalCondition` text NOT NULL,
  `dentalRiskNotice` tinyint(3) unsigned NOT NULL COMMENT '0 : oui, 1 : non',
  `mallanpati` tinyint(3) unsigned NOT NULL COMMENT '1 à 4',
  `thyroidMentalDistance` tinyint(3) unsigned NOT NULL COMMENT '0 : < 65mm, 1 : >=65mm',
  `mouthOpening` tinyint(3) unsigned NOT NULL COMMENT '0 : < 35mm, 1 : >=35mm',
  `difficultIntubation` tinyint(3) unsigned NOT NULL COMMENT '0 : oui, 1 : non',
  `difficultVentilation` tinyint(3) unsigned NOT NULL COMMENT '0 : oui, 1 : non',
  `asa` tinyint(3) unsigned NOT NULL,
  `preAnestheticExaminations` text NOT NULL COMMENT 'json',
  `marProposition` tinyint(3) unsigned NOT NULL COMMENT '0 : rien, 1 : ag, 2 : alr, 3 : ag+alr',
  `expectedHospitalisation` tinyint(3) unsigned NOT NULL COMMENT '0 : conventionnelle, 1 : ambulatoire, 2 : réa/SSIPO',
  `transfusionStrategy` text NOT NULL,
  `preAnestheticVisit` text NOT NULL,
  `premedication` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idClient` (`idCustomer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Export de données de la table sgtools.patient : ~0 rows (environ)
DELETE FROM `patient`;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;

-- Export de la structure de la table sgtools. patient_liaison
DROP TABLE IF EXISTS `patient_liaison`;
CREATE TABLE IF NOT EXISTS `patient_liaison` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idPatient` int(10) unsigned NOT NULL,
  `idCustomer` int(10) unsigned NOT NULL,
  `idSurgery` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Export de données de la table sgtools.patient_liaison : ~0 rows (environ)
DELETE FROM `patient_liaison`;
/*!40000 ALTER TABLE `patient_liaison` DISABLE KEYS */;
/*!40000 ALTER TABLE `patient_liaison` ENABLE KEYS */;

-- Export de la structure de la table sgtools. questions
DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idCustomer` int(10) unsigned NOT NULL,
  `name` varchar(60) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Export de données de la table sgtools.questions : ~0 rows (environ)
DELETE FROM `questions`;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;

-- Export de la structure de la table sgtools. questions_liaison
DROP TABLE IF EXISTS `questions_liaison`;
CREATE TABLE IF NOT EXISTS `questions_liaison` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idQuestion` int(10) unsigned NOT NULL,
  `answer` text NOT NULL,
  `idCustomer` int(10) unsigned NOT NULL,
  `spawnedBy` tinyint(3) unsigned NOT NULL COMMENT '0=>surgery, 1=>patient',
  `idSpawner` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Export de données de la table sgtools.questions_liaison : ~0 rows (environ)
DELETE FROM `questions_liaison`;
/*!40000 ALTER TABLE `questions_liaison` DISABLE KEYS */;
/*!40000 ALTER TABLE `questions_liaison` ENABLE KEYS */;

-- Export de la structure de la table sgtools. surgery
DROP TABLE IF EXISTS `surgery`;
CREATE TABLE IF NOT EXISTS `surgery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idCustomer` int(10) unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `consultation` tinyint(1) unsigned NOT NULL,
  `emergency` tinyint(1) unsigned NOT NULL,
  `story` text NOT NULL,
  `marProposition` tinyint(2) unsigned NOT NULL,
  `marPropositionText` text NOT NULL,
  `preAnestheticVisit` text NOT NULL,
  `lastEval` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Export de données de la table sgtools.surgery : ~0 rows (environ)
DELETE FROM `surgery`;
/*!40000 ALTER TABLE `surgery` DISABLE KEYS */;
/*!40000 ALTER TABLE `surgery` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
