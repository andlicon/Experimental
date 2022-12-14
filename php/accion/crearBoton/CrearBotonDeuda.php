<?php 
        include_once('CreadorBoton.php');
        include_once('../../dao/BaseDeDatos.php');

    final class CrearBotonDeuda extends CreadorBoton {
        private $cedula; 

        public function __construct($idTipoPermiso, $cedula) {
            parent::__construct($idTipoPermiso);

            $this->cedula = $cedula;
        }

        public function crearBotones() {
            $botones = '<h2 class="botones__titulo">Acciones</h2>';
            
            if($this->permiso==4) {  //ADMINISTRADOR
                $botones = $botones.$this->crearItemConsulta();
                $botones = $botones.$this->crearItem("modificar", "modificar");
                $botones = $botones.$this->crearItem("eliminar", "eliminar");
                $botones = $botones.$this->crearItem("cargar", "cargar");
            }
            else if($this->permiso==1 || $this->permiso==2) {  //ADMINISTRADOR
                $botones = $botones.$this->crearItemConsultaEstudiante();
            }

            echo $botones;
        }

        protected function crearItemConsulta() {
            $item = 
            '<div class="input__grupo">';
            $item = $item.$this->crearItem("consultar", "Consultar");;
            $item = $item.
                '
                <label for="representanteInput" class="input__label">Representante(s)</label>
                <select class="input__select" id="representanteInput" name="representanteInput">
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
            </div>';
            return $item;
        }

        protected function crearItemConsultaEstudiante() {
            $item = 
            '<div class="input__grupo">';
            $item = $item.$this->crearItem("consultar-rep", "Consultar");;
            $item = $item.
                '
                <label for="estudianteInput" class="input__label">Estudiante(s)</label>
                <select class="input__select" id="estudianteInput" name="estudianteInput">
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