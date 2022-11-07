-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 29, 2022 at 06:12 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `review1`
--

CREATE TABLE `review1` (
  `id` int(11) NOT NULL,
  `textarea_content1` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review1`
--

INSERT INTO `review1` (`id`, `textarea_content1`) VALUES
(1, 'hi'),
(2, '1'),
(3, 'testing 1'),
(4, 'testing 1'),
(5, 'testing 1'),
(6, 'testing 1'),
(7, 'testing 1'),
(8, 'testing 1'),
(9, 'testing 1'),
(10, 'testing 1'),
(11, 'testing 1'),
(12, 'helloo'),
(13, 'testing 11');

-- --------------------------------------------------------

--
-- Table structure for table `review2`
--

CREATE TABLE `review2` (
  `id` int(11) NOT NULL,
  `textarea_content2` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review2`
--

INSERT INTO `review2` (`id`, `textarea_content2`) VALUES
(18, 'review 2'),
(19, '2'),
(20, ''),
(21, ''),
(22, '2'),
(23, ''),
(24, '22'),
(25, '222'),
(26, ''),
(27, ''),
(28, 'testing 2');

-- --------------------------------------------------------

--
-- Table structure for table `review3`
--

CREATE TABLE `review3` (
  `id` int(11) NOT NULL,
  `textarea_content3` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review3`
--

INSERT INTO `review3` (`id`, `textarea_content3`) VALUES
(8, 'This is my review number 3'),
(9, '3'),
(10, 'testing 3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `review1`
--
ALTER TABLE `review1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review2`
--
ALTER TABLE `review2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review3`
--
ALTER TABLE `review3`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `review1`
--
ALTER TABLE `review1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `review2`
--
ALTER TABLE `review2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `review3`
--
ALTER TABLE `review3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
