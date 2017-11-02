-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2017 at 04:46 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eesbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `catering`
--

CREATE TABLE IF NOT EXISTS `catering` (
  `cid` int(6) unsigned NOT NULL,
  `uid` int(15) NOT NULL,
  `code` varchar(15) NOT NULL,
  `type` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `price` int(15) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catering`
--

INSERT INTO `catering` (`cid`, `uid`, `code`, `type`, `image`, `menu`, `price`, `reg_date`) VALUES
(1, 1, 'c1', 'buffet', 'images/catering/uploads/030720170315_bf1.jpg', '2 proteins, 2 carbohydraates, vitamin and a drink', 600, '2017-08-30 20:36:38'),
(2, 1, 'c2', 'platewise', 'images/catering/uploads/030720170316_plt3.jpg', '3 proteins, 1 carbohydrate and a drink', 500, '2017-08-30 20:37:02');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE IF NOT EXISTS `equipment` (
  `eid` int(6) unsigned NOT NULL,
  `uid` int(15) NOT NULL,
  `code` varchar(15) NOT NULL,
  `type` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `price` int(15) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`eid`, `uid`, `code`, `type`, `image`, `price`, `reg_date`) VALUES
(1, 1, 'e1', 'Public Address', 'images/equipment/uploads/030720170341_pa2.jpg', 2000, '2017-08-30 20:40:26'),
(3, 1, 'e3', 'Flip Charts', 'images/equipment/uploads/300820171044_chart1.jpg', 800, '2017-08-30 20:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `finances`
--

CREATE TABLE IF NOT EXISTS `finances` (
  `fnid` int(6) unsigned NOT NULL,
  `uid` int(15) NOT NULL,
  `bid` int(15) NOT NULL,
  `tot_before` int(15) NOT NULL,
  `tot_after` int(15) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finances`
--

INSERT INTO `finances` (`fnid`, `uid`, `bid`, `tot_before`, `tot_after`, `reg_date`) VALUES
(1, 1, 1, 6500, 5850, '2017-10-29 14:42:29'),
(2, 1, 2, 200, 180, '2017-10-29 14:42:29'),
(3, 1, 3, 500, 450, '2017-10-29 14:42:29'),
(4, 1, 4, 2000, 1800, '2017-10-29 14:59:55'),
(5, 1, 5, 500, 450, '2017-10-29 14:59:56'),
(6, 1, 6, 2000, 1800, '2017-10-29 15:02:26'),
(7, 1, 7, 500, 450, '2017-10-29 15:02:27'),
(8, 1, 8, 2000, 1800, '2017-10-29 15:16:36'),
(9, 1, 9, 500, 450, '2017-10-29 15:16:36'),
(10, 1, 10, 4500, 4050, '2017-10-29 15:21:17'),
(11, 1, 11, 6500, 5850, '2017-10-29 15:46:31');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(6) unsigned NOT NULL,
  `uid` int(15) NOT NULL,
  `message` varchar(255) NOT NULL,
  `response` varchar(255) NOT NULL,
  `phone` int(15) NOT NULL,
  `replied` int(15) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `uid`, `message`, `response`, `phone`, `replied`, `reg_date`) VALUES
