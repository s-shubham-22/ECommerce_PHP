-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 04:10 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `sno` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(11) NOT NULL,
  `cname` varchar(80) NOT NULL,
  `slug` varchar(80) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `edited_by` int(11) NOT NULL,
  `edited_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `cname`, `slug`, `created_by`, `created_at`, `edited_by`, `edited_at`) VALUES
(16, 'Mouse', 'mouse', 17, '2022-05-25 14:02:59', 17, '2022-05-25 14:02:59'),
(17, 'Keyboard', 'keyboard', 17, '2022-05-25 14:03:08', 17, '2022-05-25 14:03:08');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `city_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`country_id`, `state_id`, `city_id`, `city_name`) VALUES
(12, 2, 23, 'Rajkot'),
(12, 2, 24, 'Anand'),
(12, 3, 13, 'Mehrauli'),
(12, 3, 15, 'Shergarh'),
(12, 5, 14, 'Kochi'),
(12, 5, 16, 'Kannur'),
(14, 3, 23, 'Hachiōji'),
(14, 3, 24, 'Machida'),
(14, 4, 13, 'Kyoto'),
(14, 6, 12, 'Kobe'),
(15, 2, 32, 'Buffalo '),
(15, 3, 21, 'Melbourne'),
(23, 2, 13, 'Liverpool');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(12, 'India'),
(14, 'Japan'),
(15, 'United States'),
(23, 'United Kingdom');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oid` int(11) NOT NULL,
  `sno` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `mobile` int(10) NOT NULL,
  `baddress` text NOT NULL,
  `saddress` text NOT NULL,
  `country` varchar(80) NOT NULL,
  `state` varchar(80) NOT NULL,
  `city` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oid`, `sno`, `name`, `email`, `mobile`, `baddress`, `saddress`, `country`, `state`, `city`) VALUES
(1, 17, 'Shubham Sareliya', 'abc@xyz.com', 1235456798, 'asdasd', 'saffdgdfg', '12', '2', '23'),
(2, 17, 'Shubham Sareliya', '20ce123@charusat.edu.in', 1235456798, 'xzcs', 'wqeqwe', '12', '2', '23');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `oid` int(11) NOT NULL,
  `sno` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`oid`, `sno`, `pid`, `price`, `quantity`, `status`) VALUES
(1, 17, 40, 399, 1, 1),
(1, 17, 41, 499, 2, 1),
(1, 17, 42, 759, 1, 1),
(1, 17, 43, 1049, 3, 1),
(2, 17, 40, 399, 1, 0),
(2, 17, 42, 759, 1, 1),
(2, 17, 43, 1049, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(11) NOT NULL,
  `pname` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `cid` int(11) NOT NULL,
  `img_name` varchar(80) NOT NULL,
  `price` double NOT NULL,
  `stock` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `pname`, `slug`, `cid`, `img_name`, `price`, `stock`, `added_by`, `added_at`, `updated_by`, `updated_at`, `description`) VALUES
(40, 'Red Gear Mouse 1', 'red-gear-mouse-1', 16, 'product628e1b2c3b1e22.64905556.jpg', 399, 10, 17, '2022-05-25 14:03:56', 17, '2022-05-25 14:03:56', 'This is red Gear Mouse 1'),
(41, 'Red Gear Mouse 2', 'red-gear-mouse-2', 16, 'product628e1b4396a052.53403752.jpg', 499, 21, 17, '2022-05-25 14:04:19', 17, '2022-05-25 14:04:19', 'This is Red Gear Mouse 2'),
(42, 'Red Gear Keyboard 1', 'red-gear-keyboard-1', 17, 'product628e1b5ea83584.10886574.jpg', 759, 15, 17, '2022-05-25 14:04:46', 17, '2022-05-25 14:07:13', 'This is Red Gear Keyboard 1'),
(43, 'Red Gear Keyboard 2', 'red-gear-keyboard-2', 17, 'product628e1b7fccd386.89704247.jpg', 1049, 12, 17, '2022-05-25 14:05:19', 17, '2022-05-25 14:05:19', 'This is Red Gear Keyboard 2');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `state_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`country_id`, `state_id`, `state_name`) VALUES
(12, 2, 'Gujarat'),
(12, 3, 'Delhi'),
(12, 5, 'Kerala'),
(14, 3, 'Tokyo'),
(14, 4, 'Kyoto'),
(14, 6, 'Osaka'),
(15, 2, 'New York'),
(15, 3, 'Florida'),
(23, 2, 'London');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sno` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fname` varchar(80) NOT NULL,
  `lname` varchar(80) NOT NULL,
  `mobile` int(10) NOT NULL,
  `email` varchar(80) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(400) NOT NULL,
  `password` varchar(255) NOT NULL,
  `join_date` datetime NOT NULL DEFAULT current_timestamp(),
  `lastlogin` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sno`, `username`, `fname`, `lname`, `mobile`, `email`, `gender`, `address`, `password`, `join_date`, `lastlogin`) VALUES
(17, 'admin', 'Shubham', 'Sareliya', 1235456798, 'abc@xyz.com', 'male', 'Address,\r\nCity,\r\nState.', '$2y$10$o9dCgAGcA1kHmHWZNUY3VO6BQ7YWTu5ROX9.7Q5r2.eFrS8GsOEpW', '2022-05-25 17:32:47', '2022-05-27 11:39:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`country_id`,`state_id`,`city_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`oid`,`sno`,`pid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`country_id`,`state_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
