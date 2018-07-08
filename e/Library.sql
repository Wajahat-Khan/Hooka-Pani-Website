-- phpMyAdmin SQL Dump
-- version 4.4.15.8
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 15, 2017 at 05:57 PM
-- Server version: 5.6.31
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Library`
--

-- --------------------------------------------------------

--
-- Table structure for table `AUTHOR`
--

CREATE TABLE IF NOT EXISTS `AUTHOR` (
  `AuthorID` int(11) NOT NULL,
  `Author_Name` varchar(20) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Qualification` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AUTHOR`
--

INSERT INTO `AUTHOR` (`AuthorID`, `Author_Name`, `Address`, `Qualification`) VALUES
(1, 'J.K Rowling', '557 Broadway New York, USA', 'PhD'),
(2, 'George R.R Martin', 'House 12, Red Wedding Drive, Santa Fe, New Mexico', 'MBA'),
(3, 'Dan Brown', 'House 13, Inferno Angel Avenue, New York, USA', 'MCS'),
(4, 'Khaled Hosseini', 'House 16, Splendid Kite Drive, Los Angeles, USA', 'MA'),
(5, 'Suzanne Collins', 'House 21, Hungry Mockinjay Avenue, San Fransisco, ', 'MA'),
(6, 'Paulo Coelho', 'House 54, Light Warrior Drive, Milan, Italy', 'MBS'),
(7, 'Shayla Black', 'House 61, Virgin Swag Avenue, New York, USA', 'MA'),
(8, 'Stephenie Meyer', 'House 76, Twlightaut Drive, Los Santos,USA', 'MCS'),
(9, 'Eoin Colfer', 'House 89, Eternity Dodger Avenue, Paris, France', 'MA'),
(10, 'L.J. Smith', 'House 15, Twilight Drive, Rio De Janeiro, Brazil', 'MCS');

-- --------------------------------------------------------

--
-- Table structure for table `BOOKS`
--

CREATE TABLE IF NOT EXISTS `BOOKS` (
  `BookID` int(11) NOT NULL,
  `BookName` varchar(50) NOT NULL,
  `PublisherID` int(11) NOT NULL,
  `AuthorID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `SupID` int(11) NOT NULL,
  `Book_Img` text,
  `Book_PDF` text
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `BOOKS`
--

