-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 03. Nov 2017 um 11:02
-- Server Version: 5.5.57-0+deb8u1-log
-- PHP-Version: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `rb4`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `address`
--

CREATE TABLE IF NOT EXISTS `address` (
`id` int(10) NOT NULL,
  `address_type` enum('MANDATOR','SUPPLIER','CUSTOMER','DELIVERY','BILLING') COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prename` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `housenumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone_privat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone_business` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone_mobile` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `internet` varchar(27) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bank_name` varchar(27) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bank_codenumber` varchar(27) COLLATE utf8_unicode_ci NOT NULL,
  `iban` varchar(27) COLLATE utf8_unicode_ci NOT NULL,
  `bic` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `tax_office` varchar(27) COLLATE utf8_unicode_ci NOT NULL,
  `tax_number` varchar(27) COLLATE utf8_unicode_ci NOT NULL,
  `vat_number` varchar(27) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_user_id` int(11) NOT NULL,
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `article`
--

CREATE TABLE IF NOT EXISTS `article` (
`id` int(10) NOT NULL,
  `mandator_id` int(4) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `unit` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `comment` text CHARACTER SET latin1,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bill`
--

CREATE TABLE IF NOT EXISTS `bill` (
`id` int(10) NOT NULL,
  `mandator_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `description` text,
  `status` double DEFAULT NULL,
  `billing_number` varchar(150) DEFAULT NULL,
  `billing_date` date NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
`id` int(10) NOT NULL,
  `mandator_id` int(10) NOT NULL,
  `address_id` int(10) NOT NULL,
  `customer_number` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `customer_address`
--

CREATE TABLE IF NOT EXISTS `customer_address` (
`id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `address_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mandator`
--

CREATE TABLE IF NOT EXISTS `mandator` (
`id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `address_id` int(10) NOT NULL,
  `taxable` int(1) NOT NULL DEFAULT '0',
  `b_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'own bill id yes/no',
  `c_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'own customer id yes/no',
  `signature` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `position`
--

CREATE TABLE IF NOT EXISTS `position` (
`id` int(10) NOT NULL,
  `bill_id` int(4) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pos_num` varchar(2) CHARACTER SET latin1 DEFAULT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `unit` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `comment` text CHARACTER SET latin1,
  `price` decimal(10,2) NOT NULL,
  `taxrate` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `agb` tinyint(1) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `abo_start` int(11) NOT NULL,
  `abo_end` int(11) NOT NULL,
  `abo_turn` int(11) NOT NULL,
  `abo_type` set('FREE','STANDARD','PREMIUM') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `address`
--
ALTER TABLE `address`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `article`
--
ALTER TABLE `article`
 ADD PRIMARY KEY (`id`), ADD KEY `mandator_id` (`mandator_id`);

--
-- Indizes für die Tabelle `bill`
--
ALTER TABLE `bill`
 ADD PRIMARY KEY (`id`), ADD KEY `customer_id` (`customer_id`), ADD KEY `mandator_id` (`mandator_id`);

--
-- Indizes für die Tabelle `customer`
--
ALTER TABLE `customer`
 ADD PRIMARY KEY (`id`), ADD KEY `mandator_id` (`mandator_id`), ADD KEY `address_id` (`address_id`);

--
-- Indizes für die Tabelle `customer_address`
--
ALTER TABLE `customer_address`
 ADD PRIMARY KEY (`id`), ADD KEY `customer_id` (`customer_id`), ADD KEY `address_id` (`address_id`);

--
-- Indizes für die Tabelle `mandator`
--
ALTER TABLE `mandator`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `address_id` (`address_id`);

--
-- Indizes für die Tabelle `migration`
--
ALTER TABLE `migration`
 ADD PRIMARY KEY (`version`);

--
-- Indizes für die Tabelle `position`
--
ALTER TABLE `position`
 ADD PRIMARY KEY (`id`), ADD KEY `bill_id` (`bill_id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `address`
--
ALTER TABLE `address`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT für Tabelle `article`
--
ALTER TABLE `article`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `bill`
--
ALTER TABLE `bill`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT für Tabelle `customer`
--
ALTER TABLE `customer`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT für Tabelle `customer_address`
--
ALTER TABLE `customer_address`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `mandator`
--
ALTER TABLE `mandator`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT für Tabelle `position`
--
ALTER TABLE `position`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `article`
--
ALTER TABLE `article`
ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`mandator_id`) REFERENCES `mandator` (`id`);

--
-- Constraints der Tabelle `bill`
--
ALTER TABLE `bill`
ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`mandator_id`) REFERENCES `mandator` (`id`);

--
-- Constraints der Tabelle `customer`
--
ALTER TABLE `customer`
ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`mandator_id`) REFERENCES `mandator` (`id`),
ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`);

--
-- Constraints der Tabelle `customer_address`
--
ALTER TABLE `customer_address`
ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
ADD CONSTRAINT `customer_address_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`);

--
-- Constraints der Tabelle `mandator`
--
ALTER TABLE `mandator`
ADD CONSTRAINT `mandator_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
ADD CONSTRAINT `mandator_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`);

--
-- Constraints der Tabelle `position`
--
ALTER TABLE `position`
ADD CONSTRAINT `position_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
