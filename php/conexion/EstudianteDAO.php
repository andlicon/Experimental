<?php
    include_once('IDAO.php');

    class PersonaDAO implements IDAO {
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
        
        // public function getTodos() {
        //     $consulta = "SELECT * 
        //                 FROM persona";
        //     $registros = $this->bd->sql($consulta, $cedula);

        //     if(empty($registros)) {
        //         throw new Exception('No existe el representante con dicha cedula');
        //     }

        //     $personas = [];
        //     for($i=0; $i<count($registros); $i++) {
        //         $persona = $registros[$i];

        //         $cedula = $persona['cedula'];
        //         $nombre = $persona['nombre'];
        //         $apellido = $persona['apellido'];
                
        //         $per= new Persona($cedula, $nombre, $apellido);

        //         $personas[] = $per;
        //     }
            
        //     return $personas;
        // }

        // public function cargar($parametros) {
        //     $insert = "INSERT INTO persona (cedula, nombre, apellido)
        //                VALUES              (?,      ?,      ?)";
        //     $this->bd->sql($insert, $parametros);
        // }

        // public function modificar($parametros) {
        //     $update =  "UPDATE persona
        //                 SET nombre=?, 
        //                     apellido=?
        //                 WHERE cedula=?";
        //     $this->bd->sql($update, $parametros);
        // }

        // public function eliminar($parametros) {
        //     $delete =  "DELETE FROM persona
        //                 WHERE cedula=?";
        //     $this->bd->sql($delete, $parametros);
        // }

    }

?>