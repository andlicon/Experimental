<?php 
    include_once(GENERADOR_PATH.'input/GeneradorInput.php');
    include_once(OPTIONS_IG_PATH.'/GenerarOptionCuenta.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/MotivoConsul.php');

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
                $inputs = $inputs.$this->crearItemDeuda();
                $inputs = $inputs.$this->crearItem("referenciaInput", "Referencia");
            }

            echo $inputs;
        }

        protected function crearItemDeuda() {
            try {
                $usuario = deserializarUsuario();
                $cedula = $usuario->getCedula();

                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $estudianteDAO = new EstudianteDAO($bd);
                $motivoConsul = new MotivoConsul($bd);

                $deudaDAO = new DeudaDAO($bd);
                $resultado = $deudaDAO->getInstanciaCedula(array($cedula));

                $select = '<div class="input__grupo">
                                <label for="deudaInput">deuda</label>
                                <select id="deudaInput" name="deudaInput">
                                    <option value=""></option>';

                for($i=0; $i<count($resultado); $i++) {
                    $deuda = $resultado[$i];
                    $idEstudiante = $deuda->getIdEstudiante();
                    $idMotivo = $deuda->getIdMotivo();
                    $fecha = $deuda->getFecha();
                    $debe = $deuda->getDeuda();

                    //estudiante
                    $estudiante = $estudianteDAO->getInstancia(array($idEstudiante));
                    $nombreEstudiante = $estudiante[0]->getNombre();

                    //motivo
                    $motivo = $motivoConsul->getInstancia(array($idMotivo));
                    $motivo = $motivo[0]->getDescripcion();

                    $select = $select.'
                                        <option value="'.$idEstudiante.'" Class="input__select">
                                            '."$nombreEstudiante   - $motivo - fecha: $fecha - Deuda: $debe".'
                                        </option>';
                }

                $select = $select.'</select>
                            </div>';
            }
            catch(Exception $e) {
                echo $e;
            }

            return $select;
        }

    }
?>