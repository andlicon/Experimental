<?php
    include_once('IConsultor.php');
    include_once(DTO_PATH.'/TipoPago.php');

    class TipoPagoConsul implements IConsultor {
        private BaseDeDatos $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function getInstancia(array $id) {
            $consulta = "SELECT * 
                        FROM tipo_pago
                        WHERE id=?";
            $registros = $this->bd->sql($consulta, $id);

            if(empty($registros)) {
                throw new Exception('No hay tipo cuenta registradas en la base de dato.');
            }

            $tiposCuentas = [];
            for($i=0; $i<count($registros); $i++) {
                $tipoCuenta = $registros[$i];

                $id = $tipoCuenta['id'];
                $descripcion= $tipoCuenta['descripcion'];
                $tp = new TipoPago($id, $descripcion);
            
                $tiposCuentas[] = $tp;
            }

            return $tiposCuentas;
        }

        public function getTodos() {
            $consulta = "SELECT * 
                        FROM tipo_pago";
            $registros = $this->bd->sql($consulta, null);

            if(empty($registros)) {
                throw new Exception('No hay tipo cuenta registradas en la base de dato.');
            }

            $tiposCuentas = [];
            for($i=0; $i<count($registros); $i++) {
                $tipoCuenta = $registros[$i];

                $id = $tipoCuenta['id'];
                $descripcion= $tipoCuenta['descripcion'];
                $tp = new TipoPago($id, $descripcion);
            
                $tiposCuentas[] = $tp;
            }

            return $tiposCuentas;
        }
    }
?>