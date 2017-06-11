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
(1,	'Levantamento de Requisitos',	'O Levantamento de Requisitos é a etapa mais importante, no que diz respeito ao retorno de investimentos no projeto. Vários projetos são abandonados pelo baixo levantamento de requisitos, ou seja, membros da equipe não disponibilizaram tempo suficiente para essa fase do projeto, em compreender as necessidades dos clientes em relação ao sistema a ser desenvolvido.',	'2017-06-07',	'2017-06-11',	4,	1),
(2,	'Análise de Requisitos',	'Esta etapa, também chamada de especificação de requisitos, é onde os desenvolvedores fazem um estudo detalhado dos dados levantados na atividade anterior. De onde são construídos modelos a fim de representar o sistema de software a ser desenvolvido.\r\nO interesse nessa atividade é criar uma estratégia de solução, sem se preocupar como essa estratégia será realizada, ou seja, utilizar as necessidades dos clientes, depois de compreendido o problema, para resolução do problema solicitado. Assim é necessário definir o que o sistema deve fazer, antes de definir como o sistema irá fazer.',	'2017-06-06',	NULL,	1,	1),
(3,	'Projeto',	'Nesta fase é que deve ser considerado, como o sistema funcionará internamente, para que os requisitos do cliente possam ser atendidos. Alguns aspectos devem ser considerados nessa fase de projeto do sistema, como: arquitetura do sistema, linguagem de programação utilizada, Sistema Gerenciador de Banco de Dados (SGBD) utilizado, padrão de interface gráfica, entre outros.\r\nNo projeto é gerada uma descrição computacional, mencionando o que o software deve fazer, e deve ser coerente com a descrição realizada na fase de análise de requisitos.',	'2017-06-09',	NULL,	2,	1),
(4,	'Lorem Ipsum',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam commodo ac erat a molestie. Cras maximus, diam sed dictum facilisis, massa ipsum tempus mauris, sed tristique magna ante a dui. Integer eu massa sit amet mi porttitor placerat nec et sapien. Suspendisse in lorem commodo, sagittis augue convallis, molestie justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Curabitur ultricies euismod velit et hendrerit. Ut tempus lectus id purus semper, eget volutpat.',	'2017-06-22',	NULL,	1,	1),
(5,	'Implementação',	'Nessa etapa, o sistema é codificado a partir da descrição computacional da fase de projeto em uma outra linguagem, onde se torna possível a compilação e geração do código-executável para o desenvolvimento software.\r\n            Em um processo de desenvolvimento orientado a objetos, a implementação se dá, definindo as classes de objetos do sistema em questão, fazendo uso de linguagens de programação como, por exemplo: Delphi (Object Pascal), C++, Java, etc.',	'2017-06-10',	NULL,	2,	1),
(6,	'Testes',	'Diversas atividades de testes são executadas a fim de se validar o produto de software, testando cada funcionalidade de cada módulo, buscando, levando em consideração a especificação feita na fase de projeto. Onde o principal resultado é o relatório de testes, que contém as informações relevantes sobre erros encontrados no sistema, e seu comportamento em vários aspectos. Ao final dessa atividade, os diversos módulos do sistema são integrados, resultando no produto de software.',	'2017-06-10',	NULL,	3,	1),
(7,	'Implantação',	'Por fim a implantação compreende a instalação do software no ambiente do usuário. O que inclui os manuais do sistema, importação dos dados para o novo sistema e treinamento dos usuários para o uso correto e adequado do sistema. Em alguns casos quando da existência de um software anterior, também é realizada a migração de dados anteriores desse software.',	'2017-07-03',	NULL,	1,	1);

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
(4,	'Concluído');