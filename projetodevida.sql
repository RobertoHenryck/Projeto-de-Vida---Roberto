-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/04/2025 às 20:26
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
-- Estrutura para tabela `objetivos`
--

CREATE TABLE `objetivos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `prazo` varchar(255) NOT NULL,
  `tipo_prazo` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `update_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `plano_acao`
--

CREATE TABLE `plano_acao` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `area` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `prazo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `profissoes`
--

CREATE TABLE `profissoes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `areas_atuacao` varchar(255) NOT NULL,
  `salario_medio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `respostas_autoconhecimento`
--

CREATE TABLE `respostas_autoconhecimento` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pergunta` varchar(255) NOT NULL,
  `resposta` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sonhos`
--

CREATE TABLE `sonhos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `acoes_atuais` varchar(255) NOT NULL,
  `acoes_futuras` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `teste_inteligencia`
--

CREATE TABLE `teste_inteligencia` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `resultado` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `teste_personalidade`
--

CREATE TABLE `teste_personalidade` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `tipo_teste` varchar(255) NOT NULL,
  `resultado` varchar(255) NOT NULL,
  `data` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sobre_mim` varchar(300) NOT NULL,
  `foto_perfil` varchar(255) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `update_at` timestamp(5) NOT NULL DEFAULT current_timestamp(5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `objetivos`
--
ALTER TABLE `objetivos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `plano_acao`
--
ALTER TABLE `plano_acao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `profissoes`
--
ALTER TABLE `profissoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `respostas_autoconhecimento`
--
ALTER TABLE `respostas_autoconhecimento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sonhos`
--
ALTER TABLE `sonhos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `teste_inteligencia`
--
ALTER TABLE `teste_inteligencia`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `teste_personalidade`
--
ALTER TABLE `teste_personalidade`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `objetivos`
--
ALTER TABLE `objetivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `plano_acao`
--
ALTER TABLE `plano_acao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `profissoes`
--
ALTER TABLE `profissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `respostas_autoconhecimento`
--
ALTER TABLE `respostas_autoconhecimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sonhos`
--
ALTER TABLE `sonhos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `teste_inteligencia`
--
ALTER TABLE `teste_inteligencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `teste_personalidade`
--
ALTER TABLE `teste_personalidade`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
