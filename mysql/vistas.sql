CREATE VIEW v_usuarios AS 
	SELECT 
		USUARIO.id				AS 'id',
		USUARIO.nombre			AS 'usuario',
		USUARIO.contrasena		AS 'contrasena',
		TIPO.nombre				AS 'tipo',
		TIPO.permisos			AS 'permiso'
	FROM usuario		USUARIO
	JOIN tipo_usuario	TIPO
	ON (USUARIO.id_tipo_usuario = TIPO.id)
    ORDER BY id ASC;

SELECT * FROM v_usuarios;

DROP VIEW v_usuarios;

/*
	TODOS LOS CONTACTOS DE CUALQUIER PERSONA DENTRO DE LA BASE DE DATOS
*/
CREATE VIEW v_persona_contacto AS
	SELECT 	p.cedula,
			p.nombre,
			p.apellido,
			tc.descripcion,
			c.contacto
	FROM persona p
	JOIN contacto c
	ON (p.cedula = c.cedula)
	JOIN tipo_contacto tc
	ON (c.id_tipo=tc.id);

SELECT * FROM v_persona_contacto;

/*
	NOMBRE, CEDULA Y APELLIDO DE TODOS LOS REPRESENTANTES DENTRO DEL INSTITUTO
*/
CREATE VIEW v_representantes AS
		SELECT 	r.id,
				p.cedula,
				p.nombre,
				p.apellido
		FROM representante r
		JOIN persona p
		ON (p.cedula = r.cedula_representante);
        
SELECT * FROM v_representantes;

/*
	INFORMACIÓN Y CONTACTO DE TODOS LOS REPRESENTANTES
*/

CREATE VIEW v_representante_contacto AS
	SELECT 	r.id,
			p.cedula,
            p.nombre,
            p.apellido,
            tc.descripcion,
            c.contacto
	FROM  persona p
	JOIN representante r
	ON (p.cedula = r.cedula_representante)
    JOIN contacto c
	ON (p.cedula = c.cedula)
	JOIN tipo_contacto tc
	ON (c.id_tipo=tc.id);

SELECT * from v_representante_contacto;

/*
	MUESTRA TOPDA LA INFORMACION REFERENTE A LOS ESTUDIANTES Y ASI COMO LA CEDULA DE SU PADRE, PARA PODER CONECTARLO
*/
CREATE view v_estudiantes AS
	SELECT 	e.id,
			e.nombre,
            e.apellido,
            e.cedula,
            e.fecha_nacimiento,
            e.id_representante,
            r.cedula_representante
	FROM estudiante e
	JOIN representante r
	ON (e.id_representante = r.id);

SELECT * FROM v_estudiantes;