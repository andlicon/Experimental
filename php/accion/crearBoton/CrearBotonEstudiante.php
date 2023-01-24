<?php 
    include_once('CreadorBoton.php');

    final class CrearBotonEstudiante extends CreadorBoton {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function crearBotones() {
            $botones = '';
            if($this->permiso==4) {
                $botones = $botones.'<h2 class="botones__titulo">Consultar</h2>';
                $botones = $botones.'<div class="input__grupo">';
                $botones = $botones.$this->crearItemValidez();
                $botones = $botones.$this->itemConsultaRepresentante();
                $botones = $botones.$this->itemClase();
                $botones = $botones.'
                                        <script>
                                            $(document).ready(function () {
                                                $("#representanteInput").select2();
                                            });
                                        </script>
                                    </div>';
            }

            return $botones;
        }
    }
?>