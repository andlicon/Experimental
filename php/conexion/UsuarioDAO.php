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
                        FROM v_usuarios
                        WHERE usuario=?";
            $registro = $this->bd->sql($consulta, $nombre);

            if(!is_array($registro)) {
                throw new Exception('No existe combinación usuario/contrasena');
            }
            
            $usuario = null;
            if($registro) {
                $registro = $registro[0];
                $usuario = $registro['usuario'];
                $contrasena = $registro['contrasena'];
                $usuario = new Usuario($usuario, $contrasena, '', '');
            }

            return $usuario;
        }

        /*
            Retorna a todos los usuarios existentes dentro de la base de datos
        */
        public function getTodos() {
            $consulta = "SELECT * 
                         FROM v_usuarios";
             $registros = $this->bd->sql($consulta, null);

             if(empty($registros)) {
                throw new Exception('No existen registros de Representante');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $usuario = $registro['usuario'];
                $contrasena = $registro['contrasena'];
                $tipoUsuario = $registro['tipo'];
                $permiso = $registro['permiso'];
                $us = new Usuario($usuario, $contrasena, $tipoUsuario, $permiso);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function cargar($parametros) {

        }

        public function modificar($parametros) {

        }

        public function eliminar($parametros) {
            
        }
    }
?>