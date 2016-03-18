-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Mar 18, 2016 alle 15:13
-- Versione del server: 10.0.23-MariaDB-0ubuntu0.15.10.1
-- Versione PHP: 5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lion`
--
CREATE DATABASE IF NOT EXISTS `lion` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `lion`;

-- --------------------------------------------------------

--
-- Struttura della tabella `AuthAssignment`
--

DROP TABLE IF EXISTS `AuthAssignment`;
CREATE TABLE `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `AuthAssignment`
--

INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Authority', '1', '', 's:0:'';'),
('Supervisor', '3', '', 's:0:'';');

-- --------------------------------------------------------

--
-- Struttura della tabella `AuthItem`
--

DROP TABLE IF EXISTS `AuthItem`;
CREATE TABLE `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `AuthItemChild`
--

DROP TABLE IF EXISTS `AuthItemChild`;
CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `AuthItemChild`
--

INSERT INTO `AuthItemChild` (`parent`, `child`) VALUES
('Assign', 'Roles'),
('Authority', 'Assign');

-- --------------------------------------------------------

--
-- Struttura della tabella `Cliente`
--

DROP TABLE IF EXISTS `Cliente`;
CREATE TABLE `Cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `conogme` varchar(32) NOT NULL,
  `codice_fiscale` varchar(64) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `Pratiche`
--

DROP TABLE IF EXISTS `Pratiche`;
CREATE TABLE `Pratiche` (
  `id` int(11) NOT NULL,
  `id_pratica` varchar(32) NOT NULL,
  `data_creazione` datetime NOT NULL,
  `stato_pratica` enum('open','close','','') NOT NULL,
  `note` text NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_migration`
--

DROP TABLE IF EXISTS `tbl_migration`;
CREATE TABLE `tbl_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1458310389),
('m160317_095632_User', 1458310390),
('m160317_095756_User', 1458310390),
('m160317_111459_AuthAssignment', 1458310390),
('m160317_111700_AuthItem', 1458310390),
('m160317_111906_AuthItemChild', 1458310390),
('m160317_135325_Cliente', 1458310390),
('m160317_154521_Pratiche', 1458310390);

-- --------------------------------------------------------

--
-- Struttura della tabella `User`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `User`
--

INSERT INTO `User` (`id`, `username`, `password`, `email`, `activkey`, `create_at`, `lastvisit_at`, `superuser`, `status`) VALUES
(1, 'admin', 'admin', 'webmaster@example.com', '9a24eff8c15a6a141ece27eb6947da0f', '2016-03-14 14:44:56', '0000-00-00 00:00:00', 1, 1),
(2, 'demo', 'demo', 'demo@example.com', '099f825543f7850cc038b90aaff39fac', '2016-03-14 14:44:56', '0000-00-00 00:00:00', 0, 1),
(3, 'supervisor', 'supervisor', 'supervisor@example.com', '', '2016-03-14 22:00:00', '0000-00-00 00:00:00', 0, 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `AuthAssignment`
--
ALTER TABLE `AuthAssignment`
  ADD PRIMARY KEY (`itemname`,`userid`);

--
-- Indici per le tabelle `AuthItemChild`
--
ALTER TABLE `AuthItemChild`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indici per le tabelle `Cliente`
--
ALTER TABLE `Cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `Pratiche`
--
ALTER TABLE `Pratiche`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Pratiche_ibfk_1` (`id_cliente`);

--
-- Indici per le tabelle `tbl_migration`
--
ALTER TABLE `tbl_migration`
  ADD PRIMARY KEY (`version`);

--
-- Indici per le tabelle `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Pratiche`
--
ALTER TABLE `Pratiche`
  ADD CONSTRAINT `Pratiche_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `Cliente` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;