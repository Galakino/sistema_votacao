-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 24-Out-2024 às 11:58
-- Versão do servidor: 5.7.11
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistema_votacao`
--
CREATE DATABASE IF NOT EXISTS `sistema_votacao` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sistema_votacao`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm`
--

DROP TABLE IF EXISTS `adm`;
CREATE TABLE IF NOT EXISTS `adm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `senha` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `adm`
--

INSERT INTO `adm` (`id`, `username`, `senha`) VALUES
(24, 'Jorgin', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4'),
(25, 'lukinhas', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4'),
(26, 'Galakino', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacoes`
--

DROP TABLE IF EXISTS `avaliacoes`;
CREATE TABLE IF NOT EXISTS `avaliacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_jogo` int(11) DEFAULT NULL,
  `voto` enum('like','dislike') DEFAULT NULL,
  `comentario` text,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_jogo` (`id_jogo`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `avaliacoes`
--

INSERT INTO `avaliacoes` (`id`, `id_usuario`, `id_jogo`, `voto`, `comentario`) VALUES
(5, 1, 2, 'dislike', 'Muito poder, cade a troca de tiro?ðŸ˜'),
(11, 1, 1, 'like', 'Jogo massaðŸ˜Ž'),
(12, 3, 1, 'like', 'cool'),
(13, 3, 2, 'dislike', 'i don\\\'t likeðŸ˜Ž'),
(15, 1, 3, 'like', 'Jogo legal'),
(16, 5, 2, 'like', 'aiiin nobru apelo'),
(18, 5, 1, 'like', 'Jogo bo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogos`
--

DROP TABLE IF EXISTS `jogos`;
CREATE TABLE IF NOT EXISTS `jogos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` text,
  `imagem1` varchar(255) DEFAULT NULL,
  `imagem2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jogos`
--

INSERT INTO `jogos` (`id`, `nome`, `descricao`, `imagem1`, `imagem2`) VALUES
(1, 'Call of Duty Warzone', 'Jogo de tiro', 'uploads/baixados (1).jfif', 'uploads/call-of-duty-warzone-2021-8861.webp'),
(2, 'Free Fire', 'Jogo de tiro com grÃ¡ficos ultrarrealistasðŸ˜Ž', 'uploads/1280x1280bb.jpg', 'uploads/baixados.jfif'),
(3, 'Fortinite', 'Jogo de tiro e construÃ§Ã£o', 'uploads/OIP.jfif', 'uploads/fortnite-1-1536x865.jpg'),
(4, 'Occult Montain', 'Jogo de terror em pixel que da muito medoðŸ˜¨', 'uploads/WhatsApp Image 2024-10-24 at 08.21.55.jpeg', 'uploads/WhatsApp Image 2024-10-24 at 08.21.54.jpeg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'lukinhas', 'llucasslleandro@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4'),
(2, 'Galakino', 'galakino1@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5'),
(3, 'vinicius', 'bola8molhada@gmail.com', '6e73131067b1e49642756da5d8210605c9545f58fe68a4d00180306bb2154d43'),
(4, 'asdf', 'asdf@gmail.com', 'f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b'),
(5, 'capslock', 'capslock@gmail.com', '816209ceb261c9e9299de47f4b2a2415daf73be7b0998b2ec334af8e57f7af83');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD CONSTRAINT `avaliacoes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `avaliacoes_ibfk_2` FOREIGN KEY (`id_jogo`) REFERENCES `jogos` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
