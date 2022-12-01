<?php 
    include_once(GENERADOR_IG_PATH.'input/GeneradorInput.php');
    include_once(OPTIONS_IG_PATH.'/GenerarOptionClase.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/ClaseConsul.php');

    final class GeneradorInputProfesor extends GeneradorInput {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function generarItems() {
            $permiso = parent::getPermiso();

            $inputs = "";
            if($permiso!=2) {       //PROFESOR
                if($permiso==4) {  //ADMINISTRADOR
                    $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                    $consultor = new ClaseConsul($bd);
                    $generador = new GenerarOptionClase($consultor);

                    $inputs = $inputs.'<h3>Información profesor</h3>';
                    $inputs = $inputs.$this->crearItemCedula("Cedula representante");
                    $inputs = $inputs.$this->crearItem("nombreInput", "Nombre");
                    $inputs = $inputs.$this->crearItem("apellidoInput", "Apellido");
                    $inputs = $inputs.$this->crearItemRestriccion("correoInput", "Correo", GeneradorInput::CORREO);
                    $inputs = $inputs.$this->crearItemRestriccion("telefonoInput", "Telefono", GeneradorInput::TELEFONO);
                }
                else {                  //REPRESENTANTE y REPRESENTANTE-PROFESOR
                    $inputs = $inputs.$this->crearItem("consultar-rep", "consultar");
                }
            }

            echo $inputs;
        }

    }
?>