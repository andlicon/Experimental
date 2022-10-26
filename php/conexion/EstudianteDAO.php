<?php
    include_once('IDAO.php');
    include_once('../instancias/Estudiante.php');

    class EstudianteDAO implements IDAO {
        private $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function getInstancia(array $id) {
            $consulta = "SELECT * 
                         FROM v_estudiantes
                         WHERE id=?";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $persona = null;
            if(!empty($registros)) {
                $renglon = $registros[0];
                $cedula = $renglon['cedula'];
                $nombre = $renglon['nombre'];
                $apellido = $renglon['apellido'];
                
                $persona = new Persona($cedula, $nombre, $apellido);
            }

            return $persona;
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
            $insert = "INSERT INTO persona (cedula, nombre, apellido)
                       VALUES              (?,      ?,      ?)";
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