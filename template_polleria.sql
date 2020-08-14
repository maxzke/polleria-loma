-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-03-2020 a las 22:44:36
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `template_polleria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `precio_vivo` decimal(9,2) NOT NULL,
  `precio_alinado` decimal(9,2) NOT NULL,
  `precio_procesado` decimal(9,2) NOT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `precio_vivo`, `precio_alinado`, `precio_procesado`, `telefono`) VALUES
(17, 'Alexander Martinez', '22.00', '0.00', '0.00', '2811001564'),
(18, 'Carlos Nieto', '22.80', '0.00', '0.00', ''),
(19, 'Mayoreo', '27.50', '0.00', '0.00', ''),
(20, 'Menudeo', '29.50', '0.00', '0.00', ''),
(21, 'Medio Mayoreo', '28.50', '0.00', '0.00', ''),
(22, 'Sara Reyes', '27.50', '0.00', '0.00', ''),
(23, 'Jorge melendez (coqui)', '23.00', '0.00', '0.00', ''),
(24, 'Uriel Avila ', '22.70', '0.00', '0.00', ''),
(25, 'Miguel Soto', '23.00', '0.00', '0.00', ''),
(26, 'Antonio Noriega', '22.30', '0.00', '0.00', ''),
(27, 'Miguel A. Charis', '23.00', '0.00', '0.00', ''),
(28, 'Renato Morales', '26.50', '29.00', '0.00', ''),
(29, 'Jorge Rumualdo', '26.50', '0.00', '0.00', ''),
(30, 'Sandra Ma. Joachin', '26.50', '0.00', '0.00', ''),
(31, 'Rufina Guadalupe (R. CHACA)', '23.00', '0.00', '0.00', ''),
(32, 'Eduardo Cruz', '22.80', '0.00', '0.00', ''),
(33, 'Fermin Tadeo', '22.50', '0.00', '0.00', ''),
(34, 'Luis Muñoz', '23.00', '0.00', '0.00', ''),
(35, 'Octavio Fuentes', '28.50', '0.00', '0.00', ''),
(36, 'Alexander Ascanio', '23.50', '27.50', '0.00', '2871430688'),
(37, 'Jose Ing. Lopez', '0.00', '0.00', '0.00', ''),
(38, 'Julio Dominguez', '22.80', '0.00', '0.00', ''),
(39, 'Ruta1 Erick', '0.00', '31.00', '0.00', ''),
(41, 'Anuar (Remache)', '0.00', '29.00', '0.00', ''),
(42, 'Tlacojalpan', '0.00', '29.00', '0.00', ''),
(43, 'Chucho Morales', '0.00', '29.00', '0.00', ''),
(44, 'Restaurantes', '0.00', '32.00', '0.00', ''),
(45, 'Luis Cotera', '0.00', '32.00', '0.00', ''),
(46, 'Facha Vidaña', '0.00', '29.00', '0.00', ''),
(47, 'Celina Diaz', '0.00', '29.00', '0.00', ''),
(49, 'Juan Diego', '0.00', '28.00', '0.00', ''),
(50, 'Tony Mota', '0.00', '28.00', '0.00', ''),
(51, 'Tania Muñoz', '0.00', '28.00', '0.00', ''),
(52, 'Entero', '0.00', '33.00', '0.00', ''),
(53, 'Luis Felipe', '0.00', '28.00', '0.00', '2818792989'),
(54, 'Alfredo Cruz', '0.00', '28.00', '0.00', ''),
(55, 'Piedad Pita', '0.00', '0.00', '35.00', '2811129551'),
(56, 'Nancy Pita', '0.00', '0.00', '35.00', '2818795944'),
(57, 'Vicente Pineda', '0.00', '0.00', '37.00', '2811027231'),
(59, 'Antonio Palacios', '0.00', '0.00', '39.00', '2811014816'),
(60, 'Jorge Ramirez', '0.00', '0.00', '39.00', ''),
(61, 'Hector Zuccolotto', '0.00', '0.00', '39.00', '2818790098'),
(62, 'Andres de Puerto', '0.00', '0.00', '41.50', ''),
(63, 'Toñito', '0.00', '0.00', '41.50', ''),
(64, 'Pollo Jardin', '0.00', '0.00', '40.00', ''),
(65, 'Alicia Sanchez Cruz', '0.00', '0.00', '40.00', '2811130814'),
(66, 'Alicia Alvarez', '0.00', '0.00', '40.00', '2831323080'),
(67, 'Gregorio Garcia', '0.00', '0.00', '39.00', '2831205755'),
(68, 'Dolores Condado', '0.00', '0.00', '42.00', '2831216565'),
(69, 'Jairo Ortiz', '0.00', '0.00', '39.00', '2831202389'),
(70, 'Esther Gamboa', '0.00', '0.00', '40.50', '2818703477'),
(71, 'Oyuki Miranda ', '0.00', '0.00', '39.00', '2818709110'),
(72, 'Lenny Tuxtilla ', '27.50', '0.00', '41.00', '2881160876'),
(73, 'Publico', '0.00', '0.00', '41.00', ''),
(74, 'X Caja', '0.00', '0.00', '40.00', ''),
(75, 'Antonio Solano (R.CHACA)', '0.00', '0.00', '39.00', ''),
(76, 'Felipe Campechano', '0.00', '0.00', '40.00', ''),
(77, 'Isaias Uscanga', '0.00', '28.00', '0.00', ''),
(78, 'Gamez', '0.00', '28.00', '0.00', ''),
(79, 'adela de la o', '0.00', '0.00', '39.00', ''),
(80, 'roberto pineda', '0.00', '0.00', '40.50', ''),
(81, 'Vicente Condado', '0.00', '0.00', '41.00', ''),
(82, 'Cecilia Pacheco', '0.00', '31.00', '0.00', ''),
(83, 'Catalina Mazaba', '28.00', '0.00', '43.00', ''),
(84, 'Ruta azueta', '26.00', '34.00', '0.00', ''),
(85, 'vicky wera', '0.00', '0.00', '43.00', ''),
(86, 'Maria del Carmen Morales', '0.00', '0.00', '43.00', ''),
(87, 'Rosa Rodriguez', '0.00', '0.00', '43.00', ''),
(88, 'Pollo frio', '0.00', '30.00', '0.00', ''),
(89, 'Pollo Surtido', '0.00', '36.00', '0.00', ''),
(90, 'Fidel', '26.00', '0.00', '0.00', ''),
(91, 'restaurante camionero', '0.00', '0.00', '43.00', ''),
(92, 'angela contreras', '0.00', '0.00', '0.00', ''),
(93, 'empleados', '0.00', '36.00', '0.00', ''),
(94, 'Minerva Morales RRC', '0.00', '0.00', '0.00', ''),
(95, 'HERMILA PEREZ RRC', '0.00', '0.00', '0.00', ''),
(96, 'Elia Salamanca RRC', '0.00', '0.00', '0.00', ''),
(97, 'Veronica Juarez RRC', '0.00', '0.00', '0.00', ''),
(98, 'Isabel Santos RRC', '0.00', '0.00', '0.00', ''),
(99, 'Atanacio Arroyo RRC', '0.00', '0.00', '0.00', ''),
(100, 'Hermila Martinez RRC', '0.00', '0.00', '0.00', ''),
(101, 'Roxana Rodriguez RRC', '0.00', '0.00', '0.00', ''),
(102, 'Maria del Carmen RRC', '0.00', '0.00', '0.00', ''),
(103, 'Benita del Valle RRC', '0.00', '0.00', '0.00', ''),
(104, 'Irma Gomez RRC', '0.00', '0.00', '0.00', ''),
(105, 'Adela Cardenas RRC', '0.00', '0.00', '0.00', ''),
(106, 'Maria Lagunez Hernandez RRC', '0.00', '0.00', '0.00', ''),
(107, 'Salome Cortez RRC', '0.00', '0.00', '0.00', ''),
(108, 'Yeni Reyes RMYSB', '0.00', '0.00', '0.00', ''),
(109, 'Yesenia Santiago RMYSB', '0.00', '0.00', '0.00', ''),
(110, 'Jovita Estrada RMYSB', '0.00', '0.00', '0.00', ''),
(111, 'Raquel Reyes RMYSB', '0.00', '0.00', '0.00', ''),
(112, 'Claudia Martinez RMYSB', '0.00', '0.00', '0.00', ''),
(113, 'Sebastian Ortiz  RMYSB', '0.00', '0.00', '0.00', ''),
(114, 'Pascual Ramirez RMYSB', '0.00', '0.00', '0.00', ''),
(115, 'Margarita Soriano RMYSB', '0.00', '0.00', '43.00', ''),
(116, 'Anastacio Reyes RMYSB', '0.00', '0.00', '0.00', ''),
(117, 'Cecilia Manzano RMYSB', '0.00', '0.00', '0.00', ''),
(118, 'Victoria Ortiz RMYSB', '0.00', '0.00', '0.00', ''),
(119, 'Margarita Mendez RMYSB', '0.00', '0.00', '0.00', ''),
(120, 'Reyna Maldonado RMYSB', '0.00', '0.00', '43.00', ''),
(121, 'Cliceria Auli RM', '0.00', '0.00', '0.00', ''),
(122, 'Alma Rosa RM', '0.00', '0.00', '0.00', ''),
(123, 'Teresa Benitez RM', '0.00', '0.00', '0.00', ''),
(124, 'Estilica Carlos RM', '0.00', '0.00', '0.00', ''),
(125, 'Margarita Prieto RM', '0.00', '0.00', '0.00', ''),
(126, 'Judith Ocampo RM', '0.00', '0.00', '0.00', ''),
(127, 'Honoria Parra RM', '0.00', '0.00', '0.00', ''),
(128, 'Miguelina Juarez RM', '0.00', '0.00', '0.00', ''),
(129, 'Sofia Cordoba RM', '0.00', '0.00', '0.00', ''),
(130, 'Angelica Valverde RM', '0.00', '0.00', '0.00', ''),
(131, 'Edith Zagada RM', '0.00', '0.00', '0.00', ''),
(132, 'Reyna VAldez RM', '0.00', '0.00', '0.00', ''),
(133, 'JR Bonola RLL', '0.00', '0.00', '0.00', ''),
(134, 'Luz Maria Palacios RLL', '0.00', '0.00', '0.00', ''),
(135, 'Olga Arrioja RLL', '0.00', '0.00', '0.00', ''),
(136, 'Azucena Palacios RLL', '0.00', '0.00', '0.00', ''),
(137, 'Leticia Chalate RLL', '0.00', '0.00', '0.00', ''),
(138, 'Juana Pestaña RLL', '0.00', '0.00', '0.00', ''),
(139, 'Marisol Lopez RLL', '0.00', '0.00', '0.00', ''),
(140, 'Rosa Carbajal RLL', '0.00', '0.00', '0.00', ''),
(141, 'Ilsia Qiahua RLL', '0.00', '0.00', '0.00', ''),
(142, 'Marina Delgada RLL', '0.00', '0.00', '0.00', ''),
(143, 'Eusebia Rodriguez RLL', '27.00', '0.00', '0.00', ''),
(144, 'Maximo Murillo RLL', '0.00', '0.00', '0.00', ''),
(145, 'Maria Isidra F RLL', '0.00', '0.00', '0.00', ''),
(146, 'Angela Balderas RLL ', '0.00', '0.00', '0.00', ''),
(147, 'Alberta Chontal RLL ', '0.00', '0.00', '0.00', ''),
(148, 'Juana Ostos RLL', '0.00', '0.00', '0.00', ''),
(149, 'Minerva Poxtan RLL', '0.00', '0.00', '0.00', ''),
(150, 'Rubi Pucheta RLL', '0.00', '0.00', '0.00', ''),
(151, 'Leticia Portela RLL', '0.00', '0.00', '0.00', ''),
(152, 'Alicia Romero RLL', '0.00', '0.00', '0.00', ''),
(153, 'Bianca NP RLL', '0.00', '0.00', '0.00', ''),
(154, 'Agueda Martinez RLL', '0.00', '0.00', '0.00', ''),
(155, 'Margarito Garcia s RLL', '0.00', '0.00', '0.00', ''),
(156, 'RODOLFO MORALES RAMIREZ', '0.00', '0.00', '37.00', ''),
(157, 'PROGOMEX', '0.00', '0.00', '0.00', ''),
(158, 'SEMILLERO', '0.00', '0.00', '0.00', ''),
(159, 'BERTHA LOPEZ (RA)', '0.00', '0.00', '0.00', ''),
(160, 'GUADALUPE JUANEZ (RA)', '0.00', '0.00', '0.00', ''),
(161, 'ROSALIA LOPEZ (RA)', '0.00', '0.00', '0.00', ''),
(162, 'NOE ORTIZ (RA)', '0.00', '0.00', '0.00', ''),
(163, 'RAFAELA AGUILAR (RA)', '0.00', '0.00', '0.00', ''),
(164, 'REYNA SANCHEZ (RA)', '0.00', '0.00', '0.00', ''),
(165, 'JULIA S (RA)', '0.00', '0.00', '0.00', ''),
(166, 'ALEX ZORNOZA (RA)', '0.00', '0.00', '0.00', ''),
(167, 'RUBISAY (RA)', '0.00', '0.00', '0.00', ''),
(168, 'TERESA CASTRO (RA)', '0.00', '32.00', '0.00', ''),
(169, 'LORENZA L (RA)', '0.00', '0.00', '0.00', ''),
(170, 'JUAN CASTRO (RA)', '0.00', '0.00', '42.00', ''),
(171, 'JULIA PRIETO (RA)', '0.00', '0.00', '0.00', ''),
(172, 'DOMINGO REYES (RA)', '0.00', '0.00', '0.00', ''),
(173, 'RENATO JACOME (RA)', '0.00', '0.00', '0.00', ''),
(174, 'LOURDES CONDADO (RA)', '0.00', '0.00', '0.00', ''),
(175, 'MONICA ARAU (RA)', '0.00', '0.00', '0.00', ''),
(176, 'casa-venta', '0.00', '40.00', '0.00', ''),
(177, 'Amalia Castro (R.CHACA)', '0.00', '0.00', '0.00', ''),
(178, 'Hilda Parroquin (R.CHACA)', '0.00', '0.00', '0.00', ''),
(179, 'Aide Jacome (R.Chaca)', '0.00', '0.00', '0.00', ''),
(180, 'Hugo Peña (R.CHACA)', '0.00', '0.00', '0.00', ''),
(181, 'GUADALUPE PAREDES (R.CHACA)', '0.00', '0.00', '0.00', ''),
(182, 'GLADY GONZALEZ (R.CHACA)', '0.00', '0.00', '0.00', ''),
(183, 'ROSARIO SIERRA (R.CHACA)', '0.00', '0.00', '0.00', ''),
(184, 'FREDDY ARRIOJA (R.CHACA)', '0.00', '0.00', '0.00', ''),
(185, 'MARIA LUISA CASTRO (R.CHACA)', '0.00', '0.00', '0.00', ''),
(186, 'DULCE (R.CHACA)', '0.00', '0.00', '0.00', ''),
(187, 'ERICK REYES (R.CHACA)', '24.50', '0.00', '0.00', ''),
(188, 'santa monica', '0.00', '0.00', '0.00', ''),
(189, 'Bertha Hernandez (RA)', '0.00', '0.00', '43.00', ''),
(190, 'ANA MARIA ALVAREZ (RA)', '0.00', '0.00', '43.00', ''),
(191, 'JOSE ISLAS', '23.80', '0.00', '0.00', ''),
(192, 'Ruta2 Erick', '0.00', '32.00', '0.00', ''),
(193, 'Leonor Carbajal (RRC)', '22.00', '0.00', '0.00', ''),
(195, 'cliente temporal', '15.00', '15.00', '15.00', '2818721150'),
(196, 'luis garcia', '28.00', '0.00', '0.00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_efectivo_caja`
--

