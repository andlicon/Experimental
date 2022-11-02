<?php
    include_once('../formulario/Mensaje.php');
    include_once('../general/mandarMensaje.php');
    include_once('../acciones/ModificarPersona.php');

    if( isset($_POST['modificar']) ) {

        $pagina = 'Location: RepresentanteView.php';
        $objSerializar = "personas";

        $nacionalidadInput = comprobarInput('nacionalidadInput', 'Se debe introducir una nacionalidad valida', $pagina);
        $cedulaInput = comprobarInput('cedulaInput', 'Se debe introducir una cedula valida', $pagina);;
        $cedula = crearCedula($nacionalidadInput, $cedulaInput);

        $nombre = $_POST['nombreInput'];
        $apellido = $_POST['apellidoInput'];
        $correo = $_POST['correoInput'];
        $telefono = $_POST['telefonoInput'];

        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

            $personaDAO = new PersonaDAO($bd);
            $contactoDAO = new ContactoDAO($bd);
            
            $modificador = new ModificarRepresentante($personaDAO, $contactoDAO, $pagina, "representantes");
            
            $modificador->modificar(array(
                                        array($cedula),
                                        array($cedula, $nombre, $apellido),
                                        array($correo, 1),
                                        array($telefono, 2)
                                    ));
            }
            catch(Exception $e) {     //No se ha podido conectar a la bd o hubo un error al insertar
                echo $e;
            }
    
    }
?>