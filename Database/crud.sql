-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 09 jan. 2022 à 19:28
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `crud`
--

-- --------------------------------------------------------

--
-- Structure de la table `statique`
--

CREATE TABLE `statique` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `statique`
--

INSERT INTO `statique` (`id`, `name`) VALUES
(1, 'statique de nationalité'),
(2, 'statique de groupe singuin'),
(3, 'statique de consommation tabacs '),
(4, 'statique de activité sportive'),
(5, 'statique de relegion');

-- --------------------------------------------------------

--
-- Structure de la table `studentnationality`
--

CREATE TABLE `studentnationality` (
  `cid` int(11) NOT NULL,
  `cname2` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `studentnationality`
--

INSERT INTO `studentnationality` (`cid`, `cname2`) VALUES
(0, 'Algérie'),
(1, 'Tunisie'),
(2, 'Arabie Saoudite'),
(3, 'Egypte'),
(4, 'Libye'),
(5, 'Maroc'),
(6, 'Palestine'),
(7, 'Qatar'),
(8, 'Syrie'),
(24, 'Canada');

-- --------------------------------------------------------

--
-- Structure de la table `studentsport`
--

CREATE TABLE `studentsport` (
  `cid` int(11) NOT NULL,
  `cname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `studentsport`
--

INSERT INTO `studentsport` (`cid`, `cname`) VALUES
(3, 'Basket-ball'),
(1, 'Foot-ball'),
(2, 'Hand-ball'),
(0, 'Marche'),
(4, 'Tenis');

-- --------------------------------------------------------

--
-- Structure de la table `student_data`
--

CREATE TABLE `student_data` (
  `id` int(10) NOT NULL,
  `u_order` int(10) NOT NULL,
  `u_save` date NOT NULL,
  `u_nationaliti` int(5) NOT NULL,
  `u_drapeau` varchar(250) NOT NULL,
  `u_adr` varchar(70) NOT NULL,
  `u_ville` varchar(50) NOT NULL,
  `u_pays` varchar(50) NOT NULL,
  `u_email` text NOT NULL,
  `u_f_name` text NOT NULL,
  `u_l_name` text NOT NULL,
  `u_state` varchar(12) NOT NULL,
  `u_relegion` varchar(12) NOT NULL,
  `u_blode` varchar(3) NOT NULL,
  `u_tabac` tinyint(1) NOT NULL,
  `u_birthday` date NOT NULL,
  `u_birthdayAdr` varchar(30) NOT NULL,
  `u_birthdayPay` varchar(30) NOT NULL,
  `u_proffesion` varchar(40) NOT NULL,
  `u_proffesionAdr` varchar(100) NOT NULL,
  `u_proffesionVille` varchar(50) NOT NULL,
  `u_phone` varchar(10) NOT NULL,
  `u_arts` varchar(250) NOT NULL,
  `u_sport` int(5) NOT NULL,
  `image` varchar(150) NOT NULL,
  `video` varchar(250) NOT NULL,
  `u_family` text NOT NULL,
  `uploaded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `student_data`
--

INSERT INTO `student_data` (`id`, `u_order`, `u_save`, `u_nationaliti`, `u_drapeau`, `u_adr`, `u_ville`, `u_pays`, `u_email`, `u_f_name`, `u_l_name`, `u_state`, `u_relegion`, `u_blode`, `u_tabac`, `u_birthday`, `u_birthdayAdr`, `u_birthdayPay`, `u_proffesion`, `u_proffesionAdr`, `u_proffesionVille`, `u_phone`, `u_arts`, `u_sport`, `image`, `video`, `u_family`, `uploaded`) VALUES
(137, 21116, '2022-01-20', 4, 'a.JPG', 'dazda', 'zdaz', 'dazdazd', 'azdaz@azdaz', 'dzad', 'zadazd', 'Marié', 'Juive', 'o+', 0, '2021-12-30', 'qzdqs', 'dsq', 'dsqdsq', 'azdzadqs', 'dsqdaz', '15816', 'Théatre|Cinéma|Musique Universelle|Littérature|Arts plastiques', 2, '', '', 'dazdazdaz', '2022-01-05'),
(138, 21116, '2022-01-20', 3, '222222-removebg-preview.png', 'dazda', 'zdaz', 'dazdazd', 'azdaz@azdaz', 'dzad', 'zadazd', 'Marié', 'Juive', 'AB+', 0, '2021-12-30', 'qzdqs', 'dsq', 'dsqdsq', 'azdzadqs', 'dsqdaz', '15816', 'Théatre', 3, 'a.JPG', '', 'dazdazdaz', '2022-01-05'),
(139, 21116, '2021-12-31', 2, 'a.JPG', 'Bellouladi 620', 'Sidi Bel Abbes', 'Algeria', 'b.dehini@esi-sba.dz', 'Dehini', 'Bilal', 'Veuf', 'Chrétienne', 'O-', 0, '2021-12-31', 'Sidi Bell Abbes', 'Algeria', 'Etudient', 'Bellouladi 620', 'Sidi Bel Abbes', '15816', 'Théatre|Musique Universelle|Arts plastiques', 2, 'z.JPG', '(20+) Facebook_4.mp4', 'Je suis indormaticien', '2022-01-05'),
(168, 1314, '2021-12-31', 0, 'a.JPG', 'aaa', 'aaa', 'aaaa', 'b.dehini@esi-sba.dz', 'zadk zedk', 'qsdqs', 'Marié', 'Musulmane', 'O+', 1, '2022-01-27', 'hhsqjxsq', 'kl,lkdsq', 'aaaa', 'aaa', 'aaaa', '7899', 'Théatre|Arts plastiques', 1, 'z.JPG', '1.mp4', 'aaa', '2022-01-08');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `admin`, `created_at`) VALUES
(6, 'Marche', '$2y$10$AwA0obkWAdzF6Z6zCqZ3Xu5QinFNWhL89iAUde8YYfYorruaxOjCm', 1, '2021-07-17 16:49:54'),
(8, 'bilal', '$2y$10$FVsWBKydsRTzhGJyDUH6a.m.NL5Axkau1bF0PUebmHmApsMwu.7Lm', 1, '2022-01-05 19:32:31'),
(9, 'bilalo', '$2y$10$7Xu.gnZuVTgghDFyjNYM/uo60Kvj3MYP7xTNoQe/N60Gq9ugOlO4m', 0, '2022-01-06 16:16:46'),
(10, 'bilalaaa', '$2y$10$9tSmZM6cKMNKDHw7RC0pJ.9t85tUpyikekBcALYHanE8ChYycNgY.', 0, '2022-01-06 17:02:06'),
(11, 'bilalaaaa', '$2y$10$2Yley5rf1z7OHNGreE7mMuLYxRGSs/EhhFmIINgDPsvzAcAn7TrwC', 0, '2022-01-06 17:02:37'),
(12, 'DEHINIMOKHTAREa', '$2y$10$j9odetxTc.qN/L9Ug5m6ReF6mq2cSqVQYd9B0OPLi0f2SZQ.fOKI6', 1, '2022-01-06 17:03:03'),
(13, 'asasasasa', '$2y$10$GAEf8hWVeg/mYmLX1Az7ieJJViD8ZOrL1p1AeoCbBiIa0hmd.Hhd6', 1, '2022-01-06 17:09:31'),
(14, 'aaaaaaaaa', '$2y$10$XbZ40EFS7rJ.Zs6KjrMQvOoP91YmSkRwAETERRFa0J2nFcWqIRsCi', 0, '2022-01-06 17:11:40');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `statique`
--
ALTER TABLE `statique`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `studentnationality`
--
ALTER TABLE `studentnationality`
  ADD PRIMARY KEY (`cid`);

--
-- Index pour la table `studentsport`
--
ALTER TABLE `studentsport`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `username` (`cname`);

--
-- Index pour la table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `statique`
--
ALTER TABLE `statique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `studentnationality`
--
ALTER TABLE `studentnationality`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `studentsport`
--
ALTER TABLE `studentsport`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
