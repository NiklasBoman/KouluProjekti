-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13.11.2025 klo 11:19
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

--
-- Rakenne taululle `huoneet`
--

CREATE TABLE `huoneet` (
  `HuoneID` int(11) NOT NULL,
  `HuoneNimi` varchar(50) NOT NULL,
  `Rakennus` varchar(50) NOT NULL,
  `Kerros` int(11) NOT NULL,
  `Paikat` int(11) NOT NULL,
  `KuvaURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `huoneet`
--

INSERT INTO `huoneet` (`HuoneID`, `HuoneNimi`, `Rakennus`, `Kerros`, `Paikat`, `KuvaURL`) VALUES
(1, 'A101', 'Päärakennus', 1, 25, 'https://images.pexels.com/photos/8423429/pexels-photo-8423429.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(2, 'A102', 'Päärakennus', 1, 30, 'https://images.pexels.com/photos/8473000/pexels-photo-8473000.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(3, 'B201', 'Teknologiatalo', 2, 20, 'https://images.pexels.com/photos/8382220/pexels-photo-8382220.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(4, 'C305', 'Musiikkitalo', 3, 15, 'https://images.pexels.com/photos/30105084/pexels-photo-30105084.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(5, 'A101', 'Päärakennus', 1, 14, 'https://images.pexels.com/photos/5676742/pexels-photo-5676742.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(6, 'A102', 'Päärakennus', 1, 11, 'https://images.pexels.com/photos/5756657/pexels-photo-5756657.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(7, 'A103', 'Päärakennus', 1, 29, 'https://images.pexels.com/photos/5530454/pexels-photo-5530454.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(8, 'A104', 'Päärakennus', 1, 23, 'https://images.pexels.com/photos/6683392/pexels-photo-6683392.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(9, 'A105', 'Päärakennus', 1, 21, 'https://images.pexels.com/photos/6193937/pexels-photo-6193937.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(10, 'A106', 'Päärakennus', 1, 26, 'https://images.pexels.com/photos/7396381/pexels-photo-7396381.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(11, 'A107', 'Päärakennus', 1, 29, 'https://images.pexels.com/photos/10638070/pexels-photo-10638070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(12, 'A108', 'Päärakennus', 1, 34, 'https://images.pexels.com/photos/8926887/pexels-photo-8926887.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(13, 'A109', 'Päärakennus', 1, 20, 'https://images.pexels.com/photos/16007661/pexels-photo-16007661.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(14, 'A110', 'Päärakennus', 1, 17, 'https://images.pexels.com/photos/3793598/pexels-photo-3793598.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(15, 'A201', 'Päärakennus', 2, 13, 'https://images.pexels.com/photos/4936021/pexels-photo-4936021.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(16, 'A202', 'Päärakennus', 2, 32, 'https://images.pexels.com/photos/5428142/pexels-photo-5428142.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(17, 'A203', 'Päärakennus', 2, 31, 'https://images.pexels.com/photos/5427655/pexels-photo-5427655.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(18, 'A204', 'Päärakennus', 2, 25, 'https://images.pexels.com/photos/8653519/pexels-photo-8653519.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(19, 'A205', 'Päärakennus', 2, 22, 'https://images.pexels.com/photos/7929263/pexels-photo-7929263.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(20, 'A206', 'Päärakennus', 2, 26, 'https://images.pexels.com/photos/8423006/pexels-photo-8423006.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(21, 'A207', 'Päärakennus', 2, 27, 'https://images.pexels.com/photos/9300740/pexels-photo-9300740.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(22, 'A208', 'Päärakennus', 2, 21, 'https://images.pexels.com/photos/5905509/pexels-photo-5905509.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(23, 'A209', 'Päärakennus', 2, 14, 'https://images.pexels.com/photos/5940836/pexels-photo-5940836.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(24, 'A210', 'Päärakennus', 2, 26, 'https://images.pexels.com/photos/6684067/pexels-photo-6684067.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(25, 'A301', 'Päärakennus', 3, 26, 'https://images.pexels.com/photos/12197311/pexels-photo-12197311.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(26, 'A302', 'Päärakennus', 3, 15, 'https://images.pexels.com/photos/10127243/pexels-photo-10127243.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(27, 'A303', 'Päärakennus', 3, 14, 'https://images.pexels.com/photos/9743012/pexels-photo-9743012.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(28, 'A304', 'Päärakennus', 3, 16, 'https://images.pexels.com/photos/6209560/pexels-photo-6209560.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(29, 'A305', 'Päärakennus', 3, 28, 'https://images.pexels.com/photos/8423437/pexels-photo-8423437.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(30, 'A306', 'Päärakennus', 3, 32, 'https://images.pexels.com/photos/8423457/pexels-photo-8423457.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(31, 'A307', 'Päärakennus', 3, 12, 'https://images.pexels.com/photos/8456143/pexels-photo-8456143.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(32, 'A308', 'Päärakennus', 3, 33, 'https://images.pexels.com/photos/8472990/pexels-photo-8472990.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(33, 'A309', 'Päärakennus', 3, 15, 'https://images.pexels.com/photos/8466006/pexels-photo-8466006.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(34, 'A310', 'Päärakennus', 3, 17, 'https://images.pexels.com/photos/5905618/pexels-photo-5905618.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(35, 'B101', 'Teknologiatalo', 1, 33, 'https://images.pexels.com/photos/5905859/pexels-photo-5905859.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(36, 'B102', 'Teknologiatalo', 1, 24, 'https://images.pexels.com/photos/12168810/pexels-photo-12168810.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(37, 'B103', 'Teknologiatalo', 1, 12, 'https://images.pexels.com/photos/15759620/pexels-photo-15759620.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(38, 'B104', 'Teknologiatalo', 1, 29, 'https://images.pexels.com/photos/18734744/pexels-photo-18734744.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(39, 'B105', 'Teknologiatalo', 1, 23, 'https://images.pexels.com/photos/159806/meeting-modern-room-conference-159806.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(40, 'B106', 'Teknologiatalo', 1, 20, 'https://images.pexels.com/photos/2882657/pexels-photo-2882657.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(41, 'B107', 'Teknologiatalo', 1, 21, 'https://images.pexels.com/photos/4143799/pexels-photo-4143799.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(42, 'B108', 'Teknologiatalo', 1, 35, 'https://images.pexels.com/photos/5412132/pexels-photo-5412132.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(43, 'B109', 'Teknologiatalo', 1, 24, 'https://images.pexels.com/photos/5427823/pexels-photo-5427823.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(44, 'B110', 'Teknologiatalo', 1, 30, 'https://images.pexels.com/photos/5211475/pexels-photo-5211475.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(45, 'B201', 'Teknologiatalo', 2, 19, 'https://images.pexels.com/photos/5756562/pexels-photo-5756562.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(46, 'B202', 'Teknologiatalo', 2, 22, 'https://images.pexels.com/photos/5756572/pexels-photo-5756572.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(47, 'B203', 'Teknologiatalo', 2, 15, 'https://images.pexels.com/photos/4260476/pexels-photo-4260476.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(48, 'B204', 'Teknologiatalo', 2, 25, 'https://images.pexels.com/photos/6340664/pexels-photo-6340664.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(49, 'B205', 'Teknologiatalo', 2, 20, 'https://images.pexels.com/photos/6517335/pexels-photo-6517335.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(50, 'B206', 'Teknologiatalo', 2, 13, 'https://images.pexels.com/photos/5905530/pexels-photo-5905530.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(51, 'B207', 'Teknologiatalo', 2, 25, 'https://images.pexels.com/photos/5905451/pexels-photo-5905451.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(52, 'B208', 'Teknologiatalo', 2, 23, 'https://images.pexels.com/photos/6238008/pexels-photo-6238008.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(53, 'B209', 'Teknologiatalo', 2, 33, 'https://images.pexels.com/photos/6936476/pexels-photo-6936476.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(54, 'B210', 'Teknologiatalo', 2, 32, 'https://images.pexels.com/photos/6937753/pexels-photo-6937753.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(55, 'B301', 'Teknologiatalo', 3, 24, 'https://images.pexels.com/photos/5257893/pexels-photo-5257893.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(56, 'B302', 'Teknologiatalo', 3, 17, 'https://images.pexels.com/photos/5676743/pexels-photo-5676743.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(57, 'B303', 'Teknologiatalo', 3, 27, 'https://images.pexels.com/photos/6683451/pexels-photo-6683451.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(58, 'B304', 'Teknologiatalo', 3, 23, 'https://images.pexels.com/photos/6683887/pexels-photo-6683887.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(59, 'B305', 'Teknologiatalo', 3, 24, 'https://images.pexels.com/photos/5530450/pexels-photo-5530450.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(60, 'B306', 'Teknologiatalo', 3, 17, 'https://images.pexels.com/photos/8382263/pexels-photo-8382263.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(61, 'B307', 'Teknologiatalo', 3, 29, 'https://images.pexels.com/photos/8419515/pexels-photo-8419515.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(62, 'B308', 'Teknologiatalo', 3, 34, 'https://images.pexels.com/photos/8472850/pexels-photo-8472850.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(63, 'B309', 'Teknologiatalo', 3, 22, 'https://images.pexels.com/photos/8541881/pexels-photo-8541881.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(64, 'B310', 'Teknologiatalo', 3, 22, 'https://images.pexels.com/photos/8423019/pexels-photo-8423019.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(65, 'C101', 'Musiikkitalo', 1, 35, 'https://images.pexels.com/photos/7868832/pexels-photo-7868832.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(66, 'C102', 'Musiikkitalo', 1, 23, 'https://images.pexels.com/photos/8501770/pexels-photo-8501770.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(67, 'C103', 'Musiikkitalo', 1, 27, 'https://images.pexels.com/photos/7407385/pexels-photo-7407385.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(68, 'C104', 'Musiikkitalo', 1, 31, 'https://images.pexels.com/photos/7407116/pexels-photo-7407116.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(69, 'C105', 'Musiikkitalo', 1, 10, 'https://images.pexels.com/photos/8342372/pexels-photo-8342372.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(70, 'C106', 'Musiikkitalo', 1, 27, 'https://images.pexels.com/photos/6990252/pexels-photo-6990252.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(71, 'C107', 'Musiikkitalo', 1, 19, 'https://images.pexels.com/photos/6990426/pexels-photo-6990426.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(72, 'C108', 'Musiikkitalo', 1, 28, 'https://images.pexels.com/photos/8653984/pexels-photo-8653984.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(73, 'C109', 'Musiikkitalo', 1, 23, 'https://images.pexels.com/photos/9159281/pexels-photo-9159281.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(74, 'C110', 'Musiikkitalo', 1, 19, 'https://images.pexels.com/photos/12197305/pexels-photo-12197305.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(75, 'C201', 'Musiikkitalo', 2, 18, 'https://images.pexels.com/photos/18734743/pexels-photo-18734743.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(76, 'C202', 'Musiikkitalo', 2, 22, 'https://images.pexels.com/photos/27300375/pexels-photo-27300375.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(77, 'C203', 'Musiikkitalo', 2, 20, 'https://images.pexels.com/photos/28503354/pexels-photo-28503354.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(78, 'C204', 'Musiikkitalo', 2, 24, 'https://images.pexels.com/photos/32181832/pexels-photo-32181832.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(79, 'C205', 'Musiikkitalo', 2, 26, 'https://images.pexels.com/photos/33587210/pexels-photo-33587210.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(80, 'C206', 'Musiikkitalo', 2, 23, 'https://images.pexels.com/photos/33846282/pexels-photo-33846282.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(81, 'C207', 'Musiikkitalo', 2, 27, 'https://images.pexels.com/photos/8423429/pexels-photo-8423429.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(82, 'C208', 'Musiikkitalo', 2, 31, 'https://images.pexels.com/photos/8473000/pexels-photo-8473000.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(83, 'C209', 'Musiikkitalo', 2, 14, 'https://images.pexels.com/photos/8382220/pexels-photo-8382220.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(84, 'C210', 'Musiikkitalo', 2, 19, 'https://images.pexels.com/photos/30105084/pexels-photo-30105084.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(85, 'C301', 'Musiikkitalo', 3, 16, 'https://images.pexels.com/photos/5676742/pexels-photo-5676742.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(86, 'C302', 'Musiikkitalo', 3, 16, 'https://images.pexels.com/photos/5756657/pexels-photo-5756657.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(87, 'C303', 'Musiikkitalo', 3, 22, 'https://images.pexels.com/photos/5530454/pexels-photo-5530454.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(88, 'C304', 'Musiikkitalo', 3, 26, 'https://images.pexels.com/photos/6683392/pexels-photo-6683392.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(89, 'C305', 'Musiikkitalo', 3, 28, 'https://images.pexels.com/photos/6193937/pexels-photo-6193937.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(90, 'C306', 'Musiikkitalo', 3, 29, 'https://images.pexels.com/photos/7396381/pexels-photo-7396381.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(91, 'C307', 'Musiikkitalo', 3, 23, 'https://images.pexels.com/photos/10638070/pexels-photo-10638070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(92, 'C308', 'Musiikkitalo', 3, 19, 'https://images.pexels.com/photos/8926887/pexels-photo-8926887.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(93, 'C309', 'Musiikkitalo', 3, 17, 'https://images.pexels.com/photos/16007661/pexels-photo-16007661.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(94, 'C310', 'Musiikkitalo', 3, 20, 'https://images.pexels.com/photos/3793598/pexels-photo-3793598.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(95, 'D101', 'Merkonomitalo', 1, 14, 'https://images.pexels.com/photos/4936021/pexels-photo-4936021.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(96, 'D102', 'Merkonomitalo', 1, 23, 'https://images.pexels.com/photos/5428142/pexels-photo-5428142.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(97, 'D103', 'Merkonomitalo', 1, 15, 'https://images.pexels.com/photos/5427655/pexels-photo-5427655.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(98, 'D104', 'Merkonomitalo', 1, 20, 'https://images.pexels.com/photos/8653519/pexels-photo-8653519.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(99, 'D105', 'Merkonomitalo', 1, 20, 'https://images.pexels.com/photos/7929263/pexels-photo-7929263.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(100, 'D106', 'Merkonomitalo', 1, 33, 'https://images.pexels.com/photos/8423006/pexels-photo-8423006.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(101, 'D107', 'Merkonomitalo', 1, 15, 'https://images.pexels.com/photos/9300740/pexels-photo-9300740.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(102, 'D108', 'Merkonomitalo', 1, 20, 'https://images.pexels.com/photos/5905509/pexels-photo-5905509.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(103, 'D109', 'Merkonomitalo', 1, 18, 'https://images.pexels.com/photos/5940836/pexels-photo-5940836.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(104, 'D110', 'Merkonomitalo', 1, 21, 'https://images.pexels.com/photos/6684067/pexels-photo-6684067.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(105, 'D201', 'Merkonomitalo', 2, 17, 'https://images.pexels.com/photos/12197311/pexels-photo-12197311.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(106, 'D202', 'Merkonomitalo', 2, 35, 'https://images.pexels.com/photos/10127243/pexels-photo-10127243.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(107, 'D203', 'Merkonomitalo', 2, 14, 'https://images.pexels.com/photos/9743012/pexels-photo-9743012.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(108, 'D204', 'Merkonomitalo', 2, 32, 'https://images.pexels.com/photos/6209560/pexels-photo-6209560.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(109, 'D205', 'Merkonomitalo', 2, 30, 'https://images.pexels.com/photos/8423437/pexels-photo-8423437.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(110, 'D206', 'Merkonomitalo', 2, 19, 'https://images.pexels.com/photos/8423457/pexels-photo-8423457.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(111, 'D207', 'Merkonomitalo', 2, 21, 'https://images.pexels.com/photos/8456143/pexels-photo-8456143.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(112, 'D208', 'Merkonomitalo', 2, 13, 'https://images.pexels.com/photos/8472990/pexels-photo-8472990.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(113, 'D209', 'Merkonomitalo', 2, 21, 'https://images.pexels.com/photos/8466006/pexels-photo-8466006.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(114, 'D210', 'Merkonomitalo', 2, 27, 'https://images.pexels.com/photos/5905618/pexels-photo-5905618.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(115, 'D301', 'Merkonomitalo', 3, 10, 'https://images.pexels.com/photos/5905859/pexels-photo-5905859.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(116, 'D302', 'Merkonomitalo', 3, 14, 'https://images.pexels.com/photos/12168810/pexels-photo-12168810.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(117, 'D303', 'Merkonomitalo', 3, 31, 'https://images.pexels.com/photos/15759620/pexels-photo-15759620.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(118, 'D304', 'Merkonomitalo', 3, 25, 'https://images.pexels.com/photos/18734744/pexels-photo-18734744.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(119, 'D305', 'Merkonomitalo', 3, 24, 'https://images.pexels.com/photos/159806/meeting-modern-room-conference-159806.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(120, 'D306', 'Merkonomitalo', 3, 35, 'https://images.pexels.com/photos/2882657/pexels-photo-2882657.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(121, 'D307', 'Merkonomitalo', 3, 13, 'https://images.pexels.com/photos/4143799/pexels-photo-4143799.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(122, 'D308', 'Merkonomitalo', 3, 32, 'https://images.pexels.com/photos/5412132/pexels-photo-5412132.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(123, 'D309', 'Merkonomitalo', 3, 30, 'https://images.pexels.com/photos/5427823/pexels-photo-5427823.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(124, 'D310', 'Merkonomitalo', 3, 21, 'https://images.pexels.com/photos/5211475/pexels-photo-5211475.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(125, 'E101', 'Autoala', 1, 32, 'https://images.pexels.com/photos/5756562/pexels-photo-5756562.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(126, 'E102', 'Autoala', 1, 34, 'https://images.pexels.com/photos/5756572/pexels-photo-5756572.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(127, 'E103', 'Autoala', 1, 14, 'https://images.pexels.com/photos/4260476/pexels-photo-4260476.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(128, 'E104', 'Autoala', 1, 35, 'https://images.pexels.com/photos/6340664/pexels-photo-6340664.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(129, 'E105', 'Autoala', 1, 18, 'https://images.pexels.com/photos/6517335/pexels-photo-6517335.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(130, 'E106', 'Autoala', 1, 29, 'https://images.pexels.com/photos/5905530/pexels-photo-5905530.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(131, 'E107', 'Autoala', 1, 30, 'https://images.pexels.com/photos/5905451/pexels-photo-5905451.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(132, 'E108', 'Autoala', 1, 28, 'https://images.pexels.com/photos/6238008/pexels-photo-6238008.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(133, 'E109', 'Autoala', 1, 13, 'https://images.pexels.com/photos/6936476/pexels-photo-6936476.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(134, 'E110', 'Autoala', 1, 22, 'https://images.pexels.com/photos/6937753/pexels-photo-6937753.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(135, 'E201', 'Autoala', 2, 11, 'https://images.pexels.com/photos/5257893/pexels-photo-5257893.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(136, 'E202', 'Autoala', 2, 31, 'https://images.pexels.com/photos/5676743/pexels-photo-5676743.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(137, 'E203', 'Autoala', 2, 35, 'https://images.pexels.com/photos/6683451/pexels-photo-6683451.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(138, 'E204', 'Autoala', 2, 19, 'https://images.pexels.com/photos/6683887/pexels-photo-6683887.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(139, 'E205', 'Autoala', 2, 34, 'https://images.pexels.com/photos/5530450/pexels-photo-5530450.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(140, 'E206', 'Autoala', 2, 23, 'https://images.pexels.com/photos/8382263/pexels-photo-8382263.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(141, 'E207', 'Autoala', 2, 32, 'https://images.pexels.com/photos/8419515/pexels-photo-8419515.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(142, 'E208', 'Autoala', 2, 31, 'https://images.pexels.com/photos/8472850/pexels-photo-8472850.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(143, 'E209', 'Autoala', 2, 20, 'https://images.pexels.com/photos/8541881/pexels-photo-8541881.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(144, 'E210', 'Autoala', 2, 27, 'https://images.pexels.com/photos/8423019/pexels-photo-8423019.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(145, 'E301', 'Autoala', 3, 10, 'https://images.pexels.com/photos/7868832/pexels-photo-7868832.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(146, 'E302', 'Autoala', 3, 14, 'https://images.pexels.com/photos/8501770/pexels-photo-8501770.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(147, 'E303', 'Autoala', 3, 29, 'https://images.pexels.com/photos/7407385/pexels-photo-7407385.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(148, 'E304', 'Autoala', 3, 18, 'https://images.pexels.com/photos/7407116/pexels-photo-7407116.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(149, 'E305', 'Autoala', 3, 16, 'https://images.pexels.com/photos/8342372/pexels-photo-8342372.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(150, 'E306', 'Autoala', 3, 18, 'https://images.pexels.com/photos/6990252/pexels-photo-6990252.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(151, 'E307', 'Autoala', 3, 33, 'https://images.pexels.com/photos/6990426/pexels-photo-6990426.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(152, 'E308', 'Autoala', 3, 23, 'https://images.pexels.com/photos/8653984/pexels-photo-8653984.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(153, 'E309', 'Autoala', 3, 31, 'https://images.pexels.com/photos/9159281/pexels-photo-9159281.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(154, 'E310', 'Autoala', 3, 26, 'https://images.pexels.com/photos/12197305/pexels-photo-12197305.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(155, 'F101', 'Kosmetologiala', 1, 27, 'https://images.pexels.com/photos/18734743/pexels-photo-18734743.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(156, 'F102', 'Kosmetologiala', 1, 22, 'https://images.pexels.com/photos/27300375/pexels-photo-27300375.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(157, 'F103', 'Kosmetologiala', 1, 19, 'https://images.pexels.com/photos/28503354/pexels-photo-28503354.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(158, 'F104', 'Kosmetologiala', 1, 19, 'https://images.pexels.com/photos/32181832/pexels-photo-32181832.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(159, 'F105', 'Kosmetologiala', 1, 29, 'https://images.pexels.com/photos/33587210/pexels-photo-33587210.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(160, 'F106', 'Kosmetologiala', 1, 26, 'https://images.pexels.com/photos/33846282/pexels-photo-33846282.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(161, 'F107', 'Kosmetologiala', 1, 33, 'https://images.pexels.com/photos/8423429/pexels-photo-8423429.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(162, 'F108', 'Kosmetologiala', 1, 27, 'https://images.pexels.com/photos/8473000/pexels-photo-8473000.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(163, 'F109', 'Kosmetologiala', 1, 26, 'https://images.pexels.com/photos/8382220/pexels-photo-8382220.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(164, 'F110', 'Kosmetologiala', 1, 14, 'https://images.pexels.com/photos/30105084/pexels-photo-30105084.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(165, 'F201', 'Kosmetologiala', 2, 35, 'https://images.pexels.com/photos/5676742/pexels-photo-5676742.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(166, 'F202', 'Kosmetologiala', 2, 17, 'https://images.pexels.com/photos/5756657/pexels-photo-5756657.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(167, 'F203', 'Kosmetologiala', 2, 24, 'https://images.pexels.com/photos/5530454/pexels-photo-5530454.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(168, 'F204', 'Kosmetologiala', 2, 35, 'https://images.pexels.com/photos/6683392/pexels-photo-6683392.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(169, 'F205', 'Kosmetologiala', 2, 15, 'https://images.pexels.com/photos/6193937/pexels-photo-6193937.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(170, 'F206', 'Kosmetologiala', 2, 11, 'https://images.pexels.com/photos/7396381/pexels-photo-7396381.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(171, 'F207', 'Kosmetologiala', 2, 29, 'https://images.pexels.com/photos/10638070/pexels-photo-10638070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(172, 'F208', 'Kosmetologiala', 2, 22, 'https://images.pexels.com/photos/8926887/pexels-photo-8926887.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(173, 'F209', 'Kosmetologiala', 2, 16, 'https://images.pexels.com/photos/16007661/pexels-photo-16007661.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(174, 'F210', 'Kosmetologiala', 2, 29, 'https://images.pexels.com/photos/3793598/pexels-photo-3793598.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(175, 'F301', 'Kosmetologiala', 3, 10, 'https://images.pexels.com/photos/4936021/pexels-photo-4936021.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(176, 'F302', 'Kosmetologiala', 3, 33, 'https://images.pexels.com/photos/5428142/pexels-photo-5428142.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(177, 'F303', 'Kosmetologiala', 3, 21, 'https://images.pexels.com/photos/5427655/pexels-photo-5427655.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(178, 'F304', 'Kosmetologiala', 3, 22, 'https://images.pexels.com/photos/8653519/pexels-photo-8653519.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(179, 'F305', 'Kosmetologiala', 3, 10, 'https://images.pexels.com/photos/7929263/pexels-photo-7929263.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(180, 'F306', 'Kosmetologiala', 3, 28, 'https://images.pexels.com/photos/8423006/pexels-photo-8423006.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(181, 'F307', 'Kosmetologiala', 3, 23, 'https://images.pexels.com/photos/9300740/pexels-photo-9300740.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(182, 'F308', 'Kosmetologiala', 3, 23, 'https://images.pexels.com/photos/5905509/pexels-photo-5905509.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(183, 'F309', 'Kosmetologiala', 3, 35, 'https://images.pexels.com/photos/5940836/pexels-photo-5940836.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
(184, 'F310', 'Kosmetologiala', 3, 19, 'https://images.pexels.com/photos/6684067/pexels-photo-6684067.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');

-- --------------------------------------------------------

--
-- Rakenne taululle `kayttajat`
--

CREATE TABLE `kayttajat` (
  `KayttajaID` int(11) NOT NULL,
  `Nimi` varchar(50) NOT NULL,
  `Gmail` varchar(100) NOT NULL,
  `SalasanaHash` varchar(255) NOT NULL,
  `PuhelinNro` varchar(20) DEFAULT NULL,
  `Rooli` varchar(50) NOT NULL DEFAULT 'user',
  `Profiilikuva` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `kayttajat`
--

INSERT INTO `kayttajat` (`KayttajaID`, `Nimi`, `Gmail`, `SalasanaHash`, `PuhelinNro`, `Rooli`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$ehDKc6h6WDD.140sSTS8yuMeA5YQ.ki4Za2ok7.u76d2Kapa4tdbe', '0501855677', 'admin'),
(2, 'topi2', 'topi2@gmail.com', '$2y$10$tL6xJZphXPrTuZQgR4P5e.L.WX3hWW.2Q5hefbvAl8MhtKJpg63JW', '0402733844', 'user');

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
(3, 2, 2, '2025-11-11 00:00:00', '2025-11-12 00:00:00', 'varattu'),
(5, 2, 165, '2025-11-11 00:00:00', '2025-11-13 00:00:00', 'varattu'),
(6, 2, 5, '2025-11-26 00:00:00', '2025-11-29 00:00:00', 'varattu'),
(7, 2, 125, '2025-11-25 00:00:00', '2025-11-26 00:00:00', 'varattu');

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
  MODIFY `KayttajaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `varaukset`
--
ALTER TABLE `varaukset`
  MODIFY `VarausID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