INSERT INTO `BOOKS` (`BookID`, `BookName`, `PublisherID`, `AuthorID`, `CategoryID`, `SupID`, `Book_Img`, `Book_PDF`) VALUES
(1, 'Harry Potter and The Sorcerers stone', 8, 1, 1, 1, 'Harry_Potter_and_the_Sorcerer''s_Stone.jpg', '1-harry-potter-and-the-sorcerer-s-stone---1'),
(2, 'Harry Potter and The Chamber of Secrets', 8, 1, 7, 2, 'cos-us-jacket-art.jpg', '2-harry-potter-and-the-chamber-of-secrets---2'),
(3, 'Harry Potter and The Prisoner of Azkaban', 5, 1, 1, 3, 'harry_potter_and_the_prisoner_of_azkaban_-us_cover-jpg.jpg', '3-harry-potter-and-the-prisoner-of-azkaban---3'),
(4, 'Harry Potter and The Goblet of Fire', 4, 1, 7, 1, '4-harry-potter-and-the-goblet-of-fire---4.jpg', '4-harry-potter-and-the-goblet-of-fire---4'),
(5, 'Harry Potter and The Order Of The Phoenix', 3, 1, 1, 1, '5-harry-potter-and-the-order-of-the-phoenix---5.jpg', '5-harry-potter-and-the-order-of-the-phoenix---5'),
(6, 'Harry Potter and The Half Blood Prince', 1, 1, 7, 2, '6-harry-potter-and-the-half-blood-prince---6.jpg', '6-harry-potter-and-the-half-blood-prince---6'),
(7, 'Harry Potter and the Deathly Hallows', 1, 1, 1, 4, '7-harry-potter-and-the-deathly-hallows---7.jpg', '7-harry-potter-and-the-deathly-hallows---7'),
(8, 'A Game of Thrones (A song of Ice and Fire)', 2, 2, 12, 4, 'Game_of_thrones.jpeg', '1.-a-game-of-thrones'),
(9, 'A Clash of Kings (A Song of Ice and Fire)', 3, 2, 12, 4, 'gameofthrones2.jpg', '2.-a-clash-of-kings'),
(10, 'A Storm of Swords (A Song of Ice and Fire)', 3, 2, 12, 5, 'a-storm-of-swords-book-cover.jpg', '3.-a-storm-of-swords'),
(11, 'A Feast for Crows (A Song of Ice and Fire)', 2, 2, 1, 2, '200px-AFeastForCrows.jpg', '4.-a-feast-for-crows'),
(12, 'A Dance with Dragons (A Song of Ice and Fire)', 1, 2, 1, 1, '63167612.jpg', '5.-a-dance-with-dragons'),
(13, 'Inferno', 6, 3, 7, 2, 'Inferno-cover.jpg', 'Inferno PDF'),
(14, 'Angels & Demons', 7, 3, 8, 3, 'angels and demons.jpg', 'Dan Brown - Angels & Demons'),
(15, 'Deception Point', 4, 3, 7, 3, 'Deception-Point_novel.jpg', 'Dan Brown - Deception Point'),
(16, 'Digital Fortress', 5, 3, 7, 3, 'digital fortress.jpg', 'Dan Brown - Digital Fortress'),
(17, 'The DaVinci Code', 3, 3, 7, 5, 'DaVinciCode.jpg', 'Dan Brown - The DaVinci Code'),
(18, 'The Lost Symbol', 8, 3, 7, 4, 'lostsymbol.jpg', 'Dan Brown - The Lost Symbol'),
(19, 'A Thousand Splendid Suns', 3, 4, 7, 2, 'A_Thousand_Splendid_Suns.gif', 'A Thousand Splendid Suns'),
(20, 'The Kite Runner', 2, 4, 7, 3, 'The Kite Runner.jpg', 'The Kite Runner'),
(21, 'The Hunger Games', 5, 5, 5, 2, 'book-1---the-hunger-games.jpg', 'book-1---the-hunger-games'),
(22, 'Catching Fire (The Hunger Games)', 3, 5, 5, 2, 'cathcingfires.jpg', 'book-2---catching-fire'),
(23, 'Mockingjay (The Hunger Games)', 4, 5, 5, 2, 'book-3---mockingjay.jpg', 'book-3---mockingjay'),
(24, 'The Pilgrimage', 6, 6, 7, 3, 'UK_The Pilgrimage PB cover.JPG', '1. The Pilgrimage'),
(25, 'The Valkyries', 2, 6, 7, 1, 'the-valkyries1.jpg', '4. The Valkyries'),
(26, 'Maktub', 3, 6, 7, 3, 'maktub-paulo-coelho-paperback-cover-art.jpg', '5. Maktub'),
(27, 'The Manual of the Warrior of Light', 8, 6, 7, 2, '200px-Manual_of_the_Warrior_of_Light_(cover).jpg', '8. The Manual of the Warrior of Light'),
(28, 'The Way of the Bow', 5, 6, 7, 2, 'paulo cohelo bow.jpg', '14. The Way of the Bow'),
(29, 'The Zahir', 2, 6, 7, 1, '12. The Zahir.jpg', '12. The Zahir'),
(30, 'Veronika decides to Die', 4, 6, 7, 2, 'veronika.jpg', '15. Veronika decides to die'),
(31, 'The Witch of Portobello', 2, 6, 7, 3, '13. The Witch of Portobello.jpg', '13. The Witch of Portobello'),
(32, 'Eleven Minutes', 5, 6, 7, 2, 'Eleven_Minutes_Book_cover.jpg', '11. Eleven Minutes'),
(33, 'Their Virgin Secretary', 2, 7, 2, 1, 'Their Virgin Secretary - Shayla Black.jpg', 'Their Virgin Secretary - Shayla Black'),
(34, 'Their Virgin Captive', 4, 7, 2, 3, 'Their Virgin Captive - Shayla Black & Lexi Blake.jpg', 'Their Virgin Captive  book 1'),
(35, 'Their Virgins Secret', 5, 7, 2, 4, 'Their Virgins Secret.jpg', 'Their Virgins Secret book 2'),
(36, 'Their Virgin Concubine', 8, 7, 2, 5, 'Their Virgin Concubine, Masters of Menage, Book 3 - Shayla Black Lexi Blake.jpg', 'Their Virgin Concubine book 3'),
(37, 'Their Virgin Hostage, Masters of Menage', 3, 7, 2, 4, '05_TheirVirginHostage1.jpg', 'Their Virgin Hostage, Masters of Menage, - Black, Shayla'),
(38, 'Their Virgin Mistress', 1, 7, 2, 4, 'TheirVirginMistress_highres.jpg', 'Black, Shayla-Their Virgin Mistress'),
(39, 'Twilight', 1, 8, 5, 5, 'Twilightbook.jpg', '1-twilight'),
(40, 'Twilight - New Moon', 1, 8, 5, 3, 'Newmooncover.jpg', '2-new-moon'),
(41, 'Twilight - Eclipse', 1, 8, 5, 1, 'Eclipsecover.jpg', '3-eclipse'),
(42, 'Twilight - Breaking Dawn', 1, 8, 5, 1, 'breaking Dawn.jpg', '4-breaking-dawn'),
(43, 'Artemis Fowl', 3, 9, 1, 1, 'artemis-fowl.jpg', '-01-artemis-fowl'),
(44, ' Artemis Fowl (The Arctic Incident)', 3, 9, 1, 1, 'arctic incident-712303.jpg', '-02-artemis-fowl-the-arctic-incident'),
(45, 'Artemis Fowl (The Eternity Code)', 2, 9, 1, 2, '9780141321318.jpg', '-03-artemis-fowl-the-eternity-code'),
(46, 'Artemis Fowl The Opal Deception', 1, 9, 1, 2, 'Opaldeception.jpg', '-04-artemis-fowl-the-opal-deception'),
(47, 'The Awakening (Vampire Diaries)', 3, 10, 1, 3, 'The Awakening (Vampire Diaries).jpg', 'L.J. Smith - Vampire Diaries 01 - The Awakening'),
(48, 'The Struggle (Vampire Diaries)', 3, 10, 1, 4, 'L.J. Smith - Vampire Diaries 02 - The Struggle.jpg', 'L.J. Smith - Vampire Diaries 02 - The Struggle'),
(49, 'The Fury (Vampire Diaries)', 3, 10, 1, 5, 'L.J. Smith - Vampire Diaries 03 - The Fury.jpg', 'L.J. Smith - Vampire Diaries 03 - The Fury'),
(50, 'Dark Reunion (Vampire Diaries)', 2, 10, 1, 2, 'L.J. Smith - Vampire Diaries 04 - Dark Reunion.jpg', 'L.J. Smith - Vampire Diaries 04 - Dark Reunion'),
(51, 'The Return Nightfall (Vampire Diaries)', 1, 10, 1, 2, 'L.J. Smith - Vampire Diaries 05 - The Return Nightfall.jpg', 'L.J. Smith - Vampire Diaries 05 - The Return Nightfall');

