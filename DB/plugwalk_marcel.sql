-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: mysql-plugwalk.alwaysdata.net
-- Generation Time: Apr 10, 2019 at 12:18 PM
-- Server version: 10.2.17-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plugwalk_marcel`
--

-- --------------------------------------------------------

--
-- Table structure for table `COMMENT`
--

CREATE TABLE `COMMENT` (
  `idComment` int(30) NOT NULL,
  `idUser` int(30) NOT NULL,
  `idPost` int(30) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `COMMENT`
--

INSERT INTO `COMMENT` (`idComment`, `idUser`, `idPost`, `date`) VALUES
(1, 12, 4, '2019-04-09');

-- --------------------------------------------------------

--
-- Table structure for table `POST`
--

CREATE TABLE `POST` (
  `idPOST` int(11) NOT NULL,
  `topic` varchar(45) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `USER_idUSER` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` varchar(600) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `POST`
--

INSERT INTO `POST` (`idPOST`, `topic`, `date`, `USER_idUSER`, `title`, `body`) VALUES
(2, 'zapatillas', '2019-04-09 00:00:00', 4, 'Hype del bueno con las Heron Preston x Nike Air Max 95-720 By You', 'El hype está por las nubes no solo por quién colabora con Nike sino también por los espectaculares diseños que ha preparado, por eso damos por hecho que van a volar en cuanto salgan. Si esto fuese un concierto recomendaríamos estar un par de días antes en la sala para pillar buen sitio, así que muy atentos a todas las novedades de estas Heron Preston x Nike Air Max 95-720 By You que estarán disponibles a mediados de abril'),
(3, 'zapatillas', '2019-04-09 00:00:00', 4, 'Sorpresa con el lanzamiento de las Off-White x Nike Dunk Low!', 'Pocos esperaban otro lanzamiento más de colaboración entre Virgil Abloh y los de Oregon pero parece que han optado por aprovechar el tirón de la colección The Ten que tanto lo partió y están estirando el chicle quizás hasta demasiado. Esta ocasión han elegido unas zapas que recuerdan mucho a las Air Force 1 y están inspiradas en el baloncesto que poco a poco han pasado a ser importantes en la cultura streetwear.'),
(4, 'zapatillas', '2019-04-10 00:00:00', 4, 'Air Jordan 1 Retro Crimson Tint, Color boom?', 'Nos encanta hablar de clásicos y si se actualizan con buen gusto aún nos pone más, esta mítica silueta vuelve a salir al campo a jugar con un colorway muy fresquito y la intención de robarnos el corazón. La alianza de Jordan con Nike viene de lejos y aquí os hicimos un repaso de su historia, hace unas semanas hablamos de la versión Hyper Pink y hoy venimos cargados con un buen pepino que seguro que te planteas pillar. '),
(5, 'zapatillas', '2019-04-10 00:00:00', 4, 'La nueva colección Fear of God Nike cae a finales de mes!', 'Siempre nos gusta darle cabida al streetwear más premium y lujoso, el motivo no es otro que la calidad y el estilazo que nos traen colaboraciones como las que acostumbran a sacar Nike y Fear of God. Hace unos meses comentábamos uno de sus últimos lanzamientos en sneakers, pero esta vez la colección viene al completo con prendas para enamorarnos que hacen que te plantees hacer el esfuerzo de sacarte un riñón para pillarte una de ellas. ');

-- --------------------------------------------------------

--
-- Table structure for table `RAFFLE`
--

