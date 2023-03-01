<?php 
    include_once('../rutaAcciones.php');
    include_once('CreadorBoton.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/TipoPersonaConsul.php');

    final class CrearBotonUsuarios extends CreadorBoton {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function crearBotones() {
            $botones = "";
            $botones = $botones.'<h2 class="botones__titulo">Consultar</h2>';
            $botones = $botones."<div class=\"input__grupo\">";
            if($this->permiso==4 || $this->permiso==5) {  //ADMINISTRADOR y SECRETARIO
                $botones = $botones.$this->crearItemConsultaTipoUsuario();
                $botones = $botones.$this->itemConsultaRepresentante();
                $botones = $botones.$this->itemFecha();
                $botones = $botones.'
                                        <script>
                                            $(document).ready(function () {
                                                $("#representanteInput").select2();
                                            });
                                        </script>';
            }
            $botones = $botones.'</div>';

            return $botones;
        }

        protected function crearItemConsultaTipoUsuario() {
            $item = 
            '<div class="input__grupo">';
            $item = $item.
                '
                <label for="tipoUsuarioInput" class="input__label">Validez</label>
                <select class="input__select consultor" id="tipoUsuarioInput" name="tipoUsuarioInput">
                    <option value="todos">Todos</option>
                    <option value="validos">Confirmado</option>;
                    <option value="invalidos">Por confirmar</option>';
            $item = $item.
                '</select>
            </div>';
            return $item;
        }

        protected function crearItemConsultaTipoPersona() {
            $item = 
            '<div class="input__grupo">';
            $item = $item.
                '
                <label for="tipoPersonaInput" class="input__label">Tipo Usuario</label>
                <select class="input__select consultor" id="tipoPersonaInput" name="tipoPersonaInput">
                    <option value="todos">Todos</option>';

            $dao = new TipoPersonaConsul(BaseDeDatos::getInstancia());
            $registros = $dao->getTodos();

            for($i=0; $i<count($registros); $i++) {
                $tipoPersona = $registros[$i];
                $id = $tipoPersona->getId();
                $descripcion = $tipoPersona->getDescripcion();
                
                $item = $item."<option value=\"$id\">$descripcion</option>";
            }

            $item = $item.
                '</select>
            </div>';
            return $item;
        }
    }
?>