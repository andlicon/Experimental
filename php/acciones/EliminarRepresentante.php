<?php
    include_once('IEliminar.php');

    class EliminarRepresentante implements IEliminar {
        private $personaDAO;
        private $contactoDAO;
        private $representanteModif;

        public function __construct(PersonaDAO $personaDAO, 
                                    ContactoDAO $contactoDAO, 
                                    RepresentanteModif $representanteModif) {
            $this->personaDAO = $personaDAO;
            $this->contactoDAO = $contactoDAO;
            $this->representanteModif = $representanteModif;
        }

        public function eliminar($matriz) {
            $cantidadContacto = $this->contactoDAO->cantidadContactos($matriz[1]);

            if( $cantidadContacto > 1 ) {   //Solo se elimina el contacto.
                
                $this->contactoDAO->eliminar($matriz[0]);
            }
            else {                          //Se elimina toda informacion
                $this->contactoDAO->eliminar($matriz[0]);

                $this->representanteModif->eliminar($matriz[1]);
       
                $this->personaDAO->eliminar($matriz[1]);
            }
        }
    }
?>