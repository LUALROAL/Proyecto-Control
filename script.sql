--ftppassword Ftp123456789/*
--user lagoligu_root
--password root308/*

create database ControlDB;
CREATE TABLE login (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
    
);


CREATE TABLE Estudiantes (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL,
    Grupo VARCHAR(10) NOT NULL,
    Tipo VARCHAR(2) NOT NULL,
    Autorizado boolean NOT NULL,
    Descripcion VARCHAR(1500) NOT NULL
    
    
);


CREATE TABLE ControlAcceso (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idEstudiante int NOT NULL,
    Fecha TIMESTAMP NOT NULL
    
    
    
    
);

use ControlDB;
insert into login (usuario,password) values ('Alejandro','123456');
insert into login (usuario,password) values ('fabio','123456')