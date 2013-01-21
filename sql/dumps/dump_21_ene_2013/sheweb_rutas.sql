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
-- Table structure for table `rutas`
--

DROP TABLE IF EXISTS `rutas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rutas` (
  `id_rutas` int(11) NOT NULL,
  `id_usuarios_creacion` int(11) NOT NULL,
  `tipos_estados_rutas_id_tipos_estados_rutas` int(11) NOT NULL,
  `tipos_prioridades_rutas_id_tipos_prioridades_rutas` int(11) NOT NULL,
  `id_terceros_clientes` int(11) NOT NULL,
  `id_terceros_vendedor` int(11) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `fecha_vencimiento` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_rutas`),
  KEY `fk_rutas_usuarios1` (`id_usuarios_creacion`),
  KEY `fk_rutas_estados_rutas1` (`tipos_estados_rutas_id_tipos_estados_rutas`),
  KEY `fk_rutas_tipos_prioridades_rutas1` (`tipos_prioridades_rutas_id_tipos_prioridades_rutas`),
  KEY `fk_rutas_terceros1` (`id_terceros_clientes`),
  KEY `fk_rutas_terceros2` (`id_terceros_vendedor`),
  CONSTRAINT `fk_rutas_estados_rutas1` FOREIGN KEY (`tipos_estados_rutas_id_tipos_estados_rutas`) REFERENCES `tipos_estados_rutas` (`id_tipos_estados_rutas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_rutas_terceros1` FOREIGN KEY (`id_terceros_clientes`) REFERENCES `terceros` (`id_terceros`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_rutas_terceros2` FOREIGN KEY (`id_terceros_vendedor`) REFERENCES `terceros` (`id_terceros`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_rutas_tipos_prioridades_rutas1` FOREIGN KEY (`tipos_prioridades_rutas_id_tipos_prioridades_rutas`) REFERENCES `tipos_prioridades_rutas` (`id_tipos_prioridades_rutas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_rutas_usuarios1` FOREIGN KEY (`id_usuarios_creacion`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rutas`
--

LOCK TABLES `rutas` WRITE;
/*!40000 ALTER TABLE `rutas` DISABLE KEYS */;
/*!40000 ALTER TABLE `rutas` ENABLE KEYS */;
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