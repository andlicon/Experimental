<?php
    include('IConexion.php');

    class BaseDeDatos implements IConexion {
        private static $conexion;
        private static $host = '127.0.0.1:3306';
        private $usuario;
        private $contrasena;

        function __construct($usuario, $contrasena) {
            $this->usuario = $usuario;
            $this->contrasena = $contrasena;
            self::$conexion = null;
        }

        function conectar() {
            $host = '127.0.0.1:3306';
            $dbname = 'Experimental';
    
            try {
                self::$conexion = new PDO('mysql:host='.self::$host.';dbname='.$dbname, $this->usuario, $this->contrasena);
            }
            catch(PDOException $e) {
                echo 'error a la hora de conectar a la base de datos '.$e;
            }
    
            return self::$conexion;
        }
    }

?>