-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2021 at 11:25 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hackathon`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `evt_id` bigint(11) NOT NULL,
  `evt_start` date NOT NULL,
  `evt_end` date NOT NULL,
  `evt_text` text NOT NULL,
  `evt_color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`evt_id`, `evt_start`, `evt_end`, `evt_text`, `evt_color`) VALUES
(3, '2021-07-06', '2021-07-06', 'Ridha Mezzi', '#4cd6bf'),
(4, '2021-07-22', '2021-07-22', 'Ala Rzig', '#4cd6bf');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` varchar(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `birth` date NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `telephone` varchar(8) NOT NULL,
  `service` varchar(30) NOT NULL,
  `rens` varchar(200) NOT NULL,
  `scanner` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `fname`, `lname`, `birth`, `adresse`, `telephone`, `service`, `rens`, `scanner`) VALUES
('25', 'Test', 'Test', '2016-07-26', 'Mourouj', '55023284', 'URGENCE', 'rien', 'TDM Cerebrale'),
('28', 'Omar', 'Khlelfa', '1996-11-15', 'Tunis', '53125900', 'CARDIOLOGIE', 'rien', 'TDM Surrenalienne'),
('36', 'Ala', 'Rzig', '2020-01-13', 'Tabarka', '50465123', 'Radiologie', 'revision', 'Abdominal'),
('444', 'Ridha', 'Mezzi', '2017-09-28', 'Bizerte', '12345678', 'COVID19', 'suspision', 'Angioscanner');

-- --------------------------------------------------------

--
-- Table structure for table `rendezvous`
--

CREATE TABLE `rendezvous` (
  `idrv` varchar(20) NOT NULL,
  `idpatient` varchar(20) NOT NULL,
  `docteuraffectant` text NOT NULL,
  `date` date NOT NULL,
  `antecedant` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `cin` varchar(8) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `tel` bigint(20) NOT NULL,
  `address` text NOT NULL,
  `login` varchar(20) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `role` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`cin`, `fname`, `lname`, `tel`, `address`, `login`, `pwd`, `role`) VALUES
('12345671', 'Oussama', 'Belhouichet', 55023284, 'Mhamdia', 'BLH', '123456Aa@', 'Admin'),
('12345699', 'Anwer', 'Ncibi', 55023284, 'Mhamdia', 'BNR', '123456Aa@', 'Doctor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`evt_id`),
  ADD KEY `evt_start` (`evt_start`),
  ADD KEY `evt_end` (`evt_end`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD PRIMARY KEY (`idrv`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `evt_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
