<?php
    include_once('IConsultor.php');

    class CuentaConsul implements IConsultor {
        private BaseDeDatos $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function getInstancia(array $id) {
            $consulta = "SELECT * 
                        FROM cuenta
                        WHERE id=?";
            $registros = $this->bd->sql($consulta, $id);

            if(empty($registros)) {
                throw new Exception('No hay cuenta registradas en la base de dato.');
            }

            $cuentas = [];
            for($i=0; $i<count($registros); $i++) {
                $cuenta = $registros[$i];

                $id = $cuenta['id'];
                $nombre = $cuenta['nombre'];
                $banco = $cuenta['banco'];
                $ct = new Cuenta($id, $nombre, $banco);
            
                $cuentas[] = $ct;
            }

            return $cuentas;
        }

        public function getTodos() {
            $consulta = "SELECT * 
                        FROM cuenta";
            $registros = $this->bd->sql($consulta, null);

            if(empty($registros)) {
                throw new Exception('No hay cuenta registradas en la base de dato.');
            }

            $cuentas = [];
            for($i=0; $i<count($registros); $i++) {
                $cuenta = $registros[$i];

                $id = $cuenta['id'];
                $nombre = $cuenta['nombre'];
                $banco = $cuenta['banco'];
                $ct = new Cuenta($id, $nombre, $banco);
            
                $cuentas[] = $ct;
            }

            return $cuentas;
        }
    }
?>