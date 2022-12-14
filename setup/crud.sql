/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.24-MariaDB : Database - crud
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`crud` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `crud`;

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `surname` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `address_1` text DEFAULT NULL,
  `address_2` text DEFAULT NULL,
  `city` text DEFAULT NULL,
  `province` text DEFAULT NULL,
  `zip` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `customers` */

/*Table structure for table `provinces` */

DROP TABLE IF EXISTS `provinces`;

CREATE TABLE `provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `provinces` */

insert  into `provinces`(`id`,`title`) values 
(1,'Eastern Cape'),
(2,'Free State'),
(3,'Gauteng'),
(4,'KwaZulu-Natal'),
(5,'Limpopo'),
(6,'Mpumalanga'),
(7,'Northern Cape'),
(8,'North West');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` text DEFAULT NULL,
  `surname` text DEFAULT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `access_level` int(11) NOT NULL DEFAULT 2,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`first_name`,`surname`,`email`,`password`,`access_level`,`status`) values 
(1,'Super','Admin','superadmin@example.com','amdSU3M4TXRkbHNuVmxsdExsOHFNcE5mT3BPMmRFZU93MTRNbjRSUHBGSWRsREludmk2MHF0R2R3S01hSk9GVzRBakJ6clZINHB6dHp2ajZvRGJSQVBrTWtpZXRQV0pzdGM2WW5HZi9xMTNrM09GWG9vRXFxT1pNWmgvSTNSalI0bnErWnRLdG5lQm0wUmF5OUhQRGxibXRuSGkxZ0w5UmIyTTNudz09LmFmZmI2MTE5OTIwMzUyMThhNTBkMTRlYTNiMTQ4ZjkwYjViZGQxODY4NzFmN2Q2ZTBiNDkzZjkzNzc4Y2ZkODU',1,1),
(2,'Basic','User','admin@example.com','dnVCZEd5bkdVNkQxNVdCVnF5QkZnWmVuNHB5VUZIZnl6RzJGWnJnSktDcCs2QnhscjlVQ0lNajE2bG9pdkd3ZDlmVlJ5UW54Y1k1NmJydTFwcEFmSVBSaTNISGc4T24yWk1xOVFlZld1RzArZ0ZMZDFkUElFNTJHN1FENU1jSnRlL2Q5M09nQnYzMU5KY051L2tKSVllUVBtOWM4R3hSQ3B2eUo2Zz09LjE2MmQ0MTZlMzY5ZWZmYmFiMmE5YWI2YWYyMzYxZTMyMGY5NWUxNDllYjhlMjg0MTI4MDM0ZDc5NmEyZTI5MzY=',2,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
