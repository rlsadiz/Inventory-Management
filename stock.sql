-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2018 at 09:29 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

﻿--
-- Database: `stock`
--
﻿
-- --------------------------------------------------------

--
-- Table structure for table `brand`
--
-- Creation: Jun 13, 2018 at 06:49 AM
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id_brand` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user` int(11) NOT NULL,
  `brand_code` char(5) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `brand_name` varchar(255) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `brand_status` tinyint(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_brand`),
  UNIQUE KEY `brand_code` (`brand_code`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
﻿
--
-- Dumping data for table `brand`
--

﻿INSERT IGNORE INTO `brand` (`id_brand`, `fk_user`, `brand_code`, `brand_name`, `brand_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'MCHLN', 'Michelin', 1, '2018-06-13 06:45:06', '2018-06-13 15:02:08')﻿,
(2, 1, 'PRLLI', 'Pirelli', 1, '2018-06-13 06:45:33', '2018-06-13 15:02:16')﻿,
(3, 1, 'PENZL', 'Pennzoil', 1, '2018-06-13 06:45:45', '2018-06-13 17:33:02')﻿,
(4, 1, 'YKHMA', 'Yokohama', 1, '2018-06-13 06:45:54', '2018-06-13 15:02:43')﻿,
(5, 1, 'MOBIL', 'Mobil', 1, '2018-06-13 06:46:03', '2018-06-13 15:02:47')﻿,
(6, 1, 'UNBRN', 'Unbranded', 1, '2018-06-13 06:46:20', '2018-06-13 15:03:12')﻿,
(7, 1, 'TRTLW', 'Turtle Wax', 1, '2018-06-13 07:44:20', '2018-06-13 15:03:48')﻿;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `category`
--
-- Creation: Jun 13, 2018 at 06:57 AM
--

CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user` int(11) NOT NULL,
  `fk_parent_category` int(11) NOT NULL,
  `tree_id` int(11) NOT NULL,
  `category_code` char(3) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `level` tinyint(4) NOT NULL,
  `category_status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_category`),
  UNIQUE KEY `tree_id` (`tree_id`),
  UNIQUE KEY `category_code` (`category_code`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
﻿
--
-- Dumping data for table `category`
--

﻿INSERT IGNORE INTO `category` (`id_category`, `fk_user`, `fk_parent_category`, `tree_id`, `category_code`, `category_name`, `level`, `category_status`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, '---', 'Root', 0, 1, '2018-06-12 18:14:54', '2018-06-13 15:01:38')﻿,
(2, 1, 1, 100000000, 'ACC', 'Accesories', 1, 1, '2018-06-13 06:51:16', '2018-06-13 15:00:09')﻿,
(3, 1, 1, 200000000, 'VHC', 'Vehicle Care', 1, 1, '2018-06-13 06:55:57', '2018-06-13 15:00:15')﻿,
(4, 1, 1, 201000000, 'EVC', 'Exterior Vehicle Care', 2, 1, '2018-06-13 06:53:01', '2018-06-13 15:00:21')﻿,
(5, 1, 1, 300000000, 'CRP', 'Car Parts', 1, 1, '2018-06-13 06:58:40', '2018-06-13 15:00:26')﻿,
(6, 1, 2, 101000000, 'CRC', 'Car Cover', 2, 1, '2018-06-13 07:03:03', '2018-06-13 15:00:31')﻿,
(7, 1, 1, 400000000, 'TRS', 'Tires', 1, 1, '2018-06-13 07:17:11', '2018-06-13 15:00:40')﻿,
(8, 1, 7, 401000000, 'RCT', 'Racing Tires', 2, 1, '2018-06-13 07:17:30', '2018-06-13 15:00:45')﻿,
(9, 1, 7, 402000000, 'ATT', 'All-terrain Tires', 2, 1, '2018-06-13 07:27:35', '2018-06-13 15:00:50')﻿,
(10, 1, 1, 500000000, 'OIL', 'Oil & Fluids', 1, 1, '2018-06-13 15:11:59', '2018-06-13 15:11:59')﻿;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--
-- Creation: Jun 13, 2018 at 03:24 PM
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `id_inventory` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user` int(11) NOT NULL,
  `fk_sku` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf16_unicode_ci NOT NULL,
  `sku_code` char(14) COLLATE utf16_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_inventory`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;
﻿
--
-- Dumping data for table `inventory`
--

﻿INSERT IGNORE INTO `inventory` (`id_inventory`, `fk_user`, `fk_sku`, `type`, `sku_code`, `quantity`, `created_at`) VALUES
(1, 1, 3, 'Initial Stock', 'PENZL-OIL01-01', 2, '2018-06-13 15:48:03')﻿,
(2, 1, 1, 'Purchase', 'YKHMA-RCT01-01', 4, '2018-06-13 17:08:40')﻿,
(3, 1, 4, 'Purchase', 'YKHMA-RCT01-02', 4, '2018-06-13 17:08:40')﻿,
(4, 1, 2, 'Purchase', 'TRTLW-EVC01-01', 15, '2018-06-13 17:19:28')﻿;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `orders`
--
-- Creation: Jun 13, 2018 at 02:35 PM
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user` int(11) NOT NULL,
  `fk_customer` int(11) DEFAULT NULL,
  `order_number` bigint(12) NOT NULL,
  `sale_amount` decimal(10,0) NOT NULL,
  `discount_amount` decimal(10,0) NOT NULL,
  `commission_amount` decimal(10,0) NOT NULL,
  `charged_amount` decimal(10,0) NOT NULL,
  `final_amount` decimal(10,0) NOT NULL,
  `vat_sale` decimal(10,0) NOT NULL,
  `non_vat_sale` decimal(10,0) NOT NULL,
  `vat_amount` decimal(10,0) NOT NULL,
  `paid_amount` decimal(10,0) NOT NULL,
  `change_amount` decimal(10,0) NOT NULL,
  `payment_method` varchar(20) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `payment_status` varchar(20) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `order_status` varchar(10) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--
