<?php 
    include_once(GENERADOR_PATH.'input/GeneradorInput.php');
    include_once(OPTIONS_IG_PATH.'/GenerarOptionCuenta.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/CuentaConsul.php');

    final class GeneradorInputPago extends GeneradorInput {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function generarItems() {
            $permiso = parent::getPermiso();

            $inputs = "";
            if($permiso==3 || $permiso==1) {  //representantes
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $consultor = new CuentaConsul($bd);
                $generador = new GenerarOptionCuenta($consultor);

                $inputs = $inputs.'<h3>Información Pago</h3>';
                $inputs = $inputs.$this->crearItemDeuda();
                $inputs = $inputs.$this->crearItemTipo("fechaInput", "Fecha", "date");
                $inputs = $inputs.$this->crearItemRestriccion("montoInput", "Monto", GeneradorInput::MONTO);
                $inputs = $inputs.$generador->generar("cuentaInput", "Cuenta");
                //monto
                //cuenta
                //tipo pago
                //referencia
                $inputs = $inputs.$this->crearItemRepresentante();
            }

            echo $inputs;
        }

        public function crearItemDeuda() {

        }

    }
?>