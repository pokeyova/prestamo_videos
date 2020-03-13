-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2020 a las 20:49:08
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sisvideo_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alternative_title`
--

CREATE TABLE `alternative_title` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(90) NOT NULL,
  `cod_video` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alternative_title`
--

INSERT INTO `alternative_title` (`id`, `title`, `cod_video`) VALUES
(6, 'The Joker', 'V001'),
(7, 'El Guason', 'V001'),
(8, 'Age of ice', 'V002'),
(9, 'titulo prueba', 'V004');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit`
--

CREATE TABLE `audit` (
  `id` int(10) UNSIGNED NOT NULL,
  `cod_user` varchar(30) NOT NULL,
  `cod_video` varchar(30) NOT NULL,
  `action` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `audit`
--

INSERT INTO `audit` (`id`, `cod_user`, `cod_video`, `action`, `quantity`, `date`, `time`) VALUES
(1, 'A1', 'V001', 'REGISTRO', 15, '2020-02-21', '00:00:00'),
(3, 'A1', 'V002', 'REGISTRO', 20, '2020-02-21', '00:00:00'),
(4, 'A1', 'V001', 'MODIFICACIÓN', 15, '2020-02-28', '21:18:59'),
(7, 'A1', 'V003', 'REGISTRO', 10, '2020-02-28', '21:21:45'),
(8, 'A1', 'V003', 'ELIMINACIÓN', 1, '2020-02-28', '21:22:11'),
(9, 'A1', 'V001', 'COPIAS', 1, '2020-03-01', '11:16:34'),
(10, 'A1', 'V001', 'BAJAS', 1, '2020-03-01', '11:21:53'),
(11, 'A1', 'V004', 'REGISTRO', 1, '2020-03-01', '14:59:29'),
(12, 'A1', 'V004', 'COPIAS', 16, '2020-03-01', '14:59:42'),
(13, 'A1', 'V004', 'MODIFICACIÓN', 2, '2020-03-01', '15:00:06'),
(14, 'A1', 'V004', 'COPIAS', 1, '2020-03-01', '15:00:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `borrowing`
--

CREATE TABLE `borrowing` (
  `cod_borrowing` varchar(30) NOT NULL,
  `cod_client` varchar(30) NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date NOT NULL,
  `status` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `borrowing`
--

INSERT INTO `borrowing` (`cod_borrowing`, `cod_client`, `borrow_date`, `return_date`, `status`) VALUES
('P001', 'C001', '2020-02-28', '2020-02-29', 'DEVUELTO'),
('P002', 'C002', '2020-02-28', '2020-03-03', 'DEVUELTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `borrowing_videos`
--

CREATE TABLE `borrowing_videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `cod_borrowing` varchar(30) NOT NULL,
  `cod_video` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `borrowing_videos`
--

INSERT INTO `borrowing_videos` (`id`, `cod_borrowing`, `cod_video`, `quantity`) VALUES
(4, 'P001', 'V001', 1),
(5, 'P002', 'V002', 2),
(6, 'P002', 'V001', 1),
(7, 'P002', 'V001', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `cod_client` varchar(30) NOT NULL,
  `name` varchar(90) NOT NULL,
  `last_name` varchar(90) NOT NULL,
  `ci` int(11) NOT NULL,
  `issued` varchar(30) NOT NULL,
  `email` varchar(90) NOT NULL,
  `date_birth` date NOT NULL,
  `address` varchar(90) NOT NULL,
  `location` longtext NOT NULL,
  `registration_date` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`cod_client`, `name`, `last_name`, `ci`, `issued`, `email`, `date_birth`, `address`, `location`, `registration_date`, `status`) VALUES
