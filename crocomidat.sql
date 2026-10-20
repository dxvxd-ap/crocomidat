-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-08-2024 a las 02:20:39
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
-- Base de datos: `crocomidat`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `binnacle`
--

CREATE TABLE `binnacle` (
  `ID` int(11) NOT NULL,
  `descriptions` varchar(255) DEFAULT NULL,
  `dates` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `binnacle`
--

INSERT INTO `binnacle` (`ID`, `descriptions`, `dates`) VALUES
(1, 'Nuevo usuario: Gaudencia su correo es: gaude@gmail.com', '2024-08-07'),
(2, 'Registro actualizado del usuario : Daniel con correo: daniel@gmail.com', '2024-08-08'),
(3, 'Nuevo usuario: ace su correo es: ace@gmail.com', '2024-08-08'),
(4, 'Nuevo usuario: jose  su correo es: h@gmail.com', '2024-08-08'),
(5, 'Nuevo local: aka con dirección en:  aakz', '2024-08-08'),
(6, 'Registro actualizado del local : ak con dirección en: 10 a 1', '2024-08-08'),
(7, 'Registro actualizado del local : ak con dirección en: apwjl', '2024-08-08'),
(8, 'Registro actualizado del local : ak con dirección en: apwjl', '2024-08-08'),
(9, 'Registro actualizado del local : ak con dirección en: apwj', '2024-08-08'),
(10, 'Nuevo comentario con ID: 1 con el siguiente mensaje: sdflnl', '2024-08-08'),
(11, 'Registro actualizado del comentario con ID: 1 que contiene el siguiente mensaje: zxhflf', '2024-08-08'),
(12, 'Se eliminó el comentario con ID: 1 que contenía el siguiente mensaje: zxhflf', '2024-08-08'),
(13, 'Nuevo comentario con ID: 2 con el siguiente mensaje: Buenos locales :D', '2024-08-08'),
(14, 'Nuevo local: Croco con dirección en:  UTGZ', '2024-08-08'),
(15, 'Nuevo usuario: Daniela su correo es: daniela@gmail.com', '2024-08-08'),
(16, 'Nuevo local: Crocomidat con dirección en:  Calle Emiliano Zapata', '2024-08-08'),
(17, 'Registro actualizado del local : UTGZZ con dirección en: Calle Emiliano Zapata', '2024-08-08'),
(18, 'Registro actualizado del comentario con ID: 2 que contiene el siguiente mensaje: utgz', '2024-08-08'),
(19, 'Nuevo usuario: jos su correo es: j@gmail.com', '2024-08-08'),
(20, 'Registro actualizado del usuario : Dan con correo: daniela@gmail.com', '2024-08-08'),
(21, 'Se eliminó al usuario: jos con correo: j@gmail.com', '2024-08-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id_cat` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `category`
--
DELIMITER $$
CREATE TRIGGER `CATEGORY_DELETE` AFTER DELETE ON `category` FOR EACH ROW begin insert into 
binnacle (descriptions ,dates)  value (concat( "Se eliminó la categoría con ID: ",old.id_cat," llamada: ",old.name),now());
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `CATEGORY_INSERT` AFTER INSERT ON `category` FOR EACH ROW begin insert into 
binnacle (descriptions ,dates) value (concat("Nueva categoría con ID: ",new.id_cat," llamada:  ",new.name),now());
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `creationdatecm` date DEFAULT NULL,
  `textcomment` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id_comment`, `creationdatecm`, `textcomment`) VALUES
(2, '2024-08-14', 'utgz');

--
-- Disparadores `comments`
--
DELIMITER $$
CREATE TRIGGER `Comments_DELETE` AFTER DELETE ON `comments` FOR EACH ROW begin insert into 
binnacle (descriptions ,dates)  value (concat( "Se eliminó el comentario con ID: ",old.id_comment," que contenía el siguiente mensaje: ",old.textcomment),now());
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Comments_INSERT` AFTER INSERT ON `comments` FOR EACH ROW begin insert into 
binnacle (descriptions ,dates) value (concat("Nuevo comentario con ID: ",new.id_comment," con el siguiente mensaje: ",new.textcomment),now());
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Comments_UPDATE` AFTER UPDATE ON `comments` FOR EACH ROW begin insert into 
binnacle (descriptions ,dates) value (concat("Registro actualizado del comentario con ID: ",new.id_comment," que contiene el siguiente mensaje: ",new.textcomment),now());
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `food_cat`
--

CREATE TABLE `food_cat` (
  `id_fp` int(11) DEFAULT NULL,
  `id_cat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `food_place`
--

CREATE TABLE `food_place` (
  `id_fp` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `schedule` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `food_place`
--

INSERT INTO `food_place` (`id_fp`, `name`, `location`, `schedule`) VALUES
(3, 'UTGZZ', 'Calle Emiliano Zapata', 'Horario de 8 A.M a 8 P.M');

--
-- Disparadores `food_place`
--
DELIMITER $$
CREATE TRIGGER `LOCALES_INSERT` AFTER INSERT ON `food_place` FOR EACH ROW begin insert into 
binnacle (descriptions ,dates) value (concat("Nuevo local: ",new.name," con dirección en:  ",new.location),now());
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `LOCALES_UPDATE` AFTER UPDATE ON `food_place` FOR EACH ROW begin insert into 
binnacle (descriptions ,dates) value (concat("Registro actualizado del local : ",new.name," con dirección en: ",new.location),now());
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `psswd` varchar(255) NOT NULL,
  `rol` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`name`, `email`, `psswd`, `rol`) VALUES
('ace', 'ace@gmail.com', '$2y$10$VeeRW7uoSR.Ou8ZWNGSQO.ceMvTyf3DowrF/URVG18EYbwNWntNWi', NULL),
('Daniel', 'daniel@gmail.com', '$2y$10$hWh7v5iv6K1vhIsSvNUE/.dSY0m19VJQ5I2WiNmatJYhULf72W2iG', '1'),
('Dan', 'daniela@gmail.com', '$2y$10$em7zyotcY4RgTfwagxGr3uy1lT9QOc7HfcohyR6DKvgnpRQY6baIy', '0'),
('Gaudencia', 'gaude@gmail.com', '$2y$10$6mJtPzsK1Q9XlMrVMUGWZej8FRwaVoSXswkmoTYOh/x28bxiXzeSC', NULL),
('jose ', 'h@gmail.com', '248', '1');

--
-- Disparadores `users`
--
DELIMITER $$
CREATE TRIGGER `USUARIO_DELETE` AFTER DELETE ON `users` FOR EACH ROW begin insert into 
binnacle (descriptions ,dates)  value (concat( "Se eliminó al usuario: ",old.name," con correo: ",old.email),now());
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `USUARIO_INSERT` AFTER INSERT ON `users` FOR EACH ROW begin insert into 
binnacle (descriptions ,dates) value (concat("Nuevo usuario: ",new.name," su correo es: ",new.email),now());
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `USUARIO_UPDATE` AFTER UPDATE ON `users` FOR EACH ROW begin insert into 
binnacle (descriptions ,dates) value (concat("Registro actualizado del usuario : ",new.name," con correo: ",new.email),now());
end
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `binnacle`
--
ALTER TABLE `binnacle`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indices de la tabla `food_cat`
--
ALTER TABLE `food_cat`
  ADD KEY `id_fp` (`id_fp`),
  ADD KEY `id_cat` (`id_cat`);

--
-- Indices de la tabla `food_place`
--
ALTER TABLE `food_place`
  ADD PRIMARY KEY (`id_fp`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `binnacle`
--
ALTER TABLE `binnacle`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `food_place`
--
ALTER TABLE `food_place`
  MODIFY `id_fp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `food_cat`
--
ALTER TABLE `food_cat`
  ADD CONSTRAINT `food_cat_ibfk_1` FOREIGN KEY (`id_fp`) REFERENCES `food_place` (`id_fp`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `food_cat_ibfk_2` FOREIGN KEY (`id_cat`) REFERENCES `category` (`id_cat`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
