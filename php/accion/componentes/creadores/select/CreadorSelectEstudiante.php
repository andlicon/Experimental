<?php
    include_once(__DIR__.'/../../../rutaAcciones.php');
    include_once('CreadorSelect.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/EstudianteDAO.php');
    include_once(DAO_PATH.'/ClaseConsul.php');
    include_once('CreadorSelectClase.php');

    class CreadorSelectEstudiante extends CreadorSelect {
        
        public function __construct() {
            parent::__construct(new EstudianteDAO(BaseDeDatos::getInstancia()));
        }


        protected function crearOption($consulta, $seleccion) {
            $options = "<optgroup label=\"Grupos\">
                            <option value=\"todos\">Todos</option>";
            //Consulta a las clases
            $creadorSelectClase = new CreadorSelectClase();
            $claseConsul = new ClaseConsul(BaseDeDatos::getInstancia());
            $registros = $claseConsul->getTodos();
            $options = $options.$creadorSelectClase->crearOption($registros, null);
            
            $options = $options."</optgroup>
                        <optgroup label=\"Estudiantes\">";


            for($i=0; $i<count($consulta); $i++) {
                $estudiante = $consulta[$i];
                $id = $estudiante->getId();
                $nombre = $estudiante->getNombre();
                $apellido = $estudiante->getApellido();
                $cedulaRepresentante = $estudiante->getCedulaRepresentante();
                $idClase = $estudiante->getIdClase();

                //consultandio por la clase.
                $clase = $claseConsul->getInstancia(array($idClase));
                $clase = $clase[0];
                $claseDescrip = $clase->getDescripcion();

                $options = $options."
                    <option value=\"$id\">
                        $nombre $apellido - Representante: $cedulaRepresentante 
                        - Clase: $claseDescrip
                    </option>";
            }

            $options = $options."</optGroup>";

            return $options;
            
        }

        public function crearItemAtributos($atributos, $id) {
            $consulta = $this->dao->getTodosValidos(array(1));
    
            $html = "<div class=\"input__grupo\">
                        <select id=\"$id\" name=\"$id\" $atributos>";
            $html = $html.$this->crearOption($consulta, null);
            $html = $html."
                        </select>
                    </div>";
    
            return $html;
        }
    }

?>