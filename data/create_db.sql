SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;

SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;

SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';



DROP SCHEMA IF EXISTS `xth_8767702_inmosys_db` ;

CREATE SCHEMA IF NOT EXISTS `xth_8767702_inmosys_db` DEFAULT CHARACTER SET utf8 ;

USE `xth_8767702_inmosys_db` ;



-- -----------------------------------------------------

-- Table `pais`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `pais` ;



CREATE  TABLE IF NOT EXISTS `pais` (

  `pai_num` INT UNSIGNED NOT NULL ,

  `pai_nom` VARCHAR(25) NOT NULL ,

  PRIMARY KEY (`pai_num`) )

ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;





-- -----------------------------------------------------

-- Table `departamento`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `departamento` ;



CREATE  TABLE IF NOT EXISTS `departamento` (

  `dep_num` INT UNSIGNED NOT NULL ,

  `dep_nom` VARCHAR(25) NOT NULL ,

  `fk_pai_num` INT UNSIGNED NOT NULL ,

  PRIMARY KEY (`dep_num`) ,

  CONSTRAINT `fk_departamento_pais1`

    FOREIGN KEY (`fk_pai_num` )

    REFERENCES `pais` (`pai_num` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;



CREATE INDEX `fk_departamento_pais1` ON `departamento` (`fk_pai_num` ASC) ;





-- -----------------------------------------------------

-- Table `ciudad`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `ciudad` ;



CREATE  TABLE IF NOT EXISTS `ciudad` (

  `ciu_num` INT UNSIGNED NOT NULL ,

  `ciu_nom` VARCHAR(25) NOT NULL ,

  `fk_dep_num` INT UNSIGNED NOT NULL ,

  PRIMARY KEY (`ciu_num`) ,

  CONSTRAINT `fk_ciudad_departamento1`

    FOREIGN KEY (`fk_dep_num` )

    REFERENCES `departamento` (`dep_num` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;



CREATE INDEX `fk_ciudad_departamento1` ON `ciudad` (`fk_dep_num` ASC) ;





-- -----------------------------------------------------

-- Table `tipo_inmueble`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `tipo_inmueble` ;



CREATE  TABLE IF NOT EXISTS `tipo_inmueble` (

  `id_tip_inm` INT UNSIGNED NOT NULL AUTO_INCREMENT ,

  `nom_tip_inm` VARCHAR(15) NOT NULL ,

  `desc_tip_inm` VARCHAR(45) NOT NULL ,

  PRIMARY KEY (`id_tip_inm`) )

ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;




CREATE UNIQUE INDEX `id_tipo_inm_UNIQUE` ON `tipo_inmueble` (`id_tip_inm` ASC) ;





-- -----------------------------------------------------

-- Table `inmueble`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `inmueble` ;



CREATE  TABLE IF NOT EXISTS `inmueble` (

  `inm_num` INT NOT NULL AUTO_INCREMENT ,

  `inm_num_mat` VARCHAR(25) NOT NULL ,

  `inm_mts_tot` DECIMAL(7,2) NOT NULL ,

  `inm_dir` VARCHAR(45) NOT NULL ,

  `inm_est` INT NOT NULL ,

  `inm_num_ban` INT UNSIGNED NOT NULL DEFAULT 0 ,

  `inm_num_pisos` INT UNSIGNED NOT NULL DEFAULT 0 ,

  `inm_num_parq` INT(2) UNSIGNED NOT NULL DEFAULT 0 ,

  `inm_val_imp` DECIMAL(10,2) NOT NULL ,

  `inm_val_adm` DECIMAL(10,2) NOT NULL ,

  `inm_dis` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 ,

  `inm_num_ven` INT UNSIGNED NOT NULL DEFAULT 0 ,

  `inm_dat_adi` VARCHAR(255) NOT NULL ,

  `fk_id_tip_inm` INT UNSIGNED NOT NULL ,

  `fk_ciu_num` INT UNSIGNED NOT NULL ,

  PRIMARY KEY (`inm_num`) ,

  CONSTRAINT `fk_inmueble_ciudad1`

    FOREIGN KEY (`fk_ciu_num` )

    REFERENCES `ciudad` (`ciu_num` )

    ON DELETE RESTRICT

    ON UPDATE CASCADE,

  CONSTRAINT `fk_inmueble_tipo_inmueble1`

    FOREIGN KEY (`fk_id_tip_inm` )

    REFERENCES `tipo_inmueble` (`id_tip_inm` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;




CREATE INDEX `inm_num_mat_UNIQUE` ON `inmueble` (`inm_num_mat` ASC) ;



CREATE INDEX `fk_inmueble_ciudad1` ON `inmueble` (`fk_ciu_num` ASC) ;



CREATE INDEX `fk_inmueble_tipo_inmueble1` ON `inmueble` (`fk_id_tip_inm` ASC) ;





-- -----------------------------------------------------

-- Table `cliente`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `cliente` ;



CREATE  TABLE IF NOT EXISTS `cliente` (

  `cli_ide` VARCHAR(15) NOT NULL ,

  `cli_nom` VARCHAR(15) NOT NULL ,

  `cli_tel` TEXT(6) NOT NULL ,

  `cli_cel` TEXT(10) NOT NULL ,

  `cli_cor_ele` VARCHAR(40) NOT NULL ,

  PRIMARY KEY (`cli_ide`) )

ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;






-- -----------------------------------------------------

-- Table `juridico`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `juridico` ;



CREATE  TABLE IF NOT EXISTS `juridico` (

  `jur_pag_web` VARCHAR(50) NULL ,

  `fk_cli_ide` VARCHAR(15) NOT NULL ,

  CONSTRAINT `fk_juridico_cliente1`

    FOREIGN KEY (`fk_cli_ide` )

    REFERENCES `cliente` (`cli_ide` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;



CREATE INDEX `fk_juridico_cliente1` ON `juridico` (`fk_cli_ide` ASC) ;





-- -----------------------------------------------------

-- Table `cnatural`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `cnatural` ;



CREATE  TABLE IF NOT EXISTS `cnatural` (

  `nat_ape` VARCHAR(15) NOT NULL ,

  `nat_sex` CHAR NOT NULL ,

  `nat_fec_nac` DATE NOT NULL ,

  `fk_cli_ide` VARCHAR(15) NOT NULL ,

  CONSTRAINT `fk_natural_cliente1`

    FOREIGN KEY (`fk_cli_ide` )

    REFERENCES `cliente` (`cli_ide` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;



CREATE INDEX `fk_natural_cliente1` ON `cnatural` (`fk_cli_ide` ASC) ;





-- -----------------------------------------------------

-- Table `sucursal`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `sucursal` ;



CREATE  TABLE IF NOT EXISTS `sucursal` (

  `suc_num` INT UNSIGNED NOT NULL ,

  `suc_nom` VARCHAR(25) NOT NULL ,

  `suc_dir` VARCHAR(45) NOT NULL ,

  `suc_tel` VARCHAR(10) NOT NULL ,

  `fk_ciu_num` INT UNSIGNED NOT NULL ,

  PRIMARY KEY (`suc_num`) ,

  CONSTRAINT `fk_sucursal_ciudad1`

    FOREIGN KEY (`fk_ciu_num` )

    REFERENCES `ciudad` (`ciu_num` )

    ON DELETE CASCADE

    ON UPDATE CASCADE)

ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;



CREATE INDEX `fk_sucursal_ciudad1` ON `sucursal` (`fk_ciu_num` ASC) ;





-- -----------------------------------------------------

-- Table `usuario`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `usuario` ;



CREATE  TABLE IF NOT EXISTS `usuario` (

  `usu_ide` VARCHAR(15) NOT NULL ,

  `usu_con` VARCHAR(10) NOT NULL ,

  `usu_est` BIT NOT NULL ,

  `usu_nom` VARCHAR(45) NOT NULL ,

  `usu_ape` VARCHAR(45) NOT NULL ,

  `usu_sex` CHAR NOT NULL ,

  `usu_fec_nac` DATE NOT NULL ,

  `usu_fec_ing` DATE NOT NULL ,

  `usu_tra_fin` INT UNSIGNED NOT NULL ,

  `usu_tip` INT UNSIGNED NOT NULL ,

  `usu_jef` VARCHAR(15) NULL ,

  `fk_suc_num` INT UNSIGNED NOT NULL ,

  PRIMARY KEY (`usu_ide`) ,

  CONSTRAINT `fk_usuario_sucursal1`

    FOREIGN KEY (`fk_suc_num` )

    REFERENCES `sucursal` (`suc_num` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;




CREATE INDEX `usu_CC` ON `usuario` (`usu_ide` ASC) ;



CREATE INDEX `fk_usuario_sucursal1` ON `usuario` (`fk_suc_num` ASC) ;





-- -----------------------------------------------------

-- Table `contrato`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `contrato` ;



CREATE  TABLE IF NOT EXISTS `contrato` (

  `con_num` INT UNSIGNED NOT NULL AUTO_INCREMENT ,

  `con_fec_ini_con` DATE NOT NULL ,

  `con_fec_fin_con` DATE NOT NULL ,

  `con_tip` TINYINT(1) UNSIGNED NOT NULL ,

  `con_val` DECIMAL(10,2) NOT NULL ,

  `con_est` TINYINT(1) NOT NULL DEFAULT 1 ,

  `fk_inm_num` INT NOT NULL ,

  `fk_cli_ide` VARCHAR(15) NOT NULL ,

  `fk_con_usu_ide` VARCHAR(15) NULL DEFAULT 0 ,

  PRIMARY KEY (`con_num`) ,

  CONSTRAINT `fk_contrato_inmueble1`

    FOREIGN KEY (`fk_inm_num` )

    REFERENCES `inmueble` (`inm_num` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `fk_contrato_cliente1`

    FOREIGN KEY (`fk_cli_ide` )

    REFERENCES `cliente` (`cli_ide` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `fk_contrato_usuario1`

    FOREIGN KEY (`fk_con_usu_ide` )

    REFERENCES `usuario` (`usu_ide` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;




CREATE INDEX `fk_contrato_inmueble1` ON `contrato` (`fk_inm_num` ASC) ;



CREATE INDEX `fk_contrato_cliente1` ON `contrato` (`fk_cli_ide` ASC) ;



CREATE INDEX `fk_contrato_usuario1` ON `contrato` (`fk_con_usu_ide` ASC) ;





-- -----------------------------------------------------

-- Table `pago`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `pago` ;



CREATE  TABLE IF NOT EXISTS `pago` (

  `pag_num` INT NOT NULL AUTO_INCREMENT ,

  `pag_tip_ser` TINYINT(1) NOT NULL ,

  `pag_val` DECIMAL(10,2) NOT NULL ,

  `pag_fec` DATETIME NOT NULL ,

  `pag_num_cuo` INT NOT NULL COMMENT '	' ,

  `pag_desc` VARCHAR(255) NULL ,

  `fk_con_num` INT UNSIGNED NOT NULL ,

  `fk_cli_ide` VARCHAR(15) NOT NULL ,

  PRIMARY KEY (`pag_num`) ,

  CONSTRAINT `fk_pagos_contrato1`

    FOREIGN KEY (`fk_con_num` )

    REFERENCES `contrato` (`con_num` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `fk_pagos_cliente1`

    FOREIGN KEY (`fk_cli_ide` )

    REFERENCES `cliente` (`cli_ide` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;



CREATE INDEX `fk_pagos_contrato1` ON `pago` (`fk_con_num` ASC) ;



CREATE INDEX `fk_pagos_cliente1` ON `pago` (`fk_cli_ide` ASC) ;





-- -----------------------------------------------------

-- Table `users`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `users` ;



CREATE  TABLE IF NOT EXISTS `users` (

  `id` INT(11) NOT NULL AUTO_INCREMENT ,

  `usrName` VARCHAR(25) NOT NULL ,

  `pwd` VARCHAR(255) NOT NULL ,

  PRIMARY KEY (`id`) )

ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;





-- -----------------------------------------------------

-- Table `logusuarios`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `logusuarios` ;



CREATE  TABLE IF NOT EXISTS `logusuarios` (

  `id_log` INT NOT NULL AUTO_INCREMENT ,

  `nomusr_log` VARCHAR(15) NOT NULL ,

  `pwd_log` VARCHAR(15) NOT NULL ,

  `fecha_log` DATE NOT NULL ,

  `hora_log` TIME NOT NULL ,

  PRIMARY KEY (`id_log`) )

ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;






-- -----------------------------------------------------

-- Table `phpjobscheduler`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `phpjobscheduler` ;



CREATE  TABLE IF NOT EXISTS `phpjobscheduler` (

  `id` INT(11) NOT NULL AUTO_INCREMENT ,

  `scriptpath` VARCHAR(255) NULL DEFAULT NULL ,

  `name` VARCHAR(128) NULL DEFAULT NULL ,

  `time_interval` INT(11) NULL DEFAULT NULL ,

  `fire_time` INT(11) NOT NULL DEFAULT 0 ,

  `time_last_fired` INT(11) NULL DEFAULT NULL ,

  `run_only_once` TINYINT(1) NOT NULL DEFAULT 0 ,

  `currently_running` TINYINT(1) NOT NULL DEFAULT 0 ,

  PRIMARY KEY (`id`) )

ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;






-- -----------------------------------------------------

-- Table `phpjobscheduler_logs`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `phpjobscheduler_logs` ;



CREATE  TABLE IF NOT EXISTS `phpjobscheduler_logs` (

  `id` INT(11) NOT NULL ,

  `script` VARCHAR(128) NULL DEFAULT NULL ,

  `output` TEXT NULL ,

  `execution_time` VARCHAR(60) NULL DEFAULT NULL ,

  PRIMARY KEY (`id`) )

ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;






-- -----------------------------------------------------

-- Table `cambios_contrato`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `cambios_contrato` ;



CREATE  TABLE IF NOT EXISTS `cambios_contrato` (

  `camb_con_num` INT NOT NULL AUTO_INCREMENT ,

  `camb_con_fec` DATETIME NOT NULL ,

  `camb_con_ant_cli` VARCHAR(15) NOT NULL ,

  `camb_con_new_cli` VARCHAR(15) NOT NULL ,

  `camb_con_est_ant` TINYINT(1) NOT NULL ,

  `camb_con_est_new` TINYINT(1) NOT NULL ,

  `fk_contrato_con_num` INT UNSIGNED NOT NULL ,

  PRIMARY KEY (`camb_con_num`) ,

  CONSTRAINT `fk_Cambios_Contrato_contrato1`

    FOREIGN KEY (`fk_contrato_con_num` )

    REFERENCES `contrato` (`con_num` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;




CREATE INDEX `fk_Cambios_Contrato_contrato1` ON `cambios_contrato` (`fk_contrato_con_num` ASC) ;





-- -----------------------------------------------------

-- Table `cambios_inmueble`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `cambios_inmueble` ;



CREATE  TABLE IF NOT EXISTS `cambios_inmueble` (

  `camb_inm_num` INT NOT NULL AUTO_INCREMENT ,

  `camb_inm_tip` TINYINT(1) NOT NULL ,

  `camb_inm_fec` DATETIME NOT NULL ,

  `camb_inm_est_new` TINYINT(1) NOT NULL ,

  `camb_inm_est_old` TINYINT(1) NOT NULL ,

  `fk_camb_inm_num` INT NOT NULL ,

  PRIMARY KEY (`camb_inm_num`) ,

  CONSTRAINT `fk_cambios_inmueble_inmueble1`

    FOREIGN KEY (`fk_camb_inm_num` )

    REFERENCES `inmueble` (`inm_num` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB

DEFAULT CHARACTER SET = utf8

COLLATE = utf8_general_ci;




CREATE INDEX `fk_cambios_inmueble_inmueble1` ON `cambios_inmueble` (`fk_camb_inm_num` ASC) ;



USE `xth_8767702_inmosys_db`;



DELIMITER $$



USE `xth_8767702_inmosys_db`$$

DROP TRIGGER IF EXISTS `inmueble_actualizacion` $$

USE `xth_8767702_inmosys_db`$$





CREATE TRIGGER inmueble_actualizacion after UPDATE ON inmueble

   FOR each ROW	BEGIN

		IF OLD.inm_dis != NEW.inm_dis  THEN

			INSERT INTO cambios_inmueble

			(camb_inm_fec,camb_inm_tip,camb_inm_est_new,camb_inm_est_old,fk_camb_inm_num)

			VALUES

			(NOW(), 1,NEW.inm_dis, OLD.inm_dis, OLD.inm_num);

    ELSE

			INSERT INTO cambios_inmueble

			(camb_inm_fec,camb_inm_tip,camb_inm_est_new,camb_inm_est_old,fk_camb_inm_num)

			VALUES

			(NOW(), 0,NEW.inm_dis, OLD.inm_dis, OLD.inm_num);

		END IF;

	END;$$





DELIMITER ;



DELIMITER $$



USE `xth_8767702_inmosys_db`$$

DROP TRIGGER IF EXISTS `contrato_actualizacion` $$

USE `xth_8767702_inmosys_db`$$





CREATE TRIGGER contrato_actualizacion after UPDATE ON contrato

   FOR each ROW	BEGIN

		IF OLD.fk_cli_ide != NEW.fk_cli_ide THEN

			INSERT INTO cambios_contrato

			(camb_con_fec,camb_con_ant_cli,camb_con_new_cli,camb_con_est_ant,camb_con_est_new,fk_contrato_con_num)

			VALUES

			(NOW(), OLD.fk_cli_ide, NEW.fk_cli_ide,OLD.con_est,NEW.con_est, OLD.con_num);

		END IF;

	END;$$





DELIMITER ;





SET SQL_MODE=@OLD_SQL_MODE;

SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

