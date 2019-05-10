-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-05-2019 a las 06:15:33
-- Versión del servidor: 10.3.14-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id6267900_periodico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adminkeys`
--

CREATE TABLE `adminkeys` (
  `id_key` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `llave` varchar(20) NOT NULL,
  `propietario` int(11) NOT NULL,
  `fecha_activacion` date NOT NULL,
  `fecha_renovacion` date NOT NULL,
  `estado` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `adminkeys`
--

INSERT INTO `adminkeys` (`id_key`, `role`, `llave`, `propietario`, `fecha_activacion`, `fecha_renovacion`, `estado`) VALUES
(3, 5, '#00199800#', 9, '2018-06-23', '2018-07-30', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloqueos`
--

CREATE TABLE `bloqueos` (
  `id_bloqueo` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `description` varchar(2000) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modificado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id_comentario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_publicacion` int(11) NOT NULL,
  `contenido` varchar(2000) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id_comentario`, `id_usuario`, `id_publicacion`, `contenido`, `fecha`) VALUES
(1, 1, 16, 'Hola', '2018-11-29 22:44:35'),
(2, 1, 16, 'Hola', '2018-11-29 22:44:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE `publicacion` (
  `id_publicacion` int(11) NOT NULL,
  `titulo` varchar(60) DEFAULT NULL,
  `bajada` varchar(300) DEFAULT NULL,
  `contenido` mediumtext NOT NULL,
  `banner` varchar(400) DEFAULT NULL,
  `fuentes` varchar(1000) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `actualizacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`id_publicacion`, `titulo`, `bajada`, `contenido`, `banner`, `fuentes`, `categoria`, `fecha`, `actualizacion`, `id_usuario`, `estado`) VALUES
(15, 'NOTA DE PRUEBA', 'Somos jÃ³venes con un solo objetivo: Integrar a grandes y pequeÃ±os, ricos y pobres, sin ningÃºn tipo de excepciÃ³n.', '<p><strong>La uni&oacute;n hace la fuerza</strong> y mientras nos mantengamos de pie, la lucha no cesar&aacute; jam&aacute;s.</p>\r\n', 'imgs/pics/5bda8bab78556.jpg', 'FundaciÃ³n Forever', 'noticia', '2018-11-01 05:14:19', '2018-11-01 05:14:19', 9, 0),
(16, 'FUNDACIÓN FOREVER EN UNIVERSIDAD POLITÉCNICA', 'Fundación Forever se presentó para motivar a las personas a formar parte de la Cultura de la Integración.', '<p>Tras la celebraci&oacute;n de uno de los eventos m&aacute;s grandes del a&ntilde;o de la Universidad Polit&eacute;cnica de El Salvador,&nbsp;Fundaci&oacute;n Forever se present&oacute; para motivar a las personas a formar parte de la Cultura de la Integraci&oacute;n a trav&eacute;s de las redes sociales.</p>\r\n\r\n<p>Hoy en d&iacute;a las redes sociales forman una gran parte del &eacute;xito de muchas entidades, por &eacute;sta misma raz&oacute;n los j&oacute;venes integrantes de Fundaci&oacute;n Forever se han hecho presentes para generar una mayor cantidad de seguidores en las redes sociales, adem&aacute;s de informar a m&aacute;s personas sobre lo que se trata la cultura de la integraci&oacute;n.</p>\r\n\r\n<p><em>La integraci&oacute;n se hace construyendo con el otro.</em> <strong>Alejandro Gutman.</strong></p>\r\n\r\n<p>M&aacute;s fotos sobre el evento:</p>\r\n\r\n<p><img alt=\"\" src=\"https://dl.dropboxusercontent.com/s/zkjp1czxxvne1be/img1.jpeg?dl=0\" style=\"width:100%\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://dl.dropboxusercontent.com/s/rimjmha09wk6nz4/img2.jpeg?dl=0\" style=\"width:100%\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://dl.dropboxusercontent.com/s/od8ylgntpbhtz64/img3.jpeg?dl=0\" style=\"width:100%\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://dl.dropboxusercontent.com/s/ilk202hm3f2o26z/img4.jpeg?dl=0\" style=\"width:100%\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n', 'imgs/pics/5be4cfb344282.jpeg', 'Fundación Forever', 'noticia', '2018-11-09 00:07:15', '2018-11-09 17:11:31', 9, 1),
(17, '10 DE NOVIEMBRE, FACEBOOK LIVE CON ALEJANDRO GUTMAN', '8:00 pm a través de la Red Social más grande del mundo, Facebook Live.', '<p>Alejandro Gutman, se dirige en directo esta ma&ntilde;ana, a las familias salvadore&ntilde;as para exponerles los beneficios de la cultura de la Integraci&oacute;n.</p>\r\n\r\n<p>En la transmisi&oacute;n ofrece las maravillas que la cultura de la integraci&oacute;n puede llegar a hacer, actuando juntos por un mismo objetivo.</p>\r\n\r\n<p>Para poder unirte a la gran comunidad de Fundaci&oacute;n Forever te esperamos:</p>\r\n\r\n<p><a href=\"https://www.facebook.com/fundacionforever/\"><img alt=\"\" src=\"https://scontent.fsal1-1.fna.fbcdn.net/v/t1.0-9/13906915_1100944696641645_8427367076071235523_n.png?_nc_cat=105&amp;_nc_ht=scontent.fsal1-1.fna&amp;oh=7b8008ab02dedee3affe0357107e7323&amp;oe=5C70A511\" style=\"float:left; height:75px; margin-left:4px; margin-right:4px; width:75px\" /></a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"https://www.facebook.com/fundacionforever/\" target=\"_blank\">Fundaci&oacute;n Forever</a></p>\r\n', 'imgs/pics/5be681cdd1f5c.jpg', 'Fundación Forever', 'noticia', '2018-11-10 06:59:25', '2018-11-12 02:11:04', 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reaction_coments`
--

CREATE TABLE `reaction_coments` (
  `id_reaction` int(11) NOT NULL,
  `id_comentario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id_reporte` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `reported` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `contenido` mediumtext NOT NULL,
  `respuesta` mediumtext NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`id_reporte`, `tipo`, `reported`, `id_usuario`, `contenido`, `respuesta`, `fecha`, `estado`) VALUES
(1, 2, 16, 9, 'Muy poca información.', '', '2018-11-10 05:58:50', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `vn` int(2) NOT NULL,
  `sa` int(2) NOT NULL,
  `ec_todos` int(2) NOT NULL,
  `an` int(2) NOT NULL,
  `ad_n` int(2) NOT NULL,
  `ct` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_role`, `nombre`, `vn`, `sa`, `ec_todos`, `an`, `ad_n`, `ct`) VALUES
(1, 'usuario', 1, 0, 0, 0, 0, 0),
(2, 'usuarioPremium', 1, 1, 0, 0, 0, 0),
(3, 'redactor', 1, 1, 0, 1, 1, 0),
(4, 'moderador', 1, 1, 1, 0, 1, 0),
(5, 'administrador', 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `apellido` varchar(40) DEFAULT NULL,
  `foto` varchar(500) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `becado` varchar(2) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `tipo_estilo` int(11) NOT NULL,
  `llave` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `foto`, `email`, `password`, `fecha`, `becado`, `role`, `tipo_estilo`, `llave`, `estado`) VALUES
(1, 'Invitado', '', 'imgs/icons/default.png', 'default@forever.com', 'default0000', '2018-07-05 05:13:41', 'No', 1, 1, 0, 1),
(9, 'Lorenzo', 'Lopez', 'imgs/icons/default.png', 'lorenzolopezdepaz@gmail.com', 'lorenzo1998', '2018-06-23 16:39:04', 'Si', 5, 1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `id_visita` int(11) NOT NULL,
  `id_publicacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id_visita`, `id_publicacion`, `id_usuario`, `ip`, `fecha`) VALUES
(78, 15, 9, '::1', '2018-11-01 05:10:15'),
(79, 15, 9, '::1', '2018-11-07 16:11:49'),
(80, 16, 1, '190.86.183.148', '2018-11-08 18:11:08'),
(81, 16, 9, '190.86.183.148', '2018-11-08 18:11:22'),
(82, 16, 1, '186.32.85.10', '2018-11-09 12:11:29'),
(83, 16, 9, '186.32.85.10', '2018-11-09 17:11:18'),
(84, 16, 9, '186.32.85.10', '2018-11-09 17:11:20'),
(85, 16, 9, '186.32.85.10', '2018-11-09 17:11:35'),
(86, 16, 9, '186.32.85.10', '2018-11-09 17:11:36'),
(87, 16, 1, '186.32.85.10', '2018-11-09 17:11:39'),
(88, 16, 1, '186.32.85.10', '2018-11-09 21:11:07'),
(89, 16, 1, '186.32.85.10', '2018-11-09 23:11:57'),
(90, 16, 9, '186.32.85.10', '2018-11-09 23:11:57'),
(91, 16, 9, '186.32.85.10', '2018-11-10 00:11:48'),
(92, 17, 9, '186.32.85.10', '2018-11-10 00:11:59'),
(93, 17, 1, '186.32.85.10', '2018-11-10 01:11:07'),
(95, 16, 1, '186.32.85.10', '2018-11-10 05:11:47'),
(96, 16, 1, '186.32.85.10', '2018-11-10 06:11:29'),
(97, 16, 1, '179.5.17.130', '2018-11-11 11:11:42'),
(98, 17, 1, '179.5.17.130', '2018-11-11 11:11:59'),
(99, 17, 1, '179.5.17.130', '2018-11-11 17:11:54'),
(100, 17, 1, '179.5.17.130', '2018-11-11 20:11:29'),
(101, 16, 9, '186.32.85.10', '2018-11-12 02:11:01'),
(102, 17, 9, '186.32.85.10', '2018-11-12 02:11:04'),
(103, 17, 1, '179.5.17.130', '2018-11-12 10:11:06'),
(104, 17, 1, '179.5.17.130', '2018-11-12 11:11:08'),
(105, 16, 1, '92.38.132.148', '2018-11-12 17:11:07'),
(106, 16, 1, '186.32.85.10', '2018-11-13 01:11:34'),
(107, 16, 9, '190.86.183.148', '2018-11-15 09:11:17'),
(108, 16, 1, '170.0.179.31', '2018-12-21 19:12:43'),
(109, 16, 1, '190.62.251.57', '2019-01-07 09:01:26'),
(110, 16, 1, '190.87.40.36', '2019-01-13 07:01:48'),
(111, 16, 1, '179.5.221.249', '2019-02-28 08:02:43'),
(112, 16, 1, '186.32.85.10', '2019-05-10 00:05:08');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adminkeys`
--
ALTER TABLE `adminkeys`
  ADD PRIMARY KEY (`id_key`),
  ADD KEY `role` (`role`,`propietario`),
  ADD KEY `propietario` (`propietario`);

--
-- Indices de la tabla `bloqueos`
--
ALTER TABLE `bloqueos`
  ADD PRIMARY KEY (`id_bloqueo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_publicacion` (`id_publicacion`);

--
-- Indices de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD PRIMARY KEY (`id_publicacion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `reaction_coments`
--
ALTER TABLE `reaction_coments`
  ADD PRIMARY KEY (`id_reaction`),
  ADD KEY `id_comentario` (`id_comentario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id_reporte`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `role` (`role`),
  ADD KEY `role_2` (`role`),
  ADD KEY `llave` (`llave`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id_visita`),
  ADD KEY `id_publicacion` (`id_publicacion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adminkeys`
--
ALTER TABLE `adminkeys`
  MODIFY `id_key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `bloqueos`
--
ALTER TABLE `bloqueos`
  MODIFY `id_bloqueo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `id_publicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `reaction_coments`
--
ALTER TABLE `reaction_coments`
  MODIFY `id_reaction` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id_reporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adminkeys`
--
ALTER TABLE `adminkeys`
  ADD CONSTRAINT `adminkeys_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `adminkeys_ibfk_2` FOREIGN KEY (`propietario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `bloqueos`
--
ALTER TABLE `bloqueos`
  ADD CONSTRAINT `bloqueos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_publicacion`) REFERENCES `publicacion` (`id_publicacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD CONSTRAINT `publicacion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `reaction_coments`
--
ALTER TABLE `reaction_coments`
  ADD CONSTRAINT `reaction_coments_ibfk_1` FOREIGN KEY (`id_comentario`) REFERENCES `comments` (`id_comentario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reaction_coments_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD CONSTRAINT `visitas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visitas_ibfk_3` FOREIGN KEY (`id_publicacion`) REFERENCES `publicacion` (`id_publicacion`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
