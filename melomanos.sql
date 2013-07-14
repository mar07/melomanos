-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-06-2013 a las 03:24:17
-- Versión del servidor: 5.5.8
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `melomanos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playlist`
--

CREATE TABLE IF NOT EXISTS `playlist` (
  `ID_Playlist` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(20) DEFAULT NULL,
  `User_Name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_Playlist`),
  KEY `User_Name` (`User_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `playlist`
--


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

--
-- Volcar la base de datos para la tabla `sigue_a`
--


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
-- Volcar la base de datos para la tabla `usuario`
--


CREATE TABLE IF NOT EXISTS `cancion` (
  `ID_Cancion` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) DEFAULT NULL,
  `Genero` varchar(20) DEFAULT NULL,
  `Onda` varchar(50) DEFAULT NULL,
  `User_Name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_Cancion`),
  KEY `User_Name` (`User_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `cancion_playlist` (
  `ID_Cancion_Playlist` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Cancion` int(11) DEFAULT NULL,
  `ID_Playlist` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Cancion_Playlist`),
  KEY `ID_Cancion` (`ID_Cancion`),
  KEY `ID_Playlist` (`ID_Playlist`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`User_Name`) REFERENCES `usuario` (`Nombre_Usuario`);

ALTER TABLE `cancion`
  ADD CONSTRAINT `cancion_ibfk_1` FOREIGN KEY (`User_Name`) REFERENCES `usuario` (`Nombre_Usuario`);

--
-- Filtros para la tabla `sigue_a`
--
ALTER TABLE `sigue_a`
  ADD CONSTRAINT `sigue_a_ibfk_1` FOREIGN KEY (`usuario1`) REFERENCES `usuario` (`Nombre_Usuario`),
  ADD CONSTRAINT `sigue_a_ibfk_2` FOREIGN KEY (`usuario2`) REFERENCES `usuario` (`Nombre_Usuario`);

ALTER TABLE `cancion_playlist`
  ADD CONSTRAINT `ID_Cancion_fk` FOREIGN KEY (`ID_Cancion`) REFERENCES `cancion` (`ID_Cancion`);
ALTER TABLE `cancion_playlist`
  ADD CONSTRAINT `ID_Playlist_fk` FOREIGN KEY (`ID_Playlist`) REFERENCES `playlist` (`ID_Playlist`);