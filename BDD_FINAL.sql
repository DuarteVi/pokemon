-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 14 mai 2019 à 23:27
-- Version du serveur :  10.1.34-MariaDB
-- Version de PHP :  7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `duartev`
--
CREATE DATABASE IF NOT EXISTS `duartev` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `duartev`;

-- --------------------------------------------------------

--
-- Structure de la table `Ami`
--

CREATE TABLE `Ami` (
  `moi` int(11) NOT NULL,
  `lui` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Ami`
--

INSERT INTO `Ami` (`moi`, `lui`) VALUES
(1, 9),
(1, 42),
(1, 44),
(9, 1),
(42, 1),
(42, 9);

-- --------------------------------------------------------

--
-- Structure de la table `Attaque`
--

CREATE TABLE `Attaque` (
  `numA` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `degat` int(11) NOT NULL,
  `pp` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `description` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Attaque`
--

INSERT INTO `Attaque` (`numA`, `nom`, `degat`, `pp`, `type`, `description`) VALUES
(1, 'Escalade', 90, 20, 10, 'Le lanceur se jette violemment sur l\'ennemi. Peut aussi le rendre confus.'),
(2, 'Uppercut', 70, 10, 10, 'Un enchaînement de coups de poing cadencés. Peut aussi rendre confus.'),
(3, 'Attrition', 70, 20, 10, 'Une attaque puissante quand l\'ennemi baisse sa garde. Inflige des dégâts sans tenir compte des changements de stats.'),
(4, 'Vitesse Extrême', 80, 5, 10, 'Le lanceur charge à  une vitesse renversante. Cette attaque a toujours lancer en premier.'),
(5, 'Tranche', 70, 20, 10, 'Un coup de griffe ou autre tranche l\'ennemi. Taux de critiques élevé.'),
(6, 'Plaquage', 85, 15, 10, 'Le lanceur se laisse tomber sur l\'ennemi de tout son poids. Peut le paralyser.'),
(7, 'Charge', 50, 35, 10, 'Le lanceur charge l\'ennemi et le percute de tout son corps.'),
(8, 'Force Poigne', 55, 30, 10, 'L\'ennemi est attrapé et compressé par les côtés.'),
(9, 'Griffe', 40, 35, 10, 'Lacère l\'ennemi avec des griffes acérées pour lui infliger des dégâts.'),
(10, 'Ultimapoing', 80, 20, 10, 'L\'ennemi reçoit un coup de poing d\'une puissance incroyable.'),
(11, 'Coupe', 50, 30, 10, 'Coupe l\'ennemi avec des lames ou des griffes. Hors combat, permet de couper des arbres fins.'),
(12, 'Furie', 15, 20, 10, 'Frappe l\'ennemi 2 à  5 fois d\'affilée avec un bec ou une corne.'),
(13, 'Coup de Boule', 70, 15, 10, 'Le lanceur donne un coup de tête. Peut apeurer l\'ennemi.'),
(14, 'Ultimawashi', 120, 5, 10, 'Un coup de pied superpuissant et intense qui frappe l\'ennemi.'),
(15, 'Souplesse', 80, 75, 10, 'Fouette l\'ennemi avec la queue, une liane, etc. pour infliger des dégâts.'),
(16, 'Écras Face', 40, 35, 10, '	Écrase l\'ennemi avec les pattes avant, la queue, etc.'),
(17, 'Vive-Attaque', 40, 30, 10, 'Le lanceur fonce sur l\'ennemi si rapidement qu\'on parvient à  peine à  le discerner. Frappe en premier.'),
(18, 'Force', 80, 15, 10, 'Le lanceur cogne l\'ennemi de toutes ses forces. Permet aussi de déplacer des rochers.'),
(19, 'Dynamopoing', 100, 5, 2, 'Le lanceur rassemble ses forces et envoie un coup de poing à  l\'ennemi. S\'il est touché, il est confus.'),
(20, 'Double Pied', 30, 30, 2, 'Deux coups de pied qui frappent l\'ennemi deux fois d\'affilée.'),
(21, 'Éclate-Roc', 40, 15, 2, 'Porte un coup dévastateur à  l\'ennemi. Peut briser des rochers fissurés. Peut baisser la Défense.'),
(22, 'Poing-Karaté', 50, 25, 2, 'L\'ennemi est tranché violemment. Taux de critiques élevé.'),
(23, 'Coup-Croix', 100, 5, 2, 'Le lanceur délivre un coup double en croisant les avant-bras. Taux de critiques élevé.'),
(24, 'Onde Vide', 40, 30, 2, 'Le lanceur agite son poing pour projeter une onde de vide. Frappe toujours en premier.'),
(25, 'Mawashi Geri', 60, 15, 2, 'Le lanceur effectue un coup de pied tournoyant et extrêmement rapide. Peut apeurer l\'ennemi.'),
(26, 'Poing Boost', 40, 20, 2, ''),
(27, 'Stratopercut', 85, 15, 2, 'Le lanceur attaque avec un uppercut. Il envoie son poing vers le ciel de toutes ses forces.'),
(28, 'Aurasphère', 80, 20, 2, 'Le lanceur dégage une aura et projette de l\'énergie. N\'échoue jamais.'),
(29, 'Mach Punch', 40, 30, 2, 'Coup de poing fulgurant. Frappe en premier.'),
(30, 'Forte-Paume', 60, 10, 2, 'Une onde de choc frappe l\'ennemi. Peut aussi paralyser la cible.'),
(31, 'Casse-Brique', 75, 15, 2, 'Permet aussi de briser les barrières comme Mur Lumière et Protection.'),
(32, 'Exploforce', 120, 5, 2, 'Le lanceur rassemble ses forces et laisse éclater son pouvoir. Peut aussi baisser la Défense Spéciale de l\'ennemi.'),
(33, 'Balayage', 40, 20, 2, 'Un puissant coup de pied bas qui fauche l\'ennemi.'),
(34, 'Frappe Atlas', 70, 20, 2, 'L\'ennemi est projeté grâce au pouvoir de la gravité.'),
(35, 'Pied Voltige', 130, 10, 2, 'Le lanceur s\'élance pour effectuer un coup de genou sauté. S\'il échoue, le lanceur se blesse.'),
(36, 'Mitra-Poing', 150, 20, 2, 'Le lanceur se concentre avant d\'attaquer. Échoue s\'il est touché avant d\'avoir frappé.'),
(37, 'Aéropique', 60, 20, 18, 'Le lanceur prend l\'ennemi de vitesse et le lacère. N\'échoue Jamais.'),
(38, 'Tranch Air', 60, 25, 18, 'Le lanceur appelle des vents tranchants qui lacèrent l\'ennemi. Taux de critiques élevé.'),
(39, 'Lame dAir', 75, 15, 18, 'Le lanceur attaque avec une lame d\'air qui fend tout. Peut aussi apeurer l\'ennemi.'),
(40, 'Picpic', 35, 35, 18, 'Frappe l\'ennemi d\'un bec pointu ou d\'une corne pour infliger des dégâts.'),
(41, 'Chute Libre', 60, 10, 18, 'Le lanceur emmène l\'ennemi dans les airs et le lâche dans le vide.'),
(42, 'Bec Vrille', 80, 20, 18, 'Une attaque utilisant le bec comme une perceuse.'),
(43, 'Acrobatie', 55, 15, 18, 'Attaque agile. Si le lanceur ne tient pas d\'objet, l\'attaque inflige davantage de dégâts.'),
(44, 'Vent Violent', 110, 10, 18, 'Le lanceur déclenche une tempête de vents violents qui s\'abat sur l\'ennemi. Peut aussi le rendre confus.'),
(45, 'Piqué', 140, 5, 18, 'Une attaque au taux de critiques élevé. Peut aussi apeurer l\'ennemi.'),
(46, 'Vol', 90, 15, 18, 'Le lanceur s\'envole et frappe. Permet aussi de voler jusqu\'à  une ville déjà  visitée.'),
(47, 'Cru-Aile', 60, 35, 18, 'L\'ennemi est frappé par de larges ailes déployées pour infliger des dégâts.'),
(48, 'Tornade', 40, 35, 18, ''),
(49, 'Aéroblast', 100, 5, 18, 'Le lanceur projette une tornade sur l\'ennemi pour infliger des dégâts. Taux de critiques élevé.'),
(50, 'Rebond', 85, 5, 18, 'Le lanceur bondit très haut et plonge sur l\'ennemi au 2è tour. Peut aussi paralyser l\'ennemi.'),
(51, 'Picore', 60, 20, 18, 'Le lanceur picore la cible. Si cette dernière tient une Baie, le lanceur la mange et profite de ses effets.'),
(52, 'Rapace', 120, 15, 18, 'Le lanceur replie ses ailes et charge en rase-mottes. Le lanceur subit aussi de graves dégâts.'),
(53, 'Acide', 40, 30, 12, 'Le lanceur attaque l\'ennemi avec un jet d\'acide corrosif. Peut aussi baisser la Défense Spéciale de l\'ennemi.'),
(54, 'Détricanon', 120, 5, 12, 'Le lanceur envoie des détritus sur l\'ennemi. Peut aussi l\'empoisonner.'),
(55, 'Poison-Croix', 70, 20, 12, 'Un coup tranchant qui peut empoisonner l\'ennemi. Taux de critiques élevé.'),
(56, 'Bain de Smog', 50, 15, 12, 'Le lanceur jette un tas de détritus spéciaux sur la cible. Les changements de stats de la cible sont annulés.'),
(57, 'Gaz Toxik', 60, 40, 12, 'Un nuage de gaz toxique est projeté au visage de l\'ennemi. Peut l\'empoisonner.'),
(58, 'Direct Toxik', 80, 20, 12, 'Attaque l\'ennemi avec un tentacule ou un bras plein de poison. Peut aussi l\'empoisonner.'),
(59, 'Purédpois', 30, 20, 12, 'Le lanceur attaque à  l\'aide d\'une éruption de gaz répugnants. Peut aussi empoisonner l\'ennemi.'),
(60, 'Détritus', 65, 20, 12, 'Des détritus toxiques sont projetés sur l\'ennemi. Peut aussi l\'empoisonner.'),
(61, 'Crochet Venin', 50, 15, 12, 'Le lanceur mord l\'ennemi de ses crocs toxiques. Peut aussi l\'empoisonner gravement.'),
(62, 'Bombe Acide', 40, 20, 12, 'Un liquide acide qui fait fondre l\'ennemi. Sa Défense Spéciale diminue beaucoup.'),
(63, 'Bomb-Beurk', 90, 10, 12, 'Des détritus toxiques sont projetés sur l\'ennemi. Peut aussi l\'empoisonner.'),
(64, 'Choc Venin', 65, 10, 12, 'L\'effet est doublé si l\'ennemi est déjà  empoisonné.'),
(65, 'Cradovague', 95, 10, 12, 'Une vague de détritus attaque tous les Pokémon autour du lanceur. Peut aussi empoisonner.'),
(66, 'Queue-Poison', 50, 25, 12, 'Attaque à  taux de critiques élevé. Peut aussi empoisonner l\'ennemi.'),
(67, 'Dard-Venin', 15, 35, 12, 'Un dard toxique qui transperce l\'ennemi. Peut aussi l\'empoisonner.'),
(68, 'Pics Toxik', 40, 20, 12, 'Lance des pics autour de l\'ennemi. Ils empoisonnent les ennemis.'),
(69, 'Suc Digestif', 65, 10, 12, 'Le lanceur répand ses sucs digestifs sur l\'ennemi. Le fluide neutralise la capacité spéciale de l\'ennemi.'),
(70, 'Piège de Venin', 40, 20, 12, ''),
(71, 'Boue-Bombe', 65, 10, 15, 'Le lanceur attaque à  l\'aide d\'une boule de boue solidifiée. Peut aussi baisser la Précision de l\'ennemi.'),
(72, 'Telluriforce', 90, 10, 15, 'Des éruptions volcaniques ont lieu sous l\'ennemi. Peut aussi baisser la Défense Spéciale de l\'ennemi.'),
(73, 'Massd Os', 65, 20, 15, 'Le lanceur frappe l\'ennemi à  grands coups d\'os. Peut aussi apeurer l\'ennemi.'),
(74, 'Osmerang', 50, 10, 15, 'Le lanceur projette son os comme un boomerang. Cette attaque frappe à  l\'aller et au retour.'),
(75, 'Force Chtonienne', 90, 10, 15, ''),
(76, 'Tunnelier', 80, 10, 15, 'le lanceur tourne sur lui-même comme une perceuse et se jette sur l\'ennemi. Taux de critiques élevé.'),
(77, 'Piétisol', 60, 20, 15, 'Le lanceur piétine le sol et inflige des dégâts à  tous les Pokémon autour de lui. Baisse aussi la Vitesse.'),
(78, 'Tir de Boue', 55, 15, 15, 'Le lanceur attaque en projetant de la boue sur l\'ennemi. Réduit aussi la Vitesse de la cible.'),
(79, 'Tourbi-Sable', 35, 15, 15, 'Le lanceur emprisonne l\'ennemi dans une tempête de sable terrifiante.'),
(80, 'Charge-Os', 25, 10, 15, 'Le lanceur frappe l\'ennemi avec un os.'),
(81, 'Coud Boue', 20, 10, 15, 'Le lanceur envoie de la boue au visage de l\'ennemi pour infliger des dégâts et baisser sa Précision.'),
(82, 'Séisme', 100, 10, 15, 'Le lanceur provoque un tremblement de terre touchant tous les Pokémon autour de lui.'),
(83, 'Myria-Flèches', 90, 10, 15, ''),
(84, 'Myria-Vagues', 90, 10, 15, ''),
(85, 'Tunnel', 80, 10, 15, 'Le lanceur creuse puis frappe. Permet aussi de s\'échapper d\'un donjon.'),
(86, 'Ampleur', 50, 30, 15, 'Un tremblement de terre d\'intensité variable qui affecte tous les Pokémon alentour. L\'efficacité varie.'),
(87, 'Abîme', 150, 5, 15, '	Le lanceur fait tomber l\'ennemi dans une crevasse.'),
(88, 'Picots', 40, 20, 15, 'Le lanceur disperse des piquants sur le sol pour blesser tout ennemi.'),
(89, 'Roulade', 30, 20, 14, 'Un rocher roule sur l\'ennemi.'),
(90, 'Rayon Gemme', 80, 20, 14, 'Le lanceur attaque avec un rayon de lumière qui scintille comme s\'il était composé de gemmes.'),
(91, 'Jet-Pierres', 50, 15, 14, '	Le lanceur lâche une pierre sur l\'ennemi.'),
(92, 'Tomberoche', 60, 15, 14, 'Des rochers frappent l\'ennemi. Réduit aussi sa Vitesse en l\'empêchant de se déplacer.'),
(93, 'Boule Roc', 25, 10, 14, 'Le lanceur projette un rocher sur l\'ennemi.'),
(94, 'Lame de Roc', 100, 5, 14, 'Fait surgir des pierres aiguisées sous l\'ennemi. Taux de critiques élevé.'),
(95, 'Orage Adamantin', 100, 5, 14, ''),
(96, 'Éboulement', 75, 10, 14, 'Envoie de gros rochers sur l\'ennemi pour infliger des dégâts. Peut aussi l\'apeurer.'),
(97, 'Roc-Boulet', 150, 5, 14, 'Le lanceur attaque en projetant un gros rocher sur l\'ennemi.'),
(98, 'Pouvoir Antique', 60, 5, 14, 'Une attaque préhistorique qui peut augmenter toutes les stats du lanceur d\'un seul coup.'),
(99, 'Fracass Tête', 150, 5, 14, 'Le lanceur assène un coup de tête désespéré.'),
(100, 'Piège de Roc', 80, 20, 14, 'Lance des pierres flottantes autour de l\'ennemi qui le blesse'),
(101, 'Tempête de Sable', 75, 10, 14, 'Une tempête de sable qui blesse.'),
(102, 'Anti-Air', 50, 15, 14, 'Le lanceur jette toutes sortes de projectiles à  un ennemi. Si ce dernier vole, il tombe au sol.'),
(103, 'Harcèlement', 20, 20, 9, 'Le lanceur attaque sans répit.'),
(104, 'Demi-Tour', 70, 20, 9, 'Après son attaque, le lanceur revient à  toute vitesse.'),
(105, 'Dard-Nuée', 75, 20, 9, 'Envoie une rafale de dards.'),
(106, 'Double-Dard', 50, 20, 9, 'Un double coup de dard qui transperce l\'ennemi 2 fois d\'affilée. Peut aussi l\'empoisonner.'),
(107, 'Dard Mortel', 30, 25, 9, ''),
(108, 'Rayon Signal', 75, 15, 9, 'Le lanceur projette un rayon de lumière sinistre. Peut aussi rendre l\'ennemi confus.'),
(109, 'Vent Argenté', 60, 5, 9, 'Vent qui projette des écailles poudreuses sur l\'ennemi. Peut aussi monter toutes les stats du lanceur.'),
(110, 'Plaie-Croix', 80, 15, 9, 'Le lanceur taillade l\'ennemi en utilisant ses faux ou ses griffes comme une paire de ciseaux.'),
(111, 'Piqûre', 60, 20, 9, 'Le lanceur pique l\'ennemi. Si ce dernier tient une Baie, le lanceur la dévore et obtient son effet.'),
(112, 'Appel Attak', 90, 15, 9, 'Le lanceur appelle ses sous-fifres pour frapper l\'ennemi. Taux de critiques élevé.'),
(113, 'Survinsecte', 50, 20, 9, 'Le lanceur se débat de toutes ses forces, et baisse l\'Attaque Spéciale de l\'ennemi.'),
(114, 'Taillade', 40, 20, 9, 'Un coup de faux ou de griffe dont la force augmente quand il touche plusieurs fois d\'affilée.'),
(115, 'Vampirisme', 20, 15, 9, 'Une attaque qui aspire le sang de l\'ennemi.'),
(116, 'Mégacorne', 120, 10, 9, 'Le lanceur utilise ses gigantesques cornes pour charger l\'ennemi.'),
(117, 'Bourdon', 90, 10, 9, 'Le lanceur fait vibrer ses ailes pour lancer une vague sonique. Peut aussi baisser la Défense Spéciale de l\'ennemi.'),
(118, 'Bulldoboule', 65, 20, 9, 'Le lanceur se roule en boule et écrase son ennemi. Peut aussi apeurer l\'ennemi.'),
(119, 'Nuée de Poudre', 20, 20, 9, 'Lance un nuage de poudre.'),
(120, 'Toile', 80, 10, 9, '	Le lanceur enserre l\'ennemi à  l\'aide d\'une fine soie gluante.'),
(121, 'Revenant', 120, 5, 16, 'Le lanceur disparaît puis frappe l\'ennemi. Fonctionne même si l\'ennemi se protège.'),
(122, 'Hantise', 90, 10, 16, 'Le lanceur disparaît puis frappe. Cete attaque passe outre les protections.'),
(123, 'Ball Ombre', 80, 15, 16, 'Projette une grande ombre. Peut aussi faire baisser sa Défense Spéciale.'),
(124, 'Vent Mauvais', 60, 5, 16, 'Le lanceur crée une violente bourrasque. Peut aussi augmenter toutes ses stats.'),
(125, 'Châtiment', 65, 10, 16, 'Attaque acharnée qui cause davantage de dégâts à  l\'ennemi s\'il a un problème de statut.'),
(126, 'Léchouille', 30, 30, 16, 'Un grand coup de langue qui inflige des dégâts à  l\'ennemi. Peut aussi le paralyser.'),
(127, 'Griffe Ombre', 70, 15, 16, 'Attaque avec une griffe puissante faite d\'ombres. Taux de critiques élevé.'),
(128, 'Ombre Portée', 40, 30, 16, 'Le lanceur étend son ombre pour frapper par derrière. Frappe toujours en premier.'),
(129, 'Poing Ombre', 60, 20, 16, 'Le lanceur surgit des ombres et donne un coup de poing. N\'échoue jamais.'),
(130, 'Étonnement', 30, 15, 16, 'Le lanceur attaque l\'ennemi en poussant un cri terrifiant. Peut aussi l\'apeurer.'),
(131, 'Gyroballe', 120, 5, 1, 'Le lanceur effectue une rotation et frappe l\'ennemi. Plus le lanceur est lent, plus il fait de dégâts.'),
(132, 'Lancécrou', 80, 15, 1, 'Le lanceur jette deux écrous d\'acier qui frappent l\'ennemi deux fois d\'affilée.'),
(133, 'Pisto-Poing', 40, 30, 1, 'Le lanceur envoie des coups de poing aussi rapides que des balles de revolver. Frappe toujours en premier.'),
(134, 'Tacle Lourd', 65, 10, 1, 'Le lanceur se jette sur l\'ennemi de tout son poids. S\'il est plus lourd que l\'ennemi, l\'effet augmente en conséquence.'),
(135, 'Bombaimant', 60, 20, 1, 'Le lanceur projette des bombes d\'acier qui collent à  l\'ennemi. N\'échoue jamais.'),
(136, 'Tête de Fer', 80, 15, 1, 'Le lanceur heurte l\'ennemi avec sa tête dure comme de l\'acier. Peut aussi apeurer l\'ennemi'),
(137, 'Miroi-Tir', 65, 10, 1, 'Le corps poli du lanceur libère un éclair d\'énergie.'),
(138, 'Luminocanon', 80, 10, 1, 'Le lanceur concentre son énergie lumineuse et la fait exploser.'),
(139, 'Fulmifer', 70, 10, 1, 'Le lanceur attaque le dernier ennemi l\'ayant blessé durant le même tour en frappant plus fort.'),
(140, 'Carnareket', 140, 5, 1, 'Le lanceur génère une sphère lumineuse qu\'il projette'),
(141, 'Strido-Son', 40, 40, 1, 'Un cri horrible tel un crissement métallique;'),
(142, 'Griffe Acier', 50, 35, 1, 'Attaque avec des griffes d\'acier. Peut aussi augmenter l\'Attaque du lanceur.'),
(143, 'Queue de Fer', 100, 15, 1, 'Attaque l\'ennemi avec une queue de fer. Peut aussi baisser la Défense de l\'ennemi.'),
(144, 'Poing Météor', 90, 10, 1, 'Un coup de poing lancé à  la vitesse d\'un météore. Peut aussi augmenter l\'Attaque du lanceur.'),
(145, 'Aile dAcier', 70, 25, 1, 'Le lanceur frappe l\'ennemi avec des ailes d\'acier. Peut aussi augmenter la Défense du lanceur.'),
(146, 'Incendie', 100, 5, 7, 'Des flammes rougeoyantes s\'abattent sur tous les Pokémon autour du lanceur. Peut aussi brûler.'),
(147, 'Flamme Bleue', 130, 5, 7, 'De magnifiques et redoutables flammes bleues fondent sur l\'ennemi. Peut aussi le brûler.'),
(148, 'Crocs Feu', 65, 15, 7, 'Le lanceur utilise une morsure enflammée. Peut aussi brûler ou apeurer l\'ennemi.'),
(149, 'Rafale Feu', 150, 5, 7, 'Une explosion ardente souffle l\'adversaire.'),
(150, 'Danse Flamme', 35, 15, 7, 'Un tourbillon de flammes.'),
(151, 'Flamme Croix', 100, 5, 7, 'Projette une boule de feu gigantesque. L\'effet augmente sous l\'influence d\'Éclair Croix.'),
(152, 'Éruption', 150, 5, 7, 'Le lanceur laisse exploser sa colère. Plus ses PV sont bas et moins l\'attaque est puissante'),
(153, 'Danse du Feu', 80, 10, 7, 'Le lanceur enveloppe l\'ennemi de flammes. Peut aussi augmenter l\'Attaque Spéciale du lanceur.'),
(154, 'Feu Ensorcelé', 65, 10, 7, 'Attaque avec des flammes brûlantes soufflées de la bouche du lanceur.'),
(155, 'Vortex Magma', 100, 5, 7, 'L\'ennemi est pris dans un tourbillon de feu.'),
(156, 'Lance-Flammes', 90, 15, 7, 'L\'ennemi reçoit un torrent de flammes. Peut aussi le brûler.'),
(157, 'Calcination', 60, 15, 7, 'Des flammes calcinent l\'ennemi. S\'il tient une Baie, elle est brûlée et devient inutilisable.'),
(158, 'Rebondifeu', 70, 15, 7, 'Quand l\'attaque atteint sa cible, elle projette des flammes qui touchent tout ennemi situé à  côté.'),
(159, 'Flammèche', 40, 25, 7, 'L\'ennemi est attaqué par de faibles flammes. Peut aussi le brûler.'),
(160, 'Nitrocharge', 50, 100, 7, 'Le lanceur s\'entoure de flammes pour attaquer l\'ennemi. Il se concentre et sa Vitesse augmente.'),
(161, 'Déflagration', 110, 5, 7, 'Un déluge de flammes ardentes submerge l\'ennemi. Peut aussi le brûler.'),
(162, 'Feu dEnfer', 100, 5, 7, 'L\'ennemi est entouré d\'un torrent de flammes ardentes qui le brûlent.'),
(163, 'Poing de Feu', 75, 15, 7, 'Un coup de poing enflammé vient frapper l\'ennemi. Peut le brûler.'),
(164, 'Écume', 40, 30, 4, 'Des bulles frappent l\'ennemi. Peut réduire sa Vitesse.'),
(165, 'Plongée', 80, 10, 4, 'Le lanceur plonge sous l\'eau puis frappe. Permet aussi de plonger au fond de l\'eau.'),
(166, 'Claquoir', 70, 15, 4, 'Le lanceur piège l\'ennemi dans sa dure coquille puis l\'écrase.'),
(167, 'Hydrocanon', 110, 5, 4, 'Un puissant jet d\'eau est dirigé sur l\'ennemi.'),
(168, 'Cascade', 80, 15, 4, 'Le lanceur charge l\'ennemi à  une vitesse remarquable, ce qui peut l\'apeurer. Permet aussi de franchir une cascade.'),
(169, 'Siphon', 70, 15, 4, 'Piège l\'ennemi dans une trombe d\'eau.'),
(170, 'Sheauriken', 60, 20, 4, 'Lance un sheauriken en eau.'),
(171, 'Surf', 90, 15, 4, 'Une énorme vague s\'abat sur le champ de bataille. Permet aussi de voyager sur l\'eau.'),
(172, 'Pistolet à  O', 40, 25, 4, 'De l\'eau est projetée sur l\'ennemi en arc de cercle.'),
(173, 'Bulles dO', 65, 20, 4, 'Des bulles sont envoyées avec puissance sur l\'ennemi. Peut aussi baisser sa Vitesse.'),
(174, 'Hydroqueue', 90, 10, 4, 'Le lanceur attaque en balançant sa queue comme une lame de fond en pleine tempête.'),
(175, 'Vibraqua', 60, 20, 4, 'Le lanceur envoie un puissant jet d\'eau sur l\'ennemi. Peut rendre l\'ennemi confus.'),
(176, 'Aqua-Jet', 40, 20, 4, 'Le lanceur fonce sur l\'ennemi si rapidement qu\'on parvient à  peine à  le discerner. Frappe en premier.'),
(177, 'Jet de Vapeur', 110, 5, 4, ''),
(178, 'Octazooka', 65, 10, 4, 'Le lanceur attaque en projetant de l\'encre au visage de l\'ennemi. Peut aussi baisser la Précision de l\'ennemi.'),
(179, 'Pince-Masse', 100, 10, 4, 'Une grande pince martèle l\'ennemi. Taux de critiques élevé.'),
(180, 'Coquilame', 75, 10, 4, 'Un coquillage aiguisé lacère l\'ennemi. Peut aussi baisser sa Défense.'),
(181, 'Aire dEau', 80, 10, 4, 'Une masse d\'eau s\'abat sur l\'ennemi. En l\'utilisant avec Aire de Feu, l\'effet augmente et un arc-en-ciel apparaît.'),
(182, 'Phytomixeur', 65, 10, 11, 'L\'ennemi est pris dans un tourbillon de feuilles acérées. Peut aussi baisser la Précision de l\'ennemi.'),
(183, 'Fouet Lianes', 45, 25, 11, 'Fouette l\'ennemi avec de fines lianes pour infliger des dégâts.'),
(184, 'Feuille Magik', 60, 20, 11, 'Le lanceur disperse d\'étranges feuilles qui poursuivent l\'ennemi. N\'échoue jamais.'),
(185, 'Végé-Attak', 150, 5, 11, 'Un violent coup de racines s\'abat sur l\'ennemi.'),
(186, 'Aire dHerbe', 80, 10, 11, 'Une masse végétale s\'abat sur l\'ennemi. En l\'utilisant avec Aire d\'Eau, l\'effet augmente et un marécage apparaît.'),
(187, 'Balle Graine', 75, 30, 11, 'Le lanceur mitraille l\'ennemi avec une rafale de graines.'),
(188, 'Fulmigraine', 120, 5, 11, 'Le corps du lanceur émet une onde de choc. Peut aussi baisser grandement la Défense Spéciale de la cible.'),
(189, 'Mégafouet', 120, 10, 11, 'Le lanceur fait virevolter violemment ses lianes ou ses tentacules pour fouetter l\'ennemi.'),
(190, 'Tempête Verte', 130, 5, 11, 'Invoque une tempête de feuilles acérées. Le contrecoup réduit fortement l\'Attaque Spéciale du lanceur.'),
(191, 'Éco-Sphère', 90, 10, 11, 'Utilise les pouvoirs de la nature pour attaquer l\'ennemi. Peut aussi baisser la Défense Spéciale de l\'ennemi.'),
(192, 'Danse-Fleur', 120, 10, 11, 'Le lanceur attaque en projetant des pétales.'),
(193, 'Lame-Feuille', 90, 15, 11, 'Une feuille coupante comme une lame entaille l\'ennemi. Taux de critiques élevé.'),
(194, 'Tempête Florale', 90, 15, 11, 'Déclenche une violente tempête de fleurs qui inflige des dégâts à  tous les Pokémon alentour.'),
(195, 'Lance-Soleil', 120, 10, 11, 'Absorbe la lumière puis envoie un rayon puissant.'),
(196, 'Tranch Herbe', 55, 95, 11, 'Des feuilles aiguisées comme des rasoirs entaillent l\'ennemi. Taux de critiques élevé.'),
(197, 'Poing Dard', 60, 15, 11, 'Le lanceur attaque en fouettant l\'ennemi de ses bras épineux. Peut aussi l\'apeurer.'),
(198, 'Canon Graine', 80, 15, 11, 'Le lanceur fait pleuvoir un déluge de graines solides sur l\'ennemi.'),
(199, 'Martobois', 120, 15, 11, 'Le lanceur heurte l\'ennemi de son corps robuste. Inflige de sérieux dégâts au lanceur aussi.'),
(200, 'Poing-Éclair', 75, 100, 5, 'Un coup de poing électrique vient frapper l\'ennemi. Peut le paralyser.'),
(201, 'Éclair', 40, 30, 5, 'Une décharge électrique tombe sur l\'ennemi. Peut aussi le paralyser.'),
(202, 'Crocs Éclair', 65, 15, 5, 'Le lanceur utilise une morsure électrifiée. Peut aussi paralyser ou apeurer l\'ennemi.'),
(203, 'Frotte-Frimousse', 20, 100, 5, 'Le lanceur attaque en frottant ses bajoues chargées d\'électricité. Paralyse l\'ennemi.'),
(204, 'Onde de Choc', 60, 20, 5, 'Le lanceur envoie un choc électrique rapide à  l\'ennemi. Impossible à  esquiver.'),
(205, 'Étincelle', 65, 20, 5, 'Lance une charge électrique sur l\'ennemi. Peut aussi le paralyser.'),
(206, 'Électacle', 120, 15, 5, 'Le lanceur électrifie son corps avant de charger. Le choc blesse aussi beaucoup le lanceur et peut paralyser l\'ennemi.'),
(207, 'Élecanon', 120, 5, 5, 'Un boulet de canon électrifié qui inflige des dégâts et paralyse l\'ennemi.'),
(208, 'Parabocharge', 50, 20, 5, 'Soigne l\'utilisateur pour la moitié des dégâts infligés à  l\'ennemi.'),
(209, 'Éclair Croix', 100, 5, 5, 'Projette un orbe électrique gigantesque. L\'effet augmente sous l\'influence de Flamme Croix.'),
(210, 'Change Éclair', 70, 20, 5, 'Après son attaque, le lanceur revient à  toute vitesse et change de place avec un Pokémon de l\'équipe prêt au combat.'),
(211, 'Tonnerre', 90, 15, 5, 'Une grosse décharge électrique tombe sur l\'ennemi. Peut aussi le paralyser.'),
(212, 'Rayon Chargé', 50, 10, 5, 'Le lanceur tire un rayon chargé d\'électricité. Peut aussi augmenter son Attaque Spéciale.'),
(213, 'Charge Foudre', 130, 5, 5, 'S\'enveloppe d\'une charge électrique surpuissante et se jette sur l\'ennemi. Peut aussi le paralyser.'),
(214, 'Fatal-Foudre', 110, 10, 5, 'La foudre tombe sur l\'ennemi pour lui infliger des dégâts. Peut aussi le paralyser.'),
(215, 'Coup dJus', 80, 15, 5, 'Un flamboiement d\'électricité frappe tous les Pokémon autour du lanceur. Peut aussi paralyser.'),
(216, 'Éclair Fou', 90, 15, 5, 'Une charge électrique violente qui blesse aussi légèrement le lanceur.'),
(217, 'Toile Élek', 55, 15, 5, 'Attrape l\'ennemi dans un filet électrique. Baisse aussi la Vitesse de l\'ennemi.'),
(218, 'Psyko', 90, 10, 13, 'Une puissante force télékinésique frappe l\'ennemi. Peut aussi faire baisser sa Défense Spéciale.'),
(219, 'Frappe Psy', 100, 10, 13, 'Le lanceur matérialise des ondes mystérieuses qu\'il projette sur l\'ennemi. Inflige des dégâts physiques.'),
(220, 'Choc Mental', 50, 25, 13, 'Une faible vague télékinésique frappe l\'ennemi. Peut aussi le plonger dans la confusion.'),
(221, 'Crève-CÅ“ur', 60, 25, 13, 'Déconcentre l\'ennemi avec des mouvements mignons avant de le frapper violemment. Peut apeurer l\'ennemi.'),
(222, 'Rafale Psy', 65, 20, 13, 'Un étrange rayon frappe l\'ennemi. Peut aussi le rendre confus.'),
(223, 'Dévorêve', 100, 15, 13, 'Le lanceur récupère en PV la moitié des dégâts infligés.'),
(224, 'Coupe Psycho', 70, 20, 13, 'Le lanceur entaille l\'ennemi grâce à  des lames faites de pouvoir psychique. Taux de critiques élevé.'),
(225, 'Psykoud Boul', 80, 90, 13, 'Le lanceur concentre sa volonté et donne un coup de tête. Peut aussi apeurer l\'ennemi.'),
(226, 'Prescience', 120, 10, 13, 'De l\'énergie psychique vient frapper l\'ennemi l\'utilisation de cette capacité.'),
(227, 'Lumi-Éclat', 70, 5, 13, 'Le lanceur libère un éclair lumineux. Peut aussi baisser la Défense Spéciale de l\'ennemi.'),
(228, 'Ball Brume', 70, 5, 13, 'Une bulle de brume inflige des dégâts à  l\'ennemi. Peut aussi réduire son Attaque Spéciale.'),
(229, 'Extrasenseur', 80, 20, 13, 'Le lanceur attaque avec un pouvoir étrange et invisible. Peut aussi apeurer l\'ennemi.'),
(230, 'Psycho Boost', 140, 5, 13, 'Attaque l\'ennemi à  pleine puissance. Le contrecoup baisse énormément l\'Attaque Spéciale du lanceur.'),
(231, 'Synchropeine', 120, 10, 13, 'Des ondes mystérieuses blessent tous les Pokémon alentour qui sont du même type que le lanceur.'),
(232, 'Choc Psy', 80, 10, 13, 'Le lanceur matérialise des ondes mystérieuses qu\'il projette sur l\'ennemi. Inflige des dégâts physiques.'),
(233, 'Force Ajoutée', 20, 100, 13, 'Le lanceur attaque l\'ennemi avec une force accumulée. Plus les stats du lanceur sont augmentées, plus le coup est efficace.'),
(234, 'Gravité', 120, 5, 13, '	La gravité augmente et plaque l\'adversaire au sol.'),
(235, 'TrouDimensionnel', 80, 5, 13, ''),
(236, 'Crocs Givre', 65, 15, 8, 'Le lanceur utilise une morsure glaciale. Peut aussi geler ou apeurer l\'ennemi.'),
(237, 'Avalanche', 60, 10, 8, 'Une attaque deux fois plus puissante si le lanceur a été blessé par l\'ennemi durant le tour.'),
(238, 'Ball Glace', 60, 20, 8, 'Envoie une balle de glace.'),
(239, 'Ère Glaciaire', 65, 10, 8, 'Un souffle de vent qui congèle tout sur son passage s\'abat sur l\'ennemi. Réduit aussi sa Vitesse.'),
(240, 'Éclats Glace', 40, 30, 8, 'Le lanceur crée des éclats de glace qu\'il envoie sur l\'ennemi. Frappe toujours en premier.'),
(241, 'Chute Glace', 85, 10, 8, 'Envoie de gros blocs de glace sur l\'ennemi pour lui infliger des dégâts. Peut aussi l\'apeurer.'),
(242, 'Stalagtite', 75, 30, 8, 'Le lanceur jette des pics de glace sur l\'ennemi, '),
(243, 'Feu Glacé', 140, 5, 8, 'Au second tour, le lanceur projette un souffle de vent glacial dévastateur sur l\'ennemi. Peut le brûler.'),
(244, 'Blizzard', 110, 5, 8, 'Une violente tempête de neige est déclenchée sur l\'ennemi. Peut aussi le geler.'),
(245, 'Onde Boréale', 65, 20, 8, 'Envoie un rayon arc-en-ciel sur l\'ennemi. Peut aussi baisser son Attaque'),
(246, 'Vent Glace', 55, 15, 8, 'Une bourrasque de vent froid blesse l\'ennemi. Réduit aussi sa Vitesse.'),
(247, 'Éclair Gelé', 140, 5, 8, 'Projette un bloc de glace électrifié sur l\'ennemi. Peut aussi le paralyser.'),
(248, 'Poing-Glace', 75, 15, 8, 'Un coup de poing glacé vient frapper l\'ennemi. Peut le geler.'),
(249, 'Souffle Glacé', 60, 10, 8, 'Un souffle froid blesse l\'ennemi. L\'effet est toujours critique.'),
(250, 'Lyophilisation', 70, 20, 8, ''),
(251, 'Poudreuse', 40, 25, 8, 'Le lanceur projette de la neige poudreuse. Peut aussi geler l\'ennemi.'),
(252, 'Laser Glace', 90, 10, 8, 'Un rayon de glace frappe l\'ennemi. Peut aussi le geler.'),
(253, 'Glaciation', 140, 5, 8, 'Une vague de froid glacial frappe l\'ennemi.'),
(254, 'Dracocharge', 100, 10, 3, 'Le lanceur frappe l\'ennemi d\'un air menaçant. Peut aussi apeurer l\'ennemi.'),
(255, 'Dracochoc', 85, 10, 3, 'Le lanceur ouvre la bouche pour envoyer une onde de choc qui frappe l\'ennemi.'),
(256, 'Colère', 120, 10, 3, 'Le lanceur laisse éclater sa rage et attaque.'),
(257, 'Dracosouffle', 60, 20, 3, 'Le lanceur souffle fort sur l\'ennemi pour infliger des dégâts. Peut aussi le paralyser.'),
(258, 'Spatio-Rift', 100, 5, 3, 'Le lanceur déchire l\'ennemi et l\'espace autour de lui. Taux de critiques élevé.'),
(259, 'Hurle-Temps', 150, 5, 3, 'Le lanceur frappe si fort qu\'il affecte le cours du temps.'),
(260, 'Double Baffe', 70, 15, 3, 'Le lanceur frappe l\'ennemi deux fois d\'affilée avec les parties les plus robustes de son corps.'),
(261, 'Draco-Queue', 60, 90, 3, 'Un coup puissant qui blesse la cible et l\'envoie balader. '),
(262, 'Dracogriffe', 80, 15, 3, 'Le lanceur lacère l\'ennemi de ses grandes griffes aiguisées.'),
(263, 'Draco Météor', 130, 5, 3, 'Le lanceur invoque des comètes. Le contrecoup réduit fortement son Attaque Spéciale.'),
(264, 'Ouragan', 40, 20, 3, '	Déclenche un terrible ouragan sur l\'ennemi. Peut aussi l\'apeurer.'),
(265, 'Éclat Magique', 80, 10, 6, 'Libère une puissante décharge lumineuse qui inflige des dégâts à  l\'ennemi.'),
(266, 'Câlinerie', 90, 10, 6, 'Attaque l\'ennemi avec un câlin. Peut diminuer son Attaque.'),
(267, 'Vent Féérique', 40, 30, 6, 'Le lanceur crée une bourrasque féerique et frappe la cible avec.'),
(268, 'Pouvoir Lunaire', 95, 15, 6, ''),
(269, 'Vampibaiser', 70, 10, 6, ''),
(270, 'Voix Enjôleuse', 40, 15, 6, 'Laisse s\'échapper une voix enchanteresse qui inflige des dégâts psychiques à  l\'ennemi. Touche à  coup sûr.'),
(271, 'Lumière du Néant', 140, 5, 6, ''),
(272, 'Géo-Contrôle', 90, 10, 6, ''),
(273, 'Garde Florale', 100, 10, 6, ''),
(274, 'Brume Capiteuse', 70, 20, 6, ''),
(275, 'Rayon Lune', 110, 5, 6, ''),
(276, 'Doux Baiser', 80, 10, 6, 'Le lanceur envoie un bisou si mignon et désarmant qu\'il plonge l\'ennemi dans la confusion.');

-- --------------------------------------------------------

--
-- Structure de la table `AttaqueParDresseur`
--

CREATE TABLE `AttaqueParDresseur` (
  `numC` int(11) NOT NULL,
  `attaque` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `AttaqueParDresseur`
--

INSERT INTO `AttaqueParDresseur` (`numC`, `attaque`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(1, 73),
(1, 74),
(1, 75),
(1, 76),
(1, 77),
(1, 78),
(1, 79),
(1, 80),
(1, 81),
(1, 82),
(1, 83),
(1, 84),
(1, 85),
(1, 86),
(1, 87),
(1, 88),
(1, 89),
(1, 90),
(1, 91),
(1, 92),
(1, 93),
(1, 94),
(1, 95),
(1, 96),
(1, 97),
(1, 98),
(1, 99),
(1, 100),
(1, 101),
(1, 102),
(1, 103),
(1, 104),
(1, 105),
(1, 106),
(1, 107),
(1, 108),
(1, 109),
(1, 110),
(1, 111),
(1, 112),
(1, 113),
(1, 114),
(1, 115),
(1, 116),
(1, 117),
(1, 118),
(1, 119),
(1, 120),
(1, 121),
(1, 122),
(1, 123),
(1, 124),
(1, 125),
(1, 126),
(1, 127),
(1, 128),
(1, 129),
(1, 130),
(1, 131),
(1, 132),
(1, 133),
(1, 134),
(1, 135),
(1, 136),
(1, 137),
(1, 138),
(1, 139),
(1, 140),
(1, 141),
(1, 142),
(1, 143),
(1, 144),
(1, 145),
(1, 146),
(1, 147),
(1, 148),
(1, 149),
(1, 150),
(1, 151),
(1, 152),
(1, 153),
(1, 154),
(1, 155),
(1, 156),
(1, 157),
(1, 158),
(1, 159),
(1, 160),
(1, 161),
(1, 162),
(1, 163),
(1, 164),
(1, 165),
(1, 166),
(1, 167),
(1, 168),
(1, 169),
(1, 170),
(1, 171),
(1, 172),
(1, 173),
(1, 174),
(1, 175),
(1, 176),
(1, 177),
(1, 178),
(1, 179),
(1, 180),
(1, 181),
(1, 182),
(1, 183),
(1, 184),
(1, 185),
(1, 186),
(1, 187),
(1, 188),
(1, 189),
(1, 190),
(1, 191),
(1, 192),
(1, 193),
(1, 194),
(1, 195),
(1, 196),
(1, 197),
(1, 198),
(1, 199),
(1, 200),
(1, 201),
(1, 202),
(1, 203),
(1, 204),
(1, 205),
(1, 206),
(1, 207),
(1, 208),
(1, 209),
(1, 210),
(1, 211),
(1, 212),
(1, 213),
(1, 214),
(1, 215),
(1, 216),
(1, 217),
(1, 218),
(1, 219),
(1, 220),
(1, 221),
(1, 222),
(1, 223),
(1, 224),
(1, 225),
(1, 226),
(1, 227),
(1, 228),
(1, 229),
(1, 230),
(1, 231),
(1, 232),
(1, 233),
(1, 234),
(1, 235),
(1, 236),
(1, 237),
(1, 238),
(1, 239),
(1, 240),
(1, 241),
(1, 242),
(1, 243),
(1, 244),
(1, 245),
(1, 246),
(1, 247),
(1, 248),
(1, 249),
(1, 250),
(1, 251),
(1, 252),
(1, 253),
(1, 254),
(1, 255),
(1, 256),
(1, 257),
(1, 258),
(1, 259),
(1, 260),
(1, 261),
(1, 262),
(1, 263),
(1, 264),
(1, 265),
(1, 266),
(1, 267),
(1, 268),
(1, 269),
(1, 270),
(1, 271),
(1, 272),
(1, 273),
(1, 274),
(1, 275),
(1, 276),
(9, 195);

-- --------------------------------------------------------

--
-- Structure de la table `Combat`
--

CREATE TABLE `Combat` (
  `numCombat` int(11) NOT NULL,
  `j1` int(11) NOT NULL,
  `pokemonj1` int(11) NOT NULL,
  `actionj1` int(11) DEFAULT '0',
  `j2` int(11) NOT NULL,
  `pokemonj2` int(11) NOT NULL,
  `actionj2` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `DemanderCombat`
--

CREATE TABLE `DemanderCombat` (
  `moi` int(11) NOT NULL,
  `lui` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Dresseur`
--

CREATE TABLE `Dresseur` (
  `numC` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `sexe` int(11) NOT NULL DEFAULT '1',
  `niveauD` int(11) NOT NULL DEFAULT '1',
  `xp` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Dresseur`
--

INSERT INTO `Dresseur` (`numC`, `pseudo`, `sexe`, `niveauD`, `xp`) VALUES
(1, '1 1=0', 1, 123, 582),
(9, 'Vincent', 2, 49, 307),
(42, 'L&eacute;a', 1, 1, 0),
(43, 'Francis', 2, 1, 0),
(44, 'f&eacute;f&eacute;\'r', 2, 1, 0),
(45, 'rehyey', 1, 1, 0),
(46, 'hufgo', 2, 1, 0),
(48, 'q', 2, 1, 0),
(49, 'hugo', 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `EqPokemon`
--

CREATE TABLE `EqPokemon` (
  `numC` int(11) NOT NULL,
  `pokemon1` int(11) NOT NULL,
  `pokemon2` int(11) DEFAULT NULL,
  `pokemon3` int(11) DEFAULT NULL,
  `pokemon4` int(11) DEFAULT NULL,
  `pokemon5` int(11) DEFAULT NULL,
  `pokemon6` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `EqPokemon`
--

INSERT INTO `EqPokemon` (`numC`, `pokemon1`, `pokemon2`, `pokemon3`, `pokemon4`, `pokemon5`, `pokemon6`) VALUES
(1, 110, 4, 7, 100, 8, NULL),
(9, 20, 116, 117, 118, 119, NULL),
(42, 81, NULL, NULL, NULL, NULL, NULL),
(43, 82, NULL, NULL, NULL, NULL, NULL),
(44, 83, NULL, NULL, NULL, NULL, NULL),
(45, 113, NULL, NULL, NULL, NULL, NULL),
(46, 114, NULL, NULL, NULL, NULL, NULL),
(48, 108, NULL, NULL, NULL, NULL, NULL),
(49, 120, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Ordinateur`
--

CREATE TABLE `Ordinateur` (
  `numC` int(11) NOT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Ordinateur`
--

INSERT INTO `Ordinateur` (`numC`, `numero`) VALUES
(1, 0),
(1, 3),
(1, 4),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 17),
(1, 98),
(1, 99),
(1, 100),
(1, 101),
(1, 103),
(1, 109),
(1, 110),
(1, 111),
(1, 112),
(9, 20),
(9, 116),
(9, 117),
(9, 118),
(9, 119),
(42, 81),
(43, 82),
(44, 83),
(45, 113),
(46, 114),
(48, 108),
(49, 120);

-- --------------------------------------------------------

--
-- Structure de la table `Pokedex`
--

CREATE TABLE `Pokedex` (
  `numP` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `type1` int(11) NOT NULL,
  `type2` int(11) DEFAULT NULL,
  `evolution` tinyint(1) NOT NULL,
  `palier` int(11) DEFAULT NULL,
  `pokemonS` int(11) DEFAULT NULL,
  `statF` int(11) NOT NULL,
  `statD` int(11) NOT NULL,
  `statV` int(11) NOT NULL,
  `pv` int(11) NOT NULL,
  `lieu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Pokedex`
--

INSERT INTO `Pokedex` (`numP`, `nom`, `type1`, `type2`, `evolution`, `palier`, `pokemonS`, `statF`, `statD`, `statV`, `pv`, `lieu`) VALUES
(1, 'Bulbizarre', 11, 12, 1, 16, 2, 49, 49, 45, 45, 1),
(2, 'Herbizarre', 11, 12, 1, 32, 3, 62, 63, 60, 60, 0),
(3, 'Florizarre', 11, 12, 0, NULL, NULL, 82, 83, 80, 80, 0),
(4, 'Salamèche', 7, NULL, 1, 16, 5, 52, 43, 65, 39, 1),
(5, 'Reptincel', 7, NULL, 1, 36, 6, 64, 58, 80, 58, 0),
(6, 'Dracaufeu', 7, 18, 0, NULL, NULL, 84, 78, 100, 78, 0),
(7, 'Carapuce', 4, NULL, 1, 16, 8, 48, 65, 43, 44, 1),
(8, 'Carabaffe', 4, NULL, 1, 36, 9, 63, 80, 58, 59, 0),
(9, 'Tortank', 4, NULL, 0, NULL, NULL, 83, 100, 78, 79, 0),
(10, 'Chenipan', 9, NULL, 1, 7, 11, 30, 35, 45, 45, 1),
(11, 'Chrysacier', 9, NULL, 1, 10, 12, 20, 55, 30, 50, 2),
(12, 'Papilusion', 9, 18, 0, NULL, NULL, 45, 50, 70, 60, 3),
(13, 'Aspicot', 9, 12, 1, 7, 14, 35, 30, 50, 40, 1),
(14, 'Coconfort', 9, 12, 1, 10, 15, 25, 50, 35, 45, 2),
(15, 'Dardargnan', 9, 12, 0, NULL, NULL, 90, 40, 75, 65, 3),
(16, 'Roucool', 10, 18, 1, 18, 17, 45, 40, 56, 40, 1),
(17, 'Roucoups', 10, 18, 1, 36, 18, 60, 55, 71, 63, 3),
(18, 'Roucarnage', 10, 18, 0, NULL, NULL, 80, 75, 101, 83, 5),
(19, 'Rattata', 10, NULL, 1, 20, 20, 56, 35, 72, 30, 2),
(20, 'Rattatac', 10, NULL, 0, NULL, NULL, 81, 60, 97, 55, 4),
(21, 'Piafabec', 10, 18, 1, 20, 22, 60, 30, 70, 40, 2),
(22, 'Rapasdepic', 10, 18, 0, NULL, NULL, 90, 65, 100, 65, 4),
(23, 'Abo', 12, NULL, 1, 22, 24, 60, 44, 55, 35, 4),
(24, 'Arbok', 12, NULL, 0, NULL, NULL, 85, 69, 80, 60, 6),
(25, 'Pikachu', 5, NULL, 1, 25, 26, 55, 40, 90, 35, 5),
(26, 'Raichu', 5, NULL, 0, NULL, NULL, 90, 55, 110, 60, 8),
(27, 'Sabelette', 15, NULL, 1, 22, 28, 75, 85, 40, 50, 3),
(28, 'Sablaireau', 15, NULL, 0, NULL, NULL, 100, 110, 65, 75, 9),
(29, 'Nidoran&#9792', 12, NULL, 1, 16, 30, 47, 52, 41, 55, 2),
(30, 'Nidorina', 12, NULL, 1, 32, 31, 62, 67, 56, 70, 4),
(31, 'Nidoqueen', 12, 15, 0, NULL, NULL, 92, 87, 76, 90, 6),
(32, 'Nidoran&#9794', 12, NULL, 1, 16, 33, 57, 40, 50, 46, 3),
(33, 'Nidorino', 12, NULL, 1, 32, 34, 72, 57, 65, 61, 5),
(34, 'Nidoking', 12, 15, 0, NULL, NULL, 102, 77, 85, 81, 7),
(35, 'Mélofée', 6, NULL, 1, 30, 36, 45, 48, 35, 70, 5),
(36, 'Mélodelfe', 6, NULL, 0, NULL, NULL, 70, 73, 60, 95, 9),
(37, 'Goupix', 7, NULL, 1, 30, 38, 41, 40, 65, 38, 5),
(38, 'Feunard', 7, NULL, 0, NULL, NULL, 76, 75, 100, 73, 10),
(39, 'Rondoudou', 10, 6, 1, 30, 40, 45, 20, 20, 115, 3),
(40, 'Grodoudou', 10, 6, 0, NULL, NULL, 70, 45, 45, 140, 7),
(41, 'Nosferapti', 12, 18, 1, 22, 42, 45, 35, 55, 40, 3),
(42, 'Nosferalto', 12, 18, 0, NULL, NULL, 80, 70, 90, 75, 8),
(43, 'Mystherbe', 11, 12, 1, 21, 44, 50, 55, 30, 45, 4),
(44, 'Ortide', 11, 12, 1, 35, 45, 65, 70, 40, 60, 6),
(45, 'Rafflesia', 11, 12, 0, NULL, NULL, 80, 85, 50, 75, 9),
(46, 'Paras', 9, 11, 1, 24, 47, 70, 55, 25, 35, 3),
(47, 'Parasect', 9, 11, 0, NULL, NULL, 95, 80, 30, 60, 5),
(48, 'Mimitoss', 9, 12, 1, 31, 49, 55, 50, 45, 60, 2),
(49, 'Aéromite', 9, 12, 0, NULL, NULL, 65, 60, 90, 70, 6),
(50, 'Taupiqueur', 15, NULL, 1, 26, 51, 55, 25, 95, 10, 3),
(51, 'Triopikeur', 15, NULL, 0, NULL, NULL, 80, 50, 120, 35, 7),
(52, 'Miaouss', 10, NULL, 1, 28, 53, 45, 35, 90, 40, 3),
(53, 'Persian', 10, NULL, 0, NULL, NULL, 70, 60, 115, 65, 9),
(54, 'Psykokwak', 4, NULL, 1, 33, 55, 52, 48, 55, 50, 2),
(55, 'Akwakwak', 4, NULL, 0, NULL, NULL, 82, 78, 85, 80, 7),
(56, 'Férosinge', 2, NULL, 1, 28, 57, 80, 35, 70, 40, 1),
(57, 'Colossinge', 2, NULL, 0, NULL, NULL, 105, 60, 95, 65, 5),
(58, 'Caninos', 7, NULL, 1, 25, 59, 70, 45, 60, 55, 3),
(59, 'Arcanin', 7, NULL, 0, NULL, NULL, 110, 80, 95, 90, 10),
(60, 'Ptitard', 4, NULL, 1, 25, 61, 50, 40, 90, 40, 2),
(61, 'Têtarte', 4, NULL, 1, 40, 62, 65, 65, 90, 65, 6),
(62, 'Tartard', 4, 2, 0, NULL, NULL, 95, 95, 70, 90, 9),
(63, 'Abra', 13, NULL, 1, 16, 64, 20, 15, 90, 25, 1),
(64, 'Kadabra', 13, NULL, 1, 32, 65, 35, 30, 105, 40, 4),
(65, 'Alakazam', 13, NULL, 0, NULL, NULL, 50, 45, 120, 55, 10),
(66, 'Machoc', 2, NULL, 1, 28, 67, 80, 50, 35, 70, 3),
(67, 'Machopeur', 2, NULL, 1, 40, 68, 100, 70, 45, 80, 4),
(68, 'Mackogneur', 2, NULL, 0, NULL, NULL, 130, 80, 55, 90, 7),
(69, 'Chétiflor', 11, 12, 1, 21, 70, 75, 35, 40, 50, 1),
(70, 'Boustiflor', 11, 12, 1, 35, 71, 90, 50, 55, 65, 4),
(71, 'Empiflor', 11, 12, 0, NULL, NULL, 105, 65, 70, 80, 5),
(72, 'Tentacool', 4, 12, 1, 30, 73, 40, 35, 70, 40, 4),
(73, 'Tentacruel', 4, 12, 0, NULL, NULL, 70, 65, 100, 80, 10),
(74, 'Racaillou', 14, 15, 1, 25, 75, 80, 100, 20, 40, 3),
(75, 'Gravalanch', 14, 15, 1, 40, 76, 95, 115, 35, 55, 5),
(76, 'Grolem', 14, 15, 0, NULL, NULL, 120, 130, 45, 80, 10),
(77, 'Ponyta', 7, NULL, 1, 40, 78, 85, 55, 90, 50, 4),
(78, 'Galopa', 7, NULL, 0, NULL, NULL, 100, 70, 105, 65, 9),
(79, 'Ramoloss', 4, 13, 1, 37, 80, 65, 65, 15, 90, 3),
(80, 'Flagadoss', 4, 13, 0, NULL, NULL, 75, 110, 30, 95, 5),
(81, 'Magnéti', 5, 1, 1, 30, 82, 35, 70, 45, 25, 2),
(82, 'Magnéton', 5, 1, 0, NULL, NULL, 60, 95, 70, 50, 6),
(83, 'Canarticho', 10, 18, 0, NULL, NULL, 65, 55, 60, 52, 5),
(84, 'Doduo', 10, 18, 1, 31, 85, 85, 45, 75, 35, 3),
(85, 'Dodrio', 10, 18, 0, NULL, NULL, 110, 70, 100, 60, 6),
(86, 'Otaria', 4, NULL, 1, 36, 87, 45, 55, 45, 65, 5),
(87, 'Lamantine', 4, 8, 0, NULL, NULL, 70, 80, 70, 90, 9),
(88, 'Tadmorv', 12, NULL, 1, 38, 89, 80, 50, 25, 80, 4),
(89, 'Grotadmorv', 12, NULL, 0, NULL, NULL, 105, 75, 50, 105, 8),
(90, 'Kokiyas', 4, NULL, 1, 25, 91, 65, 100, 40, 30, 5),
(91, 'Crustabri', 4, 8, 0, NULL, NULL, 95, 180, 70, 50, 7),
(92, 'Fantominus', 16, 12, 1, 25, 93, 35, 20, 80, 30, 4),
(93, 'Spectrum', 16, 12, 1, 40, 94, 50, 45, 95, 45, 6),
(94, 'Ectoplasma', 16, 12, 0, NULL, NULL, 65, 60, 110, 60, 10),
(95, 'Onix', 14, 15, 0, NULL, NULL, 45, 160, 70, 35, 4),
(96, 'Soporifik', 13, NULL, 1, 26, 97, 48, 45, 42, 60, 3),
(97, 'Hypnomade', 13, NULL, 0, NULL, NULL, 73, 70, 67, 85, 7),
(98, 'Krabby', 4, NULL, 1, 28, 99, 105, 90, 50, 30, 1),
(99, 'Krabboss', 4, NULL, 0, NULL, NULL, 130, 115, 75, 55, 4),
(100, 'Voltorbe', 5, NULL, 1, 30, 101, 30, 50, 100, 40, 2),
(101, 'Électrode', 5, NULL, 0, NULL, NULL, 50, 70, 140, 60, 6),
(102, 'Noeunoeuf', 11, 13, 1, 30, 103, 40, 80, 40, 60, 2),
(103, 'Noadkoko', 11, 13, 0, NULL, NULL, 95, 85, 55, 95, 8),
(104, 'Osselait', 15, NULL, 1, 28, 105, 50, 95, 35, 50, 2),
(105, 'Ossatueur', 15, NULL, 0, NULL, NULL, 80, 110, 45, 60, 9),
(106, 'Kicklee', 2, NULL, 0, NULL, NULL, 120, 53, 87, 50, 7),
(107, 'Tygnon', 2, NULL, 0, NULL, NULL, 50, 105, 76, 50, 7),
(108, 'Excelangue', 10, NULL, 0, NULL, NULL, 55, 75, 30, 90, 8),
(109, 'Smogo', 12, NULL, 1, 35, 110, 65, 95, 35, 40, 4),
(110, 'Smogogo', 12, NULL, 0, NULL, NULL, 90, 120, 60, 65, 8),
(111, 'Rhinocorne', 15, 14, 1, 42, 112, 85, 95, 25, 80, 4),
(112, 'Rhinoféros', 15, 14, 0, NULL, NULL, 105, 130, 40, 105, 9),
(113, 'Leveinard', 10, NULL, 0, NULL, NULL, 5, 5, 50, 205, 5),
(114, 'Saquedeneu', 11, NULL, 0, NULL, NULL, 55, 115, 60, 65, 5),
(115, 'Kangourex', 10, NULL, 0, NULL, NULL, 95, 80, 90, 105, 8),
(116, 'Hypotrempe', 4, NULL, 1, 32, 117, 40, 70, 60, 30, 4),
(117, 'Hypocéan', 4, NULL, 0, NULL, NULL, 65, 95, 85, 55, 10),
(118, 'Poissirène', 4, NULL, 1, 32, 119, 67, 60, 63, 45, 2),
(119, 'Poissoroy', 4, NULL, 0, NULL, NULL, 92, 65, 68, 80, 9),
(120, 'Stari', 4, NULL, 1, 30, 121, 45, 55, 85, 30, 1),
(121, 'Staross', 4, 13, 0, NULL, NULL, 75, 85, 115, 60, 4),
(122, 'M. Mime', 13, 6, 0, NULL, NULL, 45, 65, 90, 40, 8),
(123, 'Insécateur', 9, 18, 0, NULL, NULL, 110, 80, 105, 70, 8),
(124, 'Lippoutou', 8, 13, 0, NULL, NULL, 50, 35, 115, 65, 7),
(125, 'Élektek', 5, NULL, 0, NULL, NULL, 83, 57, 105, 65, 7),
(126, 'Magmar', 7, NULL, 0, NULL, NULL, 95, 57, 93, 65, 10),
(127, 'Scarabrute', 9, NULL, 0, NULL, NULL, 125, 100, 85, 65, 6),
(128, 'Tauros', 10, NULL, 0, NULL, NULL, 100, 95, 110, 75, 6),
(129, 'Magicarpe', 4, NULL, 1, 20, 130, 10, 55, 80, 20, 5),
(130, 'Léviator', 4, 18, 0, NULL, NULL, 125, 79, 81, 95, 10),
(131, 'Lokhlass', 4, 8, 0, NULL, NULL, 85, 80, 60, 130, 10),
(132, 'Métamorph', 10, NULL, 0, NULL, NULL, 48, 48, 48, 48, 11),
(133, 'Évoli', 10, NULL, 1, 25, 134, 55, 50, 55, 55, 3),
(134, 'Aquali', 4, NULL, 0, NULL, NULL, 65, 60, 65, 130, 8),
(135, 'Voltali', 5, NULL, 0, NULL, NULL, 65, 60, 130, 65, 8),
(136, 'Pyroli', 7, NULL, 0, NULL, NULL, 130, 60, 65, 65, 8),
(137, 'Porygon', 10, NULL, 0, NULL, NULL, 60, 70, 40, 65, 7),
(138, 'Amonita', 14, 4, 1, 40, 139, 40, 100, 35, 35, 5),
(139, 'Amonistar', 14, 4, 0, NULL, NULL, 60, 125, 55, 70, 9),
(140, 'Kabuto', 14, 4, 1, 40, 141, 80, 90, 55, 30, 5),
(141, 'Kabutops', 14, 4, 0, NULL, NULL, 115, 105, 80, 60, 9),
(142, 'Ptéra', 14, 18, 0, NULL, NULL, 105, 65, 130, 80, 8),
(143, 'Ronflex', 10, NULL, 0, NULL, NULL, 110, 65, 30, 160, 5),
(144, 'Artikodin', 8, 18, 0, NULL, NULL, 85, 90, 85, 90, 11),
(145, 'Électhor', 5, 18, 0, NULL, NULL, 90, 85, 100, 90, 11),
(146, 'Sulfura', 7, 18, 0, NULL, NULL, 100, 90, 90, 90, 11),
(147, 'Minidraco', 3, NULL, 1, 30, 148, 64, 45, 50, 41, 1),
(148, 'Draco', 3, NULL, 1, 55, 149, 84, 65, 70, 61, 0),
(149, 'Dracolosse', 3, 18, 0, NULL, NULL, 134, 95, 80, 91, 0),
(150, 'Mewtwo', 13, NULL, 0, NULL, NULL, 110, 90, 130, 106, 11),
(151, 'Mew', 13, NULL, 0, NULL, NULL, 100, 100, 100, 100, 11);

-- --------------------------------------------------------

--
-- Structure de la table `PokedexParDresseur`
--

CREATE TABLE `PokedexParDresseur` (
  `numC` int(11) NOT NULL,
  `pokemon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `PokedexParDresseur`
--

INSERT INTO `PokedexParDresseur` (`numC`, `pokemon`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 31),
(1, 97),
(9, 2),
(9, 3),
(9, 7),
(9, 63),
(9, 98);

-- --------------------------------------------------------

--
-- Structure de la table `PokemonSeul`
--

CREATE TABLE `PokemonSeul` (
  `numero` int(11) NOT NULL,
  `numP` int(11) NOT NULL,
  `surnom` varchar(30) NOT NULL,
  `niveau` int(11) NOT NULL DEFAULT '1',
  `vie` int(11) DEFAULT NULL,
  `vieMax` int(11) NOT NULL,
  `xp` int(11) DEFAULT '0',
  `statF` int(11) NOT NULL,
  `statD` int(11) NOT NULL,
  `statV` int(11) NOT NULL,
  `att1` int(11) DEFAULT NULL,
  `att2` int(11) DEFAULT NULL,
  `att3` int(11) DEFAULT NULL,
  `att4` int(11) DEFAULT NULL,
  `pp1` int(11) DEFAULT NULL,
  `pp2` int(11) DEFAULT NULL,
  `pp3` int(11) DEFAULT NULL,
  `pp4` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `PokemonSeul`
--

INSERT INTO `PokemonSeul` (`numero`, `numP`, `surnom`, `niveau`, `vie`, `vieMax`, `xp`, `statF`, `statD`, `statV`, `att1`, `att2`, `att3`, `att4`, `pp1`, `pp2`, `pp3`, `pp4`) VALUES
(3, 29, 'Nidoran(femelle)', 74, 277, 277, 390, 269, 274, 263, 66, 58, 59, 53, 25, 20, 20, 30),
(4, 146, 'Sulfura', 70, 300, 300, 350, 310, 300, 300, 44, 157, 151, 156, 10, 15, 5, 15),
(6, 19, 'Rattata', 98, 324, 324, 300, 350, 329, 366, 16, 9, 0, 0, 35, 35, 0, 0),
(7, 97, 'Hypnomade', 60, 265, 265, 430, 253, 250, 247, 227, 0, 0, 0, 5, 0, 0, 0),
(8, 3, 'Florizarre', 57, 251, 251, 170, 253, 254, 251, 193, 182, 0, 0, 15, 10, 0, 0),
(9, 113, 'Leveinard', 9, 232, 232, 0, 32, 32, 77, 8, 4, 0, 0, 30, 5, 0, 0),
(10, 38, 'Feunard', 58, 247, 247, 0, 250, 249, 274, 151, 158, 163, 152, 5, 15, 15, 5),
(17, 40, 'Grodoudou', 92, 416, 416, 0, 346, 321, 321, 8, 273, 5, 13, 30, 10, 20, 15),
(20, 3, 'Florizarre', 34, 147, 182, 140, 184, 185, 182, 183, 196, 195, NULL, 24, 95, 10, NULL),
(81, 7, 'Carapuce', 17, 95, 95, 90, 99, 116, 859, 167, 172, NULL, NULL, 5, 25, NULL, NULL),
(82, 4, 'Salamèche', 5, 54, 54, 0, 67, 58, 80, 159, 148, NULL, NULL, 25, 15, NULL, NULL),
(83, 1, 'Bulbizarre', 5, 60, 60, 0, 64, 64, 60, 183, 196, NULL, NULL, 24, 95, NULL, NULL),
(98, 29, 'Nidoran(femelle)', 6, 73, 73, 0, 65, 70, 59, 59, 70, 56, 62, 20, 20, 15, 20),
(99, 141, 'Kabutops', 6, 78, 78, 0, 133, 123, 98, 94, 0, 0, 0, 5, 0, 0, 0),
(100, 31, 'Nidoqueen', 40, 210, 210, 180, 212, 207, 196, 61, 66, 64, 70, 15, 25, 10, 20),
(101, 51, 'Triopikeur', 9, 62, 62, 50, 107, 77, 147, 85, 84, 73, 0, 10, 10, 20, 0),
(103, 150, 'Mewtwo', 16, 154, 154, 0, 158, 138, 178, 233, 219, 223, 225, 100, 10, 15, 90),
(108, 7, 'Carapuce', 5, 59, 59, 0, 63, 80, 58, 167, 172, NULL, NULL, 5, 25, NULL, NULL),
(109, 134, 'Aquali', 37, 232, 232, 290, 176, 171, 176, 179, 164, 0, 0, 10, 30, 0, 0),
(110, 26, 'Raichu', 37, 171, 171, 270, 201, 166, 221, 216, 0, 0, 0, 15, 0, 0, 0),
(111, 132, 'Métamorph', 12, 16, 84, 90, 84, 84, 84, 2, 4, 0, 0, 9, 4, 0, 0),
(112, 151, 'Mew', 11, 133, 133, 0, 133, 133, 133, 220, 219, 0, 0, 25, 10, 0, 0),
(113, 4, 'Salamèche', 5, 54, 54, 0, 67, 58, 80, 159, 148, 0, 0, 25, 15, 0, 0),
(114, 7, 'Carapuce', 6, 62, 62, 0, 66, 83, 61, 164, 172, 0, 0, 28, 23, 0, 0),
(116, 120, 'Stari', 5, 45, 45, 30, 60, 70, 100, 181, 169, 166, 0, 10, 15, 15, 0),
(117, 7, 'Carapuce', 4, 56, 56, 0, 60, 77, 55, 170, 181, 179, 0, 20, 10, 10, 0),
(118, 63, 'Abra', 2, 31, 31, 0, 26, 21, 96, 233, 230, 0, 0, 100, 5, 0, 0),
(119, 98, 'Krabby', 1, 33, 33, 0, 108, 93, 53, 164, 170, 171, 180, 30, 20, 15, 10),
(120, 7, 'Carapuce', 5, 59, 59, 0, 63, 80, 58, 164, 172, 0, 0, 30, 25, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Sac`
--

CREATE TABLE `Sac` (
  `numC` int(11) NOT NULL,
  `pokeD` int(11) DEFAULT '500',
  `pokeB` int(11) DEFAULT '10',
  `superB` int(11) DEFAULT '0',
  `hyperB` int(11) DEFAULT '0',
  `soin` int(11) DEFAULT '0',
  `soinS` int(11) DEFAULT '0',
  `soinH` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Sac`
--

INSERT INTO `Sac` (`numC`, `pokeD`, `pokeB`, `superB`, `hyperB`, `soin`, `soinS`, `soinH`) VALUES
(1, 288450, 19, 5, 80, 0, 24, 116),
(9, 50, 0, 0, 2, 17, 0, 0),
(42, 1000, 3, 0, 0, 3, 0, 0),
(43, 50, 10, 0, 0, 10, 0, 0),
(44, 500, 10, 0, 0, 9, 0, 0),
(45, 500, 10, 0, 0, 0, 0, 0),
(46, 550, 10, 0, 0, 0, 0, 0),
(48, 500, 10, 0, 0, 0, 0, 0),
(49, 500, 10, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Type`
--

CREATE TABLE `Type` (
  `numT` int(11) NOT NULL,
  `nomT` varchar(30) DEFAULT NULL,
  `type1` float NOT NULL DEFAULT '1',
  `type2` float NOT NULL DEFAULT '1',
  `type3` float NOT NULL DEFAULT '1',
  `type4` float NOT NULL DEFAULT '1',
  `type5` float NOT NULL DEFAULT '1',
  `type6` float NOT NULL DEFAULT '1',
  `type7` float NOT NULL DEFAULT '1',
  `type8` float NOT NULL DEFAULT '1',
  `type9` float NOT NULL DEFAULT '1',
  `type10` float NOT NULL DEFAULT '1',
  `type11` float NOT NULL DEFAULT '1',
  `type12` float NOT NULL DEFAULT '1',
  `type13` float NOT NULL DEFAULT '1',
  `type14` float NOT NULL DEFAULT '1',
  `type15` float NOT NULL DEFAULT '1',
  `type16` float NOT NULL DEFAULT '1',
  `type17` float NOT NULL DEFAULT '1',
  `type18` float NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Type`
--

INSERT INTO `Type` (`numT`, `nomT`, `type1`, `type2`, `type3`, `type4`, `type5`, `type6`, `type7`, `type8`, `type9`, `type10`, `type11`, `type12`, `type13`, `type14`, `type15`, `type16`, `type17`, `type18`) VALUES
(1, 'ACIER', 0.5, 1, 1, 0.5, 0.5, 2, 0.5, 2, 1, 1, 1, 1, 1, 2, 1, 1, 1, 1),
(2, 'COMBAT', 2, 1, 1, 1, 1, 0.5, 1, 2, 0.5, 2, 1, 0.5, 0.5, 2, 1, 0, 2, 0.5),
(3, 'DRAGON', 0.5, 1, 2, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(4, 'EAU', 1, 1, 0.5, 0.5, 1, 1, 2, 1, 1, 1, 0.5, 1, 1, 2, 2, 1, 1, 1),
(5, 'ELECTRIQUE', 1, 1, 0.5, 2, 0.5, 1, 1, 1, 1, 1, 0.5, 1, 1, 1, 0, 1, 1, 2),
(6, 'FEE', 0.5, 2, 2, 1, 1, 1, 0.5, 1, 1, 1, 1, 0.5, 1, 1, 1, 1, 2, 1),
(7, 'FEU', 2, 1, 0.5, 0.5, 1, 1, 0.5, 2, 2, 1, 2, 1, 1, 0.5, 1, 1, 1, 1),
(8, 'GLACE', 0.5, 1, 2, 0.5, 1, 1, 0.5, 0.5, 1, 1, 2, 1, 1, 1, 2, 1, 1, 2),
(9, 'INSECTE', 0.5, 0.5, 1, 1, 1, 0.5, 0.5, 1, 1, 1, 2, 0.5, 2, 1, 1, 0.5, 2, 0.5),
(10, 'NORMAL', 0.5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0.5, 1, 0, 1, 1),
(11, 'PLANTE', 0.5, 1, 0.5, 2, 1, 1, 0.5, 1, 1, 1, 0.5, 0.5, 1, 2, 2, 1, 1, 0.5),
(12, 'POISON', 0, 1, 1, 1, 1, 2, 1, 1, 1, 1, 2, 0.5, 1, 0.5, 0.5, 0.5, 1, 1),
(13, 'PSY', 0.5, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 0.5, 1, 1, 1, 0, 1),
(14, 'ROCHE', 0.5, 0.5, 1, 1, 1, 1, 2, 2, 2, 1, 1, 1, 1, 1, 0.5, 1, 1, 2),
(15, 'SOL', 2, 1, 1, 1, 2, 1, 2, 1, 0.5, 1, 0.5, 2, 1, 2, 1, 1, 1, 0),
(16, 'SPECTRE', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 2, 1, 1, 2, 0.5, 1),
(17, 'TENEBRES', 1, 0.5, 1, 1, 1, 0.5, 1, 1, 1, 1, 1, 1, 2, 1, 1, 2, 0.5, 1),
(18, 'VOL', 0.5, 2, 1, 1, 0.5, 1, 1, 1, 2, 1, 2, 1, 1, 0.5, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  `numC` int(11) NOT NULL,
  `connecter` int(11) NOT NULL DEFAULT '0',
  `dateC` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`pseudo`, `mdp`, `numC`, `connecter`, `dateC`) VALUES
('test@test.fr', '098f6bcd4621d373cade4e832627b4f6', 1, 0, 0),
('vincent21.vd@gmail.com', '0cc175b9c0f1b6a831c399e269772661', 9, 0, 0),
('o@o', '0cc175b9c0f1b6a831c399e269772661', 42, 0, 0),
('a@a', '0cc175b9c0f1b6a831c399e269772661', 43, 0, 0),
('y@y', '0cc175b9c0f1b6a831c399e269772661', 44, 0, 0),
('o@o.fr', '4fded1464736e77865df232cbcb4cd19', 45, 0, 0),
('b@b', 'ca2cd2bcc63c4d7c8725577442073dde', 46, 0, 0),
('bob@bob', '6920626369b1f05844f5e3d6f93b5f6e', 48, 0, 0),
('dodo@dodo', 'd4579b2688d675235f402f6b4b43bcbf', 49, 0, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Ami`
--
ALTER TABLE `Ami`
  ADD PRIMARY KEY (`moi`,`lui`);

--
-- Index pour la table `Attaque`
--
ALTER TABLE `Attaque`
  ADD PRIMARY KEY (`numA`);

--
-- Index pour la table `AttaqueParDresseur`
--
ALTER TABLE `AttaqueParDresseur`
  ADD PRIMARY KEY (`numC`,`attaque`);

--
-- Index pour la table `Combat`
--
ALTER TABLE `Combat`
  ADD PRIMARY KEY (`numCombat`);

--
-- Index pour la table `DemanderCombat`
--
ALTER TABLE `DemanderCombat`
  ADD PRIMARY KEY (`moi`,`lui`);

--
-- Index pour la table `Dresseur`
--
ALTER TABLE `Dresseur`
  ADD PRIMARY KEY (`numC`);

--
-- Index pour la table `EqPokemon`
--
ALTER TABLE `EqPokemon`
  ADD PRIMARY KEY (`numC`),
  ADD KEY `numC` (`numC`,`pokemon1`),
  ADD KEY `numC_2` (`numC`,`pokemon2`),
  ADD KEY `numC_3` (`numC`,`pokemon3`),
  ADD KEY `numC_4` (`numC`,`pokemon4`),
  ADD KEY `numC_5` (`numC`,`pokemon5`),
  ADD KEY `numC_6` (`numC`,`pokemon6`);

--
-- Index pour la table `Ordinateur`
--
ALTER TABLE `Ordinateur`
  ADD PRIMARY KEY (`numC`,`numero`);

--
-- Index pour la table `Pokedex`
--
ALTER TABLE `Pokedex`
  ADD PRIMARY KEY (`numP`);

--
-- Index pour la table `PokedexParDresseur`
--
ALTER TABLE `PokedexParDresseur`
  ADD PRIMARY KEY (`numC`,`pokemon`);

--
-- Index pour la table `PokemonSeul`
--
ALTER TABLE `PokemonSeul`
  ADD PRIMARY KEY (`numero`);

--
-- Index pour la table `Sac`
--
ALTER TABLE `Sac`
  ADD PRIMARY KEY (`numC`);

--
-- Index pour la table `Type`
--
ALTER TABLE `Type`
  ADD PRIMARY KEY (`numT`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`numC`),
  ADD UNIQUE KEY `nomUnique` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Attaque`
--
ALTER TABLE `Attaque`
  MODIFY `numA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT pour la table `Combat`
--
ALTER TABLE `Combat`
  MODIFY `numCombat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `PokemonSeul`
--
ALTER TABLE `PokemonSeul`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `numC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `EqPokemon`
--
ALTER TABLE `EqPokemon`
  ADD CONSTRAINT `EqPokemon_ibfk_1` FOREIGN KEY (`numC`,`pokemon1`) REFERENCES `Ordinateur` (`numC`, `numero`) ON DELETE CASCADE,
  ADD CONSTRAINT `EqPokemon_ibfk_2` FOREIGN KEY (`numC`,`pokemon2`) REFERENCES `Ordinateur` (`numC`, `numero`) ON DELETE CASCADE,
  ADD CONSTRAINT `EqPokemon_ibfk_3` FOREIGN KEY (`numC`,`pokemon3`) REFERENCES `Ordinateur` (`numC`, `numero`) ON DELETE CASCADE,
  ADD CONSTRAINT `EqPokemon_ibfk_4` FOREIGN KEY (`numC`,`pokemon4`) REFERENCES `Ordinateur` (`numC`, `numero`) ON DELETE CASCADE,
  ADD CONSTRAINT `EqPokemon_ibfk_5` FOREIGN KEY (`numC`,`pokemon5`) REFERENCES `Ordinateur` (`numC`, `numero`) ON DELETE CASCADE,
  ADD CONSTRAINT `EqPokemon_ibfk_6` FOREIGN KEY (`numC`,`pokemon6`) REFERENCES `Ordinateur` (`numC`, `numero`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
