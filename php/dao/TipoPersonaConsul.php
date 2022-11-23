<?php 
     include_once ('Iconsultor.php');
     include_once(DTO_PATH.'/TipoPersona.php');

     class TipoPersonaConsul implements IConsultor {
        private BaseDeDatos $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }


        public function getInstancia(array $id) {
            $consulta = "SELECT * 
                        FROM  tipo_persona
                        WHERE id=?";
            $registros = $this->bd->sql($consulta, $id);

            if(empty($registros)) {
                throw new Exception('No existe tipo_persona con dicho id');
            }

            $tipos= [];
            for($i=0; $i<count($registros); $i++) {
                $tipo = $registros[$i];

                $id = $tipo['id'];
                $descripcion = $tipo['descripcion'];
                $permiso = $tipo['permisos'];

                $tip = new TipoPersona($id, $nombre, $permiso);
                $tipos[] = $tip;
            }
            
            return $tipos;
        }
        
        public function getTodos() {
            $consulta = "SELECT * 
                        FROM  tipo_persona";
            $registros = $this->bd->sql($consulta, null);

            if(empty($registros)) {
                throw new Exception('No existe tipo_persona con dicho id');
            }

            $tipos= [];
            for($i=0; $i<count($registros); $i++) {
                $tipo = $registros[$i];

                $id = $tipo['id'];
                $descripcion = $tipo['descripcion'];
                $permiso = $tipo['permisos'];

                $tip = new TipoPersona($id, $nombre, $permiso);
                $tipos[] = $tip;
            }
            
            return $tipos;
        }

    }
?>