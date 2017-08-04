-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 04. Aug 2017 um 11:08
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
-- Datenbank: `database`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lobby`
--

CREATE TABLE `lobby` (
  `PartieID` int(255) NOT NULL,
  `Spieler1` int(255) NOT NULL,
  `Spieler2` int(255) NOT NULL,
  `offen` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `spielfeld`
--

CREATE TABLE `spielfeld` (
  `SpielID` int(255) NOT NULL,
  `Spieler1` int(255) NOT NULL,
  `Spieler2` int(255) NOT NULL,
  `AmZug` int(11) NOT NULL DEFAULT '0',
  `Feld1` int(11) NOT NULL DEFAULT '0',
  `Feld2` int(11) NOT NULL DEFAULT '0',
  `Feld3` int(11) NOT NULL DEFAULT '0',
  `Feld4` int(11) NOT NULL DEFAULT '0',
  `Feld5` int(11) NOT NULL DEFAULT '0',
  `Feld6` int(11) NOT NULL DEFAULT '0',
  `Feld7` int(11) NOT NULL DEFAULT '0',
  `Feld8` int(11) NOT NULL DEFAULT '0',
  `Feld9` int(11) NOT NULL DEFAULT '0',
  `Feld10` int(11) NOT NULL DEFAULT '0',
  `Feld11` int(11) NOT NULL DEFAULT '0',
  `Feld12` int(11) NOT NULL DEFAULT '0',
  `Feld13` int(11) NOT NULL DEFAULT '0',
  `Feld14` int(11) NOT NULL DEFAULT '0',
  `Feld15` int(11) NOT NULL DEFAULT '0',
  `Feld16` int(11) NOT NULL DEFAULT '0',
  `Feld17` int(11) NOT NULL DEFAULT '0',
  `Feld18` int(11) NOT NULL DEFAULT '0',
  `Feld19` int(11) NOT NULL DEFAULT '0',
  `Feld20` int(11) NOT NULL DEFAULT '0',
  `Feld21` int(11) NOT NULL DEFAULT '0',
  `Feld22` int(11) NOT NULL DEFAULT '0',
  `Feld23` int(11) NOT NULL DEFAULT '0',
  `Feld24` int(11) NOT NULL DEFAULT '0',
  `Feld25` int(11) NOT NULL DEFAULT '0',
  `Feld26` int(11) NOT NULL DEFAULT '0',
  `Feld27` int(11) NOT NULL DEFAULT '0',
  `Feld28` int(11) NOT NULL DEFAULT '0',
  `Feld29` int(11) NOT NULL DEFAULT '0',
  `Feld30` int(11) NOT NULL DEFAULT '0',
  `Feld31` int(11) NOT NULL DEFAULT '0',
  `Feld32` int(11) NOT NULL DEFAULT '0',
  `Feld33` int(11) NOT NULL DEFAULT '0',
  `Feld34` int(11) NOT NULL DEFAULT '0',
  `Feld35` int(11) NOT NULL DEFAULT '0',
  `Feld36` int(11) NOT NULL DEFAULT '0',
  `Feld37` int(11) NOT NULL DEFAULT '0',
  `Feld38` int(11) NOT NULL DEFAULT '0',
  `Feld39` int(11) NOT NULL DEFAULT '0',
  `Feld40` int(11) NOT NULL DEFAULT '0',
  `Feld41` int(11) NOT NULL DEFAULT '0',
  `Feld42` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `spielfeld`
--

INSERT INTO `spielfeld` (`SpielID`, `Spieler1`, `Spieler2`, `AmZug`, `Feld1`, `Feld2`, `Feld3`, `Feld4`, `Feld5`, `Feld6`, `Feld7`, `Feld8`, `Feld9`, `Feld10`, `Feld11`, `Feld12`, `Feld13`, `Feld14`, `Feld15`, `Feld16`, `Feld17`, `Feld18`, `Feld19`, `Feld20`, `Feld21`, `Feld22`, `Feld23`, `Feld24`, `Feld25`, `Feld26`, `Feld27`, `Feld28`, `Feld29`, `Feld30`, `Feld31`, `Feld32`, `Feld33`, `Feld34`, `Feld35`, `Feld36`, `Feld37`, `Feld38`, `Feld39`, `Feld40`, `Feld41`, `Feld42`) VALUES
(2, 1, 3, 1, 1, 3, 1, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 1, 3, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passwort` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vorname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `useralter` int(11) NOT NULL,
  `geschlecht` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` blob NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `challenge` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `nickname`, `email`, `passwort`, `vorname`, `nachname`, `useralter`, `geschlecht`, `avatar`, `created_at`, `updated_at`, `challenge`) VALUES
(1, 'ichnick', 'ich@ich.de', '$2y$10$b4Px0igaL9lUmM/eVg4OZeFSzvQCmJTWO7wVpmpUr5bVKt/08GLmm', 'ichvorname', 'ichnachname', 4, 'mÃ¤nnlich', 0x70726f66696c62696c64322e706e67, '2017-08-03 15:03:55', NULL, 0),
(3, 'dunick', 'du@du.de', '$2y$10$8H35p35SWMnE/rMi0inLtOCc/R4gpv9SxXHmkQVDS0Z01.8KYNRD.', 'duvorname', 'dunachname', 0, 'weiblich', '', '2017-08-03 15:05:35', NULL, 0),
(4, 'wirnick', 'wir@wir.de', '$2y$10$59DaoRrF.NKfwluYBz/syeH8JmJrC4COr9V4HHOt28WlPOwSXGBf.', 'wirvorname', 'wirnachname', 0, 'mÃ¤nnlich', '', '2017-08-04 08:45:58', NULL, 91);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `lobby`
--
ALTER TABLE `lobby`
  ADD PRIMARY KEY (`PartieID`);

--
-- Indizes für die Tabelle `spielfeld`
--
ALTER TABLE `spielfeld`
  ADD PRIMARY KEY (`SpielID`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `lobby`
--
ALTER TABLE `lobby`
  MODIFY `PartieID` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `spielfeld`
--
ALTER TABLE `spielfeld`
  MODIFY `SpielID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
