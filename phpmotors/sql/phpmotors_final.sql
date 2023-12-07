-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 07, 2023 at 10:16 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(11) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(7, 'Bruce', 'Banner', 'meangreen@gmail.com', '$2y$10$Q.3nXTunJlriaXrt0Owh1uBEIcc3gCAPBJOFoXncAkSCLLDsFxXse', '1', NULL),
(8, 'Gordon', 'Ramsey', 'eatgood@yahoo.com', '$2y$10$.aRAaxyuT8ARnUHONxAIqOg14Ar//c9qtamd8XzFwH5t5U/ZMJT0i', '1', NULL),
(10, 'Yogi', 'Bear', 'picnicbasket@aol.com', '$2y$10$VXYuHtmDi7LgCoWxFL3Cwemf9nVvJIeojGsBu1mbNs0rPhuJ3IcuK', '1', NULL),
(13, 'Boo', 'Boo', 'littlebear2@icloud.me', '$2y$10$lHWwJSxwX/ysHduDmo6Mz./tmLdv/kzcYgKMr8XlNnP01X6EtRnT.', '1', NULL),
(14, 'He', 'Man', 'ihavethepower@gmail.com', '$2y$10$uxnt5VUA8.R1K6wNzJ5QIOppqWDiKxI44bda5qqDYR.BKWVYj.BIu', '1', NULL),
(16, 'John', 'Jeanplong', 'idivedeep@yahoo.com', '$2y$10$.BDFdBvvFJIFz8KZPKbnX.6HoNlTJdLW/VBKB8nWEN5fzHhkPV28i', '1', NULL),
(17, 'John', 'Wayne', 'sixgunguy@aol.com', '$2y$10$7/uMcjfpiPLZBwwn5KRiVOrZ5OXwKPqMSmwdSSool2OOJNgYyVzQS', '1', NULL),
(18, 'Doogie', 'Howser', 'kiddoctor@icloud.me', '$2y$10$oYcbZSxxe.2q8fMtSza9i.iCqSY1Adv.zq4sR7wvYXmRuU0yL6XCi', '1', NULL),
(20, 'Luke', 'Skywalker', 'usetheforce@power.com', '$2y$10$vO7jxdeYeOzBPtrD6UAMq.D.yqNYMFZ1IoTFYchztKnR2TZPy6oT6', '1', NULL),
(22, 'Admin', 'User', 'admin@cse340.net', '$2y$10$Jf4geom7cz6k0jHYB6qOL.BXN0CvMQWwA3aQqMYlB7c/hM5MmO0qm', '3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) NOT NULL,
  `imgPath` varchar(150) NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(7, 1, 'wrangler.jpg', '/phpmotors/images/vehicles/wrangler.jpg', '2023-11-24 01:00:03', 1),
(8, 1, 'wrangler-tn.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '2023-11-24 01:00:03', 1),
(9, 2, 'ford-modelt.jpg', '/phpmotors/images/vehicles/ford-modelt.jpg', '2023-11-24 01:01:28', 1),
(10, 2, 'ford-modelt-tn.jpg', '/phpmotors/images/vehicles/ford-modelt-tn.jpg', '2023-11-24 01:01:28', 1),
(11, 3, 'lambo-Adve.jpg', '/phpmotors/images/vehicles/lambo-Adve.jpg', '2023-11-24 01:01:41', 1),
(12, 3, 'lambo-Adve-tn.jpg', '/phpmotors/images/vehicles/lambo-Adve-tn.jpg', '2023-11-24 01:01:41', 1),
(13, 4, 'monster.jpg', '/phpmotors/images/vehicles/monster.jpg', '2023-11-24 01:02:39', 1),
(14, 4, 'monster-tn.jpg', '/phpmotors/images/vehicles/monster-tn.jpg', '2023-11-24 01:02:39', 1),
(15, 5, 'ms.jpg', '/phpmotors/images/vehicles/ms.jpg', '2023-11-24 01:03:51', 1),
(16, 5, 'ms-tn.jpg', '/phpmotors/images/vehicles/ms-tn.jpg', '2023-11-24 01:03:51', 1),
(17, 6, 'bat.jpg', '/phpmotors/images/vehicles/bat.jpg', '2023-11-24 01:04:01', 1),
(18, 6, 'bat-tn.jpg', '/phpmotors/images/vehicles/bat-tn.jpg', '2023-11-24 01:04:01', 1),
(19, 7, 'mm.jpg', '/phpmotors/images/vehicles/mm.jpg', '2023-11-24 01:04:15', 1),
(20, 7, 'mm-tn.jpg', '/phpmotors/images/vehicles/mm-tn.jpg', '2023-11-24 01:04:15', 1),
(21, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2023-11-24 01:04:34', 1),
(22, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2023-11-24 01:04:34', 1),
(23, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2023-11-24 01:05:58', 1),
(24, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2023-11-24 01:05:58', 1),
(25, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2023-11-24 01:06:25', 1),
(26, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2023-11-24 01:06:25', 1),
(27, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2023-11-24 01:06:36', 1),
(28, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2023-11-24 01:06:36', 1),
(29, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2023-11-24 01:06:47', 1),
(30, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2023-11-24 01:06:47', 1),
(31, 14, 'fbi.jpg', '/phpmotors/images/vehicles/fbi.jpg', '2023-11-24 01:07:01', 1),
(32, 14, 'fbi-tn.jpg', '/phpmotors/images/vehicles/fbi-tn.jpg', '2023-11-24 01:07:01', 1),
(33, 15, 'dogcar.jpg', '/phpmotors/images/vehicles/dogcar.jpg', '2023-11-24 01:07:12', 1),
(34, 15, 'dogcar-tn.jpg', '/phpmotors/images/vehicles/dogcar-tn.jpg', '2023-11-24 01:07:12', 1),
(35, 17, 'gremlin.jpg', '/phpmotors/images/vehicles/gremlin.jpg', '2023-11-24 01:07:25', 1),
(36, 17, 'gremlin-tn.jpg', '/phpmotors/images/vehicles/gremlin-tn.jpg', '2023-11-24 01:07:25', 1),
(37, 19, 'dart.jpg', '/phpmotors/images/vehicles/dart.jpg', '2023-11-24 01:07:37', 1),
(38, 19, 'dart-tn.jpg', '/phpmotors/images/vehicles/dart-tn.jpg', '2023-11-24 01:07:37', 1),
(39, 20, 'charger.jpg', '/phpmotors/images/vehicles/charger.jpg', '2023-11-24 01:07:50', 1),
(40, 20, 'charger-tn.jpg', '/phpmotors/images/vehicles/charger-tn.jpg', '2023-11-24 01:07:50', 1),
(41, 21, 'caravan.jpg', '/phpmotors/images/vehicles/caravan.jpg', '2023-11-24 01:08:03', 1),
(42, 21, 'caravan-tn.jpg', '/phpmotors/images/vehicles/caravan-tn.jpg', '2023-11-24 01:08:03', 1),
(43, 24, 'pinto.jpg', '/phpmotors/images/vehicles/pinto.jpg', '2023-11-24 01:08:14', 1),
(44, 24, 'pinto-tn.jpg', '/phpmotors/images/vehicles/pinto-tn.jpg', '2023-11-24 01:08:14', 1),
(47, 25, 'delorean-interior.jpg', '/phpmotors/images/vehicles/delorean-interior.jpg', '2023-11-24 01:21:29', 0),
(48, 25, 'delorean-interior-tn.jpg', '/phpmotors/images/vehicles/delorean-interior-tn.jpg', '2023-11-24 01:21:29', 0),
(49, 25, 'delorean-rear.jpg', '/phpmotors/images/vehicles/delorean-rear.jpg', '2023-11-24 01:21:41', 0),
(50, 25, 'delorean-rear-tn.jpg', '/phpmotors/images/vehicles/delorean-rear-tn.jpg', '2023-11-24 01:21:41', 0),
(51, 25, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2023-11-24 01:22:19', 1),
(52, 25, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2023-11-24 01:22:19', 1),
(53, 19, 'dart-rear.jpg', '/phpmotors/images/vehicles/dart-rear.jpg', '2023-11-24 01:26:43', 0),
(54, 19, 'dart-rear-tn.jpg', '/phpmotors/images/vehicles/dart-rear-tn.jpg', '2023-11-24 01:26:43', 0),
(55, 19, 'dart-interior.jpg', '/phpmotors/images/vehicles/dart-interior.jpg', '2023-11-24 01:26:53', 0),
(56, 19, 'dart-interior-tn.jpg', '/phpmotors/images/vehicles/dart-interior-tn.jpg', '2023-11-24 01:26:53', 0),
(57, 3, 'lambo-interior.jpg', '/phpmotors/images/vehicles/lambo-interior.jpg', '2023-11-24 01:29:08', 0),
(58, 3, 'lambo-interior-tn.jpg', '/phpmotors/images/vehicles/lambo-interior-tn.jpg', '2023-11-24 01:29:08', 0),
(59, 3, 'lambo-open.jpg', '/phpmotors/images/vehicles/lambo-open.jpg', '2023-11-24 01:29:18', 0),
(60, 3, 'lambo-open-tn.jpg', '/phpmotors/images/vehicles/lambo-open-tn.jpg', '2023-11-24 01:29:18', 0),
(61, 10, 'camaro-2.jpg', '/phpmotors/images/vehicles/camaro-2.jpg', '2023-11-24 01:31:27', 0),
(62, 10, 'camaro-2-tn.jpg', '/phpmotors/images/vehicles/camaro-2-tn.jpg', '2023-11-24 01:31:27', 0),
(63, 10, 'camaro-back.jpg', '/phpmotors/images/vehicles/camaro-back.jpg', '2023-11-24 01:31:39', 0),
(64, 10, 'camaro-back-tn.jpg', '/phpmotors/images/vehicles/camaro-back-tn.jpg', '2023-11-24 01:31:39', 0),
(65, 10, 'camaro-interior.png', '/phpmotors/images/vehicles/camaro-interior.png', '2023-11-24 01:31:48', 0),
(66, 10, 'camaro-interior-tn.png', '/phpmotors/images/vehicles/camaro-interior-tn.png', '2023-11-24 01:31:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` int(10) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!', 'wrangler.jpg', 'wrangler-tn.jpg', 28045, 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.', 'ford-modelt.jpg', 'ford-modelt-tn.jpg', 30000, 2, 'Black', 2),
(3, 'Lamborghini', 'Aventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', 'lambo-Adve.jpg', 'lambo-Adve-tn.jpg', 417650, 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.', 'monster.jpg', 'monster-tn.jpg', 150000, 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. However, with a little tender loving care it will run as good a new.', 'ms.jpg', 'ms-tn.jpg', 100, 1, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.', 'bat.jpg', 'bat-tn.jpg', 65000, 1, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', 'mm.jpg', 'mm-tn.jpg', 10000, 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.', 'fire-truck.jpg', 'fire-truck-tn.jpg', 50000, 1, 'Red', 4),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', 'camaro.jpg', 'camaro-tn.jpg', 25000, 10, 'Silver', 3),
(11, 'Cadillac', 'Escalade', 'This behemoth is great for any occasion from going to the beach to running down the president. The luxurious inside makes this car a home away from home.', 'escalade.jpg', 'escalade-tn.jpg', 75195, 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go off-roading? The Hummer gives you an enormous interior with an engine to get you out of any muddy or rocky situation.', 'hummer.jpg', 'hummer-tn.jpg', 58800, 5, 'Silver', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!', 'aerocar.jpg', 'aerocar-tn.jpg', 100000, 1, 'Red', 2),
(14, 'FBI', 'Surveillance Van', 'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month.', 'fbi.jpg', 'fbi-tn.jpg', 20000, 1, 'Green', 1),
(15, 'Dog', 'Car', 'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.', 'dogcar.jpg', 'dogcar-tn.jpg', 35000, 1, 'Brown', 2),
(17, 'AMC', 'Gremlin', 'It&#039;s junk but it&#039;s cheap.', 'gremlin.jpg', 'gremlin-tn.jpg', 2000, 1, 'Gold', 5),
(19, 'Dodge', 'Dart', 'Not the worst car you can find.', 'dart.jpg', 'dart-tn.jpg', 4500, 1, 'Dark Charcoal Gray', 5),
(20, 'Dodge', 'Charger', 'You want muscle? Don&#039;t waste your time in the gym. Get this car today!', 'charger.jpg', 'charger-tn.jpg', 28000, 1, 'Army Green', 2),
(21, 'Dodge', 'Caravan', 'Room for the whole crew.', 'caravan.jpg', 'caravan-tn.jpg', 9250, 3, 'White', 5),
(24, 'Ford', 'Pinto', 'Ralph Nader called this car unsafe at any speed. He must be a Chevy guy.', 'pinto.jpg', 'pinto-tn.jpg', 1000, 1, 'White/Orange', 5),
(25, 'DMC', 'DeLorean', 'Almost as fast as a lightning bolt.', 'delorean.jpg', 'delorean.jpg', 198100, 1, 'Stainless Steel', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(9, 'Some WD-40 and a can of Rustoleum... good as new.', '2023-11-30 10:00:00', 5, 22),
(10, 'Traffic no longer gets me down.', '2023-11-30 10:00:00', 13, 22),
(11, 'The car goes almost as fast as the gas!', '2023-11-28 10:00:00', 3, 22),
(12, 'Sturdier than my x-wing fighter.', '2023-11-26 10:00:00', 12, 20),
(13, 'There&#039;s nothing like this on Endor!', '2023-11-30 10:00:00', 2, 20),
(15, 'More muscle than the Hulk', '2023-10-27 20:49:08', 20, 7),
(16, 'My buddy drives one of these.  All kinds of bells and whistles.', '2023-08-23 20:51:17', 6, 7),
(17, 'Perfect for going on a picnic.', '2010-10-29 10:00:00', 2, 10),
(18, 'Even faster than a round from my sixgun.', '2023-11-07 20:57:38', 20, 17),
(19, 'Driving this thing makes me want to pull out my hose everywhere I go.', '2023-09-19 22:14:54', 8, 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`),
  ADD UNIQUE KEY `clientEmail` (`clientEmail`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `FC_inv_images` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_inventory` (`invId`),
  ADD KEY `FK_reviews_clients` (`clientId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FC_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
