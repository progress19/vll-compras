-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-05-2023 a las 10:29:37
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `intranetvll3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `apellido` varchar(128) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `email` varchar(100) NOT NULL,
  `roles` varchar(100) NOT NULL,
  `idSector` bigint(20) NOT NULL,
  `avatar` varchar(128) NOT NULL,
  `ultimologin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `password`, `apellido`, `nombre`, `email`, `roles`, `idSector`, `avatar`, `ultimologin`, `estado`) VALUES
(23, 'holivera', '2903666b04ebd87ae5b372e08b0f0591', 'Olivera', 'Hector', 'holivera@laslenas.com', 'supervisor', 15, '4', '2023-03-25 10:52:51', 1),
(24, 'ltoledo', '995c3c39fad187a0a3615ccb053ef62b', 'Toledo', 'Lucio', 'ltoledo@laslenas.com', 'supervisor', 13, '5', '2023-05-25 11:05:09', 1),
(30, 'jretamal', '19a154d485aa7b28497b515f06482752', 'Retamal', 'Javier', 'jretamal@laslenas.com', 'supervisor-rrhh', 14, '5', '2023-05-25 11:34:34', 1),
(47, 'aleonforte', '0a82eb2809c500070362cebb8bddc05f', 'Leonforte', 'Ariel', 'aleonforte@laslenas.com', 'administrador', 17, '5', '2023-05-25 12:21:03', 1),
(49, 'abandiera', '98df97101a80106d49ad7a551827d1f5', 'Bandiera', 'Alberto', 'abandiera@laslenas.com', 'supervisor', 6, '5', '2023-05-23 13:06:14', 1),
(50, 'root', '21232f297a57a5a743894a0e4a801fc3', 'root', 'root', '', 'administrador', 14, '1', '2023-05-16 14:17:38', 1),
(57, 'Escuela', 'de57c5aeab2f35cee809fe5d00272fe9', 'Pietro', 'Virginia', 'vpietro@laslenas.com', 'supervisor', 19, '2', '2022-10-19 20:07:00', 0),
(64, 'pistas', '4d4f4eedb6bc6223c82bc8afedcc57c9', 'Montaña', 'Seguridad de Pistas', 'jmillar@laslenas.com', 'supervisor', 16, '1', '2023-05-25 11:09:24', 1),
(78, 'boleteria', '82965d4ed8150294d4330ace00821d77', 'Equipo', 'Boleteria', 'boleteria@laslenas.com', 'supervisor', 20, '4', '2022-10-19 20:06:55', 0),
(84, 'jbello', '6a72779c20535bc4408954bb83c844e1', 'Bello', 'Jose', 'jbello@laslenas.com', 'supervisor', 12, '1', '2023-05-25 11:16:31', 1),
(88, 'fdifonso', '253614bbac999b38b5b60cae531c4969', 'Difonso', 'Fernando', 'fdifonso@laslenas.com', 'supervisor', 12, '5', '2022-10-19 20:07:12', 0),
(90, 'gdebiase', 'de594ef5c314372edec29b93cab9d72e', 'De Biase', 'Gisela', 'gdebiase@laslenas.com', 'supervisor', 10, '2', '2022-10-19 20:07:22', 0),
(91, 'hguerrero', '4ebd440d99504722d80de606ea8507da', 'Guerrero', 'Hernan', 'hguerrero@lalenas.com', 'supervisor', 7, '1', '2023-05-17 10:58:30', 1),
(92, 'etoledano', 'c3a690be93aa602ee2dc0ccab5b7b67e', 'Toledano', 'Eduardo', 'etoledano@laslenas.com', 'supervisor', 2, '4', '2023-03-31 18:32:33', 0),
(93, 'jardin', 'bce5862b1ee8f4f844121d5e2895f63f', 'Equipo', 'Jardin', 'jardin@laslenas.com', 'supervisor', 21, '1', '2022-10-19 20:07:31', 0),
(94, 'ggodoy', 'c8cbd669cfb2f016574e9d147092b5bb', 'Gabriel', 'Godoy', 'ggodoy@laslenas.com', 'administrador', 1, '4', '2023-05-23 21:22:51', 1),
(95, 'huesped', '81dc9bdb52d04dc20036dbd8313ed055', 'Equipo', 'Atención al Huésped', 'turismo@laslenas.com', 'supervisor', 18, '1', '2023-02-26 15:22:19', 0),
(96, 'cmesa', '3a824154b16ed7dab899bf000b80eeee', 'Mesa', 'Carlos', 'cmesa@laslenas.com', 'supervisor', 9, '1', '2022-10-19 20:07:36', 0),
(98, 'clobo', '9f5a3ba0bc691f169f46092a6c620b52', 'Lobo', 'Carlos', 'clobo@laslenas.com', 'supervisor-rrhh', 1, '5', '2023-02-01 20:41:38', 1),
(99, 'mrossetti', '1eb46a5b6be8cc81ae663abbeb689996', 'Rossetti', 'Marcelo', 'mrossetti@laslenas.com', 'supervisor', 28, '4', '2023-05-17 21:36:13', 1),
(100, 'erios', 'a148df6fd484a2e2f917e1438d811669', 'RIOS', 'ELIZABETH', 'erios@laslenas.com', 'supervisor', 1, '5', '2023-05-25 10:52:00', 1),
(101, 'ssanz', '4e4dd8a02942f0ab63e7371602fcafb0', 'Sanz', 'Sebastian', 'ssanz@laslenas.com', 'supervisor', 12, '5', '2023-05-22 15:31:43', 1),
(103, 'eolivera', 'b7d5a2fdae51f3313facf9aa57adf6cf', 'Olivera', 'Edgardo', 'eolivera@laslenas.com', 'administrador', 14, '4', '2023-05-24 12:09:37', 1),
(104, 'gmoyano', '4621dd08d8452ad13df5b30b29e5b9b7', 'Moyano', 'Gabriel', 'gmoyano@laslenas.com', 'supervisor', 28, '4', '2023-05-25 11:01:16', 1),
(106, 'prueba', '0a82eb2809c500070362cebb8bddc05f', 'prueba', 'prueba', '', 'supervisor-rrhh', 14, '4', '2023-04-29 19:58:10', 1),
(107, 'msalvarezza', 'a545e672ffe1cd18b5c5040eb16f3917', 'Salvarezza', 'Maria del Carmen', '', 'supervisor', 10, '5', '2023-05-04 19:54:00', 1),
(108, 'mmansilla', '2afce9786d34d6707a902f15c8d1d78a', 'Mansilla', 'Miguel', 'mmansilla@laslenas.com', 'supervisor', 16, '3', '2023-05-25 12:05:23', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
