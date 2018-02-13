-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-02-2018 a las 16:58:56
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bootstrap_gallery`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `url_image` varchar(255) NOT NULL,
  `estado` int(1) NOT NULL,
  `orden` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banner`
--

INSERT INTO `banner` (`id`, `titulo`, `descripcion`, `url_image`, `estado`, `orden`) VALUES
(1, 'Sistema Web de Inventario Simple ', 'https://obedalvarado.pw/blog/sistema-inventario-simple-php/', 'simple_stock_php.png', 1, 1),
(2, 'Sistema de FacturaciÃ³n Simple', 'http://obedalvarado.pw/simple-invoice/', 'factura_simple.png', 1, 2),
(17, 'CÃ³mo instalar ionCube Loader en Windows', 'En este tutorial voy a mostrar como instalar ioncube loader en servidor local  con Windows.', 'ioncube-windows.png', 1, 3),
(18, 'Importando datos Excel a una base de datos MySQL c', 'Muchas aplicaciones PHP necesitan procesar archivos Excel, para distintos propÃ³sitos, lo mÃ¡s comÃºn es importar datos desde un archivo e insertarlos en una base de datos.', 'excel_mysql.png', 1, 4),
(19, 'CRUD de datos de empleados con PHP, MySQL y Bootst', 'La creaciÃ³n de un CRUD es una tarea muy comÃºn en el desarrollo web  (CRUD por sus siglas en ingles Create/Read/Update/Delete). ', 'crud_empleados.png', 1, 5),
(20, 'SISTEMA PARA FARMACIAS DESARROLLADO CON PHP â€“ MY', 'El sistema de Inventario para farmacias es un software de oficina de farmacia, que cuenta con un diseÃ±o moderno de respuesta ideal para cualquier tipo de negocio de farmacia.', 'inventario_farmacia.png', 1, 6),
(21, 'Cotizador web de camisetas con PHP', 'En esta ocasiÃ³n quiero compartir un pequeÃ±o script desarrollado en PHP, el cual cumple la funciÃ³n de cotizador web de productos', 'captura_1.png', 1, 7),
(22, 'Sistema de GestiÃ³n de Inventario con PHP', 'El Sistema de GestiÃ³n de Inventario es un proyecto de cÃ³digo abierto (Open Source), desarrollado con PHP, MySQL, Bootstrap y jQuery.', 'sistema_gestion_inventario_php.png', 1, 8);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
