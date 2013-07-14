-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-07-2013 a las 02:27:03
-- Versión del servidor: 5.5.25a
-- Versión de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `melomanos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancion`
--

CREATE TABLE IF NOT EXISTS `cancion` (
  `ID_Cancion` int(4) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) DEFAULT NULL,
  `Genero` varchar(20) DEFAULT NULL,
  `Onda` varchar(50) DEFAULT NULL,
  `User_Name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_Cancion`),
  KEY `User_Name` (`User_Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `cancion`
--

INSERT INTO `cancion` (`ID_Cancion`, `Nombre`, `Genero`, `Onda`, `User_Name`) VALUES
(1, '05 - Fluorescent Ado', NULL, NULL, 'Fedex'),
(2, '02 - Teddy Picker.mp3', NULL, NULL, 'Fedex'),
(3, '01 - Sunday Bloody Sunday.mp3', NULL, NULL, 'FerDalmasso'),
(4, '04 - Given The Dog a Bone.mp3', NULL, NULL, 'FerDalmasso'),
(5, '01 - Hells Bells.mp3', NULL, NULL, 'FerDalmasso'),
(8, '02 - Teddy Picker.mp3', NULL, NULL, 'FerDalmasso'),
(9, '07 - Everyday Is Like Sunday.mp3', NULL, NULL, 'FerDalmasso'),
(10, '01 - I Ran.mp3', NULL, NULL, 'FerDalmasso'),
(11, '05 - Instant Crush (Feat. Julian Casablancas).mp3', NULL, NULL, 'FerDalmasso'),
(12, '02 - Under Cover of Darkness.mp3', NULL, NULL, 'FerDalmasso'),
(13, '07 - Just.mp3', NULL, NULL, 'FerDalmasso'),
(14, '10 - No Surprises.mp3', NULL, NULL, 'FerDalmasso'),
(15, '19 - Pet Sematary.mp3', NULL, NULL, 'FerDalmasso'),
(16, '02 - Psycho Killer.mp3', NULL, NULL, 'FerDalmasso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancion_playlist`
--

CREATE TABLE IF NOT EXISTS `cancion_playlist` (
  `ID_Cancion_Playlist` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Cancion` int(11) DEFAULT NULL,
  `ID_Playlist` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Cancion_Playlist`),
  KEY `ID_Cancion` (`ID_Cancion`),
  KEY `ID_Playlist` (`ID_Playlist`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `cancion_playlist`
--

INSERT INTO `cancion_playlist` (`ID_Cancion_Playlist`, `ID_Cancion`, `ID_Playlist`) VALUES
(8, 4, 37),
(9, 3, 37),
(10, 5, 41),
(11, 4, 41),
(12, 3, 41),
(14, 11, 43),
(15, 10, 43),
(16, 8, 43),
(17, 9, 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playlist`
--

CREATE TABLE IF NOT EXISTS `playlist` (
  `ID_Playlist` int(4) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(20) DEFAULT NULL,
  `User_Name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_Playlist`),
  KEY `User_Name` (`User_Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Volcado de datos para la tabla `playlist`
--

INSERT INTO `playlist` (`ID_Playlist`, `Nombre`, `User_Name`) VALUES
(37, 'fdfsd', 'FerDalmasso'),
(41, 'aaaaaddd', 'FerDalmasso'),
(43, 'terterter', 'FerDalmasso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sigue_a`
--

CREATE TABLE IF NOT EXISTS `sigue_a` (
  `usuario1` varchar(20) NOT NULL DEFAULT '',
  `usuario2` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`usuario1`,`usuario2`),
  KEY `usuario2` (`usuario2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `Nombre_Usuario` varchar(20) NOT NULL DEFAULT '',
  `nombre` varchar(20) DEFAULT NULL,
  `apellido` varchar(20) DEFAULT NULL,
  `password` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`Nombre_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Nombre_Usuario`, `nombre`, `apellido`, `password`) VALUES
('', '', '', ''),
('Federiz', 'Federico', 'Rizzio', '123456'),
('Fedex', 'Federico', 'Rizzio', '123456'),
('fer', 'fer', 'dalmasso', '1234'),
('FerDalmasso', 'Fernando', 'Dalmasso', '1234'),
('fsd', 'fds', 'fds', '0'),
('hgf', 'hfg', 'hfg', '0'),
('jmg', 'juan', 'garcia', '123'),
('Pepe', 'Pedro', 'Picapiedra', '1234');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cancion`
--
ALTER TABLE `cancion`
  ADD CONSTRAINT `cancion_ibfk_1` FOREIGN KEY (`User_Name`) REFERENCES `usuario` (`Nombre_Usuario`);

--
-- Filtros para la tabla `cancion_playlist`
--
ALTER TABLE `cancion_playlist`
  ADD CONSTRAINT `ID_Cancion_fk` FOREIGN KEY (`ID_Cancion`) REFERENCES `cancion` (`ID_Cancion`),
  ADD CONSTRAINT `ID_Playlist_fk` FOREIGN KEY (`ID_Playlist`) REFERENCES `playlist` (`ID_Playlist`);

--
-- Filtros para la tabla `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`User_Name`) REFERENCES `usuario` (`Nombre_Usuario`);

--
-- Filtros para la tabla `sigue_a`
--
ALTER TABLE `sigue_a`
  ADD CONSTRAINT `sigue_a_ibfk_1` FOREIGN KEY (`usuario1`) REFERENCES `usuario` (`Nombre_Usuario`),
  ADD CONSTRAINT `sigue_a_ibfk_2` FOREIGN KEY (`usuario2`) REFERENCES `usuario` (`Nombre_Usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
