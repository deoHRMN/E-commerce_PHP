-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2023 at 11:24 AM
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
-- Database: `estorephp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminID` int(6) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminID`, `username`, `email`, `password`, `firstName`, `lastName`) VALUES
(1, 'harmandeo', 'harmanpaldeo@gmail.com', '$2y$10$U/F5ey8OzpsCjhOgqyeGxOI8ToyAPKT8RNCXUdR3p/CoYjvSLel9e', 'Harmanpreet', 'Deo'),
(2, 'Jashan', 'jashan2903@gmail.com', '$2y$10$WhWNWJD0yiT5XZ12psoLT.JUuGupABCiuyS.QWjZCU68BNO2mOYLO', 'Jashanpreet', 'Deo'),
(6, 'HarmanSinghDeo', 'harmansinghdeo@gmail.com', '$2y$10$FI1TgE.hTXE1jMYWl9k35u9YMIu5NY.xiChePW0j1rpPExH.vlW9G', 'Harman', 'Singh');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `productID` int(11) NOT NULL,
  `userID` int(6) NOT NULL,
  `ipAddress` varchar(255) NOT NULL,
  `quantity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(4) NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `name`, `description`) VALUES
(9, 'Headset', 'Gaming headset with support for 7.1 surround sound. Over ear headphones.'),
(12, 'Keyboards', 'Mechanical keyboards of varying size suitable for prolonged typing and gaming.'),
(16, 'controllers', ' gaming controllers from popular brands. Dual shock and custom made as well.'),
(17, 'Mouse', 'Gaming Mouse with ergonomic design.'),
(21, 'Processors', 'Powerful overclocked processors.'),
(22, 'Cooling pads', 'Cooling surfaces for laptops with integrated fans.'),
(31, 'Bluetooth Speakers', ' standard output devices used with computer systems that enable the listener to listen to a sound as an outcome. Support Bluetooth.');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `orderID` int(11) NOT NULL,
  `productID` int(6) NOT NULL,
  `quantity` int(4) NOT NULL,
  `itemPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`orderID`, `productID`, `quantity`, `itemPrice`) VALUES
(16, 11, 1, 479.99),
(17, 13, 1, 219.00),
(17, 12, 1, 74.99),
(17, 9, 1, 42.99),
(20, 18, 3, 38.97);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `categoryID` int(4) NOT NULL,
  `quantity` int(4) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `productImage` varchar(255) NOT NULL,
  `addedOn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `name`, `description`, `categoryID`, `quantity`, `price`, `productImage`, `addedOn`) VALUES
