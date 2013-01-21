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
-- Table structure for table `cotizaciones_compra_detalles_proveedores`
--

DROP TABLE IF EXISTS `cotizaciones_compra_detalles_proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cotizaciones_compra_detalles_proveedores` (
  `id_ordenes_compra_detalle` int(11) NOT NULL,
  `id_moneda` int(11) NOT NULL,
  `valor_unitario` decimal(10,2) DEFAULT NULL,
  `valor_total` decimal(10,2) DEFAULT NULL,
  `iva` decimal(10,2) DEFAULT NULL,
  `terceros_id_terceros` int(11) NOT NULL,
  KEY `fk_cotizaciones_compra_detalles_proveedores_cotizaciones_comp1` (`id_ordenes_compra_detalle`),
  KEY `fk_cotizaciones_compra_detalles_proveedores_monedas1` (`id_moneda`),
  KEY `fk_cotizaciones_compra_detalles_proveedores_terceros1` (`terceros_id_terceros`),
  CONSTRAINT `fk_cotizaciones_compra_detalles_proveedores_cotizaciones_comp1` FOREIGN KEY (`id_ordenes_compra_detalle`) REFERENCES `cotizaciones_compra_detalles` (`id_ordenes_compra_detalle`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cotizaciones_compra_detalles_proveedores_monedas1` FOREIGN KEY (`id_moneda`) REFERENCES `monedas` (`id_moneda`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cotizaciones_compra_detalles_proveedores_terceros1` FOREIGN KEY (`terceros_id_terceros`) REFERENCES `terceros` (`id_terceros`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotizaciones_compra_detalles_proveedores`
--

LOCK TABLES `cotizaciones_compra_detalles_proveedores` WRITE;
/*!40000 ALTER TABLE `cotizaciones_compra_detalles_proveedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `cotizaciones_compra_detalles_proveedores` ENABLE KEYS */;
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
