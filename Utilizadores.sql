/* DROP TABLE IF EXISTS utilizador;
DROP TABLE IF EXISTS media;
DROP TABLE IF EXISTS watched;

CREATE TABLE utilizador (
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    data_nascimento VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY(nome)
);

CREATE TABLE media (
    titulo VARCHAR(255) NOT NULL,
    tipo VARCHAR(255) NOT NULL,
    PRIMARY KEY(titulo)
);

CREATE TABLE watched (
    titulo VARCHAR(255) NOT NULL,
    nome VARCHAR(255) NOT NULL,
    FOREIGN KEY(nome) REFERENCES utilizador(nome) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(titulo) REFERENCES media(titulo) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(nome, titulo)
);

CREATE DATABASE WebsiteDataBase; */