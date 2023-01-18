<?php 
        include_once('CreadorBoton.php');
        include_once('../rutaAcciones.php');
        include_once(DAO_PATH.'BaseDeDatos.php');

    final class CrearBotonDeuda extends CreadorBoton {
        private $cedula; 

        public function __construct($idTipoPermiso, $cedula) {
            parent::__construct($idTipoPermiso);

            $this->cedula = $cedula;
        }

        public function crearBotones() {
            $botones = '<h2 class="botones__titulo">Consultar</h2>';
            
            if($this->permiso==4) {  //ADMINISTRADOR
                $botones = $botones.$this->crearItemConsulta();
            }
            else if($this->permiso==1 || $this->permiso==2) {  //REPRESENTANTE
                $botones = $botones.$this->crearItemConsultaEstudiante();
            }

            echo $botones;
        }

        protected function crearItemConsulta() {
            $item = 
            '<div class="input__grupo">';
            $item = $item.
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
                '</select>
                <label for="tipoDeudaInput">Tipio Deuda</label>
                <select class="input__select consultor" id="tipoDeudaInput">
                    <option value="todas">todas</option>
                    <option value="saldadas">saldadas</option>
                    <option value="vigentes">vigentes</option>
                </select>
            </div>';
            return $item;
        }

        protected function crearItemConsultaEstudiante() {
            $item = 
            '<div class="input__grupo">';
            $item = $item.
                '
                <label for="estudianteInput" class="input__label">Estudiante(s)</label>
                <select class="input__select consultor" id="estudianteInput" name="estudianteInput">
                    <option value="todos">todos</option>';

                    $conn = new PDO("mysql:host=127.0.0.1:3306;dbname=Experimental", "root", "");
                    $consulta =  "SELECT *
                                  FROM estudiante
                                  WHERE cedula_representante=?";
                    $resultado = $conn->prepare($consulta);
                    $resultado->execute(array($this->cedula));
                    $registros = $resultado->fetchAll();

                    for($i=0; $i<count($registros); $i++) {
                        $estudiante = $registros[$i];
                        $idEstudiante = $estudiante['id'];
                        $nombre = $estudiante['nombre'];
                        $apellido = $estudiante['apellido'];

                        $item = $item."<option value=\"$idEstudiante\">$nombre - $apellido</option>";

                    }

            $item = $item.
                '</select>
            </div>';
            return $item;
        }

    }
?>