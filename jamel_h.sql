-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 23 avr. 2019 à 13:08
-- Version du serveur :  10.1.36-MariaDB
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `jamel_h`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE `annonces` (
  `id` int(11) NOT NULL,
  `kg` int(10) NOT NULL,
  `dimension` varchar(20) NOT NULL,
  `type_objet` varchar(20) NOT NULL,
  `mode_livraison` varchar(20) NOT NULL,
  `depart` varchar(255) NOT NULL,
  `reception` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id`, `kg`, `dimension`, `type_objet`, `mode_livraison`, `depart`, `reception`, `description`, `prix`) VALUES
(40, 10, 'Documents', 'Standard', 'Domicile', '11 bd  du marechal joffre 90000 belfort', '7 rue de stockholm 90000 belfort', 'sa marche ou pas ?!!!!!!!!!!!!!!!!!!!!', 10),
(41, 2, 'Petit colis', 'Standard', 'Domicile', '11 bd  du marechal joffre 90000 belfort', '7 rue de stockholm 90000 belfort', 'lundi c\'est la merde ', 10);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `code_postal` varchar(20) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `numero_tel` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `adresse`, `code_postal`, `pays`, `mail`, `numero_tel`, `password`) VALUES
(24, 'Hamimed', 'Bilel', '', '', '', 'lakronique@yahoo.fr', '', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(25, 'haddar', 'Jamel', '', '', '', 'bilel.h@codeur.online', '', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(33, 'funny', 'fanny ', '', '', '', 'fanny@hotmail.fr', '', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Structure de la table `clients_annonces`
--

CREATE TABLE `clients_annonces` (
  `id_client` int(11) NOT NULL,
  `id_annonce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `clients_annonces`
--

INSERT INTO `clients_annonces` (`id_client`, `id_annonce`) VALUES
(24, 40),
(24, 41);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients_annonces`
--
ALTER TABLE `clients_annonces`
  ADD PRIMARY KEY (`id_annonce`,`id_client`) USING BTREE,
  ADD KEY `id_client` (`id_client`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `clients_annonces`
--
ALTER TABLE `clients_annonces`
  ADD CONSTRAINT `annonces_clients` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clients_annonces` FOREIGN KEY (`id_annonce`) REFERENCES `annonces` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
