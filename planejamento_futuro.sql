-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/04/2025 às 20:04
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projetodevida`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `planejamento_futuro`
--

CREATE TABLE `planejamento_futuro` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `minhas_aspiracoes` text NOT NULL,
  `meu_sonho_infancia` text NOT NULL,
  `escolha_profissional` varchar(255) NOT NULL,
  `detalhes_profissao` text DEFAULT NULL,
  `meus_sonhos` text NOT NULL,
  `o_que_ja_faco` text NOT NULL,
  `o_que_preciso_fazer` text NOT NULL,
  `objetivo_curto_prazo` text NOT NULL,
  `objetivo_medio_prazo` text NOT NULL,
  `objetivo_longo_prazo` text NOT NULL,
  `visao_10_anos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `planejamento_futuro`
--
ALTER TABLE `planejamento_futuro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `planejamento_futuro`
--
ALTER TABLE `planejamento_futuro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `planejamento_futuro`
--
ALTER TABLE `planejamento_futuro`
  ADD CONSTRAINT `planejamento_futuro_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
