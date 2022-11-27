<?php
    include_once(DAO_PATH.'/PersonaDAO.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    
    include_once(GENERAL_PATH.'/comprobarInput.php');
    include_once(GENERAL_PATH.'/crearCedula.php');
    include_once(GENERAL_PATH.'/Pagina.php');

    function cargarPersona(BaseDeDatos $bd, $pagina) {
        $nacionalidadInput = comprobarInput('nacionalidadInput', $pagina);
        $cedulaInput = comprobarInput('cedulaInput', $pagina);
        $cedula = crearCedula($nacionalidadInput, $cedulaInput);    //se crea la cedula
        $nombre = comprobarInput('nombreInput', $pagina);
        $apellido = comprobarInput('apellidoInput', $pagina);
        $idTipoPersona = comprobarInput('tipoPersonaInput', $pagina);
        
        $personaDAO = new PersonaDAO($bd);
        $personaDAO->cargar(array($cedula, $nombre, $apellido, $idTipoPersona));
    }
?>