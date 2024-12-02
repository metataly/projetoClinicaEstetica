-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/12/2024 às 20:50
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
-- Banco de dados: `harmonybeauty`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `servico` varchar(255) NOT NULL,
  `salario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `nome`, `servico`, `salario`) VALUES
(5, 'Douglas Daraio', 'Preenchimento facial', 18.00),
(6, 'Maria Ximenes', 'Depilação', 19.30),
(7, 'Nathaly Pereira', 'Podologia', 17.00),
(9, 'Kauã Pessoa', 'Tratamento de rugas', 18.00),
(10, 'Gabriel Seidel', 'Limpeza de pele', 18.00),
(11, 'Elita Basilio', 'Massoterapeuta', 27.00),
(16, 'Fabiana Rodrigues', 'undefined', 18.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `servico`
--

CREATE TABLE `servico` (
  `id` int(20) NOT NULL,
  `servico` varchar(255) NOT NULL,
  `data` date DEFAULT NULL,
  `horario` time(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servico`
--

INSERT INTO `servico` (`id`, `servico`, `data`, `horario`) VALUES
(24, 'Limpeza de pele', '2024-12-16', '11:30:00.000000'),
(25, 'Podologia', '2024-12-25', '10:30:00.000000'),
(26, 'Preenchimento Facial', '2024-11-15', '09:30:00.000000');

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicosadmin`
--

CREATE TABLE `servicosadmin` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `funcionario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servicosadmin`
--

INSERT INTO `servicosadmin` (`id`, `nome`, `valor`, `funcionario_id`) VALUES
(18, 'limpeza de pele', 50.00, 10),
(19, 'Tratamento de Rugas', 180.00, 9),
(20, 'Podologia', 187.00, 7),
(21, 'Preenchimento Facial', 689.00, 5),
(22, 'Depilação', 250.00, 6);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `servicosadmin`
--
ALTER TABLE `servicosadmin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funcionario_id` (`funcionario_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `servicosadmin`
--
ALTER TABLE `servicosadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `servicosadmin`
--
ALTER TABLE `servicosadmin`
  ADD CONSTRAINT `servicosadmin_ibfk_1` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
