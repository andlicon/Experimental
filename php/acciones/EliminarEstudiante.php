<?php
    include_once('IEliminar.php');

    class EliminarEstudiante implements IEliminar {
        private $estudianteDAO;

        public function __construct(EstudianteDAO $estudianteDAO) {
            $this->estudianteDAO = $estudianteDAO;
        }

        public function eliminar($idEstudiante) {
            $this->estudianteDAO->eliminar($idEstudiante);
        }
    }
?>