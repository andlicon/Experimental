<?php
    //Esta es una fachada que tendra informacion referente a la base de datos.
    class BaseDeDatos {
        //ENCAPSULAR TODO ESTO
        //ENCAPSULAR TODO ESTO
        //ENCAPSULAR TODO ESTO
        //ENCAPSULAR TODO ESTO
        protected $host;
        protected $driver;
        protected $bd;
        protected $usuario;
        protected $contrasena;

        public function __construct($host, $driver, $bd, $usuario, $contrasena) {
            $this->host = $host;
            $this->driver = $driver;
            $this->bd = $bd;
            $this->usuario = $usuario;
            $this->contrasena = $contrasena;
        }

        
    }
?>