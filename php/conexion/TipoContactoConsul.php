<?php 
     include_once ('Iconsultor.php');
     include_once('../conexion/BaseDeDatos.php');
     include_once ('../Instancias/Motivo.php');

     class TipoContactoConsul implements IConsultor {
        private BaseDeDatos $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }


        public function getInstancia(array $id) {
            $consulta = "SELECT * 
                        FROM  tipo_contacto
                        WHERE id=?";
            $registros = $this->bd->sql($consulta, $id);

            if(empty($registros)) {
                throw new Exception('No existe tipo_contacto con dicho id');
            }

            $tipos= [];
            for($i=0; $i<count($registros); $i++) {
                $tipo = $registros[$i];

                $id = $tipo['id'];
                $descripcion = $tipo['descripcion'];
                
                $tip = new Motivo($id, $descripcion);

                $tipos[] = $tip;
            }
            
            return $tipos;
        }
        
        public function getTodos() {
            $consulta = "SELECT * 
                        FROM  tipo_contacto";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe ningun tipo contacto en la bd');
            }

            $tipos= [];
            for($i=0; $i<count($registros); $i++) {
                $tipo = $registros[$i];

                $id = $tipo['id'];
                $descripcion = $tipo['descripcion'];
                
                $tip = new Motivo($id, $descripcion);

                $tipos[] = $tip;
            }
            
            return $tipos;
        }

    }
?>