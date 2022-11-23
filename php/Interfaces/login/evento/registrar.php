<?php
    include_once(DAO_PATH.'/UsuarioDAO.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');

    include_once(DTO_PATH.'/Usuario.php');

    include_once(GENERAL_PATH.'/comprobarInput.php');
    include_once(GENERAL_PATH.'/Pagina.php');

    include_once(EXCEPTION_PATH.'/InputException.php');

    /*
        Al precionar el botón con name="login", se comprobara en la base de dato
        si existe una combinación usuario/contrasena, de no existir creara un div
    */
    if(isset($_POST['registrar'])) {
        $pagina = new Pagina(Pagina::LOGIN);

        try {
            //persona
            $nacionalidadInput = comprobarInput('nacionalidadInput', $pagina);
            $cedulaInput = comprobarInput('cedulaInput', $pagina);
            $cedula = crearCedula($nacionalidadInput, $cedulaInput);    //se crea la cedula
            $nombre = comprobarInput('nombreInput', $pagina);
            $apellido = comprobarInput('apellidoInput', $pagina);
        }
        catch(InputException $e) {
            $e->imprimirError();
            die();
        }
        catch(Exception $e) {
            echo $e;
        }
    }
?>