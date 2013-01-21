CREATE DATABASE  IF NOT EXISTS `sheweb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sheweb`;
-- MySQL dump 10.13  Distrib 5.5.28, for debian-linux-gnu (i686)
--
-- Host: 192.168.16.34    Database: sheweb
-- ------------------------------------------------------
-- Server version	5.5.24-0ubuntu0.12.04.1

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
-- Table structure for table `menus_items`
--

DROP TABLE IF EXISTS `menus_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus_items` (
  `id_menu_items` int(11) NOT NULL AUTO_INCREMENT,
  `id_menus` int(11) NOT NULL,
  `id_tipos_menus_items` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `contenido` text,
  `estado` varchar(45) DEFAULT NULL,
  `id_padre` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_menu_items`),
  KEY `fk_menus_items_menus1` (`id_menus`),
  KEY `fk_menus_items_tipos_menus_items1` (`id_tipos_menus_items`),
  CONSTRAINT `fk_menus_items_menus1` FOREIGN KEY (`id_menus`) REFERENCES `menus` (`id_menus`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_menus_items_tipos_menus_items1` FOREIGN KEY (`id_tipos_menus_items`) REFERENCES `tipos_menus_items` (`id_tipos_menus_items`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus_items`
--

LOCK TABLES `menus_items` WRITE;
/*!40000 ALTER TABLE `menus_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `menus_items` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-01-21  8:42:52
