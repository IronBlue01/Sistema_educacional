-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 24-Fev-2022 às 15:13
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portalcebrac_old`
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `administradores`
--

INSERT INTO `administradores` (`id_adm`, `nome`, `username`, `senha`, `email`) VALUES
(3, 'Danilo Henrique', '@danilo', '123', 'danilo@gmail.com');

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
  `Telefone` varchar(100) DEFAULT NULL,
  `turma` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_aluno`),
  KEY `turma` (`turma`)
) ENGINE=MyISAM AUTO_INCREMENT=539 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivo_atividade`
--

DROP TABLE IF EXISTS `arquivo_atividade`;
CREATE TABLE IF NOT EXISTS `arquivo_atividade` (
  `id_arquivo` int(11) NOT NULL AUTO_INCREMENT,
  `id_atividade` int(11) NOT NULL,
  `arquivo` varchar(500) NOT NULL,
  PRIMARY KEY (`id_arquivo`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividades`
--

DROP TABLE IF EXISTS `atividades`;
CREATE TABLE IF NOT EXISTS `atividades` (
  `id_atividade` int(11) NOT NULL AUTO_INCREMENT,
  `id_professor` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `subcategoria` varchar(100) DEFAULT NULL,
  `titulo` varchar(800) DEFAULT NULL,
  `img_cap` varchar(800) DEFAULT NULL,
  `description` varchar(800) DEFAULT NULL,
  `arquivo` varchar(800) DEFAULT NULL,
  `img_view` varchar(800) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `video` varchar(200) DEFAULT NULL,
  `xp_atividade` int(11) NOT NULL,
  PRIMARY KEY (`id_atividade`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCurso` varchar(500) NOT NULL,
  `sigla` varchar(30) NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrega`
--

DROP TABLE IF EXISTS `entrega`;
CREATE TABLE IF NOT EXISTS `entrega` (
  `id_entrega` int(11) NOT NULL AUTO_INCREMENT,
  `id_atividade` int(11) DEFAULT NULL,
  `id_turma` int(11) DEFAULT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `data` varchar(400) DEFAULT NULL,
  `nomeAtividade` varchar(400) DEFAULT NULL,
  `nomeArquivo` varchar(200) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `nota` int(11) DEFAULT NULL,
  `obs` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_entrega`)
) ENGINE=InnoDB AUTO_INCREMENT=1619 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

DROP TABLE IF EXISTS `historico`;
CREATE TABLE IF NOT EXISTS `historico` (
  `id_history` int(11) NOT NULL AUTO_INCREMENT,
  `id_aluno` int(11) NOT NULL,
  `operation` varchar(600) NOT NULL,
  `data` varchar(500) NOT NULL,
  PRIMARY KEY (`id_history`)
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `liberaatividade`
--

DROP TABLE IF EXISTS `liberaatividade`;
CREATE TABLE IF NOT EXISTS `liberaatividade` (
  `id_atividade` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `data_entrega` varchar(50) DEFAULT NULL,
  `statuus` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_atividade`,`id_turma`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `liberamodulo`
--

DROP TABLE IF EXISTS `liberamodulo`;
CREATE TABLE IF NOT EXISTS `liberamodulo` (
  `id_liberaModulo` int(11) NOT NULL AUTO_INCREMENT,
  `id_turma` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_liberaModulo`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos`
--

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE IF NOT EXISTS `modulos` (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(500) DEFAULT NULL,
  `nome_modulo` varchar(300) DEFAULT NULL,
  `curso` int(11) DEFAULT NULL,
  `qtd_aulas` int(11) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `subcategoria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

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
  `curso` int(11) DEFAULT NULL,
  `subcategoria` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_professor`),
  KEY `curso` (`curso`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabalhos`
--

DROP TABLE IF EXISTS `trabalhos`;
CREATE TABLE IF NOT EXISTS `trabalhos` (
  `id_trabalho` int(11) NOT NULL AUTO_INCREMENT,
  `nome_trabalho` varchar(300) NOT NULL,
  `data` varchar(300) NOT NULL,
  PRIMARY KEY (`id_trabalho`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmaprofessor`
--

DROP TABLE IF EXISTS `turmaprofessor`;
CREATE TABLE IF NOT EXISTS `turmaprofessor` (
  `id_turma_professor` int(11) NOT NULL AUTO_INCREMENT,
  `id_turma` int(11) DEFAULT NULL,
  `id_professor` int(11) DEFAULT NULL,
  `subcategoria` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_turma_professor`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas`
--

DROP TABLE IF EXISTS `turmas`;
CREATE TABLE IF NOT EXISTS `turmas` (
  `id_turma` int(11) NOT NULL AUTO_INCREMENT,
  `nomeTurma` varchar(300) NOT NULL,
  `curso` int(11) DEFAULT NULL,
  `numero` int(11) NOT NULL,
  `dia` varchar(300) NOT NULL,
  `horario_ini` int(11) NOT NULL,
  `horario_ter` int(11) NOT NULL,
  `stattus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_turma`),
  KEY `curso` (`curso`)
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `xp_alunos`
--

DROP TABLE IF EXISTS `xp_alunos`;
CREATE TABLE IF NOT EXISTS `xp_alunos` (
  `id_xp` int(11) NOT NULL AUTO_INCREMENT,
  `id_aluno` int(11) NOT NULL,
  `xp` int(11) NOT NULL,
  `msg` varchar(500) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_xp`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