-- --------------------------------------------------------

--
-- Table structure for table `CATEGORY`
--

CREATE TABLE IF NOT EXISTS `CATEGORY` (
  `CategoryID` int(11) NOT NULL,
  `Category_Name` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CATEGORY`
--

INSERT INTO `CATEGORY` (`CategoryID`, `Category_Name`) VALUES
(1, 'Fantasy'),
(2, 'Romance'),
(3, 'Children'),
(4, 'Action'),
(5, 'Young adult'),
(6, 'Strategy'),
(7, 'Fiction'),
(8, 'Thriller'),
(9, 'Crime'),
(10, 'Non Fiction'),
(12, 'Adventure');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Email` varchar(150) DEFAULT NULL,
  `Text` text,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Task` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `LogIn`
--

CREATE TABLE IF NOT EXISTS `LogIn` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(40) NOT NULL,
  `Password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `MEMBER`
--

CREATE TABLE IF NOT EXISTS `MEMBER` (
  `MemberID` int(11) NOT NULL,
  `MemberName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PUBLISHEDBY`
--

CREATE TABLE IF NOT EXISTS `PUBLISHEDBY` (
  `BookID` int(11) NOT NULL,
  `PubID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PUBLISHER`
--

CREATE TABLE IF NOT EXISTS `PUBLISHER` (
  `PubID` int(11) NOT NULL,
  `Publisher_Name` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PUBLISHER`
--

INSERT INTO `PUBLISHER` (`PubID`, `Publisher_Name`, `Email`) VALUES
(1, 'Penguin Books', 'penguinbooks@gmail.c'),
(2, 'Alfresco Press', ' alfrescopress@tampa'),
(3, 'Centurion Publishers', 'rnluther@hiwaay.net'),
(4, 'McBooks Press', 'mcbooks@mcbooks.com'),
(5, 'McClelland & Steward', 'mail@mcclelland.com'),
(6, 'NewSouth Books', 'brian@newsouthbooks.'),
(7, 'Sea Lion Books', ' david@sealionbooks.'),
(8, 'Steerforth Press', ' info@steerforth.com');

-- --------------------------------------------------------

--
-- Stand-in structure for view `query_v_record`
--
CREATE TABLE IF NOT EXISTS `query_v_record` (
`BookID` int(11)
,`BookName` varchar(50)
,`Book_Img` text
,`Book_PDF` text
,`Author_Name` varchar(20)
,`Category_Name` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIEDBY`
--

CREATE TABLE IF NOT EXISTS `SUPPLIEDBY` (
  `BookID` int(11) NOT NULL,
  `SupID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `DeliveryTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SUPPLIER`
--

CREATE TABLE IF NOT EXISTS `SUPPLIER` (
  `SupID` int(11) NOT NULL,
  `Supplier_Name` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SUPPLIER`
--

INSERT INTO `SUPPLIER` (`SupID`, `Supplier_Name`, `Email`) VALUES
(1, 'AK Name', 'AKSupply@gmail.com'),
(2, 'Alibris', 'Joe@Alibris.com'),
(3, 'Last Gasp', 'LastGasp@hotmail.com'),
(4, 'Perseus Books Group', 'PBG@perseus.com'),
(5, 'TAN Books', 'TANbooks@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `WRITTENBY`
--

CREATE TABLE IF NOT EXISTS `WRITTENBY` (
  `AuthorID` int(11) NOT NULL,
  `BookID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `query_v_record`
--
DROP TABLE IF EXISTS `query_v_record`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `library`.`query_v_record` AS select `library`.`books`.`BookID` AS `BookID`,`library`.`books`.`BookName` AS `BookName`,`library`.`books`.`Book_Img` AS `Book_Img`,`library`.`books`.`Book_PDF` AS `Book_PDF`,`library`.`author`.`Author_Name` AS `Author_Name`,`library`.`category`.`Category_Name` AS `Category_Name` from ((`library`.`books` join `library`.`author`) join `library`.`category`) where ((`library`.`books`.`AuthorID` = `library`.`author`.`AuthorID`) and (`library`.`books`.`CategoryID` = `library`.`category`.`CategoryID`));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AUTHOR`
--
ALTER TABLE `AUTHOR`
  ADD PRIMARY KEY (`AuthorID`);

--
-- Indexes for table `BOOKS`
--
ALTER TABLE `BOOKS`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `Books_SupID_FK_Supplier_SupID` (`SupID`),
  ADD KEY `Books_PublisherID_FK_Publisher_PubID` (`PublisherID`),
  ADD KEY `Books_AuthorID_FK_Author_AuthorID` (`AuthorID`),
  ADD KEY `Books_CategoryID_FK_Category_CategoryID` (`CategoryID`);

--
-- Indexes for table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `LogIn`
--
ALTER TABLE `LogIn`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `MEMBER`
--
ALTER TABLE `MEMBER`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indexes for table `PUBLISHEDBY`
--
ALTER TABLE `PUBLISHEDBY`
  ADD PRIMARY KEY (`BookID`,`PubID`),
  ADD KEY `Publishedby_BookID_FK_PUBLISHER_pubID` (`PubID`);

--
-- Indexes for table `PUBLISHER`
--
ALTER TABLE `PUBLISHER`
  ADD PRIMARY KEY (`PubID`);

--
-- Indexes for table `SUPPLIEDBY`
--
ALTER TABLE `SUPPLIEDBY`
  ADD PRIMARY KEY (`BookID`,`SupID`),
  ADD KEY `Suppliedby_SupID_FK_Supplier_SupID` (`SupID`);

--
-- Indexes for table `SUPPLIER`
--
ALTER TABLE `SUPPLIER`
  ADD PRIMARY KEY (`SupID`);

--
-- Indexes for table `WRITTENBY`
--
ALTER TABLE `WRITTENBY`
  ADD PRIMARY KEY (`AuthorID`,`BookID`),
  ADD KEY `WrittenBy_AuthorID_FK_BookID_Books` (`BookID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `AUTHOR`
--
ALTER TABLE `AUTHOR`
  MODIFY `AuthorID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `BOOKS`
--
ALTER TABLE `BOOKS`
  MODIFY `BookID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `LogIn`
--
ALTER TABLE `LogIn`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `MEMBER`
--
ALTER TABLE `MEMBER`
  MODIFY `MemberID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `PUBLISHER`
--
ALTER TABLE `PUBLISHER`
  MODIFY `PubID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `SUPPLIER`
--
ALTER TABLE `SUPPLIER`
  MODIFY `SupID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `BOOKS`
--
ALTER TABLE `BOOKS`
  ADD CONSTRAINT `Books_AuthorID_FK_Author_AuthorID` FOREIGN KEY (`AuthorID`) REFERENCES `AUTHOR` (`AuthorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Books_CategoryID_FK_Category_CategoryID` FOREIGN KEY (`CategoryID`) REFERENCES `CATEGORY` (`CategoryID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Books_PublisherID_FK_Publisher_PubID` FOREIGN KEY (`PublisherID`) REFERENCES `PUBLISHER` (`PubID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Books_SupID_FK_Supplier_SupID` FOREIGN KEY (`SupID`) REFERENCES `SUPPLIER` (`SupID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `PUBLISHEDBY`
--
ALTER TABLE `PUBLISHEDBY`
  ADD CONSTRAINT `Publishedby_BookID_FK_BOOKS_bookID` FOREIGN KEY (`BookID`) REFERENCES `BOOKS` (`BookID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Publishedby_BookID_FK_PUBLISHER_pubID` FOREIGN KEY (`PubID`) REFERENCES `PUBLISHER` (`PubID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `SUPPLIEDBY`
--
ALTER TABLE `SUPPLIEDBY`
  ADD CONSTRAINT `Suppliedby_Bookid_FK_Books_BookID` FOREIGN KEY (`BookID`) REFERENCES `BOOKS` (`BookID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Suppliedby_SupID_FK_Supplier_SupID` FOREIGN KEY (`SupID`) REFERENCES `SUPPLIER` (`SupID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `WRITTENBY`
--
ALTER TABLE `WRITTENBY`
  ADD CONSTRAINT `WrittenBy_AuthorID_FK_Author_AuthorID` FOREIGN KEY (`AuthorID`) REFERENCES `AUTHOR` (`AuthorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `WrittenBy_AuthorID_FK_BookID_Books` FOREIGN KEY (`BookID`) REFERENCES `BOOKS` (`BookID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
