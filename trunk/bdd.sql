-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Sam 02 Janvier 2010 à 21:24
-- Version du serveur: 5.1.36
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `comptes`
--

INSERT INTO `comptes` (`id`, `pseudo`, `mdp`, `mail`) VALUES
(1, 'nypias', 'a4eec81680b12e38ccb4ebad62efd052', ''),
(2, 'Guillaume', '3799809cd0179cbf0c0f01e9a941eff2', 'tibo@gmail.com'),
(3, 'Mir', 'e469a85c29593c9d8c92923713d6b268', 'laine@machine.mir'),
(4, 'Nypias', 'e513d1ba87c45ae7829e58783bc6f5b6', 'nypipas@gmail.com'),
(5, 'Nopnop', 'e513d1ba87c45ae7829e58783bc6f5b6', 'machin@machin.fr'),
(6, 'Robi', '3b2d1cff4e5f26161db372ab5e50600d', 'robi@test.com');

-- --------------------------------------------------------

--
-- Structure de la table `est_admin`
--

CREATE TABLE IF NOT EXISTS `est_admin` (
  `id_comptes` int(11) NOT NULL,
  `id_projets` int(11) NOT NULL,
  PRIMARY KEY (`id_comptes`,`id_projets`),
  KEY `id_projets` (`id_projets`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `est_admin`
--


-- --------------------------------------------------------

--
-- Structure de la table `fichiers`
--

CREATE TABLE IF NOT EXISTS `fichiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_comptes_envoyer` int(11) NOT NULL,
  `id_projets_comprend` int(11) NOT NULL,
  `id_rdv_contenir` int(11) NOT NULL,
  `nom` varchar(50) CHARACTER SET latin1 NOT NULL,
  `description` varchar(250) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_rdv_contenir` (`id_rdv_contenir`),
  KEY `id_compte_envoyer` (`id_comptes_envoyer`),
  KEY `id_projet_comprend` (`id_projets_comprend`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id_comptes`,`id_projets`),
  KEY `id_projets` (`id_projets`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `participer`
--

INSERT INTO `participer` (`id_comptes`, `id_projets`) VALUES
(6, 5);

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE IF NOT EXISTS `projets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET latin1 NOT NULL,
  `date` date NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `projets`
--

INSERT INTO `projets` (`id`, `nom`, `date`, `description`) VALUES
(5, 'eaueei', '0000-00-00', 'auie');

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

CREATE TABLE IF NOT EXISTS `rdv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_compte_a_cree` int(11) NOT NULL,
  `id_projet_posseder` int(11) NOT NULL,
  `date` date NOT NULL,
  `heuredeb` time NOT NULL,
  `heurefin` time NOT NULL,
  `commentaire` varchar(200) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_compte_a_cree` (`id_compte_a_cree`),
  KEY `id_projet_posseder` (`id_projet_posseder`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `rdv`
--

INSERT INTO `rdv` (`id`, `id_compte_a_cree`, `id_projet_posseder`, `date`, `heuredeb`, `heurefin`, `commentaire`) VALUES
(1, 1, 5, '2010-01-05', '16:45:00', '18:00:00', 'de 16h45 a 18h00'),
(8, 6, 5, '2010-01-07', '01:00:00', '02:30:00', '1h a 2h30 jeudi');

-- --------------------------------------------------------

--
-- Structure de la table `valider`
--

CREATE TABLE IF NOT EXISTS `valider` (
  `id_comptes` int(11) NOT NULL,
  `id_rdv` int(11) NOT NULL,
  PRIMARY KEY (`id_comptes`,`id_rdv`),
  KEY `id_rdv` (`id_rdv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `valider`
--


--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `est_admin`
--
ALTER TABLE `est_admin`
  ADD CONSTRAINT `est_admin_ibfk_1` FOREIGN KEY (`id_comptes`) REFERENCES `comptes` (`id`),
  ADD CONSTRAINT `est_admin_ibfk_2` FOREIGN KEY (`id_projets`) REFERENCES `projets` (`id`);

--
-- Contraintes pour la table `fichiers`
--
ALTER TABLE `fichiers`
  ADD CONSTRAINT `fichiers_ibfk_2` FOREIGN KEY (`id_rdv_contenir`) REFERENCES `rdv` (`id`),
  ADD CONSTRAINT `fichiers_ibfk_3` FOREIGN KEY (`id_comptes_envoyer`) REFERENCES `comptes` (`id`),
  ADD CONSTRAINT `fichiers_ibfk_4` FOREIGN KEY (`id_projets_comprend`) REFERENCES `projets` (`id`);

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `participer_ibfk_1` FOREIGN KEY (`id_comptes`) REFERENCES `comptes` (`id`),
  ADD CONSTRAINT `participer_ibfk_2` FOREIGN KEY (`id_projets`) REFERENCES `projets` (`id`);

--
-- Contraintes pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD CONSTRAINT `rdv_ibfk_1` FOREIGN KEY (`id_compte_a_cree`) REFERENCES `comptes` (`id`),
  ADD CONSTRAINT `rdv_ibfk_2` FOREIGN KEY (`id_projet_posseder`) REFERENCES `projets` (`id`);

--
-- Contraintes pour la table `valider`
--
ALTER TABLE `valider`
  ADD CONSTRAINT `valider_ibfk_2` FOREIGN KEY (`id_rdv`) REFERENCES `rdv` (`id`),
  ADD CONSTRAINT `valider_ibfk_1` FOREIGN KEY (`id_comptes`) REFERENCES `comptes` (`id`);
