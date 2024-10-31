-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2024 a las 18:35:48
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUser` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `movil` varchar(25) NOT NULL,
  `nombre_completo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUser`, `usuario`, `cargo`, `contraseña`, `email`, `movil`, `nombre_completo`) VALUES
(2, 'admin', 'Administrador', '$2y$10$NVnuQWaw75749Id/Fi0EK.caxhQfEySapqKRRWCqpCt11tT5BhdRm', '', '', ''),
(5, 'lala', 'Encargado', '$2y$10$/Ym0Y3klHMILaJUXD7XpqOzcdf.bfPl5Mwa5/XpehCe4h58uboxV6', 'taniakuliba@hotmail.com', '823857483', ''),
(6, 'lp', 'Encargado', '$2y$10$yjKUbYlu6K.jBsEK7tv9Wu3jc0W7gFTCp2GVFa9eZsv2QazREbG4S', 'lp@gmail.com', '1122334455', ''),
(9, 'luka_P', 'Invitado', '$2y$10$WkmDiJA7uuoMCu1PKxsQWOWLuCRJ24MEaGMVdFOGAyXaTzNhRHUOC', 'lukaparedes15@gmail.com', '1234567891', 'luka paredes valentin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
