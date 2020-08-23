-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 17, 2018 at 10:18 AM
-- Server version: 5.7.21
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicles_maintenance`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` int(12) NOT NULL AUTO_INCREMENT,
  `booking_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `booking_date` date DEFAULT NULL,
  `mechanic_id` int(10) DEFAULT NULL,
  `customer_id` int(10) DEFAULT NULL,
  `problem_details` text,
  `charges` int(12) DEFAULT NULL,
  `status` int(10) DEFAULT '0',
  PRIMARY KEY (`booking_id`),
  KEY `mechanic_id` (`mechanic_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `booking_time`, `booking_date`, `mechanic_id`, `customer_id`, `problem_details`, `charges`, `status`) VALUES
(15, '2018-09-17 08:57:44', '2018-09-18', 6, 14, 'Spark Plug, ', 900, 2),
(14, '2018-09-17 08:53:36', '2018-09-19', 6, 14, 'Exhaust recirculation valves, ', 1380, 2),
(13, '2018-09-17 08:53:09', '2018-09-18', 8, 14, 'Spark Plug, Exhaust recirculation valves, ', NULL, 0),
(12, '2018-09-14 11:41:24', '2018-09-20', 8, 14, 'Spark Plug, ', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `register_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '1',
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`, `password`, `address`, `city`, `country`, `contact`, `picture`, `register_date`, `status`, `lat`, `lng`, `is_active`) VALUES
(15, 'Smit', 'miz', 'smit@example.com', 'a9442b8ff9cd7e8520afa3253d23a3a0', 'Double road', 'rawalpindi', 'Pak', '0300-0303030', 'pexels-photo-842548.jpeg', '2018-09-17 10:12:48', 1, '33.650882', '73.0739856', 1),
(14, 'John', 'Doe', 'johndoe@examle.com', 'a9442b8ff9cd7e8520afa3253d23a3a0', 'khanna pul', 'islamabad', 'islamabad', '0333-1111111', 'admin.jpg', '2018-09-10 22:01:05', 1, '33.6292631', '73.1136695', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mechanics`
--

DROP TABLE IF EXISTS `mechanics`;
CREATE TABLE IF NOT EXISTS `mechanics` (
  `mechanic_id` int(12) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `status` int(10) DEFAULT '1',
  `picture` varchar(255) DEFAULT NULL,
  `register_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `completed_requests` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mechanic_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mechanics`
--

INSERT INTO `mechanics` (`mechanic_id`, `first_name`, `last_name`, `email`, `password`, `address`, `city`, `country`, `contact`, `status`, `picture`, `register_date`, `lat`, `lng`, `rating`, `completed_requests`, `is_active`) VALUES
(8, 'jon', 'cena', 'jony@gmail.com', 'a9442b8ff9cd7e8520afa3253d23a3a0', 'rawat', 'islamabad', 'pakistan', '0333-1111111', 1, 'Umer.jpg', '2018-09-12 00:09:28', '33.4951028', '73.1969108', 4, 1, 1),
(6, 'anees', 'mumtaz', 'anees@gmail.com', 'a9442b8ff9cd7e8520afa3253d23a3a0', 'sadiqabad', 'rawalpindi', 'pakistan', '0000-0000000', 1, 'Dummy-image.jpg', '2018-09-10 21:43:10', '33.6328529', '73.0833224', 4.5, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `reciever_id` int(12) DEFAULT NULL,
  `sender_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint(4) NOT NULL DEFAULT '0',
  `request_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `description`, `reciever_id`, `sender_id`, `created_at`, `is_read`, `request_id`) VALUES
(19, 'One of Our customer is facing following problems in his car. Please accept his request to help him out.<br>Problems are: Spark Plug, ', 8, 14, '2018-09-13 09:07:42', 1, 31),
(20, 'One of Our customer is facing following problems in his car. Please accept his request to help him out.<br>Problems are: Exhaust recirculation valves, ', 6, 14, '2018-09-17 08:47:03', 1, 32),
(21, 'One of Our customer is facing following problems in his car. Please accept his request to help him out.<br>Problems are: heavy Damage', 6, 14, '2018-09-17 09:13:14', 0, 33),
(22, 'One of Our customer is facing following problems in his car. Please accept his request to help him out.<br>Problems are: Spark Plug, ', 6, 14, '2018-09-17 09:23:23', 1, 34),
(23, 'One of Our customer is facing following problems in his car. Please accept his request to help him out.<br>Problems are: Spark Plug, ', 6, 15, '2018-09-17 10:13:30', 1, 35);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `request_id` int(10) NOT NULL AUTO_INCREMENT,
  `request_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `issue` text,
  `location` varchar(255) DEFAULT NULL,
  `repairing_charges` int(10) DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT '0',
  `mechanic_id` int(12) DEFAULT NULL,
  `customer_id` int(12) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `mechanic_time` int(120) DEFAULT NULL,
  PRIMARY KEY (`request_id`),
  KEY `customer_id` (`customer_id`),
  KEY `mechanic_id` (`mechanic_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `request_time`, `issue`, `location`, `repairing_charges`, `status`, `mechanic_id`, `customer_id`, `lat`, `lng`, `mechanic_time`) VALUES
(34, '2018-09-17 09:23:23', 'Spark Plug, ', 'Double Road, Rawalpindi, Pakistan', 1350, 1, 6, 14, '33.650882', '73.0739856', 18),
(35, '2018-09-17 10:13:30', 'Spark Plug, ', 'Service Road, Rawalpindi, Pakistan', 1600, 1, 6, 15, '33.6089823', '73.0113258', 45),
(33, '2018-09-17 09:13:14', 'heavy Damage', 'Saddar, Rawalpindi, Pakistan', NULL, 0, NULL, 14, '33.5961113', '73.0538097', NULL),
(32, '2018-09-17 08:47:03', 'Exhaust recirculation valves, ', 'Tarnol, Islamabad, Pakistan', 400, 1, 6, 14, '33.6520494', '72.9086579', 45),
(31, '2018-09-13 09:07:42', 'Spark Plug, ', 'Iqbal Town, Islamabad, Pakistan', 300, 2, 8, 14, '33.6493292', '73.103979', 40);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '1',
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `status`, `register_date`, `image`) VALUES
(1, 'Admin', 'admin@gmail.com', 'a9442b8ff9cd7e8520afa3253d23a3a0', 1, '2018-09-01 01:58:48', 'Dummy-image.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_wallet`
--

DROP TABLE IF EXISTS `user_wallet`;
CREATE TABLE IF NOT EXISTS `user_wallet` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `mechanic_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `mechanic_id` (`mechanic_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_wallet`
--

INSERT INTO `user_wallet` (`id`, `user_id`, `price`, `status`, `mechanic_id`, `customer_id`, `date`) VALUES
(9, NULL, 900, NULL, 6, 14, '2018-09-17 08:58:09'),
(8, NULL, 1380, NULL, 6, 14, '2018-09-17 08:54:56'),
(7, NULL, 300, NULL, 8, 14, '2018-09-13 09:46:49');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
