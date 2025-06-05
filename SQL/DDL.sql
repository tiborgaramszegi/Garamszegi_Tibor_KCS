CREATE DATABASE `Garamszegi_Tibor_KCS`;

USE `Garamszegi_Tibor_KCS`;

CREATE TABLE `kapcsolattarto` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `vnev` VARCHAR(30) NOT NULL,
  `knev` VARCHAR(30) NOT NULL,
  `unev` VARCHAR(30),
  `telefon` VARCHAR(20) NOT NULL,
  `email` VARCHAR(30) NOT NULL
);

CREATE TABLE `statusz` (
  `id` INT PRIMARY KEY,
  `leiras` VARCHAR(30) NOT NULL
);

CREATE TABLE `termek` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `szeriaszam` VARCHAR(20) NOT NULL,
  `gyarto` VARCHAR(20) NOT NULL,
  `tipus` VARCHAR(20) NOT NULL,
  `leadas` DATE NOT NULL,
  `statuszid` INT NOT NULL,
  `statuszvaltozas` DATE NOT NULL,
  `kapcsolattartoid` INT NOT NULL,
  FOREIGN KEY (`statuszid`) REFERENCES `statusz`(`id`),
  FOREIGN KEY (`kapcsolattartoid`) REFERENCES `kapcsolattarto`(`id`)
);