(1, 0, 'Hi Admin', 'None', 711219260, 0, '2017-10-29 12:37:51'),
(2, 4, 'Hi Mycom', 'None', 711219260, 0, '2017-10-29 12:39:04');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `orid` int(6) unsigned NOT NULL,
  `uid` int(15) NOT NULL,
  `itmid` int(15) NOT NULL,
  `bid` int(15) NOT NULL,
  `svstype` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `people` int(15) NOT NULL,
  `quantity` int(15) NOT NULL,
  `transact_id` varchar(50) NOT NULL,
  `oprice` int(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `reqdate` varchar(50) NOT NULL,
  `date_time` varchar(50) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orid`, `uid`, `itmid`, `bid`, `svstype`, `size`, `people`, `quantity`, `transact_id`, `oprice`, `address`, `phone`, `reqdate`, `date_time`, `reg_date`) VALUES
(1, 1, 4, 1, 'Tent', '40x60', 200, 1, 'LIR9EQZZL3', 6500, 'Kamuyu, Nyeri', '0711219260', '30/10/2017', '29/10/2017 03:42:29', '2017-10-29 14:42:29'),
(2, 1, 3, 2, 'Seat', '', 0, 1, 'LIR9EQZZL3', 200, 'Kamuyu, Nyeri', '0711219260', '30/10/2017', '29/10/2017 03:42:29', '2017-10-29 14:42:29'),
(3, 1, 1, 3, 'Venue', '', 50, 1, 'LIR9EQZZL3', 500, 'Kamuyu, Nyeri', '0711219260', '30/10/2017', '29/10/2017 03:42:29', '2017-10-29 14:42:29'),
(4, 1, 1, 4, 'Tent', '20x30', 25, 1, 'LIR9EQZZL3', 2000, 'Kamuyu, Nyeri', '0711219260', '30/10/2017', '29/10/2017 03:59:55', '2017-10-29 14:59:55'),
(5, 1, 2, 5, 'Seat', '', 0, 1, 'LIR9EQZZL3', 500, 'Kamuyu, Nyeri', '0711219260', '30/10/2017', '29/10/2017 03:59:55', '2017-10-29 14:59:55'),
(6, 1, 1, 6, 'Tent', '20x30', 25, 1, 'LIR9EQZZL3', 2000, 'Kamuyu, Nyeri', '0711219260', '30/10/2017', '29/10/2017 04:02:26', '2017-10-29 15:02:26'),
(7, 1, 2, 7, 'Seat', '', 0, 1, 'LIR9EQZZL3', 500, 'Kamuyu, Nyeri', '0711219260', '30/10/2017', '29/10/2017 04:02:27', '2017-10-29 15:02:27'),
(8, 1, 1, 8, 'Tent', '20x30', 25, 1, 'LIR9EQZZL3', 2000, 'Kamuyu, Nyeri', '0711219260', '30/10/2017', '29/10/2017 04:16:36', '2017-10-29 15:16:36'),
(9, 1, 2, 9, 'Seat', '', 0, 1, 'LIR9EQZZL3', 500, 'Kamuyu, Nyeri', '0711219260', '30/10/2017', '29/10/2017 04:16:36', '2017-10-29 15:16:36'),
(10, 1, 3, 10, 'Tent', '30x60', 150, 1, 'LIR9EQZZL3', 4500, 'Kamuyu, Nyeri', '0711219260', '30/10/2017', '29/10/2017 04:21:17', '2017-10-29 15:21:17'),
(11, 1, 4, 11, 'Tent', '40x60', 200, 1, 'LIR9EQZZL3', 6500, 'Kamuyu, Nyeri', '0711219260', '30/10/2017', '29/10/2017 04:46:31', '2017-10-29 15:46:31');

-- --------------------------------------------------------

--
-- Table structure for table `pesapi_account`
--

CREATE TABLE IF NOT EXISTS `pesapi_account` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `push_in` tinyint(1) NOT NULL,
  `push_out` tinyint(1) NOT NULL,
  `push_neutral` tinyint(1) NOT NULL,
  `settings` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesapi_account`
--

INSERT INTO `pesapi_account` (`id`, `type`, `name`, `identifier`, `push_in`, `push_out`, `push_neutral`, `settings`) VALUES
(27, 2, 'eesbs', '0711219260', 1, 0, 0, 'a:7:{s:11:"PUSH_IN_URL";s:43:"https://eesbs.000webhostapp.com/smssync.php";s:14:"PUSH_IN_SECRET";s:5:"eesbs";s:12:"PUSH_OUT_URL";s:0:"";s:15:"PUSH_OUT_SECRET";s:0:"";s:16:"PUSH_NEUTRAL_URL";s:0:"";s:19:"PUSH_NEUTRAL_SECRET";s:0:"";s:11:"SYNC_SECRET";s:8:"4rk5rbj8";}');

-- --------------------------------------------------------

--
-- Table structure for table `pesapi_payment`
--

CREATE TABLE IF NOT EXISTS `pesapi_payment` (
  `id` int(11) NOT NULL,
  `used` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `super_type` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `receipt` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `phonenumber` varchar(45) NOT NULL,
  `name` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `post_balance` bigint(20) NOT NULL,
  `note` varchar(255) NOT NULL,
  `transaction_cost` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=510 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesapi_payment`
--

INSERT INTO `pesapi_payment` (`id`, `used`, `account_id`, `super_type`, `type`, `receipt`, `time`, `phonenumber`, `name`, `account`, `status`, `amount`, `post_balance`, `note`, `transaction_cost`) VALUES
(507, 1, 4, 1, 21, 'LIR9EQZZL3', '2017-09-26 22:49:00', '0718212849', 'AGATHA MWIHAKI', '', 0, 6500, 199525, 'LIR9EQZZL3 Confirmed.You have received Ksh5.00 from AGATHA MWIHAKI 0718212849 on 27/9/17 at 1:49 AM New M-PESA balance is Ksh1,995.25. Pay bills via M-PESA.', 0),
(509, 0, 4, 1, 21, 'LIR7ER0Y4X', '2017-09-26 23:15:00', '0718212849', 'AGATHA MWIHAKI', '', 0, 500, 199525, 'LIR7ER0Y4X Confirmed.You have received Ksh5.00 from AGATHA MWIHAKI 0718212849 on 27/9/17 at 2:15 AM New M-PESA balance is Ksh1,995.25. Pay bills via M-PESA.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE IF NOT EXISTS `seats` (
  `sid` int(6) unsigned NOT NULL,
  `uid` int(15) NOT NULL,
  `code` varchar(15) NOT NULL,
  `type` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `quantity` int(15) NOT NULL,
  `price` int(15) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`sid`, `uid`, `code`, `type`, `image`, `quantity`, `price`, `reg_date`) VALUES
(1, 1, 's1', 'typeA', 'images/seats/uploads/030720170246_1.jpg', 20, 300, '2017-08-30 20:38:25'),
(2, 1, 's2', 'typeD', 'images/seats/uploads/030720170247_4.jpg', 15, 500, '2017-08-30 20:38:44'),
(3, 1, 's3', 'typeB', 'images/seats/uploads/220820170126_2.jpg', 20, 200, '2017-08-30 20:39:02'),
(4, 1, 's4', 'typeA', 'images/seats/uploads/220820170132_1.jpg', 50, 500, '2017-08-30 20:39:22'),
(5, 1, 's5', 'typeC', 'images/seats/uploads/220820170136_3.jpg', 60, 600, '2017-08-30 20:39:40'),
(6, 1, 's6', 'typeD', 'images/seats/uploads/220820170138_4.jpg', 100, 1000, '2017-08-30 20:39:58');

-- --------------------------------------------------------

--
-- Table structure for table `s_providers`
--

CREATE TABLE IF NOT EXISTS `s_providers` (
  `uid` int(6) unsigned NOT NULL,
  `role` int(5) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `c_location` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `till` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` int(5) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `s_providers`
--

INSERT INTO `s_providers` (`uid`, `role`, `logo`, `companyName`, `c_location`, `email`, `phone`, `till`, `username`, `password`, `active`, `reg_date`) VALUES
(1, 1, 'images/logos/080920170147_FaddyTech_logo.PNG', 'FaddyTech', 'Nyeri Town', 'fbarasa18@gmail.com', '0717246969', '528208', 'Faddy', '$2y$10$4k3IOhnOW3m8DWxchOIqveoaQX8UHgjPtCFn616BC0c9lT5HQt.hC', 1, '2017-10-24 19:56:40'),
(2, 1, '', 'Ndekoment', 'Pembe Tatu', 'bafiam@gmail.com', '0711219260', '123321', 'Bafiam', '$2y$10$zLUfUwKhQxFC/OQUa9J4C.58Pz91DhlZXFkdk4fJpSAUQnd0AoywW', 1, '2017-10-24 19:58:00'),
(3, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'admin', '$2y$10$achdBZElLAlCjjN9uzWEb.JO4t/ctlLZ03ZltJyPp2oTDpKKTdtze', 1, '2017-10-24 19:58:00'),
(4, 1, '', 'MyCom Servicers', 'Nakuru', 'services@mycom.com', '0725361458', '562345', 'mycom', '$2y$10$I8Hk.RCH4971cEKVLRVKMOqfT3weroBlEtFH272Nba3AS/ApzJC5C', 1, '2017-10-29 12:41:11');

-- --------------------------------------------------------

--
-- Table structure for table `tents`
--

CREATE TABLE IF NOT EXISTS `tents` (
  `tid` int(6) unsigned NOT NULL,
  `uid` int(15) NOT NULL,
  `code` varchar(15) NOT NULL,
  `type` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `people` int(15) NOT NULL,
  `price` int(15) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tents`
--

INSERT INTO `tents` (`tid`, `uid`, `code`, `type`, `image`, `size`, `people`, `price`, `reg_date`) VALUES
(1, 1, 't1', 'typeA', 'images/tents/uploads/030720170156_1.jpg', '20x30', 25, 2000, '2017-08-30 17:42:14'),
(3, 1, 't3', 'typeB', 'images/tents/uploads/030720170158_2.jpg', '30x60', 150, 4500, '2017-08-30 17:43:03'),
(4, 1, 't4', 'typeB', 'images/tents/uploads/030720170158_2.jpg', '40x60', 200, 6500, '2017-08-30 17:43:29'),
(5, 1, 't5', 'typeB', 'images/tents/uploads/030720170158_2.jpg', '40x90', 300, 8500, '2017-08-30 20:05:53'),
(6, 2, 't6', 'typeA', 'images/tents/uploads/030720171147_1.jpg', '20x30', 25, 800, '2017-08-30 20:06:17'),
(7, 2, 't7', 'typeA', 'images/tents/uploads/030720171147_1.jpg', '30x60', 150, 1200, '2017-08-30 20:07:26'),
(8, 2, 't8', 'typeA', 'images/tents/uploads/030720171147_1.jpg', '40x60', 200, 2200, '2017-08-30 20:08:11'),
(9, 2, 't9', 'typeA', 'images/tents/uploads/030720171147_1.jpg', '40x90', 300, 3000, '2017-08-30 20:08:46'),
(10, 1, 't10', 'typeA', 'images/tents/uploads/220820170142_tenticon.jpg', '20x30', 25, 200, '2017-08-30 20:09:12'),
(16, 1, 't16', 'typeD', 'images/tents/uploads/220820170252_4.jpg', '20x30', 25, 750, '2017-08-30 20:09:35'),
(17, 1, 't17', 'typeC', 'images/tents/uploads/220820170259_3.jpg', '20x30', 25, 400, '2017-08-30 20:10:26'),
(18, 1, 't18', 'typeA', 'images/tents/uploads/220820170303_1.jpg', '40x90', 300, 2000, '2017-08-30 20:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE IF NOT EXISTS `venues` (
  `vid` int(6) unsigned NOT NULL,
  `uid` int(15) NOT NULL,
  `code` varchar(15) NOT NULL,
  `image` varchar(50) NOT NULL,
  `people` int(15) NOT NULL,
  `price` int(15) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`vid`, `uid`, `code`, `image`, `people`, `price`, `reg_date`) VALUES
(1, 1, 'v1', 'images/venues/uploads/030720170412_con3.jpg', 50, 500, '2017-08-30 20:37:36'),
(3, 1, 'v3', 'images/venues/uploads/300820171045_con1.jpg', 100, 780, '2017-08-30 20:45:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catering`
--
ALTER TABLE `catering`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `finances`
--
ALTER TABLE `finances`
  ADD PRIMARY KEY (`fnid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orid`);

--
-- Indexes for table `pesapi_account`
--
ALTER TABLE `pesapi_account`
  ADD PRIMARY KEY (`id`), ADD KEY `type_index` (`type`), ADD KEY `definedby` (`identifier`);

--
-- Indexes for table `pesapi_payment`
--
ALTER TABLE `pesapi_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `s_providers`
--
ALTER TABLE `s_providers`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tents`
--
ALTER TABLE `tents`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`vid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catering`
--
ALTER TABLE `catering`
  MODIFY `cid` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `eid` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `finances`
--
ALTER TABLE `finances`
  MODIFY `fnid` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orid` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pesapi_account`
--
ALTER TABLE `pesapi_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `pesapi_payment`
--
ALTER TABLE `pesapi_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=510;
--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `sid` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `s_providers`
--
ALTER TABLE `s_providers`
  MODIFY `uid` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tents`
--
ALTER TABLE `tents`
  MODIFY `tid` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `vid` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
