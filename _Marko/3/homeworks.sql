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
  `title` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `creation_date` timestamp NOT NULL,
  `group_id` int(5) NOT NULL,
  `download_url` varchar(200) NOT NULL,
  `bitly_url` varchar(200) NOT NULL DEFAULT 'abc',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignments`
--

LOCK TABLES `assignments` WRITE;
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
INSERT INTO `assignments` VALUES (1,'Domaci 1','Domaci 1, uraditi sve zadatke','2017-03-16 23:32:09',7,'www.idemo.com','abc'),(2,'Domaci 2','Domaci 2, uraditi sve zadatke','2017-03-16 23:32:10',7,'www.dasdasd.com','abc'),(3,'Domaci 4','Domaci 4, uraditi sve zadatke','2017-03-16 23:32:12',8,'www.dsadasda.com','abc'),(4,'Domaci 8','Domaci 4, uraditi sve zadatke','2017-03-16 23:32:13',1,'www.dsadasd.com','abc'),(5,'Domaci 7','Domaci 5, uraditi sve zadatke','2017-03-16 23:32:15',9,'www.dasdasda.com','abc'),(6,'Domaci 6','Domaci 6, uraditi sve zadatke','2017-03-16 23:32:16',2,'www.dasdadasd.com','abc'),(7,'Domaci 77','Domaci 7, uraditi sve zadatke','2017-03-16 23:32:17',3,'www.dsada.com','abc'),(8,'Domaci 777','Domaci 57, uraditi sve zadatke','2017-03-16 23:32:18',0,'www.dsada.com','abc');
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
  `name` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Core PHP 7','cphp7','2017-03-16 23:33:16',1),(2,'Core PHP 7','cphp7','2017-03-16 23:33:16',1),(3,'Core PHP 7','cphp6','2017-03-16 23:33:16',0),(4,'Core PHP 7','cphp4','2017-03-16 23:33:16',1),(5,'Core PHP 7','cphp2','2017-03-16 23:33:16',1),(6,'Core PHP 7','cphp1','2017-03-16 23:33:16',0),(7,'Core PHP 7','cphp9','2017-03-16 23:33:16',1);
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
  `assignment_id` int(3) NOT NULL,
  `user_id` int(4) NOT NULL,
  `created_at` timestamp NOT NULL,
  `ip` varchar(50) DEFAULT '127.0.0.1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES (1,1,1,'2017-03-16 23:32:54','127.0.0.1'),(2,2,2,'2017-03-16 23:32:54','127.0.0.1'),(3,3,3,'2017-03-16 23:32:54','127.0.0.1'),(4,4,4,'2017-03-16 23:32:54','127.0.0.1'),(5,5,5,'2017-03-16 23:32:54','127.0.0.1'),(6,6,6,'2017-03-16 23:32:54','127.0.0.1'),(7,7,7,'2017-03-16 23:32:54','127.0.0.1');
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
  `name` varchar(20) NOT NULL,
  `role_id` int(2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin',2,1),(2,'Clan',3,1),(3,'Sljaker',4,0),(4,'Robot',5,0),(5,'Gost',6,1),(6,'Super admin',1,0);
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
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role_id` int(2) NOT NULL,
  `role_name` varchar(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `group_id` int(2) NOT NULL,
  `group_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'user_name','email@aaa.com','0cc175b9c0f1b6a831c399e269772661',1,'Super admin',1,1,'cphp7'),(2,'marko','email@sss.com','0cc175b9c0f1b6a831c399e269772661',0,'Ne postoji',0,0,'cphp7'),(3,'mirko','email@dddd.com','0cc175b9c0f1b6a831c399e269772661',2,'Admin',1,1,'cphp7'),(4,'slavko','email@www.com','0cc175b9c0f1b6a831c399e269772661',3,'Clan',1,0,'cphp7'),(5,'slobodan','email@fff.com','0cc175b9c0f1b6a831c399e269772661',1,'Super admin',1,1,'cphp7'),(6,'mladen','email@vvv.com','0cc175b9c0f1b6a831c399e269772661',0,'Nema',1,1,'cphp7'),(7,'igor','email@bbb.com','0cc175b9c0f1b6a831c399e269772661',4,'Nema',1,1,'cphp7'),(8,'user_name','email@fbfbf.com','0cc175b9c0f1b6a831c399e269772661',1,'Slkajer',1,1,'cphp7');
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

-- Dump completed on 2017-03-17  0:34:41
