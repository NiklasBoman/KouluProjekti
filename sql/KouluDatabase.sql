-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11.11.2025 klo 07:48
-- Palvelimen versio: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kouludatabase`
--

-- --------------------------------------------------------
-- Lisätään kuva- URL tietookantaan jottai saadaan API:lla haettua kuvat luokille
-- --------------------------------------------------------
--
--

ALTER TABLE huoneet
ADD COLUMN KuvaURL VARCHAR(255) AFTER Paikat;

ALTER TABLE kayttajat
ADD COLUMN Profiilikuva VARCHAR(255) AFTER PuhelinNro;

--
--
-- --------------------------------------------------------

--
-- Rakenne taululle `huoneet`
--

CREATE TABLE `huoneet` (
  `HuoneID` int(11) NOT NULL,
  `HuoneNimi` varchar(50) NOT NULL,
  `Rakennus` varchar(50) NOT NULL,
  `Kerros` int(11) NOT NULL,
  `Paikat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `huoneet`
--

INSERT INTO `huoneet` (`HuoneID`, `HuoneNimi`, `Rakennus`, `Kerros`, `Paikat`) VALUES
(1, 'A101', 'Päärakennus', 1, 25),
(2, 'A102', 'Päärakennus', 1, 30),
(3, 'B201', 'Teknologiatalo', 2, 20),
(4, 'C305', 'Musiikkitalo', 3, 15),
(5, 'A101', 'Päärakennus', 1, 14),
(6, 'A102', 'Päärakennus', 1, 11),
(7, 'A103', 'Päärakennus', 1, 29),
(8, 'A104', 'Päärakennus', 1, 23),
(9, 'A105', 'Päärakennus', 1, 21),
(10, 'A106', 'Päärakennus', 1, 26),
(11, 'A107', 'Päärakennus', 1, 29),
(12, 'A108', 'Päärakennus', 1, 34),
(13, 'A109', 'Päärakennus', 1, 20),
(14, 'A110', 'Päärakennus', 1, 17),
(15, 'A201', 'Päärakennus', 2, 13),
(16, 'A202', 'Päärakennus', 2, 32),
(17, 'A203', 'Päärakennus', 2, 31),
(18, 'A204', 'Päärakennus', 2, 25),
(19, 'A205', 'Päärakennus', 2, 22),
(20, 'A206', 'Päärakennus', 2, 26),
(21, 'A207', 'Päärakennus', 2, 27),
(22, 'A208', 'Päärakennus', 2, 21),
(23, 'A209', 'Päärakennus', 2, 14),
(24, 'A210', 'Päärakennus', 2, 26),
(25, 'A301', 'Päärakennus', 3, 26),
(26, 'A302', 'Päärakennus', 3, 15),
(27, 'A303', 'Päärakennus', 3, 14),
(28, 'A304', 'Päärakennus', 3, 16),
(29, 'A305', 'Päärakennus', 3, 28),
(30, 'A306', 'Päärakennus', 3, 32),
(31, 'A307', 'Päärakennus', 3, 12),
(32, 'A308', 'Päärakennus', 3, 33),
(33, 'A309', 'Päärakennus', 3, 15),
(34, 'A310', 'Päärakennus', 3, 17),
(35, 'B101', 'Teknologiatalo', 1, 33),
(36, 'B102', 'Teknologiatalo', 1, 24),
(37, 'B103', 'Teknologiatalo', 1, 12),
(38, 'B104', 'Teknologiatalo', 1, 29),
(39, 'B105', 'Teknologiatalo', 1, 23),
(40, 'B106', 'Teknologiatalo', 1, 20),
(41, 'B107', 'Teknologiatalo', 1, 21),
(42, 'B108', 'Teknologiatalo', 1, 35),
(43, 'B109', 'Teknologiatalo', 1, 24),
(44, 'B110', 'Teknologiatalo', 1, 30),
(45, 'B201', 'Teknologiatalo', 2, 19),
(46, 'B202', 'Teknologiatalo', 2, 22),
(47, 'B203', 'Teknologiatalo', 2, 15),
(48, 'B204', 'Teknologiatalo', 2, 25),
(49, 'B205', 'Teknologiatalo', 2, 20),
(50, 'B206', 'Teknologiatalo', 2, 13),
(51, 'B207', 'Teknologiatalo', 2, 25),
(52, 'B208', 'Teknologiatalo', 2, 23),
(53, 'B209', 'Teknologiatalo', 2, 33),
(54, 'B210', 'Teknologiatalo', 2, 32),
(55, 'B301', 'Teknologiatalo', 3, 24),
(56, 'B302', 'Teknologiatalo', 3, 17),
(57, 'B303', 'Teknologiatalo', 3, 27),
(58, 'B304', 'Teknologiatalo', 3, 23),
(59, 'B305', 'Teknologiatalo', 3, 24),
(60, 'B306', 'Teknologiatalo', 3, 17),
(61, 'B307', 'Teknologiatalo', 3, 29),
(62, 'B308', 'Teknologiatalo', 3, 34),
(63, 'B309', 'Teknologiatalo', 3, 22),
(64, 'B310', 'Teknologiatalo', 3, 22),
(65, 'C101', 'Musiikkitalo', 1, 35),
(66, 'C102', 'Musiikkitalo', 1, 23),
(67, 'C103', 'Musiikkitalo', 1, 27),
(68, 'C104', 'Musiikkitalo', 1, 31),
(69, 'C105', 'Musiikkitalo', 1, 10),
(70, 'C106', 'Musiikkitalo', 1, 27),
(71, 'C107', 'Musiikkitalo', 1, 19),
(72, 'C108', 'Musiikkitalo', 1, 28),
(73, 'C109', 'Musiikkitalo', 1, 23),
(74, 'C110', 'Musiikkitalo', 1, 19),
(75, 'C201', 'Musiikkitalo', 2, 18),
(76, 'C202', 'Musiikkitalo', 2, 22),
(77, 'C203', 'Musiikkitalo', 2, 20),
(78, 'C204', 'Musiikkitalo', 2, 24),
(79, 'C205', 'Musiikkitalo', 2, 26),
(80, 'C206', 'Musiikkitalo', 2, 23),
(81, 'C207', 'Musiikkitalo', 2, 27),
(82, 'C208', 'Musiikkitalo', 2, 31),
(83, 'C209', 'Musiikkitalo', 2, 14),
(84, 'C210', 'Musiikkitalo', 2, 19),
(85, 'C301', 'Musiikkitalo', 3, 16),
(86, 'C302', 'Musiikkitalo', 3, 16),
(87, 'C303', 'Musiikkitalo', 3, 22),
(88, 'C304', 'Musiikkitalo', 3, 26),
(89, 'C305', 'Musiikkitalo', 3, 28),
(90, 'C306', 'Musiikkitalo', 3, 29),
(91, 'C307', 'Musiikkitalo', 3, 23),
(92, 'C308', 'Musiikkitalo', 3, 19),
(93, 'C309', 'Musiikkitalo', 3, 17),
(94, 'C310', 'Musiikkitalo', 3, 20),
(95, 'D101', 'Merkonomitalo', 1, 14),
(96, 'D102', 'Merkonomitalo', 1, 23),
(97, 'D103', 'Merkonomitalo', 1, 15),
(98, 'D104', 'Merkonomitalo', 1, 20),
(99, 'D105', 'Merkonomitalo', 1, 20),
(100, 'D106', 'Merkonomitalo', 1, 33),
(101, 'D107', 'Merkonomitalo', 1, 15),
(102, 'D108', 'Merkonomitalo', 1, 20),
(103, 'D109', 'Merkonomitalo', 1, 18),
(104, 'D110', 'Merkonomitalo', 1, 21),
(105, 'D201', 'Merkonomitalo', 2, 17),
(106, 'D202', 'Merkonomitalo', 2, 35),
(107, 'D203', 'Merkonomitalo', 2, 14),
(108, 'D204', 'Merkonomitalo', 2, 32),
(109, 'D205', 'Merkonomitalo', 2, 30),
(110, 'D206', 'Merkonomitalo', 2, 19),
(111, 'D207', 'Merkonomitalo', 2, 21),
(112, 'D208', 'Merkonomitalo', 2, 13),
(113, 'D209', 'Merkonomitalo', 2, 21),
(114, 'D210', 'Merkonomitalo', 2, 27),
(115, 'D301', 'Merkonomitalo', 3, 10),
(116, 'D302', 'Merkonomitalo', 3, 14),
(117, 'D303', 'Merkonomitalo', 3, 31),
(118, 'D304', 'Merkonomitalo', 3, 25),
(119, 'D305', 'Merkonomitalo', 3, 24),
(120, 'D306', 'Merkonomitalo', 3, 35),
(121, 'D307', 'Merkonomitalo', 3, 13),
(122, 'D308', 'Merkonomitalo', 3, 32),
(123, 'D309', 'Merkonomitalo', 3, 30),
(124, 'D310', 'Merkonomitalo', 3, 21),
(125, 'E101', 'Autoala', 1, 32),
(126, 'E102', 'Autoala', 1, 34),
(127, 'E103', 'Autoala', 1, 14),
(128, 'E104', 'Autoala', 1, 35),
(129, 'E105', 'Autoala', 1, 18),
(130, 'E106', 'Autoala', 1, 29),
(131, 'E107', 'Autoala', 1, 30),
(132, 'E108', 'Autoala', 1, 28),
(133, 'E109', 'Autoala', 1, 13),
(134, 'E110', 'Autoala', 1, 22),
(135, 'E201', 'Autoala', 2, 11),
(136, 'E202', 'Autoala', 2, 31),
(137, 'E203', 'Autoala', 2, 35),
(138, 'E204', 'Autoala', 2, 19),
(139, 'E205', 'Autoala', 2, 34),
(140, 'E206', 'Autoala', 2, 23),
(141, 'E207', 'Autoala', 2, 32),
(142, 'E208', 'Autoala', 2, 31),
(143, 'E209', 'Autoala', 2, 20),
(144, 'E210', 'Autoala', 2, 27),
(145, 'E301', 'Autoala', 3, 10),
(146, 'E302', 'Autoala', 3, 14),
(147, 'E303', 'Autoala', 3, 29),
(148, 'E304', 'Autoala', 3, 18),
(149, 'E305', 'Autoala', 3, 16),
(150, 'E306', 'Autoala', 3, 18),
(151, 'E307', 'Autoala', 3, 33),
(152, 'E308', 'Autoala', 3, 23),
(153, 'E309', 'Autoala', 3, 31),
(154, 'E310', 'Autoala', 3, 26),
(155, 'F101', 'Kosmetologiala', 1, 27),
(156, 'F102', 'Kosmetologiala', 1, 22),
(157, 'F103', 'Kosmetologiala', 1, 19),
(158, 'F104', 'Kosmetologiala', 1, 19),
(159, 'F105', 'Kosmetologiala', 1, 29),
(160, 'F106', 'Kosmetologiala', 1, 26),
(161, 'F107', 'Kosmetologiala', 1, 33),
(162, 'F108', 'Kosmetologiala', 1, 27),
(163, 'F109', 'Kosmetologiala', 1, 26),
(164, 'F110', 'Kosmetologiala', 1, 14),
(165, 'F201', 'Kosmetologiala', 2, 35),
(166, 'F202', 'Kosmetologiala', 2, 17),
(167, 'F203', 'Kosmetologiala', 2, 24),
(168, 'F204', 'Kosmetologiala', 2, 35),
(169, 'F205', 'Kosmetologiala', 2, 15),
(170, 'F206', 'Kosmetologiala', 2, 11),
(171, 'F207', 'Kosmetologiala', 2, 29),
(172, 'F208', 'Kosmetologiala', 2, 22),
(173, 'F209', 'Kosmetologiala', 2, 16),
(174, 'F210', 'Kosmetologiala', 2, 29),
(175, 'F301', 'Kosmetologiala', 3, 10),
(176, 'F302', 'Kosmetologiala', 3, 33),
(177, 'F303', 'Kosmetologiala', 3, 21),
(178, 'F304', 'Kosmetologiala', 3, 22),
(179, 'F305', 'Kosmetologiala', 3, 10),
(180, 'F306', 'Kosmetologiala', 3, 28),
(181, 'F307', 'Kosmetologiala', 3, 23),
(182, 'F308', 'Kosmetologiala', 3, 23),
(183, 'F309', 'Kosmetologiala', 3, 35),
(184, 'F310', 'Kosmetologiala', 3, 19);

