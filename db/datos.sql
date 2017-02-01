-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2016 a las 09:46:19
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `datos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `cargo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `cargo`) VALUES
(1, 'GERENTE'),
(2, 'VENTAS'),
(3, 'CAJERA'),
(4, 'GERENTE'),
(5, 'PUBLICISTA'),
(6, 'MERCADOTECNIA'),
(7, 'SECRETARIA'),
(8, 'CHOFER'),
(9, 'ALMACENISTA'),
(10, 'PROMOTOR'),
(11, 'SEO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` int(5) NOT NULL,
  `pais` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `pais`) VALUES
(1, 'México'),
(2, 'Argentina'),
(3, 'Chile'),
(4, 'Ecuador'),
(5, 'Brasil'),
(6, 'Cuba'),
(7, 'Haiti'),
(8, 'Honduras'),
(9, 'Belice'),
(10, 'EUA'),
(11, 'Uruguay'),
(12, 'Colombia'),
(13, 'Guatemala');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` int(5) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `telefono` varchar(25) NOT NULL,
  `direccion` text NOT NULL,
  `correo` varchar(200) NOT NULL,
  `idpais` int(11) NOT NULL,
  `idcargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `nombre`, `sexo`, `telefono`, `direccion`, `correo`, `idpais`, `idcargo`) VALUES
(1, 'Pedro paramo', 'Hombre', '454554', 'Llano en llamas, loma bonita', 'prueba@hotmail.com', 1, 1),
(2, 'Jose', 'Hombre', '678494834534', 'heroes patrios s/n, col. republica', 'prueba@hotmail.com', 2, 2),
(3, 'Luisa', 'Mujer', '35345', 'calle 32 num. 45, col. 69', 'prueba@hotmail.com', 3, 2),
(4, 'Leopoldo Contreras', 'Hombre', '342323423', 'Villas xoxo', 'prueba@hotmail.com', 4, 3),
(5, 'Bruno Diaz', 'Hombre', '68678678', 'Domicilio desconocido', 'user@hotmail.com', 13, 11),
(6, 'Patricia', 'Mujer', '5435456', 'Circuito 132, formula 1', 'prueba@hotmail.com', 11, 5),
(7, 'Peter Parker', 'Hombre', '911', 'Las arañas 345', 'prueba@hotmail.com', 6, 6),
(8, 'Beto', 'Hombre', '777', 'Desconocido', 'prueba@hotmail.com', 7, 7),
(9, 'Felipe', 'Hombre', '6544', 'Calle del oro, col. probreza', 'prueba@hotmail.com', 8, 8),
(10, 'Rocio', 'Mujer', '951', 'las rosas', 'prueba@hotmail.com', 9, 9),
(11, 'Mr. Increible', 'Hombre', '987655', 'DIsney', 'prueba@hotmail.com', 10, 10),
(13, 'Paulina ', 'Mujer', '4534543', 'Volcanes 32', 'prueba@hotmail.com', 5, 9),
(14, 'Fabian', 'Hombre', '7777', 'las palmas 456', 'prueba@hotmail.com', 7, 5),
(15, 'Debian', 'Hombre', '34343', 'Linux, gnu', 'prueba@hotmail.com', 12, 2),
(17, 'Pablo Marmol', 'Hombre', '7878', 'ninguna', 'prueba@gmil.com', 13, 1),
(18, 'Francisca', 'Mujer', '434677', 'Loma bonita', 'prueba@gmil.com', 13, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
