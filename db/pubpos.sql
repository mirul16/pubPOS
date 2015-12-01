-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2015 at 11:19 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pubpos`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_account`
--

CREATE TABLE IF NOT EXISTS `master_account` (
  `account_id` varchar(7) NOT NULL,
  `account_name` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city_id` varchar(4) DEFAULT NULL,
  `pic` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `type` varchar(1) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_account`
--

INSERT INTO `master_account` (`account_id`, `account_name`, `address`, `city_id`, `pic`, `email`, `phone`, `fax`, `type`, `notes`) VALUES
('CUS0001', 'TOKO SEJAHTERA', 'JL VANDA', 'A001', 'ADI', '', '085782275791', '', 'C', ''),
('VEN0001', 'PT SUBUR JAYA', 'JL. MERBABU', 'A001', 'NUR', '', '085782275791', '', 'V', '');

-- --------------------------------------------------------

--
-- Table structure for table `master_category`
--

CREATE TABLE IF NOT EXISTS `master_category` (
  `category_id` varchar(4) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_category`
--

INSERT INTO `master_category` (`category_id`, `category_name`) VALUES
('D001', 'BISCUIT'),
('D002', 'COFFEE');

-- --------------------------------------------------------

--
-- Table structure for table `master_city`
--

CREATE TABLE IF NOT EXISTS `master_city` (
  `city_id` varchar(4) NOT NULL,
  `city_name` varchar(50) DEFAULT NULL,
  `city_code` varchar(3) DEFAULT NULL,
  `country_id` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`city_id`),
  KEY `country_id` (`country_id`),
  KEY `country_id_2` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_city`
--

INSERT INTO `master_city` (`city_id`, `city_name`, `city_code`, `country_id`) VALUES
('A001', 'JAKARTA', 'JKT', 'C001'),
('A002', 'BOGOR', 'BGR', 'C001'),
('A003', 'BANDUNG', 'BDG', 'C001'),
('A004', 'TANGERANG', 'TGR', 'C001'),
('A005', 'BEKASI', 'BKS', 'C001');

-- --------------------------------------------------------

--
-- Table structure for table `master_country`
--

CREATE TABLE IF NOT EXISTS `master_country` (
  `country_id` varchar(4) NOT NULL,
  `country_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_country`
--

INSERT INTO `master_country` (`country_id`, `country_name`) VALUES
('C001', 'INDONESIA'),
('C002', 'SINGAPORE');

-- --------------------------------------------------------

--
-- Table structure for table `master_currency`
--

CREATE TABLE IF NOT EXISTS `master_currency` (
  `currency_id` varchar(3) NOT NULL,
  `currency_code` varchar(10) DEFAULT NULL,
  `country_id` varchar(4) DEFAULT NULL,
  `rate` decimal(9,2) NOT NULL DEFAULT '0.00',
  `symbol` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`currency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_currency`
--

INSERT INTO `master_currency` (`currency_id`, `currency_code`, `country_id`, `rate`, `symbol`) VALUES
('B01', 'IDR', 'C001', '1.00', 'Rp');

-- --------------------------------------------------------

--
-- Table structure for table `master_product`
--

CREATE TABLE IF NOT EXISTS `master_product` (
  `product_id` varchar(6) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `category_id` varchar(4) DEFAULT NULL,
  `product_brand` varchar(50) DEFAULT NULL,
  `product_status` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_product`
--

INSERT INTO `master_product` (`product_id`, `product_name`, `category_id`, `product_brand`, `product_status`) VALUES
('P00001', 'OREO', 'D001', 'OREO', '1');

-- --------------------------------------------------------

--
-- Table structure for table `master_product_detail`
--

CREATE TABLE IF NOT EXISTS `master_product_detail` (
  `sku` varchar(64) NOT NULL,
  `product_id` varchar(6) NOT NULL,
  `barcode` varchar(64) NOT NULL,
  `product_detail_name` varchar(100) DEFAULT NULL,
  `typep` varchar(50) DEFAULT NULL,
  `unit_stock` int(6) DEFAULT NULL,
  `unit_id` varchar(3) DEFAULT NULL,
  `unit_qty` varchar(50) DEFAULT NULL,
  `currency_id` varchar(3) DEFAULT NULL,
  `price_buy` decimal(20,2) DEFAULT '0.00',
  `price_wholesale` decimal(20,2) DEFAULT '0.00',
  `price_retail` decimal(20,2) DEFAULT '0.00',
  `unit_order` int(6) DEFAULT NULL,
  `unit_reorder` int(6) DEFAULT NULL,
  `vendor_id` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`sku`),
  KEY `vendor_id` (`vendor_id`),
  KEY `unit_id` (`unit_id`),
  KEY `currency_id` (`currency_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_product_detail`
--

INSERT INTO `master_product_detail` (`sku`, `product_id`, `barcode`, `product_detail_name`, `typep`, `unit_stock`, `unit_id`, `unit_qty`, `currency_id`, `price_buy`, `price_wholesale`, `price_retail`, `unit_order`, `unit_reorder`, `vendor_id`) VALUES
('44000032142', 'P00001', '44000032142', 'OREO COOKIES LUNCHBOX GO-PAKS', 'VANILA', 10, 'U01', '20 BAGS', 'B01', '10000.00', '15000.00', '17000.00', 0, 5, 'VEN0001');

-- --------------------------------------------------------

--
-- Table structure for table `master_unit`
--

CREATE TABLE IF NOT EXISTS `master_unit` (
  `unit_id` varchar(3) NOT NULL,
  `unit_name` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_unit`
--

INSERT INTO `master_unit` (`unit_id`, `unit_name`) VALUES
('U01', 'BOX');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` varchar(6) COLLATE utf8_bin NOT NULL,
  `name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `username` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `activated` int(1) NOT NULL DEFAULT '0',
  `level` int(1) NOT NULL DEFAULT '0',
  `banned` int(1) NOT NULL DEFAULT '0',
  `region` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `div_id` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`, `username`, `password`, `email`, `activated`, `level`, `banned`, `region`, `div_id`) VALUES
('USR001', 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, 0, 0, 0, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `master_city`
--
ALTER TABLE `master_city`
  ADD CONSTRAINT `master_city_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `master_country` (`country_id`);

--
-- Constraints for table `master_product`
--
ALTER TABLE `master_product`
  ADD CONSTRAINT `master_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `master_category` (`category_id`);

--
-- Constraints for table `master_product_detail`
--
ALTER TABLE `master_product_detail`
  ADD CONSTRAINT `master_product_detail_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `master_account` (`account_id`),
  ADD CONSTRAINT `master_product_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `master_product` (`product_id`),
  ADD CONSTRAINT `master_product_detail_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `master_unit` (`unit_id`),
  ADD CONSTRAINT `master_product_detail_ibfk_4` FOREIGN KEY (`currency_id`) REFERENCES `master_currency` (`currency_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
