-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.9-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema moviliaria
--

CREATE DATABASE IF NOT EXISTS moviliaria;
USE moviliaria;

--
-- Definition of table `acuerdo`
--

DROP TABLE IF EXISTS `acuerdo`;
CREATE TABLE `acuerdo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_ingreso` date NOT NULL,
  `valor_total` double NOT NULL,
  `valor_inicial` double NOT NULL,
  `cod_promesa` varchar(512) DEFAULT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  `usuario_id` int(11) NOT NULL,
  `lote_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_venta_usuario1` (`usuario_id`),
  KEY `fk_venta_lote1` (`lote_id`),
  CONSTRAINT `fk_venta_lote1` FOREIGN KEY (`lote_id`) REFERENCES `lote` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acuerdo`
--

/*!40000 ALTER TABLE `acuerdo` DISABLE KEYS */;
INSERT INTO `acuerdo` (`id`,`fecha_ingreso`,`valor_total`,`valor_inicial`,`cod_promesa`,`eliminado`,`usuario_id`,`lote_id`) VALUES 
 (18,'2017-04-05',8000,8000,'wqi',0,2,12),
 (19,'2017-04-05',8000,1000,'22',0,2,13);
/*!40000 ALTER TABLE `acuerdo` ENABLE KEYS */;


--
-- Definition of table `lote`
--

DROP TABLE IF EXISTS `lote`;
CREATE TABLE `lote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `ubicacion` varchar(512) NOT NULL,
  `dimension` varchar(45) DEFAULT NULL,
  `numero_lote` int(11) NOT NULL,
  `disponible` tinyint(4) NOT NULL DEFAULT '1',
  `eliminado` int(11) NOT NULL,
  `manzana_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lote_manzana1` (`manzana_id`),
  CONSTRAINT `fk_lote_manzana1` FOREIGN KEY (`manzana_id`) REFERENCES `manzana` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lote`
--

/*!40000 ALTER TABLE `lote` DISABLE KEYS */;
INSERT INTO `lote` (`id`,`nombre`,`ubicacion`,`dimension`,`numero_lote`,`disponible`,`eliminado`,`manzana_id`) VALUES 
 (12,'Lote 1','KSK','2',1,0,0,3),
 (13,'Lote 2','28','28',2,0,0,3),
 (14,'Lote 3','34','334',3,1,0,3);
/*!40000 ALTER TABLE `lote` ENABLE KEYS */;


--
-- Definition of table `lote_infraestructura`
--

DROP TABLE IF EXISTS `lote_infraestructura`;
CREATE TABLE `lote_infraestructura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` double NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  `infraestructura_id` int(11) NOT NULL,
  `lote_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lote_infraestructura_infraestructura1` (`infraestructura_id`),
  KEY `fk_lote_infraestructura_lote1` (`lote_id`),
  CONSTRAINT `fk_lote_infraestructura_infraestructura1` FOREIGN KEY (`infraestructura_id`) REFERENCES `obras_infraestructura` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lote_infraestructura_lote1` FOREIGN KEY (`lote_id`) REFERENCES `lote` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lote_infraestructura`
--

/*!40000 ALTER TABLE `lote_infraestructura` DISABLE KEYS */;
INSERT INTO `lote_infraestructura` (`id`,`valor`,`fecha_ingreso`,`estado`,`eliminado`,`infraestructura_id`,`lote_id`) VALUES 
 (3,600,'2017-04-01',NULL,0,2,12),
 (4,400,'2017-04-01',NULL,0,1,13);
/*!40000 ALTER TABLE `lote_infraestructura` ENABLE KEYS */;


--
-- Definition of table `lote_multa`
--

DROP TABLE IF EXISTS `lote_multa`;
CREATE TABLE `lote_multa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lote_id` int(11) NOT NULL,
  `multa_id` int(11) NOT NULL,
  `valor_multa` double NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `descripcion` varchar(512) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_lote_multa_lote1` (`lote_id`),
  KEY `fk_lote_multa_multa1` (`multa_id`),
  CONSTRAINT `fk_lote_multa_lote1` FOREIGN KEY (`lote_id`) REFERENCES `lote` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lote_multa_multa1` FOREIGN KEY (`multa_id`) REFERENCES `multa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lote_multa`
--

/*!40000 ALTER TABLE `lote_multa` DISABLE KEYS */;
INSERT INTO `lote_multa` (`id`,`lote_id`,`multa_id`,`valor_multa`,`fecha_ingreso`,`descripcion`,`estado`,`eliminado`) VALUES 
 (1,12,3,2000,'2017-04-01 00:00:00','A',NULL,0),
 (2,13,3,2000,'2017-04-01 00:00:00','A',NULL,0),
 (3,12,3,2000,'2017-04-08 00:00:00','mk',NULL,0),
 (4,13,4,4000,'2017-04-10 00:00:00','kkk',NULL,0),
 (5,12,3,2000,'2017-04-11 00:00:00','k',NULL,0),
 (6,13,3,2000,'2017-04-11 00:00:00','k',NULL,0);
/*!40000 ALTER TABLE `lote_multa` ENABLE KEYS */;


--
-- Definition of table `lotizacion`
--

DROP TABLE IF EXISTS `lotizacion`;
CREATE TABLE `lotizacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `ciudad` varchar(512) NOT NULL,
  `sector` varchar(512) NOT NULL,
  `referencia` varchar(1024) DEFAULT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lotizacion`
--

/*!40000 ALTER TABLE `lotizacion` DISABLE KEYS */;
INSERT INTO `lotizacion` (`id`,`nombre`,`ciudad`,`sector`,`referencia`,`eliminado`) VALUES 
 (9,'Lotización 1','Riobamba','Los Pinos','Los Pinos',0);
/*!40000 ALTER TABLE `lotizacion` ENABLE KEYS */;


--
-- Definition of table `manzana`
--

DROP TABLE IF EXISTS `manzana`;
CREATE TABLE `manzana` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(512) NOT NULL,
  `descripcion` varchar(512) DEFAULT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  `lotizacion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_manzana_lotizacion1` (`lotizacion_id`),
  CONSTRAINT `fk_manzana_lotizacion1` FOREIGN KEY (`lotizacion_id`) REFERENCES `lotizacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manzana`
--

/*!40000 ALTER TABLE `manzana` DISABLE KEYS */;
INSERT INTO `manzana` (`id`,`nombre`,`descripcion`,`eliminado`,`lotizacion_id`) VALUES 
 (3,'Manzana 1','asl',0,9),
 (4,'Manzana 2','askask',0,9);
/*!40000 ALTER TABLE `manzana` ENABLE KEYS */;


--
-- Definition of table `multa`
--

DROP TABLE IF EXISTS `multa`;
CREATE TABLE `multa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `valor` double NOT NULL,
  `descripcion` varchar(512) DEFAULT NULL,
  `eliminado` varchar(45) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `multa`
