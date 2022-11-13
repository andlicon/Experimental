<?php 
     include_once ('Iconsultor.php');
     include_once('../conexion/BaseDeDatos.php');
     include_once('../instancias/TipoUsuario.php');

     class TipoUsuarioConsul implements IConsultor {
        private BaseDeDatos $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }


        public function getInstancia(array $id) {
            $consulta = "SELECT * 
                        FROM  tipo_usuario
                        WHERE id=?";
            $registros = $this->bd->sql($consulta, $id);

            if(empty($registros)) {
                throw new Exception('No existe tipo_usuario con dicho id');
            }

            $tipos= [];
            for($i=0; $i<count($registros); $i++) {
                $tipo = $registros[$i];

                $id = $tipo['id'];
                $nombre = $tipo['nombre'];
                $permiso = $tipo['permisos'];

                $tip = new TipoUsuario($id, $nombre, $permiso);
                $tipos[] = $tip;
            }
            
            return $tipos;
        }
        
        public function getTodos() {
            $consulta = "SELECT * 
                        FROM  tipo_usuario";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe ningun tipo_usuario en la bd');
            }

            $tipos= [];
            for($i=0; $i<count($registros); $i++) {
                $tipo = $registros[$i];

                $id = $tipo['id'];
                $nombre = $tipo['nombre'];
                $permiso = $tipo['permisos'];

                $tip = new TipoUsuario($id, $nombre, $permiso);
                $tipos[] = $tip;
            }
            
            return $tipos;
        }

    }
?>