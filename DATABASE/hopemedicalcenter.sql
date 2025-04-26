-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 16 avr. 2025 à 19:08
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hopemedicalcenter`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrationsoin`
--

DROP TABLE IF EXISTS `administrationsoin`;
CREATE TABLE IF NOT EXISTS `administrationsoin` (
  `id_admin_soin` int NOT NULL AUTO_INCREMENT,
  `dateheure_soin` datetime DEFAULT NULL,
  `type_soin` varchar(127) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description_detailler` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `dure_soin` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `observation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_patient` int DEFAULT NULL,
  `id_agent` int NOT NULL,
  PRIMARY KEY (`id_admin_soin`),
  KEY `id_patient` (`id_patient`),
  KEY `id_agent` (`id_agent`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `administrationsoin`
--

INSERT INTO `administrationsoin` (`id_admin_soin`, `dateheure_soin`, `type_soin`, `description_detailler`, `dure_soin`, `observation`, `id_patient`, `id_agent`) VALUES
(18, '2025-02-05 21:18:00', 'injection', 'cétait bien ', '25', 'OK', 2, 1),
(19, '2025-02-12 23:15:00', 'suivi', 'Opération', '45', 'Normal', 8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

DROP TABLE IF EXISTS `agent`;
CREATE TABLE IF NOT EXISTS `agent` (
  `id_agent` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `postnom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `AdresseMail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sexe` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_specialite` int DEFAULT NULL,
  `id_fonction` int DEFAULT NULL,
  PRIMARY KEY (`id_agent`),
  KEY `id_specialite` (`id_specialite`),
  KEY `id_fonction` (`id_fonction`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`id_agent`, `nom`, `postnom`, `prenom`, `telephone`, `AdresseMail`, `sexe`, `adresse`, `id_specialite`, `id_fonction`) VALUES
(1, 'MPATA', 'KATAWANDJA', 'ANGELOT', '0948466374', 'angelot@gmail.com', 'Homme', 'Lingwala', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `lib_categ` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `lib_categ`) VALUES
(1, 'Privé'),
(2, 'Société');

-- --------------------------------------------------------

--
-- Structure de la table `consultation`
--

DROP TABLE IF EXISTS `consultation`;
CREATE TABLE IF NOT EXISTS `consultation` (
  `id_consultation` int NOT NULL AUTO_INCREMENT,
  `id_pre` int DEFAULT NULL,
  `id_agent` int DEFAULT NULL,
  `Diagnose_medicale` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Traitement_medical` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `medicament_pris` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `motif_consultation` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `symptome_actuel` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `atecedant_medicaux` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `atecedant_chirurgicaux` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `atecedant_familiaux` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_et_heure_consultation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_consultation`),
  KEY `id_pre` (`id_pre`),
  KEY `id_agent` (`id_agent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `demandexamen`
--

DROP TABLE IF EXISTS `demandexamen`;
CREATE TABLE IF NOT EXISTS `demandexamen` (
  `id_examen` int NOT NULL AUTO_INCREMENT,
  `id_consultation` int DEFAULT NULL,
  `id_TypExamen` int DEFAULT NULL,
  `id_MotifExamen` int DEFAULT NULL,
  `partieCorpsConcernee` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `AntecedentMedicauxDemande` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `TraitementEncours` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_examen`),
  KEY `id_TypExamen` (`id_TypExamen`),
  KEY `id_MotifExamen` (`id_MotifExamen`),
  KEY `id_consultation` (`id_consultation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fonction`
--

DROP TABLE IF EXISTS `fonction`;
CREATE TABLE IF NOT EXISTS `fonction` (
  `id_fonction` int NOT NULL AUTO_INCREMENT,
  `lib_fonction` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_fonction`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fonction`
--

INSERT INTO `fonction` (`id_fonction`, `lib_fonction`) VALUES
(1, 'RECEPTIONNISTE'),
(2, 'CAISSIER');

-- --------------------------------------------------------

--
-- Structure de la table `hospitalisation`
--

DROP TABLE IF EXISTS `hospitalisation`;
CREATE TABLE IF NOT EXISTS `hospitalisation` (
  `id_hospitalisation` int NOT NULL AUTO_INCREMENT,
  `etat_patient` varchar(127) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_patient` int DEFAULT NULL,
  `date_admission` date DEFAULT NULL,
  `date_sortie_prevue` date DEFAULT NULL,
  `id_agent` int DEFAULT NULL,
  PRIMARY KEY (`id_hospitalisation`),
  KEY `id_patient` (`id_patient`),
  KEY `id_agent` (`id_agent`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `hospitalisation`
--

INSERT INTO `hospitalisation` (`id_hospitalisation`, `etat_patient`, `id_patient`, `date_admission`, `date_sortie_prevue`, `id_agent`) VALUES
(1, 'CRITIQUE', 6, '2025-02-20', '2025-02-14', 1),
(2, 'NORMA', 5, '2025-02-04', '2025-01-30', 1),
(3, 'NORMAL', 10, '2025-01-26', '2025-01-10', 1),
(4, 'CRITIQUE', 13, '2024-07-02', '2025-03-08', 1);

-- --------------------------------------------------------

--
-- Structure de la table `modepaiement`
--

DROP TABLE IF EXISTS `modepaiement`;
CREATE TABLE IF NOT EXISTS `modepaiement` (
  `id_Modepaiement` int NOT NULL AUTO_INCREMENT,
  `lib_Modepaiement` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numero_transaction` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_Modepaiement`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `modepaiement`
--

INSERT INTO `modepaiement` (`id_Modepaiement`, `lib_Modepaiement`, `numero_transaction`) VALUES
(1, 'En espèce', '09944884344'),
(2, 'Chèque', '039388477774'),
(3, 'Carte credit', '98474484449');

-- --------------------------------------------------------

--
-- Structure de la table `motifexamen`
--

DROP TABLE IF EXISTS `motifexamen`;
CREATE TABLE IF NOT EXISTS `motifexamen` (
  `id_MotifExamen` int NOT NULL AUTO_INCREMENT,
  `lib_MotifExamen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_MotifExamen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `motifpaiement`
--

DROP TABLE IF EXISTS `motifpaiement`;
CREATE TABLE IF NOT EXISTS `motifpaiement` (
  `id_Motifpaie` int NOT NULL AUTO_INCREMENT,
  `lib_Motifpaie` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_Motifpaie`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `motifpaiement`
--

INSERT INTO `motifpaiement` (`id_Motifpaie`, `lib_Motifpaie`, `prix`) VALUES
(1, 'Fiche de consultation', 20.00),
(2, 'Frais de laboratoire', 56.00),
(3, 'Frais des examens', 45.00);

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `id_paie` int NOT NULL AUTO_INCREMENT,
  `montant` decimal(10,2) DEFAULT NULL,
  `date_paie` date DEFAULT NULL,
  `id_Motifpaie` int DEFAULT NULL,
  `id_patient` int DEFAULT NULL,
  `id_Modepaiement` int DEFAULT NULL,
  `id_agent` int DEFAULT NULL,
  PRIMARY KEY (`id_paie`),
  KEY `id_Motifpaie` (`id_Motifpaie`),
  KEY `id_patient` (`id_patient`),
  KEY `id_Modepaiement` (`id_Modepaiement`),
  KEY `id_agent` (`id_agent`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id_paie`, `montant`, `date_paie`, `id_Motifpaie`, `id_patient`, `id_Modepaiement`, `id_agent`) VALUES
(3, 23000.00, '2025-02-14', 1, 2, 1, 1),
(4, 34445.00, '2025-02-14', 3, 17, 2, 1),
(5, 20.00, '2025-02-14', 1, 13, 1, 1),
(6, 56.00, '2025-02-14', 2, 12, 2, 1),
(7, 20.00, '2025-02-14', 1, 11, 3, 1),
(8, 56.00, '2025-02-14', 2, 3, 3, 1),
(10, 56.00, '2025-02-14', 2, 2, 3, 1),
(11, NULL, '2025-02-14', NULL, 2, NULL, 1),
(12, NULL, '2025-02-14', NULL, 8, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id_patient` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `postnom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Datenaiss` date DEFAULT NULL,
  `AdresseMail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sexe` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_categorie` int DEFAULT NULL,
  `id_agent` int DEFAULT NULL,
  PRIMARY KEY (`id_patient`),
  KEY `id_categorie` (`id_categorie`),
  KEY `id_agent` (`id_agent`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id_patient`, `nom`, `postnom`, `prenom`, `telephone`, `Datenaiss`, `AdresseMail`, `sexe`, `adresse`, `id_categorie`, `id_agent`) VALUES
(1, 'Oradie Lelo', 'MPATAAAA', 'Angelot', '2333333', '2025-02-26', 'deigelepalmier@gmail.com', 'M', 'Kintambo', 1, 1),
(2, 'MPATA', 'MPATAAAA', 'Angelot', '235677777', '2025-02-04', 'deigelepalmier@gmail.com', 'M', 'Usoke N°148 direction province référence huilerie/Usoke', 1, 1),
(3, 'KIABU', 'KIABU', 'FELIX', '9434893489', '2025-02-26', 'deigelepalmier@gmail.com', 'M', 'Usoke N°148 direction province référence huilerie/Usoke', 1, 1),
(4, 'FELIX ', 'FELIX ', 'Caleb', '665342567', '2025-02-19', 'deigelepalmier@gmail.com', 'M', 'Usoke N°148 direction province référence huilerie/Usoke', 1, 1),
(5, 'ANGELOT', 'ANGELOT', 'ANGELOT', '384844884', '2025-02-17', 'deigelepalmier@gmail.com', 'F', 'Usoke N°148 direction province référence huilerie/Usoke', 1, 1),
(6, 'LOMAVINA', 'MPATA', 'KAWANDJA', '3676442482478', '2025-02-25', 'angelotmpata@gmail.com', 'F', 'Kintambo', 1, 1),
(7, 'LOMAVINA', 'MPATA', 'KAWANDJA', '3676442482478', '2025-02-25', 'angelotmpata@gmail.com', 'F', 'Kintambo', 1, 1),
(8, 'LOMAVINA', 'MPATA', 'KAWANDJA', '3676442482478', '2025-02-25', 'angelotmpata@gmail.com', 'F', 'Kintambo', 1, 1),
(9, 'LOMAVINA', 'MPATA', 'KAWANDJA', '3676442482478', '2025-02-25', 'angelotmpata@gmail.com', 'F', 'Kintambo', 1, 1),
(10, 'Oradie Lelo', 'KIABU', 'Oradie', '243546', '2025-02-18', 'deigelepalmier@gmail.com', 'M', 'Kintambo', 1, 1),
(11, 'AKILI', 'MULOKO', 'JEMIRA', '0820387447', '2024-08-11', 'akilium@gmail.com', 'M', 'LIGWALA', 1, 1),
(12, 'MICHEL', 'MATUNGA', 'PAPA', '933939474747', '2025-02-10', 'angelotmpata@gmail.com', 'M', 'GEMENA', 1, 1),
(13, 'MBANGO', 'NYONGO', 'CHANTAL', '093484474', '2025-02-24', 'angelot@gmail.com', 'F', 'GEMENA', 1, 1),
(14, 'Oradie Lelo', 'MPATAAAA', 'Angelot', '325', '2025-02-25', 'deigelepalmier@gmail.com', 'M', 'Kintambo', 1, 1),
(15, 'AAAAAA', 'AAAAAAAA', 'AAAAAAAA', '77777', '2025-02-18', 'deigelepalmier@gmail.com', 'M', 'Usoke N°148 direction province référence huilerie/Usoke', 1, 1),
(16, 'LOMAVINA', 'MPATA', 'ANGELOT', '399893893', '2025-02-18', 'deigelepalmier@gmail.com', 'M', 'Usoke N°148 direction province référence huilerie/Usoke', 1, 1),
(17, 'Oradie', 'MPATAAAA', 'Oradie', '29394888', '2025-02-02', 'deigelepalmier@gmail.com', 'M', 'Kintambo', 2, 1),
(18, 'aganze', 'murhamya', 'moise', '0998776666', '2000-09-12', 'aga@gmail.com', 'M', 'NGALIEMA JJJJJ', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `prelevement`
--

DROP TABLE IF EXISTS `prelevement`;
CREATE TABLE IF NOT EXISTS `prelevement` (
  `id_pre` int NOT NULL AUTO_INCREMENT,
  `dateetheure` datetime DEFAULT NULL,
  `temperature` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tension_arterielle` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Frequence_cardiaque` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Frequence_respiratoire` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Examens_systeme` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_patient` int DEFAULT NULL,
  `id_agent` int DEFAULT NULL,
  PRIMARY KEY (`id_pre`),
  KEY `id_agent` (`id_agent`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prelevement`
--

INSERT INTO `prelevement` (`id_pre`, `dateetheure`, `temperature`, `tension_arterielle`, `Frequence_cardiaque`, `Frequence_respiratoire`, `Examens_systeme`, `id_patient`, `id_agent`) VALUES
(1, '2025-02-14 20:43:23', '5335', '7373', '3636', '73773', '3773', 13, 1);

-- --------------------------------------------------------

--
-- Structure de la table `resultat_examen`
--

DROP TABLE IF EXISTS `resultat_examen`;
CREATE TABLE IF NOT EXISTS `resultat_examen` (
  `id_resultat` int NOT NULL AUTO_INCREMENT,
  `id_examen` int DEFAULT NULL,
  `analyse_sang` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `examen_imagerie` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `autres_examens` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_agent` int DEFAULT NULL,
  PRIMARY KEY (`id_resultat`),
  KEY `id_examen` (`id_examen`),
  KEY `id_agent` (`id_agent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

DROP TABLE IF EXISTS `specialite`;
CREATE TABLE IF NOT EXISTS `specialite` (
  `id_specialite` int NOT NULL AUTO_INCREMENT,
  `lib_specialite` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_specialite`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `specialite`
--

INSERT INTO `specialite` (`id_specialite`, `lib_specialite`) VALUES
(1, 'Oculiste'),
(2, 'pediatre');

-- --------------------------------------------------------

--
-- Structure de la table `typeexamen`
--

DROP TABLE IF EXISTS `typeexamen`;
CREATE TABLE IF NOT EXISTS `typeexamen` (
  `id_TypExamen` int NOT NULL AUTO_INCREMENT,
  `lib_TypExamen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_TypExamen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `administrationsoin`
--
ALTER TABLE `administrationsoin`
  ADD CONSTRAINT `administrationsoin_ibfk_1` FOREIGN KEY (`id_patient`) REFERENCES `patient` (`id_patient`) ON DELETE CASCADE,
  ADD CONSTRAINT `administrationsoin_ibfk_2` FOREIGN KEY (`id_agent`) REFERENCES `agent` (`id_agent`) ON DELETE CASCADE;

--
-- Contraintes pour la table `agent`
--
ALTER TABLE `agent`
  ADD CONSTRAINT `agent_ibfk_1` FOREIGN KEY (`id_specialite`) REFERENCES `specialite` (`id_specialite`),
  ADD CONSTRAINT `agent_ibfk_2` FOREIGN KEY (`id_fonction`) REFERENCES `fonction` (`id_fonction`);

--
-- Contraintes pour la table `consultation`
--
ALTER TABLE `consultation`
  ADD CONSTRAINT `consultation_ibfk_1` FOREIGN KEY (`id_pre`) REFERENCES `prelevement` (`id_pre`),
  ADD CONSTRAINT `consultation_ibfk_2` FOREIGN KEY (`id_agent`) REFERENCES `agent` (`id_agent`);

--
-- Contraintes pour la table `demandexamen`
--
ALTER TABLE `demandexamen`
  ADD CONSTRAINT `examen_ibfk_1` FOREIGN KEY (`id_TypExamen`) REFERENCES `typeexamen` (`id_TypExamen`),
  ADD CONSTRAINT `examen_ibfk_2` FOREIGN KEY (`id_MotifExamen`) REFERENCES `motifexamen` (`id_MotifExamen`),
  ADD CONSTRAINT `examen_ibfk_3` FOREIGN KEY (`id_consultation`) REFERENCES `consultation` (`id_consultation`);

--
-- Contraintes pour la table `hospitalisation`
--
ALTER TABLE `hospitalisation`
  ADD CONSTRAINT `hospitalisation_ibfk_1` FOREIGN KEY (`id_patient`) REFERENCES `patient` (`id_patient`),
  ADD CONSTRAINT `hospitalisation_ibfk_2` FOREIGN KEY (`id_agent`) REFERENCES `agent` (`id_agent`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`id_Motifpaie`) REFERENCES `motifpaiement` (`id_Motifpaie`),
  ADD CONSTRAINT `paiement_ibfk_2` FOREIGN KEY (`id_patient`) REFERENCES `patient` (`id_patient`),
  ADD CONSTRAINT `paiement_ibfk_3` FOREIGN KEY (`id_Modepaiement`) REFERENCES `modepaiement` (`id_Modepaiement`),
  ADD CONSTRAINT `paiement_ibfk_5` FOREIGN KEY (`id_agent`) REFERENCES `agent` (`id_agent`);

--
-- Contraintes pour la table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`),
  ADD CONSTRAINT `patient_ibfk_2` FOREIGN KEY (`id_agent`) REFERENCES `agent` (`id_agent`);

--
-- Contraintes pour la table `prelevement`
--
ALTER TABLE `prelevement`
  ADD CONSTRAINT `prelevement_ibfk_1` FOREIGN KEY (`id_agent`) REFERENCES `agent` (`id_agent`);

--
-- Contraintes pour la table `resultat_examen`
--
ALTER TABLE `resultat_examen`
  ADD CONSTRAINT `resultat_examen_ibfk_1` FOREIGN KEY (`id_examen`) REFERENCES `demandexamen` (`id_examen`),
  ADD CONSTRAINT `resultat_examen_ibfk_2` FOREIGN KEY (`id_agent`) REFERENCES `agent` (`id_agent`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
