<?php 
    include_once('CreadorBoton.php');

    final class CrearBotonEstudiante extends CreadorBoton {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function crearBotones() {
            $botones = '';
            if($this->permiso==4 || $this->permiso==5) {
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
                                        </script>';
                $botones = $botones.'</div>';
            }

            return $botones;
        }

        protected function crearItemValidez() {
            $item = 
            '<div class="input__grupo">';
            $item = $item.
                '
                <label for="validezInput" class="input__label">Estado registro</label>
                <select class="input__select consultor" id="validezInput" name="validezInput">
                    <option value="todas">Todos</option>
                    <option value="1">Confirmado</option>
                    <option value="0">Por confirmar</option>';
            $item = $item.
                '</select>
            </div>';
            return $item;
        }
    }
?>