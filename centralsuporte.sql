-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Nov-2022 às 19:07
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.0

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
  `compnumber` int(11) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gestor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `meetings`
--

CREATE TABLE `meetings` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `guests` varchar(500) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `room` varchar(100) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ouvidoria`
--

CREATE TABLE `ouvidoria` (
  `id` int(11) NOT NULL,
  `filial` varchar(3) NOT NULL,
  `department` varchar(25) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ramal` int(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `setor` varchar(255) NOT NULL,
  `type` varchar(15) NOT NULL,
  `report` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `login`, `password`, `email`, `profile`) VALUES
(1, 'Leonardo Santos', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'leonardo.santos@vipextransportes.com.br', 'admin'),
(3, 'Francisco Alves', 'francisco.alves', 'c9d0f88705406a124fe0e2f3dd63445d', 'francisco.alves@vipextransportes.com.br', 'admin');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `catalogoenderecos`
--
ALTER TABLE `catalogoenderecos`
  ADD PRIMARY KEY (`id`);

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
-- Índices para tabela `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ouvidoria`
--
ALTER TABLE `ouvidoria`
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
-- AUTO_INCREMENT de tabela `catalogoenderecos`
--
ALTER TABLE `catalogoenderecos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `companys`
--
ALTER TABLE `companys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ouvidoria`
--
ALTER TABLE `ouvidoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
