-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 13 Janvier 2016 à 17:37
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
-- Structure de la table `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `id` int(10) unsigned NOT NULL,
  `game_name` varchar(255) NOT NULL,
  `url_img` varchar(255) DEFAULT NULL,
  `description` text,
  `published_at` datetime DEFAULT NULL,
  `game_time` int(10) unsigned DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `platform_id` int(10) unsigned NOT NULL,
  `owner_user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `games`
--

INSERT INTO `games` (`id`, `game_name`, `url_img`, `description`, `published_at`, `game_time`, `is_available`, `created_at`, `updated_at`, `platform_id`, `owner_user_id`) VALUES
(1, 'Star Wars Battlefront', 'http://static.fnac-static.com/multimedia/Images/FR/NR/0a/dc/6e/7265290/1540-1.jpg', 'Jeu ', '2015-11-19 00:00:00', 10, NULL, NULL, NULL, 1, 2),
(1, 'Rainbow Six Siege', 'http://static.fnac-static.com/multimedia/Images/FR/NR/cf/7e/5c/6061775/1540-1.jpg', 'Inspiré par les vraies organisations anti-terroristes, Rainbow Six Siege met l''accent sur des affrontements en combat rapproché. ', '2015-12-01 00:00:00', 5, NULL, NULL, NULL, 3, 3),
(2, 'Dying Light', 'http://static.fnac-static.com/multimedia/Images/FR/NR/f9/4a/50/5262073/1540-1.jpg', 'Dying Light est un jeu de survival horror et d''action à la première personne dont l''histoire se déroule dans un vaste monde ouvert infesté de dangers. Le jour, les joueurs exploreront un vaste environnement urbain en essayant désespérément d''y trouver toutes sortes de provisions et d''armes pour se protéger de la population infectée en perpétuelle croissance. La nuit, les infectés se montreront plus agressifs et plus violents et les chasseurs deviendront les proies. Les prédateurs qui n''apparaîtront qu''après le coucher du soleil seront plus terrifiants encore. Les joueurs devront utiliser toutes les ressources à leur disposition pour tenter de survivre jusqu''aux premières lueurs du jour.', '2015-02-26 00:00:00', 8, NULL, NULL, NULL, 1, 1),
(3, 'FIFA 16', 'http://static.fnac-static.com/multimedia/Images/FR/NR/1f/f2/6d/7205407/1540-1.jpg', 'Un gameplay principalement basé sur la construction de jeu, une défense nettement améliorée, des graphismes de plus en plus perfectionnés, FIFA 16 est bel est bien annoncé comme le meilleur FIFA de la série. Chaussez les crampons aux côtés de Ronaldo et Messi et relevez le défi FIFA 16.', '2015-09-24 00:00:00', NULL, NULL, NULL, NULL, 2, 2),
(4, 'Tom Clancy''s The Division', 'http://static.fnac-static.com/multimedia/Images/FR/NR/18/84/50/5276696/1540-1.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1),
(6, 'fifa', '', '', '0000-00-00 00:00:00', 0, NULL, NULL, NULL, 2, 1),
(7, 'LoL', 'http://lol.com', 'jeu', '0000-00-00 00:00:00', 0, NULL, NULL, NULL, 1, 3),
(8, 'WoW', 'http://wow.com', 'jeu', '2015-11-03 00:00:00', 0, NULL, NULL, NULL, 1, 2),
(16, 'barbie2.0', 'http://lol.com', 'jeu', '2015-11-11 00:00:00', 0, NULL, NULL, NULL, 4, 0),
(17, 'mario', 'http://wow.com', 'jeu', '2015-11-27 00:00:00', 0, NULL, NULL, NULL, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `platforms`
--

CREATE TABLE IF NOT EXISTS `platforms` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `platforms`
--

INSERT INTO `platforms` (`id`, `name`) VALUES
(1, 'PC'),
(2, 'Wii'),
(3, 'PS4'),
(4, 'Xbox');

-- --------------------------------------------------------

--
-- Structure de la table `rentals`
--

CREATE TABLE IF NOT EXISTS `rentals` (
  `id` int(10) unsigned NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'waiting',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `game_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `token` varchar(255) DEFAULT NULL,
  `exp_token` datetime DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `role`, `email`, `password`, `lastname`, `firstname`, `address`, `zipcode`, `town`, `latitude`, `longitude`, `phone`, `token`, `exp_token`, `created_on`, `updated_on`, `ip`) VALUES
(1, 'admin', 'p@g.com', '$2y$10$w2Xb8Xwezjjr1H7fgZnu4uTGFqq.vQBo/eqZGnII7auDMAadLSqWu', 'svt', 'pau', '21 rue Pasteur', '75015', 'Paris', NULL, NULL, '0123456789', 'f04c627707c3fa69b0775335fd545138', '2016-01-14 17:32:13', '2016-01-11 12:57:47', '2016-01-11 12:57:47', '::1'),
(2, 'member', 'p3@g.com', '$2y$10$S3ZxNUaGwEShd8M09o0JteKW1WfU0jN1FNZtd3xqriaWqasrmqhJy', 'dupond', 'bertrand', '122 boulevard de la République', '75008', 'Paris', '48.83901680', '2.30863100', '0123456789', '', '0000-00-00 00:00:00', '2016-01-11 15:43:55', '2016-01-11 15:43:55', NULL),
(3, 'member', 'p2@g.com', '$2y$10$ovxPrM.ym4Q2veUlY5VUzOhYSYblk2m94/syp8zhUsQvNPs3LgQ0i', 'girard', 'victor', '2 rue emile duclaux', '75018', 'Paris', '48.83901680', '2.30863100', '0123456789', '', '0000-00-00 00:00:00', '2016-01-11 15:51:34', '2016-01-11 15:51:34', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`,`platform_id`,`owner_user_id`),
  ADD KEY `fk_games_platforms_idx` (`platform_id`),
  ADD KEY `fk_games_users1_idx` (`owner_user_id`);

--
-- Index pour la table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`,`user_id`),
  ADD KEY `fk_renting_games1_idx` (`game_id`),
  ADD KEY `fk_renting_users1_idx` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`platform_id`) REFERENCES `platforms` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
