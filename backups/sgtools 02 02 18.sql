-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 02 fév. 2018 à 17:34
-- Version du serveur :  5.5.56-log
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

--
-- Déchargement des données de la table `avatars`
--

INSERT INTO `avatars` (`id`, `name`, `pack`) VALUES
(1, 'Nathalie', 1),
(2, 'Jean', 1),
(3, 'Emmanuel', 1),
(4, 'Marie', 1),
(5, 'Frederic', 1),
(6, 'Romain', 2);

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `mail` varchar(256) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`id`, `mail`, `password`, `admin`) VALUES
(1, 'zarnes@live.com', '$2y$10$mG1lcUhpscD4d2Rk/EjMFOhH/yNLN5ssL2y8dhsSPivsYAWB9oyeK', 1),
(2, 'pwet@live.com', '$2y$10$1bfN.gpxcCFfLJ1o8Zt.KelAHcR36eLONf2EwwULrgDgSIIp2urPq', 0);

-- --------------------------------------------------------

--
-- Structure de la table `customerpacks`
--

CREATE TABLE `customerpacks` (
  `id` int(10) UNSIGNED NOT NULL,
  `idCustomer` int(10) UNSIGNED NOT NULL,
  `idPack` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `customerpacks`
--

INSERT INTO `customerpacks` (`id`, `idCustomer`, `idPack`) VALUES
(1, 1, 1);

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

--
-- Déchargement des données de la table `material`
--

INSERT INTO `material` (`id`, `idCustomer`, `name`, `category`) VALUES
(4, 1, 'mat4', 'test'),
(6, 1, 'mat6', 'cat6'),
(7, 1, 'mat3', 'cat5'),
(13, 1, 'test ultime', 'test'),
(14, 1, 'test ultime premium', 'catégorie'),
(15, 1, 'le materiel ultiiime', 'test'),
(16, 2, 'Laryngo', 'réserve'),
(17, 2, 'test', 'réserve'),
(18, 2, 'test2', 'dossier d\'anesthésie');

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

--
-- Déchargement des données de la table `material_liaison`
--

INSERT INTO `material_liaison` (`id`, `idCustomer`, `idMaterial`, `spawnedBy`, `idSpawner`) VALUES
(3, 1, 4, 1, 1),
(12, 1, 13, 0, 1),
(13, 1, 15, 0, 1),
(16, 1, 13, 0, 2),
(17, 1, 4, 0, 1),
(18, 1, 6, 1, 2),
(19, 1, 4, 1, 2),
(20, 1, 13, 1, 2),
(21, 1, 4, 1, 3),
(22, 1, 6, 1, 3),
(35, 1, 7, 0, 2),
(36, 1, 7, 0, 1),
(37, 1, 6, 0, 1),
(38, 1, 4, 0, 3),
(39, 2, 16, 0, 4);

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
  `age` tinyint(3) UNSIGNED DEFAULT NULL,
  `height` smallint(4) UNSIGNED DEFAULT NULL,
  `weight` smallint(4) UNSIGNED DEFAULT NULL,
  `avatar` int(10) UNSIGNED NOT NULL,
  `story` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `idCustomer`, `lastname`, `firstname`, `sex`, `age`, `height`, `weight`, `avatar`, `story`) VALUES
(2, 1, 'Lopezzzzzzzzzz', 'Frederic', 0, 36, 176, 96, 5, 'Je possède beaucoup de z.'),
(3, 1, 'Barreau', 'Nathalie', 1, 26, 167, 72, 1, ''),
(5, 2, 'Doe', 'John', 0, 33, 175, 72, 5, '');

-- --------------------------------------------------------

--
-- Structure de la table `patient_liaison`
--

CREATE TABLE `patient_liaison` (
  `id` int(10) UNSIGNED NOT NULL,
  `idPatient` int(10) UNSIGNED NOT NULL,
  `idSurgery` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `patient_liaison`
--

INSERT INTO `patient_liaison` (`id`, `idPatient`, `idSurgery`) VALUES
(8, 3, 1),
(16, 2, 2),
(17, 2, 3),
(18, 5, 4);

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

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `idCustomer`, `name`, `question`, `answer`) VALUES
(5, 1, 'asthme', 'Souffrez vous de crise d\'asthme ?', 'Non, je n\'ai pas de crise d\'asthme'),
(6, 1, 'tabac', 'Etes vous à jeun du tabac ?', 'Je ne fume pas'),
(7, 1, 'lgo', 'Avez-vous des lgo ?', 'Non je n\'ai pas de lgo.'),
(8, 1, 'Vérification côté', 'De quel côté allez-vous être opéré ?', 'Heu... Pardon ?'),
(9, 2, 'asthme', 'Avez-vous de l\'asthme ?', 'Non je n\'en ai pas');

-- --------------------------------------------------------

--
-- Structure de la table `questions_liaison`
--

CREATE TABLE `questions_liaison` (
  `id` int(10) UNSIGNED NOT NULL,
  `idQuestion` int(10) UNSIGNED NOT NULL,
  `answer` text NOT NULL,
  `spawnedBy` tinyint(3) UNSIGNED NOT NULL COMMENT '0=>surgery, 1=>patient',
  `idSpawner` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `questions_liaison`
--

INSERT INTO `questions_liaison` (`id`, `idQuestion`, `answer`, `spawnedBy`, `idSpawner`) VALUES
(1, 5, 'Oui oui asthme lulzdfjkslhfjk', 0, 1),
(2, 5, 'oui asthme lala', 1, 1),
(5, 7, 'Oui LGO newnewnew', 0, 2),
(8, 5, 'oui asthme lala', 1, 3),
(9, 6, 'la cartouche', 1, 3),
(17, 6, '', 0, 2),
(19, 6, 'la cartouche', 1, 2),
(21, 5, 'oui asthme lala', 1, 2),
(22, 8, 'Je suis opéré du genou gauche.', 1, 2),
(24, 5, 'Oui oui asthme lulzdfjkslhfjk', 0, 3),
(25, 9, 'Oui tout les mois', 0, 4),
(26, 8, 'Coté gaiche', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `surgery`
--

CREATE TABLE `surgery` (
  `id` int(10) UNSIGNED NOT NULL,
  `idCustomer` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `emergency` tinyint(1) NOT NULL,
  `story` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `surgery`
--

INSERT INTO `surgery` (`id`, `idCustomer`, `name`, `emergency`, `story`) VALUES
(1, 1, 'Césarienne en urgence', 1, 'deprecated'),
(2, 1, 'Chirurgie 2', 0, 'story 2'),
(3, 1, 'Chirurgie', 1, 'blablabla'),
(4, 2, 'Chirurgie pwet', 0, 'deprecated');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `customerpacks`
--
ALTER TABLE `customerpacks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=405;
--
-- AUTO_INCREMENT pour la table `material_liaison`
--
ALTER TABLE `material_liaison`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `patient_liaison`
--
ALTER TABLE `patient_liaison`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `questions_liaison`
--
ALTER TABLE `questions_liaison`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pour la table `surgery`
--
ALTER TABLE `surgery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
