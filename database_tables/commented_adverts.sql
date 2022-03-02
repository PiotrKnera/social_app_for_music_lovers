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
-- Struktura tabeli dla tabeli `commented_adverts`
--

CREATE TABLE `commented_adverts` (
  `id_com_advert` int(11) NOT NULL,
  `id_advert` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comment_added_date` datetime NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `commented_adverts`
--

INSERT INTO `commented_adverts` (`id_com_advert`, `id_advert`, `id_user`, `comment_added_date`, `content`) VALUES
(4, 18, 3, '0000-00-00 00:00:00', ''),
(5, 16, 1, '0000-00-00 00:00:00', ''),
(15, 18, 62, '2021-03-02 04:47:10', 'Pretty good musician!'),
(20, 18, 62, '2021-03-13 19:05:24', 'hello'),
(21, 18, 62, '2021-03-13 19:05:28', 'sdf'),
(22, 18, 62, '2021-03-13 19:05:31', 'sdf'),
(32, 62, 62, '2021-03-24 21:26:08', 'Polecam i pozdrawiam ! :)');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `commented_adverts`
--
ALTER TABLE `commented_adverts`
  ADD PRIMARY KEY (`id_com_advert`),
  ADD KEY `id_trip` (`id_advert`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `commented_adverts`
--
ALTER TABLE `commented_adverts`
  MODIFY `id_com_advert` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `commented_adverts`
--
ALTER TABLE `commented_adverts`
  ADD CONSTRAINT `commented_adverts_ibfk_1` FOREIGN KEY (`id_advert`) REFERENCES `adverts` (`id_advert`) ON UPDATE CASCADE,
  ADD CONSTRAINT `commented_adverts_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
