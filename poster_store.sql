-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 13. Jun 2021 um 12:07
-- Server-Version: 10.4.14-MariaDB
-- PHP-Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `poster_store`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `order_`
--

CREATE TABLE `order_` (
  `OrderID` int(11) NOT NULL,
  `userIdFK` int(11) NOT NULL,
  `value` decimal(5,2) NOT NULL,
  `Bestellung_time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `order_`
--

INSERT INTO `order_` (`OrderID`, `userIdFK`, `value`, `Bestellung_time`) VALUES
(371, 112, '36.99', 'June 13, 2021, 12:05 pm'),
(372, 112, '36.99', 'June 13, 2021, 12:06 pm');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `orderIDFK` int(11) NOT NULL,
  `productIDFK` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `order_products`
--

INSERT INTO `order_products` (`id`, `orderIDFK`, `productIDFK`, `amount`) VALUES
(1777, 371, 1, 1),
(1778, 371, 2, 1),
(1779, 372, 1, 1),
(1780, 372, 2, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `size` varchar(50) NOT NULL,
  `item` int(11) DEFAULT 10,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`id`, `product_code`, `name`, `description`, `image`, `price`, `size`, `item`, `category`) VALUES
(1, '11111', 'lowe', 'Ein schwarz-weißes Fotokunstfoto mit dem Porträt eines majestätischen Löven. Seine Mähne weht im Wind und der Blick ist auf etwas weit in der Ferne gerichtet. Ein schönes und starkes Bild, das sich gut mit anderen Tier- und Naturpostern kombinieren lässt.', 'loewe.jpg', '9.99', '21 x 31 cm ', 66, 'animals/tiere'),
(2, '12121', 'Elefant', 'schwarz weiß elefant', 'elefant.jpg', '12.00', '{21 x 31 cm ', -1, 'animals/tiere'),
(3, '12345', 'New york city', 'new_york city  schwarz-weiß', 'new_york.jpg', '14.00', ' 30 x40 cm', 13, 'Maps & City/ staetde'),
(4, '134567', 'Schmetterling', 'Stilvolles Poster mit einem Schmetterling. Dieses Bild passt gut zu den allermeisten Einrichtungsstilen.', 'Schmetterling.jpg', '15.00', ' 30 x40 cm', 38, 'animals/tiere'),
(5, '98765', 'Marilyn', '', 'Marilyn.jpg', '45.00', ' 70 x100 cm', 28, 'actor/Darsteller'),
(6, '7574t', 'Audrey', '', 'audrey.jpg', '30.00', ' 70 x100 cm', 36, 'actor/Darsteller'),
(7, '7474', 'Dondelion', '', 'Dondelion.jpg', '30.00', ' 30 x40 cm', 40, 'flowers/blumen'),
(8, 'hjhjv', 'Together Poster', '', 'Together_poster.jpg', '9.99', ' 70 x100 cm', 40, 'Love/liebe'),
(10, 'abcd1', 'Schildkröte am Strand Poster', '', 'strand.jpg', '58.99', ' 70 x100 cm', 40, 'Natur'),
(11, 'lkjhg', 'earth', '', 'earth.jpg', '34.89', '40 x 90 cm', 18, 'Natur '),
(12, 'beLive', 'I Believe in You', '', 'belive.jpg', '46.00', ' 70 x100 cm', 40, 'quotes/zotate'),
(15, 'ro111', 'Schiefe Turm', 'Faszinierendes Architekturposter von dem Schiefen Turm von Pisa. Der Glockenturm ist aufgrund seiner Schieflage ein beliebtes Ziel von Touristen aus der ganzen Welt. Das Architekturposter in seinen hellen beigen Farben lässt sich schön kombinieren und mac', 'Schiefe_Turm.jpg', '12.00', ' 70 x100 cm', 39, 'city/stadt');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(75) NOT NULL,
  `password` varchar(200) NOT NULL,
  `verification_code` varchar(6) DEFAULT '0',
  `status` tinyint(1) DEFAULT 0,
  `online` tinyint(1) DEFAULT 0,
  `screen_size` varchar(10) DEFAULT NULL,
  `lastTimeChange` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `verification_code`, `status`, `online`, `screen_size`, `lastTimeChange`) VALUES
(112, 'max', 'mustermann', 'maxMustermann@gmail.com', '1b86355f13a7f0b90c8b6053c0254399994dfbb3843e08d603e292ca13b8f672ed5e58791c10f3e36daec9699cc2fbdc88b4fe116efa7fce016938b787043818', '65000', 1, 0, '2000X1334', 'June 13, 2021, 12:05 pm');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_adress`
--

CREATE TABLE `user_adress` (
  `id` int(11) NOT NULL,
  `userIdFK` int(11) NOT NULL,
  `anrede` varchar(15) DEFAULT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `plz` varchar(7) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user_adress`
--

INSERT INTO `user_adress` (`id`, `userIdFK`, `anrede`, `firstname`, `lastname`, `plz`, `street`, `city`, `country`) VALUES
(33, 112, 'Frau', 'max', 'mustermann', '112', 'tübinger', 'tuebingen', 'DE');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `wishlist`
--

INSERT INTO `wishlist` (`id`, `userId`, `productId`) VALUES
(90, 115, 1),
(91, 115, 2);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userId_product_id` (`userId`,`productId`);

--
-- Indizes für die Tabelle `order_`
--
ALTER TABLE `order_`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `fk_userId` (`userIdFK`);

--
-- Indizes für die Tabelle `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fK_orderID` (`orderIDFK`);

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`);

--
-- Indizes für die Tabelle `user_adress`
--
ALTER TABLE `user_adress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKuser` (`userIdFK`);

--
-- Indizes für die Tabelle `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prodct_user_id` (`userId`,`productId`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=438;

--
-- AUTO_INCREMENT für Tabelle `order_`
--
ALTER TABLE `order_`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=373;

--
-- AUTO_INCREMENT für Tabelle `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1781;

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT für Tabelle `user_adress`
--
ALTER TABLE `user_adress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT für Tabelle `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `order_`
--
ALTER TABLE `order_`
  ADD CONSTRAINT `fk_userId` FOREIGN KEY (`userIdFK`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `fK_orderID` FOREIGN KEY (`orderIDFK`) REFERENCES `order_` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `user_adress`
--
ALTER TABLE `user_adress`
  ADD CONSTRAINT `FKuser` FOREIGN KEY (`userIdFK`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
