DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lang` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'es',
  `timezone` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'Atlantic/Canary',
  `currency` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '€',
  PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `logo` longblob,
  `access_key` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '$2y$10$k/0mttt2zPfZ3P2SCfTRZeQQmQkX3ySC3fN4xfydKQl...',
  `name` varchar(250) COLLATE utf8mb4_spanish_ci NOT NULL,
  `company_id` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_spanish_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `address_a` varchar(250) COLLATE utf8mb4_spanish_ci NOT NULL,
  `address_b` varchar(250) COLLATE utf8mb4_spanish_ci NOT NULL,
  `city` varchar(150) COLLATE utf8mb4_spanish_ci NOT NULL,
  `state` varchar(150) COLLATE utf8mb4_spanish_ci NOT NULL,
  `zip` int NOT NULL,
  `country` varchar(150) COLLATE utf8mb4_spanish_ci NOT NULL,
  `description` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `profile` (`id`, `logo`, `access_key`, `name`, `company_id`, `email`, `phone`, `address_a`, `address_b`, `city`, `state`, `zip`, `country`, `description`) VALUES
(1, NULL, '$2y$10$nSh5/VR7O3a0IkaZD8MVwO0o8xoia0JS9FVTfH.RVj8TZrLWBR0uC', 'Grupo AHV', '45368548-X', 'grupoahv@gmail.com', '(+34) 658-789-789', 'Calle Rosa #2', '', '', 'Las Palmas', 35570, 'España', 'Empresa dedicada al desarrollo de soluciones informáticas.');