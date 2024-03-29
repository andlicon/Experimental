<?php
    include_once ('IDAO.php');
    include_once(DTO_PATH.'/Persona.php');
    include_once(EXCEPTION_PATH.'/DaoException.php');

    class PersonaDAO implements IDAO {
        private $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function getInstancia(array $cedula) {
            $consulta = "SELECT * 
                        FROM    persona
                        WHERE   cedula=?";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $personas = [];
            for($i=0; $i<count($registros); $i++) {
                $renglon = $registros[$i];
                $cedula = $renglon['cedula'];
                $nombre = $renglon['nombre'];
                $apellido = $renglon['apellido'];
                $idTipoPersona = $renglon['id_tipo_persona'];
                $direccionHogar = $renglon['direccion_hogar'];
                $direccionTrabajo = $renglon['direccion_trabajo'];
                
                $per= new Persona($cedula, $nombre, $apellido, $idTipoPersona, $direccionHogar, $direccionTrabajo);
                $personas[] = $per;
            }

            return $personas;
        }

        public function getTodosRepresentantes() {
            $consulta = "SELECT * 
                         FROM persona		p
                         JOIN tipo_persona	tp
                            ON p.id_tipo_persona = tp.id
                        WHERE tp.descripcion LIKE '%representante%';";
            $registros = $this->bd->sql($consulta, null);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $personas = [];
            for($i=0; $i<count($registros); $i++) {
                $renglon = $registros[$i];
                $cedula = $renglon['cedula'];
                $nombre = $renglon['nombre'];
                $apellido = $renglon['apellido'];
                $idTipoPersona = $renglon['id_tipo_persona'];
                $direccionHogar = $renglon['direccion_hogar'];
                $direccionTrabajo = $renglon['direccion_trabajo'];
                
                $per= new Persona($cedula, $nombre, $apellido, $idTipoPersona, $direccionHogar, $direccionTrabajo);
                $personas[] = $per;
            }

            return $personas;
        }

        public function getTodosProfesores() {
            $consulta = "SELECT * 
                         FROM persona		p
                         JOIN tipo_persona	tp
                            ON p.id_tipo_persona = tp.id
                        WHERE tp.descripcion LIKE '%profesor%';";
            $registros = $this->bd->sql($consulta, null);

            if(empty($registros)) {
                throw new Exception('No existe representante registrado.');
            }

            $personas = [];
            for($i=0; $i<count($registros); $i++) {
                $renglon = $registros[$i];
                $cedula = $renglon['cedula'];
                $nombre = $renglon['nombre'];
                $apellido = $renglon['apellido'];
                $idTipoPersona = $renglon['id_tipo_persona'];
                $direccionHogar = $renglon['direccion_hogar'];
                $direccionTrabajo = $renglon['direccion_trabajo'];
                
                $per= new Persona($cedula, $nombre, $apellido, $idTipoPersona, $direccionHogar, $direccionTrabajo);
                $personas[] = $per;
            }

            return $personas;
        }
        
        public function getTodos() {
            $consulta = "SELECT * 
                        FROM persona";
            $registros = $this->bd->sql($consulta, null);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $personas = [];
            for($i=0; $i<count($registros); $i++) {
                $renglon = $registros[$i];
                $cedula = $renglon['cedula'];
                $nombre = $renglon['nombre'];
                $apellido = $renglon['apellido'];
                $idTipoPersona = $renglon['id_tipo_persona'];
                $direccionHogar = $renglon['direccion_hogar'];
                $direccionTrabajo = $renglon['direccion_trabajo'];
                
                $per= new Persona($cedula, $nombre, $apellido, $idTipoPersona, $direccionHogar, $direccionTrabajo);
                $personas[] = $per;
            }

            return $personas;
        }

        public function cargar($parametros) {
            try {
                $insert = " INSERT INTO persona (cedula, nombre, apellido, id_tipo_persona, direccion_hogar, direccion_trabajo)
                            VALUES              (?,      ?,      ?,        ?,               ?,               ?)";
                $this->bd->sql($insert, $parametros);
            }
            catch(PDOException $e) {
                throw new DaoException(DaoException::PERSONA, DaoException::CARGAR, "ya existe una persona con esa cedula.");
            }
        }

        public function modificar($parametros) {
            $update =  "UPDATE persona
                        SET nombre=?, 
                            apellido=?,
                            id_tipo_persona=?
                        WHERE cedula=?";
            $this->bd->sql($update, $parametros);
        }

        public function modificarNombreApellido($parametros) {
            $update =  "UPDATE persona
                        SET nombre=?, 
                            apellido=?
                        WHERE cedula=?";
            $this->bd->sql($update, $parametros);
        }

        public function modificarInfo($parametros) {
            $update =  "UPDATE persona
                        SET nombre=?, 
                            apellido=?,
                            direccion_hogar = ?,
                            direccion_trabajo = ?
                        WHERE cedula=?";
            $this->bd->sql($update, $parametros);
        }

        public function eliminar($parametros) {
            try {
                $delete =  "DELETE FROM persona
                        WHERE cedula=?";
                $this->bd->sql($delete, $parametros);
            }
            catch(PDOException $e) {
                throw new DaoException(DaoException::PERSONA, DaoException::ELIMINAR, "Existe alguna dependencia que impide borrar a la persona.");
            }
        }

    }
?>