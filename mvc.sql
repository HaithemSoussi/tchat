-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 15 nov. 2020 à 19:54
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

DROP TABLE IF EXISTS `groupes`;
CREATE TABLE IF NOT EXISTS `groupes` (
  `id` int(11) DEFAULT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  KEY `uniqueGroup` (`id`,`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groupes`
--

INSERT INTO `groupes` (`id`, `pseudo`) VALUES
(1, 'Haithem81'),
(1, 'yahoo'),
(2, 'Haithem81'),
(2, 'soussi2'),
(3, 'Haithem81'),
(3, 'sqdsq'),
(4, 'Haithem81'),
(4, 'Soussi22'),
(5, 'soussi2'),
(5, 'yahoo'),
(6, 'soussi2'),
(6, 'sqdsq'),
(7, 'sqdsq'),
(7, 'yahoo'),
(8, 'Soussi22'),
(8, 'yahoo');

-- --------------------------------------------------------

--
-- Structure de la table `historymessages`
--

DROP TABLE IF EXISTS `historymessages`;
CREATE TABLE IF NOT EXISTS `historymessages` (
  `id` int(11) NOT NULL,
  `message` text,
  `sender` varchar(45) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `sender_idx` (`sender`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text,
  `senderpseudo` varchar(45) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `senderpseudo_idx` (`senderpseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `message`, `senderpseudo`, `group_id`, `time`) VALUES
(1, 'salut', 'yahoo', 1, '2020-11-15 19:53:23'),
(2, 'comment cava', 'yahoo', 1, '2020-11-15 19:54:21');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `pseudo` varchar(15) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo_UNIQUE` (`pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `pseudo`, `email`, `password`, `created_at`) VALUES
(1, 'Soussi', 'Haithem', 'Haithem81', 'haithem.soussi@gmail.com', '25f9e794323b453885f5181f1b624d0b', '2020-11-12 23:32:36'),
(2, 'yahoo', 'yahoo', 'yahoo', 'haithem_t@yahoo.fr', '25f9e794323b453885f5181f1b624d0b', '2020-11-12 23:32:36'),
(3, 'user', 'user1', 'User1', 'user1@gmail.com', '3f21a5649afbd36ebc56dfa83a3c3b53', '2020-11-12 23:32:36'),
(6, 'soussi2', 'haithem2', 'soussi2', 'haithem.soussi2@gmail.com', '25f9e794323b453885f5181f1b624d0b', '2020-11-12 23:32:36'),
(7, 'soussi22', 'haithem22', 'Soussi22', 'haithem.soussi22@gmail.com', '25f9e794323b453885f5181f1b624d0b', '2020-11-12 23:32:36'),
(14, 'sqdqs', 'sqdqs', 'sqdsq', 'haithem.soussidez@gmail.com', '25f9e794323b453885f5181f1b624d0b', '2020-11-13 11:04:22');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `group_id` FOREIGN KEY (`group_id`) REFERENCES `groupes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `senderpseudo` FOREIGN KEY (`senderpseudo`) REFERENCES `users` (`pseudo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
