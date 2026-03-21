-- CorpEasy Database Setup
-- Run this SQL in phpMyAdmin to create the leads table

-- Create leads table
CREATE TABLE IF NOT EXISTS `leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_type` varchar(100) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `requirement` text,
  `property_location` varchar(255) DEFAULT NULL,
  `property_area` varchar(100) DEFAULT NULL,
  `message` text,
  `source_page` varchar(100) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `user_agent` varchar(500) DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `created_at` (`created_at`),
  KEY `form_type` (`form_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create admin users table
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
