CREATE DATABASE  IF NOT EXISTS `sheweb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sheweb`;
-- MySQL dump 10.13  Distrib 5.5.28, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: sheweb
-- ------------------------------------------------------
-- Server version	5.5.28-0ubuntu0.12.04.3-log

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
-- Table structure for table `ordenes_plataforma_pago`
--

DROP TABLE IF EXISTS `ordenes_plataforma_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordenes_plataforma_pago` (
  `id_ordenes_plataforma_pago` int(11) NOT NULL AUTO_INCREMENT,
  `id_ordenes` int(11) NOT NULL,
  `id_plataforma_pago` int(11) NOT NULL,
  `inicio_proceso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fin_proceso` timestamp NULL DEFAULT NULL,
  `ip` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`id_ordenes_plataforma_pago`),
  KEY `plataforma_pago_ordenes_plataforma_pago_fk` (`id_plataforma_pago`),
  KEY `ordenes_ordenes_plataforma_pago_fk` (`id_ordenes`),
  CONSTRAINT `ordenes_ordenes_plataforma_pago_fk` FOREIGN KEY (`id_ordenes`) REFERENCES `ordenes` (`id_ordenes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `plataforma_pago_ordenes_plataforma_pago_fk` FOREIGN KEY (`id_plataforma_pago`) REFERENCES `plataforma_pago` (`id_plataforma_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordenes_plataforma_pago`
--

LOCK TABLES `ordenes_plataforma_pago` WRITE;
/*!40000 ALTER TABLE `ordenes_plataforma_pago` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordenes_plataforma_pago` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-01-21  8:19:37
