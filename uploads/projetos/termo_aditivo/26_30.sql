-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 07, 2018 at 12:19 AM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 7.2.9-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paps_helen`
--

-- --------------------------------------------------------

--
-- Table structure for table `relatorio_prestacao`
--

CREATE TABLE `relatorio_prestacao` (
  `id` int(11) NOT NULL,
  `data_prevista` datetime DEFAULT NULL,
  `data_enviada` datetime DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `situacao` varchar(40) DEFAULT NULL,
  `tipo_anexo` tinyint(4) DEFAULT NULL,
  `id_projeto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `relatorio_prestacao`
--
ALTER TABLE `relatorio_prestacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relatorio_prestacao_projeto_FK` (`id_projeto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `relatorio_prestacao`
--
ALTER TABLE `relatorio_prestacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `relatorio_prestacao`
--
ALTER TABLE `relatorio_prestacao`
  ADD CONSTRAINT `relatorio_prestacao_projeto_FK` FOREIGN KEY (`id_projeto`) REFERENCES `projeto` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
