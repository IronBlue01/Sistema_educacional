-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 17-Jun-2019 às 03:34
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cebrac`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administradores`
--

DROP TABLE IF EXISTS `administradores`;
CREATE TABLE IF NOT EXISTS `administradores` (
  `id_adm` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_adm`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `administradores`
--

INSERT INTO `administradores` (`id_adm`, `nome`, `username`, `senha`, `email`) VALUES
(1, 'Danilo Henrique Lima de Oliveira', '@danilo', '123', 'danilo18programador@gmail.com'),
(2, 'Gisela Lima de Oliveira', '@gisela', '123', 'gisela@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

DROP TABLE IF EXISTS `alunos`;
CREATE TABLE IF NOT EXISTS `alunos` (
  `id_aluno` int(11) NOT NULL AUTO_INCREMENT,
  `avatar` varchar(250) DEFAULT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `senha` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `turma` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_aluno`),
  KEY `turma` (`turma`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id_aluno`, `avatar`, `nome`, `username`, `senha`, `email`, `turma`) VALUES
(8, 'avatar.jpg', 'Ana Luiza do Nascimento Pereira', '@alnp', '123', NULL, 17),
(9, 'avatar.jpg', 'Ayrton Gomes dos Reis', '@agr', '123', NULL, 17),
(10, 'avatar.jpg', 'Carolina da Silva Lucas', '@csl', '123', NULL, 17),
(11, 'avatar.jpg', 'Denilza Ribeiro dos Santos Cruz', '@drsc', '123', NULL, 17),
(12, 'avatar.jpg', 'Eduardo Correia da Silva Davanso', '@ecsd', '123', NULL, 17),
(13, 'avatar.jpg', 'Eduardo Silva Gonsalves', '@esg', '123', NULL, 17),
(14, 'avatar.jpg', 'Esthella Grego Hipolito Medeiros', '@eghm', '123', NULL, 17),
(15, 'avatar.jpg', 'Gabriel de Moraes Cardoso', '@gmc', '123', NULL, 17),
(16, 'avatar.jpg', 'Gabriela de Brito', '@gb', '123', NULL, 17),
(17, 'avatar.jpg', 'Gabrieli Moreira Garcia', '@gmg', '123', NULL, 17),
(18, 'avatar.jpg', 'Géssica Terezinha Cardoso', '@gtc', '123', NULL, 17),
(19, 'avatar.jpg', 'Giovane da Cruz Silva', '@gcs', '123', NULL, 17),
(20, 'avatar.jpg', 'Guilherme Sperber de Oliveira', '@gso', '123', NULL, 17),
(21, 'avatar.jpg', 'Izaac Eduardo Soares', '@ies', '123', NULL, 17),
(22, 'avatar.jpg', 'Jessica Souza da Silva', '@jss', '123', NULL, 17),
(23, 'avatar.jpg', 'João Marcos de Jesus Machado', '@jmjm', '123', NULL, 17),
(24, 'avatar.jpg', 'Julia Eduarda Ribeiro dos Santos', '@jers', '123', NULL, 17),
(25, 'avatar.jpg', 'Juliana Thomaz Avila', '@jta', '123', NULL, 17),
(26, 'avatar.jpg', 'Lais Schadlik Ramos', '@lsr', '123', NULL, 17),
(27, 'avatar.jpg', 'Madalena Ernesto ', '@me', '123', NULL, 17),
(28, 'avatar.jpg', 'Maria Rita dos Santos Dias', '@mrsd', '123', NULL, 17),
(29, NULL, 'Danilo Henrique Lima de Oliveira', NULL, NULL, NULL, NULL),
(30, NULL, 'Danilo Henrique Lima de Oliveira', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCurso` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`id_curso`, `nomeCurso`) VALUES
(6, 'Informática aplicada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professores`
--

DROP TABLE IF EXISTS `professores`;
CREATE TABLE IF NOT EXISTS `professores` (
  `id_professor` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `senha` varchar(200) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `curso` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_professor`),
  KEY `curso` (`curso`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `professores`
--

INSERT INTO `professores` (`id_professor`, `nome`, `username`, `senha`, `nascimento`, `curso`) VALUES
(17, 'Danilo Henrique Lima', '@danilo', '123', NULL, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `prova`
--

DROP TABLE IF EXISTS `prova`;
CREATE TABLE IF NOT EXISTS `prova` (
  `id_prova` int(11) NOT NULL AUTO_INCREMENT,
  `id_aluno` int(11) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `questao1` varchar(10) DEFAULT NULL,
  `questao2` varchar(10) DEFAULT NULL,
  `questao3` varchar(10) DEFAULT NULL,
  `questao4` varchar(10) DEFAULT NULL,
  `questao5` varchar(10) DEFAULT NULL,
  `questao6` varchar(10) DEFAULT NULL,
  `questao7` varchar(10) DEFAULT NULL,
  `questao8` varchar(10) DEFAULT NULL,
  `questao9` varchar(10) DEFAULT NULL,
  `questao10` varchar(10) DEFAULT NULL,
  `nota` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_prova`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas`
--

DROP TABLE IF EXISTS `turmas`;
CREATE TABLE IF NOT EXISTS `turmas` (
  `id_turma` int(11) NOT NULL AUTO_INCREMENT,
  `serie` varchar(3) DEFAULT NULL,
  `curso` int(11) DEFAULT NULL,
  `professor` int(11) DEFAULT NULL,
  `numero` int(11) NOT NULL,
  `stattus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_turma`),
  KEY `curso` (`curso`),
  KEY `professor` (`professor`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turmas`
--

INSERT INTO `turmas` (`id_turma`, `serie`, `curso`, `professor`, `numero`, `stattus`) VALUES
(17, 'A', 6, 17, 0, 0);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `alunos`
--
ALTER TABLE `alunos`
  ADD CONSTRAINT `alunos_ibfk_1` FOREIGN KEY (`turma`) REFERENCES `turmas` (`id_turma`);

--
-- Limitadores para a tabela `professores`
--
ALTER TABLE `professores`
  ADD CONSTRAINT `professores_ibfk_1` FOREIGN KEY (`curso`) REFERENCES `cursos` (`id_curso`);

--
-- Limitadores para a tabela `turmas`
--
ALTER TABLE `turmas`
  ADD CONSTRAINT `turmas_ibfk_1` FOREIGN KEY (`curso`) REFERENCES `cursos` (`id_curso`),
  ADD CONSTRAINT `turmas_ibfk_2` FOREIGN KEY (`professor`) REFERENCES `professores` (`id_professor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
