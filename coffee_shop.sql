-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2025 at 09:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffee_shop`
--
CREATE DATABASE IF NOT EXISTS `coffee_shop` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `coffee_shop`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coffeebeans`
--

DROP TABLE IF EXISTS `coffeebeans`;
CREATE TABLE `coffeebeans` (
  `coffeeBeans_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `goods_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `Coffee` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`goods_id`, `name`, `description`, `price`, `quantity`, `Coffee`, `img`) VALUES
(16, 'Espresso', 'Concentrated, bold coffee shot brewed under pressure, delivering intense flavor and rich crema perfect as a base drink.', 65.00, 100, 'yes', '3.jpg'),
(17, 'Coffee Latte', 'Smooth chilled espresso combined with milk, creating a creamy, refreshing drink ideal for warm days.', 85.00, 100, 'yes', '2.jpg'),
(18, 'Caramel Macchiato', 'Sweet cold drink layering milk, espresso, and caramel sauce for a delightful blend of flavors and textures.', 85.00, 100, 'yes', '1.jpg'),
(19, 'Iced Americano', 'Refreshing beverage made from diluted espresso and cold water over ice, offering bold flavor without heaviness.', 85.00, 100, 'yes', '4.jpg'),
(20, 'Green Tea Frappe', 'Chilled green tea blend with ice and milk, offering a refreshing, light flavor for tea lovers.', 85.00, 100, 'no', '5.jpg'),
(21, 'Panda Cocoa', 'Iced cocoa topped with fluffy milk foam and cocoa powder panda face, combining fun presentation with rich chocolate flavor.', 75.00, 100, 'no', '6.jpg'),
(22, 'White Malt Ship', 'Creamy malt beverage combining white chocolate and malt flavors for a sweet, comforting drink experience.', 75.00, 100, 'no', '8.jpg'),
(23, 'Iced Chocolate', 'Rich iced chocolate drink made from syrup, cold milk, and ice, providing a decadent treat for chocolate lovers.', 75.00, 100, 'no', '7.jpg'),
(24, 'Muffin', 'Soft, fluffy muffin available in various flavors, perfect for a quick snack or breakfast alongside your coffee.', 60.00, 100, 'des', '11.jpg'),
(25, 'Bacon Omelet Puff', 'Savory pastry filled with fluffy eggs and crispy bacon, offering a hearty and satisfying snack option.', 120.00, 100, 'des', '21.jpg'),
(26, 'Brownie', 'Rich, fudgy brownie with deep chocolate flavor, providing a deliciously sweet indulgence for dessert lovers.', 120.00, 100, 'des', '10.jpg'),
(34, 'Espresso', 'Bold, rich dark roast with deep chocolate and caramel notes, ideal for intense espresso shots and beverages.', 300.00, 100, 'bean', '20.jpg'),
(35, 'Maple Pecan', 'Flavored coffee blending sweet maple and nutty pecan, offering a warm, inviting aroma and comforting medium roast.', 300.00, 100, 'bean', '19.jpg'),
(36, 'Pike Place Roast', 'Classic medium roast with balanced flavors of chocolate and toasted nuts, perfect for any time of day.', 300.00, 100, 'bean', '18.jpg'),
(37, 'Caramel', 'Concentrated, bold coffee shot brewed under pressure, delivering intense flavor and rich crema—perfect as a base drink.', 300.00, 100, 'bean', '17.jpg'),
(38, 'Classic Black & White Mug ', 'Timeless design with a sleek black exterior and white interior, perfect for coffee or tea lovers.', 190.00, 100, 'mug', '12.jpg'),
(39, 'Tumbler Small Mug', 'Compact and stylish, this small tumbler keeps drinks hot or cold, ideal for on-the-go sipping.', 350.00, 100, 'mug', '13.jpg'),
(40, 'Black Tumbler', 'Elegant black tumbler with double-wall insulation, perfect for maintaining temperature, suitable for home or travel.', 650.00, 100, 'mug', '14.jpg'),
(41, 'Sakura Chan Tumbler', 'Charming tumbler featuring delicate cherry blossoms, perfect for enjoying beverages while adding a whimsical touch to your day.', 750.00, 100, 'mug', '15.jpg'),
(42, 'Bagel', 'Freshly baked bagel with a chewy texture, available in various flavors—perfect for breakfast or a quick snack.', 120.00, 100, 'des', '9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `Coffee` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `name`, `description`, `price`, `quantity`, `Coffee`, `img`) VALUES
(16, 'Espresso', 'Concentrated, bold coffee shot brewed under pressure, delivering intense flavor and rich crema—perfect as a base drink. 65', 65.00, 100, 'yes', '3.jpg'),
(17, 'Coffee Latte', 'Smooth chilled espresso combined with milk, creating a creamy, refreshing drink ideal for warm days.', 85.00, 100, 'yes', '2.jpg'),
(18, 'Caramel Macchiato', 'Sweet cold drink layering milk, espresso, and caramel sauce for a delightful blend of flavors and textures.', 85.00, 100, 'yes', '1.jpg'),
(19, 'Iced Americano', 'Refreshing beverage made from diluted espresso and cold water over ice, offering bold flavor without heaviness.', 85.00, 100, 'yes', '4.jpg'),
(20, 'Green Tea Frappe', 'Chilled green tea blend with ice and milk, offering a refreshing, light flavor for tea lovers.', 85.00, 100, 'no', '5.jpg'),
(21, 'Panda Cocoa', 'Iced cocoa topped with fluffy milk foam and cocoa powder panda face, combining fun presentation with rich chocolate flavor.', 75.00, 100, 'no', '6.jpg'),
(22, 'White Malt Ship', 'Creamy malt beverage combining white chocolate and malt flavors for a sweet, comforting drink experience.', 75.00, 100, 'no', '8.jpg'),
(23, 'Iced Chocolate', 'Rich iced chocolate drink made from syrup, cold milk, and ice, providing a decadent treat for chocolate lovers.', 75.00, 100, 'no', '7.jpg'),
(24, 'Muffin', 'Soft, fluffy muffin available in various flavors, perfect for a quick snack or breakfast alongside your coffee.', 60.00, 100, 'des', '11.jpg'),
(25, 'Bacon Omelet Puff', 'Savory pastry filled with fluffy eggs and crispy bacon, offering a hearty and satisfying snack option.', 120.00, 100, 'des', '21.jpg'),
(26, 'Brownie', 'Rich, fudgy brownie with deep chocolate flavor, providing a deliciously sweet indulgence for dessert lovers.', 120.00, 100, 'des', '10.jpg'),
(27, 'Bagel', 'Freshly baked bagel with a chewy texture, available in various flavors—perfect for breakfast or a quick snack.', 120.00, 100, 'des', '9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mugs`
--

DROP TABLE IF EXISTS `mugs`;
CREATE TABLE `mugs` (
  `mugs_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ordernow`
--

DROP TABLE IF EXISTS `ordernow`;
CREATE TABLE `ordernow` (
  `orer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `role` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `firstname`, `lastname`, `role`) VALUES
(1, 'william', '1234', 'William', 'Carter', 'users'),
(2, 'eliza007', '1234', 'Elizabeth', 'Bennett', 'users'),
(3, 'jamessy', '1234', 'James', 'Harrison', 'admin'),
(4, 'charty', '1234', 'Charlotte', 'Graham', 'admin'),
(5, 'henryeiei', '1234', 'Henry', 'Fletcher', 'users'),
(6, 'natthar', '1234', 'Natthara', 'Wilimphodchaphonkul', 'users');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `coffeebeans`
--
ALTER TABLE `coffeebeans`
  ADD PRIMARY KEY (`coffeeBeans_id`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`goods_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `mugs`
--
ALTER TABLE `mugs`
  ADD PRIMARY KEY (`mugs_id`);

--
-- Indexes for table `ordernow`
--
ALTER TABLE `ordernow`
  ADD PRIMARY KEY (`orer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `coffeebeans`
--
ALTER TABLE `coffeebeans`
  MODIFY `coffeeBeans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `goods_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `mugs`
--
ALTER TABLE `mugs`
  MODIFY `mugs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ordernow`
--
ALTER TABLE `ordernow`
  MODIFY `orer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
