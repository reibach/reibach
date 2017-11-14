
14.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `offer`
--

CREATE TABLE IF NOT EXISTS `offer` (
`id` int(10) NOT NULL,
  `mandator_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `description` text,
  `status` double DEFAULT NULL,
  `offer_number` varchar(150) DEFAULT NULL,
  `offer_date` date NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `offer_position`
--

CREATE TABLE IF NOT EXISTS `offer_position` (
`id` int(10) NOT NULL,
  `order_id` int(4) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pos_num` varchar(2) CHARACTER SET latin1 DEFAULT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `unit` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `comment` text CHARACTER SET latin1,
  `price` decimal(10,2) NOT NULL,
  `taxrate` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `offer`
--
ALTER TABLE `offer`
 ADD PRIMARY KEY (`id`), ADD KEY `customer_id` (`customer_id`), ADD KEY `mandator_id` (`mandator_id`);

--
-- Indizes für die Tabelle `offer_position`
--
ALTER TABLE `offer_position`
 ADD PRIMARY KEY (`id`), ADD KEY `bill_id` (`order_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `offer`
--
ALTER TABLE `offer`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `offer_position`
--
ALTER TABLE `offer_position`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `offer`
--
ALTER TABLE `offer`
ADD CONSTRAINT `offer_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
ADD CONSTRAINT `offer_ibfk_2` FOREIGN KEY (`mandator_id`) REFERENCES `mandator` (`id`);

--
-- Constraints der Tabelle `offer_position`
--
ALTER TABLE `offer_position`
ADD CONSTRAINT `offer_position_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `offer` (`id`);

