-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2020 at 02:06 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baza`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `kategorijaID` int(18) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`kategorijaID`, `naziv`) VALUES
(1, 'Bolesti zuba i endodoncija'),
(2, 'Parodontologija'),
(3, 'Protetika'),
(4, 'Implantologija');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `korisnickoime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sifra` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `datumregistracije` date NOT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`korisnickoime`, `sifra`, `ime`, `prezime`, `email`, `datumregistracije`, `status`) VALUES
('filip', '9a4ee0139004e7c16e3d52b85e71154e', 'Filip', 'Djordjevic', 'george@pixelate.rs', '2020-06-15', 'admin'),
('masa', '8eac85615da7da263d313a5fa2181076', 'Masa', 'Vucic', 'masa@pixelate.rs', '2020-06-15', 'korisnik'),
('neda', '43d974e40f94bdcb43103034aa1a34ba', 'Neda', 'Vukovic', 'neda@gmail.com', '2020-02-06', 'korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `rezervacija`
--

CREATE TABLE `rezervacija` (
  `rezervacijaId` int(18) NOT NULL,
  `korisnik` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `uslugaID` int(11) NOT NULL,
  `datum` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rezervacija`
--

INSERT INTO `rezervacija` (`rezervacijaId`, `korisnik`, `uslugaID`, `datum`) VALUES
(50, 'neda', 11, '02/22/2020');

-- --------------------------------------------------------

--
-- Table structure for table `usluga`
--

CREATE TABLE `usluga` (
  `uslugaID` int(11) NOT NULL,
  `nazivUsluge` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cena` double DEFAULT NULL,
  `opis` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slika` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dostupnost` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'da',
  `kategorijaID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usluga`
--

INSERT INTO `usluga` (`uslugaID`, `nazivUsluge`, `cena`, `opis`, `slika`, `dostupnost`, `kategorijaID`) VALUES
(1, 'Stomatoloski pregled', 1250, 'Pregled zuba ', 'img/pregled.png', 'da', 1),
(11, 'Uklanjanje kamenca', 3000, 'Uklanjanje kamenca koriscenjem najsavremenijih stomatoloskih tehnika', 'img/kamenac.png', 'da', 1),
(12, 'Beljenje zuba po vilici', 10000, 'Beljenje zuba laserom, gornje i donje vilice', 'img/izbeljivanje.jpg', 'da', 1),
(13, 'Endodonsko lecenje', 5000, 'Lecenje kanala korena', 'img/endodonsko.jpg', 'da', 1),
(14, 'Lecenje gangrene', 2500, 'Gangrena predstavlja jedan od najvecih izazova sa kojima se susrecu stomatolozi srom sveta. Nase visegodisnje iskustvo i poznavanje ove oblasti ce omoguciti Vas najbolji oporavak', 'img/gangrena.jpg', 'da', 1),
(15, 'Preprotetska priprema', 5000, 'Pre pocetka protetske terapije, kost i meka tkiva usta moraju biti zdravi', 'img/preprotetska.jpg', 'da', 2),
(16, 'Protetska priprema', 8000, 'Krezubost sa prekinutim zubnim nizom zahteva precizan radni model, bez obzira na vrstu materijala i tehniku otiskivanja.', 'img/protetska.jpg', 'da', 2),
(17, 'Parcijalna skeletirana proteza', 34499, 'Predstavljaju zubne proteze koje se oradjuju kada preostane mali broj zuba u vilici', 'img/parcijalna.jpg', 'da', 3),
(19, 'Direktno podlaganje proteze', 19999, 'Obavlja se u ordinaciji kada je proteza, usled resorpcije vilicne kosti postala velika i pocela da seta po ustima', 'img/podlaganje.jpg', 'da', 3),
(20, 'Fiksna proteza', 90000, 'Fikasa proteza za ispravljanje zuba, mogu biti regularne i lingvalne', 'img/fiksna.jpeg', 'da', 3),
(21, 'Ugradnja atacmena', 15000, 'Atecmeni su vrlo precizni vezni elementi koji sluze za spajanje fiksne nadoknade i mobilne percijalne proteze', 'img/atacmen.jpg', 'da', 4),
(22, 'Privremeni most po zubu', 154999, 'Predstavljaju fiksne naprave i odlican su nacin da se nadoknade izgubljeni zubi', 'img/most.jpg', 'da', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`kategorijaID`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`korisnickoime`);

--
-- Indexes for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD PRIMARY KEY (`rezervacijaId`);

--
-- Indexes for table `usluga`
--
ALTER TABLE `usluga`
  ADD PRIMARY KEY (`uslugaID`),
  ADD KEY `usluga_ibfk_1` (`kategorijaID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `kategorijaID` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `rezervacija`
--
ALTER TABLE `rezervacija`
  MODIFY `rezervacijaId` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `usluga`
--
ALTER TABLE `usluga`
  MODIFY `uslugaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usluga`
--
ALTER TABLE `usluga`
  ADD CONSTRAINT `usluga_ibfk_1` FOREIGN KEY (`kategorijaID`) REFERENCES `kategorije` (`kategorijaID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
