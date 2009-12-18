-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 18 Décembre 2009 à 18:12
-- Version du serveur: 5.1.36
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `clients`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `societe` tinytext COLLATE latin1_general_ci NOT NULL,
  `nom` text COLLATE latin1_general_ci NOT NULL,
  `datefin` date NOT NULL,
  `prix` int(11) NOT NULL,
  `mensualite` int(11) NOT NULL,
  `abo1` int(11) NOT NULL,
  `abo2` int(11) NOT NULL,
  `reconduction` tinytext COLLATE latin1_general_ci NOT NULL,
  `traite` tinytext COLLATE latin1_general_ci NOT NULL,
  `facture` tinytext COLLATE latin1_general_ci NOT NULL,
  `siteweb` tinytext COLLATE latin1_general_ci NOT NULL,
  `adresse` text COLLATE latin1_general_ci NOT NULL,
  `telephone` tinytext COLLATE latin1_general_ci NOT NULL,
  `commentaire` text COLLATE latin1_general_ci NOT NULL,
  `utilisateur` tinytext COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`id`, `societe`, `nom`, `datefin`, `prix`, `mensualite`, `abo1`, `abo2`, `reconduction`, `traite`, `facture`, `siteweb`, `adresse`, `telephone`, `commentaire`, `utilisateur`) VALUES
(1, 'auieF', '', '2011-11-30', 0, 0, 0, 0, 'Parc', 'Non', 'z', '', '', '', '', 'brice'),
(2, 'auie', 'auie', '2001-01-01', 1500, 120, 0, 0, 'Reco', 'Oui', 'z', '', '', '', '', 'brice'),
(3, 'Google', 'euieuieuie', '2001-01-01', 0, 0, 0, 0, 'Parc', 'Oui', 'Non', '', '', '', '', 'tarek'),
(4, 'SUPER', 'lol', '2012-12-25', 400, 180, 1500, 150, 'Parc', 'Oui', 'Oui', '', '', '04.93.65.66.87', 'RDV le vendredi 15 octobre a Cannes', 'brice'),
(5, 'Vive Le Bépo !', '', '2011-01-01', 99, 0, 1200, 500, 'Parc', 'Non', 'z', '', '', '', '', 'brice'),
(8, 'test01', 'brice', '2009-12-22', 0, 160, 1500, 150, 'Reco', 'Non', 'z', 'www.test-powa-de-la-mort.com', '50, rue du du power', '0493987587', 'aller les bleus', 'brice'),
(9, 'en place', 'mr higgins', '2012-11-30', 0, 0, 1500, 150, 'Parc', 'Oui', 'Non', '', '', '', 'R.A.S', 'tarek');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `comptes`
--

INSERT INTO `comptes` (`id`, `pseudo`, `mdp`, `mail`) VALUES
(1, 'nypias', 'a4eec81680b12e38ccb4ebad62efd052', ''),
(2, 'Guillaume', '3799809cd0179cbf0c0f01e9a941eff2', 'tibo@gmail.com'),
(3, 'Mir', 'e469a85c29593c9d8c92923713d6b268', 'laine@machine.mir'),
(4, 'Nypias', 'e513d1ba87c45ae7829e58783bc6f5b6', 'nypipas@gmail.com');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `rdv`
--

