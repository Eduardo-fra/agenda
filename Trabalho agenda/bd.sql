CREATE DATABASE cadastropessoa;

use cadastropessoa;

CREATE TABLE pessoa (
  cpf char(14) NOT NULL PRIMARY KEY,
  nome varchar(100) NULL,
  contato char(11) NULL
);

insert into pessoa values('0987', 'pedro', '9087', '0987')

create table agenda(
  cod int primary key auto_increment,
  cpf char(14) not null,
  foreign key (cpf) references pessoa(cpf),
  data date not null,
  descricao varchar(100) not null
);

alter table pessoa add senha varchar(20) not null;