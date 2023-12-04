-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Dic 04, 2023 alle 13:41
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spugnaTV`
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

-- --------------------------------------------------------

--
-- Struttura della tabella `Film`
--

CREATE TABLE `Film` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `anno` int(11) NOT NULL,
  `durata` int(11) NOT NULL,
  `genere` varchar(255) DEFAULT NULL,
  `trama` varchar(1000) DEFAULT NULL,
  `locandina` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Lista`
--

CREATE TABLE `Lista` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `utente_mail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `desccrizione` varchar(1000) DEFAULT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Utente`
--

CREATE TABLE `Utente` (
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto_profilo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indici per le tabelle `Lista`
--
ALTER TABLE `Lista`
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
-- Indici per le tabelle `Utente`
--
ALTER TABLE `Utente`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Attori`
--
ALTER TABLE `Attori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Film`
--
ALTER TABLE `Film`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Lista`
--
ALTER TABLE `Lista`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Recensioni`
--
ALTER TABLE `Recensioni`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Registi`
--
ALTER TABLE `Registi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
