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
-- Struktura tabeli dla tabeli `adverts`
--

CREATE TABLE `adverts` (
  `id_advert` int(11) NOT NULL,
  `advert_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `place_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `advert_added_date` datetime NOT NULL,
  `is_musical_instrument` tinyint(1) NOT NULL,
  `is_service` tinyint(1) NOT NULL,
  `is_song` tinyint(1) NOT NULL,
  `id_author` int(11) NOT NULL,
  `song_address` text COLLATE utf8_bin NOT NULL,
  `song_name` varchar(40) COLLATE utf8_bin NOT NULL,
  `likes` int(11) NOT NULL,
  `is_archived` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `adverts`
--

INSERT INTO `adverts` (`id_advert`, `advert_name`, `place_name`, `description`, `advert_added_date`, `is_musical_instrument`, `is_service`, `is_song`, `id_author`, `song_address`, `song_name`, `likes`, `is_archived`) VALUES
(9, 'Spare earbuds', 'England, London', 'I have spare earbuds to give to someone more in nedd', '2021-03-07 17:14:40', 1, 0, 0, 1, '', '', 0, 0),
(13, 'Gitarzysta szuka zespołu', 'Polska, Łódź', 'Nazywam się Janusz. Jestem miłośnikiem gry na banjo oraz gitarze. Mam kilka lat doświadczenia w grze z filharmonią Łódzką. Obenie szukam zespołu. Nie jest mi obce granie na impreazach okolicznościowych.\r\n', '2021-03-12 07:01:07', 0, 1, 0, 2, '', '', 5, 0),
(16, 'Solfeż elementarny', 'Polska, Licheń', 'Oddam za darmo, solfeż elementarny dla uczniów szkół muzycznych lub początkujących, samodzielnych miłośników muzyki.\r\nw zestawie inne, nuty ekstra, proszę pisać na czacie o szczegóły.', '2021-03-19 08:27:51', 1, 0, 0, 3, '', '', 0, 0),
(18, 'Słuchawki nauszne', 'Polska, Gniezno', 'Chętnię zamienię słuchawki nauszne, na douszne lub gotówkę. Słuhawki w dobrym stanie jednak wolę coś bardziej praktyzcnego, poręczniejszego.', '2021-03-15 18:17:21', 1, 0, 0, 56, '', '', 0, 0),
(19, 'Wiolonczela z duszą', 'Polska, Licheń', 'Mam do zaoferowania wiolonczelę razem ze smyczkiem 4/4. Ostatnio nikt na niej nie gra, być może przyda się komuś bardziej.', '2021-03-16 09:42:03', 1, 0, 0, 3, '', '', 0, 0),
(23, 'Piękna gitara z podpisem', 'Poland, Gdynia', 'Mam do sprzedania gitare akustyczna z podpisem samego Erica Claptona, ktory byl w Gdyni w 2005 Roku!', '2021-03-18 08:06:00', 1, 0, 0, 6, '', '', 0, 0),
(60, 'Używany saksofon', 'Polska, Radom', 'Witam. Mogę oddać w dobre ręce mój saksofon, niestety nie mam czasu praktykować gry na tym instrumencie.', '2021-03-12 18:59:26', 1, 0, 0, 5, '', '', 0, 0),
(62, 'Harfistka, muzyk', 'Polska, Katowice', 'Jestem absolwentką Katowickiej szkoły muzycznej. Obecnie poszukuję wyzwań muzycznych ;)', '2021-03-15 19:09:08', 0, 1, 0, 67, '', '', 2, 0),
(91, 'Mikrofon', 'Polska, Poznań', 'Witam, mam do oddania sprawny mikrofon radiowy z 2017, oddaję ponieważ kupuję lepszy. Po więcej informacji zapraszam do rozmowy na czacie lub kontaktu telefonicznego.', '2021-03-22 16:26:13', 1, 0, 0, 61, '', '', 0, 0),
(92, '', '', 'Wstawiam do oceny, dobra, mocna muzyka na imprezy ;)', '2021-03-24 19:35:53', 0, 0, 1, 62, 'https://firebasestorage.googleapis.com/v0/b/spolecznosciowaaplikacjawebowa.appspot.com/o/AdminPio%2FPURIDEVIL%20_%20DAFTAR%20POKER%20ONLINE%20_%20AGEN%20DOMINO%20_%20SITUS%20POKER%20_%20DAFTAR%20POKER.mp3?alt=media&token=5368a3a5-a1ca-4daa-8104-1c7310433083', 'ElectroParty', 3, 0),
(93, '', '', 'Utwór powstał pewnej soboty, w słoneczne popołudnie :)', '2021-03-24 19:43:39', 0, 0, 1, 63, 'https://firebasestorage.googleapis.com/v0/b/spolecznosciowaaplikacjawebowa.appspot.com/o/UserPio%2FPaul%20Pitman%20-%20Moonlight%20Sonata%20Op.%2027%20No.%202%20-%20II.%20Allegretto.mp3?alt=media&token=d9052a53-8be5-4a22-8a7d-b64b30a118d4', 'Sesja 12 - pianino', 1, 0),
(94, '', '', 'Utwór wykonany w celu doskonalenia gry na gitarze, a dokładnie techniki \"fingerstyle\".\nMam nadzieję, że się spodoba.', '2021-03-24 19:53:12', 0, 0, 1, 58, 'https://firebasestorage.googleapis.com/v0/b/spolecznosciowaaplikacjawebowa.appspot.com/o/ArekMarek%2FPonce%20-%20Preludio%20in%20E%20Major.mp3?alt=media&token=29817b2c-cf12-4c6e-8372-ebdd4c34a94b', 'Preludium myśli', 1, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adverts`
--
ALTER TABLE `adverts`
  ADD PRIMARY KEY (`id_advert`),
  ADD KEY `id_user` (`id_author`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `adverts`
--
ALTER TABLE `adverts`
  MODIFY `id_advert` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `adverts`
--
ALTER TABLE `adverts`
  ADD CONSTRAINT `adverts_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `users` (`id_user`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
