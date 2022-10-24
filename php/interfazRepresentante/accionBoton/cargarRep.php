<?php
    //Clases  de acceso a datos
    include_once('../instancias/Representante.php');
    include_once('../conexion/PersonaDAO.php');
    include_once('../conexion/ContactoDAO.php');
    //Funciones
    include_once('../formulario/Alerta.php');
    include_once('../general/crearCedula.php');
    include_once('../general/comprobarInput.php');
    include_once('../general/mandarMensaje.php');
/*
    consulta única instancia para Representante
*/
    if( isset($_POST['cargar']) ) {
        $pagina = 'Location: RepresentanteView.php';

        //Comprobando los inputs
        $nacionalidadInput = comprobarInput('nacionalidadInput', 'Se debe introducir una nacionalidad valida', $pagina);
        $cedulaInput = comprobarInput('cedulaInput', 'Se debe introducir un numero de cedula valido', $pagina);
        $nombre = comprobarInput('nombreInput', 'Se debe introducir un nombre valido', $pagina);
        $apellido = comprobarInput('apellidoInput', 'Se debe introducir un apellido valido', $pagina);
        $correo = comprobarInput('correoInput', 'Se debe introducir un correo valido', $pagina);
        $telefono = $_POST['telefonoInput'];    //No debe ser comprobado ya que es opcional.

        $cedula = crearCedula($nacionalidadInput, $cedulaInput);    //se crea la cedula

        try { 
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                //PERSONA
            $personaDAO = new PersonaDAO($bd);
            $personaDAO->cargar(array($cedula, $nombre, $apellido));
                //CONTACTO
            //Se anade el primer contacto
            $contactoDAO = new ContactoDAO($bd);
            $contactoDAO->cargar(array($cedula, 1, $correo));
            //Se anade el segundo contacto
            if($telefono) { //De haber anadido un numero telefonico, se crea un renglon en la bd
                $contactoDAO->cargar(array($cedula, 2, $telefono));
            }
                //REPRESENTANTE
            $representanteModif = new RepresentanteModif($bd);
            $representanteModif->cargar(array($cedula));

            $alerta = new Mensaje(null, true, 'se ha cargado exitosamente al representante');
            mandarMensaje($alerta, $pagina);
        }
        catch(Exception $e) {  
            alerta($e);
        }
    }
?>