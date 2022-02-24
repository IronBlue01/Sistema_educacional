-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 01-Abr-2020 às 04:19
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
-- Database: `portalcebrac`
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `administradores`
--

INSERT INTO `administradores` (`id_adm`, `nome`, `username`, `senha`, `email`) VALUES
(1, 'Danilo', '@danilo', '123', 'fabricia@gmail.com');

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
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id_aluno`, `avatar`, `nome`, `username`, `senha`, `email`, `Telefone`, `turma`) VALUES
(80, 'avatar.jpg', 'Marcello Henrique', '@marcelo', '123', NULL, '44998128877', 65),
(81, 'avatar.jpg', 'Fabio Lima', '@fabio', '123', NULL, '44985577886', 66);

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
  PRIMARY KEY (`id_atividade`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `atividades`
--

INSERT INTO `atividades` (`id_atividade`, `id_professor`, `id_modulo`, `id_curso`, `subcategoria`, `titulo`, `img_cap`, `description`, `arquivo`, `img_view`, `status`, `video`) VALUES
(53, 51, 5, 22, 'A', 'Como calcular juros compostos', '51_juros-simples.png', 'Aprenda as formulas que compõe juros compostos', NULL, NULL, 0, '2CJ0ln3N0v0'),
(54, 53, 6, 22, 'T', 'Funções condicionais', '53_funções.jpg', 'Funções básicas do excel', '53_Funções.xlsx', NULL, 0, 'ECZloHYRHyY'),
(55, 54, 7, 23, '---', 'A história do computador', '54_4icey7otzopfw41jn6j4a3z39.jpg', 'Aprenda como surgiu os computadores', NULL, NULL, 0, 'mFdUqqwzbVs');

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamada`
--

DROP TABLE IF EXISTS `chamada`;
CREATE TABLE IF NOT EXISTS `chamada` (
  `id_chamada` int(11) NOT NULL AUTO_INCREMENT,
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `turma` int(11) NOT NULL,
  PRIMARY KEY (`id_chamada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCurso` varchar(500) NOT NULL,
  `imgCurso` varchar(200) DEFAULT NULL,
  `sigla` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`id_curso`, `nomeCurso`, `imgCurso`, `sigla`) VALUES
(24, 'Atendente de Farmácia', NULL, 'FMC'),
(23, 'Manutenção de Computadores e Celulares', NULL, 'MCC'),
(22, 'Assistente administrativo completo', NULL, 'ADM');

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrega`
--

DROP TABLE IF EXISTS `entrega`;
CREATE TABLE IF NOT EXISTS `entrega` (
  `id_entrega` int(11) NOT NULL AUTO_INCREMENT,
  `id_turma` int(11) DEFAULT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `data` varchar(400) DEFAULT NULL,
  `nomeAtividade` varchar(400) DEFAULT NULL,
  `nomeArquivo` varchar(200) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `nota` int(11) DEFAULT NULL,
  `obs` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_entrega`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `historico`
--

INSERT INTO `historico` (`id_history`, `id_aluno`, `operation`, `data`) VALUES
(25, 80, 'acessou o sistema', '01/04/2020  01:18:18'),
(24, 81, 'acessou o sistema', '01/04/2020  01:10:16'),
(23, 81, 'acessou o sistema', '01/04/2020  01:08:29'),
(22, 80, 'acessou o sistema', '01/04/2020  00:33:54'),
(21, 80, 'acessou o sistema', '01/04/2020  00:31:37');

-- --------------------------------------------------------

--
-- Estrutura da tabela `liberaatividade`
--

DROP TABLE IF EXISTS `liberaatividade`;
CREATE TABLE IF NOT EXISTS `liberaatividade` (
  `id_libera` int(11) NOT NULL AUTO_INCREMENT,
  `id_atividade` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_libera`)
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
  `subcategoria` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_liberaModulo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `subcategoria` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modulos`
--

INSERT INTO `modulos` (`id_modulo`, `img`, `nome_modulo`, `curso`, `qtd_aulas`, `descricao`, `subcategoria`) VALUES
(5, 'taxas.jpg', 'Taxas e Juros', 22, 11, 'Aprenda a calcular as taxas de juros', 'A'),
(6, 'como-criar-planilha-excel.png', 'Excel', 22, 15, 'Aprenda a utilizar a ferramenta excel', 'T'),
(7, '1eff1021-a294-70d3-60d4-fa26c7a4b7d4.jpg', 'Introdução ao Hardware', 23, 5, 'Aprenda quais componentes integram um computador', '---'),
(8, 'placa4-eletronica-eletronicasa.jpg', 'Introdução a eletrônica', 23, 5, 'Conheça os principais componentes da eletrônica e como usalos', '---');

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
  `subcategoria` varchar(5) NOT NULL,
  PRIMARY KEY (`id_professor`),
  KEY `curso` (`curso`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `professores`
--

INSERT INTO `professores` (`id_professor`, `nome`, `username`, `senha`, `curso`, `subcategoria`) VALUES
(54, 'Roberto', '@roberto', '123', 23, '---'),
(53, 'Danilo Henrique Lima de Oliveira', '@danilo', '123', 22, 'T'),
(51, 'Sergio Hono', '@sergio', '123', 22, 'A'),
(52, 'Lidiane Sposito', '@lidiane', '123', 22, 'D');

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
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turmaprofessor`
--

INSERT INTO `turmaprofessor` (`id_turma_professor`, `id_turma`, `id_professor`, `subcategoria`) VALUES
(23, 65, 52, 'D'),
(22, 65, 51, 'A'),
(21, 65, 53, 'T'),
(24, 66, 54, '');

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
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turmas`
--

INSERT INTO `turmas` (`id_turma`, `nomeTurma`, `curso`, `numero`, `dia`, `horario_ini`, `horario_ter`, `stattus`) VALUES
(66, 'MCC-01', 23, 0, 'Quinta-feira', 8, 9, 0),
(65, '19/Aac-01', 22, 0, 'segunda-feira', 8, 9, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
