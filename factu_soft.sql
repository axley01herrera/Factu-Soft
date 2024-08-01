DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lang` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'es',
  `timezone` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'Atlantic/Canary',
  PRIMARY KEY (`id`)
);

INSERT INTO `config` (`id`, `lang`, `timezone`) VALUES
(1, 'es', 'Atlantic/Canary');

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_spanish_ci NOT NULL,
  `last_name` int DEFAULT NULL,
  `type` int NOT NULL COMMENT '0 = particular\r\n1 = empresa',
  `email` varchar(250) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `address_a` varchar(250) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `address_b` varchar(250) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `address_city` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `address_state` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `address_zip` int DEFAULT NULL,
  `address_country` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `access_key` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '$2y$10$k/0mttt2zPfZ3P2SCfTRZeQQmQkX3ySC3fN4xfydKQl...',
  PRIMARY KEY (`id`)
);

INSERT INTO `profile` (`id`, `access_key`) VALUES
(1, '$2y$10$nSh5/VR7O3a0IkaZD8MVwO0o8xoia0JS9FVTfH.RVj8TZrLWBR0uC');