-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Gegenereerd op: 21 mei 2025 om 20:12
-- Serverversie: 5.7.44
-- PHP-versie: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id` int(11) NOT NULL,
  `naam` text NOT NULL,
  `wachtwoord` text NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `naam`, `wachtwoord`, `is_admin`) VALUES
(1, 'super-admin', 'wachtwoord', 1),
(2, 'andy', 'bananasplit', 0),
(4, 'admin', 'geheim', 1),
(6, 'jan', 'soep', 0),
(7, 'wad', '$2y$10$SGzCFbztG8DgULiqhCn6veaA4LmcGaLoAcxX5ExvPO5dhMm/QERB.', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gerechten`
--

CREATE TABLE `gerechten` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `prijs` decimal(5,2) NOT NULL,
  `gerechtsoort_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gerechten`
--

INSERT INTO `gerechten` (`id`, `naam`, `prijs`, `gerechtsoort_id`) VALUES
(1, 'Banh Mi Grilled Beef', 9.00, 1),
(2, 'Banh Mi Grilled Pork', 9.00, 1),
(3, 'Banh Mi Special', 9.50, 1),
(4, 'Banh Mi Grilled Shrimp', 9.50, 1),
(5, 'Banh Mi Tofuuu', 33.00, 1),
(7, 'Bun Grilled Beef', 13.00, 2),
(8, 'Bun Grilled Pork', 13.00, 2),
(9, 'Bun Mix Special', 15.00, 2),
(10, 'Bun Grilled Shrimp', 14.00, 2),
(11, 'Bun Tofuuu', 13.00, 2),
(12, 'Rijst Grilled Beef', 12.00, 3),
(13, 'Rijst Grilled Pork', 12.00, 3),
(14, 'Rijst Mix Special', 15.00, 3),
(15, 'Rijst Grilled Shrimp', 14.00, 3),
(16, 'Rijst Tofuuu', 12.00, 3),
(17, 'Pho Vegan', 13.00, 4),
(18, 'Pho Chicken', 14.00, 4),
(19, 'Pho Beef ', 16.00, 4),
(20, 'Bun Bo Hue', 16.00, 4);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gerechtsoorten`
--

CREATE TABLE `gerechtsoorten` (
  `id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gerechtsoorten`
--

INSERT INTO `gerechtsoorten` (`id`, `naam`) VALUES
(1, 'brood-gerechten'),
(2, 'noodle-gerechten'),
(3, 'rijst-gerechten'),
(4, 'soep-gerechten');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gerechten`
--
ALTER TABLE `gerechten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gerechtsoort_id` (`gerechtsoort_id`);

--
-- Indexen voor tabel `gerechtsoorten`
--
ALTER TABLE `gerechtsoorten`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `gerechten`
--
ALTER TABLE `gerechten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT voor een tabel `gerechtsoorten`
--
ALTER TABLE `gerechtsoorten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `gerechten`
--
ALTER TABLE `gerechten`
  ADD CONSTRAINT `gerechten_ibfk_1` FOREIGN KEY (`gerechtsoort_id`) REFERENCES `gerechtsoorten` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
