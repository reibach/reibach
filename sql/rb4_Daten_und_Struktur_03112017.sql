-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 03. Nov 2017 um 11:04
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

--
-- Daten für Tabelle `address`
--

INSERT INTO `address` (`id`, `address_type`, `title`, `company`, `prename`, `lastname`, `zipcode`, `place`, `street`, `housenumber`, `state`, `phone_privat`, `phone_business`, `phone_mobile`, `email`, `internet`, `fax`, `bank_name`, `bank_account`, `bank_codenumber`, `iban`, `bic`, `tax_office`, `tax_number`, `vat_number`, `create_time`, `create_user_id`, `update_time`, `update_user_id`) VALUES
(48, 'MANDATOR', 'Herr ', 'federa', 'Günter', 'Mittler', '27729', 'Holste', 'Buxhorner Weg', '15', 'Niedersachsen', '04748 442437', '00456789', '0175 2717291', 'guenter@federa.de', '', '04748 442439', 'Kreissparkasse OHZ', '', '', 'DE89 2915 2300 1401 0806 66', 'BRLADE21OHZ', 'OHZ', '36/130/11311', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(49, 'MANDATOR', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(50, 'CUSTOMER', '', '', 'test', 'kunde', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(51, 'CUSTOMER', '', '', 'aaa', 'dante', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(52, 'CUSTOMER', '', '', 'nnnoooo', 'ooooonnnee\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(53, 'CUSTOMER', '', '', 'ttt', 'www', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(54, 'CUSTOMER', 'Herr', '--', 'Vladimr ', 'Zewaljew', '123415', 'Stadtda', 'STrasse', '23 b', 'Niedersachsen', '00123456', '00456789', '009966332525', 'derpuls@gmx.de', '', '123456', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(55, 'CUSTOMER', '', '', 'Carl', 'Bone', '27729', 'Vollersode', 'Rübekamp', '12', '', '', '', '', 'testme@federa.de', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(56, 'CUSTOMER', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(57, 'CUSTOMER', '', '', 'Lena', 'Valaitis', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(58, 'MANDATOR', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(59, 'MANDATOR', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(60, 'MANDATOR', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(61, 'MANDATOR', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(62, 'MANDATOR', '', ' Mandant:23', ' Mandant:23', ' Mandant:23', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(63, 'MANDATOR', '', 'TEST 2', 'vvvv', 'nnnn', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(64, 'MANDATOR', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(65, 'MANDATOR', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(66, 'MANDATOR', 'Herr', 'HausmeisterService', 'Udo', 'Mittler', '28750', 'Lilienthal', 'Dietrich-Speckmann-Str.', '12', 'Niedersachsen', '04298 30690', '0987456', '0123456', 'reibach@federa.de', '', '0369258147', 'Kreissparkasse Osterholz', '24', '342', 'DE02 2915 2300 1401 0809 71', 'BRLADE21OHZ', 'Osterholz-Scharmbeck', '36/130/15538', '0', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(67, 'CUSTOMER', '', '', 'Guenter', 'Mittler', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(68, 'CUSTOMER', 'Herr', 'federa', 'Guenter', 'Mittler', '27729', 'Holste', 'Buxhorner Weg', '15', 'Niedersachsen', '04748 442437', '04748 442437', '0175 2717291', 'guenter@federa.de', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(69, 'MANDATOR', '', 'qqqqqqqqqqqq', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(70, 'CUSTOMER', '', '', 'Costa', 'Cordalis', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(71, 'CUSTOMER', '', '', 'Harald', 'Schmidt', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(72, 'CUSTOMER', '', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'fdgfdg', 'dfgfdg', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(73, 'CUSTOMER', '', '', 'aaaaaaaaaaaaaaaaaaaaaa', 'bbbbbbbbbbbbbbbbbbbb', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(74, 'CUSTOMER', '', '', 'aaa', 'vvv', '87874', 'Ort', 'Streeeeee', '21', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

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

--
-- Daten für Tabelle `bill`
--

INSERT INTO `bill` (`id`, `mandator_id`, `customer_id`, `description`, `status`, `billing_number`, `billing_date`, `created_at`, `updated_at`) VALUES
(89, 18, 25, '<h3>ddsfdsf</h3>\r\n\r\n<p>sdfdsfdsfdsfsdffsd sdf <b>dsf sdfdsf</b> dfgfdg dffd</p>', NULL, NULL, '2017-12-03', '2014-06-12', '2008-11-06'),
(90, 18, 24, NULL, 0, NULL, '2017-12-06', '0002-12-02', '2016-12-02'),
(98, 18, 24, NULL, NULL, NULL, '2017-12-02', '0000-00-00', '0000-00-00'),
(99, 18, 24, NULL, NULL, NULL, '2017-04-13', '0000-00-00', '0000-00-00'),
(100, 25, 27, NULL, NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00'),
(101, 18, 29, NULL, NULL, NULL, '2017-06-03', '0000-00-00', '0000-00-00');

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

--
-- Daten für Tabelle `customer`
--

INSERT INTO `customer` (`id`, `mandator_id`, `address_id`, `customer_number`) VALUES
(23, 19, 52, '0'),
(24, 18, 54, '0'),
(25, 18, 55, '78'),
(26, 18, 57, '45'),
(27, 25, 68, ''),
(28, 18, 70, ''),
(29, 18, 71, NULL),
(32, 18, 74, 'o0o0o0o0');

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

--
-- Daten für Tabelle `mandator`
--

INSERT INTO `mandator` (`id`, `user_id`, `address_id`, `taxable`, `b_id`, `c_id`, `signature`) VALUES
(18, 30, 48, 0, 0, 0, '\r\ntestmandant\r\ntel 123456 \r\nemail@federa.de'),
(19, 31, 49, 0, 0, 0, ''),
(23, 45, 62, 0, 0, 0, ''),
(24, 30, 63, 0, 0, 0, ''),
(25, 49, 66, 0, 0, 0, ''),
(26, 49, 69, 0, 0, 0, '');

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

--
-- Daten für Tabelle `position`
--

INSERT INTO `position` (`id`, `bill_id`, `name`, `pos_num`, `quantity`, `unit`, `comment`, `price`, `taxrate`) VALUES
(10, 89, 'zuuzu dsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdj', '1', 13.00, 'St. ', 'dsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdj', 3.55, 0.00),
(11, 90, 'PPPPPPPPPPPPPPPPPPP', '12', 5.00, 'df', 'fdgdg', 2.00, 0.00),
(12, 89, 'werr dsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdj', '2', 13.00, 'Std. ', 'dsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdj', 22.00, 0.00),
(14, 89, 'bcbc dsgä df tr mhg kldfh ktlf zthfdj', '3', 2.00, 'STD', 'dsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdj', 5.00, 0.00),
(16, 90, 'CCCCCCCCCCCCCCCCCCCCC', '78', 8.00, '', '', 3.00, 0.00),
(18, 99, 'sadsa', '', 12.00, '', '', 23.00, 0.00),
(19, 98, 'aaaa', '1', 1.00, 'st', 'huhuhuhuh', 12.00, 0.00),
(20, 100, 'Carport bauen Dieses Element repräsentiert eine Tabelle, in der Daten, in einer oder mehreren, voneinander getrennten Spalten und Zeilen, dargestellt werden kann. ', '1', 15.00, 'Std.', '', 30.00, 0.00),
(21, 100, 'Material Dieses Element repräsentiert eine Tabelle, in der Daten, in einer oder mehreren, voneinander getrennten Spalten und Zeilen, dargestellt werden kann. ', '2', 1.00, 'St.', '', 45.00, 0.00),
(22, 101, 'TesPosition', '', 3.00, '', '', 5.00, 0.00);

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
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `agb`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `abo_start`, `abo_end`, `abo_turn`, `abo_type`) VALUES
(30, 0, 'gm', 'VgK8FTX09bx5eQtEgbF9jXIylSsocHEX', '$2y$13$ygHCI6Rn19e1Q3hvVIMDAuBJ4tWWq9ZR2288z3xlfAUUR8C.ew5L6', NULL, 'guenter@federa.de', 10, '0000-00-00', '0000-00-00', 0, 0, 0, ''),
(31, 0, 'testme123', '52PLmpKftKym95PeRwtQAYZ8KINKAmXc', '$2y$13$faoiIvGHkADap1sKfP7RMu2n1RL82GVi6O.42nQ1.sskZNsR1aP5q', '', 'guenter123@federa.de', 10, '2016-00-00', '2017-00-00', 0, 0, 0, 'STANDARD'),
(45, 1, 'testme', '39TM8rK9HV6Rf-V_rPCS-G7wqRcUs_WR', '$2y$13$JEYTLxXmkA0IfSRSCvZg1u3AD3IsExrhZKvAylWb7xe9fuz1s5h76', 'INEydNj6B3Hs-kTlZ0NMknQy7FJsGC3E_1488968836', 'resale@netz-ohz.de', 10, '0000-00-00', '0000-00-00', 0, 0, 0, ''),
(48, 1, 'Hilmar Bender', 'N3-33EPFwtLgYqOFbZ0sawIjUV7KGXOI', '$2y$13$T8.8vqhDEQpildptSrkz3uyNgUhS8iWkR7ZF5bPZ9eQNO8ZzBsKQ.', NULL, 'hilm@me.com', 10, '0000-00-00', '0000-00-00', 0, 0, 0, 'FREE'),
(49, 1, 'udo', 'Mne59N7Ce8Uz8i4z-XwgLe-WimLw4twt', '$2y$13$ygHCI6Rn19e1Q3hvVIMDAuBJ4tWWq9ZR2288z3xlfAUUR8C.ew5L6', NULL, 'reibach@federa.de', 10, '0000-00-00', '0000-00-00', 0, 0, 0, '');

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
