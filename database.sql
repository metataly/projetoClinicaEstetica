-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
-- Host: 127.0.0.1
-- Tempo de geração: 25/11/2024
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Configurações iniciais
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Banco de dados `clinicaestetica`
CREATE DATABASE IF NOT EXISTS `clinicaestetica`;
USE `clinicaestetica`;

-- Estrutura da tabela `funcionarios`
CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `servico` varchar(255) NOT NULL,
  `salario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dados da tabela `funcionarios`
INSERT INTO `funcionarios` (`id`, `nome`, `servico`, `salario`) VALUES
(5, 'Douglas Daraio', 'Preenchimento facial', 18.00),
(6, 'Maria Ximenes', 'Depilação', 19.30),
(7, 'Nathaly Pereira', 'Podologia', 17.00),
(9, 'Kauã Pessoa', 'tratamento de rugas', 18.00),
(10, 'Gabriel Seidel', 'Limpeza de pele', 18.00),
(11, 'Elita Basilio', 'Massoterapeuta', 27.00),
(16, 'Fabiana Rodrigues', 'undefined', 18.00);

-- Índices da tabela `funcionarios`
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`);

-- Auto_increment da tabela `funcionarios`
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

-- Banco de dados `harmonybeauty`
CREATE DATABASE IF NOT EXISTS `harmonybeauty`;
USE `harmonybeauty`;

-- Estrutura da tabela `servico`
CREATE TABLE `servico` (
  `id` int(20) NOT NULL,
  `servico` varchar(255) NOT NULL,
  `data` date DEFAULT NULL,
  `horario` time(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dados da tabela `servico`
INSERT INTO `servico` (`id`, `servico`, `data`, `horario`) VALUES
(24, 'Limpeza de pele', '2024-12-16', '11:30:00.000000'),
(25, 'Podologia', '2024-12-25', '10:30:00.000000'),
(26, 'Preenchimento Facial', '2024-11-15', '09:30:00.000000');

-- Índices da tabela `servico`
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id`);

-- Auto_increment da tabela `servico`
ALTER TABLE `servico`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

COMMIT;

-- Restaurar configurações iniciais
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
