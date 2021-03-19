-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2020 at 05:43 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lastone`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `category_sales`
-- (See below for the actual view)
--
CREATE TABLE `category_sales` (
`str_id` int(11)
,`catid` int(11)
,`sales` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `contains`
--

CREATE TABLE `contains` (
  `p_id` int(11) NOT NULL,
  `d_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cust_id` int(11) NOT NULL,
  `pieces` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `card_id` int(11) NOT NULL,
  `full_name` varchar(80) NOT NULL,
  `birth_date` text NOT NULL,
  `age` int(4) NOT NULL,
  `family_status` varchar(255) NOT NULL,
  `pet` varchar(50) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `card_points` varchar(30) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(25) NOT NULL,
  `postal_code` int(10) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `custs`
-- (See below for the actual view)
--
CREATE TABLE `custs` (
`card_id` int(11)
,`full_name` varchar(80)
,`birth_date` text
,`age` int(4)
,`family_status` varchar(255)
,`pet` varchar(50)
,`gender` varchar(255)
,`email` varchar(100)
,`card_points` varchar(30)
,`address` varchar(100)
,`city` varchar(25)
,`postal_code` int(10)
,`phone` varchar(15)
);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `s_id` int(11) NOT NULL,
  `bcode` int(11) NOT NULL,
  `alley_shelf` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `old_price`
--

CREATE TABLE `old_price` (
  `prodd_id` int(11) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `price` float DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `price` varchar(50) NOT NULL,
  `first_transaction` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `provides`
--

CREATE TABLE `provides` (
  `storelmao_id` int(11) NOT NULL,
  `categorylmao_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `working_hours` varchar(12) NOT NULL,
  `square_meters` int(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(55) NOT NULL,
  `postal_code` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `store_phone`
--

CREATE TABLE `store_phone` (
  `phone` decimal(10,0) NOT NULL,
  `storee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cust_id` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `total_amount` int(4) NOT NULL,
  `total_pieces` int(4) NOT NULL,
  `str_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure for view `category_sales`
--
DROP TABLE IF EXISTS `category_sales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `category_sales`  AS  select distinct `transaction`.`str_id` AS `str_id`,`k`.`catid` AS `catid`,count(0) AS `sales` from (`transaction` join (select `contains`.`d_time` AS `day`,`contains`.`cust_id` AS `custid`,`product`.`category_id` AS `catid` from (`contains` join `product`) where `product`.`product_id` = `contains`.`p_id`) `k`) where `k`.`day` = `transaction`.`date_time` and `k`.`custid` = `transaction`.`cust_id` group by `transaction`.`str_id`,`k`.`catid` ;

-- --------------------------------------------------------

--
-- Structure for view `custs`
--
DROP TABLE IF EXISTS `custs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `custs`  AS  select `customer`.`card_id` AS `card_id`,`customer`.`full_name` AS `full_name`,`customer`.`birth_date` AS `birth_date`,`customer`.`age` AS `age`,`customer`.`family_status` AS `family_status`,`customer`.`pet` AS `pet`,`customer`.`gender` AS `gender`,`customer`.`email` AS `email`,`customer`.`card_points` AS `card_points`,`customer`.`address` AS `address`,`customer`.`city` AS `city`,`customer`.`postal_code` AS `postal_code`,`customer`.`phone` AS `phone` from `customer` order by `customer`.`card_id` desc ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contains`
--
ALTER TABLE `contains`
  ADD PRIMARY KEY (`p_id`,`cust_id`,`d_time`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `d_time` (`d_time`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `Customer_full_name_idx` (`card_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`bcode`,`s_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `old_price`
--
ALTER TABLE `old_price`
  ADD PRIMARY KEY (`prodd_id`,`start_date`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_label_idx` (`brand_name`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `provides`
--
ALTER TABLE `provides`
  ADD PRIMARY KEY (`storelmao_id`,`categorylmao_id`),
  ADD KEY `categorylmao_id` (`categorylmao_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `store_phone`
--
ALTER TABLE `store_phone`
  ADD PRIMARY KEY (`phone`,`storee_id`),
  ADD KEY `store_phone_ibfk_1` (`storee_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`date_time`,`cust_id`),
  ADD KEY `transaction_ibfk_1` (`cust_id`),
  ADD KEY `transaction_ibfk_2` (`str_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contains`
--
ALTER TABLE `contains`
  ADD CONSTRAINT `contains_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contains_ibfk_2` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`card_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contains_ibfk_3` FOREIGN KEY (`d_time`) REFERENCES `transaction` (`date_time`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`bcode`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offers_ibfk_2` FOREIGN KEY (`s_id`) REFERENCES `store` (`store_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `old_price`
--
ALTER TABLE `old_price`
  ADD CONSTRAINT `old_price_ibfk_1` FOREIGN KEY (`prodd_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `provides`
--
ALTER TABLE `provides`
  ADD CONSTRAINT `provides_ibfk_1` FOREIGN KEY (`storelmao_id`) REFERENCES `store` (`store_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `provides_ibfk_2` FOREIGN KEY (`categorylmao_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `store_phone`
--
ALTER TABLE `store_phone`
  ADD CONSTRAINT `store_phone_ibfk_1` FOREIGN KEY (`storee_id`) REFERENCES `store` (`store_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`card_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`str_id`) REFERENCES `store` (`store_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
