-- Creando una base de datos para una papeleria
CREATE DATABASE IF NOT EXISTS simplificando
CHARACTER SET utf8mb4
COLLATE utf8mb4_spanish2_ci;

--Entrar en la base de datos
USE simplificando;

-- Borrar database

DROP DATABASE IF EXISTS simplificando;

-- Crear en primer lugar las tablas principales

CREATE TABLE IF NOT EXISTS productos
(
    Referencia INT UNSIGNED NOT NULL,
    Descripcion VARCHAR(40) NOT NULL,
    Precio DECIMAL(5,2) NOT NULL,
    Stock INT UNSIGNED NULL,
    PRIMARY KEY pk_productos (Referencia),
    INDEX idx_productos (Descripcion)
) ENGINE = innodb
COMMENT = "Tabla productos";

CREATE TABLE IF NOT EXISTS clientes
(
    Nif CHAR(9) NOT NULL,
    Nombre VARCHAR(20) NOT NULL,
    Genero BOOLEAN NULL,
    CodigoPostal INT UNSIGNED NULL,
    PRIMARY KEY pk_clientes (Nif),
    INDEX idx_clientes (Nombre),
    INDEX idx2_clientes (CodigoPostal)
) ENGINE = innodb
COMMENT = "Tabla clientes";

CREATE TABLE IF NOT EXISTS ventas
(
    NumTicket INT AUTO_INCREMENT,
    Fecha DATE NOT NULL,
    Referencia INT UNSIGNED NOT NULL,
    Nif CHAR(9) NOT NULL,
    INDEX   idx_ventas (NumTicket),
    PRIMARY KEY pk_ventas (Fecha, Referencia, Nif),
    FOREIGN KEY fk_productos(Referencia) REFERENCES productos (Referencia),
    FOREIGN KEY fk_clientes(Nif) REFERENCES clientes (Nif)
)ENGINE = innodb
COMMENT = "Tabla relacionada ventas";

-- DROP TABLE IF EXISTS ventas;
-- Eliminar tablas

-- INSERT Sirve para insertar registros
-- Siempre primero las tablas principales 

INSERT INTO productos
VALUES (0001, "Boli azul", 0.5, 345);
INSERT INTO productos (Referencia, Descripcion, Precio)
VALUES (1112, "Boli verde", 0.5)

INSERT INTO clientes (Nif, Nombre, Genero, CodigoPostal)
VALUES 
("111111111", "Ana", 1, 43702),
("222222222", "Maria Jose", 1, 41013),
("333333333", "Alfonso", 0, 43927);

INSERT INTO ventas (Fecha, Referencia, Nif)
VALUES
("2024-01-10", 0001, "111111111"),
("2024-01-10", 1112, "222222222"),
("2024-01-10", 0001, "333333333");


-- Update
-- Actualizar datos de la tabla

UPDATE clientes SET Nombre = "Ana Pozo" WHERE Nif = "111111111";

UPDATE ventas SET Fecha = "2024-01-09", Referencia = 1112 
WHERE NumTicket = 3;


-- Delete
-- Borrar filas de una tabla
-- NO SE PUEDE BORAR DATOS DE LA TABLA PRINCIPAL SIN BORRAR SUS DATOS ASOCIADOS DE LA TABLA RELACIONADA
DELETE FROM ventas 
WHERE NumTicket = 1;


-- Prueba

-- SELECT productos.Descripcion, ventas.Fecha, clientes.Nombre
-- FROM productos, ventas, clientes
-- WHERE productos.Referencia = 1112
-- AND productos.Referencia = ventas.Referencia
-- AND clientes.Nif = ventas.Nif;