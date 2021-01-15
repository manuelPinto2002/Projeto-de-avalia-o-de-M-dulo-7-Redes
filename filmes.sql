-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14-Jan-2021 às 13:23
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `filmes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atores`
--

CREATE TABLE `atores` (
  `id_Ator` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Nacionalidade` varchar(50) NOT NULL,
  `Data_Nascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `atores`
--

INSERT INTO `atores` (`id_Ator`, `Nome`, `Nacionalidade`, `Data_Nascimento`) VALUES
(1, 'Pinto zerolho', '2002-05-30', '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `filmes`
--

CREATE TABLE `filmes` (
  `id_filme` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `sinopse` text,
  `quantidade` smallint(6) DEFAULT '0',
  `idioma` varchar(30) DEFAULT NULL,
  `data_lancamento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `filmes`
--

INSERT INTO `filmes` (`id_filme`, `titulo`, `sinopse`, `quantidade`, `idioma`, `data_lancamento`) VALUES
(2, 'Karate Kid', 'Dre Parker (Jaden Smith) é um garoto de 12 anos que poderia ser o mais popular da cidade de Detroit, Estados Unidos, mas a carreira de sua mãe acaba os levando para a cidade de Pequim, na China.\r\n\r\nNo novo país, Dre se apaixona pela sua colega de classe Mei Ying, que torna-se sua amiga, mas as diferenças culturais tornam essa amizade impossível. Pior ainda, os sentimentos de Dre fazem com que o aluno mais brigão da sala e prodígio do Kung Fu, Cheng, torne-se seu inimigo, fazendo com que Dre sofra bullying nas mãos dos amigos de Cheng, sem poder reagir. Sem amigos na nova cidade, Dre não tem a quem recorrer exceto ao zelador do seu prédio Mr. Han (Jackie Chan), que é secretamente um mestre do Kung Fu.\r\n\r\nÀ medida em que Han ensina a Dre que o Kung Fu é muito mais que socos e habilidade, mas sim maturidade e calma, Dre percebe que encarar os brigões da turma será a aventura de uma vida. E os ensinamentos de seu mestre explicam o que é o verdadeiro Kung-Fu.', 1, 'ingels', NULL),
(3, 'Pirates of the Caribbean:\r\nThe Curse of the Black Pearl', 'Enquanto o Governador Weatherby Swann e sua filha de 12 anos, Elizabeth Swann, estão velejando para Port Royal, Jamaica, o navio deles encontra um naufrágio com um único sobrevivente, um jovem chamado Will Turner. Elizabeth esconde um medalhão de ouro que o inconsciente Will estava usando, com medo de que isso o identificasse como um pirata. Ela tem um vislumbre de um navio pirata misterioso, o Pérola Negra.\r\n\r\nOito anos depois, James Norrington da Marinha Real Britânica é promovido a Comodoro. Ele pede a mão de Elizabeth em casamento. Antes dela responder, seu espartilho super apertado a faz desmaiar e cair na baía, onde ela afunda. Quando o medalhão que ele está usando chega ao fundo, ele emite um pulso.\r\n\r\nO pirata, Capitão Jack Sparrow, chega a Port Royal para comandar um navio. Ele resgata Elizabeth, porém Norrington reconhece Jack como um pirata e o prende. Jack, por um breve período, toma Elizabeth como refém para poder escapar, se escondendo em uma oficina de ferreiro, encontrando Will, agora um aprendiz de ferreiro. Jack fica inconsciente após uma luta e é preso, sentenciado a forca no dia seguinte. Naquela noite, Port Royal é sitiada pelo Pérola Negra, respondendo ao pulso do medalhão. Elizabeth é capturada e invoca seu direito de falar com o capitão. Ela mente para o Capitão Hector Barbossa, dizendo que seu sobrenome era Turner. Ela negocia o cessar fogo a Port Royal em troca do medalhão.', 1, 'ingles', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `realizadores`
--

CREATE TABLE `realizadores` (
  `id_realizador` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `nacionalidade` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `realizadores`
--

INSERT INTO `realizadores` (`id_realizador`, `nome`, `nacionalidade`) VALUES
(1, 'pinto', ''),
(2, 'pinto', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id` bigint(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`id`, `nome`, `user_name`, `email`, `password`) VALUES
(1, 'Manuel Pinto', 'swiftpt', 'manel@gmail.com', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atores`
--
ALTER TABLE `atores`
  ADD PRIMARY KEY (`id_Ator`);

--
-- Indexes for table `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`id_filme`);

--
-- Indexes for table `realizadores`
--
ALTER TABLE `realizadores`
  ADD PRIMARY KEY (`id_realizador`);

--
-- Indexes for table `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atores`
--
ALTER TABLE `atores`
  MODIFY `id_Ator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `filmes`
--
ALTER TABLE `filmes`
  MODIFY `id_filme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `realizadores`
--
ALTER TABLE `realizadores`
  MODIFY `id_realizador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
