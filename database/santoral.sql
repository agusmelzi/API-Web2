-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 16-11-2022 a las 00:37:22
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `santoral`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `congregacion`
--

CREATE TABLE `congregacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fundador` varchar(100) NOT NULL,
  `lema` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `congregacion`
--

INSERT INTO `congregacion` (`id`, `nombre`, `fundador`, `lema`) VALUES
(3, 'Franciscanos', 'San Francisco de Asís', 'Pax et bonum'),
(5, 'Dominicos', 'Santo Domingo de Guzmán', 'Laudare, benedicere, praedicare'),
(8, 'Jesuitas', 'San Ignacio de Loyola', 'Ad maiorem Dei gloriam'),
(9, 'Benedictinos', 'San Benito de Nursia', 'Ora et labora'),
(10, 'Salesianos', 'San Juan Bosco', 'Da mihi animas caetera tolle'),
(11, 'Carmelitas', 'Grupo de ermitaños', 'Zelo zelatus sum pro Domino Deo Exercituum');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `santo`
--

CREATE TABLE `santo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `pais` varchar(40) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_muerte` date NOT NULL,
  `fecha_canonizacion` date NOT NULL,
  `congregacion_fk` int(11) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `fotoNombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `santo`
--

INSERT INTO `santo` (`id`, `nombre`, `pais`, `fecha_nacimiento`, `fecha_muerte`, `fecha_canonizacion`, `congregacion_fk`, `foto`, `fotoNombre`) VALUES
(10, 'Clara', 'Italia', '1194-07-16', '1253-08-11', '1255-09-26', 3, 'image/634c95df95fab1.74614180.', ''),
(12, 'Francisco', 'Italia', '1181-07-16', '1226-10-03', '1228-07-16', 3, '', ''),
(13, 'Tomás', 'Italia', '1225-07-16', '1274-03-07', '1323-07-18', 5, '', ''),
(14, 'Alberto Magno', 'Alemania', '1200-07-16', '1280-11-15', '1931-11-15', 5, '', ''),
(16, 'Alberto Hurtado', 'Chile', '1890-07-16', '1950-08-11', '2022-09-26', 8, '', ''),
(21, 'Teresa de Jesús', 'España', '1515-03-28', '1582-10-15', '1622-03-12', 11, '', ''),
(22, 'Teresita del Niño Jesús', 'Francia', '1873-01-02', '1897-09-30', '1925-05-17', 11, '', ''),
(23, 'Juan de la Cruz', 'España', '1542-06-24', '1591-12-14', '1726-12-27', 11, '', ''),
(24, 'Francisco Javier', 'España', '1506-04-07', '1552-12-03', '1622-03-12', 8, '', ''),
(25, 'Escolástica', 'Italia', '0480-01-01', '0547-01-01', '1000-01-01', 9, '', ''),
(26, 'Gregorio Magno', 'Italia', '0540-01-01', '0604-03-12', '1295-09-15', 9, '', ''),
(27, 'Domingo Savio', 'Italia', '1842-04-12', '1857-03-09', '1950-03-05', 10, '', ''),
(28, 'Artémides Zatti', 'Italia', '1880-10-12', '1951-03-15', '2022-10-09', 10, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `pass` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `pass`) VALUES
(1, 'Agustín', '$2y$10$BYuyO0nDvreQsR.x6lTrn.3yCIP8bi6nlNLIsluO.3eIeEOW7KYE.'),
(6, 'Emilio', '$2y$10$/fVE.cH6E1qt4KJy7EgAau6ZbPlY2TTsFGlkAOAKOvWfS5YPz3QNq'),
(7, 'Juan', '$2y$10$gMbzzMaATqodJoRFCASBmeT18viY7R1K/Evzn7GApL/f33JD9PXBS'),
(8, 'Admin', '$2y$10$ZoPWMFlxVL5xotkXoy7eAO4Dzli3lDt4GYoAfiaBL.r76fMADFzba');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `congregacion`
--
ALTER TABLE `congregacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `santo`
--
ALTER TABLE `santo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `congragacion_fk` (`congregacion_fk`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `congregacion`
--
ALTER TABLE `congregacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `santo`
--
ALTER TABLE `santo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `santo`
--
ALTER TABLE `santo`
  ADD CONSTRAINT `santo_ibfk_1` FOREIGN KEY (`congregacion_fk`) REFERENCES `congregacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
