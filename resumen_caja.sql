-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-06-2023 a las 01:26:56
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `envios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resumen_caja`
--

CREATE TABLE `resumen_caja` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `dinero_caja` decimal(10,2) NOT NULL,
  `deposito_manana` decimal(10,2) NOT NULL,
  `venta_total_sin_envio` decimal(10,2) NOT NULL,
  `venta_efectivo` decimal(10,2) NOT NULL,
  `venta_tarjeta` decimal(10,2) NOT NULL,
  `total_recibir_tarjeta` decimal(10,2) NOT NULL,
  `ubicacion_local` varchar(100) NOT NULL,
  `saldo_final` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resumen_caja`
--

INSERT INTO `resumen_caja` (`id`, `fecha`, `dinero_caja`, `deposito_manana`, `venta_total_sin_envio`, `venta_efectivo`, `venta_tarjeta`, `total_recibir_tarjeta`, `ubicacion_local`, `saldo_final`) VALUES
(3, '2023-06-05', '1666.00', '3500.00', '5000.00', '2500.00', '2500.00', '2412.50', 'midence soto', '5000.00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `resumen_caja`
--
ALTER TABLE `resumen_caja`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `resumen_caja`
--
ALTER TABLE `resumen_caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