-- Creation: Jun 12, 2018 at 01:35 PM
--

CREATE TABLE IF NOT EXISTS `order_item` (
  `id_item_order` int(11) NOT NULL AUTO_INCREMENT,
  `fk_order` int(11) NOT NULL DEFAULT '0',
  `fk_sku` int(11) NOT NULL DEFAULT '0',
  `sku_code` char(16) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `sale_price` decimal(10,0) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `commission` decimal(10,0) NOT NULL,
  `charged_price` decimal(10,0) NOT NULL,
  `final_price` decimal(10,0) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `sale_amount` decimal(10,0) NOT NULL,
  `discount_amount` decimal(10,0) NOT NULL,
  `commission_amount` decimal(10,0) NOT NULL,
  `charged_amount` decimal(10,0) NOT NULL,
  `final_amount` decimal(10,0) NOT NULL,
  `order_item_status` varchar(10) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `is_vatable` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_item_order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
﻿
-- --------------------------------------------------------

--
-- Stand-in structure for view `price_list`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `price_list` (
`id_sku` int(11)
,`sku_code` char(14)
,`product_name` varchar(511)
,`cost` decimal(10,2)
,`price` decimal(10,2)
,`promotion_price` decimal(10,2)
,`updated_at` timestamp
);
﻿
-- --------------------------------------------------------

--
-- Table structure for table `product`
--
-- Creation: Jun 13, 2018 at 03:25 PM
--

CREATE TABLE IF NOT EXISTS `product` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user` int(11) NOT NULL,
  `fk_category` int(11) NOT NULL,
  `fk_brand` int(11) NOT NULL,
  `product_code` char(11) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `product_image` text CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `product_status` tinyint(4) NOT NULL,
  `is_vatable` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
﻿
--
-- Dumping data for table `product`
--

﻿INSERT IGNORE INTO `product` (`id_product`, `fk_user`, `fk_category`, `fk_brand`, `product_code`, `product_name`, `product_image`, `product_status`, `is_vatable`, `created_at`, `updated_at`) VALUES
(5, 1, 8, 4, 'YKHMA-RCT01', 'Yokohama Advan A005', '../assests/images/products/YKHMA-RCT01.jpg', 1, 1, '2018-06-13 07:24:12', '2018-06-13 15:25:49')﻿,
(6, 1, 9, 4, 'YKHMA-ATT01', 'Yokohama Geolander A/T G015', '../assests/images/products/YKHMA-ATT01.jpg', 1, 1, '2018-06-13 07:31:43', '2018-06-13 15:25:52')﻿,
(7, 1, 4, 7, 'TRTLW-EVC01', 'Turtle Wax Super Hard Shell Car Wax', '../assests/images/products/TRTLW-EVC01.jpg', 1, 1, '2018-06-13 07:47:39', '2018-06-13 15:25:54')﻿,
(8, 1, 6, 6, 'UNBRN-CRC01', 'Car Cover', '../assests/images/products/UNBRN-CRC01.jpg', 1, 1, '2018-06-13 08:18:30', '2018-06-13 15:25:56')﻿,
(9, 1, 10, 3, 'PENZL-OIL01', 'Pennzoil Gold Motor Oil', '../assests/images/products/PENZL-OIL01.jpg', 1, 0, '2018-06-13 17:32:33', '2018-06-13 17:38:38')﻿;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `product_sku`
--
-- Creation: Jun 13, 2018 at 03:59 PM
--

CREATE TABLE IF NOT EXISTS `product_sku` (
  `id_sku` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user` int(11) NOT NULL,
  `fk_product` int(11) NOT NULL,
  `sku_code` char(14) COLLATE utf16_unicode_ci NOT NULL,
  `variation` varchar(255) COLLATE utf16_unicode_ci NOT NULL,
  `variation_code` varchar(2) COLLATE utf16_unicode_ci NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `critical_quantity` tinyint(4) NOT NULL,
  `length` float DEFAULT NULL,
  `width` float DEFAULT NULL,
  `height` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `sku_status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_sku`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;
﻿
--
-- Dumping data for table `product_sku`
--

﻿INSERT IGNORE INTO `product_sku` (`id_sku`, `fk_user`, `fk_product`, `sku_code`, `variation`, `variation_code`, `cost`, `price`, `critical_quantity`, `length`, `width`, `height`, `weight`, `sku_status`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'YKHMA-RCT01-01', '160/55VR13 SS 13 inch', '01', '15250.00', '20000.00', 4, NULL, NULL, NULL, NULL, 1, '2018-06-13 16:02:31', '2018-06-13 18:43:16')﻿,
(2, 1, 7, 'TRTLW-EVC01-01', '270g', '01', '400.00', '450.00', 10, NULL, NULL, NULL, NULL, 1, '2018-06-13 16:17:51', '2018-06-13 16:18:18')﻿,
(3, 1, 9, 'PENZL-OIL01-01', '5W-20 5 quart', '01', '25000.00', '30000.00', 2, NULL, NULL, NULL, NULL, 1, '2018-06-13 17:46:12', '2018-06-13 17:46:28')﻿,
(4, 1, 5, 'YKHMA-RCT01-02', '190/580R15 S 15 inch', '02', '16000.00', '21000.00', 4, NULL, NULL, NULL, NULL, 1, '2018-06-13 18:31:53', '2018-06-13 18:45:07')﻿;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--
-- Creation: Jun 13, 2018 at 05:49 PM
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `id_promotion` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user` int(11) NOT NULL,
  `promotion_name` varchar(255) COLLATE utf16_unicode_ci NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_promotion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;
﻿
--
-- Dumping data for table `promotion`
--

﻿INSERT IGNORE INTO `promotion` (`id_promotion`, `fk_user`, `promotion_name`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 1, 'Test Promotion', '2018-06-14 00:00:00', '2018-06-14 02:22:00', '2018-06-13 17:49:14', '2018-06-13 18:21:22')﻿;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `promotion_item`
--
-- Creation: Jun 13, 2018 at 05:50 PM
--

CREATE TABLE IF NOT EXISTS `promotion_item` (
  `id_promotion_item` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user` int(11) NOT NULL,
  `fk_promotion` int(11) NOT NULL,
  `fk_sku` int(11) NOT NULL,
  `promotion_price` decimal(10,2) NOT NULL,
  `promotion_discount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_promotion_item`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;
﻿
--
-- Dumping data for table `promotion_item`
--

﻿INSERT IGNORE INTO `promotion_item` (`id_promotion_item`, `fk_user`, `fk_promotion`, `fk_sku`, `promotion_price`, `promotion_discount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, '27000.00', '3000.00', '2018-06-13 17:50:10', '2018-06-13 17:50:10')﻿;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--
-- Creation: Jun 13, 2018 at 07:02 PM
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `id_purchase` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user` int(11) NOT NULL,
  `fk_supplier` int(11) NOT NULL,
  `purchase_code` char(9) COLLATE utf16_unicode_ci NOT NULL,
  `cost_amount` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `purchase_status` varchar(10) COLLATE utf16_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_purchase`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;
﻿
--
-- Dumping data for table `purchase`
--

﻿INSERT IGNORE INTO `purchase` (`id_purchase`, `fk_user`, `fk_supplier`, `purchase_code`, `cost_amount`, `paid_amount`, `purchase_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'YTSP-0001', '1250000.00', '125000.00', '4', '2018-06-13 15:04:24', '2018-06-13 19:08:01')﻿;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `purchase_item`
--
-- Creation: Jun 13, 2018 at 06:39 PM
--

CREATE TABLE IF NOT EXISTS `purchase_item` (
  `id_purchase_item` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user` int(11) NOT NULL,
  `fk_purchase` int(11) NOT NULL,
  `fk_sku` int(11) NOT NULL,
  `sku_code` char(14) COLLATE utf16_unicode_ci NOT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `batch_size` int(4) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `units` int(11) NOT NULL,
  `unit_cost` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_purchase_item`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;
﻿
--
-- Dumping data for table `purchase_item`
--

﻿INSERT IGNORE INTO `purchase_item` (`id_purchase_item`, `fk_user`, `fk_purchase`, `fk_sku`, `sku_code`, `cost_price`, `quantity`, `batch_size`, `total_cost`, `units`, `unit_cost`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'YKHMA-RCT01-01', '61000.00', 1, 4, '61000.00', 4, '15250.00', '2018-06-13 15:04:24', '2018-06-13 19:08:06')﻿,
(2, 1, 1, 4, 'YKHMA-RCT01-02', '64000.00', 1, 4, '64000.00', 4, '16000.00', '2018-06-13 15:04:24', '2018-06-13 19:08:09')﻿;
﻿
-- --------------------------------------------------------

--
-- Stand-in structure for view `stock`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `stock` (
`sku_code` char(14)
,`product_name` varchar(511)
,`quantity` decimal(32,0)
,`last_purhase_date` datetime
,`last_order_date` datetime
,`critical_quantity` tinyint(4)
);
﻿
-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--
-- Creation: Jun 13, 2018 at 07:14 PM
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user` int(11) NOT NULL,
  `supplier_code` varchar(4) COLLATE utf16_unicode_ci NOT NULL,
  `supplier_name` varchar(255) COLLATE utf16_unicode_ci NOT NULL,
  `supplier_address` text COLLATE utf16_unicode_ci NOT NULL,
  `supplier_phone` varchar(12) COLLATE utf16_unicode_ci NOT NULL,
  `supplier_email` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `contact_person` varchar(40) COLLATE utf16_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;
﻿
--
-- Dumping data for table `supplier`
--

﻿INSERT IGNORE INTO `supplier` (`id_supplier`, `fk_user`, `supplier_code`, `supplier_name`, `supplier_address`, `supplier_phone`, `supplier_email`, `contact_person`, `created_at`, `updated_at`) VALUES
(1, 1, 'YTSP', 'Yokohama Tire Sales Philippines, Inc.', 'IE-5 Clark Freeport Zone, Philippines 2023\r\nMabalacat City, Pampanga', '63455993613', NULL, 'Test Person', '2018-06-13 15:04:39', '2018-06-13 19:14:57')﻿,
(2, 1, 'BLAD', 'Blade Auto Center', '108 Timog Ave, Diliman, Quezon City, 1103 Metro Manila', '6329277777', NULL, NULL, '2018-06-13 19:13:37', '2018-06-13 19:13:37')﻿;
﻿
-- --------------------------------------------------------

--
-- Table structure for table `user`
--
-- Creation: Jun 13, 2018 at 02:44 PM
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf16 COLLATE utf16_unicode_ci DEFAULT NULL,
  `first_name` varchar(50) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
﻿
--
-- Dumping data for table `user`
--

﻿INSERT IGNORE INTO `user` (`id_user`, `username`, `password`, `email`, `first_name`, `last_name`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', '', 'administrator', 'account')﻿;
﻿
-- --------------------------------------------------------

--
-- Structure for view `price_list`
--
DROP TABLE IF EXISTS `price_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `price_list`  AS  select `sku`.`id_sku` AS `id_sku`,`sku`.`sku_code` AS `sku_code`,concat(`p`.`product_name`,' ',`sku`.`variation`) AS `product_name`,`sku`.`cost` AS `cost`,`sku`.`price` AS `price`,min(if(((now() > `pro`.`start_time`) and (now() < `pro`.`end_time`)),`pi`.`promotion_price`,NULL)) AS `promotion_price`,`sku`.`updated_at` AS `updated_at` from (((`product_sku` `sku` join `product` `p` on((`p`.`id_product` = `sku`.`fk_product`))) left join `promotion_item` `pi` on((`sku`.`id_sku` = `pi`.`fk_sku`))) left join `promotion` `pro` on((`pro`.`id_promotion` = `pi`.`fk_promotion`))) where (`sku`.`sku_status` = 1) group by 1 ;
﻿
-- --------------------------------------------------------

--
-- Structure for view `stock`
--
DROP TABLE IF EXISTS `stock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stock`  AS  select `i`.`sku_code` AS `sku_code`,concat(`p`.`product_name`,' ',`sku`.`variation`) AS `product_name`,sum(`i`.`quantity`) AS `quantity`,max(if((`i`.`type` = 'Purchase'),`i`.`created_at`,NULL)) AS `last_purhase_date`,max(if((`i`.`type` = 'Order'),`i`.`created_at`,NULL)) AS `last_order_date`,`sku`.`critical_quantity` AS `critical_quantity` from ((`inventory` `i` join `product_sku` `sku` on((`sku`.`id_sku` = `i`.`fk_sku`))) join `product` `p` on((`p`.`id_product` = `sku`.`fk_product`))) group by 1 ;
﻿COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
