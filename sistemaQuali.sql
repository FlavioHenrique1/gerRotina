-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Mar-2023 às 00:41
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistemaquali`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividade`
--

CREATE TABLE `atividade` (
  `id` int(11) NOT NULL,
  `atividade` varchar(150) NOT NULL,
  `prazo` varchar(40) NOT NULL,
  `responsavel` varchar(80) NOT NULL,
  `status` varchar(40) NOT NULL,
  `obs` text NOT NULL,
  `data` date NOT NULL,
  `dataCriacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividadesrot`
--

CREATE TABLE `atividadesrot` (
  `id` int(11) NOT NULL,
  `atividade` varchar(150) NOT NULL,
  `prazo` varchar(40) NOT NULL,
  `responsavel` varchar(80) NOT NULL,
  `status` varchar(40) NOT NULL,
  `obs` text NOT NULL,
  `data` date NOT NULL,
  `dataCriacao` datetime NOT NULL,
  `dia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `attempt`
--

CREATE TABLE `attempt` (
  `id` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `confirmation`
--

CREATE TABLE `confirmation` (
  `id` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `prontuario` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `senha` text NOT NULL,
  `dataNascimento` varchar(20) NOT NULL,
  `dataCriacao` datetime NOT NULL,
  `permissoes` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `atividade`
--
ALTER TABLE `atividade`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `atividadesrot`
--
ALTER TABLE `atividadesrot`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `attempt`
--
ALTER TABLE `attempt`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `confirmation`
--
ALTER TABLE `confirmation`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atividade`
--
ALTER TABLE `atividade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de tabela `atividadesrot`
--
ALTER TABLE `atividadesrot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
