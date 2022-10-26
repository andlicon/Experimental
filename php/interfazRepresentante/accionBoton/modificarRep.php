<?php
    include_once('../formulario/Mensaje.php');
    include_once('../conexion/RepresentanteModif.php');
    include_once('../acciones/ModificarRepresentante.php');

    if( isset($_POST['modificar']) ) {
        $pag = 'Location: RepresentanteView.php';

        //El unico input necesario para realizar esta operacion es la cedula del usuario a cambiar
        $nacionalidadInput = comprobarInput('nacionalidadInput', 'Se debe introducir una nacionalidad valida', $pag);
        $cedulaInput = comprobarInput('cedulaInput', 'Se debe introducir un numero de cedula valido', $pag);

        $nombre = $_POST['nombreInput'];
        $apellido = $_POST['apellidoInput'];
        $correo = $_POST['correoInput'];
        $telefono = $_POST['telefonoInput'];

        $cedula = crearCedula($nacionalidadInput, $cedulaInput);

        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            
            $personaDAO = new PersonaDAO($bd);
            $contactoDAO = new ContactoDAO($bd);

            $modificador = new ModificarRepresentante($personaDAO, $contactoDAO, $pag, "representantes");

            $modificador->modificar(array(
                                        array($cedula),
                                        array($nombre, $apellido, $cedula),
                                        array($correo, $cedula, 1),
                                        array($telefono, $cedula, 2)
                                    ));
        }
        catch(Exception $e) {     //No se ha podido conectar a la bd o hubo un error al insertar
            echo $e;
        }
    }
?>


<!-- $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            
            $personaDAO = new PersonaDAO($bd);
            $persona = $personaDAO->getInstancia(array($cedula));       //Retorna una unica instancia
            
            //Verificando que tenga contenido, de no tener contenido, se asigna el de la bd
            $nombre = $nombre=="" ? $persona->getNombre() : $nombre;
            $apellido = $apellido=="" ? $persona->getApellido() : $apellido;
            $personaDAO->modificar(array($nombre, $apellido, $cedula));

            
            $contactoDAO = new ContactoDAO($bd);
            $contactos = $contactoDAO->getInstancia(array($cedula));    //Retorna un arreglo de contactos

            //Verificando que tenga contenido, de no tener contenido, se asigna el de la bd
            for($i=0; $i<count($contactos); $i++) {
                $contacto = $contactos[$i];
                $tipoContacto = $contacto->getIdTipo();
                $cont = null;

                if($tipoContacto==1) { //correo
                    $cont = $correo=="" ? $contacto->getContacto() : $correo;
                    echo "correo";
                }
                elseif($tipoContacto==2) {
                    $cont = $telefono=="" ? $contacto->getContacto() : $telefono;
                    echo "telefono";
                }

                $contactoDAO->modificar(array($cont, $cedula, $tipoContacto));
            } -->