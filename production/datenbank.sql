-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 09. Aug 2017 um 18:19
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
(1, 'user1', 0, 'dhbw1', 'user1@test.de', '$2y$10$Os/dW0Q8XUDr742NE39EyOfe2bhQ9YoIhcdoACvSsBG8k0DaATiB.', 20, 'female', '2b4267f96a2b4af113f1b549df549aca', 1);

--
-- Indizes der exportierten Tabellen
--

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
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
