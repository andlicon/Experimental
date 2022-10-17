<?php
    include_once('IDAO.php');
    include_once('BaseDeDatos.php');

    /*
        Implementación de la interfaz Data Access Object para el caso particular de 
        las instancias "usuario"
    */
    class UsuarioDAO extends BaseDeDatos implements IDAO {
        //Conexion a la base de datos, es un objeto PDO
        private $conexion;

        /*
            Constructor, crea un acceso a la base de dato.
        */
        public function __construct() {
            parent::__construct('127.0.0.1:3306', 'mysql', 'Experimental', 'login', 'logger');
            $this->conexion = new PDO("$this->driver:host=$this->host;dbname=$this->bd", $this->usuario, $this->contrasena);
        }


        /*
            Busca usuarios en la base de datos, comparando los nombres.

            @param array $nombre - Es una array que solo debe contener el nombre del usuario
            @thrown Exception - Arroja Exception de no existir una combinación usuario/cliente
            @return Usuario es un transfer object 
        */
        public function getInstancia(array $nombre) {
            $consulta = "SELECT * 
                        FROM usuario 
                        WHERE nombre=?";
            $resultado = $this->conexion->prepare($consulta);
            $resultado->execute($nombre);
            $registro = $resultado->fetch();
            
            if(!is_array($registro)) {
                throw new Exception('No existe combinación usuario/contrasena');
            }

            $nombre = $registro['nombre'];
            $contrasena = $registro['contrasena'];
            return $usuario = new Usuario($nombre, $contrasena);
        }
    }
?>