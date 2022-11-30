<?php
    abstract class GeneradorBotones {
        private $idTipoPermiso;
        private $dao;

        public function __construct($idTipoPermiso, TipoPersonaConsul $dao) {
            $this->idTipoPermiso = $idTipoPermiso;
            $this->dao = $dao;
        }

        public abstract function generarBotones();

        public function getPermiso() {
            $tipoPersonaConsul = new TipoPersonaConsul($bd); 
            
            $resultados = $tipoPersonaConsul->getInstancia(array($id));
            $tipoPersona = $resultados[0];
            $permiso = $tipoPersona->getPermiso();
        }

        public function crearBoton($name, $texto) {
            echo 
            '<button class="boton" name="'.$name.'">
                        <span class="boton__span">'.
                            $texto
                        .'</span>
            </button>';
        }

    }

    /*
        Función abstracta donde se implemente la lógica (debe retornar un String y
        recibir un id tipo_persona)

        Función implementada donde se extraiga el idPermiso basado en el id tipo_persona

        Función implementada donde se genere el botón (se puede sobre-escribir)
    */
?>
