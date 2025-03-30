-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-03-2025 a las 06:48:16
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
-- Base de datos: `politic_vote`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_colonias`
--

CREATE TABLE `dbo_colonias` (
  `idColonia` int(10) NOT NULL,
  `colonia` varchar(90) NOT NULL,
  `codigoPostal` char(5) NOT NULL,
  `idEstado` int(10) NOT NULL,
  `idMunicipio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_colonias`
--

INSERT INTO `dbo_colonias` (`idColonia`, `colonia`, `codigoPostal`, `idEstado`, `idMunicipio`) VALUES
(1, 'Centro', '20000', 1, 1),
(2, 'Revolución', '21000', 2, 2),
(3, 'Buenavista', '23000', 3, 3),
(4, 'San Francisco', '24000', 4, 4),
(5, 'Las Palmas', '29000', 5, 5),
(6, 'Olivares Santana', '94650', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_coordinadores`
--

CREATE TABLE `dbo_coordinadores` (
  `idCoordinador` int(10) NOT NULL,
  `idUsuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_coordinadores`
--

INSERT INTO `dbo_coordinadores` (`idCoordinador`, `idUsuario`) VALUES
(1, 2),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_distrito_federal`
--

CREATE TABLE `dbo_distrito_federal` (
  `id_distrito_federal` int(11) NOT NULL,
  `distrito` varchar(255) DEFAULT NULL,
  `cabecera` varchar(255) DEFAULT NULL,
  `idEstado` int(11) DEFAULT NULL,
  `idMunicipio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_distrito_federal`
--

INSERT INTO `dbo_distrito_federal` (`id_distrito_federal`, `distrito`, `cabecera`, `idEstado`, `idMunicipio`) VALUES
(1, 'Distrito Federal 1', 'Ciudad de México', 16, 7),
(2, 'Distrito Federal 2', 'Guadalajara', 10, 8),
(3, 'Distrito Federal 3', 'Monterrey', 15, 9),
(4, 'Distrito Federal 4', 'Puebla', 12, 10),
(5, 'Distrito Federal 5', 'Toluca', 8, 1),
(6, 'Distrito 16', 'Córdoba', 30, 33),
(7, 'Distrito 15', 'Orizaba', 30, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_distrito_local`
--

CREATE TABLE `dbo_distrito_local` (
  `id_distrito_local` int(11) NOT NULL,
  `clave_municipio` varchar(255) DEFAULT NULL,
  `poblacion total` int(11) DEFAULT NULL,
  `idMunicipio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_distrito_local`
--

INSERT INTO `dbo_distrito_local` (`id_distrito_local`, `clave_municipio`, `poblacion total`, `idMunicipio`) VALUES
(1, 'DF-001', 500000, 7),
(2, 'DF-002', 300000, 8),
(3, 'DF-003', 400000, 9),
(4, 'DF-004', 250000, 10),
(5, 'DF-005', 350000, 1),
(6, 'DF-006', 50001, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_estados`
--

CREATE TABLE `dbo_estados` (
  `idEstado` int(10) NOT NULL,
  `estado` varchar(70) NOT NULL,
  `alias` char(10) NOT NULL,
  `id_pais` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_estados`
--

INSERT INTO `dbo_estados` (`idEstado`, `estado`, `alias`, `id_pais`) VALUES
(1, 'Aguascalientes', 'AGS', 1),
(2, 'Baja California', 'BC', 1),
(3, 'Baja California Sur', 'BCS', 1),
(4, 'Campeche', 'CAM', 1),
(5, 'Chiapas', 'CHIS', 1),
(6, 'Chihuahua', 'CHIH', 1),
(7, 'Ciudad de México', 'CDMX', 1),
(8, 'Coahuila', 'COAH', 1),
(9, 'Colima', 'COL', 1),
(10, 'Durango', 'DGO', 1),
(11, 'Estado de México', 'EDOMEX', 1),
(12, 'Guanajuato', 'GTO', 1),
(13, 'Guerrero', 'GRO', 1),
(14, 'Hidalgo', 'HGO', 1),
(15, 'Jalisco', 'JAL', 1),
(16, 'Michoacán', 'MICH', 1),
(17, 'Morelos', 'MOR', 1),
(18, 'Nayarit', 'NAY', 1),
(19, 'Nuevo León', 'NL', 1),
(20, 'Oaxaca', 'OAX', 1),
(21, 'Puebla', 'PUE', 1),
(22, 'Querétaro', 'QRO', 1),
(23, 'Quintana Roo', 'QROO', 1),
(24, 'San Luis Potosí', 'SLP', 1),
(25, 'Sinaloa', 'SIN', 1),
(26, 'Sonora', 'SON', 1),
(27, 'Tabasco', 'TAB', 1),
(28, 'Tamaulipas', 'TAMPS', 1),
(29, 'Tlaxcala', 'TLAX', 1),
(30, 'Veracruz', 'VER', 1),
(31, 'Yucatán', 'YUC', 1),
(32, 'Zacatecas', 'ZAC', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_lideres`
--

CREATE TABLE `dbo_lideres` (
  `idLider` int(10) NOT NULL,
  `idPersona` int(10) NOT NULL,
  `inscritos` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_lideres`
--

INSERT INTO `dbo_lideres` (`idLider`, `idPersona`, `inscritos`) VALUES
(1, 1, 100),
(2, 2, 150),
(3, 3, 200),
(4, 4, 250),
(5, 5, 300);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_login_perfiles`
--

CREATE TABLE `dbo_login_perfiles` (
  `idPerfil` int(10) NOT NULL,
  `perfil` varchar(20) NOT NULL,
  `alias` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_login_perfiles`
--

INSERT INTO `dbo_login_perfiles` (`idPerfil`, `perfil`, `alias`) VALUES
(1, 'Administrador', 'ADM'),
(2, 'Coordinador', 'COR'),
(3, 'Testigo', 'TES'),
(4, 'Voluntario', 'VOL'),
(5, 'Líder', 'LID');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_lugaresvotacion`
--

CREATE TABLE `dbo_lugaresvotacion` (
  `idLugarVotacion` int(10) NOT NULL,
  `nombreLugar` varchar(80) NOT NULL,
  `idEstado` int(10) NOT NULL,
  `idMunicipio` int(10) NOT NULL,
  `idColonia` int(10) NOT NULL,
  `calle` varchar(50) NOT NULL,
  `noExterior` varchar(10) DEFAULT NULL,
  `noInterior` char(10) DEFAULT NULL,
  `codigoPostal` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_lugaresvotacion`
--

INSERT INTO `dbo_lugaresvotacion` (`idLugarVotacion`, `nombreLugar`, `idEstado`, `idMunicipio`, `idColonia`, `calle`, `noExterior`, `noInterior`, `codigoPostal`) VALUES
(1, 'Escuela Primaria', 1, 1, 1, 'Av. Principal', '123', 'A', '20000'),
(2, 'Centro Comunitario', 2, 2, 2, 'Calle Revolución', '456', 'B', '21000'),
(3, 'Biblioteca Municipal', 3, 3, 3, 'Calle Buenavista', '789', 'C', '23000'),
(4, 'Parque Central', 4, 4, 4, 'Calle San Francisco', '101', 'D', '24000'),
(5, 'Plaza Principal', 5, 5, 5, 'Calle Las Palmas', '202', 'E', '29000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_mesasvotacion`
--

CREATE TABLE `dbo_mesasvotacion` (
  `idMesaVotacion` int(10) NOT NULL,
  `nombreMesa` varchar(80) NOT NULL,
  `idLugarVotacion` int(10) NOT NULL,
  `idCoordinador` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_mesasvotacion`
--

INSERT INTO `dbo_mesasvotacion` (`idMesaVotacion`, `nombreMesa`, `idLugarVotacion`, `idCoordinador`) VALUES
(18, 'Mesa 1', 1, 1),
(19, 'Mesa 2', 2, 2),
(20, 'Mesa 3', 3, 3),
(21, 'Mesa 4', 4, 4),
(22, 'Mesa 5', 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_municipios`
--

CREATE TABLE `dbo_municipios` (
  `idMunicipio` int(10) NOT NULL,
  `municipio` varchar(80) NOT NULL,
  `idEstado` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_municipios`
--

INSERT INTO `dbo_municipios` (`idMunicipio`, `municipio`, `idEstado`) VALUES
(1, 'Aguascalientes', 1),
(2, 'Mexicali', 2),
(3, 'La Paz', 3),
(4, 'Campeche', 4),
(5, 'Tuxtla Gutiérrez', 5),
(6, 'Chihuahua', 6),
(7, 'Cuauhtémoc', 7),
(8, 'Saltillo', 8),
(9, 'Colima', 9),
(10, 'Durango', 10),
(11, 'Toluca', 11),
(12, 'Guanajuato', 12),
(13, 'Chilpancingo', 13),
(14, 'Pachuca', 14),
(15, 'Guadalajara', 15),
(16, 'Morelia', 16),
(17, 'Cuernavaca', 17),
(18, 'Tepic', 18),
(19, 'Monterrey', 19),
(20, 'Oaxaca', 20),
(21, 'Puebla', 21),
(22, 'Querétaro', 22),
(23, 'Chetumal', 23),
(24, 'San Luis Potosí', 24),
(25, 'Culiacán', 25),
(26, 'Hermosillo', 26),
(27, 'Villahermosa', 27),
(28, 'Ciudad Victoria', 28),
(29, 'Tlaxcala', 29),
(30, 'Xalapa', 30),
(31, 'Mérida', 31),
(32, 'Zacatecas', 32),
(33, 'Córdoba', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_pais`
--

CREATE TABLE `dbo_pais` (
  `id_pais` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_pais`
--

INSERT INTO `dbo_pais` (`id_pais`, `nombre`, `alias`) VALUES
(1, 'México', 'MEX'),
(2, 'Argentina', 'ARG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_partidos`
--

CREATE TABLE `dbo_partidos` (
  `idPartido` int(10) NOT NULL,
  `partido` varchar(100) NOT NULL,
  `alias` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_partidos`
--

INSERT INTO `dbo_partidos` (`idPartido`, `partido`, `alias`) VALUES
(1, 'Partido Acción Nacional', 'PAN'),
(2, 'Partido Revolucionario Institucional', 'PRI'),
(3, 'Partido de la Revolución Democrática', 'PRD'),
(4, 'Movimiento Regeneración Nacional', 'MORENA'),
(5, 'Partido Verde Ecologista de México', 'PVEM'),
(6, 'Movimiento ciudadano', 'MC'),
(7, 'Redes Sociales Progresistas', 'RSP'),
(8, 'Partido Nueva Alianza', 'PNA'),
(9, 'Partido del trabajo', 'PT'),
(23, 'Partido Nueva Alianza', 'PNA'),
(24, 'Partido Nueva Alianza', 'PNA'),
(25, 'Partido del pene', 'PN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_personas`
--

CREATE TABLE `dbo_personas` (
  `idPersona` int(10) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `primApellido` varchar(70) NOT NULL,
  `segApellido` varchar(70) NOT NULL,
  `curp` char(18) NOT NULL,
  `claveElector` char(18) NOT NULL,
  `telefonoCelular` char(10) NOT NULL,
  `telefonoCasa` char(10) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `fecNacimiento` date NOT NULL,
  `calle` varchar(70) NOT NULL,
  `noExterior` varchar(10) DEFAULT NULL,
  `noInterior` varchar(10) DEFAULT NULL,
  `codigoPostal` char(5) NOT NULL,
  `idEstado` int(10) NOT NULL,
  `idMunicipio` int(10) NOT NULL,
  `idColonia` int(10) NOT NULL,
  `idPersonaTipoSangre` int(10) NOT NULL,
  `idPersonaOcupacion` int(10) NOT NULL,
  `idPersonaGradoAcademico` int(10) NOT NULL,
  `idPersonaPoblacion` int(10) NOT NULL,
  `idPersonaEstadoApoyo` int(10) NOT NULL,
  `idLugarVotacion` int(10) NOT NULL,
  `idMesaVotacion` int(10) NOT NULL,
  `disponibilidad` int(10) NOT NULL,
  `observaciones` varchar(150) DEFAULT NULL,
  `id_distrito_federal` int(11) DEFAULT NULL,
  `id_distrito_local` int(11) DEFAULT NULL,
  `idPersonaGenero` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_personas`
--

INSERT INTO `dbo_personas` (`idPersona`, `nombre`, `primApellido`, `segApellido`, `curp`, `claveElector`, `telefonoCelular`, `telefonoCasa`, `correo`, `fecNacimiento`, `calle`, `noExterior`, `noInterior`, `codigoPostal`, `idEstado`, `idMunicipio`, `idColonia`, `idPersonaTipoSangre`, `idPersonaOcupacion`, `idPersonaGradoAcademico`, `idPersonaPoblacion`, `idPersonaEstadoApoyo`, `idLugarVotacion`, `idMesaVotacion`, `disponibilidad`, `observaciones`, `id_distrito_federal`, `id_distrito_local`, `idPersonaGenero`) VALUES
(1, 'Juan', 'Pérez', 'Gómez', 'PEGJ800101HDFRRN01', 'PEGJ800101HDFRRN01', '5551234567', '5559876543', 'juan.perez@example.com', '1980-01-01', 'Av. Insurgentes', '123', 'A', '06100', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Ninguna observación', NULL, NULL, NULL),
(2, 'María', 'García', 'López', 'GALM800202MDFRRN02', 'GALM800202MDFRRN02', '5551234567', '5559876543', 'maria.garcia@example.com', '1980-02-02', 'Av. Insurgentes', '123', 'A', '06100', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Ninguna observación', NULL, NULL, NULL),
(3, 'Carlos', 'Martínez', 'Sánchez', 'MASC800303HDFRRN03', 'MASC800303HDFRRN03', '5551234567', '5559876543', 'carlos.martinez@example.com', '1980-03-03', 'Av. Insurgentes', '123', 'A', '06100', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Ninguna observación', NULL, NULL, NULL),
(4, 'Ana', 'Hernández', 'Ramírez', 'HERA800404MDFRRN04', 'HERA800404MDFRRN04', '5551234567', '5559876543', 'ana.hernandez@example.com', '1980-04-04', 'Av. Insurgentes', '123', 'A', '06100', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Ninguna observación', NULL, NULL, NULL),
(5, 'Luis', 'Díaz', 'Fernández', 'DIFL800505HDFRRN05', 'DIFL800505HDFRRN05', '5551234567', '5559876543', 'luis.diaz@example.com', '1980-05-05', 'Av. Insurgentes', '123', 'A', '06100', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Ninguna observación', NULL, NULL, NULL),
(6, 'Laura', 'Vázquez', 'Torres', 'VATL800606MDFRRN06', 'VATL800606MDFRRN06', '5551234567', '5559876543', 'laura.vazquez@example.com', '1980-06-06', 'Av. Insurgentes', '123', 'A', '06100', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Ninguna observación', NULL, NULL, NULL),
(7, 'Jorge', 'Jiménez', 'Ortega', 'JIOJ800707HDFRRN07', 'JIOJ800707HDFRRN07', '5551234567', '5559876543', 'jorge.jimenez@example.com', '1980-07-07', 'Av. Insurgentes', '123', 'A', '06100', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Ninguna observación', NULL, NULL, NULL),
(8, 'Sofía', 'Ruiz', 'Gómez', 'RUGS800808MDFRRN08', 'RUGS800808MDFRRN08', '5551234567', '5559876543', 'sofia.ruiz@example.com', '1980-08-08', 'Av. Insurgentes', '123', 'A', '06100', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Ninguna observación', NULL, NULL, NULL),
(9, 'Miguel', 'Torres', 'Hernández', 'TOHM800909HDFRRN09', 'TOHM800909HDFRRN09', '5551234567', '5559876543', 'miguel.torres@example.com', '1980-09-09', 'Av. Insurgentes', '123', 'A', '06100', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Ninguna observación', NULL, NULL, NULL),
(10, 'Elena', 'Castro', 'Morales', 'CAME801010MDFRRN10', 'CAME801010MDFRRN10', '5551234567', '5559876543', 'elena.castro@example.com', '1980-10-10', 'Av. Insurgentes', '123', 'A', '06100', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Ninguna observación', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_personas_estadosapoyo`
--

CREATE TABLE `dbo_personas_estadosapoyo` (
  `idPersonaEstadoApoyo` int(10) NOT NULL,
  `estadoApoyo` varchar(80) NOT NULL,
  `personas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_personas_estadosapoyo`
--

INSERT INTO `dbo_personas_estadosapoyo` (`idPersonaEstadoApoyo`, `estadoApoyo`, `personas`) VALUES
(1, 'Apoyado', 500),
(2, 'No apoyado', 300),
(3, 'En proceso', 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_personas_generos`
--

CREATE TABLE `dbo_personas_generos` (
  `idPersonaGenero` int(10) NOT NULL,
  `genero` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_personas_generos`
--

INSERT INTO `dbo_personas_generos` (`idPersonaGenero`, `genero`) VALUES
(1, 'Masculino'),
(2, 'Femenino'),
(3, 'No binario'),
(4, 'Otro'),
(5, 'Prefiero no decir');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_personas_gradosacademicos`
--

CREATE TABLE `dbo_personas_gradosacademicos` (
  `idPersonaGradoAcademico` int(10) NOT NULL,
  `gradoAcademico` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_personas_gradosacademicos`
--

INSERT INTO `dbo_personas_gradosacademicos` (`idPersonaGradoAcademico`, `gradoAcademico`) VALUES
(1, 'Primaria'),
(2, 'Secundaria'),
(3, 'Preparatoria'),
(4, 'Licenciatura'),
(5, 'Maestría');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_personas_ocupaciones`
--

CREATE TABLE `dbo_personas_ocupaciones` (
  `idPersonaOcupacion` int(10) NOT NULL,
  `ocupacion` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_personas_ocupaciones`
--

INSERT INTO `dbo_personas_ocupaciones` (`idPersonaOcupacion`, `ocupacion`) VALUES
(1, 'Ingeniero'),
(2, 'Médico'),
(3, 'Abogado'),
(4, 'Profesor'),
(5, 'Estudiante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_personas_poblaciones`
--

CREATE TABLE `dbo_personas_poblaciones` (
  `idPersonaPoblacion` int(10) NOT NULL,
  `poblacion` varchar(80) NOT NULL,
  `personas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_personas_poblaciones`
--

INSERT INTO `dbo_personas_poblaciones` (`idPersonaPoblacion`, `poblacion`, `personas`) VALUES
(1, 'Urbana', 1000),
(2, 'Rural', 500),
(3, 'Indígena', 300),
(4, 'Migrante', 200),
(5, 'Otro', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_personas_tipossangre`
--

CREATE TABLE `dbo_personas_tipossangre` (
  `idPersonaTipoSangre` int(10) NOT NULL,
  `tipoSangre` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_personas_tipossangre`
--

INSERT INTO `dbo_personas_tipossangre` (`idPersonaTipoSangre`, `tipoSangre`) VALUES
(1, 'O+'),
(2, 'A+'),
(3, 'B+'),
(4, 'AB+'),
(5, 'O-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_testigos`
--

CREATE TABLE `dbo_testigos` (
  `idTestigo` int(10) NOT NULL,
  `idPersona` int(10) NOT NULL,
  `idMesaVotacion` int(10) NOT NULL,
  `idCoordinador` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_testigos`
--

INSERT INTO `dbo_testigos` (`idTestigo`, `idPersona`, `idMesaVotacion`, `idCoordinador`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2),
(3, 3, 3, 3),
(4, 4, 4, 4),
(5, 5, 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_usuarios`
--

CREATE TABLE `dbo_usuarios` (
  `idUsuario` int(10) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `primApellido` varchar(70) NOT NULL,
  `segApellido` varchar(70) NOT NULL,
  `usuario` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `idPerfil` int(10) NOT NULL,
  `idPartido` int(10) NOT NULL,
  `idPersona` int(10) DEFAULT NULL,
  `estatus` int(10) NOT NULL COMMENT '1: Activo | 0: Inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_usuarios`
--

INSERT INTO `dbo_usuarios` (`idUsuario`, `nombre`, `primApellido`, `segApellido`, `usuario`, `password`, `idPerfil`, `idPartido`, `idPersona`, `estatus`) VALUES
(1, 'Juan', 'Pérez', 'Gómez', 'jperez', '7c6a180b36896a0a8c02787eeafb0e4c', 1, 1, 1, 1),
(2, 'María', 'López', 'García', 'mlopez', '6cb75f652a9b52798eb6cf2201057c73', 2, 2, 2, 1),
(3, 'Pedro', 'González', 'Martínez', 'pgonzalez', 'password3', 3, 3, 3, 1),
(4, 'Ana', 'Martínez', 'Hernández', 'amartinez', 'password4', 4, 4, 4, 1),
(5, 'Luis', 'Hernández', 'Díaz', 'lhernandez', 'password5', 5, 5, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbo_voluntarios`
--

CREATE TABLE `dbo_voluntarios` (
  `idVoluntario` int(10) NOT NULL,
  `idPersona` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dbo_voluntarios`
--

INSERT INTO `dbo_voluntarios` (`idVoluntario`, `idPersona`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugaresvotacion`
--

CREATE TABLE `lugaresvotacion` (
  `idLugarVotacion` int(10) NOT NULL,
  `nombreLugar` varchar(80) NOT NULL,
  `idEstado` int(10) NOT NULL,
  `idMunicipio` int(10) NOT NULL,
  `idColonia` int(10) NOT NULL,
  `calle` varchar(50) NOT NULL,
  `noExterior` varchar(10) DEFAULT NULL,
  `noInterior` char(10) DEFAULT NULL,
  `codigoPostal` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dbo_colonias`
--
ALTER TABLE `dbo_colonias`
  ADD PRIMARY KEY (`idColonia`),
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `idMunicipio` (`idMunicipio`);

--
-- Indices de la tabla `dbo_coordinadores`
--
ALTER TABLE `dbo_coordinadores`
  ADD PRIMARY KEY (`idCoordinador`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `dbo_distrito_federal`
--
ALTER TABLE `dbo_distrito_federal`
  ADD PRIMARY KEY (`id_distrito_federal`),
  ADD KEY `dbo_distrito_federal_dbo_municipios_FK` (`idMunicipio`);

--
-- Indices de la tabla `dbo_distrito_local`
--
ALTER TABLE `dbo_distrito_local`
  ADD PRIMARY KEY (`id_distrito_local`),
  ADD KEY `dbo_distrito_local_dbo_municipios_FK` (`idMunicipio`);

--
-- Indices de la tabla `dbo_estados`
--
ALTER TABLE `dbo_estados`
  ADD PRIMARY KEY (`idEstado`),
  ADD KEY `dbo_estados_dbo_pais_FK` (`id_pais`);

--
-- Indices de la tabla `dbo_lideres`
--
ALTER TABLE `dbo_lideres`
  ADD PRIMARY KEY (`idLider`),
  ADD KEY `idPersona` (`idPersona`);

--
-- Indices de la tabla `dbo_login_perfiles`
--
ALTER TABLE `dbo_login_perfiles`
  ADD PRIMARY KEY (`idPerfil`);

--
-- Indices de la tabla `dbo_lugaresvotacion`
--
ALTER TABLE `dbo_lugaresvotacion`
  ADD PRIMARY KEY (`idLugarVotacion`),
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `idMunicipio` (`idMunicipio`),
  ADD KEY `idColonia` (`idColonia`);

--
-- Indices de la tabla `dbo_mesasvotacion`
--
ALTER TABLE `dbo_mesasvotacion`
  ADD PRIMARY KEY (`idMesaVotacion`),
  ADD KEY `idLugarVotacion` (`idLugarVotacion`),
  ADD KEY `idCoordinador` (`idCoordinador`);

--
-- Indices de la tabla `dbo_municipios`
--
ALTER TABLE `dbo_municipios`
  ADD PRIMARY KEY (`idMunicipio`),
  ADD KEY `idEstado` (`idEstado`);

--
-- Indices de la tabla `dbo_pais`
--
ALTER TABLE `dbo_pais`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indices de la tabla `dbo_partidos`
--
ALTER TABLE `dbo_partidos`
  ADD PRIMARY KEY (`idPartido`);

--
-- Indices de la tabla `dbo_personas`
--
ALTER TABLE `dbo_personas`
  ADD PRIMARY KEY (`idPersona`),
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `idMunicipio` (`idMunicipio`),
  ADD KEY `idColonia` (`idColonia`),
  ADD KEY `idPersonaTipoSangre` (`idPersonaTipoSangre`),
  ADD KEY `idPersonaOcupacion` (`idPersonaOcupacion`),
  ADD KEY `idPersonaGradoAcademico` (`idPersonaGradoAcademico`),
  ADD KEY `idPersonaPoblacion` (`idPersonaPoblacion`),
  ADD KEY `idPersonaEstadoApoyo` (`idPersonaEstadoApoyo`),
  ADD KEY `idLugarVotacion` (`idLugarVotacion`),
  ADD KEY `idMesaVotacion` (`idMesaVotacion`),
  ADD KEY `dbo_personas_dbo_distrito_federal_FK` (`id_distrito_federal`),
  ADD KEY `dbo_personas_dbo_distrito_local_FK` (`id_distrito_local`),
  ADD KEY `dbo_personas_dbo_personas_generos_FK` (`idPersonaGenero`);

--
-- Indices de la tabla `dbo_personas_estadosapoyo`
--
ALTER TABLE `dbo_personas_estadosapoyo`
  ADD PRIMARY KEY (`idPersonaEstadoApoyo`);

--
-- Indices de la tabla `dbo_personas_generos`
--
ALTER TABLE `dbo_personas_generos`
  ADD PRIMARY KEY (`idPersonaGenero`);

--
-- Indices de la tabla `dbo_personas_gradosacademicos`
--
ALTER TABLE `dbo_personas_gradosacademicos`
  ADD PRIMARY KEY (`idPersonaGradoAcademico`);

--
-- Indices de la tabla `dbo_personas_ocupaciones`
--
ALTER TABLE `dbo_personas_ocupaciones`
  ADD PRIMARY KEY (`idPersonaOcupacion`);

--
-- Indices de la tabla `dbo_personas_poblaciones`
--
ALTER TABLE `dbo_personas_poblaciones`
  ADD PRIMARY KEY (`idPersonaPoblacion`);

--
-- Indices de la tabla `dbo_personas_tipossangre`
--
ALTER TABLE `dbo_personas_tipossangre`
  ADD PRIMARY KEY (`idPersonaTipoSangre`);

--
-- Indices de la tabla `dbo_testigos`
--
ALTER TABLE `dbo_testigos`
  ADD PRIMARY KEY (`idTestigo`),
  ADD KEY `idPersona` (`idPersona`),
  ADD KEY `idMesaVotacion` (`idMesaVotacion`),
  ADD KEY `idCoordinador` (`idCoordinador`);

--
-- Indices de la tabla `dbo_usuarios`
--
ALTER TABLE `dbo_usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idPerfil` (`idPerfil`),
  ADD KEY `idPartido` (`idPartido`),
  ADD KEY `idPersona` (`idPersona`);

--
-- Indices de la tabla `dbo_voluntarios`
--
ALTER TABLE `dbo_voluntarios`
  ADD PRIMARY KEY (`idVoluntario`),
  ADD KEY `idPersona` (`idPersona`);

--
-- Indices de la tabla `lugaresvotacion`
--
ALTER TABLE `lugaresvotacion`
  ADD PRIMARY KEY (`idLugarVotacion`),
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `idMunicipio` (`idMunicipio`),
  ADD KEY `idColonia` (`idColonia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dbo_colonias`
--
ALTER TABLE `dbo_colonias`
  MODIFY `idColonia` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `dbo_coordinadores`
--
ALTER TABLE `dbo_coordinadores`
  MODIFY `idCoordinador` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `dbo_distrito_federal`
--
ALTER TABLE `dbo_distrito_federal`
  MODIFY `id_distrito_federal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `dbo_distrito_local`
--
ALTER TABLE `dbo_distrito_local`
  MODIFY `id_distrito_local` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `dbo_estados`
--
ALTER TABLE `dbo_estados`
  MODIFY `idEstado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `dbo_lideres`
--
ALTER TABLE `dbo_lideres`
  MODIFY `idLider` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `dbo_login_perfiles`
--
ALTER TABLE `dbo_login_perfiles`
  MODIFY `idPerfil` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `dbo_lugaresvotacion`
--
ALTER TABLE `dbo_lugaresvotacion`
  MODIFY `idLugarVotacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `dbo_mesasvotacion`
--
ALTER TABLE `dbo_mesasvotacion`
  MODIFY `idMesaVotacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `dbo_municipios`
--
ALTER TABLE `dbo_municipios`
  MODIFY `idMunicipio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `dbo_pais`
--
ALTER TABLE `dbo_pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `dbo_partidos`
--
ALTER TABLE `dbo_partidos`
  MODIFY `idPartido` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `dbo_personas`
--
ALTER TABLE `dbo_personas`
  MODIFY `idPersona` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `dbo_personas_estadosapoyo`
--
ALTER TABLE `dbo_personas_estadosapoyo`
  MODIFY `idPersonaEstadoApoyo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `dbo_personas_generos`
--
ALTER TABLE `dbo_personas_generos`
  MODIFY `idPersonaGenero` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `dbo_personas_gradosacademicos`
--
ALTER TABLE `dbo_personas_gradosacademicos`
  MODIFY `idPersonaGradoAcademico` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `dbo_personas_ocupaciones`
--
ALTER TABLE `dbo_personas_ocupaciones`
  MODIFY `idPersonaOcupacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `dbo_personas_poblaciones`
--
ALTER TABLE `dbo_personas_poblaciones`
  MODIFY `idPersonaPoblacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `dbo_personas_tipossangre`
--
ALTER TABLE `dbo_personas_tipossangre`
  MODIFY `idPersonaTipoSangre` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `dbo_testigos`
--
ALTER TABLE `dbo_testigos`
  MODIFY `idTestigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `dbo_usuarios`
--
ALTER TABLE `dbo_usuarios`
  MODIFY `idUsuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `dbo_voluntarios`
--
ALTER TABLE `dbo_voluntarios`
  MODIFY `idVoluntario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `lugaresvotacion`
--
ALTER TABLE `lugaresvotacion`
  MODIFY `idLugarVotacion` int(10) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dbo_colonias`
--
ALTER TABLE `dbo_colonias`
  ADD CONSTRAINT `FKdbo_coloni379623` FOREIGN KEY (`idMunicipio`) REFERENCES `dbo_municipios` (`idMunicipio`),
  ADD CONSTRAINT `FKdbo_coloni955102` FOREIGN KEY (`idEstado`) REFERENCES `dbo_estados` (`idEstado`);

--
-- Filtros para la tabla `dbo_coordinadores`
--
ALTER TABLE `dbo_coordinadores`
  ADD CONSTRAINT `FKdbo_coordi706417` FOREIGN KEY (`idUsuario`) REFERENCES `dbo_usuarios` (`idUsuario`);

--
-- Filtros para la tabla `dbo_distrito_federal`
--
ALTER TABLE `dbo_distrito_federal`
  ADD CONSTRAINT `dbo_distrito_federal_dbo_municipios_FK` FOREIGN KEY (`idMunicipio`) REFERENCES `dbo_municipios` (`idMunicipio`);

--
-- Filtros para la tabla `dbo_distrito_local`
--
ALTER TABLE `dbo_distrito_local`
  ADD CONSTRAINT `dbo_distrito_local_dbo_municipios_FK` FOREIGN KEY (`idMunicipio`) REFERENCES `dbo_municipios` (`idMunicipio`);

--
-- Filtros para la tabla `dbo_estados`
--
ALTER TABLE `dbo_estados`
  ADD CONSTRAINT `dbo_estados_dbo_pais_FK` FOREIGN KEY (`id_pais`) REFERENCES `dbo_pais` (`id_pais`);

--
-- Filtros para la tabla `dbo_lideres`
--
ALTER TABLE `dbo_lideres`
  ADD CONSTRAINT `FKdbo_lidere864469` FOREIGN KEY (`idPersona`) REFERENCES `dbo_personas` (`idPersona`);

--
-- Filtros para la tabla `dbo_lugaresvotacion`
--
ALTER TABLE `dbo_lugaresvotacion`
  ADD CONSTRAINT `FKlugaresVot295806` FOREIGN KEY (`idColonia`) REFERENCES `dbo_colonias` (`idColonia`),
  ADD CONSTRAINT `FKlugaresVot569331` FOREIGN KEY (`idEstado`) REFERENCES `dbo_estados` (`idEstado`),
  ADD CONSTRAINT `FKlugaresVot932466` FOREIGN KEY (`idMunicipio`) REFERENCES `dbo_municipios` (`idMunicipio`);

--
-- Filtros para la tabla `dbo_mesasvotacion`
--
ALTER TABLE `dbo_mesasvotacion`
  ADD CONSTRAINT `FKdbo_mesasV430896` FOREIGN KEY (`idCoordinador`) REFERENCES `dbo_coordinadores` (`idCoordinador`),
  ADD CONSTRAINT `FKdbo_mesasV759536` FOREIGN KEY (`idLugarVotacion`) REFERENCES `dbo_lugaresvotacion` (`idLugarVotacion`);

--
-- Filtros para la tabla `dbo_municipios`
--
ALTER TABLE `dbo_municipios`
  ADD CONSTRAINT `FKdbo_munici584428` FOREIGN KEY (`idEstado`) REFERENCES `dbo_estados` (`idEstado`);

--
-- Filtros para la tabla `dbo_personas`
--
ALTER TABLE `dbo_personas`
  ADD CONSTRAINT `FKdbo_person178426` FOREIGN KEY (`idPersonaEstadoApoyo`) REFERENCES `dbo_personas_estadosapoyo` (`idPersonaEstadoApoyo`),
  ADD CONSTRAINT `FKdbo_person265026` FOREIGN KEY (`idPersonaPoblacion`) REFERENCES `dbo_personas_poblaciones` (`idPersonaPoblacion`),
  ADD CONSTRAINT `FKdbo_person560499` FOREIGN KEY (`idLugarVotacion`) REFERENCES `dbo_lugaresvotacion` (`idLugarVotacion`),
  ADD CONSTRAINT `FKdbo_person642647` FOREIGN KEY (`idColonia`) REFERENCES `dbo_colonias` (`idColonia`),
  ADD CONSTRAINT `FKdbo_person708125` FOREIGN KEY (`idPersonaTipoSangre`) REFERENCES `dbo_personas_tipossangre` (`idPersonaTipoSangre`),
  ADD CONSTRAINT `FKdbo_person720691` FOREIGN KEY (`idMunicipio`) REFERENCES `dbo_municipios` (`idMunicipio`),
  ADD CONSTRAINT `FKdbo_person862570` FOREIGN KEY (`idPersonaOcupacion`) REFERENCES `dbo_personas_ocupaciones` (`idPersonaOcupacion`),
  ADD CONSTRAINT `FKdbo_person916172` FOREIGN KEY (`idEstado`) REFERENCES `dbo_estados` (`idEstado`),
  ADD CONSTRAINT `FKdbo_person922856` FOREIGN KEY (`idMesaVotacion`) REFERENCES `dbo_mesasvotacion` (`idMesaVotacion`),
  ADD CONSTRAINT `FKdbo_person989695` FOREIGN KEY (`idPersonaGradoAcademico`) REFERENCES `dbo_personas_gradosacademicos` (`idPersonaGradoAcademico`),
  ADD CONSTRAINT `dbo_personas_dbo_distrito_federal_FK` FOREIGN KEY (`id_distrito_federal`) REFERENCES `dbo_distrito_federal` (`id_distrito_federal`),
  ADD CONSTRAINT `dbo_personas_dbo_distrito_local_FK` FOREIGN KEY (`id_distrito_local`) REFERENCES `dbo_distrito_local` (`id_distrito_local`),
  ADD CONSTRAINT `dbo_personas_dbo_personas_generos_FK` FOREIGN KEY (`idPersonaGenero`) REFERENCES `dbo_personas_generos` (`idPersonaGenero`);

--
-- Filtros para la tabla `dbo_testigos`
--
ALTER TABLE `dbo_testigos`
  ADD CONSTRAINT `FKdbo_testig533522` FOREIGN KEY (`idCoordinador`) REFERENCES `dbo_coordinadores` (`idCoordinador`),
  ADD CONSTRAINT `FKdbo_testig721525` FOREIGN KEY (`idMesaVotacion`) REFERENCES `dbo_mesasvotacion` (`idMesaVotacion`),
  ADD CONSTRAINT `FKdbo_testig869483` FOREIGN KEY (`idPersona`) REFERENCES `dbo_personas` (`idPersona`);

--
-- Filtros para la tabla `dbo_usuarios`
--
ALTER TABLE `dbo_usuarios`
  ADD CONSTRAINT `FKdbo_usuari73264` FOREIGN KEY (`idPersona`) REFERENCES `dbo_personas` (`idPersona`),
  ADD CONSTRAINT `FKdbo_usuari776201` FOREIGN KEY (`idPartido`) REFERENCES `dbo_partidos` (`idPartido`),
  ADD CONSTRAINT `FKdbo_usuari776302` FOREIGN KEY (`idPerfil`) REFERENCES `dbo_login_perfiles` (`idPerfil`);

--
-- Filtros para la tabla `dbo_voluntarios`
--
ALTER TABLE `dbo_voluntarios`
  ADD CONSTRAINT `FKdbo_volunt311291` FOREIGN KEY (`idPersona`) REFERENCES `dbo_personas` (`idPersona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
