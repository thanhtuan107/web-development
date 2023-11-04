-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: mysql-server
-- Thời gian đã tạo: Th5 07, 2023 lúc 11:48 AM
-- Phiên bản máy phục vụ: 8.0.27
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hotel_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
('xSvNqOSDzRYsc3Ds2yKZ', 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking`
--

CREATE TABLE `booking` (
  `user_id` varchar(255) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(10) NOT NULL,
  `rooms` int NOT NULL,
  `check_in` varchar(10) NOT NULL,
  `check_out` varchar(10) NOT NULL,
  `childs` int NOT NULL,
  `room_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`id`, `email`, `name`, `number`) VALUES
('EEtfNduI7wccVl4XpUAZ', 'nhi@gmail.com', 'nhi', '0399984122'),
('XYJcye5t6L1SXZdoEaUj', 'tuan@gmail.com', 'tuan', '0986754334'),
('umscLk594Wxi2U2Wup3g', 'truongbao203@gmail.com', 'bao', '0909290909'),
('2El7kqxC3kjpmXQUna51', '', '', ''),
('XubN5fZxoTSgt3rU17zj', 'text@gmail.com', 'textIndex', '0987655432'),
('NULjveG0uqBC3NzEta8V', 'test@gmail.com', 'test', '0944000123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `user_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `email`, `pass`, `user_type`) VALUES
('zocDi9GkE96LJ2sxtAzg', 'ttt@gmail.com', 'rrrr', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
('Bf9ehQcCAC9R8KRJowGK', 'thanktun@gmail.com', 'tuan', 'e10adc3949ba59abbe56e057f20f883e', 'user'),
('zeEHT5ssoKXRkJrXRJDJ', 'tunn', 'thankstun@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
('LlIImxQGZ3XErKHAX3p7', 'user', 'user@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'user'),
('PC6Ib1VfedGpwXyZtnRW', 'nhinh', 'nhiii@gmail.com', 'f1887d3f9e6ee7a32fe5e76f4ab80d63', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
