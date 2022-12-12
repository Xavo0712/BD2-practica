-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2022 a las 18:08:27
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd201`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `follow`
--

CREATE TABLE `follow` (
  `idUserFollower` int(11) NOT NULL,
  `idUserFollowing` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia`
--

CREATE TABLE `historia` (
  `idHist` int(11) NOT NULL,
  `tipus` tinyint(1) NOT NULL DEFAULT 0,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `missatge`
--

CREATE TABLE `missatge` (
  `idMsg` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `idUserE` int(11) NOT NULL,
  `idUserR` int(11) NOT NULL,
  `timeSent` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacio`
--

CREATE TABLE `publicacio` (
  `idPub` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `idHist` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resposta`
--

CREATE TABLE `resposta` (
  `idRes` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  `idUser` int(11) NOT NULL,
  `idPub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `r_reenv`
--

CREATE TABLE `r_reenv` (
  `idUser` int(11) NOT NULL,
  `idPub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuari`
--

CREATE TABLE `usuari` (
  `idUser` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `contrasenya` varchar(20) NOT NULL,
  `telefon` int(9) NOT NULL,
  `correu` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`idUserFollower`,`idUserFollowing`),
  ADD KEY `idUserFollowing` (`idUserFollowing`);

--
-- Indices de la tabla `historia`
--
ALTER TABLE `historia`
  ADD PRIMARY KEY (`idHist`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `missatge`
--
ALTER TABLE `missatge`
  ADD PRIMARY KEY (`idMsg`),
  ADD KEY `idUserE` (`idUserE`),
  ADD KEY `idUserR` (`idUserR`);

--
-- Indices de la tabla `publicacio`
--
ALTER TABLE `publicacio`
  ADD PRIMARY KEY (`idPub`),
  ADD KEY `idHist` (`idHist`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `resposta`
--
ALTER TABLE `resposta`
  ADD PRIMARY KEY (`idRes`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idPub` (`idPub`);

--
-- Indices de la tabla `r_reenv`
--
ALTER TABLE `r_reenv`
  ADD PRIMARY KEY (`idUser`,`idPub`),
  ADD KEY `idPub` (`idPub`);

--
-- Indices de la tabla `usuari`
--
ALTER TABLE `usuari`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `missatge`
--
ALTER TABLE `missatge`
  MODIFY `idMsg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `publicacio`
--
ALTER TABLE `publicacio`
  MODIFY `idPub` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `resposta`
--
ALTER TABLE `resposta`
  MODIFY `idRes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuari`
--
ALTER TABLE `usuari`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`idUserFollower`) REFERENCES `usuari` (`idUser`),
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`idUserFollowing`) REFERENCES `usuari` (`idUser`);

--
-- Filtros para la tabla `historia`
--
ALTER TABLE `historia`
  ADD CONSTRAINT `historia_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `usuari` (`idUser`);

--
-- Filtros para la tabla `missatge`
--
ALTER TABLE `missatge`
  ADD CONSTRAINT `missatge_ibfk_1` FOREIGN KEY (`idUserE`) REFERENCES `usuari` (`idUser`),
  ADD CONSTRAINT `missatge_ibfk_2` FOREIGN KEY (`idUserR`) REFERENCES `usuari` (`idUser`);

--
-- Filtros para la tabla `publicacio`
--
ALTER TABLE `publicacio`
  ADD CONSTRAINT `publicacio_ibfk_1` FOREIGN KEY (`idHist`) REFERENCES `historia` (`idHist`),
  ADD CONSTRAINT `publicacio_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `usuari` (`idUser`);

--
-- Filtros para la tabla `resposta`
--
ALTER TABLE `resposta`
  ADD CONSTRAINT `resposta_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `usuari` (`idUser`),
  ADD CONSTRAINT `resposta_ibfk_2` FOREIGN KEY (`idPub`) REFERENCES `publicacio` (`idPub`);

--
-- Filtros para la tabla `r_reenv`
--
ALTER TABLE `r_reenv`
  ADD CONSTRAINT `r_reenv_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `usuari` (`idUser`),
  ADD CONSTRAINT `r_reenv_ibfk_2` FOREIGN KEY (`idPub`) REFERENCES `publicacio` (`idPub`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
