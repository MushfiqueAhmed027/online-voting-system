-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2018 at 05:57 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `onlinesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`admin_id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) DEFAULT NULL,
  `active` int(4) NOT NULL,
  `activation_token` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `password`, `active`, `activation_token`) VALUES
(1, 'pretom', 'pretom@gmail.com', '$2y$10$0IXqdmvOv8ukKWqtvcuVDeioKmLv3iXsDvNe9Y.mSdWh7TD4nsgjm', 0, '5f81afcf6ad7c964691f881ea374840f3a21450a');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE IF NOT EXISTS `candidates` (
`candidates_id` int(11) NOT NULL,
  `candidates_name` varchar(64) NOT NULL,
  `num_votes` int(64) DEFAULT NULL,
  `candidates_photo` varchar(64) DEFAULT NULL,
  `parties_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`candidates_id`, `candidates_name`, `num_votes`, `candidates_photo`, `parties_id`) VALUES
(10, 'Neimar', NULL, '1519361678291e3bce7e370ed3.jpg', NULL),
(11, 'Lionel Messi', NULL, '1519361740hi-res-159596853_crop_north.jpg', NULL),
(12, 'Cristiano Ronaldo', NULL, '151936177147B0378700000578-5228403-image-a-60_1514894368306.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

CREATE TABLE IF NOT EXISTS `elections` (
  `elections_name` varchar(64) NOT NULL,
  `parties_id` int(11) DEFAULT NULL,
  `candidates_id` int(11) DEFAULT NULL,
  `voter_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `parties`
--

CREATE TABLE IF NOT EXISTS `parties` (
`parties_id` int(11) NOT NULL,
  `parties_name` varchar(64) NOT NULL,
  `parties_photo` varchar(64) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parties`
--

INSERT INTO `parties` (`parties_id`, `parties_name`, `parties_photo`) VALUES
(2, 'teachers', '1517815448AK.jpg'),
(3, 'students', '151781553024852301_1145374105596442_3374952879217325622_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE IF NOT EXISTS `voter` (
`voter_id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `voter_photo` varchar(64) DEFAULT NULL,
  `activation_token` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`voter_id`, `email`, `username`, `password`, `voter_photo`, `activation_token`) VALUES
(2, 'pretom@gmail.com', 'pretom', '$2y$10$sX8h.nx7mh24splWaQKR1uQRTxXwV5xSjvy274srOVFrO/jCT9Cve', NULL, '12010e435f0df6873d7f39b7a0b35cb22db53320');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
`id` int(11) NOT NULL,
  `candidates_id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `vote_count` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`admin_id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
 ADD PRIMARY KEY (`candidates_id`), ADD UNIQUE KEY `candidates_name` (`candidates_name`), ADD KEY `parties_id` (`parties_id`);

--
-- Indexes for table `elections`
--
ALTER TABLE `elections`
 ADD PRIMARY KEY (`elections_name`), ADD KEY `parties_id` (`parties_id`), ADD KEY `candidates_id` (`candidates_id`), ADD KEY `voter_id` (`voter_id`);

--
-- Indexes for table `parties`
--
ALTER TABLE `parties`
 ADD PRIMARY KEY (`parties_id`), ADD UNIQUE KEY `parties_name` (`parties_name`);

--
-- Indexes for table `voter`
--
ALTER TABLE `voter`
 ADD PRIMARY KEY (`voter_id`), ADD UNIQUE KEY `voter_name` (`username`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
 ADD PRIMARY KEY (`id`), ADD KEY `candidates_id` (`candidates_id`), ADD KEY `voter_id` (`voter_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
MODIFY `candidates_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `parties`
--
ALTER TABLE `parties`
MODIFY `parties_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `voter`
--
ALTER TABLE `voter`
MODIFY `voter_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidates`
--
ALTER TABLE `candidates`
ADD CONSTRAINT `candidates_ibfk_1` FOREIGN KEY (`parties_id`) REFERENCES `parties` (`parties_id`) ON DELETE CASCADE;

--
-- Constraints for table `elections`
--
ALTER TABLE `elections`
ADD CONSTRAINT `elections_ibfk_1` FOREIGN KEY (`parties_id`) REFERENCES `parties` (`parties_id`) ON DELETE CASCADE,
ADD CONSTRAINT `elections_ibfk_2` FOREIGN KEY (`candidates_id`) REFERENCES `candidates` (`candidates_id`) ON DELETE CASCADE,
ADD CONSTRAINT `elections_ibfk_3` FOREIGN KEY (`voter_id`) REFERENCES `voter` (`voter_id`) ON DELETE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`candidates_id`) REFERENCES `candidates` (`candidates_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`voter_id`) REFERENCES `voter` (`voter_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
