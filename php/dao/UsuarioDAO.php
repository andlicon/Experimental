<?php
    include_once(DTO_PATH.'/Usuario.php');
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
        public function getInstancia(array $id) {
            $consulta = "SELECT * 
                        FROM usuario
                        WHERE id=?";
            $registros = $this->bd->sql($consulta, $id);

            if(!is_array($registros)) {
                throw new Exception('No existe combinación usuario/contrasena');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $id = $registro['id'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $idTipoUsuario = $registro['id_tipo_usuario'];
                $cedula = $registro['cedula'];
                $us = new Usuario($id, $nickname, $contrasena, $idTipoUsuario, $cedula);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function getInstanciaNickname(array $nickname) {
            $consulta = "SELECT * 
                        FROM usuario
                        WHERE nickname=?";
            $registros = $this->bd->sql($consulta, $nickname);

            if(!is_array($registros)) {
                throw new Exception('No existe combinación usuario/contrasena');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $id = $registro['id'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $idTipoUsuario = $registro['id_tipo_usuario'];
                $cedula = $registro['cedula'];
                $us = new Usuario($id, $nickname, $contrasena, $idTipoUsuario, $cedula);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        /*
            Retorna a todos los usuarios existentes dentro de la base de datos
        */
        public function getTodos() {
            $consulta = "SELECT * 
                         FROM usuario";
             $registros = $this->bd->sql($consulta, null);

             if(empty($registros)) {
                throw new Exception('No existen registros de Usuarios.');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $id = $registro['id'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $idTipoUsuario = $registro['id_tipo_usuario'];
                $cedula = $registro['cedula'];
                $us = new Usuario($id, $nickname, $contrasena, $idTipoUsuario, $cedula);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function cargar($parametros) {
            $cargar= "  INSERT INTO usuario (nickname, contrasena, cedula)
                        VALUES      (?, ?, ?)";
            $registros = $this->bd->sql($cargar, $parametros);
        }

        public function modificar($parametros) {

        }

        public function eliminar($parametros) {
            
        }
    }
?>