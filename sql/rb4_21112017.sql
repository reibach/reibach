-- MySQL dump 10.13  Distrib 5.5.58, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: rb4
-- ------------------------------------------------------
-- Server version	5.5.58-0+deb8u1-log

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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  `update_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (48,'MANDATOR','Herr','federa','Günter','Mittler','27729','Holste','Buxhorner Weg','15','Niedersachsen','04748 442437','00456789','0175 2717291','guenter@federa.de','','04748 442439','Kreissparkasse OHZ','','','DE89 2915 2300 1401 0806 66','BRLADE21OHZ','OHZ','36/130/11311','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(49,'MANDATOR','','','','','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(50,'CUSTOMER','','','test','kunde','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(51,'CUSTOMER','','','aaa','dante','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(52,'CUSTOMER','','','nnnoooo','ooooonnnee\r\n','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(53,'CUSTOMER','','','ttt','www','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(54,'CUSTOMER','Herr','--','Vladimr ','Zewaljew','123415','Stadtda','STrasse','23 b','Niedersachsen','00123456','00456789','009966332525','derpuls@gmx.de','','123456','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(55,'CUSTOMER','','','Carl','Bone','27729','Vollersode','Rübekamp','12','','','','','testme@federa.de','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(56,'CUSTOMER','','','','','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(57,'CUSTOMER','','','Lena','Valaitis','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(58,'MANDATOR','','','','','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(59,'MANDATOR','','','','','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(60,'MANDATOR','','','','','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(61,'MANDATOR','','','','','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(62,'MANDATOR','',' Mandant:23',' Mandant:23',' Mandant:23','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(63,'MANDATOR','','TEST 2','vvvv','nnnn','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(64,'MANDATOR','','','','','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(65,'MANDATOR','','','','','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(66,'MANDATOR','Herr','HausmeisterService','Udo','Mittler','28750','Lilienthal','Dietrich-Speckmann-Str.','12','Niedersachsen','04298 30690','0987456','0123456','reibach@federa.de','','0369258147','Kreissparkasse Osterholz','24','342','DE02 2915 2300 1401 0809 71','BRLADE21OHZ','Osterholz-Scharmbeck','36/130/15538','0','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(67,'CUSTOMER','','','Guenter','Mittler','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(68,'CUSTOMER','Herr','federa','Guenter','Mittler','27729','Holste','Buxhorner Weg','15','Niedersachsen','04748 442437','04748 442437','0175 2717291','guenter@federa.de','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(69,'MANDATOR','','qqqqqqqqqqqq','','','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(70,'CUSTOMER','','','Costa','Cordalis','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(71,'CUSTOMER','','aaaaaaaaaaaa','Harald','Schmidt','','','','','','','','','guenter.mittler@ewetel.net','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(72,'CUSTOMER','','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','fdgfdg','dfgfdg','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(73,'CUSTOMER','','','aaaaaaaaaaaaaaaaaaaaaa','bbbbbbbbbbbbbbbbbbbb','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(74,'CUSTOMER','','','aaa','vvv','87874','Ort','Streeeeee','21','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0),(75,'MANDATOR','','','','','','','','','','','','','','','','','','','','','','','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mandator_id` int(4) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `unit` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `comment` text CHARACTER SET latin1,
  `price` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mandator_id` (`mandator_id`),
  CONSTRAINT `article_ibfk_1` FOREIGN KEY (`mandator_id`) REFERENCES `mandator` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
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
  `mandator_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `description` text,
  `status` double DEFAULT NULL,
  `billing_number` varchar(150) DEFAULT NULL,
  `billing_date` date NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `mandator_id` (`mandator_id`),
  CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`mandator_id`) REFERENCES `mandator` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=411 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bill`
--

LOCK TABLES `bill` WRITE;
/*!40000 ALTER TABLE `bill` DISABLE KEYS */;
INSERT INTO `bill` VALUES (89,18,25,'<h3>ddsfdsf</h3>\r\n\r\n<p>sdfdsfdsfdsfsdffsd sdf <b>dsf sdfdsf</b> dfgfdg dffd</p>',NULL,NULL,'2017-12-03','2014-06-12','2008-11-06'),(90,18,24,NULL,0,NULL,'2017-12-06','0002-12-02','2016-12-02'),(98,18,24,NULL,NULL,NULL,'2017-12-02','0000-00-00','0000-00-00'),(99,18,24,NULL,NULL,NULL,'2017-04-13','0000-00-00','0000-00-00'),(100,25,27,NULL,NULL,NULL,'0000-00-00','0000-00-00','0000-00-00'),(101,18,29,NULL,NULL,NULL,'2017-06-03','0000-00-00','0000-00-00'),(249,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(250,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(251,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(252,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(253,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(254,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(255,18,24,NULL,NULL,NULL,'2017-11-02','0000-00-00','0000-00-00'),(256,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(257,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(258,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(259,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(260,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(261,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(262,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(263,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(264,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(265,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(266,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(267,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(268,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(269,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(270,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(271,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(272,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(273,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(274,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(275,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(276,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(277,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(278,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(279,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(280,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(281,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(282,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(283,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(284,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(285,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(286,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(287,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(288,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(289,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(290,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(291,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(292,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(293,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(294,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(295,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(296,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(297,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(298,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(299,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(300,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(301,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(302,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(303,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(304,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(305,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(306,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(307,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(308,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(309,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(310,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(311,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(312,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(313,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(314,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(315,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(316,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(317,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(318,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(319,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(320,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(321,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(322,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(323,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(324,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(325,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(326,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(327,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(328,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(329,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(330,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(331,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(332,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(333,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(334,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(335,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(336,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(337,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(338,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(339,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(340,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(341,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(342,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(343,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(344,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(345,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(346,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(347,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(348,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(349,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(350,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(351,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(352,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(353,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(354,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(355,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(356,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(357,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(358,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(359,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(360,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(361,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(362,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(363,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(364,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(365,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(366,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(367,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(368,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(369,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(370,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(371,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(372,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(373,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(374,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(375,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(376,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(377,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(378,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(379,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(380,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(381,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(382,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(383,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(384,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(385,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(386,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(387,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(388,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(389,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(390,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(391,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(392,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(393,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(394,18,24,NULL,NULL,NULL,'2017-11-01','0000-00-00','0000-00-00'),(395,18,24,NULL,NULL,NULL,'2017-11-01','0000-00-00','0000-00-00'),(396,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(397,18,26,NULL,NULL,NULL,'2017-11-02','0000-00-00','0000-00-00'),(398,18,26,NULL,NULL,NULL,'2017-11-02','0000-00-00','0000-00-00'),(399,18,26,NULL,NULL,NULL,'2017-11-02','0000-00-00','0000-00-00'),(400,18,26,NULL,NULL,NULL,'2017-11-02','0000-00-00','0000-00-00'),(401,18,26,NULL,NULL,NULL,'2017-11-02','0000-00-00','0000-00-00'),(402,18,26,NULL,NULL,NULL,'2017-11-02','0000-00-00','0000-00-00'),(403,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(404,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(405,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(406,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(407,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(408,18,24,NULL,NULL,NULL,'2017-11-02','0000-00-00','0000-00-00'),(409,18,24,NULL,NULL,NULL,'2017-11-02','0000-00-00','0000-00-00'),(410,18,24,NULL,NULL,NULL,'2017-11-02','0000-00-00','0000-00-00');
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
  `mandator_id` int(10) NOT NULL,
  `address_id` int(10) NOT NULL,
  `customer_number` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mandator_id` (`mandator_id`),
  KEY `address_id` (`address_id`),
  CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`mandator_id`) REFERENCES `mandator` (`id`),
  CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (23,19,52,'0'),(24,18,54,'0'),(25,18,55,'78'),(26,18,57,'45'),(27,25,68,''),(28,18,70,''),(29,18,71,NULL),(32,18,74,'o0o0o0o0');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_address`
--

DROP TABLE IF EXISTS `customer_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_address` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `address_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `address_id` (`address_id`),
  CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `customer_address_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_address`
