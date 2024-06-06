-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 14, 2024 at 05:49 PM
-- Server version: 5.7.26-0ubuntu0.16.04.1
-- PHP Version: 7.2.31-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swarna`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `email`, `password`, `status`, `Timestamp`) VALUES
(1, 'yashwanth1', 'yashwanthgowda12433@gmail.com', 'f396a8b9a8e84c4ce990cbff4e36b420', 1, '2021-02-04 05:53:45'),
(2, 'Akshay', 'akshay@wvs.in', '6ee379703bdc6692c757ff2f40a5a763', 1, '2021-02-04 05:55:00'),
(3, 'xyzabc', 'xyz@gmail.com', '46af6275f8fbc90de504528bef67412f', 1, '2022-05-21 06:53:47'),
(4, 'Manikant', 'manikan804s@gmail.com', '36de975c3e32f85addeba6a23952c940', 1, '2023-07-14 03:55:41');

-- --------------------------------------------------------

--
-- Table structure for table `admin_back`
--

CREATE TABLE `admin_back` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_ID` int(11) NOT NULL,
  `Category_Name` varchar(100) NOT NULL,
  `metal_type` enum('gold','silver') NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_ID`, `Category_Name`, `metal_type`, `Timestamp`) VALUES
(15, 'NECKLACES', 'gold', '2023-04-14 04:31:17'),
(16, 'BANGLES', 'gold', '2023-04-14 05:13:33'),
(17, 'LONG HARAM', 'gold', '2023-04-14 07:43:59'),
(18, 'Silver Chambu', 'silver', '2023-04-15 20:08:52'),
(20, 'RINGS', 'gold', '2023-05-16 03:25:21'),
(21, 'Earrings', 'gold', '2023-05-22 07:31:32'),
(23, 'Hand Nagamuri', 'gold', '2023-06-26 06:31:40'),
(24, 'Hand kada', 'gold', '2023-06-26 07:21:11'),
(25, 'Besari', 'gold', '2023-06-29 11:48:52'),
(26, 'Bhuja Bandi', 'gold', '2023-07-14 04:00:48'),
(27, 'Kadaga', 'gold', '2023-08-28 05:42:59');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `Customer_Code` int(11) NOT NULL,
  `Customer_Name` varchar(100) NOT NULL,
  `Customer_Email` varchar(100) NOT NULL,
  `Customer_Pincode` int(10) NOT NULL,
  `Customer_Billing_address` varchar(500) NOT NULL,
  `Customer_Default_shipping_address` varchar(500) NOT NULL,
  `Customer_Locality_Or_Town` varchar(100) NOT NULL,
  `Customer_Landmark` varchar(200) NOT NULL,
  `Customer_City` varchar(100) NOT NULL,
  `Customer_State` varchar(100) NOT NULL,
  `Customer_Phone_Number` varchar(100) NOT NULL,
  `Customer_Mobile_Number1` varchar(100) NOT NULL,
  `Customer_Mobile_Number2` varchar(100) NOT NULL,
  `making_charge` double DEFAULT NULL,
  `silver_opening_balance` double DEFAULT NULL,
  `Customer_Status` tinyint(1) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pan` varchar(15) DEFAULT NULL,
  `opening_balance` double(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`Customer_Code`, `Customer_Name`, `Customer_Email`, `Customer_Pincode`, `Customer_Billing_address`, `Customer_Default_shipping_address`, `Customer_Locality_Or_Town`, `Customer_Landmark`, `Customer_City`, `Customer_State`, `Customer_Phone_Number`, `Customer_Mobile_Number1`, `Customer_Mobile_Number2`, `making_charge`, `silver_opening_balance`, `Customer_Status`, `Timestamp`, `pan`, `opening_balance`) VALUES
