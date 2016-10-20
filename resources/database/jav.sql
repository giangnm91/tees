-- phpMyAdmin SQL Dump
-- version 4.4.15.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2016 at 05:10 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jav`
--

-- --------------------------------------------------------

--
-- Table structure for table `group_has_users`
--

CREATE TABLE IF NOT EXISTS `group_has_users` (
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_has_users`
--

INSERT INTO `group_has_users` (`group_id`, `user_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ParentID` int(11) DEFAULT NULL,
  `Slug` varchar(30) CHARACTER SET latin1 COLLATE latin1_german2_ci DEFAULT NULL,
  `Icon` varchar(30) CHARACTER SET latin1 COLLATE latin1_german2_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`CategoryID`, `CategoryName`, `ParentID`, `Slug`, `Icon`) VALUES
(29, 'DANH SÁCH ĐƠN HÀNG', 27, 'app#/order', 'fa-list'),
(28, 'TẠO ĐƠN HÀNG', 27, 'app#/order/add', 'fa-plus'),
(27, 'ĐƠN HÀNG', 0, 'app#/order', 'fa-gift'),
(25, 'MENU', 24, 'system/menu', 'fa-list'),
(24, 'HỆ THỐNG', 0, 'system', 'fa-wrench'),
(22, 'TRANG CHỦ', 0, 'home', 'fa-home');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `OrderPercentOff` float NOT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrderPercentEffort` float NOT NULL DEFAULT '3',
  `OrderTotal` float DEFAULT NULL,
  `OrderStatus` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `OrderReturnCode` varchar(30) COLLATE latin1_german2_ci DEFAULT NULL,
  `OrderJpCode` varchar(30) COLLATE latin1_german2_ci DEFAULT NULL,
  `OrderGuestNote` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `OrderAdminNote` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `OrderCreator` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'guest',
  `OrderReceiverName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `OrderReceiverPhone` varchar(12) COLLATE latin1_german2_ci DEFAULT NULL,
  `OrderReceiverAddress` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `UserID`, `OrderPercentOff`, `OrderDate`, `OrderPercentEffort`, `OrderTotal`, `OrderStatus`, `OrderReturnCode`, `OrderJpCode`, `OrderGuestNote`, `OrderAdminNote`, `OrderCreator`, `OrderReceiverName`, `OrderReceiverPhone`, `OrderReceiverAddress`) VALUES
(2, 2, 5, '2016-10-06 08:17:36', 3, 1030000, 'pending', NULL, 'JPA1123', NULL, NULL, 'guest', NULL, NULL, NULL),
(3, 1, 0, '2016-10-06 08:18:47', 3, 3300300, 'pending', NULL, 'JP0981', NULL, NULL, 'admin', NULL, NULL, NULL),
(29, 2, 0, '2016-10-20 00:29:37', 5, 509, 'pending', NULL, NULL, NULL, NULL, 'admin', NULL, NULL, NULL),
(28, 2, 0, '2016-10-20 00:13:55', 5, 515, 'pending', NULL, NULL, NULL, NULL, 'admin', NULL, NULL, NULL),
(30, 2, 0, '2016-10-20 09:30:03', 5, 557.5, 'pending', NULL, NULL, NULL, NULL, 'admin', 'Giang', '0987654321', 'số nhà 345 - ngõ 456 - phường XYZ'),
(31, 1, 0, '2016-10-20 09:32:40', 5, 420, 'pending', NULL, NULL, NULL, NULL, 'admin', 'XYZ', '0987654321', 's? nhà 123 - ngõ 456 - phường H - quận B'),
(32, 2, 0, '2016-10-20 09:57:54', 5, 525, 'pending', NULL, NULL, NULL, NULL, 'admin', 'Giang', '0987654321', 'số nhà 999 - ngõ 456 - phường XYZ');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `permission_id` int(11) NOT NULL,
  `permission_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `permission_description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `ProductID` int(12) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProductPrice` float NOT NULL,
  `ProductQty` int(11) NOT NULL DEFAULT '1',
  `ProductSize` varchar(5) COLLATE latin1_german2_ci NOT NULL,
  `ProductColor` varchar(10) COLLATE latin1_german2_ci DEFAULT NULL,
  `ProductUrl` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ProductDesc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ProductLive` tinyint(1) DEFAULT '0',
  `ProductTax` float DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1045 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `OrderID`, `ProductPrice`, `ProductQty`, `ProductSize`, `ProductColor`, `ProductUrl`, `ProductDesc`, `ProductLive`, `ProductTax`) VALUES
