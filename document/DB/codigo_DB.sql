-- MySQL Script generated by MySQL Workbench
-- Sat Jan  7 16:17:53 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_nekomata
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_nekomata
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_nekomata` DEFAULT CHARACTER SET utf8 ;
USE `db_nekomata` ;

-- -----------------------------------------------------
-- Table `db_nekomata`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_nekomata`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NOT NULL,
  `email` VARCHAR(250) NOT NULL,
  `user_name` VARCHAR(50) NULL,
  `status` INT NOT NULL DEFAULT 2 COMMENT '1 - Ativo\n2 - bloquado',
  `is_admin` INT NOT NULL DEFAULT 2 COMMENT '1 - é um admin\n2 - não é admin\n',
  `senha` VARCHAR(255) NOT NULL,
  `thumb` BLOB NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_nekomata`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_nekomata`.`categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(200) NOT NULL COMMENT 'Nome da categoria a ser definida',
  `slug` VARCHAR(200) NOT NULL COMMENT 'Versão sem caracteres especiais dentro do nome da categoria',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_nekomata`.`postagem`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_nekomata`.`postagem` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(300) NOT NULL,
  `subtitulo` VARCHAR(200) NULL,
  `palavra_chave` VARCHAR(200) NULL,
  `slug` VARCHAR(300) NOT NULL COMMENT 'Link sem os caracteres especiais',
  `conteudo` TEXT NOT NULL,
  `status` INT NOT NULL DEFAULT 2 COMMENT '1 - publicado\n2 - rascunho',
  `data_publicacao` DATE NOT NULL,
  `thumb` BLOB NULL,
  `usuario_id` INT NOT NULL,
  `categoria_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_postagem_usuario_idx` (`usuario_id` ASC) VISIBLE,
  INDEX `fk_postagem_categoria1_idx` (`categoria_id` ASC) VISIBLE,
  CONSTRAINT `fk_postagem_usuario`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `db_nekomata`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_postagem_categoria1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `db_nekomata`.`categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
