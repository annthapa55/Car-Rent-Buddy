-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 28, 2023 at 12:07 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_rent_buddy`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned_car`
--

DROP TABLE IF EXISTS `assigned_car`;
CREATE TABLE IF NOT EXISTS `assigned_car` (
  `assignID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `userID` int NOT NULL,
  `carID` int NOT NULL,
  `rentDate` date DEFAULT NULL,
  `toBeReturnedDate` date DEFAULT NULL,
  `returnDate` date DEFAULT NULL,
  `totalCost` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`assignID`),
  KEY `userID` (`userID`),
  KEY `carID` (`carID`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `assigned_car`
--

INSERT INTO `assigned_car` (`assignID`, `userID`, `carID`, `rentDate`, `toBeReturnedDate`, `returnDate`, `totalCost`) VALUES
(20, 21, 11, '2023-05-27', '2023-05-27', NULL, '80.00'),
(19, 21, 11, '2023-05-28', '2023-06-04', '2023-06-09', '560.00'),
(21, 19, 2, '2023-05-28', '2023-05-29', '2023-05-31', '130.50');

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

DROP TABLE IF EXISTS `car`;
CREATE TABLE IF NOT EXISTS `car` (
  `carID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `carPlateNo` varchar(30) NOT NULL,
  `carModel` varchar(30) NOT NULL,
  `carType` varchar(50) NOT NULL,
  `carStatusID` int NOT NULL,
  `carCostPerDay` decimal(5,2) NOT NULL,
  PRIMARY KEY (`carID`),
  KEY `carStatusID` (`carStatusID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`carID`, `carPlateNo`, `carModel`, `carType`, `carStatusID`, `carCostPerDay`) VALUES
(1, 'DD2DU6', 'Toyota Camry', 'Sedan', 1, '82.00'),
(2, 'AB063D', 'Toyota Tacoma', 'Ute', 2, '130.50'),
(3, 'AB934K', 'Mitsubishi Outlander', 'SUV', 2, '115.40'),
(4, 'CD803K', 'BMW 3 Series', 'Wagon ', 2, '250.00'),
(5, 'KK064C', 'Subaru Impreza', 'Hatch', 1, '50.00'),
(6, 'CS069L', 'Mazda MX-5', 'Convertible', 3, '100.00'),
(7, 'FG369W', 'Subaru Outback', 'SUV', 3, '90.00'),
(8, 'AA06ND', 'Toyota Camry', 'Sedan', 1, '85.00'),
(9, 'DD2DU7', 'Toyota Tacoma', 'Ute', 1, '130.00'),
(10, 'DD2DU4', 'Toyota Camry', 'Sedan', 2, '85.00'),
(11, 'TTY0CMA', 'Toyota Tacoma Pro', 'Ute ', 1, '80.00'),
(12, 'DD2DL7', 'Toyota Camry', 'Sedan', 1, '85.00');

-- --------------------------------------------------------

--
-- Table structure for table `car_status`
--

DROP TABLE IF EXISTS `car_status`;
CREATE TABLE IF NOT EXISTS `car_status` (
  `statusID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `statusName` varchar(30) NOT NULL,
  PRIMARY KEY (`statusID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `car_status`
--

INSERT INTO `car_status` (`statusID`, `statusName`) VALUES
(1, 'Rented'),
(2, 'Available to rent'),
(3, 'Not available to rent');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `userPassword` varchar(50) NOT NULL,
  `userTypeID` int NOT NULL,
  PRIMARY KEY (`userID`),
  KEY `userTypeID` (`userTypeID`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `firstName`, `lastName`, `phone`, `email`, `userPassword`, `userTypeID`) VALUES
(17, 'Annu', 'Thapa', '0487207386', 'annu.thapa55@gmail.com', 'e694aa37abf20c91a442da4841aeccdf', 1),
(18, 'Kushal', 'Khanal', '0487207386', 'kushal.khanal@gmail.com', 'bbddbd575d47c5d8a629979213e34add', 1),
(19, 'Annu', 'Thapa', '0487207386', 'ann.thapa55@gmail.com', 'bbddbd575d47c5d8a629979213e34add', 2),
(20, 'Kushal', 'Khanal', '0487207386', 'kushal.khanal@gmail.com', 'd55930f03965659da7442e54ee12f1d8', 1),
(21, 'Kushal', 'Khanal', '0487207386', 'kushal.khanal@gmail.com', '78f2f2ff84dcdc2f8920c9a67b6378ff', 2),
(22, 'Anup', 'Thapa', '0487207386', 'anup.thapa182@gmail.com', '297b505760697aa6fd379616b0c2be62', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `userTypeID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `userType` varchar(30) NOT NULL,
  PRIMARY KEY (`userTypeID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`userTypeID`, `userType`) VALUES
(1, 'Administrator'),
(2, 'Renter');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
