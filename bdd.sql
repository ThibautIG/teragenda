-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Sam 02 Janvier 2010 à 14:02
-- Version du serveur: 5.1.37
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `agenda`
--

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

CREATE TABLE IF NOT EXISTS `comptes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) CHARACTER SET latin1 NOT NULL,
  `mdp` varchar(32) CHARACTER SET latin1 NOT NULL,
  `mail` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `comptes`
--

INSERT INTO `comptes` (`id`, `pseudo`, `mdp`, `mail`) VALUES
(1, 'nypias', 'a4eec81680b12e38ccb4ebad62efd052', ''),
(2, 'Guillaume', '3799809cd0179cbf0c0f01e9a941eff2', 'tibo@gmail.com'),
(3, 'Mir', 'e469a85c29593c9d8c92923713d6b268', 'laine@machine.mir'),
(4, 'Nypias', 'e513d1ba87c45ae7829e58783bc6f5b6', 'nypipas@gmail.com'),
(5, 'Nopnop', 'e513d1ba87c45ae7829e58783bc6f5b6', 'machin@machin.fr');

-- --------------------------------------------------------

--
-- Structure de la table `fichiers`
--

CREATE TABLE IF NOT EXISTS `fichiers` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) CHARACTER SET latin1 NOT NULL,
  `description` varchar(250) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `fichiers`
--


-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

CREATE TABLE IF NOT EXISTS `participer` (
  `id_comptes` int(11) NOT NULL,
  `id_projets` int(11) NOT NULL,
  PRIMARY KEY (`id_projets`),
  KEY `id_comptes` (`id_comptes`,`id_projets`),
  KEY `id_projets` (`id_projets`),
  KEY `id_comptes_2` (`id_comptes`),
  KEY `id_projets_2` (`id_projets`),
  KEY `id_projets_3` (`id_projets`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `participer`
--


-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE IF NOT EXISTS `projets` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) CHARACTER SET latin1 NOT NULL,
  `date` date NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `projets`
--


-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

CREATE TABLE IF NOT EXISTS `rdv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `duree` int(10) NOT NULL,
  `commentaire` varchar(200) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `rdv`
--

INSERT INTO `rdv` (`id`, `date`, `heure`, `duree`, `commentaire`) VALUES
(1, '0000-00-00', '00:18:48', 2, 'Bonjour'),
(2, '0000-00-00', '00:18:48', 2, 'Bonjour'),
(3, '0000-00-00', '00:18:48', 2, 'Bonjour'),
(4, '0000-00-00', '00:18:48', 2, 'Bonjour'),
(5, '0000-00-00', '00:18:48', 2, 'Bonjour'),
(6, '0000-00-00', '00:18:48', 2, 'Bonjour');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `fichiers`
--
ALTER TABLE `fichiers`
  ADD CONSTRAINT `fichiers_ibfk_1` FOREIGN KEY (`id`) REFERENCES `comptes` (`id`);

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `participer_ibfk_1` FOREIGN KEY (`id_comptes`) REFERENCES `comptes` (`id`),
  ADD CONSTRAINT `participer_ibfk_2` FOREIGN KEY (`id_projets`) REFERENCES `projets` (`id`);

--
-- Contraintes pour la table `projets`
--
ALTER TABLE `projets`
  ADD CONSTRAINT `projets_ibfk_1` FOREIGN KEY (`id`) REFERENCES `comptes` (`id`);