--

/*!40000 ALTER TABLE `multa` DISABLE KEYS */;
INSERT INTO `multa` (`id`,`nombre`,`valor`,`descripcion`,`eliminado`) VALUES 
 (3,'Multa Uno',2000,'dsl','0'),
 (4,'Multa Dos',4000,'Mull','0');
/*!40000 ALTER TABLE `multa` ENABLE KEYS */;


--
-- Definition of table `obras_infraestructura`
--

DROP TABLE IF EXISTS `obras_infraestructura`;
CREATE TABLE `obras_infraestructura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `valor` double NOT NULL,
  `descripcion` varchar(512) DEFAULT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obras_infraestructura`
--

/*!40000 ALTER TABLE `obras_infraestructura` DISABLE KEYS */;
INSERT INTO `obras_infraestructura` (`id`,`nombre`,`valor`,`descripcion`,`eliminado`) VALUES 
 (1,'Obra Uno',400,'Obra',0),
 (2,'Obra Dos',600,'Obra',0);
/*!40000 ALTER TABLE `obras_infraestructura` ENABLE KEYS */;


--
-- Definition of table `pago`
--

DROP TABLE IF EXISTS `pago`;
CREATE TABLE `pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monto_total` double NOT NULL,
  `numero_abonos` int(11) NOT NULL,
  `monto_pagado` double NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '0' COMMENT '0->Sin Pago 1 -> Pagado  2->Pago Parcial',
  `acuerdo_id` int(11) NOT NULL,
  `id_item` int(11) NOT NULL COMMENT '1->Acuerdo 2->Infraestructura 3->Multas',
  `id_obra_multa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pago_acuerdo1` (`acuerdo_id`),
  KEY `fk_acuerdo_id` (`acuerdo_id`),
  CONSTRAINT `fk_acuerdo_id` FOREIGN KEY (`acuerdo_id`) REFERENCES `acuerdo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pago`
