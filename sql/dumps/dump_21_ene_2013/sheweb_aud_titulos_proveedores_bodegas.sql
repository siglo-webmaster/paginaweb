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
-- Table structure for table `aud_titulos_proveedores_bodegas`
--

DROP TABLE IF EXISTS `aud_titulos_proveedores_bodegas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aud_titulos_proveedores_bodegas` (
  `id_aud_titulos_proveedores_bodegas` int(11) NOT NULL AUTO_INCREMENT,
  `id_proveedores` int(11) DEFAULT NULL,
  `id_titulos` int(11) DEFAULT NULL,
  `id_bodegas` int(11) DEFAULT NULL,
  `stock_inicial` int(11) DEFAULT NULL,
  `stock_final` int(11) DEFAULT NULL,
  `reservado_inicial` int(11) DEFAULT NULL,
  `reservado_final` int(11) DEFAULT NULL,
  `fecha_proceso` timestamp NULL DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `sql1` text,
  `codigo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_aud_titulos_proveedores_bodegas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aud_titulos_proveedores_bodegas`
--

LOCK TABLES `aud_titulos_proveedores_bodegas` WRITE;
/*!40000 ALTER TABLE `aud_titulos_proveedores_bodegas` DISABLE KEYS */;
/*!40000 ALTER TABLE `aud_titulos_proveedores_bodegas` ENABLE KEYS */;
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
