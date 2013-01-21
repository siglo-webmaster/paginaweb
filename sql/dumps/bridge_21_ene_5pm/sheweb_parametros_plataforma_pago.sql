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
-- Table structure for table `parametros_plataforma_pago`
--

DROP TABLE IF EXISTS `parametros_plataforma_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parametros_plataforma_pago` (
  `id_param` int(11) NOT NULL AUTO_INCREMENT,
  `id_plataforma_pago` int(11) NOT NULL,
  `key_1` varchar(50) NOT NULL,
  `value` varchar(512) NOT NULL,
  PRIMARY KEY (`id_param`),
  KEY `plataforma_pago_parametros_plataforma_pago_fk` (`id_plataforma_pago`),
  CONSTRAINT `plataforma_pago_parametros_plataforma_pago_fk` FOREIGN KEY (`id_plataforma_pago`) REFERENCES `plataforma_pago` (`id_plataforma_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parametros_plataforma_pago`
--

LOCK TABLES `parametros_plataforma_pago` WRITE;
/*!40000 ALTER TABLE `parametros_plataforma_pago` DISABLE KEYS */;
INSERT INTO `parametros_plataforma_pago` VALUES (1,1,'usuarioId','11767'),(2,1,'refVenta',''),(3,1,'url_confirmacion','http://www.recycler.com.co/pagosonline/paginaConfirmacion.php'),(4,1,'url_respuesta','http://www.recycler.com.co/pagosonline/paginaRespuesta.php'),(5,1,'descripcion',''),(6,1,'telefonoMovil',''),(7,1,'documentoIdentificacion',''),(8,1,'nombreComprador',''),(9,1,'emailComprador',''),(10,1,'valor',''),(11,1,'iva',''),(12,1,'baseDevolucionIva',''),(13,1,'prueba','1'),(14,1,'firma',''),(15,2,'usuarioId','11767'),(16,2,'refVenta',''),(17,2,'url_confirmacion','http://www.recycler.com.co/pagosonline/paginaConfirmacion.php'),(18,2,'url_respuesta','http://www.recycler.com.co/pagosonline/paginaRespuesta.php'),(19,2,'descripcion',''),(20,2,'telefonoMovil',''),(21,2,'documentoIdentificacion',''),(22,2,'nombreComprador',''),(23,2,'emailComprador',''),(24,2,'valor',''),(25,2,'iva',''),(26,2,'baseDevolucionIva',''),(27,2,'prueba','1'),(28,2,'firma','');
/*!40000 ALTER TABLE `parametros_plataforma_pago` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-01-21 17:37:45
