-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Dic 19, 2023 alle 23:33
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `SpugnaTV` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `SpugnaTV`;
--
-- Database: `SpugnaTV`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Attori`
--

CREATE TABLE `Attori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Attori`
--

INSERT INTO `Attori` (`id`, `nome`, `cognome`, `foto`) VALUES
(1, 'Elijah ', 'Wood', ''),
(2, 'Bread', 'Pitt', ''),
(3, 'Leonardo', 'Di Caprio', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `Comprende`
--

CREATE TABLE `Comprende` (
  `lista_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Dirige`
--

CREATE TABLE `Dirige` (
  `film_id` int(11) NOT NULL,
  `registi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Dirige`
--

INSERT INTO `Dirige` (`film_id`, `registi_id`) VALUES
(1, 2),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Film`
--

CREATE TABLE `Film` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titolo` varchar(1000) NOT NULL,
  `anno` int(11) NOT NULL,
  `durata` int(11) NOT NULL,
  `genere` varchar(500) DEFAULT NULL,
  `trama` varchar(10000) DEFAULT NULL,
  `locandina` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Film`
--

INSERT INTO `Film` (`id`, `titolo`, `anno`, `durata`, `genere`, `trama`, `locandina`, `banner`) VALUES
(1, 'Il Signore degli Anelli', 2001, 178, 'Fantasy', 'Un mite Hobbit ', '', ''),
(3, 'Bastardi Senza Gloria', 2009, 153, 'Guerra - Drammatico', 'Nella Francia occupata dai nazisti durante la seconda guerra mondiale, un progetto per assassinare i leader nazisti da parte di un gruppo di soldati ebrei americani coincide con i stessi piani vendicativi della proprietaria di un cinema', '', ''),
(4, 'Cera una volta... a Hollywood', 2019, 169, 'Commedia', 'un attore televisivo e la sua controfigura intraprendono un\'odissea per affermarsi nell\'industria cinematografica nella Los Angeles del 1969, segnata dagli omicidi di Charles Manson.', '', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `Liste`
--

CREATE TABLE `Liste` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `utente_mail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Liste`
--

INSERT INTO `Liste` (`id`, `nome`, `utente_mail`) VALUES
(1, 'Film visti', 'gabrisonzo@gmail.com'),
(2, 'Film da vedere', 'gabrisonzo@gmail.com'),
(3, 'Film visti', 'fabio.oberti@gmail.com'),
(4, 'Film da vedere', 'fabio.oberti@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `Recensioni`
--

CREATE TABLE `Recensioni` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nStelle` int(11) NOT NULL,
  `commento` varchar(1000) DEFAULT NULL,
  `utente_mail` varchar(255) DEFAULT NULL,
  `film_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Recita`
--

CREATE TABLE `Recita` (
  `film_id` int(11) NOT NULL,
  `attori_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Recita`
--

INSERT INTO `Recita` (`film_id`, `attori_id`) VALUES
(1, 1),
(3, 2),
(4, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `Registi`
--

CREATE TABLE `Registi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `data_nascita` date NOT NULL,
  `data_morte` date DEFAULT NULL,
  `descrizione` varchar(10000) DEFAULT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Registi`
--

INSERT INTO `Registi` (`id`, `nome`, `cognome`, `data_nascita`, `data_morte`, `descrizione`, `foto`) VALUES
(1, 'Quentin', 'Tarantino', '1963-06-25', '1970-01-01', 'È sposato con Daniella Pick dal 28 novembre 2018. Hanno due figli/e.', ''),
(2, 'Peter', 'Jackson', '1955-08-07', '1970-01-01', 'È sposato con Fran Walsh dal 1987. Hanno due figli/e.', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `Utenti`
--

CREATE TABLE `Utenti` (
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto_profilo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Utenti`
--

INSERT INTO `Utenti` (`email`, `username`, `password`, `foto_profilo`) VALUES
('fabio.oberti@gmail.com', 'FabioObe', 'a53bd0415947807bcb95ceec535820ee', NULL),
('gabrisonzo@gmail.com', 'GabrySonzo', '21232f297a57a5a743894a0e4a801fc3', NULL);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Attori`
--
ALTER TABLE `Attori`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `Comprende`
--
ALTER TABLE `Comprende`
  ADD PRIMARY KEY (`lista_id`,`film_id`);

--
-- Indici per le tabelle `Dirige`
--
ALTER TABLE `Dirige`
  ADD PRIMARY KEY (`film_id`,`registi_id`);

--
-- Indici per le tabelle `Film`
--
ALTER TABLE `Film`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `Liste`
--
ALTER TABLE `Liste`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `Recensioni`
--
ALTER TABLE `Recensioni`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `Recita`
--
ALTER TABLE `Recita`
  ADD PRIMARY KEY (`film_id`,`attori_id`);

--
-- Indici per le tabelle `Registi`
--
ALTER TABLE `Registi`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `Utenti`
--
ALTER TABLE `Utenti`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Attori`
--
ALTER TABLE `Attori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `Film`
--
ALTER TABLE `Film`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `Liste`
--
ALTER TABLE `Liste`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `Recensioni`
--
ALTER TABLE `Recensioni`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Registi`
--
ALTER TABLE `Registi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
