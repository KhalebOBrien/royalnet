DROP DATABASE IF EXISTS `royalnet`;
CREATE DATABASE `royalnet`;
USE `royalnet`;

CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `surname` varchar(255) NOT NULL,
    `other_names` varchar(255) NOT NULL,
    `phone` varchar(255) NOT NULL,
    `referral_code` varchar(255) NOT NULL,
    `referrers_code` varchar(255) NULL DEFAULT NULL,
    `is_admin` tinyint(1) NULL DEFAULT 0,
    `is_approved` tinyint(1) NULL DEFAULT 0,
    `is_verified` tinyint(1) NULL DEFAULT 0,
    `is_suspended` tinyint(1) NULL DEFAULT 0,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `pwd_reset_token` varchar(255) NULL,
    `token_created_at` datetime NULL DEFAULT NULL,
    `created_at` datetime NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `users` 
    ADD `fb_link` VARCHAR(255) NULL DEFAULT NULL AFTER `token_created_at`, 
    ADD `ig_link` VARCHAR(255) NULL DEFAULT NULL AFTER `fb_link`, 
    ADD `tw_link` VARCHAR(255) NULL DEFAULT NULL AFTER `ig_link`, 
    ADD `yt_link` VARCHAR(255) NULL DEFAULT NULL AFTER `tw_link`;