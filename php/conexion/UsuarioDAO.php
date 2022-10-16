<?php
    include_once('IDAO.php');
    include_once('BaseDeDatos.php');

    class UsuarioDAO extends BaseDeDatos implements IDAO {
        private $conexion;

        public function __construct() {
            parent::__construct('127.0.0.1:3306', 'mysql', 'Experimental', 'login', 'logger');
            $this->conexion = new PDO("$this->driver:host=$this->host;dbname=$this->bd", $this->usuario, $this->contrasena);
        }


        /*
            Busca usuarios en la base de datos, comparando los nombres.

            @param $nombre - Es una array que solo debe contener el nombre del usuario
            @thrown Exception - Arroja Exception de no existir una combinación usuario/cliente
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

            return $usuario = new Usuario($registro['nombre'], $registro['contrasena']);
        }
    }
?>