(7, 'Razer BlackShark V2 X', 'Gaming Headset with Microphone - Black/Green', 9, 20, 49.99, 'blacksharkv2x.jpg', '2023-12-01 19:48:05'),
(9, 'Targus Lap Chill Cooling Mat', 'The Targus Lap Chill Mat will keep your lap and your laptop cool for work and play. It\'s designed for laptops with screen sizes up to 17 inches, and uses dual fans to keep it all cool. The USB-powered design makes it truly transportable, while a soft neoprene construction makes it comfortable to use. autocomplete=', 22, 30, 42.99, 'coolingpad.jpg', '2023-12-04 06:17:04'),
(10, 'SteelSeries Apex 3 TKL', 'Backlit Mechanical Tactile Gaming Keyboard - English autocomplete=', 12, 25, 59.99, 'steelseriesKeyboard.jpg', '2023-12-04 06:17:25'),
(11, 'AMD Ryzen 7 7800X3D', 'Whether you are a professional gamer or a passionate content creator, the AMD Ryzen 7 7800X3D processor boosts the performance of your desktop to meet your needs. It operates at 4GHz speed (5GHz at boosted speed) to run high-end games and applications faster and smoother. With a total of 8 cores and 16 threads, it can perform multiple processes at once without lagging.', 21, 13, 479.99, 'ryzen7.jpg', '2023-12-01 19:52:46'),
(12, 'PlayStation 4 DUALSHOCK 4 Wireless Controller', 'Sony\'s DUALSHOCK 4 wireless controller design features an ergonomic grip, enhanced sensitivity on the trigger buttons and analog sticks for increased accuracy, a programmed Share button and a touchpad to offer gamers a precision tool with modern capabilities for the ultimate gaming experience.', 16, 15, 74.99, 'playstation4 controller.jpg', '2023-12-01 20:17:51'),
(13, 'Logitech Mouse G Pro Light', 'Lightspeed Wireless Gaming Mouse, Lightweight, LIGHTFORCE Hybrid Switches, Hero 2 Sensor, 32,000 DPI, 5 Programmable Buttons, USB-C Charging, PC & Mac - Black', 17, 28, 219.00, 'gpro.webp', '2023-12-01 20:49:41'),
(18, 'Klipsch R101SW 10', 'Upgrade your music-listening setup or home theatre system with the Klipsch R101SW subwoofer. This 300-watt subwoofer uses state-of-the-art technology, to produce detailed, powerful sound. Its sleek cabinet design makes it a great addition to any living space.', 31, 3, 13.99, 'download.webp', '2023-12-08 10:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `statusCode` int(2) NOT NULL,
  `statusName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`statusCode`, `statusName`) VALUES
(1, 'confirmed'),
(2, 'delivered'),
(3, 'cancelled'),
(4, 'shipped');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(6) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(25) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(25) NOT NULL,
  `zipcode` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `email`, `password`, `street`, `city`, `state`, `country`, `zipcode`) VALUES
(12, 'Harman', 'harman@gmail.com', '$2y$10$asnAzgyCosIEAZUgAXHvaeNKdoim0Z/v5bmpLyjICat6ncyZ3u5Le', 'Main Drive 123', 'Surrey', 'BC', 'USA', 'V3Dklo'),
(14, 'Jashanpreet', 'jashanpreet@gmail.com', '$2y$10$mn/IKPBLhJXythbfcDj9P.Dkk/IsC9PR2DaTyhjaQiXEVKDCv.t/y', '787 Alder Grove', 'Surrey', 'British Columbia', 'Canada', 'KJL567'),
(15, 'Harmanpreet', 'harman@yahoo.com', '$2y$10$ZAzx9zkQuWOKQfOt.NrexOV5Oo8ofdxYPCqj8yPVQg5zTy1XlN4RK', 'harman', 'harman', 'harman', 'harman', 'harman'),
(17, 'Dexter', 'dexterfrominfo@gmail.com', '$2y$10$5Xrki54jnJllOe7o/2gFNOC/nr4/9e6HUwUQYt29Z99.CPqHiSjCa', '332 Progress Way', 'Abbotsford', 'British Columbia', 'Canada', 'V3X 0E'),
(18, 'abc', 'abc@gmail.com', '$2y$10$9u0uIplqgA0gb9cVmwB9n.gqgKo3GwGlYEGPe9ISVqfS/Sy8xwcZi', 'abc', 'abc', 'bac', 'bax', 'cbnmnb'),
(19, 'HRMN', 'hrmn@gmail.com', '$2y$10$95HFx.zHuHImKTyvmYsc.ejXDYVZLE3oFH8uI0EK1kbfTz6ZNiK5O', '334 main drive', 'surrey', 'british columbia', 'canada', 'vbn678');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `orderID` int(11) NOT NULL,
  `userID` int(6) NOT NULL,
  `totalAmount` decimal(10,2) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `statusCode` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`orderID`, `userID`, `totalAmount`, `orderDate`, `statusCode`) VALUES
(16, 18, 479.99, '2023-12-08 09:29:34', 3),
(17, 18, 336.98, '2023-12-08 09:24:15', 1),
(20, 19, 38.97, '2023-12-08 10:20:44', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD KEY `OrderProducts` (`orderID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`statusCode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `orderStatus` (`statusCode`),
  ADD KEY `orderUser` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adminID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `statusCode` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `OrderProducts` FOREIGN KEY (`orderID`) REFERENCES `user_orders` (`orderID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `categoryID` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`) ON UPDATE CASCADE;

--
-- Constraints for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD CONSTRAINT `orderStatus` FOREIGN KEY (`statusCode`) REFERENCES `status` (`statusCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orderUser` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
