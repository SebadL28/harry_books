-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-07-2018 a las 19:13:14
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `harry_books`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `imagen` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `nombre`, `cantidad`, `precio`, `imagen`, `created_at`, `updated_at`) VALUES
(1, 'Harry Potter y la piedra filosofal', 10, '50000.00', 'libro_01.jpg', NULL, '2018-07-15 01:30:46'),
(2, 'Harry Potter y la cámara secreta', 15, '58000.00', 'libro_02.jpg', NULL, '2018-07-15 01:30:46'),
(3, 'Harry Potter y el prisionero de Azkaban', 6, '60000.00', 'libro_03.jpg', NULL, '2018-07-15 01:48:37'),
(4, 'Harry Potter y el cáliz de fuego', 0, '45000.00', 'libro_04.jpg', NULL, '2018-07-15 01:33:32'),
(5, 'Harry Potter y la Orden del Fénix', 15, '38000.00', 'libro_05.jpg', NULL, NULL),
(6, 'Harry Potter y el misterio del príncipe', 8, '50000.00', 'libro_06.jpg', NULL, NULL),
(7, 'Harry Potter y las Reliquias de la Muerte', 4, '45000.00', 'libro_07.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_ventas`
--

CREATE TABLE `libro_ventas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_resumen_venta` int(10) UNSIGNED NOT NULL,
  `id_libro` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2018_07_14_155427_create_libros_table', 2),
(5, '2018_07_14_193553_create_resumen_ventas_table', 3),
(6, '2018_07_14_194953_create_libro_ventas_table', 4),
(7, '2018_07_14_202113_add_foreign_libro_ventas', 5),
(8, '2018_07_15_102038_add_rol_user', 6);

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
-- Estructura de tabla para la tabla `resumen_ventas`
--

CREATE TABLE `resumen_ventas` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario` int(10) UNSIGNED NOT NULL,
  `fecha` datetime NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `rol`) VALUES
(1, 'Sebas', 'sebas@hotmail.com', '$2y$10$0hTmc3BX4fZjwUHhezIt/.0G45ADqoqx/QNNWZxlso/1ME.2lrBky', 'yDOnKLGpVRzDp63AL35OsIZkQtGBlwFMUf6vdjkoQunMpmHd77kOKCVWM7vN', '2018-07-14 23:05:45', '2018-07-14 23:05:45', 0),
(2, 'Administrador', 'admin@hotmail.com', '$2y$10$Fm8BI15vGZxlNjwlpfo1S.4ZCsPmGVM6HRtpvzf2rrf/cSYANEmd.', 'HDCf1oksGMqlsdcxCobINkq2JA3TmAjWtlo1WkoLa0rmBcp2dYjQsXT3UN7y', '2018-07-15 15:23:00', '2018-07-15 15:23:00', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libro_ventas`
--
ALTER TABLE `libro_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `libro_ventas_id_resumen_venta_foreign` (`id_resumen_venta`),
  ADD KEY `libro_ventas_id_libro_foreign` (`id_libro`);

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
-- Indices de la tabla `resumen_ventas`
--
ALTER TABLE `resumen_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resumen_ventas_usuario_foreign` (`usuario`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `libro_ventas`
--
ALTER TABLE `libro_ventas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `resumen_ventas`
--
ALTER TABLE `resumen_ventas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libro_ventas`
--
ALTER TABLE `libro_ventas`
  ADD CONSTRAINT `libro_ventas_id_libro_foreign` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id`),
  ADD CONSTRAINT `libro_ventas_id_resumen_venta_foreign` FOREIGN KEY (`id_resumen_venta`) REFERENCES `resumen_ventas` (`id`);

--
-- Filtros para la tabla `resumen_ventas`
--
ALTER TABLE `resumen_ventas`
  ADD CONSTRAINT `resumen_ventas_usuario_foreign` FOREIGN KEY (`usuario`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
