<?php
    include_once(__DIR__.'/../../../rutaAcciones.php');
    include_once(DAO_PATH.'/PersonaDAO.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once('CreadorSelect.php');

    class CreadorSelectProfesor extends CreadorSelect {
        
        public function __construct() {
            parent::__construct(new PersonaDAO(BaseDeDatos::getInstancia()));
        }


        protected function crearOption($profesores, $seleccion) {
            $options = "";

            for($i=0; $i<count($profesores); $i++) {
                $profesor = $profesores[$i];
                $cedula = $profesor->getCedula();
                $nombre = $profesor->getNombre();
                $apellido = $profesor->getApellido();

                $seleccionado = $seleccion==$cedula ? "selected" : "";

                $options = $options."
                    <option value=\"$cedula\" $seleccionado>
                        $cedula -
                        $nombre - 
                        $apellido
                    </option>";
            }

            return $options;
        }

        public function crearItemAtributosSeleccion($atributos, $id, $seleccion) {
            $html = "";
            try {
                $profesores = $this->dao->getTodosProfesores();

                $html = "<div class=\"input__grupo\">
                            <select $atributos id=\"$id\" name=\"profe\">";
                $html = $html.$this->crearOption($profesores, $seleccion);
                $html = $html."
                            </select>
                        </div>";
            }catch(Exception $e) {
                $html="
                    <select>
                        <option>No existe profesor registrado.</option>
                    </select>";
            }finally {
                return $html;
            }
        }

    }

?>