-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-01-2024 a las 07:58:38
-- Versión del servidor: 5.7.23-23
-- Versión de PHP: 8.1.26

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `q2ces_site`
--
CREATE DATABASE IF NOT EXISTS `q2ces_site` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `q2ces_site`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorios`
--

DROP TABLE IF EXISTS `accesorios`;
CREATE TABLE IF NOT EXISTS `accesorios` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `ano` varchar(255) DEFAULT NULL,
  `serie` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `maquinariaId` bigint(20) UNSIGNED NOT NULL,
  `marcaId` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_accesorios_maquinariaId` (`maquinariaId`),
  KEY `FK_accesorios_marcaId` (`marcaId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `accesorios`
--

INSERT INTO `accesorios` (`id`, `nombre`, `marca`, `modelo`, `color`, `ano`, `serie`, `foto`, `maquinariaId`, `marcaId`) VALUES
(1, 'Pallet', 'Bobcat', '48', NULL, '2020', '', NULL, 26, NULL),
(2, 'Barredora Recolectora', 'Bobcat', '60', NULL, '2020', '714436877', NULL, 26, NULL),
(3, 'Cuchilla', 'Bobcat', '5/8 X 8 X 74', NULL, NULL, '202417800000399', NULL, 26, NULL),
(4, 'Martillo Hidráulico Grande', 'Everdigm', 'EHB06BA', NULL, '2016', '06-H1054', NULL, 30, NULL),
(5, 'Martillo Hidráulico chico', 'Everdigm', '04-H300', NULL, '2015', 'EHB04HSLB', NULL, 31, NULL),
(6, 'Torre de Iluminación', 'Alfo', 'LINK240-1362', NULL, '2016', '1401911', NULL, 33, NULL),
(7, 'Pala', 'N/A', NULL, NULL, '2008', 'D34ES', NULL, 1, NULL),
(9, 'Odit molestias labor', NULL, 'Culpa consectetur', 'Sunt eu mollitia ob', '85', 'FUGIAT UT DICTA ET V', NULL, 25, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesoriosDocs`
--

DROP TABLE IF EXISTS `accesoriosDocs`;
CREATE TABLE IF NOT EXISTS `accesoriosDocs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `accesorioId` bigint(20) UNSIGNED NOT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `fechaVencimiento` date NOT NULL,
  `estatus` varchar(255) DEFAULT NULL,
  `comentarios` text,
  `tipoId` bigint(20) UNSIGNED DEFAULT NULL,
  `requerido` int(11) DEFAULT NULL,
  `vencimiento` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_accesoriosDocs_accesorioId` (`accesorioId`),
  KEY `FK_accesoriosDocs_tipoId` (`tipoId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `accesoriosDocs`
--

INSERT INTO `accesoriosDocs` (`id`, `accesorioId`, `ruta`, `tipo`, `fechaVencimiento`, `estatus`, `comentarios`, `tipoId`, `requerido`, `vencimiento`, `created_at`, `updated_at`) VALUES
(3, 9, '1696873237_1696530588_Ticket Q2ces.pdf', NULL, '0000-00-00', '0', 'Voluptatem dicta eum soluta incididunt et culpa ut duis amet adipisicing quaerat ut et', 32, 1, 1, '2023-10-09 11:39:13', '2023-10-09 11:40:37'),
(4, 1, '1696875603_FACTURAS DE ACCESORIOS PARA BOBCAT PALLET BARREDORA.pdf', NULL, '0000-00-00', '2', NULL, 32, 1, 1, '2023-10-09 12:12:56', '2023-10-09 12:20:03'),
(5, 2, '1696875238_FACTURAS DE ACCESORIOS PARA BOBCAT PALLET BARREDORA CUCHILLA-1-3.pdf', NULL, '0000-00-00', '0', NULL, 32, 1, 1, '2023-10-09 12:13:58', '2023-10-09 12:13:58'),
(6, 3, '1696876452_FACTURAS DE ACCESORIOS PARA BOBCAT CUCHILLA.pdf', NULL, '0000-00-00', '2', NULL, 32, 1, 0, '2023-10-09 12:34:12', '2023-10-09 12:34:12'),
(7, 4, '1696876586_FACTURA ACCESORIOS PARA RETROEXCAVADORA MARTILLO HIDRUALICO GRANDE.pdf', NULL, '0000-00-00', '2', NULL, 32, 1, 0, '2023-10-09 12:36:26', '2023-10-09 12:36:26'),
(8, 5, '1696876667_FACTURA ACCESORIOS MARTILLO HIDRAULICO CHICO 04H300.pdf', NULL, '0000-00-00', '2', NULL, 32, 1, 0, '2023-10-09 12:37:47', '2023-10-09 12:37:47'),
(9, 6, '1696876798_FACTURA LUZ-02 LIGHTING TOWER TORRE DE ILUMINACIÓN 1405465.pdf', NULL, '0000-00-00', '0', NULL, 32, 1, 1, '2023-10-09 12:39:58', '2023-10-09 12:39:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

DROP TABLE IF EXISTS `actividades`;
CREATE TABLE IF NOT EXISTS `actividades` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `personalId` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `prioridad` varchar(255) NOT NULL,
  `estadoId` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_actividades_userId` (`userId`),
  KEY `FK_actividades_personalId` (`personalId`),
  KEY `FK_actividades_estadoId` (`estadoId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `userId`, `personalId`, `title`, `start`, `end`, `prioridad`, `estadoId`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 5, 9, 'Test', NULL, NULL, 'Necesaria', 1, 'Quia ratione volupta', '2023-09-07 16:22:12', '2023-09-07 16:22:12'),
(2, 4, 2, 'Limpiar Bote', NULL, NULL, 'Urgente', 1, NULL, '2023-09-08 18:15:56', '2023-09-08 18:15:56'),
(3, 5, 9, 'Test de tarea', '2023-08-27 23:14:00', NULL, 'Deseable', 1, 'Minima accusamus sus', '2023-09-11 16:56:41', '2023-09-11 16:56:41'),
(4, 5, 9, 'Test de tarea', '2023-08-27 23:14:00', NULL, 'Deseable', 1, 'Minima accusamus sus', '2023-09-11 17:00:25', '2023-09-11 17:00:25'),
(5, 5, 1, 'Test 2', '2023-08-21 21:05:00', NULL, 'Urgente', 1, NULL, '2023-09-11 17:04:19', '2023-09-11 17:04:19'),
(6, 3, 2, 'Lavar bote', '2023-09-12 08:15:00', NULL, 'Urgente', 1, NULL, '2023-09-12 10:03:04', '2023-09-12 10:03:04'),
(7, 2, 1, 'Prueba de revisión', '2023-09-13 09:00:00', NULL, 'Necesaria', 1, 'Prueba de revisión y colores', '2023-09-13 08:08:19', '2023-09-13 08:08:19'),
(8, 2, 1, 'MORELOS - Prueba de tarea', '2023-09-11 17:05:00', NULL, 'Urgente', 1, 'Pruebas de alta de tareas', '2023-09-15 17:05:53', '2023-09-15 17:05:53'),
(9, 35, 14, 'Colado segundo piso oficina taller Q2CES', '2023-10-14 08:00:00', NULL, 'Necesaria', 1, NULL, '2023-10-14 09:14:05', '2023-10-14 09:14:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ajustesCisternas`
--

DROP TABLE IF EXISTS `ajustesCisternas`;
CREATE TABLE IF NOT EXISTS `ajustesCisternas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipoCisternaId` bigint(20) UNSIGNED NOT NULL,
  `contenidoTeorico` float(100,2) DEFAULT NULL,
  `contenidoReal` float(100,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ajustesCisternas_tipoCisternaId` (`tipoCisternaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenServicios`
--

DROP TABLE IF EXISTS `almacenServicios`;
CREATE TABLE IF NOT EXISTS `almacenServicios` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `almacenId` bigint(20) UNSIGNED DEFAULT NULL,
  `conceptoId` bigint(20) UNSIGNED NOT NULL,
  `precio` float(10,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_almacenServicios_concepto` (`conceptoId`),
  KEY `FK_almacenServicios_almacentiraderos` (`almacenId`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `almacenServicios`
--

INSERT INTO `almacenServicios` (`id`, `almacenId`, `conceptoId`, `precio`, `created_at`, `updated_at`) VALUES
(17, 1, 19, 260.00, '2024-01-02 12:01:44', '2024-01-02 12:01:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenTiraderos`
--

DROP TABLE IF EXISTS `almacenTiraderos`;
CREATE TABLE IF NOT EXISTS `almacenTiraderos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `tipoAlmacenId` bigint(20) UNSIGNED NOT NULL,
  `comentario` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_almacenTiraderos_tipoAlmacenId` (`tipoAlmacenId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `almacenTiraderos`
--

INSERT INTO `almacenTiraderos` (`id`, `nombre`, `tipoAlmacenId`, `comentario`, `created_at`, `updated_at`) VALUES
(1, 'Copalita', 1, 'Copalita', '2023-10-30 14:44:44', '2023-12-18 16:46:06'),
(2, 'Triangulo', 1, 'Triangulo', '2024-01-02 18:04:28', '2024-01-02 18:04:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacionEquipo`
--

DROP TABLE IF EXISTS `asignacionEquipo`;
CREATE TABLE IF NOT EXISTS `asignacionEquipo` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `personalId` bigint(20) UNSIGNED NOT NULL,
  `equipoId` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `marcaId` bigint(20) UNSIGNED NOT NULL,
  `serial` varchar(200) DEFAULT NULL,
  `comentario` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_asignacionEquipo_personalId` (`personalId`),
  KEY `FK_asignacionEquipo_equipoId` (`equipoId`),
  KEY `FK_asignacionEquipo_marcaId` (`marcaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacionUniforme`
--

DROP TABLE IF EXISTS `asignacionUniforme`;
CREATE TABLE IF NOT EXISTS `asignacionUniforme` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `personalId` bigint(20) UNSIGNED NOT NULL,
  `inventarioId` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `comentario` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_asignacionUniforme_personalId` (`personalId`),
  KEY `FK_asignacionUniforme_inventarioId` (`inventarioId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asignacionUniforme`
--

INSERT INTO `asignacionUniforme` (`id`, `personalId`, `inventarioId`, `cantidad`, `comentario`, `created_at`, `updated_at`) VALUES
(1, 27, 62, 1, NULL, '2024-01-03 17:38:28', '2024-01-03 17:38:28'),
(2, 27, 61, 1, NULL, '2024-01-03 17:38:28', '2024-01-03 17:38:28'),
(3, 27, 45, 1, NULL, '2024-01-03 17:38:28', '2024-01-03 17:38:28'),
(4, 27, 51, 2, NULL, '2024-01-03 17:38:29', '2024-01-03 17:38:29'),
(5, 7, 62, 1, NULL, '2024-01-04 16:25:43', '2024-01-04 16:25:43'),
(6, 7, 53, 1, NULL, '2024-01-04 16:25:43', '2024-01-04 16:25:43'),
(7, 7, 68, 1, NULL, '2024-01-04 16:25:43', '2024-01-04 16:25:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE IF NOT EXISTS `asistencia` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `personalId` bigint(20) UNSIGNED NOT NULL,
  `asistenciaId` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `horasExtra` int(11) DEFAULT NULL,
  `totalHorasExtra` int(11) DEFAULT '0',
  `horasAnticipada` int(11) DEFAULT NULL,
  `horasRetraso` int(11) DEFAULT NULL,
  `comentario` text,
  `hEntrada` time DEFAULT NULL,
  `hSalida` time DEFAULT NULL,
  `entradaAnticipada` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_asistencia_personalId` (`personalId`),
  KEY `FK_asistencia_asistenciaId` (`asistenciaId`)
) ENGINE=InnoDB AUTO_INCREMENT=967 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `personalId`, `asistenciaId`, `fecha`, `horasExtra`, `totalHorasExtra`, `horasAnticipada`, `horasRetraso`, `comentario`, `hEntrada`, `hSalida`, `entradaAnticipada`, `created_at`, `updated_at`) VALUES
(8, 2, 1, '2023-08-28', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-28 10:21:58', '2023-08-28 17:40:43'),
(9, 2, 1, '2023-08-29', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-29 08:46:21', '2023-08-29 08:46:44'),
(10, 12, 1, '2023-08-31', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-31 13:01:14', '2023-09-03 08:29:17'),
(11, 8, 1, '2023-08-31', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-31 13:01:14', '2023-08-31 13:01:14'),
(12, 13, 1, '2023-08-31', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-31 13:01:14', '2023-08-31 13:01:14'),
(13, 9, 1, '2023-08-31', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-31 13:01:14', '2023-08-31 13:01:14'),
(14, 11, 1, '2023-08-31', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-31 13:01:14', '2023-08-31 13:01:14'),
(15, 7, 1, '2023-08-31', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-31 13:01:14', '2023-08-31 13:01:14'),
(16, 10, 1, '2023-08-31', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-31 13:01:14', '2023-08-31 13:01:14'),
(17, 2, 1, '2023-08-31', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-31 13:01:14', '2023-08-31 13:01:14'),
(18, 5, 1, '2023-08-31', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-31 13:01:14', '2023-08-31 13:01:14'),
(19, 3, 1, '2023-08-31', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-31 13:01:14', '2023-08-31 13:01:14'),
(20, 12, 1, '2023-09-05', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-05 08:38:00', '2023-09-05 08:41:46'),
(21, 8, 1, '2023-09-05', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-05 08:38:00', '2023-09-05 08:38:00'),
(22, 13, 1, '2023-09-05', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-05 08:38:00', '2023-09-05 08:38:00'),
(23, 9, 1, '2023-09-05', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-05 08:38:00', '2023-09-05 08:38:00'),
(24, 11, 1, '2023-09-05', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-05 08:38:00', '2023-09-05 08:38:00'),
(25, 7, 1, '2023-09-05', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-05 08:38:00', '2023-09-05 08:38:00'),
(26, 10, 1, '2023-09-05', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-05 08:38:00', '2023-09-05 08:38:00'),
(27, 2, 1, '2023-09-05', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-05 08:38:00', '2023-09-05 08:38:00'),
(28, 5, 1, '2023-09-05', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-05 08:38:00', '2023-09-05 08:38:00'),
(29, 3, 1, '2023-09-05', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-05 08:38:00', '2023-09-05 08:38:00'),
(30, 12, 1, '2023-09-07', 0, 0, NULL, NULL, NULL, '08:00:00', '22:15:00', NULL, '2023-09-07 09:38:59', '2023-09-08 21:15:39'),
(31, 8, 1, '2023-09-07', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-07 09:38:59', '2023-09-07 09:38:59'),
(32, 13, 1, '2023-09-07', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-07 09:38:59', '2023-09-07 09:38:59'),
(33, 9, 3, '2023-09-07', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-07 09:38:59', '2023-09-07 09:38:59'),
(34, 15, 2, '2023-09-07', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-07 09:38:59', '2023-09-07 09:38:59'),
(35, 11, 1, '2023-09-07', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-07 09:38:59', '2023-09-07 09:38:59'),
(36, 7, 1, '2023-09-07', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-07 09:38:59', '2023-09-07 09:38:59'),
(37, 10, 2, '2023-09-07', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-07 09:38:59', '2023-09-07 09:38:59'),
(38, 17, 1, '2023-09-07', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-07 09:38:59', '2023-09-07 09:38:59'),
(39, 5, 1, '2023-09-07', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-07 09:38:59', '2023-09-07 09:38:59'),
(40, 2, 3, '2023-09-07', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-07 09:38:59', '2023-09-07 09:38:59'),
(41, 3, 1, '2023-09-07', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-07 09:38:59', '2023-09-07 09:38:59'),
(42, 12, 1, '2023-09-08', 1, 0, NULL, NULL, NULL, '08:07:00', '19:07:00', NULL, '2023-09-08 21:08:27', '2023-09-08 21:25:57'),
(43, 17, 1, '2023-09-08', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-08 21:08:27', '2023-09-12 10:15:23'),
(44, 2, 1, '2023-09-08', 21, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-08 21:08:27', '2023-09-08 21:25:57'),
(45, 5, 1, '2023-09-08', 21, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-08 21:08:27', '2023-09-08 21:25:57'),
(46, 3, 1, '2023-09-08', 19, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-08 21:08:27', '2023-09-08 21:25:57'),
(47, 12, 1, '2023-09-12', 283, 0, NULL, NULL, NULL, '07:00:00', '18:00:00', NULL, '2023-09-12 09:43:27', '2023-09-12 10:24:11'),
(48, 17, 1, '2023-09-12', 78, 0, NULL, NULL, NULL, '08:14:00', '19:18:00', NULL, '2023-09-12 09:43:27', '2023-09-12 10:24:11'),
(49, 2, 1, '2023-09-12', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-12 09:43:27', '2023-09-12 09:43:27'),
(50, 5, 1, '2023-09-12', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-12 09:43:27', '2023-09-12 09:43:27'),
(51, 3, 1, '2023-09-12', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-12 09:43:27', '2023-09-12 09:43:27'),
(52, 12, 1, '2023-09-15', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-09-15 08:56:19', '2023-09-15 08:56:19'),
(53, 8, 1, '2023-09-15', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-09-15 08:56:19', '2023-09-15 08:56:19'),
(54, 13, 1, '2023-09-15', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-09-15 08:56:19', '2023-09-15 08:56:19'),
(55, 9, 1, '2023-09-15', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-09-15 08:56:19', '2023-09-15 08:56:19'),
(56, 11, 1, '2023-09-15', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-09-15 08:56:19', '2023-09-15 08:56:19'),
(57, 7, 1, '2023-09-15', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-09-15 08:56:19', '2023-09-15 08:56:19'),
(58, 10, 1, '2023-09-15', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-09-15 08:56:19', '2023-09-15 08:56:19'),
(59, 17, 1, '2023-09-15', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-09-15 08:56:19', '2023-09-15 08:56:19'),
(60, 2, 1, '2023-09-15', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-15 08:56:19', '2023-09-15 08:56:19'),
(61, 5, 1, '2023-09-15', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-09-15 08:56:19', '2023-09-15 08:56:19'),
(62, 3, 1, '2023-09-15', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-09-15 08:56:19', '2023-09-15 08:56:19'),
(63, 12, 1, '2023-09-19', 60, 0, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-09-19 08:57:07', '2023-09-19 08:57:49'),
(64, 8, 1, '2023-09-19', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-09-19 08:57:07', '2023-09-19 08:57:49'),
(65, 13, 1, '2023-09-19', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-09-19 08:57:07', '2023-09-19 08:57:49'),
(66, 9, 1, '2023-09-19', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-09-19 08:57:07', '2023-09-19 08:57:49'),
(67, 11, 1, '2023-09-19', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-09-19 08:57:07', '2023-09-19 08:57:49'),
(68, 7, 1, '2023-09-19', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-09-19 08:57:07', '2023-09-19 08:57:49'),
(69, 10, 1, '2023-09-19', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-09-19 08:57:07', '2023-09-19 08:57:49'),
(70, 17, 1, '2023-09-19', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-09-19 08:57:07', '2023-09-19 08:57:49'),
(71, 2, 1, '2023-09-19', 0, 0, 0, 0, NULL, NULL, NULL, 0, '2023-09-19 08:57:07', '2023-09-19 08:57:49'),
(72, 5, 1, '2023-09-19', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-09-19 08:57:07', '2023-09-19 08:57:49'),
(73, 3, 1, '2023-09-19', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-09-19 08:57:07', '2023-09-19 08:57:49'),
(74, 12, 1, '2023-10-11', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-11 18:27:27', '2023-10-12 10:34:06'),
(75, 8, 1, '2023-10-11', 60, 0, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-10-11 18:27:27', '2023-10-12 10:34:06'),
(76, 19, 1, '2023-10-11', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-11 18:27:27', '2023-10-12 10:34:06'),
(77, 9, 1, '2023-10-11', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-11 18:27:27', '2023-10-12 10:34:06'),
(78, 11, 1, '2023-10-11', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-11 18:27:27', '2023-10-12 10:34:06'),
(79, 7, 1, '2023-10-11', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-11 18:27:27', '2023-10-12 10:34:06'),
(80, 20, 1, '2023-10-11', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-11 18:27:27', '2023-10-12 10:34:06'),
(81, 21, 1, '2023-10-11', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-11 18:27:27', '2023-10-12 10:34:06'),
(82, 22, 1, '2023-10-11', 60, 0, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-10-11 18:27:27', '2023-10-12 10:34:06'),
(83, 10, 1, '2023-10-11', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-11 18:27:27', '2023-10-12 10:34:06'),
(84, 18, 1, '2023-10-11', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-11 18:27:27', '2023-10-13 12:46:07'),
(85, 5, 1, '2023-10-11', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-11 18:27:27', '2023-10-12 10:34:06'),
(86, 14, 1, '2023-10-11', 60, 0, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-10-11 18:27:27', '2023-10-16 12:54:30'),
(87, 3, 1, '2023-10-11', 150, 0, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2023-10-11 18:27:27', '2023-10-16 12:55:14'),
(88, 12, 1, '2023-10-12', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 09:59:02', '2023-10-13 11:19:20'),
(89, 8, 1, '2023-10-12', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 09:59:02', '2023-10-13 11:19:20'),
(90, 19, 1, '2023-10-12', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 09:59:02', '2023-10-13 11:19:20'),
(91, 9, 1, '2023-10-12', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 09:59:02', '2023-10-13 11:19:20'),
(92, 11, 1, '2023-10-12', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 09:59:02', '2023-10-13 11:19:20'),
(93, 7, 1, '2023-10-12', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 09:59:02', '2023-10-13 11:19:20'),
(94, 20, 1, '2023-10-12', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 09:59:02', '2023-10-13 11:19:20'),
(95, 21, 1, '2023-10-12', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 09:59:02', '2023-10-13 11:19:20'),
(96, 22, 1, '2023-10-12', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 09:59:02', '2023-10-13 11:19:20'),
(97, 10, 1, '2023-10-12', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 09:59:02', '2023-10-13 11:19:20'),
(98, 18, 1, '2023-10-12', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 09:59:02', '2023-10-13 12:46:07'),
(99, 5, 1, '2023-10-12', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 09:59:02', '2023-10-13 11:19:20'),
(100, 14, 1, '2023-10-12', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 09:59:02', '2023-10-16 12:54:30'),
(101, 3, 1, '2023-10-12', 135, 0, 0, 0, NULL, '08:00:00', '20:15:00', 0, '2023-10-13 09:59:02', '2023-10-16 12:55:14'),
(102, 12, 1, '2023-10-13', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 10:22:04', '2023-10-16 12:53:43'),
(103, 8, 1, '2023-10-13', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 10:22:04', '2023-10-16 12:53:43'),
(104, 19, 1, '2023-10-13', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 10:22:04', '2023-10-16 12:53:43'),
(105, 9, 1, '2023-10-13', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 10:22:04', '2023-10-16 12:53:43'),
(106, 11, 1, '2023-10-13', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 10:22:04', '2023-10-16 12:53:43'),
(107, 7, 1, '2023-10-13', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 10:22:04', '2023-10-16 12:53:43'),
(108, 20, 1, '2023-10-13', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 10:22:04', '2023-10-16 12:53:43'),
(109, 21, 1, '2023-10-13', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 10:22:04', '2023-10-16 12:53:43'),
(110, 22, 1, '2023-10-13', 60, 0, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-10-13 10:22:04', '2023-10-16 12:53:43'),
(111, 10, 1, '2023-10-13', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 10:22:04', '2023-10-16 12:53:43'),
(112, 18, 2, '2023-10-13', 0, 0, 0, 293, NULL, NULL, NULL, 0, '2023-10-13 10:22:04', '2023-10-16 12:53:43'),
(113, 5, 1, '2023-10-13', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-13 10:22:04', '2023-10-16 12:53:43'),
(114, 14, 1, '2023-10-13', 60, 0, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-10-13 10:22:04', '2023-10-16 12:54:30'),
(115, 3, 1, '2023-10-13', 180, 0, 0, 0, NULL, '08:00:00', '21:00:00', 0, '2023-10-13 10:22:04', '2023-10-16 12:55:14'),
(116, 12, 1, '2023-10-14', 0, 0, NULL, NULL, NULL, '08:00:00', '13:00:00', NULL, '2023-10-16 12:53:16', '2023-10-16 12:53:16'),
(117, 8, 1, '2023-10-14', 0, 0, NULL, NULL, NULL, '08:00:00', '13:00:00', NULL, '2023-10-16 12:53:16', '2023-10-16 12:53:16'),
(118, 19, 1, '2023-10-14', 0, 0, NULL, NULL, NULL, '08:00:00', '13:00:00', NULL, '2023-10-16 12:53:16', '2023-10-16 12:53:16'),
(119, 9, 1, '2023-10-14', 0, 0, NULL, NULL, NULL, '08:00:00', '13:00:00', NULL, '2023-10-16 12:53:16', '2023-10-16 12:53:16'),
(120, 11, 1, '2023-10-14', 0, 0, NULL, NULL, NULL, '08:00:00', '13:00:00', NULL, '2023-10-16 12:53:16', '2023-10-16 12:53:16'),
(121, 7, 1, '2023-10-14', 0, 0, NULL, NULL, NULL, '08:00:00', '13:00:00', NULL, '2023-10-16 12:53:16', '2023-10-16 12:53:16'),
(122, 20, 1, '2023-10-14', 0, 0, NULL, NULL, NULL, '08:00:00', '13:00:00', NULL, '2023-10-16 12:53:16', '2023-10-16 12:53:16'),
(123, 21, 1, '2023-10-14', 0, 0, NULL, NULL, NULL, '08:00:00', '13:00:00', NULL, '2023-10-16 12:53:16', '2023-10-16 12:53:16'),
(124, 22, 1, '2023-10-14', 0, 0, NULL, NULL, NULL, '08:00:00', '13:00:00', NULL, '2023-10-16 12:53:16', '2023-10-16 12:53:16'),
(125, 10, 1, '2023-10-14', 0, 0, NULL, NULL, NULL, '08:00:00', '13:00:00', NULL, '2023-10-16 12:53:16', '2023-10-16 12:53:16'),
(126, 18, 1, '2023-10-14', 0, 0, NULL, NULL, NULL, '08:00:00', '13:00:00', NULL, '2023-10-16 12:53:16', '2023-10-16 12:53:16'),
(127, 5, 1, '2023-10-14', 0, 0, NULL, NULL, NULL, '08:00:00', '13:00:00', NULL, '2023-10-16 12:53:16', '2023-10-16 12:53:16'),
(128, 14, 1, '2023-10-14', 180, 0, NULL, 0, NULL, '08:00:00', '16:00:00', NULL, '2023-10-16 12:53:16', '2023-10-16 12:54:30'),
(129, 3, 1, '2023-10-14', 90, 0, NULL, 0, NULL, '08:00:00', '14:30:00', NULL, '2023-10-16 12:53:16', '2023-10-16 12:55:14'),
(130, 12, 1, '2023-10-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-16 12:55:29', '2023-10-16 17:50:14'),
(131, 8, 1, '2023-10-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-16 12:55:29', '2023-10-16 17:50:14'),
(132, 19, 1, '2023-10-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-16 12:55:29', '2023-10-16 17:50:14'),
(133, 9, 1, '2023-10-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-16 12:55:29', '2023-10-16 17:50:14'),
(134, 11, 1, '2023-10-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-16 12:55:29', '2023-10-16 17:50:14'),
(135, 7, 1, '2023-10-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-16 12:55:29', '2023-10-16 17:50:14'),
(136, 20, 2, '2023-10-16', 0, 0, 0, 0, NULL, NULL, NULL, 0, '2023-10-16 12:55:29', '2023-10-16 17:50:14'),
(137, 21, 1, '2023-10-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-16 12:55:29', '2023-10-16 17:50:14'),
(138, 22, 1, '2023-10-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-16 12:55:29', '2023-10-16 17:50:14'),
(139, 10, 1, '2023-10-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-16 12:55:29', '2023-10-16 17:50:14'),
(140, 18, 2, '2023-10-16', 0, 0, 0, 0, NULL, NULL, NULL, 0, '2023-10-16 12:55:29', '2023-10-16 17:50:14'),
(141, 5, 1, '2023-10-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-16 12:55:29', '2023-10-16 17:50:14'),
(142, 14, 1, '2023-10-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-16 12:55:29', '2023-10-16 17:50:14'),
(143, 3, 1, '2023-10-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-16 12:55:29', '2023-10-16 17:50:14'),
(144, 12, 1, '2023-10-17', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:08:46', '2023-10-18 10:08:46'),
(145, 8, 1, '2023-10-17', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:08:46', '2023-10-18 10:08:46'),
(146, 19, 1, '2023-10-17', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:08:46', '2023-10-18 10:08:46'),
(147, 9, 1, '2023-10-17', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:08:46', '2023-10-18 10:08:46'),
(148, 11, 1, '2023-10-17', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:08:46', '2023-10-18 10:08:46'),
(149, 7, 1, '2023-10-17', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:08:46', '2023-10-18 10:08:46'),
(150, 20, 1, '2023-10-17', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:08:46', '2023-10-18 10:08:46'),
(151, 21, 1, '2023-10-17', 0, 0, NULL, NULL, NULL, '08:00:00', '19:30:00', NULL, '2023-10-18 10:08:46', '2023-10-18 10:08:46'),
(152, 22, 1, '2023-10-17', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:08:46', '2023-10-18 10:08:46'),
(153, 10, 1, '2023-10-17', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:08:46', '2023-10-18 10:08:46'),
(154, 5, 1, '2023-10-17', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:08:46', '2023-10-18 10:08:46'),
(155, 14, 1, '2023-10-17', 0, 0, NULL, NULL, NULL, '08:00:00', '19:30:00', NULL, '2023-10-18 10:08:46', '2023-10-18 10:08:46'),
(156, 3, 1, '2023-10-17', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:08:46', '2023-10-18 10:08:46'),
(157, 12, 1, '2023-10-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:17:11', '2023-10-18 10:17:11'),
(158, 8, 1, '2023-10-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:17:11', '2023-10-18 10:17:11'),
(159, 19, 1, '2023-10-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:17:11', '2023-10-18 10:17:11'),
(160, 9, 1, '2023-10-18', 0, 0, NULL, NULL, NULL, '08:40:00', NULL, NULL, '2023-10-18 10:17:11', '2023-10-18 10:17:11'),
(161, 11, 1, '2023-10-18', 60, 0, NULL, 0, NULL, '08:00:00', '19:00:00', NULL, '2023-10-18 10:17:11', '2023-10-24 11:44:14'),
(162, 7, 1, '2023-10-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:17:11', '2023-10-18 10:17:11'),
(163, 20, 1, '2023-10-18', 0, 0, NULL, NULL, NULL, '08:30:00', NULL, NULL, '2023-10-18 10:17:11', '2023-10-18 10:17:11'),
(164, 21, 1, '2023-10-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:17:11', '2023-10-18 10:17:11'),
(165, 22, 1, '2023-10-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:17:11', '2023-10-18 10:17:11'),
(166, 10, 1, '2023-10-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:17:11', '2023-10-18 10:17:11'),
(167, 5, 1, '2023-10-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:17:11', '2023-10-18 10:17:11'),
(168, 14, 1, '2023-10-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-18 10:17:11', '2023-10-18 10:17:11'),
(169, 3, 1, '2023-10-18', 120, 0, NULL, 0, NULL, '08:00:00', '20:00:00', NULL, '2023-10-18 10:17:11', '2023-10-24 18:24:18'),
(170, 12, 1, '2023-10-19', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-19 17:51:35', '2023-10-19 17:51:35'),
(171, 8, 1, '2023-10-19', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-19 17:51:35', '2023-10-19 17:51:35'),
(172, 19, 1, '2023-10-19', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-19 17:51:35', '2023-10-19 17:51:35'),
(173, 9, 1, '2023-10-19', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-19 17:51:35', '2023-10-19 17:51:35'),
(174, 11, 1, '2023-10-19', 60, 0, NULL, 0, NULL, '08:00:00', '19:00:00', NULL, '2023-10-19 17:51:35', '2023-10-24 11:44:14'),
(175, 7, 1, '2023-10-19', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-19 17:51:35', '2023-10-19 17:51:35'),
(176, 20, 1, '2023-10-19', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-19 17:51:35', '2023-10-19 17:51:35'),
(177, 21, 1, '2023-10-19', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-19 17:51:35', '2023-10-19 17:51:35'),
(178, 22, 1, '2023-10-19', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-19 17:51:35', '2023-10-19 17:51:35'),
(179, 10, 1, '2023-10-19', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-19 17:51:35', '2023-10-19 17:51:35'),
(180, 5, 1, '2023-10-19', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-19 17:51:35', '2023-10-19 17:51:35'),
(181, 14, 1, '2023-10-19', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-19 17:51:35', '2023-10-19 17:51:35'),
(182, 3, 1, '2023-10-19', 120, 0, NULL, 0, NULL, '08:00:00', '20:00:00', NULL, '2023-10-19 17:51:35', '2023-10-24 18:24:18'),
(183, 12, 1, '2023-10-20', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-21 08:22:29', '2023-10-21 08:22:29'),
(184, 8, 1, '2023-10-20', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-21 08:22:29', '2023-10-21 08:22:29'),
(185, 19, 1, '2023-10-20', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-21 08:22:29', '2023-10-21 08:22:29'),
(186, 9, 1, '2023-10-20', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-21 08:22:29', '2023-10-21 08:22:29'),
(187, 11, 1, '2023-10-20', 60, 0, NULL, 0, NULL, '08:00:00', '19:00:00', NULL, '2023-10-21 08:22:29', '2023-10-24 11:44:14'),
(188, 7, 1, '2023-10-20', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-21 08:22:29', '2023-10-21 08:22:29'),
(189, 20, 1, '2023-10-20', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-21 08:22:29', '2023-10-21 08:22:29'),
(190, 21, 1, '2023-10-20', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-21 08:22:29', '2023-10-21 08:22:29'),
(191, 22, 1, '2023-10-20', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-21 08:22:29', '2023-10-21 08:22:29'),
(192, 10, 1, '2023-10-20', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-21 08:22:29', '2023-10-21 08:22:29'),
(193, 5, 1, '2023-10-20', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-21 08:22:29', '2023-10-21 08:22:29'),
(194, 14, 1, '2023-10-20', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-21 08:22:29', '2023-10-21 08:22:29'),
(195, 3, 1, '2023-10-20', 120, 0, NULL, 0, NULL, '08:00:00', '20:00:00', NULL, '2023-10-21 08:22:29', '2023-10-24 18:24:18'),
(196, 12, 1, '2023-10-21', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-23 08:01:40', '2023-10-23 08:01:40'),
(197, 8, 1, '2023-10-21', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-23 08:01:40', '2023-10-23 08:01:40'),
(198, 19, 1, '2023-10-21', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-23 08:01:40', '2023-10-23 08:01:40'),
(199, 9, 1, '2023-10-21', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-23 08:01:40', '2023-10-23 08:01:40'),
(200, 11, 1, '2023-10-21', 0, 0, NULL, 0, NULL, '08:00:00', NULL, NULL, '2023-10-23 08:01:40', '2023-10-24 11:44:14'),
(201, 7, 1, '2023-10-21', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-23 08:01:40', '2023-10-23 08:01:40'),
(202, 20, 1, '2023-10-21', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-23 08:01:40', '2023-10-23 08:01:40'),
(203, 21, 1, '2023-10-21', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-23 08:01:40', '2023-10-23 08:01:40'),
(204, 22, 1, '2023-10-21', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-23 08:01:40', '2023-10-23 08:01:40'),
(205, 10, 1, '2023-10-21', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-23 08:01:40', '2023-10-23 08:01:40'),
(206, 5, 1, '2023-10-21', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-23 08:01:40', '2023-10-23 08:01:40'),
(207, 14, 1, '2023-10-21', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-23 08:01:40', '2023-10-23 08:01:40'),
(208, 3, 1, '2023-10-21', 120, 0, NULL, 0, NULL, '08:00:00', '15:00:00', NULL, '2023-10-23 08:01:40', '2023-10-24 18:24:18'),
(209, 12, 1, '2023-10-23', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 11:36:14', '2023-10-24 11:36:14'),
(210, 8, 1, '2023-10-23', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 11:36:14', '2023-10-24 11:36:14'),
(211, 19, 1, '2023-10-23', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 11:36:14', '2023-10-24 11:36:14'),
(212, 9, 1, '2023-10-23', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 11:36:14', '2023-10-24 11:36:14'),
(213, 11, 1, '2023-10-23', 60, 0, NULL, 0, NULL, '08:00:00', '19:00:00', NULL, '2023-10-24 11:36:14', '2023-10-24 11:44:14'),
(214, 7, 1, '2023-10-23', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 11:36:14', '2023-10-24 11:36:14'),
(215, 20, 1, '2023-10-23', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 11:36:14', '2023-10-24 11:36:14'),
(216, 21, 1, '2023-10-23', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 11:36:14', '2023-10-24 11:36:14'),
(217, 22, 1, '2023-10-23', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 11:36:14', '2023-10-24 11:36:14'),
(218, 10, 1, '2023-10-23', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 11:36:14', '2023-10-24 11:36:14'),
(219, 5, 1, '2023-10-23', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 11:36:14', '2023-10-24 11:36:14'),
(220, 14, 1, '2023-10-23', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 11:36:14', '2023-10-24 11:36:14'),
(221, 3, 1, '2023-10-23', 120, 0, NULL, 0, NULL, '08:00:00', '20:00:00', NULL, '2023-10-24 11:36:14', '2023-10-24 18:24:18'),
(222, 12, 1, '2023-10-24', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 18:04:10', '2023-10-24 18:04:10'),
(223, 8, 1, '2023-10-24', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 18:04:10', '2023-10-24 18:04:10'),
(224, 19, 1, '2023-10-24', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 18:04:10', '2023-10-24 18:04:10'),
(225, 9, 1, '2023-10-24', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 18:04:10', '2023-10-24 18:04:10'),
(226, 11, 1, '2023-10-24', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 18:04:10', '2023-10-24 18:04:10'),
(227, 7, 1, '2023-10-24', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 18:04:10', '2023-10-24 18:04:10'),
(228, 20, 1, '2023-10-24', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 18:04:10', '2023-10-24 18:04:10'),
(229, 21, 1, '2023-10-24', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 18:04:10', '2023-10-24 18:04:10'),
(230, 22, 1, '2023-10-24', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 18:04:10', '2023-10-24 18:04:10'),
(231, 10, 1, '2023-10-24', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 18:04:10', '2023-10-24 18:04:10'),
(232, 5, 1, '2023-10-24', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 18:04:10', '2023-10-24 18:04:10'),
(233, 14, 1, '2023-10-24', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-24 18:04:10', '2023-10-24 18:04:10'),
(234, 3, 1, '2023-10-24', 120, 0, NULL, 0, NULL, '08:00:00', '20:00:00', NULL, '2023-10-24 18:04:10', '2023-10-24 18:24:18'),
(235, 12, 2, '2023-10-26', 0, 0, 0, 0, NULL, NULL, NULL, 0, '2023-10-26 10:50:12', '2023-11-01 08:28:37'),
(236, 8, 1, '2023-10-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-26 10:50:12', '2023-11-01 08:28:37'),
(237, 19, 1, '2023-10-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-26 10:50:12', '2023-11-01 08:28:37'),
(238, 9, 1, '2023-10-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-26 10:50:12', '2023-11-01 08:28:37'),
(239, 11, 1, '2023-10-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-26 10:50:12', '2023-11-01 08:28:37'),
(240, 7, 1, '2023-10-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-26 10:50:12', '2023-11-01 08:28:37'),
(241, 20, 1, '2023-10-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-26 10:50:12', '2023-11-01 08:28:37'),
(242, 21, 1, '2023-10-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-26 10:50:12', '2023-11-01 08:28:37'),
(243, 22, 1, '2023-10-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-26 10:50:12', '2023-11-01 08:28:37'),
(244, 10, 1, '2023-10-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-26 10:50:12', '2023-11-01 08:28:37'),
(245, 5, 1, '2023-10-26', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-26 10:50:12', '2023-10-26 10:50:12'),
(246, 14, 1, '2023-10-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-26 10:50:12', '2023-11-01 08:28:37'),
(247, 3, 1, '2023-10-26', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2023-10-26 10:50:12', '2023-11-01 08:28:37'),
(248, 12, 1, '2023-10-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-27 08:55:06', '2023-11-01 08:28:10'),
(249, 8, 1, '2023-10-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-27 08:55:06', '2023-11-01 08:28:10'),
(250, 19, 1, '2023-10-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-27 08:55:06', '2023-11-01 08:28:10'),
(251, 9, 2, '2023-10-27', 0, 0, 0, 0, NULL, NULL, NULL, 0, '2023-10-27 08:55:06', '2023-11-01 08:28:10'),
(252, 11, 1, '2023-10-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-27 08:55:06', '2023-11-01 08:28:10'),
(253, 7, 1, '2023-10-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-27 08:55:06', '2023-11-01 08:28:10'),
(254, 20, 1, '2023-10-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-27 08:55:06', '2023-11-01 08:28:10'),
(255, 21, 1, '2023-10-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-27 08:55:06', '2023-11-01 08:28:10'),
(256, 22, 1, '2023-10-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-27 08:55:06', '2023-11-01 08:28:10'),
(257, 10, 1, '2023-10-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-27 08:55:06', '2023-11-01 08:28:10'),
(258, 5, 2, '2023-10-27', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-27 08:55:06', '2023-10-27 08:55:06'),
(259, 14, 1, '2023-10-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-27 08:55:06', '2023-11-01 08:28:10'),
(260, 3, 1, '2023-10-27', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2023-10-27 08:55:06', '2023-11-01 08:28:10'),
(261, 12, 1, '2023-10-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-28 08:53:08', '2023-11-01 08:27:42'),
(262, 8, 1, '2023-10-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-28 08:53:08', '2023-11-01 08:27:42'),
(263, 19, 1, '2023-10-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-28 08:53:08', '2023-11-01 08:27:42'),
(264, 9, 2, '2023-10-28', 0, 0, 0, 0, NULL, NULL, NULL, 0, '2023-10-28 08:53:08', '2023-11-01 08:27:42'),
(265, 11, 1, '2023-10-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-28 08:53:08', '2023-11-01 08:27:42'),
(266, 7, 1, '2023-10-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-28 08:53:08', '2023-11-01 08:27:42'),
(267, 20, 1, '2023-10-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-28 08:53:08', '2023-11-01 08:27:42'),
(268, 21, 1, '2023-10-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-28 08:53:08', '2023-11-01 08:27:42'),
(269, 22, 1, '2023-10-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-28 08:53:08', '2023-11-01 08:27:42'),
(270, 10, 1, '2023-10-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-28 08:53:08', '2023-11-01 08:27:42'),
(271, 5, 2, '2023-10-28', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-28 08:53:08', '2023-10-28 08:53:08'),
(272, 14, 1, '2023-10-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-28 08:53:08', '2023-11-01 08:27:42'),
(273, 3, 1, '2023-10-28', 150, 3, 0, 0, NULL, '08:00:00', '15:30:00', 0, '2023-10-28 08:53:08', '2023-11-01 08:27:42'),
(274, 12, 1, '2023-10-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-30 17:38:31', '2023-11-01 08:28:58'),
(275, 8, 1, '2023-10-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-30 17:38:31', '2023-11-01 08:28:58'),
(276, 19, 1, '2023-10-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-30 17:38:31', '2023-11-01 08:28:58'),
(277, 9, 1, '2023-10-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-30 17:38:31', '2023-11-01 08:28:58'),
(278, 11, 1, '2023-10-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-30 17:38:31', '2023-11-01 08:28:58'),
(279, 7, 1, '2023-10-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-30 17:38:31', '2023-11-01 08:28:58'),
(280, 20, 2, '2023-10-25', 0, 0, 0, 0, NULL, NULL, NULL, 0, '2023-10-30 17:38:31', '2023-11-01 08:28:58'),
(281, 21, 1, '2023-10-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-30 17:38:31', '2023-11-01 08:28:58'),
(282, 22, 1, '2023-10-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-30 17:38:31', '2023-11-01 08:28:58'),
(283, 10, 1, '2023-10-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-30 17:38:31', '2023-11-01 08:28:58'),
(284, 5, 1, '2023-10-25', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-30 17:38:31', '2023-10-30 17:38:31'),
(285, 14, 1, '2023-10-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-30 17:38:31', '2023-11-01 08:28:58'),
(286, 3, 1, '2023-10-25', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2023-10-30 17:38:31', '2023-11-01 08:28:58'),
(287, 12, 1, '2023-10-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 08:17:18', '2023-11-01 08:26:46'),
(288, 8, 1, '2023-10-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 08:17:18', '2023-11-01 08:26:46'),
(289, 19, 1, '2023-10-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 08:17:18', '2023-11-01 08:26:46'),
(290, 9, 1, '2023-10-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 08:17:18', '2023-11-01 08:26:46'),
(291, 11, 1, '2023-10-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 08:17:18', '2023-11-01 08:26:46'),
(292, 7, 1, '2023-10-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 08:17:18', '2023-11-01 08:26:46'),
(293, 20, 1, '2023-10-30', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-31 08:17:18', '2023-11-01 08:26:46'),
(294, 21, 1, '2023-10-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 08:17:18', '2023-11-01 08:26:46'),
(295, 22, 1, '2023-10-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 08:17:18', '2023-11-01 08:26:46'),
(296, 10, 1, '2023-10-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 08:17:18', '2023-11-01 08:26:46'),
(297, 5, 2, '2023-10-30', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-10-31 08:17:18', '2023-10-31 08:17:18'),
(298, 14, 1, '2023-10-30', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-10-31 08:17:18', '2023-11-01 08:26:46'),
(299, 3, 1, '2023-10-30', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2023-10-31 08:17:18', '2023-11-01 08:26:46'),
(300, 12, 1, '2023-10-31', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 18:15:04', '2023-11-01 08:26:20'),
(301, 8, 1, '2023-10-31', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 18:15:04', '2023-11-01 08:26:20'),
(302, 19, 1, '2023-10-31', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 18:15:04', '2023-11-01 08:26:20'),
(303, 9, 1, '2023-10-31', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 18:15:04', '2023-11-01 08:26:20'),
(304, 11, 1, '2023-10-31', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 18:15:04', '2023-11-01 08:26:20'),
(305, 7, 1, '2023-10-31', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 18:15:04', '2023-11-01 08:26:20'),
(306, 20, 1, '2023-10-31', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 18:15:04', '2023-11-01 08:26:20'),
(307, 21, 1, '2023-10-31', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 18:15:04', '2023-11-01 08:26:20'),
(308, 22, 1, '2023-10-31', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 18:15:04', '2023-11-01 08:26:20'),
(309, 10, 1, '2023-10-31', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 18:15:04', '2023-11-01 08:26:20'),
(310, 14, 1, '2023-10-31', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-10-31 18:15:04', '2023-11-01 08:26:20'),
(311, 3, 1, '2023-10-31', 90, 2, 0, 0, NULL, '08:00:00', '19:30:00', 0, '2023-10-31 18:15:04', '2023-11-01 08:26:20'),
(312, 12, 1, '2023-11-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-02 18:30:23', '2023-11-07 17:15:46'),
(313, 8, 1, '2023-11-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-02 18:30:23', '2023-11-07 17:15:46'),
(314, 19, 1, '2023-11-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-02 18:30:23', '2023-11-07 17:15:46'),
(315, 9, 1, '2023-11-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-02 18:30:23', '2023-11-07 17:15:46'),
(316, 11, 1, '2023-11-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-02 18:30:23', '2023-11-07 17:15:46'),
(317, 7, 1, '2023-11-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-02 18:30:23', '2023-11-07 17:15:46'),
(318, 20, 1, '2023-11-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-02 18:30:23', '2023-11-07 17:15:46'),
(319, 21, 1, '2023-11-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-02 18:30:23', '2023-11-07 17:15:46'),
(320, 22, 1, '2023-11-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-02 18:30:23', '2023-11-07 17:15:46'),
(321, 10, 1, '2023-11-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-02 18:30:23', '2023-11-03 13:20:21'),
(322, 14, 1, '2023-11-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-02 18:30:23', '2023-11-07 17:15:46'),
(323, 3, 1, '2023-11-02', 152, 3, 0, 0, NULL, '08:00:00', '20:32:00', 0, '2023-11-02 18:30:23', '2023-11-07 18:07:28'),
(324, 12, 2, '2023-11-06', 0, 0, 0, 0, NULL, NULL, NULL, 0, '2023-11-07 08:42:59', '2023-11-07 17:14:54'),
(325, 8, 1, '2023-11-06', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-07 08:42:59', '2023-11-07 17:14:54'),
(326, 19, 1, '2023-11-06', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-07 08:42:59', '2023-11-07 17:14:54'),
(327, 9, 1, '2023-11-06', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-07 08:42:59', '2023-11-07 17:14:54'),
(328, 11, 1, '2023-11-06', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-07 08:42:59', '2023-11-07 17:14:54'),
(329, 7, 1, '2023-11-06', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-07 08:42:59', '2023-11-07 17:14:54'),
(330, 20, 1, '2023-11-06', 120, 3, 0, 0, NULL, '08:00:00', '20:00:00', 0, '2023-11-07 08:42:59', '2023-11-07 17:14:54'),
(331, 21, 1, '2023-11-06', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-07 08:42:59', '2023-11-07 17:14:54'),
(332, 22, 1, '2023-11-06', 95, 2, 0, 0, NULL, '08:00:00', '19:35:00', 0, '2023-11-07 08:42:59', '2023-11-07 17:14:54'),
(333, 14, 1, '2023-11-06', 60, 2, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-11-07 08:42:59', '2023-11-07 17:14:54'),
(334, 3, 1, '2023-11-06', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2023-11-07 08:42:59', '2023-11-07 18:07:28'),
(335, 12, 1, '2023-11-07', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-07 17:13:06', '2023-11-13 10:33:30'),
(336, 8, 1, '2023-11-07', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-07 17:13:06', '2023-11-13 10:33:30'),
(337, 19, 1, '2023-11-07', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-07 17:13:06', '2023-11-13 10:33:30'),
(338, 9, 1, '2023-11-07', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-07 17:13:06', '2023-11-13 10:33:30'),
(339, 11, 1, '2023-11-07', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-07 17:13:06', '2023-11-13 10:33:30'),
(340, 7, 1, '2023-11-07', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-07 17:13:06', '2023-11-13 10:33:30'),
(341, 20, 1, '2023-11-07', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-07 17:13:06', '2023-11-13 10:33:30'),
(342, 21, 1, '2023-11-07', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-07 17:13:06', '2023-11-13 10:33:30'),
(343, 22, 1, '2023-11-07', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-07 17:13:06', '2023-11-13 10:33:30'),
(344, 14, 1, '2023-11-07', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-07 17:13:06', '2023-11-13 10:33:30'),
(345, 3, 1, '2023-11-07', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2023-11-07 17:13:06', '2023-11-13 10:33:30'),
(346, 12, 1, '2023-11-04', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:13:58', '2023-11-07 17:13:58'),
(347, 8, 2, '2023-11-04', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:13:58', '2023-11-07 17:13:58'),
(348, 19, 1, '2023-11-04', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:13:58', '2023-11-07 17:13:58'),
(349, 9, 1, '2023-11-04', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:13:58', '2023-11-07 17:13:58'),
(350, 11, 1, '2023-11-04', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:13:58', '2023-11-07 17:13:58'),
(351, 7, 1, '2023-11-04', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:13:58', '2023-11-07 17:13:58'),
(352, 20, 1, '2023-11-04', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:13:58', '2023-11-07 17:13:58'),
(353, 21, 1, '2023-11-04', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:13:58', '2023-11-07 17:13:58'),
(354, 22, 1, '2023-11-04', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:13:58', '2023-11-07 17:13:58'),
(355, 14, 1, '2023-11-04', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:13:58', '2023-11-07 17:13:58'),
(356, 3, 1, '2023-11-04', 150, 3, NULL, 0, NULL, '08:00:00', '15:30:00', NULL, '2023-11-07 17:13:58', '2023-11-07 18:07:28'),
(357, 12, 1, '2023-11-03', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:15:22', '2023-11-07 17:15:22'),
(358, 8, 1, '2023-11-03', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:15:22', '2023-11-07 17:15:22'),
(359, 19, 1, '2023-11-03', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:15:22', '2023-11-07 17:15:22'),
(360, 9, 1, '2023-11-03', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:15:22', '2023-11-07 17:15:22'),
(361, 11, 1, '2023-11-03', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:15:22', '2023-11-07 17:15:22'),
(362, 7, 1, '2023-11-03', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:15:22', '2023-11-07 17:15:22'),
(363, 20, 1, '2023-11-03', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:15:22', '2023-11-07 17:15:22'),
(364, 21, 1, '2023-11-03', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:15:22', '2023-11-07 17:15:22'),
(365, 22, 1, '2023-11-03', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:15:22', '2023-11-07 17:15:22'),
(366, 14, 1, '2023-11-03', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:15:22', '2023-11-07 17:15:22'),
(367, 3, 1, '2023-11-03', 150, 3, NULL, 0, NULL, '08:00:00', '20:30:00', NULL, '2023-11-07 17:15:22', '2023-11-07 18:07:28'),
(368, 12, 1, '2023-11-01', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:16:03', '2023-11-07 17:16:03'),
(369, 8, 1, '2023-11-01', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:16:03', '2023-11-07 17:16:03'),
(370, 19, 1, '2023-11-01', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:16:03', '2023-11-07 17:16:03'),
(371, 9, 1, '2023-11-01', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:16:03', '2023-11-07 17:16:03'),
(372, 11, 1, '2023-11-01', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:16:03', '2023-11-07 17:16:03'),
(373, 7, 1, '2023-11-01', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:16:03', '2023-11-07 17:16:03'),
(374, 20, 1, '2023-11-01', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:16:03', '2023-11-07 17:16:03'),
(375, 21, 1, '2023-11-01', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:16:03', '2023-11-07 17:16:03'),
(376, 22, 1, '2023-11-01', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:16:03', '2023-11-07 17:16:03'),
(377, 14, 1, '2023-11-01', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-07 17:16:03', '2023-11-07 17:16:03'),
(378, 3, 1, '2023-11-01', 150, 3, NULL, 0, NULL, '08:00:00', '20:30:00', NULL, '2023-11-07 17:16:03', '2023-11-07 18:07:28'),
(379, 12, 1, '2023-11-08', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:23:36', '2023-11-13 10:23:36'),
(380, 8, 1, '2023-11-08', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:23:36', '2023-11-13 10:23:36'),
(381, 19, 1, '2023-11-08', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:23:36', '2023-11-13 10:23:36'),
(382, 9, 1, '2023-11-08', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:23:36', '2023-11-13 10:23:36'),
(383, 11, 1, '2023-11-08', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:23:36', '2023-11-13 10:23:36'),
(384, 7, 1, '2023-11-08', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:23:36', '2023-11-13 10:23:36'),
(385, 20, 1, '2023-11-08', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:23:36', '2023-11-13 10:23:36'),
(386, 21, 1, '2023-11-08', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:23:36', '2023-11-13 10:23:36'),
(387, 22, 1, '2023-11-08', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:23:36', '2023-11-13 10:23:36'),
(388, 14, 1, '2023-11-08', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:23:36', '2023-11-13 10:23:36'),
(389, 3, 1, '2023-11-08', 0, 0, NULL, NULL, NULL, '08:00:00', '08:23:00', NULL, '2023-11-13 10:23:36', '2023-11-13 10:23:36'),
(390, 12, 1, '2023-11-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-13 10:24:12', '2023-11-14 15:12:48'),
(391, 8, 1, '2023-11-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-13 10:24:12', '2023-11-14 15:12:48'),
(392, 19, 1, '2023-11-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-13 10:24:12', '2023-11-14 15:12:48'),
(393, 9, 1, '2023-11-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-13 10:24:12', '2023-11-14 15:12:48'),
(394, 11, 1, '2023-11-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-13 10:24:12', '2023-11-14 15:12:48'),
(395, 7, 1, '2023-11-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-13 10:24:12', '2023-11-14 15:12:48'),
(396, 20, 2, '2023-11-13', 0, 0, 0, 0, NULL, NULL, NULL, 0, '2023-11-13 10:24:12', '2023-11-14 15:12:48'),
(397, 21, 1, '2023-11-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-13 10:24:12', '2023-11-14 15:12:48'),
(398, 22, 1, '2023-11-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-13 10:24:12', '2023-11-14 15:12:48'),
(399, 14, 1, '2023-11-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-13 10:24:12', '2023-11-14 15:12:48'),
(400, 3, 1, '2023-11-13', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2023-11-13 10:24:12', '2023-11-14 15:12:48'),
(401, 12, 1, '2023-11-11', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:26:21', '2023-11-13 10:26:21'),
(402, 8, 1, '2023-11-11', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:26:21', '2023-11-13 10:26:21'),
(403, 19, 1, '2023-11-11', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:26:21', '2023-11-13 10:26:21'),
(404, 9, 1, '2023-11-11', 0, 0, NULL, NULL, NULL, '08:00:00', '16:02:00', NULL, '2023-11-13 10:26:21', '2023-11-13 10:26:21'),
(405, 11, 1, '2023-11-11', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:26:21', '2023-11-13 10:26:21'),
(406, 7, 1, '2023-11-11', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:26:21', '2023-11-13 10:26:21'),
(407, 20, 1, '2023-11-11', 0, 0, NULL, NULL, NULL, '08:00:00', '16:05:00', NULL, '2023-11-13 10:26:21', '2023-11-13 10:26:21'),
(408, 21, 1, '2023-11-11', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:26:21', '2023-11-13 10:26:21'),
(409, 22, 1, '2023-11-11', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:26:21', '2023-11-13 10:26:21'),
(410, 14, 1, '2023-11-11', 0, 0, NULL, NULL, NULL, '08:00:00', '16:35:00', NULL, '2023-11-13 10:26:21', '2023-11-13 10:26:21'),
(411, 3, 1, '2023-11-11', 0, 0, NULL, NULL, NULL, '08:00:00', '15:00:00', NULL, '2023-11-13 10:26:21', '2023-11-13 10:26:21'),
(412, 12, 1, '2023-11-10', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:30:59', '2023-11-13 10:30:59'),
(413, 8, 1, '2023-11-10', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:30:59', '2023-11-13 10:30:59'),
(414, 19, 1, '2023-11-10', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:30:59', '2023-11-13 10:30:59'),
(415, 9, 1, '2023-11-10', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:30:59', '2023-11-13 10:30:59'),
(416, 11, 1, '2023-11-10', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:30:59', '2023-11-13 10:30:59'),
(417, 7, 1, '2023-11-10', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:30:59', '2023-11-13 10:30:59'),
(418, 20, 1, '2023-11-10', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:30:59', '2023-11-13 10:30:59'),
(419, 21, 1, '2023-11-10', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:30:59', '2023-11-13 10:30:59'),
(420, 22, 1, '2023-11-10', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:30:59', '2023-11-13 10:30:59'),
(421, 14, 1, '2023-11-10', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-13 10:30:59', '2023-11-13 10:30:59'),
(422, 3, 1, '2023-11-10', 0, 0, NULL, NULL, NULL, '08:00:00', '20:30:00', NULL, '2023-11-13 10:30:59', '2023-11-13 10:30:59'),
(423, 12, 1, '2023-11-09', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-13 10:31:54', '2023-11-13 10:32:56'),
(424, 8, 1, '2023-11-09', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-13 10:31:54', '2023-11-13 10:32:56'),
(425, 19, 1, '2023-11-09', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-13 10:31:54', '2023-11-13 10:32:56'),
(426, 9, 1, '2023-11-09', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-13 10:31:54', '2023-11-13 10:32:56'),
(427, 11, 1, '2023-11-09', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-13 10:31:54', '2023-11-13 10:32:56'),
(428, 7, 1, '2023-11-09', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-13 10:31:54', '2023-11-13 10:32:56'),
(429, 20, 1, '2023-11-09', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-13 10:31:54', '2023-11-13 10:32:56'),
(430, 21, 1, '2023-11-09', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-13 10:31:54', '2023-11-13 10:32:56'),
(431, 22, 1, '2023-11-09', 91, 2, 0, 0, NULL, '08:00:00', '19:31:00', 0, '2023-11-13 10:31:54', '2023-11-13 10:32:56'),
(432, 14, 1, '2023-11-09', 60, 2, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-11-13 10:31:54', '2023-11-13 10:32:56'),
(433, 3, 1, '2023-11-09', 156, 3, 0, 0, NULL, '08:00:00', '20:36:00', 0, '2023-11-13 10:31:54', '2023-11-13 10:32:56'),
(434, 12, 1, '2023-11-14', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-15 08:15:48', '2023-11-18 09:35:32'),
(435, 8, 1, '2023-11-14', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-15 08:15:48', '2023-11-18 09:35:32');
INSERT INTO `asistencia` (`id`, `personalId`, `asistenciaId`, `fecha`, `horasExtra`, `totalHorasExtra`, `horasAnticipada`, `horasRetraso`, `comentario`, `hEntrada`, `hSalida`, `entradaAnticipada`, `created_at`, `updated_at`) VALUES
(436, 19, 1, '2023-11-14', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-15 08:15:48', '2023-11-18 09:35:32'),
(437, 9, 1, '2023-11-14', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-15 08:15:48', '2023-11-18 09:35:32'),
(438, 11, 1, '2023-11-14', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-15 08:15:48', '2023-11-18 09:35:32'),
(439, 7, 1, '2023-11-14', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-15 08:15:48', '2023-11-18 09:35:32'),
(440, 20, 1, '2023-11-14', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-15 08:15:48', '2023-11-18 09:35:32'),
(441, 21, 1, '2023-11-14', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-15 08:15:48', '2023-11-18 09:35:32'),
(442, 22, 1, '2023-11-14', 60, 2, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-11-15 08:15:48', '2023-11-18 09:35:32'),
(443, 14, 1, '2023-11-14', 60, 2, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-11-15 08:15:48', '2023-11-18 09:35:32'),
(444, 3, 1, '2023-11-14', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2023-11-15 08:15:48', '2023-11-18 09:35:32'),
(445, 12, 1, '2023-11-17', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:31:24', '2023-11-21 16:42:57'),
(446, 8, 1, '2023-11-17', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:31:24', '2023-11-21 16:42:57'),
(447, 19, 1, '2023-11-17', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:31:24', '2023-11-21 16:42:57'),
(448, 9, 1, '2023-11-17', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:31:24', '2023-11-21 16:42:57'),
(449, 11, 1, '2023-11-17', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:31:24', '2023-11-21 16:42:57'),
(450, 7, 1, '2023-11-17', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:31:24', '2023-11-21 16:42:57'),
(451, 20, 2, '2023-11-17', 0, 0, 0, 0, NULL, NULL, NULL, 0, '2023-11-18 09:31:24', '2023-11-21 16:42:57'),
(452, 21, 1, '2023-11-17', 60, 2, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-11-18 09:31:24', '2023-11-21 16:42:57'),
(453, 22, 1, '2023-11-17', 60, 2, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-11-18 09:31:24', '2023-11-21 16:42:57'),
(454, 14, 1, '2023-11-17', 90, 2, 0, 0, NULL, '08:00:00', '19:30:00', 0, '2023-11-18 09:31:24', '2023-11-21 16:42:57'),
(455, 3, 1, '2023-11-17', 160, 3, 0, 0, NULL, '08:00:00', '20:40:00', 0, '2023-11-18 09:31:24', '2023-11-21 16:42:57'),
(456, 12, 1, '2023-11-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:33:04', '2023-11-18 09:34:14'),
(457, 8, 1, '2023-11-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:33:04', '2023-11-18 09:34:14'),
(458, 19, 1, '2023-11-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:33:04', '2023-11-18 09:34:14'),
(459, 9, 1, '2023-11-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:33:04', '2023-11-18 09:34:14'),
(460, 11, 1, '2023-11-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:33:04', '2023-11-18 09:34:14'),
(461, 7, 1, '2023-11-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:33:04', '2023-11-18 09:34:14'),
(462, 20, 1, '2023-11-16', 120, 3, 0, 0, NULL, '08:00:00', '20:00:00', 0, '2023-11-18 09:33:04', '2023-11-18 09:34:14'),
(463, 21, 1, '2023-11-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:33:04', '2023-11-18 09:34:14'),
(464, 22, 1, '2023-11-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:33:04', '2023-11-18 09:34:14'),
(465, 14, 1, '2023-11-16', 92, 2, 0, 0, NULL, '08:00:00', '19:32:00', 0, '2023-11-18 09:33:04', '2023-11-18 09:34:14'),
(466, 3, 1, '2023-11-16', 151, 3, 0, 0, NULL, '08:00:00', '20:31:00', 0, '2023-11-18 09:33:04', '2023-11-18 09:34:14'),
(467, 12, 1, '2023-11-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:33:48', '2023-11-18 09:35:04'),
(468, 8, 1, '2023-11-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:33:48', '2023-11-18 09:35:04'),
(469, 19, 1, '2023-11-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:33:48', '2023-11-18 09:35:04'),
(470, 9, 1, '2023-11-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:33:48', '2023-11-18 09:35:04'),
(471, 11, 1, '2023-11-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:33:48', '2023-11-18 09:35:04'),
(472, 7, 1, '2023-11-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:33:48', '2023-11-18 09:35:04'),
(473, 20, 1, '2023-11-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:33:48', '2023-11-18 09:35:04'),
(474, 21, 1, '2023-11-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:33:48', '2023-11-18 09:35:04'),
(475, 22, 1, '2023-11-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:33:48', '2023-11-18 09:35:04'),
(476, 14, 1, '2023-11-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-18 09:33:48', '2023-11-18 09:35:04'),
(477, 3, 1, '2023-11-15', 166, 3, 0, 0, NULL, '08:00:00', '20:46:00', 0, '2023-11-18 09:33:48', '2023-11-18 09:35:04'),
(478, 12, 1, '2023-11-21', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-21 16:40:40', '2023-11-23 18:55:41'),
(479, 8, 1, '2023-11-21', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-21 16:40:40', '2023-11-23 18:55:41'),
(480, 19, 1, '2023-11-21', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-21 16:40:40', '2023-11-23 18:55:41'),
(481, 9, 1, '2023-11-21', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-21 16:40:40', '2023-11-23 18:55:41'),
(482, 11, 1, '2023-11-21', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-21 16:40:40', '2023-11-23 18:55:41'),
(483, 7, 1, '2023-11-21', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-21 16:40:40', '2023-11-23 18:55:41'),
(484, 20, 2, '2023-11-21', 0, 0, 0, 655, NULL, NULL, NULL, 0, '2023-11-21 16:40:40', '2023-11-23 18:55:41'),
(485, 21, 1, '2023-11-21', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-21 16:40:40', '2023-11-23 18:55:41'),
(486, 22, 1, '2023-11-21', 90, 2, 0, 0, NULL, '08:00:00', '19:30:00', 0, '2023-11-21 16:40:40', '2023-11-23 18:55:41'),
(487, 14, 1, '2023-11-21', 60, 2, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-11-21 16:40:40', '2023-11-23 18:55:41'),
(488, 3, 1, '2023-11-21', 160, 3, 0, 0, NULL, '08:00:00', '20:40:00', 0, '2023-11-21 16:40:40', '2023-11-23 18:55:41'),
(489, 12, 1, '2023-11-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-21 16:42:22', '2023-11-21 16:42:22'),
(490, 8, 1, '2023-11-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-21 16:42:22', '2023-11-21 16:42:22'),
(491, 19, 1, '2023-11-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-21 16:42:22', '2023-11-21 16:42:22'),
(492, 9, 1, '2023-11-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-21 16:42:22', '2023-11-21 16:42:22'),
(493, 11, 1, '2023-11-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-21 16:42:22', '2023-11-21 16:42:22'),
(494, 7, 1, '2023-11-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-21 16:42:22', '2023-11-21 16:42:22'),
(495, 20, 1, '2023-11-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-21 16:42:22', '2023-11-21 16:42:22'),
(496, 21, 1, '2023-11-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-21 16:42:22', '2023-11-21 16:42:22'),
(497, 22, 1, '2023-11-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-21 16:42:22', '2023-11-21 16:42:22'),
(498, 14, 1, '2023-11-18', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-21 16:42:22', '2023-11-21 16:42:22'),
(499, 3, 1, '2023-11-18', 0, 0, NULL, NULL, NULL, '08:00:00', '15:00:00', NULL, '2023-11-21 16:42:22', '2023-11-21 16:42:22'),
(500, 12, 1, '2023-11-23', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-23 18:53:48', '2023-11-29 08:32:39'),
(501, 8, 1, '2023-11-23', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-23 18:53:48', '2023-11-29 08:32:39'),
(502, 19, 1, '2023-11-23', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-23 18:53:48', '2023-11-29 08:32:39'),
(503, 9, 1, '2023-11-23', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-23 18:53:48', '2023-11-29 08:32:39'),
(504, 11, 1, '2023-11-23', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-23 18:53:48', '2023-11-29 08:32:39'),
(505, 7, 1, '2023-11-23', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-23 18:53:48', '2023-11-29 08:32:39'),
(506, 20, 1, '2023-11-23', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-23 18:53:48', '2023-11-23 18:53:48'),
(507, 21, 1, '2023-11-23', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-23 18:53:48', '2023-11-23 18:53:48'),
(508, 22, 1, '2023-11-23', 60, 2, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-11-23 18:53:48', '2023-11-29 08:32:39'),
(509, 14, 1, '2023-11-23', 60, 2, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-11-23 18:53:48', '2023-11-29 08:32:39'),
(510, 3, 1, '2023-11-23', 40, 1, 0, 0, NULL, '08:00:00', '18:40:00', 0, '2023-11-23 18:53:48', '2023-11-29 08:32:39'),
(511, 12, 1, '2023-11-22', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-23 18:54:34', '2023-11-29 08:32:23'),
(512, 8, 1, '2023-11-22', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-23 18:54:34', '2023-11-29 08:32:23'),
(513, 19, 1, '2023-11-22', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-23 18:54:34', '2023-11-29 08:32:23'),
(514, 9, 1, '2023-11-22', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-23 18:54:34', '2023-11-29 08:32:23'),
(515, 11, 1, '2023-11-22', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-23 18:54:34', '2023-11-29 08:32:23'),
(516, 7, 1, '2023-11-22', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-23 18:54:34', '2023-11-29 08:32:23'),
(517, 20, 1, '2023-11-22', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-23 18:54:34', '2023-11-23 18:54:34'),
(518, 21, 1, '2023-11-22', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-23 18:54:34', '2023-11-23 18:54:34'),
(519, 22, 1, '2023-11-22', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-23 18:54:34', '2023-11-29 08:32:23'),
(520, 14, 1, '2023-11-22', 60, 2, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-11-23 18:54:34', '2023-11-29 08:32:23'),
(521, 3, 1, '2023-11-22', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2023-11-23 18:54:34', '2023-11-29 08:32:23'),
(522, 12, 1, '2023-11-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-25 13:48:07', '2023-11-29 08:33:09'),
(523, 8, 1, '2023-11-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-25 13:48:07', '2023-11-29 08:33:09'),
(524, 19, 1, '2023-11-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-25 13:48:07', '2023-11-29 08:33:09'),
(525, 9, 1, '2023-11-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-25 13:48:07', '2023-11-29 08:33:09'),
(526, 11, 1, '2023-11-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-25 13:48:07', '2023-11-29 08:33:09'),
(527, 7, 1, '2023-11-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-25 13:48:07', '2023-11-29 08:33:09'),
(528, 20, 2, '2023-11-25', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-25 13:48:07', '2023-11-25 13:48:07'),
(529, 21, 1, '2023-11-25', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-25 13:48:07', '2023-11-25 13:48:07'),
(530, 22, 1, '2023-11-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-25 13:48:07', '2023-11-29 08:33:09'),
(531, 14, 1, '2023-11-25', 60, 2, 0, 0, NULL, '08:00:00', '14:00:00', 0, '2023-11-25 13:48:07', '2023-11-29 08:33:09'),
(532, 3, 1, '2023-11-25', 95, 2, 0, 0, NULL, '08:00:00', '14:35:00', 0, '2023-11-25 13:48:07', '2023-11-29 08:33:09'),
(533, 12, 1, '2023-11-24', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-25 13:49:22', '2023-11-29 08:31:57'),
(534, 8, 1, '2023-11-24', 60, 2, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-11-25 13:49:22', '2023-11-29 08:31:57'),
(535, 19, 1, '2023-11-24', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-25 13:49:22', '2023-11-29 08:31:57'),
(536, 9, 1, '2023-11-24', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-25 13:49:22', '2023-11-29 08:31:57'),
(537, 11, 1, '2023-11-24', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-25 13:49:22', '2023-11-29 08:31:57'),
(538, 7, 1, '2023-11-24', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-25 13:49:22', '2023-11-29 08:31:57'),
(539, 20, 2, '2023-11-24', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-25 13:49:22', '2023-11-25 13:49:22'),
(540, 21, 2, '2023-11-24', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-25 13:49:22', '2023-11-25 13:49:22'),
(541, 22, 1, '2023-11-24', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-25 13:49:22', '2023-11-29 08:31:57'),
(542, 14, 1, '2023-11-24', 60, 2, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-11-25 13:49:22', '2023-11-29 08:31:57'),
(543, 3, 1, '2023-11-24', 160, 3, 0, 0, NULL, '08:00:00', '20:40:00', 0, '2023-11-25 13:49:22', '2023-11-29 08:31:57'),
(544, 12, 1, '2023-11-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-28 16:19:10', '2023-11-29 08:33:48'),
(545, 8, 1, '2023-11-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-28 16:19:10', '2023-11-29 08:33:48'),
(546, 19, 1, '2023-11-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-28 16:19:10', '2023-11-29 08:33:48'),
(547, 9, 1, '2023-11-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-28 16:19:10', '2023-11-29 08:33:48'),
(548, 11, 1, '2023-11-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-28 16:19:10', '2023-11-29 08:33:48'),
(549, 7, 1, '2023-11-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-28 16:19:10', '2023-11-29 08:33:48'),
(550, 22, 1, '2023-11-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-28 16:19:10', '2023-11-29 08:33:48'),
(551, 14, 1, '2023-11-27', 160, 3, 0, 0, NULL, '08:00:00', '20:40:00', 0, '2023-11-28 16:19:10', '2023-11-29 08:33:48'),
(552, 3, 1, '2023-11-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-28 16:19:10', '2023-11-29 08:33:48'),
(553, 12, 1, '2023-11-28', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-29 08:34:11', '2023-11-29 08:34:11'),
(554, 8, 1, '2023-11-28', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-29 08:34:11', '2023-11-29 08:34:11'),
(555, 19, 1, '2023-11-28', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-29 08:34:11', '2023-11-29 08:34:11'),
(556, 9, 1, '2023-11-28', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-29 08:34:11', '2023-11-29 08:34:11'),
(557, 11, 1, '2023-11-28', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-29 08:34:11', '2023-11-29 08:34:11'),
(558, 7, 1, '2023-11-28', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-29 08:34:11', '2023-11-29 08:34:11'),
(559, 22, 1, '2023-11-28', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-29 08:34:11', '2023-11-29 08:34:11'),
(560, 14, 1, '2023-11-28', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-11-29 08:34:11', '2023-11-29 08:34:11'),
(561, 3, 1, '2023-11-28', 0, 0, NULL, NULL, NULL, '08:00:00', '21:00:00', NULL, '2023-11-29 08:34:11', '2023-11-29 08:34:11'),
(562, 12, 1, '2023-11-29', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-30 09:52:36', '2023-12-04 09:26:48'),
(563, 8, 1, '2023-11-29', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-30 09:52:36', '2023-12-04 09:26:48'),
(564, 19, 1, '2023-11-29', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-30 09:52:36', '2023-12-04 09:26:48'),
(565, 9, 1, '2023-11-29', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-30 09:52:36', '2023-12-04 09:26:48'),
(566, 11, 1, '2023-11-29', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-30 09:52:36', '2023-12-04 09:26:48'),
(567, 7, 1, '2023-11-29', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-30 09:52:36', '2023-12-04 09:26:48'),
(568, 22, 1, '2023-11-29', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-30 09:52:36', '2023-12-04 09:26:48'),
(569, 14, 1, '2023-11-29', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-11-30 09:52:36', '2023-12-04 09:26:48'),
(570, 3, 1, '2023-11-29', 155, 3, 0, 0, NULL, '08:00:00', '20:35:00', 0, '2023-11-30 09:52:36', '2023-12-04 09:26:48'),
(571, 12, 1, '2023-12-01', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-01 08:43:37', '2023-12-04 09:24:37'),
(572, 8, 1, '2023-12-01', 0, 2, 60, 0, NULL, '07:00:00', NULL, 1, '2023-12-01 08:43:37', '2023-12-04 09:24:37'),
(573, 19, 1, '2023-12-01', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-01 08:43:37', '2023-12-04 09:24:37'),
(574, 9, 1, '2023-12-01', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-01 08:43:37', '2023-12-04 09:24:37'),
(575, 11, 1, '2023-12-01', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-01 08:43:37', '2023-12-04 09:24:37'),
(576, 7, 1, '2023-12-01', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-01 08:43:37', '2023-12-04 09:24:37'),
(577, 22, 1, '2023-12-01', 0, 2, 60, 0, NULL, '07:00:00', NULL, 1, '2023-12-01 08:43:37', '2023-12-04 09:24:37'),
(578, 14, 1, '2023-12-01', 0, 2, 60, 0, NULL, '07:00:00', NULL, 1, '2023-12-01 08:43:37', '2023-12-04 09:24:37'),
(579, 3, 1, '2023-12-01', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-01 08:43:37', '2023-12-04 09:24:37'),
(580, 12, 1, '2023-11-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-01 08:44:25', '2023-12-04 09:25:56'),
(581, 8, 1, '2023-11-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-01 08:44:25', '2023-12-04 09:25:56'),
(582, 19, 1, '2023-11-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-01 08:44:25', '2023-12-04 09:25:56'),
(583, 9, 1, '2023-11-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-01 08:44:25', '2023-12-04 09:25:56'),
(584, 11, 1, '2023-11-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-01 08:44:25', '2023-12-04 09:25:56'),
(585, 7, 1, '2023-11-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-01 08:44:25', '2023-12-04 09:25:56'),
(586, 22, 1, '2023-11-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-01 08:44:25', '2023-12-04 09:25:56'),
(587, 14, 1, '2023-11-30', 104, 2, 0, 0, NULL, '08:00:00', '19:44:00', 0, '2023-12-01 08:44:25', '2023-12-04 09:25:56'),
(588, 3, 1, '2023-11-30', 165, 3, 0, 0, NULL, '08:00:00', '20:45:00', 0, '2023-12-01 08:44:25', '2023-12-04 09:25:56'),
(589, 12, 1, '2023-12-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-04 09:13:10', '2023-12-04 09:24:10'),
(590, 8, 1, '2023-12-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-04 09:13:10', '2023-12-04 09:24:10'),
(591, 19, 1, '2023-12-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-04 09:13:10', '2023-12-04 09:24:10'),
(592, 9, 1, '2023-12-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-04 09:13:10', '2023-12-04 09:24:10'),
(593, 11, 1, '2023-12-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-04 09:13:10', '2023-12-04 09:24:10'),
(594, 7, 1, '2023-12-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-04 09:13:10', '2023-12-04 09:24:10'),
(595, 22, 1, '2023-12-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-04 09:13:10', '2023-12-04 09:24:10'),
(596, 14, 1, '2023-12-02', 120, 3, 0, 0, NULL, '08:00:00', '15:00:00', 0, '2023-12-04 09:13:10', '2023-12-04 09:24:10'),
(597, 3, 1, '2023-12-02', 120, 3, 0, 0, NULL, '08:00:00', '15:00:00', 0, '2023-12-04 09:13:10', '2023-12-04 09:24:10'),
(598, 12, 2, '2023-12-04', 0, 0, 0, 0, NULL, NULL, NULL, 0, '2023-12-05 14:44:31', '2023-12-05 16:45:12'),
(599, 8, 1, '2023-12-04', 60, 2, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-12-05 14:44:31', '2023-12-05 16:45:12'),
(600, 19, 1, '2023-12-04', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-05 14:44:31', '2023-12-05 16:45:12'),
(601, 9, 1, '2023-12-04', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-05 14:44:31', '2023-12-05 16:45:12'),
(602, 11, 1, '2023-12-04', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-05 14:44:31', '2023-12-05 16:45:12'),
(603, 7, 1, '2023-12-04', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-05 14:44:31', '2023-12-05 16:45:12'),
(604, 22, 1, '2023-12-04', 90, 2, 0, 0, NULL, '08:00:00', '19:30:00', 0, '2023-12-05 14:44:31', '2023-12-05 16:45:12'),
(605, 14, 1, '2023-12-04', 60, 2, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-12-05 14:44:31', '2023-12-05 16:45:12'),
(606, 3, 1, '2023-12-04', 164, 3, 0, 0, NULL, '08:00:00', '20:44:00', 0, '2023-12-05 14:44:31', '2023-12-05 16:45:12'),
(607, 12, 2, '2023-12-05', 0, 0, 0, 0, NULL, NULL, NULL, 0, '2023-12-05 18:32:45', '2023-12-06 08:30:12'),
(608, 8, 1, '2023-12-05', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-05 18:32:45', '2023-12-06 08:30:12'),
(609, 19, 1, '2023-12-05', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-05 18:32:45', '2023-12-06 08:30:12'),
(610, 9, 1, '2023-12-05', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-05 18:32:45', '2023-12-06 08:30:12'),
(611, 11, 1, '2023-12-05', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-05 18:32:45', '2023-12-06 08:30:12'),
(612, 7, 1, '2023-12-05', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-05 18:32:45', '2023-12-06 08:30:12'),
(613, 22, 1, '2023-12-05', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-05 18:32:45', '2023-12-06 08:30:12'),
(614, 14, 1, '2023-12-05', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-05 18:32:45', '2023-12-06 08:30:12'),
(615, 3, 1, '2023-12-05', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2023-12-05 18:32:45', '2023-12-06 08:30:12'),
(616, 12, 1, '2023-12-06', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-07 09:08:17', '2023-12-07 16:56:29'),
(617, 8, 1, '2023-12-06', 0, 0, 0, 0, NULL, '07:00:00', NULL, 0, '2023-12-07 09:08:17', '2023-12-07 16:56:29'),
(618, 19, 1, '2023-12-06', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-07 09:08:17', '2023-12-07 16:56:29'),
(619, 9, 1, '2023-12-06', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-07 09:08:17', '2023-12-07 16:56:29'),
(620, 11, 1, '2023-12-06', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-07 09:08:17', '2023-12-07 16:56:29'),
(621, 7, 1, '2023-12-06', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-07 09:08:17', '2023-12-07 16:56:29'),
(622, 23, 1, '2023-12-06', 120, 3, 0, 0, NULL, '08:00:00', '20:00:00', 0, '2023-12-07 09:08:17', '2023-12-07 16:56:29'),
(623, 22, 1, '2023-12-06', 0, 0, 0, 0, NULL, '07:00:00', NULL, 0, '2023-12-07 09:08:17', '2023-12-07 16:56:29'),
(624, 14, 1, '2023-12-06', 150, 3, 0, 0, NULL, '07:00:00', '20:30:00', 0, '2023-12-07 09:08:17', '2023-12-07 16:56:29'),
(625, 3, 1, '2023-12-06', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2023-12-07 09:08:17', '2023-12-07 16:56:29'),
(626, 12, 1, '2023-12-07', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-12-08 08:32:29', '2023-12-08 08:32:29'),
(627, 8, 1, '2023-12-07', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-12-08 08:32:29', '2023-12-08 08:32:29'),
(628, 19, 1, '2023-12-07', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-12-08 08:32:29', '2023-12-08 08:32:29'),
(629, 9, 1, '2023-12-07', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-12-08 08:32:29', '2023-12-08 08:32:29'),
(630, 11, 1, '2023-12-07', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-12-08 08:32:29', '2023-12-08 08:32:29'),
(631, 7, 1, '2023-12-07', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-12-08 08:32:29', '2023-12-08 08:32:29'),
(632, 23, 1, '2023-12-07', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-12-08 08:32:29', '2023-12-08 08:32:29'),
(633, 22, 1, '2023-12-07', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-12-08 08:32:29', '2023-12-08 08:32:29'),
(634, 14, 1, '2023-12-07', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-12-08 08:32:29', '2023-12-08 08:32:29'),
(635, 3, 1, '2023-12-07', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-12-08 08:32:29', '2023-12-08 08:32:29'),
(636, 12, 1, '2023-12-09', 0, 0, NULL, NULL, NULL, '08:00:00', '14:00:00', NULL, '2023-12-09 13:41:49', '2023-12-09 13:41:49'),
(637, 8, 1, '2023-12-09', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-12-09 13:41:49', '2023-12-09 13:41:49'),
(638, 19, 1, '2023-12-09', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-12-09 13:41:49', '2023-12-09 13:41:49'),
(639, 9, 1, '2023-12-09', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-12-09 13:41:49', '2023-12-09 13:41:49'),
(640, 11, 1, '2023-12-09', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-12-09 13:41:49', '2023-12-09 13:41:49'),
(641, 7, 1, '2023-12-09', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-12-09 13:41:49', '2023-12-09 13:41:49'),
(642, 23, 1, '2023-12-09', 0, 0, NULL, NULL, NULL, '08:00:00', NULL, NULL, '2023-12-09 13:41:49', '2023-12-09 13:41:49'),
(643, 22, 1, '2023-12-09', 0, 0, NULL, NULL, NULL, '07:00:00', NULL, NULL, '2023-12-09 13:41:49', '2023-12-09 13:41:49'),
(644, 14, 1, '2023-12-09', 0, 0, NULL, NULL, NULL, '07:00:00', '14:00:00', NULL, '2023-12-09 13:41:49', '2023-12-09 13:41:49'),
(645, 3, 1, '2023-12-09', 0, 0, NULL, NULL, NULL, '08:00:00', '15:00:00', NULL, '2023-12-09 13:41:49', '2023-12-09 13:41:49'),
(646, 12, 1, '2023-12-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:48:58', '2023-12-13 08:48:58'),
(647, 8, 2, '2023-12-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:48:58', '2023-12-13 08:48:58'),
(648, 19, 1, '2023-12-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:48:58', '2023-12-13 08:48:58'),
(649, 9, 2, '2023-12-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:48:58', '2023-12-13 08:48:58'),
(650, 11, 1, '2023-12-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:48:58', '2023-12-13 08:48:58'),
(651, 7, 1, '2023-12-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:48:58', '2023-12-13 08:48:58'),
(652, 23, 1, '2023-12-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:48:58', '2023-12-13 08:48:58'),
(653, 22, 1, '2023-12-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:48:58', '2023-12-13 08:48:58'),
(654, 14, 1, '2023-12-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:48:58', '2023-12-13 08:48:58'),
(655, 3, 1, '2023-12-11', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2023-12-13 08:48:58', '2023-12-13 08:48:58'),
(656, 12, 1, '2023-12-12', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:50:10', '2023-12-13 14:39:03'),
(657, 8, 1, '2023-12-12', 60, 2, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-12-13 08:50:10', '2023-12-13 14:39:03'),
(658, 19, 1, '2023-12-12', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:50:10', '2023-12-13 14:39:03'),
(659, 9, 1, '2023-12-12', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:50:10', '2023-12-13 14:39:03'),
(660, 11, 1, '2023-12-12', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:50:10', '2023-12-13 14:39:03'),
(661, 7, 1, '2023-12-12', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:50:10', '2023-12-13 14:39:03'),
(662, 23, 1, '2023-12-12', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:50:10', '2023-12-13 14:39:03'),
(663, 22, 1, '2023-12-12', 60, 2, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-12-13 08:50:10', '2023-12-13 14:39:03'),
(664, 14, 1, '2023-12-12', 60, 2, 0, 0, NULL, '08:00:00', '19:00:00', 0, '2023-12-13 08:50:10', '2023-12-13 14:39:03'),
(665, 3, 1, '2023-12-12', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2023-12-13 08:50:10', '2023-12-13 14:39:03'),
(666, 12, 1, '2023-12-08', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:51:31', '2023-12-13 08:51:31'),
(667, 8, 1, '2023-12-08', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:51:31', '2023-12-13 08:51:31'),
(668, 19, 1, '2023-12-08', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:51:31', '2023-12-13 08:51:31'),
(669, 9, 1, '2023-12-08', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:51:31', '2023-12-13 08:51:31'),
(670, 11, 1, '2023-12-08', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:51:31', '2023-12-13 08:51:31'),
(671, 7, 1, '2023-12-08', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:51:31', '2023-12-13 08:51:31'),
(672, 23, 1, '2023-12-08', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:51:31', '2023-12-13 08:51:31'),
(673, 22, 1, '2023-12-08', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:51:31', '2023-12-13 08:51:31'),
(674, 14, 1, '2023-12-08', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-13 08:51:31', '2023-12-13 08:51:31'),
(675, 3, 1, '2023-12-08', 120, 3, 0, 0, NULL, '08:00:00', '20:00:00', 0, '2023-12-13 08:51:31', '2023-12-13 08:51:31'),
(676, 12, 1, '2023-12-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:42:58', '2023-12-20 08:42:58'),
(677, 8, 1, '2023-12-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:42:58', '2023-12-20 08:42:58'),
(678, 19, 1, '2023-12-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:42:58', '2023-12-20 08:42:58'),
(679, 9, 1, '2023-12-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:42:58', '2023-12-20 08:42:58'),
(680, 11, 1, '2023-12-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:42:58', '2023-12-20 08:42:58'),
(681, 7, 1, '2023-12-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:42:58', '2023-12-20 08:42:58'),
(682, 23, 1, '2023-12-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:42:58', '2023-12-20 08:42:58'),
(683, 22, 1, '2023-12-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:42:58', '2023-12-20 08:42:58'),
(684, 14, 1, '2023-12-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:42:58', '2023-12-20 08:42:58'),
(685, 3, 1, '2023-12-13', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2023-12-20 08:42:58', '2023-12-20 08:46:07'),
(686, 12, 1, '2023-12-14', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:18', '2023-12-20 08:52:05'),
(687, 8, 1, '2023-12-14', 0, 2, 60, 0, NULL, '07:00:00', NULL, 1, '2023-12-20 08:43:18', '2023-12-20 08:52:05'),
(688, 19, 1, '2023-12-14', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:18', '2023-12-20 08:52:05'),
(689, 9, 1, '2023-12-14', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:18', '2023-12-20 08:52:05'),
(690, 11, 1, '2023-12-14', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:18', '2023-12-20 08:52:05'),
(691, 7, 1, '2023-12-14', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:18', '2023-12-20 08:52:05'),
(692, 23, 1, '2023-12-14', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:18', '2023-12-20 08:52:05'),
(693, 22, 1, '2023-12-14', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:18', '2023-12-20 08:52:05'),
(694, 14, 1, '2023-12-14', 0, 2, 60, 0, NULL, '07:00:00', NULL, 1, '2023-12-20 08:43:18', '2023-12-20 08:52:06'),
(695, 3, 1, '2023-12-14', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2023-12-20 08:43:18', '2023-12-20 08:52:06'),
(696, 12, 1, '2023-12-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:31', '2023-12-20 08:43:31'),
(697, 8, 1, '2023-12-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:31', '2023-12-20 08:43:31'),
(698, 19, 1, '2023-12-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:31', '2023-12-20 08:43:31'),
(699, 9, 1, '2023-12-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:31', '2023-12-20 08:43:31'),
(700, 11, 1, '2023-12-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:31', '2023-12-20 08:43:31'),
(701, 7, 1, '2023-12-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:31', '2023-12-20 08:43:31'),
(702, 23, 1, '2023-12-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:31', '2023-12-20 08:43:31'),
(703, 22, 1, '2023-12-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:31', '2023-12-20 08:43:31'),
(704, 14, 1, '2023-12-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:31', '2023-12-20 08:43:31'),
(705, 3, 1, '2023-12-15', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2023-12-20 08:43:31', '2023-12-20 08:46:07'),
(706, 12, 1, '2023-12-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:43', '2023-12-20 08:43:43'),
(707, 8, 1, '2023-12-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:43', '2023-12-20 08:43:43'),
(708, 19, 1, '2023-12-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:43', '2023-12-20 08:43:43'),
(709, 9, 1, '2023-12-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:43', '2023-12-20 08:43:43'),
(710, 11, 1, '2023-12-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:43', '2023-12-20 08:43:43'),
(711, 7, 1, '2023-12-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:43', '2023-12-20 08:43:43'),
(712, 23, 1, '2023-12-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:43', '2023-12-20 08:43:43'),
(713, 22, 1, '2023-12-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:43', '2023-12-20 08:43:43'),
(714, 14, 1, '2023-12-16', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:43', '2023-12-20 08:43:43'),
(715, 3, 1, '2023-12-16', 150, 3, 0, 0, NULL, '08:00:00', '15:30:00', 0, '2023-12-20 08:43:43', '2023-12-20 08:46:07'),
(716, 12, 1, '2023-12-18', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:57', '2023-12-20 08:43:57'),
(717, 8, 1, '2023-12-18', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:57', '2023-12-20 08:43:57'),
(718, 19, 1, '2023-12-18', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:57', '2023-12-20 08:43:57'),
(719, 9, 1, '2023-12-18', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:57', '2023-12-20 08:43:57'),
(720, 11, 1, '2023-12-18', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:57', '2023-12-20 08:43:57'),
(721, 7, 1, '2023-12-18', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:57', '2023-12-20 08:43:57'),
(722, 23, 1, '2023-12-18', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:57', '2023-12-20 08:43:57'),
(723, 22, 1, '2023-12-18', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:57', '2023-12-20 08:43:57'),
(724, 14, 1, '2023-12-18', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:43:57', '2023-12-20 08:43:57'),
(725, 3, 1, '2023-12-18', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2023-12-20 08:43:57', '2023-12-20 08:46:07'),
(726, 12, 1, '2023-12-19', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:44:10', '2023-12-20 08:44:10'),
(727, 8, 1, '2023-12-19', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:44:10', '2023-12-20 08:44:10'),
(728, 19, 1, '2023-12-19', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:44:10', '2023-12-20 08:44:10'),
(729, 9, 1, '2023-12-19', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:44:10', '2023-12-20 08:44:10'),
(730, 11, 1, '2023-12-19', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:44:10', '2023-12-20 08:44:10'),
(731, 7, 1, '2023-12-19', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:44:10', '2023-12-20 08:44:10'),
(732, 23, 1, '2023-12-19', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:44:10', '2023-12-20 08:44:10'),
(733, 22, 1, '2023-12-19', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:44:10', '2023-12-20 08:44:10'),
(734, 14, 1, '2023-12-19', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-20 08:44:10', '2023-12-20 08:44:10'),
(735, 3, 1, '2023-12-19', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2023-12-20 08:44:10', '2023-12-20 08:46:07'),
(736, 12, 1, '2023-12-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:23:54', '2023-12-27 08:23:54'),
(737, 8, 1, '2023-12-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:23:54', '2023-12-27 08:23:54'),
(738, 19, 1, '2023-12-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:23:54', '2023-12-27 08:23:54'),
(739, 9, 1, '2023-12-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:23:54', '2023-12-27 08:23:54'),
(740, 11, 1, '2023-12-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:23:54', '2023-12-27 08:23:54'),
(741, 7, 1, '2023-12-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:23:54', '2023-12-27 08:23:54'),
(742, 23, 1, '2023-12-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:23:54', '2023-12-27 08:23:54'),
(743, 22, 2, '2023-12-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:23:54', '2023-12-27 08:25:30'),
(744, 14, 1, '2023-12-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:23:54', '2023-12-27 08:23:54'),
(745, 3, 1, '2023-12-26', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:23:54', '2023-12-27 08:23:54'),
(746, 12, 1, '2023-12-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:10', '2023-12-27 08:24:10'),
(747, 8, 1, '2023-12-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:10', '2023-12-27 08:24:10'),
(748, 19, 1, '2023-12-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:10', '2023-12-27 08:24:10'),
(749, 9, 1, '2023-12-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:10', '2023-12-27 08:24:10'),
(750, 11, 1, '2023-12-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:10', '2023-12-27 08:24:10'),
(751, 7, 1, '2023-12-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:10', '2023-12-27 08:24:10'),
(752, 23, 1, '2023-12-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:10', '2023-12-27 08:24:10'),
(753, 22, 1, '2023-12-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:10', '2023-12-27 08:25:30'),
(754, 14, 1, '2023-12-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:10', '2023-12-27 08:24:10'),
(755, 3, 1, '2023-12-25', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:10', '2023-12-27 08:24:10'),
(756, 12, 1, '2023-12-23', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:27', '2023-12-27 08:24:27'),
(757, 8, 1, '2023-12-23', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:27', '2023-12-27 08:24:27'),
(758, 19, 1, '2023-12-23', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:27', '2023-12-27 08:24:27'),
(759, 9, 1, '2023-12-23', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:27', '2023-12-27 08:24:27'),
(760, 11, 1, '2023-12-23', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:27', '2023-12-27 08:24:27'),
(761, 7, 1, '2023-12-23', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:27', '2023-12-27 08:24:27'),
(762, 23, 1, '2023-12-23', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:27', '2023-12-27 08:24:27'),
(763, 22, 1, '2023-12-23', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:27', '2023-12-27 08:25:30'),
(764, 14, 1, '2023-12-23', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:27', '2023-12-27 08:24:27'),
(765, 3, 1, '2023-12-23', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:27', '2023-12-27 08:24:27'),
(766, 12, 1, '2023-12-22', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:47', '2023-12-27 08:24:47'),
(767, 8, 1, '2023-12-22', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:47', '2023-12-27 08:24:47'),
(768, 19, 1, '2023-12-22', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:47', '2023-12-27 08:24:47'),
(769, 9, 1, '2023-12-22', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:47', '2023-12-27 08:24:47'),
(770, 11, 1, '2023-12-22', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:47', '2023-12-27 08:24:47'),
(771, 7, 1, '2023-12-22', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:47', '2023-12-27 08:24:47'),
(772, 23, 1, '2023-12-22', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:47', '2023-12-27 08:24:47'),
(773, 22, 1, '2023-12-22', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:47', '2023-12-27 08:25:30'),
(774, 14, 1, '2023-12-22', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:47', '2023-12-27 08:24:47'),
(775, 3, 1, '2023-12-22', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:47', '2023-12-27 08:24:47'),
(776, 12, 1, '2023-12-21', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:57', '2023-12-27 08:24:57'),
(777, 8, 1, '2023-12-21', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:57', '2023-12-27 08:24:57'),
(778, 19, 1, '2023-12-21', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:57', '2023-12-27 08:24:57'),
(779, 9, 1, '2023-12-21', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:57', '2023-12-27 08:24:57'),
(780, 11, 1, '2023-12-21', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:57', '2023-12-27 08:24:57'),
(781, 7, 1, '2023-12-21', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:57', '2023-12-27 08:24:57'),
(782, 23, 1, '2023-12-21', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:57', '2023-12-27 08:24:57'),
(783, 22, 1, '2023-12-21', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:57', '2023-12-27 08:25:30'),
(784, 14, 1, '2023-12-21', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:57', '2023-12-27 08:24:57'),
(785, 3, 1, '2023-12-21', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:24:57', '2023-12-27 08:24:57'),
(786, 12, 1, '2023-12-20', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:25:07', '2023-12-27 08:25:07'),
(787, 8, 1, '2023-12-20', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:25:07', '2023-12-27 08:25:07'),
(788, 19, 1, '2023-12-20', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:25:07', '2023-12-27 08:25:07'),
(789, 9, 1, '2023-12-20', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:25:07', '2023-12-27 08:25:07'),
(790, 11, 1, '2023-12-20', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:25:07', '2023-12-27 08:25:07'),
(791, 7, 1, '2023-12-20', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:25:07', '2023-12-27 08:25:07'),
(792, 23, 1, '2023-12-20', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:25:07', '2023-12-27 08:25:07'),
(793, 22, 1, '2023-12-20', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:25:07', '2023-12-27 08:25:30'),
(794, 14, 1, '2023-12-20', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:25:07', '2023-12-27 08:25:07'),
(795, 3, 1, '2023-12-20', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2023-12-27 08:25:07', '2023-12-27 08:25:07'),
(796, 12, 1, '2023-12-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:16', '2024-01-02 12:02:16'),
(797, 8, 1, '2023-12-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:16', '2024-01-02 12:02:16'),
(798, 19, 1, '2023-12-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:16', '2024-01-02 12:02:16'),
(799, 9, 1, '2023-12-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:16', '2024-01-02 12:02:16'),
(800, 11, 1, '2023-12-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:16', '2024-01-02 12:02:16'),
(801, 7, 1, '2023-12-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:16', '2024-01-02 12:02:16'),
(802, 23, 1, '2023-12-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:16', '2024-01-02 12:02:16'),
(803, 22, 1, '2023-12-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:16', '2024-01-02 12:02:16'),
(804, 14, 1, '2023-12-27', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:16', '2024-01-02 12:02:16'),
(805, 3, 1, '2023-12-27', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2024-01-02 12:02:16', '2024-01-03 11:48:40'),
(806, 12, 1, '2023-12-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:25', '2024-01-02 12:02:25'),
(807, 8, 1, '2023-12-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:25', '2024-01-02 12:02:25'),
(808, 19, 1, '2023-12-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:25', '2024-01-02 12:02:25'),
(809, 9, 1, '2023-12-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:25', '2024-01-02 12:02:25'),
(810, 11, 1, '2023-12-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:25', '2024-01-02 12:02:25'),
(811, 7, 1, '2023-12-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:25', '2024-01-02 12:02:25'),
(812, 23, 1, '2023-12-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:26', '2024-01-02 12:02:26'),
(813, 22, 1, '2023-12-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:26', '2024-01-02 12:02:26'),
(814, 14, 1, '2023-12-28', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:26', '2024-01-02 12:02:26'),
(815, 3, 1, '2023-12-28', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2024-01-02 12:02:26', '2024-01-03 11:48:40'),
(816, 12, 1, '2023-12-29', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:34', '2024-01-02 12:02:34'),
(817, 8, 1, '2023-12-29', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:34', '2024-01-02 12:02:34'),
(818, 19, 1, '2023-12-29', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:34', '2024-01-02 12:02:34'),
(819, 9, 1, '2023-12-29', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:34', '2024-01-02 12:02:34'),
(820, 11, 1, '2023-12-29', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:34', '2024-01-02 12:02:34'),
(821, 7, 1, '2023-12-29', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:34', '2024-01-02 12:02:34'),
(822, 23, 1, '2023-12-29', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:34', '2024-01-02 12:02:34'),
(823, 22, 1, '2023-12-29', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:34', '2024-01-02 12:02:34'),
(824, 14, 1, '2023-12-29', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:34', '2024-01-02 12:02:34'),
(825, 3, 1, '2023-12-29', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2024-01-02 12:02:34', '2024-01-03 11:48:40'),
(826, 12, 1, '2023-12-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:42', '2024-01-02 12:02:42'),
(827, 8, 1, '2023-12-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:42', '2024-01-02 12:02:42'),
(828, 19, 1, '2023-12-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:42', '2024-01-02 12:02:42'),
(829, 9, 1, '2023-12-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:42', '2024-01-02 12:02:42'),
(830, 11, 1, '2023-12-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:42', '2024-01-02 12:02:42'),
(831, 7, 1, '2023-12-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:42', '2024-01-02 12:02:42'),
(832, 23, 1, '2023-12-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:42', '2024-01-02 12:02:42'),
(833, 22, 1, '2023-12-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:42', '2024-01-02 12:02:42'),
(834, 14, 1, '2023-12-30', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:42', '2024-01-02 12:02:42'),
(835, 3, 1, '2023-12-30', 150, 3, 0, 0, NULL, '08:00:00', '15:30:00', 0, '2024-01-02 12:02:42', '2024-01-03 11:48:40'),
(836, 12, 1, '2024-01-01', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:48', '2024-01-02 12:02:48'),
(837, 8, 1, '2024-01-01', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:48', '2024-01-02 12:02:48'),
(838, 19, 1, '2024-01-01', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:48', '2024-01-02 12:02:48'),
(839, 9, 1, '2024-01-01', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:48', '2024-01-02 12:02:48'),
(840, 11, 1, '2024-01-01', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:48', '2024-01-02 12:02:48'),
(841, 7, 1, '2024-01-01', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:48', '2024-01-02 12:02:48'),
(842, 23, 1, '2024-01-01', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:48', '2024-01-02 12:02:48'),
(843, 22, 1, '2024-01-01', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:48', '2024-01-02 12:02:48'),
(844, 14, 1, '2024-01-01', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:02:48', '2024-01-02 12:02:48'),
(845, 3, 1, '2024-01-01', 0, 0, 0, 0, NULL, '08:00:00', '18:00:00', 0, '2024-01-02 12:02:48', '2024-01-03 11:48:40'),
(846, 12, 1, '2024-01-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:03:13', '2024-01-02 12:03:13'),
(847, 8, 1, '2024-01-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:03:13', '2024-01-02 12:03:13'),
(848, 19, 1, '2024-01-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:03:13', '2024-01-02 12:03:13'),
(849, 9, 1, '2024-01-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:03:13', '2024-01-02 12:03:13'),
(850, 11, 1, '2024-01-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:03:13', '2024-01-02 12:03:13'),
(851, 7, 1, '2024-01-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:03:13', '2024-01-02 12:03:13'),
(852, 23, 1, '2024-01-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:03:13', '2024-01-02 12:03:13'),
(853, 22, 1, '2024-01-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:03:13', '2024-01-02 12:03:13'),
(854, 14, 1, '2024-01-02', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-02 12:03:13', '2024-01-02 12:03:13'),
(855, 3, 1, '2024-01-02', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2024-01-02 12:03:13', '2024-01-03 11:48:40'),
(856, 12, 1, '2024-01-03', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-03 08:07:44', '2024-01-05 18:13:13'),
(857, 8, 1, '2024-01-03', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-03 08:07:44', '2024-01-05 18:13:13'),
(858, 19, 1, '2024-01-03', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-03 08:07:44', '2024-01-05 18:13:13'),
(859, 9, 1, '2024-01-03', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-03 08:07:44', '2024-01-05 18:13:13'),
(860, 11, 1, '2024-01-03', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-03 08:07:44', '2024-01-03 11:39:26'),
(861, 7, 1, '2024-01-03', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-03 08:07:44', '2024-01-05 18:13:13'),
(862, 23, 1, '2024-01-03', 150, 5, 120, 0, NULL, '06:00:00', '20:30:00', 1, '2024-01-03 08:07:44', '2024-01-05 18:13:13'),
(863, 22, 1, '2024-01-03', 150, 5, 120, 0, NULL, '06:00:00', '20:30:00', 1, '2024-01-03 08:07:44', '2024-01-05 18:13:13'),
(864, 14, 1, '2024-01-03', 0, 3, 120, 0, NULL, '06:00:00', NULL, 1, '2024-01-03 08:07:44', '2024-01-05 18:13:13'),
(865, 3, 1, '2024-01-03', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2024-01-03 08:07:44', '2024-01-10 08:51:34'),
(866, 27, 1, '2024-01-03', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, NULL, '2024-01-05 18:13:13'),
(867, 12, 1, '2024-01-04', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-04 08:34:06', '2024-01-05 17:54:41'),
(868, 27, 1, '2024-01-04', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-04 08:34:06', '2024-01-05 17:54:41'),
(869, 8, 1, '2024-01-04', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-04 08:34:06', '2024-01-05 17:54:41'),
(870, 19, 1, '2024-01-04', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-04 08:34:06', '2024-01-05 17:54:41'),
(871, 9, 1, '2024-01-04', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-04 08:34:06', '2024-01-05 17:54:41'),
(872, 7, 1, '2024-01-04', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2024-01-04 08:34:06', '2024-01-05 17:54:41'),
(873, 23, 1, '2024-01-04', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2024-01-04 08:34:06', '2024-01-05 17:54:41'),
(874, 22, 1, '2024-01-04', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-04 08:34:06', '2024-01-05 17:54:41'),
(875, 14, 1, '2024-01-04', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-04 08:34:06', '2024-01-05 17:54:41'),
(876, 3, 1, '2024-01-04', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-04 08:34:06', '2024-01-10 08:51:34');
INSERT INTO `asistencia` (`id`, `personalId`, `asistenciaId`, `fecha`, `horasExtra`, `totalHorasExtra`, `horasAnticipada`, `horasRetraso`, `comentario`, `hEntrada`, `hSalida`, `entradaAnticipada`, `created_at`, `updated_at`) VALUES
(877, 12, 1, '2024-01-08', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:05', '2024-01-08 19:58:20'),
(878, 27, 1, '2024-01-08', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:05', '2024-01-08 19:58:20'),
(879, 8, 1, '2024-01-08', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:05', '2024-01-08 19:58:20'),
(880, 19, 1, '2024-01-08', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:05', '2024-01-08 19:58:20'),
(881, 9, 2, '2024-01-08', 0, 0, 0, 0, NULL, NULL, NULL, 0, '2024-01-08 13:48:05', '2024-01-08 19:58:20'),
(882, 7, 1, '2024-01-08', 120, 3, 0, 0, NULL, '08:00:00', '20:00:00', 0, '2024-01-08 13:48:05', '2024-01-08 19:58:20'),
(883, 23, 1, '2024-01-08', 120, 3, 0, 0, NULL, '08:00:00', '20:00:00', 0, '2024-01-08 13:48:05', '2024-01-08 19:58:20'),
(884, 22, 1, '2024-01-08', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:05', '2024-01-08 19:58:20'),
(885, 14, 1, '2024-01-08', 120, 3, 0, 0, NULL, '08:00:00', '20:00:00', 0, '2024-01-08 13:48:05', '2024-01-08 19:58:20'),
(886, 3, 1, '2024-01-08', 135, 3, 0, 0, NULL, '08:00:00', '20:15:00', 0, '2024-01-08 13:48:05', '2024-01-10 08:51:34'),
(887, 12, 1, '2024-01-05', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:23', '2024-01-08 13:48:23'),
(888, 27, 1, '2024-01-05', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:23', '2024-01-08 13:48:23'),
(889, 8, 1, '2024-01-05', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:23', '2024-01-08 13:48:23'),
(890, 19, 1, '2024-01-05', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:23', '2024-01-08 13:48:23'),
(891, 9, 1, '2024-01-05', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:23', '2024-01-08 13:48:23'),
(892, 7, 1, '2024-01-05', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:23', '2024-01-08 13:48:23'),
(893, 23, 1, '2024-01-05', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:23', '2024-01-08 13:48:23'),
(894, 22, 1, '2024-01-05', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:23', '2024-01-08 13:48:23'),
(895, 14, 1, '2024-01-05', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:23', '2024-01-08 13:48:23'),
(896, 3, 1, '2024-01-05', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:23', '2024-01-10 08:51:34'),
(897, 12, 1, '2024-01-06', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:31', '2024-01-08 20:00:34'),
(898, 27, 1, '2024-01-06', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:31', '2024-01-08 20:00:34'),
(899, 8, 1, '2024-01-06', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:31', '2024-01-08 20:00:34'),
(900, 19, 1, '2024-01-06', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:31', '2024-01-08 20:00:34'),
(901, 9, 1, '2024-01-06', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:31', '2024-01-08 20:00:34'),
(902, 7, 1, '2024-01-06', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-08 13:48:31', '2024-01-08 20:00:34'),
(903, 23, 1, '2024-01-06', 90, 2, 0, 0, NULL, '08:00:00', '14:30:00', 0, '2024-01-08 13:48:31', '2024-01-08 20:00:34'),
(904, 22, 1, '2024-01-06', 90, 2, 0, 0, NULL, '08:00:00', '14:30:00', 0, '2024-01-08 13:48:31', '2024-01-08 20:00:34'),
(905, 14, 1, '2024-01-06', 90, 2, 0, 0, NULL, '08:00:00', '14:30:00', 0, '2024-01-08 13:48:31', '2024-01-08 20:00:34'),
(906, 3, 1, '2024-01-06', 91, 2, 0, 0, NULL, '08:00:00', '14:31:00', 0, '2024-01-08 13:48:31', '2024-01-10 08:51:34'),
(907, 12, 1, '2024-01-09', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-09 08:13:41', '2024-01-10 08:50:27'),
(908, 27, 1, '2024-01-09', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-09 08:13:41', '2024-01-10 08:50:27'),
(909, 8, 1, '2024-01-09', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-09 08:13:41', '2024-01-10 08:50:27'),
(910, 19, 1, '2024-01-09', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-09 08:13:41', '2024-01-10 08:50:27'),
(911, 9, 1, '2024-01-09', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-09 08:13:41', '2024-01-10 08:50:27'),
(912, 7, 2, '2024-01-09', 0, 0, 0, 0, NULL, NULL, NULL, 0, '2024-01-09 08:13:41', '2024-01-10 08:50:27'),
(913, 23, 1, '2024-01-09', 120, 4, 60, 0, NULL, '07:00:00', '20:00:00', 1, '2024-01-09 08:13:41', '2024-01-10 08:50:27'),
(914, 22, 1, '2024-01-09', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-09 08:13:41', '2024-01-10 08:50:27'),
(915, 14, 1, '2024-01-09', 120, 4, 60, 0, NULL, '07:00:00', '20:00:00', 1, '2024-01-09 08:13:41', '2024-01-10 08:50:27'),
(916, 3, 1, '2024-01-09', 120, 3, 0, 0, NULL, '08:00:00', '20:00:00', 0, '2024-01-09 08:13:41', '2024-01-10 08:51:34'),
(917, 12, 2, '2024-01-15', 0, 0, 0, 61, NULL, NULL, NULL, 0, '2024-01-15 08:40:13', '2024-01-15 09:01:00'),
(918, 27, 1, '2024-01-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:40:13', '2024-01-15 09:01:00'),
(919, 8, 1, '2024-01-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:40:13', '2024-01-15 09:01:00'),
(920, 19, 1, '2024-01-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:40:13', '2024-01-15 09:01:00'),
(921, 9, 1, '2024-01-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:40:13', '2024-01-15 09:01:00'),
(922, 7, 1, '2024-01-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:40:13', '2024-01-15 09:01:00'),
(923, 23, 1, '2024-01-15', 0, 2, 60, 0, NULL, '07:00:00', NULL, 1, '2024-01-15 08:40:13', '2024-01-15 09:01:00'),
(924, 22, 1, '2024-01-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:40:13', '2024-01-15 09:01:00'),
(925, 14, 1, '2024-01-15', 0, 0, 0, 0, NULL, '07:00:00', NULL, 0, '2024-01-15 08:40:13', '2024-01-15 09:01:00'),
(926, 3, 1, '2024-01-15', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:40:13', '2024-01-15 09:01:00'),
(927, 12, 1, '2024-01-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:42:13', '2024-01-15 08:42:13'),
(928, 27, 1, '2024-01-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:42:13', '2024-01-15 08:42:13'),
(929, 8, 1, '2024-01-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:42:13', '2024-01-15 08:42:13'),
(930, 19, 1, '2024-01-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:42:13', '2024-01-15 08:42:13'),
(931, 9, 1, '2024-01-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:42:13', '2024-01-15 08:42:13'),
(932, 7, 1, '2024-01-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:42:13', '2024-01-15 08:42:13'),
(933, 23, 1, '2024-01-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:42:13', '2024-01-15 08:42:13'),
(934, 22, 1, '2024-01-13', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:42:13', '2024-01-15 08:42:13'),
(935, 14, 1, '2024-01-13', 60, 2, 0, 0, NULL, '08:00:00', '14:00:00', 0, '2024-01-15 08:42:13', '2024-01-15 08:42:13'),
(936, 3, 1, '2024-01-13', 120, 3, 0, 0, NULL, '08:00:00', '15:00:00', 0, '2024-01-15 08:42:13', '2024-01-15 08:42:13'),
(937, 12, 1, '2024-01-12', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:43:43', '2024-01-15 08:43:43'),
(938, 27, 1, '2024-01-12', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:43:43', '2024-01-15 08:43:43'),
(939, 8, 1, '2024-01-12', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:43:43', '2024-01-15 08:43:43'),
(940, 19, 1, '2024-01-12', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:43:43', '2024-01-15 08:43:43'),
(941, 9, 1, '2024-01-12', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:43:43', '2024-01-15 08:43:43'),
(942, 7, 1, '2024-01-12', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:43:43', '2024-01-15 08:43:43'),
(943, 23, 1, '2024-01-12', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:43:43', '2024-01-15 08:43:43'),
(944, 22, 1, '2024-01-12', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 08:43:43', '2024-01-15 08:43:43'),
(945, 14, 1, '2024-01-12', 0, 0, 0, 0, NULL, '08:00:00', '07:00:00', 0, '2024-01-15 08:43:43', '2024-01-15 08:43:43'),
(946, 3, 1, '2024-01-12', 150, 3, 0, 0, NULL, '08:00:00', '20:30:00', 0, '2024-01-15 08:43:43', '2024-01-15 08:43:43'),
(947, 12, 1, '2024-01-10', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:16', '2024-01-15 09:57:31'),
(948, 27, 1, '2024-01-10', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:16', '2024-01-15 09:57:31'),
(949, 8, 1, '2024-01-10', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:16', '2024-01-15 09:57:31'),
(950, 19, 1, '2024-01-10', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:16', '2024-01-15 09:57:31'),
(951, 9, 1, '2024-01-10', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:16', '2024-01-15 09:57:31'),
(952, 7, 2, '2024-01-10', 0, 0, 0, 0, NULL, NULL, NULL, 0, '2024-01-15 09:00:16', '2024-01-15 09:57:31'),
(953, 23, 1, '2024-01-10', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:16', '2024-01-15 09:57:31'),
(954, 22, 1, '2024-01-10', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:16', '2024-01-15 09:57:31'),
(955, 14, 1, '2024-01-10', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:16', '2024-01-15 09:57:31'),
(956, 3, 1, '2024-01-10', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:16', '2024-01-15 09:57:31'),
(957, 12, 1, '2024-01-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:25', '2024-01-15 09:00:25'),
(958, 27, 1, '2024-01-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:25', '2024-01-15 09:00:25'),
(959, 8, 1, '2024-01-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:25', '2024-01-15 09:00:25'),
(960, 19, 1, '2024-01-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:25', '2024-01-15 09:00:25'),
(961, 9, 1, '2024-01-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:25', '2024-01-15 09:00:25'),
(962, 7, 1, '2024-01-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:25', '2024-01-15 09:00:25'),
(963, 23, 1, '2024-01-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:25', '2024-01-15 09:00:25'),
(964, 22, 1, '2024-01-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:25', '2024-01-15 09:00:25'),
(965, 14, 1, '2024-01-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:25', '2024-01-15 09:00:25'),
(966, 3, 1, '2024-01-11', 0, 0, 0, 0, NULL, '08:00:00', NULL, 0, '2024-01-15 09:00:25', '2024-01-15 09:00:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiario`
--

DROP TABLE IF EXISTS `beneficiario`;
CREATE TABLE IF NOT EXISTS `beneficiario` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `personalId` bigint(20) UNSIGNED NOT NULL,
  `nombres` varchar(255) DEFAULT NULL,
  `apellidoP` varchar(255) DEFAULT NULL,
  `apellidoM` varchar(255) DEFAULT NULL,
  `particular` varchar(255) DEFAULT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `nacimiento` datetime DEFAULT NULL,
  `emailB` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_beneficiario_personalId` (`personalId`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `beneficiario`
--

INSERT INTO `beneficiario` (`id`, `personalId`, `nombres`, `apellidoP`, `apellidoM`, `particular`, `celular`, `nacimiento`, `emailB`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, 'Livier', 'Placencia', 'Gómez', NULL, '33 2339 1241', '1971-02-10 00:00:00', NULL),
(4, 4, 'Melina', 'López', 'Orozco', NULL, '33 1326 5762', '1978-04-04 00:00:00', NULL),
(5, 5, 'Rosa Elia', 'Garcia', 'Lopez', NULL, '33 2068 0938', '1979-09-11 00:00:00', NULL),
(6, 6, 'Claudia Ivette', 'Cobian', 'Franco', NULL, '33 2169 5621', '1998-10-04 00:00:00', NULL),
(7, 7, 'Isabella', 'Magaña', 'Cuevas', NULL, '34 1198 8872', '2015-01-02 00:00:00', NULL),
(8, 8, 'Gabriela', 'Garabito', 'Marín', NULL, '33 1250 0558', '1990-01-27 00:00:00', NULL),
(9, 9, 'Edson Alejandro', 'Fajardo', 'Céspedes', NULL, '33 2705 5746', '2000-07-17 00:00:00', NULL),
(10, 10, 'María Monserrat', 'Razón', 'Rodríguez', NULL, '33 2937 1142', '2003-07-27 00:00:00', NULL),
(11, 11, 'Pedro', 'López', 'Gómez', '31 2121 1013', NULL, '2003-02-22 00:00:00', NULL),
(12, 12, 'Mónica', 'Márquez', 'Álvarez', NULL, '33 1517 8551', '1982-09-20 00:00:00', NULL),
(13, 13, 'Marcela', 'Villareal', 'Carranza', NULL, '33 3624 9831', '1973-04-26 00:00:00', NULL),
(14, 14, 'Cinthya Leticia', 'Sánchez', 'Padrón', NULL, '33 3598 3043', '1993-01-10 00:00:00', NULL),
(15, 15, 'Milagros Zulema', 'Ramírez', 'Aranda', NULL, '33 1811 2102', '1979-12-24 00:00:00', NULL),
(16, 16, 'Víctor Saul', 'Finkelstein', 'London', NULL, '33 3189 2270', '1967-12-28 00:00:00', NULL),
(17, 17, 'Luis Ricardo', 'Rodríguez', 'Martínez', NULL, '33 3359 8907', '1963-02-25 00:00:00', NULL),
(18, 18, 'María Elena', 'Arana', 'Pérez', NULL, '33 23 88 58 20', '1970-11-19 00:00:00', NULL),
(19, 19, 'Mariana', 'Salmerón', 'Duran', NULL, '33 33 94 67 61', '1980-06-09 00:00:00', NULL),
(20, 20, 'María Santos', 'Luna', 'Sánchez', NULL, '33 2629 6992', '1966-04-07 00:00:00', NULL),
(21, 21, 'Kevin Yandel', 'Navarrete', 'Moran', NULL, '33 1326 4609', '2009-07-18 00:00:00', NULL),
(22, 22, 'Georgina', 'Espinosa', 'Caballero', NULL, '71 5307 5657', '1970-12-16 00:00:00', NULL),
(23, 23, 'FLOR BERENICE', 'MONTES DE OCA', 'JIMENEZ', NULL, '3366279971', '1994-01-08 00:00:00', NULL),
(24, 27, 'YESSICA VIOLETA CELENE', 'RAMOS', 'ORNELAS', NULL, '33 12999120', '1995-09-07 00:00:00', 'yessicavioletaramosornelas@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacoras`
--

DROP TABLE IF EXISTS `bitacoras`;
CREATE TABLE IF NOT EXISTS `bitacoras` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `codigo` varchar(10) NOT NULL,
  `version` int(8) DEFAULT NULL,
  `comentario` text,
  `activa` tinyint(1) NOT NULL DEFAULT '1',
  `renovacion` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `frecuenciaId` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_bitacoras_frecuencia` (`frecuenciaId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bitacoras`
--

INSERT INTO `bitacoras` (`id`, `nombre`, `codigo`, `version`, `comentario`, `activa`, `renovacion`, `created_at`, `updated_at`, `frecuenciaId`) VALUES
(6, 'Bitácora Semanal de Tractocamiones Tres Ejes', 'TR-01', 1, 'Bitácora semanal para tractocamiones de tres ejes', 1, 0, '2023-11-30 12:17:32', '2023-12-01 11:44:18', 2),
(7, 'Bitácora Semanal de Tractocamiones Dos Ejes', 'TR-02', 1, 'Bitácora semanal para tractocamiones de dos ejes', 1, 0, '2023-12-01 11:38:17', '2023-12-01 11:38:17', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacorasEquipos`
--

DROP TABLE IF EXISTS `bitacorasEquipos`;
CREATE TABLE IF NOT EXISTS `bitacorasEquipos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bitacoraId` bigint(20) UNSIGNED NOT NULL,
  `maquinariaId` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_bitacoras_bitacoraId` (`bitacoraId`),
  KEY `FK_bitacoras_maquinariaId` (`maquinariaId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bitacorasEquipos`
--

INSERT INTO `bitacorasEquipos` (`id`, `bitacoraId`, `maquinariaId`, `created_at`, `updated_at`) VALUES
(12, 6, 13, '2023-11-30 12:45:29', '2023-11-30 12:45:29'),
(13, 6, 21, '2023-11-30 12:45:29', '2023-11-30 12:45:29'),
(14, 7, 5, '2023-12-01 11:44:01', '2023-12-01 11:44:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajaChica`
--

DROP TABLE IF EXISTS `cajaChica`;
CREATE TABLE IF NOT EXISTS `cajaChica` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dia` date NOT NULL,
  `concepto` bigint(20) UNSIGNED NOT NULL,
  `comprobanteId` bigint(20) UNSIGNED DEFAULT NULL,
  `ncomprobante` varchar(200) DEFAULT '6',
  `cliente` varchar(200) DEFAULT NULL,
  `obra` bigint(20) UNSIGNED DEFAULT NULL,
  `equipo` bigint(20) UNSIGNED DEFAULT NULL,
  `personal` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(200) DEFAULT NULL,
  `cantidad` float(10,2) NOT NULL,
  `total` float(10,2) DEFAULT NULL,
  `comentario` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `servicioTrasporteId` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cajachica_concepto` (`concepto`),
  KEY `FK_cajachica_obra` (`obra`),
  KEY `FK_cajachica_equipo` (`equipo`),
  KEY `FK_cajachica_personal` (`personal`),
  KEY `FK_cajachica_comprobanteId` (`comprobanteId`),
  KEY `FK_cajachica_servicioTrasporteId` (`servicioTrasporteId`)
) ENGINE=InnoDB AUTO_INCREMENT=580 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cajaChica`
--

INSERT INTO `cajaChica` (`id`, `dia`, `concepto`, `comprobanteId`, `ncomprobante`, `cliente`, `obra`, `equipo`, `personal`, `tipo`, `cantidad`, `total`, `comentario`, `created_at`, `updated_at`, `servicioTrasporteId`) VALUES
(12, '2023-09-04', 1, 2, '123', NULL, NULL, 1, 1, '3', 100.00, -100.00, 'Test de prueba...', '2023-09-04 12:48:17', '2023-09-04 12:53:03', NULL),
(13, '2023-09-04', 2, 4, '1234', NULL, NULL, 5, 5, '2', 100.50, -200.50, NULL, '2023-09-04 17:43:36', '2023-09-16 18:14:32', NULL),
(14, '2023-09-05', 2, 4, '1235', NULL, NULL, 5, 13, '2', 200.00, -400.50, NULL, '2023-09-05 08:47:23', '2023-09-16 18:14:32', NULL),
(15, '2023-09-12', 2, 4, '1234', NULL, NULL, 5, 3, '1', 100.00, -300.50, NULL, '2023-09-12 10:33:10', '2023-09-16 18:14:32', NULL),
(16, '2023-09-08', 1, 1, '1254', NULL, NULL, 1, 2, '2', 1000.00, -1300.50, NULL, '2023-09-15 08:27:04', '2023-09-16 18:14:32', NULL),
(18, '2023-09-29', 1, 2, '1', '2', 1, 8, 1, '1', 1000.00, 399.50, NULL, '2023-10-04 16:20:16', '2023-10-04 16:20:16', NULL),
(20, '2023-10-09', 1, 2, '1', '1', 6, 1, 16, '1', 1180.00, 1579.50, NULL, '2023-10-09 09:19:09', '2023-10-09 09:19:09', NULL),
(23, '2023-10-09', 2, 2, '1', '1', 6, 1, 16, '1', 13959.00, 15538.50, NULL, '2023-10-09 09:36:45', '2023-10-13 12:59:11', NULL),
(24, '2023-10-09', 26, 4, '1480', '2', 4, 5, 22, '2', 2665.00, 12873.50, 'Factura 3070 y 3069 Agregados Copalita. 20 de propina al operador', '2023-10-09 18:15:47', '2023-10-13 12:59:11', NULL),
(25, '2023-10-09', 19, 4, '1481', '2', 4, 5, 22, '2', 260.00, 12613.50, NULL, '2023-10-09 18:17:56', '2023-10-13 12:59:11', NULL),
(26, '2023-10-09', 8, 4, '1482', '2', 4, 5, 22, '2', 1420.00, 11193.50, '20 de propina para operador', '2023-10-09 18:19:14', '2023-10-13 12:59:11', NULL),
(27, '2023-10-09', 19, 4, '1483', '2', 4, 5, 22, '2', 260.00, 10933.50, NULL, '2023-10-09 18:20:53', '2023-10-13 12:59:11', NULL),
(28, '2023-10-09', 27, 4, '1391', '2', 5, 21, 12, '2', 1343.00, 9590.50, '20 pesos de propina. Folio de factura 3068', '2023-10-09 18:27:53', '2023-10-13 12:59:11', NULL),
(29, '2023-10-09', 20, 4, '1392', '2', 4, 21, 12, '2', 130.00, 9460.50, NULL, '2023-10-09 18:30:09', '2023-10-13 12:59:11', NULL),
(30, '2023-10-09', 3, 4, '1428', '2', 7, 13, 8, '2', 200.00, 9260.50, NULL, '2023-10-09 18:34:00', '2023-10-13 12:59:11', NULL),
(31, '2023-10-09', 3, 4, '1429', '2', 4, 13, 8, '2', 300.00, 8960.50, NULL, '2023-10-09 18:34:50', '2023-10-13 12:59:11', NULL),
(32, '2023-10-10', 23, 4, '1637', '2', 3, 22, 20, '2', 0.01, 8960.49, NULL, '2023-10-11 10:52:48', '2023-10-13 12:59:11', NULL),
(33, '2023-10-11', 3, 4, '1484', '2', 7, 21, 22, '2', 300.00, 8660.49, NULL, '2023-10-12 10:21:36', '2023-10-13 12:59:11', NULL),
(34, '2023-10-11', 11, 4, '1393', '2', 8, 5, 12, '2', 2204.00, 6456.49, 'CON FACTURA', '2023-10-12 10:25:53', '2023-10-13 12:59:11', NULL),
(35, '2023-10-11', 20, 4, '1394', '2', 4, 5, 12, '2', 130.00, 6326.49, NULL, '2023-10-12 10:28:01', '2023-10-13 12:59:11', NULL),
(36, '2023-10-11', 33, 1, '25177', '1', 6, 13, 14, '2', 452.28, 5874.21, NULL, '2023-10-12 11:20:35', '2023-10-13 12:59:11', NULL),
(37, '2023-10-11', 33, 2, '11041', '1', 6, 13, 14, '2', 20.00, 5854.21, NULL, '2023-10-12 11:23:23', '2023-10-13 12:59:11', NULL),
(38, '2023-10-11', 33, 1, '247332', '1', 6, 13, 14, '2', 401.00, 5453.21, NULL, '2023-10-12 11:27:56', '2023-10-13 12:59:11', NULL),
(39, '2023-10-11', 33, 1, 'FTE7908', '1', 6, 11, 14, '2', 55.74, 5397.47, NULL, '2023-10-12 11:30:13', '2023-10-13 12:59:11', NULL),
(40, '2023-10-11', 33, 1, '19106', '1', 6, 14, 14, '2', 120.00, 5277.47, NULL, '2023-10-12 11:31:43', '2023-10-13 12:59:11', NULL),
(41, '2023-10-12', 20, 4, '1395', '2', 4, 5, 12, '2', 130.00, 5147.47, NULL, '2023-10-13 09:49:36', '2023-10-13 12:59:11', NULL),
(42, '2023-10-12', 20, 4, '1396', '2', 4, 5, 12, '2', 130.00, 5017.47, NULL, '2023-10-13 09:50:12', '2023-10-13 12:59:11', NULL),
(43, '2023-10-12', 20, 4, '1397', '2', 4, 5, 12, '2', 130.00, 4887.47, NULL, '2023-10-13 09:50:47', '2023-10-13 12:59:11', NULL),
(44, '2023-10-12', 3, 4, '1430', '2', 4, 13, 8, '2', 300.00, 4587.47, NULL, '2023-10-13 09:51:57', '2023-10-13 12:59:11', NULL),
(45, '2023-10-12', 7, 4, '1486', '2', 4, 15, 22, '2', 280.00, 4307.47, NULL, '2023-10-13 09:53:07', '2023-10-13 12:59:11', NULL),
(46, '2023-10-13', 4, 2, '0001', '1', 6, 1, 16, '1', 7500.00, 11807.47, NULL, '2023-10-13 11:44:09', '2023-10-13 12:59:11', NULL),
(47, '2023-10-13', 33, 2, '0001', '1', 6, 22, 14, '2', 200.00, 11607.47, NULL, '2023-10-13 12:42:32', '2023-10-13 12:59:11', NULL),
(48, '2023-10-13', 18, 2, '66023', '1', 6, 17, 14, '2', 302.45, 11305.02, NULL, '2023-10-13 12:44:14', '2023-10-13 12:59:11', NULL),
(49, '2023-10-13', 33, 1, '19114', '1', 6, 17, 14, '2', 120.00, 11185.02, NULL, '2023-10-13 12:45:10', '2023-10-13 12:59:11', NULL),
(50, '2023-10-13', 20, 4, '1398', '2', 4, 5, 12, '2', 130.00, 11055.02, NULL, '2023-10-13 18:43:49', '2023-10-13 18:43:49', NULL),
(51, '2023-10-13', 20, 4, '1399', '2', 4, 5, 12, '2', 130.00, 10925.02, NULL, '2023-10-13 18:44:27', '2023-10-13 18:44:27', NULL),
(52, '2023-10-13', 20, 4, '1400', '2', 8, 5, 12, '2', 630.00, 10295.02, '$500.00 de Galleros', '2023-10-13 18:45:41', '2023-10-13 18:45:41', NULL),
(53, '2023-10-13', 3, 4, '1431', '2', 7, 13, 8, '2', 400.00, 9895.02, NULL, '2023-10-13 18:49:37', '2023-10-13 18:49:37', NULL),
(54, '2023-10-13', 8, 4, '1432', '2', 4, 13, 8, '2', 1624.00, 8271.02, NULL, '2023-10-13 18:50:28', '2023-10-13 18:50:28', NULL),
(55, '2023-10-13', 8, 4, '1487', '2', 3, 21, 22, '2', 1624.00, 6647.02, NULL, '2023-10-14 09:09:56', '2023-10-14 09:09:56', NULL),
(56, '2023-10-14', 4, 2, '01', '1', 6, 1, 16, '1', 4800.00, 11447.02, NULL, '2023-10-14 12:31:41', '2023-10-16 12:35:28', NULL),
(57, '2023-10-13', 27, 2, '0002', '1', 6, 13, 8, '2', 900.00, 5747.02, '2 MTS Grava para el taller', '2023-10-16 12:20:34', '2023-10-16 12:25:40', NULL),
(58, '2023-10-13', 10, 2, '0003', '1', 6, 13, 8, '2', 440.00, 5307.02, '2 MTS de arena para el taller', '2023-10-16 12:21:11', '2023-10-16 12:25:58', NULL),
(59, '2023-10-14', 20, 4, '1405', '2', 12, 5, 12, '2', 130.00, 11317.02, NULL, '2023-10-16 12:23:24', '2023-10-16 12:35:28', NULL),
(60, '2023-10-14', 10, 2, '0004', '1', 6, 13, 8, '2', 800.00, 10517.02, '4 MTS arena para el taller', '2023-10-16 12:30:17', '2023-10-16 12:35:28', NULL),
(61, '2023-10-14', 18, 2, '0005', '1', 6, 1, 16, '2', 4000.00, 6517.02, 'Colado en taller', '2023-10-16 12:35:10', '2023-10-16 12:35:28', NULL),
(62, '2023-10-16', 3, 4, '1433', '2', 5, 13, 8, '2', 300.00, 6217.02, NULL, '2023-10-16 17:53:11', '2023-10-16 17:53:11', NULL),
(63, '2023-10-16', 3, 4, '1434', '2', 5, 13, 8, '2', 300.00, 5917.02, NULL, '2023-10-16 17:54:40', '2023-10-16 17:54:40', NULL),
(66, '2023-10-16', 1, 1, '1', NULL, NULL, 1, 16, '1', 4777.52, NULL, 'Ingreso hecho automatico por corte ', '2023-10-17 09:03:48', '2023-10-17 09:03:48', NULL),
(67, '2023-10-16', 3, 4, '1435', '2', 4, 13, 8, '2', 300.00, -300.00, NULL, '2023-10-18 08:28:52', '2023-10-18 09:48:28', NULL),
(68, '2023-10-16', 20, 4, '1406', '2', 4, 5, 12, '2', 130.00, -430.00, NULL, '2023-10-18 08:30:10', '2023-10-18 09:48:38', NULL),
(69, '2023-10-16', 20, 4, '1407', '2', 8, 5, 12, '2', 630.00, -1060.00, NULL, '2023-10-18 08:30:54', '2023-10-18 09:48:46', NULL),
(70, '2023-10-17', 42, 4, '1408', '2', 7, 5, 8, '2', 200.00, -1260.00, NULL, '2023-10-18 09:49:56', '2023-10-19 08:22:48', NULL),
(71, '2023-10-17', 42, 4, '1409', '2', 7, 5, 8, '2', 200.00, -1460.00, NULL, '2023-10-18 09:51:37', '2023-10-19 08:23:20', NULL),
(72, '2023-10-17', 43, 4, '1410', '2', 7, 26, 8, '2', 1.00, -1461.00, NULL, '2023-10-18 09:53:35', '2023-10-19 08:23:49', NULL),
(73, '2023-10-17', 3, 4, '1488', '2', 4, 21, 22, '2', 300.00, -1761.00, NULL, '2023-10-18 09:55:17', '2023-10-19 08:24:03', NULL),
(74, '2023-10-17', 3, 4, '1489', '2', 4, 21, 22, '2', 300.00, -2061.00, NULL, '2023-10-18 09:56:01', '2023-10-19 08:24:13', NULL),
(75, '2023-10-17', 3, 4, '1490', '2', 4, 21, 22, '2', 300.00, -2361.00, NULL, '2023-10-18 09:58:39', '2023-10-19 08:24:26', NULL),
(76, '2023-10-18', 2, 2, '1', '1', 6, NULL, 16, '1', 10223.00, 7862.00, NULL, '2023-10-18 09:59:25', '2023-10-19 08:23:49', NULL),
(77, '2023-10-18', 28, 4, '1638', '2', 4, 22, 20, '2', 1.00, 7861.00, 'Salida 9:00 hrs, llegada 15:00 hrs', '2023-10-19 08:12:22', '2023-10-19 08:24:43', NULL),
(78, '2023-10-18', 19, 4, '1491', '2', 4, 21, 22, '2', 260.00, 7601.00, NULL, '2023-10-19 08:14:30', '2023-10-19 08:24:58', NULL),
(79, '2023-10-18', 19, 4, '1436', '2', 5, 13, 8, '2', 300.00, 7301.00, NULL, '2023-10-19 08:17:45', '2023-10-19 08:25:09', NULL),
(80, '2023-10-18', 19, 4, '1437', '2', 5, 13, 8, '2', 300.00, 7001.00, NULL, '2023-10-19 08:19:36', '2023-10-19 08:25:18', NULL),
(81, '2023-10-18', 20, 4, '1645', '2', 4, 5, 12, '2', 150.00, 6851.00, NULL, '2023-10-19 08:27:56', '2023-10-23 09:39:54', NULL),
(82, '2023-10-18', 11, 4, '1646', '2', 8, 5, 12, '2', 2204.00, 4647.00, NULL, '2023-10-19 08:29:09', '2023-10-19 08:29:19', NULL),
(83, '2023-10-18', 20, 4, '1647', '2', 5, 5, 12, '2', 150.00, 4497.00, NULL, '2023-10-19 08:30:35', '2023-10-19 08:30:48', NULL),
(86, '2023-10-19', 8, 4, '1438', '2', 5, 13, 8, '2', 1740.00, 2757.00, NULL, '2023-10-19 17:41:35', '2023-10-19 18:00:33', NULL),
(87, '2023-10-19', 3, 4, '1439', '2', 5, 13, 8, '2', 300.00, 2457.00, NULL, '2023-10-19 17:43:17', '2023-10-19 18:00:24', NULL),
(88, '1998-12-09', 44, 3, '70135', '3', 9, 34, 12, '2', 1.00, 2456.00, 'Ipsum totam ut quas', '2023-10-19 17:44:26', '2023-10-19 17:44:26', NULL),
(89, '2023-10-19', 3, 4, '1440', '2', 4, 13, 8, '2', 300.00, 2157.00, NULL, '2023-10-19 17:44:27', '2023-10-19 18:00:24', NULL),
(92, '2023-10-19', 8, 4, '1492', '2', 4, 21, 22, '2', 1740.00, 417.00, NULL, '2023-10-19 17:55:24', '2023-10-19 18:00:24', NULL),
(93, '2023-10-19', 19, 4, '1493', '2', 4, 21, 22, '2', 260.00, 157.00, NULL, '2023-10-19 17:57:30', '2023-10-19 18:00:24', NULL),
(94, '2023-10-19', 20, 4, '1494', '2', 4, 5, 12, '2', 130.00, 27.00, NULL, '2023-10-19 18:15:14', '2023-10-19 18:15:14', NULL),
(95, '2023-10-19', 20, 4, '1648', '2', 4, 5, 12, '2', 130.00, -103.00, NULL, '2023-10-19 18:16:05', '2023-10-19 18:16:05', NULL),
(96, '2023-10-19', 20, 4, '1649', '2', 4, 5, 12, '2', 130.00, -233.00, NULL, '2023-10-19 18:16:45', '2023-10-19 18:16:45', NULL),
(97, '2023-10-20', 4, 2, '1', '1', 6, NULL, 16, '1', 7500.00, 7267.00, NULL, '2023-10-20 08:38:07', '2023-10-20 08:38:07', NULL),
(98, '2023-10-20', 26, 4, '1582', '2', 4, 21, 22, '2', 2664.00, 4603.00, '$20 de propina para el operador', '2023-10-21 08:02:41', '2023-10-21 08:02:41', NULL),
(99, '2023-10-20', 19, 4, '1583', '2', 4, 21, 22, '2', 260.00, 4343.00, NULL, '2023-10-21 08:03:38', '2023-10-21 08:03:38', NULL),
(100, '2023-10-20', 3, 4, '1441', '2', 4, 13, 8, '2', 300.00, 4043.00, NULL, '2023-10-21 08:05:47', '2023-10-21 08:05:47', NULL),
(101, '2023-10-20', 19, 4, '1442', '2', 4, 13, 8, '2', 260.00, 3783.00, NULL, '2023-10-21 08:06:31', '2023-10-21 08:06:31', NULL),
(102, '2023-10-20', 27, 4, '1495', '2', 13, 5, 12, '2', 1320.00, 2463.00, NULL, '2023-10-21 08:09:29', '2023-10-21 08:09:29', NULL),
(103, '2023-10-20', 10, 4, '1496', '2', 13, 5, 12, '2', 350.00, 2113.00, '3mts', '2023-10-21 08:10:26', '2023-10-21 08:10:26', NULL),
(104, '2023-10-20', 20, 4, '1497', '2', 4, 5, 12, '2', 130.00, 1983.00, NULL, '2023-10-21 08:11:22', '2023-10-21 08:11:22', NULL),
(105, '2023-10-19', 33, 2, '271', '1', 6, NULL, 14, '2', 1972.00, 11.00, NULL, '2023-10-23 09:14:04', '2023-10-23 09:14:04', NULL),
(106, '2023-10-20', 33, 1, '10180', '1', 6, NULL, 14, '2', 787.00, -776.00, NULL, '2023-10-23 09:15:38', '2023-10-23 09:39:54', NULL),
(107, '2023-10-21', 15, 4, '1500', '2', 14, 5, 12, '2', 760.00, -1536.00, '500 de Galleros', '2023-10-23 09:17:27', '2023-10-23 09:39:54', NULL),
(108, '2023-10-21', 29, 4, '1443', '2', 4, 13, 8, '2', 300.00, -1836.00, NULL, '2023-10-23 09:18:18', '2023-10-23 09:39:54', NULL),
(109, '2023-10-21', 19, 4, '1444', '2', 5, 13, 8, '2', 300.00, -2136.00, NULL, '2023-10-23 09:19:06', '2023-10-23 09:39:54', NULL),
(110, '2023-10-21', 7, 4, '1584', '2', 4, 15, 22, '2', 0.01, -2136.01, NULL, '2023-10-23 09:19:48', '2023-10-23 09:39:54', NULL),
(111, '2023-10-23', 1, 1, '1', NULL, NULL, 1, 16, '1', 2041.51, -94.50, 'Ingreso hecho automatico por corte ', '2023-10-23 09:25:27', '2023-10-23 09:39:54', NULL),
(112, '2023-10-23', 4, 2, '0001', '1', 6, NULL, 16, '1', 12960.00, 12865.50, NULL, '2023-10-23 09:29:40', '2023-10-23 09:39:54', NULL),
(113, '2023-10-23', 20, 4, '1993', '2', 4, 5, 12, '2', 130.00, 12735.50, NULL, '2023-10-24 09:26:31', '2023-10-24 09:26:31', NULL),
(114, '2023-10-23', 20, 4, '1994', '2', 4, 5, 12, '2', 130.00, 12605.50, NULL, '2023-10-24 09:28:08', '2023-10-24 09:28:08', NULL),
(115, '2023-10-23', 20, 4, '1995', '2', 8, 5, 12, '2', 630.00, 11975.50, 'con galleros', '2023-10-24 09:29:45', '2023-10-24 09:29:45', NULL),
(116, '2023-10-23', 28, 4, '1639', '2', 4, 22, 20, '2', 0.01, 11975.49, NULL, '2023-10-24 09:32:47', '2023-10-24 09:32:47', NULL),
(117, '2023-10-23', 8, 4, '1585', '2', 4, 21, 22, '2', 1420.00, 10555.49, NULL, '2023-10-24 09:35:10', '2023-10-24 09:35:10', NULL),
(118, '2023-10-23', 19, 4, '1586', '2', 4, 21, 22, '2', 260.00, 10295.49, NULL, '2023-10-24 09:36:41', '2023-10-24 09:36:41', NULL),
(119, '2023-10-23', 33, 4, '01', '1', 6, 27, 14, '2', 290.00, 10005.49, NULL, '2023-10-24 09:38:44', '2023-10-24 09:38:44', NULL),
(120, '2023-10-23', 33, 1, '01', '1', 6, 17, 14, '2', 1000.00, 9005.49, 'Aliniacion y balanceo de NISSAN KICKS', '2023-10-24 12:47:16', '2023-10-24 12:47:16', NULL),
(121, '2023-10-24', 20, 4, '1996', '2', 4, 5, 12, '2', 150.00, 8855.49, NULL, '2023-10-25 09:29:59', '2023-10-25 09:29:59', NULL),
(122, '2023-10-24', 11, 4, '1997', '2', 8, 5, 12, '2', 2204.00, 6651.49, NULL, '2023-10-25 09:30:44', '2023-10-25 09:30:44', NULL),
(123, '2023-10-24', 20, 4, '1998', '2', 8, 5, 12, '2', 630.00, 6021.49, '500 de Galleros', '2023-10-25 09:31:34', '2023-10-25 09:31:34', NULL),
(124, '2023-10-25', 7, 4, '1587', '2', 10, 15, 22, '2', 280.00, 5741.49, NULL, '2023-10-25 09:32:57', '2023-10-25 13:18:19', NULL),
(125, '2023-10-24', 26, 2, '0001', '1', 6, 13, 8, '2', 1353.00, 4388.49, NULL, '2023-10-25 09:34:45', '2023-10-25 09:34:45', NULL),
(126, '2023-10-24', 33, 2, '982', '1', 6, 13, 8, '2', 95.00, 4293.49, 'Cal', '2023-10-25 09:35:27', '2023-10-25 09:35:27', NULL),
(127, '2023-10-25', 19, 4, '1445', '2', 4, 13, 8, '2', 260.00, 5481.49, NULL, '2023-10-25 18:02:17', '2023-10-25 18:02:17', NULL),
(128, '2023-10-25', 14, 4, '1640', '2', 10, 5, 12, '2', 760.00, 4721.49, NULL, '2023-10-25 18:05:50', '2023-10-25 18:05:50', NULL),
(129, '2023-10-25', 20, 4, '1641', '2', 4, 5, 12, '2', 130.00, 4591.49, NULL, '2023-10-25 18:06:38', '2023-10-25 18:06:38', NULL),
(130, '2023-10-25', 4, 2, '0001', '1', 6, NULL, 16, '1', 10000.00, 14591.49, NULL, '2023-10-25 18:16:58', '2023-10-25 18:16:58', NULL),
(131, '2023-10-26', 19, 4, '1588', '2', 5, 21, 22, '2', 300.00, 14291.49, NULL, '2023-10-27 09:03:39', '2023-10-27 09:03:39', NULL),
(132, '2023-10-26', 19, 4, '1589', '2', 5, 21, 22, '2', 300.00, 13991.49, NULL, '2023-10-27 09:04:48', '2023-10-27 09:04:48', NULL),
(133, '2023-10-26', 19, 4, '1590', '2', 5, 21, 22, '2', 300.00, 13691.49, NULL, '2023-10-27 09:05:53', '2023-10-27 09:05:53', NULL),
(134, '2023-10-26', 20, 4, '1642', '2', 4, 5, 8, '2', 130.00, 13561.49, NULL, '2023-10-27 09:09:16', '2023-10-27 09:09:16', NULL),
(135, '2023-10-26', 27, 4, '2051', '2', 8, 5, 8, '2', 1260.00, 12301.49, 'Se cargo 3mts de rio y\r\nse cargo 3mts de grava', '2023-10-27 09:12:58', '2023-10-27 09:12:58', NULL),
(136, '2023-10-27', 33, 1, '57', '1', 6, 29, 14, '2', 1160.00, 11141.49, 'tapicería asiento retro', '2023-10-27 18:04:13', '2023-10-27 18:04:13', NULL),
(137, '2023-10-27', 33, 2, '0407', '1', 6, 26, 14, '2', 118.00, 11023.49, NULL, '2023-10-27 18:05:55', '2023-10-27 18:05:55', NULL),
(138, '2023-10-27', 8, 4, '2201', '2', 4, 13, 8, '2', 1400.00, 9623.49, NULL, '2023-10-27 18:07:39', '2023-10-27 18:07:39', NULL),
(139, '2023-10-27', 3, 4, '2202', '2', 4, 13, 8, '2', 300.00, 9323.49, NULL, '2023-10-27 18:09:21', '2023-10-27 18:09:21', NULL),
(140, '2023-10-28', 20, 4, '2052', '2', 4, 5, 12, '2', 130.00, 9193.49, NULL, '2023-10-30 08:48:27', '2023-10-30 08:48:27', NULL),
(141, '2023-10-28', 20, 4, '2053', '2', 4, 5, 12, '2', 130.00, 9063.49, NULL, '2023-10-30 08:49:48', '2023-10-30 08:49:48', NULL),
(142, '2023-10-30', 1, 1, '1', NULL, NULL, NULL, 16, '1', 9751.50, NULL, 'Ingreso hecho automatico por corte ', '2023-10-30 09:03:26', '2023-10-30 09:03:26', NULL),
(143, '2023-10-30', 20, 4, '2054', '2', 4, 5, 12, '2', 130.00, -130.00, NULL, '2023-10-31 07:59:27', '2023-10-31 07:59:27', NULL),
(144, '2023-10-30', 20, 4, '2055', '2', 4, 5, 12, '2', 130.00, -260.00, NULL, '2023-10-31 08:00:37', '2023-10-31 08:00:37', NULL),
(145, '2023-10-30', 20, 4, '2056', '2', 4, 5, 12, '2', 130.00, -390.00, NULL, '2023-10-31 08:01:38', '2023-10-31 08:01:38', NULL),
(146, '2023-10-30', 26, 4, '1591', '2', 4, 21, 22, '2', 2675.00, -3065.00, '30 pesos de propina al operador', '2023-10-31 08:04:15', '2023-10-31 08:04:15', NULL),
(148, '2023-10-30', 28, 4, '1643', '2', 3, 22, 20, '2', 0.01, -3065.01, NULL, '2023-10-31 10:37:58', '2023-10-31 10:37:58', NULL),
(149, '2023-10-31', 33, 1, '19220', '1', 6, 19, 14, '2', 130.01, -3195.02, NULL, '2023-10-31 10:40:04', '2023-10-31 10:40:04', NULL),
(150, '2023-10-31', 33, 2, '0440', '1', 6, 34, 14, '2', 140.00, -3335.02, NULL, '2023-10-31 13:37:07', '2023-10-31 13:37:07', NULL),
(151, '2023-10-31', 15, 4, '2057', '2', 10, 5, 12, '2', 760.00, -4095.02, 'carga con galleros', '2023-11-01 08:14:34', '2023-11-01 08:14:34', NULL),
(152, '2023-10-31', 7, 4, '2001', '2', 4, 15, 20, '2', 0.01, -4095.03, NULL, '2023-11-01 08:16:14', '2023-11-01 08:16:14', NULL),
(153, '2023-10-31', 3, 4, '1592', '2', 5, 21, 22, '2', 300.00, -4395.03, NULL, '2023-11-01 08:18:36', '2023-11-01 08:18:36', NULL),
(154, '2023-10-31', 19, 2, '1593', '2', 5, 21, 22, '2', 300.00, -4695.03, NULL, '2023-11-01 08:20:13', '2023-11-01 08:20:13', NULL),
(155, '2023-10-31', 19, 4, '1594', '2', 5, 21, 22, '2', 300.00, -4995.03, NULL, '2023-11-01 08:21:46', '2023-11-01 08:21:46', NULL),
(156, '2023-10-31', 19, 4, '1595', '2', 5, 21, 22, '2', 300.00, -5295.03, NULL, '2023-11-01 08:23:21', '2023-11-01 08:24:45', NULL),
(157, '2023-10-31', 19, 4, '1596', '2', 5, 21, 22, '2', 300.00, -5595.03, NULL, '2023-11-01 08:25:45', '2023-11-01 08:25:45', NULL),
(159, '2023-11-01', 2, 2, '1', NULL, NULL, NULL, 16, '1', 5250.00, -345.03, NULL, '2023-11-01 12:45:01', '2023-11-01 12:45:01', NULL),
(160, '2023-11-01', 20, 4, '2058', '2', 4, 5, 12, '2', 130.00, -475.03, NULL, '2023-11-01 18:01:04', '2023-11-01 18:01:04', NULL),
(161, '2023-11-01', 20, 4, '2059', '2', 4, 5, 12, '2', 150.00, -625.03, NULL, '2023-11-01 18:02:15', '2023-11-01 18:02:15', NULL),
(162, '2023-11-01', 11, 4, '2060', '2', 8, 5, 12, '2', 2204.00, -2829.03, NULL, '2023-11-01 18:03:27', '2023-11-01 18:03:27', NULL),
(163, '2023-11-01', 20, 4, '2061', '2', 4, 5, 12, '2', 130.00, -2959.03, NULL, '2023-11-01 18:04:34', '2023-11-01 18:04:34', NULL),
(164, '2023-11-01', 8, 4, '1598', '2', 4, 21, 22, '2', 1400.00, -4359.03, NULL, '2023-11-01 18:12:05', '2023-11-01 18:12:05', NULL),
(165, '2023-11-01', 19, 4, '1597', '2', 5, 21, 22, '2', 300.00, -4659.03, NULL, '2023-11-01 18:13:40', '2023-11-01 18:13:40', NULL),
(166, '2023-11-01', 19, 4, '2203', '2', 3, 13, 8, '2', 500.00, -5159.03, 'viaje de madera con basura', '2023-11-01 18:52:35', '2023-11-01 18:52:35', NULL),
(167, '2023-11-02', 27, 4, '2062', '2', 4, 5, 12, '2', 2366.00, -7525.03, NULL, '2023-11-02 18:13:40', '2023-11-02 18:13:40', NULL),
(168, '2023-11-02', 20, 4, '2063', '2', 4, 5, 12, '2', 130.00, -7655.03, NULL, '2023-11-02 18:15:45', '2023-11-02 18:15:45', NULL),
(169, '2023-11-02', 30, 4, '2064', '2', 4, 5, 12, '2', 250.00, -7905.03, NULL, '2023-11-02 18:17:04', '2023-11-02 18:17:04', NULL),
(170, '2023-11-02', 20, 4, '2065', '2', 4, 5, 12, '2', 130.00, -8035.03, NULL, '2023-11-02 18:18:22', '2023-11-02 18:18:22', NULL),
(171, '2023-11-02', 24, 4, '2204', '2', 3, 13, 8, '2', 0.01, -8035.04, 'viajes internos', '2023-11-02 18:22:17', '2023-11-02 18:22:17', NULL),
(172, '2023-11-03', 25, 4, '2066', '2', 8, 5, 12, '2', 500.00, -8535.04, NULL, '2023-11-04 08:41:49', '2023-11-04 08:41:49', NULL),
(173, '2023-11-03', 41, 2, '2252', '2', 7, 21, 22, '2', 500.00, -9035.04, 'viaje de madera', '2023-11-04 08:43:43', '2023-11-04 08:43:43', NULL),
(174, '2023-11-04', 7, 4, '2002', '2', 4, 15, 12, '2', 280.00, -9315.04, NULL, '2023-11-06 08:22:59', '2023-11-06 08:22:59', NULL),
(175, '2023-11-06', 1, 1, '1', NULL, NULL, NULL, 16, '1', 436.46, NULL, 'Ingreso hecho automatico por corte ', '2023-11-06 08:29:16', '2023-11-06 08:29:16', NULL),
(176, '2023-11-06', 4, 2, '1', '1', 6, NULL, 16, '1', 14600.00, 14600.00, NULL, '2023-11-06 08:49:15', '2023-11-06 08:49:15', NULL),
(177, '2023-11-06', 33, 2, '01', '1', 6, 13, 14, '2', 100.00, 14500.00, NULL, '2023-11-06 13:37:21', '2023-11-06 13:37:21', NULL),
(178, '2023-11-06', 20, 4, '2067', '2', 4, 5, 8, '2', 150.00, 14350.00, NULL, '2023-11-07 08:20:29', '2023-11-07 08:20:29', NULL),
(179, '2023-11-06', 11, 4, '2068', '2', 8, 5, 8, '2', 2204.00, 12146.00, NULL, '2023-11-07 08:21:41', '2023-11-07 08:21:41', NULL),
(180, '2023-11-06', 15, 4, '2069', '2', 8, 5, 8, '2', 780.00, 11366.00, 'se cargo con galleros', '2023-11-07 08:23:15', '2023-11-10 08:45:09', NULL),
(181, '2023-11-06', 8, 4, '2254', '2', 4, 21, 22, '2', 1400.00, 9966.00, NULL, '2023-11-07 08:29:27', '2023-11-10 08:45:09', NULL),
(182, '2023-11-06', 19, 4, '2255', '2', 5, 21, 22, '2', 300.00, 9666.00, NULL, '2023-11-07 08:30:43', '2023-11-10 08:45:09', NULL),
(183, '2023-11-06', 19, 4, '2256', '2', 5, 21, 22, '2', 300.00, 9366.00, NULL, '2023-11-07 08:31:44', '2023-11-10 08:45:09', NULL),
(184, '2023-11-06', 19, 4, '2257', '2', 5, 21, 22, '2', 300.00, 9066.00, NULL, '2023-11-07 08:32:57', '2023-11-10 08:45:09', NULL),
(185, '2023-11-06', 19, 4, '2258', '2', 5, 21, 22, '2', 300.00, 8766.00, NULL, '2023-11-07 08:35:31', '2023-11-10 08:45:09', NULL),
(186, '2023-11-06', 28, 4, '1644', '2', 4, 22, 20, '2', 0.01, 8765.99, NULL, '2023-11-07 08:37:54', '2023-11-10 08:45:09', NULL),
(187, '2023-11-07', 33, 2, '66916', '1', 6, 24, 14, '2', 1600.52, 7165.47, NULL, '2023-11-07 18:08:59', '2023-11-10 08:45:09', NULL),
(188, '2023-11-07', 10, 4, '2070', '2', 8, 5, 12, '2', 350.00, 6815.47, '3 mts arena de rio para el edificio ARRONIZ', '2023-11-07 18:12:28', '2023-11-10 08:45:09', NULL),
(189, '2023-11-07', 20, 4, '2071', '2', 4, 5, 12, '2', 130.00, 6685.47, NULL, '2023-11-07 18:13:42', '2023-11-10 08:45:09', NULL),
(190, '2023-11-07', 20, 4, '2072', '2', 4, 5, 12, '2', 130.00, 6555.47, NULL, '2023-11-07 18:14:53', '2023-11-10 08:45:09', NULL),
(191, '2023-11-07', 14, 4, '2206', '2', 11, 13, 8, '2', 480.00, 6075.47, NULL, '2023-11-07 18:16:51', '2023-11-10 08:45:09', NULL),
(192, '2023-11-07', 28, 4, '2151', '2', 4, 22, 20, '2', 0.01, 6075.46, NULL, '2023-11-07 18:18:25', '2023-11-10 08:45:09', NULL),
(193, '2023-11-07', 19, 4, '2259', '2', 5, 21, 22, '2', 300.00, 5775.46, NULL, '2023-11-08 08:35:13', '2023-11-10 08:45:09', NULL),
(194, '2023-11-07', 19, 4, '2260', '2', 5, 21, 22, '2', 300.00, 5475.46, NULL, '2023-11-08 08:36:09', '2023-11-10 08:45:09', NULL),
(195, '2023-11-08', 33, 1, '19265', '1', 6, 1, 14, '2', 50.00, 5425.46, NULL, '2023-11-08 10:22:32', '2023-11-10 09:24:51', NULL),
(196, '2023-11-08', 20, 4, '2073', '2', 4, 5, 12, '2', 130.00, 5295.46, NULL, '2023-11-09 08:11:51', '2023-11-10 09:24:51', NULL),
(197, '2023-11-08', 20, 4, '2074', '2', 4, 5, 12, '2', 130.00, 5165.46, NULL, '2023-11-09 08:13:19', '2023-11-10 09:24:51', NULL),
(198, '2023-11-08', 20, 4, '2075', '2', 4, 5, 12, '2', 130.00, 5035.46, NULL, '2023-11-09 08:14:30', '2023-11-10 09:24:51', NULL),
(199, '2023-11-08', 7, 4, '1599', '2', 4, 15, 8, '2', 0.01, 5035.45, NULL, '2023-11-09 08:17:17', '2023-11-10 09:24:51', NULL),
(200, '2023-11-08', 28, 4, '2152', '2', 4, 22, 20, '2', 0.01, 5035.44, NULL, '2023-11-09 08:18:46', '2023-11-10 09:24:51', NULL),
(201, '2023-11-08', 19, 4, '2262', '2', 5, 21, 22, '2', 300.00, 4735.44, NULL, '2023-11-09 08:20:59', '2023-11-10 09:24:51', NULL),
(202, '2023-11-08', 19, 4, '2262', '2', 5, 21, 22, '2', 300.00, 4435.44, NULL, '2023-11-09 08:22:10', '2023-11-10 09:24:51', NULL),
(203, '2023-11-09', 33, 4, '9895', '2', 6, 34, 14, '2', 300.00, 4135.44, 'revolvedora MTQ', '2023-11-10 08:16:41', '2023-11-10 09:24:51', NULL),
(204, '2023-11-09', 33, 1, '19220', '1', 6, 22, 14, '2', 130.00, 4005.44, NULL, '2023-11-10 08:20:05', '2023-11-10 09:24:51', NULL),
(205, '2023-11-09', 8, 4, '2207', '2', 4, 13, 8, '2', 1400.00, 2605.44, NULL, '2023-11-10 08:22:27', '2023-11-10 09:24:51', NULL),
(206, '2023-11-09', 7, 2, '01', '1', 6, 15, 8, '2', 350.00, 2255.44, 'Se compro agua para el taller', '2023-11-10 08:24:09', '2023-11-10 09:24:51', NULL),
(207, '2023-11-09', 20, 4, '2076', '2', 4, 5, 12, '2', 130.00, 2125.44, NULL, '2023-11-10 08:25:40', '2023-11-10 09:24:51', NULL),
(208, '2023-11-09', 20, 4, '2077', '2', 4, 5, 12, '2', 130.00, 1995.44, NULL, '2023-11-10 08:26:40', '2023-11-10 09:24:51', NULL),
(209, '2023-11-09', 20, 4, '2078', '2', 4, 5, 12, '2', 130.00, 1865.44, NULL, '2023-11-10 08:27:47', '2023-11-10 09:24:51', NULL),
(210, '2023-11-09', 19, 4, '2263', '2', 5, 21, 22, '2', 300.00, 1565.44, NULL, '2023-11-10 08:29:34', '2023-11-10 09:24:51', NULL),
(211, '2023-11-10', 4, 2, '1', '1', 6, NULL, 16, '1', 6583.00, 8148.44, NULL, '2023-11-10 17:41:36', '2023-11-11 09:00:19', NULL),
(212, '2023-11-10', 18, 2, '1', '1', 6, NULL, 16, '2', 4176.00, 3972.44, 'Instalacion chapas', '2023-11-10 17:42:39', '2023-11-11 09:00:19', NULL),
(213, '2023-11-10', 27, 4, '2079', '2', 5, 5, 12, '2', 1325.00, 2647.44, 'Factura 3140 Agregados Copalita', '2023-11-11 08:18:45', '2023-11-11 09:00:19', NULL),
(214, '2023-11-10', 37, 4, '2080', '2', 5, 5, 12, '2', 150.00, 2497.44, NULL, '2023-11-11 08:19:37', '2023-11-11 09:00:19', NULL),
(215, '2023-11-10', 20, 4, '2081', '2', 4, 5, 12, '2', 130.00, 2367.44, NULL, '2023-11-11 08:20:36', '2023-11-11 09:00:19', NULL),
(216, '2023-11-09', 18, 1, '2672', '1', 6, NULL, 16, '2', 583.71, 1783.73, NULL, '2023-11-11 09:01:17', '2023-11-11 09:01:17', NULL),
(217, '2023-11-10', 4, 2, '01', '1', 6, NULL, 16, '1', 16000.00, 18367.44, NULL, '2023-11-11 09:02:20', '2023-11-11 09:02:20', NULL),
(218, '2023-11-10', 18, 2, '01', '1', 6, NULL, 16, '2', 16000.00, 2367.44, 'Anticipo Jorge electrico', '2023-11-11 09:03:06', '2023-11-11 09:03:06', NULL),
(219, '2023-11-11', 28, 4, '2153', '2', 15, 22, 20, '2', 0.01, 2367.43, NULL, '2023-11-13 09:10:56', '2023-11-13 09:10:56', NULL),
(220, '2023-11-11', 11, 4, '2082', '2', 8, 5, 12, '2', 2204.00, 163.43, NULL, '2023-11-13 09:12:06', '2023-11-13 09:12:06', NULL),
(221, '2023-11-11', 20, 4, '2083', '2', 4, 5, 12, '2', 130.00, 33.43, NULL, '2023-11-13 09:12:57', '2023-11-13 09:12:57', NULL),
(222, '2023-11-11', 4, 2, '01', '1', 6, NULL, 16, '1', 113.82, 147.25, NULL, '2023-11-13 09:21:55', '2023-11-13 09:21:55', NULL),
(223, '2023-11-13', 1, 1, '1', NULL, NULL, NULL, 16, '1', 0.00, NULL, 'Ingreso hecho automatico por corte ', '2023-11-13 09:22:11', '2023-11-13 09:22:11', NULL),
(224, '2023-11-11', 33, 2, '1600', '1', 6, NULL, 14, '2', 35.00, 112.25, NULL, '2023-11-13 09:33:07', '2023-11-13 09:33:32', NULL),
(225, '2023-11-13', 2, 5, '01', '1', 6, NULL, 16, '1', 15000.00, 15112.25, NULL, '2023-11-13 10:02:26', '2023-11-15 12:28:25', NULL),
(226, '2023-11-13', 20, 4, '2084', '2', 4, 5, 12, '2', 130.00, 14982.25, NULL, '2023-11-13 17:44:36', '2023-11-15 12:28:25', NULL),
(227, '2023-11-13', 20, 4, '2085', '2', 4, 5, 12, '2', 130.00, 14852.25, NULL, '2023-11-13 17:45:46', '2023-11-15 12:28:25', NULL),
(228, '2023-11-13', 8, 4, '2264', '2', 4, 21, 22, '2', 1430.00, 13422.25, NULL, '2023-11-13 18:10:37', '2023-11-15 12:28:25', NULL),
(229, '2023-11-13', 33, 1, '65440', '1', 6, 15, 14, '2', 203.29, 13218.96, NULL, '2023-11-13 18:12:12', '2023-11-15 12:28:25', NULL),
(230, '2023-11-13', 33, 2, '47470', '1', 6, 34, 14, '2', 54.00, 13164.96, NULL, '2023-11-13 18:14:05', '2023-11-15 12:28:25', NULL),
(231, '2023-11-13', 33, 2, '01', '1', 6, 22, 14, '2', 27.00, 13137.96, NULL, '2023-11-13 18:16:07', '2023-11-15 12:28:25', NULL),
(232, '2023-11-14', 33, 1, '19307', '1', 6, 10, 14, '2', 445.01, 12692.95, 'tornillería para la revolvedora', '2023-11-14 15:11:36', '2023-11-15 12:28:25', NULL),
(233, '2023-11-14', 19, 4, '2265', '2', 5, 21, 22, '2', 300.00, 12392.95, NULL, '2023-11-15 08:35:37', '2023-11-15 12:28:25', NULL),
(234, '2023-11-14', 19, 4, '2266', '2', 5, 21, 22, '2', 300.00, 12092.95, NULL, '2023-11-15 08:36:42', '2023-11-15 12:28:25', NULL),
(235, '2023-11-14', 19, 4, '2267', '2', 5, 21, 22, '2', 300.00, 11792.95, NULL, '2023-11-15 08:38:29', '2023-11-15 12:28:25', NULL),
(236, '2023-11-14', 19, 4, '2268', '2', 5, 21, 22, '2', 300.00, 11492.95, NULL, '2023-11-15 08:39:21', '2023-11-15 12:28:25', NULL),
(237, '2023-11-14', 20, 4, '2086', '2', 4, 5, 12, '2', 130.00, 11362.95, NULL, '2023-11-15 08:40:39', '2023-11-15 12:28:25', NULL),
(238, '2023-11-14', 20, 4, '2087', '2', 4, 5, 12, '2', 130.00, 11232.95, NULL, '2023-11-15 08:41:44', '2023-11-15 12:28:25', NULL),
(239, '2023-11-14', 20, 4, '2088', '2', 4, 5, 12, '2', 130.00, 11102.95, NULL, '2023-11-15 08:42:41', '2023-11-15 12:28:25', NULL),
(240, '2023-11-14', 28, 4, '2154', '1', 15, 22, 20, '2', 0.01, 11102.94, NULL, '2023-11-15 08:44:27', '2023-11-15 12:28:25', NULL),
(241, '2023-11-15', 26, 4, '2208', '2', 4, 13, 8, '2', 2695.00, 8407.94, '50 pesos de propina al operador de la grava', '2023-11-16 09:05:37', '2023-11-16 09:05:37', NULL),
(242, '2023-11-14', 28, 4, '2156', '2', 11, 22, 20, '2', 0.01, 8407.93, NULL, '2023-11-16 09:07:34', '2023-11-16 09:07:34', NULL),
(243, '2023-11-15', 28, 4, '2155', '1', 11, 22, 20, '2', 0.01, 8407.93, NULL, '2023-11-16 09:09:03', '2023-11-16 09:09:03', NULL),
(244, '2023-11-15', 10, 4, '2089', '2', 4, 5, 12, '2', 650.00, 7757.93, NULL, '2023-11-16 09:11:17', '2023-11-16 09:11:17', NULL),
(245, '2023-11-15', 20, 4, '2090', '2', 4, 5, 12, '2', 130.00, 7627.93, NULL, '2023-11-16 09:12:30', '2023-11-16 09:12:30', NULL),
(246, '2023-11-15', 20, 4, '2091', '2', 4, 5, 12, '2', 130.00, 7497.93, NULL, '2023-11-16 09:13:28', '2023-11-16 09:13:28', NULL),
(247, '2023-11-15', 20, 4, '2092', '2', 4, 5, 12, '2', 130.00, 7367.93, NULL, '2023-11-16 09:14:20', '2023-11-16 09:14:20', NULL),
(248, '2023-11-15', 33, 2, '1468', '1', 6, 13, 14, '2', 50.00, 7317.93, NULL, '2023-11-16 09:18:56', '2023-11-16 09:18:56', NULL),
(249, '2023-11-16', 28, 4, '2157', '2', 11, 5, 20, '2', 0.01, 7317.92, NULL, '2023-11-17 19:15:27', '2023-11-17 19:15:27', NULL),
(250, '2023-11-16', 15, 4, '2093', '2', 10, 5, 12, '2', 800.00, 6517.92, NULL, '2023-11-17 19:17:33', '2023-11-17 19:17:33', NULL),
(251, '2023-11-17', 8, 4, '2269', '2', 4, 5, 22, '2', 1400.00, 5117.92, NULL, '2023-11-17 19:19:51', '2023-11-17 19:20:06', NULL),
(252, '2023-11-17', 3, 4, '2270', '2', 5, 21, 22, '2', 300.00, 4817.92, NULL, '2023-11-17 19:21:52', '2023-11-17 19:21:52', NULL),
(253, '2023-11-17', 11, 4, '2272', '2', 8, 21, 22, '2', 2326.00, 2491.92, '30 pesos de  propina al operador', '2023-11-17 19:24:20', '2023-11-17 19:24:20', NULL),
(254, '2023-11-17', 33, 1, '898545', '1', 6, 8, 14, '2', 200.00, 2291.92, NULL, '2023-11-18 09:06:40', '2023-11-18 09:06:40', NULL),
(255, '2023-11-17', 33, 2, '01', '1', 6, 13, 14, '2', 125.00, 2166.92, NULL, '2023-11-18 09:08:07', '2023-11-18 09:08:07', NULL),
(256, '2023-11-17', 33, 2, '01', '1', 6, 34, 14, '2', 17.00, 2149.92, NULL, '2023-11-18 09:09:15', '2023-11-18 09:09:15', NULL),
(257, '2023-11-18', 32, 2, '01', '1', 6, 16, 14, '2', 100.00, 2049.92, NULL, '2023-11-18 09:10:18', '2023-11-18 09:10:18', NULL),
(258, '2023-11-18', 4, 2, '01', '1', 6, 26, 16, '1', 500.00, 2549.92, NULL, '2023-11-18 09:12:27', '2023-11-18 09:12:27', NULL),
(259, '2023-11-18', 18, 6, '01', '1', 6, NULL, 16, '2', 20000.00, -17450.08, NULL, '2023-11-21 09:04:51', '2023-11-21 09:04:51', NULL),
(260, '2023-11-18', 3, 4, '2210', '2', 4, 13, 8, '2', 300.00, -17750.08, NULL, '2023-11-21 16:18:02', '2023-11-21 16:18:02', NULL),
(261, '2023-11-18', 19, 4, '2274', '2', 5, 21, 22, '2', 450.00, -18200.08, 'escombro con basura', '2023-11-21 16:25:49', '2023-11-21 16:25:49', NULL),
(262, '2023-11-18', 27, 4, '2095', '2', 8, 5, 12, '2', 1183.20, -19383.28, '3mts de grava y 3mts arena de rio', '2023-11-21 16:29:08', '2023-11-21 16:29:08', NULL),
(263, '2023-11-20', 1, 1, '1', NULL, NULL, NULL, 16, '1', -19495.54, NULL, 'Ingreso hecho automatico por corte ', '2023-11-21 16:32:16', '2023-11-21 16:32:16', NULL),
(264, '2023-11-21', 4, 5, '01', '1', 6, 32, 16, '1', 12000.00, 12000.00, NULL, '2023-11-21 16:34:23', '2023-11-21 16:34:23', NULL),
(265, '2023-11-21', 4, 5, '01', '1', 6, NULL, 16, '1', 20000.00, 32000.00, NULL, '2023-11-21 16:37:49', '2023-11-21 16:37:49', NULL),
(266, '2023-11-21', 15, 4, '2097', '2', 10, 5, 12, '2', 760.00, 31240.00, 'carga con galleros 500 pesos', '2023-11-21 18:20:15', '2023-11-21 18:20:15', NULL),
(267, '2023-11-21', 20, 4, '2098', '2', 4, 5, 12, '2', 150.00, 31090.00, NULL, '2023-11-21 18:21:41', '2023-11-21 18:21:41', NULL),
(268, '2023-11-21', 15, 4, '2100', '2', 8, 5, 12, '2', 760.00, 30330.00, 'carga con galleros', '2023-11-21 18:23:13', '2023-11-21 18:23:13', NULL),
(269, '2023-11-21', 33, 1, '19340', '1', 6, 22, 14, '2', 108.00, 30222.00, NULL, '2023-11-21 18:30:41', '2023-11-21 18:30:41', NULL),
(270, '2023-11-21', 26, 4, '2275', '2', 4, 21, 22, '2', 2644.80, 27577.20, NULL, '2023-11-22 09:28:20', '2023-11-22 09:28:20', NULL),
(271, '2023-11-22', 20, 4, '2296', '2', 4, 5, 12, '2', 130.00, 27447.20, NULL, '2023-11-23 08:28:26', '2023-11-23 08:28:26', NULL),
(272, '2023-11-22', 20, 4, '2297', '2', 4, 5, 12, '2', 130.00, 27317.20, NULL, '2023-11-23 08:29:27', '2023-11-23 08:29:27', NULL),
(273, '2023-11-22', 20, 4, '2298', '2', 4, 5, 12, '2', 130.00, 27187.20, NULL, '2023-11-23 08:30:45', '2023-11-23 08:30:45', NULL),
(274, '2023-11-22', 3, 4, '2276', '2', 4, 21, 22, '2', 380.00, 26807.20, NULL, '2023-11-23 08:35:43', '2023-11-23 08:35:43', NULL),
(275, '2023-11-22', 3, 4, '2278', '2', 4, 21, 22, '2', 380.00, 26427.20, NULL, '2023-11-23 08:36:59', '2023-11-23 08:36:59', NULL),
(276, '2023-11-22', 8, 4, '2279', '2', 4, 21, 22, '2', 1430.00, 24997.20, NULL, '2023-11-23 08:38:05', '2023-11-23 08:38:05', NULL),
(277, '2023-11-21', 33, 1, '0473', '1', 6, NULL, 14, '2', 458.00, 24539.20, '2 camaras para la devolvedora', '2023-11-23 12:49:28', '2023-11-23 12:49:28', NULL),
(278, '2023-11-22', 33, 2, '01', '1', 6, NULL, 14, '2', 175.00, 24822.20, 'copias de llaves', '2023-11-23 12:51:08', '2023-11-23 12:51:08', NULL),
(279, '2023-11-23', 20, 4, '2299', '2', 4, 5, 12, '2', 130.00, 24692.20, NULL, '2023-11-23 18:38:29', '2023-11-23 18:38:29', NULL),
(280, '2023-11-23', 20, 4, '2200', '2', 4, 5, 12, '2', 130.00, 24562.20, NULL, '2023-11-23 18:40:37', '2023-11-23 18:40:37', NULL),
(281, '2023-11-23', 20, 4, '2401', '2', 8, 5, 12, '2', 760.00, 23802.20, NULL, '2023-11-23 18:41:46', '2023-11-23 18:41:46', NULL),
(282, '2023-11-23', 28, 4, '2159', '2', 4, 22, 20, '2', 0.01, 23802.19, NULL, '2023-11-23 18:45:15', '2023-11-23 18:45:15', NULL),
(283, '2023-11-23', 10, 4, '2280', '2', 16, 21, 22, '2', 800.00, 23002.19, NULL, '2023-11-24 08:39:10', '2023-11-24 08:39:10', NULL),
(284, '2023-11-23', 19, 4, '2281', '2', 4, 21, 22, '2', 260.00, 22742.19, NULL, '2023-11-24 08:40:27', '2023-11-24 08:40:27', NULL),
(285, '2023-11-23', 19, 4, '2282', '2', 4, 21, 22, '2', 260.00, 22482.19, NULL, '2023-11-24 08:41:44', '2023-11-24 08:41:44', NULL),
(286, '2023-11-24', 33, 2, '1605', '1', 6, NULL, 14, '2', 32.00, 22450.19, NULL, '2023-11-24 14:48:45', '2023-11-24 14:48:45', NULL),
(287, '2023-11-24', 19, 4, '2283', '2', 4, 21, 22, '2', 260.00, 22190.19, NULL, '2023-11-24 18:41:35', '2023-11-24 18:41:35', NULL),
(288, '2023-11-24', 20, 4, '2402', '2', 4, 5, 12, '2', 150.00, 22040.19, NULL, '2023-11-24 18:45:02', '2023-11-24 18:45:02', NULL),
(289, '2023-11-24', 20, 4, '2403', '2', 8, 5, 12, '2', 630.00, 21410.19, NULL, '2023-11-24 18:47:44', '2023-11-24 18:47:44', NULL),
(290, '2023-11-24', 8, 4, '2211', '2', 4, 13, 8, '2', 1450.00, 19960.19, NULL, '2023-11-24 18:49:42', '2023-11-24 18:49:42', NULL),
(291, '2023-11-25', 4, 5, NULL, NULL, 6, NULL, 16, '1', 1500.00, 21460.19, NULL, '2023-11-25 13:31:54', '2023-11-25 13:31:54', NULL),
(292, '2023-11-25', 3, 4, '2284', '2', 4, 21, 22, '2', 380.00, 21080.19, NULL, '2023-11-25 13:33:21', '2023-11-25 13:33:21', NULL),
(293, '2023-11-25', 20, 4, '2404', '2', 8, 5, 12, '2', 630.00, 20450.19, NULL, '2023-11-25 13:36:25', '2023-11-25 13:36:25', NULL),
(294, '2023-11-24', 7, 4, '2004', '2', 17, 15, 8, '2', 0.01, 20450.18, NULL, '2023-11-25 13:45:24', '2023-11-25 13:45:24', NULL),
(295, '2023-11-27', 1, 1, '1', NULL, NULL, NULL, 16, '1', 496.64, NULL, 'Ingreso hecho automatico por corte ', '2023-11-27 08:48:59', '2023-11-27 08:48:59', NULL),
(296, '2023-11-27', 2, 5, '1', '1', NULL, NULL, 16, '1', 14500.00, 14500.00, NULL, '2023-11-27 08:53:34', '2023-11-29 10:41:36', NULL),
(297, '2023-11-27', 27, 4, '2405', '2', 7, 5, 12, '2', 1344.00, 13156.00, NULL, '2023-11-28 08:52:33', '2023-11-29 10:41:36', NULL),
(298, '2023-11-27', 20, 4, '2406', '2', 8, 5, 12, '2', 630.00, 12526.00, NULL, '2023-11-28 08:54:14', '2023-11-29 10:41:36', NULL),
(299, '2023-11-27', 8, 4, '2212', '2', 7, 13, 8, '2', 1400.00, 11126.00, NULL, '2023-11-28 08:57:15', '2023-11-29 10:41:36', NULL),
(300, '2023-11-27', 19, 4, '2213', '2', 5, 13, 8, '2', 300.00, 10826.00, NULL, '2023-11-28 08:58:15', '2023-11-29 10:41:36', NULL),
(301, '2023-11-27', 34, 2, '0538', '2', 5, 28, 14, '2', 250.00, 10576.00, NULL, '2023-11-28 09:02:50', '2023-11-29 10:41:36', NULL),
(302, '2023-11-27', 21, 2, NULL, '1', 8, 17, 14, '2', 35.00, 10541.00, NULL, '2023-11-28 09:05:25', '2023-11-29 10:41:36', NULL),
(303, '2023-11-27', 33, 1, '8600', NULL, 6, NULL, 14, '2', 31.00, 10510.00, NULL, '2023-11-28 09:07:43', '2023-11-29 10:41:36', NULL),
(304, '2023-11-28', 28, 4, '2160', '2', 4, 22, 14, '2', 0.01, 10509.99, NULL, '2023-11-29 08:19:27', '2023-11-29 10:41:36', NULL),
(305, '2023-11-28', 27, 4, '2407', '2', 11, 5, 12, '2', 1181.00, 9328.99, '3mta grava 3mts arena rio', '2023-11-29 08:22:13', '2023-11-29 10:41:36', NULL),
(306, '2023-11-28', 20, 4, '2408', '2', 8, 5, 12, '2', 630.00, 8698.99, NULL, '2023-11-29 08:23:50', '2023-11-29 10:41:36', NULL),
(307, '2023-11-28', 19, 4, '2285', '2', 5, 21, 22, '2', 300.00, 8398.99, NULL, '2023-11-29 08:31:46', '2023-11-29 10:41:36', NULL),
(308, '2023-11-28', 19, 4, '2287', '2', 5, 21, 22, '2', 300.00, 8098.99, NULL, '2023-11-29 08:33:33', '2023-11-29 10:41:36', NULL),
(309, '2023-11-28', 19, 4, '2288', '2', 8, 21, 22, '2', 260.00, 7838.99, NULL, '2023-11-29 08:35:54', '2023-11-29 10:41:36', NULL),
(310, '2023-11-28', 18, 2, '48443', NULL, 6, NULL, 8, '2', 708.00, 7130.99, NULL, '2023-11-29 08:39:22', '2023-11-29 10:41:36', NULL),
(311, '2023-11-29', 19, 4, '2289', '2', 8, 21, 8, '2', 260.00, 6870.99, NULL, '2023-11-30 08:40:10', '2023-11-30 08:40:10', NULL),
(312, '2023-11-29', 20, 4, '2409', '2', 4, 5, 12, '2', 130.00, 6740.99, NULL, '2023-11-30 08:42:11', '2023-11-30 08:42:11', NULL),
(313, '2023-11-29', 20, 4, '2410', '2', 4, 5, 12, '2', 150.00, 6590.99, NULL, '2023-11-30 08:43:15', '2023-11-30 08:43:15', NULL),
(314, '2023-11-29', 20, 4, '2411', '2', 18, 5, 12, '2', 630.00, 5960.99, NULL, '2023-11-30 08:45:14', '2023-11-30 08:45:14', NULL),
(315, '2023-11-30', 20, 4, '2412', '2', 4, 5, 12, '2', 130.00, 5830.99, NULL, '2023-12-01 08:30:54', '2023-12-01 08:30:54', NULL),
(316, '2023-11-30', 20, 4, '2413', '2', 18, 5, 12, '2', 630.00, 5200.99, 'carga con galleros', '2023-12-01 08:32:27', '2023-12-01 08:32:27', NULL),
(317, '2023-11-30', 7, 4, '2005', '2', 16, 15, 22, '2', 0.01, 5200.98, NULL, '2023-12-01 08:35:34', '2023-12-01 08:35:34', NULL),
(318, '2023-11-30', 27, 4, '2214', '2', 17, 13, 8, '2', 1352.00, 3848.98, NULL, '2023-12-01 08:37:24', '2023-12-01 08:37:24', NULL),
(319, '2023-11-30', 10, 4, '2215', '2', 17, 13, 8, '2', 700.00, 3148.98, NULL, '2023-12-01 08:38:35', '2023-12-01 08:38:35', NULL),
(320, '2023-11-30', 3, 4, '2216', '2', 5, 13, 8, '2', 350.00, 2798.98, NULL, '2023-12-01 08:39:38', '2023-12-01 08:39:38', NULL),
(321, '2023-11-30', 3, 4, '2217', '2', 5, 13, 8, '2', 350.00, 2448.98, NULL, '2023-12-01 08:40:41', '2023-12-01 08:40:41', NULL),
(322, '2023-12-01', 20, 4, '2414', '2', 4, 5, 12, '2', 130.00, 2318.98, NULL, '2023-12-02 08:24:09', '2023-12-02 08:24:09', NULL),
(323, '2023-12-01', 20, 4, '2415', '2', 4, 5, 12, '2', 130.00, 2188.98, NULL, '2023-12-02 08:25:08', '2023-12-02 08:25:08', NULL),
(324, '2023-12-01', 20, 4, '2416', '2', 4, 5, 12, '2', 130.00, 2058.98, NULL, '2023-12-02 08:26:42', '2023-12-02 08:26:42', NULL),
(325, '2023-12-01', 23, 4, '2162', '2', 22, 22, 8, '2', 322.00, 1736.98, 'flete de sayula', '2023-12-02 08:30:46', '2023-12-02 08:48:51', NULL),
(326, '2023-12-01', 24, 4, '2290', '2', 22, 21, 22, '2', 322.00, 1414.98, 'flete de lagunilla', '2023-12-02 08:32:05', '2023-12-02 08:48:45', NULL),
(327, '2023-12-02', 4, 5, '1', '1', 6, NULL, 16, '1', 1000.00, 2414.98, NULL, '2023-12-02 08:53:15', '2023-12-02 08:53:15', NULL),
(328, '2023-12-02', 4, 5, '1', '1', 6, NULL, 16, '1', 1500.00, 3914.98, NULL, '2023-12-02 09:00:23', '2023-12-02 09:00:23', NULL),
(329, '2023-12-02', 8, 4, '2218', '2', 4, 13, 8, '2', 1400.00, 2514.98, NULL, '2023-12-04 08:46:56', '2023-12-04 08:46:56', NULL),
(330, '2023-12-02', 11, 4, '2417', '2', 8, 5, 12, '2', 2088.00, 426.98, NULL, '2023-12-04 08:48:19', '2023-12-04 08:48:19', NULL),
(331, '2023-12-02', 37, 4, '2418', '2', 5, 5, 12, '2', 170.00, 256.98, NULL, '2023-12-04 08:49:43', '2023-12-04 08:49:43', NULL),
(332, '2023-12-02', 24, 4, '2291', '2', 22, 21, 22, '2', 0.01, 256.97, NULL, '2023-12-04 08:53:04', '2023-12-04 08:53:04', NULL),
(333, '2023-12-04', 1, 1, '1', NULL, NULL, NULL, 16, '1', 753.61, NULL, 'Ingreso hecho automatico por corte ', '2023-12-04 09:18:41', '2023-12-04 09:18:41', NULL),
(334, '2023-12-04', 2, 5, '1', '1', 6, NULL, 16, '1', 14250.00, 14250.00, NULL, '2023-12-04 09:19:19', '2023-12-04 09:19:19', NULL),
(335, '2023-12-04', 4, 5, '1', '1', 6, NULL, 16, '1', 1500.00, 15750.00, NULL, '2023-12-04 09:20:19', '2023-12-04 09:20:19', NULL),
(336, '2023-12-04', 18, 6, '1', '1', 6, NULL, 16, '2', 1500.00, 14250.00, 'Asfalto para el taller', '2023-12-04 09:20:56', '2023-12-04 09:20:56', NULL),
(337, '2023-12-04', 18, 2, '1746', '1', 6, NULL, 16, '2', 180.00, 14070.00, NULL, '2023-12-04 18:31:54', '2023-12-04 18:31:54', NULL),
(338, '2023-12-04', 7, 4, '2006', '2', 17, 21, 8, '2', 350.00, 13720.00, NULL, '2023-12-05 08:41:56', '2023-12-05 08:43:49', NULL),
(339, '2023-12-04', 10, 4, '2292', '2', 17, 21, 8, '2', 800.00, 12920.00, NULL, '2023-12-05 08:43:23', '2023-12-05 08:43:49', NULL),
(340, '2023-12-04', 19, 4, '2293', '2', 4, 21, 8, '2', 340.00, 12580.00, 'tiro copalita', '2023-12-05 08:45:04', '2023-12-05 08:45:04', NULL),
(341, '2023-12-04', 37, 4, '2419', '2', 5, 5, 22, '2', 730.00, 11850.00, NULL, '2023-12-05 08:48:05', '2023-12-05 08:48:05', NULL),
(342, '2023-12-04', 20, 4, '2420', '2', 5, 5, 22, '2', 150.00, 11700.00, NULL, '2023-12-05 08:51:10', '2023-12-05 08:51:10', NULL),
(343, '2023-12-04', 20, 4, '2422', '2', 4, 5, 22, '2', 150.00, 11550.00, NULL, '2023-12-05 08:52:28', '2023-12-05 08:52:28', NULL),
(344, '2023-12-04', 20, 4, '2423', '2', 18, 5, 22, '2', 730.00, 10820.00, NULL, '2023-12-05 08:54:47', '2023-12-05 08:54:47', NULL),
(345, '2023-12-04', 18, 2, '01', NULL, 6, NULL, 14, '2', 100.00, 10720.00, NULL, '2023-12-05 08:58:14', '2023-12-05 08:58:14', NULL),
(346, '2023-12-04', 33, 1, '3448', NULL, 6, NULL, 14, '2', 89.07, 10630.93, NULL, '2023-12-05 09:00:42', '2023-12-05 09:00:42', NULL),
(347, '2023-12-05', 3, 4, '2352', '2', 4, 21, 8, '2', 500.00, 10130.93, NULL, '2023-12-05 18:40:36', '2023-12-05 18:40:36', NULL),
(348, '2023-12-05', 19, 4, '2351', '2', 4, 21, 8, '2', 340.00, 9790.93, NULL, '2023-12-05 18:41:45', '2023-12-05 18:41:45', NULL),
(349, '2023-12-05', 37, 4, '2424', '2', 5, 5, 22, '2', 500.00, 9290.93, NULL, '2023-12-05 18:43:00', '2023-12-05 18:43:00', NULL),
(350, '2023-12-05', 20, 4, '2425', '2', 18, 5, 22, '2', 630.00, 8660.93, NULL, '2023-12-05 18:44:51', '2023-12-05 18:44:51', NULL),
(351, '2023-12-05', 38, 2, '01', NULL, 18, 5, 22, '2', 200.00, 8460.93, 'Multa de transito', '2023-12-05 18:47:02', '2023-12-05 18:47:02', NULL),
(352, '2023-12-06', 37, 4, '2426', '2', 5, 5, 12, '2', 150.00, 8310.93, NULL, '2023-12-07 08:23:57', '2023-12-07 08:23:57', NULL),
(353, '2023-12-06', 20, 4, '2427', '2', 5, 5, 12, '2', 150.00, 8160.93, NULL, '2023-12-07 08:29:06', '2023-12-07 08:30:07', NULL),
(354, '2023-12-06', 37, 4, '2428', '2', 5, 21, 12, '2', 150.00, 8010.93, NULL, '2023-12-07 08:29:51', '2023-12-07 08:29:51', NULL),
(355, '2023-12-06', 15, 4, '2429', '2', 10, 5, 12, '2', 800.00, 7210.93, '500 de galleros', '2023-12-07 08:30:55', '2023-12-07 08:32:01', NULL),
(356, '2023-12-06', 20, 4, '2430', '2', 18, 5, 12, '2', 630.00, 6580.93, '500 de galleros', '2023-12-07 08:33:16', '2023-12-09 08:20:20', NULL),
(357, '2023-12-06', 19, 4, '1446', '2', 5, 13, 8, '2', 100.00, 6480.93, NULL, '2023-12-07 08:36:06', '2023-12-09 08:20:20', NULL),
(358, '2023-12-06', 19, 4, '2219', '2', 4, 13, 8, '2', 100.00, 6380.93, NULL, '2023-12-07 08:36:54', '2023-12-09 08:20:20', NULL),
(359, '2023-12-06', 19, 4, '2220', '2', 5, 13, 8, '2', 100.00, 6280.93, NULL, '2023-12-07 08:37:37', '2023-12-09 08:20:20', NULL),
(360, '2023-12-06', 19, 4, '2221', '2', 5, 13, 8, '2', 340.00, 5940.93, NULL, '2023-12-07 08:38:56', '2023-12-09 08:20:20', NULL),
(361, '2023-12-06', 27, 4, '2294', '2', 4, 21, 22, '2', 2397.00, 3543.93, '30 pesos propina operador', '2023-12-07 08:41:07', '2023-12-09 08:20:20', NULL),
(362, '2023-12-06', 19, 4, '2353', '2', 4, 21, 22, '2', 300.00, 3243.93, NULL, '2023-12-07 08:42:10', '2023-12-09 08:20:20', NULL),
(363, '2023-12-06', 19, 4, '2354', '2', 5, 21, 22, '2', 100.00, 3143.93, NULL, '2023-12-07 08:43:13', '2023-12-09 08:20:20', NULL),
(364, '2023-12-06', 19, 4, '2355', '2', 5, 21, 22, '2', 100.00, 3043.93, NULL, '2023-12-07 08:44:10', '2023-12-09 08:20:20', NULL),
(365, '2023-12-06', 19, 4, '2356', '2', 5, 21, 22, '2', 100.00, 2943.93, NULL, '2023-12-07 08:44:53', '2023-12-09 08:20:20', NULL),
(366, '2023-12-06', 23, 4, '2163', '2', 9, 22, 23, '2', 0.01, 2943.92, NULL, '2023-12-07 08:46:26', '2023-12-09 08:20:20', NULL),
(367, '2023-12-07', 20, 4, '2431', '2', 5, 5, 12, '2', 50.00, 2893.92, NULL, '2023-12-07 17:46:35', '2023-12-09 08:20:20', NULL),
(368, '2023-12-07', 20, 4, '2432', '2', 5, 5, 12, '2', 50.00, 2843.92, NULL, '2023-12-07 17:47:13', '2023-12-09 08:20:20', NULL),
(369, '2023-12-07', 20, 4, '2433', '2', 5, 5, 12, '2', 50.00, 2793.92, NULL, '2023-12-07 17:47:54', '2023-12-09 08:20:20', NULL),
(370, '2023-12-07', 20, 4, '2434', '2', 18, 5, 12, '2', 630.00, 2163.92, NULL, '2023-12-07 17:48:44', '2023-12-09 08:20:20', NULL),
(371, '2023-12-07', 19, 4, '2357', '2', 5, 21, 22, '2', 100.00, 2063.92, NULL, '2023-12-07 18:34:31', '2023-12-09 08:20:20', NULL),
(372, '2023-12-07', 19, 4, '2358', '2', 5, 21, 22, '2', 100.00, 1963.92, NULL, '2023-12-07 18:35:54', '2023-12-09 08:20:20', NULL),
(373, '2023-12-07', 19, 4, '2359', '2', 5, 21, 22, '2', 100.00, 1863.92, NULL, '2023-12-07 18:36:44', '2023-12-09 08:20:20', NULL),
(374, '2023-12-07', 19, 4, '2360', '2', 5, 21, 22, '2', 100.00, 1763.92, NULL, '2023-12-07 18:37:45', '2023-12-09 08:20:20', NULL),
(375, '2023-12-07', 19, 4, '2362', '2', 5, 21, 22, '2', 100.00, 1663.92, NULL, '2023-12-07 18:38:24', '2023-12-09 08:20:20', NULL),
(376, '2023-12-07', 19, 4, '2222', '2', 5, 13, 8, '2', 100.00, 1563.92, NULL, '2023-12-07 18:39:31', '2023-12-09 08:20:20', NULL),
(378, '2023-12-07', 19, 4, '2223', '1', 5, 13, 8, '2', 100.00, 1463.92, NULL, '2023-12-07 18:40:28', '2023-12-09 08:20:20', NULL),
(379, '2023-12-07', 19, 4, '2224', '2', 5, 13, 8, '2', 100.00, 1363.92, NULL, '2023-12-07 18:49:38', '2023-12-09 08:20:20', NULL),
(380, '2023-12-07', 19, 4, '2225', '2', 5, 13, 8, '2', 100.00, 1263.92, NULL, '2023-12-07 18:50:30', '2023-12-09 08:20:20', NULL),
(381, '2023-12-07', 19, 4, '2226', '2', 5, 13, 8, '2', 100.00, 1163.92, NULL, '2023-12-07 18:52:00', '2023-12-09 08:20:20', NULL),
(382, '2023-12-07', 23, 4, '2164', '2', 19, 22, 23, '2', 0.01, 1163.91, NULL, '2023-12-07 18:54:09', '2023-12-09 08:20:20', NULL),
(383, '2023-12-08', 19, 4, '2227', '2', 5, 13, 8, '2', 100.00, 1063.91, NULL, '2023-12-09 08:23:27', '2023-12-09 08:23:27', NULL),
(384, '2023-12-08', 19, 4, '2228', '2', 5, 13, 8, '2', 100.00, 963.91, NULL, '2023-12-09 08:24:05', '2023-12-09 08:24:05', NULL),
(385, '2023-12-08', 19, 4, '2230', '2', 5, 13, 8, '2', 100.00, 863.91, NULL, '2023-12-09 08:24:45', '2023-12-09 08:25:01', NULL),
(386, '2023-12-08', 19, 4, '2231', '2', 5, 13, 8, '2', 100.00, 763.91, NULL, '2023-12-09 08:25:48', '2023-12-09 08:25:48', NULL),
(387, '2023-12-08', 19, 4, '2232', '2', 5, 13, 8, '2', 100.00, 663.91, NULL, '2023-12-09 08:26:24', '2023-12-09 08:26:24', NULL),
(388, '2023-12-08', 19, 4, '2233', '2', 5, 13, 8, '2', 100.00, 563.91, NULL, '2023-12-09 08:27:48', '2023-12-09 08:27:48', NULL),
(389, '2023-12-08', 4, 5, '1', '1', 6, NULL, 16, '1', 6500.00, 7063.91, NULL, '2023-12-09 08:28:15', '2023-12-09 08:28:15', NULL),
(390, '2023-12-08', 18, 6, '1', '1', 6, NULL, 16, '2', 4000.00, 3063.91, 'Conexiones hidrosanitarias', '2023-12-09 08:29:18', '2023-12-09 08:29:18', NULL),
(391, '2023-12-08', 19, 4, '2363', '2', 5, 21, 22, '2', 100.00, 2963.91, NULL, '2023-12-09 08:30:56', '2023-12-09 08:30:56', NULL),
(392, '2023-12-08', 19, 4, '2364', '2', 5, 21, 22, '2', 100.00, 2863.91, NULL, '2023-12-09 08:31:38', '2023-12-09 08:31:38', NULL),
(393, '2023-12-08', 19, 4, '2365', '2', 5, 21, 22, '2', 100.00, 2763.91, NULL, '2023-12-09 08:32:15', '2023-12-09 08:32:15', NULL),
(394, '2023-12-08', 19, 4, '2366', '2', 5, 21, 22, '2', 100.00, 2663.91, NULL, '2023-12-09 08:32:55', '2023-12-09 08:32:55', NULL),
(395, '2023-12-08', 19, 4, '2367', '2', 5, 21, 22, '2', 100.00, 2563.91, NULL, '2023-12-09 08:33:31', '2023-12-09 08:33:31', NULL),
(396, '2023-12-08', 19, 4, '2368', '2', 5, 21, 22, '2', 100.00, 2463.91, NULL, '2023-12-09 08:34:11', '2023-12-09 08:34:11', NULL),
(397, '2023-12-08', 14, 4, '2435', '2', 10, 5, 12, '2', 800.00, 1663.91, '500 de galleros', '2023-12-09 08:35:39', '2023-12-09 08:35:39', NULL);
INSERT INTO `cajaChica` (`id`, `dia`, `concepto`, `comprobanteId`, `ncomprobante`, `cliente`, `obra`, `equipo`, `personal`, `tipo`, `cantidad`, `total`, `comentario`, `created_at`, `updated_at`, `servicioTrasporteId`) VALUES
(398, '2023-12-08', 20, 4, '2436', '2', 18, 5, 12, '2', 630.00, 1033.91, '500 de galleros', '2023-12-09 08:36:28', '2023-12-09 08:36:28', NULL),
(399, '2023-12-08', 33, 2, '1962', '1', 6, NULL, 14, '2', 50.00, 983.91, 'Silicon transparente', '2023-12-09 08:37:19', '2023-12-09 08:37:19', NULL),
(400, '2023-12-09', 32, 6, '1', '1', 6, NULL, 14, '2', 100.00, 883.91, NULL, '2023-12-09 08:38:08', '2023-12-09 08:38:08', NULL),
(401, '2023-12-09', 19, 4, '2234', '2', 5, 13, 8, '2', 100.00, 783.91, NULL, '2023-12-11 08:54:37', '2023-12-11 08:54:37', NULL),
(402, '2023-12-09', 19, 4, '2235', '2', 5, 13, 8, '2', 100.00, 683.91, NULL, '2023-12-11 08:55:56', '2023-12-11 08:55:56', NULL),
(403, '2023-12-02', 20, 4, '2437', '2', 5, 5, 12, '2', 50.00, 633.91, NULL, '2023-12-11 08:57:56', '2023-12-11 08:57:56', NULL),
(404, '2023-12-02', 20, 4, '2438', '2', 5, 5, 12, '2', 50.00, 633.91, NULL, '2023-12-11 08:59:12', '2023-12-11 08:59:12', NULL),
(405, '2023-12-09', 20, 4, '2439', '2', 4, 5, 12, '2', 130.00, 553.91, NULL, '2023-12-11 09:00:14', '2023-12-11 09:00:14', NULL),
(406, '2023-12-09', 19, 4, '2369', '2', 5, 13, 22, '2', 100.00, 453.91, NULL, '2023-12-11 09:02:33', '2023-12-11 09:02:33', NULL),
(407, '2023-12-09', 19, 4, '2370', '2', 5, 21, 22, '2', 100.00, 353.91, NULL, '2023-12-11 09:03:22', '2023-12-11 09:03:22', NULL),
(408, '2023-12-09', 19, 4, '2371', '2', 5, 21, 22, '2', 100.00, 253.91, NULL, '2023-12-11 09:04:03', '2023-12-11 09:04:03', NULL),
(409, '2023-12-09', 8, 4, '2372', '2', 4, 21, 22, '2', 200.00, 53.91, 'Se fiaron 1400', '2023-12-11 09:04:52', '2023-12-11 09:18:59', NULL),
(410, '2023-12-09', 20, 4, '2437', '2', 5, 5, 12, '2', 50.00, 3.91, NULL, '2023-12-11 09:14:37', '2023-12-11 09:14:37', NULL),
(411, '2023-12-09', 20, 4, '2438', '2', 5, 5, 12, '2', 50.00, -46.09, NULL, '2023-12-11 09:15:21', '2023-12-11 09:15:21', NULL),
(412, '2023-12-11', 1, 1, '1', NULL, NULL, NULL, 16, '1', 707.52, NULL, 'Ingreso hecho automatico por corte ', '2023-12-11 09:36:54', '2023-12-11 09:36:54', NULL),
(413, '2023-12-11', 2, 5, '1', '1', 6, NULL, 16, '1', 14250.00, 14250.00, NULL, '2023-12-11 09:45:57', '2023-12-11 09:45:57', NULL),
(414, '2023-12-11', 20, 4, '2441', '2', 4, 5, 12, '2', 130.00, 14120.00, NULL, '2023-12-12 18:46:49', '2023-12-12 18:46:49', NULL),
(415, '2023-12-11', 20, 4, '2440', '2', 4, 5, 12, '2', 150.00, 13970.00, NULL, '2023-12-12 18:48:30', '2023-12-12 18:48:30', NULL),
(416, '2023-12-11', 20, 4, '2442', '2', 18, 5, 12, '2', 650.00, 13320.00, NULL, '2023-12-12 18:50:05', '2023-12-12 18:50:05', NULL),
(417, '2023-12-12', 15, 4, '2443', '2', 7, 5, 12, '2', 250.00, 13070.00, NULL, '2023-12-12 19:06:51', '2023-12-12 19:06:51', NULL),
(419, '2023-12-12', 3, 4, '2236', '2', 5, 13, 8, '2', 300.00, 12520.00, NULL, '2023-12-13 13:58:33', '2023-12-13 13:58:33', NULL),
(420, '2023-12-12', 26, 4, '2373', '2', 17, 21, 22, '2', 2644.00, 9876.00, NULL, '2023-12-13 14:00:24', '2023-12-13 14:00:24', NULL),
(421, '2023-12-12', 8, 4, '2374', '2', 17, 21, 22, '2', 1600.00, 8276.00, NULL, '2023-12-13 14:01:37', '2023-12-13 14:01:37', NULL),
(422, '2023-12-12', 3, 4, '2375', '2', 4, 21, 22, '2', 300.00, 7976.00, NULL, '2023-12-13 14:02:53', '2023-12-13 14:02:53', NULL),
(423, '2023-12-13', 3, 4, '2376', '2', 5, 21, 22, '2', 300.00, 7676.00, NULL, '2023-12-14 07:09:37', '2023-12-14 07:09:37', NULL),
(424, '2023-12-13', 24, 4, '2377', '2', 4, 21, 22, '2', 0.01, 7675.99, NULL, '2023-12-14 07:11:49', '2023-12-14 07:11:49', NULL),
(425, '2023-12-13', 20, 4, '2444', '2', 18, 5, 12, '2', 630.00, 7045.99, 'carga con galleros', '2023-12-14 07:13:09', '2023-12-14 07:13:09', NULL),
(426, '2023-12-14', 10, 4, '2445', '2', 4, 5, 12, '2', 750.00, 6295.99, NULL, '2023-12-15 11:29:12', '2023-12-15 11:29:12', NULL),
(427, '2023-12-14', 20, 4, '2446', '2', 18, 5, 12, '2', 630.00, 5665.99, NULL, '2023-12-15 11:30:22', '2023-12-15 11:30:22', NULL),
(428, '2023-12-14', 22, 4, '2237', '2', 23, 13, 8, '2', 1.00, 5664.99, 'obra JOCOTEPEC', '2023-12-15 11:32:29', '2023-12-18 10:18:24', NULL),
(429, '2023-12-14', 3, 4, '2238', '2', 23, 13, 8, '2', 950.00, 4714.99, 'Obra Asabache', '2023-12-15 11:34:03', '2023-12-18 10:18:24', NULL),
(430, '2023-12-14', 3, 4, '2379', '2', 5, 21, 22, '2', 300.00, 4414.99, NULL, '2023-12-15 11:35:39', '2023-12-18 10:18:24', NULL),
(431, '2023-12-14', 3, 4, '2380', '2', 5, 21, 22, '2', 300.00, 4114.99, NULL, '2023-12-15 11:36:45', '2023-12-18 10:18:24', NULL),
(432, '2023-12-14', 32, 6, '0001', '1', 6, NULL, 14, '2', 100.00, 4014.99, NULL, '2023-12-15 11:49:50', '2023-12-18 10:18:55', NULL),
(433, '2023-12-14', 23, 4, '2165', '2', 4, 22, 23, '2', 0.01, 4014.98, NULL, '2023-12-16 12:24:21', '2023-12-18 10:18:24', NULL),
(434, '2023-12-15', 23, 4, '2166', '2', 4, 22, 23, '2', 0.01, 4014.97, NULL, '2023-12-16 12:25:35', '2023-12-18 10:18:24', NULL),
(435, '2023-12-16', 20, 4, '2447', '2', 4, 5, 12, '2', 130.00, 3884.97, NULL, '2023-12-16 12:26:39', '2023-12-18 10:18:24', NULL),
(436, '2023-12-16', 19, 4, '2381', '2', 4, 21, 22, '2', 260.00, 3624.97, NULL, '2023-12-16 13:12:07', '2023-12-18 10:18:24', NULL),
(437, '2023-12-16', 33, 2, '01', '1', 6, 31, 14, '2', 1000.00, 2624.97, 'Abono perno miniretro', '2023-12-16 13:14:44', '2023-12-18 10:18:24', NULL),
(438, '2023-12-18', 1, 1, '1', NULL, NULL, NULL, 16, '1', 3582.49, NULL, 'Ingreso hecho automatico por corte ', '2023-12-18 13:13:39', '2023-12-18 13:13:39', NULL),
(439, '2023-12-18', 2, 5, '0001', '1', 6, NULL, 16, '1', 11330.00, 11330.00, NULL, '2023-12-18 13:16:21', '2023-12-18 13:16:21', NULL),
(440, '2023-12-18', 10, 4, '1447', '2', 19, 13, 8, '2', 750.00, 10580.00, NULL, '2023-12-18 17:58:17', '2023-12-18 17:58:17', NULL),
(441, '2023-12-18', 27, 4, '1448', '2', 19, 13, 8, '2', 0.01, 10579.99, NULL, '2023-12-18 17:58:46', '2023-12-18 17:58:46', NULL),
(442, '2023-12-18', 7, 4, '2382', '2', 19, 15, 22, '2', 350.00, 10229.99, NULL, '2023-12-18 18:00:36', '2023-12-18 18:00:36', NULL),
(443, '2023-12-18', 7, 4, '2383', '2', 19, 15, 22, '2', 0.01, 10229.98, NULL, '2023-12-18 18:01:16', '2023-12-18 18:01:16', NULL),
(444, '2023-12-18', 20, 4, '2448', '2', 24, 5, 12, '2', 650.00, 9579.98, '500 de galleros', '2023-12-18 18:11:51', '2023-12-18 18:11:51', NULL),
(445, '2023-12-18', 20, 4, '2449', '2', 18, 5, 12, '2', 630.00, 8949.98, NULL, '2023-12-18 18:12:40', '2023-12-19 08:50:13', NULL),
(447, '2023-12-20', 45, 2, '94704', '1', 6, NULL, 16, '2', 775.00, 8174.98, NULL, '2023-12-20 08:39:55', '2023-12-20 08:39:55', NULL),
(448, '2023-12-20', 45, 2, '245631', '1', 6, NULL, 16, '2', 1600.00, 6574.98, NULL, '2023-12-20 08:41:02', '2023-12-20 08:41:02', NULL),
(449, '2023-12-20', 45, 2, '82030', '1', 6, NULL, 16, '2', 413.00, 6161.98, NULL, '2023-12-20 08:41:53', '2023-12-20 08:41:53', NULL),
(450, '2023-12-19', 7, 4, '2007', '2', 16, 15, 22, '2', 350.00, 5811.98, NULL, '2023-12-20 08:49:24', '2023-12-20 08:49:24', NULL),
(451, '2023-12-20', 4, 5, '1', '1', 6, NULL, 16, '1', 2788.00, 8949.98, NULL, '2023-12-20 08:49:32', '2023-12-20 08:49:32', NULL),
(452, '2023-12-19', 27, 4, '2450', '2', 5, 5, 12, '2', 1325.00, 7624.98, NULL, '2023-12-20 08:52:29', '2023-12-20 08:52:29', NULL),
(453, '2023-12-19', 15, 4, '2451', '2', 7, 5, 12, '2', 300.00, 8649.98, NULL, '2023-12-20 08:53:53', '2023-12-20 08:53:53', NULL),
(454, '2023-12-19', 20, 4, '2452', '2', 8, 5, 12, '2', 630.00, 8319.98, NULL, '2023-12-20 08:55:09', '2023-12-20 08:55:09', NULL),
(455, '2023-12-19', 3, 4, '2239', '2', 16, 13, 8, '2', 350.00, 8599.98, NULL, '2023-12-20 08:57:43', '2023-12-20 08:57:43', NULL),
(456, '2023-12-19', 19, 4, '2240', '2', 4, 13, 8, '2', 300.00, 8649.98, NULL, '2023-12-20 08:58:40', '2023-12-20 08:58:40', NULL),
(457, '2023-12-19', 19, 4, '2243', '2', 4, 13, 8, '2', 260.00, 8689.98, NULL, '2023-12-20 08:59:48', '2023-12-20 08:59:48', NULL),
(458, '2023-12-19', 33, 1, '01', '1', 6, 31, 14, '2', 2132.00, 6817.98, 'pernos miniretro', '2023-12-20 09:02:06', '2023-12-20 09:02:06', NULL),
(459, '2023-12-20', 19, 4, '2385', '2', 7, 21, 22, '2', 340.00, 8609.98, NULL, '2023-12-21 08:36:30', '2023-12-21 08:36:30', NULL),
(460, '2023-12-20', 15, 4, '2453', '2', 10, 5, 12, '2', 800.00, 7809.98, 'carga con galleros', '2023-12-21 08:43:08', '2023-12-21 08:43:08', NULL),
(461, '2023-12-20', 20, 4, '2454', '2', 8, 5, 12, '2', 630.00, 7179.98, 'carga con galleros', '2023-12-21 08:45:36', '2023-12-21 08:45:36', NULL),
(462, '2023-12-21', 32, 6, NULL, NULL, 6, NULL, 14, '2', 80.00, 7099.98, NULL, '2023-12-21 08:51:30', '2023-12-21 08:51:30', NULL),
(463, '2023-12-21', 7, 4, '2025', '2', 17, 15, 8, '2', 350.00, 6749.98, NULL, '2023-12-21 16:42:03', '2023-12-21 16:42:39', NULL),
(464, '2023-12-21', 8, 4, '2386', '2', 4, 21, 22, '2', 1400.00, 5349.98, NULL, '2023-12-21 16:44:20', '2023-12-21 16:44:20', NULL),
(465, '2023-12-21', 19, 4, '2387', '2', 4, 21, 22, '2', 260.00, 5089.98, NULL, '2023-12-21 16:45:28', '2023-12-21 16:45:28', NULL),
(466, '2023-12-21', 20, 4, '2455', '2', 18, 5, 12, '2', 630.00, 4459.98, NULL, '2023-12-21 18:58:11', '2023-12-21 18:58:11', NULL),
(467, '2023-12-22', 4, 5, '1', '1', 6, NULL, 16, '1', 2500.00, 6959.98, NULL, '2023-12-22 08:21:08', '2023-12-22 08:21:08', NULL),
(468, '2023-12-22', 34, 6, '1', '1', 6, 8, 14, '2', 3500.00, 3459.98, NULL, '2023-12-22 17:04:54', '2023-12-22 17:04:54', NULL),
(469, '2023-12-22', 4, 5, '1', '1', 6, NULL, 26, '1', 3500.00, 6959.98, NULL, '2023-12-22 17:05:19', '2023-12-22 17:05:19', NULL),
(470, '2023-12-22', 37, 4, '2456', '2', 5, 5, 12, '2', 150.00, 6809.98, NULL, '2023-12-26 08:40:22', '2023-12-26 08:40:22', NULL),
(471, '2023-12-22', 20, 4, '2457', '2', 18, 5, 12, '2', 630.00, 6179.98, '500 de galleros', '2023-12-26 08:41:23', '2023-12-26 08:41:23', NULL),
(472, '2023-12-22', 3, 4, '2244', '2', 23, 13, 8, '2', 950.00, 5229.98, NULL, '2023-12-26 08:43:19', '2023-12-26 08:43:19', NULL),
(473, '2023-12-22', 19, 4, '2245', '2', 23, 13, 8, '2', 350.00, 4879.98, NULL, '2023-12-26 08:44:00', '2023-12-26 08:44:00', NULL),
(474, '2023-12-25', 1, 1, '1', NULL, NULL, NULL, 16, '1', 2815.47, NULL, 'Ingreso hecho automatico por corte ', '2023-12-26 08:50:09', '2023-12-26 08:50:09', NULL),
(475, '2023-12-26', 2, 5, '1', '1', 6, NULL, 26, '1', 12185.00, 12185.00, NULL, '2023-12-26 08:56:54', '2023-12-26 08:56:54', NULL),
(476, '2023-12-26', 33, 4, '19543', NULL, 6, NULL, 14, '2', 170.00, 12015.00, NULL, '2023-12-26 18:09:27', '2023-12-26 18:09:27', NULL),
(477, '2023-12-26', 3, 4, '2246', '2', 4, 13, 8, '2', 350.00, 11665.00, NULL, '2023-12-26 18:11:05', '2023-12-26 18:11:05', NULL),
(478, '2023-12-26', 3, 4, '2247', '2', 4, 13, 8, '2', 350.00, 11315.00, NULL, '2023-12-26 18:24:37', '2023-12-26 18:24:37', NULL),
(479, '2023-12-26', 19, 4, '2248', '2', 4, 13, 8, '2', 260.00, 11055.00, NULL, '2023-12-26 18:26:11', '2023-12-26 18:26:11', NULL),
(480, '2023-12-26', 20, 4, '2458', '2', 18, 5, 12, '2', 630.00, 10425.00, NULL, '2023-12-26 18:30:24', '2023-12-26 18:30:24', NULL),
(481, '2023-12-26', 23, 4, '2167', '2', 4, 22, 23, '2', 0.01, 10424.99, NULL, '2023-12-26 18:34:09', '2023-12-26 18:34:09', NULL),
(482, '2023-12-27', 36, 4, '2460', '2', 4, 5, 12, '2', 2258.00, 8166.99, NULL, '2023-12-27 18:21:03', '2023-12-27 18:24:09', NULL),
(483, '2023-12-27', 20, 4, '2459', '2', 4, 5, 12, '2', 150.00, 8016.99, NULL, '2023-12-27 18:25:02', '2023-12-27 18:25:02', NULL),
(484, '2023-12-27', 20, 4, '2461', '2', 18, 5, 12, '2', 630.00, 7386.99, NULL, '2023-12-27 18:39:07', '2023-12-27 18:39:07', NULL),
(485, '2023-12-27', 46, 4, '2249', '2', 23, 13, 8, '2', 4060.00, 3326.99, NULL, '2023-12-28 08:39:00', '2023-12-28 09:14:23', NULL),
(486, '2023-12-27', 19, 4, '2250', '2', 23, 13, 8, '2', 300.00, 3026.99, NULL, '2023-12-28 08:40:11', '2023-12-28 08:40:11', NULL),
(487, '2023-12-27', 19, 4, '1449', '2', 23, 13, 8, '2', 300.00, 2726.99, NULL, '2023-12-28 08:41:12', '2023-12-28 08:41:12', NULL),
(488, '2023-12-27', 19, 4, '1450', '2', 23, 13, 8, '2', 350.00, 2376.99, NULL, '2023-12-28 08:42:03', '2023-12-28 08:42:03', NULL),
(489, '2023-12-27', 3, 4, '2388', '2', 4, 21, 22, '2', 350.00, 2026.99, NULL, '2023-12-28 08:43:20', '2023-12-28 08:43:20', NULL),
(490, '2023-12-27', 3, 4, '2389', '2', 4, 21, 22, '2', 350.00, 1676.99, NULL, '2023-12-28 08:44:29', '2023-12-28 08:44:29', NULL),
(491, '2023-12-27', 19, 4, '2390', '2', 4, 21, 22, '2', 260.00, 1416.99, NULL, '2023-12-28 08:45:37', '2023-12-28 08:45:37', NULL),
(492, '2023-12-27', 3, 4, '2391', '2', 4, 21, 22, '2', 350.00, 1066.99, NULL, '2023-12-28 08:46:35', '2023-12-28 08:46:35', NULL),
(493, '2023-12-27', 19, 4, '2392', '2', 4, 21, 22, '2', 260.00, 806.99, NULL, '2023-12-28 08:47:31', '2023-12-28 08:47:31', NULL),
(494, '2023-12-28', 4, 5, '1', '1', 6, NULL, 26, '1', 10000.00, 10806.99, NULL, '2023-12-28 09:08:25', '2023-12-28 09:08:25', NULL),
(495, '2023-12-28', 20, 4, '2462', '2', 17, 5, 12, '2', 150.00, 10656.99, NULL, '2023-12-28 18:08:34', '2023-12-28 18:08:34', NULL),
(496, '2023-12-28', 20, 4, '2463', '2', 18, 5, 12, '2', 650.00, 10006.99, NULL, '2023-12-28 18:11:31', '2023-12-28 18:11:31', NULL),
(497, '2023-12-28', 46, 4, '2551', '2', 23, 13, 8, '2', 4060.00, 5946.99, NULL, '2023-12-28 18:16:00', '2023-12-28 18:16:00', NULL),
(498, '2023-12-28', 19, 4, '2552', '2', 23, 13, 8, '2', 300.00, 5646.99, NULL, '2023-12-28 18:18:31', '2023-12-28 18:18:31', NULL),
(499, '2023-12-28', 19, 4, '2553', '2', 23, 13, 8, '2', 300.00, 5346.99, NULL, '2023-12-28 18:19:25', '2023-12-28 18:19:25', NULL),
(500, '2023-12-28', 33, 2, '01', NULL, 6, NULL, 14, '2', 75.00, 5271.99, NULL, '2023-12-28 18:25:20', '2023-12-28 18:25:20', NULL),
(501, '2023-12-28', 7, 4, '2026', '2', 19, 15, 22, '2', 300.00, 4971.99, NULL, '2023-12-28 18:41:58', '2023-12-28 18:41:58', NULL),
(502, '2023-12-29', 3, 4, '2393', '2', 4, 21, 22, '2', 350.00, 4621.99, NULL, '2023-12-29 19:22:30', '2023-12-29 19:22:30', NULL),
(503, '2023-12-29', 3, 4, '2394', '2', 4, 21, 22, '2', 350.00, 4271.99, NULL, '2023-12-29 19:23:30', '2023-12-29 19:23:30', NULL),
(504, '2023-12-29', 19, 4, '2395', '2', 4, 21, 22, '2', 260.00, 4011.99, NULL, '2023-12-29 19:24:25', '2023-12-29 19:24:25', NULL),
(505, '2023-12-29', 25, 4, '2464', '2', 17, 5, 12, '2', 0.01, 4011.98, 'viajes internos', '2023-12-29 19:37:11', '2023-12-29 19:37:11', NULL),
(506, '2023-12-29', 20, 4, '2466', '2', 18, 5, 12, '2', 650.00, 3361.98, NULL, '2023-12-29 19:39:04', '2023-12-29 19:39:04', NULL),
(507, '2023-12-29', 34, 1, NULL, NULL, 6, 8, 14, '2', 2500.00, 861.98, 'modulo de cherokee', '2023-12-29 19:41:38', '2023-12-29 19:41:38', NULL),
(508, '2024-01-01', 1, 1, '1', NULL, NULL, NULL, 16, '1', 3677.45, NULL, 'Ingreso hecho automatico por corte ', '2024-01-02 08:46:00', '2024-01-02 08:46:00', NULL),
(509, '2024-01-02', 2, 5, '1', '1', 6, NULL, 26, '1', 11000.00, 11000.00, NULL, '2024-01-02 08:47:28', '2024-01-02 18:02:29', NULL),
(510, '2024-01-02', 8, 4, '2396', '2', 4, 21, 22, '2', 1490.00, 9510.00, NULL, '2024-01-02 18:35:20', '2024-01-02 18:35:20', NULL),
(511, '2024-01-02', 19, 4, '2397', '2', 4, 21, 22, '2', 260.00, 9250.00, NULL, '2024-01-02 18:36:59', '2024-01-02 18:36:59', NULL),
(512, '2024-01-02', 19, 4, '2398', '2', 4, 21, 22, '2', 260.00, 8990.00, NULL, '2024-01-02 18:38:04', '2024-01-02 18:38:04', NULL),
(513, '2024-01-02', 23, 4, '2168', '2', 4, 22, 23, '2', 0.01, 8989.99, NULL, '2024-01-02 18:39:29', '2024-01-02 18:39:29', NULL),
(514, '2024-01-02', 10, 4, '2467', '2', 19, 5, 12, '2', 700.00, 8289.99, NULL, '2024-01-03 09:03:40', '2024-01-03 09:03:40', NULL),
(515, '2024-01-03', 27, 4, '2468', '2', 19, 5, 12, '2', 0.01, 8289.98, NULL, '2024-01-03 18:14:26', '2024-01-03 18:14:26', NULL),
(516, '2024-01-03', 20, 4, '2469', '2', 18, 5, 12, '2', 680.00, 7609.98, NULL, '2024-01-03 18:15:57', '2024-01-06 13:33:29', NULL),
(517, '2024-01-02', 32, 2, NULL, NULL, 6, 17, 14, '2', 60.00, 7599.98, NULL, '2024-01-03 18:24:38', '2024-01-03 18:24:38', NULL),
(518, '2024-01-03', 23, 4, '2603', '2', 4, 22, 23, '2', 0.01, 7609.97, NULL, '2024-01-04 11:27:23', '2024-01-06 13:33:29', NULL),
(519, '2024-01-03', 17, 4, '2169', '1', 20, 22, 23, '2', 2034.00, 5575.97, 'flete a manzanillo', '2024-01-04 11:31:18', '2024-01-06 13:33:29', NULL),
(520, '2024-01-04', 7, 4, '2027', '2', 16, 15, 22, '2', 0.01, 5575.96, NULL, '2024-01-05 08:18:57', '2024-01-06 13:33:29', NULL),
(521, '2024-01-04', 10, 4, '2470', '2', 5, 5, 12, '2', 700.00, 4875.96, NULL, '2024-01-05 08:22:26', '2024-01-06 13:33:29', NULL),
(522, '2024-01-04', 20, 4, '2471', '2', 18, 5, 12, '2', 680.00, 4195.96, NULL, '2024-01-05 08:24:00', '2024-01-06 13:33:29', NULL),
(523, '2024-01-04', 19, 4, '2554', '2', 5, 13, 8, '2', 350.00, 3845.96, NULL, '2024-01-05 08:27:45', '2024-01-06 13:33:29', NULL),
(524, '2024-01-04', 33, 2, '01', '2', 6, 14, 14, '2', 120.00, 3725.96, NULL, '2024-01-05 08:31:02', '2024-01-06 13:33:29', NULL),
(525, '2024-01-05', 3, 4, '2556', '1', 4, 13, 8, '2', 350.00, 3375.96, NULL, '2024-01-05 18:04:04', '2024-01-06 13:33:29', NULL),
(526, '2024-01-05', 19, 4, '2555', '2', 4, 13, 8, '2', 260.00, 3115.96, NULL, '2024-01-05 18:05:35', '2024-01-06 13:33:29', NULL),
(527, '2024-01-05', 20, 4, '2472', '2', 4, 5, 12, '2', 150.00, 2965.96, NULL, '2024-01-05 18:06:59', '2024-01-06 13:33:29', NULL),
(528, '2024-01-05', 20, 4, '2473', '2', 18, 5, 12, '2', 680.00, 2285.96, NULL, '2024-01-05 18:08:13', '2024-01-06 13:33:29', NULL),
(529, '2024-01-06', 20, 4, '2474', '2', 18, 5, 12, '2', 680.00, 1605.96, NULL, '2024-01-06 13:13:37', '2024-01-06 13:33:29', NULL),
(530, '2024-01-06', 26, 4, '2557', '2', 4, 13, 8, '2', 2695.00, -1089.04, '50 pesos de propina al operador', '2024-01-06 13:16:16', '2024-01-06 13:33:29', NULL),
(531, '2024-01-06', 7, 4, '2028', '2', 19, 15, 22, '2', 380.00, -1469.04, NULL, '2024-01-08 08:11:38', '2024-01-08 08:11:38', NULL),
(532, '2024-01-04', 28, 4, '270', '2', 19, 22, 23, '2', 0.01, -1469.05, NULL, '2024-01-08 08:16:41', '2024-01-08 08:16:41', NULL),
(533, '2024-01-05', 28, 4, '2171', '2', 19, 22, 23, '2', 0.01, -1469.05, NULL, '2024-01-08 08:17:34', '2024-01-08 08:17:34', NULL),
(534, '2024-01-06', 28, 4, '2172', '2', 19, 22, 23, '2', 0.01, -1469.05, NULL, '2024-01-08 08:18:19', '2024-01-08 08:18:19', NULL),
(535, '2024-01-08', 1, 1, '1', NULL, NULL, NULL, 16, '1', 2148.38, NULL, 'Ingreso hecho automatico por corte ', '2024-01-08 08:29:05', '2024-01-08 08:29:05', NULL),
(536, '2024-01-08', 4, 5, NULL, '1', 6, NULL, 26, '1', 10000.00, 10000.00, NULL, '2024-01-08 10:54:39', '2024-01-08 11:01:22', NULL),
(537, '2024-01-08', 10, 4, '2475', '2', 19, 5, 12, '2', 700.00, 9300.00, NULL, '2024-01-08 18:53:39', '2024-01-08 18:53:39', NULL),
(538, '2024-01-08', 27, 4, '2476', '2', 19, 5, 12, '2', 0.01, 9299.99, NULL, '2024-01-08 19:00:12', '2024-01-08 19:00:12', NULL),
(539, '2024-01-08', 36, 4, '2558', '2', 4, 13, 8, '2', 1850.00, 7449.99, NULL, '2024-01-08 19:02:44', '2024-01-08 19:02:44', NULL),
(540, '2024-01-08', 8, 4, '2560', '2', 17, 13, 8, '2', 1400.00, 6049.99, NULL, '2024-01-08 19:03:40', '2024-01-08 19:03:40', NULL),
(541, '2024-01-08', 7, 4, '2030', '2', 17, 15, 22, '2', 0.01, 6049.98, NULL, '2024-01-08 19:05:19', '2024-01-08 19:05:19', NULL),
(542, '2024-01-09', 4, 5, NULL, '1', 6, NULL, 26, '1', 15500.00, 21549.98, NULL, '2024-01-09 14:14:44', '2024-01-10 18:02:38', NULL),
(543, '2024-01-09', 48, 6, NULL, '1', 6, NULL, 26, '2', 15000.00, 6549.98, NULL, '2024-01-09 14:16:17', '2024-01-10 18:02:38', NULL),
(544, '2024-01-09', 19, 4, '2561', '2', 4, 13, 8, '2', 340.00, 6209.98, NULL, '2024-01-09 18:17:09', '2024-01-10 18:02:38', NULL),
(545, '2024-01-09', 26, 4, '2008', '2', 17, 21, 22, '2', 2694.40, 3515.58, '50 propina operador', '2024-01-09 18:20:07', '2024-01-10 18:02:38', NULL),
(546, '2024-01-09', 20, 4, '2477', '2', 10, 5, 12, '2', 850.00, 2665.58, 'pura basura', '2024-01-09 18:24:29', '2024-01-10 18:02:38', NULL),
(547, '2024-01-09', 20, 4, '2478', '2', 18, 5, 12, '2', 680.00, 1985.58, NULL, '2024-01-09 18:26:18', '2024-01-10 18:02:38', NULL),
(548, '2024-01-09', 7, 4, '2031', '1', 16, 15, 22, '2', 330.00, 1655.58, NULL, '2024-01-09 18:33:42', '2024-01-10 18:02:38', NULL),
(549, '2024-01-09', 28, 4, '2173', '2', 23, 22, 23, '2', 0.01, 1655.57, NULL, '2024-01-10 08:53:09', '2024-01-10 18:02:38', NULL),
(550, '2024-01-09', 28, 4, '2174', '2', 23, 22, 23, '2', 0.01, 1655.56, NULL, '2024-01-10 08:53:56', '2024-01-10 18:02:38', NULL),
(551, '2024-01-10', 27, 4, '2479', '2', 7, 5, 12, '2', 1323.00, 332.56, NULL, '2024-01-10 18:04:20', '2024-01-10 18:04:20', NULL),
(552, '2024-01-10', 15, 4, '2480', '2', 7, 5, 12, '2', 200.00, 132.56, NULL, '2024-01-10 18:05:04', '2024-01-10 18:05:04', NULL),
(553, '2024-01-10', 10, 4, '2481', '2', 7, 5, 12, '2', 1200.00, -1067.44, NULL, '2024-01-10 18:05:47', '2024-01-10 18:05:47', NULL),
(554, '2024-01-10', 20, 4, '2482', '2', 18, 5, 12, '2', 680.00, -1747.44, NULL, '2024-01-10 18:07:24', '2024-01-11 13:03:05', NULL),
(555, '2024-01-10', 7, 4, '2032', '2', 10, 15, 22, '2', 330.00, -2077.44, NULL, '2024-01-10 18:08:21', '2024-01-11 13:03:05', NULL),
(556, '2024-01-10', 4, 5, NULL, '1', 6, NULL, 26, '1', 10000.00, 7922.56, NULL, '2024-01-10 18:13:39', '2024-01-11 13:03:05', NULL),
(557, '2024-01-11', 20, 4, '2483', '2', 18, 5, 22, '2', 700.00, 7222.56, NULL, '2024-01-12 08:37:02', '2024-01-12 08:37:02', NULL),
(558, '2024-01-11', 3, 4, '2562', '2', 4, 13, 8, '2', 350.00, 6872.56, NULL, '2024-01-12 08:38:19', '2024-01-12 08:38:19', NULL),
(559, '2024-01-11', 8, 4, '2563', '2', 4, 13, 8, '2', 1450.00, 5422.56, NULL, '2024-01-12 08:39:46', '2024-01-12 08:39:46', NULL),
(560, '2024-01-11', 28, 4, '2175', '2', 19, 22, 23, '2', 0.01, 5422.55, NULL, '2024-01-12 08:45:21', '2024-01-12 08:45:21', NULL),
(561, '2024-01-12', 20, 4, '2484', '2', 18, 5, 12, '2', 680.00, 4742.55, NULL, '2024-01-13 08:22:10', '2024-01-13 08:22:10', NULL),
(562, '2024-01-12', 8, 4, '2009', '2', 16, 21, 22, '2', 1500.00, 3242.55, '50 de propina operador', '2024-01-13 08:24:33', '2024-01-13 08:24:33', NULL),
(563, '2024-01-12', 28, 4, '2176', '2', 4, 22, 23, '2', 0.01, 3242.54, NULL, '2024-01-13 08:26:52', '2024-01-13 08:26:52', NULL),
(564, '2024-01-12', 33, 1, '271018', '1', 6, 14, 14, '2', 84.00, 3158.54, NULL, '2024-01-13 08:30:47', '2024-01-13 08:30:47', NULL),
(565, '2024-01-12', 33, 2, NULL, NULL, 6, NULL, 14, '2', 45.00, 3113.54, NULL, '2024-01-13 08:31:43', '2024-01-13 08:31:43', NULL),
(566, '2024-01-13', 11, 4, '2485', '2', 18, 5, 12, '2', 2088.00, 1025.54, NULL, '2024-01-13 13:44:16', '2024-01-13 13:44:16', NULL),
(567, '2024-01-13', 33, 2, NULL, NULL, NULL, 16, 14, '2', 150.00, 875.54, NULL, '2024-01-13 13:46:12', '2024-01-13 13:46:12', NULL),
(568, '2024-01-13', 33, 2, NULL, NULL, NULL, NULL, 14, '2', 15.00, 860.54, NULL, '2024-01-13 13:47:04', '2024-01-13 13:47:04', NULL),
(569, '2024-01-13', 33, 3, '14113', NULL, NULL, NULL, 14, '2', 63.00, 797.54, NULL, '2024-01-13 13:48:03', '2024-01-13 13:48:03', NULL),
(570, '2024-01-15', 1, 1, '1', NULL, NULL, NULL, 16, '1', 2945.92, NULL, 'Ingreso hecho automatico por corte ', '2024-01-15 08:45:19', '2024-01-15 08:45:19', NULL),
(571, '2024-01-15', 2, 6, NULL, '1', 6, NULL, 26, '1', 10000.00, 10000.00, NULL, '2024-01-15 11:36:46', '2024-01-15 11:36:46', NULL),
(572, '2024-01-15', 36, 4, '2487', '2', 4, 5, 8, '2', 2436.00, 7564.00, NULL, '2024-01-16 08:43:18', '2024-01-16 08:43:18', NULL),
(573, '2024-01-15', 19, 4, '2011', '2', 17, 21, 22, '2', 390.00, 7174.00, 'escombro con basura', '2024-01-16 08:49:35', '2024-01-16 08:49:35', NULL),
(574, '2024-01-15', 19, 4, '2012', '2', 4, 21, 22, '2', 260.00, 6914.00, NULL, '2024-01-16 08:50:37', '2024-01-16 08:50:37', NULL),
(575, '2024-01-15', 43, 4, '2013', '2', 17, 21, 22, '2', 0.01, 6913.99, 'viaje interno', '2024-01-16 08:52:58', '2024-01-16 08:52:58', NULL),
(576, '2024-01-15', 24, 4, '2014', '2', 17, 21, 22, '2', 0.01, 6913.98, 'viaje interno', '2024-01-16 08:58:32', '2024-01-16 08:58:32', NULL),
(577, '2024-01-15', 19, 4, '2015', '2', 17, 21, 22, '2', 260.00, 6653.98, NULL, '2024-01-16 08:59:32', '2024-01-16 08:59:32', NULL),
(578, '2024-01-15', 19, 4, '2400', '2', 17, 21, 22, '2', 260.00, 6393.98, NULL, '2024-01-16 09:00:27', '2024-01-16 09:00:27', NULL),
(579, '2024-01-15', 28, 4, '2177', '2', 19, 22, 23, '2', 0.01, 6393.97, NULL, '2024-01-16 09:05:04', '2024-01-16 09:05:04', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendarioPrincipal`
--

DROP TABLE IF EXISTS `calendarioPrincipal`;
CREATE TABLE IF NOT EXISTS `calendarioPrincipal` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `mantenimientoId` bigint(20) UNSIGNED DEFAULT NULL,
  `tipoMantenimientoId` bigint(20) UNSIGNED DEFAULT NULL,
  `maquinariaId` bigint(20) UNSIGNED DEFAULT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `personalId` bigint(20) UNSIGNED DEFAULT NULL,
  `solicitudesId` bigint(20) UNSIGNED DEFAULT NULL,
  `estadoId` bigint(20) UNSIGNED NOT NULL,
  `actividadesId` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha` date NOT NULL,
  `descripcion` text,
  `estatus` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `tipoEvento` varchar(255) NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `prioridad` varchar(100) DEFAULT NULL,
  `documentosVencimiento` int(10) DEFAULT NULL,
  `eventoImportante` int(10) DEFAULT NULL,
  `eventoImportanteId` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_calendarioPrincipal_mantenimientoId` (`mantenimientoId`),
  KEY `FK_calendarioPrincipal_tipoMantenimientoId` (`tipoMantenimientoId`),
  KEY `FK_calendarioPrincipal_maquinariaId` (`maquinariaId`),
  KEY `FK_calendarioPrincipal_userId` (`userId`),
  KEY `FK_calendarioPrincipal_personalId` (`personalId`),
  KEY `FK_calendarioPrincipal_solicitudesId` (`solicitudesId`),
  KEY `FK_calendarioPrincipal_actividadesId` (`actividadesId`),
  KEY `FK_calendarioPrincipal_estadoId` (`estadoId`),
  KEY `FK_calendarioPrincipal_eventoImportanteId` (`eventoImportanteId`)
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `calendarioPrincipal`
--

INSERT INTO `calendarioPrincipal` (`id`, `title`, `mantenimientoId`, `tipoMantenimientoId`, `maquinariaId`, `userId`, `personalId`, `solicitudesId`, `estadoId`, `actividadesId`, `fecha`, `descripcion`, `estatus`, `color`, `tipoEvento`, `start`, `end`, `created_at`, `updated_at`, `prioridad`, `documentosVencimiento`, `eventoImportante`, `eventoImportanteId`) VALUES
(1, 'Test', NULL, NULL, NULL, 5, 9, NULL, 1, 1, '0000-00-00', 'Quia ratione volupta', 'En Espera', '#ffa500', '', '2023-09-07 12:08:00', NULL, '2023-09-07 21:22:12', '2023-09-07 21:22:12', NULL, NULL, NULL, NULL),
(2, 'Limpiar Bote', NULL, NULL, NULL, 4, 2, NULL, 1, 2, '0000-00-00', NULL, 'En Espera', '#ff0000', '', '2023-09-11 19:17:00', NULL, '2023-09-08 23:15:56', '2023-09-08 23:15:56', NULL, NULL, NULL, NULL),
(4, 'Test 2', NULL, NULL, NULL, 5, 9, NULL, 1, 5, '2023-08-21', NULL, 'En Espera', '#ffa500', 'actividades', '2023-08-21 21:05:00', NULL, '2023-09-11 22:04:19', '2023-09-11 22:05:50', 'Necesaria', NULL, NULL, NULL),
(5, 'Lavar bote', NULL, NULL, NULL, 3, 2, NULL, 1, 6, '0000-00-00', NULL, 'En Espera', '#ff0000', 'actividades', '2023-09-12 08:15:00', NULL, '2023-09-12 15:03:04', '2023-09-12 15:03:04', 'Urgente', NULL, NULL, NULL),
(6, 'Prueba de revisión', NULL, NULL, NULL, 2, 1, NULL, 1, 7, '0000-00-00', 'Prueba de revisión y colores', 'En Espera', '#ffa500', 'actividades', '2023-09-13 09:00:00', NULL, '2023-09-13 13:08:19', '2023-09-13 13:08:19', 'Necesaria', NULL, NULL, NULL),
(7, 'Solicitud 1 de Julio Test', NULL, NULL, 3, 1, 14, 1, 1, NULL, '2023-07-01', 'Solicitud Para Mas Herramientas', 'En Espera', '#ffff00', 'solicitud', '2023-07-01 17:12:00', NULL, '2023-09-13 22:13:22', '2023-09-13 22:22:46', 'Deseable', NULL, NULL, NULL),
(9, 'Test 2', NULL, NULL, 6, 1, 1, 2, 1, NULL, '2023-07-03', 'DSE', 'En Espera', '#ff0000', 'solicitud', '2023-07-03 17:14:00', NULL, '2023-09-13 22:16:14', '2023-09-13 22:21:33', 'Urgente', NULL, NULL, NULL),
(10, 'Reparacion test', NULL, NULL, 2, 1, 1, 3, 1, NULL, '2023-07-04', 'LA', 'En Espera', '#ff0000', 'solicitud', '2023-07-04 17:16:00', NULL, '2023-09-13 22:17:14', '2023-09-13 22:21:04', 'Urgente', NULL, NULL, NULL),
(11, 'Test Refacciones', NULL, NULL, 1, 1, 1, 4, 1, NULL, '2023-07-05', 'Equipo', 'En Espera', '#a6ce34', 'solicitud', '2023-07-05 17:18:00', NULL, '2023-09-13 22:19:17', '2023-09-13 22:20:10', 'Prorrogable', NULL, NULL, NULL),
(13, 'MORELOS - Prueba de tarea', NULL, NULL, NULL, 2, 1, NULL, 1, 8, '2023-09-11', 'Pruebas de alta de tareas', 'En Espera', '#a6ce34', 'actividades', '2023-09-11 17:05:00', NULL, '2023-09-15 22:05:53', '2023-09-15 22:06:09', 'Prorrogable', NULL, NULL, NULL),
(15, 'Colado segundo piso oficina taller Q2CES', NULL, NULL, NULL, 35, 14, NULL, 1, 9, '0000-00-00', NULL, 'En Espera', '#ffa500', 'actividades', '2023-10-14 08:00:00', NULL, '2023-10-14 14:14:05', '2023-10-14 14:14:05', 'Necesaria', NULL, NULL, NULL),
(24, 'test', NULL, NULL, NULL, 5, NULL, NULL, 1, NULL, '0000-00-00', 'teste comment', '', '#8a8a8a', 'EventoImportante', '2023-12-11 13:23:00', '2023-12-11 13:51:00', '2023-12-11 19:25:29', '2023-12-11 19:25:29', NULL, NULL, NULL, 5),
(27, 'Expira documento: Manual de Usuario', NULL, NULL, 8, 5, NULL, NULL, 1, NULL, '0000-00-00', 'Expiración del Documento: Manual de Usuario Perteneciente al Equipo: Jeep Grand Cherokee, con Placas: JKA-4241, y N/Económico: SER-04', '', '#f70202', 'ExpiranDocumentos', '2023-12-13 01:00:00', '2023-12-13 23:00:00', '2023-12-11 19:48:09', '2023-12-11 19:48:09', NULL, NULL, NULL, NULL),
(28, 'Feriado: Año Nuevo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Año Nuevo', '', '#a6ce34', 'DiaFeriado', '2023-01-01 00:00:00', NULL, '2023-12-11 22:49:55', '2023-12-11 22:49:55', NULL, NULL, NULL, NULL),
(29, 'Feriado: Día de la Constitución', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Constitución', '', '#a6ce34', 'DiaFeriado', '2023-02-05 00:00:00', NULL, '2023-12-11 22:49:55', '2023-12-11 22:49:55', NULL, NULL, NULL, NULL),
(30, 'Feriado: Día de la Constitución (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Constitución (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-02-06 00:00:00', NULL, '2023-12-11 22:49:55', '2023-12-11 22:49:55', NULL, NULL, NULL, NULL),
(31, 'Feriado: Natalicio de Benito Juárez (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Natalicio de Benito Juárez (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-03-20 00:00:00', NULL, '2023-12-11 22:49:55', '2023-12-11 22:49:55', NULL, NULL, NULL, NULL),
(32, 'Feriado: Natalicio de Benito Juárez', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Natalicio de Benito Juárez', '', '#a6ce34', 'DiaFeriado', '2023-03-21 00:00:00', NULL, '2023-12-11 22:49:55', '2023-12-11 22:49:55', NULL, NULL, NULL, NULL),
(33, 'Feriado: Jueves Santo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Jueves Santo', '', '#a6ce34', 'DiaFeriado', '2023-04-06 00:00:00', NULL, '2023-12-11 22:49:55', '2023-12-11 22:49:55', NULL, NULL, NULL, NULL),
(34, 'Feriado: Viernes Santo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Viernes Santo', '', '#a6ce34', 'DiaFeriado', '2023-04-07 00:00:00', NULL, '2023-12-11 22:49:55', '2023-12-11 22:49:55', NULL, NULL, NULL, NULL),
(35, 'Feriado: Día del trabajador', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día del trabajador', '', '#a6ce34', 'DiaFeriado', '2023-05-01 00:00:00', NULL, '2023-12-11 22:49:55', '2023-12-11 22:49:55', NULL, NULL, NULL, NULL),
(36, 'Feriado: Día de la Madre', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Madre', '', '#a6ce34', 'DiaFeriado', '2023-05-10 00:00:00', NULL, '2023-12-11 22:49:55', '2023-12-11 22:49:55', NULL, NULL, NULL, NULL),
(37, 'Feriado: Día de la Independencia', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Independencia', '', '#a6ce34', 'DiaFeriado', '2023-09-16 00:00:00', NULL, '2023-12-11 22:49:55', '2023-12-11 22:49:55', NULL, NULL, NULL, NULL),
(38, 'Feriado: Día de los Difuntos', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de los Difuntos', '', '#a6ce34', 'DiaFeriado', '2023-11-02 00:00:00', NULL, '2023-12-11 22:49:55', '2023-12-11 22:49:55', NULL, NULL, NULL, NULL),
(39, 'Feriado: Día de la Revolución', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Revolución', '', '#a6ce34', 'DiaFeriado', '2023-11-20 00:00:00', NULL, '2023-12-11 22:49:55', '2023-12-11 22:49:55', NULL, NULL, NULL, NULL),
(40, 'Feriado: Día de la Revolución (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Revolución (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-11-20 00:00:00', NULL, '2023-12-11 22:49:55', '2023-12-11 22:49:55', NULL, NULL, NULL, NULL),
(41, 'Feriado: Día de la Virgen de Guadalupe', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Virgen de Guadalupe', '', '#a6ce34', 'DiaFeriado', '2023-12-12 00:00:00', NULL, '2023-12-11 22:49:55', '2023-12-11 22:49:55', NULL, NULL, NULL, NULL),
(42, 'Feriado: Navidad', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Navidad', '', '#a6ce34', 'DiaFeriado', '2023-12-25 00:00:00', NULL, '2023-12-11 22:49:55', '2023-12-11 22:49:55', NULL, NULL, NULL, NULL),
(43, 'Expira Documento: Licencia de conducir', NULL, NULL, NULL, 1, 6, NULL, 3, NULL, '0000-00-00', 'Expiración del Documento: Licencia de conducir, Perteneciente al Usuario: K Cobián Franco, con el Email: , con el Celular: 33 2932 8782', '', '#f70202', 'ExpiranDocumentos', '2023-12-15 01:00:00', '2023-12-15 23:00:00', '2023-12-11 22:53:32', '2023-12-11 22:53:32', NULL, NULL, NULL, NULL),
(44, 'Feriado: Año Nuevo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Año Nuevo', '', '#a6ce34', 'DiaFeriado', '2023-01-01 00:00:00', NULL, '2023-12-12 15:00:26', '2023-12-12 15:00:26', NULL, NULL, NULL, NULL),
(45, 'Feriado: Día de la Constitución', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Constitución', '', '#a6ce34', 'DiaFeriado', '2023-02-05 00:00:00', NULL, '2023-12-12 15:00:26', '2023-12-12 15:00:26', NULL, NULL, NULL, NULL),
(46, 'Feriado: Día de la Constitución (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Constitución (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-02-06 00:00:00', NULL, '2023-12-12 15:00:26', '2023-12-12 15:00:26', NULL, NULL, NULL, NULL),
(47, 'Feriado: Natalicio de Benito Juárez (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Natalicio de Benito Juárez (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-03-20 00:00:00', NULL, '2023-12-12 15:00:26', '2023-12-12 15:00:26', NULL, NULL, NULL, NULL),
(48, 'Feriado: Natalicio de Benito Juárez', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Natalicio de Benito Juárez', '', '#a6ce34', 'DiaFeriado', '2023-03-21 00:00:00', NULL, '2023-12-12 15:00:26', '2023-12-12 15:00:26', NULL, NULL, NULL, NULL),
(49, 'Feriado: Jueves Santo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Jueves Santo', '', '#a6ce34', 'DiaFeriado', '2023-04-06 00:00:00', NULL, '2023-12-12 15:00:26', '2023-12-12 15:00:26', NULL, NULL, NULL, NULL),
(50, 'Feriado: Viernes Santo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Viernes Santo', '', '#a6ce34', 'DiaFeriado', '2023-04-07 00:00:00', NULL, '2023-12-12 15:00:26', '2023-12-12 15:00:26', NULL, NULL, NULL, NULL),
(51, 'Feriado: Día del trabajador', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día del trabajador', '', '#a6ce34', 'DiaFeriado', '2023-05-01 00:00:00', NULL, '2023-12-12 15:00:26', '2023-12-12 15:00:26', NULL, NULL, NULL, NULL),
(52, 'Feriado: Día de la Madre', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Madre', '', '#a6ce34', 'DiaFeriado', '2023-05-10 00:00:00', NULL, '2023-12-12 15:00:26', '2023-12-12 15:00:26', NULL, NULL, NULL, NULL),
(53, 'Feriado: Día de la Independencia', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Independencia', '', '#a6ce34', 'DiaFeriado', '2023-09-16 00:00:00', NULL, '2023-12-12 15:00:26', '2023-12-12 15:00:26', NULL, NULL, NULL, NULL),
(54, 'Feriado: Día de los Difuntos', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de los Difuntos', '', '#a6ce34', 'DiaFeriado', '2023-11-02 00:00:00', NULL, '2023-12-12 15:00:26', '2023-12-12 15:00:26', NULL, NULL, NULL, NULL),
(55, 'Feriado: Día de la Revolución', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Revolución', '', '#a6ce34', 'DiaFeriado', '2023-11-20 00:00:00', NULL, '2023-12-12 15:00:26', '2023-12-12 15:00:26', NULL, NULL, NULL, NULL),
(56, 'Feriado: Día de la Revolución (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Revolución (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-11-20 00:00:00', NULL, '2023-12-12 15:00:26', '2023-12-12 15:00:26', NULL, NULL, NULL, NULL),
(57, 'Feriado: Día de la Virgen de Guadalupe', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Virgen de Guadalupe', '', '#a6ce34', 'DiaFeriado', '2023-12-12 00:00:00', NULL, '2023-12-12 15:00:26', '2023-12-12 15:00:26', NULL, NULL, NULL, NULL),
(58, 'Feriado: Navidad', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Navidad', '', '#a6ce34', 'DiaFeriado', '2023-12-25 00:00:00', NULL, '2023-12-12 15:00:26', '2023-12-12 15:00:26', NULL, NULL, NULL, NULL),
(59, 'Feriado: Año Nuevo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Año Nuevo', '', '#a6ce34', 'DiaFeriado', '2023-01-01 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(60, 'Feriado: Día de la Constitución', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Constitución', '', '#a6ce34', 'DiaFeriado', '2023-02-05 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(61, 'Feriado: Día de la Constitución (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Constitución (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-02-06 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(62, 'Feriado: Natalicio de Benito Juárez (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Natalicio de Benito Juárez (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-03-20 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(63, 'Feriado: Natalicio de Benito Juárez', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Natalicio de Benito Juárez', '', '#a6ce34', 'DiaFeriado', '2023-03-21 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(64, 'Feriado: Jueves Santo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Jueves Santo', '', '#a6ce34', 'DiaFeriado', '2023-04-06 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(65, 'Feriado: Viernes Santo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Viernes Santo', '', '#a6ce34', 'DiaFeriado', '2023-04-07 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(66, 'Feriado: Día del trabajador', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día del trabajador', '', '#a6ce34', 'DiaFeriado', '2023-05-01 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(67, 'Feriado: Día de la Madre', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Madre', '', '#a6ce34', 'DiaFeriado', '2023-05-10 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(68, 'Feriado: Día de la Independencia', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Independencia', '', '#a6ce34', 'DiaFeriado', '2023-09-16 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(69, 'Feriado: Día de los Difuntos', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de los Difuntos', '', '#a6ce34', 'DiaFeriado', '2023-11-02 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(70, 'Feriado: Día de la Revolución', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Revolución', '', '#a6ce34', 'DiaFeriado', '2023-11-20 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(71, 'Feriado: Día de la Revolución (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Revolución (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-11-20 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(72, 'Feriado: Día de la Virgen de Guadalupe', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Virgen de Guadalupe', '', '#a6ce34', 'DiaFeriado', '2023-12-12 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(73, 'Feriado: Navidad', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Navidad', '', '#a6ce34', 'DiaFeriado', '2023-12-25 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(74, 'Feriado: Año Nuevo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Año Nuevo', '', '#a6ce34', 'DiaFeriado', '2023-01-01 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(75, 'Feriado: Día de la Constitución', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Constitución', '', '#a6ce34', 'DiaFeriado', '2023-02-05 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(76, 'Feriado: Día de la Constitución (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Constitución (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-02-06 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(77, 'Feriado: Natalicio de Benito Juárez (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Natalicio de Benito Juárez (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-03-20 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(78, 'Feriado: Natalicio de Benito Juárez', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Natalicio de Benito Juárez', '', '#a6ce34', 'DiaFeriado', '2023-03-21 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(79, 'Feriado: Jueves Santo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Jueves Santo', '', '#a6ce34', 'DiaFeriado', '2023-04-06 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(80, 'Feriado: Viernes Santo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Viernes Santo', '', '#a6ce34', 'DiaFeriado', '2023-04-07 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(81, 'Feriado: Día del trabajador', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día del trabajador', '', '#a6ce34', 'DiaFeriado', '2023-05-01 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(82, 'Feriado: Día de la Madre', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Madre', '', '#a6ce34', 'DiaFeriado', '2023-05-10 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(83, 'Feriado: Día de la Independencia', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Independencia', '', '#a6ce34', 'DiaFeriado', '2023-09-16 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(84, 'Feriado: Día de los Difuntos', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de los Difuntos', '', '#a6ce34', 'DiaFeriado', '2023-11-02 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(85, 'Feriado: Día de la Revolución', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Revolución', '', '#a6ce34', 'DiaFeriado', '2023-11-20 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(86, 'Feriado: Día de la Revolución (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Revolución (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-11-20 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(87, 'Feriado: Día de la Virgen de Guadalupe', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Virgen de Guadalupe', '', '#a6ce34', 'DiaFeriado', '2023-12-12 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(88, 'Feriado: Navidad', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Navidad', '', '#a6ce34', 'DiaFeriado', '2023-12-25 00:00:00', NULL, '2023-12-12 15:00:30', '2023-12-12 15:00:30', NULL, NULL, NULL, NULL),
(89, 'Feriado: Año Nuevo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Año Nuevo', '', '#a6ce34', 'DiaFeriado', '2023-01-01 00:00:00', NULL, '2023-12-12 15:00:31', '2023-12-12 15:00:31', NULL, NULL, NULL, NULL),
(90, 'Feriado: Día de la Constitución', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Constitución', '', '#a6ce34', 'DiaFeriado', '2023-02-05 00:00:00', NULL, '2023-12-12 15:00:31', '2023-12-12 15:00:31', NULL, NULL, NULL, NULL),
(91, 'Feriado: Día de la Constitución (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Constitución (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-02-06 00:00:00', NULL, '2023-12-12 15:00:31', '2023-12-12 15:00:31', NULL, NULL, NULL, NULL),
(92, 'Feriado: Natalicio de Benito Juárez (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Natalicio de Benito Juárez (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-03-20 00:00:00', NULL, '2023-12-12 15:00:31', '2023-12-12 15:00:31', NULL, NULL, NULL, NULL),
(93, 'Feriado: Natalicio de Benito Juárez', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Natalicio de Benito Juárez', '', '#a6ce34', 'DiaFeriado', '2023-03-21 00:00:00', NULL, '2023-12-12 15:00:31', '2023-12-12 15:00:31', NULL, NULL, NULL, NULL),
(94, 'Feriado: Jueves Santo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Jueves Santo', '', '#a6ce34', 'DiaFeriado', '2023-04-06 00:00:00', NULL, '2023-12-12 15:00:31', '2023-12-12 15:00:31', NULL, NULL, NULL, NULL),
(95, 'Feriado: Viernes Santo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Viernes Santo', '', '#a6ce34', 'DiaFeriado', '2023-04-07 00:00:00', NULL, '2023-12-12 15:00:31', '2023-12-12 15:00:31', NULL, NULL, NULL, NULL),
(96, 'Feriado: Día del trabajador', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día del trabajador', '', '#a6ce34', 'DiaFeriado', '2023-05-01 00:00:00', NULL, '2023-12-12 15:00:31', '2023-12-12 15:00:31', NULL, NULL, NULL, NULL),
(97, 'Feriado: Día de la Madre', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Madre', '', '#a6ce34', 'DiaFeriado', '2023-05-10 00:00:00', NULL, '2023-12-12 15:00:31', '2023-12-12 15:00:31', NULL, NULL, NULL, NULL),
(98, 'Feriado: Día de la Independencia', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Independencia', '', '#a6ce34', 'DiaFeriado', '2023-09-16 00:00:00', NULL, '2023-12-12 15:00:31', '2023-12-12 15:00:31', NULL, NULL, NULL, NULL),
(99, 'Feriado: Día de los Difuntos', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de los Difuntos', '', '#a6ce34', 'DiaFeriado', '2023-11-02 00:00:00', NULL, '2023-12-12 15:00:31', '2023-12-12 15:00:31', NULL, NULL, NULL, NULL),
(100, 'Feriado: Día de la Revolución', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Revolución', '', '#a6ce34', 'DiaFeriado', '2023-11-20 00:00:00', NULL, '2023-12-12 15:00:31', '2023-12-12 15:00:31', NULL, NULL, NULL, NULL),
(101, 'Feriado: Día de la Revolución (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Revolución (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-11-20 00:00:00', NULL, '2023-12-12 15:00:31', '2023-12-12 15:00:31', NULL, NULL, NULL, NULL),
(102, 'Feriado: Día de la Virgen de Guadalupe', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Virgen de Guadalupe', '', '#a6ce34', 'DiaFeriado', '2023-12-12 00:00:00', NULL, '2023-12-12 15:00:31', '2023-12-12 15:00:31', NULL, NULL, NULL, NULL),
(103, 'Feriado: Navidad', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Navidad', '', '#a6ce34', 'DiaFeriado', '2023-12-25 00:00:00', NULL, '2023-12-12 15:00:31', '2023-12-12 15:00:31', NULL, NULL, NULL, NULL),
(104, 'Feriado: Año Nuevo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Año Nuevo', '', '#a6ce34', 'DiaFeriado', '2023-01-01 00:00:00', NULL, '2023-12-12 15:01:23', '2023-12-12 15:01:23', NULL, NULL, NULL, NULL),
(105, 'Feriado: Día de la Constitución', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Constitución', '', '#a6ce34', 'DiaFeriado', '2023-02-05 00:00:00', NULL, '2023-12-12 15:01:23', '2023-12-12 15:01:23', NULL, NULL, NULL, NULL),
(106, 'Feriado: Día de la Constitución (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Constitución (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-02-06 00:00:00', NULL, '2023-12-12 15:01:23', '2023-12-12 15:01:23', NULL, NULL, NULL, NULL),
(107, 'Feriado: Natalicio de Benito Juárez (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Natalicio de Benito Juárez (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-03-20 00:00:00', NULL, '2023-12-12 15:01:23', '2023-12-12 15:01:23', NULL, NULL, NULL, NULL),
(108, 'Feriado: Natalicio de Benito Juárez', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Natalicio de Benito Juárez', '', '#a6ce34', 'DiaFeriado', '2023-03-21 00:00:00', NULL, '2023-12-12 15:01:23', '2023-12-12 15:01:23', NULL, NULL, NULL, NULL),
(109, 'Feriado: Jueves Santo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Jueves Santo', '', '#a6ce34', 'DiaFeriado', '2023-04-06 00:00:00', NULL, '2023-12-12 15:01:23', '2023-12-12 15:01:23', NULL, NULL, NULL, NULL),
(110, 'Feriado: Viernes Santo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Viernes Santo', '', '#a6ce34', 'DiaFeriado', '2023-04-07 00:00:00', NULL, '2023-12-12 15:01:23', '2023-12-12 15:01:23', NULL, NULL, NULL, NULL),
(111, 'Feriado: Día del trabajador', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día del trabajador', '', '#a6ce34', 'DiaFeriado', '2023-05-01 00:00:00', NULL, '2023-12-12 15:01:23', '2023-12-12 15:01:23', NULL, NULL, NULL, NULL),
(112, 'Feriado: Día de la Madre', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Madre', '', '#a6ce34', 'DiaFeriado', '2023-05-10 00:00:00', NULL, '2023-12-12 15:01:23', '2023-12-12 15:01:23', NULL, NULL, NULL, NULL),
(113, 'Feriado: Día de la Independencia', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Independencia', '', '#a6ce34', 'DiaFeriado', '2023-09-16 00:00:00', NULL, '2023-12-12 15:01:23', '2023-12-12 15:01:23', NULL, NULL, NULL, NULL),
(114, 'Feriado: Día de los Difuntos', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de los Difuntos', '', '#a6ce34', 'DiaFeriado', '2023-11-02 00:00:00', NULL, '2023-12-12 15:01:23', '2023-12-12 15:01:23', NULL, NULL, NULL, NULL),
(115, 'Feriado: Día de la Revolución', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Revolución', '', '#a6ce34', 'DiaFeriado', '2023-11-20 00:00:00', NULL, '2023-12-12 15:01:23', '2023-12-12 15:01:23', NULL, NULL, NULL, NULL),
(116, 'Feriado: Día de la Revolución (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Revolución (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-11-20 00:00:00', NULL, '2023-12-12 15:01:23', '2023-12-12 15:01:23', NULL, NULL, NULL, NULL),
(117, 'Feriado: Día de la Virgen de Guadalupe', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Virgen de Guadalupe', '', '#a6ce34', 'DiaFeriado', '2023-12-12 00:00:00', NULL, '2023-12-12 15:01:23', '2023-12-12 15:01:23', NULL, NULL, NULL, NULL),
(118, 'Feriado: Navidad', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Navidad', '', '#a6ce34', 'DiaFeriado', '2023-12-25 00:00:00', NULL, '2023-12-12 15:01:23', '2023-12-12 15:01:23', NULL, NULL, NULL, NULL),
(119, 'Feriado: Año Nuevo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Año Nuevo', '', '#a6ce34', 'DiaFeriado', '2023-01-01 00:00:00', NULL, '2023-12-12 15:01:25', '2023-12-12 15:01:25', NULL, NULL, NULL, NULL),
(120, 'Feriado: Día de la Constitución', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Constitución', '', '#a6ce34', 'DiaFeriado', '2023-02-05 00:00:00', NULL, '2023-12-12 15:01:25', '2023-12-12 15:01:25', NULL, NULL, NULL, NULL),
(121, 'Feriado: Día de la Constitución (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Constitución (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-02-06 00:00:00', NULL, '2023-12-12 15:01:25', '2023-12-12 15:01:25', NULL, NULL, NULL, NULL),
(122, 'Feriado: Natalicio de Benito Juárez (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Natalicio de Benito Juárez (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-03-20 00:00:00', NULL, '2023-12-12 15:01:25', '2023-12-12 15:01:25', NULL, NULL, NULL, NULL),
(123, 'Feriado: Natalicio de Benito Juárez', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Natalicio de Benito Juárez', '', '#a6ce34', 'DiaFeriado', '2023-03-21 00:00:00', NULL, '2023-12-12 15:01:25', '2023-12-12 15:01:25', NULL, NULL, NULL, NULL),
(124, 'Feriado: Jueves Santo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Jueves Santo', '', '#a6ce34', 'DiaFeriado', '2023-04-06 00:00:00', NULL, '2023-12-12 15:01:25', '2023-12-12 15:01:25', NULL, NULL, NULL, NULL),
(125, 'Feriado: Viernes Santo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Viernes Santo', '', '#a6ce34', 'DiaFeriado', '2023-04-07 00:00:00', NULL, '2023-12-12 15:01:25', '2023-12-12 15:01:25', NULL, NULL, NULL, NULL),
(126, 'Feriado: Día del trabajador', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día del trabajador', '', '#a6ce34', 'DiaFeriado', '2023-05-01 00:00:00', NULL, '2023-12-12 15:01:25', '2023-12-12 15:01:25', NULL, NULL, NULL, NULL),
(127, 'Feriado: Día de la Madre', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Madre', '', '#a6ce34', 'DiaFeriado', '2023-05-10 00:00:00', NULL, '2023-12-12 15:01:25', '2023-12-12 15:01:25', NULL, NULL, NULL, NULL),
(128, 'Feriado: Día de la Independencia', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Independencia', '', '#a6ce34', 'DiaFeriado', '2023-09-16 00:00:00', NULL, '2023-12-12 15:01:25', '2023-12-12 15:01:25', NULL, NULL, NULL, NULL),
(129, 'Feriado: Día de los Difuntos', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de los Difuntos', '', '#a6ce34', 'DiaFeriado', '2023-11-02 00:00:00', NULL, '2023-12-12 15:01:25', '2023-12-12 15:01:25', NULL, NULL, NULL, NULL),
(130, 'Feriado: Día de la Revolución', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Revolución', '', '#a6ce34', 'DiaFeriado', '2023-11-20 00:00:00', NULL, '2023-12-12 15:01:25', '2023-12-12 15:01:25', NULL, NULL, NULL, NULL),
(131, 'Feriado: Día de la Revolución (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Revolución (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-11-20 00:00:00', NULL, '2023-12-12 15:01:25', '2023-12-12 15:01:25', NULL, NULL, NULL, NULL),
(132, 'Feriado: Día de la Virgen de Guadalupe', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Virgen de Guadalupe', '', '#a6ce34', 'DiaFeriado', '2023-12-12 00:00:00', NULL, '2023-12-12 15:01:25', '2023-12-12 15:01:25', NULL, NULL, NULL, NULL),
(133, 'Feriado: Navidad', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Navidad', '', '#a6ce34', 'DiaFeriado', '2023-12-25 00:00:00', NULL, '2023-12-12 15:01:25', '2023-12-12 15:01:25', NULL, NULL, NULL, NULL),
(134, 'Posada Q2CES y NEWS', NULL, NULL, NULL, 3, NULL, NULL, 1, NULL, '0000-00-00', NULL, '', '#8a8a8a', 'EventoImportante', '2023-12-15 15:00:00', '2023-12-15 20:00:00', '2023-12-12 15:02:59', '2023-12-12 15:02:59', NULL, NULL, NULL, 6),
(135, 'Feriado: Año Nuevo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Año Nuevo', '', '#a6ce34', 'DiaFeriado', '2023-01-01 00:00:00', NULL, '2023-12-12 18:25:22', '2023-12-12 18:25:22', NULL, NULL, NULL, NULL),
(136, 'Feriado: Día de la Constitución', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Constitución', '', '#a6ce34', 'DiaFeriado', '2023-02-05 00:00:00', NULL, '2023-12-12 18:25:22', '2023-12-12 18:25:22', NULL, NULL, NULL, NULL),
(137, 'Feriado: Día de la Constitución (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Constitución (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-02-06 00:00:00', NULL, '2023-12-12 18:25:22', '2023-12-12 18:25:22', NULL, NULL, NULL, NULL),
(138, 'Feriado: Natalicio de Benito Juárez (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Natalicio de Benito Juárez (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-03-20 00:00:00', NULL, '2023-12-12 18:25:22', '2023-12-12 18:25:22', NULL, NULL, NULL, NULL),
(139, 'Feriado: Natalicio de Benito Juárez', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Natalicio de Benito Juárez', '', '#a6ce34', 'DiaFeriado', '2023-03-21 00:00:00', NULL, '2023-12-12 18:25:22', '2023-12-12 18:25:22', NULL, NULL, NULL, NULL),
(140, 'Feriado: Jueves Santo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Jueves Santo', '', '#a6ce34', 'DiaFeriado', '2023-04-06 00:00:00', NULL, '2023-12-12 18:25:22', '2023-12-12 18:25:22', NULL, NULL, NULL, NULL),
(141, 'Feriado: Viernes Santo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Viernes Santo', '', '#a6ce34', 'DiaFeriado', '2023-04-07 00:00:00', NULL, '2023-12-12 18:25:22', '2023-12-12 18:25:22', NULL, NULL, NULL, NULL),
(142, 'Feriado: Día del trabajador', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día del trabajador', '', '#a6ce34', 'DiaFeriado', '2023-05-01 00:00:00', NULL, '2023-12-12 18:25:22', '2023-12-12 18:25:22', NULL, NULL, NULL, NULL),
(143, 'Feriado: Día de la Madre', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Madre', '', '#a6ce34', 'DiaFeriado', '2023-05-10 00:00:00', NULL, '2023-12-12 18:25:22', '2023-12-12 18:25:22', NULL, NULL, NULL, NULL),
(144, 'Feriado: Día de la Independencia', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Independencia', '', '#a6ce34', 'DiaFeriado', '2023-09-16 00:00:00', NULL, '2023-12-12 18:25:22', '2023-12-12 18:25:22', NULL, NULL, NULL, NULL),
(145, 'Feriado: Día de los Difuntos', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de los Difuntos', '', '#a6ce34', 'DiaFeriado', '2023-11-02 00:00:00', NULL, '2023-12-12 18:25:22', '2023-12-12 18:25:22', NULL, NULL, NULL, NULL),
(146, 'Feriado: Día de la Revolución', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Revolución', '', '#a6ce34', 'DiaFeriado', '2023-11-20 00:00:00', NULL, '2023-12-12 18:25:22', '2023-12-12 18:25:22', NULL, NULL, NULL, NULL),
(147, 'Feriado: Día de la Revolución (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Revolución (día libre)', '', '#a6ce34', 'DiaFeriado', '2023-11-20 00:00:00', NULL, '2023-12-12 18:25:22', '2023-12-12 18:25:22', NULL, NULL, NULL, NULL),
(148, 'Feriado: Día de la Virgen de Guadalupe', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Virgen de Guadalupe', '', '#a6ce34', 'DiaFeriado', '2023-12-12 00:00:00', NULL, '2023-12-12 18:25:22', '2023-12-12 18:25:22', NULL, NULL, NULL, NULL),
(149, 'Feriado: Navidad', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Navidad', '', '#a6ce34', 'DiaFeriado', '2023-12-25 00:00:00', NULL, '2023-12-12 18:25:22', '2023-12-12 18:25:22', NULL, NULL, NULL, NULL),
(150, 'Cumpleaños: Paola', NULL, NULL, NULL, 24, NULL, NULL, 3, NULL, '0000-00-00', 'Este Día Cumple Años: Rodríguez, Castellano, Paola, ¡Felicitaciones!', '', '#a76ca5', 'cumple', '2024-01-22 00:00:00', NULL, '2023-12-13 23:25:00', '2023-12-13 23:25:00', NULL, NULL, NULL, NULL),
(151, 'Cumpleaños: Luis Alberto', NULL, NULL, NULL, 15, NULL, NULL, 3, NULL, '0000-00-00', 'Este Día Cumple Años: Avila, Benites, Luis Alberto, ¡Felicitaciones!', '', '#a76ca5', 'cumple', '2024-02-13 00:00:00', NULL, '2024-01-04 22:55:00', '2024-01-04 22:55:00', NULL, NULL, NULL, NULL),
(152, 'Cumpleaños: Fernando', NULL, NULL, NULL, 19, NULL, NULL, 3, NULL, '0000-00-00', 'Este Día Cumple Años: Alcalá, Moreno, Fernando, ¡Felicitaciones!', '', '#a76ca5', 'cumple', '2024-02-03 00:00:00', NULL, '2024-01-04 22:55:00', '2024-01-04 22:55:00', NULL, NULL, NULL, NULL),
(153, 'Feriado: Año Nuevo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Año Nuevo', '', '#a6ce34', 'DiaFeriado', '2024-01-01 00:00:00', NULL, '2024-01-04 23:39:51', '2024-01-04 23:39:51', NULL, NULL, NULL, NULL),
(154, 'Feriado: Día de la Constitución', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Constitución', '', '#a6ce34', 'DiaFeriado', '2024-02-05 00:00:00', NULL, '2024-01-04 23:39:51', '2024-01-04 23:39:51', NULL, NULL, NULL, NULL),
(155, 'Feriado: Día de la Constitución (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Constitución (día libre)', '', '#a6ce34', 'DiaFeriado', '2024-02-05 00:00:00', NULL, '2024-01-04 23:39:51', '2024-01-04 23:39:51', NULL, NULL, NULL, NULL),
(156, 'Feriado: Natalicio de Benito Juárez (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Natalicio de Benito Juárez (día libre)', '', '#a6ce34', 'DiaFeriado', '2024-03-18 00:00:00', NULL, '2024-01-04 23:39:51', '2024-01-04 23:39:51', NULL, NULL, NULL, NULL),
(157, 'Feriado: Natalicio de Benito Juárez', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Natalicio de Benito Juárez', '', '#a6ce34', 'DiaFeriado', '2024-03-21 00:00:00', NULL, '2024-01-04 23:39:51', '2024-01-04 23:39:51', NULL, NULL, NULL, NULL),
(158, 'Feriado: Jueves Santo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Jueves Santo', '', '#a6ce34', 'DiaFeriado', '2024-03-28 00:00:00', NULL, '2024-01-04 23:39:51', '2024-01-04 23:39:51', NULL, NULL, NULL, NULL),
(159, 'Feriado: Viernes Santo', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Viernes Santo', '', '#a6ce34', 'DiaFeriado', '2024-03-29 00:00:00', NULL, '2024-01-04 23:39:51', '2024-01-04 23:39:51', NULL, NULL, NULL, NULL),
(160, 'Feriado: Día del trabajador', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día del trabajador', '', '#a6ce34', 'DiaFeriado', '2024-05-01 00:00:00', NULL, '2024-01-04 23:39:51', '2024-01-04 23:39:51', NULL, NULL, NULL, NULL),
(161, 'Feriado: Día de la Madre', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Madre', '', '#a6ce34', 'DiaFeriado', '2024-05-10 00:00:00', NULL, '2024-01-04 23:39:51', '2024-01-04 23:39:51', NULL, NULL, NULL, NULL),
(162, 'Feriado: Día de la Independencia', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Independencia', '', '#a6ce34', 'DiaFeriado', '2024-09-16 00:00:00', NULL, '2024-01-04 23:39:51', '2024-01-04 23:39:51', NULL, NULL, NULL, NULL),
(163, 'Feriado: Día de los Difuntos', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de los Difuntos', '', '#a6ce34', 'DiaFeriado', '2024-11-02 00:00:00', NULL, '2024-01-04 23:39:51', '2024-01-04 23:39:51', NULL, NULL, NULL, NULL),
(164, 'Feriado: Día de la Revolución (día libre)', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Revolución (día libre)', '', '#a6ce34', 'DiaFeriado', '2024-11-18 00:00:00', NULL, '2024-01-04 23:39:51', '2024-01-04 23:39:51', NULL, NULL, NULL, NULL),
(165, 'Feriado: Día de la Revolución', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Revolución', '', '#a6ce34', 'DiaFeriado', '2024-11-20 00:00:00', NULL, '2024-01-04 23:39:51', '2024-01-04 23:39:51', NULL, NULL, NULL, NULL),
(166, 'Feriado: Transmisión del Poder Ejecutivo Federal', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Transmisión del Poder Ejecutivo Federal', '', '#a6ce34', 'DiaFeriado', '2024-12-01 00:00:00', NULL, '2024-01-04 23:39:51', '2024-01-04 23:39:51', NULL, NULL, NULL, NULL),
(167, 'Feriado: Día de la Virgen de Guadalupe', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Día de la Virgen de Guadalupe', '', '#a6ce34', 'DiaFeriado', '2024-12-12 00:00:00', NULL, '2024-01-04 23:39:51', '2024-01-04 23:39:51', NULL, NULL, NULL, NULL),
(168, 'Feriado: Navidad', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, '0000-00-00', 'Este día es festivo porque es: Navidad', '', '#a6ce34', 'DiaFeriado', '2024-12-25 00:00:00', NULL, '2024-01-04 23:39:51', '2024-01-04 23:39:51', NULL, NULL, NULL, NULL),
(169, 'Expira Documento: Seguro', NULL, NULL, 28, 3, NULL, NULL, 3, NULL, '0000-00-00', 'Expiración del Documento: Seguro Perteneciente al Equipo: Retroexcavadora John Deere 2018, con Placas: , y N/Económico: RET-04', '', '#f70202', 'ExpiranDocumentos', '2025-01-11 01:00:00', '2025-01-11 23:00:00', '2024-01-10 18:13:40', '2024-01-10 18:13:40', NULL, NULL, NULL, NULL),
(170, 'Expira Documento: Seguro', NULL, NULL, 31, 3, NULL, NULL, 3, NULL, '0000-00-00', 'Expiración del Documento: Seguro Perteneciente al Equipo: Miniretroexcavadora JCB 1CX, con Placas: , y N/Económico: RET-01', '', '#f70202', 'ExpiranDocumentos', '2025-01-17 01:00:00', '2025-01-17 23:00:00', '2024-01-15 17:15:30', '2024-01-15 17:15:30', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carga`
--

DROP TABLE IF EXISTS `carga`;
CREATE TABLE IF NOT EXISTS `carga` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `maquinariaId` bigint(20) UNSIGNED DEFAULT NULL,
  `operadorId` bigint(20) UNSIGNED DEFAULT NULL,
  `precio` float(10,2) DEFAULT NULL,
  `litros` float(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `horaLlegadaCarga` time DEFAULT NULL,
  `comentario` text,
  `tipoCisternaId` bigint(20) UNSIGNED DEFAULT NULL,
  `kilometraje` bigint(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_carga_operadorlId` (`operadorId`),
  KEY `FK_carga_maquinariaId` (`maquinariaId`),
  KEY `FK_carga_userId` (`userId`),
  KEY `FK_carga_cisternas` (`tipoCisternaId`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carga`
--

INSERT INTO `carga` (`id`, `maquinariaId`, `operadorId`, `precio`, `litros`, `created_at`, `updated_at`, `userId`, `horaLlegadaCarga`, `comentario`, `tipoCisternaId`, `kilometraje`) VALUES
(9, 1, 25, 23.49, 760.00, '2024-01-04 08:50:54', '2024-01-04 08:50:54', 3, '08:50:00', NULL, NULL, 58209),
(10, 1, 25, 23.49, 760.00, '2024-01-04 08:51:32', '2024-01-04 08:51:32', 3, '08:51:00', NULL, 1, 58210),
(11, NULL, NULL, NULL, 108.00, '2024-01-09 13:24:24', '2024-01-09 13:24:24', 3, NULL, 'Este Movimiento Indica un Ajuste manual a la reserva', 1, NULL),
(12, 1, 14, 23.49, 600.00, '2024-01-09 15:30:00', '2024-01-11 17:35:19', 21, '15:30:00', NULL, NULL, 58550),
(13, NULL, 14, 23.49, 600.00, '2024-01-10 08:00:00', '2024-01-11 17:35:42', 3, '08:00:00', NULL, 1, 58551),
(14, 16, 14, 23.49, 800.00, '2024-01-11 14:00:00', '2024-01-11 17:35:28', 3, '14:00:00', NULL, NULL, 73250),
(15, NULL, 14, 20.31, 740.00, '2024-01-11 17:31:00', '2024-01-11 17:37:38', 3, '17:31:00', NULL, 1, 73254),
(16, NULL, NULL, NULL, 60.00, '2024-01-11 17:38:37', '2024-01-11 17:38:37', 3, NULL, 'Este Movimiento Indica un Ajuste manual a la reserva', NULL, NULL),
(17, 1, 25, 23.49, 600.00, '2024-01-16 16:21:56', '2024-01-16 16:21:56', 3, '11:46:00', NULL, NULL, 58552);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `checkList`
--

DROP TABLE IF EXISTS `checkList`;
CREATE TABLE IF NOT EXISTS `checkList` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `version` int(8) DEFAULT NULL,
  `bitacoraId` bigint(20) UNSIGNED NOT NULL,
  `usuarioId` bigint(20) UNSIGNED NOT NULL,
  `maquinariaId` bigint(20) UNSIGNED NOT NULL,
  `usoKom` float(10,2) NOT NULL DEFAULT '0.00',
  `estatus` int(11) DEFAULT NULL,
  `registrada` datetime DEFAULT NULL,
  `comentario` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_checkListBitacora` (`bitacoraId`),
  KEY `FK_checkListUsuario` (`usuarioId`),
  KEY `FK_checkListMaquinaria` (`maquinariaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `checkListRegistros`
--

DROP TABLE IF EXISTS `checkListRegistros`;
CREATE TABLE IF NOT EXISTS `checkListRegistros` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `checkListId` bigint(20) UNSIGNED NOT NULL,
  `maquinariaId` bigint(20) UNSIGNED NOT NULL,
  `maquinaria` varchar(255) NOT NULL,
  `bitacoraId` bigint(20) UNSIGNED NOT NULL,
  `bitacora` varchar(255) NOT NULL,
  `grupoId` bigint(20) UNSIGNED NOT NULL,
  `grupo` varchar(255) NOT NULL,
  `tareaId` bigint(20) UNSIGNED NOT NULL,
  `tarea` varchar(255) NOT NULL,
  `tareaTipoValor` int(2) NOT NULL DEFAULT '1',
  `resultado` varchar(255) DEFAULT NULL,
  `valor` int(8) DEFAULT NULL,
  `usuarioId` bigint(20) UNSIGNED NOT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_checkListRegistrosBitacora` (`bitacoraId`),
  KEY `FK_checkListRegistrosUsuario` (`usuarioId`),
  KEY `FK_checkListRegistrosMaquinaria` (`maquinariaId`),
  KEY `FK_checkListRegistrosGrupo` (`grupoId`),
  KEY `FK_checkListRegistrosTarea` (`tareaId`),
  KEY `FK_checkListHistorico` (`checkListId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cisternas`
--

DROP TABLE IF EXISTS `cisternas`;
CREATE TABLE IF NOT EXISTS `cisternas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `contenido` float(100,2) DEFAULT NULL,
  `ultimoPrecio` float(100,2) DEFAULT NULL,
  `ultimaCarga` float(100,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cisternas`
--

INSERT INTO `cisternas` (`id`, `nombre`, `contenido`, `ultimoPrecio`, `ultimaCarga`, `created_at`, `updated_at`) VALUES
(1, 'Tote', 614.00, 20.31, 800.00, '2023-09-22 12:00:00', '2024-01-16 09:28:08'),
(2, 'Aceite Motor', 0.00, 0.00, 0.00, '2023-09-22 12:00:00', '2023-09-29 13:03:38'),
(3, 'Grasa', 0.00, 0.00, 0.00, '2023-09-22 12:00:00', '2023-09-22 12:00:00'),
(4, 'Anticongelante', 0.00, 0.00, 0.00, '2023-09-22 12:00:00', '2023-09-29 13:03:38'),
(5, 'Otros', 0.00, 0.00, 0.00, '2023-09-22 12:00:00', '2023-09-22 12:00:00'),
(6, 'Aceite Hidraulico', 0.00, 0.00, 0.00, '2023-09-22 12:00:00', '2023-09-29 13:03:38'),
(7, 'Aceite Direccion', 0.00, 0.00, 0.00, '2023-09-22 12:00:00', '2023-09-29 13:03:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `razonSocial` varchar(255) DEFAULT NULL,
  `rfc` varchar(255) DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `exterior` varchar(255) DEFAULT NULL,
  `interior` varchar(255) DEFAULT NULL,
  `colonia` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `cp` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `fiscal` varchar(255) DEFAULT NULL,
  `estatus` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `razonSocial`, `rfc`, `calle`, `exterior`, `interior`, `colonia`, `estado`, `ciudad`, `cp`, `logo`, `fiscal`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'Q2CES', 'Q2S, S.A DE C.V', 'QSX151021BR5', 'José María Heredia', '2387', NULL, 'Lomas de Guevara', 'Jalisco', 'Guadalajara', '44657', NULL, NULL, 'Activa', '2023-09-20 16:48:22', '2023-10-05 16:24:46'),
(2, 'MTQ', 'MTQ de México S.A de C.V', NULL, 'José María Heredia', '2405', NULL, 'Lomas de Guevara', 'Jalisco', 'Guadalajara', '44657', NULL, NULL, 'Activa', '2023-09-20 16:49:20', '2023-10-06 15:06:48'),
(3, 'UDG', 'Universidad de Guadalajara', NULL, 'Av. Juarez', '976', '976', 'Americana', 'Jalisco', 'Guadalajara', '44100', NULL, NULL, 'Activa', '2023-10-06 15:22:41', '2023-10-09 13:34:32'),
(4, 'Homero', 'Homero', NULL, 'Homero', '123', '123', '123', 'Jalisco', 'Guadalajara', NULL, NULL, NULL, 'Activa', '2023-10-06 15:27:28', '2023-10-06 15:27:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante`
--

DROP TABLE IF EXISTS `comprobante`;
CREATE TABLE IF NOT EXISTS `comprobante` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `comentario` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comprobante`
--

INSERT INTO `comprobante` (`id`, `nombre`, `comentario`) VALUES
(1, 'Factura', 'Facturas'),
(2, 'Nota', 'Nota de remisión.'),
(3, 'Remisión', 'Remisión'),
(4, 'Vale Q2Ces', 'Vale de la empresa'),
(5, 'Ingreso', NULL),
(6, 'N/A', NULL),
(7, 'Saldo', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conceptos`
--

DROP TABLE IF EXISTS `conceptos`;
CREATE TABLE IF NOT EXISTS `conceptos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` varchar(200) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `comentario` text,
  `tipo` int(11) DEFAULT NULL,
  `claveServicio` bigint(20) DEFAULT NULL,
  `tiposUnidadesId` bigint(20) UNSIGNED DEFAULT NULL,
  `unidadesSatId` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_conceptos_tiposUnidadesId` (`tiposUnidadesId`),
  KEY `FK_conceptos_unidadesSatId` (`unidadesSatId`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `conceptos`
--

INSERT INTO `conceptos` (`id`, `codigo`, `nombre`, `comentario`, `tipo`, `claveServicio`, `tiposUnidadesId`, `unidadesSatId`) VALUES
(1, '001-A', 'Saldo Semana Pasada', NULL, 1, NULL, NULL, NULL),
(2, '001-B', 'Ingreso a Caja Chica', NULL, 1, NULL, NULL, NULL),
(3, 'TEP-01', 'Viaje de Tepetate 14mts3', NULL, 2, NULL, NULL, NULL),
(4, '002-A', 'Ingreso a Caja Chica Extemporáneo', NULL, 1, NULL, NULL, NULL),
(5, '002-B', 'Retorno Ingreso Extemporáneo', NULL, 1, NULL, NULL, NULL),
(6, 'AGT-01', 'Agua Purificada Taller', NULL, 1, NULL, NULL, NULL),
(7, 'AGU-01', 'Viaje de Agua 20 mil litros', NULL, 2, NULL, NULL, NULL),
(8, 'ARE-01', 'Viaje de Arena de Rio Cribada 14mts3', NULL, 2, NULL, NULL, NULL),
(9, 'ARE-02', 'Viaje de Arena de Rio Cernida 14mts3', NULL, 2, NULL, NULL, NULL),
(10, 'ARE-03', 'Viaje de Arena de Rio Cribada 7mts3', NULL, 2, NULL, NULL, NULL),
(11, 'ARE-04', 'Viaje de Arena de Rio Cernida 7mts3', NULL, 2, NULL, NULL, NULL),
(12, 'ARE-05', 'Arena Amarilla 14mts3', NULL, 2, NULL, NULL, NULL),
(13, 'ARE-06', 'Arena Amarilla 7mts3', NULL, 2, NULL, NULL, NULL),
(14, 'BAS-01', 'Tiro de Basura 14mts3', NULL, 2, NULL, NULL, NULL),
(15, 'BAS-02', 'Tiro de Basura 7mts3', NULL, 2, NULL, NULL, NULL),
(16, 'BASE-01', 'Viaje de Base 70/30', NULL, 2, NULL, NULL, NULL),
(17, 'CAS-01', 'Casetas Autopista', NULL, 1, NULL, NULL, NULL),
(18, 'CON-01', 'Construcción en Taller', NULL, 1, NULL, NULL, NULL),
(19, 'ESC-01', 'Viaje de Escombro con Tiro 14mts3', NULL, 2, NULL, NULL, NULL),
(20, 'ESC-02', 'Viaje de Escombro con Tiro 7mts3', NULL, 2, NULL, NULL, NULL),
(21, 'EST-01', 'Estacionamiento', NULL, 1, NULL, NULL, NULL),
(22, 'FLE-01', 'Flete de Maquinaria', NULL, 2, NULL, NULL, NULL),
(23, 'FLE-02', 'Flete de Grúa', NULL, 2, NULL, NULL, NULL),
(24, 'FLE-03', 'Flete de Camión', NULL, 2, NULL, NULL, NULL),
(25, 'GAL-01', 'Galleros Volteo', NULL, 2, NULL, NULL, NULL),
(26, 'GRA-01', 'Viaje de Grava 14mts3', NULL, 2, NULL, NULL, NULL),
(27, 'GRA-02', 'Viaje de Grava 7mts3', NULL, 2, NULL, NULL, NULL),
(28, 'GRU-01', 'Servicio de Grúa por Hora', NULL, 2, NULL, NULL, NULL),
(29, 'JAL-01', 'Viaje de Jal 14mts3', NULL, 2, NULL, NULL, NULL),
(30, 'JAL-02', 'Viaje de Jal 7mts3', NULL, 2, NULL, NULL, NULL),
(31, 'PRO-01', 'Propina a Operador', NULL, 1, NULL, NULL, NULL),
(32, 'PRO-02', 'Propina Basura Municipal Taller', NULL, 1, NULL, NULL, NULL),
(33, 'REF-01', 'Compra de Refacciones', NULL, 1, NULL, NULL, NULL),
(34, 'REP-01', 'Reparación de Equipos', NULL, 1, NULL, NULL, NULL),
(35, 'SEL-01', 'Viaje de Sello 14mts3', NULL, 2, NULL, NULL, NULL),
(36, 'SEL-02', 'Viaje de Sello 7mts3', NULL, 2, NULL, NULL, NULL),
(37, 'TEP-02', 'Viaje de Tepetate 7mts3', NULL, 2, NULL, NULL, NULL),
(38, 'TRAM-01', 'Pago de Multas', NULL, 1, NULL, NULL, NULL),
(39, 'TRAM-XX', 'Impulsos Procesales', NULL, 1, NULL, NULL, NULL),
(40, 'TRAM-XY', 'Pago Extemporáneo a Operador', NULL, 1, NULL, NULL, NULL),
(41, 'MAD-01', 'Viaje de Madera 14MTS', NULL, 1, NULL, NULL, NULL),
(42, 'MAD-02', 'Viaje de Madera 7MTS', NULL, 1, NULL, NULL, NULL),
(43, 'REN-01', 'Renta de Equipo por Día', NULL, 1, NULL, NULL, NULL),
(44, 'ZZZ-Test', 'Concepto para test', NULL, 1, NULL, NULL, NULL),
(45, 'COM-01', 'Gasto para Evento', NULL, 1, NULL, NULL, NULL),
(46, 'TEZ-01', 'Viaje de Tezontle de 14mts3', NULL, 1, NULL, NULL, NULL),
(47, 'TEZ-02', 'Viaje de Tezontle de 7mts3', NULL, 1, NULL, NULL, NULL),
(48, 'TAL-01', 'Pago Renta de Taller', NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conceptosServiciosTrasporte`
--

DROP TABLE IF EXISTS `conceptosServiciosTrasporte`;
CREATE TABLE IF NOT EXISTS `conceptosServiciosTrasporte` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` varchar(200) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `comentario` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

DROP TABLE IF EXISTS `contactos`;
CREATE TABLE IF NOT EXISTS `contactos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `personalId` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `particular` varchar(255) DEFAULT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `parentesco` varchar(255) DEFAULT NULL,
  `nombreP` varchar(255) DEFAULT NULL,
  `nombreM` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_contactos_personalId` (`personalId`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `personalId`, `nombre`, `particular`, `celular`, `parentesco`, `nombreP`, `nombreM`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, 'Livier Gómez Placencia', NULL, '33 2339 1241', NULL, 'J. Félix Villalobos Castellón', 'María del Refugio Ayala Gutiérrez'),
(4, 4, 'Melina López Orozco', NULL, '33 1326 5762', NULL, 'Javier Ibarra Ortiz', 'Ana Rosa Medina Ramírez'),
(5, 5, 'Rosa Elia García López', NULL, '33 2068 0938', NULL, 'Emigdio Torres Ramos', 'María de Jesús Torres Calzada'),
(6, 6, 'María Teresa Franco Telles', NULL, '33 2295 5699', NULL, 'José Luis Cobián Bautista', 'María Teresa Franco Telles'),
(7, 7, 'María Israel Cuevas Oceguera', NULL, '34 1198 8872', NULL, 'Constantino Magaña Cuevas', 'María de Jesús Contreras'),
(8, 8, 'Gabriela Garabito Marín', NULL, '33 1250 0558', NULL, 'Manuel Ávila Villalobos', 'Margarita Benítez Carvajal'),
(9, 9, 'Edson Alejandro Fajardo Céspedes', NULL, '33 2705 5746', NULL, 'David Fajardo Ruiz', 'María de Jesús Barrera Enciso'),
(10, 10, 'María Monserrat Razón Rodríguez', NULL, '33 2937 1142', NULL, 'Isidro Razón Ortega', 'Josefina Serrano Rosales'),
(11, 11, NULL, NULL, NULL, NULL, 'Pedro López Jara', 'Angela Hernández Ramírez'),
(12, 12, NULL, NULL, NULL, NULL, 'Enrique Alcalá', NULL),
(13, 13, 'Marcela Villareal Carranza', NULL, '33 3624 9831', NULL, 'Paz Aviña Covarrubias', 'Guadalupe García Lomelí'),
(14, 14, 'Cinthya Leticia Sánchez Padrón', NULL, '33 3598 3043', NULL, 'J. Félix Villalobos Gómez', 'Livier Gómez Placencia'),
(15, 15, 'Milagros Zulema Ramírez Aranda', NULL, '33 1811 2102', NULL, 'Israel López García', 'María López Ortega'),
(16, 16, 'Víctor Saul Finkelstein London', NULL, '33 3189 2270', NULL, 'Víctor Saul Finkelstein London', 'Raquel Moel'),
(17, 17, 'Luis Ricardo Rodríguez Martínez', NULL, '33 3359 8907', NULL, 'Luis Ricardo Rodríguez Martínez', 'Marisela Castañeda Ortega'),
(18, 18, 'María Elena Arana Pérez', NULL, '33 23 88 58 20', NULL, 'Miguel Sandoval Muñiz', 'Teresa Gallardo Franco'),
(19, 19, 'Mariana Salmerón Duran', NULL, '33 3394 6761', NULL, 'José Barajas Fuentes', 'Romana Maldonado Contreras'),
(20, 20, 'María Santos Luna Sánchez', NULL, '33 2629 6992', 'Madre', 'Víctor Manuel Mendoza Mercado', 'María Santos Luna Sánchez'),
(21, 21, 'Kevin Yandel Navarrete Moran', NULL, '33 1326 4609', NULL, 'Ismael Navarrete González', 'Alicia Haro Cedano'),
(22, 22, 'Georgina Espinosa Caballero', NULL, '71 5307 5657', NULL, 'Néstor Prieto Sosa', 'Georgina Espinosa Caballero'),
(23, 23, 'TERESA FREGOSO SIORDIA', NULL, '33 27805103', 'MADRE', 'ANGEL NUÑEZ MOLINA', 'TERESA FREGOSO SIORDIA'),
(24, 27, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corteCajaChica`
--

DROP TABLE IF EXISTS `corteCajaChica`;
CREATE TABLE IF NOT EXISTS `corteCajaChica` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `inicio` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `saldo` float(10,2) NOT NULL,
  `Movimientos` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `corteCajaChica`
--

INSERT INTO `corteCajaChica` (`id`, `inicio`, `fin`, `saldo`, `Movimientos`, `created_at`, `updated_at`) VALUES
(5, '2023-10-09 00:00:00', '2023-10-15 00:00:00', 4777.52, NULL, '2023-10-17 09:45:40', '2023-10-17 09:45:40'),
(6, '2023-10-16 00:00:00', '2023-10-22 00:00:00', 2041.51, NULL, '2023-10-23 09:25:27', '2023-10-23 09:25:27'),
(7, '2023-10-23 00:00:00', '2023-10-29 00:00:00', 9751.50, NULL, '2023-10-30 09:03:26', '2023-10-30 09:03:26'),
(8, '2023-10-30 00:00:00', '2023-11-05 00:00:00', 436.46, NULL, '2023-11-06 08:29:16', '2023-11-06 08:29:16'),
(9, '2023-11-06 00:00:00', '2023-11-12 00:00:00', 0.00, NULL, '2023-11-13 09:22:11', '2023-11-13 09:22:11'),
(10, '2023-11-13 00:00:00', '2023-11-19 00:00:00', -19495.54, NULL, '2023-11-21 16:32:16', '2023-11-21 16:32:16'),
(11, '2023-11-20 00:00:00', '2023-11-26 00:00:00', 496.64, NULL, '2023-11-27 08:48:59', '2023-11-27 08:48:59'),
(12, '2023-11-27 00:00:00', '2023-12-03 00:00:00', 753.61, NULL, '2023-12-04 09:18:41', '2023-12-04 09:18:41'),
(13, '2023-12-04 00:00:00', '2023-12-10 00:00:00', 707.52, NULL, '2023-12-11 09:36:54', '2023-12-11 09:36:54'),
(14, '2023-12-11 00:00:00', '2023-12-17 00:00:00', 3582.49, NULL, '2023-12-18 13:13:39', '2023-12-18 13:13:39'),
(15, '2023-12-18 00:00:00', '2023-12-24 00:00:00', 2815.47, NULL, '2023-12-26 08:50:09', '2023-12-26 08:50:09'),
(16, '2023-12-25 00:00:00', '2023-12-31 00:00:00', 3677.45, NULL, '2024-01-02 08:46:00', '2024-01-02 08:46:00'),
(17, '2024-01-01 00:00:00', '2024-01-07 00:00:00', 2148.38, NULL, '2024-01-08 08:29:05', '2024-01-08 08:29:05'),
(18, '2024-01-08 00:00:00', '2024-01-14 00:00:00', 2945.92, NULL, '2024-01-15 08:45:19', '2024-01-15 08:45:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descarga`
--

DROP TABLE IF EXISTS `descarga`;
CREATE TABLE IF NOT EXISTS `descarga` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `maquinariaId` bigint(20) UNSIGNED DEFAULT NULL,
  `operadorId` bigint(20) UNSIGNED NOT NULL,
  `servicioId` bigint(20) UNSIGNED DEFAULT NULL,
  `receptorId` bigint(20) UNSIGNED DEFAULT NULL,
  `litros` float(10,2) NOT NULL,
  `km` int(11) DEFAULT NULL,
  `imgKm` varchar(255) DEFAULT NULL,
  `imgHoras` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `grasa` float(10,2) DEFAULT '0.00',
  `hidraulico` float(10,2) DEFAULT '0.00',
  `anticongelante` float(10,2) DEFAULT '0.00',
  `motor` float(10,2) DEFAULT '0.00',
  `otro` float(10,2) DEFAULT '0.00',
  `direccion` float(10,2) DEFAULT '0.00',
  `ticket` bigint(20) NOT NULL,
  `tipoCisternaId` bigint(20) UNSIGNED DEFAULT NULL,
  `fechaLlegada` date DEFAULT NULL,
  `horas` time NOT NULL,
  `odometro` bigint(100) DEFAULT NULL,
  `odometroNuevo` bigint(100) DEFAULT NULL,
  `kilometrajeNuevo` bigint(100) DEFAULT NULL,
  `kilometrajeAnterior` bigint(100) DEFAULT NULL,
  `grasaUnitario` float(10,2) DEFAULT NULL,
  `hidraulicoUnitario` float(10,2) DEFAULT NULL,
  `anticongelanteUnitario` float(10,2) DEFAULT NULL,
  `mototUnitario` float(10,2) DEFAULT NULL,
  `direccionUnitario` float(10,2) DEFAULT NULL,
  `obraId` bigint(20) UNSIGNED DEFAULT NULL,
  `clienteId` bigint(20) UNSIGNED DEFAULT NULL,
  `precioCarga` bigint(20) NOT NULL,
  `otroComment` varchar(100) DEFAULT NULL,
  `descargaEnCargaDeToteId` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_descarga_serviciolId` (`operadorId`),
  KEY `FK_descarga_receptorId` (`maquinariaId`),
  KEY `FK_descarga_userId` (`userId`),
  KEY `FK_descarga_cisternas` (`tipoCisternaId`),
  KEY `FK_descarga_obraId` (`obraId`),
  KEY `FK_descarga_clienteId` (`clienteId`),
  KEY `FK_descarga_descargaEnCargaDeToteId` (`descargaEnCargaDeToteId`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `descarga`
--

INSERT INTO `descarga` (`id`, `maquinariaId`, `operadorId`, `servicioId`, `receptorId`, `litros`, `km`, `imgKm`, `imgHoras`, `created_at`, `updated_at`, `userId`, `grasa`, `hidraulico`, `anticongelante`, `motor`, `otro`, `direccion`, `ticket`, `tipoCisternaId`, `fechaLlegada`, `horas`, `odometro`, `odometroNuevo`, `kilometrajeNuevo`, `kilometrajeAnterior`, `grasaUnitario`, `hidraulicoUnitario`, `anticongelanteUnitario`, `mototUnitario`, `direccionUnitario`, `obraId`, `clienteId`, `precioCarga`, `otroComment`, `descargaEnCargaDeToteId`) VALUES
(1, 22, 14, NULL, 23, 70.00, 539378, '', '', '2024-01-04 10:10:30', '2024-01-04 10:11:03', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-04', '10:07:25', NULL, NULL, 539378, 538026, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 23, NULL, NULL),
(2, 30, 14, NULL, 14, 60.00, 5983, '', '', '2024-01-04 13:04:23', '2024-01-04 13:04:48', 3, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-04', '13:04:23', NULL, NULL, 5983, 5982, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 23, NULL, NULL),
(3, 22, 14, NULL, 23, 55.00, 539473, '', '', '2024-01-05 08:44:12', '2024-01-05 11:33:41', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-05', '08:41:06', NULL, NULL, 539473, 539378, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 23, NULL, NULL),
(4, 13, 14, NULL, 8, 40.00, 875380, '', '', '2024-01-05 09:15:07', '2024-01-05 11:34:33', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-05', '09:12:00', NULL, NULL, 875380, 874217, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 23, NULL, NULL),
(5, 26, 14, NULL, 7, 30.00, 2786, '', '', '2024-01-05 11:06:55', '2024-01-05 11:35:21', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-05', '11:03:49', NULL, NULL, 2786, 2784, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 23, NULL, NULL),
(6, 5, 14, NULL, 12, 50.00, 606510, NULL, NULL, '2024-01-06 08:30:37', '2024-01-06 08:32:03', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-06', '08:27:32', NULL, NULL, 606510, 600957, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 23, NULL, NULL),
(7, 15, 14, NULL, 22, 42.00, 894065, NULL, NULL, '2024-01-06 08:55:15', '2024-01-06 08:55:41', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-06', '08:52:09', NULL, NULL, 894065, 555560, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 23, NULL, NULL),
(8, 22, 14, NULL, 23, 100.00, 539685, NULL, NULL, '2024-01-08 09:05:24', '2024-01-08 09:06:35', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-08', '09:02:19', NULL, NULL, 539685, 539473, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 23, NULL, NULL),
(9, 5, 14, NULL, 12, 60.00, 606534, NULL, NULL, '2024-01-08 09:13:05', '2024-01-08 09:14:25', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-08', '09:09:59', NULL, NULL, 606534, 606510, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 23, NULL, NULL),
(10, 13, 14, NULL, 8, 60.00, 875381, NULL, NULL, '2024-01-08 10:15:18', '2024-01-08 10:17:22', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-08', '10:12:12', NULL, NULL, 875381, 875380, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 23, NULL, NULL),
(11, 22, 14, NULL, 23, 60.00, 539846, NULL, NULL, '2024-01-09 07:11:43', '2024-01-09 07:12:13', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-09', '07:08:38', NULL, NULL, 539846, 539685, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 23, NULL, NULL),
(12, 21, 14, NULL, 22, 20.00, 487795, NULL, NULL, '2024-01-09 09:00:42', '2024-01-09 09:25:42', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-09', '08:57:36', NULL, NULL, 487795, 486770, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 23, NULL, NULL),
(13, 13, 14, NULL, 8, 30.00, 875391, NULL, NULL, '2024-01-09 09:05:04', '2024-01-09 09:26:32', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-09', '09:01:58', NULL, NULL, 875391, 875381, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 23, NULL, NULL),
(14, 30, 14, NULL, 19, 50.00, 5994, NULL, NULL, '2024-01-09 09:25:16', '2024-01-09 09:27:48', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-09', '09:22:10', NULL, NULL, 5994, 5983, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 23, NULL, NULL),
(15, NULL, 14, NULL, 3, 75.00, NULL, NULL, NULL, '2024-01-09 13:47:01', '2024-01-09 13:50:17', 3, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-09', '13:47:00', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 23, 'Mercedes Benz Sprinter 08/01/23 354107 KM', NULL),
(16, 1, 14, NULL, NULL, 600.00, NULL, NULL, NULL, '2024-01-10 08:01:06', '2024-01-10 08:01:06', 3, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, NULL, NULL, '00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 13),
(17, 5, 16, NULL, 12, 60.00, 606679, NULL, NULL, '2024-01-10 08:34:09', '2024-01-10 08:34:26', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-10', '08:31:03', NULL, NULL, 606679, 606534, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 20, NULL, NULL),
(18, 15, 16, NULL, 22, 60.00, 894066, NULL, NULL, '2024-01-10 08:45:44', '2024-01-11 17:51:41', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-10', '08:42:00', NULL, NULL, 894066, 894065, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 20, NULL, NULL),
(19, 22, 16, NULL, 23, 70.00, 540006, NULL, NULL, '2024-01-10 09:11:30', '2024-01-10 09:11:56', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-10', '09:08:23', NULL, NULL, 540006, 539846, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 20, NULL, NULL),
(20, 13, 14, NULL, 8, 30.00, 875415, NULL, NULL, '2024-01-11 08:41:32', '2024-01-11 08:42:02', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-11', '08:38:27', NULL, NULL, 875415, 875391, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 20, NULL, NULL),
(21, 16, 14, NULL, NULL, 800.00, NULL, NULL, NULL, '2024-01-11 17:31:52', '2024-01-11 17:31:52', 3, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, NULL, NULL, '00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 15),
(22, 16, 14, 30, 19, 60.00, 6005, NULL, NULL, '2024-01-11 17:39:34', '2024-01-11 17:39:34', 3, NULL, NULL, NULL, NULL, 0.00, NULL, 0, NULL, '2024-01-11', '17:39:34', 24, 73255, 6005, 5994, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 0, NULL, NULL),
(23, 5, 14, NULL, 12, 50.00, 606784, NULL, NULL, '2024-01-12 13:27:37', '2024-01-12 13:29:15', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-12', '13:24:32', NULL, NULL, 606784, 606679, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 20, NULL, NULL),
(24, 19, 14, NULL, 3, 30.00, 77762, NULL, NULL, '2024-01-12 18:36:06', '2024-01-13 12:18:24', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-12', '18:33:01', NULL, NULL, 77762, 69546, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 20, NULL, NULL),
(25, 29, 14, NULL, 27, 60.00, 6160, NULL, NULL, '2024-01-13 12:17:35', '2024-01-13 12:19:28', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-13', '12:14:28', NULL, NULL, 6160, 4108, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 20, NULL, NULL),
(26, 71, 14, NULL, 3, 60.00, 354668, NULL, NULL, '2024-01-13 12:23:08', '2024-01-13 12:23:37', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-13', '12:20:02', NULL, NULL, 354668, 354107, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 20, NULL, NULL),
(27, 31, 14, NULL, 7, 24.00, 6573, NULL, NULL, '2024-01-13 12:56:45', '2024-01-13 13:36:02', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-13', '12:53:41', NULL, NULL, 6573, 6569, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 20, NULL, NULL),
(28, 22, 14, NULL, 23, 120.00, 540167, NULL, NULL, '2024-01-13 13:35:25', '2024-01-13 13:36:53', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-13', '13:32:20', NULL, NULL, 540167, 540006, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 20, NULL, NULL),
(29, 21, 14, NULL, 22, 60.00, 487824, NULL, NULL, '2024-01-15 09:48:35', '2024-01-15 11:15:46', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-15', '09:45:30', NULL, NULL, 487824, 487795, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 20, NULL, NULL),
(30, 5, 14, NULL, 8, 50.00, 606830, NULL, NULL, '2024-01-15 11:18:37', '2024-01-15 11:21:13', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-15', '11:15:33', NULL, NULL, 606830, 606784, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 20, NULL, NULL),
(31, 15, 14, NULL, 22, 50.00, 894067, NULL, NULL, '2024-01-16 09:23:17', '2024-01-16 10:02:42', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-16', '09:20:13', NULL, NULL, 894067, 894066, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 20, NULL, NULL),
(32, 5, 14, NULL, 8, 35.00, 606889, NULL, NULL, '2024-01-16 09:28:08', '2024-01-16 10:03:31', 21, NULL, NULL, NULL, NULL, 0.00, NULL, 1, 1, '2024-01-16', '09:25:02', NULL, NULL, 606889, 606830, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descargaDetalle`
--

DROP TABLE IF EXISTS `descargaDetalle`;
CREATE TABLE IF NOT EXISTS `descargaDetalle` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreSolicitante` varchar(255) DEFAULT NULL,
  `costoTrabajo` bigint(20) DEFAULT NULL,
  `horaLlegada` time DEFAULT NULL,
  `observaciones` text,
  `descargaId` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `tipo_solicitud` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_descarga` (`descargaId`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `descargaDetalle`
--

INSERT INTO `descargaDetalle` (`id`, `nombreSolicitante`, `costoTrabajo`, `horaLlegada`, `observaciones`, `descargaId`, `created_at`, `updated_at`, `tipo_solicitud`) VALUES
(1, NULL, NULL, NULL, NULL, 1, '2024-01-04 10:11:03', '2024-01-04 10:11:03', 0),
(2, NULL, NULL, NULL, NULL, 2, '2024-01-04 13:04:48', '2024-01-04 13:04:48', 0),
(3, NULL, NULL, NULL, NULL, 3, '2024-01-05 11:33:41', '2024-01-05 11:33:41', 0),
(4, NULL, NULL, NULL, NULL, 4, '2024-01-05 11:34:33', '2024-01-05 11:34:33', 0),
(5, NULL, NULL, NULL, NULL, 5, '2024-01-05 11:35:21', '2024-01-05 11:35:21', 0),
(6, NULL, NULL, NULL, NULL, 6, '2024-01-06 08:32:03', '2024-01-06 08:32:03', 0),
(7, NULL, NULL, NULL, NULL, 7, '2024-01-06 08:55:41', '2024-01-06 08:55:41', 0),
(8, NULL, NULL, NULL, NULL, 8, '2024-01-08 09:06:35', '2024-01-08 09:06:35', 0),
(9, NULL, NULL, NULL, NULL, 9, '2024-01-08 09:14:25', '2024-01-08 09:14:25', 0),
(10, NULL, NULL, NULL, NULL, 10, '2024-01-08 10:17:22', '2024-01-08 10:17:22', 0),
(11, NULL, NULL, NULL, NULL, 11, '2024-01-09 07:12:13', '2024-01-09 07:12:13', 0),
(12, NULL, NULL, NULL, NULL, 12, '2024-01-09 09:25:42', '2024-01-09 09:25:42', 0),
(13, NULL, NULL, NULL, NULL, 13, '2024-01-09 09:26:32', '2024-01-09 09:26:32', 0),
(14, NULL, NULL, NULL, NULL, 14, '2024-01-09 09:27:48', '2024-01-09 09:27:48', 0),
(15, NULL, NULL, NULL, 'Mercedes Benz Sprinter 08/01/23 354107 KM', 15, '2024-01-09 13:50:17', '2024-01-09 13:50:17', 0),
(16, NULL, NULL, NULL, NULL, 17, '2024-01-10 08:34:26', '2024-01-10 08:34:26', 0),
(17, NULL, NULL, NULL, NULL, 18, '2024-01-10 08:46:13', '2024-01-10 08:46:13', 0),
(18, NULL, NULL, NULL, NULL, 19, '2024-01-10 09:11:56', '2024-01-10 09:11:56', 0),
(19, NULL, NULL, NULL, NULL, 20, '2024-01-11 08:42:02', '2024-01-11 08:42:02', 0),
(20, NULL, NULL, NULL, NULL, 23, '2024-01-12 13:29:15', '2024-01-12 13:29:15', 0),
(21, NULL, NULL, NULL, NULL, 24, '2024-01-13 12:18:24', '2024-01-13 12:18:24', 0),
(22, NULL, NULL, NULL, NULL, 25, '2024-01-13 12:19:28', '2024-01-13 12:19:28', 0),
(23, NULL, NULL, NULL, NULL, 26, '2024-01-13 12:23:37', '2024-01-13 12:23:37', 0),
(24, NULL, NULL, NULL, NULL, 27, '2024-01-13 13:36:02', '2024-01-13 13:36:02', 0),
(25, NULL, NULL, NULL, NULL, 28, '2024-01-13 13:36:53', '2024-01-13 13:36:53', 0),
(26, NULL, NULL, NULL, NULL, 29, '2024-01-15 11:15:46', '2024-01-15 11:15:46', 0),
(27, NULL, NULL, NULL, NULL, 30, '2024-01-15 11:21:13', '2024-01-15 11:21:13', 0),
(28, NULL, NULL, NULL, NULL, 31, '2024-01-16 10:02:42', '2024-01-16 10:02:42', 0),
(29, NULL, NULL, NULL, NULL, 32, '2024-01-16 10:03:31', '2024-01-16 10:03:31', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docs`
--

DROP TABLE IF EXISTS `docs`;
CREATE TABLE IF NOT EXISTS `docs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `tipoId` bigint(20) UNSIGNED NOT NULL,
  `comentario` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_docs_tipoId` (`tipoId`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `docs`
--

INSERT INTO `docs` (`id`, `nombre`, `tipoId`, `comentario`, `created_at`, `updated_at`) VALUES
(1, 'Acta de Nacimiento', 1, 'Acta de nacimiento del personal', '2023-07-27 03:00:59', '2023-07-27 03:00:59'),
(2, 'CURP', 1, 'documento de Clave Única de Registro de Población', '2023-07-27 03:01:39', '2023-09-15 14:02:29'),
(3, 'Licencia de conducir', 1, 'Licencia que avale que sabe conducir', '2023-07-27 03:02:14', '2023-07-27 03:02:14'),
(4, 'Permiso', 2, '.', '2023-07-27 06:43:22', '2023-07-27 06:43:22'),
(5, 'Seguro', 2, '.', '2023-07-27 06:43:33', '2023-07-27 06:43:33'),
(6, 'Tarjeta de Circulación', 2, 'Tarjeta de Circulación', '2023-07-27 06:44:07', '2023-09-19 16:29:25'),
(7, 'Manual de Usuario', 2, 'Manual de Usuario', '2023-07-27 06:44:46', '2023-09-19 16:29:01'),
(8, 'Factura', 2, 'Endoso y pedimento de importación', '2023-07-27 06:44:56', '2023-09-19 16:31:58'),
(9, 'Constancia de Situación Fiscal', 1, 'Constancia de Situación Fiscal', '2023-09-15 14:02:56', '2023-09-15 14:02:56'),
(10, 'Solicitud de Empleo o CV', 1, 'Solicitud o CV', '2023-09-19 16:18:57', '2023-09-19 16:18:57'),
(11, 'Credencial de Elector o INE', 1, 'INE', '2023-09-19 16:19:29', '2023-09-19 16:19:29'),
(12, 'Comprobante de Domicilio', 1, 'Luz, Agua o Teléfono, máximo dos meses de antigüedad', '2023-09-19 16:20:52', '2023-09-19 16:20:52'),
(13, 'Constancia de no Antecedentes Penales', 1, 'Carta de Policía', '2023-09-19 16:21:48', '2023-09-19 16:21:48'),
(14, 'Constancia de Vigencia de Derechos IMSS', 1, 'IMSS', '2023-09-19 16:23:08', '2023-09-19 16:23:08'),
(15, 'Aviso de Retención de Infonavit', 1, 'Infonavit', '2023-09-19 16:23:35', '2023-09-19 16:23:35'),
(16, 'Aviso de Retención del Fonacot', 1, 'Fonacot', '2023-09-19 16:23:58', '2023-09-19 16:23:58'),
(17, 'Examen Médico', 1, 'Examen médico', '2023-09-19 16:24:22', '2023-09-19 16:24:22'),
(18, 'Examen Antidoping', 1, 'Antidoping', '2023-09-19 16:24:37', '2023-09-19 16:24:37'),
(19, 'Cartas de Recomendación Personal', 1, 'carta de recomendación', '2023-09-19 16:24:59', '2023-09-19 16:24:59'),
(20, 'Cartas de Recomendación de Empleo', 1, 'Carta de recomendación', '2023-09-19 16:25:19', '2023-09-19 16:25:19'),
(21, 'Cédula Profesional', 1, 'Cédula Profesional', '2023-09-19 16:25:36', '2023-09-19 16:25:36'),
(23, 'Verificación Ambiental', 2, 'Verificación', '2023-09-19 16:29:59', '2023-09-19 16:29:59'),
(24, 'Certificación del Equipo', 2, 'Certificación', '2023-09-19 16:30:18', '2023-09-19 16:30:18'),
(25, 'Foto de Placa', 2, 'Placa', '2023-09-19 16:30:31', '2023-09-19 16:30:31'),
(26, 'Foto del VIN', 2, 'Foto del VIN', '2023-09-19 16:30:50', '2023-09-19 16:30:50'),
(27, 'Refrendos Anuales', 2, 'Refrendos Acumulados', '2023-09-19 16:32:21', '2023-09-19 16:32:21'),
(28, 'Alta del IMSS', 1, 'Alta del IMSS', '2023-09-21 21:09:20', '2023-09-21 21:09:20'),
(29, 'Contrato de prueba 90 días', 1, 'Contrato de prueba 90 días', '2023-09-27 15:39:41', '2023-09-27 15:39:41'),
(30, 'Contrato por tiempo indefinido', 1, 'Contrato por tiempo indefinido', '2023-09-27 15:40:23', '2023-09-27 15:40:23'),
(31, 'Comprobante de ultimo grado de estudios', 1, 'Comprobante de ultimo grado de estudios', '2023-09-27 16:41:45', '2023-09-27 16:41:45'),
(32, 'Factura', 3, 'Factura de compra de un articulo o accesorio', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentoSelladoMantenimiento`
--

DROP TABLE IF EXISTS `documentoSelladoMantenimiento`;
CREATE TABLE IF NOT EXISTS `documentoSelladoMantenimiento` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mantenimientoId` bigint(20) UNSIGNED DEFAULT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_documentoSelladoMantenimiento_mantenimiento` (`mantenimientoId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `documentoSelladoMantenimiento`
--

INSERT INTO `documentoSelladoMantenimiento` (`id`, `mantenimientoId`, `ruta`, `created_at`, `updated_at`) VALUES
(6, 33, '0033_1704293354_Imagen01.pdf', '2024-01-03 14:49:14', '2024-01-03 14:49:14'),
(7, 31, '0031_1704293389_Imagen01.pdf', '2024-01-03 14:49:49', '2024-01-03 14:49:49'),
(8, 40, '0040_1704906822_Imagen01.jpeg', '2024-01-10 17:13:42', '2024-01-10 17:13:42'),
(10, 42, '0042_1705164860_Imagen01.jpeg', '2024-01-13 16:54:20', '2024-01-13 16:54:20'),
(11, 43, '0043_1705164978_Imagen01.jpeg', '2024-01-13 16:56:18', '2024-01-13 16:56:18'),
(12, 44, '0044_1705332972_Imagen01.jpeg', '2024-01-15 15:36:12', '2024-01-15 15:36:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

DROP TABLE IF EXISTS `equipo`;
CREATE TABLE IF NOT EXISTS `equipo` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `personalId` bigint(20) UNSIGNED NOT NULL,
  `chaleco` varchar(200) DEFAULT NULL,
  `camisa` varchar(200) DEFAULT NULL,
  `botas` varchar(200) DEFAULT NULL,
  `guantes` varchar(200) DEFAULT NULL,
  `comentarios` text,
  `pc` varchar(200) DEFAULT NULL,
  `pcSerial` varchar(200) DEFAULT NULL,
  `celular` varchar(200) DEFAULT NULL,
  `celularImei` varchar(200) DEFAULT NULL,
  `radio` varchar(200) DEFAULT NULL,
  `radioSerial` varchar(200) DEFAULT NULL,
  `cargadorSerial` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_equipo_personalId` (`personalId`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id`, `personalId`, `chaleco`, `camisa`, `botas`, `guantes`, `comentarios`, `pc`, `pcSerial`, `celular`, `celularImei`, `radio`, `radioSerial`, `cargadorSerial`) VALUES
(1, 1, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 5, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 6, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 7, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 8, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 9, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 10, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 11, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 12, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 13, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 14, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 15, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 16, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 17, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 18, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 19, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 20, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 21, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 22, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 23, 'G', 'G', NULL, 'Mediana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 27, 'XS', 'XS', NULL, 'Chica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `color` varchar(8) DEFAULT NULL,
  `comentario` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`, `color`, `comentario`) VALUES
(1, 'En Espera', '#59FF33', 'En espera de antención'),
(2, 'Realizando', '#FF5733', 'Ya se está trabajando'),
(3, 'Terminado', 'navy', 'Ya se terminó de ejecutar'),
(4, 'Borrado', 'red', 'Se borro el registro de forma lógica'),
(5, 'Borrado', 'red', 'Se borro el registro de forma lógica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventoImportante`
--

DROP TABLE IF EXISTS `eventoImportante`;
CREATE TABLE IF NOT EXISTS `eventoImportante` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `comentario` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tareas_userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `eventoImportante`
--

INSERT INTO `eventoImportante` (`id`, `userId`, `titulo`, `start`, `end`, `comentario`, `created_at`, `updated_at`) VALUES
(1, 1, 'Posada Navideña', '2023-12-15 15:00:00', '2023-12-15 20:08:00', 'q2ces', '2023-12-11 13:08:14', '2023-12-11 13:08:14'),
(2, 5, 'lll', '2023-12-11 13:14:00', '0000-00-00 00:00:00', NULL, '2023-12-11 13:14:52', '2023-12-11 13:14:52'),
(3, 5, 'lll', '2023-12-11 13:14:00', '0000-00-00 00:00:00', NULL, '2023-12-11 13:18:55', '2023-12-11 13:18:55'),
(4, 5, 'test', '2023-12-11 13:23:00', '2023-12-11 13:51:00', 'teste comment', '2023-12-11 13:23:43', '2023-12-11 13:23:43'),
(5, 5, 'test', '2023-12-11 13:23:00', '2023-12-11 13:51:00', 'teste comment', '2023-12-11 13:25:29', '2023-12-11 13:25:29'),
(6, 3, 'Posada Q2CES y NEWS', '2023-12-15 15:00:00', '2023-12-15 20:00:00', NULL, '2023-12-12 09:02:59', '2023-12-12 09:02:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `prioridadId` bigint(20) UNSIGNED NOT NULL,
  `comentario` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_eventos_userId` (`userId`),
  KEY `FK_eventos_prioridadId` (`prioridadId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventosCalendarioTipos`
--

DROP TABLE IF EXISTS `eventosCalendarioTipos`;
CREATE TABLE IF NOT EXISTS `eventosCalendarioTipos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `comentario` text,
  `tipoEvento` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `eventosCalendarioTipos`
--

INSERT INTO `eventosCalendarioTipos` (`id`, `nombre`, `color`, `comentario`, `tipoEvento`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Eventos Importantes', '#8a8a8a', 'Evento Importante que Manualmente se da de Alta en el Calendario', 'EventoImportante', 1, NULL, NULL),
(2, 'Expiran Documentos', '#f70202', 'Evento que Indica que los Documentos van a Expirar', 'ExpiranDocumentos', 1, NULL, NULL),
(3, 'Dias Feriados', '#a6ce34', 'Evento que Indica un Día Festivo en el Calendario', 'DiaFeriado', 1, NULL, NULL),
(4, 'Actividades', '#ffa500', 'Actividad Variada que se Asignan  a un Personal Manualmente en el Calendario', 'actividades', 1, NULL, NULL),
(5, 'Solicitudes', '#ffff00', 'Solicitud que Manualmente se da de Alta en el Calendario', 'solicitud', 1, NULL, NULL),
(6, 'Cumpleaños', '#a76ca5', 'Evento que celebra el cumpleaños de alguien registrado en personal', 'cumple', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extintores`
--

DROP TABLE IF EXISTS `extintores`;
CREATE TABLE IF NOT EXISTS `extintores` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `identificador` varchar(200) DEFAULT NULL,
  `serie` varchar(200) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `ultimaRevision` date DEFAULT NULL,
  `proximaRevision` date NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `ubicacionId` bigint(20) UNSIGNED DEFAULT NULL,
  `lugarId` bigint(20) UNSIGNED DEFAULT NULL,
  `maquinariaId` bigint(20) UNSIGNED DEFAULT NULL,
  `comentario` text,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_extintores_ubicacionId` (`ubicacionId`),
  KEY `FK_extintores_lugarId` (`lugarId`),
  KEY `FK_extintores_maquinariaId` (`maquinariaId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `extintores`
--

INSERT INTO `extintores` (`id`, `identificador`, `serie`, `capacidad`, `ultimaRevision`, `proximaRevision`, `tipo`, `ubicacionId`, `lugarId`, `maquinariaId`, `comentario`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Officiis nulla liber', 'Nesciunt consequunt', 49, '2023-09-18', '2023-09-30', 'Sint temporibus sed', 1, 1, 1, 'Voluptates obcaecati doloribus proident quod earum similique cupiditate ut facilis aut ut nemo minus dolore voluptatum', 1, '2023-09-18 17:34:55', '2023-09-21 21:30:49'),
(2, '53', '53', 2, '2023-05-01', '2023-05-01', 'B', 1, NULL, 25, '.', 1, '2024-01-10 22:53:55', '2024-01-10 22:53:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturaCliente`
--

DROP TABLE IF EXISTS `facturaCliente`;
CREATE TABLE IF NOT EXISTS `facturaCliente` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) UNSIGNED DEFAULT NULL,
  `clienteId` bigint(20) UNSIGNED DEFAULT NULL,
  `folio` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `pdf` varchar(255) DEFAULT NULL,
  `xml` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_facturaCliente_userId` (`userId`),
  KEY `FK_facturaCliente_clienteId` (`clienteId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturaProvedor`
--

DROP TABLE IF EXISTS `facturaProvedor`;
CREATE TABLE IF NOT EXISTS `facturaProvedor` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) UNSIGNED DEFAULT NULL,
  `provedorId` bigint(20) UNSIGNED DEFAULT NULL,
  `folio` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `pdf` varchar(255) DEFAULT NULL,
  `xml` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_facturaProvedor_userId` (`userId`),
  KEY `FK_facturaProvedor_provedorId` (`provedorId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fiscal`
--

DROP TABLE IF EXISTS `fiscal`;
CREATE TABLE IF NOT EXISTS `fiscal` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `personalId` bigint(20) UNSIGNED NOT NULL,
  `cp` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `interior` varchar(255) DEFAULT NULL,
  `colonia` varchar(255) DEFAULT NULL,
  `localidad` varchar(255) DEFAULT NULL,
  `municipio` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `entre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_fiscal_personalId` (`personalId`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fiscal`
--

INSERT INTO `fiscal` (`id`, `personalId`, `cp`, `tipo`, `calle`, `numero`, `interior`, `colonia`, `localidad`, `municipio`, `estado`, `entre`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, '44510', NULL, 'Clemente Orozco', '86', NULL, 'Guadalajara', NULL, NULL, 'Jalisco', NULL),
(3, 3, '45877', NULL, 'A', 'A', 'A', NULL, 'No Especificada', 'Ixtlahuacán de los membrillos', 'Jalisco', 'A'),
(4, 4, '45653', NULL, 'Villa Martelli', '4', NULL, 'Villalta', 'Villalta', 'Tlajomulco de Zúñiga', 'Jalisco', 'Villa Adelina'),
(5, 5, '44510', NULL, 'Clemente Orozco', '86', NULL, 'Santamaria del Pueblito', NULL, NULL, 'Jalisco', NULL),
(6, 6, '45525', NULL, 'San Pedro Tlaquepaque', '1115', NULL, 'La soledad', 'Tlaquepaque', 'San Pedro Tlaquepaque', 'Jalisco', NULL),
(7, 7, '49650', NULL, 'Pedro Moreno', '104', NULL, NULL, 'Tamazula', 'Tamazula de Gordiano', 'Jalisco', NULL),
(8, 8, '37000', NULL, 'BLVD. Adolfo López Mateos Oriente', '103', '101', 'Centro', NULL, 'León', 'Jalisco', 'Hermanos Aldama'),
(9, 9, '44460', NULL, 'Matías Romero', '1059', NULL, 'San Carlos', NULL, 'Guadalajara', 'Jalisco', NULL),
(10, 10, '22909', NULL, 'Sinaloa', 'Sinaloa', NULL, 'Abelardo Rodríguez', 'Ejido México (Punta Colonet)', 'Ensenada', 'Jalisco', 'Sinaloa'),
(11, 11, '68120', NULL, 'Carbonera', '1016', NULL, 'Trinidad de las huertas', NULL, 'Oaxaca de Juárez', 'Jalisco', NULL),
(12, 12, '45200', NULL, 'Juan Manuel Ruvalcaba de la Mora', '23', NULL, 'Santa Lucia', NULL, 'Zapopan', 'Jalisco', 'Av. Capulines'),
(13, 13, '45200', NULL, 'Calle San Oscar', '224', NULL, 'San José Ejidal', NULL, 'Zapopan', 'Jalisco', NULL),
(14, 14, '45160', NULL, 'Av. Guadalajara', '1795', NULL, 'Hogares de Nuevo México', NULL, NULL, 'Jalisco', NULL),
(15, 15, '45235', NULL, 'Sinaloa', '1114', NULL, 'El Mante', 'El Mante', 'Zapopan', 'Jalisco', NULL),
(16, 16, '44657', NULL, 'José María Heredia', '2387', NULL, 'Lomas de Guevara', 'Guadalajara', 'Guadalajara', 'Jalisco', 'General Eulogio  Parra'),
(17, 17, '45157', NULL, 'Av. Dr. Luis Farah', '1023', NULL, 'Villas de los Belenes', NULL, NULL, 'Jalisco', NULL),
(18, 18, '45400', NULL, 'Blanca', '342', NULL, NULL, 'Tonalá', 'Tonala', 'Jalisco', NULL),
(19, 19, '45200', NULL, 'Av. Valle Del Sol', '531 861', NULL, 'Fracc. Valle de los Molinos', NULL, NULL, 'Jalisco', NULL),
(20, 20, '45189', NULL, 'Privada Frijol', '180', NULL, 'Crucero de la Mesa Poniente', NULL, NULL, 'Jalisco', NULL),
(21, 21, '45180', NULL, 'Calle Rafael Martínez', '547 Altos', NULL, 'Constitución (NTE).', NULL, NULL, 'Jalisco', NULL),
(22, 22, '45138', NULL, 'Valle de San Pedro', '2347', NULL, 'Jardines del Valle', NULL, NULL, 'Jalisco', NULL),
(23, 23, '45150', NULL, 'SANTA ROSA', '128 B', NULL, 'Zapopan', NULL, NULL, 'Jalisco', NULL),
(24, 27, '45602', NULL, 'C. CAM. EL TAJO', '517', NULL, NULL, NULL, NULL, 'Jalisco', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frecuenciaEjecucion`
--

DROP TABLE IF EXISTS `frecuenciaEjecucion`;
CREATE TABLE IF NOT EXISTS `frecuenciaEjecucion` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `comentario` text,
  `dias` int(8) DEFAULT NULL,
  `minimoEjecucion` int(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `frecuenciaEjecucion`
--

INSERT INTO `frecuenciaEjecucion` (`id`, `nombre`, `comentario`, `dias`, `minimoEjecucion`) VALUES
(1, 'Diaria', 'Ejecución diaria', 1, 1),
(2, 'Semanal', 'De ejecucion semanal', 7, 3),
(3, 'Quincenal', 'De ejecución quincenal', 15, 7),
(4, 'Mensual', 'De ejecucion Mensual', 30, 15),
(5, 'Bimestral', 'De ejecución bimestral', 60, 30),
(6, 'Trimestral', 'De ejecucion trimestral', 90, 45),
(7, 'Cuatrimestral', 'De ejecución Cuatrimestral', 120, 60),
(8, 'Semestral', 'De ejecución semestral', 180, 90),
(9, 'Anual', 'De ejecución anual', 365, 180),
(10, 'Extemporánea', 'De ejecución fuera de tiempos', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastosMantenimiento`
--

DROP TABLE IF EXISTS `gastosMantenimiento`;
CREATE TABLE IF NOT EXISTS `gastosMantenimiento` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mantenimientoId` bigint(20) UNSIGNED NOT NULL,
  `inventarioId` bigint(20) UNSIGNED DEFAULT NULL,
  `manoObraId` bigint(20) UNSIGNED DEFAULT NULL,
  `concepto` varchar(200) NOT NULL,
  `numeroParte` varchar(255) NOT NULL,
  `seccion` varchar(255) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `costo` float(16,2) DEFAULT NULL,
  `total` float(16,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_gastosmantenimiento_mantenimientoId` (`mantenimientoId`),
  KEY `FK_gastosmantenimiento_manoObraId` (`manoObraId`),
  KEY `FK_gastosmantenimiento_productoId` (`inventarioId`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gastosMantenimiento`
--

INSERT INTO `gastosMantenimiento` (`id`, `mantenimientoId`, `inventarioId`, `manoObraId`, `concepto`, `numeroParte`, `seccion`, `cantidad`, `costo`, `total`, `created_at`, `updated_at`) VALUES
(7, 19, 5, NULL, 'Aceite 20W-50', '123456', 'consumibles', 1, 899.00, 899.00, '2023-12-01 12:29:42', '2023-12-01 12:29:42'),
(8, 19, NULL, 2, 'Mano de Obra Revisión', 'MO-02', 'mano de obra', 1, 100.00, 100.00, '2023-12-01 12:29:42', '2023-12-01 12:29:42'),
(10, 21, 4, NULL, 'Aceite Pruebas', '0010', 'consumibles', 4, 35.00, 140.00, '2023-12-01 12:50:44', '2023-12-01 12:50:44'),
(11, 21, NULL, 1, 'Mano de Obra', 'MO-01', 'mano de obra', 1, 500.00, 500.00, '2023-12-01 12:50:44', '2023-12-01 12:50:44'),
(12, 28, 2, NULL, 'Test', '0001', 'refacciones', 5, 100.00, 500.00, '2023-12-01 13:05:49', '2023-12-01 13:05:49'),
(13, 30, 7, NULL, 'Kit de Clutch Nissan NP300 2018', '0001', 'refacciones', 1, 2900.00, 2900.00, '2023-12-01 17:59:32', '2023-12-01 17:59:32'),
(14, 30, NULL, 1, 'Mano de Obra', 'MO-01', 'mano de obra', 4, 500.00, 2000.00, '2023-12-01 17:59:32', '2023-12-01 17:59:32'),
(15, 30, 8, NULL, 'Aceite de Transmisión', '0001', 'consumibles', 4, 160.00, 640.00, '2023-12-01 18:10:45', '2023-12-01 18:10:45'),
(16, 31, 7, NULL, 'Kit de Clutch Nissan NP300 2018', '0001', 'refacciones', 1, 2900.00, 2900.00, '2023-12-01 18:16:20', '2023-12-01 18:16:20'),
(17, 31, 8, NULL, 'Aceite de Transmisión', '0001', 'consumibles', 4, 160.00, 640.00, '2023-12-01 18:16:20', '2023-12-01 18:16:20'),
(18, 31, NULL, 1, 'Mano de Obra', 'MO-01', 'mano de obra', 4, 500.00, 2000.00, '2023-12-01 18:16:20', '2023-12-01 18:16:20'),
(19, 32, 9, NULL, 'Filtro de Aceite', '188610', 'refacciones', 1, 80.10, 80.10, '2023-12-04 09:04:30', '2023-12-04 09:04:30'),
(20, 32, 14, NULL, 'Filtro de Aire', '1009329', 'refacciones', 1, 271.73, 271.73, '2023-12-04 09:04:30', '2023-12-04 09:04:30'),
(21, 32, 13, NULL, 'Filtro de Cabina', '448149', 'refacciones', 1, 289.00, 289.00, '2023-12-04 09:04:30', '2023-12-04 09:04:30'),
(22, 32, 11, NULL, 'Filtro de Gasolina', '781640', 'refacciones', 1, 228.93, 228.93, '2023-12-04 09:04:30', '2023-12-04 09:04:30'),
(23, 32, 15, NULL, 'Aceite Sintético', '526624', 'consumibles', 5, 166.50, 832.50, '2023-12-04 09:04:30', '2023-12-04 09:04:30'),
(24, 32, 10, NULL, 'Bujía Doble Iridio', '256750', 'refacciones', 4, 166.50, 666.00, '2023-12-04 09:04:30', '2023-12-04 09:04:30'),
(25, 32, NULL, 1, 'Mano de Obra', 'MO-01', 'mano de obra', 3, 500.00, 1500.00, '2023-12-04 09:16:08', '2023-12-04 09:16:08'),
(27, 33, 12, NULL, 'Filtro de Aire', '862131', 'refacciones', 1, 259.57, 259.57, '2023-12-13 08:42:59', '2023-12-13 08:42:59'),
(28, 33, 11, NULL, 'Filtro de Gasolina', '781640', 'refacciones', 1, 269.10, 269.10, '2023-12-13 08:42:59', '2023-12-13 08:42:59'),
(29, 33, 16, NULL, 'Bujía Doble Platino', '938524', 'refacciones', 1, 77.40, 77.40, '2023-12-13 08:42:59', '2023-12-13 08:42:59'),
(30, 33, 9, NULL, 'Filtro de Aceite', '188610', 'refacciones', 1, 80.10, 80.10, '2023-12-13 08:42:59', '2023-12-13 08:42:59'),
(31, 33, 17, NULL, 'Kit de Clutch', '1055826', 'refacciones', 1, 3959.10, 3959.10, '2023-12-13 08:42:59', '2023-12-13 08:42:59'),
(32, 33, 19, NULL, 'Aceite de Motor 20W-50', '526626', 'consumibles', 5, 166.50, 832.50, '2023-12-13 08:47:02', '2023-12-13 08:47:02'),
(33, 33, 18, NULL, 'Aceite de Transmisón Manual 80W-90', '227574', 'consumibles', 5, 133.02, 665.10, '2023-12-13 08:47:02', '2023-12-13 08:47:02'),
(44, 33, 36, NULL, 'Amortiguador Delantero Izquierdo', '7000968', 'refacciones', 1, 989.48, 989.48, '2023-12-16 09:04:16', '2023-12-16 09:04:16'),
(45, 33, 37, NULL, 'Amortiguador Delantero Derecho', '7000969', 'refacciones', 1, 989.48, 989.48, '2023-12-16 09:04:16', '2023-12-16 09:04:16'),
(46, 33, 38, NULL, 'Amortiguador Trasero', '170821', 'refacciones', 2, 438.92, 877.84, '2023-12-16 09:04:16', '2023-12-16 09:04:16'),
(47, 33, 39, NULL, 'Juego de Balatas Delanteras', '0001', 'refacciones', 1, 1290.00, 1290.00, '2023-12-16 09:04:16', '2023-12-16 09:04:16'),
(48, 33, 40, NULL, 'Juego de Zapatas Traseras', '0002', 'refacciones', 1, 950.00, 950.00, '2023-12-16 09:04:16', '2023-12-16 09:04:16'),
(49, 33, 34, NULL, 'Llanta de Carga', '25172504', 'refacciones', 4, 2100.00, 8400.00, '2023-12-16 09:04:16', '2023-12-16 09:04:16'),
(50, 33, NULL, 3, 'Lavado y Desengrasado de Motor', 'MO-03', 'mano de obra', 1, 200.00, 200.00, '2023-12-16 09:04:16', '2023-12-16 09:04:16'),
(51, 33, NULL, 6, 'Limpieza de Inyectores con Boya', 'MO-06', 'mano de obra', 1, 119.00, 119.00, '2023-12-16 09:04:16', '2023-12-16 09:04:16'),
(52, 33, NULL, 11, 'Alineación y Balanceo (p. Montado de Llantas)', 'MT-11', 'mano de obra', 1, 946.98, 946.98, '2023-12-16 09:04:16', '2023-12-16 09:04:16'),
(53, 33, NULL, 15, 'Mano de Obra Frenos', 'MO-15', 'mano de obra', 1, 1190.00, 1190.00, '2023-12-16 09:04:16', '2023-12-16 09:04:16'),
(54, 33, NULL, 14, 'Relleno Liquido de Frenos', 'MO-14', 'mano de obra', 1, 240.00, 240.00, '2023-12-16 09:04:16', '2023-12-16 09:04:16'),
(55, 33, NULL, 12, 'Rectificado de Discos', 'MO-12', 'mano de obra', 1, 400.00, 400.00, '2023-12-16 09:04:16', '2023-12-16 09:04:16'),
(56, 33, NULL, 13, 'Rectificado de Tambores', 'MO-13', 'mano de obra', 1, 400.00, 400.00, '2023-12-16 09:04:16', '2023-12-16 09:04:16'),
(57, 33, NULL, 1, 'Mano de Obra', 'MO-01', 'mano de obra', 6, 500.00, 3000.00, '2023-12-16 09:04:16', '2023-12-16 09:04:16'),
(58, 33, NULL, 5, 'Lavado y Protector de Batería', 'MO-05', 'mano de obra', 1, 30.00, 30.00, '2023-12-16 10:49:39', '2023-12-16 10:49:39'),
(62, 35, 31, NULL, 'Filtro de Aceite', 'C-1828', 'refacciones', 1, 75.00, 75.00, '2023-12-18 16:28:54', '2023-12-18 16:28:54'),
(63, 35, 32, NULL, 'Filtro de Combustible Primario', 'BF825', 'refacciones', 1, 83.00, 83.00, '2023-12-18 16:28:54', '2023-12-18 16:28:54'),
(64, 35, 33, NULL, 'Filtro Separador de Agua', 'FS1000', 'refacciones', 1, 282.47, 282.47, '2023-12-18 16:28:54', '2023-12-18 16:28:54'),
(67, 41, 28, NULL, 'Filtro de Aceite', 'B7322', 'refacciones', 1, 298.00, 298.00, '2024-01-08 13:02:54', '2024-01-08 13:02:54'),
(68, 41, 29, NULL, 'Filtro de Combustible Primario', 'BF46100-O', 'refacciones', 1, 1687.31, 1687.31, '2024-01-08 13:02:54', '2024-01-08 13:02:54'),
(69, 41, 30, NULL, 'Filtro de Combustible Secundario', 'BF7674-D', 'refacciones', 1, 432.10, 432.10, '2024-01-08 13:02:54', '2024-01-08 13:02:54'),
(70, 41, NULL, 1, 'Mano de Obra', 'MO-01', 'mano de obra', 3, 500.00, 1500.00, '2024-01-08 13:02:54', '2024-01-08 16:25:42'),
(72, 41, 6, NULL, 'Aceite de Motor Diesel 25W-60', '123456', 'consumibles', 15, 57.69, 865.35, '2024-01-08 13:13:10', '2024-01-08 13:13:10'),
(73, 41, 18, NULL, 'Aceite de Transmisón Manual 80W-90', '227574', 'consumibles', 2, 133.02, 266.04, '2024-01-09 08:54:46', '2024-01-09 08:54:46'),
(74, 40, 9, NULL, 'Filtro de Aceite', '188610', 'refacciones', 1, 80.10, 80.10, '2024-01-10 09:27:04', '2024-01-10 09:27:04'),
(75, 40, 12, NULL, 'Filtro de Aire', '862131', 'refacciones', 1, 271.20, 271.20, '2024-01-10 09:27:04', '2024-01-10 09:27:04'),
(76, 40, 19, NULL, 'Aceite de Motor 20W-50', '526626', 'consumibles', 6, 159.19, 955.14, '2024-01-10 09:27:04', '2024-01-10 09:27:04'),
(77, 40, NULL, 3, 'Lavado y Desengrasado de Motor', 'MO-03', 'mano de obra', 1, 200.00, 200.00, '2024-01-10 09:27:04', '2024-01-10 09:27:04'),
(78, 40, NULL, 1, 'Mano de Obra', 'MO-01', 'mano de obra', 2, 500.00, 1000.00, '2024-01-10 09:27:04', '2024-01-10 09:27:04'),
(79, 40, NULL, 5, 'Lavado y Protector de Batería', 'MO-05', 'mano de obra', 1, 30.00, 30.00, '2024-01-10 09:30:38', '2024-01-10 09:30:38'),
(80, 43, 28, NULL, 'Filtro de Aceite', 'B7322', 'refacciones', 1, 298.00, 298.00, '2024-01-10 16:37:24', '2024-01-10 16:37:24'),
(81, 43, 29, NULL, 'Filtro de Combustible Primario', 'BF46100-O', 'refacciones', 1, 1687.31, 1687.31, '2024-01-10 16:37:24', '2024-01-10 16:37:24'),
(82, 43, 30, NULL, 'Filtro de Combustible Secundario', 'BF7674-D', 'refacciones', 1, 432.10, 432.10, '2024-01-10 16:37:24', '2024-01-10 16:37:24'),
(83, 43, 6, NULL, 'Aceite de Motor Diesel 25W-60', '123456', 'consumibles', 15, 57.69, 865.35, '2024-01-10 16:37:24', '2024-01-10 16:37:24'),
(84, 43, NULL, 1, 'Mano de Obra', 'MO-01', 'mano de obra', 3, 500.00, 1500.00, '2024-01-10 16:37:24', '2024-01-10 16:37:24'),
(85, 42, 9, NULL, 'Filtro de Aceite', '188610', 'refacciones', 1, 80.10, 80.10, '2024-01-12 08:28:13', '2024-01-12 08:28:13'),
(86, 42, 12, NULL, 'Filtro de Aire', '862131', 'refacciones', 1, 271.20, 271.20, '2024-01-12 08:28:13', '2024-01-12 08:28:13'),
(87, 42, 16, NULL, 'Bujía Doble Platino', '938524', 'refacciones', 4, 77.40, 309.60, '2024-01-12 08:28:13', '2024-01-12 08:28:13'),
(88, 42, 11, NULL, 'Filtro de Gasolina', '781640', 'refacciones', 1, 269.10, 269.10, '2024-01-12 08:30:46', '2024-01-12 08:30:46'),
(89, 42, 19, NULL, 'Aceite de Motor 20W-50', '526626', 'consumibles', 6, 159.19, 955.14, '2024-01-12 08:30:46', '2024-01-12 08:30:46'),
(90, 42, NULL, 16, 'Balatas y Zapatas Frenos Únicos', 'MO-16', 'mano de obra', 1, 2725.00, 2725.00, '2024-01-12 09:46:41', '2024-01-12 09:46:41'),
(91, 42, NULL, 12, 'Rectificado de Discos', 'MO-12', 'mano de obra', 1, 460.00, 460.00, '2024-01-12 09:46:41', '2024-01-12 09:46:41'),
(92, 42, NULL, 13, 'Rectificado de Tambores', 'MO-13', 'mano de obra', 1, 460.00, 460.00, '2024-01-12 09:46:41', '2024-01-12 09:46:41'),
(93, 42, NULL, 15, 'Mano de Obra Frenos', 'MO-15', 'mano de obra', 1, 1368.50, 1368.50, '2024-01-12 09:46:41', '2024-01-12 09:46:41'),
(94, 42, NULL, 1, 'Mano de Obra', 'MO-01', 'mano de obra', 4, 500.00, 2000.00, '2024-01-12 09:47:08', '2024-01-12 09:47:08'),
(95, 42, NULL, 3, 'Lavado y Desengrasado de Motor', 'MO-03', 'mano de obra', 1, 200.00, 200.00, '2024-01-12 09:47:46', '2024-01-12 09:47:46'),
(96, 42, NULL, 5, 'Lavado y Protector de Batería', 'MO-05', 'mano de obra', 1, 30.00, 30.00, '2024-01-12 09:47:46', '2024-01-12 09:47:46'),
(97, 42, NULL, 14, 'Relleno Liquido de Frenos', 'MO-14', 'mano de obra', 1, 241.50, 241.50, '2024-01-12 09:48:48', '2024-01-12 09:48:48'),
(98, 42, 83, NULL, 'Foco Halógeno H4', '1970000', 'refacciones', 1, 249.00, 249.00, '2024-01-12 13:54:19', '2024-01-12 13:54:19'),
(99, 44, 79, NULL, 'Filtro de Aceite', 'EO-2623', 'refacciones', 1, 236.00, 236.00, '2024-01-13 10:32:51', '2024-01-13 10:32:51'),
(100, 44, 80, NULL, 'Filtro de Aire de Motor', '2EO-129-62', 'refacciones', 1, 342.00, 342.00, '2024-01-13 10:32:51', '2024-01-13 10:32:51'),
(101, 44, 81, NULL, 'Filtro de Combustible', 'EGI-349', 'refacciones', 1, 1285.00, 1285.00, '2024-01-13 10:32:51', '2024-01-13 10:32:51'),
(102, 44, 82, NULL, 'Filtro de Cabina', 'FC-10436', 'refacciones', 1, 355.00, 355.00, '2024-01-13 10:32:51', '2024-01-13 10:32:51'),
(103, 44, 6, NULL, 'Aceite de Motor Diesel 25W-60', '123456', 'consumibles', 12, 57.69, 692.28, '2024-01-13 13:09:41', '2024-01-15 09:01:37'),
(104, 44, 84, NULL, 'Anticongelante', '12345', 'consumibles', 1, 14.28, 14.28, '2024-01-15 09:06:47', '2024-01-15 09:06:47'),
(105, 44, NULL, 1, 'Mano de Obra', 'MO-01', 'mano de obra', 3, 500.00, 1500.00, '2024-01-15 09:06:47', '2024-01-15 09:06:47'),
(106, 44, NULL, 3, 'Lavado y Desengrasado de Motor', 'MO-03', 'mano de obra', 1, 200.00, 200.00, '2024-01-15 09:06:47', '2024-01-15 09:06:47'),
(107, 44, NULL, 5, 'Lavado y Protector de Batería', 'MO-05', 'mano de obra', 1, 30.00, 30.00, '2024-01-15 09:06:47', '2024-01-15 09:06:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE IF NOT EXISTS `grupo` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `comentario` text,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id`, `nombre`, `comentario`, `activo`, `created_at`, `updated_at`, `imagen`) VALUES
(17, 'Equipo de Seguridad del Vehículo', 'Funcionalidad del sistema de seguridad del equipo', 1, '2023-11-30 12:14:53', '2023-12-20 16:45:41', 'imagenGrupo17_1703112341.png'),
(18, 'Revisión del Estado de las Llantas Tractocamiones Tres Ejes', 'Revisión del estado de las llantas.', 1, '2023-12-01 09:48:22', '2023-12-20 16:39:17', 'imagenGrupo18_1703111957.png'),
(19, 'Revisión de Niveles Tractocamiones', 'Revisión de Niveles para Tractocamiones', 1, '2023-12-01 10:44:41', '2023-12-20 16:37:20', 'imagenGrupo19_1703111840.png'),
(20, 'Revisión de Baterías Tractocamiones', 'Revisión del estado de las baterías de los tractocamiones', 1, '2023-12-01 10:46:25', '2023-12-20 16:30:48', 'imagenGrupo20_1703111448.png'),
(21, 'Revisión de Partes de Motor', 'Revisión de partes de motor', 1, '2023-12-01 11:26:35', '2023-12-20 16:30:32', 'imagenGrupo21_1703111432.png'),
(22, 'Revisión de Parabrisas y Espejos', 'Revisión de parabrisas y espejos', 1, '2023-12-01 11:27:38', '2023-12-20 16:23:54', 'imagenGrupo22_1703111034.png'),
(23, 'Revisión de Fugas', 'Revisión de fugas en los sistemas', 1, '2023-12-01 11:28:19', '2023-12-20 16:26:15', 'imagenGrupo23_1703111175.png'),
(24, 'Revisión del Estado de las Llantas Tractocamiones Dos Ejes', 'Revisión del estado de las llantas de tractocamiones de dos ejes', 1, '2023-12-01 11:40:05', '2023-12-20 16:24:45', 'imagenGrupo24_1703111085.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupoBitacoras`
--

DROP TABLE IF EXISTS `grupoBitacoras`;
CREATE TABLE IF NOT EXISTS `grupoBitacoras` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bitacoraId` bigint(20) UNSIGNED NOT NULL,
  `grupoId` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_grupoBitacora_bitacora` (`bitacoraId`),
  KEY `FK_grupoBitacora_tarea` (`grupoId`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupoBitacoras`
--

INSERT INTO `grupoBitacoras` (`id`, `bitacoraId`, `grupoId`, `created_at`, `updated_at`) VALUES
(17, 6, 17, '2023-11-30 12:17:48', '2023-11-30 12:17:48'),
(18, 6, 18, '2023-12-01 09:51:10', '2023-12-01 09:51:10'),
(19, 6, 20, '2023-12-01 10:47:27', '2023-12-01 10:47:27'),
(20, 6, 19, '2023-12-01 10:48:05', '2023-12-01 10:48:05'),
(21, 6, 23, '2023-12-01 11:29:52', '2023-12-01 11:29:52'),
(22, 6, 21, '2023-12-01 11:29:52', '2023-12-01 11:29:52'),
(23, 6, 22, '2023-12-01 11:29:52', '2023-12-01 11:29:52'),
(24, 7, 17, '2023-12-01 11:44:01', '2023-12-01 11:44:01'),
(25, 7, 24, '2023-12-01 11:44:01', '2023-12-01 11:44:01'),
(26, 7, 19, '2023-12-01 11:44:01', '2023-12-01 11:44:01'),
(27, 7, 23, '2023-12-01 11:44:01', '2023-12-01 11:44:01'),
(28, 7, 21, '2023-12-01 11:44:01', '2023-12-01 11:44:01'),
(29, 7, 20, '2023-12-01 11:44:01', '2023-12-01 11:44:01'),
(30, 7, 22, '2023-12-01 11:44:01', '2023-12-01 11:44:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupoTareas`
--

DROP TABLE IF EXISTS `grupoTareas`;
CREATE TABLE IF NOT EXISTS `grupoTareas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `grupoId` bigint(20) UNSIGNED NOT NULL,
  `tareaId` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_grupo_grupo` (`grupoId`),
  KEY `FK_grupo_tarea` (`tareaId`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupoTareas`
--

INSERT INTO `grupoTareas` (`id`, `grupoId`, `tareaId`, `created_at`, `updated_at`) VALUES
(124, 17, 112, '2023-11-30 12:16:37', '2023-11-30 12:16:37'),
(125, 17, 113, '2023-11-30 12:43:27', '2023-11-30 12:43:27'),
(126, 17, 114, '2023-11-30 12:43:27', '2023-11-30 12:43:27'),
(127, 17, 115, '2023-11-30 12:43:27', '2023-11-30 12:43:27'),
(128, 17, 117, '2023-11-30 12:43:27', '2023-11-30 12:43:27'),
(129, 17, 116, '2023-11-30 12:43:27', '2023-11-30 12:43:27'),
(130, 18, 118, '2023-12-01 09:49:32', '2023-12-01 09:49:32'),
(131, 18, 121, '2023-12-01 09:49:32', '2023-12-01 09:49:32'),
(132, 18, 119, '2023-12-01 09:49:32', '2023-12-01 09:49:32'),
(133, 18, 122, '2023-12-01 09:49:32', '2023-12-01 09:49:32'),
(134, 18, 120, '2023-12-01 09:49:32', '2023-12-01 09:49:32'),
(135, 18, 123, '2023-12-01 09:49:32', '2023-12-01 09:49:32'),
(136, 18, 124, '2023-12-01 10:44:10', '2023-12-01 10:44:10'),
(137, 18, 125, '2023-12-01 10:44:10', '2023-12-01 10:44:10'),
(138, 18, 126, '2023-12-01 10:44:10', '2023-12-01 10:44:10'),
(139, 19, 127, '2023-12-01 10:45:24', '2023-12-01 10:45:24'),
(140, 19, 128, '2023-12-01 10:45:24', '2023-12-01 10:45:24'),
(141, 19, 129, '2023-12-01 10:45:24', '2023-12-01 10:45:24'),
(142, 19, 130, '2023-12-01 10:45:24', '2023-12-01 10:45:24'),
(143, 19, 131, '2023-12-01 10:45:24', '2023-12-01 10:45:24'),
(144, 19, 132, '2023-12-01 10:45:24', '2023-12-01 10:45:24'),
(145, 19, 133, '2023-12-01 10:45:24', '2023-12-01 10:45:24'),
(146, 19, 134, '2023-12-01 10:45:24', '2023-12-01 10:45:24'),
(147, 20, 135, '2023-12-01 10:46:39', '2023-12-01 10:46:39'),
(148, 20, 136, '2023-12-01 10:46:39', '2023-12-01 10:46:39'),
(149, 20, 137, '2023-12-01 10:46:39', '2023-12-01 10:46:39'),
(150, 21, 142, '2023-12-01 11:27:15', '2023-12-01 11:27:15'),
(151, 21, 143, '2023-12-01 11:27:15', '2023-12-01 11:27:15'),
(152, 21, 144, '2023-12-01 11:27:15', '2023-12-01 11:27:15'),
(153, 22, 145, '2023-12-01 11:27:56', '2023-12-01 11:27:56'),
(154, 22, 147, '2023-12-01 11:27:56', '2023-12-01 11:27:56'),
(155, 22, 146, '2023-12-01 11:27:56', '2023-12-01 11:27:56'),
(156, 23, 138, '2023-12-01 11:28:35', '2023-12-01 11:28:35'),
(157, 23, 139, '2023-12-01 11:28:35', '2023-12-01 11:28:35'),
(158, 23, 140, '2023-12-01 11:28:35', '2023-12-01 11:28:35'),
(159, 23, 141, '2023-12-01 11:28:35', '2023-12-01 11:28:35'),
(160, 24, 118, '2023-12-01 11:41:24', '2023-12-01 11:41:24'),
(161, 24, 121, '2023-12-01 11:41:24', '2023-12-01 11:41:24'),
(162, 24, 124, '2023-12-01 11:41:24', '2023-12-01 11:41:24'),
(163, 24, 119, '2023-12-01 11:41:24', '2023-12-01 11:41:24'),
(164, 24, 122, '2023-12-01 11:41:24', '2023-12-01 11:41:24'),
(165, 24, 125, '2023-12-01 11:41:24', '2023-12-01 11:41:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialServicios`
--

DROP TABLE IF EXISTS `historialServicios`;
CREATE TABLE IF NOT EXISTS `historialServicios` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `solicitudId` bigint(20) UNSIGNED NOT NULL,
  `servicioId` bigint(20) UNSIGNED NOT NULL,
  `estadoId` bigint(20) UNSIGNED NOT NULL,
  `comentario` float(10,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_historialServicios_solicitudId` (`solicitudId`),
  KEY `FK_historialServicios_servicioId` (`servicioId`),
  KEY `FK_historialServicios_estadoId` (`estadoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historicoMaquinaria`
--

DROP TABLE IF EXISTS `historicoMaquinaria`;
CREATE TABLE IF NOT EXISTS `historicoMaquinaria` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `maquinariaId` bigint(20) UNSIGNED NOT NULL,
  `origenId` bigint(20) UNSIGNED NOT NULL,
  `destinoId` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_historicoMaquinaria_maquinaria` (`maquinariaId`),
  KEY `FK_historicoMaquinaria_obraOrigen` (`origenId`),
  KEY `FK_historicoMaquinaria_obraDestino` (`destinoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invconsu`
--

DROP TABLE IF EXISTS `invconsu`;
CREATE TABLE IF NOT EXISTS `invconsu` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `productoId` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `cantidad` float(10,2) NOT NULL,
  `desde` bigint(20) UNSIGNED NOT NULL,
  `hasta` bigint(20) UNSIGNED NOT NULL,
  `comentarios` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_invconsu_producto` (`productoId`),
  KEY `FK_invconsu_desde` (`desde`),
  KEY `FK_invconsu_hasta` (`hasta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

DROP TABLE IF EXISTS `inventario`;
CREATE TABLE IF NOT EXISTS `inventario` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `numparte` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `marcaId` bigint(20) UNSIGNED NOT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `proveedorId` bigint(20) UNSIGNED NOT NULL,
  `cantidad` float(10,2) DEFAULT NULL,
  `reorden` float(10,2) DEFAULT NULL,
  `maximo` float(10,2) DEFAULT NULL,
  `valor` float(10,2) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `uniformeTipoId` bigint(20) UNSIGNED DEFAULT NULL,
  `uniformeTalla` varchar(16) DEFAULT NULL,
  `uniformeRetornable` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `estatusId` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_inventario_tipouniforme` (`uniformeTipoId`),
  KEY `FK_inventario_marca` (`marcaId`),
  KEY `FK_inventario_proveedor` (`proveedorId`),
  KEY `FK_inventario_inventarioEstatusId` (`estatusId`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `numparte`, `nombre`, `marcaId`, `modelo`, `proveedorId`, `cantidad`, `reorden`, `maximo`, `valor`, `imagen`, `tipo`, `uniformeTipoId`, `uniformeTalla`, `uniformeRetornable`, `created_at`, `updated_at`, `estatusId`) VALUES
(1, '455', 'Desarmador', 7, '8600', 1, 5.00, 2.00, 5.00, 56.00, '1696205603_imagen.png', 'herramientas', NULL, NULL, NULL, '2023-09-13 17:11:38', '2023-10-01 18:14:23', 1),
(2, '0001', 'Test', 1, '0001', 1, 6.00, 1.00, 1.00, 100.00, '1701457569_imagen.avif', 'refacciones', NULL, NULL, NULL, '2023-09-13 17:17:56', '2023-12-12 08:44:41', 1),
(3, '1', 'Test', 23, 'Ejecutiva', 2, 0.00, 3.00, 10.00, 350.00, '1696206020_imagen.jpg', 'uniformes', 17, 'S', 0, '2023-09-21 15:39:21', '2023-12-21 09:14:10', 1),
(4, '0010', 'Aceite Pruebas', 23, 'S/M', 2, 0.00, 10.00, 100.00, 35.00, '1696205941_imagen.jpg', 'consumibles', NULL, NULL, NULL, '2023-09-24 16:18:34', '2024-01-12 10:11:12', 1),
(5, '125012', 'Aceite de Motor', 1, '20W-50', 2, 0.00, 5.00, 20.00, 899.00, NULL, 'consumibles', NULL, NULL, NULL, '2023-10-03 09:33:56', '2024-01-12 10:11:27', 1),
(6, '123456', 'Aceite de Motor Diesel 25W-60', 38, '25W-60', 2, 166.00, 100.00, 516.00, 57.69, NULL, 'consumibles', NULL, NULL, NULL, '2023-10-03 09:37:41', '2024-01-15 09:07:04', 1),
(7, '0001', 'Kit de Clutch Nissan NP300 2018', 4, '0002', 3, 0.00, 1.00, 1.00, 2900.00, '1701457517_imagen.jpg', 'refacciones', NULL, NULL, NULL, '2023-12-01 13:05:17', '2023-12-16 08:21:05', 1),
(8, '0001', 'Aceite de Transmisión 75w-80', 36, '75w-80', 4, 6.00, 5.00, 10.00, 160.00, NULL, 'consumibles', NULL, NULL, NULL, '2023-12-01 18:09:35', '2023-12-12 17:46:04', 1),
(9, '188610', 'Filtro de Aceite', 37, 'PH3614', 4, 1.00, 1.00, 10.00, 80.10, '1702424318_imagen.png', 'refacciones', NULL, NULL, NULL, '2023-12-02 10:56:51', '2024-01-12 17:21:23', 1),
(10, '256750', 'Bujía Doble Iridio', 39, '9613', 4, 0.00, 4.00, 12.00, 166.50, '1702424435_imagen.png', 'refacciones', NULL, NULL, NULL, '2023-12-02 10:56:51', '2023-12-12 17:40:35', 1),
(11, '781640', 'Filtro de Gasolina', 37, 'G10174', 4, 1.00, 1.00, 4.00, 269.10, '1702424375_imagen.png', 'refacciones', NULL, NULL, NULL, '2023-12-02 10:56:51', '2024-01-12 17:21:23', 1),
(12, '862131', 'Filtro de Aire', 37, 'CA9916', 4, 0.00, 1.00, 4.00, 271.20, '1702424386_imagen.jpg', 'refacciones', NULL, NULL, NULL, '2023-12-02 10:56:51', '2024-01-12 17:21:23', 1),
(13, '448149', 'Filtro de Cabina', 37, 'CF10285', 4, 0.00, 1.00, 4.00, 289.00, '1702424493_imagen.png', 'refacciones', NULL, NULL, NULL, '2023-12-02 10:56:51', '2023-12-12 17:41:33', 1),
(14, '1009329', 'Filtro de Aire', 37, 'CA12055', 4, 0.00, 1.00, 4.00, 271.73, '1702424465_imagen.png', 'refacciones', NULL, NULL, NULL, '2023-12-02 10:56:51', '2023-12-12 17:41:05', 1),
(15, '526624', 'Aceite Sintético 14W-40', 38, '14W-40', 4, 1.00, 1.00, 10.00, 166.50, '1702424744_imagen.png', 'consumibles', NULL, NULL, NULL, '2023-12-02 10:58:49', '2023-12-12 17:45:44', 1),
(16, '938524', 'Bujía Doble Platino', 41, 'APP5325', 4, 0.00, 4.00, 10.00, 77.40, '1702424335_imagen.png', 'refacciones', NULL, NULL, NULL, '2023-12-12 17:20:03', '2024-01-12 17:21:23', 1),
(17, '1055826', 'Kit de Clutch', 40, '625309000', 4, 0.00, 1.00, 1.00, 3959.10, '1702424365_imagen.png', 'refacciones', NULL, NULL, NULL, '2023-12-12 17:21:30', '2023-12-16 10:50:37', 1),
(18, '227574', 'Aceite de Transmisón Manual 80W-90', 36, '1526159', 4, -2.00, 1.00, 10.00, 133.02, '1702424648_imagen.avif', 'consumibles', NULL, NULL, NULL, '2023-12-12 17:24:42', '2024-01-09 08:54:47', 1),
(19, '526626', 'Aceite de Motor 20W-50', 38, '125013', 4, 6.00, 1.00, 10.00, 159.19, '1702424576_imagen.png', 'consumibles', NULL, NULL, NULL, '2023-12-12 17:27:57', '2024-01-12 17:21:23', 1),
(20, '538514', 'Amortiguador Delantero', 42, 'G51894', 4, 0.00, 2.00, 4.00, 999.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-13 08:33:03', '2023-12-16 08:21:28', 1),
(21, '538477', 'Amortiguador Trasero', 42, 'G64057', 4, 0.00, 2.00, 4.00, 599.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-13 08:37:12', '2023-12-16 08:21:57', 1),
(22, '887808', 'Juego de Balatas Delanteras', 42, 'DG976', 4, 0.00, 1.00, 2.00, 629.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-13 08:37:12', '2023-12-16 08:21:51', 1),
(23, '199324', 'Juego de Zapatas Traseras', 42, '709', 4, 0.00, 1.00, 2.00, 519.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-13 08:37:12', '2023-12-16 08:21:41', 1),
(24, '0002', 'Llanta de Carga', 43, '235/75-15', 4, 0.00, 4.00, 8.00, 2100.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-13 08:38:56', '2023-12-16 08:24:53', 1),
(25, '154073', 'Soporte de Motor', 42, 'F-A4208', 4, 0.00, 2.00, 4.00, 449.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-13 08:54:11', '2023-12-18 10:35:42', 1),
(26, '321567', 'Empaque de Tapa de Punterías', 42, 'VK95360R', 4, 0.00, 1.00, 2.00, 229.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-13 08:55:23', '2023-12-16 08:20:55', 1),
(27, '489523', 'Empaque de Tapa de Punterias', 44, 'PS-31310', 4, 0.00, 1.00, 2.00, 669.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-13 09:17:20', '2023-12-18 10:35:22', 1),
(28, 'B7322', 'Filtro de Aceite', 45, 'B7322', 2, 0.00, 1.00, 4.00, 298.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-13 11:25:15', '2024-01-10 16:37:45', 1),
(29, 'BF46100-O', 'Filtro de Combustible Primario', 45, 'BF46100-O', 2, 0.00, 1.00, 4.00, 1687.31, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-13 11:25:15', '2024-01-10 16:37:45', 1),
(30, 'BF7674-D', 'Filtro de Combustible Secundario', 45, 'BF7674-D', 2, 0.00, 1.00, 4.00, 432.10, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-13 11:25:15', '2024-01-10 16:37:45', 1),
(31, 'C-1828', 'Filtro de Aceite', 47, 'C-1828', 2, 1.00, 1.00, 4.00, 75.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-13 11:25:15', '2023-12-18 16:28:54', 1),
(32, 'BF825', 'Filtro de Combustible Primario', 45, 'BF825', 2, 1.00, 1.00, 4.00, 83.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-13 11:25:15', '2023-12-18 16:28:54', 1),
(33, 'FS1000', 'Filtro Separador de Agua', 46, 'FS1000', 2, 1.00, 1.00, 4.00, 282.47, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-13 11:25:15', '2024-01-09 08:52:27', 1),
(34, '25172504', 'Llanta de Carga', 43, '235/75R15', 8, 0.00, 1.00, 4.00, 2100.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-16 08:26:54', '2023-12-16 10:50:37', 1),
(35, 'EPU00444', 'Empaque de Tapa de Punterías', 44, 'PS-31310', 6, 0.00, 1.00, 2.00, 536.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-16 08:36:17', '2023-12-18 10:35:17', 1),
(36, '7000968', 'Amortiguador Delantero Izquierdo', 49, '7000968', 7, 0.00, 1.00, 2.00, 989.48, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-16 08:38:21', '2023-12-16 10:50:37', 1),
(37, '7000969', 'Amortiguador Delantero Derecho', 49, '7000969', 7, 0.00, 1.00, 2.00, 989.48, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-16 08:40:18', '2023-12-16 10:50:37', 1),
(38, '170821', 'Amortiguador Trasero', 48, '170821', 5, 0.00, 1.00, 4.00, 438.92, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-16 08:40:18', '2023-12-16 10:50:37', 1),
(39, '0001', 'Juego de Balatas Delanteras', 50, '0001', 9, 0.00, 1.00, 2.00, 1290.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-16 08:49:20', '2023-12-16 10:50:37', 1),
(40, '0002', 'Juego de Zapatas Traseras', 50, '0002', 9, 0.00, 1.00, 2.00, 950.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-16 08:49:20', '2023-12-16 10:50:37', 1),
(41, 'CH01A', 'Chaleco XXL Gris', 35, 'N/A', 12, 2.00, 1.00, 5.00, 0.50, NULL, 'uniformes', 1, 'XXL', 0, '2023-12-21 09:25:53', '2023-12-21 09:28:21', 1),
(42, 'CH01B', 'Chaleco XXL Naranja', 35, 'N/A', 12, 2.00, 1.00, 5.00, 0.50, NULL, 'uniformes', 2, 'XXL', 0, '2023-12-21 09:27:58', '2023-12-21 09:28:41', 1),
(43, 'CAM01A', 'Camisa XXL Gris', 51, 'N/A', 13, 7.00, 2.00, 10.00, 0.14, NULL, 'uniformes', 18, 'XXL', 0, '2023-12-21 09:32:50', '2023-12-21 09:41:15', 1),
(44, 'CAM01B', 'Camisola XXL', 52, 'N/A', 11, 2.00, 1.00, 5.00, 0.50, NULL, 'uniformes', 9, 'XXL', 0, '2023-12-21 09:38:00', '2023-12-21 09:40:14', 1),
(45, 'CH02A', 'Chaleco XL Gris', 35, 'N/A', 12, 5.00, 1.00, 10.00, 0.17, NULL, 'uniformes', 1, 'XL', 0, '2023-12-21 09:38:00', '2024-01-03 11:38:28', 1),
(46, 'CH02B', 'Chaleco XL Naranja', 35, 'N/A', 12, 5.00, 1.00, 10.00, 0.20, NULL, 'uniformes', 2, 'XL', 0, '2023-12-21 09:38:00', '2023-12-21 09:40:37', 1),
(47, 'CAM02A', 'Camisa XL Gris', 51, 'N/A', 13, 8.00, 2.00, 10.00, 0.12, NULL, 'uniformes', 18, 'XL', 0, '2023-12-21 09:38:00', '2023-12-21 09:40:47', 1),
(48, 'CAM02B', 'Camisola XL', 52, 'N/A', 11, 2.00, 1.00, 2.00, 0.50, NULL, 'uniformes', 9, 'XL', 0, '2023-12-21 09:38:00', '2023-12-21 09:40:59', 1),
(49, 'CH03A', 'Chaleco L Gris', 35, 'N/A', 12, 16.00, 2.00, 20.00, 0.06, NULL, 'uniformes', 1, 'L', 0, '2023-12-21 09:46:29', '2023-12-21 09:47:28', 1),
(50, 'CH03B', 'Chaleco L Naranja', 35, 'N/A', 12, 3.00, 1.00, 5.00, 0.33, NULL, 'uniformes', 2, 'L', 0, '2023-12-21 09:46:29', '2023-12-21 09:47:08', 1),
(51, 'CAM03A', 'Camisa L Gris', 51, 'N/A', 13, 5.00, 2.00, 10.00, 0.14, NULL, 'uniformes', 18, 'L', 0, '2023-12-21 09:46:29', '2024-01-03 11:38:29', 1),
(52, 'CAM03B', 'Camisola L', 52, 'N/A', 11, 2.00, 1.00, 5.00, 0.50, NULL, 'uniformes', 9, 'L', 0, '2023-12-21 09:46:29', '2023-12-21 09:46:44', 1),
(53, 'CH04A', 'Chaleco M Gris', 35, 'N/A', 12, 10.00, 2.00, 15.00, 0.09, NULL, 'uniformes', 1, 'M', 0, '2023-12-21 09:53:26', '2024-01-04 10:25:43', 1),
(54, 'CH04B', 'Chaleco M Naranja', 35, 'N/A', 12, 2.00, 1.00, 5.00, 0.50, NULL, 'uniformes', 2, 'M', 0, '2023-12-21 09:53:26', '2023-12-21 09:53:59', 1),
(55, 'CAM04A', 'Camisa M Gris', 51, 'N/A', 13, 12.00, 2.00, 20.00, 0.08, NULL, 'uniformes', 18, 'M', 0, '2023-12-21 09:53:26', '2023-12-21 09:54:09', 1),
(56, 'CAM04B', 'Camisola M', 52, 'N/A', 11, 0.00, 1.00, 5.00, 1.00, NULL, 'uniformes', 9, 'M', 0, '2023-12-21 09:53:26', '2023-12-21 09:54:19', 1),
(57, 'CH05A', 'Chaleco S Gris', 35, 'N/A', 12, 2.00, 2.00, 10.00, 0.50, NULL, 'uniformes', 1, 'S', 0, '2023-12-21 10:03:28', '2023-12-21 10:04:11', 1),
(58, 'CH05B', 'Chaleco S Naranja', 35, 'N/A', 12, 5.00, 1.00, 5.00, 0.20, NULL, 'uniformes', 2, 'S', 0, '2023-12-21 10:03:28', '2023-12-21 10:03:55', 1),
(59, 'CAM05A', 'Camisa S Gris', 51, 'N/A', 13, 8.00, 2.00, 10.00, 0.12, NULL, 'uniformes', 18, 'S', 0, '2023-12-21 10:03:28', '2023-12-21 10:03:45', 1),
(60, 'CAM05B', 'Camisola S', 52, 'N/A', 11, 2.00, 1.00, 5.00, 0.50, NULL, 'uniformes', 9, 'S', 0, '2023-12-21 10:03:28', '2023-12-21 10:03:36', 1),
(61, 'LEN01', 'Lentes Claros', 54, 'AL-012-CL', 12, 25.00, 1.00, 10.00, 0.04, NULL, 'uniformes', 5, 'Unitalla', 0, '2023-12-21 10:09:13', '2024-01-03 11:38:28', 1),
(62, 'GUA01', 'Guantes de Nitrilo Talla 8 Amarillos', 55, 'SUK-811', 12, 45.00, 2.00, 50.00, 0.02, NULL, 'uniformes', 6, '8', 0, '2023-12-21 10:23:17', '2024-01-04 10:25:43', 1),
(63, 'GUA02', 'Guantes de Nitrilo Talla 9 Cafe', 35, 'N/A', 12, 11.00, 2.00, 50.00, 0.09, NULL, 'uniformes', 6, '9', 0, '2023-12-21 10:23:17', '2023-12-21 10:23:28', 1),
(64, 'GOR01', 'Gorra Q2CES', 53, 'N/A', 10, 102.00, 2.00, 100.00, 0.01, NULL, 'uniformes', 13, 'Unitalla', 0, '2023-12-21 10:26:50', '2023-12-21 10:27:04', 1),
(65, 'PAN01', 'Pantalon de Mezclilla 34', 52, 'N/A', 11, 2.00, 1.00, 4.00, 0.50, NULL, 'uniformes', 10, '34', 0, '2023-12-21 10:30:22', '2023-12-21 10:30:48', 1),
(66, 'PAN02', 'Pantalon de Mezclilla 36', 52, 'N/A', 11, 2.00, 1.00, 4.00, 0.50, NULL, 'uniformes', 10, '36', 0, '2023-12-21 10:30:22', '2023-12-21 10:30:39', 1),
(67, 'PAN03', 'Pantalon de Mezclilla 38', 52, 'N/A', 11, 1.00, 1.00, 4.00, 1.00, NULL, 'uniformes', 10, '38', 0, '2023-12-21 10:30:22', '2023-12-21 10:30:31', 1),
(68, 'LEN02', 'Lentes Oscuros', 54, 'N/A', 12, 4.00, 1.00, 50.00, 0.20, NULL, 'uniformes', 19, 'Unitalla', 0, '2023-12-26 13:13:08', '2024-01-04 10:25:43', 1),
(69, 'C1028', 'Filtro de Aceite', 47, 'C1028', 2, 2.00, 1.00, 4.00, 75.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-26 16:51:23', '2023-12-26 16:51:23', 1),
(70, 'BF7552', 'Filtro de Combustible', 45, 'BF7552', 2, 1.00, 1.00, 4.00, 220.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-26 16:51:23', '2023-12-27 08:29:27', 1),
(71, 'A8504', 'Filtro de Aire', 47, 'A8504', 2, 2.00, 1.00, 4.00, 175.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-26 16:51:23', '2023-12-26 16:51:23', 1),
(72, 'BT260-10', 'Filtro Hidráulico', 45, 'BT260-10', 2, 2.00, 1.00, 4.00, 205.18, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-26 16:51:23', '2023-12-26 16:51:23', 1),
(73, '119305', 'Filtro de Aceite', 17, '119305-35170', 14, 1.00, 1.00, 2.00, 75.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-26 17:04:35', '2023-12-26 17:04:35', 1),
(74, '119802', 'Filtro de Combustible', 17, '119802-55810', 14, 1.00, 1.00, 2.00, 220.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-26 17:04:35', '2023-12-26 17:04:35', 1),
(75, '119655', 'Filtro de Aire', 17, '119655-12560', 14, 1.00, 1.00, 2.00, 175.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-26 17:04:35', '2023-12-26 17:04:35', 1),
(76, 'C-SP08-12', 'Filtro Hidráulico', 57, 'C-SP08-12', 14, 1.00, 1.00, 2.00, 205.36, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-26 17:05:33', '2023-12-26 17:05:33', 1),
(77, 'FF1183', 'Filtro de Combustible', 58, 'FF1183', 2, 1.00, 1.00, 4.00, 220.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-12-27 08:31:06', '2023-12-27 08:31:06', 1),
(79, 'EO-2623', 'Filtro de Aceite', 47, 'EO-2623', 2, 0.00, 1.00, 4.00, 236.00, NULL, 'refacciones', NULL, NULL, NULL, '2024-01-12 10:03:25', '2024-01-15 09:07:04', NULL),
(80, '2EO-129-62', 'Filtro de Aire de Motor', 61, '2E0-129-620BMF', 2, 1.00, 1.00, 4.00, 342.00, NULL, 'refacciones', NULL, NULL, NULL, '2024-01-12 10:03:25', '2024-01-15 09:07:04', NULL),
(81, 'EGI-349', 'Filtro de Combustible', 60, 'EGI-349', 2, 1.00, 1.00, 4.00, 1285.00, NULL, 'refacciones', NULL, NULL, NULL, '2024-01-12 10:03:25', '2024-01-15 09:07:04', NULL),
(82, 'FC-10436', 'Filtro de Cabina', 59, 'FC-10436', 2, 0.00, 1.00, 4.00, 355.00, NULL, 'refacciones', NULL, NULL, NULL, '2024-01-12 10:03:25', '2024-01-15 09:07:04', NULL),
(83, '1970000', 'Foco Halógeno H4', 62, 'H4', 15, 9.00, 1.00, 10.00, 249.00, NULL, 'refacciones', NULL, NULL, NULL, '2024-01-12 13:54:00', '2024-01-12 17:21:23', NULL),
(84, '12345', 'Anticongelante', 63, 'PEAK', 2, 207.00, 10.00, 516.00, 14.28, NULL, 'consumibles', NULL, NULL, NULL, '2024-01-15 09:05:45', '2024-01-15 09:07:04', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarioEstatus`
--

DROP TABLE IF EXISTS `inventarioEstatus`;
CREATE TABLE IF NOT EXISTS `inventarioEstatus` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `color` varchar(8) DEFAULT NULL,
  `comentario` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventarioEstatus`
--

INSERT INTO `inventarioEstatus` (`id`, `nombre`, `color`, `comentario`) VALUES
(1, 'Activo', 'green', 'Elemento de Inventario Activo'),
(2, 'Inactivo', 'darkcyan', 'Elemento de Inventario inactivo'),
(3, 'Baja', 'orange', 'Elemento de Inventario dado de baja'),
(4, 'Borrado', 'red', 'Elemento de Inventario borrado de forma definitiva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarioMovimientos`
--

DROP TABLE IF EXISTS `inventarioMovimientos`;
CREATE TABLE IF NOT EXISTS `inventarioMovimientos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `inventarioId` bigint(20) UNSIGNED NOT NULL,
  `usuarioId` bigint(20) UNSIGNED NOT NULL,
  `movimiento` int(4) NOT NULL,
  `cantidad` float(10,2) NOT NULL,
  `precioUnitario` float(10,2) NOT NULL,
  `total` float(10,2) NOT NULL,
  `mantenimientoId` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `comentario` text,
  PRIMARY KEY (`id`),
  KEY `FK_inventarioMovimiento_inventario` (`inventarioId`),
  KEY `FK_inventarioMovimiento_usuario` (`usuarioId`),
  KEY `FK_inventarioMovimiento_mantenimiento` (`mantenimientoId`)
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventarioMovimientos`
--

INSERT INTO `inventarioMovimientos` (`id`, `inventarioId`, `usuarioId`, `movimiento`, `cantidad`, `precioUnitario`, `total`, `mantenimientoId`, `created_at`, `updated_at`, `comentario`) VALUES
(1, 1, 1, 1, 5.00, 150.00, 750.00, NULL, '2023-09-13 17:11:38', '2023-09-13 17:11:38', NULL),
(2, 2, 1, 1, 55.00, 58.00, 3190.00, NULL, '2023-09-13 17:17:56', '2023-09-13 17:17:56', NULL),
(3, 3, 2, 1, 10.00, 350.00, 3500.00, NULL, '2023-09-21 15:39:21', '2023-09-21 15:39:21', NULL),
(4, 4, 2, 1, 100.00, 35.00, 3500.00, NULL, '2023-09-24 16:18:34', '2023-09-24 16:18:34', NULL),
(5, 1, 2, 1, 15.00, 75.00, 1125.00, NULL, '2023-10-01 18:13:51', '2023-10-01 18:13:51', NULL),
(6, 1, 2, 1, 15.00, 56.00, 840.00, NULL, '2023-10-01 18:14:23', '2023-10-01 18:14:23', NULL),
(7, 5, 3, 1, 5.00, 899.00, 4495.00, NULL, '2023-10-03 09:33:56', '2023-10-03 09:33:56', NULL),
(8, 6, 3, 1, 208.00, 12000.00, 2496000.00, NULL, '2023-10-03 09:37:41', '2023-10-03 09:37:41', NULL),
(9, 5, 7, 2, 1.00, 899.00, 899.00, 19, '2023-12-01 12:30:47', '2023-12-01 12:30:47', NULL),
(10, 4, 7, 2, 4.00, 35.00, 140.00, 21, '2023-12-01 12:50:44', '2023-12-01 12:50:44', NULL),
(11, 2, 3, 2, 54.00, 0.00, 0.00, NULL, '2023-12-01 13:03:18', '2023-12-01 13:03:18', NULL),
(12, 7, 3, 1, 1.00, 2900.00, 2900.00, NULL, '2023-12-01 13:05:17', '2023-12-01 13:05:17', NULL),
(13, 2, 7, 2, 5.00, 100.00, 500.00, 28, '2023-12-01 13:05:49', '2023-12-01 13:05:49', NULL),
(14, 5, 7, 2, 1.00, 899.00, 899.00, 19, '2023-12-01 13:09:31', '2023-12-01 13:09:31', NULL),
(15, 8, 3, 1, 5.00, 160.00, 800.00, NULL, '2023-12-01 18:09:35', '2023-12-01 18:09:35', NULL),
(16, 7, 3, 2, 1.00, 2900.00, 2900.00, 30, '2023-12-01 18:10:45', '2023-12-01 18:10:45', NULL),
(17, 8, 3, 2, 4.00, 160.00, 640.00, 30, '2023-12-01 18:10:45', '2023-12-01 18:10:45', NULL),
(18, 7, 3, 1, 1.00, 2900.00, 2900.00, NULL, '2023-12-01 18:14:17', '2023-12-01 18:14:17', NULL),
(19, 8, 3, 1, 5.00, 160.00, 800.00, NULL, '2023-12-01 18:14:37', '2023-12-01 18:14:37', NULL),
(20, 9, 3, 1, 1.00, 80.10, 80.10, NULL, '2023-12-02 10:56:51', '2023-12-02 10:56:51', NULL),
(21, 10, 3, 1, 4.00, 166.50, 666.00, NULL, '2023-12-02 10:56:51', '2023-12-02 10:56:51', NULL),
(22, 11, 3, 1, 1.00, 228.93, 228.93, NULL, '2023-12-02 10:56:51', '2023-12-02 10:56:51', NULL),
(23, 12, 3, 1, 1.00, 259.57, 259.57, NULL, '2023-12-02 10:56:51', '2023-12-02 10:56:51', NULL),
(24, 13, 3, 1, 1.00, 289.00, 289.00, NULL, '2023-12-02 10:56:51', '2023-12-02 10:56:51', NULL),
(25, 14, 3, 1, 1.00, 271.73, 271.73, NULL, '2023-12-02 10:56:51', '2023-12-02 10:56:51', NULL),
(26, 15, 3, 1, 6.00, 166.50, 999.00, NULL, '2023-12-02 10:58:49', '2023-12-02 10:58:49', NULL),
(27, 9, 3, 2, 1.00, 80.10, 80.10, 32, '2023-12-04 09:17:18', '2023-12-04 09:17:18', NULL),
(28, 14, 3, 2, 1.00, 271.73, 271.73, 32, '2023-12-04 09:17:18', '2023-12-04 09:17:18', NULL),
(29, 13, 3, 2, 1.00, 289.00, 289.00, 32, '2023-12-04 09:17:18', '2023-12-04 09:17:18', NULL),
(30, 11, 3, 2, 1.00, 228.93, 228.93, 32, '2023-12-04 09:17:18', '2023-12-04 09:17:18', NULL),
(31, 15, 3, 2, 5.00, 166.50, 832.50, 32, '2023-12-04 09:17:18', '2023-12-04 09:17:18', NULL),
(32, 10, 3, 2, 4.00, 166.50, 666.00, 32, '2023-12-04 09:17:18', '2023-12-04 09:17:18', NULL),
(33, 5, 3, 1, 1.00, 899.00, 899.00, NULL, '2023-12-12 08:41:49', '2023-12-12 08:41:49', 'Se elimino el mantenimiento Id->19, se regreso al inventario la cantidad de 1 unidad(es) del item Aceite 20W-50'),
(34, 5, 3, 1, 1.00, 899.00, 899.00, NULL, '2023-12-12 08:41:49', '2023-12-12 08:41:49', 'Se elimino el mantenimiento Id->19, se regreso al inventario la cantidad de 1 unidad(es) del item Aceite 20W-50'),
(35, 5, 3, 1, 1.00, 899.00, 899.00, NULL, '2023-12-12 08:42:06', '2023-12-12 08:42:06', 'Se elimino el mantenimiento Id->19, se regreso al inventario la cantidad de 1 unidad(es) del item Aceite 20W-50'),
(36, 5, 3, 1, 1.00, 899.00, 899.00, NULL, '2023-12-12 08:42:06', '2023-12-12 08:42:06', 'Se elimino el mantenimiento Id->19, se regreso al inventario la cantidad de 1 unidad(es) del item Aceite 20W-50'),
(37, 4, 3, 1, 4.00, 35.00, 140.00, NULL, '2023-12-12 08:44:14', '2023-12-12 08:44:14', 'Se elimino el mantenimiento Id->21, se regreso al inventario la cantidad de 4 unidad(es) del item Aceite Pruebas'),
(38, 7, 3, 1, 1.00, 2900.00, 2900.00, NULL, '2023-12-12 08:44:24', '2023-12-12 08:44:24', 'Se elimino el mantenimiento Id->30, se regreso al inventario la cantidad de 1 unidad(es) del item Kit de Clutch Nissan NP300 2018'),
(39, 8, 3, 1, 4.00, 160.00, 640.00, NULL, '2023-12-12 08:44:24', '2023-12-12 08:44:24', 'Se elimino el mantenimiento Id->30, se regreso al inventario la cantidad de 4 unidad(es) del item Aceite de Transmisión'),
(40, 7, 3, 2, 1.00, 2900.00, 2900.00, 31, '2023-12-12 08:44:33', '2023-12-12 08:44:33', NULL),
(41, 8, 3, 2, 4.00, 160.00, 640.00, 31, '2023-12-12 08:44:33', '2023-12-12 08:44:33', NULL),
(42, 2, 3, 1, 5.00, 100.00, 500.00, NULL, '2023-12-12 08:44:41', '2023-12-12 08:44:41', 'Se elimino el mantenimiento Id->28, se regreso al inventario la cantidad de 5 unidad(es) del item Test'),
(43, 9, 3, 1, 1.00, 80.00, 80.00, NULL, '2023-12-12 17:08:38', '2023-12-12 17:08:38', NULL),
(44, 11, 3, 2, 1.00, 0.00, 0.00, NULL, '2023-12-12 17:09:17', '2023-12-12 17:09:17', NULL),
(45, 11, 3, 1, 2.00, 269.10, 538.20, NULL, '2023-12-12 17:09:43', '2023-12-12 17:09:43', NULL),
(46, 9, 3, 1, 1.00, 80.10, 80.10, NULL, '2023-12-12 17:09:57', '2023-12-12 17:09:57', NULL),
(47, 9, 3, 2, 1.00, 0.00, 0.00, NULL, '2023-12-12 17:10:05', '2023-12-12 17:10:05', NULL),
(48, 16, 3, 1, 4.00, 77.40, 309.60, NULL, '2023-12-12 17:20:03', '2023-12-12 17:20:03', NULL),
(49, 17, 3, 1, 1.00, 3959.10, 3959.10, NULL, '2023-12-12 17:21:30', '2023-12-12 17:21:30', NULL),
(50, 18, 3, 1, 5.00, 133.02, 665.10, NULL, '2023-12-12 17:24:42', '2023-12-12 17:24:42', NULL),
(51, 19, 3, 1, 5.00, 158.22, 791.10, NULL, '2023-12-12 17:27:57', '2023-12-12 17:27:57', NULL),
(52, 19, 3, 1, 1.00, 166.50, 166.50, NULL, '2023-12-12 17:28:21', '2023-12-12 17:28:21', NULL),
(53, 20, 3, 1, 2.00, 999.00, 1998.00, NULL, '2023-12-13 08:33:03', '2023-12-13 08:33:03', NULL),
(54, 21, 3, 1, 2.00, 599.00, 1198.00, NULL, '2023-12-13 08:37:12', '2023-12-13 08:37:12', NULL),
(55, 22, 3, 1, 1.00, 629.00, 629.00, NULL, '2023-12-13 08:37:12', '2023-12-13 08:37:12', NULL),
(56, 23, 3, 1, 1.00, 519.00, 519.00, NULL, '2023-12-13 08:37:12', '2023-12-13 08:37:12', NULL),
(57, 24, 3, 1, 4.00, 2436.00, 9744.00, NULL, '2023-12-13 08:38:56', '2023-12-13 08:38:56', NULL),
(58, 25, 3, 1, 2.00, 449.00, 898.00, NULL, '2023-12-13 08:54:11', '2023-12-13 08:54:11', NULL),
(59, 26, 3, 1, 1.00, 229.00, 229.00, NULL, '2023-12-13 08:55:23', '2023-12-13 08:55:23', NULL),
(60, 27, 3, 1, 1.00, 669.00, 669.00, NULL, '2023-12-13 09:17:20', '2023-12-13 09:17:20', NULL),
(61, 28, 3, 1, 2.00, 298.00, 596.00, NULL, '2023-12-13 11:25:15', '2023-12-13 11:25:15', NULL),
(62, 29, 3, 1, 2.00, 1687.31, 3374.62, NULL, '2023-12-13 11:25:15', '2023-12-13 11:25:15', NULL),
(63, 30, 3, 1, 2.00, 432.10, 864.20, NULL, '2023-12-13 11:25:15', '2023-12-13 11:25:15', NULL),
(64, 31, 3, 1, 2.00, 75.00, 150.00, NULL, '2023-12-13 11:25:15', '2023-12-13 11:25:15', NULL),
(65, 32, 3, 1, 2.00, 83.00, 166.00, NULL, '2023-12-13 11:25:15', '2023-12-13 11:25:15', NULL),
(66, 33, 3, 1, 2.00, 282.47, 564.94, NULL, '2023-12-13 11:25:15', '2023-12-13 11:25:15', NULL),
(67, 24, 3, 2, 4.00, 0.00, 0.00, NULL, '2023-12-13 13:38:17', '2023-12-13 13:38:17', NULL),
(68, 24, 3, 1, 4.00, 2100.00, 8400.00, NULL, '2023-12-13 13:38:31', '2023-12-13 13:38:31', NULL),
(69, 26, 3, 2, 1.00, 0.00, 0.00, NULL, '2023-12-16 08:20:55', '2023-12-16 08:20:55', NULL),
(70, 7, 3, 2, 1.00, 0.00, 0.00, NULL, '2023-12-16 08:21:05', '2023-12-16 08:21:05', NULL),
(71, 20, 3, 2, 2.00, 0.00, 0.00, NULL, '2023-12-16 08:21:28', '2023-12-16 08:21:28', NULL),
(72, 23, 3, 2, 1.00, 0.00, 0.00, NULL, '2023-12-16 08:21:41', '2023-12-16 08:21:41', NULL),
(73, 22, 3, 2, 1.00, 0.00, 0.00, NULL, '2023-12-16 08:21:51', '2023-12-16 08:21:51', NULL),
(74, 21, 3, 2, 2.00, 0.00, 0.00, NULL, '2023-12-16 08:21:57', '2023-12-16 08:21:57', NULL),
(75, 24, 3, 2, 4.00, 0.00, 0.00, NULL, '2023-12-16 08:24:53', '2023-12-16 08:24:53', NULL),
(76, 34, 3, 1, 4.00, 2100.00, 8400.00, NULL, '2023-12-16 08:26:54', '2023-12-16 08:26:54', NULL),
(77, 35, 3, 1, 1.00, 536.00, 536.00, NULL, '2023-12-16 08:36:17', '2023-12-16 08:36:17', NULL),
(78, 36, 3, 1, 1.00, 989.48, 989.48, NULL, '2023-12-16 08:38:21', '2023-12-16 08:38:21', NULL),
(79, 37, 3, 1, 1.00, 989.48, 989.48, NULL, '2023-12-16 08:40:18', '2023-12-16 08:40:18', NULL),
(80, 38, 3, 1, 2.00, 438.92, 877.84, NULL, '2023-12-16 08:40:18', '2023-12-16 08:40:18', NULL),
(81, 39, 3, 1, 1.00, 1290.00, 1290.00, NULL, '2023-12-16 08:49:20', '2023-12-16 08:49:20', NULL),
(82, 40, 3, 1, 1.00, 950.00, 950.00, NULL, '2023-12-16 08:49:20', '2023-12-16 08:49:20', NULL),
(83, 12, 3, 2, 1.00, 259.57, 259.57, 33, '2023-12-16 10:50:37', '2023-12-16 10:50:37', NULL),
(84, 11, 3, 2, 1.00, 269.10, 269.10, 33, '2023-12-16 10:50:37', '2023-12-16 10:50:37', NULL),
(85, 16, 3, 2, 1.00, 77.40, 77.40, 33, '2023-12-16 10:50:37', '2023-12-16 10:50:37', NULL),
(86, 9, 3, 2, 1.00, 80.10, 80.10, 33, '2023-12-16 10:50:37', '2023-12-16 10:50:37', NULL),
(87, 17, 3, 2, 1.00, 3959.10, 3959.10, 33, '2023-12-16 10:50:37', '2023-12-16 10:50:37', NULL),
(88, 19, 3, 2, 5.00, 166.50, 832.50, 33, '2023-12-16 10:50:37', '2023-12-16 10:50:37', NULL),
(89, 18, 3, 2, 5.00, 133.02, 665.10, 33, '2023-12-16 10:50:37', '2023-12-16 10:50:37', NULL),
(90, 36, 3, 2, 1.00, 989.48, 989.48, 33, '2023-12-16 10:50:37', '2023-12-16 10:50:37', NULL),
(91, 37, 3, 2, 1.00, 989.48, 989.48, 33, '2023-12-16 10:50:37', '2023-12-16 10:50:37', NULL),
(92, 38, 3, 2, 2.00, 438.92, 877.84, 33, '2023-12-16 10:50:37', '2023-12-16 10:50:37', NULL),
(93, 39, 3, 2, 1.00, 1290.00, 1290.00, 33, '2023-12-16 10:50:37', '2023-12-16 10:50:37', NULL),
(94, 40, 3, 2, 1.00, 950.00, 950.00, 33, '2023-12-16 10:50:37', '2023-12-16 10:50:37', NULL),
(95, 34, 3, 2, 4.00, 2100.00, 8400.00, 33, '2023-12-16 10:50:37', '2023-12-16 10:50:37', NULL),
(96, 35, 3, 2, 1.00, 0.00, 0.00, NULL, '2023-12-18 10:35:17', '2023-12-18 10:35:17', NULL),
(97, 27, 3, 2, 1.00, 0.00, 0.00, NULL, '2023-12-18 10:35:22', '2023-12-18 10:35:22', NULL),
(98, 25, 3, 2, 2.00, 0.00, 0.00, NULL, '2023-12-18 10:35:42', '2023-12-18 10:35:42', NULL),
(99, 16, 3, 2, 3.00, 0.00, 0.00, NULL, '2023-12-18 10:36:13', '2023-12-18 10:36:13', NULL),
(100, 31, 3, 2, 1.00, 75.00, 75.00, 35, '2023-12-18 16:28:54', '2023-12-18 16:28:54', NULL),
(101, 32, 3, 2, 1.00, 83.00, 83.00, 35, '2023-12-18 16:28:54', '2023-12-18 16:28:54', NULL),
(102, 33, 3, 2, 1.00, 282.47, 282.47, 35, '2023-12-18 16:28:54', '2023-12-18 16:28:54', NULL),
(103, 3, 3, 2, 10.00, 0.00, 0.00, NULL, '2023-12-21 09:14:10', '2023-12-21 09:14:10', NULL),
(104, 41, 3, 1, 2.00, 0.50, 1.00, NULL, '2023-12-21 09:25:53', '2023-12-21 09:25:53', NULL),
(105, 42, 3, 1, 2.00, 0.50, 1.00, NULL, '2023-12-21 09:27:58', '2023-12-21 09:27:58', NULL),
(106, 43, 3, 1, 7.00, 0.14, 1.00, NULL, '2023-12-21 09:32:50', '2023-12-21 09:32:50', NULL),
(107, 44, 3, 1, 2.00, 0.50, 1.00, NULL, '2023-12-21 09:38:00', '2023-12-21 09:38:00', NULL),
(108, 45, 3, 1, 6.00, 0.17, 1.00, NULL, '2023-12-21 09:38:00', '2023-12-21 09:38:00', NULL),
(109, 46, 3, 1, 5.00, 0.20, 1.00, NULL, '2023-12-21 09:38:00', '2023-12-21 09:38:00', NULL),
(110, 47, 3, 1, 8.00, 0.12, 1.00, NULL, '2023-12-21 09:38:00', '2023-12-21 09:38:00', NULL),
(111, 48, 3, 1, 2.00, 0.50, 1.00, NULL, '2023-12-21 09:38:00', '2023-12-21 09:38:00', NULL),
(112, 49, 3, 1, 16.00, 0.06, 1.00, NULL, '2023-12-21 09:46:29', '2023-12-21 09:46:29', NULL),
(113, 50, 3, 1, 3.00, 0.33, 1.00, NULL, '2023-12-21 09:46:29', '2023-12-21 09:46:29', NULL),
(114, 51, 3, 1, 7.00, 0.14, 1.00, NULL, '2023-12-21 09:46:29', '2023-12-21 09:46:29', NULL),
(115, 52, 3, 1, 2.00, 0.50, 1.00, NULL, '2023-12-21 09:46:29', '2023-12-21 09:46:29', NULL),
(116, 53, 3, 1, 11.00, 0.09, 1.00, NULL, '2023-12-21 09:53:26', '2023-12-21 09:53:26', NULL),
(117, 54, 3, 1, 2.00, 0.50, 1.00, NULL, '2023-12-21 09:53:26', '2023-12-21 09:53:26', NULL),
(118, 55, 3, 1, 12.00, 0.08, 1.00, NULL, '2023-12-21 09:53:26', '2023-12-21 09:53:26', NULL),
(119, 56, 3, 1, 1.00, 1.00, 1.00, NULL, '2023-12-21 09:53:26', '2023-12-21 09:53:26', NULL),
(120, 56, 3, 2, 1.00, 0.00, 0.00, NULL, '2023-12-21 09:53:37', '2023-12-21 09:53:37', NULL),
(121, 57, 3, 1, 2.00, 0.50, 1.00, NULL, '2023-12-21 10:03:28', '2023-12-21 10:03:28', NULL),
(122, 58, 3, 1, 5.00, 0.20, 1.00, NULL, '2023-12-21 10:03:28', '2023-12-21 10:03:28', NULL),
(123, 59, 3, 1, 8.00, 0.12, 1.00, NULL, '2023-12-21 10:03:28', '2023-12-21 10:03:28', NULL),
(124, 60, 3, 1, 2.00, 0.50, 1.00, NULL, '2023-12-21 10:03:28', '2023-12-21 10:03:28', NULL),
(125, 61, 3, 1, 3.00, 0.33, 1.00, NULL, '2023-12-21 10:09:13', '2023-12-21 10:09:13', NULL),
(126, 62, 3, 1, 47.00, 0.02, 1.00, NULL, '2023-12-21 10:23:17', '2023-12-21 10:23:17', NULL),
(127, 63, 3, 1, 11.00, 0.09, 1.00, NULL, '2023-12-21 10:23:17', '2023-12-21 10:23:17', NULL),
(128, 64, 3, 1, 102.00, 0.01, 1.00, NULL, '2023-12-21 10:26:50', '2023-12-21 10:26:50', NULL),
(129, 65, 3, 1, 2.00, 0.50, 1.00, NULL, '2023-12-21 10:30:22', '2023-12-21 10:30:22', NULL),
(130, 66, 3, 1, 2.00, 0.50, 1.00, NULL, '2023-12-21 10:30:22', '2023-12-21 10:30:22', NULL),
(131, 67, 3, 1, 1.00, 1.00, 1.00, NULL, '2023-12-21 10:30:22', '2023-12-21 10:30:22', NULL),
(132, 61, 3, 2, 1.00, 0.00, 0.00, NULL, '2023-12-21 12:17:08', '2023-12-21 12:17:08', NULL),
(133, 61, 3, 1, 24.00, 0.04, 1.00, NULL, '2023-12-26 13:11:38', '2023-12-26 13:11:38', NULL),
(134, 68, 3, 1, 5.00, 0.20, 1.00, NULL, '2023-12-26 13:13:08', '2023-12-26 13:13:08', NULL),
(135, 69, 3, 1, 2.00, 75.00, 150.00, NULL, '2023-12-26 16:51:23', '2023-12-26 16:51:23', NULL),
(136, 70, 3, 1, 2.00, 220.00, 440.00, NULL, '2023-12-26 16:51:23', '2023-12-26 16:51:23', NULL),
(137, 71, 3, 1, 2.00, 175.00, 350.00, NULL, '2023-12-26 16:51:23', '2023-12-26 16:51:23', NULL),
(138, 72, 3, 1, 2.00, 205.18, 410.36, NULL, '2023-12-26 16:51:23', '2023-12-26 16:51:23', NULL),
(139, 73, 3, 1, 1.00, 75.00, 75.00, NULL, '2023-12-26 17:04:35', '2023-12-26 17:04:35', NULL),
(140, 74, 3, 1, 1.00, 220.00, 220.00, NULL, '2023-12-26 17:04:35', '2023-12-26 17:04:35', NULL),
(141, 75, 3, 1, 1.00, 175.00, 175.00, NULL, '2023-12-26 17:04:35', '2023-12-26 17:04:35', NULL),
(142, 76, 3, 1, 1.00, 205.36, 205.36, NULL, '2023-12-26 17:05:33', '2023-12-26 17:05:33', NULL),
(143, 70, 3, 2, 1.00, 0.00, 0.00, NULL, '2023-12-27 08:29:27', '2023-12-27 08:29:27', NULL),
(144, 77, 3, 1, 1.00, 220.00, 220.00, NULL, '2023-12-27 08:31:06', '2023-12-27 08:31:06', NULL),
(145, 62, 3, 2, 1.00, 0.00, 0.00, NULL, '2024-01-03 11:38:28', '2024-01-03 11:38:28', NULL),
(146, 61, 3, 2, 1.00, 0.00, 0.00, NULL, '2024-01-03 11:38:28', '2024-01-03 11:38:28', NULL),
(147, 45, 3, 2, 1.00, 0.00, 0.00, NULL, '2024-01-03 11:38:28', '2024-01-03 11:38:28', NULL),
(148, 51, 3, 2, 2.00, 0.00, 0.00, NULL, '2024-01-03 11:38:29', '2024-01-03 11:38:29', NULL),
(149, 62, 3, 2, 1.00, 0.00, 0.00, NULL, '2024-01-04 10:25:43', '2024-01-04 10:25:43', NULL),
(150, 53, 3, 2, 1.00, 0.00, 0.00, NULL, '2024-01-04 10:25:43', '2024-01-04 10:25:43', NULL),
(151, 68, 3, 2, 1.00, 0.00, 0.00, NULL, '2024-01-04 10:25:43', '2024-01-04 10:25:43', NULL),
(152, 28, 3, 2, 1.00, 298.00, 298.00, 41, '2024-01-09 08:54:47', '2024-01-09 08:54:47', NULL),
(153, 29, 3, 2, 1.00, 1687.31, 1687.31, 41, '2024-01-09 08:54:47', '2024-01-09 08:54:47', NULL),
(154, 30, 3, 2, 1.00, 432.10, 432.10, 41, '2024-01-09 08:54:47', '2024-01-09 08:54:47', NULL),
(155, 6, 3, 2, 15.00, 57.69, 865.35, 41, '2024-01-09 08:54:47', '2024-01-09 08:54:47', NULL),
(156, 18, 3, 2, 2.00, 133.02, 266.04, 41, '2024-01-09 08:54:47', '2024-01-09 08:54:47', NULL),
(159, 9, 3, 1, 3.00, 80.10, 240.30, NULL, '2024-01-09 17:27:19', '2024-01-09 17:27:19', NULL),
(160, 12, 3, 1, 2.00, 271.20, 542.40, NULL, '2024-01-09 17:27:46', '2024-01-09 17:27:46', NULL),
(161, 19, 3, 1, 17.00, 159.19, 2706.30, NULL, '2024-01-09 17:28:35', '2024-01-09 17:28:35', NULL),
(162, 9, 3, 2, 1.00, 80.10, 80.10, 40, '2024-01-10 10:45:51', '2024-01-10 10:45:51', NULL),
(163, 12, 3, 2, 1.00, 271.20, 271.20, 40, '2024-01-10 10:45:51', '2024-01-10 10:45:51', NULL),
(164, 19, 3, 2, 6.00, 159.19, 955.14, 40, '2024-01-10 10:45:51', '2024-01-10 10:45:51', NULL),
(165, 28, 3, 2, 1.00, 298.00, 298.00, 43, '2024-01-10 16:37:45', '2024-01-10 16:37:45', NULL),
(166, 29, 3, 2, 1.00, 1687.31, 1687.31, 43, '2024-01-10 16:37:45', '2024-01-10 16:37:45', NULL),
(167, 30, 3, 2, 1.00, 432.10, 432.10, 43, '2024-01-10 16:37:45', '2024-01-10 16:37:45', NULL),
(168, 6, 3, 2, 15.00, 57.69, 865.35, 43, '2024-01-10 16:37:45', '2024-01-10 16:37:45', NULL),
(169, 16, 3, 1, 4.00, 77.40, 309.60, NULL, '2024-01-11 16:38:41', '2024-01-11 16:38:41', NULL),
(170, 11, 3, 1, 2.00, 269.10, 538.20, NULL, '2024-01-12 08:29:12', '2024-01-12 08:29:12', NULL),
(171, 79, 3, 1, 1.00, 236.00, 236.00, NULL, '2024-01-12 10:03:25', '2024-01-12 10:03:25', NULL),
(172, 80, 3, 1, 2.00, 342.00, 684.00, NULL, '2024-01-12 10:03:25', '2024-01-12 10:03:25', NULL),
(173, 81, 3, 1, 2.00, 1285.00, 2570.00, NULL, '2024-01-12 10:03:25', '2024-01-12 10:03:25', NULL),
(174, 82, 3, 1, 1.00, 355.00, 355.00, NULL, '2024-01-12 10:03:25', '2024-01-12 10:03:25', NULL),
(175, 4, 3, 2, 100.00, 0.00, 0.00, NULL, '2024-01-12 10:11:12', '2024-01-12 10:11:12', NULL),
(176, 5, 3, 2, 7.00, 0.00, 0.00, NULL, '2024-01-12 10:11:27', '2024-01-12 10:11:27', NULL),
(177, 83, 3, 1, 10.00, 249.00, 2490.00, NULL, '2024-01-12 13:54:00', '2024-01-12 13:54:00', NULL),
(178, 9, 3, 2, 1.00, 80.10, 80.10, 42, '2024-01-12 17:21:23', '2024-01-12 17:21:23', NULL),
(179, 12, 3, 2, 1.00, 271.20, 271.20, 42, '2024-01-12 17:21:23', '2024-01-12 17:21:23', NULL),
(180, 16, 3, 2, 4.00, 77.40, 309.60, 42, '2024-01-12 17:21:23', '2024-01-12 17:21:23', NULL),
(181, 11, 3, 2, 1.00, 269.10, 269.10, 42, '2024-01-12 17:21:23', '2024-01-12 17:21:23', NULL),
(182, 19, 3, 2, 6.00, 159.19, 955.14, 42, '2024-01-12 17:21:23', '2024-01-12 17:21:23', NULL),
(183, 83, 3, 2, 1.00, 249.00, 249.00, 42, '2024-01-12 17:21:23', '2024-01-12 17:21:23', NULL),
(184, 84, 3, 1, 208.00, 14.28, 2970.00, NULL, '2024-01-15 09:05:45', '2024-01-15 09:05:45', NULL),
(185, 79, 3, 2, 1.00, 236.00, 236.00, 44, '2024-01-15 09:07:04', '2024-01-15 09:07:04', NULL),
(186, 80, 3, 2, 1.00, 342.00, 342.00, 44, '2024-01-15 09:07:04', '2024-01-15 09:07:04', NULL),
(187, 81, 3, 2, 1.00, 1285.00, 1285.00, 44, '2024-01-15 09:07:04', '2024-01-15 09:07:04', NULL),
(188, 82, 3, 2, 1.00, 355.00, 355.00, 44, '2024-01-15 09:07:04', '2024-01-15 09:07:04', NULL),
(189, 6, 3, 2, 12.00, 57.69, 692.28, 44, '2024-01-15 09:07:04', '2024-01-15 09:07:04', NULL),
(190, 84, 3, 2, 1.00, 14.28, 14.28, 44, '2024-01-15 09:07:04', '2024-01-15 09:07:04', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarioMovimientosMtq`
--

DROP TABLE IF EXISTS `inventarioMovimientosMtq`;
CREATE TABLE IF NOT EXISTS `inventarioMovimientosMtq` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `inventarioId` bigint(20) UNSIGNED NOT NULL,
  `usuarioId` bigint(20) UNSIGNED NOT NULL,
  `movimiento` int(4) NOT NULL,
  `cantidad` float(10,2) NOT NULL,
  `precioUnitario` float(10,2) NOT NULL,
  `total` float(10,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `comentario` text,
  PRIMARY KEY (`id`),
  KEY `FK_inventarioMovimientosMtq_inventario` (`inventarioId`),
  KEY `FK_inventarioMovimientosMtq_usuario` (`usuarioId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventarioMovimientosMtq`
--

INSERT INTO `inventarioMovimientosMtq` (`id`, `inventarioId`, `usuarioId`, `movimiento`, `cantidad`, `precioUnitario`, `total`, `created_at`, `updated_at`, `comentario`) VALUES
(1, 3, 5, 1, 1.00, 15.00, 15.00, '2023-09-21 16:22:52', '2023-09-21 16:22:52', NULL),
(2, 4, 2, 1, 5.00, 1300.00, 6500.00, '2023-09-21 18:36:38', '2023-09-21 18:36:38', NULL),
(3, 5, 2, 1, 5.00, 1800.00, 9000.00, '2023-09-21 18:39:51', '2023-09-21 18:39:51', NULL),
(4, 6, 2, 1, 3000.00, 25.00, 75000.00, '2023-09-21 18:52:53', '2023-09-21 18:52:53', NULL),
(5, 1, 5, 2, 12.00, 0.00, 0.00, '2023-11-07 08:57:57', '2023-11-07 08:57:57', NULL),
(6, 1, 5, 2, 12.00, 0.00, 0.00, '2023-11-07 08:58:04', '2023-11-07 08:58:04', '3'),
(7, 7, 7, 1, 1.00, 1.00, 1.00, '2023-11-28 08:00:51', '2023-11-28 08:00:51', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarioMtq`
--

DROP TABLE IF EXISTS `inventarioMtq`;
CREATE TABLE IF NOT EXISTS `inventarioMtq` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `numparte` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `marcaId` bigint(20) UNSIGNED NOT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `proveedorId` bigint(20) UNSIGNED NOT NULL,
  `cantidad` float(10,2) DEFAULT NULL,
  `unidad` varchar(255) DEFAULT NULL,
  `reorden` float(10,2) DEFAULT NULL,
  `maximo` float(10,2) DEFAULT NULL,
  `valor` float(10,2) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `uniformeTipoId` bigint(20) UNSIGNED DEFAULT NULL,
  `uniformeTalla` varchar(16) DEFAULT NULL,
  `uniformeRetornable` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_inventarioMtq_tipouniforme` (`uniformeTipoId`),
  KEY `FK_inventarioMtq_marca` (`marcaId`),
  KEY `FK_inventarioMtq_proveedor` (`proveedorId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventarioMtq`
--

INSERT INTO `inventarioMtq` (`id`, `numparte`, `nombre`, `marcaId`, `modelo`, `proveedorId`, `cantidad`, `unidad`, `reorden`, `maximo`, `valor`, `imagen`, `tipo`, `uniformeTipoId`, `uniformeTalla`, `uniformeRetornable`, `created_at`, `updated_at`) VALUES
(1, '100456', 'PINZAS MECÁNICAS', 23, 'PINZAS MECÁNICAS', 1, -19.00, NULL, 2.00, 5.00, 185.00, '1695342808_imagen.jpg', 'herramientas', NULL, NULL, NULL, '2023-09-21 15:58:05', '2023-11-07 08:58:04'),
(4, '153812', 'Amortiguadores Sedan', 23, 'Delanteros', 1, 5.00, NULL, 2.00, 5.00, 1300.00, NULL, 'refacciones', NULL, NULL, NULL, '2023-09-21 18:36:38', '2023-09-21 18:36:38'),
(5, '00318', 'Amortiguadores Camioneta', 23, 'Camioneta', 2, 5.00, NULL, 2.00, 5.00, 1800.00, '1695343191_imagen.jpg', 'refacciones', NULL, NULL, NULL, '2023-09-21 18:39:51', '2023-09-21 18:39:51'),
(6, '0003543', 'Aceite de Motor', 23, 'ACEITE MOTOR', 1, 3000.00, NULL, 500.00, 3000.00, 25.00, NULL, 'consumibles', NULL, NULL, NULL, '2023-09-21 18:52:53', '2023-09-21 18:52:53'),
(7, '00001', 'Arena', 35, 'n/a', 1, 1.00, 'Toneladas', 1.00, 1.00, 1.00, NULL, 'materiales', NULL, NULL, NULL, '2023-11-28 08:00:51', '2023-11-28 08:03:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares`
--

DROP TABLE IF EXISTS `lugares`;
CREATE TABLE IF NOT EXISTS `lugares` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `comentario` text,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `ubicacionId` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_lugares_ubicacionId` (`ubicacionId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lugares`
--

INSERT INTO `lugares` (`id`, `nombre`, `comentario`, `activo`, `ubicacionId`, `created_at`, `updated_at`) VALUES
(1, 'Taller Q2ces', 'Calle San Juan de los Lagos # 1788, Colonia Hogares de Nuevo Mexico, Zapopan Jalisco, C.P.', 1, 1, '2023-08-25 11:43:01', '2023-09-09 19:59:55'),
(2, 'Oficina Central', 'José Maria Heredia # 2387 Colonia Lomas de Guevara Guadalajara Jalisco C.P. 44657', 1, 1, '2023-09-09 19:58:36', '2023-09-09 19:58:36'),
(3, 'MTQ de México S.A. de C.V.', 'José Maria Heredia # 2405 Colonia Lomas de Guevara, Guadalajara Jalisco C.P. 44657', 1, 1, '2023-09-09 20:01:14', '2023-09-09 20:01:14'),
(4, 'Bodega MTQ Agua Blanca', '.', 1, 1, '2023-09-09 20:01:46', '2023-09-09 20:01:46'),
(5, 'NPM Project, S.A. de C.V. (NEWS)', 'Jose Maria Heredia # 2387, Colonia Lomas de Guevara Guadalajara Jalisco C.P. 44657', 1, 2, '2023-09-09 20:02:55', '2023-09-19 12:40:51'),
(6, 'Entrada', NULL, 1, 5, '2023-09-19 12:43:34', '2023-09-19 12:43:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `manoDeObra`
--

DROP TABLE IF EXISTS `manoDeObra`;
CREATE TABLE IF NOT EXISTS `manoDeObra` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` varchar(200) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `costo` float(10,2) NOT NULL,
  `comentario` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `manoDeObra`
--

INSERT INTO `manoDeObra` (`id`, `codigo`, `nombre`, `costo`, `comentario`) VALUES
(1, 'MO-01', 'Mano de Obra', 500.00, 'Mano de obra general'),
(2, 'MO-02', 'Mano de Obra Revisión', 100.00, 'Mano de obra para revisiones de rutina'),
(3, 'MO-03', 'Lavado y Desengrasado de Motor', 200.00, 'Lavado y desengrasado de motor'),
(4, 'MO-04', 'Lavado de Carrocería', 200.00, 'Lavado de carrocería'),
(5, 'MO-05', 'Lavado y Protector de Batería', 30.00, 'Lavado y protector de batería'),
(6, 'MO-06', 'Limpieza de Inyectores con Boya', 119.00, 'Limpieza de inyectores con boya'),
(7, 'MO-07', 'Limpieza de Frenos', 95.00, 'Limpieza de frenos'),
(8, 'MO-08', 'Limpieza Cuerpo de Aceleración', 85.00, 'Limpieza del cuerpo de aceleración'),
(9, 'MO-09', 'Rectificación de Discos de Freno', 100.00, 'Rectificación de Discos de Freno'),
(10, 'MO-10', 'Rectificación de Motor', 100.00, 'Rectificación de motor'),
(11, 'MT-11', 'Alineación y Balanceo (p. Montado de Llantas)', 100.00, NULL),
(12, 'MO-12', 'Rectificado de Discos', 400.00, NULL),
(13, 'MO-13', 'Rectificado de Tambores', 400.00, NULL),
(14, 'MO-14', 'Relleno Liquido de Frenos', 240.00, NULL),
(15, 'MO-15', 'Mano de Obra Frenos', 1190.00, NULL),
(16, 'MO-16', 'Balatas y Zapatas Frenos Únicos', 2370.00, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientoImagen`
--

DROP TABLE IF EXISTS `mantenimientoImagen`;
CREATE TABLE IF NOT EXISTS `mantenimientoImagen` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `maquinariaId` bigint(20) UNSIGNED NOT NULL,
  `mantenimientoId` bigint(20) UNSIGNED NOT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_mantenimientoImagen_maquinariaId` (`maquinariaId`),
  KEY `FK_mantenimientoImagen_mantenimientoId` (`mantenimientoId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mantenimientoImagen`
--

INSERT INTO `mantenimientoImagen` (`id`, `maquinariaId`, `mantenimientoId`, `ruta`) VALUES
(6, 62, 31, '0031_1701476180_Imagen01.jpg'),
(7, 62, 31, '0031_1701476180_Imagen02.jpg'),
(8, 43, 33, '0033_1702745379_Imagen01.jpg'),
(9, 43, 33, '0033_1702745379_Imagen02.jpg'),
(10, 43, 33, '0033_1702745379_Imagen03.jpg'),
(11, 43, 33, '0033_1702745379_Imagen04.jpg'),
(12, 43, 33, '0033_1702745379_Imagen05.jpg'),
(13, 42, 40, '0040_1704905134_Imagen01.jpg'),
(14, 42, 40, '0040_1704905134_Imagen02.jpg'),
(15, 42, 40, '0040_1704905134_Imagen03.jpg'),
(16, 41, 42, '0042_1705101683_Imagen01.jpg'),
(17, 41, 42, '0042_1705101683_Imagen02.jpg'),
(18, 41, 42, '0042_1705101683_Imagen03.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientos`
--

DROP TABLE IF EXISTS `mantenimientos`;
CREATE TABLE IF NOT EXISTS `mantenimientos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `maquinariaId` bigint(20) UNSIGNED NOT NULL,
  `personalId` bigint(20) UNSIGNED DEFAULT NULL,
  `residenteId` bigint(20) UNSIGNED DEFAULT NULL,
  `tipoMantenimientoId` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `titulo` varchar(255) NOT NULL,
  `codigo` varchar(8) DEFAULT NULL,
  `fechaInicio` date NOT NULL,
  `fechaReal` date DEFAULT NULL,
  `estadoId` bigint(20) UNSIGNED NOT NULL,
  `comentario` text,
  `usoKom` float(10,2) NOT NULL DEFAULT '0.00',
  `observaciones` text,
  `adscripcion` varchar(200) DEFAULT NULL,
  `horometro` int(11) DEFAULT NULL,
  `kilometraje` int(11) DEFAULT NULL,
  `subtotal` float(10,2) DEFAULT NULL,
  `iva` float(10,2) DEFAULT NULL,
  `costo` float(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `coordTaller` varchar(255) DEFAULT NULL,
  `coordOperaciones` varchar(255) DEFAULT NULL,
  `mecanico` varchar(255) DEFAULT NULL,
  `responsable` varchar(255) DEFAULT NULL,
  `imagenSellos` varchar(255) DEFAULT NULL,
  `mantenimientoPrint` varchar(255) DEFAULT NULL,
  `documentoSellado` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_mantenimientos_userId` (`maquinariaId`),
  KEY `FK_mantenimientos_estadoId` (`estadoId`),
  KEY `FK_mantenimiento_personalId` (`personalId`),
  KEY `FK_mantenimiento_tipoId` (`tipoMantenimientoId`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mantenimientos`
--

INSERT INTO `mantenimientos` (`id`, `maquinariaId`, `personalId`, `residenteId`, `tipoMantenimientoId`, `titulo`, `codigo`, `fechaInicio`, `fechaReal`, `estadoId`, `comentario`, `usoKom`, `observaciones`, `adscripcion`, `horometro`, `kilometraje`, `subtotal`, `iva`, `costo`, `created_at`, `updated_at`, `coordTaller`, `coordOperaciones`, `mecanico`, `responsable`, `imagenSellos`, `mantenimientoPrint`, `documentoSellado`) VALUES
(5, 2, 2, NULL, 1, 'Mantenimiento', NULL, '2023-08-26', NULL, 1, 'Mantenimiento', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 18:12:14', '2023-08-26 18:12:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 1, NULL, NULL, 4, 'Mantenimiento SER-02 Renault Kangoo', 'SER-02', '2023-12-01', NULL, 4, NULL, 0.00, NULL, NULL, NULL, NULL, 999.00, 159.84, 1158.84, '2023-12-01 12:28:14', '2023-12-12 08:41:49', 'Edgar Villalobos Gómez', 'Edgar Villalobos Gómez', 'David Alejandro Fajardo Barrera', 'J. Félix Villalobos Ayala', NULL, NULL, NULL),
(21, 35, NULL, 27, 2, 'Mantenimiento [JNR5351] Chevrolet Aveo', '0011', '2023-12-01', NULL, 4, NULL, 0.00, NULL, NULL, NULL, NULL, 640.00, 102.40, 742.40, '2023-12-01 12:33:43', '2023-12-12 08:44:14', 'Edgar Villalobos Gómez', 'Edgar Villalobos Gómez', 'David Alejandro Fajardo Barrera', 'Eric Moctezuma', NULL, NULL, NULL),
(28, 40, NULL, 28, 6, 'Mantenimiento [JJM6231] Seat Ibiza', '0015', '2023-12-01', NULL, 4, NULL, 10000.00, NULL, NULL, NULL, NULL, 500.00, 80.00, 580.00, '2023-12-01 12:48:49', '2023-12-12 08:44:41', 'Edgar Villalobos Gómez', 'Edgar Villalobos Gómez', 'David Alejandro Fajardo Barrera', 'Eric Franco', NULL, NULL, NULL),
(30, 62, 3, NULL, 1, 'Mantenimiento Nissan NP300', 'MT-01', '2023-12-01', NULL, 4, 'Sin indicaciones para el mantenimiento', 205394.00, NULL, NULL, NULL, NULL, 5540.00, 886.40, 6426.40, '2023-12-01 17:57:56', '2023-12-12 08:44:24', 'Edgar Villalobos Gómez', 'José Israel López López', 'David Alejandro Fajardo Barrera', 'Miguel Quintero', NULL, NULL, NULL),
(31, 62, 3, NULL, 1, 'Mantenimiento Nissan NP300', 'MT-01', '2023-12-01', '2023-12-12', 3, 'Cambio de clutch', 205394.00, NULL, NULL, NULL, NULL, 5540.00, 886.40, 6426.40, '2023-12-01 18:15:24', '2024-01-03 08:49:49', 'Edgar Villalobos Gómez', 'José Israel López López', 'David Alejandro Fajardo Barrera', NULL, NULL, '208356', 1),
(32, 17, 3, NULL, 6, 'Mantenimiento Toyota Hilux Taller', 'MT-06', '2023-12-04', NULL, 3, 'Sin indicaciones para el mantenimiento', 147704.00, NULL, NULL, NULL, NULL, 3868.26, 618.92, 4487.18, '2023-12-04 09:02:05', '2023-12-04 09:17:18', 'Edgar Villalobos Gómez', 'José Israel López López', 'David Alejandro Fajardo Barrera', NULL, NULL, NULL, NULL),
(33, 43, 3, NULL, 6, 'Mantenimiento Toyota Hilux', 'MT-06', '2023-12-13', '2023-12-16', 3, 'Sin indicaciones para el mantenimiento', 209792.00, NULL, NULL, NULL, NULL, 26165.65, 4186.50, 30352.15, '2023-12-13 08:39:33', '2024-01-03 08:49:14', 'Edgar Villalobos Gómez', 'José Israel López López', 'David Alejandro Fajardo Barrera', 'Fernando Luna', NULL, '190250', 1),
(35, 31, 3, NULL, 2, 'Mantenimiento Miniretroexcavadora JCB 1CX', 'MT-02', '2023-12-18', '2023-12-18', 3, 'Sin indicaciones para el mantenimiento', 6569.00, NULL, NULL, NULL, NULL, 440.47, 70.48, 510.95, '2023-12-18 16:25:45', '2024-01-03 08:45:34', 'Edgar Villalobos Gómez', 'José Israel López López', NULL, NULL, NULL, '6605', 0),
(40, 42, NULL, 12, 6, 'Mantenimiento [JH04740] Toyota Hilux', '0009', '2024-01-10', '2024-01-10', 3, NULL, 291616.00, NULL, NULL, NULL, NULL, 2536.44, 405.83, 2942.27, '2024-01-08 11:28:59', '2024-01-10 11:13:42', 'Edgar Villalobos Gómez Villalobos Gómez', 'José Israel López López', 'David Alejandro Fajardo Barrera', 'Osvaldo Saldaña', NULL, '301616', 1),
(41, 29, NULL, NULL, 2, 'Mantenimiento Retroexcavadora John Deere 2017', 'MT-02', '2024-01-08', '2024-01-09', 3, 'Sin indicaciones para el mantenimiento', 4108.00, NULL, NULL, NULL, NULL, 5048.80, 807.81, 5856.61, '2024-01-08 12:59:51', '2024-01-09 08:54:46', 'Edgar Villalobos Gómez Villalobos Gómez', 'José Israel López López', NULL, NULL, NULL, '4358', NULL),
(42, 41, NULL, 7, 8, 'Mantenimiento [JS14207] Toyota Hilux', '0016', '2024-01-12', '2024-01-12', 3, NULL, 237124.00, NULL, NULL, NULL, NULL, 9619.14, 1539.06, 11158.20, '2024-01-09 10:11:16', '2024-01-13 10:54:20', 'Edgar Villalobos Gómez Villalobos Gómez', 'José Israel López López', 'David Alejandro Fajardo Barrera', 'Eric Franco', NULL, '247124', 1),
(43, 28, 27, NULL, 2, 'Mantenimiento Retroexcavadora John Deere 2018', 'MT-02', '2024-01-10', '2024-01-10', 3, 'Sin indicaciones para el mantenimiento', 6158.00, NULL, NULL, NULL, NULL, 4782.76, 765.24, 5548.00, '2024-01-10 16:35:44', '2024-01-13 10:56:18', 'Edgar Villalobos Gómez Villalobos Gómez', 'José Israel López López', 'David Alejandro Fajardo Barrera', 'Josue Isaias Alcala Cortez', NULL, '6408', 1),
(44, 71, NULL, 43, 6, 'Mantenimiento [8GPM96] Mercedes Benz Sprinter', '0003', '2024-01-13', '2024-01-15', 3, NULL, 354668.00, NULL, NULL, NULL, NULL, 4654.56, 744.73, 5399.29, '2024-01-11 17:11:53', '2024-01-15 09:36:12', 'Edgar Villalobos Gómez Villalobos Gómez', 'José Israel López López', 'David Alejandro Fajardo Barrera', 'J. Félix Villalobos', NULL, '364668', 1),
(45, 43, NULL, 42, 1, 'Mantenimiento [JT46574] Toyota Hilux', '0017', '2024-01-17', NULL, 1, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-16 12:00:47', '2024-01-16 12:00:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maqacce`
--

DROP TABLE IF EXISTS `maqacce`;
CREATE TABLE IF NOT EXISTS `maqacce` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `maquinariaId` bigint(20) UNSIGNED NOT NULL,
  `accesorioId` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_maqacce_maquinariaId` (`maquinariaId`),
  KEY `FK_maqacce_accesorioId` (`accesorioId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maqdocs`
--

DROP TABLE IF EXISTS `maqdocs`;
CREATE TABLE IF NOT EXISTS `maqdocs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `maquinariaId` bigint(20) UNSIGNED NOT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `fechaVencimiento` date NOT NULL,
  `estatus` varchar(255) DEFAULT NULL,
  `comentarios` text,
  `tipoId` bigint(20) UNSIGNED DEFAULT NULL,
  `requerido` int(11) DEFAULT NULL,
  `vencimiento` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_maqdocs_maquinariaId` (`maquinariaId`),
  KEY `FK_maqdocs_tipoId` (`tipoId`)
) ENGINE=InnoDB AUTO_INCREMENT=306 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `maqdocs`
--

INSERT INTO `maqdocs` (`id`, `maquinariaId`, `ruta`, `tipo`, `fechaVencimiento`, `estatus`, `comentarios`, `tipoId`, `requerido`, `vencimiento`, `created_at`, `updated_at`) VALUES
(6, 5, '1695843648_FACTURA VOL-02 TRACTOCAMIÓN VOLTEO 7MTS 1HSHWAHN56J256815.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 1, '2023-08-29 00:12:07', '2023-09-27 13:40:48'),
(7, 5, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-08-29 00:12:07', '2023-08-29 00:12:07'),
(8, 5, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-08-29 00:12:07', '2023-08-29 00:12:07'),
(9, 5, '1700696218_SEGURO- VOL-02 TRACTOCAMIÓN VOLTEO 7MTS 1HSHWAHN56J256815 (2).pdf', NULL, '2024-10-27', '2', NULL, 5, 1, 1, '2023-08-29 00:12:07', '2023-11-22 17:36:58'),
(10, 5, '1695682709_TARJETA DE CIRCULACIÓN VOL-02 TRACTOCAMIÓN VOLTEO 7MTS 1HSHWAHN56J256815.pdf', NULL, '2026-10-31', '2', NULL, 6, 1, 1, '2023-08-29 00:12:07', '2023-09-25 16:58:29'),
(16, 8, '1695839247_FACTURA SER-04 GRAND CHEROKEE OVERLOAD 4X4 1J4RR6GT7BC739202.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 1, '2023-09-15 17:46:44', '2023-09-27 12:27:27'),
(17, 8, '1702324089_1697821746_FOTO PLACAS SER-04 GRAND CHEROKEE OVERLOAD 4X4 1J4RR6GT7BC739202 (1).pdf', NULL, '2023-12-13', '1', NULL, 7, 1, 1, '2023-09-15 17:46:44', '2023-12-11 13:48:09'),
(18, 8, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-15 17:46:44', '2023-09-15 17:46:44'),
(19, 8, '1695839247_SEGURO SER-04 GRAND CHEROKEE OVERLOAD 4X4 1J4RR6GT7BC739202.pdf', NULL, '2024-06-30', '2', NULL, 5, 1, 1, '2023-09-15 17:46:44', '2023-12-11 13:27:33'),
(20, 8, '1695666719_TARJETA DE CIRCULACIÓN SER-04 GRAND CHEROKEE OVERLOAD 4X4 1J4RR6GT7BC739202.pdf', NULL, '2026-10-25', '2', NULL, 6, 1, 1, '2023-09-15 17:46:44', '2023-09-25 12:31:59'),
(27, 10, '1695832058_FACTURA REM-01 REMOLQUE ARCE 3J9SBPD21NG055572.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 1, '2023-09-21 11:15:58', '2023-10-03 16:30:50'),
(30, 10, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-21 11:15:58', '2023-09-21 11:15:58'),
(31, 10, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-21 11:15:58', '2023-09-21 11:15:58'),
(33, 10, '1695423157_SEGURO REMOLQUE ARCE 3J9SBPD21NG055572.pdf', NULL, '2023-12-23', '2', NULL, 5, 1, 1, '2023-09-21 11:15:58', '2023-09-22 16:52:37'),
(34, 10, '1695423157_TARJETA DE CIRCULACIÓN REMOLQUE ARCE 3J9SBPD21NG055572.pdf', NULL, '2026-11-16', '2', NULL, 6, 1, 1, '2023-09-21 11:15:58', '2023-10-03 16:30:50'),
(36, 11, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-21 12:15:19', '2023-09-21 12:15:19'),
(37, 11, '1695423392_FACTURA REMOLQUE 4.00 X 2.40 TALLER CAMIÓN ORQUESTA 3M9B3DFL6L1097102.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 1, '2023-09-21 12:15:19', '2023-09-26 08:45:35'),
(38, 11, '1695423392_FOTODE~1.PDF', NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-21 12:15:19', '2023-09-26 08:45:35'),
(39, 11, '1697812289_FOTOVI~1.PDF', NULL, '0000-00-00', '2', NULL, 26, 1, 1, '2023-09-21 12:15:19', '2023-10-20 08:31:29'),
(40, 11, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-21 12:15:19', '2023-09-21 12:15:19'),
(41, 11, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-21 12:15:19', '2023-09-21 12:15:19'),
(42, 11, '1695832429_REFRENDO REMOLQUE 4.00 X 2.40 TALLER CAMIÓN ORQUESTA 3M9B3DFL6L1097102.pdf', NULL, '2024-01-05', '2', NULL, 27, 1, 1, '2023-09-21 12:15:19', '2023-09-27 10:33:49'),
(43, 11, NULL, NULL, '0000-00-00', '0', NULL, 5, 1, 1, '2023-09-21 12:15:19', '2023-09-21 12:15:19'),
(44, 11, '1695423392_TARJETA DE CIRCULACIÓN REMOLQUE ARCE 3J9SBPD21NG055572.pdf', NULL, '2025-02-15', '2', NULL, 6, 1, 1, '2023-09-21 12:15:19', '2023-09-22 16:56:32'),
(45, 11, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-21 12:15:19', '2023-09-21 12:15:19'),
(46, 12, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-21 12:36:35', '2023-09-21 12:36:35'),
(47, 12, '1695424654_FACTURA FOOD TRUCK QUISINE 3M9A2CFJ3L1097100.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 1, '2023-09-21 12:36:35', '2023-09-26 12:19:52'),
(48, 12, '1695424654_FOTO DE PLACAS FOOD TRUCK QUISINE 3M9A2CFJ3L1097100.pdf', NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-21 12:36:35', '2023-09-26 12:19:52'),
(49, 12, NULL, NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-21 12:36:35', '2023-09-21 12:36:35'),
(50, 12, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-21 12:36:35', '2023-09-21 12:36:35'),
(51, 12, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-21 12:36:35', '2023-09-21 12:36:35'),
(52, 12, '1695832726_REFRENDO FOOD TRUCK QUISINE 3M9A2CFJ3L1097100.pdf', NULL, '2024-01-05', '2', NULL, 27, 1, 1, '2023-09-21 12:36:35', '2023-09-27 10:38:46'),
(53, 12, NULL, NULL, '0000-00-00', '0', NULL, 5, 1, 1, '2023-09-21 12:36:35', '2023-09-21 12:36:35'),
(54, 12, NULL, NULL, '0000-00-00', '0', NULL, 6, 1, 1, '2023-09-21 12:36:35', '2023-09-21 12:36:35'),
(55, 12, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-21 12:36:35', '2023-09-21 12:36:35'),
(56, 13, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-21 13:49:13', '2023-09-21 13:49:13'),
(57, 13, '1695833476_FACTURA CAMIÓN VOLTEO 14MTS TIPO THORTON 3R9CH1210LA182203.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 1, '2023-09-21 13:49:13', '2023-10-03 17:42:58'),
(58, 13, '1697822018_FOTO PLACAS VOL-01 CAMIÓN VOLTEO 14MTS TIPO THORTON 3R9CH1210LA182203.pdf', NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-21 13:49:13', '2023-10-20 11:13:38'),
(59, 13, '1697822018_FOTO VIN VOL-01 CAMIÓN VOLTEO 14MTS TIPO THORTON 3R9CH1210LA182203.pdf', NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-21 13:49:13', '2023-10-20 11:13:38'),
(60, 13, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-21 13:49:13', '2023-09-21 13:49:13'),
(61, 13, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-21 13:49:13', '2023-09-21 13:49:13'),
(62, 13, '1695833476_REFRENDO CAMIÓN VOLTEO 14MTS TIPO THORTON 3R9CH1210LA182203.pdf', NULL, '2024-01-05', '1', NULL, 27, 1, 1, '2023-09-21 13:49:13', '2023-11-22 17:23:38'),
(63, 13, '1695833476_SEGURO CAMIÓN VOLTEO 14MTS TIPO THORTON 3R9CH1210LA182203.pdf', NULL, '2024-09-18', '2', NULL, 5, 1, 1, '2023-09-21 13:49:13', '2023-09-27 10:51:16'),
(64, 13, '1695426755_TARJETA DE CIRCULACIÓN CAMIÓN VOLTEO 14MTS TIPO THORTON 3R9CH1210LA182203.pdf', NULL, '2025-11-01', '2', NULL, 6, 1, 1, '2023-09-21 13:49:13', '2023-09-22 17:52:35'),
(65, 13, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-21 13:49:13', '2023-09-21 13:49:13'),
(66, 14, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-21 17:43:07', '2023-09-21 17:43:07'),
(67, 14, '1695834144_FACTURA REM-02 SIMIREMOLQUE 3R9B124D6LL054033.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 1, '2023-09-21 17:43:07', '2023-09-27 11:02:24'),
(68, 14, '1697759529_FOTO PLACA REM-02 SIMIREMOLQUE 3R9B124D6LL054033.pdf', NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-21 17:43:07', '2023-10-19 17:52:09'),
(69, 14, '1697759529_FOTO VIN REM-02 SIMIREMOLQUE 3R9B124D6LL054033.pdf', NULL, '0000-00-00', '2', NULL, 26, 1, 1, '2023-09-21 17:43:07', '2023-10-19 17:52:09'),
(70, 14, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-21 17:43:07', '2023-09-21 17:43:07'),
(71, 14, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-21 17:43:07', '2023-09-21 17:43:07'),
(72, 14, '1695834144_REFRENDO REM-02 SIMIREMOLQUE 3R9B124D6LL054033.pdf', NULL, '2024-01-05', '2', NULL, 27, 1, 1, '2023-09-21 17:43:07', '2023-09-27 11:02:24'),
(73, 14, '1695834144_SEGURO REM-02 SIMIREMOLQUE 3R9B124D6LL054033.pdf', NULL, '2024-09-18', '2', NULL, 5, 1, 1, '2023-09-21 17:43:07', '2023-09-27 11:02:24'),
(74, 14, '1695656195_TARJETA DE CIRCULAIÓN REM-02 SIMIREMOLQUE 3R9B124D6LL054033.pdf', NULL, '2025-11-01', '2', NULL, 6, 1, 1, '2023-09-21 17:43:07', '2023-09-25 09:36:35'),
(75, 14, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-21 17:43:07', '2023-09-21 17:43:07'),
(76, 15, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-22 10:02:14', '2023-09-22 10:02:14'),
(77, 15, '1695656943_FACTURA PIP-01 PIPA DE AGUA 20,000 LTS 3R9CH1219KA182148.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 1, '2023-09-22 10:02:14', '2023-09-26 13:07:49'),
(78, 15, '1697756999_FOTO PLACA PIP-01 PIPA DE AGUA 20,000 LTS 3R9CH1219KA182148.pdf', NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-22 10:02:14', '2023-10-19 17:09:59'),
(79, 15, '1697756999_FOTO VIN PIP-01 PIPA DE AGUA 20,000 LTS 3R9CH1219KA182148.pdf', NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-22 10:02:14', '2023-10-19 17:09:59'),
(80, 15, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-22 10:02:14', '2023-09-22 10:02:14'),
(81, 15, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-22 10:02:14', '2023-09-22 10:02:14'),
(82, 15, '1695834771_REFRENDO PIP-01 PIPA DE AGUA 20,000 LTS 3R9CH1219KA182148.pdf', NULL, '2024-01-05', '1', NULL, 27, 1, 1, '2023-09-22 10:02:14', '2023-11-22 17:19:34'),
(83, 15, '1695834771_SEGURO PIP-01 PIPA DE AGUA 20,000 LTS 3R9CH1219KA182148.pdf', NULL, '2024-07-03', '2', NULL, 5, 1, 1, '2023-09-22 10:02:14', '2023-09-27 11:12:51'),
(84, 15, '1695656943_TARJETA DE CIRCULACIÓN PIP-01 PIPA DE AGUA 20,000 LTS 3R9CH1219KA182148.pdf', NULL, '2025-08-25', '2', NULL, 6, 1, 1, '2023-09-22 10:02:14', '2023-09-25 09:49:03'),
(85, 15, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-22 10:02:14', '2023-09-22 10:02:14'),
(86, 16, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-22 10:21:16', '2023-09-22 10:21:16'),
(87, 16, '1695836333_FACTURA SER-01 DODGE RAM 4000 P 3C7WRAHT7HG705134.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 1, '2023-09-22 10:21:16', '2023-09-27 11:38:53'),
(88, 16, '1697818420_FOTO PLACA SER-01 DODGE RAM 4000 P 3C7WRAHT7HG705134.pdf', NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-22 10:21:16', '2023-10-20 10:13:40'),
(89, 16, '1697818420_FOTO VIN SER-01 DODGE RAM 4000 P 3C7WRAHT7HG705134.pdf', NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-22 10:21:16', '2023-10-20 10:13:40'),
(90, 16, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-22 10:21:16', '2023-09-22 10:21:16'),
(91, 16, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-22 10:21:16', '2023-09-22 10:21:16'),
(92, 16, '1695836333_REFRENDO SER-01 DODGE RAM 4000 P 3C7WRAHT7HG705134.pdf', NULL, '2024-01-05', '2', NULL, 27, 1, 1, '2023-09-22 10:21:16', '2023-10-03 17:56:43'),
(93, 16, '1695836333_SEGURO SER-01 DODGE RAM 4000 P 3C7WRAHT7HG705134.pdf', NULL, '2024-09-02', '2', NULL, 5, 1, 1, '2023-09-22 10:21:16', '2023-09-27 11:38:53'),
(94, 16, '1695658671_TARJETA DE CIRCULACIÓN SER-01 DODGE RAM 4000 P 3C7WRAHT7HG705134.pdf', NULL, '2025-11-01', '2', NULL, 6, 1, 1, '2023-09-22 10:21:16', '2023-09-25 10:17:51'),
(95, 16, '1697818420_VERIFICACIÓN1 SER-01 DODGE RAM 4000 P 3C7WRAHT7HG705134.pdf', NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-22 10:21:16', '2023-10-20 10:13:40'),
(96, 17, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-22 12:12:04', '2023-09-22 12:12:04'),
(97, 17, '1695837126_FACTURA SER-03 HILUX 4X2 DOBLE CABINA MID MR0EX8DD9G0245825.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 1, '2023-09-22 12:12:04', '2023-09-27 11:52:06'),
(98, 17, '1697820888_FOTO PLACAS SER-03 HILUX 4X2 DOBLE CABINA MID MR0EX8DD9G0245825.pdf', NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-22 12:12:04', '2023-10-20 10:55:49'),
(99, 17, '1697820888_FOTO VIN SER-03 HILUX 4X2 DOBLE CABINA MID MR0EX8DD9G0245825.pdf', NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-22 12:12:04', '2023-10-20 10:55:49'),
(100, 17, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-22 12:12:04', '2023-09-22 12:12:04'),
(101, 17, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-22 12:12:04', '2023-09-22 12:12:04'),
(102, 17, '1695837126_REFFRENDO SER-03 HILUX DOBLE CABINA MID MR0EX8DD9G0245825.pdf', NULL, '2024-01-05', '2', NULL, 27, 1, 1, '2023-09-22 12:12:04', '2023-09-27 11:52:06'),
(103, 17, '1695662294_SEGURO SER-03 HILUX DOBLE CABINA MID MR0EX8DD9G0245825.pdf', NULL, '2024-02-11', '2', NULL, 5, 1, 1, '2023-09-22 12:12:04', '2023-09-25 11:18:14'),
(104, 17, '1695662294_TARJETA DE CIRCULACIÓN SER-03 HILUX DOBLE CABINA MID MR0EX8DD9G0245825.pdf', NULL, '2025-02-16', '2', NULL, 6, 1, 1, '2023-09-22 12:12:04', '2023-09-25 11:18:14'),
(105, 17, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-22 12:12:04', '2023-09-22 12:12:04'),
(116, 8, '1697821746_VERIFICACIÓN SER-04 GRAND CHEROKEE OVERLOAD 4X4 1J4RR6GT7BC739202.pdf', NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-22 13:35:59', '2023-10-20 11:09:06'),
(117, 8, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-22 13:35:59', '2023-09-22 13:35:59'),
(118, 8, '1697821746_FOTO PLACAS SER-04 GRAND CHEROKEE OVERLOAD 4X4 1J4RR6GT7BC739202.pdf', NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-22 13:35:59', '2023-10-20 11:09:06'),
(119, 8, '1697821746_FOTO VIN SER-04 GRAND CHEROKEE OVERLOAD 4X4 1J4RR6GT7BC739202.pdf', NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-22 13:35:59', '2023-10-20 11:09:06'),
(120, 8, '1695839247_REFRENDO SER-04 GRAND CHEROKEE OVERLOAD 4X4 1J4RR6GT7BC739202.pdf', NULL, '2024-01-05', '1', NULL, 27, 1, 1, '2023-09-22 13:35:59', '2023-12-11 13:26:52'),
(121, 10, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-22 13:39:11', '2023-09-22 13:39:11'),
(122, 10, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-22 13:39:11', '2023-09-22 13:39:11'),
(123, 10, '1695745383_PLACAS REM-01 REMOLQUE ARCE 3J9SBPD21NG055572.pdf', NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-22 13:39:11', '2023-09-26 11:36:05'),
(124, 10, '1697758266_FOTO VIN REM-01 REMOLQUE ARCE 3J9SBPD21NG055572.pdf', NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-22 13:39:11', '2023-10-19 17:31:06'),
(125, 10, '1695832058_REFRENDO REMOLQUE ARCE 3J9SBPD21NG055572.pdf', NULL, '2024-01-05', '2', NULL, 27, 1, 1, '2023-09-22 13:39:11', '2023-09-27 10:27:38'),
(126, 19, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-22 13:54:21', '2023-09-22 13:54:21'),
(127, 19, '1695840111_FACTURA PAS-01 TRANSIT KOMBI MWB 2.2 WF0RT49H49JA35775.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 1, '2023-09-22 13:54:21', '2023-09-27 12:41:51'),
(128, 19, '1697755610_FOTO DE PLACAS PAS-01 TRANSIT KOMBI MWB 2.2 WF0RT49H49JA35775.pdf', NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-22 13:54:21', '2023-10-19 16:46:50'),
(129, 19, '1697755610_FOTO DE VIN PAS-01 TRANSIT KOMBI MWB 2.2 WF0RT49H49JA35775.pdf', NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-22 13:54:21', '2023-10-19 16:46:50'),
(130, 19, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-22 13:54:21', '2023-09-22 13:54:21'),
(131, 19, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-22 13:54:21', '2023-09-22 13:54:21'),
(132, 19, '1695840111_REFRENDO PAS-01 TRANSIT KOMBI MWB 2.2 WF0RT49H49JA35775.pdf', NULL, '2024-01-05', '2', NULL, 27, 1, 1, '2023-09-22 13:54:21', '2023-09-27 12:41:51'),
(133, 19, '1695840111_SEGURO PAS-01 TRANSIT KOMBI MWB 2.2 WF0RT49H49JA35775.pdf', NULL, '2024-06-18', '2', NULL, 5, 1, 1, '2023-09-22 13:54:21', '2023-09-27 12:41:51'),
(134, 19, '1695667892_TARJETA DE CIRCULACIÓN PAS-01 TRANSIT KOMBI MWB 2.2 WF0RT49H49JA35775.pdf', NULL, '2026-10-25', '2', NULL, 6, 1, 1, '2023-09-22 13:54:21', '2023-09-25 12:51:32'),
(135, 19, '1697755610_VERIFICACIÓN PAS-01 TRANSIT KOMBI MWB 2.2 WF0RT49H49JA35775.pdf', NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-22 13:54:21', '2023-10-19 17:11:22'),
(146, 1, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-24 16:44:49', '2023-09-24 16:44:49'),
(147, 1, '1695663894_SEGURO SER-02 KANGOO EXPRESS AC 1.6 TM 8A1FCJ59EL099276.pdf', NULL, '2023-11-27', '1', NULL, 5, 1, 1, '2023-09-24 16:44:49', '2023-09-27 12:02:11'),
(148, 1, '1695663894_TARJETA DE CIRCULACIÓN SER-02 KANGOO EXPRESS AC 1.6 TM 8A1FCJ59EL099276.pdf', NULL, '2026-10-25', '2', NULL, 6, 1, 1, '2023-09-24 16:44:49', '2023-09-25 11:44:54'),
(149, 1, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-24 16:44:49', '2023-09-24 16:44:49'),
(150, 1, '1695837731_FACTURA SER-02 KANGOO EXPRESS AC 1.6 TM 8A1FCJ59EL099276.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 1, '2023-09-24 16:44:49', '2023-09-27 12:02:11'),
(151, 1, '1695663894_VERIFICACIÓN SER-02 KANGOO EXPRESS AC 1.6 TM 8A1FCJ59EL099276.pdf', NULL, '2024-09-03', '2', NULL, 23, 1, 1, '2023-09-24 16:44:49', '2023-09-25 11:44:54'),
(152, 1, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-24 16:44:49', '2023-09-24 16:44:49'),
(153, 1, '1697819081_FOTO PLACAS SER-02 KANGOO EXPRESS AC 1.6 TM 8A1FCJ59EL099276.pdf', NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-24 16:44:49', '2023-10-20 10:24:41'),
(154, 1, '1697819081_FOTO VIN SER-02 KANGOO EXPRESS AC 1.6 TM 8A1FCJ59EL099276.pdf', NULL, '0000-00-00', '2', NULL, 26, 1, 1, '2023-09-24 16:44:49', '2023-10-20 10:24:41'),
(155, 1, '1695837731_REFRENDO SER-02 KANGOO EXPRESS AC 1.6 TM 8A1FCJ59EL099276.pdf', NULL, '2024-01-05', '2', NULL, 27, 1, 1, '2023-09-24 16:44:49', '2023-09-27 12:02:11'),
(156, 5, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-25 16:29:20', '2023-09-25 16:29:20'),
(157, 5, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-25 16:29:20', '2023-09-25 16:29:20'),
(158, 5, '1695682709_PLACAS VOL-02 TRACTOCAMIÓN VOLTEO 7MTS 1HSHWAHN56J256815.pdf', NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-25 16:29:20', '2023-09-26 16:23:31'),
(159, 5, NULL, NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-25 16:29:20', '2023-09-25 16:29:20'),
(160, 5, '1695843648_REFRENDO VOL-02 TRACTOCAMIÓN VOLTEO 7MTS 1HSHWAHN56J256815.pdf', NULL, '2024-01-10', '1', NULL, 27, 1, 1, '2023-09-25 16:29:20', '2023-11-22 17:12:43'),
(166, 21, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-25 17:13:07', '2023-09-25 17:13:07'),
(167, 21, '1695844180_FACTURA VOL-03 TRACTOCAMIÓN VOLTEO 14MTS 1HSHWAHN86J236896.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 1, '2023-09-25 17:13:07', '2023-09-27 13:49:40'),
(168, 21, '1695684939_PLACAS VOL-03 TRACTOCAMIÓN VOLTEO 14MTS 1HSHWAHN86J236896.pdf', NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-25 17:13:07', '2023-09-25 17:37:19'),
(169, 21, '1697822241_FOTO VIN VOL-03 TRACTOCAMIÓN VOLTEO 14MTS 1HSHWAHN86J236896.pdf', NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-25 17:13:07', '2023-11-22 17:44:45'),
(170, 21, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-25 17:13:07', '2023-09-25 17:13:07'),
(171, 21, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-25 17:13:07', '2023-09-25 17:13:07'),
(172, 21, '1695844180_REFRENDO VOL-03 TRACTOCAMIÓN VOLTEO 14MTS 1HSHWAHN86J236896.pdf', NULL, '2024-01-10', '1', NULL, 27, 1, 1, '2023-09-25 17:13:07', '2023-11-22 17:44:45'),
(173, 21, '1700696685_SEGURO VOL-03 TRACTOCAMIÓN VOLTEO 14MTS 1HSHWAHN86J236896 (2).pdf', NULL, '2024-10-27', '2', NULL, 5, 1, 1, '2023-09-25 17:13:07', '2023-11-22 17:44:45'),
(174, 21, '1695684939_TARJETA DE CIRCULACIÓN VOL-03 TRACTOCAMIÓN VOLTEO 14MTS 1HSHWAHN86J236896.pdf', NULL, '2026-10-31', '2', NULL, 6, 1, 1, '2023-09-25 17:13:07', '2023-09-25 17:35:39'),
(175, 21, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-25 17:13:07', '2023-09-25 17:13:07'),
(176, 22, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-26 17:04:21', '2023-09-26 17:04:21'),
(177, 22, '1695838129_FACTURA GRU-01 TRACTOCAMIÓN GRUA T370 3WKHDN9X6DF380832.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 0, '2023-09-26 17:04:21', '2023-09-27 12:08:49'),
(178, 22, '1697753908_FOTO PLACAS GRU-01 TRACTOCAMIÓN GRUA T370 3WKHDN9X6DF380832.pdf', NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-26 17:04:21', '2023-11-22 17:21:19'),
(179, 22, NULL, NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-26 17:04:21', '2023-09-26 17:04:21'),
(180, 22, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-26 17:04:21', '2023-09-26 17:04:21'),
(181, 22, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-26 17:04:21', '2023-09-26 17:04:21'),
(182, 22, '1695838129_REFRENDO GRU-01 TRACTOCAMIÓN GRUA T370 3WKHDN9X6DF380832.pdf', NULL, '2024-01-05', '1', NULL, 27, 1, 1, '2023-09-26 17:04:21', '2023-11-22 17:21:19'),
(183, 22, '1697657768_SEGURO ACTUAL GRU-01 TRACTOCAMIÓN GRUA T370 3WKHDN9X6DF380832.pdf', NULL, '2024-10-06', '2', NULL, 5, 1, 1, '2023-09-26 17:04:21', '2023-10-18 13:36:08'),
(184, 22, '1697753908_TARJETA DE CIRCULACIÓN GRU-01 TRACTOCAMIÓN GRUA T370 3WKHDN9X6DF380832.pdf', NULL, '2025-12-02', '2', NULL, 6, 1, 1, '2023-09-26 17:04:21', '2023-10-19 16:18:28'),
(185, 22, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-26 17:04:21', '2023-09-26 17:04:21'),
(186, 23, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-27 16:48:58', '2023-09-27 16:48:58'),
(187, 23, '1695854938_FACTURA REM-05 REMOLQUE MOTOS IMDFHJ122AAI89221.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 0, '2023-09-27 16:48:58', '2023-09-27 16:49:19'),
(188, 23, NULL, NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-27 16:48:58', '2023-09-27 16:48:58'),
(189, 23, NULL, NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-27 16:48:58', '2023-09-27 16:48:58'),
(190, 23, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-27 16:48:58', '2023-09-27 16:48:58'),
(191, 23, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-27 16:48:58', '2023-09-27 16:48:58'),
(192, 23, '1695854938_REFRENDO REM-05 REMOLQUE MOTOS IMDFHJ122AAI89221.pdf', NULL, '2024-01-05', '2', NULL, 27, 1, 1, '2023-09-27 16:48:58', '2023-09-27 16:49:19'),
(193, 23, '1695854938_SEGURO REM-05 REMOLQUE MOTOS IMDFHJ122AAI89221.pdf', NULL, '2024-01-17', '2', NULL, 5, 1, 1, '2023-09-27 16:48:58', '2023-09-27 16:49:19'),
(194, 23, '1695854938_TARJETA DE CIRCULACIÓN REM-05 REMOLQUE MOTOS IMDFHJ122AAI89221.pdf', NULL, '2025-11-01', '2', NULL, 6, 1, 1, '2023-09-27 16:48:58', '2023-09-27 16:49:19'),
(195, 23, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-27 16:48:58', '2023-09-27 16:48:58'),
(196, 24, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-27 17:43:28', '2023-09-27 17:43:28'),
(197, 24, '1695858923_FACTURA EXC-01 MINIEXCAVADORA YMRVI017VNBJ13067.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 1, '2023-09-27 17:43:28', '2023-10-04 10:20:25'),
(198, 24, NULL, NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-27 17:43:28', '2023-09-27 17:43:28'),
(199, 24, NULL, NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-27 17:43:28', '2023-09-27 17:43:28'),
(200, 24, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-27 17:43:28', '2023-09-27 17:43:28'),
(201, 24, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-27 17:43:28', '2023-09-27 17:43:28'),
(202, 24, NULL, NULL, '0000-00-00', '0', NULL, 27, 1, 1, '2023-09-27 17:43:28', '2023-09-27 17:43:28'),
(203, 24, '1695858869_SEGURO EXC-01 MINIEXCAVADORA YMRVI017VNBJ13067.pdf', NULL, '2023-11-03', '1', NULL, 5, 1, 1, '2023-09-27 17:43:28', '2023-09-27 17:54:29'),
(204, 24, NULL, NULL, '0000-00-00', '0', NULL, 6, 1, 1, '2023-09-27 17:43:28', '2023-09-27 17:43:28'),
(205, 24, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-27 17:43:28', '2023-09-27 17:43:28'),
(206, 25, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-28 13:47:14', '2023-09-28 13:47:14'),
(207, 25, '1695930434_FACTURA ROD-01 RODILLO DOBLE ARTICULADO WNCRD12ACPUM02150.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 0, '2023-09-28 13:47:14', '2023-09-28 13:48:04'),
(208, 25, NULL, NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-28 13:47:14', '2023-09-28 13:47:14'),
(209, 25, NULL, NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-28 13:47:14', '2023-09-28 13:47:14'),
(210, 25, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-28 13:47:14', '2023-09-28 13:47:14'),
(211, 25, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-28 13:47:14', '2023-09-28 13:47:14'),
(212, 25, NULL, NULL, '0000-00-00', '0', NULL, 27, 1, 1, '2023-09-28 13:47:14', '2023-09-28 13:47:14'),
(213, 25, '1695930434_SEGURO ROD-01 RODILLO DOBLE ARTICULADO WNCRD12ACPUM02150.pdf', NULL, '2024-08-24', '2', NULL, 5, 1, 1, '2023-09-28 13:47:14', '2023-09-28 13:48:04'),
(214, 25, NULL, NULL, '0000-00-00', '0', NULL, 6, 1, 1, '2023-09-28 13:47:14', '2023-09-28 13:47:14'),
(215, 25, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-28 13:47:14', '2023-09-28 13:47:14'),
(216, 26, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-28 16:41:16', '2023-09-28 16:41:16'),
(217, 26, '1695940876_FACTURA CAR-01 MINICARGADOR BOBCAT A3NT19781.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 0, '2023-09-28 16:41:16', '2023-09-28 16:41:33'),
(218, 26, NULL, NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-28 16:41:16', '2023-09-28 16:41:16'),
(219, 26, '1697745951_FOTO VIN CAR-01 MINICARGADOR BOBCAT A3NT19781.pdf', NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-28 16:41:16', '2023-12-26 16:45:46'),
(220, 26, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-28 16:41:16', '2023-09-28 16:41:16'),
(221, 26, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-28 16:41:16', '2023-09-28 16:41:16'),
(222, 26, NULL, NULL, '0000-00-00', '0', NULL, 27, 1, 1, '2023-09-28 16:41:16', '2023-09-28 16:41:16'),
(223, 26, '1695940876_SEGURO CAR-01 MINICARGADOR BOBCAT A3NT19781.pdf', NULL, '2024-08-24', '2', NULL, 5, 1, 1, '2023-09-28 16:41:16', '2023-09-28 16:41:33'),
(224, 26, NULL, NULL, '0000-00-00', '0', NULL, 6, 1, 1, '2023-09-28 16:41:16', '2023-09-28 16:41:16'),
(225, 26, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-28 16:41:16', '2023-09-28 16:41:16'),
(226, 27, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-29 12:15:21', '2023-09-29 12:15:21'),
(227, 27, '1696011321_FACTURA LUZ-01 TORRE DE ILUMINACIÓN RL4J145.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 0, '2023-09-29 12:15:21', '2023-09-29 12:15:42'),
(228, 27, NULL, NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-29 12:15:21', '2023-09-29 12:15:21'),
(229, 27, NULL, NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-29 12:15:21', '2023-09-29 12:15:21'),
(230, 27, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-29 12:15:21', '2023-09-29 12:15:21'),
(231, 27, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-29 12:15:21', '2023-09-29 12:15:21'),
(232, 27, NULL, NULL, '0000-00-00', '0', NULL, 27, 1, 1, '2023-09-29 12:15:21', '2023-09-29 12:15:21'),
(233, 27, NULL, NULL, '0000-00-00', '0', NULL, 5, 1, 1, '2023-09-29 12:15:21', '2023-09-29 12:15:21'),
(234, 27, NULL, NULL, '0000-00-00', '0', NULL, 6, 1, 1, '2023-09-29 12:15:21', '2023-09-29 12:15:21'),
(235, 27, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-29 12:15:21', '2023-09-29 12:15:21'),
(236, 28, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-29 13:40:29', '2023-09-29 13:40:29'),
(237, 28, '1696016429_FACTURA RET-03 RETROEXCAVADORA 310L 1BZ310LALJC001403.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 0, '2023-09-29 13:40:29', '2023-09-29 13:41:30'),
(238, 28, NULL, NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-29 13:40:29', '2023-09-29 13:40:29'),
(239, 28, '1697817139_FOTO VIN RET-03 RETROEXCAVADORA 310L 1BZ310LALJC001403.pdf', NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-29 13:40:29', '2023-10-20 09:52:19'),
(240, 28, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-29 13:40:29', '2023-09-29 13:40:29'),
(241, 28, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-29 13:40:29', '2023-09-29 13:40:29'),
(242, 28, NULL, NULL, '0000-00-00', '0', NULL, 27, 1, 1, '2023-09-29 13:40:29', '2023-09-29 13:40:29'),
(243, 28, '1704910420_Pol 73-2504 Retroexcav 2018 24-25.pdf', NULL, '2025-01-11', '2', NULL, 5, 1, 1, '2023-09-29 13:40:29', '2024-01-10 12:13:40'),
(244, 28, NULL, NULL, '0000-00-00', '0', NULL, 6, 1, 1, '2023-09-29 13:40:29', '2023-09-29 13:40:29'),
(245, 28, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-29 13:40:29', '2023-09-29 13:40:29'),
(246, 29, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-29 16:19:32', '2023-09-29 16:19:32'),
(247, 29, '1696025972_FACTURA RET-04 RETROEXCAVADORA 310L 1T0310LXAHC308643.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 0, '2023-09-29 16:19:32', '2023-09-29 16:22:49'),
(248, 29, NULL, NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-29 16:19:32', '2023-09-29 16:19:32'),
(249, 29, NULL, NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-29 16:19:32', '2023-09-29 16:19:32'),
(250, 29, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-29 16:19:32', '2023-09-29 16:19:32'),
(251, 29, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-29 16:19:32', '2023-09-29 16:19:32'),
(252, 29, NULL, NULL, '0000-00-00', '0', NULL, 27, 1, 1, '2023-09-29 16:19:32', '2023-09-29 16:19:32'),
(253, 29, '1696025972_SEGURO RET-04 RETROEXCAVADORA 310L 1T0310LXAHC308643.pdf', NULL, '2024-06-30', '2', NULL, 5, 1, 1, '2023-09-29 16:19:32', '2023-10-12 08:11:05'),
(254, 29, NULL, NULL, '0000-00-00', '0', NULL, 6, 1, 1, '2023-09-29 16:19:32', '2023-09-29 16:19:32'),
(255, 29, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-29 16:19:32', '2023-09-29 16:19:32'),
(256, 30, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-29 16:56:55', '2023-09-29 16:56:55'),
(257, 30, '1696028215_FACTURA RET-02 RETROEXCAVADORA 3CX JCB3CX4TL02444935.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 0, '2023-09-29 16:56:55', '2023-09-29 16:57:16'),
(258, 30, NULL, NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-29 16:56:55', '2023-09-29 16:56:55'),
(259, 30, NULL, NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-29 16:56:55', '2023-09-29 16:56:55'),
(260, 30, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-29 16:56:55', '2023-09-29 16:56:55'),
(261, 30, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-29 16:56:55', '2023-09-29 16:56:55'),
(262, 30, NULL, NULL, '0000-00-00', '0', NULL, 27, 1, 1, '2023-09-29 16:56:55', '2023-09-29 16:56:55'),
(263, 30, '1696028215_SEGURO RET-02 RETROEXCAVADORA 3CX JCB3CX4TL02444935.pdf', NULL, '2024-06-23', '2', NULL, 5, 1, 1, '2023-09-29 16:56:55', '2023-09-29 16:57:16'),
(264, 30, NULL, NULL, '0000-00-00', '0', NULL, 6, 1, 1, '2023-09-29 16:56:55', '2023-09-29 16:56:55'),
(265, 30, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-29 16:56:55', '2023-09-29 16:56:55'),
(266, 31, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-09-29 17:26:38', '2023-09-29 17:26:38'),
(267, 31, '1696029998_FACTURA RET-01 MINIRETROEXCAVADORA 1CX JCB1CXWSH01744848.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 0, '2023-09-29 17:26:38', '2023-09-29 17:27:23'),
(268, 31, NULL, NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-09-29 17:26:38', '2023-09-29 17:26:38'),
(269, 31, NULL, NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-09-29 17:26:38', '2023-09-29 17:26:38'),
(270, 31, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-09-29 17:26:38', '2023-09-29 17:26:38'),
(271, 31, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-09-29 17:26:38', '2023-09-29 17:26:38'),
(272, 31, NULL, NULL, '0000-00-00', '0', NULL, 27, 1, 1, '2023-09-29 17:26:38', '2023-09-29 17:26:38'),
(273, 31, '1705338930_Pol 73-2505 Miniretro JCB 2015 s744848 24-25[1].pdf', NULL, '2025-01-17', '2', NULL, 5, 1, 1, '2023-09-29 17:26:38', '2024-01-15 11:15:30'),
(274, 31, NULL, NULL, '0000-00-00', '0', NULL, 6, 1, 1, '2023-09-29 17:26:38', '2023-09-29 17:26:38'),
(275, 31, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-09-29 17:26:38', '2023-09-29 17:26:38'),
(276, 32, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-10-02 12:53:13', '2023-10-02 12:53:13'),
(277, 32, '1696272793_FACTURA BOM-01 BOMBA DE CONCRETO SCHWING.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 0, '2023-10-02 12:53:13', '2023-10-02 12:53:48'),
(278, 32, NULL, NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-10-02 12:53:13', '2023-10-02 12:53:13'),
(279, 32, NULL, NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-10-02 12:53:13', '2023-10-02 12:53:13'),
(280, 32, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-10-02 12:53:13', '2023-10-02 12:53:13'),
(281, 32, '1696517307_Ticket Q2ces.pdf', NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-10-02 12:53:13', '2023-10-05 13:48:33'),
(282, 32, '1696272793_REFRENDO BOM-01 BOMBA DE CONCRETO SCHWING.pdf', NULL, '2024-01-03', '1', NULL, 27, 1, 1, '2023-10-02 12:53:13', '2023-11-08 08:37:18'),
(283, 32, NULL, NULL, '0000-00-00', '0', NULL, 5, 1, 1, '2023-10-02 12:53:13', '2023-10-02 12:53:13'),
(284, 32, '1696272793_TARJETA DE CIRCULACIÓN BOM-01 BOMBA DE CONCRETO SCHWING.pdf', NULL, '2025-01-28', '2', NULL, 6, 1, 1, '2023-10-02 12:53:13', '2023-10-02 12:53:48'),
(285, 32, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-10-02 12:53:13', '2023-10-02 12:53:13'),
(286, 33, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-10-02 13:18:28', '2023-10-02 13:18:28'),
(287, 33, '1696274485_FACTURA LUZ-02 LIGHTING TOWER TORRE DE ILUMINACIÓN 1405465.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 1, '2023-10-02 13:18:28', '2023-10-02 13:30:17'),
(288, 33, NULL, NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-10-02 13:18:28', '2023-10-02 13:18:28'),
(289, 33, NULL, NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-10-02 13:18:28', '2023-10-02 13:18:28'),
(290, 33, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-10-02 13:18:28', '2023-10-02 13:18:28'),
(291, 33, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-10-02 13:18:28', '2023-10-02 13:18:28'),
(292, 33, NULL, NULL, '0000-00-00', '0', NULL, 27, 1, 1, '2023-10-02 13:18:28', '2023-10-02 13:18:28'),
(293, 33, NULL, NULL, '0000-00-00', '0', NULL, 5, 1, 1, '2023-10-02 13:18:28', '2023-10-02 13:18:28'),
(294, 33, NULL, NULL, '0000-00-00', '0', NULL, 6, 1, 1, '2023-10-02 13:18:28', '2023-10-02 13:18:28'),
(295, 33, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-10-02 13:18:28', '2023-10-02 13:18:28'),
(296, 34, NULL, NULL, '0000-00-00', '0', NULL, 24, 1, 1, '2023-10-02 17:03:11', '2023-10-02 17:03:11'),
(297, 34, '1696287791_FACTURA PLA-01 PLANTA ELECTRICA 3JRP1D210C1AAA616.pdf', NULL, '0000-00-00', '0', NULL, 8, 1, 0, '2023-10-02 17:03:11', '2023-10-02 17:03:35'),
(298, 34, '1697758094_FOTO PLACAS PLA-01 PLANTA ELECTRICA 3JRP1D210C1AAA616.pdf', NULL, '0000-00-00', '0', NULL, 25, 1, 1, '2023-10-02 17:03:11', '2023-10-19 17:28:14'),
(299, 34, '1697758094_FOTO VIN PLA-01 PLANTA ELECTRICA 3JRP1D210C1AAA616.pdf', NULL, '0000-00-00', '0', NULL, 26, 1, 1, '2023-10-02 17:03:11', '2023-10-19 17:28:14'),
(300, 34, NULL, NULL, '0000-00-00', '0', NULL, 7, 1, 1, '2023-10-02 17:03:11', '2023-10-02 17:03:11'),
(301, 34, NULL, NULL, '0000-00-00', '0', NULL, 4, 1, 1, '2023-10-02 17:03:11', '2023-10-02 17:03:11'),
(302, 34, '1696287791_REFRENDO PLA-01 PLANTA ELECTRICA 3JRP1D210C1AAA616.pdf', NULL, '2024-01-03', '2', NULL, 27, 1, 1, '2023-10-02 17:03:11', '2023-10-02 17:03:35'),
(303, 34, '1696287791_SEGURO PLA-01 PLANTA ELECTRICA 3JRP1D210C1AAA616.pdf', NULL, '2024-02-09', '2', NULL, 5, 1, 1, '2023-10-02 17:03:11', '2023-10-02 17:03:35'),
(304, 34, '1696287791_TARJETA DE CIRCULACIÓN PLA-01 PLANTA ELECTRICA 3JRP1D210C1AAA616.pdf', NULL, '2025-01-28', '2', NULL, 6, 1, 1, '2023-10-02 17:03:11', '2023-10-02 17:03:35'),
(305, 34, NULL, NULL, '0000-00-00', '0', NULL, 23, 1, 1, '2023-10-02 17:03:11', '2023-10-02 17:03:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maqimagen`
--

DROP TABLE IF EXISTS `maqimagen`;
CREATE TABLE IF NOT EXISTS `maqimagen` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `maquinariaId` bigint(20) UNSIGNED NOT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_maqimagen_maquinariaId` (`maquinariaId`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `maqimagen`
--

INSERT INTO `maqimagen` (`id`, `maquinariaId`, `ruta`) VALUES
(8, 10, '1695318416_IMG_6221.JPG'),
(12, 5, '1695681438_IMG_6253.JPG'),
(13, 5, '1695681455_IMG_6254.JPG'),
(16, 5, '1695681656_IMG_6249.JPG'),
(17, 5, '1695681656_IMG_6316.JPG'),
(19, 7, '1695682005_ccxcxvcv.svg'),
(21, 21, '1695683655_IMG_6194.JPG'),
(22, 21, '1695683655_IMG_6196.JPG'),
(23, 21, '1695683655_IMG_6199.JPG'),
(24, 21, '1695683655_IMG_6208.JPG'),
(25, 10, '1695739273_IMG_6294.JPG'),
(26, 10, '1695739273_IMG_6297.JPG'),
(27, 10, '1695739273_REMOLQUE ARCE TIPO PLATAFORMA.JPG'),
(31, 24, '1695858869_IMG_6173.jpg'),
(32, 24, '1695858869_IMG_6186.jpg'),
(33, 24, '1695858869_IMG_6189.jpg'),
(34, 24, '1695858869_IMG_6207.jpg'),
(35, 24, '1695858869_IMG_6233.jpg'),
(36, 13, '1696376871_IMG_6317.JPG'),
(37, 13, '1696376871_IMG_6324.JPG'),
(38, 13, '1696376871_IMG_6334.JPG'),
(39, 13, '1696376871_IMG_6343.JPG'),
(49, 26, '1697745799_CAR-01(1).jpg'),
(50, 26, '1697745799_CAR-01(2).jpg'),
(51, 26, '1697745799_CAR-01(3).jpg'),
(52, 26, '1697745799_CAR-01(4).jpg'),
(53, 26, '1697745799_CAR-01.jpg'),
(54, 22, '1697753908_GRU-01(1).jpg'),
(55, 22, '1697753908_GRU-01(2).jpg'),
(56, 22, '1697753908_GRU-01(3).jpg'),
(57, 22, '1697753908_GRU-01(4).jpg'),
(58, 22, '1697753908_GRU-01.jpg'),
(59, 19, '1697755488_PAS-01(3).jpg'),
(60, 19, '1697755610_PAS-01(2).jpg'),
(61, 19, '1697755610_PAS-01(4).jpg'),
(62, 19, '1697755610_PAS-01(5).jpg'),
(63, 19, '1697755610_PAS-01.jpg'),
(68, 15, '1697757116_PIP-01(1).jpg'),
(69, 15, '1697757134_PIP-01(2).jpg'),
(70, 15, '1697757134_PIP-01(3).jpg'),
(71, 15, '1697757134_PIP-01(4).jpg'),
(72, 15, '1697757134_PIP-01.jpg'),
(73, 34, '1697757937_PLA-01(5).jpg'),
(74, 34, '1697758094_PLA-01(1).jpg'),
(75, 34, '1697758094_PLA-01(2).jpg'),
(76, 34, '1697758094_PLA-01(3).jpg'),
(77, 34, '1697758094_PLA-01.jpg'),
(78, 14, '1697759529_REM-02.jpg'),
(79, 11, '1697812289_REM-03(1).jpg'),
(80, 11, '1697812289_REM-03.jpg'),
(81, 23, '1697812781_REM-05(1).jpg'),
(82, 23, '1697812781_REM-05.jpg'),
(83, 28, '1697817139_RET-03.jpg'),
(84, 16, '1697818269_SER-01(5).jpg'),
(85, 16, '1697818420_SER-01(1).jpg'),
(86, 16, '1697818420_SER-01(2).jpg'),
(87, 16, '1697818420_SER-01(3).jpg'),
(88, 16, '1697818420_SER-01.jpg'),
(89, 1, '1697818933_SER-02(6).jpg'),
(90, 1, '1697819081_SER-02(1).jpg'),
(91, 1, '1697819081_SER-02(2).jpg'),
(92, 1, '1697819081_SER-02(4).jpg'),
(93, 1, '1697819081_SER-02(5).jpg'),
(94, 17, '1697820782_SER-03(5).jpg'),
(96, 17, '1697820949_SER-03(1).jpg'),
(97, 17, '1697820949_SER-03(2).jpg'),
(98, 17, '1697820949_SER-03(3).jpg'),
(99, 8, '1697821630_SER-04(5).jpg'),
(100, 8, '1697821746_SER-04(1).jpg'),
(101, 8, '1697821746_SER-04(2).jpg'),
(102, 8, '1697821746_SER-04(3).jpg'),
(103, 8, '1697821746_SER-04(6).jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinaria`
--

DROP TABLE IF EXISTS `maquinaria`;
CREATE TABLE IF NOT EXISTS `maquinaria` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `estatusId` bigint(20) UNSIGNED DEFAULT NULL,
  `bitacoraId` bigint(20) UNSIGNED DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `identificador` varchar(32) DEFAULT NULL,
  `tipoId` bigint(20) UNSIGNED DEFAULT NULL,
  `categoriaId` bigint(20) UNSIGNED DEFAULT NULL,
  `marcaId` bigint(20) UNSIGNED DEFAULT NULL,
  `submarca` varchar(255) DEFAULT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `uso` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `placas` varchar(255) DEFAULT NULL,
  `motor` varchar(255) DEFAULT NULL,
  `nummotor` varchar(255) DEFAULT NULL,
  `numserie` varchar(255) DEFAULT NULL,
  `vin` varchar(255) DEFAULT NULL,
  `capacidad` varchar(255) DEFAULT NULL,
  `combustible` varchar(255) DEFAULT NULL,
  `tanque` int(11) DEFAULT NULL,
  `ejes` varchar(255) DEFAULT NULL,
  `rinD` varchar(255) DEFAULT NULL,
  `rinT` varchar(255) DEFAULT NULL,
  `llantaD` varchar(255) DEFAULT NULL,
  `llantaT` varchar(255) DEFAULT NULL,
  `aceitemotor` varchar(255) DEFAULT NULL,
  `aceitetras` varchar(255) DEFAULT NULL,
  `aceitehidra` varchar(255) DEFAULT NULL,
  `aceitedirec` varchar(255) DEFAULT NULL,
  `filtroaceite` varchar(255) DEFAULT NULL,
  `filtroaire` varchar(255) DEFAULT NULL,
  `bujias` varchar(255) DEFAULT NULL,
  `tipobujia` varchar(255) DEFAULT NULL,
  `horometro` int(11) DEFAULT NULL,
  `kilometraje` int(11) DEFAULT NULL,
  `kom` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `foto2` varchar(255) DEFAULT NULL,
  `foto3` varchar(255) DEFAULT NULL,
  `foto4` varchar(255) DEFAULT NULL,
  `cisterna` int(1) DEFAULT NULL,
  `cisternaNivel` float(10,2) DEFAULT NULL,
  `compania` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `categoria` varchar(250) NOT NULL,
  `marca` varchar(250) DEFAULT NULL,
  `tipo` varchar(250) DEFAULT NULL,
  `mantenimiento` int(11) DEFAULT '0',
  `frente` varchar(250) DEFAULT NULL,
  `izquierdo` varchar(250) DEFAULT NULL,
  `derecho` varchar(250) DEFAULT NULL,
  `trasero` varchar(250) DEFAULT NULL,
  `grasas` varchar(250) DEFAULT NULL,
  `anticongelante` varchar(255) DEFAULT NULL,
  `otroCombustible` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_maquinaria_maquinariaEstatusId` (`estatusId`),
  KEY `FK_maquinaria_bitacoraId` (`bitacoraId`),
  KEY `FK_maquinaria_categoriaId` (`categoriaId`),
  KEY `FK_maquinaria_marcaId` (`marcaId`),
  KEY `FK_maquinaria_tipoId` (`tipoId`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `maquinaria`
--

INSERT INTO `maquinaria` (`id`, `estatusId`, `bitacoraId`, `nombre`, `alias`, `identificador`, `tipoId`, `categoriaId`, `marcaId`, `submarca`, `modelo`, `ano`, `uso`, `color`, `placas`, `motor`, `nummotor`, `numserie`, `vin`, `capacidad`, `combustible`, `tanque`, `ejes`, `rinD`, `rinT`, `llantaD`, `llantaT`, `aceitemotor`, `aceitetras`, `aceitehidra`, `aceitedirec`, `filtroaceite`, `filtroaire`, `bujias`, `tipobujia`, `horometro`, `kilometraje`, `kom`, `foto`, `foto2`, `foto3`, `foto4`, `cisterna`, `cisternaNivel`, `compania`, `created_at`, `updated_at`, `categoria`, `marca`, `tipo`, `mantenimiento`, `frente`, `izquierdo`, `derecho`, `trasero`, `grasas`, `anticongelante`, `otroCombustible`) VALUES
(1, 1, NULL, 'Renault Kangoo', NULL, 'SER-02', 5, 3, 18, NULL, 'Express AC 1.6 TM', 2014, 'Utilitario', 'Blanco', 'JT-64-337', NULL, 'Q118143', '8A1FCJ59EL099276', NULL, '800', 'Gasolina', 50, '2', '14', '14', '2', '2', '3', '0', '0', '0', NULL, NULL, NULL, NULL, 65, 58552, 'Km', NULL, NULL, NULL, NULL, 1, 600.00, NULL, '2023-08-25 16:50:03', '2024-01-16 16:21:56', '', NULL, NULL, 66676, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, NULL, 'Volteo 7MTS International', NULL, 'VOL-02', 6, 7, 16, NULL, '8600', 2006, 'Mov. Tierras', 'Blanco', 'JY-01-292', NULL, '35132768', '1HSHWAHN56J256815', NULL, '24493', 'Diesel', 757, '2', '22', '22', '2', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 606889, 'Mi', NULL, NULL, NULL, NULL, 0, 110.00, NULL, '2023-08-29 00:12:07', '2024-01-16 09:28:08', '', NULL, NULL, 610957, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, NULL, 'Jeep Grand Cherokee', NULL, 'SER-04', 2, 9, 21, NULL, 'Overland 4X4', 2011, 'Utilitario', 'Blanco', 'JKA-4241', '5.7 L V-8 VCT MDS', '', '1J4RR6GT7BC739202', NULL, NULL, 'Gasolina', 80, '2', '18', '18', '2', '2', '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 71309, 'Km', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2023-09-15 17:46:44', '2023-11-29 11:26:31', '', NULL, NULL, 81309, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, NULL, 'Remolque Chico', NULL, 'REM-01', 5, 11, 19, NULL, 'Remolque Tipo Plataforma', 2022, 'Utilitario', 'Gris', '1-HH-6867', NULL, '', '3J9SBPD21NG055572', NULL, '3500', NULL, NULL, '2', '15', '15', '2', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Km', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2023-09-21 11:15:58', '2023-10-10 12:56:47', '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, NULL, 'Remolque de Herramientas', NULL, 'REM-03', 5, 11, 23, NULL, 'Taller Camión Orquesta', 2020, 'Utilitario', 'Blanco', '2-HH-2774', NULL, '', '3M9B3DFL6L1097102', NULL, '3000', NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Km', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2023-09-21 12:15:19', '2023-10-10 12:57:32', '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, NULL, 'Food Truck Quisine', NULL, 'REM-04', 5, 10, 23, NULL, 'Food Truck Quisine', 2020, 'Utilitario', 'Blanco', '2-HH-2775', NULL, '', '3M9A2CFJ3L1097100', NULL, '1500', NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Km', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2023-09-21 12:36:35', '2023-10-10 12:57:49', '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 1, NULL, 'Volteo 14MTS Volvo', NULL, 'VOL-01', 6, 7, 1, NULL, 'Chasis Cabina 6x4 Torthon', 2020, 'Mov. Tierras', 'Blanco', 'JW-99-296', NULL, '79347527', '3R9CH1210LA182203', NULL, '24000', 'Diesel', NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 875415, 'Mi', NULL, NULL, NULL, NULL, 0, 130.00, NULL, '2023-09-21 13:49:13', '2024-01-11 08:41:32', '', NULL, NULL, 881056, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 1, NULL, 'Remolque Plataforma', NULL, 'REM-02', 5, 11, 1, NULL, 'Tipo Cama Baja 7.50MTS', 2020, 'Utilitario', 'Gris', '2-HH-2161', NULL, '', '3R9B124D6LL054033', NULL, '4000', NULL, NULL, '2', '24', '24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Km', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2023-09-21 17:43:07', '2023-10-10 12:57:04', '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 1, NULL, 'Pipa de Agua International', NULL, 'PIP-01', 6, 7, 1, NULL, 'International 8600', 2019, 'Mov. Tierras', 'Blanco', 'JW-99-337', NULL, '35133676', '3R9CH1219KA182148', NULL, '20000', 'Diesel', NULL, '3', NULL, NULL, '2', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 894067, 'Mi', NULL, NULL, NULL, NULL, 0, 42.00, NULL, '2023-09-22 10:02:14', '2024-01-16 09:23:17', '', NULL, NULL, 903265, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 1, NULL, 'Camión Orquesta RAM 4000', NULL, 'SER-01', 5, 3, 15, NULL, 'Chasis Cabina RAM 4000P 4X2', 2017, 'Utilitario', 'Blanco', 'JV-61-285', '5.7L HEMI V8', '', '3C7WRAHT7HG705134', NULL, '3494', 'Gasolina', 197, NULL, '17', '17', '2', '4', '12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, 73255, 'Km', NULL, NULL, NULL, NULL, 1, 0.00, NULL, '2023-09-22 10:21:16', '2024-01-11 17:39:34', '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 1, NULL, 'Toyota Hilux Taller', NULL, 'SER-03', 5, 9, 11, NULL, 'Doble Cabina MID', 2016, 'Utilitario', 'Blanco', 'JV-02-372', NULL, '2TR-A096942', 'MR0EX8DD9G0245825', NULL, NULL, 'Gasolina', 80, NULL, '17', '17', '2', '2', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 147704, 'Km', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2023-09-22 12:12:04', '2023-12-04 09:02:05', '', NULL, NULL, 157704, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 1, NULL, 'Ford Transit', NULL, 'PAS-01', 2, 4, 2, NULL, 'Kombi MWB 2.2 L T/M', 2009, 'Completo', 'Blanco', 'JHA-5794', 'PUMA TDCI 2.2L 14', '', 'WF0RT49H49JA35775', NULL, '2300', 'Diesel', 80, '3', '15', '15', '2', '2', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 77762, 'Km', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2023-09-22 13:54:21', '2024-01-12 18:36:06', '', NULL, NULL, 79546, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 1, NULL, 'Volteo 14MTS International', NULL, 'VOL-03', 6, 7, 16, NULL, '8600', 2006, 'Mov. Tierras', 'Blanco', 'JY-01-293', 'CUMMINSM', '35129017', 'IHSHWAHN86J236896', NULL, '24493', 'Diesel', 757, '3', '2', '4', '2', '4', '41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 487824, 'Mi', NULL, NULL, NULL, NULL, 0, 20.00, NULL, '2023-09-25 17:13:07', '2024-01-15 09:48:35', '', NULL, NULL, 492763, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 1, NULL, 'Grúa Kenworth', NULL, 'GRU-01', 1, 5, 20, NULL, 'T370', 2013, 'Completo', 'Blanco', 'JW-14-631', 'PX-8 GOB22200', '73384646', '3WKHDN9X6DF380832', NULL, '21319', 'Diesel', 370, '2', '15', '15', '2', '6', '43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 540167, 'Mi', NULL, NULL, NULL, NULL, 0, 285.00, NULL, '2023-09-26 17:04:21', '2024-01-13 13:35:25', '', NULL, NULL, 545668, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 1, NULL, 'Remolque Shoreland´r', NULL, 'REM-05', 5, 11, 24, NULL, 'Semiremolque de Carga C/Rampa', 2002, 'Utilitario', 'Negro', '3HG-7598', NULL, '', 'IMDFHJ122AAI89221', NULL, '1000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Km', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2023-09-27 16:48:58', '2023-10-10 12:58:06', '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 1, NULL, 'Miniexcavadora Yanmar VIO-17', NULL, 'EXC-01', 6, 5, 17, NULL, 'VI0-17', 2022, 'Mov. Tierras', 'Rojo', '', NULL, 'U1794', 'YMRVI017VNBJ13067', NULL, NULL, 'Diesel', 20, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, '16', NULL, NULL, NULL, NULL, NULL, NULL, 'Hr', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2023-09-27 17:43:28', '2023-12-26 16:57:48', '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 1, NULL, 'Rodillo Doble Articulado Wacker Neuson', NULL, 'ROD-01', 1, 5, 13, NULL, 'RD-12A90', 2020, 'Mov. Tierras', 'Amarillo', '', 'GX-630', '', 'WNCRD12ACPUM02150', NULL, '80', 'Gasolina', 23, '2', NULL, NULL, NULL, NULL, '2', NULL, NULL, '5', NULL, NULL, NULL, NULL, NULL, 378, 'Hr', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2023-09-28 13:47:14', '2024-01-11 17:44:29', '', NULL, NULL, 605, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 1, NULL, 'Minicargador Bobcat', NULL, 'CAR-01', 6, 5, 14, NULL, 'S630', 2019, 'Mov. Tierras', 'Blanco', '', 'KUBOTA/V3307-DI-TE3', '1J951000008JQ0075', 'A3NT19781', NULL, '2079', 'Diesel', 103, NULL, NULL, NULL, '2', '2', '19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2786, 'Hr', NULL, NULL, NULL, NULL, 0, 30.00, NULL, '2023-09-28 16:41:16', '2024-01-05 11:06:55', '', NULL, NULL, 2925, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 1, NULL, 'Torre de Iluminación Genie', NULL, 'LUZ-01', 2, 4, 25, NULL, 'RL4', 2018, 'Utilitario', 'Azul', '', 'Kubota', '', 'RL4LJ145', NULL, '663', 'Diesel', 170, '1', NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Hr', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2023-09-29 12:15:21', '2024-01-05 11:55:19', '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 1, NULL, 'Retroexcavadora John Deere 2018', NULL, 'RET-04', 6, 6, 5, NULL, '310L', 2018, 'Mov. Tierras', 'Amarillo', '', NULL, 'J04045B717521', '1BZ310LALJC001403', NULL, '480', 'Diesel', 155, '2', NULL, NULL, '2', '2', '13', '18', '102', '37', NULL, NULL, NULL, NULL, NULL, 6160, 'Hr', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2023-09-29 13:40:29', '2024-01-16 10:44:49', '', NULL, NULL, 6408, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 1, NULL, 'Retroexcavadora John Deere 2017', NULL, 'RET-03', 6, 6, 5, NULL, '310L', 2017, 'Mov. Tierras', 'Amarillo', '', NULL, 'PE4045J001555', '1T0310LXAHC308643', NULL, '265', 'Diesel', 155, '2', NULL, NULL, '2', '2', '13', '18', '102', '37', NULL, NULL, NULL, NULL, NULL, 4108, 'Hr', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2023-09-29 16:19:32', '2024-01-16 10:45:09', '', NULL, NULL, 4358, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 1, NULL, 'Retroexcavadora JCB 3CX', NULL, 'RET-02', 6, 6, 7, NULL, '3CX14FTECO', 2016, 'Mov. Tierras', 'Amarillo', '', 'STAGE 1I/STAGE IIIB', '', 'JCB3CX4TL02444935', NULL, NULL, 'Diesel', 160, '2', NULL, NULL, '2', '2', '15', '16', NULL, '117', NULL, NULL, NULL, NULL, NULL, 6005, 'Hr', NULL, NULL, NULL, NULL, 0, 170.00, NULL, '2023-09-29 16:56:55', '2024-01-11 17:39:34', '', NULL, NULL, 6028, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 1, NULL, 'Miniretroexcavadora JCB 1CX', NULL, 'RET-01', 6, 6, 7, NULL, '1CX208S', 2015, 'Mov. Tierras', 'Amarillo', '', 'Perkins 404D-22', '', 'JCBCXWSH01744848', NULL, '610', 'Diesel', 45, '2', NULL, NULL, '2', '2', '9', NULL, NULL, '45', NULL, NULL, NULL, NULL, NULL, 6573, 'Hr', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2023-09-29 17:26:38', '2024-01-13 12:56:45', '', NULL, NULL, 6819, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 1, NULL, 'Bomba de Concreto SCHWING', NULL, 'BOM-01', 1, 5, 6, NULL, 'SP1000', 2016, 'Completo', 'Blanco', '1-HH-7764', 'Deutz BF4M2012C', '1000631', '1S9PS151XGM544631', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 'Km', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2023-10-02 12:53:13', '2024-01-08 13:24:04', '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 1, NULL, 'Torre de Iluminación Lighting Tower', NULL, 'LUZ-02', 2, 4, 26, NULL, 'VT8JM-1403M', 2016, 'Utilitario', NULL, '', NULL, '', '1405465', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Hr', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2023-10-02 13:18:28', '2024-01-05 11:55:33', '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 1, NULL, 'Planta de Luz', NULL, 'PLA-01', 1, 5, 10, NULL, '039G3D0082D0250', 2010, 'Completo', 'Blanco', '9-HG-4629', 'CUMMINS 4BTA3.9-G3', '', '3JRP1D210C1AAA616', NULL, NULL, 'Diesel', NULL, '2', '15', '15', '2', '2', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Km', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2023-10-02 17:03:11', '2023-10-10 12:56:31', '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 1, NULL, 'Chevrolet Aveo', NULL, '0011', NULL, NULL, 32, NULL, 'Aveo', 2017, NULL, 'Gris', 'JNR5351', NULL, 'HECHO EN MEXICO', '3G1TA5CF9HL178634', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 119996, 'Km', '1696531112_1.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 12:21:03', '2023-10-18 11:17:49', '', NULL, NULL, 129996, '1696531112_1.FRENTE.png', '1697560826_1696531112_1.COSTADO1.png', '1696531112_1.COSTADO1.png', '1696531112_2.COSTADO.png', NULL, NULL, NULL),
(36, 1, NULL, 'Chevrolet Aveo', NULL, '0012', NULL, NULL, 32, NULL, 'Aveo', 2017, NULL, 'Gris', 'JNR5352', NULL, 'HECHO EN MEXICO', '3G1TA5CF9HL178312', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 83891, 'Km', '1696544958_2.CIRCULACIÓN.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 12:59:21', '2023-10-18 11:18:00', '', NULL, NULL, 0, '1696544958_2.FRENTE.png', '1696544958_2.2.COSTADO.png', '1696544958_2.3COSTADO.png', '1696544958_2.TRASERA.png', NULL, NULL, NULL),
(37, 1, NULL, 'Ford Ranger', NULL, '0013', NULL, NULL, 2, NULL, 'Ranger 2 Puertas', 2011, NULL, 'Blanco', 'JR96299', NULL, 'S/N', '8AFDR5CD2B6376792', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 292404, 'Km', '1696545011_3.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 13:05:10', '2023-10-18 11:18:26', '', NULL, NULL, 301176, '1696545011_3.FRENTE.png', '1696545011_3.COSTADO1.png', '1696545011_3.COSTADO.png', '1696545011_3.TRASERA.png', NULL, NULL, NULL),
(38, 1, NULL, 'Nissan Frontier', NULL, '0040', NULL, NULL, 4, NULL, 'Frontier 4 Puertas', 2021, NULL, 'Blanco', 'JW86165', NULL, 'QR25426277H', '3N6AD33A0MK830570', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32867, 'Km', '1696545067_4.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 13:09:08', '2023-10-18 12:01:22', '', NULL, NULL, 0, '1696545067_4.FRENTE.png', '1696545067_4.COSTADO.png', '1696545067_4.COSTADO1.png', '1696545067_4.TRASERA.png', NULL, NULL, NULL),
(39, 1, NULL, 'Toyota Hilux', NULL, '0014', NULL, NULL, 11, NULL, 'Hilux 4 Puertas', 2007, NULL, 'Blanco', 'JT84488', NULL, '2TR6323548', '8AJEX32G574005337', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 460543, 'Km', '1696545118_5.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 13:12:59', '2023-10-30 16:43:52', '', NULL, NULL, 470543, '1696545118_5.FRENTE.png', '1696545118_5.COSTADO.png', '1696545118_5.COSTADO1.png', '1696545118_5.TRASERA.png', NULL, NULL, NULL),
(40, 1, NULL, 'Seat Ibiza', NULL, '0015', NULL, NULL, 33, NULL, 'Ibiza 4 Puertas', 2012, NULL, 'Blanco', 'JJM6231', NULL, 'CEK030042', 'VSSMK46J8CR033104', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 258927, 'Km', '1696545227_6.CIRCULACIÓN.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 13:22:57', '2024-01-08 16:37:08', '', NULL, NULL, 265071, '1696545227_6.FRENTE.png', '1696545227_6.COSTADO.png', '1696545227_6.COSTADO1.png', '1696545227_6.TRASERA.png', NULL, NULL, NULL),
(41, 1, NULL, 'Toyota Hilux', NULL, '0016', NULL, NULL, 11, NULL, 'Hilux 4 Puertas', 2011, NULL, 'Blanco', 'JS14207', NULL, '2TR6997472', '8AJEX32G9B4030931', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 237124, 'Km', '1696545288_7.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 13:27:33', '2024-01-12 17:21:23', '', NULL, NULL, 247124, '1696545289_7.FRENTE.png', '1696545289_7.COSTADO.png', '1696545289_7.COSTADO1.png', '1696545289_7.TRASERA.png', NULL, NULL, NULL),
(42, 1, NULL, 'Toyota Hilux', NULL, '0009', NULL, NULL, 11, NULL, 'Hilux 4 Puertas', 2010, NULL, 'Blanco', 'JH04740', NULL, '2TR6859765', '8AJEX32G9A4025730', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 291616, 'Km', '1696545334_8.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 13:32:31', '2024-01-10 10:45:51', '', NULL, NULL, 301616, '1696545334_8.FRENTE.png', '1696545334_8.COSTADO1.png', '1696545334_8.COSTADO.png', '1696545334_8.TRASERA.png', NULL, NULL, NULL),
(43, 1, NULL, 'Toyota Hilux', NULL, '0017', NULL, NULL, 11, NULL, 'Hilux 2 Puertas', 2013, NULL, 'Blanco', 'JT46574', NULL, '2TR7431608', 'MR0CX12G2D0095824', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 209792, 'Km', '1696545386_9.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 13:35:56', '2023-12-16 10:50:37', '', NULL, NULL, 219792, '1696545386_9.FRENTE.png', '1696545386_9.COSTADO1.png', '1696545386_9.COSTADO.png', '1696545386_9.TRASERA.png', NULL, NULL, NULL),
(44, 1, NULL, 'Toyota Hilux', NULL, '0018', NULL, NULL, 11, NULL, 'Hilux 2 Puertas', 2013, NULL, 'Blanco', 'JT46564', NULL, '2TR7430509', 'MR0CX12G0D0095661', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 264478, 'Km', '1696545461_10.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 13:40:31', '2023-10-18 11:20:03', '', NULL, NULL, 276329, '1696545461_10.FRENTE.png', '1696545461_10.COSTADO1.png', '1696545461_10.COSTADO.png', '1696545461_10.TRASERA.png', NULL, NULL, NULL),
(45, 1, NULL, 'Toyota Hilux', NULL, '0034', NULL, NULL, 11, NULL, 'Hilux 4 Puertas', 2017, NULL, 'Blanco', 'JV26178', NULL, '2TRA173707', 'MR0EX8DD2H0249085', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 149020, 'Km', '1696545538_11.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 13:44:18', '2023-10-18 11:29:10', '', NULL, NULL, 159020, '1696545538_11.FRENTE.png', '1696545538_11.COSTADO.png', '1696545538_11.COSTADO1.png', '1696545538_11.TRASERA.png', NULL, NULL, NULL),
(46, 1, NULL, 'Toyota Hilux', NULL, '0020', NULL, NULL, 11, NULL, 'Hilux 2 Puertas', 2013, NULL, 'Blanco', 'JT46572', NULL, '2TE7431545', 'MR0CX12G2D0095841', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 175042, 'Km', '1696545736_12.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 13:47:32', '2023-10-18 11:21:17', '', NULL, NULL, 0, '1696545736_12.FRENTE.png', '1696545736_12.COSTADO1.png', '1696545736_12.COSTADO.png', '1696545736_12.TRASERA.png', NULL, NULL, NULL),
(47, 1, NULL, 'Jetta Clasico', NULL, '0010', NULL, NULL, 27, NULL, 'Jetta Clasico 4 Puertas', 2014, NULL, 'Gris', 'JLA7688', NULL, 'CBP505688', '3VW1V49M8EM004558', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 210820, 'Km', '1696545789_13.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 13:54:00', '2023-10-18 11:17:34', '', NULL, NULL, 222845, '1696545789_13.FRENTE.png', '1696545789_13.COSTADO1.png', '1696545789_13.COSTADO.png', '1696545789_13.TRASERA.png', NULL, NULL, NULL),
(48, 1, NULL, 'Jetta MK', NULL, '0008', NULL, NULL, 27, NULL, 'Jetta MK VI 4 Ptas', 2010, NULL, 'Blanco', 'JHL8789', NULL, 'CBP132452', '3VWEV09M0AM006552', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 243815, 'Km', '1696545867_14.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 13:57:30', '2023-10-18 11:17:01', '', NULL, NULL, 244815, '1696545867_14.FRENTE.png', '1696545867_14.COSTADO1.png', '1696545867_14.COSTADO.png', '1696545867_14.TRASERA.png', NULL, NULL, NULL),
(49, 1, NULL, 'Jetta MK', NULL, '0007', NULL, NULL, 27, NULL, 'Jetta MK VI 4 Ptas', 2010, NULL, 'Blanco', 'JSW2237', NULL, 'CBP173103', '3VWYV49M7AM051041', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 265859, 'Km', '1696545932_15.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 14:00:47', '2023-10-18 11:16:34', '', NULL, NULL, 275859, '1696545932_15.FRENTE.png', '1696545932_15.COSTADO1.png', '1696545932_15.COSTADO.png', '1696545932_15.TRASERA.png', NULL, NULL, NULL),
(50, 1, NULL, 'Jetta', NULL, '0002', NULL, NULL, 27, 'Clasico', 'Jetta 4 Puertas', 2010, NULL, 'Blanco', 'JTS2959', NULL, 'CBP140828', '3VWEV09M4AM015223', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 249991, 'Km', '1696546043_16.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 16:01:15', '2024-01-16 12:53:20', '', NULL, NULL, 1, '1696546043_16.FRENTE.png', '1696546043_16.COSTADO1.png', '1696546043_16.COSTADO.png', '1696546043_16.TRASERA.png', NULL, NULL, NULL),
(51, 1, NULL, 'Jetta', NULL, '0023', NULL, NULL, 27, NULL, 'Jetta 4 Puertas', 2019, NULL, 'Blanco', 'JPY8768', NULL, 'CZD698219', '3VWKP6BU9KM109075', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81983, 'Km', '1696546120_17.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 16:05:49', '2023-10-18 11:22:45', '', NULL, NULL, 0, '1696546120_17.FRENTE.png', '1696546120_17.COSTADA.png', '1696546120_17.COSTADO1.png', '1696546120_17.TRASERA.png', NULL, NULL, NULL),
(52, 1, NULL, 'Jetta Trendline', NULL, '0024', NULL, NULL, 27, NULL, 'TRENDLINE 4 Puertas', 2019, NULL, 'Blanco', 'JPY8765', NULL, 'CZD697257', '3VWKP6BU1KM103786', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70264, 'Km', '1696546180_18.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 16:11:45', '2023-10-18 11:23:08', '', NULL, NULL, 0, '1696546180_18.FRENTE.png', '1696546180_18.COSTADO1.png', '1696546180_18.COSTADO.png', '1696546180_18.TRASERA.png', NULL, NULL, NULL),
(53, 1, NULL, 'Toyota Camry', NULL, '0021', NULL, NULL, 11, NULL, 'Camry 4 Puertas', 2014, NULL, 'Blanco', 'JLB8427', NULL, '2ARA130549', '4T1BF1FK3EU303260', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 292949, 'Km', '1696546254_19.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 16:16:20', '2023-10-18 11:21:48', '', NULL, NULL, 301766, '1696546254_19.FRENTE.png', '1696546254_19.COSTADO1.png', '1696546254_19.COSTADO.png', '1696546254_19.TRASERA.png', NULL, NULL, NULL),
(54, 1, NULL, 'Jetta MK VI', NULL, '0006', NULL, NULL, 27, NULL, 'Jetta MK VI 4 Ptas', 2011, NULL, 'Blanco', 'JHZ9802', NULL, 'CCC106126', '3VW1W11K4BM029023', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 310034, 'Km', '1696546304_20.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 16:24:20', '2023-10-18 11:16:15', '', NULL, NULL, 319469, '1696546304_20.FRENTE.png', '1696546304_20.COSTADO1.png', '1696546304_20.COSTADO.png', '1696546304_20.TRASERA.png', NULL, NULL, NULL),
(55, 1, NULL, 'Jetta MK VI', NULL, '0005', NULL, NULL, 27, NULL, 'Jetta MK VI 4 Ptas', 2011, NULL, 'Blanco', 'JHZ9801', NULL, 'CCC107471', '3VW1W11K2BM031224', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 116047, 'Km', '1696549559_21.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 17:25:49', '2023-10-18 11:15:58', '', NULL, NULL, 1, '1696549559_21.FRENTE.png', '1696549559_21.COSTADO1.png', '1696549559_21.COSTADO.png', '1696549559_21.TRASERO.png', NULL, NULL, NULL),
(56, 1, NULL, 'Jetta', NULL, '0043', NULL, NULL, 27, NULL, 'Jetta 4 Ptas', 2019, NULL, 'Blanco', 'JPY8764', NULL, 'CZD135783', '3VWHP6BU4KM066582', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 62776, 'Km', '1696549616_22.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 17:31:25', '2023-10-18 12:02:24', '', NULL, NULL, 0, '1696549616_22.FRENTE.png', '1696549616_22.COSTADO.png', '1696549616_22.COSTADO1.png', '1696549616_22.TRASERA.png', NULL, NULL, NULL),
(57, 1, NULL, 'Jetta', NULL, '0039', NULL, NULL, 27, NULL, 'Jetta 4 Puertas', 2019, NULL, 'Blanco', 'JPY8767', NULL, 'CZD693299', '3VWKP6BU1KM117882', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 90045, 'Km', '1696549657_23.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 17:35:09', '2023-10-18 11:59:59', '', NULL, NULL, 0, '1696549657_23.FRENTE.png', '1696549657_23.COSTADO1.png', '1696549657_23.COSTADO.png', '1696549657_23.TRASERA.png', NULL, NULL, NULL),
(58, 1, NULL, 'Jetta', NULL, '0038', NULL, NULL, 27, NULL, 'Jetta 4 Puertas', 2019, NULL, 'Blanco', 'JPY9173', NULL, 'CZD697936', '3VWKP6BUXKM117055', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49699, 'Km', '1696549689_24.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 17:38:33', '2023-10-18 11:43:26', '', NULL, NULL, 0, '1696549689_24.FRENTE.png', '1696549689_24.COSTADO1.png', '1696549689_24.COSTADO.png', '1696549689_24.TRASERO.png', NULL, NULL, NULL),
(59, 1, NULL, 'KICKS SUV ADVANCE', NULL, '0037', NULL, NULL, 4, NULL, 'Kicks 5 Puertas, Advance 1.8 Lts', 2020, NULL, 'Gris', 'JSA5722', NULL, 'HR16111156V', '3N8CP5HD6LL548951', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 94415, 'Km', '1696549726_25.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 17:42:51', '2023-10-23 16:43:44', '', NULL, NULL, 104415, '1696549726_25.FRENTE.png', '1696549726_25.COSTADO.png', '1696549726_25.COSTADO1.png', '1696549726_25.TRASERA.png', NULL, NULL, NULL),
(60, 1, NULL, 'Nissan NP300', NULL, '0019', NULL, NULL, 4, NULL, 'NP300 2 Chasis Redilas', 2014, NULL, 'Blanco', 'JT74097', NULL, 'KA24685765A', '3N6DD25T4EK042897', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 301868, 'Km', NULL, NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 17:51:36', '2023-11-03 10:53:38', '', NULL, NULL, 311868, '1696549955_26.FRENTE.png', '1696549955_26.TRASERO.png', '1696549955_26.COSTADO.png', '1696549955_26.TARJETA.png', NULL, NULL, NULL),
(61, 1, NULL, 'Nissan NP 300', NULL, '0022', NULL, NULL, 4, NULL, 'NP300', 2019, NULL, 'Blanco', 'JW35660', NULL, 'QR25314591H', '3N6AD31A9KK856682', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 111037, 'Km', '1696550154_27.TARJETA.png', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-05 17:55:04', '2023-10-18 11:22:20', '', NULL, NULL, 119891, '1696550154_27.FRENTE.png', '1696550154_27.COSTADO1.png', '1696550154_27.COSTADO.png', '1696550154_27.TRASERA.png', NULL, NULL, NULL),
(62, 1, NULL, 'Nissan NP300', NULL, '0036', NULL, NULL, 4, NULL, 'NP300 2 Puertas', 2018, NULL, 'Blanco', 'JV65107', NULL, 'QR25218961H', '3N6AD35C1JK858579', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 205394, 'Km', '1696619392_Circulación.PNG', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-06 08:56:34', '2023-12-02 08:53:49', '', NULL, NULL, 208356, '1696863478_Captura.PNG', '1696619392_Derecha.jpg', '1696619392_Trasera.jpg', '1696619392_Izquierda.jpg', NULL, NULL, NULL),
(63, 1, NULL, 'Nissan NP300', NULL, '0042', NULL, NULL, 4, NULL, 'Estacas T/M DH', 2020, NULL, 'Blanco', 'JW83035', NULL, 'QR25400446H', '3N6AD35AXLK883157', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 103493, 'Km', '1696863638_Captura.PNG', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-06 09:08:36', '2023-10-18 12:01:51', '', NULL, NULL, 113493, '1696619576_Frente.bmp', '1696619576_Derecha.jpg', '1696619576_Trasera.bmp', '1696619576_Izquierda.jpg', NULL, NULL, NULL),
(64, 1, NULL, 'Virtus', NULL, '0035', NULL, NULL, 27, NULL, 'Virtus 4 Puertas', 2022, NULL, 'Gris', 'JTA3879', NULL, 'CWS140916', '3BWDL5BZ4NP031919', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26473, 'Km', '1696619799_Circulación.jpg', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-06 09:24:34', '2023-10-18 11:29:38', '', NULL, NULL, 0, '1696619799_Frente.jpg', '1696619799_Derecha.jpg', '1696619799_Trasera.jpg', '1696619799_Izquierda.jpg', NULL, NULL, NULL),
(65, 1, NULL, 'MG SEDAN', NULL, '0033', NULL, NULL, 28, NULL, 'MG', 2020, NULL, 'Negro', 'JTD3494', NULL, '15S4CCGGMA280048', 'LSJA36E3XNZ070902', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41836, 'Km', '1696863757_Captura 1.PNG', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-06 09:37:45', '2023-10-18 11:28:52', '', NULL, NULL, 0, '1696620002_Frente.jpg', '1696620002_Derecha.jpg', '1696620002_Trasera.jpg', '1696620002_Izquierda.jpg', NULL, NULL, NULL),
(66, 1, NULL, 'MG5 ELEGANCE', NULL, '0032', NULL, NULL, 28, NULL, 'MG5 ELEGANCE TA 1.5L 4CIL CVT', 2022, NULL, 'Blanco', 'JDT4246', NULL, '15S4CCHGN4040193', 'LSJA36E91NZ180841', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21768, 'Km', '1696620080_Circulación.jpg', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-06 09:45:27', '2023-10-12 11:41:44', '', NULL, NULL, 0, '1696620080_Frente.jpg', '1696620081_Derecha.jpg', '1696620080_Trasera.jpg', '1696620081_Izquierda.jpg', NULL, NULL, NULL),
(67, 1, NULL, 'Volkswagen Saveiro', NULL, '0031', NULL, NULL, 27, NULL, 'Saveiro Pick Up', 2022, NULL, 'GRIS', 'JX52753', NULL, 'CFZV23779', '9BWB45U0NP039116', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20148, 'Km', '1696620215_Circulación.jpg', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-06 09:51:44', '2023-10-18 11:25:48', '', NULL, NULL, 1, '1696620215_Frente.jpg', '1696620215_Derecha.jpg', '1696620215_Trasera.jpg', '1696620215_Izquierda.jpg', NULL, NULL, NULL),
(68, 1, NULL, 'Volkswagen Saveiro', NULL, '0030', NULL, NULL, 27, NULL, 'Saveiro Pick Up', 2022, NULL, 'Blanco', 'JX81640', NULL, 'CFZ V36718', '9BWKB45UXNP045280', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20907, 'Km', '1696620282_Circulación.jpg', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-06 09:57:12', '2023-10-18 11:25:12', '', NULL, NULL, 0, '1696620282_Frente.jpg', '1696620282_Derecha.jpg', '1696620282_Trasera.jpg', '1696620282_Izquierda.jpg', NULL, NULL, NULL),
(69, 1, NULL, 'Fiat Strada', NULL, '0004', NULL, NULL, 34, NULL, 'FIAT STRADA ADVENTURE', 2013, NULL, 'Gris', '530YVP', NULL, '', '9BD278261D7610540', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 168263, 'Km', NULL, NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-06 10:02:37', '2023-10-18 11:14:26', '', NULL, NULL, 0, '1696620348_Frente.jpg', '1696620348_Izquierda.jpg', '1696620348_Trasera.jpg', '1696620348_Derecha.jpg', NULL, NULL, NULL),
(70, 1, NULL, 'JAC Frison', NULL, '0029', NULL, NULL, 29, NULL, 'JAC FRISON 4 Puertas', 2023, NULL, 'Blanca', 'JX85771', NULL, 'N3008915', 'LJ11PAB52PC089413', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10727, 'Km', '1696620459_Circulación.jpg', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-06 10:09:26', '2023-10-18 11:24:33', '', NULL, NULL, 0, '1696620459_Frente.jpg', '1696620459_Derecha.jpg', '1696620459_Trasera.jpg', '1696620459_Izquierda.jpg', NULL, NULL, NULL),
(71, 1, NULL, 'Mercedes Benz Sprinter', NULL, '0003', NULL, NULL, 30, NULL, 'Sprinter 415 Larga', 2012, NULL, 'Blanca', '8GPM96', NULL, '65195531169783', 'WD3YE8A97CS698576', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 354668, 'Km', '1696619264_Circulación.jpg', NULL, NULL, NULL, 0, NULL, 'mtq', '2023-10-06 10:35:39', '2024-01-15 09:07:04', '', NULL, NULL, 364668, '1696619264_Frente.jpg', '1696619264_Derecha.jpg', '1696619264_Trasera.jpg', '1696619264_Izquierda.jpg', NULL, NULL, NULL),
(72, 1, NULL, 'Nissan Frontier', NULL, '0044', NULL, NULL, 4, NULL, 'FRONTIER', 2021, NULL, 'Blanca', 'JX31776', NULL, 'QR25427989H', '3N6AD33A5MK832508', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63888, 'Km', '1696620540_Circulación.jpg', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-06 10:44:25', '2023-10-18 12:02:55', '', NULL, NULL, 74534, '1696620540_Frente.jpg', '1696620540_Derecha.jpg', '1696620540_Trasera.jpg', '1696620540_Izquierda.jpg', NULL, NULL, NULL),
(73, 1, NULL, 'Landtrek', NULL, '0045', NULL, NULL, 31, NULL, 'LANDTREK 4 PUERTAS', 2021, NULL, 'Gris', 'JW83133', NULL, 'SYK4805', 'VR3FBTGT2M3000302', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54863, 'Km', '1696620595_Circulación.jpg', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-06 10:57:28', '2023-10-19 16:53:30', '', NULL, NULL, 0, '1696620595_Frente.jpg', '1696620595_Izquierda.jpg', '1696620595_Trasera.jpg', '1696620595_Derecha.jpg', NULL, NULL, NULL),
(74, 1, NULL, 'Nissan NP300', NULL, '0001', NULL, NULL, 4, 'Estacas', 'NP300', 2019, NULL, 'Blanca', 'JY20126', NULL, 'QR25313120H', '3N6AD35A1KK860610', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70649, 'Km', '1696620654_Circulación.jpg', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-06 11:10:51', '2024-01-16 12:52:25', '', NULL, NULL, 1, '1696620654_Frente.jpg', '1696620654_Derecha.jpg', '1696620654_Trasera.jpg', '1696620654_Izquierda.jpg', NULL, NULL, NULL),
(75, 1, NULL, 'Nissan Frontier', NULL, '0028', NULL, NULL, 4, NULL, 'FRONTIER', 2022, NULL, 'Blanca', 'JX52819', NULL, 'QR25015729P', '3N6AD33B5NK825049', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30578, 'Km', '1696620702_Circulación.jpg', NULL, NULL, NULL, NULL, NULL, 'mtq', '2023-10-06 11:17:43', '2023-10-18 11:23:51', '', NULL, NULL, 0, '1696620702_Frente.jpg', '1696620702_Izquierda.jpg', '1696620702_Trasera.jpg', '1696620702_Derecha.jpg', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinariaCategoria`
--

DROP TABLE IF EXISTS `maquinariaCategoria`;
CREATE TABLE IF NOT EXISTS `maquinariaCategoria` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `comentario` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `maquinariaCategoria`
--

INSERT INTO `maquinariaCategoria` (`id`, `nombre`, `comentario`) VALUES
(1, 'Accesorios', 'Accesorios de Maquinaría'),
(2, 'Camperes', 'Campers'),
(3, 'Cisterna', 'Cisterna'),
(4, 'Maquinaría Ligera', 'Maquinaría Ligera'),
(5, 'Maquinaría Pesada', 'Maquinaría Pesada'),
(6, 'Retroexcavadoras', 'Retroexcavadoras'),
(7, 'Tractocamiones', 'Tractocamiones'),
(8, 'Otros', 'Otros'),
(9, 'Utilitarios', 'Utilitarios'),
(10, 'Remolques Contenedoer', 'De contenedor'),
(11, 'Remolques Plataforma', 'Plataformas'),
(12, 'Otros 2', 'Otros 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinariaEstatus`
--

DROP TABLE IF EXISTS `maquinariaEstatus`;
CREATE TABLE IF NOT EXISTS `maquinariaEstatus` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `color` varchar(8) DEFAULT NULL,
  `comentario` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `maquinariaEstatus`
--

INSERT INTO `maquinariaEstatus` (`id`, `nombre`, `color`, `comentario`) VALUES
(1, 'Activo', 'green', 'MaquinarÃ­a activa'),
(2, 'Inactivo', 'darkcyan', 'La maquinarÃ­a esta inactiva'),
(3, 'Baja', 'orange', 'La maquinarÃ­a esta fue dada de baja'),
(4, 'Borrado', 'red', 'La maquinarÃ­a fue borrada de forma definitiva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinariaTipo`
--

DROP TABLE IF EXISTS `maquinariaTipo`;
CREATE TABLE IF NOT EXISTS `maquinariaTipo` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `comentario` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `maquinariaTipo`
--

INSERT INTO `maquinariaTipo` (`id`, `nombre`, `comentario`) VALUES
(1, 'Pesada', 'Maquinaría Pesada'),
(2, 'Ligera', 'Maquinaría Ligera'),
(3, 'Grua', 'Gruas y Montacargas'),
(4, 'No Aplica', 'No aplica para ningún tipo'),
(5, 'Utilitario', 'Vehículo de Uso Utilitario General'),
(6, 'Movimiento de Tierras', NULL),
(7, 'Otros 2', 'Otros 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

DROP TABLE IF EXISTS `marca`;
CREATE TABLE IF NOT EXISTS `marca` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `comentario` text,
  `tipo` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `nombre`, `comentario`, `tipo`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'LORESA', 'LORESA', 'maquinaria', 1, NULL, NULL),
(2, 'FORD', 'FORD', 'maquinaria', 1, NULL, NULL),
(3, 'GENERAL MOTORS', 'GENERAL MOTORS', 'maquinaria', 1, NULL, NULL),
(4, 'NISSAN', 'Marca En Autos MTQ', 'maquinaria', 1, NULL, NULL),
(5, 'JOHN DEERE', 'JOHN DEERE', 'maquinaria', 1, NULL, NULL),
(6, 'SCHWING', 'SCHWING', 'maquinaria', 1, NULL, NULL),
(7, 'JCB', 'JCB', 'maquinaria', 1, NULL, NULL),
(8, 'EVERDIGM', 'EVERDIGM', 'maquinaria', 1, NULL, NULL),
(9, 'PKP', 'PKP', 'maquinaria', 1, NULL, NULL),
(10, 'PLANELEC', 'PLANELEC', 'maquinaria', 1, NULL, NULL),
(11, 'TOYOTA', 'TOYOTA', 'maquinaria', 1, NULL, NULL),
(12, 'THORTON', 'THORTON', 'maquinaria', 1, NULL, NULL),
(13, 'WACKER', 'WACKER', 'maquinaria', 1, NULL, NULL),
(14, 'BOBCAT', 'BOBCAT', 'maquinaria', 1, NULL, NULL),
(15, 'CHRYSLER', 'CHRYSLER', 'maquinaria', 1, NULL, NULL),
(16, 'INTERNATIONAL', 'INTERNATIONAL', 'maquinaria', 1, NULL, NULL),
(17, 'YANMAR', 'YANMAR', 'maquinaria', 1, NULL, NULL),
(18, 'RENAULT', 'RENAULT', 'maquinaria', 1, NULL, NULL),
(19, 'ARCE', 'ARCE', 'maquinaria', 1, NULL, NULL),
(20, 'KENWORTH', 'KENWORTH', 'maquinaria', 1, NULL, NULL),
(21, 'JEEP', 'JEEP', 'maquinaria', 1, NULL, NULL),
(23, 'PROVIDENCIA', 'REMOLQUES PROVIDENCIA FABRICACIÓN Y VENTA', 'maquinaria', 1, NULL, NULL),
(24, 'SHORELAND´R', 'Remolque Motos', 'maquinaria', 1, NULL, NULL),
(25, 'GENIE', 'Torre de Iluminación', 'maquinaria', 1, NULL, NULL),
(26, 'ALFO', 'LIGHTINGH TOWER', 'maquinaria', 1, NULL, NULL),
(27, 'VOLKSWAGEN', NULL, NULL, 1, NULL, NULL),
(28, 'MG MOTOR', NULL, NULL, 1, NULL, NULL),
(29, 'GIANT MOTORS LATINOAMERICA SA DE CV', NULL, NULL, 1, NULL, NULL),
(30, 'MERCEDES BENZ', NULL, NULL, 1, NULL, NULL),
(31, 'PEUGEOT', NULL, NULL, 1, NULL, NULL),
(32, 'CHEVROLET', NULL, NULL, 1, NULL, NULL),
(33, 'SEAT', NULL, NULL, 1, NULL, NULL),
(34, 'FIAT', NULL, NULL, 1, NULL, NULL),
(35, 'No Aplica', 'Cuando algo no aplica en categoría', NULL, 1, NULL, NULL),
(36, 'AKRON', NULL, NULL, 1, NULL, NULL),
(37, 'FRAM', NULL, NULL, 1, NULL, NULL),
(38, 'MOBIL', NULL, NULL, 1, NULL, NULL),
(39, 'BOSCH', NULL, NULL, 1, NULL, NULL),
(40, 'LUK', NULL, NULL, 1, NULL, NULL),
(41, 'AUTOLITE', NULL, NULL, 1, NULL, NULL),
(42, 'DURALAST', NULL, NULL, 1, NULL, NULL),
(43, 'KUMHO', NULL, NULL, 1, NULL, NULL),
(44, 'TF VICTOR', NULL, NULL, 1, NULL, NULL),
(45, 'BALDWIN', NULL, NULL, 1, NULL, NULL),
(46, 'FLEETGUARD', NULL, NULL, 1, NULL, NULL),
(47, 'SAKURA', NULL, NULL, 1, NULL, NULL),
(48, 'CARTEK', NULL, NULL, 1, NULL, NULL),
(49, 'SUSPENSIÓN Y DIRECCIONES', NULL, NULL, 1, NULL, NULL),
(50, 'FRENOS ÚNICOS', NULL, NULL, 1, NULL, NULL),
(51, 'YAZBEK', NULL, NULL, 1, NULL, NULL),
(52, 'LICA', NULL, NULL, 1, NULL, NULL),
(53, 'BOLLER', NULL, NULL, 1, NULL, NULL),
(54, 'DERMACARE', NULL, NULL, 1, NULL, NULL),
(55, 'SUK', NULL, NULL, 1, NULL, NULL),
(56, 'HILLSAFE', NULL, NULL, 1, NULL, NULL),
(57, 'YAMASHIN', NULL, NULL, 1, NULL, NULL),
(58, 'HASTINGS', NULL, NULL, 1, NULL, NULL),
(59, 'UNIFIL', NULL, NULL, 1, NULL, NULL),
(60, 'JOE', NULL, NULL, 1, NULL, NULL),
(61, 'MOTORFIL', NULL, NULL, 1, NULL, NULL),
(62, 'QBH STAR', NULL, NULL, 1, NULL, NULL),
(63, 'PEAK', NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcasTipo`
--

DROP TABLE IF EXISTS `marcasTipo`;
CREATE TABLE IF NOT EXISTS `marcasTipo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `marca_id` bigint(20) UNSIGNED NOT NULL,
  `tipos_marcas_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_marcasTipo_marca_id` (`marca_id`),
  KEY `FK_marcasTipo_tipos_marcas_id` (`tipos_marcas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marcasTipo`
--

INSERT INTO `marcasTipo` (`id`, `marca_id`, `tipos_marcas_id`) VALUES
(4, 4, 5),
(8, 11, 5),
(9, 27, 5),
(10, 28, 5),
(11, 29, 5),
(12, 30, 5),
(13, 31, 5),
(14, 32, 5),
(15, 33, 5),
(16, 34, 5),
(17, 35, 1),
(18, 35, 2),
(19, 35, 3),
(20, 35, 4),
(21, 35, 5),
(22, 19, 5),
(23, 26, 5),
(24, 13, 5),
(25, 17, 5),
(26, 36, 3),
(27, 37, 2),
(28, 38, 3),
(29, 39, 2),
(30, 20, 5),
(31, 40, 2),
(32, 41, 2),
(33, 42, 2),
(34, 43, 2),
(35, 44, 2),
(36, 45, 2),
(37, 46, 2),
(38, 47, 2),
(39, 48, 2),
(40, 49, 2),
(41, 50, 2),
(42, 51, 4),
(43, 52, 4),
(44, 53, 4),
(45, 54, 4),
(46, 55, 4),
(47, 56, 4),
(48, 57, 2),
(49, 58, 2),
(50, 7, 1),
(51, 2, 3),
(52, 2, 5),
(53, 1, 3),
(54, 23, 3),
(55, 59, 2),
(56, 60, 2),
(57, 61, 2),
(58, 62, 2),
(59, 63, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 3),
(1, 'App\\Models\\User', 4),
(1, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(1, 'App\\Models\\User', 7),
(12, 'App\\Models\\User', 8),
(10, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 11),
(2, 'App\\Models\\User', 12),
(2, 'App\\Models\\User', 13),
(2, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 15),
(2, 'App\\Models\\User', 16),
(2, 'App\\Models\\User', 17),
(2, 'App\\Models\\User', 18),
(2, 'App\\Models\\User', 19),
(2, 'App\\Models\\User', 20),
(8, 'App\\Models\\User', 21),
(11, 'App\\Models\\User', 22),
(1, 'App\\Models\\User', 23),
(2, 'App\\Models\\User', 24),
(6, 'App\\Models\\User', 25),
(10, 'App\\Models\\User', 26),
(7, 'App\\Models\\User', 27),
(5, 'App\\Models\\User', 28),
(2, 'App\\Models\\User', 30),
(2, 'App\\Models\\User', 31),
(2, 'App\\Models\\User', 32),
(2, 'App\\Models\\User', 33),
(2, 'App\\Models\\User', 34),
(5, 'App\\Models\\User', 35),
(9, 'App\\Models\\User', 36),
(13, 'App\\Models\\User', 37),
(2, 'App\\Models\\User', 38),
(9, 'App\\Models\\User', 39),
(9, 'App\\Models\\User', 40),
(14, 'App\\Models\\User', 41),
(1, 'App\\Models\\User', 42),
(2, 'App\\Models\\User', 43),
(9, 'App\\Models\\User', 44),
(9, 'App\\Models\\User', 45),
(9, 'App\\Models\\User', 46);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mtqEventos`
--

DROP TABLE IF EXISTS `mtqEventos`;
CREATE TABLE IF NOT EXISTS `mtqEventos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `mantenimientoId` bigint(20) UNSIGNED NOT NULL,
  `maquinariaId` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` text,
  `estatus` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_mtqEventos_maquinariaId` (`maquinariaId`),
  KEY `FK_mtqEventos_mantenimientoId` (`mantenimientoId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mtqEventos`
--

INSERT INTO `mtqEventos` (`id`, `title`, `mantenimientoId`, `maquinariaId`, `fecha`, `descripcion`, `estatus`, `color`, `start`, `end`, `created_at`, `updated_at`) VALUES
(1, 'JH04740 TOYOTA HILUX 11 0009 SERVICIO DE AFINACIóN MENOR', 40, 42, '2024-01-10', 'servicio de afinación menor', 2, '#00ffee', '2024-01-10 09:00:00', '2024-01-10 10:45:00', '2024-01-08 17:28:59', '2024-01-10 16:45:51'),
(2, 'JS14207 TOYOTA HILUX 11 0016 SERVICIO DE AFINACIÓN MAYOR Y REVISIÓN DE FRENOS POR FAVOR', 42, 41, '2024-01-12', 'SERVICIO DE AFINACIÓN MAYOR Y REVISIÓN DE FRENOS POR FAVOR', 2, '#002aff', '2024-01-12 08:00:00', '2024-01-12 17:21:00', '2024-01-09 16:11:16', '2024-01-12 23:21:23'),
(3, '8GPM96 MERCEDES BENZ SPRINTER 30 0003 ', 44, 71, '2024-01-13', NULL, 2, '#00ffee', '2024-01-13 08:00:00', '2024-01-15 09:07:00', '2024-01-11 23:11:53', '2024-01-15 15:07:04'),
(4, 'JT46574 TOYOTA HILUX 11 0017 RUIDO DE PIEZA SUELTA, REVISIóN Y REPARACIóN DE POSIBLE PIEZA DAñADA', 45, 43, '2024-01-17', 'ruido de pieza suelta, revisión y reparación de posible pieza dañada', 0, '#f70202', '2024-01-17 09:30:00', NULL, '2024-01-16 18:00:47', '2024-01-16 18:00:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomina`
--

DROP TABLE IF EXISTS `nomina`;
CREATE TABLE IF NOT EXISTS `nomina` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `personalId` bigint(20) UNSIGNED DEFAULT NULL,
  `nomina` int(11) DEFAULT NULL,
  `imss` varchar(255) DEFAULT NULL,
  `clinica` varchar(255) DEFAULT NULL,
  `infonavit` varchar(255) DEFAULT NULL,
  `afore` varchar(255) DEFAULT NULL,
  `pago` varchar(25) DEFAULT NULL,
  `tarjeta` varchar(255) DEFAULT NULL,
  `banco` varchar(255) DEFAULT NULL,
  `ingreso` datetime DEFAULT NULL,
  `vactotales` int(11) DEFAULT NULL,
  `vactomadas` int(11) DEFAULT NULL,
  `primavactotal` float(10,2) DEFAULT NULL,
  `primavactomadas` float(10,2) DEFAULT NULL,
  `fechaPagoPrimaVac` date DEFAULT NULL,
  `laborables` int(11) DEFAULT NULL,
  `horario` varchar(255) DEFAULT NULL,
  `hEntrada` time DEFAULT NULL,
  `hSalida` time DEFAULT NULL,
  `hEntradaSabado` time DEFAULT NULL,
  `hSalidaSabado` time DEFAULT NULL,
  `jefeId` bigint(20) UNSIGNED DEFAULT NULL,
  `neto` float(10,2) DEFAULT NULL,
  `bruto` float(10,2) DEFAULT NULL,
  `diario` float(10,2) DEFAULT NULL,
  `diariointegrado` float(10,2) DEFAULT NULL,
  `mensualintegrado` float(10,2) DEFAULT NULL,
  `imssAportacion` float(10,2) DEFAULT NULL,
  `imssriesgo` float(10,2) DEFAULT NULL,
  `aforeAportacion` float(10,2) DEFAULT NULL,
  `isr` float(10,2) DEFAULT NULL,
  `ispt` float(10,2) DEFAULT NULL,
  `aguinaldo` float(10,2) DEFAULT NULL,
  `ptu` float(10,2) DEFAULT NULL,
  `puestoId` bigint(20) UNSIGNED DEFAULT NULL,
  `asistencia` int(1) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_nomina_personalId` (`personalId`),
  KEY `FK_nomina_puestoId` (`puestoId`),
  KEY `FK_nomina_jefeId` (`jefeId`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `nomina`
--

INSERT INTO `nomina` (`id`, `personalId`, `nomina`, `imss`, `clinica`, `infonavit`, `afore`, `pago`, `tarjeta`, `banco`, `ingreso`, `vactotales`, `vactomadas`, `primavactotal`, `primavactomadas`, `fechaPagoPrimaVac`, `laborables`, `horario`, `hEntrada`, `hSalida`, `hEntradaSabado`, `hSalidaSabado`, `jefeId`, `neto`, `bruto`, `diario`, `diariointegrado`, `mensualintegrado`, `imssAportacion`, `imssriesgo`, `aforeAportacion`, `isr`, `ispt`, `aguinaldo`, `ptu`, `puestoId`, `asistencia`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, 'Semanal', NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 250.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, NULL),
(2, 2, NULL, NULL, NULL, NULL, NULL, 'Semanal', NULL, NULL, '2020-01-01 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 100.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(3, 3, 30, '02236415317', '53', NULL, NULL, 'Semanal', '4915669450041577', 'Banorte', '2023-03-13 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', '08:00:00', '13:00:00', 14, NULL, NULL, 500.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL),
(4, 4, NULL, '04997524857', '59', NULL, NULL, 'Semanal', '4915 6634 7212 7373', 'Banorte', '2022-10-03 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', NULL, NULL, 2, NULL, NULL, 380.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL),
(5, 5, 36, '04917474969', '55', NULL, NULL, 'Semanal', '4915 6694 5004 1668', 'Banorte', '2023-06-06 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', '08:00:00', '13:00:00', 14, NULL, NULL, 633.33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19, NULL),
(6, 6, 41, '03170167013', '54', NULL, NULL, 'Semanal', '4189 1431 7180 6246', 'Banorte', '2023-07-10 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', NULL, NULL, 4, NULL, NULL, 588.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, NULL),
(7, 7, 44, '04027409822', '02', NULL, NULL, 'Semanal', '4189 1431 7180 6105', 'Banorte', '2023-07-25 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', '08:00:00', '13:00:00', 14, NULL, NULL, 583.33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL),
(8, 8, 29, '04068821133', '182', NULL, NULL, 'Semanal', '4915 6694 5004 1544', 'Banorte', '2023-03-09 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', '08:00:00', '13:00:00', 4, NULL, NULL, 500.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL),
(9, 9, 37, '04927429102', '34', NULL, NULL, 'Semanal', '4915 6694 5004 1668', 'Banorte', '2023-06-12 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', '08:00:00', '13:00:00', 14, NULL, NULL, 616.67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20, NULL),
(10, 10, NULL, '04977617598', '34', NULL, NULL, 'Semanal', '4189 1431 7180 6113', 'Banorte', '2023-08-11 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', '08:00:00', '13:00:00', 14, NULL, NULL, 583.33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL),
(11, 11, 33, '04806227536', '96', NULL, NULL, 'Semanal', '4915 6694 5004 1619', 'Banorte', '2023-05-03 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', '08:00:00', '13:00:00', 14, NULL, NULL, 583.33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL),
(12, 12, 35, '74917540945', '182', NULL, NULL, 'Semanal', '4915 6694 5004 1650', 'Banorte', '2023-06-02 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', '08:00:00', '13:00:00', 14, NULL, NULL, 500.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL),
(13, 13, 34, '74927309125', '182', NULL, NULL, 'Semanal', '4915 6694 5004 1627', 'Banorte', '2023-05-05 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', NULL, NULL, 4, NULL, NULL, 508.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL),
(14, 14, 3, '04089182606', '53', NULL, NULL, 'Semanal', '4915 6634 7212 7480', 'Banorte', '2023-09-21 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', '08:00:00', '13:00:00', 15, NULL, NULL, 750.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, NULL),
(15, 15, NULL, '74927802012', '171', NULL, NULL, 'Semanal', '4915 6694 7457 2979', 'Banorte', '2022-06-27 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', NULL, NULL, 4, NULL, NULL, 240.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL),
(16, 16, NULL, '04139600599', '53', NULL, NULL, 'Semanal', '4915 6674 3723 2335', 'Banorte', '2023-04-16 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', NULL, NULL, 4, NULL, NULL, 550.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL),
(17, 17, NULL, '67169940441', '53', NULL, NULL, 'Semanal', '4915 6634 3450 9221', 'Banorte', '2021-08-01 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', NULL, NULL, 4, NULL, NULL, 185.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL),
(18, 18, 51, '56877200305', '93', '6423052521', NULL, 'Semanal', '4189 1431 7180 6147', 'Banorte', '2023-09-25 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', '08:00:00', '13:00:00', 14, NULL, NULL, 416.66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL),
(19, 19, 47, '530286604980', '74', NULL, NULL, 'Semanal', '4189 1431 7180 6121', 'Banorte', '2023-08-28 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', '08:00:00', '13:00:00', 14, NULL, NULL, 583.33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL),
(20, 20, 50, '04089283347', '59', '1416125224', NULL, 'Semanal', '4189 1431 7180 6154', 'Banorte', '2023-09-12 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', '08:00:00', '13:00:00', 14, NULL, NULL, 633.33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL),
(21, 21, 49, '74906936823', '02', NULL, NULL, 'Semanal', '4189 1431 7180 6139', 'Banorte', '2023-09-11 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', '08:00:00', '13:00:00', 14, NULL, NULL, 583.33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19, NULL),
(22, 22, 48, '10189551012', '53', NULL, NULL, 'Semanal', '4189 1431 7180 6097', 'Banorte', '2023-09-11 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', '08:00:00', '13:00:00', 14, NULL, NULL, 500.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL),
(23, 23, 52, '04028422329', '182', NULL, NULL, 'Semanal', '4189143191160061', 'BANORTE', '2023-12-05 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', '08:00:00', '13:00:00', 16, NULL, NULL, 633.34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, NULL),
(24, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL),
(25, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL),
(26, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL),
(27, 27, 53, '38159411156', '039', NULL, NULL, 'Semanal', '4189143191160038', 'BANORTE', '2024-01-02 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '18:00:00', '08:00:00', '14:00:00', 14, NULL, NULL, 583.33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
CREATE TABLE IF NOT EXISTS `notificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `personalId` bigint(20) UNSIGNED NOT NULL,
  `visto` int(11) NOT NULL DEFAULT '1',
  `modulo` varchar(200) DEFAULT NULL,
  `titulo` varchar(256) DEFAULT NULL,
  `detalle` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `accion` varchar(50) DEFAULT NULL,
  `recordId` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_notificaciones_userId` (`personalId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obraMaqPer`
--

DROP TABLE IF EXISTS `obraMaqPer`;
CREATE TABLE IF NOT EXISTS `obraMaqPer` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `maquinariaId` bigint(20) UNSIGNED NOT NULL,
  `personalId` bigint(20) UNSIGNED NOT NULL,
  `obraId` bigint(20) UNSIGNED NOT NULL,
  `inicio` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL,
  `combustible` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_obraMaqPer_maquinaria` (`maquinariaId`),
  KEY `FK_obraMaqPer_persona` (`personalId`),
  KEY `FK_obraMaqPer_obras` (`obraId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `obraMaqPer`
--

INSERT INTO `obraMaqPer` (`id`, `maquinariaId`, `personalId`, `obraId`, `inicio`, `fin`, `combustible`) VALUES
(1, 8, 12, 2, '2023-09-30 00:00:00', '2023-10-09 00:00:00', 0),
(4, 32, 3, 7, '2023-10-09 00:00:00', '2023-10-09 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obraMaqPerHistorico`
--

DROP TABLE IF EXISTS `obraMaqPerHistorico`;
CREATE TABLE IF NOT EXISTS `obraMaqPerHistorico` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `maquinariaId` bigint(20) UNSIGNED NOT NULL,
  `usuarioId` bigint(20) UNSIGNED NOT NULL,
  `personalId` bigint(20) UNSIGNED NOT NULL,
  `obraId` bigint(20) UNSIGNED NOT NULL,
  `inicio` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL,
  `combustible` int(11) DEFAULT '0',
  `comentario` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_obraMaqPerHistorico_maquinaria` (`maquinariaId`),
  KEY `FK_obraMaqPerHistorico_persona` (`personalId`),
  KEY `FK_obraMaqPerHistorico_obras` (`obraId`),
  KEY `FK_obraMaqPerHistorico_usuario` (`usuarioId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `obraMaqPerHistorico`
--

INSERT INTO `obraMaqPerHistorico` (`id`, `maquinariaId`, `usuarioId`, `personalId`, `obraId`, `inicio`, `fin`, `combustible`, `comentario`, `created_at`, `updated_at`) VALUES
(1, 8, 7, 12, 2, '2023-09-30 00:00:00', '2023-10-09 00:00:00', 0, 'Se actualizo el registro: 1, se cambio de operadorId->13 al operadorId->12', '2023-10-09 10:38:50', '2023-10-09 10:38:50'),
(2, 32, 7, 3, 7, '2023-10-09 00:00:00', '2023-10-09 00:00:00', 0, 'Se actualizo el registro: 4, se cambio de operadorId->7 al operadorId->3', '2023-10-09 10:39:40', '2023-10-09 10:39:40'),
(3, 32, 2, 3, 7, '2023-10-09 00:00:00', '2023-10-09 00:00:00', 0, 'Se actualizo el registro: 4 con la siguiente información combustible->0', '2023-10-15 22:03:45', '2023-10-15 22:03:45'),
(4, 8, 7, 12, 2, '2023-09-30 00:00:00', '2023-10-09 00:00:00', 0, 'Se actualizo el registro: 1 con la siguiente información combustible->0', '2023-11-03 13:18:46', '2023-11-03 13:18:46'),
(5, 32, 3, 3, 7, '2023-10-09 00:00:00', '2023-10-09 00:00:00', 0, 'Se actualizo el registro: 4 con la siguiente información combustible->0', '2023-11-29 08:22:04', '2023-11-29 08:22:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obras`
--

DROP TABLE IF EXISTS `obras`;
CREATE TABLE IF NOT EXISTS `obras` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `colonia` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `cp` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `clienteId` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estatus` int(10) NOT NULL DEFAULT '1',
  `centroCostos` varchar(16) DEFAULT NULL,
  `proyecto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_obras_cliente` (`clienteId`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `obras`
--

INSERT INTO `obras` (`id`, `nombre`, `tipo`, `calle`, `numero`, `colonia`, `estado`, `ciudad`, `cp`, `logo`, `foto`, `clienteId`, `created_at`, `updated_at`, `estatus`, `centroCostos`, `proyecto`) VALUES
(1, 'Q2CES Oficina', NULL, 'José María Heredia', '2387', 'Lomas de Guevara', 'Jalisco', 'Guadalajara', '44657', NULL, NULL, 1, '2023-09-20 16:51:42', '2023-10-06 15:22:00', 1, NULL, NULL),
(2, 'MTQ Oficina', NULL, 'José María Heredia', '2405', 'Lomas de Guevara', 'Jalisco', 'Guadalajara', '44657', NULL, NULL, 2, '2023-09-20 16:54:16', '2023-10-06 15:22:21', 1, NULL, NULL),
(3, 'Zoltek', NULL, 'Carr. a La Capilla Km.', '3', 'Fraccionamiento Los Silos', 'Jalisco', 'El Salto', '45680', NULL, NULL, 2, '2023-10-05 17:07:38', '2023-11-29 14:19:42', 1, 'RC8', NULL),
(4, 'Colegio Los Altos', NULL, 'Av. Los Pinos', '50', 'Santa Rita', 'Jalisco', 'Zapopan', '45127', NULL, NULL, 2, '2023-10-06 15:18:13', '2023-11-29 14:21:42', 1, 'WC3', NULL),
(5, 'CODE', NULL, 'Av. Fray Antonio Alcalde', '1360', 'Miraflores', 'Jalisco', 'Guadalajara', '44270', NULL, NULL, 2, '2023-10-06 15:20:31', '2023-11-29 14:20:44', 1, 'WC8', NULL),
(6, 'Taller Q2CES', NULL, 'San Juan de Los Lagos', '1788', 'Hogares de Nuevo México', 'Jalisco', 'Zapopan', '45138', NULL, NULL, 1, '2023-10-06 15:23:31', '2023-10-06 15:23:31', 1, NULL, NULL),
(7, 'Academia de Policia', NULL, 'Av. Río Nilo', '7337', 'Villas del Oriente I', 'Jalisco', 'Tonalá', '45403', NULL, NULL, 2, '2023-10-06 15:35:08', '2023-11-29 14:22:04', 1, 'WC4', NULL),
(8, 'Hospital Civil Viejo Belén', NULL, 'C. Belén', '799', 'Centro Barranquitas', 'Jalisco', 'Guadalajara', '44280', NULL, NULL, 2, '2023-10-06 15:50:18', '2023-11-30 14:31:57', 1, 'VM3', NULL),
(9, 'Nueva Destilería 1800', NULL, 'V64C+VM', NULL, 'El Medineño', 'Jalisco', 'El Medineño', '46407', NULL, NULL, 2, '2023-10-06 15:53:36', '2023-11-29 14:20:02', 1, 'SC8', NULL),
(10, 'Hospital de Cancerología', NULL, 'C. Puerto Guaymas', '665', 'Miramar', 'Jalisco', 'Zapopan', '45060', NULL, NULL, 2, '2023-10-06 15:56:40', '2023-11-29 14:21:03', 1, 'VM5', NULL),
(11, 'Aeropuerto', NULL, 'Carr. Guadalajara-Chapala KM 17.5', NULL, 'Aeropuerto', 'Jalisco', 'Guadalajara', '45659', NULL, NULL, 2, '2023-10-06 16:36:14', '2023-11-30 14:27:25', 1, 'VC2', NULL),
(12, 'HP', NULL, '1111', '11111', '1111', 'Jalisco', 'Guadalajara', '1111', NULL, NULL, 2, '2023-10-16 17:22:44', '2023-10-16 17:22:44', 1, NULL, NULL),
(13, 'Flex Norte', NULL, '111', '111', '111', 'Jalisco', 'Guadalajara', '111', NULL, NULL, 2, '2023-10-21 13:08:30', '2023-10-21 13:08:30', 1, NULL, NULL),
(14, 'CENMEX', NULL, '1111', '1111', '1111', 'Jalisco', 'Guadalajara', '1111', NULL, NULL, 2, '2023-10-23 14:16:36', '2023-11-29 14:22:42', 1, 'WC7', NULL),
(15, 'JM Sistemas Hidráulicos', NULL, 'Av. Siglo 21', '50 Int. 110', 'Valle de Santa Cruz', 'Jalisco', 'Santa Cruz de las Flores', '45640', NULL, NULL, 2, '2023-11-13 15:10:07', '2023-11-13 15:10:07', 1, NULL, NULL),
(16, 'PRINTPACK', NULL, 'Av. Angel leaño', NULL, 'La cima', 'G', 'zapopan', '45134', NULL, NULL, 2, '2023-11-24 14:37:23', '2023-11-29 14:21:19', 1, 'WC5', NULL),
(17, 'Borea', NULL, 'P. Valle Real', NULL, 'Valle Real', 'Jaliaco', 'zapopan', NULL, NULL, NULL, 2, '2023-11-25 19:44:12', '2023-11-30 14:40:10', 1, 'XC2', NULL),
(18, 'Hospital Civil Viejo Coronarios', NULL, 'Hospital', '278', 'El Retiro', 'Jalisco', 'Guadalajara', '95100', NULL, NULL, 2, '2023-11-30 14:33:51', '2023-11-30 14:33:51', 1, 'WC2', NULL),
(19, 'Aeropuerto Estacionamiento', NULL, 'Carretera Guadalajara - Chapala', '17.5', 'Aeropuerto', 'Jalisco', 'Guadalajara', '45659', NULL, NULL, 2, '2023-11-30 14:37:10', '2023-11-30 14:39:34', 1, 'XC3', NULL),
(20, 'Plataforma Park', NULL, 'Avenida Victoria', NULL, 'El Salto', 'Jalisco', 'El Salto', '45686', NULL, NULL, 2, '2023-11-30 14:42:26', '2023-11-30 14:42:26', 1, 'WM5', NULL),
(21, 'Central Cargo', NULL, 'Guadalajara-Morelia', '2073', 'Col', 'Jalisco', 'Buenavista', '45640', NULL, NULL, 2, '2023-11-30 14:46:24', '2023-11-30 14:46:24', 1, 'WC9', NULL),
(22, 'Sayula', NULL, 'Sayula', '1', 'Sayula', 'Jalisco', 'Sayula', '44444', NULL, NULL, 2, '2023-12-02 14:48:32', '2023-12-02 14:48:32', 1, NULL, NULL),
(23, 'Azabache', NULL, 'P de la Loma', '300', 'Raquet Club', 'Jalisco', 'San Juan Cosalá', '45820', NULL, NULL, 2, '2023-12-18 16:17:34', '2023-12-18 16:17:34', 1, NULL, 'Condominio'),
(24, 'Arroniz Centro de Cultura', NULL, 'Zaragoza', '24', 'Guadalajara Centro', 'Jalisco', 'Guadalajara', '44100', NULL, NULL, 2, '2023-12-19 00:10:53', '2023-12-19 00:16:50', 1, NULL, 'Centro de Cultura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obrasServicios`
--

DROP TABLE IF EXISTS `obrasServicios`;
CREATE TABLE IF NOT EXISTS `obrasServicios` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `obraId` bigint(20) UNSIGNED DEFAULT NULL,
  `conceptoId` bigint(20) UNSIGNED NOT NULL,
  `precio` float(10,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_obrasServicios_concepto` (`conceptoId`),
  KEY `FK_obrasServicios_obra` (`obraId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `obrasServicios`
--

INSERT INTO `obrasServicios` (`id`, `obraId`, `conceptoId`, `precio`, `created_at`, `updated_at`) VALUES
(1, 22, 8, 250.00, '2023-12-11 12:58:31', '2023-12-11 12:58:31'),
(5, 23, 46, 1500.00, '2024-01-02 09:04:34', '2024-01-02 09:04:34'),
(6, 24, 3, 2000.00, '2024-01-05 10:25:06', '2024-01-05 10:25:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `apodo` varchar(255) DEFAULT NULL,
  `comentario` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `apodo`, `comentario`, `created_at`, `updated_at`) VALUES
(1, 'permission_index', 'web', NULL, NULL, '2022-07-26 00:54:15', '2022-07-26 00:54:15'),
(2, 'permission_create', 'web', NULL, NULL, '2022-07-26 00:54:15', '2022-07-26 00:54:15'),
(3, 'permission_show', 'web', NULL, NULL, '2022-07-26 00:54:15', '2022-07-26 00:54:15'),
(4, 'permission_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(5, 'permission_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(6, 'role_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(7, 'role_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(8, 'role_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(9, 'role_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(10, 'role_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(11, 'user_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(12, 'user_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(13, 'user_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(14, 'user_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(15, 'user_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(16, 'asistencia_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(17, 'asistencia_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(18, 'asistencia_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(19, 'asistencia_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(20, 'asistencia_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(21, 'personal_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(22, 'personal_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(23, 'personal_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(24, 'personal_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(25, 'personal_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(26, 'cajachica_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(27, 'cajachica_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(28, 'cajachica_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(29, 'cajachica_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(30, 'cajachica_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(31, 'maquinaria_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(32, 'maquinaria_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(33, 'maquinaria_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(34, 'maquinaria_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(35, 'maquinaria_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(36, 'calendario_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(37, 'calendario_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(38, 'calendario_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(39, 'calendario_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(40, 'calendario_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(41, 'combustible_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(42, 'combustible_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(43, 'combustible_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(44, 'combustible_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(45, 'combustible_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(46, 'inventario_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(47, 'inventario_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(48, 'inventario_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(49, 'inventario_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(50, 'inventario_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(51, 'obra_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(52, 'obra_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(53, 'obra_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(54, 'obra_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(55, 'obra_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(56, 'puesto_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(57, 'puesto_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(58, 'puesto_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(59, 'puesto_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(60, 'puesto_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(61, 'inventario_restock', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(62, 'inventario_mover', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(65, 'catalogos_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(66, 'catalogos_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(67, 'catalogos_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(68, 'catalogos_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(69, 'catalogos_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(70, 'maquinaria_mtq_dash', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(71, 'maquinaria_mtq_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(72, 'maquinaria_mtq_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(73, 'maquinaria_mtq_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(74, 'maquinaria_mtq_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(75, 'maquinaria_mtq_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(76, 'docs_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(77, 'docs_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(78, 'docs_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(79, 'docs_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(80, 'docs_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(81, 'tiposDocs_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(82, 'tiposDocs_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(83, 'tiposDocs_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(84, 'tiposDocs_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(85, 'tiposDocs_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-25 05:00:00'),
(86, 'ubicaciones_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(87, 'ubicaciones_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(88, 'ubicaciones_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(89, 'ubicaciones_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(90, 'ubicaciones_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(91, 'lugares_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(92, 'lugares_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(93, 'lugares_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(94, 'lugares_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(95, 'lugares_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(96, 'tipoServicios_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(97, 'tipoServicios_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(98, 'tipoServicios_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(99, 'tipoServicios_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(100, 'tipoServicios_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(101, 'calendario_mtq_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(102, 'calendario_mtq_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(103, 'calendario_mtq_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(104, 'calendario_mtq_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(105, 'calendario_mtq_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(106, 'checkList_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(107, 'checkList_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(108, 'checkList_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(109, 'checkList_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(110, 'checkList_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(111, 'mantenimiento_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(112, 'mantenimiento_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(113, 'mantenimiento_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(114, 'mantenimiento_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(115, 'mantenimiento_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(116, 'bitacora_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(117, 'bitacora_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(118, 'bitacora_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(119, 'bitacora_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(120, 'bitacora_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(121, 'grupo_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(122, 'grupo_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(123, 'grupo_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(124, 'grupo_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(125, 'grupo_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(126, 'tarea_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(127, 'tarea_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(128, 'tarea_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(129, 'tarea_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(130, 'tarea_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(131, 'cliente_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(132, 'cliente_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(133, 'cliente_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(134, 'cliente_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(135, 'cliente_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(136, 'calendarioPrincipal_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(137, 'calendarioPrincipal_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(138, 'calendarioPrincipal_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(139, 'calendarioPrincipal_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(140, 'calendarioPrincipal_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(141, 'ticketDescarga_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(142, 'ticketDescarga_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(143, 'ticketDescarga_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(144, 'ticketDescarga_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(145, 'ticketDescarga_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(146, 'personal_assign_maquinaria', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(147, 'maquinaria_assign_personal', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(148, 'obra_assign_maquinaria', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(149, 'asistencia_execute_corte_semanal', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(150, 'inventario_mtq_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(151, 'inventario_mtq_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(152, 'inventario_mtq_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(153, 'inventario_mtq_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(154, 'inventario_mtq_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(155, 'inventario_mtq_restock', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(156, 'inventario_mtq_mover', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(157, 'residente_mtq_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(158, 'residente_mtq_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(159, 'residente_mtq_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(160, 'residente_mtq_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(161, 'residente_mtq_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(162, 'residente_mtq_assign_vehiculo', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(163, 'maquinaria_mtq_assign_personal', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(164, 'maquinaria_mtq_update_uso', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(165, 'maquinaria_mtq_update_uso_bloque', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(166, 'calendario_mtq_create_mantenimiento', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(167, 'checkList_assign_bitacoras', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(168, 'checkList_execute', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(169, 'servicio_Chofer', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(170, 'serviciosTrasporte_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(171, 'serviciosTrasporte_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(172, 'serviciosTrasporte_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(173, 'serviciosTrasporte_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(174, 'serviciosTrasporte_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(175, 'checkList_mis_pendientes', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(176, 'mantenimientoPrintCostos_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-25 05:00:00'),
(177, 'serviciosTrasporte_cobros', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(178, 'mantenimientos_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-25 05:00:00'),
(179, 'residente_mtq_generateUser', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(180, 'maquinariaUso_mtq_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(181, 'maquinariaUso_mtq_update_uso_bloque', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(182, 'maquinariaUso_mtq_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(183, 'maquinariaUso_mtq_edit_uso_bloque', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(184, 'personalEspecial_generateUser', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(185, 'personalEspecial_index', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(186, 'personalEspecial_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(187, 'personalEspecial_show', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(188, 'personalEspecial_edit', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(189, 'personalEspecial_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(192, 'asistencia_registro_individual', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(193, 'maquinaria_mtq_edit_uso', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(194, 'ajustesCisterna_create', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16'),
(195, 'ajustesCisterna_destroy', 'web', NULL, NULL, '2022-07-26 00:54:16', '2022-07-26 00:54:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

DROP TABLE IF EXISTS `personal`;
CREATE TABLE IF NOT EXISTS `personal` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) UNSIGNED DEFAULT NULL,
  `estatusId` bigint(20) UNSIGNED DEFAULT NULL,
  `nombres` varchar(255) DEFAULT NULL,
  `apellidoP` varchar(255) DEFAULT NULL,
  `apellidoM` varchar(255) DEFAULT NULL,
  `fechaNacimiento` datetime DEFAULT NULL,
  `lugarNacimiento` varchar(255) DEFAULT NULL,
  `curp` varchar(21) DEFAULT NULL,
  `ine` varchar(20) DEFAULT NULL,
  `rfc` varchar(20) DEFAULT NULL,
  `licencia` varchar(20) DEFAULT NULL,
  `tipoLicencia` varchar(200) DEFAULT NULL,
  `cpf` varchar(25) DEFAULT NULL,
  `cpe` varchar(25) DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `civil` varchar(25) DEFAULT NULL,
  `hijos` int(11) DEFAULT NULL,
  `sangre` varchar(10) DEFAULT NULL,
  `aler` text,
  `profe` varchar(255) DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `interior` varchar(255) DEFAULT NULL,
  `colonia` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `cp` varchar(255) DEFAULT NULL,
  `particular` varchar(255) DEFAULT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `mailpersonal` varchar(255) DEFAULT NULL,
  `mailEmpresarial` varchar(255) DEFAULT NULL,
  `casa` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `puestoNivelId` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `puestoId` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `personalEspecial` int(1) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_personal_userId` (`userId`),
  KEY `FK_personal_userEstatusId` (`estatusId`),
  KEY `FK_personal_puestoNivelId` (`puestoNivelId`),
  KEY `FK_personal_puestoId` (`puestoId`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `userId`, `estatusId`, `nombres`, `apellidoP`, `apellidoM`, `fechaNacimiento`, `lugarNacimiento`, `curp`, `ine`, `rfc`, `licencia`, `tipoLicencia`, `cpf`, `cpe`, `sexo`, `civil`, `hijos`, `sangre`, `aler`, `profe`, `calle`, `numero`, `interior`, `colonia`, `estado`, `ciudad`, `cp`, `particular`, `celular`, `mailpersonal`, `mailEmpresarial`, `casa`, `foto`, `puestoNivelId`, `created_at`, `updated_at`, `puestoId`, `personalEspecial`) VALUES
(1, 2, 1, 'Jorge', 'Morelos', NULL, '1971-04-23 00:00:00', 'GUADALAJARA', 'MOLL710423HJCRMS00', '', 'MOLL7104236E9', '', NULL, '', NULL, 'Masculino', 'Soltero', NULL, 'O-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '523335763523', '523335763523', 'ljmorelos@gmail.com', 'jmorelos@q2ces.com', NULL, NULL, 7, '2023-08-25 14:37:07', '2023-09-05 13:44:07', 22, NULL),
(2, 6, 4, 'Juan Carlos', 'Torres', 'Flores', '1974-04-22 00:00:00', 'Zapopan', 'TOFJ740422359', '', 'TOFJ740422HJCRLN04', '', NULL, '', NULL, 'Masculino', 'Casado', NULL, 'O+', 'Ninguna', 'Secundaria', 'Clemente Orozco', '86', NULL, 'Guadalajara', 'Jalisco', NULL, '44510', NULL, NULL, 'j21238895@gmail.com', 'jtorres@q2ces.com', NULL, NULL, 5, '2023-08-25 22:35:46', '2023-10-02 21:35:53', 1, NULL),
(3, 10, 1, 'J. Félix', 'Villalobos', 'Ayala', '1964-11-27 00:00:00', 'Zapopan, Jalisco', 'VIAJ641227HJCLYL02', '', 'VIAJ641127DW3', '', NULL, '', NULL, 'Masculino', 'Casado', NULL, 'O+', 'Ninguna', 'Secundaria', 'Av. Guadalajara', '1795', NULL, 'Hogares de Nuevo México', 'Jalisco', 'Zapopan', '45138', NULL, '33 3389 3569', 'wydtrujillo@gmail.com', 'jvillalobos@q2ces.com', NULL, NULL, 5, '2023-08-29 15:09:46', '2023-10-12 14:15:18', 5, NULL),
(4, 11, 1, 'José Alberto', 'Ibarra', 'Medina', '1975-09-15 00:00:00', 'Guadalajara, Jalisco', 'IAMA750915HJCBDL06', '3470054629185', 'IAMA750915QF1', '', NULL, '', NULL, 'Masculino', 'Casado', NULL, 'O+', 'Ninguna', 'Lic. Informatica', 'Villa Martelli', '4', NULL, 'Villalta', 'Jalisco', 'Tlajomulco de Zúñiga', '45653', NULL, '33 1088 2653', 'jose.alberto.ibarra.medina@gmail.com', 'jibarra@q2ces.com', NULL, NULL, 7, '2023-08-29 17:50:43', '2023-09-27 17:19:43', 23, NULL),
(5, 12, 3, 'Juan Carlos', 'Torres', 'Flores', '1974-04-22 00:00:00', 'Zapopan, Jalisco', 'TOFJ740422HJCRLN04', '', 'TOFJ740422359', '', NULL, '', NULL, 'Masculino', 'Casado', NULL, 'O+', 'Ninguna', 'Secundaria', 'Clemente Orozco', '86', NULL, 'Santamaria del Pueblito', 'Jalisco', 'Zapopan', '44510', NULL, '33 2068 0938', 'j21238895@gmail.com', 'jtorresflores@q2ces.com', NULL, NULL, 4, '2023-08-29 18:54:17', '2023-10-31 13:17:57', 19, NULL),
(6, 1, 1, 'Kevin Bryan Jonathan', 'Cobián', 'Franco', '2001-03-23 00:00:00', 'Guadalajara, Jalisco', 'COFK010323HJCBRVA2', '', 'COFK0103232W5', '', NULL, '', NULL, 'Masculino', 'Soltero', NULL, 'O+', 'Ninguna', 'Tecnólogo en desarrollo de software', 'José Antonio Lucano', '1115', NULL, 'Residencial la soledad', 'Jalisco', 'Guadalajara', '45525', NULL, '33 2932 8782', 'kevinbryan900@gmail.com', 'kcobian@q2ces.com', NULL, NULL, 7, '2023-08-29 22:01:49', '2023-12-11 22:53:32', 22, NULL),
(7, 14, 1, 'Paulino', 'Magaña', 'Contreras', '1974-05-12 00:00:00', 'Tamazula, Jalisco', 'MACP740512HJCGNL03', '', 'MACP740512IC9', '', NULL, '', NULL, 'Masculino', 'Casado', NULL, 'A+', 'Ninguna', 'Primaria', 'Plan de Guadalupe', '1790', '18', 'Parques del auditorio', 'Jalisco', 'Zapopan', '45180', NULL, '34 1198 8872', 'contreras120574@gmail.com', 'pmagana@q2ces.com', NULL, NULL, 5, '2023-08-29 22:20:45', '2023-10-12 14:17:29', 14, NULL),
(8, 15, 1, 'Luis Alberto', 'Avila', 'Benites', '1988-02-13 00:00:00', 'Zapopan, Jalisco', 'AIBL880213HJCVNS08', '', 'AIBL880213CIA', '', NULL, '', NULL, 'Masculino', 'Casado', NULL, 'O+', 'Ninguna', 'Secundaria', 'Lirio', '10', NULL, 'La Magdalena', 'Jalisco', 'Zapopan', '45200', NULL, '33 1248 2034', 'luisavilabenitez.pumas77@gmail.com', 'lavila@q2ces.com', NULL, NULL, 5, '2023-08-29 22:49:27', '2023-10-12 14:16:02', 6, NULL),
(9, 16, 1, 'David Alejandro', 'Fajardo', 'Barrera', '1977-03-02 00:00:00', 'Guadalajara, Jalisco', 'FABD770302HJCJRV05', '', 'FABD770302AE1', '', NULL, '', NULL, 'Masculino', 'Casado', NULL, 'A+', 'Ninguna', 'Secundaria', 'José Miguel Macías', '3166', NULL, 'Polanco', 'Jalisco', 'Guadalajara', '44960', NULL, '33 1297 9213', '', 'dfajardo@q2ces.com', NULL, NULL, 4, '2023-08-29 23:05:27', '2023-10-12 14:12:13', 20, NULL),
(10, 17, 3, 'Marcelino', 'Razón', 'Serrano', '1976-09-14 00:00:00', 'Ameca, Jalisco', 'RASM760914HJCZRR04', '', 'RASM760914EC1', '', NULL, '', NULL, 'Masculino', 'Soltero', NULL, 'O+', 'Ninguna', 'Bachillerato', 'CM Moreno', '379', NULL, 'Francisco I Madero', 'Jalisco', 'Sanpedro Tlaquepaque', '45530', NULL, '33 2954 5168', 'razonmarc146@gmail.com', 'mrazon@q2ces.com', NULL, NULL, 5, '2023-08-30 17:06:08', '2023-11-06 16:08:03', 14, NULL),
(11, 3, 3, 'Pedro', 'López', 'Hernández', '1962-12-13 00:00:00', 'Poncitlán, Jalisco', 'LOHP621213HJCPRD02', '', 'LOHP621213A77', '', NULL, '', NULL, 'Masculino', 'Soltero', NULL, 'O+', 'Ninguna', 'Secundaria', 'Josefa Ortiz de Domínguez', '224', NULL, 'Reforma Olímpica', 'Jalisco', 'Poncitlán', '45954', NULL, '31 2121 1013', 'pedro.lopezg@gmail.com', 'plopez@q2ces.com', NULL, NULL, 5, '2023-08-30 17:40:37', '2024-01-03 17:41:23', 14, NULL),
(12, 19, 1, 'Fernando', 'Alcalá', 'Moreno', '1975-02-03 00:00:00', 'El Zapote del Valle', 'AAMF750203HJCLRR09', '', 'AAMF7502036T0', '1R63229804', NULL, '', NULL, 'Masculino', 'Casado', NULL, 'AB+', 'Ninguna', 'Primaria', 'Juan Manuel Ruvalcaba de la Mora', '23', NULL, 'Santa Lucia', 'Jalisco', 'Zapopan', '45200', NULL, '33 1695 0631', 'oper416e@gmail.com', 'falcala@q2ces.com', NULL, NULL, 5, '2023-08-30 18:00:35', '2023-10-12 14:14:53', 6, NULL),
(13, 20, 3, 'Alfonso', 'Aviña', 'García', '1973-04-07 00:00:00', 'Zapopan, Jalisco', 'AIGA730407HJCVRL08', '', 'AIGA730407TPA', 'JAL0043099', NULL, '', NULL, 'Masculino', 'Casado', NULL, 'A+', 'Ninguna', 'Secundaria', 'San Oscar', '224', NULL, 'San José Ejidal', 'Jalisco', 'Zapopan', '45200', NULL, '33 1463 5148', 'alfonso.avina@q2s.mx', 'aavina@q2ces.com', NULL, NULL, 5, '2023-08-30 18:36:22', '2023-10-02 22:31:02', 6, NULL),
(14, 21, 1, 'Edgar Villalobos Gómez', 'Villalobos', 'Gómez', '1991-03-11 00:00:00', 'Zapopan, Jalisco', 'VIGE910311HJCLMD08', '', 'VIGE910311KGA', '01N4005279', NULL, '', NULL, 'Masculino', 'Casado', NULL, 'O+', 'Ninguna', 'Bachillerato', 'Av. Guadalajara', '1795', NULL, 'Hogares de Nuevo México', 'Jalisco', 'Zapopan', '45160', NULL, '33 1134 2699', '', 'oper416e@gmail.com', NULL, NULL, 5, '2023-08-30 19:02:29', '2024-01-04 15:25:56', 9, NULL),
(15, 22, 1, 'José Israel', 'López', 'López', '1978-06-18 00:00:00', 'Guadalajara, Jalisco', 'LOLI780618HJCPPS09', '', 'LOLI7806188M2', '', NULL, '', NULL, 'Masculino', 'Casado', NULL, 'O+', 'Ninguna', 'Lic. administración de empresas', 'Guanajuato', '910', NULL, 'El Mante', 'Jalisco', 'Guadalajara', '45235', NULL, '33 2183 6472', 'israellopezl@hotmail.com', 'jlopez@q2ces.com', NULL, NULL, 1, '2023-08-30 21:47:37', '2023-10-02 15:27:43', 7, NULL),
(16, 5, 1, 'M', 'Finkelstein Moel', 'Moel', '1996-11-01 00:00:00', 'Guadalajara, Jalisco', 'FIMM961101HJCNLR10', '', 'FIMM961101977', '', NULL, '', NULL, 'Masculino', 'Soltero', NULL, 'A+', 'Ninguna', 'Lic. Finanzas y contabilidad', 'José María Heredia', '2387', NULL, 'Lomas de Guevara', 'Jalisco', 'Guadalajara', '44657', NULL, '33 3189 2541', 'mauriciofinkelstein@gmail.com', 'mfinkelstein@q2ces.com', NULL, NULL, 2, '2023-08-30 22:15:29', '2024-01-02 16:25:13', 4, NULL),
(17, 24, 1, 'Paola', 'Rodríguez', 'Castellano', '1999-01-22 00:00:00', 'Guadalajara, Jalisco', 'ROCP990122MJCD5L02', '', 'ROCP990122KZA', '', NULL, '', NULL, 'Masculino', 'Soltero', NULL, 'O+', 'Ninguna', 'Lic. Contaduría publica', 'Av. Dr. Luis Farah', '1023', NULL, 'Villas de los Belenes', 'Jalisco', 'Zapopan', '45157', NULL, '33 1466 2447', 'prc.2299@gmail.com', 'prodriguez@q2ces.com', NULL, NULL, 1, '2023-08-30 22:28:43', '2023-10-02 20:59:10', 23, NULL),
(18, 30, 3, 'Roberto', 'Sandoval', 'Gallardo', '1972-04-14 00:00:00', 'Tonalá, Jalisco', 'SAGR720414HJCNLB05', '2691019996598', 'SAGR7204141C7', '', NULL, '', NULL, 'Masculino', 'Casado', NULL, 'A+', 'Ninguna', 'Bachillerato', 'Calle Jaime Anezagasti', '72', NULL, 'Tonalá Centro', 'Jalisco', 'Tonalá', '45400', NULL, '33 22 61 95 30', 'robertosandoval1404@gmail.com', 'rsandoval@q2ces.com', NULL, NULL, NULL, '2023-10-03 18:07:04', '2023-10-17 22:19:22', 12, NULL),
(19, 31, 1, 'Rigoberto', 'Barajas', 'Maldonado', '1986-08-23 00:00:00', 'Michoacán de Ocampo', 'BAMR860823HMNRLG05', '3026070577062', 'BAMR860823UZ4', '', NULL, '', NULL, 'Masculino', 'Casado', NULL, 'A+', 'Ninguna', 'Secundaria', 'Av. Valle Del Sol', '531 861', NULL, 'Fracc. Valle de los Molinos', 'Jalisco', NULL, '45200', NULL, '33 14 34 77 79', 'rb0657178@gmail.com', 'rbarajas@q2ces.com', NULL, NULL, NULL, '2023-10-03 19:05:09', '2023-10-12 14:18:07', 14, NULL),
(20, 32, 3, 'Mario Alberto', 'Mendoza', 'Luna', '1992-10-08 00:00:00', 'Guadalajara Jalisco', 'MELM921008HJCNNR02', '3424087467127', 'MELM9210088Z7', 'JAL0066054', NULL, '', NULL, 'Masculino', 'Casado', NULL, 'O+', 'Ninguna', 'Secundaria', 'Privada Frijol', '180', NULL, 'Crucero de la Mesa Poniente', 'Jalisco', NULL, '45189', NULL, '33 1869 8919', 'marioalberto2021@hotmail.com', 'mmendoza@q2ces.com', NULL, NULL, NULL, '2023-10-03 21:56:38', '2023-11-27 15:01:46', 6, NULL),
(21, 33, 3, 'Eduardo', 'Navarrete', 'Haro', '1969-09-27 00:00:00', 'Guadalajara, Jalisco', 'NAHE690927HJCVRD09', '2960044002030', 'NAHE690927NE6', '', NULL, '', NULL, 'Masculino', 'Soltero', NULL, 'O-', 'Ninguna', 'Primaria', 'Calle Rafael Martínez', '547 Altos', NULL, 'Constitución (NTE).', 'Jalisco', NULL, '45180', NULL, '33 34558630', 'navarreteeduardo025@gmail.com', 'enavarrete@q2ces.com', NULL, NULL, NULL, '2023-10-03 22:15:59', '2023-11-27 14:59:34', 19, NULL),
(22, 34, 1, 'Néstor', 'Prieto', 'Espinosa', '1995-03-04 00:00:00', 'Mixcoac B. Juárez D.F.', 'PIEN950304HDFRSS07', '2183094828777', 'PIEN950304CA6', '2R51652645', NULL, '', NULL, 'Femenino', 'Soltero', NULL, 'O+', 'Ninguna', 'Bachillerato', 'Valle de San Pedro', '2347', NULL, 'Jardines del Valle', 'Jalisco', NULL, '45138', NULL, '55 7432 3262', 'prietoespinosanestor@hotmail.com', 'nprieto@q2ces.com', NULL, NULL, NULL, '2023-10-03 22:34:41', '2023-10-12 14:17:01', 6, NULL),
(23, 38, 1, 'Ulises Gabriel', 'Nuñez', 'Fregoso', '1984-08-13 00:00:00', 'ZAPOPAN, JALISCO', 'NUFU840813HJCXRL09', '3053045118530', 'NUFU840813U3', '', NULL, '', NULL, 'Masculino', 'Soltero', 3, 'O+', 'NINGUNA', 'LIC. EN ARQUITECTURA', 'SANTA ROSA', '128 B', NULL, 'Zapopan', 'Jalisco', NULL, '45150', NULL, '3315633113', 'ulisesgabrielkwa@gmail.com', 'ununez@q2ces.com', NULL, NULL, NULL, '2023-12-06 15:04:40', '2023-12-06 15:27:59', 24, NULL),
(24, 40, 1, 'USER Test', 'test1', 'Test 23', '2001-03-24 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '33225566877', '', 'utest1@q2ces.com', NULL, NULL, 20, '2023-12-21 18:03:03', '2023-12-22 17:46:40', 25, 1),
(25, 41, 1, 'Javier', 'Rodriguez', 'Martinez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3314022131', '', 'jrodriguez@q2ces.com', NULL, NULL, 21, '2023-12-22 14:59:45', '2023-12-22 15:01:36', 26, 1),
(26, 42, 1, 'Victor', 'Finkelstein', 'London', '1967-12-28 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3331892270', 'vfinkelstein@q2s.mx', 'vfinkelstein@q2s.mx', NULL, NULL, 20, '2023-12-22 15:14:16', '2023-12-22 15:14:38', 4, 1),
(27, 3, 1, 'Josue Isaias', 'Alcala', 'Cortez', '1994-06-16 00:00:00', 'GUADALAJARA, JALISCO', 'AACJ940616HJCLRS00', '2617103627050', 'AACJ940616LQ2', '', NULL, '', NULL, 'Masculino', 'Soltero', NULL, 'A+', 'NINGUNA', 'OPERADOR DE MAQUINARIA', 'C. CAM. EL TAJO', '517', NULL, NULL, 'Jalisco', NULL, '45602', NULL, '33 33751593', 'alcalacortezjosueisaias@gmail.com', 'jalcala@q2ces.com', NULL, NULL, NULL, '2024-01-03 16:56:36', '2024-01-03 17:41:11', 14, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prioridades`
--

DROP TABLE IF EXISTS `prioridades`;
CREATE TABLE IF NOT EXISTS `prioridades` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `color` varchar(8) DEFAULT NULL,
  `comentario` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prioridades`
--

INSERT INTO `prioridades` (`id`, `nombre`, `color`, `comentario`) VALUES
(1, 'Urgente', 'rojo', 'Requiere de atención inmediata'),
(2, 'Necesaria', 'naranja', 'Atención prioritaria'),
(3, 'Deseable', 'amarillo', 'Atención normal'),
(4, 'Prorrogable', '#A6CE34', 'Atención sin prioridad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacionCheckLists`
--

DROP TABLE IF EXISTS `programacionCheckLists`;
CREATE TABLE IF NOT EXISTS `programacionCheckLists` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `bitacoraId` bigint(20) UNSIGNED NOT NULL,
  `checkListId` bigint(20) UNSIGNED DEFAULT NULL,
  `maquinariaId` bigint(20) UNSIGNED NOT NULL,
  `personalId` bigint(20) UNSIGNED NOT NULL,
  `comentario` text,
  `estatus` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_programacionCheckLists_checkListId` (`checkListId`),
  KEY `FK_programacionCheckLists_maquinariaId` (`maquinariaId`),
  KEY `FK_programacionCheckLists_personalId` (`personalId`),
  KEY `FK_programacionCheckLists_bitacoraId` (`bitacoraId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provedorCategorias`
--

DROP TABLE IF EXISTS `provedorCategorias`;
CREATE TABLE IF NOT EXISTS `provedorCategorias` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `proveedor_id` bigint(20) UNSIGNED NOT NULL,
  `proveedor_categoria_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_provedorCategorias_proveedorId` (`proveedor_id`),
  KEY `FK_provedorCategorias_categoriaId` (`proveedor_categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `provedorCategorias`
--

INSERT INTO `provedorCategorias` (`id`, `proveedor_id`, `proveedor_categoria_id`) VALUES
(1, 3, 3),
(2, 4, 2),
(3, 4, 3),
(4, 5, 2),
(5, 5, 3),
(6, 6, 3),
(7, 7, 3),
(8, 8, 3),
(9, 9, 3),
(10, 10, 8),
(11, 11, 8),
(12, 12, 8),
(13, 13, 8),
(14, 14, 3),
(15, 15, 2),
(16, 15, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE IF NOT EXISTS `proveedor` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `razonSocial` varchar(255) DEFAULT NULL,
  `rfc` varchar(255) DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `exterior` varchar(255) DEFAULT NULL,
  `interior` varchar(255) DEFAULT NULL,
  `colonia` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `cp` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `fiscal` varchar(255) DEFAULT NULL,
  `estatus` varchar(255) DEFAULT NULL,
  `categoriaId` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `comentario` text,
  PRIMARY KEY (`id`),
  KEY `FK_proveedor_categoria` (`categoriaId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `nombre`, `razonSocial`, `rfc`, `calle`, `exterior`, `interior`, `colonia`, `estado`, `ciudad`, `cp`, `logo`, `fiscal`, `estatus`, `categoriaId`, `created_at`, `updated_at`, `comentario`) VALUES
(1, 'Sotelo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(2, 'Villa Chavez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(3, 'Refacciones Nissan', 'Refacciones Nissan', NULL, 'Av. Jesús', '3185', NULL, 'Las Bóvedas', 'Jalisco', 'Zapopan', '45138', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Autozone', 'Autozone', NULL, 'Av. Juan Gil Preciado', '2685', NULL, 'Parques Zapopan', 'Jalisco', 'Zapopan', '45138', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'O\'Reilly', 'O\'Reilly', NULL, 'Av. Manuel Avila Camacho', '2970', NULL, 'Conjunto Patria', 'Jalisco', 'Zapopan', '45160', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Refaccionaria Beny', 'Beny', NULL, 'Juan Gil Preciado', '915', NULL, 'Arcos de Zapopan', 'Jalisco', 'Zapopan', '45130', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'DAR Refaccionarias', 'DAR', NULL, 'Av. Juan Pablo II', '50', NULL, 'El Vigía', 'Jalisco', 'Zapopan', '45205', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Llantas de Occidente', 'Oscar David Hernandez Peña', 'HEPO751029US0', 'Avenida del Pinar', '3135', NULL, 'Pinar de la Calma', 'Jalisco', 'Zapopan', '45080', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Frenos Únicos', 'Oscar Ríos Piedra', NULL, 'Libramiento Carretera Base Aérea', '1595', NULL, 'El Triángulo', 'Jalisco', 'Zapopan', '45200', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Invasion Caps', 'Invasion Caps', NULL, 'Av. Mariano Otero', '1280', NULL, 'Chapalita', 'Jalisco', 'Guadalajara', '44510', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Safety Depot', 'Safety Depot', NULL, 'Av. Base Aerea', '25', NULL, 'Nuevo México', 'Jalisco', 'Zapopan', '45138', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'N/A', 'N/A', NULL, 'N/A', 'N/A', NULL, 'N/A', 'Jalisco', 'Guadalajara', '44100', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Yazbek', 'Yazbek', NULL, 'Av. México', '2500', NULL, 'Ladrón de Guevara', 'Jalisco', 'Guadalajara', '44600', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'SOLUTECQ', 'SOLUTECQ', NULL, 'Calle de las Pomas', '160-A', NULL, 'Tlaquepaque', 'Jalisco', 'San Pedro Tlaquepaque', '45602', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'APYMSA', 'APYMSA', NULL, 'Juan Gil Preciado', '4051', NULL, 'Hogares de Nuevo México', 'Jalisco', 'Zapopan', '45138', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedorCategoria`
--

DROP TABLE IF EXISTS `proveedorCategoria`;
CREATE TABLE IF NOT EXISTS `proveedorCategoria` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `comentario` text,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedorCategoria`
--

INSERT INTO `proveedorCategoria` (`id`, `nombre`, `comentario`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Materiales', NULL, 1, NULL, NULL),
(2, 'Herramientas', NULL, 1, NULL, NULL),
(3, 'Refacciones', NULL, 1, NULL, NULL),
(4, 'Servicios Gasolina', NULL, 1, NULL, NULL),
(5, 'Servicios Diesel', NULL, 1, NULL, NULL),
(6, 'Obra Civil', NULL, 1, NULL, NULL),
(7, 'Taller', NULL, 1, NULL, NULL),
(8, 'Administrativos', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedorContactos`
--

DROP TABLE IF EXISTS `proveedorContactos`;
CREATE TABLE IF NOT EXISTS `proveedorContactos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `proveedorId` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_proveedorContactos_proveedor` (`proveedorId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

DROP TABLE IF EXISTS `puesto`;
CREATE TABLE IF NOT EXISTS `puesto` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `comentario` text,
  `puestoNivelId` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_puesto_puestoNivelId` (`puestoNivelId`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`id`, `nombre`, `comentario`, `puestoNivelId`) VALUES
(1, 'Almacenista', 'Descripción del puesto.', 6),
(2, 'Auxiliar General', 'Descripción del puesto', 6),
(3, 'Carpintero', 'Descripción del puesto', 10),
(4, 'Gerente de Operaciones', 'Descripción del puesto', 9),
(5, 'Chofer', 'Descripción del puesto', 5),
(6, 'Chofer de Tractocamion', 'Descripción del puesto', 5),
(7, 'Coordinador de Operaciones', 'Descripción del puesto', 1),
(8, 'Capturista de Datos', 'Descripción del puesto', 6),
(9, 'Jefe de Taller', 'Descripción del puesto', 3),
(10, 'Electrico', 'Descripción del puesto', 10),
(11, 'Guardia de Seguridad', 'Descripción del puesto', 10),
(12, 'Herrero', 'Descripción del puesto', 10),
(13, 'Inventarios', 'Descripción del puesto', 6),
(14, 'Operador de Maquinaria', 'Descripción del puesto', 5),
(15, 'Pintor', 'Descripción del puesto', 10),
(16, 'Plomero', 'Descripción del puesto', 10),
(17, 'Velador', 'Descripción del puesto', 10),
(18, 'Vigilante', 'Descripción del puesto', 10),
(19, 'Mecánico', 'Descripción del puesto', 4),
(20, 'Electromecánico', 'Descripción del puesto', 4),
(21, 'Laminero', 'Descripción del puesto', 10),
(22, 'Sistemas', 'Descripción del puesto', 7),
(23, 'Desarrollador BackEnd', NULL, 8),
(24, 'Operador de Grúa', NULL, 5),
(25, 'Administrador Del Sistema', 'Descripción del puesto', 20),
(26, 'Jefe del Combustible', 'Descripción del puesto', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestoNivel`
--

DROP TABLE IF EXISTS `puestoNivel`;
CREATE TABLE IF NOT EXISTS `puestoNivel` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `requiereAsistencia` int(1) NOT NULL DEFAULT '0',
  `usaCajaChica` tinyint(1) NOT NULL DEFAULT '0',
  `comentario` text,
  `usoCombustible` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `estatusId` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puestoNivel`
--

INSERT INTO `puestoNivel` (`id`, `nombre`, `requiereAsistencia`, `usaCajaChica`, `comentario`, `usoCombustible`, `estatusId`) VALUES
(1, 'Administrativo Oficina', 0, 1, 'Descripción del puesto', 1, 1),
(2, 'Gerente', 0, 0, 'Descripción del puesto', 1, 1),
(3, 'Coordinador de Taller', 1, 1, 'Descripción del puesto', 1, 1),
(4, 'Mecánico', 1, 1, 'Descripción del puesto', 1, 1),
(5, 'Operador', 1, 1, 'Descripción del puesto', 1, 1),
(6, 'Capturista', 1, 0, 'Descripción del puesto', 0, 1),
(7, 'Soporte IT', 0, 0, 'Soporte IT', 0, 1),
(8, 'Desarrollo', 0, 0, 'Para uso del área de desarrollo de SW', 0, 1),
(9, 'Dirección', 0, 1, NULL, 1, 1),
(10, 'Taller', 1, 0, NULL, 0, 1),
(20, 'Administracion Especial', 0, 0, 'Descripción del puesto', 0, 1),
(21, 'Administracion Combustible', 0, 1, 'Descripción del puesto', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `randomTest`
--

DROP TABLE IF EXISTS `randomTest`;
CREATE TABLE IF NOT EXISTS `randomTest` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `randomTest`
--

INSERT INTO `randomTest` (`id`, `nombre`) VALUES
(1, 'Texto'),
(2, 'Texto'),
(3, 'Texto'),
(4, 'Texto'),
(5, 'Texto'),
(6, 'Texto'),
(7, 'Texto'),
(8, 'Texto'),
(9, 'Texto'),
(10, 'Texto'),
(11, 'Texto'),
(12, 'Texto'),
(13, 'Texto'),
(14, 'Texto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `refacciones`
--

DROP TABLE IF EXISTS `refacciones`;
CREATE TABLE IF NOT EXISTS `refacciones` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `numeroParte` varchar(200) DEFAULT NULL,
  `marcaId` bigint(20) UNSIGNED NOT NULL,
  `tipoRefaccionId` bigint(20) UNSIGNED NOT NULL,
  `maquinariaId` bigint(20) UNSIGNED NOT NULL,
  `comentario` text,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `relacionInventarioId` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_refacciones_marca` (`marcaId`),
  KEY `FK_refacciones_maquinaria` (`maquinariaId`),
  KEY `FK_refacciones_tipo` (`tipoRefaccionId`),
  KEY `FK_refacciones_inventario` (`relacionInventarioId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `refacciones`
--

INSERT INTO `refacciones` (`id`, `nombre`, `numeroParte`, `marcaId`, `tipoRefaccionId`, `maquinariaId`, `comentario`, `activo`, `relacionInventarioId`, `created_at`, `updated_at`) VALUES
(1, NULL, 'C-1828', 47, 2, 31, NULL, 1, 31, '2023-12-13 11:26:53', '2023-12-13 11:30:11'),
(2, NULL, 'BF825', 45, 1, 31, NULL, 1, 32, '2023-12-13 11:26:53', '2023-12-13 11:30:11'),
(3, NULL, 'FS1000', 46, 8, 31, NULL, 1, 33, '2023-12-13 11:26:53', '2023-12-13 11:30:11'),
(4, NULL, 'B7322', 45, 2, 29, NULL, 1, 28, '2023-12-13 11:31:38', '2023-12-13 11:31:38'),
(5, NULL, 'BF46100-O', 45, 1, 29, NULL, 1, 29, '2023-12-13 11:31:38', '2023-12-13 11:31:38'),
(6, NULL, 'BF7674-D', 45, 6, 29, NULL, 1, 30, '2023-12-13 11:31:38', '2023-12-13 11:31:38'),
(7, NULL, 'C1028', 47, 2, 24, NULL, 1, 69, '2023-12-26 16:57:48', '2023-12-26 16:57:48'),
(8, NULL, 'BF7552', 45, 1, 24, NULL, 1, 70, '2023-12-26 16:57:48', '2023-12-26 16:57:48'),
(9, NULL, 'A8504', 47, 5, 24, NULL, 1, 71, '2023-12-26 16:57:48', '2023-12-26 16:57:48'),
(10, NULL, 'BT260-10', 45, 7, 24, NULL, 1, 72, '2023-12-26 16:57:48', '2023-12-26 16:57:48'),
(11, NULL, NULL, 45, 6, 28, NULL, 1, NULL, '2024-01-08 13:45:31', '2024-01-08 13:45:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `refaccionTipo`
--

DROP TABLE IF EXISTS `refaccionTipo`;
CREATE TABLE IF NOT EXISTS `refaccionTipo` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `comentario` text,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `refaccionTipo`
--

INSERT INTO `refaccionTipo` (`id`, `nombre`, `comentario`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Filtro de Combustible Primario', NULL, 1, NULL, NULL),
(2, 'Filtro de Aceite', NULL, 1, NULL, NULL),
(3, 'Filtro de Aire Secundario', NULL, 1, NULL, NULL),
(5, 'Filtro de Aire Primario', NULL, 1, NULL, NULL),
(6, 'Filtro de Combustible Secundario', NULL, 1, NULL, NULL),
(7, 'Filtro Hidráulico', NULL, 1, NULL, NULL),
(8, 'Filtro Separador de Agua', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reparaciones`
--

DROP TABLE IF EXISTS `reparaciones`;
CREATE TABLE IF NOT EXISTS `reparaciones` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `codigo` varchar(8) DEFAULT NULL,
  `comentario` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reparaciones`
--

INSERT INTO `reparaciones` (`id`, `nombre`, `codigo`, `comentario`, `created_at`, `updated_at`) VALUES
(1, 'Proceso Demo', 'SDF', 'Proceso demo o sin definir', '2023-08-28 11:36:35', '2023-08-28 11:36:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `residente`
--

DROP TABLE IF EXISTS `residente`;
CREATE TABLE IF NOT EXISTS `residente` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) UNSIGNED DEFAULT NULL,
  `obraId` bigint(20) UNSIGNED DEFAULT NULL,
  `clienteId` bigint(20) UNSIGNED DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `puesto` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `firma` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `comentario` text,
  `autoId` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_residente_userId` (`userId`),
  KEY `FK_residente_obraId` (`obraId`),
  KEY `FK_residente_clienteId` (`clienteId`),
  KEY `FK_residente_autoId` (`autoId`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `residente`
--

INSERT INTO `residente` (`id`, `userId`, `obraId`, `clienteId`, `nombre`, `apellido`, `empresa`, `puesto`, `telefono`, `firma`, `email`, `comentario`, `autoId`) VALUES
(3, NULL, 1, 1, 'Contacto', NULL, NULL, NULL, '33-2183-6472', NULL, 'contacto@q2ces.com', NULL, NULL),
(5, NULL, NULL, 2, 'Dario Mendoza', NULL, NULL, NULL, '33 1774 9939', NULL, 'dmendoza@q2ces.com', NULL, 74),
(6, NULL, NULL, 2, 'Carlos Castañeda', NULL, NULL, NULL, '33 3809 8053', NULL, 'ccastaneda@q2ces.com', NULL, 50),
(7, 46, NULL, 2, 'Eric Franco', NULL, NULL, NULL, '33 1774 9944', NULL, 'eric.franco@mtqmexico.com', NULL, 41),
(8, NULL, NULL, 2, 'Eric Moctezuma', NULL, NULL, NULL, '55 5415 6890', NULL, 'emoctezuma@q2ces.com', NULL, 69),
(9, NULL, NULL, 2, 'Ernesto Casillas', NULL, NULL, NULL, '33 1716 6083', NULL, 'ecasillas@q2ces.com', NULL, 55),
(10, NULL, NULL, 2, 'Pedro Pacheco', NULL, NULL, NULL, '33 2257 4273', NULL, 'ppacheco@q2ces.com', NULL, 54),
(11, NULL, NULL, 2, 'Diana Mora', NULL, NULL, NULL, NULL, NULL, 'dmora@q2ces.com', NULL, 49),
(12, 45, NULL, 2, 'Osvaldo Saldaña', NULL, NULL, NULL, '33 1774 9940', NULL, 'osvaldo.saldana@mtqmexico.com', NULL, 42),
(13, NULL, NULL, 2, 'Fernando Luna', NULL, NULL, NULL, '33 1250 4473', NULL, 'fluna@q2ces.com', NULL, 43),
(14, NULL, NULL, 2, 'Diana Guzman', NULL, NULL, NULL, '33 2149 4877', NULL, 'dguzman@q2ces.com', NULL, 35),
(15, NULL, NULL, 2, 'Osvaldo Aguilar', NULL, NULL, NULL, '33 3318 7577', NULL, 'oaguilar@q2ces.com', NULL, 37),
(16, NULL, NULL, 2, 'Humberto Lopez', NULL, NULL, NULL, '33 3954 1721', NULL, 'hlopez@q2ces.com', NULL, 39),
(17, 44, NULL, 2, 'Alejandro Alejo', NULL, NULL, NULL, '33 1456 9623', NULL, 'alejandro.alejo@mtqmexico.com', NULL, 40),
(19, NULL, NULL, 2, 'Edgar N. Sanchez', NULL, NULL, NULL, '31 2135 0062', NULL, 'esanchez@q2ces.com', NULL, 44),
(20, NULL, NULL, 2, 'Armando Barba', NULL, NULL, NULL, '33 1365 6070', NULL, 'abarba@q2ces.com', NULL, 65),
(21, NULL, NULL, 2, 'Luis Espinosa Aldana', NULL, NULL, NULL, '33 1569 4171', NULL, 'lespinosaa@q2ces.com', NULL, 46),
(22, NULL, NULL, 2, 'Carlos Valadez', NULL, NULL, NULL, '33 1862 7607', NULL, 'cavaladez@q2ces.com', NULL, 53),
(23, NULL, NULL, 2, 'Carlos Avila', NULL, NULL, NULL, '75 5550 2810', NULL, 'cavila@q2ces.com', NULL, 61),
(24, NULL, NULL, 2, 'Arturo Blancas', NULL, NULL, NULL, '33 1774 9950', NULL, 'ablancas@q2ces.com', NULL, 51),
(25, NULL, NULL, 2, 'Emmanuel Nuñez', NULL, NULL, NULL, '33 1421 9209', NULL, 'enunez@q2ces.com', NULL, 52),
(26, NULL, NULL, 2, 'Jorge Zepeda', NULL, NULL, NULL, '33 1774 9941', NULL, 'jzepeda@q2ces.com', NULL, 75),
(27, NULL, NULL, 2, 'Alfredo Zamora', NULL, NULL, NULL, '33 1774 9944', NULL, 'azamora@q2ces.com', NULL, 70),
(28, NULL, NULL, 2, 'Daniela Serna Selis', NULL, NULL, NULL, '33 1713 8589', NULL, 'dserna@q2ces.com', NULL, 68),
(29, NULL, NULL, 2, 'Luis Arturo Serrano', NULL, NULL, NULL, '33 1774 9960', NULL, 'lserrano@q2ces.com', NULL, 67),
(30, NULL, NULL, 2, 'Oscar Villaseñor', NULL, NULL, NULL, '33 1774 9946', NULL, 'oscar@mtqmexico.com', NULL, 66),
(31, NULL, NULL, 2, 'Luis Espinosa Ramos', NULL, NULL, NULL, '33 1774 9947', NULL, 'lespinosar@q2ces.com', NULL, 45),
(32, NULL, NULL, 2, 'Ruben Vargas', NULL, NULL, NULL, '33 1705 2392', NULL, 'rvargas@q2ces.com', NULL, 64),
(33, NULL, NULL, 2, 'Miguel Quintero', NULL, NULL, NULL, '33 2183 6471', NULL, 'mquintero@q2ces.com', NULL, 62),
(34, NULL, NULL, 2, 'Jesus Esparza Serna', NULL, NULL, NULL, '33 1862 8193', NULL, 'jesparza@q2ces.com', NULL, 59),
(35, NULL, NULL, 2, 'Omar Copado', NULL, NULL, NULL, '33 1774 9942', NULL, 'ocopado@q2ces.com', NULL, 58),
(36, NULL, NULL, 2, 'Mauricio Medina', NULL, NULL, NULL, '33 3954 1719', NULL, 'mmedina@q2ces.com', NULL, 57),
(37, NULL, NULL, 2, 'Alejandro Lopez', NULL, NULL, NULL, '33 1774 9937', NULL, 'alopez@q2ces.com', NULL, 38),
(38, NULL, NULL, 2, 'Oscar Jimenez', NULL, NULL, NULL, '33 1774 9962', NULL, 'ojimenez@q2ces.com', NULL, 63),
(39, NULL, NULL, 2, 'Mario Pamplona', NULL, NULL, NULL, '33 1774 9948', NULL, 'mpamplona@q2ces.com', NULL, 56),
(40, NULL, NULL, 2, 'Arturo Venegas', NULL, NULL, NULL, '3321619012', NULL, 'avenegas@q2ces.com', NULL, NULL),
(41, NULL, NULL, 2, 'Armando Higareda', NULL, NULL, NULL, NULL, NULL, 'ahigareda@q2ces.com', NULL, NULL),
(42, 39, NULL, 2, 'Test Residente', NULL, NULL, NULL, NULL, NULL, 'residentetest@q2ces.com', NULL, NULL),
(43, NULL, NULL, 2, 'J. Félix Villalobos', NULL, NULL, NULL, '33 3389 3569', NULL, 'jvillalobos@q2ces.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `residenteAutos`
--

DROP TABLE IF EXISTS `residenteAutos`;
CREATE TABLE IF NOT EXISTS `residenteAutos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `autoId` bigint(20) UNSIGNED NOT NULL,
  `residenteId` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_maqdocs_autoId` (`autoId`),
  KEY `FK_maqdocs_residenteId` (`residenteId`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `residenteAutos`
--

INSERT INTO `residenteAutos` (`id`, `autoId`, `residenteId`) VALUES
(1, 47, 13),
(2, 43, 13),
(3, 65, 20),
(4, 60, 20),
(5, 72, 20),
(6, 44, 40),
(7, 40, 17),
(8, 35, 14),
(9, 74, 5),
(10, 50, 6),
(11, 69, 8),
(12, 55, 9),
(13, 54, 10),
(14, 49, 11),
(15, 42, 12),
(16, 37, 15),
(17, 39, 16),
(18, 41, 7),
(19, 46, 21),
(20, 53, 22),
(21, 61, 23),
(22, 51, 24),
(23, 52, 25),
(24, 75, 26),
(25, 70, 27),
(26, 68, 28),
(27, 67, 29),
(28, 66, 30),
(29, 45, 31),
(30, 64, 32),
(31, 62, 33),
(32, 59, 34),
(33, 58, 35),
(34, 57, 36),
(35, 38, 37),
(36, 63, 38),
(37, 56, 39),
(38, 60, 41),
(39, 71, 42),
(40, 71, 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restock`
--

DROP TABLE IF EXISTS `restock`;
CREATE TABLE IF NOT EXISTS `restock` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `productoId` bigint(20) UNSIGNED NOT NULL,
  `cantidad` float(10,2) NOT NULL,
  `costo` float(10,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_inventario_producto` (`productoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2022-07-26 01:54:16', '2022-07-26 01:54:16'),
(2, 'User', 'web', '2022-07-26 01:54:16', '2022-07-26 01:54:16'),
(3, 'Sistemas', 'web', '2023-08-24 22:46:28', '2023-08-24 22:46:28'),
(5, 'Taller', 'web', '2023-08-29 15:51:04', '2023-10-09 13:07:30'),
(6, 'Coordinador Equipos Utilitarios MTQ', 'web', '2023-09-19 16:50:28', '2023-09-19 16:51:10'),
(7, 'Capturista', 'web', '2023-09-21 13:56:10', '2023-09-21 13:56:10'),
(8, 'Jefe de Taller', 'web', '2023-10-02 16:07:12', '2023-10-02 16:07:12'),
(9, 'Usuario MTQ', 'web', '2023-10-03 15:16:54', '2023-10-03 15:16:54'),
(10, 'Vacio', 'web', '2023-10-11 16:56:03', '2023-10-11 16:56:03'),
(11, 'Gerente de Operaciones', 'web', '2023-10-12 14:54:54', '2023-10-12 14:54:54'),
(12, 'Administrativo Oficina', 'web', '2023-10-17 15:09:26', '2023-10-17 15:09:26'),
(13, 'Contador', 'web', '2023-10-17 15:11:30', '2023-10-17 15:11:30'),
(14, 'Despachador de Combustible', 'web', '2023-12-22 15:01:27', '2023-12-22 15:01:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(140, 1),
(141, 1),
(142, 1),
(143, 1),
(144, 1),
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(153, 1),
(154, 1),
(155, 1),
(156, 1),
(157, 1),
(158, 1),
(159, 1),
(160, 1),
(161, 1),
(162, 1),
(163, 1),
(164, 1),
(165, 1),
(166, 1),
(167, 1),
(168, 1),
(169, 1),
(170, 1),
(171, 1),
(172, 1),
(173, 1),
(174, 1),
(175, 1),
(176, 1),
(177, 1),
(178, 1),
(179, 1),
(180, 1),
(181, 1),
(182, 1),
(183, 1),
(184, 1),
(185, 1),
(186, 1),
(187, 1),
(188, 1),
(189, 1),
(192, 1),
(193, 1),
(106, 2),
(108, 2),
(168, 2),
(169, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 3),
(34, 3),
(35, 3),
(36, 3),
(37, 3),
(38, 3),
(39, 3),
(40, 3),
(41, 3),
(42, 3),
(43, 3),
(44, 3),
(45, 3),
(46, 3),
(47, 3),
(48, 3),
(49, 3),
(50, 3),
(51, 3),
(52, 3),
(53, 3),
(54, 3),
(55, 3),
(56, 3),
(57, 3),
(58, 3),
(59, 3),
(60, 3),
(61, 3),
(62, 3),
(65, 3),
(66, 3),
(67, 3),
(68, 3),
(69, 3),
(70, 3),
(71, 3),
(72, 3),
(73, 3),
(74, 3),
(75, 3),
(76, 3),
(77, 3),
(78, 3),
(79, 3),
(80, 3),
(81, 3),
(82, 3),
(83, 3),
(84, 3),
(85, 3),
(86, 3),
(87, 3),
(88, 3),
(89, 3),
(90, 3),
(91, 3),
(92, 3),
(93, 3),
(94, 3),
(95, 3),
(96, 3),
(97, 3),
(98, 3),
(99, 3),
(100, 3),
(101, 3),
(102, 3),
(103, 3),
(104, 3),
(105, 3),
(106, 3),
(107, 3),
(108, 3),
(109, 3),
(110, 3),
(111, 3),
(112, 3),
(113, 3),
(114, 3),
(115, 3),
(116, 3),
(117, 3),
(118, 3),
(119, 3),
(120, 3),
(121, 3),
(122, 3),
(123, 3),
(124, 3),
(125, 3),
(126, 3),
(127, 3),
(128, 3),
(129, 3),
(130, 3),
(131, 3),
(132, 3),
(133, 3),
(134, 3),
(135, 3),
(136, 3),
(137, 3),
(138, 3),
(139, 3),
(140, 3),
(141, 3),
(142, 3),
(143, 3),
(144, 3),
(145, 3),
(146, 3),
(147, 3),
(148, 3),
(149, 3),
(150, 3),
(151, 3),
(152, 3),
(153, 3),
(154, 3),
(155, 3),
(156, 3),
(157, 3),
(158, 3),
(159, 3),
(160, 3),
(161, 3),
(162, 3),
(163, 3),
(164, 3),
(165, 3),
(166, 3),
(167, 3),
(168, 3),
(169, 3),
(170, 3),
(171, 3),
(172, 3),
(173, 3),
(174, 3),
(175, 3),
(176, 3),
(177, 3),
(178, 3),
(179, 3),
(180, 3),
(181, 3),
(182, 3),
(183, 3),
(184, 3),
(185, 3),
(186, 3),
(187, 3),
(188, 3),
(189, 3),
(192, 3),
(193, 3),
(16, 5),
(17, 5),
(18, 5),
(19, 5),
(20, 5),
(26, 5),
(27, 5),
(28, 5),
(29, 5),
(30, 5),
(36, 5),
(37, 5),
(38, 5),
(39, 5),
(40, 5),
(41, 5),
(42, 5),
(43, 5),
(44, 5),
(45, 5),
(46, 5),
(47, 5),
(48, 5),
(49, 5),
(50, 5),
(51, 5),
(52, 5),
(53, 5),
(54, 5),
(55, 5),
(62, 5),
(65, 5),
(66, 5),
(67, 5),
(68, 5),
(69, 5),
(131, 5),
(132, 5),
(133, 5),
(134, 5),
(135, 5),
(136, 5),
(137, 5),
(138, 5),
(139, 5),
(140, 5),
(141, 5),
(142, 5),
(143, 5),
(144, 5),
(145, 5),
(149, 5),
(170, 5),
(171, 5),
(172, 5),
(173, 5),
(174, 5),
(70, 6),
(71, 6),
(72, 6),
(73, 6),
(74, 6),
(75, 6),
(101, 6),
(102, 6),
(103, 6),
(104, 6),
(105, 6),
(157, 6),
(158, 6),
(159, 6),
(160, 6),
(161, 6),
(162, 6),
(163, 6),
(164, 6),
(165, 6),
(166, 6),
(21, 7),
(22, 7),
(23, 7),
(24, 7),
(25, 7),
(31, 7),
(32, 7),
(33, 7),
(34, 7),
(35, 7),
(46, 7),
(47, 7),
(48, 7),
(49, 7),
(50, 7),
(51, 7),
(52, 7),
(53, 7),
(54, 7),
(55, 7),
(56, 7),
(57, 7),
(58, 7),
(59, 7),
(60, 7),
(65, 7),
(66, 7),
(67, 7),
(68, 7),
(69, 7),
(70, 7),
(71, 7),
(72, 7),
(73, 7),
(74, 7),
(75, 7),
(76, 7),
(77, 7),
(78, 7),
(79, 7),
(80, 7),
(81, 7),
(82, 7),
(83, 7),
(84, 7),
(85, 7),
(86, 7),
(87, 7),
(88, 7),
(89, 7),
(90, 7),
(91, 7),
(92, 7),
(93, 7),
(94, 7),
(95, 7),
(96, 7),
(97, 7),
(98, 7),
(99, 7),
(100, 7),
(101, 7),
(102, 7),
(103, 7),
(104, 7),
(105, 7),
(121, 7),
(122, 7),
(123, 7),
(124, 7),
(125, 7),
(126, 7),
(127, 7),
(128, 7),
(129, 7),
(130, 7),
(131, 7),
(132, 7),
(133, 7),
(134, 7),
(135, 7),
(148, 7),
(163, 7),
(164, 7),
(165, 7),
(16, 8),
(17, 8),
(18, 8),
(19, 8),
(20, 8),
(21, 8),
(22, 8),
(23, 8),
(24, 8),
(25, 8),
(26, 8),
(27, 8),
(28, 8),
(29, 8),
(30, 8),
(31, 8),
(32, 8),
(33, 8),
(34, 8),
(35, 8),
(36, 8),
(37, 8),
(38, 8),
(39, 8),
(40, 8),
(41, 8),
(42, 8),
(43, 8),
(44, 8),
(45, 8),
(46, 8),
(47, 8),
(48, 8),
(49, 8),
(50, 8),
(51, 8),
(52, 8),
(53, 8),
(54, 8),
(55, 8),
(56, 8),
(57, 8),
(58, 8),
(59, 8),
(60, 8),
(61, 8),
(62, 8),
(65, 8),
(66, 8),
(67, 8),
(68, 8),
(69, 8),
(76, 8),
(77, 8),
(78, 8),
(79, 8),
(80, 8),
(81, 8),
(82, 8),
(83, 8),
(84, 8),
(86, 8),
(87, 8),
(88, 8),
(89, 8),
(90, 8),
(91, 8),
(92, 8),
(93, 8),
(94, 8),
(95, 8),
(96, 8),
(97, 8),
(98, 8),
(99, 8),
(100, 8),
(106, 8),
(107, 8),
(108, 8),
(109, 8),
(110, 8),
(111, 8),
(112, 8),
(113, 8),
(114, 8),
(115, 8),
(116, 8),
(117, 8),
(118, 8),
(119, 8),
(120, 8),
(121, 8),
(122, 8),
(123, 8),
(124, 8),
(125, 8),
(126, 8),
(127, 8),
(128, 8),
(129, 8),
(130, 8),
(131, 8),
(132, 8),
(133, 8),
(134, 8),
(135, 8),
(136, 8),
(137, 8),
(138, 8),
(139, 8),
(140, 8),
(141, 8),
(142, 8),
(143, 8),
(144, 8),
(145, 8),
(146, 8),
(149, 8),
(169, 8),
(170, 8),
(171, 8),
(172, 8),
(173, 8),
(174, 8),
(177, 8),
(184, 8),
(185, 8),
(186, 8),
(187, 8),
(188, 8),
(189, 8),
(33, 9),
(70, 9),
(73, 9),
(101, 9),
(103, 9),
(105, 9),
(164, 9),
(193, 9),
(16, 11),
(17, 11),
(18, 11),
(19, 11),
(20, 11),
(21, 11),
(23, 11),
(26, 11),
(27, 11),
(28, 11),
(29, 11),
(30, 11),
(31, 11),
(33, 11),
(36, 11),
(37, 11),
(38, 11),
(39, 11),
(40, 11),
(136, 11),
(137, 11),
(138, 11),
(139, 11),
(140, 11),
(149, 11),
(16, 12),
(18, 12),
(21, 12),
(22, 12),
(23, 12),
(24, 12),
(25, 12),
(26, 12),
(27, 12),
(28, 12),
(29, 12),
(30, 12),
(31, 12),
(32, 12),
(33, 12),
(34, 12),
(35, 12),
(51, 12),
(52, 12),
(53, 12),
(54, 12),
(55, 12),
(56, 12),
(57, 12),
(58, 12),
(59, 12),
(60, 12),
(65, 12),
(66, 12),
(67, 12),
(68, 12),
(69, 12),
(76, 12),
(77, 12),
(78, 12),
(79, 12),
(80, 12),
(131, 12),
(132, 12),
(133, 12),
(134, 12),
(135, 12),
(146, 12),
(147, 12),
(149, 12),
(16, 13),
(18, 13),
(26, 13),
(27, 13),
(28, 13),
(29, 13),
(30, 13),
(149, 13),
(41, 14),
(42, 14),
(43, 14),
(44, 14),
(45, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

DROP TABLE IF EXISTS `servicios`;
CREATE TABLE IF NOT EXISTS `servicios` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `maquinariaId` bigint(20) UNSIGNED NOT NULL,
  `reparacionId` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `prioridadId` bigint(20) UNSIGNED NOT NULL,
  `estadoId` bigint(20) UNSIGNED NOT NULL,
  `comentario` text,
  PRIMARY KEY (`id`),
  KEY `FK_servicios_userId` (`userId`),
  KEY `FK_servicios_maquinariaId` (`maquinariaId`),
  KEY `FK_servicios_reparacionId` (`reparacionId`),
  KEY `FK_servicios_prioridadId` (`prioridadId`),
  KEY `FK_servicios_estadoId` (`estadoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `serviciosMtq`
--

DROP TABLE IF EXISTS `serviciosMtq`;
CREATE TABLE IF NOT EXISTS `serviciosMtq` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `codigo` varchar(200) DEFAULT NULL,
  `color` varchar(15) NOT NULL,
  `comentario` text,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `serviciosMtq`
--

INSERT INTO `serviciosMtq` (`id`, `nombre`, `codigo`, `color`, `comentario`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Revisión', 'MT-01', '#2db512', 'Para equipos que necesiten ser revisados', 1, '2023-08-15 09:06:58', '2023-11-30 10:35:22'),
(2, 'Afinación', 'MT-02', '#f7c90d', 'Para equipos que necesiten ser afinados', 1, '2023-08-15 09:07:31', '2023-11-30 10:35:15'),
(3, 'Reparación', 'MT-03', '#be2727', 'Para equipos que necesiten ser reparados', 1, '2023-08-15 11:03:57', '2023-11-30 10:35:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `serviciosTrasporte`
--

DROP TABLE IF EXISTS `serviciosTrasporte`;
CREATE TABLE IF NOT EXISTS `serviciosTrasporte` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `conceptoId` bigint(20) UNSIGNED NOT NULL,
  `obraId` bigint(20) UNSIGNED DEFAULT NULL,
  `equipoId` bigint(20) UNSIGNED NOT NULL,
  `personalId` bigint(20) UNSIGNED NOT NULL,
  `cantidad` float(10,2) DEFAULT NULL,
  `recibe` varchar(200) DEFAULT NULL,
  `horaEntrega` time DEFAULT NULL,
  `horaLlegada` time DEFAULT NULL,
  `estatus` int(11) DEFAULT NULL,
  `cajachica` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `almacenId` bigint(20) UNSIGNED DEFAULT NULL,
  `comentario` text,
  `maniobristaId` bigint(20) UNSIGNED DEFAULT NULL,
  `odometro` int(11) DEFAULT NULL,
  `servicio` text,
  `costoMaterial` float(10,2) DEFAULT '0.00',
  `costoServicio` float(10,2) DEFAULT '0.00',
  `costoMano` float(10,2) DEFAULT '0.00',
  `numFactura` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ServiciosTrasporte_conceptoId` (`conceptoId`),
  KEY `FK_ServiciosTrasporte_obraId` (`obraId`),
  KEY `FK_ServiciosTrasporte_equipoId` (`equipoId`),
  KEY `FK_ServiciosTrasporte_personalId` (`personalId`),
  KEY `FK_ServiciosTrasporte_almacenId` (`almacenId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `serviciosTrasporte`
--

INSERT INTO `serviciosTrasporte` (`id`, `fecha`, `conceptoId`, `obraId`, `equipoId`, `personalId`, `cantidad`, `recibe`, `horaEntrega`, `horaLlegada`, `estatus`, `cajachica`, `created_at`, `updated_at`, `almacenId`, `comentario`, `maniobristaId`, `odometro`, `servicio`, `costoMaterial`, `costoServicio`, `costoMano`, `numFactura`) VALUES
(1, '2023-10-30', 15, 7, 32, 10, NULL, 'Alejandro Alejo', NULL, NULL, 4, NULL, '2023-10-30 09:44:59', '2023-11-14 09:06:38', 1, NULL, 0, NULL, NULL, 0.00, 0.00, 0.00, NULL),
(2, '2005-07-10', 37, 1, 5, 17, NULL, NULL, NULL, NULL, 0, NULL, '2023-10-30 09:46:28', '2023-11-14 09:09:36', 1, 'Pariatur Est nisi v', 0, NULL, NULL, 0.00, 10.00, 1.00, NULL),
(3, '2023-10-31', 7, 7, 15, 8, 500.00, 'Armando', '09:16:46', NULL, 3, 1, '2023-10-31 09:15:12', '2023-10-31 09:25:19', 1, NULL, 8, NULL, 'Llevar agua', 500.00, 1.00, 1.00, NULL),
(4, '2023-11-01', 7, 7, 15, 8, 500.00, 'Armando', '11:01:46', NULL, 3, 1, '2023-11-01 11:00:57', '2023-11-01 11:10:44', 1, NULL, 8, NULL, 'Pedir factura', 500.00, 0.01, 0.01, NULL),
(6, '2023-11-28', 7, 16, 15, 8, 500.00, 'Luis Alberto Avila', '09:09:48', '15:16:00', 4, NULL, '2023-11-28 09:05:53', '2023-12-12 12:12:03', 1, NULL, 9, NULL, NULL, 0.00, 2000.00, 30.00, '53535');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudDetalle`
--

DROP TABLE IF EXISTS `solicitudDetalle`;
CREATE TABLE IF NOT EXISTS `solicitudDetalle` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `inventarioId` bigint(20) UNSIGNED DEFAULT NULL,
  `solicitudId` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `cantidad` bigint(20) DEFAULT NULL,
  `comentario` text,
  `carga` varchar(255) DEFAULT NULL,
  `litros` bigint(20) DEFAULT NULL,
  `reparacion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_solicitudDetalle_solicitudId` (`solicitudId`),
  KEY `FK_solicitudDetalle_inventarioId` (`inventarioId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitudDetalle`
--

INSERT INTO `solicitudDetalle` (`id`, `inventarioId`, `solicitudId`, `tipo`, `created_at`, `updated_at`, `cantidad`, `comentario`, `carga`, `litros`, `reparacion`) VALUES
(1, 1, 1, 'herramienta', '2023-09-13 17:13:22', '2023-09-13 17:13:22', 2, 'SC', 'carga', 0, ''),
(2, 1, 1, 'herramienta', '2023-09-13 17:13:22', '2023-09-13 17:22:46', 1, 'SC1', '', 0, ''),
(3, NULL, 2, 'combustible', '2023-09-13 17:16:14', '2023-09-13 17:16:14', 0, 'DESc', 'carga', 25, ''),
(5, NULL, 3, 'reparacion', '2023-09-13 17:17:14', '2023-09-13 17:17:14', 0, 'test', 'carga', 0, 'Reparacion Test'),
(6, NULL, 3, 'reparacion', '2023-09-13 17:17:14', '2023-09-13 17:17:14', 0, 'test2', '', 0, 'Test'),
(7, 2, 4, 'refaccion', '2023-09-13 17:19:17', '2023-09-13 17:20:10', 523, 'COmenta3', 'carga', 0, ''),
(9, 2, 4, 'refaccion', '2023-09-13 17:20:35', '2023-09-13 17:20:35', 1, 'test', NULL, NULL, NULL),
(10, NULL, 3, 'reparacion', '2023-09-13 17:21:04', '2023-09-13 17:21:04', NULL, 'testa', NULL, NULL, '23'),
(11, NULL, 2, 'combustible', '2023-09-13 17:21:33', '2023-09-13 17:21:33', NULL, '2 litros', 'carga', 2, NULL),
(12, 1, 1, 'herramienta', '2023-09-13 17:22:46', '2023-09-13 17:22:46', 5, 'SC5', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

DROP TABLE IF EXISTS `solicitudes`;
CREATE TABLE IF NOT EXISTS `solicitudes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `personalId` bigint(20) UNSIGNED DEFAULT NULL,
  `maquinariaId` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `prioridad` varchar(255) NOT NULL,
  `funcionalidad` varchar(255) NOT NULL,
  `estadoId` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`),
  KEY `FK_solicitudes_userId` (`userId`),
  KEY `FK_solicitudes_maquinariaId` (`maquinariaId`),
  KEY `FK_solicitudes_personalId` (`personalId`),
  KEY `FK_solicitudes_estadoId` (`estadoId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `userId`, `personalId`, `maquinariaId`, `title`, `start`, `end`, `created_at`, `updated_at`, `prioridad`, `funcionalidad`, `estadoId`, `descripcion`) VALUES
(1, 1, 14, 3, 'Solicitud 1 de Julio Test', '2023-07-01 17:12:00', NULL, '2023-09-13 17:13:22', '2023-09-13 17:13:22', 'Deseable', 'Funciona Poco', 1, 'Solicitud Para Mas Herramientas'),
(2, 1, 1, 6, 'Test 2', '2023-07-03 17:14:00', NULL, '2023-09-13 17:16:14', '2023-09-13 17:16:14', 'Urgente', 'No Funciona', 1, 'DSE'),
(3, 1, 1, 2, 'Reparacion test', '2023-07-04 17:16:00', NULL, '2023-09-13 17:17:14', '2023-09-13 17:17:14', 'Urgente', 'No Funciona', 1, 'LA'),
(4, 1, 1, 1, 'Test Refacciones', '2023-07-05 17:18:00', NULL, '2023-09-13 17:19:17', '2023-09-13 17:19:17', 'Prorrogable', 'Funciona', 1, 'Equipo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudesListas`
--

DROP TABLE IF EXISTS `solicitudesListas`;
CREATE TABLE IF NOT EXISTS `solicitudesListas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `solicitudId` bigint(20) UNSIGNED NOT NULL,
  `inventarioId` bigint(20) UNSIGNED NOT NULL,
  `cantidad` float(10,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_solicitudesListas_solicitudId` (`solicitudId`),
  KEY `FK_solicitudesListas_inventarioId` (`inventarioId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

DROP TABLE IF EXISTS `tarea`;
CREATE TABLE IF NOT EXISTS `tarea` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `comentario` text,
  `categoriaId` bigint(20) UNSIGNED DEFAULT NULL,
  `ubicacionId` bigint(20) UNSIGNED DEFAULT NULL,
  `tipoId` bigint(20) UNSIGNED DEFAULT NULL,
  `activa` tinyint(1) NOT NULL DEFAULT '1',
  `tipoValorId` int(2) NOT NULL DEFAULT '1',
  `requiereImagen` tinyint(1) NOT NULL DEFAULT '0',
  `leyenda` varchar(200) DEFAULT NULL,
  `requiereLimites` tinyint(1) NOT NULL DEFAULT '0',
  `limiteInferior` int(8) DEFAULT NULL,
  `limiteSuperior` int(8) DEFAULT NULL,
  `requiereEscala` tinyint(1) NOT NULL DEFAULT '0',
  `limiteInferiorEscala` int(8) DEFAULT NULL,
  `limiteSuperiorEscala` int(8) DEFAULT NULL,
  `requierePeriodo` tinyint(1) NOT NULL DEFAULT '0',
  `fechaInicial` date DEFAULT NULL,
  `fechaFinal` date DEFAULT NULL,
  `requiereUnidadMedida` tinyint(1) NOT NULL DEFAULT '0',
  `unidadMedida` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tarea_categoria` (`categoriaId`),
  KEY `FK_tarea_tipo` (`tipoId`),
  KEY `FK_tarea_ubicacion` (`ubicacionId`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tarea`
--

INSERT INTO `tarea` (`id`, `nombre`, `comentario`, `categoriaId`, `ubicacionId`, `tipoId`, `activa`, `tipoValorId`, `requiereImagen`, `leyenda`, `requiereLimites`, `limiteInferior`, `limiteSuperior`, `requiereEscala`, `limiteInferiorEscala`, `limiteSuperiorEscala`, `requierePeriodo`, `fechaInicial`, `fechaFinal`, `requiereUnidadMedida`, `unidadMedida`, `created_at`, `updated_at`, `imagen`) VALUES
(112, 'Extintor', 'Extintor presente y vigente', 1, 1, 1, 1, 6, 1, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-11-30 12:15:56', '2023-12-21 10:01:06', 'imagenTarea112_1703174466.png'),
(113, 'Torreta', 'Presenta torreta funcional', 1, 1, 1, 1, 6, 1, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-11-30 12:35:07', '2023-12-21 10:00:44', 'imagenTarea113_1703174444.png'),
(114, 'Alarma de Reversa', 'Funcionalidad de la alarma de reversa', 1, 1, 7, 1, 6, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-11-30 12:35:56', '2023-12-21 10:00:28', 'imagenTarea114_1703174428.png'),
(115, 'Luces de Trabajo', 'Funcionalidad de las luces frontales y traseras. Cuartos, altas, intermitentes, direccionales, freno y reversa.', 1, 1, 5, 1, 6, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-11-30 12:38:16', '2023-12-21 10:00:07', 'imagenTarea115_1703174407.png'),
(116, 'Bocina o Claxón', 'Funcionalidad de la bocina o claxón', 1, 10, 5, 1, 6, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-11-30 12:40:14', '2023-12-21 09:59:48', 'imagenTarea116_1703174388.png'),
(117, 'Cinturón de Seguridad', 'El cinturón de seguridad funciona correctamente', 1, 1, 5, 1, 6, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-11-30 12:41:03', '2023-12-21 09:59:12', 'imagenTarea117_1703174352.png'),
(118, 'Revisión de Llantas Eje Delantero', 'Revisión del estado y presión del neumático.', 9, 1, 6, 1, 9, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 09:16:05', '2023-12-21 09:58:41', 'imagenTarea118_1703174321.png'),
(119, 'Revisión de Llantas Eje Trasero Primario', 'Revisión del estado y presión de los neumáticos traseros primarios.', 9, 1, 6, 1, 9, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 09:17:17', '2023-12-21 09:57:54', 'imagenTarea119_1703174274.png'),
(120, 'Revisión de Llantas Eje Trasero Secundario', 'Revisión del estado y presión de los neumáticos del eje trasero secundario', 9, 1, 6, 1, 9, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 09:18:49', '2023-12-21 09:57:23', 'imagenTarea120_1703174243.png'),
(121, 'Revisión de Birlos y Tuercas Eje Delantero', 'Revisión del estado de los birlos y tuercas de las llantas del eje delantero.', 9, 1, 1, 1, 9, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 09:44:41', '2023-12-21 09:56:46', 'imagenTarea121_1703174206.png'),
(122, 'Revisión de Birlos y Tuercas Eje Trasero Primario', 'Revisión del estado de los birlos y tuercas del eje trasero primario.', 9, 1, 1, 1, 9, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 09:46:39', '2023-12-21 09:56:07', 'imagenTarea122_1703174167.png'),
(123, 'Revisión de Birlos y Tuercas Eje Trasero Secundario', 'Revisión del estado de birlos y tuercas del eje trasero secundario', 9, 1, 1, 1, 9, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 09:47:33', '2023-12-21 09:55:42', 'imagenTarea123_1703174142.png'),
(124, 'Revisión Visual de Balatas y Discos del Eje Delantero', 'Revisión visual de las balatas y discos de freno del eje delantero', 9, 1, 1, 1, 9, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 10:10:00', '2023-12-21 09:55:10', 'imagenTarea124_1703174110.png'),
(125, 'Revisión Visual de Balatas y Discos del Eje Trasero Primario', 'Revisión visual de balatas y discos del eje trasero primario', 9, 1, 1, 1, 9, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 10:11:03', '2023-12-21 09:54:34', 'imagenTarea125_1703174074.png'),
(126, 'Revisión Visual de Balatas y Discos del Eje Trasero Secundario', 'Revisión visual de balatas y discos del eje trasero secundario', 9, 1, 1, 1, 9, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 10:11:44', '2023-12-21 09:54:15', 'imagenTarea126_1703174055.png'),
(127, 'Nivel y Condición de Aceite de Motor', 'Nivel y condición de aceite de motor', 17, 12, 5, 1, 6, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 10:18:35', '2023-12-21 09:53:19', 'imagenTarea127_1703173999.png'),
(128, 'Nivel y Condición de Aceite de Transmisión', 'Nivel y Condición de Aceite de Transmisión', 17, 12, 5, 1, 6, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 10:19:15', '2023-12-21 09:52:39', 'imagenTarea128_1703173959.png'),
(129, 'Nivel y Condición de Aceite de Dirección', 'Nivel y Condición de Aceite de Dirección', 17, 12, 5, 1, 6, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 10:19:48', '2023-12-21 09:51:35', 'imagenTarea129_1703173895.png'),
(130, 'Nivel y Condición de Aceite Hidráulico', 'Nivel y Condición de Aceite Hidráulico', 17, 12, 5, 1, 6, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 10:20:20', '2023-12-21 09:51:19', 'imagenTarea130_1703173879.png'),
(131, 'Nivel y Condición de Anticongelante', 'Nivel y condición de anticongelante', 17, 12, 1, 1, 6, 1, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 10:21:34', '2023-12-21 09:50:57', 'imagenTarea131_1703173857.png'),
(132, 'Nivel y Condición de Liquido Limpiaparabrisas', 'Nivel y Condición de Liquido Limpiaparabrisas', 17, 12, 1, 1, 6, 1, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 10:22:08', '2023-12-21 09:50:37', 'imagenTarea132_1703173837.png'),
(133, 'Nivel y Condición de Liquido de Frenos', 'Nivel y Condición de Liquido de Frenos', 17, 12, 1, 1, 6, 1, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 10:22:51', '2023-12-20 17:01:18', 'imagenTarea133_1703113278.png'),
(134, 'Nivel y Condición de Grasa', 'Nivel y Condición de Grasa', 17, 1, 1, 1, 6, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 10:23:31', '2023-12-20 17:01:03', 'imagenTarea134_1703113263.png'),
(135, 'Condición de la Batería 1', 'Condición de la batería 1', 1, 1, 1, 1, 9, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 10:40:09', '2023-12-20 17:00:39', 'imagenTarea135_1703113239.png'),
(136, 'Condición de la Batería 2', 'Condición de la batería 2', 1, 1, 1, 1, 9, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 10:40:52', '2023-12-20 17:00:25', 'imagenTarea136_1703113225.png'),
(137, 'Condición de la Batería 3', 'Condición de la Batería 3', 1, 1, 1, 1, 9, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 10:41:23', '2023-12-20 17:00:07', 'imagenTarea137_1703113207.png'),
(138, 'Fugas y/o Daños en el Sistema de Aceite de Motor', 'Revisión de fugas o daños en el sistema de aceite de motor', 18, 1, 1, 1, 6, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 11:05:51', '2023-12-20 16:59:26', 'imagenTarea138_1703113166.png'),
(139, 'Fugas y/o Daños en el Sistema Hidráulico', 'Revisión de fugas o daños en las mangueras hidráulicas', 18, 1, 1, 1, 6, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 11:06:58', '2023-12-20 16:58:50', 'imagenTarea139_1703113130.png'),
(140, 'Fugas y/o Daños en el Sistema de Frenos', 'Revisión de fugas o daños en el sistema de frenos', 18, 1, 1, 1, 6, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 11:08:24', '2023-12-20 16:58:20', 'imagenTarea140_1703113100.png'),
(141, 'Fugas y/o Daños en el Sistema de Aire', 'Revisión de fugas en las mangueras de aire', 18, 1, 1, 1, 6, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 11:09:35', '2023-12-20 16:57:52', 'imagenTarea141_1703113072.png'),
(142, 'Revisión de Bandas', 'Revisión de bandas de tiempo y accesorios.', 16, 12, 1, 1, 9, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 11:13:49', '2023-12-20 16:56:36', 'imagenTarea142_1703112996.png'),
(143, 'Revisión de Ventilador', 'Revisión de ventilador', 16, 12, 1, 1, 9, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 11:14:19', '2023-12-20 16:56:22', 'imagenTarea143_1703112982.png'),
(144, 'Revisión de Marcha', 'Revisión de marcha', 16, 12, 5, 1, 9, 0, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 11:19:33', '2023-12-20 16:56:00', 'imagenTarea144_1703112960.png'),
(145, 'Revisión de Vidrios', 'Revisión del estado de los vidrios', 13, 13, 1, 1, 9, 1, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 11:23:55', '2023-12-20 16:50:57', 'imagenTarea145_1703112657.png'),
(146, 'Revisión de Plumas Limpiaparabrisas', 'Revisión de las plumas limpiaparabrisas', 13, 13, 5, 1, 9, 1, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 11:24:44', '2023-12-20 16:50:22', 'imagenTarea146_1703112622.png'),
(147, 'Revisión de Espejos Retrovisores', 'Revisión del estado de los espejos retrovisores', 14, 13, 1, 1, 9, 1, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, '2023-12-01 11:25:40', '2023-12-20 16:49:40', 'imagenTarea147_1703112580.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareaCategoria`
--

DROP TABLE IF EXISTS `tareaCategoria`;
CREATE TABLE IF NOT EXISTS `tareaCategoria` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `comentario` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tareaCategoria`
--

INSERT INTO `tareaCategoria` (`id`, `nombre`, `comentario`) VALUES
(1, 'Sin Definir', 'Sin categorí­a definida'),
(9, 'Llantas', NULL),
(10, 'Luces Frontales', NULL),
(11, 'Luces Traseras', NULL),
(12, 'Chasis', NULL),
(13, 'Vidrios', NULL),
(14, 'Espejos', NULL),
(15, 'Carrocería', NULL),
(16, 'Motor', NULL),
(17, 'Niveles de Fluidos', NULL),
(18, 'Fugas', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareaTipo`
--

DROP TABLE IF EXISTS `tareaTipo`;
CREATE TABLE IF NOT EXISTS `tareaTipo` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `comentario` text,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tareaTipo`
--

INSERT INTO `tareaTipo` (`id`, `nombre`, `comentario`, `imagen`) VALUES
(1, 'Revisión Visual', 'Revisión visual del área o parte', 'imagenTipoTarea01_1703112765.png'),
(5, 'Revisión Física', 'Se revisa el estado físico de la pieza', 'imagenTipoTarea05_1703112756.png'),
(6, 'Revisión con Herramienta', 'Se requiere de una herramienta para verificar su estado', 'imagenTipoTarea06_1703112744.png'),
(7, 'Revisión Auditiva', NULL, 'imagenTipoTarea07_1703112732.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareaUbicacion`
--

DROP TABLE IF EXISTS `tareaUbicacion`;
CREATE TABLE IF NOT EXISTS `tareaUbicacion` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `comentario` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tareaUbicacion`
--

INSERT INTO `tareaUbicacion` (`id`, `nombre`, `comentario`) VALUES
(1, 'Sin Definir', 'Sin ubicación definida'),
(6, 'Lado del Conductor', NULL),
(7, 'Lado del Pasajero', NULL),
(8, 'Posterior', NULL),
(9, 'Inferior', NULL),
(10, 'Tablero', NULL),
(11, 'Guantera', NULL),
(12, 'Motor', NULL),
(13, 'Cabina', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoAlmacen`
--

DROP TABLE IF EXISTS `tipoAlmacen`;
CREATE TABLE IF NOT EXISTS `tipoAlmacen` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `comentario` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoAlmacen`
--

INSERT INTO `tipoAlmacen` (`id`, `nombre`, `comentario`) VALUES
(1, 'Tiradero de Escombro', NULL),
(4, 'Almacén de Materiales', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoAsistencia`
--

DROP TABLE IF EXISTS `tipoAsistencia`;
CREATE TABLE IF NOT EXISTS `tipoAsistencia` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `comentario` text,
  `color` varchar(200) NOT NULL,
  `esAsistencia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoAsistencia`
--

INSERT INTO `tipoAsistencia` (`id`, `nombre`, `comentario`, `color`, `esAsistencia`) VALUES
(1, 'Asistencia', 'Asistio a trabajar', 'green', 1),
(2, 'Falta', 'No se presento a trabajar', 'red', 0),
(3, 'Incapacidad', 'Se encuentra con incapacidad', 'darkcyan', 0),
(4, 'Vacaciones', 'Con permiso de vacaciones', 'orange', 1),
(5, 'Descanso', 'Con permiso de descanso o feriado', 'purple', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoEquipo`
--

DROP TABLE IF EXISTS `tipoEquipo`;
CREATE TABLE IF NOT EXISTS `tipoEquipo` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `comentario` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoEquipo`
--

INSERT INTO `tipoEquipo` (`id`, `nombre`, `tipo`, `comentario`) VALUES
(1, 'Laptop', 'Computo', NULL),
(2, 'Cargador Laptop', 'Computo', NULL),
(3, 'Cable Seguridad Laptop', 'Computo', 'Test.'),
(4, 'Mouse', 'Computo', NULL),
(5, 'Celular', 'Comunicacion', NULL),
(6, 'Radio', 'Comunicacion', NULL),
(7, 'Cargador Radio', 'Comunicacion', NULL),
(8, 'Microfono Radio', 'Comunicacion', NULL),
(9, 'Terminales con Impresora', 'Computo', NULL),
(10, 'Tableta', '', 'Tableta de trabajo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoHoraExtra`
--

DROP TABLE IF EXISTS `tipoHoraExtra`;
CREATE TABLE IF NOT EXISTS `tipoHoraExtra` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `comentario` text,
  `color` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoHoraExtra`
--

INSERT INTO `tipoHoraExtra` (`id`, `nombre`, `valor`, `comentario`, `color`) VALUES
(1, 'No aplica', 0, 'No aplica hora extra', 'gray'),
(2, 'De Ley', 82, 'De Ley', 'blue'),
(3, 'Q2S', 100, 'Q2C', 'green'),
(4, 'Otros', 120, 'Bonos o compensaciones', 'purple');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoMantenimiento`
--

DROP TABLE IF EXISTS `tipoMantenimiento`;
CREATE TABLE IF NOT EXISTS `tipoMantenimiento` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `codigo` varchar(8) DEFAULT NULL,
  `comentario` text,
  `color` varchar(255) DEFAULT NULL,
  `proximaRevisionKm` int(10) DEFAULT NULL,
  `proximaRevisionMi` int(10) DEFAULT NULL,
  `proximaRevisionHr` int(10) DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoMantenimiento`
--

INSERT INTO `tipoMantenimiento` (`id`, `nombre`, `codigo`, `comentario`, `color`, `proximaRevisionKm`, `proximaRevisionMi`, `proximaRevisionHr`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Correctivo', 'MT-01', 'Mantenimiento correctivo de equipo', '#f70202', 0, 0, 0, 1, NULL, '2023-12-12 17:30:52'),
(2, '250 Horas', 'MT-02', 'Mantenimiento preventivo de 250 horas de trabajo', '#0fdf0c', NULL, NULL, 250, 1, NULL, '2023-12-12 17:31:16'),
(3, '500 Horas', 'MT-03', 'Mantenimiento preventivo de 500 horas de trabajo.', '#ffd500', NULL, NULL, 250, 1, NULL, '2024-01-05 11:52:53'),
(4, '1000 Horas', 'MT-04', 'Mantenimiento preventivo de 1000 horas de trabajo', '#ff8800', NULL, 0, 250, 1, NULL, '2024-01-05 11:53:08'),
(6, 'Preventivo Menor', 'MT-06', 'Cambio de aceite, filtro de aire y filtro de aceite', '#00ffee', 10000, 10000, 250, 1, NULL, '2024-01-05 11:53:33'),
(7, 'Preventivo/Correctivo con Rectificación', 'MT-07', NULL, '#ae00ff', 1000, 1000, 50, NULL, '2023-12-12 17:32:48', '2024-01-05 11:54:01'),
(8, 'Preventivo Mayor', 'MT-08', 'Cambio de aceite, filtro de aire, filtro de aceite, bujías', '#002aff', 10000, 10000, 250, NULL, '2024-01-05 11:51:02', '2024-01-05 11:53:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposDocs`
--

DROP TABLE IF EXISTS `tiposDocs`;
CREATE TABLE IF NOT EXISTS `tiposDocs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `comentario` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiposDocs`
--

INSERT INTO `tiposDocs` (`id`, `nombre`, `comentario`, `created_at`, `updated_at`) VALUES
(1, 'Personal', 'Documentos de Personal', NULL, NULL),
(2, 'Maquinaria', 'Documentos de Personal', NULL, NULL),
(3, 'Accesorios', 'Documentos de accesorios para la maquinaria', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposMarcas`
--

DROP TABLE IF EXISTS `tiposMarcas`;
CREATE TABLE IF NOT EXISTS `tiposMarcas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiposMarcas`
--

INSERT INTO `tiposMarcas` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'herramientas', NULL, NULL),
(2, 'refacciones', NULL, NULL),
(3, 'consumibles', NULL, NULL),
(4, 'uniformes', NULL, NULL),
(5, 'maquinaria', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposServicios`
--

DROP TABLE IF EXISTS `tiposServicios`;
CREATE TABLE IF NOT EXISTS `tiposServicios` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `codigo` varchar(200) DEFAULT NULL,
  `costo` float(10,2) NOT NULL,
  `comentario` text,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiposServicios`
--

INSERT INTO `tiposServicios` (`id`, `nombre`, `codigo`, `costo`, `comentario`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Sin Definir', 'SDF', 0.00, 'No esta definido, no existe o no se ha registrado', 1, '2023-08-25 11:42:01', '2023-08-25 11:42:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposUnidades`
--

DROP TABLE IF EXISTS `tiposUnidades`;
CREATE TABLE IF NOT EXISTS `tiposUnidades` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `codigo` varchar(255) NOT NULL,
  `comentario` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiposUnidades`
--

INSERT INTO `tiposUnidades` (`id`, `nombre`, `codigo`, `comentario`, `created_at`, `updated_at`) VALUES
(2, 'Metros cúbicos', 'Mts3', NULL, '2024-01-11 16:42:24', '2024-01-11 16:42:24'),
(3, 'Kilográmos', 'Kg(s)', NULL, '2024-01-11 16:42:40', '2024-01-11 16:42:40'),
(4, 'Litros', 'Lts', NULL, '2024-01-11 16:42:54', '2024-01-11 16:42:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoUniforme`
--

DROP TABLE IF EXISTS `tipoUniforme`;
CREATE TABLE IF NOT EXISTS `tipoUniforme` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `comentario` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoUniforme`
--

INSERT INTO `tipoUniforme` (`id`, `nombre`, `comentario`) VALUES
(1, 'Chaleco Gris', 'Chaleco normal con reflejante'),
(2, 'Chaleco Naranja', 'Chaleco especial de acuerdo a obra o cliente'),
(3, 'Casco', 'Casco'),
(4, 'Casco Amarillo', 'Otro'),
(5, 'Lentes Claros', 'Lentes'),
(6, 'Guantes', 'Guantes'),
(7, 'Barbiquejo', 'Barbiquejo'),
(8, 'Arnes', 'Arnes de esguridad.'),
(9, 'Camisola', 'Camisola'),
(10, 'Pantalón de mezclilla', 'Pantalón de mezclilla'),
(11, 'Botas de agua', 'Botas de agua'),
(12, 'Impermeable', 'Impermeable'),
(13, 'Gorra', 'Gorra'),
(15, 'Botas con Casquillo', NULL),
(17, 'Camisa Ejecutiva', 'Camisa Ejecutiva'),
(18, 'Camisa', NULL),
(19, 'Lentes Oscuros', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoValorTarea`
--

DROP TABLE IF EXISTS `tipoValorTarea`;
CREATE TABLE IF NOT EXISTS `tipoValorTarea` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `comentario` text,
  `controlHtml` varchar(64) NOT NULL,
  `codigo` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoValorTarea`
--

INSERT INTO `tipoValorTarea` (`id`, `nombre`, `comentario`, `controlHtml`, `codigo`) VALUES
(1, 'Sin Definir', 'Sin definir, no establecido o no existe.', 'label', 'texto=\"Hola soy etiqueta\"'),
(2, 'Texto (text)', 'Para captura de textos en general', 'text', ''),
(3, 'Númerico', 'Para valores numerico enteros', 'number', ''),
(4, 'Decimales', 'Para números con decimales', 'number', ''),
(5, 'Fecha', 'Para captura de fecha (sin hora)', 'date', ''),
(6, 'Opción Si/No', 'Para seleccionar un valor de Si o No', 'radio', '0=>No,1=>Si'),
(7, 'Select', 'Para selección de un elemento', 'select', '0=>No,1=>Si,2=>Probablemente,3=>Ninguna,4=>Otras'),
(8, 'Opción Correcto/Incorrecto', 'Para seleccionar un valor de Correcto o Incorrecto', 'radio', '1=>Correcto,0=>Incorrecto'),
(9, 'Opción BMR', 'Para seleccionar un Valor de Bueno, Malo, Regular', 'radio', '0=>Malo,1=>Bueno,2=>Regular'),
(10, 'Opción ciclo de vida', 'Para seleccionar un valor de porcentaje de vida, 50% o +, 20% a 50%, -20%', 'radio', '0=>Menos del 20% de Vida,1=>20% al 50% de Vida,2=>50 % o más de Vida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

DROP TABLE IF EXISTS `ubicaciones`;
CREATE TABLE IF NOT EXISTS `ubicaciones` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `comentario` text,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`id`, `nombre`, `direccion`, `comentario`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Maquinaria', 'Maquinaria', 'Apartado para seleccionar maquinaria', 1, '2022-09-26 19:48:41', '2022-09-26 19:48:41'),
(2, 'Camper de Obra', 'Camper de Obra', NULL, 1, '2023-09-19 12:22:17', '2023-09-19 12:22:17'),
(3, 'Tractocamiones', 'Tractocamiones', NULL, 1, '2023-09-19 12:22:37', '2023-09-19 12:22:37'),
(4, 'Automóviles Utilitarios', 'Automóviles Utilitarios', NULL, 1, '2023-09-19 12:22:52', '2023-09-19 12:22:52'),
(5, 'Taller Q2S', 'San Juan de los Lagos 1788, Colonia Hogares de Nuevo México', NULL, 1, '2023-09-19 12:23:08', '2023-09-19 12:42:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidadesSat`
--

DROP TABLE IF EXISTS `unidadesSat`;
CREATE TABLE IF NOT EXISTS `unidadesSat` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `codigo` varchar(255) NOT NULL,
  `comentario` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `unidadesSat`
--

INSERT INTO `unidadesSat` (`id`, `nombre`, `codigo`, `comentario`, `created_at`, `updated_at`) VALUES
(2, 'Pieza', 'H87', NULL, '2024-01-11 16:45:29', '2024-01-11 16:45:29'),
(3, 'Unidad de Servicio', 'E48', NULL, '2024-01-11 16:45:57', '2024-01-11 16:45:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userdocs`
--

DROP TABLE IF EXISTS `userdocs`;
CREATE TABLE IF NOT EXISTS `userdocs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `personalId` bigint(20) UNSIGNED NOT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `tipoId` bigint(20) UNSIGNED DEFAULT NULL,
  `fechaVencimiento` date NOT NULL,
  `estatus` varchar(255) DEFAULT NULL,
  `requerido` int(11) DEFAULT NULL,
  `vencimiento` int(11) DEFAULT NULL,
  `comentarios` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_userdocs_personalId` (`personalId`),
  KEY `FK_userdocs_tipoId` (`tipoId`)
) ENGINE=InnoDB AUTO_INCREMENT=465 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `userdocs`
--

INSERT INTO `userdocs` (`id`, `personalId`, `ruta`, `tipoId`, `fechaVencimiento`, `estatus`, `requerido`, `vencimiento`, `comentarios`, `created_at`, `updated_at`) VALUES
(1, 12, '1696285413_Acta de Nacimiento.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2023-08-25 14:37:07', '2023-10-02 21:23:33'),
(2, 2, '1696286153_ACTA DE NACIMIENTO.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2023-08-25 22:35:46', '2023-10-02 21:35:53'),
(3, 12, '1696285413_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-08-25 22:35:46', '2023-10-02 21:23:33'),
(4, 12, NULL, 3, '0000-00-00', '0', 1, 1, NULL, '2023-08-25 22:35:46', '2023-09-21 21:13:57'),
(5, 3, '1696284511_Acta de Nacimiento.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 15:09:46', '2023-10-02 21:08:31'),
(6, 3, '1696284511_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 15:09:46', '2023-10-02 21:08:31'),
(7, 3, NULL, 3, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 15:09:46', '2023-08-29 15:09:46'),
(8, 4, NULL, 1, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 17:50:43', '2023-08-29 17:50:43'),
(9, 4, '1695838783_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 17:50:43', '2023-09-27 17:19:43'),
(10, 4, NULL, 3, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 17:50:43', '2023-08-29 17:50:43'),
(11, 5, '1695838167_ACTA DE NACIMIENTO.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 18:54:17', '2023-09-27 17:09:27'),
(12, 5, '1695838167_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 18:54:17', '2023-09-27 17:09:27'),
(13, 5, NULL, 3, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 18:54:17', '2023-08-29 18:54:17'),
(14, 6, '1695837764_ACTA DE NACIMIENTO.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 22:01:49', '2023-09-27 17:02:44'),
(15, 6, '1695837764_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 22:01:49', '2023-09-27 17:02:44'),
(16, 6, '1702335212_mi_pdf (8).pdf', 3, '2023-12-15', '1', 1, 1, 'Test', '2023-08-29 22:01:49', '2023-12-11 22:53:32'),
(17, 7, '1695836281_ACTA DE NACIMIENTO.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 22:20:45', '2023-09-27 16:38:01'),
(18, 7, '1695836743_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 22:20:45', '2023-09-27 16:45:43'),
(19, 7, '1695836743_LICENCIA DE CONDUCIR.pdf', 3, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 22:20:45', '2023-09-27 16:45:43'),
(20, 8, '1695835843_Acta de Nacimiento.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 22:49:27', '2023-09-27 16:30:43'),
(21, 8, '1695835843_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 22:49:27', '2023-09-27 16:30:43'),
(22, 8, NULL, 3, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 22:49:27', '2023-08-29 22:49:27'),
(23, 9, '1696285046_Acta de Nacimiento.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 23:05:27', '2023-10-02 21:17:26'),
(24, 9, '1696285046_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 23:05:27', '2023-10-02 21:17:26'),
(25, 9, NULL, 3, '0000-00-00', '0', 1, 1, NULL, '2023-08-29 23:05:27', '2023-08-29 23:05:27'),
(26, 10, '1696284350_Acta de Nacimiento.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 17:06:08', '2023-10-02 21:05:50'),
(27, 10, '1696284350_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 17:06:08', '2023-10-02 21:05:50'),
(28, 10, '1696284350_Licencia de conducir.pdf', 3, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 17:06:08', '2023-10-02 21:05:50'),
(29, 11, '1696284753_Acta de Nacimiento.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 17:40:37', '2023-10-02 21:12:33'),
(30, 11, '1696284753_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 17:40:37', '2023-10-02 21:12:33'),
(31, 11, '1696284753_Licencia de conducir.pdf', 3, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 17:40:37', '2023-10-02 21:12:33'),
(32, 12, NULL, 1, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 18:00:35', '2023-08-30 18:00:35'),
(33, 12, NULL, 2, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 18:00:35', '2023-08-30 18:00:35'),
(34, 12, '1696285413_Licencia.pdf', 3, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 18:00:35', '2023-10-02 21:23:33'),
(35, 13, NULL, 1, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 18:36:22', '2023-08-30 18:36:22'),
(36, 13, NULL, 2, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 18:36:22', '2023-08-30 18:36:22'),
(37, 13, NULL, 3, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 18:36:22', '2023-08-30 18:36:22'),
(38, 14, '1695839518_ACTA DE NACIMIENTO.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 19:02:29', '2023-09-27 17:31:58'),
(39, 14, '1695839518_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 19:02:29', '2023-09-27 17:31:58'),
(40, 14, '1695839518_LICENCIA DE CONDUCIR.pdf', 3, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 19:02:29', '2023-09-27 17:31:58'),
(41, 15, NULL, 1, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 21:47:37', '2023-08-30 21:47:37'),
(42, 15, NULL, 2, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 21:47:37', '2023-08-30 21:47:37'),
(43, 15, '1695838499_LICENCIA DE CONDUCIR.pdf', 3, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 21:47:37', '2023-09-27 17:14:59'),
(44, 16, '1695837321_ACTA DE NACIMIENTO.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 22:15:29', '2023-09-27 16:55:21'),
(45, 16, '1695837321_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 22:15:29', '2023-09-27 16:55:21'),
(46, 16, NULL, 3, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 22:15:29', '2023-08-30 22:15:29'),
(47, 17, NULL, 1, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 22:28:43', '2023-08-30 22:28:43'),
(48, 17, '1696283950_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 22:28:43', '2023-10-02 20:59:10'),
(49, 17, NULL, 3, '0000-00-00', '0', 1, 1, NULL, '2023-08-30 22:28:43', '2023-08-30 22:28:43'),
(50, 12, '1696285413_SAT.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-09-21 14:23:18', '2023-10-02 21:23:33'),
(51, 12, '1696285413_C.V. o solicitud de empleo.pdf', 10, '0000-00-00', '0', 1, 1, NULL, '2023-09-21 14:23:18', '2023-10-02 21:23:33'),
(52, 12, '1696285413_INE.pdf', 11, '2027-01-01', '2', 1, 1, NULL, '2023-09-21 14:23:18', '2023-10-02 21:23:33'),
(53, 12, '1695334437_Comprobante de domicilio Fernando Alcala.pdf', 12, '0000-00-00', '0', 1, 1, NULL, '2023-09-21 14:23:18', '2023-09-21 21:13:57'),
(54, 12, '1696285413_Carta de no antecedentes penales.pdf', 13, '0000-00-00', '0', 1, 1, NULL, '2023-09-21 14:23:18', '2023-10-02 21:23:33'),
(55, 12, '1696285413_IMSS.pdf', 14, '0000-00-00', '0', 1, 1, NULL, '2023-09-21 14:23:18', '2023-10-02 21:23:33'),
(56, 12, NULL, 15, '0000-00-00', '0', 1, 1, NULL, '2023-09-21 14:23:18', '2023-09-21 21:13:57'),
(57, 12, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2023-09-21 14:23:18', '2023-09-21 21:13:57'),
(58, 12, '1696285413_Certificado medico.pdf', 17, '0000-00-00', '0', 1, 1, NULL, '2023-09-21 14:23:18', '2023-10-02 21:23:33'),
(59, 12, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-09-21 14:23:18', '2023-09-21 21:13:57'),
(60, 12, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-09-21 14:23:18', '2023-09-21 21:13:57'),
(61, 12, NULL, 20, '0000-00-00', '0', 1, 1, NULL, '2023-09-21 14:23:18', '2023-09-21 21:13:57'),
(62, 12, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2023-09-21 14:23:18', '2023-09-21 21:13:57'),
(63, 4, NULL, 22, '0000-00-00', '0', 1, 1, NULL, '2023-09-21 14:23:18', '2023-09-21 17:53:49'),
(64, 12, NULL, 28, '0000-00-00', '0', 1, 1, NULL, '2023-09-21 21:13:57', '2023-09-21 21:13:57'),
(65, 17, NULL, 9, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:01:31', '2023-09-27 16:01:31'),
(66, 17, NULL, 10, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:01:31', '2023-09-27 16:01:31'),
(67, 17, '1696283950_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:01:31', '2023-10-02 20:59:10'),
(68, 17, '1696283950_Comprobante de domicilio.pdf', 12, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:01:31', '2023-10-02 20:59:10'),
(69, 17, NULL, 13, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:01:31', '2023-09-27 16:01:31'),
(70, 17, '1696283950_IMSS.pdf', 14, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:01:31', '2023-10-02 20:59:10'),
(71, 17, NULL, 15, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:01:31', '2023-09-27 16:01:31'),
(72, 17, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:01:31', '2023-09-27 16:01:31'),
(73, 17, NULL, 17, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:01:31', '2023-09-27 16:01:31'),
(74, 17, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:01:31', '2023-09-27 16:01:31'),
(75, 17, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:01:31', '2023-09-27 16:01:31'),
(76, 17, NULL, 20, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:01:31', '2023-09-27 16:01:31'),
(77, 17, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:01:31', '2023-09-27 16:01:31'),
(78, 17, NULL, 28, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:01:31', '2023-09-27 16:01:31'),
(79, 17, NULL, 29, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:01:31', '2023-09-27 16:01:31'),
(80, 17, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:01:31', '2023-09-27 16:01:31'),
(81, 8, '1695835843_SAT.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:30:43', '2023-09-27 16:30:43'),
(82, 8, NULL, 10, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:30:43', '2023-09-27 16:30:43'),
(83, 8, '1695835843_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:30:43', '2023-09-27 16:30:43'),
(84, 8, '1695835843_Comprobante de domicilio.pdf', 12, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:30:43', '2023-09-27 16:30:43'),
(85, 8, '1695835843_Carta de no antecedentes penales.pdf', 13, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:30:43', '2023-09-27 16:30:43'),
(86, 8, NULL, 14, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:30:43', '2023-09-27 16:30:43'),
(87, 8, NULL, 15, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:30:43', '2023-09-27 16:30:43'),
(88, 8, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:30:43', '2023-09-27 16:30:43'),
(89, 8, NULL, 17, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:30:43', '2023-09-27 16:30:43'),
(90, 8, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:30:43', '2023-09-27 16:30:43'),
(91, 8, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:30:43', '2023-09-27 16:30:43'),
(92, 8, NULL, 20, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:30:43', '2023-09-27 16:30:43'),
(93, 8, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:30:43', '2023-09-27 16:30:43'),
(94, 8, '1695835843_Alta IMSS.pdf', 28, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:30:43', '2023-09-27 16:30:43'),
(95, 8, '1695835843_Contrato de prueba 90 días.pdf', 29, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:30:43', '2023-09-27 16:30:43'),
(96, 8, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:30:43', '2023-09-27 16:30:43'),
(97, 7, '1695836281_SAT.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:38:01', '2023-09-27 16:38:01'),
(98, 7, NULL, 10, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:38:01', '2023-09-27 16:38:01'),
(99, 7, '1695836281_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:38:01', '2023-09-27 16:38:01'),
(100, 7, '1695836281_COMPROBANTE DE DOMICILIO.pdf', 12, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:38:01', '2023-09-27 16:38:01'),
(101, 7, '1695836743_CARTA DE NO ANTECEDENTES PENALES.pdf', 13, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:38:01', '2023-09-27 16:45:43'),
(102, 7, '1695836743_IMSS.pdf', 14, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:38:01', '2023-09-27 16:45:43'),
(103, 7, NULL, 15, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:38:01', '2023-09-27 16:38:01'),
(104, 7, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:38:01', '2023-09-27 16:38:01'),
(105, 7, NULL, 17, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:38:01', '2023-09-27 16:38:01'),
(106, 7, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:38:01', '2023-09-27 16:38:01'),
(107, 7, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:38:01', '2023-09-27 16:38:01'),
(108, 7, NULL, 20, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:38:01', '2023-09-27 16:38:01'),
(109, 7, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:38:01', '2023-09-27 16:38:01'),
(110, 7, '1695836743_ALTA IMSS.pdf', 28, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:38:01', '2023-09-27 16:45:43'),
(111, 7, '1695836281_Contrato de prueba 90 días.pdf', 29, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:38:01', '2023-09-27 16:38:01'),
(112, 7, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:38:01', '2023-09-27 16:38:01'),
(113, 7, '1695836743_COMPROBANTE DE ESTUDIOS.pdf', 31, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:45:43', '2023-09-27 16:45:43'),
(114, 8, NULL, 31, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:47:30', '2023-09-27 16:47:30'),
(115, 16, '1695837321_SAT.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:55:21', '2023-09-27 16:55:21'),
(116, 16, NULL, 10, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:55:21', '2023-09-27 16:55:21'),
(117, 16, '1695837321_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:55:21', '2023-09-27 16:55:21'),
(118, 16, NULL, 12, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:55:21', '2023-09-27 16:55:21'),
(119, 16, NULL, 13, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:55:21', '2023-09-27 16:55:21'),
(120, 16, NULL, 14, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:55:21', '2023-09-27 16:55:21'),
(121, 16, NULL, 15, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:55:21', '2023-09-27 16:55:21'),
(122, 16, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:55:21', '2023-09-27 16:55:21'),
(123, 16, NULL, 17, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:55:21', '2023-09-27 16:55:21'),
(124, 16, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:55:21', '2023-09-27 16:55:21'),
(125, 16, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:55:21', '2023-09-27 16:55:21'),
(126, 16, NULL, 20, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:55:21', '2023-09-27 16:55:21'),
(127, 16, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:55:21', '2023-09-27 16:55:21'),
(128, 16, '1695837321_ALTA IMSS.pdf', 28, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:55:21', '2023-09-27 16:55:21'),
(129, 16, NULL, 29, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:55:21', '2023-09-27 16:55:21'),
(130, 16, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:55:21', '2023-09-27 16:55:21'),
(131, 16, '1695837321_COMPROBANTE DE ESTUDIOS.pdf', 31, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 16:55:21', '2023-09-27 16:55:21'),
(132, 6, '1695837764_SAT.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:02:44', '2023-09-27 17:02:44'),
(133, 6, '1695837764_SOLICITUD DE EMPLEO, C.V..pdf', 10, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:02:44', '2023-09-27 17:02:44'),
(134, 6, '1695837764_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:02:44', '2023-09-27 17:02:44'),
(135, 6, '1695837764_COMPROBANTE DE DOMICILIO.pdf', 12, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:02:44', '2023-09-27 17:02:44'),
(136, 6, '1695837764_CARTA DE RECOMENDACIÓN PERSONAL.pdf', 13, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:02:44', '2023-09-27 17:02:44'),
(137, 6, '1695837764_IMSS.pdf', 14, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:02:44', '2023-09-27 17:02:44'),
(138, 6, NULL, 15, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:02:44', '2023-09-27 17:02:44'),
(139, 6, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:02:44', '2023-09-27 17:02:44'),
(140, 6, '1695837764_EXAMEN MEDICO.pdf', 17, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:02:44', '2023-09-27 17:02:44'),
(141, 6, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:02:44', '2023-09-27 17:02:44'),
(142, 6, '1695837764_CARTA DE RECOMENDACIÓN PERSONAL.pdf', 19, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:02:44', '2023-09-27 17:02:44'),
(143, 6, NULL, 20, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:02:44', '2023-09-27 17:02:44'),
(144, 6, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:02:44', '2023-09-27 17:02:44'),
(145, 6, '1695837764_ALTA IMSS.pdf', 28, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:02:44', '2023-09-27 17:02:44'),
(146, 6, '1695837764_Contrato de prueba 90 días.pdf', 29, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:02:44', '2023-09-27 17:02:44'),
(147, 6, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:02:44', '2023-09-27 17:02:44'),
(148, 6, '1695837764_COMPROBANTE DE ESTUDIOS.pdf', 31, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:02:44', '2023-09-27 17:02:44'),
(149, 5, '1695838167_SAT.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:09:27', '2023-09-27 17:09:27'),
(150, 5, '1695838167_SOLICITUD DE EMPLEO, C.V..pdf', 10, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:09:27', '2023-09-27 17:09:27'),
(151, 5, '1695838167_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:09:27', '2023-09-27 17:09:27'),
(152, 5, NULL, 12, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:09:27', '2023-09-27 17:09:27'),
(153, 5, '1695838167_CARTA DE NO ANTECEDENTES PENALES.pdf', 13, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:09:27', '2023-09-27 17:09:27'),
(154, 5, '1695838167_IMSS.pdf', 14, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:09:27', '2023-09-27 17:09:27'),
(155, 5, NULL, 15, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:09:27', '2023-09-27 17:09:27'),
(156, 5, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:09:27', '2023-09-27 17:09:27'),
(157, 5, NULL, 17, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:09:27', '2023-09-27 17:09:27'),
(158, 5, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:09:27', '2023-09-27 17:09:27'),
(159, 5, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:09:27', '2023-09-27 17:09:27'),
(160, 5, NULL, 20, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:09:27', '2023-09-27 17:09:27'),
(161, 5, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:09:27', '2023-09-27 17:09:27'),
(162, 5, NULL, 28, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:09:27', '2023-09-27 17:09:27'),
(163, 5, '1695838167_Contrato de prueba 90 días.pdf', 29, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:09:27', '2023-09-27 17:09:27'),
(164, 5, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:09:27', '2023-09-27 17:09:27'),
(165, 5, NULL, 31, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:09:27', '2023-09-27 17:09:27'),
(166, 15, '1695838499_SAT.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:14:59', '2023-09-27 17:14:59'),
(167, 15, NULL, 10, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:14:59', '2023-09-27 17:14:59'),
(168, 15, '1695838499_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:14:59', '2023-09-27 17:14:59'),
(169, 15, '1695838499_COMPROBANTE DE DOMICILIO.pdf', 12, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:14:59', '2023-09-27 17:14:59'),
(170, 15, NULL, 13, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:14:59', '2023-09-27 17:14:59'),
(171, 15, '1695838499_IMSS.pdf', 14, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:14:59', '2023-09-27 17:14:59'),
(172, 15, NULL, 15, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:14:59', '2023-09-27 17:14:59'),
(173, 15, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:14:59', '2023-09-27 17:14:59'),
(174, 15, NULL, 17, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:14:59', '2023-09-27 17:14:59'),
(175, 15, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:14:59', '2023-09-27 17:14:59'),
(176, 15, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:14:59', '2023-09-27 17:14:59'),
(177, 15, NULL, 20, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:14:59', '2023-09-27 17:14:59'),
(178, 15, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:14:59', '2023-09-27 17:14:59'),
(179, 15, '1695838499_ALTA IMSS.pdf', 28, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:14:59', '2023-09-27 17:14:59'),
(180, 15, '1696264063_Contrato 90 dias.pdf', 29, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:14:59', '2023-10-02 15:27:43'),
(181, 15, '1695838499_Contrato por obra determinada.pdf', 30, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:14:59', '2023-09-27 17:14:59'),
(182, 15, NULL, 31, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:14:59', '2023-09-27 17:14:59'),
(183, 4, '1695838783_SAT.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:19:43', '2023-09-27 17:19:43'),
(184, 4, NULL, 10, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:19:43', '2023-09-27 17:19:43'),
(185, 4, '1695838783_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:19:43', '2023-09-27 17:19:43'),
(186, 4, NULL, 12, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:19:43', '2023-09-27 17:19:43'),
(187, 4, NULL, 13, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:19:43', '2023-09-27 17:19:43'),
(188, 4, NULL, 14, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:19:43', '2023-09-27 17:19:43'),
(189, 4, NULL, 15, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:19:43', '2023-09-27 17:19:43'),
(190, 4, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:19:43', '2023-09-27 17:19:43'),
(191, 4, NULL, 17, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:19:43', '2023-09-27 17:19:43'),
(192, 4, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:19:43', '2023-09-27 17:19:43'),
(193, 4, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:19:43', '2023-09-27 17:19:43'),
(194, 4, NULL, 20, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:19:43', '2023-09-27 17:19:43'),
(195, 4, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:19:43', '2023-09-27 17:19:43'),
(196, 4, '1695838783_ALTA IMSS.pdf', 28, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:19:43', '2023-09-27 17:19:43'),
(197, 4, NULL, 29, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:19:43', '2023-09-27 17:19:43'),
(198, 4, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:19:43', '2023-09-27 17:19:43'),
(199, 4, NULL, 31, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:19:43', '2023-09-27 17:19:43'),
(200, 14, '1695839518_SAT.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:31:58', '2023-09-27 17:31:58'),
(201, 14, '1695839518_SOLICITUD DE EMPLEO, C.V..pdf', 10, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:31:58', '2023-09-27 17:31:58'),
(202, 14, '1695839518_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:31:58', '2023-09-27 17:31:58'),
(203, 14, '1695839518_COMPROBANTE DE DOMICILIO.pdf', 12, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:31:58', '2023-09-27 17:31:58'),
(204, 14, '1695839518_CARTA DE NO ANTECEDENTES PENALES.pdf', 13, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:31:58', '2023-09-27 17:31:58'),
(205, 14, '1695839518_IMSS.pdf', 14, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:31:58', '2023-09-27 17:31:58'),
(206, 14, NULL, 15, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:31:58', '2023-09-27 17:31:58'),
(207, 14, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:31:58', '2023-09-27 17:31:58'),
(208, 14, NULL, 17, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:31:58', '2023-09-27 17:31:58'),
(209, 14, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:31:58', '2023-09-27 17:31:58'),
(210, 14, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:31:58', '2023-09-27 17:31:58'),
(211, 14, NULL, 20, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:31:58', '2023-09-27 17:31:58'),
(212, 14, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:31:58', '2023-09-27 17:31:58'),
(213, 14, NULL, 28, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:31:58', '2023-09-27 17:31:58'),
(214, 14, '1695839518_Contrato 90 dias.pdf', 29, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:31:58', '2023-09-27 17:31:58'),
(215, 14, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:31:58', '2023-09-27 17:31:58'),
(216, 14, '1695839518_COMPROBANTE DE ESTUDIOS.pdf', 31, '0000-00-00', '0', 1, 1, NULL, '2023-09-27 17:31:58', '2023-09-27 17:31:58'),
(217, 17, NULL, 31, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:52:35', '2023-10-02 15:52:35'),
(218, 2, '1696286153_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 21:35:53'),
(219, 2, NULL, 3, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 15:53:21'),
(220, 2, '1696286153_SAT.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 21:35:53'),
(221, 2, '1696286153_SOLICITUD DE EMPLEO, C.V..pdf', 10, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 21:35:53'),
(222, 2, '1696286153_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 21:35:53'),
(223, 2, NULL, 12, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 15:53:21'),
(224, 2, '1696286153_CARTA DE NO ANTECEDENTES PENALES.pdf', 13, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 21:35:53'),
(225, 2, '1696286153_IMSS.pdf', 14, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 21:35:53'),
(226, 2, NULL, 15, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 15:53:21'),
(227, 2, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 15:53:21'),
(228, 2, NULL, 17, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 15:53:21'),
(229, 2, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 15:53:21'),
(230, 2, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 15:53:21'),
(231, 2, NULL, 20, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 15:53:21'),
(232, 2, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 15:53:21'),
(233, 2, NULL, 28, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 15:53:21'),
(234, 2, '1696286153_Contrato de prueba 90 días.pdf', 29, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 21:35:53'),
(235, 2, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 15:53:21'),
(236, 2, NULL, 31, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 15:53:21', '2023-10-02 15:53:21'),
(237, 13, NULL, 9, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:30:57', '2023-10-02 16:30:57'),
(238, 13, NULL, 10, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:30:57', '2023-10-02 16:30:57'),
(239, 13, NULL, 11, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:30:57', '2023-10-02 16:30:57'),
(240, 13, NULL, 12, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:30:57', '2023-10-02 16:30:57'),
(241, 13, NULL, 13, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:30:57', '2023-10-02 16:30:57'),
(242, 13, NULL, 14, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:30:57', '2023-10-02 16:30:57'),
(243, 13, NULL, 15, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:30:57', '2023-10-02 16:30:57'),
(244, 13, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:30:57', '2023-10-02 16:30:57'),
(245, 13, NULL, 17, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:30:57', '2023-10-02 16:30:57'),
(246, 13, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:30:57', '2023-10-02 16:30:57'),
(247, 13, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:30:57', '2023-10-02 16:30:57'),
(248, 13, NULL, 20, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:30:57', '2023-10-02 16:30:57'),
(249, 13, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:30:57', '2023-10-02 16:30:57'),
(250, 13, NULL, 28, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:30:57', '2023-10-02 16:30:57'),
(251, 13, NULL, 29, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:30:57', '2023-10-02 16:30:57'),
(252, 13, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:30:57', '2023-10-02 16:30:57'),
(253, 13, NULL, 31, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:30:57', '2023-10-02 16:30:57'),
(254, 12, '1696285413_Contrato de prueba 90 días.pdf', 29, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:31:24', '2023-10-02 21:23:33'),
(255, 12, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:31:24', '2023-10-02 16:31:24'),
(256, 12, NULL, 31, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 16:31:24', '2023-10-02 16:31:24'),
(257, 10, '1696284350_SAT.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:05:50', '2023-10-02 21:05:50'),
(258, 10, '1696284350_C.V. o solicitud de empleo.pdf', 10, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:05:50', '2023-10-02 21:05:50'),
(259, 10, '1696284350_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:05:50', '2023-10-02 21:05:50'),
(260, 10, '1696284350_Comprobante de domicilio.pdf', 12, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:05:50', '2023-10-02 21:05:50'),
(261, 10, '1696284350_Carta de no antecedentes penales.pdf', 13, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:05:50', '2023-10-02 21:05:50'),
(262, 10, '1696284350_IMSS.pdf', 14, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:05:50', '2023-10-02 21:05:50'),
(263, 10, NULL, 15, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:05:50', '2023-10-02 21:05:50'),
(264, 10, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:05:50', '2023-10-02 21:05:50'),
(265, 10, NULL, 17, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:05:50', '2023-10-02 21:05:50'),
(266, 10, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:05:50', '2023-10-02 21:05:50'),
(267, 10, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:05:50', '2023-10-02 21:05:50'),
(268, 10, NULL, 20, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:05:50', '2023-10-02 21:05:50'),
(269, 10, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:05:50', '2023-10-02 21:05:50'),
(270, 10, '1696284350_Alta IMSS.pdf', 28, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:05:50', '2023-10-02 21:05:50'),
(271, 10, NULL, 29, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:05:50', '2023-10-02 21:05:50'),
(272, 10, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:05:50', '2023-10-02 21:05:50'),
(273, 10, '1696284350_Comprobante de ultimo grado de estudios.pdf', 31, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:05:50', '2023-10-02 21:05:50'),
(274, 3, NULL, 9, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:08:31', '2023-10-02 21:08:31'),
(275, 3, NULL, 10, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:08:31', '2023-10-02 21:08:31'),
(276, 3, NULL, 11, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:08:31', '2023-10-02 21:08:31'),
(277, 3, '1696284511_Comprobante de domicilio.pdf', 12, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:08:31', '2023-10-02 21:08:31'),
(278, 3, NULL, 13, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:08:31', '2023-10-02 21:08:31'),
(279, 3, '1696284511_IMSS.pdf', 14, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:08:31', '2023-10-02 21:08:31'),
(280, 3, NULL, 15, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:08:31', '2023-10-02 21:08:31'),
(281, 3, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:08:31', '2023-10-02 21:08:31'),
(282, 3, NULL, 17, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:08:31', '2023-10-02 21:08:31'),
(283, 3, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:08:31', '2023-10-02 21:08:31'),
(284, 3, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:08:31', '2023-10-02 21:08:31'),
(285, 3, NULL, 20, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:08:31', '2023-10-02 21:08:31'),
(286, 3, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:08:31', '2023-10-02 21:08:31'),
(287, 3, '1696284511_Alta IMSS.pdf', 28, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:08:31', '2023-10-02 21:08:31'),
(288, 3, '1696284511_Contrato de prueba 90 días.pdf', 29, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:08:31', '2023-10-02 21:08:31'),
(289, 3, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:08:31', '2023-10-02 21:08:31'),
(290, 3, NULL, 31, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:08:31', '2023-10-02 21:08:31'),
(291, 11, '1696284753_SAT.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:12:33', '2023-10-02 21:12:33'),
(292, 11, NULL, 10, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:12:33', '2023-10-02 21:12:33'),
(293, 11, '1696284753_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:12:33', '2023-10-02 21:12:33'),
(294, 11, '1696284753_Comprobante de domicilio.pdf', 12, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:12:33', '2023-10-02 21:12:33'),
(295, 11, NULL, 13, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:12:33', '2023-10-02 21:12:33'),
(296, 11, NULL, 14, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:12:33', '2023-10-02 21:12:33'),
(297, 11, NULL, 15, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:12:33', '2023-10-02 21:12:33'),
(298, 11, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:12:33', '2023-10-02 21:12:33'),
(299, 11, NULL, 17, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:12:33', '2023-10-02 21:12:33'),
(300, 11, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:12:33', '2023-10-02 21:12:33'),
(301, 11, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:12:33', '2023-10-02 21:12:33'),
(302, 11, NULL, 20, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:12:33', '2023-10-02 21:12:33'),
(303, 11, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:12:33', '2023-10-02 21:12:33'),
(304, 11, '1696284753_Alta IMSS.pdf', 28, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:12:33', '2023-10-02 21:12:33'),
(305, 11, '1696284753_Contrato de prueba 90 días.pdf', 29, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:12:33', '2023-10-02 21:12:33'),
(306, 11, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:12:33', '2023-10-02 21:12:33'),
(307, 11, '1696284753_Comprobante de ultimo grado de estudios.pdf', 31, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:12:33', '2023-10-02 21:12:33'),
(308, 9, '1696285046_SAT.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:17:26', '2023-10-02 21:17:26'),
(309, 9, '1696285046_C.V. o solicitud de empleo.pdf', 10, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:17:26', '2023-10-02 21:17:26'),
(310, 9, '1696285046_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:17:26', '2023-10-02 21:17:26'),
(311, 9, NULL, 12, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:17:26', '2023-10-02 21:17:26'),
(312, 9, '1696285046_Carta de no antecedentes penales.pdf', 13, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:17:26', '2023-10-02 21:17:26'),
(313, 9, '1696285046_IMSS.pdf', 14, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:17:26', '2023-10-02 21:17:26'),
(314, 9, '1696285046_Infonavit.pdf', 15, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:17:26', '2023-10-02 21:17:26'),
(315, 9, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:17:26', '2023-10-02 21:17:26'),
(316, 9, '1696285046_Certificado medico.pdf', 17, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:17:26', '2023-10-02 21:17:26'),
(317, 9, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:17:26', '2023-10-02 21:17:26'),
(318, 9, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:17:26', '2023-10-02 21:17:26'),
(319, 9, NULL, 20, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:17:26', '2023-10-02 21:17:26'),
(320, 9, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:17:26', '2023-10-02 21:17:26'),
(321, 9, NULL, 28, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:17:26', '2023-10-02 21:17:26'),
(322, 9, '1696285046_Contrato de prueba 90 días.pdf', 29, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:17:26', '2023-10-02 21:17:26'),
(323, 9, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:17:26', '2023-10-02 21:17:26'),
(324, 9, NULL, 31, '0000-00-00', '0', 1, 1, NULL, '2023-10-02 21:17:26', '2023-10-02 21:17:26'),
(325, 18, '1696361075_Acta de Nacimiento.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:24:35'),
(326, 18, '1696361075_Alta IMSS.pdf', 28, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:24:35'),
(327, 18, '1696361075_Infonavit.pdf', 15, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:24:35'),
(328, 18, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:07:04'),
(329, 18, '1696361075_Carta de recomendación laboral.pdf', 20, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:24:35'),
(330, 18, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:07:04'),
(331, 18, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:07:04'),
(332, 18, '1696361075_Comprobante de domicilio.pdf', 12, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:24:35'),
(333, 18, '1696361075_Comprobante de ultimo grado de estudios.pdf', 31, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:24:35'),
(334, 18, '1696361075_Carta de no antecedentes penales.pdf', 13, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:24:35'),
(335, 18, '1696361075_SAT.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:24:35'),
(336, 18, '1696361075_IMSS.pdf', 14, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:24:35'),
(337, 18, NULL, 29, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:07:04'),
(338, 18, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:07:04'),
(339, 18, '1696361075_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:24:35'),
(340, 18, '1696361075_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:24:35'),
(341, 18, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:07:04'),
(342, 18, '1696361075_Certificado medico.pdf', 17, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:24:35'),
(343, 18, '1696361075_Licencia de conducir.pdf', 3, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:24:35'),
(344, 18, NULL, 10, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 18:07:04', '2023-10-03 18:07:04'),
(345, 19, '1696376939_Acta de Nacimiento.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 22:48:59'),
(346, 19, '1696376939_Alta IMSS.pdf', 28, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 22:48:59'),
(347, 19, NULL, 15, '0000-00-00', '2', 0, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 22:48:59'),
(348, 19, NULL, 16, '0000-00-00', '2', 0, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 22:48:59'),
(349, 19, NULL, 20, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 19:05:09'),
(350, 19, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 19:05:09'),
(351, 19, NULL, 21, '0000-00-00', '2', 0, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 22:48:59'),
(352, 19, '1696376939_Comprobante de domicilio.pdf', 12, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 22:48:59'),
(353, 19, NULL, 31, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 19:05:09'),
(354, 19, '1696376939_Carta de no antecedentes penales.pdf', 13, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 22:48:59'),
(355, 19, '1696376939_SAT.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 22:48:59'),
(356, 19, NULL, 14, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 19:05:09'),
(357, 19, NULL, 29, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 19:05:09'),
(358, 19, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 19:05:09'),
(359, 19, '1696376939_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 22:48:59'),
(360, 19, '1696376939_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 22:48:59'),
(361, 19, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 19:05:09'),
(362, 19, '1696376939_Certificado medico.pdf', 17, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 22:48:59'),
(363, 19, NULL, 3, '0000-00-00', '2', 0, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 22:48:59'),
(364, 19, '1696376939_C.V. o solicitud de empleo.pdf', 10, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 19:05:09', '2023-10-03 22:48:59'),
(365, 20, '1696373798_Acta de Nacimiento.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(366, 20, '1696373798_Alta IMSS.pdf', 28, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(367, 20, '1696373798_Infonavit.pdf', 15, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(368, 20, NULL, 16, '0000-00-00', '2', 0, NULL, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(369, 20, '1696373798_Carta de recomendación laboral.pdf', 20, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(370, 20, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(371, 20, NULL, 21, '0000-00-00', '2', 0, NULL, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(372, 20, '1696373798_Comprobante de domicilio.pdf', 12, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(373, 20, '1696373798_Comprobante de ultimo grado de estudios.pdf', 31, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(374, 20, '1696373798_Carta de no antecedentes penales.pdf', 13, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(375, 20, '1696373798_SAT.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(376, 20, '1696373798_IMSS.pdf', 14, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(377, 20, NULL, 29, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(378, 20, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(379, 20, '1696373798_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(380, 20, '1696373798_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(381, 20, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(382, 20, '1696373798_Certificado medico.pdf', 17, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(383, 20, '1696373798_Licencia de conducir.pdf', 3, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(384, 20, '1696373798_C.V. o solicitud de empleo.pdf', 10, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 21:56:38', '2023-10-03 21:56:38'),
(385, 21, '1696374959_Acta de Nacimiento.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(386, 21, '1696374959_Alta IMSS.pdf', 28, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(387, 21, NULL, 15, '0000-00-00', '2', 0, NULL, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(388, 21, NULL, 16, '0000-00-00', '2', 0, NULL, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(389, 21, '1696374959_Carta de recomendación laboral.pdf', 20, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(390, 21, '1696374959_Carta de recomendación personal.pdf', 19, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(391, 21, NULL, 21, '0000-00-00', '2', 0, NULL, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(392, 21, '1696374959_Comprobante de domicilio.pdf', 12, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(393, 21, '1696374959_Comprobante de ultimo grado de estudios.pdf', 31, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(394, 21, '1696374959_Carta de no antecedentes penales.pdf', 13, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(395, 21, '1696374959_SAT.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(396, 21, '1696374959_IMSS.pdf', 14, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(397, 21, NULL, 29, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(398, 21, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(399, 21, '1696374959_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(400, 21, '1696374959_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(401, 21, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(402, 21, '1696374959_Certificado medico.pdf', 17, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(403, 21, '1696374959_Licencia de conducir.pdf', 3, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(404, 21, '1696374959_C.V. o solicitud de empleo.pdf', 10, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:15:59', '2023-10-03 22:15:59'),
(405, 22, '1696376081_Acta de Nacimiento.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(406, 22, '1696376081_Alta IMSS.pdf', 28, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(407, 22, NULL, 15, '0000-00-00', '2', 0, NULL, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(408, 22, NULL, 16, '0000-00-00', '2', 0, NULL, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(409, 22, '1696376081_Carta de recomendación laboral.pdf', 20, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(410, 22, NULL, 19, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(411, 22, NULL, 21, '0000-00-00', '2', 0, 1, NULL, '2023-10-03 22:34:41', '2023-10-03 22:37:04'),
(412, 22, '1696376081_Comprobante de domicilio.pdf', 12, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(413, 22, '1696376081_Comprobante de ultimo grado de estudios.pdf', 31, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(414, 22, '1696376081_Carta de no antecedentes penales.pdf', 13, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(415, 22, '1696376081_SAT.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(416, 22, '1696376081_IMSS.pdf', 14, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(417, 22, NULL, 29, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(418, 22, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(419, 22, '1696376081_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(420, 22, '1696376081_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(421, 22, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(422, 22, '1696376081_Certificado medico.pdf', 17, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(423, 22, '1696376081_Licencia de conducir.pdf', 3, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(424, 22, '1696376081_C.V. o solicitud de empleo.pdf', 10, '0000-00-00', '0', 1, 1, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41'),
(425, 23, '1701876295_ACTA DE NACIMIENTO.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:24:55'),
(426, 23, '1701876295_NUMERO DE IMSS.pdf', 28, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:24:55'),
(427, 23, NULL, 15, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:04:40'),
(428, 23, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:04:40'),
(429, 23, '1701876295_CARTAS DE RECOMENDACION LABORAL.pdf', 20, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:24:55'),
(430, 23, '1701876295_CARTAS DE RECOMENDACION PERSONAL.pdf', 19, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:24:55'),
(431, 23, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:04:40'),
(432, 23, '1701876295_COMPROBANTE DE DOMICILIO.pdf', 12, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:24:55'),
(433, 23, NULL, 31, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:04:40'),
(434, 23, '1701876295_CONSTANCIA DE NO ANTECEDENTES PENALES.pdf', 13, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:24:55'),
(435, 23, '1701876295_CONSTANCIA DE SITUACION FISCAL.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:24:55'),
(436, 23, NULL, 14, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:04:40'),
(437, 23, NULL, 29, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:04:40'),
(438, 23, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:04:40'),
(439, 23, '1701876295_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:24:55'),
(440, 23, '1701876295_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:24:55'),
(441, 23, '1701875548_41223175-20231405131448-Imprimirbk.pdf', 18, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:12:28'),
(442, 23, '1701876295_CERTIFICADO MEDICO.pdf', 17, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:24:55'),
(443, 23, NULL, 3, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:04:40'),
(444, 23, '1701876295_SOLICITUD DE EMPLEO.pdf', 10, '0000-00-00', '0', 1, 1, NULL, '2023-12-06 15:04:40', '2023-12-06 15:24:55'),
(445, 27, '1704302251_ACTA DE NACIMIENTO.pdf', 1, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 17:36:59'),
(446, 27, NULL, 28, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 16:56:36'),
(447, 27, NULL, 15, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 16:56:36'),
(448, 27, NULL, 16, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 16:56:36'),
(449, 27, '1704302251_CARTA DE RECOMEDACION LABORAL.pdf', 20, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 17:36:59'),
(450, 27, '1704302251_CARTA DE RECOMENDACION PERSONAL.pdf', 19, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 17:36:59'),
(451, 27, NULL, 21, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 16:56:36'),
(452, 27, '1704302251_COMPROBANTE DE DOMICILIO.pdf', 12, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 17:36:59'),
(453, 27, NULL, 31, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 16:56:36'),
(454, 27, '1704302251_CARTA DE NO ANTECEDENTES PENALES.pdf', 13, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 17:36:59'),
(455, 27, '1704302251_CSF.pdf', 9, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 17:36:59'),
(456, 27, '1704302251_NUMERO DE IMSS.pdf', 14, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 17:36:59'),
(457, 27, NULL, 29, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 16:56:36'),
(458, 27, NULL, 30, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 16:56:36');
INSERT INTO `userdocs` (`id`, `personalId`, `ruta`, `tipoId`, `fechaVencimiento`, `estatus`, `requerido`, `vencimiento`, `comentarios`, `created_at`, `updated_at`) VALUES
(459, 27, '1704302251_INE.pdf', 11, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 17:36:59'),
(460, 27, '1704302251_CURP.pdf', 2, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 17:36:59'),
(461, 27, NULL, 18, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 16:56:36'),
(462, 27, '1704302251_CERTIFICADO MEDICO.pdf', 17, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 17:36:59'),
(463, 27, NULL, 3, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 16:56:36'),
(464, 27, '1704302251_SOLUCITUD DE EMPLEO.pdf', 10, '0000-00-00', '0', 1, 1, NULL, '2024-01-03 16:56:36', '2024-01-03 17:36:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userEstatus`
--

DROP TABLE IF EXISTS `userEstatus`;
CREATE TABLE IF NOT EXISTS `userEstatus` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `color` varchar(8) DEFAULT NULL,
  `comentario` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `userEstatus`
--

INSERT INTO `userEstatus` (`id`, `nombre`, `color`, `comentario`) VALUES
(1, 'Activo', 'green', 'Usuario activo'),
(2, 'Inactivo', 'darkcyan', 'El usuario esta inactivo'),
(3, 'Baja', 'orange', 'El usuario fue dado de baja'),
(4, 'Borrado', 'red', 'El usario fue borrado de forma definitiva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text,
  `two_factor_recovery_codes` text,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `estadoId` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`, `username`, `estadoId`) VALUES
(1, 'Kevin', 'kcobian@suappi.com.mx', NULL, '$2y$10$glX8Kt/f7iye/7gva27h5.launjB9U02tqYDXv6mbI01HyQc3owXC', NULL, NULL, NULL, '2022-09-27 00:48:41', '2023-08-25 22:07:25', 'Kevin Cobian', 1),
(2, 'J Morelos', 'jmorelos@q2ces.com', NULL, '$2y$10$H9F/80DsN/kwZp9cEOG3zODtTJ53KJmTUmb8fCOK7Br2vluydm2xO', NULL, NULL, NULL, '2023-08-25 14:37:07', '2023-10-01 22:34:45', 'Jorge Morelos', 1),
(3, 'Mauricio Finkelstein', 'mfinkelstein@q2s.mx', NULL, '$2y$10$fuZpgSxWXTyBMGpdmNlMMenIMmCL.HyCvvXYa9atdlxXBuWRwuwei', NULL, NULL, NULL, '2023-08-25 22:03:08', '2024-01-13 01:15:08', 'Mauricio Finkelstein', 1),
(4, 'Victor Finkelstein', 'vfinkelstein@q2s.mx', NULL, '$2y$10$/piROZCiIzmhdTmFP.iPlejVrGq.mTMrwFOiEofGusk4CGMoKgE0C', NULL, NULL, NULL, '2023-08-25 22:04:20', '2023-12-22 15:11:19', 'Victor Finkelstein', 2),
(5, 'Ricardo Rios', 'rrios@suappi.com.mx', NULL, '$2y$10$20.fTN.A3v1nsfc5//5rxObHsYE3F33c83V3RUzpSz7E8q9IKrivS', NULL, NULL, NULL, '2023-08-25 22:05:34', '2023-08-25 22:05:34', 'Ricardo Rios', 1),
(6, 'J Torres Flores', 'jtorres@q2ces.com', NULL, '$2y$10$1/LrhPquuxMpOEsUMRAZHeXwqgtSdcpFm7GLAYVZxQKcukG2dD0Bm', NULL, NULL, NULL, '2023-08-25 22:35:46', '2023-11-30 18:58:13', NULL, 2),
(7, 'alberto', 'aibarra@suappi.com.mx', NULL, '$2y$10$trZtO0eFOZHYyO5IqRJqDepBY38jvHkXLQriwujBDPwciAC/6.D8.', NULL, NULL, NULL, '2023-08-28 15:21:06', '2023-12-21 15:09:10', 'alberto', 1),
(8, 'Nohemi', 'facturas@q2s.mx', NULL, '$2y$10$00ciOqbFYWwkUinnG9lKK.eOmJd0aEcYWMMWD76KQ8k9RNP4jzaXy', NULL, NULL, NULL, '2023-08-28 16:07:02', '2023-10-17 15:09:49', 'Nohemi', 1),
(9, 'Johan Raul', 'johann.talavera@newspm.mx', NULL, '$2y$10$qU224nf4zO/BuH4MEYEoi.YcT9NzUNp5Pa3wSfxnbbRyemoGwNt.W', NULL, NULL, NULL, '2023-08-28 16:07:12', '2023-10-11 21:43:25', 'Johan Talavera', 2),
(10, 'J Villalobos Ayala', 'jvillalobos@q2ces.com', NULL, '$2y$10$G8AhP2wTcP0nh4ySdVcsDOgBI8WZuxyOsvrFux8PFosYtWUAgBwfi', NULL, NULL, NULL, '2023-08-29 15:09:46', '2023-08-29 15:09:46', NULL, 1),
(11, 'J Ibarra Medina', 'jibarra@q2ces.com', NULL, '$2y$10$eUPQ3F6qQEZZT.GFnDePrO5TC8iIUlBzP7AI.N7umfUF62XH0v3km', NULL, NULL, NULL, '2023-08-29 17:50:43', '2023-08-29 17:50:43', NULL, 1),
(12, 'J Torres Flores', 'jtorresflores@q2ces.com', NULL, '$2y$10$Qto3XnweeRWz.eXY2kk4nOATaqVD/m/5.x8uG4vF2eTSpBRacjkV2', NULL, NULL, NULL, '2023-08-29 18:54:17', '2023-11-30 18:58:25', NULL, 2),
(13, 'K Cobián Franco', 'kcobian@q2ces.com', NULL, '$2y$10$Nv2M/pmQsErCwtSd/K33UOYC/WX6WZweCL16E2CGRBiLx3a3RxI5y', NULL, NULL, NULL, '2023-08-29 22:01:49', '2023-08-29 22:01:49', NULL, 1),
(14, 'P Magaña Contreras', 'pmagana@q2ces.com', NULL, '$2y$10$TBXeTYmu5PrzIOliV8IdLuCa01Ry0/.auEr9/UjiEi4hb2Y5rYp6q', NULL, NULL, NULL, '2023-08-29 22:20:45', '2023-08-29 22:20:45', NULL, 1),
(15, 'L Avila Benites', 'lavila@q2ces.com', NULL, '$2y$10$70jnSfWZWlfprQi0.Arziu1rIBUlBZbaF/4J4Dng9z2IjRD.bOSQa', NULL, NULL, NULL, '2023-08-29 22:49:27', '2023-08-29 22:49:27', NULL, 1),
(16, 'D Fajardo Barrera', 'dfajardo@q2ces.com', NULL, '$2y$10$N0cN8MIJQhLZig7Z7ks5seQTSadb396pGW8VfjBkqrvYy.5MYktea', NULL, NULL, NULL, '2023-08-29 23:05:27', '2023-08-29 23:05:27', NULL, 1),
(17, 'M Razón Serrano', 'mrazon@q2ces.com', NULL, '$2y$10$iaAvAc2zSoTAz.bFOCeSgOIffHKRScsxk2UfZ7zNuPsPOXWYuT0iK', NULL, NULL, NULL, '2023-08-30 17:06:08', '2023-11-30 18:57:41', NULL, 2),
(18, 'P López Hernández', 'plopez@q2ces.com', NULL, '$2y$10$R8t9dCDIEKLw8H9B/3K3JeGXJnDQLuJapjnd9FHRzsiqqEUWADyle', NULL, NULL, NULL, '2023-08-30 17:40:37', '2023-08-30 17:40:37', NULL, 1),
(19, 'F Alcalá Moreno', 'falcala@q2ces.com', NULL, '$2y$10$44m6X1o/WKvd8rx5VJxWleGVts/os/FhzKr8IUBz4AcSlYGB0ROca', NULL, NULL, NULL, '2023-08-30 18:00:35', '2023-08-30 18:00:35', NULL, 1),
(20, 'A Aviña García', 'aavina@q2ces.com', NULL, '$2y$10$iUbCBNBHk.J7YV7lr05sYuq5g2LGh.gFJCNfNWjVG8.7V1/V9Plri', NULL, NULL, NULL, '2023-08-30 18:36:22', '2023-11-30 18:57:36', NULL, 2),
(21, 'Edgar Villalobos Gómez', 'oper416e@gmail.com', NULL, '$2y$10$QeFBl/mNy64UJzTvByEkB.eyxLkYmT7sZvxP/li2S2lCVkOgbG8US', NULL, NULL, NULL, '2023-08-30 19:02:29', '2024-01-04 15:25:56', 'Edgar Villalobos', 1),
(22, 'Jose Israel López López', 'jose.lopez@mtqmexico.com', NULL, '$2y$10$oQM78UHPesizE1saqcHbpe5253I5XWlUMj21aLo5X82HaZph4j3he', NULL, NULL, NULL, '2023-08-30 21:47:37', '2023-10-12 14:57:36', 'Israel López', 1),
(23, 'M Finkelstein Moel', 'mfinkelstein@q2ces.com', NULL, '$2y$10$jf0PTRWiqe8HYD1INV6JgOWE88K0dm5UA7P1MEvfW11umBZHIo5He', NULL, NULL, NULL, '2023-08-30 22:15:29', '2023-08-30 22:15:29', NULL, 1),
(24, 'P Rodríguez Castellano', 'prodriguez@q2ces.com', NULL, '$2y$10$UNU8uy1z5q8S8KqH1MNnh.8Yx7z9MtrwnNz5KyidoCNjiUCzn.c.C', NULL, NULL, NULL, '2023-08-30 22:28:43', '2023-08-30 22:28:43', NULL, 1),
(25, 'Oscar Villaseñor', 'oscar@mtqmexico.com', NULL, '$2y$10$xaahP/lpXpKcNcpY.4txxOB65c5opUA1/m6cz7tHw3tMIBk.nHwnq', NULL, NULL, NULL, '2023-09-19 16:52:19', '2024-01-08 17:22:25', 'Oscar Villaseñor', 1),
(26, 'Johann Rafael Talavera', 'jtalavera@qces.com', NULL, '$2y$10$wvmn2Hb3qnkaWaOnd.oLweUhbGw9lrjgaLqIMhCzNXWvocIb4sWAa', NULL, NULL, NULL, '2023-09-21 14:00:04', '2023-10-11 21:43:38', 'Johann Rafael Talavera', 2),
(27, 'Juan José Rivera', 'jrivera@q2ces.com', NULL, '$2y$10$T0Mk8FDyD9jfHmREqQLUw.XaImGV2U4/XxDdZMh8OvlzrkW9AAfju', NULL, NULL, NULL, '2023-09-21 14:01:01', '2023-09-21 14:01:01', 'Juan José Rivera', 1),
(28, 'DM', 'asadasdasd@a.com', NULL, '$2y$10$JyEuEj7KaSzrJW0grbVgHuvk0PeFO3CBN3XN7WjgKlG0/DbKY7r02', NULL, NULL, NULL, '2023-09-29 18:26:57', '2023-10-11 21:41:58', 'Tu', 2),
(29, 'DM', 'asadasdasd@a.com', NULL, '$2y$10$6G4hqES5LbPfGRxp21fI6uGOfVkilHBCDwSpAPaQJs5MAk12hoq2.', NULL, NULL, NULL, '2023-09-29 18:29:15', '2023-10-11 21:41:42', 'Tu', 2),
(30, 'R Sandoval Gallardo', 'rsandoval@q2ces.com', NULL, '$2y$10$bIXlAEcAJ.T2RoL4V/dgd.nj.VjoN7QdxSXRD9czErrDvxX7Lfoqy', NULL, NULL, NULL, '2023-10-03 18:07:04', '2023-11-30 18:58:00', NULL, 2),
(31, 'R Barajas Maldonado', 'rbarajas@q2ces.com', NULL, '$2y$10$FCJdy/w33HDaRdJx4Q46uuAjj.FdbU4J2YDn27FQSpby.dAEJl/2S', NULL, NULL, NULL, '2023-10-03 19:05:09', '2023-10-03 19:05:09', NULL, 1),
(32, 'M Mendoza Luna', 'mmendoza@q2ces.com', NULL, '$2y$10$b4rN5e8.8GKoa/sc34cMg.F099YO6ilWTwrQueTcJ/WveBWdPPK1O', NULL, NULL, NULL, '2023-10-03 21:56:38', '2023-11-30 18:57:32', NULL, 2),
(33, 'E Navarrete Haro', 'enavarrete@q2ces.com', NULL, '$2y$10$MJ6yrzS1dv6GPFNl52hqVOc6UeJCEGn3HayDyUc3lh99Ju5st8eZC', NULL, NULL, NULL, '2023-10-03 22:15:59', '2023-11-30 18:58:04', NULL, 2),
(34, 'N Prieto Espinosa', 'nprieto@q2ces.com', NULL, '$2y$10$peMhk6x2QXUmr/p6htL7Het1cKC/7y.duWXPla8EWSOG2lyPAPgsy', NULL, NULL, NULL, '2023-10-03 22:34:41', '2023-10-03 22:34:41', NULL, 1),
(35, 'Taller Q2CES', 'tallerq2ces@gmail.com', NULL, '$2y$10$.TubUJ3AAxUxTWAg18hviuOS.NTkGUUmVfSjcYvD2OUPKHRp4u/xS', NULL, NULL, NULL, '2023-10-09 13:08:24', '2023-10-09 13:08:24', 'Taller Q2CES', 1),
(36, 'Residente', 'residente@q2ces.com', NULL, '$2y$10$dHlhr.faQ4DOfiFZPWsyweUJ0Aq2m.unRd1Cen0dBE8ueomUmux0.', NULL, NULL, NULL, '2023-10-10 14:44:31', '2023-12-20 16:10:00', 'Residente', 2),
(37, 'Ricardo Rodríguez', 'rr210690@prodigy.net.mx', NULL, '$2y$10$gfYjZt3Le3CTnEPWYQyfpeMrC7iBEHFmULTx9Qh9WybFFEWp6sKDG', NULL, NULL, NULL, '2023-10-17 15:27:24', '2023-10-17 15:27:24', 'Ricardo Rodríguez', 1),
(38, 'U NUÑEZ FREGOSO', 'ununez@q2ces.com', NULL, '$2y$10$dDudX2ljSYA4yyWDblwJeeE2/OWBgfyl9DL23hR74Q3LJJNTkRvcW', NULL, NULL, NULL, '2023-12-06 15:04:40', '2023-12-06 15:04:40', NULL, 1),
(39, 'Test Residente', 'residentetest@q2ces.com', NULL, '$2y$10$ahQiRi9Tq0NKEmDMrzE/1.ikoF8MIwyo4XlXwRHBc3VwY5Uv5ZiFO', NULL, NULL, NULL, '2023-12-20 16:04:04', '2023-12-20 16:04:04', 'Test Residente', 1),
(40, 'USER Test', 'utest1@q2ces.com', NULL, '$2y$10$Qf/vdaxO5ndEtYPRsjfx4usFHUPwsZkdBcIdaH/60kAmzKCTkIsBi', NULL, NULL, NULL, '2023-12-21 18:03:47', '2023-12-21 18:03:47', 'USER Testtest1', 1),
(41, 'Javier', 'jrodriguez@q2ces.com', NULL, '$2y$10$MNW5FHCPa4PlerClMj1zk.6l5HBEMnaPblMTCghlPWnTCa1f2SBXm', NULL, NULL, NULL, '2023-12-22 15:01:36', '2023-12-22 15:01:36', 'JavierRodriguez', 1),
(42, 'Victor', 'vfinkelstein@q2s.mx', NULL, '$2y$10$r9DEuPP5KM7frt2PYdnhze1t5MXNihRqlrGI1NtP2cctPgd1V1K0y', NULL, NULL, NULL, '2023-12-22 15:14:23', '2023-12-22 15:14:38', 'VictorFinkelstein', 1),
(43, 'J ALCALA CORTEZ', 'jalcala@q2ces.com', NULL, '$2y$10$J3o1hVS0qcr4UZNaVqe8vu3M.80NUhBkAhVr6nwBjYYotS.vVb7HK', NULL, NULL, NULL, '2024-01-03 16:56:36', '2024-01-03 16:56:36', NULL, 1),
(44, 'Alejandro Alejo', 'alejandro.alejo@mtqmexico.com', NULL, '$2y$10$haX5uPD5y5p.CbQYB/Ldk.d8OeHySR0qxUE1kTpPhZxjMcF70H.Qy', NULL, NULL, NULL, '2024-01-08 19:17:52', '2024-01-08 19:17:52', 'Alejandro Alejo', 1),
(45, 'Osvaldo Saldaña', 'osvaldo.saldana@mtqmexico.com', NULL, '$2y$10$GZ9QRNsbWtXN4eGHwErtR.eznZjjvSvjuwXBRHUj2Hd27Ihe9K0fm', NULL, NULL, NULL, '2024-01-10 16:55:29', '2024-01-10 16:55:29', 'Osvaldo Saldaña', 1),
(46, 'Eric Franco', 'eric.franco@mtqmexico.com', NULL, '$2y$10$ULqH9HiRUknm23dQQY4Q9e3CSqGZgtku7yYdbHnZDB9LaiX7ioaSC', NULL, NULL, NULL, '2024-01-10 17:05:58', '2024-01-10 17:05:58', 'Eric Franco', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usoMaquinarias`
--

DROP TABLE IF EXISTS `usoMaquinarias`;
CREATE TABLE IF NOT EXISTS `usoMaquinarias` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `maquinariaId` bigint(20) UNSIGNED NOT NULL,
  `uso` float(10,2) NOT NULL,
  `comentario` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `restantes` int(11) DEFAULT NULL,
  `proviene` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_usoMaquinarias_maquinariaId` (`maquinariaId`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usoMaquinarias`
--

INSERT INTO `usoMaquinarias` (`id`, `maquinariaId`, `uso`, `comentario`, `created_at`, `updated_at`, `restantes`, `proviene`) VALUES
(1, 2, 290000.00, NULL, '2023-08-29 08:08:09', '2023-08-29 08:08:09', NULL, NULL),
(2, 3, 29000.00, NULL, '2023-08-29 08:08:09', '2023-08-29 10:39:21', NULL, NULL),
(3, 4, 27000.00, NULL, '2023-08-29 08:08:09', '2023-08-29 08:08:09', NULL, NULL),
(4, 6, 40000.00, NULL, '2023-08-29 10:38:27', '2023-09-21 16:20:14', NULL, NULL),
(5, 4, 27001.00, NULL, '2023-09-21 17:08:03', '2023-09-21 17:08:03', -27001, 'Uso'),
(6, 4, 27500.00, NULL, '2023-09-21 17:08:25', '2023-10-03 10:03:11', -27002, 'Uso'),
(7, 2, 290300.00, NULL, '2023-10-03 10:04:45', '2023-10-03 10:04:45', -290300, 'Uso'),
(8, 3, 283000.00, NULL, '2023-10-03 10:04:45', '2023-10-03 10:04:45', -283000, 'Uso'),
(9, 4, 27500.00, NULL, '2023-10-03 10:04:45', '2023-10-03 10:04:45', 500, 'Uso'),
(10, 6, 23300.00, NULL, '2023-10-03 10:04:45', '2023-10-03 10:04:45', -23300, 'Uso'),
(11, 35, 114756.00, NULL, '2023-10-05 12:56:38', '2023-10-05 12:56:38', -114755, 'Uso'),
(12, 36, 83891.00, NULL, '2023-10-05 13:00:01', '2023-10-05 13:00:01', -83891, 'Uso'),
(13, 37, 285989.00, NULL, '2023-10-05 13:05:34', '2023-10-05 13:05:34', -285989, 'Uso'),
(14, 38, 32867.00, NULL, '2023-10-05 13:09:24', '2023-10-05 13:09:24', -32867, 'Uso'),
(15, 39, 447628.00, NULL, '2023-10-05 13:13:16', '2023-10-05 13:13:16', -447628, 'Uso'),
(16, 40, 247532.00, NULL, '2023-10-05 13:23:18', '2023-10-05 13:23:18', -247532, 'Uso'),
(17, 41, 223556.00, NULL, '2023-10-05 13:28:27', '2023-10-05 13:28:27', -223556, 'Uso'),
(18, 42, 280796.00, NULL, '2023-10-05 13:32:48', '2023-10-05 13:32:48', -280796, 'Uso'),
(19, 43, 189333.00, NULL, '2023-10-05 13:36:14', '2023-10-05 13:36:14', -189333, 'Uso'),
(20, 44, 264478.00, NULL, '2023-10-05 13:40:47', '2023-10-05 13:40:47', -264478, 'Uso'),
(21, 45, 146275.00, NULL, '2023-10-05 13:44:38', '2023-10-05 13:44:38', -146275, 'Uso'),
(22, 46, 175042.00, NULL, '2023-10-05 13:47:50', '2023-10-05 13:47:50', -175042, 'Uso'),
(23, 47, 210820.00, NULL, '2023-10-05 13:54:15', '2023-10-05 13:54:15', -210820, 'Uso'),
(24, 48, 242749.00, NULL, '2023-10-05 13:57:47', '2023-10-05 13:57:47', -242749, 'Uso'),
(25, 49, 262700.00, NULL, '2023-10-05 14:01:05', '2023-10-05 14:01:05', -262700, 'Uso'),
(26, 50, 249991.00, NULL, '2023-10-05 16:01:29', '2023-10-05 16:01:29', -249991, 'Uso'),
(27, 51, 81983.00, NULL, '2023-10-05 16:06:08', '2023-10-05 16:06:08', -81983, 'Uso'),
(28, 52, 70264.00, NULL, '2023-10-05 16:12:07', '2023-10-05 16:12:07', -70264, 'Uso'),
(29, 53, 272179.00, NULL, '2023-10-05 16:16:39', '2023-10-05 16:16:39', -272179, 'Uso'),
(30, 54, 309469.00, NULL, '2023-10-05 16:24:41', '2023-10-05 16:24:41', -309469, 'Uso'),
(31, 55, 116047.00, NULL, '2023-10-05 17:27:01', '2023-10-05 17:27:01', -116047, 'Uso'),
(32, 56, 62776.00, NULL, '2023-10-05 17:31:40', '2023-10-05 17:31:40', -62776, 'Uso'),
(33, 57, 90045.00, NULL, '2023-10-05 17:35:23', '2023-10-05 17:35:23', -90045, 'Uso'),
(34, 58, 49699.00, NULL, '2023-10-05 17:38:47', '2023-10-05 17:38:47', -49699, 'Uso'),
(35, 59, 85077.00, NULL, '2023-10-05 17:43:05', '2023-10-05 17:43:05', -85077, 'Uso'),
(36, 60, 295166.00, NULL, '2023-10-05 17:52:00', '2023-10-05 17:52:00', -295166, 'Uso'),
(37, 61, 111037.00, NULL, '2023-10-05 17:55:24', '2023-10-05 17:55:24', -111037, 'Uso'),
(38, 62, 193216.00, NULL, '2023-10-06 08:57:05', '2023-10-06 12:28:51', -193215, 'Uso'),
(39, 63, 98144.00, NULL, '2023-10-06 09:09:32', '2023-10-06 12:26:10', -98142, 'Uso'),
(40, 64, 26473.00, NULL, '2023-10-06 09:28:02', '2023-10-06 09:28:02', -26473, 'Uso'),
(41, 65, 41836.00, NULL, '2023-10-06 09:48:03', '2023-10-06 09:48:03', -41836, 'Uso'),
(42, 66, 21768.00, NULL, '2023-10-06 09:48:03', '2023-10-06 09:48:03', -21768, 'Uso'),
(43, 67, 20148.00, NULL, '2023-10-06 09:52:25', '2023-10-06 09:52:25', -20148, 'Uso'),
(44, 68, 20907.00, NULL, '2023-10-06 09:58:39', '2023-10-06 09:58:39', -20907, 'Uso'),
(45, 69, 168263.00, NULL, '2023-10-06 10:05:35', '2023-10-06 10:05:35', -168263, 'Uso'),
(46, 70, 10727.00, NULL, '2023-10-06 10:13:06', '2023-10-06 10:13:06', -10727, 'Uso'),
(47, 71, 329585.00, NULL, '2023-10-06 10:40:00', '2023-10-06 10:40:00', -329585, 'Uso'),
(48, 72, 63869.00, NULL, '2023-10-06 10:45:17', '2023-10-06 12:35:06', -63864, 'Uso'),
(49, 73, 54863.00, NULL, '2023-10-06 10:58:19', '2023-10-06 10:58:19', -54863, 'Uso'),
(50, 74, 70649.00, NULL, '2023-10-06 11:12:19', '2023-10-06 11:12:19', -70649, 'Uso'),
(51, 75, 30578.00, NULL, '2023-10-06 11:18:42', '2023-10-06 11:18:42', -30578, 'Uso'),
(52, 45, 146276.00, NULL, '2023-10-06 12:23:21', '2023-10-06 12:23:21', 12744, 'Uso'),
(53, 45, 146301.00, NULL, '2023-10-06 12:26:02', '2023-10-06 12:27:05', 12720, 'Uso'),
(54, 72, 63865.00, NULL, '2023-10-06 12:29:10', '2023-10-06 12:29:10', 10669, 'Uso'),
(55, 72, 63866.00, NULL, '2023-10-06 12:42:18', '2023-10-06 12:42:18', 10668, 'Uso'),
(56, 35, 114780.00, NULL, '2023-10-10 09:36:37', '2023-10-10 09:36:37', -114779, 'Uso'),
(57, 72, 63880.00, NULL, '2023-10-10 09:37:48', '2023-10-10 09:37:48', 10654, 'Uso'),
(58, 72, 63888.00, NULL, '2023-10-11 11:55:21', '2023-10-11 11:55:21', 10646, 'Uso'),
(59, 35, 114790.00, NULL, '2023-10-12 10:04:21', '2023-10-12 10:04:21', -114789, 'Uso'),
(60, 45, 149020.00, NULL, '2023-10-13 10:37:27', '2023-10-13 10:37:27', 10000, 'Uso'),
(61, 63, 103493.00, NULL, '2023-10-13 10:41:02', '2023-10-13 10:41:02', 10000, 'Uso'),
(62, 62, 198356.00, NULL, '2023-10-13 10:42:08', '2023-10-13 10:42:08', -198355, 'Uso'),
(63, 49, 265859.00, NULL, '2023-10-13 10:44:10', '2023-10-13 10:44:10', 10000, 'Uso'),
(64, 54, 310034.00, NULL, '2023-10-13 10:44:10', '2023-10-13 10:44:10', 9435, 'Uso'),
(65, 48, 243815.00, NULL, '2023-10-13 10:47:38', '2023-10-13 10:47:38', 0, 'Uso'),
(66, 53, 292949.00, NULL, '2023-10-13 10:49:39', '2023-10-13 10:49:39', 8817, 'Uso'),
(67, 35, 119996.00, NULL, '2023-10-17 11:00:04', '2023-10-17 11:00:04', 10000, 'Uso'),
(68, 41, 229785.00, NULL, '2023-10-17 11:02:04', '2023-10-17 11:02:04', 5000, 'Uso'),
(69, 37, 292404.00, NULL, '2023-10-17 11:21:57', '2023-10-17 11:21:57', 8772, 'Uso'),
(70, 71, 344437.00, NULL, '2023-10-19 16:31:29', '2023-10-19 16:31:29', 10000, 'Uso'),
(71, 59, 94415.00, NULL, '2023-10-23 16:43:44', '2023-10-23 16:43:44', 10000, 'Uso'),
(72, 40, 254472.00, NULL, '2023-10-24 13:08:15', '2023-10-24 13:08:15', 3980, 'Uso'),
(73, 39, 460543.00, NULL, '2023-10-30 16:43:31', '2023-10-30 16:43:31', -2301, 'Uso'),
(74, 40, 255071.00, NULL, '2023-10-31 16:24:36', '2023-10-31 16:24:36', 3381, 'Uso'),
(75, 60, 301868.00, NULL, '2023-11-03 10:52:47', '2023-11-03 10:52:47', -301868, 'Uso'),
(76, 32, 1.00, NULL, '2023-11-07 12:23:11', '2023-11-07 12:23:11', -1, 'Uso'),
(77, 32, 2.00, NULL, '2023-11-07 12:27:01', '2023-11-07 12:27:01', -2, 'Uso'),
(78, 32, 3.00, NULL, '2023-11-07 12:27:14', '2023-11-07 12:27:14', -3, 'Uso'),
(79, 26, 2675.00, NULL, '2023-11-07 13:06:01', '2023-11-07 13:06:01', -2675, 'Uso'),
(80, 22, 535668.00, NULL, '2023-11-07 13:06:01', '2023-11-07 13:06:01', -535668, 'Uso'),
(81, 19, 69546.00, NULL, '2023-11-07 13:06:01', '2023-11-07 13:06:01', -69546, 'Uso'),
(82, 15, 555368.00, NULL, '2023-11-07 13:06:01', '2023-11-07 13:06:01', -555368, 'Uso'),
(83, 31, 6355.00, NULL, '2023-11-07 13:06:01', '2023-11-07 13:06:01', -6355, 'Uso'),
(84, 30, 5778.00, NULL, '2023-11-07 13:06:01', '2023-11-07 13:06:01', -5778, 'Uso'),
(85, 28, 3819.00, NULL, '2023-11-07 13:06:01', '2023-11-07 13:06:01', -3819, 'Uso'),
(86, 29, 5850.00, NULL, '2023-11-07 13:06:01', '2023-11-07 13:06:01', -5850, 'Uso'),
(87, 25, 355.00, NULL, '2023-11-07 13:06:01', '2023-11-07 13:06:01', -355, 'Uso'),
(88, 1, 56676.00, NULL, '2023-11-07 13:06:01', '2023-11-07 13:06:01', -56676, 'Uso'),
(89, 8, 7309.00, NULL, '2023-11-07 13:06:01', '2023-11-07 13:06:01', -7309, 'Uso'),
(90, 13, 871056.00, NULL, '2023-11-07 13:06:01', '2023-11-07 13:06:01', -871056, 'Uso'),
(91, 5, 600957.00, NULL, '2023-11-07 13:06:01', '2023-11-07 13:06:01', -600957, 'Uso'),
(92, 21, 482763.00, NULL, '2023-11-07 13:06:01', '2023-11-07 13:06:01', -482763, 'Uso'),
(93, 8, 71.00, NULL, '2023-11-08 08:33:16', '2023-11-08 08:33:16', -71, 'CheckList'),
(94, 41, 232148.00, NULL, '2023-11-09 10:09:40', '2023-11-09 10:09:40', 2637, 'Uso'),
(95, 5, 12345.00, NULL, '2023-11-14 09:05:49', '2023-11-14 09:05:49', -12345, 'CheckList'),
(96, 13, 1000.00, NULL, '2023-11-17 11:25:12', '2023-11-17 11:25:12', -1000, 'CheckList'),
(97, 8, 71309.00, NULL, '2023-11-29 11:26:22', '2023-11-29 11:26:22', -71309, 'Uso'),
(98, 13, 871056.00, NULL, '2023-11-29 11:26:54', '2023-11-29 11:26:54', -871056, 'Uso'),
(99, 5, 600957.00, NULL, '2023-11-29 11:27:54', '2023-11-29 11:27:54', -600957, 'Uso'),
(100, 13, 874216.00, NULL, '2023-11-29 11:34:29', '2023-11-29 11:34:29', 6840, 'Uso'),
(101, 21, 486770.00, NULL, '2023-11-29 11:34:55', '2023-11-29 11:34:55', 5993, 'Uso'),
(102, 15, 555560.00, NULL, '2023-11-29 11:35:27', '2023-11-29 11:35:27', 9808, 'Uso'),
(103, 22, 538026.00, NULL, '2023-11-29 11:35:47', '2023-11-29 11:35:47', 7642, 'Uso'),
(104, 16, 73241.00, NULL, '2023-11-29 11:36:20', '2023-11-29 11:36:20', -73241, 'Uso'),
(105, 1, 58194.00, NULL, '2023-11-29 11:39:19', '2023-11-29 11:39:19', 8482, 'Uso'),
(106, 17, 147661.00, NULL, '2023-11-29 11:39:51', '2023-11-29 11:39:51', -147661, 'Uso'),
(107, 62, 205391.00, NULL, '2023-11-29 11:41:13', '2023-11-29 11:41:13', 2965, 'Uso'),
(108, 30, 5934.00, NULL, '2023-11-29 11:49:48', '2023-11-29 11:49:48', 94, 'Uso'),
(109, 5, 605048.00, NULL, '2023-11-30 18:00:51', '2023-11-30 18:00:51', 5909, 'Uso'),
(110, 5, 0.00, NULL, '2023-12-01 09:24:19', '2023-12-01 09:24:19', 610957, 'CheckList'),
(111, 62, 205394.00, NULL, '2023-12-01 17:56:16', '2023-12-01 17:56:16', 2962, 'Mantenimiento'),
(112, 62, 205394.00, NULL, '2023-12-01 17:57:56', '2023-12-01 17:57:56', 250, 'Mantenimiento'),
(113, 62, 205394.00, NULL, '2023-12-01 18:15:24', '2023-12-01 18:15:24', 250, 'Mantenimiento'),
(114, 17, 147704.00, NULL, '2023-12-04 09:02:05', '2023-12-04 09:02:05', -147704, 'Mantenimiento'),
(115, 43, 190000.00, NULL, '2023-12-13 08:39:33', '2023-12-13 08:39:33', -190000, 'Mantenimiento'),
(116, 29, 4069.00, NULL, '2023-12-13 09:51:49', '2023-12-13 09:51:49', 0, 'Uso'),
(117, 31, 6564.00, NULL, '2023-12-13 10:25:36', '2023-12-13 10:25:36', 41, 'Uso'),
(118, 43, 209792.00, NULL, '2023-12-16 10:50:37', '2023-12-16 10:50:37', -19542, 'Mantenimiento'),
(119, 5, 600957.00, NULL, '2023-12-18 10:51:06', '2023-12-18 10:51:06', 10000, 'Uso'),
(120, 31, 6569.00, NULL, '2023-12-18 16:28:54', '2023-12-18 16:28:54', 36, 'Mantenimiento'),
(121, 40, 258926.00, NULL, '2023-12-20 09:58:24', '2023-12-20 09:58:24', 6145, 'Uso'),
(122, 71, 344438.00, NULL, '2023-12-20 11:34:22', '2023-12-20 11:34:22', 9999, 'Uso'),
(123, 71, 345000.00, NULL, '2023-12-20 11:35:01', '2023-12-20 11:35:01', 9437, 'Uso'),
(124, 13, 874217.00, NULL, '2023-12-21 13:05:05', '2023-12-21 13:05:05', 6839, 'Servicios'),
(125, 26, 2784.00, NULL, '2023-12-26 16:45:04', '2023-12-26 16:45:04', 141, 'Uso'),
(126, 30, 5982.00, NULL, '2024-01-04 12:23:50', '2024-01-04 12:23:50', 46, 'Uso'),
(127, 42, 291000.00, NULL, '2024-01-08 11:30:53', '2024-01-08 11:30:53', -290709, 'Uso'),
(128, 32, 4.00, NULL, '2024-01-08 13:24:04', '2024-01-08 13:24:04', -4, 'Uso'),
(129, 29, 4108.00, NULL, '2024-01-08 13:25:35', '2024-01-08 13:25:35', -39, 'Uso'),
(130, 40, 258927.00, NULL, '2024-01-08 16:37:08', '2024-01-08 16:37:08', 6144, 'Uso'),
(131, 29, 4108.00, NULL, '2024-01-09 08:54:46', '2024-01-09 08:54:46', -39, 'Mantenimiento'),
(132, 71, 354107.00, NULL, '2024-01-09 13:45:46', '2024-01-09 13:45:46', 330, 'Uso'),
(133, 42, 291616.00, NULL, '2024-01-10 10:45:51', '2024-01-10 10:45:51', -288, 'Mantenimiento'),
(134, 28, 6158.00, NULL, '2024-01-10 16:37:45', '2024-01-10 16:37:45', -58, 'Mantenimiento'),
(135, 25, 378.00, NULL, '2024-01-11 17:44:29', '2024-01-11 17:44:29', 227, 'Uso'),
(136, 41, 237124.00, NULL, '2024-01-12 17:21:23', '2024-01-12 17:21:23', -2339, 'Mantenimiento'),
(137, 71, 354668.00, NULL, '2024-01-15 09:07:04', '2024-01-15 09:07:04', -231, 'Mantenimiento'),
(138, 29, 4358.00, NULL, '2024-01-16 10:44:30', '2024-01-16 10:44:30', 0, 'Uso'),
(139, 28, 6160.00, NULL, '2024-01-16 10:44:49', '2024-01-16 10:44:49', 248, 'Uso'),
(140, 29, 4108.00, NULL, '2024-01-16 10:45:09', '2024-01-16 10:45:09', 250, 'Uso');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accesorios`
--
ALTER TABLE `accesorios`
  ADD CONSTRAINT `FK_accesorios_maquinariaId` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_accesorios_marcaId` FOREIGN KEY (`marcaId`) REFERENCES `marca` (`id`);

--
-- Filtros para la tabla `accesoriosDocs`
--
ALTER TABLE `accesoriosDocs`
  ADD CONSTRAINT `FK_accesoriosDocs_accesorioId` FOREIGN KEY (`accesorioId`) REFERENCES `accesorios` (`id`),
  ADD CONSTRAINT `FK_accesoriosDocs_tipoId` FOREIGN KEY (`tipoId`) REFERENCES `docs` (`id`);

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `FK_actividades_estadoId` FOREIGN KEY (`estadoId`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `FK_actividades_personalId` FOREIGN KEY (`personalId`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `FK_actividades_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `ajustesCisternas`
--
ALTER TABLE `ajustesCisternas`
  ADD CONSTRAINT `FK_ajustesCisternas_tipoCisternaId` FOREIGN KEY (`tipoCisternaId`) REFERENCES `cisternas` (`id`);

--
-- Filtros para la tabla `almacenServicios`
--
ALTER TABLE `almacenServicios`
  ADD CONSTRAINT `FK_almacenServicios_almacentiraderos` FOREIGN KEY (`almacenId`) REFERENCES `almacenTiraderos` (`id`),
  ADD CONSTRAINT `FK_almacenServicios_concepto` FOREIGN KEY (`conceptoId`) REFERENCES `conceptos` (`id`);

--
-- Filtros para la tabla `almacenTiraderos`
--
ALTER TABLE `almacenTiraderos`
  ADD CONSTRAINT `FK_almacenTiraderos_tipoAlmacenId` FOREIGN KEY (`tipoAlmacenId`) REFERENCES `tipoAlmacen` (`id`);

--
-- Filtros para la tabla `asignacionEquipo`
--
ALTER TABLE `asignacionEquipo`
  ADD CONSTRAINT `FK_asignacionEquipo_equipoId` FOREIGN KEY (`equipoId`) REFERENCES `tipoEquipo` (`id`),
  ADD CONSTRAINT `FK_asignacionEquipo_marcaId` FOREIGN KEY (`marcaId`) REFERENCES `marca` (`id`),
  ADD CONSTRAINT `FK_asignacionEquipo_personalId` FOREIGN KEY (`personalId`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `asignacionUniforme`
--
ALTER TABLE `asignacionUniforme`
  ADD CONSTRAINT `FK_asignacionUniforme_inventarioId` FOREIGN KEY (`inventarioId`) REFERENCES `inventario` (`id`),
  ADD CONSTRAINT `FK_asignacionUniforme_personalId` FOREIGN KEY (`personalId`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `FK_asistencia_asistenciaId` FOREIGN KEY (`asistenciaId`) REFERENCES `tipoAsistencia` (`id`),
  ADD CONSTRAINT `FK_asistencia_personalId` FOREIGN KEY (`personalId`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `beneficiario`
--
ALTER TABLE `beneficiario`
  ADD CONSTRAINT `FK_beneficiario_personalId` FOREIGN KEY (`personalId`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `bitacoras`
--
ALTER TABLE `bitacoras`
  ADD CONSTRAINT `FK_bitacoras_frecuencia` FOREIGN KEY (`frecuenciaId`) REFERENCES `frecuenciaEjecucion` (`id`);

--
-- Filtros para la tabla `bitacorasEquipos`
--
ALTER TABLE `bitacorasEquipos`
  ADD CONSTRAINT `FK_bitacoras_bitacoraId` FOREIGN KEY (`bitacoraId`) REFERENCES `bitacoras` (`id`),
  ADD CONSTRAINT `FK_bitacoras_maquinariaId` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`);

--
-- Filtros para la tabla `cajaChica`
--
ALTER TABLE `cajaChica`
  ADD CONSTRAINT `FK_cajachica_comprobanteId` FOREIGN KEY (`comprobanteId`) REFERENCES `comprobante` (`id`),
  ADD CONSTRAINT `FK_cajachica_concepto` FOREIGN KEY (`concepto`) REFERENCES `conceptos` (`id`),
  ADD CONSTRAINT `FK_cajachica_equipo` FOREIGN KEY (`equipo`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_cajachica_obra` FOREIGN KEY (`obra`) REFERENCES `obras` (`id`),
  ADD CONSTRAINT `FK_cajachica_personal` FOREIGN KEY (`personal`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `FK_cajachica_servicioTrasporteId` FOREIGN KEY (`servicioTrasporteId`) REFERENCES `serviciosTrasporte` (`id`);

--
-- Filtros para la tabla `calendarioPrincipal`
--
ALTER TABLE `calendarioPrincipal`
  ADD CONSTRAINT `FK_calendarioPrincipal_actividadesId` FOREIGN KEY (`actividadesId`) REFERENCES `actividades` (`id`),
  ADD CONSTRAINT `FK_calendarioPrincipal_estadoId` FOREIGN KEY (`estadoId`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `FK_calendarioPrincipal_eventoImportanteId` FOREIGN KEY (`eventoImportanteId`) REFERENCES `eventoImportante` (`id`),
  ADD CONSTRAINT `FK_calendarioPrincipal_mantenimientoId` FOREIGN KEY (`mantenimientoId`) REFERENCES `mantenimientos` (`id`),
  ADD CONSTRAINT `FK_calendarioPrincipal_maquinariaId` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_calendarioPrincipal_personalId` FOREIGN KEY (`personalId`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `FK_calendarioPrincipal_solicitudesId` FOREIGN KEY (`solicitudesId`) REFERENCES `solicitudes` (`id`),
  ADD CONSTRAINT `FK_calendarioPrincipal_tipoMantenimientoId` FOREIGN KEY (`tipoMantenimientoId`) REFERENCES `tipoMantenimiento` (`id`),
  ADD CONSTRAINT `FK_calendarioPrincipal_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `carga`
--
ALTER TABLE `carga`
  ADD CONSTRAINT `FK_carga_cisternas` FOREIGN KEY (`tipoCisternaId`) REFERENCES `cisternas` (`id`),
  ADD CONSTRAINT `FK_carga_maquinariaId` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_carga_operadorlId` FOREIGN KEY (`operadorId`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `FK_carga_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `checkList`
--
ALTER TABLE `checkList`
  ADD CONSTRAINT `FK_checkListBitacora` FOREIGN KEY (`bitacoraId`) REFERENCES `bitacoras` (`id`),
  ADD CONSTRAINT `FK_checkListMaquinaria` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_checkListUsuario` FOREIGN KEY (`usuarioId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `checkListRegistros`
--
ALTER TABLE `checkListRegistros`
  ADD CONSTRAINT `FK_checkListHistorico` FOREIGN KEY (`checkListId`) REFERENCES `checkList` (`id`),
  ADD CONSTRAINT `FK_checkListRegistrosBitacora` FOREIGN KEY (`bitacoraId`) REFERENCES `bitacoras` (`id`),
  ADD CONSTRAINT `FK_checkListRegistrosGrupo` FOREIGN KEY (`grupoId`) REFERENCES `grupo` (`id`),
  ADD CONSTRAINT `FK_checkListRegistrosMaquinaria` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_checkListRegistrosTarea` FOREIGN KEY (`tareaId`) REFERENCES `tarea` (`id`),
  ADD CONSTRAINT `FK_checkListRegistrosUsuario` FOREIGN KEY (`usuarioId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `conceptos`
--
ALTER TABLE `conceptos`
  ADD CONSTRAINT `FK_conceptos_tiposUnidadesId` FOREIGN KEY (`tiposUnidadesId`) REFERENCES `tiposUnidades` (`id`),
  ADD CONSTRAINT `FK_conceptos_unidadesSatId` FOREIGN KEY (`unidadesSatId`) REFERENCES `unidadesSat` (`id`);

--
-- Filtros para la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD CONSTRAINT `FK_contactos_personalId` FOREIGN KEY (`personalId`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `descarga`
--
ALTER TABLE `descarga`
  ADD CONSTRAINT `FK_descarga_cisternas` FOREIGN KEY (`tipoCisternaId`) REFERENCES `cisternas` (`id`),
  ADD CONSTRAINT `FK_descarga_clienteId` FOREIGN KEY (`clienteId`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `FK_descarga_descargaEnCargaDeToteId` FOREIGN KEY (`descargaEnCargaDeToteId`) REFERENCES `carga` (`id`),
  ADD CONSTRAINT `FK_descarga_maquinariaId` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_descarga_obraId` FOREIGN KEY (`obraId`) REFERENCES `obras` (`id`),
  ADD CONSTRAINT `FK_descarga_operadorlId` FOREIGN KEY (`operadorId`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `FK_descarga_receptorId` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_descarga_serviciolId` FOREIGN KEY (`operadorId`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `FK_descarga_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `descargaDetalle`
--
ALTER TABLE `descargaDetalle`
  ADD CONSTRAINT `FK_descarga` FOREIGN KEY (`descargaId`) REFERENCES `descarga` (`id`);

--
-- Filtros para la tabla `docs`
--
ALTER TABLE `docs`
  ADD CONSTRAINT `FK_docs_tipoId` FOREIGN KEY (`tipoId`) REFERENCES `tiposDocs` (`id`);

--
-- Filtros para la tabla `documentoSelladoMantenimiento`
--
ALTER TABLE `documentoSelladoMantenimiento`
  ADD CONSTRAINT `FK_documentoSelladoMantenimiento_mantenimiento` FOREIGN KEY (`mantenimientoId`) REFERENCES `mantenimientos` (`id`);

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `FK_equipo_personalId` FOREIGN KEY (`personalId`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `eventoImportante`
--
ALTER TABLE `eventoImportante`
  ADD CONSTRAINT `FK_tareas_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `FK_eventos_prioridadId` FOREIGN KEY (`prioridadId`) REFERENCES `prioridades` (`id`),
  ADD CONSTRAINT `FK_eventos_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `extintores`
--
ALTER TABLE `extintores`
  ADD CONSTRAINT `FK_extintores_lugarId` FOREIGN KEY (`lugarId`) REFERENCES `lugares` (`id`),
  ADD CONSTRAINT `FK_extintores_maquinariaId` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_extintores_ubicacionId` FOREIGN KEY (`ubicacionId`) REFERENCES `ubicaciones` (`id`);

--
-- Filtros para la tabla `facturaCliente`
--
ALTER TABLE `facturaCliente`
  ADD CONSTRAINT `FK_facturaCliente_clienteId` FOREIGN KEY (`clienteId`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `FK_facturaCliente_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `facturaProvedor`
--
ALTER TABLE `facturaProvedor`
  ADD CONSTRAINT `FK_facturaProvedor_provedorId` FOREIGN KEY (`provedorId`) REFERENCES `proveedor` (`id`),
  ADD CONSTRAINT `FK_facturaProvedor_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `fiscal`
--
ALTER TABLE `fiscal`
  ADD CONSTRAINT `FK_fiscal_personalId` FOREIGN KEY (`personalId`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `gastosMantenimiento`
--
ALTER TABLE `gastosMantenimiento`
  ADD CONSTRAINT `FK_gastosmantenimiento_manoObraId` FOREIGN KEY (`manoObraId`) REFERENCES `manoDeObra` (`id`),
  ADD CONSTRAINT `FK_gastosmantenimiento_mantenimientoId` FOREIGN KEY (`mantenimientoId`) REFERENCES `mantenimientos` (`id`),
  ADD CONSTRAINT `FK_gastosmantenimiento_productoId` FOREIGN KEY (`inventarioId`) REFERENCES `inventario` (`id`);

--
-- Filtros para la tabla `grupoBitacoras`
--
ALTER TABLE `grupoBitacoras`
  ADD CONSTRAINT `FK_grupoBitacora_bitacora` FOREIGN KEY (`bitacoraId`) REFERENCES `bitacoras` (`id`),
  ADD CONSTRAINT `FK_grupoBitacora_tarea` FOREIGN KEY (`grupoId`) REFERENCES `grupo` (`id`);

--
-- Filtros para la tabla `grupoTareas`
--
ALTER TABLE `grupoTareas`
  ADD CONSTRAINT `FK_grupo_grupo` FOREIGN KEY (`grupoId`) REFERENCES `grupo` (`id`),
  ADD CONSTRAINT `FK_grupo_tarea` FOREIGN KEY (`tareaId`) REFERENCES `tarea` (`id`);

--
-- Filtros para la tabla `historialServicios`
--
ALTER TABLE `historialServicios`
  ADD CONSTRAINT `FK_historialServicios_estadoId` FOREIGN KEY (`estadoId`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `FK_historialServicios_servicioId` FOREIGN KEY (`servicioId`) REFERENCES `servicios` (`id`),
  ADD CONSTRAINT `FK_historialServicios_solicitudId` FOREIGN KEY (`solicitudId`) REFERENCES `solicitudes` (`id`);

--
-- Filtros para la tabla `historicoMaquinaria`
--
ALTER TABLE `historicoMaquinaria`
  ADD CONSTRAINT `FK_historicoMaquinaria_maquinaria` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_historicoMaquinaria_obraDestino` FOREIGN KEY (`destinoId`) REFERENCES `obras` (`id`),
  ADD CONSTRAINT `FK_historicoMaquinaria_obraOrigen` FOREIGN KEY (`origenId`) REFERENCES `obras` (`id`);

--
-- Filtros para la tabla `invconsu`
--
ALTER TABLE `invconsu`
  ADD CONSTRAINT `FK_invconsu_desde` FOREIGN KEY (`desde`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_invconsu_hasta` FOREIGN KEY (`hasta`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_invconsu_producto` FOREIGN KEY (`productoId`) REFERENCES `inventario` (`id`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `FK_inventario_inventarioEstatusId` FOREIGN KEY (`estatusId`) REFERENCES `inventarioEstatus` (`id`),
  ADD CONSTRAINT `FK_inventario_marca` FOREIGN KEY (`marcaId`) REFERENCES `marca` (`id`),
  ADD CONSTRAINT `FK_inventario_proveedor` FOREIGN KEY (`proveedorId`) REFERENCES `proveedor` (`id`),
  ADD CONSTRAINT `FK_inventario_tipouniforme` FOREIGN KEY (`uniformeTipoId`) REFERENCES `tipoUniforme` (`id`);

--
-- Filtros para la tabla `inventarioMovimientos`
--
ALTER TABLE `inventarioMovimientos`
  ADD CONSTRAINT `FK_inventarioMovimiento_inventario` FOREIGN KEY (`inventarioId`) REFERENCES `inventario` (`id`),
  ADD CONSTRAINT `FK_inventarioMovimiento_mantenimiento` FOREIGN KEY (`mantenimientoId`) REFERENCES `mantenimientos` (`id`),
  ADD CONSTRAINT `FK_inventarioMovimiento_usuario` FOREIGN KEY (`usuarioId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `inventarioMovimientosMtq`
--
ALTER TABLE `inventarioMovimientosMtq`
  ADD CONSTRAINT `FK_inventarioMovimientosMtq_inventario` FOREIGN KEY (`inventarioId`) REFERENCES `inventarioMtq` (`id`),
  ADD CONSTRAINT `FK_inventarioMovimientosMtq_usuario` FOREIGN KEY (`usuarioId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `inventarioMtq`
--
ALTER TABLE `inventarioMtq`
  ADD CONSTRAINT `FK_inventarioMtq_marca` FOREIGN KEY (`marcaId`) REFERENCES `marca` (`id`),
  ADD CONSTRAINT `FK_inventarioMtq_proveedor` FOREIGN KEY (`proveedorId`) REFERENCES `proveedor` (`id`),
  ADD CONSTRAINT `FK_inventarioMtq_tipouniforme` FOREIGN KEY (`uniformeTipoId`) REFERENCES `tipoUniforme` (`id`);

--
-- Filtros para la tabla `lugares`
--
ALTER TABLE `lugares`
  ADD CONSTRAINT `FK_lugares_ubicacionId` FOREIGN KEY (`ubicacionId`) REFERENCES `ubicaciones` (`id`);

--
-- Filtros para la tabla `mantenimientoImagen`
--
ALTER TABLE `mantenimientoImagen`
  ADD CONSTRAINT `FK_mantenimientoImagen_mantenimientoId` FOREIGN KEY (`mantenimientoId`) REFERENCES `mantenimientos` (`id`),
  ADD CONSTRAINT `FK_mantenimientoImagen_maquinariaId` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`);

--
-- Filtros para la tabla `mantenimientos`
--
ALTER TABLE `mantenimientos`
  ADD CONSTRAINT `FK_mantenimiento_personalId` FOREIGN KEY (`personalId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_mantenimiento_tipoId` FOREIGN KEY (`tipoMantenimientoId`) REFERENCES `tipoMantenimiento` (`id`),
  ADD CONSTRAINT `FK_mantenimientos_estadoId` FOREIGN KEY (`estadoId`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `FK_mantenimientos_userId` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`);

--
-- Filtros para la tabla `maqacce`
--
ALTER TABLE `maqacce`
  ADD CONSTRAINT `FK_maqacce_accesorioId` FOREIGN KEY (`accesorioId`) REFERENCES `accesorios` (`id`),
  ADD CONSTRAINT `FK_maqacce_maquinariaId` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`);

--
-- Filtros para la tabla `maqdocs`
--
ALTER TABLE `maqdocs`
  ADD CONSTRAINT `FK_maqdocs_maquinariaId` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_maqdocs_tipoId` FOREIGN KEY (`tipoId`) REFERENCES `docs` (`id`);

--
-- Filtros para la tabla `maqimagen`
--
ALTER TABLE `maqimagen`
  ADD CONSTRAINT `FK_maqimagen_maquinariaId` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`);

--
-- Filtros para la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  ADD CONSTRAINT `FK_maquinaria_bitacoraId` FOREIGN KEY (`bitacoraId`) REFERENCES `bitacoras` (`id`),
  ADD CONSTRAINT `FK_maquinaria_categoriaId` FOREIGN KEY (`categoriaId`) REFERENCES `maquinariaCategoria` (`id`),
  ADD CONSTRAINT `FK_maquinaria_maquinariaEstatusId` FOREIGN KEY (`estatusId`) REFERENCES `maquinariaEstatus` (`id`),
  ADD CONSTRAINT `FK_maquinaria_marcaId` FOREIGN KEY (`marcaId`) REFERENCES `marca` (`id`),
  ADD CONSTRAINT `FK_maquinaria_tipoId` FOREIGN KEY (`tipoId`) REFERENCES `maquinariaTipo` (`id`);

--
-- Filtros para la tabla `marcasTipo`
--
ALTER TABLE `marcasTipo`
  ADD CONSTRAINT `FK_marcasTipo_marca_id` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`id`),
  ADD CONSTRAINT `FK_marcasTipo_tipos_marcas_id` FOREIGN KEY (`tipos_marcas_id`) REFERENCES `tiposMarcas` (`id`);

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `mtqEventos`
--
ALTER TABLE `mtqEventos`
  ADD CONSTRAINT `FK_mtqEventos_maquinariaId` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`);

--
-- Filtros para la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD CONSTRAINT `FK_nomina_jefeId` FOREIGN KEY (`jefeId`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `FK_nomina_personalId` FOREIGN KEY (`personalId`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `FK_nomina_puestoId` FOREIGN KEY (`puestoId`) REFERENCES `puesto` (`id`);

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `FK_notificaciones_userId` FOREIGN KEY (`personalId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `obraMaqPer`
--
ALTER TABLE `obraMaqPer`
  ADD CONSTRAINT `FK_obraMaqPer_maquinaria` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_obraMaqPer_obras` FOREIGN KEY (`obraId`) REFERENCES `obras` (`id`),
  ADD CONSTRAINT `FK_obraMaqPer_persona` FOREIGN KEY (`personalId`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `obraMaqPerHistorico`
--
ALTER TABLE `obraMaqPerHistorico`
  ADD CONSTRAINT `FK_obraMaqPerHistorico_maquinaria` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_obraMaqPerHistorico_obras` FOREIGN KEY (`obraId`) REFERENCES `obras` (`id`),
  ADD CONSTRAINT `FK_obraMaqPerHistorico_persona` FOREIGN KEY (`personalId`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `FK_obraMaqPerHistorico_usuario` FOREIGN KEY (`usuarioId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `obras`
--
ALTER TABLE `obras`
  ADD CONSTRAINT `FK_obras_cliente` FOREIGN KEY (`clienteId`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `obrasServicios`
--
ALTER TABLE `obrasServicios`
  ADD CONSTRAINT `FK_obrasServicios_concepto` FOREIGN KEY (`conceptoId`) REFERENCES `conceptos` (`id`),
  ADD CONSTRAINT `FK_obrasServicios_obra` FOREIGN KEY (`obraId`) REFERENCES `obras` (`id`);

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `FK_personal_puestoId` FOREIGN KEY (`puestoId`) REFERENCES `puesto` (`id`),
  ADD CONSTRAINT `FK_personal_puestoNivelId` FOREIGN KEY (`puestoNivelId`) REFERENCES `puestoNivel` (`id`),
  ADD CONSTRAINT `FK_personal_userEstatusId` FOREIGN KEY (`estatusId`) REFERENCES `userEstatus` (`id`),
  ADD CONSTRAINT `FK_personal_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `programacionCheckLists`
--
ALTER TABLE `programacionCheckLists`
  ADD CONSTRAINT `FK_programacionCheckLists_bitacoraId` FOREIGN KEY (`bitacoraId`) REFERENCES `bitacoras` (`id`),
  ADD CONSTRAINT `FK_programacionCheckLists_checkListId` FOREIGN KEY (`checkListId`) REFERENCES `checkList` (`id`),
  ADD CONSTRAINT `FK_programacionCheckLists_maquinariaId` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_programacionCheckLists_personalId` FOREIGN KEY (`personalId`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `provedorCategorias`
--
ALTER TABLE `provedorCategorias`
  ADD CONSTRAINT `FK_provedorCategorias_categoriaId` FOREIGN KEY (`proveedor_categoria_id`) REFERENCES `proveedorCategoria` (`id`),
  ADD CONSTRAINT `FK_provedorCategorias_proveedorId` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`);

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `FK_proveedor_categoria` FOREIGN KEY (`categoriaId`) REFERENCES `proveedorCategoria` (`id`);

--
-- Filtros para la tabla `proveedorContactos`
--
ALTER TABLE `proveedorContactos`
  ADD CONSTRAINT `FK_proveedorContactos_proveedor` FOREIGN KEY (`proveedorId`) REFERENCES `proveedor` (`id`);

--
-- Filtros para la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD CONSTRAINT `FK_puesto_puestoNivelId` FOREIGN KEY (`puestoNivelId`) REFERENCES `puestoNivel` (`id`);

--
-- Filtros para la tabla `refacciones`
--
ALTER TABLE `refacciones`
  ADD CONSTRAINT `FK_refacciones_inventario` FOREIGN KEY (`relacionInventarioId`) REFERENCES `inventario` (`id`),
  ADD CONSTRAINT `FK_refacciones_maquinaria` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_refacciones_marca` FOREIGN KEY (`marcaId`) REFERENCES `marca` (`id`),
  ADD CONSTRAINT `FK_refacciones_tipo` FOREIGN KEY (`tipoRefaccionId`) REFERENCES `refaccionTipo` (`id`);

--
-- Filtros para la tabla `residente`
--
ALTER TABLE `residente`
  ADD CONSTRAINT `FK_residente_autoId` FOREIGN KEY (`autoId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_residente_clienteId` FOREIGN KEY (`clienteId`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `FK_residente_obraId` FOREIGN KEY (`obraId`) REFERENCES `obras` (`id`),
  ADD CONSTRAINT `FK_residente_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `residenteAutos`
--
ALTER TABLE `residenteAutos`
  ADD CONSTRAINT `FK_maqdocs_autoId` FOREIGN KEY (`autoId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_maqdocs_residenteId` FOREIGN KEY (`residenteId`) REFERENCES `residente` (`id`);

--
-- Filtros para la tabla `restock`
--
ALTER TABLE `restock`
  ADD CONSTRAINT `FK_inventario_producto` FOREIGN KEY (`productoId`) REFERENCES `inventario` (`id`);

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `FK_servicios_estadoId` FOREIGN KEY (`estadoId`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `FK_servicios_maquinariaId` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_servicios_prioridadId` FOREIGN KEY (`prioridadId`) REFERENCES `prioridades` (`id`),
  ADD CONSTRAINT `FK_servicios_reparacionId` FOREIGN KEY (`reparacionId`) REFERENCES `reparaciones` (`id`),
  ADD CONSTRAINT `FK_servicios_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `serviciosTrasporte`
--
ALTER TABLE `serviciosTrasporte`
  ADD CONSTRAINT `FK_ServiciosTrasporte_almacenId` FOREIGN KEY (`almacenId`) REFERENCES `almacenTiraderos` (`id`),
  ADD CONSTRAINT `FK_ServiciosTrasporte_conceptoId` FOREIGN KEY (`conceptoId`) REFERENCES `conceptos` (`id`),
  ADD CONSTRAINT `FK_ServiciosTrasporte_equipoId` FOREIGN KEY (`equipoId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_ServiciosTrasporte_obraId` FOREIGN KEY (`obraId`) REFERENCES `obras` (`id`),
  ADD CONSTRAINT `FK_ServiciosTrasporte_personalId` FOREIGN KEY (`personalId`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `solicitudDetalle`
--
ALTER TABLE `solicitudDetalle`
  ADD CONSTRAINT `FK_solicitudDetalle_inventarioId` FOREIGN KEY (`inventarioId`) REFERENCES `inventario` (`id`),
  ADD CONSTRAINT `FK_solicitudDetalle_solicitudId` FOREIGN KEY (`solicitudId`) REFERENCES `solicitudes` (`id`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `FK_solicitudes_estadoId` FOREIGN KEY (`estadoId`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `FK_solicitudes_maquinariaId` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_solicitudes_personalId` FOREIGN KEY (`personalId`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `FK_solicitudes_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `solicitudesListas`
--
ALTER TABLE `solicitudesListas`
  ADD CONSTRAINT `FK_solicitudesListas_inventarioId` FOREIGN KEY (`inventarioId`) REFERENCES `maquinaria` (`id`),
  ADD CONSTRAINT `FK_solicitudesListas_solicitudId` FOREIGN KEY (`solicitudId`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD CONSTRAINT `FK_tarea_categoria` FOREIGN KEY (`categoriaId`) REFERENCES `tareaCategoria` (`id`),
  ADD CONSTRAINT `FK_tarea_tipo` FOREIGN KEY (`tipoId`) REFERENCES `tareaTipo` (`id`),
  ADD CONSTRAINT `FK_tarea_ubicacion` FOREIGN KEY (`ubicacionId`) REFERENCES `tareaUbicacion` (`id`);

--
-- Filtros para la tabla `userdocs`
--
ALTER TABLE `userdocs`
  ADD CONSTRAINT `FK_userdocs_personalId` FOREIGN KEY (`personalId`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `FK_userdocs_tipoId` FOREIGN KEY (`tipoId`) REFERENCES `docs` (`id`);

--
-- Filtros para la tabla `usoMaquinarias`
--
ALTER TABLE `usoMaquinarias`
  ADD CONSTRAINT `FK_usoMaquinarias_maquinariaId` FOREIGN KEY (`maquinariaId`) REFERENCES `maquinaria` (`id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
