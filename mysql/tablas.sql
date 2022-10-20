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
    
    
/*ESTO YA ES LA BASE DE DATO*/
CREATE TABLE persona
(
	cedula		VARCHAR(11) 	UNIQUE 	NOT NULL,
    nombre		VARCHAR(11)				NOT NULL,
    apellido	VARCHAR(11)				NOT NULL,
    
    CONSTRAINT pk_persona
    PRIMARY KEY (cedula)
);    

INSERT INTO persona (cedula, 		 nombre, 	apellido)
VALUES 				('v-26520327',	'Andres', 	'Zabala');
INSERT INTO persona (cedula, 		 nombre, 	apellido)
VALUES 				('v-8499579',	 'Daisy', 	'Cedeno');
INSERT INTO persona (cedula, 		 nombre, 	apellido)
VALUES 			    ('v-26000000',	'Andrea', 	'Zabala');
    
CREATE TABLE tipo_contacto
(
	id				INT 		UNSIGNED 	AUTO_INCREMENT 	NOT NULL,
    descripcion		VARCHAR(30)	UNIQUE 						NOT NULL,
    
    CONSTRAINT pk_tipo_contacto
    PRIMARY KEY (id)
);

INSERT INTO tipo_contacto (descripcion)
VALUES					  ('correo');
INSERT INTO tipo_contacto (descripcion)
VALUES					  ('telefono');

CREATE TABLE contacto
(
	id			INT 			UNSIGNED 	AUTO_INCREMENT 	NOT NULL,
	cedula		VARCHAR(11) 				 				NOT NULL,
    id_tipo		INT 			UNSIGNED 			 		NOT NULL,
    contacto	VARCHAR(40)		UNIQUE						NOT NULL,
    
    PRIMARY KEY(id),
    CONSTRAINT fk_contacto_tipo
    FOREIGN KEY (id_tipo) REFERENCES tipo_contacto (id),
    CONSTRAINT fk_contacto_persona
    FOREIGN KEY (cedula) REFERENCES persona(cedula)
);

INSERT INTO contacto (cedula, 			id_tipo, contacto)
VALUES 				 ('v-26520327',		1,		 'AndresJZabalaC@hotmail.com');
INSERT INTO contacto (cedula, 		id_tipo, contacto)
VALUES 				 ('v-26520327',	2,		 '0426-6883542');
INSERT INTO contacto (cedula, 			id_tipo, contacto)
VALUES 				 ('v-26000000',		1,		 'AndyGaby@hotmail.com');
INSERT INTO contacto (cedula, 			id_tipo, contacto)
VALUES 				 ('v-8499579',		1,		 'Daydelv@hotmail.com');

SELECT * FROM contacto;

CREATE TABLE representante
(
	id						INT 					UNSIGNED 	AUTO_INCREMENT 	NOT NULL,
    cedula_representante	VARCHAR(11) 	UNIQUE 								NOT NULL,
    
    CONSTRAINT pk_representante
    PRIMARY KEY (id),
    CONSTRAINT fk_persona
    FOREIGN KEY (cedula_representante) REFERENCES persona (cedula)
);

INSERT INTO representante 	(cedula_representante)
VALUES 						('v-26520327');
INSERT INTO representante 	(cedula_representante)
VALUES 						('v-26000000');

SELECT * FROM representante;

CREATE TABLE estudiante 
(
	id					INT 					UNSIGNED 	AUTO_INCREMENT 	NOT NULL,
    nombre				VARCHAR(11)											NOT NULL,
    apellido			VARCHAR(11)											NOT NULL,
    fecha_nacimiento	DATE												NOT NULL,
    cedula				VARCHAR(11),
    id_representante	INT 					UNSIGNED				 	NOT NULL,
    
    CONSTRAINT pk_estudiante
    PRIMARY KEY (id),
    CONSTRAINT fk_estudiante
    FOREIGN KEY (id_representante) REFERENCES representante (id)
);

INSERT INTO estudiante 	(nombre, 	  apellido, fecha_nacimiento, 	id_representante)
VALUES					('andresito', 'zabala',	'2000-01-01',		1);
INSERT INTO estudiante 	(nombre, 	  apellido, fecha_nacimiento, 	id_representante)
VALUES					('andreita', 'zabala',	'2010-12-01',		2);
INSERT INTO estudiante 	(nombre, 	  apellido, fecha_nacimiento, 	id_representante)
VALUES					('del valle', 'Cedeno',	'2011-03-01',		1);