-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2017 at 08:06 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopig`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_name`, `status`) VALUES
(1, 'Food', 1),
(2, 'Clothing', 1),
(3, 'Electronics', 1),
(4, 'Drugs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `cus_id` varchar(20) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `phone`, `cus_id`, `date`) VALUES
(1, 'Muhammed Abdullahi', '09080474933', 'CUS11222335', '2017-06-14 06:27:49'),
(2, 'Abuibakar Abdulsalam', '08076538593', 'CUS50986403', '2017-06-14 11:02:59'),
(3, 'Abdullahi', '08076538593', 'CUS16954280', '2017-06-14 11:33:27'),
(4, 'Asamau Ibrahi', '08076538593', 'CUS26214166', '2017-06-14 11:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `item_store`
--

CREATE TABLE `item_store` (
  `id` int(8) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `bPrice` double(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_store`
--

INSERT INTO `item_store` (`id`, `cat_id`, `pro_name`, `code`, `bPrice`, `quantity`, `description`, `image`, `price`, `status`) VALUES
(1, 1, 'Spaghetti', 'sp61029661', 150.00, 95, 'Food item , carbonhydrate', '', 180.00, 1),
(2, 3, 'Samsung Galaxy S6 edge', 'sm32675779', 240000.00, 46, 'Samsung smart phone ... very high feautures', '', 260000.00, 1),
(3, 4, 'Tramadol Capsole', 'tr47607054', 20.00, 146, 'pain relief drug', '', 30.00, 1),
(4, 2, 'Sneekers(Adidas)', 'sn88620854', 5000.00, 39, 'Adidas sneekers cover shoe, very durable', '', 6500.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `item_code` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `s_quantity` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `amount_in` double(10,2) NOT NULL,
  `all_amount` double(10,2) NOT NULL,
  `cus_code` varchar(20) NOT NULL,
  `gain` decimal(3,2) NOT NULL,
  `sell_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `item_code`, `user_id`, `s_quantity`, `price`, `amount_in`, `all_amount`, `cus_code`, `gain`, `sell_date`, `status`) VALUES
(1, 'sm32675779', 2, 3, 260000.00, 780000.00, 0.00, 'CUS11222335', '0.00', '2017-06-14 06:45:07', 1),
(2, 'sp61029661', 2, 4, 180.00, 720.00, 0.00, 'CUS11222335', '0.00', '2017-06-14 06:45:07', 1),
(3, 'sn88620854', 2, 1, 6500.00, 6500.00, 0.00, 'CUS50986403', '0.00', '2017-06-14 11:18:08', 1),
(4, 'tr47607054', 2, 1, 30.00, 30.00, 0.00, 'CUS50986403', '0.00', '2017-06-14 11:19:22', 1),
(5, 'tr47607054', 2, 1, 30.00, 30.00, 0.00, 'CUS50986403', '0.00', '2017-06-14 11:20:13', 1),
(6, 'sm32675779', 2, 1, 260000.00, 260000.00, 0.00, 'CUS16954280', '0.00', '2017-06-14 11:33:36', 1),
(7, 'sp61029661', 2, 1, 180.00, 180.00, 0.00, 'CUS26214166', '0.00', '2017-06-14 11:41:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `u_name` varchar(200) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `address` text NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(30) NOT NULL,
  `type` varchar(40) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `u_name`, `phone`, `address`, `username`, `password`, `type`, `status`) VALUES
(1, 'Fatima Adamu', '08168346442', 'kurmin mashi Kaduna', 'teema', 'teema12', 'admin', 1),
(2, 'Phateema Adamu', '08064875435', 'no 234 Kurmin mashi Kaduna', 'phatee', 'phatee12', 'user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_store`
--
ALTER TABLE `item_store`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`code`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `item_store`
--
ALTER TABLE `item_store`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
