<?php
    //Esta es una fachada que tendra informacion referente a la base de datos.
    class BaseDeDatos {
        protected $host;            //Host de base de datos
        protected $driver;          //Driver (base de dato a la que se accede)
        protected $bd;              //Nombre de la base de dato
        protected $usuario;         //usuario de la base de datos
        protected $contrasena;      //Conetrasena de la base de datos
        protected PDO $conexion;    //Conexion a la base de datos

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
        public function consultar($consulta, array $parametros) {
            $resultado = $this->conexion->prepare($consulta);
            $resultado->execute($parametros);
            $registros = $resultado->fetch();

            return $registros;
        }
    }
?>