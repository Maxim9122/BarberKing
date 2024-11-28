-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2024 a las 13:44:23
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `barberiaking`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` int(10) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `descripcion`) VALUES
(1, 'Indumentaria'),
(2, 'Calzados'),
(3, 'Accesorios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(10) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `telefono` int(10) NOT NULL,
  `foto` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `telefono`, `foto`) VALUES
(1, 'Anonimo', 1234567900, ''),
(2, 'Eduardo', 1234567890, ''),
(3, 'Marcelo', 1234567890, ''),
(4, 'Edis', 1234567890, ''),
(5, 'Luis Paragua', 1234567700, '1731694154_6d6c1f2e7f1168b01dd3.jpg'),
(17, 'Pedro Jara', 1234567770, ''),
(20, 'Roberto', 1254897125, ''),
(21, 'Tonga', 2147483647, ''),
(1005, 'Alejandro', 1234568975, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `descripcion`) VALUES
(1, 'admin'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `categoria_id` int(10) DEFAULT NULL,
  `precio` double(255,0) NOT NULL,
  `precio_vta` double(255,0) NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_min` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `eliminado` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `categoria_id`, `precio`, `precio_vta`, `stock`, `stock_min`, `imagen`, `eliminado`) VALUES
(1, 'Whall Pro', 'La mejor makina.', 1, 1460, 1900, 0, 6, '1731680494_1694956908179456422c.jpeg', 'NO'),
(2, 'Hugo Boss Perfume', 'Calidad Premium', 2, 700, 1200, 4, 6, '1731680689_0e9a85d48899eb849100.jpg', 'NO'),
(3, 'Invictus', 'Alta calidad', 2, 1200, 2000, 6, 3, '1731680721_a2543f3c4bd4dd1b3ab9.jpg', 'NO'),
(4, 'Patillera Whall', 'Patillera chica', 1, 2000, 4000, 13, 5, '1731680540_13bcd449c7f466d935b8.jpg', 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servi` int(5) NOT NULL,
  `descripcion` varchar(15) NOT NULL,
  `precio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servi`, `descripcion`, `precio`) VALUES
(1, 'Degrade', 5000),
(2, 'Corte Clasico', 4500),
(3, 'Degrade + Barba', 6000),
(4, 'Barba', 3000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id` int(10) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `id_barber` int(10) NOT NULL,
  `id_servi` varchar(30) NOT NULL,
  `fecha_registro` varchar(20) NOT NULL,
  `fecha_turno` varchar(20) NOT NULL,
  `hora_turno` varchar(20) NOT NULL,
  `estado` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `id_cliente`, `id_barber`, `id_servi`, `fecha_registro`, `fecha_turno`, `hora_turno`, `estado`) VALUES
(1, 1, 2, '1', '14-11-2024', '15-11-2024', '23:30', 'Listo'),
(9, 20, 2, '1', '21-11-2024', '21-11-2024', '00:17', 'Cancelado'),
(10, 21, 2, '2', '21-11-2024', '21-11-2024', '22:05', 'Cancelado'),
(14, 21, 2, '4', '22-11-2024', '22-11-2024', '15:01', 'Cancelado'),
(16, 5, 2, '2', '22-11-2024', '22-11-2024', '16:01', 'Listo'),
(19, 1, 2, '1', '23-11-2024', '22-11-2024', '15:21', 'Listo'),
(20, 5, 2, '3', '23-11-2024', '23-11-2024', '15:30', 'Listo'),
(21, 5, 2, '2', '23-11-2024', '23-11-2024', '14:47', 'Cancelado'),
(22, 1, 1, '2', '24-11-2024', '24-11-2024', '13:37', 'Cancelado'),
(23, 1005, 2, '1', '24-11-2024', '24-11-2024', '19:58', 'Listo'),
(24, 1, 2, '1', '24-11-2024', '24-11-2024', '20:58', 'Cancelado'),
(25, 2, 2, '4', '25-11-2024', '25-11-2024', '17:21', 'Listo'),
(26, 5, 2, '2', '25-11-2024', '25-11-2024', '20:25', 'Cancelado'),
(27, 4, 2, '2', '25-11-2024', '25-11-2024', '17:28', 'Cancelado'),
(28, 1, 2, '1', '25-11-2024', '25-11-2024', '17:30', 'Cancelado'),
(29, 1, 2, '1', '25-11-2024', '25-11-2024', '17:33', 'Cancelado'),
(30, 1, 2, '1', '25-11-2024', '25-11-2024', '17:35', 'Cancelado'),
(31, 1, 2, '1', '25-11-2024', '25-11-2024', '17:38', 'Cancelado'),
(32, 1, 2, '1', '25-11-2024', '25-11-2024', '17:42', 'Cancelado'),
(33, 1, 2, '1', '25-11-2024', '25-11-2024', '17:42', 'Cancelado'),
(34, 1, 2, '1', '25-11-2024', '25-11-2024', '17:43', 'Cancelado'),
(35, 1, 2, '1', '25-11-2024', '25-11-2024', '17:44', 'Cancelado'),
(36, 1, 2, '1', '25-11-2024', '25-11-2024', '20:10', 'Listo'),
(37, 1, 2, '1', '25-11-2024', '25-11-2024', '21:11', 'Cancelado'),
(38, 1, 2, '1', '25-11-2024', '25-11-2024', '20:34', 'Listo'),
(39, 1, 3, '2', '25-11-2024', '25-11-2024', '21:14', 'Listo'),
(40, 2, 2, '3', '25-11-2024', '26-11-2024', '09:30', 'Cancelado'),
(41, 2, 1, '3', '25-11-2024', '25-11-2024', '23:07', 'Listo'),
(42, 5, 2, '2', '25-11-2024', '27-11-2024', '22:57', 'Pendiente'),
(43, 1, 2, '1', '25-11-2024', '25-11-2024', '23:02', 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(10) NOT NULL,
  `mensaje` varchar(300) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `visitante` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `mensaje`, `estado`, `visitante`) VALUES
