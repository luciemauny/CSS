-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 07 nov. 2020 à 18:34
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `critique_jeux_plateau`
--

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

CREATE TABLE `amis` (
  `id_amis` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `amis`
--

INSERT INTO `amis` (`id_amis`, `id_utilisateur`) VALUES
(1, 4),
(1, 5),
(2, 5),
(3, 2),
(5, 1),
(5, 2),
(6, 2),
(6, 5);

-- --------------------------------------------------------

--
-- Structure de la table `critique`
--

CREATE TABLE `critique` (
  `id_critique` int(11) NOT NULL,
  `bio` text DEFAULT NULL,
  `id_jeu` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `critique`
--

INSERT INTO `critique` (`id_critique`, `bio`, `id_jeu`, `id_utilisateur`) VALUES
(16, 'Un jeu vraiment très agréable.Une prise en main facile, des illustrations très réussies, durée de partie idéale, possibilité du jouer de 2 à 7 joueurs', 1, 1),
(17, 'Jeu agréable, on enchaine les parties mais je lui préfère quand même son petit frère \"Duel\"', 1, 2),
(18, 'Un bon jeu, simple et efficace avec une bonne tension : il faut rester vigilent au risque de se faire pourrir son enchainement d\'actions.', 2, 6),
(19, 'J\'ai bien aimé et j\'aime encore y jouer à l\'occasion.Là on reprend en partie le même concept, avec en plus un joli train du far west, cooool!Mais bon ça ne marche pas à mon gout.', 2, 4),
(20, 'Plaisant, mais pas assez de profondeur pour espérer en faire des dizaines de parties', 12, 2),
(21, 'Voila un jeu surprenant et bien plus profond (sans jeu de mot) qu\'il n\'y parait', 12, 3),
(22, 'Les nombreux icônes sur les cartes et la capacité de chaque lieu/personnage peuvent sembler un peu obscurs au début, mais le jeu prend tout son sens quand la partie est lancée.', 12, 1),
(23, 'Jeu de mémoire très simple, mais qui est un must pour l\'apprentissage des tout-petits. Si ils jouent régulièrement, ils deviennent très forts, et augmentent leur mémoire visuelle.', 5, 5),
(24, 'Un incontournable, surtout avec les plus jeunes. En plus, on a bonne conscience à faire travailler son cerveau. Mais ça lasse vite, pas deux parties d\'affilée sous peine de se mélanger les pinceaux.', 5, 4),
(25, 'Jeu basique qui fait son travail ! Séduit petit comme grand pour passer un bon dimanche pluvieux !', 4, 3),
(26, 'Jeu un peu lent qui peut durer des heures ! Je vous conseille de donner moins d\'argent en début de partie !', 4, 5),
(27, 'Un jeu qui reprend l\'idée du monoply mais avec l\'installation des hôtels en 3D on s\'y croit vraiment !!', 6, 2),
(28, 'Ce jeu va vous assurer un très bons moment !! Cependant on a vite fait de s\'en lasser, je regrette un peu de l\'avoir acheté', 6, 1),
(29, 'Jeu très bien pour les enfants, dommage qu\'il ne leur enseigne rien derrière', 7, 6),
(30, 'Très beau jeu en bois : J\'y ai joué toute mon enfance et je prend toujours du plaisir à faire une partie avec mes neveux ', 3, 5),
(31, 'Je n\'aime pas du tout ce jeu, il est très ennuyant et les anfants n\'y trouvent aucun intérêt. Je préfère qu\'ils jouent à des jeux plus ludiques au risque qu\'ils ne leur enseignent rien', 5, 6);

-- --------------------------------------------------------

--
-- Structure de la table `edition`
--

CREATE TABLE `edition` (
  `id_edition` int(11) NOT NULL,
  `nom_edition` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `edition`
--

INSERT INTO `edition` (`id_edition`, `nom_edition`) VALUES
(1, 'Asmodee '),
(2, 'Nathan'),
(3, 'Ravensburger'),
(4, 'Hasbro'),
(7, 'Dujardin'),
(8, 'Jeujura'),
(9, 'GIGAMIC');

-- --------------------------------------------------------

--
-- Structure de la table `jeu`
--

CREATE TABLE `jeu` (
  `id_jeu` int(11) NOT NULL,
  `nom_jeu` varchar(255) DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `id_jeu_type_jeu` int(11) DEFAULT NULL,
  `id_edition` int(11) DEFAULT NULL,
  `bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `jeu`
--

INSERT INTO `jeu` (`id_jeu`, `nom_jeu`, `prix`, `id_jeu_type_jeu`, `id_edition`, `bio`) VALUES
(1, '7 Wonders', 38.99, 1, 1, 'Vous voilà dirigeant de l’une des sept plus grandes cités de l’Antiquité. Développez votre cité en multipliant les découvertes scientifiques, les conquêtes militaires, les accords commerciaux et les édifices prestigieux pour mener votre civilisation vers la gloire !'),
(2, 'Colt Express', 29.99, 1, 1, 'Revivez les grands westerns en incarnant un bandit de l’Ouest sauvage ! Chacun choisit à tour de rôle parmi sa main une action à effectuer, ces dernières étant empilées au fur et à mesure de la manche puis dévoilées successivement (comme si vous écriviez le scénario avant de le voir se dérouler)'),
(3, 'Jeu de l\'oie', 14, 2, 2, 'Qui sera le plus rapide à finir le parcours ? Un jeu de vitesse et de chance où il faudra être le plus rapide pour remporter la partie.'),
(4, 'Monopoly', 17.95, 4, 3, 'Avancez autour du plateau en achetant le plus de propriétés (rues, gares et services publics) possible. Plus vous possédez de propriétés, plus vous percevrez de loyer. Si vous êtes le dernier joueur en jeu quand tous les autres ont fait faillite, vous gagnez !'),
(5, 'Memory', 12.99, 3, 3, 'Le plus célèbre des jeux de mémoire, avec d\'attendrissantes photos de bébés animaux !\r\nCette passionnante chasse aux images demande mémoire et concentration.\r\nQui retrouvera le premier les paires de cartes identiques de bébés animaux ?'),
(6, 'Hôtel', 29.99, 4, 7, 'Le but du jeu consiste à ruiner ses concurrents par des opérations immobilières.'),
(7, 'Jeu des petits chevaux', 14, 2, 8, 'Qui sera le plus rapide à finir le parcours ? Le grand classique du jeu de plateau des petits chevaux.'),
(12, 'Atlante', 40.49, 1, 9, 'Incarnez un puissant roi des Océans et menez votre royaume à la prospérité ! Pour gagner, vous devez conquérir ou acheter des lieux, recruter de nouveaux personnages et atteindre vos objectifs.');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id_note` int(11) NOT NULL,
  `note` float DEFAULT NULL,
  `id_jeu` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id_note`, `note`, `id_jeu`, `id_utilisateur`) VALUES
(16, 10, 12, 1),
(17, 6, 1, 2),
(18, 8, 2, 6),
(19, 6, 2, 4),
(20, 7, 12, 2),
(21, 9, 12, 3),
(22, 8, 12, 1),
(23, 8, 5, 5),
(24, 4, 5, 4),
(25, 8, 4, 3),
(26, 8, 4, 5),
(27, 9, 6, 2),
(28, 3, 6, 1),
(29, 6, 3, 6),
(30, 8, 7, 5),
(31, 6, 3, 6),
(32, 8, 7, 5),
(33, 3, 5, 6),
(34, 6, 2, 5);

-- --------------------------------------------------------

--
-- Structure de la table `note_critique`
--

CREATE TABLE `note_critique` (
  `id_note_critique` int(11) NOT NULL,
  `id_critique` int(11) NOT NULL,
  `note_critique` tinyint(1) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `note_critique`
--

INSERT INTO `note_critique` (`id_note_critique`, `id_critique`, `note_critique`, `id_utilisateur`) VALUES
(18, 28, 0, 1),
(19, 28, 0, 2),
(20, 28, 1, 6),
(21, 17, 0, 5),
(23, 25, 0, 3),
(24, 25, 1, 5),
(25, 26, 0, 4),
(26, 20, 0, 2),
(27, 20, 0, 1),
(28, 29, 1, 6),
(29, 21, 0, 3),
(30, 21, 1, 6),
(31, 30, 0, 6),
(33, 18, 0, 3),
(34, 27, 1, 2),
(35, 16, 0, 3),
(36, 23, 1, 5),
(38, 31, 0, 5);

-- --------------------------------------------------------

--
-- Structure de la table `type_jeu`
--

CREATE TABLE `type_jeu` (
  `id_type_jeu` int(11) NOT NULL,
  `nom_type_jeu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_jeu`
--

INSERT INTO `type_jeu` (`id_type_jeu`, `nom_type_jeu`) VALUES
(1, 'Stratégie'),
(2, 'Hasard'),
(3, 'Mémoire'),
(4, 'Parcours');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `adresse_postale` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `telephone` int(11) DEFAULT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `type_jeu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `prenom`, `nom`, `date_naissance`, `adresse_postale`, `mail`, `password`, `telephone`, `pseudo`, `type_jeu`) VALUES
(1, 'Justine', 'Martin', '2001-11-03', '3 rue des Vergers Sevenans', 'justine.martin1@utbm.fr', 'juju2001', 654348712, 'Juju', 3),
(2, 'Lucie', 'Mauny', '2001-04-26', '14 quai Emile Keller Belfort', 'lucie.mauny@utbm.fr', 'Lulu2001', 783031686, 'Lulu', 2),
(3, 'Paul', 'Dubois', '1995-05-13', '10 rue Marcel Paul Andelnans', 'paul.dubois@gmail.com', 'paulodbs', 654348715, 'Paulo', 4),
(4, 'Xavier', 'Bertrand', '1985-12-06', '1 rue du général de Gaulle Paris', 'xavier.bertrand@outlook.com', 'XAVIER1987', 783031683, 'Xavier.brt', 2),
(5, 'Professeur', 'Layton', '2020-01-20', '20 rue de la réussite Angleterre', 'professeur.layton@gmail.com', 'CeProjetEstVraimentGenial', 118218, 'Professeur ', 1),
(6, 'Marie', 'Rouliot', '2002-08-24', '5 faubourg de France Tours', 'marie.rouliot@gmail.com', 'RouliotM', 783031643, 'Mariiiiiie', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `amis`
--
ALTER TABLE `amis`
  ADD PRIMARY KEY (`id_amis`,`id_utilisateur`),
  ADD KEY `id_amis` (`id_amis`,`id_utilisateur`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `critique`
--
ALTER TABLE `critique`
  ADD PRIMARY KEY (`id_critique`),
  ADD KEY `id_jeu` (`id_jeu`,`id_utilisateur`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `edition`
--
ALTER TABLE `edition`
  ADD PRIMARY KEY (`id_edition`);

--
-- Index pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD PRIMARY KEY (`id_jeu`),
  ADD KEY `id_jeu_type_jeu` (`id_jeu_type_jeu`),
  ADD KEY `id_edition` (`id_edition`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id_note`),
  ADD KEY `id_jeu` (`id_jeu`,`id_utilisateur`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `note_critique`
--
ALTER TABLE `note_critique`
  ADD PRIMARY KEY (`id_note_critique`),
  ADD KEY `id_critique` (`id_critique`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `type_jeu`
--
ALTER TABLE `type_jeu`
  ADD PRIMARY KEY (`id_type_jeu`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_jeu` (`type_jeu`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `critique`
--
ALTER TABLE `critique`
  MODIFY `id_critique` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `edition`
--
ALTER TABLE `edition`
  MODIFY `id_edition` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `id_jeu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `note_critique`
--
ALTER TABLE `note_critique`
  MODIFY `id_note_critique` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `type_jeu`
--
ALTER TABLE `type_jeu`
  MODIFY `id_type_jeu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `amis`
--
ALTER TABLE `amis`
  ADD CONSTRAINT `amis_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `amis_ibfk_2` FOREIGN KEY (`id_amis`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `critique`
--
ALTER TABLE `critique`
  ADD CONSTRAINT `critique_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `critique_ibfk_3` FOREIGN KEY (`id_jeu`) REFERENCES `jeu` (`id_jeu`);

--
-- Contraintes pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD CONSTRAINT `jeu_ibfk_1` FOREIGN KEY (`id_jeu_type_jeu`) REFERENCES `type_jeu` (`id_type_jeu`),
  ADD CONSTRAINT `jeu_ibfk_2` FOREIGN KEY (`id_edition`) REFERENCES `edition` (`id_edition`);

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`id_jeu`) REFERENCES `jeu` (`id_jeu`),
  ADD CONSTRAINT `note_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `note_critique`
--
ALTER TABLE `note_critique`
  ADD CONSTRAINT `note_critique_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `note_critique_ibfk_2` FOREIGN KEY (`id_critique`) REFERENCES `critique` (`id_critique`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`type_jeu`) REFERENCES `type_jeu` (`id_type_jeu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
