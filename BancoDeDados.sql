-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Out-2022 às 01:49
-- Versão do servidor: 8.0.29
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `trabalho`
--
CREATE DATABASE IF NOT EXISTS `trabalho` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `trabalho`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `Id` int NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Telefone` varchar(35) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Excluido` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`Id`, `Nome`, `Telefone`, `Email`, `Excluido`) VALUES
(15, 'Ferreira', '14999064595', 'maciel@gmail.com', 0),
(16, 'Michael jackson', '14999064595', 'maciel@gmail.com', 0),
(17, 'Oscar', '14999055445', 'juan@gmail.com', 0),
(18, 'Erick', '149974554', 'maaciel123@gmail.com', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itempedido`
--

CREATE TABLE `itempedido` (
  `Id` int NOT NULL,
  `IdPedido` int NOT NULL,
  `IdProduto` int NOT NULL,
  `ValorUnitario` decimal(10,0) NOT NULL,
  `Qtd` int NOT NULL,
  `Excluido` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `itempedido`
--

INSERT INTO `itempedido` (`Id`, `IdPedido`, `IdProduto`, `ValorUnitario`, `Qtd`, `Excluido`) VALUES
(47, 16, 1, '2', 1, 0),
(48, 16, 2, '4', 2, 0),
(49, 16, 1, '5', 3, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `Id` int NOT NULL,
  `IdCliente` int NOT NULL,
  `Total` decimal(10,0) DEFAULT NULL,
  `Excluido` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`Id`, `IdCliente`, `Total`, `Excluido`) VALUES
(16, 15, '12', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `Id` int NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Descricao` text NOT NULL,
  `Preco` float NOT NULL,
  `Excluido` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`Id`, `Nome`, `Descricao`, `Preco`, `Excluido`) VALUES
(1, 'Arroz', 'Arroz Para Feijoada 1kg', 11, 0),
(2, 'sabão em po', 'cheiro de coco', 5, 0),
(3, 'Feijão', 'Feijão Normal', 4, 0),
(4, 'Carne Vermelha', 'Carne de Boi', 100, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `itempedido`
--
ALTER TABLE `itempedido`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `itempedido`
--
ALTER TABLE `itempedido`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
