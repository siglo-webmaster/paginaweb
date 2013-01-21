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
-- Table structure for table `rutas_asignacion_separacion`
--

DROP TABLE IF EXISTS `rutas_asignacion_separacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rutas_asignacion_separacion` (
  `rutas_id_rutas` int(11) NOT NULL,
  `usuarios_id_usuarios` int(11) NOT NULL,
  `rutas_items_separacion_id_rutas_items_separacion` bigint(20) NOT NULL,
  PRIMARY KEY (`rutas_items_separacion_id_rutas_items_separacion`,`rutas_id_rutas`,`usuarios_id_usuarios`),
  KEY `fk_rutas_asignacion_separacion_rutas1` (`rutas_id_rutas`),
  KEY `fk_rutas_asignacion_separacion_usuarios1` (`usuarios_id_usuarios`),
  KEY `fk_rutas_asignacion_separacion_rutas_items_separacion1` (`rutas_items_separacion_id_rutas_items_separacion`),
  CONSTRAINT `fk_rutas_asignacion_separacion_rutas1` FOREIGN KEY (`rutas_id_rutas`) REFERENCES `rutas` (`id_rutas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_rutas_asignacion_separacion_rutas_items_separacion1` FOREIGN KEY (`rutas_items_separacion_id_rutas_items_separacion`) REFERENCES `rutas_items_separacion` (`id_rutas_items_separacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_rutas_asignacion_separacion_usuarios1` FOREIGN KEY (`usuarios_id_usuarios`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rutas_asignacion_separacion`
--

LOCK TABLES `rutas_asignacion_separacion` WRITE;
/*!40000 ALTER TABLE `rutas_asignacion_separacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `rutas_asignacion_separacion` ENABLE KEYS */;
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