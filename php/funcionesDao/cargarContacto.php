<?php
    include_once(DAO_PATH.'/ContactoDAO.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');

    include_once(GENERAL_PATH.'/comprobarInput.php');
    include_once(GENERAL_PATH.'/crearCedula.php');
    include_once(GENERAL_PATH.'/Pagina.php');

    function cargarContacto(BaseDeDatos $bd, $pagina) {
        $nacionalidadInput = comprobarInput('nacionalidadInput', $pagina);
        $cedulaInput = comprobarInput('cedulaInput', $pagina);
        $cedula = crearCedula($nacionalidadInput, $cedulaInput);    //se crea la cedula
        $correo = comprobarInput('correoInput', $pagina);
        $telefono = $_POST['telefonoInput'];

        $contactoDAO = new ContactoDAO($bd, $pagina);

        $contactoDAO->cargar(array($cedula, 1, $correo));

        if($telefono!="") {
            $contactoDAO->cargar(array($cedula, 2, $telefono));
        }
    }
?>