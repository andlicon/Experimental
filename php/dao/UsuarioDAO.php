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
        public function getInstancia(array $cedula) {
            $consulta = "SELECT * 
                        FROM usuario
                        WHERE cedula=?";
            $registros = $this->bd->sql($consulta, $cedula);

            if(!is_array($registros)) {
                throw new Exception('No existe usuario con dicha cedula');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $us = new Usuario($cedula, $nickname, $contrasena, $valido);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function getInstanciaValidez(array $valido) {
            $consulta = "SELECT * 
                        FROM usuario
                        WHERE valido=?";
            $registros = $this->bd->sql($consulta, $valido);

            if(!is_array($registros)) {
                throw new Exception('No existe usuario valido');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $us = new Usuario($cedula, $nickname, $contrasena, $valido);

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
                throw new Exception('No existe usuario con dicho nickname.');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $us = new Usuario($cedula, $nickname, $contrasena, $valido);

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

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $idTipoUsuario = $registro['id_tipo_usuario'];
                $us = new Usuario($cedula, $nickname, $contrasena, $idTipoUsuario);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function cargar($parametros) {
            try {
                $cargar= "CALL  p_cargar_usuario(?, ?, ?)";
                $registros = $this->bd->sql($cargar, $parametros);
            }
            catch(PDOException $e) {
                throw new DaoException(DaoException::USUARIO, DaoException::CARGAR, "ya existe un usuario con dicho nickname.");
            }
        }

        public function modificar($parametros) {

        }

        public function eliminar($parametros) {
            
        }
    }
?>