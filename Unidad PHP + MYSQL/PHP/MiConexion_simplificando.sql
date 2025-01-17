-- Tema 09 y 10 del Manual
-- Borrar BBDD
DROP DATABASE IF EXISTS simplificando;

-- Crear BBDD, Tablas y Relaciones
CREATE DATABASE IF NOT EXISTS simplificando
CHARACTER SET utf8mb4
COLLATE utf8mb4_spanish2_ci;
USE simplificando;



-- Crear Tablas: En primer lugar las PRINCIPALES!!!!!!
-- Tabla productos
CREATE TABLE IF NOT EXISTS productos
(
    Referencia TINYINT UNSIGNED NOT NULL,   -- Not null = No vacio
    Descripcion VARCHAR(40) NOT NULL,
    Precio DECIMAL(5,2) NOT NULL,
    Stock INT UNSIGNED NULL,
    Categorias VARCHAR(255) NULL COMMENT "Categorias separadas por comas",
    PRIMARY KEY pk_productos (Referencia),  -- pk_productos: nombre PK
    INDEX idx_productos (Descripcion)
) ENGINE = innodb
COMMENT = "Tabla productos: ENGINE Motor BBDD";

-- Tabla clientes
CREATE TABLE IF NOT EXISTS clientes
(
    Nif CHAR(9) NOT NULL,
    Nombre VARCHAR(40) NOT NULL,
    Genero BOOLEAN NULL,            -- Verdadero / Falso
    CodigoPostal INT NOT NULL,
    PRIMARY KEY pk_clientes (Nif),
    INDEX idx_clientes (Nombre),
    INDEX idx2_clientes (CodigoPostal)
) ENGINE = innodb
COMMENT = "Tabla Principal Clientes";

-- Tabla ventas
CREATE TABLE IF NOT EXISTS ventas 
(
	NumTicket INT AUTO_INCREMENT, 
    Fecha DATE NOT NULL,
    Referencia TINYINT UNSIGNED NOT NULL,
    Nif CHAR(9) NOT NULL,
    INDEX idx_ventas (NumTicket),
    PRIMARY KEY pk_ventas (Fecha, Referencia, Nif),
    FOREIGN KEY fk_productos (Referencia) REFERENCES productos(Referencia),
    FOREIGN KEY fk_clientes (Nif) REFERENCES clientes(Nif)
) ENGINE = innodb
COMMENT = "Tabla Relacionada ventas";


-- Borrar tablas
-- 1º Borramos tablas relacionadas; Y al final, las principales
-- DROP TABLE ventas;
-- DROP TABLE clientes;
-- DROP TABLE productos;
-- DROP DATABASE simplificando;


-- INSERT (Tema11)
-- Sirve para insertar registros
-- 1º Se insertan registros en tablas principales
USE simplificando;

-- Si se van a meter datos en TODOS los campos, no hace falta ponerlos
INSERT INTO productos 
VALUES (234, "Rotulador Rojo", 0.85, 5, "papelería,escolar");
INSERT INTO productos (Referencia, Descripcion, Precio)
VALUES (112, "Rotulador Negro", 0.85);
INSERT INTO productos (Referencia, Descripcion, Precio, Stock, Categorias)
VALUES (145, "Rotulador Negro", 1.20, 5, "papelería,escolar"),
(156, "Archivador", 3.50, 10, "papelería,oficina");

INSERT INTO clientes (Nif, Nombre, Genero, CodigoPostal)
VALUES 
("11111111A", "Ana", 1, 41702),
("22222222B", "Maria José", 1, 41013),
("33333333C", "Alfonso", 0, 41927);

INSERT INTO ventas (Fecha, Referencia, Nif)
VALUES
("2024-01-10", 234, "11111111A"),
("2024-01-10", 112, "33333333C"),
("2024-01-10", 234, "22222222B");

-- Comprobamos
SELECT * FROM productos;
SELECT * FROM clientes;
SELECT * FROM ventas;