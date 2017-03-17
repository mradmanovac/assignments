-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: homeworks
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assignments` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `group_id` int(5) DEFAULT NULL,
  `download_url` varchar(200) DEFAULT NULL,
  `bitly_url` varchar(200) DEFAULT 'abc',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignments`
--

LOCK TABLES `assignments` WRITE;
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
INSERT INTO `assignments` VALUES (6,'Domaci 6','Domaci 6, uraditi sve zadatke','2010-03-20 17:00:00',2,'www.dasdadasd.com','abc'),(5,'Domaci 7','Domaci 5, uraditi sve zadatke','2015-04-20 17:00:00',9,'www.dasdasda.com','abc'),(1,'Domaci 1','Domaci 1, uraditi sve zadatke','2015-03-20 17:00:00',7,'www.idemo.com','abc'),(2,'Domaci 2','Domaci 2, uraditi sve zadatke','2014-03-20 17:00:00',7,'www.dasdasd.com','abc'),(3,'Domaci 4','Domaci 4, uraditi sve zadatke','2010-03-20 17:00:00',8,'www.dsadasda.com','abc'),(4,'Domaci 8','Domaci 4, uraditi sve zadatke','2005-03-20 17:00:00',1,'www.dsadasd.com','abc'),(7,'Domaci 77','Domaci 7, uraditi sve zadatke','2015-03-20 16:00:00',3,'www.dsada.com','abc');
/*!40000 ALTER TABLE `assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `created_id` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Core PHP 7','cphp7','2015-03-20 17:00:00',1),(2,'Core PHP 7','cphp7','2015-04-20 16:00:00',1),(3,'Core PHP 7','cph6','2015-02-20 17:00:00',0),(4,'Core PHP 7','cphp4','2010-03-20 17:00:00',1),(5,'Core PHP 7','cphp2','2014-03-20 17:00:00',1),(6,'Core PHP 7','cphp1','2015-03-20 10:00:00',0),(7,'Core PHP 7','cphp9','2015-01-20 17:00:00',1);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `assignment_id` int(3) DEFAULT NULL,
  `user_id` int(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT '127.0.0.1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES (1,1,1,'2015-03-20 17:00:00','127.0.0.1'),(2,2,2,'2001-01-20 17:00:00','127.0.0.1'),(3,3,3,'2015-12-20 16:00:00','127.0.0.1'),(4,4,4,'2015-04-20 15:00:00','127.0.0.1'),(5,5,5,'2014-03-20 17:00:00','127.0.0.1'),(6,6,6,'2010-03-20 17:00:00','127.0.0.1'),(7,7,7,'2010-10-20 16:00:00','127.0.0.1');
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) DEFAULT NULL,
  `role_id` int(2) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super admin',1,1),(2,'Admin',2,1),(3,'Clan',3,1),(4,'Sljaker',4,0),(5,'Robot',5,0),(6,'Gost',6,1),(7,'Super admin',1,0);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `role_id` int(2) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `group_id` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'user_name','email@aaa.com','0cc175b9c0f1b6a831c399e269772661',1,1,1),(2,'marko','email@sss.com','0cc175b9c0f1b6a831c399e269772661',0,0,0),(3,'mirko','email@dddd.com','0cc175b9c0f1b6a831c399e269772661',2,1,1),(4,'slavko','email@www.com','0cc175b9c0f1b6a831c399e269772661',3,1,0),(5,'slobodan','email@fff.com','0cc175b9c0f1b6a831c399e269772661',1,1,1),(6,'mladen','email@vvv.com','0cc175b9c0f1b6a831c399e269772661',0,1,1),(7,'igor','email@bbb.com','0cc175b9c0f1b6a831c399e269772661',4,1,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-15 23:55:41
