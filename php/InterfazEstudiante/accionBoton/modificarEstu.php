<?php
    include_once('../conexion/EstudianteDAO.php');
    include_once('../acciones/ModificarEstudiante.php');

    if( isset($_POST['modificar']) ) {
        if( isset($_POST['check']) ) {
            $pagina = "Location: estudianteView.php";
            $objSerializar = "estudiantes";

            $checks = $_POST['check'];

            $nombre = $_POST['nombreInput'];
            $apellido = $_POST['apellidoInput'];
            $fecha = $_POST['fechaInput'];
            $idClase = $_POST['claseInput'];

            $nacionalidadInput = $_POST['nacionalidadInput'];
            $cedulaInput = $_POST['cedulaInput'];
            $cedula = $cedulaInput=="" ? "" : crearCedula($nacionalidadInput, $cedulaInput);

            try {   //Extraer informacion de la base de datos
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $estudianteDAO = new EstudianteDAO($bd);
                $representanteConsul = new RepresentanteConsul($bd);

                $modificador = new ModificarEstudiante($estudianteDAO, $representanteConsul, $pagina, $objSerializar);

                for($i=0; $i<count($checks); $i++) {
                    $idEstudiante = $checks[$i];
                    $modificador->modificar(array(
                                                    array($cedula),
                                                    array($nombre, $apellido, $fecha, $idClase, 
                                                            $idEstudiante)
                                                ));
                }
    
                // header($pagina);
            }
            catch(Exception $mensaje) {  
                alerta($mensaje);
            }
        }
    }

?>