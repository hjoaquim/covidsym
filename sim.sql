-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Dez-2020 às 15:36
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sim`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `loc_distritos`
--

CREATE TABLE `loc_distritos` (
  `COD_DISTRITO` int(12) NOT NULL,
  `NOME_DISTRITO` varchar(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `loc_distritos`
--

INSERT INTO `loc_distritos` (`COD_DISTRITO`, `NOME_DISTRITO`) VALUES
(1, 'Aveiro'),
(2, 'Beja'),
(3, 'Braga'),
(4, 'Bragança'),
(5, 'Castelo Branco'),
(6, 'Coimbra'),
(7, 'Évora'),
(8, 'Faro'),
(9, 'Guarda'),
(10, 'Leiria'),
(11, 'Lisboa'),
(12, 'Portalegre'),
(13, 'Porto'),
(14, 'Santarém'),
(15, 'Setúbal'),
(16, 'Viana do Castelo'),
(17, 'Vila Real'),
(18, 'Viseu'),
(31, 'Ilha da Madeira'),
(32, 'Ilha de Porto Santo'),
(41, 'Ilha de Santa Maria'),
(42, 'Ilha de São Miguel'),
(43, 'Ilha Terceira'),
(44, 'Ilha da Graciosa'),
(45, 'Ilha de São Jorge'),
(46, 'Ilha do Pico'),
(47, 'Ilha do Faial'),
(48, 'Ilha das Flores'),
(49, 'Ilha do Corvo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utl_tipos_utilizadores`
--

CREATE TABLE `utl_tipos_utilizadores` (
  `ID` int(11) NOT NULL,
  `DESC_UTL` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `utl_tipos_utilizadores`
--

INSERT INTO `utl_tipos_utilizadores` (`ID`, `DESC_UTL`) VALUES
(1, 'admin'),
(2, 'Investigador'),
(3, 'Médico'),
(4, 'Utente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utl_utilizadores`
--

CREATE TABLE `utl_utilizadores` (
  `ID` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(120) NOT NULL,
  `NOME` varchar(60) NOT NULL,
  `FOTO` blob DEFAULT NULL,
  `MORADA` varchar(120) DEFAULT NULL,
  `F_LOCALIDADE` int(11) DEFAULT NULL,
  `TELEMOVEL` varchar(20) NOT NULL,
  `EMAIL` varchar(60) NOT NULL,
  `DT_NASCIMENTO` date DEFAULT NULL,
  `F_TIPO_UTILIZADOR` int(11) NOT NULL,
  `CTL_ACTIVO` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'S',
  `CTL_DT_CRIACAO` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `utl_utilizadores`
--

INSERT INTO `utl_utilizadores` (`ID`, `username`, `password`, `NOME`, `FOTO`, `MORADA`, `F_LOCALIDADE`, `TELEMOVEL`, `EMAIL`, `DT_NASCIMENTO`, `F_TIPO_UTILIZADOR`, `CTL_ACTIVO`, `CTL_DT_CRIACAO`) VALUES
(1, 'hjoaquim', '$2y$10$vtdNGdrZ4o3FRiAWmkmW1.BkPOKswwXD3hcUY55S0RzFu/nw.AS.O', 'Henrique Joaquim', NULL, NULL, NULL, '-1', 'teste@gmail.com', NULL, 1, 'S', '2020-12-20 12:38:07');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `loc_distritos`
--
ALTER TABLE `loc_distritos`
  ADD PRIMARY KEY (`COD_DISTRITO`);

--
-- Índices para tabela `utl_tipos_utilizadores`
--
ALTER TABLE `utl_tipos_utilizadores`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `utl_utilizadores`
--
ALTER TABLE `utl_utilizadores`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `password` (`password`),
  ADD KEY `F_LOCALIDADE` (`F_LOCALIDADE`),
  ADD KEY `F_TIPO_UTILIZADOR` (`F_TIPO_UTILIZADOR`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `loc_distritos`
--
ALTER TABLE `loc_distritos`
  MODIFY `COD_DISTRITO` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de tabela `utl_tipos_utilizadores`
--
ALTER TABLE `utl_tipos_utilizadores`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `utl_utilizadores`
--
ALTER TABLE `utl_utilizadores`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `utl_utilizadores`
--
ALTER TABLE `utl_utilizadores`
  ADD CONSTRAINT `utl_utilizadores_ibfk_1` FOREIGN KEY (`F_TIPO_UTILIZADOR`) REFERENCES `utl_tipos_utilizadores` (`ID`),
  ADD CONSTRAINT `utl_utilizadores_ibfk_2` FOREIGN KEY (`F_LOCALIDADE`) REFERENCES `loc_distritos` (`COD_DISTRITO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
