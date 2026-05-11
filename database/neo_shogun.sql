-- NEO-SHOGUN DATABASE SCHEMA
-- Version 1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS = 0;

-- Drop existing tables in reverse order of dependency
DROP TABLE IF EXISTS `order_items`;
DROP TABLE IF EXISTS `notifications`;
DROP TABLE IF EXISTS `coupons`;
DROP TABLE IF EXISTS `reviews`;
DROP TABLE IF EXISTS `wishlist`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `users`;

-- --------------------------------------------------------

-- Table structure for table `users`
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT 'default_avatar.jpg',
  `rank` varchar(50) DEFAULT 'Novice Warrior',
  `credits` decimal(15,2) DEFAULT 0.00,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `pin_code` varchar(10) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `reward_points` int(11) DEFAULT 0,
  `is_admin` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `users`
-- Default Admin: admin@shogun.in / Admin@123
INSERT INTO `users` (`username`, `email`, `password`, `rank`, `is_admin`) VALUES
('shogun_admin', 'admin@shogun.in', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'High Shogun', 1);

-- --------------------------------------------------------

-- Table structure for table `categories`
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for categories
INSERT INTO `categories` (`name`, `slug`, `description`) VALUES
('Apparel', 'apparel', 'High-tech shogunate clothing'),
('Figures', 'figures', 'Limited edition collectible figures'),
('Accessories', 'accessories', 'Cybernetic augments and accessories');

-- --------------------------------------------------------

-- Table structure for table `products`
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `rarity` enum('Common', 'Rare', 'Epic', 'Legendary') DEFAULT 'Common',
  `stock` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for products
INSERT INTO `products` (`category_id`, `name`, `price`, `description`, `image_url`, `rarity`, `stock`) VALUES
(2, 'ONI-LINK MK.IV', 1240.00, 'Direct neural interface for advanced shogunate combat protocols.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuC-PKRVdeHJY5MNyJ4IPZ32bgzGzwM4tKGlkrfQQc7Q52hkQpfCCZYvs5gDuXzGriNIoTVdy6Gw-8oTjUFG-5jkGUqapPQZAEQUmzyCk6o9mrJjiuIxSAKUrCAPusrIlnyjGo8PtHORqwQ8yYH5SyWkAaLBaopr4nusNaWNJWaE6M8EPg2VeDh7vUU9e69OArBiO7G8vr_VYw-d2zo-l0YAfvRCy9XhUdt1gH3owxlxvuGjDd8_Tv-Zy4PeTmKDSC37AV08aO3TWJQx', 'Legendary', 5),
(1, 'CYBER-STRIDE V2', 24500.00, 'All-terrain cybernetic boots.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAJyf3VUZuth49XJewDBrd5z1Sgf14porlaemV4oqYi0PbFmaXfKJ7n67H09kMvIIg4jjSl53I5YMsnXOObqcqg0LqIKVvilb3uo7N7nUmfNqqBc7bVsJLQGNyjs_wvvBWt7woavs3T3lD0mJmuf8ISJ4o3pS-eBKcebBcUBDrnzHvv5QU8vPXnH3PW6S8q79NBne8Sk6bqSqO37F2Kb3hvfrpgQyS-Bl-ZuBoPn3NcvkvMSfdYqNYeWQk7_4qo-DtySt2FQZoGxuXZ', 'Legendary', 10);

-- --------------------------------------------------------

-- Table structure for table `orders`
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` enum('Pending', 'Processing', 'Dispatched', 'Delivered', 'Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Table structure for table `order_items`
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_at_purchase` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Table structure for table `wishlist`
DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Table structure for table `reviews`
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL CHECK (`rating` >= 1 AND `rating` <= 5),
  `comment` text DEFAULT NULL,
  `status` enum('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Table structure for table `coupons`
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `discount_type` enum('Fixed', 'Percentage') NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Table structure for table `notifications`
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;
