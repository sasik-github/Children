-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE TABLE "children" ---------------------------------
CREATE TABLE `children` ( 
	`id` Int( 255 ) AUTO_INCREMENT NOT NULL, 
	`name` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	 PRIMARY KEY ( `id` )
, 
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 3;
-- ---------------------------------------------------------


-- CREATE TABLE "parents" ----------------------------------
CREATE TABLE `parents` ( 
	`id` Int( 255 ) AUTO_INCREMENT NOT NULL, 
	`login` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
	`password` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	 PRIMARY KEY ( `id` )
 )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- CREATE TABLE "tokens" -----------------------------------
CREATE TABLE `tokens` ( 
	`id` Int( 255 ) AUTO_INCREMENT NOT NULL, 
	`parent_id` Int( 255 ) NOT NULL, 
	`token` VarChar( 256 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
	`type` Int( 255 ) NOT NULL,
	 PRIMARY KEY ( `id` )
 )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- CREATE TABLE "children_to_parents" ----------------------
CREATE TABLE `children_to_parents` ( 
	`parent_id` Int( 255 ) NULL, 
	`children_id` Int( 255 ) NULL
 )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB;
-- ---------------------------------------------------------


-- Dump data of "children" ---------------------------------
INSERT INTO `children`(`id`,`name`) VALUES ( '1', 'Alexandr Spesivtsev' );
INSERT INTO `children`(`id`,`name`) VALUES ( '2', 'Diana Kabaeva' );
INSERT INTO `children`(`id`,`name`) VALUES ( '3', 'Ivan Kozlov' );
INSERT INTO `children`(`id`,`name`) VALUES ( '4', 'Ivan Kozlov' );
INSERT INTO `children`(`id`,`name`) VALUES ( '5', 'Ivan Kozlov' );
INSERT INTO `children`(`id`,`name`) VALUES ( '6', 'Ivan Kozlov' );
INSERT INTO `children`(`id`,`name`) VALUES ( '7', 'Ivan Kozlov' );
-- ---------------------------------------------------------


-- Dump data of "parents" ----------------------------------
-- ---------------------------------------------------------


-- Dump data of "tokens" -----------------------------------
-- ---------------------------------------------------------


-- Dump data of "children_to_parents" ----------------------
-- ---------------------------------------------------------


-- CREATE INDEX "index_id" ---------------------------------
CREATE INDEX `index_id` USING BTREE ON `children`( `id` );
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


