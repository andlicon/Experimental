<?php
    include_once('IModificar.php');

    class ModificarEstudiante implements IModificar {
        private $estudianteDAO;
        private $representanteConsul;
        private $pagina;
        private $objSerializar;

        public function __construct(EstudianteDAO $estudianteDAO,
                                    RepresentanteConsul $representanteConsul,
                                    $pagina,
                                    $objSerializar) {
            $this->estudianteDAO = $estudianteDAO;
            $this->representanteConsul = $representanteConsul;
            $this->pagina = $pagina;
            $this->objSerializar = $objSerializar;
        }

        public function modificar($matriz) {
            //Obtener inputs
            $arregloDatos = $matriz[1];
            $nombreInput = $arregloDatos[0];
            $apellidoInput = $arregloDatos[1];
            $fechaInput = $arregloDatos[2];
            $idClaseInput = $arregloDatos[3];
            $idEstudianteInput = $arregloDatos[4];

            $estudiantes = $this->estudianteDAO->getInstancia(array(null, null, $idEstudianteInput));
            $arregloCedula = $matriz[0];
            $cedula = $arregloCedula[0];

            $idRepresentanteInput = "";
            try {
                $representantes = $this->representanteConsul->getInstancia($arregloCedula);
                $idRepresentanteInput = $representantes[0]->getId();
            }
            catch (Exception $e) {
                $idRepresentanteInput = "";
            }

            if($estudiantes) {
                $estudiante = $estudiantes[0];
                
                //Comprobar que el input es distinto a la bd
                $nombre = $nombreInput=="" ? $estudiante->getNombre() : $nombreInput;
                $apellido = $apellidoInput=="" ? $estudiante->getApellido() : $apellidoInput;
                $fecha = $fechaInput=="" ? $estudiante->getFechaNacimiento() : $fechaInput;
                $idClase = $idClaseInput=="" ? $estudiante->getClase() : $idClaseInput;
                $idRepresentante = $idRepresentanteInput=="" ? $estudiante->getIdRepresentante() : $idRepresentanteInput;

                $this->estudianteDAO->modificar(array($nombre, $apellido, $fecha, 
                                                        $idClase, $idRepresentante,
                                                        $idEstudianteInput));   // modifica estudiante
            }

            $mensaje = new Mensaje(null, true, 'se ha modificado con exito al '.$this->objSerializar);
            mandarMensaje($mensaje, $this->pagina);
        }
    }
?>