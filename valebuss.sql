-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Mar-2021 às 01:26
-- Versão do servidor: 10.4.16-MariaDB
-- versão do PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `valebuss`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

CREATE TABLE `cidades` (
  `cod_cidade` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `cep` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `cpf` varchar(14) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_viagem`
--

CREATE TABLE `usuario_viagem` (
  `cod_usuario` varchar(11) NOT NULL,
  `cod_viagem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `placa` varchar(7) NOT NULL,
  `marca` varchar(80) NOT NULL,
  `modelo` varchar(80) NOT NULL,
  `qt_lugares` int(11) NOT NULL,
  `cod_usuario` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `viagem_cidade`
--

CREATE TABLE `viagem_cidade` (
  `cod_viagem` int(11) NOT NULL,
  `cod_cidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `viagens`
--

CREATE TABLE `viagens` (
  `cod_viagem` int(11) NOT NULL,
  `end_origem` varchar(100) NOT NULL,
  `end_destino` varchar(100) NOT NULL,
  `cidade_origem` int(11) NOT NULL,
  `cidade_destino` int(11) NOT NULL,
  `horario_saida` time NOT NULL,
  `descricao` text NOT NULL,
  `cod_usuario` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`cod_cidade`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cpf`);

--
-- Índices para tabela `usuario_viagem`
--
ALTER TABLE `usuario_viagem`
  ADD PRIMARY KEY (`cod_usuario`,`cod_viagem`),
  ADD KEY `cod_viagem` (`cod_viagem`);

--
-- Índices para tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`placa`),
  ADD KEY `cod_usuario` (`cod_usuario`);

--
-- Índices para tabela `viagem_cidade`
--
ALTER TABLE `viagem_cidade`
  ADD PRIMARY KEY (`cod_viagem`,`cod_cidade`),
  ADD KEY `cod_cidade` (`cod_cidade`);

--
-- Índices para tabela `viagens`
--
ALTER TABLE `viagens`
  ADD PRIMARY KEY (`cod_viagem`),
  ADD KEY `cod_usuario` (`cod_usuario`),
  ADD KEY `cidade_origem` (`cidade_origem`),
  ADD KEY `cidade_destino` (`cidade_destino`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `cod_cidade` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `viagens`
--
ALTER TABLE `viagens`
  MODIFY `cod_viagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `usuario_viagem`
--
ALTER TABLE `usuario_viagem`
  ADD CONSTRAINT `usuario_viagem_ibfk_1` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cpf`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_viagem_ibfk_2` FOREIGN KEY (`cod_viagem`) REFERENCES `viagens` (`cod_viagem`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD CONSTRAINT `veiculos_ibfk_1` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cpf`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `viagem_cidade`
--
ALTER TABLE `viagem_cidade`
  ADD CONSTRAINT `viagem_cidade_ibfk_1` FOREIGN KEY (`cod_viagem`) REFERENCES `viagens` (`cod_viagem`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `viagem_cidade_ibfk_2` FOREIGN KEY (`cod_cidade`) REFERENCES `cidades` (`cod_cidade`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `viagens`
--
ALTER TABLE `viagens`
  ADD CONSTRAINT `viagens_ibfk_1` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cpf`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `viagens_ibfk_2` FOREIGN KEY (`cidade_origem`) REFERENCES `cidades` (`cod_cidade`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `viagens_ibfk_3` FOREIGN KEY (`cidade_destino`) REFERENCES `cidades` (`cod_cidade`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
