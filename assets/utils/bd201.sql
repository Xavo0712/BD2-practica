CREATE DATABASE bd201;
USE bd201;
-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-12-2022 a las 16:38:52
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Base de datos: `bd201`
--
DELIMITER $$ --
-- Procedimientos
--
CREATE DEFINER = `root` @`localhost` PROCEDURE `getChats` (IN `loggedUserId` INT) BEGIN
SELECT missatge.leidoE,
  missatge.leidoR,
  TIMEDIFF(NOW(), missatge.timeSent) as lastTime,
  senders.idUser AS sId,
  senders.username AS sender,
  senders.imagen AS sImg,
  receivers.idUser AS rId,
  receivers.username AS receiver,
  receivers.imagen AS rImg,
  missatge.idMsg,
  missatge.text,
  missatge.timeSent
FROM missatge
  JOIN usuari AS senders ON (
    missatge.idUserE = loggedUserId
    OR missatge.idUserR = loggedUserId
  )
  AND missatge.idUserE = senders.idUser
  JOIN usuari AS receivers ON missatge.idUserR = receivers.idUser
ORDER BY missatge.timeSent;
END $$ DELIMITER;
DELIMITER / / CREATE EVENT backup ON SCHEDULE EVERY 1 DAY DO BEGIN CREATE TABLE follow_b AS
SELECT *
FROM follow;
CREATE TABLE historia_b AS
SELECT *
FROM historia;
CREATE TABLE missatge_b AS
SELECT *
FROM missatge;
CREATE TABLE publicacio_b AS
SELECT *
FROM publicacio;
CREATE TABLE resposta_b AS
SELECT *
FROM resposta;
CREATE TABLE r_reenv_b AS
SELECT *
FROM r_reenv;
CREATE TABLE usuari_b AS
SELECT *
FROM usuari;
END;
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `follow`
--
CREATE TABLE `follow` (
  `idUserFollower` int(11) NOT NULL,
  `idUserFollowing` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Volcado de datos para la tabla `follow`
--
INSERT INTO `follow` (`idUserFollower`, `idUserFollowing`)
VALUES (5, 6);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `historia`
--
CREATE TABLE `historia` (
  `idHist` int(11) NOT NULL,
  `tipus` tinyint(1) NOT NULL DEFAULT 0,
  `idUser` int(11) NOT NULL,
  `text` char(255) NOT NULL,
  `img` char(255) DEFAULT NULL,
  `data` datetime NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Volcado de datos para la tabla `historia`
--
INSERT INTO `historia` (
    `idHist`,
    `tipus`,
    `idUser`,
    `text`,
    `img`,
    `data`
  )
VALUES (
    9,
    0,
    5,
    'Perros',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bc/Flag_of_France_%281794%E2%80%931815%2C_1830%E2%80%931974%2C_2020%E2%80%93present%29.svg/1200px-Flag_of_France_%281794%E2%80%931815%2C_1830%E2%80%931974%2C_2020%E2%80%93present%29.svg.png',
    '2022-12-17 14:54:04'
  ),
  (
    10,
    0,
    5,
    'Cosas nazis',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bc/Flag_of_France_%281794%E2%80%931815%2C_1830%E2%80%931974%2C_2020%E2%80%93present%29.svg/1200px-Flag_of_France_%281794%E2%80%931815%2C_1830%E2%80%931974%2C_2020%E2%80%93present%29.svg.png',
    '2022-12-17 15:57:21'
  ),
  (
    11,
    0,
    6,
    'Yo chulito',
    'https://i0.wp.com/www.wehuntedthemammoth.com/wp-content/uploads/2016/09/nazicapybara.png?ssl=1',
    '2022-12-17 16:31:47'
  ),
  (
    12,
    0,
    6,
    'Yo chulito',
    'https://i0.wp.com/www.wehuntedthemammoth.com/wp-content/uploads/2016/09/nazicapybara.png?ssl=1',
    '2022-12-17 16:34:58'
  );
--
-- Disparadores `historia`
--
DELIMITER $$ CREATE TRIGGER `after_historia_insert`
AFTER
INSERT ON `historia` FOR EACH ROW begin
INSERT INTO missatge (idUserR, text, idUserE, timeSent, leidoE, leidoR)
SELECT idUserFollower,
  CONCAT(
    "NOVA HISTÒRIA BD201/views/story.php?storyId=",
    new.idHist,
    "&userId=",
    idUserFollower
  ),
  0,
  CURRENT_TIMESTAMP,
  1,
  0
FROM follow
WHERE idUserFollowing = new.idUser;
end $$ DELIMITER;
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `missatge`
--
CREATE TABLE `missatge` (
  `idMsg` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `idUserE` int(11) NOT NULL,
  `idUserR` int(11) NOT NULL,
  `timeSent` datetime DEFAULT NULL,
  `leidoE` tinyint(1) NOT NULL DEFAULT 0,
  `leidoR` tinyint(1) NOT NULL DEFAULT 0
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Volcado de datos para la tabla `missatge`
--
INSERT INTO `missatge` (
    `idMsg`,
    `text`,
    `idUserE`,
    `idUserR`,
    `timeSent`,
    `leidoE`,
    `leidoR`
  )
VALUES (
    61,
    'Hola random',
    6,
    5,
    '2022-12-15 22:36:35',
    1,
    1
  ),
  (62, 'Holaaaa', 5, 6, '2022-12-15 22:41:02', 1, 1),
  (63, 'Hola', 5, 6, '2022-12-15 23:24:00', 1, 1),
  (64, 'bobo', 5, 6, '2022-12-17 13:21:52', 1, 1),
  (65, '16', 0, 5, '2022-12-17 16:31:47', 1, 1),
  (
    66,
    'NOVA HISTÒRIA BD201/views/story.php?storyId=12&userId=5',
    0,
    5,
    '2022-12-17 16:34:58',
    1,
    1
  );
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `publicacio`
--
CREATE TABLE `publicacio` (
  `idPub` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `idHist` int(11) DEFAULT NULL,
  `link` char(255) NOT NULL,
  `text` char(255) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Volcado de datos para la tabla `publicacio`
--
INSERT INTO `publicacio` (
    `idPub`,
    `data`,
    `idHist`,
    `link`,
    `text`,
    `idUser`
  )
VALUES (
    2,
    '2022-12-15 12:34:26',
    NULL,
    'https://thumbs.dreamstime.com/b/perro-de-diablo-37877848.jpg',
    'Modo diablo',
    5
  ),
  (
    6,
    '2022-12-15 12:45:14',
    NULL,
    'https://www.lasfuriasmagazine.com/wp-content/uploads/2022/01/Toby-una-vida-perra.jpg',
    '@Alejandro Medina',
    5
  ),
  (
    7,
    '2022-12-15 12:46:38',
    NULL,
    'https://pbs.twimg.com/media/Ff7OaXmXEAEeSpq.jpg',
    'Hazte una cuco',
    5
  ),
  (
    10,
    '2022-12-15 12:49:38',
    NULL,
    'https://www.boredpanda.com/blog/wp-content/uploads/2020/08/pets-animals-behind-glasses-fb-png__700.jpg',
    'Perro copa',
    5
  ),
  (
    11,
    '2022-12-15 12:49:51',
    NULL,
    'https://static.boredpanda.com/blog/wp-content/uploads/2020/08/pets-animals-behind-glasses-5f2cf741d3762__700.jpg',
    'Perro copa 2',
    5
  ),
  (
    12,
    '2022-12-17 15:00:24',
    9,
    'https://pbs.twimg.com/media/FBiqQM5XEAIh8Mi?format=jpg&name=large',
    'Me',
    5
  ),
  (13, '2022-12-17 15:01:53', 9, '', 'Texto', 5);
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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Volcado de datos para la tabla `resposta`
--
INSERT INTO `resposta` (`idRes`, `text`, `data`, `idUser`, `idPub`)
VALUES (1, 'maricon', '2022-12-17 12:34:35', 6, 11),
  (2, 'Perro copa', '2022-12-17 14:55:08', 5, 10),
  (3, 'Perro', '2022-12-17 14:57:39', 5, 6),
  (4, 'Perro 2', '2022-12-17 14:59:16', 5, 6),
  (5, 'Thats me', '2022-12-17 15:02:04', 5, 12);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `r_reenv`
--
CREATE TABLE `r_reenv` (
  `idUser` int(11) NOT NULL,
  `idPub` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Volcado de datos para la tabla `r_reenv`
--
INSERT INTO `r_reenv` (`idUser`, `idPub`, `data`)
VALUES (5, 6, '2022-12-17 13:59:39'),
  (5, 10, '2022-12-17 15:41:07'),
  (5, 11, '2022-12-17 13:59:13'),
  (6, 10, '2022-12-17 12:34:25'),
  (6, 11, '2022-12-17 12:34:29');
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
  `username` varchar(30) NOT NULL,
  `imagen` varchar(255) DEFAULT 'https://cdn.onlinewebfonts.com/svg/img_162386.png'
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Volcado de datos para la tabla `usuari`
--
INSERT INTO `usuari` (
    `idUser`,
    `nom`,
    `contrasenya`,
    `telefon`,
    `correu`,
    `username`,
    `imagen`
  )
VALUES (
    0,
    'Uibber System',
    'contraseña',
    0,
    '',
    'System',
    'https://drive.google.com/uc?export=view&id=1m29xLDLgmmOcCviT8quBOomm8Gx85b1O'
  ),
  (
    5,
    '111',
    '111',
    111,
    '111',
    '111',
    'https://pbs.twimg.com/media/FBiqQM5XEAIh8Mi?format=jpg&name=large'
  ),
  (
    6,
    'Messi',
    'ganandoMundiales',
    685747563,
    'pequenoganador@barsa.arg',
    'LeonArgento',
    'https://scontent-mad1-1.xx.fbcdn.net/v/t1.6435-9/81553444_831134467309002_5693703170664955904_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=973b4a&_nc_ohc=kDZ_vd3HsOcAX-o9vC1&_nc_ht=scontent-mad1-1.xx&oh=00_AfDxiO5pInIe5bZht-r9xNVrtNUDsmARUWai9yAIJD1vfw&oe=63C52B2A'
  );
--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla `follow`
--
ALTER TABLE `follow`
ADD PRIMARY KEY (`idUserFollower`, `idUserFollowing`),
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
ADD PRIMARY KEY (`idUser`, `idPub`),
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
-- AUTO_INCREMENT de la tabla `historia`
--
ALTER TABLE `historia`
MODIFY `idHist` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 13;
--
-- AUTO_INCREMENT de la tabla `missatge`
--
ALTER TABLE `missatge`
MODIFY `idMsg` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 67;
--
-- AUTO_INCREMENT de la tabla `publicacio`
--
ALTER TABLE `publicacio`
MODIFY `idPub` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 14;
--
-- AUTO_INCREMENT de la tabla `resposta`
--
ALTER TABLE `resposta`
MODIFY `idRes` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 6;
--
-- AUTO_INCREMENT de la tabla `usuari`
--
ALTER TABLE `usuari`
MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 8;
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
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;