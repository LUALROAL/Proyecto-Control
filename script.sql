--ftppassword Ftp123456789/*
--user lagoligu_root
--password root308/*

create database ControlDB;
CREATE TABLE login (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
    
);

use ControlDB;
insert into login (usuario,password) values ('Alejandro','123456');
insert into login (usuario,password) values ('fabio','123456')