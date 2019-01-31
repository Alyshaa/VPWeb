-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 31. Jan 2019 um 09:55
-- Server-Version: 10.1.37-MariaDB
-- PHP-Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `vertretungsplan`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `stunde` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `klasse` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `vertretung` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `fach` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `anmerkung` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hinzugefuegt` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `plan`
--

INSERT INTO `plan` (`id`, `stunde`, `klasse`, `vertretung`, `fach`, `anmerkung`, `hinzugefuegt`) VALUES
(250, 'aaaa', 'bbb', 'cccc', 'dddd', NULL, '2019-01-30 15:26:07'),
(249, 'aaaaa', 'bbb', 'ccc', 'dddd', NULL, '2019-01-30 15:26:07'),
(248, 'aaaa', 'bbb', 'ccc', 'dd', NULL, '2019-01-30 15:26:07');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
