/*
	Al crear un representante, crea un registro en estudiante_representante
*/
DELIMITER $$
CREATE TRIGGER t_representante
AFTER INSERT ON representante
FOR EACH ROW
BEGIN 
   INSERT INTO estudiante_representante(cedula)
   VALUES (NEW.cedula);
END; $$

