-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Out-2022 às 16:50
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE DATABASE trabalho;
use trabalho;

CREATE TABLE `cliente` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Telefone` varchar(35) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Excluido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`Id`, `Nome`, `Telefone`, `Email`, `Excluido`) VALUES
(15, 'Maciel1', '14999064595', 'maciel@gmail.com', 1),
(16, 'Maciel Rodrigues', '14999064595', 'maciel@gmail.com', 1),
(17, 'Juan Carlos', '14999055445', 'juan@gmail.com', 0),
(18, 'Maciel', '149974554', 'maaciel123@gmail.com', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itempedido`
--

CREATE TABLE `itempedido` (
  `Id` int(11) NOT NULL,
  `IdPedido` int(11) NOT NULL,
  `IdProduto` int(11) NOT NULL,
  `ValorUnitario` decimal(10,0) NOT NULL,
  `Qtd` int(11) NOT NULL,
  `Excluido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `Id` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `Total` decimal(10,0) NOT NULL,
  `Excluido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Descricao` text NOT NULL,
  `Preco` float NOT NULL,
  `Excluido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`Id`, `Nome`, `Descricao`, `Preco`, `Excluido`) VALUES
(1, 'Arroz', 'Arroz Para Feijoada 1kg', 11, 0),
(2, 'TESTE', 'TESTE ', 5, 1),
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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