--

LOCK TABLES `customer_address` WRITE;
/*!40000 ALTER TABLE `customer_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mandator`
--

DROP TABLE IF EXISTS `mandator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mandator` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mandator_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) NOT NULL,
  `address_id` int(10) NOT NULL,
  `taxable` int(1) NOT NULL DEFAULT '0',
  `b_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'own bill id yes/no',
  `c_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'own customer id yes/no',
  `signature` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `address_id` (`address_id`),
  CONSTRAINT `mandator_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `mandator_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mandator`
--

LOCK TABLES `mandator` WRITE;
/*!40000 ALTER TABLE `mandator` DISABLE KEYS */;
INSERT INTO `mandator` VALUES (18,'federa',30,48,0,0,0,'testmandant\r\ntel 123456 \r\nemail@federa.de\r\n'),(19,'',31,49,0,0,0,''),(23,'',45,62,0,0,0,''),(24,'',30,63,0,0,0,''),(25,'',49,66,0,0,0,''),(26,'',49,69,0,0,0,'');
/*!40000 ALTER TABLE `mandator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer`
--

DROP TABLE IF EXISTS `offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mandator_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `description` text,
  `status` double DEFAULT NULL,
  `offer_number` varchar(150) DEFAULT NULL,
  `offer_date` date NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `mandator_id` (`mandator_id`),
  CONSTRAINT `offer_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `offer_ibfk_2` FOREIGN KEY (`mandator_id`) REFERENCES `mandator` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer`
--

LOCK TABLES `offer` WRITE;
/*!40000 ALTER TABLE `offer` DISABLE KEYS */;
INSERT INTO `offer` VALUES (5,18,24,NULL,NULL,NULL,'2017-11-02','0000-00-00','0000-00-00'),(6,18,24,NULL,NULL,NULL,'2017-11-16','0000-00-00','0000-00-00'),(7,18,24,NULL,NULL,NULL,'2017-11-01','0000-00-00','0000-00-00'),(8,18,26,NULL,NULL,NULL,'2017-11-02','0000-00-00','0000-00-00');
/*!40000 ALTER TABLE `offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `part`
--

DROP TABLE IF EXISTS `part`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `part` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `offer_id` int(4) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `part_num` varchar(2) CHARACTER SET latin1 DEFAULT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `unit` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `comment` text CHARACTER SET latin1,
  `price` decimal(10,2) NOT NULL,
  `taxrate` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `offer_id` (`offer_id`),
  CONSTRAINT `part_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `part`
--

LOCK TABLES `part` WRITE;
/*!40000 ALTER TABLE `part` DISABLE KEYS */;
INSERT INTO `part` VALUES (1,5,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','0',1.00,'0','ghjhgjj',0.00,0.00),(2,6,'xcxv','1',12.00,'St.','asas',22.00,0.00),(3,7,'aaaaaaaaaaaaaa','1',12.00,'','',12.00,0.00),(4,5,'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb','1',2.00,'St.',' regre',23.00,0.00),(5,5,'gfh ft hfjh tz tz','3',12.00,'SSSSS','fdh',12.00,0.00),(6,7,'uhuhuh','2',2.00,'ST.','',23.00,0.00),(7,6,'iuiuiu','2',5.00,'Std','asasas',3.00,0.00),(8,6,'popopo','3',54.00,'ST.','okokok',8.00,0.00),(9,8,'test','1',2.00,'Std.','ijijij',12.00,0.00),(10,8,'tttt','2',3.00,'Std.','plplplp',33.00,0.00);
/*!40000 ALTER TABLE `part` ENABLE KEYS */;
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
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pos_num` varchar(2) CHARACTER SET latin1 DEFAULT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `unit` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `comment` text CHARACTER SET latin1,
  `price` decimal(10,2) NOT NULL,
  `taxrate` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bill_id` (`bill_id`),
  CONSTRAINT `position_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `position`
--

LOCK TABLES `position` WRITE;
/*!40000 ALTER TABLE `position` DISABLE KEYS */;
INSERT INTO `position` VALUES (10,89,'zuuzu dsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdj','1',13.00,'St. ','dsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdj',3.55,0.00),(11,90,'PPPPPPPPPPPPPPPPPPP','12',5.00,'df','fdgdg',2.00,0.00),(12,89,'werr dsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdj','2',13.00,'Std. ','dsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdj',22.00,0.00),(14,89,'bcbc dsgä df tr mhg kldfh ktlf zthfdj','3',2.00,'STD','dsgä df tr mhg kldfh ktlf zthfdjdsgä df tr mhg kldfh ktlf zthfdj',5.00,0.00),(16,90,'CCCCCCCCCCCCCCCCCCCCC','78',8.00,'','',3.00,0.00),(18,99,'sadsa','',12.00,'','',23.00,0.00),(19,98,'aaaa','1',1.00,'st','huhuhuhuh',12.00,0.00),(20,100,'Carport bauen Dieses Element repräsentiert eine Tabelle, in der Daten, in einer oder mehreren, voneinander getrennten Spalten und Zeilen, dargestellt werden kann. ','1',15.00,'Std.','',30.00,0.00),(21,100,'Material Dieses Element repräsentiert eine Tabelle, in der Daten, in einer oder mehreren, voneinander getrennten Spalten und Zeilen, dargestellt werden kann. ','2',1.00,'St.','',45.00,0.00),(22,101,'TesPosition','',3.00,'','',5.00,0.00),(57,403,'xcxv','1',12.00,'St.','asas',22.00,0.00),(58,403,'iuiuiu','2',5.00,'Std','asasas',3.00,0.00),(59,403,'popopo','3',54.00,'ST.','okokok',8.00,0.00),(60,404,'xcxv','1',12.00,'St.','asas',22.00,0.00),(61,404,'iuiuiu','2',5.00,'Std','asasas',3.00,0.00),(62,404,'popopo','3',54.00,'ST.','okokok',8.00,0.00),(63,405,'xcxv','1',12.00,'St.','asas',22.00,0.00),(64,405,'iuiuiu','2',5.00,'Std','asasas',3.00,0.00),(65,405,'popopo','3',54.00,'ST.','okokok',8.00,0.00),(66,406,'xcxv','1',12.00,'St.','asas',22.00,0.00),(67,406,'iuiuiu','2',5.00,'Std','asasas',3.00,0.00),(68,406,'popopo','3',54.00,'ST.','okokok',8.00,0.00),(69,407,'xcxv','1',12.00,'St.','asas',22.00,0.00),(70,407,'iuiuiu','2',5.00,'Std','asasas',3.00,0.00),(71,407,'popopo','3',54.00,'ST.','okokok',8.00,0.00),(72,408,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','0',1.00,'0','ghjhgjj',0.00,0.00),(73,408,'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb','1',2.00,'St.',' regre',23.00,0.00),(74,408,'gfh ft hfjh tz tz','3',444.00,'SSSSS','fdh',12.00,0.00),(75,409,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','0',1.00,'0','ghjhgjj',0.00,0.00),(76,409,'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb','1',2.00,'St.',' regre',23.00,0.00),(77,409,'gfh ft hfjh tz tz','3',444.00,'SSSSS','fdh',12.00,0.00),(78,410,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','0',1.00,'0','ghjhgjj',0.00,0.00),(79,410,'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb','1',2.00,'St.',' regre',23.00,0.00),(80,410,'gfh ft hfjh tz tz','3',12.00,'SSSSS','fdh',12.00,0.00);
/*!40000 ALTER TABLE `position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `abo_type` set('FREE','STANDARD','PREMIUM') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (30,0,'gm','VgK8FTX09bx5eQtEgbF9jXIylSsocHEX','$2y$13$ygHCI6Rn19e1Q3hvVIMDAuBJ4tWWq9ZR2288z3xlfAUUR8C.ew5L6',NULL,'guenter@federa.de',10,'0000-00-00','0000-00-00',0,0,0,''),(31,0,'testme123','52PLmpKftKym95PeRwtQAYZ8KINKAmXc','$2y$13$faoiIvGHkADap1sKfP7RMu2n1RL82GVi6O.42nQ1.sskZNsR1aP5q','','guenter123@federa.de',10,'2016-00-00','2017-00-00',0,0,0,'STANDARD'),(45,1,'testme','39TM8rK9HV6Rf-V_rPCS-G7wqRcUs_WR','$2y$13$JEYTLxXmkA0IfSRSCvZg1u3AD3IsExrhZKvAylWb7xe9fuz1s5h76','INEydNj6B3Hs-kTlZ0NMknQy7FJsGC3E_1488968836','resale@netz-ohz.de',10,'0000-00-00','0000-00-00',0,0,0,''),(48,1,'Hilmar Bender','N3-33EPFwtLgYqOFbZ0sawIjUV7KGXOI','$2y$13$T8.8vqhDEQpildptSrkz3uyNgUhS8iWkR7ZF5bPZ9eQNO8ZzBsKQ.',NULL,'hilm@me.com',10,'0000-00-00','0000-00-00',0,0,0,'FREE'),(49,1,'udo','Mne59N7Ce8Uz8i4z-XwgLe-WimLw4twt','$2y$13$ygHCI6Rn19e1Q3hvVIMDAuBJ4tWWq9ZR2288z3xlfAUUR8C.ew5L6',NULL,'reibach@federa.de',10,'0000-00-00','0000-00-00',0,0,0,''),(50,0,'Qiang','','',NULL,'',10,'0000-00-00','0000-00-00',0,0,0,'');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-21 15:21:47
