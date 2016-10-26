CREATE DATABASE `academia_s2it_phalcon`;

USE `academia_s2it_phalcon`;

CREATE TABLE `products`
(
    `id` int(11) auto_increment, 
    `name` varchar(50),
    `price` double,
    `quantity` int,
    `description` longtext,
    `created_at` datetime,
    `updated_at` datetime,
    PRIMARY KEY(`id`)
);
