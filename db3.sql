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


-- CREATE INDEX "index_id" ---------------------------------
CREATE INDEX `index_id` USING BTREE ON `children`( `id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_children_to_parents_1_idx" -------------
CREATE INDEX `fk_children_to_parents_1_idx` USING BTREE ON `children_to_parents`( `children_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_children_to_parents_to_parents_idx" ----
CREATE INDEX `fk_children_to_parents_to_parents_idx` USING BTREE ON `children_to_parents`( `parent_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_tokens_to_parent_idx" ------------------
CREATE INDEX `fk_tokens_to_parent_idx` USING BTREE ON `tokens`( `parent_id` );
-- ---------------------------------------------------------


-- CREATE LINK "fk_children_to_parents_to_parents" ---------
ALTER TABLE `children_to_parents` ADD CONSTRAINT `fk_children_to_parents_to_parents` FOREIGN KEY ( `parent_id` ) REFERENCES `parents`( `id` ) ON DELETE Cascade ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "fk_children_to_parents_to_children" --------
ALTER TABLE `children_to_parents` ADD CONSTRAINT `fk_children_to_parents_to_children` FOREIGN KEY ( `children_id` ) REFERENCES `children`( `id` ) ON DELETE Cascade ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "fk_tokens_to_parent" -----------------------
ALTER TABLE `tokens` ADD CONSTRAINT `fk_tokens_to_parent` FOREIGN KEY ( `parent_id` ) REFERENCES `parents`( `id` ) ON DELETE No Action ON UPDATE No Action;
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


