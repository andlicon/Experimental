CREATE DATABASE experimental;

SHOW DATABASES;

CREATE TABLE tipo_usuario 
(
	id				INT 		UNSIGNED 	AUTO_INCREMENT 	NOT NULL,
    nombre			VARCHAR(20)								NOT NULL,
    permisos		INT			DEFAULT 0					NOT NULL,
    
    PRIMARY KEY (id)
);

CREATE TABLE usuario
(
	id				INT 			UNSIGNED 	AUTO_INCREMENT 	NOT NULL,
    nombre			VARCHAR(20)									NOT NULL,
    contrasena		VARCHAR(20)									NOT NULL,
    id_tipo_usuario	INT 			UNSIGNED 				 	NOT NULL,
    
    PRIMARY KEY (id),
	CONSTRAINT FK_usuario_tipo_usuario 
    FOREIGN KEY (id_tipo_usuario) REFERENCES tipo_usuario(id)
);

INSERT INTO tipo_usuario (nombre, permisos)
	VALUES	('direccion', 10);
    
INSERT INTO usuario (nombre, contrasena, id_tipo_usuario)
	VALUES ('admin', 'admin', 1);
    
CREATE VIEW usuarios AS 
	SELECT 
		USUARIO.id				AS 'usuario(ID)',
		USUARIO.nombre			AS 'usuario(NOMBRE)',
		USUARIO.contrasena		AS 'usuario(CONTRASENA)',
		TIPO.nombre				AS 'tipo_usuario(NOMBRE)',
		TIPO.permisos			AS 'tipo_usuario(PERMISOS)'
	FROM usuarios				USUARIO
	JOIN tipo_usuario			TIPO
	ON (USUARIO.id_tipo_usuario = TIPO.id);