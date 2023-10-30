-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Okt 2023 um 14:23
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `shopseite`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorien`
--

CREATE TABLE `kategorien` (
  `id` int(11) NOT NULL,
  `kategorie` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `kategorien`
--

INSERT INTO `kategorien` (`id`, `kategorie`) VALUES
(1, 'Handys'),
(2, 'ZTE'),
(3, 'Sale'),
(4, 'Apple'),
(5, 'Samsung'),
(6, 'Huawei'),
(7, 'Laptops'),
(8, 'Acer'),
(9, 'Monitore'),
(10, 'Sonstiges');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mapping`
--

CREATE TABLE `mapping` (
  `id` int(11) NOT NULL,
  `kategorieid` int(11) NOT NULL,
  `produktid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `mapping`
--

INSERT INTO `mapping` (`id`, `kategorieid`, `produktid`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 1, 2),
(5, 4, 2),
(6, 1, 3),
(7, 5, 3),
(8, 6, 4),
(9, 1, 4),
(10, 1, 5),
(11, 1, 6),
(12, 7, 7),
(13, 8, 7),
(14, 7, 8),
(15, 3, 8),
(16, 7, 9),
(17, 7, 10),
(18, 3, 10),
(19, 7, 11),
(20, 7, 12),
(21, 9, 13),
(22, 3, 13),
(23, 9, 14),
(24, 5, 14),
(25, 9, 15),
(26, 5, 15),
(27, 9, 16),
(28, 9, 17),
(29, 9, 18),
(30, 8, 18),
(31, 1, 19),
(32, 5, 19),
(33, 2, 19),
(34, 9, 20),
(35, 5, 20),
(36, 8, 20),
(37, 10, 20),
(38, 7, 21),
(39, 9, 21),
(40, 10, 21),
(41, 10, 22),
(42, 7, 22),
(43, 10, 23),
(44, 10, 24);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produkte`
--

CREATE TABLE `produkte` (
  `id` int(11) NOT NULL,
  `produkt` varchar(128) NOT NULL,
  `preis` varchar(64) NOT NULL,
  `lager` int(11) NOT NULL,
  `lieferzeit` int(11) NOT NULL,
  `dateiname` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `produkte`
--

INSERT INTO `produkte` (`id`, `produkt`, `preis`, `lager`, `lieferzeit`, `dateiname`) VALUES
(1, 'ZTE Blade 10 Smart', '198.99', 7, 7, 'zte_blade_10.png'),
(2, 'Apple iPhone 11 Pro Max', '1566.99', 3, 14, 'apple_iphone_11.png'),
(3, 'Samsung A10', '131.99', 0, 7, 'samsung_a10.png'),
(4, 'Huawei P Smart', '147.99', 20, 7, 'huawei_p_smart.png'),
(5, 'Xiamoi Redmi Note 8 Pro', '239.99', 35, 7, 'xiamoi_redmi_note_8.png'),
(6, 'Ulefone Note 7', '131.99', 10, 7, 'ulefone_note_7.png'),
(7, 'Acer Aspire 3', '399.99', 2, 7, 'acer_aspire_3.png'),
(8, 'Miscrosoft Surface Laptop 3', '1119.99', 9, 7, 'miscrosoft_surface_laptop_3.png'),
(9, 'Lenovo Gaming Notebook', '499.99', 15, 14, 'lenovo_gaming_notebook.png'),
(10, 'ASUS Gaming Notebook', '519.99', 40, 14, 'asus_gaming_notebook.png'),
(11, 'Jumper Ezbook X3', '239.99', 1, 14, 'jumper_ezbook_x3.png'),
(12, 'CHUWI Lapbook Pro', '379.99', 29, 14, 'chuwi_lapbook_pro.png'),
(13, 'Dell 24 Zoll Monitor Full HD', '149.99', 10, 7, 'dell_zoll_monitor_full_24.png'),
(14, 'Samsung 28 Zoll Monitor 4k', '247.9', 25, 14, 'samsung_zoll_monitor_4.png'),
(15, 'Samsung 49 Zoll Curved Gaming Full HD', '809.99', 3, 14, 'samsung_zoll_curved_gaming_full_49.png'),
(16, 'BenQ 32 Zoll Curved Gaming 144Hz', '406.11', 0, 14, 'benq_zoll_curved_gaming_144.png'),
(17, 'AOC 24 Zoll Full HD', '114.4', 19, 14, 'aoc_24_zoll.png'),
(18, 'Acer KG1 24 Zoll Full HD', '129.99', 12, 14, 'acer_kg_zoll_full_hd.png'),
(19, 'Aufziehbares Ladekabel 0,6m', '9.79', 100, 14, 'aufziehbares_ladekabel_m_6m.png'),
(20, 'BONTEC Monitorhalterung fuer Tische', '48.99', 17, 7, 'bontec_monitorhalterung_fuer_tische.png'),
(21, 'Logitech G512 Mechanische Tastatur', '99', 5, 7, 'logitech_g_mechanische_tastatur.png'),
(22, 'Razer Kraken X USB Gaming Headset', '82.9', 1, 7, 'razer_kraken_x_usb_gaming_Gaming.png'),
(23, 'Willful Bluetooth Kopfhoerer In Ear', '22.94', 13, 14, 'willful_bluetooth_kopfhoerer_in_In.png'),
(24, 'Sharkoon Shark Force Pro Gaming Maus', '14.9', 22, 7, 'sharkoon_shark_force_pro_gaming_Gaming.png');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `kategorien`
--
ALTER TABLE `kategorien`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `mapping`
--
ALTER TABLE `mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `produkte`
--
ALTER TABLE `produkte`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `kategorien`
--
ALTER TABLE `kategorien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `mapping`
--
ALTER TABLE `mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT für Tabelle `produkte`
--
ALTER TABLE `produkte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
