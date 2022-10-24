<?php
    if( isset($_POST['modificar']) ) {
        //El unico input necesario para realizar esta operacion es la cedula del usuario a cambiar
        $nacionalidadInput = comprobarInput('nacionalidadInput', 'Se debe introducir una nacionalidad valida', $pagina);
        $cedulaInput = comprobarInput('cedulaInput', 'Se debe introducir un numero de cedula valido', $pagina);

        $nombre = $_POST['nombreInput'];
        $apellido = $_POST['apellidoInput'];
        $correo = $_POST['correoInput'];
        $telefono = $_POST['telefonoInput'];

        $cedula = crearCedula($nacionalidadInput, $cedulaInput);

        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            //CONSULTAR POR PERSONA.
            $personaDAO = new PersonaDAO($bd);
            $persona = $personaDAO->getInstancia(array($cedula));       //Retorna una unica instancia

            //CONSULTAR POR CONTACTO.
            $contactoDAO = new ContactoDAO($bd);
            $contactos = $contactoDAO->getInstancia(array($cedula));    //Retorna un arreglo de contactos


            //comparar en tabla persona si hay algun dato nuevo.
                //Enviar a cargar los datos viejos junto a los nuevos.
            //comparar en tabla contacto si hay algun dato nuevo. (CORREO)
                //Enviar a cargar los datos viejos junto a los nuevos.

            //De existir un cambio en telefono, realizar el cambio pertinente al id=2
            


            //Serializar el objeto para poderlo pasar a la vista resultado
            // $serialize = serialize($representanteConsul);
            // header("Location: RepresentanteView.php?representantes=".urlencode($serialize));
        }
        catch(Exception $mensaje) {  
            alerta($mensaje);
        }
    }
?>