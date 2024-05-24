-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema bildb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema aarsoppgave
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema aarsoppgave
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `aarsoppgave` ;
USE `aarsoppgave` ;

-- -----------------------------------------------------
-- Table `aarsoppgave`.`faq`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aarsoppgave`.`faq` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `question` VARCHAR(255) NOT NULL,
  `answer` TEXT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 8;


-- -----------------------------------------------------
-- Table `aarsoppgave`.`items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aarsoppgave`.`items` (
  `item_id` INT(11) NOT NULL,
  `image` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `rarity` VARCHAR(20) NOT NULL,
  `description` TEXT NOT NULL,
  PRIMARY KEY (`item_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aarsoppgave`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aarsoppgave`.`roles` (
  `roleid` INT(11) NOT NULL,
  `rolename` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`roleid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aarsoppgave`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aarsoppgave`.`users` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  `kallenavn` VARCHAR(45) NULL DEFAULT NULL,
  `username` VARCHAR(45) NOT NULL,
  `pwd` VARCHAR(200) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `money` INT(11) NOT NULL DEFAULT 0,
  `role_id` INT(11) NOT NULL DEFAULT 1,
  `current_page` VARCHAR(45) NOT NULL DEFAULT 'Page0',
  PRIMARY KEY (`user_id`, `role_id`),
  INDEX `fk_users_roles1_idx` (`role_id` ASC),
  CONSTRAINT `fk_users_roles1`
    FOREIGN KEY (`role_id`)
    REFERENCES `aarsoppgave`.`roles` (`roleid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 18;


-- -----------------------------------------------------
-- Table `aarsoppgave`.`user_inventory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aarsoppgave`.`user_inventory` (
  `invid` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `itemid` INT(11) NOT NULL,
  `quantity` INT(11) NOT NULL,
  PRIMARY KEY (`invid`, `user_id`, `itemid`),
  INDEX `fk_user_inventory_users1_idx` (`user_id` ASC),
  INDEX `fk_user_inventory_items1_idx` (`itemid` ASC),
  CONSTRAINT `fk_user_inventory_items1`
    FOREIGN KEY (`itemid`)
    REFERENCES `aarsoppgave`.`items` (`item_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_inventory_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `aarsoppgave`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
