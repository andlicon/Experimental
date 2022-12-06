<?php
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/DeudaDAO.php');
    include_once(DAO_PATH.'/EstudianteDAO.php');

    include_once(GENERAL_PATH.'/crearCedula.php');
    include_once(GENERAL_PATH.'/comprobarInput.php');
    include_once(GENERAL_PATH.'/crearCedula.php');
    include_once(GENERAL_PATH.'/Pagina.php');



    if( isset($_POST['cargar']) ) {
        $pagina = new Pagina(Pagina::DEUDA);

            try {
                //INPUTS
                $idEstudiante = comprobarInput('estudianteInput', $pagina);
                $idMotivo = comprobarInput('motivoInput', $pagina);
                $fecha = comprobarInput('fechaInput', $pagina);
                $descripcion = $_POST['descripcionInput'];
                $monto = comprobarInput('montoInicialInput', $pagina);

                //Representante
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $estudianteDAO = new EstudianteDAO($bd);
                $resultado = $estudianteDAO->getInstancia(array($idEstudiante));
                $estudiante = $resultado[0];
                $cedulaRep = $estudiante->getCedulaRepresentante();

                $deudaDAO = new DeudaDAO($bd);

                $resultado = $deudaDAO->cargar(
                                                array($cedulaRep, $idEstudiante, $idMotivo, $fecha, $descripcion, $monto)    
                                              );

                $bd->guardarCambios();
                $pagina->imprimirMensaje(null, Mensaje::EXITO, 'se ha cargado exitosamente la deuda.');
                mandarMensaje($alerta, $pagina);
            }
            catch(InputException $e) {
                $e->imprimirError();
            }
            catch(Exception $e) {   //De no conectarse a la bd
                echo $e;
            }
    }
?>