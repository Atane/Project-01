-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 13 Janvier 2016 à 09:52
-- Version du serveur :  5.6.25
-- Version de PHP :  5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `project-01`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'member',
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `town` varchar(100) NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `token` varchar(255) NOT NULL,
  `exp_token` datetime NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `role`, `email`, `password`, `lastname`, `firstname`, `address`, `zipcode`, `town`, `latitude`, `longitude`, `phone`, `token`, `exp_token`, `created_on`, `updated_on`) VALUES
(1, 'admin', 'p@g.com', '$2y$10$w2Xb8Xwezjjr1H7fgZnu4uTGFqq.vQBo/eqZGnII7auDMAadLSqWu', 'svt', 'pau', '21 rue Pasteur', '75015', 'Paris', NULL, NULL, '0123456789', '', '0000-00-00 00:00:00', '2016-01-11 12:57:47', '2016-01-11 12:57:47'),
(2, 'member', 'p3@g.com', '$2y$10$S3ZxNUaGwEShd8M09o0JteKW1WfU0jN1FNZtd3xqriaWqasrmqhJy', 'dupond', 'bertrand', '122 boulevard de la République', '75008', 'Paris', '48.83901680', '2.30863100', '0123456789', '', '0000-00-00 00:00:00', '2016-01-11 15:43:55', '2016-01-11 15:43:55'),
(3, 'member', 'p2@g.com', '$2y$10$ovxPrM.ym4Q2veUlY5VUzOhYSYblk2m94/syp8zhUsQvNPs3LgQ0i', 'girard', 'victor', '2 rue emile duclaux', '75018', 'Paris', '48.83901680', '2.30863100', '0123456789', '', '0000-00-00 00:00:00', '2016-01-11 15:51:34', '2016-01-11 15:51:34');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
