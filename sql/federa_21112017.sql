-- MySQL dump 10.13  Distrib 5.5.58, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: federa
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
-- Table structure for table `addressbook`
--

DROP TABLE IF EXISTS `addressbook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addressbook` (
  `MYID` bigint(21) NOT NULL AUTO_INCREMENT,
  `PRINT_NAME` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `PREFIX` varchar(30) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `FIRSTNAME` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `LASTNAME` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `TITLE` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `DEPARTMENT` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `ADDRESS` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `CITY` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `STATEPROV` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `POSTALCODE` varchar(20) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COUNTRY` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `POSITION` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `INITIALS` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `SALUTATION` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `PHONEHOME` varchar(40) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `PHONEOFFI` varchar(40) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `PHONEOTHE` varchar(40) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `PHONEWORK` varchar(40) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `MOBILE` varchar(40) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `PAGER` varchar(40) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `FAX` varchar(40) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `EMAIL` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `EMAIL2` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `URL` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `URL2` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `NOTE` mediumtext COLLATE latin1_german2_ci NOT NULL,
  `CHANGELOG` mediumtext COLLATE latin1_german2_ci NOT NULL,
  `ALTFIELD1` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `ALTFIELD2` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `CATEGORY` smallint(5) unsigned NOT NULL DEFAULT '1',
  `METHODOFPAY` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `MESSAGE` smallint(5) unsigned NOT NULL DEFAULT '1',
  `BIRTHDAY` date NOT NULL DEFAULT '0000-00-00',
  `BANKNAME` varchar(200) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `BANKACCOUNT` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `BANKNUMBER` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `BANKIBAN` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `BANKBIC` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `TAX_FREE` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `TAXNR` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `BUSINESS_TAXNR` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `USERNAME` blob NOT NULL,
  `PASSWORD` blob NOT NULL,
  `USERLANGUAGE` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `USER_ACTIVE` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `CREATEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `MODIFIEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `CREATED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`MYID`),
  KEY `LASTNAME` (`LASTNAME`(20)),
  KEY `FIRSTNAME` (`FIRSTNAME`(20)),
  KEY `COMPANY` (`COMPANY`(20))
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addressbook`
--

LOCK TABLES `addressbook` WRITE;
/*!40000 ALTER TABLE `addressbook` DISABLE KEYS */;
/*!40000 ALTER TABLE `addressbook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `POSITIONID` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `POS_NAME` varchar(100) COLLATE latin1_german2_ci NOT NULL,
  `POS_DESC` text COLLATE latin1_german2_ci NOT NULL,
  `POSGROUPID` smallint(5) unsigned NOT NULL,
  `POS_GROUP` varchar(150) COLLATE latin1_german2_ci NOT NULL,
  `POS_PRICE` decimal(21,2) NOT NULL DEFAULT '0.00',
  `POS_TAX` tinyint(3) unsigned NOT NULL,
  `POS_ACTIVE` tinyint(3) unsigned NOT NULL,
  `NOTE` text COLLATE latin1_german2_ci NOT NULL,
  `POS_INVENTORY` int(11) unsigned NOT NULL,
  `POS_INVENTORY_CURRENT` int(11) unsigned NOT NULL,
  `POS_INVENTORY_PURCHASING` int(11) unsigned NOT NULL,
  `CREATEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `MODIFIEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `CREATED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`POSITIONID`),
  KEY `POS_NAME` (`POS_NAME`(20)),
  KEY `POS_DESC` (`POS_DESC`(20))
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cashbook`
--

