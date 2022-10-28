<?php
    include_once('../formulario/Mensaje.php');
    include_once('../general/mandarMensaje.php');
    include_once('../conexion/RepresentanteModif.php');
    include_once('../acciones/ModificarRepresentante.php');

    if( isset($_POST['modificar']) ) {

        if( isset($_POST['check']) ) {
            $pagina = 'Location: RepresentanteView.php';
            $objSerializar = "estudiantes";

            $checks = $_POST['check'];

            if(count($checks)==1) {
                $check = $checks[0];
                $valores = explode(',', $check);
                $cedula = $valores[0];

                $nombre = $_POST['nombreInput'];
                $apellido = $_POST['apellidoInput'];
                $correo = $_POST['correoInput'];
                $telefono = $_POST['telefonoInput'];

                try {   //Extraer informacion de la base de datos
                    $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

                    $personaDAO = new PersonaDAO($bd);
                    $contactoDAO = new ContactoDAO($bd);
                
                    $modificador = new ModificarRepresentante($personaDAO, $contactoDAO, $pag, "representantes");
                
                    $modificador->modificar(array(
                                                array($cedula),
                                                array($nombre, $apellido),
                                                array($correo, 1),
                                                array($telefono, 2)
                                            ));
                }
                catch(Exception $e) {     //No se ha podido conectar a la bd o hubo un error al insertar
                    echo $e;
                }
            }
            else {
                $mensaje = new Mensaje(null, false, "se debe elegir 1 solo representante para modificar");
                mandarMensaje($mensaje, $pagina);
            }
        }
    }
?>