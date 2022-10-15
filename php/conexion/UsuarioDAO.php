<?php
    include_once('IDAO.php');
    include_once('BaseDeDatos.php');

    class UsuarioDAO extends BaseDeDatos implements IDAO {
        private $conexion;

        public function __construct() {
            parent::__construct('127.0.0.1:3306', 'mysql', 'Experimental', 'login', 'logger', '', '', '');
            $this->conexion = new PDO("$this->driver:host=$this->host;dbname=$this->bd", $this->usuario, $this->contrasena);
        }


        public function getInstancia($nombre) {
            //CONECTAR PARA USUARIO
            $resultado = $this->conexion->query("SELECT * FROM usuario WHERE nombre='$nombre'");

            $registro = $resultado->fetch();

            $usuario = null;

            //ARREGLAR ESTO POR FAVOR

            if( ($registro->count() > 0) ) {
                $usuario = new Usuario($registro['nombre'], $registro['contrasena']);
            }

            return $usuario;
        }
    }
?>