<?php
    //Clases  de acceso a datos
    include_once('../instancias/Representante.php');
    include_once('../conexion/PersonaModif.php');
    include_once('../conexion/ContactoModif.php');
    include_once('../conexion/RepresentanteModif.php');
    //Funciones
    include_once('../formulario/Alerta.php');
    include_once('../general/crearCedula.php');
/*
    consulta única instancia para Representante
*/
    if( isset($_POST['cargar']) ) {
        //tabla persona
        $cedula = crearCedula('nacionalidad-cargar', 'cedula-cargar');
        $nombre = $_POST['nombre-cargar'];
        $apellido = $_POST['cedula-cargar'];
        //tabla contacto
        $correo = $_POST['correo-cargar'];
        //contacto adicional
        $telefono = $_POST['telefono-cargar'];



        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                //PERSONA
            $personaModif = new PersonaModif($bd);
            $personaModif->cargar(array($cedula, $nombre, $apellido));
                //CONTACTO
            //Se anade el primer contacto
            $contactoModif = new ContactoModif($bd);
            $contactoModif->cargar(array($cedula, 1, $correo));
            //Se anade el segundo contacto
            if($telefono) { //De haber anadido un numero telefonico, se crea un renglon en la bd
                $contactoModif->cargar(array($cedula, 2, $telefono));
            }
                //REPRESENTANTE
            $representanteModif = new RepresentanteModif($bd);
            $representanteModif->cargar(array($cedula));
        }
        catch(Exception $mensaje) {  
            alerta($mensaje);
        }
    }
?>