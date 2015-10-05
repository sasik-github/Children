-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE DATABASE "mobile" --------------------------------
CREATE DATABASE IF NOT EXISTS `mobile` CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mobile`;
-- ---------------------------------------------------------


-- CREATE TABLE "children" ---------------------------------
DROP TABLE IF EXISTS `children` CASCADE;

CREATE TABLE `children` ( 
	`id` Int( 255 ) AUTO_INCREMENT NOT NULL, 
	`name` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	 PRIMARY KEY ( `id` )
, 
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 6;
-- ---------------------------------------------------------


-- CREATE TABLE "children_to_parents" ----------------------
DROP TABLE IF EXISTS `children_to_parents` CASCADE;

CREATE TABLE `children_to_parents` ( 
	`parent_id` Int( 255 ) NULL, 
	`children_id` Int( 255 ) NULL
 )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB;
-- ---------------------------------------------------------


-- CREATE TABLE "parents" ----------------------------------
DROP TABLE IF EXISTS `parents` CASCADE;

CREATE TABLE `parents` ( 
	`id` Int( 255 ) AUTO_INCREMENT NOT NULL, 
	`login` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
	`password` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	 PRIMARY KEY ( `id` )
 )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 7;
-- ---------------------------------------------------------


-- CREATE TABLE "tokens" -----------------------------------
DROP TABLE IF EXISTS `tokens` CASCADE;

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
AUTO_INCREMENT = 158;
-- ---------------------------------------------------------


-- CREATE TABLE "users" ------------------------------------
DROP TABLE IF EXISTS `users` CASCADE;

CREATE TABLE `users` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL, 
	`phone` VarChar( 10 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, 
	`email` VarChar( 64 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, 
	`passwd` VarChar( 12 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, 
	`active` TinyInt( 1 ) NOT NULL DEFAULT '0', 
	`dt` Timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, 
	`token` VarChar( 32 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	 PRIMARY KEY ( `id` )
 )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- CREATE TABLE "messages" ---------------------------------
DROP TABLE IF EXISTS `messages` CASCADE;

CREATE TABLE `messages` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL, 
	`parent_id` Int( 11 ) NOT NULL, 
	`children_id` Int( 11 ) NOT NULL, 
	`date` DateTime NOT NULL DEFAULT CURRENT_TIMESTAMP, 
	`message` Text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	 PRIMARY KEY ( `id` )
, 
	CONSTRAINT `unique_children_id` UNIQUE( `children_id` ), 
	CONSTRAINT `unique_parent_id` UNIQUE( `parent_id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- Dump data of "children" ---------------------------------
INSERT INTO `children`(`id`,`name`) VALUES ( '1', 'Дитеныш' );
INSERT INTO `children`(`id`,`name`) VALUES ( '2', 'Любимый сынуля' );
INSERT INTO `children`(`id`,`name`) VALUES ( '3', 'Женин сын' );
INSERT INTO `children`(`id`,`name`) VALUES ( '4', 'А.А. Трусов сын' );
INSERT INTO `children`(`id`,`name`) VALUES ( '5', 'Анна' );
-- ---------------------------------------------------------


-- Dump data of "children_to_parents" ----------------------
INSERT INTO `children_to_parents`(`parent_id`,`children_id`) VALUES ( '1', '1' );
INSERT INTO `children_to_parents`(`parent_id`,`children_id`) VALUES ( '2', '2' );
INSERT INTO `children_to_parents`(`parent_id`,`children_id`) VALUES ( '4', '1' );
INSERT INTO `children_to_parents`(`parent_id`,`children_id`) VALUES ( '5', '4' );
INSERT INTO `children_to_parents`(`parent_id`,`children_id`) VALUES ( '6', '5' );
-- ---------------------------------------------------------


-- Dump data of "parents" ----------------------------------
INSERT INTO `parents`(`id`,`login`,`password`) VALUES ( '1', '89131221178', '89131221178' );
INSERT INTO `parents`(`id`,`login`,`password`) VALUES ( '2', '89516021698', '89516021698' );
INSERT INTO `parents`(`id`,`login`,`password`) VALUES ( '4', '89080448578', '89080448578' );
INSERT INTO `parents`(`id`,`login`,`password`) VALUES ( '5', '89128933688', '89128933688' );
INSERT INTO `parents`(`id`,`login`,`password`) VALUES ( '6', '89193285728', '12345' );
-- ---------------------------------------------------------


