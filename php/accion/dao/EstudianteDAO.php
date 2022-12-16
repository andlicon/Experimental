<?php
    include_once('IDAO.php');
    include_once(DTO_PATH.'/Estudiante.php');
    include_once(EXCEPTION_PATH.'DaoException.php');

    class EstudianteDAO implements IDAO {
        private $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function getInstancia(array $id) {
            $consulta = "SELECT * 
                         FROM estudiante
                         WHERE id=?";
            $registros = $this->bd->sql($consulta, $id);

            if(empty($registros)) {
                throw new Exception('No existe estudiante asociado a dicha id');
            }

            $estudiantes = [];
            for($i=0; $i<count($registros); $i++) {
                $estudiante = $registros[$i];
                $id = $estudiante['id'];
                $nombre = $estudiante['nombre'];
                $apellido = $estudiante['apellido'];
                $fechaNacimiento = $estudiante['fecha_nacimiento'];
                $cedulaRepresentante = $estudiante['cedula_representante'];
                $idClase = $estudiante['id_clase'];
     
                $est = new Estudiante($id, $nombre, $apellido, $fechaNacimiento, 
                                        $cedulaRepresentante, $idClase);
                $estudiantes[] = $est;
            }
 
            return $estudiantes;
        }

        public function getInstanciaClase($idClase) {
            $consulta = "SELECT * 
                        FROM estudiante
                        WHERE id_clase=?";
            $registros = $this->bd->sql($consulta, $idClase);

            if(empty($registros)) {
                throw new Exception('No existe estudiante asociada a la clase.');
            }
            
            $estudiantes = [];
            for($i=0; $i<count($registros); $i++) {
                $estudiante = $registros[$i];
                $id = $estudiante['id'];
                $nombre = $estudiante['nombre'];
                $apellido = $estudiante['apellido'];
                $fechaNacimiento = $estudiante['fecha_nacimiento'];
                $cedulaRepresentante = $estudiante['cedula_representante'];
                $idClase = $estudiante['id_clase'];
     
                $est = new Estudiante($id, $nombre, $apellido, $fechaNacimiento, 
                                        $cedulaRepresentante, $idClase);
                $estudiantes[] = $est;
            }
             
            return $estudiantes;
        }

        public function getInstanciaCedula($cedulaRep) {
            $consulta = "SELECT * 
                         FROM estudiante
                         WHERE cedula_representante=?";
            $registros = $this->bd->sql($consulta, $cedulaRep);

            if(empty($registros)) {
                throw new Exception('No existe estudiante asociado al usuario.');
            }

            $estudiantes = [];
            for($i=0; $i<count($registros); $i++) {
                $estudiante = $registros[$i];
                $id = $estudiante['id'];
                $nombre = $estudiante['nombre'];
                $apellido = $estudiante['apellido'];
                $fechaNacimiento = $estudiante['fecha_nacimiento'];
                $cedulaRepresentante = $estudiante['cedula_representante'];
                $idClase = $estudiante['id_clase'];
     
                $est = new Estudiante($id, $nombre, $apellido, $fechaNacimiento, 
                                        $cedulaRepresentante, $idClase);
                $estudiantes[] = $est;
            }
 
            return $estudiantes;
        }
        
        public function getTodos() {
            $consulta = "SELECT * 
                        FROM estudiante";
            $registros = $this->bd->sql($consulta, null);

            if(empty($registros)) {
                throw new Exception('No existen estudiante en la base de datos.');
            }
           
            $estudiantes = [];
            for($i=0; $i<count($registros); $i++) {
                $estudiante = $registros[$i];
                $id = $estudiante['id'];
                $nombre = $estudiante['nombre'];
                $apellido = $estudiante['apellido'];
                $fechaNacimiento = $estudiante['fecha_nacimiento'];
                $cedulaRepresentante = $estudiante['cedula_representante'];
                $idClase = $estudiante['id_clase'];
     
                $est = new Estudiante($id, $nombre, $apellido, $fechaNacimiento, 
                                        $cedulaRepresentante, $idClase);
                $estudiantes[] = $est;
            }
 
            return $estudiantes;
        }

        public function cargar($parametros) {
            try {
                $insert = "INSERT INTO estudiante (nombre, apellido, fecha_nacimiento, id_clase, cedula_representante)
                       VALUES                 (?, ?,  ?, ?, ?)";
                $this->bd->sql($insert, $parametros);
            }
            catch(PDOException $e) {
                throw new DaoException(DaoException::ESTUDIANTE, DaoException::CARGAR, "ya existe un estudiante con el id indicado.");
            }
        }

        public function modificar($parametros) {
            $update =  "UPDATE estudiante
                        SET nombre=?, 
                            apellido=?,
                            fecha_nacimiento=?,
                            id_clase=?,
                            cedula_representante=?
                        WHERE id=?";
            $this->bd->sql($update, $parametros);
        }
        
        public function eliminar($parametros) {
            try {
                $delete =  "DELETE FROM estudiante
                            WHERE id=?";
                $this->bd->sql($delete, $parametros);
            }
            catch(PDOException $e) {
                throw new DaoException(DaoException::ESTUDIANTE, DaoException::ELIMINAR, "No se puede eliminar estudiante por alguna dependencia.");
            }
        }

    }
?>