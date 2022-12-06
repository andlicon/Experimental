<?php 
    include_once(GENERADOR_PATH.'/GeneradorItems.php');
    include_once(DAO_PATH.'/EstudianteDAO.php');
    include_once(DAO_PATH.'/PersonaDAO.php');
    include_once(FUNCIONES_IG_PATH.'/options/GenerarOptionMotivo.php');


    //RESTIRCCIONES
    abstract class GeneradorInput extends GeneradorItems {
        public const TELEFONO = 0;
        public const CORREO = 1;
        public const MONTO = 2;

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
            $funcion = "";

            if($restriccion == GeneradorInput::TELEFONO) {
                //Función que solo permita números
            }
            else if($restriccion == GeneradorInput::CORREO) {
                //no sé xd
                $funcion = "return soloTelefono(event)";
            }
            else if($restriccion == GeneradorInput::MONTO) {
                //no sé xd
                $funcion = "return soloMonto(event)";
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
                $resultado = $personaDAO->getTodosRepresentantes();

                $select = '<div class="input__grupo">
                                <label for="representanteInput">Representante</label>
                                <select id="representanteInput" name="representanteInput">
                                    <option value=""></option>';

                for($i=0; $i<count($resultado); $i++) {
                    $persona = $resultado[$i];
                    $cedula = $persona->getCedula();
                    $nombre = $persona->getNombre();
                    $apellido = $persona->getApellido();

                    $select = $select.'
                                        <option value="'.$cedula.'" Class="input__select">
                                            '."$cedula - $nombre - $apellido".'
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

        protected function crearItemEstudiante() {
            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $estudianteDAO = new EstudianteDAO($bd);
                $resultado = $estudianteDAO->getTodos();

                $select = '<div class="input__grupo">
                                <label for="estudianteInput">estudiante</label>
                                <select id="estudianteInput" name="estudianteInput">
                                    <option value=""></option>';

                for($i=0; $i<count($resultado); $i++) {
                    $estudiante = $resultado[$i];
                    $idEstudiante = $estudiante->getId();
                    $nombre = $estudiante->getNombre();
                    $apellido = $estudiante->getApellido();
                    $fechaNacimiento = $estudiante->getFechaNacimiento();
                    $cedula = $estudiante->getCedulaRepresentante();

                    $idClase = $estudiante->getIdClase();
                    $claseConsul = new ClaseConsul($bd);
                    $clasesArray = $claseConsul->getInstancia(array($idClase));
                    $clase = $clasesArray[0];
                    $claseDescripcion = $clase->getDescripcion();


                    $select = $select.'
                                        <option value="'.$idEstudiante.'" Class="input__select">
                                            '."$nombre - $apellido - $fechaNacimiento - $claseDescripcion".'
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

        protected function crearItemMotivo() {
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $motivoConsul = new MotivoConsul($bd);

            $generador = new GenerarOptionMotivo($motivoConsul);
            return $generador->generar("motivoInput", "Motivo deuda");
        }
        
    }
?>