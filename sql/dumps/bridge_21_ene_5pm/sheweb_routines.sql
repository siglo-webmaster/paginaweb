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
-- Temporary table structure for view `view_destacados_titulos_editoriales_destacados`
--

DROP TABLE IF EXISTS `view_destacados_titulos_editoriales_destacados`;
/*!50001 DROP VIEW IF EXISTS `view_destacados_titulos_editoriales_destacados`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_destacados_titulos_editoriales_destacados` (
  `id_destacados` tinyint NOT NULL,
  `id_titulos` tinyint NOT NULL,
  `id_editoriales` tinyint NOT NULL,
  `sel` tinyint NOT NULL,
  `titulo` tinyint NOT NULL,
  `codigo` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_ordenes_productos_proveedores`
--

DROP TABLE IF EXISTS `view_ordenes_productos_proveedores`;
/*!50001 DROP VIEW IF EXISTS `view_ordenes_productos_proveedores`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_ordenes_productos_proveedores` (
  `id_ordenes` tinyint NOT NULL,
  `id_titulos` tinyint NOT NULL,
  `id_tipos_productos` tinyint NOT NULL,
  `id_proveedores` tinyint NOT NULL,
  `codigo_producto` tinyint NOT NULL,
  `nombre_producto` tinyint NOT NULL,
  `cantidad` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_ordenes_ordenes_plataforma_pago`
--

DROP TABLE IF EXISTS `view_ordenes_ordenes_plataforma_pago`;
/*!50001 DROP VIEW IF EXISTS `view_ordenes_ordenes_plataforma_pago`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_ordenes_ordenes_plataforma_pago` (
  `id_ordenes` tinyint NOT NULL,
  `estado_pago` tinyint NOT NULL,
  `estado_orden` tinyint NOT NULL,
  `id_ordenes_plataforma_pago` tinyint NOT NULL,
  `inicio_proceso` tinyint NOT NULL,
  `fin_proceso` tinyint NOT NULL,
  `ip` tinyint NOT NULL,
  `estado` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_destacados_titulos_categorias_destacados`
--

DROP TABLE IF EXISTS `view_destacados_titulos_categorias_destacados`;
/*!50001 DROP VIEW IF EXISTS `view_destacados_titulos_categorias_destacados`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_destacados_titulos_categorias_destacados` (
  `id_destacados` tinyint NOT NULL,
  `id_titulos` tinyint NOT NULL,
  `id_categorias` tinyint NOT NULL,
  `sel` tinyint NOT NULL,
  `titulo` tinyint NOT NULL,
  `codigo` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_destacados_titulos_destacados`
--

DROP TABLE IF EXISTS `view_destacados_titulos_destacados`;
/*!50001 DROP VIEW IF EXISTS `view_destacados_titulos_destacados`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_destacados_titulos_destacados` (
  `id_titulos_destacados` tinyint NOT NULL,
  `id_titulos` tinyint NOT NULL,
  `id_destacados` tinyint NOT NULL,
  `titulo` tinyint NOT NULL,
  `codigo` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_destacados_titulos_autores_destacados`
--

DROP TABLE IF EXISTS `view_destacados_titulos_autores_destacados`;
/*!50001 DROP VIEW IF EXISTS `view_destacados_titulos_autores_destacados`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_destacados_titulos_autores_destacados` (
  `id_destacados` tinyint NOT NULL,
  `id_titulos` tinyint NOT NULL,
  `id_autores` tinyint NOT NULL,
  `sel` tinyint NOT NULL,
  `titulo` tinyint NOT NULL,
  `codigo` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_destacados_titulos_eventos_destacados`
--

DROP TABLE IF EXISTS `view_destacados_titulos_eventos_destacados`;
/*!50001 DROP VIEW IF EXISTS `view_destacados_titulos_eventos_destacados`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_destacados_titulos_eventos_destacados` (
  `id_destacados` tinyint NOT NULL,
  `id_eventos` tinyint NOT NULL,
  `id_titulos` tinyint NOT NULL,
  `sel` tinyint NOT NULL,
  `titulo` tinyint NOT NULL,
  `codigo` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_usuarios_grupos_modulos`
--

DROP TABLE IF EXISTS `view_usuarios_grupos_modulos`;
/*!50001 DROP VIEW IF EXISTS `view_usuarios_grupos_modulos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_usuarios_grupos_modulos` (
  `id_usuarios` tinyint NOT NULL,
  `nombre_grupo_usuarios` tinyint NOT NULL,
  `estado_grupos_usuarios` tinyint NOT NULL,
  `id_modulos` tinyint NOT NULL,
  `nombre_modulo` tinyint NOT NULL,
  `estado_modulo` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_ordenes_transportadoras_ciudad`
--

DROP TABLE IF EXISTS `view_ordenes_transportadoras_ciudad`;
/*!50001 DROP VIEW IF EXISTS `view_ordenes_transportadoras_ciudad`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_ordenes_transportadoras_ciudad` (
  `transportadora` tinyint NOT NULL,
  `pais` tinyint NOT NULL,
  `ciudad` tinyint NOT NULL,
  `id_ordenes` tinyint NOT NULL,
  `valor` tinyint NOT NULL,
  `nombre_corto` tinyint NOT NULL,
  `fletes` tinyint NOT NULL,
  `impuestos` tinyint NOT NULL,
  `descuentos` tinyint NOT NULL,
  `id_ordenes_plataforma_pago` tinyint NOT NULL,
  `plataforma_pago` tinyint NOT NULL,
  `fin_proceso` tinyint NOT NULL,
  `id_ordenes_transportadoras` tinyint NOT NULL,
  `direccion_entrega` tinyint NOT NULL,
  `nombre_destinatario` tinyint NOT NULL,
  `telefono_destinatario` tinyint NOT NULL,
  `email_destinatario` tinyint NOT NULL,
  `observaciones` tinyint NOT NULL,
  `estado` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_ordenes_cliente_moneda`
--

DROP TABLE IF EXISTS `view_ordenes_cliente_moneda`;
/*!50001 DROP VIEW IF EXISTS `view_ordenes_cliente_moneda`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_ordenes_cliente_moneda` (
  `id_clientes` tinyint NOT NULL,
  `nit` tinyint NOT NULL,
  `nombre` tinyint NOT NULL,
  `direccion` tinyint NOT NULL,
  `telefono` tinyint NOT NULL,
  `email` tinyint NOT NULL,
  `id_ordenes` tinyint NOT NULL,
  `fecha_creacion` tinyint NOT NULL,
  `fecha_pedido` tinyint NOT NULL,
  `fecha_despacho` tinyint NOT NULL,
  `fecha_entrega` tinyint NOT NULL,
  `estado_pago` tinyint NOT NULL,
  `estado_despacho` tinyint NOT NULL,
  `valor` tinyint NOT NULL,
  `peso` tinyint NOT NULL,
  `estado_orden` tinyint NOT NULL,
  `fletes` tinyint NOT NULL,
  `observaciones` tinyint NOT NULL,
  `moneda` tinyint NOT NULL,
  `tasa_actual` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_titulos_destacados`
--

DROP TABLE IF EXISTS `view_titulos_destacados`;
/*!50001 DROP VIEW IF EXISTS `view_titulos_destacados`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_titulos_destacados` (
  `id_destacados` tinyint NOT NULL,
  `id_tipos_destacados` tinyint NOT NULL,
  `tipos_destacados_nombre` tinyint NOT NULL,
  `inicio` tinyint NOT NULL,
  `fin` tinyint NOT NULL,
  `descuento` tinyint NOT NULL,
  `observaciones` tinyint NOT NULL,
  `estado` tinyint NOT NULL,
  `id_titulos` tinyint NOT NULL,
  `id_lista_precios` tinyint NOT NULL,
  `id_proveedores` tinyint NOT NULL,
  `id_tipos_productos` tinyint NOT NULL,
  `precio` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `view_destacados_titulos_editoriales_destacados`
--

/*!50001 DROP TABLE IF EXISTS `view_destacados_titulos_editoriales_destacados`*/;
/*!50001 DROP VIEW IF EXISTS `view_destacados_titulos_editoriales_destacados`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`192.168.16.4` SQL SECURITY DEFINER */
/*!50001 VIEW `view_destacados_titulos_editoriales_destacados` AS select `td`.`id_destacados` AS `id_destacados`,`td`.`id_titulos` AS `id_titulos`,`td`.`id_editoriales` AS `id_editoriales`,`td`.`id_editoriales` AS `sel`,`ta`.`valor` AS `titulo`,`tp`.`codigo` AS `codigo` from ((`titulos_editoriales_destacados` `td` join `titulos_atributos` `ta` on((`ta`.`id_titulos` = `td`.`id_titulos`))) join `titulos_proveedores` `tp` on((`tp`.`id_titulos` = `td`.`id_titulos`))) where (`ta`.`llave` = 'titulo') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_ordenes_productos_proveedores`
--

/*!50001 DROP TABLE IF EXISTS `view_ordenes_productos_proveedores`*/;
/*!50001 DROP VIEW IF EXISTS `view_ordenes_productos_proveedores`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`192.168.16.4` SQL SECURITY DEFINER */
/*!50001 VIEW `view_ordenes_productos_proveedores` AS select `op`.`id_ordenes` AS `id_ordenes`,`op`.`id_titulos` AS `id_titulos`,`op`.`id_tipos_productos` AS `id_tipos_productos`,`op`.`id_proveedores` AS `id_proveedores`,`tp`.`codigo` AS `codigo_producto`,`op`.`nombre_producto` AS `nombre_producto`,`op`.`cantidad` AS `cantidad` from (`ordenes_productos` `op` join `titulos_proveedores` `tp` on(((`tp`.`id_titulos` = `op`.`id_titulos`) and (`tp`.`id_proveedores` = `op`.`id_proveedores`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_ordenes_ordenes_plataforma_pago`
--

/*!50001 DROP TABLE IF EXISTS `view_ordenes_ordenes_plataforma_pago`*/;
/*!50001 DROP VIEW IF EXISTS `view_ordenes_ordenes_plataforma_pago`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`192.168.16.4` SQL SECURITY DEFINER */
/*!50001 VIEW `view_ordenes_ordenes_plataforma_pago` AS select `o`.`id_ordenes` AS `id_ordenes`,`o`.`estado_pago` AS `estado_pago`,`o`.`estado_orden` AS `estado_orden`,`opp`.`id_ordenes_plataforma_pago` AS `id_ordenes_plataforma_pago`,`opp`.`inicio_proceso` AS `inicio_proceso`,`opp`.`fin_proceso` AS `fin_proceso`,`opp`.`ip` AS `ip`,`opp`.`estado` AS `estado` from (`ordenes` `o` join `ordenes_plataforma_pago` `opp` on((`o`.`id_ordenes` = `opp`.`id_ordenes`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_destacados_titulos_categorias_destacados`
--

/*!50001 DROP TABLE IF EXISTS `view_destacados_titulos_categorias_destacados`*/;
/*!50001 DROP VIEW IF EXISTS `view_destacados_titulos_categorias_destacados`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`192.168.16.4` SQL SECURITY DEFINER */
/*!50001 VIEW `view_destacados_titulos_categorias_destacados` AS select `td`.`id_destacados` AS `id_destacados`,`td`.`id_titulos` AS `id_titulos`,`td`.`id_categorias` AS `id_categorias`,`td`.`id_categorias` AS `sel`,`ta`.`valor` AS `titulo`,`tp`.`codigo` AS `codigo` from ((`titulos_categorias_destacados` `td` join `titulos_atributos` `ta` on((`ta`.`id_titulos` = `td`.`id_titulos`))) join `titulos_proveedores` `tp` on((`tp`.`id_titulos` = `td`.`id_titulos`))) where (`ta`.`llave` = 'titulo') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_destacados_titulos_destacados`
--

/*!50001 DROP TABLE IF EXISTS `view_destacados_titulos_destacados`*/;
/*!50001 DROP VIEW IF EXISTS `view_destacados_titulos_destacados`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`192.168.16.4` SQL SECURITY DEFINER */
/*!50001 VIEW `view_destacados_titulos_destacados` AS select `td`.`id_titulos_destacados` AS `id_titulos_destacados`,`td`.`id_titulos` AS `id_titulos`,`td`.`id_destacados` AS `id_destacados`,`ta`.`valor` AS `titulo`,`tp`.`codigo` AS `codigo` from ((`titulos_destacados` `td` join `titulos_atributos` `ta` on((`ta`.`id_titulos` = `td`.`id_titulos`))) join `titulos_proveedores` `tp` on((`tp`.`id_titulos` = `td`.`id_titulos`))) where (`ta`.`llave` = 'titulo') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_destacados_titulos_autores_destacados`
--

/*!50001 DROP TABLE IF EXISTS `view_destacados_titulos_autores_destacados`*/;
/*!50001 DROP VIEW IF EXISTS `view_destacados_titulos_autores_destacados`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`192.168.16.4` SQL SECURITY DEFINER */
/*!50001 VIEW `view_destacados_titulos_autores_destacados` AS select `td`.`id_destacados` AS `id_destacados`,`td`.`id_titulos` AS `id_titulos`,`td`.`id_autores` AS `id_autores`,`td`.`id_autores` AS `sel`,`ta`.`valor` AS `titulo`,`tp`.`codigo` AS `codigo` from ((`titulos_autores_destacados` `td` join `titulos_atributos` `ta` on((`ta`.`id_titulos` = `td`.`id_titulos`))) join `titulos_proveedores` `tp` on((`tp`.`id_titulos` = `td`.`id_titulos`))) where (`ta`.`llave` = 'titulo') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_destacados_titulos_eventos_destacados`
--

/*!50001 DROP TABLE IF EXISTS `view_destacados_titulos_eventos_destacados`*/;
/*!50001 DROP VIEW IF EXISTS `view_destacados_titulos_eventos_destacados`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`192.168.16.4` SQL SECURITY DEFINER */
/*!50001 VIEW `view_destacados_titulos_eventos_destacados` AS select `td`.`id_destacados` AS `id_destacados`,`td`.`id_eventos` AS `id_eventos`,`td`.`id_titulos` AS `id_titulos`,`td`.`id_eventos` AS `sel`,`ta`.`valor` AS `titulo`,`tp`.`codigo` AS `codigo` from ((`titulos_eventos_destacados` `td` join `titulos_atributos` `ta` on((`ta`.`id_titulos` = `td`.`id_titulos`))) join `titulos_proveedores` `tp` on((`tp`.`id_titulos` = `td`.`id_titulos`))) where (`ta`.`llave` = 'titulo') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_usuarios_grupos_modulos`
--

/*!50001 DROP TABLE IF EXISTS `view_usuarios_grupos_modulos`*/;
/*!50001 DROP VIEW IF EXISTS `view_usuarios_grupos_modulos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`192.168.16.4` SQL SECURITY DEFINER */
/*!50001 VIEW `view_usuarios_grupos_modulos` AS select `u`.`id_usuarios` AS `id_usuarios`,`gu`.`nombre` AS `nombre_grupo_usuarios`,`gu`.`estado` AS `estado_grupos_usuarios`,`m`.`id_modulos` AS `id_modulos`,`m`.`nombre` AS `nombre_modulo`,`m`.`estado` AS `estado_modulo` from ((((`usuarios` `u` join `usuarios_grupos_usuarios` `ugu` on((`ugu`.`id_usuarios` = `u`.`id_usuarios`))) join `grupos_usuarios` `gu` on((`gu`.`id_grupos_usuarios` = `ugu`.`id_grupos_usuarios`))) join `modulos_grupos_usuarios` `mgu` on((`mgu`.`id_grupos_usuarios` = `gu`.`id_grupos_usuarios`))) join `modulos` `m` on((`m`.`id_modulos` = `mgu`.`id_modulos`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_ordenes_transportadoras_ciudad`
--

/*!50001 DROP TABLE IF EXISTS `view_ordenes_transportadoras_ciudad`*/;
/*!50001 DROP VIEW IF EXISTS `view_ordenes_transportadoras_ciudad`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`192.168.16.4` SQL SECURITY DEFINER */
/*!50001 VIEW `view_ordenes_transportadoras_ciudad` AS select `t`.`nombre` AS `transportadora`,`p`.`nombre` AS `pais`,`c`.`nombre` AS `ciudad`,`ot`.`id_ordenes` AS `id_ordenes`,`o`.`valor` AS `valor`,`m`.`nombre_corto` AS `nombre_corto`,`o`.`fletes` AS `fletes`,`o`.`impuestos` AS `impuestos`,`o`.`descuentos` AS `descuentos`,`opp`.`id_ordenes_plataforma_pago` AS `id_ordenes_plataforma_pago`,`pp`.`nombre` AS `plataforma_pago`,`opp`.`fin_proceso` AS `fin_proceso`,`ot`.`id_ordenes_transportadoras` AS `id_ordenes_transportadoras`,`ot`.`direccion_entrega` AS `direccion_entrega`,`ot`.`nombre_destinatario` AS `nombre_destinatario`,`ot`.`telefono_destinatario` AS `telefono_destinatario`,`ot`.`email_destinatario` AS `email_destinatario`,`ot`.`observaciones` AS `observaciones`,`ot`.`estado` AS `estado` from (((((((`ordenes_transportadoras` `ot` join `ordenes` `o` on((`o`.`id_ordenes` = `ot`.`id_ordenes`))) join `monedas` `m` on((`m`.`id_moneda` = `o`.`id_moneda`))) join `transportadoras` `t` on((`t`.`id_transportadoras` = `ot`.`id_transportadoras`))) join `ciudades` `c` on((`c`.`id_ciudades` = `ot`.`id_ciudades`))) join `paises` `p` on((`p`.`id_paises` = `c`.`id_paises`))) join `ordenes_plataforma_pago` `opp` on(((`opp`.`id_ordenes` = `ot`.`id_ordenes`) and (`opp`.`estado` = 'PagoAprobado')))) join `plataforma_pago` `pp` on((`pp`.`id_plataforma_pago` = `opp`.`id_plataforma_pago`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_ordenes_cliente_moneda`
--

/*!50001 DROP TABLE IF EXISTS `view_ordenes_cliente_moneda`*/;
/*!50001 DROP VIEW IF EXISTS `view_ordenes_cliente_moneda`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`192.168.16.4` SQL SECURITY DEFINER */
/*!50001 VIEW `view_ordenes_cliente_moneda` AS select `clientes`.`id_clientes` AS `id_clientes`,`clientes`.`nit` AS `nit`,`clientes`.`nombre` AS `nombre`,`clientes`.`direccion` AS `direccion`,`clientes`.`telefono` AS `telefono`,`clientes`.`email` AS `email`,`ordenes`.`id_ordenes` AS `id_ordenes`,`ordenes`.`fecha_creacion` AS `fecha_creacion`,`ordenes`.`fecha_pedido` AS `fecha_pedido`,`ordenes`.`fecha_despacho` AS `fecha_despacho`,`ordenes`.`fecha_entrega` AS `fecha_entrega`,`ordenes`.`estado_pago` AS `estado_pago`,`ordenes`.`estado_despacho` AS `estado_despacho`,`ordenes`.`valor` AS `valor`,`ordenes`.`peso` AS `peso`,`ordenes`.`estado_orden` AS `estado_orden`,`ordenes`.`fletes` AS `fletes`,`ordenes`.`observaciones` AS `observaciones`,`monedas`.`nombre_corto` AS `moneda`,`monedas`.`tasa_actual` AS `tasa_actual` from ((`clientes` join `ordenes` on((`ordenes`.`id_clientes` = `clientes`.`id_clientes`))) join `monedas` on((`monedas`.`id_moneda` = `ordenes`.`id_moneda`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_titulos_destacados`
--

/*!50001 DROP TABLE IF EXISTS `view_titulos_destacados`*/;
/*!50001 DROP VIEW IF EXISTS `view_titulos_destacados`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`192.168.16.4` SQL SECURITY DEFINER */
/*!50001 VIEW `view_titulos_destacados` AS select `d`.`id_destacados` AS `id_destacados`,`d`.`id_tipos_destacados` AS `id_tipos_destacados`,`td`.`nombre` AS `tipos_destacados_nombre`,`d`.`inicio` AS `inicio`,`d`.`fin` AS `fin`,`d`.`descuento` AS `descuento`,`d`.`observaciones` AS `observaciones`,`d`.`estado` AS `estado`,`tlp`.`id_titulos` AS `id_titulos`,`tlp`.`id_lista_precios` AS `id_lista_precios`,`tlp`.`id_proveedores` AS `id_proveedores`,`tlp`.`id_tipos_productos` AS `id_tipos_productos`,`tlp`.`precio` AS `precio` from (((`destacados` `d` join `tipos_destacados` `td` on((`td`.`id_tipos_destacados` = `d`.`id_tipos_destacados`))) join `titulos_destacados` `tid` on((`tid`.`id_destacados` = `d`.`id_destacados`))) join `titulos_lista_precios` `tlp` on((`tlp`.`id_titulos` = `tid`.`id_titulos`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-01-21 17:38:43
