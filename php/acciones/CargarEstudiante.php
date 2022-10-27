<?php
    include_once('ICargar.php');
    include_once('../instancias/Representante.php');

    class CargarEstudiante implements ICargar {
        private $estudianteDAO;
        private $representanteConsul;

        public function __construct($estudianteDAO, $representanteConsul) {
            $this->estudianteDAO = $estudianteDAO;
            $this->representanteConsul = $representanteConsul;
        }

        public function cargar($matriz) {
            $representantes = $this->representanteConsul->getInstancia($matriz[0]);

            if(!empty($representantes)) {
                $rep = $representantes[0];

                $idRep = $rep->getId();

                $arregloEstudiante = $matriz[1];
                
                array_push($arregloEstudiante, $idRep);

                $this->estudianteDAO->cargar($arregloEstudiante);
            }
        }
    }
?>