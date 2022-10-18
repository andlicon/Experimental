<?php
    include_once('../instancias/Usuario.php');
    include_once('IDAO.php');
    include_once('BaseDeDatos.php');

    /*
        Implementación de la interfaz Data Access Object para el caso particular de 
        las instancias "usuario"
    */
    class UsuarioDAO implements IDAO {
        private BaseDeDatos $bd;
        /*
            Constructor, crea un acceso a la base de dato.
        */
        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
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
            $registro = $this->bd->consultar($consulta, $nombre);
            
            if(!is_array($registro)) {
                throw new Exception('No existe combinación usuario/contrasena');
            }

            $nombre = $registro['nombre'];
            $contrasena = $registro['contrasena'];
            return $usuario = new Usuario($nombre, $contrasena);
        }
    }
?>