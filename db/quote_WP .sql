-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-09-2019 a las 19:29:17
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u725020941_wp`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE PROCEDURE `sp_branch_office` ()  BEGIN
    SELECT id_branch_office,name_branch_office, addres_branch_office FROM wp_branch_office;
END$$

CREATE PROCEDURE `sp_city` ()  BEGIN
    SELECT id_city,name_city FROM wp_city;
END$$

CREATE PROCEDURE `sp_create_quote` (IN `doc` VARCHAR(100), IN `model` VARCHAR(100), IN `name` VARCHAR(100), IN `mail` VARCHAR(100), IN `cellphone` VARCHAR(100), IN `line` INT, IN `mp` INT, IN `city` INT)  BEGIN
	SET @code = (SELECT CONCAT('COT_',COUNT(*)+1) AS Quo_consec FROM wp_quote ORDER BY id_quote DESC LIMIT 0, 1);
    INSERT INTO wp_quote(name_client, mail_client, cellphone_client, id_line, id_mp, model_quote, document_client, code_quote, id_city) VALUES
    (name,mail,cellphone,line,mp,model,doc,@code,city);      
END$$

CREATE PROCEDURE `sp_line` ()  BEGIN
  SELECT id_line,name_line FROM wp_line;
END$$

CREATE PROCEDURE `sp_mp` ()  BEGIN
  SELECT * FROM wp_mp;
END$$

CREATE PROCEDURE `sp_mp_cost` (IN `line` INT, IN `mp` INT)  BEGIN
  SELECT name_article,cost_article_mp, LI.name_line, MP.name_mp FROM wp_article_mp AMP 
                INNER JOIN wp_mp MP ON AMP.id_mp=MP.id_mp
                INNER JOIN wp_line LI ON AMP.id_line=LI.id_line
                INNER JOIN wp_article ART ON AMP.id_article= ART.id_article 
                WHERE AMP.id_line=line AND AMP.id_mp=mp ORDER BY name_article ASC;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_article`
--