CREATE TABLE `RAFFLE` (
  `idRAFFLE` int(10) UNSIGNED NOT NULL,
  `sneakerID` varchar(45) DEFAULT NULL,
  `pricePerEntry` decimal(7,2) DEFAULT NULL,
  `totalPrice` decimal(50,0) DEFAULT NULL,
  `USER_idUSER` int(11) NOT NULL,
  `SNEAKER_idSNEAKER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `RAFFLE`
--

INSERT INTO `RAFFLE` (`idRAFFLE`, `sneakerID`, `pricePerEntry`, `totalPrice`, `USER_idUSER`, `SNEAKER_idSNEAKER`) VALUES
(0, '3', '2.30', '300', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `SNEAKER`
--

CREATE TABLE `SNEAKER` (
  `idSNEAKER` int(11) NOT NULL,
  `brand` varchar(45) DEFAULT NULL,
  `model` varchar(45) DEFAULT NULL,
  `colorWay` varchar(45) DEFAULT NULL,
  `dropDate` datetime DEFAULT NULL,
  `retailPrice` varchar(45) DEFAULT NULL,
  `url_sneaker` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `SNEAKER`
--

INSERT INTO `SNEAKER` (`idSNEAKER`, `brand`, `model`, `colorWay`, `dropDate`, `retailPrice`, `url_sneaker`) VALUES
(1, 'YEEZY', '350 V2 \"FROZEN\"', 'FROZEN YELLOW', '2017-10-23 00:00:00', '220', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE `USER` (
  `iduser` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `birthdate` datetime NOT NULL,
  `address` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `USER`
--

INSERT INTO `USER` (`iduser`, `name`, `surname`, `birthdate`, `address`, `email`, `password`) VALUES
(1, 'name1', 'surname1', '2019-03-28 00:00:00', 'address', 'email', 'password'),
(2, 'name2', 'surname2', '2019-03-09 00:00:00', 'address2', 'email2', 'pass2'),
(3, 'name3', 'surname3', '2019-03-28 00:00:00', 'address3', 'email3', 'password3'),
(4, 'RENZO', 'GOMERO', '1995-05-28 00:00:00', 'CASA DEL RENZO', 'OLEAHITUPOLLA@RENZO.COM', '15AÑITOS'),
(5, 'Mario', '43434', '2019-04-17 00:00:00', '444444', '234234234242', '33333'),
(6, 'POST', '15', '2019-04-17 00:00:00', 'patatta', 'linus', 'hola'),
(7, 'POST', '15', '2019-04-17 00:00:00', 'patattaz', 'linus', 'hola'),
(8, 'adios sorry bro', '15', '2019-04-17 00:00:00', 'patattaz', 'linus', 'hola'),
(9, 'supreme', 'birthdate:Date', '2019-04-11 00:00:00', 'Calle Provença 513 1º 2º', 'renzo1805@hotmail.com', 'pne'),
(10, 'MArcel', 'Picaro', '2019-04-12 00:00:00', '', 'Fullweed@gmail.com', ''),
(11, 'Marcel', 'Dufol', '2019-04-11 00:00:00', '', 'linusdufe@gmail.com', ''),
(12, 'Marcel', 'Dufol', '2019-04-11 00:00:00', '', 'linusdufe@gmail.com', ''),
(13, 'Marcel', 'Dufol', '2019-04-11 00:00:00', '', 'linusdufe@gmail.com', ''),
(14, 'Marcel', 'Dufol', '2019-04-11 00:00:00', '', 'linusdufe@gmail.com', ''),
(15, 'Marcel', 'Dufol', '2019-04-11 00:00:00', '', 'linusdufe@gmail.com', ''),
(16, 'Marcel', 'Dufol', '2019-04-11 00:00:00', '', 'linusdufe@gmail.com', ''),
(17, 'Marcel', 'Dufol', '2019-04-11 00:00:00', '', 'linusdufe@gmail.com', ''),
(18, 'Marcel', 'Dufol', '2019-04-11 00:00:00', '', 'linusdufe@gmail.com', ''),
(19, 'asd', 'fasad', '2019-04-09 00:00:00', 'skadja', 'ren@sakdja.com', 'asda'),
(20, 'sad', 'dsa', '2019-04-11 00:00:00', '', 'dsa@dsak.com', 'sad'),
(21, 'sad', 'dsa', '2019-04-11 00:00:00', '', 'fsasa', 'sad'),
(22, 'sad', 'dsa', '2019-04-11 00:00:00', '', 'fsasa', 'sad'),
(23, 'fsa', 'asd', '2019-04-12 00:00:00', 'fsadsa', 'sadsad', 'fsadsad'),
(24, 'SivaPostKbron', 'Morao', '2019-04-04 00:00:00', 'asdsasad', 'sdasadsa', 'fsadsad'),
(25, 'JOSE', 'FERNANDEZ', '2019-04-10 00:00:00', 'afasfasf', 'sfsafasf', '1234'),
(26, 'Marcel Dufol', 'birthdate:Date', '2019-04-18 00:00:00', 'Mosen Cinto Verdaguer, 30, 7é, 2ªb', 'linusdufe@gmail.com', 'etwettewqt'),
(27, 'Marcel Dufol', 'birthdate:Date', '2019-04-18 00:00:00', 'Mosen Cinto Verdaguer, 30, 7é, 2ªb', 'linusdufe@gmail.com', 'etwettewqt'),
(28, 'Marcel Dufol', 'birthdate:Date', '2019-04-18 00:00:00', 'Mosen Cinto Verdaguer, 30, 7é, 2ªb', 'linusdufe@gmail.com', 'etwettewqt'),
(29, 'Marcel', 'Dufol', '2019-04-12 00:00:00', 'Mosen Cinto Verdaguer, 30, 7é, 2ªb', 'linusdufe@gmail.com', 'ewqrweqrwew'),
(30, 'Marcel', 'Dufol', '2019-04-12 00:00:00', 'Mosen Cinto Verdaguer, 30, 7é, 2ªb', 'linusdufe@gmail.com', 'ewqrweqrwew'),
(31, 'Marcel', 'Dufol', '2019-04-12 00:00:00', 'Mosen Cinto Verdaguer, 30, 7é, 2ªb', 'linusdufe@gmail.com', 'ewqrweqrwew'),
(32, 'Marcel', 'Dufol', '2019-04-01 00:00:00', 'Mosen Cinto Verdaguer, 30, 7é, 2ªb', 'linusdufe@gmail.com', 'ewqrweqrwew'),
(33, 'Marcel', 'Dufol', '2019-04-01 00:00:00', 'Mosen Cinto Verdaguer, 30, 7é, 2ªb', 'linusdufe@gmail.com', 'ewqrweqrwew');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `COMMENT`
--
ALTER TABLE `COMMENT`
  ADD PRIMARY KEY (`idComment`),
  ADD UNIQUE KEY `idUser` (`idUser`),
  ADD UNIQUE KEY `idPost` (`idPost`);

--
-- Indexes for table `POST`
--
ALTER TABLE `POST`
  ADD PRIMARY KEY (`idPOST`,`USER_idUSER`),
  ADD KEY `fk_POST_USER_idx` (`USER_idUSER`);

--
-- Indexes for table `RAFFLE`
--
ALTER TABLE `RAFFLE`
  ADD PRIMARY KEY (`idRAFFLE`),
  ADD KEY `fk_RAFFLE_USER1_idx` (`USER_idUSER`),
  ADD KEY `fk_RAFFLE_SNEAKER1_idx` (`SNEAKER_idSNEAKER`);

--
-- Indexes for table `SNEAKER`
--
ALTER TABLE `SNEAKER`
  ADD PRIMARY KEY (`idSNEAKER`);

--
-- Indexes for table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `COMMENT`
--
ALTER TABLE `COMMENT`
  MODIFY `idComment` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `POST`
--
ALTER TABLE `POST`
  MODIFY `idPOST` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `SNEAKER`
--
ALTER TABLE `SNEAKER`
  MODIFY `idSNEAKER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `USER`
--
ALTER TABLE `USER`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `COMMENT`
--
ALTER TABLE `COMMENT`
  ADD CONSTRAINT `COMMENT_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `USER` (`iduser`),
  ADD CONSTRAINT `COMMENT_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `POST` (`idPOST`);

--
-- Constraints for table `POST`
--
ALTER TABLE `POST`
  ADD CONSTRAINT `fk_POST_USER` FOREIGN KEY (`USER_idUSER`) REFERENCES `USER` (`idUSER`);

--
-- Constraints for table `RAFFLE`
--
ALTER TABLE `RAFFLE`
  ADD CONSTRAINT `fk_RAFFLE_SNEAKER1` FOREIGN KEY (`SNEAKER_idSNEAKER`) REFERENCES `SNEAKER` (`idSNEAKER`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_RAFFLE_USER1` FOREIGN KEY (`USER_idUSER`) REFERENCES `USER` (`idUSER`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
