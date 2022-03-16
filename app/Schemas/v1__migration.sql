DROP DATABASE IF EXISTS `royalnet`;
CREATE DATABASE `royalnet`;
USE `royalnet`;

CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `surname` varchar(255) NOT NULL,
    `other_names` varchar(255) NOT NULL,
    `phone` varchar(255) NOT NULL,
    `package` INT(4) NULL DEFAULT NULL,
    `bank` INT(4) NULL DEFAULT NULL,
    `acct_number` varchar(255) NULL DEFAULT NULL,
    `acct_name` varchar(255) NULL DEFAULT NULL,
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
    `fb_link` VARCHAR(255) NULL DEFAULT NULL,
    `ig_link` VARCHAR(255) NULL DEFAULT NULL, 
    `tw_link` VARCHAR(255) NULL DEFAULT NULL, 
    `yt_link` VARCHAR(255) NULL DEFAULT NULL,
    `created_at` datetime NULL DEFAULT NULL,
    `updated_at` datetime NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `packages` (
    `id` int(4) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `description` text NULL DEFAULT NULL,
    `price` varchar(50) NOT NULL,
    `daily_commission` varchar(50) NOT NULL,
    `refferal_commission` int(4) NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `packages` (`name`, `description`, `price`, `daily_commission`, `refferal_commission`) VALUES
("Member - N3,000", "You register with N3000 and you earn N140 every day! This excludes the 50% referral commission.", "3000", "140", "50"),
("Agent - N5,000", "You register with N5000 and you earn N240 every day! This excludes the 50% referral commission.", "5000", "240", "50"),
("VIP 1 - N10,000", "You register with N10000 and you earn N420 every day! This excludes the 50% referral commission.", "10000", "420", "50"),
("VIP 2 - N25,000", "You register with N25000 and you earn N930 every day! This excludes the 50% referral commission.", "25000", "930", "50"),
("VIP 3 - N60,000", "You register with N60000 and you earn N2300 every day! This excludes the 50% referral commission.", "60000", "2300", "50"),
("Deputy Manager - N150,000", "You register with N150000 and you earn N5800 every day! This excludes the 50% referral commission.", "150000", "5800", "50"),
("Manager - N250,000", "You register with N250000 and you earn N9600 every day! This excludes the 50% referral commission.", "250000", "9600", "50"),
("Assistant Director - N500,000", "You register with N500000 and you earn N20000 every day! This excludes the 50% referral commission.", "500000", "20000", "50"),
("Director - N1,000,000", "You register with N1000000 and you earn N40500 every day! This excludes the 50% referral commission.", "1000000", "40500", "50"),
("Shareholder - N2,000,000", "You register with N2000000 and you earn N83000 every day! This excludes the 50% referral commission.", "2000000", "83000", "50");

CREATE TABLE IF NOT EXISTS `banks` (
    `id` int(4) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `banks` (`name`) VALUES
('Access Bank'),
('Access Bank (Diamond)'),
('Citibank'),
('Ecobank'),
('Fidelity Bank'),
('First Bank'),
('First City Monument Bank (FCMB)'),
('Guaranty Trust Bank (GTB)'),
('Heritage Bank'),
('Jaiz Bank'),
('Keystone Bank'),
('Kuda Bank'),
('Parallex Bank'),
('Polaris Bank'),
('Providus Bank'),
('Skye Bank'),
('Stanbic IBTC Bank'),
('Standard Chartered Bank'),
('Sterling Bank'),
('Suntrust Bank'),
('Titan Trust Bank'),
('Union Bank'),
('United Bank for Africa (UBA)'),
('Unity Bank'),
('Wema Bank'),
('Zenith Bank');

CREATE TABLE IF NOT EXISTS `wallet` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NULL DEFAULT NULL,
    `amount` varchar(255) NOT NULL,
    `created_at` datetime NULL DEFAULT NULL,
    `updated_at` datetime NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `withdrawals` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `slug` varchar(255) NOT NULL,
    `user_id` INT(11) NULL DEFAULT NULL,
    `amount` varchar(255) NOT NULL,
    `is_approved` tinyint(1) NULL DEFAULT 0,
    `created_at` datetime NULL DEFAULT NULL,
    `updated_at` datetime NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tasks` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `created_by` INT(11) NULL DEFAULT NULL,
    `slug` varchar(255) NOT NULL,
    `title` varchar(255) NULL DEFAULT NULL,
    `body` text NULL DEFAULT NULL,
    `image` varchar(255) NULL DEFAULT NULL,
    `created_at` datetime NULL DEFAULT NULL,
    `updated_at` datetime NULL DEFAULT NULL,
    PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

