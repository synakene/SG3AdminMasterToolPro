-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 17 avr. 2018 à 14:26
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
  `apikey` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`id`, `mail`, `apikey`, `password`, `admin`) VALUES
(1, 'zarnes@live.com', '', '$2y$10$mG1lcUhpscD4d2Rk/EjMFOhH/yNLN5ssL2y8dhsSPivsYAWB9oyeK', 1),
(2, 'pwet@live.com', '4H534-5J1FX-BFHZW-DEVRE', '$2y$10$1bfN.gpxcCFfLJ1o8Zt.KelAHcR36eLONf2EwwULrgDgSIIp2urPq', 0);

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
(1, 1, 1),
(18, 1, 2);

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
(335, 2, 'Plateau césarienne', 'Réfrigérateur'),
(336, 2, 'Grh1 et 2', 'Dossier d\'anesthésie'),
(337, 2, 'Laryngoscope manche normal', 'Chariot d\'anesthésie'),
(338, 2, 'Laryngoscope manche court', 'Chariot d\'anesthésie'),
(339, 2, 'Magyll', 'Chariot d\'anesthésie'),
(340, 2, 'Mandrin semi-rigide', 'Chariot d\'anesthésie'),
(341, 2, 'Canules de Guedel', 'Chariot d\'anesthésie'),
(342, 2, 'Sondes IOT 6.5', 'Chariot d\'anesthésie'),
(343, 2, 'Sondes IOT 7', 'Chariot d\'anesthésie'),
(344, 2, 'Sondes IOT 7.5', 'Chariot d\'anesthésie'),
(345, 2, 'Sondes IOT armée 7', 'Chariot d\'anesthésie'),
(346, 2, 'Sondes IOT armée 7.5', 'Chariot d\'anesthésie'),
(347, 2, 'Sondes Nim', 'Chariot d\'anesthésie'),
(348, 2, 'Masque laryngé 4', 'Chariot d\'anesthésie'),
(349, 2, 'Masque laryngé 5', 'Chariot d\'anesthésie'),
(350, 2, '2ème voie d\'abord', 'Chariot d\'anesthésie'),
(351, 2, 'Cathlon 16 G', 'Chariot d\'anesthésie'),
(352, 2, 'Dialaflow', 'Chariot d\'anesthésie'),
(353, 2, 'Rallonges tubulures', 'Chariot d\'anesthésie'),
(354, 2, 'Nacl 9%o', 'Chariot d\'anesthésie'),
(355, 2, 'Capno tubulure longue', 'Tiroir Respirateur'),
(356, 2, 'Curamètre', 'Tiroir Respirateur'),
(357, 2, 'Canule buccale', 'Tiroir Respirateur'),
(358, 2, 'O', 'Tiroir Respirateur'),
(359, 2, 'Réchauffeur - accélérateur de perfusion', 'Réserve'),
(360, 2, 'Hemocue', 'Réserve'),
(361, 2, 'Glucotest', 'Réserve'),
(362, 2, 'Chariot IOT difficile', 'Réserve'),
(363, 2, 'Intralipides', 'Réserve'),
(364, 2, 'Chariot ALR+ échographe', 'Réserve'),
(365, 2, 'Billot sous scapulaire', 'Réserve'),
(366, 2, 'BIS', 'Réserve'),
(367, 2, 'Exacyl', 'Réserve'),
(368, 2, 'Têtière', 'Réserve'),
(369, 2, 'Billot fesse', 'Réserve'),
(370, 2, 'Rouleau adhésif fixation', 'Réserve'),
(371, 2, 'Billot thoracique', 'Réserve'),
(372, 2, 'Sérum test', 'Réfrigérateur'),
(373, 2, 'Nalador', 'Réfrigérateur'),
(374, 2, 'Phénotype', 'Dossier d\'anesthésie'),
(375, 2, 'RAI', 'Dossier d\'anesthésie'),
(376, 2, 'Cross', 'Dossier d\'anesthésie'),
(377, 2, 'NFS', 'Dossier d\'anesthésie'),
(378, 2, 'TP', 'Dossier d\'anesthésie'),
(379, 2, 'TCA', 'Dossier d\'anesthésie'),
(380, 2, 'INR', 'Dossier d\'anesthésie'),
(381, 2, 'Iono', 'Dossier d\'anesthésie'),
(382, 2, 'HGT', 'Dossier d\'anesthésie'),
(383, 2, 'ECBU', 'Dossier d\'anesthésie'),
(384, 2, 'T3/T4/TSH', 'Dossier d\'anesthésie'),
(385, 2, 'Rx pulm', 'Dossier d\'anesthésie'),
(386, 2, 'ECG', 'Dossier d\'anesthésie'),
(387, 2, 'Activité MET', 'Dossier d\'anesthésie'),
(388, 2, 'BMI', 'Dossier d\'anesthésie'),
(389, 2, 'G5%', 'Chariot d\'anesthésie'),
(390, 2, 'Isofondine', 'Chariot d\'anesthésie'),
(391, 2, 'Restorvol', 'Chariot d\'anesthésie'),
(392, 2, 'Gelofusine', 'Chariot d\'anesthésie'),
(393, 2, 'Sonde gastrique', 'Chariot d\'anesthésie'),
(394, 2, 'Protection oculaire renforcée', 'Chariot d\'anesthésie'),
(395, 2, 'Tuyaux longs respirateur', 'Tiroir Respirateur'),
(396, 2, 'Acide tranexamique', 'Chariot d\'anesthésie'),
(397, 2, 'Adrénaline', 'Chariot d\'anesthésie'),
(398, 2, 'Antibiotique', 'Chariot d\'anesthésie'),
(399, 2, 'Anticonvulsivants', 'Chariot d\'anesthésie'),
(400, 2, 'Antalgiques', 'Chariot d\'anesthésie'),
(401, 2, 'Atropine', 'Chariot d\'anesthésie'),
(402, 2, 'Dexamethasone', 'Chariot d\'anesthésie'),
(403, 2, 'Dropéridol', 'Chariot d\'anesthésie'),
(404, 2, 'Ephédrine', 'Chariot d\'anesthésie'),
(405, 2, 'Hypnomidate', 'Chariot d\'anesthésie'),
(406, 2, 'Néostigmine', 'Chariot d\'anesthésie'),
(407, 2, 'Noradrénaline', 'Chariot d\'anesthésie'),
(408, 2, 'Phenyléphrine', 'Chariot d\'anesthésie'),
(409, 2, 'Propofol', 'Chariot d\'anesthésie'),
(410, 2, 'Ranitidine', 'Chariot d\'anesthésie'),
(411, 2, 'Salbutamol nébuliseur', 'Chariot d\'anesthésie'),
(412, 2, 'Thiopental', 'Chariot d\'anesthésie'),
(413, 2, 'Trinitrine nébuliseur', 'Chariot d\'anesthésie'),
(414, 2, 'Anesthésique de contact (gel et spray de Xylocaïne)', 'Chariot d\'anesthésie'),
(415, 2, 'Cale-bouche', 'Chariot d\'anesthésie'),
(416, 2, 'Canules de Guedel n° 2, 3, 4, ...', 'Chariot d\'anesthésie'),
(417, 2, 'Ciseaux', 'Chariot d\'anesthésie'),
(418, 2, 'Fixation sparadrap, cordon', 'Chariot d\'anesthésie'),
(419, 2, 'Laryngoscope manche long, laryngoscope manche courte avec deux lames 3 et 4 en état de marche à usage unique', 'Chariot d\'anesthésie'),
(420, 2, 'Masques laryngés n° 3, 4, 5', 'Chariot d\'anesthésie'),
(421, 2, 'Piles', 'Chariot d\'anesthésie'),
(422, 2, 'Pince de Magill et mandrin', 'Chariot d\'anesthésie'),
(423, 2, 'Prolongateur à O2', 'Chariot d\'anesthésie'),
(424, 2, 'Raccords annelés', 'Chariot d\'anesthésie'),
(425, 2, 'Sondes à aspiration (12,14,16 et 18 G)', 'Chariot d\'anesthésie'),
(426, 2, 'Sondes d\'intubation : 6 - 6,5 - 7 - 7,5', 'Chariot d\'anesthésie'),
(427, 2, 'Sondes d\'intubation armées : 6 - 6,5 - 7 - 7,5', 'Chariot d\'anesthésie'),
(428, 2, 'Sondes O2 nasales', 'Chariot d\'anesthésie'),
(429, 2, 'Aiguilles et seringues (5, 10, 20 et 50 ml)', 'Chariot d\'anesthésie'),
(430, 2, 'Antiseptique à large spectre d\'action rapide', 'Chariot d\'anesthésie'),
(431, 2, 'Cathéters périphériques 20, 18 et 16 Gauges', 'Chariot d\'anesthésie'),
(432, 2, 'Garrot, compresses', 'Chariot d\'anesthésie'),
(433, 2, 'Nécessaire à prélèvement (Gaz du sang, Ionogramme, Numération formule sanguine, groupage...)', 'Chariot d\'anesthésie'),
(434, 2, 'Pansements occlusifs transparents, bande adhésive', 'Chariot d\'anesthésie'),
(435, 2, 'Robinets à 3 voies, prolongateurs de perfusion', 'Chariot d\'anesthésie'),
(436, 2, 'Tubulures à perfusion avec valves anti-retour', 'Chariot d\'anesthésie'),
(437, 2, 'Bicarbonate de Sodium à 8,4% ', 'Chariot d\'anesthésie'),
(438, 2, 'Chlorure de Sodium 500 ml', 'Chariot d\'anesthésie'),
(439, 2, 'Gélofusine (Gélatine) 500 ml', 'Chariot d\'anesthésie'),
(440, 2, 'Glucose à 5% 500 ml', 'Chariot d\'anesthésie'),
(441, 2, 'Isofundine 500 ml', 'Chariot d\'anesthésie'),
(442, 2, 'Restorvol 500 ml', 'Chariot d\'anesthésie'),
(443, 2, 'Ringer Lactate 500 ml', 'Chariot d\'anesthésie'),
(444, 2, 'Gants à usage unique non stériles', 'Chariot d\'anesthésie'),
(445, 2, 'Pince de Kocher', 'Chariot d\'anesthésie'),
(446, 2, 'Protection oculaire (collyre, vit A...)', 'Chariot d\'anesthésie'),
(447, 2, 'Solution hydro-alcoolique', 'Chariot d\'anesthésie'),
(448, 2, 'Sondes gastriques (14, 16, 18 Ch)', 'Chariot d\'anesthésie'),
(449, 2, 'Masques faciaux de différentes tailles', 'Chariot d\'anesthésie'),
(450, 2, 'Raccords annelés et filtres antibactériens', 'Chariot d\'anesthésie'),
(451, 2, 'Electrodes', 'Chariot d\'anesthésie'),
(452, 2, 'Brassard à tension de différentes tailles', 'Chariot d\'anesthésie'),
(453, 2, 'Sondes thermiques', 'Chariot d\'anesthésie'),
(454, 2, 'Lames Mac Intosh 2,3,4', 'Réserve'),
(455, 2, 'Lames Miller 2,3', 'Réserve'),
(456, 2, 'Manche laryngo court', 'Réserve'),
(457, 2, 'Pinces de Magill petite, moyenne, grande', 'Réserve'),
(458, 2, 'Pince en coeur', 'Réserve'),
(459, 2, 'Protège-dents', 'Réserve'),
(460, 2, 'Sondes d\'intubation préformées différentes tailles', 'Réserve'),
(461, 2, 'Sondes d\'intubation armées différentes tailles', 'Réserve'),
(462, 2, 'Mandrin pour sonde d\'intubation', 'Réserve'),
(463, 2, 'Masques laryngés toutes tailles', 'Réserve'),
(464, 2, 'Fastrach', 'Réserve'),
(465, 2, 'Set d\'intubation rétrograde', 'Réserve'),
(466, 2, 'Set de cricothyrotomie', 'Réserve'),
(467, 2, 'Mandrin de Cook', 'Réserve'),
(468, 2, 'Alfentanyl', 'Réserve'),
(469, 2, 'Fentanyl', 'Réserve'),
(470, 2, 'Kétamine', 'Réserve'),
(471, 2, 'Morphine', 'Réserve'),
(472, 2, 'Rémifentanyl', 'Réserve'),
(473, 2, 'Sufentanyl', 'Réserve'),
(474, 2, 'Chariot ALR / Intralipides', 'Réserve'),
(475, 2, 'Aspiration de secours', 'Réserve'),
(476, 2, 'Kit choc anaphylactique', 'Réserve'),
(477, 2, 'Hémoglucotest', 'Réserve'),
(478, 2, 'Kit hyperthermie maligne', 'Réserve'),
(479, 2, 'Matériel KTC KTA / Câbles', 'Réserve'),
(480, 2, 'Dispositif de compression veineuse pneumatique intermittente', 'Réserve'),
(481, 2, 'Matériel d\'échographie', 'Réserve'),
(482, 2, 'Index bispectral', 'Réserve'),
(483, 2, 'Ampoules glucose 30 %', 'Réserve'),
(484, 2, 'Atracurium', 'Réfrigérateur'),
(485, 2, 'Cisatracurium', 'Réfrigérateur'),
(486, 2, 'Rocuronium', 'Réfrigérateur'),
(487, 2, 'Suxamethonium', 'Réfrigérateur'),
(488, 2, 'Insuline rapide', 'Réfrigérateur'),
(489, 2, 'Isuprel', 'Réfrigérateur'),
(490, 2, 'Nalador ®', 'Réfrigérateur'),
(491, 2, 'Ocytocine', 'Réfrigérateur'),
(492, 2, 'Solutés', 'Réfrigérateur');

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
(70, 2, 335, 1, 6),
(71, 2, 336, 1, 6),
(72, 2, 376, 1, 6),
(73, 2, 377, 1, 6),
(74, 2, 359, 1, 6),
(75, 2, 364, 1, 6),
(76, 2, 338, 1, 6),
(77, 2, 339, 1, 6),
(78, 2, 342, 1, 6),
(79, 2, 343, 1, 6),
(80, 2, 371, 1, 6),
(81, 2, 344, 1, 6),
(82, 2, 356, 1, 6),
(83, 2, 392, 1, 6),
(84, 2, 393, 1, 6),
(85, 2, 337, 1, 7),
(86, 2, 339, 1, 7),
(87, 2, 368, 1, 7),
(88, 2, 383, 1, 7),
(89, 2, 343, 1, 7),
(90, 2, 385, 1, 7),
(91, 2, 387, 1, 7),
(92, 2, 388, 1, 7),
(93, 2, 356, 1, 7),
(94, 2, 392, 1, 7),
(95, 2, 363, 1, 8),
(96, 2, 364, 1, 8),
(97, 2, 339, 1, 8),
(98, 2, 383, 1, 8),
(99, 2, 343, 1, 8),
(100, 2, 384, 1, 8),
(101, 2, 390, 1, 8),
(102, 2, 354, 1, 8),
(103, 2, 356, 1, 8),
(104, 2, 391, 1, 8),
(105, 2, 392, 1, 8),
(106, 2, 337, 1, 9),
(107, 2, 339, 1, 9),
(108, 2, 380, 1, 9),
(109, 2, 381, 1, 9),
(110, 2, 382, 1, 9),
(111, 2, 343, 1, 9),
(112, 2, 344, 1, 9),
(113, 2, 388, 1, 9),
(114, 2, 389, 1, 9),
(115, 2, 356, 1, 9),
(116, 2, 392, 1, 9),
(117, 2, 337, 1, 10),
(118, 2, 343, 1, 10),
(119, 2, 335, 1, 11),
(120, 2, 336, 1, 11),
(121, 2, 376, 1, 11),
(122, 2, 377, 1, 11),
(123, 2, 359, 1, 11),
(124, 2, 364, 1, 11),
(125, 2, 338, 1, 11),
(126, 2, 339, 1, 11),
(127, 2, 342, 1, 11),
(128, 2, 343, 1, 11),
(129, 2, 371, 1, 11),
(130, 2, 344, 1, 11),
(131, 2, 356, 1, 11),
(132, 2, 392, 1, 11),
(133, 2, 393, 1, 11),
(134, 2, 362, 0, 5),
(135, 2, 374, 0, 5),
(136, 2, 336, 0, 5),
(137, 2, 358, 0, 5),
(138, 2, 375, 0, 5),
(139, 2, 377, 0, 5),
(140, 2, 338, 0, 5),
(141, 2, 379, 0, 5),
(142, 2, 383, 0, 5),
(143, 2, 371, 0, 5),
(144, 2, 353, 0, 5),
(145, 2, 393, 0, 5),
(146, 2, 361, 0, 6),
(147, 2, 362, 0, 6),
(148, 2, 374, 0, 6),
(149, 2, 336, 0, 6),
(150, 2, 358, 0, 6),
(151, 2, 377, 0, 6),
(152, 2, 379, 0, 6),
(153, 2, 380, 0, 6),
(154, 2, 381, 0, 6),
(155, 2, 383, 0, 6),
(156, 2, 371, 0, 6),
(157, 2, 352, 0, 6),
(158, 2, 353, 0, 6),
(159, 2, 393, 0, 6),
(160, 2, 395, 0, 6),
(161, 2, 358, 0, 7),
(162, 2, 365, 0, 7),
(163, 2, 366, 0, 7),
(164, 2, 370, 0, 7),
(165, 2, 362, 0, 8),
(166, 2, 376, 0, 8),
(167, 2, 358, 0, 8),
(168, 2, 377, 0, 8),
(169, 2, 336, 0, 8),
(170, 2, 379, 0, 8),
(171, 2, 380, 0, 8),
(172, 2, 381, 0, 8),
(173, 2, 383, 0, 8),
(174, 2, 371, 0, 8),
(175, 2, 352, 0, 8),
(176, 2, 393, 0, 8),
(177, 2, 400, 0, 9),
(178, 2, 357, 0, 9),
(179, 2, 374, 0, 9),
(180, 2, 336, 0, 9),
(181, 2, 358, 0, 9),
(182, 2, 377, 0, 9),
(183, 2, 379, 0, 9),
(184, 2, 380, 0, 9),
(185, 2, 381, 0, 9),
(186, 2, 386, 0, 9),
(187, 2, 348, 0, 9),
(188, 2, 349, 0, 9),
(189, 2, 355, 0, 9);

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
  `avatar` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `idCustomer`, `lastname`, `firstname`, `sex`, `age`, `height`, `weight`, `avatar`) VALUES
