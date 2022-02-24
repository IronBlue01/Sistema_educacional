

create table cursos(
    id_curso int auto_increment not null,
    nome varchar(300),
    primary key(id_curso)
)
default charset = utf8,
engine = InnoDb;



create table professores(
    id_professor int auto_increment not null,
    nome varchar(200),
    username varchar(200),
    senha varchar(200),
    nascimento date,
    curso int,
    primary key(id_professor),
    foreign key(curso) references cursos(id_curso)
    
)
default charset = utf8,
engine = InnoDb;

drop table professores;



create table turmas(
	id_turma int auto_increment not null,
    serie varchar(3),
    curso int,
    professor int, 
    stattus boolean,
    primary key(id_turma),
    foreign key(curso) references cursos(id_curso),
    foreign key(professor) references professores(id_professor)

) 
default charset = utf8,
engine = InnoDb;

drop table turmas;



create table alunos(
	id_aluno int auto_increment not null,
    avatar varchar(250),
    nome varchar(200),
    username varchar(200),
    senha varchar(200),
    email varchar(200),
    turma int,
    primary key(id_aluno),
    foreign key(turma) references turmas(id_turma)
)
default charset = utf8,
engine = InnoDb;

drop table alunos;










