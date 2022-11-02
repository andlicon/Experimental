<?php
    include_once('IEliminar.php');

    class EliminarPersona implements IEliminar {
        private $personaDAO;
        private $contactoDAO;

        public function __construct(
                                        PersonaDAO $personaDAO, 
                                        ContactoDAO $contactoDAO
                                    ) {
            $this->personaDAO = $personaDAO;
            $this->contactoDAO = $contactoDAO;
        }

        public function eliminar($matriz) {
            $cantidadContacto = $this->contactoDAO->cantidadContactos($matriz[1]);

            if( $cantidadContacto > 1 ) {   //Solo se elimina el contacto.
                
                $this->contactoDAO->eliminar($matriz[0]);
            }
            else {                          //Se elimina toda informacion
                $this->contactoDAO->eliminar($matriz[0]);
       
                $this->personaDAO->eliminar($matriz[1]);
            }
        }
    }
?>