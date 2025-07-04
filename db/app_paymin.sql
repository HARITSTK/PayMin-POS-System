-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for app_paymin
DROP DATABASE IF EXISTS `app_paymin`;
CREATE DATABASE IF NOT EXISTS `app_paymin` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `app_paymin`;

-- Dumping structure for table app_paymin.balances
DROP TABLE IF EXISTS `balances`;
CREATE TABLE IF NOT EXISTS `balances` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `beginning_balance` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table app_paymin.balances: ~0 rows (approximately)
REPLACE INTO `balances` (`id`, `date`, `beginning_balance`, `created_at`) VALUES
	(1, '2025-06-13', 1000000.00, '2025-06-13 03:55:44');

-- Dumping structure for table app_paymin.cache
DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app_paymin.cache: ~0 rows (approximately)

-- Dumping structure for table app_paymin.cache_locks
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app_paymin.cache_locks: ~0 rows (approximately)

-- Dumping structure for table app_paymin.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `unique_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table app_paymin.categories: ~5 rows (approximately)
REPLACE INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Drink', '2025-06-22 03:06:45', '2025-06-22 03:06:45'),
	(2, 'Food', '2025-06-22 03:06:45', '2025-06-22 03:06:45'),
	(3, 'Snack', '2025-06-22 03:06:45', '2025-06-22 03:06:45'),
	(4, 'Dessert', '2025-06-22 03:06:45', '2025-06-22 03:06:45'),
	(5, 'Signature', '2025-06-22 03:06:45', '2025-06-22 03:06:45');

-- Dumping structure for table app_paymin.customers
DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table app_paymin.customers: ~0 rows (approximately)
REPLACE INTO `customers` (`id`, `name`, `phone`, `address`, `created_at`) VALUES
	(1, 'test', '123232', 'asdasdasd', '2025-06-13 02:35:30');

-- Dumping structure for table app_paymin.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app_paymin.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table app_paymin.jobs
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app_paymin.jobs: ~0 rows (approximately)

-- Dumping structure for table app_paymin.job_batches
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app_paymin.job_batches: ~0 rows (approximately)

-- Dumping structure for table app_paymin.members
DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int DEFAULT NULL,
  `type` enum('Silver','Gold','Platinum','Expired') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_type` enum('Silver','Gold','Platinum','Expired') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT '0.00',
  `points` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `members_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table app_paymin.members: ~1 rows (approximately)

-- Dumping structure for table app_paymin.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app_paymin.migrations: ~9 rows (approximately)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_05_17_054232_create_user_table', 0),
	(5, '2025_05_17_054235_add_foreign_keys_to_user_table', 0),
	(6, '2025_05_17_054308_create_role_table', 0),
	(7, '2025_05_17_054334_create_customer_table', 0),
	(8, '2025_05_17_054337_add_foreign_keys_to_customer_table', 0),
	(9, '2025_05_28_140322_create_users_table', 2);

-- Dumping structure for table app_paymin.password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app_paymin.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table app_paymin.payments
DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sale_id` int DEFAULT NULL,
  `payment_method` enum('cash','card','ewallet') DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `payments_sale_fk` (`sale_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_sale_fk` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table app_paymin.payments: ~0 rows (approximately)

-- Dumping structure for table app_paymin.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `subcategory_id` int DEFAULT NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `idx_category_id` (`category_id`),
  KEY `idx_subcategory_id` (`subcategory_id`),
  CONSTRAINT `fk_products_subcategory` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table app_paymin.products: ~0 rows (approximately)
REPLACE INTO `products` (`id`, `name`, `category_id`, `subcategory_id`, `desc`, `price`, `stock`, `image`, `created_at`, `updated_at`) VALUES
	(4, 'asd', 1, 1, 'asd', 123.00, 12, NULL, '2025-06-30 04:04:16', '2025-06-30 04:04:16');

-- Dumping structure for table app_paymin.sales
DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `change_amount` decimal(10,2) DEFAULT NULL,
  `sale_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `type` enum('dine_in','take_away') DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `status` enum('procced','ready','served') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `table` int DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table app_paymin.sales: ~0 rows (approximately)

-- Dumping structure for table app_paymin.sale_items
DROP TABLE IF EXISTS `sale_items`;
CREATE TABLE IF NOT EXISTS `sale_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sale_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sale_id` (`sale_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `sale_items_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sale_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table app_paymin.sale_items: ~0 rows (approximately)

-- Dumping structure for table app_paymin.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app_paymin.sessions: ~2 rows (approximately)
REPLACE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('2EMjJXTDbMZCZKZawE1bPMtr68arBM1KMHqkvlaH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6ImFJMXBYamdxd2trTFFLeU55NzhvcFZ3MXJQQ29Zejk4WTFHRVdFekMiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvT3JkZXJDYXNzaWVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjIzNDA4MztzOjE2OiJ1c2VybmFtZV9jYXNzaWVyIjtzOjU6Imthc2lyIjtzOjEyOiJuYW1lX2Nhc3NpZXIiO3M6OToia2FzaXJycnJyIjtzOjEzOiJlbWFpbF9jYXNzaWVyIjtOO3M6MTM6InBob3RvX2Nhc3NpZXIiO047czoxMjoicm9sZV9jYXNzaWVyIjtzOjc6ImNhc3NpZXIiO3M6MTE6ImJpb19jYXNzaWVyIjtOO30=', 1751536704),
	('agAb7YACDtKTNuGgJMiSJ6JsvwdvNhrYVTi9HDL6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6IlhJNzFxdVlSUEt2ZnNYelZZSFRZQWFLWUhxZGdJSTBQbE1MWlppZG4iO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvT3JkZXJDYXNzaWVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjIzNDA4MztzOjE2OiJ1c2VybmFtZV9jYXNzaWVyIjtzOjU6Imthc2lyIjtzOjEyOiJuYW1lX2Nhc3NpZXIiO3M6OToia2FzaXJycnJyIjtzOjEzOiJlbWFpbF9jYXNzaWVyIjtOO3M6MTM6InBob3RvX2Nhc3NpZXIiO047czoxMjoicm9sZV9jYXNzaWVyIjtzOjc6ImNhc3NpZXIiO3M6MTE6ImJpb19jYXNzaWVyIjtOO30=', 1751559496);

-- Dumping structure for table app_paymin.subcategories
DROP TABLE IF EXISTS `subcategories`;
CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_subcategories_category` (`category_id`),
  CONSTRAINT `fk_subcategories_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table app_paymin.subcategories: ~14 rows (approximately)
REPLACE INTO `subcategories` (`id`, `category_id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Coffee', '2025-06-22 03:06:54', '2025-06-22 03:06:54'),
	(2, 1, 'Non-Coffee', '2025-06-22 03:06:54', '2025-06-22 03:06:54'),
	(3, 1, 'Tea', '2025-06-22 03:06:54', '2025-06-22 03:06:54'),
	(4, 1, 'Manual Brew', '2025-06-22 03:06:54', '2025-06-22 03:06:54'),
	(5, 1, 'Juice', '2025-06-22 03:06:54', '2025-06-22 03:06:54'),
	(6, 1, 'Smoothie', '2025-06-22 03:06:54', '2025-06-22 03:06:54'),
	(7, 1, 'Milkshake', '2025-06-22 03:06:54', '2025-06-22 03:06:54'),
	(8, 1, 'Soda', '2025-06-22 03:06:54', '2025-06-22 03:06:54'),
	(9, 3, 'Croissant', '2025-06-22 03:06:54', '2025-06-22 03:06:54'),
	(10, 3, 'Sandwich', '2025-06-22 03:06:54', '2025-06-22 03:06:54'),
	(11, 3, 'Toast', '2025-06-22 03:06:54', '2025-06-22 03:06:54'),
	(12, 5, 'Mocktail', '2025-06-22 03:06:54', '2025-06-22 03:06:54'),
	(13, 5, 'Seasonal', '2025-06-22 03:06:54', '2025-06-22 03:06:54'),
	(14, 5, 'Special Blend', '2025-06-22 03:06:54', '2025-06-22 03:06:54');

-- Dumping structure for table app_paymin.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shift` enum('pagi','sore') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','cassier','kitchen','storage','waiters') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` enum('Y','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1253411 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app_paymin.users: ~5 rows (approximately)
REPLACE INTO `users` (`id`, `username`, `name`, `password`, `email`, `photo`, `bio`, `shift`, `role`, `is_active`, `created_at`, `updated_at`) VALUES
	(234083, 'kasir', 'kasirrrrr', '$2y$12$h9BMNFIsM9KYeF4t/aMONupyjSE7IN/kvzWxzezXJBYkzgryx4hH6', NULL, NULL, NULL, 'pagi', 'cassier', 'Y', '2025-06-24 16:30:26', '2025-06-27 01:40:11'),
	(519841, 'admin', 'admin', '$2y$12$HbZeTeT5VlEo35/hCRCN/eN3zz5.F/Be8CL08dx4Ey.FL020CdBU2', NULL, NULL, 'test', NULL, 'admin', 'Y', '2025-06-17 23:40:28', '2025-06-27 02:33:51'),
	(659313, 'gudang', 'gudang1', '$2y$12$WbpNF7AQBZLFh12bMr9ht.TOOqul0uElZN044979MkawwyBNJFWGG', NULL, NULL, 'gudang 1 test 123', NULL, 'storage', 'Y', '2025-06-28 21:17:52', '2025-06-29 10:45:45'),
	(899054, 'kitchen', 'kitchen', '$2y$12$.hAO0DWP5Z1b6nIeLyxMjeeORrMxH42U2Ob00iEsWD8UV/44QPkYG', NULL, NULL, NULL, NULL, 'kitchen', 'Y', '2025-06-28 22:06:37', '2025-06-28 22:06:37'),
	(991475, 'waiters', 'waiters', '$2y$12$oEr7BFUjFVvVIeIbyKLvlO45dDEYPFkkdeZb5mks39DAfz7seQonS', NULL, NULL, NULL, NULL, 'waiters', 'Y', '2025-06-28 23:07:31', '2025-06-28 23:07:31');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
