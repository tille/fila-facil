-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2013 a las 23:17:20
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ff_database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `history_turn`
--

CREATE TABLE IF NOT EXISTS `history_turn` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `user_id` int(30) NOT NULL,
  `turn_number` int(30) NOT NULL,
  `module` varchar(100) NOT NULL,
  `start_time` time NOT NULL,
  `final_timer` time NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (user_id) REFERENCES users(identification)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
