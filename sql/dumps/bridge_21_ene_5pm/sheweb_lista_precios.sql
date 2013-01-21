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
-- Table structure for table `lista_precios`
--

DROP TABLE IF EXISTS `lista_precios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lista_precios` (
  `id_lista_precios` int(11) NOT NULL AUTO_INCREMENT,
  `id_moneda` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha_fin` date NOT NULL,
  `fecha_inicio` date NOT NULL,
  `estado` varchar(15) NOT NULL,
  PRIMARY KEY (`id_lista_precios`),
  KEY `monedas_lista_precios_fk` (`id_moneda`),
  CONSTRAINT `monedas_lista_precios_fk` FOREIGN KEY (`id_moneda`) REFERENCES `monedas` (`id_moneda`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lista_precios`
--

LOCK TABLES `lista_precios` WRITE;
/*!40000 ALTER TABLE `lista_precios` DISABLE KEYS */;
INSERT INTO `lista_precios` VALUES (1,1,'Impreso SHE 2012 Pesos','2012-12-31','2012-01-01','activo'),(2,2,'Impreso SHE 2012 Euros','2012-12-31','2012-01-01','activo'),(3,3,'Impreso SHE 2012 Dolares','2012-12-31','2012-01-01','activo'),(4,1,'E-Books 2012 Pesos','2012-12-31','2012-01-01','activo'),(5,2,'E-Books 2012 Euros','2012-12-31','2012-01-01','activo'),(6,3,'E-Books 2012 Dolares','2012-12-31','2012-01-01','activo'),(7,1,'POD 2012 Pesos','2012-12-31','2012-01-01','activo'),(8,2,'POD 2012 Euros','2012-12-31','2012-01-01','activo'),(9,3,'POD 2012 Dolares','2012-12-31','2012-01-01','activo');
/*!40000 ALTER TABLE `lista_precios` ENABLE KEYS */;
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
