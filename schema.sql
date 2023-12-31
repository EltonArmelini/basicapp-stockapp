CREATE DATABASE stockapp; 
USE stockapp;
CREATE TABLE stocks(
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL UNIQUE,
    ticker varchar(255) NOT NULL,
    performance varchar(255) NOT NULL,
    PRIMARY KEY (id)
);