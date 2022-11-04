<?php
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/DeudaDAO.php');

    include_once('../formulario/Alerta.php');

    include_once('../acciones/Actualizar.php');

    include_once('../general/crearCedula.php');
    include_once('../general/comprobarInput.php');
    include_once('../general/crearCedula.php');

    if( isset($_POST['cargar']) ) {
        $pagina = "Location: deudaView.php";
        $objSerializar = "deudas";
        
        $nacionalidadInput = comprobarInput('nacionalidadInput', 'Se debe introducir una nacionalidad valida', $pagina);
        $cedulaInput = comprobarInput('cedulaInput', 'Se debe introducir un numero de cedula valido', $pagina);
        $cedula = crearCedula($nacionalidadInput, $cedulaInput);
        $idMotivo = comprobarInput('motivoInput', 'Se debe introducir un motivo valido', $pagina);
        $descripcion = $_POST['descripcionInput'];
        $fecha = comprobarInput('fechaInput', 'Se debe introducir una fecha valida', $pagina);
        $monto = comprobarInput('montoInput', 'Se debe introducir un monto valido', $pagina);

            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $deudaDAO = new DeudaDAO($bd);

                $resultado = $deudaDAO->cargar(
                                                array($cedula, $idMotivo, $fecha, $descripcion, $monto)    
                                              );
                $alerta = new Mensaje(null, true, 'se ha cargado exitosamente la deuda.');
                mandarMensaje($alerta, $pagina);
            }
            catch(Exception $e) {   //De no conectarse a la bd
                echo $e;
            }
    }
?>