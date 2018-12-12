-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 12 déc. 2018 à 15:30
-- Version du serveur :  5.6.40-log
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sgtools`
--

-- --------------------------------------------------------

--
-- Structure de la table `avatars`
--

CREATE TABLE `avatars` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `pack` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `mail` varchar(256) NOT NULL,
  `apikey` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `lastLogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`id`, `mail`, `apikey`, `password`, `admin`, `lastLogin`) VALUES
(1, 'zarnes@live.com', '', '$2y$10$mG1lcUhpscD4d2Rk/EjMFOhH/yNLN5ssL2y8dhsSPivsYAWB9oyeK', 1, '2018-12-12 14:55:13'),
(2, 'rouen', '', 'invalid', 0, '0000-00-00 00:00:00'),
(3, 'Dummy test', '', '$2y$10$hYYLgl1h5/lKtEY/uKJR5O8S7GE.fdmcTQzVg2MUEjerv9XaKPOwq', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `customerpacks`
--

CREATE TABLE `customerpacks` (
  `id` int(10) UNSIGNED NOT NULL,
  `idCustomer` int(10) UNSIGNED NOT NULL,
  `idPack` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `material`
--

CREATE TABLE `material` (
  `id` int(10) UNSIGNED NOT NULL,
  `idCustomer` int(11) NOT NULL,
  `name` varchar(160) NOT NULL,
  `category` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `material_liaison`
--

CREATE TABLE `material_liaison` (
  `id` int(10) UNSIGNED NOT NULL,
  `idCustomer` int(10) UNSIGNED NOT NULL,
  `idMaterial` int(10) UNSIGNED NOT NULL,
  `spawnedBy` tinyint(3) UNSIGNED NOT NULL COMMENT '0=>surgery, 1=>patient',
  `idSpawner` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id` int(10) UNSIGNED NOT NULL,
  `idCustomer` int(10) UNSIGNED NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `sex` tinyint(3) UNSIGNED NOT NULL COMMENT '0 = homme 1 = femme',
  `age` tinyint(3) UNSIGNED NOT NULL,
  `height` smallint(4) UNSIGNED NOT NULL,
  `weight` smallint(4) UNSIGNED NOT NULL,
  `avatar` int(10) UNSIGNED NOT NULL,
  `story` text NOT NULL,
  `treatments` text NOT NULL,
  `allergies` text NOT NULL COMMENT 'json format',
  `ta` text NOT NULL COMMENT 'int/int',
  `fc` tinyint(3) UNSIGNED NOT NULL,
  `dentalCondition` text NOT NULL,
  `dentalRiskNotice` tinyint(3) UNSIGNED NOT NULL COMMENT '0 : oui, 1 : non',
  `mallanpati` tinyint(3) UNSIGNED NOT NULL COMMENT '1 à 4',
  `thyroidMentalDistance` tinyint(3) UNSIGNED NOT NULL COMMENT '0 : < 65mm, 1 : >=65mm',
  `mouthOpening` tinyint(3) UNSIGNED NOT NULL COMMENT '0 : < 35mm, 1 : >=35mm',
  `difficultIntubation` tinyint(3) UNSIGNED NOT NULL COMMENT '0 : oui, 1 : non',
  `difficultVentilation` tinyint(3) UNSIGNED NOT NULL COMMENT '0 : oui, 1 : non',
  `asa` tinyint(3) UNSIGNED NOT NULL,
  `preAnestheticExaminations` text NOT NULL COMMENT 'json',
  `marProposition` tinyint(3) UNSIGNED NOT NULL COMMENT '0 : rien, 1 : ag, 2 : alr, 3 : ag+alr',
  `expectedHospitalisation` tinyint(3) UNSIGNED NOT NULL COMMENT '0 : conventionnelle, 1 : ambulatoire, 2 : réa/SSIPO',
  `transfusionStrategy` text NOT NULL,
  `preAnestheticVisit` text NOT NULL,
  `premedication` text NOT NULL,
  `examExtra` text NOT NULL,
  `premedicationExtra` text NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `patient_liaison`
--

CREATE TABLE `patient_liaison` (
  `id` int(10) UNSIGNED NOT NULL,
  `idPatient` int(10) UNSIGNED NOT NULL,
  `idCustomer` int(10) UNSIGNED NOT NULL,
  `idSurgery` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `idCustomer` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `questions_liaison`
--

CREATE TABLE `questions_liaison` (
  `id` int(10) UNSIGNED NOT NULL,
  `idQuestion` int(10) UNSIGNED NOT NULL,
  `answer` text NOT NULL,
  `idCustomer` int(10) UNSIGNED NOT NULL,
  `spawnedBy` tinyint(3) UNSIGNED NOT NULL COMMENT '0=>surgery, 1=>patient',
  `idSpawner` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `surgery`
--

CREATE TABLE `surgery` (
  `id` int(10) UNSIGNED NOT NULL,
  `idCustomer` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `consultation` tinyint(1) UNSIGNED NOT NULL,
  `emergency` tinyint(1) UNSIGNED NOT NULL,
  `story` text NOT NULL,
  `marProposition` tinyint(2) UNSIGNED NOT NULL,
  `marPropositionText` text NOT NULL,
  `preAnestheticVisit` text NOT NULL,
  `lastEval` tinyint(3) UNSIGNED NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customerpacks`
--
ALTER TABLE `customerpacks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `material_liaison`
--
ALTER TABLE `material_liaison`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idClient` (`idCustomer`);

--
-- Index pour la table `patient_liaison`
--
ALTER TABLE `patient_liaison`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `questions_liaison`
--
ALTER TABLE `questions_liaison`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `surgery`
--
ALTER TABLE `surgery`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avatars`
--
ALTER TABLE `avatars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `customerpacks`
--
ALTER TABLE `customerpacks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;
--
-- AUTO_INCREMENT pour la table `material_liaison`
--
ALTER TABLE `material_liaison`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;
--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `patient_liaison`
--
ALTER TABLE `patient_liaison`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `questions_liaison`
--
ALTER TABLE `questions_liaison`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT pour la table `surgery`
--
ALTER TABLE `surgery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
