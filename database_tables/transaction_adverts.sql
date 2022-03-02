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
-- Struktura tabeli dla tabeli `transaction_adverts`
--

CREATE TABLE `transaction_adverts` (
  `id_transaction_advert` int(11) NOT NULL,
  `id_advert` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `id_user_requested` int(11) NOT NULL,
  `offer_start` tinyint(1) NOT NULL,
  `offer_confirmed` tinyint(1) NOT NULL,
  `author_confirm_success` tinyint(1) NOT NULL,
  `user_confirm_success` tinyint(1) NOT NULL,
  `offer_success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `transaction_adverts`
--

INSERT INTO `transaction_adverts` (`id_transaction_advert`, `id_advert`, `id_author`, `id_user_requested`, `offer_start`, `offer_confirmed`, `author_confirm_success`, `user_confirm_success`, `offer_success`) VALUES
(8, 13, 2, 1, 1, 0, 0, 0, 0),
(9, 60, 62, 3, 1, 1, 1, 1, 1),
(10, 91, 61, 62, 1, 0, 0, 0, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `transaction_adverts`
--
ALTER TABLE `transaction_adverts`
  ADD PRIMARY KEY (`id_transaction_advert`),
  ADD KEY `id_advert` (`id_advert`),
  ADD KEY `id_author` (`id_author`),
  ADD KEY `id_user_requested` (`id_user_requested`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `transaction_adverts`
--
ALTER TABLE `transaction_adverts`
  MODIFY `id_transaction_advert` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `transaction_adverts`
--
ALTER TABLE `transaction_adverts`
  ADD CONSTRAINT `transaction_adverts_ibfk_1` FOREIGN KEY (`id_advert`) REFERENCES `adverts` (`id_advert`),
  ADD CONSTRAINT `transaction_adverts_ibfk_2` FOREIGN KEY (`id_author`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `transaction_adverts_ibfk_3` FOREIGN KEY (`id_user_requested`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
