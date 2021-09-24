-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2021 at 02:56 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wg_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `add_by_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `created_at`, `updated_at`, `add_by_user`) VALUES
(1, 'HP Light weight Laptop', '40599', '<p><strong><em>HP 14 Ryzen 5 3500U<br />\r\n4-inch(35.6 cm)<br />\r\nFHD Thin &amp; Light<br />\r\nLaptop(8GB RAM/256GB SSD + 1TB HD/Windows 10/MS Office/Natural Silver/1.47 Kg),<br />\r\n14s-dk0501AU</em></strong></p>\r\n', '2021-09-24', '2021-09-24', 1),
(2, 'Study Table', '749', '<p>Ardith Multi-Purpose Laptop Desk for Study and Reading with Foldable Non-Slip Legs Reading Table Tray, Laptop Table, Laptop Stands, Laptop Desk, Foldable Study Laptop Table, Study Table (Cream)</p>\r\n', '2021-09-24', '2021-09-24', 1),
(3, 'Multipurpose Table', '1000', '<p>TABLE MAGIC Multipurpose Laptop Table Mat Finish Top PP Steel 53 * 40 * 73cm 6 Heights 3 Angles Adjustable Foldable (Midnight Black, Modern Without footrest)</p>\r\n', '2021-09-24', '2021-09-24', 1),
(4, 'OnePlus Nord2 Mobile', '29999', '<p>128GB storage, 8GB RAM</p>\r\n', '2021-09-24', '2021-09-24', 1),
(5, 'VIVO Mobile', '29990', '<p>Vivo V20 Pro (Midnight Jazz, 8GB RAM, 128GB ROM)</p>\r\n', '2021-09-24', '2021-09-24', 1),
(6, 'OnePlus Nord ', '50000', '<p>Triple Rear Camera (50 MP + 8 MP + 2 MP) | 32 MP Front Camera</p>\r\n', '2021-09-24', '2021-09-24', 1),
(7, 'VIVO V2e1', '25990', '<p>Dual Rear Camera (64 MP + 8 MP) | 32 MP Front Camera</p>\r\n', '2021-09-24', '2021-09-24', 1),
(8, 'VIVO V20 PRO', '29990', '<p>Triple Rear Camera (64MP + 8MP + 2MP) | 44MP + 8MP Front Camera</p>\r\n', '2021-09-24', '2021-09-24', 1),
(9, 'Samsung 80 cm tv', '18290', '<p>Samsung 80 cm (32 Inches) Wondertainment Series HD Ready LED Smart TV UA32T4340AKXXL (Glossy Black) (2020 Model)</p>\r\n', '2021-09-24', '2021-09-24', 2),
(10, 'LG 80 cm Tv', '17999', '<p>LG 80 cm (32 inches) HD Ready Smart LED TV 32LM563BPTC (Dark Iron Gray) (2020 Model)</p>\r\n', '2021-09-24', '2021-09-24', 2),
(11, 'MI 80 cm TV', '174999', '<p>Mi 80 cm (32 inches) Horizon Edition HD Ready Android Smart LED TV 4A|L32M6-EI (Grey)</p>\r\n', '2021-09-24', '2021-09-24', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1->active,0->inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email_id`, `password`, `created_on`, `updated_on`, `status`) VALUES
(1, 'Shafali Agrawal', 'shafaliagr.1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2021-09-24 12:38:23', '2021-09-24 12:38:23', 1),
(2, 'Hello Admin', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2021-09-24 12:39:10', '2021-09-24 12:39:10', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_added_by` (`add_by_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_added_by` FOREIGN KEY (`add_by_user`) REFERENCES `user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
