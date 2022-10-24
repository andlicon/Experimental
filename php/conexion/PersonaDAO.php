<?php
    include_once ('IDAO.php');

    class PersonaDAO implements IDAO {
        private $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function getInstancia(array $cedula) {
            $consulta = "SELECT * 
                        FROM persona
                        WHERE cedula=?";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $personas = [];
            for($i=0; $i<count($registros); $i++) {
                $persona = $registros[$i];

                $cedula = $persona['cedula'];
                $nombre = $persona['nombre'];
                $apellido = $persona['apellido'];
                
                $persona = new Persona($cedula, $nombre, $apellido);

                $personas[] = $persona;
            }
            
            return $personas;
        }
        
        public function getTodos() {
            $consulta = "SELECT * 
                        FROM persona";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $personas = [];
            for($i=0; $i<count($registros); $i++) {
                $persona = $registros[$i];

                $cedula = $persona['cedula'];
                $nombre = $persona['nombre'];
                $apellido = $persona['apellido'];
                
                $per= new Persona($cedula, $nombre, $apellido);

                $personas[] = $per;
            }
            
            return $personas;
        }

        public function cargar($parametros) {
            $insert = "INSERT INTO persona (cedula, nombre, apellido)
                       VALUES              (?,      ?,      ?)";
            $this->bd->sql($insert, $parametros);
        }

    }
?>