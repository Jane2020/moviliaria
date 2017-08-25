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
  `tipo` int(11) NOT NULL DEFAULT '1' COMMENT '1->Acuerdo 2->Traspaso',
  `estado` int(11) NOT NULL DEFAULT '1' COMMENT '1->Activo 0->Inactivo',
  PRIMARY KEY (`id`),
  KEY `fk_venta_usuario1` (`usuario_id`),
  KEY `fk_venta_lote1` (`lote_id`),
  CONSTRAINT `fk_venta_lote1` FOREIGN KEY (`lote_id`) REFERENCES `lote` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acuerdo`
--

/*!40000 ALTER TABLE `acuerdo` DISABLE KEYS */;
INSERT INTO `acuerdo` (`id`,`fecha_ingreso`,`valor_total`,`valor_inicial`,`cod_promesa`,`eliminado`,`usuario_id`,`lote_id`,`tipo`,`estado`) VALUES 
 (1,'2017-05-11',7500,7500,'PROMESA.021/2007-ac',0,5,2,1,1),
 (2,'2017-05-11',4500,4500,'2013-06-01-P05615',0,6,3,1,0),
 (3,'2017-05-11',5000,5000,'PROMESA.066/2015-AC',0,7,4,1,1),
 (4,'2017-05-11',5000,5000,'PROMESA.027/2004-AC',0,8,5,1,1),
 (5,'2017-05-11',6300,6300,'promesa/beell/018',0,9,6,1,1),
 (6,'2017-05-11',8000,8000,'PROMESA.018/2015-AC',0,10,7,1,1),
 (7,'2017-05-11',5200,5200,'ESCRITURA.2825.PROM.AC',0,11,8,1,1),
 (8,'2017-05-11',3000,3000,'ESCRITURA.202.PROM.AC',0,13,11,1,1),
 (9,'2017-05-11',4000,4000,'PROMESA.004/2009-AC',0,14,12,1,1),
 (10,'2017-05-11',5000,5000,'PROMESA.056/2013-AC',0,15,13,1,1),
 (11,'2017-05-11',5000,5000,'PROMESA.002/99-AC',0,16,14,1,1),
 (12,'2017-05-11',7000,7000,'PROMESA.014/2007-ac',0,16,15,1,1),
 (13,'2017-05-11',7500,7500,'PROMESA.010/2009-AC',0,17,16,1,1),
 (14,'2017-05-11',3000,3000,'PROMESA.019-2011-ac',0,18,17,1,1),
 (15,'2017-05-11',5600,5600,'ESCRITURA.3075.PROM.AC',0,19,18,1,1),
 (16,'2017-05-11',5000,5000,'PROMESA.043/202-AC',0,20,19,1,1),
 (17,'2017-05-11',7500,7500,'PROMESA.032-2016/AC',0,21,20,1,1),
 (18,'2017-05-11',5000,5000,'ESCRITURA.3538.PROM.AC',0,22,21,1,1),
 (19,'2017-05-11',5000,5000,'ESCRITURA.2634.PROM.AC',0,26,25,1,1),
 (20,'2017-05-11',5000,5000,'ESCRITURA.2635.PROM.AC',0,27,26,1,1),
 (21,'2017-05-11',7500,7500,'PROMESA.057/2005-AC',0,28,27,1,1),
 (22,'2017-05-11',7000,7000,'PROMESA.016/2008AC',0,29,28,1,1),
 (23,'2017-05-11',7000,7000,'PROMESA.023/2008AC',0,30,29,1,1),
 (24,'2017-05-11',7500,7500,'PROMESA.103/2008AC',0,31,30,1,1),
 (25,'2017-05-11',5000,5000,'PROMESA.020/99-AC',0,32,31,1,1),
 (26,'2017-05-11',2000,2000,'PROMESA.014/2009-AC',0,33,32,1,1),
 (27,'2017-05-11',8500,8500,'PROMESA.006/2011-AC',0,35,34,1,1),
 (28,'2017-05-11',7500,7500,'PROMESA.051/2005-AC',0,37,36,1,1),
 (29,'2017-05-11',5000,5000,'PROMESA.019-2012-ac',0,40,39,1,1),
 (30,'2017-05-12',7000,7000,'PROMESA.026/2013',0,41,53,1,1),
 (31,'2017-05-12',6000,6000,'PROMESA.004/2006-AC',0,42,54,1,1),
 (32,'2017-05-12',7500,7500,'PROMESA.081/2012-AC',0,43,55,1,1),
 (33,'2017-05-12',7500,7500,'PROMESA.041/2013-AC',0,44,56,1,1),
 (34,'2017-05-12',6000,6000,'PROMESA.072/2011-ac',0,45,57,1,1),
 (35,'2017-05-12',6000,6000,'PROMESA.030/2008-ac',0,46,58,1,1),
 (36,'2017-05-12',6000,6000,'PROMESA.073/2014-AC',0,48,60,1,1),
 (37,'2017-05-12',6000,6000,'VTA.015-2016/AC',0,49,62,1,1),
 (38,'2017-05-12',6000,6000,'PROMESA.098/2006-ac',0,50,63,1,1),
 (39,'2017-05-12',6000,6000,'PROMESA.065/2011-AC',0,51,64,1,1),
 (40,'2017-05-12',6000,6000,'PROMESA.094/2006-ac',0,52,65,1,1),
 (41,'2017-05-12',6000,6000,'ESCRITURA.7620.PROM.AC',0,54,67,1,1),
 (42,'2017-05-12',6000,6000,'PROMESA.049/2010-ac',0,53,66,1,1),
 (43,'2017-05-12',6000,6000,'PROMESA.049/2010-ac',0,53,68,1,1),
 (44,'2017-05-12',6000,6000,'PROMESA.070/3013-AC',0,55,69,1,1),
 (45,'2017-05-12',6000,6000,'PROMESA.029/2006-ac',0,56,70,1,1),
 (46,'2017-05-12',10000,10000,'PROMESA.016/2012-AC',0,57,71,1,1),
 (47,'2017-05-12',6000,6000,'PROMESA.016/2010-ac',0,59,73,1,1),
 (48,'2017-05-12',4000,4000,'PROMESA.50/2013-AC',0,64,78,1,1),
 (49,'2017-05-12',6000,6000,'PROMESA.010/2011-AC',0,65,79,1,1),
 (50,'2017-05-12',5500,4000,'PROMESA.016/2006-Pedro',0,66,80,1,1),
 (51,'2017-05-12',5750,4250,'PROMESA.008/2006-AC',0,66,81,1,1),
 (52,'2017-05-12',3500,3500,'Penipe-10/11/2005',0,67,84,1,1),
 (53,'2017-05-12',3500,3500,'VTA.019/AC',0,69,86,1,1),
 (54,'2017-05-12',7500,7500,'PROMESA.039/2007-ac',0,70,97,1,1),
 (55,'2017-05-12',6000,6000,'PROMESA.049/2007-ac',0,71,98,1,1),
 (56,'2017-05-12',6000,6000,'PROMESA.139/2008-ac',0,72,99,1,1),
 (57,'2017-05-12',6000,6000,'PROMESA.037/2015-AC',0,73,100,1,1),
 (58,'2017-05-12',5000,5000,'PROMESA.014-2017/AC',0,75,102,1,1),
 (59,'2017-05-12',6000,6000,'PROMESA.080/2013-AC',0,76,104,1,1),
 (60,'2017-05-12',6000,6000,'ESCRITURA.235.PROM.AC',0,77,106,1,1),
 (61,'2017-05-12',6700,6700,'PROMESA.073/2014-AC',0,78,107,1,1),
 (62,'2017-05-12',6500,6500,'PROMESA.003/2006-AC',0,79,108,1,1),
 (63,'2017-05-12',8000,8000,'PROMESA.113/2006-ac',0,80,109,1,1),
 (64,'2017-05-12',9000,9000,'PROMESA.064/2015-AC',0,81,110,1,1),
 (65,'2017-05-12',5500,4000,'PROMESA.007/2006-AC',0,66,111,1,1),
 (66,'2017-05-12',6000,6000,'PROMESA.017/2006-Pedro',0,82,112,1,1),
 (67,'2017-05-21',500,500,'2013-06-01-P05615',0,83,3,1,0),
 (68,'2017-05-21',5000,5000,'2013-06-01-P05615',0,5,3,2,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lote`
