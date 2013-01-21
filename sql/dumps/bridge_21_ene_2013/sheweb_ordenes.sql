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
-- Table structure for table `ordenes`
--

DROP TABLE IF EXISTS `ordenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordenes` (
  `id_ordenes` int(11) NOT NULL AUTO_INCREMENT,
  `id_moneda` int(11) NOT NULL,
  `id_clientes` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_pedido` date NOT NULL,
  `fecha_despacho` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `estado_pago` varchar(45) NOT NULL,
  `estado_despacho` varchar(45) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `impuestos` decimal(10,2) NOT NULL,
  `peso` decimal(10,0) NOT NULL,
  `alto` decimal(10,0) NOT NULL,
  `largo` decimal(10,0) NOT NULL,
  `ancho` decimal(10,0) NOT NULL,
  `volumen` decimal(10,0) NOT NULL,
  `fletes` decimal(10,0) NOT NULL,
  `fecha_confirmacion` date NOT NULL,
  `codigo_confirmacion` varchar(255) NOT NULL,
  `estado_orden` varchar(45) NOT NULL,
  `observaciones` text,
  `descuentos` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id_ordenes`),
  KEY `monedas_ordenes_fk` (`id_moneda`),
  KEY `clientes_ordenes_fk` (`id_clientes`),
  CONSTRAINT `clientes_ordenes_fk` FOREIGN KEY (`id_clientes`) REFERENCES `clientes` (`id_clientes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `monedas_ordenes_fk` FOREIGN KEY (`id_moneda`) REFERENCES `monedas` (`id_moneda`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordenes`
--

LOCK TABLES `ordenes` WRITE;
/*!40000 ALTER TABLE `ordenes` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordenes` ENABLE KEYS */;
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
