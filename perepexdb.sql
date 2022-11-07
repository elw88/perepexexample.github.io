-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema perepexdb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema perepexdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `perepexdb` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema classicmodels
-- -----------------------------------------------------
USE `perepexdb` ;

-- -----------------------------------------------------
-- Table `perepexdb`.`instructors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `perepexdb`.`instructors` (
  `instructor_id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `title` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`instructor_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `perepexdb`.`classes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `perepexdb`.`classes` (
  `class_id` INT NOT NULL AUTO_INCREMENT,
  `fk_instructor_id` INT NOT NULL,
  `class_name` VARCHAR(45) NULL,
  PRIMARY KEY (`class_id`),
  INDEX `fk_instructor_id_idx` (`fk_instructor_id` ASC),
  CONSTRAINT `fk_class_instructor_id`
    FOREIGN KEY (`fk_instructor_id`)
    REFERENCES `perepexdb`.`instructors` (`instructor_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `perepexdb`.`assignments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `perepexdb`.`assignments` (
  `assignment_id` INT NOT NULL AUTO_INCREMENT,
  `fk_class_id` INT NOT NULL,
  `assignment_name` VARCHAR(45) NULL,
  `due_date` DATETIME NULL,
  `assignmet_desc` TEXT NULL,
  PRIMARY KEY (`assignment_id`),
  INDEX `fk_class_id_idx` (`fk_class_id` ASC),
  CONSTRAINT `fk_assignment_class_id`
    FOREIGN KEY (`fk_class_id`)
    REFERENCES `perepexdb`.`classes` (`class_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `perepexdb`.`student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `perepexdb`.`student` (
  `student_id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`student_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `perepexdb`.`submissions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `perepexdb`.`submissions` (
  `submission_id` INT NOT NULL AUTO_INCREMENT,
  `fk_student_id` INT NOT NULL,
  `fk_assignment_id` INT NOT NULL,
  `file_path` VARCHAR(45) NULL,
  `is_submitted` TINYINT NULL,
  `file_name` VARCHAR(45) NULL,
  PRIMARY KEY (`submission_id`),
  INDEX `fk_assignment_id_idx` (`fk_assignment_id` ASC),
  INDEX `fk_sub_studnet_id_idx` (`fk_student_id` ASC),
  CONSTRAINT `fk_sub_assignment_id`
    FOREIGN KEY (`fk_assignment_id`)
    REFERENCES `perepexdb`.`assignments` (`assignment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sub_studnet_id`
    FOREIGN KEY (`fk_student_id`)
    REFERENCES `perepexdb`.`student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `perepexdb`.`responses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `perepexdb`.`responses` (
  `response_id` INT NOT NULL AUTO_INCREMENT,
  `fk_student_id` INT NOT NULL,
  `fk_assignment_id` INT NOT NULL,
  `fk_submission_id` INT NOT NULL,
  `file_path` VARCHAR(45) NULL,
  `file_name` VARCHAR(45) NULL,
  `is_submitted` TINYINT NULL,
  `due_date` DATETIME NULL,
  PRIMARY KEY (`response_id`),
  INDEX `fk_assignment_id_idx` (`fk_assignment_id` ASC),
  INDEX `fk_submission_id_idx` (`fk_submission_id` ASC),
  INDEX `fk_response_student_id_idx` (`fk_student_id` ASC),
  CONSTRAINT `fk_response_assignment_id`
    FOREIGN KEY (`fk_assignment_id`)
    REFERENCES `perepexdb`.`assignments` (`assignment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_response_submission_id`
    FOREIGN KEY (`fk_submission_id`)
    REFERENCES `perepexdb`.`submissions` (`submission_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_response_student_id`
    FOREIGN KEY (`fk_student_id`)
    REFERENCES `perepexdb`.`student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `perepexdb`.`student_class_junction`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `perepexdb`.`student_class_junction` (
  `fk_class_id` INT NOT NULL,
  `fk_student_id` INT NOT NULL,
  INDEX `fk_class_id_idx` (`fk_class_id` ASC),
  INDEX `fk_junc_student_id_idx` (`fk_student_id` ASC),
  CONSTRAINT `fk_junc_class_id`
    FOREIGN KEY (`fk_class_id`)
    REFERENCES `perepexdb`.`classes` (`class_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_junc_student_id`
    FOREIGN KEY (`fk_student_id`)
    REFERENCES `perepexdb`.`student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
