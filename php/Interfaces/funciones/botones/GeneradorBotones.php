<?php
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/TipoPersonaConsul.php');

    abstract class GeneradorBotones {
        private $idTipoPermiso;

        public function __construct($idTipoPermiso) {
            $this->idTipoPermiso = $idTipoPermiso;
        }

        public abstract function generarBotones();

        protected final function getPermiso() {
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $tipoPersonaConsul = new TipoPersonaConsul($bd); 
            
            $resultados = $tipoPersonaConsul->getInstancia(array($this->idTipoPermiso));
            $tipoPersona = $resultados[0];
            $permiso = $tipoPersona->getPermiso();

            return $permiso;
        }

        protected function crearBoton($name, $texto) {
            return
            '<button class="boton" name="'.$name.'">
                        <span class="boton__span">'.
                            $texto
                        .'</span>
            </button>';
        }

    }
?>
