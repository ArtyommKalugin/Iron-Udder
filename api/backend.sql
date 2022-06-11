-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 03, 2022 at 05:35 AM
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
-- Database: `backend`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`) VALUES
(4, 'CFT'),
(6, 'EducationERP'),
(3, 'KODE'),
(5, 'NTR');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `name`) VALUES
(2, 'android'),
(4, 'backend'),
(3, 'frontend'),
(6, 'fullstack'),
(1, 'ios'),
(5, 'qa');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `userID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `rating` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'student'),
(3, 'company'),
(4, 'deanery');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `value` varchar(55) NOT NULL,
  `userID` int(11) NOT NULL,
  `validUntil` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`value`, `userID`, `validUntil`) VALUES
('d7e389fa847a2e9d1286db196ad38546', 6, '2022-05-28 02:58:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `secondName` varchar(55) NOT NULL,
  `thirdName` varchar(55) NOT NULL,
  `birthDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roleId` int(11) NOT NULL,
  `companyID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `secondName`, `thirdName`, `birthDate`, `email`, `password`, `roleId`, `companyID`) VALUES
(4, 'Admin', 'Ramos', 'Admin', '2001-10-22 18:24:46', 'admin@mail.ru', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 1, NULL),
(6, 'Andrew', 'Frolov', 'Alexandrovich', '2000-11-22 00:24:40', 'faa_01@bk.ru', '50dca1581f7d45033141049b249f8178717bd574', 2, NULL),
(7, 'kode', 'kode', 'kode', '1997-05-07 20:34:52', 'kode@mail.ru', '011c945f30ce2cbafc452f39840f025693339c42', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `vacancies`
--

CREATE TABLE `vacancies` (
  `id` int(11) NOT NULL,
  `positionID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vacancies`
--

INSERT INTO `vacancies` (`id`, `positionID`, `companyID`) VALUES
(2, 1, 3),
(5, 3, 3),
(7, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `vacanciesusers`
--

CREATE TABLE `vacanciesusers` (
  `userID` int(11) NOT NULL,
  `vacancyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vacanciesusers`
--

INSERT INTO `vacanciesusers` (`userID`, `vacancyID`) VALUES
(6, 5),
(6, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`userID`,`companyID`),
  ADD KEY `movieID` (`companyID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`value`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `roleId` (`roleId`),
  ADD KEY `companyID` (`companyID`);

--
-- Indexes for table `vacancies`
--
ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `positionID` (`positionID`),
  ADD KEY `companyID` (`companyID`);

--
-- Indexes for table `vacanciesusers`
--
ALTER TABLE `vacanciesusers`
  ADD PRIMARY KEY (`userID`,`vacancyID`),
  ADD KEY `vacancyID` (`vacancyID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vacancies`
--
ALTER TABLE `vacancies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`companyID`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`companyID`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vacancies`
--
ALTER TABLE `vacancies`
  ADD CONSTRAINT `vacancies_ibfk_1` FOREIGN KEY (`positionID`) REFERENCES `position` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `vacancies_ibfk_2` FOREIGN KEY (`companyID`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `vacanciesusers`
--
ALTER TABLE `vacanciesusers`
  ADD CONSTRAINT `vacanciesusers_ibfk_1` FOREIGN KEY (`vacancyID`) REFERENCES `vacancies` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `vacanciesusers_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
