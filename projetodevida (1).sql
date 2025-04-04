-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/04/2025 às 20:08
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
-- Estrutura para tabela `quemsou`
--

CREATE TABLE `quemsou` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fale_sobre_voce` text DEFAULT NULL,
  `minhas_lembrancas` text DEFAULT NULL,
  `pontos_fortes` text DEFAULT NULL,
  `pontos_fracos` text DEFAULT NULL,
  `meus_valores` text DEFAULT NULL,
  `minhas_aptidoes` text DEFAULT NULL,
  `meus_relacionamentos` text DEFAULT NULL,
  `o_que_gosto` text DEFAULT NULL,
  `o_que_nao_gosto` text DEFAULT NULL,
  `rotina_lazer_estudos` text DEFAULT NULL,
  `minha_vida_escolar` text DEFAULT NULL,
  `visao_fisica` text DEFAULT NULL,
  `visao_intelectual` text DEFAULT NULL,
  `visao_emocional` text DEFAULT NULL,
  `visao_pessoas_sobre_mim` text DEFAULT NULL,
  `autovalorizacao` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `quemsou`
--

INSERT INTO `quemsou` (`id`, `user_id`, `fale_sobre_voce`, `minhas_lembrancas`, `pontos_fortes`, `pontos_fracos`, `meus_valores`, `minhas_aptidoes`, `meus_relacionamentos`, `o_que_gosto`, `o_que_nao_gosto`, `rotina_lazer_estudos`, `minha_vida_escolar`, `visao_fisica`, `visao_intelectual`, `visao_emocional`, `visao_pessoas_sobre_mim`, `autovalorizacao`, `created_at`, `updated_at`) VALUES
(1, 4, 'kkk', 'ioni0o', 'ionion', 'oinj', 'nnon', 'ionio', 'niono', 'inion', 'ion', 'oino', 'inio', 'noi', 'n', 'oinion', 'ion', 0, '2025-04-04 17:38:04', '2025-04-04 17:38:04');

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
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `q1` varchar(10) DEFAULT NULL,
  `q2` varchar(10) DEFAULT NULL,
  `q3` varchar(10) DEFAULT NULL,
  `q4` varchar(10) DEFAULT NULL,
  `q5` varchar(10) DEFAULT NULL,
  `q6` varchar(10) DEFAULT NULL,
  `q7` varchar(10) DEFAULT NULL,
  `q8` varchar(10) DEFAULT NULL,
  `q9` varchar(10) DEFAULT NULL,
  `q10` varchar(10) DEFAULT NULL,
  `q11` varchar(10) DEFAULT NULL,
  `q12` varchar(10) DEFAULT NULL,
  `q13` varchar(10) DEFAULT NULL,
  `q14` varchar(10) DEFAULT NULL,
  `q15` varchar(10) DEFAULT NULL,
  `q16` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `teste_inteligencia`
--

INSERT INTO `teste_inteligencia` (`id`, `user_id`, `resultado`, `data`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`, `q13`, `q14`, `q15`, `q16`) VALUES
(1, 1, '', '2025-04-03 19:04:55', 'A', 'A', 'B', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A'),
(2, 1, '', '2025-04-03 19:10:32', 'A', 'A', 'B', 'B', 'B', 'B', 'B', 'A', 'A', 'A', 'A', 'A', 'B', 'B', 'B', 'B'),
(3, 1, '', '2025-04-03 19:10:55', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'A', 'B', 'B', 'B', 'B'),
(4, 1, '', '2025-04-03 19:14:28', 'A', 'A', 'B', 'A', 'A', 'B', 'B', 'A', 'A', 'B', 'B', 'A', 'A', 'B', 'B', 'A'),
(5, 4, '', '2025-04-04 10:33:42', 'A', 'B', 'A', 'A', 'B', 'B', 'B', 'A', 'B', 'A', 'A', 'B', 'B', 'A', 'A', 'B'),
(6, 4, '', '2025-04-04 11:00:14', 'A', 'B', 'A', 'B', 'A', 'B', 'A', 'B', 'A', 'B', 'A', 'B', 'A', 'B', 'A', 'A'),
(7, 5, '', '2025-04-04 12:34:42', 'A', 'A', 'B', 'B', 'A', 'A', 'A', 'B', 'B', 'A', 'B', 'A', 'A', 'B', 'A', 'B'),
(8, 5, '', '2025-04-04 11:39:57', 'A', 'B', 'B', 'A', 'A', 'B', 'B', 'B', 'B', 'B', 'B', 'A', 'A', 'A', 'A', 'A'),
(9, 5, 'Inteligência Linguística - Você se comunica bem e gosta de ler e escrever.', '2025-04-04 12:44:54', 'B', 'A', 'B', 'A', 'B', 'B', 'A', 'B', 'B', 'A', 'B', 'A', 'A', 'A', 'B', 'B'),
(10, 4, '', '2025-04-04 13:02:31', 'B', 'A', 'A', 'A', 'A', 'B', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'B'),
(11, 4, '{\"musical\":1,\"logico\":1,\"corporal\":2,\"linguistica\":2,\"interpessoal\":2,\"intrapessoal\":2,\"naturalista\":2,\"emocional\":2}', '2025-04-04 13:09:24', 'B', 'B', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A'),
(12, 4, '{\"musical\":2,\"logico\":1,\"corporal\":2,\"linguistica\":1,\"interpessoal\":2,\"intrapessoal\":0,\"naturalista\":1,\"emocional\":2}', '2025-04-04 13:14:58', 'A', 'A', 'A', 'A', 'A', 'B', 'B', 'A', 'A', 'B', 'A', 'B', 'A', 'B', 'A', 'A'),
(13, 4, '{\"musical\":2,\"logico\":2,\"corporal\":2,\"linguistica\":2,\"interpessoal\":1,\"intrapessoal\":1,\"naturalista\":1,\"emocional\":1}', '2025-04-04 13:30:08', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'B', 'B', 'B', 'B'),
(14, 6, '{\"musical\":2,\"logico\":0,\"corporal\":1,\"linguistica\":1,\"interpessoal\":2,\"intrapessoal\":0,\"naturalista\":1,\"emocional\":1}', '2025-04-04 16:35:21', 'A', 'B', 'B', 'A', 'A', 'B', 'B', 'A', 'A', 'B', 'A', 'B', 'A', 'B', 'A', 'B');

-- --------------------------------------------------------

--
-- Estrutura para tabela `teste_personalidade`
--

CREATE TABLE `teste_personalidade` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `tipo_teste` varchar(255) NOT NULL,
  `resultado` varchar(255) NOT NULL,
  `data` datetime(6) NOT NULL,
  `q1` varchar(10) DEFAULT NULL,
  `q2` varchar(10) DEFAULT NULL,
  `q3` varchar(10) DEFAULT NULL,
  `q4` varchar(10) DEFAULT NULL,
  `q5` varchar(10) DEFAULT NULL,
  `q6` varchar(10) DEFAULT NULL,
  `q7` varchar(10) DEFAULT NULL,
  `q8` varchar(10) DEFAULT NULL,
  `q9` varchar(10) DEFAULT NULL,
  `q10` varchar(10) DEFAULT NULL,
  `q11` varchar(10) DEFAULT NULL,
  `q12` varchar(10) DEFAULT NULL,
  `q13` varchar(10) DEFAULT NULL,
  `q14` varchar(10) DEFAULT NULL,
  `q15` varchar(10) DEFAULT NULL,
  `q16` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `teste_personalidade`
--

INSERT INTO `teste_personalidade` (`id`, `user_id`, `tipo_teste`, `resultado`, `data`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`, `q13`, `q14`, `q15`, `q16`) VALUES
(1, 1, '', 'Introvertido e reflexivo', '2025-04-03 15:21:20.000000', 'azul', 'soziho', 'nao muito', 'planejar', 'verao', 'criativo', 'nao', 'fico louco', 'lugares tr', 'Um homem f', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, '', 'Equilibrado e Adaptável', '2025-04-03 15:41:42.000000', 'B', 'C', 'C', 'D', 'D', 'B', 'A', 'D', 'B', 'C', 'C', 'D', 'D', 'C', 'B', 'B'),
(3, 1, '', 'Equilibrado e Adaptável - Você consegue se ajustar a qualquer situação.', '2025-04-03 15:43:26.000000', 'D', 'B', 'B', 'B', 'B', 'D', 'A', 'C', 'B', 'B', 'A', 'C', 'B', 'C', 'B', 'B'),
(4, 4, '', 'Equilibrado e Adaptável - Você consegue se ajustar a qualquer situação.', '2025-04-04 07:31:41.000000', 'C', 'C', 'A', 'A', 'C', 'B', 'C', 'C', 'B', 'A', 'D', 'B', 'A', 'B', 'A', 'C'),
(5, 4, '', 'Equilibrado e Adaptável - Você consegue se ajustar a qualquer situação.', '2025-04-04 08:01:25.000000', 'D', 'D', 'D', 'C', 'C', 'C', 'B', 'B', 'A', 'B', 'D', 'D', 'B', 'B', 'A', 'D'),
(6, 6, '', 'Criativo e Comunicativo - Você gosta de inovação e interação.', '2025-04-04 13:34:47.000000', 'C', 'B', 'C', 'C', 'C', 'C', 'A', 'B', 'C', 'C', 'C', 'C', 'B', 'D', 'C', 'B');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  `senha` varchar(255) NOT NULL,
  `sobre_mim` varchar(300) NOT NULL,
  `foto_perfil` varchar(255) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `update_at` timestamp(5) NOT NULL DEFAULT current_timestamp(5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `data_nascimento`, `senha`, `sobre_mim`, `foto_perfil`, `created_at`, `update_at`) VALUES
(1, 'roberto', 'rafaelwi@gmail.com', '2007-10-05', '$2y$10$Zh6LJxdXtpkjdeVlw4d6EOoFbUX7k7VSp2hC2GZPAZavX.Hibfui.', '', 'perfil_1.png', '2025-04-02 23:39:15.369661', '2025-04-02 23:14:05.85230'),
(2, 'ERIC', 'erci@gmail.com', '2016-02-02', '$2y$10$34nWG8DhVPZNuhhVese7cOArrq1d26Ofz/ktTeD.FdooVlt5mwQ1y', '', '', '2025-04-02 23:31:10.550991', '2025-04-02 23:31:10.55099'),
(3, 'Betao', 'beto@gmail.com', '2007-10-05', '$2y$10$N4M6XcfdgApvqIksMhICouQsdbC/yB7Hl6/TXxo7cRq5XfhuymHfG', '', 'perfil_3.png', '2025-04-03 17:35:48.048194', '2025-04-03 17:35:06.97874'),
(4, 'rafa', 'roberto@gmailcom', '2019-02-05', '$2y$10$bZPaY94Ok1VMQvVGY4PX0.QTW43ao/QMrzWV1LmtkMdokhS92XxU.', 'VAI TOMAR NO CU PORRA', 'perfil_4_1743784359.png', '2025-04-04 16:32:39.376271', '2025-04-04 10:26:57.67227'),
(5, 'fabio', 'fabio@gmailcom', '2024-05-01', '$2y$10$UeooIybwa2TEy7fpzqypweq.ZMeKKHS1sTevRX5Ixf8jAuQXEQOT6', '', '', '2025-04-04 10:43:22.673886', '2025-04-04 10:43:22.67388'),
(6, 'beto', 'angeli@gmail.com', '2007-10-05', '$2y$10$DZsuTO5bQa//XLDxp0F3nuRSRXixhYBpY3IdOc/xp1djIs0waRG5y', '', 'perfil_6_1743784466.png', '2025-04-04 16:34:26.920888', '2025-04-04 16:31:56.14404');

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
-- Índices de tabela `quemsou`
--
ALTER TABLE `quemsou`
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
-- AUTO_INCREMENT de tabela `planejamento_futuro`
--
ALTER TABLE `planejamento_futuro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `quemsou`
--
ALTER TABLE `quemsou`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `teste_inteligencia`
--
ALTER TABLE `teste_inteligencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `teste_personalidade`
--
ALTER TABLE `teste_personalidade`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