--

/*!40000 ALTER TABLE `lote` DISABLE KEYS */;
INSERT INTO `lote` (`id`,`nombre`,`ubicacion`,`dimension`,`numero_lote`,`disponible`,`eliminado`,`manzana_id`) VALUES 
 (1,'Lote 1','Calles Villarica entre Puebla y Longitudinal 3','178,89',1,1,0,1),
 (2,'Lote 2','Calles Villarica entre Puebla y Longitudinal 3','158,96',2,0,0,1),
 (3,'Lote 3','Calles Villarica entre Puebla y Longitudinal 3','153,80',3,0,0,1),
 (4,'Lote 4','Calles Villarica entre Puebla y Longitudinal 3','152,26',4,0,0,1),
 (5,'Lote 5','Calles Villarica entre Puebla y Longitudinal 3','151,80',5,0,0,1),
 (6,'Lote 6','Calles Villarica entre Puebla y Longitudinal 3','136,39',6,0,0,1),
 (7,'Lote 7','Calles Villarica entre Puebla y Longitudinal 3','145,06',7,0,0,1),
 (8,'Lote 8','Calles Villarica entre Puebla y Longitudinal 3','139,78',8,0,0,1),
 (9,'Lote 9','Calles Villarica entre Puebla y Longitudinal 3','156.82',9,1,0,1),
 (10,'Lote 10','Calles Villarica entre Puebla y Longitudinal 3','325,73',10,0,0,2),
 (11,'Lote 11','Calles Villarica entre Puebla y Longitudinal 3','136,19',11,0,0,2),
 (12,'Lote 12','Calles Villarica entre Puebla y Longitudinal 3','139,47',12,0,0,2),
 (13,'Lote 13','Calles Villarica entre Puebla y Longitudinal 3','132,46',13,0,0,2),
 (14,'Lote 14','Calles Villarica entre Puebla y Longitudinal 3','131,90',14,0,0,2),
 (15,'Lote 15','Calles Villarica entre Puebla y Longitudinal 3','146,40',15,0,0,2),
 (16,'Lote 16','Calles Villarica entre Puebla y Longitudinal 3','139,13',16,0,0,2),
 (17,'Lote 17','Calles Villarica entre Puebla y Longitudinal 3','143,76',17,0,0,3),
 (18,'Lote 18 ','Calles Villarica entre Puebla y Longitudinal 3','149,46',18,0,0,3),
 (19,'Lote 19','Calles Villarica entre Puebla y Longitudinal 3','171,39',19,0,0,3),
 (20,'Lote 20','Calles Villarica entre Puebla y Longitudinal 3','163,31',20,0,0,3),
 (21,'Lote 21','Calles Villarica entre Puebla y Longitudinal 3','150,64',21,0,0,3),
 (22,'Lote 22','Calles Villarica entre Puebla y Longitudinal 3','162,09',22,1,0,3),
 (23,'Lote 23','Calles Villarica entre Puebla y Longitudinal 3','162,47',23,1,0,3),
 (24,'Lote 24','Calles Villarica entre Puebla y Longitudinal 3','173,80',24,1,0,4),
 (25,'Lote 25','Calles Villarica entre Puebla y Longitudinal 3','144,13',25,0,0,4),
 (26,'Lote 26','Calles Villarica entre Puebla y Longitudinal 3','145,12',26,0,0,4),
 (27,'Lote 27','Calles Villarica entre Puebla y Longitudinal 3','156,79',27,0,0,4),
 (28,'Lote 28','Calles Villarica entre Puebla y Longitudinal 3','144,24',28,0,0,4),
 (29,'Lote 29','Calles Villarica entre Puebla y Longitudinal 3','151,46',29,0,0,4),
 (30,'Lote 30','Calles Villarica entre Puebla y Longitudinal 3','207,78',30,0,0,5),
 (31,'Lote 31','Calles Villarica entre Puebla y Longitudinal 3','174,50',31,0,0,5),
 (32,'Lote 32','Calles Villarica entre Puebla y Longitudinal 3','167,39',32,0,0,5),
 (33,'Lote 33','Calles Villarica entre Puebla y Longitudinal 3','164,00',33,1,0,5),
 (34,'Lote 34','Calles Villarica entre Puebla y Longitudinal 3','154,95',34,0,0,5),
 (35,'Lote 35','Calles Villarica entre Puebla y Longitudinal 3','202,19',35,1,0,5),
 (36,'Lote 36','Calles Villarica entre Puebla y Longitudinal 3','144,61',36,0,0,6),
 (37,'Lote 37','Calles Villarica entre Puebla y Longitudinal 3','146,44',37,1,0,6),
 (38,'Lote 38','Calles Villarica entre Puebla y Longitudinal 3','146,29',38,1,0,6),
 (39,'Lote 39','Calles Villarica entre Puebla y Longitudinal 3','145,65',39,0,0,6),
 (40,'Lote 40','Calles Villarica entre Puebla y Longitudinal 3','296,42',40,0,0,6),
 (41,'Lote 1','Calles Puebla, Valencia, Innominada y Mendoza','100',1,1,0,7),
 (42,'Lote 2','Calles Puebla, Valencia, Innominada y Mendoza','100',2,1,0,7),
 (43,'Lote 3','Calles Puebla, Valencia, Innominada y Mendoza','100',3,1,0,7),
 (44,'Lote 4','Calles Puebla, Valencia, Innominada y Mendoza','100',4,1,0,7),
 (45,'Lote 5','Calles Puebla, Valencia, Innominada y Mendoza','100',5,1,0,7),
 (46,'Lote 6','Calles Puebla, Valencia, Innominada y Mendoza','100',6,1,0,7),
 (47,'Lote 7','Calles Puebla, Valencia, Innominada y Mendoza','100',7,1,0,7),
 (48,'Lote 8','Calles Puebla, Valencia, Innominada y Mendoza','100',8,1,0,7),
 (49,'Lote 9','Calles Puebla, Valencia, Innominada y Mendoza','100',9,1,0,7),
 (50,'Lote 10','Calles Puebla, Valencia, Innominada y Mendoza','100',10,1,0,7),
 (51,'Lote 11','Calles Puebla, Valencia, Innominada y Mendoza','100',11,1,0,7),
 (52,'Lote 12','Calles Puebla, Valencia, Innominada y Mendoza','100',12,1,0,7),
 (53,'Lote 1','Calles Villarica entre Puebla y Longitudinal 3','199,08',1,0,0,8),
 (54,'Lote 2','Calles Villarica entre Puebla y Longitudinal 3','186,42',2,0,0,8),
 (55,'Lote 3','Calles Villarica entre Puebla y Longitudinal 3','121,57',3,0,0,8),
 (56,'Lote 4','Calles Villarica entre Puebla y Longitudinal 3','151,97',4,0,0,8),
 (57,'Lote 5','Calles Villarica entre Puebla y Longitudinal 3','221,14',1,0,0,9),
 (58,'Lote 6','Calles Villarica entre Puebla y Longitudinal 3','223,64',2,0,0,9),
 (59,'Lote 7','Calles Villarica entre Puebla y Longitudinal 3','199,02',3,1,0,9),
 (60,'Lote 8','Calles Villarica entre Puebla y Longitudinal 3','204,86',4,0,0,9),
 (61,'Lote 9','Calles Villarica entre Puebla y Longitudinal 3','204,41',5,1,0,9),
 (62,'Lote 10','Calles Villarica entre Puebla y Longitudinal 3','203,76',6,0,0,9),
 (63,'Lote 11','Calles Villarica entre Puebla y Longitudinal 3','198,57',7,0,0,9),
 (64,'Lote 12','Calles Villarica entre Puebla y Longitudinal 3','200,94',8,0,0,9),
 (65,'Lote 13','Calles Villarica entre Puebla y Longitudinal 3','195,73',9,0,0,9),
 (66,'Lote 14','Calles Villarica entre Puebla y Longitudinal 3','198,12',10,0,0,9),
 (67,'Lote 15','Calles Villarica entre Puebla y Longitudinal 3','193,17',11,0,0,9),
 (68,'Lote 16','Calles Villarica entre Puebla y Longitudinal 3','195,29',12,0,0,9),
 (69,'Lote 17','Calles Villarica entre Puebla y Longitudinal 3','196,17',13,0,0,9),
 (70,'Lote 18','Calles Villarica entre Puebla y Longitudinal 3','192,47',14,0,0,9),
 (71,'Lote 19','Calles Villarica entre Puebla y Longitudinal 3','189,16',15,0,0,9),
 (72,'Lote 20','Calles Villarica entre Puebla y Longitudinal 3','189,64',16,1,0,9),
 (73,'Lote 21','Calles Villarica entre Puebla y Longitudinal 3','188,93',17,0,0,9),
 (74,'Lote 22','Calles Villarica entre Puebla y Longitudinal 3','183,27',18,1,0,9),
 (75,'Lote 23','Calles Villarica entre Puebla y Longitudinal 3','214,03',1,1,0,10),
 (76,'Lote 24','Calles Villarica entre Puebla y Longitudinal 3','146,17',2,1,0,10),
 (77,'Lote 25','Calles Villarica entre Puebla y Longitudinal 3','144,41',3,1,0,10),
 (78,'Lote 26','Calles Villarica entre Puebla y Longitudinal 3','174,25',4,0,0,10),
 (79,'Lote 27','Calles Villarica entre Puebla y Longitudinal 3','172,66',5,0,0,10),
 (80,'Lote 28','Calles Villarica entre Puebla y Longitudinal 3','174,04',6,0,0,10),
 (81,'Lote 29','Calles Villarica entre Puebla y Longitudinal 3','173,35',7,0,0,10),
 (82,'Lote 30','Calles Villarica entre Puebla y Longitudinal 3','175,59',8,1,0,10),
 (83,'Lote 31','Calles Villarica entre Puebla y Longitudinal 3','175,10',9,1,0,10),
 (84,'Lote 32','Calles Villarica entre Puebla y Longitudinal 3','178,46',10,0,0,10),
 (85,'Lote 33','Calles Villarica entre Puebla y Longitudinal 3','178,16',11,1,0,10),
 (86,'Lote 34','Calles Villarica entre Puebla y Longitudinal 3','181,09',12,0,0,10),
 (87,'Lote 35','Calles Villarica entre Puebla y Longitudinal 3','181,12',13,1,0,10),
 (88,'Lote 36','Calles Villarica entre Puebla y Longitudinal 3','171,36',1,0,0,11),
 (89,'Lote 37','Calles Villarica entre Puebla y Longitudinal 3','178,90',2,0,0,11),
 (90,'Lote 38','Calles Villarica entre Puebla y Longitudinal 3','167,61',3,0,0,11),
 (91,'Lote 39','Calles Villarica entre Puebla y Longitudinal 3','167,61',4,0,0,11),
 (92,'Lote 40','Calles Villarica entre Puebla y Longitudinal 3','167,95',5,0,0,11),
 (93,'Lote 41','Calles Villarica entre Puebla y Longitudinal 3','167,95',6,0,0,11),
 (94,'Lote 42','Calles Villarica entre Puebla y Longitudinal 3','168,28',7,0,0,11),
 (95,'Lote 43','Calles Villarica entre Puebla y Longitudinal 3','168,28',8,0,0,11),
 (96,'Lote 44','Calles Villarica entre Puebla y Longitudinal 3','178,44',9,0,0,11),
 (97,'Lote 45','Calles Villarica entre Puebla y Longitudinal 3','182,29',10,0,0,11),
 (98,'Lote 46','Calles Villarica entre Puebla y Longitudinal 3','213,34',1,0,0,12),
 (99,'Lote 47','Calles Villarica entre Puebla y Longitudinal 3','223,02',2,0,0,12),
 (100,'Lote 48','Calles Villarica entre Puebla y Longitudinal 3','197,99',3,0,0,12),
 (101,'Lote 49','Calles Villarica entre Puebla y Longitudinal 3','198,08',4,1,0,12),
 (102,'Lote 50','Calles Villarica entre Puebla y Longitudinal 3','198,33',5,0,0,12),
 (103,'Lote 51','Calles Villarica entre Puebla y Longitudinal 3','198,42',6,1,0,12),
 (104,'Lote 52','Calles Villarica entre Puebla y Longitudinal 3','229,71',7,0,0,12),
 (105,'Lote 53','Calles Villarica entre Puebla y Longitudinal 3','206,50',8,1,0,12),
 (106,'Lote 54','Calles Villarica entre Puebla y Longitudinal 3','226,81',1,0,0,13),
 (107,'Lote 55','Calles Villarica entre Puebla y Longitudinal 3','223.21',2,0,0,13),
 (108,'Lote 56','Calles Villarica entre Puebla y Longitudinal 3','250,04',3,0,0,13),
 (109,'Lote 57','Calles Villarica entre Puebla y Longitudinal 3','184,64',4,0,0,13),
 (110,'Lote 58','Calles Villarica entre Puebla y Longitudinal 3','186,77',5,0,0,13),
 (111,'Lote 59','Calles Villarica entre Puebla y Longitudinal 3','184,76',6,0,0,13),
 (112,'Lote 60','Calles Villarica entre Puebla y Longitudinal 3','182,19',7,0,0,13);
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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lote_infraestructura`
--

/*!40000 ALTER TABLE `lote_infraestructura` DISABLE KEYS */;
INSERT INTO `lote_infraestructura` (`id`,`valor`,`fecha_ingreso`,`estado`,`eliminado`,`infraestructura_id`,`lote_id`) VALUES 
 (1,300,'2017-01-01',NULL,0,1,78),
 (2,300,'2017-01-01',NULL,0,1,79),
 (3,300,'2017-01-01',NULL,0,1,80),
 (4,300,'2017-01-01',NULL,0,1,81),
 (5,300,'2017-01-01',NULL,0,1,84),
 (6,300,'2017-01-01',NULL,0,1,86),
 (7,400,'2017-01-02',NULL,0,2,78),
 (8,400,'2017-01-02',NULL,0,2,79),
 (9,400,'2017-01-02',NULL,0,2,80),
 (10,400,'2017-01-02',NULL,0,2,81),
 (11,400,'2017-01-02',NULL,0,2,84),
 (12,400,'2017-01-02',NULL,0,2,86),
 (13,400,'2017-01-03',NULL,0,3,78),
 (14,400,'2017-01-03',NULL,0,3,79),
 (15,400,'2017-01-03',NULL,0,3,80),
 (16,400,'2017-01-03',NULL,0,3,81),
 (17,400,'2017-01-03',NULL,0,3,84),
 (18,400,'2017-01-03',NULL,0,3,86),
 (19,400,'2017-01-04',NULL,0,4,78),
 (20,400,'2017-01-04',NULL,0,4,79),
 (21,400,'2017-01-04',NULL,0,4,80),
 (22,400,'2017-01-04',NULL,0,4,81),
 (23,400,'2017-01-04',NULL,0,4,84),
 (24,400,'2017-01-04',NULL,0,4,86),
 (25,300,'2017-02-01',NULL,0,1,106),
 (26,300,'2017-02-01',NULL,0,1,107),
 (27,300,'2017-02-01',NULL,0,1,108),
 (28,300,'2017-02-01',NULL,0,1,109),
 (29,300,'2017-02-01',NULL,0,1,110),
 (30,300,'2017-02-01',NULL,0,1,111),
 (31,300,'2017-02-01',NULL,0,1,112),
 (32,400,'2017-02-02',NULL,0,2,106),
 (33,400,'2017-02-02',NULL,0,2,107),
 (34,400,'2017-02-02',NULL,0,2,108),
 (35,400,'2017-02-02',NULL,0,2,109),
 (36,400,'2017-02-02',NULL,0,2,110),
 (37,400,'2017-02-02',NULL,0,2,111),
 (38,400,'2017-02-02',NULL,0,2,112),
 (39,400,'2017-02-03',NULL,0,3,106),
 (40,400,'2017-02-03',NULL,0,3,107),
 (41,400,'2017-02-03',NULL,0,3,108),
 (42,400,'2017-02-03',NULL,0,3,109),
 (43,400,'2017-02-03',NULL,0,3,110),
 (44,400,'2017-02-03',NULL,0,3,111),
 (45,400,'2017-02-03',NULL,0,3,112),
 (46,400,'2017-02-04',NULL,0,4,106),
 (47,400,'2017-02-04',NULL,0,4,107),
 (48,400,'2017-02-04',NULL,0,4,108),
 (49,400,'2017-02-04',NULL,0,4,109),
 (50,400,'2017-02-04',NULL,0,4,110),
 (51,400,'2017-02-04',NULL,0,4,111),
 (52,400,'2017-02-04',NULL,0,4,112),
 (53,300,'2017-05-21',NULL,0,1,2),
 (54,300,'2017-05-21',NULL,0,1,3),
 (55,400,'2017-05-21',NULL,0,2,3),
 (56,400,'2017-05-21',NULL,0,3,3),
 (57,400,'2017-05-21',NULL,0,4,3),
 (58,400,'2017-05-21',NULL,0,2,3),
 (59,300,'2017-06-15',NULL,1,1,2),
 (60,300,'2017-06-15',NULL,1,1,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lote_multa`
