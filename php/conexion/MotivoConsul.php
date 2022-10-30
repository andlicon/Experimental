<?php
    include_once('IConsultor.php');
    include_once('../instancias/Motivo.php');

    class MotivoConsul implements IConsultor {
        private BaseDeDatos $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function getInstancia(array $id) {
            $consulta = "SELECT * 
                        FROM motivo_deuda
                        WHERE id=?";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No hay motivos registradas en la base de dato.');
            }

            $motivos = [];
            for($i=0; $i<count($registros); $i++) {
                $motivo = $registros[$i];

                $id = $motivo['id'];
                $descripcion = $motivo['descripcion'];
                $mtv = new Motivo($id, $descripcion);
            
                $motivos[] = $mtv;
            }

            return $motivos;
        }

        public function getTodos() {
            $consulta = "SELECT * 
                        FROM motivo_deuda";
            $registros = $this->bd->sql($consulta, null);

            if(empty($registros)) {
                throw new Exception('No hay motivos registradas en la base de dato.');
            }

            $motivos = [];
            for($i=0; $i<count($registros); $i++) {
                $motivo = $registros[$i];

                $id = $motivo['id'];
                $descripcion = $motivo['descripcion'];
                $mtv = new Motivo($id, $descripcion);
            
                $motivos[] = $mtv;
            }

            return $motivos;
        }
    }
?>