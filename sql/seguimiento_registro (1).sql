-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-03-2025 a las 22:20:12
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
-- Base de datos: `seguimiento_registro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id_pregunta` int(11) NOT NULL,
  `preguntas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`preguntas`)),
  `tipo_pregunta` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id_pregunta`, `preguntas`, `tipo_pregunta`) VALUES
(1, '[\"¿Cómo calificaría nuestro servicio?\", \"¿Recomendaría nuestra empresa?\", \"¿Con qué frecuencia compra?\", \"¿Qué productos prefiere?\"]', '[\"Respuesta Corta\", \"Respuesta Corta\", \"Respuesta Corta\", \"Respuesta Corta\"]'),
(2, '[\"¿Cómo nos conoció?\", \"¿Qué tan satisfecho está?\", \"¿En qué podemos mejorar?\",\"¿Cómo calificaría nuestro servicio?\"]', '[\"Respuesta Corta\", \"Párrafo\", \"Párrafo\", \"Casillas de Verificación\"]'),
(3, '[\"¿Ha usado nuestro servicio antes?\", \"¿Cómo nos compara con la competencia?\", \"¿Volvería a comprar con nosotros?\"]', '[\"Respuesta Corta\", \"Párrafo\", \"Respuesta Corta\", \"Respuesta Corta\"]'),
(4, '[\"¿Cuánto tiempo ha sido nuestro cliente?\", \"¿Qué promociones le gustaría ver?\", \"¿Qué cambiaría de nuestra atención al cliente?\"]', '[\"Respuesta Corta\", \"Respuesta Corta\", \"Respuesta Corta\", \"Respuesta Corta\"]'),
(5, '[\"xd\"]', '[\"Respuesta Corta\"]'),
(6, '[\"xd\",\"no\"]', '[\"Respuesta Corta\",\"Respuesta Corta\"]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion_formulario`
--

CREATE TABLE `presentacion_formulario` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `imagen` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `video` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `en_sistema` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `presentacion_formulario`
--

INSERT INTO `presentacion_formulario` (`id`, `titulo`, `imagen`, `video`, `descripcion`, `en_sistema`) VALUES
(1, 'PepeYunes', 'img/65f771a0bbd1c_descarga.png', 'https://youtu.be/6lEvIR2X9WQ?si=I5byz1ZG-zonIA7W', 'PepeYunes', 1),
(2, 'PepeYunes', 'img/65f771a0bbd1c_descarga.png', 'https://youtu.be/6lEvIR2X9WQ?si=I5byz1ZG-zonIA7W', 'PepeYunes', 0),
(3, 'PepeYunes', 'img/65fcc1423d64b_', 'https://music.youtube.com/watch?v=2UfIXzKXic0&si=3LYSyybOj8OfX0oL', 'xd', 0),
(4, 'Beautiful Mistakes', 'img/65fcc1e253f94_', 'https://music.youtube.com/watch?v=1qHr2FkRhek&si=-f67jLwkDJGShreV', 'maroon 5', 0),
(5, 'Beautiful Mistakes', 'img/65fcc1f39939e_', 'https://youtu.be/6lEvIR2X9WQ?si=I5byz1ZG-zonIA7W', 'maroon 5', 0),
(6, 'Beautiful Mistakes', 'img/65fcc23ed8fbb_', 'https://youtu.be/6lEvIR2X9WQ?si=I5byz1ZG-zonIA7W', 'mrron 5', 0),
(7, 'Beautiful Mistakes', 'img/65fcc28148565_', 'https://youtu.be/6lEvIR2X9WQ?si=I5byz1ZG-zonIA7W', 'mrron 5', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id_respuesta` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `respuestas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`respuestas`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id_respuesta`, `id_pregunta`, `respuestas`) VALUES
(1, 1, '[\"Excelente\", \"Sí, definitivamente\", \"Una vez al mes\", \"Productos electrónicos\"]'),
(2, 1, '[\"Muy bueno\", \"No, no lo recomendaría\", \"Varias veces a la semana\", \"Ropa\"]'),
(3, 2, '[\"Redes sociales\", \"Muy satisfecho\", \"Más descuentos en productos\"]'),
(4, 2, '[\"Recomendación de un amigo\", \"Neutral\", \"Atención más rápida en caja\"]'),
(5, 3, '[\"Sí\", \"Mejor que la competencia\", \"Sí, definitivamente\"]'),
(6, 3, '[\"No\", \"Prefiero otra marca\", \"No, buscaría otra opción\"]'),
(7, 4, '[\"Más de 3 años\", \"Descuentos en fidelidad\", \"Nada, todo está bien\"]'),
(8, 4, '[\"6 meses\", \"Promociones en envíos\", \"Mejorar tiempos de respuesta\"]'),
(9, 1, '[\"Excelente\", \"Sí, definitivamente\", \"Una vez al mes\", \"Productos electrónicos\"]'),
(10, 1, '[\"Excelente\", \"Sí, definitivamente\", \"Una vez al mes\", \"Productos electrónicos\"]'),
(11, 1, '[\"Excelente\", \"Sí, definitivamente\", \"Una vez al mes\", \"Productos electrónicos\"]'),
(12, 1, '[\"Excelente\", \"Sí, definitivamente\", \"Una vez al mes\", \"Productos electrónicos\"]'),
(13, 1, '[\"Excelente\", \"Sí, definitivamente\", \"Una vez al mes\", \"Productos electrónicos\"]'),
(14, 1, '[\"Excelente\", \"Sí, definitivamente\", \"Una vez al mes\", \"Productos electrónicos\"]'),
(15, 1, '[\"Excelente\", \"Sí, definitivamente\", \"Una vez al mes\", \"Productos electrónicos\"]'),
(16, 1, '[\"Bueno\",\"Bueno\",\"Bueno\",\"Bueno\"]'),
(17, 2, '[\"Bueno\",\"bueno\",\"xd\"]'),
(18, 1, '[\"Bueno\",\"Bueno\",\"Bueno\",\"Buenoxd\"]'),
(19, 1, '[\"Bueno\",\"Bueno\",\"Bueno\",\"Buenoxd\"]'),
(20, 1, '[\"Bueno\",\"Buenoxd\",\"Bueno\",\"Buenoxd\"]'),
(21, 1, '[\"Bueno\",\"Bueno\",\"Bueno\",\"Buenoxd\"]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

CREATE TABLE `seguimiento` (
  `id_seguimiento` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `estado` varchar(20) NOT NULL,
  `inicializador` int(11) NOT NULL,
  `cadena_seguimiento` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `seguimiento`
--

INSERT INTO `seguimiento` (`id_seguimiento`, `id_persona`, `fecha_inicio`, `estado`, `inicializador`, `cadena_seguimiento`) VALUES
(1, 1, '2025-02-02', 'En progreso', 1, 'Carlos -> Elena -> Diego'),
(2, 2, '2025-02-01', 'Completada', 2, 'Laura -> Miguel'),
(3, 3, '2025-02-03', 'En progreso', 3, 'Andrea -> Fernando -> Sofía'),
(4, 4, '2025-02-01', 'Completada', 4, 'Roberto -> Patricia -> Valeria'),
(5, 1, '2025-03-20', 'activo', 0, 'Encuesta realizada'),
(6, 1, '2025-03-20', 'activo', 5, 'Encuesta realizada'),
(7, 1, '2025-03-22', 'activo', 0, 'Encuesta realizada'),
(8, 1, '2025-03-22', 'activo', 7, 'Encuesta realizada'),
(9, 1, '2025-03-22', 'activo', 7, 'Encuesta realizada'),
(10, 1, '2025-03-22', 'activo', 7, 'Encuesta realizada'),
(11, 1, '2025-03-24', 'activo', 1, 'Encuesta realizada'),
(12, 1, '2025-03-24', 'activo', 1, 'Encuesta realizada'),
(13, 1, '2025-03-24', 'activo', 6, 'Encuesta realizada'),
(14, 1, '2025-03-24', 'activo', 6, 'Encuesta realizada'),
(15, 1, '2025-03-24', 'activo', 7, 'Encuesta realizada'),
(16, 1, '2025-03-27', 'activo', 1, 'Encuesta realizada');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id_pregunta`);

--
-- Indices de la tabla `presentacion_formulario`
--
ALTER TABLE `presentacion_formulario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id_respuesta`),
  ADD KEY `id_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  ADD PRIMARY KEY (`id_seguimiento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `presentacion_formulario`
--
ALTER TABLE `presentacion_formulario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  MODIFY `id_seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id_pregunta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
