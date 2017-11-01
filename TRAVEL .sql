-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2017 at 12:05 AM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.1.10-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TRAVEL`
--

-- --------------------------------------------------------

--
-- Table structure for table `Account`
--

CREATE TABLE `Account` (
  `idAccount` int(10) UNSIGNED NOT NULL,
  `nameAccount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Account`
--

INSERT INTO `Account` (`idAccount`, `nameAccount`, `email`, `password`, `address`, `phone`, `img`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Lam', 'lam@gmail.com', '12345678', 'Nghệ An', '0123456789', '1508862298.png', NULL, NULL, NULL),
(2, 'Phong', 'phong@gmail.com', '12345678', 'Quảng Bình', '0972681453', 'default.png', NULL, NULL, NULL),
(3, 'Na', 'na@gmail.com', '12345678', 'Đà Nẵng', '0123456789', '1509468826.jpg', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Authorize`
--

CREATE TABLE `Authorize` (
  `idAuthorize` int(10) UNSIGNED NOT NULL,
  `idGroup` int(10) UNSIGNED NOT NULL,
  `idFunction` int(10) UNSIGNED NOT NULL,
  `isEnable` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Discount`
--

CREATE TABLE `Discount` (
  `idDiscount` int(10) UNSIGNED NOT NULL,
  `idAccount` int(10) UNSIGNED DEFAULT NULL,
  `percentDiscount` double(8,2) NOT NULL,
  `timeBeginDiscount` datetime NOT NULL,
  `timeEndDiscount` datetime NOT NULL,
  `idPlace` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Event`
--

CREATE TABLE `Event` (
  `idEvent` int(10) UNSIGNED NOT NULL,
  `nameEvent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idPlace` int(10) UNSIGNED NOT NULL,
  `timeBeginEvent` datetime NOT NULL,
  `timeEndEvent` datetime NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idAccount` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Event`
--

INSERT INTO `Event` (`idEvent`, `nameEvent`, `idPlace`, `timeBeginEvent`, `timeEndEvent`, `description`, `img`, `idAccount`, `created_at`, `updated_at`) VALUES
(1, 'Picture exhibiting', 4, '2017-01-03 13:00:00', '2017-01-05 01:00:00', '<p>aa</p>', '1509544618.jpg', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Festival`
--

CREATE TABLE `Festival` (
  `idFestival` int(10) UNSIGNED NOT NULL,
  `nameFestival` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idPlace` int(10) UNSIGNED NOT NULL,
  `timeBeginFestival` datetime NOT NULL,
  `timeEndFestival` datetime NOT NULL,
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idAccount` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Festival`
--

INSERT INTO `Festival` (`idFestival`, `nameFestival`, `idPlace`, `timeBeginFestival`, `timeEndFestival`, `Description`, `img`, `idAccount`, `created_at`, `updated_at`) VALUES
(1, 'Flower', 4, '2017-10-29 13:00:00', '2017-11-02 13:00:00', '<p>aaa</p>', '1509545551.jpg', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Function`
--

CREATE TABLE `Function` (
  `idFunction` int(10) UNSIGNED NOT NULL,
  `nameFunction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Group`
--

CREATE TABLE `Group` (
  `idGroup` int(10) UNSIGNED NOT NULL,
  `nameGroup` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Group`
--

INSERT INTO `Group` (`idGroup`, `nameGroup`, `note`, `created_at`, `updated_at`) VALUES
(1, 'admin', '', NULL, NULL),
(2, 'user', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `listPlace`
--

CREATE TABLE `listPlace` (
  `idlistPlace` int(10) UNSIGNED NOT NULL,
  `idSchedule` int(10) UNSIGNED NOT NULL,
  `idPlace` int(10) UNSIGNED NOT NULL,
  `timeBeginTravel` datetime NOT NULL,
  `timeEndTravel` datetime NOT NULL,
  `idEvent` int(10) UNSIGNED NOT NULL,
  `idFestival` int(10) UNSIGNED NOT NULL,
  `idDiscount` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listSchedule`
--

CREATE TABLE `listSchedule` (
  `idlistSchedule` int(10) UNSIGNED NOT NULL,
  `idAccount` int(10) UNSIGNED NOT NULL,
  `idSchedule` int(10) UNSIGNED NOT NULL,
  `timeSearch` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `MemberGroup`
--

CREATE TABLE `MemberGroup` (
  `idMember` int(10) UNSIGNED NOT NULL,
  `idAccount` int(10) UNSIGNED NOT NULL,
  `idGroup` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `MemberGroup`
--

INSERT INTO `MemberGroup` (`idMember`, `idAccount`, `idGroup`, `created_at`, `updated_at`) VALUES
(2, 1, 1, NULL, NULL),
(3, 3, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(114, '2017_10_18_085846_create_Account_table', 1),
(115, '2017_10_18_090252_create_Group_table', 1),
(116, '2017_10_18_090351_create_MemberGroup_table', 1),
(117, '2017_10_18_090557_create_Function_table', 1),
(118, '2017_10_18_090808_create_Authorize_table', 1),
(119, '2017_10_18_090900_create_typePlace_table', 1),
(120, '2017_10_18_090943_create_Place_table', 1),
(121, '2017_10_18_091100_create_Event_table', 1),
(122, '2017_10_18_175011_create_typeService_table', 1),
(123, '2017_10_18_181410_create_Rating_table', 1),
(124, '2017_10_19_153922_create_Discount_table', 1),
(125, '2017_10_19_154956_create_Schedule_table', 1),
(126, '2017_10_19_155522_create_listSchedule_table', 1),
(127, '2017_10_19_161933_create_Festival_table', 1),
(128, '2017_10_19_162000_create_listPlace_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Place`
--

CREATE TABLE `Place` (
  `idPlace` int(10) UNSIGNED NOT NULL,
  `namePlace` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MoneyToTravel` double(8,2) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idType` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latlog` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idAccount` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Place`
--

INSERT INTO `Place` (`idPlace`, `namePlace`, `MoneyToTravel`, `address`, `img`, `idType`, `description`, `latlog`, `idAccount`, `created_at`, `updated_at`) VALUES
(4, 'Ba Na Hill', 600000.00, 'thôn An Sơn, Hòa Ninh, Hòa Vang, Đà Nẵng', '1509272158.jpg', 1, '<p>aaa</p>', '3', NULL, NULL, NULL),
(5, 't', 1.00, 'u', '1509272322.jpg', 1, '<p>j</p>', '5', NULL, NULL, NULL),
(6, 'Asian Park', 500000.00, '1 Phan Đăng Lưu, Hòa Cường Bắc, Hải Châu, Đà Nẵng', '1509469710.jpg', 1, '<p>aaaaaaaa</p>', '123', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Rating`
--

CREATE TABLE `Rating` (
  `idRating` int(10) UNSIGNED NOT NULL,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idTypeService` int(10) UNSIGNED NOT NULL,
  `idService` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Schedule`
--

CREATE TABLE `Schedule` (
  `idSchedule` int(10) UNSIGNED NOT NULL,
  `amountOfPeople` double(8,2) NOT NULL,
  `money` double(8,2) NOT NULL,
  `timeBegin` datetime NOT NULL,
  `timeEnd` datetime NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `typePlace`
--

CREATE TABLE `typePlace` (
  `idType` int(10) UNSIGNED NOT NULL,
  `nameType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `typePlace`
--

INSERT INTO `typePlace` (`idType`, `nameType`, `created_at`, `updated_at`) VALUES
(1, 'Ecotourism Travel', NULL, NULL),
(2, 'Leisure Travel', NULL, NULL),
(3, 'Adventure Travel', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `typeService`
--

CREATE TABLE `typeService` (
  `idTypeService` int(10) UNSIGNED NOT NULL,
  `nameTypeService` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`idAccount`);

--
-- Indexes for table `Authorize`
--
ALTER TABLE `Authorize`
  ADD PRIMARY KEY (`idAuthorize`),
  ADD KEY `authorize_idgroup_foreign` (`idGroup`),
  ADD KEY `authorize_idfunction_foreign` (`idFunction`);

--
-- Indexes for table `Discount`
--
ALTER TABLE `Discount`
  ADD PRIMARY KEY (`idDiscount`),
  ADD KEY `discount_idaccount_foreign` (`idAccount`),
  ADD KEY `discount_idplace_foreign` (`idPlace`);

--
-- Indexes for table `Event`
--
ALTER TABLE `Event`
  ADD PRIMARY KEY (`idEvent`),
  ADD KEY `event_idplace_foreign` (`idPlace`),
  ADD KEY `event_idaccount_foreign` (`idAccount`);

--
-- Indexes for table `Festival`
--
ALTER TABLE `Festival`
  ADD PRIMARY KEY (`idFestival`),
  ADD KEY `festival_idplace_foreign` (`idPlace`),
  ADD KEY `festival_idaccount_foreign` (`idAccount`);

--
-- Indexes for table `Function`
--
ALTER TABLE `Function`
  ADD PRIMARY KEY (`idFunction`);

--
-- Indexes for table `Group`
--
ALTER TABLE `Group`
  ADD PRIMARY KEY (`idGroup`);

--
-- Indexes for table `listPlace`
--
ALTER TABLE `listPlace`
  ADD PRIMARY KEY (`idlistPlace`),
  ADD KEY `listplace_idschedule_foreign` (`idSchedule`),
  ADD KEY `listplace_idplace_foreign` (`idPlace`),
  ADD KEY `listplace_idevent_foreign` (`idEvent`),
  ADD KEY `listplace_idfestival_foreign` (`idFestival`),
  ADD KEY `listplace_iddiscount_foreign` (`idDiscount`);

--
-- Indexes for table `listSchedule`
--
ALTER TABLE `listSchedule`
  ADD PRIMARY KEY (`idlistSchedule`),
  ADD KEY `listschedule_idaccount_foreign` (`idAccount`),
  ADD KEY `listschedule_idschedule_foreign` (`idSchedule`);

--
-- Indexes for table `MemberGroup`
--
ALTER TABLE `MemberGroup`
  ADD PRIMARY KEY (`idMember`),
  ADD KEY `membergroup_idaccount_foreign` (`idAccount`),
  ADD KEY `membergroup_idgroup_foreign` (`idGroup`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Place`
--
ALTER TABLE `Place`
  ADD PRIMARY KEY (`idPlace`),
  ADD KEY `place_idaccount_foreign` (`idAccount`),
  ADD KEY `place_idtype_foreign` (`idType`);

--
-- Indexes for table `Rating`
--
ALTER TABLE `Rating`
  ADD PRIMARY KEY (`idRating`),
  ADD KEY `rating_idtypeservice_foreign` (`idTypeService`);

--
-- Indexes for table `Schedule`
--
ALTER TABLE `Schedule`
  ADD PRIMARY KEY (`idSchedule`);

--
-- Indexes for table `typePlace`
--
ALTER TABLE `typePlace`
  ADD PRIMARY KEY (`idType`);

--
-- Indexes for table `typeService`
--
ALTER TABLE `typeService`
  ADD PRIMARY KEY (`idTypeService`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Account`
--
ALTER TABLE `Account`
  MODIFY `idAccount` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Authorize`
--
ALTER TABLE `Authorize`
  MODIFY `idAuthorize` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Discount`
--
ALTER TABLE `Discount`
  MODIFY `idDiscount` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Event`
--
ALTER TABLE `Event`
  MODIFY `idEvent` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Festival`
--
ALTER TABLE `Festival`
  MODIFY `idFestival` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Function`
--
ALTER TABLE `Function`
  MODIFY `idFunction` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Group`
--
ALTER TABLE `Group`
  MODIFY `idGroup` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `listPlace`
--
ALTER TABLE `listPlace`
  MODIFY `idlistPlace` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `listSchedule`
--
ALTER TABLE `listSchedule`
  MODIFY `idlistSchedule` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `MemberGroup`
--
ALTER TABLE `MemberGroup`
  MODIFY `idMember` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT for table `Place`
--
ALTER TABLE `Place`
  MODIFY `idPlace` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `Rating`
--
ALTER TABLE `Rating`
  MODIFY `idRating` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Schedule`
--
ALTER TABLE `Schedule`
  MODIFY `idSchedule` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `typePlace`
--
ALTER TABLE `typePlace`
  MODIFY `idType` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `typeService`
--
ALTER TABLE `typeService`
  MODIFY `idTypeService` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Authorize`
--
ALTER TABLE `Authorize`
  ADD CONSTRAINT `authorize_idfunction_foreign` FOREIGN KEY (`idFunction`) REFERENCES `Function` (`idFunction`),
  ADD CONSTRAINT `authorize_idgroup_foreign` FOREIGN KEY (`idGroup`) REFERENCES `Group` (`idGroup`);

--
-- Constraints for table `Discount`
--
ALTER TABLE `Discount`
  ADD CONSTRAINT `discount_idaccount_foreign` FOREIGN KEY (`idAccount`) REFERENCES `Account` (`idAccount`),
  ADD CONSTRAINT `discount_idplace_foreign` FOREIGN KEY (`idPlace`) REFERENCES `Place` (`idPlace`);

--
-- Constraints for table `Event`
--
ALTER TABLE `Event`
  ADD CONSTRAINT `event_idaccount_foreign` FOREIGN KEY (`idAccount`) REFERENCES `Account` (`idAccount`),
  ADD CONSTRAINT `event_idplace_foreign` FOREIGN KEY (`idPlace`) REFERENCES `Place` (`idPlace`);

--
-- Constraints for table `Festival`
--
ALTER TABLE `Festival`
  ADD CONSTRAINT `festival_idaccount_foreign` FOREIGN KEY (`idAccount`) REFERENCES `Account` (`idAccount`),
  ADD CONSTRAINT `festival_idplace_foreign` FOREIGN KEY (`idPlace`) REFERENCES `Place` (`idPlace`);

--
-- Constraints for table `listPlace`
--
ALTER TABLE `listPlace`
  ADD CONSTRAINT `listplace_iddiscount_foreign` FOREIGN KEY (`idDiscount`) REFERENCES `Discount` (`idDiscount`),
  ADD CONSTRAINT `listplace_idevent_foreign` FOREIGN KEY (`idEvent`) REFERENCES `Event` (`idEvent`),
  ADD CONSTRAINT `listplace_idfestival_foreign` FOREIGN KEY (`idFestival`) REFERENCES `Festival` (`idFestival`),
  ADD CONSTRAINT `listplace_idplace_foreign` FOREIGN KEY (`idPlace`) REFERENCES `Place` (`idPlace`),
  ADD CONSTRAINT `listplace_idschedule_foreign` FOREIGN KEY (`idSchedule`) REFERENCES `Schedule` (`idSchedule`);

--
-- Constraints for table `listSchedule`
--
ALTER TABLE `listSchedule`
  ADD CONSTRAINT `listschedule_idaccount_foreign` FOREIGN KEY (`idAccount`) REFERENCES `Account` (`idAccount`),
  ADD CONSTRAINT `listschedule_idschedule_foreign` FOREIGN KEY (`idSchedule`) REFERENCES `Schedule` (`idSchedule`);

--
-- Constraints for table `MemberGroup`
--
ALTER TABLE `MemberGroup`
  ADD CONSTRAINT `membergroup_idaccount_foreign` FOREIGN KEY (`idAccount`) REFERENCES `Account` (`idAccount`),
  ADD CONSTRAINT `membergroup_idgroup_foreign` FOREIGN KEY (`idGroup`) REFERENCES `Group` (`idGroup`);

--
-- Constraints for table `Place`
--
ALTER TABLE `Place`
  ADD CONSTRAINT `place_idaccount_foreign` FOREIGN KEY (`idAccount`) REFERENCES `Account` (`idAccount`),
  ADD CONSTRAINT `place_idtype_foreign` FOREIGN KEY (`idType`) REFERENCES `typePlace` (`idType`);

--
-- Constraints for table `Rating`
--
ALTER TABLE `Rating`
  ADD CONSTRAINT `rating_idtypeservice_foreign` FOREIGN KEY (`idTypeService`) REFERENCES `typeService` (`idTypeService`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
