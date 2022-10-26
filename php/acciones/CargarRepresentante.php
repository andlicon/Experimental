<?php
    include_once('ICargar.php');

    class CargarRepresentante implements ICargar {
        private $personaDAO;
        private $contactoDAO;
        private $representanteModif;

        public function __construct($personaDAO, $contactoDAO, $representanteModif) {
            $this->personaDAO = $personaDAO;
            $this->contactoDAO = $contactoDAO;
            $this->representanteModif = $representanteModif;
        }

        public function cargar($matriz) {
            $this->personaDAO->cargar($matriz[0]);

            $this->contactoDAO->cargar($matriz[1]);

            $contactoTlf= $matriz[2];
            if(!$contactoTlf[2]=="") { //De haber anadido un numero telefonico, se crea un renglon en la bd
                $this->contactoDAO->cargar($matriz[2]);
            }

            $this->representanteModif->cargar($matriz[3]);
        }
    }
?>