<?php
    include_once('IDAO.php');
    include_once('../instancias/Estudiante.php');

    class EstudianteDAO implements IDAO {
        private $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function getInstancia(array $parametros) {
            $consulta = "SELECT * 
                         FROM v_estudiantes
                         WHERE id=?";
            $registros = $this->bd->sql($consulta, $parametros);

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
                $cedulaRepresentante = $estudiante['cedula'];
                $idClase = $estudiante['id_clase'];
                $descripcionClase = $estudiante['descripcion'];
     
                $est = new Estudiante($id, $nombre, $apellido, $fechaNacimiento, $cedulaRepresentante,
                                      new Clase($idClase, $descripcionClase, null, null));
                $estudiantes[] = $est;
            }
 
            return $estudiantes;
        }

        public function getInstanciaClase($parametros) {
            $consulta = "SELECT * 
                        FROM v_estudiantes
                        WHERE cedula_representante=?";
            $registros = $this->bd->sql($consulta, $parametros);

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
                $cedulaRepresentante = $estudiante['cedula'];
                $idClase = $estudiante['id_clase'];
                $descripcionClase = $estudiante['descripcion'];
        
                $est = new Estudiante($id, $nombre, $apellido, $fechaNacimiento, $cedulaRepresentante,
                                      new Clase($idClase, $descripcionClase, null, null));
                $estudiantes[] = $est;
            }
             
            return $estudiantes;
        }

        public function getInstanciaCedula($parametros) {
            $consulta = "SELECT * 
                         FROM v_estudiantes
                         WHERE cedula_representante=?";
            $registros = $this->bd->sql($consulta, $parametros);

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
                $cedulaRepresentante = $estudiante['cedula'];
                $idClase = $estudiante['id_clase'];
                $descripcionClase = $estudiante['descripcion'];
     
                $est = new Estudiante($id, $nombre, $apellido, $fechaNacimiento, $cedulaRepresentante,
                                      new Clase($idClase, $descripcionClase, null, null));
                $estudiantes[] = $est;
            }
 
            return $estudiantes;
        }
        
        public function getTodos() {
            $consulta = "SELECT * 
                        FROM v_estudiantes";
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
                $cedulaRepresentante = $estudiante['cedula'];
                $idClase = $estudiante['id_clase'];
                $descripcionClase = $estudiante['descripcion'];
     
                $est = new Estudiante($id, $nombre, $apellido, $fechaNacimiento, $cedulaRepresentante, 
                                      new Clase($idClase, $descripcionClase, null, null));
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