DROP TABLE IF EXISTS `entrada_efectivo_caja`;
CREATE TABLE IF NOT EXISTS `entrada_efectivo_caja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `importe` decimal(9,2) NOT NULL,
  `fecha` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `entrada_efectivo_caja`
--

INSERT INTO `entrada_efectivo_caja` (`id`, `importe`, `fecha`, `usuario`) VALUES
(66, '1146.00', '27-03-2020 07:42:15', 'admin'),
(65, '1290.00', '26-03-2020 09:26:39', 'admin'),
(63, '1069.00', '25-03-2020 12:24:17', 'admin'),
(62, '0.00', '24-03-2020 16:16:30', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_stock_procesado`
--

DROP TABLE IF EXISTS `entrada_stock_procesado`;
CREATE TABLE IF NOT EXISTS `entrada_stock_procesado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_interno` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `kilos` decimal(9,3) NOT NULL,
  `lote` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` decimal(9,2) NOT NULL,
  `status` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `stock_cantidad` decimal(9,2) NOT NULL,
  `stock_kilos` decimal(9,3) NOT NULL,
  `fecha` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(90) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_stock_vivo`
--

DROP TABLE IF EXISTS `entrada_stock_vivo`;
CREATE TABLE IF NOT EXISTS `entrada_stock_vivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` decimal(9,2) NOT NULL,
  `usuario` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `entrada_stock_vivo`
