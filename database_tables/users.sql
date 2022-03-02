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
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `surname` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  `phone` text COLLATE utf8_bin NOT NULL,
  `verification_code` mediumtext COLLATE utf8_bin NOT NULL,
  `is_verificated` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id_user`, `username`, `name`, `surname`, `email`, `password`, `phone`, `verification_code`, `is_verificated`, `is_admin`) VALUES
(1, 'Mareck74', 'Tomasz', 'Luharchuck', 'Mareck74@gmail.com', '11990ad38fcf1d5f239472dde7972942', '515-123-111', '93018515a2d08215199247a465c5c393', 1, 0),
(2, 'JanuszTraveler', 'Janusz', 'Muzykant', 'JanuszLewandowski@yahoo.com', '11990ad38fcf1d5f239472dde7972942', '145-321-222', '1ff7b8aed9dd2d4862da859359d3672a', 1, 0),
(3, 'AdaBest02', 'Adrianna', 'Bestowska', 'a@yahoo.com', '11990ad38fcf1d5f239472dde7972942', '111-212-444', 'fa07d9106dfa2cbbc322efb464859fff', 1, 0),
(4, 'Werq99', 'Wronika', 'Kumowska', 'WeronikaKumowska@gmail.com', '11990ad38fcf1d5f239472dde7972942', '333-333-234', '6737fbcda5adda3747ba5dae3a9244c9', 1, 0),
(5, 'JohnB95', 'John', 'Brick', 'JohnBrick@gmail.com', '11990ad38fcf1d5f239472dde7972942', '765-654-543', '4a2e47d76905c30cb8131b1de94ca2c9', 1, 0),
(6, 'emDJ1', 'Henryk', 'Dobrowicz', 'eniuRick@gmail.com', '11990ad38fcf1d5f239472dde7972942', '111-222-333', '7ae0d9f6283a46ff7e7c13f5c114426e', 1, 0),
(56, 'Anatol', 'Andrzej', 'Tolarczuk', 'AndriuT32@outlook.com', '11990ad38fcf1d5f239472dde7972942', '345-543-345', '8d872cdbdd93a4b5ef45e2b6209fc610', 1, 0),
(57, 'JanekObserwator2', 'Janusz', 'Poracz', 'janek89@gmail.com', '11990ad38fcf1d5f239472dde7972942', '191-282-373', 'f4697ff20b508691f2c8f8b1927a3dc6', 1, 0),
(58, 'ArekMarek', 'Marek', 'Tadeusz', 'Maroslaw77@gmail.com', '11990ad38fcf1d5f239472dde7972942', '111-222-111', 'd4b0357c2bec573f88852a987b34266a', 1, 0),
(61, 'tomekNowak', 'Tomasz', 'Nowicki', 'TomaszNowicki65@gmail.com', '11990ad38fcf1d5f239472dde7972942', '565-777-333', '43477d08528eb71945140ae7f7854e5e', 1, 0),
(62, 'AdminPio', 'Piotr', 'Knera', 'admin@gmail.com', '11990ad38fcf1d5f239472dde7972942', '123-123-987', '58a8667c713fcf1d3f8c340139ad18c7', 1, 1),
(63, 'UserPio', 'Piotr', 'Piotrowiczowski', 'user@gmail.com', '11990ad38fcf1d5f239472dde7972942', '123-111-123', 'c826d261fc5d605de298dd7e60918ba7', 1, 0),
(64, 'Halabarda', 'Jack', 'Matcher', 'JackRocket1@outlook.com', '11990ad38fcf1d5f239472dde7972942', '123-496-222', '7d6b5062dc675c3555bc861d44faeced', 1, 0),
(67, 'RavenmaC', 'Jessica', 'Whis', 'JesWhis0@outlook.com', '11990ad38fcf1d5f239472dde7972942', '123-123-123', 'b1202d57bfa5276416292eed6daea816', 1, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
