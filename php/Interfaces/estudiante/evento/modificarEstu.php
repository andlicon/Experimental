<?php
    include_once(DAO_PATH.'/EstudianteDAO.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');

    include_once(GENERAL_PATH.'/Pagina.php');
    include_once(GENERAL_PATH.'/comprobarChecks.php');
    

    if( isset($_POST['modificar']) ) {
        $pagina = new Pagina(Pagina::ESTUDIANTE);

        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

        try {
            $idsEstudiantes = comprobarChecks(false, $pagina);
            $idEstudiante = $idsEstudiantes[0];

            $estudianteDAO = new EstudianteDAO($bd);

            //INPUTS
            $nombreInput = $_POST['nombreInput'];
            $apellidoInput = $_POST['apellidoInput'];
            $fechaInput = $_POST['fechaInput'];
            $idClaseInput = $_POST['claseInput'];
            $cedulaInput = $_POST['representanteInput'];

            $estudianteInput = new Estudiante($idEstudiante, $nombreInput, 
                                                $apellidoInput, $fechaInput, $cedulaInput, $idClaseInput);

            //Comprobando que exista algun cambio comparado con la bd.
            //Solo se modificaran los atributos que sean distintos a la bd.
            //!ESTO SE PUEDE REALIZAR EN OTRA CLASE PARA CUMPLIR "SRP", DESPUES CORREGIR.
            $estudiantes = $estudianteDAO->getInstancia(array($idEstudiante));
            $estudiante = $estudiantes[0];

            $nombre = $nombreInput=="" ? $estudiante->getNombre() : $nombreInput;
            $apellido = $apellidoInput=="" ? $estudiante->getApellido() : $apellidoInput;
            $fecha = $fechaInput=="" ? $estudiante->getFechaNacimiento() : $fechaInput;
            $idClase = $idClaseInput=="" ? $estudiante->getIdClase() : $idClaseInput;
            $cedula = $cedulaInput=="" ? $estudiante->getCedulaRepresentante() : $cedulaInput;
            

            $estudianteDAO->modificar(array($nombre, $apellido, $fecha, 
                                            $idClase, $cedula, $idEstudiante));

            $pagina->imprimirMensaje(null, Mensaje::EXITO, "Se ha emodificado exitosamente a los estudiantes.");
        }
        catch(SelectException $e) {
            $e->imprimirError();
        }
        catch(PDOException $e) {
            $codigo = $e->getCode();

            if($codigo==23000) {
                $bd->revertirCambios();
                $pagina->imprimirMensaje(null, Mensaje::ERROR, "Existe alguna dependencia que impide eliminar al estudiante.");

                die();
            }
            
            echo $e;
        }
    }