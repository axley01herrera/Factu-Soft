--
-- Database: `factu_soft`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lang` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'es',
  `timezone` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'Atlantic/Canary',
  `currency` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '€',
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_spanish_ci NOT NULL,
  `last_name` varchar(250) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `type` int NOT NULL COMMENT '0 = particular\r\n1 = empresa',
  `email` varchar(250) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `address_a` varchar(250) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `address_b` varchar(250) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `address_city` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `address_state` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `address_zip` int DEFAULT NULL,
  `address_country` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nif` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `deleted` int NOT NULL DEFAULT '0',
  `added` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `serial`
--

DROP TABLE IF EXISTS `serial`;
CREATE TABLE IF NOT EXISTS `serial` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL,
  `count` int NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `price` float NOT NULL,
  `description` varchar(999) COLLATE utf8mb4_spanish_ci NOT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  `deleted` int NOT NULL DEFAULT '0' COMMENT '1 = deleted',
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

DROP TABLE IF EXISTS `basket`;
CREATE TABLE IF NOT EXISTS `basket` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL,
  `dateTime` datetime NOT NULL,
  `date` date NOT NULL,
  `payType` int NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `basket_service`
--

DROP TABLE IF EXISTS `basket_service`;
CREATE TABLE IF NOT EXISTS `basket_service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `basketID` int DEFAULT NULL,
  `serviceID` varchar(999) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

/* Not Remove */
INSERT INTO `profile` (`id`, `logo`, `access_key`, `name`, `company_id`, `email`, `phone`, `address_a`, `address_b`, `city`, `state`, `zip`, `country`, `description`) VALUES
(1, NULL, '$2y$10$nSh5/VR7O3a0IkaZD8MVwO0o8xoia0JS9FVTfH.RVj8TZrLWBR0uC', 'Grupo AHV', '45368548-X', 'grupoahv@gmail.com', '(+34) 658-789-789', 'Calle Rosa #2', '', '', 'Las Palmas', 35570, 'España', 'Empresa dedicada al desarrollo de soluciones informáticas.');

INSERT INTO `config` (`id`, `lang`, `timezone`, `currency`) VALUES (NULL, 'es', 'Atlantic/Canary', '€');