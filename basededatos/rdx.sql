-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-08-2024 a las 00:29:27
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rdx`
--
use `rdx`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(12) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE `countries` (
  `id_country` int(12) UNSIGNED NOT NULL,
  `name` varchar(80) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id_country`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Uruguay', '2024-08-25 15:42:37', '2024-08-25 15:42:37'),
(2, 'Pakistan', '2005-10-01 19:03:35', '2008-07-29 18:46:44'),
(3, 'Guatemala', '2001-05-15 23:55:14', '2017-06-06 19:59:51'),
(4, 'Somalia', '1975-01-05 09:26:24', '1989-10-09 05:32:08'),
(5, 'Latvia', '2009-06-21 12:18:15', '2018-11-24 03:49:39'),
(6, 'Eritrea', '1978-08-02 11:02:34', '2008-09-12 02:30:45'),
(7, 'Niger', '2002-05-25 09:47:26', '2016-10-19 18:21:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id_group` int(12) UNSIGNED NOT NULL,
  `name_group` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id_group`, `name_group`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', '2024-08-25 15:42:37', '2024-08-25 15:42:37'),
(2, 'Jefe', '2024-08-25 15:42:37', '2024-08-25 15:42:37'),
(3, 'Sub-Jefe', '2024-08-25 15:42:37', '2024-08-25 15:42:37'),
(4, 'Auditor', '2024-08-25 15:42:37', '2024-08-25 15:42:37'),
(5, 'Usuario', '2024-08-25 15:42:37', '2024-08-25 15:42:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(338, '2024-08-06-215636', 'App\\Database\\Migrations\\Countries', 'default', 'App', 1724611339, 1),
(339, '2024-08-06-221142', 'App\\Database\\Migrations\\Groups', 'default', 'App', 1724611339, 1),
(340, '2024-08-06-221253', 'App\\Database\\Migrations\\Users', 'default', 'App', 1724611339, 1),
(342, '2024-08-10-130608', 'App\\Database\\Migrations\\Categories', 'default', 'App', 1724611339, 1),
(345, '2024-08-22-233038', 'App\\Database\\Migrations\\Productos', 'default', 'App', 1724611339, 1);

-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(12) UNSIGNED NOT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `nombre` varchar(120) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` double(13,2) NOT NULL,
  `stock` int(9) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `descripcion`, `precio`, `stock`, `imagen`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '24021742032351', 'Tobilleras', '24021742032351_SGR-T1R-M_MOLD-KING', 790.00, 10, '1724596487_d05dadfe937208448e4f.jpg', '2024-08-25 15:42:27', '2024-08-25 15:42:27', NULL),
