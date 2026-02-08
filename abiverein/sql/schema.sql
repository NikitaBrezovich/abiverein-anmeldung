USE `abiverein`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password_hash` CHAR(64) NOT NULL,  -- SHA-256 hex
  `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_username` (`username`)
) ENGINE=InnoDB;

-- Seed default admin: admin / Start123
-- If user exists, update password + admin flag
INSERT INTO `users` (`username`, `password_hash`, `is_admin`)
VALUES ('admin', SHA2('Start123', 256), 1)
ON DUPLICATE KEY UPDATE
  `password_hash` = VALUES(`password_hash`),
  `is_admin` = 1;
