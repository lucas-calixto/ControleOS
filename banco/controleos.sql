-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11-Fev-2017 às 13:40
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `controleos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atendentes`
--

CREATE TABLE `atendentes` (
  `cod_atendente` int(11) NOT NULL,
  `nome_atentente` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `atendentes`
--

INSERT INTO `atendentes` (`cod_atendente`, `nome_atentente`) VALUES
(1, 'LUCAS CALIXTO DE OLIVEIRA'),
(9, 'PATRICIA'),
(10, 'NADIA'),
(11, 'MAYLLA'),
(12, 'NEIA'),
(13, 'ROSY'),
(14, 'ROSANA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `atendimentos`
--

CREATE TABLE `atendimentos` (
  `cod_atendimento` int(11) NOT NULL,
  `data_cad_atendimento` date NOT NULL,
  `ordem_atendimento` int(11) NOT NULL,
  `nota_atendimento` varchar(10) NOT NULL,
  `os_resolve_atendimento` varchar(3) NOT NULL,
  `obs_atendimento` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

CREATE TABLE `cidades` (
  `cod_cidade` int(11) NOT NULL,
  `desc_cidade` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cidades`
--

INSERT INTO `cidades` (`cod_cidade`, `desc_cidade`) VALUES
(1, 'PORTEIRINHA'),
(2, 'RIO PARDO'),
(3, 'PAI PEDRO DE MINAS'),
(4, 'SERRANÓPOLIS DE MINAS'),
(5, 'RIACHO DOS MACHADOS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `cod_cliente` int(11) NOT NULL,
  `cod_pers_cliente` varchar(10) NOT NULL,
  `nome_cliente` varchar(100) NOT NULL,
  `endereco_cliente` varchar(100) NOT NULL,
  `bairro_cliente` varchar(45) NOT NULL,
  `cod_cidade_cliente` int(11) NOT NULL,
  `telefone_um_cliente` varchar(30) NOT NULL,
  `telefone_dois_cliente` varchar(30) NOT NULL,
  `ip_cliente` varchar(20) DEFAULT NULL,
  `pop_cliente` varchar(100) DEFAULT NULL,
  `user_pppoe_cliente` varchar(50) DEFAULT NULL,
  `pass_pppoe_cliente` varchar(50) DEFAULT NULL,
  `plano_cliente` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`cod_cliente`, `cod_pers_cliente`, `nome_cliente`, `endereco_cliente`, `bairro_cliente`, `cod_cidade_cliente`, `telefone_um_cliente`, `telefone_dois_cliente`, `ip_cliente`, `pop_cliente`, `user_pppoe_cliente`, `pass_pppoe_cliente`, `plano_cliente`) VALUES
(1, '619', 'LUCAS CALIXTO DE OLIVEIRA', 'RUA Q Nº 26', 'COHAB', 2, '(38) 9 9217-7861', '', '177.92.240.93', 'SÃO SEBASTIÃO', NULL, NULL, '2 Mbps'),
(2, '619', 'JOÃO PEREIRA DA SILVA', 'RUA Q Nº 26', 'COHAB', 2, '(38) 9 9217-7861', '', '177.92.240.93', 'SÃO SEBASTIÃO', NULL, NULL, '2 Mbps'),
(3, '619', 'FERNANDO SANTOS SOUZA', 'RUA Q Nº 26', 'COHAB', 2, '(38) 9 9217-7861', '', '177.92.240.93', 'SÃO SEBASTIÃO', NULL, NULL, '2 Mbps');

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

CREATE TABLE `logs` (
  `cod_log` int(11) NOT NULL,
  `desc_log` varchar(200) NOT NULL,
  `data_log` date NOT NULL,
  `hora_log` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordens`
--

CREATE TABLE `ordens` (
  `cod_ondem` int(11) NOT NULL,
  `desc_ordem` varchar(200) NOT NULL,
  `data_cad_ordem` date NOT NULL,
  `data_inicio_ordem` date DEFAULT NULL,
  `data_fim_ordem` date DEFAULT NULL,
  `hora_cad_ordem` time DEFAULT NULL,
  `hora_inicio_ordem` time DEFAULT NULL,
  `hora_fim_ordem` time DEFAULT NULL,
  `cod_tipo_ordem` int(11) NOT NULL,
  `cod_cliente_ordem` int(11) NOT NULL,
  `cod_tecnico_ordem` int(11) NOT NULL,
  `cod_atendente_ordem` int(11) NOT NULL,
  `desc_total_ordem` text,
  `desc_resolve_ordem` text,
  `status_ordem` varchar(20) NOT NULL,
  `solicita_ordem` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ordens`
--

INSERT INTO `ordens` (`cod_ondem`, `desc_ordem`, `data_cad_ordem`, `data_inicio_ordem`, `data_fim_ordem`, `hora_cad_ordem`, `hora_inicio_ordem`, `hora_fim_ordem`, `cod_tipo_ordem`, `cod_cliente_ordem`, `cod_tecnico_ordem`, `cod_atendente_ordem`, `desc_total_ordem`, `desc_resolve_ordem`, `status_ordem`, `solicita_ordem`) VALUES
(1, 'CLIENTE SEM INTERNET', '2017-02-02', NULL, NULL, '17:03:00', NULL, NULL, 6, 1, 3, 1, 'CLIENTE AFIRMA QUE ESTA SEM INTERNET A TRÊS DIAS.', NULL, 'ANDAMENTO', 'ROBERTA'),
(2, 'INTERNET LENTA', '2017-02-08', NULL, NULL, '17:03:00', NULL, NULL, 6, 2, 3, 1, 'CLIENTE AFIRMA QUE ESTA SEM INTERNET A TRÊS DIAS.', NULL, 'ABERTA', 'ROBERTA'),
(3, 'CONFIGURAR ROTEADOR', '2017-02-08', NULL, NULL, '17:03:00', NULL, NULL, 6, 1, 3, 1, 'CLIENTE AFIRMA QUE ESTA SEM INTERNET A TRÊS DIAS.', NULL, 'BAIXADA', 'ROBERTA'),
(4, 'INTERNET LENTA', '2017-02-08', NULL, NULL, '17:03:00', NULL, NULL, 6, 2, 3, 1, 'CLIENTE AFIRMA QUE ESTA SEM INTERNET A TRÊS DIAS.', NULL, 'ABERTA', 'ROBERTA'),
(5, 'INTERNET LENTA', '2017-02-08', NULL, NULL, '17:03:00', NULL, NULL, 6, 2, 3, 1, 'CLIENTE AFIRMA QUE ESTA SEM INTERNET A TRÊS DIAS.', NULL, 'ABERTA', 'ROBERTA'),
(6, 'CONFIGURAR ROTEADOR', '2017-02-07', NULL, NULL, '13:03:00', NULL, NULL, 6, 1, 3, 1, 'CLIENTE AFIRMA QUE ESTA SEM INTERNET A TRÊS DIAS.', NULL, 'BAIXADA', 'ROBERTA'),
(8, 'MUDAR ANTENA DE LOCAL', '2017-02-09', NULL, NULL, NULL, NULL, NULL, 1, 1, 8, 1, '', NULL, 'ABERTA', 'EMERSON'),
(9, 'INSTALAÇÃO DE ANTENA AIR GRID', '2017-02-09', NULL, NULL, NULL, NULL, NULL, 1, 3, 9, 1, 'LEVAR TUPO DE 1,5 M.', NULL, 'ABERTA', 'FERNANDO'),
(10, 'RETIRAR ANTENA', '2017-02-09', NULL, NULL, NULL, NULL, NULL, 2, 2, 3, 1, '', NULL, 'ABERTA', 'LUCAS'),
(11, 'CLIENTE CANCELOU ', '2017-02-10', NULL, NULL, NULL, NULL, NULL, 2, 3, 10, 1, '', NULL, 'ABERTA', 'FERNANDO'),
(12, 'IMPLANTAÇÃO DE CABEAMENTO ESTRUTURADO', '2017-02-10', NULL, NULL, NULL, NULL, NULL, 3, 1, 3, 1, '', NULL, 'ABERTA', 'LUCIA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tecnicos`
--

CREATE TABLE `tecnicos` (
  `cod_tecnico` int(11) NOT NULL,
  `nome_tecnico` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tecnicos`
--

INSERT INTO `tecnicos` (`cod_tecnico`, `nome_tecnico`) VALUES
(1, 'LUCAS CALIXTO'),
(3, 'ALEX'),
(6, 'LENISSON'),
(8, 'EDUARDO'),
(9, 'JOÃO BORGES'),
(10, 'JOÃO FERREIRA'),
(11, 'DIEGO'),
(12, 'RENAN');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos`
--

CREATE TABLE `tipos` (
  `cod_tipo` int(11) NOT NULL,
  `desc_tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipos`
--

INSERT INTO `tipos` (`cod_tipo`, `desc_tipo`) VALUES
(1, 'ATIVAÇÃO'),
(2, 'CANCELAMENTO'),
(3, 'REDE LOGICA'),
(4, 'CONFIGURAÇÃO DE ROTEADOR'),
(5, 'INTERNET LENTA'),
(6, 'SEM INTERNET'),
(7, 'MANUTENÇÃO DE COMPUTADORES');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `cod_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL,
  `login_usuario` varchar(30) NOT NULL,
  `senha_usuario` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`cod_usuario`, `nome_usuario`, `login_usuario`, `senha_usuario`) VALUES
(1, 'LUCAS CALIXTO', 'lucas', '123'),
(23, 'LENISSON CLEUBER', 'lenisson', '123'),
(24, 'PATRICIA', 'patricia', '123'),
(25, 'ROSY', 'rosy', '123'),
(26, 'NEIA', 'neia', '123'),
(27, 'MAYLLA', 'mailla', '123'),
(28, 'ROSANA', 'rosana', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atendentes`
--
ALTER TABLE `atendentes`
  ADD PRIMARY KEY (`cod_atendente`);

--
-- Indexes for table `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD PRIMARY KEY (`cod_atendimento`,`ordem_atendimento`),
  ADD KEY `cod_ordem_idx` (`ordem_atendimento`);

--
-- Indexes for table `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`cod_cidade`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cod_cliente`,`cod_cidade_cliente`),
  ADD KEY `cod_cidade_idx` (`cod_cidade_cliente`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`cod_log`);

--
-- Indexes for table `ordens`
--
ALTER TABLE `ordens`
  ADD PRIMARY KEY (`cod_ondem`,`cod_tipo_ordem`,`cod_cliente_ordem`,`cod_tecnico_ordem`,`cod_atendente_ordem`),
  ADD KEY `cod_cliente_idx` (`cod_cliente_ordem`),
  ADD KEY `cod_tecnico_idx` (`cod_tecnico_ordem`),
  ADD KEY `cod_atendente_idx` (`cod_atendente_ordem`),
  ADD KEY `cod_tipo_idx` (`cod_tipo_ordem`);

--
-- Indexes for table `tecnicos`
--
ALTER TABLE `tecnicos`
  ADD PRIMARY KEY (`cod_tecnico`);

--
-- Indexes for table `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`cod_tipo`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cod_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atendentes`
--
ALTER TABLE `atendentes`
  MODIFY `cod_atendente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `atendimentos`
--
ALTER TABLE `atendimentos`
  MODIFY `cod_atendimento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cidades`
--
ALTER TABLE `cidades`
  MODIFY `cod_cidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cod_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `cod_log` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ordens`
--
ALTER TABLE `ordens`
  MODIFY `cod_ondem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tecnicos`
--
ALTER TABLE `tecnicos`
  MODIFY `cod_tecnico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tipos`
--
ALTER TABLE `tipos`
  MODIFY `cod_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD CONSTRAINT `cod_ordem` FOREIGN KEY (`ordem_atendimento`) REFERENCES `ordens` (`cod_ondem`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `cod_cidade` FOREIGN KEY (`cod_cidade_cliente`) REFERENCES `cidades` (`cod_cidade`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ordens`
--
ALTER TABLE `ordens`
  ADD CONSTRAINT `cod_atendente` FOREIGN KEY (`cod_atendente_ordem`) REFERENCES `atendentes` (`cod_atendente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cod_cliente` FOREIGN KEY (`cod_cliente_ordem`) REFERENCES `clientes` (`cod_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cod_tecnico` FOREIGN KEY (`cod_tecnico_ordem`) REFERENCES `tecnicos` (`cod_tecnico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cod_tipo` FOREIGN KEY (`cod_tipo_ordem`) REFERENCES `tipos` (`cod_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
