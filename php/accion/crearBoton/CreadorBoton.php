<?php
    include_once(__DIR__.'/../rutaAcciones.php');
    include_once(DAO_PATH.'/ClaseConsul.php');
    include_once(DAO_PATH.'/PersonaDAO.php');

    abstract class CreadorBoton {
        protected $permiso;

        public function __construct($permiso) {
            $this->permiso = $permiso;
        }

        public abstract function crearBotones();

        protected function crearItem($name, $texto) {
            return
            '<input type="button" class="boton" value="'.$texto.'" id="'.$name.'">';
        }

        protected function crearItemConsulta() {
            $item = 
            '<div class="input__grupo">';
            $item = $item.$this->crearItem("consultar", "Consultar");;
            $item = $item.
                '
                <label for="tipoConsulta" class="input__label">Tipo consulta</label>
                <select class="input__select" id="tipoConsulta" name="tipoConsulta">
                    <option>todos</option>
                    <option>validos</option>
                    <option>invalidos</option>';
            $item = $item.
                '</select>
            </div>';
            return $item;
        }

        protected function crearItemValidez() {
            $item = 
            '<div class="input__grupo">';
            // $item = $item.$this->crearItem("validez", "Validar");
            $item = $item.
                '
                <label for="validezInput" class="input__label">Validez</label>
                <select class="input__select consultor" id="validezInput" name="validezInput">
                    <option value="todas">Todas</option>
                    <option value="1">Valido</option>
                    <option value="0">Invalido</option>';
            $item = $item.
                '</select>
            </div>';
            return $item;
        }

        protected function itemConsultaRepresentante() {
            $item = 
                '
                <label for="representanteInput" class="input__label">Representante(s)</label>
                <select class="input__select consultor" id="representanteInput" name="representanteInput">
                    <option value="todos">todos</option>';

                    $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                    $personaDAO = new PersonaDAO($bd);
                    $resultados = $personaDAO->getTodosRepresentantes();

                    for($i=0; $i<count($resultados); $i++) {
                        $rep = $resultados[$i];
                        $nombre = $rep->getNombre();
                        $apellido = $rep->getApellido();
                        $cedula = $rep->getCedula();

                        $item = $item."<option value=\"$cedula\">$cedula - $nombre - $apellido</option>";
                    }

            $item = $item.
                '</select>';

            return $item;
        }

        protected function itemConsultaProfesor() {
            $item = 
                '
                <label for="profesorInput" class="input__label">profesor(s)</label>
                <select class="input__select consultor" id="profesorInput" name="profesorInput">
                    <option value="todos">todos</option>';

                    $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                    $personaDAO = new PersonaDAO($bd);
                    $resultados = $personaDAO->getTodosProfesores();

                    for($i=0; $i<count($resultados); $i++) {
                        $rep = $resultados[$i];
                        $nombre = $rep->getNombre();
                        $apellido = $rep->getApellido();
                        $cedula = $rep->getCedula();

                        $item = $item."<option value=\"$cedula\">$cedula - $nombre - $apellido</option>";
                    }

            $item = $item.
                '</select>';

            return $item;
        }

        protected function itemDeuda() {
            return  
                "<label for=\"tipoDeudaInput\">Estado Deuda</label>
            <select class=\"input__select consultor\" id=\"tipoDeudaInput\">
                <option value=\"todas\">todas</option>
                <option value=\"saldadas\">saldadas</option>
                <option value=\"vigentes\">vigentes</option>
            </select>";
        }

        protected function itemClase() {
            $item = 
                '
                <label for="claseInput" class="input__label">Clase</label>
                <select class="input__select consultor" id="claseInput" name="claseInput">
                    <option value="todas">todas</option>';

                    $personaDAO = new ClaseConsul(BaseDeDatos::getInstancia());
                    $resultados = $personaDAO->getTodos();

                    for($i=0; $i<count($resultados); $i++) {
                        $rep = $resultados[$i];
                        $id = $rep->getId();
                        $descripcion = $rep->getDescripcion();
                        $salon = $rep->getSalon();

                        $item = $item."<option value=\"$id\">$descripcion - Salon: $salon</option>";
                    }

            $item = $item.
                '</select>';

            return $item;
        }

        protected function itemFecha() {
            $item = 
                '
                <label for="mesInput" class="input__label">Fecha</label>
                <input type="month" id="fechaConsul"/>';
            $item = $item.
                '</select>';

            return $item;
        }
    }
?>