--

/*!40000 ALTER TABLE `lote_multa` DISABLE KEYS */;
INSERT INTO `lote_multa` (`id`,`lote_id`,`multa_id`,`valor_multa`,`fecha_ingreso`,`descripcion`,`estado`,`eliminado`) VALUES 
 (1,80,1,10,'2017-05-12 00:00:00','Retraso al pago del Impuesto Predial Anual realizado en Enero del 2017 ',NULL,0),
 (2,81,1,10,'2017-05-12 00:00:00','Retraso al pago del Impuesto Predial Anual realizado en Enero del 2017 ',NULL,0),
 (3,111,1,10,'2017-05-12 00:00:00','Retraso al Pago del Impuesto Predial Anual efectuado en Enero de 2017',NULL,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lotizacion`
--

/*!40000 ALTER TABLE `lotizacion` DISABLE KEYS */;
INSERT INTO `lotizacion` (`id`,`nombre`,`ciudad`,`sector`,`referencia`,`eliminado`) VALUES 
 (1,'Programa de Vivienda de Interés Social Progresivo Nuevo Amanecer','Riobamba','Parroquia Pedro Vicente Maldonado','Sector del Perímetro de las Industrias',0),
 (2,'Programa de Vivienda de Interés Social Progresivo Nuevo Amanecer Donovilsa','Riobamba','Parroquia Pedro Vicente Maldonado','Sector del Perímetro de las Industrias',0),
 (3,'Programa de Vivienda de Interés Social Progresivo Nuevo Amanecer Donovilsa II','Riobamba','Parroquia Pedro Vicente Maldonado','Sector del Perímetro de las Industrias',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manzana`
--

/*!40000 ALTER TABLE `manzana` DISABLE KEYS */;
INSERT INTO `manzana` (`id`,`nombre`,`descripcion`,`eliminado`,`lotizacion_id`) VALUES 
 (1,'Mz-A1','Manzana A',0,1),
 (2,'Mz-B1','Manzana B',0,1),
 (3,'Mz-C1','Manzana C',0,1),
 (4,'Mz-D1','Manzana D',0,1),
 (5,'Mz-E1','Manzana E',0,1),
 (6,'Mz-F1','Manzana F',0,1),
 (7,'Mz-A2','Manzana A',0,2),
 (8,'Mz-A3','Manzana A',0,3),
 (9,'Mz-B3','Manzana B',0,3),
 (10,'Mz-C3','Manzana C',0,3),
 (11,'Mz-D3','Manzana D',0,3),
 (12,'Mz-E3','Manzana E',0,3),
 (13,'Mz-F3','Manzana F',0,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `multa`
--

/*!40000 ALTER TABLE `multa` DISABLE KEYS */;
INSERT INTO `multa` (`id`,`nombre`,`valor`,`descripcion`,`eliminado`) VALUES 
 (1,'PAGO DE PREDIO URBANO',10,'Retraso al pago del Impuesto Predial Anual 2017','0');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obras_infraestructura`
--

/*!40000 ALTER TABLE `obras_infraestructura` DISABLE KEYS */;
INSERT INTO `obras_infraestructura` (`id`,`nombre`,`valor`,`descripcion`,`eliminado`) VALUES 
 (1,'Bordillos',300,'Elaboración de Bordillos en su lote de terreno realizado por DONOVILSA S.A.',0),
 (2,'Canalización',400,'Canalización efectuada en su lote de terreno realizado por DONOVILSA S.A.',0),
 (3,'Agua Potable',400,'Proyecto del Agua Potable efectuado y aprobado por EP-EMAPAR',0),
 (4,'Luz Eléctrica ',400,'Proyecto e instalación de la Luz Eléctrica realizado por E.E.R.S.A.',0);
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
  `estado` int(11) NOT NULL DEFAULT '0' COMMENT '0->Sin Pago 1 -> Pagado  2->Pago Parcial 3->Pago Eliminado',
  `acuerdo_id` int(11) NOT NULL,
  `id_item` int(11) NOT NULL COMMENT '1->Acuerdo 2->Infraestructura 3->Multas',
  `id_obra_multa` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_pago_acuerdo1` (`acuerdo_id`),
  KEY `fk_acuerdo_id` (`acuerdo_id`),
  CONSTRAINT `fk_acuerdo_id` FOREIGN KEY (`acuerdo_id`) REFERENCES `acuerdo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pago`
--

/*!40000 ALTER TABLE `pago` DISABLE KEYS */;
INSERT INTO `pago` (`id`,`monto_total`,`numero_abonos`,`monto_pagado`,`estado`,`acuerdo_id`,`id_item`,`id_obra_multa`) VALUES 
 (1,7500,1,7500,1,1,1,0),
 (2,4500,1,4500,1,2,1,0),
 (3,5000,1,5000,1,3,1,0),
 (4,5000,1,5000,1,4,1,0),
 (5,6300,1,6300,1,5,1,0),
 (6,8000,1,8000,1,6,1,0),
 (7,5200,1,5200,1,7,1,0),
 (8,3000,1,3000,1,8,1,0),
 (9,4000,1,4000,1,9,1,0),
 (10,5000,1,5000,1,10,1,0),
 (11,5000,1,5000,1,11,1,0),
 (12,7000,1,7000,1,12,1,0),
 (13,7500,1,7500,1,13,1,0),
 (14,3000,1,3000,1,14,1,0),
 (15,5600,1,5600,1,15,1,0),
 (16,5000,1,5000,1,16,1,0),
 (17,7500,1,7500,1,17,1,0),
 (18,5000,1,5000,1,18,1,0),
 (19,5000,1,5000,1,19,1,0),
 (20,5000,1,5000,1,20,1,0),
 (21,7500,1,7500,1,21,1,0),
 (22,7000,1,7000,1,22,1,0),
 (23,7000,1,7000,1,23,1,0),
 (24,7500,1,7500,1,24,1,0),
 (25,5000,1,5000,1,25,1,0),
 (26,2000,1,2000,1,26,1,0),
 (27,8500,1,8500,1,27,1,0),
 (28,7500,1,7500,1,28,1,0),
 (29,5000,1,5000,1,29,1,0),
 (30,7000,1,7000,1,30,1,0),
 (31,6000,1,6000,1,31,1,0),
 (32,7500,1,7500,1,32,1,0),
 (33,7500,1,7500,1,33,1,0),
 (34,6000,1,6000,1,34,1,0),
 (35,6000,1,6000,1,35,1,0),
 (36,6000,1,6000,1,36,1,0),
 (37,6000,1,6000,1,37,1,0),
 (38,6000,1,6000,1,38,1,0),
 (39,6000,1,6000,1,39,1,0),
 (40,6000,1,6000,1,40,1,0),
 (41,6000,1,6000,1,41,1,0),
 (42,6000,1,6000,1,42,1,0),
 (43,6000,1,6000,1,43,1,0),
 (44,6000,1,6000,1,44,1,0),
 (45,6000,1,6000,1,45,1,0),
 (46,10000,1,10000,1,46,1,0),
 (47,6000,1,6000,1,47,1,0),
 (48,4000,1,4000,1,48,1,0),
 (49,6000,1,6000,1,49,1,0),
 (50,5500,1,5500,1,50,1,0),
 (51,5750,1,5750,1,51,1,0),
 (52,3500,1,3500,1,52,1,0),
 (53,3500,1,3500,1,53,1,0),
 (54,7500,1,7500,1,54,1,0),
 (55,6000,1,6000,1,55,1,0),
 (56,6000,1,6000,1,56,1,0),
 (57,6000,1,6000,1,57,1,0),
 (58,5000,1,5000,1,58,1,0),
 (59,6000,1,6000,1,59,1,0),
 (60,6000,1,6000,1,60,1,0),
 (61,6700,1,6700,1,61,1,0),
 (62,6500,1,6500,1,62,1,0),
 (63,8000,1,8000,1,63,1,0),
 (64,9000,1,9000,1,64,1,0),
 (65,5500,1,5500,1,65,1,0),
 (66,6000,1,6000,1,66,1,0),
 (67,300,1,0,0,48,2,1),
 (68,300,1,0,0,49,2,2),
 (69,300,1,100,2,50,2,3),
 (70,300,1,0,0,51,2,4),
 (71,300,1,0,0,52,2,5),
 (72,300,1,0,0,53,2,6),
 (73,400,1,0,0,48,2,7),
 (74,400,1,0,0,49,2,8),
 (75,400,1,400,1,50,2,9),
 (76,400,1,0,0,51,2,10),
 (77,400,1,0,0,52,2,11),
 (78,400,1,0,0,53,2,12),
 (79,400,1,0,0,48,2,13),
 (80,400,1,0,0,49,2,14),
 (81,400,1,0,0,50,2,15),
 (82,400,1,0,0,51,2,16),
 (83,400,1,0,0,52,2,17),
 (84,400,1,0,0,53,2,18),
 (85,400,1,0,0,48,2,19),
 (86,400,1,0,0,49,2,20),
 (87,400,1,0,0,50,2,21),
 (88,400,1,0,0,51,2,22),
 (89,400,1,0,0,52,2,23),
 (90,400,1,0,0,53,2,24),
 (91,300,1,0,0,60,2,25),
 (92,300,1,0,0,61,2,26),
 (93,300,1,0,0,62,2,27),
 (94,300,1,0,0,63,2,28),
 (95,300,1,0,0,64,2,29),
 (96,300,1,0,0,65,2,30),
 (97,300,1,0,0,66,2,31),
 (98,400,1,0,0,60,2,32),
 (99,400,1,0,0,61,2,33),
 (100,400,1,0,0,62,2,34),
 (101,400,1,0,0,63,2,35),
 (102,400,1,0,0,64,2,36),
 (103,400,1,0,0,65,2,37),
 (104,400,1,0,0,66,2,38),
 (105,400,1,0,0,60,2,39),
 (106,400,1,0,0,61,2,40),
 (107,400,1,0,0,62,2,41),
 (108,400,1,0,0,63,2,42),
 (109,400,1,0,0,64,2,43),
 (110,400,1,0,0,65,2,44),
 (111,400,1,0,0,66,2,45),
 (112,400,1,0,0,60,2,46),
 (113,400,1,0,0,61,2,47),
 (114,400,1,0,0,62,2,48),
 (115,400,1,0,0,63,2,49),
 (116,400,1,0,0,64,2,50),
 (117,400,1,0,0,65,2,51),
 (118,400,1,0,0,66,2,52),
 (119,10,1,0,0,50,3,1),
 (120,10,1,0,0,51,3,2),
 (121,300,1,0,0,65,3,3),
 (122,500,1,500,1,67,1,0),
 (123,300,1,300,1,1,2,53),
 (124,300,1,300,1,67,2,54),
 (125,400,1,0,0,2,2,55),
 (126,400,1,0,0,2,2,56),
 (127,400,1,400,1,67,2,57),
 (128,400,1,400,1,67,2,58),
 (129,5000,1,5000,1,68,1,0),
 (130,300,1,0,3,1,2,59),
 (131,300,1,0,3,1,2,60);
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
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaccion`
--

/*!40000 ALTER TABLE `transaccion` DISABLE KEYS */;
INSERT INTO `transaccion` (`id`,`fecha_transaccion`,`monto_total`,`valor`,`pago_id`,`tipo_pago_id`,`eliminado`) VALUES 
 (1,'2017-05-11 00:00:00',7500,7500,1,1,0),
 (2,'2017-05-11 00:00:00',4500,4500,2,1,0),
 (3,'2017-05-11 00:00:00',5000,5000,3,1,0),
 (4,'2017-05-11 00:00:00',5000,5000,4,1,0),
 (5,'2017-05-11 00:00:00',6300,6300,5,1,0),
 (6,'2017-05-11 00:00:00',8000,8000,6,1,0),
 (7,'2017-05-11 00:00:00',5200,5200,7,1,0),
 (8,'2017-05-11 00:00:00',3000,3000,8,1,0),
 (9,'2017-05-11 00:00:00',4000,4000,9,1,0),
 (10,'2017-05-11 00:00:00',5000,5000,10,1,0),
 (11,'2017-05-11 00:00:00',5000,5000,11,1,0),
 (12,'2017-05-11 00:00:00',7000,7000,12,1,0),
 (13,'2017-05-11 00:00:00',7500,7500,13,1,0),
 (14,'2017-05-11 00:00:00',3000,3000,14,1,0),
 (15,'2017-05-11 00:00:00',5600,5600,15,1,0),
 (16,'2017-05-11 00:00:00',5000,5000,16,1,0),
 (17,'2017-05-11 00:00:00',7500,7500,17,1,0),
 (18,'2017-05-11 00:00:00',5000,5000,18,1,0),
 (19,'2017-05-11 00:00:00',5000,5000,19,1,0),
 (20,'2017-05-11 00:00:00',5000,5000,20,1,0),
 (21,'2017-05-11 00:00:00',7500,7500,21,1,0),
 (22,'2017-05-11 00:00:00',7000,7000,22,1,0),
 (23,'2017-05-11 00:00:00',7000,7000,23,1,0),
 (24,'2017-05-11 00:00:00',7500,7500,24,1,0),
 (25,'2017-05-11 00:00:00',5000,5000,25,1,0),
 (26,'2017-05-11 00:00:00',2000,2000,26,1,0),
 (27,'2017-05-11 00:00:00',8500,8500,27,1,0),
 (28,'2017-05-11 00:00:00',7500,7500,28,1,0),
 (29,'2017-05-11 00:00:00',5000,5000,29,1,0),
 (30,'2017-05-12 00:00:00',7000,7000,30,1,0),
 (31,'2017-05-12 00:00:00',6000,6000,31,1,0),
 (32,'2017-05-12 00:00:00',7500,7500,32,1,0),
 (33,'2017-05-12 00:00:00',7500,7500,33,1,0),
 (34,'2017-05-12 00:00:00',6000,6000,34,1,0),
 (35,'2017-05-12 00:00:00',6000,6000,35,1,0),
 (36,'2017-05-12 00:00:00',6000,6000,36,1,0),
 (37,'2017-05-12 00:00:00',6000,6000,37,1,0),
 (38,'2017-05-12 00:00:00',6000,6000,38,1,0),
 (39,'2017-05-12 00:00:00',6000,6000,39,1,0),
 (40,'2017-05-12 00:00:00',6000,6000,40,1,0),
 (41,'2017-05-12 00:00:00',6000,6000,41,1,0),
 (42,'2017-05-12 00:00:00',6000,6000,42,1,0),
 (43,'2017-05-12 00:00:00',6000,6000,43,1,0),
 (44,'2017-05-12 00:00:00',6000,6000,44,1,0),
 (45,'2017-05-12 00:00:00',6000,6000,45,1,0),
 (46,'2017-05-12 00:00:00',10000,10000,46,1,0),
 (47,'2017-05-12 00:00:00',6000,6000,47,1,0),
 (48,'2017-05-12 00:00:00',4000,4000,48,1,0),
 (49,'2017-05-12 00:00:00',6000,6000,49,1,0),
 (50,'2017-05-12 00:00:00',5500,5500,50,1,0),
 (51,'2017-05-12 00:00:00',5750,5750,51,1,0),
 (52,'2017-05-12 00:00:00',3500,3500,52,1,0),
 (53,'2017-05-12 00:00:00',3500,3500,53,1,0),
 (54,'2017-05-12 00:00:00',7500,7500,54,1,0),
 (55,'2017-05-12 00:00:00',6000,6000,55,1,0),
 (56,'2017-05-12 00:00:00',6000,6000,56,1,0),
 (57,'2017-05-12 00:00:00',6000,6000,57,1,0),
 (58,'2017-05-12 00:00:00',5000,5000,58,1,0),
 (59,'2017-05-12 00:00:00',6000,6000,59,1,0),
 (60,'2017-05-12 00:00:00',6000,6000,60,1,0),
 (61,'2017-05-12 00:00:00',6700,6700,61,1,0),
 (62,'2017-05-12 00:00:00',6500,6500,62,1,0),
 (63,'2017-05-12 00:00:00',8000,8000,63,1,0),
 (64,'2017-05-12 00:00:00',9000,9000,64,1,0),
 (65,'2017-05-12 00:00:00',5500,5500,65,1,0),
 (66,'2017-05-12 00:00:00',6000,6000,66,1,0),
 (67,'2017-05-17 00:00:00',300,100,69,2,0),
 (68,'2017-05-17 00:00:00',400,400,75,1,0),
 (69,'2017-05-21 00:00:00',500,500,122,1,0),
 (70,'2017-05-21 00:00:00',300,300,124,1,0),
 (71,'2017-05-21 00:00:00',400,400,127,1,0),
 (72,'2017-05-21 00:00:00',400,400,128,1,0),
 (73,'2017-05-21 00:00:00',5000,5000,129,1,0),
 (74,'2017-05-21 00:00:00',300,50,123,2,0),
 (75,'2017-05-21 00:00:00',250,100,123,2,0),
 (76,'2017-05-21 00:00:00',150,100,123,2,0),
 (77,'2017-06-15 00:00:00',50,50,123,1,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`,`cedula`,`nombres`,`apellidos`,`password`,`email`,`celular`,`telefono`,`direccion`,`tipo_usuario_id`,`eliminado`) VALUES 
 (1,'0603108770','Alvaro','Vilema','202cb962ac59075b964b07152d234b70','alvarovilemag1993@gmail.com','0982706168','032376393','Calle Mons. Andrés Machado y Mons. Jose Ingnacio',1,0),
 (2,'0600897375','Guido Hermel','Vilema Orozco','827ccb0eea8a706c4c34a16891f84e7b','domingofsguido@yahoo.com','0986444478','032376393','Mons. Andrés Machado 20-37 y Mons. José Ignacio',1,0),
 (3,'0601897200','Luis Gustavo','Donoso Calderón','827ccb0eea8a706c4c34a16891f84e7b','luisdonoso29@yahoo.com','0990474469','032374408','Calle Mendoza y Puebla ',1,0),
 (4,'0602520744','Doris Alicia','Vizuete Mora','65f182e24605deabca1044d25402153d','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (5,'0603053034','Carlos Alfonso','Gadvay Gadvay','ea33e2fe9e31686b955be7cbccee1d01','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (6,'0602667404','Norma Lucia','Shilquigua Toabanda','8adb75c105d329efe070db8e4f5421d9','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (7,'0605543602','Alvaro Daniel','Vilema Guijarro','3d07cac2c5b8dea70d5bf66ea9513417','alvarovilemag1993@gmail.com','0982706168','032376393','Mons. Andrés Machado 20-37 y Mons. José Ignacio',3,0),
 (8,'0603061094','Angélica Maria','Vilema Ortiz','022257eb6e5e6de96fb21172d3b0bf60','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (9,'0603589284','Cesar Fabian','Garrido Rodriguez','d3f7258ed39f5644e49b8063cfe4cd8f','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (10,'0603373960','Gladys Enriqueta','Chacha Quisnancela','48167ca7d00d7b4ee457d620f82a4059','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (11,'2100204912','Cristian Xavier ','Saavedra Cabadia','9f526c7d6ce517ad99f37146d1bc0372','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (12,'0603041393','Nancy Cecilia','Bonilla Arguello','8733cee451d7918a214ebe50ba34d31a','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (13,'0601926538','Martha Leonila ','Cabezas Carvajal','d767b78b43c30609f4c9df73794577e7','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (14,'0601844111','Ana Romelia','Muñoz Paguay','627b9ea50fe45918074263c1629c7d7c','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (15,'0605347798','Steven David ','Guerrero Vargas','a430c8cb11775a9e7536ca552b67d098','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (16,'0602913634','German Eloy','Guerrero Samaniego','92d0bcc8bebc38469e6a9cd5434e5f71','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (17,'0600170229','Julio Cesar','Muñoz','4685b1f2e34ba380f853fc6f47a332f0','prueba@gmail.com','0999999999','030000000','Calle Eugenio Espejo y Av. Circunvalación',3,0),
 (18,'0602932014','Jose Fernando','Chicaiza Tubon','65c0e1dee463490c14bed3504fd4ffef','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (19,'0604362525','Byron Danilo','Ocaña Alvarado','5a47617782dbb4a72c57bc9d537287a3','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (20,'0602768657','Segundo Leonidas','Llamuca Moyota','2d927853a94733277f7528aefe2de8a3','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (21,'0602737413','Miriam ','Cajo Llongo','2feb0d24093b32006bb6b82cd823b96f','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (22,'0600903785','Laura Isolina','Moyon Samaniego','a9f46d38ed07ed721e35522722c3455c','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (23,'0602452138','Marco Antonio','Lliquin Samaniego','76bf8071d2224c74ed490b7fe06208b5','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (24,'0602963829','Rosa Aida','Urgiles Choca','86b21280d91e49e8fdafe79ebd4a52ca','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (25,'0602366254','Clara Ines','Yuqui Lema','7e2e0f8334d550f41a3d923a4206a2c5','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (26,'0601020274','Gonzalo','Anguieta','f9422943bb64bd7c69b88fad80ea1bed','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (27,'1706167960','María Felicidad','Vigme Cushpa','b46fcf3e199099d92200b0d22f5ed83a','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (28,'0602671356','Jose Vinicio','Masson Salazar','e435de4b4f40e22f90859b0bf4e29d9f','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (29,'0602300899','Rosa Lucia','Chávez Yanza','58bb6d9413c4a715c51d1def505ab0a0','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (30,'0603445735','Henry Homero','Paguay Orozco','4d8fea1b405b8469c2995e2715527153','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (31,'0600575682','Carlos Eduardo','Chicaiza Caza','dd8ae9087546d362f705d4fb0ac5881b','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (32,'0602202673','María Angelica','Castañeda Orozco','5c866210fd02bad85d3b0c29d9032fc8','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (33,'0600850697','Ángel Jacinto','Moyota Gadvay','f2db154e513c8524c9f044e6cb818981','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (34,'0603097403','Walter Francisco','Fiallos Vilema','22c8fb639c56556198e88c096fe1c723','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (35,'0602160004','Edgar Edmundo ','Uvidia Alarcón','0dc99e3a23254c83123a2a3dac25fe19','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (36,'0603912916','Mónica Patricia','Llamuca Moyon','adaeef73d776db5be011f305c0cc7bf4','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (37,'0602880478','Carmita del Rocio','Guanoluiza Timbela','977e800c90d86d6684d307211bad3eec','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (38,'0604744656','Mariela Alexandra','Nuñez Altamirano','e9dbf88bb102c85ecb649d9a176a3cf7','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (39,'0601392681','Jose Pio','Vargas Amanche','5b7b0def95099034b37ba9dec35b2ca3','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (40,'0602758120','Mario Jorge ','Satan Paguay','effcc901b94a5750a4fc211836cb6b44','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (41,'0602209058','Raúl Eduardo','Cabezas Chuiza','f8e459632bfe19ba140b1c7ed0772ae4','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (42,'0602886848','Blanca Guadalupe','Rodriguez Hidalgo','d1f0d7fdac94bb0decd2856c97906391','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (43,'0602886723','Elsa Dolores','Rodriguez Hidalgo','acc60c0ca4be6b9e05f314a8ccaea9c4','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (44,'0602598401','Cristobal Salomon','Rodriguez Hidalgo','92c8167975bd8d768c8485b0470158ae','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (45,'0301534905','Max Aurelio','Cungachi Muyolema','8ea19a87ee05b431ccce4e0c011a9fde','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (46,'0603346982','Amparo Isabel','Rosero Altamirano','47a90bae5811bd36d926df69e88e0c3f','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (47,'0602929564','Luis Heriberto','Centeno Satán','d5c4d71f84283053b6949170ff73f472','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (48,'0603794157','Ángel Oswaldo','Tierra Quispillo','c7bd17fadb98bf4a1a040200c00b11fe','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (49,'1714327846','María Rosa','Lucio Albiño','ee5c0d12da7dd82c141af952ec419fd6','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (50,'0602818767','Germán Leonardo','Melendres García','2f73ac53136df8923c6da7a3ce518066','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (51,'0603076886','Carlos David','Ramirez López','75d10d794af72dac9c8d1ead44537c5c','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (52,'0603400987','Mariela Elizabeth','Paucar Sánchez','da25ce15a201f112b4f21cee04b6480e','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (53,'0601967458','Luis Ruperto','Ramos Lliquin','277bef11083b9f10c5858f201368b575','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (54,'0600890784','Mario Gabriel','Latorre Haro','39207e91a684c915c10e3756b3c4e9e2','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (55,'0603044751','Martha Cecilia','Granizo Caizaguano','743a32128cc31468dfcf32a33af69b9b','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (56,'0602390106','Réne Whasington','Martínez Paredes','4e6e70ff2c957dc0a225212634603173','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (57,'0602138661','María Graciela','Zavala Monge','4cb8cb3329da1242374ae5e8c637130d','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (58,'0603097916','Ángel Elias','Heredia Pilco','7af1d298e8a499e85db9b25048263817','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (59,'0602893125','Hilda del Carmen','Pataron Herrera','74a8b8a297c12651afc6b869d1bb95f2','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (60,'0602750804','Martha Sonia ','Paguay Becerra','4bee858f61c4a3a8fabbc22641ae8b97','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (61,'0603870569','Paola Marlid','Donoso Estrada','123c8ddbfe6d2b31025173798c56e56b','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (62,'0603870544','Gabriela Carolina ','Donoso Estrada','d691929c9c3516c85aae9719a521afe9','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (63,'0603870551','Karla Vanessa','Donoso Estrada','e3557e135280bbd1ae6a4e0dc57234af','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (64,'0602944118','Fabian Antonio','Donoso Calderón','0be90422de55c03b55dfd4d2839d5978','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (65,'0602156077','Jaime Geovanny','Fernández Vizuete','2f5b13586d9ec5f7cb0e990b88f5db67','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (66,'0603044058','Edgar Geovanny','Lara Salazar','202cb962ac59075b964b07152d234b70','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (67,'0602627945','Ángel Augusto','Robalino Vallejo','5fd61041d2c17a145cbe61f10e68d688','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (68,'0604165878','Miriam Rocío','Chida Centeno','0a978aaba5f8674433789ac32ed0832d','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (69,'0601035090','Silvio Camilo','Haro Haro','4143c06a3b7964c6ace1705dcb302368','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (70,'0600186258','Julio Cesar','Merino Samaniego','2a5fb9ac694d1ff0b916eb6ef9165f8c','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (71,'0602537755','Segundo Manuel','Guasco Yupangui','8ebafda612fc359d61abc4360f3449fd','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (72,'0601603244','Laura Piedad','Quispe Andrade','91f09c910d764ead4e13e3cb351d8dda','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (73,'0603400946','Mariela Fernanda','Iza Sinche','3c5a6b79eb7247eebbf6261aaa6f3230','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (74,'0603008996','Carmita Patrcia','Once Guanga','0f410ba22940b70e192cfdf46751aba4','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (75,'0603112970','Ángel Fernando','Sanga Aucancela','08b52a312ea3a21c9680498f26ef4b17','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (76,'0603233289','Hector Marcelo','Paca Reino','0d1e6fed6009cca263943ebea42292ff','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (77,'0603835620','Delia Alejandra','Vilema Guijarro','3fb7538bc035c663389176eeffa82260','prueba@gmail.com','0999999999','030000000','Mons. Andrés Machado 20-37 y Mons. José Ignacio',3,0),
 (78,'0604095364','Byron Vinicio','Moyota Castañeda','b87bd352987d466c4d1c9e822b7dfa0f','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (79,'0603092404','Cristian Eduardo','Pilco Vallejo','b115b5917781dd93ac7b1c8f9c0f6677','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (80,'0602746646','María Elsa','Tierra Quispillo','9f33c221376fe9c0710d0be8b4b290e3','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (81,'0603042037','Marco Antonio','Carrasco Toapanta','1f751339dc2120de8d2d5342be3c0b55','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (82,'0601938582','Julio Vicente','Román Pérez','614a86b6b8492dddffb5ca6be9b0c230','prueba@gmail.com','0999999999','030000000','Urb. Nuevo Amanecer',3,0),
 (83,'0600034201','Alejandra','Villa','202cb962ac59075b964b07152d234b70','aleja@g.com','0302300230','039929929','fd',3,0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
