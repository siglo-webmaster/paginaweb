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
-- Table structure for table `cotizaciones_compra`
--

DROP TABLE IF EXISTS `cotizaciones_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cotizaciones_compra` (
  `id_cotizaciones_compra` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuarios_creacion` int(11) NOT NULL,
  `id_tipo_negociacion` int(11) NOT NULL,
  `id_moneda` int(11) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `observaciones_orden` text,
  `observaciones_internas` text,
  `fecha_requerida` timestamp NULL DEFAULT NULL,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`id_cotizaciones_compra`),
  KEY `fk_cotizaciones_compra_usuarios1` (`id_usuarios_creacion`),
  KEY `fk_cotizaciones_compra_tipo_negociacion1` (`id_tipo_negociacion`),
  KEY `fk_cotizaciones_compra_monedas1` (`id_moneda`),
  CONSTRAINT `fk_cotizaciones_compra_monedas1` FOREIGN KEY (`id_moneda`) REFERENCES `monedas` (`id_moneda`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cotizaciones_compra_tipo_negociacion1` FOREIGN KEY (`id_tipo_negociacion`) REFERENCES `tipo_negociacion` (`id_tipo_negociacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cotizaciones_compra_usuarios1` FOREIGN KEY (`id_usuarios_creacion`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotizaciones_compra`
--

LOCK TABLES `cotizaciones_compra` WRITE;
/*!40000 ALTER TABLE `cotizaciones_compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `cotizaciones_compra` ENABLE KEYS */;
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