CREATE TABLE IF NOT EXISTS `wp_article` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `name_article` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_type_article` int(11) NOT NULL,
  `id_unity` int(11) NOT NULL,
  `cost_article` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_article` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_article` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_article`),
  KEY `unity_article` (`id_unity`),
  KEY `type_article_article` (`id_type_article`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `wp_article`
--

INSERT INTO `wp_article` (`id_article`, `name_article`, `id_type_article`, `id_unity`, `cost_article`, `description_article`, `code_article`) VALUES
(1, 'Diagnóstico Computarizado Scanner', 1, 5, '0', '', '0'),
(2, 'Embellecimiento e Insumos', 1, 5, '0', '', '0'),
(3, 'Inspección /Ajuste correa accesorios motor', 1, 5, '0', '', '0'),
(4, 'Inspección /Ajuste correas motor', 1, 5, '0', '', '0'),
(5, 'Inspección Aceite Caja de Cambios', 1, 5, '0', '', '0'),
(6, 'Inspección Batería y sistema de carga', 1, 5, '0', '', '0'),
(7, 'Inspección componentes eje cardan y rodamiento central', 1, 5, '0', '', '0'),
(8, 'Inspección de holgura juego libre de pedales- embrague- freno- acelerador', 1, 5, '0', '', '0'),
(9, 'Inspección del estado de las plumillas', 1, 5, '0', '', '0'),
(10, 'Inspección Fluido y componentes  sistema hidráulico dirección', 1, 5, '0', '', '0'),
(11, 'Inspección fugas de fluidos- Motor- caja- diferencial- embrague- frenos- refrigerante- tuberías', 1, 5, '0', '', '0'),
(12, 'Inspección Líquido de Frenos/Embrague', 1, 5, '0', '', '0'),
(13, 'Inspección mecanismos control caja de cambios', 1, 5, '0', '', '0'),
(14, 'Inspección mecanismos control caja de cambios- 4H- 4L', 1, 5, '0', '', '0'),
(15, 'Inspección rotulas y guardapolvos', 1, 5, '0', '', '0'),
(16, 'Inspección ruedas presión- estado y nivel de desgaste', 1, 5, '0', '', '0'),
(17, 'Inspección sistema de luces y tablero de instrumentos- anclaje cinturones de seguridad- calefacción-', 1, 5, '0', '', '0'),
(18, 'Inspección suspensión- amortiguadores', 1, 5, '0', '', '0'),
(19, 'Inspeccion suspension- amotiguadores- muelles- pasadores- balancines y bujes', 1, 5, '0', '', '0'),
(20, 'Inspección torque perno ruedas', 1, 5, '0', '', '0'),
(21, 'Inspección y ajuste sistema de Frenos', 1, 5, '0', '', '0'),
(22, 'Inspección/Lubricacion de rueda libre', 1, 5, '0', '', '0'),
(23, 'Inspección/reemplazo filtro antipolen', 1, 5, '0', '', '0'),
(24, 'Llenado de liquido lavaparabrisas', 1, 5, '0', '', '0'),
(25, 'Llenado del liquido lavaparabrisas ', 1, 5, '0', '', '0'),
(26, 'Mano de Obra', 1, 5, '0', '', '0'),
(27, 'Reemplazar Aceite de la Caja CVT', 1, 5, '0', '', '0'),
(28, 'Reemplazar Aceite de la Caja de cambios', 1, 5, '0', '', '0'),
(29, 'Reemplazar aceite de la diferencial', 1, 5, '0', '', '0'),
(30, 'Reemplazar aceite hidráulico  de la servodirección', 1, 5, '0', '', '0'),
(31, 'Reemplazar Aceite Motor', 1, 5, '0', '', '0'),
(32, 'Reemplazar correa accesorios motor', 1, 5, '0', '', '0'),
(33, 'Reemplazar filtro combustible Separador', 1, 5, '0', '', '0'),
(34, 'Reemplazar Filtro de Aceite Motor', 1, 5, '0', '', '0'),
(35, 'Reemplazar filtro de aire acondicionado', 1, 5, '0', '', '0'),
(36, 'Reemplazar filtro de aire de motor', 1, 5, '0', '', '0'),
(37, 'Reemplazar filtro Filtro combustible ', 1, 5, '0', '', '0'),
(38, 'Reemplazar filtro Filtro combustible Separador', 1, 5, '0', '', '0'),
(39, 'Reemplazar Grasa rodamientos cubos ruedas delanteras', 1, 5, '0', '', '0'),
(40, 'Reemplazar Líquido de Frenos/Embrague', 1, 5, '0', '', '0'),
(41, 'Reemplazar Líquido Refrigerante de motor', 1, 5, '0', '', '0'),
(42, 'Reemplazar Sello  rodamientos cubos ruedas delanteras', 1, 5, '0', '', '0'),
(43, 'Reemplazar Sello  rodamientos cubos ruedas traseras', 1, 5, '0', '', '0'),
(44, 'Reemplazo filtro antipolen', 1, 5, '0', '', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_article_mp`
--

CREATE TABLE IF NOT EXISTS `wp_article_mp` (
  `id_article_mp` int(11) NOT NULL AUTO_INCREMENT,
  `id_mp` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_line` int(11) NOT NULL,
  `cost_article_mp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_article_mp`),
  KEY `line_mp` (`id_line`),
  KEY `mp_mp` (`id_mp`),
  KEY `article_mp` (`id_article`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `wp_article_mp`
--

INSERT INTO `wp_article_mp` (`id_article_mp`, `id_mp`, `id_article`, `id_line`, `cost_article_mp`) VALUES
(1, 1, 31, 1, '75000'),
(2, 1, 34, 1, '16000'),
(3, 1, 24, 1, '8000'),
(4, 1, 26, 1, '45000'),
(5, 1, 17, 1, '0'),
(6, 1, 6, 1, '0'),
(7, 1, 9, 1, '0'),
(8, 1, 8, 1, '0'),
(9, 1, 11, 1, '0'),
(10, 1, 16, 1, '0'),
(11, 1, 20, 1, '0'),
(12, 1, 2, 1, '12000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_branch_office`
--

CREATE TABLE IF NOT EXISTS `wp_branch_office` (
  `id_branch_office` int(11) NOT NULL,
  `name_branch_office` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_branch_office` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addres_branch_office` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_branch_office` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_city` int(11) NOT NULL,
  KEY `city_branch_office` (`id_city`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `wp_branch_office`
--

INSERT INTO `wp_branch_office` (`id_branch_office`, `name_branch_office`, `description_branch_office`, `addres_branch_office`, `tel_branch_office`, `id_city`) VALUES
(1, 'Macroservicios Clinicar', '', 'Calle 50 No. 44-36', '', 1),
(2, 'Auto Unión Sede', '', 'Carrera 22 No. 127 D -27', '', 2),
(3, 'Fersautos Sede', '', 'Cra. 15 # 19-50', '', 3),
(4, 'Almacen de Motores S.A', '', 'Calle 70 No. 2A N-280', '', 4),
(5, 'Fersautos Sede', '', 'Avenida 7N # 8N - 30 Zona Industrial de Sevilla', '', 5),
(6, 'Ferautos S.A.S', '', 'Avenida las Américas # 26 -49', '', 6),
(7, 'Casautos Sede', '', 'Carrera 23 # 35-15', '', 7),
(8, 'Red Cial de la Costa', '', 'CRA 16 No. 12G - 40 (Km 5 via Monteria - Cerete)', '', 8),
(9, 'Todo Automotores del Huila', '', 'Carrera 10 # 6 - 53 Sur (Zona Industrial)', '', 9),
(10, 'Centro Motors Sede', '', 'Calle 42 # 32B - 05', '', 10),
(11, 'Motor kia', '', 'Carrera 40 A # 17 A 10', '', 11),
(12, 'Casautos Sede', '', 'Avenida 30 de Agosto # 105 - 90', '', 12),
(13, 'Centro Motors Sede', '', 'Cra 40 # 26-50', '', 13),
(14, 'DISALCAR', '', 'Cra 7a N. 39 - 139 Barrio 12 de Octubre', '', 14),
(15, 'Auto Unión Sede', '', 'Calle 1 No 37-140 Anillo vial', '', 15),
(16, 'Auto Unión Sede', '', 'Carrera 20 No. 37 -55', '', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_city`
--

CREATE TABLE IF NOT EXISTS `wp_city` (
  `id_city` int(11) NOT NULL AUTO_INCREMENT,
  `name_city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_city` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_city`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `wp_city`
--

INSERT INTO `wp_city` (`id_city`, `name_city`, `description_city`) VALUES
(1, 'Barranquilla', ''),
(2, 'Bogotá', ''),
(3, 'Bucaramanga', ''),
(4, 'Cali', ''),
(5, 'Cucuta', ''),
(6, 'Duitama', ''),
(7, 'Manizales', ''),
(8, 'Monteria', ''),
(9, 'Neiva', ''),
(10, 'Palmira', ''),
(11, 'Pasto', ''),
(12, 'Pereira', ''),
(13, 'Tulua', ''),
(14, 'Valledupar', ''),
(15, 'Villavicencio', ''),
(16, 'Yopal', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_line`
--

CREATE TABLE IF NOT EXISTS `wp_line` (
  `id_line` int(11) NOT NULL AUTO_INCREMENT,
  `name_line` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_line` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_line`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `wp_line`
--

INSERT INTO `wp_line` (`id_line`, `name_line`, `description_line`) VALUES
(1, 'KUV 100', ''),
(2, 'PICK UP NEW', ''),
(3, 'PICK UP OLD', ''),
(4, 'S2 - AUT', ''),
(5, 'S2 - S2LX', ''),
(6, 'S2 URBAN', ''),
(7, 'S3 - AUT', ''),
(8, 'S3 - GRAND S3', ''),
(9, 'S7', ''),
(10, 'T6', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_mp`
--

CREATE TABLE IF NOT EXISTS `wp_mp` (
  `id_mp` int(11) NOT NULL AUTO_INCREMENT,
  `name_mp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_mp`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `wp_mp`
--

INSERT INTO `wp_mp` (`id_mp`, `name_mp`) VALUES
(1, '5000 Km '),
(2, '10000 Km'),
(3, '15000 Km '),
(4, '20000 Km'),
(5, '25000 Km '),
(6, '30000 Km'),
(7, '35000 Km '),
(8, '40000 Km'),
(9, '45000 Km '),
(10, '50000 Km'),
(11, '55000 Km '),
(12, '60000 Km'),
(13, '65000 Km '),
(14, '70000 Km'),
(15, '75000 Km '),
(16, '80000 Km'),
(17, '85000 Km '),
(18, '90000 Km'),
(19, '95000 Km'),
(20, '100000 Km');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_quote`
--

CREATE TABLE IF NOT EXISTS `wp_quote` (
  `id_quote` int(11) NOT NULL AUTO_INCREMENT,
  `name_client` varchar(100) NOT NULL,
  `mail_client` varchar(100) NOT NULL,
  `cellphone_client` varchar(20) NOT NULL,
  `id_line` int(11) NOT NULL,
  `id_mp` int(11) NOT NULL,
  `model_quote` varchar(10) NOT NULL,
  `document_client` varchar(20) NOT NULL,
  `code_quote` varchar(10) NOT NULL,
  `id_city` int(11) NOT NULL,
  PRIMARY KEY (`id_quote`),
  KEY `city_quote` (`id_city`),
  KEY `line_quote` (`id_line`),
  KEY `mp_quote` (`id_mp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_type_article`
--

CREATE TABLE IF NOT EXISTS `wp_type_article` (
  `id_type_article` int(11) NOT NULL AUTO_INCREMENT,
  `name_type_article` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_type_article`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `wp_type_article`
--

INSERT INTO `wp_type_article` (`id_type_article`, `name_type_article`) VALUES
(1, 'Insumo'),
(2, 'Mano de Obra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_unity`
--

CREATE TABLE IF NOT EXISTS `wp_unity` (
  `id_unity` int(11) NOT NULL AUTO_INCREMENT,
  `name_unity` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_unity` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_unity`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `wp_unity`
--

INSERT INTO `wp_unity` (`id_unity`, `name_unity`, `value_unity`) VALUES
(1, 'Metro', '1'),
(2, 'Libra', '1'),
(3, 'Hora', '1'),
(4, 'Litro', '1'),
(5, 'Unidad', '1');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `wp_article`
--
ALTER TABLE `wp_article`
  ADD CONSTRAINT `type_article_article` FOREIGN KEY (`id_type_article`) REFERENCES `wp_type_article` (`id_type_article`),
  ADD CONSTRAINT `unity_article` FOREIGN KEY (`id_unity`) REFERENCES `wp_unity` (`id_unity`);

--
-- Filtros para la tabla `wp_article_mp`
--
ALTER TABLE `wp_article_mp`
  ADD CONSTRAINT `article_mp` FOREIGN KEY (`id_article`) REFERENCES `wp_article` (`id_article`),
  ADD CONSTRAINT `line_mp` FOREIGN KEY (`id_line`) REFERENCES `wp_line` (`id_line`),
  ADD CONSTRAINT `mp_mp` FOREIGN KEY (`id_mp`) REFERENCES `wp_mp` (`id_mp`);

--
-- Filtros para la tabla `wp_branch_office`
--
ALTER TABLE `wp_branch_office`
  ADD CONSTRAINT `city_branch_office` FOREIGN KEY (`id_city`) REFERENCES `wp_city` (`id_city`);

--
-- Filtros para la tabla `wp_quote`
--
ALTER TABLE `wp_quote`
  ADD CONSTRAINT `city_quote` FOREIGN KEY (`id_city`) REFERENCES `wp_city` (`id_city`),
  ADD CONSTRAINT `line_quote` FOREIGN KEY (`id_line`) REFERENCES `wp_line` (`id_line`),
  ADD CONSTRAINT `mp_quote` FOREIGN KEY (`id_mp`) REFERENCES `wp_mp` (`id_mp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
