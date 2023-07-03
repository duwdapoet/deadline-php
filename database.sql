CREATE DATABASE my_database;
USE my_database;

CREATE TABLE user(
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(225) NOT NULL UNIQUE,
    password VARCHAR(225) NOT NULL,
    email VARCHAR(225) NOT NULL
    
    ) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4;