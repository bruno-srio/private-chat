-- version 5.2.0
-- https://www.phpmyadmin.net/
-- Tempo de geração: 21-Abr-2023 às 18:20
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `privatechat`
--
CREATE DATABASE IF NOT EXISTS `privatechat` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `privatechat`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `messages`
--

CREATE TABLE `messages` (
  `msgID` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `sendingMsgID` varchar(36) NOT NULL,
  `receivingMsgID` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `messages`
--

INSERT INTO `messages` (`msgID`, `message`, `date`, `sendingMsgID`, `receivingMsgID`) VALUES
(151, 'Teste', '2023-04-21 17:17:23', '546844068', '652072034');

-- --------------------------------------------------------

--
-- Estrutura da tabela `profile`
--

CREATE TABLE `profile` (
  `profileID` varchar(1) NOT NULL DEFAULT '0',
  `profileType` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `profile`
--

INSERT INTO `profile` (`profileID`, `profileType`) VALUES
('a', 'admin'),
('u', 'user');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `uniqueID` varchar(36) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `profile_profileID` varchar(1) NOT NULL DEFAULT 'u'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`uniqueID`, `fname`, `lname`, `email`, `password`, `img`, `status`, `profile_profileID`) VALUES
('1072979557', 'John ', 'Doe', 'johndoe@gmail.com', '$2y$12$b42MP.plJfHkxtjHPF3O.OOg0it0Llu0OOKW4475L/AemF/rjdk9q', '1673062302team-1.jpg', 'offline', 'u'),
('195572539', 'Sam', 'Porter Bridges', 'sambridges@outlook.com', '$2y$12$7IBbz8/9HulTZMPnpbKpzuzHnr8qrdSlRAySGr8zcIjj4htKSGVF.', '1673815163sam.png', 'offline', 'u'),
('478135297', 'Dutch', 'Schultz', 'schultz@gmail.com', '$2y$12$es6yeJIJ3yAQpGMO0td4nuYqsJhdYL7LvyY6ejbgXWfbZMdp7LM6G', '1673815693istockphoto-1338134336-170667a.jpg', 'offline', 'u'),
('546844068', 'Satoshi', 'Nakamoto', 'nakamoto@yahoo.com.br', '$2y$12$Gzj.M9TY4uYZUxbfjS4zlut4lJexnN5fXQk.mgN7y3kTNreEVlGre', '1682092803bdf86634deed4a573d040fb64252f1b7.gif', 'offline', 'u'),
('652072034', 'Klara', 'Böhringer', 'killjoy@valorant.com', '$2y$12$c.yDQjRkgRbzK2F30p9cFeGYDxtpA4qcGyMn0vu3nZs0AnoiPm8uq', '1673815551kj.jpg', 'offline', 'u');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msgID`),
  ADD KEY `fk_messages_users_idx` (`sendingMsgID`),
  ADD KEY `fk_messages_users1_idx` (`receivingMsgID`);

--
-- Índices para tabela `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profileID`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uniqueID`),
  ADD KEY `fk_users_profile1_idx` (`profile_profileID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `messages`
--
ALTER TABLE `messages`
  MODIFY `msgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_users1` FOREIGN KEY (`receivingMsgID`) REFERENCES `users` (`uniqueID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_profile1` FOREIGN KEY (`profile_profileID`) REFERENCES `profile` (`profileID`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
