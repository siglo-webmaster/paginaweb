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
-- Table structure for table `ordenes_transportadoras`
--

DROP TABLE IF EXISTS `ordenes_transportadoras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordenes_transportadoras` (
  `id_ordenes_transportadoras` int(11) NOT NULL AUTO_INCREMENT,
  `id_transportadoras` int(11) NOT NULL,
  `id_ordenes` int(11) NOT NULL,
  `id_ciudades` int(11) DEFAULT NULL,
  `codigo_guia` varchar(255) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_actualizacion` date NOT NULL,
  `fecha_esperada_entrega` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `direccion_entrega` text NOT NULL,
  `nombre_destinatario` varchar(255) NOT NULL,
  `telefono_destinatario` varchar(20) NOT NULL,
  `email_destinatario` varchar(100) NOT NULL,
  `observaciones` varchar(512) DEFAULT NULL,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`id_ordenes_transportadoras`),
  KEY `transportadoras_ordenes_transportadoras_fk` (`id_transportadoras`),
  KEY `ordenes_ordenes_transportadoras_fk` (`id_ordenes`),
  CONSTRAINT `ordenes_ordenes_transportadoras_fk` FOREIGN KEY (`id_ordenes`) REFERENCES `ordenes` (`id_ordenes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `transportadoras_ordenes_transportadoras_fk` FOREIGN KEY (`id_transportadoras`) REFERENCES `transportadoras` (`id_transportadoras`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordenes_transportadoras`
--

LOCK TABLES `ordenes_transportadoras` WRITE;
/*!40000 ALTER TABLE `ordenes_transportadoras` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordenes_transportadoras` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-01-21 17:37:46
