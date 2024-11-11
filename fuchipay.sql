-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2024 a las 21:17:36
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fuchipay`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancha`
--

CREATE TABLE `cancha` (
  `id_cancha` int(11) NOT NULL,
  `tipo_cancha` enum('futbol_5','futbol_6','futbol_7','futbol_11') NOT NULL,
  `id_complejo` int(11) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `disponible` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `complejo`
--

CREATE TABLE `complejo` (
  `id_complejo` int(11) NOT NULL,
  `nombre_complejo` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `contacto` varchar(50) DEFAULT NULL,
  `id_usuario_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `complejoservicio`
--

CREATE TABLE `complejoservicio` (
  `id_complejo` int(11) DEFAULT NULL,
  `id_servicio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horariocomplejo`
--

CREATE TABLE `horariocomplejo` (
  `id_horario` int(11) NOT NULL,
  `id_complejo` int(11) DEFAULT NULL,
  `dia_semana` enum('lunes','martes','miércoles','jueves','viernes','sábado','domingo') NOT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `cerrado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logprogramador`
--

CREATE TABLE `logprogramador` (
  `id_log` int(11) NOT NULL,
  `id_programador` int(11) DEFAULT NULL,
  `accion` varchar(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_reserva` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperacioncontraseña`
--

CREATE TABLE `recuperacioncontraseña` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiracion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recuperacioncontraseña`
--

INSERT INTO `recuperacioncontraseña` (`id`, `email`, `token`, `expiracion`) VALUES
(1, 'maximilianobravo1005@gmail.com', 'eb91739c77afc8a11bd2dc1530bbe8aaad4237566e0eb5ba983cfb325ff6f398d8705f4d5c292e858ae072e97557e071fcfa', '2024-11-07 23:05:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_cancha` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('confirmada','cancelada') DEFAULT 'confirmada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` int(11) NOT NULL,
  `nombre_servicio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `nombre_tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`id_tipo_usuario`, `nombre_tipo`) VALUES
(1, 'comun'),
(2, 'administrador'),
(3, 'programador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `id_tipo_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `apellido`, `email`, `password`, `foto_perfil`, `id_tipo_usuario`) VALUES
(13, 'agustin', 'lameme', 'murci@gmail.com', '$2y$10$EojvWWxxlRLPFw8dk2TZX.ufx85jY78CHW1DGpz5W3m9u5fYHqt0q', 'img/perfiles/Captura de pantalla 2024-07-30 151814.png', NULL),
(14, 'maxi', 'bravo', 'bravo@gmail.com', '$2y$10$RQgZ36HafKSDBjRkB6hLZO1.Hg4DwJa4hsOY7G1saiVgJ3EvPPT0i', NULL, NULL),
(15, 'maxi', 'bravo', 'goku@mail.com', '$2y$10$t1121C54jiNfgorL5tPYHOwaeGh8oDOingkka4LxgFiAS2UqzooIu', NULL, NULL),
(16, 'maxi', 'bravo', 'maxi@mail.com', '$2y$10$4vqH1de931Lo6b5A3TInMeS2Mc02Wx2460CXne2ZJpfgNy6YW/sni', NULL, NULL),
(17, 'facundo', 'lameme', 'chiva@gmail.com', '$2y$10$I25TMHW5FuKtUYNWGSDooOuKVCzXDYJBJAZoCedfjBMS6Fn7KWTQa', NULL, NULL),
(18, 'ferfe', 'feeff', 'cosoooo@mail.com', '$2y$10$bTYKWIozqn5vRUpxQqRl2OwN.CRM0JFZnvHEYHmcrmmFfixkh0Sfu', NULL, NULL),
(19, 'maxi', 'bravo', 'rubil@gmail.com', '$2y$10$fObplT6l1U3h/mNIIxkkLOLm6cIKR3aBN2gnMTo2EbiGhMj6USMXO', 'img/perfiles/Captura de pantalla 2024-07-30 151814.png', NULL),
(20, 'facundo', 'rubil', 'rubil1@gmail.com', '$2y$10$xZxJcPCH2IT4QNxippeDhODP/YM/PaXBtEkKMLgsNi8RvQRQqrRrG', 'img/perfiles/Captura de pantalla 2024-07-30 151814.png', NULL),
(21, 'agustin', 'lameme', 'lameme@gmail.com', '$2y$10$sYwXWZQT5mKK8d3xt317i.9//UXsYTaEBZlJTlQOndhnMD7OTxiEK', 'img/perfiles/Captura de pantalla 2024-07-30 151814.png', NULL),
(22, 'terron', 'delosantos', 'terrron@gmail.com', '$2y$10$6LMS86SwVdk1C9Ni1bObCeXGfhCcQ9/OuMgC.MLPl3eLYLF43qhK.', 'img/perfiles/Captura de pantalla 2024-07-30 151814.png', NULL),
(23, 'mjj', 'jumj', 'lameme@mail.com', '$2y$10$yqQveNLu7iAsrw3/9m23KeYLFs0HPmmn8cKOS18LAAiMlFeViUftC', NULL, NULL),
(25, 'tr', 'escobar', 'escobar@mail.com', '$2y$10$7rqg8kHB/O1YDeVengLO8uIToOrg3/w6rYUBMDffYPSt.6/vsub8m', NULL, NULL),
(26, 'maxi', 'bravo', 'maximilianobravo1005@gmail.com', '$2y$10$fEhm5/jYbtUrSzij/8nPiubHa0hh.4DUaq6Ar5WO3kL2GhYhbWQvq', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cancha`
--
ALTER TABLE `cancha`
  ADD PRIMARY KEY (`id_cancha`),
  ADD KEY `id_complejo` (`id_complejo`);

--
-- Indices de la tabla `complejo`
--
ALTER TABLE `complejo`
  ADD PRIMARY KEY (`id_complejo`),
  ADD KEY `id_usuario_admin` (`id_usuario_admin`);

--
-- Indices de la tabla `complejoservicio`
--
ALTER TABLE `complejoservicio`
  ADD KEY `id_complejo` (`id_complejo`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `horariocomplejo`
--
ALTER TABLE `horariocomplejo`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `id_complejo` (`id_complejo`);

--
-- Indices de la tabla `logprogramador`
--
ALTER TABLE `logprogramador`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_programador` (`id_programador`),
  ADD KEY `id_reserva` (`id_reserva`);

--
-- Indices de la tabla `recuperacioncontraseña`
--
ALTER TABLE `recuperacioncontraseña`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_cancha` (`id_cancha`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_tipo_usuario` (`id_tipo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cancha`
--
ALTER TABLE `cancha`
  MODIFY `id_cancha` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `complejo`
--
ALTER TABLE `complejo`
  MODIFY `id_complejo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horariocomplejo`
--
ALTER TABLE `horariocomplejo`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `logprogramador`
--
ALTER TABLE `logprogramador`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recuperacioncontraseña`
--
ALTER TABLE `recuperacioncontraseña`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cancha`
--
ALTER TABLE `cancha`
  ADD CONSTRAINT `cancha_ibfk_1` FOREIGN KEY (`id_complejo`) REFERENCES `complejo` (`id_complejo`);

--
-- Filtros para la tabla `complejo`
--
ALTER TABLE `complejo`
  ADD CONSTRAINT `complejo_ibfk_1` FOREIGN KEY (`id_usuario_admin`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `complejoservicio`
--
ALTER TABLE `complejoservicio`
  ADD CONSTRAINT `complejoservicio_ibfk_1` FOREIGN KEY (`id_complejo`) REFERENCES `complejo` (`id_complejo`),
  ADD CONSTRAINT `complejoservicio_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`);

--
-- Filtros para la tabla `horariocomplejo`
--
ALTER TABLE `horariocomplejo`
  ADD CONSTRAINT `horariocomplejo_ibfk_1` FOREIGN KEY (`id_complejo`) REFERENCES `complejo` (`id_complejo`);

--
-- Filtros para la tabla `logprogramador`
--
ALTER TABLE `logprogramador`
  ADD CONSTRAINT `logprogramador_ibfk_1` FOREIGN KEY (`id_programador`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `logprogramador_ibfk_2` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id_reserva`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`id_cancha`) REFERENCES `cancha` (`id_cancha`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipousuario` (`id_tipo_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
