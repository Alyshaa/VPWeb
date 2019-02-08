-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 07. Feb 2019 um 14:17
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
  `hinzugefuegt` datetime DEFAULT CURRENT_TIMESTAMP,
  `datum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `plan`
--

INSERT INTO `plan` (`id`, `stunde`, `klasse`, `vertretung`, `fach`, `anmerkung`, `hinzugefuegt`, `datum`) VALUES
(285, '123123', '123123', '1231231', '231231231', '23123123123', '2019-02-07 08:28:09', '2019-02-07'),
(268, '1', '2', '3', '4', '5', '2019-01-31 12:34:26', '2019-02-07'),
(274, '123', '123', '123', '123', '123', '2019-02-05 14:54:31', '2019-02-07'),
(290, '', '123123', '123123', '123123', '123123', '2019-02-07 11:44:26', '2019-02-08'),
(289, '', '123123123', '3123123', '12312', '123123', '2019-02-07 11:43:48', '2019-02-08'),
(288, '', '123123', '1111', '11111', '111111', '2019-02-07 11:42:39', '2019-02-08'),
(287, '1.', 'ey', 'ey', 'ey', 'ey', '2019-02-07 10:31:54', '2019-02-08'),
(291, '5', '123123123', '12312312', '23123123', '123123', '2019-02-07 12:16:23', '2019-02-08'),
(293, '', '12', '111', '13223', '1231231231', '2019-02-07 13:51:16', '2019-02-10'),
(280, '111', '111', '111', '111', '111', '2019-02-05 15:00:22', '2019-02-10'),
(279, '111', '111', '111', '111', '111', '2019-02-05 14:59:24', '2019-02-10'),
(278, '111', '111', '111', '111', '111', '2019-02-05 14:59:24', '2019-02-10'),
(294, '2', '12', '231231231', '23123', '231231231', '2019-02-07 13:51:42', '2019-02-10'),
(286, '4.', '123', '123', '123', '123213123', '2019-02-07 09:47:40', '2019-02-15'),
(267, '5', '5', 'y', 'Asufall', NULL, '2019-01-31 12:34:26', '2019-03-09');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
