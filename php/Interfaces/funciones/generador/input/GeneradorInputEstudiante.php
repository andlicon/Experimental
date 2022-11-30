<?php 
    include_once(GENERADOR_IG_PATH.'input/GeneradorInput.php');
    include_once(OPTIONS_IG_PATH.'/GenerarOptionClase.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/TipoClaseConsul.php');

    final class GeneradorInputEstudiante extends GeneradorInput {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function generarItems() {
            $permiso = parent::getPermiso();

            $inputs = "";
            if($permiso!=2) {       //PROFESOR
                if($permiso==4) {  //ADMINISTRADOR


                    $inputs = $inputs.$this->crearItem("nombreInput", "Nombre");
                    $inputs = $inputs.$this->crearItem("apellidoInput", "Apellido");
                    $inputs = $inputs.$this->crearItemTipo("fechaInput", "Fecha nacimiento", "date");
                }
                else {                  //REPRESENTANTE y REPRESENTANTE-PROFESOR
                    $inputs = $inputs.$this->crearItem("consultar-rep", "consultar");
                }
            }

            echo $inputs;
        }

    }
?>