-- --------------------------------------------------------

--
-- Rakenne taululle `kayttajat`
--

CREATE TABLE `kayttajat` (
  `KayttajaID` int(11) NOT NULL,
  `Nimi` varchar(50) NOT NULL,
  `Gmail` varchar(100) NOT NULL,
  `SalasanaHash` varchar(255) NOT NULL,
  `PuhelinNro` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `kayttajat`
--

INSERT INTO `kayttajat` (`KayttajaID`, `Nimi`, `Gmail`, `SalasanaHash`, `PuhelinNro`) VALUES
(1, 'Topi', 'topi@example.com', '$2y$10$nOUIs5kJ7naTuTFkBy1veuK0kSxUFXfuaOKdOKf9xYT0KKIGSJwFa', '0401234567'),
(2, 'topi2', 'topi2@gmail.com', '$2y$10$tL6xJZphXPrTuZQgR4P5e.L.WX3hWW.2Q5hefbvAl8MhtKJpg63JW', '0402733844');

-- --------------------------------------------------------

--
-- Rakenne taululle `varaukset`
--

CREATE TABLE `varaukset` (
  `VarausID` int(11) NOT NULL,
  `KayttajaID` int(11) NOT NULL,
  `HuoneID` int(11) NOT NULL,
  `VarausAlku` datetime NOT NULL,
  `VarausLoppu` datetime NOT NULL,
  `VarausStatus` varchar(50) DEFAULT 'varattu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `varaukset`
--

INSERT INTO `varaukset` (`VarausID`, `KayttajaID`, `HuoneID`, `VarausAlku`, `VarausLoppu`, `VarausStatus`) VALUES
(1, 2, 3, '2025-11-03 00:00:00', '2025-11-12 00:00:00', 'varattu'),
(3, 2, 2, '2025-11-11 00:00:00', '2025-11-12 00:00:00', 'varattu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `huoneet`
--
ALTER TABLE `huoneet`
  ADD PRIMARY KEY (`HuoneID`);

--
-- Indexes for table `kayttajat`
--
ALTER TABLE `kayttajat`
  ADD PRIMARY KEY (`KayttajaID`),
  ADD UNIQUE KEY `Gmail` (`Gmail`);

--
-- Indexes for table `varaukset`
--
ALTER TABLE `varaukset`
  ADD PRIMARY KEY (`VarausID`),
  ADD KEY `KayttajaID` (`KayttajaID`),
  ADD KEY `HuoneID` (`HuoneID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `huoneet`
--
ALTER TABLE `huoneet`
  MODIFY `HuoneID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `kayttajat`
--
ALTER TABLE `kayttajat`
  MODIFY `KayttajaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `varaukset`
--
ALTER TABLE `varaukset`
  MODIFY `VarausID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Rajoitteet vedostauluille
--

--
-- Rajoitteet taululle `varaukset`
--
ALTER TABLE `varaukset`
  ADD CONSTRAINT `varaukset_ibfk_1` FOREIGN KEY (`KayttajaID`) REFERENCES `kayttajat` (`KayttajaID`) ON DELETE CASCADE,
  ADD CONSTRAINT `varaukset_ibfk_2` FOREIGN KEY (`HuoneID`) REFERENCES `huoneet` (`HuoneID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
