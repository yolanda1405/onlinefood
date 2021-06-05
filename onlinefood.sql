/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.11-MariaDB : Database - onlinefood
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`onlinefood` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `onlinefood`;

/*Table structure for table `barangs` */

DROP TABLE IF EXISTS `barangs`;

CREATE TABLE `barangs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `terjual` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `barangs` */

insert  into `barangs`(`id`,`nama_barang`,`gambar`,`harga`,`stok`,`terjual`,`ket`,`created_at`,`updated_at`) values 
(2,'nasi padang','1619882365.jpg',10000,3,'1','Tidak Ada.','2021-05-01 15:19:25','2021-05-25 04:07:01');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2021_04_27_233019_create_barangs_table',1),
(5,'2021_04_27_233222_create_pesanans_table',1),
(6,'2021_04_27_233401_create_pesanan_details_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `pesanan_details` */

DROP TABLE IF EXISTS `pesanan_details`;

CREATE TABLE `pesanan_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `barang_id` int(11) NOT NULL,
  `pesanan_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jumlah_harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pesanan_details` */

insert  into `pesanan_details`(`id`,`barang_id`,`pesanan_id`,`jumlah`,`jumlah_harga`,`created_at`,`updated_at`) values 
(1,2,1,1,10000,'2021-05-01 15:19:42','2021-05-01 15:19:42'),
(2,1,1,2,20000,'2021-05-01 15:20:11','2021-05-01 15:20:11'),
(3,2,2,5,50000,'2021-05-01 15:22:26','2021-05-01 15:22:26'),
(4,2,3,1,10000,'2021-05-25 03:00:01','2021-05-25 03:00:01'),
(6,1,4,2,20000,'2021-05-25 04:07:27','2021-05-25 04:11:18'),
(7,1,5,1,10000,'2021-05-25 04:12:53','2021-05-25 04:12:53');

/*Table structure for table `pesanans` */

DROP TABLE IF EXISTS `pesanans`;

CREATE TABLE `pesanans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pesanans` */

insert  into `pesanans`(`id`,`user_id`,`tanggal`,`status`,`jumlah_harga`,`created_at`,`updated_at`) values 
(1,1,'2021-05-01','3',30007,'2021-05-01 15:19:42','2021-05-01 15:21:56'),
(2,1,'2021-05-01','1',50076,'2021-05-01 15:22:26','2021-05-01 15:22:32'),
(3,4,'2021-05-25','1',10119,'2021-05-25 03:00:01','2021-05-25 04:07:01'),
(4,4,'2021-05-25','1',20108,'2021-05-25 04:07:27','2021-05-25 04:11:56'),
(5,4,'2021-05-25','0',10005,'2021-05-25 04:12:53','2021-05-25 04:12:53');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notelpon` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL,
  `saldo` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`alamat`,`notelpon`,`level`,`saldo`,`remember_token`,`created_at`,`updated_at`) values 
(2,'user','user1@gmail.com',NULL,'$2y$10$YwZ/LZqYWDts2WnXTIY/AO7IRddTh30jZdzXGEnWkNn7Zitv907a6',NULL,NULL,2,NULL,NULL,'2021-05-01 15:24:54','2021-05-01 15:24:54'),
(4,'yolanda','useryo@gmail.com',NULL,'$2y$10$b5netsXhQyZr8DVdTWr2puyrjVVTVr.K3/w56CWX23kZQ5c/xsPuO','kediri','12345',2,NULL,NULL,'2021-05-25 01:43:01','2021-05-25 04:11:39'),
(6,'admin','admin@gmail.com',NULL,'$2y$10$IafnrZRHaZ80.gECbsVCgu.A7.ba8mMeW.4fzGIF2GQCTAmGyJZdK',NULL,NULL,1,NULL,NULL,'2021-06-05 09:55:17','2021-06-05 09:55:17');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
