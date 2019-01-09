-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2018 a las 14:36:19
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemamasea`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicas`
--

CREATE TABLE `caracteristicas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_desarrollo` int(10) UNSIGNED NOT NULL,
  `planta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ambiente_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ambiente_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ambiente_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ambiente_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `caracteristicas`
--

INSERT INTO `caracteristicas` (`id`, `id_desarrollo`, `planta`, `ambiente_1`, `ambiente_2`, `ambiente_3`, `ambiente_4`, `created_at`, `updated_at`) VALUES
(1, 1, 'Subsuelo', '14 cocheras', '3 x 1 dormitorio', 'Duplex 2 dormitorios', '7 x dormitoriossgdffd', '2018-11-20 21:34:37', '2018-12-12 17:25:58'),
(2, 1, 'Planta baja', '14 cocheras', 'Local comercial', '6 x 1 dormitorio', '6 x 1 dormitorio', '2018-11-20 21:41:43', '2018-11-28 21:34:02'),
(4, 1, '1° Piso', '6 x 1 dormitorio', 'Duplex 1 dormitorio', 'Monoambiente', 'Duplex 2 dormitorios', '2018-11-20 21:48:26', '2018-11-29 02:42:36'),
(5, 1, '2° Piso', '3 x 1 dormitorio', 'Duplex 2 dormitorios', '2 x Monoambiente', '7 x dormitorios', '2018-11-20 21:49:14', '2018-11-29 02:30:28'),
(6, 2, 'Subsuelo', '14 cocheras', NULL, NULL, NULL, '2018-11-22 19:47:16', '2018-11-22 19:47:16'),
(7, 2, 'Planta baja', '14 cocheras', 'Local comercial', NULL, NULL, '2018-11-22 19:48:10', '2018-11-22 19:48:10'),
(9, 1, '3er piso', '6 x 1 dormitorio', 'Duplex 1 dormitorio', '7 x dormitorios', '2 x Monoambientes', '2018-11-29 19:02:39', '2018-11-29 23:52:39'),
(10, 1, '4to Piso', 'dsfad', '7 x dormitorios', '7 x dormitorios', '7 x dormitorios', '2018-11-29 23:57:09', '2018-11-30 18:25:32'),
(16, 3, 'planta baja', 'dsafsdf', 'dasfsd', 'sdafsd', NULL, '2018-12-03 22:32:56', '2018-12-03 22:32:56'),
(17, 3, 'piso 1', 'dsafsdf', 'dasfsd', 'sdafsd', NULL, '2018-12-03 22:33:04', '2018-12-03 22:33:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `condicion`, `created_at`, `updated_at`) VALUES
(1, 'Terminado', 'Estado Terminado', 1, NULL, '2018-11-03 08:36:21'),
(2, 'En Desarrollo', 'Estado en desarrollo', 1, NULL, '2018-11-06 03:05:11'),
(3, 'Proximo Desarrollo', 'Proximo Desarrollo', 1, NULL, '2018-11-19 23:47:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desarrollos`
--

