DROP DATABASE IF EXISTS ECI;

CREATE DATABASE IF NOT EXISTS ECI
CHARACTER SET utf8mb4
COLLATE utf8mb4_spanish2_ci;

USE ECI;

CREATE TABLE IF NOT EXISTS usuarios (
    Correo VARCHAR(50) NOT NULL,
    Clave VARCHAR(50) NOT NULL,
    Nombre VARCHAR(30) NOT NULL,
    Autonomo BOOLEAN NOT NULL,
    Nif_cif INT NOT NULL,
    PRIMARY KEY pk_usuarios(Nif_cif),
    INDEX idx_usuarios(Nombre)
) ENGINE = innodb 
COMMENT = "Tabla usuarios: ENGINE Motor BBDD";