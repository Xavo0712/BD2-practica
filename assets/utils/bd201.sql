-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 15-12-2022 a les 15:40:06
-- Versió del servidor: 10.4.18-MariaDB
-- Versió de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `bd201`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `follow`
--

CREATE TABLE `follow` (
  `idUserFollower` int(11) NOT NULL,
  `idUserFollowing` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de la taula `historia`
--

CREATE TABLE `historia` (
  `idHist` int(11) NOT NULL,
  `tipus` tinyint(1) NOT NULL DEFAULT 0,
  `idUser` int(11) NOT NULL,
  `titol` char(255) NOT NULL,
  `link` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Bolcament de dades per a la taula `historia`
--

INSERT INTO `historia` (`idHist`, `tipus`, `idUser`, `titol`, `link`) VALUES
(4, 1, 5, 'ciutats', NULL),
(5, 1, 5, 'menjars', NULL),
(6, 1, 5, 'esport', NULL),
(7, 1, 5, 'fotos', NULL),
(8, 1, 5, 'familia', NULL);

-- --------------------------------------------------------

--
-- Estructura de la taula `missatge`
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
-- Estructura de la taula `publicacio`
--

CREATE TABLE `publicacio` (
  `idPub` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `idHist` int(11) DEFAULT NULL,
  `link` char(255) NOT NULL,
  `text` char(255) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Bolcament de dades per a la taula `publicacio`
--

INSERT INTO `publicacio` (`idPub`, `data`, `idHist`, `link`, `text`, `idUser`) VALUES
(2, '2022-12-15 12:34:26', 6, 'aevaervar', '', 5),
(3, '2022-12-15 12:35:47', 4, 'rtnbsrtb', 'srtbsrtb', 5),
(6, '2022-12-15 12:45:14', 5, 'wevw', 'wevwe', 5),
(7, '2022-12-15 12:46:38', 7, 'srtbsrt', '', 5),
(10, '2022-12-15 12:49:38', NULL, 'kkk', 'kkk', 5),
(11, '2022-12-15 12:49:51', NULL, 'aervaerv', '', 5);

-- --------------------------------------------------------

--
-- Estructura de la taula `resposta`
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
-- Estructura de la taula `r_reenv`
--

CREATE TABLE `r_reenv` (
  `idUser` int(11) NOT NULL,
  `idPub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de la taula `usuari`
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
-- Bolcament de dades per a la taula `usuari`
--

INSERT INTO `usuari` (`idUser`, `nom`, `contrasenya`, `telefon`, `correu`, `username`) VALUES
(5, '111', '111', 111, '111', '111');

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`idUserFollower`,`idUserFollowing`),
  ADD KEY `idUserFollowing` (`idUserFollowing`);

--
-- Índexs per a la taula `historia`
--
ALTER TABLE `historia`
  ADD PRIMARY KEY (`idHist`),
  ADD KEY `idUser` (`idUser`);

--
-- Índexs per a la taula `missatge`
--
ALTER TABLE `missatge`
  ADD PRIMARY KEY (`idMsg`),
  ADD KEY `idUserE` (`idUserE`),
  ADD KEY `idUserR` (`idUserR`);

--
-- Índexs per a la taula `publicacio`
--
ALTER TABLE `publicacio`
  ADD PRIMARY KEY (`idPub`),
  ADD KEY `idHist` (`idHist`),
  ADD KEY `idUser` (`idUser`);

--
-- Índexs per a la taula `resposta`
--
ALTER TABLE `resposta`
  ADD PRIMARY KEY (`idRes`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idPub` (`idPub`);

--
-- Índexs per a la taula `r_reenv`
--
ALTER TABLE `r_reenv`
  ADD PRIMARY KEY (`idUser`,`idPub`),
  ADD KEY `idPub` (`idPub`);

--
-- Índexs per a la taula `usuari`
--
ALTER TABLE `usuari`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `historia`
--
ALTER TABLE `historia`
  MODIFY `idHist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la taula `missatge`
--
ALTER TABLE `missatge`
  MODIFY `idMsg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT per la taula `publicacio`
--
ALTER TABLE `publicacio`
  MODIFY `idPub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la taula `resposta`
--
ALTER TABLE `resposta`
  MODIFY `idRes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `usuari`
--
ALTER TABLE `usuari`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`idUserFollower`) REFERENCES `usuari` (`idUser`),
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`idUserFollowing`) REFERENCES `usuari` (`idUser`);

--
-- Restriccions per a la taula `historia`
--
ALTER TABLE `historia`
  ADD CONSTRAINT `historia_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `usuari` (`idUser`);

--
-- Restriccions per a la taula `missatge`
--
ALTER TABLE `missatge`
  ADD CONSTRAINT `missatge_ibfk_1` FOREIGN KEY (`idUserE`) REFERENCES `usuari` (`idUser`),
  ADD CONSTRAINT `missatge_ibfk_2` FOREIGN KEY (`idUserR`) REFERENCES `usuari` (`idUser`);

--
-- Restriccions per a la taula `publicacio`
--
ALTER TABLE `publicacio`
  ADD CONSTRAINT `publicacio_ibfk_1` FOREIGN KEY (`idHist`) REFERENCES `historia` (`idHist`),
  ADD CONSTRAINT `publicacio_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `usuari` (`idUser`);

--
-- Restriccions per a la taula `resposta`
--
ALTER TABLE `resposta`
  ADD CONSTRAINT `resposta_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `usuari` (`idUser`),
  ADD CONSTRAINT `resposta_ibfk_2` FOREIGN KEY (`idPub`) REFERENCES `publicacio` (`idPub`);

--
-- Restriccions per a la taula `r_reenv`
--
ALTER TABLE `r_reenv`
  ADD CONSTRAINT `r_reenv_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `usuari` (`idUser`),
  ADD CONSTRAINT `r_reenv_ibfk_2` FOREIGN KEY (`idPub`) REFERENCES `publicacio` (`idPub`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
