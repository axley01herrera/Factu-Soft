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
  `serial_id` int DEFAULT NULL,
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
  `access_key` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '$2y$10$k/0mttt2zPfZ3P2SCfTRZeQQmQkX3ySC3fN4xfydKQluIDkBQoPNS',
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
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `serie` int NOT NULL,
  `number` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `customer` int DEFAULT NULL,
  `created_date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0 = OPEN\r\n1 = PAID\r\n2 = DRAFT\r\n3 = SEND\r\n4 = RECTIFIED\r\n5 = SEND / RECTIFIED',
  `pay_type` int DEFAULT NULL COMMENT '1 = Card\r\n2 = Cash\r\n3 = Transferencia',
  `type` int NOT NULL DEFAULT '1' COMMENT '1 = Ticket\r\n2 = Invoice',
  `r_desc` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `r_id` int DEFAULT NULL,
  `tax_base` float NOT NULL DEFAULT '0',
  `total_amount` float NOT NULL DEFAULT '0',
  `added` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

DROP TABLE IF EXISTS `invoice_items`;
CREATE TABLE IF NOT EXISTS `invoice_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `invoice_id` int NOT NULL,
  `service_id` varchar(999) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `description` varchar(999) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `amount` float NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--
DROP TABLE IF EXISTS `tax`;
CREATE TABLE IF NOT EXISTS `tax` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL,
  `description` varchar(999) COLLATE utf8mb4_spanish_ci NOT NULL,
  `percent` float DEFAULT '0',
  `operator` varchar(1) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tpv` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_tax`
--
DROP TABLE IF EXISTS `invoice_tax`;
CREATE TABLE IF NOT EXISTS `invoice_tax` (
  `id` int NOT NULL AUTO_INCREMENT,
  `invoice_id` int NOT NULL,
  `tax_id` int NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- View structure for view `dt_tickets`
--

DROP VIEW IF EXISTS dt_tickets;

CREATE VIEW dt_tickets AS
SELECT
  invoice.id AS invoiceID,
  invoice.serie AS serieID,
  invoice.number AS invoiceNumber,
  invoice.status AS invoiceStatus,
  invoice.pay_type AS pay_type,
  invoice.type AS type,
  invoice.total_amount AS totalAmount,
  invoice.added AS added,
  invoice.updated AS updated,
  serial.name,
  SUM(invoice_items.amount) AS amount
FROM
    invoice
INNER JOIN serial ON invoice.serie = serial.id
INNER JOIN invoice_items ON invoice.id = invoice_items.invoice_id
WHERE
    invoice.status = 1
    AND invoice.type = 1
GROUP BY
    invoice.id

-- --------------------------------------------------------

--
-- View structure for view `dt_invoices`
--

DROP VIEW IF EXISTS
    dt_invoices;
CREATE VIEW dt_invoices AS SELECT
    invoice.id AS invoiceID,
    invoice.serie AS serieID,
    invoice.number AS invoiceNumber,
    invoice.status AS invoiceStatus,
    invoice.pay_type AS pay_type,
    invoice.type AS TYPE,
    invoice.total_amount AS totalAmount,
    invoice.added AS added,
    invoice.updated AS updated,
    SERIAL.name,
    COALESCE(SUM(invoice_items.amount),0) AS amount,
    customer.id as customerID,
    customer.name as customerName,
    customer.nif
FROM
    invoice
LEFT JOIN SERIAL ON invoice.serie = SERIAL.id
LEFT JOIN invoice_items ON invoice.id = invoice_items.invoice_id
LEFT JOIN customer ON customer.id = invoice.customer
WHERE
    invoice.type = 2
GROUP BY
    invoice.id;