--

/*!40000 ALTER TABLE `pago` DISABLE KEYS */;
INSERT INTO `pago` (`id`,`monto_total`,`numero_abonos`,`monto_pagado`,`estado`,`acuerdo_id`,`id_item`,`id_obra_multa`) VALUES 
 (25,8000,1,8000,1,18,1,0),
 (26,8000,4,8000,1,19,1,0),
 (27,2000,1,2000,1,18,3,3),
 (28,4000,1,4000,1,19,3,4),
 (29,2000,1,0,0,18,3,5),
 (30,2000,1,1000,2,19,3,6);
/*!40000 ALTER TABLE `pago` ENABLE KEYS */;


--
-- Definition of table `tipo_pago`
--

DROP TABLE IF EXISTS `tipo_pago`;
CREATE TABLE `tipo_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(512) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_pago`
--

/*!40000 ALTER TABLE `tipo_pago` DISABLE KEYS */;
INSERT INTO `tipo_pago` (`id`,`nombre`,`eliminado`) VALUES 
 (1,'Pago Total',0),
 (2,'Pago Parcial',0);
/*!40000 ALTER TABLE `tipo_pago` ENABLE KEYS */;


--
-- Definition of table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_usuario`
--

/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` (`id`,`nombre`,`descripcion`) VALUES 
 (1,'Administrador','Administrador'),
 (2,'Secretario','Secretario'),
 (3,'Cliente','Cliente');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;


--
-- Definition of table `transaccion`
--

DROP TABLE IF EXISTS `transaccion`;
CREATE TABLE `transaccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_transaccion` datetime NOT NULL,
  `monto_total` double NOT NULL,
  `valor` double NOT NULL,
  `pago_id` int(11) NOT NULL,
  `tipo_pago_id` int(11) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_transaccion_pago1` (`pago_id`),
  CONSTRAINT `fk_transaccion_pago1` FOREIGN KEY (`pago_id`) REFERENCES `pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaccion`
--

/*!40000 ALTER TABLE `transaccion` DISABLE KEYS */;
INSERT INTO `transaccion` (`id`,`fecha_transaccion`,`monto_total`,`valor`,`pago_id`,`tipo_pago_id`,`eliminado`) VALUES 
 (1,'2017-04-05 00:00:00',0,8000,25,1,0),
 (2,'2017-04-05 00:00:00',8000,1000,26,2,0),
 (4,'2017-04-10 00:00:00',0,1000,27,2,0),
 (5,'2017-04-10 00:00:00',0,1000,27,1,0),
 (6,'2017-04-10 00:00:00',7000,1000,26,2,0),
 (7,'2017-04-10 00:00:00',5000,2000,26,2,0),
 (8,'2017-04-10 00:00:00',4000,1000,26,2,0),
 (9,'2017-04-10 00:00:00',3000,1000,26,2,0),
 (10,'2017-04-10 00:00:00',4000,1000,28,2,0),
 (11,'2017-04-10 00:00:00',3000,1000,28,2,0),
 (12,'2017-04-10 00:00:00',2000,1000,28,2,0),
 (13,'2017-04-10 00:00:00',1000,1000,28,2,0),
 (14,'2017-04-11 00:00:00',2000,500,30,2,0),
 (15,'2017-04-11 00:00:00',1500,500,30,2,0);
/*!40000 ALTER TABLE `transaccion` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(10) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `celular` varchar(10) DEFAULT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  `tipo_usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_tipo_usuario1` (`tipo_usuario_id`),
  CONSTRAINT `fk_usuario_tipo_usuario1` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipo_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`,`cedula`,`nombres`,`apellidos`,`password`,`email`,`celular`,`eliminado`,`tipo_usuario_id`) VALUES 
 (1,'0603108770','Jane','C','202cb962ac59075b964b07152d234b70','l','099999',0,1),
 (2,'0602567802','Ana','Cantos','abc19440e9a4a2b4ea0994db8f4e3a7a','la@g.com','0328999999',0,3);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
