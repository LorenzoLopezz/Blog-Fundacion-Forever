-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-07-2018 a las 07:46:17
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
(18, 9, 15, 'Comentario de prueba', '2018-07-23 16:06:53');

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
(6, 'Nota 1 de prueba', 'Ã‰ste texto sirve para atraer al cliente desde el principio de la nota.', '<h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px; color: rgb(0, 0, 0);\">Â¿QuÃ© es Lorem Ipsum?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>Â es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estÃ¡ndar de las industrias desde el aÃ±o 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usÃ³ una galerÃ­a de textos y los mezclÃ³ de tal manera que logrÃ³ hacer un libro de textos especimen. No sÃ³lo sobreviviÃ³ 500 aÃ±os, sino que tambien ingresÃ³ como texto de relleno en documentos electrÃ³nicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creaciÃ³n de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y mÃ¡s recientemente con software de autoediciÃ³n, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p>\r\n					', 'imgs/pics/5b37fb0123103abd2.jpg', 'https://es.lipsum.com/', 'noticia', '2018-06-30 21:49:53', '2018-06-30 21:49:53', 12, 0),
(9, 'sasdasd', 'affdgsg', '\r\n						sgsddgdg. Todo funcionando.', 'imgs/pics/5b385d25.png', 'dsgsdg', 'historia', '2018-07-01 04:48:37', '2018-07-15 02:07:06', 9, 1),
(10, 'safas', 'sdsd', 'asdsds', 'imgs/pics/5b38604b4fd94.jpg', 'dsadsa', 'historia', '2018-07-01 05:02:03', '2018-07-01 05:02:03', 12, 1),
(13, 'Jovenes de ..', 'hdhdfbnbbbbbbbbbbbbbbbbbbbbbbbbbbd th t hr hh th rth trh rthr aregsgdhdfd hdhdfhnd  sgsrh sdfgsdgd  sdgfsdg  hhhhssddsgsdgsghsd.', '<span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; text-align: justify;\">Es un hecho establecido hace demasiado tiempo que un lector se distraerÃ¡ con el contenido del texto de un sitio mientras que mira su diseÃ±o. El punto de usar Lorem Ipsum es que tiene una distribuciÃ³n mÃ¡s o menos normal de las letras, al contrario de usar textos como por ejemplo \"Contenido aquÃ­, contenido aquÃ­\". Estos textos hacen parecerlo un espaÃ±ol que se puede leer. Muchos paquetes de autoediciÃ³n y editores de pÃ¡ginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una bÃºsqueda de \"Lorem Ipsum\" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a travÃ©s de los aÃ±os, algunas veces por accidente, otras veces a propÃ³sito (por ejemplo insertÃ¡ndole humor y cosas por el estilo).</span>\r\n					', 'imgs/pics/5b3acb1035b40.jpg', 'FundaciÃ³n Forever', 'noticia', '2018-07-03 01:02:08', '2018-07-03 01:02:08', 9, 0),
(14, 'Prueba para muestra de video', 'Probando inserciÃ³n de video', 'Cuando Ã©sta nota sea subida se darÃ¡ a demostrar que tan pro soy :v', 'https://dl.dropboxusercontent.com/s/jqtweiicfebbmjk/3%C2%BASaludB2017.mp4?dl=0', 'Yo pues :v', 'noticia', '2018-07-08 03:54:16', '2018-07-08 03:54:16', 9, 1),
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
(1, 'Default', 'User', '', 'default@forever.com', 'default0000', '2018-07-05 05:13:41', 'No', 1, 0, 1),
(9, 'Lorenzo', 'Lopez', '', 'lorenzolopezdepaz@gmail.com', 'lorenzo1998', '2018-06-23 16:39:04', 'Si', 5, 3, 1),
(12, 'Antonio', 'Caceres', '', 'redactor@gmail.com', 'redactor0000', '2018-06-30 17:19:23', 'Si', 3, 4, 1);

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
(65, 6, 9, '::1', '2018-07-15 02:07:06'),
(66, 14, 9, '::1', '2018-07-18 19:07:42'),
(67, 14, 9, '::1', '2018-07-18 19:07:43'),
(69, 14, 1, '::1', '2018-07-23 15:07:57'),
(70, 10, 1, '::1', '2018-07-23 15:07:58'),
(71, 15, 1, '::1', '2018-07-23 16:07:02'),
(73, 15, 9, '::1', '2018-07-23 16:07:06');

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
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `id_publicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `reaction_coments`
--
ALTER TABLE `reaction_coments`
  MODIFY `id_reaction` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

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
