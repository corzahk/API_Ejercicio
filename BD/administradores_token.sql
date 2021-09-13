-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-09-2021 a las 18:50:25
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba_data`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores_token`
--

CREATE TABLE `administradores_token` (
  `TokenId` int(11) NOT NULL,
  `AdministradorId` varchar(45) DEFAULT NULL,
  `Token` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) CHARACTER SET armscii8 DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administradores_token`
--

INSERT INTO `administradores_token` (`TokenId`, `AdministradorId`, `Token`, `Estado`, `Fecha`) VALUES
(1, '', '4e89115c99cd169a9d39931933acb5c2', 'Activo', '0000-00-00 00:00:00'),
(2, '', '9a39fd951718bfd91edfa24cfdff9363', 'Activo', '0000-00-00 00:00:00'),
(3, '', '9917d231626f4dd1e5f656945b0cacda', 'Activo', '2021-09-13 16:16:00'),
(4, '1', 'a2d86df7396c2117d521cc68c9619dae', 'Activo', '2021-09-13 16:16:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores_token`
--
ALTER TABLE `administradores_token`
  ADD PRIMARY KEY (`TokenId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores_token`
--
ALTER TABLE `administradores_token`
  MODIFY `TokenId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