(2, 1, 'Lopezzzzzzzzzz', 'Frederic', 0, 36, 176, 96, 5),
(3, 1, 'Barreau', 'Nathalie', 1, 26, 167, 72, 1),
(6, 2, 'Barreau', 'Nathalie', 1, 25, 160, 70, 1),
(7, 2, 'Durand', 'Jean', 0, 76, 176, 80, 2),
(8, 2, 'Garcia', 'Emmanuel', 0, 35, 175, 120, 3),
(9, 2, 'Morel', 'Marie', 1, 68, 176, 72, 4),
(10, 2, 'Monet', 'François', 0, 35, 180, 78, 5),
(11, 2, 'Bovary', 'Emmanuelle', 1, 24, 160, 60, 1);

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
(19, 6, 5),
(20, 7, 6),
(21, 8, 6),
(22, 10, 6),
(23, 8, 7),
(24, 6, 7),
(25, 7, 7),
(26, 9, 7),
(27, 10, 7),
(28, 9, 8),
(29, 6, 8),
(30, 7, 8),
(31, 8, 8),
(32, 10, 8),
(33, 10, 9),
(34, 6, 9),
(35, 7, 9),
(36, 8, 9),
(37, 9, 9);

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
(42, 2, 'asthme', 'À quand remonte votre dernière crise d\'asthme ?', 'Pardon ?'),
(43, 2, 'cote', 'De quel côté allez-vous être opéré s\'il vous plait ?', 'Excusez-moi ?'),
(44, 2, 'accordALR', 'Vous vous rappelez que vous bénéficierez d\'une anesthésie loco régionale en plus de l\'anésthésie générale ?', 'Hein ? Mais pourquoi ?'),
(45, 2, 'rgo', 'Avez-vous des reflux gastro-oesophagiens?', 'Non.'),
(46, 2, 'traitementCardio', 'Avez-vous pris votre traitement pour le coeur ce matin ? Y a-t-il eu un relais de l\'anti-coagulant par injection à domicile ?', 'Un quoi ?'),
(47, 2, 'jeunTabac', 'Vous n\'avez pas fumé ce matin ?', 'Je ne fume pas.'),
(48, 2, 'lombaire', 'Avez-vous des douleurs lombaires connues ?', 'Non.'),
(49, 2, 'antiH2', 'Vous a on donné un comprimé effervescent contre les reflux gastriques à boire ?', 'Non.'),
(50, 2, 'prothèse', 'Avez-vous une prothèse métallique dans le corps ?', 'Non.'),
(51, 2, 'nuque', 'Avez-vous une raideur au niveau cervical ?', 'Non.'),
(52, 2, 'froid', 'Avez-vous froid ?', 'Non.'),
(53, 2, 'glycémie', 'Avez-vous fait un contrôle HGT ce matin ?', 'Heu, bha non !'),
(54, 2, 'apnée', 'Faites-vous des apnées du sommeil ?', 'Non, jamais.'),
(55, 2, 'coronarien', 'Depuis la dernière consultation d\'anésthésie, vous n\'avez rien à signaler de nouveau sur le plan cardio-vasculaire ?', 'Non, ça va bien.'),
(56, 2, 'aérosol', 'Avez-vous eu un aérosol avant d\'arriver au bloc ?', 'Non.'),
(57, 2, 'enceinte', 'Etes vous enceinte ?', 'Mais enfin, vous vous trompez de patient !');

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
(26, 8, 'Coté gaiche', 0, 1),
(29, 49, 'Oui.', 1, 6),
(30, 47, 'Non, je n\'ai pas fumé depuis hier soir.', 1, 7),
(31, 50, 'Non.', 1, 7),
(32, 51, 'Non, ça va.', 1, 7),
(33, 48, 'Non.', 1, 7),
(34, 52, 'Non, ça va.', 1, 7),
(35, 45, 'Non.', 1, 8),
(36, 53, 'Oui, j\'étais à 0,8 g/l', 1, 8),
(37, 51, 'Non, pas de soucis.', 1, 8),
(38, 54, 'Non, jamais.', 1, 8),
(39, 46, 'Oui je n\'en ai pris qu\'un ce matin. (A REDIGER)', 1, 9),
(40, 50, 'Non.', 1, 9),
(41, 51, 'Non, ça va.', 1, 9),
(42, 55, 'Non, ça va bien.', 1, 9),
(43, 52, 'Non, ça va.', 1, 9),
(44, 42, 'C\'était il y a trois semaines environ.', 1, 10),
(45, 56, 'Oui, je l\'ai bien eu.', 1, 10),
(46, 57, 'Non.', 1, 11),
(47, 48, 'Non.', 0, 6),
(48, 43, 'Du coté gauche.', 0, 7),
(49, 44, 'Bien sur.', 0, 7),
(50, 43, 'Du coté droit.', 0, 8),
(51, 51, 'Non, aucune.', 0, 9);

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
(5, 2, 'Césarienne en urgence', 0, 'histoire 1'),
(6, 2, 'Cysto-prostatectomie voie haute', 0, 'histoire 2'),
(7, 2, 'Ligamentoplastie épaule gauche sous AG + BIS', 0, 'histoire 3'),
(8, 2, 'PTH droite, décubitus latéral gauche', 0, 'histoire 4'),
(9, 2, 'Thyroïdectomie totale', 0, 'histoire 5');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=493;
--
-- AUTO_INCREMENT pour la table `material_liaison`
--
ALTER TABLE `material_liaison`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;
--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `patient_liaison`
--
ALTER TABLE `patient_liaison`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT pour la table `questions_liaison`
--
ALTER TABLE `questions_liaison`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT pour la table `surgery`
--
ALTER TABLE `surgery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