(29, 'Manikanta HN', 'manikan804s@gmail.com', 560040, 'Vijaynagar', '', '', '', 'Bangalore', '', '', '9964184241', '', NULL, NULL, 0, '2023-07-30 13:06:59', 'APMPM1173R', 15.00),
(30, 'shilpa', 'shilpa@wvs.in', 562123, 'Makali', '', '', '', 'Bangalore', '', '', '9901156469', '', 0, 0, 0, '2023-07-07 10:07:21', 'BAGH233587', 10.00),
(31, 'Manikant H Nagendra', 'manikant804s@gmail.com', 560040, 'Vijaynagar', '', '', '', '', '', '', '9964184241', '', 0, 0, 1, '2023-05-16 03:22:30', 'APMPM1173R', 10.00),
(32, 'Poonam', 'ponam@test.com', 122002, 'gurgaon', '', '', '', 'gurgaon', '', '', '9877678898', '', 0, 0, 0, '2023-07-20 05:32:06', '4r3e2w3333', 23.00),
(33, 'Archana', 'archana@wvs.in', 560062, 'Narayana Nagar', '', '', '', 'Bengaluru', '', '', '9741155117', '', NULL, NULL, 0, '2023-08-28 05:47:15', 'AQHPA9158N', 10.00),
(35, 'manu k', 'manu@wvsoftek.com', 560010, '1st cross', '', '', '', 'Bengaluru', '', '', '9900133845', '', 1000, 1, 0, '2023-06-16 05:26:33', '12345', 1.00),
(36, 'Saurabha', 'shippu2000@gmail.com', 560010, 'Rajajinagar', '', '', '', 'Bangalore', '', '', '9901156468', '', 0, 100, 1, '2023-06-21 08:07:42', 'thhj09877', 10.00),
(37, 'Jyoti Akka Gowri Shankar', 'manikan804s@gmail.com', 560040, 'Vijaynagar', '', '', '', 'Bangalore', '', '', '8861438901', '', 0, 0, 0, '2023-07-14 04:29:06', 'APMPM1173R', 0.00),
(38, 'GaGi Kusuma Akka', 'ksdjhkshd@gmail.com', 560040, 'Vijaynagar', '', '', '', 'Bangalore', '', '', '9916501135', '', NULL, NULL, 0, '2023-07-14 05:21:53', 'APMPM1173R', 1.00),
(39, 'deepak', 'deepakraj@wvs.in', 823001, 'a p colony', '', '', '', 'gaya', '', '', '8789324115', '', 0, 0, 0, '2023-10-16 06:54:24', 'ABCTY1234D', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `goldbalance`
--

CREATE TABLE `goldbalance` (
  `Goldbalance_id` int(11) NOT NULL,
  `Masterbalance` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goldbalance`
--

INSERT INTO `goldbalance` (`Goldbalance_id`, `Masterbalance`) VALUES
(1, '55');

-- --------------------------------------------------------

--
-- Table structure for table `golddepositeticket`
--

CREATE TABLE `golddepositeticket` (
  `Ticket_Id` int(11) NOT NULL,
  `Workshop_Code` int(11) NOT NULL,
  `Deposite_GoldInGrams` varchar(100) NOT NULL,
  `Task_Id` int(11) NOT NULL,
  `Order_Code` int(11) NOT NULL,
  `Ticket_title` varchar(100) NOT NULL,
  `Ticket_Description` varchar(200) NOT NULL,
  `Ticket_Priority` int(10) NOT NULL,
  `Ticket_Status` int(10) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `golddepositeticket`
--

INSERT INTO `golddepositeticket` (`Ticket_Id`, `Workshop_Code`, `Deposite_GoldInGrams`, `Task_Id`, `Order_Code`, `Ticket_title`, `Ticket_Description`, `Ticket_Priority`, `Ticket_Status`, `Timestamp`) VALUES
(1, 1, '15', 1, 1, 'Cash', 'Payment done', 9, 1, '2021-07-01 01:55:27'),
(2, 1, '15', 1, 2, 'Gold prepare', 'uybbg', 10, 1, '2021-02-18 07:00:20'),
(3, 1, '10', 1, 2, 'Gold prepare', 'dff', 0, 1, '2021-03-12 09:43:40'),
(4, 1, '10', 1, 1, 'Gold prepare', 'adding', 0, 1, '2021-07-01 01:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `gold_melting_calculation`
--

CREATE TABLE `gold_melting_calculation` (
  `id` int(11) NOT NULL,
  `final_gold` double(10,3) DEFAULT '0.000',
  `less_in_pure_gms` double(10,3) DEFAULT '0.000',
  `less_in_pure_percent` double NOT NULL,
  `copper_grams` double(10,3) DEFAULT '0.000',
  `copper_percent` double NOT NULL,
  `melting_loss` double(10,3) DEFAULT '0.000',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `final_copper_grams` double(10,3) DEFAULT '0.000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `gold_melting_calculation`
--

INSERT INTO `gold_melting_calculation` (`id`, `final_gold`, `less_in_pure_gms`, `less_in_pure_percent`, `copper_grams`, `copper_percent`, `melting_loss`, `created_on`, `final_copper_grams`) VALUES
(2, 545.867, 0.289, 0, 39.600, 0, 5.000, '2023-12-11 15:38:19', 39.311),
(3, 556.195, 0.554, 0, 39.600, 0, 5.000, '2023-12-11 16:05:08', 39.046),
(4, 406.202, 2.191, 0, 23.760, 0, 5.000, '2023-12-11 17:00:26', 21.569),
(5, 13.427, 0.289, 0, 0.160, 0, 5.000, '2023-12-20 00:37:17', -0.129),
(6, 29.694, 0.578, 0, 0.160, 0, 5.000, '2023-12-20 01:48:50', -0.418);

-- --------------------------------------------------------

--
-- Table structure for table `gold_melting_pure_gold`
--

CREATE TABLE `gold_melting_pure_gold` (
  `id` int(11) NOT NULL,
  `gold_melting_id` int(11) NOT NULL,
  `pure_gold_id` int(11) NOT NULL,
  `grams` double(10,3) DEFAULT '0.000',
  `purity` double(10,3) DEFAULT '0.000',
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quantity` double(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `gold_melting_pure_gold`
--

INSERT INTO `gold_melting_pure_gold` (`id`, `gold_melting_id`, `pure_gold_id`, `grams`, `purity`, `timestamp`, `quantity`) VALUES
(2, 2, 9, 495.000, 0.000, '2023-12-11 15:38:19', 5.00),
(3, 3, 9, 495.000, 0.000, '2023-12-11 16:05:08', 5.00),
(4, 4, 10, 198.000, 0.000, '2023-12-11 17:00:26', 2.00),
(5, 4, 9, 99.000, 0.000, '2023-12-11 17:00:26', 1.00),
(6, 5, 9, 2.000, 0.000, '2023-12-20 00:37:17', 2.00),
(7, 6, 9, 2.000, 0.000, '2023-12-20 01:48:50', 2.00);

-- --------------------------------------------------------

--
-- Table structure for table `gold_melting_receipts`
--

CREATE TABLE `gold_melting_receipts` (
  `id` int(11) NOT NULL,
  `receipt_id` int(11) NOT NULL,
  `gold_melting_id` int(11) NOT NULL,
  `customer` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `net_weight` double(10,3) DEFAULT '0.000',
  `purity` double(10,3) DEFAULT '0.000',
  `date_received` date NOT NULL,
  `j_items` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status` enum('unmelted','melted') COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'unmelted',
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diff_percent` double(10,3) DEFAULT '0.000',
  `less_in_pure_grams` double(10,3) DEFAULT '0.000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `gold_melting_receipts`
--

INSERT INTO `gold_melting_receipts` (`id`, `receipt_id`, `gold_melting_id`, `customer`, `net_weight`, `purity`, `date_received`, `j_items`, `status`, `timestamp`, `diff_percent`, `less_in_pure_grams`) VALUES
(3, 631, 2, 'deepak', 2.889, 90.000, '0000-00-00', 'small bangel', 'unmelted', '2023-12-11 15:38:19', 2.500, 0.072),
(4, 618, 2, 'Manikanta HN', 8.667, 90.000, '0000-00-00', '1 Line Fancy Basha Chain 24\'\'', 'unmelted', '2023-12-11 15:38:19', 2.500, 0.217),
(5, 613, 3, 'Archana', 13.482, 90.000, '0000-00-00', 'small bangel', 'unmelted', '2023-12-11 16:05:08', 2.500, 0.337),
(6, 604, 3, 'Archana', 8.667, 90.000, '0000-00-00', 'small bangel', 'unmelted', '2023-12-11 16:05:08', 2.500, 0.217),
(7, 600, 4, 'Archana', 55.854, 90.000, '0000-00-00', 'Open Ananda + Ad Necklace + B chain 7\'\'', 'unmelted', '2023-12-11 17:00:26', 2.500, 1.396),
(8, 572, 4, 'Archana', 3.852, 90.000, '0000-00-00', '1 Line Fancy Basha Chain 24\'\'', 'unmelted', '2023-12-11 17:00:26', 2.500, 0.096),
(9, 564, 4, 'Archana', 27.927, 90.000, '0000-00-00', 'small item', 'unmelted', '2023-12-11 17:00:26', 2.500, 0.698),
(10, 631, 5, 'deepak', 2.889, 90.000, '0000-00-00', 'small bangel', 'unmelted', '2023-12-20 00:37:17', 2.500, 0.072),
(11, 618, 5, 'Manikanta HN', 8.667, 90.000, '0000-00-00', '1 Line Fancy Basha Chain 24\'\'', 'unmelted', '2023-12-20 00:37:17', 2.500, 0.217),
(12, 563, 6, 'Archana', 22.149, 90.000, '0000-00-00', 'small bangel', 'unmelted', '2023-12-20 01:48:50', 2.500, 0.554),
(13, 594, 6, 'Poonam', 0.963, 90.000, '0000-00-00', 'fancy Jahangir Bangles Pair 1*2\'\'-6', 'unmelted', '2023-12-20 01:48:50', 2.500, 0.024);

-- --------------------------------------------------------

--
-- Table structure for table `gold_transaction`
--

CREATE TABLE `gold_transaction` (
  `Transaction_ID` int(11) NOT NULL,
  `Entity_Type` enum('Customer','Workshop','Jewellary','') NOT NULL,
  `Entity_Id` varchar(100) NOT NULL,
  `Gold_in_Grams` varchar(100) NOT NULL,
  `Transaction_Type` varchar(100) NOT NULL,
  `From_Entity_Id` varchar(100) NOT NULL,
  `From_Entity_Type` varchar(100) NOT NULL,
  `Comments` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gold_transaction`
--

INSERT INTO `gold_transaction` (`Transaction_ID`, `Entity_Type`, `Entity_Id`, `Gold_in_Grams`, `Transaction_Type`, `From_Entity_Id`, `From_Entity_Type`, `Comments`, `Timestamp`) VALUES
(1, 'Jewellary', '1', '30', 'Debit', '', '', 'adding gold', '2021-03-02 08:54:04'),
(2, 'Jewellary', '1', '-10', 'Debit', '', '', 'remove gold', '2021-03-02 09:04:00'),
(3, 'Workshop', '1', '18', 'Credit', '1', 'Jewellery', 'vff', '2021-03-02 09:57:54'),
(4, 'Jewellary', '1', '10', 'Credit', '', '', 'crefit', '2021-03-05 04:58:32'),
(5, 'Jewellary', '1', '10', 'Debit', '', '', 'trans', '2021-03-05 05:00:08'),
(6, 'Workshop', '1', '4.5', 'Debit', '1', 'Jewellery', 'debit', '2021-03-05 10:47:16'),
(7, 'Workshop', '1', '1', 'Credit', '1', 'Jewellery', 'credit', '2021-03-12 05:33:12'),
(8, 'Jewellary', '1', '10', 'Credit', '', '', 'credit', '2021-03-12 05:42:19'),
(9, 'Workshop', '1', '2', 'Debit', '', '', 'debit', '2021-03-12 05:46:15'),
(10, 'Workshop', '1', '3', 'Debit', '', '', 'debit', '2021-03-12 06:03:30'),
(11, 'Workshop', '1', '5', 'Credit', '', '', 'credit', '2021-03-12 06:04:03'),
(12, 'Workshop', '1', '4', 'Credit', '', '', 'crdit', '2021-03-12 06:36:27'),
(13, 'Jewellary', '1', '10', 'Credit', '', '', 'sample', '2021-03-12 09:35:40'),
(14, 'Jewellary', '1', '0.5', 'Debit', '', '', 'debit', '2021-03-12 09:36:06'),
(15, 'Workshop', '1', '6', 'Debit', '', '', 'jels', '2021-03-12 09:36:56'),
(16, 'Workshop', '1', '1', 'Credit', '', '', 'add', '2021-03-12 09:37:56');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Item_Code` int(11) NOT NULL,
  `Item_Name` varchar(100) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Item_Code`, `Item_Name`, `Status`, `Timestamp`) VALUES
(1, 'Ruby', 1, '2021-07-14 13:20:54'),
(2, 'white coral', 1, '2021-02-13 05:03:29'),
(3, 'Sapphire', 1, '2021-07-14 13:21:05'),
(4, 'Diamond', 1, '2021-07-14 13:20:40');

-- --------------------------------------------------------

--
-- Table structure for table `jitems`
--

CREATE TABLE `jitems` (
  `item_id` int(11) NOT NULL,
  `SubCategory_ID` int(11) NOT NULL,
  `Category_ID` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `making_charges_per_gram` double(10,2) DEFAULT '0.00',
  `wastage_type` enum('gram','percent') NOT NULL DEFAULT 'percent',
  `wastage_percent` double(10,2) DEFAULT '0.00',
  `wastage_gram` double DEFAULT NULL,
  `metal_type` enum('gold','silver') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jitems`
--

INSERT INTO `jitems` (`item_id`, `SubCategory_ID`, `Category_ID`, `item_name`, `Timestamp`, `making_charges_per_gram`, `wastage_type`, `wastage_percent`, `wastage_gram`, `metal_type`) VALUES
(2, 4, 3, 'small bangel', '2022-11-16 17:11:56', 890.00, 'percent', 2.00, NULL, 'gold'),
(3, 4, 3, 'test bangle', '2022-11-17 05:04:18', 34.00, 'percent', 3.00, NULL, 'gold'),
(4, 5, 5, 'small item', '2022-11-18 05:18:22', 789.00, 'percent', 9.00, NULL, 'gold'),
(5, 7, 9, 'little', '2022-11-18 05:18:44', 67.00, 'percent', 5.00, NULL, 'gold'),
(6, 11, 5, '1 Line Fancy Basha Chain 24\'\'', '2022-12-15 07:45:32', 75.00, 'percent', 9.00, NULL, 'gold'),
(7, 12, 13, 'Jade Bangles', '2022-12-19 08:39:34', 90.00, 'percent', 1.00, NULL, 'gold'),
(8, 13, 15, 'Open AD Necklace + B chain 7\'\'', '2023-04-14 04:45:58', 150.00, 'percent', 12.00, NULL, 'gold'),
(9, 13, 15, 'Open Ananda + Ad Necklace + B chain 7\'\'', '2023-04-14 04:47:20', 150.00, 'percent', 12.00, NULL, 'gold'),
(10, 14, 15, 'Fancy Plain Ruby-Emerald Necklace + b chain 7\'\'', '2023-04-14 04:49:10', 100.00, 'percent', 8.00, NULL, 'gold'),
(11, 14, 15, 'Fancy Plain Necklace + b chain 7\'\'', '2023-04-14 04:50:18', 100.00, 'percent', 8.00, NULL, 'gold'),
(12, 14, 15, 'Fancy Plain + Ad Necklace + b chain 7\'\'', '2023-04-14 04:51:54', 100.00, 'percent', 8.00, NULL, 'gold'),
(13, 15, 15, 'Dimmi Real Ruby Emerald Rosecut Necklace with Ccm', '2023-04-14 04:54:34', 250.00, 'percent', 15.00, NULL, 'gold'),
(14, 15, 15, 'Dimmi Peacock Real Ruby Emerald Necklace b chain ', '2023-04-14 04:57:03', 250.00, 'percent', 15.00, NULL, 'gold'),
(15, 16, 15, 'Dimmi Mango Real Ruby Emerald Necklaces with gold ', '2023-04-14 05:09:47', 250.00, 'percent', 12.00, NULL, 'gold'),
(16, 17, 16, 'Fancy Ghatti Mirror Bangles Pair 1 * 2\'\'-7', '2023-04-14 05:17:11', 50.00, 'percent', 8.00, NULL, 'gold'),
(17, 17, 16, 'fancy Jahangir Bangles Pair 1*2\'\'-6', '2023-04-14 05:17:51', 100.00, 'percent', 9.00, NULL, 'gold'),
(18, 18, 16, 'Dimmi Full AD Bangles Pair 1*2\'\'-5', '2023-04-14 05:18:32', 150.00, 'percent', 10.00, NULL, 'gold'),
(19, 22, 18, 'Plain Silver Chambu 1ltr', '2023-04-15 20:10:32', 2.50, 'percent', 8.00, NULL, 'gold'),
(20, 22, 18, 'Plain Silver Chambu 1.5ltr', '2023-04-15 20:11:05', 3.00, 'percent', 8.00, NULL, 'gold'),
(21, 22, 18, 'Plain Iyengar Chambu', '2023-04-15 20:11:36', 3.50, 'percent', 8.00, NULL, 'gold'),
(22, 23, 18, 'Nakas Chambu Bhel Nakas', '2023-04-15 20:12:24', 5.50, 'percent', 12.00, NULL, 'gold'),
(23, 23, 18, 'nakas Ashta Lakshmi Chambu', '2023-04-15 20:13:06', 6.50, 'percent', 12.00, NULL, 'gold'),
(24, 13, 15, 'Nose ring', '2023-04-27 10:21:08', 1.00, 'percent', 0.05, NULL, 'gold'),
(25, 22, 0, 'Plain Silver Chambu 2ltr', '2023-05-15 05:20:49', 4.00, 'percent', 2.00, NULL, 'gold'),
(26, 25, 20, 'Dimmi 1Ad Ring', '2023-05-16 03:27:07', 950.00, 'percent', 1.20, NULL, 'gold'),
(27, 24, 20, 'Fancy Plain Ring 1', '2023-06-28 12:12:14', 100.00, 'gram', 0.50, NULL, 'gold'),
(28, 25, 20, 'Open Fancy AD Ring 1', '2023-05-16 03:28:33', 125.00, 'percent', 0.00, NULL, 'gold'),
(29, 13, 15, 'Big nose ring', '2023-05-19 11:01:43', 12.00, 'percent', 1.00, NULL, 'gold'),
(30, 25, 20, 'test ring', '2023-05-22 06:10:18', 12.00, 'gram', 1.00, NULL, 'gold'),
(31, 26, 21, 'Stone Jhumkas', '2023-06-28 12:11:47', 100.00, 'percent', 0.50, NULL, 'gold'),
(32, 19, 17, 'Lakshmi Haram', '2023-06-14 06:23:05', 150.00, 'percent', 5.00, NULL, 'gold'),
(33, 21, 17, 'Long Haram', '2023-06-14 07:44:16', 150.00, 'percent', 5.00, NULL, 'gold'),
(34, 27, 23, 'Red stoned', '2023-06-26 07:30:49', 100.00, 'percent', 12.00, NULL, 'gold'),
(35, 28, 24, 'Round Shape gold kada', '2023-06-26 07:23:09', 200.00, 'gram', 0.50, NULL, 'gold'),
(36, 29, 25, '3RD Besari ', '2023-06-29 11:51:53', 150.00, 'gram', 1.00, NULL, 'gold'),
(37, 29, 25, '5RD Besari', '2023-06-29 11:52:42', 250.00, 'gram', 2.00, NULL, 'gold'),
(38, 30, 26, 'Plain Gejje Patti Kai Bandi with Engraving 10\'\' - ', '2023-07-14 04:20:03', 125.00, 'gram', 3.60, NULL, 'gold'),
(39, 31, 26, 'Dimmi Ad/R/G Kai Bandi Mopu 1', '2023-07-14 04:20:21', 150.00, 'gram', 1.80, NULL, 'gold'),
(40, 26, 21, 'Open Full AD Jumki Pair 1', '2023-07-14 04:28:29', 125.00, 'gram', 1.40, NULL, 'gold'),
(41, 26, 21, 'Dimmi Real Burma Ruby Emerald RD Lolak Tops Pair 1', '2023-07-14 04:40:02', 550.00, 'gram', 4.50, NULL, 'gold');

-- --------------------------------------------------------

--
-- Table structure for table `metalorpurity`
--

CREATE TABLE `metalorpurity` (
  `Purity_ID` int(11) NOT NULL,
  `Purity_Name` varchar(100) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `metalorpurity`
--

INSERT INTO `metalorpurity` (`Purity_ID`, `Purity_Name`, `Timestamp`) VALUES
(1, '14kt', '2021-02-15 06:03:41'),
(2, '18kt', '2021-02-15 06:03:49'),
(3, '22kt', '2021-02-15 06:04:01'),
(4, '24kt', '2021-02-15 06:04:13');

-- --------------------------------------------------------

--
-- Table structure for table `metal_inventory`
--

CREATE TABLE `metal_inventory` (
  `id` int(10) NOT NULL,
  `metal_type` enum('gold','silver','platinum') COLLATE utf8mb4_unicode_520_ci DEFAULT 'gold',
  `balance_grams` double(10,3) DEFAULT '0.000',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `metal_inventory`
--

INSERT INTO `metal_inventory` (`id`, `metal_type`, `balance_grams`, `created`, `last_updated`) VALUES
(9, 'gold', 0.000, '2023-10-24 23:10:09', '2023-10-24 23:10:23'),
(12, 'silver', 20.000, '2023-12-19 15:55:39', NULL),
(13, 'platinum', 0.000, '2023-12-19 15:55:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `metal_inventory_passbook`
--

CREATE TABLE `metal_inventory_passbook` (
  `id` int(10) NOT NULL,
  `metal_inventory_id` int(10) DEFAULT NULL,
  `txn_type` enum('c','d') COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `grams` double(10,3) DEFAULT '0.000',
  `rate_per_gram` double(10,2) DEFAULT '0.00',
  `remarks` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `shop_user_name` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `metal_inventory_passbook`
--

INSERT INTO `metal_inventory_passbook` (`id`, `metal_inventory_id`, `txn_type`, `grams`, `rate_per_gram`, `remarks`, `shop_user_name`, `created`) VALUES
(2, 9, 'd', 25.000, 0.00, 'deduction', NULL, '2023-10-24 23:10:50'),
(3, NULL, 'd', 0.000, 0.00, 'For Gold calculation #2', NULL, '2023-12-11 10:08:19'),
(4, 9, 'd', 25.000, 0.00, 'For Gold calculation #3', NULL, '2023-12-11 10:35:08'),
(5, 10, 'd', 20.000, 0.00, 'For Gold calculation #4', NULL, '2023-12-11 11:30:26'),
(6, 9, 'd', 5.000, 0.00, 'For Gold calculation #4', NULL, '2023-12-11 11:30:26'),
(7, 9, 'd', 10.000, 0.00, 'Gold calculation deleted #1', NULL, '2023-12-11 13:42:22'),
(8, 12, 'c', 10.000, 1000.00, 'andolana circle', 'test', '2023-12-19 06:07:35'),
(9, 12, 'c', 10.000, 1000.00, 'andolana circle', 'test', '2023-12-19 06:07:39'),
(10, 12, 'd', 10.000, 1000.00, 'asdf', '', '2023-12-19 06:09:42'),
(11, 9, 'd', 2.000, 0.00, 'For Gold calculation #5', NULL, '2023-12-19 19:07:17'),
(12, 9, 'd', 2.000, 0.00, 'For Gold calculation #6', NULL, '2023-12-19 20:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_Code` int(11) NOT NULL,
  `Customer_Code` int(11) NOT NULL,
  `Product_Code` int(11) NOT NULL,
  `Order_Date` varchar(100) NOT NULL,
  `Required_date` varchar(100) NOT NULL,
  `Shipped_date` varchar(100) NOT NULL,
  `Order_Status` enum('pending','ongoing','cancelled','completed','delivered') DEFAULT 'pending',
  `Timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `orderid` varchar(100) DEFAULT NULL,
  `rate_per_gram` double(10,2) DEFAULT '0.00',
  `rate_per_gram_silver` double(10,2) DEFAULT '0.00',
  `metal_type` enum('gold','silver') NOT NULL,
  `order_type` enum('custom jewellery','polish','repair') NOT NULL DEFAULT 'custom jewellery'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_Code`, `Customer_Code`, `Product_Code`, `Order_Date`, `Required_date`, `Shipped_date`, `Order_Status`, `Timestamp`, `orderid`, `rate_per_gram`, `rate_per_gram_silver`, `metal_type`, `order_type`) VALUES
(7, 32, 0, '2023-06-13', '', '', 'completed', '2023-06-13 14:36:47', 'SO-7/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(8, 33, 0, '2023-06-13', '', '', 'pending', '2023-06-13 14:55:20', 'SO-8/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(9, 32, 0, '2023-06-13', '', '', 'pending', '2023-06-13 15:34:54', 'SO-9/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(10, 33, 0, '2023-06-13', '', '', 'pending', '2023-06-13 17:23:01', 'SO-10/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(11, 33, 0, '2023-06-14', '', '', 'pending', '2023-06-14 11:59:44', 'SO-11/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(12, 33, 0, '2023-06-14', '', '', 'pending', '2023-06-14 15:44:48', 'SO-12/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(13, 35, 0, '2023-06-16', '', '', 'pending', '2023-06-16 10:55:10', 'SO-13/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(14, 33, 0, '2023-06-16', '', '', 'pending', '2023-06-16 11:25:25', 'SO-14/2023', 0.00, 0.00, 'silver', 'custom jewellery'),
(16, 33, 0, '2023-06-16', '', '', 'pending', '2023-06-16 11:44:35', 'SO-16/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(17, 33, 0, '2023-06-16', '', '', 'pending', '2023-06-16 14:55:01', 'SO-17/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(18, 32, 0, '2023-06-16', '', '', 'pending', '2023-06-16 16:06:34', 'SO-18/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(19, 33, 0, '2023-06-19', '', '', 'pending', '2023-06-19 11:56:05', 'SO-19/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(20, 33, 0, '2023-06-19', '', '', 'pending', '2023-06-19 13:21:48', 'SO-20/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(21, 33, 0, '2023-06-20', '', '', 'pending', '2023-06-20 12:02:51', 'SO-21/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(22, 32, 0, '2023-06-20', '', '', 'pending', '2023-06-20 12:24:41', 'SO-22/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(23, 36, 0, '2023-06-21', '', '', 'pending', '2023-06-21 15:46:18', 'SO-23/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(24, 33, 0, '2023-06-28', '', '', 'ongoing', '2023-06-28 15:11:30', 'SO-24/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(25, 33, 0, '2023-06-29', '', '', 'pending', '2023-06-29 11:53:11', 'SO-25/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(26, 32, 0, '2023-06-29', '', '', 'pending', '2023-06-29 15:49:55', 'SO-26/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(27, 30, 0, '2023-06-29', '', '', 'pending', '2023-06-29 17:09:23', 'SO-27/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(28, 29, 0, '2023-06-29', '', '', 'pending', '2023-06-29 17:31:55', 'SO-28/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(29, 33, 0, '2023-06-30', '', '', 'pending', '2023-06-30 15:03:00', 'SO-29/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(30, 37, 0, '2023-07-14', '', '', 'pending', '2023-07-14 09:54:28', 'SO-30/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(31, 37, 0, '2023-07-14', '', '', 'pending', '2023-07-14 10:03:57', 'SO-31/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(32, 38, 0, '2023-07-14', '', '', 'pending', '2023-07-14 10:11:13', 'SO-32/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(33, 33, 0, '2023-07-18', '', '', 'pending', '2023-07-18 12:13:36', 'SO-33/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(34, 33, 0, '2023-07-18', '', '', 'pending', '2023-07-18 13:42:41', 'SO-34/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(35, 33, 0, '2023-07-18', '', '', 'pending', '2023-07-18 16:12:17', 'SO-35/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(36, 33, 0, '2023-07-18', '', '', 'pending', '2023-07-18 16:59:45', 'SO-36/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(37, 33, 0, '2023-07-18', '', '', 'pending', '2023-07-18 17:59:44', 'SO-37/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(38, 32, 0, '2023-07-20', '', '', 'pending', '2023-07-20 11:02:09', 'SO-38/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(39, 33, 0, '2023-07-20', '', '', 'pending', '2023-07-20 12:40:31', 'SO-39/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(40, 33, 0, '2023-07-20', '', '', 'pending', '2023-07-20 13:07:55', 'SO-40/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(41, 33, 0, '2023-07-21', '', '', 'pending', '2023-07-21 13:45:23', 'SO-41/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(42, 33, 0, '2023-07-25', '', '', 'pending', '2023-07-25 13:48:00', 'SO-42/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(43, 33, 0, '2023-07-27', '', '', 'pending', '2023-07-27 10:32:13', 'SO-43/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(44, 29, 0, '2023-07-30', '', '', 'pending', '2023-07-30 18:30:26', 'SO-44/2023', 0.00, 0.00, 'gold', 'custom jewellery'),
(45, 39, 0, '2023-10-16', '', '', 'pending', '2023-10-16 11:58:34', 'SO-45/2023', 0.00, 0.00, 'gold', 'custom jewellery');

-- --------------------------------------------------------

--
-- Table structure for table `orderstatus`
--

CREATE TABLE `orderstatus` (
  `Status_id` int(11) NOT NULL,
  `Order_Code` int(11) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `Description` varchar(400) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `Timestamp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderstatus`
--

INSERT INTO `orderstatus` (`Status_id`, `Order_Code`, `Status`, `Description`, `admin_name`, `Timestamp`) VALUES
(1, 1, 'processing', 'update', 'Akshay H', '2021-02-12 18:08:22'),
(2, 1, 'cancelled', 'updating', 'Akshay H', '2021-02-12 18:09:17'),
(3, 2, 'processing', 'update', 'Akshay H', '2021-02-13 10:46:18'),
(4, 3, 'processing', 'ki', 'Akshay', '2021-02-22 14:08:26'),
(5, 1, 'open', 'pay', 'yashwanth', '2021-07-01 07:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `orderstatustrack`
--

CREATE TABLE `orderstatustrack` (
  `orderstatustrack_id` int(11) NOT NULL,
  `orderstatustrack_name` varchar(100) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderstatustrack`
--

INSERT INTO `orderstatustrack` (`orderstatustrack_id`, `orderstatustrack_name`, `Timestamp`) VALUES
(1, 'open', '2021-02-12 09:51:51'),
(2, 'processing', '2021-02-12 09:52:32'),
(3, 'cancelled', '2021-02-12 09:52:51'),
(4, 'completed', '2021-02-12 09:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(18) NOT NULL,
  `Order_Code` int(10) DEFAULT NULL,
  `Category_ID` int(10) DEFAULT NULL,
  `SubCategory_ID` int(10) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `notes` varchar(300) DEFAULT NULL,
  `approx_grams` double(10,3) DEFAULT '0.000',
  `making_charges` double(10,2) DEFAULT '0.00',
  `wastage` double(10,3) DEFAULT '0.000',
  `Workshop_Code` int(10) DEFAULT NULL,
  `gold_balance` double NOT NULL,
  `nw_after_repair` double NOT NULL,
  `receipt_file` varchar(1000) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','assigned','completed','received') DEFAULT 'pending',
  `order_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `Order_Code`, `Category_ID`, `SubCategory_ID`, `item_id`, `notes`, `approx_grams`, `making_charges`, `wastage`, `Workshop_Code`, `gold_balance`, `nw_after_repair`, `receipt_file`, `Created`, `status`, `order_date`) VALUES
(6, 2, 16, 18, 18, '', 45.000, 50.00, 3.600, 3, 0, 0, 'receipt__1686549544.jpg', '2023-06-12 06:19:16', 'pending', NULL),
(7, 2, NULL, NULL, 2, NULL, 0.000, 0.00, 0.000, NULL, 0, 0, '', '2023-06-12 06:19:16', 'pending', NULL),
(9, 1, 17, 19, 16, '', 9.000, 50.00, 0.720, 3, 0, 0, '', '2023-06-12 06:42:58', 'pending', NULL),
(10, 3, 15, 16, 15, '', 10.000, 250.00, 1.200, 3, 0, 0, '', '2023-06-12 10:24:43', 'pending', NULL),
(20, 9, 15, 13, 8, '', 5.000, 150.00, 0.600, 3, 0, 0, 'receipt__1686650694.png', '2023-06-13 10:04:54', 'pending', NULL),
(23, 11, 17, 19, 32, '', 40.000, 150.00, 2.000, 4, 0, 0, 'receipt__1686724185.jpg', '2023-06-14 06:29:45', 'pending', NULL),
(24, 11, 16, 18, 18, '', 30.000, 150.00, 3.000, 3, 0, 0, 'receipt__16867241851.jpg', '2023-06-14 06:29:45', 'pending', NULL),
(25, 5, 15, 13, 2, '', 9.000, 150.00, 1.080, 3, 0, 0, '', '2023-06-14 06:35:43', 'pending', NULL),
(26, 4, 17, 19, 32, '', 10.000, 1500.00, 0.500, 3, 0, 0, '', '2023-06-14 06:43:07', 'pending', NULL),
(27, 12, 15, 13, 8, '', 15.000, 150.00, 1.800, 3, 0, 0, '', '2023-06-14 10:14:48', 'pending', NULL),
(28, 13, 15, 14, 0, '', 3.000, 150.00, 0.360, 3, 0, 0, '', '2023-06-16 05:25:10', 'pending', NULL),
(29, 13, 16, 17, 16, '', 0.500, 50.00, 0.040, 4, 0, 0, '', '2023-06-16 05:25:10', 'pending', NULL),
(30, 13, 16, 17, 16, '', 0.300, 50.00, 0.024, 0, 0, 0, '', '2023-06-16 05:25:10', 'pending', NULL),
(31, 13, 21, 26, 31, '', 1.000, 100.00, 0.500, 3, 0, 0, '', '2023-06-16 05:25:10', 'pending', NULL),
(32, 14, 18, 22, 25, '', 30.000, 4.00, 0.600, 4, 0, 0, '', '2023-06-16 05:55:25', 'pending', NULL),
(33, 15, 16, 18, 18, '', 70.000, 150.00, 7.000, 4, 0, 0, 'receipt__1686895089.jpg', '2023-06-16 05:58:09', 'pending', NULL),
(34, 17, 20, 25, 26, '', 10.000, 950.00, 0.120, 3, 0, 0, 'receipt__1686907501.png', '2023-06-16 09:25:01', 'pending', NULL),
(35, 17, 20, 24, 27, '', 15.000, 100.00, 0.075, 4, 0, 0, '', '2023-06-16 09:25:01', 'pending', NULL),
(36, 18, 17, 19, 32, '', 9.000, 150.00, 0.450, 3, 0, 0, '', '2023-06-16 10:36:34', 'pending', NULL),
(41, 19, 15, 13, 8, '', 15.000, 150.00, 1.800, 3, 0, 0, 'receipt__1687155965.png', '2023-06-19 06:37:46', 'completed', NULL),
(49, 20, 17, 19, 32, '', 35.000, 150.00, 1.750, 3, 0, 0, 'receipt__1687161108.png', '2023-06-19 13:06:15', 'pending', NULL),
(50, 20, NULL, NULL, 18, NULL, 0.000, 0.00, 0.000, NULL, 0, 0, '', '2023-06-19 13:06:15', 'pending', NULL),
(57, 21, 20, 25, 26, '', 10.000, 950.00, 0.120, 3, 0, 0, 'receipt__1687243241.jpg', '2023-06-20 06:45:22', 'assigned', NULL),
(58, 21, 16, 17, 16, '', 30.000, 50.00, 2.400, 4, 0, 0, 'receipt__16872432411.jpg', '2023-06-20 06:45:22', 'assigned', NULL),
(60, 23, 15, 15, 13, '', 30.000, 250.00, 4.500, 3, 0, 0, 'receipt__1687342578.jpg', '2023-06-21 10:16:18', 'pending', NULL),
(66, 24, 15, 14, 10, '', 50.000, 100.00, 4.000, 3, 0, 0, 'receipt__1687945290.png', '2023-06-28 09:47:48', 'pending', NULL),
(67, 24, 16, 18, 18, '', 15.000, 150.00, 1.500, 3, 0, 0, 'receipt__1687945603.jpg', '2023-06-28 09:47:48', 'assigned', NULL),
(68, 25, 23, 27, 34, '', 30.000, 100.00, 3.600, 3, 0, 0, 'receipt__1688019791.png', '2023-06-29 06:23:11', 'pending', NULL),
(71, 27, 15, 14, 10, '', 50.000, 100.00, 4.000, 3, 0, 0, '', '2023-06-29 11:39:23', 'pending', NULL),
(72, 28, 25, 29, 36, '', 0.000, 150.00, 0.000, 3, 0, 0, '', '2023-06-29 12:01:55', 'pending', NULL),
(74, 29, 24, 28, 35, '', 50.000, 200.00, 0.500, 3, 0, 0, 'receipt__1688117580.png', '2023-06-30 09:34:30', 'pending', NULL),
(75, 29, 16, 17, 16, '', 45.000, 50.00, 3.600, 4, 0, 0, '', '2023-06-30 09:34:30', 'pending', NULL),
(76, 30, 26, 30, 38, '', 34.000, 125.00, 3.600, 5, 0, 0, '', '2023-07-14 04:24:28', 'pending', NULL),
(77, 30, 26, 31, 39, '', 16.000, 150.00, 1.800, 4, 0, 0, '', '2023-07-14 04:24:28', 'pending', NULL),
(78, 31, 21, 26, 40, '', 11.000, 125.00, 1.400, 4, 0, 0, '', '2023-07-14 04:33:57', 'pending', NULL),
(79, 32, 21, 26, 41, '', 30.000, 550.00, 4.500, 4, 0, 0, '', '2023-07-14 04:41:13', 'pending', NULL),
(83, 33, 0, 0, 0, '', 0.000, 0.00, 0.000, 0, 0, 0, '', '2023-07-18 06:45:55', 'pending', NULL),
(84, 33, NULL, NULL, 0, NULL, 0.000, 0.00, 0.000, NULL, 0, 0, '', '2023-07-18 06:45:55', 'pending', NULL),
(86, 34, 26, 30, 38, '', 10.000, 125.00, 3.600, 3, 0, 0, 'receipt__1689667961.jpg', '2023-07-18 09:11:36', 'pending', NULL),
(90, 35, 15, 13, 8, '', 50.000, 7500.00, 6.000, 3, 0, 0, 'receipt__1689676937.jpg', '2023-07-18 11:09:27', 'pending', NULL),
(91, 35, 0, 0, 0, '', 0.000, 0.00, 0.000, 0, 0, 0, '', '2023-07-18 11:09:27', 'pending', NULL),
(94, 36, 26, 30, 38, '', 25.000, 125.00, 3.600, 4, 0, 0, 'receipt__1689679785.jpg', '2023-07-18 11:33:22', 'pending', NULL),
(95, 36, NULL, NULL, 4, NULL, 0.000, 0.00, 0.000, NULL, 0, 0, '', '2023-07-18 11:33:22', 'pending', NULL),
(97, 37, 15, 13, 8, '', 30.000, 4500.00, 3.600, 3, 0, 0, 'receipt__1689683384.jpg', '2023-07-18 12:32:51', 'pending', NULL),
(98, 37, NULL, NULL, 7, NULL, 0.000, 0.00, 0.000, NULL, 0, 0, '', '2023-07-18 12:32:51', 'pending', NULL),
(99, 22, 16, 17, 16, '', 9.000, 50.00, 0.720, 0, 0, 0, '', '2023-07-20 05:24:18', 'pending', NULL),
(117, 39, 15, 13, 8, '', 50.000, 7500.00, 6.000, 3, 0, 0, 'receipt__1689837031.jpg', '2023-07-20 07:27:38', 'pending', NULL),
(119, 40, 26, 30, 38, '', 25.000, 125.00, 3.600, 3, 0, 0, 'receipt__1689838675.jpg', '2023-07-20 07:40:06', 'pending', NULL),
(129, 38, 15, 13, 9, '', 10.000, 1500.00, 1.200, 3, 0, 0, '', '2023-07-20 08:57:46', 'pending', NULL),
(130, 38, 0, 0, 0, '', 0.000, 0.00, 0.000, 0, 0, 0, '', '2023-07-20 08:57:46', 'pending', NULL),
(131, 38, 0, 0, 0, '', 0.000, 0.00, 0.000, 0, 0, 0, '', '2023-07-20 08:57:46', 'pending', NULL),
(132, 41, 16, 18, 18, '', 30.000, 4500.00, 3.000, 4, 0, 0, '', '2023-07-21 08:15:23', 'pending', NULL),
(133, 42, 15, 13, 8, '', 30.000, 4500.00, 3.600, 3, 0, 0, '', '2023-07-25 08:18:00', 'pending', NULL),
(135, 43, 15, 13, 8, '', 50.000, 7500.00, 6.000, 3, 0, 0, '', '2023-07-27 05:06:00', 'pending', NULL),
(138, 26, 15, 13, 24, '', 9.000, 1.00, 0.005, 3, 0, 0, '', '2023-07-28 12:55:30', 'pending', NULL),
(139, 26, 20, 24, 27, '', 4.000, 100.00, 2.000, 4, 0, 0, '', '2023-07-28 12:55:30', 'pending', NULL),
(140, 44, 15, 13, 8, '', 100.000, 15000.00, 12.000, 4, 0, 0, '', '2023-07-30 13:00:26', 'pending', NULL),
(141, 44, 16, 17, 16, '', 30.000, 1500.00, 2.400, 3, 0, 0, '', '2023-07-30 13:00:26', 'pending', NULL),
(143, 10, 21, 26, 31, '', 30.000, 100.00, 0.500, 3, 0, 0, 'receipt__1686657182.jpg', '2023-08-04 07:15:05', 'pending', NULL),
(144, 10, 20, 25, 26, '', 80.000, 76000.00, 0.960, 4, 0, 0, '', '2023-08-04 07:15:05', 'pending', NULL),
(145, 45, 15, 14, 11, 'dfjbsk', 10.000, 1000.00, 0.800, 3, 0, 0, '', '2023-10-16 06:28:34', 'pending', NULL),
(146, 7, 16, 17, 16, '', 12.000, 50.00, 0.960, 3, 0, 0, '', '2023-12-09 07:56:28', 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_stones`
--

CREATE TABLE `order_stones` (
  `id` int(10) NOT NULL,
  `order_id` int(10) DEFAULT NULL,
  `stone_type_id` int(10) DEFAULT NULL,
  `stone_sub_type_id` int(10) DEFAULT NULL,
  `stone_item_id` int(11) NOT NULL,
  `quantity` int(10) DEFAULT '0',
  `carat` double(10,2) DEFAULT '0.00',
  `grams` double(10,2) DEFAULT '0.00',
  `cents` double(10,2) DEFAULT '0.00',
  `rate` double(10,2) DEFAULT '0.00',
  `total_amount` double(10,2) DEFAULT '0.00',
  `unit` enum('Cent','Number','Carat') NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_stones`
--

INSERT INTO `order_stones` (`id`, `order_id`, `stone_type_id`, `stone_sub_type_id`, `stone_item_id`, `quantity`, `carat`, `grams`, `cents`, `rate`, `total_amount`, `unit`, `created`) VALUES
(35, 107, 0, 0, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, '', '2023-05-15 16:27:42'),
(36, 110, 2, 14, 9, 7, 2.00, 0.00, 0.00, 750.00, 1500.00, '', '2023-05-22 07:15:00'),
(37, 111, 2, 14, 9, 20, 10.00, 0.00, 0.00, 750.00, 7500.00, '', '2023-05-22 11:25:53'),
(44, 112, 2, 14, 0, 6, 3.00, 0.00, 0.00, 750.00, 0.00, '', '2023-05-24 09:29:28'),
(45, 112, 2, 14, 0, 1, 2.00, 0.00, 0.00, 0.00, 0.00, '', '2023-05-24 09:29:28'),
(46, 113, 2, 14, 9, 1, 8.00, 0.00, 0.00, 750.00, 6000.00, '', '2023-06-05 15:07:14'),
(47, 114, 2, 14, 9, 10, 5.00, 0.00, 0.00, 750.00, 3750.00, '', '2023-06-07 06:14:31'),
(49, 115, 6, 0, 0, 20, 5.00, 0.00, 0.00, 0.00, 0.00, '', '2023-06-07 07:18:38'),
(58, 119, 2, 0, 10, 20, 5.00, 0.00, 0.00, 1150.00, 5750.00, '', '2023-06-07 13:10:35'),
(59, 119, 6, 0, 0, 5, 7.00, 0.00, 0.00, 500.00, 3500.00, '', '2023-06-07 13:10:35'),
(62, 122, 2, 14, 10, 7, 6.00, 0.00, 0.00, 1150.00, 6900.00, '', '2023-06-08 07:12:50'),
(66, 123, 2, 14, 9, 8, 6.00, 0.00, 0.00, 750.00, 4500.00, '', '2023-06-09 04:59:32'),
(70, 2, 2, 14, 9, 20, 5.00, 0.00, 0.00, 750.00, 3750.00, '', '2023-06-12 06:19:16'),
(78, 5, 2, 14, 9, 10, 0.00, 0.00, 0.00, 0.00, 0.00, '', '2023-06-14 06:35:42'),
(79, 15, 7, 13, 6, 10, 15.00, 0.00, 0.00, 250.00, 3750.00, '', '2023-06-16 05:58:09'),
(80, 15, 7, 13, 8, 1, 15.00, 0.00, 0.00, 75.00, 1125.00, '', '2023-06-16 05:58:09'),
(95, 23, 2, 14, 9, 4, 3.00, 0.00, 0.00, 750.00, 2250.00, '', '2023-06-21 10:16:18'),
(97, 24, 7, 13, 6, 1, 6.00, 0.00, 0.00, 250.00, 1500.00, '', '2023-06-28 09:47:48'),
(98, 25, 2, 14, 9, 1, 5.00, 0.00, 0.00, 750.00, 3750.00, '', '2023-06-29 06:23:11'),
(99, 27, 2, 14, 9, 1, 9.00, 0.00, 0.00, 750.00, 6750.00, '', '2023-06-29 11:39:23'),
(100, 28, 2, 14, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, '', '2023-06-29 12:01:55'),
(102, 29, 2, 14, 9, 10, 5.00, 0.00, 0.00, 750.00, 3750.00, '', '2023-06-30 09:34:30'),
(105, 33, 0, 0, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, '', '2023-07-18 06:45:55'),
(107, 34, 2, 14, 9, 1, 6.00, 0.00, 0.00, 750.00, 4500.00, '', '2023-07-18 09:11:36'),
(110, 35, 2, 14, 9, 10, 5.00, 0.00, 0.00, 750.00, 3750.00, '', '2023-07-18 11:09:27'),
(113, 36, 2, 14, 9, 10, 5.00, 0.00, 0.00, 750.00, 3750.00, '', '2023-07-18 11:33:22'),
(115, 37, 2, 14, 9, 5, 5.00, 0.00, 0.00, 750.00, 3750.00, '', '2023-07-18 12:32:51'),
(126, 39, 2, 14, 9, 10, 5.00, 0.00, 0.00, 750.00, 3750.00, '', '2023-07-20 07:27:38'),
(128, 40, 2, 14, 9, 10, 5.00, 0.00, 0.00, 750.00, 3750.00, '', '2023-07-20 07:40:06'),
(132, 38, 2, 14, 9, 1, 2.00, 0.00, 0.00, 750.00, 1500.00, '', '2023-07-20 08:57:46'),
(133, 41, 2, 14, 9, 30, 9.00, 0.00, 0.00, 750.00, 6750.00, '', '2023-07-21 08:15:23'),
(134, 42, 2, 14, 9, 10, 4.00, 0.00, 0.00, 750.00, 3000.00, '', '2023-07-25 08:18:00'),
(136, 43, 2, 14, 9, 10, 6.00, 0.00, 0.00, 750.00, 4500.00, '', '2023-07-27 05:05:59'),
(137, 44, 0, 0, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, '', '2023-07-30 13:00:26'),
(139, 45, 2, 14, 9, 1, 13.00, 0.00, 0.00, 738.00, 9594.00, '', '2023-10-16 06:28:34'),
(140, 7, 0, 0, 0, 1, 0.00, 0.00, 0.00, 0.00, 0.00, '', '2023-12-09 07:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `Payment_code` int(11) NOT NULL,
  `Order_Code` int(11) NOT NULL,
  `Customer_Code` int(8) DEFAULT NULL,
  `Date_Of_Order` varchar(100) NOT NULL,
  `Purity` float(8,2) DEFAULT '0.00',
  `Payment_Method` enum('gold','cash','silver') DEFAULT NULL,
  `Grams` float(8,3) DEFAULT '0.000',
  `Quality` float(8,2) DEFAULT '0.00',
  `Amount` double(10,2) DEFAULT '0.00',
  `Total_gold` float(8,3) DEFAULT '0.000',
  `Payment_Status` tinyint(1) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `melting_loss` float(8,3) DEFAULT '0.000',
  `copper` float(8,3) DEFAULT '0.000',
  `notes` varchar(300) DEFAULT NULL,
  `Category_ID` int(8) DEFAULT NULL,
  `SubCategory_ID` int(8) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `rate_per_gram` double(10,2) DEFAULT '0.00',
  `total_amount` double(10,2) DEFAULT '0.00',
  `txn_type` enum('Cash','Online','Cheque','') DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `receipt_file` varchar(200) NOT NULL,
  `payment_for` enum('making_charge','stone_charge','gram_charge') NOT NULL DEFAULT 'gram_charge',
  `melting_status` tinyint(1) NOT NULL DEFAULT '0',
  `jeweller_purity` double(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`Payment_code`, `Order_Code`, `Customer_Code`, `Date_Of_Order`, `Purity`, `Payment_Method`, `Grams`, `Quality`, `Amount`, `Total_gold`, `Payment_Status`, `Timestamp`, `melting_loss`, `copper`, `notes`, `Category_ID`, `SubCategory_ID`, `item_id`, `rate_per_gram`, `total_amount`, `txn_type`, `payment_date`, `receipt_file`, `payment_for`, `melting_status`, `jeweller_purity`) VALUES
(18, 2, NULL, '', 0.00, 'cash', 2.000, 100.00, 0.00, 0.000, 0, '2023-06-12 06:19:16', 0.000, 0.000, '', NULL, NULL, NULL, 10000.00, 20000.00, 'Cash', '2023-06-12', '', 'gram_charge', 0, 0.00),
(19, 2, NULL, '', 0.00, 'cash', 0.500, 100.00, 0.00, 0.000, 0, '2023-06-12 06:19:16', 0.000, 0.000, '', NULL, NULL, NULL, 10000.00, 5000.00, 'Cash', '2023-06-12', '', 'gram_charge', 0, 0.00),
(20, 2, NULL, '', 0.00, 'cash', 1.000, 100.00, 0.00, 0.000, 0, '2023-06-12 06:19:16', 0.000, 0.000, '', NULL, NULL, NULL, 10000.00, 10000.00, 'Cash', '2023-06-12', '', 'gram_charge', 0, 0.00),
(21, 2, NULL, '', 0.00, 'cash', 0.600, 100.00, 0.00, 0.000, 0, '2023-06-12 06:19:16', 0.000, 0.000, '', NULL, NULL, NULL, 10000.00, 6000.00, 'Cash', '2023-06-12', '', 'gram_charge', 0, 0.00),
(22, 2, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-12 06:19:16', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 0.00, 'Cash', '2023-06-12', '', 'making_charge', 0, 0.00),
(23, 2, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-12 06:19:16', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 3750.00, 'Cash', '2023-06-04', '', 'stone_charge', 0, 0.00),
(24, 2, NULL, '', 0.00, 'gold', 30.000, 90.00, 0.00, 0.000, 0, '2023-06-12 06:19:16', 5.000, 0.000, '', NULL, NULL, NULL, 0.00, 0.00, NULL, '2023-06-12', 'receipt__1686550317.jpg', 'gram_charge', 0, 90.00),
(25, 2, NULL, '', 0.00, 'gold', 5.000, 90.00, 0.00, 0.000, 0, '2023-06-12 06:19:16', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 0.00, NULL, '2023-06-11', '', 'gram_charge', 0, 90.00),
(30, 1, NULL, '', 0.00, 'cash', 0.333, 100.00, 0.00, 0.000, 0, '2023-06-12 06:42:58', 0.000, 0.000, '', NULL, NULL, NULL, 3000.00, 1000.00, 'Cash', '2023-06-12', '', 'gram_charge', 0, 0.00),
(31, 1, NULL, '', 0.00, 'cash', 0.333, 100.00, 0.00, 0.000, 0, '2023-06-12 06:42:58', 0.000, 0.000, '', NULL, NULL, NULL, 3000.00, 1000.00, 'Online', '2023-06-12', '', 'gram_charge', 0, 0.00),
(32, 1, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-12 06:42:58', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 10000.00, 'Cheque', '2023-06-12', '', 'making_charge', 0, 0.00),
(33, 1, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-12 06:42:58', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 3500.00, 'Cash', '2023-06-12', '', 'making_charge', 0, 0.00),
(34, 1, NULL, '', 0.00, 'gold', 1.000, 90.00, 0.00, 0.000, 0, '2023-06-12 06:42:58', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 0.00, NULL, '2023-06-12', '', 'gram_charge', 0, 90.00),
(35, 8, NULL, '', 0.00, 'cash', 0.000, 0.00, 0.00, 0.000, 0, '2023-06-12 09:44:48', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 51500.00, 'Cash', '2023-06-12', '', 'gram_charge', 0, 0.00),
(36, 8, NULL, '', 0.00, 'cash', 0.000, 0.00, 0.00, 0.000, 0, '2023-06-12 09:44:48', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 30000.00, '', '2023-06-12', '', 'gram_charge', 0, 0.00),
(37, 8, NULL, '', 0.00, 'cash', 0.000, 0.00, 0.00, 0.000, 0, '2023-06-12 09:44:48', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 10000.00, '', '2023-06-12', '', 'gram_charge', 0, 0.00),
(38, 3, NULL, '', 0.00, 'cash', 0.070, 100.00, 0.00, 0.000, 0, '2023-06-12 10:24:43', 0.000, 0.000, '', NULL, NULL, NULL, 10000.00, 700.00, 'Online', '2023-06-13', '', 'gram_charge', 0, 0.00),
(39, 3, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-12 10:24:43', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 900.00, 'Online', '2023-06-19', '', 'making_charge', 0, 0.00),
(40, 3, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-12 10:24:43', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 100.00, '', '2023-06-14', '', 'making_charge', 0, 0.00),
(55, 6, NULL, '', 0.00, 'cash', 3.636, 100.00, 0.00, 0.000, 0, '2023-06-13 07:23:53', 0.000, 0.000, '', NULL, NULL, NULL, 5500.00, 20000.00, '', '2023-06-12', '', 'gram_charge', 0, 0.00),
(56, 6, NULL, '', 0.00, 'cash', 4.545, 100.00, 0.00, 0.000, 0, '2023-06-13 07:23:53', 0.000, 0.000, '', NULL, NULL, NULL, 5500.00, 25000.00, '', '2023-06-13', '', 'gram_charge', 0, 0.00),
(57, 6, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-13 07:23:53', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 5250.00, '', '2023-06-13', '', 'making_charge', 0, 0.00),
(58, 6, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-13 07:23:53', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 3000.00, '', '2023-06-13', '', 'stone_charge', 0, 0.00),
(60, 8, NULL, '', 0.00, 'cash', 3.636, 100.00, 0.00, 0.000, 0, '2023-06-13 09:25:20', 0.000, 0.000, '', NULL, NULL, NULL, 5500.00, 20000.00, 'Cash', '2023-06-12', '', 'gram_charge', 0, 0.00),
(61, 8, NULL, '', 0.00, 'cash', 2.727, 100.00, 0.00, 0.000, 0, '2023-06-13 09:25:20', 0.000, 0.000, '', NULL, NULL, NULL, 5500.00, 15000.00, 'Cash', '2023-06-13', '', 'gram_charge', 0, 0.00),
(62, 8, NULL, '', 0.00, 'cash', 1.818, 100.00, 0.00, 0.000, 0, '2023-06-13 09:25:20', 0.000, 0.000, '', NULL, NULL, NULL, 5500.00, 10000.00, 'Cash', '2023-06-09', '', 'gram_charge', 0, 0.00),
(63, 8, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-13 09:25:20', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 1000.00, '', '2023-06-06', '', 'making_charge', 0, 0.00),
(64, 8, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-13 09:25:20', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 3000.00, '', '2023-06-13', '', 'making_charge', 0, 0.00),
(65, 8, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-13 09:25:20', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 1000.00, '', '2023-06-12', '', 'making_charge', 0, 0.00),
(66, 8, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-13 09:25:20', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 250.00, '', '2023-06-11', '', 'making_charge', 0, 0.00),
(67, 8, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-13 09:25:20', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 2000.00, '', '2023-06-14', '', 'stone_charge', 0, 0.00),
(68, 8, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-13 09:25:20', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 2000.00, '', '2023-06-13', '', 'stone_charge', 0, 0.00),
(69, 9, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-13 10:04:54', 0.000, 0.000, 'test', NULL, NULL, NULL, 0.00, 750.00, 'Cash', '2023-06-06', '', 'making_charge', 0, 0.00),
(70, 9, NULL, '', 0.00, 'gold', 2.000, 90.00, 0.00, 0.000, 0, '2023-06-13 10:04:54', 0.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-06-13', '', 'gram_charge', 0, 90.00),
(89, 9, NULL, '', 0.00, 'cash', 0.000, 0.00, 0.00, 0.000, 0, '2023-06-14 06:19:40', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 50000.00, 'Cash', '2023-06-13', '', 'gram_charge', 0, 0.00),
(90, 9, NULL, '', 0.00, 'cash', 0.000, 0.00, 0.00, 0.000, 0, '2023-06-14 06:19:40', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 30000.00, '', '2023-06-12', '', 'gram_charge', 0, 0.00),
(91, 9, NULL, '', 0.00, 'cash', 0.000, 0.00, 0.00, 0.000, 0, '2023-06-14 06:19:40', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 10000.00, '', '2023-06-14', '', 'gram_charge', 0, 0.00),
(92, 9, NULL, '', 0.00, 'cash', 0.000, 0.00, 0.00, 0.000, 0, '2023-06-14 06:19:40', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 15000.00, '', '2023-06-11', '', 'gram_charge', 0, 0.00),
(93, 9, NULL, '', 0.00, 'cash', 0.000, 0.00, 0.00, 0.000, 0, '2023-06-14 06:19:40', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 30000.00, '', '2023-06-14', '', 'gram_charge', 0, 0.00),
(97, 5, NULL, '', 0.00, 'cash', 3.000, 100.00, 0.00, 0.000, 0, '2023-06-14 06:35:43', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 18000.00, 'Cash', '2023-06-14', '', 'gram_charge', 0, 0.00),
(98, 5, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-14 06:35:43', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 900.00, '', '2023-06-14', '', 'making_charge', 0, 0.00),
(99, 5, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-14 06:35:43', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 450.00, '', '2023-06-14', '', 'making_charge', 0, 0.00),
(100, 5, NULL, '', 0.00, 'gold', 10.000, 90.00, 0.00, 0.000, 0, '2023-06-14 06:35:43', 2.000, 0.000, '', NULL, NULL, NULL, 0.00, 0.00, NULL, '2023-06-14', '', 'gram_charge', 0, 90.00),
(101, 4, NULL, '', 0.00, 'cash', 0.090, 100.00, 0.00, 0.000, 0, '2023-06-14 06:43:07', 0.000, 0.000, '', NULL, NULL, NULL, 10000.00, 900.00, 'Cash', '2023-06-14', '', 'gram_charge', 0, 0.00),
(102, 4, NULL, '', 0.00, 'cash', 1.000, 100.00, 0.00, 0.000, 0, '2023-06-14 06:43:07', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 6000.00, 'Cash', '2023-06-14', '', 'gram_charge', 0, 0.00),
(103, 4, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-14 06:43:07', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 9000.00, 'Online', '2023-06-14', '', 'making_charge', 0, 0.00),
(104, 4, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-14 06:43:07', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 900.00, '', '2023-06-14', '', 'making_charge', 0, 0.00),
(105, 14, NULL, '', 0.00, 'cash', 6.849, 100.00, 0.00, 0.000, 0, '2023-06-16 05:55:25', 0.000, 0.000, '', NULL, NULL, NULL, 73.00, 500.00, 'Online', '2023-06-14', '', 'gram_charge', 0, 0.00),
(106, 14, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-16 05:55:25', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 50.00, 'Cash', '2023-06-14', '', 'making_charge', 0, 0.00),
(107, 17, NULL, '', 0.00, 'cash', 5.000, 100.00, 0.00, 0.000, 0, '2023-06-16 09:25:01', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 25000.00, '', '2023-06-14', '', 'gram_charge', 0, 0.00),
(108, 17, NULL, '', 0.00, 'cash', 6.000, 100.00, 0.00, 0.000, 0, '2023-06-16 09:25:01', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 30000.00, '', '2023-06-15', '', 'gram_charge', 0, 0.00),
(109, 17, NULL, '', 0.00, 'cash', 2.000, 100.00, 0.00, 0.000, 0, '2023-06-16 09:25:01', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 10000.00, '', '2023-06-16', '', 'gram_charge', 0, 0.00),
(110, 17, NULL, '', 0.00, 'cash', 5.000, 100.00, 0.00, 0.000, 0, '2023-06-16 09:25:01', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 25000.00, '', '2023-06-13', '', 'gram_charge', 0, 0.00),
(111, 17, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-16 09:25:01', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 1000.00, 'Cash', '2023-06-14', '', 'making_charge', 0, 0.00),
(112, 17, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-16 09:25:01', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 500.00, 'Cash', '2023-06-12', '', 'making_charge', 0, 0.00),
(113, 17, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-16 09:25:01', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 300.00, 'Cash', '2023-06-15', '', 'making_charge', 0, 0.00),
(114, 17, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-16 09:25:01', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 200.00, 'Cash', '2023-06-13', '', 'making_charge', 0, 0.00),
(115, 17, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-16 09:25:01', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 1000.00, '', '2023-06-14', '', 'stone_charge', 0, 0.00),
(116, 17, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-16 09:25:01', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 200.00, '', '2023-06-15', '', 'stone_charge', 0, 0.00),
(117, 17, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-16 09:25:01', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 400.00, '', '2023-06-16', '', 'stone_charge', 0, 0.00),
(118, 17, NULL, '', 0.00, 'gold', 10.000, 90.00, 0.00, 0.000, 0, '2023-06-16 09:25:01', 3.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-06-16', 'receiptgold__1686907501.png', 'gram_charge', 0, 90.00),
(146, 11, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-16 10:01:44', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 15000.00, NULL, '2023-06-16', '', 'gram_charge', 0, 0.00),
(147, 11, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-16 10:01:44', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 20000.00, NULL, '2023-06-16', '', 'gram_charge', 0, 0.00),
(148, 11, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-16 10:01:44', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 25000.00, NULL, '2023-06-16', '', 'gram_charge', 0, 0.00),
(149, 11, NULL, '', 0.00, 'cash', 0.000, 0.00, 0.00, 0.000, 0, '2023-06-16 10:01:44', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 3000.00, 'Cash', '2023-06-14', '', 'gram_charge', 0, 0.00),
(150, 11, NULL, '', 0.00, 'cash', 0.000, 0.00, 0.00, 0.000, 0, '2023-06-16 10:01:44', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 4000.00, 'Cash', '2023-06-22', '', 'gram_charge', 0, 0.00),
(151, 12, NULL, '', 0.00, 'cash', 0.000, 0.00, 0.00, 0.000, 0, '2023-06-16 10:04:30', 0.000, 0.000, '', NULL, NULL, NULL, 73.00, 500.00, 'Cash', '2023-06-05', '', 'gram_charge', 0, 0.00),
(152, 12, NULL, '', 0.00, 'cash', 0.000, 0.00, 0.00, 0.000, 0, '2023-06-16 10:04:30', 0.000, 0.000, '', NULL, NULL, NULL, 73.00, 500.00, 'Cash', '2023-06-13', '', 'gram_charge', 0, 0.00),
(153, 12, NULL, '', 0.00, 'cash', 0.000, 0.00, 0.00, 0.000, 0, '2023-06-16 10:04:30', 0.000, 0.000, '', NULL, NULL, NULL, 73.00, 500.00, 'Cash', '2023-06-14', '', 'gram_charge', 0, 0.00),
(158, 13, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-16 10:08:02', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 500.00, NULL, '2023-06-16', '', 'gram_charge', 0, 0.00),
(159, 13, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-16 10:08:02', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 1000.00, NULL, '2023-06-16', '', 'gram_charge', 0, 0.00),
(160, 13, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-16 10:08:02', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 2000.00, NULL, '2023-06-16', '', 'gram_charge', 0, 0.00),
(161, 13, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-16 10:08:02', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 800.00, NULL, '2023-06-16', '', 'gram_charge', 0, 0.00),
(162, 13, NULL, '', 0.00, 'cash', 0.000, 0.00, 0.00, 0.000, 0, '2023-06-16 10:08:02', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 200.00, 'Cash', '2023-06-14', '', 'gram_charge', 0, 0.00),
(163, 13, NULL, '', 0.00, 'cash', 0.000, 0.00, 0.00, 0.000, 0, '2023-06-16 10:08:02', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 50000.00, 'Cash', '2023-06-15', '', 'gram_charge', 0, 0.00),
(164, 13, NULL, '', 0.00, 'cash', 0.000, 0.00, 0.00, 0.000, 0, '2023-06-16 10:08:02', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 7000.00, 'Cash', '2023-06-16', '', 'gram_charge', 0, 0.00),
(165, 18, NULL, '', 0.00, 'cash', 0.180, 100.00, 0.00, 0.000, 0, '2023-06-16 10:36:34', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 900.00, 'Cash', '2023-06-06', '', 'gram_charge', 0, 0.00),
(166, 18, NULL, '', 0.00, 'cash', 0.240, 100.00, 0.00, 0.000, 0, '2023-06-16 10:36:34', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 1200.00, 'Online', '2023-06-14', '', 'gram_charge', 0, 0.00),
(167, 18, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-16 10:36:34', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 1000.00, 'Cash', '2023-06-07', '', 'making_charge', 0, 0.00),
(168, 18, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-16 10:36:34', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 99.00, '', '2023-06-15', '', 'making_charge', 0, 0.00),
(169, 18, NULL, '', 0.00, 'gold', 2.000, 90.00, 0.00, 0.000, 0, '2023-06-16 10:36:34', 0.000, 0.000, '', NULL, NULL, 18, 0.00, 0.00, NULL, '2023-06-19', '', 'gram_charge', 0, 90.00),
(170, 14, NULL, '', 0.00, 'cash', 0.000, 0.00, 0.00, 0.000, 0, '2023-06-16 10:38:38', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 1000.00, 'Online', '2023-06-22', '', 'gram_charge', 0, 0.00),
(223, 19, NULL, '', 0.00, 'cash', 3.571, 100.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 0.000, 0.000, '', NULL, NULL, NULL, 7000.00, 25000.00, 'Cash', '2023-06-19', '', 'gram_charge', 0, 0.00),
(224, 19, NULL, '', 0.00, 'cash', 4.286, 100.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 0.000, 0.000, '', NULL, NULL, NULL, 7000.00, 30000.00, 'Cash', '2023-06-19', '', 'gram_charge', 0, 0.00),
(225, 19, NULL, '', 0.00, 'cash', 0.857, 100.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 0.000, 0.000, '', NULL, NULL, NULL, 7000.00, 6000.00, 'Cash', '2023-06-19', '', 'gram_charge', 0, 0.00),
(226, 19, NULL, '', 0.00, 'cash', 0.429, 100.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 0.000, 0.000, '', NULL, NULL, NULL, 7000.00, 3000.00, 'Cash', '2023-06-19', '', 'gram_charge', 0, 0.00),
(227, 19, NULL, '', 0.00, 'cash', 2.842, 100.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 0.000, 0.000, '', NULL, NULL, NULL, 7000.00, 19894.00, 'Cash', '2023-06-19', '', 'gram_charge', 0, 0.00),
(228, 19, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 250.00, 'Cash', '2023-06-19', '', 'making_charge', 0, 0.00),
(229, 19, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 750.00, 'Cash', '2023-06-19', '', 'making_charge', 0, 0.00),
(230, 19, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 800.00, 'Cash', '2023-06-19', '', 'making_charge', 0, 0.00),
(231, 19, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 450.00, 'Online', '2023-06-19', '', 'making_charge', 0, 0.00),
(232, 19, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 250.00, 'Cash', '2023-06-19', '', 'stone_charge', 0, 0.00),
(233, 19, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 400.00, 'Cash', '2023-06-19', '', 'stone_charge', 0, 0.00),
(234, 19, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 500.00, 'Cash', '2023-06-19', '', 'stone_charge', 0, 0.00),
(235, 19, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 260.00, 'Cash', '2023-06-19', '', 'stone_charge', 0, 0.00),
(236, 19, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 2000.00, 'Cash', '2023-06-19', '', 'stone_charge', 0, 0.00),
(237, 19, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 340.00, 'Cash', '2023-06-19', '', 'stone_charge', 0, 0.00),
(238, 19, NULL, '', 0.00, 'gold', 3.000, 90.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 1.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-06-19', '', 'gram_charge', 0, 90.00),
(239, 19, NULL, '', 0.00, 'gold', 2.000, 90.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 1.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-06-19', '', 'gram_charge', 0, 90.00),
(240, 19, NULL, '', 0.00, 'gold', 3.000, 90.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 2.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-06-19', '', 'gram_charge', 0, 90.00),
(241, 19, NULL, '', 0.00, 'gold', 1.000, 90.00, 0.00, 0.000, 0, '2023-06-19 06:37:46', 0.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-06-19', '', 'gram_charge', 0, 90.00),
(292, 20, NULL, '', 0.00, 'cash', 0.286, 100.00, 0.00, 0.000, 0, '2023-06-19 13:06:15', 0.000, 0.000, '', NULL, NULL, NULL, 7000.00, 2000.00, 'Cash', '2023-06-19', '', 'gram_charge', 0, 0.00),
(293, 20, NULL, '', 0.00, 'cash', 0.429, 100.00, 0.00, 0.000, 0, '2023-06-19 13:06:15', 0.000, 0.000, '', NULL, NULL, NULL, 7000.00, 3000.00, 'Cash', '2023-06-19', '', 'gram_charge', 0, 0.00),
(294, 20, NULL, '', 0.00, 'cash', 1.286, 100.00, 0.00, 0.000, 0, '2023-06-19 13:06:15', 0.000, 0.000, '', NULL, NULL, NULL, 7000.00, 9000.00, 'Cash', '2023-06-19', '', 'gram_charge', 0, 0.00),
(295, 20, NULL, '', 0.00, 'cash', 0.100, 100.00, 0.00, 0.000, 0, '2023-06-19 13:06:15', 0.000, 0.000, '', NULL, NULL, NULL, 7000.00, 700.00, 'Online', '2023-06-19', '', 'gram_charge', 0, 0.00),
(296, 20, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-19 13:06:15', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 5250.00, 'Cash', '2023-06-19', '', 'making_charge', 0, 0.00),
(297, 20, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-19 13:06:15', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 4500.00, 'Online', '2023-06-12', '', 'stone_charge', 0, 0.00),
(298, 20, NULL, '', 0.00, 'gold', 7.000, 100.00, 0.00, 0.000, 0, '2023-06-19 13:06:15', 1.000, 0.000, '', NULL, NULL, 16, 0.00, 0.00, NULL, '2023-06-19', 'receiptgold__1687161108.png', 'gram_charge', 0, 90.00),
(299, 20, NULL, '', 0.00, 'gold', 8.000, 90.00, 0.00, 0.000, 0, '2023-06-19 13:06:15', 1.000, 0.000, '', NULL, NULL, 17, 0.00, 0.00, NULL, '2023-06-19', 'receiptgold__16871611081.png', 'gram_charge', 0, 90.00),
(300, 20, NULL, '', 0.00, 'gold', 9.000, 90.00, 0.00, 0.000, 0, '2023-06-19 13:06:15', 1.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-06-19', 'receipt__1687161217.png', 'gram_charge', 0, 90.00),
(301, 20, NULL, '', 0.00, 'gold', 8.000, 90.00, 0.00, 0.000, 0, '2023-06-19 13:06:15', 1.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-06-19', 'receipt__16871612171.png', 'gram_charge', 0, 90.00),
(302, 20, NULL, '', 0.00, 'gold', 7.043, 100.00, 0.00, 0.000, 0, '2023-06-19 13:06:15', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 0.00, NULL, '2023-06-18', 'receipt__1687179975.png', 'gram_charge', 0, 90.00),
(326, 21, NULL, '', 0.00, 'cash', 0.167, 100.00, 0.00, 0.000, 0, '2023-06-20 06:45:22', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 1000.00, 'Cash', '2023-06-20', '', 'gram_charge', 0, 0.00),
(327, 21, NULL, '', 0.00, 'cash', 0.250, 100.00, 0.00, 0.000, 0, '2023-06-20 06:45:22', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 1500.00, 'Cash', '2023-06-20', '', 'gram_charge', 0, 0.00),
(328, 21, NULL, '', 0.00, 'cash', 0.125, 100.00, 0.00, 0.000, 0, '2023-06-20 06:45:22', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 750.00, 'Cash', '2023-06-20', '', 'gram_charge', 0, 0.00),
(329, 21, NULL, '', 0.00, 'cash', 0.050, 100.00, 0.00, 0.000, 0, '2023-06-20 06:45:22', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 300.00, 'Cash', '2023-06-20', '', 'gram_charge', 0, 0.00),
(330, 21, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-20 06:45:22', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 2500.00, 'Cash', '2023-06-20', '', 'making_charge', 0, 0.00),
(331, 21, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-20 06:45:22', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 3000.00, 'Cash', '2023-06-20', '', 'making_charge', 0, 0.00),
(332, 21, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-20 06:45:22', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 750.00, 'Cash', '2023-06-20', '', 'stone_charge', 0, 0.00),
(333, 21, NULL, '', 0.00, 'gold', 8.000, 90.00, 0.00, 0.000, 0, '2023-06-20 06:45:22', 1.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-06-20', 'receipt__1687243449.png', 'gram_charge', 0, 90.00),
(334, 21, NULL, '', 0.00, 'gold', 15.000, 90.00, 0.00, 0.000, 0, '2023-06-20 06:45:22', 3.000, 0.000, '', NULL, NULL, 4, 0.00, 0.00, NULL, '2023-06-20', 'receipt__16872434491.png', 'gram_charge', 0, 90.00),
(335, 21, NULL, '', 0.00, 'gold', 10.000, 90.00, 0.00, 0.000, 0, '2023-06-20 06:45:22', 0.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-06-20', 'receipt__16872434492.png', 'gram_charge', 0, 90.00),
(336, 23, NULL, '', 0.00, 'cash', 2.000, 100.00, 0.00, 0.000, 0, '2023-06-21 10:16:18', 0.000, 0.000, '', NULL, NULL, NULL, 7000.00, 14000.00, 'Cash', '2023-06-21', '', 'gram_charge', 0, 0.00),
(337, 23, NULL, '', 0.00, 'cash', 3.000, 100.00, 0.00, 0.000, 0, '2023-06-21 10:16:18', 0.000, 0.000, '', NULL, NULL, NULL, 7000.00, 21000.00, '', '2023-06-22', '', 'gram_charge', 0, 0.00),
(338, 23, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-21 10:16:18', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 2000.00, 'Cash', '2023-06-23', '', 'making_charge', 0, 0.00),
(339, 23, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-21 10:16:18', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 2000.00, 'Cash', '2023-06-20', '', 'stone_charge', 0, 0.00),
(340, 23, NULL, '', 0.00, 'gold', 10.000, 90.00, 0.00, 0.000, 0, '2023-06-21 10:16:18', 2.000, 0.000, '', NULL, NULL, 7, 0.00, 0.00, NULL, '2023-06-21', '', 'gram_charge', 0, 90.00),
(364, 24, NULL, '', 0.00, 'cash', 2.000, 100.00, 0.00, 0.000, 0, '2023-06-28 09:47:48', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 10000.00, 'Cash', '2023-06-28', '', 'gram_charge', 0, 0.00),
(365, 24, NULL, '', 0.00, 'cash', 1.000, 100.00, 0.00, 0.000, 0, '2023-06-28 09:47:48', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 5000.00, 'Cash', '2023-06-28', '', 'gram_charge', 0, 0.00),
(366, 24, NULL, '', 0.00, 'cash', 1.000, 100.00, 0.00, 0.000, 0, '2023-06-28 09:47:48', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 5000.00, 'Cash', '2023-06-28', '', 'gram_charge', 0, 0.00),
(367, 24, NULL, '', 0.00, 'cash', 0.600, 100.00, 0.00, 0.000, 0, '2023-06-28 09:47:48', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 3000.00, 'Cash', '2023-06-28', '', 'gram_charge', 0, 0.00),
(368, 24, NULL, '', 0.00, 'cash', 0.980, 100.00, 0.00, 0.000, 0, '2023-06-28 09:47:48', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 4900.00, 'Cash', '2023-06-28', '', 'gram_charge', 0, 0.00),
(369, 24, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-28 09:47:48', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 1000.00, 'Cash', '2023-06-28', '', 'making_charge', 0, 0.00),
(370, 24, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-28 09:47:48', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 1000.00, 'Cash', '2023-06-28', '', 'making_charge', 0, 0.00),
(371, 24, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-28 09:47:48', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 1000.00, 'Cash', '2023-06-28', '', 'making_charge', 0, 0.00),
(372, 24, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-28 09:47:48', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 1500.00, 'Cash', '2023-06-28', '', 'stone_charge', 0, 0.00),
(373, 24, NULL, '', 0.00, 'gold', 5.000, 90.00, 0.00, 0.000, 0, '2023-06-28 09:47:48', 1.000, 0.000, '', NULL, NULL, 7, 0.00, 0.00, NULL, '2023-06-28', 'receiptgold__1687945290.jpg', 'gram_charge', 0, 90.00),
(374, 24, NULL, '', 0.00, 'gold', 15.000, 90.00, 0.00, 0.000, 0, '2023-06-28 09:47:48', 3.000, 0.000, '', NULL, NULL, 19, 0.00, 0.00, NULL, '2023-06-28', 'receiptgold__16879452901.jpg', 'gram_charge', 0, 90.00),
(375, 24, NULL, '', 0.00, 'gold', 30.000, 90.00, 0.00, 0.000, 0, '2023-06-28 09:47:48', 0.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-06-28', 'receipt__16879456031.jpg', 'gram_charge', 0, 90.00),
(376, 25, NULL, '', 0.00, 'cash', 1.000, 100.00, 0.00, 0.000, 0, '2023-06-29 06:23:11', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 6000.00, 'Cash', '2023-06-22', '', 'gram_charge', 0, 0.00),
(377, 25, NULL, '', 0.00, 'cash', 3.000, 100.00, 0.00, 0.000, 0, '2023-06-29 06:23:11', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 18000.00, 'Cash', '2023-06-29', '', 'gram_charge', 0, 0.00),
(378, 25, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-29 06:23:11', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 750.00, 'Cash', '2023-06-21', '', 'making_charge', 0, 0.00),
(379, 25, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-29 06:23:11', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 600.00, 'Cash', '2023-06-23', '', 'making_charge', 0, 0.00),
(380, 25, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-29 06:23:11', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 2000.00, 'Cash', '2023-06-20', '', 'stone_charge', 0, 0.00),
(381, 25, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-29 06:23:11', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 1750.00, 'Online', '2023-06-21', '', 'stone_charge', 0, 0.00),
(382, 25, NULL, '', 0.00, 'gold', 25.000, 80.00, 0.00, 0.000, 0, '2023-06-29 06:23:11', 3.000, 0.000, '', NULL, NULL, 4, 0.00, 0.00, NULL, '2023-06-28', 'receiptgold__1688019791.jpg', 'gram_charge', 0, 90.00),
(383, 25, NULL, '', 0.00, 'gold', 10.000, 90.00, 0.00, 0.000, 0, '2023-06-29 06:23:11', 5.000, 0.000, '', NULL, NULL, 13, 0.00, 0.00, NULL, '2023-06-27', 'receiptgold__1688019791.png', 'gram_charge', 0, 90.00),
(384, 27, NULL, '', 0.00, 'cash', 1.500, 100.00, 0.00, 0.000, 0, '2023-06-29 11:39:23', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 9000.00, 'Cash', '2023-06-29', '', 'gram_charge', 0, 0.00),
(385, 27, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-29 11:39:23', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 3000.00, 'Cash', '2023-06-29', '', 'making_charge', 0, 0.00),
(386, 27, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-29 11:39:23', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 6000.00, 'Cash', '2023-06-29', '', 'stone_charge', 0, 0.00),
(387, 27, NULL, '', 0.00, 'gold', 10.000, 90.00, 0.00, 0.000, 0, '2023-06-29 11:39:23', 1.000, 0.000, '', NULL, NULL, 11, 0.00, 0.00, NULL, '2023-06-29', '', 'gram_charge', 0, 90.00),
(392, 29, NULL, '', 0.00, 'cash', 11.667, 100.00, 0.00, 0.000, 0, '2023-06-30 09:34:30', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 70000.00, 'Cash', '2023-06-30', '', 'gram_charge', 0, 0.00),
(393, 29, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-30 09:34:30', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 5000.00, 'Cash', '2023-06-30', '', 'making_charge', 0, 0.00),
(394, 29, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-06-30 09:34:30', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 3750.00, 'Cash', '2023-06-30', '', 'stone_charge', 0, 0.00),
(395, 29, NULL, '', 0.00, 'gold', 25.000, 90.00, 0.00, 0.000, 0, '2023-06-30 09:34:30', 3.000, 0.000, '', NULL, NULL, 7, 0.00, 0.00, NULL, '2023-06-30', 'receiptgold__1688117580.png', 'gram_charge', 0, 90.00),
(396, 30, NULL, '', 0.00, 'gold', 22.250, 87.30, 0.00, 0.000, 0, '2023-07-14 04:24:28', 0.280, 0.000, '', NULL, NULL, 38, 0.00, 0.00, NULL, '2023-06-29', '', 'gram_charge', 0, 90.00),
(397, 30, NULL, '', 0.00, 'gold', 13.280, 88.00, 0.00, 0.000, 0, '2023-07-14 04:24:28', 0.160, 0.000, '', NULL, NULL, 39, 0.00, 0.00, NULL, '2023-06-29', '', 'gram_charge', 0, 90.00),
(398, 31, NULL, '', 0.00, 'gold', 9.920, 79.00, 0.00, 0.000, 0, '2023-07-14 04:33:57', 0.190, 0.000, 'Without Stones', NULL, NULL, 40, 0.00, 0.00, NULL, '2023-06-29', '', 'gram_charge', 0, 90.00),
(420, 33, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 06:45:55', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 0.00, '', '2023-07-18', '', 'gram_charge', 0, 0.00),
(421, 33, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 06:45:55', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 0.00, '', '2023-07-18', '', 'gram_charge', 0, 0.00),
(422, 33, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 06:45:55', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 0.00, '', '2023-07-13', '', 'gram_charge', 0, 0.00),
(423, 33, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 06:45:55', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 0.00, '', '2023-07-18', '', 'making_charge', 0, 0.00),
(424, 33, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 06:45:55', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 0.00, '', '2023-07-18', '', 'making_charge', 0, 0.00),
(425, 33, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 06:45:55', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 0.00, '', '2023-07-15', '', 'making_charge', 0, 0.00),
(426, 33, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 06:45:55', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 0.00, '', '2023-07-18', '', 'stone_charge', 0, 0.00),
(427, 33, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 06:45:55', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 0.00, '', '2023-07-13', '', 'stone_charge', 0, 0.00),
(428, 33, NULL, '', 0.00, 'gold', 0.000, 0.00, 0.00, 0.000, 0, '2023-07-18 06:45:55', 0.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-07-18', '', 'gram_charge', 0, 90.00),
(429, 33, NULL, '', 0.00, 'gold', 0.000, 0.00, 0.00, 0.000, 0, '2023-07-18 06:45:55', 0.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-07-18', '', 'gram_charge', 0, 90.00),
(430, 33, NULL, '', 0.00, 'gold', 0.000, 0.00, 0.00, 0.000, 0, '2023-07-18 06:45:55', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 0.00, NULL, '2023-07-17', '', 'gram_charge', 0, 90.00),
(435, 34, NULL, '', 0.00, 'cash', 4.167, 100.00, 0.00, 0.000, 0, '2023-07-18 09:11:36', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 25000.00, 'Cash', '2023-07-18', '', 'gram_charge', 0, 0.00),
(436, 34, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 09:11:36', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 125.00, 'Cash', '2023-07-18', '', 'making_charge', 0, 0.00),
(437, 34, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 09:11:36', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 4500.00, 'Cash', '2023-07-18', '', 'stone_charge', 0, 0.00),
(438, 34, NULL, '', 0.00, 'gold', 3.000, 90.00, 0.00, 0.000, 0, '2023-07-18 09:11:36', 1.000, 0.000, '', NULL, NULL, 4, 0.00, 0.00, NULL, '2023-07-18', 'receiptgold__1689667961.jpg', 'gram_charge', 0, 90.00),
(454, 35, NULL, '', 0.00, 'cash', 0.250, 100.00, 0.00, 0.000, 0, '2023-07-18 11:09:27', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 1500.00, 'Online', '2023-07-18', '', 'gram_charge', 0, 0.00),
(455, 35, NULL, '', 0.00, 'cash', 1.333, 100.00, 0.00, 0.000, 0, '2023-07-18 11:09:27', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 8000.00, 'Cash', '2023-07-18', '', 'gram_charge', 0, 0.00),
(456, 35, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 11:09:27', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 5000.00, 'Online', '2023-07-18', '', 'making_charge', 0, 0.00),
(457, 35, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 11:09:27', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 0.00, '', '2023-07-18', '', 'making_charge', 0, 0.00),
(458, 35, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 11:09:27', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 2000.00, 'Cash', '2023-07-18', '', 'stone_charge', 0, 0.00),
(459, 35, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 11:09:27', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 500.00, 'Online', '2023-07-18', '', 'stone_charge', 0, 0.00),
(460, 35, NULL, '', 0.00, 'gold', 5.000, 90.00, 0.00, 0.000, 0, '2023-07-18 11:09:27', 1.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-07-18', 'receiptgold__1689676937.png', 'gram_charge', 0, 90.00),
(461, 35, NULL, '', 0.00, 'gold', 3.000, 90.00, 0.00, 0.000, 0, '2023-07-18 11:09:27', 1.000, 0.000, '', NULL, NULL, 18, 0.00, 0.00, NULL, '2023-07-18', 'receiptgold__1689676937.jpg', 'gram_charge', 0, 90.00),
(462, 35, NULL, '', 0.00, 'gold', 4.000, 90.00, 0.00, 0.000, 0, '2023-07-18 11:09:27', 1.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-07-18', 'receipt__1689677947.jpg', 'gram_charge', 0, 90.00),
(469, 36, NULL, '', 0.00, 'cash', 0.500, 100.00, 0.00, 0.000, 0, '2023-07-18 11:33:22', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 3000.00, 'Cash', '2023-07-18', '', 'gram_charge', 0, 0.00),
(470, 36, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 11:33:22', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 50.00, 'Cash', '2023-07-18', '', 'making_charge', 0, 0.00),
(471, 36, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 11:33:22', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 20.00, 'Cash', '2023-07-13', '', 'making_charge', 0, 0.00),
(472, 36, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 11:33:22', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 2000.00, 'Cash', '2023-07-18', '', 'stone_charge', 0, 0.00),
(473, 36, NULL, '', 0.00, 'gold', 3.000, 90.00, 0.00, 0.000, 0, '2023-07-18 11:33:22', 1.000, 0.000, '', NULL, NULL, 15, 0.00, 0.00, NULL, '2023-07-18', 'receiptgold__1689679785.jpg', 'gram_charge', 0, 90.00),
(474, 36, NULL, '', 0.00, 'gold', 2.000, 90.00, 0.00, 0.000, 0, '2023-07-18 11:33:22', 1.000, 0.000, '', NULL, NULL, NULL, 0.00, 0.00, NULL, '2023-07-11', '', 'gram_charge', 0, 90.00),
(479, 37, NULL, '', 0.00, 'cash', 0.833, 100.00, 0.00, 0.000, 0, '2023-07-18 12:32:51', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 5000.00, 'Cash', '2023-07-18', '', 'gram_charge', 0, 0.00),
(480, 37, NULL, '', 0.00, 'cash', 0.333, 100.00, 0.00, 0.000, 0, '2023-07-18 12:32:51', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 2000.00, 'Online', '2023-07-12', '', 'gram_charge', 0, 0.00),
(481, 37, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 12:32:51', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 3000.00, 'Online', '2023-07-18', '', 'making_charge', 0, 0.00),
(482, 37, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 12:32:51', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 500.00, 'Online', '2023-07-14', '', 'making_charge', 0, 0.00),
(483, 37, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 12:32:51', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 2000.00, 'Cash', '2023-07-18', '', 'stone_charge', 0, 0.00),
(484, 37, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-18 12:32:51', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 750.00, 'Cash', '2023-07-03', '', 'stone_charge', 0, 0.00),
(485, 37, NULL, '', 0.00, 'gold', 10.000, 90.00, 0.00, 0.000, 0, '2023-07-18 12:32:51', 2.000, 0.000, '', NULL, NULL, 18, 0.00, 0.00, NULL, '2023-07-18', 'receiptgold__1689683384.jpg', 'gram_charge', 0, 90.00),
(486, 37, NULL, '', 0.00, 'gold', 7.000, 90.00, 0.00, 0.000, 0, '2023-07-18 12:32:51', 1.000, 0.000, '', NULL, NULL, NULL, 0.00, 0.00, NULL, '2023-07-03', 'receipt__1689683571.jpg', 'gram_charge', 0, 90.00),
(558, 39, NULL, '', 0.00, 'cash', 0.200, 100.00, 0.00, 0.000, 0, '2023-07-20 07:27:38', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 1000.00, 'Cash', '2023-07-20', '', 'gram_charge', 0, 0.00),
(559, 39, NULL, '', 0.00, 'cash', 1.000, 100.00, 0.00, 0.000, 0, '2023-07-20 07:27:38', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 5000.00, 'Cash', '2023-07-20', '', 'gram_charge', 0, 0.00),
(560, 39, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-20 07:27:38', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 6500.00, 'Cash', '2023-07-20', '', 'making_charge', 0, 0.00),
(561, 39, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-20 07:27:38', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 500.00, '', '2023-07-20', '', 'stone_charge', 0, 0.00),
(562, 39, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-20 07:27:38', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 1000.00, '', '2023-07-20', '', 'stone_charge', 0, 0.00),
(563, 39, NULL, '', 0.00, 'gold', 25.000, 90.00, 0.00, 0.000, 0, '2023-07-20 07:27:38', 2.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-07-20', 'receiptgold__1689837031.jpg', 'gram_charge', 1, 90.00),
(564, 39, NULL, '', 0.00, 'gold', 30.000, 90.00, 0.00, 0.000, 0, '2023-07-20 07:27:38', 1.000, 0.000, '', NULL, NULL, 4, 0.00, 0.00, NULL, '2023-07-12', '', 'gram_charge', 1, 90.00),
(569, 40, NULL, '', 0.00, 'cash', 1.000, 100.00, 0.00, 0.000, 0, '2023-07-20 07:40:06', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 5000.00, 'Cash', '2023-07-20', '', 'gram_charge', 0, 0.00),
(570, 40, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-20 07:40:06', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 125.00, 'Cash', '2023-07-20', '', 'making_charge', 0, 0.00),
(571, 40, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-20 07:40:06', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 3750.00, 'Online', '2023-07-20', '', 'stone_charge', 0, 0.00),
(572, 40, NULL, '', 0.00, 'gold', 5.000, 90.00, 0.00, 0.000, 0, '2023-07-20 07:40:06', 1.000, 0.000, '', NULL, NULL, 6, 0.00, 0.00, NULL, '2023-07-20', 'receiptgold__1689838675.jpg', 'gram_charge', 1, 90.00),
(588, 38, NULL, '', 0.00, 'cash', 0.020, 100.00, 0.00, 0.000, 0, '2023-07-20 08:57:46', 0.000, 0.000, 'p', NULL, NULL, NULL, 5000.00, 100.00, 'Cash', '2023-07-20', '', 'gram_charge', 0, 0.00),
(589, 38, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-20 08:57:46', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 99.00, 'Cash', '2023-07-20', '', 'making_charge', 0, 0.00),
(590, 38, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-20 08:57:46', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 98.00, '', '2023-07-16', '', 'stone_charge', 0, 0.00),
(591, 38, NULL, '', 0.00, 'gold', 2.000, 90.00, 0.00, 0.000, 0, '2023-07-20 08:57:46', 0.000, 0.000, '', NULL, NULL, 16, 0.00, 0.00, NULL, '2023-07-20', '', 'gram_charge', 0, 90.00),
(592, 38, NULL, '', 0.00, 'gold', 1.000, 88.00, 0.00, 0.000, 0, '2023-07-20 08:57:46', 0.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-07-20', '', 'gram_charge', 0, 90.00),
(593, 38, NULL, '', 0.00, 'gold', 1.000, 1.00, 0.00, 0.000, 0, '2023-07-20 08:57:46', 0.000, 0.000, '', NULL, NULL, 3, 0.00, 0.00, NULL, '2023-07-20', '', 'gram_charge', 0, 90.00),
(594, 38, NULL, '', 0.00, 'gold', 1.000, 0.00, 0.00, 0.000, 0, '2023-07-20 08:57:46', 0.000, 0.000, '', NULL, NULL, 17, 0.00, 0.00, NULL, '2023-07-20', '', 'gram_charge', 1, 90.00),
(595, 41, NULL, '', 0.00, 'cash', 0.670, 100.00, 0.00, 0.000, 0, '2023-07-21 08:15:23', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 4000.00, 'Cash', '2023-07-21', '', 'gram_charge', 0, 0.00),
(596, 41, NULL, '', 0.00, 'cash', 1.170, 100.00, 0.00, 0.000, 0, '2023-07-21 08:15:23', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 7000.00, 'Online', '2023-07-10', '', 'gram_charge', 0, 0.00),
(597, 41, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-21 08:15:23', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 2000.00, '', '2023-07-03', '', 'making_charge', 0, 0.00),
(598, 41, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-21 08:15:23', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 500.00, '', '2023-07-05', '', 'making_charge', 0, 0.00),
(599, 41, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-21 08:15:23', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 900.00, 'Online', '2023-07-09', '', 'stone_charge', 0, 0.00),
(600, 41, NULL, '', 0.00, 'gold', 60.000, 90.00, 0.00, 0.000, 0, '2023-07-21 08:15:23', 2.000, 0.000, '', NULL, NULL, 9, 0.00, 0.00, NULL, '2023-07-12', '', 'gram_charge', 1, 90.00),
(601, 42, NULL, '', 0.00, 'cash', 1.000, 100.00, 0.00, 0.000, 0, '2023-07-25 08:18:00', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 5000.00, 'Cash', '2023-07-19', '', 'gram_charge', 0, 0.00),
(602, 42, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-25 08:18:00', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 4500.00, 'Cash', '2023-07-14', '', 'making_charge', 0, 0.00),
(603, 42, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-25 08:18:00', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 500.00, 'Cash', '2023-07-07', '', 'stone_charge', 0, 0.00),
(604, 42, NULL, '', 0.00, 'gold', 10.000, 90.00, 0.00, 0.000, 0, '2023-07-25 08:18:00', 1.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-07-18', '', 'gram_charge', 1, 90.00),
(609, 43, NULL, '', 0.00, 'cash', 1.670, 100.00, 0.00, 0.000, 0, '2023-07-27 05:06:00', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 10000.00, 'Cash', '2023-07-26', '', 'gram_charge', 0, 0.00),
(610, 43, NULL, '', 0.00, 'cash', 42.500, 100.00, 0.00, 0.000, 0, '2023-07-27 05:06:00', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 255000.00, 'Cash', '2023-07-27', '', 'gram_charge', 0, 0.00),
(611, 43, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-27 05:06:00', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 6000.00, 'Cash', '2023-07-18', '', 'making_charge', 0, 0.00),
(612, 43, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-07-27 05:06:00', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 3000.00, 'Cash', '2023-07-27', '', 'stone_charge', 0, 0.00),
(613, 43, NULL, '', 0.00, 'gold', 15.000, 90.00, 0.00, 0.000, 0, '2023-07-27 05:06:00', 1.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-07-19', '', 'gram_charge', 1, 90.00),
(615, 26, NULL, '', 0.00, 'gold', 1.000, 0.00, 0.00, 0.000, 0, '2023-07-28 12:55:30', 0.000, 0.000, '', NULL, NULL, 3, 0.00, 0.00, NULL, '2023-07-04', '', 'gram_charge', 0, 90.00),
(616, 26, NULL, '', 0.00, 'gold', 2.000, 0.00, 0.00, 0.000, 0, '2023-07-28 12:55:30', 1.000, 0.000, '', NULL, NULL, 5, 0.00, 0.00, NULL, '2023-07-27', '', 'gram_charge', 0, 90.00),
(617, 44, NULL, '', 0.00, 'cash', 17.540, 100.00, 0.00, 0.000, 0, '2023-07-30 13:00:26', 0.000, 0.000, '', NULL, NULL, NULL, 5700.00, 100000.00, 'Cash', '2023-07-30', '', 'gram_charge', 0, 0.00),
(618, 44, NULL, '', 0.00, 'gold', 10.000, 88.00, 0.00, 0.000, 0, '2023-07-30 13:00:26', 1.000, 0.000, '', NULL, NULL, 6, 0.00, 0.00, NULL, '2023-07-30', '', 'gram_charge', 1, 90.00),
(621, 10, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-08-04 07:15:05', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 100.00, '', '2023-06-16', '', 'gram_charge', 0, 0.00),
(622, 10, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-08-04 07:15:05', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 300.00, '', '2023-06-16', '', 'gram_charge', 0, 0.00),
(623, 10, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-08-04 07:15:05', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 400.00, '', '2023-06-16', '', 'gram_charge', 0, 0.00),
(624, 10, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-08-04 07:15:05', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 700.00, '', '2023-06-16', '', 'gram_charge', 0, 0.00),
(625, 10, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-08-04 07:15:05', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 300.00, 'Cash', '2023-06-20', '', 'gram_charge', 0, 0.00),
(626, 10, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-08-04 07:15:05', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 200.00, 'Cash', '2023-06-13', '', 'gram_charge', 0, 0.00),
(627, 10, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-08-04 07:15:05', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 100.00, 'Cash', '2023-06-21', '', 'gram_charge', 0, 0.00),
(628, 45, NULL, '', 0.00, 'cash', 0.830, 100.00, 0.00, 0.000, 0, '2023-10-16 06:28:34', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 5000.00, 'Cash', '2023-10-16', '', 'gram_charge', 0, 0.00),
(629, 45, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-10-16 06:28:34', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 1000.00, 'Cash', '2023-10-16', '', 'making_charge', 0, 0.00),
(630, 45, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-10-16 06:28:34', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 1000.00, 'Cash', '2023-10-16', '', 'stone_charge', 0, 0.00),
(631, 45, NULL, '', 0.00, 'gold', 5.000, 97.00, 0.00, 0.000, 0, '2023-10-16 06:28:34', 2.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-10-16', '', 'gram_charge', 1, 90.00),
(632, 7, NULL, '', 0.00, 'cash', 0.000, 100.00, 0.00, 0.000, 0, '2023-12-09 07:56:28', 0.000, 0.000, '', NULL, NULL, NULL, 0.00, 400.00, 'Cash', '2023-07-18', '', 'making_charge', 0, 0.00),
(633, 7, NULL, '', 0.00, 'gold', 50.000, 90.00, 0.00, 0.000, 0, '2023-12-09 07:56:28', 10.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-07-12', '', 'gram_charge', 0, 90.00),
(634, 7, NULL, '', 0.00, 'gold', 10.000, 90.00, 0.00, 0.000, 0, '2023-12-09 07:56:28', 1.000, 0.000, '3333', NULL, NULL, 19, 0.00, 0.00, NULL, '2023-12-09', '', 'gram_charge', 0, 90.00);

-- --------------------------------------------------------

--
-- Table structure for table `polish_items`
--

CREATE TABLE `polish_items` (
  `id` bigint(18) NOT NULL,
  `Order_Code` int(10) DEFAULT NULL,
  `Category_ID` int(10) DEFAULT NULL,
  `SubCategory_ID` int(10) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `notes` varchar(300) DEFAULT NULL,
  `approx_grams` double(10,3) DEFAULT '0.000',
  `making_charges` double(10,2) DEFAULT '0.00',
  `wastage` double(10,2) DEFAULT '0.00',
  `Workshop_Code` int(10) DEFAULT NULL,
  `gold_balance` double NOT NULL,
  `nw_after_repair` double NOT NULL,
  `receipt_file` varchar(1000) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','assigned','completed','received') DEFAULT 'pending',
  `order_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `polish_items`
--

INSERT INTO `polish_items` (`id`, `Order_Code`, `Category_ID`, `SubCategory_ID`, `item_id`, `notes`, `approx_grams`, `making_charges`, `wastage`, `Workshop_Code`, `gold_balance`, `nw_after_repair`, `receipt_file`, `Created`, `status`, `order_date`) VALUES
(1, 1, 15, 13, 8, 'To joint Back Chain', 45.000, 500.00, 0.00, 4, 0, 44.8, '', '2023-04-15 20:02:33', 'pending', NULL),
(2, 2, 20, 24, 27, '', 52.500, 1000.00, 0.00, 4, 0, 53, '', '2023-05-16 04:24:57', 'pending', NULL),
(3, 3, 15, 13, 8, '', 20.000, 2300.00, 0.00, 3, 0, 23, '', '2023-05-22 07:26:55', 'pending', NULL),
(6, 5, 18, 22, 19, '', 30.000, 500.00, 0.00, 3, 0, 30, '', '2023-05-24 09:30:47', 'pending', NULL),
(7, 6, 16, 18, 18, '', 35.000, 500.00, 0.00, 3, 0, 36, '', '2023-06-07 08:11:58', 'pending', NULL),
(8, 7, 15, 13, 8, '', 35.000, 2000.00, 0.00, 3, 0, 38, 'receipt__1686648004.jpg', '2023-06-13 09:20:04', 'pending', NULL),
(14, 10, 15, 13, 9, '', 25.000, 1500.00, 0.00, 4, 0, 26, 'receipt__1687159274.png', '2023-06-19 07:23:10', 'completed', NULL),
(15, 10, 16, 17, 16, '', 30.000, 100.00, 0.00, 4, 0, 32, '', '2023-06-19 07:23:10', 'assigned', NULL),
(16, 10, 17, 21, 33, '', 40.000, 1500.00, 0.00, 3, 0, 45, '', '2023-06-19 07:23:10', 'pending', NULL),
(17, 10, 21, 26, 31, '', 20.000, 500.00, 0.00, 4, 0, 22, '', '2023-06-19 07:23:10', 'completed', NULL),
(28, 9, 18, 22, 20, '', 50.000, 2000.00, 0.00, 4, 0, 50, 'receipt__1686907707.jpg', '2023-06-19 07:41:03', 'pending', NULL),
(34, 12, 17, 19, 32, '', 35.000, 500.00, 0.00, 3, 0, 40, 'receipt__1687160761.png', '2023-06-19 13:01:01', 'completed', NULL),
(35, 12, 16, 18, 18, '', 26.000, 800.00, 0.00, 4, 0, 29, 'receipt__1687179661.png', '2023-06-19 13:01:01', 'completed', NULL),
(39, 8, 16, 17, 17, '', 1.000, 100.00, 0.00, 4, 0, 2, 'receipt__1687236756.png', '2023-06-20 04:52:56', 'pending', NULL),
(46, 13, 15, 13, 9, '', 30.000, 900.00, 0.00, 3, 0, 33, 'receipt__1687244295.jpg', '2023-06-20 06:58:15', 'pending', NULL),
(47, 13, 17, 19, 32, '', 20.000, 1500.00, 0.00, 4, 0, 23, 'receipt__1687244295.png', '2023-06-20 06:58:15', 'pending', NULL),
(48, 13, 20, 25, 26, '', 15.000, 500.00, 0.00, 3, 0, 18, 'receipt__16872442951.png', '2023-06-20 06:58:15', 'pending', NULL),
(49, 14, 18, 23, 23, '', 50.000, 2000.00, 0.00, 3, 0, 50, '', '2023-06-24 05:54:01', 'pending', NULL),
(50, 15, 18, 22, 19, '', 50.000, 3000.00, 0.00, 3, 0, 50, '', '2023-06-26 06:03:10', 'pending', NULL),
(51, 15, 0, 0, 0, '', 0.000, 0.00, 0.00, 0, 0, 0, '', '2023-06-26 06:03:10', 'pending', NULL),
(52, 16, 21, 26, 31, '', 15.000, 1500.00, 0.00, 3, 0, 17, 'receipt__1687946000.png', '2023-06-28 09:53:20', 'pending', NULL),
(53, 17, 15, 13, 8, '', 2.000, 890.00, 0.00, 3, 0, 4, '', '2023-06-28 11:59:37', 'pending', NULL),
(55, 18, 15, 13, 8, '', 20.000, 2000.00, 0.00, 3, 0, 22, '', '2023-06-28 15:55:10', 'pending', NULL),
(58, 19, 15, 13, 8, '', 30.000, 1500.00, 0.00, 3, 0, 33, 'receipt__1688019232.png', '2023-06-29 06:14:51', 'pending', NULL),
(60, 20, 16, 17, 16, '', 40.000, 300.00, 0.00, 3, 0, 42, 'receipt__1688019977.jpg', '2023-06-29 06:26:47', 'pending', NULL),
(62, 21, 16, 0, 0, '', 0.000, 0.00, 0.00, 0, 0, 0, '', '2023-07-18 07:19:41', 'pending', NULL),
(63, 22, 16, 17, 17, '', 10.000, 500.00, 0.00, 3, 0, 9.58, '', '2023-10-16 06:32:30', 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `polish_orders`
--

CREATE TABLE `polish_orders` (
  `Order_Code` int(11) NOT NULL,
  `Customer_Code` int(11) NOT NULL,
  `Product_Code` int(11) NOT NULL,
  `Order_Date` varchar(100) NOT NULL,
  `Required_date` varchar(100) NOT NULL,
  `Shipped_date` varchar(100) NOT NULL,
  `Order_Status` enum('pending','ongoing','cancelled','completed','delivered') DEFAULT 'pending',
  `Timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `orderid` varchar(100) DEFAULT NULL,
  `rate_per_gram` double(10,2) DEFAULT '0.00',
  `rate_per_gram_silver` double(10,2) DEFAULT '0.00',
  `metal_type` enum('gold','silver') NOT NULL,
  `order_type` enum('custom jewellery','polish','repair') NOT NULL DEFAULT 'custom jewellery'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `polish_orders`
--

INSERT INTO `polish_orders` (`Order_Code`, `Customer_Code`, `Product_Code`, `Order_Date`, `Required_date`, `Shipped_date`, `Order_Status`, `Timestamp`, `orderid`, `rate_per_gram`, `rate_per_gram_silver`, `metal_type`, `order_type`) VALUES
(7, 33, 0, '2023-06-13', '', '', 'pending', '2023-06-13 14:50:04', 'SP-7/2023', 0.00, 0.00, 'gold', 'polish'),
(8, 32, 0, '2023-06-14', '', '', 'pending', '2023-06-14 18:21:49', 'SP-8/2023', 0.00, 0.00, 'gold', 'polish'),
(12, 33, 0, '2023-06-19', '', '', 'pending', '2023-06-19 13:14:00', 'SP-12/2023', 0.00, 0.00, 'gold', 'polish'),
(13, 33, 0, '2023-06-20', '', '', 'pending', '2023-06-20 12:20:45', 'SP-13/2023', 0.00, 0.00, 'gold', 'polish'),
(14, 30, 0, '2023-06-24', '', '', 'pending', '2023-06-24 11:24:01', 'SP-14/2023', 0.00, 0.00, 'silver', 'polish'),
(15, 30, 0, '2023-06-26', '', '', 'pending', '2023-06-26 11:33:10', 'SP-15/2023', 0.00, 0.00, 'silver', 'polish'),
(16, 33, 0, '2023-06-28', '', '', 'pending', '2023-06-28 15:23:20', 'SP-16/2023', 0.00, 0.00, 'gold', 'polish'),
(17, 32, 0, '2023-06-28', '', '', 'pending', '2023-06-28 17:29:37', 'SP-17/2023', 0.00, 0.00, 'gold', 'polish'),
(18, 33, 0, '2023-06-28', '', '', 'pending', '2023-06-28 21:23:06', 'SP-18/2023', 0.00, 0.00, 'gold', 'polish'),
(19, 33, 0, '2023-06-29', '', '', 'pending', '2023-06-29 11:43:52', 'SP-19/2023', 0.00, 0.00, 'gold', 'polish'),
(20, 33, 0, '2023-06-29', '', '', 'ongoing', '2023-06-29 11:56:17', 'SP-20/2023', 0.00, 0.00, 'gold', 'polish'),
(21, 33, 0, '2023-07-18', '', '', 'pending', '2023-07-18 12:16:40', 'SP-21/2023', 0.00, 0.00, 'gold', 'polish'),
(22, 39, 0, '2023-10-16', '', '', 'pending', '2023-10-16 12:02:30', 'SP-22/2023', 0.00, 0.00, 'gold', 'polish');

-- --------------------------------------------------------

--
-- Table structure for table `polish_payments`
--

CREATE TABLE `polish_payments` (
  `Payment_code` int(11) NOT NULL,
  `Order_Code` int(11) NOT NULL,
  `Customer_Code` int(8) DEFAULT NULL,
  `Date_Of_Order` varchar(100) NOT NULL,
  `Purity` float(8,2) DEFAULT '0.00',
  `Payment_Method` enum('gold','cash','silver') DEFAULT NULL,
  `Grams` float(8,2) DEFAULT '0.00',
  `Quality` float(8,2) DEFAULT '0.00',
  `Amount` double(10,2) DEFAULT '0.00',
  `Total_gold` float(8,2) DEFAULT '0.00',
  `Payment_Status` tinyint(1) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `melting_loss` float(8,2) DEFAULT '0.00',
  `copper` float(8,2) DEFAULT '0.00',
  `notes` varchar(300) DEFAULT NULL,
  `Category_ID` int(8) DEFAULT NULL,
  `SubCategory_ID` int(8) DEFAULT NULL,
  `rate_per_gram` double(10,2) DEFAULT '0.00',
  `total_amount` double(10,2) DEFAULT '0.00',
  `txn_type` enum('Cash','Online','Cheque','') DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `receipt_file` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `polish_payments`
--

INSERT INTO `polish_payments` (`Payment_code`, `Order_Code`, `Customer_Code`, `Date_Of_Order`, `Purity`, `Payment_Method`, `Grams`, `Quality`, `Amount`, `Total_gold`, `Payment_Status`, `Timestamp`, `melting_loss`, `copper`, `notes`, `Category_ID`, `SubCategory_ID`, `rate_per_gram`, `total_amount`, `txn_type`, `payment_date`, `receipt_file`) VALUES
(1, 16, NULL, '', 0.00, 'cash', 0.00, 0.00, 0.00, 0.00, 0, '2023-06-28 09:53:20', 0.00, 0.00, '', NULL, NULL, 0.00, 20000.00, 'Cash', '2023-06-21', ''),
(2, 16, NULL, '', 0.00, 'cash', 0.00, 0.00, 0.00, 0.00, 0, '2023-06-28 09:53:20', 0.00, 0.00, '', NULL, NULL, 0.00, 20000.00, 'Cash', '2023-06-22', ''),
(3, 16, NULL, '', 0.00, 'cash', 0.00, 0.00, 0.00, 0.00, 0, '2023-06-28 09:53:20', 0.00, 0.00, '', NULL, NULL, 0.00, 3500.00, 'Cash', '2023-06-27', ''),
(4, 16, NULL, '', 0.00, 'cash', 0.00, 0.00, 0.00, 0.00, 0, '2023-06-28 09:53:20', 0.00, 0.00, '', NULL, NULL, 0.00, 10000.00, 'Cash', '2023-06-26', ''),
(5, 16, NULL, '', 0.00, 'cash', 0.00, 0.00, 0.00, 0.00, 0, '2023-06-28 09:53:20', 0.00, 0.00, '', NULL, NULL, 0.00, 33000.00, 'Cash', '2023-06-26', ''),
(6, 17, NULL, '', 0.00, 'cash', 0.00, 0.00, 0.00, 0.00, 0, '2023-06-28 11:59:37', 0.00, 0.00, '', NULL, NULL, 0.00, 6.00, 'Cash', '2023-06-28', ''),
(12, 20, NULL, '', 0.00, 'cash', 0.00, 100.00, 0.00, 0.00, 0, '2023-06-29 06:26:47', 0.00, 0.00, '', NULL, NULL, 0.00, 50.00, NULL, '2023-06-29', ''),
(14, 21, NULL, '', 0.00, 'cash', 0.00, 100.00, 0.00, 0.00, 0, '2023-07-18 07:19:41', 0.00, 0.00, '', NULL, NULL, 0.00, 0.00, NULL, '2023-07-18', ''),
(15, 21, NULL, '', 0.00, 'cash', 0.00, 0.00, 0.00, 0.00, 0, '2023-07-18 07:19:41', 0.00, 0.00, '', NULL, NULL, 6000.00, 0.00, '', '2023-07-12', ''),
(16, 22, NULL, '', 0.00, 'cash', 0.00, 0.00, 0.00, 0.00, 0, '2023-10-16 06:32:30', 0.00, 0.00, '', NULL, NULL, 0.00, 500.00, 'Cash', '2023-10-16', '');

-- --------------------------------------------------------

--
-- Table structure for table `pricebreakup`
--

CREATE TABLE `pricebreakup` (
  `Price_Code` int(11) NOT NULL,
  `Order_Code` int(11) NOT NULL,
  `Making_ChargesInPercent` varchar(100) NOT NULL,
  `Making_Charge_GSTInPercent` varchar(100) NOT NULL,
  `Gold_GSTInPercent` varchar(100) NOT NULL,
  `Gold_Total` varchar(100) NOT NULL,
  `WeightInGram` varchar(100) NOT NULL,
  `NetWeightInGram` varchar(100) NOT NULL,
  `TodaysRatePerGram_ID` bigint(11) NOT NULL,
  `WastageInPercent` varchar(100) NOT NULL,
  `WeightOfWastageInGram` varchar(100) NOT NULL,
  `Making_total` varchar(100) NOT NULL,
  `Wastage_total` varchar(100) NOT NULL,
  `SubTotal` varchar(100) NOT NULL,
  `Discount_On_Selling_Price` float NOT NULL,
  `SubTotal_After_Discount` float NOT NULL,
  `Grand_Total` float NOT NULL,
  `Timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pricebreakup`
--

INSERT INTO `pricebreakup` (`Price_Code`, `Order_Code`, `Making_ChargesInPercent`, `Making_Charge_GSTInPercent`, `Gold_GSTInPercent`, `Gold_Total`, `WeightInGram`, `NetWeightInGram`, `TodaysRatePerGram_ID`, `WastageInPercent`, `WeightOfWastageInGram`, `Making_total`, `Wastage_total`, `SubTotal`, `Discount_On_Selling_Price`, `SubTotal_After_Discount`, `Grand_Total`, `Timestamp`) VALUES
(1, 1, '15', '6', '6', '43460', '10', '2', 4100, '2', '0.2', '6757.5', '820', '50217.5', 0.5, 49966.4, 49966.4, '2021-07-01 07:33:27'),
(2, 2, '15', '6', '6', '43460', '10', '3', 4100, '3', '0.3', '6598.5', '1230', '50058.5', 0.1, 50008.4, 50008.4, '2021-02-26 15:13:34');

-- --------------------------------------------------------

--
-- Table structure for table `productimages`
--

CREATE TABLE `productimages` (
  `ProductImage_Id` int(11) NOT NULL,
  `Product_Code` int(11) NOT NULL,
  `ProductImage` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productimages`
--

INSERT INTO `productimages` (`ProductImage_Id`, `Product_Code`, `ProductImage`, `Timestamp`) VALUES
(2, 1, 'gallery/Untitled.png', '2021-07-01 02:02:35'),
(3, 2, 'gallery/81aUa3LrDzL._UL1500_.jpg', '2021-07-14 13:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `productitems`
--

CREATE TABLE `productitems` (
  `ProductItem_Code` int(11) NOT NULL,
  `Order_Code` int(11) NOT NULL,
  `Item_Code` int(11) NOT NULL,
  `ProductItem_Price` float NOT NULL,
  `ProductItem_WeightInGram` bigint(20) NOT NULL,
  `Timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productitems`
--

INSERT INTO `productitems` (`ProductItem_Code`, `Order_Code`, `Item_Code`, `ProductItem_Price`, `ProductItem_WeightInGram`, `Timestamp`) VALUES
(1, 1, 2, 500, 10, '2021-07-01 07:33:27'),
(2, 2, 1, 1000, 15, '2021-02-26 10:49:43'),
(3, 2, 2, 500, 10, '2021-02-26 15:13:34'),
(4, 1, 1, 1000, 5, '2021-07-01 07:33:27');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Product_Code` int(11) NOT NULL,
  `Category_ID` int(11) NOT NULL,
  `SubCategory_ID` int(11) NOT NULL,
  `Product_Stock_No` varchar(100) NOT NULL,
  `Product_Brand_Name` varchar(100) NOT NULL,
  `Product_Approximate_Metal_Weight` varchar(100) NOT NULL,
  `Product_Size` int(10) NOT NULL,
  `Product_Height` varchar(50) NOT NULL,
  `Product_Width` varchar(50) NOT NULL,
  `Product_Shape` varchar(50) NOT NULL,
  `Product_Purity` varchar(50) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Product_Code`, `Category_ID`, `SubCategory_ID`, `Product_Stock_No`, `Product_Brand_Name`, `Product_Approximate_Metal_Weight`, `Product_Size`, `Product_Height`, `Product_Width`, `Product_Shape`, `Product_Purity`, `Timestamp`) VALUES
(1, 1, 1, '154896gh', 'laksmi', '15', 10, '10', '20', 'triangle', '', '2021-02-25 04:36:35'),
(2, 3, 2, '1234', 'Abstract Design Functional Wear', '10', 10, '20', '30', 'chain', '', '2021-07-14 13:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `repair_items`
--

CREATE TABLE `repair_items` (
  `id` bigint(18) NOT NULL,
  `Order_Code` int(10) DEFAULT NULL,
  `Category_ID` int(10) DEFAULT NULL,
  `SubCategory_ID` int(10) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `notes` varchar(300) DEFAULT NULL,
  `approx_grams` double(10,3) DEFAULT '0.000',
  `making_charges` double(10,2) DEFAULT '0.00',
  `wastage` double(10,3) DEFAULT '0.000',
  `Workshop_Code` int(10) DEFAULT NULL,
  `gold_balance` double(15,3) NOT NULL,
  `nw_after_repair` double(15,3) NOT NULL,
  `receipt_file` varchar(1000) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','assigned','completed','received') DEFAULT 'pending',
  `order_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `repair_items`
--

INSERT INTO `repair_items` (`id`, `Order_Code`, `Category_ID`, `SubCategory_ID`, `item_id`, `notes`, `approx_grams`, `making_charges`, `wastage`, `Workshop_Code`, `gold_balance`, `nw_after_repair`, `receipt_file`, `Created`, `status`, `order_date`) VALUES
(2, 1, 9, 7, 5, '', 12.000, 120.00, 5.000, 1, 7.000, 14.000, '', '2023-01-04 09:22:32', 'pending', NULL),
(3, 2, 20, 24, 27, '', 10.000, 500.00, 1.000, 3, 3.000, 12.000, '', '2023-05-22 07:29:59', 'pending', NULL),
(5, 3, 17, 19, 32, '', 50.000, 0.00, 5.000, 3, 6.000, 51.000, '', '2023-06-07 09:45:09', 'pending', NULL),
(6, 3, 15, 13, 8, '', 40.000, 0.00, 12.000, 3, 0.000, 41.000, '', '2023-06-07 09:45:09', '', NULL),
(13, 5, 15, 13, 8, '', 25.000, 1000.00, 12.000, 3, 13.000, 26.000, '', '2023-06-07 10:08:47', 'pending', NULL),
(14, 4, 15, 13, 8, '', 50.000, 500.00, 5.000, 4, 6.000, 51.000, '', '2023-06-07 10:09:57', 'pending', NULL),
(15, 4, 16, 18, 18, '', 30.000, 100.00, 10.000, 3, 0.000, 35.000, '', '2023-06-07 10:09:57', '', NULL),
(20, 7, 16, 17, 16, '', 11.000, 1000.00, 4.000, 4, 5.000, 12.000, '', '2023-06-12 05:23:56', 'pending', NULL),
(21, 8, 16, 17, 16, '', 45.000, 1500.00, 8.000, 3, 10.000, 47.000, '', '2023-06-12 09:44:48', 'pending', NULL),
(22, 9, 15, 13, 8, '', 30.000, 2000.00, 12.000, 3, 14.000, 32.000, '', '2023-06-14 06:19:40', 'pending', NULL),
(23, 9, 16, 17, 16, '', 35.000, 900.00, 8.000, 4, 13.000, 40.000, '', '2023-06-14 06:19:40', 'pending', NULL),
(27, 10, 17, 19, 32, '', 35.000, 150.00, 2.000, 3, 4.000, 37.000, '', '2023-06-16 09:55:52', 'pending', NULL),
(30, 11, 15, 13, 8, '', 30.000, 2000.00, 12.000, 4, 17.000, 35.000, '', '2023-06-16 10:01:44', 'pending', NULL),
(31, 11, 16, 17, 17, '', 45.000, 2000.00, 9.000, 4, 14.000, 50.000, '', '2023-06-16 10:01:44', 'pending', NULL),
(32, 12, 18, 22, 19, '', 35.000, 300.00, 8.000, 4, 10.000, 37.000, 'receipt__1686909870.png', '2023-06-16 10:04:30', 'pending', NULL),
(33, 12, 18, 23, 23, '', 45.000, 200.00, 12.000, 3, 14.000, 47.000, 'receipt__16869098701.png', '2023-06-16 10:04:30', 'pending', NULL),
(37, 15, 16, 17, 16, '', 3.000, 0.00, 8.000, 3, 9.000, 4.000, '', '2023-06-16 10:50:52', 'pending', NULL),
(40, 13, 16, 18, 18, '', 35.000, 1500.00, 10.000, 4, 12.000, 37.000, '', '2023-06-19 08:07:42', 'pending', NULL),
(53, 17, 16, 17, 16, '', 25.000, 600.00, 8.000, 4, 9.000, 26.000, '', '2023-06-19 12:58:38', 'pending', NULL),
(54, 17, 17, 19, 32, '', 16.000, 800.00, 5.000, 4, 6.000, 17.000, '', '2023-06-19 12:58:38', 'pending', NULL),
(55, 6, 15, 13, 8, '', 37.000, 1000.00, 12.000, 3, 15.000, 40.000, 'receipt__1686219554.jpg', '2023-06-20 04:39:58', 'pending', NULL),
(56, 6, 0, 0, 0, '', 1.000, 0.00, 1.000, 0, 11.000, 11.000, '', '2023-06-20 04:39:58', '', NULL),
(57, 6, 0, 0, 0, '', 1.000, 0.00, 1.000, 0, 11.000, 11.000, '', '2023-06-20 04:39:58', '', NULL),
(58, 6, 0, 0, 0, '', 1.000, 1.00, 1.000, 0, 11.000, 11.000, '', '2023-06-20 04:39:58', '', NULL),
(59, 16, 16, 17, 16, '', 50.000, 1500.00, 8.000, 3, 10.000, 52.000, 'receipt__1687236298.png', '2023-06-20 04:44:58', 'pending', NULL),
(60, 16, 20, 25, 28, '', 30.000, 900.00, 0.000, 4, 2.000, 32.000, '', '2023-06-20 04:44:58', 'pending', NULL),
(61, 16, 0, 0, 0, '', 0.000, 0.00, 0.000, 0, 0.000, 0.000, 'receipt__16872362981.png', '2023-06-20 04:44:58', '', NULL),
(64, 18, 15, 14, 10, '', 60.000, 1500.00, 8.000, 4, 13.000, 65.000, 'receipt__1687244615.png', '2023-06-20 07:04:25', 'pending', NULL),
(65, 18, 20, 25, 26, '', 10.000, 500.00, 1.000, 4, 6.000, 15.000, 'receipt__1687244615.jpg', '2023-06-20 07:04:25', 'pending', NULL),
(67, 19, 15, 13, 9, 'Disco Chain', 25.000, 0.00, 12.000, 3, 15.000, 28.000, '', '2023-06-26 07:42:26', 'pending', NULL),
(68, 20, 17, 19, 32, '', 30.000, 200.00, 2.000, 3, 6.000, 34.000, '', '2023-06-28 10:43:45', 'pending', NULL),
(69, 21, 15, 13, 9, '', 30.000, 700.00, 1.000, 4, 4.000, 33.000, 'receipt__1688020200.png', '2023-06-29 06:30:00', 'pending', NULL),
(70, 22, 20, 25, 28, '', 4.500, 0.00, 0.000, 3, 0.000, 4.500, '', '2023-07-14 05:23:04', 'pending', NULL),
(71, 14, 16, 17, 17, '', 2.000, 0.00, 5.000, 3, 6.000, 3.000, '', '2023-07-26 12:42:15', 'pending', NULL),
(72, 23, 15, 13, 8, '', 30.000, 1500.00, 4.000, 3, 9.000, 35.000, '', '2023-07-27 07:28:04', 'pending', NULL),
(73, 24, 15, 13, 8, '', 15.000, 1000.00, 0.000, 3, 5.000, 20.000, '', '2023-10-16 06:35:45', 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `repair_orders`
--

CREATE TABLE `repair_orders` (
  `Order_Code` int(11) NOT NULL,
  `Customer_Code` int(11) NOT NULL,
  `Product_Code` int(11) NOT NULL,
  `Order_Date` varchar(100) NOT NULL,
  `Required_date` varchar(100) NOT NULL,
  `Shipped_date` varchar(100) NOT NULL,
  `Order_Status` enum('pending','ongoing','cancelled','completed','delivered') DEFAULT 'pending',
  `Timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `orderid` varchar(100) DEFAULT NULL,
  `rate_per_gram` double(10,2) DEFAULT '0.00',
  `rate_per_gram_silver` double(10,2) DEFAULT '0.00',
  `metal_type` enum('gold','silver') NOT NULL,
  `order_type` enum('custom jewellery','polish','repair') NOT NULL DEFAULT 'custom jewellery'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repair_orders`
--

INSERT INTO `repair_orders` (`Order_Code`, `Customer_Code`, `Product_Code`, `Order_Date`, `Required_date`, `Shipped_date`, `Order_Status`, `Timestamp`, `orderid`, `rate_per_gram`, `rate_per_gram_silver`, `metal_type`, `order_type`) VALUES
(1, 12, 0, '2023-01-04', '', '', 'pending', '2023-01-04 14:50:24', 'SR-1/2023', 45.00, 40.00, 'gold', 'repair'),
(8, 33, 0, '2023-06-12', '', '', 'pending', '2023-06-12 15:14:48', 'SR-8/2023', 10000.00, 0.00, 'gold', 'repair'),
(9, 33, 0, '2023-06-14', '', '', 'pending', '2023-06-14 11:49:40', 'SR-9/2023', 6000.00, 0.00, 'gold', 'repair'),
(10, 33, 0, '2023-06-16', '', '', 'pending', '2023-06-16 15:23:57', 'SR-10/2023', 5000.00, 73.00, 'gold', 'repair'),
(11, 33, 0, '2023-06-16', '', '', 'pending', '2023-06-16 15:29:10', 'SR-11/2023', 5000.00, 73.00, 'gold', 'repair'),
(12, 33, 0, '2023-06-16', '', '', 'pending', '2023-06-16 15:34:30', 'SR-12/2023', 73.00, 73.00, 'silver', 'repair'),
(13, 33, 0, '2023-06-16', '', '', 'pending', '2023-06-16 15:37:06', 'SR-13/2023', 5000.00, 73.00, 'gold', 'repair'),
(14, 32, 0, '2023-06-16', '', '', 'pending', '2023-06-16 16:08:38', 'SR-14/2023', 5000.00, 73.00, 'gold', 'repair'),
(16, 33, 0, '2023-06-19', '', '', 'completed', '2023-06-19 13:39:58', 'SR-16/2023', 7000.00, 0.00, 'gold', 'repair'),
(17, 33, 0, '2023-06-19', '', '', 'pending', '2023-06-19 18:27:33', 'SR-17/2023', 7000.00, 0.00, 'gold', 'repair'),
(18, 33, 0, '2023-06-20', '', '', 'pending', '2023-06-20 12:33:35', 'SR-18/2023', 6000.00, 0.00, 'gold', 'repair'),
(19, 30, 0, '2023-06-26', '', '', 'pending', '2023-06-26 11:14:55', 'SR-19/2023', 7400.00, 0.00, 'gold', 'repair'),
(20, 33, 0, '2023-06-28', '', '', 'pending', '2023-06-28 16:13:45', 'SR-20/2023', 5000.00, 0.00, 'gold', 'repair'),
(21, 33, 0, '2023-06-29', '', '', 'pending', '2023-06-29 12:00:00', 'SR-21/2023', 6000.00, 0.00, 'gold', 'repair'),
(22, 38, 0, '2023-07-14', '', '', 'pending', '2023-07-14 10:53:04', 'SR-22/2023', 5720.00, 0.00, 'gold', 'repair'),
(23, 33, 0, '2023-07-27', '', '', 'pending', '2023-07-27 12:58:04', 'SR-23/2023', 6000.00, 0.00, 'gold', 'repair'),
(24, 39, 0, '2023-10-16', '', '', 'pending', '2023-10-16 12:05:45', 'SR-24/2023', 6000.00, 0.00, 'gold', 'repair');

-- --------------------------------------------------------

--
-- Table structure for table `repair_payments`
--

CREATE TABLE `repair_payments` (
  `Payment_code` int(11) NOT NULL,
  `Order_Code` int(11) NOT NULL,
  `Customer_Code` int(8) DEFAULT NULL,
  `Date_Of_Order` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Purity` float(8,2) DEFAULT '0.00',
  `Payment_Method` enum('gold','cash','silver') DEFAULT NULL,
  `Grams` double(10,3) DEFAULT '0.000',
  `Quality` float(8,2) DEFAULT '0.00',
  `Amount` double(10,2) DEFAULT '0.00',
  `Total_gold` float(8,2) DEFAULT '0.00',
  `Payment_Status` tinyint(1) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `melting_loss` double(8,3) DEFAULT '0.000',
  `copper` double(8,3) DEFAULT '0.000',
  `notes` varchar(300) DEFAULT NULL,
  `Category_ID` int(8) DEFAULT NULL,
  `SubCategory_ID` int(8) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `rate_per_gram` double(10,2) DEFAULT '0.00',
  `total_amount` double(10,2) DEFAULT '0.00',
  `txn_type` enum('Cash','Online','Cheque','') DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `receipt_file` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repair_payments`
--

INSERT INTO `repair_payments` (`Payment_code`, `Order_Code`, `Customer_Code`, `Date_Of_Order`, `Purity`, `Payment_Method`, `Grams`, `Quality`, `Amount`, `Total_gold`, `Payment_Status`, `Timestamp`, `melting_loss`, `copper`, `notes`, `Category_ID`, `SubCategory_ID`, `item_id`, `rate_per_gram`, `total_amount`, `txn_type`, `payment_date`, `receipt_file`) VALUES
(1, 15, NULL, '2023-06-16 16:20:52', 0.00, 'cash', 0.000, 0.00, 0.00, 0.00, 0, '2023-06-16 10:50:52', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 2000.00, 'Online', '2023-06-16', NULL),
(2, 15, NULL, '2023-06-16 16:20:52', 0.00, 'cash', 0.000, 0.00, 0.00, 0.00, 0, '2023-06-16 10:50:52', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 1000.00, 'Cash', '2023-06-16', NULL),
(5, 13, NULL, '2023-06-19 13:37:42', 0.00, 'cash', 0.000, 100.00, 0.00, 0.00, 0, '2023-06-19 08:07:42', 0.000, 0.000, '', NULL, NULL, NULL, 7000.00, 61500.00, NULL, '2023-06-19', NULL),
(29, 17, NULL, '2023-06-19 18:28:38', 0.00, 'cash', 0.000, 100.00, 0.00, 0.00, 0, '2023-06-19 12:58:38', 0.000, 0.000, '', NULL, NULL, NULL, 7000.00, 30000.00, NULL, '2023-06-19', NULL),
(30, 17, NULL, '2023-06-19 18:28:38', 0.00, 'cash', 0.000, 100.00, 0.00, 0.00, 0, '2023-06-19 12:58:38', 0.000, 0.000, '', NULL, NULL, NULL, 7000.00, 450.00, NULL, '2023-06-19', NULL),
(31, 16, NULL, '2023-06-20 10:14:58', 0.00, 'cash', 0.000, 100.00, 0.00, 0.00, 0, '2023-06-20 04:44:58', 0.000, 0.000, '', NULL, NULL, NULL, 7000.00, 200.00, NULL, '2023-06-20', NULL),
(32, 16, NULL, '2023-06-20 10:14:58', 0.00, 'cash', 0.000, 100.00, 0.00, 0.00, 0, '2023-06-20 04:44:58', 0.000, 0.000, '', NULL, NULL, NULL, 7000.00, 1500.00, NULL, '2023-06-20', NULL),
(36, 18, NULL, '2023-06-20 12:34:25', 0.00, 'cash', 0.000, 100.00, 0.00, 0.00, 0, '2023-06-20 07:04:25', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 20000.00, NULL, '2023-06-20', NULL),
(37, 18, NULL, '2023-06-20 12:34:25', 0.00, 'cash', 0.000, 100.00, 0.00, 0.00, 0, '2023-06-20 07:04:25', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 45000.00, NULL, '2023-06-20', NULL),
(38, 18, NULL, '2023-06-20 12:34:25', 0.00, 'cash', 0.000, 0.00, 0.00, 0.00, 0, '2023-06-20 07:04:25', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 30000.00, 'Online', '2023-06-19', NULL),
(39, 18, NULL, '2023-06-20 12:34:25', 0.00, 'cash', 0.000, 0.00, 0.00, 0.00, 0, '2023-06-20 07:04:25', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 12000.00, 'Cash', '2023-06-20', NULL),
(40, 20, NULL, '2023-06-28 16:13:45', 0.00, 'cash', 0.000, 0.00, 0.00, 0.00, 0, '2023-06-28 10:43:45', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 28000.00, 'Online', '2023-06-20', NULL),
(41, 21, NULL, '2023-06-29 12:00:00', 0.00, 'cash', 0.000, 0.00, 0.00, 0.00, 0, '2023-06-29 06:30:00', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 2000.00, 'Cash', '2023-06-28', NULL),
(42, 21, NULL, '2023-06-29 12:00:00', 0.00, 'cash', 0.000, 0.00, 0.00, 0.00, 0, '2023-06-29 06:30:00', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 4000.00, 'Cash', '2023-06-12', NULL),
(43, 21, NULL, '2023-06-29 12:00:00', 0.00, 'cash', 0.000, 0.00, 0.00, 0.00, 0, '2023-06-29 06:30:00', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 6000.00, 'Cash', '2023-06-22', NULL),
(44, 21, NULL, '2023-06-29 12:00:00', 0.00, 'cash', 0.000, 0.00, 0.00, 0.00, 0, '2023-06-29 06:30:00', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 800.00, 'Cash', '2023-06-29', NULL),
(45, 21, NULL, '2023-06-29 12:00:00', 0.00, 'cash', 0.000, 0.00, 0.00, 0.00, 0, '2023-06-29 06:30:00', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 7000.00, 'Online', '2023-06-20', NULL),
(46, 21, NULL, '2023-06-29 12:00:00', 0.00, 'cash', 0.000, 0.00, 0.00, 0.00, 0, '2023-06-29 06:30:00', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 4900.00, 'Cash', '2023-06-28', NULL),
(47, 14, NULL, '2023-07-26 18:12:15', 0.00, 'cash', 0.000, 0.00, 0.00, 0.00, 0, '2023-07-26 12:42:15', 0.000, 0.000, '', NULL, NULL, NULL, 5000.00, 750.00, 'Online', '2023-07-04', NULL),
(48, 14, NULL, '2023-07-26 18:12:15', 0.00, 'gold', 4.000, 90.00, 0.00, 0.00, 0, '2023-07-26 12:42:15', 0.000, 0.000, '', NULL, NULL, 3, 0.00, 0.00, NULL, '2023-07-19', NULL),
(49, 23, NULL, '2023-07-27 12:58:04', 0.00, 'cash', 0.000, 0.00, 0.00, 0.00, 0, '2023-07-27 07:28:04', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 10000.00, 'Cash', '2023-07-26', NULL),
(50, 23, NULL, '2023-07-27 12:58:04', 0.00, 'gold', 10.000, 90.00, 0.00, 0.00, 0, '2023-07-27 07:28:04', 1.000, 0.000, '', NULL, NULL, 3, 0.00, 0.00, NULL, '2023-07-19', NULL),
(51, 24, NULL, '2023-10-16 12:05:45', 0.00, 'cash', 0.000, 0.00, 0.00, 0.00, 0, '2023-10-16 06:35:45', 0.000, 0.000, '', NULL, NULL, NULL, 6000.00, 994.00, 'Cash', '2023-10-16', NULL),
(52, 24, NULL, '2023-10-16 12:05:45', 0.00, 'gold', 2.000, 98.00, 0.00, 0.00, 0, '2023-10-16 06:35:45', 1.000, 0.000, '', NULL, NULL, 2, 0.00, 0.00, NULL, '2023-10-16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stone_inventory_passbook`
--

CREATE TABLE `stone_inventory_passbook` (
  `id` int(10) NOT NULL,
  `stone_item_id` int(10) DEFAULT NULL,
  `quantity` int(10) DEFAULT '0',
  `txn_type` enum('c','d') COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stone_inventory_passbook`
--

INSERT INTO `stone_inventory_passbook` (`id`, `stone_item_id`, `quantity`, `txn_type`, `remarks`, `created`) VALUES
(1, 9, 10, 'c', '', '2023-11-02 07:13:13'),
(2, 9, 5, 'd', '', '2023-11-02 07:13:33');

-- --------------------------------------------------------

--
-- Table structure for table `stone_items`
--

CREATE TABLE `stone_items` (
  `id` int(10) NOT NULL,
  `stone_type_id` int(10) DEFAULT NULL,
  `stone_subtype_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `grams` double(10,2) DEFAULT '0.00',
  `carat` double(10,2) DEFAULT '0.00',
  `numbers` double(10,2) DEFAULT '0.00',
  `cents` double(10,2) DEFAULT '0.00',
  `rate` double(10,2) DEFAULT '0.00',
  `unit` enum('Cent','Number','Carat') DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `available_quantity` int(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stone_items`
--

INSERT INTO `stone_items` (`id`, `stone_type_id`, `stone_subtype_id`, `name`, `grams`, `carat`, `numbers`, `cents`, `rate`, `unit`, `created`, `available_quantity`) VALUES
(2, 1, 4, 'Real Stones', NULL, NULL, NULL, NULL, 45.00, 'Cent', '2022-11-17 15:54:41', 0),
(4, 6, 12, 'D-I Diamond', NULL, NULL, NULL, NULL, 76000.00, 'Carat', '2022-12-15 07:52:23', 0),
(5, 7, 13, 'AD  ', NULL, NULL, NULL, NULL, 250.00, 'Carat', '2023-05-16 03:32:55', 0),
(6, 7, 13, 'AD Green', NULL, NULL, NULL, NULL, 250.00, 'Carat', '2023-05-16 03:33:28', 0),
(7, 7, 13, 'RED ', NULL, NULL, NULL, NULL, 25.00, 'Number', '2023-05-16 03:34:00', 0),
(8, 7, 13, 'AD Tilak', NULL, NULL, NULL, NULL, 75.00, 'Number', '2023-05-16 03:34:40', 0),
(9, 2, 14, 'ERKA RUBY', NULL, NULL, NULL, NULL, 750.00, 'Carat', '2023-05-16 03:40:29', 5),
(10, 2, 14, 'ERKA RUBY TILAK', NULL, NULL, NULL, NULL, 1150.00, 'Carat', '2023-05-16 03:41:15', 0),
(11, 2, 14, 'ERKA RUBY OVAL', NULL, NULL, NULL, NULL, 1250.00, 'Carat', '2023-05-16 03:42:10', 0),
(12, 2, 14, 'Burma Ruby', NULL, NULL, NULL, NULL, 1000.00, 'Carat', '2023-05-16 06:32:25', 0),
(13, 1, 15, 'Real diamond', NULL, NULL, NULL, NULL, 65000.00, 'Carat', '2023-05-16 06:39:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stone_sub_type`
--

CREATE TABLE `stone_sub_type` (
  `id` int(10) NOT NULL,
  `stone_type_id` int(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `grams` double(10,2) DEFAULT '0.00',
  `carat` double(10,2) DEFAULT '0.00',
  `numbers` double(10,2) DEFAULT '0.00',
  `cents` double(10,2) DEFAULT '0.00',
  `rate` double(10,2) DEFAULT '0.00',
  `unit` enum('Cent','Number','Carat') DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stone_sub_type`
--

INSERT INTO `stone_sub_type` (`id`, `stone_type_id`, `name`, `grams`, `carat`, `numbers`, `cents`, `rate`, `unit`, `created`) VALUES
(1, 3, 'Blue Sapphire1', NULL, NULL, NULL, NULL, 901.00, 'Carat', '2022-06-08 13:07:45'),
(2, 3, 'Burma Diamond', NULL, NULL, NULL, NULL, 5000.00, 'Number', '2022-06-08 13:10:44'),
(9, 0, 'Real Stones sub', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-17 14:02:47'),
(13, 7, 'AD Stones', NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-16 03:32:09'),
(14, 2, 'RUBY', NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-16 03:39:58'),
(15, 1, 'American Diamond', NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-16 06:27:53');

-- --------------------------------------------------------

--
-- Table structure for table `stone_type`
--

CREATE TABLE `stone_type` (
  `id` int(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stone_type`
--

INSERT INTO `stone_type` (`id`, `name`, `created`) VALUES
(2, 'Real Stones', '2022-09-16 09:09:28'),
(4, 'Beads', '2022-09-19 10:27:39'),
(6, 'Diamond', '2022-12-15 07:47:41'),
(7, 'Syntheic Stones', '2023-05-16 03:31:35'),
(8, 'Dia', '2023-05-16 06:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `SubCategory_ID` int(11) NOT NULL,
  `Category_ID` int(11) NOT NULL,
  `SubCategory_Name` varchar(100) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `making_charges_per_gram` double(10,2) DEFAULT '0.00',
  `wastage_percent` double(10,2) DEFAULT '0.00',
  `metal_type` enum('gold','silver') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`SubCategory_ID`, `Category_ID`, `SubCategory_Name`, `Timestamp`, `making_charges_per_gram`, `wastage_percent`, `metal_type`) VALUES
(1, 1, 'Gold Chain', '2021-07-14 13:17:27', 21.00, 1.00, 'gold'),
(2, 2, 'round', '2021-02-13 04:57:50', 32.00, 2.00, 'gold'),
(3, 1, 'xyz abc 123', '2022-05-23 08:20:04', 10.00, 3.00, 'gold'),
(4, 3, 'this is sub cat', '2022-05-23 08:20:23', 40.00, 4.00, 'gold'),
(5, 5, 'short chain sc', '2022-11-17 03:47:57', 25.00, 1.00, 'gold'),
(7, 9, 'short chain', '2022-11-17 04:30:25', 45.00, 45.00, 'gold'),
(8, 9, 'chain', '2022-11-18 05:18:06', 45.00, 5.00, 'gold'),
(9, 0, 'dd\" hg', '2022-11-16 10:46:52', 56.00, 65.00, 'gold'),
(10, 6, 'test ', '2022-11-16 17:06:21', 5.00, 5.00, 'gold'),
(11, 5, 'Hollow Chains', '2022-12-15 07:44:44', 0.00, 0.00, 'gold'),
(12, 13, 'Stone Bangles', '2022-12-19 08:38:51', 0.00, 0.00, 'gold'),
(13, 15, 'Stones Necklaces', '2023-04-14 04:32:15', 0.00, 0.00, 'gold'),
(14, 15, 'Plain Necklaces', '2023-04-14 04:32:52', 0.00, 0.00, 'gold'),
(15, 15, 'Kundan Necklaces', '2023-04-14 04:34:52', 0.00, 0.00, 'gold'),
(16, 15, 'Real Necklaces', '2023-04-14 04:44:21', 0.00, 0.00, 'gold'),
(17, 16, 'Plain Bangles', '2023-04-14 05:14:05', 0.00, 0.00, 'gold'),
(18, 16, 'Stones Bangles', '2023-04-14 05:14:27', 0.00, 0.00, 'gold'),
(19, 17, 'Plain Long Haram', '2023-04-14 07:44:31', 0.00, 0.00, 'gold'),
(20, 17, 'Muttu Long Haram', '2023-04-14 07:44:45', 0.00, 0.00, 'gold'),
(21, 17, 'Stones Long Haram', '2023-04-14 07:45:02', 0.00, 0.00, 'gold'),
(22, 18, 'Plain Silver Chambu', '2023-04-15 20:09:11', 0.00, 0.00, 'gold'),
(23, 18, 'Nakas Silver Chambu', '2023-04-15 20:09:27', 0.00, 0.00, 'gold'),
(24, 20, 'Plain Rings', '2023-05-16 03:25:47', 0.00, 0.00, 'gold'),
(25, 20, 'Stones Rings', '2023-05-16 03:26:05', 0.00, 0.00, 'gold'),
(26, 21, 'Jhumkas', '2023-05-22 07:32:06', 0.00, 0.00, 'gold'),
(27, 23, 'Stone light weight Nagamuri', '2023-06-26 06:32:04', 0.00, 0.00, 'gold'),
(28, 24, 'Plain gold kada ', '2023-06-26 07:21:30', 0.00, 0.00, 'gold'),
(29, 25, 'Diamond Besari', '2023-06-29 11:49:20', 0.00, 0.00, 'gold'),
(30, 26, 'Plain Engraving Patti', '2023-07-14 04:02:19', 0.00, 0.00, 'gold'),
(31, 26, 'Mopu', '2023-07-14 04:06:09', 0.00, 0.00, 'gold'),
(32, 27, 'stone kadaga', '2023-08-28 05:43:17', 0.00, 0.00, 'gold');

-- --------------------------------------------------------

--
-- Table structure for table `taskstoworkshop`
--

CREATE TABLE `taskstoworkshop` (
  `Task_Id` int(11) NOT NULL,
  `Task_Title` varchar(100) NOT NULL,
  `Workshop_Code` int(11) NOT NULL,
  `Task_Description` varchar(400) NOT NULL,
  `Task_Priority` int(10) NOT NULL,
  `Task_Status` int(10) NOT NULL,
  `Order_Code` int(11) NOT NULL,
  `Start_Date` varchar(100) NOT NULL,
  `End_Date` varchar(100) NOT NULL,
  `TaskType_Id` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `taskstoworkshop`
--

INSERT INTO `taskstoworkshop` (`Task_Id`, `Task_Title`, `Workshop_Code`, `Task_Description`, `Task_Priority`, `Task_Status`, `Order_Code`, `Start_Date`, `End_Date`, `TaskType_Id`, `Timestamp`) VALUES
(1, 'Gold prepare', 1, 'gold', 10, 1, 1, '11-02-2021', '14-02-2021', 1, '2021-07-01 01:53:37'),
(2, 'Gold prepare', 1, 'gold', 0, 1, 2, '10-02-2021', '22-02-2021', 2, '2021-02-18 06:55:57'),
(3, 'Gold prepare', 1, 'completed', 0, 0, 1, '02-03-2021', '02-07-2021', 1, '2021-07-01 01:20:18'),
(4, 'Polish', 2, 'Polish', 0, 1, 2, '14-07-2021', '16-07-2021', 3, '2021-07-14 13:38:03');

-- --------------------------------------------------------

--
-- Table structure for table `tasktype`
--

CREATE TABLE `tasktype` (
  `TaskType_Id` int(11) NOT NULL,
  `TaskType_Name` varchar(200) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasktype`
--

INSERT INTO `tasktype` (`TaskType_Id`, `TaskType_Name`, `Timestamp`) VALUES
(1, 'chain making', '2021-02-17 04:11:32'),
(2, 'ring making', '2021-02-12 23:40:40'),
(3, 'polish', '2021-02-17 00:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `todaysratepergram`
--

CREATE TABLE `todaysratepergram` (
  `TodaysRatePerGram_ID` int(11) NOT NULL,
  `metal_type` enum('gold','silver') DEFAULT NULL,
  `karrat` varchar(100) NOT NULL,
  `TodaysRatePerGram` double(15,2) NOT NULL,
  `Timestamp` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todaysratepergram`
--

INSERT INTO `todaysratepergram` (`TodaysRatePerGram_ID`, `metal_type`, `karrat`, `TodaysRatePerGram`, `Timestamp`) VALUES
(2, NULL, '18kt', 4350.00, '2021-02-18 00:00:00'),
(3, NULL, '22kt', 4700.00, '2021-02-13 00:00:00'),
(4, NULL, '24kt', 4800.00, '2021-02-13 00:00:00'),
(5, NULL, '14kt', 4110.00, '2021-02-15 00:00:00'),
(8, NULL, '18kt', 4700.00, '2021-02-19 00:00:00'),
(9, NULL, '14kt', 4100.00, '2021-02-19 00:00:00'),
(10, NULL, 'Select quality', 1200.00, '2021-02-19 00:00:00'),
(11, NULL, '14kt', 4100.00, '2021-02-19 00:00:00'),
(12, NULL, '14kt', 4100.00, '2021-02-26 00:00:00'),
(13, NULL, '14kt', 4110.00, '2021-03-02 00:00:00'),
(14, NULL, '14kt', 4182.00, '2021-03-05 00:00:00'),
(15, NULL, '14kt', 4100.00, '2021-03-12 00:00:00'),
(16, NULL, '18kt', 4300.00, '2021-03-12 00:00:00'),
(17, NULL, '18kt', 4250.00, '2021-07-01 00:00:00'),
(18, NULL, '24kt', 4700.00, '2021-07-14 18:43:41'),
(19, NULL, '22kt', 4550.00, '2021-07-14 18:44:39'),
(20, NULL, '22kt', 4000.00, '2021-12-22 13:54:26'),
(21, NULL, '', 4500.00, '2022-02-04 15:47:41'),
(22, NULL, '', 4500.00, '2022-02-07 18:21:37'),
(23, 'gold', '', 5001.00, '2022-06-06 13:49:24'),
(24, 'silver', '', 1200.00, '2022-06-06 13:49:35'),
(25, 'gold', '', 4500.00, '2022-06-21 23:54:23'),
(26, 'silver', '', 61.00, '2022-06-21 23:55:58'),
(27, 'gold', '', 4600.00, '2022-06-22 00:00:34'),
(28, 'silver', '', 60.00, '2022-06-22 00:00:42'),
(29, 'gold', '', 4500.00, '2022-06-23 11:40:03'),
(30, 'silver', '', 61.00, '2022-06-23 11:40:12'),
(31, 'gold', '', 3456.00, '2022-09-20 18:13:12'),
(32, 'gold', '', 3456.00, '2022-09-21 11:35:01'),
(33, 'gold', '', 400.00, '2022-09-22 10:27:04'),
(34, 'silver', '', 2324.00, '2022-09-23 10:49:35'),
(35, 'gold', '', 2345.00, '2022-09-23 10:49:50'),
(36, 'gold', '', 4567.00, '2022-09-24 14:17:29'),
(37, 'silver', '', 34.00, '2022-09-24 14:18:01'),
(38, 'silver', '', 34.00, '2022-09-26 11:52:53'),
(39, 'gold', '', 4500.00, '2022-10-07 16:12:47'),
(40, 'silver', '', 450.00, '2022-10-07 16:12:56'),
(41, 'gold', '', 1200.00, '2022-10-09 18:26:20'),
(42, 'silver', '', 23.00, '2022-10-09 18:26:30'),
(43, 'gold', '', 45.00, '2022-10-10 10:53:45'),
(44, 'gold', '', 9000.00, '2022-10-18 10:25:10'),
(45, 'gold', '', 1200.00, '2022-10-19 19:31:06'),
(46, 'silver', '', 231.00, '2022-10-19 19:32:11'),
(47, 'gold', '', 4522.00, '2022-10-19 19:32:41'),
(48, 'gold', '', 456.00, '2022-10-20 15:58:37'),
(49, 'gold', '', 5050.00, '2022-12-15 13:11:59'),
(50, 'gold', '', 4520.00, '2022-12-20 10:19:36'),
(51, 'silver', '', 520.00, '2022-12-20 10:19:46'),
(52, 'gold', '', 45.00, '2023-01-04 14:48:48'),
(53, 'silver', '', 40.00, '2023-01-04 14:49:20'),
(54, 'gold', '', 5720.00, '2023-04-16 00:58:37'),
(55, 'gold', '', 5720.00, '2023-04-16 01:02:49'),
(56, 'gold', '', 5700.00, '2023-04-16 01:12:56'),
(57, 'gold', '', 5600.00, '2023-04-16 01:36:10'),
(58, 'gold', '', 5950.00, '2023-05-24 15:04:33'),
(59, 'gold', '', 6000.00, '2023-05-02 14:21:42'),
(60, 'gold', '', 5800.00, '2023-05-02 14:22:19'),
(61, 'gold', '', 6200.00, '2023-05-14 13:57:58'),
(62, 'gold', '', 6000.00, '2023-05-15 21:52:22'),
(63, 'gold', '', 6000.00, '2023-05-15 22:10:41'),
(64, 'gold', '', 5850.00, '2023-05-16 08:50:45'),
(65, 'gold', '', 5850.00, '2023-05-16 09:59:09'),
(66, 'silver', '', 450.00, '2023-05-16 11:26:08'),
(67, 'gold', '', 5700.00, '2023-05-22 12:38:24'),
(68, 'silver', '', 40000.00, '2023-05-22 12:54:32'),
(69, 'silver', '', 600.00, '2023-05-22 12:54:45'),
(70, 'gold', '', 5605.00, '2023-05-23 13:58:51'),
(71, 'gold', '', 5630.00, '2023-05-24 12:22:14'),
(72, 'gold', '', 5650.00, '2023-05-24 15:05:09'),
(73, 'gold', '', 5700.00, '2023-05-24 15:02:57'),
(74, 'gold', '', 345.00, '2023-06-05 15:37:30'),
(76, 'gold', '', 5565.00, '2023-06-07 15:13:20'),
(77, 'gold', '', 5590.00, '2023-06-07 17:33:43'),
(83, 'gold', '', 5525.00, '2023-06-08 15:43:26'),
(84, 'gold', '', 3000.00, '2023-06-09 11:47:44'),
(85, 'gold', '', 10000.00, '2023-06-09 17:18:03'),
(86, 'silver', '', 1000.00, '2023-06-09 17:18:47'),
(87, 'silver', '', 900.00, '2023-06-09 17:19:13'),
(89, 'gold', '', 10000.00, '2023-06-12 12:36:10'),
(92, 'gold', '', 6000.00, '2023-06-13 17:29:07'),
(96, 'gold', '', 6000.00, '2023-06-14 12:15:00'),
(97, 'gold', '', 6000.00, '2023-06-15 11:19:14'),
(98, 'silver', '', 73.00, '2023-06-16 11:21:17'),
(99, 'gold', '', 5000.00, '2023-06-16 14:47:16'),
(100, 'silver', '', 120.00, '2023-06-17 10:11:21'),
(101, 'silver', '', 120.00, '2023-06-17 10:46:47'),
(102, 'gold', '', 5000.00, '2023-06-17 10:47:02'),
(103, 'gold', '', 6000.00, '2023-06-17 10:48:18'),
(106, 'gold', '', 7000.00, '2023-06-19 11:47:02'),
(107, 'gold', '', 6000.00, '2023-06-20 12:01:08'),
(108, 'gold', '', 7000.00, '2023-06-21 14:09:04'),
(109, 'gold', '', 7000.00, '2023-06-26 11:11:50'),
(110, 'gold', '', 7400.00, '2023-06-26 11:13:31'),
(111, 'gold', '', 5000.00, '2023-06-28 14:59:22'),
(113, 'gold', '', 6000.00, '2023-06-29 11:46:40'),
(114, 'gold', '', 6000.00, '2023-06-30 15:00:32'),
(115, 'gold', '', 5500.00, '2023-07-07 12:00:41'),
(116, 'gold', '', 5720.00, '2023-07-14 10:51:31'),
(117, 'gold', '', 6000.00, '2023-07-18 12:10:31'),
(118, 'gold', '', 5000.00, '2023-07-20 12:31:03'),
(119, 'gold', '', 6000.00, '2023-07-21 13:43:25'),
(120, 'gold', '', 5000.00, '2023-07-25 13:46:42'),
(121, 'gold', '', 6000.00, '2023-07-27 10:23:42'),
(122, 'gold', '', 5700.00, '2023-07-30 18:27:25'),
(123, 'gold', '', 5000.00, '2023-08-28 11:15:19'),
(124, 'gold', '', 6000.00, '2023-10-16 11:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

CREATE TABLE `workshops` (
  `Workshop_Code` int(11) NOT NULL,
  `Workshop_Name` varchar(200) NOT NULL,
  `Workshop_Address` varchar(500) NOT NULL,
  `Workshop_GoldBalanceInGram` varchar(100) NOT NULL,
  `Workshop_Contact_Mobile_Number1` varchar(20) NOT NULL,
  `Workshop_Contact_Mobile_Number2` varchar(20) NOT NULL,
  `Workshop_Contact_Landline_Number1` varchar(30) NOT NULL,
  `Workshop_Contact_Landline_Number2` varchar(30) NOT NULL,
  `Workshop_Adhar_Number` bigint(18) NOT NULL,
  `Workshop_Email_Id` varchar(100) NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `balance_inr` double(10,2) DEFAULT '0.00',
  `id_proof_type` varchar(50) DEFAULT NULL,
  `id_proof_number` varchar(100) DEFAULT NULL,
  `id_proof_file` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workshops`
--

INSERT INTO `workshops` (`Workshop_Code`, `Workshop_Name`, `Workshop_Address`, `Workshop_GoldBalanceInGram`, `Workshop_Contact_Mobile_Number1`, `Workshop_Contact_Mobile_Number2`, `Workshop_Contact_Landline_Number1`, `Workshop_Contact_Landline_Number2`, `Workshop_Adhar_Number`, `Workshop_Email_Id`, `TimeStamp`, `balance_inr`, `id_proof_type`, `id_proof_number`, `id_proof_file`) VALUES
(3, 'RAJA', 'Anchepete', '5', '9353071804', '', '', '', 0, 'rajak@gmail.com', '2023-04-15 19:49:29', 1000.00, 'Aadhar', '11112222333334444', NULL),
(4, 'SY Kannaiah', 'Nagarathpete', '10', '99000990009', '', '', '', 0, 'SyKannaiah@gmailcom', '2023-04-15 19:50:58', 2000.00, 'Aadhar', '0000111122223333', NULL),
(5, 'Dabu Walo', 'jajas', '0', '1234567890', '', '', '', 0, 'iiajnsajnja@gmail.com', '2023-07-14 04:11:46', 1.00, 'Aadhar', '123456789012', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_back`
--
ALTER TABLE `admin_back`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`Customer_Code`);

--
-- Indexes for table `goldbalance`
--
ALTER TABLE `goldbalance`
  ADD PRIMARY KEY (`Goldbalance_id`);

--
-- Indexes for table `golddepositeticket`
--
ALTER TABLE `golddepositeticket`
  ADD PRIMARY KEY (`Ticket_Id`),
  ADD KEY `Workshop_Code` (`Workshop_Code`),
  ADD KEY `Task_Id` (`Task_Id`),
  ADD KEY `Order_Code` (`Order_Code`);

--
-- Indexes for table `gold_melting_calculation`
--
ALTER TABLE `gold_melting_calculation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gold_melting_pure_gold`
--
ALTER TABLE `gold_melting_pure_gold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gold_melting_receipts`
--
ALTER TABLE `gold_melting_receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gold_transaction`
--
ALTER TABLE `gold_transaction`
  ADD PRIMARY KEY (`Transaction_ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Item_Code`);

--
-- Indexes for table `jitems`
--
ALTER TABLE `jitems`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `Category_ID` (`Category_ID`),
  ADD KEY `SubCategory_ID` (`SubCategory_ID`);

--
-- Indexes for table `metalorpurity`
--
ALTER TABLE `metalorpurity`
  ADD PRIMARY KEY (`Purity_ID`);

--
-- Indexes for table `metal_inventory`
--
ALTER TABLE `metal_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metal_inventory_passbook`
--
ALTER TABLE `metal_inventory_passbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_Code`),
  ADD KEY `Customer_Code` (`Customer_Code`),
  ADD KEY `Product_Code` (`Product_Code`);

--
-- Indexes for table `orderstatus`
--
ALTER TABLE `orderstatus`
  ADD PRIMARY KEY (`Status_id`),
  ADD KEY `Order_Code` (`Order_Code`);

--
-- Indexes for table `orderstatustrack`
--
ALTER TABLE `orderstatustrack`
  ADD PRIMARY KEY (`orderstatustrack_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_stones`
--
ALTER TABLE `order_stones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`Payment_code`),
  ADD KEY `Order_Code` (`Order_Code`);

--
-- Indexes for table `polish_items`
--
ALTER TABLE `polish_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polish_orders`
--
ALTER TABLE `polish_orders`
  ADD PRIMARY KEY (`Order_Code`),
  ADD KEY `Customer_Code` (`Customer_Code`),
  ADD KEY `Product_Code` (`Product_Code`);

--
-- Indexes for table `polish_payments`
--
ALTER TABLE `polish_payments`
  ADD PRIMARY KEY (`Payment_code`),
  ADD KEY `Order_Code` (`Order_Code`);

--
-- Indexes for table `pricebreakup`
--
ALTER TABLE `pricebreakup`
  ADD PRIMARY KEY (`Price_Code`),
  ADD KEY `Product_Code` (`Order_Code`),
  ADD KEY `TodaysRatePerGram_ID` (`TodaysRatePerGram_ID`);

--
-- Indexes for table `productimages`
--
ALTER TABLE `productimages`
  ADD PRIMARY KEY (`ProductImage_Id`),
  ADD KEY `Product_Code` (`Product_Code`);

--
-- Indexes for table `productitems`
--
ALTER TABLE `productitems`
  ADD PRIMARY KEY (`ProductItem_Code`),
  ADD KEY `Product_Code` (`Order_Code`),
  ADD KEY `Item_Code` (`Item_Code`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Product_Code`),
  ADD KEY `Category_Id` (`Category_ID`),
  ADD KEY `Purity_ID` (`SubCategory_ID`);

--
-- Indexes for table `repair_items`
--
ALTER TABLE `repair_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repair_orders`
--
ALTER TABLE `repair_orders`
  ADD PRIMARY KEY (`Order_Code`),
  ADD KEY `Customer_Code` (`Customer_Code`),
  ADD KEY `Product_Code` (`Product_Code`);

--
-- Indexes for table `repair_payments`
--
ALTER TABLE `repair_payments`
  ADD PRIMARY KEY (`Payment_code`),
  ADD KEY `Order_Code` (`Order_Code`);

--
-- Indexes for table `stone_inventory_passbook`
--
ALTER TABLE `stone_inventory_passbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stone_items`
--
ALTER TABLE `stone_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stone_type_id` (`stone_type_id`),
  ADD KEY `stone_subtype_id` (`stone_subtype_id`);

--
-- Indexes for table `stone_sub_type`
--
ALTER TABLE `stone_sub_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stone_type`
--
ALTER TABLE `stone_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`SubCategory_ID`),
  ADD KEY `Category_ID` (`Category_ID`);

--
-- Indexes for table `taskstoworkshop`
--
ALTER TABLE `taskstoworkshop`
  ADD PRIMARY KEY (`Task_Id`),
  ADD KEY `Workshop_Code` (`Workshop_Code`),
  ADD KEY `Order_Code` (`Order_Code`),
  ADD KEY `TaskType_Id` (`TaskType_Id`);

--
-- Indexes for table `tasktype`
--
ALTER TABLE `tasktype`
  ADD PRIMARY KEY (`TaskType_Id`);

--
-- Indexes for table `todaysratepergram`
--
ALTER TABLE `todaysratepergram`
  ADD PRIMARY KEY (`TodaysRatePerGram_ID`);

--
-- Indexes for table `workshops`
--
ALTER TABLE `workshops`
  ADD PRIMARY KEY (`Workshop_Code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_back`
--
ALTER TABLE `admin_back`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `Customer_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `goldbalance`
--
ALTER TABLE `goldbalance`
  MODIFY `Goldbalance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `golddepositeticket`
--
ALTER TABLE `golddepositeticket`
  MODIFY `Ticket_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gold_melting_calculation`
--
ALTER TABLE `gold_melting_calculation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gold_melting_pure_gold`
--
ALTER TABLE `gold_melting_pure_gold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gold_melting_receipts`
--
ALTER TABLE `gold_melting_receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gold_transaction`
--
ALTER TABLE `gold_transaction`
  MODIFY `Transaction_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Item_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jitems`
--
ALTER TABLE `jitems`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `metalorpurity`
--
ALTER TABLE `metalorpurity`
  MODIFY `Purity_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `metal_inventory`
--
ALTER TABLE `metal_inventory`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `metal_inventory_passbook`
--
ALTER TABLE `metal_inventory_passbook`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `orderstatus`
--
ALTER TABLE `orderstatus`
  MODIFY `Status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orderstatustrack`
--
ALTER TABLE `orderstatustrack`
  MODIFY `orderstatustrack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `order_stones`
--
ALTER TABLE `order_stones`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `Payment_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=635;

--
-- AUTO_INCREMENT for table `polish_items`
--
ALTER TABLE `polish_items`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `polish_orders`
--
ALTER TABLE `polish_orders`
  MODIFY `Order_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `polish_payments`
--
ALTER TABLE `polish_payments`
  MODIFY `Payment_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pricebreakup`
--
ALTER TABLE `pricebreakup`
  MODIFY `Price_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `productimages`
--
ALTER TABLE `productimages`
  MODIFY `ProductImage_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `productitems`
--
ALTER TABLE `productitems`
  MODIFY `ProductItem_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Product_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `repair_items`
--
ALTER TABLE `repair_items`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `repair_orders`
--
ALTER TABLE `repair_orders`
  MODIFY `Order_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `repair_payments`
--
ALTER TABLE `repair_payments`
  MODIFY `Payment_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `stone_inventory_passbook`
--
ALTER TABLE `stone_inventory_passbook`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stone_items`
--
ALTER TABLE `stone_items`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stone_sub_type`
--
ALTER TABLE `stone_sub_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `stone_type`
--
ALTER TABLE `stone_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `SubCategory_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `taskstoworkshop`
--
ALTER TABLE `taskstoworkshop`
  MODIFY `Task_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tasktype`
--
ALTER TABLE `tasktype`
  MODIFY `TaskType_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `todaysratepergram`
--
ALTER TABLE `todaysratepergram`
  MODIFY `TodaysRatePerGram_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `workshops`
--
ALTER TABLE `workshops`
  MODIFY `Workshop_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
