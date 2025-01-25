-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 04-12-2024 a las 02:52:08
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tree_database`
--

CREATE DATABASE IF NOT EXISTS `tree_database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tree_database`;

-- --------------------------------------------------------

-- Level 1: Independent tables
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto_perfil` LONGBLOB DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` ENUM('M', 'F', 'O') DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `nombre_usuario` (`nombre_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,  -- Changed from text to varchar
  PRIMARY KEY (`ID`),
  UNIQUE KEY `nombre` (`nombre`(255))  -- Added length specification
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Level 2: Tables with Level 1 dependencies
DROP TABLE IF EXISTS `iniciativas`;
CREATE TABLE `iniciativas` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `descripcion` text DEFAULT NULL,
  `logo` LONGBLOB DEFAULT NULL,
  `cover` LONGBLOB DEFAULT NULL,
  `creador_id` bigint(20) DEFAULT NULL,
  `estado` ENUM('Activa', 'Inactiva') NOT NULL DEFAULT 'Activa',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`),
  KEY `creador_id` (`creador_id`),
  CONSTRAINT `iniciativas_ibfk_1` FOREIGN KEY (`creador_id`) REFERENCES `usuarios` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `iniciativa_id` bigint(20) DEFAULT NULL,
  `autor_id` bigint(20) DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,  -- Changed from text
  `subtitulo` varchar(255) DEFAULT NULL,  -- Changed from text
  `contenido` text NOT NULL,
  `permite_comentarios` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_publicacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`),
  KEY `iniciativa_id` (`iniciativa_id`),
  KEY `autor_id` (`autor_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`iniciativa_id`) REFERENCES `iniciativas` (`ID`),
  CONSTRAINT `posts_ibfk_3` FOREIGN KEY (`autor_id`) REFERENCES `usuarios` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Level 3: Tables with Level 2 dependencies
DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE `comentarios` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) DEFAULT NULL,
  `autor_id` bigint(20) DEFAULT NULL,
  `contenido` text NOT NULL,
  `fecha_comentario` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`),
  KEY `post_id` (`post_id`),
  KEY `autor_id` (`autor_id`),
  CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`ID`),
  CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`autor_id`) REFERENCES `usuarios` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Rest of dependent tables in order...

-- Estructura de tabla para la tabla `actividades`
DROP TABLE IF EXISTS `actividades`;
CREATE TABLE `actividades` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `iniciativa_id` bigint(20) DEFAULT NULL,
  `nombre` text NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `direccion` text NOT NULL,
  `otorga_certificado` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`ID`),
  KEY `iniciativa_id` (`iniciativa_id`),
  CONSTRAINT `actividades_ibfk_1` FOREIGN KEY (`iniciativa_id`) REFERENCES `iniciativas` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Estructura de tabla para la tabla `fotos`
DROP TABLE IF EXISTS `fotos`;
CREATE TABLE `fotos` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `image` LONGBLOB NOT NULL,
  `post_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `post_tags`
DROP TABLE IF EXISTS `post_tags`;
CREATE TABLE `post_tags` (
  `post_id` bigint(20) NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  PRIMARY KEY (`post_id`, `tag_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `post_tags_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `post_tags_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `iniciativa_tags`
DROP TABLE IF EXISTS `iniciativa_tags`;
CREATE TABLE `iniciativa_tags` (
  `iniciativa_id` bigint(20) NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  PRIMARY KEY (`iniciativa_id`, `tag_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `iniciativa_tags_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `iniciativa_tags_ibfk_2` FOREIGN KEY (`iniciativa_id`) REFERENCES `iniciativas` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `usuarios_iniciativas_roles`
-- Drop existing table
-- Recreate with new PRIMARY KEY including rol_id
DROP TABLE IF EXISTS `usuarios_iniciativas_roles`;
CREATE TABLE IF NOT EXISTS `usuarios_iniciativas_roles` (
  `usuario_id` bigint(20) NOT NULL,
  `iniciativa_id` bigint(20) NOT NULL,
  `rol_id` bigint(20) NOT NULL,
  `fecha_asignacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`usuario_id`, `iniciativa_id`, `rol_id`),
  FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE,
  FOREIGN KEY (`iniciativa_id`) REFERENCES `iniciativas` (`ID`) ON DELETE CASCADE,
  FOREIGN KEY (`rol_id`) REFERENCES `roles` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Estructura de tabla para la tabla Galeria de fotos de la iniciativa
DROP TABLE IF EXISTS `galeria_iniciativa`;
CREATE TABLE `galeria_iniciativa` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `iniciativa_id` bigint(20) DEFAULT NULL,
  `imagen` LONGBLOB NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `iniciativa_id` (`iniciativa_id`),
  CONSTRAINT `galeria_iniciativa_ibfk_1` FOREIGN KEY (`iniciativa_id`) REFERENCES `iniciativas` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `me_encanta`
DROP TABLE IF EXISTS `me_encanta`;
CREATE TABLE `me_encanta` (
  `usuario_id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  PRIMARY KEY (`usuario_id`, `post_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `me_encanta_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`ID`),
  CONSTRAINT `me_encanta_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `red_social`
DROP TABLE IF EXISTS `red_social`;
CREATE TABLE `red_social` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `seguimientos`
DROP TABLE IF EXISTS `seguimientos`;
CREATE TABLE `seguimientos` (
  `usuario_id` bigint(20) NOT NULL,
  `iniciativa_id` bigint(20) NOT NULL,
  PRIMARY KEY (`usuario_id`, `iniciativa_id`),
  KEY `iniciativa_id` (`iniciativa_id`),
  CONSTRAINT `seguimientos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`ID`),
  CONSTRAINT `seguimientos_ibfk_2` FOREIGN KEY (`iniciativa_id`) REFERENCES `iniciativas` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de Formulario de contacto de la iniciativa
DROP TABLE IF EXISTS `contacto_iniciativa`;
CREATE TABLE `contacto_iniciativa` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `iniciativa_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `nombres` text NOT NULL,
  `apellidos` text NOT NULL,
  `email` text NOT NULL,
  `telefono` text NOT NULL,
  `prioridad` ENUM('Baja', 'Media', 'Alta') NOT NULL,
  `asunto` text NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`),
  KEY `iniciativa_id` (`iniciativa_id`),
  CONSTRAINT `contacto_iniciativa_ibfk_1` FOREIGN KEY (`iniciativa_id`) REFERENCES `iniciativas` (`ID`),
  CONSTRAINT `contacto_iniciativa_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data insertions at the end
INSERT INTO `tags` (nombre) VALUES 
('Limpieza'),('Reciclaje'),('Reforestación'),('Educación Ambiental'),
('Mantenimiento'),('Recolección'),('Concientización'),('Campaña');

INSERT INTO `roles` (nombre) VALUES ('Administrador'), ('Seguidor'), ('Join');

INSERT INTO `usuarios` (nombre_usuario, email, password) 
VALUES ('Savecoders', 'AbramVivancoAgu@ug.edu.ec', '123456');

--
-- Finalización de la transacción
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
