<?php
    //Esta es una fachada que tendra informacion referente a la base de datos.
    class BaseDeDatos {
        private $host;            //Host de base de datos
        private $driver;          //Driver (base de dato a la que se accede)
        private $bd;              //Nombre de la base de dato
        private $usuario;         //usuario de la base de datos
        private $contrasena;      //Conetrasena de la base de datos
        private PDO $conexion;    //Conexion a la base de datos
        
        private static $instancia;

        /*
            Es una fachada con informacion referente a la base de datos
            y accede a la misma

            @param $host;            //Host de base de datos
            @param $driver;          //Driver (base de dato a la que se accede)
            @param $bd;              //Nombre de la base de dato
            @param $usuario;         //usuario de la base de datos
            @param $contrasena;      //Conetrasena de la base de datos
        */
        public function __construct($host, $driver, $bd, $usuario, $contrasena) {
            $this->host = $host;
            $this->driver = $driver;
            $this->bd = $bd;
            $this->usuario = $usuario;
            $this->contrasena = $contrasena;

            $this->conexion = new PDO("$this->driver:host=$this->host;dbname=$this->bd", $this->usuario, $this->contrasena);
        }

        /*
            Realiza una consulta a la base de datos a traves de una consulta preparada
            ! deben ser igual los '?' en la consulta preparada que parametros en '$parametros'

            @param $consulta    - La consulta SQL que se realizara
            @param $parametros  - Los parámetros que serán sustituidos en la consulta preparada

            @return Array que representa a todos los resultados
        */
        public function sql($consulta, $parametros) {
            $resultado = $this->conexion->prepare($consulta);

            if($parametros) {
                $resultado->execute($parametros);
            }
            else {
                $resultado->execute();
            }

            $registros = $resultado->fetchAll();

            return $registros;
        }

        public function procedure($procedure, $parametros) {
            $procedure = $this->conexion->prepare($procedure);
            
            if($parametros) {
                $procedure->execute($parametros);
            }
            else {
                $procedure->execute();
            }

        }

        public static function getInstancia() {
        if (!isset(self::$instancia)) {
            self::$instancia = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
        }

        return self::$instancia;
    }

        protected function __clone(){}

        public function __wakeup(){throw new Exception("Esta clase no se puede serializar.");}

    }
?>