-- --------------------------------------------------------
-- Servidor:                     192.168.0.100
-- Versão do servidor:           10.1.13-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para controleos
CREATE DATABASE IF NOT EXISTS `controleos` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `controleos`;

-- Copiando estrutura para tabela controleos.atendentes
CREATE TABLE IF NOT EXISTS `atendentes` (
  `cod_atendente` int(11) NOT NULL AUTO_INCREMENT,
  `nome_atentente` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_atendente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela controleos.atendimentos
CREATE TABLE IF NOT EXISTS `atendimentos` (
  `cod_atendimento` int(11) NOT NULL AUTO_INCREMENT,
  `data_cad_atendimento` date NOT NULL,
  `ordem_atendimento` int(11) NOT NULL,
  `nota_atendimento` varchar(10) NOT NULL,
  `os_resolve_atendimento` varchar(3) NOT NULL,
  `obs_atendimento` text,
  PRIMARY KEY (`cod_atendimento`,`ordem_atendimento`),
  KEY `cod_ordem_idx` (`ordem_atendimento`),
  CONSTRAINT `cod_ordem` FOREIGN KEY (`ordem_atendimento`) REFERENCES `ordens` (`cod_ondem`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela controleos.cidades
CREATE TABLE IF NOT EXISTS `cidades` (
  `cod_cidade` int(11) NOT NULL AUTO_INCREMENT,
  `desc_cidade` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_cidade`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela controleos.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `cod_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `cod_pers_cliente` int(11) NOT NULL,
  `nome_cliente` varchar(100) NOT NULL,
  `endereco_cliente` varchar(100) NOT NULL,
  `bairro_cliente` varchar(45) NOT NULL,
  `cod_cidade_cliente` int(11) NOT NULL,
  `telefone_um_cliente` varchar(30) DEFAULT NULL,
  `telefone_dois_cliente` varchar(30) DEFAULT NULL,
  `ip_cliente` varchar(20) DEFAULT NULL,
  `pop_cliente` varchar(100) DEFAULT NULL,
  `user_pppoe_cliente` varchar(50) DEFAULT NULL,
  `pass_pppoe_cliente` varchar(50) DEFAULT NULL,
  `plano_cliente` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`cod_cliente`,`cod_cidade_cliente`),
  KEY `cod_cidade_idx` (`cod_cidade_cliente`),
  CONSTRAINT `cod_cidade` FOREIGN KEY (`cod_cidade_cliente`) REFERENCES `cidades` (`cod_cidade`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5591 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela controleos.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `cod_log` int(11) NOT NULL AUTO_INCREMENT,
  `desc_log` varchar(200) NOT NULL,
  `data_log` date NOT NULL,
  `hora_log` time NOT NULL,
  PRIMARY KEY (`cod_log`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela controleos.ordens
CREATE TABLE IF NOT EXISTS `ordens` (
  `cod_ondem` int(11) NOT NULL AUTO_INCREMENT,
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
  `solicita_ordem` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cod_ondem`,`cod_tipo_ordem`,`cod_cliente_ordem`,`cod_tecnico_ordem`,`cod_atendente_ordem`),
  KEY `cod_cliente_idx` (`cod_cliente_ordem`),
  KEY `cod_tecnico_idx` (`cod_tecnico_ordem`),
  KEY `cod_atendente_idx` (`cod_atendente_ordem`),
  KEY `cod_tipo_idx` (`cod_tipo_ordem`),
  CONSTRAINT `cod_atendente` FOREIGN KEY (`cod_atendente_ordem`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cod_cliente` FOREIGN KEY (`cod_cliente_ordem`) REFERENCES `clientes` (`cod_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cod_tecnico` FOREIGN KEY (`cod_tecnico_ordem`) REFERENCES `tecnicos` (`cod_tecnico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cod_tipo` FOREIGN KEY (`cod_tipo_ordem`) REFERENCES `tipos` (`cod_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela controleos.tecnicos
CREATE TABLE IF NOT EXISTS `tecnicos` (
  `cod_tecnico` int(11) NOT NULL AUTO_INCREMENT,
  `nome_tecnico` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_tecnico`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela controleos.tipos
CREATE TABLE IF NOT EXISTS `tipos` (
  `cod_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `desc_tipo` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela controleos.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `cod_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(100) NOT NULL,
  `login_usuario` varchar(30) NOT NULL,
  `senha_usuario` varchar(40) NOT NULL,
  `cidade_usuario` int(11) NOT NULL,
  PRIMARY KEY (`cod_usuario`),
  KEY `cidade_usuario` (`cidade_usuario`),
  CONSTRAINT `cidade_usuario` FOREIGN KEY (`cidade_usuario`) REFERENCES `cidades` (`cod_cidade`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
