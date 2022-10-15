CREATE DATABASE experimental;

SHOW DATABASES;

CREATE TABLE tipo_usuario 
(
	id				INT 		UNSIGNED 	AUTO_INCREMENT 	NOT NULL,
    nombre			VARCHAR(20)								NOT NULL,
    permisos		INT			DEFAULT 0					NOT NULL,
    
    PRIMARY KEY (id)
);

/*Insertando tipo de usuarios*/
INSERT INTO tipo_usuario (nombre, permisos)
	VALUES	('profesor', 1);
INSERT INTO tipo_usuario (nombre, permisos)
	VALUES	('administrador', 2);
INSERT INTO tipo_usuario (nombre, permisos)
	VALUES	('direccion', 3);

SELECT * FROM tipo_usuario;

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

SELECT * FROM usuario;
    
INSERT INTO usuario (nombre, contrasena, id_tipo_usuario)
	VALUES ('admin', 'admin', 3);
    
CREATE VIEW v_usuarios AS 
	SELECT 
		USUARIO.id				AS 'id',
		USUARIO.nombre			AS 'usuario',
		USUARIO.contrasena		AS 'contrasena',
		TIPO.nombre				AS 'tipo',
		TIPO.permisos			AS 'permiso'
	FROM usuario		USUARIO
	JOIN tipo_usuario	TIPO
	ON (USUARIO.id_tipo_usuario = TIPO.id);

SELECT * FROM v_usuarios;