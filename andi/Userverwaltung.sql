-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 31. Jul 2017 um 19:24
-- Server-Version: 10.1.22-MariaDB
-- PHP-Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `VierGewinnt`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Userverwaltung`
--

CREATE TABLE `Userverwaltung` (
  `id` int(10) NOT NULL,
  `username` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `Userverwaltung`
--

INSERT INTO `Userverwaltung` (`id`, `username`, `password`, `email`, `activated`) VALUES
(1, 'andreas', '$2y$10$s4qpnVRQ9kE6iZhRUHpQWuruHJt5Yzoh2dBELU0/buYq5S1r5qsw.', 'andreas@me.de', 1),
(2, 'heiko', '$2y$10$4I77XjaHMrrGllFRuMdAY.NBNev0mTA.QPmRB7YJAXt.WDbiGkXfG', 'heiko@me.de', 1),
(4, 'steffi', '$2y$10$.NaC9MIEt2/yUb25KzJTw.2Y1oRJPgpFUe7H4Ra4lfsx9gUKBggLa', 'steffi@me.de', 1),
(5, 'rahel', '$2y$10$GS0HrqV9c0ne.HctzokRXOmD8Up/bz.Ul9Dtp9I/5ilds3w7g5kIu', 'rahel@me.de', 1),
(6, 'stefan', '$2y$10$jaIcVg9NMfbSmTMR9GeOnuGgzOgUswbFycjZAq4trVooZlLwDLBD6', 'stefan@me.de', 1),
(7, 'regi', '$2y$10$92lPLL6B6hbrxY1cBLAhQuUDIGCzCNJzMTctAhatqWEiPfQTTB6oe', 'regi@me.de', 1),
(8, 'niklas', '$2y$10$c5w1FCQ1oQRCFgeA0WuUoOYwdoh/7kTf9gkoiZT2kmKeIJfJImIsq', 'krassman@niklas.de', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Userverwaltung`
--
ALTER TABLE `Userverwaltung`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `Userverwaltung`
--
ALTER TABLE `Userverwaltung`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
