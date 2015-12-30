-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 30. Dez 2015 um 13:58
-- Server Version: 5.5.44-0+deb8u1
-- PHP-Version: 5.6.13-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `reibach`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `article`
--

CREATE TABLE IF NOT EXISTS `article` (
`id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `comment` text,
  `price` double DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `article`
--

INSERT INTO `article` (`id`, `name`, `unit`, `comment`, `price`) VALUES
(2, 'Stundensatz ', '?', '', 25);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bill`
--

CREATE TABLE IF NOT EXISTS `bill` (
`id` int(10) NOT NULL,
  `customer_id` int(4) NOT NULL,
  `mandator_id` int(4) NOT NULL,
  `description` text,
  `price` double DEFAULT NULL,
  `pay_id` int(1) DEFAULT NULL,
  `billdate` date DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `bill`
--

INSERT INTO `bill` (`id`, `customer_id`, `mandator_id`, `description`, `price`, `pay_id`, `billdate`) VALUES
(82, 13, 1, 'sasas', 0, NULL, '2015-12-30'),
(81, 13, 1, '', 0, NULL, '2015-12-09');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
`id` int(10) NOT NULL,
  `company` varchar(150) NOT NULL,
  `title` varchar(50) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `street` varchar(150) NOT NULL,
  `housenumber` varchar(6) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  `place` varchar(255) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `tel` varchar(27) DEFAULT NULL,
  `fax` varchar(27) DEFAULT NULL,
  `mobil` varchar(27) DEFAULT NULL,
  `comment` text
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `customer`
--

INSERT INTO `customer` (`id`, `company`, `title`, `firstname`, `lastname`, `street`, `housenumber`, `zipcode`, `place`, `email`, `tel`, `fax`, `mobil`, `comment`) VALUES
(13, 'test', 'testAnrede', 'Vorna', 'Nachn', 'Buxhorner Weg ', '15', '27729', 'Holste', 'guenter@federa.de', '0175 ', '123456', '0175 2717291', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mandator`
--

CREATE TABLE IF NOT EXISTS `mandator` (
`id` int(10) NOT NULL,
  `company` varchar(150) NOT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `street` varchar(150) NOT NULL,
  `housenumber` varchar(6) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  `place` varchar(255) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `tel` varchar(27) DEFAULT NULL,
  `fax` varchar(27) DEFAULT NULL,
  `mobil` varchar(27) DEFAULT NULL,
  `bankname` varchar(27) DEFAULT NULL,
  `bankaccount` varchar(50) DEFAULT NULL,
  `bankcodenumber` varchar(27) DEFAULT NULL,
  `iban` varchar(50) DEFAULT NULL,
  `bic` varchar(27) DEFAULT NULL,
  `taxoffice` varchar(27) DEFAULT NULL,
  `vatnumber` varchar(27) DEFAULT NULL,
  `taxnumber` varchar(27) DEFAULT NULL,
  `comment` text,
  `country` varchar(50) NOT NULL,
  `vat` varchar(1) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `mandator`
--

INSERT INTO `mandator` (`id`, `company`, `slogan`, `title`, `firstname`, `lastname`, `street`, `housenumber`, `zipcode`, `place`, `email`, `website`, `tel`, `fax`, `mobil`, `bankname`, `bankaccount`, `bankcodenumber`, `iban`, `bic`, `taxoffice`, `vatnumber`, `taxnumber`, `comment`, `country`, `vat`) VALUES
(1, 'UM', '', 'Herr', 'Udo', 'Mittler', 'Diedrich-Speckmann-Straße', '12', '28865', 'Lilienthal', 'E-Mail: udo@federa.de', '', 'Tel: +49(0)4298 30690', '', 'Mob: +49(0)172 8887028', 'Bank: KSK OHZ', 'IBAN: DE89291523001401080666', 'BIC: BRLADE21OHZ', 'ASASAS', 'DE9899898989', 'Finanzamt ', 'Osterholz-Scharmbeck', 'Steuer-Nr.: 36/130/11311', 'ASASAS', '', '0');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `position`
--

CREATE TABLE IF NOT EXISTS `position` (
`id` int(10) NOT NULL,
  `bill_id` int(4) NOT NULL,
  `pos_num` varchar(2) DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text,
  `price` double DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `amount` double DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `position`
--

INSERT INTO `position` (`id`, `bill_id`, `pos_num`, `quantity`, `unit`, `name`, `comment`, `price`, `tax`, `amount`) VALUES
(92, 81, '1', 4, 'H', 'Stunden ', '', 20.53, 13.11, 82.12),
(93, 82, '1', 1221, 'sds', 'asass', '', 2323, 452867.87, 2836383);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `project`
--

CREATE TABLE IF NOT EXISTS `project` (
`id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` double DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `task`
--

CREATE TABLE IF NOT EXISTS `task` (
`id` int(10) NOT NULL,
  `project_id` int(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text,
  `effort` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `version`
--

CREATE TABLE IF NOT EXISTS `version` (
`id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `version` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `version`
--

INSERT INTO `version` (`id`, `name`, `version`) VALUES
(1, 'db', 38);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `article`
--
ALTER TABLE `article`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `bill`
--
ALTER TABLE `bill`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `fk_customer` (`customer_id`);

--
-- Indizes für die Tabelle `customer`
--
ALTER TABLE `customer`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `mandator`
--
ALTER TABLE `mandator`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `position`
--
ALTER TABLE `position`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `fk_bill` (`bill_id`);

--
-- Indizes für die Tabelle `project`
--
ALTER TABLE `project`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `task`
--
ALTER TABLE `task`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `fk_project` (`project_id`);

--
-- Indizes für die Tabelle `version`
--
ALTER TABLE `version`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `article`
--
ALTER TABLE `article`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `bill`
--
ALTER TABLE `bill`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT für Tabelle `customer`
--
ALTER TABLE `customer`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT für Tabelle `mandator`
--
ALTER TABLE `mandator`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `position`
--
ALTER TABLE `position`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT für Tabelle `project`
--
ALTER TABLE `project`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `task`
--
ALTER TABLE `task`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `version`
--
ALTER TABLE `version`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
