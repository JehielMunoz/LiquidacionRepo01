-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2016 a las 00:26:39
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `id` int(11) NOT NULL,
  `sueldo_base` int(11) NOT NULL,
  `sueldo_bruto` int(11) NOT NULL,
  `sueldo_liquido` int(11) NOT NULL,
  `total_hora` int(11) NOT NULL,
  `valor_hora` int(11) NOT NULL,
  `tipo_contrato` varchar(80) NOT NULL,
  `nro_cargas` int(11) NOT NULL,
  `afp` varchar(80) NOT NULL,
  `salud` varchar(80) NOT NULL,
  `bonos` int(11) NOT NULL,
  `descuentos` int(11) NOT NULL,
  `asignaciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`id`, `sueldo_base`, `sueldo_bruto`, `sueldo_liquido`, `total_hora`, `valor_hora`, `tipo_contrato`, `nro_cargas`, `afp`, `salud`, `bonos`, `descuentos`, `asignaciones`) VALUES
(1, 120000, 199900, 160000, 123, 19, 'Contrato 1', 3, 'Cuprum', 'Fonasa', 4000, 12300, 10000),
(2, 31231, 21321, 21412, 1312, 23, 'Tipo 3', 31, 'Provida', 'Isapre', 9199, 3219, 12390);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`) VALUES
(1, 'Javier Araneda'),
(2, 'Joaquin Farina');

-- --------------------------------------------------------

