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
-- Table structure for table `titulos_eventos_destacados`
--

DROP TABLE IF EXISTS `titulos_eventos_destacados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `titulos_eventos_destacados` (
  `id_destacados` int(11) NOT NULL,
  `id_eventos` int(11) NOT NULL,
  `id_titulos` int(11) NOT NULL,
  PRIMARY KEY (`id_destacados`,`id_eventos`,`id_titulos`),
  KEY `fk_destacados_eventos_eventos1` (`id_eventos`),
  KEY `fk_destacados_eventos_destacados1` (`id_destacados`),
  KEY `fk_destacados_eventos_titulos1` (`id_titulos`),
  CONSTRAINT `fk_destacados_eventos_destacados1` FOREIGN KEY (`id_destacados`) REFERENCES `destacados` (`id_destacados`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_destacados_eventos_eventos1` FOREIGN KEY (`id_eventos`) REFERENCES `eventos` (`id_eventos`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_destacados_eventos_titulos1` FOREIGN KEY (`id_titulos`) REFERENCES `titulos` (`id_titulos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `titulos_eventos_destacados`
--

LOCK TABLES `titulos_eventos_destacados` WRITE;
/*!40000 ALTER TABLE `titulos_eventos_destacados` DISABLE KEYS */;
/*!40000 ALTER TABLE `titulos_eventos_destacados` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-01-21  8:44:22
