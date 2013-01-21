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
-- Table structure for table `transportadoras_ciudades`
--

DROP TABLE IF EXISTS `transportadoras_ciudades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transportadoras_ciudades` (
  `id_transportadoras` int(11) NOT NULL,
  `id_ciudades` int(11) NOT NULL,
  `id_moneda` int(11) NOT NULL,
  `fletes` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_transportadoras`,`id_ciudades`),
  KEY `monedas_transportadoras_ciudades_fk` (`id_moneda`),
  KEY `ciudades_transportadoras_ciudades_fk` (`id_ciudades`),
  CONSTRAINT `ciudades_transportadoras_ciudades_fk` FOREIGN KEY (`id_ciudades`) REFERENCES `ciudades` (`id_ciudades`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `monedas_transportadoras_ciudades_fk` FOREIGN KEY (`id_moneda`) REFERENCES `monedas` (`id_moneda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `transportadoras_transportadoras_ciudades_fk` FOREIGN KEY (`id_transportadoras`) REFERENCES `transportadoras` (`id_transportadoras`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transportadoras_ciudades`
--

LOCK TABLES `transportadoras_ciudades` WRITE;
/*!40000 ALTER TABLE `transportadoras_ciudades` DISABLE KEYS */;
INSERT INTO `transportadoras_ciudades` VALUES (2,1,1,5000),(2,2,1,7000),(3,1,1,4700),(3,2,1,6000);
/*!40000 ALTER TABLE `transportadoras_ciudades` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-01-21  8:42:46
