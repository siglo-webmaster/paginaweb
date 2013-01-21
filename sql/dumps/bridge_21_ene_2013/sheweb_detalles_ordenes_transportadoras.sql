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
-- Table structure for table `detalles_ordenes_transportadoras`
--

DROP TABLE IF EXISTS `detalles_ordenes_transportadoras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalles_ordenes_transportadoras` (
  `id_detalles_ordenes_transportadoras` int(11) NOT NULL AUTO_INCREMENT,
  `id_ordenes_transportadoras` int(11) NOT NULL,
  `id_titulos` int(11) NOT NULL,
  `id_tipos_productos` int(11) NOT NULL,
  `id_proveedores` int(11) NOT NULL,
  `codigo_producto` varchar(100) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `cantidad` decimal(10,0) NOT NULL,
  `estado` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_detalles_ordenes_transportadoras`,`id_titulos`,`id_tipos_productos`,`id_proveedores`),
  KEY `ordenes_transportadoras_detalles_ordenes_transportadoras_fk` (`id_ordenes_transportadoras`),
  KEY `fk_detalles_ordenes_transportadoras_tipos_productos1` (`id_tipos_productos`),
  KEY `fk_detalles_ordenes_transportadoras_proveedores1` (`id_proveedores`),
  KEY `fk_detalles_ordenes_transportadoras_titulos1` (`id_titulos`),
  CONSTRAINT `fk_detalles_ordenes_transportadoras_proveedores1` FOREIGN KEY (`id_proveedores`) REFERENCES `proveedores` (`id_proveedores`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalles_ordenes_transportadoras_tipos_productos1` FOREIGN KEY (`id_tipos_productos`) REFERENCES `tipos_productos` (`id_tipos_productos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalles_ordenes_transportadoras_titulos1` FOREIGN KEY (`id_titulos`) REFERENCES `titulos` (`id_titulos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ordenes_transportadoras_detalles_ordenes_transportadoras_fk` FOREIGN KEY (`id_ordenes_transportadoras`) REFERENCES `ordenes_transportadoras` (`id_ordenes_transportadoras`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_ordenes_transportadoras`
--

LOCK TABLES `detalles_ordenes_transportadoras` WRITE;
/*!40000 ALTER TABLE `detalles_ordenes_transportadoras` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalles_ordenes_transportadoras` ENABLE KEYS */;
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