CREATE TABLE `desarrollos` (
  `id` int(10) UNSIGNED NOT NULL,
  `idcategoria` int(10) UNSIGNED NOT NULL,
  `idsubcategoria` int(10) UNSIGNED NOT NULL,
  `direccion` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio_por_metro` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `foto_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_section` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitud` double DEFAULT NULL,
  `longitud` double DEFAULT NULL,
  `detalle_de_entrega` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `desarrollos`
--

INSERT INTO `desarrollos` (`id`, `idcategoria`, `idsubcategoria`, `direccion`, `precio_por_metro`, `descripcion`, `foto_1`, `foto_section`, `latitud`, `longitud`, `detalle_de_entrega`, `condicion`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'RIOJA 3154', '$45.000m', 'Edificio de planta baja y 5 pisos con ascensor. Terrazas exclusivas y de uso común con parrilleros.', NULL, NULL, -32.942467345, -60.66656332453, 'Las puertas principales de ingreso a los departamentos, serán de Láminas de Acero Electrozincadas Inyectadas Lisas, con barral, burlete de goma, y cerradura de seguridad. Las puertas interiores del departamento serán puertas placas de gua-tambú y llevarán pintura semi-mate color blanco. Las carpinterías metálicas llevarán la protección anti-óxido y tres manos de pintura sintética. Aberturas con marcos y hojas de aluminio, línea Herrero reforzado, asegurando escuadría y durabilidad. Sobre las paredes de los ambientes se realizará yeso proyectable para interiores, con una terminación lisa, espejada, uniforme y de gran resistencia mecánica. La distribución de agua fría y caliente será con materiales aprobados de primera calidad, termofusión. Los desagües horizontales y verticales serán de PVC Awaduct reforzado. En cada departamento se proveerá como mínimo una boca para TV, portero eléctrico y las instalaciones correspondientes para la colocación de teléfono. Se dejará previsto de una toma de corriente eléctrica especial para la conexión de un Aire Acondicionado en cada ambiente.', 1, '2018-11-20 20:43:35', '2018-11-29 02:28:29'),
(2, 1, 4, 'VERA MUJICA 1254', '$42.000 m', 'Edificio con ascensor - Departamentos de un dormitorio, monoambientes y cocheras. Facilidad de financiación, para empresas, clientes e inversores.', '6.jpg', '3.jpg', -32.9470158, -60.668436, 'A través de nuestro mapa interactivo podrás conocer nuestros desarrollos y su punto de ubicación.', 1, '2018-11-22 19:45:47', '2018-11-22 19:45:47'),
(3, 2, 2, 'dsfgfg', '0456', 'asdfsdfasdfasd', NULL, NULL, 2435345234, 2435345325, 'sfgafdsfasdfafd', 1, '2018-12-03 18:01:45', '2018-12-03 18:01:45'),
(4, 1, 4, 'fdsgdfg', 'dfsgdf', 'dfsgdf', NULL, NULL, 456456, 45656, 'sdgfs', 1, '2018-12-03 22:26:26', '2018-12-03 22:26:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especificaciones`
--

CREATE TABLE `especificaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_desarrollo` int(10) UNSIGNED NOT NULL,
  `Estar_y_Monoambiente` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `banios` text COLLATE utf8mb4_unicode_ci,
  `dormitorios` text COLLATE utf8mb4_unicode_ci,
  `cocinas` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `especificaciones`
--

INSERT INTO `especificaciones` (`id`, `id_desarrollo`, `Estar_y_Monoambiente`, `banios`, `dormitorios`, `cocinas`, `created_at`, `updated_at`) VALUES
(1, 1, 'Se utilizarán pisos de cerámico de alto tránsito de 1ra calidad.', 'Piso y paredes revestidas de cerámico de 1o calidad. Se colocarán artefactos enlozados de primera calidad. Inodoros con descarga tipo mochila, Bidet, Lavatorio (Roca Capea Linea itlaniana) y Griferia FV (ducha, lavatorio y bidet).', 'Carpetas preparadas para recibir piso otante, todo con su correspondiente zócalo de 1⁄2” x 3”. Frente de placard de melamina blanca 18mm y kit de aluminio para sistema corredizo.', 'Revestimiento cerámico. Se entregará con cocina, de marca acreditada. Las piletas serán de acero inoxidable JOHNSON con grifería Mono-comando FV. Se proveerán muebles de cocina de amplias comodidades, de melamina color blanco y perfil de aluminio anodizado tipo “J”, y mesadas a medida con zócalo de Granito Gris Perla.', '2018-11-20 21:33:17', '2018-11-29 02:29:09'),
(2, 2, 'Se utilizarán pisos de cerámico de alto tránsito de 1ra calidad.', 'Piso y paredes revestidas de cerámico de 1o calidad. Se colocarán artefactos enlozados de primera calidad. Inodoros con descarga tipo mochila, Bidet, Lavatorio (Roca Capea Linea itlaniana) y Griferia FV (ducha, lavatorio y bidet).', 'Carpetas preparadas para recibir piso otante, todo con su correspondiente zócalo de 1⁄2” x 3”. Frente de placard de melamina blanca 18mm y kit de aluminio para sistema corredizo.', 'Revestimiento cerámico. Se entregará con cocina, de marca acreditada. Las piletas serán de acero inoxidable JOHNSON con grifería Mono-comando FV. Se proveerán muebles de cocina de amplias comodidades, de melamina color blanco y perfil de aluminio anodizado tipo “J”, y mesadas a medida con zócalo de Granito Gris Perla.', '2018-11-22 19:46:53', '2018-11-22 19:46:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_desarrollo` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`id`, `id_desarrollo`, `nombre`, `foto`, `created_at`, `updated_at`) VALUES
(1, 1, 'Foto Portada', '1543581736.jpeg', NULL, '2018-11-30 15:42:16'),
(2, 1, 'Foto section', '1543581756.png', NULL, '2018-11-30 15:42:36'),
(3, 1, 'Foto 3', '3.jpg', NULL, NULL),
(4, 2, 'Foto Portada', '5.jpg', NULL, NULL),
(5, 2, 'Foto section', '6.jpg', NULL, NULL),
(6, 1, 'Otro Foto', '1543581796.jpeg', '2018-11-30 15:43:16', '2018-11-30 15:43:16'),
(7, 1, 'foto section 2', '1543591630.jpeg', '2018-11-30 18:24:36', '2018-11-30 18:27:11'),
(8, 1, 'dsfasdfsdasdfasdf', '1543604116.jpeg', '2018-11-30 21:55:16', '2018-11-30 21:55:16'),
(9, 1, 'gdfsgdfsdgfsfdgs', '1544734115.jpeg', '2018-12-13 23:48:36', '2018-12-13 23:48:36'),
(10, 1, '11em etage', '1545140005.png', '2018-12-18 16:33:26', '2018-12-18 16:33:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2018_11_13_161950_create_users_table', 1),
(3, '2018_11_13_162122_create_desarrollos_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantas`
--

CREATE TABLE `plantas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_desarrollo` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plantas`
--

INSERT INTO `plantas` (`id`, `id_desarrollo`, `nombre`, `imagen`, `pdf`, `created_at`, `updated_at`) VALUES
(1, 1, 'Planta 1', '1.jpg', '1.pdf', NULL, NULL),
(2, 1, 'Planta 2', '4.jpg', '2.pdf', NULL, NULL),
(3, 2, 'Planta 1', '6.jpg', '2.pdf', NULL, NULL),
(4, 2, 'Planta 2', '3.jpg', '1.pdf', NULL, NULL),
(5, 1, 'planta 1', '1543587187.png', '1.pdf', '2018-11-30 17:13:08', '2018-11-30 17:13:08'),
(6, 1, 'gfdhgh', '1543592790.png', '1.pdf', '2018-11-30 18:46:30', '2018-11-30 18:46:30'),
(7, 2, 'sdf', '1543600351.png', '1.pdf', '2018-11-30 20:52:31', '2018-11-30 20:52:31'),
(8, 1, 'fdgs', '1543601839.jpeg', '1.pdf', '2018-11-30 21:17:19', '2018-11-30 21:17:19'),
(10, 1, 'asdfasd', '1543607797.png', '1.pdf', '2018-11-30 22:56:37', '2018-11-30 22:56:37'),
(11, 1, 'asdfasd', '1543607842.png', '1.pdf', '2018-11-30 22:57:22', '2018-11-30 22:57:22'),
(13, 4, 'dfsgdfgs', '1543866093.png', NULL, '2018-12-03 22:41:33', '2018-12-03 22:41:33'),
(14, 4, 'gfhjg', '1543868602.png', 'rDKAedrg8O.pdf', '2018-12-03 23:23:22', '2018-12-03 23:23:22'),
(15, 4, 'dfsgf', '1543869123.png', '71ajn2uF0e.pdf', '2018-12-03 23:32:03', '2018-12-03 23:32:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `condicion`) VALUES
(1, 'Administrador', 'Administrador ', 1),
(2, 'Empleado', 'Usuario normal', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `nombre`, `descripcion`, `condicion`, `created_at`, `updated_at`) VALUES
(1, 'Inicio de Obra', 'Inicio de Obra de desarrollo', 1, NULL, '2018-11-19 23:48:00'),
(2, 'Estructura Terminada', 'Estructura Terminada de desarrollo', 1, NULL, NULL),
(3, 'Terminaciones', 'Terminaciones de desarrollo', 1, NULL, NULL),
(4, '', '', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `idrol` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `idrol`, `name`, `usuario`, `password`, `condicion`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Joe', 'jo@masea.com', '$2y$10$hxW.Pt0pnDF0ugbvuUpNyubzqWZ7VABc/8n/6aDduZmYbRaS9sQ2u', 1, '0TKMyKciQRG267ypys4bwo5aw0mdB4n94bPx52LJGdd9kfEPvKWpsETL971e', NULL, NULL),
(2, 1, 'Buri', 'buri@masea.com', '$2y$10$R0VInkbNIFSpR5tS3dOzWetR3SuqkYt2mip6SY58YQuwgp78D9qqW', 1, 'hp9RtSHuNK01eG3jINq6QZXGfJF5Tzo0V3qO4TU5fJf4IAlU52S9fnxwA13I', NULL, NULL),
(3, 2, 'Empleado', 'empleado@masea.com', '$2y$10$UGW8FF7krq0EQ2XO33/WNOz.M06bZ7606ccGobWuOKd1ChuhgqHrq', 1, 'JYHZo9jQgzHvUi3Lbqoe6TsmnBUHTZKDzdFzz1dySoVsG0TLaof0MtJfBROT', NULL, NULL),
(4, 2, 'ale', 'ale@masea.com', '$2y$10$0EHKPk1EC605tzy/10iQYucWp7PCPgjQV89R4hawMI83gm0KmHVEa', 1, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caracteristicas_id_desarrollo_foreign` (`id_desarrollo`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `desarrollos`
--
ALTER TABLE `desarrollos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `desarrollos_direccion_unique` (`direccion`),
  ADD KEY `desarrollos_idcategoria_foreign` (`idcategoria`),
  ADD KEY `desarrollos_idsubcategoria_foreign` (`idsubcategoria`);

--
-- Indices de la tabla `especificaciones`
--
ALTER TABLE `especificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `especificaciones_id_desarrollo_foreign` (`id_desarrollo`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fotos_id_desarrollo_foreign` (`id_desarrollo`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `plantas`
--
ALTER TABLE `plantas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plantas_id_desarrollo_foreign` (`id_desarrollo`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_nombre_unique` (`nombre`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`),
  ADD KEY `users_idrol_foreign` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `desarrollos`
--
ALTER TABLE `desarrollos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `especificaciones`
--
ALTER TABLE `especificaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `plantas`
--
ALTER TABLE `plantas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD CONSTRAINT `caracteristicas_id_desarrollo_foreign` FOREIGN KEY (`id_desarrollo`) REFERENCES `desarrollos` (`id`);

--
-- Filtros para la tabla `desarrollos`
--
ALTER TABLE `desarrollos`
  ADD CONSTRAINT `desarrollos_idcategoria_foreign` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `desarrollos_idsubcategoria_foreign` FOREIGN KEY (`idsubcategoria`) REFERENCES `subcategorias` (`id`);

--
-- Filtros para la tabla `especificaciones`
--
ALTER TABLE `especificaciones`
  ADD CONSTRAINT `especificaciones_id_desarrollo_foreign` FOREIGN KEY (`id_desarrollo`) REFERENCES `desarrollos` (`id`);

--
-- Filtros para la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_id_desarrollo_foreign` FOREIGN KEY (`id_desarrollo`) REFERENCES `desarrollos` (`id`);

--
-- Filtros para la tabla `plantas`
--
ALTER TABLE `plantas`
  ADD CONSTRAINT `plantas_id_desarrollo_foreign` FOREIGN KEY (`id_desarrollo`) REFERENCES `desarrollos` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_idrol_foreign` FOREIGN KEY (`idrol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
