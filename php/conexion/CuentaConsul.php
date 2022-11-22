<?php
    include_once('IConsultor.php');
    include_once('../instancias/Cuenta.php');

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
                $descripcion = $cuenta['descripcion'];
                $banco = $cuenta['banco'];
                $rif = $cuenta['rif'];
                $ct = new Cuenta($id, $descripcion, $banco, $rif);
            
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
                $descripcion = $cuenta['descripcion'];
                $banco = $cuenta['banco'];
                $rif = $cuenta['rif'];
                $ct = new Cuenta($id, $descripcion, $banco, $rif);
            
                $cuentas[] = $ct;
            }

            return $cuentas;
        }
    }
?>