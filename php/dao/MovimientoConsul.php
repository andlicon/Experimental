<?php
    include_once('IConsultor.php');
    include_once(DTO_PATH.'/Movimiento.php');

    class MovimientoConsul implements IConsultor {
        private BaseDeDatos $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function getInstancia(array $cedula) {
            $consulta = "SELECT * 
                        FROM v_movimientos
                        WHERE cedula=?";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No hay movimientos registradas en la base de dato.');
            }

            $movimientos = [];
            for($i=0; $i<count($registros); $i++) {
                $movimiento = $registros[$i];

                $id = $movimiento['id'];
                $fecha = $movimiento['fecha'];
                $monto = $movimiento['monto'];
                $descripcion = $movimiento['descripcion'];
                $mtv = new Movimiento($id, $fecha, $descripcion, $monto);
            
                $movimientos[] = $mtv;
            }

            return $movimientos;
        }

        public function getTodos() {
            $consulta = "SELECT * 
                        FROM v_movimientos";
            $registros = $this->bd->sql($consulta, null);

            if(empty($registros)) {
                throw new Exception('No hay movimientos registradas en la base de dato.');
            }

            $movimientos = [];
            for($i=0; $i<count($registros); $i++) {
                $movimiento = $registros[$i];

                $id = $movimiento['id'];
                $fecha = $movimiento['fecha'];
                $descripcion = $movimiento['descripcion'];
                $mtv = new Movimiento($id, $fecha, $descripcion, $monto);
            
                $movimientos[] = $mtv;
            }

            return $movimientoss;
        }
    }
?>