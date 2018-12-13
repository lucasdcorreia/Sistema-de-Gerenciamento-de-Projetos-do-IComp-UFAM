-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 24-Set-2018 às 14:51
-- Versão do servidor: 5.7.21-1
-- PHP Version: 7.2.4-1+b1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projetos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m140506_102106_rbac_init', 1458853453);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shortname` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `visualizacao_candidatos` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visualizacao_candidatos_finalizados` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visualizacao_cartas_respondidas` datetime NOT NULL,
  `administrador` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coordenador` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secretaria` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `professor` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `aluno` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `siape` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dataIngresso` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telcelular` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telresidencial` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unidade` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulacao` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `classe` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nivel` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `regime` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `turno` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idLattes` bigint(20) DEFAULT NULL,
  `formacao` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resumo` text COLLATE utf8_unicode_ci,
  `alias` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ultimaAtualizacao` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idRH` int(11) DEFAULT NULL,
  `cargo` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `nome`, `username`, `shortname`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `visualizacao_candidatos`, `visualizacao_candidatos_finalizados`, `visualizacao_cartas_respondidas`, `administrador`, `coordenador`, `secretaria`, `professor`, `aluno`, `siape`, `dataIngresso`, `endereco`, `telcelular`, `telresidencial`, `unidade`, `titulacao`, `classe`, `nivel`, `regime`, `turno`, `idLattes`, `formacao`, `resumo`, `alias`, `ultimaAtualizacao`, `idRH`, `cargo`) VALUES
(78, 'Usuário Todo Poderoso', '878.832.797-34', NULL, 'dr-kWlFrkClQ-u-D8bscat9gfqapwxKI', '$2y$13$lPFaaNl2E3ZcfbNUC5VzCu5DPQ0D7MtdSGby6Djy9TIgBbtbQ5T7y', NULL, 'utp@icomp.ufam.edu.br', 10, NULL, NULL, '2018-09-21 11:10:56', '2018-09-21 11:10:56', '2018-09-21 11:10:56', '1', '1', '1', '1', NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '', NULL, NULL, ''),
(80, 'David Fernandes', '600.808.762-34', NULL, 'LT6hrlCNFGGG7X_5h2MuyHAfYLHaImfv', '$2y$13$pweiTb780XjoNOkFfFs4qeVx0J4ZSZYBmI/go6flDPJScneyR/JPy', NULL, 'david@teste.com', 10, '2018-09-24 13:49:24', '2018-09-24 13:49:24', '2018-09-24 13:49:24', '2018-09-24 13:49:24', '2018-09-24 13:49:24', '0', '0', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `atualizaFinalizado` ON SCHEDULE EVERY 1 DAY STARTS '2016-09-29 19:03:31' ON COMPLETION PRESERVE ENABLE DO UPDATE j17_contproj_projetos SET status = 'Encerrado' WHERE data_fim_alterada < CURDATE()$$

CREATE DEFINER=`root`@`localhost` EVENT `atualizaIniciado` ON SCHEDULE EVERY 1 DAY STARTS '2016-09-29 19:04:01' ON COMPLETION PRESERVE ENABLE DO UPDATE j17_contproj_projetos SET status = 'Ativo' WHERE status != 'Ativo' AND data_inicio >= CURDATE()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
