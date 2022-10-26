<?php
    include_once('IConsultor.php');

    class ClaseDAO implements IConsultor {
        private BaseDeDatos $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function getInstancia(array $id) {
            $consulta = "SELECT * 
                        FROM clase
                        WHERE id=?";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No hay clases registradas en la base de dato.');
            }

            $clases = [];
            for($i=0; $i<count($registros); $i++) {
                $clase = $registros[$i];

                $id = $clase['id'];
                $descripcion = $clase['descripcion'];
                $salon = $clase['salon'];
                $cedulaProfe = $clase['cedula_profe'];
                $cls = new Clase($id, $descripcion, $salon, $cedulaProfe);
            
                $clases[] = $cls;
            }

            return $clases;
        }

        public function getTodos() {
            $consulta = "SELECT * 
                        FROM clase";
            $registros = $this->bd->sql($consulta, null);

            if(empty($registros)) {
                throw new Exception('No hay clases registradas en la base de dato.');
            }

            $clases = [];
            for($i=0; $i<count($registros); $i++) {
                $clase = $registros[$i];

                $id = $clase['id'];
                $descripcion = $clase['descripcion'];
                $salon = $clase['salon'];
                $cedulaProfe = $clase['cedula_profe'];
                $cls = new Clase($id, $descripcion, $salon, $cedulaProfe);
            
                $clases[] = $cls;
            }

            return $clases;
        }
    }
?>