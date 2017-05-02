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
  `tipo` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_venta_usuario1` (`usuario_id`),
  KEY `fk_venta_lote1` (`lote_id`),
  CONSTRAINT `fk_venta_lote1` FOREIGN KEY (`lote_id`) REFERENCES `lote` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acuerdo`
--

/*!40000 ALTER TABLE `acuerdo` DISABLE KEYS */;
INSERT INTO `acuerdo` (`id`,`fecha_ingreso`,`valor_total`,`valor_inicial`,`cod_promesa`,`eliminado`,`usuario_id`,`lote_id`,`tipo`,`estado`) VALUES 
 (28,'2017-05-01',20000,20000,'2013-06-01-03',0,4,17,1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lote`
--

/*!40000 ALTER TABLE `lote` DISABLE KEYS */;
INSERT INTO `lote` (`id`,`nombre`,`ubicacion`,`dimension`,`numero_lote`,`disponible`,`eliminado`,`manzana_id`) VALUES 
 (17,'Lote  1','Ubicación 1','200',1,0,0,6),
 (18,'Lote 2','Ubicación 2','300',2,1,0,6),
 (19,'Lote 3','Ubicación 3','300',3,1,0,6),
 (20,'Lote 4','Ubicación 4','400',4,1,0,7),
 (21,'Lote 5','Ubicación 5','500',5,1,0,7),
 (22,'Lote 6','Ubicación 6','600',6,1,0,9);
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lote_infraestructura`
--

/*!40000 ALTER TABLE `lote_infraestructura` DISABLE KEYS */;
INSERT INTO `lote_infraestructura` (`id`,`valor`,`fecha_ingreso`,`estado`,`eliminado`,`infraestructura_id`,`lote_id`) VALUES 
 (7,500,'2017-05-01',NULL,0,3,17),
 (8,1000,'2017-05-01',NULL,0,4,17),
 (9,800,'2017-05-01',NULL,0,5,17);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lote_multa`
--

/*!40000 ALTER TABLE `lote_multa` DISABLE KEYS */;
INSERT INTO `lote_multa` (`id`,`lote_id`,`multa_id`,`valor_multa`,`fecha_ingreso`,`descripcion`,`estado`,`eliminado`) VALUES 
 (1,17,5,500,'2017-05-01 00:00:00','Multa',NULL,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lotizacion`
--

/*!40000 ALTER TABLE `lotizacion` DISABLE KEYS */;
INSERT INTO `lotizacion` (`id`,`nombre`,`ciudad`,`sector`,`referencia`,`eliminado`) VALUES 
 (10,'Donovilsa I','Riobamba','La Dolorosa I','La Dolorosa I',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manzana`
--

/*!40000 ALTER TABLE `manzana` DISABLE KEYS */;
INSERT INTO `manzana` (`id`,`nombre`,`descripcion`,`eliminado`,`lotizacion_id`) VALUES 
 (6,'Manzana A','Manzana A',0,10),
 (7,'Manzana B','Manzana B',0,10),
 (8,'Manzana C','Manzana C',1,10),
 (9,'Manzana C','Manzana C',0,10);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `multa`
--

/*!40000 ALTER TABLE `multa` DISABLE KEYS */;
INSERT INTO `multa` (`id`,`nombre`,`valor`,`descripcion`,`eliminado`) VALUES 
 (5,'Multa 1',500,'Multa 1','0');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obras_infraestructura`
--

/*!40000 ALTER TABLE `obras_infraestructura` DISABLE KEYS */;
INSERT INTO `obras_infraestructura` (`id`,`nombre`,`valor`,`descripcion`,`eliminado`) VALUES 
 (3,'Agua, Luz',500,'Servicios Básicos',0),
 (4,'Alcantarillado',1000,'Alcantarillado',0),
 (5,'Bordillos y Aceras',800,'Aceras',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pago`
--

/*!40000 ALTER TABLE `pago` DISABLE KEYS */;
INSERT INTO `pago` (`id`,`monto_total`,`numero_abonos`,`monto_pagado`,`estado`,`acuerdo_id`,`id_item`,`id_obra_multa`) VALUES 
 (41,20000,1,20000,1,28,1,0),
 (42,500,1,200,2,28,2,7),
 (43,1000,1,0,0,28,2,8),
 (44,800,1,0,0,28,2,9),
 (45,500,1,400,2,28,3,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaccion`
--

/*!40000 ALTER TABLE `transaccion` DISABLE KEYS */;
INSERT INTO `transaccion` (`id`,`fecha_transaccion`,`monto_total`,`valor`,`pago_id`,`tipo_pago_id`,`eliminado`) VALUES 
 (44,'2017-05-01 00:00:00',20000,20000,41,1,0),
 (45,'2017-05-01 00:00:00',500,200,42,2,0),
 (46,'2017-05-01 00:00:00',500,400,45,2,0);
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
  `telefono` varchar(10) DEFAULT NULL,
  `direccion` varchar(256) DEFAULT NULL,
  `tipo_usuario_id` int(11) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_usuario_tipo_usuario1` (`tipo_usuario_id`),
  CONSTRAINT `fk_usuario_tipo_usuario1` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipo_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`,`cedula`,`nombres`,`apellidos`,`password`,`email`,`celular`,`telefono`,`direccion`,`tipo_usuario_id`,`eliminado`) VALUES 
 (1,'0603108770','Jane','Concha','202cb962ac59075b964b07152d234b70','lajane2020@hotmail.com','0999999999',NULL,NULL,1,0),
 (4,'0600034201','Juan','Perez','202cb962ac59075b964b07152d234b70','juan@perez.com','0999999777','0999944444','Los Pinos Altos',3,0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
