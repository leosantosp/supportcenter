-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Nov-2022 às 21:57
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `centralsuporte`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `catalogoenderecos`
--

CREATE TABLE `catalogoenderecos` (
  `id` int(11) NOT NULL,
  `tratamento` varchar(255) NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `catalogoenderecos`
--

INSERT INTO `catalogoenderecos` (`id`, `tratamento`, `empresa`, `cargo`, `email`, `senha`) VALUES
(2, 'GRU TI | Leonardo Santos', 'Assistente de TI', 'VIPEX', 'leonardo.santos@vipextransportes.com.br', '1234456789');

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaboradores`
--

CREATE TABLE `colaboradores` (
  `id` int(11) NOT NULL,
  `fullname` varchar(150) CHARACTER SET utf8 NOT NULL,
  `department` varchar(20) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `phone` int(15) NOT NULL,
  `company` varchar(10) CHARACTER SET utf8 NOT NULL,
  `birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `colaboradores`
--

INSERT INTO `colaboradores` (`id`, `fullname`, `department`, `email`, `phone`, `company`, `birth`) VALUES
(7, 'Pietro Cativelli', 'TI', 'pietro.cativelli@vipextransportes.com.br', 1222, '11 - GRU', '2004-01-20'),
(8, 'Leonardo Santos', 'TI', 'leonardo.santos@vipextransportes.com.br', 1209, '11 - GRU', '1999-02-19'),
(9, 'Francisco Alves', 'TI', 'francisco.alves@vipextransportes.com.br', 1166, '11 - GRU', '1984-03-14'),
(10, 'Sidnei Oliveira', 'TI', 'sidnei.oliveira@vipextransportes.com.br', 1165, '11 - GRU', '1973-05-08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `companys`
--

CREATE TABLE `companys` (
  `id` int(11) NOT NULL,
  `compnumber` varchar(20) NOT NULL,
  `compname` varchar(100) NOT NULL,
  `cnpj` varchar(25) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `manager` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ntlocation`
--

CREATE TABLE `ntlocation` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `patrimony` int(5) NOT NULL,
  `withdraw` date NOT NULL,
  `devolution` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ombudsman`
--

CREATE TABLE `ombudsman` (
  `id` int(11) NOT NULL,
  `company` varchar(12) NOT NULL,
  `department` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sector` varchar(100) NOT NULL,
  `notification` varchar(100) NOT NULL,
  `report` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `profile` varchar(255) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `login`, `email`, `password`, `profile`) VALUES
(1, 'Administrador', 'admin', 'leonardo.santos@vipextransportes.com.br', '21232f297a57a5a743894a0e4a801fc3', 'admin');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `companys`
--
ALTER TABLE `companys`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ntlocation`
--
ALTER TABLE `ntlocation`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ombudsman`
--
ALTER TABLE `ombudsman`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `companys`
--
ALTER TABLE `companys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `ntlocation`
--
ALTER TABLE `ntlocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ombudsman`
--
ALTER TABLE `ombudsman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
