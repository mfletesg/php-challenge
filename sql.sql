-- MySQL Script generated by MySQL Workbench
-- Sun Aug 25 09:59:31 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema systemDb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema systemDb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `systemDb` DEFAULT CHARACTER SET utf8 ;
USE `systemDb` ;

-- -----------------------------------------------------
-- Table `systemDb`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `systemDb`.`user` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `pass` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `systemDb`.`task`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `systemDb`.`task` (
  `id` INT NOT NULL,
  `title` VARCHAR(60) NULL,
  `description` TEXT NULL,
  `status` VARCHAR(15) NULL,
  `created_at` DATETIME NULL DEFAULT now(),
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `systemDb`.`user_task`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `systemDb`.`user_task` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `task_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_task_user_idx` (`user_id` ASC),
  INDEX `fk_user_task_task1_idx` (`task_id` ASC),
  CONSTRAINT `fk_user_task_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `systemDb`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_task_task1`
    FOREIGN KEY (`task_id`)
    REFERENCES `systemDb`.`task` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;