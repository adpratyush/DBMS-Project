-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 10, 2024 at 09:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bike_showroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_username` varchar(20) NOT NULL,
  `f_name` varchar(20) DEFAULT NULL,
  `l_name` varchar(20) DEFAULT NULL,
  `a_phone` bigint(12) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `a_dob` date DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_username`, `f_name`, `l_name`, `a_phone`, `email`, `a_dob`, `password`) VALUES
('admin', 'Priyansha', 'Adhikari', 123456, 'adpinsu@gmail.com', '2001-12-23', 'nepal123');

-- --------------------------------------------------------

--
-- Stand-in structure for view `bikedetails`
-- (See below for the actual view)
--
CREATE TABLE `bikedetails` (
`bike_photo` varchar(200)
,`bike_no` int(20)
,`type` varchar(20)
,`bike_name` varchar(20)
,`availability` varchar(20)
,`company` varchar(20)
,`price` int(20)
,`description` varchar(300)
,`cmp_name` varchar(20)
,`cmp_address` varchar(200)
);

-- --------------------------------------------------------

--
-- Table structure for table `bikes`
--

CREATE TABLE `bikes` (
  `bike_photo` varchar(200) DEFAULT NULL,
  `bike_no` int(20) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `bike_name` varchar(20) DEFAULT NULL,
  `availability` varchar(20) DEFAULT NULL,
  `company` varchar(20) DEFAULT NULL,
  `price` int(20) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bikes`
--

INSERT INTO `bikes` (`bike_photo`, `bike_no`, `type`, `bike_name`, `availability`, `company`, `price`, `description`) VALUES
('rebike.png', 44, 'Gear', 'Gt650', 'yes', 'Royal Enfield', 723456, 'gdfgfdsg'),
('gixxer.jpg', 54, 'Gear', 'Gixer', 'yes', 'Suzuki', 130004, 'dfgdg'),
('r1.jpeg', 123, 'Super', 'R1', 'yes', 'yamaha', 943232, 'fgfdsg'),
('fz.jpg', 432, 'Gear', 'Fz', 'yes', 'yamaha', 98764, 'dfddg'),
('pulsar.jpg', 4159, 'Gear', 'Pulsar', 'yes', 'Bajaj', 2000, 'dfadf');

--
-- Triggers `bikes`
--
DELIMITER $$
CREATE TRIGGER `add_bike` AFTER INSERT ON `bikes` FOR EACH ROW UPDATE company 
SET no_of_bikes =no_of_bikes+1
WHERE cmp_name = new.company
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `remove_bike` AFTER DELETE ON `bikes` FOR EACH ROW UPDATE company 
SET no_of_bikes = no_of_bikes-1
WHERE cmp_name = old.company
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `bike_name` varchar(100) DEFAULT NULL,
  `bike_number` varchar(20) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `booking_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `customer_name`, `bike_name`, `bike_number`, `price`, `booking_id`) VALUES
(8, 'adpratyush', 'Gixer', '54', 130004.00, '65e998d0dd99a'),
(9, 'adpratyush', 'R1', '123', 943232.00, '65e998d4a3a20'),
(10, 'pravin', 'R1', '123', 943232.00, '65e99934d9b34'),
(11, 'pravin', 'Pulsar', '4159', 2000.00, '65e99932481ea'),
(12, 'username1', 'Gt650', '44', 723456.00, '65ed6dc8e6c4b');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bike_photo` varchar(200) DEFAULT NULL,
  `c_username` varchar(20) DEFAULT NULL,
  `booking_id` varchar(20) NOT NULL,
  `bike_no` int(11) DEFAULT NULL,
  `bike_name` varchar(20) DEFAULT NULL,
  `final_price` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bike_photo`, `c_username`, `booking_id`, `bike_no`, `bike_name`, `final_price`) VALUES
