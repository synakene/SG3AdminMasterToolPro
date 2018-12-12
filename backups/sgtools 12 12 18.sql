-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 12 déc. 2018 à 15:50
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
  `apikey` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `lastLogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`id`, `mail`, `apikey`, `password`, `admin`, `lastLogin`) VALUES
(1, 'zarnes@live.com', '4H534-5J1FX-BFHZW-DEVRE', '$2y$10$mG1lcUhpscD4d2Rk/EjMFOhH/yNLN5ssL2y8dhsSPivsYAWB9oyeK', 1, '2018-12-12 13:47:34'),
(2, 'rouen@test', 'TFMW9-F4VV1-X2CGS-G32SY', '$2y$10$Eq1OqJnm9NObWIB8x07F9.aKWaUcaPtmhCFMcgMbhKpppD9rAFWNS', 0, '2018-11-28 11:35:54'),
(3, 'support@synakene.fr', '4H534-5J1FX-BFHZW-DEVRE', '$2y$10$JOrGy7nDqeTTdzrz.eqn4.Fz/k4sXqZmK1UeOPq.TrinvxGew7X0G', 1, '2018-12-06 10:25:52'),
(4, 'clebreton@synakene.fr', 'TFMW9-F4VV1-X2CGS-G32SY', '$2y$10$7HeZrlMA61uRjfHTheEEj.eI6n/Q31lammHSvwoZj2uTThQKOTV/6', 0, '2018-12-06 10:01:55'),
(5, '', '', 'invalid', 0, '0000-00-00 00:00:00'),
(6, 'brest@test', 'A92ST-FTCNJ-5R26C-KR946', '$2y$10$0IA1T9ebUrQMVC4gE7xBX.JpcgVbxRrMjB4CFL3AHSKfg0acGMI4K', 0, '0000-00-00 00:00:00');

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
(2, 1, 1),
(3, 2, 1),
(4, 3, 1),
(5, 3, 2),
(6, 1, 2),
(7, 4, 1),
(8, 6, 1);

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
(1, 2, 'Plateau césarienne (produits d\'anesthésie)', 'Réfrigérateur'),
(3, 2, 'Laryngoscope manche court', 'Matériel'),
(4, 2, 'Pince de Magill petite', 'Matériel'),
(5, 2, 'Mandrin semi-rigide', 'Matériel'),
(6, 2, 'Canules de Guedel n° 2, 3, 4, ...', 'Matériel'),
(7, 2, 'Sonde d\'intubation 6', 'Matériel'),
(8, 2, 'Sonde d\'intubation 8', 'Matériel'),
(12, 2, 'Sonde Nim', 'Matériel'),
(13, 2, 'Masque laryngé 1', 'Matériel'),
(14, 2, 'Masque laryngé 2', 'Matériel'),
(15, 2, '2ème voie d\'abord', 'Chariot d\'anesthésie'),
(16, 2, 'Cathlon 16 G', 'Chariot d\'anesthésie'),
(17, 2, 'Dialaflow', 'Chariot d\'anesthésie'),
(18, 2, 'Rallonges tubulures', 'Chariot d\'anesthésie'),
(19, 2, 'Cristalloïde (NaCl 0,9%)', 'Médicaments'),
(20, 2, 'Capno tubulure longue', 'Matériel'),
(22, 2, 'Canule buccale (Yankoër)', 'Matériel'),
(23, 2, 'Réchauffeur - accélérateur de perfusion', 'Chariot d\'anesthésie'),
(24, 2, 'Hemocue', 'Chariot d\'anesthésie'),
(26, 2, 'Chariot IOT difficile', 'Matériel'),
(27, 2, 'Intralipides', 'Médicaments'),
(28, 2, 'Chariot ALR + échographe', 'Chariot d\'anesthésie'),
(29, 2, 'Billot sous scapulaire', 'Chariot d\'anesthésie'),
(30, 2, 'BIS (index bispectral)', 'Chariot d\'anesthésie'),
(32, 2, 'Têtière', 'Chariot d\'anesthésie'),
(33, 2, 'Billot fesse', 'Chariot d\'anesthésie'),
(34, 2, 'Rouleau adhésif fixation', 'Chariot d\'anesthésie'),
(35, 2, 'Billot thoracique', 'Chariot d\'anesthésie'),
(37, 2, 'Sulprostone', 'Réfrigérateur'),
(38, 2, 'G5% 500ml', 'Médicaments'),
(40, 2, 'HEA (Restorvol®)', 'Médicaments'),
(42, 2, 'Sonde gastrique', 'Chariot d\'anesthésie'),
(43, 2, 'Protection oculaire renforcée', 'Chariot d\'anesthésie'),
(44, 2, 'Tuyaux longs respirateur', 'Matériel'),
(45, 2, 'Acide tranexamique', 'Médicaments'),
(46, 2, 'Adrénaline', 'Médicaments'),
(47, 2, 'Antibiotique', 'Médicaments'),
(48, 2, 'Anticonvulsivants', 'Médicaments'),
(50, 2, 'Atropine', 'Médicaments'),
(51, 2, 'Dexamethasone', 'Médicaments'),
(52, 2, 'Dropéridol', 'Médicaments'),
(53, 2, 'Ephédrine®', 'Médicaments'),
(54, 2, 'Hypnomidate', 'Médicaments'),
(55, 2, 'Néostigmine', 'Médicaments'),
(56, 2, 'Noradrénaline', 'Médicaments'),
(57, 2, 'Phenyléphrine', 'Médicaments'),
(58, 2, 'Propofol', 'Médicaments'),
(59, 2, 'Ranitidine effervescent', 'Médicaments'),
(60, 2, 'Salbutamol nébuliseur', 'Médicaments'),
(61, 2, 'Thiopental', 'Médicaments'),
(62, 2, 'Trinitrine nébuliseur', 'Médicaments'),
(63, 2, 'Anesthésique de contact (gel et spray de Xylocaïne)', 'Matériel'),
(64, 2, 'Cale-bouche', 'Matériel'),
(66, 2, 'Ciseaux', 'Matériel'),
(67, 2, 'Fixation sparadrap, cordon', 'Matériel'),
(68, 2, 'Laryngoscope manche long', 'Matériel'),
(69, 2, 'Masque laryngé 4', 'Matériel'),
(70, 2, 'Piles', 'Chariot d\'anesthésie'),
(71, 2, 'Mandrin d\'Eschmann', 'Matériel'),
(72, 2, 'Prolongateur à O2', 'Matériel'),
(74, 2, 'Sondes d\'aspiration (12,14,16 et 18 G)', 'Matériel'),
(75, 2, 'Sonde d\'intubation 7,5', 'Matériel'),
(76, 2, 'Sonde d\'intubation armée 6', 'Matériel'),
(77, 2, 'Sondes O2 nasales', 'Matériel'),
(78, 2, 'Aiguilles et seringues (5, 10, 20 et 50 ml)', 'Chariot d\'anesthésie'),
(79, 2, 'Antiseptique', 'Chariot d\'anesthésie'),
(80, 2, 'Cathéters périphériques 20, 18 et 16 Gauges', 'Chariot d\'anesthésie'),
(81, 2, 'Garrot, compresses', 'Chariot d\'anesthésie'),
(82, 2, 'Nécessaire à prélèvement (Gaz du sang, Ionogramme, Numération formule sanguine, groupage...)', 'Chariot d\'anesthésie'),
(83, 2, 'Pansements occlusifs transparents', 'Chariot d\'anesthésie'),
(84, 2, 'Prolongateurs de perfusion', 'Chariot d\'anesthésie'),
(86, 2, 'Bicarbonate de Sodium à 8,4% ', 'Médicaments'),
(88, 2, 'Gélatine 500 ml', 'Médicaments'),
(90, 2, 'Cristalloïde (Isofundine® 500 ml)', 'Médicaments'),
(92, 2, 'Cristalloïde (Ringer Lactate)', 'Médicaments'),
(93, 2, 'Gants à usage unique non stériles', 'Matériel'),
(94, 2, 'Pince de Kocher', 'Chariot d\'anesthésie'),
(95, 2, 'Protection oculaire (collyre, vit A...)', 'Chariot d\'anesthésie'),
(96, 2, 'Solution hydro-alcoolique', 'Chariot d\'anesthésie'),
(98, 2, 'Masque laryngé 3', 'Matériel'),
(99, 2, 'Raccords annelés et filtres antibactériens', 'Matériel'),
(100, 2, 'Electrodes', 'Chariot d\'anesthésie'),
(101, 2, 'Brassards à tension de différentes tailles', 'Chariot d\'anesthésie'),
(102, 2, 'Sonde thermique', 'Chariot d\'anesthésie'),
(103, 2, 'Lame courbe 4', 'Matériel'),
(104, 2, 'Lame droite 0', 'Matériel'),
(106, 2, 'Pince de Magill moyenne', 'Matériel'),
(108, 2, 'Protège-dents', 'Matériel'),
(109, 2, 'Sondes d\'intubation préformées différentes tailles', 'Matériel'),
(112, 2, 'Masque laryngé 5', 'Matériel'),
(113, 2, 'Fastrach®', 'Matériel'),
(114, 2, 'Set d\'intubation rétrograde', 'Matériel'),
(115, 2, 'Set de cricothyroïdotomie', 'Matériel'),
(116, 2, 'Mandrin de Cook', 'Matériel'),
(117, 2, 'Alfentanyl', 'Médicaments'),
(118, 2, 'Fentanyl', 'Médicaments'),
(120, 2, 'Morphine', 'Médicaments'),
(121, 2, 'Rémifentanil', 'Médicaments'),
(122, 2, 'Sufentanil', 'Médicaments'),
(124, 2, 'Aspiration de secours', 'Chariot d\'anesthésie'),
(125, 2, 'Kit choc anaphylactique', 'Chariot d\'anesthésie'),
(126, 2, 'Hémoglucotest', 'Chariot d\'anesthésie'),
(127, 2, 'Kit hyperthermie maligne', 'Chariot d\'anesthésie'),
(128, 2, 'Matériel KTC', 'Chariot d\'anesthésie'),
(129, 2, 'Dispositif de compression veineuse intermittente', 'Chariot d\'anesthésie'),
(130, 2, 'Matériel d\'échographie', 'Chariot d\'anesthésie'),
(132, 2, 'Ampoules glucose 30 %', 'Médicaments'),
(133, 2, 'Atracurium', 'Réfrigérateur'),
(134, 2, 'Cisatracurium', 'Réfrigérateur'),
(135, 2, 'Rocuronium', 'Réfrigérateur'),
(136, 2, 'Suxamethonium', 'Réfrigérateur'),
(137, 2, 'Insuline rapide', 'Réfrigérateur'),
(138, 2, 'Isuprel', 'Réfrigérateur'),
(140, 2, 'Ocytocine', 'Réfrigérateur'),
(142, 2, 'Ketamine', 'Médicaments'),
(145, 2, 'ABTest (ou Sérum test)', 'Réfrigérateur'),
(151, 2, 'ECG 5 brins', 'Chariot d\'anesthésie'),
(153, 1, 'Test', 'Catégorie'),
(154, 4, 'Plateau césarienne', 'Réfrigérateur'),
(155, 4, 'Laryngoscope manche normal', 'Chariot d\'anesthésie'),
(156, 4, 'Laryngoscope manche court', 'Chariot d\'anesthésie'),
(157, 4, 'Magyll', 'Chariot d\'anesthésie'),
(158, 4, 'Mandrin semi-rigide', 'Chariot d\'anesthésie'),
(159, 4, 'Canules de Guedel', 'Chariot d\'anesthésie'),
(160, 4, 'Sondes IOT 6.5', 'Chariot d\'anesthésie'),
(161, 4, 'Sondes IOT 7', 'Chariot d\'anesthésie'),
(162, 4, 'Sondes IOT 7.5', 'Chariot d\'anesthésie'),
(163, 4, 'Sondes IOT armée 7', 'Chariot d\'anesthésie'),
(164, 4, 'Sondes IOT armée 7.5', 'Chariot d\'anesthésie'),
(165, 4, 'Sondes Nim', 'Chariot d\'anesthésie'),
(166, 4, 'Masque laryngé 4', 'Chariot d\'anesthésie'),
(167, 4, 'Masque laryngé 5', 'Chariot d\'anesthésie'),
(168, 4, '2ème voie d\'abord', 'Chariot d\'anesthésie'),
(169, 4, 'Cathlon 16 G', 'Chariot d\'anesthésie'),
(170, 4, 'Dialaflow', 'Chariot d\'anesthésie'),
(171, 4, 'Rallonges tubulures', 'Chariot d\'anesthésie'),
(172, 4, 'Nacl 9%o', 'Chariot d\'anesthésie'),
(173, 4, 'Capno tubulure longue', 'Tiroir Respirateur'),
(174, 4, 'Curamètre', 'Tiroir Respirateur'),
(175, 4, 'Canule buccale', 'Tiroir Respirateur'),
(176, 4, 'Réchauffeur - accélérateur de perfusion', 'Matériel'),
(177, 4, 'Hemocue', 'Matériel'),
(178, 4, 'Glucotest', 'Matériel'),
(179, 4, 'Chariot IOT difficile', 'Matériel'),
(180, 4, 'Intralipides', 'Médicaments'),
(181, 4, 'Chariot ALR+ échographe', 'Matériel'),
(182, 4, 'Billot sous scapulaire', 'Matériel'),
(183, 4, 'BIS', 'Matériel'),
(184, 4, 'Exacyl', 'Matériel'),
(185, 4, 'Têtière', 'Matériel'),
(186, 4, 'Billot fesse', 'Matériel'),
(187, 4, 'Rouleau adhésif fixation', 'Matériel'),
(188, 4, 'Billot thoracique', 'Matériel'),
(189, 4, 'Sérum test', 'Réfrigérateur'),
(190, 4, 'Nalador', 'Réfrigérateur'),
(191, 4, 'G5%', 'Chariot d\'anesthésie'),
(192, 4, 'Isofondine', 'Chariot d\'anesthésie'),
(193, 4, 'Restorvol', 'Chariot d\'anesthésie'),
(194, 4, 'Gelofusine', 'Chariot d\'anesthésie'),
(195, 4, 'Sonde gastrique', 'Chariot d\'anesthésie'),
(196, 4, 'Protection oculaire renforcée', 'Chariot d\'anesthésie'),
(197, 4, 'Tuyaux longs respirateur', 'Tiroir Respirateur'),
(198, 4, 'Acide tranexamique', 'Chariot d\'anesthésie'),
(199, 4, 'Adrénaline', 'Chariot d\'anesthésie'),
(200, 4, 'Antibiotique', 'Chariot d\'anesthésie'),
(201, 4, 'Anticonvulsivants', 'Chariot d\'anesthésie'),
(202, 4, 'Antalgiques', 'Chariot d\'anesthésie'),
(203, 4, 'Atropine', 'Chariot d\'anesthésie'),
(204, 4, 'Dexamethasone', 'Chariot d\'anesthésie'),
(205, 4, 'Dropéridol', 'Chariot d\'anesthésie'),
(206, 4, 'Ephédrine', 'Chariot d\'anesthésie'),
(207, 4, 'Hypnomidate', 'Chariot d\'anesthésie'),
(208, 4, 'Néostigmine', 'Chariot d\'anesthésie'),
(209, 4, 'Noradrénaline', 'Chariot d\'anesthésie'),
(210, 4, 'Phenyléphrine', 'Chariot d\'anesthésie'),
(211, 4, 'Propofol', 'Chariot d\'anesthésie'),
(212, 4, 'Ranitidine', 'Chariot d\'anesthésie'),
(213, 4, 'Salbutamol nébuliseur', 'Chariot d\'anesthésie'),
(214, 4, 'Thiopental', 'Chariot d\'anesthésie'),
(215, 4, 'Trinitrine nébuliseur', 'Chariot d\'anesthésie'),
(216, 4, 'Anesthésique de contact (gel et spray de Xylocaïne)', 'Chariot d\'anesthésie'),
(217, 4, 'Cale-bouche', 'Chariot d\'anesthésie'),
(218, 4, 'Canules de Guedel n° 2, 3, 4, ...', 'Chariot d\'anesthésie'),
(219, 4, 'Ciseaux', 'Chariot d\'anesthésie'),
(220, 4, 'Fixation sparadrap, cordon', 'Chariot d\'anesthésie'),
(221, 4, 'Laryngoscope manche long, laryngoscope manche courte avec deux lames 3 et 4 en état de marche à usage unique', 'Chariot d\'anesthésie'),
(222, 4, 'Masques laryngés n° 3, 4, 5', 'Chariot d\'anesthésie'),
(223, 4, 'Piles', 'Chariot d\'anesthésie'),
(224, 4, 'Pince de Magyll et mandrin', 'Chariot d\'anesthésie'),
(225, 4, 'Prolongateur à O2', 'Chariot d\'anesthésie'),
(226, 4, 'Raccords annelés', 'Chariot d\'anesthésie'),
(227, 4, 'Sondes à aspiration (12,14,16 et 18 G)', 'Chariot d\'anesthésie'),
(228, 4, 'Sondes d\'intubation : 6 - 6,5 - 7 - 7,5', 'Chariot d\'anesthésie'),
(229, 4, 'Sondes d\'intubation armées : 6 - 6,5 - 7 - 7,5', 'Chariot d\'anesthésie'),
(230, 4, 'Sondes O2 nasales', 'Chariot d\'anesthésie'),
(231, 4, 'Aiguilles et seringues (5, 10, 20 et 50 ml)', 'Chariot d\'anesthésie'),
(232, 4, 'Antiseptique à large spectre d\'action rapide', 'Chariot d\'anesthésie'),
(233, 4, 'Cathéters périphériques 20, 18 et 16 Gauges', 'Chariot d\'anesthésie'),
(234, 4, 'Garrot, compresses', 'Chariot d\'anesthésie'),
(235, 4, 'Nécessaire à prélèvement (Gaz du sang, Ionogramme, Numération formule sanguine, groupage...)', 'Chariot d\'anesthésie'),
(236, 4, 'Pansements occlusifs transparents, bande adhésive', 'Chariot d\'anesthésie'),
(237, 4, 'Robinets à 3 voies, prolongateurs de perfusion', 'Chariot d\'anesthésie'),
(238, 4, 'Tubulures à perfusion avec valves anti-retour', 'Chariot d\'anesthésie'),
(239, 4, 'Bicarbonate de Sodium à 8,4% ', 'Chariot d\'anesthésie'),
(240, 4, 'Chlorure de Sodium 500 ml', 'Chariot d\'anesthésie'),
(241, 4, 'Gélofusine (Gélatine) 500 ml', 'Chariot d\'anesthésie'),
(242, 4, 'Glucose à 5% 500 ml', 'Médicaments'),
(243, 4, 'Isofondine 500 ml', 'Chariot d\'anesthésie'),
(244, 4, 'Restorvol 500 ml', 'Chariot d\'anesthésie'),
(245, 4, 'Ringer Lactate 500 ml', 'Chariot d\'anesthésie'),
(246, 4, 'Gants à usage unique non stériles', 'Chariot d\'anesthésie'),
(247, 4, 'Pince de Kocher', 'Chariot d\'anesthésie'),
(248, 4, 'Protection oculaire (collyre, vit A...)', 'Chariot d\'anesthésie'),
(249, 4, 'Solution hydro-alcoolique', 'Chariot d\'anesthésie'),
(250, 4, 'Sondes gastriques (14, 16, 18 Ch)', 'Chariot d\'anesthésie'),
(251, 4, 'Masques faciaux de différentes tailles', 'Chariot d\'anesthésie'),
(252, 4, 'Raccords annelés et filtres antibactériens', 'Chariot d\'anesthésie'),
(253, 4, 'Electrodes', 'Chariot d\'anesthésie'),
(254, 4, 'Brassard à tension de différentes tailles', 'Chariot d\'anesthésie'),
(255, 4, 'Sondes thermiques', 'Chariot d\'anesthésie'),
(256, 4, 'Lames Mac Intosh 2,3,4', 'Matériel'),
(257, 4, 'Lames Miller 2,3', 'Matériel'),
(258, 4, 'Manche laryngo court', 'Matériel'),
(259, 4, 'Pinces de Magill petite, moyenne, grande', 'Matériel'),
(260, 4, 'Pince en coeur', 'Matériel'),
(261, 4, 'Protège-dents', 'Matériel'),
(262, 4, 'Sondes d\'intubation préformées différentes tailles', 'Matériel'),
(263, 4, 'Sondes d\'intubation armées différentes tailles', 'Matériel'),
(264, 4, 'Mandrin pour sonde d\'intubation', 'Matériel'),
(265, 4, 'Masques laryngés toutes tailles', 'Matériel'),
(266, 4, 'Fastrach', 'Matériel'),
(267, 4, 'Set d\'intubation rétrograde', 'Matériel'),
(268, 4, 'Set de cricothyrotomie', 'Matériel'),
(269, 4, 'Mandrin de Cook', 'Matériel'),
(270, 4, 'Alfentanyl', 'Médicaments'),
(271, 4, 'Fentanyl', 'Médicaments'),
(272, 4, 'Kétamine', 'Matériel'),
(273, 4, 'Morphine', 'Médicaments'),
(274, 4, 'Rémifentanyl', 'Médicaments'),
(275, 4, 'Sufentanyl', 'Matériel'),
(276, 4, 'Chariot ALR / Intralipides', 'Matériel'),
(277, 4, 'Aspiration de secours', 'Matériel'),
(278, 4, 'Kit choc anaphylactique', 'Matériel'),
(279, 4, 'Hémoglucotest', 'Matériel'),
(280, 4, 'Kit hyperthermie maligne', 'Matériel'),
(281, 4, 'Matériel KTC KTA / Câbles', 'Matériel'),
(282, 4, 'Dispositif de compression veineuse pneumatique intermittente', 'Matériel'),
(283, 4, 'Matériel d\'échographie', 'Matériel'),
(284, 4, 'Index bispectral', 'Matériel'),
(285, 4, 'Ampoules glucose 30 %', 'Matériel'),
(286, 4, 'Atracurium', 'Réfrigérateur'),
(287, 4, 'Cisatracurium', 'Réfrigérateur'),
(288, 4, 'Rocuronium', 'Réfrigérateur'),
(289, 4, 'Suxamethonium', 'Réfrigérateur'),
(290, 4, 'Insuline rapide', 'Réfrigérateur'),
(291, 4, 'Isuprel', 'Réfrigérateur'),
(292, 4, 'Nalador ®', 'Réfrigérateur'),
(293, 4, 'Ocytocine', 'Réfrigérateur'),
(294, 4, 'Solutés', 'Réfrigérateur'),
(295, 4, 'Ketamine', 'Médicaments'),
(296, 4, 'Sulfentanyl', 'Médicaments'),
(297, 4, 'Aspirateur buccale', 'Matériel'),
(298, 4, 'ABTest', 'Réfrigérateur'),
(299, 4, 'Syntocinon', 'Réfrigérateur'),
(300, 4, 'SNG', 'Matériel'),
(301, 4, 'Canule yankoer', 'Tiroir Respirateur'),
(302, 4, 'Occulaire renforcé', 'Matériel'),
(303, 4, 'Scotch', 'Matériel'),
(304, 4, 'ECG 5 brins', 'Tiroir Respirateur'),
(306, 2, 'Curamètre', 'Chariot d\'anesthésie'),
(307, 2, 'Lame courbe 1', 'Matériel'),
(308, 2, 'Lame courbe 2', 'Matériel'),
(309, 2, 'Lame courbe 3', 'Matériel'),
(311, 2, 'Lame droite 1', 'Matériel'),
(312, 2, 'Lame droite 2', 'Matériel'),
(313, 2, 'Lame droite 3', 'Matériel'),
(314, 2, 'Matériel KTA / cables', 'Chariot d\'anesthésie'),
(315, 2, 'Pince de Magill grande', 'Matériel'),
(317, 2, 'Sonde d\'intubation 7', 'Matériel'),
(319, 2, 'Sonde d\'intubation 6,5', 'Matériel'),
(321, 2, 'Sonde d\'intubation armée 6,5', 'Matériel'),
(322, 2, 'Sonde d\'intubation armée 7', 'Matériel'),
(323, 2, 'Sonde d\'intubation armée 7,5', 'Matériel'),
(324, 2, 'Sonde d\'intubation armée 8', 'Matériel'),
(325, 2, 'Cristalloïde (Isofundine® ou NaCl)', 'Médicaments'),
(326, 2, 'Sonde d\'intubation armée ( toutes tailles)', 'Matériel'),
(327, 6, 'Plateau césarienne (produits d\'anesthésie)', 'Réfrigérateur'),
(328, 6, 'Laryngoscope manche court', 'Chariot d\'anesthésie'),
(329, 6, 'Pince de Magill petite', 'Chariot d\'anesthésie'),
(330, 6, 'Mandrin semi-rigide', 'Chariot d\'anesthésie'),
(331, 6, 'Canules de Guedel n° 2, 3, 4, ...', 'Chariot d\'anesthésie'),
(332, 6, 'Sonde d\'intubation 6', 'Chariot d\'anesthésie'),
(333, 6, 'Sonde d\'intubation 8', 'Chariot d\'anesthésie'),
(334, 6, 'Sonde Nim', 'Matériel'),
(335, 6, 'Masque laryngé 1', 'Chariot d\'anesthésie'),
(336, 6, 'Masque laryngé 2', 'Chariot d\'anesthésie'),
(337, 6, '2ème voie d\'abord', 'Chariot d\'anesthésie'),
(338, 6, 'Cathlon 16 G', 'Chariot d\'anesthésie'),
(339, 6, 'Dialaflow', 'Chariot d\'anesthésie'),
(340, 6, 'Rallonges tubulures', 'Chariot d\'anesthésie'),
(341, 6, 'Cristalloïde (NaCl 0,9%)', 'Chariot d\'anesthésie'),
(342, 6, 'Capno tubulure longue', 'Tiroir Respirateur'),
(343, 6, 'Canule buccale (Yankoër)', 'Tiroir Respirateur'),
(344, 6, 'Réchauffeur - accélérateur de perfusion', 'Matériel'),
(345, 6, 'Hemocue', 'Matériel'),
(346, 6, 'Chariot IOT difficile', 'Matériel'),
(347, 6, 'Intralipides', 'Médicaments'),
(348, 6, 'Chariot ALR + échographe', 'Matériel'),
(349, 6, 'Billot sous scapulaire', 'Matériel'),
(350, 6, 'BIS (index bispectral)', 'Matériel'),
(351, 6, 'Têtière', 'Matériel'),
(352, 6, 'Billot fesse', 'Matériel'),
(353, 6, 'Rouleau adhésif fixation', 'Matériel'),
(354, 6, 'Billot thoracique', 'Matériel'),
(355, 6, 'Sulprostone', 'Réfrigérateur'),
(356, 6, 'G5% 500ml', 'Chariot d\'anesthésie'),
(357, 6, 'HEA (Restorvol®)', 'Chariot d\'anesthésie'),
(358, 6, 'Sonde gastrique', 'Chariot d\'anesthésie'),
(359, 6, 'Protection oculaire renforcée', 'Chariot d\'anesthésie'),
(360, 6, 'Tuyaux longs respirateur', 'Tiroir Respirateur'),
(361, 6, 'Acide tranexamique', 'Chariot d\'anesthésie'),
(362, 6, 'Adrénaline', 'Chariot d\'anesthésie'),
(363, 6, 'Antibiotique', 'Chariot d\'anesthésie'),
(364, 6, 'Anticonvulsivants', 'Chariot d\'anesthésie'),
(365, 6, 'Atropine', 'Chariot d\'anesthésie'),
(366, 6, 'Dexamethasone', 'Chariot d\'anesthésie'),
(367, 6, 'Dropéridol', 'Chariot d\'anesthésie'),
(368, 6, 'Ephédrine®', 'Chariot d\'anesthésie'),
(369, 6, 'Hypnomidate', 'Chariot d\'anesthésie'),
(370, 6, 'Néostigmine', 'Chariot d\'anesthésie'),
(371, 6, 'Noradrénaline', 'Chariot d\'anesthésie'),
(372, 6, 'Phenyléphrine', 'Chariot d\'anesthésie'),
(373, 6, 'Propofol', 'Chariot d\'anesthésie'),
(374, 6, 'Ranitidine effervescent', 'Chariot d\'anesthésie'),
(375, 6, 'Salbutamol nébuliseur', 'Chariot d\'anesthésie'),
(376, 6, 'Thiopental', 'Chariot d\'anesthésie'),
(377, 6, 'Trinitrine nébuliseur', 'Chariot d\'anesthésie'),
(378, 6, 'Anesthésique de contact (gel et spray de Xylocaïne)', 'Chariot d\'anesthésie'),
(379, 6, 'Cale-bouche', 'Chariot d\'anesthésie'),
(380, 6, 'Ciseaux', 'Chariot d\'anesthésie'),
(381, 6, 'Fixation sparadrap, cordon', 'Chariot d\'anesthésie'),
(382, 6, 'Laryngoscope manche long', 'Chariot d\'anesthésie'),
(383, 6, 'Masque laryngé 4', 'Chariot d\'anesthésie'),
(384, 6, 'Piles', 'Chariot d\'anesthésie'),
(385, 6, 'Mandrin d\'Eschmann', 'Chariot d\'anesthésie'),
(386, 6, 'Prolongateur à O2', 'Chariot d\'anesthésie'),
(387, 6, 'Sondes d\'aspiration (12,14,16 et 18 G)', 'Chariot d\'anesthésie'),
(388, 6, 'Sonde d\'intubation 7,5', 'Chariot d\'anesthésie'),
(389, 6, 'Sonde d\'intubation armée 6', 'Chariot d\'anesthésie'),
(390, 6, 'Sondes O2 nasales', 'Chariot d\'anesthésie'),
(391, 6, 'Aiguilles et seringues (5, 10, 20 et 50 ml)', 'Chariot d\'anesthésie'),
(392, 6, 'Antiseptique', 'Chariot d\'anesthésie'),
(393, 6, 'Cathéters périphériques 20, 18 et 16 Gauges', 'Chariot d\'anesthésie'),
(394, 6, 'Garrot, compresses', 'Chariot d\'anesthésie'),
(395, 6, 'Nécessaire à prélèvement (Gaz du sang, Ionogramme, Numération formule sanguine, groupage...)', 'Chariot d\'anesthésie'),
(396, 6, 'Pansements occlusifs transparents', 'Chariot d\'anesthésie'),
(397, 6, 'Prolongateurs de perfusion', 'Chariot d\'anesthésie'),
(398, 6, 'Bicarbonate de Sodium à 8,4% ', 'Chariot d\'anesthésie'),
(399, 6, 'Gélatine 500 ml', 'Chariot d\'anesthésie'),
(400, 6, 'Cristalloïde (Isofundine® 500 ml)', 'Chariot d\'anesthésie'),
(401, 6, 'Cristalloïde (Ringer Lactate)', 'Chariot d\'anesthésie'),
(402, 6, 'Gants à usage unique non stériles', 'Chariot d\'anesthésie'),
(403, 6, 'Pince de Kocher', 'Chariot d\'anesthésie'),
(404, 6, 'Protection oculaire (collyre, vit A...)', 'Chariot d\'anesthésie'),
(405, 6, 'Solution hydro-alcoolique', 'Chariot d\'anesthésie'),
(406, 6, 'Masque laryngé 3', 'Chariot d\'anesthésie'),
(407, 6, 'Raccords annelés et filtres antibactériens', 'Chariot d\'anesthésie'),
(408, 6, 'Electrodes', 'Chariot d\'anesthésie'),
(409, 6, 'Brassards à tension de différentes tailles', 'Chariot d\'anesthésie'),
(410, 6, 'Sonde thermique', 'Chariot d\'anesthésie'),
(411, 6, 'Lame courbe 4', 'Matériel'),
(412, 6, 'Lame droite 0', 'Matériel'),
(413, 6, 'Pince de Magill moyenne', 'Chariot d\'anesthésie'),
(414, 6, 'Protège-dents', 'Matériel'),
(415, 6, 'Sondes d\'intubation préformées différentes tailles', 'Matériel'),
(416, 6, 'Masque laryngé 5', 'Chariot d\'anesthésie'),
(417, 6, 'Fastrach®', 'Matériel'),
(418, 6, 'Set d\'intubation rétrograde', 'Matériel'),
(419, 6, 'Set de cricothyroïdotomie', 'Matériel'),
(420, 6, 'Mandrin de Cook', 'Matériel'),
(421, 6, 'Alfentanyl', 'Médicaments'),
(422, 6, 'Fentanyl', 'Médicaments'),
(423, 6, 'Morphine', 'Médicaments'),
(424, 6, 'Rémifentanil', 'Médicaments'),
(425, 6, 'Sufentanil', 'Médicaments'),
(426, 6, 'Aspiration de secours', 'Matériel'),
(427, 6, 'Kit choc anaphylactique', 'Matériel'),
(428, 6, 'Hémoglucotest', 'Matériel'),
(429, 6, 'Kit hyperthermie maligne', 'Matériel'),
(430, 6, 'Matériel KTC', 'Matériel'),
(431, 6, 'Dispositif de compression veineuse intermittente', 'Matériel'),
(432, 6, 'Matériel d\'échographie', 'Matériel'),
(433, 6, 'Ampoules glucose 30 %', 'Matériel'),
(434, 6, 'Atracurium', 'Réfrigérateur'),
(435, 6, 'Cisatracurium', 'Réfrigérateur'),
(436, 6, 'Rocuronium', 'Réfrigérateur'),
(437, 6, 'Suxamethonium', 'Réfrigérateur'),
(438, 6, 'Insuline rapide', 'Réfrigérateur'),
(439, 6, 'Isuprel', 'Réfrigérateur'),
(440, 6, 'Ocytocine', 'Réfrigérateur'),
(441, 6, 'Ketamine', 'Médicaments'),
(442, 6, 'ABTest (ou Sérum test)', 'Réfrigérateur'),
(443, 6, 'ECG 5 brins', 'Tiroir Respirateur'),
(444, 6, 'Curamètre', 'Tiroir Respirateur'),
(445, 6, 'Lame courbe 1', 'Matériel'),
(446, 6, 'Lame courbe 2', 'Matériel'),
(447, 6, 'Lame courbe 3', 'Matériel'),
(448, 6, 'Lame droite 1', 'Matériel'),
(449, 6, 'Lame droite 2', 'Matériel'),
(450, 6, 'Lame droite 3', 'Matériel'),
(451, 6, 'Matériel KTA / cables', 'Matériel'),
(452, 6, 'Pince de Magill grande', 'Chariot d\'anesthésie'),
(453, 6, 'Sonde d\'intubation 7', 'Chariot d\'anesthésie'),
(454, 6, 'Sonde d\'intubation 6,5', 'Chariot d\'anesthésie'),
(455, 6, 'Sonde d\'intubation armée 6,5', 'Chariot d\'anesthésie'),
(456, 6, 'Sonde d\'intubation armée 7', 'Chariot d\'anesthésie'),
(457, 6, 'Sonde d\'intubation armée 7,5', 'Chariot d\'anesthésie'),
(458, 6, 'Sonde d\'intubation armée 8', 'Chariot d\'anesthésie'),
(459, 6, 'Cristalloïde (Isofundine® ou NaCl)', 'Chariot d\'anesthésie'),
(460, 6, 'Sonde d\'intubation armée ( toutes tailles)', 'Chariot d\'anesthésie');

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
(1, 2, 1, 1, 1),
(4, 2, 3, 1, 1),
(40, 2, 151, 1, 4),
(41, 2, 30, 1, 4),
(43, 2, 102, 1, 4),
(51, 2, 3, 0, 1),
(54, 2, 16, 0, 1),
(56, 2, 40, 0, 1),
(59, 2, 24, 0, 1),
(60, 2, 33, 0, 1),
(61, 2, 1, 0, 1),
(62, 2, 145, 0, 1),
(63, 2, 140, 0, 1),
(69, 2, 15, 0, 2),
(70, 2, 16, 0, 2),
(75, 2, 102, 0, 2),
(76, 2, 23, 0, 2),
(77, 2, 24, 0, 2),
(79, 2, 145, 0, 2),
(83, 2, 27, 0, 3),
(84, 2, 28, 0, 3),
(85, 2, 32, 0, 3),
(87, 2, 35, 0, 4),
(88, 2, 15, 0, 4),
(90, 2, 40, 0, 4),
(91, 2, 23, 0, 4),
(92, 2, 24, 0, 4),
(93, 2, 45, 0, 4),
(94, 2, 145, 0, 4),
(95, 2, 20, 0, 5),
(97, 2, 12, 0, 5),
(100, 2, 44, 0, 5),
(102, 2, 3, 1, 6),
(104, 2, 5, 1, 6),
(106, 2, 26, 1, 6),
(107, 2, 59, 1, 6),
(109, 2, 17, 1, 6),
(110, 2, 19, 1, 6),
(111, 2, 38, 1, 6),
(114, 2, 30, 1, 6),
(115, 4, 154, 1, 7),
(116, 4, 176, 1, 7),
(117, 4, 181, 1, 7),
(118, 4, 156, 1, 7),
(119, 4, 157, 1, 7),
(120, 4, 160, 1, 7),
(121, 4, 161, 1, 7),
(122, 4, 188, 1, 7),
(123, 4, 162, 1, 7),
(124, 4, 174, 1, 7),
(125, 4, 194, 1, 7),
(126, 4, 195, 1, 7),
(127, 4, 155, 1, 8),
(128, 4, 194, 1, 8),
(129, 4, 257, 1, 8),
(130, 4, 159, 1, 8),
(131, 4, 162, 1, 8),
(132, 4, 192, 1, 8),
(133, 4, 193, 1, 8),
(134, 4, 155, 1, 9),
(135, 4, 157, 1, 9),
(136, 4, 161, 1, 9),
(137, 4, 257, 1, 9),
(138, 4, 159, 1, 9),
(139, 4, 192, 1, 9),
(140, 4, 193, 1, 9),
(141, 4, 304, 1, 9),
(142, 4, 183, 1, 9),
(143, 4, 172, 1, 9),
(144, 4, 255, 1, 9),
(145, 4, 155, 1, 10),
(146, 4, 257, 1, 10),
(147, 4, 256, 1, 10),
(148, 4, 159, 1, 10),
(149, 4, 162, 1, 10),
(150, 4, 192, 1, 10),
(151, 4, 194, 1, 10),
(152, 4, 156, 1, 11),
(153, 4, 257, 1, 11),
(154, 4, 158, 1, 11),
(155, 4, 159, 1, 11),
(156, 4, 179, 1, 11),
(157, 4, 212, 1, 11),
(158, 4, 162, 1, 11),
(159, 4, 170, 1, 11),
(160, 4, 172, 1, 11),
(161, 4, 191, 1, 11),
(162, 4, 300, 1, 11),
(163, 4, 178, 1, 11),
(164, 4, 183, 1, 11),
(165, 4, 156, 0, 7),
(166, 4, 257, 0, 7),
(167, 4, 259, 0, 7),
(168, 4, 169, 0, 7),
(169, 4, 172, 0, 7),
(170, 4, 193, 0, 7),
(171, 4, 194, 0, 7),
(172, 4, 297, 0, 7),
(173, 4, 177, 0, 7),
(174, 4, 186, 0, 7),
(175, 4, 154, 0, 7),
(176, 4, 298, 0, 7),
(177, 4, 293, 0, 7),
(178, 4, 299, 0, 7),
(179, 4, 174, 0, 7),
(180, 4, 301, 0, 7),
(181, 4, 257, 0, 8),
(182, 4, 162, 0, 8),
(183, 4, 168, 0, 8),
(184, 4, 169, 0, 8),
(185, 4, 172, 0, 8),
(186, 4, 192, 0, 8),
(187, 4, 300, 0, 8),
(188, 4, 174, 0, 8),
(189, 4, 255, 0, 8),
(190, 4, 176, 0, 8),
(191, 4, 177, 0, 8),
(192, 4, 183, 0, 8),
(193, 4, 298, 0, 8),
(194, 4, 183, 0, 9),
(195, 4, 174, 0, 9),
(196, 4, 302, 0, 9),
(197, 4, 180, 0, 9),
(198, 4, 181, 0, 9),
(199, 4, 185, 0, 9),
(200, 4, 303, 0, 9),
(201, 4, 188, 0, 10),
(202, 4, 168, 0, 10),
(203, 4, 192, 0, 10),
(204, 4, 193, 0, 10),
(205, 4, 176, 0, 10),
(206, 4, 177, 0, 10),
(207, 4, 198, 0, 10),
(208, 4, 298, 0, 10),
(209, 4, 173, 0, 11),
(210, 4, 164, 0, 11),
(211, 4, 165, 0, 11),
(212, 4, 194, 0, 11),
(213, 4, 302, 0, 11),
(214, 4, 197, 0, 11),
(215, 4, 174, 0, 11),
(216, 1, 153, 0, 12),
(217, 4, 198, 0, 13),
(218, 4, 168, 0, 13),
(219, 2, 22, 0, 1),
(220, 2, 315, 0, 1),
(221, 2, 306, 0, 1),
(222, 2, 37, 0, 1),
(223, 2, 59, 0, 1),
(225, 2, 88, 0, 2),
(226, 2, 40, 0, 2),
(227, 2, 34, 0, 3),
(228, 2, 43, 0, 3),
(229, 2, 306, 0, 3),
(231, 2, 306, 0, 4),
(234, 2, 306, 0, 5),
(235, 2, 18, 0, 5),
(236, 2, 29, 0, 5),
(238, 2, 40, 0, 5),
(239, 2, 88, 0, 5),
(240, 2, 126, 1, 6),
(241, 2, 75, 1, 6),
(242, 2, 309, 1, 6),
(243, 2, 103, 1, 6),
(244, 2, 75, 1, 5),
(245, 2, 68, 1, 5),
(246, 2, 309, 1, 5),
(247, 2, 60, 1, 5),
(248, 2, 309, 1, 2),
(249, 2, 68, 1, 2),
(250, 2, 75, 1, 2),
(251, 2, 151, 1, 2),
(252, 2, 60, 1, 2),
(253, 2, 317, 1, 4),
(254, 2, 68, 1, 4),
(255, 2, 309, 1, 4),
(256, 2, 33, 1, 1),
(257, 2, 319, 1, 1),
(258, 2, 317, 1, 1),
(259, 2, 309, 1, 1),
(260, 2, 103, 1, 1),
(261, 2, 59, 1, 1),
(262, 2, 26, 1, 1),
(263, 2, 22, 1, 1),
(264, 2, 5, 1, 1),
(265, 2, 53, 1, 1),
(266, 2, 57, 1, 1),
(267, 2, 88, 0, 4),
(268, 2, 325, 1, 4),
(269, 2, 325, 1, 1),
(270, 2, 315, 1, 1),
(271, 2, 325, 1, 5),
(272, 2, 325, 1, 2),
(273, 2, 42, 0, 2),
(274, 2, 45, 0, 2),
(275, 2, 306, 0, 2),
(276, 2, 15, 1, 2),
(277, 2, 326, 0, 5),
(278, 2, 47, 0, 1),
(279, 2, 47, 0, 2),
(280, 2, 47, 0, 3),
(281, 2, 47, 0, 4),
(282, 6, 327, 1, 13),
(283, 6, 328, 1, 13),
(284, 6, 352, 1, 13),
(285, 6, 454, 1, 13),
(286, 6, 453, 1, 13),
(287, 6, 447, 1, 13),
(288, 6, 411, 1, 13),
(289, 6, 374, 1, 13),
(290, 6, 346, 1, 13),
(291, 6, 343, 1, 13),
(292, 6, 330, 1, 13),
(293, 6, 368, 1, 13),
(294, 6, 372, 1, 13),
(295, 6, 459, 1, 13),
(296, 6, 452, 1, 13),
(297, 6, 447, 1, 14),
(298, 6, 382, 1, 14),
(299, 6, 388, 1, 14),
(300, 6, 443, 1, 14),
(301, 6, 375, 1, 14),
(302, 6, 459, 1, 14),
(303, 6, 337, 1, 14),
(304, 6, 443, 1, 15),
(305, 6, 350, 1, 15),
(306, 6, 410, 1, 15),
(307, 6, 453, 1, 15),
(308, 6, 382, 1, 15),
(309, 6, 447, 1, 15),
(310, 6, 459, 1, 15),
(311, 6, 388, 1, 16),
(312, 6, 382, 1, 16),
(313, 6, 447, 1, 16),
(314, 6, 375, 1, 16),
(315, 6, 459, 1, 16),
(316, 6, 328, 1, 17),
(317, 6, 330, 1, 17),
(318, 6, 346, 1, 17),
(319, 6, 374, 1, 17),
(320, 6, 339, 1, 17),
(321, 6, 341, 1, 17),
(322, 6, 356, 1, 17),
(323, 6, 350, 1, 17),
(324, 6, 428, 1, 17),
(325, 6, 388, 1, 17),
(326, 6, 447, 1, 17),
(327, 6, 411, 1, 17),
(328, 6, 328, 0, 14),
(329, 6, 338, 0, 14),
(330, 6, 357, 0, 14),
(331, 6, 345, 0, 14),
(332, 6, 352, 0, 14),
(333, 6, 327, 0, 14),
(334, 6, 442, 0, 14),
(335, 6, 440, 0, 14),
(336, 6, 343, 0, 14),
(337, 6, 452, 0, 14),
(338, 6, 444, 0, 14),
(339, 6, 355, 0, 14),
(340, 6, 374, 0, 14),
(341, 6, 337, 0, 15),
(342, 6, 338, 0, 15),
(343, 6, 410, 0, 15),
(344, 6, 344, 0, 15),
(345, 6, 345, 0, 15),
(346, 6, 442, 0, 15),
(347, 6, 399, 0, 15),
(348, 6, 357, 0, 15),
(349, 6, 358, 0, 15),
(350, 6, 361, 0, 15),
(351, 6, 444, 0, 15),
(352, 6, 347, 0, 16),
(353, 6, 348, 0, 16),
(354, 6, 351, 0, 16),
(355, 6, 353, 0, 16),
(356, 6, 359, 0, 16),
(357, 6, 444, 0, 16),
(358, 6, 354, 0, 17),
(359, 6, 337, 0, 17),
(360, 6, 357, 0, 17),
(361, 6, 344, 0, 17),
(362, 6, 345, 0, 17),
(363, 6, 361, 0, 17),
(364, 6, 442, 0, 17),
(365, 6, 444, 0, 17),
(366, 6, 399, 0, 17),
(367, 6, 342, 0, 18),
(368, 6, 334, 0, 18),
(369, 6, 360, 0, 18),
(370, 6, 444, 0, 18),
(371, 6, 340, 0, 18),
(372, 6, 349, 0, 18),
(373, 6, 357, 0, 18),
(374, 6, 399, 0, 18),
(375, 6, 460, 0, 18);

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

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `idCustomer`, `lastname`, `firstname`, `sex`, `age`, `height`, `weight`, `avatar`, `story`, `treatments`, `allergies`, `ta`, `fc`, `dentalCondition`, `dentalRiskNotice`, `mallanpati`, `thyroidMentalDistance`, `mouthOpening`, `difficultIntubation`, `difficultVentilation`, `asa`, `preAnestheticExaminations`, `marProposition`, `expectedHospitalisation`, `transfusionStrategy`, `preAnestheticVisit`, `premedication`, `examExtra`, `premedicationExtra`, `feedback`) VALUES
(1, 2, 'Barreau', 'Nathalie', 1, 25, 160, 0, 1, '- 2 FIV    (fécondation in vitro)\n- RGO gravidique  (reflux gastroœsophagien)\n- Pas de syndrome hémorragique', 'Fer et acide folique  (Tardyféron B9 *)\nAnti-acide (Gaviscon*)', '{}', '140/80', 80, 'RAS', 1, 3, 66, 36, 1, 0, 0, '{\"Groupe 1\":true,\"Groupe 2\":true,\"Phénotype\":true,\"RAI\":true,\"NF\":true}', 1, 0, '', 'Pas de cathéter péridural en place car non souhaité par Mme B', '{\"eve\":[\"\"],\"morning\":[\"\"]}', 'Grossesse à terme\nAuscultation cardiopulmonaire normale', '', ''),
(2, 2, 'Durand', 'Jean', 0, 76, 176, 80, 2, 'Tabac actif (10 cigarettes /jour)\nBPCO post tabagique\nAblation Saphènes x 2  (il y a 2 ans)\nCholecystectomie (il y a 5 ans)', 'Terbutaline LP ( Bricanyl*) : bronchodilatateur bêta-2-mimétique\n           1cp matin et soir', '{}', '130/70', 85, 'RAS', 1, 2, 66, 36, 0, 0, 2, '{}', 1, 0, '', 'Auscultation cardio-pulmonaire normale.', '{\"eve\":[\"Anxiolytique\",\"\"],\"morning\":[\"Aérosol :\",\"Terbutaline ( Bricanyl*)   &  Anticholinergique (Bricanyl*)\",\"Anxiolytique\",\"\"]}', '', 'A jeun le :  date à regler !!\n            Solides : 6 h avant bloc\n            Liquides : 2 h avant bloc', ''),
(4, 2, 'Morel', 'Marie', 1, 68, 176, 72, 4, 'ATCD chirurgicaux :\n-Hernies inguinales x2\nATCD médicaux:\n- Angor d\'effort\n- Fibrillation auriculaire (FA)\n- Pas de coagulopathie clinique.', 'Bétabloquant ( Soprol* ) 5mg le matin\nAnticoagulant ( Préviscan*) 1 cp le soir\n', '{}', '130/80', 65, '1 appareil dentaire supérieur', 1, 1, 66, 36, 0, 0, 2, '{\"Groupe 1\":true,\"Groupe 2\":true,\"Phénotype\":true,\"RAI\":true,\"NF\":true,\"TP\":true,\"Iono\":true,\"ECG\":true,\"INR\":true}', 1, 0, '', 'Auscultation cardiopulmonaire normale.', '{\"eve\":[\"INR : Selon résultat, Vitamine K : 5 mg\",\"HBPM (lovenox*) 0,4 \",\"\"],\"morning\":[\"Contrôle TP/INR\",\"Bétabloquant (soprol*)\",\"\"]}', 'Activité > 4 MET\nECG: FA : ST normal  , Pas de trouble de conduction', 'A jeun le :  jour du bloc (à regler !!!)\n                 Solides : 6h avant bloc\n                 Liquides clairs : 2h avant bloc', ''),
(5, 2, 'Monet', 'Frédéric', 0, 35, 180, 78, 5, 'Appendicectomie dans l\'enfance.\nAsthme équilibré (dernière crise il y a cinq mois)', 'Innovair* (corticoïde &beta2-agoniste) : 1 bouffée matin et soir.', '{\"Pollens\":true}', '130', 70, 'Bon', 1, 2, 66, 36, 0, 0, 2, '{}', 1, 0, '', 'Auscultation pulmonaire normale', '{\"eve\":[\"néant\",\"\"],\"morning\":[\"néant\",\"\"]}', 'Pas de coagulopathie clinique', 'A jeun le :    jour du bloc  àregler !!!!!\n            Solides : 6 h avant bloc\n            Liquides : 2 h avant bloc', ''),
(6, 2, 'Garcia', 'Emmanuel', 0, 35, 175, 120, 3, 'Diabète insulino-requérant (équilibré) depuis 15 ans. Pas d\'angor,  ni hypertension.\nFracture du fémur il y a 10 ans suite à un accident de moto.\nPas de gastroparésie, pas de microangiopathie\nSuivi endocrinologue < 1 mois\nSigne du prieur négatif', 'Insuline rapide (Novo-rapide*) :12 UI le matin\nInsuline (Lantus*) : 30 UI le soir', '{}', '130/60', 95, 'Bon', 1, 2, 64, 36, 1, 0, 2, '{}', 3, 0, '', '', '{\"eve\":[\"néant\"],\"morning\":[\"néant\"]}', 'Auscultation cardiopulmonaire normale', 'A jeun le :  date à regler !!!\n                 Solides : 6h avant bloc\n                 Liquides: 2 h avant bloc', ''),
(7, 4, 'Barreau', 'Nathalie', 1, 25, 160, 70, 1, '- 2FIV\n- RGO gravioique\n- Pas de syndrome hémorragique', 'Tardyféron B9\nGaviston (anti-acide)', '{}', '140/80', 80, 'RAS', 1, 3, 66, 36, 1, 0, 2, '{}', 0, 0, '', '', '{\"eve\":[],\"morning\":[]}', '', '', ''),
(8, 4, 'Durand', 'Jean', 0, 76, 176, 80, 2, 'Tabac actif (bciq/jour)\nBPCO post tabagique\nSAPHENES x2 (il y a 2 ans)\ncholecystectomie (il y a 2 ans)', 'Dricanyl (mimétique)\n1cp matin et soir', '{}', '130/70', 85, '', 1, 2, 66, 36, 0, 0, 2, '{}', 1, 0, '', 'Auscultation cardio-pulmonaire normale.', '{\"eve\":[\"Anxiolitique\"],\"morning\":[\"Gérosol\",\"Atrovut + bricayl\",\"Gaxiolitique\"]}', '', '', ''),
(9, 4, 'Morel', 'Marie', 1, 68, 176, 72, 4, 'ATCD chirurgicaux :\n-Hernies injuinales x2\n- Anjor d\'effort\n- 2 stents il y a 5 ans\n- Fibrillation auriculaire (FA)\n- Pas de coagulation clinique.', 'Soprol (betabloquant)\n5mg le soir\nPréviscan (anticoagulant)\n1cp /jour le soir', '{}', '130/80', 65, '1 appareil dentaire supérieur', 1, 1, 66, 36, 0, 0, 2, '{\"Groupe 1\":true, \"Groupe 2\":true, \"RAI\":true, \"Cross NF\":true, \"TP\":true, \"Iono\":true, \"INR\":true, \"Coraticoagulant\":true}', 1, 0, '', 'Auscultation cardiopulmonaire normale.', '{\"eve\":[\"VitamineK 5mg\"],\"morning\":[\"Contrôle TP_INR\"]}', '', '', ''),
(10, 4, 'Monet', 'François', 0, 35, 180, 78, 5, 'Appendicectomie dans l\'enfance.\nAsthme équilibré.', 'Innovair\n1 bouffée matin et soir.', '{\"Pollen\":true}', '130', 70, '', 1, 2, 66, 36, 0, 0, 2, '{}', 1, 0, '', 'Ausculatation pulmonaire normale', '{\"eve\":[],\"morning\":[]}', '', '', ''),
(11, 4, 'Garcia', 'Emmanuel', 0, 35, 175, 120, 3, 'Diabète insulino-requérant (équilibré) depuis 15 ans. Pas d\'angor ni hypertension.\nFracture du fémur il y a 10 ans suite à un accident de moto.', 'Novo-rapide (insuline rapide)\n12 UI le matin\nLantus (insuline)\n30 UI le soir', '{}', '130/60', 95, 'RAI', 1, 2, 64, 36, 1, 0, 2, '{}', 0, 0, '', '', '{\"eve\":[],\"morning\":[]}', '', '', ''),
(12, 1, 'Doe', 'John', 0, 0, 0, 0, 5, '', '', '{}', '0/0', 0, '', 0, 1, 64, 34, 0, 0, 1, '{}', 0, 0, '', '', '{\"eve\":[\"\"],\"morning\":[\"\"]}', '', '', ''),
(13, 6, 'Barreau', 'Nathalie', 1, 25, 160, 70, 1, '- 2FIV\n- RGO gravioique\n- Pas de syndrome hémorragique', 'Tardyféron B9\nGaviston (anti-acide)', '{}', '140/80', 80, 'RAS', 1, 3, 66, 36, 1, 0, 2, '{}', 0, 0, '', '', '{\"eve\":[],\"morning\":[]}', '', '', ''),
(14, 6, 'Durand', 'Jean', 0, 76, 176, 80, 2, 'Tabac actif (bciq/jour)\nBPCO post tabagique\nSAPHENES x2 (il y a 2 ans)\ncholecystectomie (il y a 2 ans)', 'Dricanyl (mimétique)\n1cp matin et soir', '{}', '130/70', 85, '', 1, 2, 66, 36, 0, 0, 2, '{}', 1, 0, '', 'Auscultation cardio-pulmonaire normale.', '{\"eve\":[\"Anxiolitique\"],\"morning\":[\"Gérosol\",\"Atrovut + bricayl\",\"Gaxiolitique\"]}', '', '', ''),
(15, 6, 'Morel', 'Marie', 1, 68, 176, 72, 4, 'ATCD chirurgicaux :\n-Hernies inguinales x2\nATCD médicaux:\n- Angor d\'effort\n- 2 stents il y a 5 ans\n- Fibrillation auriculaire (FA)\n- Pas de coagulopathie clinique.', 'Bétabloquant ( Soprol* 5mg le matin)\nAnticoagulant( Préviscan* 1 cp le soir)\n', '{}', '130/80', 65, '1 appareil dentaire supérieur', 1, 1, 66, 36, 0, 0, 2, '{\"Groupe 1\":true, \"Groupe 2\":true, \"Phénotype\":true, \"RAI\":true, \"Cross NF\":true, \"TP\":true, \"Iono\":true, \"INR: Selon résultat\":true, \"vitamine K 5 mg\":true}', 1, 0, '', 'Auscultation cardiopulmonaire normale.', '{\"eve\":[\"INR : Selon résultat, Vitamine K, 5 mg\"],\"morning\":[\"Contrôle TP/INR\",\"Bétabloquant \"]}', '', '', ''),
(16, 6, 'Monet', 'Frédéric', 0, 35, 180, 78, 5, 'Appendicectomie dans l\'enfance.\nAsthme équilibré.', 'Innovair\n1 bouffée matin et soir.', '{\"Pollen\":true}', '130', 70, '', 1, 2, 66, 36, 0, 0, 2, '{}', 1, 0, '', 'Ausculatation pulmonaire normale', '{\"eve\":[],\"morning\":[]}', '', '', ''),
(17, 6, 'Garcia', 'Emmanuel', 0, 35, 175, 120, 3, 'Diabète insulino-requérant (équilibré) depuis 15 ans. Pas d\'angor ni hypertension.\nFracture du fémur il y a 10 ans suite à un accident de moto.', 'Novo-rapide (insuline rapide)\n12 UI le matin\nLantus (insuline)\n30 UI le soir', '{}', '130/60', 95, 'RAI', 1, 2, 64, 36, 1, 0, 2, '{}', 1, 0, '', '', '{\"eve\":[],\"morning\":[]}', '', '', '');

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

--
-- Déchargement des données de la table `patient_liaison`
--

INSERT INTO `patient_liaison` (`id`, `idPatient`, `idCustomer`, `idSurgery`) VALUES
(1, 1, 2, 1),
(2, 2, 2, 2),
(4, 5, 2, 2),
(7, 2, 2, 3),
(8, 4, 2, 3),
(9, 5, 2, 3),
(10, 4, 2, 4),
(12, 2, 2, 4),
(14, 5, 2, 4),
(15, 5, 2, 5),
(17, 2, 2, 5),
(19, 4, 2, 5),
(20, 6, 2, 2),
(21, 6, 2, 3),
(22, 6, 2, 4),
(23, 6, 2, 5),
(24, 7, 4, 7),
(25, 8, 4, 8),
(26, 10, 4, 8),
(27, 11, 4, 8),
(28, 7, 4, 9),
(29, 8, 4, 9),
(30, 9, 4, 9),
(31, 10, 4, 9),
(32, 11, 4, 9),
(33, 9, 4, 10),
(34, 7, 4, 10),
(35, 8, 4, 10),
(36, 10, 4, 10),
(37, 11, 4, 10),
(38, 10, 4, 11),
(39, 7, 4, 11),
(40, 8, 4, 11),
(41, 9, 4, 11),
(42, 11, 4, 11),
(43, 12, 1, 12),
(44, 13, 6, 14),
(45, 14, 6, 15),
(46, 16, 6, 15),
(47, 17, 6, 15),
(48, 14, 6, 16),
(49, 15, 6, 16),
(50, 16, 6, 16),
(51, 17, 6, 16),
(52, 15, 6, 17),
(53, 14, 6, 17),
(54, 16, 6, 17),
(55, 17, 6, 17),
(56, 16, 6, 18),
(57, 14, 6, 18),
(58, 15, 6, 18),
(59, 17, 6, 18);

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
(1, 2, 'asthme', 'À quand remonte votre dernière crise d\'asthme ?', 'Pardon ?'),
(2, 2, 'cote', 'De quel côté êtes-vous opéré(e)?', 'Excusez-moi ?'),
(3, 2, 'accordALR', 'Vous a t\'on informé que vous auriez une ALR, contre la douleur?', 'Hein ? Mais pourquoi ?'),
(4, 2, 'rgo', 'Avez-vous  tendance à avoir des nausées, vomissements ou reflux?', 'Non.'),
(5, 2, 'traitement Cardio 1', 'Avez-vous pris votre Béta-Bloquant ce matin?', 'Un quoi ?'),
(6, 2, 'jeun Tabac', 'Avez-vous fumé ce matin?', 'Je ne fume pas.'),
(7, 2, 'lombaire', 'Avez-vous des douleurs lombaires connues ?', 'Non.'),
(8, 2, 'antiH2', 'Avez-vous pris un médicament effervescent? ( Ranitidine? Azantac?)', 'non'),
(10, 2, 'nuque', 'Avez-vous une raideur au niveau cervical ?', 'Non, ca va'),
(12, 2, 'glycémie', 'Avez- vous eu une glycémie ce matin, et connaissez-vous le résultat?', 'Heu, bha non !'),
(13, 2, 'apnée', 'Faites-vous des apnées du sommeil ?', 'Non, jamais.'),
(15, 2, 'aérosol', 'Avez-vous eu un aérosol avant d\'arriver au bloc ?', 'Non.'),
(17, 4, 'asthme', 'À quand remonte votre dernière crise d\'asthme ?', 'Pardon ?'),
(18, 4, 'cote', 'De quel côté allez-vous être opéré s\'il vous plait ?', 'Excusez-moi ?'),
(19, 4, 'accordALR', 'Vous vous rappelez que vous bénéficierez d\'une anesthésie loco régionale en plus de l\'anésthésie générale ?', 'Hein ? Mais pourquoi ?'),
(20, 4, 'rgo', 'Avez-vous des reflux gastro-oesophagiens?', 'Non.'),
(21, 4, 'traitementCardio', 'Avez-vous pris votre traitement pour le coeur ce matin ? Y a-t-il eu un relais de l\'anti-coagulant par injection à domicile ?', 'Un quoi ?'),
(22, 4, 'jeunTabac', 'Vous n\'avez pas fumé ce matin ?', 'Je ne fume pas.'),
(23, 4, 'lombaire', 'Avez-vous des douleurs lombaires connues ?', 'Non.'),
(24, 4, 'antiH2', 'Vous a on donné un comprimé effervescent contre les reflux gastriques à boire ?', 'Non.'),
(25, 4, 'prothèse', 'Avez-vous une prothèse métallique dans le corps ?', 'Non.'),
(26, 4, 'nuque', 'Avez-vous une raideur au niveau cervical ?', 'Non.'),
(27, 4, 'froid', 'Avez-vous froid ?', 'Non.'),
(28, 4, 'glycémie', 'Avez-vous fait un contrôle HGT ce matin ?', 'Heu, bha non !'),
(29, 4, 'apnée', 'Faites-vous des apnées du sommeil ?', 'Non, jamais.'),
(30, 4, 'coronarien', 'Depuis la dernière consultation d\'anésthésie, vous n\'avez rien à signaler de nouveau sur le plan cardio-vasculaire ?', 'Non, ça va bien.'),
(31, 4, 'aérosol', 'Avez-vous eu un aérosol avant d\'arriver au bloc ?', 'Non.'),
(32, 4, 'enceinte', 'Etes vous enceinte ?', 'Mais enfin, vous vous trompez de patient !'),
(33, 1, 'qtest', 'Question test ?', 'Non.'),
(34, 2, 'Traitement Cardio 2', 'Avez- vous arrêté votre traitement anticoagulant?', 'pardon?'),
(35, 2, 'Traitement cardio 3', 'Y-a t\'il eu un relais de votre anticoagulant, par injection?', 'Pardon?'),
(36, 2, 'BAT', 'Portez-vous des bas de contention?', 'Non'),
(37, 2, 'Evaluation Mallampati Urgence', ' Pouvez-vous ouvrir grand la bouche et tirer la langue?', 'Pardon?'),
(38, 2, 'Appareil dentaire', 'Avez-vous retiré votre appareil dentaire?', 'Je n\'en ai pas'),
(39, 6, 'asthme', 'À quand remonte votre dernière crise d\'asthme ?', 'Pardon ?'),
(40, 6, 'cote', 'De quel côté êtes-vous opéré(e)?', 'Excusez-moi ?'),
(41, 6, 'accordALR', 'Vous a t\'on informé que vous auriez une ALR, contre la douleur?', 'Hein ? Mais pourquoi ?'),
(42, 6, 'rgo', 'Avez-vous  tendance à avoir des nausées, vomissements ou reflux?', 'Non.'),
(43, 6, 'traitement Cardio 1', 'Avez-vous pris votre Béta-Bloquant ce matin?', 'Un quoi ?'),
(44, 6, 'jeun Tabac', 'Avez-vous fumé ce matin?', 'Je ne fume pas.'),
(45, 6, 'lombaire', 'Avez-vous des douleurs lombaires connues ?', 'Non.'),
(46, 6, 'antiH2', 'Avez-vous pris un médicament effervescent? ( Ranitidine? Azantac?)', 'non'),
(47, 6, 'nuque', 'Avez-vous une raideur au niveau cervical ?', 'Non.'),
(48, 6, 'glycémie', 'Avez- vous eu une glycémie ce matin, et connaissez-vous le résultat?', 'Heu, bha non !'),
(49, 6, 'apnée', 'Faites-vous des apnées du sommeil ?', 'Non, jamais.'),
(50, 6, 'aérosol', 'Avez-vous eu un aérosol avant d\'arriver au bloc ?', 'Non.'),
(51, 6, 'Traitement Cardio 2', 'Avez- vous arrêté votre traitement anticoagulant?', 'pardon?'),
(52, 6, 'Traitement cardio 3', 'Y-a t\'il eu un relais de votre anticoagulant, par injection?', 'Pardon?'),
(53, 6, 'BAT', 'Portez-vous des bas de contention?', 'Non'),
(54, 6, 'Evaluation Mallampati Urgence', ' Pouvez-vous ouvrir grand la bouche et tirer la langue?', 'Pardon?'),
(55, 6, 'Appareil dentaire', 'Avez-vous retiré votre appareil dentaire?', 'Je n\'en ai pas');

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

--
-- Déchargement des données de la table `questions_liaison`
--

INSERT INTO `questions_liaison` (`id`, `idQuestion`, `answer`, `idCustomer`, `spawnedBy`, `idSpawner`) VALUES
(1, 8, 'Oui.', 2, 1, 1),
(2, 6, 'Non, je n\'ai pas fumé depuis hier soir.', 2, 1, 2),
(11, 5, 'Oui, je l\'ai bien pris', 2, 1, 4),
(16, 1, 'C\'était il y a trois semaines environ.', 2, 1, 5),
(17, 15, 'Oui, je l\'ai bien eu.', 2, 1, 5),
(18, 7, 'Non.', 2, 0, 2),
(19, 2, 'De la hanche droite.', 2, 0, 3),
(20, 3, 'Bien sur.', 2, 0, 3),
(21, 2, 'De la hanche droite.', 2, 0, 4),
(22, 10, '', 2, 0, 5),
(23, 4, 'Non.', 2, 1, 6),
(24, 12, 'Oui, j\'étais à 0,8 g/l', 2, 1, 6),
(25, 10, 'Non, pas de soucis.', 2, 1, 6),
(26, 13, 'Non, jamais.', 2, 1, 6),
(27, 24, 'Oui.', 4, 1, 7),
(28, 22, 'Non, je n\'ai pas fumé depuis hier soir.', 4, 1, 8),
(29, 25, 'Non.', 4, 1, 8),
(30, 26, 'Non, ça va.', 4, 1, 8),
(31, 23, 'Non.', 4, 1, 8),
(32, 27, 'Non, ça va.', 4, 1, 8),
(33, 21, 'Oui je n\'en ai pris qu\'un ce matin. (A REDIGER)', 4, 1, 9),
(34, 25, 'Non.', 4, 1, 9),
(35, 26, 'Non, ça va.', 4, 1, 9),
(36, 30, 'Non, ça va bien.', 4, 1, 9),
(37, 27, 'Non, ça va.', 4, 1, 9),
(38, 17, 'C\'était il y a trois semaines environ.', 4, 1, 10),
(39, 31, 'Oui, je l\'ai bien eu.', 4, 1, 10),
(40, 20, 'Non.', 4, 1, 11),
(41, 28, 'Oui, j\'étais à 0,8 g/l', 4, 1, 11),
(42, 26, 'Non, pas de soucis.', 4, 1, 11),
(43, 29, 'Non, jamais.', 4, 1, 11),
(44, 23, 'Non.', 4, 0, 8),
(45, 18, 'Du coté gauche.', 4, 0, 9),
(46, 19, 'Bien sur.', 4, 0, 9),
(47, 18, 'Du coté gauche.', 4, 0, 10),
(48, 26, 'Non, aucune.', 4, 0, 11),
(49, 33, '', 1, 0, 12),
(50, 4, 'oui', 2, 1, 1),
(51, 37, 'Ahh', 2, 1, 1),
(52, 8, '', 2, 1, 6),
(53, 36, 'oui', 2, 0, 2),
(54, 38, 'Oui ,je l\'ai enlevé', 2, 1, 4),
(55, 34, 'Oui, il y a quelques jours', 2, 1, 4),
(56, 35, 'oui, avec des injections matin et soir', 2, 1, 4),
(57, 10, '', 2, 0, 4),
(58, 10, '', 2, 0, 3),
(59, 36, 'oui', 2, 1, 6),
(60, 36, 'oui', 2, 1, 2),
(61, 36, 'oui', 2, 0, 4),
(63, 46, 'Oui.', 6, 1, 13),
(64, 42, 'oui', 6, 1, 13),
(65, 54, 'Oui', 6, 1, 13),
(66, 44, 'Non, je n\'ai pas fumé depuis hier soir.', 6, 1, 14),
(67, 45, 'Non.', 6, 1, 14),
(68, 43, 'Oui, j\'ai bien pris mon Bétabloquant', 6, 1, 15),
(69, 47, 'Non, ça va.', 6, 1, 15),
(70, 55, 'Oui ,je l\'ai enlevé', 6, 1, 15),
(71, 51, 'Oui, il y a quelques jours', 6, 1, 15),
(72, 52, 'Non', 6, 1, 15),
(73, 39, 'C\'était il y a trois semaines environ.', 6, 1, 16),
(74, 50, 'Oui, je l\'ai bien eu.', 6, 1, 16),
(75, 42, 'Non.', 6, 1, 17),
(76, 48, 'Oui, j\'étais à 0,8 g/l', 6, 1, 17),
(77, 47, 'Non, pas de soucis.', 6, 1, 17),
(78, 49, 'Non, jamais.', 6, 1, 17),
(79, 46, '', 6, 1, 17),
(80, 45, 'Non.', 6, 0, 15),
(81, 53, 'oui', 6, 0, 15),
(82, 40, 'Du côté droit.', 6, 0, 16),
(83, 41, 'Bien sur.', 6, 0, 16),
(84, 40, 'Du côté droit.', 6, 0, 17),
(85, 47, 'Non, aucune.', 6, 0, 18);

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
-- Déchargement des données de la table `surgery`
--

INSERT INTO `surgery` (`id`, `idCustomer`, `name`, `consultation`, `emergency`, `story`, `marProposition`, `marPropositionText`, `preAnestheticVisit`, `lastEval`, `feedback`) VALUES
(1, 2, 'Césarienne en urgence', 1, 1, 'Grossesse à terme', 1, 'Pas de cathéther péridural en place car non souhaité par Mme B.', '', 0, ''),
(2, 2, 'Cysto-prostatectomie voie haute', 0, 0, '', 1, '', '', 1, ''),
(3, 2, 'Ligamentoplastie épaule gauche   ', 0, 0, '', 3, 'Bloc interscalénique', '', 14, ''),
(4, 2, 'Prothese totale de hanche droite ( PTH)     (décubitus latéral gauche)', 0, 0, '', 1, 'Position Décubitus latéral gauche', '', 30, ''),
(5, 2, 'Thyroïdectomie totale', 0, 0, '', 1, '', '', 10, ''),
(7, 4, 'Césarienne en urgence', 1, 1, 'Grossesse à terme', 3, 'Pas de cathé', '', 0, ''),
(8, 4, 'Cysto-prostatectomie voie haute', 0, 0, '', 1, '', '', 1, ''),
(9, 4, 'Ligamentoplastie épaule gauche sous AG + BIS', 0, 0, 'Suivi endoctrinologique < 1 mois\nSigne du prieur -\nPas de gastroparésie\nPas de micro-angiopathie.', 3, 'Bloc interscalique', '', 14, ''),
(10, 4, 'PTH droite, décubitus latéral gauche', 0, 0, '', 0, '', '', 31, ''),
(11, 4, 'Thyroïdectomie totale', 0, 0, '', 0, '', 'La veille', 10, ''),
(12, 1, 'Chirurgie Test', 0, 0, '', 0, '', '', 0, ''),
(13, 4, 'Test chirurgie', 0, 0, '', 0, '', '', 0, ''),
(14, 6, 'Césarienne en urgence', 1, 1, 'Grossesse à terme', 3, 'Pas de cathé', '', 0, ''),
(15, 6, 'Cysto-prostatectomie voie haute', 0, 0, '', 1, '', '', 1, ''),
(16, 6, 'Ligamentoplastie épaule gauche sous AG + BIS', 0, 0, 'Suivi endoctrinologique < 1 mois\nSigne du prieur -\nPas de gastroparésie\nPas de micro-angiopathie.', 3, 'Bloc interscalique', '', 14, ''),
(17, 6, 'PTH droite, décubitus latéral gauche', 0, 0, '', 1, '', '', 31, ''),
(18, 6, 'Thyroïdectomie totale', 0, 0, '', 0, '', 'La veille', 10, '');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `customerpacks`
--
ALTER TABLE `customerpacks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=461;
--
-- AUTO_INCREMENT pour la table `material_liaison`
--
ALTER TABLE `material_liaison`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=376;
--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `patient_liaison`
--
ALTER TABLE `patient_liaison`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT pour la table `questions_liaison`
--
ALTER TABLE `questions_liaison`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT pour la table `surgery`
--
ALTER TABLE `surgery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