(7, 'Maxim', 'kkeelingo_a369s@hxsni.com', 4545668, 'Hola kase', 'Pendiente', 'Si'),
(13, 'Lukitas', 'Lukais@gmail.com', 45468465, 'Esta ves si vamos a tomar algo boló.', 'Pendiente', 'No'),
(18, 'Edis', 'eledis@gmail.com', 1234567890, 'hola', 'Pendiente', 'No');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` int(10) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `perfil_id` int(11) NOT NULL DEFAULT 2,
  `baja` varchar(20) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `telefono`, `direccion`, `email`, `pass`, `perfil_id`, `baja`) VALUES
(1, 'Pablo', 'Cañete', 1234567890, 'Pedro esnaola 5335', 'canetepablo@gmail.com', '$2y$10$IMT0n1eJ77oG9fFzBdU4meLMJuoYiYq7pmgTbUNIHEo34pUn4ehAq', 1, 'NO'),
(2, 'Barber Luciano', 'King', 2147483647, 'Barberia King', 'BarberiaKing@gmail.com', '$2y$10$YnarWkyA.kcom.N4zJHLc.pdEaQMdkDSiQPk1mX2n0zhiCez3bS.m', 2, 'NO'),
(3, 'Barber Cristian', 'Luna', 2147483647, 'rut 5', 'canetepablo@gmail.com', '$2y$10$7oVsAdMdQV5xDAxJmEQ37OHZ3b.N6OLP1VVYaxvl1w.df7NFHsf.e', 2, 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_cabecera`
--

CREATE TABLE `ventas_cabecera` (
  `id` int(10) NOT NULL,
  `fecha` varchar(10) NOT NULL,
  `hora` varchar(10) NOT NULL,
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `total_venta` double(10,2) NOT NULL,
  `tipo_pago` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas_cabecera`
--

INSERT INTO `ventas_cabecera` (`id`, `fecha`, `hora`, `id_cliente`, `total_venta`, `tipo_pago`) VALUES
(34, '25-11-2024', '21:19:41', 1, 2400.00, 'Efectivo'),
(35, '25-11-2024', '23:40:53', 1, 3200.00, 'Transferencia'),
(36, '25-11-2024', '23:43:35', 1, 4000.00, 'Efectivo'),
(33, '24-11-2024', '13:50:20', 1, 2000.00, 'Transferencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE `ventas_detalle` (
  `id` int(10) NOT NULL,
  `venta_id` int(10) UNSIGNED NOT NULL,
  `producto_id` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL,
  `precio` double(10,2) UNSIGNED NOT NULL,
  `total` double(10,2) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas_detalle`
--

INSERT INTO `ventas_detalle` (`id`, `venta_id`, `producto_id`, `cantidad`, `precio`, `total`) VALUES
(42, 36, 4, 1, 4000.00, 4000.00),
(41, 35, 3, 1, 2000.00, 2000.00),
(40, 35, 2, 1, 1200.00, 1200.00),
(39, 34, 2, 2, 1200.00, 2400.00),
(38, 33, 3, 1, 2000.00, 2000.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servi`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_clientes` (`id_cliente`),
  ADD KEY `id_barber` (`id_barber`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perfil_id` (`perfil_id`);

--
-- Indices de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1006;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD CONSTRAINT `turnos_ibfk_2` FOREIGN KEY (`id_barber`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `turnos_ibfk_3` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
