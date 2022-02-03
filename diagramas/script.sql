-- MySQL Script generated by MySQL Workbench
-- Mon Jul 30 18:42:13 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema ingressos
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `ingressos` ;

-- -----------------------------------------------------
-- Schema ingressos
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ingressos` DEFAULT CHARACTER SET utf8 ;
USE `ingressos` ;

-- -----------------------------------------------------
-- Table `ingressos`.`clientes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ingressos`.`clientes` ;

CREATE TABLE IF NOT EXISTS `ingressos`.`clientes` (
  `id_cliente` INT NOT NULL AUTO_INCREMENT,
  `nome_razao` VARCHAR(150) NULL,
  `cpf_cnpj` VARCHAR(45) NULL,
  `logradouro` VARCHAR(150) NULL,
  `bairro` VARCHAR(45) NULL,
  `numero` VARCHAR(20) NULL,
  `cidade` VARCHAR(150) NULL,
  `uf` VARCHAR(5) NULL,
  `complemento` VARCHAR(150) NULL,
  `cep` VARCHAR(45) NULL,
  `tel` VARCHAR(45) NULL,
  `data_cadastro` DATE NULL,
  `status` INT NULL,
  PRIMARY KEY (`id_cliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ingressos`.`eventos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ingressos`.`eventos` ;

CREATE TABLE IF NOT EXISTS `ingressos`.`eventos` (
  `id_evento` INT NOT NULL AUTO_INCREMENT,
  `fk_cliente` INT NULL,
  `nome` VARCHAR(45) NULL,
  `logradouro` VARCHAR(250) NULL,
  `bairro` VARCHAR(250) NULL,
  `numero` VARCHAR(45) NULL,
  `cidade` VARCHAR(250) NULL,
  `uf` VARCHAR(5) NULL,
  `complemento` VARCHAR(250) NULL,
  `cep` VARCHAR(45) NULL,
  `tipo` INT NULL,
  `status` INT NULL,
  `data_cadastro` DATE NULL,
  `logo` VARCHAR(250) NULL,
  `nome_local` VARCHAR(250) NULL,
  PRIMARY KEY (`id_evento`),
  INDEX `fk_cliente_idx` (`fk_cliente` ASC),
  CONSTRAINT `fk_cliente`
    FOREIGN KEY (`fk_cliente`)
    REFERENCES `ingressos`.`clientes` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ingressos`.`subeventos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ingressos`.`subeventos` ;

CREATE TABLE IF NOT EXISTS `ingressos`.`subeventos` (
  `id_subevento` INT NOT NULL AUTO_INCREMENT,
  `fk_evento` INT NULL,
  `data` DATE NULL,
  `hora_inicio` INT NULL,
  `hora_fim` INT NULL,
  `min_inicio` INT NULL,
  `min_fim` INT NULL,
  PRIMARY KEY (`id_subevento`),
  INDEX `fk_evento_subevento_idx` (`fk_evento` ASC),
  CONSTRAINT `fk_evento_subevento`
    FOREIGN KEY (`fk_evento`)
    REFERENCES `ingressos`.`eventos` (`id_evento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ingressos`.`entidades`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ingressos`.`entidades` ;

CREATE TABLE IF NOT EXISTS `ingressos`.`entidades` (
  `id_entidade` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NULL,
  `status` INT NULL,
  `tipo` INT NULL,
  `params` VARCHAR(250) NULL,
  PRIMARY KEY (`id_entidade`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ingressos`.`lotes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ingressos`.`lotes` ;

CREATE TABLE IF NOT EXISTS `ingressos`.`lotes` (
  `id_lote` INT NOT NULL AUTO_INCREMENT,
  `fk_subevento` INT NULL,
  `fk_tipo` INT NULL,
  `codigo` VARCHAR(45) NULL,
  `data_limite_impressao` DATE NULL,
  `preco` VARCHAR(45) NULL,
  `quantidade` INT NULL,
  `tipo_preco` INT NULL COMMENT '// 1 integral 2 meia entrada 3 cortesia',
  PRIMARY KEY (`id_lote`),
  INDEX `fk_subevento_idx` (`fk_subevento` ASC),
  INDEX `fk_tipo_lotes_idx` (`fk_tipo` ASC),
  CONSTRAINT `fk_subevento_lotes`
    FOREIGN KEY (`fk_subevento`)
    REFERENCES `ingressos`.`subeventos` (`id_subevento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipo_lotes`
    FOREIGN KEY (`fk_tipo`)
    REFERENCES `ingressos`.`entidades` (`id_entidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ingressos`.`ingressos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ingressos`.`ingressos` ;

CREATE TABLE IF NOT EXISTS `ingressos`.`ingressos` (
  `id_ingresso` INT NOT NULL AUTO_INCREMENT,
  `fk_lote` INT NULL,
  `codigo` VARCHAR(250) NULL,
  `usado` INT NULL,
  `data_usado` DATE NULL,
  `hora_usado` INT NULL,
  `min_usado` INT NULL,
  PRIMARY KEY (`id_ingresso`),
  INDEX `fk_lote_idx` (`fk_lote` ASC),
  CONSTRAINT `fk_lote`
    FOREIGN KEY (`fk_lote`)
    REFERENCES `ingressos`.`lotes` (`id_lote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ingressos`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ingressos`.`usuarios` ;

CREATE TABLE IF NOT EXISTS `ingressos`.`usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `senha` VARCHAR(250) NULL,
  `status` INT NULL,
  `data_cadastro` DATE NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ingressos`.`empresas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ingressos`.`empresas` ;

CREATE TABLE IF NOT EXISTS `ingressos`.`empresas` (
  `id_empresa` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(45) NULL,
  `nome_razao` VARCHAR(150) NULL,
  `cpf_cnpj` VARCHAR(45) NULL,
  `liberada_ate` DATE NULL,
  `status` INT NULL,
  `tel_1` VARCHAR(45) NULL,
  `tel_2` VARCHAR(45) NULL,
  `site` VARCHAR(250) NULL,
  `email` VARCHAR(250) NULL,
  `logo` VARCHAR(250) NULL,
  PRIMARY KEY (`id_empresa`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
