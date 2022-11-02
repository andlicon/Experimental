<?php
    include_once('../conexion/EstudianteDAO.php');
    include_once('../acciones/ModificarEstudiante.php');
    include_once('../formulario/Mensaje.php');
    include_once('../general/mandarMensaje.php');

    if( isset($_POST['modificar']) ) {
        if( isset($_POST['check']) ) {
            $pagina = "Location: estudianteView.php";
            $objSerializar = "estudiantes";

            $checks = $_POST['check'];

            if(count($checks)==1) {
                $nombreInput = $_POST['nombreInput'];
                $apellidoInput = $_POST['apellidoInput'];
                $fechaInput = $_POST['fechaInput'];
                $idClaseInput = $_POST['claseInput'];

                $nacionalidadInput = $_POST['nacionalidadInput'];
                $cedulaNumInput = $_POST['cedulaInput'];
                $cedulaInput = $cedulaNumInput=="" ? "" : crearCedula($nacionalidadInput, $cedulaNumInput);

                try {   //Extraer informacion de la base de datos
                    $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                    $estudianteDAO = new EstudianteDAO($bd);

                    for($i=0; $i<count($checks); $i++) {
                        $idEstudiante = $checks[$i];
                        $estudiantes = $estudianteDAO->getInstancia(array ($idEstudiante));
                        $estudiante = $estudiantes[0];

                        $nombre = $nombreInput=="" ? $estudiante->getNombre() : $nombreInput;
                        $apellido = $apellidoInput=="" ? $estudiante->getApellido() : $apellidoInput;
                        $fecha = $fechaInput=="" ? $estudiante->getFechaNacimiento() : $fechaInput;
                        $idClase = $idClaseInput=="" ? $estudiante->getClase()->getId() : $idClaseInput;
                        $cedula = $cedulaInput=="" ? $estudiante->getCedulaRepresentante() : $cedulaInput;

                        $estudianteDAO->modificar( array($nombre, $apellido, $fecha, 
                                                         $idClase, $cedula, $idEstudiante));
                    }
                
                    header($pagina);
                }
                catch(Exception $mensaje) {  
                    alerta($mensaje);
                }
            }
            else {
                $mensaje = new Mensaje(null, false, "se debe elegir 1 solo representante para modificar");
                mandarMenasje($mensaje, $pagina);
            }
        }
    }

?>