<?php 
    include_once(FUNCIONES_IG_PATH.'generador/GeneradorItems.php');
    //RESTIRCCIONES
    abstract class GeneradorInput extends GeneradorItems {
        public const TELEFONO = 0;
        public const CORREO = 1;

        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        //Por defecto crea tipo texto
        protected function crearItem($name, $texto) {
            return '
            <div class="input__grupo">
                    <label for="'.$name.'" class="input__label">'.$texto.'</label>
                    <input type="text" id="'.$name.'" name="'.$name.'" class="input__input input__input--texto">
            </div>';
        }

        protected function crearItemTipo($name, $texto, $tipo) {
            return '
            <div class="input__grupo">
                    <label for="'.$name.'" class="input__label">'.$texto.'</label>
                    <input type="'.$tipo.'" id="'.$name.'" name="'.$name.'" class="input__input input__input--texto">
            </div>';
        }

        protected function crearItemCedula() {
            return '
            <div class="input__grupo">
                <label for="nacionalidadInput" class="input__label">Nacionalidad</label>
                <select name="nacionalidadInput" id="nacionalidadInput" class="input__select">
                    <option value="V-" class="input__select">V-</option>
                    <option value="E-" class="input__select">E-</option>
                </select>
                <label for="cedulaInput" class="input__label">Cedula</label>
                <input type="text" id="cedulaInput" name="cedulaInput" class="input__input input__input--texto" onKeypress="">     <!-- aca poner la funcionde solo numeros --!>
            </div>';
        }

        protected function crearItemRestriccion($name, $texto, $restriccion) {

            if (!$this->restriccionValida($restriccion)) {
                return "";
            }

            $funcion = "";

            if($restriccion == GeneradorInput::TELEFONO) {
                //Función que solo permita números
            }
            else if($restriccion == GeneradorInput::CORREO) {
                //no sé xd
            }
           
            return '
            <div class="input__grupo">
                    <label for="'.$name.'" class="input__label">'.$texto.'</label>
                    <input type="text" id="'.$name.'" name="'.$name.'" class="input__input input__input--texto" onKeypress="'.$funcion.'">
            </div>';
        }

        private function restriccionValida($restriccion) {
            return $restriccion > GeneradorInput::TELEFONO && $restriccion<=GeneradorInput::CORREO;
        }

        protected function crearItemRepresentante() {
            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $personaDAO = new PersonaDAO($bd);
                $resultado = $personaDAO->getTodos();

                $select = '<div class="input__grupo">
                                <label for="representanteInput">Representante</label>
                                <select id="representanteInput">';

                for($i=0; $i<count($resultado); $i++) {
                    $persona = $resultado[$i];
                    $cedula = $persona->getCedula();
                    $nombre = $persona->getNombre();
                    $apellido = $persona->getApellido();

                    $select = $select.'
                                        <option value="'.$cedula.'">
                                            '."$cedula $nombre $apellido".'
                                        </option>';
                }

                $select = $select.'</select>
                            </div>';
            }
            catch(Exception $e) {
                echo $e;
            }

            return $select;
        }
        
    }
?>