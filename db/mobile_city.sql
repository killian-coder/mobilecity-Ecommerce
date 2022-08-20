-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 12, 2017 at 07:33 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mobile_city`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(1, 'SAMSUNGS'),
(2, 'IPHONES'),
(13, 'Dell'),
(11, 'Nokia'),
(6, 'Hewlett-Packard (HP)'),
(16, 'CANON'),
(15, 'ITEL'),
(17, 'TOSHIBA'),
(18, 'LENOVO'),
(19, 'SAN DISK'),
(20, 'JBL');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent`) VALUES
(1, 'Phones', 0),
(2, 'Laptops', 0),
(3, 'Printers', 0),
(4, 'Monitors', 0),
(5, 'samsungs', 1),
(6, 'iphones', 1),
(7, 'nokia', 1),
(8, 'tecno', 1),
(9, 'Dell', 2),
(10, 'Hp', 2),
(11, 'Accer', 2),
(12, 'Mac books pro', 2),
(13, 'canon', 3),
(14, 'lazer-jet', 3),
(15, 'Dell monitors', 4),
(16, 'Hp monitors', 4),
(25, 'itel', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `brand` int(11) NOT NULL,
  `categories` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `sizes` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `sizes`, `deleted`) VALUES
(1, 'Samsung S6', '400.99', '399.99', 1, '1', '/mobilecity-Ecommerce/image/samsung_s6.gif', '15mega pixels back and front camera, 14 days battery, H+ network money back guarantees  ', 1, 'small:3, medium:large,34:5', 0),
(2, 'Samsung GT9305', '450.00', '800.00', 1, '1', '/mobilecity-Ecommerce/image/samsung-galaxy.jpg', 'best phones: we have black and white ', 0, '12:4,23:45', 0),
(3, 'printer', '1200.00', '2990.99', 1, '3', '/mobilecity-Ecommerce/image/printer.jpg', 'the best printers in you can get in mobile city', 1, '', 0),
(4, 'samsung galaxy note 5', '4500.00', '5700.00', 1, '1', '', 'best fone ', 1, '', 0),
(6, 'usb', '23.70', '56.90', 0, 'laptops', '', 'killian is awesome so buy this product', 0, '', 1),
(28, 'samsung S8', '45.99', '50.99', 1, '', '/mobilecity-Ecommerce/image/products/e190d4c132ce79449e199df38d81657c.jpg', 'new phone with a more advanced hate', 0, '16gb:6,32:11', 0),
(8, 'flash disk', '346.00', '34.00', 0, '2', '', 'tuyuyuyiiuiiihkgbg', 0, '23:12', 0),
(11, 'itel', '45.99', '55.00', 11, '7', '', 'werop[]vvbvbgvbv', 0, 'N/A:6,', 1),
(10, 'tutu', '34.99', '233.00', 13, '9', '', 'rutitiiyiyi', 0, 'small:4,', 0),
(12, 'motolola', '45.00', '55.00', 0, 'nokia', '/mobilecity-Ecommerce/image/samsung_s6.gif', 'awesome fones', 0, '', 0),
(15, 'infix s32', '34.89', '100.89', 1, 'phones', '', 'best mobile phones on the market', 0, '34:25,40:21', 0),
(33, 'Samsung jet', '45.99', '50.99', 1, '', '/mobilecity-Ecommerce/image/products/81a57d65399b0208f515caa798645029.png', 'new phone with a more advanced hate', 0, '16gb:6,32gb:11', 0),
(16, 'simens', '34.99', '50.99', 2, '6', '', 'killlskwpcm dkdskdskldslds', 0, 'N/A:,', 0),
(17, 'samsung S8', '45.99', '50.99', 1, '1', '', 'this is a wonderful phone ', 1, 'N/A:6,', 1),
(18, 'chakana', '20.00', '50.00', 0, 'phones', '', '', 0, 'watapp it your boy china phone', 0),
(31, 'samsung S8', '45.99', '50.99', 1, '', '/mobilecity-Ecommerce/image/products/bb19977504aa1c7eec233072a0f39f9f.jpg', 'this is a wonderful phone ', 1, 'N/A:6', 0),
(19, 'Cat', '47.00', '3446575.68', 2, '1', '/mobilecity-Ecommerce/image/products/18a7db3da966e0046e296d316709af63.png', 'this is a killa phone buy it and test it greatness', 0, 'N/A:,', 0),
(20, 'Lenovo T420i', '2400.99', '4300.00', 18, '2', '/mobilecity-Ecommerce/image/products/0fc62f32eb6b436ac564b74ea28e05d6.jpg', '\r\n4th gen, 1 tb harddrive 2g ', 0, 'small:3,large:4,', 0),
(34, 'Samsung S6 edge', '400.99', '399.99', 1, '', '', '15mega pixels back and front camera, 14 days battery, H+ network money back guarantees  ', 1, 'small:3, medium:large,34:5', 0),
(30, 'Nokia asha 202', '45.99', '55.00', 11, '', '/mobilecity-Ecommerce/image/products/a098221ba6a1d20b7a959320b01402ab.jpg', 'latest phone on the market .', 0, '8gb:6', 0),
(32, 'samsung S8', '45.99', '50.99', 1, '', '/mobilecity-Ecommerce/image/products/7b4b0e33082585854e118d7bef4af364.png', 'this is a wonderful phone ', 0, 'N/A:6', 0),
(29, 'Samsung jet', '45.99', '50.99', 1, '', '', 'new phone with a more advanced hate', 1, '16gb:6,32gb:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `join_date`, `last_login`, `permission`) VALUES
(1, 'killian chinths', 'killian@gmail.com', 'odette57', '2017-11-10 22:50:13', '2017-11-10 22:53:04', 'admin,editor');
