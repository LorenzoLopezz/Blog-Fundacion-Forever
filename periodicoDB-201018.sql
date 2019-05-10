-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2018 a las 03:53:23
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `periodico`
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
(3, 5, '#00199800#', 9, '2018-06-23', '2018-07-30', 1),
(4, 3, 'abc456$', 12, '2018-06-30', '2018-07-30', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloqueos`
--

CREATE TABLE `bloqueos` (
  `id_bloqueo` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `description` varchar(2000) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id_comentario`, `id_usuario`, `id_publicacion`, `contenido`, `fecha`) VALUES
(18, 9, 15, 'Comentario de prueba', '2018-07-23 16:06:53'),
(19, 9, 10, 'Hola amiguitos', '2018-09-06 19:28:55'),
(21, 9, 15, 'Hola', '2018-09-23 04:10:49'),
(22, 1, 10, 'Hola', '2018-09-23 04:11:20'),
(26, 1, 13, 'Comentario de invitado', '2018-10-01 06:49:06'),
(29, 13, 13, 'Hola', '2018-10-07 13:42:32');

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
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`id_publicacion`, `titulo`, `bajada`, `contenido`, `banner`, `fuentes`, `categoria`, `fecha`, `actualizacion`, `id_usuario`, `estado`) VALUES
(1, 'Noticia de Prueba', 'Noticia para probar la funcionalidad en la pagina donde se muestra la noticia', '', 'imgs/pics/img2.jpg', '', 'noticia', '2018-06-23 17:11:06', '2018-06-23 17:11:06', 9, 1),
(9, 'sasdasd', 'affdgsg', '\r\n						sgsddgdg. Todo funcionando.', 'imgs/pics/5b385d25.png', 'dsgsdg', 'historia', '2018-07-01 04:48:37', '2018-07-15 02:07:06', 9, 0),
(10, 'safas', 'sdsd', 'asdsds', 'imgs/pics/5b38604b4fd94.jpg', 'dsadsa', 'historia', '2018-07-01 05:02:03', '2018-07-01 05:02:03', 12, 1),
(13, 'Jovenes de ..', 'hdhdfbnbbbbbbbbbbbbbbbbbbbbbbbbbbd th t hr hh th rth trh rthr aregsgdhdfd hdhdfhnd  sgsrh sdfgsdgd  sdgfsdg  hhhhssddsgsdgsghsd.', '<span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; text-align: justify;\">Es un hecho establecido hace demasiado tiempo que un lector se distraerÃ¡ con el contenido del texto de un sitio mientras que mira su diseÃ±o. El punto de usar Lorem Ipsum es que tiene una distribuciÃ³n mÃ¡s o menos normal de las letras, al contrario de usar textos como por ejemplo \"Contenido aquÃ­, contenido aquÃ­\". Estos textos hacen parecerlo un espaÃ±ol que se puede leer. Muchos paquetes de autoediciÃ³n y editores de pÃ¡ginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una bÃºsqueda de \"Lorem Ipsum\" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a travÃ©s de los aÃ±os, algunas veces por accidente, otras veces a propÃ³sito (por ejemplo insertÃ¡ndole humor y cosas por el estilo).</span>\r\n					', 'imgs/pics/5b3acb1035b40.jpg', 'FundaciÃ³n Forever', 'noticia', '2018-07-03 01:02:08', '2018-07-03 01:02:08', 9, 1),
(14, 'Video de despedida 3Âº Salud B', 'Probando inserciÃ³n de video', '\r\n						Bonitos recuerdos amiguitos :c', 'https://dl.dropboxusercontent.com/s/jqtweiicfebbmjk/3%C2%BASaludB2017.mp4?dl=0', 'Yo pues :v', 'noticia', '2018-07-08 03:54:16', '2018-07-24 05:07:59', 9, 0),
(15, 'Nota para probar video 2', 'Al haber insertado el video en formato predefinido por Dropbox, la URL serÃ¡ cambiada por la forma para visualizaciÃ³n.', 'La forma de visualizaciÃ³n no es la mismÃ¡ que la de compartir, ya que una cosa es embeber y otra compartir para abrir en la misma aplicaciÃ³n.', 'https://dl.dropboxusercontent.com/s/nofearyeem9n115/Soda%20Stereo.mp4?dl=0', 'Yo obvio', 'noticia', '2018-07-08 04:20:50', '2018-07-08 04:20:50', 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reaction_coments`
--

CREATE TABLE `reaction_coments` (
  `id_reaction` int(11) NOT NULL,
  `id_comentario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reaction_coments`
--

INSERT INTO `reaction_coments` (`id_reaction`, `id_comentario`, `id_usuario`, `tipo`, `fecha`) VALUES
(2, 22, 9, 1, '2018-09-23 04:11:36'),
(3, 21, 9, 0, '2018-09-23 06:11:20'),
(5, 26, 13, 1, '2018-10-07 13:02:01'),
(6, 29, 9, 1, '2018-10-20 16:25:46'),
(7, 18, 13, 1, '2018-10-21 01:08:01'),
(8, 21, 13, 1, '2018-10-21 01:08:04');

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
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `becado` varchar(2) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `llave` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `foto`, `email`, `password`, `fecha`, `becado`, `role`, `llave`, `estado`) VALUES
(1, 'Invitado', '', '', 'default@forever.com', 'default0000', '2018-07-05 05:13:41', 'No', 1, 0, 1),
(9, 'Lorenzo', 'Lopez', '', 'lorenzolopezdepaz@gmail.com', 'lorenzo1998', '2018-06-23 16:39:04', 'Si', 5, 3, 1),
(12, 'Antonio', 'Caceres', '', 'redactor@gmail.com', 'redactor0000', '2018-06-30 17:19:23', 'Si', 4, 4, 1),
(13, 'Estefany', 'Zelaya', '', 'estefany@gmail.com', 'estefanyylorenzo', '2018-09-23 04:47:43', 'No', 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `id_visita` int(11) NOT NULL,
  `id_publicacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id_visita`, `id_publicacion`, `id_usuario`, `ip`, `fecha`) VALUES
(57, 14, 9, '::1', '2018-07-08 03:07:54'),
(58, 15, 9, '::1', '2018-07-08 04:07:27'),
(60, 10, 9, '::1', '2018-07-08 05:07:22'),
(62, 14, 9, '::1', '2018-07-09 03:07:27'),
(64, 9, 9, '::1', '2018-07-15 02:07:06'),
(66, 14, 9, '::1', '2018-07-18 19:07:42'),
(67, 14, 9, '::1', '2018-07-18 19:07:43'),
(69, 14, 1, '::1', '2018-07-23 15:07:57'),
(70, 10, 1, '::1', '2018-07-23 15:07:58'),
(71, 15, 1, '::1', '2018-07-23 16:07:02'),
(73, 15, 9, '::1', '2018-07-23 16:07:06'),
(74, 14, 9, '::1', '2018-07-24 05:07:56'),
(75, 14, 9, '::1', '2018-07-24 05:07:59'),
(76, 14, 9, '::1', '2018-07-24 05:07:59'),
(77, 14, 9, '::1', '2018-07-24 06:07:00'),
(78, 9, 9, '::1', '2018-09-06 19:09:28'),
(79, 10, 9, '::1', '2018-09-06 19:09:28'),
(80, 1, 9, '::1', '2018-09-06 19:09:36'),
(81, 9, 9, '::1', '2018-09-06 19:09:36'),
(82, 9, 9, '::1', '2018-09-06 19:09:37'),
(83, 9, 9, '::1', '2018-09-06 19:09:38'),
(84, 10, 9, '::1', '2018-09-10 22:09:15'),
(85, 1, 9, '::1', '2018-09-10 22:09:16'),
(86, 15, 9, '::1', '2018-09-23 03:09:34'),
(87, 15, 9, '::1', '2018-09-23 03:09:58'),
(88, 15, 9, '::1', '2018-09-23 03:09:59'),
(89, 15, 9, '::1', '2018-09-23 03:09:59'),
(90, 15, 9, '::1', '2018-09-23 03:09:59'),
(91, 15, 9, '::1', '2018-09-23 04:09:01'),
(92, 15, 9, '::1', '2018-09-23 04:09:10'),
(93, 15, 9, '::1', '2018-09-23 04:09:11'),
(94, 10, 9, '::1', '2018-09-23 04:09:11'),
(95, 10, 9, '::1', '2018-09-23 04:09:13'),
(96, 10, 9, '::1', '2018-09-23 04:09:15'),
(97, 13, 1, '::1', '2018-09-23 04:09:44'),
(98, 15, 9, '::1', '2018-09-23 04:09:45'),
(99, 13, 13, '::1', '2018-09-23 04:09:47'),
(100, 15, 9, '::1', '2018-09-23 04:09:48'),
(101, 13, 9, '::1', '2018-09-23 04:09:48'),
(102, 10, 9, '::1', '2018-09-23 05:09:34'),
(103, 10, 9, '::1', '2018-09-23 05:09:35'),
(104, 10, 9, '::1', '2018-09-23 05:09:35'),
(105, 10, 9, '::1', '2018-09-23 05:09:36'),
(106, 15, 9, '::1', '2018-09-23 05:09:39'),
(107, 10, 9, '::1', '2018-09-23 05:09:40'),
(108, 15, 9, '::1', '2018-09-23 06:09:11'),
(109, 15, 9, '::1', '2018-09-23 06:09:11'),
(110, 13, 9, '::1', '2018-09-23 06:09:49'),
(111, 15, 13, '::1', '2018-09-23 06:09:52'),
(112, 13, 13, '::1', '2018-09-23 06:09:52'),
(113, 13, 13, '::1', '2018-09-23 06:09:52'),
(114, 13, 13, '::1', '2018-09-23 06:09:53'),
(115, 13, 13, '::1', '2018-09-23 06:09:53'),
(116, 13, 13, '::1', '2018-09-27 21:09:53'),
(117, 13, 13, '::1', '2018-09-27 21:09:56'),
(118, 13, 13, '::1', '2018-09-27 22:09:01'),
(119, 13, 13, '::1', '2018-09-27 22:09:01'),
(120, 13, 13, '::1', '2018-10-01 06:10:50'),
(121, 13, 13, '::1', '2018-10-01 06:10:52'),
(122, 13, 13, '::1', '2018-10-01 06:10:55'),
(123, 13, 13, '::1', '2018-10-01 06:10:56'),
(124, 13, 13, '::1', '2018-10-01 06:10:58'),
(125, 13, 13, '::1', '2018-10-01 06:10:59'),
(126, 13, 13, '::1', '2018-10-01 06:10:59'),
(127, 13, 13, '::1', '2018-10-07 12:10:53'),
(128, 13, 13, '::1', '2018-10-07 12:10:53'),
(129, 13, 13, '::1', '2018-10-07 12:10:55'),
(130, 13, 13, '::1', '2018-10-07 12:10:56'),
(131, 13, 13, '::1', '2018-10-07 12:10:57'),
(132, 13, 13, '::1', '2018-10-07 13:10:00'),
(133, 13, 13, '::1', '2018-10-07 13:10:04'),
(134, 13, 13, '::1', '2018-10-07 13:10:04'),
(135, 13, 13, '::1', '2018-10-07 13:10:05'),
(136, 13, 13, '::1', '2018-10-07 13:10:07'),
(137, 13, 13, '::1', '2018-10-07 13:10:08'),
(138, 13, 13, '::1', '2018-10-07 13:10:08'),
(139, 13, 13, '::1', '2018-10-07 13:10:09'),
(140, 13, 13, '::1', '2018-10-07 13:10:11'),
(141, 13, 13, '::1', '2018-10-07 13:10:35'),
(142, 13, 1, '::1', '2018-10-07 13:10:36'),
(143, 13, 1, '::1', '2018-10-07 13:10:36'),
(144, 13, 1, '::1', '2018-10-07 13:10:36'),
(145, 13, 1, '::1', '2018-10-07 13:10:36'),
(146, 13, 1, '::1', '2018-10-07 13:10:41'),
(147, 13, 1, '::1', '2018-10-07 13:10:41'),
(148, 13, 13, '::1', '2018-10-07 13:10:42'),
(149, 13, 13, '::1', '2018-10-07 13:10:44'),
(150, 13, 13, '::1', '2018-10-20 05:10:54'),
(151, 13, 13, '::1', '2018-10-20 05:10:57'),
(152, 13, 13, '::1', '2018-10-20 05:10:58'),
(153, 1, 13, '::1', '2018-10-20 06:10:01'),
(154, 13, 9, '::1', '2018-10-20 16:10:25'),
(155, 13, 9, '::1', '2018-10-20 16:10:25'),
(156, 9, 9, '::1', '2018-10-20 16:10:46'),
(157, 13, 13, '::1', '2018-10-20 17:10:14'),
(158, 13, 13, '::1', '2018-10-21 00:10:20'),
(159, 13, 13, '::1', '2018-10-21 01:10:01'),
(160, 15, 13, '::1', '2018-10-21 01:10:07');

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
  MODIFY `id_bloqueo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `id_publicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `reaction_coments`
--
ALTER TABLE `reaction_coments`
  MODIFY `id_reaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id_reporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

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
