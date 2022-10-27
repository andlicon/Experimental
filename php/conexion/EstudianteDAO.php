<?php
    include_once('IDAO.php');
    include_once('../instancias/Estudiante.php');

    class EstudianteDAO implements IDAO {
        private $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function getInstancia(array $idClase) {
            $consulta = "SELECT * 
                         FROM v_estudiantes
                         WHERE id_clase=?";
            $registros = $this->bd->sql($consulta, $idClase);

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
                $idRepresentante = $estudiante['id_representante'];
                $cedulaRepresentante = $estudiante['cedula_representante'];
                $idClase = $estudiante['id_clase'];
                $descripcionClase = $estudiante['descripcion'];
     
                $est = new Estudiante($id, $nombre, $apellido, $fechaNacimiento,
                                      $idRepresentante, $cedulaRepresentante,
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
                $idRepresentante = $estudiante['id_representante'];
                $cedulaRepresentante = $estudiante['cedula_representante'];
                $idClase = $estudiante['id_clase'];
                $descripcionClase = $estudiante['descripcion'];
     
                $est = new Estudiante($id, $nombre, $apellido, $fechaNacimiento,
                                      $idRepresentante, $cedulaRepresentante,
                                      new Clase($idClase, $descripcionClase, null, null));
                $estudiantes[] = $est;
            }
 
            return $estudiantes;
        }

        public function cargar($parametros) {
            $insert = "INSERT INTO estudiante (nombre, apellido, fecha_nacimiento,
                                               id_clase, id_representante)
                       VALUES                 (?, ?, ?. ?, ?)";


            for($i=0; $i<count($parametros); $i++) {
                echo $parametros[$i].'<br>';
            }

            $this->bd->sql($insert, $parametros);
        }

        public function modificar($parametros) {
            $update =  "UPDATE persona
                        SET nombre=?, 
                            apellido=?
                        WHERE cedula=?";
            $this->bd->sql($update, $parametros);
        }
        
        public function eliminar($parametros) {
            $delete =  "DELETE FROM persona
                        WHERE cedula=?";
            $this->bd->sql($delete, $parametros);
        }

    }
?>