('C001', 'EDUARDO', 'PAREDES', 12345678, 'LP', 'em@gmail.com', '1996-03-01', 'zona los olivos calle 3 #22', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3825.600154345778!2d-68.13515439952789!3d-16.495771937557407!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTbCsDI5JzQ0LjgiUyA2OMKwMDgnMDEuOSJX!5e0!3m2!1ses-419!2sbo!4v1582557654747!5m2!1ses-419!2sbo\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>', '2020-02-24', 1),
('C002', 'JUAN', 'MAMANI', 12345678, 'CB', 'jm@hotmial.com', '1997-02-02', 'zona los pedregales calle 4 #44', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3825.600154345778!2d-68.13515439952789!3d-16.495771937557407!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTbCsDI5JzQ0LjgiUyA2OMKwMDgnMDEuOSJX!5e0!3m2!1ses-419!2sbo!4v1582557654747!5m2!1ses-419!2sbo\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>', '2020-02-24', 1),
('C003', 'Jorge', 'Camacho', 12345678, 'CB', 'jorge@hotmail.com', '2000-02-01', 'zona los olivos calle 3 #244', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3825.600154345778!2d-68.13515439952789!3d-16.495771937557407!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTbCsDI5JzQ0LjgiUyA2OMKwMDgnMDEuOSJX!5e0!3m2!1ses-419!2sbo!4v1582557654747!5m2!1ses-419!2sbo\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>', '2020-03-01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client_locked`
--

CREATE TABLE `client_locked` (
  `id` int(10) UNSIGNED NOT NULL,
  `cod_client` varchar(30) NOT NULL,
  `reason` varchar(90) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `client_locked`
--

INSERT INTO `client_locked` (`id`, `cod_client`, `reason`, `register_date`, `status`) VALUES
(1, 'C001', 'Perdida de videos', '2020-03-01 19:01:58', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `copy_entry`
--

CREATE TABLE `copy_entry` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `cod_video` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `copy_entry`
--

INSERT INTO `copy_entry` (`id`, `quantity`, `date`, `cod_video`) VALUES
(1, 1, '2020-03-01', 'V001'),
(2, 16, '2020-03-01', 'V004'),
(3, 1, '2020-03-01', 'V004');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cost`
--

CREATE TABLE `cost` (
  `cod_cost` varchar(30) NOT NULL,
  `unit_cost` decimal(24,2) NOT NULL,
  `cost_one_day` decimal(24,2) NOT NULL,
  `cost_two_day` decimal(24,2) NOT NULL,
  `cost_three_day` decimal(24,2) NOT NULL,
  `cost_four_day` decimal(24,2) NOT NULL,
  `cost_five_day` decimal(24,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cost`
--

INSERT INTO `cost` (`cod_cost`, `unit_cost`, `cost_one_day`, `cost_two_day`, `cost_three_day`, `cost_four_day`, `cost_five_day`) VALUES
('COS1', '2.00', '2.00', '3.00', '4.00', '5.00', '6.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discount`
--

CREATE TABLE `discount` (
  `cod_discount` varchar(30) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) DEFAULT NULL,
  `discount` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `discount`
--

INSERT INTO `discount` (`cod_discount`, `from`, `to`, `discount`) VALUES
('DES1', 3, 5, 5.00),
('DES2', 5, NULL, 10.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discount_borrowing`
--

CREATE TABLE `discount_borrowing` (
  `id` int(10) UNSIGNED NOT NULL,
  `cod_discount` varchar(30) NOT NULL,
  `cod_borrowing` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `discount_borrowing`
--

INSERT INTO `discount_borrowing` (`id`, `cod_discount`, `cod_borrowing`) VALUES
(1, 'DES1', 'P002');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genre`
--

CREATE TABLE `genre` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(90) NOT NULL,
  `description` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `genre`
--

INSERT INTO `genre` (`id`, `name`, `description`) VALUES
(1, 'COMEDIA', ''),
(2, 'ACCIÓN', ''),
(3, 'DRAMA', ''),
(4, 'TERROR', ''),
(5, 'FICCIÓN', ''),
(6, 'INFANTIL', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice`
--

CREATE TABLE `invoice` (
  `cod_invoice` varchar(30) NOT NULL,
  `cod_client` varchar(30) NOT NULL,
  `cod_borrowing` varchar(30) NOT NULL,
  `total` decimal(24,2) NOT NULL,
  `end_total` decimal(24,2) NOT NULL,
  `control_code` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `invoice`
--

INSERT INTO `invoice` (`cod_invoice`, `cod_client`, `cod_borrowing`, `total`, `end_total`, `control_code`, `date`) VALUES
('1001', 'C001', 'P001', '2.00', '2.00', 'A5-1E-A1-52-7D', '2020-02-28'),
('1002', 'C002', 'P002', '20.00', '19.00', 'AE-D2-45-BE-33', '2020-02-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice_detail`
--

CREATE TABLE `invoice_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `cod_invoice` varchar(30) NOT NULL,
  `cod_video` varchar(30) NOT NULL,
  `unit_cost` decimal(24,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(24,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `invoice_detail`
--

INSERT INTO `invoice_detail` (`id`, `cod_invoice`, `cod_video`, `unit_cost`, `quantity`, `total`) VALUES
(1, '1001', 'V001', '2.00', 1, '2.00'),
(2, '1002', 'V002', '5.00', 2, '10.00'),
(3, '1002', 'V001', '5.00', 1, '5.00'),
(4, '1002', 'V001', '5.00', 1, '5.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `main_actor`
--

CREATE TABLE `main_actor` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(90) NOT NULL,
  `cod_video` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `main_actor`
--

INSERT INTO `main_actor` (`id`, `name`, `cod_video`) VALUES
(1, 'Joaquin Phoenix', 'V001'),
(2, 'John Fish', 'V004');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomination`
--

CREATE TABLE `nomination` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(90) NOT NULL,
  `won` varchar(30) NOT NULL,
  `cod_video` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `nomination`
--

INSERT INTO `nomination` (`id`, `tipo`, `won`, `cod_video`) VALUES
(2, 'Mejor actor', 'SI', 'V001'),
(3, 'mejor pelicula', 'SI', 'V004');

-- ---------- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2020 a las 20:49:08
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sisvideo_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alternative_title`
--

CREATE TABLE `alternative_title` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(90) NOT NULL,
  `cod_video` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alternative_title`
--

INSERT INTO `alternative_title` (`id`, `title`, `cod_video`) VALUES
(6, 'The Joker', 'V001'),
(7, 'El Guason', 'V001'),
(8, 'Age of ice', 'V002'),
(9, 'titulo prueba', 'V004');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit`
--

CREATE TABLE `audit` (
  `id` int(10) UNSIGNED NOT NULL,
  `cod_user` varchar(30) NOT NULL,
  `cod_video` varchar(30) NOT NULL,
  `action` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `audit`
--

INSERT INTO `audit` (`id`, `cod_user`, `cod_video`, `action`, `quantity`, `date`, `time`) VALUES
(1, 'A1', 'V001', 'REGISTRO', 15, '2020-02-21', '00:00:00'),
(3, 'A1', 'V002', 'REGISTRO', 20, '2020-02-21', '00:00:00'),
(4, 'A1', 'V001', 'MODIFICACIÓN', 15, '2020-02-28', '21:18:59'),
(7, 'A1', 'V003', 'REGISTRO', 10, '2020-02-28', '21:21:45'),
(8, 'A1', 'V003', 'ELIMINACIÓN', 1, '2020-02-28', '21:22:11'),
(9, 'A1', 'V001', 'COPIAS', 1, '2020-03-01', '11:16:34'),
(10, 'A1', 'V001', 'BAJAS', 1, '2020-03-01', '11:21:53'),
(11, 'A1', 'V004', 'REGISTRO', 1, '2020-03-01', '14:59:29'),
(12, 'A1', 'V004', 'COPIAS', 16, '2020-03-01', '14:59:42'),
(13, 'A1', 'V004', 'MODIFICACIÓN', 2, '2020-03-01', '15:00:06'),
(14, 'A1', 'V004', 'COPIAS', 1, '2020-03-01', '15:00:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `borrowing`
--

CREATE TABLE `borrowing` (
  `cod_borrowing` varchar(30) NOT NULL,
  `cod_client` varchar(30) NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date NOT NULL,
  `status` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `borrowing`
--

INSERT INTO `borrowing` (`cod_borrowing`, `cod_client`, `borrow_date`, `return_date`, `status`) VALUES
('P001', 'C001', '2020-02-28', '2020-02-29', 'DEVUELTO'),
('P002', 'C002', '2020-02-28', '2020-03-03', 'DEVUELTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `borrowing_videos`
--

CREATE TABLE `borrowing_videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `cod_borrowing` varchar(30) NOT NULL,
  `cod_video` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `borrowing_videos`
--

INSERT INTO `borrowing_videos` (`id`, `cod_borrowing`, `cod_video`, `quantity`) VALUES
(4, 'P001', 'V001', 1),
(5, 'P002', 'V002', 2),
(6, 'P002', 'V001', 1),
(7, 'P002', 'V001', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `cod_client` varchar(30) NOT NULL,
  `name` varchar(90) NOT NULL,
  `last_name` varchar(90) NOT NULL,
  `ci` int(11) NOT NULL,
  `issued` varchar(30) NOT NULL,
  `email` varchar(90) NOT NULL,
  `date_birth` date NOT NULL,
  `address` varchar(90) NOT NULL,
  `location` longtext NOT NULL,
  `registration_date` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`cod_client`, `name`, `last_name`, `ci`, `issued`, `email`, `date_birth`, `address`, `location`, `registration_date`, `status`) VALUES
('C001', 'EDUARDO', 'PAREDES', 12345678, 'LP', 'em@gmail.com', '1996-03-01', 'zona los olivos calle 3 #22', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3825.600154345778!2d-68.13515439952789!3d-16.495771937557407!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTbCsDI5JzQ0LjgiUyA2OMKwMDgnMDEuOSJX!5e0!3m2!1ses-419!2sbo!4v1582557654747!5m2!1ses-419!2sbo\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>', '2020-02-24', 1),
('C002', 'JUAN', 'MAMANI', 12345678, 'CB', 'jm@hotmial.com', '1997-02-02', 'zona los pedregales calle 4 #44', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3825.600154345778!2d-68.13515439952789!3d-16.495771937557407!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTbCsDI5JzQ0LjgiUyA2OMKwMDgnMDEuOSJX!5e0!3m2!1ses-419!2sbo!4v1582557654747!5m2!1ses-419!2sbo\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>', '2020-02-24', 1),
('C003', 'Jorge', 'Camacho', 12345678, 'CB', 'jorge@hotmail.com', '2000-02-01', 'zona los olivos calle 3 #244', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3825.600154345778!2d-68.13515439952789!3d-16.495771937557407!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTbCsDI5JzQ0LjgiUyA2OMKwMDgnMDEuOSJX!5e0!3m2!1ses-419!2sbo!4v1582557654747!5m2!1ses-419!2sbo\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>', '2020-03-01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client_locked`
--

CREATE TABLE `client_locked` (
  `id` int(10) UNSIGNED NOT NULL,
  `cod_client` varchar(30) NOT NULL,
  `reason` varchar(90) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `client_locked`
--

INSERT INTO `client_locked` (`id`, `cod_client`, `reason`, `register_date`, `status`) VALUES
(1, 'C001', 'Perdida de videos', '2020-03-01 19:01:58', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `copy_entry`
--

CREATE TABLE `copy_entry` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `cod_video` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `copy_entry`
--

INSERT INTO `copy_entry` (`id`, `quantity`, `date`, `cod_video`) VALUES
(1, 1, '2020-03-01', 'V001'),
(2, 16, '2020-03-01', 'V004'),
(3, 1, '2020-03-01', 'V004');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cost`
--

CREATE TABLE `cost` (
  `cod_cost` varchar(30) NOT NULL,
  `unit_cost` decimal(24,2) NOT NULL,
  `cost_one_day` decimal(24,2) NOT NULL,
  `cost_two_day` decimal(24,2) NOT NULL,
  `cost_three_day` decimal(24,2) NOT NULL,
  `cost_four_day` decimal(24,2) NOT NULL,
  `cost_five_day` decimal(24,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cost`
--

INSERT INTO `cost` (`cod_cost`, `unit_cost`, `cost_one_day`, `cost_two_day`, `cost_three_day`, `cost_four_day`, `cost_five_day`) VALUES
('COS1', '2.00', '2.00', '3.00', '4.00', '5.00', '6.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discount`
--

CREATE TABLE `discount` (
  `cod_discount` varchar(30) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) DEFAULT NULL,
  `discount` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `discount`
--

INSERT INTO `discount` (`cod_discount`, `from`, `to`, `discount`) VALUES
('DES1', 3, 5, 5.00),
('DES2', 5, NULL, 10.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discount_borrowing`
--

CREATE TABLE `discount_borrowing` (
  `id` int(10) UNSIGNED NOT NULL,
  `cod_discount` varchar(30) NOT NULL,
  `cod_borrowing` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `discount_borrowing`
--

INSERT INTO `discount_borrowing` (`id`, `cod_discount`, `cod_borrowing`) VALUES
(1, 'DES1', 'P002');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genre`
--

CREATE TABLE `genre` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(90) NOT NULL,
  `description` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `genre`
--

INSERT INTO `genre` (`id`, `name`, `description`) VALUES
(1, 'COMEDIA', ''),
(2, 'ACCIÓN', ''),
(3, 'DRAMA', ''),
(4, 'TERROR', ''),
(5, 'FICCIÓN', ''),
(6, 'INFANTIL', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice`
--

CREATE TABLE `invoice` (
  `cod_invoice` varchar(30) NOT NULL,
  `cod_client` varchar(30) NOT NULL,
  `cod_borrowing` varchar(30) NOT NULL,
  `total` decimal(24,2) NOT NULL,
  `end_total` decimal(24,2) NOT NULL,
  `control_code` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `invoice`
--

INSERT INTO `invoice` (`cod_invoice`, `cod_client`, `cod_borrowing`, `total`, `end_total`, `control_code`, `date`) VALUES
('1001', 'C001', 'P001', '2.00', '2.00', 'A5-1E-A1-52-7D', '2020-02-28'),
('1002', 'C002', 'P002', '20.00', '19.00', 'AE-D2-45-BE-33', '2020-02-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice_detail`
--

CREATE TABLE `invoice_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `cod_invoice` varchar(30) NOT NULL,
  `cod_video` varchar(30) NOT NULL,
  `unit_cost` decimal(24,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(24,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `invoice_detail`
--

INSERT INTO `invoice_detail` (`id`, `cod_invoice`, `cod_video`, `unit_cost`, `quantity`, `total`) VALUES
(1, '1001', 'V001', '2.00', 1, '2.00'),
(2, '1002', 'V002', '5.00', 2, '10.00'),
(3, '1002', 'V001', '5.00', 1, '5.00'),
(4, '1002', 'V001', '5.00', 1, '5.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `main_actor`
--

CREATE TABLE `main_actor` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(90) NOT NULL,
  `cod_video` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `main_actor`
--

INSERT INTO `main_actor` (`id`, `name`, `cod_video`) VALUES
(1, 'Joaquin Phoenix', 'V001'),
(2, 'John Fish', 'V004');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomination`
--

CREATE TABLE `nomination` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(90) NOT NULL,
  `won` varchar(30) NOT NULL,
  `cod_video` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `nomination`
--

INSERT INTO `nomination` (`id`, `tipo`, `won`, `cod_video`) VALUES
(2, 'Me------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `cod_personal` varchar(30) NOT NULL,
  `name` varchar(90) NOT NULL,
  `last_name` varchar(90) NOT NULL,
  `ci` int(11) NOT NULL,
  `issued` varchar(30) NOT NULL,
  `email` varchar(90) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `cod_user` varchar(30) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`cod_personal`, `name`, `last_name`, `ci`, `issued`, `email`, `phone`, `cod_user`, `status`) VALUES
('P001', 'Carlos', 'Paredes', 12345678, 'LP', 'cparedes@gmail.com', '78945612', 'CP1', 1),
('P002', 'Alberto', 'Salaz', 12345678, 'CB', 'asal@hotmail.com', '68412234', 'AS2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unsubscribe`
--

CREATE TABLE `unsubscribe` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `reason` varchar(90) NOT NULL,
  `date` date NOT NULL,
  `cod_video` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `unsubscribe`
--

INSERT INTO `unsubscribe` (`id`, `quantity`, `reason`, `date`, `cod_video`) VALUES
(1, 1, 'Perdida', '2020-03-01', 'V001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `cod_user` varchar(30) NOT NULL,
  `name` varchar(90) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(90) NOT NULL,
  `register_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`cod_user`, `name`, `password`, `type`, `register_date`) VALUES
('A1', 'admin', '$2y$10$8HhiUbfq8CSrefszU/.DNed5iKDRK/tfRNllrtGXFogRKglT8cRgy', 'ADMINISTRADOR', '2020-02-22'),
('AS2', 'ASALAZ', '$2y$10$NiT71pqcZRIUT7/TZpmfjOlgprtTtV8SaPh4Nq5T6ciSnOWJojwia', 'ADMINISTRADOR', '2020-02-23'),
('CP1', 'CPAREDES', '$2y$10$edzLnMzn8g21hA0wbDCw8.d29e06GIRlGh/9SV81l3ynFYyJC5NzC', 'AUXILIAR', '2020-02-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `video`
--

CREATE TABLE `video` (
  `cod_video` varchar(30) NOT NULL,
  `title` varchar(90) NOT NULL,
  `duration` int(11) NOT NULL,
  `year_publication` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `genre_id` int(10) UNSIGNED NOT NULL,
  `cod_cost` varchar(30) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `video`
--

INSERT INTO `video` (`cod_video`, `title`, `duration`, `year_publication`, `quantity`, `stock`, `genre_id`, `cod_cost`, `status`) VALUES
('V001', 'JOKER', 122, 2019, 15, 12, 3, 'COS1', 1),
('V002', 'La era del hielo', 140, 2012, 20, 18, 6, 'COS1', 1),
('V003', 'Video prueba', 140, 2012, 10, 10, 1, 'COS1', 1),
('V004', 'Pelicula drama', 180, 2010, 2, 18, 3, 'COS1', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alternative_title`
--
ALTER TABLE `alternative_title`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alternative_title_video` (`cod_video`);

--
-- Indices de la tabla `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_user` (`cod_user`),
  ADD KEY `audit_video` (`cod_video`);

--
-- Indices de la tabla `borrowing`
--
ALTER TABLE `borrowing`
  ADD PRIMARY KEY (`cod_borrowing`),
  ADD KEY `lending_client` (`cod_client`);

--
-- Indices de la tabla `borrowing_videos`
--
ALTER TABLE `borrowing_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrowing_videos_borrowing` (`cod_borrowing`),
  ADD KEY `borrowing_videos_video` (`cod_video`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`cod_client`);

--
-- Indices de la tabla `client_locked`
--
ALTER TABLE `client_locked`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_locked_client` (`cod_client`);

--
-- Indices de la tabla `copy_entry`
--
ALTER TABLE `copy_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entry_video` (`cod_video`);

--
-- Indices de la tabla `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`cod_cost`);

--
-- Indices de la tabla `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`cod_discount`);

--
-- Indices de la tabla `discount_borrowing`
--
ALTER TABLE `discount_borrowing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrowing_discount` (`cod_discount`),
  ADD KEY `borrowing_discount_fk` (`cod_borrowing`);

--
-- Indices de la tabla `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`cod_invoice`),
  ADD KEY `invoice_borrowing` (`cod_borrowing`),
  ADD KEY `invoice_client` (`cod_client`);

--
-- Indices de la tabla `invoice_detail`
--
ALTER TABLE `invoice_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `main_actor`
--
ALTER TABLE `main_actor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `main_actor_video` (`cod_video`);

--
-- Indices de la tabla `nomination`
--
ALTER TABLE `nomination`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nomination_video` (`cod_video`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`cod_personal`),
  ADD KEY `personal_user` (`cod_user`);

--
-- Indices de la tabla `unsubscribe`
--
ALTER TABLE `unsubscribe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unsubscribe_video` (`cod_video`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`cod_user`);

--
-- Indices de la tabla `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`cod_video`),
  ADD KEY `video_cost` (`cod_cost`),
  ADD KEY `video_genre` (`genre_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alternative_title`
--
ALTER TABLE `alternative_title`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `audit`
--
ALTER TABLE `audit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `borrowing_videos`
--
ALTER TABLE `borrowing_videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `client_locked`
--
ALTER TABLE `client_locked`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `copy_entry`
--
ALTER TABLE `copy_entry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `discount_borrowing`
--
ALTER TABLE `discount_borrowing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `invoice_detail`
--
ALTER TABLE `invoice_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `main_actor`
--
ALTER TABLE `main_actor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `nomination`
--
ALTER TABLE `nomination`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `unsubscribe`
--
ALTER TABLE `unsubscribe`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alternative_title`
--
ALTER TABLE `alternative_title`
  ADD CONSTRAINT `alternative_title_video` FOREIGN KEY (`cod_video`) REFERENCES `video` (`cod_video`);

--
-- Filtros para la tabla `audit`
--
ALTER TABLE `audit`
  ADD CONSTRAINT `audit_user` FOREIGN KEY (`cod_user`) REFERENCES `user` (`cod_user`),
  ADD CONSTRAINT `audit_video` FOREIGN KEY (`cod_video`) REFERENCES `video` (`cod_video`);

--
-- Filtros para la tabla `borrowing`
--
ALTER TABLE `borrowing`
  ADD CONSTRAINT `lending_client` FOREIGN KEY (`cod_client`) REFERENCES `client` (`cod_client`);

--
-- Filtros para la tabla `borrowing_videos`
--
ALTER TABLE `borrowing_videos`
  ADD CONSTRAINT `borrowing_videos_borrowing` FOREIGN KEY (`cod_borrowing`) REFERENCES `borrowing` (`cod_borrowing`),
  ADD CONSTRAINT `borrowing_videos_video` FOREIGN KEY (`cod_video`) REFERENCES `video` (`cod_video`);

--
-- Filtros para la tabla `client_locked`
--
ALTER TABLE `client_locked`
  ADD CONSTRAINT `client_locked_client` FOREIGN KEY (`cod_client`) REFERENCES `client` (`cod_client`);

--
-- Filtros para la tabla `copy_entry`
--
ALTER TABLE `copy_entry`
  ADD CONSTRAINT `entry_video` FOREIGN KEY (`cod_video`) REFERENCES `video` (`cod_video`);

--
-- Filtros para la tabla `discount_borrowing`
--
ALTER TABLE `discount_borrowing`
  ADD CONSTRAINT `borrowing_discount` FOREIGN KEY (`cod_discount`) REFERENCES `discount` (`cod_discount`),
  ADD CONSTRAINT `borrowing_discount_fk` FOREIGN KEY (`cod_borrowing`) REFERENCES `borrowing` (`cod_borrowing`);

--
-- Filtros para la tabla `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_borrowing` FOREIGN KEY (`cod_borrowing`) REFERENCES `borrowing` (`cod_borrowing`),
  ADD CONSTRAINT `invoice_client` FOREIGN KEY (`cod_client`) REFERENCES `client` (`cod_client`);

--
-- Filtros para la tabla `main_actor`
--
ALTER TABLE `main_actor`
  ADD CONSTRAINT `main_actor_video` FOREIGN KEY (`cod_video`) REFERENCES `video` (`cod_video`);

--
-- Filtros para la tabla `nomination`
--
ALTER TABLE `nomination`
  ADD CONSTRAINT `nomination_video` FOREIGN KEY (`cod_video`) REFERENCES `video` (`cod_video`);

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_user` FOREIGN KEY (`cod_user`) REFERENCES `user` (`cod_user`);

--
-- Filtros para la tabla `unsubscribe`
--
ALTER TABLE `unsubscribe`
  ADD CONSTRAINT `unsubscribe_video` FOREIGN KEY (`cod_video`) REFERENCES `video` (`cod_video`);

--
-- Filtros para la tabla `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_cost` FOREIGN KEY (`cod_cost`) REFERENCES `cost` (`cod_cost`),
  ADD CONSTRAINT `video_genre` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
