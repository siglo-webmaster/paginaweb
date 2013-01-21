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
-- Table structure for table `bodegas_movimientos`
--

DROP TABLE IF EXISTS `bodegas_movimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bodegas_movimientos` (
  `id_bodegas_movimientos` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_proveedores` int(11) NOT NULL,
  `id_bodegas` int(11) NOT NULL,
  `id_titulos` int(11) NOT NULL,
  `id_tipos_movimientos_bodega` int(11) NOT NULL,
  `id_usuarios` int(11) NOT NULL,
  `id_bodegas_origen` int(11) DEFAULT NULL,
  `id_estado_stock_origen` int(11) DEFAULT NULL,
  `stock_inicial_origen` int(11) DEFAULT NULL,
  `stock_final_origen` int(11) DEFAULT NULL,
  `id_bodegas_destino` int(11) DEFAULT NULL,
  `id_estado_stock_destino` int(11) DEFAULT NULL,
  `numero_documento` int(11) NOT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `observaciones` varchar(45) DEFAULT NULL,
  `stock_inicial_destino` int(11) DEFAULT NULL,
  `stock_final_destino` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_bodegas_movimientos`),
  KEY `fk_bodegas_movimientos_tipos_movimientos_bodega1` (`id_tipos_movimientos_bodega`),
  KEY `fk_bodegas_movimientos_titulos_proveedores_bodegas1` (`id_proveedores`,`id_titulos`,`id_bodegas`),
  KEY `fk_bodegas_movimientos_usuarios1` (`id_usuarios`),
  KEY `fk_bodegas_movimientos_estado_stock1` (`id_estado_stock_origen`),
  KEY `fk_bodegas_movimientos_estado_stock2` (`id_estado_stock_destino`),
  KEY `fk_bodegas_movimientos_bodegas1` (`id_bodegas_origen`),
  KEY `fk_bodegas_movimientos_bodegas2` (`id_bodegas_destino`),
  CONSTRAINT `fk_bodegas_movimientos_bodegas1` FOREIGN KEY (`id_bodegas_origen`) REFERENCES `bodegas` (`id_bodegas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_bodegas_movimientos_bodegas2` FOREIGN KEY (`id_bodegas_destino`) REFERENCES `bodegas` (`id_bodegas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_bodegas_movimientos_estado_stock1` FOREIGN KEY (`id_estado_stock_origen`) REFERENCES `estado_stock` (`id_estado_stock`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_bodegas_movimientos_estado_stock2` FOREIGN KEY (`id_estado_stock_destino`) REFERENCES `estado_stock` (`id_estado_stock`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_bodegas_movimientos_tipos_movimientos_bodega1` FOREIGN KEY (`id_tipos_movimientos_bodega`) REFERENCES `tipos_movimientos_bodega` (`id_tipos_movimientos_bodega`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_bodegas_movimientos_titulos_proveedores_bodegas1` FOREIGN KEY (`id_proveedores`, `id_titulos`, `id_bodegas`) REFERENCES `stock` (`id_proveedores`, `id_titulos`, `id_bodegas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_bodegas_movimientos_usuarios1` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bodegas_movimientos`
--

LOCK TABLES `bodegas_movimientos` WRITE;
/*!40000 ALTER TABLE `bodegas_movimientos` DISABLE KEYS */;
/*!40000 ALTER TABLE `bodegas_movimientos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-01-21  8:19:36
