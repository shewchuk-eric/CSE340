-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 19, 2023 at 04:39 AM
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
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(11) NOT NULL,
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
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', 'lambo-Adve.jpg', 'lambo-Adve-tn.jpg', 417650, 1, 'Blue', 3),
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
(24, 'Ford', 'Pinto', 'Ralph Nader called this car unsafe at any speed. He must be a Chevy guy.', 'pinto.jpg', 'pinto-tn.jpg', 1000, 1, 'White/Orange', 5);

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
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

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
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
