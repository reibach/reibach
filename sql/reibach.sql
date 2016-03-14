-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: reibach
-- ------------------------------------------------------
-- Server version	5.5.44-0+deb8u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `comment` text,
  `price` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,'Stundensatz','EURO','',42);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bill` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(4) NOT NULL,
  `mandator_id` int(4) NOT NULL,
  `description` text,
  `price` double DEFAULT NULL,
  `pay_id` int(1) DEFAULT NULL,
  `billdate` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_customer` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bill`
--

LOCK TABLES `bill` WRITE;
/*!40000 ALTER TABLE `bill` DISABLE KEYS */;
INSERT INTO `bill` VALUES (1,1,1,'',0,NULL,'2016-03-08'),(2,1,1,'',0,NULL,'2016-03-10');
/*!40000 ALTER TABLE `bill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  `comment` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'Michael Ellmers','Herr','Michael','Ellmers','Mittelmoorstrasse ','55','28879','Grasberg','michaelellmers@gmx.de','04208 895 220','','0163 692 5151','');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mandator`
--

DROP TABLE IF EXISTS `mandator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mandator` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  `vat` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mandator`
--

LOCK TABLES `mandator` WRITE;
/*!40000 ALTER TABLE `mandator` DISABLE KEYS */;
INSERT INTO `mandator` VALUES (1,'Hausmeisterservice','','Herr','Udo','Mittler','Diedrich-Speckmann-Straße','12','28865','Lilienthal','E-Mail: udo@federa.de','','Tel: +49(0)4298 30690','','Mob: +49(0)172 8887028','Bank: KSK OHZ','IBAN: DE02 2915 2300 1401 0809 71','BIC: BRLADE21OHZ','ASASAS','1401080971fdfdf','Finanzamt ','Osterholz-Scharmbeck','Steuer-Nr.: 36/130/14426','ASASAS','','not');
/*!40000 ALTER TABLE `mandator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `position`
--

DROP TABLE IF EXISTS `position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `position` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `bill_id` int(4) NOT NULL,
  `pos_num` varchar(2) DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text,
  `price` double DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `amount` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_bill` (`bill_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `position`
--

LOCK TABLES `position` WRITE;
/*!40000 ALTER TABLE `position` DISABLE KEYS */;
INSERT INTO `position` VALUES (1,1,'1',24,'Std','Handwerkliche Unterstützung an Wohngebäude und Grundstück','HHandwerkliche Unterstützung an Wohngebäude und Grundstück',30,136.8,720),(7,2,'1',1,'St.','Dachdurchführung für Edelstahl-Schornstein mit Bleirand für Ziegeldach ','',105,19.95,105);
/*!40000 ALTER TABLE `position` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-14 15:41:57
