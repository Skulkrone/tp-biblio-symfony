-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 15 mai 2018 à 12:55
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bibliotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherents`
--

DROP TABLE IF EXISTS `adherents`;
CREATE TABLE IF NOT EXISTS `adherents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `adherents`
--

INSERT INTO `adherents` (`id`, `nom`, `prenom`) VALUES
(1, 'Baron', 'Laurent'),
(2, 'Delangle', 'Max'),
(3, 'Bailleul', 'Steve'),
(4, 'Dufour', 'Guillaume');

-- --------------------------------------------------------

--
-- Structure de la table `emprunts`
--

DROP TABLE IF EXISTS `emprunts`;
CREATE TABLE IF NOT EXISTS `emprunts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fklivre_id` int(11) NOT NULL,
  `fkadherents_id` int(11) NOT NULL,
  `date_emprunt` datetime NOT NULL,
  `date_retour` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_38FC80DB3BEF99A` (`fklivre_id`),
  KEY `IDX_38FC80D227D53CD` (`fkadherents_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `emprunts`
--

INSERT INTO `emprunts` (`id`, `fklivre_id`, `fkadherents_id`, `date_emprunt`, `date_retour`) VALUES
(1, 1, 1, '2018-05-07 10:00:00', '2018-05-22 16:00:00'),
(3, 3, 2, '2018-04-01 00:00:00', '2018-05-07 00:00:00'),
(4, 2, 4, '2017-11-16 00:00:00', '2018-01-01 00:00:00'),
(5, 4, 3, '2018-05-07 00:00:00', '2018-05-17 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `titre`, `description`) VALUES
(1, 'Le Seigneur des Anneaux', 'Le Seigneur des anneaux (The Lord of the Rings) est un roman en trois volumes de J. R. R. Tolkien paru en 1954 et 1955.'),
(2, 'PHP pour les nuls', 'Le livre best-seller sur PHP & MySQL !\r\n\r\nAvec cette 5e édition de PHP et MySQL pour les Nuls, vous verrez qu\'iln\'est plus nécessaire d\'être un as de la programmation pour développerdes sites Web dynamiques et interactifs.'),
(3, 'Great Teacher Onizuka', 'Great Teacher Onizuka (グレート・ティーチャー・オニヅカ, Gurēto Tīchā Onizuka?), souvent abrégé en GTO, est un shōnen manga racontant l\'histoire de Eikichi Onizuka professeur dans une école. L\'histoire de GTO suit celle de Young GTO (Shonan jun\'ai gumi), suivant elle-même celle de Bad Company, du même auteur (31 volumes pour Young GTO et un double volume pour Bad Company).'),
(4, 'The Definite Guide to Symfony', 'Lors de la création d\'applications, utiliser un framework (cadre de développement) améliore le développement en automatisant certaines tâches récurrentes . En apportant une structure, un framework guide le développeur lors de l\'écriture. Il l\'aide à produire un code plus propre, plus efficace et plus facile à maintenir. De plus, les opérations complexes s\'y retrouvent découpées en processus simples et organisés. Le développement s\'en trouve facilité.\r\n\r\nSymfony est un framework complet, configuré pour accélérer le développement d\'applications web grâce à plusieurs fonctionnalités décisives. La première est sa structure même, qui guide les débutants en séparant distinctement les traitements liés au modèle fonctionnel, de ceux qui sont du ressort de la présentation ou de la logique serveur. Ensuite, il propose au développeur de nombreuses classes et de nombreux outils qui assistent et accélèrent la création d\'une application web complexe. Il automatise ainsi les tâches les plus courantes, permettant au développeur de se concentrer sur les spécificités de l\'application. Au final, le bénéfice apporté est tout simplement qu\'on ne réinvente plus la roue à chaque nouvelle application développée !\r\n\r\nSymfony a été entièrement codé en PHP5. Il a été intensivement testé sur de nombreux sites en production comme des sites d\'e-commerce à très fort trafic. Symfony est compatible avec la majorité des moteurs de base de données comme MySQL, PostgreSQL, Oracle ou Microsoft SQL Server. Il fonctionne aussi bien sur les plates-formes Windows que *nix. Voyons de plus près quelles sont ses fonctionnalités.');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20180508210534');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD CONSTRAINT `FK_38FC80D227D53CD` FOREIGN KEY (`fkadherents_id`) REFERENCES `adherents` (`id`),
  ADD CONSTRAINT `FK_38FC80DB3BEF99A` FOREIGN KEY (`fklivre_id`) REFERENCES `livre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