('gixxer.jpg', 'adpratyush', '65e998d0dd99a', 54, 'Gixer', 130004),
('r1.jpeg', 'adpratyush', '65e998d4a3a20', 123, 'R1', 943232),
('pulsar.jpg', 'pravin', '65e99932481ea', 4159, 'Pulsar', 2000),
('r1.jpeg', 'pravin', '65e99934d9b34', 123, 'R1', 943232),
('rebike.png', 'username1', '65ed6dc8e6c4b', 44, 'Gt650', 723456);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `cmp_logo` varchar(200) DEFAULT NULL,
  `cmp_name` varchar(20) NOT NULL,
  `cmp_email` varchar(20) DEFAULT NULL,
  `no_of_bikes` int(200) DEFAULT 0,
  `cmp_address` varchar(200) DEFAULT NULL,
  `cmp_desc` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`cmp_logo`, `cmp_name`, `cmp_email`, `no_of_bikes`, `cmp_address`, `cmp_desc`) VALUES
('bajaj.jpg', 'bajaj', 'bajaj@gmail.com', 1, 'fdaf', 'dsafdfg'),
('honda.png', 'Honda', 'honda@gmail.com', 0, 'Dhading', 'gadsfd'),
('re.jpeg', 'Royal Enfield', 're@gmail.com', 1, 'kathmandu', 'nothing'),
('suzuki.jpg', 'Suzuki', 'suzuki@gmail.com', 1, 'Kathmandu', 'dfadf'),
('Yamaha.jpg', 'yamaha', 'no1heroat@gmail.com', 2, 'kundalhalli', 'gfdagdfag');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_username` varchar(20) NOT NULL,
  `f_name` varchar(20) DEFAULT NULL,
  `l_name` varchar(20) DEFAULT NULL,
  `c_phone` bigint(12) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `c_dob` date DEFAULT NULL,
  `c_password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_username`, `f_name`, `l_name`, `c_phone`, `email`, `c_dob`, `c_password`) VALUES
('adpratyush', 'Pratyush', 'Adhikari', 8161417390, 'no1heroat@gmail.com', '2001-12-23', 'nepal123'),
('pravin', 'Pravin', 'ADk', 43251, 'adpravin@gmail.com', '2001-12-12', '123456ab'),
('username1', 'John', 'Doe', 1234567890, 'john.doe@example.com', '1990-01-01', '1'),
('username2', 'Jane', 'Smith', 987654321, 'jane.smith@example.com', '1995-05-15', '2'),
('username3', 'Alice', 'Johnson', 5555555555, 'alice.johnson@example.com', '1988-12-10', '3'),
('username4', 'Bob', 'Brown', 6666666666, 'bob.brown@example.com', '1975-07-20', '4');

-- --------------------------------------------------------

--
-- Structure for view `bikedetails`
--
DROP TABLE IF EXISTS `bikedetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bikedetails`  AS SELECT `b`.`bike_photo` AS `bike_photo`, `b`.`bike_no` AS `bike_no`, `b`.`type` AS `type`, `b`.`bike_name` AS `bike_name`, `b`.`availability` AS `availability`, `b`.`company` AS `company`, `b`.`price` AS `price`, `b`.`description` AS `description`, `c`.`cmp_name` AS `cmp_name`, `c`.`cmp_address` AS `cmp_address` FROM (`bikes` `b` join `company` `c` on(`b`.`company` = `c`.`cmp_name`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_username`);

--
-- Indexes for table `bikes`
--
ALTER TABLE `bikes`
  ADD PRIMARY KEY (`bike_no`),
  ADD KEY `company` (`company`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `bills_ibfk_1` (`booking_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `c_username` (`c_username`),
  ADD KEY `bike_no` (`bike_no`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`cmp_name`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bikes`
--
ALTER TABLE `bikes`
  ADD CONSTRAINT `bikes_ibfk_1` FOREIGN KEY (`company`) REFERENCES `company` (`cmp_name`) ON DELETE CASCADE;

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`c_username`) REFERENCES `customer` (`c_username`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`bike_no`) REFERENCES `bikes` (`bike_no`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