--

INSERT INTO `entrada_stock_vivo` (`id`, `cantidad`, `usuario`, `fecha`) VALUES
(12, '1644.00', 'admin', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formas_de_pago`
--

DROP TABLE IF EXISTS `formas_de_pago`;
CREATE TABLE IF NOT EXISTS `formas_de_pago` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `formas_de_pago`
--

INSERT INTO `formas_de_pago` (`id`, `nombre`) VALUES
(1, 'efectivo'),
(2, 'cheque'),
(3, 'transferencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_diarios`
--

DROP TABLE IF EXISTS `gastos_diarios`;
CREATE TABLE IF NOT EXISTS `gastos_diarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `importe` decimal(9,2) NOT NULL,
  `fecha` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario` varchar(90) COLLATE utf8mb4_spanish_ci NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `gastos_diarios`
--

INSERT INTO `gastos_diarios` (`id`, `descripcion`, `importe`, `fecha`, `usuario`, `status`) VALUES
(1, 'nissan bca', '42.00', '27-03-2020 08:24:20', 'admin', 'ok');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs_procesado`
--

DROP TABLE IF EXISTS `logs_procesado`;
CREATE TABLE IF NOT EXISTS `logs_procesado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(30) NOT NULL,
  `info_codigo` varchar(10) NOT NULL,
  `user` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs_vivo`
--

DROP TABLE IF EXISTS `logs_vivo`;
CREATE TABLE IF NOT EXISTS `logs_vivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `user` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pollo_ahogado`
--

DROP TABLE IF EXISTS `pollo_ahogado`;
CREATE TABLE IF NOT EXISTS `pollo_ahogado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pollo_ahogado`
--

INSERT INTO `pollo_ahogado` (`id`, `cantidad`, `fecha`, `usuario`) VALUES
(1, 4, '2020-03-27 00:00:00', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pollo_descompuesto`
--

DROP TABLE IF EXISTS `pollo_descompuesto`;
CREATE TABLE IF NOT EXISTS `pollo_descompuesto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `kilos` decimal(9,2) NOT NULL,
  `usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saldo_atrasado`
--

DROP TABLE IF EXISTS `saldo_atrasado`;
CREATE TABLE IF NOT EXISTS `saldo_atrasado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `importe` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_venta`
--

DROP TABLE IF EXISTS `status_venta`;
CREATE TABLE IF NOT EXISTS `status_venta` (
  `id` int(11) NOT NULL,
  `nombre` varchar(90) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `status_venta`
--

INSERT INTO `status_venta` (`id`, `nombre`) VALUES
(1, 'debe'),
(2, 'pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_vivo`
--

DROP TABLE IF EXISTS `stock_vivo`;
CREATE TABLE IF NOT EXISTS `stock_vivo` (
  `id` int(11) NOT NULL COMMENT 'Siempre inicia en 1 uno',
  `cantidad` decimal(9,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `stock_vivo`
--

INSERT INTO `stock_vivo` (`id`, `cantidad`) VALUES
(1, '1252.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(175) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `reset_password_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `department_id`, `role_id`, `reset_password_code`, `created_at`) VALUES
(28, 'admin', 'correo', '$2y$10$7.aFaFHwt6NuRgh3iAQn/uLnAZeMtxrs0N4zV7GBxJp8jsq4/0MwO', '', '', NULL, 18, NULL, '2019-10-11 20:44:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_sessions`
--

DROP TABLE IF EXISTS `user_sessions`;
CREATE TABLE IF NOT EXISTS `user_sessions` (
  `id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `fecha` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `cliente-venta` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `id_cliente`, `status`, `usuario`, `fecha`, `created_at`) VALUES
(44, 17, 'pagado', 'admin', '26/03/2020', '2020-03-26 15:18:20'),
(46, 23, 'debe', 'admin', '27/03/2020', '2020-03-27 07:47:02'),
(47, 73, 'pagado', 'admin', '27/03/2020', '2020-03-27 07:51:56'),
(49, 23, 'debe', 'admin', '27/03/2020', '2020-03-27 08:18:09'),
(50, 24, 'debe', 'admin', '27/03/2020', '2020-03-27 10:05:28'),
(51, 22, 'debe', 'admin', '27/03/2020', '2020-03-27 10:06:26'),
(52, 30, 'debe', 'admin', '27/03/2020', '2020-03-27 10:08:13'),
(53, 196, 'debe', 'admin', '27/03/2020', '2020-03-27 10:08:59'),
(54, 34, 'debe', 'admin', '27/03/2020', '2020-03-27 10:13:07'),
(55, 34, 'pagado', 'admin', '27/03/2020', '2020-03-27 10:13:38'),
(56, 38, 'pagado', 'admin', '27/03/2020', '2020-03-27 10:21:10'),
(57, 191, 'pagado', 'admin', '27/03/2020', '2020-03-27 10:22:55'),
(58, 29, 'debe', 'admin', '27/03/2020', '2020-03-27 10:23:56'),
(59, 26, 'pagado', 'admin', '27/03/2020', '2020-03-27 10:27:02'),
(60, 25, 'debe', 'admin', '27/03/2020', '2020-03-27 10:30:57'),
(61, 18, 'pagado', 'admin', '27/03/2020', '2020-03-27 10:35:38'),
(62, 23, 'pagado', 'admin', '27/03/2020', '2020-03-27 10:36:25'),
(63, 24, 'debe', 'admin', '27/03/2020', '2020-03-27 10:37:43'),
(64, 24, 'debe', 'admin', '27/03/2020', '2020-03-27 10:39:22'),
(65, 24, 'debe', 'admin', '27/03/2020', '2020-03-27 10:41:34'),
(66, 196, 'debe', 'admin', '27/03/2020', '2020-03-27 10:42:26'),
(67, 46, 'debe', 'admin', '27/03/2020', '2020-03-27 10:44:49'),
(68, 47, 'debe', 'admin', '27/03/2020', '2020-03-27 10:52:47'),
(69, 51, 'debe', 'admin', '27/03/2020', '2020-03-27 10:56:10'),
(70, 28, 'debe', 'admin', '27/03/2020', '2020-03-27 10:57:36'),
(71, 41, 'debe', 'admin', '27/03/2020', '2020-03-27 10:58:12'),
(72, 78, 'pagado', 'admin', '27/03/2020', '2020-03-27 11:00:45'),
(73, 77, 'debe', 'admin', '27/03/2020', '2020-03-27 11:09:34'),
(74, 45, 'debe', 'admin', '27/03/2020', '2020-03-27 11:10:18'),
(75, 188, 'debe', 'admin', '27/03/2020', '2020-03-27 11:12:37'),
(76, 85, 'debe', 'admin', '27/03/2020', '2020-03-27 11:21:06'),
(77, 54, 'debe', 'admin', '27/03/2020', '2020-03-27 11:32:01'),
(78, 28, 'pagado', 'admin', '27/03/2020', '2020-03-27 11:35:04'),
(79, 44, 'pagado', 'admin', '27/03/2020', '2020-03-27 11:36:32'),
(80, 195, 'debe', 'admin', '27/03/2020', '2020-03-27 13:16:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalles`
--

DROP TABLE IF EXISTS `ventas_detalles`;
CREATE TABLE IF NOT EXISTS `ventas_detalles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `codigo` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `producto` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` decimal(9,2) NOT NULL,
  `kilos` decimal(9,2) NOT NULL,
  `precio` decimal(9,2) NOT NULL,
  `importe` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `venta-detalles` (`id_venta`)
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `ventas_detalles`
--

INSERT INTO `ventas_detalles` (`id`, `id_venta`, `codigo`, `producto`, `cantidad`, `kilos`, `precio`, `importe`) VALUES
(142, 44, 'h3Z6AqMqx8jOBPGVQG0au9nXg', 'VIVO', '2.00', '6.00', '28.00', '168.00'),
(143, 44, 'ucc7deVPoXiaQgKkUc38Ad6Pv', 'SERV. DESPLUMADO', '2.00', '2.00', '2.00', '4.00'),
(145, 46, 'R7j4h6LbmZkw4HZ737Y8VPHMr', 'SALDO ATRASADO', '1.00', '1.00', '5336.40', '5336.40'),
(146, 47, '0QW0Ezsy9Fg4S5yga1lLvOksF', 'ALIÑADO', '2.00', '5.60', '40.00', '224.00'),
(149, 49, '3bzcAKtCepp48F8vdsClSpxcf', 'VIVO', '25.00', '78.00', '28.00', '2184.00'),
(150, 49, '7IJweUKWWhB0hYm1R57OYjhoP', 'DESPLUMADO', '25.00', '25.00', '2.00', '50.00'),
(151, 50, 'JGc52bRB7Bj0P1RgfS7ptFRZU', 'VIVO', '10.00', '34.90', '28.00', '977.20'),
(152, 50, '6zojFLt0eU17k4U1XlACfbF2e', 'DESPLUMADO', '10.00', '10.00', '2.00', '20.00'),
(153, 51, 'mFvuYceAaLfSkW3iRyjwmzJjR', 'VIVO', '4.00', '13.50', '31.00', '418.50'),
(154, 51, 'Pd9TsRYb1WYyF8CR7p4IM4uYL', 'DESPLUMADO', '4.00', '4.00', '2.00', '8.00'),
(155, 52, '552MAENpCj2FeGOQkpacXtubt', 'VIVO', '28.00', '74.80', '30.00', '2244.00'),
(156, 52, '7wf36Weix2q6CZwRyBMbfQplt', 'DESPLUMADO', '28.00', '28.00', '2.00', '56.00'),
(157, 53, 'IOkaA09mDepfxcIqKCaCVflvT', 'VIVO', '20.00', '65.20', '27.80', '1812.56'),
(158, 54, 'kIdu8pbn6HeexgEam41MX6lgx', 'SALDO ATRASADO', '1.00', '1.00', '1137.60', '1137.60'),
(159, 55, 'CMJl5nToVnQxyQvRFdu3OTWvh', 'VIVO', '55.00', '177.70', '28.00', '4975.60'),
(160, 56, 'Lp7XBzMgb9F61ttV8UVqhgO3F', 'VIVO', '50.00', '166.70', '27.80', '4634.26'),
(161, 57, 'JGObXmbCXJrdrmJhpfKgXo23B', 'VIVO', '10.00', '24.60', '29.00', '713.40'),
(162, 57, 'Geav0Ge45J2veTMDkiiFlXX9G', 'DESPLUMADO', '10.00', '10.00', '2.00', '20.00'),
(163, 58, 'GVbNx4j9HQUw8y44YLWQj4Hhe', 'VIVO', '10.00', '31.70', '30.00', '951.00'),
(164, 58, 'vuCJvZOZH6k9pzqGbsZ1JBJhO', 'DESPLUMADO', '10.00', '10.00', '2.00', '20.00'),
(165, 59, 'wMlJP3RL1nhQSyxzZe2uDy9xu', 'VIVO', '28.00', '103.10', '28.00', '2886.80'),
(166, 60, 'L81p3ptS2tsCwUls7Q74ZG7sh', 'VIVO', '40.00', '141.20', '28.00', '3953.60'),
(167, 61, '1uEQ8yw95IR5W9Umm92GhGrkq', 'DESPLUMADO', '40.00', '40.00', '2.00', '80.00'),
(168, 61, 'n9fEdqfY5OGiFviu2EQP1snJ7', 'VIVO', '40.00', '100.51', '28.50', '2864.54'),
(169, 62, 'MnCd17FuOMPMZoHN0JALHFKpU', 'VIVO', '10.00', '32.00', '28.00', '896.00'),
(170, 62, 'GSgPgrZFjngDtXB3XkNIo8dRU', 'DESPLUMADO', '10.00', '10.00', '2.00', '20.00'),
(171, 63, 'JOllRrMw9CKo1grNHyCD4qwY5', 'VIVO', '10.00', '33.00', '28.00', '924.00'),
(172, 63, 'oGDoyNTbvWJQ82Sm4MpiRbhbF', 'DESPLUMADO', '10.00', '10.00', '2.00', '20.00'),
(173, 64, 'YZ8GYa9UeHxWjlnxceWf9bqVK', 'VIVO', '10.00', '34.00', '28.00', '952.00'),
(174, 64, '3S6LTtOSbnSivXqlp0HbNvVQb', 'DESPLUMADO', '10.00', '10.00', '2.00', '20.00'),
(175, 65, 'uRAoGF1qVQncDvFfe7Jfzg97q', 'VIVO', '10.00', '33.90', '28.00', '949.20'),
(176, 65, 'cqzpyJPZtDhNTVVQYqUCdl35Q', 'DESPLUMADO', '10.00', '10.00', '2.00', '20.00'),
(177, 66, 'SlBcHgBEHKL5m3b6m4OoU5HIl', 'VIVO', '3.00', '9.20', '27.80', '255.76'),
(178, 67, '2XTwv68bd5FKeqrQ6b5aarVmS', 'ALIÑADO', '6.00', '16.60', '36.00', '597.60'),
(179, 68, 'aAIGe9pl0hycJNZfEvooxgLV9', 'ALIÑADO', '9.00', '24.30', '36.00', '874.80'),
(180, 68, 'bnTt6XjCYeeVnBbSZvRjh5M0E', 'MENUDEO', '6.00', '0.30', '25.00', '7.50'),
(181, 69, 'LGgmm1W1T9wlbi2B2Y2Dmq18I', 'ALIÑADO', '15.00', '42.30', '34.50', '1459.35'),
(182, 70, 'eZdJQGIOmTZAOqTpcG9Nyi1CF', 'ALIÑADO', '10.00', '27.30', '35.00', '955.50'),
(183, 71, 'UxfC7evRYuXEkU1LWibcMZhvq', 'ALIÑADO', '3.00', '9.20', '35.00', '322.00'),
(184, 72, 'xRrkQh4hjieT3l2fjl4saW70z', 'ALIÑADO', '7.00', '19.20', '34.00', '652.80'),
(185, 73, 'BNG62l86JjIqaSJMQJsSrksVV', 'ALIÑADO', '15.00', '41.90', '34.00', '1424.60'),
(186, 73, 'fa6MwBQF5ZFXNVvICGXIJT1mc', 'ALIÑADO', '15.00', '42.30', '34.00', '1438.20'),
(187, 74, 'zDfGgf0lgMvIwllkgWtnYdW4Y', 'ALIÑADO', '4.00', '11.10', '38.00', '421.80'),
(188, 75, 'uVLBSSGetzXu7ESVbwZv68icE', 'ALIÑADO', '12.00', '29.20', '42.00', '1226.40'),
(189, 75, 'jkBFdOw0kDpvixauIKO0Ww5M1', 'MENUDEO', '0.00', '1.50', '25.00', '37.50'),
(190, 76, 'cqpIMzfQNfLl7LKjILts7949G', 'MENUDEO', '0.00', '3.00', '22.00', '66.00'),
(191, 77, '57rZOrWSRPXegFem9som9o8OA', 'ALIÑADO', '10.00', '27.10', '34.00', '921.40'),
(192, 78, 'FYCqznbUieVFjZYMdUOjAQQC0', 'ALIÑADO', '2.00', '5.20', '35.00', '182.00'),
(193, 79, 'zSuy9JpxjQCyJTd2zVJIhkiNy', 'ALIÑADO', '1.00', '2.40', '38.00', '91.20'),
(194, 80, '0WdgNJd3SlVZhR580KYSjsB08', 'VIVO', '25.00', '55.36', '15.00', '830.40'),
(195, 80, 'SRQNgqMTxm388n0vhyM1kLeRl', 'ALIÑADO', '11.00', '44.00', '14.00', '616.00'),
(196, 80, 'm7w9JZt7BoIOXr5OVC07a8UcW', 'DESPLUMADO', '25.00', '25.00', '2.00', '50.00'),
(197, 80, 'LiyCJE08pgF2W58wJrYgcLvTz', 'BOLSA', '1.00', '1.00', '1.00', '1.00'),
(198, 80, 'Mr636AdDOsZAiIcA1FUcT4rzj', 'POLLO SURTIDO', '23.00', '32.50', '12.00', '390.00'),
(199, 80, 'Gi82aeXr5fvGfnTS4tP43inZU', 'PIERNA S/CADERA', '25.00', '36.00', '14.00', '504.00'),
(200, 80, 'vsi31wuZsdv47ecEjHAsIN5Bu', 'PIERNA C/CADERA', '32.00', '25.00', '42.00', '1050.00'),
(201, 80, 'RTbOIg4EIJbb8HHmVsF1k0DVL', 'PECHUGA S/HUACAL', '12.00', '32.00', '12.00', '384.00'),
(202, 80, 'YHQ8ift30pWp6iCfFUFcDKNvp', 'PECHUGA C/HUACAL', '5.00', '4.00', '4.00', '16.00'),
(203, 80, 'qGwT6Jyl0jloIH3rqAQqtjoFi', 'ALITAS', '12.00', '45.00', '45.00', '2025.00'),
(204, 80, 'M4sHTcAV3dlfok69ss7u6r97L', 'FILETE', '2.00', '4.00', '12.00', '48.00'),
(205, 80, 'NFi4ugRVS7sfDFvPOMwu27vsb', 'MENUDENCIA', '5.00', '6.00', '12.00', '72.00'),
(206, 80, 'L5qQlHxflx6ILpEIxPPtko40z', 'MENUDO FRIO', '4.00', '44.00', '1.00', '44.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_pagos`
--

DROP TABLE IF EXISTS `ventas_pagos`;
CREATE TABLE IF NOT EXISTS `ventas_pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `id_forma_pago` int(11) NOT NULL,
  `importe` decimal(9,2) NOT NULL,
  `fecha` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `venta-pago` (`id_venta`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `ventas_pagos`
--

INSERT INTO `ventas_pagos` (`id`, `id_venta`, `id_forma_pago`, `importe`, `fecha`, `created_at`) VALUES
(121, 44, 1, '172.00', '26/03/2020', '2020-03-26 15:18:20'),
(123, 46, 1, '0.00', '27/03/2020', '2020-03-27 07:47:02'),
(124, 47, 1, '224.00', '27/03/2020', '2020-03-27 07:51:56'),
(126, 49, 1, '0.00', '27/03/2020', '2020-03-27 08:18:09'),
(127, 50, 1, '0.00', '27/03/2020', '2020-03-27 10:05:28'),
(128, 51, 1, '0.00', '27/03/2020', '2020-03-27 10:06:26'),
(129, 52, 1, '0.00', '27/03/2020', '2020-03-27 10:08:13'),
(130, 53, 1, '0.00', '27/03/2020', '2020-03-27 10:08:59'),
(131, 54, 1, '0.00', '27/03/2020', '2020-03-27 10:13:07'),
(132, 55, 1, '0.00', '27/03/2020', '2020-03-27 10:13:38'),
(133, 55, 1, '4975.60', '27/03/2020', '2020-03-27 10:14:08'),
(134, 54, 1, '24.40', '27/03/2020', '2020-03-27 10:15:27'),
(135, 56, 1, '4634.26', '27/03/2020', '2020-03-27 10:21:10'),
(136, 57, 1, '733.40', '27/03/2020', '2020-03-27 10:22:55'),
(137, 58, 1, '0.00', '27/03/2020', '2020-03-27 10:23:56'),
(138, 59, 1, '2286.80', '27/03/2020', '2020-03-27 10:27:02'),
(139, 59, 1, '600.00', '27/03/2020', '2020-03-27 10:27:27'),
(140, 60, 1, '0.00', '27/03/2020', '2020-03-27 10:30:57'),
(141, 61, 1, '2944.54', '27/03/2020', '2020-03-27 10:35:38'),
(142, 62, 1, '916.00', '27/03/2020', '2020-03-27 10:36:25'),
(143, 63, 1, '0.00', '27/03/2020', '2020-03-27 10:37:43'),
(144, 64, 1, '0.00', '27/03/2020', '2020-03-27 10:39:22'),
(145, 65, 1, '0.00', '27/03/2020', '2020-03-27 10:41:34'),
(146, 66, 1, '0.00', '27/03/2020', '2020-03-27 10:42:26'),
(147, 67, 1, '0.00', '27/03/2020', '2020-03-27 10:44:49'),
(148, 68, 1, '0.00', '27/03/2020', '2020-03-27 10:52:47'),
(149, 69, 1, '0.00', '27/03/2020', '2020-03-27 10:56:10'),
(150, 70, 1, '0.00', '27/03/2020', '2020-03-27 10:57:36'),
(151, 71, 1, '0.00', '27/03/2020', '2020-03-27 10:58:12'),
(152, 72, 1, '652.80', '27/03/2020', '2020-03-27 11:00:45'),
(153, 73, 1, '0.00', '27/03/2020', '2020-03-27 11:09:34'),
(154, 74, 1, '0.00', '27/03/2020', '2020-03-27 11:10:18'),
(155, 75, 1, '0.00', '27/03/2020', '2020-03-27 11:12:37'),
(156, 76, 1, '0.00', '27/03/2020', '2020-03-27 11:21:06'),
(157, 77, 1, '0.00', '27/03/2020', '2020-03-27 11:32:01'),
(158, 78, 1, '182.00', '27/03/2020', '2020-03-27 11:35:04'),
(159, 79, 1, '91.20', '27/03/2020', '2020-03-27 11:36:32'),
(160, 80, 1, '1236.50', '27/03/2020', '2020-03-27 13:16:30');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `cliente-venta` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas_detalles`
--
ALTER TABLE `ventas_detalles`
  ADD CONSTRAINT `venta-detalles` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas_pagos`
--
ALTER TABLE `ventas_pagos`
  ADD CONSTRAINT `venta-pago` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
