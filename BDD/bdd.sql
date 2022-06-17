-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `easyportal` DEFAULT CHARACTER SET utf8 ;
USE `easyportal` ;

-- -----------------------------------------------------
-- Table `easyportal`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `easyportal`.`user` (
  `username` VARCHAR(16) NOT NULL,
  `password` VARCHAR(45) NULL,
  `firstName` VARCHAR(45) NULL,
  `lastName` VARCHAR(45) NULL,
  `perm` VARCHAR(5) NULL,
  PRIMARY KEY (`username`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `easyportal`.`plates`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `easyportal`.`plates` (
  `plateNumber` INT NOT NULL,
  `owner` VARCHAR(16) NOT NULL,
  PRIMARY KEY (`plateNumber`),
  INDEX `fk_plates_user_idx` (`owner` ASC),
  CONSTRAINT `fk_plates_user`
    FOREIGN KEY (`owner`)
    REFERENCES `easyportal`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `easyportal`.`logs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `easyportal`.`logs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `action` VARCHAR(45) NULL,
  `user` VARCHAR(16) NOT NULL,
  `date` VARCHAR(45) NULL,
  `hour` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_logs_user1_idx` (`user` ASC),
  CONSTRAINT `fk_logs_user1`
    FOREIGN KEY (`user`)
    REFERENCES `easyportal`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
