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
-- Table structure for table `stock_request_items_ordenes_compra`
--

DROP TABLE IF EXISTS `stock_request_items_ordenes_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_request_items_ordenes_compra` (
  `id_stock_request_items` int(11) NOT NULL,
  `id_ordenes_compra` int(11) NOT NULL,
  `stock_id_proveedores` int(11) NOT NULL,
  `stock_id_titulos` int(11) NOT NULL,
  `stock_id_bodegas` int(11) NOT NULL,
  `stock_id_estado_stock` int(11) NOT NULL,
  `cantidad_recibida` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_stock_request_items`,`id_ordenes_compra`,`stock_id_proveedores`,`stock_id_titulos`,`stock_id_bodegas`,`stock_id_estado_stock`),
  KEY `fk_stock_request_items_ordenes_compra_ordenes_compra1` (`id_ordenes_compra`),
  KEY `fk_stock_request_items_ordenes_compra_stock_request_items1` (`id_stock_request_items`),
  KEY `fk_stock_request_items_ordenes_compra_stock1` (`stock_id_proveedores`,`stock_id_titulos`,`stock_id_bodegas`,`stock_id_estado_stock`),
  CONSTRAINT `fk_stock_request_items_ordenes_compra_ordenes_compra1` FOREIGN KEY (`id_ordenes_compra`) REFERENCES `ordenes_compra` (`id_ordenes_compra`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_stock_request_items_ordenes_compra_stock1` FOREIGN KEY (`stock_id_proveedores`, `stock_id_titulos`, `stock_id_bodegas`, `stock_id_estado_stock`) REFERENCES `stock` (`id_proveedores`, `id_titulos`, `id_bodegas`, `id_estado_stock`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_stock_request_items_ordenes_compra_stock_request_items1` FOREIGN KEY (`id_stock_request_items`) REFERENCES `pedidosproveedores_detalle` (`id_pedidosproveedores_detalle`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_request_items_ordenes_compra`
--

LOCK TABLES `stock_request_items_ordenes_compra` WRITE;
/*!40000 ALTER TABLE `stock_request_items_ordenes_compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_request_items_ordenes_compra` ENABLE KEYS */;
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
