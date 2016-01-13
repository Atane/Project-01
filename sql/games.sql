-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 13 Janvier 2016 à 09:51
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
(8, 'WoW', 'http://wow.com', 'jeu', '2015-11-03 00:00:00', 0, NULL, NULL, NULL, 1, 2);

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
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
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