-- Dump data of "tokens" -----------------------------------
INSERT INTO `tokens`(`id`,`parent_id`,`token`,`type`) VALUES ( '138', '4', 'e-xrzIBB8us:APA91bEMidHJFBJeHctuizNVf_UmqrWD2H7Lu7D_mhn91-poKm4U7XrYViqI936F3ZvkYDHPo56nflSzxAZs5l_6qUK7B4M7Unj9MZ2dYSOtViESPgcXlZ9yn4hBgOu0Q0WA6Gmqnafb', '0' );
INSERT INTO `tokens`(`id`,`parent_id`,`token`,`type`) VALUES ( '139', '4', 'dbAk3ATP7cA:APA91bF1QzHkJkyBdjAfBTdP0KjsYBK29dIebtp2UPzsnCivfc7rEf3krd6_F9VQ4_MLGmiiq10J8fJrca-cuwoLWlaOmCfhtzGsRk7NQX1YYMj_XiHLBm5HrB3GBAup9JlJhxE07KXO', '0' );
INSERT INTO `tokens`(`id`,`parent_id`,`token`,`type`) VALUES ( '147', '4', 'eV-2KnC3oVE:APA91bG8CqjMH--tjMmvF3VxY8K5ccX2VD_c_vLrNF4nmpufR7BCr1afMAZeAg5hW-NEOHPbemSBVJwaSxIupfo0hPwnHn4yrNCpY4SN7yOTNk-dL4vAqEJxZ2QLym7aORwW0uvQ6jz3', '0' );
INSERT INTO `tokens`(`id`,`parent_id`,`token`,`type`) VALUES ( '153', '4', 'dILO5t92_5k:APA91bFjTA0fj-FZ_w3rapaaJYw1hz-h0kb0m2wNVFfho06dqBuYTU54BR0frJDgKnf8cESX-nb4-n8dbHU3N5uXvkjzVgNUs-lVNhv_nAEEoVZtuM3gCDL-xmE6UdQB5vFnBu9KabJx', '0' );
INSERT INTO `tokens`(`id`,`parent_id`,`token`,`type`) VALUES ( '154', '4', 'edARSdzp-IA:APA91bGC5OMc_Y3_MLo3NjiByQ_pU3vamtdHl1N5XFRU9zG-MjAXvUMmKKnKxwxY533lAjr252K5KWzsVbuyvlZScUQGfGpjbszwEi2HFVDf7e6tXW0z5LOTkiYn4YpMcgSTSx_sUOOk', '0' );
INSERT INTO `tokens`(`id`,`parent_id`,`token`,`type`) VALUES ( '155', '1', 'cnXimksSovk:APA91bGEZUJ0FHnVrgQ0nJ6PswxQRiM11GJY0NZn4ULkWChpKtxsL8wMPTeiDqPjAfa7ey5UC8reSeRXGHXFUlyYOjJsFNkJkDHm22PVE9H-5YHTvUydlLSb9UELx6N11BgcIsbHoE9q', '0' );
INSERT INTO `tokens`(`id`,`parent_id`,`token`,`type`) VALUES ( '156', '6', 'dki4Z0FsV2o:APA91bHUdXV9RTCqtuTfjmumCpT2ozsyy2lgwAudP7mmQLKRJ5v4NN-ID4lRr2xsUtv7mBdhwF91kaFFohtwRyGivb2X_9YRkrVxl8HB0Upo4c6nyPeAC7D0g_aVC1QuOVrZjy9W2XBY', '0' );
-- ---------------------------------------------------------


-- Dump data of "users" ------------------------------------
-- ---------------------------------------------------------


-- Dump data of "messages" ---------------------------------
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


-- CREATE INDEX "phone" ------------------------------------
CREATE INDEX `phone` USING BTREE ON `users`( `phone`, `email`, `active` );
-- ---------------------------------------------------------


-- CREATE INDEX "parent_id" --------------------------------
CREATE INDEX `parent_id` USING BTREE ON `messages`( `parent_id`, `children_id`, `date` );
-- ---------------------------------------------------------


-- CREATE LINK "fk_children_to_parents_to_children" --------
ALTER TABLE `children_to_parents` DROP FOREIGN KEY `fk_children_to_parents_to_children`;


ALTER TABLE `children_to_parents` ADD CONSTRAINT `fk_children_to_parents_to_children` FOREIGN KEY ( `children_id` ) REFERENCES `children`( `id` ) ON DELETE Cascade ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "fk_children_to_parents_to_parents" ---------
ALTER TABLE `children_to_parents` DROP FOREIGN KEY `fk_children_to_parents_to_parents`;


ALTER TABLE `children_to_parents` ADD CONSTRAINT `fk_children_to_parents_to_parents` FOREIGN KEY ( `parent_id` ) REFERENCES `parents`( `id` ) ON DELETE Cascade ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "fk_tokens_to_parent" -----------------------
ALTER TABLE `tokens` DROP FOREIGN KEY `fk_tokens_to_parent`;


ALTER TABLE `tokens` ADD CONSTRAINT `fk_tokens_to_parent` FOREIGN KEY ( `parent_id` ) REFERENCES `parents`( `id` ) ON DELETE No Action ON UPDATE No Action;
-- ---------------------------------------------------------


-- CREATE LINK "fk_messages_to_children" -------------------
ALTER TABLE `messages` DROP FOREIGN KEY `fk_messages_to_children`;


ALTER TABLE `messages` ADD CONSTRAINT `fk_messages_to_children` FOREIGN KEY ( `children_id` ) REFERENCES `children`( `id` ) ON DELETE Cascade ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "fk_messages_to_parents" --------------------
ALTER TABLE `messages` DROP FOREIGN KEY `fk_messages_to_parents`;


ALTER TABLE `messages` ADD CONSTRAINT `fk_messages_to_parents` FOREIGN KEY ( `parent_id` ) REFERENCES `parents`( `id` ) ON DELETE Cascade ON UPDATE Cascade;
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


