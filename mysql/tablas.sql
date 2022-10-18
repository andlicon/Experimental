CREATE DATABASE experimental;

SHOW DATABASES;

CREATE TABLE tipo_usuario 
(
	id				INT 		UNSIGNED 	AUTO_INCREMENT 	NOT NULL,
    nombre			VARCHAR(20)								NOT NULL	UNIQUE,
    permisos		INT			DEFAULT 0					NOT NULL 	UNIQUE,
    
    PRIMARY KEY (id)
);

DROP TABLE tipo_usuario;

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
    nombre			VARCHAR(20)									NOT NULL	UNIQUE,
    contrasena		VARCHAR(20)									NOT NULL,
    id_tipo_usuario	INT 			UNSIGNED 				 	NOT NULL,
    
    PRIMARY KEY (id),
	CONSTRAINT FK_usuario_tipo_usuario 
    FOREIGN KEY (id_tipo_usuario) REFERENCES tipo_usuario(id)
);

SELECT * FROM usuario;
    
INSERT INTO usuario (nombre, contrasena, id_tipo_usuario)
	VALUES ('admin', 'admin', 3);
INSERT INTO usuario (nombre, contrasena, id_tipo_usuario)
	VALUES ('contador', '1234', 2);

DROP TABLE usuario;

SELECT * FROM usuario WHERE nombre ='admin';

/*tablas para enviar correos*/
CREATE TABLE contacto
(
	id 		int			UNSIGNED 	 	NOT NULL 	UNIQUE		AUTO_INCREMENT,
    correo 	varchar(30) 				NOT NULL	UNIQUE,
    
    CONSTRAINT pk_contacto PRIMARY KEY(id)
);

INSERT INTO contacto(correo)
	VALUES ('andresjzabalac@hotmail.com');
INSERT INTO contacto(correo)
	VALUES ('daydelv@hotmail.com');
INSERT INTO contacto(correo)
	values ('andygaby@hotmail.com');
INSERT INTO contacto(correo)
	values ('josePerez@hotmail.com');

SELECT * FROM contacto;

CREATE TABLE representante
(
	cedula 		varchar(12)						NOT NULL 	UNIQUE,
    nombre		varchar(20)						NOT NULL,
    apellido 	varchar(20)						NOT NULL,
    id_contacto	int					UNSIGNED 	NOT NULL 	UNIQUE,
    
    /*RESTRICCIONES*/
		/*Primary key*/
    CONSTRAINT pk_representante 
		PRIMARY KEY(cedula),
		/*Foreign key, HACIA TABLA CONTACTO*/
    CONSTRAINT fk_representante_contacto 
		FOREIGN KEY (id_contacto) REFERENCES contacto(id)
);

INSERT INTO representante(cedula, nombre, apellido, id_contacto)
	VALUES('v-26520327', 'Andrés', 'Zabala', 1);
INSERT INTO representante(cedula, nombre, apellido, id_contacto)
	VALUES('v-26000000', 'Andrea', 'Zabala', 3);
INSERT INTO representante(cedula, nombre, apellido, id_contacto)
	VALUES('v-8499579', 'Daisy', 'Cedeno', 2);
INSERT INTO representante(cedula, nombre, apellido, id_contacto)
	VALUES('v-8', 'Jose', 'Perez', 4);
    
CREATE TABLE estudiante_representante
(
	id				INT 			UNSIGNED 	NOT NULL 	AUTO_INCREMENT,
    cedula 			varchar(12)					NOT NULL 	UNIQUE,
    
    /*RESTRICCIONES*/
		/*Primary key*/
    CONSTRAINT pk_estudiante_representante
		PRIMARY KEY (id),
	/*Foreign key, HACIA TABLA CONTACTO*/
    CONSTRAINT fk_esturepre_representante 
		FOREIGN KEY (cedula) REFERENCES representante(cedula)
);    

SELECT * FROM estudiante_representante;

INSERT INTO estudiante_representante (cedula)
	VALUES ('v-8499579');

CREATE TABLE estudiante
(
	id					int 			UNSIGNED 	NOT NULL 	AUTO_INCREMENT,
    nombre				varchar(20)					NOT NULL,
    apellido 			varchar(20)					NOT NULL,
    fecha_naci			date						NOT NULL,
    id_estu_repre		int				UNSIGNED	NOT NULL,
    
    /*RESTRICCIONES*/
		/*Primary key*/
    CONSTRAINT pk_estudiante
		PRIMARY KEY (id),
        /*foreign key HACIA estudiante_representante*/
	CONSTRAINT fk_estudiante_esturepre
		FOREIGN KEY (id_estu_repre) REFERENCES estudiante_representante(id)
);

INSERT INTO estudiante 	(nombre, 		apellido, 	fecha_naci, 	id_estu_repre)
	VALUES				('Andresito', 	'Zabala',	'1998/11/14',	2);
INSERT INTO estudiante 	(nombre, 		apellido, 	fecha_naci, 	id_estu_repre)
	VALUES				('Andreita', 	'Zabala',	'1990/11/14',	2);
INSERT INTO estudiante 	(nombre, 		apellido, 	fecha_naci, 	id_estu_repre)
	VALUES				('Pepito', 		'Rodriguez','2010/10/10',	2);
    
DROP TABLE estudiante;

SELECT *
FROM representante
WHERE cedula = 'V-26520327';