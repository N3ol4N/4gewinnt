-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 11. Aug 2017 um 10:01
-- Server-Version: 10.1.25-MariaDB
-- PHP-Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `databases`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `avatars`
--

CREATE TABLE `avatars` (
  `avatarid` int(255) NOT NULL,
  `imgdata` longblob NOT NULL,
  `imgname` varchar(255) NOT NULL,
  `imgsize` int(11) NOT NULL,
  `imgtype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `parties`
--

CREATE TABLE `parties` (
  `SpielID` int(255) NOT NULL,
  `Spieler1` varchar(255) NOT NULL DEFAULT 'noone',
  `Spieler2` varchar(255) NOT NULL DEFAULT 'noone',
  `AmZug` varchar(255) NOT NULL DEFAULT '0',
  `1` varchar(255) NOT NULL DEFAULT '0',
  `2` varchar(255) NOT NULL DEFAULT '0',
  `3` varchar(255) NOT NULL DEFAULT '0',
  `4` varchar(255) NOT NULL DEFAULT '0',
  `5` varchar(255) NOT NULL DEFAULT '0',
  `6` varchar(255) NOT NULL DEFAULT '0',
  `7` varchar(255) NOT NULL DEFAULT '0',
  `8` varchar(255) NOT NULL DEFAULT '0',
  `9` varchar(255) NOT NULL DEFAULT '0',
  `10` varchar(255) NOT NULL DEFAULT '0',
  `11` varchar(255) NOT NULL DEFAULT '0',
  `12` varchar(255) NOT NULL DEFAULT '0',
  `13` varchar(255) NOT NULL DEFAULT '0',
  `14` varchar(255) NOT NULL DEFAULT '0',
  `15` varchar(255) NOT NULL DEFAULT '0',
  `16` varchar(255) NOT NULL DEFAULT '0',
  `17` varchar(255) NOT NULL DEFAULT '0',
  `18` varchar(255) NOT NULL DEFAULT '0',
  `19` varchar(255) NOT NULL DEFAULT '0',
  `20` varchar(255) NOT NULL DEFAULT '0',
  `21` varchar(255) NOT NULL DEFAULT '0',
  `22` varchar(255) NOT NULL DEFAULT '0',
  `23` varchar(255) NOT NULL DEFAULT '0',
  `24` varchar(255) NOT NULL DEFAULT '0',
  `25` varchar(255) NOT NULL DEFAULT '0',
  `26` varchar(255) NOT NULL DEFAULT '0',
  `27` varchar(255) NOT NULL DEFAULT '0',
  `28` varchar(255) NOT NULL DEFAULT '0',
  `29` varchar(255) NOT NULL DEFAULT '0',
  `30` varchar(255) NOT NULL DEFAULT '0',
  `31` varchar(255) NOT NULL DEFAULT '0',
  `32` varchar(255) NOT NULL DEFAULT '0',
  `33` varchar(255) NOT NULL DEFAULT '0',
  `34` varchar(255) NOT NULL DEFAULT '0',
  `35` varchar(255) NOT NULL DEFAULT '0',
  `36` varchar(255) NOT NULL DEFAULT '0',
  `37` varchar(255) NOT NULL DEFAULT '0',
  `38` varchar(255) NOT NULL DEFAULT '0',
  `39` varchar(255) NOT NULL DEFAULT '0',
  `40` varchar(255) NOT NULL DEFAULT '0',
  `41` varchar(255) NOT NULL DEFAULT '0',
  `42` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `nickname` varchar(100) COLLATE utf8_bin NOT NULL,
  `avatarid` int(255) NOT NULL,
  `username` varchar(100) COLLATE utf8_bin NOT NULL,
  `mail` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(200) COLLATE utf8_bin NOT NULL,
  `useralter` int(11) NOT NULL,
  `geschlecht` varchar(255) COLLATE utf8_bin NOT NULL,
  `challenge` varchar(100) COLLATE utf8_bin NOT NULL,
  `confirmed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `nickname`, `avatarid`, `username`, `mail`, `password`, `useralter`, `geschlecht`, `challenge`, `confirmed`) VALUES
(1, 'user1', 0, 'dhbw1', 'user1@test.de', '$2y$10$Os/dW0Q8XUDr742NE39EyOfe2bhQ9YoIhcdoACvSsBG8k0DaATiB.', 20, 'male', '2b4267f96a2b4af113f1b549df549aca', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`avatarid`);

--
-- Indizes für die Tabelle `parties`
--
ALTER TABLE `parties`
  ADD PRIMARY KEY (`SpielID`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userName` (`nickname`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `avatars`
--
ALTER TABLE `avatars`
  MODIFY `avatarid` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `parties`
--
ALTER TABLE `parties`
  MODIFY `SpielID` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
