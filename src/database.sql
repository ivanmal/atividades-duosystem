SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `atividade`;
CREATE TABLE `atividade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `descricao` varchar(600) COLLATE utf8_bin NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  `situacao` tinyint(1) unsigned zerofill DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  CONSTRAINT `atividade_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `atividade` (`id`, `nome`, `descricao`, `data_inicio`, `data_fim`, `status`, `situacao`) VALUES
(1,	'Levantamento de Requisitos',	'O Levantamento de Requisitos � a etapa mais importante, no que diz respeito ao retorno de investimentos no projeto. V�rios projetos s�o abandonados pelo baixo levantamento de requisitos, ou seja, membros da equipe n�o disponibilizaram tempo suficiente para essa fase do projeto, em compreender as necessidades dos clientes em rela��o ao sistema a ser desenvolvido.',	'2017-06-07',	'2017-06-11',	4,	1),
(2,	'An�lise de Requisitos',	'Esta etapa, tamb�m chamada de especifica��o de requisitos, � onde os desenvolvedores fazem um estudo detalhado dos dados levantados na atividade anterior. De onde s�o constru�dos modelos a fim de representar o sistema de software a ser desenvolvido.\r\nO interesse nessa atividade � criar uma estrat�gia de solu��o, sem se preocupar como essa estrat�gia ser� realizada, ou seja, utilizar as necessidades dos clientes, depois de compreendido o problema, para resolu��o do problema solicitado. Assim � necess�rio definir o que o sistema deve fazer, antes de definir como o sistema ir� fazer.',	'2017-06-06',	NULL,	1,	1),
(3,	'Projeto',	'Nesta fase � que deve ser considerado, como o sistema funcionar� internamente, para que os requisitos do cliente possam ser atendidos. Alguns aspectos devem ser considerados nessa fase de projeto do sistema, como: arquitetura do sistema, linguagem de programa��o utilizada, Sistema Gerenciador de Banco de Dados (SGBD) utilizado, padr�o de interface gr�fica, entre outros.\r\nNo projeto � gerada uma descri��o computacional, mencionando o que o software deve fazer, e deve ser coerente com a descri��o realizada na fase de an�lise de requisitos.',	'2017-06-09',	NULL,	2,	1),
(4,	'Lorem Ipsum',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam commodo ac erat a molestie. Cras maximus, diam sed dictum facilisis, massa ipsum tempus mauris, sed tristique magna ante a dui. Integer eu massa sit amet mi porttitor placerat nec et sapien. Suspendisse in lorem commodo, sagittis augue convallis, molestie justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Curabitur ultricies euismod velit et hendrerit. Ut tempus lectus id purus semper, eget volutpat.',	'2017-06-22',	NULL,	1,	1),
(5,	'Implementa��o',	'Nessa etapa, o sistema � codificado a partir da descri��o computacional da fase de projeto em uma outra linguagem, onde se torna poss�vel a compila��o e gera��o do c�digo-execut�vel para o desenvolvimento software.\r\n            Em um processo de desenvolvimento orientado a objetos, a implementa��o se d�, definindo as classes de objetos do sistema em quest�o, fazendo uso de linguagens de programa��o como, por exemplo: Delphi (Object Pascal), C++, Java, etc.',	'2017-06-10',	NULL,	2,	1),
(6,	'Testes',	'Diversas atividades de testes s�o executadas a fim de se validar o produto de software, testando cada funcionalidade de cada m�dulo, buscando, levando em considera��o a especifica��o feita na fase de projeto. Onde o principal resultado � o relat�rio de testes, que cont�m as informa��es relevantes sobre erros encontrados no sistema, e seu comportamento em v�rios aspectos. Ao final dessa atividade, os diversos m�dulos do sistema s�o integrados, resultando no produto de software.',	'2017-06-10',	NULL,	3,	1),
(7,	'Implanta��o',	'Por fim a implanta��o compreende a instala��o do software no ambiente do usu�rio. O que inclui os manuais do sistema, importa��o dos dados para o novo sistema e treinamento dos usu�rios para o uso correto e adequado do sistema. Em alguns casos quando da exist�ncia de um software anterior, tamb�m � realizada a migra��o de dados anteriores desse software.',	'2017-07-03',	NULL,	1,	1);

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `status` (`id`, `nome`) VALUES
(1,	'Pendente'),
(2,	'Em Desenvolvimento'),
(3,	'Em Teste'),
(4,	'Conclu�do');