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
-- Table structure for table `ordenes_compra_detalles_bodegas_movimientos`
--

DROP TABLE IF EXISTS `ordenes_compra_detalles_bodegas_movimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordenes_compra_detalles_bodegas_movimientos` (
  `id_ordenes_compra_detalles` bigint(20) NOT NULL,
  `id_bodegas_movimientos` bigint(20) NOT NULL,
  PRIMARY KEY (`id_ordenes_compra_detalles`,`id_bodegas_movimientos`),
  KEY `fk_ordenes_compra_detalles_bodegas_movimientos_bodegas_movimi1` (`id_bodegas_movimientos`),
  KEY `fk_ordenes_compra_detalles_bodegas_movimientos_ordenes_compra1` (`id_ordenes_compra_detalles`),
  CONSTRAINT `fk_ordenes_compra_detalles_bodegas_movimientos_bodegas_movimi1` FOREIGN KEY (`id_bodegas_movimientos`) REFERENCES `bodegas_movimientos` (`id_bodegas_movimientos`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ordenes_compra_detalles_bodegas_movimientos_ordenes_compra1` FOREIGN KEY (`id_ordenes_compra_detalles`) REFERENCES `ordenes_compra_detalles` (`id_ordenes_compra_detalles`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordenes_compra_detalles_bodegas_movimientos`
--

LOCK TABLES `ordenes_compra_detalles_bodegas_movimientos` WRITE;
/*!40000 ALTER TABLE `ordenes_compra_detalles_bodegas_movimientos` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordenes_compra_detalles_bodegas_movimientos` ENABLE KEYS */;
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
