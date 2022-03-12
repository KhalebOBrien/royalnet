USE `royalnet`;

ALTER TABLE `users` 
    ADD `package` VARCHAR(255) NULL DEFAULT NULL AFTER `phone`;