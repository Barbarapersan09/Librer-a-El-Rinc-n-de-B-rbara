-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2023 a las 19:12:19
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--
-- -----------------------------------------------------
-- Schema Biblioteca
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `Biblioteca` ;

-- -----------------------------------------------------
-- Schema Biblioteca
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Biblioteca` DEFAULT CHARACTER SET utf8 ;
USE `Biblioteca` ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `idAutor` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(200) NOT NULL,
  `Edad` int(3) DEFAULT NULL,
  `Nacionalidad` varchar(45) DEFAULT NULL,
  `Biografia` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellidos` varchar(250) NOT NULL,
  `Direccion` varchar(400) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `Telefono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Un cliente puede realizar muchas compras pero cada compra esta asciada a un cliente. Por eso es 1: n';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `idCompra` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Precio` double NOT NULL,
  `Metodo_pago` varchar(45) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `Libros_idLibros` int(11) NOT NULL,
  `CLiente_idCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Una compra esta relacionada con uno o muchos libros y una compra esta relacionada con un solo cliente.Por eso es 1: n y 1: 1';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE `editorial` (
  `idEditorial` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Direccion` varchar(400) NOT NULL,
  `Telefono` int(9) DEFAULT NULL,
  `web` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Un libro solo puede ser de una editorial.\nPor eso es 1: n';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejemplar`
--

CREATE TABLE `ejemplar` (
  `idEjemplar` int(11) NOT NULL,
  `Num_ejemplar` int(5) NOT NULL,
  `Disponibilidad` tinyint(4) NOT NULL,
  `Libros_idLibros` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Un ejemplar esta relacionado con un solo libro pero un libro puede tener muchos ejemplares. Por eso es 1: n';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escrito_por`
--

CREATE TABLE `escrito_por` (
  `Libros_idLibros` int(11) NOT NULL,
  `Autor_idAutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Un libro puede estar escrito por uno o muchos autores y uno o muchos autores pueden haber escrito uno o muchos libros. Por eso es n: m ';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `idLibros` int(11) NOT NULL,
  `ISBN` varchar(13) NOT NULL,
  `Titulo` varchar(200) NOT NULL,
  `Imagen` blob NOT NULL,
  `Tema` varchar(100) NOT NULL,
  `Paginas` int(11) NOT NULL,
  `Formato` varchar(45) NOT NULL,
  `Idioma` varchar(45) NOT NULL,
  `Fecha_publicacion` date NOT NULL,
  `Precio` double NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Editorial_idEditorial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `idTemas` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trata_de`
--

CREATE TABLE `trata_de` (
  `Libros_idLibros` int(11) NOT NULL,
  `Temas_idTemas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Un libro puede tratar de uno o varios temas y uno o varios temas puede tratar un libro.Por eso es n: m';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `nuevaPass` varchar(256) NOT NULL,
  `Salt` varchar(16) NOT NULL,
  `codConfirm` varchar(5) NOT NULL,
  `codActiv` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `Nombre`, `Email`, `Password`, `nuevaPass`, `Salt`, `codConfirm`, `codActiv`) VALUES
(1, 'Barbara', 'barbarapersan09@gmail.com', '$5$rounds=5000$3863544675411639$KWWEo5g9xIge4VMpaGdyp7tgaW.BMXJ89tGYmT8Amw8', '', '3863544675411639', '1344', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`idAutor`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idCompra`,`Libros_idLibros`,`CLiente_idCliente`),
  ADD KEY `fk_Compra_cliente_idx` (`idCliente`),
  ADD KEY `fk_Compra_Libros1_idx` (`Libros_idLibros`),
  ADD KEY `fk_Compra_CLiente1_idx` (`CLiente_idCliente`);

--
-- Indices de la tabla `editorial`
--
ALTER TABLE `editorial`
  ADD PRIMARY KEY (`idEditorial`);

--
-- Indices de la tabla `ejemplar`
--
ALTER TABLE `ejemplar`
  ADD PRIMARY KEY (`idEjemplar`),
  ADD KEY `fk_Ejemplar_Libros1_idx` (`Libros_idLibros`);

--
-- Indices de la tabla `escrito_por`
--
ALTER TABLE `escrito_por`
  ADD PRIMARY KEY (`Libros_idLibros`,`Autor_idAutor`),
  ADD KEY `fk_Libros_has_Autor_Autor1_idx` (`Autor_idAutor`),
  ADD KEY `fk_Libros_has_Autor_Libros1_idx` (`Libros_idLibros`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`idLibros`),
  ADD KEY `fk_Libros_Editorial_idx` (`Editorial_idEditorial`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`idTemas`),
  ADD UNIQUE KEY `idTemas_UNIQUE` (`idTemas`);

--
-- Indices de la tabla `trata_de`
--
ALTER TABLE `trata_de`
  ADD PRIMARY KEY (`Libros_idLibros`,`Temas_idTemas`),
  ADD KEY `fk_Libros_has_Temas_Temas2_idx` (`Temas_idTemas`),
  ADD KEY `fk_Libros_has_Temas_Libros1_idx` (`Libros_idLibros`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `idAutor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `idCompra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `editorial`
--
ALTER TABLE `editorial`
  MODIFY `idEditorial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ejemplar`
--
ALTER TABLE `ejemplar`
  MODIFY `idEjemplar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `idLibros` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `idTemas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_Compra_CLiente1` FOREIGN KEY (`CLiente_idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Compra_Libros1` FOREIGN KEY (`Libros_idLibros`) REFERENCES `libros` (`idLibros`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Compra_cliente` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ejemplar`
--
ALTER TABLE `ejemplar`
  ADD CONSTRAINT `fk_Ejemplar_Libros1` FOREIGN KEY (`Libros_idLibros`) REFERENCES `libros` (`idLibros`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `escrito_por`
--
ALTER TABLE `escrito_por`
  ADD CONSTRAINT `fk_Libros_has_Autor_Autor1` FOREIGN KEY (`Autor_idAutor`) REFERENCES `autores` (`idAutor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Libros_has_Autor_Libros1` FOREIGN KEY (`Libros_idLibros`) REFERENCES `libros` (`idLibros`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `fk_Libros_Editorial` FOREIGN KEY (`Editorial_idEditorial`) REFERENCES `editorial` (`idEditorial`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `trata_de`
--
ALTER TABLE `trata_de`
  ADD CONSTRAINT `fk_Libros_has_Temas_Libros1` FOREIGN KEY (`Libros_idLibros`) REFERENCES `libros` (`idLibros`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Libros_has_Temas_Temas2` FOREIGN KEY (`Temas_idTemas`) REFERENCES `temas` (`idTemas`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
