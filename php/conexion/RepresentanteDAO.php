<?php
    include_once('IDAO.php');
    include_once('BaseDeDatos.php');
    include_once('../instancias/Representante.php');

    /*
        Implementacion del Data Access Object para los representantes
    */
    class RepresentanteDAO implements IDAO {
        private BaseDeDatos $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        /*
            Consulta a la base de dato por un representante en particular, todo basado en su cedula

            @param  array $cedula arreglo que unicamente debe contener la cedula del representante, si trae mas
                    variables, entonces arrojara error

            @trown Exception No existe el representante

            @return Representante es un transfer object 
        */
        public function getInstancia(array $cedula) {
            $consulta = "SELECT * 
                        FROM v_representantes
                        WHERE cedula=?";
            $representante = $this->bd->consultar($consulta, $cedula);
            
            if(!is_array($representante)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $cedula = $representante['cedula'];
            $nombre = $representante['nombre'];
            $apellido = $representante['apellido'];
            $correo = $representante['correo'];

            return new Representante($cedula, $nombre, $apellido, $correo);
        }

        public function getTodos() {
            $consulta = "SELECT * 
                         FROM v_representantes;";
             $resultado = $this->conexion->prepare($consulta);
             $resultado->execute();

            $representantes = fletchAll();

             if($representantes) {
                //  RECORRER TODOS LOS REGISTROS
             }

         }
    }
    
?>