-- MySQL Script generated by MySQL Workbench
-- Sun Jan 10 17:43:34 2016
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema wf3_gameloc
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema wf3_gameloc
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `wf3_gameloc` DEFAULT CHARACTER SET utf8 ;
USE `wf3_gameloc` ;

-- -----------------------------------------------------
-- Table `wf3_gameloc`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wf3_gameloc`.`users` ;

CREATE TABLE IF NOT EXISTS `wf3_gameloc`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(45) NOT NULL DEFAULT 'member',
  `lastname` VARCHAR(45) NOT NULL,
  `firstname` VARCHAR(45) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `zipcode` VARCHAR(5) NOT NULL,
  `town` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(10) NOT NULL,
  `latitude` DECIMAL(10,8) NULL,
  `longitude` DECIMAL(11,8) NULL,
  `updated_at` VARCHAR(45) NULL DEFAULT 'CURRENT_TIMESTAMP',
  `created_at` VARCHAR(45) NULL DEFAULT 'CURRENT_TIMESTAMP',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wf3_gameloc`.`platforms`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wf3_gameloc`.`platforms` ;

CREATE TABLE IF NOT EXISTS `wf3_gameloc`.`platforms` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wf3_gameloc`.`games`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wf3_gameloc`.`games` ;

CREATE TABLE IF NOT EXISTS `wf3_gameloc`.`games` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `url_img` VARCHAR(255) NULL,
  `description` TEXT NULL,
  `published_at` DATETIME NULL,
  `game_time` INT UNSIGNED NULL,
  `is_available` TINYINT(1) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `platform_id` INT UNSIGNED NOT NULL,
  `owner_user_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `platform_id`, `owner_user_id`),
  INDEX `fk_games_platforms_idx` (`platform_id` ASC),
  INDEX `fk_games_users1_idx` (`owner_user_id` ASC),
  CONSTRAINT `fk_games_platforms`
    FOREIGN KEY (`platform_id`)
    REFERENCES `wf3_gameloc`.`platforms` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_games_users1`
    FOREIGN KEY (`owner_user_id`)
    REFERENCES `wf3_gameloc`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wf3_gameloc`.`rentals`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wf3_gameloc`.`rentals` ;

CREATE TABLE IF NOT EXISTS `wf3_gameloc`.`rentals` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(45) NOT NULL DEFAULT 'waiting',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `game_id` INT UNSIGNED NOT NULL,
  `user_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `user_id`),
  INDEX `fk_renting_games1_idx` (`game_id` ASC),
  INDEX `fk_renting_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_renting_games1`
    FOREIGN KEY (`game_id`)
    REFERENCES `wf3_gameloc`.`games` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_renting_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `wf3_gameloc`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
