<?php
    include_once('../instancias/Representante.php');
    include_once('../conexion/RepresentanteDAO.php');
    include_once('../formulario/Alerta.php');



    if( isset($_POST['buscar']) ) {
        //Cedula introducida por el usuario
        $inputNacionalidad = $_POST['nacionalidad'];
        $inputCedula =  $_POST['cedula'];
        $cedula = $inputNacionalidad.$inputCedula;

        try {   //Extraer informacion de la base de datos
            $representanteDAO = new RepresentanteDAO();
            //ME FUNCIONA, AHORA TOCA VER CÓMO HACER QUE ESTO FUNCIONE, POQ NO ME DEVUELVE BIEN LA INSTANCIA
            $representante = $representanteDAO->getInstancia(array($cedula));
            // echo 'cedula:'.$representante->getCedula().' nombre:'.$representante->getNombre().' apellido:'.$representante->getApellido().' correo:'.$representante->getCorreo();
            return $representante;
        }
        catch(Exception $e) {  
            $mensaje = 'usuario incorrecto';
            alerta($mensaje);
        }
    }
?>