(1, 2, 250000, 1, 'S', 'black', 'http://www.chongiadung.com', 'A light cotton T-Shirt made with 100% real cotton.\r\n\r\nMade right here in the USA for over 15 years, this t-shirt is lightweight and durable.', 1, 3),
(2, 3, 180000, 2, 'M', 'white', 'http://www.chongiadung.com', 'A rugged track and trail athletic shoe', 1, 3),
(997, 2, 230000, 1, 'S', 'black', 'http://www.chongiadung.com', '', 1, 5),
(998, 2, 220000, 1, 'L', 'red', 'http://www.chongiadung.com', '', 1, 3),
(1006, 3, 180000, 1, 'XL', 'blue', 'http://www.chongiadung.com', '', 1, NULL),
(1007, 2, 260000, 1, 'XXL', 'blue', 'http://www.chongiadung.com', '', 1, 3),
(1009, 3, 200000, 1, 'S', 'white', 'http://www.chongiadung.com', '', 1, 5),
(1010, 3, 200000, 3, 'M', 'black', 'http://www.chongiadung.com', '', 1, 5),
(1011, 2, 350000, 1, 'Free', 'white', 'http://www.chongiadung.com', '', 1, 3),
(1012, 2, 380000, 1, 'XXL', 'white', 'http://www.chongiadung.com', '', 1, 3),
(1039, 29, 200, 1, 'xl', 'blue', 'http://lauxanh.us.vn', '', 0, 0),
(1038, 29, 150, 2, 'm', 'red', 'http://lauxanh.us', '', 0, 3),
(1036, 28, 150, 2, 'XL', 'RED', 'http://dantri.com.vn', '', 0, 5),
(1037, 28, 200, 1, 'M', 'BLUE', 'http://vnexpress.net', '', 0, 0),
(1040, 30, 150, 1, 'L', 'RED', 'http://dantri.com.vn', '', 0, 5),
(1041, 30, 200, 2, 'M', 'BLUE', 'http://vnexpress.net', '', 0, 0),
(1042, 31, 200, 2, 'XL', 'RED', 'http://abc.com', '', 0, 5),
(1043, 32, 200, 2, 'M', 'RED', 'http://timkiem.mobi', '', 0, 5),
(1044, 32, 100, 1, 'XL', 'BLUE', 'http://24h.com.vn', '', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `products_orders`
--

CREATE TABLE IF NOT EXISTS `products_orders` (
  `ProductOrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products_orders`
--

INSERT INTO `products_orders` (`ProductOrderID`, `ProductID`, `OrderID`) VALUES
(1, 997, 2),
(2, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `usergroup_has_permissions`
--

CREATE TABLE IF NOT EXISTS `usergroup_has_permissions` (
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL,
  `UserEmail` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserPassword` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserFirstName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserLastName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserCity` varchar(90) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserZip` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserEmailVerified` tinyint(1) DEFAULT '0',
  `UserRegistrationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UserVerificationCode` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserPhone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserCountry` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserAddress` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserEmail`, `UserPassword`, `UserFirstName`, `UserLastName`, `UserCity`, `UserZip`, `UserEmailVerified`, `UserRegistrationDate`, `UserVerificationCode`, `UserPhone`, `UserCountry`, `UserAddress`) VALUES
(1, 'test@gmail.com', 'abcxyz', 'Nguyen', 'XYZ', 'Hà Nội', '10000', 1, '2016-10-19 07:09:36', 'abcxyz', '0987654321', 'Việt Nam', 's? nhà 123 - ngõ 456 - phường H - quận B'),
(2, 'test@gmail.com', 'abcxyz', 'Nguyen', 'Test', 'Hà Nội', '10000', 0, '2016-10-19 07:11:52', 'poipoi', '0987654321', 'Việt Nam', 'số nhà 123 - ngõ 456 - phường XYZ');

-- --------------------------------------------------------

--
-- Table structure for table `users_admin`
--

CREATE TABLE IF NOT EXISTS `users_admin` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name_normal` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `address` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_admin`
--

INSERT INTO `users_admin` (`user_id`, `name`, `name_normal`, `active`, `email`, `created_date`, `updated_date`, `description`, `address`, `password`, `remember_token`, `login_ip`, `login_at`) VALUES
(1, 'Giang Nguyễn', 'giang nguyen', 1, 'giang@meoshop.com', '2016-08-15', NULL, NULL, '63 to 20 phuong Hoang Van Thu - Hoang Mai - Ha Noi', '$2y$10$XK7WLBI2nmkdEl62.NkVw.U4SpDvD0WHQCyoqY.KmoxJIgDoXKZMq', 'NAoLM7BKSd2o4J1k6kiZxC0Ky2CtTXcHfNr3TjNy1O9e0K8t1jrGQ4NAhrbB', '127.0.0.1', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `group_description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`group_id`, `group_name`, `group_description`) VALUES
(1, 'admin', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `user_has_permissions`
--

CREATE TABLE IF NOT EXISTS `user_has_permissions` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `group_has_users`
--
ALTER TABLE `group_has_users`
  ADD PRIMARY KEY (`group_id`,`user_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `products_orders`
--
ALTER TABLE `products_orders`
  ADD PRIMARY KEY (`ProductOrderID`);

--
-- Indexes for table `usergroup_has_permissions`
--
ALTER TABLE `usergroup_has_permissions`
  ADD PRIMARY KEY (`group_id`,`permission_id`,`app_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `users_admin`
--
ALTER TABLE `users_admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `user_has_permissions`
--
ALTER TABLE `user_has_permissions`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`app_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1045;
--
-- AUTO_INCREMENT for table `products_orders`
--
ALTER TABLE `products_orders`
  MODIFY `ProductOrderID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_admin`
--
ALTER TABLE `users_admin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
