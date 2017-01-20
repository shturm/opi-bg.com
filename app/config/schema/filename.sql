#App sql generated on: 2011-09-11 10:51:02 : 1315727462

DROP TABLE IF EXISTS `color_groups`;
DROP TABLE IF EXISTS `colors`;
DROP TABLE IF EXISTS `down_menu_items`;
DROP TABLE IF EXISTS `groups`;
DROP TABLE IF EXISTS `images`;
DROP TABLE IF EXISTS `images_groups`;
DROP TABLE IF EXISTS `images_products`;
DROP TABLE IF EXISTS `ordered_products`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `page_loads`;
DROP TABLE IF EXISTS `pages`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `top_menu_items`;
DROP TABLE IF EXISTS `users`;


CREATE TABLE `color_groups` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`id`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `colors` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`color_group_id` int(11) DEFAULT 0,
	`swatch` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`id`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `down_menu_items` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`link` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`order` int(11) DEFAULT NULL,
	`image` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`id`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `groups` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`latin` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`description` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`is_active` tinyint(1) DEFAULT 0,
	`order` int(11) DEFAULT NULL,
	`parent_id` int(11) DEFAULT NULL,
	`lft` int(11) DEFAULT NULL,
	`rght` int(11) DEFAULT NULL,	PRIMARY KEY  (`id`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `images` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`alt` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`path` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`id`),
	UNIQUE KEY `path` (`path`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `images_groups` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`group_id` int(11) DEFAULT NULL,
	`image_id` int(11) DEFAULT NULL,	PRIMARY KEY  (`id`),
	UNIQUE KEY `three_uniqs` (`group_id`, `image_id`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `images_products` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`product_id` int(11) DEFAULT NULL,
	`image_id` int(11) DEFAULT NULL,	PRIMARY KEY  (`id`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `ordered_products` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`product_id` int(11) DEFAULT NULL,
	`order_id` int(11) DEFAULT NULL,
	`name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`price` int(11) DEFAULT NULL,
	`cart_quantity` int(11) DEFAULT NULL,
	`discount` int(11) DEFAULT NULL,
	`discount_text` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`subtotal` int(11) DEFAULT NULL,
	`image_thumb` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`image_full` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `orders` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` int(11) DEFAULT 0,
	`user_role` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'unregistered',
	`email` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`address` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`delivery_address` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`phone` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`ip_of_order` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`date_created` timestamp DEFAULT CURRENT_TIMESTAMP,
	`user_info` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'additional info provided by the user regarding this order',
	`track_info` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'additional information for the order. by default is blank. should be used on special cases',
	`track_hash` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'hash of the order - used for users to track the status of the order',
	`total_sum` float DEFAULT NULL COMMENT 'total sum of this order',
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `page_loads` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`ip` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`user_id` int(11) DEFAULT 0,
	`when` datetime DEFAULT NULL,
	`url` varchar(512) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`referer` varchar(512) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`controller` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`action` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`id`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `pages` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`short` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`latin` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`body` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`product_id` int(11) DEFAULT NULL,
	`image_background` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`position` int(11) DEFAULT NULL,
	`is_presentation` tinyint(1) DEFAULT 0 COMMENT 'determines if the page is a product presentation',
	`is_service` tinyint(1) DEFAULT 0 COMMENT 'tells if the page is service and cannot be accessed directly',
	`is_active` tinyint(1) DEFAULT NULL,
	`parent_id` int(11) DEFAULT 0,
	`lft` int(11) DEFAULT NULL,
	`rght` int(11) DEFAULT NULL,	PRIMARY KEY  (`id`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `products` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`latin` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`description` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`group_id` int(11) DEFAULT 0,
	`collection_id` int(11) DEFAULT 0,
	`price` float DEFAULT 0 COMMENT 'price for regular users',
	`discount` float DEFAULT 0 COMMENT 'discount percent for regular users',
	`vendor_price` float DEFAULT NULL,
	`vendor_price_6` float DEFAULT NULL,
	`vendor_price_12` float DEFAULT NULL,
	`action_price` float DEFAULT 0,
	`code` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`position` int(11) DEFAULT 1,
	`is_active` tinyint(1) DEFAULT 0,
	`is_featured` tinyint(1) DEFAULT 0,
	`is_pro` tinyint(1) DEFAULT 0 COMMENT 'product is offered to registered wholesale users only due to the ammounts and specifics of the product',
	`in_action` tinyint(1) DEFAULT 0 COMMENT 'tells if the product is in auction - cut-throat low prices',
	`date_created` timestamp DEFAULT CURRENT_TIMESTAMP,
	`date_published` datetime DEFAULT NULL,
	`impressions` int(11) DEFAULT NULL,
	`color_id` int(11) DEFAULT 0,
	`image_full` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`image_thumb` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`tags` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'Опи, Opi, лак за нокти, lak, lak za nokti',
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `top_menu_items` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`link` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '#',
	`parent_id` int(11) DEFAULT NULL,
	`order` int(11) DEFAULT NULL,
	`lft` int(11) DEFAULT NULL,
	`rght` int(11) DEFAULT NULL,	PRIMARY KEY  (`id`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`password` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`email` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`address` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`delivery_address` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`phone` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`company` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`mol` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`bulstat` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`dds` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`egn` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`salon` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`confirmation_key` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`confirmation_key_sent` timestamp DEFAULT CURRENT_TIMESTAMP,
	`recovery_key` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`recovery_key_sent` datetime DEFAULT NULL,
	`register_ip` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`last_ip` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`last_login_date` datetime DEFAULT NULL,
	`date_registered` datetime DEFAULT NULL,
	`is_active` tinyint(1) DEFAULT 0,
	`is_confirmed` tinyint(1) DEFAULT 0,
	`discount` float DEFAULT 0 COMMENT 'personal discount - if for some reason the user is VIP\r\n',
	`license_code` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`id`),
	UNIQUE KEY `email_UNIQUE` (`email`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