(2, '24034569094602', 'Vendas Wrap', '24034569094602_HWC-RBU_RED-BLACK-BLUE_HAND-WRAP_COMBO', 500.00, 12, '1724596552_1c574dd881f0375da595.jpg', '2024-08-25 15:42:27', '2024-08-25 15:42:27', NULL),
(3, '23112484498195', 'Guantes de 14 Oz', '23112484498195_BGR_F7R_14OZ_RED_BOXING', 790.00, 12, '1724596639_c47141c4eb7b216fb50f.jpg', '2024-08-25 15:42:27', '2024-08-25 15:42:27', NULL),
(4, '23104017659697', 'Guantes de 16 Oz Azul', '23104017659697_BGR-F7U-16OZ_BLUE_BOXING', 790.00, 9, '1724596798_6c9736c4e40e614757c3.jpg', '2024-08-25 15:42:27', '2024-08-25 15:42:27', NULL),
(5, '2310273434303', 'Guantes de 16 Oz Dorado', '2310273434303_BGR-F7GL_16OZ_GOLDEN_BOXING', 790.00, 10, '1724596877_d023620028bc554bdf32.jpg', '2024-08-25 15:42:27', '2024-08-25 15:42:27', NULL),
(6, '602711', 'Guantes Junior ROJO', '602711_189763_BMR-1R', 600.00, 10, '1724596963_a123764543b9097133ef.jpg', '2024-08-25 15:42:27', '2024-08-25 15:42:27', NULL),
(7, '2401554623714', 'Guantes 14Oz Azul', '2401554623714_BGR-F6MU-14OZ_BLUE', 700.00, 10, '1724600259_2185c281302283679a51.jpg', '2024-08-25 15:42:27', '2024-08-25 15:42:27', NULL),
(8, '23102734343032', 'Guantes 16Oz Amarillo', '23102734343032_BGR-F7GL-16OZ_GOLDEN', 700.00, 10, '1724600380_e5785e5d493f31d43815.jpg', '2024-08-25 15:42:27', '2024-08-25 15:42:27', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(12) UNSIGNED NOT NULL,
  `username` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group` int(12) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `group`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrador', 'admin@gmail.com', '$2y$10$co4Z954hSAd44FXVnpDWBeS.lLBXfdQiir9PlOtuPVeGaCmq/DjUG', 1, '2024-08-25 15:42:37', '2024-08-25 15:42:37', NULL),
(2, 'Humberto Adams', 'jon.windler@gmail.com', '$2y$10$fV3gQpokTix/CDP/slJEVuH77V/E/KmFrKV3SJeDty2RCT/kLPBZu', 5, '1974-02-22 04:55:30', '2023-09-12 23:16:16', NULL),
(3, 'Ms. Janie Wolf Sr.', 'adriel32@stoltenberg.biz', '$2y$10$nfpoW03UIyTHXIO3IgmFn.t2PXrTxrzaRXpSJoJ72myGv6QB2XKP6', 5, '2017-10-20 15:04:16', '2021-10-05 17:52:30', NULL),
(4, 'Vernice Weimann Jr.', 'evan66@gmail.com', '$2y$10$2T4zFWIc4eNUQ8M4cm4fLexLHd3LjfrZ7S67toNEhOQxybNucEFZy', 5, '2021-08-31 18:12:30', '2022-04-12 09:52:19', NULL),
(5, 'Israel Hegmann', 'sawayn.florida@jakubowski.org', '$2y$10$wqi71/gmrJ59K5qh6KPuYOw4SzQriQRX//QFixfLLOEBDbHpKJbnG', 5, '2022-10-24 09:35:34', '2024-05-06 23:39:21', NULL),
(6, 'Milford Jast I', 'louisa18@hotmail.com', '$2y$10$FDcKsyVEZMsp94VzGE3VS.K2Duv6yAPAPRf9ZzHWdxtES68Y1SANC', 5, '2019-09-21 07:14:05', '2022-10-28 02:41:55', NULL),
(7, 'Mr. Filiberto Herzog Jr.', 'kristin70@konopelski.com', '$2y$10$ecLuVtb3G62mSgvoXQxHAOH/8zZFPp8ik/wWzIyVfon..L8eqvxSG', 5, '1999-06-12 09:42:26', '2003-01-20 06:29:36', NULL),
(8, 'Brandy Schroeder', 'mckenzie.octavia@murazik.com', '$2y$10$IGRCPCFJliEjhmLzzovEwOk9b4JWppOAaWh.yFdRasZKRqeeoXqqK', 5, '2015-06-13 00:12:48', '2024-02-02 08:39:35', NULL),
(9, 'Valerie Klocko', 'dsauer@schneider.com', '$2y$10$GB.OAJ045CcvtVEBmD0ucugZhZaZHtvTiKblkYeC7Rxw.lfW9nxda', 5, '1985-03-13 02:10:03', '2012-02-15 05:38:42', NULL),
(10, 'Libbie Gaylord Sr.', 'kfisher@satterfield.org', '$2y$10$OIk.OdiJQVbw2FNlgXv.7Or0dRa6ikS38WLixcGCxQzvdEqUTCV7e', 5, '1993-11-14 06:29:19', '2004-09-08 06:32:40', NULL),
(11, 'Freda Sawayn I', 'ylarkin@heidenreich.com', '$2y$10$P9F7JPqKUo7gVpSosVp3zOsiZpaufNafe5dNlk7Ghktb0UcVk28Eq', 5, '1976-05-08 16:45:07', '1977-03-26 01:24:55', NULL);

-- --------------------------------------------------------
--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id_country`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id_group`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `id_country` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id_group` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=346;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;


COMMIT;
*/

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
