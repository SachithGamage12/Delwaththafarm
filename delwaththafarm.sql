-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.38 - MySQL Community Server - GPL
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


-- Dumping database structure for farm
CREATE DATABASE IF NOT EXISTS `farm` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `farm`;

-- Dumping structure for table farm.admin_users
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table farm.admin_users: ~2 rows (approximately)
INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
	(1, 'Delwaththafarm', '$2y$10$J8JjDZuZjJ9IQ3VRuTXAYo6YoHRlE9D8Q0nBoOBF7F5HUMx46wA/e'),
	(2, 'User', 'Sun'),
	(3, 'Df', '$2y$10$dLJFFiwHVoYKYyTPQl/kf.Ioz.WdPZnO8KFHrrQgbF8Dk99fAZaVK');

-- Dumping structure for table farm.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('in-stock','out-of-stock') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table farm.products: ~8 rows (approximately)
INSERT INTO `products` (`id`, `name`, `category`, `image`, `status`, `created_at`) VALUES
	(1, 'Pinapple', 'Fruit', 'pinapple 1.png', 'in-stock', '2025-02-27 19:33:59'),
	(2, 'Fresh  Turmeric', 'Spices', 'Turmeric 1.png', 'in-stock', '2025-02-27 19:36:11'),
	(3, 'Dry Turmeric', 'Spices', 'pngwing.com.png', 'in-stock', '2025-02-27 19:44:19'),
	(4, 'Turmeric Powder', 'Spices', 'pngwing.com (1).png', 'in-stock', '2025-02-27 19:50:30'),
	(5, 'Fresh Ginger ', 'Spices', 'ginger 1.png', 'in-stock', '2025-02-27 19:56:18'),
	(6, 'Dry Ginger', 'Spices', 'pngegg.png', 'in-stock', '2025-02-27 19:58:24'),
	(7, 'Ginger Powder', 'Spices', 'ginger-root-ginger-powder-table.jpg', 'in-stock', '2025-02-27 20:01:30');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
