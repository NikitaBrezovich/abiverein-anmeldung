-- 01_database_and_applications.sql
-- Create DB + table for applications (MySQL/MariaDB)

CREATE DATABASE IF NOT EXISTS `abiverein`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `abiverein`;

CREATE TABLE IF NOT EXISTS `applications` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

  `child_name`   VARCHAR(120) NOT NULL,

  `parent1_name` VARCHAR(120) NOT NULL,
  `parent1_age`  TINYINT UNSIGNED NOT NULL,

  `parent2_name` VARCHAR(120) NULL,
  `parent2_age`  TINYINT UNSIGNED NULL,

  `email` VARCHAR(254) NOT NULL,
  `phone` VARCHAR(32)  NOT NULL,

  `privacy_accepted`     TINYINT(1) NOT NULL DEFAULT 0,
  `initial_payment_ack`  TINYINT(1) NOT NULL DEFAULT 0,

  `source_ip` VARBINARY(16) NULL,
  `user_agent` VARCHAR(255) NULL,

  PRIMARY KEY (`id`),

  KEY `idx_created_at` (`created_at`),
  KEY `idx_email` (`email`),

  CONSTRAINT `chk_parent1_age` CHECK (`parent1_age` BETWEEN 10 AND 120),
  CONSTRAINT `chk_parent2_age` CHECK (`parent2_age` IS NULL OR `parent2_age` BETWEEN 10 AND 120),
  CONSTRAINT `chk_privacy` CHECK (`privacy_accepted` IN (0,1)),
  CONSTRAINT `chk_payment` CHECK (`initial_payment_ack` IN (0,1))
) ENGINE=InnoDB;
