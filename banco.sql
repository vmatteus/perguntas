/* MYSQL */
CREATE DATABASE `bd_perguntas`;
CREATE TABLE `perguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) DEFAULT NULL,
  `txt_pergunta` text,
  `obrigatoria` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

CREATE TABLE `pessoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `data_nascimento` varchar(10) DEFAULT NULL,
  `sexo` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `respostas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pergunta` int(11) DEFAULT NULL,
  `resposta` text,
  `id_pessoa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_respostas_id_perguntas` FOREIGN KEY (`id`) REFERENCES `perguntas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_respostas_id_pessoa` FOREIGN KEY (`id`) REFERENCES `perguntas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* POSTGRES */

CREATE SEQUENCE PerguntasSequencia;
CREATE TABLE perguntas (
  id integer NOT NULL DEFAULT nextval('PerguntasSequencia') PRIMARY KEY,
  tipo varchar(45) DEFAULT NULL,
  txt_pergunta text,
  obrigatoria varchar(1) DEFAULT NULL
) 

CREATE SEQUENCE PessoaSequencia;
CREATE TABLE pessoa (
  id integer NOT NULL DEFAULT nextval('PessoaSequencia') PRIMARY KEY,
  nome varchar(255) DEFAULT NULL,
  data_nascimento varchar(10) DEFAULT NULL,
  sexo varchar(45) DEFAULT NULL,
  estado varchar(45) DEFAULT NULL
) 

CREATE SEQUENCE RespostasSequencia;
CREATE TABLE respostas (
  id integer NOT NULL DEFAULT nextval('RespostasSequencia') PRIMARY KEY,
  id_pergunta integer DEFAULT NULL,
  resposta text,
  id_pessoa integer DEFAULT NULL,
  CONSTRAINT fk_respostas_id_perguntas FOREIGN KEY (id) REFERENCES perguntas (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_respostas_id_pessoa FOREIGN KEY (id) REFERENCES perguntas (id) ON DELETE NO ACTION ON UPDATE NO ACTION
) 

