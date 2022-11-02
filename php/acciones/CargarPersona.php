<?php
    include_once('ICargar.php');

    class CargarPersona implements ICargar {
        private $personaDAO;
        private $contactoDAO;

        public function __construct($personaDAO, $contactoDAO) {
            $this->personaDAO = $personaDAO;
            $this->contactoDAO = $contactoDAO;
        }

        public function cargar($matriz) {
            $arregloPersona = $matriz[0];
            $this->personaDAO->cargar($arregloPersona);

            $arregloContacto = $matriz[1];
            $this->contactoDAO->cargar($arregloContacto);

            $arregloTlf = $matriz[2];
            if(!$arregloTlf[2]=="") { //De haber anadido un numero telefonico, se crea un renglon en la bd
                $this->contactoDAO->cargar($arregloTlf);
            }
        }
    }
?>