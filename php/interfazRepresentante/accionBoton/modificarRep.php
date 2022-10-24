<?php
    //Este metodo lo que hara sera realizar una consulta
    //cargar los valores a los inputs
    //de presionar modificar, se hara la modificacion
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
            $representanteConsul = new RepresentanteConsul($bd);
            $representante= $representanteConsul->getInstancia(array($cedula));

            //CONSULTAR POR PERSONA.
            //CONSULTAR POR REPRESENTANTE ID.
            //CONSULTAR POR TIPO DE CONTACTO
            //CONSULTAR POR CONTACTO.
            $nombre = $nombre==null || $nombre==="" ? $representante->getNombre() : $nombre;
            echo $nombre;
            $apellido = $apellido==null || $apellido==="" ? $representante->getApellido() : $apellido;
            echo $apellido;
            
            // $ = $nombre==null || $nombre==="" ? $representante->getNombre() : $nombre;
            // $nombre = $nombre==null || $nombre==="" ? $representante->getNombre() : $nombre;
            // $nombre = $nombre==null || $nombre==="" ? $representante->getNombre() : $nombre;

            //Serializar el objeto para poderlo pasar a la vista resultado
            // $serialize = serialize($representanteConsul);
            // header("Location: RepresentanteView.php?representantes=".urlencode($serialize));
        }
        catch(Exception $mensaje) {  
            alerta($mensaje);
        }
    }
?>