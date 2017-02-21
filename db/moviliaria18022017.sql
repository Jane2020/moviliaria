SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;

SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;

SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';



DROP SCHEMA IF EXISTS `moviliaria` ;

CREATE SCHEMA IF NOT EXISTS `moviliaria` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;

USE `moviliaria` ;



-- -----------------------------------------------------

-- Table `moviliaria`.`tipo_usuario`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `moviliaria`.`tipo_usuario` ;



CREATE  TABLE IF NOT EXISTS `moviliaria`.`tipo_usuario` (

  `id` INT NOT NULL AUTO_INCREMENT ,

  `nombre` VARCHAR(128) NOT NULL ,

  `descripcion` VARCHAR(45) NULL ,

  PRIMARY KEY (`id`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `moviliaria`.`usuario`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `moviliaria`.`usuario` ;



CREATE  TABLE IF NOT EXISTS `moviliaria`.`usuario` (

  `id` INT NOT NULL AUTO_INCREMENT ,

  `cedula` VARCHAR(10) NOT NULL ,

  `nombres` VARCHAR(45) NOT NULL ,

  `apellidos` VARCHAR(45) NOT NULL ,

  `password` VARCHAR(45) NOT NULL ,

  `email` VARCHAR(128) NULL ,

  `celular` VARCHAR(10) NULL ,

  `eliminado` VARCHAR(45) NOT NULL DEFAULT 0 ,

  `tipo_usuario_id` INT NOT NULL ,

  PRIMARY KEY (`id`) ,

  INDEX `fk_usuario_tipo_usuario1` (`tipo_usuario_id` ASC) ,

  CONSTRAINT `fk_usuario_tipo_usuario1`

    FOREIGN KEY (`tipo_usuario_id` )

    REFERENCES `moviliaria`.`tipo_usuario` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `moviliaria`.`lotizacion`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `moviliaria`.`lotizacion` ;



CREATE  TABLE IF NOT EXISTS `moviliaria`.`lotizacion` (

  `id` INT NOT NULL AUTO_INCREMENT ,

  `nombre` VARCHAR(128) NOT NULL ,

  `ciudad` VARCHAR(512) NOT NULL ,

  `sector` VARCHAR(512) NOT NULL ,

  `referencia` VARCHAR(1024) NULL ,

  `eliminado` INT NOT NULL DEFAULT 0 ,

  PRIMARY KEY (`id`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `moviliaria`.`manzana`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `moviliaria`.`manzana` ;



CREATE  TABLE IF NOT EXISTS `moviliaria`.`manzana` (

  `id` INT NOT NULL AUTO_INCREMENT ,

  `nombre` VARCHAR(512) NOT NULL ,

  `descripcion` VARCHAR(512) NULL ,

  `eliminado` INT NOT NULL DEFAULT 0 ,

  `lotizacion_id` INT NOT NULL ,

  PRIMARY KEY (`id`) ,

  INDEX `fk_manzana_lotizacion1` (`lotizacion_id` ASC) ,

  CONSTRAINT `fk_manzana_lotizacion1`

    FOREIGN KEY (`lotizacion_id` )

    REFERENCES `moviliaria`.`lotizacion` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `moviliaria`.`lote`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `moviliaria`.`lote` ;



CREATE  TABLE IF NOT EXISTS `moviliaria`.`lote` (

  `id` INT NOT NULL AUTO_INCREMENT ,

  `nombre` VARCHAR(45) NOT NULL ,

  `ubicacion` VARCHAR(512) NOT NULL ,

  `dimension` VARCHAR(45) NULL ,

  `numero_lote` INT NOT NULL ,

  `disponible` TINYINT NOT NULL DEFAULT 1 ,

  `eliminado` INT NOT NULL ,

  `manzana_id` INT NOT NULL ,

  PRIMARY KEY (`id`) ,

  INDEX `fk_lote_manzana1` (`manzana_id` ASC) ,

  CONSTRAINT `fk_lote_manzana1`

    FOREIGN KEY (`manzana_id` )

    REFERENCES `moviliaria`.`manzana` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `moviliaria`.`acuerdo`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `moviliaria`.`acuerdo` ;



CREATE  TABLE IF NOT EXISTS `moviliaria`.`acuerdo` (

  `id` INT NOT NULL AUTO_INCREMENT ,

  `fecha_ingreso` DATE NOT NULL ,

  `valor_ingreso` DOUBLE NOT NULL ,

  `valor_venta` DOUBLE NOT NULL ,

  `cod_promesa` VARCHAR(512) NULL ,

  `usuario_id` INT NOT NULL ,

  `lote_id` INT NOT NULL ,

  `tipo_acuerdo_id` INT NOT NULL ,

  PRIMARY KEY (`id`) ,

  INDEX `fk_venta_usuario1` (`usuario_id` ASC) ,

  INDEX `fk_venta_lote1` (`lote_id` ASC) ,

  CONSTRAINT `fk_venta_usuario1`

    FOREIGN KEY (`usuario_id` )

    REFERENCES `moviliaria`.`usuario` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `fk_venta_lote1`

    FOREIGN KEY (`lote_id` )

    REFERENCES `moviliaria`.`lote` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `moviliaria`.`parametros`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `moviliaria`.`parametros` ;



CREATE  TABLE IF NOT EXISTS `moviliaria`.`parametros` (

  `id` INT NOT NULL AUTO_INCREMENT ,

  `campo` VARCHAR(256) NOT NULL ,

  `valor` VARCHAR(512) NOT NULL ,

  `tipo_campo` VARCHAR(256) NOT NULL ,

  `orden` INT NOT NULL ,

  `tipo_reg` VARCHAR(256) NULL ,

  `eliminado` INT NULL ,

  PRIMARY KEY (`id`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `moviliaria`.`obras_infraestructura`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `moviliaria`.`obras_infraestructura` ;



CREATE  TABLE IF NOT EXISTS `moviliaria`.`obras_infraestructura` (

  `id` INT NOT NULL AUTO_INCREMENT ,

  `nombre` VARCHAR(128) NOT NULL ,

  `descripcion` VARCHAR(512) NULL ,

  `eliminado` INT NOT NULL DEFAULT 0 ,

  PRIMARY KEY (`id`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `moviliaria`.`multa`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `moviliaria`.`multa` ;



CREATE  TABLE IF NOT EXISTS `moviliaria`.`multa` (

  `id` INT NOT NULL AUTO_INCREMENT ,

  `nombre` VARCHAR(45) NOT NULL ,

  `valor` DOUBLE NOT NULL ,

  `descripcion` VARCHAR(512) NULL ,

  `eliminado` VARCHAR(45) NOT NULL DEFAULT 0 ,

  PRIMARY KEY (`id`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `moviliaria`.`lote_multa`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `moviliaria`.`lote_multa` ;



CREATE  TABLE IF NOT EXISTS `moviliaria`.`lote_multa` (

  `id` INT NOT NULL AUTO_INCREMENT ,

  `lote_id` INT NOT NULL ,

  `multa_id` INT NOT NULL ,

  `fecha_ingreso` DATETIME NOT NULL ,

  `descripcion` VARCHAR(512) NULL ,

  `eliminado` INT NOT NULL DEFAULT 0 ,

  PRIMARY KEY (`id`) ,

  INDEX `fk_lote_multa_lote1` (`lote_id` ASC) ,

  INDEX `fk_lote_multa_multa1` (`multa_id` ASC) ,

  CONSTRAINT `fk_lote_multa_lote1`

    FOREIGN KEY (`lote_id` )

    REFERENCES `moviliaria`.`lote` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `fk_lote_multa_multa1`

    FOREIGN KEY (`multa_id` )

    REFERENCES `moviliaria`.`multa` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `moviliaria`.`lote_infraestructura`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `moviliaria`.`lote_infraestructura` ;



CREATE  TABLE IF NOT EXISTS `moviliaria`.`lote_infraestructura` (

  `id` INT NOT NULL AUTO_INCREMENT ,

  `valor` DOUBLE NOT NULL ,

  `infraestructura_id` INT NOT NULL ,

  `lote_id` INT NOT NULL ,

  PRIMARY KEY (`id`) ,

  INDEX `fk_lote_infraestructura_infraestructura1` (`infraestructura_id` ASC) ,

  INDEX `fk_lote_infraestructura_lote1` (`lote_id` ASC) ,

  CONSTRAINT `fk_lote_infraestructura_infraestructura1`

    FOREIGN KEY (`infraestructura_id` )

    REFERENCES `moviliaria`.`obras_infraestructura` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `fk_lote_infraestructura_lote1`

    FOREIGN KEY (`lote_id` )

    REFERENCES `moviliaria`.`lote` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `moviliaria`.`tipo_pago`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `moviliaria`.`tipo_pago` ;



CREATE  TABLE IF NOT EXISTS `moviliaria`.`tipo_pago` (

  `id` INT NOT NULL ,

  `nombre` VARCHAR(512) NOT NULL ,

  `eliminado` INT NOT NULL DEFAULT 0 ,

  PRIMARY KEY (`id`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `moviliaria`.`pago`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `moviliaria`.`pago` ;



CREATE  TABLE IF NOT EXISTS `moviliaria`.`pago` (

  `id` INT NOT NULL AUTO_INCREMENT ,

  `monto_total` DOUBLE NOT NULL ,

  `numero_abonos` INT NOT NULL ,

  `monto_pagado` DOUBLE NOT NULL ,

  `estado` INT NOT NULL ,

  `acuerdo_id` INT NOT NULL ,

  `tipo_pago_id` INT NOT NULL ,

  `id_item` INT NULL ,

  PRIMARY KEY (`id`) ,

  INDEX `fk_pago_acuerdo1` (`acuerdo_id` ASC) ,

  INDEX `fk_pago_tipo_pago1` (`tipo_pago_id` ASC) ,

  CONSTRAINT `fk_pago_acuerdo1`

    FOREIGN KEY (`acuerdo_id` )

    REFERENCES `moviliaria`.`acuerdo` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `fk_pago_tipo_pago1`

    FOREIGN KEY (`tipo_pago_id` )

    REFERENCES `moviliaria`.`tipo_pago` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `moviliaria`.`transaccion`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `moviliaria`.`transaccion` ;



CREATE  TABLE IF NOT EXISTS `moviliaria`.`transaccion` (

  `id` INT NOT NULL AUTO_INCREMENT ,

  `fecha_transaccion` DATETIME NOT NULL ,

  `valor` DOUBLE NOT NULL ,

  `eliminado` INT NOT NULL DEFAULT 0 ,

  `pago_id` INT NOT NULL ,

  PRIMARY KEY (`id`) ,

  INDEX `fk_transaccion_pago1` (`pago_id` ASC) ,

  CONSTRAINT `fk_transaccion_pago1`

    FOREIGN KEY (`pago_id` )

    REFERENCES `moviliaria`.`pago` (`id` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;







SET SQL_MODE=@OLD_SQL_MODE;

SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

