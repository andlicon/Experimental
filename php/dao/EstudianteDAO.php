<?php
    include_once('IDAO.php');
    include_once(DTO_PATH.'/Estudiante.php');

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
                throw new Exception('No existe el representante con dicha cedula');
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
                throw new Exception('No hay estudiantes en el id_clase senalado');
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
                throw new Exception('No existe el representante con dicha cedula');
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
                throw new Exception('No existe estudiante con dicha cedula');
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
            $insert = "INSERT INTO estudiante (nombre, apellido, fecha_nacimiento, id_clase, cedula_representante)
                       VALUES                 (?, ?,  ?, ?, ?)";
            $this->bd->sql($insert, $parametros);
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
            $delete =  "DELETE FROM estudiante
                        WHERE id=?";
            $this->bd->sql($delete, $parametros);
        }

    }
?>