DROP TABLE IF EXISTS `cashbook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cashbook` (
  `CASHBOOKID` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `MYID` bigint(21) unsigned NOT NULL,
  `INVOICEID` bigint(21) unsigned NOT NULL,
  `PAYMENTID` bigint(21) NOT NULL,
  `DESCRIPTION` varchar(150) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `CASHBOOK_DATE` date NOT NULL DEFAULT '0000-00-00',
  `TAKINGS` decimal(21,2) NOT NULL DEFAULT '0.00',
  `EXPENDITURES` decimal(21,2) NOT NULL DEFAULT '0.00',
  `CASH_IN_HAND` decimal(21,2) NOT NULL DEFAULT '0.00',
  `CASH_IN_HAND_STARTING_WITH` decimal(21,2) NOT NULL DEFAULT '0.00',
  `CANCELED` tinyint(1) unsigned NOT NULL,
  `CREATEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `MODIFIEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `CREATED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`CASHBOOKID`),
  KEY `MYID` (`MYID`),
  KEY `INVOICEID` (`INVOICEID`),
  KEY `PAYMENTID` (`PAYMENTID`),
  KEY `DESCRIPTION` (`DESCRIPTION`(20))
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cashbook`
--

LOCK TABLES `cashbook` WRITE;
/*!40000 ALTER TABLE `cashbook` DISABLE KEYS */;
/*!40000 ALTER TABLE `cashbook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `CATEGORYID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `DESCRIPTION` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `CREATEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `MODIFIEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `CREATED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`CATEGORYID`),
  KEY `DESCRIPTION` (`DESCRIPTION`(20))
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Authority','admin','admin',1,2,'2008-06-01 09:37:27','2008-06-03 06:29:47'),(2,'Guest','admin','admin',1,2,'2008-06-03 06:29:57','2008-06-03 06:29:57'),(3,'Supplier','admin','admin',1,2,'2008-06-03 06:30:05','2008-06-03 06:30:05'),(4,'Privately','admin','admin',1,2,'2008-06-03 06:30:14','2008-06-03 06:30:14'),(5,'Travel service','admin','admin',1,2,'2008-06-03 06:30:22','2008-06-03 06:30:22'),(6,'No category','admin','admin',1,2,'2008-06-03 06:30:32','2008-06-03 06:30:32'),(7,'Contact','admin','admin',1,2,'2008-06-03 06:30:41','2008-06-03 06:30:41');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customerpos`
--

DROP TABLE IF EXISTS `customerpos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customerpos` (
  `CUSTOMERPOSID` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `MYID` bigint(21) unsigned NOT NULL,
  `POSITIONID` bigint(21) unsigned NOT NULL,
  `POS_DESC` text COLLATE latin1_german2_ci NOT NULL,
  `POS_QUANTITY` decimal(21,2) NOT NULL DEFAULT '0.00',
  `POS_PRICE` decimal(21,2) NOT NULL DEFAULT '0.00',
  `POS_GROUP` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `TAX` tinyint(3) unsigned NOT NULL,
  `TAX_DESC` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `TAX_MULTI` decimal(6,5) NOT NULL DEFAULT '0.00000',
  `TAX_DIVIDE` decimal(6,5) NOT NULL DEFAULT '0.00000',
  PRIMARY KEY (`CUSTOMERPOSID`),
  KEY `MYID` (`MYID`),
  KEY `POSITIONID` (`POSITIONID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customerpos`
--

LOCK TABLES `customerpos` WRITE;
/*!40000 ALTER TABLE `customerpos` DISABLE KEYS */;
/*!40000 ALTER TABLE `customerpos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice` (
  `INVOICEID` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `MYID` bigint(21) unsigned NOT NULL,
  `INVOICE_DATE` date NOT NULL DEFAULT '0000-00-00',
  `MESSAGEID` smallint(5) unsigned NOT NULL,
  `MESSAGE_DESC` text COLLATE latin1_german2_ci NOT NULL,
  `METHODOFPAYID` tinyint(3) unsigned NOT NULL,
  `METHOD_OF_PAY` varchar(150) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `METHOD_OF_PAY_DATE` date NOT NULL DEFAULT '0000-00-00',
  `TAX1_TOTAL` decimal(21,2) NOT NULL DEFAULT '0.00',
  `TAX2_TOTAL` decimal(21,2) NOT NULL DEFAULT '0.00',
  `TAX3_TOTAL` decimal(21,2) NOT NULL DEFAULT '0.00',
  `TAX4_TOTAL` decimal(21,2) NOT NULL DEFAULT '0.00',
  `TAX1_DESC` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `TAX2_DESC` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `TAX3_DESC` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `TAX4_DESC` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `SUBTOTAL1` decimal(21,2) NOT NULL DEFAULT '0.00',
  `SUBTOTAL2` decimal(21,2) NOT NULL DEFAULT '0.00',
  `SUBTOTAL3` decimal(21,2) NOT NULL DEFAULT '0.00',
  `SUBTOTAL4` decimal(21,2) NOT NULL DEFAULT '0.00',
  `TOTAL_AMOUNT` decimal(21,2) NOT NULL DEFAULT '0.00',
  `NOTE` text COLLATE latin1_german2_ci NOT NULL,
  `PAID` tinyint(3) unsigned NOT NULL,
  `SUM_PAID` decimal(21,2) NOT NULL DEFAULT '0.00',
  `DELIVERY_NOTE_PRINTED` tinyint(3) unsigned NOT NULL,
  `DELIVERY_NOTE_MAILED` tinyint(3) unsigned NOT NULL,
  `INVOICE_PRINTED` tinyint(3) unsigned NOT NULL,
  `INVOICE_MAILED` tinyint(3) unsigned NOT NULL,
  `CANCELED` tinyint(3) unsigned NOT NULL,
  `CREATEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `MODIFIEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `CREATED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`INVOICEID`),
  KEY `MYID` (`MYID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoicepos`
--

DROP TABLE IF EXISTS `invoicepos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoicepos` (
  `INVOICEPOSID` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `MYID` bigint(21) unsigned NOT NULL,
  `INVOICEID` bigint(21) unsigned NOT NULL,
  `POSITIONID` bigint(21) unsigned NOT NULL,
  `POS_DESC` text COLLATE latin1_german2_ci NOT NULL,
  `POS_QUANTITY` decimal(21,2) NOT NULL DEFAULT '0.00',
  `POS_PRICE` decimal(21,2) NOT NULL DEFAULT '0.00',
  `POS_GROUP` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `TAX` tinyint(3) unsigned NOT NULL,
  `TAX_DESC` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `TAX_MULTI` decimal(6,5) NOT NULL DEFAULT '0.00000',
  `TAX_DIVIDE` decimal(6,5) NOT NULL DEFAULT '0.00000',
  PRIMARY KEY (`INVOICEPOSID`),
  KEY `MYID` (`MYID`),
  KEY `INVOICEID` (`INVOICEID`),
  KEY `POSITIONID` (`POSITIONID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoicepos`
--

LOCK TABLES `invoicepos` WRITE;
/*!40000 ALTER TABLE `invoicepos` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoicepos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `MESSAGEID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `DESCRIPTION` text COLLATE latin1_german2_ci NOT NULL,
  `CREATEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `MODIFIEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `CREATED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`MESSAGEID`),
  KEY `DESCRIPTION` (`DESCRIPTION`(20))
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `methodofpay`
--

DROP TABLE IF EXISTS `methodofpay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `methodofpay` (
  `METHODOFPAYID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `DESCRIPTION` varchar(150) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `CREATEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `MODIFIEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `CREATED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`METHODOFPAYID`),
  KEY `DESCRIPTION` (`DESCRIPTION`(20))
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `methodofpay`
--

LOCK TABLES `methodofpay` WRITE;
/*!40000 ALTER TABLE `methodofpay` DISABLE KEYS */;
INSERT INTO `methodofpay` VALUES (1,'American Express','admin','admin',1,2,'2008-06-01 09:37:13','2008-06-01 09:37:13'),(2,'Bar/Cash','admin','admin',1,2,'2008-06-01 09:37:15','2008-06-01 09:37:15'),(3,'Diners Club Int.','admin','admin',1,2,'2008-06-03 06:24:47','2008-06-03 06:24:47'),(4,'EC - Card','admin','admin',1,2,'2008-06-03 06:24:59','2008-06-03 06:24:59'),(5,'MasterCard','admin','admin',1,2,'2008-06-03 06:25:13','2008-06-03 06:25:13'),(6,'Maestro','admin','admin',1,2,'2008-06-03 06:25:23','2008-06-03 06:25:23'),(7,'Scheck','admin','admin',1,2,'2008-06-03 06:25:35','2008-06-03 06:25:35'),(8,'Bank transfer','admin','admin',1,2,'2008-06-03 06:25:51','2008-06-03 06:25:51'),(9,'VISA','admin','admin',1,2,'2008-06-03 06:25:58','2008-06-03 06:25:58'),(10,'Direct debit','admin','admin',1,2,'2008-06-03 06:28:40','2008-06-03 06:28:40'),(11,'Payable cash upon receipt','admin','admin',1,2,'2008-06-03 06:28:56','2008-06-03 06:28:56'),(12,'Immediate payment required without discount','admin','admin',1,2,'2008-06-03 06:29:09','2008-06-03 06:29:09');
/*!40000 ALTER TABLE `methodofpay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer`
--

DROP TABLE IF EXISTS `offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offer` (
  `OFFERID` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `MYID` bigint(21) unsigned NOT NULL,
  `INVOICEID` bigint(21) unsigned NOT NULL,
  `OFFER_DATE` date NOT NULL DEFAULT '0000-00-00',
  `MESSAGEID` smallint(5) unsigned NOT NULL,
  `MESSAGE_DESC` text COLLATE latin1_german2_ci NOT NULL,
  `METHODOFPAYID` tinyint(3) unsigned NOT NULL,
  `METHOD_OF_PAY` varchar(150) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `METHOD_OF_PAY_DATE` date NOT NULL DEFAULT '0000-00-00',
  `STATUS` tinyint(3) NOT NULL DEFAULT '1',
  `TAX1_TOTAL` decimal(21,2) NOT NULL DEFAULT '0.00',
  `TAX2_TOTAL` decimal(21,2) NOT NULL DEFAULT '0.00',
  `TAX3_TOTAL` decimal(21,2) NOT NULL DEFAULT '0.00',
  `TAX4_TOTAL` decimal(21,2) NOT NULL DEFAULT '0.00',
  `TAX1_DESC` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `TAX2_DESC` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `TAX3_DESC` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `TAX4_DESC` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `SUBTOTAL1` decimal(21,2) NOT NULL DEFAULT '0.00',
  `SUBTOTAL2` decimal(21,2) NOT NULL DEFAULT '0.00',
  `SUBTOTAL3` decimal(21,2) NOT NULL DEFAULT '0.00',
  `SUBTOTAL4` decimal(21,2) NOT NULL DEFAULT '0.00',
  `TOTAL_AMOUNT` decimal(21,2) NOT NULL DEFAULT '0.00',
  `NOTE` text COLLATE latin1_german2_ci NOT NULL,
  `ORDER_PRINTED` tinyint(3) unsigned NOT NULL,
  `ORDER_MAILED` tinyint(3) unsigned NOT NULL,
  `OFFER_PRINTED` tinyint(3) unsigned NOT NULL,
  `OFFER_MAILED` tinyint(3) unsigned NOT NULL,
  `CANCELED` tinyint(3) unsigned NOT NULL,
  `CREATEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `MODIFIEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `CREATED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`OFFERID`),
  KEY `MYID` (`MYID`),
  KEY `INVOICEID` (`INVOICEID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer`
--

LOCK TABLES `offer` WRITE;
/*!40000 ALTER TABLE `offer` DISABLE KEYS */;
/*!40000 ALTER TABLE `offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offerpos`
--

DROP TABLE IF EXISTS `offerpos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offerpos` (
  `OFFERPOSID` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `OFFERID` bigint(21) unsigned NOT NULL,
  `MYID` bigint(21) unsigned NOT NULL,
  `POSITIONID` bigint(21) unsigned NOT NULL,
  `POS_DESC` text COLLATE latin1_german2_ci NOT NULL,
  `POS_QUANTITY` decimal(21,2) NOT NULL DEFAULT '0.00',
  `POS_PRICE` decimal(21,2) NOT NULL DEFAULT '0.00',
  `POS_GROUP` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `TAX` tinyint(3) unsigned NOT NULL,
  `TAX_DESC` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `TAX_MULTI` decimal(6,5) NOT NULL DEFAULT '0.00000',
  `TAX_DIVIDE` decimal(6,5) NOT NULL DEFAULT '0.00000',
  PRIMARY KEY (`OFFERPOSID`),
  KEY `OFFERID` (`OFFERID`),
  KEY `MYID` (`MYID`),
  KEY `POSITIONID` (`POSITIONID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offerpos`
--

LOCK TABLES `offerpos` WRITE;
/*!40000 ALTER TABLE `offerpos` DISABLE KEYS */;
/*!40000 ALTER TABLE `offerpos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `PAYMENTID` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `MYID` bigint(21) unsigned NOT NULL,
  `INVOICEID` bigint(21) unsigned NOT NULL,
  `PAYMENT_DATE` date NOT NULL DEFAULT '0000-00-00',
  `METHODOFPAYID` tinyint(3) unsigned NOT NULL,
  `METHOD_OF_PAY` varchar(150) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `CARDNR` blob NOT NULL,
  `VALIDTHRU` blob NOT NULL,
  `SUM_PAID` decimal(21,2) NOT NULL DEFAULT '0.00',
  `NOTE` text COLLATE latin1_german2_ci NOT NULL,
  `CANCELED` tinyint(3) unsigned NOT NULL,
  `CREATEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `MODIFIEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `CREATED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`PAYMENTID`),
  KEY `MYID` (`MYID`),
  KEY `INVOICEID` (`INVOICEID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posgroup`
--

DROP TABLE IF EXISTS `posgroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posgroup` (
  `POSGROUPID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `DESCRIPTION` varchar(150) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `CREATEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `MODIFIEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `CREATED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`POSGROUPID`),
  KEY `DESCRIPTION` (`DESCRIPTION`(20))
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posgroup`
--

LOCK TABLES `posgroup` WRITE;
/*!40000 ALTER TABLE `posgroup` DISABLE KEYS */;
INSERT INTO `posgroup` VALUES (1,'Books','admin','admin',1,2,'2008-03-30 10:47:00','2008-06-03 06:33:33'),(2,'Service','admin','admin',1,2,'2008-03-30 10:47:05','2008-06-03 06:33:41'),(3,'Hotel','admin','admin',1,2,'2008-06-03 06:37:59','2008-06-03 06:37:59'),(4,'Restaurant','admin','admin',1,2,'2008-06-03 06:38:05','2008-06-03 06:38:05');
/*!40000 ALTER TABLE `posgroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `SETTINGID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `COMPANY_DATE` date NOT NULL DEFAULT '0000-00-00',
  `PRINT_COMPANY_DATA` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `PRINT_POSITION_NAME` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `TAX_FREE` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `COMPANY_NAME` varchar(150) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY_ADDRESS` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY_POSTAL` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY_CITY` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY_COUNTRY` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY_PHONE` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY_FAX` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY_EMAIL` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY_URL` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY_WAP` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY_CURRENCY` varchar(10) COLLATE latin1_german2_ci NOT NULL DEFAULT 'EUR',
  `COMPANY_SALESPRICE` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `COMPANY_TAXNR` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY_BUSINESS_TAXNR` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY_BANKNAME` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY_BANKACCOUNT` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY_BANKNUMBER` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY_BANKIBAN` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY_BANKBIC` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `EMAIL_INTERNAL` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `EMAIL_USE_SIGNATURE` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `EMAIL_SIGNATURE` text COLLATE latin1_german2_ci NOT NULL,
  `INVENTORY_CHECK_ACTIVE` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `REMINDER` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `REMINDER_DAYS` tinyint(3) unsigned NOT NULL DEFAULT '10',
  `REMINDER_PRICE` decimal(11,2) NOT NULL DEFAULT '2.50',
  `ENTRYS_PER_PAGE` smallint(5) unsigned NOT NULL DEFAULT '50',
  `SESSION_SEC` smallint(5) unsigned NOT NULL DEFAULT '600',
  `COMPANY_LOGO` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY_LOGO_WIDTH` varchar(10) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `COMPANY_LOGO_HEIGHT` varchar(10) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `PDF_COMPANY_LOGO_HEIGHT` tinyint(3) unsigned NOT NULL DEFAULT '15',
  `PDF_COMPANY_LOGO_WIDTH` tinyint(3) unsigned NOT NULL DEFAULT '50',
  `PDF_FONT` varchar(30) COLLATE latin1_german2_ci NOT NULL DEFAULT 'Arial',
  `PDF_DIR` varchar(254) COLLATE latin1_german2_ci NOT NULL DEFAULT '/tmp/',
  `PDF_FONT_SIZE1` tinyint(3) unsigned NOT NULL DEFAULT '9',
  `PDF_FONT_SIZE2` tinyint(3) unsigned NOT NULL DEFAULT '10',
  `PDF_TYPE_HEIGHT` tinyint(3) unsigned NOT NULL DEFAULT '22',
  `PDF_ATTACHMENT_TEXT` text COLLATE latin1_german2_ci NOT NULL,
  `CREATEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `MODIFIEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL DEFAULT '2',
  PRIMARY KEY (`SETTINGID`),
  UNIQUE KEY `COMPANY_NAME` (`COMPANY_NAME`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES (1,'2007-12-01',1,1,2,'Sample Company Inc.','Sample Street 1','12345','Sample City','Germany','+49 (0) 1234 / 1234-0','+49 (0) 1234 / 1234-10','info@sample-company-inc.de','http://www.sample-company-inc.de','','EUR',2,'10/101/10101','DE 1234567890','Sample Bank','123 456 789 0','123 456 78','DE01 1234 5678 9000 0000 00','ABCDEFGHIJ1',1,1,'Sincerely\r\n\r\nYours, The Sample Company\r\n',1,1,10,2.50,25,600,'logo.png','180','40',15,50,'Arial','/tmp/',9,9,22,'Please find enclosed your {TYPE} {NUMBER} of {DATE} in PDF format.\r\n\r\nIn order to view the {TYPE}, please click\r\nthe attachment and it should automatically\r\nopen the default PDF viewer. If you do not have PDF viewer\r\ninstalled, you will find the link for free download.\r\n\r\nhttp://get.adobe.com/de/reader/\r\n\r\nor\r\n\r\nhttp://www.foxitsoftware.com/downloads/\r\n\r\nYou can print your {TYPE} for your records.\r\n\r\nSincerely\r\n\r\nYours, The Sample Company\r\n','admin','admin',1,2);
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `syslog`
--

DROP TABLE IF EXISTS `syslog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `syslog` (
  `SYSLOGID` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `CREATED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DESCRIPTION` text COLLATE latin1_german2_ci NOT NULL,
  `CREATEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL DEFAULT '2',
  PRIMARY KEY (`SYSLOGID`),
  KEY `DESCRIPTION` (`DESCRIPTION`(20))
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `syslog`
--

LOCK TABLES `syslog` WRITE;
/*!40000 ALTER TABLE `syslog` DISABLE KEYS */;
/*!40000 ALTER TABLE `syslog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax`
--

DROP TABLE IF EXISTS `tax`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tax` (
  `TAXID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `TAX_DIVIDE` decimal(6,5) NOT NULL DEFAULT '0.00000',
  `TAX_MULTI` decimal(6,5) NOT NULL DEFAULT '0.00000',
  `TAX_DESC` varchar(50) COLLATE latin1_german2_ci NOT NULL,
  `CREATEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `MODIFIEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `CREATED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`TAXID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax`
--

LOCK TABLES `tax` WRITE;
/*!40000 ALTER TABLE `tax` DISABLE KEYS */;
INSERT INTO `tax` VALUES (1,1.19000,0.19000,'19.00 %','admin','admin',1,2,'2008-01-01 10:10:00','2008-01-01 10:10:00'),(2,1.07000,0.07000,'07.00 %','admin','admin',1,2,'2008-01-01 10:10:00','2008-01-01 10:10:00'),(3,1.10700,0.10700,'10.70 %','admin','admin',1,2,'2008-01-01 10:10:00','2008-01-01 10:10:00'),(4,0.00000,0.00000,'Tax Free','admin','admin',1,2,'2008-01-01 10:10:00','2008-01-01 10:10:00');
/*!40000 ALTER TABLE `tax` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tmp_invoice`
--

DROP TABLE IF EXISTS `tmp_invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tmp_invoice` (
  `TMP_INVOICEID` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `MYID` bigint(21) unsigned NOT NULL,
  `INVOICEID` bigint(21) unsigned NOT NULL,
  `POSITIONID` bigint(21) unsigned NOT NULL,
  `USERNAME` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `POS_DESC` text COLLATE latin1_german2_ci NOT NULL,
  `POS_QUANTITY` decimal(21,2) NOT NULL DEFAULT '0.00',
  `POS_PRICE` decimal(21,2) NOT NULL DEFAULT '0.00',
  `POS_GROUP` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `TAX` tinyint(3) unsigned NOT NULL,
  `TAX_MULTI` decimal(6,5) NOT NULL DEFAULT '0.00000',
  `TAX_DIVIDE` decimal(6,5) NOT NULL DEFAULT '0.00000',
  `TAX_DESC` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`TMP_INVOICEID`),
  KEY `MYID` (`MYID`),
  KEY `INVOICEID` (`INVOICEID`),
  KEY `POSITIONID` (`POSITIONID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tmp_invoice`
--

LOCK TABLES `tmp_invoice` WRITE;
/*!40000 ALTER TABLE `tmp_invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `tmp_invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tmp_offer`
--

DROP TABLE IF EXISTS `tmp_offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tmp_offer` (
  `TMP_OFFERID` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `MYID` bigint(21) unsigned NOT NULL,
  `OFFERID` bigint(21) unsigned NOT NULL,
  `POSITIONID` bigint(21) unsigned NOT NULL,
  `USERNAME` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `POS_DESC` text COLLATE latin1_german2_ci NOT NULL,
  `POS_QUANTITY` decimal(21,2) NOT NULL DEFAULT '0.00',
  `POS_PRICE` decimal(21,2) NOT NULL DEFAULT '0.00',
  `POS_GROUP` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `TAX` tinyint(3) unsigned NOT NULL,
  `TAX_MULTI` decimal(6,5) NOT NULL DEFAULT '0.00000',
  `TAX_DIVIDE` decimal(6,5) NOT NULL DEFAULT '0.00000',
  `TAX_DESC` varchar(50) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`TMP_OFFERID`),
  KEY `MYID` (`MYID`),
  KEY `OFFERID` (`OFFERID`),
  KEY `POSITIONID` (`POSITIONID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tmp_offer`
--

LOCK TABLES `tmp_offer` WRITE;
/*!40000 ALTER TABLE `tmp_offer` DISABLE KEYS */;
/*!40000 ALTER TABLE `tmp_offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `updatetable`
--

DROP TABLE IF EXISTS `updatetable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `updatetable` (
  `UPDATEID` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `CREATED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `VERSION` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `LOGINUPDATE` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `TABLEUPDATE` tinyint(3) unsigned NOT NULL DEFAULT '2',
  PRIMARY KEY (`UPDATEID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `updatetable`
--

LOCK TABLES `updatetable` WRITE;
/*!40000 ALTER TABLE `updatetable` DISABLE KEYS */;
INSERT INTO `updatetable` VALUES (1,'2011-01-31 10:10:00','1.6.4',1,1);
/*!40000 ALTER TABLE `updatetable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `USERID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `FULLNAME` blob NOT NULL,
  `USERNAME` blob NOT NULL,
  `PASSWORD` blob NOT NULL,
  `USERGROUP1` blob NOT NULL,
  `USERGROUP2` blob NOT NULL,
  `LANGUAGE` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `USER_ACTIVE` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `LICENSE_ACCEPTED` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `CREATEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `MODIFIEDBY` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT 'admin',
  `CREATED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`USERID`),
  UNIQUE KEY `USERNAME` (`USERNAME`(30))
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'ˆXl‡P&ÌÏ6 ˆ\'','ÆxL¿p','ùÆ_¿Ë','p','√†',1,1,1,'admin','admin','2008-03-30 10:33:44','2016-11-09 14:01:27');
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

-- Dump completed on 2017-11-21 15:20:50
