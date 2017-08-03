-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 01. Aug 2017 um 17:41
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
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passwort` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `challenge` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `passwort`, `created_at`, `updated_at`, `challenge`) VALUES
(6, 'du', 'du@du.de', '$2y$10$fz6BETZvPIL8Gpmxhgz.luC9HVxB6SwQ0aCE3yZV2KoXY4xHP6n4G', '2017-08-01 13:03:22', NULL, 0),
(7, 'er', 'er@er.de', '$2y$10$WQh0EhF.UVx6bb.0Vkfvn.nYkC.cpeMkH53WB1peqZM64S6FeF.SW', '2017-08-01 13:06:22', NULL, 0),
(8, 'sie', 'sie@sie.de', '$2y$10$zZVz/hXo3WNEEsEHskndYOzSRXgqOZjkGgCKa9kU8qF1Ax3dvxev.', '2017-08-01 13:29:59', NULL, 0),
(9, 'wir', 'wir@wir.de', '$2y$10$OPq.EpVi77qpczxkZVg2muvtEKlNvJkzKRfNerBe3gfDnhpFjmrca', '2017-08-01 15:40:16', NULL, 234600000);

--
-- Indizes der exportierten Tabellen
--

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
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
