-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 01 sep. 2023 à 16:15
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `yoga_life`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `etat` varchar(255) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230829114833', '2023-08-29 13:49:11', 131);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `civilite` varchar(255) NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id`, `email`, `roles`, `password`, `pseudo`, `nom`, `prenom`, `civilite`, `statut`, `date_enregistrement`) VALUES
(1, 'admin@admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$qbjZPhN5QXVUSUhbrzY8BeGWRjGFSC16hJkAdn24jpcyJ9.dNkL7i', 'admin', 'Gloria', 'Damase', 'femme', 0, '2023-08-29 14:53:39'),
(2, 'andy@gmail.com', '[]', '$2y$13$RZP5LeHoOtroODw7MGAGNuWXEl99dUlJO7nHbzeQ0qwrGU22apQka', 'andy', 'Andre', 'Giorgios', 'homme', 0, '2023-08-29 14:58:50'),
(3, 'andrea@mail.com', '[]', '$2y$13$NkCW35BTFOIuLoMHjUHd2OHdFhn/Tql35hnvr1cbl7.pWqniL6RQS', 'andrea', 'Andrea', 'Blue', 'femme', 0, '2023-08-29 15:01:57');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `couleur` varchar(50) NOT NULL,
  `collection` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `date_enregristrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `titre`, `description`, `couleur`, `collection`, `photo`, `prix`, `stock`, `date_enregristrement`) VALUES
(1, 'Legging yoga', 'Les leggings taille haute non transparents vous couvrent bien. Ne vous inquiétez pas de la transparence gênante dans les postures de yoga les plus difficiles. Respirez facilement sans avoir l’impression de devoir rentrer votre ventre toute la journée car le tissu épais et extensible maintient tout en place', 'Noir', 'Femme', 'noir-64f058e523737.jpg', 25, 8, '2023-08-31 11:01:40'),
(2, 'Legging yoga', 'Les leggings taille haute non transparents vous couvrent bien. Ne vous inquiétez pas de la transparence gênante dans les postures de yoga les plus difficiles. Respirez facilement sans avoir l’impression de devoir rentrer votre ventre toute la journée car le tissu épais et extensible maintient tout en place', 'Jaune', 'Femme', 'jaune-64f05f3b707ef.jpg', 25, 150, '2023-08-31 11:36:59'),
(3, 'Legging yoga', 'Les leggings taille haute non transparents vous couvrent bien. Ne vous inquiétez pas de la transparence gênante dans les postures de yoga les plus difficiles. Respirez facilement sans avoir l’impression de devoir rentrer votre ventre toute la journée car le tissu épais et extensible maintient tout en place', 'Rouge', 'Femme', 'rouge-64f05f5a1d891.jpg', 25, 200, '2023-08-31 11:37:30'),
(4, 'Legging yoga', 'Les leggings taille haute non transparents vous couvrent bien. Ne vous inquiétez pas de la transparence gênante dans les postures de yoga les plus difficiles. Respirez facilement sans avoir l’impression de devoir rentrer votre ventre toute la journée car le tissu épais et extensible maintient tout en place', 'Bleu', 'Femme', 'bleu-64f05f768ba0d.jpg', 25, 33, '2023-08-31 11:37:58'),
(5, 'Pantalon yoga', 'Pantalon en lin pour homme. Ample et comfortable, parfait pour la pratique du yoga en intérieur comme en extérieur.', 'Beige', 'Homme', 'beige-64f0601388f0e.jpg', 45, 18, '2023-08-31 11:40:35'),
(6, 'Pantalon yoga', 'Pantalon en lin pour homme. Ample et comfortable, parfait pour la pratique du yoga en intérieur comme en extérieur.', 'Blance', 'Homme', 'blanc-64f06038f09bc.jpg', 45, 82, '2023-08-31 11:41:12'),
(7, 'Pantalon yoga', 'Pantalon en lin pour homme. Ample et comfortable, parfait pour la pratique du yoga en intérieur comme en extérieur.', 'Kaki', 'Homme', 'kaki-64f06059343b1.jpg', 45, 33, '2023-08-31 11:41:45'),
(8, 'Pantalon yoga', 'Pantalon en lin pour homme. Ample et comfortable, parfait pour la pratique du yoga en intérieur comme en extérieur.', 'Vert', 'Homme', 'vert-64f0606fd5ca8.jpg', 45, 13, '2023-08-31 11:42:07');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6EEAA67D6A99F74A` (`membre_id`),
  ADD KEY `IDX_6EEAA67DF347EFB` (`produit_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F6B4FB29E7927C74` (`email`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67D6A99F74A` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`),
  ADD CONSTRAINT `FK_6EEAA67DF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
