-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE DATABASE "ecommerce" -----------------------------
CREATE DATABASE IF NOT EXISTS `ecommerce` CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ecommerce`;
-- ---------------------------------------------------------


-- CREATE TABLE "category" ---------------------------------
-- DROP TABLE "category" ---------------------------------------
DROP TABLE IF EXISTS `category` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "category" -------------------------------------
CREATE TABLE `category` ( 
	`category_id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`cate_name` VarChar( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`cate_description` VarChar( 144 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	PRIMARY KEY ( `category_id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 3;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "people" -----------------------------------
-- DROP TABLE "people" -----------------------------------------
DROP TABLE IF EXISTS `people` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "people" ---------------------------------------
CREATE TABLE `people` ( 
	`people_id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`peop_email` VarChar( 144 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`peop_firstName` VarChar( 144 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`peop_lastName` VarChar( 144 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	PRIMARY KEY ( `people_id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 3;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "product" ----------------------------------
-- DROP TABLE "product" ----------------------------------------
DROP TABLE IF EXISTS `product` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "product" --------------------------------------
CREATE TABLE `product` ( 
	`product_id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`prod_name` VarChar( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`prod_description` VarChar( 144 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`prod_size` VarChar( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`prod_price` Float( 12, 0 ) NOT NULL DEFAULT '0',
	`prod_offerPrice` Float( 12, 0 ) NOT NULL DEFAULT '0',
	`prod_stock` Int( 11 ) NOT NULL DEFAULT '0',
	`prod_category_id` Int( 11 ) NOT NULL,
	`prod_imgName` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	PRIMARY KEY ( `product_id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 3;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "productsList" -----------------------------
-- DROP TABLE "productsList" -----------------------------------
DROP TABLE IF EXISTS `productsList` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "productsList" ---------------------------------
CREATE TABLE `productsList` ( 
	`productsList_id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`prli_ts_session` Timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`prli_product_id` Int( 11 ) NOT NULL,
	`prli_quantity` Int( 11 ) NOT NULL DEFAULT '1',
	PRIMARY KEY ( `productsList_id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 6;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "sale" -------------------------------------
-- DROP TABLE "sale" -------------------------------------------
DROP TABLE IF EXISTS `sale` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "sale" -----------------------------------------
CREATE TABLE `sale` ( 
	`sale_id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`sale_prli_ts_session` Timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`sale_status` Char( 1 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'P',
	`sale_people_id` Int( 11 ) NOT NULL,
	PRIMARY KEY ( `sale_id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- Dump data of "category" ---------------------------------
INSERT INTO `category`(`category_id`,`cate_name`,`cate_description`) VALUES ( '1', 'ROPA', 'Productos de ropa' );
INSERT INTO `category`(`category_id`,`cate_name`,`cate_description`) VALUES ( '2', 'CALZADO', 'Productos de calzado' );
-- ---------------------------------------------------------


-- Dump data of "people" -----------------------------------
INSERT INTO `people`(`people_id`,`peop_email`,`peop_firstName`,`peop_lastName`) VALUES ( '1', 'jasanchezo@gmail.com', 'Alejandro', 'SÃ¡nchez' );
INSERT INTO `people`(`people_id`,`peop_email`,`peop_firstName`,`peop_lastName`) VALUES ( '2', 'dcanop@gmail.com', 'Denisse', 'Cano' );
INSERT INTO `people`(`people_id`,`peop_email`,`peop_firstName`,`peop_lastName`) VALUES ( '5', 'gsanchez@gmail.com', 'gael', 'sanchez' );
-- ---------------------------------------------------------


-- Dump data of "product" ----------------------------------
INSERT INTO `product`(`product_id`,`prod_name`,`prod_description`,`prod_size`,`prod_price`,`prod_offerPrice`,`prod_stock`,`prod_category_id`,`prod_imgName`) VALUES ( '1', 'PLAYERA CABALLERO NIKE MOD123', 'Playera para caballero marca Nike mod123', 'grande', '450', '0', '50', '1', ' ' );
INSERT INTO `product`(`product_id`,`prod_name`,`prod_description`,`prod_size`,`prod_price`,`prod_offerPrice`,`prod_stock`,`prod_category_id`,`prod_imgName`) VALUES ( '2', 'TENIS DAMA ADIDAS MOD456', 'Tenis para dama marca Adidas mod456', 'chica', '750', '550', '100', '2', ' ' );
-- ---------------------------------------------------------


-- Dump data of "productsList" -----------------------------
INSERT INTO `productsList`(`productsList_id`,`prli_ts_session`,`prli_product_id`,`prli_quantity`) VALUES ( '3', '2017-07-30 00:00:00', '1', '2' );
INSERT INTO `productsList`(`productsList_id`,`prli_ts_session`,`prli_product_id`,`prli_quantity`) VALUES ( '4', '2017-07-29 20:00:01', '2', '1' );
INSERT INTO `productsList`(`productsList_id`,`prli_ts_session`,`prli_product_id`,`prli_quantity`) VALUES ( '5', '2017-07-30 00:00:00', '2', '2' );
INSERT INTO `productsList`(`productsList_id`,`prli_ts_session`,`prli_product_id`,`prli_quantity`) VALUES ( '6', '2017-07-30 00:00:00', '2', '5' );
INSERT INTO `productsList`(`productsList_id`,`prli_ts_session`,`prli_product_id`,`prli_quantity`) VALUES ( '33', '2017-07-31 15:48:27', '1', '50' );
INSERT INTO `productsList`(`productsList_id`,`prli_ts_session`,`prli_product_id`,`prli_quantity`) VALUES ( '34', '2017-07-31 15:48:27', '2', '100' );
-- ---------------------------------------------------------


-- Dump data of "sale" -------------------------------------
INSERT INTO `sale`(`sale_id`,`sale_prli_ts_session`,`sale_status`,`sale_people_id`) VALUES ( '1', '2017-07-30 00:00:00', 'P', '2' );
INSERT INTO `sale`(`sale_id`,`sale_prli_ts_session`,`sale_status`,`sale_people_id`) VALUES ( '4', '2017-07-31 15:48:27', 'P', '2' );
-- ---------------------------------------------------------


-- CREATE INDEX "prod_category_id" -------------------------
-- CREATE INDEX "prod_category_id" -----------------------------
CREATE INDEX `prod_category_id` USING BTREE ON `product`( `prod_category_id` );
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE INDEX "prli_product_id" --------------------------
-- CREATE INDEX "prli_product_id" ------------------------------
CREATE INDEX `prli_product_id` USING BTREE ON `productsList`( `prli_product_id` );
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE INDEX "sale_people_id" ---------------------------
-- CREATE INDEX "sale_people_id" -------------------------------
CREATE INDEX `sale_people_id` USING BTREE ON `sale`( `sale_people_id` );
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE LINK "product_ibfk_1" ----------------------------
-- DROP LINK "product_ibfk_1" ----------------------------------
ALTER TABLE `product` DROP FOREIGN KEY `product_ibfk_1`;
-- -------------------------------------------------------------


-- CREATE LINK "product_ibfk_1" --------------------------------
ALTER TABLE `product`
	ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY ( `prod_category_id` )
	REFERENCES `category`( `category_id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE LINK "productsList_ibfk_1" -----------------------
-- DROP LINK "productsList_ibfk_1" -----------------------------
ALTER TABLE `productsList` DROP FOREIGN KEY `productsList_ibfk_1`;
-- -------------------------------------------------------------


-- CREATE LINK "productsList_ibfk_1" ---------------------------
ALTER TABLE `productsList`
	ADD CONSTRAINT `productsList_ibfk_1` FOREIGN KEY ( `prli_product_id` )
	REFERENCES `product`( `product_id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE LINK "sale_ibfk_1" -------------------------------
-- DROP LINK "sale_ibfk_1" -------------------------------------
ALTER TABLE `sale` DROP FOREIGN KEY `sale_ibfk_1`;
-- -------------------------------------------------------------


-- CREATE LINK "sale_ibfk_1" -----------------------------------
ALTER TABLE `sale`
	ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY ( `sale_people_id` )
	REFERENCES `people`( `people_id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


