<?php 
    include_once(GENERADOR_PATH.'input/GeneradorInput.php');
    include_once(OPTIONS_IG_PATH.'/GenerarOptionClase.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/ClaseConsul.php');

    final class GeneradorInputDeuda extends GeneradorInput {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function generarItems() {
            $permiso = parent::getPermiso();

            $inputs = "";
            if($permiso==4) {  //ADMINISTRADOR
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $consultor = new ClaseConsul($bd);
                $generador = new GenerarOptionClase($consultor);

                $inputs = $inputs.'<h3>Información estudiante</h3>';
                $inputs = $inputs.$this->crearItemEstudiante();
                $inputs = $inputs.$this->crearItemMotivo();
                $inputs = $inputs.$this->crearItem("descripcionInput", "Descripcion");
                $inputs = $inputs.$this->crearItemTipo("fechaInput", "Fecha deuda", "date");
                $inputs = $inputs.$this->crearItemRestriccion("montoInicialInput", "Monto Inicial", GeneradorInput::MONTO);
            }

            echo $inputs;
        }

    }
?>