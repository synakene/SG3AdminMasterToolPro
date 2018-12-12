-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 12 Décembre 2018 à 15:49
-- Version du serveur: 5.5.53-0+deb8u1
-- Version de PHP: 5.6.30-0+deb8u1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `sgtools`
--

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

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
  `examExtra` text NOT NULL,
  `premedicationExtra` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idClient` (`idCustomer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `patient`
--

INSERT INTO `patient` (`id`, `idCustomer`, `lastname`, `firstname`, `sex`, `age`, `height`, `weight`, `avatar`, `story`, `treatments`, `allergies`, `ta`, `fc`, `dentalCondition`, `dentalRiskNotice`, `mallanpati`, `thyroidMentalDistance`, `mouthOpening`, `difficultIntubation`, `difficultVentilation`, `asa`, `preAnestheticExaminations`, `marProposition`, `expectedHospitalisation`, `transfusionStrategy`, `preAnestheticVisit`, `premedication`, `examExtra`, `premedicationExtra`) VALUES
(1, 2, 'Barreau', 'Nathalie', 1, 25, 160, 0, 1, '- 2 FIV    (fécondation in vitro)\n- RGO gravidique  (reflux gastroœsophagien)\n- Pas de syndrome hémorragique', 'Fer et acide folique  (Tardyféron B9 *)\nAnti-acide (Gaviscon*)', '{}', '140/80', 80, 'RAS', 1, 3, 66, 36, 1, 0, 0, '{"Groupe 1":true,"Groupe 2":true,"Phénotype":true,"RAI":true,"NF":true}', 1, 0, '', 'Pas de cathéter péridural en place car non souhaité par Mme B', '{"eve":[""],"morning":[""]}', 'Grossesse à terme\nAuscultation cardiopulmonaire normale', ''),
(2, 2, 'Durand', 'Jean', 0, 76, 176, 80, 2, 'Tabac actif (10 cigarettes /jour)\nBPCO post tabagique\nAblation Saphènes x 2  (il y a 2 ans)\nCholecystectomie (il y a 5 ans)', 'Terbutaline LP ( Bricanyl*) : bronchodilatateur bêta-2-mimétique\n           1cp matin et soir', '{}', '130/70', 85, 'RAS', 1, 2, 66, 36, 0, 0, 2, '{}', 1, 0, '', 'Auscultation cardio-pulmonaire normale.', '{"eve":["Anxiolytique",""],"morning":["Aérosol :","Terbutaline ( Bricanyl*)   &  Anticholinergique (Bricanyl*)","Anxiolytique",""]}', '', 'A jeun le :  date à regler !!\n            Solides : 6 h avant bloc\n            Liquides : 2 h avant bloc'),
(4, 2, 'Morel', 'Marie', 1, 68, 176, 72, 4, 'ATCD chirurgicaux :\n-Hernies inguinales x2\nATCD médicaux:\n- Angor d''effort\n- Fibrillation auriculaire (FA)\n- Pas de coagulopathie clinique.', 'Bétabloquant ( Soprol* ) 5mg le matin\nAnticoagulant ( Préviscan*) 1 cp le soir\n', '{}', '130/80', 65, '1 appareil dentaire supérieur', 1, 1, 66, 36, 0, 0, 2, '{"Groupe 1":true,"Groupe 2":true,"Phénotype":true,"RAI":true,"NF":true,"TP":true,"Iono":true,"ECG":true,"INR":true}', 1, 0, '', 'Auscultation cardiopulmonaire normale.', '{"eve":["INR : Selon résultat, Vitamine K : 5 mg","HBPM (lovenox*) 0,4 ",""],"morning":["Contrôle TP/INR","Bétabloquant (soprol*)",""]}', 'Activité > 4 MET\nECG: FA : ST normal  , Pas de trouble de conduction', 'A jeun le :  jour du bloc (à regler !!!)\n                 Solides : 6h avant bloc\n                 Liquides clairs : 2h avant bloc'),
(5, 2, 'Monet', 'Frédéric', 0, 35, 180, 78, 5, 'Appendicectomie dans l''enfance.\nAsthme équilibré (dernière crise il y a cinq mois)', 'Innovair* (corticoïde &beta2-agoniste) : 1 bouffée matin et soir.', '{"Pollens":true}', '130', 70, 'Bon', 1, 2, 66, 36, 0, 0, 2, '{}', 1, 0, '', 'Auscultation pulmonaire normale', '{"eve":["néant",""],"morning":["néant",""]}', 'Pas de coagulopathie clinique', 'A jeun le :    jour du bloc  àregler !!!!!\n            Solides : 6 h avant bloc\n            Liquides : 2 h avant bloc'),
(6, 2, 'Garcia', 'Emmanuel', 0, 35, 175, 120, 3, 'Diabète insulino-requérant (équilibré) depuis 15 ans. Pas d''angor,  ni hypertension.\nFracture du fémur il y a 10 ans suite à un accident de moto.\nPas de gastroparésie, pas de microangiopathie\nSuivi endocrinologue < 1 mois\nSigne du prieur négatif', 'Insuline rapide (Novo-rapide*) :12 UI le matin\nInsuline (Lantus*) : 30 UI le soir', '{}', '130/60', 95, 'Bon', 1, 2, 64, 36, 1, 0, 2, '{}', 3, 0, '', '', '{"eve":["néant"],"morning":["néant"]}', 'Auscultation cardiopulmonaire normale', 'A jeun le :  date à regler !!!\n                 Solides : 6h avant bloc\n                 Liquides: 2 h avant bloc'),
(7, 4, 'Barreau', 'Nathalie', 1, 25, 160, 70, 1, '- 2FIV\n- RGO gravioique\n- Pas de syndrome hémorragique', 'Tardyféron B9\nGaviston (anti-acide)', '{}', '140/80', 80, 'RAS', 1, 3, 66, 36, 1, 0, 2, '{}', 0, 0, '', '', '{"eve":[],"morning":[]}', '', ''),
(8, 4, 'Durand', 'Jean', 0, 76, 176, 80, 2, 'Tabac actif (bciq/jour)\nBPCO post tabagique\nSAPHENES x2 (il y a 2 ans)\ncholecystectomie (il y a 2 ans)', 'Dricanyl (mimétique)\n1cp matin et soir', '{}', '130/70', 85, '', 1, 2, 66, 36, 0, 0, 2, '{}', 1, 0, '', 'Auscultation cardio-pulmonaire normale.', '{"eve":["Anxiolitique"],"morning":["Gérosol","Atrovut + bricayl","Gaxiolitique"]}', '', ''),
(9, 4, 'Morel', 'Marie', 1, 68, 176, 72, 4, 'ATCD chirurgicaux :\n-Hernies injuinales x2\n- Anjor d''effort\n- 2 stents il y a 5 ans\n- Fibrillation auriculaire (FA)\n- Pas de coagulation clinique.', 'Soprol (betabloquant)\n5mg le soir\nPréviscan (anticoagulant)\n1cp /jour le soir', '{}', '130/80', 65, '1 appareil dentaire supérieur', 1, 1, 66, 36, 0, 0, 2, '{"Groupe 1":true, "Groupe 2":true, "RAI":true, "Cross NF":true, "TP":true, "Iono":true, "INR":true, "Coraticoagulant":true}', 1, 0, '', 'Auscultation cardiopulmonaire normale.', '{"eve":["VitamineK 5mg"],"morning":["Contrôle TP_INR"]}', '', ''),
(10, 4, 'Monet', 'François', 0, 35, 180, 78, 5, 'Appendicectomie dans l''enfance.\nAsthme équilibré.', 'Innovair\n1 bouffée matin et soir.', '{"Pollen":true}', '130', 70, '', 1, 2, 66, 36, 0, 0, 2, '{}', 1, 0, '', 'Ausculatation pulmonaire normale', '{"eve":[],"morning":[]}', '', ''),
(11, 4, 'Garcia', 'Emmanuel', 0, 35, 175, 120, 3, 'Diabète insulino-requérant (équilibré) depuis 15 ans. Pas d''angor ni hypertension.\nFracture du fémur il y a 10 ans suite à un accident de moto.', 'Novo-rapide (insuline rapide)\n12 UI le matin\nLantus (insuline)\n30 UI le soir', '{}', '130/60', 95, 'RAI', 1, 2, 64, 36, 1, 0, 2, '{}', 0, 0, '', '', '{"eve":[],"morning":[]}', '', ''),
(12, 1, 'Doe', 'John', 0, 0, 0, 0, 5, '', '', '{}', '0/0', 0, '', 0, 1, 64, 34, 0, 0, 1, '{}', 0, 0, '', '', '{"eve":[""],"morning":[""]}', '', ''),
(13, 6, 'Barreau', 'Nathalie', 1, 25, 160, 70, 1, '- 2FIV\n- RGO gravioique\n- Pas de syndrome hémorragique', 'Tardyféron B9\nGaviston (anti-acide)', '{}', '140/80', 80, 'RAS', 1, 3, 66, 36, 1, 0, 2, '{}', 0, 0, '', '', '{"eve":[],"morning":[]}', '', ''),
(14, 6, 'Durand', 'Jean', 0, 76, 176, 80, 2, 'Tabac actif (bciq/jour)\nBPCO post tabagique\nSAPHENES x2 (il y a 2 ans)\ncholecystectomie (il y a 2 ans)', 'Dricanyl (mimétique)\n1cp matin et soir', '{}', '130/70', 85, '', 1, 2, 66, 36, 0, 0, 2, '{}', 1, 0, '', 'Auscultation cardio-pulmonaire normale.', '{"eve":["Anxiolitique"],"morning":["Gérosol","Atrovut + bricayl","Gaxiolitique"]}', '', ''),
(15, 6, 'Morel', 'Marie', 1, 68, 176, 72, 4, 'ATCD chirurgicaux :\n-Hernies inguinales x2\nATCD médicaux:\n- Angor d''effort\n- 2 stents il y a 5 ans\n- Fibrillation auriculaire (FA)\n- Pas de coagulopathie clinique.', 'Bétabloquant ( Soprol* 5mg le matin)\nAnticoagulant( Préviscan* 1 cp le soir)\n', '{}', '130/80', 65, '1 appareil dentaire supérieur', 1, 1, 66, 36, 0, 0, 2, '{"Groupe 1":true, "Groupe 2":true, "Phénotype":true, "RAI":true, "Cross NF":true, "TP":true, "Iono":true, "INR: Selon résultat":true, "vitamine K 5 mg":true}', 1, 0, '', 'Auscultation cardiopulmonaire normale.', '{"eve":["INR : Selon résultat, Vitamine K, 5 mg"],"morning":["Contrôle TP/INR","Bétabloquant "]}', '', ''),
(16, 6, 'Monet', 'Frédéric', 0, 35, 180, 78, 5, 'Appendicectomie dans l''enfance.\nAsthme équilibré.', 'Innovair\n1 bouffée matin et soir.', '{"Pollen":true}', '130', 70, '', 1, 2, 66, 36, 0, 0, 2, '{}', 1, 0, '', 'Ausculatation pulmonaire normale', '{"eve":[],"morning":[]}', '', ''),
(17, 6, 'Garcia', 'Emmanuel', 0, 35, 175, 120, 3, 'Diabète insulino-requérant (équilibré) depuis 15 ans. Pas d''angor ni hypertension.\nFracture du fémur il y a 10 ans suite à un accident de moto.', 'Novo-rapide (insuline rapide)\n12 UI le matin\nLantus (insuline)\n30 UI le soir', '{}', '130/60', 95, 'RAI', 1, 2, 64, 36, 1, 0, 2, '{}', 1, 0, '', '', '{"eve":[],"morning":[]}', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
