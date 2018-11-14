-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 14, 2018 at 05:29 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `eleme`
--

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `restaurant_name` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `server_utc` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `limitation` varchar(100) NOT NULL,
  `image_path` varchar(200) DEFAULT NULL,
  `rating_count` int(11) NOT NULL,
  `specifications` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `pinyin_name` varchar(1000) NOT NULL,
  `month_sales` int(11) NOT NULL,
  `satisfy_count` int(11) NOT NULL,
  `price` float NOT NULL,
  `specfoods` varchar(1000) NOT NULL,
  `display_times` varchar(1000) NOT NULL,
  `activity` varchar(1000) DEFAULT NULL,
  `satisfy_rate` int(11) NOT NULL,
  `attributes` varchar(1000) NOT NULL,
  `tips` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `restaurant_name` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `activity` varchar(2000) DEFAULT NULL,
  `is_activity` tinyint(1) NOT NULL DEFAULT '0',
  `is_selected` tinyint(1) NOT NULL,
  `icon_url` varchar(200) NOT NULL,
  `type` int(11) NOT NULL,
  `id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `activities` varchar(4000) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `delivery_mode` varchar(2000) DEFAULT NULL,
  `bidding` varchar(4000) DEFAULT NULL,
  `description` varchar(1000) NOT NULL,
  `distance` int(11) NOT NULL,
  `float_delivery_fee` int(11) NOT NULL,
  `float_minimum_order_amount` int(11) NOT NULL,
  `image_path` varchar(200) NOT NULL,
  `is_new` tinyint(1) NOT NULL,
  `is_premium` tinyint(1) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `next_business_time` varchar(50) NOT NULL,
  `only_use_poi` tinyint(1) NOT NULL,
  `opening_hours` varchar(100) NOT NULL,
  `order_lead_time` int(11) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `piecewise_agent_fee` varchar(2000) NOT NULL,
  `promotion_info` varchar(1000) NOT NULL,
  `rating` varchar(20) NOT NULL,
  `rating_count` int(11) NOT NULL,
  `recent_order_num` int(11) NOT NULL,
  `rankType` int(11) DEFAULT NULL,
  `rankType_reason` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `supports` varchar(1000) NOT NULL,
  `closing_count_down` varchar(1000) DEFAULT NULL,
  `regular_customer_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT;
