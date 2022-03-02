-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 25 Mar 2021, 12:23
-- Wersja serwera: 10.4.8-MariaDB
-- Wersja PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `spolecznosciowa_aplikacja_webowa`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `liked_adverts`
--

CREATE TABLE `liked_adverts` (
  `id_li_advert` int(11) NOT NULL,
  `id_advert` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `liked_adverts`
--

INSERT INTO `liked_adverts` (`id_li_advert`, `id_advert`, `id_user`) VALUES
(2, 9, 3),
(300, 13, 62),
(267, 18, 62),
(278, 18, 63),
(299, 62, 62),
(281, 62, 63),
(297, 92, 58),
(294, 92, 62),
(295, 92, 63),
(296, 93, 63),
(298, 94, 58);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `liked_adverts`
--
ALTER TABLE `liked_adverts`
  ADD PRIMARY KEY (`id_li_advert`),
  ADD KEY `id_trip` (`id_advert`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `liked_adverts`
--
ALTER TABLE `liked_adverts`
  MODIFY `id_li_advert` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `liked_adverts`
--
ALTER TABLE `liked_adverts`
  ADD CONSTRAINT `liked_adverts_ibfk_1` FOREIGN KEY (`id_advert`) REFERENCES `adverts` (`id_advert`) ON UPDATE CASCADE,
  ADD CONSTRAINT `liked_adverts_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
