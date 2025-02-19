-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-11-2022 a las 02:15:00
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agendar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id_cita` int(11) NOT NULL,
  `id_me` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fecha_fin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id_cita`, `id_me`, `fecha_inicio`, `id_paciente`, `fecha_fin`) VALUES
(24, 3, '2022-11-08 12:00:00', 1, '2022-11-08 13:00:00'),
(44, 5, '2022-11-09 09:00:00', 12, '2022-11-09 10:00:00'),
(45, 5, '2022-11-11 17:00:00', 12, '2022-11-11 18:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `id_especialidad` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`id_especialidad`, `nombre`) VALUES
(2, 'Pediatria'),
(4, 'Ginecologia'),
(6, 'Traumatologia'),
(8, 'Oncologia'),
(10, 'Dermatologia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechas`
--

CREATE TABLE `fechas` (
  `id_fe` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fechas`
--

INSERT INTO `fechas` (`id_fe`, `fecha`) VALUES
(1, '2022-11-03 00:00:00'),
(2, '2022-11-03 00:00:00'),
(3, '2022-11-03 00:00:00'),
(4, '2022-11-03 15:00:00'),
(5, '2022-11-03 18:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `id_medico` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cedula` bigint(20) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`id_medico`, `nombre`, `cedula`, `direccion`, `telefono`) VALUES
(1, 'Juan Sebastian Lopez Arboleda', 1234567890, 'Ecuador, Cuenca ', 987542136),
(2, 'Maria Fernanda De los Angeles Carrillo', 9876543210, 'Ecuador, Quito', 998877665),
(3, 'Juan Manuel Lopez Obrador', 9873216540, 'Mexico, Ciudad de Mexico', 987546123),
(4, 'Jorge Rafael Lopez Morales', 9988776655, 'Ciudad de Mexico, Mexico', 789546521),
(5, 'Rafael Jorel Jirafales Borrego', 7896574812, 'Sur de Quito Ecuador', 978452163);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico_especialidad`
--

CREATE TABLE `medico_especialidad` (
  `id_me` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_especialidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medico_especialidad`
--

INSERT INTO `medico_especialidad` (`id_me`, `id_medico`, `id_especialidad`) VALUES
(1, 1, 4),
(2, 3, 2),
(3, 2, 4),
(4, 4, 6),
(5, 5, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id_paciente` int(11) NOT NULL,
  `nombre_paciente` varchar(100) NOT NULL,
  `cedula` bigint(20) NOT NULL,
  `telefono` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `id_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `nombre_paciente`, `cedula`, `telefono`, `email`, `id_tipo`) VALUES
(1, 'Pablo Morales', 1111111111, 28, 'pmoralesm9@gmail.com', 1),
(4, 'David Jorge Miles Morales', 1020304050, 18, 'pmoralesm9@hotmail.com', 7),
(5, 'David Juan Perez', 9876543210, 18, 'dperez@gmail.com', 5),
(6, 'Maria Lourdes Jaramillo Camacho', 1750502525, 58, 'Mlourdes@hotmail.com', 1),
(7, 'Jorge Samuel Rendon Ortega', 1236547890, 65, 'JorgeRendon@hotmail.com', 5),
(12, 'Samuel David Narvaez Quintero', 1894563217, 45, 'Narvaez@gmail.com', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sangre`
--

CREATE TABLE `sangre` (
  `id_tipo` int(11) NOT NULL,
  `tipo_sangre` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sangre`
--

INSERT INTO `sangre` (`id_tipo`, `tipo_sangre`) VALUES
(1, 'O+'),
(2, 'O-'),
(3, 'A-'),
(4, 'A+'),
(5, 'B+'),
(6, 'B-'),
(7, 'AB+'),
(8, 'AB-');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `fk_me` (`id_me`),
  ADD KEY `fk_paciente` (`id_paciente`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`id_especialidad`);

--
-- Indices de la tabla `fechas`
--
ALTER TABLE `fechas`
  ADD PRIMARY KEY (`id_fe`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`id_medico`);

--
-- Indices de la tabla `medico_especialidad`
--
ALTER TABLE `medico_especialidad`
  ADD PRIMARY KEY (`id_me`),
  ADD KEY `fk_medico` (`id_medico`),
  ADD KEY `fk_especialidad` (`id_especialidad`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_paciente`),
  ADD KEY `fk_tipo` (`id_tipo`);

--
-- Indices de la tabla `sangre`
--
ALTER TABLE `sangre`
  ADD PRIMARY KEY (`id_tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id_especialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `fechas`
--
ALTER TABLE `fechas`
  MODIFY `id_fe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `medico`
--
ALTER TABLE `medico`
  MODIFY `id_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `medico_especialidad`
--
ALTER TABLE `medico_especialidad`
  MODIFY `id_me` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `sangre`
--
ALTER TABLE `sangre`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `fk_me` FOREIGN KEY (`id_me`) REFERENCES `medico_especialidad` (`id_me`),
  ADD CONSTRAINT `fk_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`);

--
-- Filtros para la tabla `medico_especialidad`
--
ALTER TABLE `medico_especialidad`
  ADD CONSTRAINT `fk_especialidad` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidad` (`id_especialidad`),
  ADD CONSTRAINT `fk_medico` FOREIGN KEY (`id_medico`) REFERENCES `medico` (`id_medico`);

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `fk_tipo` FOREIGN KEY (`id_tipo`) REFERENCES `sangre` (`id_tipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
