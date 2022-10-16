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

CREATE VIEW v_representantes AS
	SELECT 	R.cedula,
			R.nombre,
			R.apellido,
			C.correo
	FROM representante R
	JOIN contacto C
	ON (R.id_contacto = C.id)
    ORDER BY R.nombre ASC,  R.apellido ASC;

SELECT * FROM v_representantes;

DROP VIEW v_representantes;

CREATE view v_estudiantes AS
	SELECT 	E.id			AS 	'estId',
			E.nombre		AS	'estNom',
            E.apellido		AS	'estApell',
            E.fecha_naci	AS	'estFech',
            ER.id			AS	'estRepreId',
            R.cedula		AS	'repCedu',
            R.nombre		AS	'repNom',
            R.apellido		AS	'repApe'
	FROM estudiante E
    JOIN estudiante_representante ER
		ON (E.id = ER.id)
	JOIN v_representantes R
		ON (ER.cedula = R.cedula)
	ORDER BY E.id;
    
SELECT * FROM v_estudiantes;