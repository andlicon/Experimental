<?php
    include_once('IDAO.php');
    include_once('BaseDeDatos.php');
    include_once('../instancias/Representante.php');

    /*
        Implementacion del Data Access Object para los representantes
    */
    class RepresentanteDAO extends BaseDeDatos implements IDAO {
        private $conexion;

        public function __construct() {
            parent::__construct('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $this->conexion = new PDO("$this->driver:host=$this->host;dbname=$this->bd", $this->usuario, $this->contrasena);
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
            $resultado = $this->conexion->prepare($consulta);
            $resultado->execute($cedula);
            $registro = $resultado->fetch();
            
            if(!is_array($registro)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $cedula = $registro['cedula'];
            echo $cedula;
            $nombre = $registro['nombre'];
            echo $nombre;
            $apellido = $registro['apellido'];
            echo $apellido;
            $correo = $registro['correo'];
            echo $correo;

            return new Representante($cedula, $nombre, $apellido, $correo);;
        }
    }
    
?>